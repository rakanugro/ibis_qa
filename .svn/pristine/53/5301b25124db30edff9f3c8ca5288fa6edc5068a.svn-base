<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Cetak extends CI_Controller {

	var $API ="";

	public function __construct(){
        parent::__construct();

				$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		/*if (! $this->session->userdata('is_login') ){
		 	redirect('main_invoice');
		}*/
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

        $this->API=API_EINVOICE;
        $this->load->library('nama_fungsi');
    }

    public  function mytoken($url){
        $data    = $this->nama_fungsi->dekripsi($url);
        if($data != false){
            if (method_exists($this, trim($data['function']))){
                if(!empty($data['params'])){
        // echo print_r($data['params']);die();
                    return call_user_func_array(array($this, trim($data['function'])), $data['params']);
                }else{
                   return $this->$data['function']();
                }
            }
       }
       show_404();
	}
/*
    public  function cetakNota($url){
        $data    = $this->nama_fungsi->dekripsi($url);
        echo print_r($data);die();
        if($data != false){
            if (method_exists($this, trim($data['function']))){
                if(!empty($data['params'])){
                    return call_user_func_array(array($this, trim($data['function'])), $data['params']);
                }else{
                   return $this->$data['function']();
                }
            }
       }
       show_404();
	}*/


    public function download($id,$token ="") {
        // echo print_r($token);die();

    	$cek_data = $this->getdataurl('invh/'.$id);
	    // echo "id:".$id;
	    $modul = $cek_data->HEADER_CONTEXT;
	    // echo $modul;die();

	    switch ($modul) {
	    	case 'KPL':
	    		$data = array(

	    			'modul' => 'KAPAL',
	    			'url' => ROOT."einvoice/nota_kapal/cetak_nota_kapal/".$id."/".$token


	    		);

	    		$this->load->library('../controllers/einvoice/nota_kapal');
	    		$this->nota_kapal->cetak_nota_kapal($id,$token);
	    		break;

	    	case 'RUPA':
	    		$data = array(

	    			'modul' => 'RUPARUPA',
	    			'url' => ROOT."einvoice/nota/cetak_nota/RUPARUPA/".$id."/".$token


	    		);
	    		$modul ='RUPARUPA';

	    		$this->load->library('../controllers/einvoice/nota');
	    		$this->nota->cetak_nota($modul,$id);

	    		break;

	    	case 'BRG':
	    		$data = array(

	    			'modul' => 'KAPAL',
	    			'url' => ROOT."einvoice/nota/cetak_barang/barang/".$id."/".$token


	    		);
	    		$modul ='barang';

	    		// echo $modul;die();
	    		$this->load->library('../controllers/einvoice/barang');
	    		$this->barang->cetak_barang($modul,$id);
	    		break;

	    	case 'PTKM':
	    		$data = array(

	    			'modul' => 'KAPAL',
	    			'url' => ROOT."einvoice/nota/cetak_nota/petikemas/".$id."/".$token


	    		);
	    		$modul ='PETIKEMAS';

	    		$this->load->library('../controllers/einvoice/nota');
	    		$this->nota->cetak_nota($modul,$id);
	    		break;

	    	default:
			exit('Data not found.');
	    }

	    //$this->load->view('invoice/nota/cetakan_nota',$data);
    }


	protected function getdataurl($url){

		// $uri = SITE_WSAPI.'/'.$url;
		//$uri = $this->API.'/'.$url;
		$uri = API_EINVOICE.'/'.$url;
		// print_r($uri);
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

	public function cetak_nota($layanan,$no_invoice=""){
		$this->load->helper('pdf_helper');
		tcpdf();
		$qs = $this->input->server('QUERY_STRING');
        // $id 	= $this->uri->segment(4);
		$id2 = $this->encrypt->decode($qs);

		// print_r($id2);die;

		$judul = 'priview cetak kapal';

		switch($layanan)
		{
			case "kapal":
				$title = "Report Nota Kapal";
			break;
				$title = "Report Nota petikemas";
			case "petikemas":

			$data_header = $this->getdataurl('invh/'.$id2);
			//ambil data dari trx_header
				$num       = $data_header->TRX_NUMBER;
				$tgl_nota  = $data_header->TRX_DATE;
				$custname  = $data_header->CUSTOMER_NAME;
				$c_number  = $data_header->CUSTOMER_NUMBER;
				$c_address = $data_header->CUSTOMER_ADDRESS;
				$nomornpwp = $data_header->CUSTOMER_NPWP;
				$kapal 	   = $data_header->VESSEL_NAME;
				$no_req    = $data_header->BILLER_REQUEST_ID;
				$current   = $data_header->CURRENCY_CODE;

			$entitas = $this->getdataurl('entity/page/'.$id2);
			foreach ($entitas as $e_data) {
				$data_entity = $e_data;
				$e_name 	 = $data_entity->INV_ENTITY_NAME;
				$e_address   = $data_entity->INV_ENTITY_ADDRESS;
				$e_npwp      = $data_entity->INV_ENTITY_NPWP;
				$e_faktur 	 = $data_entity->INV_ENTITY_FAKTUR_PAJAK;
				// print_r($e_name);die;

			}

			//ambil dari db_invoice
			$data_unit = $this->getdataurl('unit/page/'.$id2);
			foreach ($data_unit as $unity) {
				$unit = $unity;
				//print_r($unity);die;
				$start_date 	= $unit->INV_UNIT_START_DATE;
				$pejabat 		= $unit->INV_UNIT_PEJABAT;
				$nip_pejabat 	= $unit->INV_UNIT_NIPP;
				$unit_wilayah 	= $unit->INV_UNIT_WILAYAH;
				$unit_alamat 	= $unit->INV_UNIT_ALAMAT;

			}

				// print_r($id2);die;
			$trxline = $this->getdataurl('invl/'.$id2);

				// print_r($trxline);die;
			$jum_amount=0;
			$tax_amount=0;
			$total_amount=0;
			foreach ($trxline as $jumlah) {
				$total_amount = $jumlah;

				//perhitungan pengenaan pajak
				// $jum_amount = $this->db->query("select SUM(AMOUNT) amount from XEINVC_AR_INVOICE_LINES");
				$jum = $jumlah->AMOUNT;
				$jum_amount = $jum_amount + $jum;

				$tax = $jumlah->TAX_AMOUNT;
				$tax_amount = $tax_amount + $tax;

				$jum_total = $jum_amount + $tax_amount;
				$total_amount = $total_amount+$jum_total;

				//barcode
				$idsecret = $this->encrypt->encode($TRX_NUMBER);
				// $hash = md5(ROOT."http://localhost/ibis_qa/index.php/einvoice/cetak/cetak_nota/$TRX_NUMBER");
				$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
				//$params['level'] = 'H';
				//$params['size'] = 10;
				$randomfilename = id2 + rand(1000, 9999);
				$params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
				$this->ciqrcode->generate($params);
				$barcode_location=APP_ROOT."qr_code/$randomfilename.png";
				$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
			}

			$huruf = $this->getdataurl('others/terbilang/'.$total_amount);
			foreach ($huruf as $bilang) {
				$terbilang = $bilang->NILAI;
				$terbilang = $terbilang.'Rupiah';
			}
			// print_r($jum);die;


			// ---tutup data -----------

				$title = "Report Nota Petikemas";
			break;

			case "barang":
				$title ="Report Nota Barang";
			break;

			case "ruparupa":
			$title = "Report Nota Ruparupa";
			break;
		}

		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(17, 0);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->SetAutoPageBreak(TRUE);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray(null);
		$pdf->SetPrintFooter(false);
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

		$pdf->AddPage();
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

		//$query = $this->M_report->cetak_pdf();
		//$pdf->Cell(0,30, $judul, 0, 2, 'C', 0,FALSE);
		// <td width="120"></td><td COLSPAN="12" align="left"><font size="12"><b>$corporate_name | $terminal_name</b></font></td> //contoh pdf ambil paramater
		//<td width="120"></td><td COLSPAN="12" align="left"><b>NPWP : $corporate_npwp</b></td> //contoh pdf ambil paramater
		$pdf->SetFont('courier', '', 8); //Courier New
		//$pdf->setfont(‘courier’l

		$header = '<table>
				<tr>
                    <td width="70"></td><td COLSPAN="12" align="left"><b>'.$e_name.'</b></td>
                    <td COLSPAN="2" align="left" width="50px">No. Nota</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$num.'</td>

                </tr>
                <tr>
                    <td width="70"></td><td COLSPAN="12" align="left">'.$e_address.'</td>
                    <td COLSPAN="2" align="left" width="50px">Tanggal</td>
					<td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">'.$tgl_nota.'</td>
                </tr>

                <tr>
                    <td width="70"></td><td COLSPAN="12" align="left">NPWP: '.$e_npwp.'</td>
                    <td COLSPAN="2" align="left" width="150px">'.$e_faktur.'</td>
                </tr>

                <tr>
                	<td COLSPAN="13"></td>
                    <td COLSPAN="2" align="left" width="80px"></td>
					<td COLSPAN="1" align="left" width="10px"></td>
                    <td COLSPAN="2" align="left" width="170px"></td>
                </tr>

                <tr>
                	<td COLSPAN="13"></td>
                    <td COLSPAN="2" align="left" width="80px"></td>
					<td COLSPAN="1" align="left" width="10px"></td>
                    <td COLSPAN="2" align="left" width="170px"></td>
                </tr>

                </table>';

        $judul ='<table>
        			<tr>
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA JASA KEPELABUHAN</b></td>
                	</tr>
        		</table>';

        $lampiran = '<table>
        			<tr>
	                    <td COLSPAN="2"><b>Penerima Jasa</b></td>
                	</tr>

                	<tr>

	                    <td COLSPAN="2" align="left" width="50px">Nama</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$custname.'</td>


	                    <td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
	                    <td COLSPAN="2" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="200px">'.$kapal.'</td>
                	</tr>

                	<tr>

	                    <td COLSPAN="2" align="left" width="50px">Nomor</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$c_number.'</td>


	                    <td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px">'.$kunjungan.'</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="50px">Alamat</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$c_address.'</td>

	               		<td COLSPAN="2" align="left" width="120px">No. Request</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                        <td COLSPAN="2" align="left"  width="170px">'.$no_req.'</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="50px">NPWP</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$nomornpwp.'</td>

	                    <td COLSPAN="2" align="left" width="120px">Jenis Perdagangan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px"></td>
                	</tr>

        			</table>';

        $tbl = '<table border>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="90"><b>Jenis Jasa</b></td>
        				<td align="center" width="80"><b>Tgl Awal</b></td>
        				<td align="center" width="80"><b>Tgl Akhir</b></td>
        				<td align="center" width="20"><b>BOX</b></td>
        				<td align="center" width="40"><b>Size</b></td>
        				<td align="center" width="40"><b>Type</b></td>
        				<td align="center" width="40"><b>STS</b></td>
        				<td align="center" width="40"><b>HZ</b></td>
        				<td align="center" width="40"><b>Hari</b></td>
        				<td align="center" width="50"><b>Tarif</b></td>
        				<td align="center" width="80"><b>Jumlah</b></td>

        			</tr>
        		</table>';
		switch($layanan)
		{
			case "kapal":
				$this->get_data_kapal($no_invoice,$data_table);
				$tbl .= $data_table;
				$output_name = "LAPORAN PDF NOTA KAPAL";
			break;

			case "petikemas":
			foreach ($trxline as $line) {
				$data_table = $line;
				//print_r($line);die;
				$this->get_data_petikemas($no_invoice,$data_table,$current);
				$tbl .= $data_table;

			}
				$output_name = "LAPORAN PDF NOTA PETIKEMAS";
				break;

			case "barang":
				$this->get_data_barang($no_invoice,$data_table);
				$tbl .=$data_table;
				$output_name ="LAPORAN PDF NOTA BARANG";
				break;

			case "ruparupa":
				$this->get_data_ruparupa($no_invoice,$data_table);
				$tbl .=$data_table;
				$output_name ="LAPORAN PDF NOTA RUPARUPA";
				break;
		}

		$footer = '<table>
						<tr>

		                    <td COLSPAN="2" align="left" width="100px">DASAR PENGENAAN PAJAK</td>
		                    <td COLSPAN="2" align="right" width="457px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"> '.number_format($jum_amount, 0, ' ', '.').'</td>
                		</tr>

	                	<tr>

		                    <td COLSPAN="2" align="left" width="100px">PPN</td>
		                    <td COLSPAN="2" align="right" width="457px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"> '.number_format($tax_amount, 0, ' ', '.').'</td>
                		</tr>

	                	<tr>

		                    <td COLSPAN="2" align="left" width="100px"><b>Jumlah Tagihan</b></td>
		                    <td COLSPAN="2" align="right" width="457px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="61px"> '.number_format($total_amount, 0, ' ', '.').'</td>
                		</tr>
					</table>';

		$jml_footer = '<table>
						<tr>
							<td COLSPAN="2" align="left" width="80px">Terbilang</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
	                    	<td COLSPAN="7" align="left">'.$terbilang.'</td></br>
						</tr>
					   </table>';

		$ttd_footer ='<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="right" width="457px">Jakarta, '.$start_date.'</td>
                		</tr>

                		<tr>

		                    <td COLSPAN="2" align="right" width="550px">Manajer Keuangan</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td COLSPAN="2" align="right" width="457px"><img height="100" width="100" src="'.$ttd_location.'" /></td>

                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px">'.$unit_wilayah.'</td>
		                    <td COLSPAN="2" align="right" width="443px">'.$pejabat.'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px">'.$unit_alamat.'</td>
		                    <td COLSPAN="2" align="right" width="450px">NIPP. '.$nip_pejabat.'</td>
                		</tr>
					  </table>';


		$pdf->writeHtml($header, true, false, false, false, '');
		$pdf->writeHtml($judul, true, false, false, false, '');
		$pdf->writeHtml($lampiran, true, false, false, false, '');
		$pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->writeHtml($footer, true, false, false, false, '');
		$pdf->writeHtml($jml_footer, true, false, false, false, '');
		$pdf->writeHtml($tgl_footer, true, false, false, false, '');
		//$pdf->writeHtml($barcoded, true, false, false, false, '');
		$pdf->writeHtml($ttd_footer, true, false, false, false, '');
		$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');
	}


	public function get_data_kapal($no_invoice,&$data_table) {

		$data_table ='<table border="1">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="50">No</th>';
		$data_table .='<th>nama 1</th>';
		$data_table .='<th>nama 2</th>';
		$data_table .='<th>nama 3</th>';
		$data_table .='<th align="center">Tanggal Masuk</th>';
		$data_table .='<th align="center">Tanggal Keluar</th>';
		$data_table .='<th align="center">Harga</th>';
		$data_table .='</tr>';

		$data_table .='</table>';
	}

	public function get_data_petikemas($no_invoice,&$data_table,&$current) {
		//data diambil dari trx_line
		$no 		= $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc 		= $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal 	= $data_table->START_DATE;
		$tgl_akhir 	= $data_table->END_DATE;
		$box 		= $data_table->INTERFACE_LINE_ATTRIBUTE7;
		$Att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		list($size, $type, $sts, $hz) = split(" ", $Att6, 4);
		// print_r($sts);die;
		// $type   	= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		// $sts 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		// $hz     	= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		$hari 		= $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$jumlah 	= $data_table->AMOUNT;

		//print_r($jumlah);die;

		$data_table ='<table border="">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="20">'.$no.'</th>';
		$data_table .='<th align="center" width="90">'.$desc.'</th>';
		$data_table .='<th align="center" width="80">'.$tgl_awal.'</th>';
		$data_table .='<th align="center" width="80">'.$tgl_akhir.'</th>';
		$data_table .='<th align="center" width="20">'.$box.'</th>';
		$data_table .='<th align="center" width="40">'.$size.'</th>';
		$data_table .='<th align="center" width="40">'.$type.'</th>';
		$data_table .='<th align="center" width="40">'.$sts.'</th>';
		$data_table .='<th align="center" width="40">'.$hz.'</th>';
		$data_table .='<th align="center" width="40">'.$hari.'</th>';
		$data_table .='<th align="center" width="50">'.$tarif.'</th>';
		$data_table .='<th align="right" width="18">'.$current.'</th>'; //taro disini blum bisa nampil
		$data_table .='<th align="right" width="60">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .='</tr>';

		$data_table .='</table>';

	}

	public function get_data_barang($no_invoice,&$data_table){
		$data_table  ='<table border="1">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="50">No</th>';
		$data_table .='<th>nama 1</th>';
		$data_table .='<th>nama 2</th>';
		$data_table .='<th>nama 3</th>';
		$data_table .='<th align="center">Tanggal Masuk</th>';
		$data_table .='<th align="center">Tanggal Keluar</th>';
		$data_table .='<th align="center">Harga</th>';
		$data_table .='</tr>';

		$data_table .='</table>';
	}

	public function get_data_ruparupa($no_invoice, &$data_table){
		$data_table  ='<table border="1">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="50">No</th>';
		$data_table .='<th>nama 1</th>';
		$data_table .='<th>nama 2</th>';
		$data_table .='<th>nama 3</th>';
		$data_table .='<th align="center">Tanggal Masuk</th>';
		$data_table .='<th align="center">Tanggal Keluar</th>';
		$data_table .='<th align="center">Harga</th>';
		$data_table .='</tr>';

		$data_table .='</table>';
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



	public function upload_excel(){
			include_once ( APPPATH."libraries/excel_reader2.php");

			//membaca file excel yang diupload
			$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
			//membaca jumlah baris dari data excel
			$baris = $data->rowcount($sheet_index = 0);
			//echo $baris;

			//nilai awal counter jumlah data yang sukses dan yang gagal diimport
			$sukses = 0;
			$gagal = 0;
			$param = '';
			$param_temp="";
			$jumlah_OK=0;
			//echo($baris);
			//import data excel dari baris kedua, karena baris pertama adalah nama kolom
			$req 			= htmLawed($_POST['req_excel']);
			$reqNoBiller = $this->container_model->getNumberRequestBiller($req);
			for ($i = 8; $i <= $baris; $i++) {
				//membaca data nama depan (kolom ke-1)  (No Container)

				$no_container = $data->val($i, 1);
				$type         = $data->val($i, 2);
				$carrier      = $data->val($i, 3);
				$iso_code     = $data->val($i, 4);
				$height       = $data->val($i, 5);
				$size         = $data->val($i, 6);
				$status       = $data->val($i, 7);
				$hz           = $data->val($i, 8);
				$unnumber     = $data->val($i, 9);
				$imo		  = $data->val($i, 10);
				$tmp		  = $data->val($i, 11);
				$ow           = $data->val($i, 12);
				$oh           = $data->val($i, 13);
				$ol           = $data->val($i, 14);

				//$ukk 			= htmLawed($_GET['ukk'];

				$comm			= "";
				$book			= "";
				$ship			= "I";
				$nor 			= "";

				$param_b_var= array(
						"v_nc"=>"$no_container",
						"v_req"=>"$reqNoBiller",
						"v_stc"=>"$status",
						"v_hc"=>"$hz",
						"v_sc"=>"$size",
						"v_tc"=>"$type",
						"v_comm"=>"$comm",
						"v_imo"=>"$imo",
						"v_iso"=>"$iso_code",
						"v_book"=>"$book",
						"v_hgc"=>"$height",
						"v_ship"=>"$ship",
						"v_car"=>"$carrier",
						"v_tmp"=>"$tmp",
						"v_oh"=>"$oh",
						"v_ow"=>"$ow",
						"v_ol"=>"$ol",
						"v_un"=>"$unnumber",
						"v_nor"=>"$nor",
						"v_jnskeg"=>"",
						"v_msg"=>"");

				//var_dump($param_b_var); die;

				$msg="";

				$inv_char 	= array("&", "\"", "'", "<", ">");
				$fix_char	= array(" ", " ", " ", " ", " ");

				$request_no=$req;
				$container_no=$no_container;
				$container_size=$size;
				$container_type=$type;
				$container_status=$status;
				$container_height=$height;
				$container_weight='';
				$container_operator=$carrier;
				$container_dangerous=$hz;
				$container_imo=$imo;
				$container_un='';
				$container_temperature=$tmp;
				$container_excess_width=$ow;
				$container_excess_height=$oh;
				$container_excess_length=$ol;
                $trading_type=isset($_POST['trading_type_excel']) ? htmLawed($_POST['trading_type_excel']) : '';
                $carrier   =$carrier;
                $port   =isset($_POST['port_excel']) ? htmLawed($_POST['port_excel']) : '';
                $commodity   ='';

				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<detail>
							<request_no>$reqNoBiller</request_no>
							<container_no>$container_no</container_no>
							<size>$container_size</size>
							<type>$container_type</type>
							<status>$container_status</status>
							<height>$container_height</height>
							<weight>$container_weight</weight>
							<operator>$container_operator</operator>
							<dangerous>$container_dangerous</dangerous>
							<imo>$container_imo</imo>
							<un>$container_un</un>
							<temperature>$container_temperature</temperature>
							<excess_width>$container_excess_width</excess_width>
							<excess_height>$container_excess_height</excess_height>
							<excess_length>$container_excess_length</excess_length>
							<trading_type>$trading_type</trading_type>
							<carrier>$carrier</carrier>
							<port>$port</port>
							<commodity>$commodity</commodity>
						</detail>
					</data>
				</root>";

				//echo $in_data; die;

				if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"requestRecei vingDetail",array("in_data" => "$in_data"),$result))
				{
					echo $result;
					die;
				}
				else
				{
					//echo $result;die;
					$obj = json_decode($result);

					if($obj->data=='OK')
					{
						$jumlah_OK++;
						//$data['no_container'] = $obj->data->request_no;
					} else {
						if($no_container!=''){
							$param_temp .= $no_container.' - '.$obj->data.' <br>';
						}
					}
				}
				//$param .= $no_container.' - '.$result.' <br>';

			}
			$param='Jumlah OK '.$jumlah_OK.'<br>';
			$param.=$param_temp;
			//echo($param);
			header("Location: ".ROOT."container_receiving/edit_receiving/".$req."/".($param));
			die();

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
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY,"getListRequestDeliveryPerpCompressed",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo result;die;
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
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
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
			//echo $result;die;
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

		echo json_encode($result);
	}

    public function billing_management($search="")
	{
		//$this->redirect();

		$customer_id=$this->session->userdata('customerid_phd');
		$group_id = $this->session->userdata('group_phd');

		//create table
		$result=$this->container_model->getNumberReqAndSourceByCust($customer_id);
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
						"NOTA",
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
						"NOTA",
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
				$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a>";
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
		$cekship=$this->master_model->cek_shippingline();
		//create table
		$result=$this->container_model->getNumberReqAndSourceBySearch($customer_id,$search);

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
						"NOTA",
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
						"NOTA",
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
				$notalink = "<a class='btn btn-primary' target='_blank' href='".$urlnota."/".$row['REQUEST_ID']."/".$row['PORT_ID']."/".$row['TERMINAL_ID']."/".md5($row['REQUEST_ID'])."'><i class='fa fa-file-pdf-o'></i></a>";
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

	public function search_main_truck(){
		//echo "hahaha";
		//die();
		$this->redirect();
		$customer_id=$this->session->userdata('customerid_phd');
		$group_id = $this->session->userdata('group_phd');

		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search=isset($_POST['search']) ? htmLawed($_POST['search']) : 10;
		//create table
		//$result=$this->container_model->getNumberReqAndSourceDeliveryBySearch($customer_id,$search);
		//create table
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		   "<th width='100px'>CUSTOMER NAME</th>",
		  "<th width='100px'>TRUCK ID</th>",
		  "<th width='100px'>TRUCK NUMBER</th>",
		  "<th width='100px'>RFID CODE</th>",
		  "<th width='100px'>Jenis Kendaraan</th>",
		  "<th width='100px'>Tanggal Berlaku</th>",
		  "<th width='50px'>VIEW</th>",
		  "<th width='50px'>EDIT</th>",
		  "<th width='50px'>DELETE</th>"
		  //"<th width='50px'>" . get_content($this->user_model,"delivery","cancel") . "</th>",

		 );

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$customer_id=$this->session->userdata('customerid_phd');
		 $in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<search_tid>$search</search_tid>
			</data>
		</root>";
		//echo $in_data;
		//die();

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"srchTruckReg",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;
			//die;
			$obj = json_decode($result);

			if($obj->data->listreq)
			{

				$i=1;
				for($i=0;$i<count($obj->data->listreq);$i++)
					{
					$label_span='<span class="label label-default">N/A</span>';
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link='<span class="label label-default">N/A</span>';
					$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/cancel_tid/".$obj->data->listreq[$i]->TID.'"><i class=\'fa fa-trash-o\'></i></a>';
					$confirm_link='<span class="label label-default">N/A</span>';

					$this->table->add_row(
						$i+1,
						$obj->data->listreq[$i]->COMPANY_NAME,
						$obj->data->listreq[$i]->TID,
						$obj->data->listreq[$i]->TRUCK_NUMBER,
						$obj->data->listreq[$i]->PROXIMITY,
						$obj->data->listreq[$i]->KEND_TYPE,
						$obj->data->listreq[$i]->TGL_BERLAKU,
						$label_span,
						$label_span,
						$cancel_link
						//$confirm_link
					);
				}
			} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		}

		$this->load->view('pages/om/search_main_truck', $data);;
	}

