<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Host2host extends CI_Controller {

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
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		//create table
		$this->table->set_heading('DATE', 'INVOICE', 'REQ_NUM', 'AMT', 'CUST','SOURCE','STATUS','MESSAGE','TRANS_CODE');
		
		$final=date('d-m-Y', strtotime(date("Y-m-d").' -1 days'));
		
		$start_date=$final." 00:00:00";
		$end_date=date('d-m-Y', strtotime(date("Y-m-d")))." 23:59:59";
		$submodul = array("ILCS_HOST2HOST_LOG");
		
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

			if(!$this->nusoap_lib->call_wsdl(EPAYMENT_LOG,"getHost2hostLog",array("in_data" => "$in_data"),$result))
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
												$obj->data->data[$i]->invoice,
												$obj->data->data[$i]->req_num,
												$obj->data->data[$i]->amt,														
												$obj->data->data[$i]->cust,
												$obj->data->data[$i]->source,
												$obj->data->data[$i]->status,
												$obj->data->data[$i]->message,
												$obj->data->data[$i]->trans_code
												);
					}
				}
			}
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('LOG HOST2HOST', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'HOST2HOST';

		$this->common_loader($data,'pages/host2host');			
	}
	
}