<?php

/*|
 | Function Name 	: getContainerStatusList
 | Description 		: Get Container Status List
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getContainerStatusList($in_param) {
	
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

		$vessel_name = $xml_data->data->vessel_name;
		$id_joint_vessel = $xml_data->data->id_joint_vessel;
		$voyage_in = $xml_data->data->voyage_in;
		$voyage_out = $xml_data->data->voyage_out;
		$pol = $xml_data->data->pol;
		$terminal = $xml_data->data->terminal;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$container = array();
		
		if($pol=='IDJKT' && $terminal=='009'){
			//gate
			$qCoco="SELECT trim(A.NO_CONTAINER) no_container, to_char(to_date(TRUCK_OUT_DATE,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') TRUCK_OUT_DATE, to_char(to_date(DISCHARGE_CONFIRM,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') DISCHARGE_CONFIRM
					  FROM    SBY_CODECO A
						   LEFT JOIN
							  SBY_COARRI B
						   ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL
							   AND A.NO_CONTAINER = B.NO_CONTAINER)
					 WHERE A.ID_JOINT_VESSEL = '$id_joint_vessel'";
			
			if(!checkOriSQL($conn['ori']['ibis'],$qCoco,$getCoco,$err,$debug)) goto Err;
			//FETCH QUERY
			$truck_out=null;
			$discharge=null;
			while ($row_coco = oci_fetch_array($getCoco, OCI_ASSOC))
			{
				$truck_out[$row_coco['NO_CONTAINER']]=$row_coco['TRUCK_OUT_DATE'];
				$discharge[$row_coco['NO_CONTAINER']]=$row_coco['DISCHARGE_CONFIRM'];
			}
			
			
			$conn['container'][0] = $conn['ori']['container_idjkt_009'];
			
			if($voyage_in == ''){
				$filterin = " ";
			}
			else {
				$filterin = " AND VOYAGE_IN = '$voyage_in'";
			}
			if($voyage_out == ''){
				$filterout = " ";
			}
			else{
				$filterout = " AND VOYAGE_OUT = '$voyage_out'";
			}
			
			for($j=0;$j<count($conn['container']);$j++)
			{	
				/*$qContainer="SELECT NO_CONTAINER, STATUS, ISO_CODE, IMO, CARRIER, TO_CHAR (TO_DATE (GATE_IN_DATE, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI:SS') GATE_IN_DATE, TO_CHAR (TO_DATE (VESSEL_CONFIRM, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI:SS') VESSEL_CONFIRM  FROM M_CYC_CONTAINER WHERE POD='IDSUB' AND E_I='E' AND VESSEL='$vessel_name' AND VOYAGE_IN='$voyage_in' AND VOYAGE_OUT='$voyage_out'";
				*/
				
				//ambil codeco
				$truck_in_date = null;
				$qContainer1 = "select trim(no_container) no_container,to_char(to_date(TRUCK_IN_DATE,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') TRUCK_IN_DATE from SIMPB.CODECO_PTP WHERE VESSEL = '$vessel_name' $filterin $filterout AND FPOD = 'IDSBY'";
				//QUERY
				try {
					if(!checkOriSQL($conn['container'][$j],$qContainer1,$getContainer,$err,$debug)) goto Err;
					//FETCH QUERY
					while ($row_container = oci_fetch_array($getContainer, OCI_ASSOC))
					{
						$truck_in_date[$row_container[NO_CONTAINER]]=$row_container[TRUCK_IN_DATE];
					}
				
				}
				catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
				}
				
				//added coarri
				$qContainer = "/* Formatted on 3/18/2015 9:08:12 AM (QP5 v5.163.1008.3004) */
								select no_container,status,case when substr(iso_code,0,1) = '2' then 20 when substr(iso_code,0,1) = 4 then 40 else 45 end size_, iso_code,imo,carrier,to_char(to_date(loading_confirm,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') loading_confirm from simpb.coarri_ptp
								 WHERE VESSEL = '$vessel_name' $filterin $filterout AND FPOD = 'IDSBY' AND LOADING_CONFIRM IS NOT NULL AND STATUS LIKE 'F%'";
				//QUERY
				try {
					if(!checkOriSQL($conn['container'][$j],$qContainer,$getContainer,$err,$debug)) goto Err;
					//FETCH QUERY
					while ($row_container = oci_fetch_array($getContainer, OCI_ASSOC))
					{
						//build "info" data
						$container_sub = array(
												'no_container' => $row_container[NO_CONTAINER],
												'size' => $row_container[SIZE_],
												'status' => $row_container[STATUS],
												'iso_code' => $row_container[ISO_CODE],
												'imo' => $row_container[IMO],
												'carrier' => $row_container[CARRIER],
												'gate_in_date' => $truck_in_date[trim($row_container[NO_CONTAINER])],
												'load_date' => $row_container[LOADING_CONFIRM],
												'discharge_date' => $discharge[trim($row_container[NO_CONTAINER])],
												'gate_out_date' => $truck_out[trim($row_container[NO_CONTAINER])]
											);

						array_push($container, $container_sub);
					}
				
				}
				catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
				}
				
			}
		} else if($pol=='IDJKT'){
			//gate
			$qCoco="SELECT trim(A.NO_CONTAINER) no_container, to_char(to_date(TRUCK_OUT_DATE,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') TRUCK_OUT_DATE, to_char(to_date(DISCHARGE_CONFIRM,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') DISCHARGE_CONFIRM
					  FROM    SBY_CODECO A
						   LEFT JOIN
							  SBY_COARRI B
						   ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL
							   AND A.NO_CONTAINER = B.NO_CONTAINER)
					 WHERE A.ID_JOINT_VESSEL = '$id_joint_vessel'";
			
			if(!checkOriSQL($conn['ori']['ibis'],$qCoco,$getCoco,$err,$debug)) goto Err;
			//FETCH QUERY
			$truck_out=null;
			$discharge=null;
			while ($row_coco = oci_fetch_array($getCoco, OCI_ASSOC))
			{
				$truck_out[$row_coco['NO_CONTAINER']]=$row_coco['TRUCK_OUT_DATE'];
				$discharge[$row_coco['NO_CONTAINER']]=$row_coco['DISCHARGE_CONFIRM'];
			}
			
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
			
			
			for($j=0;$j<count($conn['container']);$j++)
			{	
				/*$qContainer="SELECT NO_CONTAINER, STATUS, ISO_CODE, IMO, CARRIER, TO_CHAR (TO_DATE (GATE_IN_DATE, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI:SS') GATE_IN_DATE, TO_CHAR (TO_DATE (VESSEL_CONFIRM, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI:SS') VESSEL_CONFIRM  FROM M_CYC_CONTAINER WHERE POD='IDSUB' AND E_I='E' AND VESSEL='$vessel_name' AND VOYAGE_IN='$voyage_in' AND VOYAGE_OUT='$voyage_out'";
				*/
				//added size by dama 18/03/2015
				$qContainer = "SELECT a.NO_CONTAINER,
									   b.SIZE_,
									   a.STATUS,
									   a.ISO_CODE,
									   a.IMO,
									   a.CARRIER,
									   TO_CHAR (TO_DATE (a.GATE_IN_DATE, 'YYYYMMDDHH24MISS'),
												'DD-MM-YYYY HH24:MI:SS')
										  GATE_IN_DATE,
									   TO_CHAR (TO_DATE (a.VESSEL_CONFIRM, 'YYYYMMDDHH24MISS'),
												'DD-MM-YYYY HH24:MI:SS')
										  VESSEL_CONFIRM
								  FROM ITOS_REPO.M_CYC_CONTAINER a, ITOS_REPO.BL_MASTER_ISO_CODE b
								 WHERE a.ISO_CODE = b.ISO_CODE(+)
										AND a.FPOD IN ('IDSUB')
									   AND a.E_I = 'E'
									   AND VESSEL = '$vessel_name'
									   AND VOYAGE_IN = '$voyage_in'
									   AND VOYAGE_OUT = '$voyage_out'
									   AND a.STATUS LIKE 'F%'";
				//QUERY
				if(!checkOriSQL($conn['container'][$j],$qContainer,$getContainer,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_container = oci_fetch_array($getContainer, OCI_ASSOC))
				{
					//build "info" data
					$container_sub = array(
											'no_container' => $row_container[NO_CONTAINER],
											'size' => $row_container[SIZE_],
											'status' => $row_container[STATUS],
											'iso_code' => $row_container[ISO_CODE],
											'imo' => $row_container[IMO],
											'carrier' => $row_container[CARRIER],
											'gate_in_date' => $row_container[GATE_IN_DATE],
											'load_date' => $row_container[VESSEL_CONFIRM],
											'discharge_date' => $discharge[$row_container[NO_CONTAINER]],
											'gate_out_date' => $truck_out[$row_container[NO_CONTAINER]]
										);

					array_push($container, $container_sub);
				}
			}
		

		} else {
			$qCoco="SELECT trim(A.NO_CONTAINER) no_container,  to_char(to_date(TRUCK_IN_DATE,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') TRUCK_IN_DATE, to_char(to_date(LOADING_CONFIRM,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') LOADING_CONFIRM
						  FROM    SBY_CODECO A
							   LEFT JOIN
								  SBY_COARRI B
							   ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL
								   AND A.NO_CONTAINER = B.NO_CONTAINER)
						 WHERE A.ID_JOINT_VESSEL = '$id_joint_vessel'";
			
			if(!checkOriSQL($conn['ori']['ibis'],$qCoco,$getCoco,$err,$debug)) goto Err;
			//FETCH QUERY
			$truck_in=null;
			$load=null;
			while ($row_coco = oci_fetch_array($getCoco, OCI_ASSOC))
			{
				$truck_in[$row_coco['NO_CONTAINER']]=$row_coco['TRUCK_IN_DATE'];
				$load[$row_coco['NO_CONTAINER']]=$row_coco['LOADING_CONFIRM'];
			}
			
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
			
			
			for($j=0;$j<count($conn['container']);$j++)
			{	
				$qContainer="SELECT NO_CONTAINER, STATUS, case when substr(iso_code,0,1) = '2' then 20 when substr(iso_code,0,1) = 4 then 40 else 45 end size_,ISO_CODE, IMO, CARRIER,  to_char(to_date(GATE_OUT_DATE,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') GATE_OUT_DATE, to_char(to_date(VESSEL_CONFIRM,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') VESSEL_CONFIRM FROM M_CYC_CONTAINER WHERE POL='IDSUB' AND E_I='I' AND VESSEL='$vessel_name' AND VOYAGE_IN='$voyage_in' AND VOYAGE_OUT='$voyage_out' AND STATUS LIKE 'F%'";
				//QUERY
				if(!checkOriSQL($conn['container'][$j],$qContainer,$getContainer,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_container = oci_fetch_array($getContainer, OCI_ASSOC))
				{
					//build "info" data
					$container_sub = array(
											'no_container' => $row_container[NO_CONTAINER],
											'size' => $row_container[SIZE_],
											'status' => $row_container[STATUS],
											'iso_code' => $row_container[ISO_CODE],
											'imo' => $row_container[IMO],
											'carrier' => $row_container[CARRIER],
											'gate_in_date' => $truck_in[$row_container[NO_CONTAINER]],
											'load_date' => $load[$row_container[NO_CONTAINER]],
											'gate_out_date' => $row_container[GATE_OUT_DATE],
											'discharge_date' => $row_container[VESSEL_CONFIRM]
										);

					array_push($container, $container_sub);
				}
			}
		
		}

		$out_data = array();
		$out_data['container']=$container;


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