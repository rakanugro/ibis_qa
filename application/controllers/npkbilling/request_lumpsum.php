<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class request_lumpsum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('npkbilling/requests/lumpsum_request_model');
		$this->load->model('npkbilling/master/mdm_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("nusoap_lib");
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
	}


	public function redirect()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
	}


	public function common_loader($data, $views)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}


	public function index() 
	{
		//print_r($this->session);die();
		$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']		= "Request Lumpsum ";
		$data['list_lumpsum'] = $this->lumpsum_request_model->get_list_lumpsum();

		$this->common_loader($data,'npkbilling/request/request_lumpsum');
	}

	public function create_lumpsum() {

		$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']		= "Form Lumpsum";
		$data['terminal'] = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['tipe_kegiatan'] = $this->lumpsum_request_model->get_tipe_kegiatan();
		$data['package'] 	= $this->lumpsum_request_model->get_package();
		$data['satuan'] 	= $this->lumpsum_request_model->get_satuan();		
		
		$this->common_loader($data,'npkbilling/request/create_lumpsum');
	}

	public function send_lumpsum_approval() {
		$data 	= $this->lumpsum_request_model->send_lumpsum_approval();
		
		echo $data;
	}

	public function view_lumpsum($lumpsum_id) {
		$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']		= "Form Lumpsum";
		$data['lumpsum_views'] = $this->lumpsum_request_model->get_lumpsum_views($lumpsum_id);		
		
		$this->common_loader($data,'npkbilling/request/view_lumpsum');
	}

	public function update_lumpsum($id = null)
	{
		if($id){
			$data = $this->lumpsum_request_model->update_lumpsum($id);
			echo $data;
		}else{
			$arr = array(
				"HEADER" => ""
			);
			echo json_encode($arr);
		}
	}

	public function edit_lumpsum($lumpsum_id) {
		$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']		= "Form Lumpsum";		
		$data['id']		= $lumpsum_id;		
		// $data['lumpsum_views'] = $this->lumpsum_request_model->get_lumpsum_views($lumpsum_id);		
		$data['tipe_kegiatan'] = $this->lumpsum_request_model->get_tipe_kegiatan();
		$data['terminal'] = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['package'] 	= $this->lumpsum_request_model->get_package();
		$data['satuan'] 	= $this->lumpsum_request_model->get_satuan();	
		
		$this->common_loader($data,'npkbilling/request/edit_lumpsum');
	}

	public function get_nomor_kontrak() {
		$input 	= strtoupper($this->input->get('search'));
		$data 	= $this->lumpsum_request_model->get_nomor_kontrak($input);

		echo json_decode($data);				
	}

	public function save_lumpsum() {
		$json = $this->input->post('data');
		echo $data = $this->lumpsum_request_model->save_lumpsum($json);
	}
}
	