<?php

/*|
 | Function Name 	: getServiceCode
 | Description 		: Get Service Code
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getServiceCode($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$pppp_ke = $xml_data->data->pppp_ke;
		$status_pppp_prev = $xml_data->data->status_pppp_prev;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		$getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		if($pppp_ke=="1")
			$filter = " WHERE KD_SERVICE_CODE NOT IN ('4','6')";
		else {
			if($status_pppp_prev=="")
				$filter = " WHERE KD_SERVICE_CODE NOT IN ('2')";
			else if($status_pppp_prev=="2")	//PPPP sebelumnya ditetapkan
				$filter = " WHERE KD_SERVICE_CODE NOT IN ('2','3','8')";
			else if($status_pppp_prev=="7")	//PPPP sebelumnya sudah realisasi
				$filter = " WHERE KD_SERVICE_CODE NOT IN ('2','4','6')";
		}
		//SELECT PL/SQL
		$sql = "SELECT KD_SERVICE_CODE, SERVICE_CODE FROM MST_SERVICE_CODE".$filter;

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		while ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			//build "info" data
			$data_sub = array(
								'KD_SERVICE_CODE' => $row[KD_SERVICE_CODE],
								'SERVICE_CODE' => $row[SERVICE_CODE]
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