<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class receivecontainerbatal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		//$this->load->model('booking_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('npksbilling/request/request_batal_receivecontainer');
		$this->load->library("nusoap_lib");
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');
		$this->load->library('Esb_npks');

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
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "Request Batal Receiving Container";
		$this->common_loader($data,'npksbilling/request/request_batal_receivecontainer');	
	}

	public function create_receivecontainerbatal() 
	{	
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "Form Batal Receiving Container";
		$data['id'] = "";
		$this->common_loader($data,'npksbilling/request/create_batal_receivecontainer');
	}

	public function getListreceivecontainerbatal()
	{
		$data = $this->request_batal_receivecontainer->getListreceivecontainerbatal();
		echo json_decode($data);

	}

	public function get_nomor_request() {
		$input 	= strtoupper($this->input->get('search'));
		$data 	= $this->request_batal_receivecontainer->get_nomor_request($input);

		echo json_decode($data);				
	}

	public function auto_generate_by_noreq() {
		$input 	= $this->input->get('search');
		$data 	= $this->request_batal_receivecontainer->auto_generate_by_noreq($input);

		echo json_encode($data);				
	}

	public function save_request() {
		$jsonData = $this->input->post('data');
		// print_r($jsonData);die;
		echo $jsonData = $this->request_batal_receivecontainer->save_request($jsonData);
	}

	public function update_request() {
		$jsonData = $this->input->post('data');
		// print_r($jsonData);die;
		echo $jsonData = $this->request_batal_receivecontainer->update_request($jsonData);
	}

	public function view($id)
	{
		$data['id_param'] = $id;
		$data['title']= "Form view receive Container";
		$this->common_loader($data,'npksbilling/request/detail_receivecontainerbatal');
	}

	public function preview($id)
	{
		$data = $this->request_batal_receivecontainer->preview($id);
		echo json_decode($data);
	}

	public function edit_receivecontainerbatal($id)
	{
		$data['id_param'] = $id;
		$data['title']= "Form Edit receive Container";
		$this->common_loader($data,'npksbilling/request/edit_receivecontainerbatal');
	}

	public function preview_edit($id)
	{
		$data = $this->request_batal_receivecontainer->preview($id);
		echo json_decode($data);
	}

	public function send($id){
		$data = $this->request_batal_receivecontainer->send($id);
		echo json_encode($data);
	}
	
	
}
	