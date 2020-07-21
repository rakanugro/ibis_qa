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
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("IBIS");
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];
		}

        $sql_xpi = "BEGIN nota_delivery('$request_no','EXT'); END;";
        
        if(!checkOriSQL($conn['billing'][0],$sql_xpi,$sql_xpi_,$err,$debug)) goto Err; 
        
        //tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
        
		// check nota_delivery_h
		$query = "SELECT COUNT(1) JML FROM nota_delivery_h WHERE TRIM(ID_REQ) = TRIM('$request_no') AND STATUS <> 'X'";
        
		if(!checkOriSQL($conn['billing'][0],$query,$query_,$err,$debug)) goto Err; 
		//FETCH QUERY
		$row_ = oci_fetch_array($query_, OCI_ASSOC);
		
		$sql_upd = "update req_delivery_h set is_edit=0 where id_req='$request_no'";
		if(!checkOriSQL($conn['billing'][0],$sql_upd,$query_upd,$err,$debug)) goto Err; 
		
        if ($row_['JML'] <= 0) {
            $sql_xpi="begin pack_nota_delivery.proc_header_nota_delivery('$request_no'); end;";
            
            if(!checkOriSQL($conn['billing'][0],$sql_xpi,$query_xpi,$err,$debug,$parameter)) goto Err; 
        }
        
		$qget_nonota = "select id_nota from nota_delivery_h where id_req = '$request_no' order by date_insert desc";
		if(!checkOriSQL($conn['billing'][0],$qget_nonota,$qget_nonota_,$err,$debug)) goto Err; 
		$row_nonota = oci_fetch_array($qget_nonota_, OCI_ASSOC);
		$new_proforma = $row_nonota["ID_NOTA"];
		
        
		//test ibis
		$test_q = "select * from dual";
		if(!checkOriSQL($conn['ori']['ibis'],$test_q,$test_q_,$err,$debug)) goto Err; 
        
		//update data di ibis
		$upd_ibis = "update transaction_log set STATUS_REQ = 'S', PRF_NUMBER = '$new_proforma', PRF_DATE = sysdate where BILLER_REQUEST_ID='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$upd_ibis,$query_ibis,$err,$debug)) goto Err; 
		
		$data = array(
            'request_no' => $request_no
        );

		$queryDataRequest="SELECT * FROM transaction_log WHERE BILLER_REQUEST_ID='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$queryDataRequest,$getDataRequest,$err,$debug)) goto Err;
		
		//FETCH QUERY
		$customer_name="";
		$id_proforma="";
		if ($rowDataRequest = oci_fetch_array($getDataRequest, OCI_ASSOC))
		{
			$customer_name=$rowDataRequest["CUSTOMER_NAME"];
			$id_proforma=$rowDataRequest["PRF_NUMBER"];
		}
		
		$html_data="Yth. $customer_name yang kami hormati.<br/>
						<br/>
						Request Anda dengan Nomor Request $request_no telah disimpan dengan kode pembayaran $id_proforma. Pembayaran dapat dilakukan dengan channel-channel ATM dan Internet Banking Bank Mandiri seluruh Indonesia.<br/>
						<br/>
						Terima kasih,<br/>
						<br/>
						<br/>
						Dear Lovely Customer $customer_name,<br/>
						<br/>
						Your request with request number $request_no has been saved with payment code $id_proforma. Payment can be done with Bank Mandiri ATM channel or Intenet Banking around Indonesia.<br/>
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
							Request Anda dengan Nomor Request $request_no telah disimpan dengan kode pembayaran $id_proforma. Pembayaran dapat dilakukan dengan channel-channel ATM dan Internet Banking Bank Mandiri seluruh Indonesia.\n
							\n
							Terima kasih,\n
							\n
							\n
							Dear Lovely Customer $customer_name,\n
							\n
							Your request with request number $request_no has been saved with payment code $id_proforma. Payment can be done with Bank Mandiri ATM channel or Intenet Banking around Indonesia.\n
							\n
							Thank You\n
							\n
							\n
							--\n
							Indonesia Port Corporation\n
							Jalan Pasoso No.1\n
							Tanjung Priok\n
							Indonesia\n";
		
		$subject="IPC Receiving Request Notification - $request_no";
		
		//mengambil data email
		$query_email="SELECT A.EMAIL, A.HANDPHONE FROM MST_USER A INNER JOIN REQ_RECEIVING_H B ON A.USERNAME=B.ID_USER WHERE ID_REQ='$request_no'";
		if(!checkOriSQL($conn['ori']['ibis'],$query_email,$get_email,$err,$debug)) goto Err;
		//FETCH QUERY
		$email="";
		$handphone="";
		if ($row_email = oci_fetch_array($get_email, OCI_ASSOC))
		{
			$email=$row_email["EMAIL"];
			$handphone=$row_email["HANDPHONE"];
		}
		
		$sendEmail = "INSERT INTO EMAIL_LG (FROM_EMAIL, TO_EMAIL, HTML_DATA, TEXT_DATA, SAVE_DATE, MODUL_NAME, SUBJECT_EMAIL) VALUES ('noreply@indonesiaport.co.id', '$email', '$html_data', '$text_data', sysdate, 'receiving', '$subject')";
		if(!checkOriSQL($conn['ori']['ibis'],$sendEmail,$getEmail,$err,$debug)) goto Err;
		
		$sendSMS = "INSERT INTO SMS_LG (MSISDN, TEXT, MODUL_NAME, SAVE_DATE) VALUES ('$handphone','Dear $customer_name \r\n The receiving request $request_no for container service already saved.','receiving', SYSDATE)";
		if(!checkOriSQL($conn['ori']['ibis'],$sendSMS,$getSMS,$err,$debug)) goto Err;
		
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