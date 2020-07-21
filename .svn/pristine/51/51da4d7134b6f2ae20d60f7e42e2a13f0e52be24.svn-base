<?php

function send_sms($no_telp, $text)
{
	try {
		$text = str_replace(" ","+",$text);
		file_get_contents('http://mdmobileads.com/clientapi.php?msisdn='.$no_telp.'&senderid=IPC&user=pelindo&password=pelindo123&message='.$text);

		return "S";
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		return Err;
	}	
}

/*|
 | Function Name 	: sendSMSAuto
 | Description 		: Send SMS (Auto)
 |*/
function sendSMSAuto($in_param) {

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

		$data_source = $xml_data->data->data->data_source;

		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//response info
		$response = array();

		//PL/SQL
		$query = "select max(to_number(EXT_INFO1)) as max_counter 
					from sms_lg";
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$row_email = oci_fetch_array($query_email, OCI_ASSOC);
		$max_counter = $row_email[MAX_COUNTER]+1;
		//PL/SQL
		$query = "update sms_lg set EXT_INFO1='$max_counter' where status='N' and (send_date<sysdate or send_date is null) and EXT_INFO1 is null";
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_email,$err,$debug)) goto Err;
		
		//PL/SQL
		$query = "select msisdn, text from sms_lg where EXT_INFO1='$max_counter'";
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$masuk="gakmasuklo";
		while ($row_email = oci_fetch_array($query_email, OCI_ASSOC))
		{
			$masuk="masuk";
			$no_telp = $row_email[MSISDN];
			$no_telp_all .= $no_telp;
			$text	 = $row_email[TEXT];

			$no_telp_arr = explode(",",$no_telp);
			
			//loop kirim sms
			foreach ($no_telp_arr as $value) {
			
				$no_telp = trim($value);
			
				$status = send_sms($no_telp, $text);
				if($status=="S")
				{
					$query = "update sms_lg set status='S', send_status='S', send_statusmsg='SUCCESS', send_date=sysdate, EXT_INFO2='BY91'  
								where msisdn like '%$no_telp%' and text='$text' and EXT_INFO1='$max_counter'";
					//QUERY
					if(!checkOriSQL($conn['ori']['ibis'],$query,$query_update,$err,$debug)) goto Err;				
				}
				else
				{
					$query = "update sms_lg set status='S', send_status='S', send_statusmsg='$status', send_date=sysdate, EXT_INFO2='BY91'  
								where msisdn like '%$no_telp%' and text='$text' and EXT_INFO1='$max_counter'";
					//QUERY
					if(!checkOriSQL($conn['ori']['ibis'],$query,$query_update,$err,$debug)) goto Err;
				}
				
			}
		}

		$out_data = array();
		$out_data['data']="Success;".$masuk.$query.";to:".$no_telp_all;

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

/*|
 | Function Name 	: sendSMSAuto2
 | Description 		: Send SMS (Auto) - stagging di KAPAL
 |*/
function sendSMSAuto2($in_param) {

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

		$data_source = $xml_data->data->data->data_source;

		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//response info
		$response = array();

		//PL/SQL
		$query = "select max(to_number(EXT_INFO1)) as max_counter 
					from sms_lg";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$row_email = oci_fetch_array($query_email, OCI_ASSOC);
		$max_counter = $row_email[MAX_COUNTER]+1;
		//PL/SQL
		$query = "update sms_lg set EXT_INFO1='$max_counter' where status='N' and (send_date<sysdate or send_date is null) and EXT_INFO1 is null";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_email,$err,$debug)) goto Err;
		
		//PL/SQL
		$query = "select msisdn, text from sms_lg where EXT_INFO1='$max_counter'";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$masuk="gakmasuklo";
		while ($row_email = oci_fetch_array($query_email, OCI_ASSOC))
		{
			$masuk="masuk";
			$no_telp = $row_email[MSISDN];
			$no_telp_all .= $no_telp;
			$text	 = $row_email[TEXT];

			$no_telp_arr = explode(",",$no_telp);
			
			//loop kirim sms
			foreach ($no_telp_arr as $value) {
			
				$no_telp = trim($value);
			
				$status = send_sms($no_telp, $text);
				if($status=="S")
				{
					$query = "update sms_lg set status='S', send_status='S', send_statusmsg='SUCCESS', send_date=sysdate, EXT_INFO2='BY91'  
								where msisdn like '%$no_telp%' and text='$text' and EXT_INFO1='$max_counter'";
					//QUERY
					if(!checkOriSQL($conn['ori']['kapal'],$query,$query_update,$err,$debug)) goto Err;				
				}
				else
				{
					$query = "update sms_lg set status='S', send_status='S', send_statusmsg='$status', send_date=sysdate, EXT_INFO2='BY91'  
								where msisdn like '%$no_telp%' and text='$text' and EXT_INFO1='$max_counter'";
					//QUERY
					if(!checkOriSQL($conn['ori']['kapal'],$query,$query_update,$err,$debug)) goto Err;
				}
				
			}
		}

		$out_data = array();
		$out_data['data']="Success;".$masuk.$query.";to:".$no_telp_all;

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

/*|
 | Function Name 	: sendEmail
 | Description 		: Send Email (Manual)
 |*/
function sendEmailV2($in_param) {
	
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

		$customer_email= $xml_data->data->customer_email;
		$email_subject = $xml_data->data->data->email_subject;
		$text_content = $xml_data->data->data->text_content;
		$html_content = $xml_data->data->data->html_content;
		$attachment = $xml_data->data->data->attachment;

		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//response info
		$response = array();
		
		$to=$customer_email;
		$subject=$email_subject;
		$text_content=$text_content;
		$html_content=$html_content;
		$attachment=$attachment;

		send_email($to, $subject, $text_content, $html_content, $attachment="");

		$out_data = array();
		$out_data['data']="success";

		goto Success;

		goto Err;
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

/*|
 | Function Name 	: sendEmail
 | Description 		: Send Email (Manual)
 |*/
function sendEmailV1($in_param) {
	
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

		$customer_id = $xml_data->data->customer_id;
		$data_source = $xml_data->data->data->data_source;

		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//response info
		$response = array();
		
		send_email($to, $subject, $text_content, $html_content, $attachment="");

		$out_data = array();
		$out_data['data']="success";

		goto Success;

		goto Err;
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