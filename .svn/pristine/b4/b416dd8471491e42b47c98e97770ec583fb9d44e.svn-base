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
		$conn['ori'] = oriDb("IBIS");
		$conn['ori'] += oriDb("BILLING");
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
		$qOldDel = "select 
				l.request_id, l.biller_request_id, l.request_date, l.port_id, l.terminal_id, mt.terminal_name,
				l.status_req, l.vessel, l.voyage_in, l.voyage_out, l.additional_date, l.reject_notes 
			from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL)
			where l.customer_id = '$customer_id' and l.kode_modul = 'PTKM07' and status_REQ in ('','N','R') order by l.request_date desc";
	
		for($j=0;$j<count($conn['container']);$j++)
		{	
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$qOldDel,$query_olddel,$err)) goto Err;
			//FETCH QUERY
			while ($row_olddel = oci_fetch_array($query_olddel, OCI_ASSOC))
			{
				
				//build request data
				$port_code=$row_olddel[PORT_ID];
				$terminal_code=$row_olddel[TERMINAL_ID];
				$no_req=$row_olddel[BILLER_REQUEST_ID];
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
					$qx = "select count(1) as QTY from REQ_DELIVERY_D where id_req='$no_req'";
				} else {
					$qx = "select count(1) as QTY from REQ_DELIVERY_D where no_req_dev='$no_req'";
				}
				
				//return $qx;
				//QUERY
				if(!checkOriSQL($conn['billing'][0],$qx,$qx_out,$err)) goto Err; 
				while($row2 = oci_fetch_array($qx_out, OCI_ASSOC))
				{
					$qty=$row2[QTY];
				}
			
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
                    'qty' => $qty,
					'port_terminal' => $row_olddel[TERMINAL_NAME],
					'reject_notes' => $row_olddel[REJECT_NOTES]
                    //'id_port' => $row_olddel[PORT_ID],
                    //'id_terminal' => $row_olddel[TERMINAL_ID]
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