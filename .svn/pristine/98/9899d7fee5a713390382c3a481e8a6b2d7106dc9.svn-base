<?php

/*|
 | Function Name 	: getRequestDelivery
 | Description 		: Get Request Delivery
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getCountContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input
		$xml_data = new SimpleXMLElement($in_param);
		//set input
		$biller_request_id = $xml_data->data->biller_request_id;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$request = array();
		$out_data 	= array();
		$def = "";
		
		//select connection
		$conn['ori'] = oriDb("BILLING");
		
		//select connection
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

		if ($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$getRequest2 = "select count(1) as QTY from req_delivery_d where ID_REQ='$biller_request_id'";
		} else {
			$getRequest2 = "select count(1) as QTY from req_delivery_d where NO_REQ_DEV='$biller_request_id'";
		}
		
		//QUERY
		if(checkOriSQL($conn['billing'][0],$getRequest2,$query_request2,$err)) //goto Err;
		//FETCH QUERY
		$row_request2 = oci_fetch_array($query_request2, OCI_ASSOC);
		$qty=$row_request2['QTY'];
		
		if($qty>0)
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