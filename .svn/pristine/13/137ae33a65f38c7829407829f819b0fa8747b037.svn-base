<?php

/*|
 | Function Name 	: requestReceivingHeader
 | Description 		: do Request Receiving Header
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function requestReceivingHeader($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$vessel = $xml_data->data->header->vessel;
		$peb_no = $xml_data->data->header->peb_no;
		$npe_no = $xml_data->data->header->npe_no;
		$booking_ship_no = $xml_data->data->header->booking_ship_no;
		$gate_in_date = $xml_data->data->header->gate_in_date;
		$customer_id = $xml_data->data->header->customer_id;
		$customer_name = $xml_data->data->header->customer_name;
		$customer_npwp = $xml_data->data->header->customer_npwp;
		$customer_address = $xml_data->data->header->customer_address;
		$customer_address = base64_decode($customer_address);
		$id_user = substr($xml_data->data->header->id_user,0,3);
		
		$port = $xml_data->data->header->port;
		$ports = explode("-",$port);
		$port_code=$ports[0];
		$terminal_code=$ports[1];
		
		$voyage_in = $xml_data->data->header->voyage_in;
		$voyage_out = $xml_data->data->header->voyage_out;
		$clossing_time_doc = $xml_data->data->header->clossing_time_doc;
		$open_stack = $xml_data->data->header->open_stack;
		$ukk = $xml_data->data->header->ukk;//ukk
		$pod_name = $xml_data->data->header->pod_name;
		$pod = $xml_data->data->header->pod;
		$fpod_name = $xml_data->data->header->fpod_name;
		$fpod = $xml_data->data->header->fpod;
		$trading_type = $xml_data->data->header->trading_type;
		$request_no = $xml_data->data->header->request_no;
		$receiving_type = $xml_data->data->header->receiving_type;
		$start_shift = $xml_data->data->header->start_shift;
		$end_shift = $xml_data->data->header->end_shift;
		$nospp = $xml_data->data->header->nospp;
		$nosuratjalan = $xml_data->data->header->nosuratjalan;
				
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";

		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("IBIS");		
		$conn['billing'][0] = $conn['ori']['billing'];
		
		if($request_no=="")
		{
			//generate no request eservice
			$query = "BEGIN ef_get_request_number 
							(
								'ANNE',
								'OL',
								'',
								:out_message
							); END;";
							
			$bind_param = array(
									':out_message' => ''
								);

			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug,$bind_param)) goto Err;

			$request_no = $bind_param[':out_message'];
			
			//biller
			
			if ($port_code=="IDJKT"&&$terminal_code=="T3I") 
			{
				$query = "BEGIN PROC_CREATE_ANNE 
								(
									:v_ukk, 
									:v_iemkl, 
									:v_ipod, 
									:v_ipol,
									:v_ship,  
									:v_npe, 
									:v_peb,
									:v_user, 
									:v_bookship,
									:v_car,
									:v_start_shift, 
									:v_end_shift, 
									:v_jml_shift,
									:v_fipod,
									:v_no_req,
									:v_msg
								); END;";
								
				$bind_param = array(
										':v_ukk' => "$ukk",
										':v_iemkl' => "$customer_id",
										':v_ipod' => "$pod",
										':v_ipol' => "IDJKT",
										':v_ship' => "$trading_type",
										':v_npe' => "$npe_no", 
										':v_peb' => "$peb_no",
										':v_user' => "$id_user",
										':v_bookship' => "$booking_ship_no",
										':v_car' => "IDJKT",
										':v_start_shift' => "$start_shift",
										':v_end_shift' => "$end_shift",
										':v_jml_shift' => "1",
										':v_fipod' => "$fpod",
										':v_no_req' => "",
										':v_msg' => ""
									);
									
			} else if ($port_code=="IDJKT"&&$terminal_code=="T009D") {
				$query = "BEGIN PROC_CREATE_ANNE 
								(
									:v_ukk, 
									:v_iemkl, 
									:v_ipod, 
									:v_ipol,
									:v_ship,  
									:v_no_surat_jalan,
									:v_no_spp,
									:v_user, 
									:v_ds,
									:v_car,
									:start_shift,
									:end_shift,
									:jml_shift,
									:fipod,
									:ter_code,
									:flagust,
									:v_no_req,
									:v_msg
								); END;";
								
				$bind_param = array(
										':v_ukk'=>"$ukk",
										':v_iemkl'=>"$customer_id",
										':v_ipod'=>"$pod",
										':v_ipol'=>"IDJKT",
										':v_ship'=>"$trading_type",
										':v_no_surat_jalan'=>"$nosuratjalan",  
										':v_no_spp'=>"$nospp", 
										':v_user'=>"$id_user",
										':v_ds'=>"$booking_ship_no",
										':v_car'=>"IDJKT",
										':start_shift'=>"$start_shift",
										':end_shift'=>"$end_shift",
										':jml_shift'=>"1",
										':fipod'=>"$fpod",
										':ter_code'=>"009",
										':flagust'=>"",
										':v_no_req'=>"",
										':v_msg'=>"");
			}
			ELSE
			{
				$query = "BEGIN PROC_CREATE_ANNE 
								(
									:v_ukk, 
									:v_iemkl, 
									:v_ipod, 
									:v_ipol,
									:v_ship,  
									:v_user, 
									:v_bookship,
									:v_car,
									:v_start_shift, 
									:v_end_shift, 
									:v_jml_shift,
									:v_fipod,
									:v_tlflag,
									:v_no_req,
									:v_msg
								); END;";
								
				$bind_param = array(
										':v_ukk' => "$ukk",
										':v_iemkl' => "$customer_id",
										':v_ipod' => "$pod",
										':v_ipol' => "IDJKT",
										':v_ship' => "$trading_type",
										':v_user' => "$id_user",
										':v_bookship' => "$booking_ship_no",
										':v_car' => "IDJKT",
										':v_start_shift' => "$start_shift",
										':v_end_shift' => "$end_shift",
										':v_jml_shift' => "1",
										':v_fipod' => "$fpod",
										':v_tlflag' => "$receiving_type",
										':v_no_req' => "",
										':v_msg' => ""
									);
			}
			
			
			
			if(!checkOriSQL($conn['billing'][0],$query,$query_,$err,$debug,$bind_param)) goto Err;

			$biller_request_no = $bind_param[':v_no_req'];
			$v_msg = $bind_param[':v_msg'];
			
			if($v_msg!="OK")
			{
				$err = $v_msg;
				goto Err;
			}
			
			if($biller_request_no!="")
			{
				//update remark
				$query = "update req_receiving_h set id_req_ol = '$request_no' where id_req = '$biller_request_no'";
				if(!checkOriSQL($conn['billing'][0],$query,$query_,$err,$debug,$bind_param)) goto Err;
				
				//ibis
				$query = "insert into transaction_log (REQUEST_ID,BILLER_REQUEST_ID, KODE_MODUL,MODUL_DESC,PORT_ID,TERMINAL_ID,STATUS_REQ
														,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID
														,CUSTOM_NUMBER1,CUSTOM_NUMBER2,ADDITIONAL_FIELD1,ADDITIONAL_FIELD2,ADDITIONAL_FIELD3
														,REQUEST_DATE,REQUEST_BY,PRF_NUMBER,PRF_DATE,TRX_NUMBER,TRX_DATE
														,PAYMENT_BY,PAYMENT_DATE,PAYMENT_STATUS,PAYMENT_CHANNEL,
														NO_UKK, VESSEL, VOYAGE_IN, VOYAGE_OUT, NO_SPP, NO_SURATJALAN
														)
				values
				(TRIM('$request_no'), TRIM('$biller_request_no'), 'PTKM00','RECEIVING','$port_code', '$terminal_code', 'N'
					,'$customer_id', '$customer_name', '$customer_address', '$customer_npwp'
					,'$npe_no', '$peb_no', '$booking_ship_no','' ,'$fpod' 
					,SYSDATE, '$id_user', '' , '', '' ,''
					,'', '', '', ''
					,'$ukk','$vessel','$voyage_in','$voyage_out','$nospp','$nosuratjalan'
				)";
				
				//QUERY //insert into table request
				if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
			}
		}

		//DATA
		$data = array(
						'request_no' => $request_no
					);

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
		rollbackOriDb($conn['ori']);
		//commitOriDb($conn['ori']);
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