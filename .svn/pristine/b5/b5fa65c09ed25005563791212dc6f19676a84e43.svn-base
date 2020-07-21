<?php

/*|
 | Function Name 	: getRequestDelivery
 | Description 		: Get Request Delivery
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getRequestDeliveryHeaderCompressed($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input
		$xml_data = new SimpleXMLElement($in_param);
		//set input
		$customer_id = $xml_data->data->customer_id;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$request = array();
		$out_data 	= array();
		$def = "";
		
		//select connection
		$conn['ori'] = oriDb("IBIS");
		$conn['ori'] += oriDb("BILLING");
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//get billing info
		//PL/SQL
		$getRequest = "SELECT *
FROM (select l.REQUEST_ID, l.BILLER_REQUEST_ID, l.REQUEST_DATE REQUEST_DATE, l.PORT_ID, 
				l.TERMINAL_ID, mt.TERMINAL_NAME, l.STATUS_REQ, l.ADDITIONAL_FIELD1, l.ADDITIONAL_FIELD2, l.ADDITIONAL_DATE, 
				l.VESSEL, l.VOYAGE_OUT, l.REJECT_NOTES  
			from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL) 
			where l.CUSTOMER_ID='$customer_id' and l.kode_modul = 'PTKM01' and status_REQ in ('','N','R') order by l.REQUEST_ID desc) data_
WHERE rownum <= 400 
ORDER BY rownum";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$getRequest,$query_request,$err)) goto Err;
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
			//@down management
			if(checkOriSQL($conn['billing'][0],$getRequest2,$query_request2,$err)){ //goto Err;
				//FETCH QUERY
				while ($row_request2 = oci_fetch_array($query_request2, OCI_ASSOC))
				{	
					$qty=$row_request2['QTY'];
				}
			} else {
					$qty='DB DOWN';
			}
			//@--end
			
			//build "info" data
			$request_sub = array(
			  'id_req' => $row_request[REQUEST_ID],          
			  'date_request' => $row_request[REQUEST_DATE],			  
			  'date_delivery' => $row_request[ADDITIONAL_DATE],
			  //'id_port' => $row_request[PORT_ID],       
			  'vessel' => $row_request[VESSEL],
			  'voyage_in' => $row_request[VOYAGE_IN],
			  'voyage_out' => $row_request[VOYAGE_OUT],
			  'quantity' => $qty,
			  'terminal_name' => $row_request[TERMINAL_NAME],
			  'status' => $row_request[STATUS_REQ],
			  'reject_notes' => $row_request[REJECT_NOTES]
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
		return generateResponse($out_data, $out_status, $out_message, "json","0");
}

?>