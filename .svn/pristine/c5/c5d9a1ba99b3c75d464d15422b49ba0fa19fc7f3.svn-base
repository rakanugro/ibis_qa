<?php
date_default_timezone_set("Asia/Bangkok");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
	log_message('debug','----------------------------main.php/__construct------------------------------------');
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
		$this->load->library('MX_Encryption');
		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
		$this->load->model('auth_model','auth_model');
        $this->API=API_EINVOICE;
	}

public function index(){

		$data["customer_name"] = "EINVOICE";

		$role_id =  $this->session->userdata('role_id')	;
		$data['menu_list'] = $this->user_model->get_menuList('j');
		// echo $role_id;die();exit();
		$data['user_role'] = $this->auth_model->get_lastrole($role_id);
		$data['role_child'] = $this->auth_model->get_child_role($role_id);

		/*layanan auth*/

		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		// echo print_r($this->session->all_userdata());die();

		// echo $this->session->userdata('user_id');
		//print_r($data['layanan']);
		if (! $this->session->userdata('is_login') ){
		 	redirect(ROOT.'main_invoice', 'refresh');
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('invoice/administrasi/masterprofil/profil', $data);
		$this->load->view('templates/footer', $data);

	}

	function editprofil(){
		// echo "TEST";
		// die();
		$postdata['INV_USER_ID']= $this->session->userdata('user_id') ;
		$postdata['INV_UNIT_CODE']= $this->session->userdata('role_id') ;
		$data = $this->senddataurl('user/search/',$postdata,'POST');
		// print_r($data);	die;
		echo json_encode($data);
	}

	function updateprofil(){

		//cara pertama

		if($this->input->post('INV_USER_PASSWORD')) {
		if ($this->input->post('INV_USER_PASSWORD') != $this->input->post('CONFIRM_PASSWORD')) {
			$param['status'] = "failed";
			$param['message'] = "Password Tidak Sama";
			echo json_encode($param);die();
		}

		$data = array(
			'INV_USER_ID' => $this->session->userdata('user_id'),
			'INV_USER_ROLE_ID' => $this->session->userdata('role_id'),
			'INV_USER_NAME' => $this->input->post('INV_USER_NAME'),
			'INV_USER_NIPP' => $this->input->post('INV_USER_NIPP'),
			'INV_USER_USERNAME' => $this->input->post('INV_USER_USERNAME'),
			'INV_USER_PASSWORD' => md5($this->input->post('INV_USER_PASSWORD')),
			// 'INV_USER_EFECTIVE' => $this->input->post('INV_USER_EFECTIVE'),
			// 'INV_USER_EXPIRED' => $this->input->post('INV_USER_EXPIRED')
			// 'INV_ENTITY_CODE' => $this->input->post('INV_ENTITY_CODE')
			// 'INV_ROLE_TYPE' => $this->input->post('INV_ROLE_TYPE'),
			// 'INV_ROLE_NAME' => $this->input->post('INV_ROLE_NAME'),
			// 'INV_UNIT_CODE' => $this->input->post('INV_UNIT_CODE')
			);

		}else {


			$data = array(
			'INV_USER_ID' => $this->session->userdata('user_id'),
			'INV_USER_ROLE_ID' => $this->session->userdata('role_id'),
			'INV_USER_NAME' => $this->input->post('INV_USER_NAME'),
			'INV_USER_NIPP' => $this->input->post('INV_USER_NIPP'),
			'INV_USER_USERNAME' => $this->input->post('INV_USER_USERNAME')
			// 'INV_USER_PASSWORD' => md5($this->input->post('INV_USER_PASSWORD')),
			// 'INV_USER_EFECTIVE' => $this->input->post('INV_USER_EFECTIVE'),
			// 'INV_USER_EXPIRED' => $this->input->post('INV_USER_EXPIRED')
			// 'INV_ENTITY_CODE' => $this->input->post('INV_ENTITY_CODE')
			// 'INV_ROLE_TYPE' => $this->input->post('INV_ROLE_TYPE')
			// 'INV_ROLE_NAME' => $this->input->post('INV_ROLE_NAME')
			// 'INV_UNIT_CODE' => $this->input->post('INV_UNIT_CODE')
			);

		}
		$result = $this->senddataurl('user/profil',$data,'POST'); //kalau update ganti PUT jadi POST
		echo json_encode($result);
	}

protected function senddataurl($url,$data,$type){

         $time = time();
         // file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", $ex, FILE_APPEND);
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
		// echo "$ex";
		#debug file
         // file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         // 	array(
         // 		"body" => $ex,
         // 		"url" => $uri,
         // 		"data" => $data,
         // ),true), FILE_APPEND);
		return $result;
	}
}