<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Dashboard_activity extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
		
		$this->load->model('auth_model','auth_model');
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
		//$data['data_term']=$this->container_model->getTerminalCancel();
		//$data['data_svc_ccl']=$this->container_model->getServiceCancel();

		$this->breadcrumbs->push("Summary Report", 'dashboard_activity/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Summary Report";
		$this->common_loader($data,'pages/billing/dashboard_activity');
	}

	public function get_customer_list()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		
		if (isset($_GET['term'])){
			echo json_encode(
				$this->customer_registration_model->find_customer(strtoupper($_GET['term']))
			);
		} else {
			echo json_encode(array());
		}
	}
	
	public function excelfiles($report_type,$port=false,$trx_date=false,$trx_date1=false,$customer=false,$custname=false) {

        $port = explode("-",$this->security->xss_clean(htmlentities($port)));
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<trx_date>$trx_date</trx_date>
				<trx_date1>$trx_date1</trx_date1>
				<customer>$customer</customer>
			</data>
		</root>";
		// print_r($report_type);
		// die();
		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,$report_type,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			// print_r($result);die();
			$obj = json_decode($result);
			$res['data'] = $obj->data->all_data;
		}
		
		//echo $res['data'];die;
		$res['trx_date'] = $trx_date;
		$res['trx_date1'] = $trx_date1;
		$res['custname'] = urldecode($custname);
		$res['terminal'] = $this->user_model->get_terminalName($port[0],$port[1]);
        // print_r($rest);
        // die();
		if ($report_type == 'getReportRequest') {
			$res['FILENAME']="Summary Report(Request) - $port[0]-$port[1] - $trx_date - $trx_date1";
			$this->load->view('rptexcel/excelfiles_request_report',$res);
		} else if ($report_type == 'getReportRevenue') {
			$res['FILENAME']="Summary Report(Revenue) - $port[0]-$port[1] - $trx_date - $trx_date1";
			$this->load->view('rptexcel/excelfiles_revenue_report',$res);
		} else if ($report_type == 'getReportTroughput') {
			$res['FILENAME']="Summary Report(Troughput) - $port[0]-$port[1] - $trx_date - $trx_date1";
			$this->load->view('rptexcel/excelfiles_troughput_report',$res);
		} else if ($report_type == 'getReportResponseTime') {
			$res['FILENAME']="Summary Report(Response) - $port[0]-$port[1] - $trx_date - $trx_date1";
			$this->load->view('rptexcel/excelfiles_response_time_report',$res);
		} else if ($report_type == 'getReportCustomerId') {
			$res['FILENAME']="Summary Report(Customer)";
			$this->load->view('rptexcel/excelfiles_customer_id_report',$res);
		} else if ($report_type == 'getReportResponseTimeRequest') {
			$res['FILENAME']="Summary Report(Response Request) - $port[0]-$port[1] - $trx_date - $trx_date1";
			$this->load->view('rptexcel/excelfiles_response_request_report',$res);
		} else {
			$res['FILENAME']="Summary Report(E-Care) - $trx_date - $trx_date1";
			$this->load->view('rptexcel/excelfiles_e_care_report',$res);
		}
    }

}
