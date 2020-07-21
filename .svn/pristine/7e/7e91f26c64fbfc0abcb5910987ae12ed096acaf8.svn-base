<?php

/*|
 | Function Name 	: getVesselVoyage
 | Description 		: Get Vessel Voyage
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getVesselVoyage($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$vessel_name = $xml_data->data->vessel_name;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get vessel info
		$vessel = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="L2I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_l2'];			
		}	
		else if($port_code=="IDJKT"&&$terminal_code=="L2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_l2'];			
		}		
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t009d'];			
		}		
		
		
		//SELECT PL/SQL
		if($port_code=="IDJKT"&&$terminal_code=="L2I")
		{
			$getVessel = "SELECT VESSEL,
								 VOY_IN VOYAGE_IN,
								 VOY_OUT VOYAGE_OUT,
								 '' VOYAGE,
								 '' ETA,
								 '' ETD,
								 ATA,
								 ATD,
								 '' CALL_SIGN,
								 ID_VES_VOYAGE ID_VSB_VOYAGE,
								 '' VESSEL_CODE,
								 TO_CHAR (TO_DATE (nvl(VES_START_WORK,ATA), 'yyyymmddhh24miss'),
										  'dd-mm-yyyy hh24:mi')
									DATE_DISCHARGE
							FROM PLAN_REC_H
						   WHERE FLAG = 'O' AND (VESSEL LIKE '%$vessel_name%' OR VOY_IN LIKE '%$vessel_name%' OR VOY_OUT LIKE '%$vessel_name%')
						ORDER BY ATA DESC";				
		}
		else if($port_code=="IDJKT"&&$terminal_code=="L2D")
		{
			$getVessel = "SELECT VESSEL,
								 VOY_IN VOYAGE_IN,
								 VOY_OUT VOYAGE_OUT,
								 '' VOYAGE,
								 '' ETA,
								 '' ETD,
								 ATA,
								 ATD,
								 '' CALL_SIGN,
								 ID_VES_VOYAGE ID_VSB_VOYAGE,
								 '' VESSEL_CODE,
								 TO_CHAR (TO_DATE (nvl(VES_START_WORK,ATA), 'yyyymmddhh24miss'),
										  'dd-mm-yyyy hh24:mi')
									DATE_DISCHARGE
							FROM PLAN_REC_H
						   WHERE FLAG = 'I' AND (VESSEL LIKE '%$vessel_name%' OR VOY_IN LIKE '%$vessel_name%' OR VOY_OUT LIKE '%$vessel_name%')
						ORDER BY ATA DESC";			
		}
		else
		{
			$getVessel = "SELECT VESSEL,
								 VOYAGE_IN,
								 VOYAGE_OUT,
								 VOYAGE,
								 ETA,
								 ETD,
								 ATA,
								 ATD,
								 CALL_SIGN,
								 ID_VSB_VOYAGE,
								 VESSEL_CODE,
								 TO_CHAR (TO_DATE (START_WORK, 'yyyymmddhh24miss'),
										  'dd-mm-yyyy hh24:mi')
									DATE_DISCHARGE
							FROM M_VSB_VOYAGE
						   WHERE VESSEL LIKE '%$vessel_name%'
						ORDER BY ETA DESC";			
		}
	
		
		//LOOP CONNECTION
		for($j=0;$j<count($conn['container']);$j++)
		{
			//QUERY
			//return count($conn['container']).'-'.$j;
			if(!checkOriSQL($conn['container'][$j],$getVessel,$query_vessel,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
			{
				
				//build "info" data
				$vessel_sub = array(
										'vessel_name' => $row_vessel[VESSEL],
										'voyage' => $row_vessel[VOYAGE],
										'voyage_in' => $row_vessel[VOYAGE_IN],
										'voyage_out' => $row_vessel[VOYAGE_OUT],
										'eta' => $row_vessel[ETA],
										'etb' => $row_vessel[ETB],
										'etd' => $row_vessel[ETD],
										'ata' => $row_vessel[ATA],
										'atb' => $row_vessel[ATB],
										'atd' => $row_vessel[ATD],
										'id_vsb_voyage' => $row_vessel[ID_VSB_VOYAGE],
										'vessel_code' => $row_vessel[VESSEL_CODE],
										'call_sign' => $row_vessel[CALL_SIGN],
										'date_discharge' => $row_vessel[DATE_DISCHARGE]
									);

				array_push($vessel, $vessel_sub);
			}
		}

		//OUTPUT
		$out_data = array();
		$out_data['vessel']=$vessel;

		
		
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