<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class approveextstripping extends CI_Controller
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
		$this->load->model('npksbilling/approval/approveextstripping_model');
		$this->load->model('npksbilling/master/mdm_model');
		$this->load->library("esb_npks");
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
		$data['title'] = "Approval Extension Stuffing";
		$this->common_loader($data, 'npksbilling/approval/main_approveextstripping');
	}

	public function getList()
	{
		$data = $this->approveextstripping_model->getList();
		echo $data;
	}

	public function view($id)
	{
		$data['title']= "Approval Extension Stuffing";
		$data['id'] = $id;
		$data['cust_name'] = $this->session->userdata('customernamealt_phd');
		$data['docType'] = $this->mdm_model->getDocType();

		$this->common_loader($data,'npksbilling/approval/preview_approveextstripping');
	}

	public function preview($id)
	{
		$data = $this->approveextstripping_model->preview($id);
		echo $data;
	}

	public function preview_uper($id)
	{
		$data = $this->approveextstripping_model->preview_uper($id);
		echo $data;
	}

	public function approve($id){
		$data = $this->approveextstripping_model->approve($id);
		echo json_encode($data);
	}

	public function reject($id){
		$remarks = $this->input->post('remarks');
		$data = $this->approveextstripping_model->reject($id,$remarks);
		echo json_encode($data);
	}
}
