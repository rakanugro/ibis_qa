<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('api_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		
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

	public function index(){
		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
			
		//create table
		$this->table->set_heading('API', 'HEALTH CHECK', 'MESSAGE', 'LAST HEALTH CHECK', 'CONNECTION TIME');

		$api_list = $this->api_model->get_apiList();

		foreach($api_list as $api)
		{
			if($api["HEALTH_CHECK"]=='S')
			{
				$cell1 = array('data' => $api["API_NAME"]);
				$cell2 = array('data' => $api["HEALTH_CHECK"]);
				$cell3 = array('data' => $api["MESSAGE"]);
				$cell4 = array('data' => $api["LAST_HEALTH_CHECK"]);
				$cell5 = array('data' => $api["CONNECTION_TIME"]);
			}
			else 
			{
				$cell1 = array('data' => $api["API_NAME"], 'class' => 'danger');
				$cell2 = array('data' => $api["HEALTH_CHECK"], 'class' => 'danger');
				$cell3 = array('data' => $api["MESSAGE"], 'class' => 'danger');
				$cell4 = array('data' => $api["LAST_HEALTH_CHECK"], 'class' => 'danger');
				$cell5 = array('data' => $api["CONNECTION_TIME"], 'class' => 'danger');
			}
			
			$this->table->add_row(
							$cell1,
							$cell2,
							$cell3,
							$cell4,
							$cell5
						);
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('API HEALTH CHECK', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'API';
		
		$this->common_loader($data,'pages/api');		
	}
}