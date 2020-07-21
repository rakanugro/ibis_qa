<?php

/*|
 | Function Name 	: getSaldoCMS
 | Description 		: Get Saldo CMS
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getSaldoCMS($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_pgk = $xml_data->data->no_pgk;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		$getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$sql = "SELECT  V_CMS_LIST2.*, PKK.KD_PELAYARAN, STAT_CMS_DOLLAR, STAT_CMS_RUPIAH
				FROM PKK, MST_KAPAL_AGEN, V_CMS_LIST2
				WHERE NO_UKK = '".$no_pgk."'
					AND PKK.KD_KAPAL_AGEN = MST_KAPAL_AGEN.KD_KAPAL_AGEN
					AND V_CMS_LIST2.KD_AGEN = MST_KAPAL_AGEN.KD_AGEN
					AND V_CMS_LIST2.KD_CABANG = MST_KAPAL_AGEN.KD_CABANG";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		if ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			//build "info" data
			$data_sub = array(
								'SALDO_MIN_RUPIAH' => $row[SALDO_MIN_RUPIAH],
								'SALDO_MIN_DOLLAR' => $row[SALDO_MIN_DOLLAR],
							);

			array_push($getdata, $data_sub);
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['getdata']=$getdata;		
		
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