<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Pkk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		$this->load->library('session');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		$this->load->model('auth_model','auth_model');
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

	public function index() {
		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		//create table
		$this->table->set_heading('PKK NO','VESSEL CODE','VESSEL NAME','AGENT NAME','ARRIVAL','DEPARTURE','PPKB NO','BILLING NO','PRINT PKK');

		// cek customer id
		if($this->session->userdata('customerid_phd')=="")
			$agent_id="";
		else {
			//ambil kd_agen
			$no_account=$this->session->userdata('customerid_phd');

			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_account>$no_account</no_account>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getKdAgen",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//call success
				//echo $result;die;
				$obj = json_decode($result);
				//echo "<br>";
				//echo $obj->sc_type;echo "<br>";
				//echo $obj->sc_code;echo "<br>";

				if($obj->data->agen)
					$agent_id = $obj->data->agen->kd_agen;
				else
					$agent_id = "";
			}
		}

		//no error
		//start_time = tanggal entry data pkk, format dd-mm-yyyy hh24:mi:ss

		//ambil 6 bulan terakhir saja
		$fromDate = date("d-m-Y", strtotime("-4 months"));

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<agent_id>$agent_id</agent_id>
				<start_time>$fromDate 00:00:00</start_time>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(VESSEL,"getNewPKK",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->pkk)
			{
				for($i=0;$i<count($obj->data->pkk);$i++)
				{
					$print = '<a class="btn btn-primary" href="'.ROOT.'pkk/download_pkk/'.$obj->data->pkk[$i]->no_pkk.'" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
					$this->table->add_row(
						$obj->data->pkk[$i]->no_pkk,
						$obj->data->pkk[$i]->kd_kapal,
						$obj->data->pkk[$i]->nm_kapal,
						$obj->data->pkk[$i]->agent,
						$obj->data->pkk[$i]->tgl_in,
						$obj->data->pkk[$i]->tgl_out,
						// $obj->data->pkk[$i]->payment_type,
						$obj->data->pkk[$i]->kd_ppkb,
						$obj->data->pkk[$i]->bentuk_3a,
						$print
					);
					//echo $obj->data->pkk[$i]->no_pkk;echo "<br>";
					//echo $obj->data->pkk[$i]->atd;echo "<br>";
					//echo $obj->data->pkk[$i]->atb;echo "<br>";
					//echo $obj->data->pkk[$i]->ata;echo "<br>";
					//echo $obj->data->pkk[$i]->voyage_in;echo "<br>";
					//echo $obj->data->pkk[$i]->voyage_out;echo "<br>";
					//echo $obj->data->pkk[$i]->agent;echo "<br>";
					//echo $obj->data->pkk[$i]->first_port;echo "<br>";
					//echo $obj->data->pkk[$i]->previous_port;echo "<br>";
					//echo $obj->data->pkk[$i]->next_port;echo "<br>";
					//echo $obj->data->pkk[$i]->next_port;echo "<br>";
					//echo $obj->data->pkk[$i]->last_port;echo "<br>";
					//echo $obj->data->pkk[$i]->berth_location;echo "<br>";
					//echo $obj->data->pkk[$i]->rkop_status;echo "<br>";
					//echo $obj->data->pkk[$i]->no_dpjk;echo "<br>";
					//echo $obj->data->pkk[$i]->payment_type;echo "<br>";
					//echo $obj->data->pkk[$i]->payment_status;echo "<br>";
				}
			}
		}

		//$this->table->clear();

		//create table
		//$this->table->set_heading('PPKB', 'Activity', 'Date/Time');
		//$this->table_ppkb = $this->table;

		//add header info
		$data['xheadtable']="PKK List";
		$data['xclickdetail']="Click to see the detail";
		$data['xprogress']="Progress";
		$data['xprogress1']="Booking";
		$data['xprogress2']="Order Fullfill";
		$data['xprogress3']="Billing";
		$data['xprogress4']="Payment";
		$data['xmainhead1']="Vessel Information";
		$data['xnm_kapal']="Vessel Name";
		$data['xbendera']="Flag";
		$data['xdraft']="Front / Back Draft";
		$data['xkemasan']="Container Type";
		$data['xtipe_voyage']="Voyage Type";
		$data['xkunjungan']="Visit Purpose";
		$data['xmainhead2']="Port Information";
		$data['xpel_asal']="Start";
		$data['xpel_sebelum']="Previous";
		$data['xpel_berikut']="Next";
		$data['xpel_tujuan']="End";
		$data['xtgl_tiba']="Arrival Time";
		$data['xtgl_berangkat']="Departure Time";
		$data['xmainhead3']="PPKB Information";
		$data['xservice_code']="SERVICE CODE";
		$data['xpelayanan']="SERVICES";
		$data['xtgl_entry']="ENTRY DATE";
		$data['xtgl_penetapan']="APPROVAL DATE";
		$data['xstatus_ppkb']="PPKB STATUS";
		$data['xcetak_ppkb']="PRINT";
		$data['xmainhead4']="RPK Information";
		$data['xno_rpk']="RPK No";
		$data['xren_tambat']="Berthing Plan";
		$data['xstatus_rpk']="RPK Status";

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Vessel", '/');
		$this->breadcrumbs->unshift("Track & Trace", '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Vessel Tracking and Tracing";

		$this->common_loader($data,'pages/vessel/pkk');
	}

	public function billing(){

		//standard template
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		//create table
		$this->table->set_heading("PKK NO","VESSEL CODE","VESSEL NAME","AGENT NAME","ARRIVAL","DEPARTURE","PPKB NO","BILLING NO");

		// cek customer id
		if($this->session->userdata('customerid_phd')=="")
			$agent_id="";
		else {
			//ambil kd_agen
			$no_account=$this->session->userdata('customerid_phd');
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_account>$no_account</no_account>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getKdAgen",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//call success
				//echo result;die;
				$obj = json_decode($result);

				if($obj->data->agen)
					$agent_id = $obj->data->agen->kd_agen;
				else
					$agent_id = "";
			}
		}

		//no error
		//start_time = tanggal entry data pkk, format dd-mm-yyyy hh24:mi:ss

		//ambil 6 bulan terakhir saja
		$fromDate = date("d-m-Y", strtotime("-6 months"));

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<agent_id>$agent_id</agent_id>
				<start_time>$fromDate 00:00:00</start_time>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(VESSEL,"getNewPKK",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->pkk)
			{
				for($i=0;$i<count($obj->data->pkk);$i++)
				{
					$this->table->add_row(
											$obj->data->pkk[$i]->no_pkk,
											$obj->data->pkk[$i]->kd_kapal,
											$obj->data->pkk[$i]->nm_kapal,
											$obj->data->pkk[$i]->agent,
											$obj->data->pkk[$i]->tgl_in,
											$obj->data->pkk[$i]->tgl_out,
											// $obj->data->pkk[$i]->payment_type,
											$obj->data->pkk[$i]->kd_ppkb,
											$obj->data->pkk[$i]->bentuk_3a
											);
				}
			}
		}

		//add header info
		$data['xheadtable']="PKK List";
		$data['xclickdetail']="Click to see the detail";
		$data['xprogress']="Progress";
		$data['xprogress1']="Booking";
		$data['xprogress2']="Order Fullfill";
		$data['xprogress3']="Billing";
		$data['xprogress4']="Payment";
		$data['xmainhead1']="Billing Profile";
		$data['xno_pranota']="Pranota No";
		$data['xno_nota']="Invoice No";
		$data['xbill_address']="Billing Address";
		$data['xnotification']="Notification via";
		$data['xpay_method']="Payment Method";
		$data['xamount_nota']="Amount";
		$data['xuper']="Deposit";
		$data['xsisa_uper']="Rest of Deposit";
		$data['xpiutang']="Credit";
		$data['xtotal_hold']="Hold Total";

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Vessel", '/');
		$this->breadcrumbs->unshift("Billing Management", '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Vessel Billing Info";

		$this->common_loader($data,'pages/vessel/billing');
	}

	public function booking(){
		$this->index();
		// redirect('https://www.inaportnet.com/', 'refresh');
		$this->load->view('pages/vessel/booking');
	}

	function download_pkk($no_pkk) {
		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if($uname_phd == '') {
			redirect(ROOT.'mainpage', 'refresh');
		} else {
			$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_pkk>$no_pkk</no_pkk>
							</data>
						</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getPDFPKK",array("in_data" => "$in_data"),$result))
			{
				//echo $result;
				log_message('debug', $result);
				die;
			}
			else
			{
				log_message('debug', $result);
				$obj = json_decode($result);
				if($obj->data->html_tcpdf)
				{
					$this->load->helper('pdf_helper');

					tcpdf();
					// create new PDF document
					//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

					// set header and footer fonts
					// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					$pdf->SetMargins(1, 4, 0);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					// $pdf->setPrintHeader(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, 10);

					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);

	// ---------------------------------------------------------

					$tbl=base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					$pdf->writeHTML($tbl, true, false, false, false, '');

					//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			}
		}
	}

	function download_ppkb($no_ppkb, $ppkb_ke) {
		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if($uname_phd == '') {
			redirect(ROOT.'mainpage', 'refresh');
		} else {
			$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_ppkb>$no_ppkb</no_ppkb>
								<ppkb_ke>$ppkb_ke</ppkb_ke>
							</data>
						</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getPDFPPKB",array("in_data" => "$in_data"),$result))
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
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

					// set header and footer fonts
					// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					$pdf->SetMargins(1, 4, 0);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					// $pdf->setPrintHeader(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, 10);

					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);


	// ---------------------------------------------------------

					$tbl=base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					$pdf->writeHTML($tbl, true, false, false, false, '');

					//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			}
		}
	}

	function download_dtjk($no_pkk){
		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if($uname_phd == '') {
			redirect(ROOT.'mainpage', 'refresh');
		} else {
			$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_pkk>$no_pkk</no_pkk>
							</data>
						</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getPDFDTJK",array("in_data" => "$in_data"),$result))
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
					$pdf = new TCPDF('P', 'mm', 'MODLETTER', true, 'UTF-8', false);

					// set header and footer fonts
					// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					$pdf->SetMargins(1, 4, 0);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					// $pdf->setPrintHeader(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, 10);

					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);

	// ---------------------------------------------------------

					$tbl=base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					$pdf->writeHTML($tbl, true, false, false, false, '');

					//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			}
		}
	}

	function download_dpjk($no_pkk){
		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if($uname_phd == '') {
			redirect(ROOT.'mainpage', 'refresh');
		} else {
			$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_pkk>$no_pkk</no_pkk>
							</data>
						</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getPDFDPJK",array("in_data" => "$in_data"),$result))
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
					$pdf = new TCPDF('P', 'mm', 'MODLETTER', true, 'UTF-8', false);

					// set header and footer fonts
					// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					$pdf->SetMargins(1, 4, 0);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					// $pdf->setPrintHeader(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, 10);

					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);

	// ---------------------------------------------------------

					$tbl=base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					$pdf->writeHTML($tbl, true, false, false, false, '');

					//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			}
		}
	}

	function download_nota($no_pkk){
		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if($uname_phd == '') {
			redirect(ROOT.'mainpage', 'refresh');
		} else {
			$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_pkk>$no_pkk</no_pkk>
							</data>
						</root>";

			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getPDFNota",array("in_data" => "$in_data"),$result))
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
						$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


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
						//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

						//set some language-dependent strings
						$pdf->setLanguageArray(null);

	// ---------------------------------------------------------

					$tbl=base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 9);
					$pdf->writeHTML($tbl, true, false, false, false, '');
					$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);

					$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

					$pdf->setPage(1);
					$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
					//echo APP_ROOT.'config/cube/img/ipc_logo.png';

					$pdf->SetFont('helvetica', 'B', 9);
					//Close and output PDF document
					$pdf->Output('nota_jasa_kepelabuhanan - '.$no_pkk.'.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			}
		}
	}

	function home_vvd(){
		
		// print_r("a");
		// die();
		$vessel = array();
		$namaterminal = array();
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$data = '';
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Vessel</th>",
			"<th width='100px'>Voyage</th>",
			"<th width='100px'>Shipping Line</th>",
			"<th width='100px'>Call Sign</th>",
			"<th width='100px'>Line</th>",
			"<th width='100px'>ETA</th>",
			"<th width='100px'>ETD</th>",
			"<th width='100px'>ATA</th>",
			"<th width='100px'>ATD</th>",
			"<th width='100px'>Open Stack</th>",
			"<th width='50px'>Clossing Time</th>",
			"<th width='50px'>Clossing Doc</th>",
			"<th width='50px'>Terminal</th>"
		);

		// define terminal active
		$terms = $this->session->userdata('sub_group_phd');
		$data_term = explode(",,",$terms);
		
		for($i=0;$i<count($data_term);$i++){			
			if(($i==0)||($i==(count($data_term)-1)))
			{
				$trm = str_replace(",","",$data_term[$i]);
			}
			else
			{
				$trm = $data_term[$i];
			}
			$dataport = $this->container_model->getDataTerminal($trm);
			$vessel_sub = $dataport["PORT"]."-".$dataport["TERMINAL"];
			$terminalnm = $dataport["TERMINAL_NAME"];
			array_push($vessel, $vessel_sub);
			array_push($namaterminal, $terminalnm);
		}		
		// print_r($terminalnm);die();
		$dt_port_terminal = implode(",",$vessel);
		$dt_nmterminal = implode(",",$namaterminal);
		//echo $dt_port_terminal; die;
        $in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_terminal>$dt_port_terminal</port_terminal>
				<terminal_name>$dt_nmterminal</terminal_name>
			</data>
		</root>";
		
		// print_r(json_explode(",",$terminal_name)); die();
		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getListVVD",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			// print_r($result);die();
            $obj2 = json_decode($result);
			if($obj2->data->vessel)
			{
				for($j=0;$j<count($obj2->data->vessel);$j++)
				{
					$this->table->add_row(
											$j+1,
											$obj2->data->vessel[$j]->vessel_name,
											$obj2->data->vessel[$j]->voyage_in.'/'.$obj2->data->vessel[$j]->voyage_out,
											$obj2->data->vessel[$j]->operator_name,
											$obj2->data->vessel[$j]->call_sign,
											$obj2->data->vessel[$j]->line,
											$obj2->data->vessel[$j]->eta,
											$obj2->data->vessel[$j]->etd,
											$obj2->data->vessel[$j]->ata,
											$obj2->data->vessel[$j]->atd,
											$obj2->data->vessel[$j]->open_stack,
											$obj2->data->vessel[$j]->closing_time,
											$obj2->data->vessel[$j]->closing_doc,
											$obj2->data->vessel[$j]->terminal_name
										);
										
				}
			}
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Vessel Schedules", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Vessel Schedules";

		$this->common_loader($data,'pages/container/main_vvd');
	}	
	
}
