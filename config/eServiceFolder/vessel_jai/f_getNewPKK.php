<?php

/*|
 | Function Name 	: getNewPKK
 | Description 		: Get New PKK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getNewPKK($in_param) {
	
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
		
		//get pkk info
		$pkk = array();
		//PL/SQL
		/*
		| updater : tofan
		| update  : v_list_pkk_ibis
		*/
		if($agent_id<>"")
			$filter_agen = "kd_agen = '$agent_id'";
		else
			$filter_agen = "kd_agen = 'XXX'";
		if($branch_id<>"")
			$filter_cabang = "kd_cabang = '$branch_id'";
		else
			$filter_cabang = "kd_cabang = 'XX'";
		$getPkkInfo = "select v_list_pkk_ibis.*,mst_kapal.* from v_list_pkk_ibis
                                    LEFT JOIN mst_kapal ON mst_kapal.kd_kapal=v_list_pkk_ibis.kd_kapal
									WHERE $filter_agen AND $filter_cabang
									ORDER BY tanggal_jam_entry desc";
	
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getPkkInfo,$query_pkk_info,$err)) goto Err;
		//FETCH QUERY
		while ($row_pkk_info = oci_fetch_array($query_pkk_info, OCI_ASSOC))
		{
			//build "info" data
			$pkk_sub = array(
								'no_pkk' => $row_pkk_info[NO_UKK],
								'kd_kapal' => $row_pkk_info[KD_KAPAL],
								'nm_kapal' => $row_pkk_info[NM_KAPAL],
								'atd' => $row_pkk_info[TGL_JAM_BERANGKAT],
								'atb' => $row_pkk_info[TGL_JAM_TIBA],
								'ata' => $row_pkk_info[TGL_JAM_TIBA],
								'tgl_in' => $row_pkk_info[TGL_JAM_TIBA],
								'tgl_out' => $row_pkk_info[TGL_JAM_BERANGKAT],
								'agent' => $row_pkk_info[NM_AGEN],
								'kd_ppkb' => $row_pkk_info[KD_PPKB],
								'bentuk_3a' => $row_pkk_info[BENTUK_3A],
								'first_port' => $def,
								'previous_port' => $def,
								'next_port' => $def,
								'last_port' => $def,
								'berth_location' => $def,
								'rkop_status' => $def,
								'no_dpjk' => $def,
								'payment_type' => $row_pkk_info[CMS], 
								'payment_status' => $def,
								'kd_proses' => $row_pkk_info[KD_PROSES],
								'tanggal_jam_entry' => $row_pkk_info[TANGGAL_JAM_ENTRY]
							);
									
			array_push($pkk,$pkk_sub);
		}

		$out_data = array();
		$out_data['pkk']=$pkk;
		
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