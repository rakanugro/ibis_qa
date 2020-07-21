<?php

/*|
 | Function Name 	: getVesselVoyage
 | Description 		: Get Vessel Voyage
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getOldRequestDelivery($in_param) {
	
	try {
        //check if all connections in connection collections is success, if found error/connection fail return false.
		//if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$norequest = $xml_data->data->old_noreq;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$customer_id = $xml_data->data->customer_id;
        
        $is_opus = false;
		
        /*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
        
        //SELECT CONNECTION
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conns = $conn['ori']['billing'];
        if($port_code=="IDJKT"&&$terminal_code=="T3I")
        {
            $is_opus =  true;
        }
        else if($port_code=="IDJKT"&&$terminal_code=="T3D")
        {
        }
        else if($port_code=="IDJKT"&&$terminal_code=="T2D")
        {
        }
        else if($port_code=="IDJKT"&&$terminal_code=="T1D")
        {
        }
        else if($port_code=="IDPNK"&&$terminal_code=="T3I")
        {
            $is_opus =  true;
        }
		 else if($port_code=="IDJKT"&&$terminal_code=="T009D")
        {
            $is_opus =  true;
        }
        
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get request info
		$oldrequest = array();
		
		//PL/SQL
        if ($is_opus){ $conditional_opus = "'N' "; } else { $conditional_opus = "''"; }
        
		$qOldDel = "SELECT  
                    ID_REQ, 
                    ID_REQ_OL,
                    TIPE_REQ TYPE_REQ, 
                    NVL(SP2P_KE,0) SP2P_NUMBER, 
                    NO_UKK ID_VSB_VOYAGE, 
                    VESSEL, 
                    CALL_SIGN VESSEL_CODE,
                    VOYAGE_IN, 
                    VOYAGE_OUT, 
                    ICUST_DSTN CUSTOMER_NUMBER, 
                    EMKL CUSTOMER_NAME,
                    ALAMAT ADDRESS, 
                    NPWP, 
                    STATUS, 
                    NO_DO, 
                    TGL_DO DATE_DO, 
                    JENIS_SPPB TYPE_SPPB, 
                    NO_SPPB, 
                    TGL_SPPB DATE_SPPB, 
                    SP_CUSTOM NO_SP_CUSTOM, 
                    TGL_SP_CUSTOM DATE_SP_CUSTOM, 
                    BL_NUMB NO_BL, 
                    TGL_SP2 DATE_DELIVERY, 
                    TGL_EXT DATE_EXT, 
                    $conditional_opus TL_FLAG
            FROM 
                    req_delivery_h a
            where 
                    (a.ID_REQ_OL LIKE '$norequest%' OR a.ID_REQ LIKE '$norequest%')
                    AND a.ICUST_DSTN = '$customer_id'
                    and a.STATUS IN ('P','T')
            ORDER BY 
                    A.TGL_REQUEST DESC";
        
        if(!checkOriSQL($conns,$qOldDel,$query_olddel,$err)) goto Err;
        
        //FETCH QUERY
        while ($row_olddel = oci_fetch_array($query_olddel, OCI_ASSOC))
        {
            //build "info" data
            $oldrequest_sub = array(
                'old_req' => $row_olddel[ID_REQ],
                'old_req_ol' => $row_olddel[ID_REQ_OL],
                'no_do' => $row_olddel[NO_DO],
                'date_do' => $row_olddel[DATE_DO],
                'type_sppb' => $row_olddel[TYPE_SPPB],
                'no_sppb' => $row_olddel[NO_SPPB],
                'date_sppb' => $row_olddel[DATE_SPPB],
                'no_sp_custom' => $row_olddel[NO_SP_CUSTOM],
                'date_sp_custom' => $row_olddel[DATE_SP_CUSTOM],
                'no_bl' => $row_olddel[NO_BL],
                'vessel_name' => $row_olddel[VESSEL],
                'voyage_in' => $row_olddel[VOYAGE_IN],
                'voyage_out' => $row_olddel[VOYAGE_OUT],
                'id_vsb_voyage' => $row_olddel[ID_VSB_VOYAGE],
                'vessel_code' => $row_olddel[VESSEL_CODE],
                'date_delivery' => $row_olddel[DATE_DELIVERY],
                'date_ext' => $row_olddel[TGL_EXT],
                'sp2p_number' => $row_olddel[SP2P_NUMBER],
                'tl_flag' => $row_olddel[TL_FLAG]
            );

            array_push($oldrequest, $oldrequest_sub);
        }
        

		$out_data = array();
		$out_data['old_req']=$oldrequest;

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