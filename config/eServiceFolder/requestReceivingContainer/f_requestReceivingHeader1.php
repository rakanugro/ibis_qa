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
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$peb_no = $xml_data->data->header->peb_no;
		$npe_no = $xml_data->data->header->npe_no;
		$booking_ship_no = $xml_data->data->header->booking_ship_no;
		$gate_in_date = $xml_data->data->header->gate_in_date;
		$customer_id = $xml_data->data->header->customer_id;
		$customer_name = $xml_data->data->header->customer_name;
		$customer_npwp = $xml_data->data->header->customer_npwp;
		$customer_address = $xml_data->data->header->customer_address;
		$customer_address = base64_decode($customer_address);
		$id_user = $xml_data->data->header->id_user;
		
		$port = $xml_data->data->header->port;$port = explode("-",$port);
		$port_code=$port[0];
		$terminal_code=$port[1];
		
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
				
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//insert data
		//PL/SQL
		
		//get vessel info
/*		$query = "Select VESSEL,VOYAGE_IN, VOYAGE_OUT, 
							TO_CHAR(to_date(OPEN_STACK,'YYYYMMDDHH24MISS'), 'DD-MON-YYYY HH24:Mi') OPEN_STACK, 
							TO_CHAR(to_date(ETA,'YYYYMMDDHH24MISS'),'DD-MON-YYYY HH24:Mi') ETA, 
							TO_CHAR(to_date(START_WORK,'YYYYMMDDHH24MISS'),'DD-MON-YYYY HH24:Mi') START_WORK, CALL_SIGN,
							TO_CHAR(to_date(CLOSSING_TIME,'YYYYMMDDHH24MISS'),'DD-MON-YYYY HH24:Mi') CLOSING_TIME, 
							TO_CHAR(to_date(CLOSSING_TIME,'YYYYMMDDHH24MISS'),'DD-MON-YYYY HH24:Mi') CLOSING_TIME_DOC,
							TO_CHAR(to_date(ETD,'YYYYMMDDHH24MISS'),'DD-MON-YYYY HH24:Mi') ETD,
							TO_CHAR(to_date(FIRST_ETD,'YYYYMMDDHH24MISS'),'DD-MON-YYYY HH24:Mi') FIRST_ETD 
							from m_vsb_voyage where ID_VSB_VOYAGE='$ukk'";*/
							
		$query = "Select VESSEL,VOYAGE_IN, VOYAGE_OUT, CALL_SIGN, VESSEL_CODE, VOYAGE,
							TO_CHAR(to_date(OPEN_STACK,'YYYYMMDDHH24MISS'), 'DD-MON-YYYY') OPEN_STACK, 
							TO_CHAR(to_date(ETA,'YYYYMMDDHH24MISS'),'DD-MON-YYYY') ETA, 
							TO_CHAR(to_date(START_WORK,'YYYYMMDDHH24MISS'),'DD-MON-YYYY') START_WORK, CALL_SIGN,
							TO_CHAR(to_date(CLOSSING_TIME,'YYYYMMDDHH24MISS'),'DD-MON-YYYY') CLOSING_TIME, 
							TO_CHAR(to_date(CLOSSING_TIME,'YYYYMMDDHH24MISS'),'DD-MON-YYYY') CLOSING_TIME_DOC,
							TO_CHAR(to_date(ETD,'YYYYMMDDHH24MISS'),'DD-MON-YYYY') ETD,
							TO_CHAR(to_date(FIRST_ETD,'YYYYMMDDHH24MISS'),'DD-MON-YYYY') FIRST_ETD 
							from m_vsb_voyage where ID_VSB_VOYAGE='$ukk'";							

		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}	
		else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_itost'];			
		}		
		
		//select connection
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to3d'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to3d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to3d'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_itost'];			
		}		
		
		//QUERY
		if(!checkOriSQL($conn['container'][0],$query,$query_vessel,$err,$debug)) goto Err; 
		//FETCH QUERY
		$row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC);
		$vessel = $row_vessel[VESSEL];
		$call_sign = $row_vessel[CALL_SIGN];
		$vessel_code = $row_vessel[VESSEL_CODE];
		$vin = $row_vessel[VOYAGE_IN];
		$vout = $row_vessel[VOYAGE_OUT];
		$etd = $row_vessel[ETD];
		$open_stack = $row_vessel[OPEN_STACK];
		$closing_time_doc = $row_vessel[CLOSSING_TIME_DOC];
		$closing_time = $row_vessel[CLOSSING_TIME];
		$eta = $row_vessel[ETA];
		$id_ves_voyage = $row_vessel[UKS];
		$voyage = $row_vessel[VOYAGE];

		//seharusnya ada validasi clossing time

		if($request_no=="")
		{
			//generate no request
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

	//ibis		 
			$query = "insert into req_receiving_h 
			(ID_REQ, VESSEL, VOYAGE_IN,VOYAGE_OUT, ID_VES_VOYAGE, PEB, NPE, STATUS, 
			ID_USER, NPWP, CARRIER, OI, 
			START_SHIFT, END_SHIFT, SHIFT_REEFER, BOOKING_NUMB, ID_POL, ID_POD, ID_FPOD, POD, FPOD, IS_EDIT,
			CUSTOMER_ID,CUSTOMER_NAME,ADDRESS,ID_PORT,ID_TERMINAL,DATE_REQUEST,VESSEL_CODE,CALL_SIGN,VOYAGE,TL_FLAG)
			values
			(TRIM('$request_no'), '$vessel', '$vin','$vout', '$ukk', '$peb_no', '$npe_no', 'N', 
			'$id_user', '$customer_npwp', '', '$trading_type', 
			 '', '', '' , '$booking_ship_no', '$port_code' ,'$pod','$fpod', '$pod_name', '$fpod_name', 1,
			 '$customer_id', '$customer_name', '$customer_address','$port_code','$terminal_code',SYSDATE,'$vessel_code','$call_sign','$voyage','$receiving_type')";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
			
	//biller
			$query = "INSERT INTO req_receiving_h 
				(ID_REQ,KODE_PBM,VESSEL,VOYAGE,
				PEB,NPE,TGL_REQUEST,TGL_STACK,TGL_OPEN_STACK,TGL_MUAT,
				TGL_BONGKAR,STATUS,SHIFT_REEFER,START_SHIFT,END_SHIFT,KETERANGAN, 
				CLOSSING_TIME,
				PELABUHAN_ASAL,PELABUHAN_TUJUAN,NO_UKK,
				ID_USER,COA,ALAMAT,NPWP,
				CARRIER,IPOL,IPOD,OI,VOYAGE_OUT,BOOKING_NUMB,FPOD,FIPOD,IS_EDIT,TL_FLAG) 
				VALUES 
				(TRIM('$request_no'),'$customer_name','$vessel','$vin',
				'$peb_no','$npe_no',sysdate,sysdate,'25-JAN-2015','01-JAN-2015',
				'$etd','S','','','','', 
				'01-JAN-2015', 
				'JAKARTA, INDONESIA','JAKARTA, INDONESIA','$ukk',
				'$customer_id','137730','$customer_address','$customer_npwp',
				'','IDJKT','$pod','$trading_type','116','$booking_ship_no',
				'JAKARTA, INDONESIA','$fpod','1','$receiving_type')";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['billing'][0],$query,$query_,$err,$debug)) goto Err;
		}		
		else{
	//ibis		 
			$query = "update req_receiving_h 
						set 
							VESSEL='$vessel',
							VOYAGE_IN='$vin',
							VOYAGE_OUT='$vout',
							PEB='$peb_no',
							NPE='$npe_no',
							ID_USER='$customer_id',
							NPWP='$customer_npwp',
							CARRIER='',
							OI='$receiving_type',
							START_SHIFT='',
							END_SHIFT='',
							SHIFT_REEFER='',
							BOOKING_NUMB='$booking_ship_no',
							FPOD='$fpod',
							IS_EDIT='1',
							CUSTOMER_ID='$customer_id',
							CUSTOMER_NAME='$customer_name',
							ADDRESS='$customer_address' 
						where ID_REQ = '$request_no'";
				
			//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
				
	//biller				
			$query = "update req_receiving_h 
						set 
							ID_REQ='$request_no',
							KODE_PBM='$customer_name',
							VESSEL='$vessel',
							VOYAGE='$vin',
							PEB='$peb_no',
							NPE='$npe_no',
							TGL_STACK='',
							TGL_OPEN_STACK='$open_stack',
							TGL_MUAT='$closing_time',
							TGL_BONGKAR='$etd',
							SHIFT_REEFER='',
							START_SHIFT='',
							END_SHIFT='',
							KETERANGAN='',
							CLOSSING_TIME='$closing_time_doc',
							PELABUHAN_ASAL='',
							PELABUHAN_TUJUAN='$pod_name',
							NO_UKK='$ukk',
							ID_USER='$customer_id',
							COA='',
							ALAMAT='$customer_address',
							NPWP='$customer_npwp',
							CARRIER='',
							IPOL='',
							IPOD='$pod',
							OI='',
							VOYAGE_OUT='$voyage_out',
							BOOKING_NUMB='$booking_ship_no',
							FPOD='$fpod_name',
							FIPOD='$fpod' 
					where id_req = '$request_no'";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['billing'][0],$query,$query_,$err,$debug)) goto Err;			
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