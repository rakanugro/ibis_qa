<?php

/*|
 | Function Name 	: getPortPODList
 | Description 		: Get POD List
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPortPODList($in_param) {
	
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

		$pel = strtoupper($xml_data->data->pod);
		$vessel = strtoupper($xml_data->data->vessel);
		$voy = strtoupper($xml_data->data->voyin);
		$voyo = strtoupper($xml_data->data->voyout);
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$pod = array();
		
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
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t009d'];			
		}
		else if($port_code=="IDJKT")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idjkt_t009d'];
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
			$conn['container'][5] = $conn['ori']['container_idjkt_t009d'];			
		}
		
		//PL/SQL
		$getPOD = "SELECT CDG_PORT_CODE AS ID_PEL, CDG_PORT_NAME AS PELABUHAN, 'INDONESIA' AS NAMA_NEG
  FROM CDG_PORT
 WHERE     (CDG_PORT_CODE LIKE '%$pel%' OR CDG_PORT_name LIKE '%$pel%')
       AND ROWNUM < 4
       AND CDG_PORT_CODE IN (SELECT VSB_VOYP_PORT
                               FROM    M_VSB_VOYAGE_PORT A
                                    INNER JOIN
                                       M_VSB_VOYAGE B
                                    ON (A.VSB_VOYP_VESSEL = B.VESSEL_CODE AND A.VSB_VOYP_VOYAGE = B.VOYAGE)
                              WHERE TRIM (UPPER (B.VESSEL)) = TRIM (UPPER ('$vessel'))
									AND TRIM (UPPER (B.VOYAGE_IN)) = TRIM (UPPER ('$voy'))
                                    AND TRIM (UPPER (B.VOYAGE_OUT)) = TRIM (UPPER ('$voyo'))
							  )";
	
		for($j=0;$j<count($conn['container']);$j++)
		{	
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$getPOD,$query_pod,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_pod = oci_fetch_array($query_pod, OCI_ASSOC))
			{
				//build "info" data
				$pod_sub = array(
										'pod' => $row_pod[ID_PEL],
										'pod_name' => $row_pod[PELABUHAN],
										'country_name' => $row_pod[NAMA_NEG]
									);

				array_push($pod, $pod_sub);
			}
		}

		$out_data = array();
		$out_data['pod']=$pod;
		$out_data['query']=base64_encode($getPOD);
		$out_data['port_code']=$port_code;
		$out_data['terminal_code']=$terminal_code;

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
