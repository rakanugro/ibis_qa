<?php

/*|
 | Function Name 	: getRequest
 | Description 		: Get All Request
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getStatusContainer($in_param) {

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

		$customer_id  = $xml_data->data->customer_id;  // customer id blm di define
		$jml_baris    = $xml_data->data->jml_baris;
		$no_container = $xml_data->data->container;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$status  	    = array();
		$out_data 	    = array();
		
		//get container info
		//PL/SQL
		
		//echo $no_container;
		$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
		$conn['container'][2] = $conn['ori']['container_idjkt_t3d'];			
		
		//PL/SQL
		for($j=0;$j<=2;$j++){
			for($i=0;$i<=$jml_baris;$i++){
				//$container = $xml_data->container[$i]->number;
				
				$cont = explode(',',$no_container);
				$container = $cont[$i];
				$getStatusContainer = " SELECT   a.NO_CONTAINER,
									   a.VESSEL,
									   a.VOYAGE_IN,
									   a.VOYAGE_OUT,
									   a.E_I,
									 TRIM (a.SIZE_CONT) AS SIZE_,
									 TRIM (a.TYPE_CONT) AS TYPE_,
									 TRIM (a.STATUS) AS STATUS,
									 NVL (TRIM (a.HZ), 'N') AS HZ,
									 a.WEIGHT AS BERAT,
									 TRIM (a.POD) AS POD,
									 TRIM (a.POL) AS POL,
									 CASE WHEN E_I = 'E' THEN TO_CHAR (TO_DATE (a.GATE_IN_DATE, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI')
										  WHEN E_I = 'I' THEN TO_CHAR (TO_DATE (a.GATE_OUT_DATE, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI')
									 END GATE_DATE,
									  TO_CHAR (TO_DATE (a.vessel_CONFIRM, 'YYYYMMDDHH24MISS'),
											  'DD-MM-YYYY HH24:MI')
										CONFIRM_DATE,
									CASE WHEN $j = 0 THEN 'T1' 
										 WHEN $j = 1 THEN 'T2'
										 ELSE 'T3'
									END TERMINAL_ID
									--'T2' TERMINAL_ID
								FROM    m_cyc_container a
							   WHERE (a.POD = 'IDSUB' OR a.POL = 'IDSUB')
							   AND a.NO_CONTAINER = '$container'
							ORDER BY a.NO_CONTAINER, a.VESSEL, a.VOYAGE_IN, a.VOYAGE_OUT DESC";

						//QUERY

						if(!checkOriSQL($conn['container'][$j],$getStatusContainer,$query_statuscontainer,$err,$debug)) goto Err;
						//FETCH QUERY
						while ($row_status = oci_fetch_array($query_statuscontainer, OCI_ASSOC))
						{
							//build "info" data
							$cont_status = array(
							  'no_cont' => $row_status[NO_CONTAINER],
							  'terminal_id'  => $row_status[TERMINAL_ID],
							  'vessel' => $row_status[VESSEL] .'/'.$row_status[VOYAGE_IN].'-'.$row_status[VOYAGE_OUT],
							  'ei' => $row_status[E_I],
							  'size' => $row_status[SIZE_] .'/'.  $row_status[TYPE_] .'/'.  $row_status[STATUS],
							  'podpol' => $row_status[POD].'/'.$row_status[POL],
							  'gate_date' => $row_status[GATE_DATE],
							  'confirm_date'  => $row_status[CONFIRM_DATE]
							);
							array_push($status, $cont_status);
						}
						
				}
		}
		
		$out_data = array();
		$out_data['status']=$status;
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