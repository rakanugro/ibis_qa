<?php

/*|
 | Function Name 	: submitRequestReceiving
 | Description 		: do Request Receiving
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function submitRequestDeliveryPerp($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$request_no = $xml_data->data->no_request;
		//return $request_no;
		$port_code= $xml_data->data->port_code;
		$terminal_code= $xml_data->data->terminal_code;
		$user_id= $xml_data->data->user_id;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("IBIS");
		$conn['billing'][0] = $conn['ori']['billing'];
		
		if(($port_code=='IDJKT') && ($terminal_code=='T3I'))
		{
			$param = array("V_MSG" => "");
			$sql_xpi = "declare BEGIN pkg_delivery_new.prc_crtmpdel('$request_no','EXT',:V_MSG); END;";
			if(!checkOriSQL($conn['billing'][0],$sql_xpi,$query_xpi,$err,$param)) goto Err; 
		}
		ELSE
		{
			$sql_xpi = "BEGIN nota_delivery('$request_no','EXT'); END;";
			if(!checkOriSQL($conn['billing'][0],$sql_xpi,$sql_xpi_,$err)) goto Err; 
        }
		
        
        
        //tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
        
		// check nota_delivery_h
		$query = "SELECT COUNT(1) JML FROM nota_delivery_h WHERE TRIM(ID_REQ) = TRIM('$request_no') AND STATUS <> 'X'";
        
		if(!checkOriSQL($conn['billing'][0],$query,$query_,$err)) goto Err; 
		//FETCH QUERY
		$row_ = oci_fetch_array($query_, OCI_ASSOC);
		
		$sql_upd = "update req_delivery_h set is_edit=0 where id_req='$request_no'";
		if(!checkOriSQL($conn['billing'][0],$sql_upd,$query_upd,$err)) goto Err; 
		
        if ($row_['JML'] <= 0) {
            $sql_xpi="begin pack_nota_delivery.proc_header_nota_delivery('$request_no'); end;";
            
            if(!checkOriSQL($conn['billing'][0],$sql_xpi,$query_xpi,$err,$parameter)) goto Err; 
        }
		
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$qget_nonota = "select id_proforma id_nota from nota_delivery_h where id_req = '$request_no' order by date_insert desc";
		} else {
			$qget_nonota = "select id_nota from nota_delivery_h where id_req = '$request_no' order by date_insert desc";
		}
		if(!checkOriSQL($conn['billing'][0],$qget_nonota,$qget_nonota_,$err)) goto Err; 
		$row_nonota = oci_fetch_array($qget_nonota_, OCI_ASSOC);
		$new_proforma = $row_nonota["ID_NOTA"];
		
        
		//test ibis
		$test_q = "select * from dual";
		if(!checkOriSQL($conn['ori']['ibis'],$test_q,$test_q_,$err)) goto Err; 
        
		//update data di ibis
		$upd_ibis = "update transaction_log set STATUS_REQ = 'S', PRF_NUMBER = '$new_proforma', PRF_DATE = sysdate, LAST_USER_ACTIVITY_CODE = 'APPROVE_REQUEST', LAST_USER_ACTIVITY_USERID = '$user_id'  
							where BILLER_REQUEST_ID='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$upd_ibis,$query_ibis,$err)) goto Err;
		
		$data = array(
            'request_no' => $request_no
        );

		$queryDataRequest="SELECT * FROM transaction_log WHERE BILLER_REQUEST_ID='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$queryDataRequest,$getDataRequest,$err)) goto Err;
		
		//FETCH QUERY
		$customer_name="";
		$id_proforma="";
		if ($rowDataRequest = oci_fetch_array($getDataRequest, OCI_ASSOC))
		{
			$customer_name=$rowDataRequest["CUSTOMER_NAME"];
			$customer_id=$rowDataRequest["CUSTOMER_ID"];
			$id_proforma=$rowDataRequest["PRF_NUMBER"];
			$request_no_eservice=$rowDataRequest["REQUEST_ID"];
			
			//attachment part
			$hash = md5($request_no_eservice.$customer_id);
			$file_link = "http://intranet.indonesiaport.co.id/es_qa/index.php/container/download_proforma_delivery_atch/$request_no_eservice/$port_code/$terminal_code/$hash";
		}
		
		$html_data="Yth. $customer_name, <br/>
						<br/>
						Request Anda dengan Nomor Request $request_no_eservice/$request_no telah disetujui. Terlampir pranota untuk request anda. Pranota akan hangus dalam waktu 3 jam, silakan lakukan pembayaran sebelum pranota hangus. <br/>
						<br/>
						Pembayaran dapat dilakukan melalui portal dengan channel-channel bank antara lain Mandiri, BNI, BCA, dan CIMB Niaga.<br/>
						<br/>
						Untuk informasi dan bantuan lebih lanjut, mohon menghubungi Customer Service kami di nomor (021) 4301080 ext. 2713.<br/>
						<br/>
						Terima kasih,<br/>
						<br/>
						PT. Pelabuhan Tanjung Priok<br/>
						JL.Raya Pelabuhan No.8 Tanjung Priok Jakarta 14310<br/>
						DKI Jakarta, Indonesia<br/>
						www.priokport.co.id<br/>
						<br/>
						<br/>
						Dear $customer_name, <br/>
						<br/>
						Your booking request with request number $request_no_eservice/$request_no has been approved. Please find attached file for the generated Proforma document. Please be informed that Proforma will be expired within 3 hours, please perform payment before the Proforma is expired.<br/>
						<br/>
						Payment can be performed within the portal through the following banks : Mandiri, BNI, BCA, & CIMB Niaga.<br/>
						<br/>
						For any information and inquiries, please call our customer service at (021) 4301080 ext. 2713.<br/>
						<br/>
						Warm Regards,<br/>
						<br/>
						PT. Pelabuhan Tanjung Priok<br/>
						JL.Raya Pelabuhan No.8 Tanjung Priok Jakarta 14310<br/>
						DKI Jakarta, Indonesia<br/>
						www.priokport.co.id<br/>
						";
			
			$text_data="Yth. $customer_name, \n
								\n
								Request Anda dengan Nomor Request $request_no_eservice/$request_no telah disetujui. Terlampir pranota untuk request anda. Pranota akan hangus dalam waktu 3 jam, silakan lakukan pembayaran sebelum pranota hangus. \n
								\n
								Pembayaran dapat dilakukan melalui portal dengan channel-channel bank antara lain Mandiri, BNI, BCA, dan CIMB Niaga.\n
								\n
								Untuk informasi dan bantuan lebih lanjut, mohon menghubungi Customer Service kami di nomor (021) 4301080 ext. 2713.\n
								\n
								Terima kasih,\n
								\n
								PT. Pelabuhan Tanjung Priok\n
								JL.Raya Pelabuhan No.8 Tanjung Priok Jakarta 14310\n
								DKI Jakarta, Indonesia\n
								www.priokport.co.id\n
								\n
								\n
								Dear $customer_name, \n
								\n
								Your booking request with request number $request_no_eservice/$request_no has been approved. Please find attached file for the generated Proforma document. Please be informed that Proforma will be expired within 3 hours, please perform payment before the Proforma is expired.\n
								\n
								Payment can be performed within the portal through the following banks : Mandiri, BNI, BCA, & CIMB Niaga.\n
								\n
								For any information and inquiries, please call our customer service at (021) 4301080 ext. 2713.\n
								\n
								Warm Regards,\n
								\n
								PT. Pelabuhan Tanjung Priok\n
								JL.Raya Pelabuhan No.8 Tanjung Priok Jakarta 14310\n
								DKI Jakarta, Indonesia\n
								www.priokport.co.id\n";
		
		$subject="Delivery Extension Request Notification - $request_no_eservice";

		//mengambil data email
		$query_email="SELECT A.EMAIL, A.HANDPHONE FROM MST_USER A INNER JOIN transaction_log B ON A.USERNAME=B.request_by WHERE biller_request_id='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$query_email,$get_email,$err)) goto Err;
		//FETCH QUERY
		$email="";
		$handphone="";
		if ($row_email = oci_fetch_array($get_email, OCI_ASSOC))
		{
			$email=$row_email["EMAIL"];
			$handphone=$row_email["HANDPHONE"];
		}
		
		if($email!="")
		{
			$sendEmail = "INSERT INTO EMAIL_LG (FROM_EMAIL, TO_EMAIL, HTML_DATA, TEXT_DATA, SAVE_DATE, MODUL_NAME, SUBJECT_EMAIL,ATTACHMENT_LINK) VALUES ('', '$email', '$html_data', '$text_data', sysdate, 'receiving', '$subject','$file_link')";
			if(!checkOriSQL($conn['ori']['ibis'],$sendEmail,$getEmail,$err)) goto Err;
		}

		if($handphone!="")
		{
			$sendSMS = "INSERT INTO SMS_LG (MSISDN, TEXT, MODUL_NAME, SAVE_DATE) VALUES ('$handphone','Dear $customer_name \r\n The receiving request $request_no for container service already saved.','receiving', SYSDATE)";
			if(!checkOriSQL($conn['ori']['ibis'],$sendSMS,$getSMS,$err)) goto Err;
		}
		
		$out_data = array();
		$out_data['info']="OK,$out_message";
		
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