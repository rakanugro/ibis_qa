<?php

/*|
 | Function Name 	: getListContainer
 | Description 		: Get List Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getListRequestBMCompressed($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("IBIS");
		$conn['ori'] += oriDb("BILLING");
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$agent_id = $xml_data->data->agent_id;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$infos = array();
		//get container info
		//PL/SQL
	
		
		$getrequestlist = "SELECT * 
FROM (SELECT BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID,REQUEST_ID, CASE WHEN MODUL_DESC = 'CALBG' THEN 'BEFORE GATEIN' 
					WHEN MODUL_DESC = 'CALAG' THEN 'AFTER GATEIN' 
					WHEN MODUL_DESC = 'CALDG' THEN 'DELIVERY' END TIPEBM,VESSEL, VOYAGE_IN, VOYAGE_OUT, STATUS_REQ, REQUEST_DATE TGL_REQ, REJECT_NOTES FROM TRANSACTION_LOG WHERE KODE_MODUL = 'PTKM08' and customer_id = '$agent_id' and status_REQ in ('','N','R') ORDER BY REQUEST_DATE DESC) data_ 
WHERE rownum <= 100  
ORDER BY rownum";
		//return $getContlist;
		if(!checkOriSQL($conn['ori']['ibis'],$getrequestlist,$requestlist,$err)) goto Err;
			//FETCH QUERY
			
		while ($row_req = oci_fetch_array($requestlist, OCI_ASSOC))
			{
					
					$biller = $row_req[BILLER_REQUEST_ID];
					$port_code=$row_req[PORT_ID];
					$terminal_code=$row_req[TERMINAL_ID];
					
					if($port_code=="IDJKT"&&$terminal_code=="T3I")
					{
						$conn['billing'][0] = $conn['ori']['billing_idjkt_t3i'];
					}
					else if($port_code=="IDJKT"&&$terminal_code=="T3D")
					{
						$conn['billing'][0] = $conn['ori']['billing_idjkt_t3d'];			
					}
					else if($port_code=="IDJKT"&&$terminal_code=="T2D")
					{
						$conn['billing'][0] = $conn['ori']['billing_idjkt_t2d'];
					}
					else if($port_code=="IDJKT"&&$terminal_code=="T1D")
					{
						$conn['billing'][0] = $conn['ori']['billing_idjkt_t1d'];
					}
					else if($port_code=="IDPNK"&&$terminal_code=="T3I")
					{
						$conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];
					}
					else if($port_code=="IDJKT"&&$terminal_code=="T009D")
					{
						$conn['billing'][0] = $conn['ori']['billing_idjkt_t009d'];
					}
					else if($port_code=="IDJKT"&&$terminal_code=="ITOST")
					{
						$conn['billing'][0] = $conn['ori']['billing_idjkt_itost'];
						$conn['container'][0] = $conn['ori']['container_idjkt_itost'];			
					}
					
				
				if 	($terminal_code=="T009D"){
				
					$queryqty = "SELECT COUNT(1) JML FROM REQ_BATALMUAT_D WHERE ID_REQ = '$biller'";
					//return $getqty;
					if(!checkOriSQL($conn['billing'][0],$queryqty,$getqty,$err)) goto Err;
					if ($rowqty = oci_fetch_array($getqty, OCI_ASSOC))
					{
						$jml=$rowqty["JML"];
					}
		
				} else {
				
					$queryqty = "SELECT COUNT(1) JML FROM TB_BATALMUAT_D WHERE ID_BATALMUAT = '$biller'";
					//return $getqty;
					if(!checkOriSQL($conn['billing'][0],$queryqty,$getqty,$err)) goto Err;
					if ($rowqty = oci_fetch_array($getqty, OCI_ASSOC))
					{
						$jml=$rowqty["JML"];
					}
					
				}
				
				
				$info = array(
										'no_request' => $row_req[REQUEST_ID],
										'tipebm' => $row_req[TIPEBM],
										'vessel' => $row_req[VESSEL],
										'voyin' => $row_req[VOYAGE_IN],
										'voyout' => $row_req[VOYAGE_OUT],
										'jml_cont' => $jml,
										'tgl_req' => $row_req[TGL_REQ],
										'terminal_id' => $row_req[TERMINAL_ID],
										'port_id' => $row_req[PORT_ID],
										'statusreq' => $row_req[STATUS_REQ],
										'reject_notes' => $row_req[REJECT_NOTES]
							);
							
				array_push($infos, $info);
			}

			
		$out_data = array();
		$out_data['listrequest']=$infos;

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