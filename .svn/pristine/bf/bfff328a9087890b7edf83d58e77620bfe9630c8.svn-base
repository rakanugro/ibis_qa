<?php

/*|
 | Function Name 	: getDataP4
 | Description 		: Get Data P4
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDataP4($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_pppp = $xml_data->data->no_pppp;
		$pppp_ke = $xml_data->data->pppp_ke;
		$branch_id = $xml_data->data->branch_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		$getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$sql = "SELECT 
                    PPKB.KD_PPKB, PPKB_DETAIL.KD_SERVICE_CODE,
                    (SELECT SERVICE_CODE FROM mst_service_code WHERE KD_SERVICE_CODE = PPKB_DETAIL.KD_SERVICE_CODE) SERVICE_CODE,
                    DECODE(PPKB_DETAIL.PANDU,1,', PANDU','') PANDU,
                    DECODE(PPKB_DETAIL.TUNDA,1,', TUNDA','') TUNDA,
                    DECODE(PPKB_DETAIL.KEPIL,1,', KEPIL','') KEPIL,
                    PPKB_DETAIL.PANDU KD_PANDU,
                    PPKB_DETAIL.PANDU_LAUT KD_PANDUL,
                    PPKB_DETAIL.TUNDA KD_TUNDA,
                    PPKB_DETAIL.TUNDA_LAUT KD_TUNDAL,
                    PPKB_DETAIL.KEPIL KD_KEPIL,
                    PPKB_DETAIL.PPKB_KE, PPKB_DETAIL.X_PPKB_KE, PKK.VOYAGE_IN, PKK.VOYAGE_OUT,
                    PKK.DRAFT_DEPAN, PKK.DRAFT_BELAKANG, 
                    PKK.NO_UKK, MST_KAPAL.NM_KAPAL, MST_KAPAL.KD_KAPAL, mst_kapal.KD_BENDERA,
                    (SELECT NM_NEGARA FROM mst_bendera WHERE KD_BENDERA = MST_KAPAL.KD_BENDERA) NM_BENDERA,
                    mst_agen.KD_AGEN, MST_AGEN.NM_AGEN, MST_AGEN.KD_THREE_PARTIED, MST_KAPAL.KP_GRT, MST_KAPAL.KP_LOA, PKK.PELABUHAN_ASAL, PKK.PELABUHAN_BERIKUT,
                    MST_KAPAL.KP_DWT, 
                    PKK.PELABUHAN_SEBELUM, PKK.PELABUHAN_TUJUAN, MST_KAPAL.JN_KAPAL, MST_KAPAL.ST_KAPAL,
                    (SELECT STATUS_KAPAL FROM MST_STATUS_KAPAL WHERE ST_KAPAL = MST_KAPAL.ST_KAPAL) DEF_ST_KAPAL,
                    (SELECT PELAYARAN FROM MST_PELAYARAN WHERE KD_JN_PELAYARAN = PKK.KD_PELAYARAN) KD_PELAYARAN, 
                    PKK.KD_KEMASAN, (SELECT DET_KD_KEMASAN FROM MST_KEMASAN WHERE KD_KEMASAN=PKK.KD_KEMASAN) NM_KEMASAN, PKK.KD_KEGIATAN, 
					(SELECT KUNJUNGAN FROM MST_KUNJUNGAN WHERE KD_KUNJUNGAN=PKK.KD_KUNJUNGAN) KUNJUNGAN,
                    (SELECT NAMA_JENIS_KAPAL FROM MST_JENIS_KAPAL WHERE ID_JENIS_KAPAL = MST_KAPAL.JN_KAPAL) JNS_KAPAL,
                    (SELECT NM_PELABUHAN FROM mst_pelabuhan WHERE KD_PELABUHAN = PKK.PELABUHAN_ASAL) NM_PELABUHAN_ASAL,
                    (SELECT NM_PELABUHAN FROM mst_pelabuhan WHERE KD_PELABUHAN = PKK.PELABUHAN_SEBELUM) NM_PELABUHAN_SEBELUM,
                    (SELECT NM_PELABUHAN FROM mst_pelabuhan WHERE KD_PELABUHAN = PKK.PELABUHAN_BERIKUT) NM_PELABUHAN_BERIKUT,
                    (SELECT NM_PELABUHAN FROM mst_pelabuhan WHERE KD_PELABUHAN = PKK.PELABUHAN_TUJUAN) NM_PELABUHAN_TUJUAN,
                    to_char(PKK.TGL_JAM_TIBA,'dd-mm-yyyy hh24:mi') TGL_JAM_TIBA, 
                    to_char(PKK.TGL_JAM_BERANGKAT,'dd-mm-yyyy hh24:mi') TGL_JAM_BERANGKAT, 
                    PPKB_DETAIL.KADE_ASAL, PPKB_DETAIL.KADE_TUJUAN, PPKB_DETAIL.KD_PPKB_STATUS,
					(SELECT KD_PPKB_STATUS FROM PPKB_DETAIL B WHERE B.KD_PPKB=ppkb_detail.KD_PPKB AND B.PPKB_KE=(ppkb_detail.PPKB_KE-1)) KD_PPKB_STATUS_PREV,
					(SELECT KD_SERVICE_CODE FROM PPKB_DETAIL B WHERE B.KD_PPKB=ppkb_detail.KD_PPKB AND B.PPKB_KE=(ppkb_detail.PPKB_KE-1)) KD_SERVICE_CODE_PREV,
                    (SELECT NM_KADE FROM MST_KADE WHERE KD_KADE = PPKB_DETAIL.KADE_ASAL) NM_KADE_ASAL,
                    (SELECT NM_KADE FROM MST_KADE WHERE KD_KADE = PPKB_DETAIL.KADE_TUJUAN) NM_KADE_TUJUAN,
                    to_char(PPKB_PANDU.TGL_JAM_PMT_PANDU,'dd-mm-yyyy hh24:mi') TGL_JAM_PMT_PANDU, 
                    to_char(PPKB_PANDU.TGL_JAM_PMT_PANDU_D,'dd-mm-yyyy hh24:mi') TGL_JAM_PTP_PANDU, 
                    to_char(PPKB_PANDU_LAUT.TGL_JAM_PMT_PANDU,'dd-mm-yyyy hh24:mi') TGL_JAM_PMT_PANDU_LAUT,
                    to_char(PPKB_PANDU_LAUT.TGL_JAM_PMT_PANDU_D,'dd-mm-yyyy hh24:mi') TGL_JAM_PTP_PANDU_LAUT,
                    to_char(PPKB_TUNDA.TGL_JAM_PMT_TUNDA,'dd-mm-yyyy hh24:mi') TGL_JAM_PMT_TUNDA, 
                    to_char(PPKB_TUNDA.TGL_JAM_PMT_TUNDA_D,'dd-mm-yyyy hh24:mi') TGL_JAM_PTP_TUNDA, 
                    to_char(PPKB_TUNDA_LAUT.TGL_JAM_PMT_TUNDA,'dd-mm-yyyy hh24:mi') TGL_JAM_PMT_TUNDA_LAUT,
                    to_char(PPKB_TUNDA_LAUT.TGL_JAM_PMT_TUNDA_D,'dd-mm-yyyy hh24:mi') TGL_JAM_PTP_TUNDA_LAUT,
                    PPKB_TUNDA.REMARK_GANDENG,
                    to_char(PPKB_KEPIL.TGL_JAM_PMT_KEPIL,'dd-mm-yyyy hh24:mi') TGL_JAM_PMT_KEPIL, 
                    to_char(PPKB_KEPIL.TGL_JAM_PMT_KEPIL_D,'dd-mm-yyyy hh24:mi') TGL_JAM_PTP_KEPIL, 
                    NVL(PPKB_PANDU.NO_UKK1,PPKB_PANDU_LAUT.NO_UKK1) NO_UKK1, NVL(PPKB_PANDU.NO_UKK2,PPKB_PANDU_LAUT.NO_UKK2) NO_UKK2, NVL(PPKB_PANDU.NO_UKK3,PPKB_PANDU_LAUT.NO_UKK3) NO_UKK3, NVL(PPKB_PANDU.PKK_TK1,PPKB_PANDU_LAUT.PKK_TK1) PKK_TK1, NVL(PPKB_PANDU.PKK_TK2,PPKB_PANDU_LAUT.PKK_TK2) PKK_TK2, NVL(PPKB_PANDU.PKK_TK3,PPKB_PANDU_LAUT.PKK_TK3) PKK_TK3,
					(SELECT NM_KAPAL FROM MST_KAPAL WHERE MST_KAPAL.KD_KAPAL=PPKB_PANDU.NO_UKK1) NM_KPLTB1,
					(SELECT NM_KAPAL FROM MST_KAPAL WHERE MST_KAPAL.KD_KAPAL=PPKB_PANDU.NO_UKK2) NM_KPLTB2,
					(SELECT NM_KAPAL FROM MST_KAPAL WHERE MST_KAPAL.KD_KAPAL=PPKB_PANDU.NO_UKK3) NM_KPLTB3,
					(SELECT NM_KAPAL FROM MST_KAPAL WHERE MST_KAPAL.KD_KAPAL=PPKB_PANDU.PKK_TK1) NM_KPLTK1,
					(SELECT NM_KAPAL FROM MST_KAPAL WHERE MST_KAPAL.KD_KAPAL=PPKB_PANDU.PKK_TK2) NM_KPLTK2,
					(SELECT NM_KAPAL FROM MST_KAPAL WHERE MST_KAPAL.KD_KAPAL=PPKB_PANDU.PKK_TK3) NM_KPLTK3,
					CASE WHEN PKK.KD_KADE IS NOT NULL THEN 'PAKET' ELSE 'REGULAR' END JNS_TARIF,
					ppkb_detail.IS_BERANGKAT
				 from 
					 ppkb, 
					 ppkb_detail,
					 ppkb_tunda,
					 ppkb_tunda_laut, 
					 ppkb_pandu, 
					 ppkb_pandu_laut, 
					 ppkb_kepil,
					 mst_kapal_agen,
					 mst_kapal,
					 mst_agen,
					 pkk
				where
                    ppkb.KD_PPKB = ppkb_detail.KD_PPKB
                    and ppkb_detail.KD_PPKB = ppkb_pandu.KD_PPKB (+)
                    and ppkb_detail.PPKB_KE = ppkb_pandu.PPKB_KE (+) 
                    and ppkb_detail.KD_PPKB = ppkb_pandu_laut.KD_PPKB (+)
                    and ppkb_detail.PPKB_KE = ppkb_pandu_laut.PPKB_KE (+) 
                    and ppkb_detail.KD_PPKB = ppkb_kepil.KD_PPKB (+)
                    and ppkb_detail.PPKB_KE = ppkb_kepil.PPKB_KE (+)
                    and ppkb_detail.KD_PPKB = ppkb_tunda.KD_PPKB (+)
                    and ppkb_detail.PPKB_KE = ppkb_tunda.PPKB_KE (+)
                    and ppkb_detail.KD_PPKB = ppkb_tunda_laut.KD_PPKB (+)
                    and ppkb_detail.PPKB_KE = ppkb_tunda_laut.PPKB_KE (+)
                    and PKK.NO_UKK = ppkb.NO_UKK 
                    and pkk.KD_KAPAL_AGEN = mst_kapal_agen.KD_KAPAL_AGEN
                    and mst_kapal_agen.KD_KAPAL = mst_kapal.KD_KAPAL 
                    and mst_kapal_agen.KD_AGEN = mst_agen.KD_AGEN
                    and mst_kapal_agen.KD_CABANG = mst_agen.KD_CABANG
                    and mst_kapal_agen.KD_CABANG = F_GET_KD_CABANG_BY_UKK(PKK.NO_UKK)
                    and PPKB.KD_PPKB='".$no_pppp."' 
                    AND PPKB_DETAIL.PPKB_KE=".$pppp_ke;

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		if ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			$sql_cek = "SELECT COUNT(*) JML
						FROM CMS A,
						(SELECT F_GET_KD_AGEN_BY_UKK(PKK.NO_UKK) KD_AGEN_PPKB,
						F_GET_KD_CABANG_BY_UKK(PKK.NO_UKK) KD_CABANG_PPKB,
						F_KD_PELAYARAN_BY_UKK(PKK.NO_UKK) KD_PELAYARAN,
						PKK.TGL_JAM_ENTRY TGL_JAM_ENTRY_PKK FROM PKK
						WHERE PKK.NO_UKK = '".$row[NO_UKK]."') B
						WHERE A.KD_AGEN = B.KD_AGEN_PPKB
						AND A.KD_CABANG = B.KD_CABANG_PPKB
						--AND A.CMS_VALUTA <> B.KD_PELAYARAN -- DICOMMENT SEJAK BERLAKU KURS USD TO IDR
						AND (A.TGL_JAM_ENTRY < B.TGL_JAM_ENTRY_PKK)";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_cek,$query_cek,$err)) goto Err;
			$row_cek = oci_fetch_array($query_cek, OCI_ASSOC);
			
			if ($row_cek["JML"] > 0)
				$row["KD_THREE_PARTIED"] = "1";
			else
				$row["KD_THREE_PARTIED"] = "2";
			
			//build "info" data
			$data_sub = array(
								'KD_PPKB' => $row[KD_PPKB],
								'KD_SERVICE_CODE' => $row[KD_SERVICE_CODE],
								'SERVICE_CODE' => $row[SERVICE_CODE],
								'PANDU' => $row[PANDU],
								'TUNDA' => $row[TUNDA],
								'KEPIL' => $row[KEPIL],
								'KD_PANDU' => $row[KD_PANDU],
								'KD_PANDUL' => $row[KD_PANDUL],
								'KD_TUNDA' => $row[KD_TUNDA],
								'KD_TUNDAL' => $row[KD_TUNDAL],
								'KD_KEPIL' => $row[KD_KEPIL],
								'PPKB_KE' => $row[PPKB_KE],
								'X_PPKB_KE' => $row[X_PPKB_KE],
								'VOYAGE_IN' => $row[VOYAGE_IN],
								'VOYAGE_OUT' => $row[VOYAGE_OUT],
								'DRAFT_DEPAN' => $row[DRAFT_DEPAN],
								'DRAFT_BELAKANG' => $row[DRAFT_BELAKANG],
								'NO_UKK' => $row[NO_UKK],
								'NM_KAPAL' => $row[NM_KAPAL],
								'KD_KAPAL' => $row[KD_KAPAL],
								'KD_BENDERA' => $row[KD_BENDERA],
								'NM_BENDERA' => $row[NM_BENDERA],
								'KD_AGEN' => $row[KD_AGEN],
								'NM_AGEN' => $row[NM_AGEN],
								'KD_THREE_PARTIED' => $row[KD_THREE_PARTIED],
								'KP_GRT' => $row[KP_GRT],
								'KP_LOA' => $row[KP_LOA],
								'PELABUHAN_ASAL' => $row[PELABUHAN_ASAL],
								'PELABUHAN_BERIKUT' => $row[PELABUHAN_BERIKUT],
								'PELABUHAN_SEBELUM' => $row[PELABUHAN_SEBELUM],
								'PELABUHAN_TUJUAN' => $row[PELABUHAN_TUJUAN],
								'JN_KAPAL' => $row[JN_KAPAL],
								'KD_PELAYARAN' => $row[KD_PELAYARAN],
								'NM_KEMASAN' => $row[NM_KEMASAN],
								'KUNJUNGAN' => $row[KUNJUNGAN],
								'NM_PELABUHAN_ASAL' => $row[NM_PELABUHAN_ASAL],
								'NM_PELABUHAN_SEBELUM' => $row[NM_PELABUHAN_SEBELUM],
								'NM_PELABUHAN_BERIKUT' => $row[NM_PELABUHAN_BERIKUT],
								'NM_PELABUHAN_TUJUAN' => $row[NM_PELABUHAN_TUJUAN],
								'TGL_JAM_TIBA' => $row[TGL_JAM_TIBA],
								'TGL_JAM_BERANGKAT' => $row[TGL_JAM_BERANGKAT],
								'KADE_ASAL' => $row[KADE_ASAL],
								'KADE_TUJUAN' => $row[KADE_TUJUAN],
								'KD_PPKB_STATUS' => $row[KD_PPKB_STATUS],
								'KD_PPKB_STATUS_PREV' => $row[KD_PPKB_STATUS_PREV],
								'KD_SERVICE_CODE_PREV' => $row[KD_SERVICE_CODE_PREV],
								'NM_KADE_ASAL' => $row[NM_KADE_ASAL],
								'NM_KADE_TUJUAN' => $row[NM_KADE_TUJUAN],
								'TGL_JAM_PMT_PANDU' => $row[TGL_JAM_PMT_PANDU],
								'TGL_JAM_PMT_PANDU_LAUT' => $row[TGL_JAM_PMT_PANDU_LAUT],
								'TGL_JAM_PMT_TUNDA' => $row[TGL_JAM_PMT_TUNDA],
								'TGL_JAM_PMT_TUNDA_LAUT' => $row[TGL_JAM_PMT_TUNDA_LAUT],
								'TGL_JAM_PMT_KEPIL' => $row[TGL_JAM_PMT_KEPIL],
								'TGL_JAM_PTP_PANDU' => $row[TGL_JAM_PTP_PANDU],
								'TGL_JAM_PTP_PANDU_LAUT' => $row[TGL_JAM_PTP_PANDU_LAUT],
								'TGL_JAM_PTP_TUNDA' => $row[TGL_JAM_PTP_TUNDA],
								'TGL_JAM_PTP_TUNDA_LAUT' => $row[TGL_JAM_PTP_TUNDA_LAUT],
								'TGL_JAM_PTP_KEPIL' => $row[TGL_JAM_PTP_KEPIL],
								'NO_UKK1' => $row[NO_UKK1],
								'NO_UKK2' => $row[NO_UKK2],
								'NO_UKK3' => $row[NO_UKK3],
								'PKK_TK1' => $row[PKK_TK1],
								'PKK_TK2' => $row[PKK_TK2],
								'PKK_TK3' => $row[PKK_TK3],
								'NM_KPLTB1' => $row[NM_KPLTB1],
								'NM_KPLTB2' => $row[NM_KPLTB2],
								'NM_KPLTB3' => $row[NM_KPLTB3],
								'NM_KPLTK1' => $row[NM_KPLTK1],
								'NM_KPLTK2' => $row[NM_KPLTK2],
								'NM_KPLTK3' => $row[NM_KPLTK3],
								'JNS_TARIF' => $row[JNS_TARIF],
								'IS_BERANGKAT' => $row[IS_BERANGKAT]
							);

			array_push($getdata, $data_sub);
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['getdata']=$getdata;		
		
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