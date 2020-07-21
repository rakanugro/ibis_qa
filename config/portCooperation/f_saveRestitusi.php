<?php

/*|
 | Function Name 	: saveHeaderRestitusi
 | Description 		: do Request Restitusi
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function saveRestitusi($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$id_joint_vessel = $xml_data->data->header->id_joint_vessel;
		$vessel = $xml_data->data->header->vessel;
		$voyage_in = $xml_data->data->header->voyage_in;
		$voyage_out = $xml_data->data->header->voyage_out;
		$terminal = $xml_data->data->header->terminal;
		$customer_id = $xml_data->data->header->customer;
		$customer_name = $xml_data->data->header->customer_name;
		$call_sign = $xml_data->data->header->call_sign;
		
		if($terminal=="T3")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];			
		}
		else if($terminal=="T2")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($terminal=="T1")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($terminal=="009")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}	
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$q2="ivan ganteng";
		
		//QUERY
		
		//FETCH QUERY
		//seharusnya ada validasi clossing time

		
			//generate no request
			$query = "BEGIN ef_get_request_number 
							(
								'RTTS',
								'OL',
								'',
								:out_message
							); END;";
							
			$bind_param = array(
									':out_message' => ''
								);

			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug,$bind_param)) goto Err;

			$request_no = $bind_param[':out_message'];

	//ibis		 
			$query = "insert into req_restitution_h 
			(ID_REQ, VESSEL, CALL_SIGN, VOYAGE_IN, VOYAGE_OUT, CUSTOMER_ID, CUSTOMER_NAME, ID_VES_VOY, DATE_REQUEST, ID_PORT, ID_TERMINAL, 
			 STATUS_REQ,ID_JOINT_VESSEL)
			values
			(TRIM('$request_no'), '$vessel','$call_sign','$voyage_in','$voyage_out','$customer_id','$customer_name','$id_ves_voy',SYSDATE,'$terminal','IDJKT','S','$id_joint_vessel')";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
		
			$string_exist="AND a.NO_CONTAINER NOT IN (";
			$query_exist="SELECT NO_CONTAINER
						   FROM    REQ_RESTITUTION_D C
								INNER JOIN
								   REQ_RESTITUTION_H D
								ON (C.ID_REQ = D.ID_REQ)
						  WHERE D.ID_JOINT_VESSEL = '$id_joint_vessel'";
					//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query_exist,$get_exist,$err,$debug)) goto Err;
			$cek = array();
			while ($row_exist = oci_fetch_array($get_exist, OCI_ASSOC))
			{
				$string_exist .= "'".$row_exist[NO_CONTAINER]."',";
				$cek = $row_exist[NO_CONTAINER];
			}
			$string_exist .=")";
			if(empty($cek)){
				$string_exist = "";
			}
	
		//detail container
		if($terminal=='009'){
			//gate
			$qCoco="SELECT TRIM(A.NO_CONTAINER) NO_CONTAINER, to_char(to_date(TRUCK_OUT_DATE,'rrrrmmddhh24miss'),'dd-mm-yyyy hh24:mi:ss') TRUCK_OUT_DATE, to_char(to_date(DISCHARGE_CONFIRM,'rrrrmmddhh24miss'),'dd-mm-yyyy hh24:mi:ss') DISCHARGE_CONFIRM
					  FROM    SBY_COARRI A
						   LEFT JOIN
							  SBY_CODECO B
						   ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL
							   AND A.NO_CONTAINER = B.NO_CONTAINER)
					 WHERE A.ID_JOINT_VESSEL = '$id_joint_vessel' AND A.NO_CONTAINER NOT IN (SELECT NO_CONTAINER
						   FROM    REQ_RESTITUTION_D C
								INNER JOIN
								   REQ_RESTITUTION_H D
								ON (C.ID_REQ = D.ID_REQ)
						  WHERE D.ID_JOINT_VESSEL = A.ID_JOINT_VESSEL) AND TRUCK_OUT_DATE IS NOT NULL";
			
			if(!checkOriSQL($conn['ori']['ibis'],$qCoco,$getCoco,$err,$debug)) goto Err;
			//FETCH QUERY
			$truck_out=array();
			$discharge=array();
			$container=array();
			$exist_cont = "";
			while ($row_coco = oci_fetch_array($getCoco, OCI_ASSOC))
			{
				$truck_out[$row_coco['NO_CONTAINER']]=$row_coco['TRUCK_OUT_DATE'];
				$discharge[$row_coco['NO_CONTAINER']]=$row_coco['DISCHARGE_CONFIRM'];
				$exist_cont .= "'".$row_coco['NO_CONTAINER']."',";
			}
			$exist_cont = substr($exist_cont,0,-1);
			if($exist_cont == ""){
				$filter_cont = "";
			}
			else {
				$filter_cont = " and trim(no_container) in($exist_cont)";
			}
			
			$conn['container'][0] = $conn['ori']['container_idjkt_009'];
			
			for($j=0;$j<count($conn['container']);$j++)
			{	
				
				//ambil codeco
				$truck_in_date = array();
				
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
				
				$qContainer = "select TRIM(no_container) NO_CONTAINER,to_char(to_date(TRUCK_IN_DATE,'rrrrmmddhh24miss'),'dd-mm-yyyy hh24:mi:ss') TRUCK_IN_DATE from SIMPB.CODECO_PTP WHERE VESSEL = '$vessel' $filterin $filterout AND FPOD = 'IDSBY'";
				//QUERY
				try {
					if(!checkOriSQL($conn['container'][$j],$qContainer,$getContainer,$err,$debug)) goto Err;
					//FETCH QUERY
					while ($row_container = oci_fetch_array($getContainer, OCI_ASSOC))
					{
						$truck_in_date[trim($row_container[NO_CONTAINER])]=$row_container[TRUCK_IN_DATE];
					}
				
				}
				catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
				}
				
				//added coarri
				$qContainer = "/* Formatted on 3/18/2015 9:08:12 AM (QP5 v5.163.1008.3004) */
								select trim(no_container) no_container,status,iso_code,imo,carrier,to_char(to_date(loading_confirm,'rrrrmmddhh24miss'),'dd-mm-yyyy hh24:mi:ss') loading_confirm, size_container from simpb.coarri_ptp
								 WHERE VESSEL = '$vessel' $filterin $filterout AND FPOD = 'IDSBY' $filter_cont";
									   
				//QUERY
				try {
					if(!checkOriSQL($conn['container'][$j],$qContainer,$getContainer,$err,$debug)) goto Err;
					//FETCH QUERY
					while ($row_container = oci_fetch_array($getContainer, OCI_ASSOC))
					{
						//build "info" data
						$container_sub = array(
												'no_container' => $row_container[NO_CONTAINER],
												'size' => $row_container[SIZE_CONTAINER],
												'status' => $row_container[STATUS],
												'iso_code' => $row_container[ISO_CODE],
												'imo' => $row_container[IMO],
												'carrier' => $row_container[CARRIER],
												'gate_in_date' => $truck_in_date[$row_container[NO_CONTAINER]],
												'load_date' => $row_container[LOADING_CONFIRM],
												'discharge_date' => $discharge[trim($row_container[NO_CONTAINER])],
												'gate_out_date' => $truck_out[trim($row_container[NO_CONTAINER])]
											);

						array_push($container, $container_sub);
						//if($truck_in_date[$row_container[NO_CONTAINER]] != '1' && $row_container[LOADING_CONFIRM] != '1' && $discharge[trim($row_container[NO_CONTAINER])] != '1' && $truck_out[trim($row_container[NO_CONTAINER])] != '1'){
							$q2="INSERT INTO REQ_RESTITUTION_D (ID_REQ,NO_CONTAINER,SIZE_,TYPE_,STATUS_,GATE_IN,LOAD_DATE,DISCH_DATE,GATE_OUT,AKTIF,CRANE_TYPE,PRICE) VALUES ('$request_no',TRIM('".$row_container[NO_CONTAINER]."'),'".$row_container[SIZE_CONTAINER]."','".$row_container[ISO_CODE]."','".$row_container[STATUS]."',to_date('".$truck_in_date[$row_container[NO_CONTAINER]]."','dd-mm-yyyy hh24:mi:ss'),to_date('".$row_container[LOADING_CONFIRM]."','dd-mm-yyyy hh24:mi:ss'),to_date('".$discharge[trim($row_container[NO_CONTAINER])]."','dd-mm-yyyy hh24:mi:ss'),to_date('".$truck_out[trim($row_container[NO_CONTAINER])]."','dd-mm-yyyy hh24:mi:ss'),'Y','CC009','500000')";
							
							if(!checkOriSQL($conn['ori']['ibis'],$q2,$get2,$err,$debug,$bind_param)) goto Err;
						//}
					}
				
				}
				catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
				}
				
			}
		} else {
			//gate
			$qCoco="SELECT TRIM(A.NO_CONTAINER) NO_CONTAINER, to_char(to_date(TRUCK_OUT_DATE,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') TRUCK_OUT_DATE, to_char(to_date(DISCHARGE_CONFIRM,'rrrrmmddhh24miss'),'dd/mm/yyyy hh24:mi:ss') DISCHARGE_CONFIRM
					  FROM   SBY_CODECO  A
						   LEFT JOIN
							  SBY_COARRI B
						   ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL
							   AND A.NO_CONTAINER = B.NO_CONTAINER)
					 WHERE A.ID_JOINT_VESSEL = '$id_joint_vessel' AND A.NO_CONTAINER NOT IN (SELECT NO_CONTAINER
						   FROM    REQ_RESTITUTION_D C
								INNER JOIN
								   REQ_RESTITUTION_H D
								ON (C.ID_REQ = D.ID_REQ)
						  WHERE D.ID_JOINT_VESSEL = A.ID_JOINT_VESSEL) AND TRUCK_OUT_DATE IS NOT NULL";
			
			if(!checkOriSQL($conn['ori']['ibis'],$qCoco,$getCoco,$err,$debug)) goto Err;
			//FETCH QUERY
			$truck_out=null;
			$discharge=null;
			$exist_cont = "";
			while ($row_coco = oci_fetch_array($getCoco, OCI_ASSOC))
			{
				$truck_out[$row_coco['NO_CONTAINER']]=$row_coco['TRUCK_OUT_DATE'];
				$discharge[$row_coco['NO_CONTAINER']]=$row_coco['DISCHARGE_CONFIRM'];
				$exist_cont .= "'".$row_coco['NO_CONTAINER']."',";
			}
			$exist_cont = substr($exist_cont,0,-1);
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
			
			
			for($j=0;$j<count($conn['container']);$j++)
			{	
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
										  VESSEL_CONFIRM,
										  CASE WHEN SUBSTR(c.ALAT,0,2) = 'QC' THEN 'CC'
												WHEN SUBSTR(c.ALAT,0,2) = 'HM' THEN 'HMC'
										  ELSE c.ALAT END ALAT
								  FROM ITOS_REPO.M_CYC_CONTAINER a, ITOS_REPO.BL_MASTER_ISO_CODE b, ITOS_REPO.M_STEVEDORING c
								 WHERE a.ISO_CODE = b.ISO_CODE(+)
										AND a.VESSEL = c.VESSEL AND a.VOYAGE_IN = c.VOYAGE_IN AND a.VOYAGE_OUT = c.VOYAGE_OUT AND a.NO_CONTAINER = c.NO_CONTAINER
										AND a.FPOD IN ('IDSUB')
									   AND a.E_I = 'E'
									   AND a.VESSEL = '$vessel'
									   AND a.VOYAGE_IN = '$voyage_in'
									   AND a.VOYAGE_OUT = '$voyage_out'
										 AND a.STATUS LIKE 'F%'
										 AND a.NO_CONTAINER IN($exist_cont)";
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
					if($row_container[GATE_IN_DATE] != '' && $truck_out[$row_container[NO_CONTAINER]]!=''){
					$q2="INSERT INTO REQ_RESTITUTION_D (ID_REQ,NO_CONTAINER,SIZE_,TYPE_,STATUS_,GATE_IN,LOAD_DATE,DISCH_DATE,GATE_OUT,AKTIF,CRANE_TYPE,PRICE) VALUES ('$request_no','".$row_container[NO_CONTAINER]."','".$row_container[SIZE_]."','".$row_container[ISO_CODE]."','".$row_container[STATUS]."',to_date('".$row_container[GATE_IN_DATE]."','dd-mm-yyyy hh24:mi:ss'),to_date('".$row_container[VESSEL_CONFIRM]."','dd-mm-yyyy hh24:mi:ss'),to_date('".$discharge[$row_container[NO_CONTAINER]]."','dd-mm-yyyy hh24:mi:ss'),to_date('".$truck_out[$row_container[NO_CONTAINER]]."','dd-mm-yyyy hh24:mi:ss'),'T','".$row_container[ALAT]."','500000')";
					
					if(!checkOriSQL($conn['ori']['ibis'],$q2,$get2,$err,$debug,$bind_param)) goto Err;
					}
				}
			}
		}

		//DATA
		$data = array(
						'request_no' =>  'OK,'.$request_no
					);

		$out_data = array();
		$out_data['data']=$data;
		
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