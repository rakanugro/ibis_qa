<?php

/*|
 | Function Name 	: getDashboardMonitoring
 | Description 		: Get Dashboard Monitoring
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getDashboardMonitoring2($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$polpod	  = $xml_data->data->polpod;
		$startDate = $xml_data->data->startDate;
		$endDate = $xml_data->data->endDate;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$vvdspil = array();
		$vvdtms = array();
		$vvdmrt = array();
		$vvdtnt = array();
		$vvdctp = array();
		
		  $qvvdspil="SELECT ID_JOINT_VESSEL,
							   VESSEL,
							   VOYAGE_IN,
							   VOYAGE_OUT,
							   CALL_SIGN,
							   KD_OPERATOR OPERATOR_ID,
							   OPERATOR_NAME,
							   TO_CHAR (TO_DATE (eta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  eta,
							   TO_CHAR (TO_DATE (etd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  etd,
							   TO_CHAR (TO_DATE (rta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  ata,
							   TO_CHAR (TO_DATE (rtd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  atd,
							   '' voyage,
							   id_ves_voyage,
							   POD vsb_voyp_port,
							   terminal
						  FROM MST_SBY_JOINT_VESSEL 
						  where trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')+5
						  AND KD_OPERATOR = 'SPL'";
						  
			$qvvdtms="SELECT ID_JOINT_VESSEL,
							   VESSEL,
							   VOYAGE_IN,
							   VOYAGE_OUT,
							   CALL_SIGN,
							   KD_OPERATOR OPERATOR_ID,
							   OPERATOR_NAME,
							   TO_CHAR (TO_DATE (eta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  eta,
							   TO_CHAR (TO_DATE (etd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  etd,
							   TO_CHAR (TO_DATE (rta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  ata,
							   TO_CHAR (TO_DATE (rtd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  atd,
							   '' voyage,
							   id_ves_voyage,
							   POD vsb_voyp_port,
							   terminal
						  FROM MST_SBY_JOINT_VESSEL 
						  where trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')+5
						  AND KD_OPERATOR = 'TMS'";
						  
			
				$qvvdtnt="SELECT ID_JOINT_VESSEL,
							   VESSEL,
							   VOYAGE_IN,
							   VOYAGE_OUT,
							   CALL_SIGN,
							   KD_OPERATOR OPERATOR_ID,
							   OPERATOR_NAME,
							   TO_CHAR (TO_DATE (eta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  eta,
							   TO_CHAR (TO_DATE (etd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  etd,
							   TO_CHAR (TO_DATE (rta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  ata,
							   TO_CHAR (TO_DATE (rtd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  atd,
							   '' voyage,
							   id_ves_voyage,
							   POD vsb_voyp_port,
							   terminal
						  FROM MST_SBY_JOINT_VESSEL 
						  where trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')+5
						  AND KD_OPERATOR = 'TAN'";
						  
				$qvvdmrt="SELECT ID_JOINT_VESSEL,
							   VESSEL,
							   VOYAGE_IN,
							   VOYAGE_OUT,
							   CALL_SIGN,
							   KD_OPERATOR OPERATOR_ID,
							   OPERATOR_NAME,
							   TO_CHAR (TO_DATE (eta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  eta,
							   TO_CHAR (TO_DATE (etd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  etd,
							   TO_CHAR (TO_DATE (rta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  ata,
							   TO_CHAR (TO_DATE (rtd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  atd,
							   '' voyage,
							   id_ves_voyage,
							   POD vsb_voyp_port,
							   terminal
						  FROM MST_SBY_JOINT_VESSEL 
						  where trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')+5
						  AND KD_OPERATOR IN ('MRT','MRTS')";
						  
			$qvvdctp="SELECT ID_JOINT_VESSEL,
							   VESSEL,
							   VOYAGE_IN,
							   VOYAGE_OUT,
							   CALL_SIGN,
							   KD_OPERATOR OPERATOR_ID,
							   OPERATOR_NAME,
							   TO_CHAR (TO_DATE (eta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  eta,
							   TO_CHAR (TO_DATE (etd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  etd,
							   TO_CHAR (TO_DATE (rta, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  ata,
							   TO_CHAR (TO_DATE (rtd, 'rrrrmmddhh24miss'), 'dd/mm/rrrr hh24:mi:ss')
								  atd,
							   '' voyage,
							   id_ves_voyage,
							   POD vsb_voyp_port,
							   terminal
						  FROM MST_SBY_JOINT_VESSEL 
						  where trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')+5
						  AND KD_OPERATOR IN ('CRKA','CTP')";

			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_009'];
			$conn['ibis']         = $conn['ori']['ibis'];
			
			
			$spil20 = 0;
			$spil40 = 0;
			$spil45 = 0;
			$tms20 = 0;
			$tms40 = 0;
			$tms45 = 0;
			$mrt20 = 0;
			$mrt40 = 0;
			$mrt45 = 0;
			$tnt20 = 0;
			$tnt40 = 0;
			$tnt45 = 0;
			$ctp20 = 0;
			$ctp40 = 0;
			$ctp45 = 0;
						
			############################# SPIL ###################################################
			if(!checkOriSQL($conn['ibis'],$qvvdspil,$getvvdspil,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_vessel_spil = oci_fetch_array($getvvdspil, OCI_ASSOC))
				{
					/*if ($row_vessel_spil[TERMINAL] == '009'){
					
						
						$qqty = "select * from (
									select count(no_container) qty_20 from simpb.coarri_ptp where vessel = '".$row_vessel_spil[VESSEL]."' and voyage_in = '".$row_vessel_spil[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) =2),
									(select count(no_container) qty_40 from simpb.coarri_ptp where vessel = '".$row_vessel_spil[VESSEL]."' and voyage_in = '".$row_vessel_spil[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1)= 4),
									(select count(no_container) qty_45 from simpb.coarri_ptp where vessel = '".$row_vessel_spil[VESSEL]."' and voyage_in = '".$row_vessel_spil[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) not in (2,4))";
							
								if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qqty,$getQtyMTI,$err,$debug)) goto Err;
								$row_qtymti = oci_fetch_array($getQtyMTI, OCI_ASSOC);	

								$spil20 = $spil20 + $row_qtymti['QTY_20'];
								$spil40 = $spil40 + $row_qtymti['QTY_40'];
								$spil45 = $spil45 + $row_qtymti['QTY_45'];
							
							$vvd_sub_spil = array(
													'vessel' => $row_vessel_spil[VESSEL],
													'voyage' => $row_vessel_spil[VOYAGE_IN] .'-'.$row_vessel_spil[VOYAGE_OUT],
													'call_sign' => $row_vessel_spil[CALL_SIGN],
													'operator_id' => $row_vessel_spil[OPERATOR_ID],
													'operator_name' => $row_vessel_spil[OPERATOR_NAME],
													'eta' => $row_vessel_spil[ETA],
													'etd' => $row_vessel_spil[ETD],
													'ata' => $row_vessel_spil[ATA],
													'atd' => $row_vessel_spil[ATD],
													'id_vsb_voyage' => $row_vessel_spil[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_spil[VSB_VOYP_PORT],
													'terminal' => '009',
													'qty_20' => $row_qtymti['QTY_20'],
													'qty_40' => $row_qtymti['QTY_40'],
													'qty_45' => $row_qtymti['QTY_45']
												);
							array_push($vvdspil,$vvd_sub_spil);
					
					} else {*/
						if ($row_vessel_spil[TERMINAL] == 'T1'){
							$j = 2;
						} else if ($row_vessel_spil[TERMINAL] == 'T2'){
							$j = 1;
						} else if ($row_vessel_spil[TERMINAL] == 'T3') {
							$j = 0;
						} else if ($row_vessel_spil[TERMINAL] == '009') {
							$j = 3;
						}
						
					//build "info" data
							$qContainer = "SELECT * FROM (
											SELECT COUNT (no_container) qty_20
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_spil[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_spil[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_spil[VOYAGE_OUT]."'
												   AND size_cont = '20'
												   AND a.vessel_confirm is not null) q20,
											(SELECT COUNT (no_container) qty_40
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_spil[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_spil[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_spil[VOYAGE_OUT]."'
												   AND size_cont = '40'
												   AND a.vessel_confirm is not null) q40,
											(SELECT COUNT (no_container) qty_45
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_spil[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_spil[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_spil[VOYAGE_OUT]."'
												   AND size_cont = '45'
												   AND a.vessel_confirm is not null) q45";
							if(!checkOriSQL($conn['container'][$j],$qContainer,$getQty,$err,$debug)) goto Err;
							$row_qty = oci_fetch_array($getQty, OCI_ASSOC);
							$qty_20 = $row_qty["QTY_20"];
							$qty_40 = $row_qty["QTY_40"];
							$qty_45 = $row_qty["QTY_45"];
							
							$spil20 = $spil20 + $row_qty["QTY_20"];
							$spil40 = $spil40 + $row_qty["QTY_40"];
							$spil45 = $spil45 + $row_qty["QTY_45"];
							
							$vvd_sub_spil = array(
													'vessel' => $row_vessel_spil[VESSEL],
													'voyage' => $row_vessel_spil[VOYAGE_IN] .'-'.$row_vessel_spil[VOYAGE_OUT],
													'call_sign' => $row_vessel_spil[CALL_SIGN],
													'operator_id' => $row_vessel_spil[OPERATOR_ID],
													'operator_name' => $row_vessel_spil[OPERATOR_NAME],
													'eta' => $row_vessel_spil[ETA],
													'etd' => $row_vessel_spil[ETD],
													'ata' => $row_vessel_spil[ATA],
													'atd' => $row_vessel_spil[ATD],
													'id_vsb_voyage' => $row_vessel_spil[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_spil[VSB_VOYP_PORT],
													'terminal' => $row_vessel_spil[TERMINAL],
													'qty_20' => $qty_20,
													'qty_40' => $qty_40,
													'qty_45' => $qty_45
												);

							array_push($vvdspil, $vvd_sub_spil);
					//}
				}
				
			############################# TEMAS ###################################################

				if(!checkOriSQL($conn['ibis'],$qvvdtms,$getvvdtms,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_vessel_tms = oci_fetch_array($getvvdtms, OCI_ASSOC))
				{
					/*if ($row_vessel_tms[TERMINAL] == '009'){
					
					
							$qqty = "select * from (
									select count(no_container) qty_20 from simpb.coarri_ptp where vessel = '".$row_vessel_tms[VESSEL]."' and voyage_in = '".$row_vessel_tms[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) =2),
									(select count(no_container) qty_40 from simpb.coarri_ptp where vessel = '".$row_vessel_tms[VESSEL]."' and voyage_in = '".$row_vessel_tms[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1)= 4),
									(select count(no_container) qty_45 from simpb.coarri_ptp where vessel = '".$row_vessel_tms[VESSEL]."' and voyage_in = '".$row_vessel_tms[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) not in (2,4))";
							
								if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qqty,$getQtyMTI,$err,$debug)) goto Err;
								$row_qtymti = oci_fetch_array($getQtyMTI, OCI_ASSOC);	
							
								$tms20 = $tms20 + $row_qtymti['QTY_20'];
								$tms40 = $tms40 + $row_qtymti['QTY_40'];
								$tms45 = $tms45 + $row_qtymti['QTY_45'];								
							
							$vvd_sub_tms = array(
													'vessel' => $row_vessel_tms[VESSEL],
													'voyage' => $row_vessel_tms[VOYAGE_IN] .'-'.$row_vessel_tms[VOYAGE_OUT],
													'call_sign' => $row_vessel_tms[CALL_SIGN],
													'operator_id' => $row_vessel_tms[OPERATOR_ID],
													'operator_name' => $row_vessel_tms[OPERATOR_NAME],
													'eta' => $row_vessel_tms[ETA],
													'etd' => $row_vessel_tms[ETD],
													'ata' => $row_vessel_tms[ATA],
													'atd' => $row_vessel_tms[ATD],
													'id_vsb_voyage' => $row_vessel_tms[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_tms[VSB_VOYP_PORT],
													'terminal' => '009',
													'qty_20' => $row_qtymti['QTY_20'],
													'qty_40' => $row_qtymti['QTY_40'],
													'qty_45' => $row_qtymti['QTY_45']
												);
							array_push($vvdtms,$vvd_sub_tms);
					
					} else {
					*/
						if ($row_vessel_tms[TERMINAL] == 'T1'){
							$j = 2;
						} else if ($row_vessel_tms[TERMINAL] == 'T2'){
							$j = 1;
						} else if ($row_vessel_tms[TERMINAL] == 'T3') {
							$j = 0;
						} else if ($row_vessel_tms[TERMINAL] == '009') {
							$j = 3;
						}
					//build "info" data
							$qContainer = "SELECT * FROM (
											SELECT COUNT (no_container) qty_20
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_tms[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_tms[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_tms[VOYAGE_OUT]."'
												   AND size_cont = '20'
												   AND a.vessel_confirm is not null) q20,
											(SELECT COUNT (no_container) qty_40
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_tms[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_tms[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_tms[VOYAGE_OUT]."'
												   AND size_cont = '40'
												   AND a.vessel_confirm is not null) q40,
											(SELECT COUNT (no_container) qty_45
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_tms[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_tms[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_tms[VOYAGE_OUT]."'
												   AND size_cont = '45'
												   AND a.vessel_confirm is not null) q45";
							if(!checkOriSQL($conn['container'][$j],$qContainer,$getQty,$err,$debug)) goto Err;
							$row_qty = oci_fetch_array($getQty, OCI_ASSOC);
							$qty_20 = $row_qty["QTY_20"];
							$qty_40 = $row_qty["QTY_40"];
							$qty_45 = $row_qty["QTY_45"];
							
							$tms20 = $tms20 + $row_qty["QTY_20"];
							$tms40 = $tms40 + $row_qty["QTY_40"];
							$tms45 = $tms45 + $row_qty["QTY_45"];
							
							$vvd_sub_tms = array(
													'vessel' => $row_vessel_tms[VESSEL],
													'voyage' => $row_vessel_tms[VOYAGE_IN] .'-'.$row_vessel_tms[VOYAGE_OUT],
													'call_sign' => $row_vessel_tms[CALL_SIGN],
													'operator_id' => $row_vessel_tms[OPERATOR_ID],
													'operator_name' => $row_vessel_tms[OPERATOR_NAME],
													'eta' => $row_vessel_tms[ETA],
													'etd' => $row_vessel_tms[ETD],
													'ata' => $row_vessel_tms[ATA],
													'atd' => $row_vessel_tms[ATD],
													'id_vsb_voyage' => $row_vessel_tms[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_tms[VSB_VOYP_PORT],
													'terminal' => $row_vessel_tms[TERMINAL],
													'qty_20' => $qty_20,
													'qty_40' => $qty_40,
													'qty_45' => $qty_45
												);

							array_push($vvdtms,$vvd_sub_tms);
					//}
				}
				
				################################### TANTO INTIM LINE ###############################################

				if(!checkOriSQL($conn['ibis'],$qvvdtnt,$getvvdtnt,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_vessel_tnt = oci_fetch_array($getvvdtnt, OCI_ASSOC))
				{
					/*if ($row_vessel_tnt[TERMINAL] == '009'){
							
				
							$qqty = "select * from (
									select count(no_container) qty_20 from simpb.coarri_ptp where vessel = '".$row_vessel_tnt[VESSEL]."' and voyage_in = '".$row_vessel_tnt[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) =2),
									(select count(no_container) qty_40 from simpb.coarri_ptp where vessel = '".$row_vessel_tnt[VESSEL]."' and voyage_in = '".$row_vessel_tnt[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1)= 4),
									(select count(no_container) qty_45 from simpb.coarri_ptp where vessel = '".$row_vessel_tnt[VESSEL]."' and voyage_in = '".$row_vessel_tnt[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) not in (2,4))";
							
								if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qqty,$getQtyMTI,$err,$debug)) goto Err;
								$row_qtymti = oci_fetch_array($getQtyMTI, OCI_ASSOC);		
								
								$tnt20 = $tnt20 + $row_qtymti['QTY_20'];
								$tnt40 = $tnt40 + $row_qtymti['QTY_40'];
								$tnt45 = $tnt45 + $row_qtymti['QTY_45'];
							
							$vvd_sub_tnt = array(
													'vessel' => $row_vessel_tnt[VESSEL],
													'voyage' => $row_vessel_tnt[VOYAGE_IN] .'-'.$row_vessel_tnt[VOYAGE_OUT],
													'call_sign' => $row_vessel_tnt[CALL_SIGN],
													'operator_id' => $row_vessel_tnt[OPERATOR_ID],
													'operator_name' => $row_vessel_tnt[OPERATOR_NAME],
													'eta' => $row_vessel_tnt[ETA],
													'etd' => $row_vessel_tnt[ETD],
													'ata' => $row_vessel_tnt[ATA],
													'atd' => $row_vessel_tnt[ATD],
													'id_vsb_voyage' => $row_vessel_tnt[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_tnt[VSB_VOYP_PORT],
													'terminal' => '009',
													'qty_20' => $row_qtymti['QTY_20'],
													'qty_40' => $row_qtymti['QTY_40'],
													'qty_45' => $row_qtymti['QTY_45']
												);
							array_push($vvdtnt,$vvd_sub_tnt);
					
					} else {*/
					
						if ($row_vessel_tnt[TERMINAL] == 'T1'){
							$j = 2;
						} else if ($row_vessel_tnt[TERMINAL] == 'T2'){
							$j = 1;
						} else if ($row_vessel_tnt[TERMINAL] == 'T3') {
							$j = 0;
						} else if ($row_vessel_tnt[TERMINAL] == '009') {
							$j = 3;
						}
					//build "info" data
							$qContainer = "SELECT * FROM (
											SELECT COUNT (no_container) qty_20
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_tnt[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_tnt[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_tnt[VOYAGE_OUT]."'
												   AND size_cont = '20'
												   AND a.vessel_confirm is not null) q20,
											(SELECT COUNT (no_container) qty_40
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_tnt[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_tnt[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_tnt[VOYAGE_OUT]."'
												   AND size_cont = '40'
												   AND a.vessel_confirm is not null) q40,
											(SELECT COUNT (no_container) qty_45
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_tnt[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_tnt[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_tnt[VOYAGE_OUT]."'
												   AND size_cont = '45'
												   AND a.vessel_confirm is not null) q45";
							if(!checkOriSQL($conn['container'][$j],$qContainer,$getQty,$err,$debug)) goto Err;
							$row_qty = oci_fetch_array($getQty, OCI_ASSOC);
							$qty_20 = $row_qty["QTY_20"];
							$qty_40 = $row_qty["QTY_40"];
							$qty_45 = $row_qty["QTY_45"];
							
							$tnt20 = $tnt20 + $row_qty["QTY_20"];
							$tnt40 = $tnt40 + $row_qty["QTY_40"];
							$tnt45 = $tnt45 + $row_qty["QTY_45"];
							
							$vvd_sub_tnt = array(
													'vessel' => $row_vessel_tnt[VESSEL],
													'voyage' => $row_vessel_tnt[VOYAGE_IN] .'-'.$row_vessel_tnt[VOYAGE_OUT],
													'call_sign' => $row_vessel_tnt[CALL_SIGN],
													'operator_id' => $row_vessel_tnt[OPERATOR_ID],
													'operator_name' => $row_vessel_tnt[OPERATOR_NAME],
													'eta' => $row_vessel_tnt[ETA],
													'etd' => $row_vessel_tnt[ETD],
													'ata' => $row_vessel_tnt[ATA],
													'atd' => $row_vessel_tnt[ATD],
													'id_vsb_voyage' => $row_vessel_tnt[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_tnt[VSB_VOYP_PORT],
													'terminal' => $row_vessel_tnt[TERMINAL],
													'qty_20' => $qty_20,
													'qty_40' => $qty_40,
													'qty_45' => $qty_45
												);

							array_push($vvdtnt, $vvd_sub_tnt);
				//	}
				}
				
				##################################### MERATUS ###############################################
				if(!checkOriSQL($conn['ibis'],$qvvdmrt,$getvvdmrt,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_vessel_mrt = oci_fetch_array($getvvdmrt, OCI_ASSOC))
				{
				/*	if ($row_vessel_mrt[TERMINAL] == '009'){
					
							$qqty = "select * from (
									select count(no_container) qty_20 from simpb.coarri_ptp where vessel = '".$row_vessel_mrt[VESSEL]."' and voyage_in = '".$row_vessel_mrt[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) =2),
									(select count(no_container) qty_40 from simpb.coarri_ptp where vessel = '".$row_vessel_mrt[VESSEL]."' and voyage_in = '".$row_vessel_mrt[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1)= 4),
									(select count(no_container) qty_45 from simpb.coarri_ptp where vessel = '".$row_vessel_mrt[VESSEL]."' and voyage_in = '".$row_vessel_mrt[VOYAGE_IN]."'
									and e_i = 'E' and substr(iso_code,0,1) not in (2,4))";
							
								if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qqty,$getQtyMTI,$err,$debug)) goto Err;
								$row_qtymti = oci_fetch_array($getQtyMTI, OCI_ASSOC);		

								$mrt20 = $mrt20 + $row_qtymti['QTY_20'];
								$mrt40 = $mrt40 + $row_qtymti['QTY_40'];
								$mrt45 = $mrt45 + $row_qtymti['QTY_45'];
													
							
							$vvd_sub_mrt = array(
													'vessel' => $row_vessel_mrt[VESSEL],
													'voyage' => $row_vessel_mrt[VOYAGE_IN] .'-'.$row_vessel_mrt[VOYAGE_OUT],
													'call_sign' => $row_vessel_mrt[CALL_SIGN],
													'operator_id' => $row_vessel_mrt[OPERATOR_ID],
													'operator_name' => $row_vessel_mrt[OPERATOR_NAME],
													'eta' => $row_vessel_mrt[ETA],
													'etd' => $row_vessel_mrt[ETD],
													'ata' => $row_vessel_mrt[ATA],
													'atd' => $row_vessel_mrt[ATD],
													'id_vsb_voyage' => $row_vessel_mrt[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_mrt[VSB_VOYP_PORT],
													'terminal' => '009',
													'qty_20' => $row_qtymti['QTY_20'],
													'qty_40' => $row_qtymti['QTY_40'],
													'qty_45' => $row_qtymti['QTY_45']
												);
							array_push($vvdmrt,$vvd_sub_mrt);
						
					} else {*/
					
						if ($row_vessel_mrt[TERMINAL] == 'T1'){
							$j = 2;
						} else if ($row_vessel_mrt[TERMINAL] == 'T2'){
							$j = 1;
						} else if ($row_vessel_mrt[TERMINAL] == 'T3') {
							$j = 0;
						} else if ($row_vessel_mrt[TERMINAL] == 'T3') {
							$j = 3;
						}
					//build "info" data
							$qContainer = "SELECT * FROM (
											SELECT COUNT (no_container) qty_20
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_mrt[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_mrt[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_mrt[VOYAGE_OUT]."'
												   AND size_cont = '20'
												   AND a.vessel_confirm is not null) q20,
											(SELECT COUNT (no_container) qty_40
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_mrt[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_mrt[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_mrt[VOYAGE_OUT]."'
												   AND size_cont = '40'
												   AND a.vessel_confirm is not null) q40,
											(SELECT COUNT (no_container) qty_45
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_mrt[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_mrt[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_mrt[VOYAGE_OUT]."'
												   AND size_cont = '45'
												   AND a.vessel_confirm is not null) q45";
							if(!checkOriSQL($conn['container'][$j],$qContainer,$getQty,$err,$debug)) goto Err;
							$row_qty = oci_fetch_array($getQty, OCI_ASSOC);
							$qty_20 = $row_qty["QTY_20"];
							$qty_40 = $row_qty["QTY_40"];
							$qty_45 = $row_qty["QTY_45"];
							
							$mrt20 = $mrt20 + $row_qty["QTY_20"];
							$mrt40 = $mrt40 + $row_qty["QTY_40"];
							$mrt45 = $mrt45 + $row_qty["QTY_45"];
							
							$vvd_sub_mrt = array(
													'vessel' => $row_vessel_mrt[VESSEL],
													'voyage' => $row_vessel_mrt[VOYAGE_IN] .'-'.$row_vessel_mrt[VOYAGE_OUT],
													'call_sign' => $row_vessel_mrt[CALL_SIGN],
													'operator_id' => $row_vessel_mrt[OPERATOR_ID],
													'operator_name' => $row_vessel_mrt[OPERATOR_NAME],
													'eta' => $row_vessel_mrt[ETA],
													'etd' => $row_vessel_mrt[ETD],
													'ata' => $row_vessel_mrt[ATA],
													'atd' => $row_vessel_mrt[ATD],
													'id_vsb_voyage' => $row_vessel_mrt[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_mrt[VSB_VOYP_PORT],
													'terminal' => $row_vessel_mrt[TERMINAL],
													'qty_20' => $qty_20,
													'qty_40' => $qty_40,
													'qty_45' => $qty_45
												);

							array_push($vvdmrt, $vvd_sub_mrt);
					//}
				}
				
				
				################################################ CTP ###########################################
						// CTP 
				if(!checkOriSQL($conn['ibis'],$qvvdctp,$getvvdctp,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_vessel_ctp = oci_fetch_array($getvvdctp, OCI_ASSOC))
				{
					/*if ($row_vessel_ctp[TERMINAL] == '009'){
							
							if($row_vessel_ctp[VOYAGE_IN] == ''){
								$filterin = " ";
							}
							else {
								$filterin = " AND TRIM(VOYAGE_IN) = '".$row_vessel_ctp[VOYAGE_IN]."'";
							}
							if($row_vessel_ctp[VOYAGE_OUT] == ''){
								$filterout = " ";
							}
							else{
								$filterout = " AND TRIM(VOYAGE_OUT) = '".$row_vessel_ctp[VOYAGE_OUT]."'";
							}
					
							$qqty = "select * from (
									select count(no_container) qty_20 from simpb.coarri_ptp where vessel = '".$row_vessel_ctp[VESSEL]."' $filterin $filterout 
									and e_i = 'E' and size_container ='20'),
									(select count(no_container) qty_40 from simpb.coarri_ptp where vessel = '".$row_vessel_ctp[VESSEL]."' $filterin $filterout 
									and e_i = 'E' and size_container= '40'),
									(select count(no_container) qty_45 from simpb.coarri_ptp where vessel = '".$row_vessel_ctp[VESSEL]."' $filterin $filterout 
									and e_i = 'E' and size_container not in ('20','40'))";
							
								if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qqty,$getQtyMTI,$err,$debug)) goto Err;
								$row_qtymti = oci_fetch_array($getQtyMTI, OCI_ASSOC);	

								$ctp20 = $ctp20 + $row_qtymti['QTY_20'];
								$ctp40 = $ctp40 + $row_qtymti['QTY_40'];
								$ctp45 = $ctp45 + $row_qtymti['QTY_45'];								
							
							$vvd_sub_ctp = array(
													'vessel' => $row_vessel_ctp[VESSEL],
													'voyage' => $row_vessel_ctp[VOYAGE_IN] .'-'.$row_vessel_ctp[VOYAGE_OUT],
													'call_sign' => $row_vessel_ctp[CALL_SIGN],
													'operator_id' => $row_vessel_ctp[OPERATOR_ID],
													'operator_name' => $row_vessel_ctp[OPERATOR_NAME],
													'eta' => $row_vessel_ctp[ETA],
													'etd' => $row_vessel_ctp[ETD],
													'ata' => $row_vessel_ctp[ATA],
													'atd' => $row_vessel_ctp[ATD],
													'id_vsb_voyage' => $row_vessel_ctp[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_ctp[VSB_VOYP_PORT],
													'terminal' => '009',
													'qty_20' => $row_qtymti['QTY_20'],
													'qty_40' => $row_qtymti['QTY_40'],
													'qty_45' => $row_qtymti['QTY_45']
												);
							array_push($vvdctp,$vvd_sub_ctp);
						
			
				} else {*/
					
						if ($row_vessel_ctp[TERMINAL] == 'T1'){
							$j = 2;
						} else if ($row_vessel_ctp[TERMINAL] == 'T2'){
							$j = 1;
						} else if ($row_vessel_ctp[TERMINAL] == 'T3') {
							$j = 0;
						} else if ($row_vessel_ctp[TERMINAL] == '009') {
							$j = 3;
						}
						
						$qContainer = "SELECT * FROM (
											SELECT COUNT (no_container) qty_20
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_ctp[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_ctp[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_ctp[VOYAGE_OUT]."'
												   AND size_cont = '20'
												   AND a.vessel_confirm is not null) q20,
											(SELECT COUNT (no_container) qty_40
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_ctp[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_ctp[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_ctp[VOYAGE_OUT]."'
												   AND size_cont = '40'
												   AND a.vessel_confirm is not null) q40,
											(SELECT COUNT (no_container) qty_45
											  FROM m_cyc_container a
											 WHERE     A.POD = 'IDSUB' AND A.FPOD = 'IDSUB'
												   AND a.vessel = '".$row_vessel_ctp[VESSEL]."'
												   AND a.voyage_in = '".$row_vessel_ctp[VOYAGE_IN]."'
												   AND a.voyage_out = '".$row_vessel_ctp[VOYAGE_OUT]."'
												   AND size_cont = '45'
												   AND a.vessel_confirm is not null) q45";
							if(!checkOriSQL($conn['container'][$j],$qContainer,$getQty,$err,$debug)) goto Err;
							$row_qty = oci_fetch_array($getQty, OCI_ASSOC);
							$qty_20 = $row_qty["QTY_20"];
							$qty_40 = $row_qty["QTY_40"];
							$qty_45 = $row_qty["QTY_45"];
							
							$ctp20 = $ctp20 + $row_qty["QTY_20"];
							$ctp40 = $ctp40 + $row_qty["QTY_40"];
							$ctp45 = $ctp45 + $row_qty["QTY_45"];
							
							$vvd_sub_ctp = array(
													'vessel' => $row_vessel_ctp[VESSEL],
													'voyage' => $row_vessel_ctp[VOYAGE_IN] .'-'.$row_vessel_ctp[VOYAGE_OUT],
													'call_sign' => $row_vessel_ctp[CALL_SIGN],
													'operator_id' => $row_vessel_ctp[OPERATOR_ID],
													'operator_name' => $row_vessel_ctp[OPERATOR_NAME],
													'eta' => $row_vessel_ctp[ETA],
													'etd' => $row_vessel_ctp[ETD],
													'ata' => $row_vessel_ctp[ATA],
													'atd' => $row_vessel_ctp[ATD],
													'id_vsb_voyage' => $row_vessel_ctp[ID_VSB_VOYAGE],
													'vsb_voyp_port' => $row_vessel_ctp[VSB_VOYP_PORT],
													'terminal' => $row_vessel_ctp[TERMINAL],
													'qty_20' => $qty_20,
													'qty_40' => $qty_40,
													'qty_45' => $qty_45
												);

							array_push($vvdctp, $vvd_sub_ctp);
						
				//}
			}
			
		$out_data = array();
		$data = array(
						"vesselspil" => $vvdspil,
						"vesseltms" => $vvdtms,
						"vesseltnt" => $vvdtnt,
						"vesselmrt" => $vvdmrt,
						"vesselctp" => $vvdctp,
						"ctp20" => $ctp20,
						"ctp40" => $ctp40,
						"ctp45" => $ctp45,
						"spil20" => $spil20,
						"spil40" => $spil40,
						"spil45" => $spil45,
						"tms20" => $tms20,
						"tms40" => $tms40,
						"tms45" => $tms45,
						"tnt20" => $tnt20,
						"tnt40" => $tnt40,
						"tnt45" => $tnt45,
						"mrt20" => $mrt20,
						"mrt40" => $mrt40,
						"mrt45" => $mrt45
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