<?php

/*|
 | Function Name 	: getTugboatAuto
 | Description 		: Get Tugboat Autocomplete
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getTugboatAuto($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$filter = $xml_data->data->filter;
		$agent_id = $xml_data->data->agent_id;
		$branch_id = $xml_data->data->branch_id;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		$getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$sql = "select
				  mst_kapal.kd_kapal, mst_kapal.nm_kapal
			   from
				  mst_kapal_agen,
				  mst_kapal
			   where
				  mst_kapal.kd_kapal = mst_kapal_agen.kd_kapal and
				  mst_kapal_agen.status_kapal_agen=1 and
				  mst_kapal.jn_kapal='13' and
				  mst_kapal_agen.kd_agen='".$agent_id."' and
				  mst_kapal_agen.kd_cabang='".$branch_id."' and
				  mst_kapal.nm_kapal like upper('%".$filter."%')";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err)) goto Err;
		//FETCH QUERY
		while ($row = oci_fetch_array($query, OCI_ASSOC))
		{
			//build "info" data
			$data_sub = array(
								'KD_KAPAL' => $row[KD_KAPAL],
								'NM_KAPAL' => $row[NM_KAPAL]
							);

			array_push($getdata, $data_sub);
		}
		
		//OUTPUT
		$out_data = array();
		$out_data['getdata']=$getdata;		
		
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