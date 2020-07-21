<?php

/*|
 | Function Name 	: getCardContainer
 | Description 		: get Card Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getCardContainer($in_param) {

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
		$customer_id = $xml_data->data->customer_id;
		$no_request = $xml_data->data->no_request;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		$query_check = "SELECT a.status
						  FROM NOTA_DELIVERY_H a
						 WHERE a.ID_NOTA = '$id_nota'";
			
		if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query_check,$queryCheck,$err)) goto Err;
		
		//FETCH QUERY
		if ($rowcheck = oci_fetch_array($queryCheck, OCI_ASSOC))
		{
			if($rowcheck['STATUS']!='P'){
				echo "Request Not Paid";
				die();
			}
		}
	
		$row = "select OPERATOR_NAME, TO_CHAR(TO_DATE(ATA,'YYYYMMDDHH24MISS'),'DD-MM-YYYY') TGL_TIBA, TO_CHAR(TO_DATE(ETD,'YYYYMMDDHH24MISS'),'DD-MM-YYYY') TGL_BERANGKAT from m_vsb_voyage WHERE VESSEL='".$rowd[0]['VESSEL']."' AND VOYAGE_IN='".$rowd[0]['VOYAGE_IN']."' AND VOYAGE_OUT='".$rowd[0]['VOYAGE_OUT']."'";
		
		if(!checkOriSQL($conn['ori']['container_idjkt_itost'],$row,$queryVessel,$err)) goto Err;;
		if ($vessel = oci_fetch_array($queryVessel, OCI_ASSOC))
		{
			
		}
	
		/* TERMINAL DOMESTIK*/
		$query_id_terminal="SELECT TERMINAL_ID FROM TERMINAL_CONFIG WHERE ENABLE = 'Y'";
		if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query_id_terminal,$queryIDTerminal,$err)) goto Err;
		
		//FETCH QUERY
		if ($hasil_id_terminal_ = oci_fetch_array($queryIDTerminal, OCI_ASSOC))
		{
			$terminal_name=$hasil_id_terminal_[TERMINAL_ID];
		}
		/* TERMINAL DOMESTIK*/
	
	 $rw="SELECT A.ID_NOTA,
		   A.ID_REQ,
		   B.NO_CONTAINER ID_CONTAINER,
		   C.TGL_DO,
		   A.EMKL,
		   A.VESSEL,
		   B.VOYAGE,
		 a.VOYAGE_IN,
		   a.VOYAGE_OUT,
		   B.SIZE_CONT UKURAN,
		   B.STATUS_CONT STATUS,
		   C.DISCH_DATE,
		 A.NO_BL,
		 A.NO_DO,
		   TO_CHAR(CASE WHEN A.TIPE_REQ='EXT' THEN B.PLUG_OUT_EXT ELSE B.PLUG_OUT END,'DD/MM/RRRR HH24:MI:SS') PLUG_OUT,
		   (SELECT C.TGL_JAM_TIBA
			  FROM rbm_h C
			 WHERE TRIM (C.NO_UKK) = TRIM (A.NO_UKK))
			  TGL_START_STACK,
		   A.TGL_SP2 TGL_END_STACK,
		   CASE D.HEIGHT_CONT WHEN 'OOG' THEN B.TYPE_CONT || 'OOG'
			ELSE B.TYPE_CONT END TYPE,
			CASE WHEN c.TL_FLAG='Y' THEN 'TL' ELSE 'YARD' END TLYARD,
		(SELECT YD_BLOCK ||'-'||YD_SLOT ||'-'|| YD_ROW ||'-'|| YD_TIER POSISI FROM itos_repo.m_cyc_container WHERE VESSEL=a.VESSEL AND VOYAGE_IN=a.VOYAGE_IN AND VOYAGE_OUT=a.VOYAGE_OUT AND NO_CONTAINER=B.NO_CONTAINER) POSISI
	  FROM REQ_DELIVERY_D B, NOTA_DELIVERY_H A, REQ_DELIVERY_H C, MASTER_BARANG D
	 WHERE TRIM (A.ID_REQ) = TRIM (B.NO_REQ_DEV)
			AND A.ID_REQ = C.ID_REQ
			AND B.ID_CONT=D.KODE_BARANG
		   AND TRIM (A.ID_REQ) ='$no_request'";
		   //echo $rw;die;
	
	if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$rw,$rW,$err)) goto Err;
	//FETCH QUERY
	while ($rows = oci_fetch_array($rW, OCI_ASSOC))
	{
		$tbl.='<div style="width:767px; height:998px; border:1px solid #fff; font-family:Arial">
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
				<td colspan="2" align="center">'.$rows[ID_NOTA].'</td>
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
				<td>'.$rows[ID_REQ].'</td>
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
				<b style="font-size:24px">'.$rows[ID_CONTAINER].'</b>
				</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">
				<p align="center" style="font:Arial; font-size:22px">[ iTOS '.$terminal_name.']</p>
				</td>
				</tr>
				<tr>
				<td height="20">&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>'.$rows[UKURAN].' / '.$rows[TYPE].' / '.$rows[STATUS].'</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>'.$rows[VESSEL].'/'.$rows[VOYAGE].' '.$rows[VOYAGE_OUT].'</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">'.$vessel[TGL_TIBA].' - '.$vessel[TGL_BERANGKAT].'</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>'.$vessel[OPERATOR_NAME].'</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">'.$rows[NO_BL].'</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
				<td colspan="2">'.$rows[NO_DO].'</td>

				</tr>
				<tr>
				<td>&nbsp;</td>
				<td colspan="4">'.$rows[EMKL].'</td>
				<td colspan="2">'.$rows[DISCH_DATE].'</td>
				</tr>
				<tr>
				<td height="15">&nbsp;</td>
				<td>'.$rows[EMKL].'</td>
				<td colspan="3">&nbsp;</td>
				<td colspan="2">'.$rows[TGL_END_STACK].'</td>
				</tr>
				<tr height="30" valign="top"> <!--56-->
				<td height="15">&nbsp;</td>
				<td>Date Do:'.$rows[TGL_DO].'</td>

				<td ></td>
				<td colspan="3">'.$rows[POSISI].'</td>
				<td colspan="2" align="left"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td> '.$rows[PLUG_OUT].' </font> 
				</td>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				<td>'. date('d-m-y h:i').'</td>
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
				<td></td>
				<td>TL/YARD : <B>'.$rows[TLYARD].'</B></td>
				<td colspan="3"></td>
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
				<div style="margin-top:100px;width:767px; border:0px solid"></div>';
	}
	

	
		$html_tcpdf = $tbl;
					
		$data = array(
						"html_tcpdf" => base64_encode($html_tcpdf),
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