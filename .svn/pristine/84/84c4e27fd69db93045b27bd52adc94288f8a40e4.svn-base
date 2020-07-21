<?php

/*|
 | Function Name 	: getCompanyList
 | Description 		: Get Company List
 | Creator			: Endang Fiansyah
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getCompanyList($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb2(); //KAPAL_PROD
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$company_list = $xml_data->data->companies;
		//$token_minimal = $xml_data->data->token_minimal;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get company info
		$companies = array();
		
		//query builder
		$whereString = "";
		$i= 0;
		foreach($company_list->company as $com){
			foreach ($com->company_name as $token){
				if($i>0){
					$whereString .= " and ";
				}
				$whereString .= "  
								upper(nama_perusahaan) like upper('%$token%')   
								";
				$i++;				
			}
		}
		if($i==0){
			$whereString = " nama_perusahaan is null ";
		}
		
		//PL/SQL
		//$getCompanies=$whereString;
		$getCompanies = "select distinct
							kd_pelanggan,
							nama_perusahaan,
							alamat_perusahaan,
							kota_perusahaan,
							no_npwp
						from mst_pelanggan
						where $whereString ";
		
		//return generateResponse($out_data, $out_status, $err, "json");
		
		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$getCompanies,$query_companies,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_company = oci_fetch_array($query_companies, OCI_ASSOC))
		{
			//build "info" data
			$company_info = array(
									'company_id' 	=> $row_company[KD_PELANGGAN],
									'company_name' 	=> $row_company[NAMA_PERUSAHAAN],
									'address' 		=> $row_company[ALAMAT_PERUSAHAAN],
									'city' 			=> $row_company[KOTA_PERUSAHAAN],
									'npwp' 			=> $row_company[NO_NPWP]
								);
			
			//$company = array('company' => $company_info);
			
			array_push($companies, $company_info);
		}

		$out_data = array();
		$out_data['companies']=$companies;

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