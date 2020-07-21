<?php

/*|
 | Function Name 	: getRequestBM
 | Description 		: Get Request BM
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getRequestBM($in_param) {
	try {		
	
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		
		
		$request = array();
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$request_id = $xml_data->data->request_id;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
	
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		$conn['ori'] += oriDb("CONTAINER_".$port_code."_".$terminal_code);
		if(!checkOriDb($conn['ori']['container'],$err)) goto Err;
		
		//SELECT PL/SQL

		$getRequest 		= "SELECT CASE WHEN JENIS = 'B' THEN 'CALBG'
										   WHEN JENIS = 'A' THEN 'CALAG'
										   WHEN JENIS = 'D' THEN 'CALDG'
									  END TIPEBM,
									   VESSEL,
									   VOYAGE,
									   VOYAGE_OUT,
									   BOOKING_NUMB,
									   FPOD,
									   ID_FPOD,
									   NO_UKK,
									   SHIPPING_LINE,
									   ID_BATALMUAT
								  FROM tb_batalmuat_h where id_batalmuat = '$request_id'";
								  
		

		//return $getRequest;
		//START QUERY
		if(!checkOriSQL($conn['ori']['billing'],$getRequest,$query_request,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_request = oci_fetch_array($query_request, OCI_ASSOC))
		{				
			$ukk = $row_request[NO_UKK];
			//return $ukk;
			if ($terminal_code == 'T3I'){	
				$getvvd = "/* Formatted on 9/15/2015 2:43:56 PM (QP5 v5.163.1008.3004) */
					SELECT TO_CHAR (TO_DATE (ETA, 'yyyymmddhh24miss'), 'dd/mm/yyyy hh24:mi:ss')
							  ETA,
						   TO_CHAR (TO_DATE (ETD, 'yyyymmddhh24miss'), 'dd/mm/yyyy hh24:mi:ss')
							  ETD
					  FROM M_VSB_VOYAGE
					  WHERE ID_VSB_VOYAGE = '$ukk'";
			} else {
				$getvvd = "/* Formatted on 9/15/2015 2:43:56 PM (QP5 v5.163.1008.3004) */
					SELECT TO_CHAR (TO_DATE (ETA, 'yyyymmddhh24miss'), 'dd/mm/yyyy hh24:mi:ss')
							  ETA,
						   TO_CHAR (TO_DATE (ETD, 'yyyymmddhh24miss'), 'dd/mm/yyyy hh24:mi:ss')
							  ETD
					  FROM M_VSB_VOYAGE
					  WHERE ID_VSB_VOYAGE = '$ukk'";
			}
			
			if(!checkOriSQL($conn['ori']['container'],$getvvd,$query_getvvd,$err,$debug)) goto Err;
			while ($row_vvd = oci_fetch_array($query_getvvd, OCI_ASSOC))
			{						
				$eta = $row_vvd['ETA'];
				$etd = $row_vvd['ETD'];
			}
			//return $eta;
			//build "info" data
			$request_sub = array(
			  'tipebm' => $row_request[TIPEBM],          
			  'vessel' => $row_request[VESSEL],      
			  'voyin' => $row_request[VOYAGE],   
			  'voyout' => $row_request[VOYAGE_OUT],       
			  'bookingnum' => $row_request[BOOKING_NUMB], 
			  'fpod' => $row_request[FPOD],        
			  'idfpod' => $row_request[ID_FPOD],   
			  'ukk' => $row_request[NO_UKK],
			  'shipping' => $row_request[SHIPPING_LINE],
			  'eta' => $eta,
			  'etd' => $etd,
			  'id_req' =>$row_request[ID_BATALMUAT]
			);
			array_push($request, $request_sub);
		}		
		
		//OUTPUT
		$out_data = array();
		$out_data['request']=$request;
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