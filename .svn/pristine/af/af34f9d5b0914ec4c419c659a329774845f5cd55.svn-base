<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Upload_npe_receiving extends CI_Controller {	

	public function __construct(){
                parent::__construct();
                $this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
				$this->load->library('session');
                $this->load->model('user_model');
                $this->load->model('container_model');
				$this->load->library("Nusoap_lib");
				$this->load->library('table');
                $this->load->helper('MY_language_helper'); 
                
        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
			
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function index(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		/*Wajib*/
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/container/upload_npe_receiving');
		$this->load->view('templates/footer', $data);
		/*Wajib*/
	}

}