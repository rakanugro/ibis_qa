<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Payment extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('om/nota_model');
		$this->load->model('om/booking_model');
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

		$this->breadcrumbs->push("Booking List", 'om/request');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Booking List";

		$this->common_loader($data,'pages/om/request');
	}

    public function payments(){
		//ECHO 'TEST';die;
		$this->redirect();

		//create table
		$this->table->set_heading('NO', '', 'REQUEST/PROFORMA NO', 'SERVICE', 'VESSEL - VOYAGE', 'CUSTOMER', 'PORT - TERMINAL', 'REQUEST DATE','STATUS', 'PROFORMA', 'PAYMENT');

		$customer_id=$this->session->userdata('custid_phd');

		//$result=$this->container_model->getReqNotPaidByCust($customer_id);
		
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

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getPaymentList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
					$checkbox = '<input type="checkbox" id="id_proforma" name="id_proforma[]" value="'.$obj->data->listreq[$i]->id_req.','.$obj->data->listreq[$i]->id_cust.'"/>';//procedure epayment pakai id req, menyesuaikan aja deh
					$label_span='<span class="label label-warning label-large">'.$obj->data->listreq[$i]->ket_status_req.'</span>';
					$urluper = ROOT."om/printer/uper";
					$urlproforma = ROOT."om/printer/proforma";
					$urlproforma2 = ROOT."om/printer/proforma";
					$proformalink1 = "<a class='btn btn-primary' target='_blank' href='".$urlproforma."/".$obj->data->listreq[$i]->id_proforma."/".$obj->data->listreq[$i]->port."/".$obj->data->listreq[$i]->terminal."/".md5($obj->data->listreq[$i]->id_proforma)."'>
				<i class='fa fa-file-pdf-o'></i></a>";
				    $proformalink2 = " <a class='btn btn-success' target='_blank' href='".$urlproforma2."/".$obj->data->listreq[$i]->id_proforma."/".$obj->data->listreq[$i]->port."/".$obj->data->listreq[$i]->terminal."/".md5($obj->data->listreq[$i]->id_proforma)."' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
					if($obj->data->listreq[$i]->servicetype_name=="BONGKAR MUAT CARGO")
					{
						$download_proforma = '<a class=\'btn btn-primary\' target=\'_blank\' href="'.$urluper.'/'.$obj->data->listreq[$i]->id_proforma.'" title=\'Print\'><i class="fa fa-file-pdf-o"></i></a>';
					}
					else
					{
						$download_proforma=$proformalink1.$proformalink2;
					}					
					$payment='<a class="btn btn-info" target="_blank" href="'.ROOT."om/payment/payment_confirmation/".$obj->data->listreq[$i]->id_req.'/'.$obj->data->listreq[$i]->port.'/'.$obj->data->listreq[$i]->terminal.'/'.$obj->data->listreq[$i]->id_proforma.'/'.$this->security->xss_clean($obj->data->listreq[$i]->vessel).'/'.$this->security->xss_clean($obj->data->listreq[$i]->voy_in).'/'.$this->security->xss_clean($obj->data->listreq[$i]->voy_out).'/'.$this->security->xss_clean($obj->data->listreq[$i]->kredit).'" title="Konfirmasi Pembayaran"><i class="fa fa-money"></i></a>';
					$trx = $this->security->xss_clean($obj->data->listreq[$i]->id_req)."<br/>".$obj->data->listreq[$i]->id_proforma;
					$this->table->add_row(
							$i+1,
							$checkbox,
							$trx,
							$this->security->xss_clean($obj->data->listreq[$i]->servicetype_name),
							$this->security->xss_clean($obj->data->listreq[$i]->vessel)." ".$this->security->xss_clean($obj->data->listreq[$i]->voy_in)."-".$this->security->xss_clean($obj->data->listreq[$i]->voy_out),
							$this->security->xss_clean($obj->data->listreq[$i]->cust_name),
							$this->security->xss_clean($obj->data->listreq[$i]->name_port),
							$this->security->xss_clean($obj->data->listreq[$i]->req_date),
							$label_span,
							$download_proforma,
							$payment
						);
				}
			}
		}

		/*
		$i=0;
		$cekship=$this->master_model->cek_shippingline();
		foreach ($result as $row)
		{
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


				$payment='<a class="btn btn-info" target="_blank" href="'.ROOT."om/payment/payment_confirmation/".$row['REQUEST_ID'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'/'.$row['PRF_NUMBER'].'/'.$vessel_get.'/'.$voyage_in_get.'/'.$voyage_out_get.'" title="Konfirmasi Pembayaran"><i class="fa fa-money"></i></a>
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
				$checkbox,
				$this->security->xss_clean($row['REQUEST_ID']),
				$this->security->xss_clean($row['VESSEL'])." ".$this->security->xss_clean($row['VOYAGE_IN'])."-".$this->security->xss_clean($row['VOYAGE_OUT']),
				$this->security->xss_clean($row['PORT_ID'])."-".$this->security->xss_clean($row['TERMINAL_ID']),
				$this->security->xss_clean($row['REQUEST_DATE']),
				$label_span,
				$download_proforma,
				$payment
//						$download_invoice,
//						$download_card
			);
		}
		*/

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Payment', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Payment Service';

		$this->common_loader($data,'pages/om/payment');
	}

	function payment_confirmation($no_request,$id_port,$id_terminal,$id_proforma,$vessel,$voyage_in,$voyage_out,$totalbayar){
		$this->redirect();
		
		if($totalbayar > 0)
		{
			$ttl = $totalbayar;
		}
		else
		{
			$ttl = 110000;
		}
 
		$data['no_request']=$no_request;
		$data['id_proforma']=$id_proforma;
		$data['kredit']=number_format($ttl);
		$data['bank'] = $this->nota_model->getMstBank();
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Payment', 'container/payment');
		$this->breadcrumbs->push('Payment Confirmation', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= 'Payment Confirmation';

		$this->common_loader($data,'pages/om/payment_confirmation');
	}

	function save_payment_confirmation(){
		$no_request=$_POST["no_request"];
		$no_proforma=$_POST["no_proforma"];
		$method=$_POST["method"];
		$via=$_POST["via"];
		$amount=$_POST["amount"];

		//print_r($no_proforma);die;
		/*
		$params = array(
			'REQUEST_NUMBER'				=>	$no_request,
			'PROFORMA_NUMBER'				=>	$no_proforma,
			'USER_ID'						=>	$this->session->userdata('uname_phd'),
			'PAYMENT_METHOD'				=>	$method,
			'PAYMENT_VIA'					=>	$via,
			'PAYMENT_AMOUNT'				=>	$amount,
			'PAYMENT_CONFIRMATION_STATUS'	=>	'N'
		);
		*/
		// print_r($this->session->userdata);
		$userid = $this->session->userdata('uname_phd');
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<no_request>$no_request</no_request>
							<no_proforma>$no_proforma</no_proforma>
							<user_id>$userid</user_id>
							<payment_method>$method</payment_method>
							<payment_via>$via</payment_via>
							<payment_amount>$amount</payment_amount>
						</data>
					</root>";
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"savePayment",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			echo $obj->data->info;
	    }

	}

}
