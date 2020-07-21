<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Customer_profile extends CI_Controller {

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
		$this->load->library('breadcrumbs');
//		$this->load->library("Nusoap_lib");
//		$this->load->library("table");
//		$this->load->library('commonlib');

		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
		$this->load->model('options_model');
		$this->load->model('analytics_model');
		$this->load->library('session');

		require_once(APPPATH.'libraries/htmLawed.php');

		$this->load->model('auth_model','auth_model');
		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {
			redirect(ROOT.'mainpage', 'refresh');
		}	
	}
	
	public function index($customer_id){
		return $this->customer_profile($customer_id);
	}
	
	//customer profile
	public function customer_profile($customer_id){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$data['register']=$this->customer_registration_model->read_customer($customer_id);
		$data['ceo'] 		= $this->customer_registration_model->read_ceo_by_customer_id($customer_id)->result("array");
		$data['bod'] = $this->customer_registration_model->view_list_bod($customer_id)->result("array");
		$data['am']=$this->customer_registration_model->read_am_all($customer_id);

		$data['customer_hq']=$this->customer_registration_model->read_customer_hq($customer_id);
		$data['customer_branch']=$this->customer_registration_model->read_customer_branch($customer_id);
		$data['customer_child']=$this->customer_registration_model->read_customer_child($customer_id);
			
		//generate month&year dropdown data
		$year_start = date("Y")-5;
		$month = array("","January","Februari","March","April","Mei","June","July","August","September","October","November","Desember");
		$data['opt_start_month'] = array();
		$data['opt_end_month'] = array();
		for($y=date("Y");$y>=$year_start;$y--)
		{
			for($i=12;$i>=1;$i--)
			{
				$data['opt_start_month']["$i-$y"] = $month[$i]." ".$y;
				$data['opt_end_month']["$i-$y"] = $month[$i]." ".$y;
			}
		}
		//set month&year default value
		$data["start_month"] = "1-".date("Y");
		if(date("m")>1)
			$data["end_month"] = (date("m")-1)."-".date("Y");
		else 
			$data["end_month"] = "01-".date("Y");
			
			
		if(date("m")>1)
		{
			$year = date("Y");
			$month = date("m")-1;
		}
		else 
		{
			$year = date("Y")-1;
			$month = 12;	
		}
			
		{//Revenue Per Jenis Layanan
			$graph_customer_id = array($customer_id);
			
			$result = $this->analytics_model->get_revenue_month_per_service($customer_id,$year,$month);
			
			//start revenue data section 
			$graph_datas = array();
			$total = 0;
			foreach($result as $rs)
			{
				$graph_data = array();
				$graph_data["service"] = $rs["SERVICE_TYPE"];
				$graph_data[$customer_id] = $rs["REVENUE"];
				$data["service_revenue"][$rs["SERVICE_TYPE"]]=$rs["REVENUE"];
				$total += $rs["REVENUE"];
				array_push($graph_datas, $graph_data);
			}
			
			//total
			{
				$graph_data = array();
				$graph_data["service"] = "Total";
				$graph_data[$customer_id] = $total;
				$data["service_revenue"]["Total"]=$total;
				array_push($graph_datas, $graph_data);
			}
			
			$graph_customer_name = array();
			foreach($graph_customer_id as $graph_customer_id_data)
			{
				array_push($graph_customer_name,$this->customer_registration_model->get_customer_name($graph_customer_id_data));
			}
			
			{
				array_push($graph_customer_name,"Total");
			}
			
			$graph_customer_key = $graph_customer_id;
			
			//graph data
			$data["graph_datas"] = json_encode($graph_datas, JSON_HEX_TAG);
			$data["y_keys"] = json_encode($graph_customer_key, JSON_HEX_TAG);
			$data["labels"] = json_encode($graph_customer_name, JSON_HEX_TAG);
			//end revenue data section
		}
		
		{//Revenue Per Lokasi
			$graph_customer_id = array($customer_id);
			
			$result = $this->analytics_model->get_revenue_month_per_location($customer_id,$year,$month);
			
			//start revenue data section 
			$graph_datas = array();
			$data["rev_loc"] = array();
			$total = 0;
			foreach($result as $rs)
			{
				$graph_data = array();
				$graph_data["location"] = $rs["LOCATION"];
				$graph_data[$customer_id] = $rs["REVENUE"];
				$data["location_revenue"][$rs["LOCATION"]]=$rs["REVENUE"];
				
				$total += $rs["REVENUE"];
				array_push($graph_datas, $graph_data);
			}
			
			//total
			{
				$graph_data = array();
				$graph_data["location"] = "Total";
				$graph_data[$customer_id] = $total;
				$data["location_revenue"]["Total"]=$total;
				array_push($graph_datas, $graph_data);
			}
			
			$graph_customer_name = array();
			foreach($graph_customer_id as $graph_customer_id_data)
			{
				array_push($graph_customer_name,$this->customer_registration_model->get_customer_name($graph_customer_id_data));
			}
			
			{
				array_push($graph_customer_name,"Total");
			}
			
			$graph_customer_key = $graph_customer_id;
			
			//graph data
			$data["graph_datas2"] = json_encode($graph_datas, JSON_HEX_TAG);
			$data["y_keys2"] = json_encode($graph_customer_key, JSON_HEX_TAG);
			$data["labels2"] = json_encode($graph_customer_name, JSON_HEX_TAG);
			//end revenue data section
		}		
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['action']= ROOT . "customer_profile/index/".$customer_id;

		$this->breadcrumbs->push("Company Profile", 'customer_profile/index/'.$customer_id);
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Company Profile";
		$this->common_loader($data,'pages/register/customer_profile');
	}
	
	public function search_revenue_n_throughput(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$customer_id = $_POST["customer_id"];
		$data['start_month'] = $start_month = $_POST["start_month"];
		$data['end_month'] = $end_month = $_POST["end_month"];
				
		$data['customer_hq']=$this->customer_registration_model->read_customer_hq($customer_id);
		$data['customer_branch']=$this->customer_registration_model->read_customer_branch($customer_id);
		$data['customer_child']=$this->customer_registration_model->read_customer_child($customer_id);
		
		$customer_profile = array();
		
		{
			$customer_profile_data = array();
			$customer_profile_data["HIRARKI"] = "";
			$customer_profile_data["THROUGHPUT"] = $this->analytics_model->get_throughput2($customer_id,'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["REVENUE"] = $this->analytics_model->get_revenue2($customer_id,'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["CUSTOMER_ID"] = $customer_id;
			$customer_profile_data["NAME"] = $this->customer_registration_model->get_customer_name($customer_id);
			
			array_push($customer_profile, $customer_profile_data);
		}

		if(count($data['customer_hq']) > 0 )
		{
			$customer_profile_data = array();
			$customer_profile_data["HIRARKI"] = "Headquarters";
			$customer_profile_data["THROUGHPUT"] = $this->analytics_model->get_throughput2($data['customer_hq']["CUSTOMER_ID"],'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["REVENUE"] = $this->analytics_model->get_revenue2($data['customer_hq']["CUSTOMER_ID"],'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["CUSTOMER_ID"] = $data['customer_hq']["CUSTOMER_ID"];
			$customer_profile_data["NAME"] = $data['customer_hq']["NAME"];
			
			array_push($customer_profile, $customer_profile_data);
		}
		
		foreach($data['customer_branch'] as $c)
		{
			$customer_profile_data = array();
			$customer_profile_data["HIRARKI"] = "Branch";
			$customer_profile_data["THROUGHPUT"] = $this->analytics_model->get_throughput2($c["CUSTOMER_ID"],'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["REVENUE"] = $this->analytics_model->get_revenue2($c["CUSTOMER_ID"],'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["CUSTOMER_ID"] = $c["CUSTOMER_ID"];
			$customer_profile_data["NAME"] = $c["NAME"];
			
			array_push($customer_profile, $customer_profile_data);
		}
		
		foreach($data['customer_child'] as $c)
		{
			$customer_profile_data = array();
			$customer_profile_data["HIRARKI"] = "Subsidiari";
			$customer_profile_data["THROUGHPUT"] = $this->analytics_model->get_throughput2($c["CUSTOMER_ID"],'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["REVENUE"] = $this->analytics_model->get_revenue2($c["CUSTOMER_ID"],'01-'.$start_month,'01-'.$end_month);
			$customer_profile_data["CUSTOMER_ID"] = $c["CUSTOMER_ID"];
			$customer_profile_data["NAME"] = $c["NAME"];
			
			array_push($customer_profile, $customer_profile_data);
		}

		$data['customer_profile'] = $customer_profile;
		$data['opt_chart_type']["line"] = "";
		
		$data['opt_chart_type']		= rsArrToOptArr($this->options_model->getOptions('CPCHARTTYPE','ID')->result('array'));
		$data['opt_data_type']		= rsArrToOptArr($this->options_model->getOptions('CPDATATYPE','ID')->result('array'));
		
		$this->load->view('pages/register/customer_profile_search_revnthr', $data);
	}	
	
	public function get_month_name($month)
	{
		switch($month)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
			default:
				return "test";
				break;
			
		}
	}
	public function generate_chart(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		//VAR_DUMP($_POST);
		
		$data['customer_hq']=$this->customer_registration_model->read_customer_hq($_POST['customer_id']);
		$data['customer_branch']=$this->customer_registration_model->read_customer_branch($_POST['customer_id']);
		$data['customer_child']=$this->customer_registration_model->read_customer_child($_POST['customer_id']);
		
		//graph data section
		{
			//initialize customer_id, start month & end month
			
			$graph_customer_id = $_POST['customer_id'];
			
			$data["show_cust"] = $show_cust = htmLawed($_POST['show_cust']);
			$data["show_cust_array"] = explode(",",$data["show_cust"]);
			
			if(in_array("hq",$data["show_cust_array"]))
			{
				$hq = true;
			}
			else
				$hq = false;			
			
			if(in_array("br",$data["show_cust_array"]))
			{
				$br = true;
			}
			else
				$br = false;			
			
			if(in_array("sb",$data["show_cust_array"]))
			{
				$sb = true;
			}
			else
				$sb = false;

			$data["start_month"] = $start_month = htmLawed($_POST['start_month']);

			$data["end_month"] = $end_month = htmLawed($_POST['end_month']);
			
			$start_month = explode("-",$start_month);//var_dump($start_month);
			$end_month = explode("-",$end_month);//var_dump($end_month);
			
			//start revenue data section 
			$graph_datas = array();
			$graph_year = array();
			$graph_year_label = array();
			
			for($i=1;$i<=12;$i++)
			{
				$graph_data = array();
				// $graph_data["month"] = $this->get_month_name($i);
				$graph_data["month"] = $this->get_month_name($i);
				
				for($y=$start_month[1];$y<=$end_month[1];$y++)
				{
					if( ($y==$start_month[1] && $i>=$start_month[0]) || ($y==$end_month[1] && $i<=$end_month[0]) || ($y!=$start_month[1] && $y!=$end_month[1]) )
					{
						$graph_data[$y] = $this->analytics_model->get_revenue($graph_customer_id,$y,$i);
						
						if($hq)
						{
							$graph_data[$y] += $this->analytics_model->get_revenue($data['customer_hq']['CUSTOMER_ID'],$y,$i);
						}
						
						if($br)
						{
							foreach($data['customer_branch'] as $cb)
								$graph_data[$y] += $this->analytics_model->get_revenue($cb['CUSTOMER_ID'],$y,$i);
						}
						
						if($sb)
						{
							foreach($data['customer_child'] as $cc)
								$graph_data[$y] += $this->analytics_model->get_revenue($cc['CUSTOMER_ID'],$y,$i);
						}						
						
						$data["value_per_month"]["$y-$i"] = $graph_data[$y];
					}
				}

				array_push($graph_datas, $graph_data);
			}
			
			for($y=$end_month[1];$y>=$start_month[1];$y--)
			{
				array_push($graph_year,"$y");
				array_push($graph_year_label,"Tahun ".$y);
			}			
			
			//graph data
			$data["graph_datas"] = json_encode($graph_datas, JSON_HEX_TAG);
			$data["y_keys"] = json_encode($graph_year, JSON_HEX_TAG);
			$data["labels"] = json_encode($graph_year_label, JSON_HEX_TAG);
			//end revenue data section		
		}
		
		$data["graph_year"] = $graph_year;
		
		$this->load->view('pages/register/customer_profile_generate_chart', $data);
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