<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class appbookdel extends CI_Controller
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
		$this->load->model('npksbilling/approval/appbookdel_model');
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
		$data['title'] = "Approval Delivery Container";
		$this->common_loader($data, 'npksbilling/approval/approval_delivery_container');
	}

	public function getList()
	{
		$data = $this->appbookdel_model->getList();
		echo $data;
	}

	public function preview($id)
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Preview Approval Delivery Container";
		$data['id'] = $id;
		$data['docType'] = $this->appbookdel_model->getDocType();
		$this->common_loader($data, 'npksbilling/approval/preview_approval_delivery_container');
	}

	public function update_del($id = null)
	{
		if ($id) {
			$data = $this->appbookdel_model->update_del($id);
			echo $data;
		} else {
			$arr = array(
				"HEADER" => ""
			);
			echo json_encode($arr);
		}
	}

	public function getTarif($id)
	{
		$data = $this->appbookdel_model->getTarif($id);
		echo json_encode($data);
	}

	public function approve($id)
	{
		$data = $this->appbookdel_model->approve($id);
		echo json_encode($data);
	}

	public function reject($id)
	{
		$remarks = $this->input->post('remarks');
		$data = $this->appbookdel_model->reject($id, $remarks);
		echo json_encode($data);
	}
}
