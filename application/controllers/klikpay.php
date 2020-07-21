<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class klikpay extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
					
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
		// print_r($_POST["id_proforma"]);die();
		$no_proforma = $_POST["id_proforma"];
		if (count($no_proforma) > 0) {
		    /*Bedakan username dan password antara tpk, ptp dan pajang */
		    $noPrf = str_replace(".","",$no_proforma);
		    
		    $temp1 = substr($noPrf[0], 0, 6);
		    $temp2 = substr($noPrf[0], 0, 5);
		    
			$ptp = array('010011','010012','010013','010019');
			$ptp09 = array('95011','95012','95013','95019');
		    
			$tpkPriok = array('010811','010812','010813','010821','010822','010831','010816'); 
			$tpk09 = array('95811','95812','95813','95821','95822');
		    //$tpkLini2 = array('010831');//NB: masuk ke tpkpriok (ref: edo)
		    
		    $panjang = array('95020','95802');
		    $teluk_bayur = array('011805','010805','010030');
		    $jambi = array('010804','011804','010100');
		    //$palembang = array('95803');
		    //$pontianak = array('95806','925015','95015','915013','95015');
			$palembang = array('958031','95803','95040');
		    $pontianak = array('958061','925015','950151','915013','950151','95806');
		    $jict2 = array('010814');

		    if (in_array($temp1, $tpkPriok) || in_array($temp2, $tpk09)) {
		        $username = 'tpkpriok';
		        $password = 'tpkpriok';
		        $branch = '01';
		    } else if (in_array($temp2, $panjang)) { // panjang
		        $username = 'panjang';
		        $password = 'panjang';
		        $branch = '03';
			} else if (in_array($temp1, $teluk_bayur) || in_array($temp2, $teluk_bayur)) { // teluk bayur
		        $username = 'tlkbayur1';
		        $password = 'tlkbayur1';
		        $branch = '17';
		    } else if (in_array($temp1, $jambi) || in_array($temp2, $jambi)) { // jambi
		        $username = 'jambi1';
		        $password = 'jambi1';
		        $branch = '10';
			} else if (in_array($temp1, $palembang) || in_array($temp2, $palembang)) { // palembang
		        $username = 'plbg1';
		        $password = 'plbg1';
		        $branch = '15';
		    } else if (in_array($temp1, $pontianak) || in_array($temp2, $pontianak)) { // pontianak
		        $username = 'pntk1';
		        $password = 'pntk1';
		        $branch = '05';
		    } else if (in_array($temp1, $jict2) || in_array($temp2, $jict2)) { // pontianak
		        $username = 'jict1';
		        $password = 'jict1';
		        $branch = '05';
		    } else {
		        $username = 'ptp';
		        $password = 'ptp';
		        $branch = '01';
		    }
		    /*End of*/
		}
		
		$ok = $this->test_new_ipay($username,$password,$no_proforma); 
		injek($ok);
		

		
		$customer_bank_autocollection = $this->customer_registration_model->getCustomerBankAutocollectionByCustomerID($customerid,$branch);
		// print_r($customer_bank_autocollection);
		// die();
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
		// print_r($data);die();
		//echo IPAY_INQUIRY;				
		$IPAY_INQUIRY = "http://eservicetest.indonesiaport.co.id/wsdl/eServiceInquiry.wsdl";
		if(!$this->nusoap_lib->call_wsdl_via_file($IPAY_INQUIRY,"inquiry",$data,$result))
		{
			print_r($result);
			die;
		}
		else
		{
			return $result['response'];	
		}
	}
	
	public function encriptParam($source){
		return base64_encode(sha1($source));
		
	}
	
}