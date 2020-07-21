<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Container extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function del_RequestAll()
	{
		$no_request=$_POST['REQUEST'];
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		$reason=$_POST['REJECT_NOTES'];
		$user_id=$this->session->userdata('userid_simop');
		$mekanisme='MANUAL';

		$databiller=$this->container_model->getDataRequestBiller($no_request);
		//echo "test";die;
		//json_encode($databiller);die;
		$port=$databiller['PORT_ID'];
		$terminal=$databiller['TERMINAL_ID'];
		//echo $terminal;die;
		$service=$databiller['ID_SERVICE'];
		//echo('test');die;
		try{

			$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<port_code>$port</port_code>
							<terminal_code>$terminal</terminal_code>
							<id_reqol>$no_request</id_reqol>
							<id_req>$reqNoBiller</id_req>
							<type_req>$service</type_req>
							<user_id>$user_id</user_id>
							<reason>$reason</reason>
							<mekanisme>$mekanisme</mekanisme>
						</data>
					</root>";
			//echo $in_data;die();		
			if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"cancelBooking",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//print_r($result);die();
				//echo $result;die();

				$obj = json_decode($result);
				if($obj->data->info)
				{
					echo($obj->data->info);
				} else {
					echo "NO,GAGAL";
					//echo $result;
				}
			}
		} catch (Exception $e) {
			echo "NO Exception,GAGAL";
		}
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

		$this->redirect();

		//search container
		//input
		$container_number="";
		$container_point="";
		$billing=null;
		if(isset($_GET['port'])){
			$port			= explode("-",$_GET["port"]);
		}
		if(isset($_GET['vessel_name'])) $vessel_name = $_GET['vessel_name'];
		if(isset($_GET['voyage_in'])) $voyage_in = $_GET['voyage_in'];
		if(isset($_GET['voyage_out'])) $voyage_out = $_GET['voyage_out'];
		if(isset($_GET['container_number'])) $container_number = $_GET['container_number'];
		if(isset($_GET['container_point'])) $container_point = $_GET['container_point'];

		//create table
		$this->table->set_heading("No", "Handling", "Time");

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));

		//output
		$data['no_container'] = "";
		$data['vessel'] =  "";
		$data['voyage_in'] =  "";
		$data['voyage_out'] =  "";
		$data['status'] =  "";
		$data['location'] =  "";
		$data['size'] =  "";
		$data['type'] =  "";
		$data['status'] =  "";
		$data['hazard'] =  "";
		$data['imo_class'] =  "";
		$data['un_number'] =  "";
		$data['iso_code'] =  "";
		$data['height'] =  "";
		$data['pol'] =  "";
		$data['pod'] =  "";
		$data['weight'] =  "";
		$data['e_i'] =  "";
		$data['hold_status'] =  "";
		$data['activity'] =  "";
		$data['cont_location'] =  "";
		$data['reefer_temp'] =  "";
		$data['weight'] =  "";
		$data['hold_status'] =  "";
		$data['paidthru'] =  "";
		$data['point'] =  "";
		$data['maxpoint'] =  "";

		if($container_number!="")
		{
			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_container>$container_number</no_container>
					<point>$container_point</point>
					<vessel>$vessel_name</vessel>
					<voyage_in>$voyage_in</voyage_in>
					<voyage_out>$voyage_out</voyage_out>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
				</data>
			</root>";
			// echo $in_data;die;
			if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getDetailContainer",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				// echo $result;die;

				$obj = json_decode($result);

				if($obj->data->info)
				{
					$data['no_container'] = $obj->data->info->no_container;
					$data['vessel'] =  $obj->data->info->vessel;
					$data['voyagein'] =  $obj->data->info->voyage_in;
					$data['voyageout'] =  $obj->data->info->voyage_out;
					$data['status'] =  $obj->data->info->status;
					$data['location'] =  $obj->data->info->location;
					$data['size'] =  $obj->data->info->size;
					$data['type'] =  $obj->data->info->type;
					$data['status'] =  $obj->data->info->status;
					$data['hazard'] =  $obj->data->info->hazard;
					$data['imo_class'] =  $obj->data->info->imo_class;
					$data['un_number'] =  $obj->data->info->un_number;
					$data['iso_code'] =  $obj->data->info->iso_code;
					$data['height'] =  $obj->data->info->height;
					$data['pol'] =  $obj->data->info->pol;
					$data['pod'] =  $obj->data->info->pod;
					$data['weight'] =  $obj->data->info->weight;
					$data['e_i'] =  $obj->data->info->e_i;
					$data['hold_status'] =  $obj->data->info->hold_status;
					$data['activity'] =  $obj->data->info->activity;
					$data['cont_location'] =  $obj->data->info->cont_location;
					$data['reefer_temp'] =  $obj->data->info->reefer_temp;
					$data['weight'] =  $obj->data->info->weight;
					$data['hold_status'] =  $obj->data->info->hold_status;
					$data['paidthru'] =  $obj->data->info->paidthru;
					$data['point'] =  $obj->data->info->point;
					$data['maxpoint'] =  $obj->data->info->maxpoint;
					$data['nobooking'] =  $obj->data->info->nobooking;
					$data['seal_id'] =  $obj->data->info->seal_id;
					$data['nopol'] =  $obj->data->info->nopol;
					$data['bayplan_position'] =  $obj->data->info->bayplan_position;
					$data['damage_code'] =  $obj->data->info->damage_code;

					for($i=0;$i<count($obj->data->handling);$i++)
					{
						$this->table->add_row(
							$i+1,
							$obj->data->handling[$i]->activity.' '.$obj->data->handling[$i]->to_location,
							$obj->data->handling[$i]->time
							);

					}

					for($i=0;$i<count($obj->data->billing);$i++)
					{
						$billing[$i]['no']=$i+1;
						$billing[$i]['no_request']=$obj->data->billing[$i]->no_request;
						$billing[$i]['no_request_ol']=$obj->data->billing[$i]->no_request_ol;
						$billing[$i]['request_type']=$obj->data->billing[$i]->request_type;
						$billing[$i]['no_proforma']=$obj->data->billing[$i]->no_proforma;
						$billing[$i]['customer']=$obj->data->billing[$i]->customer;
						$billing[$i]['date_request']=$obj->data->billing[$i]->date_request;
						$billing[$i]['date_payment']=$obj->data->billing[$i]->date_payment;
						$billing[$i]['paid_thru']=$obj->data->billing[$i]->paid_thru;
						$billing[$i]['status']=$obj->data->billing[$i]->status;
					}
				}
			}
		}
		$data['billing']=$billing;

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Track & Trace Container", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Track & Trace Container";

		$this->common_loader($data,'pages/container/tracking');
	}

	public function main_delivery(){

		$this->redirect();
		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');//diubah ke submitter-case ppjk
		$result=$this->container_model->getNumberRequest($customer_id,$submitter_customer_id,'PTKM01');
		//create table
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>REQUEST NUMBER</th>",
		  "<th width='100px'>DATE REQUEST</th>",
		  "<th width='100px'>STATUS</th>",
		  "<th width='100px'>VESSEL - VOYAGE</th>",
		  "<th width='100px'>PELABUHAN/TERM.</th>",
		  "<th width='100px'>TIPE DELIVERY</th>",
		  "<th width='100px'>DATE DELIVERY</th>",
		  "<th width='100px'>CONTAINER QUANTITY</th>",
		  "<th width='50px'>VIEW</th>",
		  "<th width='50px'>EDIT</th>",
		  //"<th width='50px'>" . get_content($this->user_model,"delivery","cancel") . "</th>",
		  "<th width='80px'>REQUEST CONFIRM"
		 );

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		//$customer_id=$this->session->userdata('customerid_phd');
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
			</data>
		</root>";

