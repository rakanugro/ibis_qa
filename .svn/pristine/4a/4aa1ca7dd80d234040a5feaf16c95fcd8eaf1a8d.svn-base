<?php

/*|
 | Function Name 	: getHTMLCardContainer
 | Description 		: get HTML Card Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getHTMLCardContainer($in_param) {

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
		
		$no_request = $xml_data->data->no_request;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();
		
		$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
		
		if($port_code=="IDJKT"&&$terminal_code=="T009D"){
			$query_card = "SELECT A.ID_NOTA,
					   A.ID_REQ,
					   B.NO_CONTAINER ID_CONTAINER,
					   C.TGL_DO,
					   A.EMKL,
					   A.VESSEL,
					   B.VOYAGE_IN VOYAGE,
					   a.VOYAGE_IN,
					   a.VOYAGE_OUT,
					   B.SIZE_CONT UKURAN,
					   B.TYPE_CONT TYPE,
					   B.STATUS_CONT STATUS,
					   C.DISCH_DATE,
					   A.NO_BL,
					   A.NO_DO,
					   TO_CHAR(CASE WHEN A.TIPE_REQ='EXT' THEN B.PLUG_OUT_EXT ELSE B.PLUG_OUT END,'DD/MM/RRRR HH24:MI:SS') PLUG_OUT,
					   (SELECT C.TGL_JAM_TIBA
						  FROM rbm_h C
						 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
						  TGL_START_STACK,
					   A.TGL_SP2 TGL_END_STACK
					FROM REQ_DELIVERY_D B, NOTA_DELIVERY_H A, REQ_DELIVERY_H C
					WHERE TRIM (A.ID_REQ) = TRIM (B.ID_REQ)
						AND A.ID_REQ = C.ID_REQ
					   AND TRIM (A.ID_REQ) ='$no_request' AND A.STATUS != 'X'";
		} else {
			$query_card = "SELECT A.ID_NOTA,
					   A.ID_REQ,
					   B.NO_CONTAINER ID_CONTAINER,
					   C.TGL_DO,
					   A.EMKL,
					   A.VESSEL,
					   B.VOYAGE,
					   a.VOYAGE_IN,
					   a.VOYAGE_OUT,
					   B.SIZE_CONT UKURAN,
					   B.TYPE_CONT TYPE,
					   B.STATUS_CONT STATUS,
					   C.DISCH_DATE,
					   A.NO_BL,
					   A.NO_DO,
					   TO_CHAR(CASE WHEN A.TIPE_REQ='EXT' THEN B.PLUG_OUT_EXT ELSE B.PLUG_OUT END,'DD/MM/RRRR HH24:MI:SS') PLUG_OUT,
					   (SELECT C.TGL_JAM_TIBA
						  FROM rbm_h C
						 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
						  TGL_START_STACK,
					   A.TGL_SP2 TGL_END_STACK
					FROM REQ_DELIVERY_D B, NOTA_DELIVERY_H A, REQ_DELIVERY_H C
					WHERE TRIM (A.ID_REQ) = TRIM (B.NO_REQ_DEV)
						AND A.ID_REQ = C.ID_REQ
					   AND TRIM (A.ID_REQ) ='$no_request' AND A.STATUS != 'X'";
		}
		if($port_code == 'IDJKT' && $terminal_code == 'ITOST'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query_card,$query_card_,$err)) goto Err;
		}
		
		
		
		$vessel 	= $data[0]['VESSEL'];
		$voyage_in 	= $data[0]['VOYAGE_IN'];
		$voyage_out = $data[0]['VOYAGE_OUT'];
		
		$query_vessel = "select OPERATOR_NAME, TO_CHAR(TO_DATE(ATA,'YYYYMMDDHH24MISS'),'DD-MM-YYYY') TGL_TIBA, TO_CHAR(TO_DATE(ETD,'YYYYMMDDHH24MISS'),'DD-MM-YYYY') TGL_BERANGKAT from itos_repo.m_vsb_voyage WHERE VESSEL='".$vessel."' AND VOYAGE_IN='".$voyage_in."' AND VOYAGE_OUT='".$voyage_out."'";
		
		if($port_code == 'IDJKT' && $terminal_code == 'ITOST'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query_vessel,$query_vessel_,$err)) goto Err;
		}
		
		$vessel = oci_fetch_array($query_vessel_, OCI_ASSOC);

		
		while ($rows = oci_fetch_array($query_card_, OCI_ASSOC)){
			
			if($rows[TYPE] == 'RFR') {
			$plug = <<<EOD
				<font style="font-size:24px">PLUG OUT</font> : <br/> <font style="font-size:24px">$rows[PLUG_OUT] </font>
EOD;
			}
			$time = date('d-m-y h:i');
			$tbl .= <<<EOD
			<div style="width:767px; height:998px; border:1px solid #fff; font-family:Arial">
				<table width="100%" cellspacing="0" cellpadding="0" style="margin:0px; margin-top:5px; margin-bottom:10px; font-size:12px">
				<tbody>
				<tr>
				<td height="30" colspan="7"></td>
				</tr>
				<tr>
				<td width="15%">&nbsp;</td>
				<td width="39%">&nbsp;</td>
				<td width="14%" colspan="3"></td>
				<td width="17%" align="right"></td>
				<td width="17%">&nbsp;&nbsp; </td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2" align="center">$rows[ID_NOTA]</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td>&nbsp;</td>
				<td align="center"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td align="right">NO REQ :</td>
				<td>$rows[ID_REQ]</td>
				</tr>
				<tr>
				<td height="82" colspan="7">&nbsp;</td>
				</tr>
				<tr>
				<td height="20">&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td style="padding-left:45px" colspan="2"></td>
				</tr>
				<tr>
				<td height="25">&nbsp;</td>
				<td>
				<b style="font-size:24px">$rows[ID_CONTAINER]</b>
				</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">
				<p align="center" style="font:Arial; font-size:22px">[ iTOS TO2]</p>
				</td>
				</tr>
				<tr>
				<td height="20">&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>$rows[UKURAN] / $rows[TYPE] / $rows[STATUS]</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>$rows[VESSEL]/$rows[VOYAGE] $rows[VOYAGE_OUT]</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">$vessel[TGL_TIBA] - $vessel[TGL_BERANGKAT]</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>$vessel[OPERATOR_NAME]</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">$rows[NO_B]}</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
				<td colspan="2">$rows[NO_DO]</td>

				</tr>
				<tr>
				<td>&nbsp;</td>
				<td colspan="4">$rows[EMKL]</td>
				<td colspan="2">$rows[DISCH_DATE]</td>
				</tr>
				<tr>
				<td height="15">&nbsp;</td>
				<td>$rows[EMKL]</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">$rows[TGL_END_STACK]</td>
				</tr>
				<tr height='30' valign='top'> <!--56-->
				<td height="15">&nbsp;</td>
				<td>Date Do:$rows[TGL_DO]</td>

				<td ></td>
				<td colspan="3"></td>
				<td colspan="2"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td> $plug</td>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				<td>$time</td>
				<td></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<td height="39">&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				</tr>
				</tbody>
				</table>
				</div>
				<div style="margin-top:100px;width:767px; border:0px solid"></div>

		
EOD;
		
		}
		
		
		$html_tcpdf = $tbl;
					
		$data = array(
						"card_html" => base64_encode($html_tcpdf),
						"proforma_id" => $data[ID_NOTA]
						);

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