<?php

/*|
 | Function Name 	: getVVD
 | Description 		: Get Vessel Voyage Details
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getVVD2($in_param) {
	
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
		$vessel = array();
		$vesselsby = array();
		
		//select connection
		//$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
		//$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
		$conn['container'] = $conn['ori']['container_idjkt_t1d'];
		$conn['ibis'] = $conn['ori']['ibis'];
		
		//PL/SQL
		//if($polpod == 'JKTSBY'){
			$getVessel = "/* Formatted on 3/25/2015 12:09:37 PM (QP5 v5.163.1008.3004) */
						SELECT ID_JOINT_VESSEL,
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
						  where trunc(to_date(eta,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')
						  ORDER BY DATE_INSERT DESC";
									
			//$query_vessel = "";
		
		if(!checkOriSQL($conn['ibis'],$getVessel,$query_vessel,$err,$debug)) goto Err;

		// tabel SBY_VES_SCHEDULE tidak diperlukan lagi
		/*$getVessel1 = "SELECT ID_JOINT_VESSEL, VESSEL, VOYAGE_IN, 
					   VOYAGE_OUT, CALL_SIGN, OPERATOR_ID, 
					   OPERATOR_NAME, 
					   TO_CHAR(TO_DATE(ETA,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETA,
					   TO_CHAR(TO_DATE(ETD,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETD,
					   TO_CHAR(TO_DATE(ATA,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATA, 
					   TO_CHAR(TO_DATE(ATD,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATD,
					   TERMINALEDULE
					where trunc(TO_
					FROM SBY_VES_SCHDATE(ETA,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')";
		try{			
			if(!checkOriSQL($conn['ibis'],$getVessel1,$query_vessel1,$err,$debug)) goto Err;
		}catch(Exception $e) {
			$err = $e->getMessage();
			//goto Err;
		}
		*/
		//}
		//QUERY
		
		//FETCH QUERY
		while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
		{
			//build "info" data
			//$qjoint = "SELECT NVL(MAX(ID_SEQUENCE),0)+1 MAXID FROM MST_SBY_JOINT_VESSEL WHERE CALL_SIGN ='".$row_vessel[CALL_SIGN]."' AND VOYAGE_IN = '".$row_vessel[VOYAGE_IN]."' AND VOYAGE_OUT = '".$row_vessel[VOYAGE_OUT]."' ";
			
			//if(!checkOriSQL($conn['ibis'],$qjoint,$qjoint_,$err,$debug)) goto Err;
			//$rowjoint = oci_fetch_array($qjoint_, OCI_ASSOC);
			//if($rowjoint['MAXID'] == 1){
			//	$qinsjoint = "INSERT INTO MST_SBY_JOINT_VESSEL (ID_JOINT_VESSEL, VESSEL, CALL_SIGN, VOYAGE_IN, VOYAGE_OUT, POL, POD, TERMINAL, ID_SEQUENCE)
			//	VALUES('".$row_vessel[CALL_SIGN].$rowjoint[MAXID]."','".$row_vessel[VESSEL]."','".$row_vessel[CALL_SIGN]."','".$row_vessel[VOYAGE_IN]."'
			//	,'".$row_vessel[VOYAGE_OUT]."','IDJKT','IDSUB','".$row_vessel[TERMINAL]."','".$rowjoint[MAXID]."')";
			//	if(!checkOriSQL($conn['ibis'],$qjoint,$qjoint_,$err,$debug)) goto Err;
			//}
			$vessel_sub = array(
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
									'terminal' => $row_vessel[TERMINAL],
									'id_joint_vessel' => $row_vessel[ID_JOINT_VESSEL]
								);

			array_push($vessel, $vessel_sub);
		}
		
		// tabel SBY_VES_SCHEDULE tidak diperlukan lagi
		/*while ($row_vessel1 = oci_fetch_array($query_vessel1, OCI_ASSOC))
		{
			//build "info" data
			$vessel_sub1 = array(
									'id_joint_vessel' => $row_vessel1[ID_JOINT_VESSEL],
									'vessel' => $row_vessel1[VESSEL],
									'voyage_in' => $row_vessel1[VOYAGE_IN],
									'voyage_out' => $row_vessel1[VOYAGE_OUT],
									'call_sign' => $row_vessel1[CALL_SIGN],
									'operator_id' => $row_vessel1[OPERATOR_ID],
									'operator_name' => $row_vessel1[OPERATOR_NAME],
									'eta' => $row_vessel1[ETA],
									'etd' => $row_vessel1[ETD],
									'ata' => $row_vessel1[ATA],
									'atd' => $row_vessel1[ATD],
									'terminal' => $row_vessel1[TERMINAL]
								);

			array_push($vesselsby, $vessel_sub1);
		}
		
		
		//Terminal 009
		$getVessel = "SELECT vessel,
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
							 TO_DATE(ata, 'YYYYMMDDHH24MiSS') between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')";

			if(!checkOriSQL($conn['ori']['container_idjkt_009'],$getVessel,$query_vessel,$err,$debug)) goto Err;
			while($row_vessel = oci_fetch_array($query_vessel,OCI_ASSOC)){
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
										'terminal' => '009'
									);
				array_push($vessel,$vessel_temp);
		}
		*/

		$out_data = array();
		$data = array(
						"vessel" => $vessel,
						);
		//$out_data['vessel']=$vessel;
		//$out_data['vesselsby']=$vessel1;
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