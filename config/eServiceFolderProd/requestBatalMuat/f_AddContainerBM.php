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
		
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ori'] += oriDb("CONTAINER_".$port_code."_".$terminal_code);
		//tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
		$query_getkdbrg = " SELECT KODE_BARANG FROM MASTER_BARANG WHERE UKURAN = '$size' AND TYPE = '$type' AND STATUS= CASE WHEN '$status' = 'FULL' THEN 'FCL' WHEN '$status' = 'EMPTY' THEN 'MTY' END AND HEIGHT_CONT = CASE WHEN '$height' = '8.6' THEN 'BIASA' WHEN '$height' = '9.6' THEN 'BIASA' WHEN '$height' = 'OOG' THEN 'OOG' END";
					if(!checkOriSQL($conn['ori']['billing'],$query_getkdbrg,$getkdbrg,$err,$bind_param)) goto Err;
					if ($rowDatabarang = oci_fetch_array($getkdbrg, OCI_ASSOC))
					{
						$kd_brg=$rowDatabarang["KODE_BARANG"];
					}
					
		
		if ($terminal_code == 'T009D'){
		
				$query_gettglstack = "SELECT H.TGL_BERANGKAT2 AS TGL_MUAT, TGL_STACK AS TGL_STACK FROM REQ_BATALMUAT_H H 
						LEFT JOIN REQ_BATALMUAT_D D ON H.ID_REQ = D.ID_REQ
						WHERE H.ID_REQ = '".$reqNoBiller."'";
					if(!checkOriSQL($conn['ori']['billing'],$query_gettglstack,$gettglstack,$err,$bind_param)) goto Err;
					if ($rowtglmuat = oci_fetch_array($gettglstack, OCI_ASSOC))
					{
						$tglmuat=$rowtglmuat["TGL_MUAT"];
					}
					
				$query_gettglstack = "SELECT TGL_MUAT FROM REQ_RECEIVING_H a,REQ_RECEIVING_D b WHERE TRIM(a.ID_REQ) = TRIM(b.ID_REQ) AND b.NO_CONTAINER = '$container' AND b.NO_UKK= '$ukk_old'";
					if(!checkOriSQL($conn['ori']['billing'],$query_gettglstack,$gettglstack,$err,$bind_param)) goto Err;
					if ($rowtglmuat = oci_fetch_array($gettglstack, OCI_ASSOC))
					{
						$tgl_stack=$rowtglmuat["TGL_MUAT"];
					}
			
			
				$query_getheader = "SELECT a.ID_FPOD,
										   a.vessel,
										   a.voyage_in voyage,
										   a.voyage_out,
										   a.pengguna,
										   CASE
											  WHEN a.jenis = 'B' THEN 'CALBG'
											  WHEN a.jenis = 'A' THEN 'CALAG'
											  ELSE 'CALDG'
										   END
											  TIPE_BM,
										   a.EMKL,
										   a.SHIPPING_LINE,
										   tgl_berangkat2
									  FROM REQ_BATALMUAT_H a
									 WHERE a.ID_REQ = '$reqNoBiller'";
					if(!checkOriSQL($conn['ori']['billing'],$query_getheader,$getheader,$err,$bind_param)) goto Err;
					if ($rowheader = oci_fetch_array($getheader, OCI_ASSOC))
					{
						$vessel	=	$rowheader["VESSEL"];
						$voyin	=	$rowheader["VOYAGE"];
						$voyout	=	$rowheader["VOYAGE_OUT"];
						$tipebm	=	$rowheader["TIPE_BM"];
						$emkl	=	$rowheader["EMKL"];
						$shipping =	$rowheader["SHIPPING_LINE"];
						$user   =	$rowheader["PENGGUNA"];
						$idpod   =	$rowheader["ID_FPOD"];
						$tgl_del   =	$rowheader["TGL_BERANGKAT2"];
						
					}
		
		
		} else {
	
				
				//RETURN $kd_brg;
			
				$query_gettglstack = "SELECT TGL_MUAT FROM REQ_RECEIVING_H a,REQ_RECEIVING_D b WHERE TRIM(a.ID_REQ) = TRIM(b.NO_REQ_ANNE) AND b.NO_CONTAINER = '$container' AND b.NO_UKK= '$ukk_old'";
					if(!checkOriSQL($conn['ori']['billing'],$query_gettglstack,$gettglstack,$err,$bind_param)) goto Err;
					if ($rowtglmuat = oci_fetch_array($gettglstack, OCI_ASSOC))
					{
						$tgl_stack=$rowtglmuat["TGL_MUAT"];
					}
			
				$query_getheader = "SELECT a.ID_FPOD,a.vessel, a.voyage, a.voyage_out, a.pengguna, case when a.jenis = 'B' then 'CALBG' WHEN a.jenis= 'A' THEN 'CALAG' ELSE 'CALDG' END TIPE_BM, a.EMKL,a.SHIPPING_LINE, tgl_berangkat2 FROM TB_BATALMUAT_H a WHERE a.ID_BATALMUAT = '$reqNoBiller'";
					if(!checkOriSQL($conn['ori']['billing'],$query_getheader,$getheader,$err,$bind_param)) goto Err;
					if ($rowheader = oci_fetch_array($getheader, OCI_ASSOC))
					{
						$vessel	=	$rowheader["VESSEL"];
						$voyin	=	$rowheader["VOYAGE"];
						$voyout	=	$rowheader["VOYAGE_OUT"];
						$tipebm	=	$rowheader["TIPE_BM"];
						$emkl	=	$rowheader["EMKL"];
						$shipping =	$rowheader["SHIPPING_LINE"];
						$user   =	$rowheader["PENGGUNA"];
						$idpod   =	$rowheader["ID_FPOD"];
						$tgl_del   =	$rowheader["TGL_BERANGKAT2"];
						
					}
				//return $query_getheader;	
			}
		
			$sql_vsb = "SELECT NVL(TO_DATE(ATD,'YYYYMMDDHH24MISS'),TO_DATE(ETD,'YYYYMMDDHH24MISS')) AS ATD_DT, VESSEL_CODE FROM M_VSB_VOYAGE WHERE TRIM(VESSEL) = '$vessel' AND TRIM(VOYAGE_IN) = '$voyin' AND TRIM(VOYAGE_OUT) = '$voyout'";
			
			if(!checkOriSQL($conn['ori']['container'],$sql_vsb,$get_vsb,$err,$bind_param)) goto Err;
					if ($rowvsb = oci_fetch_array($get_vsb, OCI_ASSOC))
					{
						//$vescod = $rowvsb["VESSEL_CODE"];
						$vsbtgl = $rowvsb["ATD_DT"];
					}

				$jeniscont = $size.'-'.$type.'-'.$status;
				
			// start procedure T009D
				$param_b_vart009d = array(
								"nc" => "1",
								"user" => "$user",
								"ipaddr" => "",
								"vessel" => "$vessel",
								"vin" => "$voyin",
								"vout" => "$voyout",
								"ukk1" => "$ukk_old",
								"ukkold" => "$ukk_old",
								"no_ukk_baru" => "$ukk_new",
								"shipping" => "$shipping",
								"etd" => "$tglmuat",
								"stack" => "$tgl_stack",
								"id_req" => "$reqNoBiller",
								"nocont" => "$container",
								"kdbrg" => "$kd_brg",
								"haz" => "$hz",
								"jnscont" => "$jeniscont",
								"kdbrg2" => "$kd_brg",
								"tipe" => "$type",
								"status" => "$status",
								"type_cancel" => "$tipebm",
								"custom_number" => "",
								"emkl" => "$emkl",
								"v_etd_lama" => "$tglmuat",
								"v_msg" => ""
								);
				
				$sqlt009d = "declare v_msg varchar(1000); 
								begin proc_add_bm_ag( 
								:nc,
								:user,
								:ipaddr,
								:vessel,
								:vin,
								:vout,
								:ukk1,
								:ukkold,
								:no_ukk_baru,
								:shipping,
								:etd,		
								:stack,		
								:id_req,
								:nocont,
								:kdbrg,
								:haz,
								:jnscont,
								:kdbrg2,
								:tipe,
								:status,
								:type_cancel,
								:custom_number,
								:emkl,
								:v_etd_lama,
								:v_msg); end;";
								
				$param_b_vart009del = array(
								"nc" => "1",
								"user" => "$user",
								"ipaddr" => "",
								"vessel" => "$vessel",
								"vin" => "$voyin",
								"vout" => "$voyout",
								"ukk1" => "$ukk_old",
								"ukkold" => "$ukk_old",
								"no_ukk_baru" => "$ukk_new",
								"shipping" => "$shipping",
								"etd" => "$tglmuat",
								"stack" => "$tgl_stack",
								"id_req" => "$reqNoBiller",
								"nocont" => "$container",
								"kdbrg" => "$kd_brg",
								"haz" => "$hz",
								"jnscont" => "$jeniscont",
								"kdbrg2" => "$kd_brg",
								"tipe" => "$type",
								"status" => "$status",
								"type_cancel" => "$tipebm",
								"custom_number" => "",
								"emkl" => "$emkl",
								"v_etd_lama" => "$tglmuat",
								"v_msg" => ""
								);
				
				$sqlt009del = "declare v_msg varchar(1000); 
								begin proc_add_batal_muat_del( 
								:nc,
								:user,
								:ipaddr,
								:vessel,
								:vin,
								:vout,
								:ukk1,
								:ukkold,
								:no_ukk_baru,
								:shipping,
								:etd,		
								:stack,		
								:id_req,
								:nocont,
								:kdbrg,
								:haz,
								:jnscont,
								:kdbrg2,
								:tipe,
								:status,
								:type_cancel,
								:custom_number,
								:emkl,
								:v_etd_lama,
								:v_msg); end;";
			
				// end procedure T009D
				
			// start procedure T3I
				$param_b_vart3i = array(
								"nc" => "1",
								"user" => "$user",
								"ipaddr" => "",
								"vessel" => "$vessel",
								"vin" => "$voyin",
								"vout" => "$voyout",
								"ukk1" => "$ukk_old",
								"ukkold" => "$ukk_old",
								"no_ukk_baru" => "$ukk_new",
								"shipping" => "$shipping",
								"etd" => "$vsbtgl",
								"stack" => "$tgl_stack",
								"id_req" => "$reqNoBiller",
								"nocont" => "$container",
								"kdbrg" => "$kd_brg",
								"haz" => "$hz",
								"jnscont" => "$jeniscont",
								"kdbrg2" => "$kd_brg",
								"tipe" => "$type",
								"status" => "$status",
								"type_cancel" => "$tipebm",
								"custom_number" => "",
								"emkl" => "$emkl",
								"v_msg" => ""
								);
				
				$sqlt3i = "declare v_msg varchar(1000); 
								begin PROC_ADD_BATAL_MUAT_BG_DEV( 
								:nc,
								:user,
								:ipaddr,
								:vessel,
								:vin,
								:vout,
								:ukk1,
								:ukkold,
								:no_ukk_baru,
								:shipping,
								:etd,		
								:stack,		
								:id_req,
								:nocont,
								:kdbrg,
								:haz,
								:jnscont,
								:kdbrg2,
								:tipe,
								:status,
								:type_cancel,
								:custom_number,
								:emkl,
								:v_msg); end;";
			
				// end procedure T3I
				
				// Start procedure ITOS Domestik
				$param_b_var = array(
								"nc" => "1",
								"user" => "$user",
								"ipaddr" => "",
								"vessel" => "$vessel",
								"vin" => "$voyin",
								"vout" => "$voyout",
								"ukk1" => "$ukk_old",
								"ukkold" => "$ukk_old",
								"no_ukk_baru" => "$ukk_new",
								"shipping" => "$shipping",
								"etd" => "$vsbtgl",
								"stack" => "$tgl_stack",
								"id_req" => "$reqNoBiller",
								"nocont" => "$container",
								"kdbrg" => "$kd_brg",
								"haz" => "$hz",
								"jnscont" => "$jeniscont",
								"kdbrg2" => "$kd_brg",
								"tipe" => "$type",
								"status" => "$status",
								"type_cancel" => "$tipebm",
								"custom_number" => "",
								"emkl" => "$emkl",
								"id_pod" => "$idpod",
								"v_msg" => ""
								);
								
				/*return "\"nc\" => \"1\",
								\"user\" => \"$user\",
								\"ipaddr\" => \"\",
								\"vessel\" => \"$vessel\",
								\"vin\" => \"$voyin\",
								\"vout\" => \"$voyout\",
								\"ukk1\" => \"$ukk_old\",
								\"ukkold\" => \"$ukk_old\",
								\"no_ukk_baru\" => \"$ukk_new\",
								\"shipping\" => \"$shipping\",
								\"etd\" => \"$vsbtgl\",
								\"stack\" => \"$tgl_stack\",
								\"id_req\" => \"$reqNoBiller\",
								\"nocont\" => \"$container\",
								\"kdbrg\" => \"$kd_brg\",
								\"haz\" => \"$hz\",
								\"jnscont\" => \"$jeniscont\",
								\"kdbrg2\" => \"$kd_brg\",
								\"tipe\" => \"$type\",
								\"status\" => \"$status\",
								\"type_cancel\" => \"$tipebm\",
								\"custom_number\" => \"\",
								\"emkl\" => \"$emkl\",
								\"id_pod\" => \"$idpod\",
								\"v_msg\" => \"\"";*/
				
				$sql = "declare v_msg varchar(1000); 
								begin PROC_ADD_BATAL_MUAT_BG_DEV_OL( 
								:nc,
								:user,
								:ipaddr,
								:vessel,
								:vin,
								:vout,
								:ukk1,
								:ukkold,
								:no_ukk_baru,
								:shipping,
								:etd,		
								:stack,		
								:id_req,
								:nocont,
								:kdbrg,
								:haz,
								:jnscont,
								:kdbrg2,
								:tipe,
								:status,
								:type_cancel,
								:custom_number,
								:emkl,
								:id_pod,
								:v_msg); end;";

			$param_b_var2 = array(
								"nc" => "$nc",
								"user" => "$user",
								"ipaddr" => "",
								"vessel" => "$vessel",
								"vin" => "$voyin",
								"vout" => "$voyout",
								"ukk1" => "$ukk_old",
								"ukkold" => "$ukk_old",
								"no_ukk_baru" => "$ukk_new",
								"shipping" => "$shipping",
								"vsbtgl" => "$vsbtgl",
								"tgl_del" => "$tgl_del",
								"id_req" => "$reqNoBiller",
								"nocont" => "$container",
								"kdbrg" => "$kd_brg",
								"haz" => "$hz",
								"jnscont" => "$jeniscont",
								"kdbrg2" => "$kd_brg",
								"tipe" => "$type",
								"status" => "$status",
								"type_cancel" => "$tipebm",
								"custom_number" => "",
								"emkl" => "$emkl",
								"v_msg" => ""
								);
		
			$sql2 = "declare v_msg varchar(1000); 
					begin proc_add_batal_muat( 
					:nc,
					:user,
					:ipaddr,
					:vessel,
					:vin,
					:vout,
					:ukk1,
					:ukkold,
					:no_ukk_baru,
					:shipping,
					to_date(:vsbtgl, 'DD-Mon-YY'),		
					to_date(:tgl_del, 'DD/MM/YY'),		
					:id_req,
					:nocont,
					:kdbrg,
					:haz,
					:jnscont,
					:kdbrg2,
					:tipe,
					:status,
					:type_cancel,
					:custom_number,
					:emkl,
					:v_msg); end;";
					
			// end procedure itos domestik
			
			
			try {
			
				if ($terminal_code == 'T3I'){
					if ($tipebm == 'CALDG'){
						if(!checkOriSQL($conn['ori']['billing'],$sql2,$query_,$err,$param_b_var2)) goto Err;
						$data = $param_b_var2['v_msg'];	
					} else {
						if(!checkOriSQL($conn['ori']['billing'],$sqlt3i,$query_,$err,$param_b_vart3i)) goto Err;
						$data = $param_b_vart3i['v_msg'];	
					}
				} else if ($terminal_code == 'T009D'){
					if ($tipebm == 'CALDG'){
						if(!checkOriSQL($conn['ori']['billing'],$sqlt009del,$query_,$err,$param_b_vart009del)) goto Err;
						$data = $param_b_vart009del['v_msg'];	
					} else {
						if(!checkOriSQL($conn['ori']['billing'],$sqlt009d,$query_,$err,$param_b_vart009d)) goto Err;
						$data = $param_b_vart009d['v_msg'];	
					}

				} else {
					if ($tipebm == 'CALDG'){
						if(!checkOriSQL($conn['ori']['billing'],$sql2,$query_,$err,$param_b_var2)) goto Err;
						$data = $param_b_var2['v_msg'];	
					} else {
						if(!checkOriSQL($conn['ori']['billing'],$sql,$query_,$err,$param_b_var)) goto Err;
						$data = $param_b_var['v_msg'];	
					}
				}
				
				//return $data;
				$out_data = array();
				$out_data['data']=$data;
			} 
			catch (Exception $e) {
					$err = $e->getMessage();
					goto Err;
			}
			
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


