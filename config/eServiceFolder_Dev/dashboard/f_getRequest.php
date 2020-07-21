<?php

/*|
 | Function Name 	: getRequest
 | Description 		: Get All Request
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getRequest($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("IBIS");
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
		
		
		//PL/SQL
		$getRequest = "SELECT REQUEST_ID, VESSEL, VOYAGE_IN, VOYAGE_OUT, STATUS_REQ, REQUEST_DATE, PAYMENT_DATE,PORT_ID, TERMINAL_ID, PRF_NUMBER, TRX_NUMBER, MODUL_DESC FROM TRANSACTION_LOG WHERE CUSTOMER_ID='$customer_id' AND ROWNUM < 250";
		
		//return $getRequest;
			//QUERY
			if(!checkOriSQL($conn['ori']['ibis'],$getRequest,$query_request,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_request = oci_fetch_array($query_request, OCI_ASSOC))
			{
				//build "info" data
				$request_sub = array(
				  'id_req' => $row_request[REQUEST_ID],
 				  'vessel' => $row_request[VESSEL],
				  'voyage_in' => $row_request[VOYAGE_IN],
				  'voyage_out' => $row_request[VOYAGE_OUT],
				  'status' => $row_request[STATUS_REQ],
				  'date_request' => $row_request[REQUEST_DATE],
				  'date_paid' => $row_request[PAYMENT_DATE],
				  'id_port' => $row_request[PORT_ID],
				  'id_terminal'  => $row_request[TERMINAL_ID],
				  'id_proforma' => $row_request[PRF_NUMBER],
				  'id_nota'  => $row_request[TRX_NUMBER],
				  'jenis_nota'  => $row_request[MODUL_DESC]
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