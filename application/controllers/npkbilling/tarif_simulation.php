<?php 
	class tarif_simulation extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('upload');
			$this->load->model('user_model');
			$this->load->model('npkbilling/billing_management/tarif_simulation_model');
			$this->load->model('npkbilling/master/mdm_model');
			$this->load->model('container_model');
			$this->load->library("Nusoap_lib");
			$this->load->library("sendcurl_lib");
			$this->load->library('table');
			$this->load->library('breadcrumbs');
			$this->load->helper('MY_language_helper');
			$this->load->library('session');
			$this->load->model('auth_model','auth_model');
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

			$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));
			
			$data['booking_type'] 	= $this->tarif_simulation_model->get_booking_type();
			//$data['terminal'] 		= $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
			$data['pbm'] 			= $this->tarif_simulation_model->get_pbm();
			$data['trade_type'] 	= $this->tarif_simulation_model->get_trade_type();
			$data['package'] 		= $this->tarif_simulation_model->get_package();
			$data['tipe_kegiatan'] 	= $this->tarif_simulation_model->get_tipe_kegiatan();
			// $data['truck_losing'] 	= $this->tarif_simulation_model->get_truck_losing();
			$data['size'] 			= $this->tarif_simulation_model->get_size();
			$data['tipe'] 			= $this->tarif_simulation_model->get_tipe();
			$data['status'] 		= $this->tarif_simulation_model->get_status();
			$data['satuan'] 		= $this->tarif_simulation_model->get_satuan();
			$data['sifat']	 		= $this->tarif_simulation_model->get_sifat();
			$data['alat']	 		= $this->tarif_simulation_model->get_alat();

			$data['title']= "Billing Management";

			$this->common_loader($data,'npkbilling/billing_management/create_tarif.php');
		}

		public function get_commodity() {
			$package_id = $this->input->post('package_id');
			
			$data = $this->tarif_simulation_model->get_commodity($package_id);
			echo json_encode($data);
		}

		public function layanan_alat()
		{
			$terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
			$data = $this->tarif_simulation_model->layanan_alat($terminal);
			echo json_encode($data);
		}

		public function stacking_area()
		{
			$data = $this->tarif_simulation_model->stacking_area();
			echo json_encode($data);
		}

		public function get_tarif_simulation() {
			$jsonData = $this->input->post('data');
			// print_r($jsonData);die;
			echo $jsonData = $this->tarif_simulation_model->get_tarif_simulation($jsonData);
		}
	}
 ?>