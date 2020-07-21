<?php

/*|
 | Function Name 	: getVesselList
 | Description 		: Get Vessel List
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getVesselList($in_param) {
	
	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$vessel_name = strtoupper($xml_data->data->vessel_name);
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get vessel info
		$vessel = array();
		
		//select connection
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
			$conn['container'][0] = $conn['ori']['container_idjkt_t009d'];			
		}
		else if($port_code==""&&$terminal_code=="")
		{
			$conn['ori'] = oriDb("CONTAINER_IDJKT_T3I");
			$conn['ori'] += oriDb("CONTAINER_IDJKT_T009D");
			$conn['ori'] += oriDb("CONTAINER_IDJKT_T3D");
			$conn['ori'] += oriDb("CONTAINER_IDJKT_T2D");
			$conn['ori'] += oriDb("CONTAINER_IDJKT_T1D");
			$conn['ori'] += oriDb("CONTAINER_IDPNK_T3I");
			
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idpnk_t3i'];
			$conn['container'][5] = $conn['ori']['container_idjkt_t009d'];			
		}
		
		//PL/SQL
		$getVessel = "SELECT VESSEL, ID_VSB_VOYAGE, VOYAGE_IN, VOYAGE_OUT, 
							TO_CHAR(to_date(OPEN_STACK,'YYYYMMDDHH24MISS'), 'DD-MM-YYYY HH24:Mi') OPEN_STACK, 
							TO_CHAR(to_date(ETA,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:Mi') ETA, 
							TO_CHAR(to_date(START_WORK,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:Mi') START_WORK, CALL_SIGN,
							TO_CHAR(to_date(CLOSSING_TIME,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:Mi') CLOSING_TIME, 
							TO_CHAR(to_date(CLOSSING_TIME,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:Mi') CLOSING_TIME_DOC,
							TO_CHAR(to_date(ETD,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:Mi') ETD,
							TO_CHAR(to_date(FIRST_ETD,'YYYYMMDDHH24MISS'),'DD-MM-YYYY HH24:Mi') FIRST_ETD,
							OPERATOR_NAME,
							VOYAGE, VESSEL_CODE
								FROM M_VSB_VOYAGE WHERE UPPER(VESSEL) LIKE '%$vessel_name%' and ATD is null ORDER BY ETD DESC";
	
		for($j=0;$j<count($conn['container']);$j++)
		{	
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$getVessel,$query_vessel,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
			{
				//build "info" data
				$vessel_sub = array(
										'vessel_name' => $row_vessel[VESSEL],
										'voyage' => $row_vessel[VOYAGE],
										'voyage_in' => $row_vessel[VOYAGE_IN],
										'voyage_out' => $row_vessel[VOYAGE_OUT],
										'vessel_code' => $row_vessel[VESSEL_CODE],
										'call_sign' => $row_vessel[CALL_SIGN],
										'id_vsb_voyage' => $row_vessel[ID_VSB_VOYAGE], 
										'eta' => $row_vessel[ETA],
										'open_stack' => $row_vessel[OPEN_STACK],
										'clossing_time_doc' => $row_vessel[CLOSING_TIME_DOC],
										'eta' => $row_vessel[ETA],
										'etb' => $row_vessel[ETB],
										'etd' => $row_vessel[ETD],
										'ata' => $row_vessel[ATA],
										'atb' => $row_vessel[ATB],
										'atd' => $row_vessel[ATD],
										'opname' => $row_vessel[OPERATOR_NAME]
									);

				array_push($vessel, $vessel_sub);
			}
		}

		$out_data = array();
		$out_data['vessel']=$vessel;

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