<?php

/*|
 | Function Name 	: getVesselVoyage
 | Description 		: Get Vessel Voyage
 |*/
function getVesselVoyage($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$vessel_name = $xml_data->data->vessel_name;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$vessel = array();
		
		//select connection
		//PL/SQL
		$getVessel = "SELECT ID_JOINT_VESSEL, VESSEL, VOYAGE_IN, VOYAGE_OUT, POL, TERMINAL
						FROM MST_SBY_JOINT_VESSEL
					   WHERE VESSEL LIKE '%$vessel_name%' OR VOYAGE_IN LIKE '%$vessel_name%' OR VOYAGE_OUT LIKE '%$vessel_name%'
					ORDER BY ID_JOINT_VESSEL DESC";
	
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$getVessel,$query_vessel,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
		{
			//build "info" data
			$vessel_sub = array(
									'vessel_name' => $row_vessel[VESSEL],
									'voyage_in' => $row_vessel[VOYAGE_IN],
									'voyage_out' => $row_vessel[VOYAGE_OUT],
									'pol' => $row_vessel[POL],
									'id_joint_vessel' => $row_vessel[ID_JOINT_VESSEL],
									'terminal' => $row_vessel[TERMINAL]
								);

			array_push($vessel, $vessel_sub);
		}

		//Terminal 009
		/* $getVessel = "SELECT '009X' AS ID_JOINT_VESSEL, vessel VESSEL,
							 voyage_in VOYAGE_IN,
							 voyage_out VOYAGE_OUT,
							 'IDJKT' POL
						FROM SIMPB.VVD_PTP
					   WHERE   
							 (VESSEL LIKE '%$vessel_name%' OR VOYAGE_IN LIKE '%$vessel_name%' OR VOYAGE_OUT LIKE '%$vessel_name%') AND
							 TO_DATE(ata, 'YYYYMMDDHH24MiSS') between (SYSDATE-30) and SYSDATE";
		
		if(!checkOriSQL($conn['ori']['container_idjkt_009'],$getVessel,$query_vessel,$err,$debug)) goto Err;
			while($row_vessel = oci_fetch_array($query_vessel,OCI_ASSOC)){
				$vessel_temp = array(
										'vessel_name' => $row_vessel[VESSEL],
									'voyage_in' => $row_vessel[VOYAGE_IN],
									'voyage_out' => $row_vessel[VOYAGE_OUT],
									'pol' => $row_vessel[POL],
									'id_joint_vessel' => $row_vessel[ID_JOINT_VESSEL]
									);
				array_push($vessel,$vessel_temp);
		} */

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