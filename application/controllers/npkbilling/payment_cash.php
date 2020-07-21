<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class payment_cash extends CI_Controller {

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
		$this->load->model('npkbilling/billing_management/payment_cash_model');
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

	public function index() 
	{
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title']= "Payment";
		$this->common_loader($data,'npkbilling/billing_management/payment_cash');	
	}

	public function view_payment_cash($id) 
	{	
		list($id_data, $type_data) = explode('-', $id);
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Form Payment";
		$terminal =  $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['terminal'] =  $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['bank'] = $this->payment_cash_model->getBankList($terminal);
		if($type_data == 'nota'){
			$data['detail_payment'] = $this->payment_cash_model->detail_payment_nota($id_data); 
		}else{
			$data['detail_payment'] = $this->payment_cash_model->detail_payment_uper($id_data); 
		}
		
		$data['type_data'] = $type_data;
		$this->common_loader($data,'npkbilling/billing_management/view_payment_cash');
	}

	public function getListPaymentCash()
	{
		$data['NotaList'] = $this->payment_cash_model->getListNota();
		$data['UperList'] = $this->payment_cash_model->getListUper();
		echo json_encode($data);
		die();
	}

	public function save_payment_cash(){
		$json = $this->input->post('data');
		echo $data = $this->payment_cash_model->save_payment_cash($json);
		die();
	}

}
	