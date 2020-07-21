<?php

/*|
 | Function Name 	: getPDFCardContainer
 | Description 		: get PDF Card Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getPDFCardContainerRec($in_param) {

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
			$query_card = "	SELECT a.*,b.ID_BATALMUAT,b.NO_CONTAINER,b.STATUS,b.HZ,b.ID_DETAIL,b.NO_UKK,b.NO_UKK_NEW,
						CASE F.HEIGHT_CONT WHEN 'OOG' THEN B.JNS_CONT || 'OOG'
						ELSE B.JNS_CONT END JNS_CONT,
						b.ID_CONT,b.TGL_STACK,b.TGL_BERANGKAT, c.*, to_char(to_date(d.clossing_time,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') closing_time, D.ID_POD, E.POD AS PODES,
						(SELECT g.VESSEL||' / '|| g.VOYAGE_IN FROM TB_BATALMUAT_D f,M_VSB_VOYAGE@dbint_link g WHERE F.NO_UKK = g.ID_VSB_VOYAGE AND f.NO_CONTAINER = b.NO_CONTAINER  and rownum = 1) EX_KAPAL
						  FROM TB_BATALMUAT_H a, TB_BATALMUAT_D b, NOTA_BATALMUAT_H c, M_VSB_VOYAGE@dbint_link D, M_CYC_CONTAINER@dbint_link E, MASTER_BARANG F
						  WHERE a.ID_BATALMUAT = b.ID_BATALMUAT 
						  AND trim(A.ID_BATALMUAT)=trim(C.ID_BATALMUAT) 
						  AND D.vessel(+) = A.vessel 
						  AND D.VOYAGE_IN(+) = a.VOYAGE  
						  AND a.ID_BATALMUAT = '$no_request'
						  AND E.NO_CONTAINER = B.NO_CONTAINER
						  AND E.VESSEL = D.vessel
                          AND E.VOYAGE_IN = d.voyage_in
						  AND b.ID_CONT=F.KODE_BARANG";
		} 
		else if($terminal_code=='T009D')
		{
			$query_card = "SELECT a.*,b.ID_REQ ID_BATALMUAT,b.NO_CONTAINER,b.STATUS,b.HZ,b.ID_DETAIL,b.NO_UKK,b.NO_UKK_NEW,
                        CASE F.HEIGHT_CONT WHEN 'OOG' THEN B.JNS_CONT || 'OOG'
                        ELSE B.JNS_CONT END JNS_CONT,
                        b.ID_CONT,b.TGL_STACK,b.TGL_BERANGKAT, c.*, to_char(to_date(d.clossing_time,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') closing_time, D.ID_POD, E.POD AS PODES,
                        (SELECT g.VESSEL||' / '|| g.VOYAGE_IN FROM REQ_BATALMUAT_D f,M_VSB_VOYAGE@dbint_link g WHERE F.NO_UKK = g.ID_VSB_VOYAGE AND f.NO_CONTAINER = b.NO_CONTAINER  and rownum = 1) EX_KAPAL
                          FROM REQ_BATALMUAT_H a, REQ_BATALMUAT_D b, NOTA_BATALMUAT_H c, M_VSB_VOYAGE@dbint_link D, M_CYC_CONTAINER@dbint_link E, MASTER_BARANG F
                          WHERE a.ID_REQ = b.ID_REQ 
                          AND trim(A.ID_REQ)=trim(C.ID_REQ) 
                          AND D.vessel(+) = A.vessel 
                          AND D.VOYAGE_IN(+) = a.VOYAGE_IN 
                          AND a.ID_REQ = '$no_request'
                          AND E.NO_CONTAINER = B.NO_CONTAINER
                          AND E.VESSEL = D.vessel
                          AND E.VOYAGE_IN = d.voyage_in
                          AND b.ID_CONT=F.KODE_BARANG";
			
		}
		else
		{
			$query_card = "SELECT a.*,
						   b.ID_BATALMUAT,
						   b.NO_CONTAINER,
						   b.STATUS,
						   b.HZ,
						   b.NO_UKK,
						   b.NO_UKK_NEW,
						   CASE F.HEIGHT_CONT
							  WHEN 'OOG' THEN B.JNS_CONT || 'OOG'
							  ELSE B.JNS_CONT
						   END
							  JNS_CONT,
						   b.ID_CONT,
						   b.TGL_STACK,
						   b.TGL_BERANGKAT,
						   c.*,
						   TO_CHAR (TO_DATE (d.clossing_time, 'rrrrmmddhh24miss'),
									'dd/mm/rrrr hh24:mi:ss')
							  closing_time,
						   D.ID_POD,
						   E.POD AS PODES,
						  --d.VESSEL || ' / ' || d.VOYAGE_IN EX_KAPAL
						  (SELECT g.VESSEL || ' / ' || g.VOYAGE_IN
							  FROM TB_BATALMUAT_D f, ITOS_REPO.M_VSB_VOYAGE g
							 WHERE F.NO_UKK = g.ID_VSB_VOYAGE AND f.NO_CONTAINER = b.NO_CONTAINER
							 AND G.VOYAGE_IN = A.VOYAGE AND G.VESSEL = A.VESSEL AND f.ID_BATALMUAT = '$no_request' 
							 and rownum = 1
							 ) EX_KAPAL
					  FROM TB_BATALMUAT_H a,
						   TB_BATALMUAT_D b,
						   NOTA_BATALMUAT_H c,
						   ITOS_REPO.M_VSB_VOYAGE D,
						   ITOS_REPO.M_CYC_CONTAINER E,
						   MASTER_BARANG F
					 WHERE     TRIM(a.ID_BATALMUAT) = TRIM(b.ID_BATALMUAT)
						   AND TRIM (A.ID_BATALMUAT) = TRIM (C.ID_BATALMUAT)
						   AND D.VESSEL(+) = A.VESSEL
						   AND D.VOYAGE_IN(+) = a.VOYAGE
						   AND TRIM (a.ID_BATALMUAT) = '$no_request'
						   AND E.NO_CONTAINER = B.NO_CONTAINER
						   AND E.VESSEL = D.vessel
						   AND E.VOYAGE_IN = d.voyage_in
						   AND b.ID_CONT = F.KODE_BARANG";
		}
		
		if(!checkOriSQL($conn['ori']['billing'],$query_card,$query_card_,$err)) goto Err;

		$vessel 	= $data[0]['VESSEL'];
		$voyage_in 	= $data[0]['VOYAGE_IN'];
		$voyage_out = $data[0]['VOYAGE_OUT'];
		
		if($terminal_code=='T009D'){
				$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM REQ_BATALMUAT_D A WHERE A.ID_REQ='".$no_request."'";
		} else {
				$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM TB_BATALMUAT_D A WHERE A.ID_BATALMUAT='".$no_request."'";
		}
		
		
	

		if(!checkOriSQL($conn['ori']['billing'],$query_vessel,$query_vessel_,$err)) goto Err;
		
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