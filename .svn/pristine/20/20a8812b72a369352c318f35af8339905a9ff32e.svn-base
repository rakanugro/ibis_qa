<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
//session_start();
require(APPPATH.'helpers/tcpdf/tcpdf.php');
class Reporting extends CI_Controller {

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
		$this->load->model('dashboard_integrasi');

		//add library PHP Excel
		// $this->load->library('PHPExcel');
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

	
	function laporanperiodik(){
		
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$this->common_loader($data,'invoice/reporting/laporanperiodik/laporanperiodik');		
	}

    // START 01/11/2019 Penambahan Reporting Harian Periodik
    function laporanperiodikharian(){

        $role_id =  $this->session->userdata('role_id')	;
        $data['layanan'] = $this->auth_model->get_layanan($role_id);
        $this->common_loader($data,'invoice/reporting/laporanperiodikharian/laporanperiodikharian');
    }
    // STOP 01/11/2019 Penambahan Reporting Harian Periodik

	function laporanpayment(){
		
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$this->common_loader($data,'invoice/reporting/laporanpayment/laporanpayment');		
	}

	function dashboardintegrasi(){
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		//$data['header_contexts'] = $this->

		$proses = $this->input->post('prosesdsfds');	
		//$postdata = ($_POST);
		//echo $postdata;
		/* if(isset($proses)){
		 	echo "oke";
			$this->dashboard_integrasi->result_integrasi();

		 }else{
		 	echo "string";
		 }*/


		//echo"dsfdsf";
		$this->common_loader($data,'invoice/reporting/dashboardintegrasi/dashboardintegrasi');		
	}
	function searchdashboardintegrasi(){
		$start = $this->input->post('TGL_PERIODE_START');	
		$end =$this->input->post('TGL_PERIODE_END');
		$result = $this->dashboard_integrasi->result_integrasi($start,$end);
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$data['start_date'] = $start;
		$data['end_date'] = $end;
		$data['report_integrasi'] = $result;
		$this->common_loader($data,'invoice/reporting/dashboardintegrasi/dashboardintegrasi');	
	}
	function detaildashboardintegrasi(){
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);

		$start = $this->input->post('start_date');	
		$end =$this->input->post('end_date');
		$name =$this->input->post('name');

		$result = $this->dashboard_integrasi->detail_result_integrasi($start,$end, $name);
		//$data['detail_report_integrasi'] = $result;

