<?php

/*|
 | Function Name 	: getAutoTotalHold
 | Description 		: Get Auto Total Hold
 | Creator			: Endang Fiansyah
 | Creation Date	: 18/06/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:    
 |*/
function getAutoTotalHold($in_param) {
	
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

		$no_rek = $xml_data->data->no_rek;
		$currency = $xml_data->data->currency;
		$nama_agen = $xml_data->data->nama_agen;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//select data
		if($no_rek!="")
		{
			if($query_sub!="")
				$query_sub .=" AND ";

			$query_sub = " (c.norek_idr = '$no_rek' OR c.norek_usd='$no_rek')";
		}

		if($currency!="")
		{
			if($query_sub!="")
				$query_sub .=" AND ";

			$query_sub = " a.currecy='$currency'";
		}

		if($nama_agen!="")
		{
			if($query_sub!="")
				$query_sub .=" AND ";

			$query_sub = " b.nm_agen like '%$nama_agen%'";
		}
		
		if($query_sub!="")
			$query_sub = " WHERE ".$query_sub;
		
		/*$query = "select b.nm_agen, a.currecy, a.bank_id, 
					CASE a.currecy
					  WHEN 'IDR' THEN c.norek_idr
					  WHEN 'USD' THEN c.norek_usd 
					END norek,  
					sum(a.nominal_uper) total_hold  
					from ac_ppkb_log a 
						left join mst_agen b on b.no_account=a.kd_agen
						left join ac_rekening_user c on c.kd_agen=a.kd_agen   
					$query_sub 	
					where a.NO_PPKB NOT IN (SELECT NO_PPKB FROM AC_DEDUCT_NOTA) 
					group by a.kd_agen, a.currecy, a.bank_id, b.nm_agen, c.norek_usd, c.norek_idr   
					order by a.kd_agen, a.currecy";*/
					
		$query = "select b.nm_agen, a.currecy, a.bank_id, 
					CASE a.currecy
					  WHEN 'IDR' THEN c.norek_idr
					  WHEN 'USD' THEN c.norek_usd 
					END norek,  
					sum(a.nominal_uper) total_hold  
					from ac_ppkb_log a 
						left join mst_agen b on b.no_account=a.kd_agen
						left join ac_rekening_user c on c.kd_agen=a.kd_agen   
					$query_sub 	
					where (a.NO_PPKB,a.currecy) NOT IN (select d.no_ppkb,CASE INSTR(d.statements, 'IDR')  
                                                                WHEN 0 THEN 'USD'
                                                                ELSE 'IDR'
                                                                END from ac_parameter_log d where 
												(statements like '%paymentrelease%' or statements like '%releaseamount%') and respond = 'false') 
					group by a.kd_agen, a.currecy, a.bank_id, b.nm_agen, c.norek_usd, c.norek_idr   
					order by a.kd_agen, a.currecy";
		
		$data=array();

		//QUERY
		if(!checkOriSQL($conn['ori']['ptp_kapal'],$query,$query_result_all,$err)) goto Err;
		
		//FETCH QUERY
		while($row = oci_fetch_array($query_result_all, OCI_ASSOC))
		{
			//build sub data
			$data_sub = array(
									'nama_agen' => $row[NM_AGEN],
									'norek' => $row[NOREK],
									'currency' => $row[CURRECY],
									'bank_id' => $row[BANK_ID],
									'total_hold' => $row[TOTAL_HOLD]
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