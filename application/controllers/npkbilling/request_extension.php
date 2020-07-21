<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class request_extension extends CI_Controller {

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
		$this->load->model('npkbilling/requests/extension_request_model');
		$this->load->model('npkbilling/master/mdm_model');
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


	public function index() {
		$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']	= " Request Stacking Extension";
		$data['list_extension'] = $this->extension_request_model->get_list_extension();
		
		$this->common_loader($data,'npkbilling/request/request_extension');
		
	}

	public function create_extension() {
		$data['menu_list']		= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']			= "Form Stacking Extension";
		$data['alat']	 		= $this->extension_request_model->get_alat();
		$data['satuan'] 		= $this->extension_request_model->get_satuan();
		$data['package'] 		= $this->extension_request_model->get_package();

		$this->common_loader($data,'npkbilling/request/create_extension');
	}

	public function layanan_alat(){
		$terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $data = $this->extension_request_model->layanan_alat($terminal);
        echo json_decode($data);
    }

	public function send_extension_approval() {
		$data 	= $this->extension_request_model->send_extension_approval();
		
		echo $data;
	}

	public function view_extension($extension_id) {
		$data['menu_list']			= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']				= "View Extension";
		$data['extension_id']		= $extension_id;
		// $data['extension_views'] = $this->extension_request_model->get_extension_views($extension_id);		
		// print_r($data['extension_views']);die;	
		$data['alat']	 			= $this->extension_request_model->get_alat();
		$data['satuan'] 			= $this->extension_request_model->get_satuan();
		$data['package'] 			= $this->extension_request_model->get_package();	
		$this->common_loader($data,'npkbilling/request/view_extension');
	}

	public function edit_extension($extension_id) {
		$data['menu_list']			= $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']				= "Edit Extension";
		$data['extension_id']		= $extension_id;
		// $data['extension_views'] 	= $this->extension_request_model->get_extension_views($extension_id);
		$data['alat']	 			= $this->extension_request_model->get_alat();
		$data['satuan'] 			= $this->extension_request_model->get_satuan();
		$data['package'] 			= $this->extension_request_model->get_package();

		$this->common_loader($data,'npkbilling/request/edit_extension');
	}

	public function getDataReq() {	
		$extension_id = $_GET['extension_id'];
		$data = $this->extension_request_model->get_extension_views($extension_id);
		echo json_decode($data);
	}

	public function get_nomor_request() {
		$input 	= strtoupper($this->input->get('search'));
		$terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data 	= $this->extension_request_model->get_nomor_request($input, $terminal);

		echo json_decode($data);				
	}

	public function auto_generate_by_noreq() {
		$input 	= $this->input->get('search');
		$data 	= $this->extension_request_model->auto_generate_by_noreq($input);

		echo json_encode($data);				
	}

	public function save_extension() {
		$jsonData = $this->input->post('data');
		// print_r($jsonData);die;
		echo $jsonData = $this->extension_request_model->save_extension($jsonData);
	}

}
	