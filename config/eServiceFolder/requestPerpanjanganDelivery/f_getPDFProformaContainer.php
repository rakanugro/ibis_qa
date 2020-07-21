<?php

/*|
 | Function Name 	: getPDFProformaContainer
 | Description 		: get PDF Proforma Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFProformaContainer($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();	
		$conn['billing'][0] = $conn['ori']['billing'];
		
		//select connection	
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
		else if($port_code=="IDJKT"&&$terminal_code=="")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idjkt_t009d'];
		}
		else if($port_code=="IDPNK"&&$terminal_code=="")
		{
			$conn['container'][0] = $conn['ori']['container_idpnk_t3i'];			
		}
		else if($port_code==""&&$terminal_code=="")
		{
			$conn['container'][0] = $conn['ori']['container_idjkt_t3i'];
			$conn['container'][1] = $conn['ori']['container_idjkt_t3d'];
			$conn['container'][2] = $conn['ori']['container_idjkt_t2d'];
			$conn['container'][3] = $conn['ori']['container_idjkt_t1d'];
			$conn['container'][4] = $conn['ori']['container_idpnk_t3i'];
			$conn['container'][5] = $conn['ori']['container_idpnk_t009d'];	
		}
		
		if ($port_code=='IDJKT')
		{
			$port_desc='PT. PELABUHAN TANJUNG PRIOK';
		}
		else if ($port_code=='IDPNK')
		{
			$port_desc='PT. IPC TERMINAL PETIKEMAS - PONTIANAK';
		}
		if (($terminal_code=='T1D') OR ($terminal_code=='T009D'))
		{
			$terminal_desc='TERMINAL 1 DOMESTIK';
		}
		else if($terminal_code=='T2D')
		{
			$terminal_desc='TERMINAL 1 DOMESTIK';
		}
		else if($terminal_code=='T3D')
		{
			$terminal_desc='TERMINAL 3 DOMESTIK';
		}
		else if($terminal_code=='T3I')
		{
			$terminal_desc='TERMINAL 3 INTERNASIONAL';
		}
		
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		//sreturn $in_param;
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		
		$no_req = $xml_data->data->no_request;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();

		$query="UPDATE NOTA_DELIVERY_H SET TGL_CETAK_NOTA=SYSDATE WHERE ID_REQ='$no_req' AND STATUS!='X'";
		if ($port_code == 'IDJKT' && $terminal_code == 'ITOST'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$query,$query_proforma,$err,$bind_param)) goto Err;
		} else if ($port_code == 'IDJKT' && $terminal_code == 'T009D'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_t009d'],$query,$query_proforma,$err,$bind_param)) goto Err;
		}
		
		if ($port_code == 'IDJKT' && $terminal_code == 'ITOST'){
			$getHeader="SELECT a.ID_REQ, 
				   NVL(a.ID_NOTA,'-') ID_NOTA, 
				   NVL(a.NO_FAKTUR,'-') NO_FAKTUR, 
				   a.ID_USER, 
				   TO_CHAR(a.ADM_NOTA,'999,999,999,999') ADM_NOTA, 
				   a.EMKL, 
				   a.ALAMAT, 
				   a.NPWP,
				   TO_CHAR(a.TAGIHAN,'999,999,999,999') TAGIHAN, 
				   TO_CHAR(a.PPN,'999,999,999,999') PPN, 
				   TO_CHAR(a.TOTAL,'999,999,999,999') TOTAL, 
				   a.STATUS, 
				   TO_CHAR(a.TGL_REQUEST,'dd/mm/yyyy') TGL_REQUEST,
				   (SELECT NAME FROM TB_USER WHERE ID = a.ID_USER) ID_USER,
				   b.VESSEL,b.VOYAGE_OUT AS VOYAGE 
			FROM nota_delivery_h a, req_delivery_h b
			WHERE a.ID_REQ = '$no_req' AND a.ID_REQ = b.ID_REQ and a.status!='X'";
		} else {
			$getHeader="SELECT a.ID_REQ, 
				   NVL(a.ID_PROFORMA,'-') ID_NOTA, 
				   NVL(a.NO_FAKTUR,'-') NO_FAKTUR, 
				   a.ID_USER, 
				   TO_CHAR(a.ADM_NOTA,'999,999,999,999') ADM_NOTA, 
				   a.EMKL, 
				   a.ALAMAT, 
				   a.NPWP,
				   TO_CHAR(a.TAGIHAN,'999,999,999,999') TAGIHAN, 
				   TO_CHAR(a.PPN,'999,999,999,999') PPN, 
				   TO_CHAR(a.TOTAL,'999,999,999,999') TOTAL, 
				   a.STATUS, 
				   TO_CHAR(a.TGL_REQUEST,'dd/mm/yyyy') TGL_REQUEST,
				   (SELECT NAME FROM TB_USER WHERE ID = a.ID_USER) ID_USER,
				   b.VESSEL,b.VOYAGE_OUT AS VOYAGE 
			FROM nota_delivery_h a, req_delivery_h b
			WHERE a.ID_REQ = '$no_req' AND a.ID_REQ = b.ID_REQ and a.status!='X'";

		}
		if ($port_code == 'IDJKT' && $terminal_code == 'ITOST'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$getHeader,$query_header,$err)) goto Err;
		} else if ($port_code == 'IDJKT' && $terminal_code == 'T009D'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_t009d'],$getHeader,$query_header,$err)) goto Err;
		}
		
		//FETCH QUERY
		if ($data = oci_fetch_array($query_header, OCI_ASSOC))
		{
			
		}
		
		//----- Get Data Container ------//
		if (substr($no_req, 0, 2) != 'BM') // check if not Batal Muat
		{
			$getNoContainer = "select no_container from m_cyc_container where billing_request_id = '$no_req'";
		} else {
			$getNoContainer = "select no_container from tb_batalmuat where id_batalmuat = '$no_req'";
		}
		
		//$err = $conn; goto Err;
		//$output_no_container = $getNoContainer;
		if(!checkOriSQL($conn['container'][0],$getNoContainer,$query_no_cont,$err)) goto Err;
		$data_no_cont = oci_fetch_array($query_no_cont, OCI_ASSOC);
		$output_no_container = $data_no_cont['NO_CONTAINER'];
		while ($data_no_cont = oci_fetch_array($query_no_cont, OCI_ASSOC)){
			$output_no_container = $output_no_container .", ". $data_no_cont['NO_CONTAINER'];
		}
		
		date_default_timezone_set('Asia/Jakarta');
		$date=date('d M Y H:i:s');

		$getDetail="SELECT TO_CHAR(a.TARIF, '999,999,999,999') AS TARIF, 
					  TO_CHAR(a.SUB_TOTAL, '999,999,999,999') AS SUB_TOTAL, 
					  a.KETERANGAN, a.HZ, a.JUMLAH_CONT, TO_DATE(a.TGL_START_STACK,'dd/mm/yyyy') TGL_START_STACK, 
					  TO_DATE(a.TGL_END_STACK,'dd/mm/yyyy') TGL_END_STACK, b.UKURAN SIZE_, b.TYPE, 
					  b.STATUS, a.JUMLAH_HARI
					  FROM nota_delivery_d_tmp a left join  master_barang b on (a.ID_CONT = b.KODE_BARANG)
					  where a.ID_REQ = '$no_req' and KETERANGAN NOT IN ('ADM','TARIF MINIMAL')";
		//RETURN print_R($query_dtl);
		if ($port_code == 'IDJKT' && $terminal_code == 'ITOST'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_itost'],$getDetail,$query_detail,$err)) goto Err;
		} else if ($port_code == 'IDJKT' && $terminal_code == 'T009D'){
			if(!checkOriSQL($conn['ori']['billing_idjkt_t009d'],$getDetail,$query_detail,$err)) goto Err;
		}
		$i=0;
		
		
		while ($rows = oci_fetch_array($query_detail, OCI_ASSOC))
		{
			if($rows[KETERANGAN]!='MONITORING DAN LISTRIK'){
				$den='('.$rows[TGL_START_STACK].' s/d '.$rows[TGL_END_STACK].')'.$rows[JUMLAH_HARI].'hari';
			}
			else
			{
				$den=$rows[JUMLAH_HARI].' Shift';
			}
			if(($rows[START_STACK]<>'') OR ($rows[JUMLAH_HARI]<>'') ){
				$detail .='
				
				<tr><td colspan="3" width="100"><font size="10">'.'<b>'.$rows[KETERANGAN].'</b>'.'</font></td>
				
					
				<td width="10" align="left"><font size="10">'.'<b>'.$rows[JUMLAH_CONT].'</b>'.'</font></td>                              
				<td width="50" align="left"><font size="10">'.'<b>'.$rows[SIZE_]." ".$rows[TYPE]." ".$rows[STATUS].'</b>'.'</font></td>                                
					
				<td width="7" align="left"><font size="10">'.'<b>'.$rows[HZ].'</b>'.'</font></td>                        
				<td width="45" align="right"><font size="10">'.'<b>'.$rows[TARIF].'</b>'.'</font></td>                        
				<td width="35" align="right"><font size="10">'.'<b>'.$rows[SUB_TOTAL].'</b>'.'</font></td>        
				</tr>   
				
				<tr>
					<td colspan="8"><font size="10"><i><b>'.$den.'</i></b></font></td>
				 </tr>
				';
			}
			else 
			{                            
				$detail .= '<tr><td colspan="3" width="100"><font size="10">'.'<b>'.$rows[KETERANGAN].'</b>'.'</font></td>
				
					
				<td width="10" align="left"><font size="10">'.'<b>'.$rows[JUMLAH_CONT].'</b>'.'</font></td>                              
				<td width="50" align="left"><font size="10">'.'<b>'.$rows[SIZE_]." ".$rows[TYPE]." ".$rows[STATUS].'</b>'.'</font></td>                                
					
				<td width="7" align="left"><font size="10">'.'<b>'.$rows[HZ].'</b>'.'</font></td>
				
				<td width="45" align="right"><font size="10">'.'<b>'.$rows[TARIF].'</b>'.'</font></td>
				
				<td width="35" align="right"><font size="10">'.'<b>'.$rows[SUB_TOTAL].'</b>'.'</font></td>        
				</tr> 
				 '; 
			}
			$i++;
		}
		
		$tbl = <<<EOD
          <table width="95%">
				<tr>            
					<td COLSPAN="6" align="right"><b><font size="18">Proforma Perpanjangan Delivery</font></b></td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td width="10%">&nbsp;</td>
					<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;PT Pelabuhan Tanjung Priok</font></b></td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td width="10%">&nbsp;</td>
					<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;TERMINAL 2</font></b></td>
				</tr>
			</table>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<table border='0'>                
		<tr>                    
                 <td COLSPAN="1" align="left"><font size="10"><b>No. Proforma : $data[ID_NOTA]</b></font></td>
                 <td><font size="10"><b>$date</b></font></td>
                </tr> 
                <tr>                    
                    <td COLSPAN="3" align="left"><font size="10"><b>$data[ID_REQ]</b></font>  </td>
                </tr>                  
                
                <tr>
                    <td></td>					
                </tr>       
				
                <tr>                    
                    <td COLSPAN="3" align="left"><font size="10"><b>No Container: </b>$output_no_container</font>  </td>
                </tr>     
				
                <tr>
                    <td></td>					
                </tr>                
                
                <tr>
                    <td COLSPAN="6"><b>DELIVERY</b></td>                                        
                </tr>                
                              
                <tr>                    
                    <td COLSPAN="4" align="left"><b>$data[EMKL]</b></td>					
                </tr>
                <tr>                    
                    <td COLSPAN="4" align="left"><b>$data[NPWP]</b></td>                    
                </tr>
                <tr>                    
                    <td COLSPAN="6" align="left"><b>$data[ALAMAT]</b></td>					
                </tr>
                <tr>                    
                    <td COLSPAN="4" align="left"><b>$data[VESSEL] / $data[VOYAGE]</b></td>
                    <td colspan="7"></td>
                </tr>               
                
                <tr>
                <td></td>
                </tr>                                                    
                                
                <tr>                              
					<th colspan="3" width="100"><font size="10"><b>KETERANGAN</b></font></th>                    
                    <th width="20" align="left"><font size="10"><b>BX</b></font></th>
                
                    <th width="100" align="left"><font size="10"><b>CONTENT</b></font></th>
                    <th width="40" align="left"><font size="10"><b>HZ</b></font></th>
                    
                    <th width="90" align="left"><font size="10"><b>TARIF</b></font></th>                    
                    <th width="90" align="left"><font size="10" ><b>JUMLAH</b></font></th>
                </tr>
                
                
                <tr>
                    <td colspoan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="10" width="700">
                    </td>
                </tr>
                <table>
				$detail
                </table>
				<tr>
                    <td colspoan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="10" width="700">
                    </td>
                </tr>
				
                </table>
                
EOD;
$tbl .=<<<EOD
<br>
                    <br>
                    <br>
                    <br>
<table>                    
                    <tr>
                        <td colspan="6" align="right"><b>Discount :</b></td>
                        <td width="50" colspan="2" align="right"><b>0.00</b></td>
                    </tr>
                    <tr>
                        
                        <td colspan="6" align="right"><b>Administrasi :</b></td>
                        <td colspan="2" align="right"><b>$data[ADM_NOTA]</b></td>
                    </tr>
                    <tr>
                      
                        <td colspan="6" align="right"><b>Dasar Peng. Pajak :</b></td>
                        <td colspan="2" align="right"><b>$data[TAGIHAN]</b></td>
                    </tr>
                    <tr>
                        
                        <td colspan="6" align="right"><b>Jumlah PPN :</b></td>
                        <td colspan="2" align="right"><b>$data[PPN]</b></td>
                    </tr>
                    <tr>
                        
                        <td colspan="6" align="right"><b>Jumlah PPN Subsidi :</b></td>
                        <td colspan="2" align="right"><b>0.00</b></td>
                    </tr>
                    <tr>
                     
                        <td colspan="6" align="right"><font size="10"><b>Jumlah Dibayar :</b></font></td>
                        <td colspan="2" align="right"><font size="10"><b>$data[TOTAL]</b></font></td>
                    </tr>               
                    
                    </table>                                      
                    <br>
                    <br>
                    <br>
                    <br>
                    <br><font size="10"><b>$nm_perusahaan<b></font><br>
					<br><font size="10"><b>$terminal_name<b></font><br>
                
EOD;

		$tbl .=<<<EOD
		<table> 
					$selfservice
                    <tr>
                    <td colspan="8">
                        <hr style="border: dashed 2px #C0C0C0" color="#FFFFFF" size="10" width="700">
                    </td>
                    </tr>
                    <tr>
                    <td colspan="8">
                        <i>form untuk Bank</i>
                    </td>
                    </tr>                   
                    <tr>
                    <td colspan="8">
                        &nbsp;
                    </td>
                    </tr>                   
                    <tr>
                    <td colspan="8">
                        &nbsp;
                    </td>
                    </tr>                   
                    <tr>
                        <td colspan="3" align="right"><font size="10"><b>Nomor Invoice :</b></font></td>
                        <td colspan="4" align="left"><font size="10"> <b>$data[ID_NOTA]</b></font></td>
                    </tr>               
                    <tr>
                        <td colspan="3" align="right"><font size="10"><b>Customer :</b></font></td>
                        <td colspan="4" align="left"><font size="10"> <b>$data[EMKL]</b></font></td>
                    </tr>               
                    <tr>
                     
                        <td colspan="3" align="right"><font size="10"><b>Jumlah Dibayar :</b></font></td>
                        <td colspan="4" align="left"><font size="10"> Rp. <b>$data[TOTAL]</b></font></td>
                    </tr>               
        
                    </table>                                      
          
                
EOD;

		
		$html_tcpdf = $tbl;
					
		$data = array(
						"proforma_html" => base64_encode($html_tcpdf),
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