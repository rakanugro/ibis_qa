<?php

/*|
 | Function Name 	: getAutoLog
 | Description 		: Get Auto Log
 | Creator			: Endang Fiansyah
 | Creation Date	: 06/05/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:    
 |*/
function getAutoLog($in_param) {
	
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

		$start = $xml_data->data->start_date;
		$end = $xml_data->data->end_date;
		$modul = $xml_data->data->modul;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//select data
		$result = array();
		$query = array();
		if($modul!="ALL")
		{
			getAllQuery($modul,$start,$end,$result);
			$query[0] = $result;
		}
		else 	
		{
			$all_modul = array("PTP_KAPAL");
			for($i=0;$i<count($all_modul);$i++) {
				getAllQuery($all_modul[$i],$start,$end,$result);
				$query[$i] = $result;
			}
		}
		
		//PL/SQL
		$data=array();
		for($i=0;$i<count($query);$i++)
		{
			//QUERY
			if(!checkOriSQL($conn['ori']['ptp_kapal'],$query[$i]['query_log'],$query_result_all,$err)) goto Err;
			
			//FETCH QUERY
			while($row = oci_fetch_array($query_result_all, OCI_ASSOC))
			{
				//build sub data
				$data_sub = array(
										'modul' => $query[$i]['modul'],
										'log_date' => $row[LOG_DATE2],
										'no_ppkb' => $row[NO_PPKB],
										//'no_pkk' => $row[NO_PKK],
										//'ppkb_ke' => $row[PPKB_KE],
										//'kd_service_code' => $row[KD_SERVICE_CODE],
										'statements' => $row[STATEMENTS],
										//'user_id' => $row[USER_ID],
										'respond' => $row[RESPOND],
										'message' => $row[MESSAGE],
										//'respond_date' => $row[RESPOND_DATE],
										//'reference_id' => $row[REFERENCE_ID],
										//'no_nota' => $row[NO_NOTA],
										//'log_id' => $row[LOG_ID],
										//'external_id' => $row[EXTERNAL_ID],
										//'internal_id' => $row[INTERNAL_ID],
										'kd_bank' => $row[KD_BANK]
									);
				
				array_push($data, $data_sub);
			}
		}

		$out_data = array();
		$out_data['data']=$data;

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