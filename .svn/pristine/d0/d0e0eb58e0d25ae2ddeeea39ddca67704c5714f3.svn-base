<?php

function send_email($to, $subject, $text_content, $html_content, $attachment="",$from="")
{
	//======= Email Library ========//
	require_once "smtp/Mail.php"; // PEAR Mail package
	require_once ('smtp/mime.php'); // PEAR Mail_Mime packge

	// sent email
	//$from = "Endang Fianyah <endang.fiansyah@indonesiaport.co.id>";
	//$to = "Endang Fiansyah <fian.enfi@gmail.com>";

	try {
		$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

		$text = $text_content;// text and html versions of email.
		
		//====================================HTML===================================================================
		$html = "<html>
					<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
					<title>$subject</title>
					
					</head>

					<body>
					$html_content
					</body>
					</html>";

		//=====================================HTML===================================================================
		$attachment = 'emon'; // attachment
		$name = basename('dama');
		$crlf = "\n";

		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		//$mime->addAttachment($file, 'xls');
		
		$mime->addAttachment($attachment,'application/pdf',$name,true,'base64'); 

		//do not ever try to call these lines in reverse order
		$body = $mime->get();
		$headers = $mime->headers($headers);

		$host = "mail.indonesiaport.co.id";
		$username = "endang.fiansyah";
		$password = "pisang999";

		$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,
		 'username' => $username,'password' => $password));

		$mail = $smtp->send($to, $headers, $body);

		if (PEAR::isError($mail)) {
			return "F^".$mail->getMessage();
		}
		else {
			return "S";
		}
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		return Err;
	}	
}

/*|
 | Function Name 	: sendEmail 
 | Description 		: Send Email (Auto)  - STAGGING IN IBIS PROD
 |*/
function sendEmailAuto($in_param) {
	
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
					from email_lg";
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$row_email = oci_fetch_array($query_email, OCI_ASSOC);
		$max_counter = $row_email[MAX_COUNTER]+1;
		//PL/SQL
		$query = "update email_lg set EXT_INFO1='$max_counter' where status='N' and (send_date<sysdate or send_date is null) and EXT_INFO1 is null";
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_email,$err,$debug)) goto Err;
		
		//PL/SQL
		$query = "select from_email, to_email, DBMS_LOB.substr(html_data, 3000) as html_data, DBMS_LOB.substr(text_data, 3000) as text_data, is_attachment, status, send_status, save_date, 
					send_date, modul_name, bcc, subject_email, ext_info1, ext_info2, ext_info3, attachment_link  
					from email_lg where EXT_INFO1='$max_counter'";
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$masuk="gakmasuk";
		while ($row_email = oci_fetch_array($query_email, OCI_ASSOC))
		{
			$masuk="masuk";
			$to = $row_email[TO_EMAIL];
			$to_all .= ";".$to;
			$from = ($row_email[FROM_EMAIL]=="" ? "admin@indonesiaport.co.id" : $row_email[FROM_EMAIL]);
			$subject = $row_email[SUBJECT_EMAIL];
			$text_content = $row_email[TEXT_DATA];
			$html_content = $row_email[HTML_DATA];
			$is_attachment= $row_email[IS_ATTACHMENT];
			$attachment_link= $row_email[ATTACHMENT_LINK];
			$save_date = $row_email[SAVE_DATE];

			$status = send_email($to, $subject, $text_content, $html_content, $attachment_link, $from);
			if($status=="S")
			{
				$query = "update email_lg set status='S', send_status='S', send_statusmsg='SUCCESS', send_date=sysdate, from_email='$from', EXT_INFO2='BY91' 
							where subject_email='$subject' and to_email='$to' and EXT_INFO1='$max_counter'";
				//QUERY
				if(!checkOriSQL($conn['ori']['ibis'],$query,$query_update,$err,$debug)) goto Err;				
			}
			else
			{
				$query = "update email_lg set status='F', send_status='F', send_statusmsg='$status', send_date=sysdate, from_email='$from', EXT_INFO2='BY91' 
							where subject_email='$subject' and to_email='$to' and EXT_INFO1='$max_counter'";
				//QUERY
				if(!checkOriSQL($conn['ori']['ibis'],$query,$query_update,$err,$debug)) goto Err;
			} 
		}

		$out_data = array();
		$out_data['data']="Success;".$masuk.";from:".$from.";to:".$to_all;

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
 | Function Name 	: sendEmail 2
 | Description 		: Send Email (Auto) - STAGGING IN KAPAL PROD
 |*/
function sendEmailAuto2($in_param) {
	
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
					from email_lg";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$row_email = oci_fetch_array($query_email, OCI_ASSOC);
		$max_counter = $row_email[MAX_COUNTER]+1;
		//PL/SQL
		$query = "update email_lg set EXT_INFO1='$max_counter' where status='N' and (send_date<sysdate or send_date is null) and EXT_INFO1 is null";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_email,$err,$debug)) goto Err;
		
		//PL/SQL
		$query = "select from_email, to_email, DBMS_LOB.substr(html_data, 3000) as html_data, DBMS_LOB.substr(text_data, 3000) as text_data, is_attachment, status, send_status, save_date, 
					send_date, modul_name, bcc, subject_email, ext_info1, ext_info2, ext_info3, attachment_link  
					from email_lg where EXT_INFO1='$max_counter'";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$masuk="gakmasuk";
		while ($row_email = oci_fetch_array($query_email, OCI_ASSOC))
		{
			$masuk="masuk";
			$to = $row_email[TO_EMAIL];
			$to_all .= ";".$to;
			$from = ($row_email[FROM_EMAIL]=="" ? "admin@indonesiaport.co.id" : $row_email[FROM_EMAIL]);
			$subject = $row_email[SUBJECT_EMAIL];
			$text_content = $row_email[TEXT_DATA];
			$html_content = $row_email[HTML_DATA];
			$is_attachment= $row_email[IS_ATTACHMENT];
			$attachment_link= $row_email[ATTACHMENT_LINK];
			$save_date = $row_email[SAVE_DATE];

			$status = send_email($to, $subject, $text_content, $html_content, $attachment_link, $from);
			if($status=="S")
			{
				$query = "update email_lg set status='S', send_status='S', send_statusmsg='SUCCESS', send_date=sysdate, from_email='$from', EXT_INFO2='BY91' 
							where subject_email='$subject' and to_email='$to' and EXT_INFO1='$max_counter'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$query,$query_update,$err,$debug)) goto Err;				
			}
			else
			{
				$query = "update email_lg set status='F', send_status='F', send_statusmsg='$status', send_date=sysdate, from_email='$from', EXT_INFO2='BY91' 
							where subject_email='$subject' and to_email='$to' and EXT_INFO1='$max_counter'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$query,$query_update,$err,$debug)) goto Err;
			}
		}

		$out_data = array();
		$out_data['data']="Success;".$masuk.";from:".$from.";to:".$to_all;

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