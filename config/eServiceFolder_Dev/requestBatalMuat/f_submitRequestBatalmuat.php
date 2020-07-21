<?php

/*|
 | Function Name 	: submitRequestBatalmuat
 | Description 		: do Request Batal muat
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function submitRequestBatalmuat($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$vessel = $xml_data->data->detail->vessel;
		$voyage_in = $xml_data->data->detail->voyage_in;
		$voyage_out = $xml_data->data->detail->voyage_out;
		$fpod = $xml_data->data->detail->fpod;
		$id_fpod = $xml_data->data->detail->id_fpod;
		$pod = $xml_data->data->detail->pod;
		$id_pod = $xml_data->data->detail->id_pod;
		$booknum = $xml_data->data->detail->booknum;
		$customer_id = $xml_data->data->detail->customer_id;
		$shipping_line = $xml_data->data->detail->shipping_line;
		$etd = $xml_data->data->detail->etd;
		$customer_name = $xml_data->data->detail->customer_name;
		$cust_alamat = $xml_data->data->detail->cust_alamat;
		$cust_npwp = $xml_data->data->detail->cust_npwp;
		$no_ukk_baru = $xml_data->data->detail->no_ukk_baru;
		$tipebm = $xml_data->data->detail->tipebm;
		$uname_phd = $xml_data->data->detail->uname_phd;
		$tgl_delivery = $xml_data->data->detail->tgl_delivery;
		
		$port_code= $xml_data->data->detail->port_code;
		$terminal_code= $xml_data->data->detail->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();		
		
		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		//memasukkan data ke tabel header
		
			$query = "BEGIN ef_get_request_number 
							(
								'LC',
								'OL',
								'',
								:out_message
							); END;";
							
			$bind_param = array(
									':out_message' => ''
								);

			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug,$bind_param)) goto Err;

			$request_no = $bind_param[':out_message'];
		
			if ($tipebm == 'CALBG'){
					$tipe = 'B';
				} else {
					$tipe= 'A';
				}	
				
			if (($tipebm == 'CALBG') OR ($tipebm == 'CALAG')){
					$tgl = $etd;
				} else {
					$tgl = $tgl_delivery;
				}	
	
			if (($terminal_code == 'T3I') OR ($terminal_code == '009D')){
				$sql_vc = "INSERT INTO TB_BATALMUAT_H 
				(ID_REQ_OL,
				 KODE_PBM, 
				 JENIS, 
				 VESSEL, 
				 VOYAGE,
				 VOYAGE_OUT,				 
				 SHIPPING_LINE,
				 PENGGUNA, 
				 STATUS, 
				 TGL_BERANGKAT2, 
				 EMKL, 
				 ALAMAT, 
				 NPWP, 
				 KET, 
				 BOOKING_NUMB,
				 FPOD,
				 ID_FPOD) 
				VALUES ('$request_no','$customer_id','$tipe', '$vessel', '$voyage_in', '$voyage_out','$shipping_line', '$uname_phd', 'N', TO_DATE('$tgl','dd/mm/rrrr hh24:mi:ss'), '$customer_name', 
				'$cust_alamat', '$cust_npwp', '','$booknum','$fpod','$id_fpod')";
			
			} else {
				$sql_vc = "INSERT INTO TB_BATALMUAT_H 
				(ID_REQ_OL,
				 KODE_PBM, 
				 JENIS, 
				 VESSEL, 
				 VOYAGE,
				 VOYAGE_OUT,				 
				 SHIPPING_LINE,
				 PENGGUNA, 
				 STATUS, 
				 TGL_BERANGKAT2, 
				 EMKL, 
				 ALAMAT, 
				 NPWP, 
				 KET, 
				 BOOKING_NUMB,
				 FPOD,
				 ID_FPOD,
				 NO_UKK,
				 POD,
				ID_POD) 
				VALUES ('$request_no','$customer_id','$tipe', '$vessel', '$voyage_in', '$voyage_out','$shipping_line', '$uname_phd', 'N', TO_DATE('$tgl','dd/mm/rrrr hh24:mi:ss'), '$customer_name', 
				'$cust_alamat', '$cust_npwp', '','$booknum','$fpod','$id_fpod','$no_ukk_baru','$pod','$id_pod')";
			}
				//history
				$sql_h = "INSERT INTO HISTORY_ALL (ID, ID_REQUEST, ID_USER, NAMA_TABEL, KETERANGAN, IP_CLIENT, SQL) VALUES (GET_IDHIST,'".$request_no."','".$uname_phd."','BMAK_REQUEST','ENTRY HEADER BATALMUAT','".$_SERVER['REMOTE_ADDR']."','".str_replace("'",'"',$sql_vc)."')";
				
				//ibis 
				// cuma masuk ke transaction log 
				/*$q_insert = "INSERT INTO REQ_BATALMUAT_H(ID_REQ, KODE_PBM, JENIS, 
									   VESSEL, VOYAGE, TGL_REQ, 
									   PENGGUNA, STATUS, 
									   TGL_BERANGKAT2, EMKL, ALAMAT, 
									   NPWP, SHIPPING_LINE, VOYAGE_OUT, BOOKING_NUMB, FPOD, 
									   ID_FPOD, NO_UKK)
									   VALUES('$request_no','$customer_id','B', '$vessel','$voyage_in',SYSDATE,'$customer_id','N',
									   TO_DATE('$etd','dd/mm/rrrr hh24:mi:ss'),'$customer_name','$cust_alamat','$cust_npwp','$shipping_line','$voyage_out',
									   '$booknum','$fpod','$id_fpod','$no_ukk_baru')";
				if(!checkOriSQL($conn['ori']['billing'],$q_insert,$q_insert_,$err,$debug)) goto Err;
				*/
			
				try {
					if(!checkOriSQL($conn['ori']['billing'],$sql_vc,$sql_vc_,$err,$debug)) goto Err; 
					if(!checkOriSQL($conn['ori']['billing'],$sql_h,$sql_h_,$err,$debug)) goto Err;
					
					if (($terminal_code == 'T3I') OR ($terminal_code == '009D')){
					$query_getreq = "SELECT TRIM(MAX(ID_BATALMUAT)) ID_BATALMUAT FROM TB_BATALMUAT_H WHERE KODE_PBM ='$customer_id' AND JENIS = '$tipe'";
					} else {
					$query_getreq = "SELECT TRIM(MAX(ID_BATALMUAT)) ID_BATALMUAT FROM TB_BATALMUAT_H WHERE KODE_PBM ='$customer_id' AND JENIS = '$tipe' AND NO_UKK = '$no_ukk_baru'";
					}
					if(!checkOriSQL($conn['ori']['billing'],$query_getreq,$getNoRequest,$err,$debug,$bind_param)) goto Err;
					if ($rowDataRequest = oci_fetch_array($getNoRequest, OCI_ASSOC))
					{
						$biller_request_no=$rowDataRequest["ID_BATALMUAT"];
					}
		
						//ibis
					$cusnumber1 = '';
					$cusnumber2 = '';
					$query = "insert into transaction_log (REQUEST_ID,BILLER_REQUEST_ID, KODE_MODUL,MODUL_DESC,PORT_ID,TERMINAL_ID,STATUS_REQ
															,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID
															,CUSTOM_NUMBER1,CUSTOM_NUMBER2,ADDITIONAL_FIELD1,ADDITIONAL_FIELD2,ADDITIONAL_FIELD3
															,REQUEST_DATE,REQUEST_BY,PRF_NUMBER,PRF_DATE,TRX_NUMBER,TRX_DATE
															,PAYMENT_BY,PAYMENT_DATE,PAYMENT_STATUS,PAYMENT_CHANNEL,
															NO_UKK, VESSEL, VOYAGE_IN, VOYAGE_OUT
															)
					values
					(TRIM('$request_no'), TRIM('$biller_request_no'), 'PTKM08','$tipebm','$port_code', '$terminal_code', 'N','$customer_id', '$customer_name', '$cust_alamat', '$cust_npwp','$cusnumber1', '$cusnumber2', '','$booknum' ,'$fpod' ,SYSDATE, '$uname_phd', '' , '', '' ,'','', '', '', '','$no_ukk_baru','$vessel','$voyage_in','$voyage_out'
					)";
					
					//QUERY //insert into table request
					if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;

				}
				catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
				}

			
		$data = 'OK,'.$request_no;


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