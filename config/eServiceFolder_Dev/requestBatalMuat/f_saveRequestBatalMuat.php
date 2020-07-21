<?php 

/*|
 | Function Name 	: saveRequestBatalMuat
 | Description 		: saveRequestBatalMuat
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function saveRequestBatalMuat($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$idreq = $xml_data->data->no_request;
		$port_code= $xml_data->data->port_code;
		$terminal_code= $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();		
		
		//pastikan setiap connection masuk ke $conn['ori']/$conn['mysql'] terlebih dahulu.
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		$query_getheader = "SELECT a.id_batalmuat,a.ID_FPOD,a.vessel, a.voyage, a.voyage_out, a.pengguna, a.jenis,case when a.jenis = 'B' then 'CALBG' WHEN a.jenis= 'A' THEN 'CALAG' ELSE 'CALDG' END TIPE_BM, a.EMKL,a.SHIPPING_LINE, tgl_berangkat2 FROM TB_BATALMUAT_H a WHERE a.ID_BATALMUAT = '$idreq'";
					if(!checkOriSQL($conn['ori']['billing'],$query_getheader,$getheader,$err,$debug,$bind_param)) goto Err;
					if ($rowheader = oci_fetch_array($getheader, OCI_ASSOC))
					{
						$tipebm   	   = $rowheader["JENIS"];
						$idbatalmuat   = $rowheader["ID_BATALMUAT"];
					}

		$sql_xpi = "BEGIN PROC_BATALMUAT('$idreq','$tipebm'); COMMIT; END;";
			if(!checkOriSQL($conn['ori']['billing'],$sql_xpi,$sql_xpi_,$err,$debug)) goto Err;
			
			$sql_xpiz="begin pack_nota_batmuat.proc_header_nota_batmuat(trim('$idreq')); COMMIT; end;";
			if(!checkOriSQL($conn['ori']['billing'],$sql_xpiz,$sql_xpiz_,$err,$debug)) goto Err;
			
			$qr="select NO_NOTA from nota_batalmuat_h where ID_BATALMUAT='$idbatalmuat'";
					
			if(!checkOriSQL($conn['ori']['billing'],$qr,$getqr,$err,$debug,$bind_param)) goto Err;
					if ($rowgetqr = oci_fetch_array($getqr, OCI_ASSOC))
					{
						$id_proforma=$rowgetqr["NO_NOTA"];
					}
					
		
			$saveRequest = "UPDATE TRANSACTION_LOG SET STATUS_REQ='S', PRF_NUMBER='$id_proforma', PRF_DATE=SYSDATE
								WHERE BILLER_REQUEST_ID='$idreq'";
					
			if(!checkOriSQL($conn['ori']['ibis'],$saveRequest,$query_save,$err,$debug)) goto Err;
			

		
			$out_data = array();
			$out_data['data']='OK';
				
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