/* for testing only
				$query ="DECLARE 
						  V_COUNTER NUMBER;
						  V_ID_USER VARCHAR2(32767);
						  V_REMOTE_ADDRESS VARCHAR2(32767);
						  V_VESEL VARCHAR2(32767);
						  V_VIN VARCHAR2(32767);
						  V_VOUT VARCHAR2(32767);
						  V_NO_UKK VARCHAR2(32767);
						  V_NO_UKK_LAMA VARCHAR2(32767);
						  V_NO_UKK_BARU VARCHAR2(32767);
						  V_SHIPPING VARCHAR2(32767);
						  V_ETD DATE;
						  V_STACK DATE;
						  V_ID_REQ VARCHAR2(32767);
						  V_NO_CONT VARCHAR2(32767);
						  V_ID_BRG VARCHAR2(32767);
						  V_HZ VARCHAR2(32767);
						  V_JNS_CONT VARCHAR2(32767);
						  V_ID_CONT VARCHAR2(32767);
						  V_TIPE VARCHAR2(32767);
						  V_STATUS VARCHAR2(32767);
						  V_TYPE_CANCEL VARCHAR2(32767);
						  V_CUST_REF VARCHAR2(32767);
						  V_EMKL VARCHAR2(32767);
						  V_POD2 VARCHAR2(32767);
						  V_MSG VARCHAR2(32767);

						BEGIN 
						  V_COUNTER := 1;
						  V_ID_USER := '$user';
						  V_REMOTE_ADDRESS := '';
						  V_VESEL := '$vessel';
						  V_VIN := '$voyin';
						  V_VOUT := '$voyout';
						  V_NO_UKK := '$ukk_old';
						  V_NO_UKK_LAMA :='$ukk_old';
						  V_NO_UKK_BARU :='$ukk_new';
						  V_SHIPPING := '$shipping';
						  V_ETD := '$vsbtgl';
						  V_STACK := '$tgl_stack';
						  V_ID_REQ := '$reqNoBiller';
						  V_NO_CONT := '$container';
						  V_ID_BRG := '$kd_brg';
						  V_HZ := '$hz';
						  V_JNS_CONT := '$size'||'$type'||'$status';
						  V_ID_CONT := '$kd_brg';
						  V_TIPE := '$type';
						  V_STATUS := '$status';
						  V_TYPE_CANCEL := '$tipebm';
						  V_CUST_REF := '';
						  V_EMKL := '$emkl';
						  V_POD2 := '$idpod';
						  V_MSG := NULL;

						  ITOS_BILLING.PROC_ADD_BATAL_MUAT_BG_DEV ( V_COUNTER, V_ID_USER, V_REMOTE_ADDRESS, V_VESEL, V_VIN, V_VOUT, V_NO_UKK, V_NO_UKK_LAMA, V_NO_UKK_BARU, V_SHIPPING, V_ETD, V_STACK, V_ID_REQ, V_NO_CONT, V_ID_BRG, V_HZ, V_JNS_CONT, V_ID_CONT, V_TIPE, V_STATUS, V_TYPE_CANCEL, V_CUST_REF, V_EMKL, V_POD2, V_MSG );
						  COMMIT; 
						END; 
						";					
				
				//return $query;
								
				*/
				
?>