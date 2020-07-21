<?php
/*
Nama Controller 	: nota_cabang.php
Ditulis oleh 		: SIGMA
Tanggal Penulisan 	: 27 September 2019
*/

date_default_timezone_set('Asia/Bangkok');
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//session_start();
require APPPATH.'helpers/tcpdf/tcpdf.php';
class Nota_cabang extends CI_Controller
{
    public $API = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('custom');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('auth_model', 'auth_model');
        $this->load->model('auth_model');
        $this->load->model('user_model');
        $this->load->model('master_model');
        $this->load->model('container_model');
        $this->load->library('Nusoap_lib');
        $this->load->library('table');
        $this->load->library('commonlib');
        $this->load->library('ciqrcode');
        $this->load->library('MX_Encryption');
        $this->load->helper('MY_language_helper');
        $this->load->library('breadcrumbs');
        require_once APPPATH.'libraries/mime_type_lib.php';
        require_once APPPATH.'libraries/htmLawed.php';

        $this->API = API_EINVOICE;
    }

    protected function getdataurl($url)
    {
        $uri = API_EINVOICE.'/'.$url;
        $apiKey = '123456';
        $params = array(
            'Content-Type: application/json',
            'x-api-key:'.$apiKey,
        );

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
        $ex = curl_exec($ch);
        $data = json_decode($ex);
        return $data;
    }

    protected function senddataurl($url, $data, $type)
    {
        $uri = API_EINVOICE.'/'.$url;
        $apiKey = '123456';
        $params = array(
            'Content-Type: application/x-www-form-urlencoded',
            'x-api-key:'.$apiKey,
        );

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        $ex = curl_exec($ch);
        $result = json_decode($ex);
        file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
            array(
                'body' => $ex,
                'url' => $uri,
                'data' => $data,
            ), true), FILE_APPEND);

        return $result;
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

    public function usaha_terminal() {
        $role_id = $this->session->userdata('role_id');
        $data['layanan'] = $this->auth_model->get_layanan($role_id);
        $this->common_loader($data, 'invoice/nota/usaha_terminal/notainvoiceusaha_terminal');
    }

    public function ustersearch(){
        $postdata = ($_POST);
        $postdata["BRANCH_CODE"] = $this->session->userdata('unit_id');
        $postdata["ORG_ID"]      = $this->session->userdata('unit_org');
        $start      = !empty($_POST['start']) ? $_POST['start'] : 0;
        $length     = !empty($_POST['length']) ? $_POST['length'] : 10;
        $draw       = !empty($_POST['draw']) ? $_POST['draw'] : 0;
        $postdata["offset"]      = $start + $length;
        $postdata["orderby"]     = !empty($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
        $postdata["ordertype"]   = !empty($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';

        $arrayData = $this->senddataurl('nota_cabang/datatable/',$postdata,'POST');
        $data = array(
            'data' => array()
        );
        //print_r($arrayData);die();
        $num = 0;
        foreach ($arrayData->data as $key => $value) {
            if($value->STATUS!="1"){
                //cetak nota
                $data['data'][$num] = $value;
                $statusL = "BELUM LUNAS";
                if (isset($value->STATUS_LUNAS) && $value->STATUS_LUNAS == "Y") {
                    $statusL = "LUNAS";
                } else if (isset($value->STATUS_LUNAS) && $value->STATUS_LUNAS == "X") {
                    $statusL = "KOREKSI";
                }
                $cetak = "";
                if (intval($value->STATUS_CETAK) > 0) {
                    $cetak = "checked";
                }

                $data['data'][$key]->PC = "<input type=checkbox style='width:20px;height:20px' disabled $cetak>";
                $data['data'][$key]->STATUS_LUNAS = $statusL;

                $enc_trx_number = $this->mx_encryption->encrypt($value->TRX_NUMBER);
                $keterangan2    = '<a target="_blank" class="btn btn-primary" href="'.ROOT.'einvoice/nota_cabang/priview_nota/UST/'.$enc_trx_number.'"><i class="fa fa-print" ></i> Cetak</a>';
                $data['data'][$num]->action2 = $keterangan2;
                $data['data'][$key]->jumlah = "<div align='right'>" . (strpos($value->AMOUNT, ",") == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT . "</div>";
                $data['data'][$num]->RNUM = ($_POST['start']+ $num+1);
                $num++;
            }

        }

        $dataTableArr = array(
            "draw"            => intval( $draw ),
            "recordsTotal"    => intval( $arrayData->recordsTotal ),
            "recordsFiltered" => intval( $arrayData->recordsTotal ),
        );
        $dataTableArr = array_merge($dataTableArr,$data);
        echo json_encode($dataTableArr);
    }

    public function priview_nota($layanan=null,$noNota=null){
        $this->load->helper('pdf_helper');
        tcpdf();
        $this->load->helper('nota_invoice_helper');
        $id = $this->mx_encryption->decrypt($noNota);

        $postdata["NO_NOTA"]      = $id;
        $postdata["KODE_LAYANAN"] = $layanan;

        // START Get Data Header
        $data = $this->senddataurl('ReviewHeaderUster/',$postdata,'POST');
        $postdata['NO_REQUEST']         = $data[0]->NO_REQUEST;
        $postdata['HEADER_SUB_CONTEXT'] = $data[0]->HEADER_SUB_CONTEXT;
        $ORG_ID      = $data[0]->ORG_ID;//85;
        $BRANCH_CODE = $data[0]->BRANCH_CODE;//PLG;
        // STOP Get Data Header

        // START Get Data Lines
        $data_detail = $this->senddataurl('ReviewDetailUster',$postdata,'POST');
        //var_dump($data_detail);die;
        // STOP Get Data Lines

        // START Update Pernah Cetak
        $paramStatus['BILLER_REQUEST_ID'] = $id;
        $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');
        // STOP Update Pernah Cetak

        // START Barcode
        $url_enc = 'einvoice/nota_cabang/priview_nota/UST/' . $noNota;
        $params['data']     = ROOT . $url_enc;
        $params['level']    = 'H';
        $params['size']     = 10;
        $randomfilename     = rand(1000, 9999);
        $params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
        $this->ciqrcode->generate($params);
        $barcode_location   = APP_ROOT . "qr_code/" . $randomfilename . ".png";
        $ttd_location       = APP_ROOT . "config/images/cr/ttd2.png";
        // STOP Barcode

        //$nmLayanan   = ($data[0]->HEADER_SUB_CONTEXT == 'UST02' ? 'RECEIVING' : ($data[0]->HEADER_SUB_CONTEXT == 'UST04' ? 'STUFFING' : ($data[0]->HEADER_SUB_CONTEXT == 'UST13' ? 'RECEIVING DELIVERY' : false)));
        $nmLayanan   = ($data[0]->HEADER_SUB_CONTEXT == 'UST02' ? 'RECEIVING' : ($data[0]->HEADER_SUB_CONTEXT == 'UST04' ? 'STUFFING' : ($data[0]->HEADER_SUB_CONTEXT == 'UST13' ? 'RECEIVING DELIVERY' : false)));        
		$repRequest  = preg_replace("/[^a-zA-Z]/", "", $data[0]->NO_REQUEST);

        $output_name = "LAPORAN PDF NOTA".'_'.$noNota.'.pdf';
        define('noNotaFooter', $id);

        $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle($data[0]->NO_NOTA);
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(12, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setLanguageArray(null);
        $pdf->SetHeaderMargin(false);
        $pdf->SetTopMargin(5);
        $pdf->SetFooterMargin(20);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011',PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();

        $data2          = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_ORGID"=>$ORG_ID, "INV_UNIT_CODE"=>$BRANCH_CODE),'POST');
        $data_header    = $this->getdataurl('invh/pdf/USAHA_TERMINAL/'. $id);
        $entityId       = $data_header->INV_ENTITY_ID;
        if($entityId!=""){
			$dataPost2 = array("TRX_NUMBER"=>$id);
            //$entity = $this->senddataurl('entity/search',$dataPost,'POST');
			$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksiHist',$dataPost2,'POST');
			if(count($redaksi)>0){
				$redaksi = ($redaksi[0]->INV_REDAKSI=='')?"-":$redaksi[0]->INV_REDAKSI;
			}else{
				$redaksi = "-";
			}	
			/*
            $dataPost = array("INV_ENTITY_ID"=>$entityId);
            $entity = $this->senddataurl('entity/search',$dataPost,'POST');
            if(count($entity)>0){
                $dataPost2 = array("INV_ENTITY_ID"=>$entityId);
                $redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi',$dataPost2,'POST');
                if(count($redaksi)>0){
                    $redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI=='')?"-":$redaksi[0]->INV_EMATERAI_REDAKSI;
                }else{
                    $redaksi = "-";
                }
            }
			*/
        }

        $faktur_note    = $data_header->INV_FAKTUR_NOTE;
        $pejabat 	    = $data_header->INV_PEJABAT_NAME;
        $nip_pejabat    = $data_header->INV_PEJABAT_NIPP;
        $ttd_pejabat    = $data_header->INV_PEJABAT_TTD;
        $unit_wilayah 	= $data_header->INV_UNIT_NAME;
        $alamat_wilayah = $data_header->INV_UNIT_ALAMAT;
        $amountMaterai  = $data[0]->AMOUNT_MATERAI;
        $status_lunas   = $data[0]->STATUS_LUNAS;
        $tgl_nota       = $data[0]->TRX_DATE;

        $header_nota = array(
            "faktor_note", $faktur_note,
            "status_lunas"=>$data[0]->STATUS_LUNAS,
            "e_logo"=>$data2[0]->INV_ENTITY_LOGO,
            "e_name"=>$data2[0]->INV_ENTITY_NAME,
            "e_cabang"=>$data2[0]->INV_UNIT_NAME,
            "num"=>$data[0]->TRX_NUMBER,
            "e_address"=>$data2[0]->INV_ENTITY_ALAMAT,
            "tgl_nota"=>$tgl_nota,
            "bag"=>$data[0]->HEADER_CONTEXT,
            "e_npwp"=>$data2[0]->INV_ENTITY_NPWP,
            "e_faktur"=>$faktur_note);

        // Start Watermark
        $Watermark = format_nota($header_nota);
        $pdf       = $Watermark[0];
        // Stop Watermark

        // Start Header
        $header   = header_notaCab($header_nota);
        // Stop Header

        $judul    = '';
        $judul = '<table>
                <tr>
	                <td COLSPAN="2" align="right" style="height:15px; line-height:15px;"></td>
                </tr>
				<tr>
	                <td COLSPAN="2" style="font-family: gothamb;font-size: 14px;font-weight: 900;text-align:center;background-color:#ff4000;color:white;height:22px;line-height: 24px;"><b>NOTA DAN PERHITUNGAN JASA</b></td>
				</tr>
				<tr>
				    <td COLSPAN="2" align="center" style="line-height: 24px;">KEGIATAN '.$nmLayanan.'</td>
				</tr>				
	        </table>';

        $lampiran_ = "";
        if($repRequest == "STF" || $repRequest == "SFP") {
           $lampiran_ .= '<tr>
                            <td COLSPAN="2" align="left" width="110px">Kade</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">'.$data[0]->KADE.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">No I BPR/BL/DO</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">-/0405/'.$data[0]->NO_BL.'/'.$data[0]->NO_DO.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">Kapal/Voy/Tgl</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">'.$data[0]->NM_KAPAL.'/'.$data[0]->VOYAGE.'/'.$data[0]->TGL_JAM_BERANGKAT.'/ '.$data[0]->PELABUHAN_TUJUAN.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">Jenis Perdagangan</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">- </td>
                        </tr>';
        } else {
            $lampiran_ .= '<tr>
                            <td COLSPAN="2" align="left" width="110px">No. Doc</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">'.$data[0]->NO_REQUEST.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="10px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="200px">&nbsp;</td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="10px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="200px">&nbsp;</td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="10px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="200px">&nbsp;</td>
                        </tr>';
        }

        $lampiran = '';
        $lampiran = '<table>
        			<tr>
	                    <td COLSPAN="2"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="5" width="350px">
		                    <table>
	        					<tr>
	        						<td COLSPAN="2" align="left" width="70px">Perusahaan</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_NAME.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="70px">Pemilik</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_NUMBER.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="70px">Alamat</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_ADDRESS.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="70px">NPWP</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_NPWP.'</td>
	        					</tr>
	        					<tr>
		        					<td COLSPAN="2" align="left" width="70px"></td>
									<td COLSPAN="1" align="left" width="10px"></td>
				                    <td COLSPAN="2" align="left" width="300px"></td>
	        					</tr>
		                    </table>
        				</td>
	                    <td COLSPAN="5">
		                    <table>
		                    ' . $lampiran_ . '
		                    </table>
	                    </td>
                	</tr>';

        $tbl = '';
        if($data[0]->HEADER_SUB_CONTEXT=="UST04"){
            $tbl = '<table>
	            <tr><td COLSPAN="1" style="height:30px;line-height: 30px;font-size: 11px;font-family: franklingothicbook;"></td></tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px">&nbsp;</td>
	                <td COLSPAN="2"><b>Jenis Jasa</b>&nbsp; :</td>
                </tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="height:30px;line-height: 30px;font-size: 11px;font-family: franklingothicbook;" width="100px">&nbsp;</td>
	                <td COLSPAN="2">JML x SIZE : ' . $data_detail->query[0]->JUM_CONT . ' x ' . $data_detail->query[0]->SIZE_ . '</td>
	            </tr>';

                if($repRequest == "STF") {
                    $uang_jasa = $data[0]->TAGIHAN;
                    $ppn       = $data[0]->PPN;
                    $materai   = $data[0]->AMOUNT_MATERAI;
                    $jumlah    = $data[0]->AMOUNT;
                    $terbilang = $data[0]->AMOUNT_TERBILANG;
                    $width     = "240px";
                    $widthr    = "265x";
                    $keterangan = $data_detail->queryKet[0]->KETERANGAN == 'TRUCK' ? 'TRUCK' : 'TONGKANG';
                    $tbl .= '<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Pass Retribusi &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="140px"> ' . $data_detail->query[0]->JUM_CONT . 'x ' . $data_detail->query[0]->PASS_RETRIBUSI . ' = &nbsp; &nbsp; </td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px"> ' . $data_detail->query[0]->PASS_RETRIBUSI . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Jasa Stuffing via ' . $keterangan . ' &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="140px"> ' . $data_detail->query[0]->JUM_CONT . '(' . $data_detail->query[0]->SIZE_ . ') x ' . $data_detail->query[0]->JASA_STUFFING . ' = &nbsp; &nbsp; </td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px"> ' . $data_detail->query[0]->JASA_STUFFING . '</td>
                        </tr>';
                } else if($repRequest == "SFP") {
                    $uang_jasa = $data[0]->TAGIHAN;
                    $ppn       = $data[0]->PPN;
                    $materai   = $data[0]->AMOUNT_MATERAI;
                    $jumlah    = $data[0]->AMOUNT;
                    $terbilang = $data[0]->AMOUNT_TERBILANG;
                    $width     = "420px";
                    $widthr    = "450px";
                    for ($i=0; $i < count($data_detail->query); $i++) {
                        $data       = ($i+1) == '1' ? 'Perpanjangan Penumpukkan MTY' : '';
                        $keterangan = $data_detail->query[$i]->KETERANGAN == 'MATERAI' ? '' : $data_detail->query[$i]->KETERANGAN;
                        $tbl .= '<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">'.$data.'</td>';
                        if($data_detail->query[$i]->KETERANGAN != 'MATERAI') {
                            $tbl .= '<td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: </td>
                                <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="180px"> &nbsp; ' . $keterangan . ' &nbsp; &nbsp; </td>
                                <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="140px"> : ' . $data_detail->query[$i]->JUM_CONT . ' (' . $data_detail->query[$i]->SIZE_ . '") x ' . $data_detail->query[$i]->JML_HARI . ' x ' . $data_detail->query[$i]->TARIF . ' = &nbsp; </td>
                                <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px"> ' . $data_detail->query[$i]->JML . '</td>
                            </tr>';
                        }
                    }
                }

                        $tbl .= '<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Uang Jasa &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $uang_jasa . '</td>
                        </tr>';

                        if($materai == 0) {
                            $tbl.='<tr>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">PPN &nbsp; &nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $ppn . '</td>
                                </tr>';
                        } else {
                            $tbl.='<tr>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">PPN &nbsp; &nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $ppn . '</td>
                                </tr>                                
                                <tr>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Materai &nbsp; &nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $materai . '</td>
                                </tr>';
                        }

                    $tbl.='<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Jumlah &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px"><hr width="'.$widthr.'">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $jumlah.'</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">PPN ditanggung Pemerintah &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> 0</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Jumlah Upper &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> 0</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Piutang &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $jumlah.'</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="80px">Terbilang</td>
                            <td COLSPAN="1" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="10px">:</td>
                            <td COLSPAN="7" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;"> ' . $terbilang.'</td>
                        </tr>
                    </table>';
        } elseif($data[0]->HEADER_SUB_CONTEXT=="UST02"){
            $tbl = '<table>
                <tr><td COLSPAN="1" style="height:30px;line-height: 30px;font-size: 11px;font-family: franklingothicbook;"></td></tr>
                <tr>
                    <td COLSPAN="5" align="left" style="font-size:9px; height:30px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="140px">KETERANGAN</td>
                    <td COLSPAN="2" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TGL AWAL</td>
                    <td COLSPAN="2" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TGL AKHIR</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">BOX</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">SZ</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">TY</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">ST</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;;" width="40px">HZ</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">HR</td>
                    <td COLSPAN="1" align="right" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TARIF</td>
                    <td COLSPAN="1" align="right" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">VAL</td>
                    <td COLSPAN="2" align="right" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">JUMLAH</td>
                </tr>
                <tr><td COLSPAN="1" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;"></td></tr>';

            //if($repRequest == "REC") {
                for ($i=0; $i < count($data_detail->query); $i++) {
                    $data2 = $data_detail->query[$i]->AWAL == '' ? '-' : $data_detail->query[$i]->AWAL;
                    $data3 = $data_detail->query[$i]->AKHIR == '' ? '-' : $data_detail->query[$i]->AKHIR;
                    $data8 = $data_detail->query[$i]->NAD == '' ? '-' : $data_detail->query[$i]->NAD;
                    $data9 = $data_detail->query[$i]->JML_HARI == '' ? '-' : $data_detail->query[$i]->JML_HARI;
                    $keterangan = $data_detail->query[$i]->KETERANGAN == 'MATERAI' ? '' : $data_detail->query[$i]->KETERANGAN;
                    if($data_detail->query[$i]->KETERANGAN != 'MATERAI') {
                        $tbl .= '<tr>
                            <td COLSPAN="5" align="left" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$keterangan.'</td>
                            <td COLSPAN="2" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data2.'</td>
                            <td COLSPAN="2" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data3.'</td>
                            <td COLSPAN="1" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data_detail->query[$i]->JUM_CONT.'</td>
                            <td COLSPAN="1" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data_detail->query[$i]->SIZE_.'</td>
                            <td COLSPAN="1" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data_detail->query[$i]->TYPE_.'</td>
                            <td COLSPAN="1" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data_detail->query[$i]->STATUS.'</td>
                            <td COLSPAN="1" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data8.'</td>
                            <td COLSPAN="1" align="center" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data9.'</td>
                            <td COLSPAN="1" align="right" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data_detail->query[$i]->TARIF.'</td>
                            <td COLSPAN="1" align="right" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">IDR</td>
                            <td COLSPAN="2" align="right" style="font-size:9px; line-height:15px; font-family:franklingothicbook;">'.$data_detail->query[$i]->JML.'</td>
                        </tr>';
                    }
                }
            //}

            $tbl .= '<tr><td COLSPAN="1" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;"></td></tr>
                    <tr>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:15px;" width="659px"><hr></td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:15px;" width="550px">Discount : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:15px;" width="110px">0</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:15px;" width="550px">Administrasi : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:15px;" width="110px">0</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:15px;" width="550px">Dasar Pengenaan Pajak : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:15px;" width="110px"> '.$data[0]->TAGIHAN.'</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:15px;" width="550px">Jumlah PPN : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:15px;" width="110px"> '.$data[0]->PPN.'</td>
                    </tr>';

                if(!$data[0]->AMOUNT_MATERAI == 0) {
                    $tbl.='<tr>
                            <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Materai : &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$amountMaterai.'</td>
                        </tr>';
                }

            $tbl .='<tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Jumlah Dibayar : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data[0]->AMOUNT.'</td>
                    </tr>                    
                    <tr>
                        <td COLSPAN="2" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="80px">Terbilang</td>
                        <td COLSPAN="1" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="10px">:</td>
                        <td COLSPAN="7" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;"> ' . $data[0]->AMOUNT_TERBILANG.'</td>
                    </tr>
                    </table>';
        }

        $ttd_footer ='<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">PALEMBANG, '.$tgl_nota.'</td>
                		</tr>
                		<tr>

		                    <td COLSPAN="2" align="right" width="550px">Manajer Keuangan</td>
                		</tr>
                		<tr>
		                    <td COLSPAN="2" align="left" width="100px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td COLSPAN="2" align="right" width="457px"><img height="100" width="100" src="'.$ttd_location.'" /></td>

                		</tr>
                		<tr>
                			<td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">'.$pejabat.'</td>
                		</tr>

                		<tr>
                			<td COLSPAN="2" align="right" width="545px">NIPP. '.$nip_pejabat.'</td>
                		</tr>
					  </table>';

        $ematerai_nota = array(
            'amountMaterai' => $amountMaterai,
            'redaksi' => $redaksi,
            'status_lunas' => $status_lunas,
            'unit_wilayah' => $unit_wilayah,
            'alamat_wilayah' => $alamat_wilayah,
        );
        $ematerai_nota = ematerai_nota($ematerai_nota);

        /* settingan pdf */
        $pdf->SetFont('gotham', '', 8);
        $pdf->writeHtml($header, true, false, false, false, '');
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($lampiran, true, false, false, false, '');
        $pdf->writeHtml($tbl, true, false, false, false, '');
        $pdf->writeHtml($ttd_footer, true, false, false, false, '');
        $pdf->SetY(260);
        $pdf->writeHtml($ematerai_nota, true, false, false, false, '');
        $pdf->Output($output_name, 'I');
    }

    public function usaha_terminalcreate() {
        $role_id = $this->session->userdata('role_id');
        $data['layanan'] = $this->auth_model->get_layanan($role_id);
        $this->common_loader($data, 'invoice/nota/usaha_terminal/createinvoiceusaha_terminal');
    }

    public function ustersearchcreate(){
        $postdata = ($_POST);
        $postdata["BRANCH_CODE"] = $this->session->userdata('unit_id');
        $postdata["ORG_ID"]      = $this->session->userdata('unit_org');
        $start      = !empty($_POST['start']) ? $_POST['start'] : 0;
        $length     = !empty($_POST['length']) ? $_POST['length'] : 10;
        $draw       = !empty($_POST['draw']) ? $_POST['draw'] : 0;
        $postdata["offset"]      = $start + $length;
        $postdata["orderby"]     = !empty($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
        $postdata["ordertype"]   = !empty($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';

        $arrayData = $this->senddataurl('nota_cabang/datatableCreate/',$postdata,'POST');
        $data = array(
            'data' => array()
        );
        //print_r($arrayData);die();
        $num = 0;
        foreach ($arrayData->data as $key => $value) {
            if($value->STATUS!="1"){
                //cetak nota
                $data['data'][$num] = $value;
                $layanan = '';
                $keterangan = '<a class="btn btn-sm btn-primary btn-sm"  href="javascript:void(0)" onclick="print_usahaterminal(\''.$value->NO_REQUEST.'\',\''.$layanan.'\',\''.$value->BRANCH_ACCOUNT.'\',\''.$value->BRANCH_CODE.'\',\''.$value->CUSTOMER_NAME.'\',\''.$value->ORG_ID.'\')" disabled=""> <i class="fa fa-print"></i> Preview</a>';
                $data['data'][$num]->action2 = $keterangan;
                $data['data'][$key]->jumlah = "<div align='right'>" . (strpos($value->AMOUNT, ",") == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT . "</div>";
                $data['data'][$num]->RNUM = ($_POST['start']+ $num+1);
                $num++;
            }

        }

        $dataTableArr = array(
            "draw"            => intval( $draw ),
            "recordsTotal"    => intval( $arrayData->recordsTotal ),
            "recordsFiltered" => intval( $arrayData->recordsTotal ),
        );
        $dataTableArr = array_merge($dataTableArr,$data);
        echo json_encode($dataTableArr);
    }

    public function priview_create_nota($layanan=null,$noNota=null){
        $this->load->helper('pdf_helper');
        tcpdf();
        $this->load->helper('nota_invoice_helper');

        echo "Belum Ada Data"; die;
        //echo $noNota."|||||".$layanan."|||||".$brancid."|||||".$branccode; die;
        //    $ORG_ID      = $brancid;//85;
        //    $BRANCH_CODE = $branccode;//PLG;

        $id = $this->mx_encryption->decrypt($noNota);

        $postdata["NO_NOTA"]      = $id;
        $postdata["KODE_LAYANAN"] = $layanan;

        // START Get Data Header
        $data = $this->senddataurl('ReviewHeaderUster/',$postdata,'POST');
        $postdata['NO_REQUEST']         = $data[0]->NO_REQUEST;
        $postdata['HEADER_SUB_CONTEXT'] = $data[0]->HEADER_SUB_CONTEXT;
        $ORG_ID      = $data[0]->ORG_ID;//85;
        $BRANCH_CODE = $data[0]->BRANCH_CODE;//PLG;
        // STOP Get Data Header

        // START Get Data Lines
        $data_detail = $this->senddataurl('ReviewDetailUster',$postdata,'POST');
        //var_dump($data_detail);die;
        // STOP Get Data Lines

        // START Update Pernah Cetak
        $paramStatus['BILLER_REQUEST_ID'] = $id;
        $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');
        // STOP Update Pernah Cetak

        // START Barcode
        $url_enc = 'einvoice/nota_cabang/priview_nota/UST/' . $noNota;
        $params['data']     = ROOT . $url_enc;
        $params['level']    = 'H';
        $params['size']     = 10;
        $randomfilename     = rand(1000, 9999);
        $params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
        $this->ciqrcode->generate($params);
        $barcode_location   = APP_ROOT . "qr_code/" . $randomfilename . ".png";
        $ttd_location       = APP_ROOT . "config/images/cr/ttd2.png";
        // STOP Barcode

        $nmLayanan   = ($data[0]->HEADER_SUB_CONTEXT == 'UST02' ? 'RECEIVING' : ($data[0]->HEADER_SUB_CONTEXT == 'UST04' ? 'STUFFING' : ($data[0]->HEADER_SUB_CONTEXT == 'UST13' ? 'RECEIVING DELIVERY' : false)));
        $repRequest  = preg_replace("/[^a-zA-Z]/", "", $data[0]->NO_REQUEST);

        $output_name = "LAPORAN PDF NOTA".'_'.$noNota.'.pdf';
        define('noNotaFooter', $id);

        $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle($data[0]->NO_NOTA);
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(12, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setLanguageArray(null);
        $pdf->SetHeaderMargin(false);
        $pdf->SetTopMargin(5);
        $pdf->SetFooterMargin(20);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011',PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();

        $data2          = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_ORGID"=>$ORG_ID, "INV_UNIT_CODE"=>$BRANCH_CODE),'POST');
        $data_header    = $this->getdataurl('invh/pdf/USAHA_TERMINAL/'. $id);
        $entityId       = $data_header->INV_ENTITY_ID;
        if($entityId!=""){
            $dataPost = array("INV_ENTITY_ID"=>$entityId);
            $entity = $this->senddataurl('entity/search',$dataPost,'POST');
            if(count($entity)>0){
                $dataPost2 = array("INV_ENTITY_ID"=>$entityId);
                $redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi',$dataPost2,'POST');
                if(count($redaksi)>0){
                    $redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI=='')?"-":$redaksi[0]->INV_EMATERAI_REDAKSI;
                }else{
                    $redaksi = "-";
                }
            }
        }

        $faktur_note    = $data_header->INV_FAKTUR_NOTE;
        $pejabat 	    = $data_header->INV_PEJABAT_NAME;
        $nip_pejabat    = $data_header->INV_PEJABAT_NIPP;
        $ttd_pejabat    = $data_header->INV_PEJABAT_TTD;
        $unit_wilayah 	= $data_header->INV_UNIT_NAME;
        $alamat_wilayah = $data_header->INV_UNIT_ALAMAT;
        $amountMaterai  = $data[0]->AMOUNT_MATERAI;
        $status_lunas   = $data[0]->STATUS_LUNAS;
        $tgl_nota       = $data[0]->TRX_DATE;

        $header_nota = array(
            "faktor_note", $faktur_note,
            "status_lunas"=>$data[0]->STATUS_LUNAS,
            "e_logo"=>$data2[0]->INV_ENTITY_LOGO,
            "e_name"=>$data2[0]->INV_ENTITY_NAME,
            "e_cabang"=>$data2[0]->INV_UNIT_NAME,
            "num"=>$data[0]->TRX_NUMBER,
            "e_address"=>$data2[0]->INV_ENTITY_ALAMAT,
            "tgl_nota"=>$tgl_nota,
            "bag"=>$data[0]->HEADER_CONTEXT,
            "e_npwp"=>$data2[0]->INV_ENTITY_NPWP,
            "e_faktur"=>$faktur_note);

        // Start Watermark
        $Watermark = format_nota($header_nota);
        $pdf       = $Watermark[0];
        // Stop Watermark

        // Start Header
        $header   = header_notaCab($header_nota);
        // Stop Header

        $judul    = '';
        $judul = '<table>
                <tr>
	                <td COLSPAN="2" align="right" style="height:15px; line-height:15px;"></td>
                </tr>
				<tr>
	                <td COLSPAN="2" style="font-family: gothamb;font-size: 14px;font-weight: 900;text-align:center;background-color:#ff4000;color:white;height:22px;line-height: 24px;"><b>NOTA DAN PERHITUNGAN JASA</b></td>
				</tr>
				<tr>
				    <td COLSPAN="2" align="center" style="line-height: 24px;">KEGIATAN '.$nmLayanan.'</td>
				</tr>				
	        </table>';

        $lampiran_ = "";
        if($repRequest == "STF" || $repRequest == "SFP") {
            $lampiran_ .= '<tr>
                            <td COLSPAN="2" align="left" width="110px">Kade</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">'.$data[0]->KADE.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">No I BPR/BL/DO</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">-/0405/'.$data[0]->NO_BL.'/'.$data[0]->NO_DO.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">Kapal/Voy/Tgl</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">'.$data[0]->NM_KAPAL.'/'.$data[0]->VOYAGE.'/'.$data[0]->TGL_JAM_BERANGKAT.'/ '.$data[0]->PELABUHAN_TUJUAN.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">Jenis Perdagangan</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">- </td>
                        </tr>';
        } else {
            $lampiran_ .= '<tr>
                            <td COLSPAN="2" align="left" width="110px">No. Doc</td>
                            <td COLSPAN="2" align="left"  width="10px">:</td>
                            <td COLSPAN="2" align="left"  width="200px">'.$data[0]->NO_REQUEST.' </td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="10px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="200px">&nbsp;</td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="10px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="200px">&nbsp;</td></tr>
                        <tr>
                            <td COLSPAN="2" align="left" width="110px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="10px">&nbsp;</td>
                            <td COLSPAN="2" align="left"  width="200px">&nbsp;</td>
                        </tr>';
        }

        $lampiran = '';
        $lampiran = '<table>
        			<tr>
	                    <td COLSPAN="2"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="5" width="350px">
		                    <table>
	        					<tr>
	        						<td COLSPAN="2" align="left" width="70px">Perusahaan</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_NAME.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="70px">Pemilik</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_NUMBER.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="70px">Alamat</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_ADDRESS.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="70px">NPWP</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="300px">'.$data[0]->CUSTOMER_NPWP.'</td>
	        					</tr>
	        					<tr>
		        					<td COLSPAN="2" align="left" width="70px"></td>
									<td COLSPAN="1" align="left" width="10px"></td>
				                    <td COLSPAN="2" align="left" width="300px"></td>
	        					</tr>
		                    </table>
        				</td>
	                    <td COLSPAN="5">
		                    <table>
		                    ' . $lampiran_ . '
		                    </table>
	                    </td>
                	</tr>';

        $tbl = '';
        if($data[0]->HEADER_SUB_CONTEXT=="UST04"){
            $tbl = '<table>
	            <tr><td COLSPAN="1" style="height:30px;line-height: 30px;font-size: 11px;font-family: franklingothicbook;"></td></tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px">&nbsp;</td>
	                <td COLSPAN="2"><b>Jenis Jasa</b>&nbsp; :</td>
                </tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="height:30px;line-height: 30px;font-size: 11px;font-family: franklingothicbook;" width="100px">&nbsp;</td>
	                <td COLSPAN="2">JML x SIZE : ' . $data_detail->query[0]->JUM_CONT . ' x ' . $data_detail->query[0]->SIZE_ . '</td>
	            </tr>';

            if($repRequest == "STF") {
                $uang_jasa = $data_detail->query[0]->UANG_JASA;
                $ppn       = $data_detail->query[0]->PPN;
                $materai   = $data[0]->AMOUNT_MATERAI;
                $jumlah    = $data[0]->AMOUNT;
                $terbilang = $data[0]->AMOUNT_TERBILANG;
                $width     = "240px";
                $widthr    = "265x";
                $tbl .= '<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Pass Retribusi &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="140px"> ' . $data_detail->query[0]->JUM_CONT . 'x ' . $data_detail->query[0]->PASS_RETRIBUSI . ' = &nbsp; &nbsp; </td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px"> ' . $data_detail->query[0]->PASS_RETRIBUSI . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Jasa Stuffing via &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="140px"> ' . $data_detail->query[0]->JUM_CONT . '(' . $data_detail->query[0]->SIZE_ . ') x ' . $data_detail->query[0]->JASA_STUFFING . ' = &nbsp; &nbsp; </td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px"> ' . $data_detail->query[0]->JASA_STUFFING . '</td>
                        </tr>';
            } else if($repRequest == "SFP") {
                $uang_jasa = $data_detail->query[0]->JML_;
                $ppn       = $data_detail->query[0]->PPN;
                $materai   = $data[0]->AMOUNT_MATERAI;
                $jumlah    = $data[0]->AMOUNT;
                $terbilang = $data[0]->AMOUNT_TERBILANG;
                $width     = "420px";
                $widthr    = "450px";
                for ($i=0; $i < count($data_detail->query); $i++) {
                    $data = ($i+1) == '1' ? 'Perpanjangan Penumpukkan MTY' : '';
                    $tbl .= '<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">'.$data.'</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: </td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="180px"> &nbsp; ' . $data_detail->query[$i]->KETERANGAN . ' &nbsp; &nbsp; </td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="140px"> : ' . $data_detail->query[$i]->JUM_CONT . ' (' . $data_detail->query[$i]->SIZE_ . '") x ' . $data_detail->query[$i]->JML_HARI . ' x ' . $data_detail->query[$i]->TARIF . ' = &nbsp; </td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="100px"> ' . $data_detail->query[$i]->JML . '</td>
                        </tr>';
                }
            }

            $tbl .= '<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Uang Jasa &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $uang_jasa . '</td>
                        </tr>';

            if($materai == 0) {
                $tbl.='<tr>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">PPN &nbsp; &nbsp;</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $ppn . '</td>
                                </tr>';
            } else {
                $tbl.='<tr>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">PPN &nbsp; &nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $ppn . '</td>
                                </tr>                                
                                <tr>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Materai &nbsp; &nbsp;</td>
                                    <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $materai . '</td>
                                </tr>';
            }

            $tbl.='<tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Jumlah &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px"><hr width="'.$widthr.'">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $jumlah.'</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">PPN ditanggung Pemerintah &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> 0</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Jumlah Upper &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> 0</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="30px">&nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="160px">Piutang &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="left" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="25px">: Rp.</td>
                            <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="'.$width.'"> ' . $jumlah.'</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="80px">Terbilang</td>
                            <td COLSPAN="1" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="10px">:</td>
                            <td COLSPAN="7" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;"> ' . $terbilang.'</td>
                        </tr>
                    </table>';
        } elseif($data[0]->HEADER_SUB_CONTEXT=="UST02"){
            $tbl = '<table>
                <tr><td COLSPAN="1" style="height:30px;line-height: 30px;font-size: 11px;font-family: franklingothicbook;"></td></tr>
                <tr>
                    <td COLSPAN="5" align="left" style="font-size:9px; height:30px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="140px">KETERANGAN</td>
                    <td COLSPAN="2" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TGL AWAL</td>
                    <td COLSPAN="2" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TGL AKHIR</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">BOX</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">SZ</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">TY</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">ST</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;;" width="40px">HZ</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">HR</td>
                    <td COLSPAN="1" align="right" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TARIF</td>
                    <td COLSPAN="1" align="right" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">VAL</td>
                    <td COLSPAN="2" align="right" style="font-size:9px; line-height:30px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">JUMLAH</td>
                </tr>
                <tr><td COLSPAN="1" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;"></td></tr>';

            //if($repRequest == "REC") {
            for ($i=0; $i < count($data_detail->query); $i++) {
                $data2 = $data_detail->query[$i]->START_STACK == '' ? '-' : $data_detail->query[$i]->START_STACK;
                $data3 = $data_detail->query[$i]->END_STACK == '' ? '-' : $data_detail->query[$i]->END_STACK;
                $data8 = $data_detail->query[$i]->HZ == '' ? '-' : $data_detail->query[$i]->HZ;
                $data9 = $data_detail->query[$i]->JML_HARI == '' ? '-' : $data_detail->query[$i]->JML_HARI;
                $tbl .= '<tr>
                        <td COLSPAN="5" align="left" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->KETERANGAN.'</td>
                        <td COLSPAN="2" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data2.'</td>
                        <td COLSPAN="2" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data3.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->JUM_CONT.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->SIZE_.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->TYPE_.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->STATUS.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data8.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data9.'</td>
                        <td COLSPAN="1" align="right" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->TARIF.'</td>
                        <td COLSPAN="1" align="right" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">IDR</td>
                        <td COLSPAN="2" align="right" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->JML.'</td>
                    </tr>';
            }
            //}

            $tbl .= '<tr><td COLSPAN="1" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;"></td></tr>
                    <tr>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="659px"><hr></td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Discount : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px">0</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Administrasi : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px">0</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Dasar Pengenaan Pajak : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data_detail->query[0]->JML_.'</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Jumlah PPN : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data_detail->query[0]->PPN.'</td>
                    </tr>';

            if(!$data[0]->AMOUNT_MATERAI == 0) {
                $tbl.='<tr>
                            <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Materai : &nbsp; &nbsp;</td>
                            <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$amountMaterai.'</td>
                        </tr>';
            }

            $tbl .='<tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Jumlah Dibayar : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data[0]->AMOUNT.'</td>
                    </tr>                    
                    <tr>
                        <td COLSPAN="2" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="80px">Terbilang</td>
                        <td COLSPAN="1" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;" width="10px">:</td>
                        <td COLSPAN="7" align="left" style="height:70px;line-height: 70px;font-size: 11px;font-family: franklingothicbook;"> ' . $data[0]->AMOUNT_TERBILANG.'</td>
                    </tr>
                    </table>';
        }

        $ttd_footer ='<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">PALEMBANG, '.$tgl_nota.'</td>
                		</tr>
                		<tr>

		                    <td COLSPAN="2" align="right" width="550px">Manajer Keuangan</td>
                		</tr>
                		<tr>
		                    <td COLSPAN="2" align="left" width="100px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		                    <td COLSPAN="2" align="right" width="457px"><img height="100" width="100" src="'.$ttd_location.'" /></td>

                		</tr>
                		<tr>
                			<td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">'.$pejabat.'</td>
                		</tr>

                		<tr>
                			<td COLSPAN="2" align="right" width="545px">NIPP. '.$nip_pejabat.'</td>
                		</tr>
					  </table>';

        $ematerai_nota = array(
            'amountMaterai' => $amountMaterai,
            'redaksi' => $redaksi,
            'status_lunas' => $status_lunas,
            'unit_wilayah' => $unit_wilayah,
            'alamat_wilayah' => $alamat_wilayah,
        );
        $ematerai_nota = ematerai_nota($ematerai_nota);

        /* settingan pdf */
        $pdf->SetFont('gotham', '', 8);
        $pdf->writeHtml($header, true, false, false, false, '');
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($lampiran, true, false, false, false, '');
        $pdf->writeHtml($tbl, true, false, false, false, '');
        $pdf->writeHtml($ttd_footer, true, false, false, false, '');
        $pdf->SetY(260);
        $pdf->writeHtml($ematerai_nota, true, false, false, false, '');
        $pdf->Output($output_name, 'I');
    }

    public function priview_create_nota2($noNota=null,$layanan=null,$brancid=null, $branccode=null, $kdcabang=null){
        $this->load->helper('pdf_helper');
        tcpdf();
        $this->load->helper('nota_invoice_helper');

        var_dump('coming soon esb');die;

    //    echo $noNota."|||||".$layanan."|||||".$brancid."|||||".$branccode; die;
    //    $ORG_ID      = $brancid;//85;
    //    $BRANCH_CODE = $branccode;//PLG;

        $postdata["NO_NOTA"]      = $noNota;
        $postdata["KODE_LAYANAN"] = $layanan;
        $postdata["KD_CABANG"]    = $kdcabang;

        $data        = $this->senddataurl('ReviewHeaderUster/',$postdata,'POST');
        $postdata['NO_REQUEST'] = $data[0]->NO_REQUEST;
        $data_detail = $this->senddataurl('ReviewHeaderUster/ok',$postdata,'POST');
        $nmLayanan   = ($layanan == 'UST02' ? 'RECEIVING' : ($layanan == 'UST04' ? 'STUFFING' : ($layanan == 'UST13' ? 'RECEIVING DELIVERY' : false)));
        $repRequest  = preg_replace("/[^a-zA-Z]/", "", $data[0]->NO_REQUEST);
        $output_name = "LAPORAN PDF PRANOTA ".$data[0]->NO_NOTA.".pdf";
        define('noNotaFooter', $noNota);

//      $data2 = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_ORGID"=>$ORG_ID, "INV_UNIT_CODE"=>$BRANCH_CODE),'POST');
//        $header_nota = array(
//            "status_lunas"=>'S',
//            "e_logo"=>$data2[0]->INV_ENTITY_LOGO,
//            "e_name"=>$data2[0]->INV_ENTITY_NAME,
//            "e_cabang"=>$data2[0]->INV_UNIT_NAME,
//            "num"=>$data[0]->NO_NOTA,
//            "e_address"=>$data2[0]->INV_ENTITY_ALAMAT,
//            "tgl_nota"=>$data[0]->TGL_NOTA,
//            "bag"=>'RUPA',
//            "e_npwp"=>$data2[0]->INV_ENTITY_NPWP,
//            "e_faktur"=>$data2[0]->INV_ENTITY_FAKTUR);
//        $header = header_pranota($header_nota);

        $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle($data[0]->NO_NOTA);
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(12, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setLanguageArray(null);
        $pdf->SetHeaderMargin(false);
        $pdf->SetTopMargin(5);
        $pdf->SetFooterMargin(20);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011',PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();

        $judul    = '';
        $judul = '<table>
                <tr>
	                <td COLSPAN="2" align="right" style="height:80px; line-height:80px;"></td>
                </tr>
				<tr>
	                <td COLSPAN="2" align="center" style="font-size:11px; line-height:20px;" width="100%"><b>PERHITUNGAN PELAYANAN JASA</b></td>
				</tr>
				<tr>
	                <td COLSPAN="2" align="center" style="font-size:11px; line-height:20px;" width="100%"><b>KEGIATAN '.$nmLayanan.'</b></td>
				</tr>
	        </table>';

        $lampiran = '';
        $lampiran = '<table>
                <tr>
	                <td COLSPAN="2" align="right" style="height:10px; line-height:10px;"><hr></td>
                </tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="100px">Nama Perusahaan</td>
					<td COLSPAN="1" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="10px">:</td>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="180px">'.$data[0]->CUSTOMER_NAME.'</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="100px">N.P.W.P</td>
					<td COLSPAN="1" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="10px">:</td>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="130px">'.$data[0]->NPWP.'</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="100px">Alamat</td>
					<td COLSPAN="1" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="10px">:</td>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="230px">'.$data[0]->ALAMAT.'</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="100px">Nama Kapal</td>
					<td COLSPAN="1" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="10px">:</td>
	                <td COLSPAN="2" align="left" style="font-size:11px; line-height:20px; font-family:franklingothicbook;" width="230px">'.$data[0]->NM_KAPAL.' ['.$data[0]->VOYAGE.']</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="right" style="height:1px; line-height:1px;"></td>
                </tr>
	        </table>';

        $tbl = '';
        if($layanan=="UST04"){
            $tbl = '<table>
	            <tr><td COLSPAN="1"><hr></td></tr>
	            <tr>
                    <td COLSPAN="2" align="right" style="height:10px; line-height:10px; font-size:11px; font-family:franklingothicbook;" width="250px">Jenis Jasa : &nbsp; &nbsp;</td>
	                <td COLSPAN="2" align="left" style="height:10px; line-height:10px; font-size:11px; font-family: franklingothicbook;" width="280px"> &nbsp; &nbsp; JML x SIZE : '.$data_detail->query[0]->JUM_CONT.' x '.$data_detail->query[0]->SIZE_.'</td>
	                <td COLSPAN="2" align="left" style="height:10px; line-height:25px; font-size:11px; font-family: franklingothicbook;" width="280px">&nbsp;</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="659px"><hr></td>
                </tr>';

            if($repRequest == "STF") {
                $tbl .= '<tr>
                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="250px">Pass Retribusi : &nbsp; &nbsp;</td>
	                <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="200px"> ' . $data_detail->query_retrib[0]->JUM_CONT . ' x ' . $data_detail->query_retrib[0]->TARIF . ' = &nbsp; &nbsp; </td>
	                <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="80px"> ' . $data_detail->query_retrib[0]->TOTAL . '</td>
	            </tr>
	            <tr>
                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="250px">Jasa Stuffing via ' . $data_detail->query[0]->TEKSTUAL . ' : &nbsp; &nbsp;</td>
	                <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="200px"> ' . $data_detail->query[0]->JUM_CONT . ' (' . $data_detail->query[0]->SIZE_ . ') x ' . $data_detail->query[0]->TARIF . ' = &nbsp; &nbsp; </td>
	                <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="80px"> ' . $data_detail->query[0]->TOTAL . '</td>
	            </tr>';
            } else if($repRequest == "SFP") {
                for ($i=0; $i < count($data_detail->query); $i++) {
                    $data = ($i+1) == '1' ? 'Perpanjangan Penumpukkan MTY : &nbsp; &nbsp;' : '';
                    $tbl .= '<tr>
                        <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="250px">'.$data.'</td>
                        <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="200px"> ' . $data_detail->query[$i]->KETERANGAN . ' : ' . $data_detail->query[$i]->JUM_CONT . ' (' . $data_detail->query[$i]->SIZE_ . ') x ' . $data_detail->query[$i]->JML_HARI . ' x ' . $data_detail->query[$i]->TARIF . ' = &nbsp; &nbsp; </td>
                        <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="80px"> ' . $data_detail->query[$i]->TOTAL . '</td>
                    </tr>';
                }
            }

            $tbl.='<tr>
                    <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="250px">Uang Jasa : &nbsp; &nbsp;</td>
	                <td COLSPAN="2" align="right" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" width="280px"> '.$data_detail->query_total[0]->TOTAL.'</td>
	            </tr>';

            if( $data_detail->query_total[0]->AMOUNT_MATERAI || $data_detail->query_total[0]->AMOUNT_MATERAI > 0) {
                $TOTAL_TAGIHAN = $data_detail->query_total[0]->TOTAL_TAGIHAN;
                $tbl.='<tr>
                        <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> PPN : &nbsp; &nbsp; </td>
                        <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook; border-bottom:1px solid black;" align="right" width="280px"> '.$data_detail->query_total[0]->PPN.'</td>
                    </tr>';
            } else {
                $TOTAL_TAGIHAN = $data_detail->query_total[0]->TOTAL_TAGIHAN_MATERAI;
                $tbl.='<tr>
                        <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> PPN : &nbsp; &nbsp; </td>
                        <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="280px"> '.$data_detail->query_total[0]->PPN.'</td>
                    </tr>
                    <tr>
                        <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> Materai : &nbsp; &nbsp; </td>
                        <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook; border-bottom:1px solid black;" align="right" width="280px"> '.$data_detail->query_total[0]->AMOUNT_MATERAI.'</td>
                    </tr>';
            }

            $tbl.='<tr>
	                <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> Jumlah : &nbsp; &nbsp; </td>
					<td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="280px"> '.$TOTAL_TAGIHAN.'</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> PPN ditanggung Pemerintah : &nbsp; &nbsp; </td>
					<td COLSPAN="2" style="height:20px;line-height: 20px;font-size: 11px;font-family: franklingothicbook;" align="right" width="280px"> 0</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> Jumlah Upper : &nbsp; &nbsp; </td>
	                <td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="right" width="280px"> 0</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="right" width="250px"> Piutang : &nbsp; &nbsp; </td>
					<td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="right" width="280px"> '.$TOTAL_TAGIHAN.'</td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="right" style="height:70px; line-height:70px;"></td>
                </tr>';

            $tbl.='</table>
	        <p><b>Nota sebagai Faktur Pajak berdasarkan Peraturan Dirjen Pajak <br>
				Nomor 10/PJ/2010 Tanggal 9 Maret 2010</b><p>';
        } else if ($layanan=="UST13"){
            $tbl .= '<table>
                <tr>
                    <td COLSPAN="5" align="left" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="140px">KETERANGAN</td>
                    <td COLSPAN="2" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TGL AWAL</td>
                    <td COLSPAN="2" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TGL AKHIR</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">BOX</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">SZ</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">TY</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">ST</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;;" width="40px">HZ</td>
                    <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">HR</td>
                    <td COLSPAN="1" align="right" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">TARIF</td>
                    <td COLSPAN="1" align="right" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="40px">VAL</td>
                    <td COLSPAN="2" align="right" style="font-size:9px; line-height:20px; font-weight:bold; border-top: 1px solid #0b0b0b; border-bottom: 1px solid #0b0b0b;" width="60px">JUMLAH</td>
                </tr>';
                for ($i=0; $i < count($data_detail->query); $i++) {
                    $data2 = $data_detail->query[$i]->START_STACK == '' ? '-' : $data_detail->query[$i]->START_STACK;
                    $data3 = $data_detail->query[$i]->END_STACK == '' ? '-' : $data_detail->query[$i]->END_STACK;
                    $data8 = $data_detail->query[$i]->HZ == '' ? '-' : $data_detail->query[$i]->HZ;
                    $data9 = $data_detail->query[$i]->JML_HARI == '' ? '-' : $data_detail->query[$i]->JML_HARI;
                    $tbl .= '<tr>
                        <td COLSPAN="5" align="left" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->KETERANGAN.'</td>
                        <td COLSPAN="2" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data2.'</td>
                        <td COLSPAN="2" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data3.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->JML_CONT.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->SIZE_.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->TYPE_.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->STATUS.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data8.'</td>
                        <td COLSPAN="1" align="center" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data9.'</td>
                        <td COLSPAN="1" align="right" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->TARIF.'</td>
                        <td COLSPAN="1" align="right" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">IDR</td>
                        <td COLSPAN="2" align="right" style="font-size:9px; line-height:20px; font-family:franklingothicbook;">'.$data_detail->query[$i]->BIAYA.'</td>
                    </tr>';
                }
            $tbl .= '<tr>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="659px"><hr></td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Discount : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px">0</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Administrasi : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data_detail->query_total[0]->ADM_NOTA.'</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Dasar Pengenaan Pajak : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data_detail->query_total[0]->TAGIHAN.'</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Jumlah PPN : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data_detail->query_total[0]->PPN.'</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:20px;" width="550px">Jumlah Dibayar : &nbsp; &nbsp;</td>
	                    <td COLSPAN="2" align="right" style="height:20px; line-height:20px;" width="110px"> '.$data_detail->query_total[0]->TOTAL_TAGIHAN.'</td>
                    </tr>
                    <tr>
	                    <td COLSPAN="5" align="right" style="height:20px; line-height:100px;" width="550px">&nbsp; &nbsp;</td>
                    </tr>';
            $tbl .= '</table>
                <p><b>Nota sebagai Faktur Pajak berdasarkan Peraturan Dirjen Pajak <br>
				Nomor 10/PJ/2010 Tanggal 9 Maret 2010</b><p>';
        }

//        $ematerai_nota = array(
//            "fm"=>"FM.01/04/05/04",
//            "amountMaterai"=>"",
//            "redaksi"=>"",
//            "status_lunas"=>"",
//            "unit_wilayah"=>$data2[0]->INV_UNIT_NAME,
//            "alamat_wilayah"=>$data2[0]->INV_UNIT_ALAMAT,
//        );
//        $ematerai_nota = ematerai_nota($ematerai_nota);

        /* settingan pdf */
        $pdf->SetFont('gotham', '', 8);
    //    $pdf->writeHtml($header, true, false, false, false, '');
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($lampiran, true, false, false, false, '');
        $pdf->writeHtml($tbl, true, false, false, false, '');
        $pdf->SetY(260);
    //    $pdf->writeHtml($ematerai_nota, true, false, false, false, '');
        $pdf->Output($output_name, 'I');
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
        if (!defined (img_file)) {
            // echo img_file;die();
            $img_file = img_file;
        } else{
            $img_file = APP_ROOT.'assets/images/copy.png';
        }
        // $img_file = APP_ROOT.'assets/images/copy.png';

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

}