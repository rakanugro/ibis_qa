<?php

/*|
 | Function Name 	: getRequestDelivery
 | Description 		: Get Request Delivery
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getRequestDelivery($in_param) {
	try {
		$request = array();
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$request_id = $xml_data->data->request_id;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//select connection
		$conn['ori'] = oriDb('BILLING_'.$port_code.'_'.$terminal_code);
		$conn['ori'] += oriDb("IBIS");		

		//SELECT PL/SQL
		if ($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$getRequest = "SELECT ID_REQ , 
							NO_UKK ID_VES_VOYAGE , VESSEL , CALL_SIGN VESSEL_CODE , CALL_SIGN , VOYAGE_IN , 
							VOYAGE_OUT , ICUST_DSTN CUSTOMER_ID , EMKL CUSTOMER_NAME , ALAMAT ADDRESS , NPWP , NO_DO , 
							TO_CHAR(TGL_DO,'dd-mm-yyyy') DATE_DO , TIPE_REQ TYPE_SPPB , NO_SPPB , 
							TO_CHAR(TGL_SPPB,'dd-mm-yyyy') DATE_SPPB , SP_CUSTOM NO_SP_CUSTOM , 
							TO_CHAR(TGL_SP_CUSTOM,'dd-mm-yyyy') DATE_SP_CUSTOM , BL_NUMB NO_BL, 
							TO_CHAR(TGL_SP2,'dd-mm-yyyy') DATE_DELIVERY, TO_CHAR(DISCH_DATE,'dd-mm-yyyy') DATE_DISCHARGE , 
							TO_CHAR(TGL_REQUEST,'dd-mm-yyyy') DATE_REQUEST , ID_USER, '' VOYAGE FROM REQ_DELIVERY_H 
							WHERE ID_REQ='$request_id'";
		} else if ($port_code=="IDJKT"&&$terminal_code=="T009D"){
		
			$getRequest = "SELECT a.ID_REQ , 
							a.NO_UKK ID_VES_VOYAGE , a.VESSEL , a.VESSEL_CODE , a.CALL_SIGN , a.VOYAGE_IN , 
							a.VOYAGE_OUT , a.ICUST_DSTN CUSTOMER_ID , a.EMKL CUSTOMER_NAME , a.ALAMAT ADDRESS , a.NPWP , a.NO_DO , 
							TO_CHAR(a.TGL_DO,'dd-mm-yyyy') DATE_DO , a.TIPE_REQ TYPE_SPPB , a.NO_SPPB , 
							TO_CHAR(a.TGL_SPPB,'dd-mm-yyyy') DATE_SPPB , a.SP_CUSTOM NO_SP_CUSTOM , 
							TO_CHAR(a.TGL_SP_CUSTOM,'dd-mm-yyyy') DATE_SP_CUSTOM , a.BL_NUMB NO_BL, 
							TO_CHAR(a.TGL_SP2,'dd-mm-yyyy') DATE_DELIVERY, TO_CHAR(a.DISCH_DATE,'dd-mm-yyyy') DATE_DISCHARGE , 
							TO_CHAR(a.TGL_REQUEST,'dd-mm-yyyy') DATE_REQUEST , a.ID_USER,
							(SELECT b.VOYAGE FROM M_VSB_VOYAGE@dbint_link b WHERE b.VESSEL = a.VESSEL AND a.VOYAGE_IN = b.VOYAGE_IN AND a.VOYAGE_OUT = b.VOYAGE_OUT) VOYAGE FROM REQ_DELIVERY_H a
							WHERE ID_REQ='$request_id'";
		}
		else		
		{
			$getRequest = "SELECT ID_REQ , 
							NO_UKK ID_VES_VOYAGE , VESSEL , CALL_SIGN VESSEL_CODE , CALL_SIGN , VOYAGE_IN , 
							VOYAGE_OUT , ICUST_DSTN CUSTOMER_ID , EMKL CUSTOMER_NAME , ALAMAT ADDRESS , NPWP , NO_DO , 
							TO_CHAR(TGL_DO,'dd-mm-yyyy') DATE_DO , TIPE_REQ TYPE_SPPB , NO_SPPB , 
							TO_CHAR(TGL_SPPB,'dd-mm-yyyy') DATE_SPPB , SP_CUSTOM NO_SP_CUSTOM , 
							TO_CHAR(TGL_SP_CUSTOM,'dd-mm-yyyy') DATE_SP_CUSTOM , BL_NUMB NO_BL, 
							TO_CHAR(TGL_SP2,'dd-mm-yyyy') DATE_DELIVERY, TO_CHAR(DISCH_DATE,'dd-mm-yyyy') DATE_DISCHARGE , 
							TO_CHAR(TGL_REQUEST,'dd-mm-yyyy') DATE_REQUEST , ID_USER, TL_FLAG FROM REQ_DELIVERY_H 
							WHERE ID_REQ='$request_id'";			
		}
		
		//START QUERY
		if(!checkOriSQL($conn['ori']['billing'],$getRequest,$query_request,$err)) goto Err;
		//FETCH QUERY
		while ($row_request = oci_fetch_array($query_request, OCI_ASSOC))
		{						
		
			$query_term = "SELECT TERMINAL_NAME FROM MST_TERMINAL WHERE PORT = '$port_code' AND TERMINAL = '$terminal_code' AND ACTIVE = 'Y'";
			if(!checkOriSQL($conn['ori']['ibis'] ,$query_term,$getterm,$err)) goto Err; 
			while($row2 = oci_fetch_array($getterm, OCI_ASSOC))
			{
				$term_name = $row2[TERMINAL_NAME];
				
			}
			//build "info" data
			$request_sub = array(
			  'id_req' => $row_request[ID_REQ],          
			  'id_ves_voyage' => $row_request[ID_VES_VOYAGE],      
			  'vessel' => $row_request[VESSEL],   
			  'vessel_code' => $row_request[VESSEL_CODE],       
			  'call_sign' => $row_request[CALL_SIGN], 
			  'voyage_in' => $row_request[VOYAGE_IN],        
			  'voyage_out' => $row_request[VOYAGE_OUT],   
			  'customer_id' => $row_request[CUSTOMER_ID],     
			  'customer_name' => $row_request[CUSTOMER_NAME],     
			  'address' => $row_request[ADDRESS],   
			  'npwp' => $row_request[NPWP],    
			  'no_do' => $row_request[NO_DO],         
			  'date_do' => $row_request[DATE_DO],       
			  'type_sppb' => $row_request[TYPE_SPPB],     
			  'no_sppb' => $row_request[NO_SPPB],       
			  'date_sppb' => $row_request[DATE_SPPB],     
			  'no_sp_custom' => $row_request[NO_SP_CUSTOM],  
			  'date_sp_custom' => $row_request[DATE_SP_CUSTOM],
			  'no_bl' => $row_request[NO_BL],
			  'date_delivery' => $row_request[DATE_DELIVERY], 
			  'date_discharge' => $row_request[DATE_DISCHARGE], 
			  'date_request' => $row_request[DATE_REQUEST],         
			  'id_user' => $row_request[ID_USER],       
			  'tl_flag' => $row_request[TL_FLAG],
			  'term_name' => $term_name,
			   'voyage' => $row_request[VOYAGE]
			);
			array_push($request, $request_sub);
		}		
		
		//OUTPUT
		$out_data = array();
		$out_data['request']=$request;
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