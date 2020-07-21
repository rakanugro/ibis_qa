<?php

/*|
 | Function Name 	: getDashboardMonitoring
 | Description 		: Get Dashboard Monitoring
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDashboardMonitoring($in_param) {
	
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
		$vvd = array();
		
		//if($pol=='IDJKT'){
			//gate
			$qvvd="SELECT vessel,
						 voyage_in,
						 voyage_out,
						 call_sign,
						 operator_id,
						 operator_name,
						 to_char(to_date(eta,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') eta,
                         to_char(to_date(etd,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') etd,
                         to_char(to_date(ata,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ata,
                         to_char(to_date(atd,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') atd,
						 voyage,
						 id_vsb_voyage,
						 vsb_voyp_port
					FROM m_vsb_voyage a, m_vsb_voyage_port b
				   WHERE     a.voyage = b.vsb_voyp_voyage
						 AND a.vessel_code = b.vsb_voyp_vessel
						 AND vsb_voyp_port = 'IDSUB' AND
						 trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')";
			
			
			
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_009'];
			
			$terminal = 3;
			for($j=0;$j<count($conn['container']);$j++)
			{	
							
				//QUERY
				if(!checkOriSQL($conn['container'][$j],$qvvd,$getvvd,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_vessel = oci_fetch_array($getvvd, OCI_ASSOC))
				{
					//build "info" data
					$qContainer = "SELECT * FROM (
									SELECT COUNT (no_container) qty_20
									  FROM m_cyc_container a
									 WHERE     A.POD = 'IDSUB'
										   AND a.vessel = '".$row_vessel[VESSEL]."'
										   AND a.voyage_in = '".$row_vessel[VOYAGE_IN]."'
										   AND a.voyage_out = '".$row_vessel[VOYAGE_OUT]."'
										   AND size_cont = '20') q20,
									(SELECT COUNT (no_container) qty_40
									  FROM m_cyc_container a
									 WHERE     A.POD = 'IDSUB'
										   AND a.vessel = '".$row_vessel[VESSEL]."'
										   AND a.voyage_in = '".$row_vessel[VOYAGE_IN]."'
										   AND a.voyage_out = '".$row_vessel[VOYAGE_OUT]."'
										   AND size_cont = '40') q40,
									(SELECT COUNT (no_container) qty_45
									  FROM m_cyc_container a
									 WHERE     A.POD = 'IDSUB'
										   AND a.vessel = '".$row_vessel[VESSEL]."'
										   AND a.voyage_in = '".$row_vessel[VOYAGE_IN]."'
										   AND a.voyage_out = '".$row_vessel[VOYAGE_OUT]."'
										   AND size_cont = '45') q45";
					if(!checkOriSQL($conn['container'][$j],$qContainer,$getQty,$err,$debug)) goto Err;
					$row_qty = oci_fetch_array($getQty, OCI_ASSOC);
					$qty_20 = $row_qty["QTY_20"];
					$qty_40 = $row_qty["QTY_40"];
					$qty_45 = $row_qty["QTY_45"];
					$vvd_sub = array(
											'vessel' => $row_vessel[VESSEL],
											'voyage_in' => $row_vessel[VOYAGE_IN],
											'voyage_out' => $row_vessel[VOYAGE_OUT],
											'call_sign' => $row_vessel[CALL_SIGN],
											'operator_id' => $row_vessel[OPERATOR_ID],
											'operator_name' => $row_vessel[OPERATOR_NAME],
											'eta' => $row_vessel[ETA],
											'etd' => $row_vessel[ETD],
											'ata' => $row_vessel[ATA],
											'atd' => $row_vessel[ATD],
											'voyage' => $row_vessel[VOYAGE],
											'id_vsb_voyage' => $row_vessel[ID_VSB_VOYAGE],
											'vsb_voyp_port' => $row_vessel[VSB_VOYP_PORT],
											'terminal' => $terminal,
											'qty_20' => $qty_20,
											'qty_40' => $qty_40,
											'qty_45' => $qty_45
										);

					array_push($vvd, $vvd_sub);
				}
				$terminal--;
			}
			
			$qvvdmti = "SELECT vessel,
							 voyage_in,
							 voyage_out,
							 call_sign,
							 operator_id,
							 operator_name,
							to_char(to_date(eta,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') eta,
							to_char(to_date(etd,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') etd,
							to_char(to_date(ata,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ata,
							to_char(to_date(atd,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') atd,
							 '' voyage,
							 '' id_vsb_voyage,
							 '' vsb_voyp_port,
							 '009' terminal
						FROM SIMPB.VVD_PTP
					   WHERE   
							 TO_DATE(etd, 'YYYYMMDDHH24MiSS') between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')";
			if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qvvdmti,$query_vessel,$err,$debug)) goto Err;
			while($row_vessel = oci_fetch_array($query_vessel,OCI_ASSOC)){
			
				$qqty = "select * from (
						select count(no_container) qty_20 from simpb.coarri_ptp where vessel = '".$row_vessel[VESSEL]."' and voyage_in = '".$row_vessel[VOYAGE_IN]."'
						and e_i = 'E' and substr(iso_code,0,1) =2),
						(select count(no_container) qty_40 from simpb.coarri_ptp where vessel = '".$row_vessel[VESSEL]."' and voyage_in = '".$row_vessel[VOYAGE_IN]."'
						and e_i = 'E' and substr(iso_code,0,1)= 4),
						(select count(no_container) qty_45 from simpb.coarri_ptp where vessel = '".$row_vessel[VESSEL]."' and voyage_in = '".$row_vessel[VOYAGE_IN]."'
						and e_i = 'E' and substr(iso_code,0,1) not in (2,4))";
				
					if(!checkOriSQL($conn['ori']['container_idjkt_009'],$qqty,$getQtyMTI,$err,$debug)) goto Err;
					$row_qtymti = oci_fetch_array($getQtyMTI, OCI_ASSOC);				
				
				$vessel_temp = array(
										'vessel' => $row_vessel[VESSEL],
										'voyage_in' => $row_vessel[VOYAGE_IN],
										'voyage_out' => $row_vessel[VOYAGE_OUT],
										'call_sign' => $row_vessel[CALL_SIGN],
										'operator_id' => $row_vessel[OPERATOR_ID],
										'operator_name' => $row_vessel[OPERATOR_NAME],
										'eta' => $row_vessel[ETA],
										'etd' => $row_vessel[ETD],
										'ata' => $row_vessel[ATA],
										'atd' => $row_vessel[ATD],
										'voyage' => $row_vessel[VOYAGE],
										'id_vsb_voyage' => $row_vessel[ID_VSB_VOYAGE],
										'vsb_voyp_port' => $row_vessel[VSB_VOYP_PORT],
										'terminal' => '009',
										'qty_20' => $row_qtymti['QTY_20'],
										'qty_40' => $row_qtymti['QTY_40'],
										'qty_45' => $row_qtymti['QTY_45']
									);
				array_push($vvd,$vessel_temp);
			}

		//}

		$out_data = array();
		$out_data['vessel']=$vvd;

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