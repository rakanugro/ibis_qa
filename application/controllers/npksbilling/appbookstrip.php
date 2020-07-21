<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class appbookstrip extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->library('xml2array');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->model('npksbilling/approval/appbookstrip_model');
		$this->load->library("esb_npks");
		$this->load->model('master_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("commonlib");
		$this->load->library('table');
		$this->load->library('ciqrcode');
		$this->load->library('breadcrumbs');
		$this->load->library('sendcurl_lib');
		//$this->session->userdata('branch_code_npk');
		$this->load->helper('MY_language_helper');
		require_once(APPPATH . 'libraries/htmLawed.php');

		if (!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT . 'mainpage', 'refresh');
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
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Approval Stripping";
		$this->common_loader($data, 'npksbilling/approval/approval_stripping');
	}

	public function getList()
	{
		$data = $this->appbookstrip_model->getList();
		echo $data;
	}

	public function preview($id)
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Preview Approval Stripping";
		$data['id'] = $id;
		$data['docType'] = $this->appbookstrip_model->getDocType();
		$this->common_loader($data, 'npksbilling/approval/preview_approval_stripping');
	}

	public function update_stripp($id = null)
	{
		if ($id) {
			$data = $this->appbookstrip_model->update_stripp($id);
			echo $data;
		} else {
			$arr = array(
				"HEADER" => ""
			);
			echo json_encode($arr);
		}
	}

	public function getTarif($id, $nota_id)
	{
		$data = $this->appbookstrip_model->getTarif($id, $nota_id);
		echo json_encode($data);
	}

	public function approve($id, $nota_id)
	{
		$data = $this->appbookstrip_model->approve($id, $nota_id);
		echo json_encode($data);
	}

	public function reject($id, $nota_id)
	{
		$remarks = $this->input->post('remarks');
		$data = $this->appbookstrip_model->reject($id, $nota_id, $remarks);
		echo json_encode($data);
	}
}
