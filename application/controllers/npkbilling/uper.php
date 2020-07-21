<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class uper extends CI_Controller {
		
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
			$this->load->model('npkbilling/billing_management/uper_model');
			$this->load->model('npkbilling/master/mdm_model');
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
			$data['title']= "Uper";
			$this->common_loader($data,'npkbilling/billing_management/uper.php');
		}

		public function view_uper($uper_id)
		{
			$this->redirect();
			// $dataUper = $this->uper_model->getDataUper($uper_id);

			$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
			$data['title']= "View Detail Uper";
			$data['data']= $uper_id;
			$data['nota']= $uper_id;
			$this->common_loader($data,'npkbilling/billing_management/view_uper.php');
		}

		public function form_uper($uper_id)
		{
			$this->redirect();
			$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
			$data['title']= "Form Confirmation Uper";
			$data['data']= $uper_id;
			$this->common_loader($data,'npkbilling/billing_management/form_uper.php');
		}

		public function getListUper()
		{
			$data = $this->uper_model->getListUper();
			echo json_decode($data);
		}

		public function getDataUper()
		{	
			$uper_id = $_GET['uper_id'];
			$data = $this->uper_model->getDataUper($uper_id);
			echo json_decode($data);
		}

		public function getGroupTariffId()
		{
			$nota_id = $_GET['nota_id'];
			$category = $_GET['category'];
			$terminal =  $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
			$data = $this->uper_model->getGroupTariffId($nota_id, $category, $terminal);
			echo json_decode($data);
		}

		public function onLoadTariff()
		{
			$where = $_GET['where'];
			$whereIn = $_GET['whereIn'];
			$data = $this->uper_model->onLoadTariff($where, $whereIn);
			echo json_decode($data);
		}

		public function getListPaymentMethod ()
		{	
			$data = $this->uper_model->getListPaymentMethod();
			echo json_decode($data);
		}

		public function getListBank()
		{	
			$uper_id = $this->uri->segment(7);
			$data = $this->uper_model->getListBank();
			echo json_decode($data);
		}

		public function confirm_uper() {
			$data = $this->uper_model->confirm_uper();
			echo $data;
		}
	}
 ?>