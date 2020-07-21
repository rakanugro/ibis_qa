<?php 

/*|
 | Function Name 	: saveRequestBatalMuat
 | Description 		: saveRequestBatalMuat
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function saveRequestBatalMuat($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$idreq = $xml_data->data->no_request;
		$port_code= $xml_data->data->port_code;
		$terminal_code= $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();		
		
		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		if (($port_code == 'IDJKT') && ($terminal_code == 'T009D'))
		{
			$query_getheader = "SELECT a.id_req id_batalmuat,
								   a.ID_FPOD,
								   a.vessel,
								   a.voyage_in voyage,
								   a.voyage_out,
								   a.pengguna,
								   a.jenis,
								   CASE
									  WHEN a.jenis = 'B' THEN 'CALBG'
									  WHEN a.jenis = 'A' THEN 'CALAG'
									  ELSE 'CALDG'
								   END
									  TIPE_BM,
								   a.EMKL,
								   a.SHIPPING_LINE,
								   a.tgl_berangkat2
							  FROM REQ_BATALMUAT_H a
							 WHERE a.ID_REQ = '$idreq'";
		
		} else {
		
			$query_getheader = "SELECT a.id_batalmuat,
									   a.ID_FPOD,
									   a.vessel,
									   a.voyage,
									   a.voyage_out,
									   a.pengguna,
									   a.jenis,
									   CASE
										  WHEN a.jenis = 'B' THEN 'CALBG'
										  WHEN a.jenis = 'A' THEN 'CALAG'
										  ELSE 'CALDG'
									   END
										  TIPE_BM,
									   a.EMKL,
									   a.SHIPPING_LINE,
									   a.tgl_berangkat2
								  FROM TB_BATALMUAT_H a
								 WHERE a.ID_BATALMUAT = '$idreq'";
		
		}
			if(!checkOriSQL($conn['ori']['billing'],$query_getheader,$getheader,$err,$bind_param)) goto Err;
			if ($rowheader = oci_fetch_array($getheader, OCI_ASSOC))
			{
				$tipebm   	   = $rowheader["JENIS"];
				$idbatalmuat   = $rowheader["ID_BATALMUAT"];
			}

			if ($tipebm == 'CALBG'){
				$sql_xpi = "BEGIN PROC_BATALMUAT('$idbatalmuat','$tipebm'); COMMIT; END;";
			}
			else {
				$sql_xpi = "BEGIN PROC_BM_AFTERGATEIN('$idbatalmuat','$tipebm'); COMMIT; END;";
			}
			
			if(!checkOriSQL($conn['ori']['billing'],$sql_xpi,$sql_xpi_,$err)) goto Err;
			
			$sql_xpiz="begin pack_nota_batmuat.proc_header_nota_batmuat(trim('$idreq')); COMMIT; end;";
			if(!checkOriSQL($conn['ori']['billing'],$sql_xpiz,$sql_xpiz_,$err)) goto Err;
			
			if (($port_code == 'IDJKT') && ($terminal_code == 'T009D'))
			{
				$qr="select ID_PROFORMA NO_NOTA from nota_batalmuat_h where ID_REQ='$idbatalmuat'";
			} else {
				$qr="select NO_NOTA from nota_batalmuat_h where ID_BATALMUAT='$idbatalmuat'";
			}
			
			if(!checkOriSQL($conn['ori']['billing'],$qr,$getqr,$err,$bind_param)) goto Err;
					if ($rowgetqr = oci_fetch_array($getqr, OCI_ASSOC))
					{
						$id_proforma=$rowgetqr["NO_NOTA"];
					}
					
		
			$saveRequest = "UPDATE TRANSACTION_LOG SET STATUS_REQ='S', PRF_NUMBER='$id_proforma', PRF_DATE=SYSDATE, LAST_USER_ACTIVITY_CODE = 'APPROVE_REQUEST', LAST_USER_ACTIVITY_USERID = '$user_id' 
								WHERE BILLER_REQUEST_ID='$idreq'";
					
			if(!checkOriSQL($conn['ori']['ibis'],$saveRequest,$query_save,$err)) goto Err;
			
			$queryDataRequest="SELECT * FROM TRANSACTION_LOG WHERE BILLER_REQUEST_ID='$idreq'";
			if(!checkOriSQL($conn['ori']['ibis'],$queryDataRequest,$getDataRequest,$err)) goto Err;
			
			//FETCH QUERY
			$customer_name="";
			if ($rowDataRequest = oci_fetch_array($getDataRequest, OCI_ASSOC))
			{
				$customer_name=$rowDataRequest["CUSTOMER_NAME"];
				$customer_id=$rowDataRequest["CUSTOMER_ID"];
				$id_proforma=$rowDataRequest["PRF_NUMBER"];
				$request_no_eservice=$rowDataRequest["REQUEST_ID"];
				
				//attachment part
				$hash = md5($request_no_eservice.$customer_id);
				$file_link = "http://intranet.indonesiaport.co.id/es_qa/index.php/container_alihkapal/download_proforma_bm_atch/$request_no_eservice/$port_code/$terminal_code/$hash";
			}
			
		$html_data="Yth. $customer_name, <br/>
						<br/>
						Request Anda dengan Nomor Request $request_no_eservice/$idreq telah disetujui. Terlampir pranota untuk request anda. Pranota akan hangus dalam waktu 3 jam, silakan lakukan pembayaran sebelum pranota hangus. <br/>
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
						Your booking request with request number $request_no_eservice/$idreq has been approved. Please find attached file for the generated Proforma document. Please be informed that Proforma will be expired within 3 hours, please perform payment before the Proforma is expired.<br/>
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
								Request Anda dengan Nomor Request $request_no_eservice/$idreq telah disetujui. Terlampir pranota untuk request anda. Pranota akan hangus dalam waktu 3 jam, silakan lakukan pembayaran sebelum pranota hangus. \n
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
								Your booking request with request number $request_no_eservice/$idreq has been approved. Please find attached file for the generated Proforma document. Please be informed that Proforma will be expired within 3 hours, please perform payment before the Proforma is expired.\n
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
			
			$subject="Loading Cancel Request Notification - $request_no_eservice";
			
			//mengambil data email
			$query_email="SELECT A.EMAIL, A.HANDPHONE FROM MST_USER A INNER JOIN transaction_log B ON A.USERNAME=B.request_by WHERE biller_request_id='$idreq'";
			if(!checkOriSQL($conn['ori']['ibis'],$query_email,$get_email,$err)) goto Err;
			//FETCH QUERY
			$email="";
			$handphone="";
			if ($row_email = oci_fetch_array($get_email, OCI_ASSOC))
			{
				$email=$row_email["EMAIL"];
				$handphone=$row_email["HANDPHONE"];
				
				if($email!="")
				{
					$sendEmail = "INSERT INTO EMAIL_LG (FROM_EMAIL, TO_EMAIL, HTML_DATA, TEXT_DATA, SAVE_DATE, MODUL_NAME, SUBJECT_EMAIL,ATTACHMENT_LINK) VALUES ('', '$email', '$html_data', '$text_data', sysdate, 'loading_cancel', '$subject','$file_link')";
					if(!checkOriSQL($conn['ori']['ibis'],$sendEmail,$getEmail,$err)) goto Err;
				}
				
				if($handphone!="")
				{
					$sendSMS = "INSERT INTO SMS_LG (MSISDN, TEXT, MODUL_NAME, SAVE_DATE) VALUES ('$handphone','Dear $customer_name \r\n The delivery request $no_request for container service already saved.','DELIVERY', SYSDATE)";
					if(!checkOriSQL($conn['ori']['ibis'],$sendSMS,$getSMS,$err)) goto Err;
				}
			}			
			

		
			$out_data = array();
			$out_data['data']='OK';
				
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