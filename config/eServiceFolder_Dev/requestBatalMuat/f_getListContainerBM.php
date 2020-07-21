<?php

/*|
 | Function Name 	: getListContainer
 | Description 		: Get List Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getListContainerBM($in_param) {

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

		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		
		
		$getContlist = "SELECT NO_CONTAINER, JNS_CONT,HZ,ID_CONT, TO_CHAR(TGL_STACK,'dd/mm/rrrr') TGL_STACK,TO_CHAR(TGL_BERANGKAT,'dd/mm/rrrr') TGL_BERANGKAT FROM TB_BATALMUAT_D WHERE ID_BATALMUAT = '$norequest'";
		//return $getContlist;
		if(!checkOriSQL($conn['ori']['billing'],$getContlist,$queryContlist,$err,$debug)) goto Err;
			//FETCH QUERY
			
		while ($row_container = oci_fetch_array($queryContlist, OCI_ASSOC))
			{
				//build "info" data
				$jnscont = explode("-",$row_container[JNS_CONT]);
				$size	 = $jnscont[0];
				$type	 = $jnscont[1];
				$status	 = $jnscont[2];
				
				$info = array(
										'no_container' => $row_container[NO_CONTAINER],
										'size_cont' => $size,
										'type_cont' => $type,
										'status_cont' => $status,
										'id_cont' => $row_container[ID_CONT],
										'hz' => $row_container[HZ],
										'tgl_stack' => $row_container[TGL_STACK],
										'tgl_departure' => $row_container[TGL_BERANGKAT],
										'kd_comodity' => '',
										'iso_code' => '',
										'height' => '',
										'carrier' => '',
										'og' => '',
										'no_booking_ship' => '',
										'tl_flag' => ''
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