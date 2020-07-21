<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Billingmanagement extends CI_Controller {

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

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		/*if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');*/
			if (! $this->session->userdata('is_login') ){
				if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
				{
					redirect(ROOT.'mainpage', 'refresh');
				}		
			}
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

		$this->breadcrumbs->push("Billing Management", 'om/billingmanagement');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Billing Management";

		$this->common_loader($data,'pages/om/billing_management');
	}
	
    public function billing_management_check($search="")
	{
		//$this->redirect();

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
        		
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : "";
		
		//create table
		//$result=$this->billing_model->getNumberReqAndSourceByCust($customer_id);
		$this->table->set_heading(
								"NO",
								"REQUEST NO",
								"SERVICE",
								"VESSEL - VOYAGE",
								"CUSTOMER",
								"PORT - TERMINAL",
								"DATE REQUEST",
								"STATUS",
								"VIEW",
								"PROFORMA",
								"NOTA",
								"CARD"
							);

		//echo var_dump($result);die;
		
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
						</data>
					</root>";
		//echo var_dump($in_data);die;
		
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getBillingList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
					$label_status='<span class="label label-warning label-large">'.$obj->data->listreq[$i]->ket_status_req.'</span>';
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					
					if(($obj->data->listreq[$i]->status_req=='S')||($obj->data->listreq[$i]->status_req=='U')||($obj->data->listreq[$i]->status_req=='T'))
					{
						$urlproforma = ROOT."om/printer/proforma";
						$urlproforma2 = ROOT."om/printer/proforma";
						$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."'><i class='fa fa-file-pdf-o'></i></a>";
						$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
						$proformalink=$proformalink1.$proformalink2;
						$notalink="-";
						$cardlink="-";
					}
					else if(($obj->data->listreq[$i]->status_req=='P')||($obj->data->listreq[$i]->status_req=='U')||($obj->data->listreq[$i]->status_req=='T'))
					{
						$urlproforma = ROOT."om/printer/proforma";
						$urlproforma2 = ROOT."om/printer/proforma";
						$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."'><i class='fa fa-file-pdf-o'></i></a>";
						$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."' title='proforma thermal'><i class='fa fa-files-o'></i></a>";
						$proformalink=$proformalink1.$proformalink2;
						$urlnota = ROOT."om/printer/nota";
						$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."'><i class='fa fa-file-pdf-o'></i></a>";
						$urlcard = ROOT."om/printer/kartu";
						$cardlink = "<a class='btn btn-primary' target='_blank' href='".$urlcard."/".$this->security->xss_clean($obj->data->listreq[$i]->id_req)."'><i class='fa fa-file-text-o'></i></a>";						
					}
					else
					{
						$proformalink="-";
						$notalink="-";
						$cardlink="-";
					}					
					
					$this->table->add_row(
						$i+1,
						$this->security->xss_clean($obj->data->listreq[$i]->id_req),
						$this->security->xss_clean($obj->data->listreq[$i]->servicetype_name),
						$this->security->xss_clean($obj->data->listreq[$i]->vessel ."<br/>".$obj->data->listreq[$i]->voy_in." - ".$obj->data->listreq[$i]->voy_out),
						$this->security->xss_clean($obj->data->listreq[$i]->cust_name),	
						$this->security->xss_clean($obj->data->listreq[$i]->name_port),
						$this->security->xss_clean($obj->data->listreq[$i]->req_date),						
						$label_status,
						$view_link,
						$proformalink,
						$notalink,
						$cardlink
					);
				}
			}
		}
		
		/*
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
				$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a>";
				$cardlink = "<a class='btn btn-primary' target='_blank' href='".$urlcard."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
				if($row['MODUL_DESC'] == 'DELIVERY'){
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
		*/

		//$data['search'] = $search;

		//$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		//$this->breadcrumbs->push("Billing Management", '/');
		//$this->breadcrumbs->unshift('Home', '/');
		//$data['breadcrumbs'] = $this->breadcrumbs->show();

		//$data['title']= "Billing Management"; //get_content($this->user_model,"billing_management","billing_management");

		$this->load->view('pages/om/search_billing_management',$data);

    }

	public function billing_management($search="")
	{
		//$this->redirect();

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
        $customer_id=$this->session->userdata('customerid_phd');
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : "";
		
		//create table
		//$result=$this->billing_model->getNumberReqAndSourceByCust($customer_id);
		$this->table->set_heading(
								"NO",
								"REQUEST NO",
								"SERVICE",
								"VESSEL - VOYAGE",
								"CUSTOMER",
								"PORT - TERMINAL",
								"DATE REQUEST",
								"STATUS",
								"VIEW",
								"PROFORMA",
								"NOTA",
								"CARD"
							);

		//echo var_dump($result);die;
		
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
							<id_customer>$customer_id</id_customer>
						</data>
					</root>";
		//echo var_dump($in_data);die;
		
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getBillingList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
					$label_status='<span class="label label-warning label-large">'.$obj->data->listreq[$i]->ket_status_req.'</span>';
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					
					if(($obj->data->listreq[$i]->status_req=='S')||($obj->data->listreq[$i]->status_req=='U')||($obj->data->listreq[$i]->status_req=='T'))
					{
						$urlproforma = ROOT."om/printer/proforma";
						$urlproforma2 = ROOT."om/printer/proforma";
						$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."'><i class='fa fa-file-pdf-o'></i></a>";
						$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
						$proformalink=$proformalink1.$proformalink2;
						$notalink="-";
						$cardlink="-";
					}
					else if(($obj->data->listreq[$i]->status_req=='P')||($obj->data->listreq[$i]->status_req=='U')||($obj->data->listreq[$i]->status_req=='T'))
					{
						$urlproforma = ROOT."om/printer/proforma";
						$urlproforma2 = ROOT."om/printer/proforma";
						$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."'><i class='fa fa-file-pdf-o'></i></a>";
						$proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."' title='proforma thermal'><i class='fa fa-files-o'></i></a>";
						$proformalink=$proformalink1.$proformalink2;
						$urlnota = ROOT."om/printer/nota";
						$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$this->security->xss_clean($obj->data->listreq[$i]->id_proforma)."'><i class='fa fa-file-pdf-o'></i></a>";
						$urlcard = ROOT."om/printer/kartu";
						$cardlink = "<a class='btn btn-primary' target='_blank' href='".$urlcard."/".$this->security->xss_clean($obj->data->listreq[$i]->id_req)."'><i class='fa fa-file-text-o'></i></a>";						
					}
					else
					{
						$proformalink="-";
						$notalink="-";
						$cardlink="-";
					}					
					
					$this->table->add_row(
						$i+1,
						$this->security->xss_clean($obj->data->listreq[$i]->id_req),
						$this->security->xss_clean($obj->data->listreq[$i]->servicetype_name),
						$this->security->xss_clean($obj->data->listreq[$i]->vessel ."<br/>".$obj->data->listreq[$i]->voy_in." - ".$obj->data->listreq[$i]->voy_out),
						$this->security->xss_clean($obj->data->listreq[$i]->cust_name),	
						$this->security->xss_clean($obj->data->listreq[$i]->name_port),
						$this->security->xss_clean($obj->data->listreq[$i]->req_date),						
						$label_status,
						$view_link,
						$proformalink,
						$notalink,
						$cardlink
					);
				}
			}
		}
		
		/*
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
				$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a>";
				$cardlink = "<a class='btn btn-primary' target='_blank' href='".$urlcard."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
				if($row['MODUL_DESC'] == 'DELIVERY'){
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
		*/

		//$data['search'] = $search;

		//$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		//$this->breadcrumbs->push("Billing Management", '/');
		//$this->breadcrumbs->unshift('Home', '/');
		//$data['breadcrumbs'] = $this->breadcrumbs->show();

		//$data['title']= "Billing Management"; //get_content($this->user_model,"billing_management","billing_management");

		$this->common_loader($data,'pages/om/billing_management');

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
			//echo $result;die;
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
					$stpr=$obj->data->listcont[$i]->start_period;
					$enpr=$obj->data->listcont[$i]->end_period;
					$expr=$obj->data->listcont[$i]->ext_period;
					array_push($stack, $temp);
				}
			}
		}


		$data['TL_FLAG']=$tl;
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
		$this->load->view('pages/om/billingmgt_viewreq',$data);
	}	
	
}
