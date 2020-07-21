<?php

/*|
 | Function Name 	: getPDFPKK
 | Description 		: get PDF PKK
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getPDFPKK($in_param) {

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

		$getHeader="SELECT NO_UKK,DRAFT_DEPAN,DRAFT_BELAKANG,TO_CHAR(TGL_JAM_TIBA,'DD-MON-YYYY HH24:MI') TGL_JAM_TIBA, TO_CHAR(TGL_JAM_BERANGKAT,'DD-MON-YYYY HH24:MI') TGL_JAM_BERANGKAT, PELABUHAN_ASAL,PELABUHAN_TUJUAN, TO_CHAR(tgl_jam_entry,'DD-MON-YYYY') tgl_jam_entry, PELABUHAN_SEBELUM, PELABUHAN_BERIKUT, ln_tramper, VOYAGE_IN, KEGIATAN, VOYAGE_OUT, NM_AGEN, KD_KAPAL, NM_KAPAL,KP_LOA,KP_GRT,KP_DWT, NM_NEGARA, NAMA_PELAYARAN, KUNJUNGAN, DET_KD_KEMASAN, TRAYEK, DRAFT_DEPAN, DRAFT_BELAKANG FROM V_REPORT_PKK WHERE NO_UKK='".$no_pkk."'";
		if(!checkOriSQL($conn['ori']['kapal'],$getHeader,$query_header,$err)) goto Err;

		//FETCH QUERY
		if ($row = oci_fetch_array($query_header, OCI_ASSOC))
		{
			$header = '
			<table  border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td width="408"><div style="font-weight:bold; text-align:left;">Pemberitahuan Gerakan Kapal (PGK)</div></td>
				</tr>
				<tr>
				  <td>Tanggal entry : '.$row[TGL_JAM_ENTRY].'</td>
				</tr>
			  </table>
			  <br/>
			  <br/>
			  <table  border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td width="528" align="center"><h2>Pemberitahuan Gerakan Kapal (PGK)</h2></td>
				</tr>
			  </table>
			  <br/>
			  <br/>
			  <table  border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td width="100"><strong>No. PGK</strong></td>
				  <td width="175">: '.$row[NO_UKK].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Tgl. Tiba</strong></td>
				  <td width="120">: '.$row[TGL_JAM_TIBA].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Kode/Nama Kapal</strong></td>
				  <td width="175">: '.$row[KD_KAPAL].'/'.$row[NM_KAPAL].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Tgl. Berangkat</strong></td>
				  <td width="120">: '.$row[TGL_JAM_BERANGKAT].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Bendera</strong></td>
				  <td width="175">: '.$row[NM_NEGARA].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>LOA</strong></td>
				  <td width="120">: '.$row[KP_LOA].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Agen</strong></td>
				  <td width="175">: '.$row[NM_AGEN].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>DWT</strong></td>
				  <td width="120">: '.$row[KP_DWT].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Voyage In</strong></td>
				  <td width="175">: '.$row[VOYAGE_IN].' <strong>Out: </strong>'.$row[VOYAGE_OUT].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>GRT</strong></td>
				  <td width="120">: '.$row[KP_GRT].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Pelayaran</strong></td>
				  <td width="175">: '.$row[NAMA_PELAYARAN].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Pel. Asal</strong></td>
				  <td width="120">: '.$row[PELABUHAN_ASAL].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Jen. Kunjungan</strong></td>
				  <td width="175">: '.$row[KUNJUNGAN].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Pel. Sebelum</strong></td>
				  <td width="120">: '.$row[PELABUHAN_SEBELUM].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Jenis Kemasan</strong></td>
				  <td width="175">: '.$row[DET_KD_KEMASAN].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Pel. Berikut</strong></td>
				  <td width="120">: '.$row[PELABUHAN_BERIKUT].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Jenis Kegiatan</strong></td>
				  <td width="175">: '.$row[KEGIATAN].'</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Pel. Akhir</strong></td>
				  <td width="120">: '.$row[PELABUHAN_TUJUAN].'</td>
				</tr>
				<tr>
				  <td width="100"><strong>Trayek</strong></td>
				  <td width="175">: Tramper</td>
				  <td width="20">&nbsp;</td>
				  <td width="130"><strong>Draft Depan/Belakang</strong></td>
				  <td width="120">: '.$row[DRAFT_DEPAN].'/'.$row[DRAFT_BELAKANG].'</td>
				</tr>
			  </table>
				';
		}
		
		// date_default_timezone_set('Asia/Jakarta');
		// $date=date('d M Y H:i:s');

$tbl = <<<EOD

<div style="font-family:serif; font-size:10pt;">
	$header
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