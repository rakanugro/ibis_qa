<?php

/*|
 | Function Name 	: getCustomerDetail
 | Description 		: Get Customer Detail
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getCustomerDetail($in_param) {

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
		$customer_name = $xml_data->data->customer_name;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$customer = array();
		
		//query part
		if($customer_id!="")
		{
			if($queryPart!="")
			{
				$queryPart .= " AND ";
			}
			
			$queryPart .= "customer_id='$customer_id'";
		}

		if($customer_name!="")
		{
			if($queryPart!="")
			{
				$queryPart .= " AND ";
			}

			$queryPart .= "name='$customer_name'";
		}

		if($queryPart!="")
		{
			$queryPart = " WHERE ".$queryPart;
		}

		//get customer
		//PL/SQL
		$getCustomer = "select customer_id, name, address, npwp, email, phone from mst_customer $queryPart";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$getCustomer,$query_customer,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_customer = oci_fetch_array($query_customer, OCI_ASSOC))
		{
			$service_list="";
			//PL/SQL
			$getService = "select service_code from customer_service_setup where customer_id='$row_customer[CUSTOMER_ID]'";
			//QUERY
			if(!checkOriSQL($conn['ori']['ibis'],$getService,$query_service,$err,$debug)) goto Err;
			//FETCH QUERY
			$service_list=array();
			while ($row_service = oci_fetch_array($query_service, OCI_ASSOC))
			{
				$service_list_sub = array (
												'service' => $row_service[SERVICE_CODE]
											);

				array_push($service_list, $service_list_sub);
			}

			//build data
			$customer_sub = array(
									'customer_id' => $row_customer[CUSTOMER_ID],
									'customer_name' => $row_customer[NAME],
									'address' => $row_customer[ADDRESS],
									'npwp' => $row_customer[NPWP],
									'email' => $row_customer[EMAIL],
									'phone' => $row_customer[PHONE],
									'service' => $service_list
						);
						
			array_push($customer, $customer_sub);
		}

		$out_data = array();
		$out_data['customer']=$customer;

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