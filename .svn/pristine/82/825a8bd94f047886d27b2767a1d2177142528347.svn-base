<?php

/*|
 | Function Name 	: getVesselSchedule
 | Description 		: Get All Vessel Schedule
 | Creator			: Endang Fiansyah
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getVesselSchedule($in_param) {

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

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$schedule = array();
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL

		//select connection
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code=="IDJKT")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDPNK")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code==""&&$terminal_code=="")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idpnk_t3i'];			
		}

		//PL/SQL
		$getSchedule = "SELECT * FROM (SELECT VESSEL,
						   VOYAGE_IN,
						   VOYAGE_OUT,
						   OPERATOR_NAME,
						   ETA ETA_1,
						   TO_CHAR (TO_DATE (ETA, 'yyyymmddhh24miss'), 'dd-mm-yyyy hh24:ss') ETA,
						   TO_CHAR (TO_DATE (ETD, 'yyyymmddhh24miss'), 'dd-mm-yyyy hh24:ss') ETD,
						   TO_CHAR (TO_DATE (OPEN_STACK, 'yyyymmddhh24miss'),
									'dd-mm-yyyy hh24:ss')
							  OPEN_STACK,
						   TO_CHAR (TO_DATE (CLOSSING_TIME, 'yyyymmddhh24miss'),
									'dd-mm-yyyy hh24:ss')
							  CLOSSING_TIME
					  FROM M_VSB_VOYAGE
					  WHERE TO_DATE (ETD, 'yyyymmddhh24miss') > sysdate-3
					  ORDER BY ETA ASC) WHERE ROWNUM <30 ORDER BY ETA_1 ASC
					  ";

		//QUERY
		for($j=0;$j<count($conn['container']);$j++)
		{
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$getSchedule,$query_schedule,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_schedule = oci_fetch_array($query_schedule, OCI_ASSOC))
			{
				$port="";
				$get_port= "SELECT CDG_PORT_NAME
				  FROM M_VSB_VOYAGE A
					   INNER JOIN M_VSB_VOYAGE_PORT B
						  ON (A.VESSEL_CODE = B.VSB_VOYP_VESSEL
							  AND A.VOYAGE = B.VSB_VOYP_VOYAGE)
					   INNER JOIN CDG_PORT C
						  ON (B.VSB_VOYP_PORT = C.CDG_PORT_CODE)
				 WHERE A.VESSEL = '".$row_schedule[VESSEL]."' AND A.VOYAGE_IN = '".$row_schedule[VOYAGE_IN]."' AND A.VOYAGE_OUT = '".$row_schedule[VOYAGE_OUT]."' AND CDG_PORT_CODE != 'IDJKT'";
				 
				if(!checkOriSQL($conn['container'][$j],$get_port,$query_port,$err,$debug)) goto Err;
				
				while ($row_port = oci_fetch_array($query_port, OCI_ASSOC))
				{
					$port=$port.$row_port[CDG_PORT_NAME]." &<br/>";
				}
				$port=trim($port, " &<br/>");
				
				//build "info" data
				$schedule_sub = array(
					'vessel' => $row_schedule[VESSEL],
					'voyage_in' => $row_schedule[VOYAGE_IN],	
					'voyage_out' => $row_schedule[VOYAGE_OUT],	
					'operator_name' => $row_schedule[OPERATOR_NAME],
					'port' => $port,					
					'eta' => $row_schedule[ETA],	
					'etd' => $row_schedule[ETD],	
					'open_stack' => $row_schedule[OPEN_STACK],		
					'clossing_time' => $row_schedule[CLOSSING_TIME]
				);
				array_push($schedule, $schedule_sub);
				//$container=$getSchedule;
			}
		}
		
		
		$out_data = array();
		$out_data['schedule']=$schedule;
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