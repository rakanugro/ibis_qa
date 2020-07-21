<?php

/*|
 | Function Name 	: getPDFDPJK
 | Description 		: get PDF DPJK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFDPJK($in_param) {

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

		$getHeader="SELECT H.*, UPPER(kapal_prod.all_general_pkg.get_subsidiary_branch_name('JAI',F_GET_KD_CABANG_BY_UKK(NO_UKK),TO_DATE(SUBSTR(H.TGL_JAM_TIBA,1,10),'dd-mm-yyyy'))) cabang1 FROM v_dpjk_header H WHERE H.NO_UKK = '".$no_pkk."'";
		if(!checkOriSQL($conn['ori']['kapal'],$getHeader,$query_header,$err)) goto Err;
		
		$font_header = '20pt';
		$font_detail = '13pt';

		//FETCH QUERY
		if ($row = oci_fetch_array($query_header, OCI_ASSOC))
		{
			$sql_data_nota = "select distinct NO_NOTA, NO_NOTA_PREV from SIMKEU_DATA_NOTA_TMP where no_ukk = '".$no_pkk."'";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_data_nota,$query_data_nota,$err)) goto Err;
			$row_data_nota = oci_fetch_array($query_data_nota, OCI_ASSOC);
			$header = '
			<table border="0" cellspacing="4" cellpadding="0">
				<tr>
				  <td width="400"><div style="font-size:'.$font_detail.'" align="left">'.$row[CABANG1].'</div></td>
				  <td width="180">&nbsp;</td>
				   <td width="350" colspan="2"><div style="font-size:'.$font_detail.'" align="left"></div></td>
				 
				</tr>
				<tr>
				  <td width="400"><div style="font-size:'.$font_detail.'" align="left">CABANG '.$row[NM_CABANG].'</div></td>
				  <td width="180">&nbsp;</td>
				  <td width="150"><div style="font-size:'.$font_detail.'" align="left">BENTUK 3A </div></td>
				  <td width="200"><div style="font-size:'.$font_detail.'" align="left">: '.$row_data_nota["NO_NOTA"].'</div> </td>
				</tr>
				';
				
			if($row_data_nota["NO_NOTA_PREV"] != '' )  {
				$header .= '
				<tr>
				
				  <td width="400"><div style="font-size:'.$font_detail.'" align="left"></div></td>
				  <td width="180">&nbsp;</td>
				  <td width="150"><div style="font-size:'.$font_detail.'" align="left">
				  EX NOTA 
				   </div></td>
				  <td width="200"><div style="font-size:'.$font_detail.'" align="left">: '.$row_data_nota[NO_NOTA_PREV].'</div></td>
				</tr>
				';
			}
			$header .= '
				<tr>
				  <td width="400">&nbsp;</td>
				  <td width="180">&nbsp;</td>
				  <td width="150"><div style="font-size:'.$font_detail.'" align="left">TANGGAL </div></td>
				  <td width="200"><div style="font-size:'.$font_detail.'" align="left">: '.$row[TGL_DPJK].'</div></td>
				</tr>
				
			  </table>
			  <br />
			  
		<div style="font-size:'.$font_header.'" align="center"><b>DAFTAR PERHITUNGAN - JASA 
		  KAPAL</b></div>
			  <br />
			  <hr />
			  <div style="font-size:'.$font_detail.'"><b>
				<table align="center"border="0" cellspacing="2" cellpadding="0">
				  <tr>
					<td width="160" height="15"><div align="left">NAMA KAPAL</div></td>
					<td width="300" height="15"><div align="left">: '.$row[NM_KAPAL].'</div></td>
					<td width="140" height="15"><div align="left">KUNJUNGAN</div></td>
					<td width="360" height="15"><div align="left">: '.$row[KUNJUNGAN].' / '.$row[KD_KEGIATAN].'</div></td>
				  </tr>
				  <tr>
					<td width="160" height="15"><div align="left">KODE KAPAL/No. UKK</div></td>
					<td width="300" height="15"><div align="left">: '.$row[KD_KAPAL].' / '.$row[NO_UKK].'</div></td>
					<td width="140" height="15"><div align="left">MASA KUNJUNGAN</div></td>
					<td width="360" height="15"><div align="left">: '.$row[TGL_JAM_TIBA].' s/d '.$row[TGL_JAM_BERANGKAT].'</div></td>
				  </tr>
				  <tr>
					<td width="160" height="15"><div align="left">AGEN</div></td>
					<td width="300" height="15"><div align="left">: '.$row[KD_AGEN].' ~ '.$row[NM_AGEN].'</div></td>
					<td width="140" height="15"><div align="left">GT/LOA</div></td>
					<td width="360" height="15"><div align="left">: '.$row[KP_GRT].' Ton / '.$row[KP_LOA].' Meter</div></td>
				  </tr>
				  <tr>
					<td width="160" height="15"><div align="left">BENDERA</div></td>
					<td width="300" height="15"><div align="left">: '.$row[KD_BENDERA_KAPAL].' / '.$row[NM_NEGARA_KAPAL].'</div></td>
					<td width="140" height="15"><div align="left">ASAL/TUJUAN</div></td>
					<td width="360" height="15"><div align="left">: '.$row[NM_PELABUHAN_ASAL].' /&nbsp;'.$row[NM_PELABUHAN_TUJUAN].'</div></td>
				  </tr>
				  <tr>
					<td width="160" height="15">&nbsp;</td>
					<td width="300" height="15">&nbsp;</td>
					<td width="140" height="15"><div align="left">SEBELUM/BERIKUT</div></td>
					<td width="360" height="15"><div align="left">: '.$row[NM_PELABUHAN_SEBELUM].' / '.$row[NM_PELABUHAN_BERIKUT].'</div></td>
				  </tr>
				  <tr>
					<td width="160" height="15"><div align="left">JENIS PELAYARAN</div></td>
					<td width="300" height="15"><div align="left">: '.$row[PELAYARAN_KAPAL].' / '.$row[LNTRAMPER].'</div></td>
					<td width="140" height="15"><div align="left">No. 1A/JENIS KAPAL</div></td>
					<td width="360" height="15"><div align="left">: '.$row[KD_PPKB].' / '.$row[NAMA_JENIS_KAPAL].'</div></td>
				  </tr>
				  <tr>
					<td width="160" height="15">&nbsp;</td>
					<td width="350" height="15">&nbsp;</td>
					<td width="140" height="15">&nbsp;</td>
					<td width="310" height="15">&nbsp;</td>
				  </tr>
				</table>';
			
			$pelayaran = $row[PELAYARAN_KAPAL];
		}
		
		// date_default_timezone_set('Asia/Jakarta');
		// $date=date('d M Y H:i:s');

		$getDetail="SELECT tt_dpjk.uraian, tt_dpjk.form1a, tt_dpjk.ppkb_ke, tt_dpjk.form2a,
				   tt_dpjk.no_ukk, tt_dpjk.kd_gerakan, tt_dpjk.dari, tt_dpjk.ke,
				   tgl_jam_mulai, 
				tgl_jam_selesai, 
				   tt_dpjk.uraian1, tt_dpjk.uraian2, tt_dpjk.uraian3, tt_dpjk.uraian4, tt_dpjk.uraian5, 
				   tt_dpjk.uraian3, tt_dpjk.formula_a,
				   tt_dpjk.keterangan_formula_a, tt_dpjk.formula_b,
				   tt_dpjk.keterangan_formula_b, tt_dpjk.formula_c,
				   tt_dpjk.keterangan_formula_c, tt_dpjk.formula_d,
				   tt_dpjk.keterangan_formula_d, tt_dpjk.keterangan_perhitungan,
				   tt_dpjk.jumlah, tt_dpjk.id_tt_dpjk, tt_dpjk.keterangan_jumlah,
				   (SELECT nm_kade || ' Ke ' from mst_kade where kd_kade = tt_dpjk.DARI) gerakan_dari,
				   (SELECT nm_kade from mst_kade where kd_kade = tt_dpjk.KE) gerakan_ke,
				   (SELECT 'Gerakan ' || gerakan || ' : ' from mst_gerakan where kd_gerakan = tt_dpjk.kd_gerakan) gerakan,
				   bentuk_3a, uraian3, uraian5
				   FROM tt_dpjk
				   WHERE tt_dpjk.NO_UKK_2='".$no_pkk."'
				   order by tt_dpjk.id_tt_dpjk";
		//print_R($query_dtl);die;
		
		if(!checkOriSQL($conn['ori']['kapal'],$getDetail,$query_detail,$err)) goto Err;
		while ($datum = oci_fetch_array($query_detail, OCI_ASSOC))
		{
			if ($datum["URAIAN"] == 'UANG LABUH' AND $datum["URAIAN2"] == '') {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left"> '.$datum[URAIAN].' </div></td>
					  <td width="110" height="25" align="center">'.$datum[PPKB_KE].'</td>
					  <td width="100" height="25">'.$datum[FORM2A].'</td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN"] == 'UANG TAMBAT') {
				$detail.='
					<tr>
					  <td width="110" height="25" align="left"> '.$datum[URAIAN].'</td>
					  <td width="110" height="25" align="center"></td>
					  <td width="100" height="25"></td>
					  <td width="120" height="25"></td>
					  <td width="130" height="25"></td>
					  <td width="220" height="25" align="left"><div align="left"></div></td>
					  <td width="30" height="25" align="right">&nbsp;</td>
					  <td width="110" align="right"><div align="right"></div></td>
					</tr>
					<tr>
					  <td width="110" height="25" align="left"> '.$datum[URAIAN1].'</td>
					  <td width="110" height="25" align="center">'.$datum[PPKB_KE].'</td>
					  <td width="100" height="25">'.$datum[FORM2A].'</td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"><div align="left">'.$datum[URAIAN4].'</div></td>
					  <td width="30" height="25" align="right">&nbsp;</td>
					  <td width="110" align="right"><div align="right"></div></td>
					</tr>
				'; 
			}
			
			// untuk mendapatkan keterangan uraian MASA
			$masa = substr($datum["URAIAN1"],0,4);
			if ($masa == "MASA") {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left"></div></td>
					  <td width="110" height="25" align="center"><div align="left"></div></td>
					  <td width="100" height="25"><div align="center">'.$datum[URAIAN1].'</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["GERAKAN"] != '' AND $datum["GERAKAN_DARI"] != '' AND $datum["GERAKAN_KE"] != '' AND $datum["URAIAN"] == 'UANG PANDU') {
				$detail.='<tr>
					  <td width="535" height="25" colspan="8"><div align="left">'.$datum[GERAKAN].''.$datum[GERAKAN_DARI].''.$datum[GERAKAN_KE].'</div></td>
				</tr>';
			}
				
			if ($datum["URAIAN"] == 'UANG PANDU' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left">'.$datum[URAIAN].'</div></td>
					  <td width="110" height="25" align="center"><div align="center">'.$datum[PPKB_KE].'</div></td>
					  <td width="100" height="25"><div align="center">'.$datum[FORM2A].'</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left">'.$datum[URAIAN5].' : '.$datum[KETERANGAN_PERHITUNGAN].'</td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}		
			
			if ($datum["URAIAN2"] == 'TARIF TAMBAHAN') {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left"></div></td>
					  <td width="210" height="25" colspan="2" align="center"><div align="right">'.$datum[URAIAN2].' : </div></td>
					  <td width="120" height="25"></td>
					  <td width="130" height="25"></td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}		
			
			if ($datum["URAIAN2"] == 'TARIF STANDBY') {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left"></div></td>
					  <td width="210" height="25" colspan="2" align="center"><div align="right">'.$datum[URAIAN2].' : </div></td>
					  <td width="120" height="25"></td>
					  <td width="130" height="25"></td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}		
			
			if ($datum["URAIAN"] == 'UANG TUNDA') {
				$detail.='
					<tr>
					  <td width="530" height="25" colspan="5"><div align="left"> '.$datum[URAIAN].' '.$datum[URAIAN1].' </div></td>
					  <td width="220" height="25" align="left"><div align="left"></div></td>
					  <td width="30" height="25" align="right">&nbsp;</td>
					  <td width="110" align="right"><div align="right"></div></td>
					</tr>
				'; 
			}
			
			if ($datum["URAIAN2"] == 'TARIF TETAP' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN2"] == 'TARIF VARIABEL' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN2"] == 'PEMBULATAN TARIF PAKET' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25"></td>
					  <td width="130" height="25"></td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN2"] == 'SURCHARGE' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			//Tambahan untuk tarif Paket Tunda Cabang Pangkal Balam (Tofan, 22/12/2015)
			if ($datum["URAIAN2"] == 'PAKET' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			//Tambahan untuk Penyesuaian tarif paket
			if ($datum["URAIAN"] == 'PENYESUAIAN TARIF PAKET' ) {
				$detail.='
					<tr>
					  <td width="220" height="25" colspan="2"><div align="left">'.$datum[URAIAN].'</div></td>
					  <td width="100" height="25"><div align="center">'.$datum[FORM2A].'</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left">'.$datum[URAIAN5].' '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN2"] == 'BIAYA TETAP EMERGENCY' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN2"] == 'SURCHARGE EMERGENCY' ) {
				$detail.='
					<tr>
					  <td width="110" height="25"></td>
					  <td width="210" height="25" colspan="2"><div align="left">'.$datum[URAIAN2].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN"] == 'UANG KEPIL' ) {
				$detail.='
					<tr>
					  <td width="110" height="25" align="left">'.$datum[URAIAN].'</td>
					  <td width="210" height="25" colspan="2" align="left">'.$datum[URAIAN1].'</td>
					 
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN3"] != "") {
				$detail.='
					<tr>
					  <td width="320" height="25" colspan="3" align="left">'.$datum[URAIAN3].'</td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25" align="center">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="center"><div align="left">'.$datum[KETERANGAN_PERHITUNGAN].' </div></td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right">'.$datum[KETERANGAN_JUMLAH].'</td>
					</tr>
				';
			}	
			
			if ($datum["URAIAN"] == 'UANG SAMPAH') {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left"> '.$datum[URAIAN].' </div></td>
					 
					  <td width="110" height="25" align="center">'.$datum[FORM2A].'</td>
					   <td width="100" height="25" align="left"></td>
					  <td width="120" height="25">'.$datum[TGL_JAM_MULAI].'</td>
					  <td width="130" height="25">'.$datum[TGL_JAM_SELESAI].'</td>
					  <td width="220" height="25" align="left"> '.$datum[KETERANGAN_PERHITUNGAN].' </td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN"] == 'PEMBULATAN ATAS PELY JASA MINIMAL') {
				$detail.='
					<tr>
					  <td width="110" height="25"><div align="left"> '.$datum[URAIAN].' </div></td>
					  <td width="30" height="25" align="center"></td>
					  <td width="65" height="25">&nbsp;</td>
					  <td width="80" height="25">&nbsp;</td>
					  <td width="130" height="25">&nbsp;</td>
					  <td width="220" height="25" align="left">&nbsp;</td>
					  <td width="30" height="25" align="right">'.$datum[KETERANGAN_FORMULA_D].'</td>
					  <td width="110" align="right"><div align="right">'.$datum[KETERANGAN_JUMLAH].'</div></td>
					</tr>
				';
			}
			
			if ($datum["URAIAN"] == 'BONGKAR/MUAT') {
				$data_bm = $datum;    
			} else {
				$bawah.= "";
			}
			$pranota=$datum['BENTUK_3A'];
		}
		
		$getNota="select * from TT_DPJK_TOTAL WHERE NO_UKK = '".$no_pkk."'";
		if(!checkOriSQL($conn['ori']['kapal'],$getNota,$query_nota,$err)) goto Err;
		if($dataNota = oci_fetch_array($query_nota, OCI_ASSOC))
		{
			$bntk_nota=substr($pranota,0,2);
			if ($bntk_nota == '01')
			{
				$dataNota["PPN_D_SENDIRI"] = $dataNota["PPN_DIKENAKAN_10"];
				$dataNota["PPN_D_PEMUNGUT"] = "0,00";
				$dataNota["PPN_TIDAK_DIPUNGUT"] = "0,00";
				$dataNota["PPN_DIBEBASKAN"] = "0,00";
			}
			else if ($bntk_nota == '03')
			{
				$dataNota["PPN_D_SENDIRI"] = "0,00";
				$dataNota["PPN_D_PEMUNGUT"] = $dataNota["PPN_DIBEBASKAN_10"];
				$dataNota["PPN_TIDAK_DIPUNGUT"] = "0,00";
				$dataNota["PPN_DIBEBASKAN"] = "0,00";
			}
			else if ($bntk_nota == '07')
			{
				$dataNota["PPN_D_SENDIRI"] = "0,00";
				$dataNota["PPN_D_PEMUNGUT"] = "0,00";
				$dataNota["PPN_TIDAK_DIPUNGUT"] = $dataNota["PPN_DIBEBASKAN_10"];
				$dataNota["PPN_DIBEBASKAN"] = "0,00";
			}
			else if ($bntk_nota == '08')
			{
				$dataNota["PPN_D_SENDIRI"] = "0,00";
				$dataNota["PPN_D_PEMUNGUT"] = "0,00";
				$dataNota["PPN_TIDAK_DIPUNGUT"] = "0,00";
				$dataNota["PPN_DIBEBASKAN"] = $dataNota["PPN_DIBEBASKAN_10"];
			}
			
			$bawah.='
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
							<td width="320" height="10" colspan="3" align="left">PAJAK PERTAMBAHAN NILAI</td>
						   
							<td width="140" height="10" align="center">&nbsp;</td>
							<td width="30" height="10" align="right"></td>
							<td width="70" height="10" align="right"></td>
						  </tr>
						  <tr>
							<td width="320" height="10" colspan="3" align="left">- DASAR PERHITUNGAN PAJAK</td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="220" height="10" align="center"><div align="left"></div></td>
							<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
							<td width="110" height="10" align="right">'.$dataNota[KET_DPP].'</td>
						  </tr>
						  
						  <tr>
								<td width="570" height="10" colspan="5" align="left">a. PPN dipungut sendiri</td>
								<td width="220" height="10" align="right"></td>
								<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
								<td width="110" height="10" align="right"> '.$dataNota[PPN_D_SENDIRI].' </td>
							  </tr>
							  <tr>
								<td width="570" height="10" colspan="5" align="left">b. PPN dipungut Pemungut</td>
								<td width="220" height="10" align="right"></td>
								<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
								<td width="110" height="10" align="right"> '.$dataNota[PPN_D_PEMUNGUT].' </td>
							  </tr>
							  <tr>
								<td width="570" height="10" colspan="5" align="left">c. PPN tidak dipungut</td>
								<td width="220" height="10" align="right"></td>
								<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
								<td width="110" height="10" align="right"> '.$dataNota[PPN_TIDAK_DIPUNGUT].' </td>
							  </tr>
							  <tr>
								<td width="570" height="10" colspan="5" align="left">d. PPN dibebaskan</td>
								<td width="220" height="10" align="right"></td>
								<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
								<td width="110" height="10" align="right"> '.$dataNota[PPN_DIBEBASKAN].' </td>
						</tr>';
						
		if($dataNota[ADMINISTRASI] > '0') {
			$bawah.='
						<tr>
						  <td height="10" colspan="5" align="left" width="570">ADMINISTRASI</td>
						  <td width="220" height="10" align="right">&nbsp;</td>
						  <td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
						  <td width="110" height="10" align="right">'.$dataNota[KET_ADMINISTRASI].' </td>
						</tr>';
		}		  
			$no=1;
			$bawah.='
						  <tr>
							<td width="930" colspan="8"><hr style="b dashed"/></td>
						  </tr>
						  <tr>
							<td width="320" height="10" colspan="3" align="left">'.$no.'. JUMLAH PERHITUNGAN</td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="220" height="10" align="center"><div align="left"></div></td>
							<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
							<td width="110" height="10" align="right">'.$dataNota[KET_JUMLAH_TAGIHAN2].'</td>
						  </tr>';
			
		if ($dataNota[UANG_ADMINISTRASI] != "0") {
			$no++;
			$bawah.='
						<tr>
							<td width="250" height="13" colspan="3" align="left">'.$no.'. ADM PERTAMINA 10% x PANDU </td>
							<td width="140" height="13"></td>
							<td width="180" height="13" align="center"></td>
							<td width="220" height="13" align="center"><div align="left"></div></td>
							<td width="30" height="13" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
							<td width="110" height="13" align="right">'.$dataNota[KET_UANG_ADMINISTRASI].'</td>
						</tr>';
		}
		
		$sql_cek="select amount_usd_to_idr_pkg.convert_usd_to_idr('".$no_pkk."') as cek from dual";
		if(!checkOriSQL($conn['ori']['kapal'],$sql_cek,$query_cek,$err)) goto Err;
		$row_cek = oci_fetch_array($query_cek, OCI_ASSOC);
		if($row_cek['CEK']=='1') {
			############
			# Get Kurs Detail per 1 Juli 2015
			$sql_kurs = "SELECT TO_CHAR(KURS_DATE,'DD MON RRRR') KURS_DATE,  NUM2CHARFORMATDUIT_RP(KURS_RATE) KURS_RATE FROM PKK WHERE NO_UKK = '".$no_pkk."'";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_kurs,$query_kurs,$err)) goto Err;
			$row_kurs = oci_fetch_array($query_kurs, OCI_ASSOC);
			$no++;
			$bawah.='
						<tr>
							<td width="320" height="10" colspan="3" align="left">'.$no.'. KURS YANG BERLAKU</td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="220" height="10" align="right">1 USD = &nbsp;&nbsp;</td>
							<td width="30" height="10" align="right">Rp.</td>
							<td width="110" height="10" align="right">'.$row_kurs[KURS_RATE].'</td>
						</tr>
			';
			$no++;
			$bawah.='
						<tr>
							<td width="320" height="10" colspan="3" align="left">'.$no.'. JUMLAH PERHITUNGAN (DALAM RUPIAH)</td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="220" height="10" align="right">1 USD = &nbsp;&nbsp;</td>
							<td width="30" height="10" align="right">Rp.</td>
							<td width="110" height="10" align="right">'.$dataNota[JML_TAGIHAN_KURS].'</td>
						</tr>
			';
			$dataNota[SIGN_CURRENCY]="Rp.";
		}
		
			$no++;
			$bawah.='
						  <tr>
							<td width="320" height="10" colspan="3" align="left">
						'.$no.'. UANG JAMINAN NO
			';
			
			#############################
			# CREATE PPKB KE
			#############################
			$param_ppkb_ke = array(
							"KD_PPKB"=>$row["KD_PPKB"],
							"P_OUT"=>""
						  );

			$sql_ppkb_ke = "BEGIN SP_NO_UPER(:KD_PPKB,:P_OUT); END;";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_ppkb_ke,$query_ppkb_ke,$err,$param_ppkb_ke)) goto Err;
			$uper_ppkb_ke = $param_ppkb_ke['P_OUT'];
			
			if ($dataNota["KET_UANG_JAMINAN"] != "0,00") {
				$bawah.=$uper_ppkb_ke;
			}
			
			$no++;
			$bawah.='
							</td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="220" height="10" align="center"><div align="left"></div></td>
							<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
							<td width="110" height="10" align="right">'.$dataNota[KET_UANG_JAMINAN].'</td>
						  </tr>
						  <tr>
							<td width="320" height="10" colspan="3" align="left">'.$no.'.
			';
			
			if (($dataNota["PIUTANG"] == "0") &&($dataNota["SISA_UPER"] != "0")){
				$bawah.='SISA UPER';
			}
			if ($dataNota["SISA_UPER"] == "0") {
				$bawah.='PIUTANG';
			}
			
			$bawah.='
							</td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="220" height="10" align="center"><div align="left"></div></td>
							<td width="30" height="10" align="right">'.$dataNota[SIGN_CURRENCY].'</td>
							<td width="110" height="10" align="right">
			';
			
			if (($dataNota["PIUTANG"] == "0") ){
				$bawah.=$dataNota[SISA_UPER];
			}
			if ($dataNota["SISA_UPER"] == "0") {
				$bawah.=$dataNota[PIUTANG];
			}
			
			$sql_pp6974 = "select INFO_69_74_KPL as info from pkk where no_ukk='".$no_pkk."'";
			if(!checkOriSQL($conn['ori']['kapal'],$sql_pp6974,$query_pp6974,$err)) goto Err;
			$pp6974 = oci_fetch_array($query_pp6974, OCI_ASSOC);
			
			$bawah.='
					    </td>
						  </tr>
						  <tr>
							<td colspan="8" width="930"><hr style="b dashed"/></td>
						  </tr>
						  <tr>
							 <td colspan="8" width="930"><div style="font-size:8" align="left"><em>'.$pp6974[INFO].'</em></div></td>
						  </tr>
						  <tr>
							<td colspan="8" width="930"><hr style="b dashed"/></td>
						  </tr>
						  <tr>
							<td width="320" height="10" colspan="3" align="left"> BONGKAR/MUAT	'.$data_bm[URAIAN1].' </td>
							<td width="120" height="10"></td>
							<td width="130" height="10" align="center"></td>
							<td width="250" height="10" align="center" colspan="2"><div align="left">'.$data_bm[URAIAN2].'</div></td>
						   
							<td width="110" height="10" align="right"></td>
						  </tr>
						  <tr>
							<td colspan="4" height="10" width="930" align="left"> TERBILANG&nbsp;&nbsp;&nbsp;&nbsp; :
			';
			
			if ($dataNota["PIUTANG"] == "0") {
				$bawah.=$dataNota[SISA_UPER_NUMWORD]; 
			}
			if ($dataNota["SISA_UPER"] == "0") {
				$bawah.=$dataNota[PIUTANG_NUMWORD]; 
			}

			$bawah.='
							</td>
						  </tr>
				</table>
			';
		}

$tbl = <<<EOD

<div style="font-family:serif;">
      $header
		
        <hr />
        <table height="10" border="0" align="center" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th width="110" height="25"><div align="left"><strong>URAIAN</strong></div></th>
              <th width="110" height="25"><div align="center"><strong>1A-KE</strong></div></th>
              <th width="100" height="25"><strong>NO.2A</strong></th>
              <th width="120" height="25"><strong>TGL. JAM MULAI</strong></th>
              <th width="130" height="25"><strong>TGL. JAM SELESAI</strong></th>
              <th width="220" height="25"><div align="left"><strong>PERHITUNGAN</strong></div></th>
              <th width="30" height="25">&nbsp;</th>
              <th width="110" height="25"><div align="right"><strong>JUMLAH</strong></div></th>
          </thead>
          </tr>
        
          <hr />
		  
          $detail
         
        </table>
		
		
</b></div>
	 <div style="font-size:$font_detail">
	 <b>
		 $bawah
	</b>
 </div>
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