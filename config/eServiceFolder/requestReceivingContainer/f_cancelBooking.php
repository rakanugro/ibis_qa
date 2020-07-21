<?php

/*|
 | Function Name 	: delDetailContainer
 | Description 		: Delete Detail Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function cancelBooking($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		//return "test";
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$id_reqol=$xml_data->data->id_reqol;
		$id_req=$xml_data->data->id_req;
		$type_req=$xml_data->data->type_req;
		$reason=$xml_data->data->reason;
		$mekanisme=$xml_data->data->mekanisme;
		$user_id=$xml_data->data->user_id;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$bind_param=null;
		
		//get container info
		//PL/SQL

		//select connection
		//return "BILLING_".$port_code."_".$terminal_code;
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		
		if($port_code=="IDJKT"&&($terminal_code=="T3D"||$terminal_code=="T2D"||$terminal_code=="T1D"))
		{
			
			$query_proc="begin
							prc_cancel_booking('$id_reqol','$id_req', '$type_req', '$user_id','$reason', '$mekanisme', :v_out);
						end;";
			
			$bind_param = array(
				':v_out' => ''
			);
		}
		
		if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$bind_param)) goto Err;
		
		$out_data = array();
		//return $query_proc;
		if($bind_param[':v_out']=='Ok'){
			$out_data['info']="OK";
			$conn['ori'] = oriDb("IBIS");
			if ($port_code=="IDJKT"&&($terminal_code=="T3D"||$terminal_code=="T2D"||$terminal_code=="T1D")){
				$query_del="delete transaction_log where BILLER_REQUEST_ID = '$id_req'";
				if(!checkOriSQL($conn['ori']['ibis'],$query_del,$query_delout,$err)) goto Err;
			} 
		} else {
			$out_data['info']="NO";
		}
		//return generateResponse($out_data, $out_status, $out_message, "json");
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