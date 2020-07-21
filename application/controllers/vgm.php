<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class vgm extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
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
		//$this->load->view('templates/top-2-title-nosearch', $data);//biar bagusan dikit tampilannya
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

		$data['url'] = VGM;
		
		injek($data['url']);
		
		$this->breadcrumbs->push('VGM', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'VGM';		

		$this->common_loader($data,'pages/vgm/vgm');
	}
	
	function test_new_ipay($username, $password, $proforma)
	{
		$data = array("username" => $username,"password" => $password,"proforma" => $proforma);
		//var_dump($data);exit;
		//echo IPAY_INQUIRY;
		if(!$this->nusoap_lib->call_wsdl_via_file(IPAY_INQUIRY,"inquiry",$data,$result))
		{
			print_r($result);
			die;
		}
		else
		{
			//print_r($result);
			return $result['response'];
		}
	}
	
	public function encriptParam($source){
		return base64_encode(sha1($source));
		
	}
	
}