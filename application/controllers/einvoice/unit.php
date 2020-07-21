<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class unit extends CI_Controller {

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
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
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
         file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         	array(
         		"body" => $ex,
         		"url" => $uri,
         		"data" => $data,
         ),true), FILE_APPEND);
		return $result;
	}

	function masterpejabatsave(){
		$data = ($_POST);
		// $logoName = $this->upload_img("req" ,$data['INV_PEJABAT_TTD'],$data);
		// //$logoName = $this->upload_img("req" ,"INV_PEJABAT_TTD",$data);
		// //print_r($logoName."hjhj");die();
		// $data['INV_PEJABAT_TTD'] = $logoName;
		$data['INV_PEJABAT_EFECTIVE'] = $data['INV_PEJABAT_EFECTIVETEMP'] ;
		$data['INV_PEJABAT_EXPIRED'] = $data['INV_PEJABAT_EXPIREDTEMP'] ;
		unset($data['INV_PEJABAT_EFECTIVETEMP']);
		unset($data['INV_PEJABAT_EXPIREDTEMP']);
		$logoName = $this->upload_img("req" ,"INV_PEJABAT_TTD",$data);
		$data['INV_PEJABAT_TTD'] = $logoName;
		// echo print_r($data);die();
		$result = $this->senddataurl('pejabat',$data,'PUT');
		echo json_encode($result);
	}
	function getNota(){
		$postdata = ($_POST);
		if($postdata['INV_NOTA_LAYANAN'] === "KPL") {
			$postdata['INV_NOTA_LAYANAN'] = "KAPAL";
		} elseif($postdata['INV_NOTA_LAYANAN'] === "PTKM") {
			$postdata['INV_NOTA_LAYANAN'] = "PETIKEMAS";
		} elseif($postdata['INV_NOTA_LAYANAN'] === "BRG") {
			$postdata['INV_NOTA_LAYANAN'] = "BARANG";
		} elseif($postdata['INV_NOTA_LAYANAN'] === "RUPA") {
			$postdata['INV_NOTA_LAYANAN'] = "RUPA-RUPA";
		}

		$dataArray = $this->senddataurl('nota/search/',$postdata,'POST');
		echo json_encode($dataArray);
	}


	function masterpejabatupdate(){
		$datas = ($_POST);


		$data['INV_PEJABAT_ID'] = $datas['INV_PEJABAT_ID'];
		$data['INV_PEJABAT_NAME'] = $datas['INV_PEJABAT_NAME1'];
		$data['INV_PEJABAT_NIPP'] = $datas['INV_PEJABAT_NIPP1'];
		$data['INV_PEJABAT_JABATAN'] = $datas['INV_PEJABAT_JABATAN1'];
		$data['INV_PEJABAT_EFECTIVE'] = $datas['INV_PEJABAT_EFECTIVETEMP'];
		$data['INV_PEJABAT_EXPIRED'] = $datas['INV_PEJABAT_EXPIREDTEMP'];
		$data['INV_PEJABAT_STATUS'] = $datas['INV_PEJABAT_STATUS1'];
		$data['INV_UNIT_ID'] = $datas['INV_UNIT_ID'];
		// $data['INV_PEJABAT_STATUS'] = $datas['INV_PEJABAT_STATUS'];
		// $data['INV_PEJABAT_TTD1'] = $datas['INV_PEJABAT_TTD1'];
		if (
			!empty($_FILES['INV_PEJABAT_TTD1']['name']) &&
			!empty($_FILES['INV_PEJABAT_TTD1']['type']) &&
			!empty($_FILES['INV_PEJABAT_TTD1']['tmp_name'])
		) {
			$logoName = $this->upload_img("req" ,"INV_PEJABAT_TTD1",$data);
			$data['INV_PEJABAT_TTD'] = $logoName;
		} else {
			$data['INV_PEJABAT_TTD'] = $datas['INV_PEJABAT_TTD_NOTIF'];
		}
		// echo print_r($data);die();
		$result = $this->senddataurl('pejabat',$data,'POST');
		echo json_encode($result);

	}

	public function upload_img($req,$varfile,$param)
	{
		$file = '';

		try
        {
			if($varfile=='INV_PEJABAT_TTD')
			{
				$folderfile='uploads/ttd';
				$ext = pathinfo($_FILES['INV_PEJABAT_TTD']['name'], PATHINFO_EXTENSION);
				$file = basename($param['INV_PEJABAT_NIPP']."_".$param['INV_PEJABAT_NAME'], '.'.$ext);
				if ($file != "") {$file = $file.'-'.time();}
			}
			if($varfile=='INV_PEJABAT_TTD1')
			{
				$folderfile='uploads/ttd';
				$ext = pathinfo($_FILES['INV_PEJABAT_TTD1']['name'], PATHINFO_EXTENSION);
				$file = basename($param['INV_PEJABAT_NIPP']."_".$param['INV_PEJABAT_NAME'], '.'.$ext);
				if ($file != "") {$file = $file.'-'.time();}
			}
			$path= UPLOADFOLDER_.$folderfile;
			$config = array(
				'upload_path' => $path,
				'allowed_types' => "gif|jpg|png|jpeg",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'file_name' => $file,
				'max_width' => "1024"
			);

			$this->load->library('upload');
            $this->upload->initialize($config);

			$this->upload->do_upload($varfile);
			$data=$this->upload->data();
			$fullpath=APP_ROOT.$folderfile."/".$data['file_name']; //file_name
			// echo $this->upload->display_errors('<p>', '</p>');

			$fullfile = $path."/".$data['file_name']; //full file_name
			log_message('debug', 'value fullfile: '.$fullfile);
			// $this->scan_virus($fullfile); //scan file disini

			injek($folderfile);
			injek($req);
			injek($fullpath);
			injek($data['file_name']);

			return $data['orig_name'];
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            echo show_error($err->getMessage());
			return "";
		}
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
