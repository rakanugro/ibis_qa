<?php

/*|
 | Function Name 	: getContainerStatusList
 | Description 		: Get Container Status List
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getContainerStatusList($in_param) {
	
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
		$id_joint_vessel = $xml_data->data->id_joint_vessel;
		$voyage_in = $xml_data->data->voyage_in;
		$voyage_out = $xml_data->data->voyage_out;
		$pol = $xml_data->data->pol;
		
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$vessel = array();
		
		//select connection
		//PL/SQL
		$getVessel = "SELECT ID_JOINT_VESSEL, VESSEL, VOYAGE_IN, VOYAGE_OUT, POL
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
									'id_joint_vessel' => $row_vessel[ID_JOINT_VESSEL]
								);

			array_push($vessel, $vessel_sub);
		}		

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