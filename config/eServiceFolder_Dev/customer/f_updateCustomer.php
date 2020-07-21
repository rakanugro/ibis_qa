<?php

/*|
 | Function Name 	: updateCustomer
 | Description 		: Update Customer
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function updateCustomer($in_param) {

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
		$setup = $xml_data->data->setup;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";

		//update customer setup
		//PL/SQL
		$deleteCustomerSetup = "delete from customer_service_setup where customer_id='$customer_id'";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$deleteCustomerSetup,$query_delete,$err,$debug)) goto Err;

		$setup = explode(',', $setup);
		
		foreach ($setup as $value)
		{
			//PL/SQL
			$insertSetup = "insert into customer_service_setup (customer_id,service_code) values ('$customer_id','$value')";
			
			//QUERY
			if(!checkOriSQL($conn['ori']['ibis'],$insertSetup,$query_insert,$err,$debug)) goto Err;
		}
		
		$out_data = array();

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