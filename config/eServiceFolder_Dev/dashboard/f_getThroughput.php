<?php

/*|
 | Function Name 	: getThroughput
 | Description 		: Get Throughput
 | Creator			: Endang Fiansyah
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getThroughput($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$port = $xml_data->data->port;$port = explode("-",$port);
		$port_code=$port[0];
		$terminal_code=$port[1];
		
		$start_date    = $xml_data->data->start_date;
		$end_date    = $xml_data->data->end_date;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$status  	    = array();
		$out_data 	    = array();
		
		//get container info
		//PL/SQL
		
		//khusus itos
		$sql10 = "select 
					to_char(TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from edi_coarri where inout='E' and 
						TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')";
							
		$sql11 = "select 						
					to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from edi_coarri where inout='I' and 
						TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')";
												
		$sql12 = "select 						
					to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from edi_coarri where inout='T' and 
						TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')";
						
		//khusus opus					
		$sql20 = "select 						
					to_char(TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from M_COARRI where e_i = 'E' and 
						TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(loading_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')";

		$sql21 = "select 
					to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from M_COARRI where e_i = 'I' and 
						TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')";
						
		$sql22 = "select 
					to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from M_COARRI where e_i = 'T' and 
						TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDDHH24MiSS'),'DD-MON-YY')";

		//khusus opus 009 
		$sql20 = "select 						
					to_char(TO_DATE(loading_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from M_COARRI where e_i = 'E' and 
						TO_DATE(loading_confirm, 'YYYYMMDD HH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(loading_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(loading_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY')";

		$sql21 = "select 
					to_char(TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from M_COARRI where e_i = 'I' and 
						TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY')";
						
		$sql22 = "select 
					to_char(TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY') as trans_date, 
					sum(
						case SUBSTR(ISO_CODE,1,1)
						when '2' then 1 
						when '4' then 2
						when '9' then 2 
						else 0
						end 
					) as teus 
					from M_COARRI where e_i = 'T' and 
						TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS') between TO_DATE('".trim($start_date)."', 'YYYYMMDDHH24MiSS') and 
						TO_DATE('".trim($end_date)."', 'YYYYMMDDHH24MiSS') 
						GROUP BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY')
						ORDER BY to_char(TO_DATE(discharge_confirm, 'YYYYMMDD HH24MiSS'),'DD-MON-YY')";
						
		//select connection
		$conn['ori'] = oriDb("CONTAINER_".$port_code."_".$terminal_code);
		if($port_code=="IDJKT"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$sql[0] = $sql20;
			$sql[1] = $sql21;
			$sql[2] = $sql22;
			$terminal[0]=$port_code."-".$terminal_code;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T3D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3d'];
			$sql[0] = $sql10;
			$sql[1] = $sql11;
			$sql[2] = $sql12;
			$terminal[0]=$port_code."-".$terminal_code;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T2D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t2d'];
			$sql[0] = $sql10;
			$sql[1] = $sql11;
			$sql[2] = $sql12;
			$terminal[0]=$port_code."-".$terminal_code;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="T1D")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t1d'];
			$sql[0] = $sql10;
			$sql[1] = $sql11;
			$sql[2] = $sql12;
			$terminal[0]=$port_code."-".$terminal_code;
		}
		else if($port_code=="IDJKT"&&$terminal_code=="009")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_009'];
			$sql[0] = $sql30;
			$sql[1] = $sql31;
			$sql[2] = $sql32;
			$terminal[0]=$port_code."-".$terminal_code;
		}
		else if($port_code=="IDPNK"&&$terminal_code=="T3I")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];
			$sql[0] = $sql20;
			$sql[1] = $sql21;
			$sql[2] = $sql22;
			$terminal[0]=$port_code."-".$terminal_code;
		}
		
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		$info=array();

		//QUERY
		if(!checkOriSQL($conn['container'][0],$sql[0],$query_container_e,$err,$debug)) goto Err;
		if(!checkOriSQL($conn['container'][0],$sql[1],$query_container_i,$err,$debug)) goto Err;
		if(!checkOriSQL($conn['container'][0],$sql[2],$query_container_t,$err,$debug)) goto Err;
		
		//FETCH QUERY
		$row_container_e = oci_fetch_array($query_container_e, OCI_ASSOC);
		$row_container_i = oci_fetch_array($query_container_i, OCI_ASSOC);
		$row_container_t = oci_fetch_array($query_container_t, OCI_ASSOC);
		
		{
			//build "info" data
			$info_sub = array(
							'terminal' => $terminal[0],
							'trans_date' => $row_container_e[TRANS_DATE],
							'teus' => $row_container_e[TEUS].",".$row_container_i[TEUS].",".$row_container_t[TEUS]
						);
			array_push($info, $info_sub);
		}

		
		$out_data = array();
		$out_data['info']=$info;
		goto Success;
	}
	
	catch (Exception $e) {
		$err = "SCRIPT EXCEPTION:".$e->getMessage();
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