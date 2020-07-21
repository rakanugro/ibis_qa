<?php

/*|
 | Function Name 	: getPDFCardContainer
 | Description 		: get PDF Card Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getPDFCardContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		
		$no_request = $xml_data->data->no_request;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		$infos =array();
		//get receiving info
		$request = array();
		
		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		
		$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
		if($terminal_code=='T3I')
		{
			$query_card = "SELECT TO_CHAR (a.CLOSSING_TIME, 'dd/mm/yyyy HH24:MI') CLOSSING_TIME,
                       TO_CHAR (a.TGL_MUAT, 'dd/mm/yyyy') PAIDTHRU,
                       TO_CHAR (a.TGL_MUAT, 'dd/mm/yyyy HH24:MI') ETD,
                       a.VESSEL,
                       a.VOYAGE,
                       b.VOYAGE_OUT,
                       b.STATUS_CONT,
                       b.SIZE_CONT,
                       CASE WHEN b.height = 'OOG' THEN b.TYPE_CONT||'/'||b.height
                        ELSE b.TYPE_CONT END TYPE_CONT,
                       b.NO_CONTAINER,
                       b.BERAT,
                       a.PELABUHAN_TUJUAN,
                       a.FPOD,
                       a.IPOD,
                       a.FIPOD,
                       a.PEB,
                       a.NPE,
                       a.KODE_PBM,
                       b.IMO_CLASS,
                       b.TEMP, 
                       b.ISO_CODE,
                       a.IPOL,
                       a.TGL_REQUEST,
                       SUBSTR(b.NO_CONTAINER,1,4) PREFIX,
                       SUBSTR(b.NO_CONTAINER,-7) CONT_NUMB,
                       a.BOOKING_NUMB,
                      'CY' STATUS_TL
                  FROM req_receiving_h a, req_receiving_d b
                 WHERE a.ID_REQ = b.no_req_anne AND a.ID_REQ = '$no_request'";
		} else if ($terminal_code == 'T009D'){
			$query_card = "SELECT TO_CHAR (a.CLOSSING_TIME, 'dd/mm/yyyy HH24:MI') CLOSSING_TIME,
                       TO_CHAR (a.TGL_MUAT, 'dd/mm/yyyy') PAIDTHRU,
                       TO_CHAR (a.TGL_MUAT, 'dd/mm/yyyy HH24:MI') ETD,
                       a.VESSEL,
                       a.VOYAGE_IN VOYAGE,
                       b.VOYAGE_OUT,
                       b.STATUS_CONT,
                       b.SIZE_CONT,
                       CASE WHEN b.height = 'OOG' THEN b.TYPE_CONT||'/'||b.height
                        ELSE b.TYPE_CONT END TYPE_CONT,
                       b.NO_CONTAINER,
                       b.BERAT,
                       a.PELABUHAN_TUJUAN,
                       a.FPOD,
                       a.IPOD,
                       a.FIPOD,
                       a.PEB,
                       a.NPE,
                       a.KODE_PBM,
                       b.IMO_CLASS,
                       b.TEMP, 
                       b.ISO_CODE,
                       a.IPOL,
                       a.TGL_REQUEST,
                       SUBSTR(b.NO_CONTAINER,1,4) PREFIX,
                       SUBSTR(b.NO_CONTAINER,-7) CONT_NUMB,
                       a.BOOKING_NUMB,
                      'CY' STATUS_TL
                  FROM req_receiving_h a, req_receiving_d b
                 WHERE a.ID_REQ = b.ID_REQ AND a.ID_REQ = '$no_request'";
		}
		else
		{
		$query_card = "SELECT TO_CHAR (a.CLOSSING_TIME, 'dd/mm/yyyy HH24:MI') CLOSSING_TIME,
                       TO_CHAR (a.TGL_MUAT, 'dd/mm/yyyy') PAIDTHRU,
                       TO_CHAR (a.TGL_MUAT, 'dd/mm/yyyy HH24:MI') ETD,
                       a.VESSEL,
                       a.VOYAGE,
                       b.VOYAGE_OUT,
                       b.STATUS_CONT,
                       b.SIZE_CONT,
                       CASE WHEN b.height = 'OOG' THEN b.TYPE_CONT||'/'||b.height
                        ELSE b.TYPE_CONT END TYPE_CONT,
                       b.NO_CONTAINER,
                       b.BERAT,
                       a.PELABUHAN_TUJUAN,
                       a.FPOD,
                       a.IPOD,
                       a.FIPOD,
                       a.PEB,
                       a.NPE,
                       a.KODE_PBM,
                       b.IMO_CLASS,
                       b.TEMP, 
                       b.ISO_CODE,
                       a.IPOL,
                       a.TGL_REQUEST,
                       SUBSTR(b.NO_CONTAINER,1,4) PREFIX,
                       SUBSTR(b.NO_CONTAINER,-7) CONT_NUMB,
                       a.BOOKING_NUMB,
                       CASE WHEN a.TL_FLAG = 'Y' THEN 'TL'
                       ELSE 'CY' END STATUS_TL
                  FROM req_receiving_h a, req_receiving_d b
                 WHERE a.ID_REQ = b.no_req_anne AND a.ID_REQ = '$no_request'";
		}
			if(!checkOriSQL($conn['ori']['billing'],$query_card,$query_card_,$err,$debug)) goto Err;

		
		
		
		$vessel 	= $data[0]['VESSEL'];
		$voyage_in 	= $data[0]['VOYAGE_IN'];
		$voyage_out = $data[0]['VOYAGE_OUT'];
		
		if ($terminal_code == 'T009D'){
			$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM REQ_RECEIVING_D A WHERE A.ID_REQ='".$no_request."'";
		} else {
			$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM REQ_RECEIVING_D A WHERE A.NO_REQ_ANNE='".$no_request."'";
		}
		
		
		
		if(!checkOriSQL($conn['ori']['billing'],$query_vessel,$query_vessel_,$err,$debug)) goto Err;
		
		
		$vessel = oci_fetch_array($query_vessel_, OCI_ASSOC);
		$jum = $vessel[JUM_DETAIL];
		
		
		while ($row_container = oci_fetch_array($query_card_, OCI_ASSOC))
		{
			//build "info" data
			$info = array(
									'clossing_time' => $row_container[CLOSSING_TIME],
									'paidthru' => $row_container[PAIDTHRU],
									'etd' => $row_container[ETD],
									'vessel' => $row_container[VESSEL],
									'voyage' => $row_container[VOYAGE],
									'voyage_out' => $row_container[VOYAGE_OUT],
									'status_cont' => $row_container[STATUS_CONT],
									'size_cont' => $row_container[SIZE_CONT],
									'type_cont' => $row_container[TYPE_CONT],
									'no_container' => $row_container[NO_CONTAINER],
									'berat' => $row_container[BERAT],
									'pelabuhan_tujuan' => $row_container[PELABUHAN_TUJUAN],
									'fpod' => $row_container[FPOD],
									'ipod' => $row_container[IPOD],
									'fipod' => $row_container[FIPOD],
									'peb' => $row_container[PEB],
									'npe' => $row_container[NPE],
									'kode_pbm' => $row_container[KODE_PBM],
									'imo_class' => $row_container[IMO_CLASS],
									'temp' => $row_container[TEMP],
									'iso_code' => $row_container[ISO_CODE],
									'ipol' => $row_container[IPOL],
									'tgl_request' => $row_container[TGL_REQUEST],
									'prefix' => $row_container[PREFIX],
									'cont_numb' => $row_container[CONT_NUMB],
									'booking_numb' => $row_container[BOOKING_NUMB],
									'status_tl' => $row_container[STATUS_TL]
						);
						
			array_push($infos, $info);
		}	 
					
		$data = array(
						"detail_card" => $infos,
						"jumlah" => $jum
						);

		$out_data = $data;
		
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