/* 		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getRequestDeliveryHeaderCompressed",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);

			if(isset($obj->data->request))
			{ */

				$i=1;
				foreach($result as $row)
				{
					$label_span='<span class="label label-default">N/A</span>';
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link='<span class="label label-default">N/A</span>';
					$cancel_link='<span class="label label-default">N/A</span>';
					$confirm_link='<span class="label label-default">N/A</span>';
					if($row['STATUS_REQ']=="N"){
						$label_span='<span class="label label-info">Draft</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/cancel_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
					} else if($row['STATUS_REQ']=="S"){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					} else if($row['STATUS_REQ']=="P" || $row['STATUS_REQ']=="T"){
						$label_span='<span class="label label-success">Paid</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					}
					else if($row['STATUS_REQ'] == 'W'){
						$label_span='<span class="label label-warning">Waiting Approve</span>';
					}
					else if($row['STATUS_REQ'] == 'R'){
						$label_span='<span class="label label-danger" title="'.$row['REJECT_NOTES'].'">Rejected</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/cancel_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else {
						$label_span='<span class="label label-default">N/A</span>';
					}

					if ($row['CONT_QTY'] == 'DB DOWN'){
						$view_link = $edit_link = $confirm_link = "DB DOWN";
					}

					if (($row['DEL_VIA'] == 'LAP') OR ($row['DEL_VIA'] == 'YARD'))
					{
						$del_via = 'YARD';
					}
					else if ($row['DEL_VIA'] == 'TL')
					{
						$del_via = 'TL';
					}
					else if ($row['DEL_VIA'] == 'TONGKANG')
					{
						$del_via = 'TONGKANG';
					}
					else
					{
						$del_via = '';
					}

					$this->table->add_row(
						$i++,
						$row['REQUEST_ID'],
						$row['REQUEST_DATE'],
						$label_span,
						$row['VESVOY'],
						$row['TERMINAL_NAME']."/".$row['PORT'],
						$del_via,
						$row['ADDITIONAL_DATE'],
						$row['CONT_QTY'],
						$view_link,
						$edit_link,
						//$cancel_link,
						$confirm_link
					);
				}
		/* 	} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		} */

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Delivery Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Delivery Booking";

		$this->common_loader($data,'pages/container/main_delivery');
	}

	public function main_delivery_ext(){
		
		$this->redirect();

		$this->table->set_heading(
			'No',
			"REQUEST NUMBER",
			//get_content($this->user_model,"ext_delivery","old_request_number"),
			"REQUEST DATE",
			"STATUS",
			"VESSEL VOYAGE",
			"TERMINAL",
			//get_content($this->user_model,"ext_delivery","terminal"),
			"DELIVERY DATE",
			"QTY",
			"VIEW",
			"EDIT",
			"CONFIRM"
		);

		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
			</data>
		</root>";
		// print_r("expression");
		// die();
		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getListRequestDeliveryPerpCompressed",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo result;die;
			// print_r($result);
			// die();
			$obj = json_decode($result);

			if(isset($obj->data->list_req))
			{
				for($i=0;$i<count($obj->data->list_req);$i++)
				{
					$confirm_link='<span class="label label-default">N/A</span>';
					$view_link='<a  class=\'btn btn-primary\'  onclick=\'clickDialog1("'.$obj->data->list_req[$i]->id_req.'")\'><i class=\'fa fa-eye\'></i></a>';
					if($obj->data->list_req[$i]->status == 'N'){
						$label_span = '<span class="label label-info">Draft</span>';

						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery_ext/".$obj->data->list_req[$i]->id_req.'"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->list_req[$i]->id_req.'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else if($obj->data->list_req[$i]->status == 'S'){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';

					}
					else if($obj->data->list_req[$i]->status == 'W'){
						 $label_span='<span class="label label-warning">Waiting Approve</span>';

					}
					else if($obj->data->list_req[$i]->status == 'R'){
						$label_span='<span class="label label-danger" title="'.$obj->data->list_req[$i]->reject_notes.'">Rejected</span>';

						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery_ext/".$obj->data->list_req[$i]->id_req.'"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->list_req[$i]->id_req.'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else if($obj->data->list_req[$i]->status == 'P' || $obj->data->list_req[$i]->status == 'T'){
						$label_span='<span class="label label-success">Paid</span>';

					}
					else {
						$label_span='<span class="label label-danger">N/A</span>';

					}
					$this->table->add_row(
						$i+1,
						$obj->data->list_req[$i]->id_req,
						$obj->data->list_req[$i]->date_request,
						$label_span,
						$obj->data->list_req[$i]->vessel." ".$obj->data->list_req[$i]->voyage_in."-".$obj->data->list_req[$i]->voyage_out,
						$obj->data->list_req[$i]->port_terminal,
						//$obj->data->list_req[$i]->id_terminal,
						$obj->data->list_req[$i]->date_delivery,
						$obj->data->list_req[$i]->qty,
						$view_link,
						$edit_link,
						$confirm_link
					);
				}
			}
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Extension Delivery", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Extension Delivery";

		$this->common_loader($data,'pages/container/main_delivery_ext');
	}

	public function search_main_delivery_ext(){

		$this->redirect();

		$this->table->set_heading(
			'No',
			"REQUEST NUMBER",
			//get_content($this->user_model,"ext_delivery","old_request_number"),
			"REQUEST DATE",
			"STATUS",
			"VESSEL VOYAGE",
			"TERMINAL",
			//get_content($this->user_model,"ext_delivery","terminal"),
			"DELIVERY DATE",
			"QTY",
			"VIEW",
			"EDIT",
			"CONFIRM"
		);

		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search=isset($_POST['search']) ? htmLawed($_POST['search']) : 10;

		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<submitter_customer_id>$customer_id</submitter_customer_id>
				<search>$search</search>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getListRequestDeliveryPerpCompressed",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);

			if(isset($obj->data->list_req))
			{
				for($i=0;$i<count($obj->data->list_req);$i++)
				{
					$confirm_link='<span class="label label-default">N/A</span>';
					$view_link='<a  class=\'btn btn-primary\'  onclick=\'clickDialog1("'.$obj->data->list_req[$i]->id_req.'")\'><i class=\'fa fa-eye\'></i></a>';
					if($obj->data->list_req[$i]->status == 'N'){
						$label_span = '<span class="label label-info">Draft</span>';

						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery_ext/".$obj->data->list_req[$i]->id_req.'"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->list_req[$i]->id_req.'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else if($obj->data->list_req[$i]->status == 'S'){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';

					}
					else if($obj->data->list_req[$i]->status == 'W'){
						 $label_span='<span class="label label-warning">Waiting Approve</span>';

					}
					else if($obj->data->list_req[$i]->status == 'R'){
						$label_span='<span class="label label-danger" title="'.$obj->data->list_req[$i]->reject_notes.'">Rejected</span>';

						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery_ext/".$obj->data->list_req[$i]->id_req.'"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->list_req[$i]->id_req.'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else if($obj->data->list_req[$i]->status == 'P' || $obj->data->list_req[$i]->status == 'T'){
						$label_span='<span class="label label-success">Paid</span>';

					}
					else {
						$label_span='<span class="label label-danger">N/A</span>';

					}
					$this->table->add_row(
						$i+1,
						$obj->data->list_req[$i]->id_req,
						$obj->data->list_req[$i]->date_request,
						$label_span,
						$obj->data->list_req[$i]->vessel." ".$obj->data->list_req[$i]->voyage_in."-".$obj->data->list_req[$i]->voyage_out,
						$obj->data->list_req[$i]->port_terminal,
						//$obj->data->list_req[$i]->id_terminal,
						$obj->data->list_req[$i]->date_delivery,
						$obj->data->list_req[$i]->qty,
						$view_link,
						$edit_link,
						$confirm_link
					);
				}
			}
		}

		$this->load->view('pages/container/search_main_delivery_ext', $data);
	}

	public function get_detail_billing()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		$no_req = $_POST["no_req"];
		injek($no_req);
		$result=$this->container_model->getDetailBilling($no_req);
		// print_r($result);
		// die();
		echo json_encode($result);
	}

    public function billing_management($search="")
	{
		//$this->redirect();

		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
		$group_id = $this->session->userdata('group_phd');

		//create table
		$result=$this->container_model->getNumberReqAndSourceByCust($customer_id,$submitter_customer_id);
		$cekship=$this->master_model->cek_shippingline();
		$is_shipping=$this->master_model->cek_shippingline();
		if($is_shipping=='N'){
			$this->table->set_heading(
						"NO",
						"REQUEST NO",
						"VESSEL - VOYAGE",
						"PORT - TERMINAL",
						"DATE REQUEST",
						"STATUS",
						"VIEW",
						"PROFORMA",
						"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
						"CARD",
						"CARD THERMAL"
					);
		}
		else
		{
			$this->table->set_heading(
						"NO",
						"REQUEST NO",
						"VESSEL - VOYAGE",
						"PORT - TERMINAL",
						"DATE REQUEST",
						"STATUS",
						"VIEW",
						"PROFORMA",
						"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
						"CARD",
						"CARD THERMAL"
					);
		}

		//echo var_dump($result);die;
		$i=1;
		foreach ($result as $row)
		{
			$label_span="";
			$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
			$urlcard_blanko="";
			if($row['MODUL_DESC'] == 'RECEIVING'){
				$urlproforma = ROOT."container_receiving/print_proforma";
				$urlproforma2 = ROOT."container_receiving/print_proforma_thermal";
				$urlnota = ROOT."container_receiving/print_nota";
				$urlcard = ROOT."container_receiving/print_card2";
				$urlcardthermal = ROOT."container_receiving/print_card_thermal";
			}
			else if(($row['MODUL_DESC'] == 'DELIVERY')or($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY')){
				$urlproforma = ROOT."container/download_proforma_delivery";
				$urlproforma2 = ROOT."container/dw_prodelv_thermal";
				$urlnota = ROOT."container/download_invoice_delivery";
				$urlcard = ROOT."container/print_card_delivery"	;
				$urlcardthermal = "";
				$urlcard_blanko = ROOT."container/print_card_delply";
			}
			else if (($row['MODUL_DESC'] == 'CALBG') OR ($row['MODUL_DESC'] == 'CALDG') OR ($row['MODUL_DESC'] == 'CALAG')){
				$urlproforma = ROOT."container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT."container_alihkapal/download_probm_thermal";
				$urlnota = ROOT."container_alihkapal/download_invoice_bm";
				if (($row['MODUL_DESC'] == 'CALBG') OR ($row['MODUL_DESC'] == 'CALDG'))
					$urlcard = ROOT."container_alihkapal/download_card_bm";
				else
					$urlcard = ROOT."container_alihkapal/download_card_bmdel";
				$urlcardthermal = "";
			}
			else {
				$urlproforma = ROOT."container/download_proforma_ext_delivery";
				$urlproforma2 = ROOT."container/dw_prodelv_thermal";
				$urlnota = ROOT."container/download_nota_ext_delivery";
				$urlcard = ROOT."container/print_card_delivery";
				$urlcardthermal = "";
			}

			if($row['STATUS_REQ']=="N"){
				$label_span='<span class="label label-info">Draft</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="W"){
				$label_span='<span class="label label-warning">Waiting Approve</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="R"){
				$label_span='<span class="label label-danger" title="'.$row['REJECT_NOTES'].'">Reject</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="S"){
				$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'>
				<i class='fa fa-file-pdf-o'></i></a>";
				//if($cekship=='Y')
				if(1)
				{
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				}
				else
				{
					$proformalink2 = "";
				}

				$proformalink=$proformalink1.$proformalink2;
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="P" || $row['STATUS_REQ']=="T"){
				$label_span='<span class="label label-success">Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a>";
				$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a> ";
				//$notalink = "";
				if($row['TERMINAL_ID'] != 'PNJD')
				{
					if($row['TERMINAL_ID'] != 'PNJI')
					{
							$enc_trx_number = $this->mx_encryption->encrypt($row['TRX_NUMBER']);
							if($row['TERMINAL_ID'] == 'L2D' || $row['TERMINAL_ID'] == 'L2I')
							{
								$notalink .= '<a target="_blank" title = "Nota E-Invoice" class="btn btn-warning" href="' . ROOT . 'einvoice/nota/cetak_barang/barang/' . $enc_trx_number .'"><i class="fa fa-print" ></i></a>';
							} else if($row['TERMINAL_ID'] == 'PLMI' || $row['TERMINAL_ID'] == 'PLMD' || $row['TERMINAL_ID'] == 'PNKD' || $row['TERMINAL_ID'] == 'PNKI'){

							}
							else
							{
								$notalink .= '<a target="_blank" title = "Nota E-Invoice" class="btn btn-warning" href="'.ROOT.'einvoice/nota/cetak_nota/petikemas/'.$enc_trx_number.'"><i class="fa fa-print"></i></a>';								
							}
					} else {
						$notalink .= '<a target="_blank" title = "Nota E-Invoice" class="btn btn-warning" href="' . ROOT . 'einvoice/nota/cetak_barang/barang/' . $enc_trx_number .'"><i class="fa fa-print" ></i></a>';
					}						
				} else {
					$notalink .= '<a target="_blank" title = "Nota E-Invoice" class="btn btn-warning" href="' . ROOT . 'einvoice/nota/cetak_barang/barang/' . $enc_trx_number .'"><i class="fa fa-print" ></i></a>';
				}					
				$cardlink = "<a class='btn btn-primary' target='_blank' href='".$urlcard."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
				if(($row['MODUL_DESC'] == 'DELIVERY')||($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY')){
					$cardlink .= " <a title='SP2 Blanko' class='btn btn-success' $disable_card target='_blank' href='".$urlcard_blanko."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-files-o'></i></a>";
				}
				if($row['MODUL_DESC'] == 'RECEIVING'){
					$cardthermallink = "<a class='btn btn-primary' target='_blank' $disable_card href='".$urlcardthermal."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
				}
				else
					$cardthermallink = "-";

				//if($cekship=='Y')
				if(1)
				{
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				}
				else
				{
					$proformalink2 = "";
				}
				$proformalink=$proformalink1.$proformalink2;
			} else {
				$label_span='<span class="label label-danger">N/A</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}

			if($group_id=="m")
			{
				$cardlink = "<a class='btn btn-primary' disabled href=''><i class='fa fa-file-text-o'></i></a>";
				$cardthermallink = "<a class='btn btn-primary'  disabled  href=''><i class='fa fa-file-text-o'></i></a>";
			}
		
			$is_shipping=$this->master_model->cek_shippingline();
			if($is_shipping=='N'){
					$this->table->add_row(
							$i++,
							$this->security->xss_clean($row['REQUEST_ID']),
							//$row['BILLER_REQUEST_ID'],
							$this->security->xss_clean($row['VESVOY']),
							$this->security->xss_clean($row['TERMINAL_NAME']),
							$this->security->xss_clean($row['REQUEST_DATE']),
							$label_span,
							$view_link,
							$proformalink,
							$notalink,
							$cardlink,
							$cardthermallink
						);
			}
			else
			{
					$this->table->add_row(
							$i++,
							$this->security->xss_clean($row['REQUEST_ID']),
							//$row['BILLER_REQUEST_ID'],
							$this->security->xss_clean($row['VESVOY']),
							$this->security->xss_clean($row['TERMINAL_NAME']),
							$this->security->xss_clean($row['REQUEST_DATE']),
							$label_span,
							$view_link,
							$proformalink,
							$notalink,
							$cardlink,
							$cardthermallink
						);
			}
		}

		$data['search'] = $search;

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Billing Management", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Billing Management"; //get_content($this->user_model,"billing_management","billing_management");

		$this->common_loader($data,'pages/container/billing_management');

    }

	public function search_billing_management()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$group_id = $this->session->userdata('group_phd');
		
		
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search=isset($_POST['search']) ? htmLawed($_POST['search']) : 10;

		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
		$cekship=$this->master_model->cek_shippingline();
		//create table
		$result=$this->container_model->getNumberReqAndSourceBySearch($customer_id,$submitter_customer_id,$search);

		$is_shipping=$this->master_model->cek_shippingline();
		if($is_shipping=='N'){
			$this->table->set_heading(
						"NO",
						"REQUEST NO",
						"VESSEL - VOYAGE",
						"PORT - TERMINAL",
						"DATE REQUEST",
						"STATUS",
						"VIEW",
						"PROFORMA",
						"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
						"CARD",
						"CARD THERMAL"
					);
		}
		else
		{
			$this->table->set_heading(
						"NO",
						"REQUEST NO",
						"VESSEL - VOYAGE",
						"PORT - TERMINAL",
						"DATE REQUEST",
						"STATUS",
						"VIEW",
						"PROFORMA",
						"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
						"CARD",
						"CARD THERMAL"
					);
		}

		//echo var_dump($result);die;
		$i=1;
		foreach ($result as $row)
		{
			$label_span="";
			$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
			$urlcard_blanko="";
			if($row['MODUL_DESC'] == 'RECEIVING'){
				$urlproforma = ROOT."container_receiving/print_proforma";
				$urlproforma2 = ROOT."container_receiving/print_proforma_thermal";
				$urlnota = ROOT."container_receiving/print_nota";
				$urlcard = ROOT."container_receiving/print_card2";
				$urlcardthermal = ROOT."container_receiving/print_card_thermal";
			}
			else if(($row['MODUL_DESC'] == 'DELIVERY')or($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY')){
				$urlproforma = ROOT."container/download_proforma_delivery";
				$urlproforma2 = ROOT."container/dw_prodelv_thermal";
				$urlnota = ROOT."container/download_invoice_delivery";
				$urlcard = ROOT."container/print_card_delivery"	;
				$urlcardthermal = "";
				$urlcard_blanko = ROOT."container/print_card_delply";
			}
			else if (($row['MODUL_DESC'] == 'CALBG') OR ($row['MODUL_DESC'] == 'CALDG') OR ($row['MODUL_DESC'] == 'CALAG')){
				$urlproforma = ROOT."container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT."container_alihkapal/download_probm_thermal";
				$urlnota = ROOT."container_alihkapal/download_invoice_bm";
				if (($row['MODUL_DESC'] == 'CALBG') OR ($row['MODUL_DESC'] == 'CALDG'))
					$urlcard = ROOT."container_alihkapal/download_card_bm";
				else
					$urlcard = ROOT."container_alihkapal/download_card_bmdel";
				$urlcardthermal = "";
			}
			else {
				$urlproforma = ROOT."container/download_proforma_ext_delivery";
				$urlproforma2 = ROOT."container/dw_prodelv_thermal";
				$urlnota = ROOT."container/download_nota_ext_delivery";
				$urlcard = ROOT."container/print_card_delivery";
				$urlcardthermal = "";
			}

			if($row['STATUS_REQ']=="N"){
				$label_span='<span class="label label-info">Draft</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="W"){
				$label_span='<span class="label label-warning">Waiting Approve</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="R"){
				$label_span='<span class="label label-danger" title="'.$row['REJECT_NOTES'].'">Reject</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="S"){
				$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'>
				<i class='fa fa-file-pdf-o'></i></a>";
				//if($cekship=='Y')
				if(1)
				{
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				}
				else
				{
					$proformalink2 = "";
				}

				$proformalink=$proformalink1.$proformalink2;
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			else if($row['STATUS_REQ']=="P" || $row['STATUS_REQ']=="T"){
				$label_span='<span class="label label-success">Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a>";
				$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a> ";
				if($row['TERMINAL_ID'] != 'PNJD')
				{
					if($row['TERMINAL_ID'] != 'PNJI')
					{
							$enc_trx_number = $this->mx_encryption->encrypt($row['TRX_NUMBER']);
							if($row['TERMINAL_ID'] == 'L2D' || $row['TERMINAL_ID'] == 'L2I')
							{
								$notalink .= '<a target="_blank" title = "Nota E-Invoice" class="btn btn-warning" href="' . ROOT . 'einvoice/nota/cetak_barang/barang/' . $enc_trx_number .'"><i class="fa fa-print" ></i></a>';
							}
							else
							{
								$notalink .= '<a target="_blank" title = "Nota E-Invoice" class="btn btn-warning" href="'.ROOT.'einvoice/nota/cetak_nota/petikemas/'.$enc_trx_number.'"><i class="fa fa-print"></i></a>';								
							}
					}					
				}						
				$cardlink = "<a class='btn btn-primary' target='_blank' href='".$urlcard."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
				if($row['MODUL_DESC'] == 'DELIVERY'){
					$cardlink .= " <a title='SP2 Blanko' class='btn btn-success' target='_blank' href='".$urlcard_blanko."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-files-o'></i></a>";
				}
				if($row['MODUL_DESC'] == 'RECEIVING'){
					$cardthermallink = "<a class='btn btn-primary' target='_blank' href='".$urlcardthermal."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
				}
				else
					$cardthermallink = "-";

				//if($cekship=='Y')
				if(1)
				{
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				}
				else
				{
					$proformalink2 = "";
				}
				$proformalink=$proformalink1.$proformalink2;
			} else {
				$label_span='<span class="label label-danger">N/A</span>';
				$proformalink ="-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}
			
			if($group_id=="m")
			{
				$cardlink = "<a class='btn btn-primary' disabled href=''><i class='fa fa-file-text-o'></i></a>";
				$cardthermallink = "<a class='btn btn-primary'  disabled  href=''><i class='fa fa-file-text-o'></i></a>";
			}
			
			$is_shipping=$this->master_model->cek_shippingline();
			if($is_shipping=='N'){
					$this->table->add_row(
							$i++,
							$this->security->xss_clean($row['REQUEST_ID']),
							//$row['BILLER_REQUEST_ID'],
							$this->security->xss_clean($row['VESVOY']),
							$this->security->xss_clean($row['TERMINAL_NAME']),
							$this->security->xss_clean($row['REQUEST_DATE']),
							$label_span,
							$view_link,
							$proformalink,
							$notalink,
							$cardlink,
							$cardthermallink
						);
			}
			else
			{
					$this->table->add_row(
							$i++,
							$this->security->xss_clean($row['REQUEST_ID']),
							//$row['BILLER_REQUEST_ID'],
							$this->security->xss_clean($row['VESVOY']),
							$this->security->xss_clean($row['TERMINAL_NAME']),
							$this->security->xss_clean($row['REQUEST_DATE']),
							$label_span,
							$view_link,
							$proformalink,
							$notalink,
							$cardlink,
							$cardthermallink
						);
			}
		}

		$this->load->view('pages/container/search_billing_management', $data);
	}

	public function search_main_delivery(){
		//echo "hahaha";
		//die();
		$this->redirect();
		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
		$group_id = $this->session->userdata('group_phd');

		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search=isset($_POST['search']) ? htmLawed($_POST['search']) : 10;
		//create table
		$result=$this->container_model->getNumberReqAndSourceDeliveryBySearch($customer_id,$submitter_customer_id,$search);
		//create table
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>NO REQUEST</th>",
		  "<th width='100px'>DATE REQUEST</th>",
		  "<th width='100px'>STATUS</th>",
		  "<th width='100px'>VESSEL - VOYAGE</th>",
		  "<th width='100px'>PELABUHAN/TERM.</th>",
		  "<th width='100px'>TIPE DELIVERY</th>",
		  "<th width='100px'>DATE DELIVERY</th>",
		  "<th width='100px'>CONTAINER QUANTITY</th>",
		  "<th width='50px'>VIEW</th>",
		  "<th width='50px'>EDIT</th>",
		  //"<th width='50px'>" . get_content($this->user_model,"delivery","cancel") . "</th>",
		  "<th width='80px'>REQUEST CONFIRM"
		 );

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		//$customer_id=$this->session->userdata('customerid_phd');
		/* $in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
			</data>
		</root>"; */

/* 		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getRequestDeliveryHeaderCompressed",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);

			if(isset($obj->data->request))
			{ */

				$i=1;
				foreach($result as $row)
				{
					$label_span='<span class="label label-default">N/A</span>';
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link='<span class="label label-default">N/A</span>';
					$cancel_link='<span class="label label-default">N/A</span>';
					$confirm_link='<span class="label label-default">N/A</span>';
					if($row['STATUS_REQ']=="N"){
						$label_span='<span class="label label-info">Draft</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/cancel_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
					} else if($row['STATUS_REQ']=="S"){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					} else if($row['STATUS_REQ']=="P" || $row['STATUS_REQ']=="T"){
						$label_span='<span class="label label-success">Paid</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					}
					else if($row['STATUS_REQ'] == 'W'){
						$label_span='<span class="label label-warning">Waiting Approve</span>';
					}
					else if($row['STATUS_REQ'] == 'R'){
						$label_span='<span class="label label-danger" title="'.$row['REJECT_NOTES'].'">Rejected</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/edit_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container/cancel_delivery/".$row['REQUEST_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else {
						$label_span='<span class="label label-default">N/A</span>';
					}

					if ($row['CONT_QTY'] == 'DB DOWN'){
						$view_link = $edit_link = $confirm_link = "DB DOWN";
					}

					if ($row['DEL_VIA'] == 'LAP')
					{
						$del_via = 'YARD';
					}
					else if ($row['DEL_VIA'] == 'TL')
					{
						$del_via = 'TL';
					}
					else
					{
						$del_via = '';
					}

					$this->table->add_row(
						$i++,
						$row['REQUEST_ID'],
						$row['REQUEST_DATE'],
						$label_span,
						$row['VESVOY'],
						$row['TERMINAL_NAME']."/".$row['PORT'],
						$del_via,
						$row['ADDITIONAL_DATE'],
						$row['CONT_QTY'],
						$view_link,
						$edit_link,
						//$cancel_link,
						$confirm_link
					);
				}
		/* 	} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		} */

		$this->load->view('pages/container/search_main_delivery', $data);;
	}

	public function payment(){

		$this->redirect();

		//create table
		$this->table->set_heading('NO', '', 'REQUEST NUMBER', 'VESSEL - VOYAGE', 'PORT - TERMINAL', 'REQUEST DATE','STATUS','DOWNLOAD PROFORMA');

		$customer_id=$this->session->userdata('custid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');

		$result=$this->container_model->getReqNotPaidByCust($customer_id,$submitter_customer_id);
		$i=0;
		$cekship=$this->master_model->cek_shippingline();
		foreach ($result as $row)
		{
			/*Bedakan display TPK dan PTP*/
            $kdPrf=substr(str_replace(".","",$row['PRF_NUMBER']), 0, 6);
			$kdPrf2=substr(str_replace(".","",$row['PRF_NUMBER']), 0, 5);
            // $tpkPriok = array('010811','010812','010813','010821','010822','010831','010816');
            $tpkPriok = array('010811','010812','010813','010821','010822','010831','010816','010804','011804','010100','011805','010805','010030');
            $tpk09 = array('95811','95812','95813','95821','95822','95020','95802','95806','92501','95015','91501','95015','95803','95040'); //panjang masuk ke TPK

			$type = in_array($kdPrf, $tpkPriok) || in_array($kdPrf2, $tpk09) ? "TPK":"PTP";
            
			$label_span="";

			$inv_char = array("+");
			$fix_char = array(" ");

			$vessel_get=str_replace($inv_char,$fix_char,urlencode($row['VESSEL']));
			$voyage_in_get=urlencode($row['VOYAGE_IN']);
			$voyage_out_get=urlencode($row['VOYAGE_OUT']);

			if($row['MODUL_DESC'] == 'RECEIVING'){
				$urlproforma = ROOT."container_receiving/print_proforma";
				$urlproforma2 = ROOT."container_receiving/print_proforma_thermal";
				$urlnota = ROOT."container_receiving/print_nota";
				$urlcard = ROOT."container_receiving/print_card2";
			}
			else if($row['MODUL_DESC'] == 'DELIVERY'){
				$urlproforma = ROOT."container/download_proforma_delivery";
				$urlproforma2 = ROOT."container/dw_prodelv_thermal";
				$urlnota = ROOT."container/download_invoice_delivery";
				$urlcard = ROOT."container/print_card_delivery";
			}
			else if($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY'){
				$urlproforma = ROOT."container/download_proforma_delivery";
				$urlproforma2 = ROOT."container/dw_prodelv_thermal";
				$urlnota = ROOT."container/download_nota_ext_delivery";
				$urlcard = ROOT."container/print_card_delivery";
			}
			else if($row['MODUL_DESC'] == 'CALBG'){
				$urlproforma = ROOT."container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT."container_alihkapal/download_probm_thermal";
				$urlnota = ROOT."container_alihkapal/download_invoice_bm";
				$urlcard = ROOT."container_alihkapal/download_card_bm";
			}
			else if($row['MODUL_DESC'] == 'CALAG'){
				$urlproforma = ROOT."container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT."container_alihkapal/download_probm_thermal";
				$urlnota = ROOT."container_alihkapal/download_invoice_bm";
				$urlcard = ROOT."container_alihkapal/download_card_bm";
			}
			else if($row['MODUL_DESC'] == 'CALDG'){
				$urlproforma = ROOT."container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT."container_alihkapal/download_probm_thermal";
				$urlnota = ROOT."container_alihkapal/download_invoice_bm";
				$urlcard = ROOT."container_alihkapal/download_card_bm";
			}

			if($row['CONFIRMED']>0)
			{
				$confirmed = '<span class="badge badge-success"><i class="fa fa-check"> confirmed</span>';
			}
			else
				$confirmed = '';

			if($row['STATUS_REQ']=="N"){
				$label_span='<span class="label label-info">Draft</span>';
				$download_proforma="-";
				$payment="-";
				$download_invoice="-";
				$download_card="-";
				$checkbox = "";
			} else if($row['STATUS_REQ']=="W"){
				$label_span='<span class="label label-warning">Waiting Approve</span>';
				$download_proforma="-";
				$payment="-";
				$download_invoice="-";
				$download_card="-";
				$checkbox = "";
			} else if($row['STATUS_REQ']=="R"){
				$label_span='<span class="label label-danger">Reject</span>';
				$download_proforma="-";
				$payment="-";
				$download_invoice="-";
				$download_card="-";
				$checkbox = "";
			} else if($row['STATUS_REQ']=="S"){
				$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'>
				<i class='fa fa-file-pdf-o'></i></a>";
				if($cekship=='Y')
				{
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				}
				else
				{
					$proformalink2 = "";
				}

				$download_proforma=$proformalink1.$proformalink2;


				$payment='<a class="btn btn-primary" href="'.ROOT."container/payment_confirmation/".$row['REQUEST_ID'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'/'.$row['PRF_NUMBER'].'/'.$vessel_get.'/'.$voyage_in_get.'/'.$voyage_out_get.'" title="Konfirmasi Pembayaran"><i class="fa fa-money"></i></a>
				'.$confirmed;
				$download_invoice="-";
				$download_card="-";
				$checkbox = '<input type="checkbox" id="id_proforma" name="id_proforma[]" value="'.$row['PRF_NUMBER'].'"/>';
			} else if($row['STATUS_REQ']=="P" || $row['STATUS_REQ']=="T"){
				$label_span='<span class="label label-success">Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'>
				<i class='fa fa-file-pdf-o'></i></a>";
				if($cekship=='Y')
				{
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				}
				else
				{
					$proformalink2 = "";
				}

				$download_proforma=$proformalink1.$proformalink2;
				$payment='-';
				$download_invoice='<a class="btn btn-primary" href="'.$urlnota."/".$row['REQUEST_ID'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'" title="Download Nota"><i class="fa fa-file-pdf-o"></a>';
				$download_card='<a class="btn btn-primary" href="'.$urlcard."/".$row['REQUEST_ID'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'" title="Download Kartu"><i class="fa fa-file-pdf-o"></a>';
				$checkbox = "";
			} else {
				$label_span='<span class="label label-danger">N/A</span>';
				$download_proforma="-";
				$payment='-';
				$download_invoice="-";
				$download_card="-";
				$checkbox = "";
			}

			$this->table->add_row(
				++$i,
				$checkbox."<input type='hidden' name='type[]' value='$type' disabled='disabled'/>",
				$this->security->xss_clean($row['REQUEST_ID'])."<span style='display:none'>$type</span>",
				$this->security->xss_clean($row['VESSEL'])." ".$this->security->xss_clean($row['VOYAGE_IN'])."-".$this->security->xss_clean($row['VOYAGE_OUT']),
				$this->security->xss_clean($row['PORT_ID'])."-".$this->security->xss_clean($row['TERMINAL_ID']),
				$this->security->xss_clean($row['REQUEST_DATE']),
				$label_span,
				$download_proforma//,
				//$payment
//						$download_invoice,
//						$download_card
			);
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Invoice and Payment', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Invoice and Payment';

		$this->common_loader($data,'pages/container/payment');
	}

	public function payment_history()
	{
		$branch_id = $this->session->userdata('sub_group_phd');
		$customer_id = $this->session->userdata('customerid_phd');
		
		

		if ((strpos($branch_id, 'J2') !== false) || (strpos($branch_id, 'J3') !== false) || (strpos($branch_id, 'J4') !== false) ||
		(strpos($branch_id, 'J1') !== false) || (strpos($branch_id, 'J5') !== false)) {
			$app_id = "ebpp_01";
			$user = "ptp";
			$pass = "ptp";
		} else if ((strpos($branch_id, 'P3') !== false) || (strpos($branch_id, 'P5') !== false)) {
			$app_id = "ebpp_01";
			$user = "panjang";
			$pass = "panjang";
		}

		$key = base64_encode(sha1("SeIPel2".$app_id.$user.$pass.$customer_id));

		$data['url'] = IPAY_LOG."?app_id=".$app_id."&user=".$user."&pass=".$pass."&cust_id=".$customer_id."&key=".$key;
		$this->common_loader($data,'pages/epayment/payment_history_ilcs');
	}

	public function upload_doc($req,$varfile)
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		$file = '';

		try
        {
			if($varfile=='do_upload')
			{
				$folderfile='upload_do';
				$file = basename($_FILES['do_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='sppb_upload')
			{
				$folderfile='upload_sppb';
				$file = basename($_FILES['sppb_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='sp_custom_upload')
			{
				$folderfile='upload_sp_custom';
				$file = basename($_FILES['sp_custom_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='peb_upload')
			{
				$folderfile='upload_peb';
				$file = basename($_FILES['peb_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='npe_upload')
			{
				$folderfile='upload_npe';
				$file = basename($_FILES['npe_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='booking_ship_upload')
			{
				$folderfile='upload_bookingship';
				$file = basename($_FILES['booking_ship_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='booking_ship_upload_dom')
			{
				$folderfile='upload_bookingship';
				$file = basename($_FILES['booking_ship_upload_dom']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			else if($varfile=='lainnya_upload')
			{
				$folderfile='upload_sp_custom';
				$file = basename($_FILES['lainnya_upload']['name'], '.pdf');
				if ($file != "") {$file = $file.'-'.time();}
			}
			$path= UPLOADFOLDER_.$folderfile;
			$config = array(
				'upload_path' => $path,
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'file_name' => $file,
				'max_width' => "1024"
			);

			$this->load->library('upload');
            $this->upload->initialize($config);
			$this->upload->do_upload($varfile);
			$data=$this->upload->data();
			$fullpath=APP_ROOT.$folderfile."/".$data['file_name']; //file_name
			echo $this->upload->display_errors('<p>', '</p>');

			$fullfile = $path."/".$data['file_name']; //full file_name
			log_message('debug', 'value fullfile: '.$fullfile);
			$this->scan_virus($fullfile); //scan file disini

			injek($folderfile);
			injek($req);
			injek($fullpath);
			injek($data['file_name']);
			if(isset($data['file_name'])&&$data['file_name']!="")//kalau tidak ada filenya jangan di simpan di log
				$this->container_model->update_docfile($folderfile,$req,$fullpath,$data['file_name'],$this->session->userdata('uname_phd'));

            echo "sukses";
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            echo show_error($err->getMessage());
		}
	}

	public function scan_virus($file) {
		/* contoh result scan clamav
		file valid				-> index.php: OK ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 0 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 13.927 sec (0 m 13 s)
		file terinfeksi virus	-> eicar.com.txt: Eicar-Test-Signature FOUND ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 1 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 14.098 sec (0 m 14 s) */
		$scan_process = shell_exec('clamscan '.$file);
		log_message('debug', 'hasil scan: '.$scan_process);
		if(strpos($scan_process, 'OK') != false) {
			log_message('debug', 'hasil scan file: '.$file.' tidak terinfeksi virus.');
			return 'lolos';
		} else {
			log_message('debug', 'hasil scan file: '.$file.' terinfeksi virus');
			return 'infected';
		}
	}

	public function confirm_request() {
		$this->redirect();

		$req=htmLawed($_POST['REQUEST']);

		$status_req = $this->container_model->getStatusRequest($req);
		
		if($status_req =="W")
		{
			echo "Failed, Request Already Confirm";
			die();
		}
		else if($status_req =="S")
		{
			echo "Failed, Request Already Approve";
			die();			
		}
		else if($status_req =="P")
		{
			echo "Failed, Request Already Paid";
			die();			
		}
		
		$reqNoBiller = $this->container_model->getNumberRequestBiller($req);
		$kodeModul = $this->container_model->getKodeModul($req);
		$detail = $this->container_model->getDetailBilling($req);

		switch($kodeModul)
		{
			case "PTKM00"://receiving
				$wsdl = REQUEST_RECEIVING_CONTAINER;
			break;
			case "PTKM01"://delivery
				$wsdl = REQUEST_DELIVERY_CONTAINER;
			break;
			case "PTKM07"://delivery perpanjangan
				$wsdl = REQUEST_PERPANJANGAN_DELIVERY;
			break;
			case "PTKM08"://batal muat
				$wsdl = REQUEST_BATALMUAT;
			break;
			default:
				$wsdl = "not defined modul";
			break;
		}

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<biller_request_id>$reqNoBiller</biller_request_id>
				<port_code>".$detail['PORT_ID']."</port_code>
				<terminal_code>".$detail['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,"getCountContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->rc!="S")
			{
				echo $obj->rcmsg;
				die;
			}
		}

		$is_shipping = $this->master_model->cek_shippingline();
		if($is_shipping == 'Y' && $detail['TERMINAL_ID']<>'T3I' && $detail['TERMINAL_ID']<>'PNJI' && $detail['TERMINAL_ID']<>'DJBD' && $detail['TERMINAL_ID']<>'DJBI' && $detail['TERMINAL_ID']<>'TLBD' && $detail['TERMINAL_ID']<>'TLBI' && $detail['TERMINAL_ID']<>'PLMI' && $detail['TERMINAL_ID']<>'PLMD' && $detail['TERMINAL_ID']<>'PNKD' && $detail['TERMINAL_ID']<>'PNKI'){
				$this->container_model->confirmRequest($req,$this->session->userdata('uname_phd'));
				switch($kodeModul)
				{
					case "PTKM00"://receiving
						$in_data="<root>
										<sc_type>1</sc_type>
										<sc_code>123456</sc_code>
										<data>
												<detail>
														<request_no>$reqNoBiller</request_no>
														<port_code>".$detail['PORT_ID']."</port_code>
														<terminal_code>".$detail['TERMINAL_ID']."</terminal_code>
														<user_id>".$this->session->userdata('uname_phd')."</user_id>
												</detail>
										</data>
								</root>";

						if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"submitRequestReceiving",array("in_data" => "$in_data"),$result))
						{
								echo $result;
								exit;
						}
						else
						{	
							
								$rwresult = json_decode($result);
								if($rwresult->rc == 'S'){
										echo "Success";
								}
								else{
										echo "Failed, ".$rwresult->rcmsg;
								}
								die();
						}
					break;
					case "PTKM01"://delivery
						//$wsdl = REQUEST_DELIVERY_CONTAINER;
						$in_data="	<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<no_request>$reqNoBiller</no_request>
									<port_code>".$detail['PORT_ID']."</port_code>
									<terminal_code>".$detail['TERMINAL_ID']."</terminal_code>
									<user_id>".$this->session->userdata('uname_phd')."</user_id>
								</data>
							</root>";

							if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"saveRequestDelivery",array("in_data" => "$in_data"),$result))
							{
									echo $result;
									exit;
							}
							else
							{
									//echo $result;die;
									$rwresult = json_decode($result);
									if($rwresult->rc == 'S'){
											echo "Success";
									}
									else{
											echo "Failed, ".$rwresult->rcmsg;
									}
									die();
							}

					break;
					case "PTKM07"://delivery perpanjangan
						//$wsdl = REQUEST_PERPANJANGAN_DELIVERY;
						$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_request>$reqNoBiller</no_request>
								<port_code>".$detail['PORT_ID']."</port_code>
								<terminal_code>".$detail['TERMINAL_ID']."</terminal_code>
								<user_id>".$this->session->userdata('uname_phd')."</user_id>
							</data>
						</root>";

						if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"submitRequestDeliveryPerp",array("in_data" => "$in_data"),$result))
						{
								echo $result;
								exit;
						}
						else
						{
								$rwresult = json_decode($result);
								if($rwresult->rc == 'S'){
										echo "Success";
								}
								else{
										echo "Failed, ".$rwresult->rcmsg;
								}
								die();
						}
					break;
					case "PTKM08"://batal muat
							//$wsdl = REQUEST_BATALMUAT;
							$in_data="<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<no_request>$reqNoBiller</no_request>
									<port_code>".$detail['PORT_ID']."</port_code>
									<terminal_code>".$detail['TERMINAL_ID']."</terminal_code>
									<user_id>".$this->session->userdata('uname_phd')."</user_id>
								</data>
							</root>";

							//print_r($in_data);die;
							if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"saveRequestBatalMuat",array("in_data" => "$in_data"),$result))
							{
									echo $result;
									die;
							}
							else
							{
									$rwresult = json_decode($result);
									if($rwresult->rc == 'S'){
											echo "Success";
									}
									else{
											echo "Failed, ".$rwresult->rcmsg;
									}
									die();
							}
					break;
					default:
						$wsdl = "not defined modul";
					break;
				}
			}  	else {
					echo $this->container_model->confirmRequest($req,$this->session->userdata('uname_phd'));
				}
	}

	public function reject_request(){
		$this->redirect();

		$req=$_POST['REQUEST'];
		$reject_notes=$_POST['REJECT_NOTES'];


		echo $this->container_model->rejectRequest($req,$reject_notes,$this->session->userdata('uname_phd'));		
		$results = $this->container_model->getUserInfoByRequestNumber($req);
    $from	= "";
		$to 	= $results["EMAIL"];
		$subject = "Request Rejected Notification - ".$req;
		$content = "Yth. ".$results["NAME"].",\n\n
					Request Anda dengan Nomor Request ".$req."/".$results["BILLER_REQUEST_ID"]." telah ditolak dengan alasan berikut:<br>
					$reject_notes.\n\n
					Untuk informasi dan bantuan lebih lanjut, mohon menghubungi Customer Service kami.\n\n
					Terima kasih,\n
					PT IPC Terminal Petikemas\n
						Gedung Terminal Operasi 3, Lantai 2 & 3\n
						Jalan Raya Pelabuhan No. 23\n
						Tanjung Priok, Jakarta Utara 14310\n
					\n\n\n
					Dear ".$results["NAME"].",\n\n
					Your booking request with request number ".$req."/".$results["BILLER_REQUEST_ID"]." has been rejected with the following reason :
					\n
					$reject_notes.\n\n
					For any information and inquiries, please call our customer service.<br>
					\n\n
					Warm Regards,
					\n
					PT IPC Terminal Petikemas\n
						Gedung Terminal Operasi 3, Lantai 2 & 3\n
						Jalan Raya Pelabuhan No. 23\n
						Tanjung Priok, Jakarta Utara 14310\n
					";

		$rs = $this->user_model->email_notification($from, $to, $subject, $content);


	}

	public function add_delivery() {

		$this->redirect();

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Delivery Booking", '/container/main_delivery');
		$this->breadcrumbs->push("Create New Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Create New Booking";

        $in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>IDJKT</port_code>
				<terminal_code>T3I</terminal_code>
			</data>
		</root>";

		//echo $in_data; die;
		$infos = array();
		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getListSPPB",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
            $obj2 = json_decode($result);
			//print_r($obj2);die;
			if($obj2->data->listsppb)
			{
				for($j=0;$j<count($obj2->data->listsppb);$j++)
				{
			        $info = array(
							'ID_DOKUMEN' => $obj2->data->listsppb[$j]->id_dokumen,
							'NAMA_DOKUMEN' => $obj2->data->listsppb[$j]->nama_dokumen
					);					
					array_push($infos, $info);					
				}
			}
			$data['sppbtype'] = $infos;
		}

		

		$this->common_loader($data,'pages/container/add_delivery');
	}

	public function edit_delivery($no_request,$message=null){

		$this->redirect();

		$data['request_data']=$this->container_model->get_request_delivery($no_request);		
				
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<request_id>$reqNoBiller</request_id>
				<port_code>".$data['request_data'][0]['PORT_ID']."</port_code>
				<terminal_code>".$data['request_data'][0]['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getRequestDelivery",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//var_dump($obj); die;
			if($obj->data->request)
			{
				//--------------------------------------------

				$data['request_data'][0]['ID_REQ'] = $no_request;
				$data['request_data'][0]['ID_VES_VOYAGE'] = $obj->data->request[0]->id_ves_voyage;
				$data['request_data'][0]['VESSEL'] = $obj->data->request[0]->vessel;
				$data['request_data'][0]['VESSEL_CODE'] = $obj->data->request[0]->vessel_code;
				$data['request_data'][0]['CALL_SIGN'] = $obj->data->request[0]->call_sign;
				$data['request_data'][0]['VOYAGE_IN'] = $obj->data->request[0]->voyage_in;
				$data['request_data'][0]['VOYAGE_OUT'] = $obj->data->request[0]->voyage_out;
				$data['request_data'][0]['CUSTOMER_ID'] = $obj->data->request[0]->customer_id;
				$data['request_data'][0]['CUSTOMER_NAME'] = $obj->data->request[0]->customer_name;
				$data['request_data'][0]['ADDRESS'] = $obj->data->request[0]->address;
				$data['request_data'][0]['NPWP'] = $obj->data->request[0]->npwp;
				$data['request_data'][0]['NO_DO'] = $obj->data->request[0]->no_do;
				$data['request_data'][0]['DATE_DO'] = $obj->data->request[0]->date_do;
				$data['request_data'][0]['TYPE_SPPB]'] = $obj->data->request[0]->type_sppb;
				$data['request_data'][0]['NO_SPPB'] = $obj->data->request[0]->no_sppb;
				$data['request_data'][0]['DATE_SPPB'] = $obj->data->request[0]->date_sppb;
				$data['request_data'][0]['NO_SP_CUSTOM'] = $obj->data->request[0]->no_sp_custom;
				$data['request_data'][0]['DATE_SP_CUSTOM'] = $obj->data->request[0]->date_sp_custom;
				$data['request_data'][0]['NO_BL'] = $obj->data->request[0]->no_bl;
				$data['request_data'][0]['DATE_DELIVERY'] = $obj->data->request[0]->date_delivery;
				$data['request_data'][0]['DATE_DISCHARGE'] = $obj->data->request[0]->date_discharge;
				$data['request_data'][0]['DATE_REQUEST'] = $obj->data->request[0]->date_request;
				$data['request_data'][0]['ID_USER'] = $obj->data->request[0]->id_user;
				$data['request_data'][0]['TL_FLAG'] = $obj->data->request[0]->tl_flag;
				$data['request_data'][0]['ID_PORT'] = $data['request_data'][0]['PORT_ID'];
				$data['request_data'][0]['ID_TERMINAL'] = $data['request_data'][0]['TERMINAL_ID'];
				$data['request_data'][0]['TERMINAL_NAME'] = $obj->data->request[0]->term_name;
				$data['request_data'][0]['VOYAGE'] = $obj->data->request[0]->voyage;
				$data['request_data'][0]['ETA'] = $obj->data->request[0]->eta;
				$data['request_data'][0]['ETD'] = $obj->data->request[0]->etd;
				$data['request_data'][0]['DO_FILE'] = $obj->data->request[0]->do_file;
				$data['request_data'][0]['NO_BOOKING'] = $obj->data->request[0]->no_booking;
				$data['request_data'][0]['DEV_VIA'] = $obj->data->request[0]->dev_via;
				{
					$file = explode("-",$data['request_data']['DO_FILE']);
					//var_dump($file);
					if($file[0]=="")
					{
						$data['request_data']['DO_FILE'] = "";
					}
				}
				$data['request_data'][0]['SPPB_FILE'] = $obj->data->request[0]->sppb_file;
				{
					$file = explode("-",$data['request_data']['SPPB_FILE']);
					//var_dump($file);
					if($file[0]=="")
					{
						$data['request_data']['SPPB_FILE'] = "";
					}
				}				
				$data['request_data'][0]['SP_CUSTOM_FILE'] = $obj->data->request[0]->sp_custom_file;
				{
					$file = explode("-",$data['request_data']['SP_CUSTOM_FILE']);
					//var_dump($file);
					if($file[0]=="")
					{
						$data['request_data']['SP_CUSTOM_FILE'] = "";
					}
				}				
			}
		}

		$data['message'] = $message;

		$data['terminal'] = $this->master_model->get_terminal();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Delivery Booking", '/container/main_delivery');
		$this->breadcrumbs->push("Edit Delivery Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Edit Delivery Booking";

		$this->common_loader($data,'pages/container/edit_delivery');
	}



	public function add_delivery_ext(){

		$this->redirect();
		
		$data['is_shipping'] = $this->master_model->cek_shippingline();
		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Extension Delivery", '/container/main_delivery_ext');
		$this->breadcrumbs->push("Add Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Extension Delivery Booking";

		$this->common_loader($data,'pages/container/add_delivery_ext');
	}

	public function edit_delivery_ext($norequest){

		$this->redirect();

		$data['request_data']=$this->container_model->get_request_ext_delivery($norequest);

		$reqNoBiller=$this->container_model->getNumberRequestBiller($norequest);

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<request_id>$reqNoBiller</request_id>
				<port_code>".$data['request_data']['PORT_ID']."</port_code>
				<terminal_code>".$data['request_data']['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getRequestDeliveryExt",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->request)
			{
				$data['request_data'][0]['ID_REQ'] = $no_request;
				$data['request_data'][0]['OLD_REQ'] = $obj->data->request[0]->old_req;
				$data['request_data'][0]['OLD_REQ_BILLING'] = $this->container_model->getNumberRequestEservice($obj->data->request[0]->old_req);
				$data['request_data'][0]['ID_VES_VOYAGE'] = $obj->data->request[0]->id_ves_voyage;
				$data['request_data'][0]['VESSEL'] = $obj->data->request[0]->vessel;
				$data['request_data'][0]['VESSEL_CODE'] = $obj->data->request[0]->vessel_code;
				$data['request_data'][0]['CALL_SIGN'] = $obj->data->request[0]->call_sign;
				$data['request_data'][0]['VOYAGE_IN'] = $obj->data->request[0]->voyage_in;
				$data['request_data'][0]['VOYAGE_OUT'] = $obj->data->request[0]->voyage_out;
				$data['request_data'][0]['CUSTOMER_ID'] = $obj->data->request[0]->customer_id;
				$data['request_data'][0]['CUSTOMER_NAME'] = $obj->data->request[0]->customer_name;
				$data['request_data'][0]['ADDRESS'] = $obj->data->request[0]->address;
				$data['request_data'][0]['NPWP'] = $obj->data->request[0]->npwp;
				$data['request_data'][0]['NO_DO'] = $obj->data->request[0]->no_do;
				$data['request_data'][0]['DATE_DO'] = $obj->data->request[0]->date_do;
				$data['request_data'][0]['TYPE_SPPB]'] = $obj->data->request[0]->type_sppb;
				$data['request_data'][0]['NO_SPPB'] = $obj->data->request[0]->no_sppb;
				$data['request_data'][0]['DATE_SPPB'] = $obj->data->request[0]->date_sppb;
				$data['request_data'][0]['NO_SP_CUSTOM'] = $obj->data->request[0]->no_sp_custom;
				$data['request_data'][0]['DATE_SP_CUSTOM'] = $obj->data->request[0]->date_sp_custom;
				$data['request_data'][0]['NO_BL'] = $obj->data->request[0]->no_bl;
				$data['request_data'][0]['DATE_DELIVERY'] = $obj->data->request[0]->date_delivery;
				$data['request_data'][0]['DATE_DELIVERY_OLD'] = $obj->data->request[0]->date_delivery_old;
				$data['request_data'][0]['DATE_DISCHARGE'] = $obj->data->request[0]->date_discharge;
				$data['request_data'][0]['DATE_REQUEST'] = $obj->data->request[0]->date_request;
				$data['request_data'][0]['ID_USER'] = $obj->data->request[0]->id_user;
				$data['request_data'][0]['TL_FLAG'] = $obj->data->request[0]->tl_flag;
				$data['request_data'][0]['DATE_EXT'] = $obj->data->request[0]->date_ext;
				$data['request_data'][0]['ID_PORT'] = $data['request_data']['PORT_ID'];
				$data['request_data'][0]['ID_TERMINAL'] = $data['request_data']['TERMINAL_ID'];
				$data['request_data'][0]['TERMINAL_NAME'] = $obj->data->request[0]->term_name;
				$data['request_data'][0]['VOYAGE'] = $obj->data->request[0]->voyage;
			}
		}

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Extension Delivery", '/container/main_delivery_ext');
		$this->breadcrumbs->push("Add Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Extension Delivery Booking";

		$this->common_loader($data,'pages/container/edit_delivery_ext');
	}

	public function auto_vessel_delivery(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["term"])));

		injek($term);

		$port			= explode("-",$this->security->xss_clean(htmlentities($_GET["port"])));
		$stack = array();

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getVesselVoyage",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result); die();

			$obj = json_decode($result);

			if($obj->data->vessel)
			{
				for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$temp;
					$temp['VESSEL']=$obj->data->vessel[$i]->vessel_name;
					$temp['VOYAGE_IN']=$obj->data->vessel[$i]->voyage_in;
					$temp['VOYAGE_OUT']=$obj->data->vessel[$i]->voyage_out;
					$temp['VOYAGE']=$obj->data->vessel[$i]->voyage;
					$temp['ETA']=$obj->data->vessel[$i]->eta;
					$temp['ETB']=$obj->data->vessel[$i]->etb;
					$temp['ETD']=$obj->data->vessel[$i]->etd;
					$temp['ATA']=$obj->data->vessel[$i]->ata;
					$temp['ATB']=$obj->data->vessel[$i]->atb;
					$temp['ATD']=$obj->data->vessel[$i]->atd;
					$temp['ID_VSB_VOYAGE']=$obj->data->vessel[$i]->id_vsb_voyage;
					$temp['VESSEL_CODE']=$obj->data->vessel[$i]->vessel_code;
					$temp['CALL_SIGN']=$obj->data->vessel[$i]->call_sign;
					$temp['DATE_DISCHARGE']=$obj->data->vessel[$i]->date_discharge;
					$temp['NO_BOOKING']=$obj->data->vessel[$i]->no_booking;
					array_push($stack, $temp);
				}
			}
		}

		$data['vessel'] = $stack;
			$this->load->library("table");
			$this->table->set_heading(
					'Vessel',
					'Voyage In',
					'Voyage Out',
					'ETA',
					'ETD',
					'Pilih'
				);

			$i=0;
			foreach ($stack as $t){
				$this->table->add_row(
					$t['VESSEL']." (".$t['NO_BOOKING'].")",
					$t['VOYAGE_IN'],
					$t['VOYAGE_OUT'],
					$t['ETA'],
					$t['ETD'],
					 '<a data-dismiss="modal" style="cursor:pointer" class="table-link click_detail bank_detail" onclick="complete(\''.$t['VESSEL'].'\',\''.$t['VOYAGE_IN'].'\',\''.$t['VOYAGE_OUT'].'\',\''.$t['VOYAGE'].'\',\''.$t['ID_VSB_VOYAGE'].'\',\''.$t['VESSEL_CODE'].'\',\''.$t['CALL_SIGN'].'\',
					 \''.$t['DATE_DISCHARGE'].'\',\''.$t['ETD'].'\',\''.$t['ETA'].'\',\''.$t['NO_BOOKING'].'\')"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				);
					$i++;
			}

			$this->load->view('pages/container/search_vessel_modal',$data);
	}

	public function auto_container_delivery(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$term			= strtoupper($_GET["term"]);
		$port			= explode("-",$_GET["port"]);
		$vessel_code	= $_GET["vessel_code"];
		$voyage_in		= $_GET["voyage_in"];
		$voyage_out		= $_GET["voyage_out"];
		$del_type		= $_GET["del_type"];
		$no_booking		= $_GET["no_booking"];
		$vessel 		= $_GET["vessel"];
		
		if($del_type=='LAP'){
			$del_type='YARD';
		}

		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_container>$term</no_container>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<vessel_code>$vessel_code</vessel_code>
				<voyage_in>$voyage_in</voyage_in>
				<voyage_out>$voyage_out</voyage_out>
				<del_type>$del_type</del_type>
				<no_booking>$no_booking</no_booking>
				<vessel>$vessel</vessel>
			</data>
		</root>";
		injek($in_data);

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getDetailContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			if($obj->data->container)
			{
				for($i=0;$i<count($obj->data->container);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->container[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->container[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->container[$i]->type_cont;
					$temp['STATUS_CONT']=$obj->data->container[$i]->status_cont;
					$temp['HEIGHT_CONT']=$obj->data->container[$i]->height_cont;
					$temp['ID_CONT']=$obj->data->container[$i]->id_cont;
					$temp['HZ']=$obj->data->container[$i]->hz;
					$temp['IMO_CLASS']=$obj->data->container[$i]->imo_class;
					$temp['UN_NUMBER']=$obj->data->container[$i]->un_number;
					$temp['ISO_CODE']=$obj->data->container[$i]->iso_code;
					$temp['TEMP']=$obj->data->container[$i]->temp;
					$temp['WEIGHT']=$obj->data->container[$i]->weight;
					$temp['CARRIER']=$obj->data->container[$i]->carrier;
					$temp['OOG']=$obj->data->container[$i]->oog;
					$temp['OVER_LEFT']=$obj->data->container[$i]->over_left;
					$temp['OVER_RIGHT']=$obj->data->container[$i]->over_right;
					$temp['OVER_FRONT']=$obj->data->container[$i]->over_front;
					$temp['OVER_REAR']=$obj->data->container[$i]->over_rear;
					$temp['OVER_HEIGHT']=$obj->data->container[$i]->over_height;
					$temp['POD']=$obj->data->container[$i]->pod;
					$temp['POL']=$obj->data->container[$i]->pol;
					$temp['COMODITY']=$obj->data->container[$i]->comodity;
					$temp['PLUG_IN']=$obj->data->container[$i]->plug_in;
					$temp['GATEIN_DATE']=$obj->data->container[$i]->gatein_date;
					array_push($stack, $temp);
				}
			}
		}
		echo json_encode($stack);
	} 

	public function create_request_delivery() {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_delivery-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$type_req='NEW'; //NEW for Delivery, EXT for Extention
		$sp2p_number=""; //NULL for Delivery, NUMBER for Extention
		$old_req=""; //NULL for Delivery, OLD req for Extention
		$id_ves_voyage=$_POST["ID_VSB_VOYAGE"];
		$vessel=$_POST["VESSEL"];
		$vessel_code=$_POST["VESSEL_CODE"];
		$call_sign=$_POST["CALL_SIGN"];
		$voyage_in=$_POST["VOYAGE_IN"];
		$voyage_out=$_POST["VOYAGE_OUT"];
		$customer_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id = $this->session->userdata('customeridppjk_phd');
		$customer_name=$this->session->userdata('customername_phd');
		$address=$this->session->userdata('address_phd');
		$npwp=$this->session->userdata('npwp_phd');
		$status="N";
		$no_do=$_POST["NO_DO"];
		$date_do=$_POST["DO_DATE"];
		$sppb_type=$_POST["SPPB_TYPE"];
		$no_sppb=$_POST["NO_SPPB"];
		$date_sppb=$_POST["DATE_SPPB"];
		$no_sp_custom=$_POST["NO_SP_CUSTOM"];
		$date_sp_custom=$_POST["DATE_SP_CUSTOM"];
		$no_bl=$_POST["NO_BL"];
		$date_delivery=$_POST["DELIVERY_DATE"];
		$date_ext="";
		$date_old_del="";
		$date_discharge=$_POST["DATE_DISCHARGE"];
		$date_request=""; //nanti akan sysdate
		$id_user=$this->session->userdata('userid_simop');
		$id_user_eservice=$this->session->userdata('uname_phd');
		$quantity=""; //akan diupdate saat detail
		$remark="";
		$is_edit="";
		$delivery_type=$_POST["DELIVERY_TYPE"];
		$nobook=$_POST["NO_BOOKING"];
		$ship_line=$_POST["ship_line"];
		$delivery_via=$_POST["DELIVERY_VIA"];
		//declare form validation pemesanan pengeluaran default
		$config = array(
			array(
				'field' => 'TERMINAL',
				'label' => "Terminal",
				'rules' => 'required'
			),
			array(
				'field' => 'ID_VSB_VOYAGE',
				'label' => "Vessel",
				'rules' => 'required'
			),
			array(
				'field' => 'VESSEL_CODE',
				'label' => "Vessel",
				'rules' => 'required'
			),
			array(
				'field' => 'VOYAGE_IN',
				'label' => "Voyage In",
				'rules' => 'required'
			),
			array(
				'field' => 'VOYAGE_OUT',
				'label' => "Voyage Out",
				'rules' => 'required'
			),
			array(
				'field' => 'DELIVERY_TYPE',
				'label' => "Delivery Type",
				'rules' => 'required'
			),
			array(
				'field' => 'DELIVERY_DATE',
				'label' => "Delivery Date",
				'rules' => 'required'
			)
		);

		//declare form validation pemesanan pengeluaran internasional
		if($no_sppb<>''){
			$internasional = array(
				array(
					'field' => 'NO_SPPB',
					'label' => "SPPB Number",
					'rules' => 'required'
				),
				array(
					'field' => 'DATE_SPPB',
					'label' => "SPPB Date",
					'rules' => 'required'
				)
			);			
		}
		else if($no_sp_custom<>'')
		{
			$internasional = array(
				array(
					'field' => 'NO_SP_CUSTOM',
					'label' => "SP Custom Number",
					'rules' => 'required'
				),
				array(
					'field' => 'DATE_SP_CUSTOM',
					'label' => "SP Custom Date",
					'rules' => 'required'
				)
			);		
			
		}
		

		if($this->input->post()) {
			if($port[1] == 'T3I') {
				foreach($internasional as $config_internasional) {
					array_push($config, $config_internasional);
				}
			}
			
			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran
			if($this->form_validation->run() == false) {
				log_message('debug', '>>> --0.1-- salah');
				echo 'salah';
			} else {
				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
				$address = base64_encode($address);
				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>".$port[0]."</port_code>
						<terminal_code>".$port[1]."</terminal_code>
						<type_req>$type_req</type_req>
						<sp2p_number>$sp2p_number</sp2p_number>
						<old_req>$old_req</old_req>
						<id_ves_voyage>$id_ves_voyage</id_ves_voyage>
						<vessel>$vessel</vessel>
						<vessel_code>$vessel_code</vessel_code>
						<call_sign>$call_sign</call_sign>
						<voyage_in>$voyage_in</voyage_in>
						<voyage_out>$voyage_out</voyage_out>
						<customer_id>$customer_id</customer_id>
						<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
						<customer_name>$customer_name</customer_name>
						<address>$address</address>
						<npwp>$npwp</npwp>
						<status>$status</status>
						<no_do>$no_do</no_do>
						<date_do>$date_do</date_do>
						<sppb_type>$sppb_type</sppb_type>
						<no_sppb>$no_sppb</no_sppb>
						<date_sppb>$date_sppb</date_sppb>
						<no_sp_custom>$no_sp_custom</no_sp_custom>
						<date_sp_custom>$date_sp_custom</date_sp_custom>
						<no_bl>$no_bl</no_bl>
						<date_delivery>$date_delivery</date_delivery>
						<date_ext>$date_ext</date_ext>
						<date_old_del>$date_old_del</date_old_del>
						<date_discharge>$date_discharge</date_discharge>
						<date_request>$date_request</date_request>
						<id_user>$id_user</id_user>
						<id_user_eservice>$id_user_eservice</id_user_eservice>
						<quantity>$quantity</quantity>
						<remark>$remark</remark>
						<is_edit>$is_edit</is_edit>
						<delivery_type>$delivery_type</delivery_type>
						<no_booking>$nobook</no_booking>
						<delivery_via>$delivery_via</delivery_via>
						<ship_line>$ship_line</ship_line>
					</data>
				</root>";
				// print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				// print_r($in_data);
				// die();
				if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"createRequestDelivery",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{

					// print_r($result);
					// die();	
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					

					$obj = json_decode($result);
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
			}
		}
	}

	public function add_detail_delivery(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		$port=explode("-",$_POST["TERMINAL"]);
		$id_req=$_POST["ID_REQ"];
		$id_ves_voyage=$_POST["ID_VSB_VOYAGE"];
		$vessel=$_POST["VESSEL"];
		$vessel_code=$_POST["VESSEL_CODE"];
		$call_sign=$_POST["CALL_SIGN"];
		$voyage_in=$_POST["VOYAGE_IN"];
		$voyage_out=$_POST["VOYAGE_OUT"];
		$no_container=$_POST["NO_CONTAINER"];
		$size_cont=$_POST["SIZE_CONT"];
		$type_cont=$_POST["TYPE_CONT"];
		$status_cont=$_POST["STATUS_CONT"];
		$height_cont=$_POST["HEIGHT_CONT"];
		$id_cont=$_POST["ID_CONT"];
		$hz=$_POST["HZ"];
		$imo_class=$_POST["IMO_CLASS"];
		$un_number=$_POST["UN_NUMBER"];
		$iso_code=$_POST["ISO_CODE"];
		$temp=$_POST["TEMP"];
		$disabled="";
		$weight=$_POST["WEIGHT"];
		$carrier=$_POST["CARRIER"];
		$oog=$_POST["OOG"];
		$over_left=$_POST["OVER_LEFT"];
		$over_right=$_POST["OVER_RIGHT"];
		$over_front=$_POST["OVER_FRONT"];
		$over_rear=$_POST["OVER_REAR"];
		$over_height=$_POST["OVER_HEIGHT"];
		$date_delivery=$_POST["DELIVERY_DATE"];
		$date_discharge=$_POST["DATE_DISCHARGE"];
		$delivery_type=$_POST["DELIVERY_TYPE"];
		$pod=$_POST["POD"];
		$pol=$_POST["POL"];
		$plug_in=$_POST["PLUG_IN"];
		$plug_out=$_POST["PLUG_OUT"];
		$gatein_date=$_POST["GATEIN_DATE"];

		$stack = array();
		try{
			$reqNoBiller=$this->container_model->getNumberRequestBiller($id_req);

			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
					<id_req>$reqNoBiller</id_req>
					<id_ves_voyage>$id_ves_voyage</id_ves_voyage>
					<vessel>$vessel</vessel>
					<vessel_code>$vessel_code</vessel_code>
					<call_sign>$call_sign</call_sign>
					<voyage_in>$voyage_in</voyage_in>
					<voyage_out>$voyage_out</voyage_out>
					<no_container>$no_container</no_container>
					<size_cont>$size_cont</size_cont>
					<type_cont>$type_cont</type_cont>
					<status_cont>$status_cont</status_cont>
					<height_cont>$height_cont</height_cont>;
					<id_cont>$id_cont</id_cont>;
					<hz>$hz</hz>
					<imo_class>$imo_class</imo_class>
					<un_number>$un_number</un_number>
					<iso_code>$iso_code</iso_code>
					<temp>$temp</temp>
					<disabled>$disabled</disabled>
					<weight>$weight</weight>
					<carrier>$carrier</carrier>
					<oog>$oog</oog>
					<over_left>$over_left</over_left>
					<over_right>$over_right</over_right>
					<over_front>$over_front</over_front>
					<over_rear>$over_rear</over_rear>
					<over_height>$over_height</over_height>
					<date_delivery>$date_delivery</date_delivery>
					<date_discharge>$date_discharge</date_discharge>
					<delivery_type>$delivery_type</delivery_type>
					<pod>$pod</pod>
					<pol>$pol</pol>
					<plug_in>$plug_in</plug_in>
					<plug_out>$plug_out</plug_out>
					<gatein_date>$gatein_date</gatein_date>
				</data>
			</root>";
			injek($in_data);
			if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"addDetailContainer",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				// echo $result;die();
				
				$obj = json_decode($result);

				if($obj->rc=="F")
				{
					echo "NO,".$obj->rcmsg;
				}
				else if($obj->data->info)
				{
					echo($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,Exception";
		}
	}

	public function del_cont_req_delivery_perp(){
		$port=explode("-",$_POST["TERMINAL"]);
		$no_container=$_POST["NO_CONTAINER"];
		$no_request=$_POST["NO_REQUEST"];
		$user_id=$this->session->userdata('userid_simop');
		$stack = array();

		//echo $no_request;
		try{
			$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
			//echo $reqNoBiller;die;
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
			 $in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
					<id_req>$reqNoBiller</id_req>
					<no_container>$no_container</no_container>
					<user_id>$user_id</user_id>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"delDetailContainerPerp",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				// echo $result;die();

				$obj = json_decode($result);
				if($obj->data->info)
				{
					echo($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
	}
	
	//----------------------------------------------
		public function update_plugout_cont(){
		$port=explode("-",$_POST["TERMINAL"]);
		$no_container=$_POST["NO_CONTAINER"];
		$no_request=$_POST["NO_REQUEST"];
		$plugin=$_POST["PLUG_IN"];
		$plugoutext=$_POST["PLUG_OUT_EXT"];
		$user_id=$this->session->userdata('userid_simop');
		$stack = array();

		//echo $no_request;
		try{
			$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
			//echo $reqNoBiller;die;
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			 $in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
					<id_req>$reqNoBiller</id_req>
					<no_container>$no_container</no_container>
					<user_id>$user_id</user_id>
					<plugin>$plugin</plugin>
					<plugoutext>$plugoutext</plugoutext>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"updatePlugoutCont",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//echo $result;die();

				$obj = json_decode($result);
				if($obj->data->info)
				{
					echo($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
	}
	//----------------------------------------------

	public function del_cont_req_delivery(){
		$port=explode("-",$_POST["TERMINAL"]);
		$no_container=$_POST["NO_CONTAINER"];
		$no_request=$_POST["NO_REQUEST"];
		$vessel_code=$_POST["VESSEL_CODE"];
		$voyage=$_POST["VOYAGE"];
		$user_id=$this->session->userdata('userid_simop');
		$stack = array();

		//echo $no_request;
		try{
			$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
			//echo $reqNoBiller;die;
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
					<id_req>$reqNoBiller</id_req>
					<no_container>$no_container</no_container>
					<user_id>$user_id</user_id>
					<vessel_code>$vessel_code</vessel_code>
					<voyage>$voyage</voyage>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"delDetailContainer",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				// echo $result;die();

				$obj = json_decode($result);
				if($obj->data->info)
				{
					echo($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
	}

	public function get_detail_delivery($type,$no_req,$terminal){
		if($type=="add" || $type=="edit"){
			//create table
			$this->table->set_heading('No','Hapus','No Kontainer','Ukuran', 'Tipe','Status', 'Tinggi', 'Berbahaya','Carrier','Plug IN','Plug Out');
		} else {
			//create table
			$this->table->set_heading('No','No Kontainer','Ukuran', 'Tipe','Status', 'Tinggi', 'Berbahaya','Carrier','Plug IN','Plug Out');
		}

		$stack = array();
        $port = explode("-",$terminal);

		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_req);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$reqNoBiller</no_request>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getDetailDelivery",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result); //var_dump($obj);die();
			if($obj->data->container)
			{
				for($i=0;$i<count($obj->data->container);$i++)
				{
					if($type=="add" || $type=="edit"){
						$this->table->add_row(
							$i+1,
							'<a class="btn btn-primary" onclick="delete_container(\''.$obj->data->container[$i]->no_container.'\')"><i class="fa fa-trash-o"></i></a>',
							$obj->data->container[$i]->no_container,
							$obj->data->container[$i]->size_cont,
							$obj->data->container[$i]->type_cont,
							$obj->data->container[$i]->status_cont,
							$obj->data->container[$i]->height_cont,
							$obj->data->container[$i]->hz,
							$obj->data->container[$i]->carrier,
							$obj->data->container[$i]->plug_in,
							$obj->data->container[$i]->plug_out
						);
					} else {
						$this->table->add_row(
							$i+1,
							$obj->data->container[$i]->no_container,
							$obj->data->container[$i]->size_cont,
							$obj->data->container[$i]->type_cont,
							$obj->data->container[$i]->status_cont,
							$obj->data->container[$i]->height_cont,
							$obj->data->container[$i]->hz,
							$obj->data->container[$i]->carrier,
							$obj->data->container[$i]->plug_in,
							$obj->data->container[$i]->plug_out
						);
					}
				}
			}
		}

		$data['type']=$type;
		$this->load->view('pages/container/get_detail_delivery', $data);
	}

	public function list_container_delivery_perp(){
		$this->redirect();

        $id_req = $_POST["ID_REQ"];
		$port	= explode("-",$_POST['PORT']);
		$port_code     = $port[0];
		$terminal_code = $port[1];
		//$port_code = substr($_POST['PORT'], 0, 5);
		//$terminal_code = substr($_POST['PORT'], 6, 3);
        $stack = array();

        $id_user=$this->session->userdata('uname_phd');

        $reply = array();
        $in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>$id_req</id_req>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
			</data>
		</root>";
        //echo $in_data ; die;

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getOldListContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->list_cont)
			{
				for($i=0;$i<count($obj->data->list_cont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->list_cont[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->list_cont[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->list_cont[$i]->type_cont;
					$temp['STATUS_CONT']=$obj->data->list_cont[$i]->status_cont;
					$temp['HEIGHT_CONT']=$obj->data->list_cont[$i]->height;
					$temp['HZ']=$obj->data->list_cont[$i]->hz;
					//$temp['WEIGHT']=$obj->data->list_cont[$i]->weight;
					$temp['CARRIER']=$obj->data->list_cont[$i]->carrier;
					$temp['PLUG_OUT']=$obj->data->list_cont[$i]->plug_out;
					$temp['PLUG_IN']=$obj->data->list_cont[$i]->plug_in;
					$temp['PLUG_OUT_EXT']=$obj->data->list_cont[$i]->plug_out_ext;
					

					array_push($stack, $temp);
				}
			}
		}

        echo json_encode($stack);
    }

	  public function list_container_delivery_perp_new_req(){
		$this->redirect();

        $id_req = $_POST["ID_REQ"];
		$port	= explode("-",$_POST['PORT']);
		$port_code     = $port[0];
		$terminal_code = $port[1];
		//$port_code = substr($_POST['PORT'], 0, 5);
		//$terminal_code = substr($_POST['PORT'], 6, 3);
        $stack = array();

        $id_user=$this->session->userdata('uname_phd');

        $reply = array();
        $in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>$id_req</id_req>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
			</data>
		</root>";
        //echo $in_data ; die;

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getOldListContainerPerp",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->list_cont)
			{
				for($i=0;$i<count($obj->data->list_cont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->list_cont[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->list_cont[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->list_cont[$i]->type_cont;
					$temp['STATUS_CONT']=$obj->data->list_cont[$i]->status_cont;
					$temp['HEIGHT_CONT']=$obj->data->list_cont[$i]->height;
					$temp['HZ']=$obj->data->list_cont[$i]->hz;
					//$temp['WEIGHT']=$obj->data->list_cont[$i]->weight;
					$temp['CARRIER']=$obj->data->list_cont[$i]->carrier;
					$temp['PLUG_OUT']=$obj->data->list_cont[$i]->plug_out;
					$temp['PLUG_OUT_EXT']=$obj->data->list_cont[$i]->plug_out_ext;

					array_push($stack, $temp);
				}
			}
		}

        echo json_encode($stack);
    }


    public function auto_old_norequest_delivery() {
         log_message('debug', 'nilai term'.$term);
		$term = strtoupper($_GET["term"]);
		log_message('debug', 'nilai term'.$port);
        $port= explode("-",$_GET["port"]);
        $stack = array();
		$customer_id=$this->session->userdata('customerid_phd');
		//$customer_id=$this->session->userdata('custid_phd');

        $in_data="	<root>
                            <sc_type>1</sc_type>
                            <sc_code>123456</sc_code>
                            <data>
                                    <old_noreq>$term</old_noreq>
                                    <port_code>".$port[0]."</port_code>
                                    <terminal_code>".$port[1]."</terminal_code>
                                    <customer_id>$customer_id</customer_id>
                            </data>
                        </root>";
		log_message('error', 'nilai in data: '.json_encode($in_data));

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getOldRequestDelivery",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo ($result);die();
			$obj = json_decode($result);
			//echo $result;
			if($obj->data->old_req)
			{
				for($i=0;$i<count($obj->data->old_req);$i++)
				{
					$temp;
					$temp['ID_REQ']=$obj->data->old_req[$i]->old_req;
					$temp['ID_REQ_OL']=$obj->data->old_req[$i]->old_req_ol;
					$temp['NO_DO']=$obj->data->old_req[$i]->no_do;
					$temp['DATE_DO']=$obj->data->old_req[$i]->date_do;
					$temp['TYPE_SPPB']=$obj->data->old_req[$i]->type_sppb;
					$temp['NO_SPPB']=$obj->data->old_req[$i]->no_sppb;
					$temp['DATE_SPPB']=$obj->data->old_req[$i]->date_sppb;
					$temp['NO_SP_CUSTOM']=$obj->data->old_req[$i]->no_sp_custom;
					$temp['DATE_SP_CUSTOM']=$obj->data->old_req[$i]->date_sp_custom;
					$temp['NO_BL']=$obj->data->old_req[$i]->no_bl;
					$temp['VESSEL']=$obj->data->old_req[$i]->vessel_name;
					$temp['VOYAGE_IN']=$obj->data->old_req[$i]->voyage_in;
					$temp['VOYAGE_OUT']=$obj->data->old_req[$i]->voyage_out;
					$temp['ID_VSB_VOYAGE']=$obj->data->old_req[$i]->id_vsb_voyage;
					$temp['VESSEL_CODE']=$obj->data->old_req[$i]->vessel_code;
					$temp['DATE_DELIVERY']=$obj->data->old_req[$i]->date_delivery;
					$temp['DATE_EXT']=$obj->data->old_req[$i]->date_ext;
					$temp['SP2P_NUMBER']=$obj->data->old_req[$i]->sp2p_number;
					$temp['TL_FLAG']=$obj->data->old_req[$i]->tl_flag;
					array_push($stack, $temp);
				}
			}
		}
		log_message('error', 'nilai stacj: '.json_encode($stack));
		echo json_encode($stack);

    }

	public function save_request_delivery(){
		$no_request=$_POST["request_no"];
		$port=explode("-",$_POST["port"]);

		$stack = array();

		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);

        $in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<biller_request_id>$reqNoBiller</biller_request_id>
						<port_code>".$port[0]."</port_code>
						<terminal_code>".$port[1]."</terminal_code>
					</data>
				</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getCountContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->rc!="S")
			{
				echo $result;
				die;
			}
		}

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$reqNoBiller</no_request>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<user_id>".$this->session->userdata('uname_phd')."</user_id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"saveRequestDelivery",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;
			exit;
		}
	}

	public function save_request_deliveryperp(){
		$no_request=$_POST["request_no"];
		$port=explode("-",$_POST["port"]);

		$stack = array();

		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);

        $in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<biller_request_id>$reqNoBiller</biller_request_id>
						<port_code>".$port[0]."</port_code>
						<terminal_code>".$port[1]."</terminal_code>
					</data>
				</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getCountContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->rc!="S")
			{
				echo $result;
				die;
			}
		}

		//no error
		// port code : IDJKT, IDPNK
		// terminal code :  T3I,T3D,T2D,T1D
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$reqNoBiller</no_request>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<user_id>".$this->session->userdata('uname_phd')."</user_id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"submitRequestDeliveryPerp",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;
			exit;
		}
	}

    public function create_delivery_perp() {
		$submitter_customer_id = $this->session->userdata('customeridppjk_phd');
        $old_request = $_POST["OLD_REQUEST"];
		$delivery_type = $_POST["DELIVERY_TYPE"];
        $tgl_perp = $_POST["TGL_DELIVERYPERP"];
        $no_bl = $_POST["NO_BL"];
        $no_do = $_POST["NO_DO"];
        $tgl_do = $_POST["TGL_DO"];
        $no_sppb = $_POST["NO_SPPB"];
        $no_sp_custom = $_POST["NO_SP_CUSTOM"];
        $sp2p_number = $_POST["SP2P_NUMBER"];
        $sppb_date  = $_POST["SPPB_DATE"];
		$no_request  = $_POST["NO_REQUEST"];
        $sp_custom_date  = $_POST["SP_CUSTOM_DATE"];
		$port = explode("-",$_POST["TERMINAL"]);
        $port_code = $port[0];
        $terminal_code = $port[1];
        $ship_line=htmLawed($_POST["ship_line"]);
        //$port_code = substr($_POST['TERMINAL'], 0, 5);
        //$terminal_code = substr($_POST['TERMINAL'], 6, 3);
        $checked_container = json_encode($_POST['CONT_CHECKED']);

        $id_user=$this->session->userdata('userid_simop');
        $id_user_eservice=$this->session->userdata('uname_phd');

		$OldreqNoBiller=$this->container_model->getNumberRequestBiller($old_request);
		$no_request=$this->container_model->getNumberRequestBiller($no_request);
		//var_dump($_POST);DIE;
		//declare form validation pemesanan perp pengeluaran domestik
		$config = array(
			array(
				'field' => 'TERMINAL',
				'label' => "Terminal",
				'rules' => 'required'
			),
			array(
				'field' => 'OLD_REQUEST',
				'label' => "Ex Request Number",
				'rules' => 'required'
			),
			array(
				'field' => 'NO_BL',
				'label' => "Ex Request Number (Billing)",
				'rules' => 'required'
			),
			array(
				'field' => 'DELIVERY_TYPE',
				'label' => "Delivery Type",
				'rules' => 'required'
			),
			array(
				'field' => 'TGL_DELIVERYPERP',
				'label' => "Extension Delivery Date",
				'rules' => 'required'
			)
		);

		//declare form validation pemesanan perp pengeluaran internasional
		if ($no_sp_custom == ''){
			$internasional = array(
				array(
					'field' => 'NO_SPPB',
					'label' => "SPPB Number",
					'rules' => 'required'
				),
				array(
					'field' => 'SPPB_DATE',
					'label' => "SPPB Date",
					'rules' => 'required'
				)
			);
		}
		
		if ($no_sppb == ''){
			$internasional = array(
				array(
					'field' => 'NO_SP_CUSTOM',
					'label' => "SP Custom Number",
					'rules' => 'required'
				),
				array(
					'field' => 'SP_CUSTOM_DATE',
					'label' => "SP Custom Date",
					'rules' => 'required'
				)
			);
		}

		if($this->input->post()) {
			if($port[1] == 'T3I') {
				foreach($internasional as $config_internasional) {
					array_push($config, $config_internasional);
				}
			}

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan perp pengeluaran

			if($this->form_validation->run() == false) {
				echo 'salah';
			} else {
				$in_data="	<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
						<old_noreq>$OldreqNoBiller</old_noreq>
						<delivery_type>$delivery_type</delivery_type>
						<tgl_perp>$tgl_perp</tgl_perp>
						<no_bl>$no_bl</no_bl>
						<no_do>$no_do</no_do>
						<tgl_do>$tgl_do</tgl_do>
						<no_sppb>$no_sppb</no_sppb>
						<no_sppb>$no_sppb</no_sppb>
						<no_sp_custom>$no_sp_custom</no_sp_custom>
						<sp2p_number>$sp2p_number</sp2p_number>
						<sppb_date>$sppb_date</sppb_date>
						<sp_custom_date>$sp_custom_date</sp_custom_date>
						<id_user>$id_user</id_user>
						<id_user_eservice>$id_user_eservice</id_user_eservice>
						<port_code>$port_code</port_code>
						<terminal_code>$terminal_code</terminal_code>
						<checked>$checked_container</checked>
						<request_no>$no_request</request_no>
						<ship_line>$ship_line</ship_line>
						</data>
				</root>";
				
        if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"createRequestDeliveryPerp",array("in_data" => "$in_data"),$result))
				{
					//echo $result;
					log_message('debug',$result);
					die;
				}
				else
				{
					// print_r($result);
					//  die();
					log_message('debug',$result);
					$obj = json_decode($result);
					//echo $result;
					//var_dump($result); die;
					if($obj->data->info)
					{
						echo "<response>,".$obj->data->info.",</response>";
						echo "<port_code>".$port_code."</port_code>";
						echo "<terminal_code>".$terminal_code."</terminal_code>";
					} else {
						echo "NO,GAGAL";
					}
				}
			}
		}
    }

    // public function get_old_detail_delivery(){
        // $old_request = $_POST["OLD_REQUEST"];

        // $reply = array();
        // $client = new nusoap_client(REQUEST_PERPANJANGAN_DELIVERY);
		// $error = $client->getError();
		// if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}
        // $stack = array();
        // $modul = "getOldListContainer";
        // $in_data = "<root>
			// <sc_type>1</sc_type>
			// <sc_code>123456</sc_code>
			// <data>
				// <old_noreq>$old_request</old_noreq>
			// </data>
		// </root>";
        // $result = $client->call($modul, array("in_data" => "$in_data"));

        // if ($client->fault) {
			// echo "<h2>Fault</h2><pre>";
			// print_r($result);
			// echo "</pre>";
		// }
		// else {
			// $error = $client->getError();
			// if ($error) {
				// echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
			// }
			// else {
				// $obj = json_decode($result);

				// if($obj->data->old_cont)
				// {
					// for($i=0;$i<count($obj->data->old_cont);$i++)
					// {
						// $temp;
						// $temp['NO_CONTAINER']=$obj->data->old_cont[$i]->no_container;
						// $temp['SIZE_CONT']=$obj->data->old_cont[$i]->size_cont;
						// $temp['TYPE_CONT']=$obj->data->old_cont[$i]->type_cont;
						// $temp['STATUS_CONT']=$obj->data->old_cont[$i]->status_cont;
						// $temp['HEIGHT_CONT']=$obj->data->old_cont[$i]->height_cont;
						// $temp['HZ']=$obj->data->old_cont[$i]->hz;
						// $temp['WEIGHT']=$obj->data->old_cont[$i]->weight;
						// $temp['CARRIER']=$obj->data->old_cont[$i]->carrier;

						// array_push($stack, $temp);
					// }
				// }

			// }
		// }

        //print_r($stack); die();
        // $data['detail'] = $stack;
        // $this->load->view('pages/container/get_detail_delivery_ext', $data);


    // }

    public function save_detail_delivery_perp(){
        $alldetail = $_POST["alldetail"];

        $container = "";
        $jum =count($alldetail);

        for($i=0; $i < count($alldetail); $i++){
            $container .= "'".$alldetail[$i]."'";
            if($jum!=1 && $i != $jum-1){
                $container .=",";
            }
        }

       // print_r($container); die();

        $container = base64_encode($container);

        $ID_REQ = $_POST["ID_REQ"];
        $OLD_REQ = $_POST["OLD_REQ"];
        $sppb = $_POST["SPPB"];
        $tglsppb = $_POST["TGLSPPB"];
        $ndo = $_POST["NODO"];
        $tgldo = $_POST["TGLDO"];
        $blnumb = $_POST["BLNUMB"];
        $tgldelp = $_POST["TGLDELP"];
        $port=explode("-",$_POST["TERMINAL"]);

        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <alldetail>$container</alldetail>
                <id_request>$ID_REQ</id_request>
                <old_request>$OLD_REQ</old_request>
                <sppb>$sppb</sppb>
                <tglsppb>$tglsppb</tglsppb>
                <ndo>$ndo</ndo>
                <tgldo>$tgldo</tgldo>
                <blnumb>$blnumb</blnumb>
                <tgldelp>$tgldelp</tgldelp>
                <port_code>".$port[0]."</port_code>
                <terminal_code>".$port[1]."</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"saveDetailReqPerp",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->info)
			{
				echo($obj->data->info);

			} else {
				echo "NO,GAGAL";
			}
		}

    }

	function download_proforma_delivery_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			if($group_id!="m")
			return;
		}

		$stack = array();

		$billerId=$this->container_model->getNumberRequestBiller($no_request);
		if ($billerId == "NO_DATA_FOUND") die('No Data Transaction found');
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$billerId</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";
		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getPDFProformaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->html_tcpdf)
			{
				//update activity log
				if($group_id!="m")
					$billerId=$this->container_model->updateTransactionLogActivity($no_request,"PRINT_PROFORMA",$id_user_eservice=$this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();
				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

// ---------------------------------------------------------

				// Get Logo
				$hdrGrup = $obj->data->hdrGrup;
				$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
					$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
				$hasil = $query->row_array();
				$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

				$tbl=base64_decode($obj->data->html_tcpdf);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->AddPage();
				// set font
				$pdf->SetFont('helvetica', '', 10);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				//$pdf->write1DBarcode("Ivan", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->setPage(1);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->Image(APP_ROOT.$logo, 5, 12, 18, 12, '', '', '', true, 500);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo $result;
				echo "NO,GAGAL";
			}
		}
	}

	function download_proforma_delivery($no_request,$port_code,$terminal_code,$hash=""){

		$this->redirect();

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->download_proforma_delivery_atch($no_request,$port_code,$terminal_code,$hash);

	}

	function dw_prodelv_thermal($no_request,$port_code,$terminal_code,$hash=""){

		$this->redirect();

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->dw_prodelv_thermal_atch($no_request,$port_code,$terminal_code,$hash);

	}

	function dw_prodelv_thermal_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			if($group_id!="m")
				return;
		}

		$stack = array();

		$billerId=$this->container_model->getNumberRequestBiller($no_request);
		if ($billerId == "NO_DATA_FOUND") die('No Data Transaction found');
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<no_request>$billerId</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getPDFPro_thermal",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->html_tcpdf)
			{
				//update activity log
				if($group_id!="m")
					$billerId=$this->container_model->updateTransactionLogActivity($no_request,"PRINT_PROFORMA",$id_user_eservice=$this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();
				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3,17, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

// ---------------------------------------------------------

				// Get Logo
				$hdrGrup = $obj->data->hdrGrup;
				$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
				$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
				$hasil = $query->row_array();
				$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

				$tbl=base64_decode($obj->data->html_tcpdf);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->AddPage();
				// set font
				$pdf->SetFont('helvetica', '', 5);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				//$pdf->write1DBarcode("Ivan", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->setPage(1);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 3, 22, 9, 6, '', '', '', true, 72);
				$pdf->Image(APP_ROOT.$logo, 3, 22, 9, 6, '', '', '', true, 500);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128',0, 0, '', 18, 0.4, $style, 'N');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo $result;
				echo "NO,GAGAL";
			}
		}
	}

	function download_invoice_delivery_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');
		
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			//return;
		}

		$stack = array();

		$nobiller=$this->container_model->getNumberRequestBiller($no_request);
		
		{//create inovoice qr code
			//data hasil qr code
			$hash = md5(ROOT."invoice/val_invoice/1/del/$no_request/$port_code/$terminal_code/");

			//val_invoice/{validation_version}/{service_type}/{no_request}/{port_code}/{terminal_code}/{challenge_code}
			//pada versi 1, digunakan challenge_code untuk menguji bahwa url yang terbentuk benar hanya dari sistem ipc
			$params['data'] = ROOT."invoice/val_invoice/1/del/$no_request/$port_code/$terminal_code/$hash";
			$params['level'] = 'H';
			$params['size'] = 10;
			$randomfilename = rand(1000, 9999);
			$params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
			$this->ciqrcode->generate($params);
		}

		$barcode_location=APP_ROOT."qr_code/$randomfilename.png";
		//$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
    if ($port_code=='IDPNJ')
		{
			$ttd_location = APP_ROOT."config/images/cr/ttd_pjg.png";
		} else {
			$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
		}
		$user = $this->session->userdata('uname_phd');

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$nobiller</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
				<barcode_location>".$barcode_location."</barcode_location>
				<ttd_location>".$ttd_location."</ttd_location>
				<user>".$user."</user>
			</data>
		</root>";
		
		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getPDFNotaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->html_tcpdf)
			{
				$footerhtml = base64_decode($obj->data->footer);
				$lampiran_nota = base64_decode($obj->data->lampiran);
				
				//update activity log
				if($group_id!="m")
					$billerId=$this->container_model->updateTransactionLogActivity($no_request,"PRINT_INVOICE",$id_user_eservice=$this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();

				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
				// create new PDF document
				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(5, 5, 15);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

				// Get Logo
				$org_id = $obj->data->org_id;
				$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and org_id = ? ";
				$query = $this->db->query($query, array($port_code,$terminal_code,$org_id));
				$hasil = $query->row_array();
				$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';
				
				$tbl=base64_decode($obj->data->html_tcpdf);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 9);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->writeHTML($footerhtml, true, false, false, false, '');
				// $pdf->writeHTMLCell(
					// $w = 0, $h = 0, $x = '', $y = '',
					// $footerhtml, $border = 0, $ln = 1, $fill = 0,
					// $reseth = true, $align = 'right', $autopadding = true);
				$pdf->AddPage();
				$pdf->writeHTML($lampiran_nota, true, false, false, false, '');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

				$pdf->setPage(1);
				
				$pdf->Image(APP_ROOT.$logo, 5, 4, 30, 15, '', '', '', true, 500);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				//$pdf->Image(APP_ROOT.'config/images/cr/ttd2.jpg', 175, 260, 30, 15, '', '', '', true, 72);

				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_jasa_kepelabuhanan - '.$obj->data->faktur_id.'.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_invoice_delivery($no_request,$port_code,$terminal_code,$hash=""){

		$this->redirect();

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if($dataBilling["STATUS_REQ"]!="P")
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));
		$this->download_invoice_delivery_atch($no_request,$port_code,$terminal_code,$hash);

	}

	function download_card_delivery($no_request,$port_code,$terminal_code){
		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');

		$stack = array();

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getCardContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->html_tcpdf)
			{

				$tbl=base64_decode($obj->data->html_tcpdf);

				echo($tbl);die();

			}
		}

	}

	function download_card_delivery_thermal($no_request,$port_code,$terminal_code){
		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');

		$stack = array();

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getCardContainerThermal",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->data->html_tcpdf)
			{
				$this->load->helper('pdf_helper');

				tcpdf();

				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				// $pdf = new MYPDF('P', 'mm', 'A7', true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', Array(80,130), true, 'UTF-8', false);

				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(1, 1, 1);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------
				for($i=0;$i<count($obj->data->html_tcpdf);$i++)
				{
					$tbl=base64_decode($obj->data->html_tcpdf[$i]->TCPDF);
					// add a page
					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 6);

					$style = array(
							'position' => '',
							'align' => 'C',
							'stretch' => false,
							'fitwidth' => true,
							'cellfitalign' => '',
							//'border' => true,
							'hpadding' => 'auto',
							'vpadding' => 'auto',
							'fgcolor' => array(0,0,0),
							'bgcolor' => false, //array(255,255,255),
							'text' => true,
							'font' => 'helvetica',
							'fontsize' => 8,
							'stretchtext' => 4
						);

					//Menampilkan Barcode dari nomor nota
					//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
					//Logo IPC
					$pdf->write1DBarcode($obj->data->html_tcpdf[$i]->NO_CONTAINER, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
					$pdf->writeHTML($tbl, true, false, false, false, '');
					$pdf->write1DBarcode($obj->data->html_tcpdf[$i]->NO_CONTAINER, 'C128', 0, 100, '', 18, 0.4, $style, 'N');

				}

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}

	}

	function payment_confirmation($no_request,$id_port,$id_terminal,$id_proforma,$vessel,$voyage_in,$voyage_out){
		$this->redirect();

		$data['no_request']=$no_request;
		$data['id_proforma']=$id_proforma;

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Payment', 'container/payment');
		$this->breadcrumbs->push('Payment Confirmation', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Payment Confirmation';

		$this->common_loader($data,'pages/container/payment_confirmation');
	}

	function save_payment_confirmation(){
		$no_request=$_POST["no_request"];
		$no_proforma=$_POST["no_proforma"];
		$method=$_POST["method"];
		$via=$_POST["via"];
		$amount=$_POST["amount"];

		$params = array(
			'REQUEST_NUMBER'				=>	$no_request,
			'PROFORMA_NUMBER'				=>	$no_proforma,
			'USER_ID'						=>	$this->session->userdata('uname_phd'),
			'PAYMENT_METHOD'				=>	$method,
			'PAYMENT_VIA'					=>	$via,
			'PAYMENT_AMOUNT'				=>	$amount,
			'PAYMENT_CONFIRMATION_STATUS'	=>	'N'
		);

		if($this->container_model->create_payment_confirmation($params))
		{
			echo 'OK';
		}
		else
		{
			echo 'KO';
		}
	}

    function download_proforma_ext_delivery($no_request,$port_code,$terminal_code){

		$this->redirect();

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');

        $nobiller=$this->container_model->getNumberRequestBiller($no_request);
        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getPDFProformaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->proforma_html)
			{

				$this->load->helper('pdf_helper');

				tcpdf();
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

				$tbl=base64_decode($obj->data->proforma_html);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->AddPage();
				// set font
				$pdf->SetFont('helvetica', '', 10);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				//$pdf->write1DBarcode("Ivan", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');

				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('proforma_ext.pdf', 'I');

			} else {
				echo "NO,GAGAL";
			}
		}
    }

    function download_nota_ext_delivery($no_request,$port_code,$terminal_code){

		$this->redirect();

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');

        $nobiller=$this->container_model->getNumberRequestBiller($no_request);
        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getPDFNotaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->nota_html)
			{

				$this->load->helper('pdf_helper');

				tcpdf();
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(1, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

				$tbl=base64_decode($obj->data->nota_html);
				//print_r($tbl); die();

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 9);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_ext.pdf', 'I');

			} else {
				echo "NO,GAGAL";
			}
		}
    }

    function download_card_ext_delivery($no_request,$port_code,$terminal_code){

		$this->redirect();

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');


        $nobiller=$this->container_model->getNumberRequestBiller($no_request);
        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

        if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getHTMLCardContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->data->card_html)
			{

				$tbl=base64_decode($obj->data->card_html);

				echo $tbl;
				die();

			} else {
				echo "NO,GAGAL";
			}
		}
    }

	public function print_card_delivery_atch($no_request,$port_code,$terminal_code,$hash){

		$this->redirect();

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');
		
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			return;
		}

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');

		$card_password = $billerId=$this->user_model->get_pdf_password($this->session->userdata('uname_phd'));
        $billerId=$this->container_model->getNumberRequestBiller($no_request);

        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$billerId</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getPDFCardContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			//$tbl=base64_decode($obj->data->proforma_html);
			//print_r($tbl); die();
			$total = $obj->data->jumlah;

			//update activity log
			$this->container_model->updateTransactionLogActivity($no_request,"PRINT_CARD",$id_user_eservice=$this->session->userdata('uname_phd'));
			$cetakan_ke = $this->container_model->getCountCardPrint($no_request);
			//validasi limit cetakan kartu
			$vld = $this->container_model->getValidCardPrint($cetakan_ke,'DEL');
			//echo $vld;die;

		if($vld=="Y")
		{
			//print_r(count($obj->data->detail_card));
			if($obj->data->detail_card){

			$this->load->helper('pdf_helper');
			tcpdf();
			// create new PDF document
			//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


			// set header and footer fonts
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetProtection 	($permissions = array('print', 'print'),
										$user_pass = $card_password,
										$owner_pass = null,
										$mode = 0,
										$pubkeys = null
									);
			//set margins
			$pdf->SetMargins(3, 3, 3);
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			$pdf->setPrintHeader(false);

			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, 10);

			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			//set some language-dependent strings
			$pdf->setLanguageArray(null);

// ---------------------------------------------------------
			$shipper = '';
			//print_r($rowz); die();
			$nourut = 1;
			for($i=0;$i<count($obj->data->detail_card);$i++){
				$nocont = strtoupper($obj->data->detail_card[$i]->no_container);
			   // echo $nocont; die();
				$prefx = strtoupper($obj->data->detail_card[$i]->prefix);
				$clossing_time        =$obj->data->detail_card[$i]->clossing_time;
				$paid_thru2           =$obj->data->detail_card[$i]->paidthru;
				$etd                  =$obj->data->detail_card[$i]->etd;
				$vessel               =$obj->data->detail_card[$i]->vessel;
				$voyage               =$obj->data->detail_card[$i]->voyage;
				$voyage_out           =$obj->data->detail_card[$i]->voyage_out;
				$status_cont          =$obj->data->detail_card[$i]->status_cont;
				$size_cont            =$obj->data->detail_card[$i]->size_cont;
				$type_cont            =$obj->data->detail_card[$i]->type_cont;
				$no_container         =$obj->data->detail_card[$i]->no_container;
				$berat                =$obj->data->detail_card[$i]->berat;
				$pelabuhan_tujuan     =$obj->data->detail_card[$i]->pelabuhan_tujuan;
				$fpod                 =$obj->data->detail_card[$i]->fpod;
				$ipod                 =$obj->data->detail_card[$i]->ipod;
				$fipod                =$obj->data->detail_card[$i]->fipod;
				$peb                  =$obj->data->detail_card[$i]->peb;
				$npe                  =$obj->data->detail_card[$i]->npe;
				$kode_pbm             =$obj->data->detail_card[$i]->kode_pbm;
				$imo_class            =$obj->data->detail_card[$i]->imo_class;
				$temp                 =$obj->data->detail_card[$i]->temp;
				$iso_code             =$obj->data->detail_card[$i]->iso_code;
				$ipol                 =$obj->data->detail_card[$i]->ipol;
				$tgl_request          =$obj->data->detail_card[$i]->tgl_request;
				$prefix               =$obj->data->detail_card[$i]->prefix;
				$cont_numb            =$obj->data->detail_card[$i]->cont_numb;
				$booking_numb         =$obj->data->detail_card[$i]->booking_numb;
				$status_tl            =$obj->data->detail_card[$i]->status_tl;
				$no_do         		  =$obj->data->detail_card[$i]->no_do;
				$tgl_do               =$obj->data->detail_card[$i]->tgl_do;
				$seal_id               =$obj->data->detail_card[$i]->seal_id;
				$plug_out               =$obj->data->detail_card[$i]->plug_out;
				$hdrGrup               =$obj->data->detail_card[$i]->hdrGrup;
				$posisi               =$obj->data->detail_card[$i]->posisi;
				$nama_shipper               =$obj->data->detail_card[$i]->nama_shipper;
				$pin_number               =$obj->data->detail_card[$i]->pin_number;

				//**** Get corporate, terminal, and logo
				$query="SELECT port_name, terminal_name, logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
					$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
				$hasil = $query->row_array();
				$corporate_name = isset($hasil['PORT_NAME']) ? $hasil['PORT_NAME'] : '';
				$terminal_name = isset($hasil['TERMINAL_NAME']) ? $hasil['TERMINAL_NAME'] : '';
				$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

				if($paid_thru2<>'')
				{
					$paid_thru = $paid_thru2." 23:59";
				}
				else
				{
					$paid_thru = $paid_thru2;
				}

				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 6);
				if($port_code=="IDDJB" || $port_code=="IDTLB"){
					$shipper = '<tr>
						<td align="left" colspan="3">
							<b><font size="10">Shipper : '.$nama_shipper.'</font></b>
						</td>						
					</tr>';
				}
				$tbl0= <<<EOD
				<table width="95%">
					<tr>
						<td COLSPAN="6" align="right"><b><font size="18">Gate Pass Delivery Online</font></b></td>
					</tr>
					<tr>
						<td>
						</td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;$corporate_name</font></b></td>
					</tr>
					<tr>
						<td>
						</td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;$terminal_name</font></b></td>
					</tr>
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="center">
							<b><font size="12">No Container</font></b>
						</td>
						<td align="center">
							<b><font size="12">PIN</font></b>
						</td>
					</tr>
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="left">
							<b><font size="10">No Container</font></b>
						</td>
						<td align="left">
							<b><font size="10">Seal Number</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nocont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$seal_id</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_cont</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">ISO Code</font></b>
						</td>
						<td align="left">
							<b><font size="10">Size/Type</font></b>
						</td>
						<td align="left">
							<b><font size="10">Temperatur</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$iso_code</font></b>
						</td>
						<td align="left">
							<b><font size="12">$size_cont/$type_cont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$temp</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">No Urut</font></b>
						</td>
						<td align="left">
							<b><font size="10">IMO Class</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status TL</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nourut/$total</font></b>
						</td>
						<td align="left">
							<b><font size="12">$imo_class</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_tl</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Vessel</font></b>
						</td>
						<td align="left">
							<b><font size="10">Voyage</font></b>
						</td>
						<td align="left">
							<b><font size="10">Customer</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$vessel</font></b>
						</td>
						<td align="left">
							<b><font size="12">$voyage/$voyage_out</font></b>
						</td>
						<td align="left">
							<b><font size="9">$kode_pbm</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">No DO</font></b>
						</td>
						<td align="left">
							<b><font size="10">Tgl DO</font></b>
						</td>
						<td align="left">
							<b><font size="10">No Request</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$no_do</font></b>
						</td>
						<td align="left">
							<b><font size="12">$tgl_do</font></b>
						</td>
						<td align="left">
							<b><font size="12">$no_request ($billerId)</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Paid Thru</font></b>
						</td>
						<td align="left">
							<b><font size="10">Cetakan ke</font></b>
						</td>
						<td align="left">
							<b><font size="10">Plug Out</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$paid_thru</font></b>
						</td>
						<td align="left">
							<b><font size="12">$cetakan_ke</font></b>
						</td>
						<td align="left">
							<b><font size="12">$plug_out</font></b>
						</td>
					</tr>
					$shipper
				</table>
				<br/>
				<br/>
				<br/>
				<br/>

				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/><font size="8">Keterangan :</font>
				<br/><font size="8">1. Kartu ini harap dibawa saat melakukan gate in</font>
				<br/><font size="8">2. Harap perhatikan Clossing Time dan Paid Thru</font>
				<br/><font size="8">3. Periksa kembali no container yang tertera pada kartu</font>
				<br/><font size="8">4. Bila kartu ini hilang harap segera melapor ke IPC</font>
				<br/><font size="8">5. Bila menemukan kartu ini harap menyerahkan pada IPC</font>
				<p align="center"><b><font size="10">Please fold here - Do not tear (Silahkan lipat di sini - Jangan disobek)</font></b></p>
				<br/>
				<p align="center"><b><font size="10">Gate Copy</font></b></p>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="center">
							<b><font size="12">No Container</font></b>
						</td>
						<td align="center">
							<b><font size="12">PIN</font></b>
						</td>
					</tr>
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="left">
							<b><font size="10">No Container</font></b>
						</td>
						<td align="left">
							<b><font size="10">Seal Number</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nocont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$seal_id</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_cont</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">ISO Code</font></b>
						</td>
						<td align="left">
							<b><font size="10">Size/Type</font></b>
						</td>
						<td align="left">
							<b><font size="10">Temperatur</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$iso_code</font></b>
						</td>
						<td align="left">
							<b><font size="12">$size_cont/$type_cont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$temp</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">No Urut</font></b>
						</td>
						<td align="left">
							<b><font size="10">IMO Class</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status TL</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nourut/$total</font></b>
						</td>
						<td align="left">
							<b><font size="12">$imo_class</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_tl</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Vessel</font></b>
						</td>
						<td align="left">
							<b><font size="10">Voyage</font></b>
						</td>
						<td align="left">
							<b><font size="10">Customer</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$vessel</font></b>
						</td>
						<td align="left">
							<b><font size="12">$voyage/$voyage_out</font></b>
						</td>
						<td align="left">
							<b><font size="9">$kode_pbm</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">No DO</font></b>
						</td>
						<td align="left">
							<b><font size="10">Tgl DO</font></b>
						</td>
						<td align="left">
							<b><font size="10">No Request</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$no_do</font></b>
						</td>
						<td align="left">
							<b><font size="12">$tgl_do</font></b>
						</td>
						<td align="left">
							<b><font size="12">$no_request ($billerId)</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Paid Thru</font></b>
						</td>
						<td align="left">
							<b><font size="10">Cetakan ke</font></b>
						</td>
						<td align="left">
							<b><font size="10">Lokasi Container</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$paid_thru</font></b>
						</td>
						<td align="left">
							<b><font size="12">$cetakan_ke</font></b>
						</td>
						<td align="left">
							<b><font size="12">$posisi</font></b>
						</td>
					</tr>
				</table>
EOD;

			$style = array(
				'position' => '',
				'align' => 'C',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				//'border' => true,
				'hpadding' => 'auto',
				'vpadding' => 'auto',
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255),
				'text' => true,
				'font' => 'helvetica',
				'fontsize' => 8,
				'stretchtext' => 4
			);

			$style_pin = array(
				'position' => '',
				'align' => 'C',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				//'border' => true,
				'hpadding' => 'auto',
				'vpadding' => 'auto',
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255),
				'text' => true,
				'font' => 'helvetica',
				'fontsize' => 13,
				'stretchtext' => 8
			);

			//Menampilkan Barcode dari nomor nota
			//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			//Logo IPC
			//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.$logo, 10, 9, 18, 12, '', '', '', true, 500);
			$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 15, 115, 180, 50, '', '', '', true, 72);
			//$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($tbl0, true, false, false, false, '');
			$pdf->write1DBarcode("$nocont", 'C128', 18, 30, '', 18, 0.4, $style, 'N');
			//khusus PNK tampilkan PIN 08/04/2019
			if($port_code=="IDPNK"){
				$pdf->write1DBarcode("$pin_number", 'C128', 130, 30, '', 18, 0.5, $style_pin, 'N');
			}else{
				$pdf->write1DBarcode("PIN", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
			}
			$pdf->write1DBarcode("$nocont", 'C128', 18, 183, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("PIN", 'C128', 130, 183, '', 18, 0.4, $style, 'N');

			$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '5,10', 'color' => array(0, 0, 0));

			// Line
			$pdf->Line(5, 180, 195, 180, $style3);

			//$pdf->writeHTML($tbl, true, false, false, false, '');
			//$pdf->write1DBarcode("PIN", 'C128', 0, 100, '', 18, 0.4, $style, 'N');

				$nourut++;
			}

			$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
			$pdf->SetFont('courier', 'B', 6);
			//Close and output PDF document
			$pdf->Output('sample.pdf', 'I');
			}
			else{
				echo "NO,GAGAL";
			}
		} else
			{
				echo "CETAKAN KE-".$cetakan_ke."\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
			}

		}
	}

	public function print_card_delply_atch($no_request,$port_code,$terminal_code,$hash=""){
			$this->redirect();
			//generate hash
			$customer_id=$this->container_model->getCustomerId($no_request);
			$hash_check = md5($no_request.$customer_id);
			if($hash!=$hash_check)
			{
				return;
			}
			//AP
			$uname_phd = $this->session->userdata('uname_phd');
			if($uname_phd == '')
				redirect(ROOT.'mainpage', 'refresh');

			$card_password = $billerId=$this->user_model->get_pdf_password($this->session->userdata('uname_phd'));
	        $billerId=$this->container_model->getNumberRequestBiller($no_request);

	        $in_data = "<root>
	            <sc_type>1</sc_type>
	            <sc_code>123456</sc_code>
	            <data>
	                <no_request>$billerId</no_request>
	                <port_code>$port_code</port_code>
	                <terminal_code>$terminal_code</terminal_code>
	            </data>
	        </root>";

			if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getPDFCardContainer",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//echo $result;die;
				$obj = json_decode($result);
				//$tbl=base64_decode($obj->data->proforma_html);
				//print_r($tbl); die();
				$total = $obj->data->jumlah;
				//update activity log
				$this->container_model->updateTransactionLogActivity($no_request,"PRINT_CARD",$id_user_eservice=$this->session->userdata('uname_phd'));
				$cetakan_ke = $this->container_model->getCountCardPrint($no_request);
				//validasi limit cetakan kartu
				$vld = $this->container_model->getValidCardPrint($cetakan_ke,'DEL');
				//echo $vld;die;
			if($vld=="Y")
			{
				//print_r(count($obj->data->detail_card));
				if($obj->data->detail_card){

				$this->load->helper('pdf_helper');
				tcpdf();
				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				//$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
				// set header and footer fonts
				//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetProtection 	($permissions = array('print', 'print'),
											$user_pass = $card_password,
											$owner_pass = null,
											$mode = 0,
											$pubkeys = null
										);
				//set margins
				$pdf->SetMargins(3, 3, 3);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->setPrintHeader(false);
				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);
				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				//set some language-dependent strings
				$pdf->setLanguageArray(null);
	// ---------------------------------------------------------

				if($terminal_code=='T3I')
				{
					//$terminal_name='TERMINAL 3 OCEAN GOING';
					$app_name='OPUS';
				}
				else if($terminal_code=='T3D')
				{
					//$terminal_name='TERMINAL 3 DOMESTIK';
					$app_name='ITOS';
				}
				else if($terminal_code=='T2D')
				{
					//$terminal_name='TERMINAL 2 DOMESTIK';
					$app_name='ITOS';
				}
				else if($terminal_code=='T1D')
				{
					//$terminal_name='TERMINAL 1 DOMESTIK';
					$app_name='ITOS';
				}
				else if($terminal_code=='T009D')
				{
					//$terminal_name='TERMINAL 1 009 (DOMESTIK)';
					$app_name='OPUS';
				}
				else if($terminal_code=='L2D'||$terminal_code=='L2I')
				{
					//$terminal_name='LINI 2';
					$app_name='LineOS';
				}

				//print_r($rowz); die();
				$nourut = 1;
				for($i=0;$i<count($obj->data->detail_card);$i++){
					$nocont = strtoupper($obj->data->detail_card[$i]->no_container);
				   // echo $nocont; die();
					$prefx 								= strtoupper($obj->data->detail_card[$i]->prefix);
					$id_nota			        =$obj->data->detail_card[$i]->id_nota;
					$id_req				        =$obj->data->detail_card[$i]->id_req;
					$disch_date		        =$obj->data->detail_card[$i]->disch_date;
					$posisi				        =$obj->data->detail_card[$i]->posisi;
					$clossing_time        =$obj->data->detail_card[$i]->clossing_time;
					$paid_thru2           =$obj->data->detail_card[$i]->paidthru;
					$etd                  =$obj->data->detail_card[$i]->etd;
					$vessel               =$obj->data->detail_card[$i]->vessel;
					$voyage               =$obj->data->detail_card[$i]->voyage;
					$voyage_out           =$obj->data->detail_card[$i]->voyage_out;
					$status_cont          =$obj->data->detail_card[$i]->status_cont;
					$size_cont            =$obj->data->detail_card[$i]->size_cont;
					$type_cont            =$obj->data->detail_card[$i]->type_cont;
					$no_container         =$obj->data->detail_card[$i]->no_container;
					$berat                =$obj->data->detail_card[$i]->berat;
					$pelabuhan_tujuan     =$obj->data->detail_card[$i]->pelabuhan_tujuan;
					$fpod                 =$obj->data->detail_card[$i]->fpod;
					$ipod                 =$obj->data->detail_card[$i]->ipod;
					$fipod                =$obj->data->detail_card[$i]->fipod;
					$peb                  =$obj->data->detail_card[$i]->peb;
					$npe                  =$obj->data->detail_card[$i]->npe;
					$kode_pbm             =$obj->data->detail_card[$i]->kode_pbm;
					$imo_class            =$obj->data->detail_card[$i]->imo_class;
					$temp                 =$obj->data->detail_card[$i]->temp;
					$iso_code             =$obj->data->detail_card[$i]->iso_code;
					$ipol                 =$obj->data->detail_card[$i]->ipol;
					$tgl_request          =$obj->data->detail_card[$i]->tgl_request;
					$prefix               =$obj->data->detail_card[$i]->prefix;
					$cont_numb            =$obj->data->detail_card[$i]->cont_numb;
					$booking_numb         =$obj->data->detail_card[$i]->booking_numb;
					$status_tl            =$obj->data->detail_card[$i]->status_tl;
					$no_do         		  =$obj->data->detail_card[$i]->no_do;
					$tgl_do               =$obj->data->detail_card[$i]->tgl_do;
					$seal_id               =$obj->data->detail_card[$i]->seal_id;
					$hdrGrup               =$obj->data->detail_card[$i]->hdrGrup;
					$pin_number				=$obj->data->detail_card[$i]->pin_number;

					//**** Get corporate and terminal
					$query="SELECT port_name, terminal_name FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
					$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
					$hasil = $query->row_array();
					$corporate_name = isset($hasil['PORT_NAME']) ? $hasil['PORT_NAME'] : '';
					$terminal_name = isset($hasil['TERMINAL_NAME']) ? $hasil['TERMINAL_NAME'] : '';

					if($paid_thru2<>'')
					{
						$paid_thru = $paid_thru2." 23:59";
					}
					else
					{
						$paid_thru = $paid_thru2;
					}

					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 6);

					if($type_cont == 'RFR'){
						$tblrfr = '<font style="font-size:24px">PLUG OUT</font> : <br/> <font style="font-size:24px">'.$plug_out.'</font>';
					}
					$dates = date('d-m-y h:i');

					$tbl0= <<<EOD
					<div style="width:767px; height:998px; border:1px solid #fff; font-family:Arial">
					<table width="100%" cellspacing="0" cellpadding="0" style="margin:0px; margin-top:5px; margin-bottom:10px; font-size:12px">
					<tbody>
					<tr>
					<td height="30" colspan="7"></td>
					</tr>
					<tr>
					<td width="15%">&nbsp;</td>
					<td width="39%">&nbsp;</td>
					<td width="14%" colspan="3"></td>
					<td width="17%" align="right"></td>
					<td width="17%">&nbsp;&nbsp; </td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="2" align="center">$id_nota</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
					<td align="center"></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td align="right">NO REQ :</td>
					<td>$id_req</td>
					</tr>
					<tr>
					<td height="82" colspan="7">&nbsp;</td>
					</tr>
					<tr>
					<td height="20">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td style="padding-left:45px" colspan="2"></td>
					</tr>
					<tr>
					<td height="25">&nbsp;</td>
					<td>
					<b style="font-size:24px">$prefx $cont_numb</b>
					</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="2">
					<p align="center" style="font:Arial; font-size:22px">[$app_name - $terminal_name]</p>
					</td>
					</tr>
					<tr>
					<td height="20">&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>$size_cont / $type_cont / $status_cont</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>$vessel/$voyage $voyage_out</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="2">$eta - $etd</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>$operator_name</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="2">$no_bl</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td colspan="4">&nbsp;</td>
					<td colspan="2">$no_do</td>

					</tr>
					<tr>
					<td>&nbsp;</td>
					<td colspan="4">$kode_pbm</td>
					<td colspan="2">$disch_date</td>
					</tr>
					<tr>
					<td height="15">&nbsp;</td>
					<td>$kode_pbm</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="2">$paid_thru2</td>
					</tr>
					<tr height='30' valign='top'> <!--56-->
					<td height="15">&nbsp;</td>
					<td>Date Do:$tgl_do</td>

					<td ></td>
					<td colspan="3">$posisi</td>
					<td colspan="2" align="left"></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>$tblrfr</td>
					<td>&nbsp;</td>
					<td colspan="2">&nbsp;</td>
					<td>$dates</td>
					<td></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td></td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td></td>
					<td>TL/YARD : <B>$status_tl</B></td>
					<td colspan="3"></td>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					<td height="39">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td></td>
					<td colspan="2">&nbsp;</td>
					</tr>
					</tr>
					</tbody>
					</table>
					</div>
					<div style="margin-top:100px;width:767px;"></div>
EOD;

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 8,
					'stretchtext' => 4
				);

				$style_pin = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 13,
					'stretchtext' => 8
				);

				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 10, 9, 18, 12, '', '', '', true, 72);
				//$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 15, 115, 180, 50, '', '', '', true, 72);
				//$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->writeHTML($tbl0, true, false, false, false, '');
				if($port_code=="IDPNK"){
					$pdf->write1DBarcode("$pin_number", 'C128', 38, 20, '', 18, 0.5, $style_pin, 'N');
				}
				//$pdf->write1DBarcode("$nocont", 'C128', 18, 30, '', 18, 0.4, $style, 'N');
				//$pdf->write1DBarcode("PIN", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
				//$pdf->write1DBarcode("$nocont", 'C128', 18, 198, '', 18, 0.4, $style, 'N');
				//$pdf->write1DBarcode("PIN", 'C128', 130, 198, '', 18, 0.4, $style, 'N');

				//$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '5,10', 'color' => array(0, 0, 0));
				// Line
				//$pdf->Line(5, 180, 195, 180, $style3);

				//$pdf->writeHTML($tbl, true, false, false, false, '');
				//$pdf->write1DBarcode("PIN", 'C128', 0, 100, '', 18, 0.4, $style, 'N');

					$nourut++;
				}

				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('courier', 'B', 6);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
				}
				else{
					echo "NO,GAGAL";
				}
			} else
				{
					echo "CETAKAN KE-".$cetakan_ke."\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
				}

			}
		}

	public function print_card_delivery($no_request,$port_code,$terminal_code,$hash=""){

		$this->redirect();

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if($dataBilling["STATUS_REQ"]!="P")
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->print_card_delivery_atch($no_request,$port_code,$terminal_code,$hash);

}

