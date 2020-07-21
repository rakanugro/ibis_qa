<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class proforma extends CI_Controller {
		
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
			$this->load->model('npkbilling/billing_management/proforma_model');
			$this->load->library("nusoap_lib");
			$this->load->library("sendcurl_lib");
			$this->load->library("table");
			$this->load->library('commonlib');
			$this->load->library('ciqrcode');
			$this->load->helper('MY_language_helper');
			$this->load->library('MX_Encryption');
			$this->load->library('xml2array');
			
			require_once(APPPATH.'libraries/mime_type_lib.php');
	        require_once(APPPATH.'libraries/htmLawed.php');
		}

		public function common_loader($data,$views) 
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
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
		}


		public function index()
		{
			$this->redirect();
			$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
			$data['title']= "Proforma";
			$this->common_loader($data,'npkbilling/billing_management/proforma.php');
		}

		public function getListProforma()
		{
			$data = $this->proforma_model->getListProforma();
			echo json_decode($data);
		}


		public function approve_proforma(){
			$action = $this->input->post("action");
			$nota_id = $this->input->post("id");
			$data = $this->proforma_model->approve_proforma($action, $nota_id);
			echo json_decode($data);
		}

		public function reject_proforma(){
			$action = $this->input->post("action");
			$nota_real_no = $this->input->post("req_no");
			$proforma_no = $this->input->post("proforma_no");
			$file = json_encode($_POST['file']);

			// print_r($file);die;
			$data = $this->proforma_model->reject_proforma($action, $nota_real_no, $proforma_no, $file);
			echo json_decode($data);
		}
	}
 ?>