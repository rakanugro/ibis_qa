<?php

function getRequestRecHead($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		//return $in_param;
		$request_no = $xml_data->data->request_no;
		$port_code=$xml_data->data->port_id;
		$terminal_code=$xml_data->data->terminal_id;
		
		$start_rownum = $xml_data->data->start_rownum;
		$end_rownum = $xml_data->data->end_rownum;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();
		
		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("IBIS");		
		$conn['billing'][0] = $conn['ori']['billing'];
		
		//PL/SQL
		if (($port_code=="IDJKT"&&$terminal_code=="T009D")){
		$query = "SELECT a.ID_REQ, a.NO_SPP, a.NO_SURAT_JALAN, a.KODE_PBM CUSTOMER_NAME, a.VESSEL, a.VOYAGE_IN VOYAGE_IN , a.PEB , a.NPE , a.TGL_REQUEST, a.TGL_STACK DATE_STACK, a.TGL_OPEN_STACK DATE_OPEN_STACK, a.TGL_MUAT DATE_LOADING, a.TGL_BONGKAR DATE_DISCHARGE, a.STATUS STATUS, a.SHIFT_REEFER SHIFT_REEFER, a.START_SHIFT START_SHIFT, a.END_SHIFT END_SHIFT, a.KETERANGAN REMARK, a.CLOSSING_TIME DATE_CLOSSING_TIME, a.PELABUHAN_ASAL POL, a.PELABUHAN_TUJUAN POD, a.NO_UKK ID_VES_VOYAGE, a.ID_USER ID_USER, a.COA CUSTOMER_ID, a.ALAMAT ADDRESS, a.NPWP, a.CARRIER CARRIER, a.IPOL ID_POL, a.IPOD ID_POD, a.OI OI, a.VOYAGE_OUT, a.BOOKING_NUMB, a.FPOD FPOD, a.FIPOD ID_FPOD, a.IS_EDIT, b.VESSEL_CODE,
                      b.CALL_SIGN,
                      b.VOYAGE FROM REQ_RECEIVING_H a join m_vsb_voyage@dbint_link b on a.NO_UKK=b.ID_Vsb_VOYAGE WHERE ID_REQ='$request_no'";
		} else {
		$query = "SELECT a.ID_REQ, '' NO_SPP, '' NO_SURAT_JALAN,a.KODE_PBM CUSTOMER_NAME, a.VESSEL, a.VOYAGE VOYAGE_IN , a.PEB , a.NPE , a.TGL_REQUEST, a.TGL_STACK DATE_STACK, a.TGL_OPEN_STACK DATE_OPEN_STACK, a.TGL_MUAT DATE_LOADING, a.TGL_BONGKAR DATE_DISCHARGE, a.STATUS STATUS, a.SHIFT_REEFER SHIFT_REEFER, a.START_SHIFT START_SHIFT, a.END_SHIFT END_SHIFT, a.KETERANGAN REMARK, a.CLOSSING_TIME DATE_CLOSSING_TIME, a.PELABUHAN_ASAL POL, a.PELABUHAN_TUJUAN POD, a.NO_UKK ID_VES_VOYAGE, a.ID_USER ID_USER, a.COA CUSTOMER_ID, a.ALAMAT ADDRESS, a.NPWP, a.CARRIER CARRIER, a.IPOL ID_POL, a.IPOD ID_POD, a.OI OI, a.VOYAGE_OUT, a.BOOKING_NUMB, a.FPOD FPOD, a.FIPOD ID_FPOD, a.IS_EDIT, b.VESSEL_CODE,
                      b.CALL_SIGN,
                      b.VOYAGE FROM REQ_RECEIVING_H a join m_vsb_voyage@dbint_link b on a.NO_UKK=b.ID_Vsb_VOYAGE WHERE ID_REQ='$request_no'";
		}
		//return $request_no;
		
		if(!checkOriSQL($conn['billing'][0] ,$query,$query_request,$err,$debug)) goto Err; 
		//FETCH QUERY
		
		while($row = oci_fetch_array($query_request, OCI_ASSOC))
		{
			
			$query_term = "SELECT TERMINAL_NAME FROM MST_TERMINAL WHERE PORT = '$port_code' AND TERMINAL = '$terminal_code' AND ACTIVE = 'Y'";
			if(!checkOriSQL($conn['ori']['ibis'] ,$query_term,$getterm,$err,$debug)) goto Err; 
			while($row2 = oci_fetch_array($getterm, OCI_ASSOC))
			{
				$term_name = $row2[TERMINAL_NAME];
				
			}
			$request_sub = array(
				'no_request' => $row[ID_REQ], 
				'cust_name' => $row[CUSTOMER_NAME], 
				'vessel' => $row[VESSEL], 
				'voyin' => $row[VOYAGE_IN], 
				'peb' => $row[PEB], 
				'npe' => $row[NPE], 
				'date_req' => $row[TGL_REQUEST], 
				'date_stack' => $row[DATE_STACK], 
				'date_opstack' => $row[DATE_OPEN_STACK], 
				'date_loading' => $row[DATE_LOADING], 
				'date_disch' => $row[DATE_DISCHARGE], 
				'status' => $row[STATUS], 
				'shift_ref' => $row[SHIFT_REEFER], 
				'start_shift' => $row[START_SHIFT], 
				'end_shift' => $row[END_SHIFT], 
				'remark' => $row[REMARK], 
				'date_closetime' => $row[DATE_CLOSSING_TIME], 
				'pol' => $row[POL], 
				'pod' => $row[POD], 
				'id_ves_voyage' => $row[ID_VES_VOYAGE], 
				'id_user' => $row[ID_USER], 
				'cust_id' => $row[CUSTOMER_ID], 
				'address' => $row[ADDRESS], 
				'npwp' => $row[NPWP], 
				'carrier' => $row[CARRIER], 
				'idpol' => $row[ID_POL], 
				'idpod' => $row[ID_POD], 
				'oi' => $row[OI], 
				'voyout' => $row[VOYAGE_OUT], 
				'bknumb' => $row[BOOKING_NUMB], 
				'fpod' => $row[FPOD],
				'idfpod' => $row[ID_FPOD],
				'vscode' => $row[VESSEL_CODE],
				'callsign' => $row[CALL_SIGN],
				'voy' => $row[VOYAGE],
				'spp' => $row[NO_SPP],
				'suratjalan' => $row[NO_SURAT_JALAN],
				'term_name' => $term_name		
				);
			
			array_push($request, $request_sub);
		}
		
		$out_data = array();
		$out_data['request']=$request;
		
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

function getRequestRecDet($in_param) {

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
		//return $in_param;
		$request_no = $xml_data->data->request_no;
		$port_code=$xml_data->data->port_id;
		$terminal_code=$xml_data->data->terminal_id;
		
		$start_rownum = $xml_data->data->start_rownum;
		$end_rownum = $xml_data->data->end_rownum;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();

		//PL/SQL
		if (($port_code=="IDJKT"&&$terminal_code=="T009D")){
			$query = "select a.NO_CONTAINER, a.SIZE_CONT, A.TYPE_CONT,A.STATUS_CONT, A.HEIGHT,A.HZ,A.CARRIER  FROM REQ_RECEIVING_d a WHERE a.ID_REQ='$request_no'";
		} else {
			$query = "select a.NO_CONTAINER, a.SIZE_CONT, A.TYPE_CONT,A.STATUS_CONT, A.HEIGHT,A.HZ,A.CARRIER  FROM REQ_RECEIVING_d a WHERE a.NO_REQ_ANNE='$request_no'";
		}//return $request_no;
		//QUERY
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			//return 'test';
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
		else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_itost'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t009d'];			
		}
		
		
		if(!checkOriSQL($conn['billing'][0] ,$query,$query_request,$err,$debug)) goto Err; 
		//FETCH QUERY
		
		while($row = oci_fetch_array($query_request, OCI_ASSOC))
		{
			
			$request_sub = array(
				'container_number' => $row[NO_CONTAINER], 
				'size' => $row[SIZE_CONT], 
				'type' => $row[TYPE_CONT], 
				'status' => $row[STATUS_CONT], 
				'height' => $row[HEIGHT], 
				'hz' => $row[HZ], 
				'carrier' => $row[CARRIER]
			);
			
			array_push($request, $request_sub);
		}
		
		$out_data = array();
		$out_data['request']=$request;
		
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