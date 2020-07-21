<?php

/*|
 | Function Name 	: savePaymentConfirmation
 | Description 		: Save Payment Confirmation
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function savePaymentConfirmation($in_param) {

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

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$no_request=$xml_data->data->no_request;
		$id_proforma=$xml_data->data->id_proforma;
		$vessel = $xml_data->data->vessel;
		$voyage_in=$xml_data->data->voyage_in;
		$voyage_out=$xml_data->data->voyage_out;
		$via=$xml_data->data->via;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL
		$v_status="";
		$query_payment_nbs="select STATUS from req_delivery_h where ID_REQ='$no_request'";
		
		if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query_payment_nbs,$paymentNBS,$err)) goto Err;
		
		while ($row_payment = oci_fetch_array($paymentNBS, OCI_ASSOC))
		{
			$v_status=$row_payment[STATUS];
		}
			
		if($v_status=="P"){
			$query_save_payment="UPDATE REQ_DELIVERY_H SET STATUS='P' WHERE ID_REQ='$no_request'";
			if(!checkOriSQL($conn['ori']['ibis'],$query_save_payment,$save_payment,$err)) goto Err;
			
			$out_data = array();
			$out_data['info']="OK";
		} else {
			$out_data = array();
			$out_data['info']="Not yet paid";
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