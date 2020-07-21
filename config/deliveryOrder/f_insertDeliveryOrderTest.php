<?php

/*|
 | Function Name 	: insertDeliveryOrder
 | Description 		: Insert Delivery Order
 | Creator			: Endang Fiansyah
 | Create Date		: 13/05/2015
 |					  EDITOR		UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function insertDeliveryOrderTest($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		
		//return $in_param;

		$d_o = $xml_data->data->d_o;
		
		$shipping_id = $xml_data->sc_host;
		$terminal_id = $xml_data->sc_partner;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//PL/SQL
		$data=array();
		for($i=0;$i<count($d_o);$i++)
		{
			$do_no = $d_o[$i]->do_no;
			$bl_no = $d_o[$i]->bl_no;
			$ves_callsign = $d_o[$i]->ves_callsign;
			$ves_voyin = $d_o[$i]->ves_voyin;
			$ves_voyout = $d_o[$i]->ves_voyout;
			$ves_name = $d_o[$i]->ves_name;
			$ves_ukk = $d_o[$i]->ves_ukk;
			$expired_date = $d_o[$i]->expired_date;
			$released_date = $d_o[$i]->release_date;
			$do_consignee = $d_o[$i]->do_consignee;
			
			$detail_container = $d_o[$i]->detail->container;
			for($j=0;$j<count($detail_container);$j++)
			{									
				$no = $detail_container[$j]->no;
				$carrier = $detail_container[$j]->carrier;
				$isocode = $detail_container[$j]->isocode;
				$status = $detail_container[$j]->status;
				$seal = $detail_container[$j]->seal;
				
				$sql = "select count(do_number) as hasil from MST_DOONLINE_FRMILCS_TEST where DO_NUMBER='$do_no' AND CONTAINER_NUMBER='$no'";
				if(!checkOriSQL($conn['ori']['ibis'],$sql,$query_result,$err)) goto Err;
				
				$row = oci_fetch_array($query_result, OCI_ASSOC);
				if($row["HASIL"]>0)
				{
					$sql = "update MST_DOONLINE_FRMILCS_TEST set VES_CALLSIGN='$ves_callsign',
															VES_VOYIN='$ves_voyin',
															VES_VOYOUT='$ves_voyout',
															VES_NAME='$ves_name',
															VES_UKKSIMOPKAPAL='$ves_ukk',
															CONTAINER_CARRIER='$carrier',
															CONTAINER_ISOCODE='$isocode',
															CONTAINER_STATUS='$status',
															TR_UPDATEDATE = sysdate,
															TR_FLAG='U',
															EXPIRED_DATE=TO_DATE ('".trim($expired_date)."', 'DD-MM-YYYY'),
															SHIPPING_ID = '$shipping_id',
															TERMINAL_ID = '$terminal_id',
															DO_CONSIGNEE = '$do_consignee',
															RELEASED_DATE = TO_DATE ('".trim($released_date)."', 'DD-MM-YYYY'),
															CONTAINER_SEAL = '$seal',
															BL_NUMBER='$bl_no'
														where DO_NUMBER='$do_no' AND CONTAINER_NUMBER='$no'
															";				
				}
				else
				{
					$sql = "insert into MST_DOONLINE_FRMILCS_TEST (
															DO_NUMBER,
															VES_CALLSIGN,
															VES_VOYIN,
															VES_VOYOUT,
															VES_NAME,
															VES_UKKSIMOPKAPAL,
															CONTAINER_NUMBER,
															CONTAINER_CARRIER,
															CONTAINER_ISOCODE,
															CONTAINER_STATUS,
															TR_RECEIVEDATE,
															TR_FLAG,
															EXPIRED_DATE,
															SHIPPING_ID,
															TERMINAL_ID,
															DO_CONSIGNEE,
															RELEASED_DATE,
															CONTAINER_SEAL,
															BL_NUMBER
															) 
															values (
															'$do_no',
															'$ves_callsign',
															'$ves_voyin',
															'$ves_voyout',
															'$ves_name',
															'$ves_ukk',
															'$no',
															'$carrier',
															'$isocode',
															'$status',
															sysdate,
															'S',
															TO_DATE ('".trim($expired_date)."', 'DD-MM-YYYY'),
															'$shipping_id',
															'$terminal_id',
															'$do_consignee',
															TO_DATE ('".trim($released_date)."', 'DD-MM-YYYY'),
															'$seal',
															'$bl_no'
															)";
				}
				
				//QUERY
				if(!checkOriSQL($conn['ori']['ibis'],$sql,$query_result,$err)) goto Err;

			}
		}

		$out_data = array();
		$out_data['data']=$data;

		goto Success;

	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}

	/*------------------------------------------ERROR-------------------------------------------------------------*/
	Err:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($err=="") $err = "ERR";
		if($out_status=="") $out_status = "F";
		return generateResponse($out_data, $out_status, $err, "xml");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS";
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "xml");
}

?>