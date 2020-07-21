<?php

/*|
 | Function Name 	: getRequestReceivingHeader
 | Description 		: get Request Receiving Header
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getRequestReceivingHeaderCompressed($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("IBIS");
		$conn['ori'] += oriDb("BILLING");
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$agent_id = $xml_data->data->agent_id;
		$request_no = $xml_data->data->request_no;
		$start_rownum = $xml_data->data->start_rownum;
		$end_rownum = $xml_data->data->end_rownum;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();

		//PL/SQL
		$query = "SELECT *
FROM (select 
			l.REQUEST_ID, l.REQUEST_DATE REQUEST_DATE, l.PORT_ID, l.TERMINAL_ID, mt.TERMINAL_NAME,
			l.STATUS_REQ, l.ADDITIONAL_FIELD3, l.ADDITIONAL_FIELD2,l.ADDITIONAL_DATE, 
			l.VESSEL ||' '||l.VOYAGE_IN||'-'||l.VOYAGE_OUT AS VESVOY, l.BILLER_REQUEST_ID, l.REJECT_NOTES 
		from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL)
		where l.CUSTOMER_ID='$agent_id' and l.kode_modul = 'PTKM00' and status_REQ in ('','N','R') order by l.REQUEST_ID desc) data_
WHERE rownum <= 100
ORDER BY rownum";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_request,$err)) goto Err; 
		//FETCH QUERY
		while($row = oci_fetch_array($query_request, OCI_ASSOC))
		{
			//build request data
			$port_code=$row[PORT_ID];
			$terminal_code=$row[TERMINAL_ID];
			$no_reqanne=$row[BILLER_REQUEST_ID];
			if($port_code=="IDJKT"&&$terminal_code=="T3I")
			{
				$conn['billing'] = $conn['ori']['billing_idjkt_t3i'];
			}
			else if($port_code=="IDJKT"&&$terminal_code=="T3D")
			{
				$conn['billing'] = $conn['ori']['billing_idjkt_t3d'];			
			}
			else if($port_code=="IDJKT"&&$terminal_code=="T2D")
			{
				$conn['billing'] = $conn['ori']['billing_idjkt_t2d'];
			}
			else if($port_code=="IDJKT"&&$terminal_code=="T1D")
			{
				$conn['billing'] = $conn['ori']['billing_idjkt_t1d'];
			}
			else if($port_code=="IDPNK"&&$terminal_code=="T3I")
			{
				$conn['billing'] = $conn['ori']['billing_idpnk_t3i'];
			}
			else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
			{
				$conn['billing'] = $conn['ori']['billing_idjkt_itost'];
			}
			else if($port_code=="IDJKT"&&$terminal_code=="T009D")
			{
				$conn['billing'] = $conn['ori']['billing_idjkt_t009d'];
			}
			
			if (($port_code=="IDJKT"&&$terminal_code=="T009D")){
				$qx = "select count(1) as QTY from req_receiving_d where id_req='$no_reqanne'";
			} else {
				$qx = "select count(1) as QTY from req_receiving_d where no_req_anne='$no_reqanne'";
			}
			
			//return $qx;
			//QUERY
			if(!checkOriSQL($conn['billing'],$qx,$qx_out,$err)) goto Err;
			$row2 = oci_fetch_array($qx_out, OCI_ASSOC);
			$qty=$row2[QTY];
			
			$request_sub = array(
				id_request => $row[REQUEST_ID],
				date_request => $row[REQUEST_DATE],
				terminal_name => $row[TERMINAL_NAME],
				id_port => $row[PORT_ID],
				id_terminal => $row[TERMINAL_ID],
				status => $row[STATUS_REQ],
				fpod => $row[ADDITIONAL_FIELD3],
				vessel => $row[VESVOY],
				reject_notes => $row[REJECT_NOTES],
				qty=>$qty
				
			);
			
			array_push($request, $request_sub);
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
