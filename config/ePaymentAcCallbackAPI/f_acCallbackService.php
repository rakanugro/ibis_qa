<?php

/*|
 | Function Name 	: acCallbackService
 | Description 		: ac Callback Service
 | Creator			: Endang Fiansyah
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function acCallbackService($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb2();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$serviceName = $xml_data->data->serviceName;
		$externalId = $xml_data->data->externalId;
//		$accountNumber = $xml_data->data->accountNumber;//additional
	//	$currency = $xml_data->data->currency;//additional
		$holdAmount = $xml_data->data->newHoldAmount;//additional
	//	$updateAmount = $xml_data->data->updateAmount;//additional
		$releaseAmount = $xml_data->data->releaseAmount;//additional
		$paymentAmount = $xml_data->data->paymentAmount;//additional
//		$transferAmount = $xml_data->data->transferAmount;//additional
		$respond = $xml_data->data->respond;//additional
		$message = $xml_data->data->message;//additional
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//PL/SQL
		$getJumlahLog = "select count(*) as jumlah_data_log from ac_callback_parameter_log where service_name = '$serviceName' and external_id='$externalId'";
		
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getJumlahLog,$query_getJumlahLog,$err,$debug)) goto Err;
		//FETCH QUERY
		$row_jumlahLog = oci_fetch_array($query_getJumlahLog, OCI_ASSOC);
		$jumlahLog = $row_jumlahLog["JUMLAH_DATA_LOG"];

		if($jumlahLog>0)
		{
			$updateLog = "update ac_callback_parameter_log set 		
									external_id = '$externalId',
									service_name = '$serviceName',
									account_number = '$accountNumber',
									currency = '$currency',
									hold_amount = '$holdAmount',
									update_amount = '$updateAmount',
									release_amount = '$releaseAmount',
									payment_amount = '$paymentAmount',
									transfer_amount = '$transferAmount',
									respond = '$respond',
									message = '$message',
									last_update_date = sysdate 
							where service_name = '$serviceName' and external_id='$externalId' 
							";
			if(!checkOriSQL($conn['ori']['kapal'],$updateLog,$query_updateLog,$err,$debug)) goto Err;
			
			$operation = "UPDATE ($externalId,
									$serviceName,
									$accountNumber,
									$currency,
									$holdAmount,
									$updateAmount,
									$releaseAmount,
									$paymentAmount,
									$transferAmount,
									$respond,
									$message)";
		}
		else
		{
			
			$insertLog = "insert into ac_callback_parameter_log 
												(
													external_id, 
													service_name, 
													account_number,
													currency,
													hold_amount,
													update_amount,
													release_amount,
													payment_amount,
													transfer_amount,
													respond,
													message,
													log_date,
													last_update_date
												)
												VALUES 
												(
													'$externalId',
													'$serviceName',
													'$accountNumber',
													'$currency',
													'$holdAmount',
													'$updateAmount',
													'$releaseAmount',
													'$paymentAmount',
													'$transferAmount',
													'$respond',
													'$message',
													sysdate,
													sysdate
												)";
			if(!checkOriSQL($conn['ori']['kapal'],$insertLog,$query_insertLog,$err,$debug)) goto Err;
			$operation = "INSERT ($externalId,
									$serviceName,
									$accountNumber,
									$currency,
									$holdAmount,
									$updateAmount,
									$releaseAmount,
									$paymentAmount,
									$transferAmount,
									$respond,
									$message)";
		}

		$out_data = array();
		$out_data["message"] = "SUCCESS ".$operation;

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