<?php

/*|
 | Function Name 	: getCodecoCoarri
 | Description 		: Get Data Codeco Coarri
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getCodecoCoarri($in_param) {

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
		$jml_baris    = $xml_data->body->jml_baris;
		$kategori     = $xml_data->body->kategori;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$datacodeco  	= array();
		$datacoarri     = array();
		$out_data 	    = array();
		
		//get container info
		//PL/SQL
		
		//echo $no_container;
		$conn['container'][0] = $conn['ori']['ibis'];			
		
		//PL/SQL
		for($i=0;$i<=$jml_baris-1;$i++){
		
			if ($kategori == 'codeco'){
		
				$idjointves   = $xml_data->body->data[$i]->idjointvessel; 
				$vessel       = $xml_data->body->data[$i]->vessel;
				$callsign     = $xml_data->body->data[$i]->callsign; 
				$voyin        = $xml_data->body->data[$i]->voyin; 
				$voyout       = $xml_data->body->data[$i]->voyout;
				$opid         = $xml_data->body->data[$i]->opid;
				$eta          = $xml_data->body->data[$i]->eta;
				$etd          = $xml_data->body->data[$i]->etd;
				$etd          = $xml_data->body->data[$i]->etd;
				$atd          = $xml_data->body->data[$i]->atd;
				$nocont       = $xml_data->body->data[$i]->nocont;
				$inout        = $xml_data->body->data[$i]->inout;
				$ei           = $xml_data->body->data[$i]->ei;
				$pod          = $xml_data->body->data[$i]->pod;
				$pol          = $xml_data->body->data[$i]->pol;
				$status       = $xml_data->body->data[$i]->status;
				$isocode      = $xml_data->body->data[$i]->isocode;
				$carrier      = $xml_data->body->data[$i]->carrier;
				$imo          = $xml_data->body->data[$i]->imo;
				$temp         = $xml_data->body->data[$i]->temp;
				$weight       = $xml_data->body->data[$i]->weight;
				$sealid       = $xml_data->body->data[$i]->sealid;
				$hz           = $xml_data->body->data[$i]->hz;
				$notruck      = $xml_data->body->data[$i]->notruck;
				$unnumber     = $xml_data->body->data[$i]->unnumber;
				$truckindate     = $xml_data->body->data[$i]->truckindate;
				$truckoutdate    = $xml_data->body->data[$i]->truckoutdate;
				
				$weight			= str_replace(",","","$weight");
				
				$cekcodeco    = "SELECT COUNT(1) JML FROM SBY_CODECO WHERE ID_JOINT_VESSEL = TRIM('$idjointves') AND NO_CONTAINER = TRIM('$nocont') ";
				if(!checkOriSQL($conn['ori']['ibis'],$cekcodeco,$query_cekcodeco,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_cekcodeco= oci_fetch_array($query_cekcodeco, OCI_ASSOC))
				{
					if ($row_cekcodeco[JML] <= 0){
						$insertcodeco = "INSERT INTO SBY_CODECO (ID_JOINT_VESSEL,VESSEL,CALL_SIGN,VOYAGE_IN,VOYAGE_OUT,OPR_ID,EST_VS_ARRIVAL,EST_VS_DEPARTURE,REAL_VS_ARRIVAL,REAL_VS_DEPARTURE,
								NO_CONTAINER,INOUT,E_I,POD,POL,STATUS,ISO_CODE,CARRIER,IMO,TEMP,WEIGHT,SEAL_ID,HZ,NO_TRUCK,UN_NUMBER,TRUCK_IN_DATE,TRUCK_OUT_DATE,DATE_SEND,FLAG_SEND)
							VALUES ('$idjointves','$vessel','$callsign','$voyin','$voyout','$opid',TO_CHAR(TO_DATE('$eta','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$etd','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$ata','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$atd','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TRIM('$nocont'),'$inout','$ei','$pod','$pol','$status','$isocode','$carrier','$imo','$temp',TO_NUMBER('$weight'),'$sealid','$hz','$notruck','$unnumber',TO_CHAR(TO_DATE('$truckindate','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$truckoutdate','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),SYSDATE,1)
							--TO_CHAR(TO_DATE('$truckindate','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$truckoutdate','rrrrmmddhh24miss'),'rrrrmmddhh24miss'),SYSDATE,1)";
				
						$stid2 = oci_parse($conn['ori']['ibis'], $insertcodeco) or die ('Can not parse query');
						if (!oci_execute($stid2))
						{
						}
					}
				}	
				
				
				
			} else {
				$idjointves   = $xml_data->body->data[$i]->idjointvessel; 
				$vessel       = $xml_data->body->data[$i]->vessel;
				$callsign     = $xml_data->body->data[$i]->callsign; 
				$voyin        = $xml_data->body->data[$i]->voyin; 
				$voyout       = $xml_data->body->data[$i]->voyout;
				$opid         = $xml_data->body->data[$i]->opid;
				$eta          = $xml_data->body->data[$i]->eta;
				$etd          = $xml_data->body->data[$i]->etd;
				$etd          = $xml_data->body->data[$i]->etd;
				$atd          = $xml_data->body->data[$i]->atd;
				$nocont       = $xml_data->body->data[$i]->nocont;
				$inout        = $xml_data->body->data[$i]->inout;
				$pod          = $xml_data->body->data[$i]->pod;
				$pol          = $xml_data->body->data[$i]->pol;
				$status       = $xml_data->body->data[$i]->status;
				$isocode      = $xml_data->body->data[$i]->isocode;
				$carrier      = $xml_data->body->data[$i]->carrier;
				$imo          = $xml_data->body->data[$i]->imo;
				$temp         = $xml_data->body->data[$i]->temp;
				$ei           = $xml_data->body->data[$i]->ei;
				$weight       = $xml_data->body->data[$i]->weight;
				$sealid       = $xml_data->body->data[$i]->sealid;
				$hz           = $xml_data->body->data[$i]->hz;
				$bplocation   = $xml_data->body->data[$i]->bplocation;
				$unnumber     = $xml_data->body->data[$i]->unnumber;
				$discharge    = $xml_data->body->data[$i]->discharge;
				$loading      = $xml_data->body->data[$i]->loading;
				
				$cekcoarri    = "SELECT COUNT(1) JML FROM SBY_COARRI WHERE ID_JOINT_VESSEL = TRIM('$idjointves') AND NO_CONTAINER = TRIM('$nocont') ";
				if(!checkOriSQL($conn['ori']['ibis'],$cekcoarri,$query_cekcoarri,$err,$debug)) goto Err;
				//FETCH QUERY
				while ($row_cekcoarri= oci_fetch_array($query_cekcoarri, OCI_ASSOC))
				{
					if ($row_cekcoarri[JML] <= 0){
					
						$insertcoarri = "INSERT INTO SBY_COARRI (ID_JOINT_VESSEL,VESSEL,CALL_SIGN,VOYAGE_IN,VOYAGE_OUT,OPR_ID,EST_VS_ARRIVAL,EST_VS_DEPARTURE,REAL_VS_ARRIVAL,REAL_VS_DEPARTURE,
						NO_CONTAINER,INOUT,POD,POL,STATUS,ISO_CODE,CARRIER,IMO,TEMP,E_I,WEIGHT,SEAL_ID,HZ,BP_LOCATION,UN_NUMBER,DATE_SEND,DISCHARGE_CONFIRM,LOADING_CONFIRM)
									VALUES ('$idjointves','$vessel','$callsign','$voyin','$voyout','$opid',TO_CHAR(TO_DATE('$eta','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$etd','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$ata','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$atd','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TRIM('$nocont'),'$inout','$pod','$pol','$status','$isocode','$carrier','$imo','$temp','$ei','$weight','$sealid','$hz','$bplocation','$unnumber',SYSDATE,TO_CHAR(TO_DATE('$discharge','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'),TO_CHAR(TO_DATE('$loading','mm/dd/rrrr hh24:mi:ss'),'rrrrmmddhh24miss'))";
						
	
						$stid2 = oci_parse($conn['ori']['ibis'], $insertcoarri) or die ('Can not parse query');
						if (!oci_execute($stid2))
						{
						}
						}
				}
				
			}			
		}
		
		if ($kategori == 'codeco') {
		
			$datacoarri = '';
			
	    	$getcodeco = "SELECT ID_JOINT_VESSEL,VESSEL,CALL_SIGN,VOYAGE_IN,VOYAGE_OUT,OPR_ID,TO_CHAR(TO_DATE(EST_VS_ARRIVAL,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETA,TO_CHAR(TO_DATE(EST_VS_DEPARTURE,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETD,TO_CHAR(TO_DATE(REAL_VS_ARRIVAL,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATA,TO_CHAR(TO_DATE(REAL_VS_DEPARTURE,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATD,NO_CONTAINER,INOUT,E_I,POD,POL,STATUS,ISO_CODE,CARRIER,IMO,TEMP,WEIGHT,SEAL_ID,HZ,NO_TRUCK,UN_NUMBER,TO_CHAR(TO_DATE(TRUCK_IN_DATE,'yyyymmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') TRUCK_IN_DATE,TO_CHAR(TO_DATE(TRUCK_OUT_DATE,'yyyymmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') TRUCK_OUT_DATE,TO_CHAR(DATE_SEND,'dd/mm/rrrr hh24:mi:ss') DATE_SEND,FLAG_SEND FROM SBY_CODECO ORDER BY DATE_SEND DESC";
			
			//QUERY

			if(!checkOriSQL($conn['ori']['ibis'],$getcodeco,$query_codeco,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_codeco= oci_fetch_array($query_codeco, OCI_ASSOC))
			{
				//build "info" data
				$codeco_sub = array(
								'idjointves' => $row_codeco[ID_JOINT_VESSEL],
								'vessel' => $row_codeco[VESSEL],
								'voyage_in' => $row_codeco[VOYAGE_IN],	
								'voyage_out' => $row_codeco[VOYAGE_OUT],	
								'opid' => $row_codeco[OPR_ID],					
								'eta' => $row_codeco[ETA],	
								'etd' => $row_codeco[ETD],	
								'ata' => $row_codeco[ATA],	
								'atd' => $row_codeco[ATD],	
								'callsign' => $row_codeco[CALL_SIGN],		
								'nocontainer' => $row_codeco[NO_CONTAINER],
								'inout' => $row_codeco[INOUT],
								'ei' => $row_codeco[E_I],		
								'podpol' => $row_codeco[POD].'-'.$row_codeco[POL],
								'status' => $row_codeco[STATUS],
								'isocode' => $row_codeco[ISO_CODE],
								'carrier' => $row_codeco[CARRIER],		
								'no_truck' => $row_codeco[NO_TRUCK],
								'truckin' => $row_codeco[TRUCK_IN_DATE],
								'truckout' => $row_codeco[TRUCK_OUT_DATE],
								'datesend' => $row_codeco[DATE_SEND]
							);
					array_push($datacodeco, $codeco_sub);
			}
		} else {
		
			$datacodeco = '';
		
			$getcoarri = "SELECT ID_JOINT_VESSEL,VESSEL,CALL_SIGN,VOYAGE_IN,VOYAGE_OUT,OPR_ID,TO_CHAR(TO_DATE(EST_VS_ARRIVAL,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETA,TO_CHAR(TO_DATE(EST_VS_DEPARTURE,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ETD,TO_CHAR(TO_DATE(REAL_VS_ARRIVAL,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATA,TO_CHAR(TO_DATE(REAL_VS_DEPARTURE,'rrrrmmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') ATD,NO_CONTAINER,INOUT,POD,POL,STATUS,ISO_CODE,CARRIER,IMO,TEMP,E_I,WEIGHT,SEAL_ID,HZ,BP_LOCATION,UN_NUMBER,TO_CHAR(DATE_SEND,'dd/mm/rrrr hh24:mi:ss') DATE_SEND,TO_CHAR(TO_DATE(DISCHARGE_CONFIRM,'yyyymmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') DISCHARGE_CONFIRM,TO_CHAR(TO_DATE(LOADING_CONFIRM,'yyyymmddhh24miss'),'dd/mm/rrrr hh24:mi:ss') DISCHARGE_CONFIRM FROM SBY_COARRI ORDER BY DATE_SEND DESC";
		
			if(!checkOriSQL($conn['ori']['ibis'],$getcoarri,$query_coarri,$err,$debug)) goto Err;
			//FETCH QUERY
			while ($row_coarri= oci_fetch_array($query_coarri, OCI_ASSOC))
			{
				//build "info" data
				$coarri_sub = array(
							    'idjointves' => $row_coarri[ID_JOINT_VESSEL],
								'vessel' => $row_coarri[VESSEL],
								'voyagein' => $row_coarri[VOYAGE_IN],	
								'voyageout' => $row_coarri[VOYAGE_OUT],	
								'opid' => $row_coarri[OPR_ID],					
								'eta' => $row_coarri[ETA],	
								'etd' => $row_coarri[ETD],	
								'ata' => $row_coarri[ATA],	
								'atd' => $row_coarri[ATD],	
								'callsign' => $row_coarri[CALL_SIGN],		
								'nocontainer' => $row_coarri[NO_CONTAINER],
								'inout' => $row_coarri[INOUT],
								'ei' => $row_coarri[E_I],		
								'podpol' => $row_coarri[POD].'-'.$row_coarri[POL],
								'status' => $row_coarri[STATUS],
								'isocode' => $row_coarri[ISO_CODE],
								'carrier' => $row_coarri[CARRIER],		
								'location' => $row_coarri[BP_LOCATION],
								'disc' => $row_coarri[DISCHARGE_CONFIRM],
								'load' => $row_coarri[LOADING_CONFIRM],
								'datesend' => $row_coarri[DATE_SEND]
							);
					array_push($datacoarri, $coarri_sub);
			}
		}
			
		$out_data = array();
		$data = array(
						"datacodeco" => $datacodeco,
						"datacoarri" => $datacoarri
						);
		//$out_data['vessel']=$vessel;
		//$out_data['vesselsby']=$vessel1;
		$out_data = $data;
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