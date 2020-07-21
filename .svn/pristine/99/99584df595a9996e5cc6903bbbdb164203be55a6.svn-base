<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class klikpay extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
					
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
		//redirect(ROOT.'mainpage', 'refresh');
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
		//$this->redirect();
		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$customerid = $this->session->userdata('customerid_phd');
		injek($customerid);
		
		if(isset($_POST["id"]))
			$id_proforma = $_POST["id"];
		else 
		{
			//multipayment
			$id_proforma="";
			foreach($_POST["id_proforma"] as $value){
				if($id_proforma!="") $id_proforma .= ",";
				$id_proforma .= $value;
			}
			
			$data['url'] = IPAY."?user=004,123456,123456&invoice=".$id_proforma;
		}
		
		injek($id_proforma);
		$data['url'] = IPAY."?user=004,123456,$customerid&invoice=".$id_proforma;	
		injek($data['url']);		
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		//injek($data['menu_list']);
		
		$this->breadcrumbs->push('Klikpay', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Klikpay';		

		$this->common_loader($data,'pages/epayment/klikpay');
	}
	
}