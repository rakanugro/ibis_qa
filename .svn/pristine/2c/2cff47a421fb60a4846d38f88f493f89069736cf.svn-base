<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Billing extends CI_Controller {	

	public function __construct(){
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->helper('form'); 
		$this->load->library('form_validation'); 
		$this->load->model('user_model');
		$this->load->model('billing_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		if (! $this->session->userdata('is_login') ){
		 	redirect('main_invoice');
		}
		
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
			
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function simulation_tarif(){
	
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		//create table
		$this->table->set_heading("PID",
								  "REF",
								  "TARIF VALUE",
								  "LHVAL1",
								  "LHVAL2",
								  "LHVAL3",
								  "LHVAL4",
								  "LHVAL5",
								  "LHVAL6",
								  "LDVAL1",
								  "LDVAL2"
								 );
		
		$tarif_list=$this->billing_model->getTarif();
		
		foreach($tarif_list as $tarif)
		{
			$this->table->add_row(	$tarif["PLAN_ID"],
									$tarif["REF"],
									$tarif["VALUE"],
									$tarif["LHVAL1_"].$tarif["HVAL1_"],
									$tarif["LHVAL2_"].$tarif["HVAL2_"],
									$tarif["LHVAL3_"].$tarif["HVAL3_"],
									$tarif["LHVAL4_"].$tarif["HVAL4_"],
									$tarif["LHVAL5_"].$tarif["HVAL5_"],
									$tarif["LHVAL6_"].$tarif["HVAL6_"],
									$tarif["LDVAL1_"].$tarif["DVAL1_"],
									$tarif["LDVAL2_"].$tarif["DVAL2_"]
							);
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Setup Tarif', '/');
		$this->breadcrumbs->unshift('Setup', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Setup Tarif';
		
		$this->common_loader($data,'billing/tarif');
	}	
}