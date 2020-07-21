<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class ipaylog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->library('session');
		
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
			
		$this->load->model('auth_model','auth_model');
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

	public function index(){
		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['url'] = IPAY_LOG;
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Payment Log', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Payment Log';

		$this->common_loader($data,'pages/epayment/ipaylog');
			
	}
	
}