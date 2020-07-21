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
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL

		$query_term = "SELECT TERMINAL_NAME FROM MST_TERMINAL WHERE PORT = '$port_code' AND TERMINAL = '$terminal_code' AND ACTIVE = 'Y'";
		if(!checkOriSQL($conn['ori']['ibis'] ,$query_term,$getterm,$err)) goto Err; 
		while($row2 = oci_fetch_array($getterm, OCI_ASSOC))
		{
				$term_name = $row2[TERMINAL_NAME];
				
		}

		if ($terminal_code == 'T009D'){
		
		$getRequest 		= "SELECT CASE WHEN b.JENIS = 'B' THEN 'CALBG'
										   WHEN b.JENIS = 'A' THEN 'CALAG'
										   WHEN b.JENIS = 'D' THEN 'CALDG'
									  END TIPEBM,
									   b.VESSEL,
									   b.VOYAGE_IN VOYAGE,
									   b.VOYAGE_OUT,
									   b.BOOKING_NUMB,
									   b.FPOD,
									   b.ID_FPOD,
									   (SELECT a.ID_VSB_VOYAGE FROM m_vsb_voyage@dbint_link a where a.vessel =b.vessel and a.voyage_in = b.voyage_in and a.voyage_out = b.voyage_out) NO_UKK,
									   b.SHIPPING_LINE,
									   b.ID_REQ ID_BATALMUAT,
									   b.NO_SRT_JLN,
									   b.NO_SPP,
									   CASE WHEN b.JENIS = 'D' THEN TO_DATE(b.TGL_BERANGKAT2,'dd/mm/rrrr') ELSE TO_DATE('','dd/mm/rrrr')  END  TGL_DEL
								  FROM req_batalmuat_h b where ID_REQ = '$request_id'";
		
		} else if ($terminal_code == 'T3I'){
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
									   (SELECT a.ID_VSB_VOYAGE FROM m_vsb_voyage@dbint_link a where a.vessel =b.vessel and a.voyage_in = b.voyage and a.voyage_out = b.voyage_out) NO_UKK,
									   SHIPPING_LINE,
									   ID_BATALMUAT,
									   '' NO_SRT_JLN,
									   '' NO_SPP,
									   CASE WHEN JENIS = 'D' THEN TO_DATE(TGL_BERANGKAT2,'dd/mm/rrrr') ELSE TO_DATE('','dd/mm/rrrr')  END  TGL_DEL
								  FROM tb_batalmuat_h b where id_batalmuat = '$request_id'";			
		}
		else {

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
									   ID_BATALMUAT,
									   '' NO_SRT_JLN,
									   '' NO_SPP,
									   CASE WHEN JENIS = 'D' THEN TO_DATE(TGL_BERANGKAT2,'dd/mm/rrrr') ELSE TO_DATE('','dd/mm/rrrr')  END  TGL_DEL
								  FROM tb_batalmuat_h where id_batalmuat = '$request_id'";

		}

		//return $getRequest;
		//START QUERY
		if(!checkOriSQL($conn['ori']['billing'],$getRequest,$query_request,$err)) goto Err;
		//FETCH QUERY
		while ($row_request = oci_fetch_array($query_request, OCI_ASSOC))
		{				
		
			
			$ukk = $row_request[NO_UKK];
			//return $ukk;
			if (($terminal_code == 'T3I') OR ($terminal_code == 'T009D')){	
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
			
			if(!checkOriSQL($conn['ori']['container'],$getvvd,$query_getvvd,$err)) goto Err;
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
			  'id_req' =>$row_request[ID_BATALMUAT],
			   'nosrtjln' =>$row_request[NO_SRT_JLN],
			    'nospp' =>$row_request[NO_SPP],
				 'tgldel' =>$row_request[TGL_DEL],
			   'term_name' =>$term_name
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