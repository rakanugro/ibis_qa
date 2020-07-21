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
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$no_req = $xml_data->data->no_request;
		$no_req_ol = $xml_data->data->no_request_ol;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
				
		$request = array();
		
		
		//select connection
		$conn['ori'] = oriDb('BILLING_'.$port_code.'_'.$terminal_code);
		$conn['ori'] += oriDb('CONTAINER_'.$port_code.'_'.$terminal_code);
		
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

		

		if ($terminal_code=='T009D'){
			
			$query="UPDATE NOTA_BATALMUAT_H SET TGL_CETAK_NOTA=SYSDATE WHERE ID_REQ='$no_req'";
			if(!checkOriSQL($conn['ori']['billing'],$query,$query_proforma,$err,$bind_param)) goto Err;
		
			$getHeader = "SELECT b.ID_PROFORMA NO_NOTA,
						   b.ID_REQ ID_BATALMUAT,
						   b.EMKL,
						   b.ALAMAT,
						   b.NPWP,
						   b.TGL_REQ,
						   b.JENIS,
						   b.VESSEL,
						   b.VOYAGE_IN VOYAGE,
						   TO_CHAR (b.BAYAR, '999,999,999,999') AS TOTAL,
						   TO_CHAR (b.ADM, '999,999,999,999') AS ADM_NOTA,
						   TO_CHAR (b.PPN, '999,999,999,999') AS PPN,
						   TO_CHAR (b.TOTAL, '999,999,999,999') AS TAGIHAN,
						   (SELECT NAME
							  FROM TB_USER a
							 WHERE b.PENGGUNA = a.ID)
							  ID_USER
					  FROM NOTA_batalmuat_h b
					 WHERE b.ID_REQ = '$no_req' AND status != 'X'";
					 
			$getDetail="SELECT TO_CHAR (a.TARIF, '999,999,999,999') AS TARIF,
						   TO_CHAR (a.TOTAL, '999,999,999,999') AS SUB_TOTAL,
						   a.KETERANGAN,
						   a.HZ,
						   a.JUMLAH_CONT JUMLAH_CONT,
						   TO_DATE (a.TGL_START_STACK, 'dd/mm/yyyy') START_STACK,
						   TO_DATE (a.TGL_END_STACK, 'dd/mm/yyyy') END_STACK,
						   b.UKURAN SIZE_,
						   b.TYPE TYPE,
						   b.STATUS,
						   a.JUMLAH_HARI
					  FROM NOTA_BATALMUAT_D_TMP a, master_barang b
					 WHERE     a.ID_CONT = b.KODE_BARANG(+)
						   AND a.ID_REQ = '$no_req'
						   AND KETERANGAN NOT IN ('ADM', 'TARIF MINIMAL')";
		 
		 } else {
		 
			$query="UPDATE NOTA_BATALMUAT_H SET TGL_CETAK_NOTA=SYSDATE WHERE ID_BATALMUAT='$no_req'";
			if(!checkOriSQL($conn['ori']['billing'],$query,$query_proforma,$err,$bind_param)) goto Err;
		
			$getHeader="SELECT b.NO_NOTA,
						   b.ID_BATALMUAT,
						   b.EMKL,
						   b.ALAMAT,
						   b.NPWP,
						   b.TGL_REQ,
						   b.JENIS,
						   b.VESSEL,
						   b.VOYAGE,
						   TO_CHAR (b.BAYAR, '999,999,999,999') AS TOTAL,
						   TO_CHAR (b.ADM, '999,999,999,999') AS ADM_NOTA,
						   TO_CHAR (b.PPN, '999,999,999,999') AS PPN,
						   TO_CHAR (b.TOTAL, '999,999,999,999') AS TAGIHAN,
						   (SELECT NAME
							  FROM TB_USER a
							 WHERE b.PENGGUNA = a.ID)
							  ID_USER
					  FROM NOTA_batalmuat_h b
					 WHERE b.ID_BATALMUAT = '$no_req' AND status != 'X'";
					 
			$getDetail="SELECT TO_CHAR(a.TARIF, '999,999,999,999') AS TARIF, 
                             TO_CHAR(a.TOTAL, '999,999,999,999') AS SUB_TOTAL, 
                             a.KETERANGAN, 
                             a.HZ, 
                             a.JUMLAH_CONT JUMLAH_CONT, 
                             TO_DATE(a.TGL_START_STACK,'dd/mm/yyyy') START_STACK, 
                             TO_DATE(a.TGL_END_STACK,'dd/mm/yyyy') END_STACK, 
                             b.UKURAN SIZE_, 
                             b.TYPE TYPE, 
                             b.STATUS,
							 a.JUMLAH_HARI
                      FROM TEMP_NOTA_BATALMUAT_D a, master_barang b 
                      WHERE a.ID_CONT = b.KODE_BARANG(+) and a.ID_BATALMUAT = '$no_req' AND KETERANGAN NOT IN ('ADM', 'TARIF MINIMAL')";
		 }
		 
		if(!checkOriSQL($conn['ori']['billing'],$getHeader,$query_header,$err)) goto Err;
		
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
		if(!checkOriSQL($conn['ori']['container'],$getNoContainer,$query_no_cont,$err)) goto Err;
		$data_no_cont = oci_fetch_array($query_no_cont, OCI_ASSOC);
		$output_no_container = $data_no_cont['NO_CONTAINER'];
		while ($data_no_cont = oci_fetch_array($query_no_cont, OCI_ASSOC)){
			$output_no_container = $output_no_container .", ". $data_no_cont['NO_CONTAINER'];
		}
		
		date_default_timezone_set('Asia/Jakarta');
		//$date=date('d M Y H:i:s');
		$date=date('d M Y');

		//RETURN $getDetail;
		if(!checkOriSQL($conn['ori']['billing'],$getDetail,$query_detail,$err)) goto Err;
		$i=0;
		
		//return $getHeader;
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
				
				<tr><td colspan="3" width="200"><font size="10">'.'<b>'.$rows[KETERANGAN].'</b>'.'</font></td>
				
					
				<td width="80" align="left"><font size="10">'.'<b>'.$rows[JUMLAH_CONT].'</b>'.'</font></td>                              
				<td width="120" align="left"><font size="10">'.'<b>'.$rows[SIZE_]." ".$rows[TYPE]." ".$rows[STATUS].'</b>'.'</font></td>                                
					
				<td width="80" align="left"><font size="10">'.'<b>'.$rows[HZ].'</b>'.'</font></td>                        
				<td width="100" align="right"><font size="10">'.'<b>'.$rows[TARIF].'</b>'.'</font></td>                        
				<td width="100" align="right"><font size="10">'.'<b>'.$rows[SUB_TOTAL].'</b>'.'</font></td>        
				</tr>   
				
				<tr>
					<td colspan="8"><font size="10"><i><b>'.$den.'</i></b></font></td>
				 </tr>
				';
			}
			else 
			{                            
				$detail .= '<tr><td colspan="3" width="200"><font size="10">'.'<b>'.$rows[KETERANGAN].'</b>'.'</font></td>
				
					
				<td width="80" align="left"><font size="10">'.'<b>'.$rows[JUMLAH_CONT].'</b>'.'</font></td>                              
				<td width="120" align="left"><font size="10">'.'<b>'.$rows[SIZE_]." ".$rows[TYPE]." ".$rows[STATUS].'</b>'.'</font></td>                                
					
				<td width="80" align="left"><font size="10">'.'<b>'.$rows[HZ].'</b>'.'</font></td>
				
				<td width="100" align="right"><font size="10">'.'<b>'.$rows[TARIF].'</b>'.'</font></td>
				
				<td width="100" align="right"><font size="10">'.'<b>'.$rows[SUB_TOTAL].'</b>'.'</font></td>        
				</tr> 
				 '; 
			}
			$i++;
		}
		
		$tbl = <<<EOD
          <table width="95%">
				<tr>            
					<td COLSPAN="6" align="right"><b><font size="18">Proforma Batal Muat</font></b></td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td width="10%">&nbsp;</td>
					<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;$port_desc</font></b></td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td width="10%">&nbsp;</td>
					<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;$terminal_desc</font></b></td>
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
                 <td COLSPAN="1" align="left"><font size="10"><b>No. Proforma : $data[NO_NOTA]</b></font></td>
                 <td><font size="8"><b>$date</b></font></td>
                </tr> 
                <tr>                    
                    <td COLSPAN="3" align="left"><font size="10"><b>$no_req_ol ($data[ID_BATALMUAT])</b></font>  </td>
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
                    <td COLSPAN="6"><b>BATAL MUAT</b></td>                                        
                </tr>                
                              
                <tr>                    
                    <td width="160px"><b>NAMA PERUSAHAAN</b></td>
					<td width="10px"><b>:</b></td>				
                    <td COLSPAN="4" align="left"><b>$data[EMKL]</b></td>					
                </tr>
                <tr>                    
                    <td width="160px"><b>NPWP</b></td>
					<td width="10px"><b>:</b></td>				
                    <td COLSPAN="4" align="left"><b>$data[NPWP]</b></td>                    
                </tr>
                <tr>                    
                    <td width="160px"><b>ALAMAT</b></td>
					<td width="10px"><b>:</b></td>				
                    <td COLSPAN="6" align="left"><b>$data[ALAMAT]</b></td>					
                </tr>
                <tr>                    
                    <td width="160px"><b>NAMA KAPAL</b></td>
					<td width="10px"><b>:</b></td>				
                    <td COLSPAN="4" align="left"><b>$data[VESSEL] / $data[VOYAGE]</b></td>
                    <td colspan="7"></td>
                </tr>               
                
                <tr>
                <td></td>
                </tr>                                                    
                                
                <tr>                              
					<th colspan="3" width="200"><font size="10"><b>KETERANGAN</b></font></th>                    
                    <th width="80" align="left"><font size="10"><b>BX</b></font></th>
                
                    <th width="120" align="left"><font size="10"><b>CONTENT</b></font></th>
                    <th width="80" align="left"><font size="10"><b>HZ</b></font></th>
                    
                    <th width="100" align="left"><font size="10"><b>TARIF</b></font></th>                    
                    <th width="100" align="left"><font size="10" ><b>JUMLAH</b></font></th>
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
                        <td colspan="5" align="right"><b>Discount :</b></td>
                        <td width="160" colspan="2" align="right"><b>0.00</b></td>
                    </tr>
                    <tr>
                        
                        <td colspan="5" align="right"><b>Administrasi :</b></td>
                        <td colspan="2" align="right"><b>$data[ADM_NOTA]</b></td>
                    </tr>
                    <tr>
                      
                        <td colspan="5" align="right"><b>Dasar Peng. Pajak :</b></td>
                        <td colspan="2" align="right"><b>$data[TAGIHAN]</b></td>
                    </tr>
                    <tr>
                        
                        <td colspan="5" align="right"><b>Jumlah PPN :</b></td>
                        <td colspan="2" align="right"><b>$data[PPN]</b></td>
                    </tr>
                    <tr>
                        
                        <td colspan="5" align="right"><b>Jumlah PPN Subsidi :</b></td>
                        <td colspan="2" align="right"><b>0.00</b></td>
                    </tr>
                    <tr>
                     
                        <td colspan="5" align="right"><font size="10"><b>Jumlah Dibayar :</b></font></td>
                        <td colspan="2" align="right"><font size="10"><b>$data[TOTAL]</b></font></td>
                    </tr>               
                    
                    </table>
                    <br>
                    <br>
                    <br><font size="10"><b>$nm_perusahaan<b></font><br>
					<br><font size="10"><b>$terminal_name<b></font><br>
                
EOD;

		/*$tbl .=<<<EOD
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
                        <td colspan="4" align="left"><font size="10"> <b>$data[NO_NOTA]</b></font></td>
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
          
                
EOD;*/
		$tbl .=<<<EOD
		<table> 
		<tr>
			<td>Diclaimer:</td>
		</tr>
		<tr>
		<td colspan="100">Pranota hanya berlaku selama 3 jam dari pranota itu diterbitkan<br>Dengan menyetujui pranota, pelanggan menyetujui jumlah nominal yang harus dibayarkan
		</td>
		</tr>        

		</table>
EOD;

		
		$html_tcpdf = $tbl;
					
		$data = array(
						"html_tcpdf" => base64_encode($html_tcpdf),
						"proforma_id" => $data[NO_NOTA]
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