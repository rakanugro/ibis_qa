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
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$vessel = array();
		
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
		$getVessel = "SELECT VESSEL, VOYAGE_IN, VOYAGE_OUT, ETA, ETD, ATA, ATD FROM M_VSB_VOYAGE WHERE VESSEL LIKE '%$vessel_name%'";
	
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
										'voyage_in' => $row_vessel[VOYAGE_IN],
										'voyage_out' => $row_vessel[VOYAGE_OUT],
										'eta' => $row_vessel[ETA],
										'etb' => $row_vessel[ETB],
										'etd' => $row_vessel[ETD],
										'ata' => $row_vessel[ATA],
										'atb' => $row_vessel[ATB],
										'atd' => $row_vessel[ATD]
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