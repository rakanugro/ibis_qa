<?php

/*|
 | Function Name 	: getDashboardMonitoring
 | Description 		: Get Dashboard Monitoring
 |*/
function updatevvd($in_param) {
	
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

		$polpod	  = $xml_data->data->polpod;
		$startDate = $xml_data->data->startDate;
		$endDate = $xml_data->data->endDate;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get vessel info
		$vvd = array();
		
		//if($pol=='IDJKT'){
			//gate
			$qvvd="SELECT vessel,
						 voyage_in,
						 voyage_out,
						 call_sign,
						 operator_id,
						 operator_name,
						 eta,
                         etd,
                         ata,
                         atd,
						 voyage,
						 id_vsb_voyage,
						 vsb_voyp_port
					FROM m_vsb_voyage a, m_vsb_voyage_port b
				   WHERE     a.voyage = b.vsb_voyp_voyage
						 AND a.vessel_code = b.vsb_voyp_vessel
						 AND vsb_voyp_port = 'IDSUB' AND
						 trunc(to_date(etd,'rrrrmmddhh24miss')) between to_date('$startDate','dd-mm-rrrr') and to_date('$endDate','dd-mm-rrrr')";
			
			
			
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t1d'];
			//$conn['container'][3] = $conn['ori']['container_idjkt_009'];
			
			$terminal = 3;
			for($j=0;$j<count($conn['container']);$j++)
			{	
				if(!checkOriSQL($conn['ibis'],$qvvd,$query_vessel,$err,$debug)) goto Err;
				while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
				{
					$qvvd = "UPDATE MST_SBY_JOINT_VESSEL SET ETA = '".$row_vessel[ETA]."',ETD = '".$row_vessel[ETD]."',RTA = '".$row_vessel[ATA]."',RTD = '".$row_vessel[ATD]."'
					WHERE VESSEL = '".$row_vessel[VESSEL]."' AND VOYAGE_IN = '".$row_vessel[VOYAGE_IN]."' AND VOYAGE_OUT = '".$row_vessel[VOYAGE_OUT]."'";
				}
			}


		$out_data = array();
		$out_data['vessel']=$vvd;

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