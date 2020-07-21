<?php

/*|
 | Function Name 	: saveDetailReqPerp
 | Description 		: Create a detail for  Delivery Extension
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function saveDetailReqPerp($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$alldetail 		= $xml_data->data->alldetail;
		$id_request 	= $xml_data->data->id_request;
		$old_request 	= $xml_data->data->old_request;
		$sppb			= $xml_data->data->sppb;
		$tglsppb		= $xml_data->data->tglsppb;
		$ndo			= $xml_data->data->ndo;
		$tgldo			= $xml_data->data->tgldo;
		$blnumb			= $xml_data->data->blnumb;
		$tgldelp		= $xml_data->data->tgldelp;
		$port_code		= $xml_data->data->port_code;
		$terminal_code	= $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL

		//select connection
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t009d'];			
		}
		
		
		$request_no="";
		
		$alldetail = base64_decode($alldetail);
		$createRequest = "INSERT INTO REQ_DELIVERY_D (
						ID_REQ,
						NO_CONTAINER,
						SIZE_CONT,
						TYPE_CONT,
						STATUS_CONT,
						HEIGHT_CONT,
						ID_CONT,
						HZ,
						IMO_CLASS,
						UN_NUMBER,
						ISO_CODE,
						TEMP,
						DISABLED,
						WEIGHT,
						CARRIER,
						OOG,
						OVER_LEFT,
						OVER_RIGHT,
						OVER_FRONT,
						OVER_REAR,
						OVER_HEIGHT)
						SELECT '$id_request',
						NO_CONTAINER,
						SIZE_CONT,
						TYPE_CONT,
						STATUS_CONT,
						HEIGHT_CONT,
						ID_CONT,
						HZ,
						IMO_CLASS,
						UN_NUMBER,
						ISO_CODE,
						TEMP,
						DISABLED,
						WEIGHT,
						CARRIER,
						OOG,
						OVER_LEFT,
						OVER_RIGHT,
						OVER_FRONT,
						OVER_REAR,
						OVER_HEIGHT
						FROM REQ_DELIVERY_D
						WHERE NO_CONTAINER IN(".$alldetail.") AND ID_REQ = '$old_request'";
		
		
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$createRequest,$query_request,$err)) goto Err;
		
		$getReqNum = "SELECT COUNT(DISTINCT NO_CONTAINER) JUM FROM REQ_DELIVERY_D WHERE ID_REQ LIKE '$id_request'";
	
		if(!checkOriSQL($conn['ori']['ibis'],$getReqNum,$queryReqNum,$err)) goto Err;
		
		//FETCH QUERY
		if ($rowReqNum = oci_fetch_array($queryReqNum, OCI_ASSOC))
		{
			$qty_cont=$rowReqNum["JUM"];
		}
		$updQty = "UPDATE REQ_DELIVERY_H SET QUANTITY = '$qty_cont' WHERE ID_REQ = '$id_request'";
		
		if(!checkOriSQL($conn['ori']['ibis'],$updQty,$queryUpdQty,$err)) goto Err;
		
		$q_getreq = "select * from req_delivery_h where id_req = '$old_request'";
		
		if(!checkOriSQL($conn['ori']['ibis'],$q_getreq,$querygetreq,$err)) goto Err;	
		
		if ($rowReqNum = oci_fetch_array($querygetreq, OCI_ASSOC))
		{
			$vessel=$rowReqNum["VESSEL"];
		}
		if($port_code=="IDJKT"&&$terminal_code=="ITOST"){
			$param_b_var= array(
								"v_reqol"=>"$id_request",
								"v_vessel"=>"$vessel",
								"v_sppb"=>"$sppb",						
								"v_tglsppb"=>"$tglsppb",						
								"v_ndo"=>"$ndo",						
								"v_tgldo"=>"$tgldo",
								"v_tgldelp"=>"$tgldelp",
								"v_no_req_old"=>"$old_request",
								"v_blnumb"=>"$blnumb", 
								"v_no_req"=>"",
								"v_req_ke"=>"",
								"v_msg"=>""						
								);	
			
			$query = "declare begin ESERV_PROC_CREATE_DELIVERY_PER(:v_reqol, :v_vessel, :v_sppb,:v_tglsppb,:v_ndo,:v_tgldo,:v_tgldelp,:v_no_req_old,:v_blnumb,:v_no_req,:v_req_ke,:v_msg); end;";
			
			if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query,$query_,$err,$param_b_var)) goto Err;	
			$request_no = $param_b_var[':v_msg'];
		}
		
		$out_data = array();
		$out_data['info']="OK,-$request_no";
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