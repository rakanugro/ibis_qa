<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class invoice extends CI_Controller
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
		$this->load->model('npksbilling/billing_management/invoice_model');
		$this->load->library('esb_npks');
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

		$data['title'] = "Billing Management Invoice";

		$this->common_loader($data, 'npksbilling/billing_management_npks/invoice');
	}

	public function getListInvoice()
	{
		$data = $this->invoice_model->getListInvoice();
		echo json_decode($data);
	}

	function getdatacetak()
	{
		$kode = "billingedii";
		$no = $this->input->get('vnota');
		$enc_trx_number = $this->mx_encryption->encrypt($no);

		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			if ($kode == 'billingedii') {
				redirect("http://eserviceqa.indonesiaport.co.id/index.php/einvoice/nota/cetak_barang/barang/" . $enc_trx_number, 'refresh');
			}
		} else {
			echo "failed";
		}
	}
}
