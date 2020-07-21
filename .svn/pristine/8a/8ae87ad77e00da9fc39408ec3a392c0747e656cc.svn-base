<?php

/*|
 | Function Name 	: requestReceivingDetail
 | Description 		: do Request Receiving Detail
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function requestReceivingDetail($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$request_no = $xml_data->data->detail->request_no;
		$container_no = $xml_data->data->detail->container_no;
		$size = $xml_data->data->detail->size;
		$type = $xml_data->data->detail->type;
		$status = $xml_data->data->detail->status;
		$height = $xml_data->data->detail->height;
		$weight = $xml_data->data->detail->weight;
		$operator = $xml_data->data->detail->operator;
		$dangerous = $xml_data->data->detail->dangerous;
		$imo = $xml_data->data->detail->imo;
		$un = $xml_data->data->detail->un;
		$temperature = $xml_data->data->detail->temperature;
		$excess_width = $xml_data->data->detail->excess_width;
		$excess_height = $xml_data->data->detail->excess_height;
		$excess_length = $xml_data->data->detail->excess_length;
		$trading_type = $xml_data->data->detail->trading_type;
		$carrier = $xml_data->data->detail->carrier;
		$commodity = $xml_data->data->detail->commodity;
		$tl_type = $xml_data->data->detail->tl_type;
		$nor = $xml_data->data->detail->nor;
		if($height==0)
		{
			$height ='OOG';
		}
		$port = $xml_data->data->detail->port;
		$port = explode("-",$port);
		$port_code=$port[0];
		$terminal_code=$port[1];
		if($height == 'OOG' && ($terminal_code == 'T3I' || $terminal_code == 'T009D')) {
			IF($type=='FLT') 
			{
				$height_param ='8.6';
			}
			else IF($type=='DRY')
			{
				$height_param ='8.6';
			}
			else
			{
				$height_param = '9.6';
			}
	
			$oog = '';
		}
		else if($height == 'OOG' && ($terminal_code == 'T1D' || $terminal_code == 'T2D' || $terminal_code == 'T3D')) {
			$height_param = ($tipe=='FLT') ? '8.6' : '9.6';
			$oog = $height;
		}
		else {
			$height_param = $height;
			$oog = '';
		}
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//select connection 
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);		

		//insert data
		//PL/SQL //biller
		$cek_iso = "select m.ISO_CODE from (select ISO_CODE from master_iso_code WHERE SIZE_='$size' AND TYPE_='$type' AND H_ISO='$height_param') m where rownum=1";
		if(!checkOriSQL($conn['ori']['billing'],$cek_iso,$query_iso,$err)) goto Err;
		if ($rowReqNum = oci_fetch_array($query_iso, OCI_ASSOC))
		{
			$iso=$rowReqNum["ISO_CODE"];
		}
		
		if($status == 'F'){
			$status = 'FCL';
		}
		else{
			$status = 'MTY';
		}
		
		if($tl_type=='Y'){
			$tl_type=='TL';
		}
		
		//$out_data = array();
		if($port_code=="IDJKT"&&$terminal_code=="T3I"){
		
			if($height=='OOG'){
				$height_param=$height;
			}
			$param_b_var = array(
					"v_nc" => "$container_no",
					"v_req" => "$request_no",
					"v_sc" => "$size",
					"v_tc" => "$type",
					"v_stc" => "$status",
					"v_hc" => "$dangerous",
					"v_comm" => "$commodity",
					"v_imo" => "$imo",
					"v_iso" => "$iso",
					"v_book" => "",
					"v_hgc" => "$height_param",
					"v_ship" => "$trading_type",
					"v_car" => "$carrier",
					"v_tmp" => "$temperature",
					"v_oh" => "$excess_height",
					"v_ow" => "$excess_width",
					"v_ol" => "$excess_length",
					"v_un" => "$un",
					"v_nor" => "$nor",
					"v_jns_keg" => "$tl_type",
					"v_oogs" => "$oog", //ask dama atau ardi perubahan parameter yg ada di procedure yg baru by gandul 3 Aug 2015 17:40 PM // DONE by WAHYU
					"v_berat" => "$weight", //ask dama atau ardi perubahan parameter yg ada di procedure yg baru by gandul 3 Aug 2015 17:40 PM
					"v_vgm" => "$weight", //ask penambahan parameter untuk weight vgm , sementara untuk demo menggunakan weight npe
					":v_msg" => ""
				);
			//RETURN json_encode($param_b_var).$height;
			$query_repo_anne = "declare begin proc_add_cont_anne(:v_nc,:v_req,:v_sc,:v_tc,:v_stc,:v_hc,:v_comm,:v_imo,:v_iso,:v_book,:v_hgc,:v_ship,:v_car,:v_tmp,:v_oh, :v_ow, :v_ol,:v_un,:v_nor,:v_berat,:v_vgm,:v_msg); end;";
		} 
		else if ($port_code=="IDJKT"&&$terminal_code=="T009D"){

				$param_b_var = array(
						"v_nc" => "$container_no",
						"v_req" => "$request_no",
						"v_sc" => "$size",
						"v_tc" => "$type",
						"v_stc" => "$status",
						"v_hc" => "$dangerous",
						"v_comm" => "$commodity",
						"v_imo" => "$imo",
						"v_iso" => "$iso",
						"v_book" => "",
						"v_hgc" => "$height_param",
						"v_ship" => "$trading_type",
						"v_car" => "$carrier",
						"v_temp" => "$temperature",
						"v_oh" => "$excess_height",
						"v_ow" => "$excess_widht",
						"v_ol" => "$excess_length",
						"v_unnumber" => "$un",
						"v_nor" => "$nor",
						"v_weightnpe" => "$weight",
						":v_msg" => ""
					);

				$query_repo_anne = "declare begin proc_add_cont_anne(:v_nc,:v_req,:v_sc,:v_tc,:v_stc,:v_hc,:v_comm,:v_imo,:v_iso,:v_book,:v_hgc,:v_ship,:v_car,:v_temp,:v_oh, :v_ow, :v_ol,:v_unnumber,:v_nor,:v_weightnpe,:v_msg); end;";
			
		
		}
		else
		{
			$param_b_var = array(
					"v_nc" => "$container_no",
					"v_req" => "$request_no",
					"v_sc" => "$size",
					"v_tc" => "$type",
					"v_stc" => "$status",
					"v_hc" => "$dangerous",
					"v_comm" => "$commodity",
					"v_imo" => "$imo",
					"v_iso" => "$iso",
					"v_book" => "",
					"v_hgc" => "$height_param",
					"v_ship" => "$trading_type",
					"v_car" => "$carrier",
					"v_tmp" => "$temperature",
					"v_oh" => "$excess_height",
					"v_ow" => "$excess_width",
					"v_ol" => "$excess_length",
					"v_un" => "$un",
					"v_nor" => "$nor",
					"v_jns_keg" => "$tl_type",
					"v_oogs" => "$oog", //ask dama atau ardi perubahan parameter yg ada di procedure yg baru by gandul 3 Aug 2015 17:40 PM // DONE by WAHYU
					"v_berat" => "", //ask dama atau ardi perubahan parameter yg ada di procedure yg baru by gandul 3 Aug 2015 17:40 PM
					":v_msg" => ""
				);

			$query_repo_anne = "declare begin proc_add_cont_anne(:v_nc,:v_req,:v_sc,:v_tc,:v_stc,:v_hc,:v_comm,:v_imo,:v_iso,:v_book,:v_hgc,:v_ship,:v_car,:v_tmp,:v_oh, :v_ow, :v_ol,:v_un,:v_nor,:v_jns_keg,:v_oogs,:v_berat,:v_msg); end;";
		}
		
		
		// cek booking limit 
		if ($port_code=="IDJKT"&&$terminal_code=="T009D"){
		
			$query_cek_limit = "select CONTAINER_LIMIT from M_VSB_VOYAGE@dbint_link where id_vsb_voyage=(SELECT NO_UKK FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))";
			if(!checkOriSQL($conn['ori']['billing'],$query_cek_limit,$cek_limit,$err)) goto Err;
			if ($ceklimit = oci_fetch_array($cek_limit, OCI_ASSOC))
			{
				$cont_limit=$ceklimit["CONTAINER_LIMIT"];
			}
			
			$query_cek_row = "/* Formatted on 9/7/2015 4:12:12 PM (QP5 v5.163.1008.3004) */
			SELECT ( (SELECT COUNT (1)
						FROM M_CYC_CONTAINER@dbint_link a, M_VSB_VOYAGE@dbint_link b
					   WHERE     a.VESSEL = b.VESSEL
							 AND a.VOYAGE_IN = b.VOYAGE_IN
							 AND a.VOYAGE_OUT = b.VOYAGE_OUT
							 AND a.VESSEL = (SELECT VESSEL FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))
							 AND a.VOYAGE_IN = (SELECT VOYAGE_IN FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))
							 AND a.VOYAGE_OUT = (SELECT VOYAGE_OUT FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))
							 AND a.E_I = 'E'
							 AND a.SIZE_CONT = '20')
					+ (SELECT COUNT (1)*2
						 FROM M_CYC_CONTAINER@dbint_link a, M_VSB_VOYAGE@dbint_link b
						WHERE     a.VESSEL = b.VESSEL
							  AND a.VOYAGE_IN = b.VOYAGE_IN
							  AND a.VOYAGE_OUT = b.VOYAGE_OUT
							  AND a.VESSEL = (SELECT VESSEL FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))
							 AND a.VOYAGE_IN = (SELECT VOYAGE_IN FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))
							 AND a.VOYAGE_OUT = (SELECT VOYAGE_OUT FROM REQ_RECEIVING_H WHERE TRIM(ID_REQ) = TRIM('$request_no'))
							  AND a.E_I = 'E'
							  AND a.SIZE_CONT IN ('40','45'))) JUMLAH
			  FROM DUAL";
			  
			if(!checkOriSQL($conn['ori']['billing'],$query_cek_row,$cek_row,$err)) goto Err;
			if ($row = oci_fetch_array($cek_row, OCI_ASSOC))
				{
					$jumlah_row=$row["JUMLAH"];
				}
			
			if(($cont_limit > $jumlah_row) or empty($cont_limit)){
			
				if(!checkOriSQL($conn['ori']['billing'],$query_repo_anne,$queryrepo,$err,$param_b_var)) goto Err;
		
				if ($param_b_var[':v_msg'] == 'OK1'){
					$out_data = "OK";
				} else {
					$out_data = "NOT.".$param_b_var[':v_msg'];
				} 
				
			} else {
			
				$out_data = "container sudah mencapai limit booking";
				
			}
			
		} else {
			
			if(!checkOriSQL($conn['ori']['billing'],$query_repo_anne,$queryrepo,$err,$param_b_var)) goto Err;
		
			if ($param_b_var[':v_msg'] == 'OK1'){
				$out_data = "OK";
			} else {
				$out_data = "NOT.".$param_b_var[':v_msg'];
			} 
			
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
		//return generateResponse($out_data . ' ' . json_encode($param_b_var) . ' ' . $cek_iso, $out_status, $err, "json");
		return generateResponse($out_data, $out_status, $err, "json");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS";
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "json");
		//return generateResponse($out_data . ' ' . json_encode($param_b_var) . ' ' . $cek_iso, $out_status, $out_message, "json");
}

?>