public function upload_excel_truck() {
			//include "excel_reader2.php";
			include_once ( APPPATH."libraries/excel_reader2.php");
		    $port_excel = $_POST['port_excel'];
			$id_req_excel = $_POST['id_req_excel'];
			$bl_number_excel = $_POST['bl_number_excel'];
			$id_vvd_excel = $_POST['id_vvd_excel'];
			$e_i_excel = $_POST['e_i_excel'];
			$id_servicetype_excel = $_POST['id_servicetype_excel'];
			$servicetype_excel = $_POST['servicetype_excel'];

			//get detail delivery
			$port			= explode("-",$port_excel);

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
				$no_truck = $data->val($i, 1);
				//$ukk 			= $_GET['ukk'];
				if($no_truck!=""){
					$stack = array();

					//no error
					// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
					// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal

						$in_data="	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<tid>$no_truck</tid>
								<port_code>".$port[0]."</port_code>
								<terminal_code>".$port[1]."</terminal_code>
							</data>
						</root>";
					//echo $in_data;die;
							injek($in_data);
					if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getTruckID",array("in_data" => "$in_data"),$result))
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
								$temp['TID']=$obj->data->container[$j]->tid;
								$temp['TRUCK_NUMBER']=$obj->data->container[$j]->truck_number;
								$temp['PROXIMITY']=$obj->data->container[$j]->rfid_code;
								$temp['COMPANY_NAME']=$obj->data->container[$j]->company_name;
								$temp['ID_TRUCK']=$obj->data->container[$j]->id_truck;
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
					<no_req>$id_req_excel</no_req>
					<tid>".$temp['TID']."</tid>
					<truck_number>".$temp['TRUCK_NUMBER']."</truck_number>
					<bl_number>$bl_number_excel</bl_number>
					<truck_company>".$temp['COMPANY_NAME']."</truck_company>
					<rfid_code>".$temp['PROXIMITY']."</rfid_code>
					<ei>$e_i_excel</ei>
					<id_vvd>$id_vvd_excel</id_vvd>
					<id_servicetype>$id_servicetype_excel</id_servicetype>
					<service_type>$servicetype_excel</service_type>
					<id_truck>".$temp['ID_TRUCK']."</id_truck>
				</data>
			</root>";
			injek($in_data);

			//echo $in_data;
			//die();
			if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"addDetailTCA",array("in_data" => "$in_data"),$result))
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
										$param_temp .= $no_truck.' - '.$obj->data->info.' <br>';
									}
								} else {
									$param_temp .= $no_truck.' Sudah Terinput <br> ';
								}
							}

						} catch (Exception $e) {
							echo "NO,GAGAL1";
						}
					} else {
						$param_temp .= $no_truck.' - Truck Not Found <br>';
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
			header("Location: ".ROOT."om/truck/edit_tca/".$id_req_excel."/".($param));
			die();
	}

	public function payment(){

		$this->redirect();

		//create table
		$this->table->set_heading('NO', '', 'REQUEST NUMBER', 'VESSEL - VOYAGE', 'PORT - TERMINAL', 'REQUEST DATE','STATUS','DOWNLOAD PROFORMA');

		$customer_id=$this->session->userdata('custid_phd');

		$result=$this->container_model->getReqNotPaidByCust($customer_id);

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
				$checkbox,
				$this->security->xss_clean($row['REQUEST_ID']),
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



    }


    public function auto_request_bl() {
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
                                    <noreq>$term</noreq>
                                    <port_code>".$port[0]."</port_code>
                                    <terminal_code>".$port[1]."</terminal_code>
                                    <customer_id>$customer_id</customer_id>
                            </data>
                        </root>";

		log_message('error', 'nilai in data: '.json_encode($in_data));

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getRequestBL",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//echo $result;
			if($obj->data->old_req)
			{
				for($i=0;$i<count($obj->data->old_req);$i++)
				{
					$temp;
					$temp['ID_CUST']=$obj->data->old_req[$i]->id_cust;
					$temp['ID_REQ']=$obj->data->old_req[$i]->id_req;
					$temp['CUST_NAME']=$obj->data->old_req[$i]->cust_name;
					$temp['VESSEL']=$obj->data->old_req[$i]->vessel;
					$temp['VOYAGE']=$obj->data->old_req[$i]->voyage;
					$temp['VOYAGE_IN']=$obj->data->old_req[$i]->voy_in;
					$temp['VOYAGE_OUT']=$obj->data->old_req[$i]->voy_out;
					$temp['PKG_NAME']=$obj->data->old_req[$i]->pkg_name;
					$temp['QTY']=$obj->data->old_req[$i]->qty;
					$temp['TON']=$obj->data->old_req[$i]->ton;
					$temp['BL_NUMBER']=$obj->data->old_req[$i]->bl_number;
					$temp['BL_DATE']=$obj->data->old_req[$i]->bl_date;
					$temp['E_I']=$obj->data->old_req[$i]->e_i;
					$temp['ID_VVD']=$obj->data->old_req[$i]->id_vvd;
					$temp['HS_CODE']=$obj->data->old_req[$i]->hs_code;
					$temp['ID_SERVICETYPE']=$obj->data->old_req[$i]->id_servicetype;
					$temp['SERVICETYPE_NAME']=$obj->data->old_req[$i]->servicetype_name;
					array_push($stack, $temp);
				}
			}
		}
		log_message('error', 'nilai stacj: '.json_encode($stack));
		echo json_encode($stack);

    }



		public function create_request_tca() {

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_delivery-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$no_request=$_POST["NO_REQUEST"];
		$vessel=$_POST["VESSEL"];
		$voyage_in=$_POST["VOYAGE_IN"];
		$voyage_out=$_POST["VOYAGE_OUT"];
		$customer_id=$_POST["CUSTOMER_ID"];
		$customer_name=$_POST["CUSTOMER_NAME"];
		$pkg_name=$_POST["PKG_NAME"];
		$qty=$_POST["QTY"];
		$ton=$_POST["TON"];
		$bl_number=$_POST["BL_NUMBER"];
		$bl_date=$_POST["BL_DATE"];
		$id_vvd=$_POST["ID_VVD"];
		$ei=$_POST["EI"];
		$hs_code=$_POST["HS_CODE"];
		$id_servicetype=$_POST["ID_SERVICETYPE"];
		$service_type=$_POST["SERVICE_TYPE"];

		//declare form validation pemesanan pengeluaran default


		//declare form validation pemesanan pengeluaran internasional



		if($this->input->post()) {
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
						<vessel>$vessel</vessel>
						<no_request>$no_request</no_request>
						<voyage_in>$voyage_in</voyage_in>
						<voyage_out>$voyage_out</voyage_out>
						<customer_id>$customer_id</customer_id>
						<customer_name>$customer_name</customer_name>
						<pkg_name>$pkg_name</pkg_name>
						<qty>$qty</qty>
						<ton>$ton</ton>
						<bl_number>$bl_number</bl_number>
						<bl_date>$bl_date</bl_date>
						<ei>$ei</ei>
						<id_vvd>$id_vvd</id_vvd>
						<hs_code>$hs_code</hs_code>
						<id_servicetype>$id_servicetype</id_servicetype>
						<service_type>$service_type</service_type>
					</data>
				</root>";
				//print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"createRequestTCA",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					die;

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
					//echo $result;die;
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
				$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
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
				$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 20, 14, 8, '', '', '', true, 72);
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
		$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
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
				$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
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

			if($terminal_code=='T3I')
			{
				$terminal_name='TERMINAL 3 OCEAN GOING';
			}
			else if($terminal_code=='T3D')
			{
				$terminal_name='TERMINAL 3 DOMESTIK';
			}
			else if($terminal_code=='T2D')
			{
				$terminal_name='TERMINAL 2 DOMESTIK';
			}
			else if($terminal_code=='T1D')
			{
				$terminal_name='TERMINAL 1 DOMESTIK';
			}
			else if($terminal_code=='T009D')
			{
				$terminal_name='TERMINAL 1 009 (DOMESTIK)';
			}
			else if($terminal_code=='L2D')
			{
				$terminal_name='TERMINAL LINI 2 DOMESTIK';
			}
			else if($terminal_code=='L2I')
			{
				$terminal_name='TERMINAL LINI 2 INTERNATIONAL';
			}

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
							<b><font size="10"></font></b>
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
							<b><font size="12"></font></b>
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
			$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 10, 9, 18, 12, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 15, 115, 180, 50, '', '', '', true, 72);
			//$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($tbl0, true, false, false, false, '');
			$pdf->write1DBarcode("$nocont", 'C128', 18, 30, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("PIN", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("$nocont", 'C128', 18, 198, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("PIN", 'C128', 130, 198, '', 18, 0.4, $style, 'N');

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
				if($port_code=='IDJKT')
				{
					$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
				}
				else if($port_code=='IDPNK')
				{
					$corporate_name = "PT. IPC TERMINAL PETIKEMAS";
				}

				if($terminal_code=='T3I')
				{
					$terminal_name='TERMINAL 3 OCEAN GOING';
					$app_name='OPUS';
				}
				else if($terminal_code=='T3D')
				{
					$terminal_name='TERMINAL 3 DOMESTIK';
					$app_name='ITOS';
				}
				else if($terminal_code=='T2D')
				{
					$terminal_name='TERMINAL 2 DOMESTIK';
					$app_name='ITOS';
				}
				else if($terminal_code=='T1D')
				{
					$terminal_name='TERMINAL 1 DOMESTIK';
					$app_name='ITOS';
				}
				else if($terminal_code=='T009D')
				{
					$terminal_name='TERMINAL 1 009 (DOMESTIK)';
					$app_name='OPUS';
				}
				else if($terminal_code=='L2D'||$terminal_code=='L2I')
				{
					$terminal_name='LINI 2';
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

				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 10, 9, 18, 12, '', '', '', true, 72);
				//$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 15, 115, 180, 50, '', '', '', true, 72);
				//$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->writeHTML($tbl0, true, false, false, false, '');
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

}
