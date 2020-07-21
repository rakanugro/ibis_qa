<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Analytics extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
//		$this->load->helper('my_view_helper');
		$this->load->helper('my_options_helper');
//		$this->load->helper('my_format_helper');
//		$this->load->helper('my_autocomplete_helper');
//		$this->load->helper('my_notification_helper');
//		$this->load->helper('MY_language_helper');

//		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('breadcrumbs');
//		$this->load->library("Nusoap_lib");
		$this->load->library("table");
//		$this->load->library('commonlib');

		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
		$this->load->model('options_model');
		$this->load->model('analytics_model');

		require_once(APPPATH.'libraries/htmLawed.php');

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {
			redirect(ROOT.'mainpage', 'refresh');
		}	
	}
	
	public function customer_rank(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['action']= ROOT . "analytics/customer_rank/";

		//generate month&year dropdown data
		$year_start = date("Y")-5;
		$month = array("","January","Februari","March","April","Mei","June","July","August","September","October","November","Desember");
		$data['opt_start_month'] = array();
		$data['opt_end_month'] = array();
		for($y=date("Y");$y>=$year_start;$y--){
			for($i=12;$i>=1;$i--){
				$data['opt_start_month']["$i-$y"] = $month[$i]." ".$y;
				$data['opt_end_month']["$i-$y"] = $month[$i]." ".$y;
			}
		}
			
		$data['opt_sort_by']	= rsArrToOptArr(	$this->options_model->getOptions('CSRANK_SORT_BY','ID')->result('array')	);
		$data['opt_branch']		= rsArrToOptArr(	$this->options_model->getOptions('CSRANK_BRANCH','ID')->result('array')	);
		$data['opt_showtop']		= rsArrToOptArr(	$this->options_model->getOptions('CSRANK_SHOWTOP','ID')->result('array')	);
		$data['opt_service_type']		= rsArrToOptArr( $this->options_model->getOptions('SERVICETYPE','ID')->result('array')	 );
		
		$opt1	= array('ALL' => 'All');
		$opt2	= rsArrToOptArr(	$this->options_model->getOptions('CUSTOMERTYPE','ID')->result('array')	);
		$data['opt_custtype'] = array_merge($opt1, $opt2);
		//var_dump($data['opt_custtype']);die;
	
		$rankdata 		= $this->get_rank_data($_POST);
		$data 			= array_merge($data, $rankdata['data']);
		$this->table 	= $rankdata['table'];
		
		$this->breadcrumbs->push("Data Analytics", 'analytics/customer_rank');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Data Analytics";
		$this->common_loader($data,'pages/register/customer_rank');
	}
	
	public function get_rank_data($_postarr){

		$data['sort_by'] = $_postarr['sort_by'];
		$data['branch'] = $_postarr['branch'];
		$data['custtype'] = $_postarr['customer_type'];
		$data['service_type'] = $_postarr['service_type'];
		$data['showtop'] = $_postarr['show_top'];
		
		$data_table = array();
		
		$table = $this->table;
		
		$table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>Customer ID</th>",
		  "<th width='100px'>Nama Perusahaan</th>",
		  "<th width='100px'>Transaction Branch</th>",
		  "<th width='100px'>Throughput (TEUS)</th>",
		  "<th width='100px'>Revenue (IDR)</th>"
		);
		
		if($_postarr['start_month']!=""&&$_postarr['end_month']!=""){
			$customer_ranked = $this->analytics_model->get_customer_rank($_postarr['start_month'],$_postarr['end_month'],$_postarr['sort_by'],$_postarr['branch'],$_postarr['customer_type'],$_postarr['service_type'],$data['showtop']);
			
			$i=1;
			foreach($customer_ranked as $csr){
				$name = $csr['NAME'];
				if($name==""){
					$name = "(BELUM TERDAFTAR DI CDM/PERLU MERGE)";
				}
				$table->add_row(
							$i,
							$csr['CUSTOMER_ID'],
							$name,
							$csr['REGISTRATION_BRANCH'],
							number_format($csr['THROUGHPUT'], 0, ',', '.'),
							number_format($csr['REVENUE'], 0, ',', '.')
				);
				
				
				$data_table[] = array (	'NO' => $i,
										'ID' => "'".$csr['CUSTOMER_ID'],
										'NAME' => "'".$name,
										'BRANCH' => "'".$csr['REGISTRATION_BRANCH'],
										'TRGH' => "'".$csr['THROUGHPUT'],
										'REV' => "'".$csr['REVENUE']
								);
				$i++;
			}
		}
		
		if(isset($_postarr['start_month'])){
			$data["start_month"] = $start_month = htmLawed($_postarr['start_month']);
		}
		else{
			$data["start_month"] = $start_month = "1-".date("Y");
		}
		
		if(isset($_postarr['start_month'])){
			$data["end_month"] = $end_month = htmLawed($_postarr['end_month']);
		}
		else{
			$data["end_month"] = $end_month = (date("m")-1)."-".date("Y");
		}
			
		return array('data' => $data, 'table' => $table , 'data_table' => $data_table);
	}
	
	
	public function customer_rank_excel(){
		//error_reporting(E_ALL);
		//echo "o hi, post data:";
		//var_dump($_POST);die;
		foreach ($_POST as $i => $p){
			$data[$i] = $p;			
		}

		$rankdata 			= $this->get_rank_data($_POST);
		$data 				= array_merge($data, $rankdata['data']);
		$data['data_table']	= $rankdata['data_table'];
		
		$data['filename'] = 'Customer_Rank_Report_'.date('Y.m.d_H.i.s');
		
		$data = array_merge($data, $this->get_rank_data($_POST));
		//var_dump($data);
		
		$this->load->view('rptexcel/customer_rank_excel', $data);
	}


	
	
	public function common_loader($data,$views,$back=null){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/register/top-1-breadcrumb', $data);
		$this->load->view('pages/register/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		if ($back){$this->load->view('pages/register/gotoindex', $data);}
		$this->load->view('pages/register/bottom-2-closing');
		$this->load->view('pages/register/bottom-1-closing');
		$this->load->view('templates/footer', $data);
	}	
}	