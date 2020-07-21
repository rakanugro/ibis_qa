<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class request_receiving extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('booking_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('npkbilling/requests/receiving_request_model');
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
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= " Request Receiving";
		$this->common_loader($data,'npkbilling/request/request_receiving');
		
	}

	public function create_receiving() 
	{

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "Form Receiving";
		$data['id'] = "";
		$this->common_loader($data,'npkbilling/request/create_receiving');
	}

	public function getList()
	{
		$data = $this->receiving_request_model->getList();
		echo json_decode($data);
	}

	public function save(){
		$json = $this->input->post('data');
		echo $data = $this->receiving_request_model->save($json);
		//echo json_decode($data);
	}

	public function update($id) 
	{
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "Form Receiving";
		$data['id'] = $id;
		$this->common_loader($data,'npkbilling/request/create_receiving');
	}

	public function view($id) 
	{
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "View Receiving";
		$data['id'] = $id;
		$this->common_loader($data,'npkbilling/request/view_receiving');
	}

	public function update_receiving($id){
		$data = $this->receiving_request_model->update($id);
		echo $data;
	}

	public function send($id){
		$data = $this->receiving_request_model->send($id);
		echo json_encode($data);
	}

}
	