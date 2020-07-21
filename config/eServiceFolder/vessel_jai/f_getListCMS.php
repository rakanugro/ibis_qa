<?php

/*|
 | Function Name 	: getListCMS
 | Description 		: Get List CMS
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getListCMS($in_param) {
	
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
		$agent_id = $xml_data->data->agent_id;
		$branch_id = $xml_data->data->branch_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get data info
		$getdata = array();
		
		//PL/SQL
		$sql = "SELECT * FROM V_CMS_BAYAR WHERE PPKB_KE=1 ORDER BY TGL_JAM_ENTRY DESC";
	
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		while ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			//build "info" data
			$data_sub = array(
								'NO_UKK' => $row[NO_UKK],
								'KD_PPKB' => $row[KD_PPKB],
								'PPKB_KE' => $row[PPKB_KE],
								'NM_KAPAL' => $row[NM_KAPAL],
								'NM_AGEN' => $row[NM_AGEN],
								'KD_STATUS' => $row[KD_STATUS],
								'STATUS' => $row[STATUS],
								'NM_CABANG' => $row[NM_CABANG]
							);
									
			array_push($getdata,$data_sub);
		}

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