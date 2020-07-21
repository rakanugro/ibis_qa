<?php

/*|
 | Function Name 	: getCommodityContainer
 | Description 		: Get Commodity Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getCommodityContainer($in_param) {

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

		$commodity = strtoupper($xml_data->data->commodity);
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

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
			$conn['billing'][0] = $conn['ori']['billing_itos_to3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['billing'][0] = $conn['ori']['billing_itos_to1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];			
		}
		else if($port_code=="IDPNK"&&$terminal_code=="")
		{
			$conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_itost'];
			//$Try = 1212;
		}		
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t009d'];
			//$Try = 1212;
		}		
		
		$getComm = "select KD_COMMODITY, NM_COMMODITY from MASTER_COMMODITY WHERE UPPER(NM_COMMODITY) LIKE '$commodity%'";
			//QUERY
			if(!checkOriSQL($conn['billing'][0],$getComm,$queryComm,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_container = oci_fetch_array($queryComm, OCI_ASSOC))
			{
				//build "info" data
				$info = array(
										'kd_commodity' => $row_container[KD_COMMODITY],
										'commodity' => $row_container[NM_COMMODITY]
							);
							
				array_push($infos, $info);
			}
		
			
		$out_data = array();
		$out_data['comm']=$infos;

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