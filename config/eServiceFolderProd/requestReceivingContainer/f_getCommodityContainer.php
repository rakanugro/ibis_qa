<?php

/*|
 | Function Name 	: getCommodityContainer
 | Description 		: Get Commodity Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getCommodityContainer($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		//$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$commodity = strtoupper($xml_data->data->commodity);
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("IBIS");
		$conn['billing'] = $conn['ori']['billing'];
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$infos = array();
		//get container info
		//PL/SQL
		
		$getComm = "select KD_COMMODITY, NM_COMMODITY from MASTER_COMMODITY WHERE UPPER(NM_COMMODITY) LIKE '$commodity%'";
		//QUERY
		if(!checkOriSQL($conn['billing'],$getComm,$queryComm,$err)) goto Err;
		//FETCH QUERY
		while ($row_container = oci_fetch_array($queryComm, OCI_ASSOC))
		{
			//build "info" data
			$info = array(
				'kd_commodity' => $row_container[KD_COMMODITY],
				'commodity' => $row_container[NM_COMMODITY]
			);

			array_push($infos, $info);
		}

		$out_data = array();
		$out_data['comm']=$infos;

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