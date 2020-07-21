<?php

/*|
 | Function Name 	: getKdAgen
 | Description 		: Get Kode Agen
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getKdAgen($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("KAPAL");//hanya ambil koneksi kapal saja
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$no_account = $xml_data->data->no_account;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get pkk info
		$agen = array();
		//PL/SQL
		$getAgenInfo = "select kd_agen from mst_agen WHERE no_account='$no_account'";
	
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getAgenInfo,$query_agen,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_agen = oci_fetch_array($query_agen, OCI_ASSOC))
		{
			//build "info" data
			$agen = array(
								'kd_agen' => $row_agen[KD_AGEN]
							);
		}

		$out_data = array();
		$out_data['agen']=$agen;
		
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