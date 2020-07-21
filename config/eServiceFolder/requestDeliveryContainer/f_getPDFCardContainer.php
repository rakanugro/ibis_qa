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
		$infos =array();
		//get receiving info
		$request = array();

		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		
		$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
		
		if ($port_code=="IDJKT"&&($terminal_code=="T3D"||$terminal_code=="T2D"||$terminal_code=="T1D"))
		{
			$query_card = "SELECT A.ID_NOTA,
			   A.ID_REQ,
			   B.NO_CONTAINER ID_CONTAINER,
			   SUBSTR(B.NO_CONTAINER,1,4) PREFIX,
			   SUBSTR(B.NO_CONTAINER,-7) CONT_NUMB,
			   C.TGL_DO,
			   A.EMKL,
			   A.VESSEL,
			   B.VOYAGE,
			 a.VOYAGE_IN,
			   a.VOYAGE_OUT,
			   B.SIZE_CONT UKURAN,
			   B.STATUS_CONT STATUS,
			   C.DISCH_DATE,
			   (SELECT ISO_CODE FROM itos_repo.m_cyc_container WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) ISOCODE,
			   B.REEFER_TEMP,
			   B.IPOL,
			   B.IPOD,
			 A.NO_BL,
			 A.NO_DO,
			   TO_CHAR(CASE WHEN A.TIPE_REQ='EXT' THEN B.PLUG_OUT_EXT ELSE B.PLUG_OUT END,'DD/MM/RRRR HH24:MI:SS') PLUG_OUT,
			   (SELECT C.TGL_JAM_TIBA
				  FROM rbm_h C
				 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
				  TGL_START_STACK,
			   A.TGL_SP2 TGL_END_STACK,
			   CASE D.HEIGHT_CONT WHEN 'OOG' THEN B.TYPE_CONT || 'OOG'
				ELSE B.TYPE_CONT END TYPE,
				CASE WHEN c.TL_FLAG='Y' THEN 'TL' ELSE 'YARD' END TLYARD,
			(SELECT YD_BLOCK ||'-'||YD_SLOT ||'-'|| YD_ROW ||'-'|| YD_TIER POSISI FROM itos_repo.m_cyc_container WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) POSISI,
			(SELECT SEAL_ID FROM itos_repo.m_cyc_container WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) SEAL_ID
		  FROM REQ_DELIVERY_D B, NOTA_DELIVERY_H A, REQ_DELIVERY_H C, MASTER_BARANG D
		 WHERE TRIM (A.ID_REQ) = TRIM (B.NO_REQ_DEV)
				AND A.ID_REQ = C.ID_REQ
				AND B.ID_CONT=D.KODE_BARANG
			   AND TRIM (A.ID_REQ) ='$no_request'";
		} 
		else if ($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			//di opus posisi diisi kosong??
			$query_card = "SELECT A.ID_NOTA,
			   A.ID_REQ,
			   B.NO_CONTAINER ID_CONTAINER,
			   SUBSTR(B.NO_CONTAINER,1,4) PREFIX,
			   SUBSTR(B.NO_CONTAINER,-7) CONT_NUMB,
			   C.TGL_DO,
			   A.EMKL,
			   A.VESSEL,
			   B.VOYAGE,
			 a.VOYAGE_IN,
			   a.VOYAGE_OUT,
			   B.SIZE_CONT UKURAN,
			   B.STATUS_CONT STATUS,
			   C.DISCH_DATE,
			   (SELECT ISO_CODE FROM m_cyc_container@dbint_link WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) ISOCODE,
			   B.REEFER_TEMP,
			   B.IPOL,
			   B.IPOD,
			 A.NO_BL,
			 A.NO_DO,
			   TO_CHAR(CASE WHEN A.TIPE_REQ='EXT' THEN B.PLUG_OUT_EXT ELSE B.PLUG_OUT END,'DD/MM/RRRR HH24:MI:SS') PLUG_OUT,
			   (SELECT C.TGL_JAM_TIBA
				  FROM rbm_h C
				 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
				  TGL_START_STACK,
			   A.TGL_SP2 TGL_END_STACK,
			   CASE D.HEIGHT_CONT WHEN 'OOG' THEN B.TYPE_CONT || 'OOG'
				ELSE B.TYPE_CONT END TYPE,
				CASE WHEN c.DEV_VIA='Y' THEN 'TL' ELSE 'YARD' END TLYARD,
			'' POSISI,
			(SELECT SEAL_ID FROM m_cyc_container@dbint_link WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) SEAL_ID
		  FROM REQ_DELIVERY_D B, NOTA_DELIVERY_H A, REQ_DELIVERY_H C, MASTER_BARANG D
		 WHERE TRIM (A.ID_REQ) = TRIM (B.NO_REQ_DEV)
				AND A.ID_REQ = C.ID_REQ
				AND B.ID_CONT=D.KODE_BARANG
			   AND TRIM (A.ID_REQ) ='$no_request'";
		} else  if($port_code=="IDJKT"&&$terminal_code=="T009D"){
				$query_card = "SELECT A.ID_NOTA,
			   A.ID_REQ,
			   B.NO_CONTAINER ID_CONTAINER,
			   SUBSTR(B.NO_CONTAINER,1,4) PREFIX,
			   SUBSTR(B.NO_CONTAINER,-7) CONT_NUMB,
			   C.TGL_DO,
			   A.EMKL,
			   A.VESSEL,
			   a.VOYAGE_IN VOYAGE,
			   a.VOYAGE_IN,
			   a.VOYAGE_OUT,
			   B.SIZE_CONT UKURAN,
			   B.STATUS_CONT STATUS,
			   C.DISCH_DATE,
			   (SELECT ISO_CODE FROM m_cyc_container@dbint_link WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) ISOCODE,
			   B.REEFER_TEMP,
			   B.IPOL,
			   B.IPOD,
			 A.NO_BL,
			 A.NO_DO,
			   TO_CHAR(CASE WHEN A.TIPE_REQ='EXT' THEN B.PLUG_OUT_EXT ELSE B.PLUG_OUT END,'DD/MM/RRRR HH24:MI:SS') PLUG_OUT,
			   (SELECT C.TGL_JAM_TIBA
				  FROM rbm_h C
				 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
				  TGL_START_STACK,
			   A.TGL_SP2 TGL_END_STACK,
			   CASE D.HEIGHT_CONT WHEN 'OOG' THEN B.TYPE_CONT || 'OOG'
				ELSE B.TYPE_CONT END TYPE,
				CASE WHEN c.DEV_VIA='Y' THEN 'TL' ELSE 'YARD' END TLYARD,
			'' POSISI,
			(SELECT SEAL_ID FROM m_cyc_container@dbint_link WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) SEAL_ID
		  FROM REQ_DELIVERY_D B, NOTA_DELIVERY_H A, REQ_DELIVERY_H C, MASTER_BARANG D
		 WHERE TRIM (A.ID_REQ) = TRIM (B.ID_REQ)
				AND A.ID_REQ = C.ID_REQ
				AND B.ID_CONT=D.KODE_BARANG
			   AND TRIM (A.ID_REQ) ='$no_request'";
		}
		//return $query_card;
		if(!checkOriSQL($conn['ori']['billing'],$query_card,$query_card_,$err)) goto Err;
		
		$vessel 	= $data[0]['VESSEL'];
		$voyage_in 	= $data[0]['VOYAGE_IN'];
		$voyage_out = $data[0]['VOYAGE_OUT'];
		
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM REQ_DELIVERY_D A WHERE A.ID_REQ='".$no_request."'";
		} else {
			$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM REQ_DELIVERY_D A WHERE A.NO_REQ_DEV='".$no_request."'";
		}	
		if(!checkOriSQL($conn['ori']['billing'],$query_vessel,$query_vessel_,$err)) goto Err;
		
		/* TERMINAL DOMESTIK*/
		if($port_code=="IDJKT"&&$terminal_code!="T3I"){
		$terminal_name="";
		$query_id_terminal="SELECT TERMINAL_ID FROM TERMINAL_CONFIG WHERE ENABLE = 'Y'";
		if(!checkOriSQL($conn['ori']['billing'],$query_id_terminal,$queryIDTerminal,$err)) goto Err;
		
		//FETCH QUERY
		if ($hasil_id_terminal_ = oci_fetch_array($queryIDTerminal, OCI_ASSOC))
		{
			$terminal_name=$hasil_id_terminal_[TERMINAL_ID];
		}
		}
		/* TERMINAL DOMESTIK*/
		
		$vessel = oci_fetch_array($query_vessel_, OCI_ASSOC);
		$jum = $vessel[JUM_DETAIL];
		
		while ($row_container = oci_fetch_array($query_card_, OCI_ASSOC))
		{
			//build "info" data
			$info = array(
									'terminal_name' => $terminal_name,
									'clossing_time' => "",
									'paidthru' => $row_container[TGL_END_STACK],
									'etd' => "",
									'vessel' => $row_container[VESSEL],
									'voyage' => $row_container[VOYAGE],
									'voyage_out' => $row_container[VOYAGE_OUT],
									'status_cont' => $row_container[STATUS],
									'size_cont' => $row_container[UKURAN],
									'type_cont' => $row_container[TYPE],
									'no_container' => $row_container[ID_CONTAINER],
									'berat' => "",
									'pelabuhan_tujuan' => "",
									'fpod' => $row_container[IPOD],
									'ipod' => $row_container[IPOD],
									'fipod' => $row_container[IPOD],
									'peb' => "",
									'npe' => "",
									'kode_pbm' => $row_container[EMKL],
									'imo_class' => $row_container[IMO_CLASS],
									'temp' => $row_container[REEFER_TEMP],
									'iso_code' => $row_container[ISOCODE],
									'ipol' => $row_container[IPOL],
									'tgl_request' => "",
									'prefix' => $row_container[PREFIX],
									'cont_numb' => $row_container[CONT_NUMB],
									'booking_numb' => "",
									'no_do' => $row_container[NO_DO],
									'tgl_do' => $row_container[TGL_DO],
									'status_tl' => $row_container[TLYARD],
									'seal_id' => $row_container[SEAL_ID]
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