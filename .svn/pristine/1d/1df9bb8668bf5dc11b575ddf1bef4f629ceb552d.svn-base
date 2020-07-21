<?php

/*|
 | Function Name 	: getListContainer
 | Description 		: Get List Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getListContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$norequest = strtoupper($xml_data->data->norequest);
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$infos = array();
		//get container info
		//PL/SQL

		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['billing'][0] = $conn['ori']['billing'];
		
		if (($port_code == 'IDJKT') && ($terminal_code == 'T009D')){
			$getContlist = "SELECT a.no_container,
									   a.size_cont,
									   a.type_cont,
									   a.status_cont,
									   a.hz,
									   a.kd_comodity,
									   a.id_cont,
									   a.iso_code,
									   a.height,
									   a.carrier,
									   a.og,
									   b.booking_numb no_booking_ship
								  FROM req_receiving_d a JOIN req_receiving_h b ON a.id_req = b.id_req
								 WHERE a.id_req = '$norequest'";
		} else {
			$getContlist = "SELECT a.no_container,
								   a.size_cont,
								   a.type_cont,
								   a.status_cont,
								   a.hz,
								   a.kd_comodity,
								   a.id_cont,
								   a.iso_code,
								   a.height,
								   a.carrier,
								   a.og,
								   b.booking_numb no_booking_ship
							  FROM req_receiving_d a JOIN req_receiving_h b ON a.no_req_anne = b.id_req
							 WHERE a.no_req_anne = '$norequest'";
		}
		
		for($j=0;$j<count($conn['billing']);$j++)
		{
			//QUERY
			if(!checkOriSQL($conn['billing'][$j],$getContlist,$queryContlist,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_container = oci_fetch_array($queryContlist, OCI_ASSOC))
			{
				//build "info" data
				$info = array(
										'no_container' => $row_container[NO_CONTAINER],
										'size_cont' => $row_container[SIZE_CONT],
										'type_cont' => $row_container[TYPE_CONT],
										'status_cont' => $row_container[STATUS_CONT],
										'hz' => $row_container[HZ],
										'kd_comodity' => $row_container[KD_COMODITY],
										'id_cont' => $row_container[ID_CONT],
										'iso_code' => $row_container[ISO_CODE],
										'height' => $row_container[HEIGHT],
										'carrier' => $row_container[CARRIER],
										'og' => $row_container[OG],
										'no_booking_ship' => $row_container[NO_BOOKING_SHIP],
										'tl_flag' => $row_container[TL_FLAG]
							);
							
				array_push($infos, $info);
			}
		}
		
			
		$out_data = array();
		$out_data['listcont']=$infos;

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