<?php

/*|
 | Function Name 	: getPGKAuto
 | Description 		: Get PGK Autocomplete
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPGKAuto($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$filter = $xml_data->data->filter;
		$agent_id = $xml_data->data->agent_id;
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
		$sql = "SELECT PKK.NO_UKK, MST_KAPAL.KD_KAPAL, MST_KAPAL.NM_KAPAL, MST_KAPAL.KP_GRT, MST_KAPAL.KP_LOA, MST_KAPAL.JN_KAPAL, MST_BENDERA.NM_NEGARA, MST_KEMASAN.DET_KD_KEMASAN, F_JN_PELAYARAN_BY_UKK(PKK.NO_UKK) PELAYARAN, MST_KUNJUNGAN.KUNJUNGAN, PKK.DRAFT_DEPAN, PKK.DRAFT_BELAKANG, TO_CHAR(TGL_JAM_TIBA,'DD-MM-YYYY HH24:MI') TGL_JAM_TIBA, TO_CHAR(TGL_JAM_BERANGKAT,'DD-MM-YYYY HH24:MI') TGL_JAM_BERANGKAT, VOYAGE_IN, VOYAGE_OUT, F_GET_NM_PELABUHAN(PELABUHAN_ASAL) PEL_ASAL, F_GET_NM_PELABUHAN(PELABUHAN_TUJUAN) PEL_TUJUAN, F_GET_NM_PELABUHAN(PELABUHAN_SEBELUM) PEL_SEBELUM, F_GET_NM_PELABUHAN(PELABUHAN_BERIKUT) PEL_BERIKUT, CASE WHEN PKK.KD_KADE IS NOT NULL THEN 'PAKET' ELSE 'REGULAR' END JNS_TARIF
				FROM PKK
				JOIN MST_KAPAL_AGEN ON MST_KAPAL_AGEN.KD_KAPAL_AGEN = PKK.KD_KAPAL_AGEN
				JOIN MST_AGEN ON MST_KAPAL_AGEN.KD_AGEN = MST_AGEN.KD_AGEN AND MST_KAPAL_AGEN.KD_CABANG = MST_AGEN.KD_CABANG
				JOIN MST_KAPAL ON MST_KAPAL.KD_KAPAL = MST_KAPAL_AGEN.KD_KAPAL
				LEFT OUTER JOIN PPKB on PPKB.NO_UKK = PKK.NO_UKK
				LEFT OUTER JOIN MST_BENDERA ON MST_KAPAL.KD_BENDERA = MST_BENDERA.KD_BENDERA
				LEFT OUTER JOIN MST_KEMASAN ON MST_KEMASAN.KD_KEMASAN = PKK.KD_KEMASAN
				LEFT OUTER JOIN MST_KUNJUNGAN ON MST_KUNJUNGAN.KD_KUNJUNGAN = PKK.KD_KUNJUNGAN
				WHERE KD_PKK_STATUS = 2 and PPKB.KD_PPKB is NULL AND MST_KAPAL_AGEN.KD_AGEN='".$agent_id."' AND MST_AGEN.KD_CABANG = '".$branch_id."' AND (PKK.NO_UKK LIKE UPPER('%".$filter."%') OR MST_KAPAL.NM_KAPAL LIKE UPPER('%".$filter."%'))";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		while ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			
			//build "info" data
			$data_sub = array(
									'NO_UKK' => $row[NO_UKK],
									'NM_KAPAL' => $row[NM_KAPAL],
									'KD_KAPAL' => $row[KD_KAPAL],
									'NM_NEGARA' => $row[NM_NEGARA],
									'KP_GRT' => $row[KP_GRT],
									'KP_LOA' => $row[KP_LOA],
									'JN_KAPAL' => $row[JN_KAPAL],
									'DET_KD_KEMASAN' => $row[DET_KD_KEMASAN],
									'PELAYARAN' => $row[PELAYARAN],
									'KUNJUNGAN' => $row[KUNJUNGAN],
									'DRAFT_DEPAN' => $row[DRAFT_DEPAN],
									'DRAFT_BELAKANG' => $row[DRAFT_BELAKANG],
									'TGL_JAM_TIBA' => $row[TGL_JAM_TIBA],
									'TGL_JAM_BERANGKAT' => $row[TGL_JAM_BERANGKAT],
									'VOYAGE_IN' => $row[VOYAGE_IN],
									'VOYAGE_OUT' => $row[VOYAGE_OUT],
									'PEL_ASAL' => $row[PEL_ASAL],
									'PEL_TUJUAN' => $row[PEL_TUJUAN],
									'PEL_SEBELUM' => $row[PEL_SEBELUM],
									'PEL_BERIKUT' => $row[PEL_BERIKUT],
									'JNS_TARIF' => $row[JNS_TARIF]
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