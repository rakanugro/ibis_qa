<?php

/*|
 | Function Name 	: createRequestDeliveryPerp
 | Description 		: Create a header for Request Delivery Extension
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function createRequestDeliveryPerp($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		//$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		//if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$old_noreq = $xml_data->data->old_noreq;
		$tgl_perp = $xml_data->data->tgl_perp;
		$no_bl=$xml_data->data->no_bl;
		$no_do=$xml_data->data->no_do;
		$tgl_do=$xml_data->data->tgl_do;
		$no_sppb=$xml_data->data->no_sppb;
		$no_sp_custom=$xml_data->data->no_sp_custom;
		$sp2p_number=$xml_data->data->sp2p_number;
		$sppb_date=$xml_data->data->sppb_date;
		$sp_custom_date=$xml_data->data->sp_custom_date;
		$id_user=$xml_data->data->id_user;
        
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
        
        $details_cont = "";
        $temp_check = json_decode($xml_data->data->checked);
        for($i=0;$i<count($temp_check)-1;$i++){
            if ($i == 0){
                $details_cont = $details_cont. "'" .$temp_check[$i]. "'";
            } else {
                $details_cont = $details_cont. ", '" .$temp_check[$i]. "'";
            }
        }
        if (count($temp_check) ==  1){
            $details_cont = $details_cont. "'" .$temp_check[$i]. "'";
        } else {
            $details_cont = $details_cont. ", '" .$temp_check[$i]. "'";
        }
        

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$container = array();
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL
        
        //return $port_code .'---'. $terminal_code;

		//select connection
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
            $conn['ori'] = oriDb("IDJKT_T3I");
			$conn['container'][0] = $conn['ori']['billing_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['ori'] = oriDb("IDJKT_T3D");
			$conn['container'][0] = $conn['ori']['billing_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['ori'] = oriDb("IDJKT_T2D");
			$conn['container'][0] = $conn['ori']['billing_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['ori'] = oriDb("IDJKT_T1D");
			$conn['container'][0] = $conn['ori']['billing_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['ori'] = oriDb("IDPNK_T3I");
			$conn['container'][0] = $conn['ori']['billing_idpnk_t3i'];
		}
        
        //tambah koneksi ibis ke group
		$conn['ori'] += oriDb("IBIS");
		
        
        /************ Saving request ***********/
        if($request_no=="")
		{
            //generate no request eservice
            $query_numbering = "BEGIN ef_get_request_number (
                'SP2',
                'OL',
                '',
                :out_message
            ); END;";
            
            $bind_param = array(
                ':out_message' => ''
            );
            if(!checkOriSQL($conn['ori']['ibis'],$query_numbering,$query_numbering_,$err,$debug,$bind_param)) goto Err;
            $request_no = $bind_param[':out_message'];
            
            // PL/SQL
            // Terpaksa diputuskan tidak menggunakan query dari 
            // proc_create_delivery_per karena logikanya sesat
            // ===== Penjelasan =====
            // proc_create_delivery_per berfungsi mengisi detail dengan semua container dari SP2 walaupun belum pasti diperpanjang
            // kemudian detailnya didelete manual dengan php jika di formnya tidak dicentang
            // barulah kemudian dieksekusilah proc_delivery_d
            $createRequest = "INSERT INTO REQ_DELIVERY_H (
                    ID_REQ,
                    TIPE_REQ,
                    SP2P_KE,
                    OLD_REQ,
                    NO_UKK,
                    VESSEL,
                    CALL_SIGN,
                    VOYAGE_IN,
                    VOYAGE_OUT,
                    ICUST_DSTN,
                    EMKL,
                    ALAMAT,
                    NPWP,
                    STATUS,
                    NO_DO,
                    TGL_DO,
                    JENIS_SPPB,
                    NO_SPPB,
                    TGL_SPPB,
                    SP_CUSTOM,
                    TGL_SP_CUSTOM,
                    BL_NUMB,
                    TGL_SP2,
                    TGL_EXT,
                    TGL_OLD_DEL,
                    DISCH_DATE,
                    TGL_REQUEST,
                    ID_USER,
                    QTY,
                    KETERANGAN,
                    IS_EDIT
                )
                    SELECT 
                        '$request_no',
                         'EXT',
                         $sp2p_number+1,
                         ID_REQ,
                         NO_UKK,
                         VESSEL,
                         CALL_SIGN,
                         VOYAGE_IN,
                         VOYAGE_OUT,
                         ICUST_DSTN,
                         EMKL,
                         ALAMAT,
                         NPWP,
                         'S',
                         '$no_do',
                         TO_DATE('$tgl_do','dd-mm-yyyy'),
                         JENIS_SPPB,
                         '$no_sppb',
                         TO_DATE('$sppb_date','dd-mm-yyyy'),
                         '$no_sp_custom',
                         TO_DATE('$sp_custom_date','dd-mm-yyyy'),
                         '$no_bl',
                         TGL_SP2,
                         TO_DATE('$tgl_perp', 'dd-mm-yyyy'),
                         TGL_OLD_DEL,
                         DISCH_DATE,
                         SYSDATE,
                         '$id_user',
                         '',
                         '',
                         '' 
                     FROM REQ_DELIVERY_H 
                     WHERE ID_REQ = '$old_noreq'";

            //QUERY
            if(!checkOriSQL($conn['container'][0],$createRequest,$query_request,$err,$debug)) goto Err;
            
            // get Biller Request Id
            $getReqNum = "SELECT MAX(ID_REQ) ID_REQ FROM REQ_DELIVERY_H WHERE ID_REQ LIKE 'SP2%'";
        
            if(!checkOriSQL($conn['container'][0],$getReqNum,$queryReqNum,$err,$debug)) goto Err;
                
            //FETCH QUERY
            if ($rowReqNum = oci_fetch_array($queryReqNum, OCI_ASSOC)){
                $biller_request_no=$rowReqNum["ID_REQ"];
            }
            
            //update remark
            $query = "update REQ_DELIVERY_H set id_req_ol = '$request_no' where id_req = '$biller_request_no'";
            if(!checkOriSQL($conn['container'][0],$query,$query_,$err,$debug,$bind_param)) goto Err;
            
            // create details
            //QUERY
            $createDetails = "INSERT INTO req_delivery_d (NO_REQ_DEV,
                                        NO_CONTAINER,
                                        SIZE_CONT,
                                        TYPE_CONT,
                                        STATUS_CONT,
                                        HZ,
                                        KD_COMODITY,
                                        IMO_CLASS,
                                        NO_UKK,
                                        ID_CONT,
                                        VESSEL,
                                        VOYAGE,
                                        START_WORK,
                                        TGL_START_STACK,
                                        TGL_END_STACK,
                                        TGL_DELIVERY,
                                        PLUG_IN,
                                        PLUG_OUT)
               SELECT '$biller_request_no',
                      d.no_container,
                      d.SIZE_CONT,
                      d.TYPE_CONT,
                      d.STATUS_CONT,
                      d.HZ,
                      d.KD_COMODITY,
                      d.IMO_CLASS,
                      d.NO_UKK,
                      d.ID_CONT,
                      d.VESSEL,
                      d.VOYAGE,
                      d.START_WORK,
                      d.START_WORK,
                      TO_DATE ('$tgl_perp', 'dd-mm-yy hh24:mi'),
                      TO_DATE ('$tgl_perp', 'dd-mm-yy hh24:mi'),
                      d.PLUG_IN,
                      d.PLUG_OUT
                 FROM req_delivery_d d
                WHERE no_req_dev = '$old_noreq'
                      AND no_container IN ($details_cont)";
                      //return $createDetails;
            if(!checkOriSQL($conn['container'][0],$createDetails,$query_details,$err,$debug)) goto Err;
            
            // get data for Transaction Log
            $getDataRequest = "SELECT 
                 ICUST_DSTN,
                 EMKL,
                 ALAMAT,
                 NPWP,
                 NO_UKK,
                 VESSEL,
                 CALL_SIGN,
                 VOYAGE_IN,
                 VOYAGE_OUT,
                 SP2P_KE
             FROM REQ_DELIVERY_H 
             WHERE ID_REQ = '$old_noreq'";
        
            if(!checkOriSQL($conn['container'][0],$getDataRequest,$queryDataRequest,$err,$debug)) goto Err;
                
            //FETCH QUERY
            if ($rowDataRequest = oci_fetch_array($queryDataRequest, OCI_ASSOC)){
                $customer_id=$rowDataRequest["ICUST_DSTN"];
                $customer_name=$rowDataRequest["EMKL"];
                $address=$rowDataRequest["ALAMAT"];
                $npwp=$rowDataRequest["NPWP"];
                $ukk=$rowDataRequest["NO_UKK"];
                $vessel=$rowDataRequest["VESSEL"];
                $voyage_in=$rowDataRequest["VOYAGE_IN"];
                $voyage_out=$rowDataRequest["VOYAGE_OUT"];
                $kes=$rowDataRequest["SP2P_KE"]+1;
                
                // insert Transaction Log
                $query = "insert into transaction_log (
                    REQUEST_ID,BILLER_REQUEST_ID,KODE_MODUL,MODUL_DESC,PORT_ID,TERMINAL_ID,STATUS_REQ
                    ,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID
                    ,CUSTOM_NUMBER1,CUSTOM_NUMBER2,ADDITIONAL_FIELD1,ADDITIONAL_FIELD2,ADDITIONAL_FIELD3
                    ,REQUEST_DATE,REQUEST_BY,PRF_NUMBER,PRF_DATE,TRX_NUMBER,TRX_DATE
                    ,PAYMENT_BY,PAYMENT_DATE,PAYMENT_STATUS,PAYMENT_CHANNEL,NO_UKK, 
                    VESSEL, VOYAGE_IN, VOYAGE_OUT, ADDITIONAL_DATE 
                    )
                values
                (TRIM('$request_no'), TRIM('$biller_request_no'), 'PTKM07','PERPANJANGAN DELIVERY'
                    ,'$port_code', '$terminal_code', 'N','$customer_id', '$customer_name', '$address', '$npwp'
                    ,'$no_sppb', '', '$no_do','' ,'',SYSDATE, '$id_user', '' , '', '' ,'','', '', '', ''
                    ,'$ukk','$vessel','$voyage_in','$voyage_out', TO_DATE('$tgl_perp','DD-MM-YYYY')
                )";
                
                if(!checkOriSQL($conn['ori']['ibis'],$query,$query_,$err,$debug)) goto Err;
                
                // execute proc_delivery_d
                $bind_param_proc_d = array(
                    ':v_ukk' => "$ukk",
                    ':v_iemkl' => "$customer_id",
                    ':v_ipod' => "$pod",
                    ':v_ipol' => "IDJKT",
                    ':v_ship' => "$trading_type",
                    ':v_npe' => "$npe_no", 
                    ':v_peb' => "$peb_no",
                    ':v_user' => "$id_user",
                    ':v_bookship' => "$booking_ship_no",
                    ':v_car' => "IDJKT",
                    ':v_start_shift' => "$start_shift",
                    ':v_end_shift' => "$end_shift",
                    ':v_jml_shift' => "1",
                    ':v_fipod' => "$fpod",
                    ':v_no_req' => "",
                    ':v_msg' => ""
                );
                $query_proc_d = "begin proc_delivery_d('$biller_request_no','$old_noreq', '$kes'); end;";
                if(!checkOriSQL($conn['container'][0],$query_proc_d,$query_proc_d_,$err,$debug,$bind_param_proc_d)) goto Err;
            }
        }
				
		$out_data = array();
		$out_data['info']="OK,$request_no";
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