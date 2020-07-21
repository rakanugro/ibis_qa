<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class receivebarang extends CI_Controller
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
		$this->load->model('npksbilling/request/receivebarang_model');
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
		$data['title'] = "Request Receiving Barang";
		$this->common_loader($data, 'npksbilling/request/request_receivebarang');
	}

	public function create_receivebarang()
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Form Receiving Barang";
		$data['id'] = "";
		$data['docType'] = $this->receivebarang_model->getDocType();
		$this->common_loader($data, 'npksbilling/request/create_receivebarang');
	}

	public function getList()
	{
		$data = $this->receivebarang_model->getList();
		echo $data;
	}

	public function save_rec()
	{
		$json = $this->input->post('data');
		echo $data = $this->receivebarang_model->save_rec($json);
		//echo json_decode($data);
	}

	public function update($id)
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Form Receiving Barang";
		$data['id'] = $id;
		$data['docType'] = $this->receivebarang_model->getDocType();
		$this->common_loader($data, 'npksbilling/request/create_receivebarang');
	}

	public function update_rec($id = null)
	{
		if ($id) {
			$data = $this->receivebarang_model->update_rec($id);
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
		$data['title'] = "View Receiving Barang";
		$data['id'] = $id;
		$data['docType'] = $this->receivebarang_model->getDocType();
		$this->common_loader($data, 'npksbilling/request/view_receivebarang');
	}

	public function send($id, $branch_id, $branch_code)
	{
		$data = $this->receivebarang_model->send($id, $branch_id, $branch_code);
		echo json_encode($data);
	}
}
