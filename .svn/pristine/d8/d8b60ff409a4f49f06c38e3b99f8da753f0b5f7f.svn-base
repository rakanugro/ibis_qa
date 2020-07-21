<?php

/*|
 | Function Name 	: getRequestDelivery
 | Description 		: Get Request Delivery
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getRequestDeliveryHeader($in_param) {

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

		$customer_id = $xml_data->data->customer_id;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$request = array();
		$out_data 	= array();
		$def = "";
		
		//get billing info
		//PL/SQL
		$getRequest = "select REQUEST_ID, BILLER_REQUEST_ID, TO_CHAR(REQUEST_DATE,'dd-mm-yyyy hh24:mi') REQUEST_DATE, PORT_ID, 
								TERMINAL_ID, STATUS_REQ, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, ADDITIONAL_DATE, 
								VESSEL, VOYAGE_OUT, VOYAGE_OUT 
						from transaction_log where CUSTOMER_ID='$customer_id' and request_id like 'REQ%' order by REQUEST_ID desc";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$getRequest,$query_request,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_request = oci_fetch_array($query_request, OCI_ASSOC))
		{
			//build request data
			$port_code=$row_request[PORT_ID];
			$terminal_code=$row_request[TERMINAL_ID];
			$id_req_biller = $row_request[BILLER_REQUEST_ID];
			
			
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
				$getRequest2 = "select count(1) as QTY from req_delivery_d where ID_REQ='$id_req_biller'";
			} else {
				$getRequest2 = "select count(1) as QTY from req_delivery_d where NO_REQ_DEV='$id_req_biller'";
			}
			

			//QUERY
			if(!checkOriSQL($conn['billing'][0],$getRequest2,$query_request2,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_request2 = oci_fetch_array($query_request2, OCI_ASSOC))
			{	
				$qty=$row_request2[QTY];
			}
			
			//build "info" data
			$request_sub = array(
			  'id_req' => $row_request[REQUEST_ID],          
			  'date_request' => $row_request[REQUEST_DATE],			  
			  'date_delivery' => $row_request[ADDITIONAL_DATE],
			  'id_port' => $row_request[PORT_ID],       
			  'vessel' => $row_request[VESSEL],
			  'voyage_in' => $row_request[VOYAGE_IN],
			  'voyage_out' => $row_request[VOYAGE_OUT],
			  'quantity' => $qty,
			  'id_terminal' => $row_request[TERMINAL_ID],
			  'status' => $row_request[STATUS_REQ],
			);
			array_push($request, $request_sub);
			//$container=$getContainer;
		}
		
		
		$out_data = array();
		$out_data['request']=$request;
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