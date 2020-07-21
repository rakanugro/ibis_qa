<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {	

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		$this->load->model("user_model");
			
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			redirect(ROOT.'mainpage', 'refresh');
		
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
		
	}	

	public function index(){
	
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		
		if ($this->session->userdata('group_phd') == 1){
			echo 'under construction';
		}
		else{
			echo "you don't have admin clearance, gtfo";
			//redirect(ROOT.'main', 'refresh');
		}		
	}	
	
}