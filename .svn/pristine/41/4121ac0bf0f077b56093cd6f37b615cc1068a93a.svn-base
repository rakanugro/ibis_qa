<?php

/*|
 | Function Name 	: saveDetailReqRestitusi
 | Description 		: do Request Restitusi
 |*/
function saveDetailReqRestitusi($in_param) {

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
		$id_req = $xml_data->data->id_request;
		$allcont = $xml_data->data->alldetail;
		
		$allcont = base64_decode($allcont);
		
				
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		

		if($terminal=="T3")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];			
		}
		else if($terminal=="T2")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($terminal=="T1")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($terminal=="009")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}	
		
			$query = "DELETE REQ_RESTITUTION_D WHERE NO_CONTAINER NOT IN($allcont) AND ID_REQ = '$id_req'";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
			
			$q_upd = "UPDATE REQ_RESTITUTION_D SET AKTIF = 'Y' WHERE ID_REQ = '$id_req'";
			
			if(!checkOriSQL($conn['ori']['ibis'],$q_upd,$q_upd_,$err,$debug)) goto Err;

		//DATA
		

		$out_data = array();
		$out_data['info']='OK,-'.$id_req;
		
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