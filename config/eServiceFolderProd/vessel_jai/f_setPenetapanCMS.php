<?php

/*|
 | Function Name 	: setPenetapanCMS
 | Description 		: set Penetapan CMS
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function setPenetapanCMS($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_pgk = $xml_data->data->no_pgk;
		$no_pppp = $xml_data->data->no_pppp;
		$pppp_ke = $xml_data->data->pppp_ke;
		$curr_cms = $xml_data->data->curr_cms;
		$saldo_exist = $xml_data->data->saldo_exist;
		$kd_cabang = $xml_data->data->kd_cabang;
		$kd_agen = $xml_data->data->kd_agen;
		$username = $xml_data->data->username;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		// $getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		$bind_param = array(
							':no_pgk' => "$no_pgk",
							':no_pppp' => "$no_pppp",
							':pppp_ke' => "$pppp_ke",
							':curr_cms' => "$curr_cms",
							':saldo_exist' => "$saldo_exist",
							':kd_agen' => "$kd_agen",
							':kd_cabang' => "$kd_cabang",
							':username' => "$username",
							':p_status' => "",
							':p_msg' => ""
						);
		
		$sql = "BEGIN PROC_PENETAPAN_CMS
				(
					:no_pgk,
					:no_pppp,
					:pppp_ke,
					:curr_cms,
					:saldo_exist,
					:kd_agen,
					:kd_cabang,
					:username,
					:p_status,
					:p_msg
				); END;";

		//QUERY
		if(!checkOriSQL($conn['ori']['kapal'],$sql,$query,$err,$bind_param)) goto Err;
		
		$getdata = array(
						'status' => $bind_param[':p_status'],
						'msg' => $bind_param[':p_msg']
					);
		
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