<?php

/*|
 | Function Name 	: getDetailPKK
 | Description 		: Get detail PKK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDetailPKK($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("KAPAL");
		$conn['ori'] += oriDb("SIMKEU");
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$pkk = $xml_data->data->no_pkk;
		// $agent_id = $xml_data->data->agent_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get pkk info
		//PL/SQL
		/*
		| updater : tofan
		| update  : v_list_pkk_ibis
		*/
		$getPkkInfo = "select v_list_pkk_ibis.*,mst_kapal.* from v_list_pkk_ibis
                                    LEFT JOIN mst_kapal ON mst_kapal.kd_kapal=v_list_pkk_ibis.kd_kapal
									WHERE no_ukk = '$pkk' /*and kd_agen = '$agent_id'*/";

		//select * from pkk
		//select * from mst_pelabuhan
	
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getPkkInfo,$query_pkk_info,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_pkk_info = oci_fetch_array($query_pkk_info, OCI_ASSOC))
		{
			//build "info" data
			$info = array(
											'ukk' => $row_pkk_info[NO_UKK],
											'atd' => $row_pkk_info[TGL_JAM_BERANGKAT],
											'atb' => $row_pkk_info[TGL_JAM_TIBA],
											'ata' => $row_pkk_info[TGL_JAM_TIBA],
											'voyage_in' => $row_pkk_info[VOYAGE_IN],
											'voyage_out' => $row_pkk_info[VOYAGE_OUT],
											'agent' => $row_pkk_info[NM_AGEN],
											'first_port' => $row_pkk_info[PELABUHAN_ASAL],
											'previous_port' => $row_pkk_info[PELABUHAN_SEBELUM],
											'next_port' => $row_pkk_info[PELABUHAN_BERIKUT],
											'last_port' => $row_pkk_info[PELABUHAN_TUJUAN],
											'berth_location' => $def,
											'rkop_status' => $def,
											'no_dpjk' => $def,
											'payment_type' => $row_pkk_info[CMS], 
											'payment_status' => $def,
											'pkk_status' => $row_pkk_info[KD_PKK_STATUS],
											'kegiatan' => $row_pkk_info[KD_KEGIATAN],
											'kd_proses' => $row_pkk_info[KD_PROSES],
											'proses' => $row_pkk_info[PROSES],
											'status' => $row_pkk_info[STATUS],
											'cabang' => $row_pkk_info[KD_CABANG],
											'bentuk_3a' => $row_pkk_info[BENTUK_3A]
									);

			//build "vessel" data
			$vessel = array(
											'vessel_name' => $row_pkk_info[NM_KAPAL],
											'flag' => $row_pkk_info[KD_BENDERA],
											'loa' => $row_pkk_info[KP_LOA],
											'dwt' => $row_pkk_info[KP_DWT],
											'grt' => $row_pkk_info[KP_GRT],
											'front_draft' => $row_pkk_info[DR_DEPAN],
											'back_draft' => $row_pkk_info[DR_BELAKANG],
											'kemasan' => $row_pkk_info[DET_KD_KEMASAN],
											'voy_type' => $row_pkk_info[NM_LN_TRAMPER],
											'kunjungan' => $row_pkk_info[KUNJUNGAN]
									);
		}

		if($info['bentuk_3a']!="") {
			//get nota info
			//PL/SQL
			if($info['CMS']=='AUTO COLLECTION') {
				$connection =$conn['ori']['kapal'];
				$getNotaInfo = "SELECT count(1) lunas FROM ac_deduct_nota WHERE no_nota='".$info['bentuk_3a']."'";
			}
			else {
				$connection =$conn['ori']['simkeu'];
				$getNotaInfo = "SELECT count(1) lunas FROM apps.ar_payment_schedules_all apsa WHERE apsa.trx_number='".$info['bentuk_3a']."' and apsa.amount_due_remaining=0";
			}
			//QUERY
			if(!checkOriSQL($connection,$getNotaInfo,$query_nota,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_nota = oci_fetch_array($query_nota, OCI_ASSOC))
			{
				//build "nota" data
				$nota = array(
								'lunas' => $row_nota[LUNAS]
							);
			}
		}
		
		//get billing info
		//PL/SQL
		$getBillingInfo = "SELECT A.BENTUK_3A NO_NOTA, B.SIGN_CURRENCY, (REPLACE(B.PPN_DIKENAKAN_10,'.','')) PPN, B.JUMLAH_TAGIHAN, D.EMAIL_PERUSAHAAN, D.ALAMAT_PERUSAHAAN, (B.UANG_JAMINAN) UANG_JAMINAN, (REPLACE(B.SISA_UPER,'.','')) SISA_UPER, (REPLACE(B.PIUTANG,'.','')) PIUTANG, NVL((SELECT SUM(NOMINAL_UPER) FROM AC_PPKB_LOG WHERE NO_PKK=B.NO_UKK),0) JUMLAH_HOLD_AC, NVL((SELECT SUM(TAGIHAN_NOTA) FROM AC_DEDUCT_NOTA WHERE NO_PKK=B.NO_UKK),0) DEDUCT_AC
            FROM DPJK A, TT_DPJK_TOTAL B, MST_AGEN C, MST_PELANGGAN D
            WHERE A.NO_UKK=B.NO_UKK
                AND C.KD_AGEN=F_GET_KD_AGEN_BY_UKK(B.NO_UKK)
                AND C.NO_ACCOUNT=D.KD_PELANGGAN
                AND B.NO_UKK='$pkk'";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getBillingInfo,$query_billing,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_billing = oci_fetch_array($query_billing, OCI_ASSOC))
		{
			//build "nota" data
			$billing = array(
							'no_nota' => $row_billing[NO_NOTA],
							'kd_currency' => $row_billing[SIGN_CURRENCY],
							'ppn' => (int)$row_billing[PPN],
							'jumlah_tagihan' => (int)$row_billing[JUMLAH_TAGIHAN],
							'jumlah_tagihan2' => number_format((int)$row_billing[JUMLAH_TAGIHAN]),
							'email_perusahaan' => $row_billing[EMAIL_PERUSAHAAN],
							'alamat_perusahaan' => $row_billing[ALAMAT_PERUSAHAAN],
							'uang_jaminan' => (int)$row_billing[UANG_JAMINAN],
							'uang_jaminan2' => number_format((int)$row_billing[UANG_JAMINAN]),
							'sisa_uper' => (int)$row_billing[SISA_UPER],
							'sisa_uper2' => number_format((int)$row_billing[SISA_UPER]),
							'piutang' => (int)$row_billing[PIUTANG],
							'piutang2' => number_format((int)$row_billing[PIUTANG]),
							'jumlah_hold_ac' => (int)$row_billing[JUMLAH_HOLD_AC],
							'jumlah_hold_ac2' => number_format((int)$row_billing[JUMLAH_HOLD_AC]),
							'deduct_ac' => (int)$row_billing[DEDUCT_AC],
							'deduct_ac2' => number_format((int)$row_billing[DEDUCT_AC])
						);
		}
		
		//get RPK info
		$rpk = array();
		//PL/SQL
		$getRPKInfo = "SELECT A.KD_RPK, TO_CHAR(A.TGL_MULAI_TAMBAT,'DD-MM-YYYY HH24:MI') TGL_MULAI_TAMBAT, TO_CHAR(A.TGL_SELESAI_TAMBAT,'DD-MM-YYYY HH24:MI') TGL_SELESAI_TAMBAT, B.NM_KADE, A.METER_AWAL, A.METER_AKHIR, C.STATUS
            FROM RPK A, MST_KADE B, STATUS_RPK C
            WHERE A.KD_KADE=B.KD_KADE AND A.KD_RPK_STATUS=C.KD_RPK_STATUS AND A.NO_UKK='$pkk'";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getRPKInfo,$query_rpk,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_rpk = oci_fetch_array($query_rpk, OCI_ASSOC))
		{
			//build "RPK" data
			$rpk_sub = array(
							'no_rpk' => $row_rpk[KD_RPK],
							'tgl_mulai_tambat' => $row_rpk[TGL_MULAI_TAMBAT],
							'tgl_selesai_tambat' => $row_rpk[TGL_SELESAI_TAMBAT],
							'nm_kade' => $row_rpk[NM_KADE],
							'm_awal' => $row_rpk[METER_AWAL],
							'm_akhir' => $row_rpk[METER_AKHIR],
							'status' => $row_rpk[STATUS]
						);
			array_push($rpk, $rpk_sub);
		}

		//get ppkb info
		$ppkb = array();
		//PL/SQL
		/*
		| updater : tofan
		| update  : v_list_pkk_ibis
		*/
		$getPkkbInfo = "select ppkb_detail.kd_ppkb, ppkb_detail.ppkb_ke, mst_service_code.service_code, ppkb_detail.labuh, ppkb_detail.pandu, ppkb_detail.tambat, ppkb_detail.tunda, ppkb_detail.kepil, status_ppkb.status, to_char(ppkb_detail.tgl_jam_entry,'dd-mm-yyyy hh24:mi') tgl_jam_entry, to_char(ppkb_detail.tanggal_ditetapkan,'dd-mm-yyyy hh24:mi') tanggal_ditetapkan
		from v_list_pkk_ibis, ppkb, ppkb_detail, status_ppkb, mst_service_code
		where v_list_pkk_ibis.no_ukk=ppkb.no_ukk AND ppkb.kd_ppkb=ppkb_detail.kd_ppkb AND ppkb_detail.kd_ppkb_status=status_ppkb.kd_ppkb_status and ppkb_detail.kd_service_code=mst_service_code.kd_service_code and ppkb.no_ukk='$pkk' /*and kd_agen = '$agent_id'*/
		order by ppkb_detail.ppkb_ke asc";
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getPkkbInfo,$query_pkkb_info,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_pkkb_info = oci_fetch_array($query_pkkb_info, OCI_ASSOC))
		{
			unset($pelayanan);
			$pelayanan = ($row_pkkb_info['LABUH'] == 1)?'LABUH<br/>':'';
			$pelayanan .= ($row_pkkb_info['PANDU'] == 1)?'PANDU<br/>':'';
			$pelayanan .= ($row_pkkb_info['TUNDA'] == 1)?'TUNDA<br/>':'';
			$pelayanan .= ($row_pkkb_info['KEPIL'] == 1)?'KEPIL<br/>':'';
			$pelayanan .= ($row_pkkb_info['TAMBAT'] == 1)?'TAMBAT ':'';
			
			// get ppkb list
			$ppkb_sub = array(
										'no_ppkb' => $row_pkkb_info[KD_PPKB]."-".$row_pkkb_info[PPKB_KE],
										'status_ppkb' => $row_pkkb_info[STATUS],
										'tgl_entry' => $row_pkkb_info[TGL_JAM_ENTRY],
										'tgl_penetapan' => $row_pkkb_info[TANGGAL_DITETAPKAN],
										'service_code' => $row_pkkb_info[SERVICE_CODE],
										'pelayanan' => $pelayanan,
										'payment_status' => $def,
										'hold_amount' => $def,
										'deduct_amount' => $def,
										'service' => null
								);

			// get service list
			/*$service = array();
			if($row_pkkb_info[LABUH]=='1')
			{
				$getServiceInfo = "select * from ppkb_labuh where kd_ppkb='$row_pkkb_info[KD_PPKB]' and ppkb_ke='$row_pkkb_info[PPKB_KE]'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$getServiceInfo,$query_service_info,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_service_info = oci_fetch_array($query_service_info, OCI_ASSOC))
				{
					$service_sub = array(
											'service_name' => 'LABUH',
											'service_status' => $def,
											'service_time_start' => $row_service_info[TGL_JAM_PMT_MLABUH],
											'service_time_end' => $row_service_info[TGL_JAM_PMT_SLABUH]
										);
					array_push($service, $service_sub);
				}
			}
			if($row_pkkb_info[PANDU]=='1')
			{
				$getServiceInfo = "select * from ppkb_pandu where kd_ppkb='$row_pkkb_info[KD_PPKB]' and ppkb_ke='$row_pkkb_info[PPKB_KE]'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$getServiceInfo,$query_service_info,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_service_info = oci_fetch_array($query_service_info, OCI_ASSOC))
				{
					$service_sub = array(
											'service_name' => 'PANDU',
											'service_status' => $def,
											'service_time_start' => $row_service_info[TGL_JAM_PMT_PANDU],
											'service_time_end' => $row_service_info[TGL_JAM_PMT_PANDU]
										);
					array_push($service, $service_sub);
				}
			}
			if($row_pkkb_info[TAMBAT]=='1')
			{
				$getServiceInfo = "select * from ppkb_tambat where kd_ppkb='$row_pkkb_info[KD_PPKB]' and ppkb_ke='$row_pkkb_info[PPKB_KE]'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$getServiceInfo,$query_service_info,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_service_info = oci_fetch_array($query_service_info, OCI_ASSOC))
				{
					$service_sub = array(
											'service_name' => 'TAMBAT',
											'service_status' => $def,
											'service_time_start' => $row_service_info[TGL_JAM_PMT_MTAMBAT],
											'service_time_end' => $row_service_info[TGL_JAM_PMT_STAMBAT]
										);
					array_push($service, $service_sub);
				}
			}
			if($row_pkkb_info[TUNDA]=='1')
			{
				$getServiceInfo = "select * from ppkb_tunda where kd_ppkb='$row_pkkb_info[KD_PPKB]' and ppkb_ke='$row_pkkb_info[PPKB_KE]'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$getServiceInfo,$query_service_info,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_service_info = oci_fetch_array($query_service_info, OCI_ASSOC))
				{
					$service_sub = array(
											'service_name' => 'TUNDA',
											'service_status' => $def,
											'service_time_start' => $row_service_info[TGL_JAM_PMT_TUNDA],
											'service_time_end' => $row_service_info[TGL_JAM_PMT_TUNDA]
										);
					array_push($service, $service_sub);
				}
			}
			
			// if($row_pkkb_info[AIR]=='1')
			// {
				// $getServiceInfo = "select * from ppkb_air where kd_ppkb='$row_pkkb_info[KD_PPKB]' and ppkb_ke='$row_pkkb_info[PPKB_KE]'";
				// //QUERY
				// if(!checkOriSQL($conn['ori']['kapal'],$getServiceInfo,$query_service_info,$err,$debug)) goto Err;
				// //FETCH QUERY
				// while ($row_service_info = oci_fetch_array($query_service_info, OCI_ASSOC))
				// {
					// $service_sub = array(
											// 'service_name' => 'AIR',
											// 'service_status' => $def,
											// 'service_time_start' => $row_service_info[TGL_JAM_PMT_AIR],
											// 'service_time_end' => $row_service_info[TGL_JAM_PMT_AIR]
										// );
					// array_push($service, $service_sub);
				// }
			// }
			
			if($row_pkkb_info[KEPIL]=='1')
			{
				$getServiceInfo = "select * from ppkb_kepil where kd_ppkb='$row_pkkb_info[KD_PPKB]' and ppkb_ke='$row_pkkb_info[PPKB_KE]'";
				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$getServiceInfo,$query_service_info,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_service_info = oci_fetch_array($query_service_info, OCI_ASSOC))
				{
					$service_sub = array(
											'service_name' => 'KEPIL',
											'service_status' => $def,
											'service_time_start' => $row_service_info[TGL_JAM_PMT_KEPIL],
											'service_time_end' => $row_service_info[TGL_JAM_PMT_KEPIL]
										);
					array_push($service, $service_sub);
				}
			}
			
			$ppkb_sub['service'] = $service;*/
			array_push($ppkb, $ppkb_sub);
		}

		$out_data = array();
		$out_data['info']=$info;
		$out_data['vessel']=$vessel;
		$out_data['ppkb']=$ppkb;
		$out_data['nota']=$nota;
		$out_data['billing']=$billing;
		$out_data['rpk']=$rpk;
		
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