		echo json_encode($result);
	}
	function detailtabledashboardintegrasi(){
		$result = $this->dashboard_integrasi->result_integrasi($start,$end);
		$role_id =  $this->session->userdata('role_id')	;
		$start = $this->input->post('start_date');	
		$end =$this->input->post('end_date');
		$context =$this->input->post('context');
		$type =$this->input->post('type');

		$result = $this->dashboard_integrasi->detail_table_result_integrasi($start, $end, $context, $type);

		echo json_encode($result);

	}
	function exportexceltabledashboardintegrasi(){
		date_default_timezone_set('Asia/Bangkok');
        $this->load->library('PHPExcel');
        $user['datauser'] = $this->session->userdata('unit_org');
        $user2['datauser2'] = $this->session->userdata('entity_code');


		$start = $this->input->get('start');	
		$end =$this->input->get('end');
		$context =$this->input->get('context');
		$type =$this->input->get('type');

		$result_table = $this->dashboard_integrasi->detail_table_result_integrasi($start, $end, $context, $type);

        
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        //$cacheSettings = array( 'memoryCacheSize' => '7024MB');
        $cacheSettings = array( 'memoryCacheSize' => -1);
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $objPHPExcel = new PHPExcel();

            if($_GET['TGL_PELUNASAN_START'] == ""){
                $tanggal_lunas='ALL';
            }else{
                $tanggal_lunas=$_GET['TGL_PELUNASAN_START']. " s/d " .$_GET['TGL_PELUNASAN_END'];   
                }

        //Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)')
                    ->setCellValue('C3', 'Laporan Dashboard Integrasi')
                    ->setCellValue('C5','Jenis : '.$context)
                    ->setCellValue('C6','Tipe : '.$type)
                    ->setCellValue('C7','Periode : '.$start.' s.d '.$end)
                    ->setCellValue('A10', 'No')
                    ->setCellValue('B10', 'No Nota')
                    ->setCellValue('C10', 'Tanggal Nota')
                    ->setCellValue('D10', 'Customer')
                    ->setCellValue('E10', 'Layanan')
                    ->setCellValue('F10', 'Jenis Nota')
                    ->setCellValue('G10', 'Nilai Nota')
                    ->setCellValue('H10', 'Error Message');

        $row = 11; 
        $num = 1;
        $jumlahpendapatan = 0;
        $jumlahppn = 0;
        $jumlahamount = 0;       

        foreach ($result_table as $data_header ) {
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(100);

            /*echo $data_header->TRX_NUMBER; die();*/
            $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $data_header->TRX_NUMBER);
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $row, $data_header->TGL_LAYANAN);
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $data_header->CUSTOMER_NAME);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $data_header->INV_NOTA_LAYANAN);
            $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $data_header->INV_NOTA_JENIS);
            $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $data_header->NILAI_NOTA);
            $objPHPExcel->getActiveSheet()->setCellValue('H'. $row, $data_header->ERROR_MESSAGE);
            $row++;
            $num++;
        }


        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getNumberFormat()->setFormatCode('dd/mm/yyyy');

            //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A10:H10')->getFill()
                                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                        ->getStartColor()->setARGB('EBE9E9');

        $objPHPExcel->getActiveSheet()->getStyle('D6')        // Format as date and time
                                        ->getNumberFormat()   
                                        ->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

        $styleArray2 = array(
            'font'  => array(
                'name'  => 'Arial'
            ));

        $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '0F0F0F'),
                                    ),
                                ),
                            );
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($styleArray2);
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A10:N10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setSize(12);
        //$objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
        /*$objPHPExcel->setPreCalculateFormulas(true);*/
        $objPHPExcel->getActiveSheet()->getStyle('A10:H10')->applyFromArray($styleArray);
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        /*echo APP_ROOT.'uploads/entity/WWF_test2323-1521791339.png';die();*/
        $logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;
        /*print_r($logo);die();*/
        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];
        /*print_r($ext1);die();*/
        /*print_r($ext);die();*/

        if (preg_match('/jpg|jpeg/i',$ext1)){
            $imageTmp2=imagecreatefromjpeg($logo);
        }
        else if (preg_match('/png/i',$ext1)){
            $imageTmp2=imagecreatefrompng($logo);
        }
        else if (preg_match('/gif/i',$ext1)){
            $imageTmp2=imagecreatefromgif($logo);
        }
        else if (preg_match('/bmp/i',$ext1)){
            $imageTmp2=imagecreatefrombmp($logo);
        } 

        
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($imageTmp2);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setOffsetX(5); 
        $objDrawing->setOffsetY(5);
        $objDrawing->setHeight(75);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
            //Nama File
            header('Content-Disposition: attachment;filename="Laporan Periodik.xlsx"');
 
            //Download
            $objWriter->save("php://output");
	}


	function pengirimannota(){
	
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);	
		$this->common_loader($data,'invoice/reporting/pengirimannota/pengirimannota');		
	}

	function ematerai(){
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$this->common_loader($data,'invoice/reporting/ematerai/ematerai');		
	}

	function paymenthistory(){
		$postdata = ($_POST);
		$postdata['ACTIVITY'] = "PAYMENT"; 

		$dataArray = $this->senddataurl('lognota/search2/',$postdata,'POST');
		/*print_r($dataArray);die();*/
		/*echo json_encode($data);*/

		$data = array(
			'data'=>array()
		);

		$num = 1;
		foreach($dataArray as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
			$data['data'][$key]['AMOUNT_RECEIPT'] = (strpos($data['data'][$key]['AMOUNT_RECEIPT'],",")=='')?number_format($data['data'][$key]['AMOUNT_RECEIPT'],0,',',','):$data['data'][$key]['AMOUNT_RECEIPT'];
			if($data['data'][$key]['STATUS_TRANSFER'] == "S"){
				$data['data'][$key]['STATUS_TRANSFER'] = "TRANSFER";
			}else if($data['data'][$key]['STATUS_TRANSFER'] == "F"){
				$data['data'][$key]['STATUS_TRANSFER'] = "FAILED";
			}else {
				$data['data'][$key]['STATUS_TRANSFER'] = "BELUM TRANSFER";
			}
			/*$data['data'][$key]['action'] = '<td><button type="button" id="INV_NOTA_CODE3" name="INV_NOTA_CODE3" onclick="editnota(\''.$data['data'][$key]['INV_NOTA_ID'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="update_entity"><i class="fa fa-pencil-square"></i></button></td';*/
			$num++;
		}

		echo json_encode($data);

	}
	//Function Cetak PDF LaporanPeriodik
	public function cetak_laporanperiodik(){
		$this->load->helper('pdf_helper');
		tcpdf();

		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		/*print_r($user);die();*/
		//$user2['datauser2'] = $this->session->userdata('entity_code');
		$dataheader 	= $this->senddataurl('periodik/search1/',$_GET,'POST');
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	= $this->senddataurl('Entity/dataperiodik/',$user2,'POST');
        /*print_r($dataheader3);die();*/
				//ambil data dari trx_header
		/*print_r($user2);die();*/
		//$kapal = $_POST

		$no_nota = $this->input->get('no_nota');	
		$tanggal_nota = $this->input->get('tanggal_nota');	
		$customer = $this->input->get('customer');	
		$currency = $this->input->get('currency');	
		$layanan = $this->input->get('layanan');	
		$jenis_nota = $this->input->get('jenis_nota');
		$no_pajak = $this->input->get('no_pajak');	
		$status_transfer = $this->input->get('status_transfer');	
		$status_lunas = $this->input->get('status_lunas');	
		$tanggal_pelunasan = $this->input->get('tanggal_lunas');	
		$bank = $this->input->get('bank');	
		$pendapatan = $this->input->get('pendapatan');	
		$ppn = $this->input->get('ppn');
		$total=$this->input->get('total');


		$columns = array (
		  0 => 
		  array (
		   	'status' => $no_nota,
		    'name' => 'No Nota',
		    'header_db_name' => 'TRX_NUMBER',
		    'width'=>'12%'
		  ),
		  1 => 
		  array (
			'status' => $tanggal_nota,
		    'name' => 'Tanggal Nota',
		    'header_db_name' => 'TRX_DATE',
		    'width'=>'6%'
		  ),
		  2 => 
		  array (
		   	'status' => $customer,
		    'name' => 'Customer',
		    'header_db_name' => 'CUSTOMER_NAME',
		    'width'=>'8%'

		  ),
		  3 => 
		  array (
		   	'status' => $currency,
		    'name' => 'Curr',
		    'header_db_name' => 'CURRENCY_CODE',
		    'width'=>'3%'

		  ),
		  4 => 
		  array (
			'status' => $layanan,
		    'name' => 'Layanan',
		    'header_db_name' => 'INV_NOTA_LAYANAN',
		    'width'=>'6%'
		  ),
		  5 => 
		  array (
		   	'status' => $jenis_nota,
		    'name' => 'Jenis Nota',
		    'header_db_name' => 'INV_NOTA_JENIS',
		    'width'=>'8%'

		  ),
		  6 => 
		  array (
		   	'status' => $no_pajak,
		    'name' => 'No Pajak',
		    'header_db_name' => 'CUSTOMER_NPWP',
		    'width'=>'12%'

		  ),
		  7 => 
		  array (
			'status' => $status_transfer,
		    'name' => 'Status Transfer',
		    'header_db_name' => 'AR_STATUS',
		    'width'=>'5%'

		  ),
		  8 => 
		  array (
		   	'status' => $status_lunas,
		    'name' => 'Status Lunas',
		    'header_db_name' => 'STATUS_LUNAS',
		    'width'=>'6%'

		  ),
		  9 => 
		  array (
		   	'status' => $tanggal_pelunasan,
		    'name' => 'Tanggal Lunas',
		    'header_db_name' => 'TGL_PELUNASAN',
		    'width'=>'6%'

		  ),
		  10 => 
		  array (
			'status' => $bank,
		    'name' => 'Bank',
		    'header_db_name' => 'RECEIPT_ACCOUNT',
		    'width'=>'6%'

		  ),
		  11 => 
		  array (
		   	'status' => $pendapatan,
		    'name' => 'Pendapatan',
		    'header_db_name' => 'AMOUNT_DASAR_PENGHASILAN',
		    'width'=>'8%'

		  ),
		  12 => 
		  array (
		   	'status' => $ppn,
		    'name' => 'PPN 10%',
		    'header_db_name' => 'PPN_10PERSEN',
		    'width'=>'8%'

		  ),
		  13 => 
		  array (
			'status' => $total,
		    'name' => 'Total',
		    'header_db_name' => 'AMOUNT',
		    'width'=>'8%'

		  )
		); 

		$judul = 'LAPORAN PERIODIK';
		$title = "LAPORAN PERIODIK";
		

		$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(true);
		$pdf->SetHeaderMargin(5);
		$pdf->SetTopMargin(2);
		$pdf->SetFooterMargin(5);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', 
       PDF_HEADER_STRING);
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-15);
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 8);
		
			if($_GET['TGL_PELUNASAN_START'] == ""){
				$periode1='ALL';
				}else{
				$periode1=$_GET['TGL_PELUNASAN_START']. " s/d " .$_GET['TGL_PELUNASAN_END'];	
			}

			if($dataheader[0]->STATUS_LUNAS == ""){
				$lunas= 'BELUM LUNAS';
			}else if($dataheader[0]->STATUS_LUNAS == "Y"){
				$lunas= 'LUNAS';
			}else if($dataheader[0]->STATUS_LUNAS == "XY"){
				$lunas= 'KOREKSI';
			}

			

		$logoipc 	= '<img width= "100" height= "100" src="'.UPLOADFOLDER_. 'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO.'">';


		$tbl_logo	='<table>
						<tr>
						<br>
						<br>
							<td height="20%" width="10%" style="vertical-alignment:"bottom" "margin-top:10%""><img src="'.$logoipc.'" height="60" width="100"></td>
							<td >PT. Pelabuhan Indonesia II (Persero)<br>'.$dataheader3[0]->INV_UNIT_NAME.' <br> <br><b>LAPORAN PERIODIK <br></b><b>PERIODE : '.$periode1.'</b></td>
							<td></td>
						</tr>
					  </table>';
		$pdf->writeHtml($tbl_logo, true, false, false, false, '');
		$k = 0;

		$result_header = array();
		$result_header_width = array();		
		$count = 0;


		$headerTable =	'<table border = "1" style="table-layout:fixed;word-wrap:break-word;">
							<tr>
								<th align="center" width="3%"><b>No</b></th>';


		foreach ($columns as $key => $value) {
		 	if($value['status'] == 'true'){


		 		$result_header[] =$value['header_db_name'];
		 		$result_header_width[] =$value['width'];
		 		$headerTable .='<th align="center" ><b>'.$value['name'].'</b></th>';
		 		
		 		$count++;
		 	}

            if($value['header_db_name'] == 'PPN_10PERSEN') {
                $ppnTrue = $value['status'];
            }
            if($value['header_db_name'] == 'AMOUNT') {
                $totalTrue = $value['status'];
            }

		}
        $countTrue = $count;
		$headerTable .='</tr>';
		
		//echo $headerTable;
		$tbl_header = $headerTable;
		for ($i=0; $i < count($dataheader); $i++) {
			if($dataheader[$i]->AR_STATUS == "S"){
				$ar = 'TRANSFER';
			}else if($dataheader[$i]->AR_STATUS == "F"){
				$ar = 'FAILED';
			}else{
				$ar = 'BELUM TRANSFER';
			}
			$dasarpenghasilan += intval($dataheader[$i]->AMOUNT_DASAR_PENGHASILAN);
			$dasarppn	+= intval($dataheader[$i]->PPN_10PERSEN);
			$hasilakhir += intval($dataheader[$i]->AMOUNT);
			$dasar = number_format($dataheader[$i]->AMOUNT_DASAR_PENGHASILAN,0,',',',');
			$ppn = number_format($dataheader[$i]->PPN_10PERSEN,0,',',',');
			$total = number_format($dataheader[$i]->AMOUNTS,0,',',',');
			$tbl_header .=	'<tr>';
			$tbl_header .=	'<td align="center">'.($i+1).'</td>';

			foreach ($result_header as $key =>  $data_header_name) {


					//$tbl_header .=	'<td align="center">'.$dataheader[$i]->$data_header_name.'</td>';
					if($data_header_name=='AMOUNT_DASAR_PENGHASILAN' || $data_header_name=='PPN_10PERSEN' || $data_header_name=='AMOUNT'){
						$tbl_header .=	'<td align="right">'.number_format($dataheader[$i]->$data_header_name,0,',',',').'</td>';
					}else{
						$tbl_header .=	'<td align="center">'.$dataheader[$i]->$data_header_name.'</td>';
					}
			}

			$tbl_header .=	'</tr>';
			if($i==11){
				$k = $i;
				$tbl_header = /*$headerTable .*/ $tbl_header.'</table>';
				/*$pdf->writeHtml($tbl_logo, true, false, false, false, '');*/
				$pdf->writeHtml($tbl_header, true, false, false, false, '');
				/*$pdf->writeHtml($footer, true, false, false, false, '');*/
				$pdf->SetTopMargin(18);
				$pdf->AddPage();
				$tbl_header = $headerTable;
			}else if($i>11 && ($i+1) < count($dataheader)){
				if($i==($k+12)){
					$tbl_header .= '</table>';
					$pdf->writeHtml($tbl_header, true, false, false, false, '');
				/*	$pdf->writeHtml($footer, true, false, false, false, '');*/
					// $pdf->SetTopMargin(5);
					$pdf->SetTopMargin(18);
					$pdf->AddPage();
					$k = $i;
					$tbl_header = $headerTable;
				}
			}

            if(($i+1) == count($dataheader)){
                $colspan = $countTrue;
                if($totalTrue == 'true') {
                    $colspan = $countTrue - 1;
                    $totalTrueTd .= '<td COLSPAN="1" align="right"><b>'.number_format($hasilakhir).'</b></td>';
                }
                if($ppnTrue == 'true'){
                    $colspan = $countTrue - 1;
                    $ppnTrueTd .= '<td COLSPAN="1" align="right"><b>'.number_format($dasarppn).'</b></td>';
                }
                if($totalTrue == 'true' && $ppnTrue == 'true') {
                    $colspan = $countTrue - 2;
                }
                $footer .= '<tr>
			                <td COLSPAN="'.$colspan.'" align="center"><b>Jumlah</b></td>
			                <td COLSPAN="1" align="right"><b>'.number_format($dasarpenghasilan).'</b></td>';
                    $footer .= $ppnTrueTd;
                    $footer .= $totalTrueTd;
			    $footer .= '</tr>
			    	</table>';
                $tbl_header .= $footer.'</table>';
                $pdf->writeHtml($tbl_header, true, false, false, false, '');
            }

		}
		
		$output_name = "LAPORAN_PERIODIK.pdf";
		
		
		
		// $pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->Output($output_name, 'I');	
	}

    //START 01/11/2019 Penambahan Reporting Function Cetak PDF LaporanharianPeriodik
    public function cetak_laporanharianperiodik(){
        $this->load->helper('pdf_helper');
        tcpdf();

        $user['datauser']   = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $dataheader 	    = $this->senddataurl('periodik/search1/',$_GET,'POST');
        $dataheader3 	    = $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');

        $no_nota            = $this->input->get('NO_NOTA');
        $currency           = $this->input->get('CURRENCY');
        $layanan            = $this->input->get('LAYANAN');
        $jenis_nota         = $this->input->get('JENIS_NOTA');
        $pendapatan         = $this->input->get('PENDAPATAN');
        $ppn                = $this->input->get('PPN');
        $total              = $this->input->get('TOTAL');
        $status_transfer    = $this->input->get('STATUS_TRANSFER');
        $tgl_transfer       = $this->input->get('TGL_TRANSFER');
        $customer_nm        = $this->input->get('CUSTOMER_NM');
        $tgl_lunas          = $this->input->get('TANGGAL_LUNAS');
        $bank               = $this->input->get('BANK');
        $sts_lunas          = $this->input->get('STS_LUNAS');

        $columns = array (
            0 =>
                array (
                    'status' => $no_nota,
                    'name' => 'No Nota',
                    'header_db_name' => 'TRX_NUMBER',
                    'width'=>'12%'
                ),
            1 =>
                array (
                    'status' => $tgl_transfer,
                    'name' => 'Tanggal Nota',
                    'header_db_name' => 'TRX_DATE',
                    'width'=>'6%'
                ),
            2 =>
                array (
                    'status' => $customer_nm,
                    'name' => 'Customer',
                    'header_db_name' => 'CUSTOMER_NAME',
                    'width'=>'8%'
                ),
            3 =>
                array (
                    'status' => $currency,
                    'name' => 'Curr',
                    'header_db_name' => 'CURRENCY_CODE',
                    'width'=>'3%'

                ),
            4 =>
                array (
                    'status' => $layanan,
                    'name' => 'Layanan',
                    'header_db_name' => 'INV_NOTA_LAYANAN',
                    'width'=>'6%'
                ),
            5 =>
                array (
                    'status' => $jenis_nota,
                    'name' => 'Jenis Nota',
                    'header_db_name' => 'INV_NOTA_JENIS',
                    'width'=>'8%'
                ),
            6 =>
                array (
                    'status' => $status_transfer,
                    'name' => 'Status Transfer',
                    'header_db_name' => 'AR_STATUS',
                    'width'=>'5%'
                ),
            7 =>
                array (
                    'status' => $sts_lunas,
                    'name' => 'Status Lunas',
                    'header_db_name' => 'STATUS_LUNAS',
                    'width'=>'6%'
                ),
            8 =>
                array (
                    'status' => $tgl_lunas,
                    'name' => 'Tanggal Lunas',
                    'header_db_name' => 'TGL_PELUNASAN',
                    'width'=>'6%'
                ),
            9 =>
                array (
                    'status' => $bank,
                    'name' => 'Bank',
                    'header_db_name' => 'RECEIPT_ACCOUNT',
                    'width'=>'6%'
                ),
            10 =>
                array (
                    'status' => $pendapatan,
                    'name' => 'Pendapatan',
                    'header_db_name' => 'AMOUNT_DASAR_PENGHASILAN',
                    'width'=>'8%'
                ),
            11 =>
                array (
                    'status' => $ppn,
                    'name' => 'PPN 10%',
                    'header_db_name' => 'PPN_10PERSEN',
                    'width'=>'8%'
                ),
            12 =>
                array (
                    'status' => $total,
                    'name' => 'Total',
                    'header_db_name' => 'AMOUNT',
                    'width'=>'8%'
                )
        );

        $judul = 'LAPORAN PERIODIK';
        $title = "LAPORAN PERIODIK";

        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle($title);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(true);
        $pdf->SetHeaderMargin(5);
        $pdf->SetTopMargin(2);
        $pdf->SetFooterMargin(5);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011',PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-15);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 8);
        $periode1  = date('d F Y', strtotime($_GET['TGL_PELUNASAN_START']));

        if($dataheader[0]->STATUS_LUNAS == ""){
            $lunas = 'BELUM LUNAS';
        }else if($dataheader[0]->STATUS_LUNAS == "Y"){
            $lunas = 'LUNAS';
        }else if($dataheader[0]->STATUS_LUNAS == "XY"){
            $lunas = 'KOREKSI';
        }

        $logoipc 	= '<img width= "100" height= "100" src="'.UPLOADFOLDER_. 'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO.'">';
        $tbl_logo	='<table>
						<tr><br><br>
							<td height="20%" width="10%" style="vertical-alignment:"bottom" "margin-top:10%""><img src="'.$logoipc.'" height="60" width="100"></td>
							<td >PT. Pelabuhan Indonesia II (Persero)<br>'.$dataheader3[0]->INV_UNIT_NAME.' <br> <br><b>LAPORAN HARIAN PERIODIK <br></b><b>PERIODE : '.$periode1.'</b></td>
							<td></td>
						</tr>
					  </table>';
        $pdf->writeHtml($tbl_logo, true, false, false, false, '');
        $k = 0;

        $result_header = array();
        $result_header_width = array();
        $count = 0;

        $headerTable ='<table border = "1" style="table-layout:fixed;word-wrap:break-word;">
            <tr>
                <th align="center" width="3%"><b>No</b></th>';
                    foreach ($columns as $key => $value) {
                        if($value['status'] == 'true'){
                            $result_header[]       = $value['header_db_name'];
                            $result_header_width[] = $value['width'];
                            $headerTable           .='<th align="center" ><b>'.$value['name'].'</b></th>';
                            $count++;
                        }
                            if($value['header_db_name'] == 'PPN_10PERSEN') {
                                $ppnTrue = $value['status'];
                            }
                    }

        $countTrue = $count;
        $headerTable .='</tr>';

        $tbl_header = $headerTable;
        for ($i=0; $i < count($dataheader); $i++) {
            if($dataheader[$i]->AR_STATUS == "S"){
                $ar = 'TRANSFER';
            }else if($dataheader[$i]->AR_STATUS == "F"){
                $ar = 'FAILED';
            }else{
                $ar = 'BELUM TRANSFER';
            }

            if($dataheader[$i]->STATUS_LUNAS == "Y"){
                $sl = 'LUNAS';
            }else{
                $sl = 'BELUM LUNAS';
            }

            $dasarpenghasilan += intval($dataheader[$i]->AMOUNT_DASAR_PENGHASILAN);
            $dasarppn	      += intval($dataheader[$i]->PPN_10PERSEN);
            $hasilakhir       += intval($dataheader[$i]->AMOUNT);
            $dasar            = number_format($dataheader[$i]->AMOUNT_DASAR_PENGHASILAN,0,',',',');
            $ppn              = number_format($dataheader[$i]->PPN_10PERSEN,0,',',',');
            $total            = number_format($dataheader[$i]->AMOUNTS,0,',',',');
            $tbl_header      .=	'<tr>';
            $tbl_header      .=	'<td align="center">'.($i+1).'</td>';

            foreach ($result_header as $key =>  $data_header_name) {
                if($data_header_name=='AMOUNT_DASAR_PENGHASILAN' || $data_header_name=='PPN_10PERSEN' || $data_header_name=='AMOUNT') {
                    $tbl_header .= '<td align="right">' . number_format($dataheader[$i]->$data_header_name, 0, ',', ',') . '</td>';
                }else if($data_header_name=='AR_STATUS'){
                    $tbl_header .=	'<td align="center">'.$ar.'</td>';
                }else if($data_header_name=='STATUS_LUNAS'){
                    $tbl_header .=	'<td align="center">'.$sl.'</td>';
                }else{
                    $tbl_header .=	'<td align="center">'.$dataheader[$i]->$data_header_name.'</td>';
                }
            }

            $tbl_header .=	'</tr>';
            if($i==11){
                $k = $i;
                $tbl_header = /*$headerTable .*/ $tbl_header.'</table>';
                $pdf->writeHtml($tbl_header, true, false, false, false, '');
                $pdf->SetTopMargin(18);
                $pdf->AddPage();
                $tbl_header = $headerTable;
            }else if($i>11 && ($i+1) < count($dataheader)){
                if($i==($k+12)){
                   //$tbl_header .= '</table>';
                    $pdf->writeHtml($tbl_header, true, false, false, false, '');
                    $pdf->SetTopMargin(18);
                    $pdf->AddPage();
                    $k = $i;
                    $tbl_header = $headerTable;
                }
            }

            if(($i+1) == count($dataheader)){
                $colspan = $countTrue - 1;
                if($ppnTrue == 'true'){
                    $colspan = $countTrue - 2;
                    $ppnTrueTd .= '<td COLSPAN="1" align="right"><b>'.number_format($dasarppn).'</b></td>';
                }
                $footer .= '<tr>
			                <td COLSPAN="'.$colspan.'" align="center"><b>Jumlah</b></td>
			                <td COLSPAN="1" align="right"><b>'.number_format($dasarpenghasilan).'</b></td>';
                $footer .= $ppnTrueTd;
                $footer .= '<td COLSPAN="1" align="right"><b>'.number_format($hasilakhir).'</b></td>';
                $footer .= '</tr>
			    	</table>';
                $tbl_header .= $footer.'</table>';
                $pdf->writeHtml($tbl_header, true, false, false, false, '');
            }
        }
        $output_name = "LAPORAN_PERIODIK.pdf";
        $pdf->Output($output_name, 'I');
    }
    //STOP 01/11/2019 Penambahan Reporting Function Cetak PDF LaporanharianPeriodik

    //START 01/11/2019 Penambahan Reporting Function Cetak EXCLE LaporanharianPeriodik
    public function cetak_laporanharianperiodik_excel(){
        date_default_timezone_set('Asia/Bangkok');
        $this->load->library('PHPExcel');
        $user['datauser']   = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit']   = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        //$user2['datauser2'] = $this->session->userdata('entity_code');

        $no_nota            = $this->input->get('NO_NOTA');
        $currency           = $this->input->get('CURRENCY');
        $layanan            = $this->input->get('LAYANAN');
        $jenis_nota         = $this->input->get('JENIS_NOTA');
        $pendapatan         = $this->input->get('PENDAPATAN');
        $ppn                = $this->input->get('PPN');
        $total              = $this->input->get('TOTAL');
        $status_transfer    = $this->input->get('STATUS_TRANSFER');
        $tgl_transfer       = $this->input->get('TGL_TRANSFER');
        $customer_nm        = $this->input->get('CUSTOMER_NM');
        $tgl_lunas          = $this->input->get('TANGGAL_LUNAS');
        $bank               = $this->input->get('BANK');
        $sts_lunas          = $this->input->get('STS_LUNAS');

        $dataheader 	    = $this->senddataurl('periodik/search1/',$_GET,'POST');
        $dataheader3 	    = $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');

        $cacheMethod        = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        //$cacheSettings = array( 'memoryCacheSize' => '7024MB');
        $cacheSettings      = array( 'memoryCacheSize' => -1);
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        $objPHPExcel        = new PHPExcel();
        $tanggal_lunas      = date('d F Y', strtotime($_GET['TGL_PELUNASAN_START']));

        $columns = array (
            0 =>
                array (
                    'status' => $no_nota,
                    'name' => 'No Nota',
                    'header_db_name' => 'TRX_NUMBER',
                    'width'=>'20%'
                ),
            1 =>
                array (
                    'status' => $tgl_transfer,
                    'name' => 'Tanggal Nota',
                    'header_db_name' => 'TRX_DATE',
                    'width'=>'20%'
                ),
            2 =>
                array (
                    'status' => $customer_nm,
                    'name' => 'Customer',
                    'header_db_name' => 'CUSTOMER_NAME',
                    'width'=>'20%'
                ),
            3 =>
                array (
                    'status' => $currency,
                    'name' => 'Curr',
                    'header_db_name' => 'CURRENCY_CODE',
                    'width'=>'20%'
                ),
            4 =>
                array (
                    'status' => $layanan,
                    'name' => 'Layanan',
                    'header_db_name' => 'INV_NOTA_LAYANAN',
                    'width'=>'20%'
                ),
            5 =>
                array (
                    'status' => $jenis_nota,
                    'name' => 'Jenis Nota',
                    'header_db_name' => 'INV_NOTA_JENIS',
                    'width'=>'20%'
                ),
            6 =>
                array (
                    'status' => $status_transfer,
                    'name' => 'Status Transfer',
                    'header_db_name' => 'AR_STATUS',
                    'width'=>'20%'
                ),
            7 =>
                array (
                    'status' => $sts_lunas,
                    'name' => 'Status Lunas',
                    'header_db_name' => 'STATUS_LUNAS',
                    'width'=>'20%'
                ),
            8 =>
                array (
                    'status' => $tgl_lunas,
                    'name' => 'Tanggal Lunas',
                    'header_db_name' => 'TGL_PELUNASAN',
                    'width'=>'20%'
                ),
            9 =>
                array (
                    'status' => $bank,
                    'name' => 'Bank',
                    'header_db_name' => 'RECEIPT_ACCOUNT',
                    'width'=>'20%'
                ),
            10 =>
                array (
                    'status' => $pendapatan,
                    'name' => 'Pendapatan',
                    'header_db_name' => 'AMOUNT_DASAR_PENGHASILAN',
                    'width'=>'20%'
                ),
            11 =>
                array (
                    'status' => $ppn,
                    'name' => 'PPN 10%',
                    'header_db_name' => 'PPN_10PERSEN',
                    'width'=>'20%'
                ),
            12 =>
                array (
                    'status' => $total,
                    'name' => 'Total',
                    'header_db_name' => 'AMOUNT',
                    'width'=>'20%'
                )
        );

        $alphabet   = array('B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $count      = 0;
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', $dataheader3[0]->INV_UNIT_NAME);
        $objPHPExcel->getActiveSheet()->setCellValue('C5','Laporan Harian Periodik');
        $objPHPExcel->getActiveSheet()->setCellValue('C6','PERIODE : '.$tanggal_lunas);

        $result_alpha        = array();
        $result_header       = array();
        $result_header_width = array();

        $objPHPExcel->getActiveSheet()->setCellValue('A8', 'No');
        foreach ($columns as $key => $value) {
            if($value['status'] == 'true'){
                $objPHPExcel->getActiveSheet()->setCellValue($alphabet[$count].'8', $value['name']);
                $result_alpha[]  = $alphabet[$count];
                $result_header[] = $value['header_db_name'];
                $result_header_width[] = $value['width'];
                $count++;
            }
        }

        $row = 9;
        $num = 1;
        $jumlahpendapatan = 0;
        $jumlahppn = 0;
        $jumlahamount = 0;

        $abjd=array();
        $countabjd=0;

        $strpendapatan="";
        $strppn="";
        $strtotal="";
        foreach ($dataheader as $data_header ) {
            foreach ($result_alpha as $key =>  $data_abjd) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($data_abjd)->setAutoSize(true);
                if($result_header[$key]=='AMOUNT_DASAR_PENGHASILAN'){
                    $strpendapatan = $data_abjd;
                }
                if($result_header[$key]=='PPN_10PERSEN'){
                    $strppn = $data_abjd;
                }
                if($result_header[$key]=='AMOUNT'){
                    $strtotal = $data_abjd;
                }

                $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, $data_header->$result_header[$key]);
                if($result_header[$key]=='AR_STATUS'){
                    if($data_header->AR_STATUS == "S"){
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "TRANSFER");
                    }else if($data_header->AR_STATUS == "F"){
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "FAILED");
                    }else {
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "BELUM TRANFER");
                    }
                }

                if($result_header[$key]=='STATUS_LUNAS'){
                    if($data_header->STATUS_LUNAS == "Y"){
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "Lunas");
                    }else{
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "Belum Lunas");
                    }
                }
                $countabjd++;
            }
            $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
            $jumlahpendapatan += intval($data_header->AMOUNT_DASAR_PENGHASILAN);
            $jumlahppn += intval($data_header->PPN_10PERSEN);
            $jumlahamount += intval($data_header->AMOUNT);
            $row++;
            $num++;
        }


        $lastabjd = end($result_alpha);

        if($strpendapatan){
            $objPHPExcel->getActiveSheet()->setCellValue($strpendapatan. $row, $jumlahpendapatan);
        }
        if($strppn){
            $objPHPExcel->getActiveSheet()->setCellValue($strppn. $row, $jumlahppn);
        }
        if($strtotal){
            $objPHPExcel->getActiveSheet()->setCellValue($strtotal. $row, $jumlahamount);

        }
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, "Jumlah");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($strpendapatan. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($strppn. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($strtotal. $row)->getFont()->setBold(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$lastabjd.$row)->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('EBE9E9');
        //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A8:'.$lastabjd.'8')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('EBE9E9');

        $objPHPExcel->getActiveSheet()->getStyle('D6')        // Format as date and time
        ->getNumberFormat()
            ->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

        $styleArray2 = array(
            'font'  => array(
                'name'  => 'Arial'
            ));

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '0F0F0F'),
                ),
            ),
        );
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($styleArray2);
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A8:'.$lastabjd.'8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle('A8:'.$lastabjd.'8')->applyFromArray($styleArray);
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;

        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];

        if (preg_match('/jpg|jpeg/i',$ext1)){
            $imageTmp2=imagecreatefromjpeg($logo);
        }
        else if (preg_match('/png/i',$ext1)){
            $imageTmp2=imagecreatefrompng($logo);
        }
        else if (preg_match('/gif/i',$ext1)){
            $imageTmp2=imagecreatefromgif($logo);
        }
        else if (preg_match('/bmp/i',$ext1)){
            $imageTmp2=imagecreatefrombmp($logo);
        }

        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($imageTmp2);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setOffsetX(5);
        $objDrawing->setOffsetY(5);
        $objDrawing->setHeight(75);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //Nama File
        header('Content-Disposition: attachment;filename="Laporan Harian Periodik.xlsx"');

        //Download
        $objWriter->save("php://output");

    }
    //STOP 01/11/2019 Penambahan Reporting Function Cetak EXCLE LaporanharianPeriodik

	//function cetak laporan ematerai
	public function cetak_emateraidetail($bulan){
		$this->load->helper('pdf_helper');
		tcpdf();

		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		/*print_r($user);die();*/
		//$user2['datauser2'] = $this->session->userdata('entity_code');
		$postdata['BULAN'] = $bulan;
		/*print_r($postdata);*/
		$dataheader 	= $this->senddataurl('ematerai/ematerai2',$postdata,'POST');
		/*$dataheader 	= $this->senddataurl('ematerai/ematerai2/','POST');*/
		// print_r($dataheader);die();
        /*print_r($dataheader2);die();*/
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');
        /*print_r($dataheader3);die();*/
				//ambil data dari trx_header
		/*print_r($user2);die();*/
		//$kapal = $_POST

		$judul = 'LAPORAN E Materai';
		$title = "LAPORAN E Materai";
		

		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(true);
		$pdf->SetHeaderMargin(5);
		$pdf->SetTopMargin(2);
		$pdf->SetFooterMargin(5);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', 
       PDF_HEADER_STRING);
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-15);
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 8);
				

		$logoipc 	= '<img width= "100" height= "100" src="'.UPLOADFOLDER_. 'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO.'">';
		

		$tbl_logo	='<table>
						<tr>
						<br>
						<br>
							<td height="20%" width="10%" style="vertical-alignment:"bottom" "margin-top:10%""><img src="'.$logoipc.'" height="60" width="100"></td>
							<td >PT. Pelabuhan Indonesia II (Persero)<br>'.$dataheader3[0]->INV_UNIT_NAME.' <br> <br><b>LAPORAN PENGGUNAAN EMATERAI<br></b><b>PERIODE : '.$postdata['BULAN'].'</b></td>
							<td></td>
						</tr>
					  </table>';
					$pdf->writeHtml($tbl_logo, true, false, false, false, '');
		$k = 0;
							$headerTable =	'<table border = "1">
									<tr>
										<th align="center" width="3%"><b>No</b></th>
										<th align="center" width="12%"><b>Tanggal</b></th>
										<th align="center" width="15%"><b>Source</b></th>
										<th align="center" width="13%"><b>Jumlah Materai 3000</b></th>
										<th align="center" width="13%"><b>Jumlah Materai 6000</b></th>
										<th align="center" width="13%"><b>Nominal Materai 3000</b></th>
										<th align="center" width="13%"><b>Nominal Materai 6000</b></th>
										<th align="center" width="15%"><b>Jumlah Total</b></th>
									</tr>';
							// $num = 1;
									// print_r($dataheader);die();

							$tbl_header = $headerTable;
							for ($i=0; $i < count($dataheader); $i++) {								
								$countmaterai3000 += intval($dataheader[$i]->MATERAI_3000);
								$countmaterai6000	+= intval($dataheader[$i]->MATERAI_6000);
								$summaterai3000	+= intval($dataheader[$i]->MATERAI_3000_SUM);
								$summaterai6000	+= intval($dataheader[$i]->MATERAI_6000_SUM);
								$totalmaterai2	+= intval($dataheader[$i]->TOTAL_MATERAI);
								$hasilakhir += intval($dataheader[$i]->AMOUNTS);
								$tiga = number_format($dataheader[$i]->MATERAI_3000,0,',',',');
								$enam = number_format($dataheader[$i]->MATERAI_6000,0,',',',');
								$tigasum = number_format($dataheader[$i]->MATERAI_3000_SUM,0,',',',');
								$enamsum = number_format($dataheader[$i]->MATERAI_6000_SUM,0,',',',');
								$totalmaterai = number_format($dataheader[$i]->TOTAL_MATERAI,0,',',',');
								$tbl_header .=	'<tr>';
								$tbl_header .=	'<td align="center">'.($i+1).'</td>';
								$tbl_header .=	'<td>&nbsp;'.$dataheader[$i]->TANGGAL.'</td>';
								$tbl_header .=	'<td align="left">&nbsp;'.$dataheader[$i]->SOURCE_SYSTEM.'</td>';
								$tbl_header .=	'<td align="center">'.$tiga.'</td>';				
								$tbl_header .=	'<td align="center">'.$enam.'</td>';
								$tbl_header .=	'<td align="right">'.$tigasum.'</td>';
								$tbl_header .=	'<td align="right">'.$enamsum.'</td>';
								$tbl_header .=	'<td align="right">'.$totalmaterai.'</td>';
								$tbl_header .=	'</tr>';
								if($i==40){
									$k = $i;
									$tbl_header = /*$headerTable .*/ $tbl_header.'</table>';
									/*$pdf->writeHtml($tbl_logo, true, false, false, false, '');*/
									$pdf->writeHtml($tbl_header, true, false, false, false, '');
									/*$pdf->writeHtml($footer, true, false, false, false, '');*/
									$pdf->SetTopMargin(18);
									$pdf->AddPage();
									$tbl_header = $headerTable;
								}else if($i>40 && ($i+1) < count($dataheader)){
									if($i==($k+50)){
										$tbl_header .= '</table>';
										$pdf->writeHtml($tbl_header, true, false, false, false, '');
									/*	$pdf->writeHtml($footer, true, false, false, false, '');*/
										// $pdf->SetTopMargin(5);
										$pdf->SetTopMargin(18);
										$pdf->AddPage();
										$k = $i;
										$tbl_header = $headerTable;
									}
								}

								if(($i+1) == count($dataheader)){
								$footer = '
										<table border="1">
											<tr>
								                <td COLSPAN="2" align="center" width="30%"><b>Jumlah</b></td>
								                <td COLSPAN="2" align="center" width="13%"><b>'.number_format($countmaterai3000).'</b></td>
								                <td COLSPAN="2" align="center" width="13%"><b>'.number_format($countmaterai6000).'</b></td>
								                <td COLSPAN="2" align="right" width="13%"><b>'.number_format($summaterai3000).'</b></td>
								           		<td COLSPAN="1" align="right" width="13%"><b>'.number_format($summaterai6000).'</b></td>
								           		<td COLSPAN="1" align="right" width="15%"><b>'.number_format($totalmaterai2).'</b></td>
								    		</tr>
								    	</table>';
									$tbl_header .= $footer.'</table>';
									// echo $tbl_header;die();

										$pdf->writeHtml($tbl_header, true, false, false, false, '');
										/*$pdf->writeHtml($footer, true, false, false, false, '');*/


								}
							}
			
			

		$output_name = "Laporan Penggunaan Ematerai.pdf";
		
		
		
		// $pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->Output($output_name, 'I');	
	}

	//laporan ematerai excel
	public function laporan_ematerai_excel($bulan){
		$this->load->library('PHPExcel');
		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		/*print_r($user);die();*/
		//$user2['datauser2'] = $this->session->userdata('entity_code');
		$postdata['BULAN'] = $bulan;
		/*print_r($postdata);*/
		$dataheader 	= $this->senddataurl('ematerai/ematerai2',$postdata,'POST');
		/*$dataheader 	= $this->senddataurl('ematerai/ematerai2/','POST');*/
		// print_r($dataheader);die();
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');

		
		/*print_r($dataheader);die();*/

        $objPHPExcel = new PHPExcel();


        //Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex(0)
        			->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)')
        			->setCellValue('C3', $dataheader3[0]->INV_UNIT_NAME)
        			->setCellValue('C5','Laporan Penggunaan E-Materai')
        			->setCellValue('C6','PERIODE : '.$postdata['BULAN'])
                    ->setCellValue('A8', 'No')
                    ->setCellValue('B8', 'Tanggal')
                    ->setCellValue('C8', 'Source')
                    ->setCellValue('D8', 'Jumlah Materai 3000')
                    ->setCellValue('E8', 'Jumlah Materai 6000')
                    ->setCellValue('F8', 'Nominal Materai 3000')
                    ->setCellValue('G8', 'Nominal Materai 6000')
                    ->setCellValue('H8', 'Jumlah Total')
                    ->setCellValue('I8', '')
                    ->setCellValue('J8', '')
                    ->setCellValue('K8', '')
                    ->setCellValue('L8', '')
                    ->setCellValue('M8', '')
                    ->setCellValue('N8', '');

        $row = 9; 
        $num = 1;
        $jumlahpendapatan = 0;
        $jumlahppn = 0;
        $jumlahamount = 0;       

        foreach ($dataheader as $data_header ) {
        	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(21);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        	/*echo $data_header->TRX_NUMBER; die();*/
        	$objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $data_header->TANGGAL);
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $row, $data_header->SOURCE_SYSTEM);
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $data_header->MATERAI_3000);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $data_header->MATERAI_6000);
            $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $data_header->MATERAI_3000_SUM);
            $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $data_header->MATERAI_6000_SUM);
            $objPHPExcel->getActiveSheet()->setCellValue('H'. $row, $data_header->TOTAL_MATERAI);
            /*$objPHPExcel->setCellValue('L'. $row, $row_data['vclaimed']);*/
            $materai3000count += intval($data_header->MATERAI_3000);
            $materai6000count += intval($data_header->MATERAI_6000);
            $materai3000sum += intval($data_header->MATERAI_3000_SUM);
            $materai6000sum += intval($data_header->MATERAI_6000_SUM);  
            $totalmaterai += intval($data_header->TOTAL_MATERAI); 
            $row++;
            $num++;
        }

        $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $materai3000count);
        $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $materai6000count);
        $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $materai3000sum);
        $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $materai6000sum);
        $objPHPExcel->getActiveSheet()->setCellValue('H'. $row, $totalmaterai);
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, "Jumlah");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H'. $row)->getFont()->setBold(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.":H".$row)->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');
            //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A8:H8')->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');

		$objPHPExcel->getActiveSheet()->getStyle('D6')        // Format as date and time
                     					->getNumberFormat()   
                        				->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

		$styleArray2 = array(
		    'font'  => array(
		        'name'  => 'Arial'
		    ));

		$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '0F0F0F'),
									),
								),
							);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($styleArray2);
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A8:H8')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
		/*$objPHPExcel->setPreCalculateFormulas(true);*/
		$objPHPExcel->getActiveSheet()->getStyle('A8:H8')->applyFromArray($styleArray);
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		/*echo APP_ROOT.'uploads/entity/WWF_test2323-1521791339.png';die();*/
		$logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;
        /*print_r($logo);die();*/
        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];
        /*print_r($ext1);die();*/
        /*print_r($ext);die();*/

		if (preg_match('/jpg|jpeg/i',$ext1)){
			$imageTmp2=imagecreatefromjpeg($logo);
		}
		else if (preg_match('/png/i',$ext1)){
			$imageTmp2=imagecreatefrompng($logo);
		}
		else if (preg_match('/gif/i',$ext1)){
       		$imageTmp2=imagecreatefromgif($logo);
		}
    	else if (preg_match('/bmp/i',$ext1)){
        	$imageTmp2=imagecreatefrombmp($logo);
        } 

		
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($imageTmp2);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);
		$objDrawing->setHeight(75);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
 	    //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
            //Nama File
            header('Content-Disposition: attachment;filename="Laporan Pengunaan Ematerai.xlsx"');
 
            //Download
            $objWriter->save("php://output");

	}

	public function laporan_ematerai_excel_summary($bulan){
		$this->load->library('PHPExcel');
		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		/*print_r($user);die();*/
		//$user2['datauser2'] = $this->session->userdata('entity_code');
		$postdata['BULAN'] = $bulan;
		/*print_r($postdata);*/
		$dataheader 	= $this->senddataurl('ematerai/searchmateraisummary',$postdata,'POST');
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');
        $objPHPExcel    = new PHPExcel();

        //Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex(0)
        			->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)')
        			->setCellValue('C3', $dataheader3[0]->INV_UNIT_NAME)
        			->setCellValue('C5','Summary Penggunaan E-Materai')
        			->setCellValue('C6','BULAN : '.$postdata['BULAN'])
                    ->setCellValue('A8', 'No')
                    ->setCellValue('B8', 'Keterangan')
                    ->setCellValue('C8', 'Realisasi Pemakaian Bulan '.$postdata['BULAN'] )
                    ->setCellValue('D8', 'Estimasi Pemakaian Bulan '.$postdata['BULAN'])
                    ->setCellValue('E8', 'Saldo (Rp)')
                    ->setCellValue('F8', '')
                    ->setCellValue('G8', '')
                    ->setCellValue('H8', '')
                    ->setCellValue('I8', '')
                    ->setCellValue('J8', '')
                    ->setCellValue('K8', '')
                    ->setCellValue('L8', '')
                    ->setCellValue('M8', '')
                    ->setCellValue('N8', '');

        $row = 9; 
        $num = 1;
        $jumlahpendapatan = 0;
        $jumlahppn = 0;
        $jumlahamount = 0;       

        /*foreach ($dataheader as $data_header ) {*/
        	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(21);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
        	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        	/*echo $data_header->TRX_NUMBER; die();*/
        	$objPHPExcel->getActiveSheet()->setCellValue('A9',"1");
        	$objPHPExcel->getActiveSheet()->setCellValue('A10',"2");
        	$objPHPExcel->getActiveSheet()->setCellValue('A11',"3");
        	$objPHPExcel->getActiveSheet()->setCellValue('A12',"4");
            $objPHPExcel->getActiveSheet()->setCellValue('B9', "Saldo Bulan Lalu");
            $objPHPExcel->getActiveSheet()->setCellValue('B10', "Bea Materai Rp. 3.000,-");
            $objPHPExcel->getActiveSheet()->setCellValue('B11', "Bea Materai Rp. 6.000,-");
            $objPHPExcel->getActiveSheet()->setCellValue('B12', "Setoran Bea Materai");
            $objPHPExcel->getActiveSheet()->setCellValue('C10', $dataheader->MATERAI_3000_SUM);
            // print_r($dataheader);die();
            $objPHPExcel->getActiveSheet()->setCellValue('C11', $dataheader->MATERAI_6000_SUM);
            $objPHPExcel->getActiveSheet()->setCellValue('C13', $dataheader->TOTAL_MATERAI);
            $objPHPExcel->getActiveSheet()->setCellValue('B13', "JUMLAH");
           /* $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $data_header->MATERAI_3000);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $data_header->MATERAI_6000);
            $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $data_header->MATERAI_3000_SUM);
            $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $data_header->MATERAI_6000_SUM);
            $objPHPExcel->getActiveSheet()->setCellValue('H'. $row, $data_header->TOTAL_MATERAI);*/
            /*$objPHPExcel->setCellValue('L'. $row, $row_data['vclaimed']);*/
            /*$materai3000count += intval($data_header->MATERAI_3000);
            $materai6000count += intval($data_header->MATERAI_6000);
            $materai3000sum += intval($data_header->MATERAI_3000_SUM);
            $materai6000sum += intval($data_header->MATERAI_6000_SUM);  
            $totalmaterai += intval($data_header->TOTAL_MATERAI); */
            $row++;
            $num++;
            $row1 = $row + 2;
        /*}*/

        /*$objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $materai3000count);
        $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $materai6000count);
        $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $materai3000sum);
        $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $materai6000sum);
        $objPHPExcel->getActiveSheet()->setCellValue('H'. $row, $totalmaterai);*/
        /*$objPHPExcel->getActiveSheet()->setCellValue('B'. $row1, "Jumlah");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);*/
        /*$objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);*/
        /*$objPHPExcel->getActiveSheet()->getStyle('D'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E'. $row)->getFont()->setBold(true);*/
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        $objPHPExcel->getActiveSheet()->getStyle('A13:E13')->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');
            //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A8:E8')->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');

		$objPHPExcel->getActiveSheet()->getStyle('D6')        // Format as date and time
                     					->getNumberFormat()   
                        				->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

		$styleArray2 = array(
		    'font'  => array(
		        'name'  => 'Arial'
		    ));

		$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '0F0F0F'),
									),
								),
							);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
