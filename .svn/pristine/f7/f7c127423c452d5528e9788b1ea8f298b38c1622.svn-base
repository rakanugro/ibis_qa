<?php

/*|
 | Function Name 	: get_vesselrestitution_req
 | Description 		: get_vesselrestitution_req
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function get_vesselrestitution_req($in_param) {
	
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
		
		$cust_id	  = $xml_data->data->cust_id;
		
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$vessel = array();
		$vesselsby = array();
		
		//select connection
		$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
		$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
		$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
		$conn['container009'] = $conn['ori']['container_idjkt_009'];
		$conn['ibis'] = $conn['ori']['ibis'];
		
			$getVesList = "SELECT distinct a.ID_JOINT_VESSEL, trim(a.vessel)||trim(a.voyage_in)||trim(a.voyage_out) inx_vessel, terminal, a.vessel, a.voyage_in, a.voyage_out, a.call_sign, a.terminal
							FROM MST_SBY_JOINT_VESSEL A
								 left JOIN
									SBY_CODECO B
								 ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL)
						   WHERE A.POL = 'IDJKT'
								 AND (b.TRUCK_OUT_DATE IS NOT NULL OR b.TRUCK_OUT_DATE = '')
								 AND A.KD_OPERATOR = '$cust_id'";
			
			if(!checkOriSQL($conn['ibis'],$getVesList,$getVesList_,$err,$debug)) goto Err;
			
			while ($row_veslist = oci_fetch_array($getVesList_, OCI_ASSOC))
			{
				$getCodecosby = "SELECT A.VESSEL,
								 A.VOYAGE_IN,
								 A.VOYAGE_OUT,
								 A.TERMINAL,
								 A.CALL_SIGN,
								 TRIM(B.NO_CONTAINER) NO_CONTAINER,
								 A.TERMINAL
							FROM    MST_SBY_JOINT_VESSEL A
								 INNER JOIN
									SBY_CODECO B
								 ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL)
						   WHERE A.POL = 'IDJKT'
								 AND B.NO_CONTAINER NOT IN
										(SELECT NO_CONTAINER
										   FROM    REQ_RESTITUTION_D C
												INNER JOIN
												   REQ_RESTITUTION_H D
												ON (C.ID_REQ = D.ID_REQ)
										  WHERE D.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL)
								 AND (TRUCK_OUT_DATE IS NOT NULL OR TRUCK_OUT_DATE = '') AND A.ID_JOINT_VESSEL = '".$row_veslist[ID_JOINT_VESSEL]."'";
				if(!checkOriSQL($conn['ibis'],$getCodecosby,$getCodecosby_,$err,$debug)) goto Err;
				$confilter = "";
				
				while ($row_cdc = oci_fetch_array($getCodecosby_, OCI_ASSOC))
				{
					$confilter .= "'".$row_cdc[NO_CONTAINER]."',";
				}
				$confilter = substr($confilter,0,-1);
				if($confilter == "") $confilter = "''";
				$qcontvalid = "SELECT count(a.NO_CONTAINER) JUM
							FROM ITOS_REPO.M_CYC_CONTAINER a
						   WHERE a.FPOD IN ('IDSUB')
						   AND a.E_I = 'E'
						   AND VESSEL||VOYAGE_IN||VOYAGE_OUT = '".$row_veslist[INX_VESSEL]."'
						   AND a.NO_CONTAINER IN($confilter) AND a.STATUS LIKE 'F%'";
						   
				if($row_veslist[TERMINAL] == 'T3'){
					if(!checkOriSQL($conn['container'][0],$qcontvalid,$qcontvalid_,$err,$debug)) goto Err;
				}
				else if($row_veslist[TERMINAL] == 'T2'){
					if(!checkOriSQL($conn['container'][1],$qcontvalid,$qcontvalid_,$err,$debug)) goto Err;
				}
				else if($row_veslist[TERMINAL] == 'T1'){
					if(!checkOriSQL($conn['container'][1],$qcontvalid,$qcontvalid_,$err,$debug)) goto Err;
				}
				else if($row_veslist[TERMINAL] == '009'){
					if($row_veslist[VOYAGE_IN] == ''){
						$filterin = " ";
					}
					else {
						$filterin = " AND TRIM(VOYAGE_IN) = '".$row_veslist[VOYAGE_IN]."'";
					}
					if($row_veslist[VOYAGE_OUT] == ''){
						$filterout = " ";
					}
					else{
						$filterout = " AND TRIM(VOYAGE_OUT) = '".$row_veslist[VOYAGE_OUT]."'";
					}
					$qcontvalid = "SELECT COUNT(no_container) JUM
					FROM simpb.coarri_ptp
					WHERE TRIM(CALL_SIGN) = TRIM('".$row_veslist[CALL_SIGN]."') $filterin $filterout AND NO_CONTAINER IN($confilter) AND LOADING_CONFIRM IS NOT NULL AND FPOD = 'IDSBY'
					";
					if(!checkOriSQL($conn['container009'],$qcontvalid,$qcontvalid_,$err,$debug)) goto Err;
				}
				
				$row_countval = oci_fetch_array($qcontvalid_, OCI_ASSOC);
				
				$vessel_sub = array(
									'id_joint_vessel' => $row_veslist[ID_JOINT_VESSEL],
									'vessel' => $row_veslist[VESSEL],
									'voyage_in' => $row_veslist[VOYAGE_IN],
									'voyage_out' => $row_veslist[VOYAGE_OUT],
									'cont_valid' => $row_countval[JUM],
									'terminal' => $row_veslist[TERMINAL],
									'call_sign' => $row_veslist[CALL_SIGN]
								);
				array_push($vessel,$vessel_sub);
			}
			
			
		


		$out_data = array();
		$data = array(
						"vessel" => $vessel
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