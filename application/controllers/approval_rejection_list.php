<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class approval_rejection_list extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		
         require_once(APPPATH.'libraries/htmLawed.php');

        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		/*if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {

			redirect(ROOT.'mainpage', 'refresh');
		}*/
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


		$this->breadcrumbs->push("Approval Request", 'approval_request/new_main_approval');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Approval Request";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');
		$this->common_loader($data,'pages/container/rbm_rejection');
	}


	public function view_rbm($a)
	{
		$data['no_request'] = $a;
		$datahead = $this->container_model->getNumberReqAndSource($a);
		$data['rowdata'] = $datahead;


        $stack = array();

        $in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_vsb>$a</id_vsb>
				<port_code>".$datahead['PORT_ID']."</port_code>
				<terminal_code>".$datahead['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getViewRbm",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->listcont)
			{
				for($i=0;$i<count($obj->data->listcont);$i++)
				{
					// $temp;
					// $temp['NO_CONTAINER']=$obj->data->listcont[$i]->no_container;
					// $temp['SIZE_CONT']=$obj->data->listcont[$i]->size_cont;
					// $temp['TYPE_CONT']=$obj->data->listcont[$i]->type_cont;
					// $temp['STATUS_CONT']=$obj->data->listcont[$i]->status_cont;
					// $temp['HZ']=$obj->data->listcont[$i]->hz;
					// $temp['KD_COMODITY']=$obj->data->listcont[$i]->kd_comodity;
					// $temp['ID_CONT']=$obj->data->listcont[$i]->id_cont;
					// $temp['ISO_CODE']=$obj->data->listcont[$i]->iso_code;
					// $temp['HEIGHT']=$obj->data->listcont[$i]->height;
					// $temp['CARRIER']=$obj->data->listcont[$i]->carrier;
					// $temp['OG']=$obj->data->listcont[$i]->og;
					// $temp['PLUG_IN']=isset($obj->data->listcont[$i]->plug_in)?$obj->data->listcont[$i]->plug_in:'';
					// $temp['PLUG_OUT']=isset($obj->data->listcont[$i]->plug_out)?$obj->data->listcont[$i]->plug_out:'';
					// $temp['PLUG_OUT_EXT']=isset($obj->data->listcont[$i]->plug_out_ext)?$obj->data->listcont[$i]->plug_out_ext:'';
					// $temp['JML_SHIFT']=isset($obj->data->listcont[$i]->jml_shift)?$obj->data->listcont[$i]->jml_shift:'';
					// $POD=$obj->data->listcont[$i]->pod;
					// $FPOD=$obj->data->listcont[$i]->fpod;
					// $start_shift=$obj->data->listcont[$i]->start_shift;
					// $end_shift=$obj->data->listcont[$i]->end_shift;
					// $shift_reefer=$obj->data->listcont[$i]->shift_rfr;
					// $temp['NO_BOOKING_SHIP']=$obj->data->listcont[$i]->no_booking_ship;
					// $tl=$obj->data->listcont[$i]->tl_flag;
					// $call_sign=isset($obj->data->listcont[$i]->call_sign)?$obj->data->listcont[$i]->call_sign:'';
					// $stpr=isset($obj->data->listcont[$i]->start_period)?$obj->data->listcont[$i]->start_period:'';
					// $enpr=$obj->data->listcont[$i]->end_period;
					// $expr=isset($obj->data->listcont[$i]->ext_period)?$obj->data->listcont[$i]->ext_period:'';
					// array_push($stack, $temp);
				}
			}
		}


		// $data['TL_FLAG']=$tl;
		// $data['CALL_SIGN']=$call_sign;
		// $data['POD']=$POD;
		// $data['FPOD']=$FPOD;
		// $data['START_SHIFT']=$start_shift;
		// $data['END_SHIFT']=$end_shift;
		// $data['SHIFT_REEFER']=$shift_reefer;
		// $data['START_PERIOD']=$stpr;
		// $data['END_PERIOD']=$enpr;
		// $data['EXT_PERIOD']=$expr;
		// $data['row_detail']=$stack;
		// $data['row_history']=$this->container_model->getRequestHistory($a);
		$this->load->view('pages/container/',$data);
	}


}
	