<?php

/*|
 | Function Name 	: SubmitBatalmuat
 | Description 		: submit all Request Batal muat
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function SubmitBatalmuat($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		//$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$idreq = $xml_data->data->detail->idreq;
		
		$port_code= $xml_data->data->detail->port_code;
		$terminal_code= $xml_data->data->detail->terminal_code;
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//generate no request
		//begin pack_nota_delivery.proc_header_nota_delivery('$no_req'); end;
		$formatgroupconn='BILLING_'.$port_code.'_'.$terminal_code;
		$conn=oriDb($formatgroupconn);
		
		$conn['ori'] += oriDb("IBIS");
		
		$getHeader = "SELECT * FROM REQ_BATALMUAT_H WHERE ID_REQ = '$idreq'";
		if(!checkOriSQL($conn['ibis'][0],$getHeader,$getHeader_,$err,$debug)) goto Err;
		$row_head = oci_fetch_array($getHeader_, OCI_ASSOC);
		$user 		= $row_head['PENGGUNA'];
		$vessel 	= $row_head['VESSEL'];
		$voyage 	= $row_head['VOYAGE'];
		$voyage2 	= $row_head['VOYAGE_OUT'];
		$no_ukk 	= $row_head['NO_UKK'];
		$shipping 	= $row_head['SHIPPING_LINE'];
		$etd 		= $row_head['TGL_BERANGKAT2'];
		$emkl 		= $row_head['EMKL'];
		$id_fpod	= $row_head['ID_FPOD'];
		$book_num	= $row_head['BOOKING_NUMB'];
		$i=1;
		
		$getDetail = "SELECT * FROM REQ_BATALMUAT_D WHERE ID_REQ = '$idreq'";
		if(!checkOriSQL($conn['ibis'][0],$getDetail,$getDetail_,$err,$debug)) goto Err;
		$bind_param = array(
			':v_msg' => ''
		);
		while($rowdet = oci_fetch_array($getDetail_, OCI_ASSOC)){
			$jenis  = explode('-',$rowdet['JNS_CONT']);
			$tipe = $jenis[1];
			$status = $jenis[2];
			$sql = "declare begin proc_add_batal_muat_bg_dev(".$i++.",'".$user."','".$_SERVER['REMOTE_ADDR']."','".$vessel."','".$voyage."','".$voyage2."','".$no_ukk."','".$rowdet['NO_UKK']."','".$rowdet['NO_UKK_NEW']."','".$shipping."','".$etd."','".$rowdet['TGL_STACK']."','".$idreq."','".$rowdet['NO_CONTAINER']."','".$rowdet['ID_CONT']."','".$rowdet['HZ']."','".$rowdet['JNS_CONT']."','".$rowdet['ID_CONT']."','".$tipe."','".$status."','CALBG','".$book_num."','".$emkl."','".$id_fpod."',:v_msg); end;";
			
			if(!checkOriSQL($conn['billing'][0],$sql,$sql_,$err,$debug,$bind_param)) goto Err;
		}
		
		$sql_xpi = "BEGIN PROC_BATALMUAT('$idreq','B'); COMMIT; END;";
		if(!checkOriSQL($conn['billing'][0],$sql_xpi,$sql_xpi_,$err,$debug)) goto Err;
		
		$sql_xpiz="begin pack_nota_batmuat.proc_header_nota_batmuat(trim('$idreq')); COMMIT; end;";
		if(!checkOriSQL($conn['billing'][0],$sql_xpiz,$sql_xpiz_,$err,$debug)) goto Err;
		
		$updsql = "UPDATE REQ_BATALMUAT_H SET STATUS = 'S' WHERE ID_REQ='$idreq'";
		if(!checkOriSQL($conn['ibis'][0],$updsql,$updsql_,$err,$debug)) goto Err;
		
		$msg = $bind_param[':v_msg'];
		$data = array(
						'result' => $msg
					);

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