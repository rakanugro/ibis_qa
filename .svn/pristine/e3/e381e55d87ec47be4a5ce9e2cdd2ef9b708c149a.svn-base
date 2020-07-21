<?php
date_default_timezone_set("Asia/Bangkok");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
require(APPPATH.'helpers/tcpdf/tcpdf.php');
class Koreksi extends CI_Controller {

	var $API ="";

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('auth_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		// $this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		$this->load->library('MX_Encryption');
		define('IMAGES_TTD_', APP_ROOT."uploads/ttd/");
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		// if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
		// 	redirect(ROOT.'mainpage', 'refresh');
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
		#debug file
         // file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         // 	array(
         // 		"body" => $ex,
         // 		"url" => $uri,
         // 		"data" => $data,
         // ),true), FILE_APPEND);
		// echo $ex;die();
		return $result;
	}


	public function koreksisearch(){
		$postdata = ($_POST);
		// print_r($postdata);die();
		$arrayData = $this->senddataurl('koreksinota/search/',$postdata,'POST');
		$data = array(
				'data' => array()
			);
		$num = 1;
		$jenisNota = $this->getMstNota("BRG");


		foreach ($arrayData as $key => $value) {
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			$data['data'][$key]->statusKoreksi = "-";
			$data['data'][$key]->TRX_DATE =  date('Y-m-d', strtotime($value->TRX_DATE));
			$data['data'][$key]->STATUS_LUNAS = $statusL;
			$enc_trx_number = $this->mx_encryption->encrypt($value->TRX_NUMBER);

            $enc_ukk_ppkb = $this->mx_encryption->encrypt($value->INTERFACE_HEADER_ATTRIBUTE6.'|'.$item->INTERFACE_HEADER_ATTRIBUTE1);
			$data['data'][$key]->AMOUNT = number_format($value->AMOUNT, 0, ' ', '.');
			$data['data'][$key]->action = '<a class="btn btn-sm btn-primary btn-sm"  href="javascript:void(0)" onclick="koreksiForm(\''.$value->TRX_NUMBER.'\',\''.$value->STATUS_KOREKSI.'\',\''.$value->KETERANGAN_KOREKSI.'\')"> <i class="fa fa-edit"></i> Edit</a>'; 
			/*if ($value->HEADER_CONTEXT == "KPL") {
				$data['data'][$key]->action .= ' &nbsp; <a class="btn btn-sm btn-primary" target="_blank"  href="'.ROOT.'einvoice/nota_kapal/cetak_nota_kapal/'.$enc_trx_number.'" data-ukk="'.$item->TRX_NUMBER.'" data-cabang="10"  id="btn_'.$item->TRX_NUMBER.'" title="Cetak NOTA" onclick="cetak_nota()" data-id="'.$item->TRX_NUMBER.'" > <i class="fa fa-print"></i>  NOTA</a>';
			} elseif ($value->HEADER_CONTEXT == "BRG") {
				$data['data'][$key]->action .= ' &nbsp; <a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota/cetak_barang/barang/'.$enc_trx_number.'"><i class="fa fa-print" ></i> NOTA</a>';
			} elseif ($value->HEADER_CONTEXT == "RUPA") {
				$data['data'][$key]->action .= ' &nbsp; <a target="_blank" onclick="Cetak()" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota/cetak_nota/RUPARUPA/'.$enc_trx_number.'"><i class="fa fa-print"></i> NOTA</a>';
			} elseif ($value->HEADER_CONTEXT == "PTKM") {
				$data['data'][$key]->action .= ' &nbsp; <a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota/cetak_nota/petikemas/'.$enc_trx_number.'"><i class="fa fa-print"></i> NOTA</a>';
			}*/

			$layanan = array(
							"KPL"=> "KAPAL",
							"BRG"=> "BARANG",
							"RUPA"=> "RUPA RUPA",
							"PTKM"=> "PETIKEMAS",
						);
			if (isset($layanan[$value->HEADER_CONTEXT])) {
				$data['data'][$key]->JENIS = $layanan[$value->HEADER_CONTEXT];
			} else {
				$data['data'][$key]->JENIS = "-";
			}
			if ($value->STATUS_KOREKSI == "1") {
				$data['data'][$key]->statusKoreksi = "Proses Koreksi";
			}
			if ($value->STATUS == "P") {
				$data['data'][$key]->STATUS = "Invoice";
			}


			 

			
		}
		echo json_encode($data);
	}
	public function koreksiGet(){
		$postdata = ($_GET);
		// print_r($postdata);die();
		$postdata['STATUS_LUNAS'] = "Y";
		$arrayData = $this->senddataurl('koreksinota/search/',$postdata,'POST');
		$data = array(
				'data' => array()
			);
		$num = 1;
		$jenisNota = $this->getMstNota("BRG");

		$data['data'] = $arrayData;
		echo json_encode($data);
	}
	public function koreksiGetOne(){
		$postdata = ($_POST);
		// print_r($postdata);die();
		$postdata['STATUS_LUNAS'] = "Y";
		$arrayData = $this->senddataurl('koreksinota/search/',$postdata,'POST');
		$data = array(
				'data' => array()
			);
		$num = 1;
		if (empty($postdata['TRX_NUMBER'])) {
			echo json_encode(array("data"=>array()));die();
		}

		$jenisNota = $this->getMstNota($arrayData[0]->HEADER_CONTEXT);
		$layanan = array(
						"KPL"=> "KAPAL",
						"BRG"=> "BARANG",
						"RUPA"=> "RUPA RUPA",
						"PTKM"=> "PETIKEMAS",
					);
		// echo print_r($jenisNota);die();
		$data['data'] = $arrayData[0];
		if (isset($layanan[$arrayData[0]->HEADER_CONTEXT])) {
			$data['data']->JENIS = $layanan[$arrayData[0]->HEADER_CONTEXT];
		} else {
			$data['data']->JENIS = "-";
		}

		if (isset($jenisNota[$arrayData[0]->HEADER_SUB_CONTEXT])) {
				$data['data']->JENISNota = $jenisNota[$arrayData[0]->HEADER_SUB_CONTEXT];
			} else {
				$data['data']->JENISNota = "-";
			}
		$data['data']->AMOUNT = number_format($data['data']->AMOUNT, 0, ' ', '.');
		echo json_encode($data);
	}

