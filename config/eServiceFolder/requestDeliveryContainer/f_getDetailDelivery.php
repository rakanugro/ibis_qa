<?php

/*|
 | Function Name 	: getDetailContainer
 | Description 		: Get Detail Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDetailDelivery($in_param) {

	try {
		$container = array();
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$no_request = $xml_data->data->no_request;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);

		//SELECT PL/SQL
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$getContainer = "SELECT ID_REQ,
									NO_CONTAINER,
									SIZE_CONT,
									TYPE_CONT,
									STATUS_CONT,
									ID_CONT,
									HZ,
									IMO_CLASS,
									UNNUMBER UN_NUMBER,
									CARRIER
							FROM REQ_DELIVERY_D 
							WHERE ID_REQ = '$no_request'";
		
		} else {
			$getContainer = "SELECT NO_REQ_DEV ID_REQ,
									NO_CONTAINER,
									SIZE_CONT,
									TYPE_CONT,
									STATUS_CONT,
									ID_CONT,
									HZ,
									IMO_CLASS,
									UNNUMBER UN_NUMBER,
									CARRIER
							FROM REQ_DELIVERY_D 
							WHERE NO_REQ_DEV = '$no_request'";
		}
		//QUERY
		if(!checkOriSQL($conn['ori']['billing'],$getContainer,$query_container,$err)) goto Err;
		//FETCH QUERY
		while ($row_container = oci_fetch_array($query_container, OCI_ASSOC))
		{
			//get carrier data
			$getCarrier = "select carrier from m_cyc_container@dbint_link 
							where no_container = '".$row_container[NO_CONTAINER]."'  and 
							billing_request_id = '$no_request'";
							
			if(!checkOriSQL($conn['ori']['billing'],$getCarrier,$query_carrier,$err)) goto Err;
			$row_carrier = oci_fetch_array($query_carrier, OCI_ASSOC);
		
			//build "info" data
			$container_sub = array(
				'no_container' => $row_container[NO_CONTAINER],
				'size_cont' => $row_container[SIZE_CONT],	
				'type_cont' => $row_container[TYPE_CONT],	
				'status_cont' => $row_container[STATUS_CONT],	
				'height_cont' => $row_container[HEIGHT_CONT],	
				'id_cont' => $row_container[ID_CONT],	
				'hz' => $row_container[HZ],		
				'imo_class' => $row_container[IMO_CLASS],	
				'un_number' => $row_container[UN_NUMBER],	
				'carrier' => $row_carrier[CARRIER]
			);
			array_push($container, $container_sub);
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['container']=$container;
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