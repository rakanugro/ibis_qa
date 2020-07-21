<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class request_delivery extends CI_Controller {

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
		$this->load->model('npkbilling/requests/delivery_request_model');
		$this->load->model('booking_model');
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

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function redirect(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
	}

	public function index(){
		$this->redirect();
		$customer_id=$this->session->userdata('customerid_phd');
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "Request Delivery";
		$this->common_loader($data,'npkbilling/request/request_delivery');
	}

	public function getList()
	{
		$data = $this->delivery_request_model->getList();
		echo $data;
	}

	public function create_delivery() {
		$data['title']= "Form Delivery";
		$this->common_loader($data,'npkbilling/request/create_delivery');
	}

	public function save(){
		$json = $this->input->post('data');
		echo $data = $this->delivery_request_model->save($json);
	}

	public function update($id) 
	{
		$data['title']= "Form Delivery";
		$data['id'] = $id;
		$this->common_loader($data,'npkbilling/request/create_delivery');
	}

	public function view($id)
	{
		$data['title']= "View Delivery";
		$data['id'] = $id;
		$this->common_loader($data,'npkbilling/request/view_delivery');
	}

	public function update_delivery($id){
		$data = $this->delivery_request_model->update($id);
		echo $data;
	}

	public function send($id){
		$data = $this->delivery_request_model->send($id);
		echo json_encode($data);
	}

	
}