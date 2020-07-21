<?php

/*|
 | Function Name 	: updatePGK
 | Description 		: Update PGK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function updatePGK($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_pgk = $xml_data->data->no_pgk;
		$hp_tb = $xml_data->data->hp_tb;
		$kd_kemasan = $xml_data->data->kd_kemasan;
		$kd_pelayaran = $xml_data->data->kd_pelayaran;
		$kd_kunjungan = $xml_data->data->kd_kunjungan;
		$draft_depan = $xml_data->data->draft_depan;
		$draft_belakang = $xml_data->data->draft_belakang;
		$tgl_tiba = $xml_data->data->tgl_tiba;
		$jam_tiba = $xml_data->data->jam_tiba;
		$tgl_berangkat = $xml_data->data->tgl_berangkat;
		$jam_berangkat = $xml_data->data->jam_berangkat;
		$voy_in = $xml_data->data->voy_in;
		$voy_out = $xml_data->data->voy_out;
		$id_pel_asal = $xml_data->data->id_pel_asal;
		$id_pel_sebelum = $xml_data->data->id_pel_sebelum;
		$id_pel_berikut = $xml_data->data->id_pel_berikut;
		$id_pel_tujuan = $xml_data->data->id_pel_tujuan;
		$kade_pkk = $xml_data->data->kade_pkk;
		$gerakan_pkk = $xml_data->data->gerakan_pkk;
		$jml_muatan = $xml_data->data->jml_muatan;
		
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
							':hp_tb' => "$hp_tb",
							':kd_kemasan' => "$kd_kemasan",
							':kd_pelayaran' => "$kd_pelayaran",
							':kd_kunjungan' => "$kd_kunjungan",
							':draft_depan' => "$draft_depan",
							':draft_belakang' => "$draft_belakang",
							':tgl_jam_tiba' => "$tgl_tiba $jam_tiba",
							':tgl_jam_berangkat' => "$tgl_berangkat $jam_berangkat",
							':voy_in' => "$voy_in",
							':voy_out' => "$voy_out",
							':id_pel_asal' => "$id_pel_asal",
							':id_pel_sebelum' => "$id_pel_sebelum",
							':id_pel_berikut' => "$id_pel_berikut",
							':id_pel_tujuan' => "$id_pel_tujuan",
							':kade_pkk' => "$kade_pkk",
							':gerakan_pkk' => "$gerakan_pkk",
							':jml_muatan' => "$jml_muatan",
							':p_status' => "",
							':p_msg' => ""
						);
		
		$query = "BEGIN PROC_UPDATE_PGK
					(
						:no_pgk,
						:hp_tb,
						:kd_kemasan,
						:kd_pelayaran,
						:kd_kunjungan,
						:draft_depan,
						:draft_belakang,
						:tgl_jam_tiba,
						:tgl_jam_berangkat,
						:voy_in,
						:voy_out,
						:id_pel_asal,
						:id_pel_sebelum,
						:id_pel_berikut,
						:id_pel_tujuan,
						:kade_pkk,
						:gerakan_pkk,
						:jml_muatan,
						:p_status,
						:p_msg
					); END;";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$query,$query_,$err,$bind_param)) goto Err;
		
		$getdata = array(
						'status' => $bind_param[':p_status'],
						'msg' => $bind_param[':p_msg']
					);
		
		if($getdata["status"]!="S")
		{
			$err = $getdata["msg"];
			goto Err;
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