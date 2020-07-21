<?php

/*|
 | Function Name 	: getPDFNota
 | Description 		: get PDF Nota
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFNota($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb("KAPAL");//hanya ambil koneksi ke kapal
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$no_pkk = $xml_data->data->no_pkk;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();

		$getHeader="SELECT H.*, all_general_pkg.get_subsidiary_branch_name('KAPAL','01',TO_DATE(SUBSTR(H.TGL_JAM_TIBA,1,10),'dd-mm-yyyy')) cabang1 FROM v_dpjk_header H WHERE H.NO_UKK = '".$no_pkk."'";
		if(!checkOriSQL($conn['ori']['kapal'],$getHeader,$query_header,$err)) goto Err;
		
		$date = date("d-m-Y");

		$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
		$corporate_address = "Jln. Raya Pelabuhan No.9  Tanjung Priok";
		$corporate_npwp = "03.276.305.4-093.000";
			
		//FETCH QUERY
		if ($row = oci_fetch_array($query_header, OCI_ASSOC))
		{
			$sql_data_nota = "select distinct NO_NOTA, NO_NOTA_PREV from kapal_prod.SIMKEU_DATA_NOTA_TMP where no_ukk = '".$no_pkk."'";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_data_nota,$query_data_nota,$err)) goto Err;
			$row_data_nota = oci_fetch_array($query_data_nota, OCI_ASSOC);
			$header.=<<<EOD
			<table>
                <tr>
                    <td width="100"></td><td COLSPAN="12" align="left"><font size="12"><b>$corporate_name</b></font></td>
                </tr>
                <tr>
                    <td width="100"></td><td COLSPAN="12" align="left"><b>$corporate_address</b></td>
                </tr>
                <tr>
                    <td width="100"></td><td COLSPAN="12" align="left"><b>NPWP : $corporate_npwp</b></td>
                </tr>
                <tr>
                    <td COLSPAN="8"></td>
                    <td COLSPAN="2" align="left" width="80px">No. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="170px">$row_data_nota[NO_NOTA]</td>
                </tr>
                <tr>
                    <td COLSPAN="8"></td>
                    <td COLSPAN="2" align="left">P.P.K.P</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="170px">PKP.051.00123.03.89</td>
                </tr>
                <tr>
                    <td COLSPAN="8"></td>
                    <td COLSPAN="2" align="left">Tgl. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="220px">$date</td>
                </tr>    
				<tr>
                    <td COLSPAN="8"></td>
                    <td COLSPAN="2" align="left">No. faktur</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="170px">$row_data_nota[NO_NOTA]</td>
                </tr>				
                <tr>
                <td></td>
                </tr>
				<tr>
                    <td COLSPAN="12" align="center"><font size="14"><b>NOTA JASA KEPELABUHANAN</b></font></td>
                </tr>
				<tr><td></td></tr>				
                <tr>
					<td COLSPAN="3"></td>
                    <td COLSPAN="9" align="right"><font size="14"><b>KAPAL</b></font></td>
                </tr>
				<tr><td></td></tr>
			</table>
				
			<!--<div style="font-family:Serif; font-size:6pt;">
			<table width="500" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="130"><div style="font-size:6pt" align="left">$row[CABANG1]</div></td>
				<td width="230">&nbsp;</td>
				<td width="100">FM.01/01/01/74</td>
				  <td width="40">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="130"><div style="font-size:6pt" align="left"></div></td>
				<td width="230">&nbsp;</td>
				<td width="100">TANGGAL : $date</td>
				<td width="40">&nbsp;</td>
			  </tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="200"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="140">NPWP</td>
					<td width="110">: $row[NO_NPWP]</td>
				  </tr>
				  <tr>
					<td width="140">P.P.K.P</td>
					<td width="110">: PKP.051.00123.03.89</td>
				  </tr>
				  <tr>
					<td width="140">Kode Dan No Seri Faktur Pajak</td>
					<td>: 010.010-09.01016012</td>
				  </tr>
				  </table></td>
				<td width="160">&nbsp;</td>
				<td width="200"><strong>NOMOR NOTA :$row_data_nota[NO_NOTA]</strong></td>
			  </tr>		  
			</table>
			</div>-->
			<!--<h2 align="center">NOTA DAN PERHITUNGAN JASA</h2>
			<hr style="border: B dashed;"/>-->
			<table align="center"border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td width="90"><div align="left">NAMA PERUSAHAAN</div></td>
				  <td width="280"><div align="left">: $row[NM_AGEN]</div></td>
				  <td width="90"><div align="left">UNTUK KAPAL</div></td>
				  <td width="200"><div align="left">: $row[NM_KAPAL]</div></td>
				</tr>
				<tr> 
				  <td width="90"><div align="left">NOMOR ACCOUNT</div></td>
				  <td width="280"><div align="left">: $row[NO_ACCOUNT] </div></td>
				  <td width="90"><div align="left">PERIODE KUNJUNGAN</div></td>
				  <td width="200"><div align="left">: $row[TGL_JAM_TIBA] <strong>s</strong>/<strong>d</strong> <br/>&nbsp;&nbsp;&nbsp;$row[TGL_JAM_BERANGKAT]</div></td>
				</tr>
				<tr> 
				  <td width="90"><div align="left">N.P.W.P</div></td>
				  <td width="280"><div align="left">: $row[NO_NPWP]</div></td>
				  <td width="90"><div align="left">NOMOR UPER</div></td>
EOD;

			if($PARTIED['KD_THREE_PARTIED']== 2){
				$header.='<td width="200"><div align="left">: '.$row[KD_PPKB].' </div></td>';
			}
			else{
				$header.='<td width="200"><div align="left">: - </div></td>';
			}
			$header.='
				</tr>
				<tr> 
				  <td width="90"><div align="left">ALAMAT</div></td>
				  <td width="280"><div align="left">: '.$row[ALMT_AGEN].' </div></td>
				  <td width="90"><div align="left">BUKTI PENDUKUNG</div></td>
				  <td width="200"><div align="left">: TERLAMPIR</div></td>
				</tr>
			</table>
			<br>
			<hr style="border: B dashed;"/>
			';
			
		}
		
		// date_default_timezone_set('Asia/Jakarta');
		// $date=date('d M Y H:i:s');

		$getDetail="SELECT
					sign_currency,
					dpp,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(LABUH,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(LABUH,2)) 
					END labuh,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(tambat,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(tambat,2)) 
					END tambat,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(pandu,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(pandu,2)) 
					END pandu,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(tunda,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(tunda,2)) 
					END tunda,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(kepil,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(kepil,2)) 
					END kepil,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(air,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(air,2)) 
					END air,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(sampah,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(sampah,2)) 
					END sampah,
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(lain_lain,0)) 
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(lain_lain,2)) 
					END lain_lain,
					ket_dpp AS dpp,
					CASE WHEN f_currency_plb(no_ukk) = '1' AND DPP > 200000
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dikenakan_jumlah,0))*0.1),0) + Round((Sum(Round(ppn_dibebaskan_jumlah,0))*0.1),0))
					WHEN f_currency_plb(no_ukk) = '2' AND DPP > 22
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dikenakan_jumlah,2))*0.1),2) + Round((Sum(Round(ppn_dibebaskan_jumlah,2))*0.1),2))
					WHEN f_currency_plb(no_ukk) = '1' AND DPP <= 200000
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dikenakan_jumlah,0))*0.1),0) + Round(200000 - (Sum(Round(ppn_dikenakan_jumlah,0))),0)*0.1)
					WHEN f_currency_plb(no_ukk) = '2' AND DPP <= 22
					THEN num2charformatduit_rp(Round( 22 - (Sum(Round(ppn_dibebaskan_jumlah,2))),2)*0.1 + Round((Sum(Round(ppn_dibebaskan_jumlah,2))*0.1),2))
					END PPN_10_PERSEN,
					CASE WHEN f_currency_plb(no_ukk) = '1' AND DPP > 200000
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dikenakan_jumlah,0))*0.1),0))
					WHEN f_currency_plb(no_ukk) = '2' AND DPP > 22
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dikenakan_jumlah,2))*0.1),2))
					WHEN f_currency_plb(no_ukk) = '1' AND DPP <= 200000
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dikenakan_jumlah,0))*0.1),0))
					WHEN f_currency_plb(no_ukk) = '2' AND DPP <= 22
					THEN num2charformatduit_rp(Round( 22 - (Sum(Round(ppn_dibebaskan_jumlah,2))),2)*0.1)
					END ppn_dikenakan_10, 
					CASE WHEN f_currency_plb(no_ukk) = '1' AND DPP > 200000
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dibebaskan_jumlah,0))*0.1),0))
					WHEN f_currency_plb(no_ukk) = '2' AND DPP > 22
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dibebaskan_jumlah,2))*0.1),2))
					WHEN f_currency_plb(no_ukk) = '1' AND DPP <= 200000
					THEN num2charformatduit_rp(Round(200000 - (Sum(Round(ppn_dikenakan_jumlah,0))),0)*0.1)
					WHEN f_currency_plb(no_ukk) = '2' AND DPP <= 22
					THEN num2charformatduit_rp(Round((Sum(Round(ppn_dibebaskan_jumlah,2))*0.1),2))
					END ppn_dibebaskan_10, 
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(dpp+Sum(ppn_dikenakan_jumlah)*0.1,0))
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(dpp+Sum(ppn_dikenakan_jumlah)*0.1,2))
					END jumlah_tagihan, 
					CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(uang_jaminan,0))
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(uang_jaminan,0))
					END uang_jaminan, 
					NO_NOTA,
					CASE WHEN (dpp+Sum(ppn_dikenakan_jumlah)*0.1) > uang_jaminan
					THEN CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round((dpp+Sum(ppn_dikenakan_jumlah)*0.1)-uang_jaminan,0))
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round((dpp+Sum(ppn_dikenakan_jumlah)*0.1)-uang_jaminan,2))
					END 
					ELSE '0'
					END piutang,
					CASE WHEN uang_jaminan > (dpp+Sum(ppn_dikenakan_jumlah)*0.1)
					THEN CASE WHEN f_currency_plb(no_ukk) = '1' 
					THEN num2charformatduit_rp(Round(uang_jaminan - (dpp+Sum(ppn_dikenakan_jumlah)*0.1),0))
					WHEN f_currency_plb(no_ukk) = '2' 
					THEN num2charformatduit_rp(Round(uang_jaminan - (dpp+Sum(ppn_dikenakan_jumlah)*0.1),2))
					END 
					ELSE '0'
					END sisa_uper
					FROM v_nota_lv2 WHERE NO_UKK = '".$no_pkk."'
					group by sign_currency, labuh, tambat, pandu, tunda, kepil,
					sampah, air, ket_dpp, dpp, no_nota,no_ukk,uang_jaminan";
		//print_R($query_dtl);die;
		
		if(!checkOriSQL($conn['ori']['kapal'],$getDetail,$query_detail,$err)) goto Err;
		if ($datum = oci_fetch_array($query_detail, OCI_ASSOC))
		{
			$detail.='
				<table width="" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="350"><br/><br/>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">1.Jenis Kapal
						  <br/>        
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">1) Uang Labuh</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">2) Uang Tambat</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">3) Uang Air</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">4) Uang Pandu</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">5) Uang Tunda</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">6) Uang Kepil Darat</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">7) Uang Sampah</td>
							  </tr>
							<tr>
							  <td width="5">&nbsp;</td>
							  <td width="120">8) Uang Lain Lain</td>
							  </tr>
							</table>
						  </td>
						<td width="20">
						  <br/>        
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SIGN_CURRENCY].'</td>
							  </tr>
							</table>
						  </td>
						<td width="120" align="right">&nbsp;
						  <br/>        
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td>'.$datum[LABUH].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[TAMBAT].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[AIR].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[PANDU].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[TUNDA].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[KEPIL].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[SAMPAH].'</td>
							  </tr>
							<tr>
							  <td>'.$datum[LAIN_LAIN].'</td>
							  </tr>
							</table>
						  </td>
					  </tr>
					   <tr>
						<td width="20">&nbsp;</td>
						<td width="140">&nbsp;</td>
						<td width="20"><hr style="B dashed;"/></td>
						<td width="120"><hr style="B dashed;"/></td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">&nbsp;&nbsp;&nbsp;Jumlah / DPP</td>
						<td width="20" ><strong>'.$datum[SIGN_CURRENCY].'</strong></td>
						<td width="120" align="right" ><strong>'.$datum[DPP].'</strong></td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">2.PPN 10%</td>
						<td width="20">'.$datum[SIGN_CURRENCY].'</td>
						<td width="120" align="right">'.$datum[PPN_10_PERSEN].'</td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">&nbsp;&nbsp;a. PPN Dikenakan</td>
						<td width="20">'.$datum[SIGN_CURRENCY].'</td>
						<td width="120" align="right">'.$datum[PPN_DIKENAKAN_10].'</td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">&nbsp;&nbsp;b. PPN Dibebaskan</td>
						<td width="20">'.$datum[SIGN_CURRENCY].'</td>
						<td width="120" align="right">'.$datum[PPN_DIBEBASKAN_10].'</td>
					  </tr>
					 <tr>
						<td width="20">&nbsp;</td>
						<td width="140">&nbsp;</td>
						<td width="20"><hr style="B dashed;"/></td>
						<td width="120"><hr style="B dashed;"/></td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">3.Jumlah Tagihan</td>
						<td width="20">'.$datum[SIGN_CURRENCY].'</td>
						<td width="120" align="right">'.$datum[JUMLAH_TAGIHAN].'</td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">4.Uang Jaminan</td>
						<td width="20">'.$datum[SIGN_CURRENCY].'</td>
						<td width="120" align="right">'.$datum[UANG_JAMINAN].'</td>
					  </tr> 	
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">5.
			';
			if ($data["PIUTANG"] == "0") {
				$detail.='Sisa Uper';
						  
			}
			if ($data["SISA_UPER"] == "0") {
				$detail.='Piutang';
			}
			$detail.='	
						</td>
						<td width="20">'.$datum[SIGN_CURRENCY].'</td>
						<td width="120" align="right">
				';
			if ($data["PIUTANG"] == "0") {
				$detail.=$datum["SISA_UPER"];
			}
			if ($data["SISA_UPER"] == "0") {
				$detail.=$datum["PIUTANG"];
			}
			$detail.='
					  	</td>
					  </tr>
					  <tr>
						<td width="20">&nbsp;</td>
						<td width="140">&nbsp;</td>
						<td width="20"><hr style="B dashed;"/></td>
						<td width="120"><hr style="B dashed;"/></td>
					  </tr>
					</table>
						
					</td>
					<td width="190">
					<table width="190" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td colspan="2" width="190"><strong>Ketentuan</strong></td>
						</tr>
					  <tr>
						<td width="10">1.</td>
						<td width="180">
							Pembayaran harus dilunasi dalam 8 hari
							kerja setelah nota ini diterima, jika tidak
							dikenakan denda 2% per bulan atau sanksi yg lain.
						</td>
					  </tr>
					  <tr>
						<td width="10">2.</td>
						<td width="180">terhadap nota yang diajukan koreksi harus dilunasi terlebih dahulu</td>
					  </tr>
					  <tr>
						<td width="10">3.</td>
						<td width="180">Batas waktu pengajuan koreksi adalah 5 hari kerja stelah nota diterima</td>
					  </tr>
					  <tr>
						<td width="10">4.</td>
						<td width="180">
							pembayaran nota ini dianggap sah jika ada cap kas register PT.(PERSERO)
							PELABUHAN INDONESIA II cabang TANJUNG PRIOK pada kwitansi pelunasan nota
							cap dari Bank. 
						</td>
					  </tr>
					</table>
					</td>
				  </tr>
				</table>
				<br/>
				<table border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="190" align="center" valign="top"><br/>
					<table align="center" width="70%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>Telah diperiksa</td>
				  </tr>
				  <tr>
					<td height="30">&nbsp;</td>
				  </tr>
				  <tr>
					<td>(----------------)</td>
				  </tr>
				  <tr>
					<td>Nama Jelas<br/>tgl.</td>
				  </tr>
				</table>

				</td>
				<td width="160" align="left">&nbsp;</td>
				<td width="160" align="left"> 
					<table width="">
					<tr>
						<td width="100%"><h4>Tanjung Priok, {$date}</h4>
						</td>
					</tr>
					<tr>
					 <td width="100%" align="left"><STRONG>PT. PELABUHAN TANJUNG PRIOK</STRONG></td>
					</tr>
					<tr>
					 <td width="100%" align="center">A.N DIREKTUR KEUANGAN<br/>MANAGER KEUANGAN,</td>
					</tr>
				
						<tr>
						 <td width="100%" height="30">&nbsp;</td>
						</tr>
						<tr>
						 <td width="100%"></td>
						</tr>
						<tr>
						 <td width="100%" align="center">
								 <u>M.SYAEFULLAH AS</u><br/>
								NIPP.
						 257083785
						 </td>
						</tr>
					  </table>
					</td>
				</tr>
			</table>
			';
		}
		
		$bawah.='
			<table width="500" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="160"><em>'.$row[CABANG1].'</em></td>
				<td width="220">&nbsp;</td>
				<td width="100">
		';
		if ($data["PIUTANG"] == "0") {
			$bawah.='SISA UPER';
		}
		if ($data["SISA_UPER"] == "0") {
			$bawah.='PIUTANG';
		}
		$bawah.='
				  </td>
			  </tr>
			  <tr>
				<td width="160"></td>
				<td width="220">&nbsp;</td>
				<td width="100">NO.NOTA : <strong>'.$datum[NO_NOTA].'</strong></td>
			  </tr>
			</table>

			<hr style="border: B dashed;"/>
			<table border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="210" align="center" valign="top"><br/>
				<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="40%" align="left">&nbsp;</td>
				<td width="60%" align="left">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="40%" align="left">Nama Perusahaan</td>
				<td width="60%" align="left">: '.$row[NM_AGEN].'</td>
			  </tr>
			  <tr>
				<td width="40%" align="left">Nomor Account</td>
				<td width="60%" align="left">: '.$row[NO_ACCOUNT].'</td>
			  </tr>
			  <tr>
				<td width="40%" align="left">Untuk Kapal</td>
				<td width="60%" align="left">: '.$row[NM_KAPAL].'</td>
			  </tr>
			  <tr>
				<td width="40%" align="left">Jumlah Uang</td>
				<td width="60%" align="left">: RP
		';
		if ($data["PIUTANG"] == "0") {
			$bawah.=$data["SISA_UPER"];
		}
		if ($data["SISA_UPER"] == "0") {
			$bawah.=$data["PIUTANG"];
		}
		$bawah.='
				  </td>
			  </tr>
			</table>

				</td>
				<td width="140" align="left">&nbsp;</td>
				<td width="160" align="left"> 
					<table width="">
					<tr>
						<td width="100%"><h4>Tanjung Priok, '.$date.'</h4>
						</td>
					</tr>
					<tr>
					 <td width="100%" align="left"><STRONG>PT. PELABUHAN TANJUNG PRIOK</STRONG></td>
					</tr>
					<tr>
					 <td width="100%" align="center">A.N DIREKTUR KEUANGAN<br/>MANAGER KEUANGAN,</td>
					</tr>
				
						<tr>
						 <td width="100%" height="30">&nbsp;</td>
						</tr>
						<tr>
						 <td width="100%"></td>
						</tr>
						<tr>
						 <td width="100%" align="center">
								<u>M.SYAEFULLAH AS</u><br/>
								NIPP.
						 257083785</td>
						</tr>
					  </table>
					</td>
				</tr>
			</table>

			<hr style="border: B dashed;"/>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="200">SERI NO.</td>
			  </tr>
			</table>
		';

$tbl = <<<EOD

<div style="font-family:Serif; font-size:7.5pt;">
      $header
	  $detail
	  $bawah
</div>
EOD;
		
		$html_tcpdf = $tbl;
					
		$data = array(
						"html_tcpdf" => base64_encode($html_tcpdf)
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