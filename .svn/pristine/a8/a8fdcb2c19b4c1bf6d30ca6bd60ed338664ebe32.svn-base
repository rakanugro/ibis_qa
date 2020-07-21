<?php

/*|
 | Function Name 	: addDetailContainer
 | Description 		: Create a header for add Detail Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function addDetailContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$id_req=$xml_data->data->id_req;
		$id_ves_voyage=$xml_data->data->id_ves_voyage;
		$vessel=$xml_data->data->vessel;
		$vessel_code=$xml_data->data->vessel_code;
		$call_sign=$xml_data->data->call_sign;
		$voyage_in=$xml_data->data->voyage_in;
		$voyage_out=$xml_data->data->voyage_out;
		$no_container=$xml_data->data->no_container;
		$size_cont=$xml_data->data->size_cont;
		$type_cont=$xml_data->data->type_cont;
		$status_cont=$xml_data->data->status_cont;
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
		$bind_param=null;
		
		
		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		
		//entry ke billing nbs
		if (($port_code=="IDJKT"&&$terminal_code=="T3I") OR ($port_code=="IDJKT"&&$terminal_code=="T009D"))
		{
			$query_proc="begin
							PROC_ADD_CONT_DELIVERY2(
							'$no_container', '$id_req', '$size_cont', '$type_cont', '$status_cont', 
							'$hz', '', '$imo_class', '$iso_code', '$height_cont', 
							'$vessel', '$carrier', '$temp', '$id_ves_voyage', '', 
							".($over_left+$over_right+0).", ".($over_front+$over_rear+0).", '$over_height', '$un_number', '$pod', 
							'$pol',  '', '',  :v_msg);
							end;";
			
			$bind_param = array(
				':v_msg' => ''
			);
			
			if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$debug,$bind_param)) goto Err;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$query_proc="begin
							PROC_ADD_CONT_DELIVERY2('$no_container', '$id_req', '$size_cont', '$type_cont', '$status_cont', '$hz', '', '$imo_class', '$iso_code', '$height_cont', '$vessel', '$carrier', '$temp', '$id_ves_voyage', '', ".($over_left+$over_right+0).", ".($over_front+$over_rear+0).", '$over_height', '$un_number', '$pod', '$pol',  '', '', '$delivery_type', :v_msg);
							end;";
			
			$bind_param = array(
				':v_msg' => ''
			);
			
			if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$debug,$bind_param)) goto Err;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$query_proc="begin
							PROC_ADD_CONT_DELIVERY2('$no_container', '$id_req', '$size_cont', '$type_cont', '$status_cont', '$hz', '', '$imo_class', '$iso_code', '$height_cont', '$vessel', '$carrier', '$temp', '$id_ves_voyage', '', ".($over_left+$over_right+0).", ".($over_front+$over_rear+0).", '$over_height', '$un_number', '$pod', '$pol',  '', '', '$delivery_type', :v_msg);
							end;";
			
			$bind_param = array(
				':v_msg' => ''
			);
			
			if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$debug,$bind_param)) goto Err;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$query_proc="begin
							PROC_ADD_CONT_DELIVERY2('$no_container', '$id_req', '$size_cont', '$type_cont', '$status_cont', '$hz', '', '$imo_class', '$iso_code', '$height_cont', '$vessel', '$carrier', '$temp', '$id_ves_voyage', '', ".($over_left+$over_right+0).", ".($over_front+$over_rear+0).", '$over_height', '$un_number', '$pod', '$pol',  '', '', '$delivery_type', :v_msg);
							end;";
			
			$bind_param = array(
				':v_msg' => ''
			);
			
			if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$debug,$bind_param)) goto Err;
		}
		else if($port_code=="IDPNK"&&$terminal_code=="TPK")
		{
			$query="Insert into REQ_DELIVERY_D
					   (NO_REQ_DEV, NO_CONTAINER, SIZE_CONT, TYPE_CONT, STATUS_CONT, HZ, NO_UKK, IMO_CLASS, ID_CONT, VESSEL, VOYAGE, VOYAGE_OUT, START_WORK, TGL_START_STACK, TGL_END_STACK, TGL_DELIVERY, PLUG_IN, PLUG_OUT, JML_SHIFT, ACTIVE, TL_FLAG)
					 Values
					   ('$id_req', '$no_container', '$size_cont', '$type_cont', '$status_cont', 
						'$hz', '$id_ves_voyage', $imo_class, '$id_cont', 
						'$vessel', '$voyage_in', '$voyage_out', TO_DATE('$date_discharge', 'dd-mm-yyyy hh24:mi'), TO_DATE('$date_discharge', 'dd-mm-yyyy hh24:mi'), TO_DATE('$date_delivery','dd-mm-yyyy'), 
						TO_DATE('$date_delivery','dd-mm-yyyy'), '', '', '0', 'Y', 'N')";		
			if(!checkOriSQL($conn['ori']['billing'],$query_proc,$getProc,$err,$debug,$bind_param)) goto Err;
		}
		
		$out_data = array();
		
		if($bind_param[':v_msg']=='OK'){
			$out_data['info']="OK";
		} else {
			$out_data['info']="Failed,".$bind_param[':v_msg'];
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