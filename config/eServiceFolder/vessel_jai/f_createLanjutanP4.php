<?php

/*|
 | Function Name 	: createLanjutanP4
 | Description 		: Create Lanjutan P4
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function createLanjutanP4($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_pgk = $xml_data->data->no_pgk;
		$no_pppp = $xml_data->data->no_pppp;
		$pppp_ke = $xml_data->data->pppp_ke;
		$x_pppp_ke = $xml_data->data->x_pppp_ke;
		$draft_depan = $xml_data->data->draft_depan;
		$draft_belakang = $xml_data->data->draft_belakang;
		$service_code = $xml_data->data->service_code;
		$is_berangkat = $xml_data->data->is_berangkat;
		$id_dari = $xml_data->data->id_dari;
		$id_ke = $xml_data->data->id_ke;
		$checkbox_pandu = $xml_data->data->checkbox_pandu;
		$checkbox_pandulaut = $xml_data->data->checkbox_pandulaut;
		$checkbox_tunda = $xml_data->data->checkbox_tunda;
		$checkbox_tundalaut = $xml_data->data->checkbox_tundalaut;
		$checkbox_kepil = $xml_data->data->checkbox_kepil;
		$tgl_pmtpandu = $xml_data->data->tgl_pmtpandu;
		$tgl_pmtpandulaut = $xml_data->data->tgl_pmtpandulaut;
		$tgl_pmttunda = $xml_data->data->tgl_pmttunda;
		$tgl_pmttundalaut = $xml_data->data->tgl_pmttundalaut;
		$tgl_pmtkepil = $xml_data->data->tgl_pmtkepil;
		$jns_kapal = $xml_data->data->jns_kapal;
		$id_tugboat = $xml_data->data->id_tugboat;
		$id_tugboat2 = $xml_data->data->id_tugboat2;
		$id_tugboat3 = $xml_data->data->id_tugboat3;
		$id_tongkang = $xml_data->data->id_tongkang;
		$id_tongkang2 = $xml_data->data->id_tongkang2;
		$id_tongkang3 = $xml_data->data->id_tongkang3;
		$kd_cabang = $xml_data->data->kd_cabang;
		$kd_agen = $xml_data->data->kd_agen;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		// $getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$bind_param = array(
							':no_pgk' => "$no_pgk",
							':no_pppp' => "$no_pppp",
							':pppp_ke' => "$pppp_ke",
							':x_pppp_ke' => "$x_pppp_ke",
							':draft_depan' => "$draft_depan",
							':draft_belakang' => "$draft_belakang",
							':service_code' => "$service_code",
							':is_berangkat' => "$is_berangkat",
							':id_dari' => "$id_dari",
							':id_ke' => "$id_ke",
							':checkbox_pandu' => "$checkbox_pandu",
							':checkbox_pandulaut' => "$checkbox_pandulaut",
							':checkbox_tunda' => "$checkbox_tunda",
							':checkbox_tundalaut' => "$checkbox_tundalaut",
							':checkbox_kepil' => "$checkbox_kepil",
							':tgl_pmtpandu' => "$tgl_pmtpandu",
							':tgl_pmtpandulaut' => "$tgl_pmtpandulaut",
							':tgl_pmttunda' => "$tgl_pmttunda",
							':tgl_pmttundalaut' => "$tgl_pmttundalaut",
							':tgl_pmtkepil' => "$tgl_pmtkepil",
							':jns_kapal' => "$jns_kapal",
							':id_tugboat' => "$id_tugboat",
							':id_tugboat2' => "$id_tugboat2",
							':id_tugboat3' => "$id_tugboat3",
							':id_tongkang' => "$id_tongkang",
							':id_tongkang2' => "$id_tongkang2",
							':id_tongkang3' => "$id_tongkang3",
							':kd_cabang' => "$kd_cabang",
							':kd_agen' => "$kd_agen",
							':p_status' => "",
							':p_msg' => ""
						);
		
		$sql = "BEGIN PROC_CREATE_LANJUTAN_P4
				(
					:no_pgk,
					:no_pppp,
					:pppp_ke,
					:x_pppp_ke,
					:draft_depan,
					:draft_belakang,
					:service_code,
					:is_berangkat,
					:id_dari,
					:id_ke,
					:checkbox_pandu,
					:checkbox_pandulaut,
					:checkbox_tunda,
					:checkbox_tundalaut,
					:checkbox_kepil,
					:tgl_pmtpandu,
					:tgl_pmtpandulaut,
					:tgl_pmttunda,
					:tgl_pmttundalaut,
					:tgl_pmtkepil,
					:jns_kapal,
					:id_tugboat,
					:id_tugboat2,
					:id_tugboat3,
					:id_tongkang,
					:id_tongkang2,
					:id_tongkang3,
					:kd_cabang,
					:kd_agen,
					:p_status,
					:p_msg
				); END;";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err,$bind_param)) goto Err;
		
		$getdata = array(
						'status' => $bind_param[':p_status'],
						'msg' => $bind_param[':p_msg']
					);
		
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