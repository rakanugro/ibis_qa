<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Invoice extends CI_Controller {	

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
			
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function index(){
	
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
	}
	
	function val_invoice($version, $type, $no_request, $port_code, $terminal_code, $challenge_code){
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
			
		$stack = array();
		$barcode_location = "";
		
		//check url validation
		if($version=="1")
		{
			$hash = md5(ROOT."invoice/val_invoice/1/$type/$no_request/$port_code/$terminal_code/");
			if($hash != $challenge_code)
			{
				echo "url not valid";
				die;
			}
		}
		
		$nobiller=$this->container_model->getNumberRequestBiller($no_request);
		$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
		$user = $this->session->userdata('uname_phd');		
		
		if($type=="del")
		{
			$wsdl = REQUEST_DELIVERY_CONTAINER;
			$modul="getPDFNotaContainer";
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_request>$nobiller</no_request>
					<no_request_ol>$no_request</no_request_ol>
					<port_code>".$port_code."</port_code>
					<terminal_code>".$terminal_code."</terminal_code>
					<barcode_location>".$barcode_location."</barcode_location>
					<ttd_location>$ttd_location</ttd_location>
					<user>".$user."</user>					
				</data>
			</root>";
		}
		else if($type=="rec")
		{
			$wsdl = REQUEST_RECEIVING_CONTAINER;
			$modul="getPDFNotaContainer";
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_request>$nobiller</no_request>
					<no_request_ol>$no_request</no_request_ol>
					<port_code>".$port_code."</port_code>
					<terminal_code>".$terminal_code."</terminal_code>
					<barcode_location>".$barcode_location."</barcode_location>
					<ttd_location>$ttd_location</ttd_location>
					<user>".$user."</user>					
				</data>
			</root>";
		}	
		else if($type=="loadc")
		{
			$wsdl = REQUEST_BATALMUAT;
			$modul="getPDFNotaContainer";
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_request>$nobiller</no_request>
					<no_request_ol>$no_request</no_request_ol>
					<port_code>".$port_code."</port_code>
					<terminal_code>".$terminal_code."</terminal_code>
					<barcode_location>".$barcode_location."</barcode_location>
					<ttd_location>$ttd_location</ttd_location>
					<user>".$user."</user>					
				</data>
			</root>";
		}

		if(!$this->nusoap_lib->call_wsdl($wsdl,"$modul",array("in_data" => "$in_data"),$result))
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
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

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
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				$pdf->AddPage();
				$pdf->writeHTML($lampiran_nota, true, false, false, false, '');				
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				
				$pdf->setPage(1);
				$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_jasa_kepelabuhanan - '.$obj->data->faktur_id.'.pdf', 'I');
				exit();
			} else {
				echo "NO,GAGAL";					
			}			
		}
	}
}