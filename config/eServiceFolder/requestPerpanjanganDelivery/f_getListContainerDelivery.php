<?php

/*|
 | Function Name 	: getVesselVoyage
 | Description 		: Get Vessel Voyage
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getListContainerDelivery($in_param) {
	
	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		
		//return $in_param;
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		
		$norequest = $xml_data->data->norequest;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

        /*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
        
        //SELECT CONNECTION
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conns = $conn['ori']['billing'];
        
        // $conn['ori'] = oriDb("IDJKT_T1D");
		// $conns = $conn['ori']['billing_idjkt_t1d'];
        
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
        // get list container 
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
		
			$qListCont = "select a.no_container,
						a.size_cont,a.type_cont,
						a.status_cont,
						a.hz,a.kd_comodity,a.id_cont,a.isocode as ISO_CODE,
						'' as height,a.carrier,'' og,a.BOOKING_NO no_booking_ship 
						from req_delivery_d a where a.id_req = '$norequest'";
						
		} else {
		
			$qListCont = "select a.no_container,
						a.size_cont,a.type_cont,
						a.status_cont,
						a.hz,a.kd_comodity,a.id_cont,a.isocode as ISO_CODE,
						'' as height,a.carrier,'' og,a.BOOKING_NO no_booking_ship 
						from req_delivery_d a where a.no_req_dev = '$norequest'";
						
         }
        if(!checkOriSQL($conns,$qListCont,$query_listcont,$err)) goto Err;
        
        //FETCH QUERY
		$listcont = array();
        while ($row_listcont = oci_fetch_array($query_listcont, OCI_ASSOC))
        {
            //build "listcont" data
            $row_listcont_sub = array(
				'no_container' => $row_listcont[NO_CONTAINER],
				'size_cont' => $row_listcont[SIZE_CONT],
				'type_cont' => $row_listcont[TYPE_CONT],
				'status_cont' => $row_listcont[STATUS_CONT],
				'hz' => $row_listcont[HZ],
				'kd_comodity' => $row_listcont[KD_COMODITY],
				'id_cont' => $row_listcont[ID_CONT],
				'iso_code' => $row_listcont[ISO_CODE],
				'height' => $row_listcont[HEIGHT],
				'carrier' => $row_listcont[CARRIER],
				'og' => $row_listcont[OG],
				'no_booking_ship' => $row_listcont[NO_BOOKING_SHIP],
				'tl_flag' => $row_listcont[TL_FLAG]
            );

            array_push($listcont, $row_listcont_sub);
        }
		

		$out_data = array();
        $out_data['listcont']=$listcont;

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