/*		$objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($styleArray2);*/
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A8:E8')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
		/*$objPHPExcel->setPreCalculateFormulas(true);*/
		$objPHPExcel->getActiveSheet()->getStyle('A8:E8')->applyFromArray($styleArray);
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		/*echo APP_ROOT.'uploads/entity/WWF_test2323-1521791339.png';die();*/
		$logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;
        /*print_r($logo);die();*/
        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];
        /*print_r($ext1);die();*/
        /*print_r($ext);die();*/

		if (preg_match('/jpg|jpeg/i',$ext1)){
			$imageTmp2=imagecreatefromjpeg($logo);
		}
		else if (preg_match('/png/i',$ext1)){
			$imageTmp2=imagecreatefrompng($logo);
		}
		else if (preg_match('/gif/i',$ext1)){
       		$imageTmp2=imagecreatefromgif($logo);
		}
    	else if (preg_match('/bmp/i',$ext1)){
        	$imageTmp2=imagecreatefrombmp($logo);
        } 

		
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($imageTmp2);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);
		$objDrawing->setHeight(75);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
 	    //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
            //Nama File
            header('Content-Disposition: attachment;filename="Laporan Pengunaan Ematerai Summary.xlsx"');
 
            //Download
            $objWriter->save("php://output");

	}

	//Function Cetak PDF PengirimanNota
    public function cetak_pengirimannotapdf(){
        $this->load->helper('pdf_helper');
        tcpdf();

        $user['datauser'] = $this->session->userdata('unit_org');
        /*print_r($user);die();*/
        //$user2['datauser2'] = $this->session->userdata('entity_code');
        /*print_r($user2);die();*/

        //$kapal = $_POST

        $dataheader 	= $this->senddataurl('Pengiriman/search/',$_GET,'POST');
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');
        //$data_header = $this->senddataurl('all/search/','POST');
        /*print_r($data_header); die();*/


        /*$nonota 	= $data_header->HEADER_CONTEXT;
        $jenis 		= $data_header->INV_NOTA_JENIS;
        $customer 	= $data_header->CUSTOMER_NAME;*/



        $judul = 'LAPORAN PENGIRIMAN NOTA';
        $title = "Report Pengiriman Nota";
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle($title);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetHeaderMargin(30);
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
        //$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
        //$query = $this->M_report->cetak_pdf();
        //$pdf->Cell(0,20, $judul, 0, 2, 'C', 0,FALSE);
        $pdf->SetFont('Arial', '', 8);

        if($_GET['CUSTOMER'] == ""){
            $cust='ALL';
        }else{
            $cust=$_GET['CUSTOMER'];
        }
        if($_GET['SEND_DATE_EMAIL_START'] == ""){
            $periodebaru='ALL';
        }else{
            $periodebaru=$_GET['SEND_DATE_EMAIL_START']. " s/d " .$_GET['SEND_DATE_EMAIL_END'];
        }
        $logoipc 	= '<img width= "100" height= "100" src="'.UPLOADFOLDER_. 'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO.'">';

        $tbl_logo	='<table>
						<tr>
						<br>
						<br>
							<td height="10%" width="12%" style="vertical-alignment:"bottom" "margin-top:10%""><img src="'.$logoipc.'" height="60" width="100"></td>
							<td width="110%">PT. Pelabuhan Indonesia II (Persero)<br>'.$dataheader3[0]->INV_UNIT_NAME.' <br> <br><b>LAPORAN PENGIRIMAN NOTA <br></b><b>PERIODE : '.$periodebaru.'</b><br><b>CUSTOMER : '.$cust.'</b></td>
							<td></td>
						</tr>
					  </table>';
        $pdf->writeHtml($tbl_logo, true, false, false, false, '');

        $headerTable =	'<table border = "1">
									<tr>
										<th align="center" width="5%"><b>No</b></th>
										<th align="center" width="16%"><b>No Nota</b></th>
										<th align="center" width="8%"><b>Tanggal Nota</b></th>
										<th align="center" width="10%"><b>Layanan</b></th>
										<th align="center" width="20%"><b>Jenis Nota</b></th>
										<th align="center" width="30%"><b>Customer</b></th>
										<th align="center" width="13%"><b>Jumlah Tagihan</b></th>
									</tr>';



        $tbl_header = $headerTable;
        for ($i=0; $i < count($dataheader); $i++) {
            $timenew = explode(" ",$dataheader[$i]->NOTA_DATE);
            $jumlah = number_format($dataheader[$i]->BESARAN,0,',',',');
            $jumlahakhir += $dataheader[$i]->BESARAN;
            $tbl_header .=	'<tr>';
            $tbl_header .=	'<td align="center">'.($i+1).'</td>';
            $tbl_header .=	'<td>'.$dataheader[$i]->NO_NOTA.'</td>';
            $tbl_header .=	'<td align="center">'.$timenew[0].'</td>';
            //$tbl_header .=	'<td align="center">'.$dataheader[$i]->CURRENCY.'</td>';
            $tbl_header .=	'<td align="left">&nbsp;'.$dataheader[$i]->INV_NOTA_LAYANAN.'</td>';
            $tbl_header .=	'<td align="left">&nbsp;'.$dataheader[$i]->INV_NOTA_JENIS.'</td>';
            $tbl_header .=	'<td align="left">&nbsp;'.$dataheader[$i]->CUSTOMER.'</td>';
            //$tbl_header .=	'<td align="center">'.$dataheader[$i]->SEND_DATE_EMAIL.'</td>';
            $tbl_header .=	'<td align="right">'.$jumlah.'</td>';
            $tbl_header .=	'</tr>';
            if($i==34){
                $k = $i;
                $tbl_header = /*$headerTable .*/ $tbl_header.'<br></table>';
                /*$pdf->writeHtml($tbl_logo, true, false, false, false, '');*/
                $pdf->writeHtml($tbl_header, true, false, false, false, '');
                $pdf->SetTopMargin(18);
                $pdf->AddPage();
                $tbl_header = $headerTable;
            }else if($i>34 && ($i+1) < count($dataheader)){
                if($i==($k+35)){
                    $tbl_header .= '</table>';
                    $pdf->writeHtml($tbl_header, true, false, false, false, '');
                    $pdf->SetTopMargin(18);
                    $pdf->AddPage();
                    $k = $i;
                    $tbl_header = $headerTable;
                }
            }

            if(($i+1) == count($dataheader)){
                $footer = '
										<table border="1">
											<tr>
								                <td COLSPAN="2" align="center" width="89%"><b>Jumlah</b></td>
								           		<td COLSPAN="1" align="right" width="13%"><b>'.number_format($jumlahakhir).'</b></td>
								    		</tr>
								    	</table>';
                $tbl_header .= $footer.'</table>';
                // echo $tbl_header;die();
                $pdf->writeHtml($tbl_header, true, false, false, false, '');
            }
        }

        $ttd 	= '<img width= "80" height= "70" src="'.UPLOADFOLDER_. 'uploads/ttd/'.$dataheader3[0]->INV_PEJABAT_TTD.'">';
        /*$gambar = '<img width= "350" height= "200" src="'.UPLOADFOLDER_. 'uploads/ttd/'.$dataheader3[0]->INV_PEJABAT_TTD'">';
        $gambar = '<img width="350" height="200" src="'.APP_ROOT.'uploads/entity/'.$data['e_logo'].'">';*/

        $tbl_footer = '<table>
						<tr>
						<br>
							<td align= "center" width = "40%"><b>Tanda Terima</b></td>
							<td align= "center" width = "10%"></td>
							<td align= "center" width = "50%">'.date('d-M-Y',time()).'</td>
							
							
							
						</tr>
						<tr>
							<td border ="1" width = "20%">		
							</td>
							<td border = "1" width = "20%">	
							</td>
							<td width = "10%">	
							</td>
							<td align = "center" width = "50%">
								'.$dataheader3[0]->INV_PEJABAT_JABATAN.'
								<br>
								'.$ttd.'
							</td>							
						</tr>
						<tr>
							<td>		
							</td>
							<td>	
							</td>
							<td align = "center" width = "70%">
								'.$dataheader3[0]->INV_PEJABAT_NAME.'
								<br>
								NIPP : '.$dataheader3[0]->INV_PEJABAT_NIPP.'
							</td>							
						</tr>
					  </table>';

        $pdf->writeHtml($tbl_footer, true, false, false, false, '');

        //switch($layanan)
        //{
        //	case "periodik":
        /*$this->get_data_nota($no_invoice,$data_table);
        $tbl .= $data_table;*/
        $output_name = "LAPORAN PENGIRIMAN NOTA.pdf";
        //	break;


        //}
        /*$pdf->writeHtml($tbl_logo, true, false, false, false, '');
        $pdf->writeHtml($headerTable, true, false, false, false, '');
        $pdf->writeHtml($tbl, true, false, false, false, '');*/
        $pdf->Output($output_name, 'I');
    }
	
	public function cetak_ematerai($layanan,$no_invoice=""){
		$this->load->helper('pdf_helper');

		tcpdf();

		$judul = 'LAPORAN PENGGUNAAN e-Materai';

		switch($layanan)
		{
			case "ematerai":
				$title = "Report ematerai";
			break;
			case "petikemas":
				$title = "Report Nota Petikemas";
			break;			
		}

		$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
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
		//$query = $this->M_report->cetak_pdf();
		$pdf->Cell(0,30, $judul, 0, 2, 'C', 0,FALSE);
		$pdf->SetFont('Arial', '', 10);

		$tbl .= "Layanan 	:<br>";

		$pdf->SetFont('helvetica', '', 10);

		$tbl .= "Jenis Nota 	: <br>";

		$pdf->SetFont('helvetica', '', 10);

		$tbl .= "Periode 		: <br>";



		switch($layanan)
		{
			case "ematerai":
				$this->get_data_ematerai($no_invoice,$data_table);
				$tbl .= $data_table;
				$output_name = "LAPORAN PDF NOTA E-MATERAI";
			break;

			case 'petikemas':
				$this->get_data_petikemas($no_invoice,$data_table);
				$tbl .= $data_table;
				$output_name = "LAPORAN PDF NOTA PETIKEMAS";
				break;
		}

		$pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->Output($output_name, 'I');
	}

	public function get_data_ematerai($no_invoice,&$data_table)
	{
		$data_table ='<table border="1">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="50">No</th>';
		$data_table .='<th align="center" width="50">Invoice</th>';
		$data_table .='<th align="center" width="50">No. Dokumen</th>';
		$data_table .='<th align="center" width="50">Customer</th>';
		$data_table .='<th align="center" width="50">Curr</th>';
		$data_table .='<th align="center" width="50">Layanan</th>';
		$data_table .='<th align="center" width="50">Jenis Nota</th>';
		$data_table .='<th align="center" width="50">No. Pajak</th>';
		$data_table .='<th align="center" width="50">Pendapatan</th>';
		$data_table .='<th align="center" width="50">PPN</th>';
		$data_table .='<th align="center" width="50">Total</th>';
		$data_table .='<th align="center" width="50">Materai</th>';
		//$data_table .='<th align="center">Tanggal Masuk</th>';
		//$data_table .='<th align="center">Tanggal Keluar</th>';
		//$data_table .='<th align="center">Harga</th>';
		$data_table .='</tr>';

		$data_table .='</table>';
		$data_table	.='<table border="1">';
		$data_table .='<tr>';
		$data_table .='<th></th>';
		$data_table .='<th align="left" width="50">Total</th>';
		$data_table .='<th></th>';
		$data_table .='<th align="right" width="50">111111</th>';
		$data_table .='<th align="right" width="50">99999</th>';
		$data_table .='<th align="right" width="50">99999</th>';
		$data_table .='</tr>';
		$data_table .='</table>';
	}

	public function get_data_petikemas($no_invoice,&$data_table)
	{
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

    public function cetak_all_nota_excel(){
        $this->load->library('PHPExcel');
        $user['datauser'] = $this->session->userdata('unit_org');
        /*print_r($user);die();*/
        $user2['datauser2'] = $this->session->userdata('entity_code');
        /*print_r($user2);die();*/

        //$kapal = $_POST

        $dataheader 	= $this->senddataurl('Pengiriman/search/',$_GET,'POST');
        /*print_r($_GET);die();*/
        $dataheader2 	= $this->senddataurl('Entity/dataperiodik/',$user2,'POST');
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        /*\*/
        /*print_r($_GET);die();*/

        $objPHPExcel = new PHPExcel();
        if($_GET['SEND_DATE_EMAIL_START'] == ""){
            $periode1='ALL';
        }else{
            $periode1=$_GET['SEND_DATE_EMAIL_START']. "s/d" .$_GET['SEND_DATE_EMAIL_END'];
        }

        if($_GET['CUSTOMER'] == ""){
            $cust = 'ALL';
        }else{
            $cust = $_GET['CUSTOMER'];
        }
        //Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)')
            ->setCellValue('C3', $dataheader3[0]->INV_UNIT_NAME)
            ->setCellValue('C5','Laporan Pengiriman Nota')
            ->setCellValue('C6','Periode : '.$periode1)
            ->setCellValue('C7','Customer : '.$cust)
            ->setCellValue('A9', 'No')
            ->setCellValue('B9', 'No Nota')
            ->setCellValue('C9', 'Tanggal Nota')
            //->setCellValue('D9', 'Curr')
            ->setCellValue('D9', 'Layanan')
            ->setCellValue('E9', 'Jenis Nota')
            ->setCellValue('F9', 'Customer')
            //->setCellValue('G9', 'Send Date Email')
            ->setCellValue('G9', 'Jumlah Tagihan');

        //Set Title
        $objPHPExcel->getActiveSheet()->setTitle('Laporan Pengiriman Nota');
        /*$objPHPExcel->getActiveSheet()->mergeCells('D4:F4');
        $objPHPExcel->getActiveSheet()->getStyle('B1:H10')->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');*/


        $row = 10;
        $num = 1;
        $jumlahtagihan = 0;


        foreach ($dataheader as $data_header ) {
            $timenew = explode(" ",$data_header->NOTA_DATE);
            /*print_r($timenew);die();*/


            /*echo $data_header->TRX_NUMBER; die();*/
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(19);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
            //$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
            //$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
            $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $data_header->NO_NOTA);
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $row, $timenew[0]);
            //$objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $data_header->CURRENCY_CODE);
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $data_header->INV_NOTA_LAYANAN);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $data_header->INV_NOTA_JENIS);
            $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $data_header->CUSTOMER);
            //$objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $data_header->SEND_DATE_EMAIL);
            $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $data_header->BESARAN);
            /*$objPHPExcel->setCellValue('L'. $row, $row_data['vclaimed']);*/
            $jumlahtagihan += intval($data_header->BESARAN);
            $row++;
            $num++;
            $row2 = $row+3;
            $row3 = $row+4;
            $row4 = $row+11;
            $row5 = $row+12;
            $row6 = $row+5;
            /*$ttd = APPPATH.$dataheader3[0]->INV_PEJABAT_TTD;*/
        }

        /*$newttd = str_replace("<br/>", $row3++, $dataheader3[0]->INV_PEJABAT_JABATAN);*/
        $newttd = explode("<br/> ",$dataheader3[0]->INV_PEJABAT_JABATAN);
        $space2 = $row+2;

        /*$datetoday = format_date($exceldatestamp, 'custom', 'Y-m-d', 'UTC');*/
        $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $jumlahtagihan);
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, "Jumlah");
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row2, "Tanda Terima");
        $objPHPExcel->getActiveSheet()->setCellValue('F'. $row2, "".date('d-M-Y',time()));
        $i = 0;
        for ($i=0; $i < count($newttd) ; $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue('F'. ($row3+$i), $newttd[$i]);
        }

        $objPHPExcel->getActiveSheet()->setCellValue('F'. ($row4+$i), $dataheader3[0]->INV_PEJABAT_NAME);
        $objPHPExcel->getActiveSheet()->setCellValue('F'. ($row5+$i), $dataheader3[0]->INV_PEJABAT_NIPP);
        $objTTD = new PHPExcel_Worksheet_MemoryDrawing();


        $ttd = UPLOADFOLDER_. 'uploads/ttd/'.$dataheader3[0]->INV_PEJABAT_TTD;
        $exploded = explode('.',$ttd);
        $ext = $exploded[count($exploded) - 1];
        /*print_r($ext);die();*/

        if (preg_match('/jpg|jpeg/i',$ext)){
            $imageTmp=imagecreatefromjpeg($ttd);
        }
        else if (preg_match('/png/i',$ext)){
            $imageTmp=imagecreatefrompng($ttd);
        }
        else if (preg_match('/gif/i',$ext)){
            $imageTmp=imagecreatefromgif($ttd);
        }
        else if (preg_match('/bmp/i',$ext)){
            $imageTmp=imagecreatefrombmp($ttd);
        }
        /*print_r($imageTmp);die();*/

        /*echo APP_ROOT. 'uploads/entity/'.$dataheader3[0]->INV_PEJABAT_TTD; die();*/
        $objTTD->setName('Tanda Tangan');
        $objTTD->setDescription('tandatangan');
        $objTTD->setImageResource($imageTmp);
        $objTTD->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objTTD->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objTTD->setOffsetX(5);
        $objTTD->setOffsetY(5);
        $objTTD->setHeight(100);
        $objTTD->setCoordinates('H'. ($row6+$i));
        $objTTD->setWorksheet($objPHPExcel->getActiveSheet());
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A9:G9')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.":G".$row)->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('EBE9E9');

        $row+= 4;
        //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A9:G9')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('EBE9E9');

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '0F0F0F'),
                ),
            ),
        );

        $styleArray2 = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ),
        );

        $space = $row+5;
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getStyle('A9:G9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A9:G9')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle('C7')->getFont()->setSize(12);
        /*$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':E'.$space);*/
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':B'.$space);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('B'.$row.':B'.$space)->applyFromArray($styleArray2);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':C'.$space);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$row.':C'.$space)->applyFromArray($styleArray2);
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        /*echo APP_ROOT.'uploads/entity/WWF_test2323-1521791339.png';die();*/


        /*$gdImage = imagecreatefromjpeg(APP_ROOT.'uploads/entity/'.$dataheader3[0]->INV_ENTITY_LOGO);*/

        $logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;
        /*print_r($logo);die();*/
        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];
        /*print_r($ext1);die();*/
        /*print_r($ext);die();*/

        if (preg_match('/jpg|jpeg/i',$ext1)){
            $imageTmp2=imagecreatefromjpeg($logo);
        }
        else if (preg_match('/png/i',$ext1)){
            $imageTmp2=imagecreatefrompng($logo);
        }
        else if (preg_match('/gif/i',$ext1)){
            $imageTmp2=imagecreatefromgif($logo);
        }
        else if (preg_match('/bmp/i',$ext1)){
            $imageTmp2=imagecreatefrombmp($logo);
        }


        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($imageTmp2);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setOffsetX(5);
        $objDrawing->setOffsetY(5);
        $objDrawing->setHeight(75);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //Nama File
        header('Content-Disposition: attachment;filename="Laporan Pengiriman Nota.xlsx"');

        //Download
        $objWriter->save("php://output");

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

	public function testcetakexcelperiodik(){
		$no_nota = $this->input->get('no_nota');	
		$tanggal_nota = $this->input->get('tanggal_nota');	
		$customer = $this->input->get('customer');	
		$currency = $this->input->get('currency');	
		$layanan = $this->input->get('layanan');	
		$jenis_nota = $this->input->get('jenis_nota');
		$no_pajak = $this->input->get('no_pajak');	
		$status_transfer = $this->input->get('status_transfer');	
		$status_lunas = $this->input->get('status_lunas');	
		$tanggal_lunas = $this->input->get('tanggal_lunas');	
		$bank = $this->input->get('bank');	
		$pendapatan = $this->input->get('pendapatan');	
		$ppn = $this->input->get('ppn');
		$total=$this->input->get('total');

		$columns =  array(
					"No Nota"=>$no_nota, 
					"Tanggal Nota"=>$tanggal_nota, 
					"Customer"=>$customer, 
					"Curr"=>$currency,
					"Layanan"=>$layanan, 
					"Jenis Nota"=>$jenis_nota, 
					"No Pajak"=>$no_pajak, 
					"Status Transfer"=>$status_transfer, 
					"Status Lunas"=>$status_lunas, 
					"Tanggal Lunas"=>$tanggal_lunas, 
					"Bank"=>$bank, 
					"Pendapatan"=>$pendapatan, 
					"PPN 10%"=>$ppn, 
					"Total"=>$total
				); 

		$alphas = range('A', 'Z');
		//echo $alphas;
		

		$header_names = array(
						"No Nota"=>'TRX_NUMBER',
						"Tanggal Nota"=>'TRX_DATE', 
						"Customer"=>'CUSTOMER_NAME', 
						"Curr"=>'CURRENCY_CODE',
						"Layanan"=>'INV_NOTA_LAYANAN', 
						"Jenis Nota"=>'INV_NOTA_JENIS',
						"No Pajak"=>'CUSTOMER_NPWP', 
						"Status Transfer"=>'AR_STATUS', 
						"Status Lunas"=>'STATUS_LUNAS', 
						"Tanggal Lunas"=>'TGL_PELUNASAN', 
						"Bank"=>'RECEIPT_ACCOUNT', 
						"Pendapatan"=>'AMOUNT_DASAR_PENGHASILAN', 
						"PPN 10%"=>'PPN_10PERSEN', 
						"Total"=>'AMOUNT'
						);


		$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$count = 0;

		  $data_db = array
		  (
		  array("name"=>"dia","username"=>"le","email"=>"lena@mail"),
	
		  );

		 $num = 1;

		 


		print_r($c);
		$result_header = array();
		$result_alpha = array();
		foreach ($columns as $key => $value) {
		 	if($value == 'true'){
		 		//echo $alphabet[$count].' | ';

		 		$result_header[] =$header_names[$key];
		 		$result_alpha[] = $alphabet[$count];
		 		$count++;
		 	}

		}

		print_r($result_alpha) ;
		print_r($result_header) ;

	}

	public function cetak_laporanperiodik_excel(){
		date_default_timezone_set('Asia/Bangkok');
		$this->load->library('PHPExcel');
		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		/*print_r($user);die();*/
		//$user2['datauser2'] = $this->session->userdata('entity_code');
		/*print_r($user2);die();*/
		//$kapal = $_POST
		$no_nota = $this->input->get('no_nota');	
		$tanggal_nota = $this->input->get('tanggal_nota');	
		$customer = $this->input->get('customer');	
		$currency = $this->input->get('currency');	
		$layanan = $this->input->get('layanan');	
		$jenis_nota = $this->input->get('jenis_nota');
		$no_pajak = $this->input->get('no_pajak');	
		$status_transfer = $this->input->get('status_transfer');	
		$status_lunas = $this->input->get('status_lunas');	
		$tanggal_pelunasan = $this->input->get('tanggal_lunas');	
		$bank = $this->input->get('bank');	
		$pendapatan = $this->input->get('pendapatan');	
		$ppn = $this->input->get('ppn');
		$total=$this->input->get('total');

        $dataheader 	= $this->senddataurl('periodik/search1/',$_GET,'POST');
        /*print_r($dataheader2);die();*/
        $dataheader3 	= $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');
		/*print_r($dataheader);die();*/
		
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		//$cacheSettings = array( 'memoryCacheSize' => '7024MB');
		$cacheSettings = array( 'memoryCacheSize' => -1);
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $objPHPExcel = new PHPExcel();

        	if($_GET['TGL_PELUNASAN_START'] == ""){
				$tanggal_lunas='ALL';
			}else{
				$tanggal_lunas=$_GET['TGL_PELUNASAN_START']. " s/d " .$_GET['TGL_PELUNASAN_END'];	
				}

		$columns = array (
		  0 => 
		  array (
		   	'status' => $no_nota,
		    'name' => 'No Nota',
		    'header_db_name' => 'TRX_NUMBER',
		    'width'=>21
		  ),
		  1 => 
		  array (
			'status' => $tanggal_nota,
		    'name' => 'Tanggal Nota',
		    'header_db_name' => 'TRX_DATE',
		    'width'=>14
		  ),
		  2 => 
		  array (
		   	'status' => $customer,
		    'name' => 'Customer',
		    'header_db_name' => 'CUSTOMER_NAME',
		    'width'=>48

		  ),
		  3 => 
		  array (
		   	'status' => $currency,
		    'name' => 'Curr',
		    'header_db_name' => 'CURRENCY_CODE',
		    'width'=>6

		  ),
		  4 => 
		  array (
			'status' => $layanan,
		    'name' => 'Layanan',
		    'header_db_name' => 'INV_NOTA_LAYANAN',
		    'width'=>12

		  ),
		  5 => 
		  array (
		   	'status' => $jenis_nota,
		    'name' => 'Jenis Nota',
		    'header_db_name' => 'INV_NOTA_JENIS',
		    'width'=>20

		  ),
		  6 => 
		  array (
		   	'status' => $no_pajak,
		    'name' => 'No Pajak',
		    'header_db_name' => 'CUSTOMER_NPWP',
		    'width'=>17

		  ),
		  7 => 
		  array (
			'status' => $status_transfer,
		    'name' => 'Status Transfer',
		    'header_db_name' => 'AR_STATUS',
		    'width'=>15

		  ),
		  8 => 
		  array (
		   	'status' => $status_lunas,
		    'name' => 'Status Lunas',
		    'header_db_name' => 'STATUS_LUNAS',
		    'width'=>17

		  ),
		  9 => 
		  array (
		   	'status' => $tanggal_pelunasan,
		    'name' => 'Tanggal Lunas',
		    'header_db_name' => 'TGL_PELUNASAN',
		    'width'=>20

		  ),
		  10 => 
		  array (
			'status' => $bank,
		    'name' => 'Bank',
		    'header_db_name' => 'RECEIPT_ACCOUNT',
		    'width'=>15

		  ),
		  11 => 
		  array (
		   	'status' => $pendapatan,
		    'name' => 'Pendapatan',
		    'header_db_name' => 'AMOUNT_DASAR_PENGHASILAN',
		    'width'=>13

		  ),
		  12 => 
		  array (
		   	'status' => $ppn,
		    'name' => 'PPN 10%',
		    'header_db_name' => 'PPN_10PERSEN',
		    'width'=>15

		  ),
		  13 => 
		  array (
			'status' => $total,
		    'name' => 'Total',
		    'header_db_name' => 'AMOUNT',
		    'width'=>15

		  )
		); 

		$alphabet = array('B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

		$count = 0;

		$objPHPExcel->setActiveSheetIndex(0);
    	$objPHPExcel->getActiveSheet()->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)');
		$objPHPExcel->getActiveSheet()->setCellValue('C3', $dataheader3[0]->INV_UNIT_NAME);
		$objPHPExcel->getActiveSheet()->setCellValue('C5','Laporan Periodik');
		$objPHPExcel->getActiveSheet()->setCellValue('C6','PERIODE : '.$tanggal_lunas);

		$result_alpha = array();
		
		$result_header = array();
		$result_header_width = array();
		 
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'No');
		foreach ($columns as $key => $value) {
		 	if($value['status'] == 'true'){
		 		$objPHPExcel->getActiveSheet()->setCellValue($alphabet[$count].'8', $value['name']);
		 		$result_alpha[] =$alphabet[$count];
		 		$result_header[] =$value['header_db_name'];
		 		$result_header_width[] =$value['width'];

		 		
		 		$count++;
		 	}

		}
		//print_r($result_alpha);

		//print_r($result_header);die(); ;

        $row = 9; 
        $num = 1;
        $jumlahpendapatan = 0;
        $jumlahppn = 0;
        $jumlahamount = 0;   

        $abjd=array();

        $countabjd=0;
       
        $strpendapatan="";
        $strppn="";
        $strtotal="";
         foreach ($dataheader as $data_header ) {

        	
        	//echo  $data_header->TRX_NUMBER;
        	foreach ($result_alpha as $key =>  $data_abjd) {
        		$objPHPExcel->getActiveSheet()->getColumnDimension($data_abjd)->setWidth($result_header_width[$key]);
	        	if($result_header[$key]=='AMOUNT_DASAR_PENGHASILAN'){
	        		$strpendapatan = $data_abjd;
	        	}
	        	if($result_header[$key]=='PPN_10PERSEN'){
	        		$strppn = $data_abjd;
	        	}
	        	if($result_header[$key]=='AMOUNT'){
	        		$strtotal = $data_abjd;
	        	}
        		
            	$objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, $data_header->$result_header[$key]);
            	if($result_header[$key]=='AR_STATUS'){
            	 if($data_header->AR_STATUS == "S"){
						$objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "TRANSFER");
					}else if($data_header->AR_STATUS == "F"){
						$objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "FAILED");
					}else {
						$objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "BELUM TRANFER");
					}    
				}

				if($result_header[$key]=='STATUS_LUNAS'){
		            if($data_header->STATUS_LUNAS == "Y"){
		            	$objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "Lunas");
		            }else{
		            	$objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "Belum Lunas");
		            }
	        	}
	            
        		$countabjd++;


        	}
        	$objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
        	$jumlahpendapatan += intval($data_header->AMOUNT_DASAR_PENGHASILAN);
            $jumlahppn += intval($data_header->PPN_10PERSEN); 
            $jumlahamount += intval($data_header->AMOUNT);     
	            
        	$row++;
        	$num++;
            /*$objPHPExcel->setCellValue('L'. $row, $row_data['vclaimed']);*/
           /* $jumlahpendapatan += intval($data_header->AMOUNT_DASAR_PENGHASILAN);
            $jumlahppn += intval($data_header->PPN_10PERSEN); 
            $jumlahamount += intval($data_header->AMOUNT);     
            $row++;
            $num++;*/
        }
        

        $lastabjd = end($result_alpha);

        if($strpendapatan){
        	$objPHPExcel->getActiveSheet()->setCellValue($strpendapatan. $row, $jumlahpendapatan);
        }
        if($strppn){
        	$objPHPExcel->getActiveSheet()->setCellValue($strppn. $row, $jumlahppn);
        }
        if($strtotal){
        	$objPHPExcel->getActiveSheet()->setCellValue($strtotal. $row, $jumlahamount);

        }
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, "Jumlah");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($strpendapatan. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($strppn. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($strtotal. $row)->getFont()->setBold(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$lastabjd.$row)->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');
            //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A8:'.$lastabjd.'8')->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');

		$objPHPExcel->getActiveSheet()->getStyle('D6')        // Format as date and time
                     					->getNumberFormat()   
                        				->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

		$styleArray2 = array(
		    'font'  => array(
		        'name'  => 'Arial'
		    ));

		$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '0F0F0F'),
									),
								),
							);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($styleArray2);
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A8:'.$lastabjd.'8')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
		/*$objPHPExcel->setPreCalculateFormulas(true);*/
		$objPHPExcel->getActiveSheet()->getStyle('A8:'.$lastabjd.'8')->applyFromArray($styleArray);
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		/*echo APP_ROOT.'uploads/entity/WWF_test2323-1521791339.png';die();*/
		$logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;
        /*print_r($logo);die();*/
        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];
        /*print_r($ext1);die();*/
        /*print_r($ext);die();*/

		if (preg_match('/jpg|jpeg/i',$ext1)){
			$imageTmp2=imagecreatefromjpeg($logo);
		}
		else if (preg_match('/png/i',$ext1)){
			$imageTmp2=imagecreatefrompng($logo);
		}
		else if (preg_match('/gif/i',$ext1)){
       		$imageTmp2=imagecreatefromgif($logo);
		}
    	else if (preg_match('/bmp/i',$ext1)){
        	$imageTmp2=imagecreatefrombmp($logo);
        } 

		
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($imageTmp2);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);
		$objDrawing->setHeight(75);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
 	    //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
            //Nama File
            header('Content-Disposition: attachment;filename="Laporan Periodik.xlsx"');
 
            //Download
            $objWriter->save("php://output");

	}

	public function cetak_laporanpembayaran(){
		$this->load->helper('pdf_helper');
		tcpdf();

		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		$_GET['ACTIVITY']   = "PAYMENT";
        $dataheader3 	    = $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $_GET['INV_UNIT_CODE']  = $dataheader3[0]->INV_UNIT_CODE;
        $_GET['INV_UNIT_ORGID'] = $dataheader3[0]->INV_UNIT_ORGID;
        $dataheader 	    = $this->senddataurl('lognota/search/',$_GET,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');

		$judul = 'LAPORAN Pembayaran';
		$title = "LAPORAN Pembayaran";

		$pdf = new MyCustomPDFWithWatermark('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->SetHeaderMargin(30);
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
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		//$query = $this->M_report->cetak_pdf();
		//$pdf->Cell(0,20, $judul, 0, 2, 'C', 0,FALSE);
		$pdf->SetFont('Arial', '', 8);
		
			if($_GET['TGL_PAYMENT_START'] == ""){
				$periode1='ALL';
				}else{
				$periode1=$_GET['TGL_PAYMENT_START']. " s/d " .$_GET['TGL_PAYMENT_END'];	
			}

			if($dataheader[0]->STATUS_LUNAS == ""){
				$lunas= 'BELUM LUNAS';
			}else if($dataheader[0]->STATUS_LUNAS == "Y"){
				$lunas= 'LUNAS';
			}else if($dataheader[0]->STATUS_LUNAS == "XY"){
				$lunas= 'KOREKSI';
			}

			

		$logoipc 	= '<img width= "100" height= "100" src="'.UPLOADFOLDER_. 'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO.'">';
		

		$tbl_logo	='<table>
						<tr>
						<br>
						<br>
							<td height="20%" width="10%" style="vertical-alignment:"bottom" "margin-top:10%""><img src="'.$logoipc.'" height="60" width="100"></td>
							<td >PT. Pelabuhan Indonesia II (Persero)<br>'.$dataheader3[0]->INV_UNIT_NAME.' <br> <br><b>LAPORAN PEMBAYARAN<br></b><b>PERIODE : '.$periode1.'</b></td>
							<td></td>
						</tr>
					  </table>';
					$pdf->writeHtml($tbl_logo, true, false, false, false, '');
		$k = 0;
							$headerTable =	'<table border = "1">
									<tr>
										<th align="center" width="3%"><b>No</b></th>
										<th align="center" width="11%"><b>No Receipt</b></th>
										<th align="center" width="10%"><b>Tanggal Receipt</b></th>
										<th align="center" width="7%"><b>Jenis Payment</b></th>
										<th align="center" width="27%"><b>Customer</b></th>
										<th align="center" width="10%"><b>Status Transfer</b></th>
										<th align="center" width="18%"><b>Bank</b></th>
										<th align="center" width="5%"><b>Curr</b></th>
										<th align="center" width="10%"><b>Amount Receipt</b></th>
									</tr>';
							// $num = 1;
									// print_r($dataheader);die();

							$tbl_header = $headerTable;
							$usdtotal = 0;
							$rupiahtotal = 0;
							for ($i=0; $i < count($dataheader); $i++) {
								if($dataheader[$i]->STATUS_TRANSFER == "S"){
									$ar = 'TRANSFER';
								}else if($dataheader[$i]->STATUS_TRANSFER == "F"){
									$ar = 'FAILED';
								}else{
									$ar = 'BELUM TRANSFER';
								}

								if($dataheader[$i]->CURRENCY == "USD"){
									$usdtotal += intval($dataheader[$i]->AMOUNT_RECEIPT); 
								}else{
									$rupiahtotal += intval($dataheader[$i]->AMOUNT_RECEIPT);
								}
								$total = number_format($dataheader[$i]->AMOUNT_RECEIPT,0,',',',');
								/*$penjumlahan += intval($dataheader[$i]->AMOUNT_RECEIPT);*/ 
								/*$sum = $dataheader[$i]->AMOUNT_RECEIPT['USD'];*/
								$timenew = explode(" ",$dataheader[$i]->CREATED);
								/*$dasarppn	+= intval($dataheader[$i]->PPN_10PERSEN);
								$hasilakhir += intval($dataheader[$i]->AMOUNTS);
								$dasar = number_format($dataheader[$i]->AMOUNT_DASAR_PENGHASILAN,0,',',',');
								$ppn = number_format($dataheader[$i]->PPN_10PERSEN,0,',',',');
								$total = number_format($dataheader[$i]->AMOUNTS,0,',',',');*/
								$tbl_header .=	'<tr>';
								$tbl_header .=	'<td align="center">'.($i+1).'</td>';
								$tbl_header .=	'<td style="margin-left:20px">&nbsp;'.$dataheader[$i]->TRX_NUMBER.'</td>';
								$tbl_header .=	'<td align="center">'.$timenew[0].'</td>';
								$tbl_header .=	'<td>&nbsp;'.$dataheader[$i]->JENIS_PAYMENT.'</td>';				
								$tbl_header .=	'<td align="left">&nbsp;'.$dataheader[$i]->CUSTOMER_NAME.'</td>';
								$tbl_header .=	'<td align="center">'.$ar.'</td>';
								$tbl_header .=	'<td align="center">'.$dataheader[$i]->BANK.'</td>';
								$tbl_header .=	'<td align="center">'.$dataheader[$i]->CURRENCY.'</td>';
								$tbl_header .=	'<td align="right">'.$total.'&nbsp;</td>';
								$tbl_header .=	'</tr>';
								if($i==27){
									$k = $i;
									$tbl_header = /*$headerTable .*/ $tbl_header.'</table>';
									/*$pdf->writeHtml($tbl_logo, true, false, false, false, '');*/
									$pdf->writeHtml($tbl_header, true, false, false, false, '');
									$pdf->SetPrintFooter(true);
									/*$pdf->writeHtml($footer, true, false, false, false, '');*/
									$pdf->SetTopMargin(18);
									$pdf->AddPage();
									$tbl_header = $headerTable;
								}else if($i>27 && ($i+1) < count($dataheader)){
									if($i==($k+35)){
										$tbl_header .= '</table>';
										$pdf->writeHtml($tbl_header, true, false, false, false, '');
										$pdf->SetPrintFooter(true);
									/*	$pdf->writeHtml($footer, true, false, false, false, '');*/
										// $pdf->SetTopMargin(5);
										$pdf->SetTopMargin(18);
										$pdf->AddPage();
										$k = $i;
										$tbl_header = $headerTable;
									}
								}

								if(($i+1) == count($dataheader)){
								$footer = '
										<table border="1">
											<tr>
								                <td COLSPAN="2" align="center" width="86%"><b>TOTAL</b></td>
								                <td COLSPAN="2" align="center" width="5%"><b>USD</b></td>
								                <td COLSPAN="2" align="right" width="10%"><b>'.number_format($usdtotal).'</b></td>
								    		</tr>
								    		<tr>
								                <td COLSPAN="2" align="center" width="86%"><b></b></td>
								                <td COLSPAN="2" align="center" width="5%"><b>IDR</b></td>
								                <td COLSPAN="2" align="right" width="10%"><b>'.number_format($rupiahtotal).'</b></td>
								    		</tr>
								    	</table>';
									$tbl_header .= $footer.'</table>';
									// echo $tbl_header;die();

										$pdf->writeHtml($tbl_header, true, false, false, false, '');
										$pdf->SetPrintFooter(true);
										/*$pdf->writeHtml($footer, true, false, false, false, '');*/


								}
							}
			
			

		
		$output_name = "LAPORAN Payment.pdf";
		
		
		
		// $pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->Output($output_name, 'I');	
	}

	

	public function cetak_paymenthistoryexcel(){
		date_default_timezone_set('Asia/Bangkok');
		$this->load->library('PHPExcel');
		$user['datauser'] = $this->session->userdata('unit_org');
        // Start SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
        $user['dataunit'] = $this->session->userdata('unit_id');
        // Stop SIGMA 09/12/2019 Penambahan UNIT CODE Reporting
		/*print_r($user);die();*/
		//$user2['datauser2'] = $this->session->userdata('entity_code');
		/*print_r($user2);die();*/
		//$kapal = $_POST

        $no_receipt     = $this->input->get('NO_RECEIPT');
        $tgl_receipt    = $this->input->get('TGL_RECEIPT');
        $jenis_payment  = $this->input->get('JNS_PAYMENT');
        $customer       = $this->input->get('CUST');
        $currency       = $this->input->get('CUR');
        $amount_receipt = $this->input->get('AMO_RECEIPT');
        $bank           = $this->input->get('BANK');
        $status_transfer= $this->input->get('STS_TRANSFER');

        $_GET['ACTIVITY']   = "PAYMENT";
        $dataheader3 	    = $this->senddataurl('Pejabat/datapengiriman/',$user,'POST');
        $_GET['INV_UNIT_CODE']  = $dataheader3[0]->INV_UNIT_CODE;
        $_GET['INV_UNIT_ORGID'] = $dataheader3[0]->INV_UNIT_ORGID;
        $dataheader 	    = $this->senddataurl('lognota/search/',$_GET,'POST');
        $user2['datauser2'] = $dataheader3[0]->INV_ENTITY_CODE;
        $dataheader2 	    = $this->senddataurl('Entity/dataperiodik/',$user2,'POST');

        $objPHPExcel = new PHPExcel();

        	if($_GET['TGL_PAYMENT_START'] == ""){
				$tanggal_lunas='ALL';
			}else{
				$tanggal_lunas=$_GET['TGL_PAYMENT_START']. " s/d " .$_GET['TGL_PAYMENT_END'];	
				}

        $columns = array (
            0 =>
                array (
                    'status' => $no_receipt,
                    'name' => 'No Receipt',
                    'header_db_name' => 'TRX_NUMBER',
                    'width'=>'TRUE'
                ),
            1 =>
                array (
                    'status' => $tgl_receipt,
                    'name' => 'Tanggal Receipt',
                    'header_db_name' => 'CREATED',
                    'width'=>'TRUE'
                ),
            2 =>
                array (
                    'status' => $jenis_payment,
                    'name' => 'Jenis Payment',
                    'header_db_name' => 'JENIS_PAYMENT',
                    'width'=>'TRUE'
                ),
            3 =>
                array (
                    'status' => $customer,
                    'name' => 'Customer',
                    'header_db_name' => 'CUSTOMER_NAME',
                    'width'=>'TRUE'
                ),
            4 =>
                array (
                    'status' => $status_transfer,
                    'name' => 'Status Transfer',
                    'header_db_name' => 'AR_STATUS',
                    'width'=>'TRUE'
                ),
            5 =>
                array (
                    'status' => $bank,
                    'name' => 'Bank',
                    'header_db_name' => 'BANK',
                    'width'=>'TRUE'
                ),
            6 =>
                array (
                    'status' => $currency,
                    'name' => 'Currency',
                    'header_db_name' => 'CURRENCY',
                    'width'=>'TRUE'
                ),
            7 =>
                array (
                    'status' => $amount_receipt,
                    'name' => 'Amount Receipt',
                    'header_db_name' => 'AMOUNT_RECEIPT',
                    'width'=>'TRUE'
                )
        );

        $alphabet = array('B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $count    = 0;

        //Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('C2','PT. Pelabuhan Indonesia II (Persero)');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', $dataheader3[0]->INV_UNIT_NAME);
        $objPHPExcel->getActiveSheet()->setCellValue('B6','Laporan Periodik');
        $objPHPExcel->getActiveSheet()->setCellValue('B7','PERIODE : '.$tanggal_lunas);

        $result_alpha        = array();
        $result_header       = array();
        $result_header_width = array();

        $objPHPExcel->getActiveSheet()->setCellValue('A9', 'No');
        foreach ($columns as $key => $value) {
            if($value['status'] == 'true'){
                $objPHPExcel->getActiveSheet()->setCellValue($alphabet[$count].'9', $value['name']);
                $result_alpha[] =$alphabet[$count];
                $result_header[] =$value['header_db_name'];
                $result_header_width[] =$value['width'];
                $count++;
            }

        }

        $row = 10; 
        $num = 1;
        $jumlahusd = 0;
        $jumlahidr = 0;

        foreach ($dataheader as $data_header ) {
            foreach ($result_alpha as $key =>  $data_abjd) {
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $objPHPExcel->getActiveSheet()->getColumnDimension($data_abjd)->setAutoSize($result_header_width[$key]);

                $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
                $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, $data_header->$result_header[$key]);

                $timenew = explode(" ",$data_header->CREATED);
                if($result_header[$key]=='CREATED'){
                    $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, $timenew[0]);
                }

                if($result_header[$key]=='AR_STATUS'){
                    if($data_header->STATUS_TRANSFER == "S"){
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "TRANSFER");
                    } else if($data_header->STATUS_TRANSFER == "F"){
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "FAILED");
                    } else {
                        $objPHPExcel->getActiveSheet()->setCellValue($data_abjd. $row, "BELUM TRANFER");
                    }
                }
            }

            if($data_header->CURRENCY == "USD"){
                $jumlahusd += intval($data_header->AMOUNT_RECEIPT);
            }else{
                $jumlahidr += intval($data_header->AMOUNT_RECEIPT);
            }

            $row++;
            $num++;
            $row1 = $row+1;
        }

        $lastabjd = end($result_alpha);

        $objPHPExcel->getActiveSheet()->setCellValue($lastabjd. $row, $jumlahusd);
        $objPHPExcel->getActiveSheet()->setCellValue($lastabjd. $row1, $jumlahidr);
        $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, "USD");
        $objPHPExcel->getActiveSheet()->setCellValue('D'. $row1, "IDR");
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, "Jumlah");
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row1, "");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D'. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($lastabjd. $row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D'. $row1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($lastabjd. $row1)->getFont()->setBold(true);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('D6')->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.":".$lastabjd.$row)->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row1.":".$lastabjd.$row1)->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');										
            //Set Title
        $objPHPExcel->getActiveSheet()->getStyle('A9:'.$lastabjd.'9')->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EBE9E9');

		$objPHPExcel->getActiveSheet()->getStyle('D6')        // Format as date and time
                     					->getNumberFormat()   
                        				->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

		$styleArray2 = array(
		    'font'  => array(
		        'name'  => 'Arial'
		    ));

		$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => '0F0F0F'),
									),
								),
							);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getStyle('B')->applyFromArray($styleArray2);
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A9:'.$lastabjd.'9')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setSize(17);
		$objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setSize(17);
		/*$objPHPExcel->setPreCalculateFormulas(true);*/
		$objPHPExcel->getActiveSheet()->getStyle('A9:'.$lastabjd.'9')->applyFromArray($styleArray);
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		/*echo APP_ROOT.'uploads/entity/WWF_test2323-1521791339.png';die();*/
		$logo = UPLOADFOLDER_.'uploads/entity/'.$dataheader2[0]->INV_ENTITY_LOGO;
        /*print_r($logo);die();*/
        $explodedlogo = explode('.',$logo);
        $ext1 = $explodedlogo[count($explodedlogo) - 1];
        /*print_r($ext1);die();*/
        /*print_r($ext);die();*/

		if (preg_match('/jpg|jpeg/i',$ext1)){
			$imageTmp2=imagecreatefromjpeg($logo);
		}
		else if (preg_match('/png/i',$ext1)){
			$imageTmp2=imagecreatefrompng($logo);
		}
		else if (preg_match('/gif/i',$ext1)){
       		$imageTmp2=imagecreatefromgif($logo);
		}
    	else if (preg_match('/bmp/i',$ext1)){
        	$imageTmp2=imagecreatefrombmp($logo);
        } 

		
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($imageTmp2);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);
		$objDrawing->setHeight(75);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
 	    //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
            //Nama File
            header('Content-Disposition: attachment;filename="Laporan Payment.xlsx"');
 
            //Download
            $objWriter->save("php://output");

	}

	public function del_RequestAll()
	{
		//echo "test";
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
					

			if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"cancelBooking",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//echo $result;

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
		$bl_number="";
		$container_point="";
		$billing=null;
		if(isset($_GET['port'])){
			$port			= explode("-",$_GET["port"]);
		}
		if(isset($_GET['bl_number'])) $bl_number = $_GET['bl_number'];

		//create table
		$this->table->set_heading("No", "No Pol Truck","TID","Point","Gate In Time","Gate Out Time",'Weight','Quantity','Status');
        $this->table->set_heading("No", "No Pol Truck","TID","Point","Gate In Time","Gate Out Time",'Weight','Quantity','Status');

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
		if($bl_number!="")
		{
			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<bl_number>$bl_number</bl_number>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
				</data>
			</root>";
			//echo $in_data;die;
			if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getDetailCargo",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//echo $result;die;
								

				$obj = json_decode($result);
				//echo $obj->data->info->weight;
				//die();

				if($obj->data->info)
				{
					$data['vessel'] =  $obj->data->info->vessel;
					$data['voyage'] =  $obj->data->info->voyage;
					$data['bl_number'] =  $obj->data->info->bl_number;
					$data['cargo_name'] =  $obj->data->info->cargo_name;
					$data['package_name'] =  $obj->data->info->package_name;
					$data['weight'] =  $obj->data->info->weight;
					$data['quantity'] =  $obj->data->info->quantity;
					$data['volume'] =  $obj->data->info->volume;
					$data['hs_code'] =  $obj->data->info->hs_code;
					$data['weight_realization'] =  $obj->data->info->weight_realization;
					$data['quantity_realization'] =  $obj->data->info->quantity_realization;
					$data['volume_realization'] =  $obj->data->info->volume_realization;
					$data['trade'] =  $obj->data->info->trade;
					$data['e_i'] =  $obj->data->info->e_i;
					$data['tl'] =  $obj->data->info->tl;
					$data['cust_name'] =  $obj->data->info->cust_name;
					$data['cust_addr'] =  $obj->data->info->cust_addr;
				
			

			
			for($i=0;$i<count($obj->data->handling);$i++)
					{
						$this->table->add_row(
							$i+1,
							$obj->data->handling[$i]->nopol,
							$obj->data->handling[$i]->tid,
							$obj->data->handling[$i]->point,
							$obj->data->handling[$i]->trin_date,
							$obj->data->handling[$i]->trout_date,
							$obj->data->handling[$i]->weight,
							$obj->data->handling[$i]->quantity,
							$obj->data->handling[$i]->description
							);

					}
					
  			for($i=0;$i<count($obj->data->billing);$i++)
					{
						$billing[$i]['no']=$i+1;
						$billing[$i]['id_req']=$obj->data->billing[$i]->id_req;
						$billing[$i]['bl_number']=$obj->data->billing[$i]->bl_number;
						$billing[$i]['bl_date']=$obj->data->billing[$i]->bl_date;
						$billing[$i]['tl_flag']=$obj->data->billing[$i]->tl_flag;
						$billing[$i]['oi']=$obj->data->billing[$i]->oi;
						$billing[$i]['status']=$obj->data->billing[$i]->status;
						$billing[$i]['type_payment']=$obj->data->billing[$i]->type_payment; 
					} 
			}
			}
	}			
							$data['billing']=$billing;
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Track & Trace Cargo", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Track & Trace Cargo";

		$this->common_loader($data,'pages/om/tracking');
	}

	public function main_tca(){

		$this->redirect();
		$customer_id=$this->session->userdata('customerid_phd');
		//$result=$this->container_model->getNumberRequest($customer_id,'PTKM01');
		//create table
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>NO BL</th>",
		  "<th width='100px'>VESSEL</th>",
		  "<th width='150px'>VOY IN / VOY OUT</th>",
		  "<th width='100px'>BL DATE</th>",
		  "<th width='100px'>QTY</th>",
		  "<th width='100px'>TON</th>",
		  "<th width='100px'>JUMLAH TRUCK</th>",
		  "<th width='100px'>TRUCK COMPANY</th>",
		  "<th width='50px'>EDIT</th>"
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

 		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getHeaderTCA",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
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
					$cancel_link='<span class="label label-default">N/A</span>';
					$confirm_link='<span class="label label-default">N/A</span>';
					
					$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/edit_tca/".$obj->data->listreq[$i]->NO_REQUEST.'"><i class=\'fa fa-pencil\'></i></a>';

					$this->table->add_row(
						$i+1,
						$obj->data->listreq[$i]->NO_BL,
						$obj->data->listreq[$i]->VESSEL,
						$obj->data->listreq[$i]->VOYAGE,
						$obj->data->listreq[$i]->BL_DATE,
						$obj->data->listreq[$i]->QTY,
						$obj->data->listreq[$i]->TON,
						$obj->data->listreq[$i]->JML,
						$obj->data->listreq[$i]->TRUCK_COMP,
						$edit_link
					);
				}
			} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Truck ID Association", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "TID ASSOCIATION";

		$this->common_loader($data,'pages/om/main_tca');
	}
	
	
	public function search_main_tca($search=""){

				if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
        		
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : "";
		//$result=$this->container_model->getNumberRequest($customer_id,'PTKM01');
		//create table
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>NO BL</th>",
		  "<th width='100px'>VESSEL</th>",
		  "<th width='150px'>VOY IN / VOY OUT</th>",
		  "<th width='100px'>BL DATE</th>",
		  "<th width='100px'>QTY</th>",
		  "<th width='100px'>TON</th>",
		  "<th width='100px'>JUMLAH TRUCK</th>",
		  "<th width='100px'>TRUCK COMPANY</th>",
		  "<th width='50px'>EDIT</th>"
		 );

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		//$customer_id=$this->session->userdata('customerid_phd');
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<search>$search</search>
			</data>
		</root>";

 		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getHeaderTCA",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
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
					$cancel_link='<span class="label label-default">N/A</span>';
					$confirm_link='<span class="label label-default">N/A</span>';
					
					$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/edit_tca/".$obj->data->listreq[$i]->NO_REQUEST.'"><i class=\'fa fa-pencil\'></i></a>';

					$this->table->add_row(
						$i+1,
						$obj->data->listreq[$i]->NO_BL,
						$obj->data->listreq[$i]->VESSEL,
						$obj->data->listreq[$i]->VOYAGE,
						$obj->data->listreq[$i]->BL_DATE,
						$obj->data->listreq[$i]->QTY,
						$obj->data->listreq[$i]->TON,
						$obj->data->listreq[$i]->JML,
						$obj->data->listreq[$i]->TRUCK_COMP,
						$edit_link
					);
				}
			} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		}
		$this->load->view('pages/om/search_main_tca',$data);
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

				if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"requestReceivingDetail",array("in_data" => "$in_data"),$result))
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
	
	public function add_req_tca() {
		
		$this->redirect();
		
				$customer_id=$this->session->userdata('customerid_phd');
		$customer_name=$this->session->userdata('customername_phd');
		$address=$this->session->userdata('address_phd');
		$id_port =  implode("', '", array_map(function ($result) {
					  return $result['ID_PORT'];
					}, $result));
		$id_company =  implode("', '", array_map(function ($result) {
					  return $result['ID_COMPANY'];
					}, $result));
		$id_holding =  implode("', '", array_map(function ($result) {
					  return $result['ID_HOLDING'];
					}, $result));
					
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Request TCA", '/om/truck/main_tca');
		$this->breadcrumbs->push("Create New Request TCA", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "TID ASSOCIATION";
		
        $in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>IDJKT</port_code>
				<terminal_code>T3I</terminal_code>
			</data>
		</root>";
		
				$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		
		//echo $in_data; die;	

		$this->common_loader($data,'pages/om/add_req_tca');
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
		$result  = json_decode($ex);

		// $ex = curl_exec($ch);
		//  $result  = json_encode($ex);
		//    echo $result;
		#debug file
         /*file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         	array(
         		"body" => $ex,
         		"url" => $uri,
         		"data" => $data,
         ),true), FILE_APPEND);*/
		return $result;
	}

	public function emateraisearch(){
		$postdata = ($_POST);
		$dataArray = $this->senddataurl('Ematerai/search/',$postdata,'POST');
		
		$data = array(
			'data'=>array()
		);
		$num = 1;
		foreach($dataArray as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values);
			}
			
			/*print_r($bulanematerai);die();*/
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			$data['data'][$key]->MATERAI_3000_SUM = (strpos($value->MATERAI_3000_SUM,",")=='')?number_format($value->MATERAI_3000_SUM,0,',',','):$value->MATERAI_3000_SUM;
			$data['data'][$key]->MATERAI_6000_SUM = (strpos($value->MATERAI_6000_SUM,",")=='')?number_format($value->MATERAI_6000_SUM,0,',',','):$value->MATERAI_6000_SUM;
			$data['data'][$key]->TOTAL_MATERAI = (strpos($value->TOTAL_MATERAI,",")=='')?number_format($value->TOTAL_MATERAI,0,',',','):$value->TOTAL_MATERAI;
			$data['data'][$key]->Keterangan = '<center><a target="_blank" href="'.ROOT."einvoice/reporting/laporan_ematerai_excel/".$data['data'][$key]->BULAN.'">Excel</a> | <a target="_blank" href="'.ROOT."einvoice/reporting/cetak_emateraidetail/".$data['data'][$key]->BULAN.'">PDF</a> |  <a targe="_blank" href="'.ROOT."einvoice/reporting/laporan_ematerai_excel_summary/".$data['data'][$key]->BULAN.'">Summary</a></center>';
			$num++;
		}
		echo json_encode($data);
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

	public function payment_history()
	{
		$customer_id = $this->session->userdata('customerid_phd');
		
		$app_id = "ebpp_01";
		$user = "ptp";
		$pass = "ptp";
		
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
			if ($varfile=='booking_ship_upload_dom') {
				$varfile='booking_ship_upload';
			}
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
		if($is_shipping == 'Y' && $detail['TERMINAL_ID']<>'T3I' && $detail['TERMINAL_ID']<>'PNJI'){
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
					Request Anda dengan Nomor Request ".$req."/".$results["BILLER_REQUEST_ID"]." telah ditolak dengan alasan berikut:\n
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

	public function create_truck_registration() {

		$this->redirect();
		//$customer_id=$this->session->userdata('customerid_phd');
		//$customername_id=$this->session->userdata('customername_phd');
		//$address=$this->session->userdata('address_phd');
		

		
		//$result=$this->container_model->getNumberRequest($customer_id,'PTKM01');
		//create table
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>Customer Name</th>",
		  "<th width='100px'>Truck ID</th>",
		  "<th width='100px'>Truck Number</th>",
		  "<th width='100px'>RFID Code</th>",
		  "<th width='100px'>Jenis Kendaraan</th>",
		  "<th width='100px'>Tanggal Berlaku</th>",
		  "<th width='50px'>VIEW</th>",
		  "<th width='50px'>EDIT</th>",
		  //"<th width='50px'>" . get_content($this->user_model,"delivery","cancel") . "</th>",
		  "<th width='80px'>DELETE"
		 );

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		//$customer_id=$this->session->userdata('customerid_phd');
		
		$result = $this->user_model->get_idPCH($this->session->userdata('sub_group_phd'));
		$id_port =  implode(', ', array_map(function ($result) {
					  return $result['ID_PORT'];
					}, $result));
		$id_company =  implode(', ', array_map(function ($result) {
					  return $result['ID_COMPANY'];
					}, $result));
		$id_holding =  implode(', ', array_map(function ($result) {
					  return $result['ID_HOLDING'];
					}, $result));
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_customer>$customer_id</id_customer>
						</data>
					</root>";
		
		$stack = array();
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getTruckReg",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);

			if($obj->data->listreq)
			{

				$i=1;
					
					for($i=0;$i<count($obj->data->listreq);$i++)
					{
						//echo $obj->data->listreq[$i]->ID_SERVICETYPE;
					
					$label_span='<span class="label label-default">N/A</span>';
					//$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					$view_link ='<span class="label label-default">N/A</span>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link='<span class="label label-default">N/A</span>';
					$cancel_link='<span class="label label-default">N/A</span>';
					$confirm_link='<span class="label label-default">N/A</span>';

						$label_span='<span class="label label-info">Draft</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/edit_tid/".$obj->data->listreq[$i]->TID.'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/cancel_tid/".$obj->data->listreq[$i]->TID.'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';


					$this->table->add_row(
						$i+1,
						$obj->data->listreq[$i]->NAME,
						$obj->data->listreq[$i]->TID,
						$obj->data->listreq[$i]->TRUCK_NUMBER,
						$obj->data->listreq[$i]->PROXIMITY,
						$obj->data->listreq[$i]->KEND_TYPE,
						$obj->data->listreq[$i]->TGL_BERLAKU,
						$view_link,
						$edit_link,
						$cancel_link
						//$confirm_link
					);
				}
		 	} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		} 

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Truck Service", '/container/main_delivery');
		$this->breadcrumbs->push("Input Truck ID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Truck ID Registration";	

		$this->common_loader($data,'pages/om/truck_reg');
	}

	public function edit_tca($no_request,$message=null){

		$this->redirect();

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));		
				
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<request_id>$no_request</request_id>
				<port_code>".$data['request_data'][0]['PORT_ID']."</port_code>
				<terminal_code>".$data['request_data'][0]['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getEditTCA",array("in_data" => "$in_data"),$result))
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
				$data['request_data'][0]['BL_NUMBER'] = $obj->data->request[0]->bl_number;
				$data['request_data'][0]['VESSEL'] = $obj->data->request[0]->vessel;
				$data['request_data'][0]['VOYAGE_IN'] = $obj->data->request[0]->voyage_in;
				$data['request_data'][0]['VOYAGE_OUT'] = $obj->data->request[0]->voyage_out;
				$data['request_data'][0]['CUSTOMER_ID'] = $obj->data->request[0]->id_customer;
				$data['request_data'][0]['CUSTOMER_NAME'] = $obj->data->request[0]->customer_name;
				$data['request_data'][0]['BL_DATE'] = $obj->data->request[0]->bl_date;
				$data['request_data'][0]['TON'] = $obj->data->request[0]->ton;
				$data['request_data'][0]['QTY'] = $obj->data->request[0]->qty;
				$data['request_data'][0]['PKG_NAME'] = $obj->data->request[0]->pkg_name;
				$data['request_data'][0]['HS_CODE'] = $obj->data->request[0]->hs_code;
				$data['request_data'][0]['ID_SERVICETYPE'] = $obj->data->request[0]->id_servicetype;
				$data['request_data'][0]['SERVICE_TYPE'] = $obj->data->request[0]->service_type;
				$data['request_data'][0]['E_I'] = $obj->data->request[0]->ei;
				$data['request_data'][0]['ID_VVD'] = $obj->data->request[0]->id_vvd;
				//$data['request_data'][0]['ID_PORT'] = $data['request_data'][0]['PORT_ID'];
				//$data['request_data'][0]['ID_TERMINAL'] = $data['request_data'][0]['TERMINAL_ID'];			
			}
		}

		$data['message'] = $message;

		$data['terminal'] = $this->master_model->get_terminal();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Request TCA", '/container/main_delivery');
		$this->breadcrumbs->push("Edit Request TCA", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Edit Request TCA";

		$this->common_loader($data,'pages/om/edit_tca');
	}
	
		public function edit_tid($tid){

		$this->redirect();

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));		
				
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<tid>$tid</tid>
				<port_code>".$data['request_data'][0]['PORT_ID']."</port_code>
				<terminal_code>".$data['request_data'][0]['TERMINAL_ID']."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getEditTID",array("in_data" => "$in_data"),$result))
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

				$data['request_data'][0]['TID'] = $obj->data->request[0]->tid;
				$data['request_data'][0]['TRUCK_NUMBER'] = $obj->data->request[0]->truck_number;
				$data['request_data'][0]['COMPANY_NAME'] = $obj->data->request[0]->company_name;
				$data['request_data'][0]['COMPANY_ADDRESS'] = $obj->data->request[0]->company_address;
				$data['request_data'][0]['EXPIRED_DATE'] = $obj->data->request[0]->expired_date;
				$data['request_data'][0]['PROXIMITY'] = $obj->data->request[0]->proximity;
				$data['request_data'][0]['REGISTRANT_ID'] = $obj->data->request[0]->registrant_id;
				$data['request_data'][0]['ID_TRUCK'] = $obj->data->request[0]->id_truck;
				$data['request_data'][0]['KENDARAAN_TYPE'] = $obj->data->request[0]->kendaraan_type;		
			}
		}

		$data['message'] = $message;

		$data['terminal'] = $this->master_model->get_terminal();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("TID Registration", 'truck/create_truck_registration');
		$this->breadcrumbs->push("Edit TID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Edit TID";

		$this->common_loader($data,'pages/om/edit_tid');
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

	public function auto_truck_number(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$term			= $_GET["term"];

		$port			= explode("-",$_GET["port"]);


		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<tid>$term</tid>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
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
				for($i=0;$i<count($obj->data->container);$i++)
				{
					$temp;
					$temp['TID']=$obj->data->container[$i]->tid;
					$temp['TRUCK_NUMBER']=$obj->data->container[$i]->truck_number;
					$temp['RFID_CODE']=$obj->data->container[$i]->rfid_code;
					$temp['COMPANY_NAME']=$obj->data->container[$i]->company_name;
					$temp['ID_TRUCK']=$obj->data->container[$i]->id_truck;
					array_push($stack, $temp);
				}
			}
		}
		echo json_encode($stack);
	}

	public function create_register_id() {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_delivery-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$truck_number=$_POST["TRUCK_NUMBER"];
		$truck_id=$_POST["TRUCK_ID"];
		$rfid_code=$_POST["RFID_CODE"];
		$customer_id=$_POST["CUSTOMER_ID"];
		$customer_name=$_POST["CUSTOMER_NAME"];
		$address=$_POST["CUSTOMER_ADDRESS"];
		$kend_type=$_POST["KEND_TYPE"];
		$tgl=$_POST["TANGGAL"];

		if($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

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
						<customer_id>$customer_id</customer_id>
						<customer_name>$customer_name</customer_name>
						<address>$address</address>
						<truck_number>$truck_number</truck_number>
						<truck_id>$truck_id</truck_id>
						<rfid_code>$rfid_code</rfid_code>
						<kend_type>$kend_type</kend_type>
						<tgl>$tgl</tgl>
					</data>
				</root>";
				//print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"createRegisterTID",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
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
	
	public function update_register_id() {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_delivery-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$truck_number=$_POST["TRUCK_NUMBER"];
		$truck_id=$_POST["TRUCK_ID"];
		$rfid_code=$_POST["RFID_CODE"];
		$customer_id=$_POST["CUSTOMER_ID"];
		$customer_name=$_POST["CUSTOMER_NAME"];
		$address=$_POST["CUSTOMER_ADDRESS"];
		$kend_type=$_POST["KEND_TYPE"];
		$tgl=$_POST["TANGGAL"];

		if($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

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
						<customer_id>$customer_id</customer_id>
						<customer_name>$customer_name</customer_name>
						<address>$address</address>
						<truck_number>$truck_number</truck_number>
						<truck_id>$truck_id</truck_id>
						<rfid_code>$rfid_code</rfid_code>
						<kend_type>$kend_type</kend_type>
						<tgl>$tgl</tgl>
					</data>
				</root>";
				//print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"updateRegisterTID",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
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

	
		public function cancel_tid($tid) {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_delivery-----------------------------');
		
		
		//$port=explode("-",$_POST["TERMINAL"]);
		//$truck_number=$_POST["TRUCK_NUMBER"];
		//$truck_id=$_POST["TRUCK_ID"];
		//$rfid_code=$_POST["RFID_CODE"];
		$customer_id=$this->session->userdata('customerid_phd');
		$customer_name=$this->session->userdata('customername_phd');
		$address=$this->session->userdata('address_phd');


			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
				$address = base64_encode($address);
				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<truck_id>$tid</truck_id>
					</data>
				</root>";
				//print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"delRegisterTID",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);

					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						
						echo "<script type='text/javascript'>
        alert('Penghapusan TID Berhasil');
        location = '".ROOT."om/truck/create_truck_registration';
      </script>";
					//header("Location: ".ROOT."om/truck/create_truck_registration");
					
					//die();
						//die();
						
					} else {
						echo "NO,GAGAL";
					}
					
				}
		
	}

	public function add_detail_truck(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		$port=explode("-",$_POST["TERMINAL"]);
		$no_req=$_POST["NO_REQUEST"];
		$tid=$_POST["TID"];
		$truck_number=$_POST["TRUCK_NUMBER"];
		$bl_number=$_POST["BL_NUMBER"];
		$truck_company=$_POST["TRUCK_COMPANY"];
		$rfid_code=$_POST["RFID_CODE"];
		$ei=$_POST["EI"];
		$id_vvd=$_POST["ID_VVD"];
		$id_servicetype=$_POST["ID_SERVICETYPE"];
		$service_type=$_POST["SERVICE_TYPE"];
		$id_truck=$_POST["ID_TRUCK"];

		$stack = array();
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
					<no_req>$no_req</no_req>
					<tid>$tid</tid>
					<truck_number>$truck_number</truck_number>
					<bl_number>$bl_number</bl_number>
					<truck_company>$truck_company</truck_company>
					<rfid_code>$rfid_code</rfid_code>
					<ei>$ei</ei>
					<id_vvd>$id_vvd</id_vvd>
					<id_servicetype>$id_servicetype</id_servicetype>
					<service_type>$service_type</service_type>
					<id_truck>$id_truck</id_truck>
				</data>
			</root>";
			injek($in_data);
			if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"addDetailTCA",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//echo $result;die();
				
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

	public function del_tca(){
		$port=explode("-",$_POST["TERMINAL"]);
		$tid=$_POST["TID"];
		$no_request=$_POST["NO_REQUEST"];
		$id_vvd=$_POST["ID_VVD"];
		$bl_number=$_POST["BL_NUMBER"];
		$id_truck=$_POST["ID_TRUCK"];
		
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
					<tid>$tid</tid>
					<no_request>$no_request</no_request>
					<bl_number>$bl_number</bl_number>
				</data>
			</root>";
			
			//echo $in_data;
			//die();
			if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"delDetailTCA",array("in_data" => "$in_data"),$result))
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

	public function get_detail_truck($type,$no_req){
		if($type=="add" || $type=="edit"){
			//create table
			$this->table->set_heading('No','Hapus','TCA TRUCK ID','TCA TRUCK NUMBER', 'TCA TRUCK COMPANY','PROXIMITY');
		} else {
			//create table
			$this->table->set_heading('No','Hapus','TCA TRUCK ID','TCA TRUCK NUMBER', 'TCA TRUCK COMPANY','PROXIMITY');
		}

		$stack = array();
        $port = explode("-",$terminal);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_req</no_request>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getDetailTCA",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result); //var_dump($obj);die();
			if($obj->data->container)
			{
				for($i=0;$i<count($obj->data->container);$i++)
				{
					if($type=="add" || $type=="edit"){
						$this->table->add_row(
							$i+1,
							'<a class="btn btn-primary" onclick="delete_container(\''.$obj->data->container[$i]->tca_truck_id.'\')"><i class="fa fa-trash-o"></i></a>',
							$obj->data->container[$i]->tca_truck_id,
							$obj->data->container[$i]->tca_truck_number,
							$obj->data->container[$i]->tca_truck_company,
							$obj->data->container[$i]->proximity
						);
					} else {
						$this->table->add_row(
							$i+1,
							$obj->data->container[$i]->tca_truck_id,
							$obj->data->container[$i]->tca_truck_number,
							$obj->data->container[$i]->tca_truck_company,
							$obj->data->container[$i]->proximity
						);
					}
				}
			}
		}

		$data['type']=$type;
		$this->load->view('pages/om/get_detail_truck', $data);
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

}

class MyCustomPDFWithWatermark extends TCPDF {
        public function Footer() {
	        // Position at 15 mm from bottom
	        $this->SetY(-15);
	        // Set font
	        // $this->SetFont('helvetica', 'I', 8);
	        // Page number
	        $this->Cell(0, 10, '', 0, false, 'L', 0, '', 0, false, 'T', 'M');
	        $this->SetFont('helvetica', 'I', 8);
	        $this->Cell(0, 10, "Print Date : ".date("d-M-Y H:i:s").' | Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	    }
    }

?>