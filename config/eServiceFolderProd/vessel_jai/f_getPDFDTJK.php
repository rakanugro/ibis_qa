<?php

/*|
 | Function Name 	: getPDFDTJK
 | Description 		: get PDF DTJK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFDTJK($in_param) {

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

		$getHeader="SELECT
				  PPKB.KD_PPKB,
				  MST_AGEN.KD_AGEN,
				  MST_AGEN.NM_AGEN,
				  PKK.NO_UKK,
				  PKK.KD_KAPAL_AGEN,
				  decode(MST_KAPAL.LN_TRAMPER,'1','REGULER','NON REGULER') LNTRAMPER,
				  --to_char(DTJK.MS_KUNJUNGAN_AWAL, 'dd-mm-yyyy hh24:mi') TGL_JAM_TIBA,
				  --to_char(DTJK.MS_KUNJUNGAN_AKHIR, 'dd-mm-yyyy hh24:mi') TGL_JAM_BERANGKAT,
				  to_char(pkk.TGL_JAM_TIBA, 'dd-mm-yyyy hh24:mi') TGL_JAM_TIBA,
				  to_char(pkk.TGL_JAM_BERANGKAT, 'dd-mm-yyyy hh24:mi') TGL_JAM_BERANGKAT,
				  MST_KAPAL.KD_KAPAL,
				  MST_KAPAL.NM_KAPAL,
				  (SELECT NAMA_PELAYARAN FROM MST_JENIS_PELAYARAN WHERE JN_PELAYARAN = PKK.KD_PELAYARAN) PELAYARAN_KAPAL,
				  NUM2CHARFORMAT(MST_KAPAL.KP_LOA) KP_LOA,
				  NUM2CHARFORMAT(MST_KAPAL.KP_GRT) KP_GRT,
				  PKK.PELABUHAN_ASAL,
				  (SELECT NM_PELABUHAN FROM MST_PELABUHAN WHERE KD_PELABUHAN = PKK.PELABUHAN_ASAL) NM_PELABUHAN_ASAL,
				  (SELECT B.NM_NEGARA FROM MST_PELABUHAN A, MST_BENDERA B WHERE KD_PELABUHAN = PKK.PELABUHAN_ASAL AND A.KD_BENDERA = B.KD_BENDERA) NM_NEGARA_ASAL,
				  PKK.PELABUHAN_TUJUAN,
				  (SELECT NM_PELABUHAN FROM MST_PELABUHAN WHERE KD_PELABUHAN = PKK.PELABUHAN_TUJUAN) NM_PELABUHAN_TUJUAN,
				  (SELECT B.NM_NEGARA FROM MST_PELABUHAN A, MST_BENDERA B WHERE KD_PELABUHAN = PKK.PELABUHAN_TUJUAN AND A.KD_BENDERA = B.KD_BENDERA) NM_NEGARA_TUJUAN,
				   (SELECT NM_PELABUHAN FROM MST_PELABUHAN WHERE KD_PELABUHAN = PKK.PELABUHAN_BERIKUT) NM_PELABUHAN_BERIKUT,
				  (SELECT B.NM_NEGARA FROM MST_PELABUHAN A, MST_BENDERA B WHERE KD_PELABUHAN = PKK.PELABUHAN_BERIKUT AND A.KD_BENDERA = B.KD_BENDERA) NM_NEGARA_BERIKUT,
				  (SELECT NM_PELABUHAN FROM MST_PELABUHAN WHERE KD_PELABUHAN = PKK.PELABUHAN_SEBELUM) NM_PELABUHAN_SEBELUM,
				  (SELECT B.NM_NEGARA FROM MST_PELABUHAN A, MST_BENDERA B WHERE KD_PELABUHAN = PKK.PELABUHAN_SEBELUM AND A.KD_BENDERA = B.KD_BENDERA) NM_NEGARA_SEBELUM,
				  (SELECT kunjungan FROM mst_kunjungan WHERE mst_kunjungan.kd_kunjungan = pkk.kd_kunjungan) nm_kunjungan,  
				  (SELECT KEGIATAN FROM MST_KEGIATAN   WHERE MST_KEGIATAN.KD_KEGIATAN = pkk.KD_KEGIATAN ) NM_KEGIATAN,
				  (SELECT nm_negara FROM MST_BENDERA WHERE kd_bendera = mst_kapal.kd_bendera) nm_negara, mst_kapal.kd_bendera,
				  (SELECT nama_jenis_kapal from MST_JENIS_KAPAL WHERE ID_JENIS_KAPAL = mst_kapal.JN_KAPAL) JN_KAPAL,
				  to_char(sysdate,'DD-MM-YYYY') TGL_DTJK, UPPER(kapal_prod.all_general_pkg.get_subsidiary_branch_name('JAI',F_GET_KD_CABANG_BY_UKK(PKK.NO_UKK),TO_DATE(TO_CHAR(PKK.TGL_JAM_TIBA,'dd-mm-yyyy'),'dd-mm-yyyy'))) CABANG1,
				  MST_CABANG.NM_CABANG NAMA_CABANG
				FROM
				  PPKB,
				  PKK,
				  MST_KAPAL_AGEN,
				  MST_KAPAL,
				  MST_AGEN,
				  MST_CABANG,
				  MST_BENDERA,
				  MST_KUNJUNGAN,
				  MST_PELAYARAN,
				  MST_JENIS_KAPAL,
				  MST_PROSES_PKK,
				  STATUS_PKK,
				  RPK
				WHERE
				  RPK.KD_RPK (+) = PPKB.KD_RPK
				  AND PKK.NO_UKK = PPKB.NO_UKK (+)
				  AND PKK.KD_KAPAL_AGEN = MST_KAPAL_AGEN.KD_KAPAL_AGEN
				  AND MST_KAPAL_AGEN.KD_KAPAL = MST_KAPAL.KD_KAPAL
				  AND MST_KAPAL_AGEN.KD_AGEN = MST_AGEN.KD_AGEN
				  AND MST_KAPAL_AGEN.KD_CABANG = MST_CABANG.KD_CABANG
				  AND MST_KAPAL.KD_BENDERA = MST_BENDERA.KD_BENDERA
				 -- AND PKK.KD_PELAYARAN = MST_JENIS_PELAYARAN.JN_PELAYARAN
				  AND PKK.KD_KUNJUNGAN = MST_KUNJUNGAN.KD_KUNJUNGAN
				  AND MST_KAPAL.JN_KAPAL = MST_JENIS_KAPAL.ID_JENIS_KAPAL
				  AND PKK.KD_PROSES = MST_PROSES_PKK.KD_PROSES
				  AND PKK.KD_PKK_STATUS = STATUS_PKK.KD_PKK_STATUS
				  AND PKK.NO_UKK = '".$no_pkk."'";
		if(!checkOriSQL($conn['ori']['kapal'],$getHeader,$query_header,$err)) goto Err;
		
		$font_header = '20pt';
		$font_detail = '13pt';

		//FETCH QUERY
		if ($row = oci_fetch_array($query_header, OCI_ASSOC))
		{
			$header = '
			<table border="0" cellpadding="0" cellspacing="2">
			<tr>
			  <td width="270"><div style="font-size:'.$font_detail.'" align="left">'.$row[CABANG1].'</div></td>
			  <td width="500">&nbsp;</td>
			  <td colspan="2"><div style="font-size:'.$font_detail.'" align="left"></div></td>
			</tr>
			<tr>
			  <td width="270"><div style="font-size:'.$font_detail.'" align="left">CABANG '.$row[NAMA_CABANG].'</div></td>
			  <td width="500">&nbsp;</td>
			  <td width="70"><div style="font-size:'.$font_detail.'" align="left">TANGGAL</div></td>
			  <td width="132"><div style="font-size:'.$font_detail.'" align="left">: '.$row[TGL_DTJK].'</div></td>
			</tr>
			<tr>
			  <td width="270">&nbsp;</td>
			  <td width="500">&nbsp;</td>
			  <td width="70"></td>
			  <td width="132">&nbsp;</td>
			</tr>
			<tr>
			  <td width="270">&nbsp;</td>
			  <td width="500">&nbsp;</td>
			  <td width="70">&nbsp;</td>
			  <td width="132">&nbsp;</td>
			</tr>
		  </table>
		  <div style="font-size:'.$font_header.'" align="center"><b>DATA TRANSAKSI - JASA KAPAL </b> </div>
		  <div style="font-size:'.$font_detail.'" align="center"><b>TANGGAL KAPAL KELUAR : '.$row[TGL_JAM_BERANGKAT].'</b> </div>
		  <div style="font-size:'.$font_detail.'"> <b>
			<hr />
			<table align="center" border="0" cellspacing="2" cellpadding="0">
			  <tr>
				<td width="150"><div align="left"></div></td>
				<td width="290">&nbsp;</td>
				<td width="160">&nbsp;</td>
				<td width="360">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="150"><div align="left">NAMA KAPAL</div></td>
				<td width="290"><div align="left">: '.$row[NM_KAPAL].'</div></td>
				<td width="160"><div align="left">KUNJUNGAN/KEGIATAN</div></td>
				<td width="360"><div align="left">: '.$row[NM_KUNJUNGAN].' / '.$row[NM_KEGIATAN].'</div></td>
			  </tr>
			  <tr>
				<td width="150"><div align="left">KODE KAPAL/No. UKK</div></td>
				<td width="290"><div align="left">: '.$row[KD_KAPAL].' / '.$row[NO_UKK].'</div></td>
				<td width="160"><div align="left">MASA KUNJUNGAN</div></td>
				<td width="360"><div align="left">: '.$row[TGL_JAM_TIBA].' s/d '.$row[TGL_JAM_BERANGKAT].'</div></td>
			  </tr>
			  <tr>
				<td width="150"><div align="left">AGEN</div></td>
				<td width="290"><div align="left">: '.$row[KD_AGEN].' ~ '.$row[NM_AGEN].'</div></td>
				<td width="160"><div align="left">GT/LOA</div></td>
				<td width="360"><div align="left">: '.$row[KP_GRT].' Ton / '.$row[KP_LOA].' Meter </div></td>
			  </tr>
			  <tr>
				<td width="150"><div align="left">BENDERA</div></td>
				<td width="290"><div align="left">: '.$row[KD_BENDERA].' / '.$row[NM_NEGARA].'</div></td>
				<td width="160"><div align="left">ASAL/TUJUAN</div></td>
				<td width="360"><div align="left">: '.$row[NM_PELABUHAN_ASAL].'&nbsp; 
					/ &nbsp;'.$row[NM_PELABUHAN_TUJUAN].'</div></td>
			  </tr>
			  <tr>
				<td width="150"><div align="left">JENIS PELAYARAN</div></td>
				<td width="290"><div align="left">: '.$row[PELAYARAN_KAPAL].' / '.$row[LNTRAMPER].' </div></td>
				<td width="160"><div align="left">SEBELUM/BERIKUT</div></td>
				<td width="360"><div align="left">: '.$row[NM_PELABUHAN_SEBELUM].'&nbsp; 
					/ &nbsp;'.$row[NM_PELABUHAN_BERIKUT].'</div></td>
			  </tr>
			  <tr>
				<td width="150"><div align="left">JENIS KAPAL</div></td>
				<td width="290"><div align="left">: '.$row[JN_KAPAL].'</div></td>
				<td width="160"><div align="left">No. Form 1A</div></td>
				<td width="360"><div align="left">: '.$row[KD_PPKB].' </div></td>
			  </tr>
			  <tr>
				<td width="150">&nbsp;</td>
				<td width="290">&nbsp;</td>
				<td width="160">&nbsp;</td>
				<td width="360">&nbsp;</td>
			  </tr>
			</table>';
		}
		
		// date_default_timezone_set('Asia/Jakarta');
		// $date=date('d M Y H:i:s');

		$getDetail="SELECT tt_dtjk.uraian, tt_dtjk.ppkb_ke, tt_dtjk.form2a, 
				   tt_dtjk.tgl_jam_mulai,
				   tt_dtjk.tgl_jam_selesai,
				   tt_dtjk.keterangan1, tt_dtjk.ket_uraian, keterangan2, TT_DTJK.KETERANGAN3
			  FROM 
				   tt_dtjk
			  WHERE tt_dtjk.NO_UKK_2='".$no_pkk."'
			  order by tt_dtjk.id_tt_dtjk";
		//print_R($query_dtl);die;
		
		if(!checkOriSQL($conn['ori']['kapal'],$getDetail,$query_detail,$err)) goto Err;
		while ($row = oci_fetch_array($query_detail, OCI_ASSOC))
		{
			if($row["URAIAN"] == 'PANDU' OR $row["URAIAN"] == 'TUNDA'  ){
				$detail.='
				<tr height="15">
					<td width="380" height="25" colspan="4"><div align="left">
						'.$row["KET_URAIAN"].' &nbsp;&nbsp;&nbsp;&nbsp;'. $row["FORM2A"].'
					</div></td>
					<td width="160" height="25"> &nbsp;&nbsp;:'.$row["KETERANGAN2"].'</td>
				</tr>
				<tr>
				  <td width="160" height="25"></td>
				  <td width="40" height="25">'.$row[PPKB_KE].'</td>
				  <td width="120" height="25"></td>
				  <td width="120" height="25"> '.$row[TGL_JAM_MULAI].' </td>
				  <td width="140" height="25"> '.$row[TGL_JAM_SELESAI].' </td>
				  <td width="350" height="25"><div align="left">'.$row[KETERANGAN1].' </div></td>
				  <td></td>
			    </tr>
				';
				if ($row["KETERANGAN3"] != '') {
					$detail.='
						<tr>
							<td height="25" colspan="6" align="left">'.$row[KETERANGAN3].'</td>
						</tr>
					';
				}
				else {
					$detail.='';
				}
			}
			else {
				if ($row["URAIAN"] == 'BONGKAR/MUAT')
					$detail.=' <hr />';
				
				$detail.='
					<tr height="15">
						<td width="160" height="25"><div align="left">
							'.$row["URAIAN"] .'&nbsp;&nbsp;&nbsp;'. $row["KET_URAIAN"].'
						</div></td>
						<td width="40" height="25">'.$row[PPKB_KE].'</td>
					    <td width="120" height="25">'.$row[FORM2A].'</td>
					    <td width="120" height="25"> '.$row[TGL_JAM_MULAI].' </td>
					    <td width="140" height="25"> '.$row[TGL_JAM_SELESAI].' </td>
					    <td width="350" height="25"><div align="left">'.$row[KETERANGAN1].' 
				';
				
				if ($row[KETERANGAN2] != '')
					$detail.=$row["KETERANGAN2"];
					
				$detail.='
							</div></td>
					    <td></td>
					</tr>
				';
			}
		}

$tbl = <<<EOD

<div style="font-family:serif;">
      $header
        <table align="center" border="0" cellspacing="0" cellpadding="0">
          <hr />
          <br />
          <hr />
          <tr>
            <th width="160" height="25"><div align="left"><strong>URAIAN</strong></div></th>
            <th width="40" height="25" align="left"><strong>1A-KE</strong></th>
            <th width="120" height="25"><strong>NO.BUKTI</strong></th>
            <th width="120" height="25"><strong>TGL- JAM MULAI</strong></th>
            <th width="140" height="25"><strong>TGL- JAM SELESAI</strong></th>
            <th width="350" height="25"><div align="left"><strong>KETERANGAN</strong></div></th>
          </tr>
          <hr />
		  $detail
        </table>
        
      </div></b>
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