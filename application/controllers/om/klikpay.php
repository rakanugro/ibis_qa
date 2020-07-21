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
		
		//$customerid = $this->session->userdata('customerid_phd');
		//injek($customerid);
		
		$no_proforma = $_POST["id_proforma"];
		$no_proforma_only = array();
		if (count($no_proforma) > 0) {
			
			foreach($no_proforma as $no_prf)
			{
				$explode = explode(",",$no_prf);
				array_push($no_proforma_only,$explode[0]);
			}
			
			$temp1 = substr($no_proforma[0], 0, 6);
			$temp2 = substr($no_proforma[0], 0, 5);
			$temp3 = substr($no_proforma[0], 0, 2);
			
			if ($temp1 == "010011" || $temp1 == "010012" || $temp1 == "010013" || $temp1 == "010019" || $temp2 == "95011") {//ptp
				$username = 'ptp';
				$password = 'ptp';
				$branch = '01';
			} else if ($temp2 == "95020") {//panjang
				$username = 'panjang';
				$password = 'panjang';
				$branch = '03';
			} 
			else if ($temp3 == "20") {//banten
				$username = 'banten';
				$password = 'banten';
				$branch = '12';
			}
			else {
				$username = 'ptp';
				$password = 'ptp';
				$branch = '01';
			}
			
			//ambil customerid
			$explode = explode(",",$no_proforma[0]);
			$customerid = $explode[1];
			
			//print_r ($explode[0]);
			//die();
			
		}
		
		$ok = $this->test_new_ipay($username,$password,$no_proforma_only); 
		
		$customer_bank_autocollection = $this->customer_registration_model->getCustomerBankAutocollectionByCustomerID($customerid,$branch);
		
		injek($ok);
		
		/* echo "test"."<br>";
		echo $customerid."<br>";
		echo $branch."<br>";
		echo $customer_bank_autocollection."<br>";
		die; */
		
		$no_rek = $customer_bank_autocollection["ACCOUNT_NO"];
		$kode_bank = $customer_bank_autocollection["BANK_ID"];
		
		//add security encription
		//SeIPel2 is default key for e-service to ilcs EBPP
		$key = 'SeIPel2';
		$signature = $key.'ebpp_01'.$username.$password.$no_rek.$kode_bank.$customerid.$ok;
		$signature2 = $this->encriptParam($signature);
		//add new parameter key
		//$data['url'] = IPAY_NEW.'?app_id=ebpp_01&user=ptp&pass=ptp&pcode='.$ok;
		//$data['url'] = IPAY_NEW.'?app_id=ebpp_01&user=ptp&pass=ptp&pcode='.$ok.'&key='.$signature2;
		$data['url'] = IPAY_NEW.'?app_id=ebpp_01&user='.$username.'&pass='.$password.'&pcode='.$ok.'&key='.$signature2.'&no_rek='.$no_rek.'&kode_bank='.$kode_bank.'&cust_id='.$customerid;
		
		injek($data['url']);
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		//injek($data['menu_list']);
		
		$this->breadcrumbs->push('Klikpay', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Klikpay';		

		$this->common_loader($data,'pages/epayment/klikpay');
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