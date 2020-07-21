<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Nota_dkk extends CI_Controller {
	
	var $API ="";

	public function __construct(){
		log_message('debug','----------------------------main.php/__construct------------------------------------');
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
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
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		// if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
		// 	redirect(ROOT.'mainpage', 'refresh');
		if (! $this->session->userdata('is_login') ){
				if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
				{
					redirect(ROOT.'mainpage', 'refresh');
				}		
			}
        $this->API=API_EINVOICE;
	}



	protected function getdataurl($url){
		
		// $uri = SITE_WSAPI.'/'.$url;
		//$uri = $this->API.'/'.$url;
		$uri = API_EINVOICE.'/'.$url;
		// print_r($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:'.$apiKey
	   	);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		$data  = json_decode(curl_exec($ch));
		return $data;
	}




	protected function senddataurl($url,$data,$type){
		//$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
		$uri = API_EINVOICE.'/'.$url;
		// die($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/x-www-form-urlencoded',
			'x-api-key:'.$apiKey
	   	);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$type);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$ex = curl_exec($ch);
		$result  = json_decode($ex);
		// $ex = curl_exec($ch);
		//  $result  = json_encode($ex);
		//    echo $result;
		#debug file
         /*file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         	array( 
         		"body" => $ex,
         		"url" => $uri,
         		"data" => $data,
         ),true), FILE_APPEND);*/
		return $result;
	}


	public function cek_data(){
		
		echo "ff";
	}

	public function convert_invoice(){
		//$postdata = ($_POST);
		
	$params = array(
		    'NO_UKK' => $this->input->post('NO_UKK'),
		    'ORG_ID' => $this->input->post('ORG_ID'),
		    'NO_PPKB' => $this->input->post('NO_PPKB'),
		);



	$postdata 	=	$params;
	$num = $postdata["NO_PPKB"];
	// print_r($postdata);die();
	$convert 	= 	$this->senddataurl('CreateInvoiceKapal/index/',$postdata,'POST');
	// echo json_encode($convert);

	$postlognota = array(
							"TRX_NUMBER"=>$postdata['NO_PPKB'],
							"ACTIVITY"=>"INVOICE",
							"USER_ID"=>$this->session->userdata('user_id'),
						);
	$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');




	// return ($convert);

	}

	public function cetak_dpjk($ukk,$cab){

	// date_default_timezone_set('Asia/Jakarta');      //Don't forget this..I had used this..just didn't mention it in the post
	// $datetime_variable = new DateTime();
	// $datetime_formatted = date_format($datetime_variable, 'Y-m-d H:i:s');
	$datetime_formatted  = '27/03/2018 14:00';
	$params = array(
		    'NO_UKK' => $ukk,
		    'KD_CABANG' => $cab,
		);

	$postdata =$params;
	$dkk_header = $this->senddataurl('reviewDKK/index/',$postdata,'POST');

	foreach ($dkk_header as $key => $value) {
			
			$nama_agen = $value->NM_AGEN;
			$kd_agen = $value->KD_AGEN;
			$kd_kapal	= $value->KD_KAPAL;
			$nama_kapal = $value->NM_KAPAL;
			$no_ukk = $value->NO_UKK;
			$tgl_jam_berangkat = $value->TGL_JAM_BERANGKAT;
			$tgl_jam_tiba = $value->TGL_JAM_TIBA;

			$bendera = 'INDONESIA';
			$jenis_pelayaran = strtoupper($value->PELAYARAN);
			$jenis_kapal =$value->NAMA_JENIS_KAPAL;
			$kunjungan = $value->KUNJUNGAN;
			$gt_loa = $value->GRT.'/'.$value->LOA;
			$asal = $value->PELABUHAN_ASAL;
			$tujuan = $value->PELABUHAN_TUJUAN;
			$sebelum = $value->PELABUHAN_SEBELUM;
			$berikutnya =  $value->PELABUHAN_BERIKUT;
			$form_1A = $value->KD_PPKB;




		}



	$params_ = array(

		'NO_UKK' => $ukk,
		'KD_PPKB' => $this->input->post('KD_PPKB'),

	);

	
	$postdata_ =$params_;

	$dkk_tail = $this->senddataurl('CreateDTJK/index/',$postdata_,'POST');

	$dkks_tail = $this->senddataurl('CreateDPJK/index/',$postdata_,'POST');


	$this->load->helper('pdf_helper');
	tcpdf();
	//echo "hello";
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor($nama_agen);
	$pdf->SetTitle($no_ukk);
	$pdf->SetSubject('PT PELABULAN INDONESIA II');
	$pdf->SetKeywords('NOTA DPJK DTJK '.$nama_agen.'');



	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// // set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// // set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// // set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}

	    $pdf->SetFont('courier', '', 8);	
		$pdf->AddPage();
		$pdf->Image(APP_ROOT.'uploads/entity/KODE0001_PT_PELINDO_JAMBI-1520512146', 12, 3, 20, 15, '', '', '', true, 70);
		$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => '10px',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'Arial',
					'fontsize' => 4,
					'stretchtext' => 4
				);

		$header = '<table border="0px">
				<tr>
                    <td width="200" align="left">PT Pelabuhan Indonesia II  </td>
                    <td width="350" align="right"></td>
                    <td width="100" align="left">FM.101010</td>
                </tr>
                <tr>
                    <td width="200" align="left">Cabang Pelabuhan Tanjung Priok</td>
                    <td width="250" align="right"></td>
                    <td width="80" align="left">TANGGAL</td>
                    <td width="20" align="left">:</td>
                    <td width="100" align="left">'.$datetime_formatted.'</td>
                </tr>
                <tr>
                    <td width="70">
                    </td><td COLSPAN="12" align="left"></td>
                    <td COLSPAN="2" align="left" width="150px"></td>
                </tr>
                
                <tr>
                	<td COLSPAN="13"></td>
                    <td COLSPAN="2" align="left" width="80px"></td>
					<td COLSPAN="1" align="left" width="10px"></td>
                    <td COLSPAN="2" align="left" width="170px"></td>
                </tr>
                <tr>
                	<td COLSPAN="13"></td>
                    <td COLSPAN="2" align="left" width="80px"></td>
					<td COLSPAN="1" align="left" width="10px"></td>
                    <td COLSPAN="2" align="left" width="170px"></td>
                </tr>
                </table>';

         $judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">DATA TRANSAKSI - JASA KAPAL</td>
                    <td width="100" align="left"></td>
                	</tr>
                	<tr>
                    <td width="200" align="left"></td>
                    <td width="250" align="center">TANGGAL KAPAL KELUAR: '.$tgl_jam_berangkat.'</td>
                    <td width="80" align="left"></td>
                    <td width="20" align="left"></td>
                    <td width="100" align="left"></td>
                </tr>
        		</table>
        		<table border-bottom="1px">
        			<tr>
                    <td width="640" align="left" style="border-bottom:1px solid #000"></td>
                    
                	</tr>
                	
                
        		</table>';

        $trx_header = '<table border="0px">
				<tr>
                    <td width="130" align="left">NAMA KAPAL</td>
            		<td width="20" align="left">:</td>
            		<td width="180" align="left">'.$nama_kapal.'</td>
            		 <td width="150" align="left">KUNJUNGAN/KEGIATAN</td>
            		<td width="20" align="left">:</td>
            		<td width="180" align="left">KAPAL NIAGA / UMUM</td>
                </tr>
                <tr>
                	<td width="130" align="left">KODE KAPAL/No.UKK</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$kd_kapal.'/'.$no_ukk.'</td>
                	<td width="150" align="left">MASA KUNJUNGAN</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$tgl_jam_tiba.' s/d '.$tgl_jam_berangkat.'</td>
                </tr>

                <tr>
                	<td width="130" align="left">AGEN</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$kd_agen.' ~ '.$nama_agen.'</td>
                	<td width="150" align="left">GTA/LOA</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$gt_loa.' Meter</td>
                </tr>
                <tr>
	                <td width="130" align="left">BENDERA</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$bendera.'</td>
	                <td width="150" align="left">ASAL/TUJUAN</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$asal.' / '.$tujuan.' </td>
                </tr>
                <tr>
	                <td width="130" align="left">JENIS PELAYARAN</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$jenis_pelayaran.' / NON REGULAR</td>
	                 <td width="150" align="left">SEBELUM /BERIKUT</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$sebelum.' / '.$berikutnya.'</td>
                </tr>
                <tr>
	                <td width="130" align="left">JENIS KAPAL</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$jenis_kapal.'</td>
	                <td width="150" align="left">No Form 1A</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$form_1A.'</td>
                </tr>
         	
                <tr>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			  </tr>


   

                </table>

        ';

        $trx_tail .= '
        	<table style="padding-top20px;">
			  <tr>
			    <th style="border-bottom: 1px solid black;" height="15px" width="120" align="left">URAIAN</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="50" align="left">1A-KE</th>
			    <th style="border-bottom: 1px solid black;" height="15px" >NO.BUKTI</th>
			    <th style="border-bottom: 1px solid black;" height="15px">TGL-JAM MULAI</th>
			    <th style="border-bottom: 1px solid black;" height="15px">TGL-JAM SELESAI</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="160" >KETERANGAN</th>
			  </tr>
			  <tr>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			  </tr>

			  ';

			  foreach ($dkk_tail as $key => $nilai) {
			  	# code...
			 

				$trx_tail .=  '<tr style="padding:10px;">
				<td>'.$nilai->URAIAN.'</td>
				<td>'.$nilai->PPKB_KE.'</td>
				<td>'.$nilai->FORM1A.'</td>
				<td>'.$nilai->TGL_JAM_MULAI.'</td>
				<td>'.$nilai->TGL_JAM_SELESAI.'</td>
				<td>'.$nilai->KETERANGAN1.'</td>
				</tr>';

					}

				$trx_tail .=  '<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				</tr>
				</table>
				';


         

        $footer1 ='<table>
				  <tr cellpadding="4" cellspacing="6">
				    <th style="border-bottom: 1px solid black;margin-top:40px;" height="15px" ></th>
				    <th style="border-bottom: 1px solid black;"></th>
				    <th style="border-bottom: 1px solid black;"></th>
				    <th style="border-bottom: 1px solid black;"></th>
				    <th  style="border-bottom: 1px solid black;"></th>
				    <th style="border-bottom: 1px solid black;"></th>
				  </tr>
				</table>';

       


        $output_name = "REPORT NOTA DPJK";        
        $pdf->writeHtml($header, true, false, false, false, '');
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($trx_header, true, false, false, false, '');
        $pdf->writeHtml($trx_tail, true, false, false, false, '');
         $pdf->writeHtml($footer1, true, false, false, false, '');
        

        // add a page
		$pdf->AddPage();



		$header = '<table border="0px">
				<tr>
                    <td width="200" align="left">PT Pelabuhan Indonesia II</td>
                    <td width="230" align="right"></td>
                    <td width="100" align="left">FM.01/01/01/74</td>
                    <td width="20" align="left"></td>
                    <td width="100" align="left"  style="font-size:8px">Dicetak Tanggal : 18/03/2018</td>
                </tr>
                <tr>
                    <td width="200" align="left">Cabang Pelabuhan Tanjung Priok</td>
                    <td width="250" align="right"></td>
                    <td width="80" align="left"></td>
                    <td width="20" align="left"></td>
                    <td width="100" align="left"></td>
                </tr>
                <tr>
                    <td width="200" align="left"></td>
                    <td width="230" align="right"></td>
                    <td width="80" align="left">BENTUK 3A</td>
                    <td width="20" align="left">:</td>
                    <td width="130" align="left">010.010.18-10.003372 </td>
                </tr>
                
                <tr>
                	<td width="200" align="left"></td>
                    <td width="230" align="right"></td>
                    <td width="80" align="left">TANGGAL</td>
                    <td width="20" align="left">:</td>
                    <td width="130" align="left">'.$datetime_formatted.'</td>
                </tr>
                <tr>
                	<td COLSPAN="13"></td>
                    <td COLSPAN="2" align="left" width="80px"></td>
					<td COLSPAN="1" align="left" width="10px"></td>
                    <td COLSPAN="2" align="left" width="170px"></td>
                </tr>
                </table>';

         $judul ='<table>
        			<tr>
                     <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">DATA PERHITUNGAN - JASA KAPAL</td>
                    <td width="100" align="left"></td>
                	</tr>
                	<tr>
                    <td width="200" align="left"></td>
                    <td width="250" align="center">TANGGAL KAPAL KELUAR: '.$tgl_jam_berangkat.'</td>
                    <td width="80" align="left"></td>
                    <td width="20" align="left"></td>
                    <td width="100" align="left"></td>
                </tr>
        		</table>
        		<table border-bottom="1px">
        			<tr>
                    <td width="660" align="left" style="border-bottom:1px solid #000"></td>
                    
                	</tr>
                	
                
        		</table>';

        $trx_header = '<table border="0px">
				<tr>
                    <td width="130" align="left">NAMA KAPAL</td>
            		<td width="20" align="left">:</td>
            		<td width="180" align="left">'.$nama_kapal.'</td>
            		 <td width="150" align="left">KUNJUNGAN/KEGIATAN</td>
            		<td width="20" align="left">:</td>
            		<td width="180" align="left">KAPAL NIAGA / UMUM</td>
                </tr>
                <tr>
                	<td width="130" align="left">KODE KAPAL/No.UKK</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$kd_kapal.'/'.$no_ukk.'</td>
                	<td width="150" align="left">MASA KUNJUNGAN</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$tgl_jam_tiba.' s/d '.$tgl_jam_berangkat.'</td>
                </tr>

                <tr>
                	<td width="130" align="left">AGEN</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$kd_agen.' ~ '.$nama_agen.'</td>
                	<td width="150" align="left">GTA/LOA</td>
                	<td width="20" align="left">:</td>
                	<td width="180" align="left">'.$gt_loa.' Meter</td>
                </tr>
                <tr>
	                <td width="130" align="left">BENDERA</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$bendera.'</td>
	                <td width="150" align="left">ASAL/TUJUAN</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$asal.' / '.$tujuan.' </td>
                </tr>
                <tr>
	                <td width="130" align="left">JENIS PELAYARAN</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$jenis_pelayaran.' / NON REGULAR</td>
	                 <td width="150" align="left">SEBELUM /BERIKUT</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$sebelum.' / '.$berikutnya.'</td>
                </tr>
                <tr>
	                <td width="130" align="left">JENIS KAPAL</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$jenis_kapal.'</td>
	                <td width="150" align="left">No Form 1A</td>
	                <td width="20" align="left">:</td>
	                <td width="180" align="left">'.$form_1A.'</td>
                </tr>
         	
                <tr>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			  </tr>


   

                </table>

        ';

       $trx_tail .=' <table border="0px" >
			  <tr>
			    <th style="border-bottom: 1px solid black;" height="15px" width="140" align="left"></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="40" align="left"></th>
			    <th style="border-bottom: 1px solid black;" height="15px" ></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="70" ></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="70" ></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="140" ></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="30" ></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="80"  ></th>
			  </tr>
			  </table>';


        $trx_tail .= '
        	<table border="0px" >
			  <tr>
			    <th style="border-bottom: 1px solid black;" height="15px" width="140" align="left">URAIAN</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="40" align="left">1A-KE</th>
			    <th style="border-bottom: 1px solid black;" height="15px" >NO.2A</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="70" >TGL-JAM MULAI</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="70" >TGL-JAM SELESAI</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="140" >PERHITUNGAN</th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="30" ></th>
			    <th style="border-bottom: 1px solid black;" height="15px" width="80"  >JUMLAH</th>
			  </tr>
			  <tr>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			  </tr>';
	$jml_ppn = 0;
	$jml_hitung = 0;
	foreach ($dkks_tail as $key => $nilai2) {
		 $jml_ppn += ($nilai2->JML_PPN);
		 $jml_hitung += ($nilai2->JUMLAH);
		$trx_tail .='
			  <tr style="padding:10px;">
			    <td>'.$nilai2->URAIAN.'</td>
			    <td>'.$nilai2->PPKB_KE.'</td>
			    <td>'.$nilai2->FORM1A.'</td>
			    <td>'.$nilai2->TGL_JAM_MULAI.'</td>
			    <td>'.$nilai2->TGL_JAM_MULAI.'</td>
			    <td>'.$nilai2->KETERANGAN_PERHITUNGAN.' </td>
			    <td align="right">Rp.</td>
			    <td align="right">'.number_format($nilai2->JUMLAH,2,',',',').'</td>
			  </tr>';


	}

	$total_all = ($jml_hitung+$jml_ppn);

	$huruf = $this->getdataurl('others/terbilang/'.$total_all);
			foreach ($huruf as $bilang) {
				$terbilang = $bilang->NILAI;
				$terbilang = $terbilang.'rupiah';
			}

	$ppn_b = (10/100)*$jml_ppn;
			  	
			$trx_tail .='<tr>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			  </tr>
			</table>
        ';


        $pajak ='<table border="0px">
				  <tr>
				    <th width="160" align="left">PAJAK PERTAMBAHAN NILAI</th>
				    <th width="20"></th>
				    <th width="80"></th>
				    <th width="80"></th>
				    <th width="80"></th>
				    <th width="120" ></th>
				    <th width="30"></th>
				    <th align="right"></th>
				  </tr>
				  <tr>
				    <td>DASAR PERHITUNGAN PAJAK</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td align="right">Rp.</td>
				    <td align="right" >'.number_format($jml_ppn,2,',',',').'</td>
				  </tr>
				  <tr>
				    <td>a. PPN dipungut sendiri</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td align="right">Rp.</td>
				    <td align="right">'.number_format($ppn_b,2,',',',').'</td>
				  </tr>
				  <tr>
				    <td>b. PPN dipungut Pemungut </td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td align="right">Rp.</td>
				    <td align="right">0,00</td>
				  </tr>
				  <tr>
				    <td>c. PPN tidak dipungut</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td align="right">Rp.</td>
				    <td align="right">0,00</td>
				  </tr>
				  <tr>
				    <td>d. PPN dibebaskan</td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td align="right">Rp.</td>
				    <td align="right">0,00</td>
				  </tr>
				  <tr>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				</table>';

		$total_perhitungan = '<table>
						  <tr>
						   <th width="160" align="left"></th>
						    <th width="20"></th>
						    <th width="80"></th>
						    <th width="80"></th>
						    <th width="80"></th>
						    <th width="120" ></th>
						    <th width="30"></th>
						    <th align="right"></th>
						  </tr>
						  <tr>
						    <td>1. JUMLAH PERHITUNGAN</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td  align="right">Rp.</td>
						    <td  align="right">'.number_format($jml_hitung+$jml_ppn,2,',',',').'</td>
						  </tr>
						  <tr>
						    <td>2. UANG JAMINAN NO</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td  align="right">Rp.</td>
						    <td  align="right">0,00</td>
						  </tr>
						  <tr>
						    <td>3. PIUTANG</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td  align="right">Rp.</td>
						    <td  align="right">'.number_format($jml_hitung+$jml_ppn,2,',',',').'</td>
						  </tr>
						</table>';

        $footer1 ='<table>
				  <tr cellpadding="4" cellspacing="6">
				    <th style="border-bottom: 1px solid black;margin-top:40px;" height="15px" ></th>
				    <th style="border-bottom: 1px solid black;"></th>
				    <th style="border-bottom: 1px solid black;"></th>
				    <th style="border-bottom: 1px solid black;"></th>
				    <th  style="border-bottom: 1px solid black;"></th>
				    <th style="border-bottom: 1px solid black;"></th>
				  </tr>
				</table>';

       $footer ='<table>
				  <tr cellpadding="4" cellspacing="6">
				    <th style="" height="15px" >BONGKAR/MUAT</th>
				    <th style=""></th>
				    <th style=""></th>
				    <th style=""></th>
				    <th  style=""></th>
				    <th style="">Peti Kemas(6) ~ Masa I : 3 Hari</th>
				  </tr>
				</table>';

		$terbilang ='<table border="0px">
				  <tr cellpadding="4" cellspacing="6">
				    <th style="" width="120" >TERBILANG</th>
				    <th style="" width="30">:</th>
				    <th style="" width="430">'.$terbilang.'</th>
				    <th style="" width="20"></th>
				    <th  style="" width="20"></th>
				    <th style="" width="20"></th>
				  </tr>
				</table>';

		$ket ='<p  style="font-size:8px"><i>PPN DIPUNGUT SENDIRI Karena Tidak ada Operator Kapal;</i> </p>';

            
        $pdf->writeHtml($header, true, false, false, false, '');
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($trx_header, true, false, false, false, '');
        $pdf->writeHtml($trx_tail, true, false, false, false, '');
        $pdf->writeHtml($pajak, true, false, false, false, '');
        $pdf->writeHtml($total_perhitungan, true, false, false, false, '');
        $pdf->writeHtml($footer1, true, false, false, false, '');
        $pdf->writeHtml($footer, true, false, false, false, '');
        $pdf->writeHtml($terbilang, true, false, false, false, '');
        $pdf->writeHtml($ket, true, false, false, false, '');





        $pdf->lastPage();
        $output_name = "my_dtjk.pdf";   
         $pdf->Output($output_name.".pdf", 'I');
        // $path =base_url('uploads/'.$output_name.'');
        // $pdf->Output($path, 'F');

	}

}
