<?php

/*|
 | Function Name 	: getDetailContainer
 | Description 		: Get Detail Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getDetailContainer($in_param) {

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

		$no_container = $xml_data->data->no_container;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$vessel = $xml_data->data->vessel;
		$voyage_in = $xml_data->data->voyage_in;
		$voyage_out = $xml_data->data->voyage_out;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get container info
		//PL/SQL

		//select connection
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T009D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t009d'];
		}

		if($vessel != "")
		{
			$q_p .= " AND NM_KAPAL='$vessel' ";
		}
		if($voyage_in != "")
		{
			$q_p .= " AND VOYAGE_IN='$voyage_in' ";
		}
		if($voyage_out != "")
		{
			$q_p .= " AND VOYAGE_OUT='$voyage_out' ";
		}
		
		$getContainer = "SELECT NO_CONTAINER,
                           SIZE_,
                           TYPE_,
                           STATUS,
                           ISO_CODE,
                           HEIGHT,
                           CARRIER,
                           E_I,
                           ACTIVE,
                           BERAT,
                           NO_UKK,
                           HZ,
                           LOKASI_BP,
                           KODE_STATUS,
                           POD,
                           POL,
                           NM_KAPAL,
                           VOYAGE_IN,
                           VOYAGE_OUT,
                           ID_JOBSLIP,
                           IMO, 
                           POINT,
                           HOLD_STATUS,
                           HOLD_DATE 
                      FROM (  SELECT a.NO_CONTAINER,
                                     SIZE_CONT AS SIZE_,
                                     TYPE_CONT AS TYPE_,
                                     STATUS,
                                     a.ISO_CODE,
                                     HEIGHT,
                                     a.CARRIER,
                                     a.E_I,
                                     ACTIVE,
                                     a.WEIGHT AS BERAT,
                                     c.ID_VSB_VOYAGE AS NO_UKK,
                                     a.HZ,
                                     BAYPLAN_POSITION AS LOKASI_BP,                                    
                                     ACTIVITY AS KODE_STATUS,
                                     a.POD,
                                     a.POL,
                                     a.VESSEL AS NM_KAPAL,
                                     a.VOYAGE_IN,
                                     a.VOYAGE_OUT,
                                     '' AS ID_JOBSLIP,
                                     IMO, 
                                     a.POINT as POINT,
                                     HOLD_STATUS,
                                     SUBSTR(a.HOLD_DATE,0,4)||'/'||SUBSTR(a.HOLD_DATE,5,2)||'/'||SUBSTR(a.HOLD_DATE,7,2) HOLD_DATE
                                FROM M_CYC_CONTAINER a                                    
                                     LEFT JOIN M_VSB_VOYAGE c
                                        ON     a.VESSEL = c.VESSEL
                                           AND a.VOYAGE_IN = c.voyage_in
                                           AND a.VOYAGE_OUT = c.voyage_out)
                                WHERE NO_CONTAINER = '$no_container' $q_p";

		for($j=0;$j<count($conn['container']);$j++)
		{
			//QUERY
			if(!checkOriSQL($conn['container'][$j],$getContainer,$query_container,$err)) goto Err;
			//FETCH QUERY
			while ($row_container = oci_fetch_array($query_container, OCI_ASSOC))
			{
				//build "info" data
				$info = array(
										'no_container' => $row_container[NO_CONTAINER],
										'vessel' => $row_container[NM_KAPAL],
										'voyage_in' => $row_container[VOYAGE_IN],
										'voyage_out' => $row_container[VOYAGE_OUT],
										'status' => $row_container[STATUS],
										'location' => $row_container[LOKASI_BP],
										'size' => $row_container[SIZE_],
										'type' => $row_container[TYPE_],
										'hazard' => $row_container[HZ],
										'imo_class' => $row_container[IMO],
										'un_number' => $row_container[TGL_JAM_TIBA],
										'iso_code' => $row_container[ISO_CODE],
										'height' => $row_container[HEIGHT],
										'pol' => $row_container[POL],
										'pod' => $row_container[POD],
										'weight' => $def,
										'e_i' => $row_container[E_I],
										'hold_status' => $row_container[HOLD_STATUS]
							);
			}
		}
		
		$handling = array(
						'activity' => $row_container[NO_CONTAINER],
						'time' => $row_container[NM_KAPAL],
						'operator' => $row_container[VOYAGE_IN]
			);

		$billing = array(
						'no_request' => $row_container[NO_CONTAINER],
						'request_type' => $row_container[NM_KAPAL],
						'no_proforma' => $row_container[VOYAGE_IN],
						'no_invoice' => $row_container[VOYAGE_IN],
						'customer' => $row_container[VOYAGE_IN],
						'date_request' => $row_container[VOYAGE_IN],
						'date_payment' => $row_container[VOYAGE_IN],
						'paid_thru' => $row_container[VOYAGE_IN]
						
			);
			
		$out_data = array();
		$out_data['info']=$info;
		$out_data['handling']=$handling;
		$out_data['billing']=$billing;

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