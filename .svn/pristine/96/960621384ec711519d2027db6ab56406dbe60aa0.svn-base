<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Printer extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('pdf_helper');
		$this->load->helper('url');
		$this->load->library('ciqrcode');

		$this->load->library('OMDBConnect');
		$this->load->library('BEMaster');


		$this->load->model('om/proforma_model');
		$this->load->model('om/nota_model');
		$this->load->model('om/uper_model');
		$this->load->model('container_model');

		/*
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('om/booking_model');
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
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

	public function noval(&$param){
		$param = isset ($param) ? $param : '';
	}

	public function getCompanyName($company_code){
		echo $this->bemaster->getCompanyName($company_code); die;
	}

	public function proforma($prf_id){
		$this->redirect();

		//var_dump( $this->bemaster->getPortName('004') ); die;

		$proforma = $this->proforma_model->getProforma($prf_id);
		$header = $proforma['header'];
		$detail = $proforma['detail'];

		/*
		echo '<pre>';
		var_dump($proforma);
		echo '</pre>';
		die;
		*/

		$params = array();
		$params['TITLE'] 			= 'PROFORMA';
		$params['NOTATYPE'] 	    = 'proforma';

		$params['HOLDING'] 			= $this->bemaster->getHoldingName($header['ID_HOLDING']);
		$params['COMPANY'] 			= $this->bemaster->getCompanyName($header['ID_COMPANY']);
		$params['PORT_DESC'] 		= $this->bemaster->getPortName($header['ID_PORT']);
		$params['MGR1_NAME']		= $this->bemaster->getMgrName($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'1');
		$params['MGR1_NIPP'] 		= $this->bemaster->getMgrNipp($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'1');
		$params['MGR2_NAME']		= $this->bemaster->getMgrName($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'2');
		$params['MGR2_NIPP'] 		= $this->bemaster->getMgrNipp($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'2');
		$params['NO_NOTA'] 			= $header['ID_PROFORMA'];
		$params['DNOTA'] 			= $header['FMTDATE'];
		$params['CUST_NAME'] 		= $header['CUST_NAME'];
		$params['ADM_NOTA'] 		= '0';
		$params['TAGIHAN'] 			= '0';
		$params['PPN'] 				= $header['PPN'];
		$params['MATERAI'] 			= $header['MATERAI'];
		$params['SUBTOTAL'] 		= $header['TOTAL'];
		$params['TARIF_MINIMUM'] 	= $header['TARIF_MINIMUM'];
		$params['TOTAL'] 			= $header['KREDIT'];
		$params['VESSEL'] 			= $header['VESSEL'];
		$params['VOY_IN'] 			= $header['VOY_IN'];
		$params['VOY_OUT'] 			= $header['VOY_OUT'];
		$params['DO_NUMBER'] 		= $header['DO_NUMBER'];
		$params['DO_DATE'] 			= $header['DO_DATE'];
		$params['SERVICETYPE_NAME']	= $header['SERVICETYPE_NAME'];
		$params['TRX_DATE']	        = $header['TRX_DATE'];
		$params['BL_NUMBER']	    = $header['BL_NUMBER'];
		$params['BL_DATE']	        = $header['BL_DATE'];
		$params['TERBILANG']	        = $header['TERBILANG'];
		$params['ADMINISTRASI']     = $header['ADMINISTRASI'];

		foreach ($detail as &$d){
			//$d['']
		}
		$params['detail'] = $detail;

		$data = array();
		$data['view'] = 'proforma_template';//'proforma_template';  //----------> this is the view. CHANGE THIS ONE.
		//var_dump($params);die;
		$data['vars'] 	= $params;
		$data['content'] = $this->load->view('print/om/cetak', $data); //-------------> DON'T CHANGE THIS ONE.
	}

	public function nota($nota_id){
		$this->redirect();

		$nota = $this->nota_model->getNota($nota_id);
		
		$header = $nota['header'];
		$detail = $nota['detail'];
		
		$notaid=$header['ID_INV'];
		$id_cust=$header['ID_CUST'];
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			//return;
		}

		$stack = array();
		
		{
			$hash = md5(ROOT."invoice/val_invoice/1/del/$no_request/$port_code/$terminal_code/");
			$params['data'] = ROOT."invoice/val_invoice/1/del/$no_request/$port_code/$terminal_code/$hash";
			$params['level'] = 'H';
			$params['size'] = 10;
			$randomfilename = rand(1000, 9999);
			$params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
			$this->ciqrcode->generate($params);
		}

		$params = array();
		$params['TITLE'] 			= 'NOTA';
		$params['NOTATYPE'] 	    = 'nota';

		$params['HOLDING'] 			= $this->bemaster->getHoldingName($header['ID_HOLDING']);
		$params['COMPANY'] 			= $this->bemaster->getCompanyName($header['ID_COMPANY']);
		$params['PORT_DESC'] 		= $this->bemaster->getPortName($header['ID_PORT']);
		$params['MGR1_NAME']		= $this->bemaster->getMgrName($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'1');
		$params['MGR1_NIPP'] 		= $this->bemaster->getMgrNipp($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'1');
		$params['MGR2_NAME']		= $this->bemaster->getMgrName($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'2');
		$params['MGR2_NIPP'] 		= $this->bemaster->getMgrNipp($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],$header['ID_SERVICETYPE'],'2');
		$params['NO_NOTA'] 			= $header['ID_INV'];
		$params['TERBILANG'] 		= $header['TERBILANG'];
		$params['DNOTA'] 			= $header['FMTDATE'];
		$params['ID_REQ'] 			= $header['ID_REQ'];
		$params['CUST_NAME'] 		= $header['CUST_NAME'];
		$params['CUST_ADDR'] 		= $header['CUST_ADDR'];
		$params['CUST_NPWP'] 		= $header['CUST_NPWP'];
		$params['ADM_NOTA'] 		= '0';
		$params['TAGIHAN'] 			= '0';
		$params['PPN'] 				= $header['PPN'];
		$params['MATERAI'] 			= $header['MATERAI'];
		$params['SUBTOTAL'] 		= $header['TOTAL'];
		$params['TOTAL'] 			= $header['KREDIT'];
		$params['VESSEL'] 			= $header['VESSEL'];
		$params['VOY_IN'] 			= $header['VOY_IN'];
		$params['VOY_OUT'] 			= $header['VOY_OUT'];
		$params['DO_NUMBER'] 		= $header['DO_NUMBER'];
		$params['DO_DATE'] 			= $header['DO_DATE'];
		$params['SERVICETYPE_NAME']	= $header['SERVICETYPE_NAME'];
		$params['TRX_DATE']	        = $header['TRX_DATE'];
		$params['BL_NUMBER']	    = $header['BL_NUMBER'];
		$params['BL_DATE']	        = $header['BL_DATE'];
		$params['ADMINISTRASI']     = $header['ADMINISTRASI'];
		$params['USER_CREATED']     = $header['USER_CREATED'];

		$params['detail'] = $detail;

		$data = array();
		$data['view'] = 'nota_template';  //----------> this is the view. CHANGE THIS ONE.
		$data['vars'] 	= $params;
		
		$data['content'] = $this->load->view('print/om/cetak', $data); //-------------> DON'T CHANGE THIS ONE.
	}

	public function uper($uper_id){
		$this->redirect();

		$uper = $this->uper_model->getUper($uper_id);

		$header = json_decode(json_encode($uper['header']),TRUE);
		$detail = json_decode(json_encode($uper['detail']),TRUE);
		//print_r($header);
		//die();
		$params = array();
		$params['TITLE'] 			= 'UPER';
		$params['NOTATYPE'] 	    = 'uper';

		$params['HOLDING'] 			= $this->bemaster->getHoldingName($header['ID_HOLDING']);
		$params['COMPANY'] 			= $this->bemaster->getCompanyName($header['ID_COMPANY']);
		$params['PORT_DESC'] 		= $this->bemaster->getPortName($header['ID_PORT']);
		$params['NO_NOTA'] 			= $header['ID_UPER'];
		$params['DNOTA'] 				= $header['FMTDATE'];
		$params['CUST_NAME'] 		= $header['CUST_NAME'];
		$params['CUST_ADDR'] 		= $header['CUST_ADDR'];
		$params['CUST_NPWP'] 		= $header['CUST_NPWP'];
		$params['VESSEL'] 			= $header['VESSEL'];
		$params['VOYAGE'] 			= $header['VOY_IN'].'-'.$header['VOY_OUT'];
		$params['ADM_NOTA'] 		= $header['ADMINISTRASI'];
		$params['PPN'] 					= $header['PPN'];
		$params['ID_REQ'] 					= $header['ID_REQ'];
		$params['MATERAI'] 			= 0;
		$params['SUBTOTAL'] 		= $header['TOTAL'];
		$params['TOTAL'] 				= $header['KREDIT'];
		$params['TERBILANG'] 				= $header['TERBILANG'];

		$params['officer1'] = $this->uper_model->getOfficer($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],'00',1);
		$params['officer2'] = $this->uper_model->getOfficer($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],'00',2);
		$params['detail'] = $detail;

		$data = array();
		$data['view'] = 'nota_simbarang_template';  //----------> this is the view. CHANGE THIS ONE.
		$data['vars'] 	= $params;
		$data['content'] = $this->load->view('print/om/cetak', $data); //-------------> DON'T CHANGE THIS ONE.
	}

	public function realisasi($req_id){
		$this->redirect();

		$uper = $this->uper_model->getRealisasi($req_id);

		$header = json_decode(json_encode($uper['header']),TRUE);
		$detailImp = json_decode(json_encode($uper['detailImp']),TRUE);
		$detailExp = json_decode(json_encode($uper['detailExp']),TRUE);
		$detailEq = json_decode(json_encode($uper['detailEq']),TRUE);

		$params = array();
		$params['TITLE'] 			= 'REALISASI BONGKAR MUAT';
		$params['NOTATYPE'] 	    = 'realisasi';

		$params['HOLDING'] 			= $this->bemaster->getHoldingName($header['ID_HOLDING']);
		$params['COMPANY'] 			= $this->bemaster->getCompanyName($header['ID_COMPANY']);
		$params['PORT_DESC'] 		= $this->bemaster->getPortName($header['ID_PORT']);
		$params['NO_NOTA'] 			= $header['ID_UPER'];
		$params['DNOTA'] 		    = $header['REQ_DATE'];
		$params['CUST_NAME'] 		= $header['CUST_NAME'];
		$params['CUST_ADDR'] 		= $header['CUST_ADDR'];
		$params['CUST_NPWP'] 		= $header['CUST_NPWP'];
		$params['VESSEL'] 			= $header['VESSEL'];
		$params['ETA'] 				= $header['VVD_ETA'];
		$params['ETD'] 				= $header['VVD_ETD'];
		$params['VOYAGE'] 			= $header['VOY_IN'].'-'.$header['VOY_OUT'];
		$params['ADM_NOTA'] 		= $header['ADMINISTRASI'];
		$params['PPN'] 				= $header['PPN'];
		$params['ID_REQ'] 			= $header['ID_REQ'];
		$params['MATERAI'] 			= 0;
		$params['SUBTOTAL'] 		= $header['TOTAL'];
		$params['TOTAL'] 			= $header['KREDIT'];

		$params['officer1'] = $this->uper_model->getOfficer($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],'00',1);
		$params['officer2'] = $this->uper_model->getOfficer($header['ID_HOLDING'],$header['ID_COMPANY'],$header['ID_PORT'],'00',2);
		$params['detailImp'] = $detailImp;
		$params['detailExp'] = $detailExp;
		$params['detailEq'] = $detailEq;

		$data = array();
		$data['view'] = 'realisasi_bm';  //----------> this is the view. CHANGE THIS ONE.
		$data['vars'] 	= $params;
		$data['content'] = $this->load->view('print/om/cetak', $data); //-------------> DON'T CHANGE THIS ONE.
	}

	public function kartu($no_request){

		$this->redirect();

		//generate hash
		//$customer_id=$this->container_model->getCustomerId($no_request);
		//$group_id = $this->session->userdata('group_phd');
		$port_code = 'IDBTN';
		$terminal_code = 'BTN';

		//$hash_check = md5($no_request.$customer_id);

		/*
		if($hash!=$hash_check)
		{
			return;
		}
		*/

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if($uname_phd == '')
			redirect(ROOT.'mainpage', 'refresh');

		//$card_password = $billerId=$this->user_model->get_pdf_password($this->session->userdata('uname_phd'));

        //$billerId=$this->container_model->getNumberRequestBiller($no_request);
		// $billerId=$this->proforma_model->getNumberRequestBiller($no_request);
        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$no_request</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";
		// print_r($in_data);die;

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getPDFCardCargo",array("in_data" => "$in_data"),$result))
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
			//$vld = $this->container_model->getValidCardPrint($cetakan_ke,'DEL');
			$vld = "Y";
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

			$pdf->SetTitle("KARTU");

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

			if($port_code=='IDJKT')
			{
				$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
			}
			else if($port_code=='IDPNK')
			{
				$corporate_name = "PT. IPC TERMINAL PETIKEMAS";
			}
			else
			{
				$corporate_name = "PT. PELABUHAN INDONESIA II";
			}

			// if($terminal_code=='T3I')
			// {
			// 	$terminal_name='TERMINAL 3 OCEAN GOING';
			// }
			// else if($terminal_code=='T3D')
			// {
			// 	$terminal_name='TERMINAL 3 DOMESTIK';
			// }
			// else if($terminal_code=='T2D')
			// {
			// 	$terminal_name='TERMINAL 2 DOMESTIK';
			// }
			// else if($terminal_code=='T1D')
			// {
			// 	$terminal_name='TERMINAL 1 DOMESTIK';
			// }
			// else if($terminal_code=='T009D')
			// {
			// 	$terminal_name='TERMINAL 1 009 (DOMESTIK)';
			// }
			// else if($terminal_code=='BTN')
			// {
			// 	$terminal_name='TERMINAL BANTEN';
			// }

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
				$servicetype_name     =$obj->data->detail_card[$i]->servicetype_name;
				$pkg_name             =$obj->data->detail_card[$i]->pkg_name;
				$cargo_name           =$obj->data->detail_card[$i]->cargo_name;
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
				$hs_code              =$obj->data->detail_card[$i]->hscode;
				$ipol                 =$obj->data->detail_card[$i]->ipol;
				$tgl_request          =$obj->data->detail_card[$i]->tgl_request;
				$id_cargo             =$obj->data->detail_card[$i]->id_cargo;
				$no_bl                =$obj->data->detail_card[$i]->no_bl;
				$booking_numb         =$obj->data->detail_card[$i]->booking_numb;
				$status_tl            =$obj->data->detail_card[$i]->status_tl;
				$no_do         		  =$obj->data->detail_card[$i]->no_do;
				$tgl_bl               =$obj->data->detail_card[$i]->tgl_bl;
				$seal_id              =$obj->data->detail_card[$i]->seal_id;
				$qty                  =$obj->data->detail_card[$i]->qty;
				$plat_no              =$obj->data->detail_card[$i]->plat_no;
				$tid                  =$obj->data->detail_card[$i]->tid;
				$id_port                  =$obj->data->detail_card[$i]->id_port;
				$terminal_name 		  =$obj->data->detail_card[$i]->terminal_name;

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
				$tbl0= <<<EOD
				<table width="95%">
					<tr>
						<td COLSPAN="6" align="right"><b><font size="18">Gate Pass $servicetype_name</font></b></td>
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
							<b><font size="12">BL Number</font></b>
						</td>
						<td align="center">
							<b><font size="12">Truck ID</font></b>
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
							<b><font size="10">Cargo Name</font></b>
						</td>
						<td align="left">
							<b><font size="10"></font></b>
						</td>
						<td align="left">
							<b><font size="10">Seal Number</font></b>
						</td>
					</tr>
					<tr>
						<td align="left" colspan="2">
							<b><font size="12">$cargo_name</font></b>
						</td>
						<td align="left">
							<b><font size="12">$seal_id</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">HS Code</font></b>
						</td>
						<td align="left">
							<b><font size="10">Qty/Unit</font></b>
						</td>
						<td align="left">
							<b><font size="10">Package</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$hs_code</font></b>
						</td>
						<td align="left">
							<b><font size="12">$qty</font></b>
						</td>
						<td align="left">
							<b><font size="12">$pkg_name</font></b>
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
							<b><font size="10">$kode_pbm</font></b>
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
							<b><font size="10">Tgl BL</font></b>
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
							<b><font size="12">$tgl_bl</font></b>
						</td>
						<td align="left">
							<b><font size="12">$no_request</font></b>
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
							<b><font size="10">Plat No Truck</font></b>
						</td>
						<td align="left">
							<b><font size="10">Truck ID</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$paid_thru</font></b>
						</td>
						<td align="left">
							<b><font size="12">$plat_no</font></b>
						</td>
						<td align="left">
							<b><font size="12">$tid</font></b>
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
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/><font size="8">Keterangan :</font>
				<br/><font size="8">1. Kartu ini harap dibawa saat melakukan gate in</font>
				<br/><font size="8">2. Harap perhatikan Clossing Time dan Paid Thru</font>
				<br/><font size="8">3. Periksa kembali cargo yang tertera pada kartu</font>
				<br/><font size="8">4. Bila kartu ini hilang harap segera melapor ke IPC</font>
				<br/><font size="8">5. Bila menemukan kartu ini harap menyerahkan pada IPC</font>
				<br/>
				<br/>
				<br/>
				<p align="center"><b><font size="10">Please fold here - Do not tear (Silahkan lipat di sini - Jangan disobek)</font></b></p>
				<br/>
				<p align="center"><b><font size="10">Gate Copy</font></b></p>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="center">
							<b><font size="12">BL Number</font></b>
						</td>
						<td align="center">
							<b><font size="12">Truck ID</font></b>
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
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="left">
							<b><font size="10">Cargo Name</font></b>
						</td>
						<td align="left">
							<b><font size="10"></font></b>
						</td>
						<td align="left">
							<b><font size="10">Seal Number</font></b>
						</td>
					</tr>
					<tr>
						<td align="left" colspan="2">
							<b><font size="12">$cargo_name</font></b>
						</td>
						<td align="left">
							<b><font size="12">$seal_id</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">HS Code</font></b>
						</td>
						<td align="left">
							<b><font size="10">Qty/Unit</font></b>
						</td>
						<td align="left">
							<b><font size="10">Package</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$hs_code</font></b>
						</td>
						<td align="left">
							<b><font size="12">$qty</font></b>
						</td>
						<td align="left">
							<b><font size="12">$pkg_name</font></b>
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
							<b><font size="12">$kode_pbm</font></b>
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
							<b><font size="10">Tgl BL</font></b>
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
							<b><font size="12">$tgl_bl</font></b>
						</td>
						<td align="left">
							<b><font size="12">$no_request</font></b>
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
							<b><font size="10">Plat No Truck</font></b>
						</td>
						<td align="left">
							<b><font size="10">Truck ID</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$paid_thru</font></b>
						</td>
						<td align="left">
							<b><font size="12">$plat_no</font></b>
						</td>
						<td align="left">
							<b><font size="12">$tid</font></b>
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

			//Menampilkan Barcode dari nomor nota
			//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			//Logo IPC
			//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 9, 18, 12, '', '', '', true, 72);
			//$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 15, 115, 180, 50, '', '', '', true, 72);
			//$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($tbl0, true, false, false, false, '');
			$pdf->write1DBarcode("$no_bl", 'C128', 18, 30, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("$tid", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("$no_bl", 'C128', 18, 191, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("$tid", 'C128', 130, 191, '', 18, 0.4, $style, 'N');

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
				echo "NO,Cargo Belum Diasosiasi Dengan Truk External";
			}
		} else
			{
				echo "CETAKAN KE-".$cetakan_ke."\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
			}

		}
	}

}
