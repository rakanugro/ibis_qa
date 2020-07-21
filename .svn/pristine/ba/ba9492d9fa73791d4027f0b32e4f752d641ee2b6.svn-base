<?php

/*|
 | Function Name 	: getKemasan
 | Description 		: Get Kemasan
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getKemasan($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter

		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get info
		$kemasan = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$getKemasan = "select KD_KEMASAN, DET_KD_KEMASAN
			from MST_KEMASAN 
			order by KD_KEMASAN";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getKemasan,$query_kemasan,$err)) goto Err;
		//FETCH QUERY
		while ($row_kemasan = oci_fetch_array($query_kemasan, OCI_ASSOC))
		{
			
			//build "info" data
			$kemasan_sub = array(
									'KD_KEMASAN' => $row_kemasan[KD_KEMASAN],
									'DET_KD_KEMASAN' => $row_kemasan[DET_KD_KEMASAN]
								);

			array_push($kemasan, $kemasan_sub);
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['kemasan']=$kemasan;

		
		
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