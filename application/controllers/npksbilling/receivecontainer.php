<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class receivecontainer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('npksbilling/request/receivecontainer_model');
		$this->load->model('npksbilling/master/mdm_model');
		$this->load->library("nusoap_lib");
		$this->load->library('esb_npks');
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');

		$this->load->library('breadcrumbs');
		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');
	}


	public function redirect()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
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
		$data['title'] = "Request Receiving Container";
		$this->common_loader($data, 'npksbilling/request/main_receivecontainer');
	}

	public function create_receivecontainer()
	{
		$data['title'] = "Form Create Receiving Container";
		$data['id'] = "";
		$data['docType'] = $this->mdm_model->getDocType();
		
		$this->common_loader($data, 'npksbilling/request/create_receivecontainer');
	}

	public function getList()
	{
		$data = $this->receivecontainer_model->getList();
		echo $data;

	}

	public function save(){
		$json = $this->input->post('data');
		echo $data = $this->receivecontainer_model->save($json);
	}

	public function update($id) 
	{
		$data['title']= "Form Update Receiving Container";
		$data['id'] = $id;
		$data['docType'] = $this->mdm_model->getDocType();
		$this->common_loader($data,'npksbilling/request/create_receivecontainer');
	}

	public function update_receivingContainer($id)
	{
		$data = $this->receivecontainer_model->update($id);
		echo $data;
	}

	public function view($id)
	{
		$data['title']= "Form View Receiving Container";
		$data['id'] = $id;
		$data['docType'] = $this->mdm_model->getDocType();
		$this->common_loader($data,'npksbilling/request/view_receivecontainer');
	}

	public function send($id){
		$data = $this->receivecontainer_model->send($id);
		echo json_encode($data);
	}
}
