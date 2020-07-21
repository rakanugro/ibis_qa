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
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

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

		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		
		$getContlist = "SELECT NO_CONTAINER, JNS_CONTAINER,HZ, TO_CHAR(TGL_STACK,'dd/mm/rrrr') TGL_STACK,TO_CHAR(TGL_BERANGKAT,'dd/mm/rrrr') TGL_BERANGKAT FROM TB_BATALMUAT_D WHERE ID_BATALMUAT = '$norequest'";

		if(!checkOriSQL($conn['billing'][$j],$getContlist,$queryContlist,$err,$debug)) goto Err;
			//FETCH QUERY
		while ($row_container = oci_fetch_array($queryContlist, OCI_ASSOC))
			{
				//build "info" data
				$info = array(
										'no_container' => $row_container[NO_CONTAINER],
										'jns_cont' => $row_container[JNS_CONTAINER],
										'hz' => $row_container[HZ],
										'tgl_stack' => $row_container[TGL_STACK],
										'tgl_berangkat' => $row_container[TGL_BERANGKAT]
							);
							
				array_push($infos, $info);
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