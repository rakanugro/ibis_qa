<?php

/*|
 | Function Name 	: getListContainer
 | Description 		: Get List Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getCountContainer($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("BILLING");
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$biller_request_id = $xml_data->data->biller_request_id;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$infos = array();
		//get container info
		//PL/SQL

		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t3d'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_t009d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
		{
			$conn['billing'][0] = $conn['ori']['billing_idjkt_itost'];
			$conn['container'][0] = $conn['ori']['container_idjkt_itost'];			
		}
			
		
		if 	($terminal_code=="T009D"){
			$queryqty = "SELECT COUNT(1) JML FROM REQ_BATALMUAT_D WHERE ID_REQ = '$biller_request_id'";
		} else {
			$queryqty = "SELECT COUNT(1) JML FROM TB_BATALMUAT_D WHERE ID_BATALMUAT = '$biller_request_id'";
		}
		//return $getqty;
		if(!checkOriSQL($conn['billing'][0],$queryqty,$getqty,$err)) goto Err;
		$rowqty = oci_fetch_array($getqty, OCI_ASSOC);
		$jml=$rowqty["JML"];
			
		if($jml>0)
		{
			goto Success;
		}
		else
		{
			$err = "Container Quantity is 0";
			goto Err;
		}

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