public function print_card_delply($no_request,$port_code,$terminal_code,$hash=""){

		$this->redirect();
		$dataBilling = $this->container_model->getDetailBilling($no_request);
		if($dataBilling["STATUS_REQ"]!="P")
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));
		$this->print_card_delply_atch($no_request,$port_code,$terminal_code,$hash);
}

	public function upload_excel_delivery() {
			//include "excel_reader2.php";
			include_once ( APPPATH."libraries/excel_reader2.php");

			$terminal_excel = $_POST['terminal_excel'];
			$vessel_excel = $_POST['vessel_excel'];
			$id_vsb_voyage_excel = $_POST['id_vsb_voyage_excel'];
			$vessel_code_excel = $_POST['vessel_code_excel'];
			$call_sign_excel = $_POST['call_sign_excel'];
			$voyage_in_excel = $_POST['voyage_in_excel'];
			$voyage_out_excel = $_POST['voyage_out_excel'];
			$req 			= $_POST['req_excel'];
			$reqori = $this->container_model->getNumberRequestBiller($req);
			$date_delivery_excel = $_POST['date_delivery_excel'];
			$date_discharge_excel = $_POST['date_discharge_excel'];
			$delivery_type_excel = $_POST['delivery_type_excel'];
			if(($delivery_type_excel=='N')||($delivery_type_excel=='LAP'))
			{
				$delivery_type_excel='YARD';
			}
			ELSE
			{
				$delivery_type_excel='TL';
			}
			//get detail delivery
			$port			= explode("-",$terminal_excel);
			$vessel_code	= $vessel_code_excel;
			$voyage_in		= $voyage_in_excel;
			$voyage_out		= $voyage_out_excel;

			//membaca file excel yang diupload
			$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

			//membaca jumlah baris dari data excel
			$baris = $data->rowcount($sheet_index = 0);
			//echo($baris);
			//die();
			//nilai awal counter jumlah data yang sukses dan yang gagal diimport
			$sukses = 0;
			$gagal = 0;
			$param = '';
			$param_temp="";
			$temp=null;
			$jumlah_OK=0;
			//echo($baris);die;
			//import data excel dari baris kedua, karena baris pertama adalah nama kolom
			for ($i = 2; $i <= $baris; $i++) {
				//membaca data nama depan (kolom ke-1)  (No Container)
				$no_container = $data->val($i, 1);
				//$ukk 			= $_GET['ukk'];
				if($no_container!=""){
					$stack = array();

					//no error
					// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
					// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
					
					if($port[1] == 'L2D' || $port[1] == 'L2I'){
						$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_container>$no_container</no_container>
								<port_code>".$port[0]."</port_code>
								<terminal_code>".$port[1]."</terminal_code>
								<vessel_code>$vessel_code</vessel_code>
								<voyage_in>$voyage_in</voyage_in>
								<voyage_out>$voyage_out</voyage_out>
								<del_type>$delivery_type_excel</del_type>
								<vessel>$vessel_excel</vessel>
							</data>
						</root>";
						//echo $in_data;
					}
					else{
						$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_container>$no_container</no_container>
								<port_code>".$port[0]."</port_code>
								<terminal_code>".$port[1]."</terminal_code>
								<vessel_code>$vessel_code</vessel_code>
								<voyage_in>$voyage_in</voyage_in>
								<voyage_out>$voyage_out</voyage_out>
								<del_type>$delivery_type_excel</del_type>
							</data>
						</root>";
					}
					//echo $in_data;die;
					if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getDetailContainer",array("in_data" => "$in_data"),$result))
					{
						echo $result;
						die;
					}
					else
					{
						//echo $result;die;
						$obj = json_decode($result);

						if($obj->data->container)
						{
							for($j=0;$j<count($obj->data->container);$j++)
							{
								$temp=null;
								$temp['NO_CONTAINER']=$obj->data->container[$j]->no_container;
								$temp['SIZE_CONT']=$obj->data->container[$j]->size_cont;
								$temp['TYPE_CONT']=$obj->data->container[$j]->type_cont;
								$temp['STATUS_CONT']=$obj->data->container[$j]->status_cont;
								$temp['HEIGHT_CONT']=$obj->data->container[$j]->height_cont;
								$temp['ID_CONT']=$obj->data->container[$j]->id_cont;
								$temp['HZ']=$obj->data->container[$j]->hz;
								$temp['IMO_CLASS']=$obj->data->container[$j]->imo_class;
								$temp['UN_NUMBER']=$obj->data->container[$j]->un_number;
								$temp['ISO_CODE']=$obj->data->container[$j]->iso_code;
								$temp['TEMP']=$obj->data->container[$j]->temp;
								$temp['WEIGHT']=$obj->data->container[$j]->weight;
								$temp['CARRIER']=$obj->data->container[$j]->carrier;
								$temp['OOG']=$obj->data->container[$j]->oog;
								$temp['OVER_LEFT']=$obj->data->container[$j]->over_left;
								$temp['OVER_RIGHT']=$obj->data->container[$j]->over_right;
								$temp['OVER_FRONT']=$obj->data->container[$j]->over_front;
								$temp['OVER_REAR']=$obj->data->container[$j]->over_rear;
								$temp['OVER_HEIGHT']=$obj->data->container[$j]->over_height;
								$temp['POD']=$obj->data->container[$j]->pod;
								$temp['POL']=$obj->data->container[$j]->pol;
								$temp['COMODITY']=$obj->data->container[$j]->comodity;
								array_push($stack, $temp);
							}
						}
					}

					//add container to request delivery
					$stack = array();

					if ($temp != null){
						try{
							//no error
							// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
							// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
							$in_data="	<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<port_code>".$port[0]."</port_code>
									<terminal_code>".$port[1]."</terminal_code>
									<id_req>$reqori</id_req>
									<id_ves_voyage>$id_vsb_voyage_excel</id_ves_voyage>
									<vessel>$vessel_excel</vessel>
									<vessel_code>$vessel_code_excel</vessel_code>
									<call_sign>$call_sign_excel</call_sign>
									<voyage_in>$voyage_in_excel</voyage_in>
									<voyage_out>$voyage_out_excel</voyage_out>
									<no_container>".$temp['NO_CONTAINER']."</no_container>
									<size_cont>".$temp['SIZE_CONT']."</size_cont>
									<type_cont>".$temp['TYPE_CONT']."</type_cont>
									<status_cont>".$temp['STATUS_CONT']."</status_cont>
									<height_cont>".$temp['HEIGHT_CONT']."</height_cont>;
									<id_cont>".$temp['ID_CONT']."</id_cont>
									<hz>".$temp['HZ']."</hz>
									<imo_class>".$temp['IMO_CLASS']."</imo_class>
									<un_number>".$temp['UN_NUMBER']."</un_number>
									<iso_code>".$temp['ISO_CODE']."</iso_code>
									<temp>".$temp['TEMP']."</temp>
									<disabled></disabled>
									<weight>".$temp['WEIGHT']."</weight>
									<carrier>".$temp['CARRIER']."</carrier>
									<oog>".$temp['OOG']."</oog>
									<over_left>".$temp['OVER_LEFT']."</over_left>
									<over_right>".$temp['OVER_RIGHT']."</over_right>
									<over_front>".$temp['OVER_FRONT']."</over_front>
									<over_rear>".$temp['OVER_REAR']."</over_rear>
									<over_height>".$temp['OVER_HEIGHT']."</over_height>
									<date_delivery>$date_delivery_excel</date_delivery>
									<date_discharge>$date_discharge_excel</date_discharge>
									<delivery_type>$delivery_type_excel</delivery_type>
									<pod>".$temp['POD']."</pod>
									<pol>".$temp['POL']."</pol>
								</data>
							</root>";
							//echo $in_data;die;
							if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"addDetailContainer",array("in_data" => "$in_data"),$result))
							{
								echo $result;
								die;
							}
							else
							{
								//echo $result;die;
								$obj = json_decode($result);

								if($obj->data->info)
								{
									if($obj->data->info=='OK')
									{
										$jumlah_OK++;
									} else {
										$param_temp .= $no_container.' - '.$obj->data->info.' <br>';
									}
								} else {
									echo "NO,GAGAL";
								}
							}

						} catch (Exception $e) {
							echo "NO,GAGAL";
						}
					} else {
						$param_temp .= $no_container.' - Container Not Found <br>';
					}
				}
			}
			$param='Jumlah OK '.$jumlah_OK.'<br>';
			$param.=$param_temp;
			//echo($param_temp);
			//print_r($param_temp);
			//$param='Jumlah OK '.$jumlah_OK.'<br>';
			//$param.=$param_temp;
			//echo($param);
			$param=str_replace("^","-",$param);
			$param=str_replace(","," ",$param);
			header("Location: ".ROOT."container/edit_delivery/".$req."/".($param));
			die();
	}

	public function view_request($a)
	{
		$data['no_request']=$a;
		$datahead=$this->container_model->getNumberReqAndSource($a);
		$data['rowdata']=$datahead;

		if($datahead['MODUL']=='RECEIVING')
		{
			$wsdl = REQUEST_RECEIVING_CONTAINER;
			$modul = "getListContainer";
		}
		else if($datahead['MODUL']=='DELIVERY')
		{
			$wsdl = REQUEST_DELIVERY_CONTAINER;
			$modul = "getListContainer";
		}
		else if($datahead['MODUL']=='PERPANJANGAN DELIVERY')
		{
			$wsdl = REQUEST_PERPANJANGAN_DELIVERY;
			$modul = "getListContainerDelivery";
		}
		else if (($datahead['MODUL']=='CALBG') OR ($datahead['MODUL']=='CALAG') OR ($datahead['MODUL']=='CALDG'))
		{
			$wsdl = REQUEST_BATALMUAT;
			$modul = "getListContainerBM";
		}

        $stack = array();
		$reqNoBiller=$datahead['BILLER_REQUEST_ID'];

        $in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$reqNoBiller</norequest>
				<port_code>".$datahead['PORT_ID']."</port_code>
				<terminal_code>".$datahead['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,"$modul",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->listcont)
			{
				for($i=0;$i<count($obj->data->listcont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->listcont[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->listcont[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->listcont[$i]->type_cont;
					$temp['STATUS_CONT']=$obj->data->listcont[$i]->status_cont;
					$temp['HZ']=$obj->data->listcont[$i]->hz;
					$temp['KD_COMODITY']=$obj->data->listcont[$i]->kd_comodity;
					$temp['ID_CONT']=$obj->data->listcont[$i]->id_cont;
					$temp['ISO_CODE']=$obj->data->listcont[$i]->iso_code;
					$temp['HEIGHT']=$obj->data->listcont[$i]->height;
					$temp['CARRIER']=$obj->data->listcont[$i]->carrier;
					$temp['OG']=$obj->data->listcont[$i]->og;
					$temp['PLUG_IN']=$obj->data->listcont[$i]->plug_in;
					$temp['PLUG_OUT']=$obj->data->listcont[$i]->plug_out;
					$temp['PLUG_OUT_EXT']=$obj->data->listcont[$i]->plug_out_ext;
					$temp['JML_SHIFT']=$obj->data->listcont[$i]->jml_shift;
					$POD=$obj->data->listcont[$i]->pod;
					$FPOD=$obj->data->listcont[$i]->fpod;
					$start_shift=$obj->data->listcont[$i]->start_shift;
					$end_shift=$obj->data->listcont[$i]->end_shift;
					$shift_reefer=$obj->data->listcont[$i]->shift_rfr;
					$temp['NO_BOOKING_SHIP']=$obj->data->listcont[$i]->no_booking_ship;
					$tl=$obj->data->listcont[$i]->tl_flag;
					$call_sign=$obj->data->listcont[$i]->call_sign;
					$stpr=$obj->data->listcont[$i]->start_period;
					$enpr=$obj->data->listcont[$i]->end_period;
					$expr=$obj->data->listcont[$i]->ext_period;
					array_push($stack, $temp);
				}
			}
		}


		$data['TL_FLAG']=$tl;
		$data['CALL_SIGN']=$call_sign;
		$data['POD']=$POD;
		$data['FPOD']=$FPOD;
		$data['START_SHIFT']=$start_shift;
		$data['END_SHIFT']=$end_shift;
		$data['SHIFT_REEFER']=$shift_reefer;
		$data['START_PERIOD']=$stpr;
		$data['END_PERIOD']=$enpr;
		$data['EXT_PERIOD']=$expr;
		$data['row_detail']=$stack;
		$data['row_history']=$this->container_model->getRequestHistory($a);
		$this->load->view('pages/container/approval_request_viewreq',$data);
	}

	public function auto_vessel_all(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["term"])));

		injek($term);

		$port			= explode("-",$this->security->xss_clean(htmlentities($_GET["port"])));
		$stack = array();

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
        //echo $in_data;die;
		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getVesselVoyage",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->vessel)
			{
				for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$temp;
					$temp['VESSEL']=$obj->data->vessel[$i]->vessel_name;
					$temp['VOYAGE_IN']=$obj->data->vessel[$i]->voyage_in;
					$temp['VOYAGE_OUT']=$obj->data->vessel[$i]->voyage_out;
					array_push($stack, $temp);
				}
			}
		}

		echo json_encode($stack);
	}
	
	
	public function view_proforma($a)
	{
		$data['no_request']=$a;
		//print_r($a);die;
		$datahead=$this->container_model->getNumberReqAndSource($a);
		$data['rowdata']=$datahead;
		$port_id= $datahead['PORT_ID'];
		$terminal_id= $datahead['PORT_ID'];
		$biller_request_id= $datahead['BILLER_REQUEST_ID'];
		
		
		//print_r($datahead['MODUL']);die;
		if($datahead['MODUL']=='RECEIVING')
		{
			$wsdl = REQUEST_RECEIVING_CONTAINER;
			$modul = "getListProforma";
		}
		else if($datahead['MODUL']=='DELIVERY')
		{
			$wsdl = REQUEST_DELIVERY_CONTAINER;
			$modul = "getListProforma";
		}
		else if($datahead['MODUL']=='PERPANJANGAN DELIVERY')
		{
			$wsdl = REQUEST_PERPANJANGAN_DELIVERY;
			//$modul = "getListContainerDelivery";
			$modul = "getListProforma";
		}
		else if (($datahead['MODUL']=='CALBG') OR ($datahead['MODUL']=='CALAG') OR ($datahead['MODUL']=='CALDG'))
		{
			$wsdl = REQUEST_BATALMUAT;
			//$modul = "getListContainerBM";
			$modul = "getListProforma";
		}

        $stack = array();
		$reqNoBiller=$datahead['BILLER_REQUEST_ID'];

        $in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$reqNoBiller</norequest>
				<port_code>".$datahead['PORT_ID']."</port_code>
				<terminal_code>".$datahead['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";
		//print_r($datahead['MODUL']);die;
		if(!$this->nusoap_lib->call_wsdl($wsdl,"$modul",array("in_data" => "$in_data"),$result))
		{
			echo $result; //echo 'aasal';
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
					$temp;
					//header
					$customer_name = $obj->data->listcont[$i]->customer_name;
					$customer_address = $obj->data->listcont[$i]->customer_address;
					$vesvoy = $obj->data->listcont[$i]->vesvoy;
					$npwp = $obj->data->listcont[$i]->npwp;
					$norequest = $obj->data->listcont[$i]->norequest;
					$tgl_request = $obj->data->listcont[$i]->tgl_request;
					
					//detail
					$temp['TGL_START_STACK']=$obj->data->listcont[$i]->tgl_start_stack;
					$temp['TGL_END_STACK']=$obj->data->listcont[$i]->tgl_end_stack;
					$temp['UKURAN']=$obj->data->listcont[$i]->ukuran;
					$temp['TYPE']=$obj->data->listcont[$i]->type;
					$temp['STATUS']=$obj->data->listcont[$i]->status;
					$temp['HEIGHT_CONT']=$obj->data->listcont[$i]->height_cont;
					$temp['JUMLAH_CONT']=$obj->data->listcont[$i]->jumlah_cont;
					$temp['JUMLAH_HARI']=$obj->data->listcont[$i]->jumlah_hari;
					$temp['KETERANGAN']=$obj->data->listcont[$i]->keterangan;
					$temp['TARIF']=$obj->data->listcont[$i]->tarif;
					$temp['SUB_TOTAL']=$obj->data->listcont[$i]->sub_total;
					$temp['HZ']=$obj->data->listcont[$i]->hz;
					
					if($datahead['MODUL']=='DELIVERY')
					{
						$disch_date = $obj->data->listcont[$i]->disch_date;
						$tgl_sppb = $obj->data->listcont[$i]->tgl_sppb;
					}
					
					array_push($stack, $temp);
				}
			}
			
			if($obj->data->footer)
			{
				for($i=0;$i<count($obj->data->footer);$i++)
				{
					$ket = $obj->data->footer[$i]->keterangan;
					
					if ($ket == 'ADM' || $ket == 'ADMINISTRASI') 
					{
						$adm = $obj->data->footer[$i]->sub_total;
					}
					else if ($ket == 'MATERAI') 
					{
						$materai  = $obj->data->footer[$i]->sub_total;
					}
					else if ($ket == 'DPP') 
					{
						$dpp  = $obj->data->footer[$i]->sub_total;
					}
					else if ($ket == 'PPN') 
					{
						$ppn  = $obj->data->footer[$i]->sub_total;
					}
					else if ($ket == 'TOTAL') 
					{
						$total  = $obj->data->footer[$i]->sub_total;
					}
				}
			}
		}
		
		
		$data['CUSTOMER_NAME'] =$customer_name;
		$data['CUSTOMER_ADDRESS'] =$customer_address;
		$data['VESVOY'] =$vesvoy;
		$data['NPWP'] =$npwp;
		$data['NOREQUEST'] =$norequest;
		$data['TGL_REQUEST'] =$tgl_request;
		
		if($datahead['MODUL']=='DELIVERY')
		{
			$data['DISCH_DATE'] =$disch_date;
			$data['TGL_SPPB'] =$tgl_sppb;
		}
		
		if ($adm === NULL)
		{
			$adm =0;
		}
		$data['ADM'] =$adm;
		
		if ($materai === NULL)
		{
			$materai = 0;
		}
		$data['MATERAI'] =$materai;
		
		if ($dpp === NULL)
		{
			$dpp = 0;
		}
		$data['DPP'] =$dpp;
		
		if ($ppn === NULL)
		{
			$ppn = 0;
		}
		$data['PPN'] =$ppn;
		
		if ($total === NULL)
		{
			$total = 0;
		}
		$data['TOTAL'] =$total;
		
		
		
		$data['row_detail']=$stack;
		//print_r($data);die;

		/*$data['TL_FLAG']=$tl;
		$data['CALL_SIGN']=$call_sign;
		$data['POD']=$POD;
		$data['FPOD']=$FPOD;
		$data['START_SHIFT']=$start_shift;
		$data['END_SHIFT']=$end_shift;
		$data['SHIFT_REEFER']=$shift_reefer;
		$data['START_PERIOD']=$stpr;
		$data['END_PERIOD']=$enpr;
		$data['EXT_PERIOD']=$expr;
		$data['row_detail']=$stack;
		$data['row_history']=$this->container_model->getRequestHistory($a);
		*/
		$this->load->view('pages/container/approval_request_viewproforma',$data);
		
		
	}

}
