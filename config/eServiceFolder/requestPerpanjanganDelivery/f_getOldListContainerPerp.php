<?php

/*|
 | Function Name 	: getOldListContainer
 | Description 		: Get List Container from old request
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getOldListContainerPerp($in_param) {
	
	try {
		//check if all connections in connection collections is success, if found error/connection fail return false.
		//if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$id_req = $xml_data->data->id_req;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		
        /*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
        
        $is_opus = false;
        
        //SELECT CONNECTION
        if($port_code=="IDJKT"&&$terminal_code=="T3I")
        {
            $conn['ori'] = oriDb("IDJKT_T3I");
            $conns = $conn['ori']['billing_idjkt_t3i'];
            $is_opus = true;
        }
        else if($port_code=="IDJKT"&&$terminal_code=="T3D")
        {
            $conn['ori'] = oriDb("IDJKT_T3D");
            $conns = $conn['ori']['billing_idjkt_t3d'];			
        }
        else if($port_code=="IDJKT"&&$terminal_code=="T2D")
        {
            $conn['ori'] = oriDb("IDJKT_T2D");
            $conns = $conn['ori']['billing_idjkt_t2d'];
        }
        else if($port_code=="IDJKT"&&$terminal_code=="T1D")
        {
            $conn['ori'] = oriDb("IDJKT_T1D");
            $conns = $conn['ori']['billing_idjkt_t1d'];
        }
        else if($port_code=="IDPNK"&&$terminal_code=="T3I")
        {
            $conn['ori'] = oriDb("IDPNK_T3I");
            $conns = $conn['ori']['billing_idpnk_t3i'];	
            $is_opus = true;            
        } else if($port_code=="IDJKT"&&$terminal_code=="T009D")
        {
            $conn['ori'] = oriDb("IDJKT_T009D");
            $conns = $conn['ori']['billing_idjkt_t009d'];
        }
        
        // $conn['ori'] = oriDb("IDJKT_T1D");
		// $conns = $conn['ori']['billing_idjkt_t1d'];
        
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
        // get list container
        if($is_opus) {
            $qListCont = "SELECT b.NO_CONTAINER,
                   b.SIZE_CONT,
                   '' COMMD,
                   b.TYPE_CONT,
                   b.STATUS_CONT,
                   b.HZ,
                   '-' CARRIER,
                   '-' HEIGHT,
                   b.VESSEL,
                   b.VOYAGE,
                   b.NO_REQ_DEV,
                   TO_CHAR (b.PLUG_IN, 'dd-mm-yyyy hh24:mi') PLUG_IN,
                   TO_CHAR (b.PLUG_OUT, 'dd-mm-yyyy hh24:mi') PLUG_OUT,
                   TO_CHAR (b.PLUG_OUT_EXT, 'dd-mm-yyyy hh24:mi') PLUG_OUT_EXT,
                   b.no_ukk,
				   b.VESSEL_CODE
              FROM req_delivery_h z
              LEFT JOIN req_delivery_d b on (trim(z.ID_REQ) = trim(b.NO_REQ_DEV))
			  WHERE z.ID_REQ_OL = '$id_req'";
        } else if($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$qListCont = "SELECT b.NO_CONTAINER,
                   b.SIZE_CONT,
                   '' COMMD,
                   b.TYPE_CONT,
                   b.STATUS_CONT,
                   b.HZ,
                   '-' CARRIER,
                   '-' HEIGHT,
                   b.VESSEL,
                   b.VOYAGE_IN VOYAGE,
                   b.ID_REQ NO_REQ_DEV,
                   TO_CHAR (b.PLUG_IN, 'dd-mm-yyyy hh24:mi') PLUG_IN,
                   TO_CHAR (b.PLUG_OUT, 'dd-mm-yyyy hh24:mi') PLUG_OUT,
                   TO_CHAR (b.PLUG_OUT_EXT, 'dd-mm-yyyy hh24:mi') PLUG_OUT_EXT,
                   b.no_ukk,
				   b.VESSEL_CODE
              FROM req_delivery_h z
			   LEFT JOIN req_delivery_d b on (trim(z.ID_REQ) = trim(b.ID_REQ))
             WHERE b.ID_REQ_OL = '$id_req'";
		}else {
            $qListCont = "SELECT b.NO_CONTAINER,
                   b.SIZE_CONT,
                   '' COMMD,
                   b.TYPE_CONT,
                   b.STATUS_CONT,
                   b.HZ,
                   c.id_operator CARRIER,
                   c.cont_height HEIGHT,
                   b.VESSEL,
                   b.VOYAGE,
                   b.NO_REQ_DEV,
                   TO_CHAR (b.PLUG_IN, 'dd-mm-yyyy hh24:mi') PLUG_IN,
                   TO_CHAR (b.PLUG_OUT, 'dd-mm-yyyy hh24:mi') PLUG_OUT,
                   TO_CHAR (b.PLUG_OUT_EXT, 'dd-mm-yyyy hh24:mi') PLUG_OUT_EXT,
                     b.no_ukk,
					 b.VESSEL_CODE,
                  c.op_status_desc
              FROM req_delivery_h z
              LEFT JOIN req_delivery_d b on (trim(z.ID_REQ) = trim(b.NO_REQ_DEV))
                LEFT JOIN itos_repo.m_vsb_voyage v on (b.no_ukk = v.id_vsb_voyage)
                LEFT JOIN itos_op.con_listcont c on (b.no_container = c.no_container and v.ukks = c.id_ves_voyage and c.id_class_code = 'I')
             WHERE z.ID_REQ_OL = '$id_req'";
        }
         
        if(!checkOriSQL($conns,$qListCont,$query_listcont,$err)) goto Err;
        
        //FETCH QUERY
		$listcont = array();
        while ($row_listcont = oci_fetch_array($query_listcont, OCI_ASSOC))
        {
            //build "listcont" data
            $row_listcont_sub = array(
                'no_container' => $row_listcont[NO_CONTAINER],
                'size_cont' => $row_listcont[SIZE_CONT],
                'commd' => $row_listcont[COMMD],
                'type_cont' => $row_listcont[TYPE_CONT],
                'status_cont' => $row_listcont[STATUS_CONT],
                'hz' => $row_listcont[HZ],
                'height' => $row_listcont[HEIGHT],
                'carrier' => $row_listcont[CARRIER],
                'vessel' => $row_listcont[VESSEL],
                'voyage' => $row_listcont[VOYAGE],
                'no_req_dev' => $row_listcont[NO_REQ_DEV],
                'plug_in' => $row_listcont[PLUG_IN],
                'plug_out' => $row_listcont[PLUG_OUT],
                'plug_out_ext' => $row_listcont[PLUG_OUT_EXT],
                'no_ukk' => $row_listcont[NO_UKK],
                'op_status_desc' => $row_listcont[OP_STATUS_DESC],
				'vessel_code' => $row_listcont[VESSEL_CODE]
            );

            array_push($listcont, $row_listcont_sub);
        }
		

		$out_data = array();
        $out_data['list_cont']=$listcont;

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