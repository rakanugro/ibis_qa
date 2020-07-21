<?php

/*|
 | Function Name 	: getCountStatusNotaArReceipt
 | Description 		: Get registered nota status (opus, lini2, barang, itos)
 |*/
function getCountStatusNotaArReceipt($in_param) {
	
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
			$all_modul = array("PTP_OPUS_TO3","PTP_ITOS_TO3","PTP_ITOS_TO2","PTP_ITOS_TO1","PTP_LINI2"); 
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
			if(!checkOriSQL($conn['ori']['keu_prod'],$query[$i]['query_count_allnota'],$query_result_all,$err,$debug)) goto Err;
			if(!checkOriSQL($conn['ori']['keu_prod'],$query[$i]['query_count_arnotfound'],$query_result_arnotfound,$err,$debug)) goto Err;
			if(!checkOriSQL($conn['ori']['keu_prod'],$query[$i]['query_count_receiptnotfound'],$query_result_receiptnotfound,$err,$debug)) goto Err;
			if(!checkOriSQL($conn['ori']['keu_prod'],$query[$i]['query_count_overpayment'],$query_result_overpayment,$err,$debug)) goto Err;
			
			//FETCH QUERY
			while($row = oci_fetch_array($query_result_all, OCI_ASSOC))
			{
				if(!$skip_arnotfound)
					$row2 = oci_fetch_array($query_result_arnotfound, OCI_ASSOC);

				if(!$skip_receiptnotfound)
					$row3 = oci_fetch_array($query_result_receiptnotfound, OCI_ASSOC);

				if(!$skip_overpayment)
					$row4 = oci_fetch_array($query_result_overpayment, OCI_ASSOC);
					
				if($row[TRX_DATE]!=$row2[TRX_DATE])
				{	
					$date_arnotfound = $row[TRX_DATE];
					$count_arnotfound = 0;
					$skip_arnotfound = true;
				}
				else
				{
					$date_arnotfound = $row2[TRX_DATE];
					$count_arnotfound = $row2[TRX_COUNT];
					$skip_arnotfound = false;
				}
				
				if($row[TRX_DATE]!=$row3[TRX_DATE])
				{	
					$date_receiptnotfound = $row[TRX_DATE];
					$count_receiptnotfound = 0;
					$skip_receiptnotfound = true;
				}
				else
				{
					$date_receiptnotfound = $row3[TRX_DATE];
					$count_receiptnotfound = $row3[TRX_COUNT];
					$skip_receiptnotfound = false;
				}

				if($row[TRX_DATE]!=$row4[TRX_DATE])
				{	
					$date_overpayment = $row[TRX_DATE];
					$count_overpayment = 0;
					$skip_overpayment = true;
				}
				else
				{
					$date_overpayment = $row4[TRX_DATE];
					$count_overpayment = $row4[TRX_COUNT];
					$skip_overpayment = false;
				}
				
				//build sub data
				$data_sub = array(
										'trx_date' => $row[TRX_DATE],
										'modul' => $query[$i]['modul'],
										'all' => $row[TRX_COUNT],
										//'trx_date2' => $date_arnotfound,
										'arnotfound' => $count_arnotfound,
										//'trx_date3' => $date_receiptnotfound,
										'receiptnotfound' => $count_receiptnotfound,
										//'qarnotfound' => $query[$i]['query_count_arnotfound'],
										//'qreceiptnotfound' => $query[$i]['query_count_receiptnotfound'],
										'overpayment' => $count_overpayment
									);
				
				array_push($data, $data_sub);
			}

			$skip_receiptnotfound = false;
			$skip_arnotfound = false;
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