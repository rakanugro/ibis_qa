<?php

/*|
 | Function Name 	: getVesselWaitingTime
 | Description 		: get Vessel Waiting Time
 | Creator			: Endang Fiansyah
 | Creation Date	: 24/08/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getVesselWaitingTime($in_param) {

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

		$port = $xml_data->data->port;$port = explode("-",$port);
		$port_code=$port[0];
		$terminal_code=$port[1];
		
		$start_date    = $xml_data->data->start_date;
		$end_date    = $xml_data->data->end_date;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$status  	    = array();
		$out_data 	    = array();
		
		//get vessel info
		//PL/SQL
		$sql2 = "select ROUND(
								AVG(to_date(log_ppkb_labuh.tgl_jam_pmt_slabuh)-to_date(log_ppkb_labuh.tgl_jam_pmt_mlabuh))
							,2) as wtime,
							to_char(log_ppkb_labuh.tgl_jam_pmt_mlabuh,'YYYYMMDD') as tgl_mlabuh from log_ppkb_labuh 
							where tgl_jam_pmt_mlabuh 
							BETWEEN TO_DATE ('$start_date', 'YYYYMMDDHH24:MI:SS') 
							and TO_DATE ('$end_date', 'YYYYMMDDHH24:MI:SS')
							group by to_char(log_ppkb_labuh.tgl_jam_pmt_mlabuh,'YYYYMMDD')  
							order by to_char(log_ppkb_labuh.tgl_jam_pmt_mlabuh,'YYYYMMDD') asc 
						";

		//select connection

		$conn['vessel'][0] = $conn['ori']['ptp_kapal'];
		$sql[0] = $sql2;
		$terminal[0]=$port_code."-".$terminal_code;

		$info=array();
		for($j=0;$j<count($conn['vessel']);$j++)
		{
			//QUERY
			if(!checkOriSQL($conn['vessel'][$j],$sql[$j],$query_vessel,$err)) goto Err;
			//FETCH QUERY
			while ($row_container = oci_fetch_array($query_vessel, OCI_ASSOC))
			{
				//build "info" data
				$info_sub = array(
								'tgl_mlabuh' => $row_container[TGL_MLABUH],
								'wtime' => $row_container[WTIME]
							);
				array_push($info, $info_sub);
			}
		}
		
		$out_data = array();
		$out_data['info']=$info;
		goto Success;
	}
	
	catch (Exception $e) {
		$err = "SCRIPT EXCEPTION:".$e->getMessage();
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