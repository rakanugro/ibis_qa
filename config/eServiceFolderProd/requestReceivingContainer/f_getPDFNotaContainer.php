<?php

/*|
 | Function Name 	: getPDFNotaContainer
 | Description 		: get PDF Nota Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getPDFNotaContainer($in_param) {

	try {
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		
		$no_request = $xml_data->data->no_request;
		$no_request_ol = $xml_data->data->no_request_ol;
		$port_code = $xml_data->data->port_code;
		$terminal_code = $xml_data->data->terminal_code;
		$barcode_location = $xml_data->data->barcode_location;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();
		
		//select connection
		$conn['ori'] = oriDb("BILLING_".$port_code."_".$terminal_code);
		$conn['ibis'] = oriDb("IBIS");
		
		if($port_code=='IDJKT')
		{
			$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
			$corporate_address = "Jln. Raya Pelabuhan No.9  Tanjung Priok";
			$corporate_npwp = "03.276.305.4-093.000";
		}
		else if($port_code=='IDPNK')
		{
			$corporate_name = "PT. IPC TERMINAL PETIKEMAS";
		}
		
		if($terminal_code=='T3I')
		{
			$terminal_name='TERMINAL 3 OCEAN GOING';
		}
		else if($terminal_code=='T009D')
		{
			$terminal_name='TERMINAL 1 DOMESTIK)';
		}		
		else
		{
			$query_id_terminal="SELECT TERMINAL_NAME FROM TERMINAL_CONFIG WHERE ENABLE = 'Y'";

			if(!checkOriSQL($conn['ori']['billing'],$query_id_terminal,$queryIdTerminal,$err)) goto Err;
	
			if ($hasil_id_terminal_ = oci_fetch_array($queryIdTerminal, OCI_ASSOC))
			{
				$terminal_name=$hasil_id_terminal_['TERMINAL_NAME'];
			}
		}
		
		switch($terminal_code)
		{
			case "T3I":
				$jenis_perdagangan = "OCEAN GOING";
			break;
			case "T3D":
			case "T2D":
			case "T1D":
			case "T009D":
				$jenis_perdagangan = "DOMESTIK";
			break;
			default:
			break;
		}
		
		$ket1='TGL AWAL';
		$ket2='TGL AKHIR';
		//$ket3='DELIVERY LIFT ON';
		$ket3='PENUMPUKAN / GERAKAN (RECEIVING)';
		
		$query="select TO_CHAR(DATE_PAID,'DD-MON-YYYY') AS TGL_PROSES,a.NO_FAKTUR_PAJAK, A.NO_NOTA AS KD_UPER, a.NO_REQUEST AS KD_PERMINTAAN, 		A.CUST_NAME NAMA_PELANGGAN, A.CUST_ADDR ALAMAT_PELANGGAN, 
		 A.CUST_NPWP AS NPWP_PELANGGAN, NULL AS NO_UKK, A.NO_DO, A.BONGKAR_MUAT,
		 TO_CHAR(A.TOTAL,'999,999,999,999.00') TOTAL, TO_CHAR(A.PPN,'999,999,999,999.00') PPN, TANGGAL_TIBA,
		 TO_CHAR(A.KREDIT,'999,999,999,999.00') KREDIT, A.KREDIT KREDIT_NUMBER, a.VESSEL AS NM_KAPAL, A.VOYAGE_IN, VOYAGE_OUT, TERBILANG(A.KREDIT) AS TERBILANG,
		 TO_CHAR(nvl((SELECT D.TOTTARIF FROM TTR_NOTA_ALL d 
		 where d.KD_UPER=a.NO_NOTA AND URAIAN='ADM'),0),'999,999,999,999.00') ADM 
		 from tth_nota_all2 a WHERE a.NO_REQUEST='$no_request'";

		if(!checkOriSQL($conn['ori']['billing'],$query,$query_header,$err)) goto Err;

		if ($data = oci_fetch_array($query_header, OCI_ASSOC)){
			// PP RI no. 24 Tahun 2000
			if ($data['KREDIT_NUMBER'] <= 250000){
				$materai_text = "Nota tidak dikenakan Bea Materai";
			} else if ($data['KREDIT_NUMBER'] > 250000 && $data['KREDIT_NUMBER'] <= 1000000){
				$materai_text = "Termasuk Bea Materai Rp 3,000.00";
			} else {
				$materai_text = "Termasuk Bea Materai Rp 6,000.00";
			}
		}
		
		
		$date=date('d M Y H:i:s');
 
		$query_dtl="select URAIAN,TGL_AWAL,TGL_AKHIR,QTY, SIZE_,TYPE_,STATUS_,HZ, TOTHARI, TO_CHAR(TARIF,'999,999,999,999.00') TARIF, TO_CHAR(TOTTARIF,'999,999,999,999.00') TOTTARIF from ttR_nota_all WHERE KD_UPER='".$data[NO_FAKTUR_PAJAK]."' AND URAIAN<>'ADM' ORDER BY LINE_NUMBER";
			if(!checkOriSQL($conn['ori']['billing'],$query_dtl,$queryDetail,$err)) goto Err;
		
		$i=0;
		//FETCH QUERY
		while ($rows = oci_fetch_array($queryDetail, OCI_ASSOC)){
			$detail .= '
			<tr><td colspan="3" width="150"><font size="10">'.$rows[URAIAN].'</font></td>
							<td align="center"><font size="9">'.$rows[TGL_AWAL].'</font></td>
							<td align="center"><font size="9">'.$rows[TGL_AKHIR].'</font></td>
							<td align="center"><font size="10">'.$rows[QTY].'</font></td>    
							<td align="center"><font size="10">'.$rows[SIZE_].'</font></td>
							<td align="center"><font size="10">'.$rows[TYPE_].'</font></td>    
							<td align="center"><font size="10">'.$rows[STATUS_].'</font></td>    
							<td align="center"><font size="10">'.$rows[HZ].'</font></td>
							<td align="center"><font size="10">'.$rows[TOTHARI].'</font></td>
							<td align="right"><font size="10">'.$rows[TARIF].'</font></td>
							<td align="center">IDR</td>
							<td align="right"><font size="10">'.$rows[TOTTARIF].'</font></td>        
							</tr>                        
							
			';
			$i++;
		}
		
		// get config materai
		$query_materai_text="SELECT 
				TEXT_CONFIG, TEXT_CONFIG2
			FROM IBIS.NOTA_CONFIG
			WHERE config_name = 'materai_el' and active = 'Y'";
		if(!checkOriSQL($conn['ibis']['ibis'],$query_materai_text,$query_materai,$err)) goto Err;
		if ($data_materai = oci_fetch_array($query_materai, OCI_ASSOC)){}
		
		// get config kota
		$query_kota_text="SELECT 
				TEXT_CONFIG, TEXT_CONFIG2
			FROM IBIS.NOTA_CONFIG
			WHERE config_name = 'ttd_image' and active = 'Y'";
		if(!checkOriSQL($conn['ibis']['ibis'],$query_kota_text,$query_kota,$err)) goto Err;
		if ($data_kota = oci_fetch_array($query_kota, OCI_ASSOC)){}
		
		// get config TTD
		$query_ttd_text="SELECT 
				TEXT_CONFIG, TEXT_CONFIG2
			FROM IBIS.NOTA_CONFIG
			WHERE config_name = 'ttd_name' and active = 'Y'";
		if(!checkOriSQL($conn['ibis']['ibis'],$query_ttd_text,$query_ttd,$err)) goto Err;
		if ($data_ttd = oci_fetch_array($query_ttd, OCI_ASSOC)){}
		
		$tbl = <<<EOD
			<table>
                <tr>
                    <td width="120"></td><td COLSPAN="12" align="left"><font size="12"><b>$corporate_name | $terminal_name</b></font></td>
                </tr>
                <tr>
                    <td width="120"></td><td COLSPAN="12" align="left"><b>$corporate_address</b></td>
                </tr>
                <tr>
                    <td width="120"></td><td COLSPAN="12" align="left"><b>NPWP : $corporate_npwp</b></td>
                </tr>
                <tr>
                    <td COLSPAN="7"></td>
                    <td COLSPAN="2" align="left" width="80px">No. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="170px">$data[KD_UPER]</td>
                </tr>
                <tr>
                    <td COLSPAN="7"></td>
                    <td COLSPAN="2" align="left">No. Doc</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="170px">$no_request_ol ($data[KD_PERMINTAAN])</td>
                </tr>
                <tr>
                    <td COLSPAN="7"></td>
                    <td COLSPAN="2" align="left">Tgl. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="220px">$data[TGL_PROSES]</td>
                </tr>    
				<tr>
                    <td COLSPAN="7"></td>
                    <td COLSPAN="2" align="left">No. faktur</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="170px">$data[NO_FAKTUR_PAJAK]</td>
                </tr>
                <tr>
                <td></td>
                </tr>
				<tr>
                    <td COLSPAN="14" align="center"><font size="14"><b>NOTA JASA KEPELABUHANAN</b></font></td>
                </tr>
				<tr><td></td></tr>				
                <tr>
                    <td COLSPAN="2"></td>
                    <td COLSPAN="12" align="right"><font size="14"><b>$ket3 $data[TIPE_REQUEST] </b>  </font></td>
                    
                </tr>
                <tr>
                <td></td>
                </tr>
                <tr>
                    <td COLSPAN="2">PEMILIK / PEMAKAI JASA</td>
					<td width="10px">:</td>
                    <td COLSPAN="5" align="left">$data[NAMA_PELANGGAN]</td>
                    <td colspan="2"></td>
                    <td colspan="4" align="right" >$data[BONGKAR_MUAT]</td>					
                </tr>
                <tr>
                    <td COLSPAN="2">ALAMAT</td>
					<td width="10px">:</td>
                    <td COLSPAN="5" align="left">$data[ALAMAT_PELANGGAN]</td>
                    <td colspan="2" ></td>
                    <td colspan="4" align="right" >  $dono $data[NO_DO]</td>					
                </tr>				
                <tr>
                    <td COLSPAN="2">NPWP</td>
					<td width="10px">:</td>
                    <td COLSPAN="5" align="left">$data[NPWP_PELANGGAN]</td>
                    <td colspan="2"></td>
                    <td colspan="4" align="right" >$peb  $blno</td>
                </tr>
                <tr>
                    <td COLSPAN="2">NAMA KAPAL/VOY/TANGGAL</td>
					<td width="10px">:</td>
                    <td COLSPAN="7" align="left">$data[NM_KAPAL] / $data[VOYAGE_IN] - $data[VOYAGE_OUT]</td>
                    <td colspan="4" ALIGN="right">$data[TANGGAL_TIBA]</td>
                </tr>
                <tr>
                    <td COLSPAN="2">JENIS PERDAGANGAN</td>
					<td width="10px">:</td>
                    <td COLSPAN="7" align="left">$jenis_perdagangan</td>
                    <td colspan="4" ALIGN="right"></td>
                </tr>
                <tr>
                <td colspan="12"></td>
                </tr> 
                <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
                <tr>
                    <th colspan="3" width="150"><font size="8"><b>KETERANGAN</b></font></th>
                    <th width="65" align="left"><font size="8"><b>$ket1</b></font></th>
                    <th width="65" align="left"><font size="8"><b>$ket2</b></font></th>
                    <th width="32" align="center"><font size="8"><b>BOX</b></font></th>
                    <th width="32" align="center"><font size="8"><b>SIZE</b></font></th>
                    <th width="32" align="center"><font size="8"><b>TYPE</b></font></th>
                    <th width="32" align="center"><font size="8"><b>STS</b></font></th>
                    <th width="32" align="center"><font size="8"><b>HZ</b></font></th>
                    <th width="32" align="center"><font size="8"><b>HARI/SHIFT</b></font></th>
                    <th width="90" align="center"><font size="8"><b>TARIF</b></font></th>
                    <th width="30" align="center"><font size="8"><b>VAL</b></font></th>
                    <th width="115" align="center"><font size="8" ><b>JUMLAH</b></font></th>
                </tr>
                <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
				$detail
				<tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
				
                </table>
                
EOD;
			$tbl .=<<<EOD
			<table>                    
                    <tr>
                        <td colspan="7" rowspan="6"><img height="125" width="125" src="$barcode_location" /></td>
                        <td width="180" colspan="3" align="right"><font size="10">Discount :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10">0.00</font></td>
                    </tr>
                    <tr>
                        <td width="180" colspan="3" align="right"><font size="10">Administrasi :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10">$data[ADM]</font></td>
                    </tr>
                    <tr>
                        <td width="180" colspan="3" align="right"><font size="10">Dasar Pengenaan Pajak :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10">$data[TOTAL]</font></td>
                    </tr>
                    <tr>
                        <td width="180" colspan="3" align="right"><font size="10">Jumlah PPN :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10">$data[PPN]</font></td>
                    </tr>
                    <tr>
                        <td width="180" colspan="3" align="right"><font size="10">Jumlah PPN Subsidi :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10">0.00</font></td>
                    </tr>
                    <tr>
                        <td width="180" colspan="3" align="right"><font size="10">Jumlah Dibayar :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10">$data[KREDIT]</font></td>
                    </tr>
                    </table>
					<table>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>

					<tr>
					<td>&nbsp;</td>
					</tr>

					<tr>
					<td>
					<p>USER : $_SESSION[NAMA_PENGGUNA]</p>
					</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>

					<!--tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr-->

					<tr height="20">
					<td >
					<p>Nota sebagai faktur pajak berdasarkan Peraturan Dirjen Pajak</p>
					</td>
					</tr>
					<tr>
					<td>
					<p>Per - 27/PJ/2011 tanggal 19 September 2011</p>
					</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td width="550px">
					Berdasarkan Peraturan Pemerintah Republik Indonesia No. 24 Tahun 2000 dan Ijin Pembubuhan Bea Materai Lunas dengan Sistem Komputerisasi dari Dir. Jen. Pajak Nomor :
					$data_materai[TEXT_CONFIG]
					Tanggal $data_materai[TEXT_CONFIG2]
					</td>
					<td width="150px">
						<table cellpadding="5" border="1">
							<tr><td><b>$materai_text</b></td></tr>
						</table>
					</td>
					</tr>
					<!--tr>
					<td>&nbsp;</td>
					</tr-->
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr height="200">
					<td>
					<p># $data[TERBILANG] Rupiah</p>
					</td>
					</tr>
					<tr height="50">
					<td align="right">
					</td>
					</tr>
					<tr height="50">
					<td align="right" width="700px">
					<p>$data_kota[TEXT_CONFIG], $data[TGL_PROSES]</p>
					<p>$data_ttd[TEXT_CONFIG]</p>
					<p></p>
					<p></p>
					<p></p>
					<p>$data_ttd[TEXT_CONFIG2]</p>
					</td>
					</tr>
</table>
EOD;
		$html_tcpdf = $tbl;
					
		$data = array(
						"html_tcpdf" => base64_encode($html_tcpdf),
						"faktur_id" => $data[NO_FAKTUR_PAJAK]
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