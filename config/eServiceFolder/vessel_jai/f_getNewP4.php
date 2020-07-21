<?php

/*|
 | Function Name 	: getNewP4
 | Description 		: Get New P4
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getNewP4($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("KAPAL");//hanya ambil koneksi kapal saja
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$agent_id = $xml_data->data->agent_id;
		$branch_id = $xml_data->data->branch_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get p4 info
		$p4 = array();
		//PL/SQL
		/*
		| updater : tofan
		| update  : v_list_pkk_ibis
		*/
		
		if($agent_id!="")
			$filter_agen = " AND mst_agen.KD_AGEN = '".$agent_id."' ";
		
		if($branch_id!="")
			$filter_cabang = " AND mst_agen.KD_CABANG = '".$branch_id."' ";
		
		$getP4Info = "SELECT ppkb.KD_PPKB,
                           ppkb_detail.PPKB_KE,
                           mst_kapal.KD_KAPAL,
                           mst_kapal.NM_KAPAL,
                           pkk.NO_UKK,
                           pkk.KD_PROSES,
                           pkk.IN_DKK,
                           ppkb_detail.KD_SERVICE_CODE,
                           ppkb_detail.X_PPKB_KE,
                           ppkb_detail.KD_PPKB_STATUS AS STTS_PPKB,
                           (SELECT SERVICE_CODE
                              FROM mst_service_code
                             WHERE mst_service_code.kd_service_code = ppkb_detail.KD_SERVICE_CODE)
                              DEF_SERVICE_CODE,
                           (SELECT STATUS
                              FROM status_ppkb
                             WHERE status_ppkb.KD_PPKB_STATUS = ppkb_detail.KD_PPKB_STATUS)
                              KD_PPKB_STATUS,
                           ppkb.TGL_JAM_ENTRY,
                           TO_CHAR (pkk.TGL_JAM_TIBA, 'dd-mm-yyyy hh24:mi:ss') TGL_JAM_TIBA_PPKB,
                           TO_CHAR (pkk.TGL_JAM_BERANGKAT, 'dd-mm-yyyy hh24:mi:ss')
                              TGL_JAM_BERANGKAT_PPKB,
                           TO_CHAR (ppkb_detail.TANGGAL_DITETAPKAN, 'dd-mm-yyyy hh24:mi:ss')
                              TANGGAL_DITETAPKAN,
                           DECODE (PPKB_DETAIL.PANDU, 1, ', PANDU', '') PANDU,
                           DECODE (PPKB_DETAIL.PANDU_LAUT, 1, ', PANDU LAUT', '') PANDU_LAUT,
                           DECODE (PPKB_DETAIL.TUNDA, 1, ', TUNDA', '') TUNDA,
                           DECODE (PPKB_DETAIL.TUNDA_LAUT, 1, ', TUNDA LAUT', '') TUNDA_LAUT,
                           DECODE (PPKB_DETAIL.KEPIL, 1, ', KEPIL', '') KEPIL,
                           PPKB_DETAIL.STATUS_REALISASI_PANDU,
                           PPKB_DETAIL.STATUS_SPK_PANDU,
                           DECODE (ppkb_detail.STATUS_REALISASI_PANDU,
                                   0, 'PANDU : BELUM REALISASI',
                                   'PANDU : SUDAH DIREALISASI')
                              STTS_PANDU,
                           (SELECT NM_PELABUHAN
                              FROM mst_pelabuhan
                             WHERE KD_PELABUHAN = pkk.PELABUHAN_ASAL)
                              PELABUHAN_ASAL,
                           (SELECT NM_PELABUHAN
                              FROM mst_pelabuhan
                             WHERE KD_PELABUHAN = pkk.PELABUHAN_TUJUAN)
                              PELABUHAN_TUJUAN,
						   (SELECT NM_CABANG
                              FROM mst_cabang
                             WHERE KD_CABANG = mst_kapal_agen.KD_CABANG)
                              NM_CABANG,
							F_CEK_UPER(ppkb.KD_PPKB,ppkb_detail.PPKB_KE) CEK_UPER,
							ppkb_detail.kepil_d,
							ppkb_pandu_laut.tgl_jam_pmt_pandu_d tgl_jam_pmt_pandulaut_d,
							ppkb_pandu.tgl_jam_pmt_pandu_d,
							ppkb_tunda_laut.tgl_jam_pmt_tunda_d tgl_jam_pmt_tundalaut_d,
							ppkb_tunda.tgl_jam_pmt_tunda_d tgl_jam_pmt_tunda_d
					  FROM ppkb,
						   ppkb_detail,
						   mst_kapal_agen,
						   mst_kapal,
						   mst_agen,
						   pkk,
						   ppkb_pandu_laut,
						   ppkb_pandu,
						   ppkb_tunda_laut,
						   ppkb_tunda
					 WHERE     ppkb.KD_PPKB = ppkb_detail.KD_PPKB
						   AND PKK.NO_UKK = ppkb.NO_UKK
						   AND pkk.KD_KAPAL_AGEN = mst_kapal_agen.KD_KAPAL_AGEN
						   AND mst_kapal_agen.KD_KAPAL = mst_kapal.KD_KAPAL
						   AND mst_kapal_agen.KD_AGEN = mst_agen.KD_AGEN
						   AND mst_kapal_agen.KD_CABANG = mst_agen.KD_CABANG
						   AND ppkb_detail.KD_PPKB = ppkb_pandu_laut.KD_PPKB (+)
						   AND ppkb_detail.PPKB_KE = ppkb_pandu_laut.PPKB_KE (+)
						   AND ppkb_detail.KD_PPKB = ppkb_pandu.KD_PPKB (+)
						   AND ppkb_detail.PPKB_KE = ppkb_pandu.PPKB_KE (+)
						   AND ppkb_detail.KD_PPKB = ppkb_tunda_laut.KD_PPKB (+)
						   AND ppkb_detail.PPKB_KE = ppkb_tunda_laut.PPKB_KE (+)
						   AND ppkb_detail.KD_PPKB = ppkb_tunda.KD_PPKB (+)
						   AND ppkb_detail.PPKB_KE = ppkb_tunda.PPKB_KE (+)
						   ".$filter_agen."
						   ".$filter_cabang."
						   AND pkk.kd_pkk_status < '9'
					 ORDER BY ppkb.KD_PPKB desc, ppkb_detail.PPKB_KE desc";
	
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getP4Info,$query_p4_info,$err)) goto Err;
		//FETCH QUERY
		while ($row_p4_info = oci_fetch_array($query_p4_info, OCI_ASSOC))
		{
			$sql = "SELECT COUNT(KD_PPKB) JML_PPKB FROM PPKB_DETAIL WHERE KD_PPKB ='".$row_p4_info[KD_PPKB]."'";
			if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
			$row = oci_fetch_array($query, OCI_ASSOC);
			
			$sql_cms = "SELECT COUNT(1) JML_CMS FROM CMS_BAYAR WHERE KD_PPKB ='".$row_p4_info[KD_PPKB]."' AND PPKB_KE=".$row_p4_info[PPKB_KE];
			if(!checkOriSQL($conn['ori']['kapal'],$sql_cms,$query_cms,$err)) goto Err;
			$row_cms = oci_fetch_array($query_cms, OCI_ASSOC);
			
			$sql_uper = "SELECT COUNT(1) JML_UPER FROM UPER_BAYAR WHERE KD_PPKB ='".$row_p4_info[KD_PPKB]."' AND PPKB_KE=".$row_p4_info[PPKB_KE];
			if(!checkOriSQL($conn['ori']['kapal'],$sql_uper,$query_uper,$err)) goto Err;
			$row_uper = oci_fetch_array($query_uper, OCI_ASSOC);
			
			if($row_cms[JML_CMS] > 0)
				$three_partied = "CMS";
			
			else if($row_uper[JML_UPER] > 0)
				$three_partied = "UPER";
			
			$sql_jumuper = "SELECT SIGN_CURRENCY, JUMLAH_NUMBER FROM V_UPER WHERE KD_PPKB ='".$row_p4_info[KD_PPKB]."' AND PPKB_KE=".$row_p4_info[PPKB_KE];
			if(!checkOriSQL($conn['ori']['kapal'],$sql_jumuper,$query_jumuper,$err)) goto Err;
			$row_jumuper = oci_fetch_array($query_jumuper, OCI_ASSOC);
			
			//build "info" data
			$p4_sub = array(
								'KD_PPKB' => $row_p4_info[KD_PPKB],
								'PPKB_KE' => $row_p4_info[PPKB_KE],
								'KD_KAPAL' => $row_p4_info[KD_KAPAL],
								'NM_KAPAL' => $row_p4_info[NM_KAPAL],
								'NO_UKK' => $row_p4_info[NO_UKK],
								'IN_DKK' => $row_p4_info[IN_DKK],
								'KD_PROSES' => $row_p4_info[KD_PROSES],
								'KD_SERVICE_CODE' => $row_p4_info[KD_SERVICE_CODE],
								'X_PPKB_KE' => $row_p4_info[X_PPKB_KE],
								'STTS_PPKB' => $row_p4_info[STTS_PPKB],
								'DEF_SERVICE_CODE' => $row_p4_info[DEF_SERVICE_CODE],
								'KD_PPKB_STATUS' => $row_p4_info[KD_PPKB_STATUS],
								'TGL_JAM_TIBA_PPKB' => $row_p4_info[TGL_JAM_TIBA_PPKB],
								'TGL_JAM_BERANGKAT_PPKB' => $row_p4_info[TGL_JAM_BERANGKAT_PPKB],
								'TANGGAL_DITETAPKAN' => $row_p4_info[TANGGAL_DITETAPKAN],
								'PANDU' => $row_p4_info[PANDU],
								'PANDU_LAUT' => $row_p4_info[PANDU_LAUT],
								'TUNDA' => $row_p4_info[TUNDA],
								'TUNDA_LAUT' => $row_p4_info[TUNDA_LAUT],
								'KEPIL' => $row_p4_info[KEPIL],
								'STATUS_REALISASI_PANDU' => $row_p4_info[STATUS_REALISASI_PANDU],
								'STATUS_SPK_PANDU' => $row_p4_info[STATUS_SPK_PANDU],
								'STTS_PANDU' => $row_p4_info[STTS_PANDU],
								'PELABUHAN_ASAL' => $row_p4_info[PELABUHAN_ASAL],
								'PELABUHAN_TUJUAN' => $row_p4_info[PELABUHAN_TUJUAN],
								'NM_CABANG' => $row_p4_info[NM_CABANG],
								'CEK_UPER' => $row_p4_info[CEK_UPER],
								'JML_PPKB' => $row[JML_PPKB],
								'KEPIL_D' => $row_p4_info[KEPIL_D],
								'TGL_JAM_PMT_PANDULAUT_D' => $row_p4_info[TGL_JAM_PMT_PANDULAUT_D],
								'TGL_JAM_PMT_PANDU_D' => $row_p4_info[TGL_JAM_PMT_PANDU_D],
								'TGL_JAM_PMT_TUNDALAUT_D' => $row_p4_info[TGL_JAM_PMT_TUNDALAUT_D],
								'TGL_JAM_PMT_TUNDA_D' => $row_p4_info[TGL_JAM_PMT_TUNDA_D],
								'THREE_PARTIED' => $three_partied,
								'SIGN_CURRENCY' => $row_jumuper[SIGN_CURRENCY],
								'JUM_UPER' => $row_jumuper[JUMLAH_NUMBER]
							);
									
			array_push($p4,$p4_sub);
		}

		$out_data = array();
		$out_data['p4']=$p4;
		
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