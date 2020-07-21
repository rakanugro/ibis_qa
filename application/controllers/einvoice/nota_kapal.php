<?php
date_default_timezone_set("Asia/Bangkok");
if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
require(APPPATH . 'helpers/tcpdf/tcpdf.php');
class Nota_kapal extends CI_Controller
{

	var $API = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('auth_model', 'auth_model');
		/*if (! $this->session->userdata('is_login') ){
		 	redirect('main_invoice');
		}*/
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		$this->load->library('MX_Encryption');
		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		// if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
		// 	redirect(ROOT.'mainpage', 'refresh');
		/*if (! $this->session->userdata('is_login') ){
				if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
				{
					redirect(ROOT.'mainpage', 'refresh');
				}
			}*/
		$this->API = API_EINVOICE;
		$this->load->library('Nama_fungsi');
	}



	protected function getdataurl($url)
	{

		// $uri = SITE_WSAPI.'/'.$url;
		//$uri = $this->API.'/'.$url;
		$uri = API_EINVOICE . '/' . $url;
		// print_r($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		$data = json_decode(curl_exec($ch));
		return $data;
	}




	protected function senddataurl($url, $data, $type)
	{
		//$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
		$uri = API_EINVOICE . '/' . $url;
		// die($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/x-www-form-urlencoded',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$ex = curl_exec($ch);
		$result = json_decode($ex);
		#debug file
		file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
			array(
				"body" => $ex,
				"url" => $uri,
				"data" => $data,
			),
			true
		), FILE_APPEND);
		return $result;
	}


	public function get_nota_redaksi($id, $layanan)
	{
		return $this->auth_model->get_nota_redaksi($id, $layanan);

	}



	public function cetak_nota_kapal($trx)
	{
		$this->load->helper('nota_invoice_helper');
		// $id = $trx;
		$id = $this->mx_encryption->decrypt($trx);
		$paramStatus['BILLER_REQUEST_ID'] = $id;
		$resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

		/*$real_token = md5(sha1(md5(base64_encode($trx))));

		if($check_token != $real_token) {
			echo 'invalid token';
			die();
		}*/

		$postdata = array(
			'TRX_NUMBER' => $id,
			'MODULE' => 'KAPAL'
		);
		//$data_header = $this->senddataurl('invh/search/',$postdata,'POST');
		$headerKpl = $this->getdataurl('invh/pdf/KAPAL/' . $id);

		// echo print_r($headerKpl);die();
		$num = $headerKpl->TRX_NUMBER;
		$tgl_nota = $headerKpl->TRX_DATE;
			//print_r($tgl_nota);die;
		$org_id = $headerKpl->ORG_ID;
		$custname = $headerKpl->CUSTOMER_NAME;
		$c_number = $headerKpl->CUSTOMER_NUMBER;
		$c_address = $headerKpl->CUSTOMER_ADDRESS;
		$nomornpwp = $headerKpl->CUSTOMER_NPWP;
		$kapal = $headerKpl->VESSEL_NAME;
		$kunjungan = $headerKpl->INTERFACE_HEADER_ATTRIBUTE4;
		$to_kun = $headerKpl->PER_KUNJUNGAN_TO;
		$no_req = $headerKpl->BILLER_REQUEST_ID;
		$dagang = $headerKpl->JENIS_PERDAGANGAN;
		$current = $headerKpl->CURRENCY_CODE;
		$ex_num = $headerKpl->TRX_NUMBER_PREV;
		$unit_loc = $headerKpl->INV_UNIT_LOCATION;
			// echo "||";print_r($ex_num);echo "||";die();
		$header_context = $headerKpl->HEADER_SUB_CONTEXT;
		$headerContext = $headerKpl->HEADER_CONTEXT;
		$entityId = $headerKpl->INV_ENTITY_ID;
		$amountMaterai = ($headerKpl->AMOUNT_MATERAI == '') ? "0" : $headerKpl->AMOUNT_MATERAI;
			// $amountMaterai = 6000;
		$redaksi = "-";
		if ($entityId != "") {
				/*$getmaterai = array("TOTAL_TAGIHAN"=>$headerKpl->AMOUNT,"ORG_ID"=>$this->session->userdata('unit_id'),"BRANCH_CODE"=>$this->session->userdata('unit_org'),"HEADER_CONTEXT"=>$headerContext);
				$redaksis = $this->senddataurl('GetEmaterai',$getmaterai,'POST');
				$amountMaterai = $redaksis->NILAI_MATERAI;
				$redaksi = $redaksis->INV_EMATERAI_REDAKSI;*/
			//$dataPost2 = array("INV_ENTITY_ID" => $entityId);
			//$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi', $dataPost2, 'POST');
			
			$dataPost2 = array("TRX_NUMBER"=>$num);
			$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksiHist',$dataPost2,'POST');
			if (count($redaksi) > 0) {
				//$redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI == '') ? "-" : $redaksi[0]->INV_EMATERAI_REDAKSI;
				$redaksi = ($redaksi[0]->INV_REDAKSI=='')?"-":$redaksi[0]->INV_REDAKSI;
			} else {
				$redaksi = "-";
			}
		}
		$administrasi = "0";
			/*print_r($headerKpl);
			die();exit();*/
		$e_name = ($headerKpl->INV_ENTITY_NAME == '') ? "-" : $headerKpl->INV_ENTITY_NAME;//'PT PELABUHAN INDONESIA II (PERSERO)';
			//print_r($e_name);die;
		$e_address = ($headerKpl->INV_ENTITY_ALAMAT == '') ? "-" : $headerKpl->INV_ENTITY_ALAMAT;//'Jl. Pasoso No. 1 Tanjung Priok, Jakarta Utara 14310' ;//
		$e_npwp = ($headerKpl->INV_ENTITY_NPWP == '') ? "-" : $headerKpl->INV_ENTITY_NPWP;//'01.061.005.3-093.000';//
		$e_faktur = ($headerKpl->INV_ENTITY_FAKTUR == '') ? "-" : $headerKpl->INV_ENTITY_FAKTUR;
		$e_logo = $headerKpl->INV_ENTITY_LOGO;
			// echo $e_logo;die();
		$pejabat = $headerKpl->INV_PEJABAT_NAME;
		$nip_pejabat = $headerKpl->INV_PEJABAT_NIPP;
		$ttd_pejabat = $headerKpl->INV_PEJABAT_TTD;

			//tambahan umar
		$uang_jaminan = ($headerKpl->UANG_JAMINAN == '') ? 0 : $headerKpl->UANG_JAMINAN;
		$status_bayar = ($headerKpl->STATUS_LUNAS == '') ? 0 : $headerKpl->STATUS_LUNAS;
		$status_lunas = $headerKpl->STATUS_LUNAS;
		$amount_tagihan = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
		$jml_dasar_pajak = ($headerKpl->AMOUNT_DASAR_PENGHASILAN == '') ? 0 : $headerKpl->AMOUNT_DASAR_PENGHASILAN;
		$amount_materai = $amountMaterai;

		$faktor_note = $headerKpl->INV_FAKTUR_NOTE;
		$jabatan_pejabat = $headerKpl->INV_PEJABAT_JABATAN;

		$no_ppkb = $headerKpl->INTERFACE_HEADER_ATTRIBUTE1;
		$no_ukk = $headerKpl->INTERFACE_HEADER_ATTRIBUTE6;

		$unit_wilayah = $headerKpl->INV_UNIT_NAME;
		$alamat_wilayah = $headerKpl->INV_UNIT_ALAMAT;
		
		/*add by Derry 27 NOv 2019 utk watermark pertamina dihilangkan jika belum lunas*/
		$isPertamina = substr($headerKpl->DOC_NUM,12,1);
		if ($isPertamina == "Y") {
			$special_cust[] = "Y"; 
		} 
		/*end by Derry*/

		/*pengecekan jika nama alamat dan npwp kosong */
		if ($custname == "" || $c_address == "" || $nomornpwp == "") {
			if ($c_number != "") {
				$dataCustomer = $this->senddataurl('MstCustomer/', $id2, 'POST');
				if (count($dataCustomer) > 0) {
					$custname = $dataCustomer[0]->INV_CUSTOMER_NAMA;
					$c_address = $dataCustomer[0]->INV_CUSTOMER_ALAMAT;
					$nomornpwp = $dataCustomer[0]->INV_CUSTOMER_NPWP;
				}
			}
		}

		$jenisNota = "";
		$notaJenis = $this->getdataurl('mstnota/getData/' . $headerKpl->HEADER_SUB_CONTEXT);

		if (count($notaJenis) > 0) {
			foreach ($notaJenis as $key => $jenis) {
				$jenisNota = $jenis->INV_NOTA_JENIS;
			}
		} else {

			$jenisNota = '';

		}
		$get_redaksi_x = $this->get_nota_redaksi($num, $jenisNota);


		$trxline = $this->getdataurl('invl/' . $id);

		$jum_amount = 0;
		$tax_amount = 0; //buat ppn potongan 10 persen
		$total_amount = 0;
		$tot_pandu_umum = 0;
		$tot_tambat_umum = 0;
		$tot_tunda_umum = 0;
		$tot_kepil_umum = 0;
		$tot_air_umum = 0;
		$linedoc = '';
		$materai = 6000;
		
  
		foreach ($trxline as $key => $value_) {
			/*exclude materai dari cetakan line : Derry Othman 24 Okt 2019*/
			if ($value_->DESCRIPTION == 'MATERAI') continue;
			// if ($value_->SERVICE_TYPE == 'PANDU UMUM') {
				// $tot_pandu_umum += $value_->AMOUNT;
			// }
			
			/* 20180910 3ono => selain PANDU UMUM, juga ada PANDU-PANDU lainnya */
			if (strpos($value_->SERVICE_TYPE, 'PANDU')) {
			   $tot_pandu_umum += $value_->AMOUNT;
			}

			if ($value_->SERVICE_TYPE == 'TAMBAT UMUM') {
				$tot_tambat_umum += $value_->AMOUNT;
			}

			// if ($value_->SERVICE_TYPE == 'TUNDA UMUM') {
				// $tot_tunda_umum += $value_->AMOUNT;
			// }
			/* 20180910 3ono => selain TUNDA UMUM, juga ada TUNDA-TUNDA lainnya */
			if (strpos($value_->SERVICE_TYPE, 'TUNDA')) {
			   $tot_tunda_umum += $value_->AMOUNT;
			}

			if ($value_->SERVICE_TYPE == 'KEPIL UMUM' || $value_->SERVICE_TYPE == 'KEPIL' || strpos($value_->SERVICE_TYPE, 'KEPIL')) {
				$tot_kepil_umum += $value_->AMOUNT;
			}


			if ($value_->SERVICE_TYPE == 'AIR UMUM') {
				$tot_air_umum += $value_->AMOUNT;
			}

			$linedoc = $value_->LINE_DOC;

		}
		
		// print_r($tot_pandu_umum); die();
		if ($linedoc == 'AIR_KAPAL_BANTEN') {
			$dasar_pajak = $tot_air_umum;
		} else {
			$dasar_pajak = ($tot_kepil_umum + $tot_tunda_umum + $tot_pandu_umum + $tot_tambat_umum);
		}
		
		// print_r($dasar_pajak); die();
		// $dipungut_pajak = 10/100 * $dasar_pajak;
		$PPN_DIPUNGUT_SENDIRI = $headerKpl->PPN_DIPUNGUT_SENDIRI;
		$dipungut_pajak = $headerKpl->PPN_DIPUNGUT_PEMUNGUT;
		$PPN_TIDAK_DIPUNGUT = $headerKpl->PPN_TIDAK_DIPUNGUT;
		$PPN_DIBEBASKAN = $headerKpl->PPN_DIBEBASKAN;
		$STATUS_KOREKSI = $headerKpl->STATUS_KOREKSI;

		$jumlah = $dasar_pajak + $dipungut_pajak + $materai;
		$piutang = $jumlah - $uang_jaminan;

		$jum_amount = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
		$tax_amount = ($headerKpl->PPN_10PERSEN == '') ? 0 : $headerKpl->PPN_10PERSEN; //buat ppn potongan 10 persen
		$total_amount = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
		$materai = ($headerKpl->AMOUNT_MATERAI == '') ? 0 : $headerKpl->AMOUNT_MATERAI;
		$piutang = ($headerKpl->PIUTANG == '') ? 0 : $headerKpl->PIUTANG;

		//barcode encrypt start
		$idsecret = $num;

		// $url_enc = $this->nama_fungsi->enkripsi('cetak','download',array('id'=>$num));
		$enc_trx_number = $this->mx_encryption->encrypt($headerKpl->TRX_NUMBER);

		$url_enc = 'einvoice/nota_kapal/cetak_nota_kapal/' . $enc_trx_number;
		// $url_enc = "einvoice/nota/cetak_nota/petikemas/".$idsecret."/";
		$params['data'] = ROOT . $url_enc;
		$params['level'] = 'H';
		$params['size'] = 10;
		$randomfilename = rand(1000, 9999);
		/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
		die();exit();*/
		$params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
		$this->ciqrcode->generate($params);
		$barcode_location = APP_ROOT . "qr_code/" . $randomfilename . ".png";


		//barcode encrypt end

		$ttd_location = APP_ROOT . "config/images/cr/ttd2.png";
	//terbilang
		if($piutang == 0){
			
					$terbilang = '-';
		}else{
			$amount_terbilang = $piutang;
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}
		
		
			/* ngeri lho harus gini ya */
		$flags = "N";
		$status_bayar2 = "K" . $status_bayar;
		if ($status_bayar2 == "KY") {
			$flags = "Y";
		}
		$header_nota = array(
			"faktor_note", $faktor_note,
			"STATUS_KOREKSI" => $STATUS_KOREKSI,
			"status_lunas" => $flags,
			"e_logo" => $e_logo,
			"e_name" => $e_name,
			"num" => $num,
			"e_address" => $e_address,
			"tgl_nota" => $tgl_nota,
			"e_npwp" => $e_npwp,
			"ex_num" => $ex_num,
			"e_faktur" => $faktor_note,
			"jenisNota" => $jenisNota
		);
		$judul_nota = array("jenisNota" => $jenisNota);

		$paramStatus['BILLER_REQUEST_ID'] = $no_req;
		$resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

		/*template settingan pdf*/
		/*template settingan pdf*/
		//$headerDt = format_nota($header_nota);
		$headerDt = format_nota($header_nota,$special_cust);
		// echo("===>".$headerDt);die();
		$pdf = $headerDt[0];
		$style = $headerDt[1];
		/*template header pdf*/
		define('noNotaFooter', $num);
		$header = header_nota($header_nota);
		$judul = judul_nota($judul_nota, $pdf);
			/*if($status_bayar=='Y') {

				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetPrintHeader(false);
				$pdf->SetTitle($title);

				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetMargins(12, 0);



				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(12, 0);




			    $pdf->SetAuthor('E invoice 2018');
	 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				// set default header data
				$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
				// set margins
				$pdf->SetMargins(12, 0);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->SetFont('courier', '', 8);
				$pdf->SetTopMargin(5);
				$pdf->AddPage();
				// echo "====>";echo $e_logo;
				//$pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
				// echo "====>";
				$style = array(
							'position' => '',
							'align' => 'C',
							'stretch' => false,
							'fitwidth' => true,
							'cellfitalign' => '',
							//'border' => true,
							'hpadding' => 'auto',
							'vpadding' => 'auto',
							'fgcolor' => array(0,0,0),
							'bgcolor' => false, //array(255,255,255),
							'text' => true,
							'font' => 'courier',
							'fontsize' => 4,
							'stretchtext' => 4
						);


			} else {
			$pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetMargins(12, 0);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		    $pdf->SetAuthor('E invoice 2018');
 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
			// set margins
			$pdf->SetMargins(12, 0);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->SetFont('courier', '', 8);
			$pdf->SetTopMargin(5);

			$pdf->AddPage();
			// echo "====>";echo $e_logo;
			//$pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
			// echo "====>";
			$style = array(
						'position' => '',
						'align' => 'C',
						'stretch' => false,
						'fitwidth' => true,
						'cellfitalign' => '',
						//'border' => true,
						'hpadding' => 'auto',
						'vpadding' => 'auto',
						'fgcolor' => array(0,0,0),
						'bgcolor' => false, //array(255,255,255),
						'text' => true,
						'font' => 'courier',
						'fontsize' => 4,
						'stretchtext' => 4
					);

			}*/




		/*$gambar = "";
		if (file_exists(APP_ROOT.'uploads/entity/'.$e_logo)) {
	    	$gambar = '<img width="350" height="200" src="'.APP_ROOT.'uploads/entity/'.$e_logo.'">';
		} else {
	    	$gambar = '<div width="350" height="40" src="'.APP_ROOT.'uploads/entity/"></div>';
		}


		$header .= '<table border="0px">
				<tr>
                    <td width="70" ROWSPAN="4">'.$gambar.'</td>
                    <td COLSPAN="9" align="left"><b>'.$e_name.'</b></td>
                    <td COLSPAN="2" align="left" width="50px">No. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$num.' </td>

                </tr>
                <tr>
                    <td COLSPAN="9" align="left">'.$e_address.' </td>
                    <td COLSPAN="2" align="left" width="50px">Tanggal</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$tgl_nota.'</td>
                </tr>
                <tr>
                    <td COLSPAN="12" align="left">NPWP: '.$e_npwp.'</td>
                    <td COLSPAN="2" align="left" width="150px">'.$e_faktur.'</td>
                </tr>';




        if($status_bayar=='Y') {
       	       $header .='

               	<tr>
                	<td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px">'.$faktor_note.'	</td>
                </tr>

                </table>';


       } else  {
       	       $header .='

               	<tr>
                	<td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px"> -	</td>
                </tr>

                </table>';

       }


        $judul ='<table border="0px">
        			<tr>
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA JASA KEPELABUHAN</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="2" align="center"><b>'.$jenisNota.'</b></td>
                	</tr>
        			</table>';*/


		$lampiran = '<table>
        			<tr>
	                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
                		<td COLSPAN="5" width="350px">
   					</tr>
   					<tr>
	                    <td COLSPAN="5" width="350px">
		                    <table>
			                	<tr>
				                    <td COLSPAN="2" align="left" width="50px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="280px">' . $custname . '</td>
			                	</tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">' . $c_number . '</td>
			                	</tr>
			                    <tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >' . $c_address . '</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">' . $nomornpwp . '</td>
		                    	</tr>	
			                	<tr>

			                	</tr>
		                    </table>
        				</td>
	                    <td COLSPAN="5">
		                    <table>
			                    <tr>
				                    <td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                   		<td COLSPAN="2" align="left"  width="280px">' . $kapal . '</td>
			                    </tr>
			                    <tr>
				                    <td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">' . $kunjungan . '</td>
			                    </tr>
					        	<tr>
					           		<td COLSPAN="2" align="left">Nomor PPKB</td>
					                <td COLSPAN="1" align="left">:</td>
					                <td COLSPAN="2" align="left">' . $no_ppkb . '</td>
					        	</tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">Nomor PKK</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">' . $no_ukk . '</td>
			                	</tr>
			                </table>
	                    </td>
                	</tr>
                	<tr>
                	</tr>


                	<tr>
	                    <td COLSPAN="2" align="left"></td>
						<td COLSPAN="1" align="left"></td>
	                    <td COLSPAN="2" align="left"></td>
	                    <td COLSPAN="2" align="left"></td>
	                    <td COLSPAN="1" align="left"></td>
                   		<td COLSPAN="2" align="left"></td>
                	</tr>	
        			</table>';
		$lampiran .= '<table><tr><td style="line-height: 24px;">&nbsp;</td></tr></table>';

		$tbl_tail .= '<table border="0px">
				  <tr>
				    <th width="20"><b>NO</b></th>
				    <th width="200"><b>JENIS JASA</b></th>
				    <th colspan="2" align="center"><b>JUMLAH</b></th>
				    <th colspan="4" align="center"><b>KETENTUAN</b></th>

				  </tr>';


		$data_sum = array();
		foreach ($trxline as $key) {

			$r[$key->SERVICE_TYPE][] = $key;
			$data_sum[$key->AMOUNT][] = 0;
		}

		foreach ($trxline as $list) {
			$number = $list->AMOUNT;
			
			$pos = strpos($list->SERVICE_TYPE," ");
			$substrLayanan = substr($list->SERVICE_TYPE, 0, $pos);
			
			if(($list->SERVICE_TYPE == 'KEPIL') or ($list->SERVICE_TYPE == 'ADMIN'))
			{
				$substrLayanan .= $list->SERVICE_TYPE;
			}
			
			$data_summ[$substrLayanan] += (float)$number;
		}
		
		 // print_r($data_summ); die();

		$no = 1;
		$tbl_tail_body = "";
		$dataValue = array(
			"TAMBAT" => 0,
			"PANDU" => 0,
			"TUNDA" => 0,
			"KEPIL" => 0,
			"ADMINISTRASI" => 0,
			"LAIN" => 0,
			"AIR" => 0,
		);
		foreach ($data_summ as $key => $value) {


			// echo $key .'='.$value;
			/*if(strpos($key, 'are')){
				// 
			}*/
			if (strpos($key, 'TAMBAT') !== false) {
				$dataValue['TAMBAT'] = $value;
			} else if (strpos($key, 'PANDU') !== false) {
				$dataValue['PANDU'] = $value;
			} else if (strpos($key, 'TUNDA') !== false) {
				$dataValue['TUNDA'] = $value;
			} else if (strpos($key, 'KEPIL') !== false) {
				$dataValue['KEPIL'] = $value;
			} else if (strpos($key, 'ADMIN') !== false) {
				$dataValue['ADMINISTRASI'] = $value;
			} else if (strpos($key, 'LAIN') !== false) {
				$dataValue['LAIN'] = $value;
			} else if (strpos($key, 'AIR') !== false) {
				$dataValue['AIR'] = $value;
			}
			/*$tbl_tail_body .= '
					 <tr>
				    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$no++.'</td>
				    <td width="200">'.$key.'</td>
				    <td>IDR</td>
				    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($value,0,',','.').'</td>
				    <td></td>
				    <td width="5"></td>

				  </tr>';*/

		}
		if ($linedoc == 'AIR_KAPAL_BANTEN') {

			$tbl_tail_body .= '
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Uang Air</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['AIR'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Administrasi</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['ADMINISTRASI'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>';
		} else {
			$tbl_tail_body .= '
					 <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Tambat</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['TAMBAT'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Pandu</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['PANDU'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Tunda</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['TUNDA'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Kepil</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['KEPIL'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Lain-lain</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['LAIN'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Administrasi</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['ADMINISTRASI'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>';
		}
		/*$tbl_tail .= '
					 <tr>
				    <td width="20"></td>
				    <td width="200"></td>
				    <td></td>
				    <td align="right"> </td>
				    <td></td>
				    <td width="30">1.</td>
				     <td ROWSPAN="4" colspan="3">'. $get_redaksi_x->INV_REDAKSI_NOTE .'.</td>
				  </tr>
				  <tr>
				    <td width="20"></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td ></td>

				  </tr>
				  <tr>
				    <td width="20"></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td width="30">2.</td>
				    <td ROWSPAN="4" colspan="3">-</td>
				  </tr>';*/



		/*$tbl_tail .= '
				  <tr>
				    <td colspan="2"><b>JUMLAH / DASAR PENGENAAN PAJAK</b></td>
				    <td>Rp.</td>
				    <td align="right"><b>'.number_format($dasar_pajak,2,',',',').'</b></td>
				    <td></td>


				  </tr>
				  <tr>
				    <td colspan="2">PPN 10%</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td width="20">a.</td>
				    <td>Dipungut Sendiri</td>
				    <td>Rp.</td>
				    <td align="right"> '.($value->PPN_DIPUNGUT_SENDIRI).'</td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td width="20">b.</td>
				    <td>PPn Dipungut Pemungut</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($dipungut_pajak,2,',',',').'</td>
				    <td></td>
				    <td width="30">3.</td>
				    <td ROWSPAN="4" colspan="3">-</td>
				  </tr>
				  <tr>
				    <td width="20">c.</td>
				    <td>PPn tidak dipungut</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($value->PPN_TIDAK_DIPUNGUT,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td width="20">d.</td>
				    <td>PPn dibebaskan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($value->PPN_DIBEBASKAN,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2">Materai</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($amount_materai,2,',',',').'</td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td colspan="2">Jumlah Tagihan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($amount_tagihan,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2">Uang Jaminan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($uang_jaminan,2,',',',').'</td>
				    <td></td>
				     <td width="30">4.</td>
				    <td ROWSPAN="4" colspan="3">-</td>

				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2"><b>Piutang</b></td>
				    <td>Rp.</td>
				    <td align="right"><b>'.number_format($amount_tagihan,2,',',',').'</b></td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				</table>';


		$jml_footer = '<table>
						<tr>
							<td COLSPAN="2" align="left" width="80px">Terbilang</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
	                    	<td COLSPAN="7" align="left">'.$terbilang.'</td></br>
						</tr>
					   </table>';

		$ttd_footer ='<table>
						<tr>
							<td COLSPAN="9" ROWSPAN="5" align="left" width="300px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td align="center" width="400px">Jakarta, '.$tgl_nota.'</td>
						</tr>
						<tr>
		                    <td align="center" width="400px">'.$jabatan_pejabat.'</td>
                		</tr>
                		<tr>
                			<td width="200px">&nbsp;</td>
		                    <td width="100px"><img style="padding-left:200" width="100" height="100" src="'.APP_ROOT.'uploads/ttd/'.$ttd_pejabat.'"></td>
                		</tr>
                		<tr>
		                    <td align="center" width="400px" style="text-decoration: underline">'.$pejabat.'</td>
                		</tr>
                		<tr>
                			<td align="center" width="400px" style="text-decoration: underline">NIPP. '.$nip_pejabat.'</td>
                		</tr>
                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>
					  </table>';*/
		$footer_nota = array(
			"headerContext" => $headerContext,
			"headerSubContext" => $header_context,
			"terbilang" => $terbilang,
			"barcode_location" => $barcode_location,
			"tgl_nota" => $tgl_nota,
			"jabatan_pejabat" => $jabatan_pejabat,
			"ttd_pejabat" => $ttd_pejabat,
			"pejabat" => $pejabat,
			"nip_pejabat" => $nip_pejabat,
			"current" => 'IDR',
			"get_redaksi_x" => $get_redaksi_x,
			"unit_loc" => $unit_loc,
			"data" => array(
				"status_lunas" => $status_lunas,
				"INV_REDAKSI_NOTE" => $get_redaksi_x->INV_REDAKSI_ATAS,
				"dasar_pajak" => $dasar_pajak,
				"PPN_DIPUNGUT_SENDIRI" => ($headerKpl->PPN_DIPUNGUT_SENDIRI == '') ? 0 : $headerKpl->PPN_DIPUNGUT_SENDIRI,
				"dipungut_pajak" => ($headerKpl->PPN_DIPUNGUT_PEMUNGUT == '') ? 0 : $headerKpl->PPN_DIPUNGUT_PEMUNGUT,
				"PPN_TIDAK_DIPUNGUT" => ($headerKpl->PPN_TIDAK_DIPUNGUT == '') ? 0 : $headerKpl->PPN_TIDAK_DIPUNGUT,
				"PPN_DIBEBASKAN" => ($headerKpl->PPN_DIBEBASKAN == '') ? 0 : $headerKpl->PPN_DIBEBASKAN,
				"amount_materai" => $amount_materai,
				"amount_tagihan" => $amount_tagihan,
				"uang_jaminan" => $uang_jaminan,
				"amount_tagihan" => $amount_tagihan,
				"dasarpengenaanpajak" => $jml_dasar_pajak,
				"piutang" => $piutang,
			)
		);
		$footer_nota['data']['tbl_tail'] = $tbl_tail_body;

		$footer = $tbl_tail . footer_nota($footer_nota, $id);
		// $tbl_tail = $tbl_tail.$footer;
		// echo $tbl_tail;die();
		/*$ematerai_nota = "";
		if($status_bayar=="Y"){

		}*/
		$ematerai_nota = array(
			"amountMaterai" => $amountMaterai,
			"redaksi" => $redaksi,
			"unit_wilayah" => $unit_wilayah,
			"alamat_wilayah" => $alamat_wilayah,
			"status_lunas" => $status_lunas //$status_bayar
		);
		$ematerai_nota = ematerai_nota($ematerai_nota);
		$output_name = $header_context . "_" . $id . ".pdf";
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->writeHtml($header, true, false, false, false, '');
		// $pdf->SetFont('courier', '', 8);
		$pdf->writeHtml($judul, true, false, false, false, '');
		$pdf->writeHtml($lampiran, true, false, false, false, '');
		// $pdf->writeHtml($tbl_tail, true, false, false, false, '');
		$pdf->writeHtml($footer, true, false, false, false, '');
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		// $pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
		$pdf->SetY(260);
		$pdf->writeHtml($ematerai_nota, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');

		/*$postdataEmaterai = array("TRX_NUMBER"=>$num);
		$datax = $this->senddataurl('Ematerai/insertematerai/', $postdataEmaterai,'POST');
		$postdatapengiriman = array("TRX_NUMBER"=>$num);
		$datakirim = $this->senddataurl('Pengiriman/insertpengiriman/', $postdatapengiriman, 'POST');*/
		$postlognota = array(
			"TRX_NUMBER" => $num,
			"ACTIVITY" => "CETAK",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');


	}

	public function convert_invoice()
	{
		//$postdata = ($_POST);

		$params = array(
			'NO_UKK' => $this->input->post('NO_UKK'),
			'ORG_ID' => $this->input->post('ORG_ID'),
			'NO_PPKB' => $this->input->post('NO_PPKB'),
		);



		$postdata = $params;
		$num = $postdata["NO_PPKB"];
	// print_r($postdata);die();
		$convert = $this->senddataurl('CreateInvoiceKapalKoreksi/index/', $postdata, 'POST');
	// echo json_encode($convert);

		$postlognota = array(
			"TRX_NUMBER" => $postdata['NO_UKK'],
			"ACTIVITY" => "INVOICE",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');




	// return ($convert);

	}

	public function cetak_nota_kapal_koreksi($trx)
	{
		$this->load->helper('nota_invoice_helper');
		// $id = $trx;
		$id = $this->mx_encryption->decrypt($trx);
		$paramStatus['BILLER_REQUEST_ID'] = $id;
		$resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

		/*$real_token = md5(sha1(md5(base64_encode($trx))));

		if($check_token != $real_token) {
			echo 'invalid token';
			die();
		}*/

		$postdata = array(
			'TRX_NUMBER' => $id,
			'MODULE' => 'KAPAL'
		);
		//$data_header = $this->senddataurl('invh/search/',$postdata,'POST');
		$headerKpl = $this->getdataurl('invh/pdf/KAPAL/' . $id);

		// echo print_r($headerKpl);die();
		$num = $headerKpl->TRX_NUMBER;
		$tgl_nota = $headerKpl->TRX_DATE;
			//print_r($tgl_nota);die;
		$org_id = $headerKpl->ORG_ID;
		$custname = $headerKpl->CUSTOMER_NAME;
		$c_number = $headerKpl->CUSTOMER_NUMBER;
		$c_address = $headerKpl->CUSTOMER_ADDRESS;
		$nomornpwp = $headerKpl->CUSTOMER_NPWP;
		$kapal = $headerKpl->VESSEL_NAME;
		$kunjungan = $headerKpl->INTERFACE_HEADER_ATTRIBUTE4;
		$to_kun = $headerKpl->PER_KUNJUNGAN_TO;
		$no_req = $headerKpl->BILLER_REQUEST_ID;
		$dagang = $headerKpl->JENIS_PERDAGANGAN;
		$current = $headerKpl->CURRENCY_CODE;
		$ex_num = $headerKpl->TRX_NUMBER_PREV;
		$unit_loc = $headerKpl->INV_UNIT_LOCATION;
			// echo "||";print_r($ex_num);echo "||";die();
		$header_context = $headerKpl->HEADER_SUB_CONTEXT;
		$headerContext = $headerKpl->HEADER_CONTEXT;
		$entityId = $headerKpl->INV_ENTITY_ID;
		$amountMaterai = ($headerKpl->AMOUNT_MATERAI == '') ? "0" : $headerKpl->AMOUNT_MATERAI;
			// $amountMaterai = 6000;
		$redaksi = "-";
		if ($entityId != "") {
				/*$getmaterai = array("TOTAL_TAGIHAN"=>$headerKpl->AMOUNT,"ORG_ID"=>$this->session->userdata('unit_id'),"BRANCH_CODE"=>$this->session->userdata('unit_org'),"HEADER_CONTEXT"=>$headerContext);
				$redaksis = $this->senddataurl('GetEmaterai',$getmaterai,'POST');
				$amountMaterai = $redaksis->NILAI_MATERAI;
				$redaksi = $redaksis->INV_EMATERAI_REDAKSI;*/
			//$dataPost2 = array("INV_ENTITY_ID" => $entityId);
			//$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi', $dataPost2, 'POST');
			$dataPost2 = array("TRX_NUMBER"=>$num);
			$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksiHist',$dataPost2,'POST');			
			if (count($redaksi) > 0) {
				//$redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI == '') ? "-" : $redaksi[0]->INV_EMATERAI_REDAKSI;
				$redaksi = ($redaksi[0]->INV_REDAKSI=='')?"-":$redaksi[0]->INV_REDAKSI;
			} else {
				$redaksi = "-";
			}
		}
		$administrasi = "0";
			/*print_r($headerKpl);
			die();exit();*/
		$e_name = ($headerKpl->INV_ENTITY_NAME == '') ? "-" : $headerKpl->INV_ENTITY_NAME;//'PT PELABUHAN INDONESIA II (PERSERO)';
			//print_r($e_name);die;
		$e_address = ($headerKpl->INV_ENTITY_ALAMAT == '') ? "-" : $headerKpl->INV_ENTITY_ALAMAT;//'Jl. Pasoso No. 1 Tanjung Priok, Jakarta Utara 14310' ;//
		$e_npwp = ($headerKpl->INV_ENTITY_NPWP == '') ? "-" : $headerKpl->INV_ENTITY_NPWP;//'01.061.005.3-093.000';//
		$e_faktur = ($headerKpl->INV_ENTITY_FAKTUR == '') ? "-" : $headerKpl->INV_ENTITY_FAKTUR;
		$e_logo = $headerKpl->INV_ENTITY_LOGO;
			// echo $e_logo;die();
		$pejabat = $headerKpl->INV_PEJABAT_NAME;
		$nip_pejabat = $headerKpl->INV_PEJABAT_NIPP;
		$ttd_pejabat = $headerKpl->INV_PEJABAT_TTD;

			//tambahan umar
		$uang_jaminan = ($headerKpl->UANG_JAMINAN == '') ? 0 : $headerKpl->UANG_JAMINAN;
		$status_bayar = ($headerKpl->STATUS_LUNAS == '') ? 0 : $headerKpl->STATUS_LUNAS;
		$status_lunas = $headerKpl->STATUS_LUNAS;
		$amount_tagihan = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
		$jml_dasar_pajak = ($headerKpl->AMOUNT_DASAR_PENGHASILAN == '') ? 0 : $headerKpl->AMOUNT_DASAR_PENGHASILAN;
		$amount_materai = $amountMaterai;

		$faktor_note = $headerKpl->INV_FAKTUR_NOTE;
		$jabatan_pejabat = $headerKpl->INV_PEJABAT_JABATAN;

		$no_ppkb = $headerKpl->INTERFACE_HEADER_ATTRIBUTE1;
		$no_ukk = $headerKpl->INTERFACE_HEADER_ATTRIBUTE6;

		$unit_wilayah = $headerKpl->INV_UNIT_NAME;
		$alamat_wilayah = $headerKpl->INV_UNIT_ALAMAT;

		/*add by Derry 27 NOv 2019 utk watermark pertamina dihilangkan jika belum lunas*/
		$isPertamina = substr($headerKpl->DOC_NUM,12,1);
		if ($isPertamina == "Y") {
			$special_cust[] = "Y"; 
		} 
		/*end by Derry*/
		

		/*pengecekan jika nama alamat dan npwp kosong */
		if ($custname == "" || $c_address == "" || $nomornpwp == "") {
			if ($c_number != "") {
				$dataCustomer = $this->senddataurl('MstCustomer/', $id2, 'POST');
				if (count($dataCustomer) > 0) {
					$custname = $dataCustomer[0]->INV_CUSTOMER_NAMA;
					$c_address = $dataCustomer[0]->INV_CUSTOMER_ALAMAT;
					$nomornpwp = $dataCustomer[0]->INV_CUSTOMER_NPWP;
				}
			}
		}

		$jenisNota = "";
		$notaJenis = $this->getdataurl('mstnota/getData/' . $headerKpl->HEADER_SUB_CONTEXT);

		if (count($notaJenis) > 0) {
			foreach ($notaJenis as $key => $jenis) {
				$jenisNota = $jenis->INV_NOTA_JENIS;
			}
		} else {

			$jenisNota = '';

		}
		$get_redaksi_x = $this->get_nota_redaksi($num, $jenisNota);


		$trxline = $this->getdataurl('invl/' . $id);

		$jum_amount = 0;
		$tax_amount = 0; //buat ppn potongan 10 persen
		$total_amount = 0;
		$tot_pandu_umum = 0;
		$tot_tambat_umum = 0;
		$tot_tunda_umum = 0;
		$tot_kepil_umum = 0;
		$materai = 6000;
		foreach ($trxline as $key => $value_) {
			// if ($value_->SERVICE_TYPE == 'PANDU UMUM') {
				// $tot_pandu_umum += $value_->AMOUNT;
			// }
			
			/* 20180910 3ono => selain PANDU UMUM, juga ada PANDU-PANDU lainnya */
			if (strpos($value_->SERVICE_TYPE, 'PANDU')) {
			   $tot_pandu_umum += $value_->AMOUNT;
			}

			if ($value_->SERVICE_TYPE == 'TAMBAT UMUM') {
				$tot_tambat_umum += $value_->AMOUNT;
			}

			// if ($value_->SERVICE_TYPE == 'TUNDA UMUM') {
				// $tot_tunda_umum += $value_->AMOUNT;
			// }
			
			/* 20180910 3ono => selain TUNDA UMUM, juga ada TUNDA-TUNDA lainnya */
			if (strpos($value_->SERVICE_TYPE, 'TUNDA')) {
			   $tot_tunda_umum += $value_->AMOUNT;
			}

			if ($value_->SERVICE_TYPE == 'KEPIL UMUM' || $value_->SERVICE_TYPE == 'KEPIL' || strpos($value_->SERVICE_TYPE, 'KEPIL')) {
				$tot_kepil_umum += $value_->AMOUNT;
			}



		}

		$dasar_pajak = ($tot_kepil_umum + $tot_tunda_umum + $tot_pandu_umum + $tot_tambat_umum);
		// $dipungut_pajak = 10/100 * $dasar_pajak;
		$PPN_DIPUNGUT_SENDIRI = $headerKpl->PPN_DIPUNGUT_SENDIRI;
		$dipungut_pajak = $headerKpl->PPN_DIPUNGUT_PEMUNGUT;
		$PPN_TIDAK_DIPUNGUT = $headerKpl->PPN_TIDAK_DIPUNGUT;
		$PPN_DIBEBASKAN = $headerKpl->PPN_DIBEBASKAN;

		$jumlah = $dasar_pajak + $dipungut_pajak + $materai;
		$piutang = $jumlah - $uang_jaminan;

		$jum_amount = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
		$tax_amount = ($headerKpl->PPN_10PERSEN == '') ? 0 : $headerKpl->PPN_10PERSEN; //buat ppn potongan 10 persen
		$total_amount = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
		$materai = ($headerKpl->AMOUNT_MATERAI == '') ? 0 : $headerKpl->AMOUNT_MATERAI;
		$piutang = ($headerKpl->PIUTANG == '') ? 0 : $headerKpl->PIUTANG;

		//barcode encrypt start
		$idsecret = $num;

		// $url_enc = $this->nama_fungsi->enkripsi('cetak','download',array('id'=>$num));
		$enc_trx_number = $this->mx_encryption->encrypt($headerKpl->TRX_NUMBER);

		$url_enc = 'einvoice/nota_kapal/cetak_nota_kapal/' . $enc_trx_number;
		// $url_enc = "einvoice/nota/cetak_nota/petikemas/".$idsecret."/";
		$params['data'] = ROOT . $url_enc;
		$params['level'] = 'H';
		$params['size'] = 10;
		$randomfilename = rand(1000, 9999);
		/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
		die();exit();*/
		$params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
		$this->ciqrcode->generate($params);
		$barcode_location = APP_ROOT . "qr_code/" . $randomfilename . ".png";


		//barcode encrypt end

		$ttd_location = APP_ROOT . "config/images/cr/ttd2.png";

		//terbilang
		if($piutang == 0){
			
					$terbilang = '-';
		}else{
			$amount_terbilang = $piutang;
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}
			/* ngeri lho harus gini ya */
		$flags = "N";
		$status_bayar2 = "K" . $status_bayar;
		if ($status_bayar2 == "KY") {
			$flags = "Y";
		}
		$header_nota = array(
			"faktor_note", $faktor_note,
			"status_lunas" => $flags,
			"e_logo" => $e_logo,
			"e_name" => $e_name,
			"num" => $num,
			"e_address" => $e_address,
			"tgl_nota" => $tgl_nota,
			"e_npwp" => $e_npwp,
			"ex_num" => $ex_num,
			"e_faktur" => $faktor_note,
			"jenisNota" => $jenisNota
		);
		$judul_nota = array("jenisNota" => $jenisNota);

		$paramStatus['BILLER_REQUEST_ID'] = $no_req;
		$resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

		/*template settingan pdf*/
		//$headerDt = format_nota($header_nota);
		$headerDt = format_nota($header_nota,$special_cust);
		// echo("===>".$headerDt);die();
		$pdf = $headerDt[0];
		$style = $headerDt[1];
		/*template header pdf*/
		define('noNotaFooter', $num);
		$header = header_nota($header_nota);
		$judul = judul_nota($judul_nota, $pdf);
			/*if($status_bayar=='Y') {

				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetPrintHeader(false);
				$pdf->SetTitle($title);

				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetMargins(12, 0);



				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(12, 0);




			    $pdf->SetAuthor('E invoice 2018');
	 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				// set default header data
				$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
				// set margins
				$pdf->SetMargins(12, 0);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->SetFont('courier', '', 8);
				$pdf->SetTopMargin(5);
				$pdf->AddPage();
				// echo "====>";echo $e_logo;
				//$pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
				// echo "====>";
				$style = array(
							'position' => '',
							'align' => 'C',
							'stretch' => false,
							'fitwidth' => true,
							'cellfitalign' => '',
							//'border' => true,
							'hpadding' => 'auto',
							'vpadding' => 'auto',
							'fgcolor' => array(0,0,0),
							'bgcolor' => false, //array(255,255,255),
							'text' => true,
							'font' => 'courier',
							'fontsize' => 4,
							'stretchtext' => 4
						);


			} else {
			$pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetMargins(12, 0);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		    $pdf->SetAuthor('E invoice 2018');
 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
			// set margins
			$pdf->SetMargins(12, 0);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->SetFont('courier', '', 8);
			$pdf->SetTopMargin(5);

			$pdf->AddPage();
			// echo "====>";echo $e_logo;
			//$pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
			// echo "====>";
			$style = array(
						'position' => '',
						'align' => 'C',
						'stretch' => false,
						'fitwidth' => true,
						'cellfitalign' => '',
						//'border' => true,
						'hpadding' => 'auto',
						'vpadding' => 'auto',
						'fgcolor' => array(0,0,0),
						'bgcolor' => false, //array(255,255,255),
						'text' => true,
						'font' => 'courier',
						'fontsize' => 4,
						'stretchtext' => 4
					);

			}*/




		/*$gambar = "";
		if (file_exists(APP_ROOT.'uploads/entity/'.$e_logo)) {
	    	$gambar = '<img width="350" height="200" src="'.APP_ROOT.'uploads/entity/'.$e_logo.'">';
		} else {
	    	$gambar = '<div width="350" height="40" src="'.APP_ROOT.'uploads/entity/"></div>';
		}


		$header .= '<table border="0px">
				<tr>
                    <td width="70" ROWSPAN="4">'.$gambar.'</td>
                    <td COLSPAN="9" align="left"><b>'.$e_name.'</b></td>
                    <td COLSPAN="2" align="left" width="50px">No. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$num.' </td>

                </tr>
                <tr>
                    <td COLSPAN="9" align="left">'.$e_address.' </td>
                    <td COLSPAN="2" align="left" width="50px">Tanggal</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$tgl_nota.'</td>
                </tr>
                <tr>
                    <td COLSPAN="12" align="left">NPWP: '.$e_npwp.'</td>
                    <td COLSPAN="2" align="left" width="150px">'.$e_faktur.'</td>
                </tr>';




        if($status_bayar=='Y') {
       	       $header .='

               	<tr>
                	<td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px">'.$faktor_note.'	</td>
                </tr>

                </table>';


       } else  {
       	       $header .='

               	<tr>
                	<td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px"> -	</td>
                </tr>

                </table>';

       }


        $judul ='<table border="0px">
        			<tr>
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA JASA KEPELABUHAN</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="2" align="center"><b>'.$jenisNota.'</b></td>
                	</tr>
        			</table>';*/


		$lampiran = '<table>
        			<tr>
	                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
                		<td COLSPAN="5" width="350px">
   					</tr>
   					<tr>
	                    <td COLSPAN="5" width="350px">
		                    <table>
			                	<tr>
				                    <td COLSPAN="2" align="left" width="50px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="280px">' . $custname . '</td>
			                	</tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">' . $c_number . '</td>
			                	</tr>
			                    <tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >' . $c_address . '</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">' . $nomornpwp . '</td>
		                    	</tr>	
			                	<tr>

			                	</tr>
		                    </table>
        				</td>
	                    <td COLSPAN="5">
		                    <table>
			                    <tr>
				                    <td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                   		<td COLSPAN="2" align="left"  width="280px">' . $kapal . '</td>
			                    </tr>
			                    <tr>
				                    <td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">' . $kunjungan . '</td>
			                    </tr>
					        	<tr>
					           		<td COLSPAN="2" align="left">Nomor PPKB</td>
					                <td COLSPAN="1" align="left">:</td>
					                <td COLSPAN="2" align="left">' . $no_ppkb . '</td>
					        	</tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">Nomor PKK</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">' . $no_ukk . '</td>
			                	</tr>
			                </table>
	                    </td>
                	</tr>
                	<tr>
                	</tr>


                	<tr>
	                    <td COLSPAN="2" align="left"></td>
						<td COLSPAN="1" align="left"></td>
	                    <td COLSPAN="2" align="left"></td>
	                    <td COLSPAN="2" align="left"></td>
	                    <td COLSPAN="1" align="left"></td>
                   		<td COLSPAN="2" align="left"></td>
                	</tr>	
        			</table>';
		$lampiran .= '<table><tr><td style="line-height: 24px;">&nbsp;</td></tr></table>';

		$tbl_tail .= '<table border="0px">
				  <tr>
				    <th width="20"><b>NO</b></th>
				    <th width="200"><b>JENIS JASA</b></th>
				    <th colspan="2" align="center"><b>JUMLAH</b></th>
				    <th colspan="4" align="center"><b>KETENTUAN</b></th>

				  </tr>';


		$data_sum = array();
		foreach ($trxline as $key) {

			$r[$key->SERVICE_TYPE][] = $key;
			$data_sum[$key->AMOUNT][] = 0;


		}
		
		foreach ($trxline as $list) {
			$number = $list->AMOUNT;
			
			$pos = strpos($list->SERVICE_TYPE, " ");
			$substrLayanan = substr($list->SERVICE_TYPE, 0, $pos);
			
			$data_summ[$substrLayanan] += (float)$number;
		}

		$no = 1;
		$tbl_tail_body = "";
		$dataValue = array(
			"TAMBAT" => 0,
			"PANDU" => 0,
			"TUNDA" => 0,
			"KEPIL" => 0,
			"ADMINISTRASI" => 0,
			"LAIN" => 0,
		);
		foreach ($data_summ as $key => $value) {


			// echo $key .'='.$value;
			/*if(strpos($key, 'are')){
				// 
			}*/
			if (strpos($key, 'TAMBAT') !== false) {
				$dataValue['TAMBAT'] = $value;
			} else if (strpos($key, 'PANDU') !== false) {
				$dataValue['PANDU'] = $value;
			} else if (strpos($key, 'TUNDA') !== false) {
				$dataValue['TUNDA'] = $value;
			} else if (strpos($key, 'KEPIL') !== false) {
				$dataValue['KEPIL'] = $value;
			} else if (strpos($key, 'ADMINISTRASI') !== false) {
				$dataValue['ADMINISTRASI'] = $value;
			} else if (strpos($key, 'LAIN') !== false) {
				$dataValue['LAIN'] = $value;
			}
			/*$tbl_tail_body .= '
					 <tr>
				    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$no++.'</td>
				    <td width="200">'.$key.'</td>
				    <td>IDR</td>
				    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($value,0,',','.').'</td>
				    <td></td>
				    <td width="5"></td>

				  </tr>';*/

		}

		$tbl_tail_body .= '
					 <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Tambat</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['TAMBAT'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Pandu</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['PANDU'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Tunda</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['TUNDA'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Kepil</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['KEPIL'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Lain-lain</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['LAIN'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Administrasi</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['ADMINISTRASI'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>';

		/*$tbl_tail .= '
					 <tr>
				    <td width="20"></td>
				    <td width="200"></td>
				    <td></td>
				    <td align="right"> </td>
				    <td></td>
				    <td width="30">1.</td>
				     <td ROWSPAN="4" colspan="3">'. $get_redaksi_x->INV_REDAKSI_NOTE .'.</td>
				  </tr>
				  <tr>
				    <td width="20"></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td ></td>

				  </tr>
				  <tr>
				    <td width="20"></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td width="30">2.</td>
				    <td ROWSPAN="4" colspan="3">-</td>
				  </tr>';*/



		/*$tbl_tail .= '
				  <tr>
				    <td colspan="2"><b>JUMLAH / DASAR PENGENAAN PAJAK</b></td>
				    <td>Rp.</td>
				    <td align="right"><b>'.number_format($dasar_pajak,2,',',',').'</b></td>
				    <td></td>


				  </tr>
				  <tr>
				    <td colspan="2">PPN 10%</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td width="20">a.</td>
				    <td>Dipungut Sendiri</td>
				    <td>Rp.</td>
				    <td align="right"> '.($value->PPN_DIPUNGUT_SENDIRI).'</td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td width="20">b.</td>
				    <td>PPn Dipungut Pemungut</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($dipungut_pajak,2,',',',').'</td>
				    <td></td>
				    <td width="30">3.</td>
				    <td ROWSPAN="4" colspan="3">-</td>
				  </tr>
				  <tr>
				    <td width="20">c.</td>
				    <td>PPn tidak dipungut</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($value->PPN_TIDAK_DIPUNGUT,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td width="20">d.</td>
				    <td>PPn dibebaskan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($value->PPN_DIBEBASKAN,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2">Materai</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($amount_materai,2,',',',').'</td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td colspan="2">Jumlah Tagihan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($amount_tagihan,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2">Uang Jaminan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($uang_jaminan,2,',',',').'</td>
				    <td></td>
				     <td width="30">4.</td>
				    <td ROWSPAN="4" colspan="3">-</td>

				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2"><b>Piutang</b></td>
				    <td>Rp.</td>
				    <td align="right"><b>'.number_format($amount_tagihan,2,',',',').'</b></td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				</table>';


		$jml_footer = '<table>
						<tr>
							<td COLSPAN="2" align="left" width="80px">Terbilang</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
	                    	<td COLSPAN="7" align="left">'.$terbilang.'</td></br>
						</tr>
					   </table>';

		$ttd_footer ='<table>
						<tr>
							<td COLSPAN="9" ROWSPAN="5" align="left" width="300px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td align="center" width="400px">Jakarta, '.$tgl_nota.'</td>
						</tr>
						<tr>
		                    <td align="center" width="400px">'.$jabatan_pejabat.'</td>
                		</tr>
                		<tr>
                			<td width="200px">&nbsp;</td>
		                    <td width="100px"><img style="padding-left:200" width="100" height="100" src="'.APP_ROOT.'uploads/ttd/'.$ttd_pejabat.'"></td>
                		</tr>
                		<tr>
		                    <td align="center" width="400px" style="text-decoration: underline">'.$pejabat.'</td>
                		</tr>
                		<tr>
                			<td align="center" width="400px" style="text-decoration: underline">NIPP. '.$nip_pejabat.'</td>
                		</tr>
                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>
					  </table>';*/
		$footer_nota = array(
			"headerContext" => $headerContext,
			"headerSubContext" => $header_context,
			"terbilang" => $terbilang,
			"barcode_location" => $barcode_location,
			"tgl_nota" => $tgl_nota,
			"jabatan_pejabat" => $jabatan_pejabat,
			"ttd_pejabat" => $ttd_pejabat,
			"pejabat" => $pejabat,
			"nip_pejabat" => $nip_pejabat,
			"current" => 'IDR',
			"get_redaksi_x" => $get_redaksi_x,
			"unit_loc" => $unit_loc,
			"data" => array(
				"INV_REDAKSI_NOTE" => $get_redaksi_x->INV_REDAKSI_ATAS,
				"dasar_pajak" => $dasar_pajak,
				"PPN_DIPUNGUT_SENDIRI" => ($headerKpl->PPN_DIPUNGUT_SENDIRI == '') ? 0 : $headerKpl->PPN_DIPUNGUT_SENDIRI,
				"dipungut_pajak" => ($headerKpl->PPN_DIPUNGUT_PEMUNGUT == '') ? 0 : $headerKpl->PPN_DIPUNGUT_PEMUNGUT,
				"PPN_TIDAK_DIPUNGUT" => ($headerKpl->PPN_TIDAK_DIPUNGUT == '') ? 0 : $headerKpl->PPN_TIDAK_DIPUNGUT,
				"PPN_DIBEBASKAN" => ($headerKpl->PPN_DIBEBASKAN == '') ? 0 : $headerKpl->PPN_DIBEBASKAN,
				"amount_materai" => $amount_materai,
				"amount_tagihan" => $amount_tagihan,
				"uang_jaminan" => $uang_jaminan,
				"amount_tagihan" => $amount_tagihan,
				"dasarpengenaanpajak" => $jml_dasar_pajak,
				"piutang" => $piutang,
			)
		);
		$footer_nota['data']['tbl_tail'] = $tbl_tail_body;

		$footer = $tbl_tail . footer_nota($footer_nota);
		// $tbl_tail = $tbl_tail.$footer;
		// echo $tbl_tail;die();
		/*$ematerai_nota = "";
		if($status_bayar=="Y"){

		}*/
		$ematerai_nota = array(
			"amountMaterai" => $amountMaterai,
			"redaksi" => $redaksi,
			"unit_wilayah" => $unit_wilayah,
			"alamat_wilayah" => $alamat_wilayah,
			"status_lunas" => $status_bayar
		);
		$ematerai_nota = ematerai_nota($ematerai_nota);
		$output_name = $header_context . "_" . $id . ".pdf";
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->writeHtml($header, true, false, false, false, '');
		// $pdf->SetFont('courier', '', 8);
		$pdf->writeHtml($judul, true, false, false, false, '');
		$pdf->writeHtml($lampiran, true, false, false, false, '');
		// $pdf->writeHtml($tbl_tail, true, false, false, false, '');
		$pdf->writeHtml($footer, true, false, false, false, '');
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		// $pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
		$pdf->SetY(260);
		$pdf->writeHtml($ematerai_nota, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');

		/*$postdataEmaterai = array("TRX_NUMBER"=>$num);
		$datax = $this->senddataurl('Ematerai/insertematerai/', $postdataEmaterai,'POST');
		$postdatapengiriman = array("TRX_NUMBER"=>$num);
		$datakirim = $this->senddataurl('Pengiriman/insertpengiriman/', $postdatapengiriman, 'POST');*/
		$postlognota = array(
			"TRX_NUMBER" => $num,
			"ACTIVITY" => "CETAK",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');


	}

	public function cetak_nota_kapal_all($trx = "")
	{
		/*echo "tester";die();*/
		$this->load->helper('nota_invoice_helper');
		$postdata = ($_GET);
		$postdata['MODULE'] = "KAPAL";

		$kapalall = $this->senddataurl('invh/searchall/', $postdata, 'POST');
		/*$kapal = array();
		for ($i=0; $i < 10 ; $i++) { 
			$kapal[$i] = $kapalall[$i];
		}*/

		$pdf = new MyCustomPDFWithWatermark('P', 'mm', 'A4', true, 'UTF-8', false);
            // $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle("NOTA ALL");
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(12, 0);
            // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
            // $pdf->SetAutoPageBreak(TRUE);
		$pdf->setLanguageArray(null);
		$pdf->SetHeaderMargin(false);
		$pdf->SetTopMargin(5);
		$pdf->SetFooterMargin(1);
            // $pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 15);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // $pdf->SetFont('courier', '', 8);
		$pdf->SetFont('gotham', '', 8);
		$pdf->AddPage();
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
                    //'border' => true,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0, 0, 0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'courier',
			'fontsize' => 4,
			'stretchtext' => 4
		);

		foreach ($kapalall as $key => $value) {
			$id = $value->TRX_NUMBER;
			$paramStatus['BILLER_REQUEST_ID'] = $id;
			$resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

		/*$real_token = md5(sha1(md5(base64_encode($trx))));

		if($check_token != $real_token) {
			echo 'invalid token';
			die();
		}*/

			$postdata = array(
				'TRX_NUMBER' => $id,
				'MODULE' => 'KAPAL'
			);
		//$data_header = $this->senddataurl('invh/search/',$postdata,'POST');
			$headerKpl = $this->getdataurl('invh/pdf/KAPAL/' . $id);

		// echo print_r($headerKpl);die();
			$num = $headerKpl->TRX_NUMBER;
			$tgl_nota = $headerKpl->TRX_DATE;
			//print_r($tgl_nota);die;
			$org_id = $headerKpl->ORG_ID;
			$custname = $headerKpl->CUSTOMER_NAME;
			$c_number = $headerKpl->CUSTOMER_NUMBER;
			$c_address = $headerKpl->CUSTOMER_ADDRESS;
			$nomornpwp = $headerKpl->CUSTOMER_NPWP;
			$kapal = $headerKpl->VESSEL_NAME;
			$kunjungan = $headerKpl->INTERFACE_HEADER_ATTRIBUTE4;
			$to_kun = $headerKpl->PER_KUNJUNGAN_TO;
			$no_req = $headerKpl->BILLER_REQUEST_ID;
			$dagang = $headerKpl->JENIS_PERDAGANGAN;
			$current = $headerKpl->CURRENCY_CODE;
			$ex_num = $headerKpl->TRX_NUMBER_PREV;
			$unit_loc = $headerKpl->INV_UNIT_LOCATION;
			// echo "||";print_r($ex_num);echo "||";die();
			$header_context = $headerKpl->HEADER_SUB_CONTEXT;
			$headerContext = $headerKpl->HEADER_CONTEXT;
			$entityId = $headerKpl->INV_ENTITY_ID;
			$amountMaterai = ($headerKpl->AMOUNT_MATERAI == '') ? "0" : $headerKpl->AMOUNT_MATERAI;
			// $amountMaterai = 6000;
			$redaksi = "-";
			if ($entityId != "") {
				/*$getmaterai = array("TOTAL_TAGIHAN"=>$headerKpl->AMOUNT,"ORG_ID"=>$this->session->userdata('unit_id'),"BRANCH_CODE"=>$this->session->userdata('unit_org'),"HEADER_CONTEXT"=>$headerContext);
				$redaksis = $this->senddataurl('GetEmaterai',$getmaterai,'POST');
				$amountMaterai = $redaksis->NILAI_MATERAI;
				$redaksi = $redaksis->INV_EMATERAI_REDAKSI;*/
				$dataPost2 = array("INV_ENTITY_ID" => $entityId);
				$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi', $dataPost2, 'POST');
				if (count($redaksi) > 0) {
					$redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI == '') ? "-" : $redaksi[0]->INV_EMATERAI_REDAKSI;
				} else {
					$redaksi = "-";
				}
			}
			$administrasi = "0";
			/*print_r($headerKpl);
			die();exit();*/
			$e_name = ($headerKpl->INV_ENTITY_NAME == '') ? "-" : $headerKpl->INV_ENTITY_NAME;//'PT PELABUHAN INDONESIA II (PERSERO)';
			//print_r($e_name);die;
			$e_address = ($headerKpl->INV_ENTITY_ALAMAT == '') ? "-" : $headerKpl->INV_ENTITY_ALAMAT;//'Jl. Pasoso No. 1 Tanjung Priok, Jakarta Utara 14310' ;//
			$e_npwp = ($headerKpl->INV_ENTITY_NPWP == '') ? "-" : $headerKpl->INV_ENTITY_NPWP;//'01.061.005.3-093.000';//
			$e_faktur = ($headerKpl->INV_ENTITY_FAKTUR == '') ? "-" : $headerKpl->INV_ENTITY_FAKTUR;
			$e_logo = $headerKpl->INV_ENTITY_LOGO;
			// echo $e_logo;die();
			$pejabat = $headerKpl->INV_PEJABAT_NAME;
			$nip_pejabat = $headerKpl->INV_PEJABAT_NIPP;
			$ttd_pejabat = $headerKpl->INV_PEJABAT_TTD;

			//tambahan umar
			$uang_jaminan = ($headerKpl->UANG_JAMINAN == '') ? 0 : $headerKpl->UANG_JAMINAN;
			$status_bayar = ($headerKpl->STATUS_LUNAS == '') ? 0 : $headerKpl->STATUS_LUNAS;
			$status_lunas = $headerKpl->STATUS_LUNAS;
			$amount_tagihan = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
			$jml_dasar_pajak = ($headerKpl->AMOUNT_DASAR_PENGHASILAN == '') ? 0 : $headerKpl->AMOUNT_DASAR_PENGHASILAN;
			$amount_materai = $amountMaterai;

			$faktor_note = $headerKpl->INV_FAKTUR_NOTE;
			$jabatan_pejabat = $headerKpl->INV_PEJABAT_JABATAN;

			$no_ppkb = $headerKpl->INTERFACE_HEADER_ATTRIBUTE1;
			$no_ukk = $headerKpl->INTERFACE_HEADER_ATTRIBUTE6;

			$unit_wilayah = $headerKpl->INV_UNIT_NAME;
			$alamat_wilayah = $headerKpl->INV_UNIT_ALAMAT;

		/*pengecekan jika nama alamat dan npwp kosong */
			if ($custname == "" || $c_address == "" || $nomornpwp == "") {
				if ($c_number != "") {
					$dataCustomer = $this->senddataurl('MstCustomer/', $id2, 'POST');
					if (count($dataCustomer) > 0) {
						$custname = $dataCustomer[0]->INV_CUSTOMER_NAMA;
						$c_address = $dataCustomer[0]->INV_CUSTOMER_ALAMAT;
						$nomornpwp = $dataCustomer[0]->INV_CUSTOMER_NPWP;
					}
				}
			}

			$jenisNota = "";
			$notaJenis = $this->getdataurl('mstnota/getData/' . $headerKpl->HEADER_SUB_CONTEXT);

			if (count($notaJenis) > 0) {
				foreach ($notaJenis as $key => $jenis) {
					$jenisNota = $jenis->INV_NOTA_JENIS;
				}
			} else {

				$jenisNota = '';

			}
			$get_redaksi_x = $this->get_nota_redaksi($num, $jenisNota);


			$trxline = $this->getdataurl('invl/' . $id);

			$jum_amount = 0;
			$tax_amount = 0; //buat ppn potongan 10 persen
			$total_amount = 0;
			$tot_pandu_umum = 0;
			$tot_tambat_umum = 0;
			$tot_tunda_umum = 0;
			$tot_kepil_umum = 0;
			$materai = 6000;
			foreach ($trxline as $key => $value_) {
				// if ($value_->SERVICE_TYPE == 'PANDU UMUM') {
					// $tot_pandu_umum += $value_->AMOUNT;
				// }
				
				/* 20180910 3ono => selain PANDU UMUM, juga ada PANDU-PANDU lainnya */
				if (strpos($value_->SERVICE_TYPE, 'PANDU')) {
				   $tot_pandu_umum += $value_->AMOUNT;
				}

				if ($value_->SERVICE_TYPE == 'TAMBAT UMUM') {
					$tot_tambat_umum += $value_->AMOUNT;
				}

				// if ($value_->SERVICE_TYPE == 'TUNDA UMUM') {
					// $tot_tunda_umum += $value_->AMOUNT;
				// }
				
				/* 20180910 3ono => selain TUNDA UMUM, juga ada TUNDA-TUNDA lainnya */
				if (strpos($value_->SERVICE_TYPE, 'TUNDA')) {
				   $tot_tunda_umum += $value_->AMOUNT;
				}

				if ($value_->SERVICE_TYPE == 'KEPIL UMUM' || $value_->SERVICE_TYPE == 'KEPIL' || strpos($value_->SERVICE_TYPE, 'KEPIL')) {
					$tot_kepil_umum += $value_->AMOUNT;
				}



			}

			$dasar_pajak = ($tot_kepil_umum + $tot_tunda_umum + $tot_pandu_umum + $tot_tambat_umum);
		// $dipungut_pajak = 10/100 * $dasar_pajak;
			$PPN_DIPUNGUT_SENDIRI = $headerKpl->PPN_DIPUNGUT_SENDIRI;
			$dipungut_pajak = $headerKpl->PPN_DIPUNGUT_PEMUNGUT;
			$PPN_TIDAK_DIPUNGUT = $headerKpl->PPN_TIDAK_DIPUNGUT;
			$PPN_DIBEBASKAN = $headerKpl->PPN_DIBEBASKAN;

			$jumlah = $dasar_pajak + $dipungut_pajak + $materai;
			$piutang = $jumlah - $uang_jaminan;

			$jum_amount = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
			$tax_amount = ($headerKpl->PPN_10PERSEN == '') ? 0 : $headerKpl->PPN_10PERSEN; //buat ppn potongan 10 persen
			$total_amount = ($headerKpl->AMOUNT == '') ? 0 : $headerKpl->AMOUNT;
			$materai = ($headerKpl->AMOUNT_MATERAI == '') ? 0 : $headerKpl->AMOUNT_MATERAI;
			$piutang = ($headerKpl->PIUTANG == '') ? 0 : $headerKpl->PIUTANG;

		//barcode encrypt start
			$idsecret = $num;

		// $url_enc = $this->nama_fungsi->enkripsi('cetak','download',array('id'=>$num));
			$enc_trx_number = $this->mx_encryption->encrypt($value->TRX_NUMBER);

			$url_enc = 'einvoice/nota_kapal/cetak_nota_kapal/' . $enc_trx_number;
		// $url_enc = "einvoice/nota/cetak_nota/petikemas/".$idsecret."/";
			$params['data'] = ROOT . $url_enc;
			$params['level'] = 'H';
			$params['size'] = 10;
			$randomfilename = rand(1000, 9999);
		/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
		die();exit();*/
			$params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
			$this->ciqrcode->generate($params);
			$barcode_location = APP_ROOT . "qr_code/" . $randomfilename . ".png";


		//barcode encrypt end

			$ttd_location = APP_ROOT . "config/images/cr/ttd2.png";

		//terbilang
		if($piutang == 0){
			
					$terbilang = '-';
		}else{
			$amount_terbilang = $piutang;
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}
			/* ngeri lho harus gini ya */
			$flags = "N";
			$status_bayar2 = "K" . $status_bayar;
			if ($status_bayar2 == "KY") {
				$flags = "Y";
			}
			$header_nota = array(
				"faktor_note", $faktor_note,
				"status_lunas" => $flags,
				"e_logo" => $e_logo,
				"e_name" => $e_name,
				"num" => $num,
				"e_address" => $e_address,
				"tgl_nota" => $tgl_nota,
				"e_npwp" => $e_npwp,
				"ex_num" => $ex_num,
				"e_faktur" => $faktor_note,
				"jenisNota" => $jenisNota
			);
			$judul_nota = array("jenisNota" => $jenisNota);

			$paramStatus['BILLER_REQUEST_ID'] = $no_req;
			$resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

		/*template settingan pdf*/
		// $headerDt = format_nota($header_nota);
		// echo("===>".$headerDt);die();
		/*$pdf = $headerDt[0];
		$style = $headerDt[1];
		template header pdf
		define('noNotaFooter', $num);*/
			$header = header_nota($header_nota);
			$judul = judul_nota($judul_nota, $pdf);
			/*if($status_bayar=='Y') {

				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetPrintHeader(false);
				$pdf->SetTitle($title);

				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetMargins(12, 0);



				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(12, 0);




			    $pdf->SetAuthor('E invoice 2018');
	 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				// set default header data
				$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
				// set margins
				$pdf->SetMargins(12, 0);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->SetFont('courier', '', 8);
				$pdf->SetTopMargin(5);
				$pdf->AddPage();
				// echo "====>";echo $e_logo;
				//$pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
				// echo "====>";
				$style = array(
							'position' => '',
							'align' => 'C',
							'stretch' => false,
							'fitwidth' => true,
							'cellfitalign' => '',
							//'border' => true,
							'hpadding' => 'auto',
							'vpadding' => 'auto',
							'fgcolor' => array(0,0,0),
							'bgcolor' => false, //array(255,255,255),
							'text' => true,
							'font' => 'courier',
							'fontsize' => 4,
							'stretchtext' => 4
						);


			} else {
			$pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetMargins(12, 0);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		    $pdf->SetAuthor('E invoice 2018');
 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
			// set margins
			$pdf->SetMargins(12, 0);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->SetFont('courier', '', 8);
			$pdf->SetTopMargin(5);

			$pdf->AddPage();
			// echo "====>";echo $e_logo;
			//$pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
			// echo "====>";
			$style = array(
						'position' => '',
						'align' => 'C',
						'stretch' => false,
						'fitwidth' => true,
						'cellfitalign' => '',
						//'border' => true,
						'hpadding' => 'auto',
						'vpadding' => 'auto',
						'fgcolor' => array(0,0,0),
						'bgcolor' => false, //array(255,255,255),
						'text' => true,
						'font' => 'courier',
						'fontsize' => 4,
						'stretchtext' => 4
					);

			}*/




		/*$gambar = "";
		if (file_exists(APP_ROOT.'uploads/entity/'.$e_logo)) {
	    	$gambar = '<img width="350" height="200" src="'.APP_ROOT.'uploads/entity/'.$e_logo.'">';
		} else {
	    	$gambar = '<div width="350" height="40" src="'.APP_ROOT.'uploads/entity/"></div>';
		}


		$header .= '<table border="0px">
				<tr>
                    <td width="70" ROWSPAN="4">'.$gambar.'</td>
                    <td COLSPAN="9" align="left"><b>'.$e_name.'</b></td>
                    <td COLSPAN="2" align="left" width="50px">No. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$num.' </td>

                </tr>
                <tr>
                    <td COLSPAN="9" align="left">'.$e_address.' </td>
                    <td COLSPAN="2" align="left" width="50px">Tanggal</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$tgl_nota.'</td>
                </tr>
                <tr>
                    <td COLSPAN="12" align="left">NPWP: '.$e_npwp.'</td>
                    <td COLSPAN="2" align="left" width="150px">'.$e_faktur.'</td>
                </tr>';




        if($status_bayar=='Y') {
       	       $header .='

               	<tr>
                	<td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px">'.$faktor_note.'	</td>
                </tr>

                </table>';


       } else  {
       	       $header .='

               	<tr>
                	<td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px"> -	</td>
                </tr>

                </table>';

       }


        $judul ='<table border="0px">
        			<tr>
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA JASA KEPELABUHAN</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="2" align="center"><b>'.$jenisNota.'</b></td>
                	</tr>
        			</table>';*/


			$lampiran = '<table>
        			<tr>
	                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
                		<td COLSPAN="5" width="350px">
   					</tr>
   					<tr>
	                    <td COLSPAN="5" width="350px">
		                    <table>
			                	<tr>
				                    <td COLSPAN="2" align="left" width="50px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="280px">' . $custname . '</td>
			                	</tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">' . $c_number . '</td>
			                	</tr>
			                    <tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >' . $c_address . '</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">' . $nomornpwp . '</td>
		                    	</tr>	
			                	<tr>

			                	</tr>
		                    </table>
        				</td>
	                    <td COLSPAN="5">
		                    <table>
			                    <tr>
				                    <td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                   		<td COLSPAN="2" align="left"  width="280px">' . $kapal . '</td>
			                    </tr>
			                    <tr>
				                    <td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">' . $kunjungan . '</td>
			                    </tr>
					        	<tr>
					           		<td COLSPAN="2" align="left">Nomor PPKB</td>
					                <td COLSPAN="1" align="left">:</td>
					                <td COLSPAN="2" align="left">' . $no_ppkb . '</td>
					        	</tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">Nomor PKK</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">' . $no_ukk . '</td>
			                	</tr>
			                </table>
	                    </td>
                	</tr>
                	<tr>
                	</tr>


                	<tr>
	                    <td COLSPAN="2" align="left"></td>
						<td COLSPAN="1" align="left"></td>
	                    <td COLSPAN="2" align="left"></td>
	                    <td COLSPAN="2" align="left"></td>
	                    <td COLSPAN="1" align="left"></td>
                   		<td COLSPAN="2" align="left"></td>
                	</tr>	
        			</table>';
			$lampiran .= '<table><tr><td style="line-height: 24px;">&nbsp;</td></tr></table>';

			$tbl_tail = '<table border="0px">
				  <tr>
				    <th width="20"><b>NO</b></th>
				    <th width="200"><b>JENIS JASA</b></th>
				    <th colspan="2" align="center"><b>JUMLAH</b></th>
				    <th colspan="4" align="center"><b>KETENTUAN</b></th>

				  </tr>';


			$data_sum = array();
			foreach ($trxline as $key) {

				$r[$key->SERVICE_TYPE][] = $key;
				$data_sum[$key->AMOUNT][] = 0;
			}
			
			foreach ($trxline as $list) {
				$number = $list->AMOUNT;
				
				$pos = strpos($list->SERVICE_TYPE, " ");
				$substrLayanan = substr($list->SERVICE_TYPE, 0, $pos);
				
				$data_summ[$substrLayanan] += (float)$number;
			}

			$no = 1;
			$tbl_tail_body = "";
			$dataValue = array(
				"TAMBAT" => 0,
				"PANDU" => 0,
				"TUNDA" => 0,
				"KEPIL" => 0,
				"ADMINISTRASI" => 0,
				"LAIN" => 0,
			);
			foreach ($data_summ as $key => $value) {


			// echo $key .'='.$value;
			/*if(strpos($key, 'are')){
				// 
			}*/
				if (strpos($key, 'TAMBAT') !== false) {
					$dataValue['TAMBAT'] = $value;
				} else if (strpos($key, 'PANDU') !== false) {
					$dataValue['PANDU'] = $value;
				} else if (strpos($key, 'TUNDA') !== false) {
					$dataValue['TUNDA'] = $value;
				} else if (strpos($key, 'KEPIL') !== false) {
					$dataValue['KEPIL'] = $value;
				} else if (strpos($key, 'ADMINISTRASI') !== false) {
					$dataValue['ADMINISTRASI'] = $value;
				} else if (strpos($key, 'LAIN') !== false) {
					$dataValue['LAIN'] = $value;
				}
			/*$tbl_tail_body .= '
					 <tr>
				    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$no++.'</td>
				    <td width="200">'.$key.'</td>
				    <td>IDR</td>
				    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($value,0,',','.').'</td>
				    <td></td>
				    <td width="5"></td>

				  </tr>';*/

			}

			$tbl_tail_body .= '
					 <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Tambat</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['TAMBAT'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Pandu</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['PANDU'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Tunda</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['TUNDA'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Kepil</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['KEPIL'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Jasa Lain-lain</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['LAIN'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>
					  <tr>
					    <td style="font-size: 11px;font-family: franklingothicbook;" width="20">' . $no++ . '</td>
					    <td width="200">Administrasi</td>
					    <td>IDR</td>
					    <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($dataValue['ADMINISTRASI'], 0, ',', '.') . '</td>
					    <td></td>
					    <td width="5"></td>

					  </tr>';

		/*$tbl_tail .= '
					 <tr>
				    <td width="20"></td>
				    <td width="200"></td>
				    <td></td>
				    <td align="right"> </td>
				    <td></td>
				    <td width="30">1.</td>
				     <td ROWSPAN="4" colspan="3">'. $get_redaksi_x->INV_REDAKSI_NOTE .'.</td>
				  </tr>
				  <tr>
				    <td width="20"></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td ></td>

				  </tr>
				  <tr>
				    <td width="20"></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td width="30">2.</td>
				    <td ROWSPAN="4" colspan="3">-</td>
				  </tr>';*/



		/*$tbl_tail .= '
				  <tr>
				    <td colspan="2"><b>JUMLAH / DASAR PENGENAAN PAJAK</b></td>
				    <td>Rp.</td>
				    <td align="right"><b>'.number_format($dasar_pajak,2,',',',').'</b></td>
				    <td></td>


				  </tr>
				  <tr>
				    <td colspan="2">PPN 10%</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td width="20">a.</td>
				    <td>Dipungut Sendiri</td>
				    <td>Rp.</td>
				    <td align="right"> '.($value->PPN_DIPUNGUT_SENDIRI).'</td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td width="20">b.</td>
				    <td>PPn Dipungut Pemungut</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($dipungut_pajak,2,',',',').'</td>
				    <td></td>
				    <td width="30">3.</td>
				    <td ROWSPAN="4" colspan="3">-</td>
				  </tr>
				  <tr>
				    <td width="20">c.</td>
				    <td>PPn tidak dipungut</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($value->PPN_TIDAK_DIPUNGUT,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td width="20">d.</td>
				    <td>PPn dibebaskan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($value->PPN_DIBEBASKAN,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2">Materai</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($amount_materai,2,',',',').'</td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td colspan="2">Jumlah Tagihan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($amount_tagihan,2,',',',').'</td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2">Uang Jaminan</td>
				    <td>Rp.</td>
				    <td align="right">'.number_format($uang_jaminan,2,',',',').'</td>
				    <td></td>
				     <td width="30">4.</td>
				    <td ROWSPAN="4" colspan="3">-</td>

				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td colspan="2"><b>Piutang</b></td>
				    <td>Rp.</td>
				    <td align="right"><b>'.number_format($amount_tagihan,2,',',',').'</b></td>
				    <td></td>
				    <td></td>

				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				</table>';


		$jml_footer = '<table>
						<tr>
							<td COLSPAN="2" align="left" width="80px">Terbilang</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
	                    	<td COLSPAN="7" align="left">'.$terbilang.'</td></br>
						</tr>
					   </table>';

		$ttd_footer ='<table>
						<tr>
							<td COLSPAN="9" ROWSPAN="5" align="left" width="300px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td align="center" width="400px">Jakarta, '.$tgl_nota.'</td>
						</tr>
						<tr>
		                    <td align="center" width="400px">'.$jabatan_pejabat.'</td>
                		</tr>
                		<tr>
                			<td width="200px">&nbsp;</td>
		                    <td width="100px"><img style="padding-left:200" width="100" height="100" src="'.APP_ROOT.'uploads/ttd/'.$ttd_pejabat.'"></td>
                		</tr>
                		<tr>
		                    <td align="center" width="400px" style="text-decoration: underline">'.$pejabat.'</td>
                		</tr>
                		<tr>
                			<td align="center" width="400px" style="text-decoration: underline">NIPP. '.$nip_pejabat.'</td>
                		</tr>
                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>
					  </table>';*/
			$footer_nota = array(
				"headerContext" => $headerContext,
				"headerSubContext" => $header_context,
				"terbilang" => $terbilang,
				"barcode_location" => $barcode_location,
				"tgl_nota" => $tgl_nota,
				"jabatan_pejabat" => $jabatan_pejabat,
				"ttd_pejabat" => $ttd_pejabat,
				"pejabat" => $pejabat,
				"nip_pejabat" => $nip_pejabat,
				"current" => 'IDR',
				"get_redaksi_x" => $get_redaksi_x,
				"unit_loc" => $unit_loc,
				"data" => array(
					"INV_REDAKSI_NOTE" => $get_redaksi_x->INV_REDAKSI_ATAS,
					"dasar_pajak" => $dasar_pajak,
					"PPN_DIPUNGUT_SENDIRI" => ($headerKpl->PPN_10PERSEN == '') ? 0 : $headerKpl->PPN_10PERSEN,
					"dipungut_pajak" => ($headerKpl->PPN_DIPUNGUT_PEMUNGUT == '') ? 0 : $headerKpl->PPN_DIPUNGUT_PEMUNGUT,
					"PPN_TIDAK_DIPUNGUT" => ($headerKpl->PPN_TIDAK_DIPUNGUT == '') ? 0 : $headerKpl->PPN_TIDAK_DIPUNGUT,
					"PPN_DIBEBASKAN" => ($headerKpl->PPN_DIBEBASKAN == '') ? 0 : $headerKpl->PPN_DIBEBASKAN,
					"amount_materai" => $amount_materai,
					"amount_tagihan" => $amount_tagihan,
					"uang_jaminan" => $uang_jaminan,
					"amount_tagihan" => $amount_tagihan,
					"dasarpengenaanpajak" => $jml_dasar_pajak,
					"piutang" => $piutang,
				)
			);
			$footer_nota['data']['tbl_tail'] = $tbl_tail_body;

			$footer = $tbl_tail . footer_nota($footer_nota);
		// $tbl_tail = $tbl_tail.$footer;
		// echo $tbl_tail;die();
		/*$ematerai_nota = "";
		if($status_bayar=="Y"){

		}*/
			$ematerai_nota = array(
				"amountMaterai" => $amountMaterai,
				"redaksi" => $redaksi,
				"unit_wilayah" => $unit_wilayah,
				"alamat_wilayah" => $alamat_wilayah,
				"status_lunas" => $status_lunas //$status_bayar
			);
			$ematerai_nota = ematerai_nota($ematerai_nota);
			$output_name = "Nota All Kapal.pdf";
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->writeHtml($header, true, false, false, false, '');
		// $pdf->SetFont('courier', '', 8);
			$pdf->writeHtml($judul, true, false, false, false, '');
			$pdf->writeHtml($lampiran, true, false, false, false, '');
		// $pdf->writeHtml($tbl_tail, true, false, false, false, '');
			$pdf->writeHtml($footer, true, false, false, false, '');
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		// $pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
			$pdf->SetY(260);
			$pdf->writeHtml($ematerai_nota, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		

		/*$postdataEmaterai = array("TRX_NUMBER"=>$num);
		$datax = $this->senddataurl('Ematerai/insertematerai/', $postdataEmaterai,'POST');
		$postdatapengiriman = array("TRX_NUMBER"=>$num);
		$datakirim = $this->senddataurl('Pengiriman/insertpengiriman/', $postdatapengiriman, 'POST');*/
		/*$postlognota = array(
								"TRX_NUMBER"=>$num,
								"ACTIVITY"=>"CETAK",
								"USER_ID"=>$this->session->userdata('user_id'),
							);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');*/
		/*$pdf->AddPage();*/

		}
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');
	}
		// $id = $trx;

}

class MyCustomPDFWithWatermark extends TCPDF
{
	public function Header()
	{
        // Get the current page break margin
		$bMargin = $this->getBreakMargin();

        // Get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;

        // Disable auto-page-break
		$this->SetAutoPageBreak(false, 0);

        // Define the path to the image that you want to use as watermark.
        // $img_file = APP_ROOT.'assets/images/copy.png';
		if (!defined(img_file)) {
        	// echo img_file;die();
			$img_file = img_file;
		} else {
			$img_file = APP_ROOT . 'assets/images/copy.png';
		}
        // Render the image
		$this->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

        // Restore the auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);

        // Set the starting point for the page content
		$this->setPageMark();
	}
	public function Footer()
	{
        // Position at 15 mm from bottom
		$this->SetY(-15);
        // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // Page number
		$this->Cell(0, 10, noNotaFooter, 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, "Print Date : " . date("d-M-Y H:i:s") . ' | Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}
