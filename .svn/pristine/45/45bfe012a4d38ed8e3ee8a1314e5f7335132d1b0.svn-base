<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Cont_inbout extends CI_Controller {

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

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

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
		$data['data_term']=$this->container_model->getTerminalCancel();
		$data['data_svc_ccl']=$this->container_model->getServiceCancel();

		$this->breadcrumbs->push("Inbound Outbound", 'inbound_outbound/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Inbound Outbound";
		$is_shipping=$this->master_model->cek_shippingline();
		//if($is_shipping=='N'){
		if(0){//ada yang minta bukain menu untuk pbm tertentu -- dibuka dulu validasinya
			$data['messages']= "This menu for Shipping Agent Customer Category only";
		}
		else
			$data['messages']= "Ok";

		$this->common_loader($data,'pages/container/inbound_outbound');
	}

	public function excelfiles() {
		$port = $_GET['port'];
		$ves = $_GET['ves'];
		$voyin = $_GET['voyin'];
		$voyout = $_GET['voyout'];
		$act = $_GET['act'];
		$npe = $_GET['npe'];
		
        $port = explode("-",$this->security->xss_clean(htmlentities($port)));
		if($act=='INBOUND')
		{
			$ei="I";
		}
		else
		{
			$ei="E";
		}
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$ves</vessel_name>
				<voyin>$voyin</voyin>
				<voyout>$voyout</voyout>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<ei>".$ei."</ei>
				<npe>".$npe."</npe>
			</data>
		</root>";


		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getListContainerInbound",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			$res['data'] = $obj->data->vessel;
		}
		//echo $res['data'];die;
        $res['TYPE']=$ei;
        $res['FILENAME']='Report-'.$ei.'-'.$ves.'-'.$voyin;
        $res['ACTION']=$act;
        $this->load->view('rptexcel/excelfiles',$res);

    }
	
	public function search_tb_svcccl($search="")
	{
		$port = explode("-",$this->security->xss_clean(htmlentities(htmLawed($_POST['port']))));
		$ves=htmLawed($_POST['ves']);
		$voyin=htmLawed($_POST['voyin']);
		$voyout=htmLawed($_POST['voyout']);
		$act=htmLawed($_POST['act']);
		$npe=htmLawed($_POST['npe']);
		$file=htmLawed($_POST['file']);
		
		if($act=='INBOUND')
		{
			$ei="I";
		}
		else
		{
			$ei="E";
		}		
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		
		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;
		
		//create table
		$this->table->set_heading(
			"<th width='30px'>NO</th>",
			"<th width='100px'>VESSEL</th>",
			"<th width='100px'>VOYAGE IN</th>",
			"<th width='100px'>VOYAGE OUT</th>",
			"<th width='100px'>NO CONTAINER</th>",
			"<th width='50px'>SIZE</th>",
			"<th width='50px'>TYPE</th>",
			"<th width='50px'>STATUS</th>",
			"<th width='50px'>HZ</th>",
			"<th width='50px'>KODE STATUS</th>",
			"<th width='50px'>POD</th>",
			"<th width='50px'>WEIGHT</th>",
			"<th width='50px'>GATE IN / GATE OUT</th>",
			"<th width='50px'>NO POL</th>",
			"<th width='50px'>YARD ALLOCATION</th>",
			"<th width='50px'>DATE PLACEMENT</th>",
			"<th width='50px'>YARD PLACEMENT</th>",
			"<th width='50px'>BAY PLAN</th>",
			"<th width='50px'>DISCH/LOADING CONFIRM</th>",
			"<th width='50px'>CUSTOMER NAME</th>",
			"<th width='50px'>NO NOTA</th>",
			"<th width='50px'>NPE</th>",
			"<th width='50px'>PEB</th>",
			"<th width='100px'>BC DOC"
		 );
		
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$ves</vessel_name>
				<voyin>$voyin</voyin>
				<voyout>$voyout</voyout>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<ei>".$ei."</ei>
				<npe>".$npe."</npe>
			</data>
		</root>";
        //echo $in_data;die;

		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getListContainerInbound",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj2 = json_decode($result);
			if($obj2->data->vessel)
			{
				for($j=0;$j<count($obj2->data->vessel);$j++)
				{					
					if($ei=="I")
					{
						$gate = $obj2->data->vessel[$j]->tgl_gate_out;
					}
					else
					{
						$gate = $obj2->data->vessel[$j]->tgl_gate_in;
					}
					$yd_allo = $obj2->data->vessel[$j]->block_."-".$obj2->data->vessel[$j]->slot_."-".$obj2->data->vessel[$j]->row_;
					$yd_plc = $obj2->data->vessel[$j]->block_."-".$obj2->data->vessel[$j]->slot_."-".$obj2->data->vessel[$j]->row_."-".$obj2->data->vessel[$j]->tier_;
					$this->table->add_row(
											$j+1,
											$obj2->data->vessel[$j]->vessel_name,
											$obj2->data->vessel[$j]->voyage_in,
											$obj2->data->vessel[$j]->voyage_out,
											$obj2->data->vessel[$j]->no_container,
											$obj2->data->vessel[$j]->sz_cont,
											$obj2->data->vessel[$j]->ty_cont,
											$obj2->data->vessel[$j]->st_cont,
											$obj2->data->vessel[$j]->hz,
											$obj2->data->vessel[$j]->kode_status,
											$obj2->data->vessel[$j]->pod,
											$obj2->data->vessel[$j]->weight,
											$gate,
											$obj2->data->vessel[$j]->nopol,
											$yd_allo,
											$obj2->data->vessel[$j]->tgl_placement,
											$yd_plc,
											$obj2->data->vessel[$j]->bay,
											$obj2->data->vessel[$j]->date_confirm,
											$obj2->data->vessel[$j]->customer_name,
											$obj2->data->vessel[$j]->no_nota,
											$obj2->data->vessel[$j]->npe,
											$obj2->data->vessel[$j]->peb,
											$obj2->data->vessel[$j]->sppb
										);
					//$j++;					
				}
			}
		}		
		
		$datagrid=$this->container_model->getListSvcCancel($page, $limit, $search);
		$totallist=$this->container_model->getTtlListSvcCancel($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		$this->load->view('pages/container/inbound_outbound_grid',$data);
	}

}
?>