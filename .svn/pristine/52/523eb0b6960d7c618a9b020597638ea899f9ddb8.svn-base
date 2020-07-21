<?php

/*|
 | Function Name 	: getCarrierContainer
 | Description 		: Get Carrier Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getCarrierContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$carrier = strtoupper($xml_data->data->carrier);
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$vessel = $xml_data->data->vessel;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$infos = array();
		//get container info
		//PL/SQL

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
		else if($port_code=="IDJKT"&&$terminal_code=="")
		{
			$conn['ori'] = oriDb();
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idjkt_t009d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="")
		{
			$conn['ori'] = oriDb();
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code==""&&$terminal_code=="")
		{
			$conn['ori'] = oriDb();
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idpnk_t3i'];
			$conn['container'][5] = $conn['ori']['container_idpnk_t009d'];	
		}
		
		$getCarr = "SELECT CDG_OPER_CODE AS CODE, CDG_OPER_NAME AS LINE_OPERATOR
				  FROM M_CDG_OPERATOR
				 WHERE (UPPER (CDG_OPER_CODE) LIKE '%$carrier%' OR UPPER(CDG_OPER_NAME) LIKE '%$carrier%')
				 AND CDG_OPER_CODE IN (SELECT VSB_VOYO_OPER 
											   FROM    M_VSB_VOYAGE_OPER A
													INNER JOIN
													   M_VSB_VOYAGE B
													ON (A.VSB_VOYO_VESSEL = B.VESSEL_CODE)
											  WHERE TRIM (UPPER (B.VESSEL)) = TRIM (UPPER ('$vessel')))";

		for($j=0;$j<count($conn['container']);$j++)
		{
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$getCarr,$queryCarr,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_container = oci_fetch_array($queryCarr, OCI_ASSOC))
			{
				//build "info" data
				$info = array(
										'code' => $row_container[CODE],
										'line_operator' => $row_container[LINE_OPERATOR]
							);
							
				array_push($infos, $info);
			}
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