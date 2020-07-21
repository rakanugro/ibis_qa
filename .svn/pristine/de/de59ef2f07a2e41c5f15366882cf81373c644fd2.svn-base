<?php

/*|
 | Function Name 	: getPDFPPKB
 | Description 		: get PDF PPKB
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFPPKB($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("KAPAL");//hanya ambil koneksi ke kapal
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$no_ppkb = $xml_data->data->no_ppkb;
		$ppkb_ke = $xml_data->data->ppkb_ke;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();

		$getHeader="select mst_jenis_kapal.nama_jenis_kapal, mst_kapal.nm_kapal,
			ppkb_detail.labuh,
			ppkb_detail.pandu,
			ppkb_detail.tunda,
			ppkb_detail.kepil,
			ppkb_detail.tambat,
			ppkb_detail.air,
			ppkb_pandu.validasi,
		   (select status_kapal from mst_status_kapal where mst_status_kapal.st_kapal = mst_kapal.st_kapal)st_kapal,
		   mst_jenis_pelayaran.nama_pelayaran,mst_agen.kd_agen, mst_agen.nm_agen,
		   mst_agen.almt_agen, mst_agen.no_tlp1, 
		   case
				when rpk.kd_kemasan is null then
					(select mst_kemasan.det_kd_kemasan from mst_kemasan where kd_kemasan = pkk.kd_kemasan)
				else
					(select mst_kemasan.det_kd_kemasan from mst_kemasan where kd_kemasan = rpk.kd_kemasan)
		   end det_kd_kemasan,	   
		   ppkb.kd_ppkb, to_char(ppkb_detail.tgl_jam_entry, 'dd-mm-yyyy hh24:mi')tgl_jam_entry, pkk.pelabuhan_asal,
		   pkk.pelabuhan_tujuan, pkk.pelabuhan_sebelum, pkk.pelabuhan_berikut,pkk.kd_pelayaran,
		   to_char(pkk.tgl_jam_tiba, 'dd-mm-yyyy hh24:mi')tgl_jam_tiba, 
		   to_char(pkk.tgl_jam_berangkat, 'dd-mm-yyyy hh24:mi')tgl_jam_berangkat, 
		   mst_kapal.kp_grt,
		   mst_kapal.kp_dwt, mst_kapal.nm_pemilik, mst_kapal.kp_loa,
		   mst_kapal.ln_tramper,
		   ppkb.embarkasi, ppkb.debarkasi, to_char(ppkb_labuh.tgl_jam_pmt_mlabuh, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_mlabuh,
		   to_char(ppkb_labuh.tgl_jam_pmt_slabuh, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_slabuh, 
		   to_char(ppkb_labuh.tgl_jam_pmt_mlabuh_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_mlabuh_d,
		   to_char(ppkb_labuh.tgl_jam_pmt_slabuh_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_slabuh_d, 
		   to_char(ppkb_pandu.tgl_jam_pmt_pandu, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_pandu,
		   to_char(ppkb_pandu.tgl_jam_pmt_pandu_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_pandu_d, 
		   to_char(ppkb_tambat.tgl_jam_pmt_mtambat, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_mtambat,
		   to_char(ppkb_tambat.tgl_jam_pmt_stambat, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_stambat, 
		   to_char(ppkb_tambat.tgl_jam_pmt_mtambat_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_mtambat_d,
		   to_char(ppkb_tambat.tgl_jam_pmt_stambat_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_stambat_d, 
		   to_char(ppkb_tunda.tgl_jam_pmt_tunda, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_tunda,
		   to_char(ppkb_tunda.tgl_jam_pmt_tunda_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_tunda_d, 
		   to_char(ppkb_kepil.tgl_jam_pmt_kepil, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_kepil,
		   to_char(ppkb_kepil.tgl_jam_pmt_kepil_d, 'dd-mm-yyyy hh24:mi')tgl_jam_pmt_kepil_d, 
		   to_char(ppkb_air.tgl_jam_ptp_air, 'dd-mm-yyyy hh24:mi')tgl_jam_ptp_air,
		   to_char(ppkb_air.tgl_jam_ptp_air_d, 'dd-mm-yyyy hh24:mi')tgl_jam_ptp_air_d, ppkb_air.JML_TON, ppkb_air.JML_TON_D,
			ppkb.keterangan, ppkb_detail.x_ppkb_ke, ppkb_detail.ditetapkan_oleh,ppkb_pandu.validasi,
		   (select cargo_name from BARANG_PROD.tr_cargotype where cargotype_id = rpk.jns_muatan_bongkar) jns_muatan_bongkar,
		   (select cargo_name from BARANG_PROD.tr_cargotype where cargotype_id = rpk.jns_muatan_muat) jns_muatan_muat, 
		   rpk.jml_muatan_bongkar, rpk.jml_muatan_muat, pkk.no_ukk,ppkb_detail.ppkb_ke,mst_service_code.service_code,mst_bendera.nm_negara,
		   ppkb_detail.draft_depan, ppkb_detail.draft_belakang, 
		   ppkb.jmlh_abk, decode(ppkb_tambat.ramp_door,1,'RD','') ramp_door,
		   (select nm_pelabuhan from mst_pelabuhan where kd_pelabuhan = pkk.pelabuhan_asal) nm_pelabuhan_asal,
		   (select nm_pelabuhan from mst_pelabuhan where kd_pelabuhan = pkk.pelabuhan_sebelum) nm_pelabuhan_sebelum,
		   (select nm_pelabuhan from mst_pelabuhan where kd_pelabuhan = pkk.pelabuhan_tujuan) nm_pelabuhan_tujuan,
		   (select nm_pelabuhan from mst_pelabuhan where kd_pelabuhan = pkk.pelabuhan_berikut) nm_pelabuhan_berikut,
		   (select nm_kade from mst_kade where kd_kade = ppkb_detail.kade_asal) kd_asal, ppkb_detail.kade_asal, ppkb_detail.kade_tujuan,
		   (select nm_kade from mst_kade where kd_kade = ppkb_detail.kade_tujuan) kd_tujuan,
		   nvl(rpk.METER_AWAL,0) M_AWAL, nvl(rpk.METER_AKHIR,0) M_AKHIR,
		   to_char(sysdate,'dd-mm-yyyy hh24:mi') tgl_cetak,
		   decode(ppkb_detail.kepil,1,'Dikenakan','Tidak Dikenakan') kd_kepil,
		   mst_agen.no_account, 
		   (select jenis_three_partied from mst_three_partied where kd_three_partied = mst_agen.kd_three_partied) nama_three_partied,
		   DECODE(PKK.KD_PELAYARAN,'1','US$','2','Rp')sign_currency,
			decode(mst_agen.kd_three_partied,'1','0',(select JUMLAH from v_uper
									where kd_ppkb = '".$no_ppkb."'
									and ppkb_ke = '".$ppkb_ke."'
									and cc = 'b')) jumlah,
		   to_char(ppkb_detail.tanggal_ditetapkan,'dd-mm-yyyy hh24:mi') tanggal_ditetapkan,
		   (select nm_pbm from mst_pbm where kd_pbm = ttm_oprplan.pbm_id) pbm,
		   ppkb_detail.remark as remark_tambatan,	   
		   (decode(rpk.remark_tambatan,'', 'EX : ' || (select NM_KAPAL from mst_kapal where mst_kapal.kd_kapal = rpk.ex_kapal),rpk.remark_tambatan )) as remark_tambatan_rpk,
		   ttm_oprplan.sop, rpk.opr_plan_id,(SELECT NM_CABANG FROM MST_CABANG WHERE KD_CABANG = SUBSTR(PKK.NO_UKK,5,2))CABANG,
		   to_char(ppkb.TGL_JAM_BERANGKAT_PPKB,'dd-mm-yyyy hh24:mi') TGL_JAM_BERANGKAT_PPKB, ppkb_detail.is_emergency, ppkb_detail.KD_PPKB_STATUS,decode(rpk.ex_kapal,'0','',(select NM_KAPAL from MST_KAPAL where MST_KAPAL.KD_KAPAL = rpk.ex_kapal)) ex_kapal, all_general_pkg.get_subsidiary_branch_name('KAPAL','01',TO_DATE(TO_CHAR(PKK.TGL_JAM_TIBA,'dd-mm-yyyy'),'dd-mm-yyyy')) CABANG1
	  from ppkb,
		   pkk,
		   mst_kapal_agen,
		   mst_kapal,
		   ppkb_detail,
		   ppkb_labuh,
		   ppkb_pandu,
		   mst_bendera,
		   mst_agen,
		   mst_jenis_kapal,
		   mst_jenis_pelayaran,
		   ppkb_tambat,
		   ppkb_tunda,
		   ppkb_kepil,
		   ppkb_air,
		   rpk,
		   mst_service_code,
		   v_uper,
		   BARANG_PROD.ttm_oprplan ttm_oprplan
	 where      ppkb_detail.kd_rpk = rpk.kd_rpk (+)
			and pkk.no_ukk = ppkb.no_ukk 
			and pkk.kd_kapal_agen = mst_kapal_agen.kd_kapal_agen
			and mst_kapal_agen.kd_kapal = mst_kapal.kd_kapal
			and ppkb.kd_ppkb = ppkb_detail.kd_ppkb
			and ppkb_detail.kd_ppkb = ppkb_labuh.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = ppkb_labuh.ppkb_ke (+)
			and ppkb_detail.kd_ppkb = ppkb_pandu.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = ppkb_pandu.ppkb_ke (+)
			and mst_kapal.kd_bendera = mst_bendera.kd_bendera
			and mst_kapal_agen.kd_agen = mst_agen.kd_agen
			and mst_jenis_kapal.id_jenis_kapal = mst_kapal.jn_kapal
			and pkk.kd_pelayaran = mst_jenis_pelayaran.jn_pelayaran
			and ppkb_detail.kd_ppkb = ppkb_tambat.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = ppkb_tambat.ppkb_ke (+)
			and ppkb_detail.kd_ppkb = ppkb_tunda.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = ppkb_tunda.ppkb_ke (+)
			and ppkb_detail.kd_ppkb = ppkb_kepil.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = ppkb_kepil.ppkb_ke (+)
			and ppkb_detail.kd_ppkb = ppkb_air.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = ppkb_air.ppkb_ke (+)
			and ppkb_detail.kd_service_code = mst_service_code.kd_service_code
			and ppkb_detail.kd_ppkb = v_uper.kd_ppkb (+)
			and ppkb_detail.ppkb_ke = v_uper.ppkb_ke (+)		
			and ttm_oprplan.opr_plan_id (+) = rpk.opr_plan_id
			AND	ppkb_detail.kd_ppkb='".$no_ppkb."'
			AND ppkb_detail.ppkb_ke='".$ppkb_ke."'";
		
		if(!checkOriSQL($conn['ori']['kapal'],$getHeader,$query_header,$err,$debug)) goto Err;

		//FETCH QUERY
		$row = oci_fetch_array($query_header, OCI_ASSOC);	
		// date_default_timezone_set('Asia/Jakarta');
		// $date=date('d M Y H:i:s');
		
		if($row["LN_TRAMPER"] == '1'){
			$row["KD_REGULER"] ="REGULER";
		} else {
			$row["KD_REGULER"] ="NON REGULER";
		}
		/*DATA*/
		$row['JENIS_PERMINTAAN'] = ($row['LABUH'] == 1)?'LABUH ':'';
		$row['JENIS_PERMINTAAN'] .= ($row['PANDU'] == 1)?'PANDU ':'';
		$row['JENIS_PERMINTAAN'] .= ($row['TUNDA'] == 1)?'TUNDA ':'';
		$row['JENIS_PERMINTAAN'] .= ($row['KEPIL'] == 1)?'KEPIL ':'';
		$row['JENIS_PERMINTAAN'] .= ($row['TAMBAT'] == 1)?'TAMBAT ':'';
		$row['JENIS_PERMINTAAN'] .= ($row['AIR'] == 1)?'AIR ':'';
		
		$opr_id = $row["OPR_PLAN_ID"];
		
		$getDetail="select TTM_OPRPLAN.opr_plan_id,
        nvl(TON_DISCH_LP,0) TON_DISCH_LP, nvl(TON_DISCH_GD,0) TON_DISCH_GD, nvl(TON_DISCH_TL,0) TON_DISCH_TL, nvl((TON_DISCH_LP + TON_DISCH_GD + TON_DISCH_TL),0) TTL_B_TON,
        nvl(M3_DISCH_LP,0) M3_DISCH_LP, nvl(M3_DISCH_GD,0) M3_DISCH_GD, nvl(M3_DISCH_TL,0) M3_DISCH_TL,  nvl((M3_DISCH_LP + M3_DISCH_GD + M3_DISCH_TL),0) TTL_B_M3,
        nvl(UNIT_DISCH_LP,0) UNIT_DISCH_LP, nvl(UNIT_DISCH_GD,0) UNIT_DISCH_GD, nvl(UNIT_DISCH_TL,0) UNIT_DISCH_TL, nvl((UNIT_DISCH_LP + UNIT_DISCH_GD + UNIT_DISCH_TL),0) TTL_B_UNIT,
        nvl(TON_LOAD_LP,0) TON_LOAD_LP, nvl(TON_LOAD_GD,0) TON_LOAD_GD, nvl(TON_LOAD_TL,0) TON_LOAD_TL, nvl((TON_LOAD_LP + TON_LOAD_GD + TON_LOAD_TL),0) TTL_M_TON,
        nvl(M3_LOAD_LP,0) M3_LOAD_LP, nvl(M3_LOAD_GD,0) M3_LOAD_GD, nvl(M3_LOAD_TL,0) M3_LOAD_TL, nvl((M3_LOAD_LP + M3_LOAD_GD + M3_LOAD_TL),0) TTL_M_M3,
        nvl(UNIT_LOAD_LP,0) UNIT_LOAD_LP, nvl(UNIT_LOAD_GD,0) UNIT_LOAD_GD, nvl(UNIT_LOAD_TL,0) UNIT_LOAD_TL, nvl((UNIT_LOAD_LP + UNIT_LOAD_GD + UNIT_LOAD_TL),0) TTL_M_UNIT, nvl((E20_DISCH_LN_TL+E20_DISCH_DN_TL+E20_DISCH_LN_TS+E20_DISCH_DN_TS),0) as B_MT20, nvl((F20_DISCH_LN_TL+F20_DISCH_DN_TL+F20_DISCH_LN_TS+F20_DISCH_DN_TS),0) as B_FT20, nvl((H20_DISCH_LN_TL+H20_DISCH_DN_TL+H20_DISCH_LN_TS+H20_DISCH_DN_TS),0) as B_OH20, nvl((E40_DISCH_LN_TL+E40_DISCH_DN_TL+E40_DISCH_LN_TS+E40_DISCH_DN_TS),0) as B_MT40, nvl((F40_DISCH_LN_TL+F40_DISCH_DN_TL+F40_DISCH_LN_TS+F40_DISCH_DN_TS),0) as B_FT40, nvl((H40_DISCH_LN_TL+H40_DISCH_DN_TL+H40_DISCH_LN_TS+H40_DISCH_DN_TS),0) as B_OH40, nvl((E20_DISCH_LN_TL+E20_DISCH_DN_TL+E20_DISCH_LN_TS+E20_DISCH_DN_TS+F20_DISCH_LN_TL+F20_DISCH_DN_TL+F20_DISCH_LN_TS+F20_DISCH_DN_TS+H20_DISCH_LN_TL+H20_DISCH_DN_TL+H20_DISCH_LN_TS+H20_DISCH_DN_TS+E40_DISCH_LN_TL+E40_DISCH_DN_TL+E40_DISCH_LN_TS+E40_DISCH_DN_TS+F40_DISCH_LN_TL+F40_DISCH_DN_TL+F40_DISCH_LN_TS+F40_DISCH_DN_TS+H40_DISCH_LN_TL+H40_DISCH_DN_TL+H40_DISCH_LN_TS+H40_DISCH_DN_TS),0) AS B_TTL, nvl((E20_LOAD_LN_TL+E20_LOAD_DN_TL+E20_LOAD_LN_TS+E20_LOAD_DN_TS),0) as M_MT20, nvl((F20_LOAD_LN_TL+F20_LOAD_DN_TL+F20_LOAD_LN_TS+F20_LOAD_DN_TS),0) as M_FT20, nvl((H20_LOAD_LN_TL+H20_LOAD_DN_TL+H20_LOAD_LN_TS+H20_LOAD_DN_TS),0) as M_OH20, nvl((E40_LOAD_LN_TL+E40_LOAD_DN_TL+E40_LOAD_LN_TS+E40_LOAD_DN_TS),0) as M_MT40, nvl((F40_LOAD_LN_TL+F40_LOAD_DN_TL+F40_LOAD_LN_TS+F40_LOAD_DN_TS),0) as M_FT40, nvl((H40_LOAD_LN_TL+H40_LOAD_DN_TL+H40_LOAD_LN_TS+H40_LOAD_DN_TS),0) as M_OH40, nvl((E20_LOAD_LN_TL+E20_LOAD_DN_TL+E20_LOAD_LN_TS+E20_LOAD_DN_TS+F20_LOAD_LN_TL+F20_LOAD_DN_TL+F20_LOAD_LN_TS+F20_LOAD_DN_TS+H20_LOAD_LN_TL+H20_LOAD_DN_TL+H20_LOAD_LN_TS+H20_LOAD_DN_TS+E40_LOAD_LN_TL+E40_LOAD_DN_TL+E40_LOAD_LN_TS+E40_LOAD_DN_TS+F40_LOAD_LN_TL+F40_LOAD_DN_TL+F40_LOAD_LN_TS+F40_LOAD_DN_TS+H40_LOAD_LN_TL+H40_LOAD_DN_TL+H40_LOAD_LN_TS+H40_LOAD_DN_TS),0) AS M_TTL 
        from BARANG_PROD.TTM_OPRPLAN where opr_plan_id = '".$opr_id."'";
		//print_R($query_dtl);die;
		
		if(!checkOriSQL($conn['ori']['kapal'],$getDetail,$query_detail,$err,$debug)) goto Err;
		$row2 = oci_fetch_array($query_detail, OCI_ASSOC);
		
		#############
		# TOTAL MIN CMS AGEN
		$sql_cms ="select * from V_CMS_LIST2 where kd_agen='".$row["KD_AGEN"]."'" ;
		if(!checkOriSQL($conn['ori']['kapal'],$sql_cms,$query_cms,$err,$debug)) goto Err;
		$row_cms = oci_fetch_array($query_cms, OCI_ASSOC);

		if( ($row_cms["STAT_CMS_DOLLAR"] == 1) & ($row_cms["STAT_CMS_RUPIAH"] == 0) & ($row["KD_PELAYARAN"] == 2)  ){
		
			$row["NAMA_THREE_PARTIED"] ="Wajib Uper";
			
			$sql_wajib_uper = "select SIGN_CURRENCY, JUMLAH from v_uper
									where kd_ppkb = '".$no_ppkb."'
									and ppkb_ke = '".$ppkb_ke."'
									and cc = 'b'";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_wajib_uper,$query_wajib_uper,$err,$debug)) goto Err;
			$rs_wajib	= oci_fetch_array($query_wajib_uper, OCI_ASSOC);
			$row["JUMLAH"] = $rs_wajib["JUMLAH"];
			$row["SIGN_CURRENCY"] = $rs_wajib["SIGN_CURRENCY"];
									
		} else {

			if( ($row_cms["STAT_CMS_DOLLAR"] == 0) & ($row_cms["STAT_CMS_RUPIAH"] == 1) & ($row["KD_PELAYARAN"] == 1)  ){
			
				$row["NAMA_THREE_PARTIED"] ="Wajib Uper";
				
				$sql_wajib_uper = "select SIGN_CURRENCY, JUMLAH from v_uper
										where kd_ppkb = '".$no_ppkb."'
										and ppkb_ke = '".$ppkb_ke."'
										and cc = 'b'";
				if(!checkOriSQL($conn['ori']['kapal'],$sql_wajib_uper,$query_wajib_uper,$err,$debug)) goto Err;
				$rs_wajib	= oci_fetch_array($query_wajib_uper, OCI_ASSOC);
				$row["JUMLAH"] = $rs_wajib["JUMLAH"];
				$row["SIGN_CURRENCY"] = $rs_wajib["SIGN_CURRENCY"];
										
			}
		
		}
		
		if ( ($row['KADE_ASAL'] == 'ANCH') && ($row['KADE_TUJUAN'] == '9999') ) {
			if (($row['KD_PPKB_STATUS'] == '2')) {
				$row["TGL_JAM_PMT_SLABUH_D"] = $row["TGL_JAM_BERANGKAT_PPKB"];
			}
			$row["TGL_JAM_PMT_SLABUH"] = $row["TGL_JAM_BERANGKAT_PPKB"];
		}

