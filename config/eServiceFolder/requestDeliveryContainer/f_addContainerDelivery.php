<?php

/*|
 | Function Name 	: getDetailContainer
 | Description 		: Get Detail Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDetailContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$no_container = $xml_data->data->no_container;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$vessel_code = $xml_data->data->vessel_code;
		$voyage_in = $xml_data->data->voyage_in;
		$voyage_out = $xml_data->data->voyage_out;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL

		//select connection
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);

		//PL/SQL
		$getContainer = "SELECT A.NO_CONTAINER,
							   A.SIZE_CONT,
							   A.TYPE_CONT,
							   A.STATUS STATUS_CONT,
							   CASE WHEN A.EXTRA_TOOLS = 'Y' THEN 'OOG' ELSE A.HEIGHT END
								  AS HEIGHT_CONT,
							   A.HZ,
							   A.IMO IMO_CLASS,
							   UN_NUMBER,
							   A.ISO_CODE,
							   A.REEFER_TEMP AS TEMP,
							   WEIGHT,
							   A.CARRIER,
							   A.EXTRA_TOOLS OOG,
							   OVER_LEFT,
							   OVER_RIGHT,
							   OVER_FRONT,
							   OVER_REAR,
							   OVER_HEIGHT
						  FROM M_CYC_CONTAINER A
						 WHERE     A.VOYAGE_IN = '$voyage_in'
							   AND A.VOYAGE_OUT = '$voyage_out'
							   AND A.E_I = 'I'
							   AND A.VESSEL_CODE = '$vessel_code'
							   AND A.NO_CONTAINER like '%$no_container%'
							   AND A.ACTIVE = 'Y'
							   AND (UPPER (A.CONT_LOCATION) = UPPER ('YARD')
									OR UPPER (A.CONT_LOCATION) = UPPER ('CHASSIS'))
							   AND (HOLD_STATUS <> 'Y' OR hold_status IS NULL)";

		//QUERY
		if(!checkOriSQL($conn['ori']['container'],$getContainer,$query_container,$err)) goto Err;
		//FETCH QUERY
		while ($row_container = oci_fetch_array($query_container, OCI_ASSOC))
		{
			//build "info" data
			$container_sub = array(
				'no_container' => $row_container[NO_CONTAINER],
				'size_cont' => $row_container[SIZE_CONT],	
				'type_cont' => $row_container[TYPE_CONT],	
				'status_cont' => $row_container[STATUS_CONT],	
				'height_cont' => $row_container[HEIGHT_CONT],	
				'id_cont' => $row_container[ID_CONT],	
				'hz' => $row_container[HZ],		
				'imo_class' => $row_container[IMO_CLASS],	
				'un_number' => $row_container[UN_NUMBER],	
				'iso_code' => $row_container[ISO_CODE],	
				'temp' => $row_container[TEMP],
				'weight' => $row_container[WEIGHT],		
				'carrier' => $row_container[CARRIER],		
				'oog' => $row_container[OOG],			
				'over_left' => $row_container[OVER_LEFT],	
				'over_right' => $row_container[OVER_RIGHT],	
				'over_front' => $row_container[OVER_FRONT],	
				'over_rear' => $row_container[OVER_REAR],	
				'over_height' => $row_container[OVER_HEIGHT]
			);
			array_push($container, $container_sub);
			//$container=$getContainer;
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