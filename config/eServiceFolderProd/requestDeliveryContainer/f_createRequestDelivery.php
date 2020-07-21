<?php

/*|
 | Function Name 	: createRequestDelivery
 | Description 		: Create a header for Request Delivery
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function createRequestDelivery($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$type_req=$xml_data->data->type_req;
		$sp2p_number=$xml_data->data->sp2p_number;
		$old_req=$xml_data->data->old_req;
		$id_ves_voyage=$xml_data->data->id_ves_voyage;
		$vessel=$xml_data->data->vessel;
		$vessel_code=$xml_data->data->vessel_code;
		$call_sign=$xml_data->data->call_sign;
		$voyage_in=$xml_data->data->voyage_in;
		$voyage_out=$xml_data->data->voyage_out;
		$customer_id=$xml_data->data->customer_id;
		$customer_name=$xml_data->data->customer_name;
		$address=$xml_data->data->address;
		$npwp=$xml_data->data->npwp;
		$status=$xml_data->data->status;
		$no_do=$xml_data->data->no_do;
		$date_do=$xml_data->data->date_do;
		$no_sppb=$xml_data->data->no_sppb;
		$date_sppb=$xml_data->data->date_sppb;
		$no_sp_custom=$xml_data->data->no_sp_custom;
		$date_sp_custom=$xml_data->data->date_sp_custom;
		$no_bl=$xml_data->data->no_bl;
		$date_delivery=$xml_data->data->date_delivery;
		$date_ext=$xml_data->data->date_ext;
		$date_old_del=$xml_data->data->date_old_del;
		$date_discharge=$xml_data->data->date_discharge;
		$date_request=$xml_data->data->date_request;
		$id_user=$xml_data->data->id_user;
		$id_user_eservice=$xml_data->data->id_user_eservice;
		$quantity=$xml_data->data->quantity;
		$remark=$xml_data->data->remark;
		$is_edit=$xml_data->data->is_edit;
		$delivery_type=$xml_data->data->delivery_type;
		$tl_flag='N';
		if($delivery_type=='TL'){
			$tl_flag='Y';
		}

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$conn['ori']= array();
		
		$request_no="";
		
		//PL/SQL
		$address = base64_decode($address);
				
		//select connection
		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");

		//START PROGRAM
		//generate no request eservice
		$query = "BEGIN ef_get_request_number 
						(
							'REQ',
							'OL',
							'',
							:out_message
						); END;";

		$bind_param = array(
								':out_message' => ''
							);

		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$bind_param)) goto Err;

		$request_no = $bind_param[':out_message'];
			
		//entry ke billing nbs
		if ($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$query = "BEGIN PROC_CREATE_DELIVERY 
							(
								:v_jenis_sppb,
								:v_call_sign,
								:v_id_ves_scd,
								:v_vessel,
								:v_vin,
								:v_vout,
								:v_start_work,
								:v_iemkl,
								:v_sppb,
								:v_tglsppb,
								:v_ndo,
								:v_tgldo,
								:v_tgldel,
								:v_ship,
								:v_via,
								:v_ket,
								:v_user,
								:v_spcust,
								:v_tglspcust,
								:v_blnumb,
								:v_cargow,
								:v_icargow,
								:v_no_req,
								:v_msg
							); END;";
							
			$bind_param = array(
								':v_jenis_sppb' => "1",
								':v_call_sign' => "$vessel_code",
								':v_id_ves_scd' => "$id_ves_voyage",
								':v_vessel' => "$vessel",
								':v_vin' => "$voyage_in",
								':v_vout' => "$voyage_out",
								':v_start_work' => "$date_discharge",
								':v_iemkl' => "$customer_id",
								':v_sppb' => "$no_sppb",
								':v_tglsppb' => "$date_sppb",
								':v_ndo' => "$no_do",
								':v_tgldo' => "$date_do",
								':v_tgldel' => "$date_delivery",
								':v_ship' => "I",
								':v_via' => "$delivery_type",
								':v_ket' => "",
								':v_user' => "$id_user",
								':v_spcust' => "$no_sp_custom",
								':v_tglspcust' => "$date_sp_custom",
								':v_blnumb' => "$no_bl",
								':v_cargow' => "$customer_name",
								':v_icargow' => "$customer_id",
								':v_no_req' => "",
								':v_msg' => ""
							);
							
		} else if ($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$query = "BEGIN PROC_CREATE_DELIVERY 
							(
								:v_tipe_req_cont,
								:v_terminal_id,
								:v_jenis_sppb,
								:v_callsign,
								:v_idvesscd,
								:v_ves,
								:v_vin,
								:v_vout,
								:v_ddsc,
								:v_iemkl,
								:v_sppb,
								:v_tglsppb,
								:v_ndo,
								:v_tgldo,
								:v_tgldel,
								:v_ship,
								:v_via,
								:v_ket,
								:v_user,
								:v_spcust,
								:v_tgl_spcust,
								:v_blnumb,
								:v_cargow,
								:v_icargow,
								:v_no_req,
								:v_msg
							); END;";
							
			$bind_param = array(
								':v_tipe_req_cont'=>"",
								':v_terminal_id'=>"009",
								':v_jenis_sppb'=>"",
								':v_callsign'=>"$call_sign",
								':v_idvesscd'=>"$id_ves_voyage",
								':v_ves'=>"$vessel",
								':v_vin'=>"$voyage_in",
								':v_vout'=>"$voyage_out",
								':v_ddsc'=>"$date_discharge",
								':v_iemkl'=>"$customer_id",
								':v_sppb'=>"$no_sppb",
								':v_tglsppb'=>"$date_sppb",
								':v_ndo'=>"$no_do",
								':v_tgldo'=>"$date_do",
								':v_tgldel'=>"$date_delivery",
								':v_ship'=>"I",
								':v_via'=>"$delivery_type",
								':v_ket'=>"",
								':v_user'=>"$id_user",
								':v_spcust'=>"$no_sp_custom",
								':v_tgl_spcust'=>"$date_sp_custom",
								':v_blnumb'=>"$no_bl",
								':v_cargow'=>"$customer_name",
								':v_icargow'=>"$customer_id",
								':v_no_req'=>"",
								':v_msg'=>""
							);
							
			
		}
		ELSE
		{
			$query = "BEGIN PROC_CREATE_DELIVERY 
							(
								:v_call_sign,
								:v_id_ves_scd,
								:v_vessel,
								:v_vin,
								:v_vout,
								:v_start_work,
								:v_iemkl,
								:v_ndo,
								:v_tgldo,
								:v_tgldel,
								:v_ship,
								:v_via,
								:v_ket,
								:v_user,
								:v_blnumb,
								:v_cargow,
								:v_icargow,
								:v_tlflag,
								:v_no_req,
								:v_msg
							); END;";
							
			$bind_param = array(
								':v_call_sign' => "$vessel_code",
								':v_id_ves_scd' => "$id_ves_voyage",
								':v_vessel' => "$vessel",
								':v_vin' => "$voyage_in",
								':v_vout' => "$voyage_out",
								':v_start_work' => "$date_discharge",
								':v_iemkl' => "$customer_id",
								':v_ndo' => "$no_do",
								':v_tgldo' => "$date_do",
								':v_tgldel' => "$date_delivery",
								':v_ship' => "I",
								':v_via' => "$delivery_type",
								':v_ket' => "",
								':v_user' => "$id_user",
								':v_blnumb' => "$no_bl",
								':v_cargow' => "$customer_name",
								':v_icargow' => "$customer_id",
								':v_tlflag' => "$tl_flag",
								':v_no_req' => "",
								':v_msg' => ""
							);
		}
		
		
		if(!checkOriSQL($conn['ori']['billing'],$query,$query_,$err,$bind_param)) goto Err;

		$biller_request_no = $bind_param[':v_no_req'];
		$v_msg = $bind_param[':v_msg'];
		
		if($v_msg!="OK")
		{
			$err = $v_msg;
			goto Err;
		}
		
		//insert to ibis transaction_log
		if($biller_request_no!="")
		{
			//update remark
			$query = "update req_delivery_h set id_req_ol = '$request_no' where id_req = '$biller_request_no'";
			if(!checkOriSQL($conn['ori']['billing'],$query,$query_,$err,$bind_param)) goto Err;
			
			//ibis
			$query = "insert into transaction_log (REQUEST_ID,BILLER_REQUEST_ID, KODE_MODUL,MODUL_DESC,PORT_ID,TERMINAL_ID,STATUS_REQ
													,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID
													,CUSTOM_NUMBER1,CUSTOM_NUMBER2,ADDITIONAL_FIELD1,ADDITIONAL_FIELD2,ADDITIONAL_FIELD3
													,REQUEST_DATE,REQUEST_BY,PRF_NUMBER,PRF_DATE,TRX_NUMBER,TRX_DATE
													,PAYMENT_BY,PAYMENT_DATE,PAYMENT_STATUS,PAYMENT_CHANNEL,
													NO_UKK, VESSEL, VOYAGE_IN, VOYAGE_OUT, ADDITIONAL_DATE,
													LAST_USER_ACTIVITY_USERID 
													)
			values
			(TRIM('$request_no'), TRIM('$biller_request_no'), 'PTKM01','DELIVERY','$port_code', '$terminal_code', 'N'
				,'$customer_id', '$customer_name', '$address', '$npwp'
				,'$no_sppb', '', '$no_do','' ,'' 
				,SYSDATE, '$id_user_eservice', '' , '', '' ,''
				,'', '', '', ''
				,'$ukk','$vessel','$voyage_in','$voyage_out', TO_DATE('$date_delivery','DD-MM-YYYY'),'$id_user_eservice' 
			)";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err)) goto Err;
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['info']="OK,$request_no";
		
		
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

/*
$query_tes = "DECLARE 
						  V_TIPE_REQ_CONT VARCHAR2(32767);
						  V_TERMINAL_ID VARCHAR2(32767);
						  V_JENIS_SPPB VARCHAR2(32767);
						  V_CALL_SIGN VARCHAR2(32767);
						  V_ID_VES_SCD VARCHAR2(32767);
						  V_VESSEL VARCHAR2(32767);
						  V_VIN VARCHAR2(32767);
						  V_VOUT VARCHAR2(32767);
						  V_START_WORK VARCHAR2(32767);
						  V_IEMKL VARCHAR2(32767);
						  V_SPPB VARCHAR2(32767);
						  V_TGLSPPB VARCHAR2(32767);
						  V_NDO VARCHAR2(32767);
						  V_TGLDO VARCHAR2(32767);
						  V_TGLDEL VARCHAR2(32767);
						  V_SHIP VARCHAR2(32767);
						  V_VIA VARCHAR2(32767);
						  V_KET VARCHAR2(32767);
						  V_USER VARCHAR2(32767);
						  V_SPCUST VARCHAR2(32767);
						  V_TGLSPCUST VARCHAR2(32767);
						  V_BLNUMB VARCHAR2(32767);
						  V_CARGOW VARCHAR2(32767);
						  V_ICARGOW VARCHAR2(32767);
						  V_NO_REQ VARCHAR2(32767);
						  V_MSG VARCHAR2(32767);

						BEGIN 
						  V_TIPE_REQ_CONT := NULL;
						  V_TERMINAL_ID := '009';
						  V_JENIS_SPPB := NULL;
						  V_CALL_SIGN := '$vessel_code';
						  V_ID_VES_SCD := '$id_ves_voyage';
						  V_VESSEL := '$vessel';
						  V_VIN := '$voyage_in';
						  V_VOUT := '$voyage_out';
						  V_START_WORK := '$date_discharge';
						  V_IEMKL := '$customer_id';
						  V_SPPB := '$no_sppb';
						  V_TGLSPPB := '$date_sppb';
						  V_NDO := '$no_do';
						  V_TGLDO := '$date_do';
						  V_TGLDEL := '$date_delivery';
						  V_SHIP := 'I';
						  V_VIA := '$delivery_type';
						  V_KET := '';
						  V_USER := '$id_user';
						  V_SPCUST := '$no_sp_custom';
						  V_TGLSPCUST := '$date_sp_custom';
						  V_BLNUMB := '$no_bl';
						  V_CARGOW := '$customer_name';
						  V_ICARGOW := '$customer_id';
						  V_NO_REQ := NULL;
						  V_MSG := NULL;

						  BILLING.PROC_CREATE_DELIVERY ( V_TIPE_REQ_CONT, V_TERMINAL_ID, V_JENIS_SPPB, V_CALL_SIGN, V_ID_VES_SCD, V_VESSEL, V_VIN, V_VOUT, V_START_WORK, V_IEMKL, V_SPPB, V_TGLSPPB, V_NDO, V_TGLDO, V_TGLDEL, V_SHIP, V_VIA, V_KET, V_USER, V_SPCUST, V_TGLSPCUST, V_BLNUMB, V_CARGOW, V_ICARGOW, V_NO_REQ, V_MSG );
						  COMMIT; 
						END;";
						
			return $query_tes;*/
?>