<?php

/*|
 | Function Name 	: saveHeaderRestitusi
 | Description 		: do Request Restitusi
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function saveHeaderRestitusi($in_param) {

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
		$vessel = $xml_data->data->header->vessel_name;
		$voyage_in = $xml_data->data->header->voyage_in;
		$voyage_out = $xml_data->data->header->voyage_out;
		$terminal = $xml_data->data->header->terminal;
		$customer_id = $xml_data->data->header->customer;
		$customer_name = $xml_data->data->header->customer_name;
		$call_sign = $xml_data->data->header->call_sign;
		$request_no = $xml_data->data->header->request_no;
		
				
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
		
		//QUERY
		
		//FETCH QUERY
		//seharusnya ada validasi clossing time

		
			//generate no request
			$query = "BEGIN ef_get_request_number 
							(
								'RTTS',
								'OL',
								'',
								:out_message
							); END;";
							
			$bind_param = array(
									':out_message' => ''
								);

			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug,$bind_param)) goto Err;

			$request_no = $bind_param[':out_message'];

	//ibis		 
			$query = "insert into req_restitution_h 
			(ID_REQ, VESSEL, CALL_SIGN, VOYAGE_IN, VOYAGE_OUT, CUSTOMER_ID, CUSTOMER_NAME, ID_VES_VOY, DATE_REQUEST, ID_PORT, ID_TERMINAL, 
			 STATUS_REQ)
			values
			(TRIM('$request_no'), '$vessel','$call_sign','$voyage_in','$voyage_out','$customer_id','$customer_name','$id_ves_voy',SYSDATE,'$terminal','IDJKT','S')";
			
			//QUERY //insert into table request
			if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
		

		//DATA
		$data = array(
						'request_no' => 'OK,'.$request_no
					);

		$out_data = array();
		$out_data['data']=$request_no;
		
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