<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Autocollection extends CI_Controller {

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
		$this->load->model('auth_model','auth_model');
		if (! $this->session->userdata('is_login') ){
		 	redirect('main_invoice');
		}
		
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
			
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
		$this->table->set_heading('DATE', 'PPKB', 'RESPOND', 'MESSAGE', 'STATEMENTS','BANK');
		
		$final=date('d-m-Y', strtotime(date("Y-m-d").' -2 weeks'));
		
		$start_date=$final." 00:00:00";
		$end_date=date('d-m-Y', strtotime(date("Y-m-d")))." 23:59:59";
		$submodul = array("PTP_KAPAL");
		
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

			if(!$this->nusoap_lib->call_wsdl(EPAYMENT_LOG,"getAutoLog",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//echo $result;die;
				$obj = json_decode($result);
				
				if($obj->data->data)
				{
					for($i=0;$i<count($obj->data->data);$i++)
					{
						$this->table->add_row(
												$obj->data->data[$i]->log_date,
												$obj->data->data[$i]->no_ppkb,
												$obj->data->data[$i]->respond,
												$obj->data->data[$i]->message,														
												$obj->data->data[$i]->statements,
												$obj->data->data[$i]->kd_bank
												);
					}
				}
			}		
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('LOG AUTOCOLLECTION', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'AUTOCOLLECTION';

		$this->common_loader($data,'pages/epayment/autocollection');
	}
	
	public function hold(){
		
		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		//create table
		$this->table->set_heading('NAMA AGEN', 'NO REK', 'CURRENCY', 'BANK', 'TOTAL HOLD');
		
		$no_rek="";
		$currency="";
		$nama_agen="";

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_rek>$no_rek</no_rek> 
				<currency>$currency</currency>
				<nama_agen>$nama_agen</nama_agen>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(EPAYMENT_LOG,"getAutoTotalHold",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			
			if($obj->data->data)
			{
				for($i=0;$i<count($obj->data->data);$i++)
				{
					$this->table->add_row(
											$obj->data->data[$i]->nama_agen,
											$obj->data->data[$i]->norek,
											$obj->data->data[$i]->currency,
											$obj->data->data[$i]->bank_id,
											array('data' => $obj->data->data[$i]->total_hold, 'align' => 'right')
											);
				}
			}				
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Hold', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Hold';

		$this->common_loader($data,'pages/epayment/hold');
	}

	public function last_status_error(){
		
		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
			
		//create table
		$this->table->set_heading('NO', 'NO PPKB', 'NM AGEN', 'LOG DATE', 'MESSAGE', 'STATEMENTS', 'KD BANK','Pemanggilan Pertama', 'Selisih Waktu (Jam.Menit)', 'TOTAL PEMANGGILAN', 'RESPOND','KEBUTUHAN DANA TERSEDIA DI BANK');
		
		$exmp="";

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<exmp>$exmp</exmp>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(EPAYMENT_LOG,"getAutoLastStatusError",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			
			if($obj->data->data)
			{
				for($i=0;$i<count($obj->data->data);$i++)
				{		
					$amount = 0;
					if((strpos($obj->data->data[$i]->message,'Saldo Tidak Cukup') !== false)
						||(strpos($obj->data->data[$i]->message,'Hold Amount exceded available balance') !== false)
						||(strpos($obj->data->data[$i]->message,'SALDO TIDAK CUKUP') !== false)
						)
					{
						$pieces = explode("^", $obj->data->data[$i]->statements);
						if (strpos($pieces[0],'call(paymentrelease') !== false) {
							$amount = $pieces[6];
							if($pieces[4]=='IDR')
									$amount += 1000000;
							else 
									$amount += 100;								
						}
						else if (strpos($pieces[0],'call(holdamount') !== false) {
							$amount = $pieces[2];
							if($pieces[4]=='IDR')
									$amount += 1000000;
							else 
									$amount += 100;
						}
						else if (strpos($pieces[0],'call(updateholdamount') !== false) {
							$amount = $pieces[2];
							if($pieces[6]=='IDR')
									$amount += 1000000;
							else 
									$amount += 100;								
						}
					}
					
					$this->table->add_row(	
											$i+1,
											$obj->data->data[$i]->no_ppkb,
											$obj->data->data[$i]->nm_agen,
											$obj->data->data[$i]->log_date,
											$obj->data->data[$i]->message,
											$obj->data->data[$i]->statements,
											$obj->data->data[$i]->kd_bank,
											$obj->data->data[$i]->tanggal_pemanggilan_pertama,
											$obj->data->data[$i]->selisih_waktu_pemanggilan,
											$obj->data->data[$i]->jumlah_pemanggilan_yang_sama,
											$obj->data->data[$i]->respond,
											array('data' => number_format($amount, 0, ',', '.'), 'align' => 'right')
											//$obj->data->data[$i]->rn
											);
				}
			}				
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Autocollection Pending Status', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Pending Status';

		$this->common_loader($data,'pages/epayment/last_status_error');			
	}	
}