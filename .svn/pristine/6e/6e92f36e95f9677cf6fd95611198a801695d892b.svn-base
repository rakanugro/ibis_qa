<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// session_start();
/*
	Create Invoice Barang

*/
require(APPPATH.'helpers/tcpdf/tcpdf.php');
class cibarang extends CI_Controller {

	var $API ="";
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
		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
		// if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
		// 	redirect(ROOT.'mainpage', 'refresh');
        $this->API=API_EINVOICE;
	}
	protected function getdataurl($url){

		// $uri = SITE_WSAPI.'/'.$url;
		//$uri = $this->API.'/'.$url;
		$uri = API_EINVOICE.'/'.$url;
		// print_r(barangsearch$uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:'.$apiKey
	   	);
		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		$data  = json_decode(curl_exec($ch));
		return $data;
	}
	protected function senddataurl($url,$data,$type){
		//$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
		$uri = API_EINVOICE.'/'.$url;
		// die($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/x-www-form-urlencoded',
			'x-api-key:'.$apiKey
	   	);
		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$type);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$ex = curl_exec($ch);
		if (preg_match("/OK/i", $ex)) {
		         $result = "curl sukses! (OUTPUT: ".$ex.")";
		} else {
		         $result = "curl gagal! (OUTPUT: ".$ex.")";
		}

		//echo $result; die;
		$result  = json_decode($ex);
		// $ex = curl_exec($ch);
		// $result  = json_encode($ex);
		// echo $result;
		#debug file
         // file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         // 	array(
         // 		"body" => $ex,
         // 		"url" => $uri,
         // 		"data" => $data,
         // ),true), FILE_APPEND);
		return $result;
	}
	public function createbarang(){
		$this->common_loader($data,'invoice/nota/barang/createinvoicebarang');
	}
	public function createInvoice(){
		$postdata = $_POST;
		$postdata['USER_ID'] = $this->session->userdata('user_id');
		//print_r($postdata);die();
		$num = $postdata["TRX_NUMBER"];
		// $postdata["ORG_ID"] = 89;
		$data = $this->senddataurl('CreateInvoiceBarang/',$postdata,'POST');
		$status = $this->getdataurl('CreateInvoiceBarang/status/'.$postdata["TRX_NUMBER"]);
		$postdataEmaterai = array("TRX_NUMBER"=>$num);
		$datax = $this->senddataurl('Ematerai/insertematerai/', $postdataEmaterai,'POST');
		$datakirim = $this->senddataurl('Pengiriman/insertpengiriman/', $postdataEmaterai, 'POST');
		$postlognota = array(
								"TRX_NUMBER"=>$postdata['TRX_NUMBER'],
								"ACTIVITY"=>"INVOICE",
								"USER_ID"=>$this->session->userdata('user_id'),
								"JENIS_PAYMENT"=>"INVOICE"
							);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');
		// echo "success";
		
		file_put_contents("CREATE_INVOICE_LOG.txt", print_r(
									array(
										"status"=>$status,
										"data" => $data,
										"datax" => $datax,
										"datakirim" => $datakirim,
								 ),true), FILE_APPEND);								 
		
		echo json_encode($status);

	}
	public function barangsearch(){
		$postdata = $_POST;
		// $postdata['KD_CABANG'] = "10";
		$postdata["BRANCH_CODE"] = $this->session->userdata('unit_id');
		$postdata["ORG_ID"] = $this->session->userdata('unit_org');
		$start = !empty($_POST['start']) ? $_POST['start'] : 0;
		$length = !empty($_POST['length']) ? $_POST['length'] : 10;
		$draw = !empty($_POST['draw']) ? $_POST['draw'] : 0;
		$postdata["offset"] = $start + $length;
		$postdata["orderby"] = !empty($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
		$postdata["ordertype"] = !empty($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
		// print_r($postdata); die();
		// echo json_encode($postdata);die();
		$arrayData = $this->senddataurl('reviewSimopBarangCustom/',$postdata,'POST');
		// print_r($arrayData);die();
		// $header = json_decode(json_encode($arrayData->header),true);
		$data = array(
				'data' => array()
			);
		$num = 1 +$start;
		$header = $this->getMstNota("BRG");

		// echo print_r($arrayData->header->RUPA05);die();
		foreach ($arrayData->data as $key => $value) {
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
            $data['data'][$key]->TANGGAL_PRANOTA =  date('Y-m-d', strtotime($value->TANGGAL_PRANOTA));
			$data['data'][$key]->AMOUNT_TOTAL = (strpos($value->AMOUNT_TOTAL,",")=='')?number_format($value->AMOUNT_TOTAL,0,'.','.'):$value->AMOUNT_TOTAL;
			$data['data'][$key]->notaJenis = htmlspecialchars($header[$value->KODE_LAYANAN],ENT_QUOTES);
			$data['data'][$key]->action = '<a onclick="Cetak(\''.$value->TRX_NUMBER.'\',\''.$value->KODE_LAYANAN.'\',\''.$value->ORG_ID.'\',\''.$value->BRANCH_CODE.'\')"  class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Preview</a>';
		$num++;

			// <a target="" href="'.ROOT.'einvoice/cibarang/cetak_barang/barang/'.$value->TRX_NUMBER.'"><i class="button">Invoice</i></a>
		}
		$dataTableArr = array(
			"draw"            => intval( $draw ),
			"recordsTotal"    => intval( $arrayData->recordsTotal ),
			"recordsFiltered" => intval( $arrayData->recordsTotal ),
		);
		$dataTableArr = array_merge($dataTableArr,$data);
		echo json_encode($dataTableArr);
	}

	function getMstNota($codeNota){
		$jenisNota = array();
		$notaJenis = $this->getdataurl('mstnota/getData/'.$codeNota);
		foreach ($notaJenis as $key => $value) {
			$jenisNota[$value->INV_NOTA_CODE] = $value->INV_NOTA_JENIS;
		}
		return $jenisNota;
	}

	/*public function cetak_email($layanan, $no_invoice){
		$this->load->helper('pdf_helper');
		tcpdf();
		//$qs = $this->input->server('QUERY_STRING');
        $id    = $this->uri->segment(5);
        //print_r($id);die;
		  //$id2 = $this->encrypt->decode($qs);
		// print_r($qs);die;
		$judul = 'priview cetak barang';
		$postdata["NO_NOTA"] = $no_invoice;

		$dataHeader = $this->senddataurl('Email/search',$postdata,'POST');
	}*/

	public function cetak_barang($layanan,$no_invoice="",$org_id){
		$this->load->helper('pdf_helper');
		tcpdf();
		//$qs = $this->input->server('QUERY_STRING');
        $id    = $this->uri->segment(5);
        //print_r($id);die;
		  //$id2 = $this->encrypt->decode($qs);
		//print_r($org_id);die;
		$judul = 'priview cetak barang';
		$postdata["TRX_NUMBER"] = $no_invoice;
		define('noNotaFooter', $no_invoice);
		// $postdata["ORG_ID"] = 89;
		// $postdata["KD_CABANG"] = 10;
		// $postdata["JENIS_NOTA"] = "BRG04";
		$postdata["BRANCH_CODE"] = $this->session->userdata('unit_id');
		$postdata["ORG_ID"] = $org_id;
		$bcode = json_decode($postdata["BRANCH_CODE"],true);
		//echo print_r($postdata); die();
		$dataHeader = $this->senddataurl('reviewSimopBarangCustom/search',$postdata,'POST');
		//echo "<pre>"; print_r($dataHeader); die();
		$postdata['KODE_LAYANAN'] = $dataHeader->KODE_LAYANAN;
		$dataSimop = $this->senddataurl('reviewDetailSimopBarang/',$postdata,'POST');
		//echo "<pre>"; print_r($dataSimop); die();
		//ambil data dari trx_header

		// $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(17, 0);
		// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->SetAutoPageBreak(TRUE);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray(null);
		// $pdf->SetPrintFooter(false);
		$pdf->SetHeaderMargin(false);
		$pdf->SetTopMargin(5);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011',
       PDF_HEADER_STRING);
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	    $pdf->SetFont('courier', '', 8);
		$pdf->AddPage();
		// $pdf->Image(APP_ROOT.'uploads/entity/'.$e_logo, 12, 3, 20, 15, '', '', '', true, 70);
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
					'font' => 'courier',
					'fontsize' => 4,
					'stretchtext' => 4
				);


		//echo "<pre>"; print_r($dataHeader);die();
		// echo print_r($dataSimop);die();
		if($dataHeader->KODE_LAYANAN == "BRG02"){
			list($header, $judul,$tbl) = $this->cetakBRG02($dataHeader, $dataSimop);
		}elseif ($dataHeader->KODE_LAYANAN == "BRG04" || $dataHeader->KODE_LAYANAN == "BRG05") {
			list($header, $judul,$tbl) = $this->cetakBRG04($dataHeader, $dataSimop);
		}elseif ($dataHeader->KODE_LAYANAN == "BRG09") {
			list($header, $judul,$tbl) = $this->cetakBRG09($dataHeader, $dataSimop);
		}elseif ($dataHeader->KODE_LAYANAN == "BRG10") {
			list($header, $judul,$tbl) = $this->cetakBRG10($dataHeader, $dataSimop);
		}elseif ($dataHeader->KODE_LAYANAN == "BRG10GLC") {
			list($header, $judul,$tbl) = $this->cetakBRG10GLC($dataHeader, $dataSimop);
		}else {
			list($header, $judul,$tbl) = $this->cetakBRG03($dataHeader, $dataSimop);
			// echo $tbl;die();
		}



        $postdata['BILLER_REQUEST_ID'] = $no_invoice;
        $postdata['MODULE'] = "BARANG";

        $data2 = $this->senddataurl('reviewSimopBarangCustom/searchHeader/',array("INV_UNIT_ORGID"=>($dataHeader->ORG_ID) == NULL ? $org_id : $dataHeader->ORG_ID, "INV_UNIT_CODE"=>($dataHeader->BRANCH_CODE) == NULL ? $bcode[0] : $dataHeader->BRANCH_CODE),'POST');
        //echo "<pre>"; print_r($data2);die();

		define('noNotaFooter', $dataHeader->TRX_NUMBER);


		$header_nota = array(
						"status_lunas"=>'S',
						"e_logo"=>$data2[0]->INV_ENTITY_LOGO,
						"e_name"=>$data2[0]->INV_ENTITY_NAME,
						"num"=>$no_invoice,
						"e_address"=>$data2[0]->INV_ENTITY_ALAMAT,
						"tgl_nota"=>date("d-M-Y"),//date("Y-m-d"),
						"bag"=>'BRG',
						"e_npwp"=>$data2[0]->INV_ENTITY_NPWP,
						"e_faktur"=>$data2[0]->INV_ENTITY_FAKTUR);
		//echo "<pre>"; print_r($header_nota);die();
		$this->load->helper('nota_invoice_helper');
		$header1 = header_pranota($header_nota);
		// echo "====>".$header1;die();
		// $dataBarang = $this->senddataurl('invh/search/',$postdata,'POST')[0];
		// if ($dataBarang->HEADER_SUB_CONTEXT == "BRG04") {
		// 	$tbl = '<table border>
	 //        			<tr>
	 //        				<td align="center" width="20"><b>No</b></td>
	 //        				<td align="center" width="90"><b>Jenis Barang</b></td>
	 //        				<td align="center" width="80"><b>Kemasan</b></td>
	 //        				<td align="center" width="80"><b>Jumlah</b></td>
	 //        				<td align="center" width="90"><b>Satuan</b></td>
	 //        				<td align="center" width="40"><b>Tarif</b></td>
	 //        				<td align="center" width="80"><b>Jumlah</b></td>


	 //        			</tr>
	 //        		</table>';
	 //        echo "kadljlkjlk";die();
		// } else {
	      //   $tbl = '<table border>
	      //   			<tr>
	      //   				<td align="center" width="20"><b>No</b></td>
							// <td align="center" width="90"><b>Jenis BARANG</b></td>
							// <td align="center" width="80"><b>KEMASAN</b></td>
							// <td align="center" width="80"><b>JUMLAH</b></td>
							// <td align="center" width="90"><b>TON/M3/Box</b></td>
							// <td align="center" width="40"><b>Hari</b></td>
							// <td align="center" width="50"><b>TARIF</b></td>
							// <td align="center" width="80"><b>BIAYA</b></td>
	      //   			</tr>
	      //   		';

		// }

		/*$footer = '<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="250px">Jumlah Pendapatan/Dasar Pengenaan Pajak</td>
		                    <td COLSPAN="2" align="right" width="220px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"> '.number_format($jum_amount, 0, ' ', '.').'</td>
                		</tr>

	                	<tr>
		                    <td COLSPAN="2" align="left" width="100px">PPN 10%</td>
		                    <td COLSPAN="2" align="right" width="370px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"> '.number_format($ppn_sendiri, 0, ' ', '.').'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px">Materai</td>
		                    <td COLSPAN="2" align="right" width="370px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"></td>
                		</tr>

	                	<tr>
		                    <td COLSPAN="2" align="left" width="100px">Jumlah Tagihan</td>
		                    <td COLSPAN="2" align="right" width="370px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px">'.number_format($jum_amount, 0, ' ', '.').'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px">Jumlah Uper</td>
		                    <td COLSPAN="2" align="right" width="370px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"></td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px"><b>Piutang</b></td>
		                    <td COLSPAN="2" align="right" width="370px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px">'.number_format($u_piutang, 0, ' ', '.').'</td>
                		</tr>
					</table>';

		$jml_footer = '<table>
						<tr>
							<td COLSPAN="2" align="left" width="80px">Terbilang</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
	                    	<td COLSPAN="7" align="left">'.$a_terbilang.'</td></br>
						</tr>
					   </table>';

		$ttd_footer ='<table>
						<tr>
							<td COLSPAN="9" ROWSPAN="5" align="left" width="300px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td align="center" width="400px">Jakarta, '.$tgl_nota.'</td>
						</tr>
						<tr>
		                    <td align="center" width="400px">Manajer Keuangan</td>
                		</tr>
                		<tr>
                			<td width="150px">&nbsp;</td>
		                    <td width="100px"><img style="padding-left:200" width="100" height="100" src="'.APP_ROOT.'uploads/ttd/'.$ttd_pejabat.'"></td>
                		</tr>
                		<tr>
		                    <td align="center" width="400px" style="text-decoration: underline">'.$pejabat.'</td>
                		</tr>
                		<tr>
                			<td align="center" width="400px" style="text-decoration: underline">NIPP. '.$nip_pejabat.'</td>
                		</tr>
                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>
					  </table>';*/
		//echo $dataHeader->KODE_LAYANAN."_".$no_invoice;
		// echo print_r($data2);
		// die();

		$ematerai_nota = array(
        				"fm"=>"FM.01/04/05/04",
						"amountMaterai"=>"",
						"redaksi"=>"",
						"status_lunas"=>"",
						"unit_wilayah"=>$data2[0]->INV_UNIT_NAME,//INV_ENTITY_NAME,
						"alamat_wilayah"=>$data2[0]->INV_UNIT_ALAMAT//INV_ENTITY_ALAMAT,
					);

		$ematerai_nota = ematerai_nota($ematerai_nota);


		$output_name = $dataHeader->KODE_LAYANAN."_".$no_invoice.".pdf";
		// echo $tbl; die();
		$pdf->SetFont('gotham', '', 8);
		$pdf->writeHtml($header1, true, false, false, false, '');
		// $pdf->SetFont('courier', '', 8);
		$pdf->writeHtml($judul, true, false, false, false, '');
		$pdf->writeHtml($header, true, false, false, false, '');
		$pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->SetY(260);
		$pdf->writeHtml($ematerai_nota, true, false, false, false, '');
		// $pdf->writeHtml($footer, true, false, false, false, '');
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		//$pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');
	}
	public function cetakBRG10($dataHeader,$dataSimop){//echo print_r($dataSimop);die;
		// echo $dataHeader->PBM_NAME;
		// die();
		if (empty($dataHeader->TRX_NUMBER)) {
			$dataHeader->TRX_NUMBER="-";
		} if (empty($dataHeader->PBM_NAME)) {
			$dataHeader->PBM_NAME="-";
	    } if (empty($dataHeader->PBM_NAME)) {
			$dataHeader->PBM_NAME="-";
	    } if (empty($dataHeader->CUSTOMER_NUMBER)){
	    	$dataHeader->CUSTOMER_NUMBER="-";
	    } if (empty($dataHeader->CUSTOMER_NAME)){
	    	$dataHeader->CUSTOMER_NAME="-";
	    } if (empty($dataHeader->CUSTOMER_ADDRESS)){
	    	$dataHeader->CUSTOMER_ADDRESS="-";
	    } if (empty($dataHeader->CUSTOMER_NPWP)) {
	    	$dataHeader->CUSTOMER_NPWP="-";
	    } if (empty($dataHeader->NPPKP)) {
	    	$dataHeader->NPPKP="-";
	    } if (empty($dataHeader->DO)) {
	    	$dataHeader->DO="-";
	    } if (empty($dataHeader->NAMA_KAPAL)) {
	    	$dataHeader->NAMA_KAPAL="-";
	    } if (empty($dataHeader->GUDANG)) {
	    	$dataHeader->GUDANG="-";
	    } if (empty($dataHeader->KEGIATAN)) {
	    	$dataHeader->KEGIATAN="-";
	    } if (empty($dataHeader->ETA_ETD)) {
	    	$dataHeader->ETA_ETD="-";
	    } if (empty($dataHeader->DISTRIBUTOR)) {
	    	$dataHeader->DISTRIBUTOR="-";
	    }
	    // echo print_r($dataHeader);die();
		$header = '<table>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">No Nota</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" style="font-size: 12px;font-family: franklingothicbook;" width="45%">'.$dataHeader->TRX_NUMBER.'</td>
					  </tr>
					  <tr>';
		if($dataHeader->BRANCH_ID == '01')
		{
			
			if (empty($dataHeader->NOTAJB_ID)) {
				$dataHeader->NOTAJB_ID="-";
			}
			
			if (empty($dataHeader->TERMINAL)) {
				$dataHeader->TERMINAL="-";
			}
		
		$header .= '<tr>
					  	<td width="15%"></td>
					    <td width="30%">No Uper</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" style="font-size: 12px;font-family: franklingothicbook;" width="45%">'.$dataHeader->NOTAJB_ID.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">TERMINAL</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" style="font-size: 12px;font-family: franklingothicbook;" width="45%">TERMINAL '.$dataHeader->TERMINAL.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PELAKSANA BONGKAR/MUAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" style="font-size: 12px;font-family: franklingothicbook;" width="45%">'.$dataHeader->PBM_NAME.'</td>
					  </tr>';	
		}
		
		if($dataHeader->BRANCH_ID != '01')
		{
		
		$header .= '<tr>
					  	<td width="15%"></td>
					    <td width="30%">P B M</td>
					    <td align="center" width="10%">:</td>
					    <td style="font-size: 12px;font-family: franklingothicbook;">'.$dataHeader->PBM_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NO ACCOUNT</td>
					    <td align="center" width="10%">:</td>
					    <td style="font-size: 12px;font-family: franklingothicbook;">'.$dataHeader->CUSTOMER_NUMBER.'</td>
					  </tr>';
		}
		$header .= '<tr>
					  	<td width="15%"></td>
					    <td width="30%">PEMILIK/PEMAKAI JASA</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->CUSTOMER_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ALAMAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->CUSTOMER_ADDRESS.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NPWP</td>
					    <td align="center" width="10%">:</td>
					    <td style="font-size: 12px;font-family: franklingothicbook;">'.$dataHeader->CUSTOMER_NPWP.'</td>
					  </tr>';
		if($dataHeader->BRANCH_ID != '01')
		{			  
		$header .= '<tr>
					<td width="15%"></td>
					    <td width="30%">NPPKP</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->NPPKP.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NO BL / DO</td>
					    <td align="center" width="10%">:</td>
					    <td>'.$dataHeader->DO.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">DISTRIBUTOR</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->DISTRIBUTOR.'</td>
					  </tr>';
		}
		if($dataHeader->BRANCH_ID != '01')
		{
			$header .= '<tr>
							<td width="15%"></td>
							<td width="30%">KAPAL / VOY / TANGGAL</td>
							<td align="center" width="10%">:</td>
							<td align="left">'.$dataHeader->NAMA_KAPAL.'</td>
						  </tr>
						  <tr>';
		}
		else
		{
			if (empty($dataHeader->VOYAGE_NO)) {
				$dataHeader->VOYAGE_NO="-";
			}
			
			$header .= '<tr>
							<td width="15%"></td>
							<td width="30%">KAPAL / VOY / TANGGAL</td>
							<td align="center" width="10%">:</td>
							<td align="left">'.$dataHeader->NAMA_KAPAL.' / '.$dataHeader->VOYAGE_NO.'</td>
						  </tr>';	
		}
		
		$header .='<tr><td width="15%"></td>
					    <td width="30%">GUDANG / LAPANGAN / KADE</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->GUDANG.' / '.$dataHeader->KADE.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">JENIS PERDAGANGAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->KEGIATAN.'</td>
					  </tr>';
		if($dataHeader->BRANCH_ID != '01')
		{			  
		$header .='<tr>
					  	<td width="15%"></td>
					    <td width="30%">PERIODE KEGIATAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->ETA_ETD.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">KETERANGAN </td>
					    <td align="center" width="10%">:</td>
					    <td align="left"></td>
					  </tr>';
		}
		else
		{
			if (empty($dataHeader->PERIODE)) {
					$dataHeader->PERIODE="-";
				}	
				
		$header .='<tr>
					  	<td width="15%"></td>
					    <td width="30%">PERIODE KEGIATAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->PERIODE.'</td>
					  </tr>';			
		}
					  
		$header .=	'</table>';

		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA BONGKAR MUAT</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';
        
		if($dataHeader->BRANCH_ID != '01')
		{	
				$tbl = '<table border="1">
								<tr>
									<td align="center" ROWSPAN="2" width="5%"><b>No</b></td>
									<td align="center" ROWSPAN="2" width="5%"><b>LOK</b></td>
									<td align="center" ROWSPAN="2" width="20%"><b>Jenis BARANG</b></td>
									<td align="center" ROWSPAN="2" width="16%"><b>KEMASAN</b></td>
									<td align="center" COLSPAN="2" width="30%"><b>JUMLAH</b></td>
									<td align="center"  ROWSPAN="2" width="13%"><b>TARIF</b></td>
									<td align="center"  ROWSPAN="2" width="13%"><b>PENDAPATAN</b></td>
								</tr>
								<tr>
									<td width="15%" align="center">BONGKAR</td>
									<td width="15%" align="center">MUAT</td>
								</tr>
							';
				   // echo print_r($dataSimop->data);die();
					$style = 'style="height:22px;line-height: 24px;"';
					$paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
					$tblDetail = '<table>';
					$tblDetailTarif = '<table>';
					$tblDetailPrice = '<table>';
					foreach ($dataSimop->detail2 as $key => $valDetail) {
						$tblDetail .= '		<tr>
											<td width="80%" align="left">-'.$valDetail->NAME_FE.'</td>
											</tr>';
						$tblDetailTarif .= '		<tr>
											<td width="80%" align="right">'.number_format($valDetail->V_TARIF,0,'.','.').'</td>
											</tr>';
						$tblDetailPrice .= '		<tr>
											<td width="80%" align="right">'.number_format($valDetail->V_PRICE,0,'.','.').'</td>
											</tr>';

					}
					$tblDetail .= '</table>';
					$tblDetailTarif .= '</table>';
					$tblDetailPrice .= '</table>';
					foreach ($dataSimop->data as $key => $value) {
						if (empty($value->LOK)) {
							$value->LOK="-";
						} if (empty($value->JENIS_BARANG)) {
							$value->JENIS_BARANG="-";
						} if (empty($value->KEMASAN)) {
							$value->KEMASAN="-";
						} 
						$tbl .= '<tr>
									<td '.$style.' align="center">'.($key+1).'</td>
									<td '.$style.' align="center">'.$value->LOK.'</td>
									<td '.$style.' align="center">'.$value->JENIS_BARANG.'<br> '.$tblDetail.'</td>
									<td '.$style.' align="center">'.$value->KEMASAN.'</td>
									<td '.$style.' align="center">'.number_format($value->JUMLAH_BONGKAR,0,'.','.').'</td>
									<td '.$style.' align="center">'.number_format($value->JUMLAH_MUAT,0,'.','.').'</td>
									<td '.$style.' align="right"> '.number_format($value->TARIF,0,'.','.').'&nbsp; &nbsp;<br> '.$tblDetailTarif.'</td>
									<td '.$style.' align="right">'.number_format($value->AMOUNT,0,'.','.').'&nbsp; &nbsp;<br> '.$tblDetailPrice.'</td>
								</tr>';
						// echo print_r($value);

					}
					$tbl .= "</table>";
					$tbl .= '<p><span style="line-height:80px">&nbsp;</span>';
					
					$tbl .= '<table>';
					$AMOUNTALAT = 0 ;
					foreach ($dataSimop->detail as $key => $value) {
						$AMOUNTALAT += intval($value->JML_BIAYAALAT);
						if (empty($value->DTL_ID)) {
							$value->DTL_ID="-";
						} if (empty($value->DESCR)) {
							$value->DESCR="-";
						} if (empty($value->JUMLAH_ALAT)) {
							$value->JUMLAH_ALAT="-";
						} if (empty($value->JUMLAH_PAKAI)) {
							$value->JUMLAH_PAKAI="-";
						} if (empty($value->TARIF_ALAT)) {
							$value->TARIF_ALAT="-";
						} if (empty($value->JML_BIAYAALAT)) {
							$value->JML_BIAYAALAT="-";
						}
						$tbl .= '<tr border"1">
									<td width="5%" >'.$value->DTL_ID.'</td>
									<td width="30%" COLSPAN="2">'.$value->DESCR.'</td>
									<td width="25%" >'.$value->JUMLAH_ALAT.' UNIT</td>
									<td align"right" width="20%">'.$value->JUMLAH_PAKAI.' UNIT X '.number_format($value->TARIF_ALAT,0,'.','.').' = </td>
									<td align"right" width="20%">'.number_format($value->JML_BIAYAALAT,0,'.','.').'</td>	
								</tr>';
						// echo print_r($value);

					}
				
				//Usaha Terminal 
				$tbl .= "</table>";
				$paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
				// print_r($paddingCustom);die();
				$sebelumPPN = intval($AMOUNTALAT);
				$mountPPN = intval($AMOUNTALAT) * 0.1;
				$sesudaPPN = intval($AMOUNTALAT) + $mountPPN;
				$tbl .= '<table>
								<tr>
									<td width="100%">'.$paddingCustom.'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">ADMINITRASI</td>
									<td align="right" width="16%">0</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">JUMLAH</td>
									<td align="right" width="16%">'.number_format($sebelumPPN,0,'.','.').'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">PPN 10%</td>
									<td align="right" width="16%">'.number_format($mountPPN,0,'.','.').'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">Jumlah Tagihan</td>
									<td align="right" width="16%">'.number_format(($sesudaPPN),0,'.','.').'</td>
								</tr>
							</table>
							';			
		}
		else
		{		
					
				$tbl = '<table border="1">
								<tr>
									<td align="center" ROWSPAN="2" width="5%"><b>No</b></td>
									<td align="center" ROWSPAN="2" width="5%"><b>VIA</b></td>
									<td align="center" ROWSPAN="2" width="20%"><b>Jenis BARANG</b></td>
									<td align="center" ROWSPAN="2" width="16%"><b>KEMASAN</b></td>
									<td align="center" COLSPAN="2" width="30%"><b>JUMLAH</b></td>
									<td align="center"  ROWSPAN="2" width="13%"><b>TARIF</b></td>
									<td align="center"  ROWSPAN="2" width="13%"><b>BIAYA</b></td>
								</tr>
								<tr>
									<td width="15%" align="center">BONGKAR</td>
									<td width="15%" align="center">MUAT</td>
								</tr>
							';
							
				foreach ($dataSimop as $key => $value) {
					// echo $value->TARIF;die();
					$tbl .= '<tr>
								<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.($key+1).'</td>
								<td align="center"'.$style.'>'.$paddingCustom.$value->JENIS_BARANG.'</td>
								<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->BONGKAR_QTY,0,'.','.').'</td>
								<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->MUAT_QTY,0,'.','.').'</td>
								<td style="font-size: 11px;font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->TARIF_JASA_BARANG),0,'.','.').'&nbsp; &nbsp;</td>
								<td style="font-size:11px; font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->AMOUNT_TOT),0,'.','.').'&nbsp; &nbsp;</td>
							</tr>';
			  
					// echo print_r($value);
				}	

				//Usaha Terminal 
				$tbl .= "</table>";
				$paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
				// print_r($paddingCustom);die();
				$mountPPN = $dataHeader->JUMLAH_SEBELUM_PPN * 0.1;
				$tbl .= '<table>
								<tr>
									<td width="100%">'.$paddingCustom.'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">JUMLAH</td>
									<td align="right" width="16%">'.number_format($dataHeader->JUMLAH,0,'.','.').'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">ADMINITRASI</td>
									<td align="right" width="16%">'.number_format($dataHeader->ADM,0,'.','.').'</td>
								</tr>
								<tr>
								<td width="70%"></td>
								<td align="right" width="16%"></td>
								<td align="right" width="16%"><hr/></td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">SEBELUM PPN</td>
									<td align="right" width="16%">'.number_format($dataHeader->JUMLAH_SEBELUM_PPN,0,'.','.').'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">PPN 10%</td>
									<td align="right" width="16%">'.number_format($dataHeader->PPN,0,'.','.').'</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td align="right" width="16%">Jumlah Tagihan</td>
									<td align="right" width="16%">'.number_format($dataHeader->JUMLAH_TAGIHAN,0,'.','.').'</td>
								</tr>
							</table>
							';				
					
		}
		
		return array($header,$judul, $tbl);
	}
	public function cetakBRG10GLC($dataHeader,$dataSimop){//echo print_r($dataSimop);die;
		// echo $dataHeader->PBM_NAME;
		// die();
		if (empty($dataHeader->TRX_NUMBER)) {
			$dataHeader->TRX_NUMBER="-";
		} if (empty($dataHeader->NO_REQUEST)) {
			$dataHeader->NO_REQUEST="-";
		} if (!empty($dataHeader->TERMINAL)) {
			$tmnl="TERMINAL ".$dataHeader->TERMINAL;
	    } if (empty($dataHeader->TERMINAL)){
	    	$tmnl="-";
	    } if (empty($dataHeader->VESSEL_NAME)){
	    	$dataHeader->VESSEL_NAME="-";
	    } if (empty($dataHeader->VOYAGE_IN)){
	    	$dataHeader->VOYAGE_IN="-";
	    } if (empty($dataHeader->VOYAGE_OUT)){
	    	$dataHeader->VOYAGE_OUT="-";
	    } if (empty($dataHeader->START_DATE)){
	    	$dataHeader->START_DATE="-";
	    } if (empty($dataHeader->END_DATE)){
	    	$dataHeader->END_DATE="-";
	    } if (empty($dataHeader->KADE)){
	    	$dataHeader->KADE="-";
	    } if (empty($dataHeader->NM_KADE)){
	    	$dataHeader->NM_KADE="-";
	    } if (empty($dataHeader->COMPANY_NAME)){
	    	$dataHeader->COMPANY_NAME="-";
	    } if (empty($dataHeader->ALAMAT_PERUSAHAAN)){
	    	$dataHeader->ALAMAT_PERUSAHAAN="-";
	    }  if (empty($dataHeader->NPWP)){
	    	$dataHeader->NPWP="-";
	    } 
	    // echo print_r($dataHeader);die();
		$header = '<table>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">No Nota</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" style="font-size: 12px;font-family: franklingothicbook;" width="45%">'.$dataHeader->TRX_NUMBER.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NO REQUEST</td>
					    <td align="center" width="10%">:</td>
					    <td style="font-size: 12px;font-family: franklingothicbook;">'.$dataHeader->NO_REQUEST.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">TERMINAL</td>
					    <td align="center" width="10%">:</td>
					    <td style="font-size: 12px;font-family: franklingothicbook;">'.$tmnl.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NAMA KAPAL</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->VESSEL_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">VOYAGE</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->VOYAGE_IN.' / '.$dataHeader->VOYAGE_OUT.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PERIODE KEGIATAN</td>
					    <td align="center" width="10%">:</td>
					    <td style="font-size: 12px;font-family: franklingothicbook;">'.$dataHeader->START_DATE.' .s/d. '.$dataHeader->END_DATE.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">KADE / LAPANGAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->KADE.' / '.$dataHeader->NM_KADE.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">P B M</td>
					    <td align="center" width="10%">:</td>
					    <td>'.$dataHeader->COMPANY_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ALAMAT P B M</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->ALAMAT_PERUSAHAAN.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NPWP P B M</td>
					    <td align="center" width="10%">:</td>
					    <td align="left">'.$dataHeader->NPWP.'</td>
					  </tr>
					</table>';

		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA TAGIHAN ALAT GLC</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';
		$style = 'style="height:22px;line-height: 24px;"';
	    $paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
		$right = 'style="text-align:right;"';		
        $tbl = '<table border="1">
	        			<tr>
	        				<td align="center"'.$style.' width="5%">'.$paddingCustom.'<b>No</b></td>
							<td align="center"'.$style.' width="12%">'.$paddingCustom.'<b>Kegiatan</b></td>
							<td align="center"'.$style.' width="10%">'.$paddingCustom.'<b>Nama ALAT</b></td>
							<td align="center"'.$style.' width="12%">'.$paddingCustom.'<b>Jenis BARANG</b></td>
							<td align="center"'.$style.' width="12%">'.$paddingCustom.'<b>KEMASAN</b></td>
							<td align="center"'.$style.' width="10%">'.$paddingCustom.'<b>JUMLAH</b></td>
							<td align="center"'.$style.' width="10%">'.$paddingCustom.'<b>SATUAN</b></td>
							<td align="center"'.$style.' width="10%">'.$paddingCustom.'<b>% ALAT</b></td>
							<td align="center"'.$style.' width="11%">'.$paddingCustom.'<b>TARIF</b></td>
							<td align="center"'.$style.' width="11%">'.$paddingCustom.'<b>TAGIHAN</b></td>
	        			</tr>
	        		';				
	        //echo print_r($dataSimop->data);die();
	   	foreach ($dataSimop as $key => $value) {
	   		//echo $value->V_TARIF;die();
			$tbl .= '<tr>
        				<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.($key+1).'</td>
						<td align="center"'.$style.'>'.$paddingCustom.$value->ACTIVITY.'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->NM_ALAT.'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->CARGO_NAME.'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->DET_KD_KEMASAN.'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->QTY,0,'.','.').'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->UNIT_TYPE_ID.'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->PERCENT_ALAT,0,'.','.').'</td>
						<td style="font-size: 11px;font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format($value->V_TARIF,0,'.','.').'&nbsp; &nbsp;</td>
						<td style="font-size:11px; font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format($value->V_AMOUNT,0,'.','.').'&nbsp; &nbsp;</td>
        			</tr>';
      
			// echo print_r($value);
		}
		$tbl .= "</table>";
	    $paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
	 // print_r($paddingCustom);die();
		$tbl .= '<table>
	        			<tr>
							<td width="100%">'.$paddingCustom.'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">ADMINITRASI</td>
							<td align="right" width="16%">0</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">JUMLAH</td>
							<td align="right" width="16%">'.number_format($dataHeader->AMOUNT_TOT,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">PPN 10%</td>
							<td align="right" width="16%">'.number_format($dataHeader->PPN,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">Jumlah Tagihan</td>
							<td align="right" width="16%">'.number_format($dataHeader->TOTAL_PAID,0,'.','.').'</td>
	        			</tr>
	        		</table>
	        		';
		return array($header,$judul, $tbl);
	}
	public function cetakBRG04($dataHeader,$dataSimop){
			if (empty($dataHeader->TRX_NUMBER)) {
				$dataHeader->TRX_NUMBER="-";
			} if (empty($dataHeader->BPRP_NO)) {
				$dataHeader->BPRP_NO="-";	
			} if (empty($dataHeader->TERMINAL)) {
				$dataHeader->TERMINAL="-";
			} if (empty($dataHeader->CUSTOMER_NAME)) {
				$dataHeader->CUSTOMER_NAME="-";
			} if (empty($dataHeader->CUSTOMER_ADDRESS)) {
				$dataHeader->CUSTOMER_ADDRESS="-";
			} if (empty($dataHeader->CUSTOMER_NPWP)) {
				$dataHeader->CUSTOMER_NPWP="-";
			} if (empty($dataHeader->NAMA_KAPAL)) {
				$dataHeader->NAMA_KAPAL="-";
			} if (empty($dataHeader->ETA_ETD)) {
				$dataHeader->ETA_ETD="-";
			} if (empty($dataHeader->KADE)) {
				$dataHeader->KADE="-";
			} if (empty($dataHeader->NAMA_KADE)) {
				$dataHeader->NAMA_KADE="-";
			} if (empty($dataHeader->KEGIATAN)) {
				$dataHeader->KEGIATAN="-";
			}
		$header = '<table>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">No Nota</td>
					    <td width="10%" align="center">:</td>
					    <td align="left" width="45%">'.$dataHeader->TRX_NUMBER.'</td>
					  </tr>';
		if($dataHeader->BRANCH_ID == '01')		
		{		

			if (empty($dataHeader->NOTA_ID_REF)) {
					$dataHeader->NOTA_ID_REF="-";	
			}
			
			$header .= '<tr>
							<td width="15%"></td>
							<td width="30%">Koreksi Dari Nota</td>
							<td width="10%" align="center">:</td>
							<td width="45%" >'.$dataHeader->NOTA_ID_REF.'</td>
						  </tr>';
		}
		if($dataHeader->BRANCH_ID != '01')		
		{
			
		$header .= '<tr>
					  	<td width="15%"></td>
					    <td width="30%">BPRP</td>
					    <td width="10%" align="center">:</td>
					    <td width="45%" >'.$dataHeader->BPRP_NO.'</td>
					  </tr>';
		}
		if($dataHeader->BRANCH_ID == '01')		
		{

			if (empty($dataHeader->TERMNAME)) {
					$dataHeader->TERMNAME="-";	
			}	
				
			$header .=	'<tr>
							<td width="15%"></td>
							<td width="30%">Terminal</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->TERMNAME.'</td>
						  </tr>
						  <tr>
							<td width="15%"></td>
							<td width="30%">PERUSAHAAN BONGKAR MUAT</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">-</td>
						  </tr>';
		}
		else
		{
			$header .=	'<tr>
							<td width="15%"></td>
							<td width="30%">Terminal</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->TERMINAL.'</td>
						  </tr>';			
		}
		
		$header .=  '<tr>
					  	<td width="15%"></td>
					    <td width="30%">PEMILIK/PEMAKAI JASA</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->CUSTOMER_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ALAMAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->CUSTOMER_ADDRESS.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NPWP</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->CUSTOMER_NPWP.'</td>
					  </tr>';
		if($dataHeader->BRANCH_ID != '01')		
		{			  
		$header .=  '<tr>			  	
						<td width="15%"></td>
					    <td width="30%">NAMA KAPAL</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->NAMA_KAPAL.'</td>
					  </tr>';
		}
		
		if($dataHeader->BRANCH_ID == '01')		
		{
			if (empty($dataHeader->BL_NO)) {
						$dataHeader->BL_NO="-";	
				}
			if (empty($dataHeader->DO_NO)) {
						$dataHeader->DO_NO="-";	
				}
			if (empty($dataHeader->VOYAGE_NO)) {
						$dataHeader->VOYAGE_NO="-";	
				}
			if (empty($dataHeader->JENIS_PERDAGANGAN)) {
						$dataHeader->JENIS_PERDAGANGAN="-";	
				}	
				
		$header .='<tr>
						<td width="15%"></td>
						<td width="30%">KADE</td>
						<td align="center" width="10%">:</td>
						<td align="left" width="45%">'.$dataHeader->NAMA_KADE.'</td>
						</tr>
						<tr>
						<td width="15%"></td>
						<td width="30%">NOMOR BPRP/BL/DO</td>
						<td align="center" width="10%">:</td>
						<td align="left" width="45%">'.$dataHeader->BPRP_NO.' / '.$dataHeader->BL_NO.' / '.$dataHeader->DO_NO.'</td>
						</tr>
						<tr>			  	
						<td width="15%"></td>
					    <td width="30%">NAMA KAPAL / VOY</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->NAMA_KAPAL.' / '.$dataHeader->VOYAGE_NO.'</td>
					 </tr>
					 <tr>
					  	<td width="15%"></td>
					    <td width="30%">JENIS PERDAGANGAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->JENIS_PERDAGANGAN.'</td>
					  </tr>';
		}	
		
		if($dataHeader->BRANCH_ID != '01')		
		{		  
		
		$header .='<tr>
					  	<td width="15%"></td>
					    <td width="30%">VOYAGE</td>
					    <td align="center" width="10%">:</td>
					    <td width="45%">-</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ETA/ETD</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->ETA_ETD.'</td>
					  </tr>
					  <tr>
						<td width="15%"></td>
					    <td width="30%">KADE</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->NAMA_KADE.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">KEGIATAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->KEGIATAN.'</td>
					  </tr>';
					
		}
		
		$header .='</table>';
		if($dataHeader->KODE_LAYANAN == 'BRG05')
		{
		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA HANDLING FEE</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';	
		}
		else
		{
		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA ANGKUTAN LANGSUNG</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';
		}
        $style = 'style="height:22px;line-height: 24px;"';
        $right = 'style="text-align:right;"';
        // $center = 'style="text-align:çenter;"';
	    $paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
        $tbl = '<table border="1">
	        			<tr>
	        				<td align="center"'.$style.' width="5%">'.$paddingCustom.'<b>No</b></td>
							<td align="center"'.$style.' width="17%">'.$paddingCustom.'<b>Jenis BARANG</b></td>
							<td align="center"'.$style.' width="16%">'.$paddingCustom.'<b>KEMASAN</b></td>
							<td align="center"'.$style.' width="16%">'.$paddingCustom.'<b>JUMLAH</b></td>
							<td align="center"'.$style.' width="17%">'.$paddingCustom.'<b>SATUAN</b></td>
							<td align="center"'.$style.' width="16%">'.$paddingCustom.'<b>TARIF</b></td>
							<td align="center"'.$style.' width="16%">'.$paddingCustom.'<b>BIAYA</b></td>
	        			</tr>
	        		';
	        		// print_r($dataSimop);die();//number_format(($value->TARIF),0,'.','.')
		if($dataHeader->BRANCH_ID == '01')
		{
			foreach ($dataSimop as $key => $value) {
				// echo $value->TARIF;die();
				/*<td  align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->TON.'/'.$paddingCustom.$value->M3.'/'.$paddingCustom.$value->BOX.'&nbsp; &nbsp;</td>*/
				$tbl .= '<tr>
							<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.($key+1).'</td>
							<td align="center"'.$style.'>'.$paddingCustom.$value->JENIS_BARANG.'</td>
							<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->KEMASAN.'</td>
							<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->QTY,0,'.','.').'</td>
							<td  align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->UNIT_TYPE_ID.'&nbsp; &nbsp;</td>
							<td style="font-size: 11px;font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->V_RATE),0,'.','.').'&nbsp; &nbsp;</td>
							<td style="font-size:11px; font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->V_PRICE),0,'.','.').'&nbsp; &nbsp;</td>
						</tr>';
		  
				// echo print_r($value);

			}
		}
		else
		{
			foreach ($dataSimop as $key => $value) {
				// echo $value->TARIF;die();
				/*<td  align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->TON.'/'.$paddingCustom.$value->M3.'/'.$paddingCustom.$value->BOX.'&nbsp; &nbsp;</td>*/
				$tbl .= '<tr>
							<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.($key+1).'</td>
							<td align="center"'.$style.'>'.$paddingCustom.$value->JENIS_BARANG.'</td>
							<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->KEMASAN.'</td>
							<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->JUMLAH,0,'.','.').'</td>
							<td  align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.$value->TON.'/'.$paddingCustom.$value->M3.'/'.$paddingCustom.$value->BOX.'&nbsp; &nbsp;</td>
							<td style="font-size: 11px;font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->TARIF),0,'.','.').'&nbsp; &nbsp;</td>
							<td style="font-size:11px; font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->AMOUNT),0,'.','.').'&nbsp; &nbsp;</td>
						</tr>';
		  
				// echo print_r($value);

			}
		}
		// Angkutan Langsung
		$tbl .= '</table>';
		// print_r($dataHeader);die();
		$sebelumPPN = intval($dataHeader->AMOUNT_TOTAL)/110*100;
		$mountPPN = intval($dataHeader->AMOUNT_TOTAL)-$sebelumPPN;
		
		if($dataHeader->BRANCH_ID == '01')
		{
		$tbl .= '<table>
	        			<tr>
							<td width="100%">'.$paddingCustom.'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">PAS</td>
							<td align="right" width="16%">0</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">JUMLAH</td>
							<td align="right" width="16%">'.number_format($dataHeader->V_TAXBASE,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">PPN 10%</td>
							<td align="right" width="16%">'.number_format($dataHeader->V_TAXVALUE,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">Jumlah Tagihan</td>
							<td align="right" width="16%">'.number_format($dataHeader->V_TOBEPAID,0,'.','.').'</td>
	        			</tr>
	        		</table>
	        		';	
		}
		else
		{
		 $tbl .= '<table>
	        			<tr>
							<td width="100%">'.$paddingCustom.'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">ADMINITRASI</td>
							<td align="right" width="16%">0</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">JUMLAH</td>
							<td align="right" width="16%">'.number_format($sebelumPPN,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">PPN 10%</td>
							<td align="right" width="16%">'.number_format($mountPPN,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">Jumlah Tagihan</td>
							<td align="right" width="16%">'.number_format(($dataHeader->AMOUNT_TOTAL),0,'.','.').'</td>
	        			</tr>
	        		</table>
	        		';
		}
		return array($header,$judul, $tbl);
	}
	public function cetakBRG03($dataHeader,$dataSimop){
		//echo "<pre>"; print_r($dataSimop); die;
		if (empty($dataHeader->TRX_NUMBER)) {
			$dataHeader->TRX_NUMBER="-";
		} if (empty($dataHeader->NOTAPREV)) {
			$dataHeader->NOTAPREV="-";
		} if (empty($dataHeader->BPRP_NO)) {
			$dataHeader->BPRP_NO="-";
		} if (empty($dataHeader->PBM_NAME)) {
			$dataHeader->PBM_NAME="-";
		} if (empty($dataHeader->CUSTOMER_NAME)) {
			$dataHeader->CUSTOMER_NAME="-";
		} if (empty($dataHeader->CUSTOMER_ADDRESS)) {
			$dataHeader->CUSTOMER_ADDRESS="-";
		} if (empty($dataHeader->CUSTOMER_NPWP)) {
			$dataHeader->CUSTOMER_NPWP="-";
		} if (empty($dataHeader->KADE)) {
			$dataHeader->KADE="-";
		} if (empty($dataHeader->GUDANG)) {
			$dataHeader->GUDANG="-";
		} if (empty($dataHeader->BPRP_NO)) {
			$dataHeader->BPRP_NO="-";
		} if (empty($dataHeader->BL_NO)) {
			$dataHeader->BL_NO="-";
		} if (empty($dataHeader->DO_NO)) {
			$dataHeader->DO_NO="-";
		} if (empty($dataHeader->NAMA_KAPAL)) {
			$dataHeader->NAMA_KAPAL="-";
		} if (empty($dataHeader->VOY)) {
			$dataHeader->VOY="-";
		} if (empty($dataHeader->KEGIATAN)) {
			$dataHeader->KEGIATAN="-";
		}
		$header = '<table>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">No PRANOTA</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->TRX_NUMBER.'</td>
					  </tr>
					  <tr>';
		if($dataHeader->BRANCH_ID == '01')
		{
			$header .=	'<tr>
							<td width="15%"></td>
							<td width="30%">Koreksi dari NOTA</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->NOTAPREV.'</td>
						  </tr>';
		}
		$header .=	'<tr>
					  	<td width="15%"></td>
					    <td width="30%">BPRP</td>
					    <td align="center" width="10%">:</td>
					    <td width="45%">'.$dataHeader->BPRP_NO.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PERUSAHAAN BONGKAR MUAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->PBM_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PEMILIK / PEMAKAI JASA</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->CUSTOMER_NAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ALAMAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->CUSTOMER_ADDRESS.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NPWP</td>
					    <td align="center" width="10%">:</td>
					    <td width="45%">'.$dataHeader->CUSTOMER_NPWP.'</td>
					  </tr>';
		if($dataHeader->BRANCH_ID == '01')
		{			  
			$header .=	  '<tr>
							<td width="15%"></td>
							<td width="30%">GUDANG LAPANGAN / KADE</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->GUDANG.' / '.$dataHeader->KADE.'</td>
						  </tr>';
		}
		else
		{
			$header .=	  '<tr>
							<td width="15%"></td>
							<td width="30%">GUDANG LAPANGAN / KADE</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->KADE.'</td>
						  </tr>';
		}
		if($dataHeader->BRANCH_ID == '01')
		{
			$header .=	  '<tr>
							<td width="15%"></td>
							<td width="30%">NOMOR BPRP/BL/DO</td>
							<td align="center" width="10%">:</td>
							<td width="45%">'.$dataHeader->BPRP_NO.' / '.$dataHeader->BL_NO.' / '.$dataHeader->DO_NO.'</td>
						  </tr>';
		}
		else
		{			
			$header .=	  '<tr>
							<td width="15%"></td>
							<td width="30%">NOMOR BPRP/BL/DO</td>
							<td align="center" width="10%">:</td>
							<td width="45%">'.$dataHeader->BPRP_NO.'</td>
						  </tr>';
		}
					  
		if($dataHeader->BRANCH_ID == '01')
		{			  
			$header .= 	'<tr>		  
							<td width="15%"></td>
							<td width="30%">NAMA KAPAL/VOY /TANGGAL</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->NAMA_KAPAL.' / '.$dataHeader->VOY.'</td>
						  </tr>';
		}
		else
		{
			$header .= 	'<tr>		  
							<td width="15%"></td>
							<td width="30%">NAMA KAPAL/VOY /TANGGAL</td>
							<td align="center" width="10%">:</td>
							<td align="left" width="45%">'.$dataHeader->NAMA_KAPAL.'</td>
						  </tr>';	
		}
		
		$header .=	'<tr>
					  	<td width="15%"></td>
					    <td width="30%">JENIS PERDAGANGAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->KEGIATAN.'</td>
					  </tr>
		
			</table>';

		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA DAN PERHITUNGAN JASA DERMAGA PENUMPUKAN</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';
        $tbl = '<table border="1">
	        			<tr>
							<td style="height:22px;padding: 5px;" align="center" width="17%"><b>JENIS BARANG<br>JUMLAH BARANG</b></td>
							<td style="height:22px;padding: 5px;" align="center" width="80"><b>TANGGAL<br>-MASUK<br>-KELUAR<br>-JUMLAH HARI</b></td>
							<td style="height:22px;padding: 5px;" align="center" width="80"><b>HARI<br>-MASA 1 <br>-MASA 2</b></td>
							<td style="height:22px;padding: 5px;" align="center" width="80"><b>TARIF <br>-PENUMPUKAN <br>-DERMAGA</b></td>
							<td style="height:22px;padding: 5px;" align="center" width="17%"><b>SEWA <br>-MASA 1 <br>-MASA 2</b></td>
							<td style="height:22px;padding: 5px;" align="center" width="80"><b>JUMLAH <b></b></td>
	        			</tr>
	        		';
	    $paddingCustom = '<span style="line-height:25px">&nbsp;</span>';
        $tbl = '<table border="1">
	        			<tr>
							<td align="center" style="height:22px;" height="65px"  width="18%">'.$paddingCustom.'<b>JENIS BARANG<br>JUMLAH BARANG</b></td>
							<td align="center" style="height:22px;" height="65px"  width="17%">'.$paddingCustom.'<b>TANGGAL<br>-MASUK<br>-KELUAR<br>-JUMLAH HARI</b></td>
							<td align="center" style="height:22px;" height="65px"  width="16%">'.$paddingCustom.'<b>HARI<br>-MASA 1.1 <br>-MASA 1.2 <br>-MASA 2</b></td>
							<td align="center" style="height:22px;" height="65px"  width="16%">'.$paddingCustom.'<b>TARIF <br>-PENUMPUKAN <br>-DERMAGA</b></td>
							<td align="center" style="height:22px;" height="65px"  width="15%">'.$paddingCustom.'<b>SEWA <br>-MASA 1.1 <br>-MASA 1.2 <br>-MASA 2</b></td>
							<td align="center" style="height:22px;" height="65px"  width="18%">'.$paddingCustom.'<b>JUMLAH<br>-SEWA PENUMPUKAN<br>-UANG DERMAGA</b></td>
	        			</tr>
	        		';
	   	foreach ($dataSimop as $key => $value) {
	   		if (empty($value->DAYS1)) {
	   			$value->DAYS1="-";
	   		} 
	   		if (empty($value->DAYS2)) {
	   			$value->DAYS2="-";
	   		} 
			
			if (empty($value->DAYS3)) {
	   			$value->DAYS3="-";
	   		} 
	   		if (empty($value->SEWA_MASA1)) {
	   			$value->SEWA_MASA1="-";
	   		} else {
	   			number_format($value->SEWA_MASA1,0,'.','.');
	   		} 

	   		if (empty($value->SEWA_MASA2)) {
	   			$value->SEWA_MASA2="-";
	   		} else {
	   			number_format($value->SEWA_MASA2,0,'.','.');
	   		}
			
			if (empty($value->SEWA_MASA3)) {
	   			$value->SEWA_MASA2="-";
	   		} else {
	   			number_format($value->SEWA_MASA3,0,'.','.');
	   		}
			
			if (empty($value->TARIF_PENUMPUKAN)) {
	   			$value->TARIF_PENUMPUKAN="0";
	   		} else {
	   			number_format($value->TARIF_PENUMPUKAN,0,'.','.');
	   		}
			
			if (empty($value->TARIF_DERMAGA)) {
	   			$value->TARIF_DERMAGA="0";
	   		} else {
	   			number_format($value->TARIF_DERMAGA,0,'.','.');
	   		}
			
			if (empty($value->JUMLAH_SEWA_PENUMPUKAN)) {
	   			$value->JUMLAH_SEWA_DERMAGA="0";
	   		} else {
	   			number_format($value->JUMLAH_SEWA_DERMAGA,0,'.','.');
	   		}
			
			if (empty($value->JUMLAH_SEWA_DERMAGA)) {
	   			$value->JUMLAH_SEWA_DERMAGA="0";
	   		} else {
	   			number_format($value->JUMLAH_SEWA_DERMAGA,0,'.','.');
	   		}
			
			if (!empty($value->JUMLAH_BARANG1)) {
	   			$value->JUMLAH_BARANG1="<br/>".$value->JUMLAH_BARANG1;
	   		}

	   	
	   		$date1 = new DateTime($value->TANGGAL_MASUK);
			$date2 = new DateTime($value->TANGGAL_KELUAR);
		
			$diff = $date2->diff($date1)->format("%a");
			$diff = $diff + 1;

			
			
		
			$sewa_penumpukan = $value->DAYS1 * $value->TARIF_PENUMPUKAN;
			$sewa_dermaga = $value->DAYS1 * $value->TARIF_DERMAGA;
			$tbl .= '<tr>
						<td  align="center" width="18%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.$value->JENIS_BARANG.'<br>'.$value->JUMLAH_BARANG.$value->JUMLAH_BARANG1.'</td>
						<td  align="center" width="17%">'.$paddingCustom.$value->TANGGAL_MASUK.'<br>'.$value->TANGGAL_KELUAR.'<br>'.$diff.' hari</td>
						<td  align="center" width="16%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.$value->DAYS1.'<br>'.' '.$value->DAYS2.'<br>'.' '.$value->DAYS3.'</td>
						<td  align="center" width="16%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.number_format($value->TARIF_PENUMPUKAN,0,'.','.').'<br>'.number_format($value->TARIF_DERMAGA,0,'.','.').'</td>
						<td  align="center" width="15%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.number_format($value->SEWA_MASA1,0,'.','.').'<br>'.' '.$paddingCustom.number_format($value->SEWA_MASA2,0,'.','.').'<br>'.' '.$paddingCustom.number_format($value->SEWA_MASA3,0,'.','.').'</td>
						<td  align="right" width="18%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.number_format($value->JUMLAH_SEWA_PENUMPUKAN,0,'.','.').'&nbsp; &nbsp; <br>'.number_format($value->JUMLAH_SEWA_DERMAGA,0,'.','.').'&nbsp; &nbsp;</td>
        			</tr>';

		}

		//Dermaga Penumpukan
		$tbl .= "</table>";
		if($dataHeader->BRANCH_ID == '01')
		{
			$tbl .= '<table>
							<tr>
								<td width="100%">'.$paddingCustom.'</td>
							</tr>
							<tr>
								<td align="left" width="75%">ADMINITRASI</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">0</td>
							</tr>
							<tr>
								<td align="left" width="75%">KEBERSIHAN</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($dataHeader->V_KEBERSIHAN,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">LAIN-LAIN</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($dataHeader->V_OTHERINCOME,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">PAS</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($dataHeader->V_PAS,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">JUMLAH</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($dataHeader->V_TAXBASE,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">PPN 10%</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($dataHeader->V_TAXVALUE,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">Jumlah Tagihan</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($dataHeader->V_TOBEPAID,0,'.','.').'</td>
							</tr>
						</table>
						';			
		}
		else
		{
			$sebelumPPN = intval($dataHeader->AMOUNT_TOTAL) / 110*100;
			$mountPPN = intval($dataHeader->AMOUNT_TOTAL) - $sebelumPPN;
			$sesudaPPN = intval($dataHeader->AMOUNT_TOTAL);
			$tbl .= '<table>
							<tr>
								<td width="100%">'.$paddingCustom.'</td>
							</tr>
							<tr>
								<td align="left" width="75%">ADMINITRASI</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">0</td>
							</tr>
							<tr>
								<td align="left" width="75%">JUMLAH</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($sebelumPPN,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">PPN 10%</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format($mountPPN,0,'.','.').'</td>
							</tr>
							<tr>
								<td align="left" width="75%">Jumlah Tagihan</td>
								<td width="5%">Rp.</td>
								<td align="right" width="20%">'.number_format(($sesudaPPN),0,'.','.').'</td>
							</tr>
						</table>
						';
		}
		return array($header,$judul, $tbl);
	}
	public function cetakBRG02($dataHeader,$dataSimop){
		if (empty($dataHeader->TRX_NUMBER)) {
			$dataHeader->TRX_NUMBER="-";
		} if (empty($dataHeader->BPRP_ID)) {
			$dataHeader->BPRP_ID="-";	
		} if (empty($dataHeader->TERMINAL)) {
			$dataHeader->TERMINAL="-";
		} if (empty($dataHeader->NAMA_PELANGGAN)) {
			$dataHeader->NAMA_PELANGGAN="-";
		} if (empty($dataHeader->ALAMAT_PELANGGAN)) {
			$dataHeader->ALAMAT_PELANGGAN="-";
		} if (empty($dataHeader->NPWP_PELANGGAN)) {
			$dataHeader->NPWP_PELANGGAN="-";
		} if (empty($dataHeader->NAMA_KAPAL)) {
			$dataHeader->NAMA_KAPAL="-";
		} if (empty($dataHeader->TANGGAL_MASUK)) {
			$dataHeader->TANGGAL_MASUK="-";
		} if (empty($dataHeader->TANGGAL_KELUAR)) {
			$dataHeader->TANGGAL_KELUAR="-";
		} if (empty($dataHeader->GUDANG)) {
			$dataHeader->GUDANG="-";
		} if (empty($dataHeader->KADE)) {
			$dataHeader->KADE="-";
		} if (empty($dataHeader->JENIS_PERDAGANGAN)) {
			$dataHeader->JENIS_PERDAGANGAN="-";
		}
		$header = '<table>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">No PRANOTA</td>
					    <td width="10%" align="center">:</td>
					    <td align="left" width="45%">'.$dataHeader->TRX_NUMBER.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">BPRP</td>
					    <td width="10%" align="center">:</td>
					    <td width="45%" >'.$dataHeader->BPRP_ID.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">TERMINAL</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->TERMINAL.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PEMILIK/PEMAKAI JASA</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->NAMA_PELANGGAN.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ALAMAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->ALAMAT_PELANGGAN.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NPWP</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->NPWP_PELANGGAN.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NAMA KAPAL</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->NAMA_KAPAL.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PERIODE KEGIATAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->TANGGAL_MASUK.' s/d '.$dataHeader->TANGGAL_KELUAR.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">GUDANG LAPANGAN / KADE</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->GUDANG.' / '.$dataHeader->KADE.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">JENIS PERDAGANGAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->JENIS_PERDAGANGAN.'</td>
					  </tr>
					</table>';

		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA SHARING GUDANG / LAPANGAN</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';
        $style = 'style="height:22px;line-height: 24px;"';
        $right = 'style="text-align:right;"';
        // $center = 'style="text-align:çenter;"';
	    $paddingCustom = '<span style="line-height:25px">&nbsp;</span>';	
        $tbl = '<table border="1">
	        			<tr>
	        				<td align="center" ROWSPAN="2" width="5%"><b>No</b></td>
							<td align="center" ROWSPAN="2" width="41%"><b>Jenis BARANG</b></td>
							<td align="center" COLSPAN="2" width="30%"><b>JUMLAH</b></td>
							<td align="center"  ROWSPAN="2" width="13%"><b>TARIF</b></td>
							<td align="center"  ROWSPAN="2" width="13%"><b>PENDAPATAN</b></td>
	        			</tr>
	        			<tr>
	        				<td width="15%" align="center">BONGKAR</td>
	        				<td width="15%" align="center">MUAT</td>
	        			</tr>
	        		';	
					
	        		// print_r($dataSimop);die();//number_format(($value->TARIF),0,'.','.')
	   	foreach ($dataSimop as $key => $value) {
	   		// echo $value->TARIF;die();
			$tbl .= '<tr>
        				<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.'>'.$paddingCustom.($key+1).'</td>
						<td align="center"'.$style.'>'.$paddingCustom.$value->JENIS_BARANG.'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->BONGKAR_QTY,0,'.','.').'</td>
						<td align="center" style="font-size: 11px;font-family: franklingothicbook;"'.$style.$center.'>'.$paddingCustom.number_format($value->MUAT_QTY,0,'.','.').'</td>
						<td style="font-size: 11px;font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->TARIF_JASA_BARANG),0,'.','.').'&nbsp; &nbsp;</td>
						<td style="font-size:11px; font-family: franklingothicbook;"'.$style.$right.'>'.$paddingCustom.number_format(($value->AMOUNT_TOT),0,'.','.').'&nbsp; &nbsp;</td>
        			</tr>';
      
			// echo print_r($value);

		}
		// REALISASI JASA BARANG ATAU SHARING GUDANG LAPANGAN
		$tbl .= '</table>';
		// print_r($dataHeader);die();
		 $tbl .= '<table>
	        			<tr>
							<td width="100%">'.$paddingCustom.'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">ADMINITRASI</td>
							<td align="right" width="16%">0</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">JUMLAH</td>
							<td align="right" width="16%">'.number_format(($dataHeader->AMOUNT_TOT),0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">PPN 10%</td>
							<td align="right" width="16%">'.number_format(($dataHeader->V_PPN),0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td width="70%"></td>
							<td align="right" width="16%">Jumlah Tagihan</td>
							<td align="right" width="16%">'.number_format(($dataHeader->AMOUNT_TOT_PPN),0,'.','.').'</td>
	        			</tr>
	        		</table>
	        		';
		return array($header,$judul, $tbl);
	}
	public function cetakBRG09($dataHeader,$dataSimop){
		//echo "<pre>"; print_r($dataSimop); die;
		if (empty($dataHeader->OVERSTAGE_ID)) {
			$dataHeader->OVERSTAGE_ID="-";
		} if (empty($dataHeader->PBMNAME)) {
			$dataHeader->PBMNAME="-";
		} if (empty($dataHeader->ADDRESS)) {
			$dataHeader->ADDRESS="-";
		} if (empty($dataHeader->TAX_ID)) {
			$dataHeader->TAX_ID="-";
		} if (empty($dataHeader->KADE)) {
			$dataHeader->KADE="-";
		} if (empty($dataHeader->nama_kade)) {
			$dataHeader->nama_kade="-";
		} if (empty($dataHeader->NAMA_KAPAL)) {
			$dataHeader->NAMA_KAPAL="-";
		} if (empty($dataHeader->VESSEL_ID)) {
			$dataHeader->VESSEL_ID="-";
		} if (empty($dataHeader->BL_NO)) {
			$dataHeader->BL_NO="-";
		}
		$header = '<table>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">No PRANOTA / TERM</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->OVERSTAGE_ID.' / '.$dataHeader->TERMINAL.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">PEMILIK / PEMAKAI JASA</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->PBMNAME.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">ALAMAT</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->ADDRESS.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NPWP</td>
					    <td align="center" width="10%">:</td>
					    <td width="45%">'.$dataHeader->TAX_ID.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">KADE</td>
					  	<td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->KADE.' / '.$dataHeader->nama_kade.'</td>
					  </tr> 
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NO BL</td>
					  	<td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->BL_NO.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">NAMA KAPAL / VOY</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->nama_kapal.' / '.$dataHeader->VESSEL_ID.'</td>
					  </tr>
					  <tr>
					  	<td width="15%"></td>
					    <td width="30%">TANGGAL KEGIATAN</td>
					    <td align="center" width="10%">:</td>
					    <td align="left" width="45%">'.$dataHeader->DACTIVITY.'</td>
					  </tr>
					</table>';

		$judul ='<table>
        			<tr>
                    <td width="110" align="left"></td>
                    <td width="420" align="center" style="font-size:24px">PRANOTA OVERSTAGE</td>
                    <td width="100" align="left"></td>
                	</tr>
        		</table>';
        $tbl = '<table border="0">
	        			<tr>
							<td align="center" style="height:22px;" height="22px"><b>URAIAN<br>REALISASI OVERSTAGE</b></td>
	        			</tr>
	        		';
		$paddingCustom = '<span style="line-height:25px">&nbsp;</span>';				
	   	foreach ($dataSimop as $key => $value) {
	   		if (empty($value->SHIFT)) {
	   			$value->SHIFT="-";
	   		} 
	   		if (empty($value->OVERSTAGE)) {
	   			$value->OVERSTAGE="-";
	   		} 
			if (empty($value->V_TARIF)) {
	   			$value->V_TARIF="-";
	   		} 
			if (empty($value->V_TOTAL)) {
	   			$value->V_TOTAL="-";
	   		} 
			
			$tbl .= '<tr>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.'SHIFT</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' x </td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.'LOA</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' x </td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.'TARIF</td>
						<td  align="center" width="10%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.$value->SHIFT.'</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.'shift</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' x </td>
						<td  align="center" width="10%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.$value->OVERSTAGE.'</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' mtr</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' x </td>
						<td  align="center" width="10%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.number_format($dataHeader->V_TARIF,0,'.','.').'</td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' / </td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' 3 </td>
						<td  align="left" width="5%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.' = </td>
						<td  align="center" width="12%" style="font-size: 11px;font-family: franklingothicbook;">'.$paddingCustom.number_format($dataHeader->V_TOTAL,0,'.','.').'</td>
        			</tr>';	

		}

		//OVERSTAGE
		$tbl .= "</table>";
		$tbl .= '<table>
	        			<tr>
							<td width="100%">'.$paddingCustom.'</td>
	        			</tr>
	        			<tr>
							<td align="left" width="75%">ADMINITRASI</td>
							<td width="5%">Rp.</td>
							<td align="right" width="20%">0</td>
	        			</tr>
	        			<tr>
							<td align="left" width="75%">JUMLAH</td>
							<td width="5%">Rp.</td>
							<td align="right" width="20%">'.number_format($dataHeader->V_TOTAL,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td align="left" width="75%">PPN 10%</td>
							<td width="5%">Rp.</td>
							<td align="right" width="20%">'.number_format($dataHeader->V_PPN,0,'.','.').'</td>
	        			</tr>
	        			<tr>
							<td align="left" width="75%">Jumlah Tagihan</td>
							<td width="5%">Rp.</td>
							<td align="right" width="20%">'.number_format(($dataHeader->V_TOBEPAID),0,'.','.').'</td>
	        			</tr>
	        		</table>
	        		';
		return array($header,$judul, $tbl);
	}	

	public function common_loader($data,$views) {
		if (! $this->session->userdata('is_login') ){
		 	redirect(ROOT.'main_invoice', 'refresh');
		}
		$role_id =  $this->session->userdata('role_id')	;
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}
}

class MyCustomPDFWithWatermark extends TCPDF {
    public function Header() {
        // Get the current page break margin
        $bMargin = $this->getBreakMargin();

        // Get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;

        // Disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        // Define the path to the image that you want to use as watermark.
        $img_file = APP_ROOT.'assets/images/copy.png';

        // Render the image
        $this->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

        // Restore the auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);

        // Set the starting point for the page content
        $this->setPageMark();
    }
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, noNotaFooter, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, "Print Date : ".date("d-M-Y H:i:s").' | Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
    /*protected $last_page_flag = false;

	public function Close() {
	    $this->last_page_flag = true;
	    parent::Close();
	}

	public function Footer() {
	    if ($this->last_page_flag) {
	        // ... footer for the last page ...
	    }
	}*/
}
