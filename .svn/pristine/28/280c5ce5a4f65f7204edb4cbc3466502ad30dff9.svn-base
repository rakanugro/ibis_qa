<?php

/*|
 | Function Name 	: getKunjungan
 | Description 		: Get Kunjungan
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getKunjungan($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter

		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get info
		$kunjungan = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$getKunjungan = "select KD_KUNJUNGAN, KUNJUNGAN
			from MST_KUNJUNGAN 
			order by KD_KUNJUNGAN";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getKunjungan,$query_kunjungan,$err)) goto Err;
		//FETCH QUERY
		while ($row_kunjungan = oci_fetch_array($query_kunjungan, OCI_ASSOC))
		{
			
			//build "info" data
			$kunjungan_sub = array(
									'KD_KUNJUNGAN' => $row_kunjungan[KD_KUNJUNGAN],
									'KUNJUNGAN' => $row_kunjungan[KUNJUNGAN]
								);

			array_push($kunjungan, $kunjungan_sub);
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['kunjungan']=$kunjungan;

		
		
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