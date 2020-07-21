<?php

/*|
 | Function Name 	: getNotaArReceipt
 | Description 		: Get detail nota (opus/lini2/barang/itos)
 |*/
function getNotaArReceipt($in_param) {

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

		$transdate = $xml_data->data->transdate;
		$modul = $xml_data->data->modul;
		$find = $xml_data->data->find;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";

		//select data
		$result = array();
		$query = array();

		getAllQuery($modul,$transdate." 00:00:00",$transdate." 23:59:59",$result);
		$query[0] = $result;

		//return $modul.$find.$query[0]["$find"];

		//PL/SQL
		$data=array();
		for($i=0;$i<count($query);$i++)
		{
			//QUERY
			if(!checkOriSQL($conn['ori']['keu_prod'],$query[$i]["$find"],$query_result_all,$err,$debug)) goto Err;

			//FETCH QUERY
			while($row = oci_fetch_array($query_result_all, OCI_ASSOC))
			{
				$userpaid = $row[USER_PAID]!="" ? $row[USER_PAID] : "";
				$remaining = $row[AMOUNT_DUE_REMAINING]!="" ? $row[AMOUNT_DUE_REMAINING] : "0";
				$credited = $row[AMOUNT_CREDITED] !="" ? $row[AMOUNT_CREDITED] : "0";
				$applied = $row[AMOUNT_APPLIED] !="" ? $row[AMOUNT_APPLIED] : "0";
				$status_armsg = $row[STATUS_ARMSG] !="" ? $row[STATUS_ARMSG] : "";
				$currency = $row[CURRENCY] !="" ? $row[CURRENCY] : "";
				$bank = $row[BANK] !="" ? $row[BANK] : "";
				$arprocess_date = $row[ARPROCESS_DATE] !="" ? $row[ARPROCESS_DATE] : "";

				//build sub data
				$data_sub = array(
										'no_nota' => $row[TRX_NUMBER],
										'modul' => $query[$i]['modul'],
										'amount' => $row[AMOUNT],
										'transdate' => $row[TRX_DATE_SIMOP],
										'userpaid' => $userpaid,
										'remaining' => $remaining,
										'credited' => $credited,
										'applied' => $applied,
										'status_armsg' => $status_armsg,
										'currency' => $currency,
										'bank' => $bank,
										'arprocess_date' => $arprocess_date
									);
				
				array_push($data, $data_sub);
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
		return generateResponse($out_data, $out_status, $err, "json");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS";
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "json");
}

?>