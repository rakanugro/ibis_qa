<?php

/*|
 | Function Name 	: getListRequestDeliveryPerp
 | Description 		: Get List Request for main Page
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getListRequestDeliveryPerp($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$customer_id = $xml_data->data->customer_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$oldrequest = array();
		
		//select connection
		$conn['container'][0] = $conn['ori']['ibis'];
		
		//PL/SQL
		$qOldDel = "select request_id, request_date, port_id, terminal_id, status_req, vessel, voyage_in, voyage_out, additional_date
        from transaction_log 
        where customer_id = '$customer_id' and kode_modul = 'PTKM07' order by request_date desc";
	
		for($j=0;$j<count($conn['container']);$j++)
		{	
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$qOldDel,$query_olddel,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_olddel = oci_fetch_array($query_olddel, OCI_ASSOC))
			{
				//build "info" data
				$oldrequest_sub = array(
                    'id_req' => $row_olddel[REQUEST_ID],
                    //'old_req' => $row_olddel[OLD_REQ],
                    'date_request' => $row_olddel[REQUEST_DATE],
                    'date_delivery' => $row_olddel[ADDITIONAL_DATE],
                    'status' => $row_olddel[STATUS_REQ],
                    'vessel' => $row_olddel[VESSEL],
                    'voyage_in' => $row_olddel[VOYAGE_IN],
                    'voyage_out' => $row_olddel[VOYAGE_OUT],
                    'qty' => $row_olddel[QTY],
                    'id_port' => $row_olddel[PORT_ID],
                    'id_terminal' => $row_olddel[TERMINAL_ID]
                );

				array_push($oldrequest, $oldrequest_sub);
			}
		}

		$out_data = array();
		$out_data['list_req']=$oldrequest;

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