<?php

/*|
 | Function Name 	: requestReceivingDetail
 | Description 		: do Request Receiving Detail
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function AddContainerBM($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		

		//set input parameter
		$request_no 	= $xml_data->data->detail->request_no;
		$container	 	= $xml_data->data->detail->container;
		$size 			= $xml_data->data->detail->size;
		$type 			= $xml_data->data->detail->type;
		$status 		= $xml_data->data->detail->status;
		$height			= $xml_data->data->detail->height;
		$ukk_old 		= $xml_data->data->detail->ukk_old;
		$ukk_new 		= $xml_data->data->detail->ukk_new;
		$hz 			= $xml_data->data->detail->hz;
		$etd 			= $xml_data->data->detail->etd;
		$terminal_code	= $xml_data->data->detail->terminal_code;
		$port_code		= $xml_data->data->detail->port_code;
		$reqNoBiller	= $xml_data->data->detail->reqNoBiller;
		
		
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		$conn['ori'] += oriDb("BILLING_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		if (($terminal_code  = 'T1D') OR ($terminal_code  = 'T2D') OR ($terminal_code  = 'T3D') ){
	
			$query_getreq = " SELECT KODE_BARANG FROM MASTER_BARANG WHERE UKURAN = '$size' AND TIPE = '$type' AND STATUS= '$status' AND HEIGHT = '$height'";
					if(!checkOriSQL($conn['ori']['billing'],$query_getkdbrg,$getkdbrg,$err,$debug,$bind_param)) goto Err;
					if ($rowDatabarang = oci_fetch_array($getkdbrg, OCI_ASSOC))
					{
						$kd_brg=$rowDatabarang["KODE_BARANG"];
					}
		
			$query_gettglstack = "SELECT TGL_MUAT FROM REQ_RECEIVING_H a,REQ_RECEIVING_D b WHERE TRIM(a.ID_REQ) = TRIM(b.NO_REQ_ANNE) AND b.NO_CONTAINER = '$container' AND b.NO_UKK= '$ukk_old'";
					if(!checkOriSQL($conn['ori']['billing'],$query_gettglstack,$gettglstack,$err,$debug,$bind_param)) goto Err;
					if ($rowtglmuat = oci_fetch_array($gettglstack, OCI_ASSOC))
					{
						$tgl_stack=$rowtglmuat["TGL_MUAT"];
					}

			$query = "INSERT INTO TB_BATALMUAT_D (ID_BATALMUAT,
											NO_CONTAINER,
											STATUS,
											HZ,
											NO_UKK,
											NO_UKK_NEW,
											JNS_CONT,
											ID_CONT,
											TGL_STACK,
											TGL_BERANGKAT)
					 VALUES ('$reqNoBiller',
							 '$container',
							 '$status',
							 '$hz',
							 '$ukk_old',
							 '$ukk_new',
							 '$size'||'$type'||'$status',
							 '$kd_brg',
							 TO_DATE('$tgl_stack','dd/mon/rr'),
							 TO_DATE (SUBSTR('$etd',0,10), 'dd/mm/rrrr'))";
						
			
			try {
				if(!checkOriSQL($conn['ori']['billing'],$query,$query_,$err,$debug)) goto Err;
				$data = 'OK';

				$out_data = array();
				$out_data['data']=$data;
			} 
			catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
			}
				
			
			goto Success;
		} // else opus blm
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