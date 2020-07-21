<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Invoice_daily extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function redirect(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
	}

	public function index(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['data_term']=$this->container_model->getTerminalCancel();
		$data['data_svc_ccl']=$this->container_model->getServiceCancel();

		$this->breadcrumbs->push("Invoice Daily Report", 'invoice_daily/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Invoice Daily Report";
		$is_shipping=$this->master_model->cek_shippingline();
		if($is_shipping=='N'){
			$data['messages']= "This menu for Shipping Agent Customer Category only";
		}
		else {
			$data['messages']= "Ok";
    }
		$this->common_loader($data,'pages/billing/invoice_daily');
	}

	public function excelfiles($port,$service,$trx_date,$file) {

        $port = explode("-",$this->security->xss_clean(htmlentities($port)));
		$custid=$this->session->userdata('custid_phd');
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<service>".$service."</service>
				<trx_date>$trx_date</trx_date>
				<custid>$custid</custid>
			</data>
		</root>";
        // echo $in_data;die;

		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getInvoiceDaily",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;die;
			$obj = json_decode($result);
			$res['data'] = $obj->data->invoice;
		}
		//echo $res['data'];die;
		$res['terminal'] = $this->user_model->get_terminalName($port[0],$port[1]);
        $res['FILENAME']="Invoice Daily Report - $port[0]-$port[1] - $service - $trx_date";
        $this->load->view('rptexcel/excelfiles_invoice_daily_report',$res);

    }
	
	public function finance(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['data_term']=$this->container_model->getTerminalCancel();
		$data['data_svc_ccl']=$this->container_model->getServiceCancel();

		$this->breadcrumbs->push("Invoice Daily Report", 'invoice_daily/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Invoice Daily Report";
		$data['messages']= "Ok";
		
		$this->common_loader($data,'pages/billing/invoice_daily_finance');
	}	
	
	public function excelfilesfinance($port,$service,$trx_date,$file) {

        $port = explode("-",$this->security->xss_clean(htmlentities($port)));
		$custid=$this->session->userdata('custid_phd');
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<service>".$service."</service>
				<trx_date>$trx_date</trx_date>
				<custid>$custid</custid>
			</data>
		</root>";
        //echo $in_data;die;


		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getInvoiceDailyFinance",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			$res['data'] = $obj->data->invoice;
		}
		//echo $res['data'];die;
		$res['terminal'] = $this->user_model->get_terminalName($port[0],$port[1]);
        $res['FILENAME']="Invoice Daily Report - $port[0]-$port[1] - $service - $trx_date";
		
		switch($service)
		{
			case "PTKM00":
				$res['service'] = "Receiving";
			break;
			case "PTKM01":
				$res['service'] = "Delivery";
			break;
			case "PTKM07":
				$res['service'] = "Perpanjangan Delivery";
			break;
			case "PTKM08":
				$res['service'] = "Loading Cancel";
			break;			
		}
		
        $this->load->view('rptexcel/excelfiles_invoice_daily_report_finance',$res);

    }	

}
