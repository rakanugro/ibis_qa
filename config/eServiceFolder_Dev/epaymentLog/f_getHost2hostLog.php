<?php

/*|
 | Function Name 	: getHost2hostLog
 | Description 		: get Host2host Log
 | Creator			: Endang Fiansyah
 | Creation Date	: 08/05/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:    
 |*/
function getHost2hostLog($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb2();
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
			$all_modul = array("PTP_RECON");
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
			if(!checkOriSQL($conn['ori']['ilcs_recon'],$query[$i]['query_log'],$query_result_all,$err,$debug)) goto Err;
			
			//FETCH QUERY
			while($row = oci_fetch_array($query_result_all, OCI_ASSOC))
			{
				//build sub data
				$data_sub = array(
										//'modul' => $query[$i]['modul'],
										'log_date' => $row[LOG_DATE2],
										'invoice' => $row[INVOICE_NUM],
										'req_num' => $row[PROFORMA_NUM],
										'amt' => $row[TRANS_AMOUNT],
										'cust' => $row[CUST_NAME],
										'source' => $row[SOURCE_FILE],
										'status' => $row[STATUS],
										'message' => $row[MESSAGE],
										'trans_code' => $row[TRANSACTION_CODE]
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