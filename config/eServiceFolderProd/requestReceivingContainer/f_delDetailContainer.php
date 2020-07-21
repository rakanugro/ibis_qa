<?php

/*|
 | Function Name 	: delDetailContainer
 | Description 		: Delete Detail Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function delDetailContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$id_req=$xml_data->data->id_req;
		$vessel_code=$xml_data->data->vessel_code;
		$voyage=str_replace("\\", "", $xml_data->data->voyage);
		$no_container=$xml_data->data->no_container;
		$user_id=$xml_data->data->user_id;
		
		if($status_cont='EMPTY'){
			$status_cont='MTY';
		} else {
			$status_cont='FCL';
		}
		$height_cont=$xml_data->data->height_cont;
		$id_cont='CONFD4'; //inject
		$hz=$xml_data->data->hz;
		$imo_class=$xml_data->data->imo_class;
		$un_number=$xml_data->data->un_number;
		$iso_code=$xml_data->data->iso_code;
		$temp=$xml_data->data->temp;
		$disabled=$xml_data->data->disabled;
		$weight=$xml_data->data->weight;
		$carrier=$xml_data->data->carrier;
		$oog=$xml_data->data->oog;
		$over_left=$xml_data->data->over_left;
		$over_right=$xml_data->data->over_right;
		$over_front=$xml_data->data->over_front;
		$over_rear=$xml_data->data->over_rear;
		$over_height=$xml_data->data->over_height;
		$date_discharge=$xml_data->data->date_discharge;
		$date_delivery=$xml_data->data->date_delivery;
		$delivery_type=$xml_data->data->delivery_type;
		$pod=$xml_data->data->pod;
		$pol=$xml_data->data->pol;

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
		
		if (($port_code=="IDJKT"&&$terminal_code=="T3I") OR ($port_code=="IDJKT"&&$terminal_code=="T009D")) 
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
		else if($port_code=="IDJKT"&&($terminal_code=="T3D"||$terminal_code=="T2D"||$terminal_code=="T1D"))
		{

			$query_proc="begin
							PROC_DELETE_CONT('$no_container','$id_req', 'REC',  '$vessel_code', '$voyage', '$carrier', '$user_id', '', :v_response, :v_msg);
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
			if ($port_code=="IDJKT"&&$terminal_code=="T009D"){
				$query_del="delete req_receiving_d where no_container='$no_container' AND ID_REQ = '$id_req'";
				if(!checkOriSQL($conn['ori']['billing'],$query_del,$query_delout,$err)) goto Err;
			} else {
				$query_del="delete req_receiving_d where no_container='$no_container' AND NO_REQ_ANNE = '$id_req'";
				if(!checkOriSQL($conn['ori']['billing'],$query_del,$query_delout,$err)) goto Err;
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