$isi = '
	<div style="font-family:Serif; font-size:8pt;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong>
            <!--Tanggal : $date $jam-->
            </strong> </td>
          <td><div style="font-weight:bold; text-align:right; font-size:9pt;">FM.01/01/01/01</div></td>
        </tr>
      </table>
      <div style="text-align:center;font-size:12pt;font-weight:bold;"> PERMINTAAN PELAYANAN KAPAL DAN BARANG <br />
        (&nbsp;P&nbsp;P&nbsp;K&nbsp;B&nbsp;) </div>
      <br />
      <table  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="90">Service Code</td>
          <td width="10">:</td>
          <td width="200" style="font-size:10pt"><strong>'.$row[SERVICE_CODE].'</strong></td>
          <td width="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. PPKB </td>
          <td width="10">:</td>
          <td width="150" style="font-size:12pt"><strong>'.$row[KD_PPKB].'</strong></td>
        </tr>
        <tr>
          <td width="90">Jenis Permintaan</td>
          <td width="10">:</td>
          <td width="200"><strong>'.$row[JENIS_PERMINTAAN].'</strong></td>
          <td width="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PPKB Ke </td>
          <td width="10">:</td>
          <td width="150"><strong>'.$row[PPKB_KE].'</strong> Ex <strong>'.$row[X_PPKB_KE].'</strong></td>
        </tr>
        <tr>
          <td width="90">1.Tgl/Jam Entry </td>
          <td width="10">:</td>
          <td width="200">'.$row[TGL_JAM_ENTRY].'</td>
          <td width="130">12.Draft Depan/Blk/RDoor </td>
          <td width="10">:</td>
          <td width="120"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>'.$row[DRAFT_DEPAN].'</td>
                <td>/</td>
                <td>'.$row[DRAFT_BELAKANG].'</td>
                <td>/</td>
                <td>'.$row[RAMP_DOOR].'</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="90">2.Nama Kapal </td>
          <td width="10">:</td>
          <td width="200"><strong>'.$row[NM_KAPAL].'</strong></td>
          <td width="130">13.Jenis Kemasan </td>
          <td width="10">:</td>
          <td width="150"><strong>'.$row[DET_KD_KEMASAN].'</strong></td>
        </tr>
        <tr>
          <td width="90">3.Bendera/PKK </td>
          <td width="10">:</td>
          <td width="200"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="55" align="left"><strong>'.$row[NM_NEGARA].'</strong></td>
                <td width="10">/</td>
                <td width="65"align="center"><strong>'.$row[NO_UKK].'</strong></td>
              </tr>
            </table></td>
          <td width="130">14.Jenis Muatan </td>
          <td width="10">:</td>
          <td width="150"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70"><strong>'.$row[JNS_MUATAN_BONGKAR].'</strong></td>
                <td width="10">/</td>
                <td width="70"><strong>'.$row[JNS_MUATAN_MUAT].'</strong></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="90">4.Pemilik/Owner</td>
          <td width="10">:</td>
          <td width="200">'.$row[NM_PEMILIK].'</td>
          <td width="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Bongkar</td>
          <td width="10">:</td>
          <td width="150"><table width="400" height="19" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="35" align="left"><strong>'.$row[JML_MUATAN_BONGKAR].'</strong></td>
                <td>Ton/Box</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="90">5.Keagenan</td>
          <td width="10">:</td>
          <td width="200"><strong>'.$row[NM_AGEN].'/&nbsp;&nbsp;&nbsp;'.$row[KD_AGEN].'</strong></td>
          <td width="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Muat</td>
          <td width="10">:</td>
          <td width="150"><table width ="400" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="35" align="left"><strong>'.$row[JML_MUATAN_MUAT].'</strong></td>
                <td >Ton/Box</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="90">&nbsp;&nbsp;&nbsp;- Alamat/Acc. </td>
          <td width="10">:</td>
          <td width="200">'.$row[ALMT_AGEN].' /  '.$row[NO_ACCOUNT].' </td>
          <td width="130">15.ABK/Pnp.Embar/Debar</td>
          <td width="10">:</td>
          <td width="120"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>'.$row[JMLH_ABK].'</td>
                <td>/</td>
                <td>'.$row[EMBARKASI].'</td>
                <td>/</td>
                <td>'.$row[DEBARKASI].'</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="90">&nbsp;&nbsp;&nbsp;- Telepon/Fax </td>
          <td width="10">:</td>
          <td width="200">'.$row[NO_TLP1].'</td>
          <td width="130">16.Pelabuhan Asal </td>
          <td width="10">:</td>
          <td width="150">'.$row[PELABUHAN_ASAL].'/'.$row[NM_PELABUHAN_ASAL].'</td>
        </tr>
        <tr>
          <td width="90">6.Status Kapal </td>
          <td width="10">:</td>
          <td width="200">'.$row[ST_KAPAL].'</td>
          <td width="130">17.Pelabuhan Sebelum </td>
          <td width="10">:</td>
          <td width="150">'.$row[PELABUHAN_SEBELUM].'/'.$row[NM_PELABUHAN_SEBELUM].'</td>
        </tr>
        <tr>
          <td width="90">7.Jenis Kapal </td>
          <td width="10">:</td>
          <td width="200"><strong>'.$row[NAMA_JENIS_KAPAL].'</strong></td>
          <td width="130">18.Pelabuhan Berikut </td>
          <td width="10">:</td>
          <td width="150"><strong>'.$row[PELABUHAN_BERIKUT].'/'.$row[NM_PELABUHAN_BERIKUT].'</strong></td>
        </tr>
        <tr>
          <td width="90">8.Jenis Pelayaran </td>
          <td width="10">:</td>
          <td width="200"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="90" align="left">'.$row[NAMA_PELAYARAN].'</td>
                <td>'.$row[KD_REGULER].'</td>
              </tr>
            </table></td>
          <td width="130">19.Pelabuhan Akhir </td>
          <td width="10">:</td>
          <td width="150"><strong>'.$row[PELABUHAN_TUJUAN].'/'.$row[NM_PELABUHAN_TUJUAN].'</strong></td>
        </tr>
        <tr>
          <td width="90">9.PBM</td>
          <td width="10">:</td>
          <td width="200">'.$row[PBM].'</td>
          <td width="130">20.Posisi Kapal </td>
          <td width="10">:</td>
          <td width="150"><strong>'.$row[KD_ASAL].'</strong></td>
        </tr>
        <tr>
          <td width="90">10.GT/DWT</td>
          <td width="10">:</td>
          <td width="200"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30" align="left"><strong>'.$row[KP_GRT].'</strong></td>
                <td width="10">/</td>
                <td><strong>'.$row[KP_DWT].'</strong></td>
              </tr>
            </table></td>
          <td width="130">21.Tanggal/Jam Tiba </td>
          <td width="10">:</td>
          <td width="150">'.$row[TGL_JAM_TIBA].'</td>
        </tr>
        <tr>
          <td width="90">11.Panjang Kapal </td>
          <td width="10">:</td>
          <td width="200"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="90" align="left"><strong>'.$row[KP_LOA].'</strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          <td width="130">22.Tanggal/Jam Berangkat </td>
          <td width="10">:</td>
          <td width="150">'.$row[TGL_JAM_BERANGKAT].'</td>
        </tr>
      </table>
      <div style="text-align:center; font-family:Helvetica; font-size:7.5pt;"><b>*** AGAR DITELITI, KEKELIRUAN DATA PERMOHONAN PPKB TERSEBUT SEPENUHNYA MENJADI TANGGUNG JAWAB PEMAKAI JASA ***</b></div>
      <br />
      <table style="border: TB dashed;" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100" height="12">Uraian</td>
          <td width="150">Permohonan</td>
          <td width="200">Penetapan Pelayanan </td>
          <td>Petugas</td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50">Lokasi</td>
          <td width="10">:</td>
          <td width="140" style="font-size:9pt;"><strong>'.$row[KD_ASAL].'</strong></td>
          <td width="60">Kade Meter </td>
          <td width="10">:</td>
          <td width="50" align="right" style="font-size:10pt;"><strong>0</strong></td>
          <td width="25" align="right">s.d.</td>
          <td width="50" align="right" style="font-size:10pt;"><strong>0</strong></td>
        </tr>
        <tr>
          <td width="50">Tujuan</td>
          <td width="10">:</td>
          <td width="140" style="font-size:10pt;"><strong>'.$row[KD_TUJUAN].'</strong></td>
          <td width="60">Kade Meter </td>
          <td width="10">:</td>
          <td width="50" align="right" style="font-size:10pt;"><strong>'.$row[M_AWAL].'</strong></td>
          <td width="25" align="right">s.d.</td>
          <td width="50" align="right" style="font-size:10pt;"><strong>'.$row[M_AKHIR].'</strong></td>
        </tr>
      </table>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="60">&nbsp;</td>
          <td width="10">&nbsp;</td>
          <td width="150">Tanggal&nbsp;&nbsp;&nbsp;&nbsp;Jam </td>
          <td width="30">&nbsp;</td>
          <td width="200"><strong>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;Jam </strong></td>
          <td width="150">&nbsp;</td>
        </tr>
        <tr>
          <td width="60">Labuh</td>
          <td width="10">:</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PMT_MLABUH].'</td>
          <td width="30">&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PMT_MLABUH_D].'</td>
          <td width="150">&nbsp;</td>
        </tr>
        <tr>
          <td width="60" >&nbsp;</td>
          <td width="10" >&nbsp;</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PMT_SLABUH].'</td>
          <td width="30" >&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PMT_SLABUH_D].'</td>
          <td width="150" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td width="60">Pemanduan</td>
          <td width="10">:</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PMT_PANDU].'</td>
          <td width="30">&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PMT_PANDU_D].'</td>
          <td width="150" align="left"><strong>'.$row[VALIDASI].'</strong></td>
        </tr>
        <tr>
          <td width="60" >Penundaan</td>
          <td width="10" >:</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PMT_TUNDA].'</td>
          <td width="30" >&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PMT_TUNDA_D].'</td>
          <td width="150" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="60">Penambatan</td>
          <td width="10" >:</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PMT_MTAMBAT].'</td>
          <td width="30" >&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PMT_MTAMBAT_D].'</td>
          <td width="150" >&nbsp;</td>
        </tr>
        <tr>
          <td width="60" >&nbsp;</td>
          <td width="10" >&nbsp;</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PMT_STAMBAT].'</td>
          <td width="30" >&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PMT_STAMBAT_D].'</td>
          <td width="150" align="left" ><strong>
          '.$row[DITETAPKAN_OLEH].'
          </strong></td>
        </tr>
        <tr>
          <td width="60">Kepil</td>
          <td width="10">:</td>
          <td width="150" style="font-size:10pt">'.$row[KD_KEPIL].'</td>
          <td width="30" >&nbsp;</td>
          <td width="200" >&nbsp;</td>
          <td width="150">&nbsp;</td>
        </tr>
        <tr>
          <td width="60">Air</td>
          <td width="10">:</td>
          <td width="150" style="font-size:10pt">'.$row[TGL_JAM_PTP_AIR].'</td>
          <td width="30">&nbsp;</td>
          <td width="200" style="font-size:10pt">'.$row[TGL_JAM_PTP_AIR_D].'</td>
          <td width="150">&nbsp;</td>
        </tr>
        <tr>
          <td width="60" >&nbsp;</td>
          <td width="10" >&nbsp;</td>
          <td width="150" ><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20" align="right" style="font-size:10pt">'.$row[JML_TON].'</td>
                <td width="28" align="center" style="font-size:10pt">Ton / </td>
                <td width="20" align="center">-</td>
              </tr>
            </table></td>
          <td width="30" >&nbsp;</td>
          <td width="200" ><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20" align="right" style="font-size:10pt">'.$row[JML_TON_D].'</td>
                <td width="28" align="center" style="font-size:10pt"><strong>Ton / </strong></td>
                <td width="20" align="center"><strong>-</strong></td>
              </tr>
            </table></td>
          <td width="150" >&nbsp;</td>
        </tr>
      </table>
      <br>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="60">Uper Kapal </td>
          <td width="10">:</td>
          <td width="20" style="font-size:10pt">
          	'.$row[SIGN_CURRENCY].'
          </td>
          <td width="120" align="left" style="font-size:10pt">
          '.$row[JUMLAH].'
          </td>
        </tr>
        <tr>
          <td width="60">Keterangan</td>
          <td width="10">:</td>
          <td width="140" colspan="2">'.$row[NAMA_THREE_PARTIED].'
			<block name="ugd">
			<b> ( KAPAL EMERGENCY )</b>
			</block>			  
		  </td>
        </tr>
      </table>
      <hr />
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="70"><strong>Barang Umum </strong></td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">Lapangan</td>
          <td width="60" align="right">Gudang</td>
          <td width="60" align="right">Truck</td>
          <td width="60" align="right">Jumlah</td>
          <td width="10">&nbsp;</td>
          <td width="180">&nbsp;</td>
        </tr>
        <tr height="5">
          <td width="70" height="5">&nbsp;</td>
          <td width="8">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="10">&nbsp;</td>
          <td width="180">&nbsp;</td>
        </tr>
        <tr>
          <td width="70"><strong>Bongkar</strong></td>
          <td width="8">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="10">&nbsp;</td>
          <td width="180"><strong>Lokasi Bongkar </strong></td>
        </tr>
        <tr>
          <td width="70" align="right">Ton</td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">'.$row2[TON_DISCH_LP].'</td>
          <td width="60" align="right">'.$row2[TON_DISCH_GD].'</td>
          <td width="60" align="right">'.$row2[TON_DISCH_TL].'</td>
          <td width="60" align="right">'.$row2[TTL_B_TON].'</td>
          <td width="10">&nbsp;</td>
          <td width="180"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50">Gudang</td>
                <td width="10">:</td>
                <td width="125" align="left">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="70" align="right">M3</td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">'.$row2[M3_DISCH_LP].'</td>
          <td width="60" align="right">'.$row2[M3_DISCH_GD].'</td>
          <td width="60" align="right">'.$row2[M3_DISCH_TL].'</td>
          <td width="60" align="right">'.$row2[TTL_B_M3].'</td>
          <td width="10">&nbsp;</td>
          <td width="180"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50">Lapangan</td>
                <td width="10">:</td>
                <td width="125" align="left">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="70" align="right">Unit/Ekor</td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">'.$row2[UNIT_DISCH_LP].'</td>
          <td width="60" align="right">'.$row2[UNIT_DISCH_GD].'</td>
          <td width="60" align="right">'.$row2[UNIT_DISCH_TL].'</td>
          <td width="60" align="right">'.$row2[TTL_B_UNIT].'</td>
          <td width="10">&nbsp;</td>
          <td width="180">&nbsp;</td>
        </tr>
        <tr height="5">
          <td width="70" height="5">&nbsp;</td>
          <td width="8">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="10">&nbsp;</td>
          <td width="180">&nbsp;</td>
        </tr>
        <tr>
          <td width="70"><strong>Muat</strong></td>
          <td width="8">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="60">&nbsp;</td>
          <td width="10">&nbsp;</td>
          <td width="180"><strong>Lokasi Muat </strong></td>
        </tr>
        <tr>
          <td width="70" align="right">Ton</td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">'.$row2[TON_LOAD_LP].'</td>
          <td width="60" align="right">'.$row2[TON_LOAD_GD].'</td>
          <td width="60" align="right">'.$row2[TON_LOAD_TL].'</td>
          <td width="60" align="right">'.$row2[TTL_M_TON].'</td>
          <td width="10">&nbsp;</td>
          <td width="180"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50">Gudang</td>
                <td width="10">:</td>
                <td width="125" align="left">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="70" align="right">M3</td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">'.$row2[M3_LOAD_LP].'</td>
          <td width="60" align="right">'.$row2[M3_LOAD_GD].'</td>
          <td width="60" align="right">'.$row2[M3_LOAD_TL].'</td>
          <td width="60" align="right">'.$row2[TTL_M_M3].'</td>
          <td width="10">&nbsp;</td>
          <td width="180"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50">Lapangan</td>
                <td width="10">:</td>
                <td width="125" align="left">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="70" align="right">Unit/Ekor</td>
          <td width="8">&nbsp;</td>
          <td width="60" align="right">'.$row2[UNIT_LOAD_LP].'</td>
          <td width="60" align="right">'.$row2[UNIT_LOAD_GD].'</td>
          <td width="60" align="right">'.$row2[UNIT_LOAD_TL].'</td>
          <td width="60" align="right">'.$row2[TTL_M_UNIT].'</td>
          <td width="10">&nbsp;</td>
          <td width="180">&nbsp;</td>
        </tr>
      </table>
      <br />
      <b>Container</b><br />
      <table width="450" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right">40\'MT</td>
          <td align="right">40\'FL</td>
          <td align="right">40\'OH MT </td>
          <td align="right">40\'OH FL </td>
          <td align="right">20\'MT</td>
          <td align="right">20\'FL</td>
          <td align="right">20\'OH MT </td>
          <td align="right">20\'OH FL </td>
          <td align="right">JUMLAH</td>
        </tr>
      </table>
      <b>Bongkar</b><br />
      <table width="450" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right">'.$row2[B_MT40].'</td>
          <td align="right">'.$row2[B_FT40].'</td>
          <td align="right">'.$row2[B_OH40].'</td>
          <td align="right">0</td>
          <td align="right">'.$row2[B_MT20].'</td>
          <td align="right">'.$row2[B_FT20].'</td>
          <td align="right">'.$row2[B_OH20].'</td>
          <td align="right">0</td>
          <td align="right">'.$row2[B_TTL].'</td>
        </tr>
      </table>
      <b>Muat</b><br />
      <table width="450" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right">'.$row2[M_MT40].'</td>
          <td align="right">'.$row2[M_FT40].'</td>
          <td align="right">'.$row2[M_OH40].'</td>
          <td align="right">0</td>
          <td align="right">'.$row2[M_MT20].'</td>
          <td align="right">'.$row2[M_FT20].'</td>
          <td align="right">'.$row2[M_OH20].'</td>
          <td align="right">0</td>
          <td align="right">'.$row2[M_TTL].'</td>
        </tr>
      </table>
      <hr style="border: dashed; " />
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="60" height="20">Catatan : [</td>
          <td width="350"> ppkb ~ :'.$row[REMARK_TAMBATAN].' <br/>rpk ~ : '.$row[REMARK_TAMBATAN_RPK].' 
          /Ex Kapal '.$row[EX_KAPAL].'
          </td>
          <td width="40">] SOP :</td>
          <td width="50" align="right"><b>'.$row[SOP].'</b></td>
        </tr>
      </table>
      <hr style="border: dashed; " />
      <table width="100%" border="0">
        <tr>
          <td>DI TETAPKAN TANGGAL : <b>'.$row[TANGGAL_DITETAPKAN].'</b></td>
          <td align="right">TANGGAL CETAK : <b>'.$row[TGL_CETAK].'</b></td>
        </tr>
      </table>
      <div style="font-size:7pt" align="center">
        <table border="B dashed" cellspacing="8" cellpadding="">
          <tr>
            <td width="160" align="center"><!--CABANG PELABUHAN--> '.$row[CABANG1].'<br />
              <!--GENERAL MANAGER--> <br/>
              <br/>
              <br/></td>
            <td width="80" align="center">UTPK</td>
            <td width="80" align="center">PBM / TO</td>
            <td width="160" align="center">PELAYARAN / AGEN<br />
              <strong>'.$row[NM_AGEN].'</strong></td>
          </tr>
        </table>
      </div>
    </div>
';
		
$tbl = <<<EOD
$isi
EOD;
		
		$html_tcpdf = $tbl;
					
		$data = array(
						"html_tcpdf" => base64_encode($html_tcpdf)
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