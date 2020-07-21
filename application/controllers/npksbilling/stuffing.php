<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class stuffing extends CI_Controller
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
		$this->load->model('npksbilling/request/stuffing_model');
		$this->load->library("esb_npks");
		$this->load->library("nusoap_lib");
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
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Request Stuffing";
		$this->common_loader($data, 'npksbilling/request/request_stuffing');
	}

	public function create_stuffing()
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Form Stuffing";
		$data['id'] = "";
		$data['docType'] = $this->stuffing_model->getDocType();
		$this->common_loader($data, 'npksbilling/request/create_stuffing');
	}

	public function getList($id_nota)
	{
		$data = $this->stuffing_model->getList($id_nota);
		echo $data;
	}

	public function save_stuff()
	{
		$json = $this->input->post('data');
		echo $data = $this->stuffing_model->save_stuff($json);
		//echo json_decode($data);
	}

	public function update($id)
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Form Stuffing";
		$data['id'] = $id;
		$data['docType'] = $this->stuffing_model->getDocType();
		$this->common_loader($data, 'npksbilling/request/create_stuffing');
	}

	public function update_stuff($id = null)
	{
		if ($id) {
			$data = $this->stuffing_model->update_stuff($id);
			echo $data;
		} else {
			$arr = array(
				"HEADER" => ""
			);
			echo json_encode($arr);
		}
	}

	public function view($id)
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "View Stuffing";
		$data['id'] = $id;
		$data['docType'] = $this->stuffing_model->getDocType();
		$this->common_loader($data, 'npksbilling/request/view_stuffing');
	}

	public function send($id, $id_nota, $branch_id, $branch_code)
	{
		$data = $this->stuffing_model->send($id, $id_nota, $branch_id, $branch_code);
		echo json_encode($data);
	}

	public function get_nota_id()
	{
		$data = $this->stuffing_model->get_nota_id();
		echo $data;
	}
}
