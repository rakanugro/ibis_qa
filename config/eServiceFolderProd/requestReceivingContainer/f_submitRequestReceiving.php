<?php

/*|
 | Function Name 	: submitRequestReceiving
 | Description 		: do Request Receiving
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function submitRequestReceiving($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$request_no = $xml_data->data->detail->request_no;
		$port_code= $xml_data->data->detail->port_code;
		$terminal_code= $xml_data->data->detail->terminal_code;
		$user_id= $xml_data->data->detail->user_id;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		
		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("CONTAINER_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("IBIS");
		
		$query = "SELECT TGL_STACK,  TGL_OPEN_STACK, SHIFT_REEFER, CASE WHEN (TRUNC(SYSDATE) <= TRUNC(CLOSSING_TIME)) THEN 'YES' ELSE 'NO' END VALID_TIME FROM req_receiving_h  WHERE ID_REQ = '$request_no'";
		//return $query;
		//QUERY
		if(!checkOriSQL($conn['ori']['billing'],$query,$query_vessel,$err)) goto Err;
		//FETCH QUERY
		$row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC);
		$tgl_stack = $row_vessel[TGL_STACK];
		$tgl_openstack = $row_vessel[TGL_OPEN_STACK];
		$vldtime = $row_vessel[VALID_TIME];
		
		//seharusnya ada validasi clossing time
		if($vldtime == 'NO'){
			$data = array(
						'request_no' => 'Sudah Closing Time'
			);
		}
		
		$parameter= array(
                    "norequest"=>"$request_no",
					"tgl_stack"=>"$tgl_stack",
					"tgl_openstack"=>"$tgl_openstack"
					);
		$sql_xpi = "declare begin nota_anne_v6(:norequest,to_date(:tgl_stack,'dd/mm/rrrr'),to_date(:tgl_openstack,'dd/mm/rrrr')); commit; end;";
		if(!checkOriSQL($conn['ori']['billing'],$sql_xpi,$query_xpi,$err,$parameter)) goto Err; 
		
		$sql_upd = "update req_receiving_h set is_edit=0 where id_req='$request_no'";
		if(!checkOriSQL($conn['ori']['billing'],$sql_upd,$query_upd,$err)) goto Err; 
		
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$paramsave = array(
						"norequest" => "$request_no",
						"iduser" => "$port_code",
						"ter_code" => "009"
						);
						//return $paramsave;
			$sql_save="declare begin pack_nota_receiving.proc_header_nota_receiving(:norequest,:iduser,:ter_code); commit; end;";

		} else {
			$paramsave = array(
						"norequest" => "$request_no",
						"iduser" => "$port_code"
						);
			$sql_save="declare begin pack_nota_receiving.proc_header_nota_receiving(:norequest,:iduser); commit; end;";
		}
		//DATA
		if(!checkOriSQL($conn['ori']['billing'],$sql_save,$query_save,$err,$paramsave)) goto Err; 
		
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
		
			$qget_nonota = "select id_proforma from nota_receiving_h where id_req = '$request_no' order by date_insert desc";
			if(!checkOriSQL($conn['ori']['billing'],$qget_nonota,$qget_nonota_,$err)) goto Err; 
			$row_nonota = oci_fetch_array($qget_nonota_, OCI_ASSOC);
			$new_proforma = $row_nonota["ID_PROFORMA"];
		
		} else {
			$qget_nonota = "select id_nota from nota_receiving_h where id_req = '$request_no' order by date_insert desc";
			if(!checkOriSQL($conn['ori']['billing'],$qget_nonota,$qget_nonota_,$err)) goto Err; 
			$row_nonota = oci_fetch_array($qget_nonota_, OCI_ASSOC);
			$new_proforma = $row_nonota["ID_NOTA"];
		}

		//update data di ibis
		$upd_ibis = "update transaction_log set STATUS_REQ = 'S', PRF_NUMBER = '$new_proforma', PRF_DATE = sysdate, LAST_USER_ACTIVITY_CODE = 'APPROVE_REQUEST', LAST_USER_ACTIVITY_USERID = '$user_id' where BILLER_REQUEST_ID='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$upd_ibis,$query_ibis,$err)) goto Err; 
		
		$data = array(
						'request_no' => $request_no
					);

		$queryDataRequest="SELECT * FROM transaction_log WHERE BILLER_REQUEST_ID='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$queryDataRequest,$getDataRequest,$err)) goto Err;
		
		
		//MENGIRIM NOTIFIKASI EMAIL DAN SMS
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
			$file_link = "http://intranet.indonesiaport.co.id/es_qa/index.php/container_receiving/print_proforma_atch/$request_no_eservice/$port_code/$terminal_code/$hash";
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
		
		$subject="Receiving Request Notification - $request_no_eservice";
		
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
			$sendSMS = "INSERT INTO SMS_LG (MSISDN, TEXT, MODUL_NAME, SAVE_DATE) VALUES ('$handphone','Dear $customer_name, The receiving request $request_no_eservice/$request_no for container service already approved.','receiving', SYSDATE)";
			if(!checkOriSQL($conn['ori']['ibis'],$sendSMS,$getSMS,$err)) goto Err;
		}
		
		$out_data = array();
		$out_data['data']=$data;
		
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