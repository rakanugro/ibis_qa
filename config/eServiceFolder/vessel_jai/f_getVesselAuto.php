<?php

/*|
 | Function Name 	: getVesselVoyage
 | Description 		: Get Vessel Voyage
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getVesselAuto($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$vessel_name = $xml_data->data->vessel_name;
		$agent_id = $xml_data->data->agent_id;
		$branch_id = $xml_data->data->branch_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get vessel info
		$vessel = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$getVessel = "SELECT
			  mst_kapal.KD_KAPAL, mst_kapal.NM_KAPAL, mst_kapal.JN_PELAYARAN, mst_kapal.KD_BENDERA, mst_bendera.NM_NEGARA, mst_kapal.KP_GRT, mst_kapal.KP_LOA, mst_kapal.JN_KAPAL
    	   FROM
			  mst_kapal_agen,
			  mst_kapal,
			  mst_cabang,
			  mst_bendera
		   WHERE
			  mst_kapal.KD_KAPAL = mst_kapal_agen.KD_KAPAL AND
			  mst_kapal.KD_BENDERA = mst_bendera.KD_BENDERA AND	
			  mst_kapal_agen.KD_CABANG = mst_cabang.KD_CABANG AND
			  mst_kapal_agen.status_kapal_agen=1 AND
			  mst_kapal_agen.KD_AGEN='".$agent_id."' AND
			  mst_kapal_agen.KD_CABANG='".$branch_id."' AND
			  mst_kapal.NM_KAPAL like upper('%$vessel_name%')";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getVessel,$query_vessel,$err)) goto Err;
		//FETCH QUERY
		while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
		{
			
			//build "info" data
			$vessel_sub = array(
									'NM_KAPAL' => $row_vessel[NM_KAPAL],
									'KD_KAPAL' => $row_vessel[KD_KAPAL],
									'KP_GRT' => $row_vessel[KP_GRT],
									'KD_BENDERA' => $row_vessel[KD_BENDERA],
									'NM_NEGARA' => $row_vessel[NM_NEGARA],
									'KP_LOA' => $row_vessel[KP_LOA],
									'JN_KAPAL' => $row_vessel[JN_KAPAL]
								);

			array_push($vessel, $vessel_sub);
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