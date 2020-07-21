<?php

/*|
 | Function Name 	: getAutoPOD
 | Description 		: Get Auto POD
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getAutoPOD($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$pod = strtoupper($xml_data->data->pod);
		$vessel = $xml_data->data->vessel;
		$voyage_in = $xml_data->data->voyage_in;
		$voyage_out = $xml_data->data->voyage_out;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		$infos = array();
		//get container info
		//PL/SQL

		//select connection
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
		
		$getPOD = "SELECT CDG_PORT_CODE AS ID_PEL, CDG_PORT_NAME AS PELABUHAN, ' ' AS NAMA_NEG
					  FROM CDG_PORT
					 WHERE     (CDG_PORT_CODE LIKE '%$pod%' OR CDG_PORT_name LIKE '%$pod%')
						   AND CDG_PORT_CODE IN (SELECT VSB_VOYP_PORT
												   FROM    M_VSB_VOYAGE_PORT A
														INNER JOIN
														   M_VSB_VOYAGE B
														ON (A.VSB_VOYP_VESSEL = B.VESSEL_CODE AND A.VSB_VOYP_VOYAGE = B.VOYAGE)
												  WHERE TRIM (UPPER (B.VESSEL)) = TRIM (UPPER ('$vessel'))
														AND TRIM (UPPER (B.VOYAGE_IN)) = TRIM (UPPER ('$voyage_in'))
														AND TRIM (UPPER (B.VOYAGE_OUT)) = TRIM (UPPER ('$voyage_out')))";


		//QUERY
		if(!checkOriSQL($conn['ori']['container'],$getPOD,$queryPOD,$err)) goto Err;
		//FETCH QUERY
		while ($row_container = oci_fetch_array($queryPOD, OCI_ASSOC))
		{
			//return $row_container[PELABUHAN];
			//build "info" data
			$info = array(
									'nm_pelabuhan' => $row_container[PELABUHAN],
									'id_pelabuhan' => $row_container[ID_PEL]
						);
						
			array_push($infos, $info);
		}
		
			
		$out_data = array();
		$out_data['pod']=$infos;

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