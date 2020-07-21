<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Recon extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->library('session');
require_once(APPPATH.'libraries/htmLawed.php');
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);				
			
		$this->load->model('auth_model','auth_model');
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
		
		//create table
		$this->table->set_heading('Tanggal Transaksi', 'Modul', 'Total Nota SIMOP', 'Belum Transfer Nota Simkeu', 'Belum Lunas Simkeu', 'Over JKM Simkeu');

		//no error
		//start_time = tanggal entry data pkk, format dd-mm-yyyy hh24:mi:ss
		
		$final=date('01-m-Y', strtotime(date("Y-m-d").' -1 months'));
		
		$start_date=$final." 00:00:00";
		$end_date=date('d-m-Y', strtotime(date("Y-m-d")))." 23:59:59";
		$submodul = array("PTP_OPUS_TO3","PTP_ITOS_TO3","PTP_ITOS_TO2","PTP_ITOS_TO1","PTP_LINI2","PTP_KAPAL_AUTOCOLLECTION","PTP_BARANG","PTP_009_NEW","PNK_OPUS","PJG_OPUS");
		
		foreach ($submodul as $sbmodul) {

			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<start_date>$start_date</start_date> 
					<end_date>$end_date</end_date>
					<modul>$sbmodul</modul>
				</data>
			</root>";
			
			if(!$this->nusoap_lib->call_wsdl(RECON,"getCountStatusNotaArReceipt",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				$obj = json_decode($result);
				
				if($obj->data->data)
				{
					for($i=0;$i<count($obj->data->data);$i++)
					{
						if(intval($obj->data->data[$i]->arnotfound)>0
								||intval($obj->data->data[$i]->receiptnotfound)>0
								||intval($obj->data->data[$i]->overpayment)>0)
						{	
							$this->table->add_row(
													$obj->data->data[$i]->trx_date,
													$obj->data->data[$i]->modul,
													$obj->data->data[$i]->all,
													$obj->data->data[$i]->arnotfound,
													$obj->data->data[$i]->receiptnotfound,
													$obj->data->data[$i]->overpayment
													);
						}
					}
				}					
			}			
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Rekonsiliasi E-Payment (SIMOP-SIMKEU)', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Rekonsiliasi';
		
		$this->common_loader($data,'pages/epayment/recon');
	}
	
	public function getDetailData()
	{
		//input
		if(isset($_POST['date'])) $date = htmLawed($_POST['date']);
		if(isset($_POST['modul'])) $modul = htmLawed($_POST['modul']);
		if(isset($_POST['find'])) $find = htmLawed($_POST['find']);

		$date = explode("/", $date);
		$transdate = $date[2]."/".$date[1]."/".$date[0];
		
		$modul = explode(" ", $modul);
		$modulname="";
		for($i=0;$i<count($modul);$i++)
		{
			if($i!=0) $modulname .="_";
					
			$modulname .= $modul[$i];
		}
		
		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<transdate>$transdate</transdate>
				<modul>$modulname</modul>
				<find>$find</find>
			</data>
		</root>";
		
		if(!$this->nusoap_lib->call_wsdl(RECON,"getNotaArReceipt",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;		
		}		
	}
}