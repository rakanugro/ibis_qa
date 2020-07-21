<?php

/*|
 | Function Name 	: saveRequestDelivery
 | Description 		: Save for Request Delivery
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:  
 |*/
function saveRequestDelivery($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$no_request=$xml_data->data->no_request;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL

		//select connection
		$formatgroupconn='BILLING_'.$port_code.'_'.$terminal_code;
		$conn['ori']= oriDb('BILLING_'.$port_code.'_'.$terminal_code);
		$conn['ori']+= oriDb('IBIS');
		
		
		//generate no request		
		IF (($formatgroupconn=='BILLING_IDJKT_T3I') OR ($formatgroupconn=='BILLING_IDJKT_T009D'))
		{
			$bind_param = array(
					"out" => ""
					);
			$querySave1 ="BEGIN pkg_delivery_new.prc_crtmpdel('$no_request','NEW',:out); END;";
		}
		ELSE
		{
			$querySave1 ="BEGIN nota_delivery('$no_request','NEW'); END;";
		}
		

		if(!checkOriSQL($conn['ori']['billing'],$querySave1,$querySaveOut1,$err,$debug,$bind_param)){
			goto Err;
		}
		else
		{
				$querySave = "begin pack_nota_delivery.proc_header_nota_delivery('$no_request'); end;";
				
				
				if(!checkOriSQL($conn['ori']['billing'],$querySave,$saveRequest,$err,$debug,$bind_param)){
					goto Err;
				}
				else
				{
					
					if ($formatgroupconn=='BILLING_IDJKT_T009D'){
						$qr="select ID_PROFORMA ID_NOTA from nota_delivery_h where id_req='$no_request'";
					} else {
						$qr="select ID_NOTA from nota_delivery_h where id_req='$no_request'";
					}
					
					if(!checkOriSQL($conn['ori']['billing'],$qr,$qrout,$err,$debug,$bind_param)){
						goto Err;
					}else
					{
						if ($rowd = oci_fetch_array($qrout, OCI_ASSOC))
						{
							$id_proforma=$rowd["ID_NOTA"];
							
						}
					}
					
					$saveRequest = "UPDATE TRANSACTION_LOG SET STATUS_REQ='S', PRF_NUMBER='$id_proforma', PRF_DATE=SYSDATE
								WHERE BILLER_REQUEST_ID='$no_request'";
					
					if(!checkOriSQL($conn['ori']['ibis'],$saveRequest,$query_save,$err,$debug)) goto Err;
					
					$queryDataRequest="SELECT CUSTOMER_NAME FROM TRANSACTION_LOG WHERE BILLER_REQUEST_ID='$no_request'";
					if(!checkOriSQL($conn['ori']['ibis'],$queryDataRequest,$getDataRequest,$err,$debug)) goto Err;
					
					//FETCH QUERY
					$customer_name="";
					if ($rowDataRequest = oci_fetch_array($getDataRequest, OCI_ASSOC))
					{
						$customer_name=$rowDataRequest["CUSTOMER_NAME"];
						
					}
					
					$html_data="Yth. $customer_name yang kami hormati.<br/>
									<br/>
									Request Anda dengan Nomor Request $no_request telah disimpan dengan kode pembayaran $id_proforma. Pembayaran dapat dilakukan dengan channel-channel ATM dan Internet Banking Bank Mandiri seluruh Indonesia.<br/>
									<br/>
									Terima kasih,<br/>
									<br/>
									<br/>
									Dear Lovely Customer $customer_name,<br/>
									<br/>
									Your request with request number $no_request has been saved with payment code $id_proforma. Payment can be done with Bank Mandiri ATM channel or Intenet Banking around Indonesia.<br/>
									<br/>
									Thank You<br/>
									<br/>
									<br/>
									--<br/>
									Indonesia Port Corporation<br/>
									Jalan Pasoso No.1<br/>
									Tanjung Priok<br/>
									Indonesia<br/>";
						
						$text_data="Yth. $customer_name yang kami hormati.\n
										\n
										Request Anda dengan Nomor Request $no_request telah disimpan dengan kode pembayaran xxxxx. Pembayaran dapat dilakukan dengan channel-channel ATM dan Internet Banking Bank Mandiri seluruh Indonesia.\n
										\n
										Terima kasih,\n
										\n
										\n
										Dear Lovely Customer $customer_name,\n
										\n
										Your request with request number $no_request has been saved with payment code xxxxx. Payment can be done with Bank Mandiri ATM channel or Intenet Banking around Indonesia.\n
										\n
										Thank You\n
										\n
										\n
										--\n
										Indonesia Port Corporation\n
										Jalan Pasoso No.1\n
										Tanjung Priok\n
										Indonesia\n";
					
					$subject="IPC Delivery Request Notification - $no_request";
					
					//mengambil data email
					$query_email="SELECT A.EMAIL, A.HANDPHONE FROM MST_USER A INNER JOIN REQ_DELIVERY_H B ON A.USERNAME=B.ID_USER WHERE ID_REQ='$no_request'";
					if(!checkOriSQL($conn['ori']['ibis'],$query_email,$get_email,$err,$debug)) goto Err;
					//FETCH QUERY
					$email="";
					$handphone="";
					if ($row_email = oci_fetch_array($get_email, OCI_ASSOC))
					{
						$email=$row_email["EMAIL"];
						$handphone=$row_email["HANDPHONE"];
						
						$sendEmail = "INSERT INTO EMAIL_LG (FROM_EMAIL, TO_EMAIL, HTML_DATA, TEXT_DATA, SAVE_DATE, MODUL_NAME, SUBJECT_EMAIL) VALUES ('noreply@indonesiaport.co.id', '$email', '$html_data', '$text_data', sysdate, 'delivery', '$subject')";
						if(!checkOriSQL($conn['ori']['ibis'],$sendEmail,$getEmail,$err,$debug)) goto Err;
						
						$sendSMS = "INSERT INTO SMS_LG (MSISDN, TEXT, MODUL_NAME, SAVE_DATE) VALUES ('$handphone','Dear $customer_name \r\n The delivery request $no_request for container service already saved.','DELIVERY', SYSDATE)";
						if(!checkOriSQL($conn['ori']['ibis'],$sendSMS,$getSMS,$err,$debug)) goto Err;						
					}
					
					$out_data = array();
					$out_data['info']="OK,$out_message";

				} 		
		}
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