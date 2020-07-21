<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Mainpage extends CI_Controller {

	public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->model('user_model');
			$this->load->library("Nusoap_lib");
			$this->load->library("table");
			$this->load->helper('MY_language_helper');
			$this->load->model('dashboard_model');
			require_once(APPPATH.'libraries/htmLawed.php');


		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)) || !$this->session->userdata('uname_phd'))
			redirect(ROOT.'main', 'refresh');
	}

	private function isValid(){
		log_message('debug','>>> '.$this->session->userdata('group_phd').'---'.$this->uri->segment(1).'---'.$this->uri->segment(2));

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))redirect(ROOT.'main', 'refresh');
	}

	public function index(){
		//echo $this->uri->segment(1);
		//echo $this->uri->segment(2);
		//die;
		// print_r("expression");
		// die();
		//AP12
		$this->isValid();
		/*
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
			*/

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$dashboardata='';

		if($this->session->userdata('custid_phd')){
			$dashboardata=$this->dashboard_model->get_order_summary($this->session->userdata('custid_phd'));
		}

		$data["tot_order_all"] = $dashboardata["TOT_ORDER_ALL"];
		$data["tot_order_draft"] = $dashboardata["TOT_ORDER_DRAFT"];
		$data["tot_order_wait"] = $dashboardata["TOT_ORDER_WAIT"];
		$data["tot_order_save"] = $dashboardata["TOT_ORDER_SAVE"];
		$data["tot_order_reject"] = $dashboardata["TOT_ORDER_REJECT"];
		$data["tot_order_paid"] = $dashboardata["TOT_ORDER_PAID"];

		if($this->session->userdata('custid_phd')){
			$dashboardata=$this->dashboard_model->get_customer_basic_profile($this->session->userdata('custid_phd'));
		}

		if(isset($dashboardata["CUSTOMER_NAME"]))
		{
			$data["customer_name"] = $dashboardata["CUSTOMER_NAME"];
		}
		else
		{
			$data["customer_name"] = "";
		}
		log_message('debug','>>> 07');
		//var_dump($data);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/main', $data);
		$this->load->view('templates/footer', $data);
	}

	public function get_billing_summary()
	{	//AP12
		$this->isValid();

		$dashboardata=$this->dashboard_model->get_order_summary($this->session->userdata('custid_phd'));

		echo json_encode($dashboardata);
	}

	public function vessel_schedule($terminal){

		//AP12
		$this->isValid();

		//create table
		$this->table->set_heading("No", "Vessel", "Voyage", "Destination","Estimate Time Arrival","Estimate Time Departure","Open Stack","Clossing Time");

		$customer_id=$this->session->userdata('customerid_phd');
		$port			= explode("-",$terminal);

		//no error
		//port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		//terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(DASHBOARD,"getVesselSchedule",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->schedule)
			{
				for($i=0;$i<count($obj->data->schedule);$i++)
				{
					$this->table->add_row(
						$i+1,
						$obj->data->schedule[$i]->vessel,
						$obj->data->schedule[$i]->voyage_in." - ".$obj->data->schedule[$i]->voyage_out,
						$obj->data->schedule[$i]->port,
						$obj->data->schedule[$i]->eta,
						$obj->data->schedule[$i]->etd,
						$obj->data->schedule[$i]->open_stack,
						$obj->data->schedule[$i]->clossing_time
					);
				}
			}
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->load->view('pages/main/vessel_schedule', $data);
	}

	public function get_throughput(){

		//AP12
		$this->isValid();

		//no error
		// port code : IDJKT, IDPNK
		// terminal code :  T3I,T3D,T2D,T1D
		// port : port code-terminal code
		$port = isset($_POST['port']) ? htmLawed($_POST['port']) : "";
		$start_date = isset($_POST['start_date']) ? htmLawed($_POST['start_date']) : "";
		$end_date = isset($_POST['end_date']) ? htmLawed($_POST['end_date']) : "";

		$throughput = 0;
		$throughput_E=0;
		$throughput_I=0;
		$throughput_T=0;
		$portArr = explode(',', $port);

		foreach ($portArr as $port) {

			$rs = $this->dashboard_model->get_throughput($port, $start_date, $end_date);

			if($rs!="F")
			{
				$rs_arr = explode(',', $rs);

				$throughput_E += $rs_arr[0];
				$throughput_I += $rs_arr[1];
				$throughput_T += $rs_arr[2];
				//echo $rs;
			}
			else
			{
				//belum ada di stagging ibis, ambil langsung dari data tos
				$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<port>$port</port>
							<start_date>$start_date</start_date>
							<end_date>$end_date</end_date>
						</data>
					</root>";

				if(!$this->nusoap_lib->call_wsdl(DASHBOARD,"getThroughput",array("in_data" => "$in_data"),$result))
				{
					echo $result;
					die;
				}
				else
				{
					//echo $result;die;
					$obj = json_decode($result);

					if($obj->data->info[0]->teus)
					{
						//echo "ws:".$obj->data->info[0]->teus;
						$teusarr = explode(',', $obj->data->info[0]->teus);
						$teuse = $teusarr[0]=="" ? 0 : $teusarr[0];
						$teusi = $teusarr[1]=="" ? 0 : $teusarr[1];
						$teust = $teusarr[2]=="" ? 0 : $teusarr[2];

						$throughput_E += $teuse;
						$throughput_I += $teusi;
						$throughput_T += $teust;

						$this->dashboard_model->set_throughput($port, $start_date, $end_date, "E", $teuse);
						$this->dashboard_model->set_throughput($port, $start_date, $end_date, "I", $teusi);
						$this->dashboard_model->set_throughput($port, $start_date, $end_date, "T", $teust);
					}
					else
					{
						//echo 0;
						$throughput_E = 0;
						$throughput_I = 0;
						$throughput_T = 0;
						$this->dashboard_model->set_throughput($port, $start_date, $end_date, "E", 0);
						$this->dashboard_model->set_throughput($port, $start_date, $end_date, "I", 0);
						$this->dashboard_model->set_throughput($port, $start_date, $end_date, "T", 0);
					}
				}
			}
		}

		echo $throughput_E.",".$throughput_I.",".$throughput_T;
	}

	public function get_vessel_waiting_time(){

		//AP12
		$this->isValid();

		//no error
		//port code : IDJKT, IDPNK
		//terminal code :  T3I,T3D,T2D,T1D
		//port : port code-terminal code
		$port = isset($_POST['port']) ? htmLawed($_POST['port']) : "";
		$start_date = isset($_POST['start_date']) ? htmLawed($_POST['start_date']) : "";
		$end_date = isset($_POST['end_date']) ? htmLawed($_POST['end_date']) : "";

		$throughput = 0;
		$portArr = explode(',', $port);

		foreach ($portArr as $port) {

			$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port>$port</port>
						<start_date>$start_date</start_date>
						<end_date>$end_date</end_date>
					</data>
				</root>";

			if(!$this->nusoap_lib->call_wsdl(DASHBOARD,"getVesselWaitingTime",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				echo $result;
				//$obj = json_decode($result);

				//var_dump($obj);

				/*if($obj->data->info[0]->teus)
				{
					//echo $obj->data->info[0]->teus;
					$throughput += $obj->data->info[0]->teus;
					$this->dashboard_model->set_throughput($port, $start_date, $end_date, $trans_type, $obj->data->info[0]->teus);
				}
				else
				{
					//echo 0;
					$throughput += 0;
					$this->dashboard_model->set_throughput($port, $start_date, $end_date, $trans_type, 0);
				}*/
			}
		}

		//echo $throughput;
	}

}
