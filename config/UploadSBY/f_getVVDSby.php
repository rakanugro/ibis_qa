<?php

/*|
 | Function Name 	: getVVD
 | Description 		: Get VVD Surabaya
 |*/
function getVVDSby($in_param) {

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
		$jml_baris    = $xml_data->body->jml_baris;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$schedule  	    = array();
		$out_data 	    = array();
		
		//get container info
		//PL/SQL
		
		//echo $no_container;
		$conn['container'][0] = $conn['ori']['ibis'];			
		
		//PL/SQL
		for($i=0;$i<=$jml_baris-1;$i++){
		
				$idjointves   = $xml_data->body->data[$i]->idjointvessel; 
				$vessel       = $xml_data->body->data[$i]->vessel;
				$voyin        = $xml_data->body->data[$i]->voyin; 
				$voyout       = $xml_data->body->data[$i]->voyout;
				$callsign     = $xml_data->body->data[$i]->callsign;
				$opid         = $xml_data->body->data[$i]->opid;
				$opname       = $xml_data->body->data[$i]->opname;
				$eta          = $xml_data->body->data[$i]->eta;
				$etb          = $xml_data->body->data[$i]->etb;
				$etd          = $xml_data->body->data[$i]->etd;
				$ata          = $xml_data->body->data[$i]->ata;
				$atb          = $xml_data->body->data[$i]->atb;
				$atd          = $xml_data->body->data[$i]->atd;
				$terminal     = $xml_data->body->data[$i]->terminal;
				
				$getvvd = "INSERT INTO SBY_VES_SCHEDULE (ID_JOINT_VESSEL,VESSEL,VOYAGE_IN,VOYAGE_OUT,CALL_SIGN,OPERATOR_ID,OPERATOR_NAME,ETA,ETB,ETD,ATA,ATB,ATD, INSERT_DATE, TERMINAL )
							VALUES ('$idjointves','$vessel','$voyin','$voyout','$callsign','$opid','$opname',TO_CHAR(TO_DATE('$eta','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$etb','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$etd','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$ata','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$atb','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$atd','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),SYSDATE,'$terminal')";
				
				$stid2 = oci_parse($conn['ori']['ibis'], $getvvd) or die ('Can not parse query');
				if (!oci_execute($stid2))
				{
				}
						
		}
		
		
	    	$getschedule = "SELECT ID_JOINT_VESSEL,VESSEL,VOYAGE_IN,VOYAGE_OUT,CALL_SIGN,OPERATOR_ID,OPERATOR_NAME,TO_CHAR(TO_DATE('$eta','rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETA,TO_CHAR(TO_DATE('$etb','rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETB,TO_CHAR(TO_DATE('$etd','rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETD,TO_CHAR(TO_DATE('$ata','rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATA,TO_CHAR(TO_DATE('$atb','rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATB,TO_CHAR(TO_DATE('$atd','rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATD, TO_CHAR(INSERT_DATE,'dd/mm/rrrr hh24:mi:ss') INSERT_DATE, TERMINAL
							FROM SBY_VES_SCHEDULE ORDER BY INSERT_DATE DESC";

			//QUERY

			if(!checkOriSQL($conn['ori']['ibis'],$getschedule,$query_schedule,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_schedule = oci_fetch_array($query_schedule, OCI_ASSOC))
			{
				//build "info" data
				$schedule_sub = array(
								'idjointves' => $row_schedule[ID_JOINT_VESSEL],
								'vessel' => $row_schedule[VESSEL],
								'voyage_in' => $row_schedule[VOYAGE_IN],	
								'voyage_out' => $row_schedule[VOYAGE_OUT],	
								'operator_name' => $row_schedule[OPERATOR_NAME],					
								'eta' => $row_schedule[ETA],	
								'etd' => $row_schedule[ETD],	
								'etb' => $row_schedule[ETB],	
								'ata' => $row_schedule[ATA],	
								'atd' => $row_schedule[ATD],	
								'atb' => $row_schedule[ATB],	
								'callsign' => $row_schedule[CALL_SIGN],		
								'opid' => $row_schedule[OPERATOR_ID],
								'insdate' => $row_schedule[INSERT_DATE],
								'terminal' => $row_schedule[TERMINAL]
							);
					array_push($schedule, $schedule_sub);
			}
						
		
		$out_data = array();
		$out_data['schedule']=$schedule;
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