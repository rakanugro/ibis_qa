<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class smartpay extends CI_Controller {

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
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

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
			
			$data['url'] = SMARTPAY."?user=004%2C123456&invoice=".$id_proforma;
		}
		
		$param = array(
			'USERNAME' => "IPC",
			'PASSWORD' => md5("IPCP@SS"),
			'NO_NOTA'  => $id_proforma,
			'REK_TUJUAN' => array(
				'KODE_BANK' => array("11010001","11010002"),
				'KODE_BANK_PARTNER' => array("102006","104006"),
				'NO_REKENING' => array('9080101561XXX','6420100030XXX'),
				'CURRENCY' => array('IDR','USD'),
				'ON_BEHALF' => array('PTP BNI IDR 888.600.2013','PTP Mandiri USD 120.00.4107201.3'),
				'BILLER_ID' => array('0001IPC','0002IPC'),
				'CORPORATE_ID' => array('GBLO001','GBLO002'),
				'SECURITY_ID' => array('PASS123','PASS456'),
				'PROVIDER_ID' => array('SMARTPAY','SMARTPAY'),
				'PARTNER_ID' => array('GALO001','GALO001'),
				'TOKEN_ID' => array('HERIJATI1','HERIJATI2'),
				'DEFAULT_ACCOUNT' => array('','Y')
				),
			'REK_ASAL' => array(
				'KODE_BANK' => array("11010001","11010002" ),
				'KODE_BANK_PARTNER' => array("102006","104006"),
				'NO_REKENING' => array('9080101561XXX','6420100030XXX'),
				'CURRENCY' => array('IDR','USD'),
				'ON_BEHALF' => array(' Consignee BNI IDR 888.600.2015',' Consignee Mandiri USD 120.00.4107201.5'),
				'BILLER_ID' => array('0001IPC','0002IPC'),
				'CORPORATE_ID' => array('GBLO001','GBLO002'),
				'SECURITY_ID' => array('PASS123','PASS456'),
				'PROVIDER_ID' => array('SMARTPAY','SMARTPAY'),
				'PARTNER_ID' => array('GALO001','GALO001'),
				'TOKEN_ID' => array('HERIJATI1','HERIJATI2'),
				'DEFAULT_ACCOUNT' => array('','Y')
				),
			'NO_HANDPHONE' => '085719008905'
		);
		
		$data['param'] = json_encode($param);

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Pembayaran dan Nota', 'container/payment');
		$this->breadcrumbs->push('Smarpay', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Setup Tarif';
		
		$this->common_loader($data,'epayment/smartpay');
		
	}
	
}