<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class proforma extends CI_Controller
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
		$this->load->model('booking_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('npksbilling/billing_management/proforma_model');
		$this->load->library('esb_npks');
		$this->load->library("nusoap_lib");
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');

		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');
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

	public function redirect()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
	}


	public function index()
	{
		$this->redirect();
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Billing Management Proforma";
		$this->common_loader($data, 'npksbilling/billing_management_npks/proforma.php');
	}

	public function getListProforma()
	{
		$data = $this->proforma_model->getListProforma();
		echo json_decode($data);
	}


	public function approve_proforma()
	{
		$action = $this->input->post("action");
		$nota_id = $this->input->post("id");
		$data = $this->proforma_model->approve_proforma($action, $nota_id);
		echo $data;
	}

	public function reject_proforma()
	{
		$action = $this->input->post("action");
		$nota_id = $this->input->post("id");

		// print_r($file);die;
		$data = $this->proforma_model->reject_proforma($action, $nota_id);
		echo $data;
	}

	// public function view_proforma($id)
	// {
	// 	list($id_data, $type_data) = explode('-', $id);
	// 	$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
	// 	$data['title'] = "Form Payment";
	// 	$data['bank'] = $this->proforma_model->getBankList();
	// 	$data['detail_payment'] = $this->proforma_model->detail_proforma($id_data);
	// 	$data['type_data'] = $type_data;
	// 	$this->common_loader($data, 'npksbilling/billing_management_npks/view_proforma');
	// }

	// public function save_payment_cash()
	// {
	// 	$json = $this->input->post('data');
	// 	$data = $this->proforma_model->save_payment_cash($json);
	// 	echo $data;
	// }

	// public function tes()
	// {
	// 	$sub_group_phd = str_replace(",", "", $this->session->userdata('sub_group_phd'));
	// 	print_r($sub_group_phd);
	// }
}
