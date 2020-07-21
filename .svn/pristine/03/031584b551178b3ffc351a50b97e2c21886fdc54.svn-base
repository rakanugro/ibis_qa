<?php

/*|
 | Function Name 	: getCompanyList
 | Description 		: Get Company List
 | Creator			: Endang Fiansyah
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getCompanyName($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb2(); //KAPAL_PROD
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$company_id 	 = $xml_data->data->company_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get company info
		$companyname = '';
				
		//PL/SQL
		$getCompanyName = "select nama_perusahaan
							from mst_pelanggan
							where trim(kd_pelanggan) = trim('$company_id') ";//trim('$company_id') ";
		
		//return generateResponse($out_data, $out_status, $err, "json");
		
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getCompanyName,$query_companyName,$err,$debug)) goto Err;
		//FETCH QUERY
		$row_company = oci_fetch_array($query_companyName, OCI_ASSOC);
		
		//build data
		$company_name = 	$row_company[NAMA_PERUSAHAAN];

		$out_data = array();
		
		/*
		ob_start();
		var_dump($getCompanyName);
		var_dump($row_company);
		$dump = ob_get_clean();
		$out_data['company_name']=htmlspecialchars( $dump );
		*/
		$out_data['company_name']=$company_name;

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