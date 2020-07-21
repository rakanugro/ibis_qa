<?php

/*|
 | Function Name 	: getListRequestDeliveryPerp
 | Description 		: Get List Request for main Page
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
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$biller_request_id = $xml_data->data->biller_request_id;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$oldrequest = array();
		

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
		
		if (($port_code=="IDJKT"&&$terminal_code=="T009D")){
			$qx = "select count(1) as QTY from REQ_DELIVERY_D where id_req='$biller_request_id'";
		} else {
			$qx = "select count(1) as QTY from REQ_DELIVERY_D where no_req_dev='$biller_request_id'";
		}
		
		//return $qx;
		//QUERY
		if(!checkOriSQL($conn['billing'][0],$qx,$qx_out,$err)) goto Err; 
		$row2 = oci_fetch_array($qx_out, OCI_ASSOC);
		$qty=$row2['QTY'];

		if($qty>0)
		{
			goto Success;
		}
		else
		{
			$err = "Container Quantity is 0";
			goto Err;
		}
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