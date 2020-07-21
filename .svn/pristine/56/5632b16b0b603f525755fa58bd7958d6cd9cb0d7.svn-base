<?php

/*|
 | Function Name 	: cancelReceiving
 | Description 		: Cancel Request Receiving
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
 
function cancelReceiving($in_param) {

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

		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$id_req=$xml_data->data->id_req;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		$bind_param=null;
		
		//get container info
		//PL/SQL
		
		//delete di billing nbs
		if (($port_code=="IDJKT"&&$terminal_code=="T3I") OR ($port_code=="IDJKT"&&$terminal_code=="T009D"))
		{
			if ($terminal_code=="T3I"){
				$term = 'billing_idjkt_t3i';
			} else if ($terminal_code=="T009D"){
				$term = 'billing_idjkt_t009d';
			}
			//query select
			$query_select="SELECT no_container, vessel_code, voyage
							  FROM    req_receiving_d a
								   INNER JOIN
									  req_receiving_h b
								   ON (a.id_req = b.id_req)
							 WHERE a.id_req = '$id_req'";
			
			//QUERY
			if(!checkOriSQL($conn['ori'][$term],$query_select,$get_select,$err)) goto Err; 
			//FETCH QUERY
			while($row = oci_fetch_array($get_select, OCI_ASSOC))
			{
				//query delete detail
				$query_proc="begin
								PROC_DELETE_CONT ('".$row['NO_CONTAINER']."', '$id_req', 'REC', '".$row['VESSEL_CODE']."', '".$row['VOYAGE']."', '', '999', '', :v_response, :v_msg);
							end;";
				
				$bind_param = array(
					':v_response' => '',
					':v_msg' => ''
				);
				
				if(!checkOriSQL($conn['ori']['billing_idjkt_t3i'],$query_proc,$getProc,$err,$bind_param)) goto Err;
				
				if($bind_param[':v_msg']=='OK'){
					$query_proc="DELETE FROM req_receiving_d WHERE NO_CONTAINER = '".$row['NO_CONTAINER']."' AND NO_REQ_ANNE = '$id_req'";
					
					if(!checkOriSQL($conn['ori']['billing_idjkt_t3i'],$query_proc,$getProc,$err)) goto Err;
				}
			}
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			//query select
			$query_select="SELECT no_container, vessel_code, voyage
							  FROM    req_receiving_d a
								   INNER JOIN
									  req_receiving_h b
								   ON (a.id_req = b.id_req)
							 WHERE a.id_req = '$id_req'";
			
			//QUERY
			if(!checkOriSQL($conn['ori']['billing_idjkt_t3d'],$query_select,$get_select,$err)) goto Err; 
			//FETCH QUERY
			while($row = oci_fetch_array($get_select, OCI_ASSOC))
			{
				//query delete detail
				$query_proc="begin
								PROC_DELETE_CONT ('".$row['NO_CONTAINER']."', '$id_req', 'REC', '".$row['VESSEL_CODE']."', '".$row['VOYAGE']."', '', '999', '', :v_response, :v_msg);
							end;";
				
				$bind_param = array(
					':v_response' => '',
					':v_msg' => ''
				);
				
				if(!checkOriSQL($conn['ori']['billing_idjkt_t3d'],$query_proc,$getProc,$err,$bind_param)) goto Err;
				
				if($bind_param[':v_msg']=='OK'){
					$query_proc="DELETE FROM req_receiving_d WHERE NO_CONTAINER = '".$row['NO_CONTAINER']."' AND NO_REQ_ANNE = '$id_req'";
					
					if(!checkOriSQL($conn['ori']['billing_idjkt_t3d'],$query_proc,$getProc,$err)) goto Err;
				}
			}
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			//query select
			$query_select="SELECT no_container, vessel_code, voyage
							  FROM    req_receiving_d a
								   INNER JOIN
									  req_receiving_h b
								   ON (a.id_req = b.id_req)
							 WHERE a.id_req = '$id_req'";
			
			//QUERY
			if(!checkOriSQL($conn['ori']['billing_idjkt_t2d'],$query_select,$get_select,$err)) goto Err; 
			//FETCH QUERY
			while($row = oci_fetch_array($get_select, OCI_ASSOC))
			{
				//query delete detail
				$query_proc="begin
								PROC_DELETE_CONT ('".$row['NO_CONTAINER']."', '$id_req', 'REC', '".$row['VESSEL_CODE']."', '".$row['VOYAGE']."', '', '999', '', :v_response, :v_msg);
							end;";
				
				$bind_param = array(
					':v_response' => '',
					':v_msg' => ''
				);
				
				if(!checkOriSQL($conn['ori']['billing_idjkt_t2d'],$query_proc,$getProc,$err,$bind_param)) goto Err;
				
				if($bind_param[':v_msg']=='OK'){
					$query_proc="DELETE FROM req_receiving_d WHERE NO_CONTAINER = '".$row['NO_CONTAINER']."' AND NO_REQ_ANNE = '$id_req'";
					
					if(!checkOriSQL($conn['ori']['billing_idjkt_t2d'],$query_proc,$getProc,$err)) goto Err;
				}
			}
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			//query select
			$query_select="SELECT no_container, vessel_code, voyage
							  FROM    req_receiving_d a
								   INNER JOIN
									  req_receiving_h b
								   ON (a.id_req = b.id_req)
							 WHERE a.id_req = '$id_req'";
			
			//QUERY
			if(!checkOriSQL($conn['ori']['billing_idjkt_t1d'],$query_select,$get_select,$err)) goto Err; 
			//FETCH QUERY
			while($row = oci_fetch_array($get_select, OCI_ASSOC))
			{
				//query delete detail
				$query_proc="begin
								PROC_DELETE_CONT ('".$row['NO_CONTAINER']."', '$id_req', 'REC', '".$row['VESSEL_CODE']."', '".$row['VOYAGE']."', '', '999', '', :v_response, :v_msg);
							end;";
				
				$bind_param = array(
					':v_response' => '',
					':v_msg' => ''
				);
				
				if(!checkOriSQL($conn['ori']['billing_idjkt_t1d'],$query_proc,$getProc,$err,$bind_param)) goto Err;
				
				if($bind_param[':v_msg']=='OK'){
					$query_proc="DELETE FROM req_receiving_d WHERE NO_CONTAINER = '".$row['NO_CONTAINER']."' AND NO_REQ_ANNE = '$id_req'";
					
					if(!checkOriSQL($conn['ori']['billing_idjkt_t1d'],$query_proc,$getProc,$err)) goto Err;
				}
			}
		}
		else if($port_code=="IDPNK"&&$terminal_code=="TPK")
		{
			$query_proc="begin
							PROC_DELETE_CONT ('$no_container', '$id_req', 'REC', '$vessel_code', '$voyage', '', '$user_id', '', :v_response, :v_msg);
						end;";
			
			$bind_param = array(
				':v_response' => '',
				':v_msg' => ''
			);
			
			if(!checkOriSQL($conn['ori']['billing_idpnk_tpk'],$query_proc,$getProc,$err,$bind_param)) goto Err;
					
		}

		$out_data['info']="OK".$bind_param[':v_response'].$bind_param[':v_msg'];
			
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