	function getMstNota($codeNota){
		$jenisNota = array();
		$notaJenis = $this->getdataurl('mstnota/getData/'.$codeNota);
		foreach ($notaJenis as $key => $value) {
			$jenisNota[$value->INV_NOTA_CODE] = $value->INV_NOTA_JENIS;
		}
		return $jenisNota;
	}
	function savekoreksi(){
		$postdata = ($_POST);
		// print_r($postdata);die();
		$postdata['Tgl_pengjuan'] = $_POST['Tgl_pengjuanEdit'];
		$dataArray = $this->senddataurl('Koreksinota',$postdata,'POST');

		echo json_encode($dataArray);
	}
	function savekoreksiAdd(){
		$postdata = ($_POST);
		$postdata['BILLER_REQUEST_ID'] = $_POST['BILLER_REQUEST_ID_ADD'];
		$postdata['KETERANGAN_KOREKSI'] = $_POST['KETERANGAN_KOREKSI_ADD'];
		// $postdata['Tgl_pengjuan'] = $_POST['Tgl_pengjuan_ADD'];
		$postdata['Tgl_pengjuan'] = date('d-M-y',strtotime($_POST['Tgl_pengjuan_ADD']));
		// print_r($postdata);die();
		$dataArray = $this->senddataurl('Koreksinota',$postdata,'POST');

		echo json_encode($dataArray);
	}


	public function index(){
		$data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/BARANG');
		$this->common_loader($data,'invoice/nota/koreksi/koreksi');
	}

	
	public function common_loader($data,$views) {
		if (! $this->session->userdata('is_login') ){
		 	redirect(ROOT.'main_invoice', 'refresh');
		}
		$role_id =  $this->session->userdata('role_id')	;
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

}
class MyCustomPDFWithWatermark extends TCPDF {
        public function Header() {
            // Get the current page break margin
            $bMargin = $this->getBreakMargin();

            // Get current auto-page-break mode
            $auto_page_break = $this->AutoPageBreak;

            // Disable auto-page-break
            $this->SetAutoPageBreak(false, 0);

            // Define the path to the image that you want to use as watermark.
            $img_file = APP_ROOT.'assets/images/copy.png';

            // Render the image
            $this->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

            // Restore the auto-page-break status
            $this->SetAutoPageBreak($auto_page_break, $bMargin);

            // Set the starting point for the page content
            $this->setPageMark();
        }
        public function Footer() {
	        // Position at 15 mm from bottom
	        $this->SetY(-15);
	        // Set font
	        // $this->SetFont('helvetica', 'I', 8);
	        // Page number
	        $this->Cell(0, 10, noNotaFooter, 0, false, 'L', 0, '', 0, false, 'T', 'M');
	        $this->SetFont('helvetica', 'I', 8);
	        $this->Cell(0, 10, "Print Date : ".date("d-M-Y H:i:s").' | Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	    }
    }
