<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Approval extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('om/proforma_model');
		$this->load->model('om/booking_model');
		$this->load->model('om/calculator_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('OMDBConnect');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views) {
		$this->load->view('templates/om/header', $data);
		$this->load->view('templates/om/top_bar', $data);
		$this->load->view('templates/om/menu_side', $data);
		$this->load->view('templates/om/top-1-breadcrumb', $data);
		$this->load->view('templates/om/top-2-title-nosearch', $data);
		if (is_array($views) ){foreach($views as $view)$this->load->view($view, $data);}else{$this->load->view($views, $data);}
		$this->load->view('templates/om/footer', $data);
	}

	public function redirect(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
	}

	public function index()
	{
		$this->redirect();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Approval Request", 'om/approval_request');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Approval Request";

		$this->common_loader($data,'pages/om/approval_request');
	}

	/*public function new_main_approval()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Approval Cargo Request", 'approval_request/new_main_approval');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Approval Cargo Request";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');
		$this->common_loader($data,'pages/om/new_approval_request');
	}*/

	public function search_table($search="")
	{

		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th>No</th>",
			"<th>No Request</th>",
			"<th>Request Type</th>",
			"<th>Request Date</th>",
			"<th>Customer</th>",
			"<th>Port / Terminal</th>",
			"<th>Vessel Voyage</th>",
			"<th>TL FLAG</th>",
			"<th>View</th>",
			"<th>Approve</th>"
		);

		$result = $this->user_model->get_idPCH($this->session->userdata('sub_group_phd'));
		$id_port =  implode("', '", array_map(function ($result) {
					  return $result['ID_PORT'];
					}, $result));
		$id_company =  implode("', '", array_map(function ($result) {
					  return $result['ID_COMPANY'];
					}, $result));
		$id_holding =  implode("', '", array_map(function ($result) {
					  return $result['ID_HOLDING'];
					}, $result));

		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<search>$search</search>
							<upper_bound>$upper_bound</upper_bound>
							<lower_bound>$lower_bound</lower_bound>
						</data>
					</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getApprovalList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// call success
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
					$id_req = $obj->data->listreq[$i]->id_reqcargo;
					$id_svc = $obj->data->listreq[$i]->id_servicetype;
					
					$tl = $obj->data->listreq[$i]->tl_flag;
					$view_btn = '<a class="btn btn-primary" href="javascript:void(0)" onclick="ViewDialog(\''.$id_req.'\')"><i class="fa fa-eye"></i></a>';
					$approve_btn="";
					if($obj->data->listreq[$i]->status_req == "N")
						$approve_btn = '<button id="BUTTONACTIVE-'.$id_req.'" type="button" class="btn btn-success btn-lg" href="javascript:void(0)" onclick="doApprove(\''.$id_req.'\',\''.$id_svc.'\',\''.$tl.'\')"><span class="fa fa-check"></span> Approve</button>';
					$this->table->add_row(
						$i+1,
						$id_req,
						$obj->data->listreq[$i]->servicetype_name,
						$obj->data->listreq[$i]->req_date,
						$obj->data->listreq[$i]->cust_name,
						$obj->data->listreq[$i]->id_port,
						$obj->data->listreq[$i]->vessel ."<br/>".$obj->data->listreq[$i]->voy_in." - ".$obj->data->listreq[$i]->voy_out,
						$obj->data->listreq[$i]->tl_flag,
						$view_btn,
						$approve_btn
					);
				}
			}
		}

		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<search>$search</search>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
						</data>
					</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getTotalApprovalList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//echo $result;die;
			$obj = json_decode($result);

			// print_r($obj);

			if($obj->data->listreq)
			{
				$jml = $obj->data->listreq->jml;
			}
		}

		$totallist=$jml;
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		$this->load->view('pages/om/approval_request_grid', $data);
	}

	public function view_request($a)
	{
		$data['no_request']=$a;

        $in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$a</norequest>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getDetailReq",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			// print_r($obj);die;

			if($obj->data->header)
			{
				$data['no_request'] = $obj->data->header->id_req;
				$data['req_date'] = $obj->data->header->req_date;
				$data['cust_name'] = $obj->data->header->cust_name;
				$data['cust_addr'] = $obj->data->header->cust_addr;
				$data['vessel'] = $obj->data->header->vessel;
				$data['voy_in'] = $obj->data->header->voy_in;
				$data['voy_out'] = $obj->data->header->voy_out;
				$data['servicetype_name'] = $obj->data->header->servicetype_name;
			}

			if($obj->data->detail)
			{
				$stack = array();
				for($i=0;$i<count($obj->data->detail);$i++)
				{
					$temp['dtl_no']=$obj->data->detail[$i]->dtl_no;
					$temp['cargo_name']=$obj->data->detail[$i]->cargo_name;
					$temp['pkg_name']=$obj->data->detail[$i]->pkg_name;
					$temp['qty']=$obj->data->detail[$i]->qty;
					$temp['unit']=$obj->data->detail[$i]->unit;
					$temp['ton']=$obj->data->detail[$i]->ton;
					$temp['cubic']=$obj->data->detail[$i]->cubic;
					$temp['hz']=$obj->data->detail[$i]->hz;
					$temp['ds']=$obj->data->detail[$i]->ds;
					$data['stackin']=$obj->data->detail[$i]->stackin;
					$data['stackout']=$obj->data->detail[$i]->stackout;
					// $temp['bl_number']=$obj->data->detail[$i]->bl_number;
					$data['bl_number']=$obj->data->detail[$i]->bl_number;
					$temp['tl_flag']=$obj->data->detail[$i]->tl_flag;
					if($temp['tl_flag']=='Y')
						$data['ket_tl'] = 'TL';
					else
						$data['ket_tl'] = 'Yard';

					array_push($stack, $temp);
				}
			}
		}
		$data['row_detail']=$stack;
		$data['row_history']="";
		$this->load->view('pages/om/approval_request_viewreq', $data);
	}

	public function set_approved()
	{
		$this->redirect();

		$noreq = $_POST['request_no'];
		
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$noreq</norequest>
		
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"setApproveReq",array("in_data" => "$in_data"),$result))
		{
			echo 'F';
			// return 'F';
		}
		else
		{
			$obj = json_decode($result);
			echo $obj->data->status;
			// return $obj->data->status;
		}
		die;
	}

}
