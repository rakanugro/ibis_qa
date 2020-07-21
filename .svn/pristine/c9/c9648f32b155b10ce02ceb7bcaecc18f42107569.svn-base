<?php

/*|
 | Function Name 	: getDetailContainer
 | Description 		: Get Detail Container
 | Creator			: Endang Fiansyah
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDetailContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$no_container = $xml_data->data->no_container;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$vessel = $xml_data->data->vessel;
		$voyage_in = $xml_data->data->voyage_in;
		$voyage_out = $xml_data->data->voyage_out;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();

		//select connection
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);			
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);			
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);			
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);			
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];
			$conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);			
			$conn['container'][0] = $conn['ori']['container_idjkt_t009d'];
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t009d'];
		}
		else if($port_code==""&&$terminal_code=="")
		{
			$conn['ori'] = oriDb();
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][5] = $conn['ori']['container_idjkt_t009d'];
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3i'];
			$conn['billing'][1] = $conn['ori']['billing_idjkt_t3d'];
			$conn['billing'][2] = $conn['ori']['billing_idjkt_t2d'];
			$conn['billing'][3] = $conn['ori']['billing_idjkt_t1d'];
			$conn['billing'][5] = $conn['ori']['billing_idjkt_t009d'];			
		}

		if($vessel != "")
		{
			$q_p .= " AND NM_KAPAL='$vessel' ";
		}
		if($voyage_in != "")
		{
			$q_p .= " AND VOYAGE_IN='$voyage_in' ";
		}
		if($voyage_out != "")
		{
			$q_p .= " AND VOYAGE_OUT='$voyage_out' ";
		}
		
		$getContainer = "SELECT NO_CONTAINER,
                           SIZE_,
                           TYPE_,
                           STATUS,
                           ISO_CODE,
                           HEIGHT,
                           CARRIER,
                           E_I,
                           ACTIVE,
                           BERAT,
                           NO_UKK,
                           HZ,
                           LOKASI_BP,
                           KODE_STATUS,
                           POD,
                           POL,
                           NM_KAPAL,
                           VOYAGE_IN,
                           VOYAGE_OUT,
                           ID_JOBSLIP,
                           IMO, 
                           POINT,
                           HOLD_STATUS,
                           HOLD_DATE ,
						   CONT_LOCATION,
						   REEFER_TEMP,
						   PAIDTHRU
                      FROM (  SELECT a.NO_CONTAINER,
									 SIZE_CONT AS SIZE_,
                                     TYPE_CONT AS TYPE_,
                                     STATUS,
                                     a.ISO_CODE,
                                     HEIGHT,
                                     a.CARRIER,
                                     a.E_I,
                                     ACTIVE,
                                     a.WEIGHT AS BERAT,
                                     c.ID_VSB_VOYAGE AS NO_UKK,
                                     a.HZ,
                                     BAYPLAN_POSITION AS LOKASI_BP,                                    
                                     ACTIVITY AS KODE_STATUS,
                                     a.POD,
                                     a.POL,
                                     a.VESSEL AS NM_KAPAL,
                                     a.VOYAGE_IN,
                                     a.VOYAGE_OUT,
                                     '' AS ID_JOBSLIP,
                                     IMO, 
                                     a.POINT as POINT,
                                     HOLD_STATUS,
                                     SUBSTR(a.HOLD_DATE,0,4)||'/'||SUBSTR(a.HOLD_DATE,5,2)||'/'||SUBSTR(a.HOLD_DATE,7,2) HOLD_DATE,
									 CONT_LOCATION,
									 REEFER_TEMP,
									 TO_CHAR(TO_DATE(BILLING_PAIDTHRU,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:MI:SS') PAIDTHRU
                                FROM M_CYC_CONTAINER a                                    
                                     LEFT JOIN M_VSB_VOYAGE c
                                        ON     a.VESSEL = c.VESSEL
                                           AND a.VOYAGE_IN = c.voyage_in
                                           AND a.VOYAGE_OUT = c.voyage_out)
                                WHERE NO_CONTAINER = '$no_container' $q_p";

		$no_ukk="";
		$e_i="";
		for($j=0;$j<count($conn['container']);$j++)
		{
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$getContainer,$query_container,$err)) goto Err;
			//FETCH QUERY
			while ($row_container = oci_fetch_array($query_container, OCI_ASSOC))
			{
				//build "info" data
				$info = array(
								'no_container' => $row_container[NO_CONTAINER],
								'vessel' => $row_container[NM_KAPAL],
								'voyage_in' => $row_container[VOYAGE_IN],
								'voyage_out' => $row_container[VOYAGE_OUT],
								'status' => $row_container[STATUS],
								'location' => $row_container[LOKASI_BP],
								'size' => $row_container[SIZE_],
								'type' => $row_container[TYPE_],
								'hazard' => $row_container[HZ],
								'imo_class' => $row_container[IMO],
								'un_number' => $row_container[TGL_JAM_TIBA],
								'iso_code' => $row_container[ISO_CODE],
								'height' => $row_container[HEIGHT],
								'pol' => $row_container[POL],
								'pod' => $row_container[POD],
								'weight' => $def,
								'e_i' => $row_container[E_I],
								'activity' => $row_container[KODE_STATUS],
								'hold_status' => $row_container[HOLD_STATUS],
								'cont_location' => $row_container[CONT_LOCATION],
								'weight' => $row_container[BERAT],
								'reefer_temp' => $row_container[REEFER_TEMP],
								'paidthru' => $row_container[PAIDTHRU]
							);
							$no_ukk=$row_container[NO_UKK];
							$e_i=$row_container[E_I];
							$hd_vessel = $row_container[NM_KAPAL];
							$hd_voyin = $row_container[VOYAGE_IN];
							$hd_voyout = $row_container[VOYAGE_OUT];
			}
		}
		
		$query_handling="SELECT DISTINCT ACTIVITY AS KEGIATAN,
						 E_I,
						 TO_CHAR (TO_DATE (ACTIVITY_DATE, 'yyyymmddhh24miss'),
								  'dd-mm-yyyy hh24:mi')
							AS DATE_STATUS,
						 USER_OPR AS NM_USER,
						 '' AS KODE_STATUS,
						 CASE WHEN ACTIVITY = 'PLACEMENT EXPORT' THEN '('||TO_LOCATION||')'
						 WHEN ACTIVITY = 'PLACEMENT IMPORT' THEN '('||TO_LOCATION||')'
						 ELSE '' END TO_LOCATION
					FROM M_CYC_CONT_HISTORY
				   WHERE     no_container = '$no_container'
						 AND VOYAGE_IN = '$hd_voyin'
						 AND VOYAGE_OUT = '$hd_voyout'
						 AND ACTIVITY IS NOT NULL
						 AND VESSEL = '$hd_vessel' 
				ORDER BY DATE_STATUS ASC";
		
		$handling=array();
		for($j=0;$j<count($conn['container']);$j++)
		{
			if(!checkOriSQL($conn['container'][$j],$query_handling,$getHandling,$err)) goto Err;
			//FETCH QUERY
			while ($row_handling = oci_fetch_array($getHandling, OCI_ASSOC))
			{
				$handling_tmp = array(
						'activity' => $row_handling[KEGIATAN],
						'time' => $row_handling[DATE_STATUS],
						'to_location' => $row_handling[TO_LOCATION]
				);
				array_push($handling, $handling_tmp);
			}
		}
		
		if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
		$sq="/* Formatted on 23-Apr-14 4:39:49 PM (QP5 v5.163.1008.3004) */
		  SELECT z.NO_CONTAINER,
				 z.ID_NOTA,
				 z.NO_FAKTUR,
				 z.ID_REQ,
				 z.EMKL,
				 z.STATUS,
				 z.ALAMAT,
				 z.VESSEL,
				 z.VOYAGE_IN,
				 z.VOYAGE_OUT,
				 to_char(z.TGL_SIMPAN,'dd-mm-yyyy hh24:mi') TGL_SIMPAN,
				 to_char(z.TGL_PAYMENT,'dd-mm-yyyy hh24:mi') TGL_PAYMENT,
				 z.PAYMENT_VIA,
				 z.TOTAL,
				 z.COA,
				 z.KD_MODUL,
				 z.KET,
				 to_char(y.TANGGAL_RECEIPT,'dd-mm-yyyy hh24:mi') TANGGAL_RECEIPT,
				 to_char(z.TGL_BERLAKU,'dd-mm-yyyy hh24:mi') TGL_BERLAKU 
			FROM (SELECT NO_CONTAINER,
						NOTA_receiving_h.ID_NOTA,
						NO_FAKTUR,
						req_receiving_h.ID_REQ,
						req_receiving_h.kode_pbm as EMKL,
						req_receiving_h.STATUS,
						nota_receiving_h.ALAMAT,
						nota_receiving_h.VESSEL,
						req_receiving_h.VOYAGE_IN AS VOYAGE_IN,
						nota_receiving_h.VOYAGE_OUT,
						req_receiving_h.TGL_REQUEST as TGL_SIMPAN,
						TGL_PAYMENT,
						PAYMENT_VIA,
						TOTAL,
						nota_receiving_h.COA,
						KD_MODUL,
						'ANNE' KET,
						'' AS TGL_BERLAKU,
						req_receiving_h.PEB,
						req_receiving_h.NPE,
						req_receiving_h.ID_USER AS USER_ID
				   FROM req_receiving_d
						LEFT JOIN nota_receiving_h
						   ON (TRIM (nota_receiving_h.ID_REQ) =
								  TRIM (req_receiving_d.ID_REQ))
						LEFT JOIN req_receiving_h
						   ON (TRIM (req_receiving_h.ID_REQ) =
								  TRIM (req_receiving_d.ID_REQ))
				  UNION                                                                                   
				  SELECT nota_batalmuat_d.ID_CONT NO_CONTAINER,
						 nota_batalmuat_h.ID_NOTA,
						 nota_batalmuat_h.NO_FAKTUR,
						 nota_batalmuat_h.ID_REQ,
						 nota_batalmuat_h.EMKL,
						 nota_batalmuat_h.STATUS,
						 nota_batalmuat_h.ALAMAT,
						  NOTA_BATALMUAT_H.VESSEL,
						 NOTA_BATALMUAT_H.VOYAGE_IN AS VOYAGE_IN,
						  ' ' AS VOYAGE_OUT,
						 nota_batalmuat_h.TGL_NOTA AS TGL_SIMPAN,
						 nota_batalmuat_h.TGL_PAYMENT,
						 nota_batalmuat_h.PAYMENT_VIA,
						 nota_batalmuat_h.TOTAL,
						 nota_batalmuat_h.COA,
						 nota_batalmuat_h.JENIS AS KD_MODUL,
						 'BM' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 nota_batalmuat_h.USER_ID_PAYMENT AS USER_ID
					FROM    nota_batalmuat_h
						 LEFT JOIN
							nota_batalmuat_d
						 ON (TRIM (nota_batalmuat_h.ID_REQ) =
								TRIM (nota_batalmuat_d.ID_REQ))
						  LEFT JOIN
							NOTA_BATALMUAT_H
						   ON (TRIM(NOTA_BATALMUAT_H.ID_REQ)= TRIM(nota_batalmuat_d.ID_REQ))
						   
				  UNION
				  SELECT NO_CONTAINER,
						 BH_NOTA.ID_NOTA,
						 NO_FAKTUR,
						 BH_NOTA.ID_REQUEST AS ID_REQ,
						 EMKL,
						 STATUS,
						 ALAMAT_EMKL AS ALAMAT,
						 VESSEL,
						 ' ' AS VOYAGE_IN,
						 VOYAGE AS VOYAGE_OUT,
						 TGL_CETAK AS TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'BH' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 USER_ID_PAYMENT AS USER_ID
					FROM    BH_NOTA
						 INNER JOIN
							BH_DETAIL_NOTA
						 ON (TRIM (BH_NOTA.ID_NOTA) = TRIM (BH_DETAIL_NOTA.ID_NOTA))
				  UNION
				  SELECT NO_CONTAINER,
						 EXMO_NOTA.ID_NOTA,
						 NO_FAKTUR,
						 ID_REQUEST AS ID_REQ,
						 EMKL,
						 STATUS,
						 ALAMAT,
						 '' AS VESSEL,
						 ' ' AS VOYAGE_IN,
						 ' ' AS VOYAGE_OUT,
						 TGL_CETAK_NOTA AS TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'EXMO' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 USER_ID_PAYMENT AS USER_ID
					FROM    EXMO_NOTA
						 INNER JOIN
							EXMO_DETAIL_NOTA
						 ON (TRIM (EXMO_NOTA.ID_NOTA) = TRIM (EXMO_DETAIL_NOTA.ID_NOTA))
				  UNION
				  SELECT NO_CONTAINER,
						 A.ID_NOTA,
						 A.NO_FAKTUR,
						 A.ID_REQ AS ID_REQ,
						 A.CUSTOMER AS EMKL,
						 A.STATUS,
						 A.ALAMAT,
						 B.VESSEL_NEW AS VESSEL,
						 B.VOYAGE_IN_NEW AS VOYAGE_IN,
						 B.VOYAGE_OUT_NEW AS VOYAGE_OUT,
						 A.TGL_CETAK AS TGL_SIMPAN,
						 A.TGL_PAYMENT,
						 A.PAYMENT_VIA,
						 A.TOTAL,
						 A.COA,
						 '' AS KD_MODUL,
						 'TRANS' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 USER_ID_PAYMENT AS USER_ID
					FROM NOTA_TRANSHIPMENT_H A
						 LEFT JOIN REQ_TRANSHIPMENT_H B
							ON B.ID_REQ = A.ID_REQ
						 INNER JOIN REQ_TRANSHIPMENT_D C
							ON (TRIM (A.ID_REQ) = TRIM (C.ID_REQ))
				  UNION
				  SELECT NO_CONTAINER,
						 NOTA_REEKSPOR_H.ID_NOTA,
						 NO_FAKTUR,
						 NOTA_REEKSPOR_H.ID_REQUEST AS ID_REQ,
						 NM_PEMILIK,
						 STATUS,
						 ALAMAT,
						 NM_KAPAL AS VESSEL,
						 VOYAGE_IN,
						 VOYAGE_OUT,
						 TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'REEX' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 USER_ID_PAYMENT AS USER_ID
					FROM    NOTA_REEKSPOR_H
						 INNER JOIN
							REQ_REEKSPOR_D
						 ON (TRIM (NOTA_REEKSPOR_H.ID_REQUEST) =
								TRIM (REQ_REEKSPOR_D.ID_REQUEST))
				  UNION
				  SELECT NO_CONTAINER,
						 A.ID_NOTA,
						 A.NO_FAKTUR,
						 A.ID_REQ AS ID_REQ,
						 A.CUSTOMER AS EMKL,
						 A.STATUS,
						 A.ALAMAT,
						 '' AS VESSEL,
						 '' AS VOYAGE_IN,
						 '' AS VOYAGE_OUT,
						 A.TGL_CETAK AS TGL_SIMPAN,
						 A.TGL_PAYMENT,
						 A.PAYMENT_VIA,
						 A.TOTAL,
						 A.COA,
						 '' AS KD_MODUL,
						 'TRANS' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 USER_ID_PAYMENT AS USER_ID
					FROM NOTA_REEXPORT_H A
						 LEFT JOIN REQ_REEXPORT_H B
							ON B.ID_REQ = A.ID_REQ
						 INNER JOIN REQ_REEXPORT_D C
							ON (TRIM (A.ID_REQ) = TRIM (C.ID_REQ))
				  UNION
				  SELECT NO_CONTAINER,
						 NOTA_HICOSCAN_H.ID_NOTA,
						 NOTA_HICOSCAN_H.ID_NOTA AS NO_FAKTUR,
						 NOTA_HICOSCAN_H.ID_REQUEST AS ID_REQ,
						 NOTA_HICOSCAN_H.EMKL AS NM_PEMILIK,
						 NOTA_HICOSCAN_H.STATUS,
						 NOTA_HICOSCAN_H.ALAMAT_EMKL AS ALAMAT,
						 NOTA_HICOSCAN_H.VESSEL,
						 NOTA_HICOSCAN_H.VOYAGE AS VOYAGE_IN,
						 NULL AS VOYAGE_OUT,
						 TGL_CETAK AS TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'HICO' KET,
						 '' AS TGL_BERLAKU,
						 '' PEB,
						 '' NPE,
						 USER_ID_PAYMENT AS USER_ID
					FROM    NOTA_HICOSCAN_H
						 INNER JOIN
							NOTA_HICOSCAN_D
						 ON (TRIM (NOTA_HICOSCAN_H.ID_NOTA) =
								TRIM (NOTA_HICOSCAN_D.ID_NOTA))) z
				 LEFT JOIN tth_nota_all y
					ON z.ID_NOTA = y.KD_UPER
				 LEFT JOIN TB_USER tu
					ON z.USER_ID = TU.ID
		   WHERE z.NO_CONTAINER = '$no_container'
		ORDER BY z.TGL_SIMPAN DESC
		";					
		}
		else {
			$sq="  SELECT z.NO_CONTAINER,
					 z.ID_NOTA,
					 z.NO_FAKTUR,
					 z.ID_REQ,
					 z.ID_REQ_OL,
					 z.EMKL,
					 z.STATUS,
					 z.ALAMAT,
					 z.VESSEL,
					 z.VOYAGE_IN,
					 z.VOYAGE_OUT,
					 to_char(z.TGL_SIMPAN,'dd-mm-yyyy hh24:mi') TGL_SIMPAN,
					 to_char(z.TGL_PAYMENT,'dd-mm-yyyy hh24:mi') TGL_PAYMENT,
					 z.PAYMENT_VIA,
					 z.TOTAL,
					 z.COA,
					 z.KD_MODUL,
					 z.KET,
					 to_char(y.TANGGAL_RECEIPT,'dd-mm-yyyy hh24:mi') TANGGAL_RECEIPT,
					 z.TGL_BERLAKU 
				FROM (SELECT NO_CONTAINER,
					 nota_delivery_h.ID_NOTA,
					 NO_FAKTUR,
					 req_delivery_h.ID_REQ,
					 req_delivery_h.ID_REQ_OL,
					 nota_delivery_h.EMKL,
					 nota_delivery_h.STATUS,
					 nota_delivery_h.ALAMAT,
					 nota_delivery_h.VESSEL,
					 nota_delivery_h.VOYAGE_IN,
					 nota_delivery_h.VOYAGE_OUT,
					 req_delivery_h.TGL_REQUEST AS TGL_SIMPAN,
					 TGL_PAYMENT,
					 PAYMENT_VIA,
					 TOTAL,
					 nota_delivery_h.COA,
					 KD_MODUL,
					 'SP2' KET,
					 TO_CHAR (nota_delivery_h.TGL_SP2, 'DD-MON-YYYY')
						AS TGL_BERLAKU 
				FROM req_delivery_d
					 LEFT JOIN nota_delivery_h
						ON (TRIM (req_delivery_d.NO_REQ_DEV) =
							   TRIM (nota_delivery_h.ID_REQ))
					 LEFT JOIN req_delivery_h
						ON (TRIM (req_delivery_d.NO_REQ_DEV) =
							   TRIM (req_delivery_h.ID_REQ))     
				UNION
				SELECT NO_CONTAINER,
					NOTA_receiving_h.ID_NOTA,
					NO_FAKTUR,
					req_receiving_h.ID_REQ,
					req_receiving_h.ID_REQ_OL,
					EMKL,
					nota_receiving_h.STATUS,
					nota_receiving_h.ALAMAT,
					nota_receiving_h.VESSEL,
					req_receiving_h.VOYAGE AS VOYAGE_IN,
					nota_receiving_h.VOYAGE_OUT,
					req_receiving_h.TGL_REQUEST as TGL_SIMPAN,
					TGL_PAYMENT,
					PAYMENT_VIA,
					TOTAL,
					nota_receiving_h.COA,
					KD_MODUL,
					'ANNE' KET,
					'' AS TGL_BERLAKU
			   FROM req_receiving_d
					LEFT JOIN nota_receiving_h
					   ON (TRIM (nota_receiving_h.ID_REQ) =
							  TRIM (req_receiving_d.NO_REQ_ANNE))
					LEFT JOIN req_receiving_h
					   ON (TRIM (req_receiving_h.ID_REQ) =
							  TRIM (req_receiving_d.NO_REQ_ANNE))
				UNION
			  SELECT NO_CONTAINER,
					 nota_batalmuat_h.NO_NOTA AS ID_NOTA,
					 NO_FAKTUR,
					 nota_batalmuat_h.ID_BATALMUAT AS ID_REQ,
					 '' ID_REQ_OL,
					 nota_batalmuat_h.EMKL,
					 nota_batalmuat_h.STATUS,
					 nota_batalmuat_h.ALAMAT,
					  tb_batalmuat_h.VESSEL,
					 ' ' AS VOYAGE_IN,
					  tb_batalmuat_h.VOYAGE AS VOYAGE_OUT,
					 TGL_NOTA AS TGL_SIMPAN,
					 TGL_PAYMENT,
					 PAYMENT_VIA,
					 nota_batalmuat_h.TOTAL,
					 COA,
					 nota_batalmuat_h.JENIS AS KD_MODUL,
					 'BM' KET,
					 '' AS TGL_BERLAKU 
				FROM    nota_batalmuat_h
					 LEFT JOIN
						tb_batalmuat_d
					 ON (TRIM (nota_batalmuat_h.ID_BATALMUAT) =
							TRIM (tb_batalmuat_d.ID_BATALMUAT))
					  LEFT JOIN
						tb_batalmuat_h
					   ON (TRIM(tb_batalmuat_h.ID_BATALMUAT)= TRIM(tb_batalmuat_d.ID_BATALMUAT))
					   
			  UNION
			  SELECT NO_CONTAINER,
					 BH_NOTA.ID_NOTA,
					 NO_FAKTUR,
					 BH_NOTA.ID_REQUEST AS ID_REQ,
					 '' ID_REQ_OL,
					 EMKL,
					 STATUS,
					 ALAMAT_EMKL AS ALAMAT,
					 VESSEL,
					 ' ' AS VOYAGE_IN,
					 VOYAGE AS VOYAGE_OUT,
					 TGL_CETAK AS TGL_SIMPAN,
					 TGL_PAYMENT,
					 PAYMENT_VIA,
					 TOTAL,
					 COA,
					 '' AS KD_MODUL,
					 'BH' KET,
					 '' AS TGL_BERLAKU 
				FROM    BH_NOTA
					 INNER JOIN
						BH_DETAIL_NOTA
					 ON (TRIM (BH_NOTA.ID_NOTA) = TRIM (BH_DETAIL_NOTA.ID_NOTA))
			  UNION
			  SELECT NO_CONTAINER,
					 EXMO_NOTA.ID_NOTA,
					 NO_FAKTUR,
					 ID_REQUEST AS ID_REQ,
					 '' ID_REQ_OL, 
					 EMKL,
					 STATUS,
					 ALAMAT,
					 '' AS VESSEL,
					 ' ' AS VOYAGE_IN,
					 ' ' AS VOYAGE_OUT,
					 TGL_CETAK_NOTA AS TGL_SIMPAN,
					 TGL_PAYMENT,
					 PAYMENT_VIA,
					 TOTAL,
					 COA,
					 '' AS KD_MODUL,
					 'EXMO' KET,
					 '' AS TGL_BERLAKU 
				FROM    EXMO_NOTA
					 INNER JOIN
						EXMO_DETAIL_NOTA
					 ON (TRIM (EXMO_NOTA.ID_NOTA) = TRIM (EXMO_DETAIL_NOTA.ID_NOTA))
			  UNION
			  SELECT NO_CONTAINER,
					 A.ID_NOTA,
					 A.NO_FAKTUR,
					 A.ID_REQUEST AS ID_REQ,
					 '' ID_REQ_OL, 
					 A.CUSTOMER AS EMKL,
					 A.STATUS,
					 A.ALAMAT,
					 B.VESSEL AS VESSEL,
					 ' ' AS VOYAGE_IN,
					 B.VOYAGE AS VOYAGE_OUT,
					 A.TGL_CETAK AS TGL_SIMPAN,
					 A.TGL_PAYMENT,
					 A.PAYMENT_VIA,
					 A.TOTAL,
					 A.COA,
					 '' AS KD_MODUL,
					 'TRANS' KET,
					 '' AS TGL_BERLAKU 
				FROM NOTA_TRANSHIPMENT_H A
					 LEFT JOIN REQ_TRANSHIPMENT_H B
						ON B.ID_REQ = A.ID_REQUEST
					 INNER JOIN REQ_TRANSHIPMENT_D C
						ON (TRIM (A.ID_REQUEST) = TRIM (C.ID_REQ))
			  UNION
			  SELECT NO_CONTAINER,
					 NOTA_REEKSPOR_H.ID_NOTA,
					 NO_FAKTUR,
					 NOTA_REEKSPOR_H.ID_REQUEST AS ID_REQ,
					 '' ID_REQ_OL, 
					 NM_PEMILIK,
					 STATUS,
					 ALAMAT,
					 NM_KAPAL AS VESSEL,
					 VOYAGE_IN,
					 VOYAGE_OUT,
					 TGL_SIMPAN,
					 TGL_PAYMENT,
					 PAYMENT_VIA,
					 TOTAL,
					 COA,
					 '' AS KD_MODUL,
					 'REEX' KET,
					 '' AS TGL_BERLAKU 
				FROM    NOTA_REEKSPOR_H
					 INNER JOIN
						REQ_REEKSPOR_D
					 ON (TRIM (NOTA_REEKSPOR_H.ID_REQUEST) =
							TRIM (REQ_REEKSPOR_D.ID_REQUEST))
			  UNION
			  SELECT NO_CONTAINER,
					 A.ID_NOTA,
					 A.NO_FAKTUR,
					 A.ID_REQUEST AS ID_REQ,
					 '' ID_REQ_OL, 
					 A.CUSTOMER AS EMKL,
					 A.STATUS,
					 A.ALAMAT,
					 B.VESSEL AS VESSEL,
					 ' ' AS VOYAGE_IN,
					 B.VOYAGE AS VOYAGE_OUT,
					 A.TGL_CETAK AS TGL_SIMPAN,
					 A.TGL_PAYMENT,
					 A.PAYMENT_VIA,
					 A.TOTAL,
					 A.COA,
					 '' AS KD_MODUL,
					 'TRANS' KET,
					 '' AS TGL_BERLAKU 
				FROM NOTA_REEXPORT_H A
					 LEFT JOIN REQ_REEXPORT_H B
						ON B.ID_REQ = A.ID_REQUEST
					 INNER JOIN REQ_REEXPORT_D C
						ON (TRIM (A.ID_REQUEST) = TRIM (C.ID_REQ))
			  UNION
			  SELECT NO_CONTAINER,
					 NOTA_HICOSCAN_H.ID_NOTA,
					 NOTA_HICOSCAN_H.ID_NOTA AS NO_FAKTUR,
					 NOTA_HICOSCAN_H.ID_REQUEST AS ID_REQ,
					 '' ID_REQ_OL,
					 NOTA_HICOSCAN_H.EMKL AS NM_PEMILIK,
					 NOTA_HICOSCAN_H.STATUS,
					 NOTA_HICOSCAN_H.ALAMAT_EMKL AS ALAMAT,
					 NOTA_HICOSCAN_H.VESSEL,
					 NOTA_HICOSCAN_H.VOYAGE AS VOYAGE_IN,
					 NULL AS VOYAGE_OUT,
					 TGL_CETAK AS TGL_SIMPAN,
					 TGL_PAYMENT,
					 PAYMENT_VIA,
					 TOTAL,
					 COA,
					 '' AS KD_MODUL,
					 'HICO' KET,
					 '' AS TGL_BERLAKU 
				FROM    NOTA_HICOSCAN_H
					 INNER JOIN
						NOTA_HICOSCAN_D
					 ON (TRIM (NOTA_HICOSCAN_H.ID_NOTA) =
							TRIM (NOTA_HICOSCAN_D.ID_NOTA))							  
				UNION
				SELECT NO_CONTAINER,
						 BH_NOTA.ID_NOTA,
						 NO_FAKTUR,
						 BH_NOTA.ID_REQUEST AS ID_REQ,
						 '' ID_REQ_OL,
						 EMKL,
						 STATUS,
						 ALAMAT_EMKL AS ALAMAT,
						 VESSEL,
						 ' ' AS VOYAGE_IN,
						 VOYAGE AS VOYAGE_OUT,
						 TGL_CETAK AS TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'BH' KET,
						 '' AS TGL_BERLAKU 
					FROM    BH_NOTA
						 INNER JOIN
							BH_DETAIL_NOTA
						 ON (TRIM (BH_NOTA.ID_NOTA) = TRIM (BH_DETAIL_NOTA.ID_NOTA))
				UNION
				SELECT NO_CONTAINER,
						 EXMO_NOTA.ID_NOTA,
						 NO_FAKTUR,
						 ID_REQUEST AS ID_REQ,
						 '' ID_REQ_OL,
						 EMKL,
						 STATUS,
						 ALAMAT,
						 '' AS VESSEL,
						 ' ' AS VOYAGE_IN,
						 ' ' AS VOYAGE_OUT,
						 TGL_CETAK_NOTA AS TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'EXMO' KET,
						 '' AS TGL_BERLAKU 
					FROM    EXMO_NOTA
						 INNER JOIN
							EXMO_DETAIL_NOTA
						 ON (TRIM (EXMO_NOTA.ID_NOTA) = TRIM (EXMO_DETAIL_NOTA.ID_NOTA))
				UNION
				SELECT NO_CONTAINER,
						 B.ID_NOTA,
						 B.NO_FAKTUR,
						 B.ID_REQUEST AS ID_REQ,
						 '' ID_REQ_OL, 
						 B.CUSTOMER AS EMKL,
						 B.STATUS,
						 B.ALAMAT,
						 C.VESSEL AS VESSEL,
						 ' ' AS VOYAGE_IN,
						 C.VOYAGE AS VOYAGE_OUT,
						 B.TGL_CETAK AS TGL_SIMPAN,
						 B.TGL_PAYMENT,
						 B.PAYMENT_VIA,
						 B.TOTAL,
						 B.COA,
						 '' AS KD_MODUL,
						 'TRANS' KET,
						 '' AS TGL_BERLAKU 
					FROM REQ_TRANSHIPMENT_D A
						 LEFT JOIN NOTA_TRANSHIPMENT_H B
							ON A.ID_REQ = B.ID_REQUEST
						 LEFT JOIN REQ_TRANSHIPMENT_H C
							ON (TRIM (A.ID_REQ) = TRIM (C.ID_REQ))
				UNION
				SELECT NO_CONTAINER,
						 NOTA_HICOSCAN_H.ID_NOTA,
						 NOTA_HICOSCAN_H.ID_NOTA AS NO_FAKTUR,
						 REQ_HICOSCAN_D.ID_REQUEST AS ID_REQ,
						 '' ID_REQ_OL,
						 NOTA_HICOSCAN_H.EMKL AS NM_PEMILIK,
						 NOTA_HICOSCAN_H.STATUS AS STATUS,
						 NOTA_HICOSCAN_H.ALAMAT_EMKL AS ALAMAT,
						 NOTA_HICOSCAN_H.VESSEL,
						 NOTA_HICOSCAN_H.VOYAGE AS VOYAGE_IN,
						 NULL AS VOYAGE_OUT,
						 TGL_CETAK AS TGL_SIMPAN,
						 TGL_PAYMENT,
						 PAYMENT_VIA,
						 TOTAL,
						 COA,
						 '' AS KD_MODUL,
						 'HICO' KET,
						 '' AS TGL_BERLAKU 
					FROM REQ_HICOSCAN_D
						 LEFT JOIN NOTA_HICOSCAN_H
							ON (TRIM (NOTA_HICOSCAN_H.ID_REQUEST) =
								   TRIM (REQ_HICOSCAN_D.ID_REQUEST))
						 LEFT JOIN REQ_HICOSCAN
							ON (TRIM (REQ_HICOSCAN.ID_REQUEST) =
								   TRIM (REQ_HICOSCAN_D.ID_REQUEST))) z
				LEFT JOIN tth_nota_all y
					ON z.ID_NOTA = y.KD_UPER 
		   WHERE z.NO_CONTAINER = '$no_container'
			ORDER BY z.TGL_SIMPAN DESC";
		}
		
		//echo $sq;
		
		$billing=array();
		for($j=0;$j<count($conn['billing']);$j++)
		{
			if(!checkOriSQL($conn['billing'][$j],$sq,$getBilling,$err)) goto Err;
			//FETCH QUERY
			while ($row_billing = oci_fetch_array($getBilling, OCI_ASSOC))
			{
				switch($row_billing[STATUS])
				{
					case "P":
						$status = "PAID";
					break;
					case "S":
						$status = "APPROVED";
					break;
					case "N":
						$status = "DRAFT";
					break;
					case "X":
						$status = "CANCEL";
					break;
					default:
						$status = $row_billing['STATUS'];
					break;
				}
				$billing_tmp = array(
						'no_request' => $row_billing['ID_REQ'],
						'no_request_ol' => $row_billing['ID_REQ_OL'],
						'request_type' => $row_billing['KET'],
						'no_proforma' => $row_billing['ID_NOTA'],
						'no_invoice' => $row_billing['NO_FAKTUR'],
						'customer' => $row_billing['EMKL'],
						'date_request' => $row_billing['TGL_SIMPAN'],
						'date_payment' => $row_billing['TGL_PAYMENT'],
						'paid_thru' => $row_billing['TGL_BERLAKU'],
						'status' => $status
				);
				array_push($billing, $billing_tmp);
			}
		}
		
		$out_data = array();
		$out_data['info']=$info;
		$out_data['handling']=$handling;
		$out_data['billing']=$billing;

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