<?php

/*|
 | Function Name 	: getCardContainerThermal
 | Description 		: get Card Container Thermal
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getCardContainerThermal($in_param) {

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
		$pages = array();
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
		   SUBSTR(B.NO_CONTAINER,1,4) PREFIX,
           SUBSTR(B.NO_CONTAINER,-7) CONT_NUMB,
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
	$nourut=0;
	while ($rows = oci_fetch_array($rW, OCI_ASSOC))
	{
		$nourut++;
        $tbl = <<<EOD
            <table width="95%">                
                <tr>            
                    <td COLSPAN="6" align="center"><b><font size="10">&nbsp;&nbsp;PT Pelabuhan Tanjung Priok</font></b></td>
                </tr>
                <tr>            
                    <td COLSPAN="6" align="center"><b><font size="12">$terminal_name</font></b></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>                 
                <tr>                    
                    <td COLSPAN="2" align="left"><b><font size="12">L<br/>$rows[PREFIX]<br/>$rows[CONT_NUMB]<br/>$rows[STATUS]</font></b></td>
                    <td COLSPAN="2" align="center"><b><font size="10">&nbsp;<br/>$rows[ISO_CODE]<br/>$rows[TYPE]<br/></font></b></td>
                    <td COLSPAN="2" align="right"><b><font size="10">$nourut&nbsp;&nbsp;&nbsp;&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;<br/>$rows[TLYARD]&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>   
                <tr>
                    <td COLSPAN="6" align="center"><font size="12"><b>DELIVERY</b></font></td>                                        
                </tr>  
                <tr>
                    <td>&nbsp;</td>
                </tr>                           
                <tr>                    
                    <td COLSPAN="6" align="center"><b><font size="10">$rows[VESSEL]</font></b></td>                 
                </tr>
                <tr>                    
                    <td COLSPAN="6" align="center"><b><font size="10">Voy. $rows[VOYAGE]/$rows[VOYAGE_OUT]</font></b></td>                    
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>                
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>                    
                    <td COLSPAN="6" align="center"><b><font size="10">$rows[EMKL]</font></b></td>                  
                </tr>  
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>                    
                    <td width="70" align="left"><b><font size="10">Document</font></b></td>
                    <td width="10">:</td>
                    <td COLSPAN="4"><b><font size="10">$rows[NO_DO]</font></b></td>                  
                </tr>
                <tr>                    
                    <td width="70" align="left"><b><font size="10">Performa</font></b></td> 
                    <td width="10">:</td>
                    <td COLSPAN="4"><b><font size="10">$no_request</font></b></td>                 
                </tr>
                <tr>                    
                    <td width="70" align="left"><b><font size="10">Paid Thru</font></b></td>
                    <td width="10">:</td>
                    <td COLSPAN="4"><b><font size="10">$rows[TGL_END_STACK]</font></b></td>                  
                </tr>       
            </table>
                
EOD;

		$array_temp['TCPDF']=base64_encode($tbl);
		$array_temp['NO_CONTAINER']=$rows[ID_CONTAINER];
               
        array_push($pages, $array_temp);
	}
	

	
		$html_tcpdf = $tbl;
					
		$data = array(
						"html_tcpdf" => $pages,
						"proforma_id" => $data[ID_NOTA],
						"page" => $nourut
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