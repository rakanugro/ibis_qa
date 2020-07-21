<?php

/*|
 | Function Name 	: getDataPGK
 | Description 		: Get Data PGK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDataPGK($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_ukk = $xml_data->data->no_pgk;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		$getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$sql = "SELECT A.NO_UKK, f_kd_kapal_by_ukk(A.NO_UKK) KD_KAPAL, f_nm_kapal_by_ukk(A.NO_UKK) NM_KAPAL, B.KD_BENDERA, f_nm_bendera_by_ukk(A.NO_UKK) BENDERA, B.KP_GRT, B.KP_LOA, B.JN_KAPAL, A.KD_KEMASAN, A.KD_PELAYARAN, C.PELAYARAN, A.KD_KUNJUNGAN, A.DRAFT_DEPAN, A.DRAFT_BELAKANG, TO_CHAR(A.TGL_JAM_TIBA,'DD-MM-YYYY') TGL_TIBA, TO_CHAR(A.TGL_JAM_TIBA,'HH24:MI') JAM_TIBA, TO_CHAR(A.TGL_JAM_BERANGKAT,'DD-MM-YYYY') TGL_BERANGKAT, TO_CHAR(A.TGL_JAM_BERANGKAT,'HH24:MI') JAM_BERANGKAT, A.VOYAGE_IN, A.VOYAGE_OUT, A.PELABUHAN_ASAL ID_PEL_ASAL, F_GET_NM_PELABUHAN(A.PELABUHAN_ASAL) PEL_ASAL, (SELECT KD_BENDERA FROM MST_PELABUHAN WHERE KD_PELABUHAN=A.PELABUHAN_ASAL) FLAG_ASAL, A.PELABUHAN_TUJUAN ID_PEL_TUJUAN, F_GET_NM_PELABUHAN(A.PELABUHAN_TUJUAN) PEL_TUJUAN, (SELECT KD_BENDERA FROM MST_PELABUHAN WHERE KD_PELABUHAN=A.PELABUHAN_TUJUAN) FLAG_TUJUAN, A.PELABUHAN_SEBELUM ID_PEL_SEBELUM, F_GET_NM_PELABUHAN(A.PELABUHAN_SEBELUM) PEL_SEBELUM, (SELECT KD_BENDERA FROM MST_PELABUHAN WHERE KD_PELABUHAN=A.PELABUHAN_SEBELUM) FLAG_SEBELUM, A.PELABUHAN_BERIKUT ID_PEL_BERIKUT, F_GET_NM_PELABUHAN(A.PELABUHAN_BERIKUT) PEL_BERIKUT, (SELECT KD_BENDERA FROM MST_PELABUHAN WHERE KD_PELABUHAN=A.PELABUHAN_BERIKUT) FLAG_BERIKUT, KD_KADE, GERAKAN, TON, KETERANGAN
					FROM PKK A
						LEFT JOIN MST_KAPAL B ON B.KD_KAPAL=f_kd_kapal_by_ukk(A.NO_UKK)
						LEFT JOIN MST_PELAYARAN C ON C.KD_JN_PELAYARAN=A.KD_PELAYARAN
					WHERE NO_UKK = '".$no_ukk."'";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		if ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			//build "info" data
			$data_sub = array(
								'NO_UKK' => $row[NO_UKK],
								'KD_KAPAL' => $row[KD_KAPAL],
								'NM_KAPAL' => $row[NM_KAPAL],
								'KD_BENDERA' => $row[KD_BENDERA],
								'BENDERA' => $row[BENDERA],
								'KP_GRT' => $row[KP_GRT],
								'KP_LOA' => $row[KP_LOA],
								'JN_KAPAL' => $row[JN_KAPAL],
								'KD_KEMASAN' => $row[KD_KEMASAN],
								'KD_PELAYARAN' => $row[KD_PELAYARAN],
								'PELAYARAN' => $row[PELAYARAN],
								'KD_KUNJUNGAN' => $row[KD_KUNJUNGAN],
								'DRAFT_DEPAN' => $row[DRAFT_DEPAN],
								'DRAFT_BELAKANG' => $row[DRAFT_BELAKANG],
								'TGL_TIBA' => $row[TGL_TIBA],
								'JAM_TIBA' => $row[JAM_TIBA],
								'TGL_BERANGKAT' => $row[TGL_BERANGKAT],
								'JAM_BERANGKAT' => $row[JAM_BERANGKAT],
								'VOYAGE_IN' => $row[VOYAGE_IN],
								'VOYAGE_OUT' => $row[VOYAGE_OUT],
								'ID_PEL_ASAL' => $row[ID_PEL_ASAL],
								'PEL_ASAL' => $row[PEL_ASAL],
								'FLAG_ASAL' => $row[FLAG_ASAL],
								'ID_PEL_TUJUAN' => $row[ID_PEL_TUJUAN],
								'PEL_TUJUAN' => $row[PEL_TUJUAN],
								'FLAG_TUJUAN' => $row[FLAG_TUJUAN],
								'ID_PEL_SEBELUM' => $row[ID_PEL_SEBELUM],
								'PEL_SEBELUM' => $row[PEL_SEBELUM],
								'FLAG_SEBELUM' => $row[FLAG_SEBELUM],
								'ID_PEL_BERIKUT' => $row[ID_PEL_BERIKUT],
								'PEL_BERIKUT' => $row[PEL_BERIKUT],
								'FLAG_BERIKUT' => $row[FLAG_BERIKUT],
								'KD_KADE' => $row[KD_KADE],
								'GERAKAN' => $row[GERAKAN],
								'TON' => $row[TON],
								'HP_TB' => $row[KETERANGAN]
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