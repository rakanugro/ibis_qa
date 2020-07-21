<?php

/*|
 | Function Name 	: getAutoLastStatusError
 | Description 		: Get Auto Last Status Error
 | Creator			: Endang Fiansyah
 | Creation Date	: 23/06/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:    
 |*/
function getAutoLastStatusError($in_param) {
	
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

		$exmp = $xml_data->data->exmp;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		$query = "with ordered as 
					(
						select a.no_ppkb, 
								e.nm_agen, 
								a.log_date, a.respond, a.message, a.statements, a.kd_bank, row_number() over (PARTITION BY a.no_ppkb ORDER BY a.log_date desc) as rn 
							from 
								ac_parameter_log a,
								ppkb b, 
								pkk c, 
								mst_kapal_agen d,
								mst_agen e
							where a.no_ppkb=b.kd_ppkb 
									and b.no_ukk = c.no_ukk 
									AND c.kd_kapal_agen = d.kd_kapal_agen
									AND d.kd_agen = e.kd_agen
					)
					SELECT
						no_ppkb, 
							nm_agen, 
							to_char(log_date, 'yyyy/mm/dd hh24:mi:ss') as log_date2, respond, message, statements, kd_bank, rn, 
							(select count(no_ppkb) from ac_parameter_log where ac_parameter_log.statements = ORDERED.statements) as jumlah_pemanggilan_yang_sama,
							(
								select to_char(log_date, 'yyyy/mm/dd hh24:mi:ss')  
									from 
										ac_parameter_log 
									where ac_parameter_log.statements = ORDERED.statements AND ROWNUM = 1 
							) as tanggal_pemanggilan_pertama, 
							(
								select log_date 
									from 
										ac_parameter_log 
									where ac_parameter_log.statements = ORDERED.statements AND ROWNUM = 1 
							) as tanggal_pemanggilan_pertama2,
							(24 * extract(day from (log_date - (select log_date from ac_parameter_log 
									where ac_parameter_log.statements = ORDERED.statements AND ROWNUM = 1)) day(9) to second))
								+ extract(hour from (log_date - (select log_date from ac_parameter_log 
									where ac_parameter_log.statements = ORDERED.statements AND ROWNUM = 1)) day(9) to second)
								+ ((1/100) * extract(minute from (log_date - (select log_date from ac_parameter_log 
									where ac_parameter_log.statements = ORDERED.statements AND ROWNUM = 1)) day(9) to second)) as selisih_waktu_pemanggilan 
					FROM
						ORDERED
					WHERE
						rn=1 and (respond = 'true' or respond is null)
						order by 
							log_date desc";
		
		$data=array();

		//QUERY
		if(!checkOriSQL($conn['ori']['ptp_kapal'],$query,$query_result_all,$err,$debug)) goto Err;
		
		//FETCH QUERY
		while($row = oci_fetch_array($query_result_all, OCI_ASSOC))
		{
			//build sub data
			$data_sub = array(
									'no_ppkb' => $row[NO_PPKB],
									'nm_agen' => $row[NM_AGEN],
									'log_date' => $row[LOG_DATE2],
									'respond' => $row[RESPOND],
									'message' => $row[MESSAGE],
									'statements' => $row[STATEMENTS],
									'kd_bank' => $row[KD_BANK],
									'rn' => $row[RN],
									'jumlah_pemanggilan_yang_sama' => $row[JUMLAH_PEMANGGILAN_YANG_SAMA],
									'tanggal_pemanggilan_pertama' => $row[TANGGAL_PEMANGGILAN_PERTAMA],
									'selisih_waktu_pemanggilan' => $row[SELISIH_WAKTU_PEMANGGILAN] 
								);
			
			array_push($data, $data_sub);
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