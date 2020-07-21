<?php

/*|
 | Function Name 	: autoContainerBatalmuat
 | Description 		: Search container 
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function autoContainerBatalmuat($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$no_container = $xml_data->data->detail->no_container;
		
		$port_code		= $xml_data->data->detail->port_code;
		$terminal_code	= $xml_data->data->detail->terminal_code;
		$tipebm			= $xml_data->data->detail->tipebm;
		$ves			= $xml_data->data->detail->vessel;
		$vin			= $xml_data->data->detail->voyin;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		$conn['container'][0] = $conn['ori']['container'];
		$conn['ibis'][0] = $conn['ori']['ibis'];
		
		if (($terminal_code == 'T3I') OR ($terminal_code == 'T009D')){
		
			if ($tipebm == 'CALBG'){
				// BM before gatein
				$sql_vc ="SELECT A.NO_CONTAINER, 
                    (A.SIZE_CONT||'-'||A.TYPE_CONT||'-'||A.STATUS) AS JENIS, 
                     A.HEIGHT, 
                     A.HZ,
                     C.KODE_BARANG AS KD_BARANG, 
                     B.ID_VSB_VOYAGE AS NO_UKK, 
                     B.VESSEL,
                     B.VOYAGE_IN,
                     A.SIZE_CONT, 
                     A.TYPE_CONT, 
                     A.STATUS
              FROM M_CYC_CONTAINER@dbint_link A
              INNER JOIN M_VSB_VOYAGE@dbint_link B ON (A.VESSEL = B.VESSEL AND A.VOYAGE_OUT = B.VOYAGE_OUT)
                  left join master_barang C on C.UKURAN = A.SIZE_CONT AND C.TYPE = A.TYPE_CONT AND C.STATUS = CASE WHEN A.STATUS='FULL' THEN 'FCL' ELSE 'MTY' END 
                  AND CASE WHEN A.HEIGHT<>'OOG' THEN 'BIASA' ELSE 'OOG' END = C.HEIGHT_CONT
                  WHERE UPPER(TRIM(NO_CONTAINER)) LIKE '%$no_container%'
                  AND A.E_I='E'
                  and (A.CONT_LOCATION='Out' or A.CONT_LOCATION='Chassis' or A.CONT_LOCATION='Yard')
                  AND b.ID_VSB_VOYAGE = (SELECT MAX(c.ID_VSB_VOYAGE) FROM (SELECT 
                     B.ID_VSB_VOYAGE
              FROM M_CYC_CONTAINER@dbint_link A
              INNER JOIN M_VSB_VOYAGE@dbint_link B ON (A.VESSEL = B.VESSEL AND A.VOYAGE_OUT = B.VOYAGE_OUT)
                  left join master_barang C on C.UKURAN = A.SIZE_CONT AND C.TYPE = A.TYPE_CONT AND C.STATUS = CASE WHEN A.STATUS='FULL' THEN 'FCL' ELSE 'MTY' END 
                  AND CASE WHEN A.HEIGHT<>'OOG' THEN 'BIASA' ELSE 'OOG' END = C.HEIGHT_CONT
                  WHERE UPPER(TRIM(NO_CONTAINER)) LIKE '%$no_container%'
                  AND A.E_I='E' AND (A.HOLD_STATUS <> 'Y' or A.HOLD_STATUS IS NULL)
                  and (A.CONT_LOCATION='Out' or A.CONT_LOCATION='Chassis' or A.CONT_LOCATION='Yard')) c)
                  ORDER BY NO_CONTAINER";
				  
				  
				 
				  
		} else if ($tipebm == 'CALAG') {
				// BM after gatein
				$sql_vc = "SELECT A.NO_CONTAINER, 
								(A.SIZE_CONT||'-'||A.TYPE_CONT||'-'||A.STATUS) AS JENIS, 
								 A.HEIGHT, 
								 A.HZ,
								 C.KODE_BARANG AS KD_BARANG, 
								 B.ID_VSB_VOYAGE AS NO_UKK, 
								 A.SIZE_CONT, 
								 A.TYPE_CONT, 
								 A.STATUS
						  FROM M_CYC_CONTAINER@dbint_link A
						  INNER JOIN M_VSB_VOYAGE@dbint_link B ON (A.VESSEL = B.VESSEL AND A.VOYAGE_OUT = B.VOYAGE_OUT AND A.VOYAGE_IN=B.VOYAGE_IN)
							  left join master_barang C on C.UKURAN = A.SIZE_CONT AND C.TYPE = A.TYPE_CONT AND C.STATUS = CASE WHEN A.STATUS='FULL' THEN 'FCL' ELSE 'MTY' END 
							  AND CASE WHEN A.HEIGHT<>'OOG' THEN 'BIASA' ELSE 'OOG' END = C.HEIGHT_CONT
							  WHERE UPPER(TRIM(NO_CONTAINER)) LIKE '%$no_container%'
							  AND A.E_I='E' AND ACTIVE='Y'
							  and UPPER(A.CONT_LOCATION) = 'YARD' AND (A.HOLD_STATUS <> 'Y' or A.HOLD_STATUS IS NULL)
							  ORDER BY NO_CONTAINER";
			
			} else {
			
				// BM delivery
				$sql_vc = "SELECT A.NO_CONTAINER, 
                (A.SIZE_CONT||'-'||A.TYPE_CONT||'-'||A.STATUS) AS JENIS, 
                 A.HEIGHT, 
                 A.HZ, 
                 B.KODE_BARANG AS KD_BARANG
          FROM M_CYC_CONTAINER@DBINT_LINK A, MASTER_BARANG B
          WHERE UPPER(TRIM(A.NO_CONTAINER)) LIKE '%$no_container%'
                AND TRIM(A.VESSEL)=TRIM('$ves')
                AND TRIM(A.VOYAGE_IN)=TRIM('$vin')
                AND UPPER(TRIM(A.CONT_LOCATION))='YARD'
                AND TRIM(A.ACTIVE)='Y'
                AND TRIM(A.E_I)='E'
                AND TRIM(A.SIZE_CONT) = TRIM(B.UKURAN)
                AND TRIM(A.TYPE_CONT) = TRIM(B.TYPE) AND (A.HOLD_STATUS <> 'Y' or A.HOLD_STATUS IS NULL)
                AND TRIM(CASE WHEN A.STATUS = 'FULL' THEN 'FCL' 
                 WHEN A.STATUS = 'EMPTY' THEN 'MTY'
                 ELSE 'NULL' END) = TRIM(B.STATUS)
                AND TRIM(CASE WHEN A.HEIGHT = '8.6' THEN 'BIASA' 
                 WHEN A.HEIGHT = '9.6' THEN 'BIASA'
                 ELSE 'OOG' END) = TRIM(B.HEIGHT_CONT)";
			} 
			
		} else {
		
			if ($tipebm == 'CALBG'){
				// BM before gatein
				$sql_vc ="SELECT A.NO_CONTAINER,
								 (A.SIZE_CONT || '-' || A.TYPE_CONT || '-' || A.STATUS) AS JENIS,
								 A.HEIGHT,
								 A.HZ,
								 C.KODE_BARANG AS KD_BARANG,
								 B.ID_VSB_VOYAGE AS NO_UKK,
								 B.VESSEL,
								 B.VOYAGE_IN,
								 A.SIZE_CONT,
								 A.TYPE_CONT,
								 A.STATUS,
								 a.CONT_LOCATION
							FROM itos_repo.M_CYC_CONTAINER A
								 INNER JOIN itos_repo.M_VSB_VOYAGE B
									ON (A.VESSEL = B.VESSEL AND A.VOYAGE_IN = B.VOYAGE_IN AND  A.VOYAGE_OUT = B.VOYAGE_OUT)
								 LEFT JOIN master_barang C
									ON C.UKURAN = A.SIZE_CONT AND C.TYPE = A.TYPE_CONT
									   AND C.STATUS =
											  CASE WHEN A.STATUS = 'FULL' THEN 'FCL' ELSE 'MTY' END
									   AND CASE WHEN A.HEIGHT <> 'OOG' THEN 'BIASA' ELSE 'OOG' END =
											  C.HEIGHT_CONT
						   WHERE UPPER (TRIM (NO_CONTAINER)) LIKE '%$no_container%' AND A.E_I = 'E'
									AND (   A.CONT_LOCATION = 'Gate'
									  OR A.CONT_LOCATION = 'Out')
								--	AND A.BILLING_PAID IS NOT NULL
								 AND b.ID_VSB_VOYAGE =
										(   SELECT MAX (c.ID_VSB_VOYAGE)
										   FROM (SELECT B.ID_VSB_VOYAGE
												   FROM itos_repo.M_CYC_CONTAINER A
														INNER JOIN itos_repo.M_VSB_VOYAGE B
														   ON (A.VESSEL = B.VESSEL
															   AND A.VOYAGE_IN = B.VOYAGE_IN AND  A.VOYAGE_OUT =
																	  B.VOYAGE_OUT)
														LEFT JOIN master_barang C
																   ON C.UKURAN = A.SIZE_CONT    
															  AND C.TYPE = A.TYPE_CONT
															  AND C.STATUS =
																	 CASE
																		WHEN A.STATUS =
																				'FULL'
																		THEN
																		   'FCL'
																		ELSE
																		   'MTY'
																	 END
															  AND CASE
																	 WHEN A.HEIGHT <>
																			 'OOG'
																	 THEN
																		'BIASA'
																	 ELSE
																		'OOG'
																  END = C.HEIGHT_CONT
												  WHERE UPPER (TRIM (NO_CONTAINER)) LIKE
														   '%$no_container%'
														AND A.E_I = 'E'
														AND (A.CONT_LOCATION = 'Out'
														  OR A.CONT_LOCATION =
																   'Gate')) c)
						ORDER BY NO_CONTAINER";
					
			} else if ($tipebm == 'CALAG') {
				// BM after gatein
				$sql_vc = "SELECT A.NO_CONTAINER, 
								(A.SIZE_CONT||'-'||A.TYPE_CONT||'-'||A.STATUS) AS JENIS, 
								 A.HEIGHT, 
								 A.HZ,
								 C.KODE_BARANG AS KD_BARANG, 
								 B.ID_VSB_VOYAGE AS NO_UKK, 
								 A.SIZE_CONT, 
								 A.TYPE_CONT, 
								 A.STATUS
						  FROM itos_repo.M_CYC_CONTAINER A
						  INNER JOIN itos_repo.M_VSB_VOYAGE B ON (A.VESSEL = B.VESSEL AND A.VOYAGE_OUT = B.VOYAGE_OUT AND A.VOYAGE_IN=B.VOYAGE_IN)
							  left join master_barang C on C.UKURAN = A.SIZE_CONT AND C.TYPE = A.TYPE_CONT AND C.STATUS = CASE WHEN A.STATUS='FULL' THEN 'FCL' ELSE 'MTY' END 
							  AND CASE WHEN A.HEIGHT<>'OOG' THEN 'BIASA' ELSE 'OOG' END = C.HEIGHT_CONT
							  WHERE UPPER(TRIM(NO_CONTAINER)) LIKE '%$no_container%'
							  AND A.E_I='E' AND ACTIVE='Y'
							 -- AND A.BILLING_PAID IS NOT NULL
							  and UPPER(A.CONT_LOCATION) = 'YARD'
							  ORDER BY NO_CONTAINER";
			
			} else {
			
				// BM delivery  
				$sql_vc = "SELECT A.NO_CONTAINER, 
									(A.SIZE_CONT||'-'||A.TYPE_CONT||'-'||A.STATUS) AS JENIS, 
									 A.HEIGHT, 
									 A.HZ, 
									 B.KODE_BARANG AS KD_BARANG
							  FROM itos_repo.M_CYC_CONTAINER A, MASTER_BARANG B
							  WHERE UPPER(TRIM(A.NO_CONTAINER)) LIKE '%$no_container%'
									AND TRIM(A.VESSEL)=TRIM('$ves')
									AND TRIM(A.VOYAGE_IN)=TRIM('$vin')
									AND UPPER(TRIM(A.CONT_LOCATION))='YARD'
									AND TRIM(A.ACTIVE)='Y'
									AND TRIM(A.E_I)='E'
									--AND A.BILLING_PAID IS NOT NULL
									AND TRIM(A.SIZE_CONT) = TRIM(B.UKURAN)
									AND TRIM(A.TYPE_CONT) = TRIM(B.TYPE)
									AND TRIM(CASE WHEN A.STATUS = 'FULL' THEN 'FCL' 
									 WHEN A.STATUS = 'EMPTY' THEN 'MTY'
									 ELSE 'NULL' END) = TRIM(B.STATUS)
									AND TRIM(CASE WHEN A.HEIGHT = '8.6' THEN 'BIASA' 
									 WHEN A.HEIGHT = '9.6' THEN 'BIASA'
									 ELSE 'OOG' END) = TRIM(B.HEIGHT_CONT)";
			} 
		}
		
		//return $sql_vc;
		//return $terminal_code;
		$cont_arr = array();
		if(!checkOriSQL($conn['ori']['billing'],$sql_vc,$sql_vc_,$err)) goto Err;
		while($row_vc = oci_fetch_array($sql_vc_, OCI_ASSOC)){
			$cont_temp = array(
										'no_container' => $row_vc[NO_CONTAINER],
										'size_cont' => $row_vc[SIZE_CONT],
										'type_cont' => $row_vc[TYPE_CONT],
										'status' => $row_vc[STATUS], 
										'height' => $row_vc[HEIGHT],
										'hz' => $row_vc[HZ],
										'kd_barang' => $row_vc[KD_BARANG],
										'no_ukk' => $row_vc[NO_UKK]
							);

			array_push($cont_arr, $cont_temp);
		}

		$out_data = array();
		$out_data['container']=$cont_arr;
		
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