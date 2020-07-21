<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Invoice extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('pdf_helper');
		$this->load->helper('url');

		$this->load->library('OMDBConnect');
		$this->load->library('BEMaster');
		$this->load->library("table");
		$this->load->library('breadcrumbs');

		$this->load->model('user_model');
		$this->load->model('om/proforma_model');
		$this->load->model('om/nota_model');
		$this->load->model('om/uper_model');
		$this->load->model('om/calculator_model');
		/*
		$this->load->library('commonlib');
		$this->load->helper('MY_language_helper');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('om/booking_model');
		$this->load->library('ciqrcode');

		require_once(APPPATH.'libraries/htmLawed.php');
		*/
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)))
		//	redirect(ROOT.'mainpage', 'refresh');
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

	public function index(){
		echo "idx"; die;
	}


	public function createProforma($req_no){
		/*debugging*/
		//	$raw = $this->calculator_model->calculate($req_no);
		//	echo'<pre>';print_r(json_decode($raw));echo'</pre>';die;
		/*debugging*/

		$svc_ty=$_POST['id_svc'];
		$tl_flag=$_POST['tl_flag'];

		if($svc_ty=='00'){
			echo 'S^';
		}
		else {
			
			  $raw = $this->calculator_model->calculate($req_no);
				$rs = json_decode($raw);

				if ($rs->rc == "S"){
					$a = $rs->data->request_no;

					$id_proforma = (string) $rs->data->proforma_numb;

					if (!$id_proforma){
						echo 'F1'; return;
					}

					$header0 = (array) $rs->data->header_data;
					$detail0 = (array) $rs->data->detail_data;

					$header = $this->getParamHeader($header0);
					$header['ID_PROFORMA'] 	= $id_proforma;
					$header['ID_REQ'] 		= $req_no;
					$header['STATUS_PRF'] 	= 'S';


					$detail = array();
					foreach($detail0 as $d){
						$d = (array) $d;
						$tmp = $this->getParamDetail($d);
						$tmp['ID_PROFORMA'] 	= $id_proforma;
						$detail[] = $tmp;
					}
					$r = $this->proforma_model->createProforma($header, $detail);

					if ($r == 'S'){
						//NON TL
						if ($tl_flag=="N"){
							echo $r.'^'.$id_proforma;
						}
						//TL
						// PROSES LOMPAT PAYMENT
						else{
							$no_request=$req_no;
							$no_proforma=$id_proforma;
							$method='BTN BANK';
							$via='15007';
							$amount=110000;
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
							//print_r($in_data);die;
							if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"savePayment",array("in_data" => "$in_data"),$result))
							{
								echo $result;
								die;
							}
							else
							{
								// echo $result;die;
								$obj = json_decode($result);
								//echo $obj->data->info;
								echo $r.'^'.$id_proforma;
							}
						}
						// END LOMPAT PAYMENT
					}
					else{//#ERR
						echo '<pre>';print_r($r);echo '</pre>';
					}
				}
				else {
					echo 'F2^'.$raw;
				}
			}	
		}

	public function recalcProforma(){

		$raw = $this->calculator_model->calculate($req_no, 1); //recalc flag = 1
		$rs = json_decode($raw);

		if ($rs->rc == "S"){
			$a = $rs->data->request_no;

			$header0 = (array) $rs->data->header_data;
			$detail0 = (array) $rs->data->detail_data;

			$detail = array();
			foreach($detail0 as $d){
				$d = (array) $d;
				$detail[] = $this->getParamDetail($d);
			}
			$r = $this->proforma_model->editProforma($header, $detail);

			if ($r == 'S'){
				echo $id_proforma;
			}
			else{
				echo '<pre>';print_r($r);echo '</pre>';
			}
		}
		else {
			return false;
		}
	}

	public function getParamHeader($header0){
		$header = array();
		$header['ID_PROFORMA'] 	= $header0['ID_PROFORMA'];
		$header['ID_REQ'] 		= $header0['ID_REQ'];
		$header['PRF_EDIT_DATE']= $header0['PRF_EDIT_DATE'];
		$header['STATUS_PRF'] 	= $header0['STATUS_PRF'];
		$header['ID_USER'] 		= "";//$header0[''];
		$header['ID_HOLDING'] 	= "";//$header0[''];
		$header['ID_PORT'] 		= "";//$header0[''];
		$header['ID_COMPANY'] 	= "";//$header0[''];
		$header['ID_SERVICETYPE'] = "";//$header0[''];
		$header['CURRENCY'] 	= $header0['CURRENCY'];
		$header['ID_UPER'] 		= "";//$header0[''];
		$header['ID_CUST'] 		= "";//$header0[''];
		$header['CUST_NAME'] 	= "";//$header0[''];
		$header['ADMINISTRASI'] = "";//$header0[''];
		$header['TOTAL'] 		= $header0['TOTAL'];
		$header['TARIF_MINIMUM']= $header0['TARIF_MINIMUM'];
		$header['PPN'] 			= $header0['PPN'];
		$header['MATERAI'] 		= $header0['MATERAI'];
		$header['KREDIT'] 		= $header0['KREDIT'];

		return $header;
	}

	public function getParamDetail($d){
		$tmp = array();
		$tmp['ID_PROFORMA'] = $d['ID_PROFORMA'];
		$tmp['JENIS_BIAYA'] = $d['SUBLAYANAN'];
		$tmp['NAMA_BIAYA'] 	= $d['NM_SUBLAYANAN'];
		$tmp['ID_CARGO'] 	= $d['CARGOTYPE'];
		$tmp['CARGO_NAME'] 	= $d['CARGONAME'];
		$tmp['ID_PKG'] 		= "";//$d[''];
		$tmp['PKG_NAME'] 	= "";//$d[''];
		$tmp['QTY'] 		= $d['QTY'];
		$tmp['UNIT'] 		= $d['UNITTYPE'];
		$tmp['HZ'] 			= "";//$d[''];
		$tmp['DS'] 			= "";//$d[''];
		$tmp['TARIFF'] 		= $d['TARIF'];
		$tmp['TOTAL_TARIFF'] = $d['TOTAL'];
		$tmp['REQ_DTL_NO'] 	= $d['REQ_DTL_NO'];
		$tmp['TOTHR'] 		= $d['STACKDAYS'];
		$tmp['STACKIN_DATE'] 	= $d['STACKIN_DATE'];
		$tmp['STACKOUT_DATE'] 	= $d['STACKOUT_DATE'];

		return $tmp;
	}


	public function proforma(){
		$this->redirect();

		$data = array();
		$data['invoicetype'] = 'proforma';

		$this->breadcrumbs->push('Proforma ', '#');
		$this->breadcrumbs->unshift('Invoice ', '#');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Proforma';

		$rows = $this->proforma_model->getProformaList();

		//var_dump($rows);die;

		$this->table->set_heading('No',
									"Proforma Number",
									"Request Number",
									"Proforma Date",
									"Vessel - Voyage",
									"POL / Terminal",
									"Tipe BM",
									"Quantity",
									"Status",
									"Action");

		$i = 1;
		foreach($rows as $r){

			$button = "<a class='btn btn-primary' href='".ROOT."om/printer/proforma/".$r['ID_PROFORMA']."'><i class='fa fa-print'></i></a>";
			//$button = "";
			$this->table->add_row(	$i++,
									$r['ID_PROFORMA'],
									$r['ID_REQCARGO'],
									$r['FMTDATE'],
									'vesvoy',
									'terminal',
									$r['ID_SERVICETYPE'],
									'qty',
									$r['STATUS_PRF'],
									$button);
		}

		$this->common_loader($data, 'pages/om/invoice_grid');
	}

	public function search_proforma_table(){
		$table = $this->table;

	}

	public function nota(){
		$this->redirect();

		$data = array();
		$data['invoicetype'] = 'nota';

		$this->breadcrumbs->push('Nota ', '#');
		$this->breadcrumbs->unshift('Invoice ', '#');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Nota';

		$rows = $this->nota_model->getNotaList();

		//var_dump($rows);die;

		$this->table->set_heading('No',
									"Nota Number",
									"Request Number",
									"Nota Date",
									"Vessel - Voyage",
									"POL / Terminal",
									"Tipe BM",
									"Quantity",
									"Status",
									"Action");

		$i = 1;
		foreach($rows as $r){

			$button = "<a class='btn btn-primary' href='".ROOT."om/printer/nota/".$r['ID_NOTA']."'><i class='fa fa-print'></i></a>";
			//$button = "";
			$this->table->add_row(	$i++,
									$r['ID_NOTA'],
									$r['ID_REQCARGO'],
									$r['FMTDATE'],
									'vesvoy',
									'terminal',
									$r['ID_SERVICETYPE'],
									'qty',
									$r['STATUS_NOTA'],
									$button);
		}

		$this->common_loader($data, 'pages/om/invoice_grid');
	}

	public function uper(){
		$this->redirect();

		$data = array();
		$data['invoicetype'] = 'uper';

		$this->breadcrumbs->push('Uper ', '#');
		$this->breadcrumbs->unshift('Invoice ', '#');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Uper';

		$rows = $this->uper_model->getUperList();

		//var_dump($rows);die;

		$this->table->set_heading('No',
									"Uper Number",
									"Request Number",
									"Uper Date",
									"Vessel - Voyage",
									"POL / Terminal",
									"Tipe BM",
									"Quantity",
									"Status",
									"Action");

		$i = 1;
		foreach($rows as $r){

			$button = "<a class='btn btn-primary' href='".ROOT."om/printer/uper/".$r['ID_UPER']."'><i class='fa fa-print'></i></a>";
			//$button = "";
			$this->table->add_row(	$i++,
									$r['ID_UPER'],
									$r['ID_REQCARGO'],
									$r['FMTDATE'],
									$r['VESSEL'].' ('.$r['VOY_IN'].'/'.$r['VOY_OUT'].')',
									'terminal',
									$r['ID_SERVICETYPE'],
									'qty',
									$r['STATUS_UPER'],
									$button);
		}

		$this->common_loader($data, 'pages/om/invoice_grid');
	}

	public function testBPRP(){
		//echo "asdfg"; die;
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<request_no>2010117000002</request_no>
						</data>
					</root>";

		if(!$this->nusoap_lib->call_wsdl(BILLING_ENGINE,"getStackingData",array("in_data" => "$in_data"),$result)){
			echo $result; die;
		}
		else{
			//call success
			//echo $result; die;

			echo '<pre>';
			print_r(json_decode($result));
			echo '</pre>';
		}
	}

}
