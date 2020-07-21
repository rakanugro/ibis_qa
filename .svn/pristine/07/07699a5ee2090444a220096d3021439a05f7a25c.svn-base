<?php

/*|
 | Function Name 	: getPDFCardContainer
 | Description 		: get PDF Card Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFCardContainerDel($in_param) {

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
		$conn['ori'] = array();
		$out_data = array();
		$infos =array();
		//get receiving info
		$request = array();

		//select connection
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		
		$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
		
		if($port_code=="IDJKT"&&($terminal_code=="T3D"||$terminal_code=="T2D"||$terminal_code=="T1D"))
		{
			$query_card = "SELECT SUBSTR(B.NO_CONTAINER,0,4)  PREFIX,
								SUBSTR(B.NO_CONTAINER,3,7)  CONT_NUMB,
								A.NO_NOTA ID_NOTA,
							   A.ID_BATALMUAT ID_REQ,
							   B.NO_CONTAINER ID_CONTAINER,
							   A.EMKL,
							   A.VESSEL,
							   A.VOYAGE,
							   '' VOYAGE_IN,
							   '' VOYAGE_OUT,
							   '' UKURAN,
							   CASE F.HEIGHT_CONT WHEN 'OOG' THEN B.JNS_CONT || 'OOG'
												ELSE B.JNS_CONT END JNS_CONT,
							   B.STATUS STATUS,
							   '' DISCH_DATE,
							   '' NO_BL,
							   '' NO_DO,
							  '' PLUG_OUT,
							   (SELECT C.TGL_JAM_TIBA
								  FROM rbm_h C
								 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
								  TGL_START_STACK,
							   A.TGL_BERANGKAT2 TGL_END_STACK
						  FROM TB_BATALMUAT_D B, NOTA_BATALMUAT_H A, TB_BATALMUAT_H C, MASTER_BARANG F
						 WHERE TRIM (A.ID_BATALMUAT) = TRIM (B.ID_BATALMUAT)
								AND A.ID_BATALMUAT = C.ID_BATALMUAT
							   AND TRIM (A.ID_BATALMUAT) ='$no_request' AND b.ID_CONT=F.KODE_BARANG";
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			//di opus posisi diisi kosong??
			$query_card = "	SELECT SUBSTR(B.NO_CONTAINER,0,4)  PREFIX,
								SUBSTR(B.NO_CONTAINER,3,7)  CONT_NUMB,
								A.NO_NOTA ID_NOTA,
							   A.ID_BATALMUAT ID_REQ,
							   B.NO_CONTAINER ID_CONTAINER,
							   A.EMKL,
							   A.VESSEL,
							   A.VOYAGE,
							   '' VOYAGE_IN,
							   '' VOYAGE_OUT,
							   '' UKURAN,
							   CASE F.HEIGHT_CONT WHEN 'OOG' THEN B.JNS_CONT || 'OOG'
												ELSE B.JNS_CONT END JNS_CONT,
							   B.STATUS STATUS,
							   '' DISCH_DATE,
							   '' NO_BL,
							   '' NO_DO,
							  '' PLUG_OUT,
							   (SELECT C.TGL_JAM_TIBA
								  FROM rbm_h C
								 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
								  TGL_START_STACK,
							   A.TGL_BERANGKAT2 TGL_END_STACK
						  FROM TB_BATALMUAT_D B, NOTA_BATALMUAT_H A, TB_BATALMUAT_H C, MASTER_BARANG F
						 WHERE TRIM (A.ID_BATALMUAT) = TRIM (B.ID_BATALMUAT)
								AND A.ID_BATALMUAT = C.ID_BATALMUAT
							   AND TRIM (A.ID_BATALMUAT) ='$no_request' AND b.ID_CONT=F.KODE_BARANG";
		}
		
		if(!checkOriSQL($conn['ori']['billing'],$query_card,$query_card_,$err,$debug)) goto Err;
		
		$vessel 	= $data[0]['VESSEL'];
		$voyage_in 	= $data[0]['VOYAGE_IN'];
		$voyage_out = $data[0]['VOYAGE_OUT'];
		
		$query_vessel = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM_DETAIL FROM TB_BATALMUAT_D A WHERE A.ID_BATALMUAT='".$no_request."'";
		
		if(!checkOriSQL($conn['ori']['billing'],$query_vessel,$query_vessel_,$err,$debug)) goto Err;
		
		/* TERMINAL DOMESTIK*/
		$terminal_name="";
		$query_id_terminal="SELECT TERMINAL_ID FROM TERMINAL_CONFIG WHERE ENABLE = 'Y'";
		if(!checkOriSQL($conn['ori']['billing'],$query_id_terminal,$queryIDTerminal,$err,$debug)) goto Err;
		
		//FETCH QUERY
		if ($hasil_id_terminal_ = oci_fetch_array($queryIDTerminal, OCI_ASSOC))
		{
			$terminal_name=$hasil_id_terminal_[TERMINAL_ID];
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
									'type_cont' => $row_container[JNS_CONT],
									'no_container' => $row_container[ID_CONTAINER],
									'berat' => "",
									'pelabuhan_tujuan' => "",
									'fpod' =>"",
									'ipod' => "",
									'fipod' =>"",
									'peb' => "",
									'npe' => "",
									'kode_pbm' => $row_container[EMKL],
									'imo_class' => "",
									'temp' => "",
									'iso_code' => "",
									'ipol' =>"",
									'tgl_request' => "",
									'prefix' => $row_container[PREFIX],
									'cont_numb' => $row_container[CONT_NUMB],
									'booking_numb' => "",
									'no_do' => $row_container[NO_DO],
									'tgl_do' => "",
									'status_tl' => ""
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