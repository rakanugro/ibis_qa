<?php

/*|
 | Function Name 	: delDetailContainerBM
 | Description 		: Delete Detail Container BM
 | Creator			: 
 | Creation Date	: Frenda
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function delDetailContainerBM($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$no_container	= $xml_data->data->detail->no_container;
		$id_req 		= $xml_data->data->detail->id_req;
		$port_code 		= $xml_data->data->detail->port;
		$terminal_code 	= $xml_data->data->detail->terminal;


		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		$bind_param=null;
		
		//get container info
		//PL/SQL

		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		
		if ($port_code=="IDJKT"&&$terminal_code=="T3I") 
		{
			$query_proc="begin
							proc_delete_cont('$no_container','$id_req','REC','$vessel_code', '$voyage', '$carrier', :v_response, :v_msg);
						end;";
			//return $query_proc;
			$bind_param = array(
				':v_response' => '',
				':v_msg' => ''
			);
		}
		else if($port_code=="IDJKT"&&($terminal_code=="T3D"||$terminal_code=="T2D"||$terminal_code=="T1D"||$terminal_code=="T009D"))
		{

			$query_proc="begin
							PROC_DELETE_CONT_BM_OL ('$no_container','$id_req', :v_response, :v_msg);
						end;";
			
			$bind_param = array(
				':v_response' => '', 
				':v_msg' => ''
			);
		}
		
		if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$bind_param)) goto Err;
		
		$out_data = array();
		//return $query_proc;
		if($bind_param[':v_msg']=='OK'){
			$out_data['info']="OK";
			
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