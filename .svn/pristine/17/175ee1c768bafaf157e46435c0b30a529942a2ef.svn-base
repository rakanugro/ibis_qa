<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stevedoringmanagement extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('om/billing_model');
		$this->load->model('container_model');
		$this->load->model('master_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views) {
		$this->load->view('templates/om/header', $data);
		$this->load->view('templates/om/top_bar', $data);
		$this->load->view('templates/om/menu_side', $data);
		$this->load->view('templates/om/top-1-breadcrumb', $data);
		$this->load->view('templates/om/top-2-title-nosearch', $data);
		if (is_array($views)){foreach($views as $view)$this->load->view($view, $data);}else{$this->load->view($views, $data);}
		$this->load->view('templates/om/footer', $data);
	}

	public function redirect(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
	}

	public function index(){
		$this->redirect();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Stevedoring Management", 'om/stevedoringmanagement');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Stevedoring Management";

		$this->common_loader($data,'pages/om/stevedoring_management');
	}

	public function search_table(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$customer_id=$this->session->userdata('customerid_phd');
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : "";

		$this->table->set_heading(
			"NO",
			"REQUEST NO",
			"VESSEL - VOYAGE",
			"CUSTOMER",
			"PORT - TERMINAL",
			"DATE REQUEST",
			"STATUS",
			"UPER",
			"REALISASI",
			"PROFORMA",
			"NOTA",
			"TRANSFER"
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
		
		// call API
		$wsdl = ORDER_MGT;
		$modul = "getStevedoringList";
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<search>$search</search>
							<id_customer>$customer_id</id_customer>
						</data>
					</root>";
		//print_r($in_data);die;			
		$stack = array();
		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);die();
			$obj = json_decode($result);
			// print_r($obj);
			if($obj->data->retval)
			{
				for($i=0;$i<count($obj->data->retval);$i++)
				{
					$row = (array) $obj->data->retval[$i];
					// print_r($row);

					$recalculate = 0;
					$urluper = ROOT."om/printer/uper";
					$urlrealisasi = ROOT."om/printer/realisasi";
					$urlproforma = ROOT."om/printer/proforma";
					$urlnota = ROOT."om/printer/nota";

					$request_id = $this->security->xss_clean($row['ID_REQ']);
					$vesvoy = $this->security->xss_clean($row['VESVOY']);
					$terminal_name = $this->security->xss_clean($row['TERMINAL_NAME']);
					$customer = $this->security->xss_clean($row['CUST_NAME']);
					$request_date = $this->security->xss_clean($row['REQ_DATE']);
					$status = $this->security->xss_clean($row['KET_STATUS_REQ']);
					$label_span='<span class="label label-danger">N/A</span>';
					$uperlink = "";
					$viewlink = "";
					$proformalink = "";
					$notalink = "";
					$transferlink = "";

					// $uperlink1 ='<a class=\'btn btn-success\' onclick=\'clickConfirm("save_uper", "'.$request_id.'", "'.$recalculate.'");\' title=\'Calculate\'><i class=\'fa fa-floppy-o \'></i></a>';
					$uperlink2 = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urluper.'/'.$this->security->xss_clean($row['ID_UPER']).'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';

					//$viewlink1 = '<a  class=\'btn btn-success\' onclick=\'clickConfirm("download_realisasi", "'.$request_id.'", "0");\' title="Download"><i class="fa fa-download"></i></a>';
					//$viewlink2 ='<a class=\'btn btn-primary\' onclick=\'clickDialog1("'.$request_id.'");\' title=\'View\'><i class=\'fa fa-eye\'></i></a>';
					//$viewlink3 = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urlrealisasi.'/'.$request_id.'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';
					//$viewlink4 = '<a  class=\'btn btn-success\' onclick=\'clickConfirm("confirm_realisasi", "'.$request_id.'", "'.$recalculate.'");\' title="Save"><i class="fa fa-floppy-o"></i></a>';
					//$viewlink5 = '<a  class=\'btn btn-success\' onclick=\'cancelConfirm("cancel_stevedoring", "'.$request_id.'", "'.$recalculate.'", "'.$status.'");\' title="Cancel"><i class="fa fa-repeat"></i></a>';

					//$proformalink1 ="<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($row['ID_PROFORMA'])."' title='Print'><i class='fa fa-file-pdf-o'></i></a>";
					//$proformalink2 = '<a class=\'btn btn-success\' onclick=\'clickConfirm("save_proforma", "'.$request_id.'");\' title="Save"><i class="fa fa-floppy-o"></i></a>';

					//$notalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$this->security->xss_clean($row['ID_INV'])."' title='Print'><i class='fa fa-file-pdf-o'></i></a>";

					//$transferlink1 ='<a  class=\'btn btn-success\' onclick=\'clickConfirm("transfer_simkeu", "'.$request_id.'");\' title="Transfer"><i class="fa fa-share-square-o"></i></a>';

					if ($customer_id==''){
						$uperlink2 = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urluper.'/'.$this->security->xss_clean($row['ID_UPER']).'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';

					$viewlink1 = '<a  class=\'btn btn-success\' onclick=\'clickConfirm("download_realisasi", "'.$request_id.'", "0");\' title="Download"><i class="fa fa-download"></i></a>';
					$viewlink2 ='<a class=\'btn btn-primary\' onclick=\'clickDialog1("'.$request_id.'");\' title=\'View\'><i class=\'fa fa-eye\'></i></a>';
					$viewlink3 = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urlrealisasi.'/'.$request_id.'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';
					$viewlink4 = '<a  class=\'btn btn-success\' onclick=\'clickConfirm("confirm_realisasi", "'.$request_id.'", "'.$recalculate.'");\' title="Save"><i class="fa fa-floppy-o"></i></a>';
					$viewlink5 = '<a  class=\'btn btn-success\' onclick=\'cancelConfirm("cancel_stevedoring", "'.$request_id.'", "'.$recalculate.'", "'.$status.'");\' title="Cancel"><i class="fa fa-repeat"></i></a>';

					$proformalink1 ="<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($row['ID_PROFORMA'])."' title='Print'><i class='fa fa-file-pdf-o'></i></a>";
					$proformalink2 = '<a class=\'btn btn-success\' onclick=\'clickConfirm("save_proforma", "'.$request_id.'");\' title="Save"><i class="fa fa-floppy-o"></i></a>';

					$notalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$this->security->xss_clean($row['ID_INV'])."' title='Print'><i class='fa fa-file-pdf-o'></i></a>";

					$transferlink1 ='<a  class=\'btn btn-success\' onclick=\'clickConfirm("transfer_simkeu", "'.$request_id.'");\' title="Transfer"><i class="fa fa-share-square-o"></i></a>';
					} else 
					{
						//$uperlink2 = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urluper.'/'.$this->security->xss_clean($row['ID_UPER']).'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';

					$viewlink1 = '<span class="label label-info">Billing Only</span>';
					//$viewlink2 ='<a class=\'btn btn-primary\' onclick=\'clickDialog1("'.$request_id.'");\' title=\'View\'><i class=\'fa fa-eye\'></i></a>';
					//$viewlink3 = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urlrealisasi.'/'.$request_id.'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';
					//$viewlink4 = '<a  class=\'btn btn-success\' onclick=\'clickConfirm("confirm_realisasi", "'.$request_id.'", "'.$recalculate.'");\' title="Save"><i class="fa fa-floppy-o"></i></a>';
					//$viewlink5 = '<a  class=\'btn btn-success\' onclick=\'cancelConfirm("cancel_stevedoring", "'.$request_id.'", "'.$recalculate.'", "'.$status.'");\' title="Cancel"><i class="fa fa-repeat"></i></a>';

					$proformalink1 ="<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($row['ID_PROFORMA'])."' title='Print'><i class='fa fa-file-pdf-o'></i></a>";
					//$proformalink2 = '<a class=\'btn btn-success\' onclick=\'clickConfirm("save_proforma", "'.$request_id.'");\' title="Save"><i class="fa fa-floppy-o"></i></a>';

					$notalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$this->security->xss_clean($row['ID_INV'])."' title='Print'><i class='fa fa-file-pdf-o'></i></a>";

					$transferlink1 ='<span class="label label-info">Billing Only</span>';
					}
					if($row['STATUS_REQ']=="N"){
						$label_span='<span class="label label-info">Draft</span>';
						$uperlink = $uperlink2;
					}else if($row['STATUS_REQ']=="A"){
						$label_span='<span class="label label-info">Approved</span>';
						if($row['ID_TYPAY']=="UP"){
							$uperlink = $uperlink2;
						}else if($row['ID_TYPAY']=="CD"){
							$viewlink = $viewlink1.$viewlink2.$viewlink3.$viewlink4;
						}
					}else if($row['STATUS_REQ']=="Q"){
						$label_span='<span class="label label-warning">Uper</span>';
						$uperlink = $uperlink2;
						$viewlink = $viewlink1.$viewlink2.$viewlink3.$viewlink4;
					}else if($row['STATUS_REQ']=="R"){
						$label_span='<span class="label label-warning">Realisasi</span>';
						if($row['ID_TYPAY']=="UP"){
							$uperlink = $uperlink2;
							$viewlink = $viewlink1.$viewlink2.$viewlink3.$viewlink4;
						}else if($row['ID_TYPAY']=="CD"){
							$viewlink = $viewlink1.$viewlink2.$viewlink3.$viewlink4;
						}
					}else if($row['STATUS_REQ']=="S"){
						$label_span='<span class="label label-warning">Realisasi</span>';
						$uperlink = $uperlink2;
						$viewlink = $viewlink3.$viewlink5;
						$proformalink = $proformalink1.$proformalink2;
					}else if($row['STATUS_REQ']=="U"){
						$label_span='<span class="label label-success">Piutang</span>';
						$uperlink = $uperlink2;
						$viewlink = $viewlink3;
						$proformalink = $proformalink1;
						$notalink = $notalink1.$viewlink5;
						$transferlink = $transferlink1;
					}else if($row['STATUS_REQ']=="P"){
						$label_span='<span class="label label-success">Paid</span>';
						$uperlink = $uperlink2;
						$viewlink = $viewlink3;
						$proformalink = $proformalink1;
						$notalink = $notalink1;
					}else if($row['STATUS_REQ']=="T"){
						$label_span='<span class="label label-success">Transfer</span>';
						$uperlink = $uperlink2;
						$viewlink = $viewlink3;
						$proformalink = $proformalink1;
						$notalink = $notalink1;
					}

					// input hidden
					$label_span.="<input type='hidden' id='id_port_".$request_id."' value='".$this->security->xss_clean($row['ID_PORT'])."' />";

					$this->table->add_row(
						($i+1),
						$request_id,
						$vesvoy,
						$customer,
						$terminal_name,
						$request_date,
						$label_span,
						$uperlink,
						$viewlink,
						$proformalink,
						$notalink,
						$transferlink
					);
				}
			}
		}

		$this->load->view('pages/om/stevedoring_management_grid', $data);
	}

	public function view_detail($id_request){
		$data['id_request'] = $id_request;

		$stack = array();
		$wsdl = ORDER_MGT;
		$modul = "getStevedoringDetail";

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_request>".$id_request."</id_request>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->retval)
			{
				// print_r($obj->data->retval);
				$data['row_header']= (array) $obj->data->retval->header;
				$data['row_detail']= (array) $obj->data->retval->detail;
			}
		}

		$data['row_history']=array();
		$this->load->view('pages/om/stevedoring_management_view_detail',$data);
	}

	public function update_realisasi(){
		// print_r($_POST);
		$id_req = $_POST['id_req'];
		$dtl_no = $_POST['dtl_no'];
		$qty = $_POST['qty'];
		$ton = $_POST['ton'];
		$cbc = $_POST['cbc'];
		$id_user = $this->session->userdata('uname_phd');

		$stack = array();
		$wsdl = ORDER_MGT;
		$modul = "updateStevedoringDetail";

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>".$id_req."</id_req>
				<dtl_no>".$dtl_no."</dtl_no>
				<qty>".$qty."</qty>
				<ton>".$ton."</ton>
				<cbc>".$cbc."</cbc>
				<id_user>".$id_user."</id_user>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			echo $obj->data->retval;
		}
	}

	public function confirm_realisasi(){
		$id_req = $_POST['id_req'];
		$recalculate = $_POST['recalculate'];

		$wsdl = BILLING_ENGINE;
		$modul = "calculate";
		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<request_no>".$id_req."</request_no>
						<recalculate>".$recalculate."</recalculate>
					</data>
				</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;
			// die;
			$obj = json_decode($result);
			if ($obj->rc == 'S'){
				$detail = json_encode($obj->data);
				$id_user = $this->session->userdata('uname_phd');

				$wsdl = ORDER_MGT;
				$modul = "saveRealisasi";

				$in_data = "<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<recalculate>".$recalculate."</recalculate>
								<id_user>".$id_user."</id_user>
								<detail>".$detail."</detail>
							</data>
						</root>";

				if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
				{
					print_r($result);
					die;
				}
				else
				{
					// print_r($result);
					// die;
					$obj = json_decode($result);
					echo $obj->data->retval;
				}
			}
		}
	}
	
	public function cancel_stevedoring(){
		$id_req = $_POST['id_req'];
		$recalculate = $_POST['recalculate'];
		$status = $_POST['status'];
		$id_user = $this->session->userdata('uname_phd');

		$wsdl = ORDER_MGT;
		$modul = "cancelRealisasi";
		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<request_no>".$id_req."</request_no>
						<recalculate>".$recalculate."</recalculate>
						<id_user>".$id_user."</id_user>
						<status>".$status."</status>
					</data>
				</root>";
        //print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//print_r($result);
			//die;
			$obj = json_decode($result);
			echo $obj->data->retval;
		}
	}	

	public function download_realisasi(){
		$id_req = $_POST['id_req'];
		$wsdl = ORDER_MGT;
		$modul = "getDownload_RBM_Cargo";
		$id_user = $this->session->userdata('uname_phd');
		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<request_no>".$id_req."</request_no>
						<user>".$id_user."</user>
					</data>
				</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;
			//die;
			$obj = json_decode($result);
			if ($obj->data->result->OUT == 'Ok'){
				echo 'S';
			}
			else
			{
				echo 'Fail, please contact your admin';
			}
		}
	}

	public function save_uper(){
		$id_req = $_POST['request_no'];
		$recalculate = $_POST['recalculate'];
		
		$wsdl = BILLING_ENGINE;
		$modul = "calculate";
		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<request_no>".$id_req."</request_no>
						<recalculate>".$recalculate."</recalculate>
					</data>
				</root>";
		//print_r('test');die;
		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			
			// echo $result;
			// die;
			$obj = json_decode($result);
			if ($obj->rc == 'S'){
				$detail = json_encode($obj->data);
				$id_user = $this->session->userdata('uname_phd');

				$wsdl = ORDER_MGT;
				$modul = "saveUper";

				$in_data = "<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<recalculate>".$recalculate."</recalculate>
								<id_user>".$id_user."</id_user>
								<detail>".$detail."</detail>
							</data>
						</root>";
				// print_r($in_data);
				// die();
				if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
				{
					print_r($result);
					die;
				}
				else
				{
					// print_r($result);
					// die;
					$obj = json_decode($result);
					echo $obj->data->retval;
				}
			}
		}
	}

	public function get_list_equipment(){

		$sub_group_phd = explode(",", $this->session->userdata('sub_group_phd'));
		foreach ($sub_group_phd as $key => $value) {
			if($value != null){
				$terminal_code = $this->container_model->getIdPort($value);
			}
		}


		$wsdl = ORDER_MGT;
		$modul = "getListEquipment";
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<terminal_code>".$terminal_code."</terminal_code>
						</data>
				</root>";


		
		
		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;
			$equipment_list = array();
			$obj = json_decode($result);
			$list = $obj->data->retval;
			// print_r($list);
			foreach ($list as $equipment){
				// print_r($equipment);
				array_push($equipment_list, array(
					'EQ_CODE'=>$equipment->EQ_CODE,
					'EQ_NAME'=>$equipment->EQ_NAME,
					'ID_PORT'=>$equipment->ID_PORT
				));
			}
			echo json_encode($equipment_list);
		}
	}

	public function save_realisasi(){
		// print_r($_POST);
		$id_req = $_POST['id_request'];
		$id_user = $this->session->userdata('uname_phd');
		$detail_count = $_POST['detail_count'];
		$detail = json_encode($_POST['detail']);
		$equipment_count = $_POST['equipment_count'];
		$equipment = json_encode($_POST['equipment']);

		$stack = array();
		$wsdl = ORDER_MGT;
		$modul = "saveStevedoringDetail";

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>".$id_req."</id_req>
				<id_user>".$id_user."</id_user>
				<detail_count>".$detail_count."</detail_count>
				<detail>".$detail."</detail>
				<equipment_count>".$equipment_count."</equipment_count>
				<equipment>".$equipment."</equipment>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);die;
			$obj = json_decode($result);
			echo $obj->data->retval;
		}
	}
	
	public function save_proforma(){
		$id_req = $_POST['id_req'];
		$id_user = $this->session->userdata('uname_phd');

		$stack = array();
		$wsdl = ORDER_MGT;
		$modul = "saveProforma";

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>".$id_req."</id_req>
				<id_user>".$id_user."</id_user>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);die;
			$obj = json_decode($result);
			echo $obj->data->retval;
		}
	}
	
	public function transfer_simkeu(){
		$id_req = $_POST['id_req'];
		$id_user = $this->session->userdata('uname_phd');

		$stack = array();
		$wsdl = ORDER_MGT;
		$modul = "transferSimkeu";

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>".$id_req."</id_req>
				<id_user>".$id_user."</id_user>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl($wsdl,$modul,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);die;
			$obj = json_decode($result);
			echo $obj->data->retval;
		}
	}
}
