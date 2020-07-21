<?php

/*|
 | Function Name 	: ValidasiPenetapanP4
 | Description 		: Validasi Penetapan P4
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function ValidasiPenetapanP4($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		
		//set input parameter
		$no_pppp = $xml_data->data->no_pppp;
		$pppp_ke = $xml_data->data->pppp_ke;
		$agent_id = $xml_data->data->agent_id;
		$kd_three_partied = $xml_data->data->kd_three_partied;
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		
		//get data info
		$getdata = array();
		
		//SELECT CONNECTION
		$conn['ori'] = oriDb("KAPAL");
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		//SELECT PL/SQL
		if($kd_three_partied == "1") {	//CMS
			$bind_param = array(
							':no_pppp' => "$no_pppp",
							':pppp_ke' => "$pppp_ke",
							':p_status' => "$agent_id",
							':p_msg' => ""
						);
			$sql = "BEGIN F_BAYAR_CMS(:no_pppp,:pppp_ke,:p_status,:p_msg); END;";
		}
		else {
			$bind_param = array(
							':agent_id' => "$agent_id",
							':no_pppp' => "$no_pppp",
							':pppp_ke' => "$pppp_ke",
							':p_status' => "$agent_id",
							':p_msg' => ""
						);
			$sql = "BEGIN F_ADA_HUTANG_UPER(:agent_id,:no_pppp,:pppp_ke,:p_status,:p_msg); END;";
		}

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