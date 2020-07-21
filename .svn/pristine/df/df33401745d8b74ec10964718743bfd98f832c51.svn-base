<?php
date_default_timezone_set("Asia/Bangkok");
if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
require(APPPATH . 'helpers/tcpdf/tcpdf.php');
class Barang extends CI_Controller
{

	var $API = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('auth_model');
		// $this->load->model('cust_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		// $this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		$this->load->library('MX_Encryption');
		define('IMAGES_TTD_', APP_ROOT . "uploads/ttd/");
		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');

		
		$this->API = API_EINVOICE;
	}

	protected function getdataurl($url)
	{

		// $uri = SITE_WSAPI.'/'.$url;
		//$uri = $this->API.'/'.$url;
		$uri = API_EINVOICE . '/' . $url;
		// print_r($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		$data = json_decode(curl_exec($ch));
		return $data;
	}

	protected function senddataurl($url, $data, $type)
	{
		//$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
		$uri = API_EINVOICE . '/' . $url;
		// die($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/x-www-form-urlencoded',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$ex = curl_exec($ch);
		$result = json_decode($ex);
		
		return $result;
	}


	public function barangsearch()
    {
        $postdata = ($_POST);

        $arrayData = $this->senddataurl('invh/search/', $postdata, 'POST');
        $length = (int)$postdata['length'];

        $data = array(
            'recordsTotal' => $length,
            'recordsFiltered' => $arrayData->recordsFiltered,
            'data' => array(),
        );
        $num = 1;
        $jenisNota = $this->getMstNota('BRG');

        foreach ($arrayData->result as $key => $value) {
            $data['data'][$key] = $value;
            $data['data'][$key]->num = $num;
            $data['data'][$key]->TRX_DATE = $value->TRX_DATE;//date('Y-m-d', strtotime($value->TRX_DATE));
            $token_cetak_barang = md5(sha1(md5(base64_encode($value->TRX_NUMBER).base64_encode('barang'))));
            $enc_trx_number = $this->mx_encryption->encrypt($value->TRX_NUMBER);
            $data['data'][$key]->jumlah = "<div align='right'>".(strpos($value->AMOUNT, ',') == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT.'</div>';
            $statusL = 'BELUM LUNAS';
            if (isset($value->STATUS_LUNAS) && $value->STATUS_LUNAS == 'Y') {
                $statusL = 'LUNAS';
            } elseif (isset($value->STATUS_LUNAS) && $value->STATUS_LUNAS == 'X') {
                $statusL = 'KOREKSI';
            }
            $cetak = '';
            $email = '';
            if (intval($value->STATUS_CETAK) > 0) {
                $cetak = 'checked';
            }
            if (intval($value->STATUS_KIRIM_EMAIL) > 0) {
                $email = 'checked';
            }
            $data['data'][$key]->PC = "<input type=checkbox style='width:20px;height:20px' disabled $cetak>";
            $data['data'][$key]->STATUS_LUNAS = $statusL;
			$data['data'][$key]->NAMA_KAPAL = ($value->VESSEL_NAME) == NULL ? $value->INTERFACE_HEADER_ATTRIBUTE2 : $value->VESSEL_NAME;
            $data['data'][$key]->KEGIATAN = $value->CREATION_DATE;
            $data['data'][$key]->AMOUNT = number_format($value->AMOUNT, 0, ' ', '.');
            $data['data'][$key]->PK = "<input type=checkbox  style='width:20px;height:20px' disabled $email>";

            $data['data'][$key]->action = '<a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota/cetak_barang/barang/'.$enc_trx_number.'"><i class="fa fa-print" ></i> Cetak</a>';

            if (isset($value->HEADER_SUB_CONTEXT)) {
                $data['data'][$key]->JENIS = $value->SOURCE_SYSTEM == 'LINEOS' ? $this->getMstNotaLineos($value->HEADER_SUB_CONTEXT, $value->DOC_NUM) : $jenisNota[$value->HEADER_SUB_CONTEXT];
            } else {
                $data['data'][$key]->JENIS = '-';
            }
            if ($value->STATUS == 'P') {
                $data['data'][$key]->STATUS = 'Invoice';
            }
        }

        echo json_encode($data);
    }

	private function getMstNotaLineos($header_sub_context, $doc_number)
	{
		switch ($header_sub_context) {
			case 'BRG03':
				if ($doc_number == 'HCS') {
					$keterangankode = 'HI CO SCAN';
				} elseif ($doc_number == 'DLVI') {
					$keterangankode = 'DELIVERY INTERSULER';
				} else {
					$keterangankode = '-';
				}
				$jenisNota = $keterangankode;
				break;
			
			case 'BRG07':
				if ($doc_number == 'BHD') {
					$keterangankode = 'BEHANDLE';
				} elseif ($doc_number == 'DLV') {
					$keterangankode = 'DELIVERY PLP';
				} elseif ($doc_number == 'HCS') {
					$keterangankode = 'HI CO SCAN';
				} else {
					$keterangankode = '-';
				}
				$jenisNota = $keterangankode;
				break;
			
			default:
			$jenisNota = '-';
				break;
		}
		return $jenisNota;
	}

    public function getMstNota($codeNota)
	{
		$jenisNota = array();
		$notaJenis = $this->getdataurl('mstnota/getData/' . $codeNota);
		foreach ($notaJenis as $key => $value) {
			$jenisNota[$value->INV_NOTA_CODE] = $value->INV_NOTA_JENIS;
		}
		return $jenisNota;
	}

	public function cetak_barang($layanan, $no_invoice = '')
    {
        $this->load->helper('nota_invoice_helper');
        $this->load->helper('pdf_helper');
        tcpdf();
		
        $id = $this->mx_encryption->decrypt($no_invoice);
        $jenisNotaArr = $this->getMstNota('BRG');
        $judul = 'priview cetak barang';

        $id2 = $id;
        switch ($layanan) {
            case 'barang':
                $data_header = $this->getdataurl('invh/pdf/BARANG/'.$id2);

                //ambil data dari trx_header
                $num = $data_header->TRX_NUMBER;
                $tgl_nota = $data_header->TRX_DATE;
                $custname = $data_header->CUSTOMER_NAME;
                $c_number = $data_header->CUSTOMER_NUMBER;
                // $spesial_customer = $this->cust_model->cek_special_cus($c_number);
                $c_address = $data_header->CUSTOMER_ADDRESS;
                $source_invoice_type = $data_header->SOURCE_INVOICE_TYPE;
                $nomornpwp = $data_header->CUSTOMER_NPWP;
                $kapal = $data_header->VESSEL_NAME;
                $kunjungan = $source_invoice_type == 'LINEOS' ? $data_header->INTERFACE_HEADER_ATTRIBUTE6 : $data_header->PER_KUNJUNGAN_FROM;
                $to_kun = $data_header->PER_KUNJUNGAN_TO;
                $dagang = $data_header->INTERFACE_HEADER_ATTRIBUTE3;
                $NamaKapal = $source_invoice_type == 'LINEOS' ? $data_header->INTERFACE_HEADER_ATTRIBUTE4 : $data_header->INTERFACE_HEADER_ATTRIBUTE2;
                $gudang = $source_invoice_type == 'LINEOS' ? null : $data_header->INTERFACE_HEADER_ATTRIBUTE4;
                $kade = $source_invoice_type == 'LINEOS' ? null : $data_header->INTERFACE_HEADER_ATTRIBUTE5;
                $bprp = $source_invoice_type == 'LINEOS' ? null : $data_header->INTERFACE_HEADER_ATTRIBUTE6;
                $nobl = $source_invoice_type == 'LINEOS' ? null : $data_header->INTERFACE_HEADER_ATTRIBUTE7;
                $no_do = $source_invoice_type == 'LINEOS' ? $data_header->INTERFACE_HEADER_ATTRIBUTE1 : null;
                $no_sppb = $source_invoice_type == 'LINEOS' ? $data_header->INTERFACE_HEADER_ATTRIBUTE8 : null;
                $lapangan = $source_invoice_type == 'LINEOS' ? $data_header->INTERFACE_HEADER_ATTRIBUTE9 : null;
                $tanggal_sppb = $source_invoice_type == 'LINEOS' ? $data_header->INTERFACE_HEADER_ATTRIBUTE11 : null;
                $lama_penumpukan = null;
                if ($source_invoice_type == 'LINEOS') {
                    $start_date = new DateTime($data_header->INTERFACE_HEADER_ATTRIBUTE6);
                    $end_date = new DateTime($data_header->INTERFACE_HEADER_ATTRIBUTE7);
                    $interval = $start_date->diff($end_date);
                    $tanggal_lama_penumpukan = $interval->days. ' ('. $data_header->INTERFACE_HEADER_ATTRIBUTE6. ' s/d '. $data_header->INTERFACE_HEADER_ATTRIBUTE7. ')';
                    $lama_penumpukan = $tanggal_lama_penumpukan;
                }
                $no_req = $data_header->BILLER_REQUEST_ID;
                $no_uper = $data_header->INTERFACE_HEADER_ATTRIBUTE1;
                $ex_num = $data_header->TRX_NUMBER_PREV;
                $current = $data_header->CURRENCY_CODE;
                $headerContext = $data_header->HEADER_CONTEXT;
                $uang_jaminan = ($data_header->UANG_JAMINAN == '') ? 0 : $data_header->UANG_JAMINAN;
                $unit_loc = $data_header->INV_UNIT_LOCATION;
                $entityId = $data_header->INV_ENTITY_ID;
                $amountMaterai = ($data_header->AMOUNT_MATERAI == '') ? '0' : $data_header->AMOUNT_MATERAI;
                $redaksi = '-';
                if ($entityId != '') {
                    //$dataPost2 = array('INV_ENTITY_ID' => $entityId);
                    //$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi', $dataPost2, 'POST');
					$dataPost2 = array("TRX_NUMBER"=>$num);
					$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksiHist',$dataPost2,'POST');
                    if (count($redaksi) > 0) {
                        //$redaksi = ($data_header->AMOUNT_MATERAI == '') ? '-' : $redaksi[0]->INV_EMATERAI_REDAKSI;
						$redaksi = ($redaksi[0]->INV_REDAKSI=='')?"-":$redaksi[0]->INV_REDAKSI;
                    } else {
                        $redaksi = '-';
                    }
                }
                $header_context = $data_header->HEADER_SUB_CONTEXT;
                $administrasi = '0';
                $tanggalKegiatan = ($data_header->CREATION_DATE == '') ? '-' : $data_header->CREATION_DATE;
				$tanggalKegiatan .= ($data_header->LAST_UPDATE_DATE == '') ? " s.d -" : " s.d " .$data_header->LAST_UPDATE_DATE;
				if ($data_header->HEADER_SUB_CONTEXT == 'BRG02') {
					$tanggalKegiatan = $data_header->PER_KUNJUNGAN_FROM. ' s.d '. $data_header->PER_KUNJUNGAN_TO;
				}
                $e_name = ($data_header->INV_ENTITY_NAME == '') ? '-' : $data_header->INV_ENTITY_NAME;

                $e_address = ($data_header->INV_ENTITY_ALAMAT == '') ? '-' : $data_header->INV_ENTITY_ALAMAT;
                $e_npwp = ($data_header->INV_ENTITY_NPWP == '') ? '-' : $data_header->INV_ENTITY_NPWP;
                $e_faktur = ($data_header->INV_ENTITY_FAKTUR == '') ? '-' : $data_header->INV_ENTITY_FAKTUR;
                $u_piutang = $data_header->PIUTANG;
                $a_terbilang = $data_header->AMOUNT_TERBILANG;
                $ppn_sendiri = $data_header->PPN_DIPUNGUT_SENDIRI;
                $e_logo = $data_header->INV_ENTITY_LOGO;
                $pejabat = $data_header->INV_PEJABAT_NAME;
                $nip_pejabat = $data_header->INV_PEJABAT_NIPP;
                $ttd_pejabat = $data_header->INV_PEJABAT_TTD;
                $jenis_nota = $data_header->DOC_NUM;
                $status_bayar = $data_header->STATUS;
                $faktor_note = $data_header->INV_FAKTUR_NOTE;
                $jabatan_pejabat = $data_header->INV_PEJABAT_JABATAN;
                $status_lunas = $data_header->STATUS_LUNAS;
                $STATUS_KOREKSI = $data_header->STATUS_KOREKSI;
                if ($source_invoice_type == 'LINEOS') {
                    switch ($data_header->HEADER_SUB_CONTEXT) {
                        case 'BRG03':
                            if ($data_header->DOC_NUM == 'HCS') {
                                $keterangankode = 'HI CO SCAN';
                            } elseif ($data_header->DOC_NUM == 'DLVI') {
                                $keterangankode = 'DELIVERY INTERSULER';
                            } else {
                                $keterangankode = '-';
                            }
                            $datalayananlineos[] = array('INV_NOTA_JENIS' => $keterangankode);
                            break;

                        case 'BRG07':
                            if ($data_header->DOC_NUM == 'BHD') {
                                $keterangankode = 'BEHANDLE';
                            } elseif ($data_header->DOC_NUM == 'DLV') {
                                $keterangankode = 'DELIVERY PLP';
                            } elseif ($data_header->DOC_NUM == 'HCS') {
                                $keterangankode = 'HI CO SCAN';
                            } else {
                                $keterangankode = '-';
                            }
                            $datalayananlineos[] = array('INV_NOTA_JENIS' => $keterangankode);
                            break;

                        default:
                        $datalayananlineos[] = array('INV_NOTA_JENIS' => '-');
                            break;
                    }
                    $notaJenis = json_decode(json_encode($datalayananlineos, true));
                } else {
                    $notaJenis = $this->getdataurl('mstnota/getData/'.$data_header->HEADER_SUB_CONTEXT);
                }

                if (count($notaJenis) > 0) {
                    $jenisNota = $notaJenis[0]->INV_NOTA_JENIS;
                } else {
                    $jenisNota = '-';
                }

                $header_nota = array(
                    'faktor_note', $faktor_note,
                    'status_lunas' => $status_lunas,
                    'STATUS_KOREKSI' => $STATUS_KOREKSI,
                    'status_bayar' => $status_bayar,
                    'e_logo' => $e_logo,
                    'e_name' => $e_name,
                    'num' => $num,
                    'e_address' => $e_address,
                    'tgl_nota' => $tgl_nota,
                    'e_npwp' => $e_npwp,
                    'ex_num' => $ex_num,
                    'e_faktur' => $faktor_note,
                );
                //echo "<pre>"; print_r($header_nota);die();
                $judul_nota = array('jenisNota' => $jenisNota);

                // print_r($data_header->SOURCE_INVOICE); die();

                if ($data_header->SOURCE_INVOICE == 'LINI2' && $data_header->ORG_ID == '1826') {
                    $unit_wilayah1 = 'PT. PELABUHAN TANJUNG PRIOK';
                    $alamat_wilayah1 = 'Jl. Pasoso No. 1, Tanjung Priok, Jakarta Utara 14310';
                } elseif ($data_header->SOURCE_INVOICE == 'LINI2' && $data_header->ORG_ID == '1824') {
                    $unit_wilayah1 = 'TO2 Terminal Operator 2 PT. PELABUHAN TANJUNG PRIOK LINEOS';
                    $alamat_wilayah1 = 'Jl. Pasoso No. 1, Tanjung Priok, Jakarta Utara 14310';
                } elseif ($data_header->SOURCE_INVOICE == 'LINI2' && $data_header->ORG_ID == '83') {
                    $unit_wilayah1 = 'PT. PELABUHAN INDONESIA II (PERSERO) CABANG TANJUNG PRIOK LINEOS';
                    $alamat_wilayah1 = 'Jl. Pasoso No. 1, Tanjung Priok, Jakarta Utara 14310';
                } elseif ($data_header->SOURCE_INVOICE == 'LINI2' && $data_header->ORG_ID == '1827') {
                    $unit_wilayah1 = 'PT. IPC TERMINAL PETIKEMAS Wilayah III Lini 2';
                    $alamat_wilayah1 = 'Jl. Pasoso No. 1, Tanjung Priok, Jakarta Utara 14310';
                } else {
                    $unit_wilayah1 = $data_header->INV_UNIT_NAME;
                    $alamat_wilayah1 = $data_header->INV_UNIT_ALAMAT;
                }

                $unit_wilayah = $unit_wilayah1;
                $alamat_wilayah = $alamat_wilayah1;
                $trxline = $this->getdataurl('invl/'.$id2);
                // print_r($trxline);die();
                $jum_amount = ($data_header->AMOUNT == '') ? 0 : $data_header->AMOUNT;
                $tax_amount = ($data_header->PPN_10PERSEN == '') ? 0 : $data_header->PPN_10PERSEN; //buat ppn potongan 10 persen
                $total_amount = ($data_header->AMOUNT == '') ? 0 : $data_header->AMOUNT;
                $jumlahPenganaanPajak = ($data_header->AMOUNT_DASAR_PENGHASILAN == '') ? 0 : $data_header->AMOUNT_DASAR_PENGHASILAN;
                $materai = $amountMaterai; // ($data_header->AMOUNT_MATERAI=='')?0:$data_header->AMOUNT_MATERAI;
            // echo $tax_amount;die();

            //barcode
            // $idsecret = $this->encrypt->encode($num);
                $idsecret = $num;

                $enc_trx_number = $this->mx_encryption->encrypt($data_header->TRX_NUMBER);

                $url_enc = 'einvoice/nota/cetak_barang/barang/'.$enc_trx_number;

                $params['data'] = ROOT.$url_enc;
                $params['level'] = 'H';
                $params['size'] = 10;
                $randomfilename = rand(1000, 9999);
            /*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
            die();exit();*/
                $params['savename'] = UPLOADFOLDER_.'qr_code/'.$randomfilename.'.png';
                $this->ciqrcode->generate($params);
                $barcode_location = APP_ROOT.'qr_code/'.$randomfilename.'.png';
                $ttd_location = APP_ROOT.'config/images/cr/ttd2.png';

            //terbilang
                // var_dump($u_p); die();
        if ($u_piutang == '') {
            $terbilang = $a_terbilang.'Rupiah';
        } elseif ($u_piutang > 0) {
            if (substr($u_piutang, -2, 1) == '.') {
                $amount_terbilang = substr($u_piutang, 0, -2);
            } elseif (substr($u_piutang, -3, 1) == '.') {
                $amount_terbilang = substr($u_piutang, 0, -3);
            } else {
                $amount_terbilang = $u_piutang;
            }
            $amount_terbilang = str_replace(',00', '', $amount_terbilang);
            $amount_terbilang = preg_replace('/\./', '', $amount_terbilang);
            $amount_terbilang = str_replace('-', '', $amount_terbilang);
            $huruf = $this->getdataurl('others/terbilang/'.$amount_terbilang);
            foreach ($huruf as $bilang) {
                $terbilang = $bilang->NILAI;
                $terbilang = $terbilang.'Rupiah';
            }
        }
		else
		{
			$terbilang = '-';
		}

            // ---tutup data -----------
                $title = 'Report Nota Barang ';
                break;
        }
        /*pengecekan jika nama alamat dan npwp kosong */
        if ($custname == '' || $c_address == '' || $nomornpwp == '') {
            if ($c_number != '') {
                $dataCustomer = $this->senddataurl('MstCustomer/', $id2, 'POST');
                if (count($dataCustomer) > 0) {
                    $custname = $dataCustomer[0]->INV_CUSTOMER_NAMA;
                    $c_address = $dataCustomer[0]->INV_CUSTOMER_ALAMAT;
                    $nomornpwp = $dataCustomer[0]->INV_CUSTOMER_NPWP;
                }
            }
        }
        define('noNotaFooter', $num);
        $paramStatus['BILLER_REQUEST_ID'] = $no_req;
        $resultS = $this->senddataurl('InvoiceHeader/statusCetak/', $paramStatus, 'POST');

        $jenisNota = '';
        // print_r($headerKpl);die();
        // $notaJenis = $this->getdataurl('mstnota/getData/'.$headerKpl->HEADER_SUB_CONTEXT);
        $notaJenis = $this->getdataurl('mstnota/getData/'.$header_context);

        if (count($notaJenis) > 0) {
            foreach ($notaJenis as $key => $jenis) {
                $jenisNota = $jenis->INV_NOTA_JENIS;
            }
        } else {
            $jenisNota = '';
        }

        // $get_redaksi_x= "";
        $get_redaksi_x = $this->get_nota_redaksi($num, $jenisNota);

        $postlognota = array(
            'TRX_NUMBER' => $num,
            'ACTIVITY' => 'CETAK',
            'USER_ID' => $this->session->userdata('user_id'),
        );
        $datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');

        /*template settingan pdf*/
        // list($pdf, $style) = format_nota($header_nota, $spesial_customer); /* untuk kirim data special customer */
        list($pdf, $style) = format_nota($header_nota);
        // echo print_r($pdf);die();

        $header = header_nota($header_nota);
        $judul = judul_nota($judul_nota);
        $lampiranKanan = '';
        if (!empty($NamaKapal)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
		                    <td COLSPAN="2" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$NamaKapal.'</td></tr>';
        }

        if (!empty($kunjungan)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$kunjungan.'</td></tr>
	                	';
        }
		
		if($data_header->HEADER_SUB_CONTEXT == 'BRG02')
		{
			if (!empty($no_uper)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Nomor Uper</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$no_uper.'</td></tr>
	                	';
			}
		}
		else
		{
			if (!empty($no_req)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Nomor Request</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$no_req.'</td></tr>
	                	';
			}
		}          	
		
        if (!empty($no_do)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Nomor DO/BL</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$no_do.'</td></tr>
	                	';
        }

        if (!empty($no_sppb)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Nomor Dokumen</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$no_sppb.'</td></tr>
	                	';
        }

        if (!empty($lama_penumpukan)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Lama Penumpukan</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$lama_penumpukan.'</td></tr>
	                	';
        }

        if (!empty($tanggal_sppb)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Tanggal SPPB</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$tanggal_sppb.'</td></tr>
	                	';
        }

        if (!empty($lapangan)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Lapangan</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="170px">'.$lapangan.'</td></tr>
	                	';
        }

        if (!empty($gudang)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Gudang Lapangan</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                        <td COLSPAN="2" align="left"  width="170px">'.$gudang.'</td></tr>';
        }
        if (!empty($kade)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Kade</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                        <td COLSPAN="2" align="left"  width="170px">'.$kade.'</td></tr>';
        }
        if (!empty($bprp)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">No BPRP</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="left"  width="170px">'.$bprp.'</td></tr>';
        }
		if (!empty($nobl)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">No BL</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="left"  width="170px">'.$nobl.'</td></tr>';
        }
        if (!empty($dagang)) {
            $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Jenis Perdagangan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px">'.$dagang.'</td></tr>';
        }
		if (!empty($tanggalKegiatan) && ($data_header->HEADER_SUB_CONTEXT == 'BRG09' || $data_header->HEADER_SUB_CONTEXT == 'BRG02')) {
			$lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Tanggal Kegiatan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px">' . $tanggalKegiatan . '</td></tr>';
		}
        $lampiran = '<table>
        			<tr>
	                    <td COLSPAN="2"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="5" width="350px">
		                    <table>
	        					<tr>
	        						<td COLSPAN="2" align="left" width="50px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="280px">'.$custname.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="50px">Nomor</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="left" width="280px">'.$c_number.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="50px">Alamat</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="280px">'.$c_address.'</td>
	        					</tr>
	        					<tr>
				                    <td COLSPAN="2" align="left" width="50px">NPWP</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" style="font-size: 11px;font-family: franklingothicbook;" align="left" width="280px">'.$nomornpwp.'</td>
	        					</tr>
	        					<tr>
		        					<td COLSPAN="2" align="left" width="50px"></td>
									<td COLSPAN="1" align="left" width="10px"></td>
				                    <td COLSPAN="2" align="left" width="280px"></td>
	        					</tr>
		                    </table>
        				</td>
	                    <td COLSPAN="5">
		                    <table>
		                    '.$lampiranKanan.'
		                    </table>
	                    </td>
                	</tr>';

        $lampiran .= '</tr>

        			</table>';

        $postdata['BILLER_REQUEST_ID'] = $id;
        $postdata['MODULE'] = 'BARANG';
        // $dataBarang = $this->senddataurl('invh/search/', $postdata, 'POST');
        // $dataBarang = $dataBarang[0];

        $dataBarangDetail = $this->senddataurl('invh/searchdetail/', $postdata, 'POST');
        $dataBarangDetail = $dataBarangDetail[0];
        //print_r($dataBarangDetail); die;

       //echo $data_header->SOURCE_SYSTEM; die;
        if ($data_header->HEADER_SUB_CONTEXT == 'BRG04' || $data_header->HEADER_SUB_CONTEXT == 'BRG05') {
            $jenisNota = 'nota test';

            $tbl = '<table>
	        			<tr>
	        				<td align="center" width="20px"><b>No</b></td>
	        				<td align="center" width="140px"><b>Jenis Barang</b></td>
	        				<td align="center" width="120px"><b>Kemasan</b></td>
	        				<td align="center" width="80px"><b>Jumlah</b></td>
	        				<td align="center" width="60px"><b>Satuan</b></td>
	        				<td align="center" width="100px"><b>Tarif</b></td>
	        				<td align="center" width="130px" COLSPAN="2"><b>Jumlah</b></td>
	
	        			</tr>
	        		</table>';
        } elseif ($data_header->HEADER_SUB_CONTEXT == 'BRG10' || $data_header->HEADER_SUB_CONTEXT == 'BRG09') {
			$tbl = '<table>
	        			<tr>
	        				<td>
		        				<table>
			        				<tr>';
									
			$tbl .=	    ($data_header->HEADER_SUB_CONTEXT) == 'BRG10' ? '<td align="left" width="60px"><b>Jenis Jasa</b></td>' : '<td align="left" width="60px"><b>Uraian</b></td>';
			
			$tbl .=	        			'<td align="center" width="160px"><b>&nbsp;</b></td>
				        				<td align="center" width="30px">&nbsp;</td>
				        				<td align="center" width="100px" COLSPAN="2"><b>&nbsp;</b></td>
			        				</tr>
		        				</table>
	        				</td>';
	        	if (count($get_redaksi_x) > 0 && $data_header->HEADER_SUB_CONTEXT == 'BRG10') {

			       $tbl .= ' <td>	
								<table>
			        				<tr>
					        			<td align="center" width="140px">&nbsp;</td>
		        						<td align="center" width="160px" COLSPAN="2"><b>KETENTUAN</b></td>
			        				</tr>
			        				</table>
							</td>';
				}

	        	$tbl .= '</tr>';
				
		} else if ($data_header->HEADER_SUB_CONTEXT == "BRG07") {
			
			if($data_header->SOURCE_SYSTEM != 'LINEOS')
			{
				$tbl = '<table border>
							<tr border-bottom="1">
								<td  style="border-bottom:1px solid #000;" align="center" width="20px"><b>NO</b></td>
								<td  style="border-bottom:1px solid #000;" align="center" width="140px"><b>JENIS BARANG<br>JUMLAH BARANG</b></td>
								<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>TANGGAL<br>-MASUK<br>-KELUAR<br>-JUMLAH HARI</b></td>
								<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>HARI<br>-MASA 1 <br>-MASA 2</b></td>
								<td  style="border-bottom:1px solid #000;" align="center" width="100px"><b>TARIF <br>-PENUMPUKAN <br>-DERMAGA</b></td>
								<td  style="border-bottom:1px solid #000;" align="center" width="100px"><b>SEWA <br>-MASA 1 <br>-MASA 2</b></td>
								<td  style="border-bottom:1px solid #000;" align="center" width="130px" COLSPAN="2"><b>JUMLAH</b></td>

							</tr>';
			}
			else
			{
				$tbl = '<table border>
	        			<tr border-bottom="1">
	        				<td  style="border-bottom:1px solid #000;" align="center" width="20px"><b>NO</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="240px"><b>JENIS JASA</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>BOX</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>SIZE</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>TYPE</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>STS</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>HZ</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>HARI</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>TARIF</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="130px" COLSPAN="2"><b>JUMLAH</b></td>

	        			</tr>';
			}
		} elseif ($data_header->HEADER_SUB_CONTEXT == 'BRG02') {
			$tbl = '<table border>
				<tr border-bottom="1">
				<td  style="border-bottom:1px solid #000;" align="center" width="20px"><b>NO</b></td>
				<td  style="border-bottom:1px solid #000;" align="center" width="240px"><b>JENIS BARANG</b></td>
				<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>BONGKAR</b></td>
				<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>MUAT</b></td>
				<td  style="border-bottom:1px solid #000;" align="center" width="100px"><b>TARIF</b></td>
				<td  style="border-bottom:1px solid #000;" align="center" width="130px" COLSPAN="2"><b>JUMLAH</b></td>
			</tr>';
		}
		else if ($data_header->HEADER_SUB_CONTEXT == 'BRG03' && $data_header->SOURCE_SYSTEM == 'LINEOS') {
                $tbl = '<table border>
	        			<tr border-bottom="1">
	        				<td  style="border-bottom:1px solid #000;" align="center" width="20px"><b>NO</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="120px"><b>JENIS JASA</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="60px"><b>TGL<br>AWAL</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="60px"><b>TGL<br>AKHIR</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>BOX</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>SIZE</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>TYPE</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>STS</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>HZ</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="30px"><b>HARI</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>TARIF</b></td>
	        				<td  style="border-bottom:1px solid #000;" align="center" width="130px" COLSPAN="2"><b>JUMLAH</b></td>

	        			</tr>';
       } else {
				$tbl = '<table border>
						<tr border-bottom="1">
							<td  style="border-bottom:1px solid #000;" align="center" width="20px"><b>NO</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="140px"><b>JENIS BARANG<br>JUMLAH BARANG</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>TANGGAL<br>-MASUK<br>-KELUAR<br>-JUMLAH HARI</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="80px"><b>HARI<br>-MASA 1 <br>-MASA 2</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="100px"><b>TARIF <br>-PENUMPUKAN <br>-DERMAGA</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="100px"><b>SEWA <br>-MASA 1 <br>-MASA 2</b></td>
							<td  style="border-bottom:1px solid #000;" align="center" width="130px" COLSPAN="2"><b>JUMLAH</b></td>

						</tr>';
        }
  
        $tambahanlineos[] = '';
        switch ($layanan) {
            case 'barang':
                $angka = 0;
                $counttl = count($trxline);
                $noAi = 1;
				$countdetail = json_decode(json_encode($trxline),true);
                $data_table_last = '';
				$rupalines = array('data' => array(), 'total' => 0);
                $dataRUPA14 = '';
                foreach ($trxline as $line) {
                    $data_table = $line;
                    // print_r($line);
                    if ($data_header->HEADER_SUB_CONTEXT == 'BRG04' || $data_header->HEADER_SUB_CONTEXT == 'BRG05') {
                        //ANGKUTAN LANGSUNG
                        $this->get_data_barang4($noAi, $no_invoice, $data_table, $data_table_last, $current, $counttl);
                    } elseif ($data_header->HEADER_SUB_CONTEXT == 'BRG09') {
						$this->get_data_barang09($noAi, $no_invoice, $data_table, $data_table_last, $current, $counttl, $angka);
						$angka++;
						$datatd09 .= $data_table;
						$data_table = '';
					} elseif ($data_header->HEADER_SUB_CONTEXT == 'BRG10') {
                        // $this->get_data_barang10($no_invoice,$data_table, $data_table_last,$current,$get_redaksi_x[0],count($trxline),$angka);
						$pfs = strtoupper(substr(trim($line->DESCRIPTION),0,3));						
						if($pfs == 'PFS'){
							$rupalines['data'][] = array(
								'no' => $data_table->LINE_NUMBER,
								'desc' => $data_table->DESCRIPTION,
								'lembar' => $data_table->INTERFACE_LINE_ATTRIBUTE3,
								'jam' => $data_table->INTERFACE_LINE_ATTRIBUTE5,
								// $cr 		= $data_table->CURRENCY_CODE;
								'cr' => 'IDR',
								'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE4,
								'jumlah' => $data_table->AMOUNT,
							);							
						}else{
							$this->get_data_barang10($noAi, $no_invoice, $data_table, $data_table_last, $current, $get_redaksi_x, $counttl, $angka);
						}
                        ++$angka;
                        $datatd10 .= $data_table;
                        $data_table = '';
                    } else if ($data_header->HEADER_SUB_CONTEXT == 'BRG02') {
						$this->get_data_barang02($noAi, $data_table, $data_table_last, $current, $counttl);
					} elseif ($data_header->HEADER_SUB_CONTEXT == 'BRG07' && $data_header->SOURCE_SYSTEM != 'LINEOS') {
                        // $this->get_data_barang10($no_invoice,$data_table, $data_table_last,$current,$get_redaksi_x[0],count($trxline),$angka);
                        $this->get_data_barang07($noAi, $no_invoice, $data_table, $data_table_last, $current, $get_redaksi_x, $counttl, $angka);
                        ++$angka;
                        $datatd07 .= $data_table;
                        $data_table = '';
                    } else {
                        if ($data_header->SOURCE_SYSTEM == 'LINEOS') {
                            $jenislayanan = $data_header->HEADER_SUB_CONTEXT;
                            $desc = $data_table->DESCRIPTION;
                            $tglMasuk = $data_table->START_DATE;
                            $tglKeluar = $data_table->END_DATE;
                            $type = $data_table->INTERFACE_LINE_ATTRIBUTE6;
                            $tarif = $data_table->INTERFACE_LINE_ATTRIBUTE13;
                            $box = $data_table->INTERFACE_LINE_ATTRIBUTE14;
                            $sub_amount = $data_table->INTERFACE_LINE_ATTRIBUTE15;
                            $hz = $data_table->INTERFACE_LINE_ATTRIBUTE4;
                            $sts = $data_table->INTERFACE_LINE_ATTRIBUTE7;
                            $size = $data_table->INTERFACE_LINE_ATTRIBUTE5;
                            $typeline = ($data_table->INTERFACE_LINE_ATTRIBUTE10) == '013' ? 'T'.$data_table->INTERFACE_LINE_ATTRIBUTE10 : ($data_table->INTERFACE_LINE_ATTRIBUTE10) == '000' ? 'T'.$data_table->INTERFACE_LINE_ATTRIBUTE10 : $data_table->INTERFACE_LINE_ATTRIBUTE10; 
                            $diff = date_diff(date_create($tglMasuk), date_create($tglKeluar));
                            $jmlhari = $diff->days;
                            $jmlhari = $data_table->INTERFACE_LINE_ATTRIBUTE9;

                            switch ($data_header->DOC_NUM) {

                                    case 'DLV':
                                        $lineos = new StdClass();
                                        $lineos->DESCRIPTION = $desc;
                                        $lineos->type = $type;
                                        $lineos->tarif = $tarif;
                                        $lineos->box = $box;
                                        $lineos->sub_amount = $sub_amount;
                                        $lineos->hz = $hz;
                                        $lineos->sts = $sts;
                                        $lineos->size = $size;
                                        $lineos->jumlahhari = $jmlhari;

                                        if ($desc != 'ADMINISTRASI') {
                                            if ($desc != 'MATERAI') {
                                                $resultlineos[$typeline][] = $lineos;
                                            }
                                        }

                                        if ($desc == 'ADMINISTRASI' || $desc == 'MATERAI') {
                                            $tambahan->$desc = $sub_amount;
                                            array_push($tambahanlineos, $tambahan);
                                        }

                                        break;

                                    case 'DLVI':
                                        if ($desc != 'ADMINISTRASI') {
                                            if ($desc != 'MATERAI') {
                                                $data_table .= '<tr>';
                                                $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$noAi.'</td>';
                                                $data_table .= '<td align="left">'.$desc.'</td>';
                                                $data_table .= '<td align="center">'.$tglMasuk.'</td>';
                                                $data_table .= '<td align="center">'.$tglKeluar.'</td>';
                                                $data_table .= '<td align="center">'.number_format($box, 0, '', '.').'</td>';
                                                $data_table .= '<td align="center">'.number_format($size, 0, '', '.').'</td>';
                                                $data_table .= '<td align="center">'.$type.'</td>';
                                                $data_table .= '<td align="center">'.$sts.'</td>';
                                                $data_table .= '<td align="center">'.$hz.'</td>';
                                                $data_table .= '<td align="center">'.$jmlhari.'</td>';
                                                $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($tarif, 0, '', '.').'&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                                                $data_table .= '<td width="25">&nbsp;'.$current.'</td>';
                                                $data_table .= '<td width="105" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($sub_amount, 0, ' ', '.').'</td>';
                                                $data_table .= '</tr>';
                                                ++$noAi;
                                            }
                                        }

                                        if ($desc == 'ADMINISTRASI' || $desc == 'MATERAI') {
                                            $tambahan->$desc = $sub_amount;
                                            array_push($tambahanlineos, $tambahan);
                                        }
                                        break;

                                    default:
                                        if ($desc != 'ADMINISTRASI') {
                                            if ($desc != 'MATERAI') {
                                                $data_table .= '<tr>';
                                                $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$noAi.'</td>';
                                                $data_table .= '<td align="left">'.$desc.'</td>';
                                                $data_table .= '<td align="center">'.number_format($box, 0, '', '.').'</td>';
                                                $data_table .= '<td align="center">'.number_format($size, 0, '', '.').'</td>';
                                                $data_table .= '<td align="center">'.$type.'</td>';
                                                $data_table .= '<td align="center">'.$sts.'</td>';
                                                $data_table .= '<td align="center">'.$hz.'</td>';
                                                $data_table .= '<td align="center">'.$jmlhari.'</td>';
                                                $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($tarif, 0, '', '.').'&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                                                $data_table .= '<td width="25">&nbsp;'.$current.'</td>';
                                                $data_table .= '<td width="105" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($sub_amount, 0, ' ', '.').'</td>';
                                                $data_table .= '</tr>';
                                                ++$noAi;
                                            }
                                        }

                                        if ($desc == 'ADMINISTRASI' || $desc == 'MATERAI') {
                                            $tambahan->$desc = $sub_amount;
                                            array_push($tambahanlineos, $tambahan);
                                        }
                                        break;
                                }
                        } else {
                            $this->get_data_barang($noAi, $data_table, $data_table_last, $current, $counttl);
                        }
                    }
                    $tbl .= $data_table;
				}
        
				// Tambahan untuk penggabungan PFS BRG
				if(count($rupalines['data']) > 0 && $data_header->SOURCE_SYSTEM== 'NPKBILLING'){
					$this->get_data_rupa14($noAi, $no_invoice, $data_table, $rupalines, $current);
					if ($data_header->HEADER_SUB_CONTEXT == 'BRG10'){
						$datatd10 .= $data_table;
					}
				}

                // dijabarkan per kelompok untuk PLP
                if ($data_header->SOURCE_SYSTEM == 'LINEOS' && $data_header->DOC_NUM == 'DLV') {
                    $title_lini = 'T03';
                    if ($data_header->DOC_NUM == 'DLV' || $data_header->DOC_NUM == 'DLVI') {
                        $title_lini = $data_header->ATTRIBUTE15;                        
                    }
                    if (isset($resultlineos['T013']) || isset($resultlineos['TO3I'])) {
                        $data_table .= '<tr>';
                        $data_table .= '<td align="left" colspan="12"><b>LINI I ('. $title_lini.')</b></td>';
                        $data_table .= '</tr>';
						
						if($resultlineos['T013'] > 0)
						{
							$resultlini1 = $resultlineos['T013'];
						}
						else
						{
							$resultlini1 = $resultlineos['TO3I'];
						}						
						
                        foreach ($resultlini1 as $key => $value) {
                            $data_table .= '<tr>';
                            $data_table .= '<td align="left">' . ($key + 1) . '</td>';
                            $data_table .= '<td>' . $value->DESCRIPTION . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->box . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->size . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->type . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->sts . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->hz . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->jumlahhari . '</td>';
                            $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($value->tarif, 0, '', '.') . '&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $data_table .= '<td width="20px">' . $current . '</td>';
                            $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right"  width="110px">' . number_format($value->sub_amount, 0, '', '.') . '</td>';
                            $data_table .= '</tr>';
                            $total_sub = $total_sub + (int) $value->sub_amount;
                        }
                        $data_table .= '<tr>';
                        $data_table .= '<td colspan="9"><b>Total LINI I ('. $title_lini.')</b></td>';
                        $data_table .= '<td>' . $current . '</td>';
                        $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook; text-align: right; border-top: 1px solid #00000">' . number_format($total_sub, 0, '', '.') . '</td>';
                        $data_table .= '</tr>';
                    }

                    if (isset($resultlineos['T000']) || isset($resultlineos['LINI2'])) {
                        $data_table .= '<tr>';
                        $data_table .= '<td align="left" colspan="12"> </td>';
                        $data_table .= '</tr>';

                        $data_table .= '<tr>';
                        $data_table .= '<td align="left" colspan="12"><b>LINI II (NON TERMINAL)</b></td>';
                        $data_table .= '</tr>';
						
						if($resultlineos['T000'] > 0)
						{
							$resultlini2 = $resultlineos['T000'];
						}
						else
						{
							$resultlini2 = $resultlineos['LINI2'];
						}							

                        $nomor = 1;
                        foreach ($resultlini2 as $key => $value) {
                            $desc = $value->DESCRIPTION;
                            $sub_amount = $value->sub_amount;
                            $data_table .= '<tr>';
                            $data_table .= '<td align="left">' . $nomor . '</td>';
                            $data_table .= '<td>' . $desc . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->box . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->size . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->type . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->sts . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->hz . '</td>';
                            $data_table .= '<td style="text-align: center;">' . $value->jumlahhari . '</td>';
                            $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($value->tarif, 0, '', '.') . '&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $data_table .= '<td width="20px">' . $current . '</td>';
                            $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right"  width="110px">' . number_format($sub_amount, 0, '', '.') . '</td>';
                            $data_table .= '</tr>';
                            $total_sub2 = $total_sub2 + (int) $value->sub_amount;
                            $nomor++;
                        }
                        $data_table .= '<tr>';
                        $data_table .= '<td colspan="9"><b>Total LINI II</b></td>';
                        $data_table .= '<td>' . $current . '</td>';
                        $data_table .= '<td style="font-size: 11px;font-family: franklingothicbook; text-align: right; border-top: 1px solid #00000">' . number_format($total_sub2, 0, '', '.') . '</td>';
                        $data_table .= '</tr>';
                    }
                    $tbl .= $data_table;
				}

                $data_table_last = str_replace('[counttl]', $noAi, $data_table_last);
                $tbl .= $data_table_last;
                $redaksibody = '';
                if (count($get_redaksi_x) > 0) {
                    $redaksibody = $get_redaksi_x->INV_REDAKSI_ATAS;
                }

                $tbl .= '</table>';
                //$output_name = "LAPORAN PDF NOTA BARANG";
                $output_name = $header_context.'_'.$id.'.pdf';
                break;
        }

        $footer_nota = array(
            'source_system' => $data_header->SOURCE_SYSTEM,
            'headerContext' => $headerContext,
            'headerSubContext' => $data_header->HEADER_SUB_CONTEXT,
            'terbilang' => $terbilang,
            'barcode_location' => $barcode_location,
            'tgl_nota' => $tgl_nota,
            'jabatan_pejabat' => $jabatan_pejabat,
            'ttd_pejabat' => $ttd_pejabat,
            'pejabat' => $pejabat,
            'nip_pejabat' => $nip_pejabat,
            'current' => $current,
            'jum_amount' => $jum_amount,
            'ppn_sendiri' => $ppn_sendiri,
            'uang_jaminan' => $uang_jaminan,
            'total_amount' => $total_amount,
            'jumlahPenganaanPajak' => $jumlahPenganaanPajak,
            'get_redaksi_x' => $get_redaksi_x,
            'unit_loc' => $unit_loc,
            'jmlminimal' => $dataBarangDetail->AMOUNT,
            'data' => array(),
        );

        $footer_nota['data'] = array(
            'status_lunas' => $status_lunas,
            'current' => $current,
            'jum_amount' => $jum_amount,
            'tax_amount' => $tax_amount,
            'materai' => $materai,
            'uang_jaminan' => $uang_jaminan,
            'jum_amount' => $jum_amount,
            'ppn_sendiri' => $ppn_sendiri,
            'u_piutang' => $u_piutang,
            'jmlminimal' => $dataBarangDetail->AMOUNT,
        );
        if ($data_header->SOURCE_SYSTEM == 'LINEOS') {
            $tambahan = json_encode($tambahanlineos[1]);
            // $tambahan = str_replace(array('{', '}'), '', $tambahan);
            // $tambahan = str_replace('[', '{', $tambahan);
            // $tambahan = str_replace(']', '}', $tambahan);
            $tambahan = json_decode($tambahan, true);

            $footer_nota['data']['administrasi'] = $tambahan['ADMINISTRASI'];
            $footer_nota['data']['materai'] = $tambahan['MATERAI'];
        }
        if (!empty($datatd10)) {
            $footer_nota['data']['datatd10'] = $datatd10;
            $footer_nota['data']['redaksibody'] = $redaksibody;
        }
		
		if (!empty($datatd09)) {
			$footer_nota['data']['datatd09'] = $datatd09;
		}
		
        // print_r($footer_nota);
        $footer = footer_nota($footer_nota);
        $ematerai_nota = array(
            'amountMaterai' => $amountMaterai,
            'redaksi' => $redaksi,
            'unit_wilayah' => $unit_wilayah,
            'alamat_wilayah' => $alamat_wilayah,
            'status_lunas' => $status_lunas,
        );
        // print_r($ematerai_nota);die();
        $ematerai_nota = ematerai_nota($ematerai_nota);

        // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->writeHtml($header, true, false, false, false, '');
        // $pdf->SetFont('courier', '', 8);
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($lampiran, true, false, false, false, '');
        $pdf->writeHtml($tbl, true, false, false, false, '');
		
		 if((count($resultlini1) > 8 && count($resultlini2) > 12) || (count($countdetail) > 25 && $data_header->HEADER_SUB_CONTEXT == 'BRG02')) 
		 {
			$pdf->AddPage();
			$pdf->writeHtml($header, true, false, false, false, '');
			$pdf->writeHtml($judul, true, false, false, false, '');
		 }
		
		$pdf->writeHtml($footer, true, false, false, false);  
		 
        $pdf->SetY(260);
        $pdf->writeHtml($ematerai_nota, true, false, false, false, '');
        $pdf->SetPrintFooter(true);

        $pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
        //$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        if ($data_header->SOURCE_SYSTEM == 'LINEOS') {
            //$postContainer = array('ID_REQ' => $no_req);
            $postContainer = array('TRX_NUMBER'=>$num);
            $listcontainer = $this->senddataurl('payment/container', $postContainer, 'POST');
            $judul = '<table>
        			<tr>
        				<td></td>
        			</tr>	
        			<tr>
        				<td></td>
        			</tr>
        			<tr>
        				<td></td>
        			</tr>
        			<tr>
        				<td height="10" width="100"> <b>Lampiran Nota</b></td>
        				<td width="5">: </td>
        				<td>'.$num.'</td>
        		
        			</tr>
        			<tr>
        				<td height="20"> No request</td>
        				<td width="5">: </td>
        				<td>'.$no_req.'</td>
        			</tr>
        			
        			<tr>
	                    <td height="10" width="100%" COLSPAN="4" align="center" style="background-color:#ff4000;color:white;"></td>
					</tr></table>';

            $kontainer = '<table cellpadding="3px">';
            $kontainer .= '<tr>
				<td align="center" width="35px"><b>No</b></td>
				<td align="center" width="150px"><b>No Container</b></td>
				<td align="center" width="40px"><b>Size</b></td>
				<td align="center" width="45px"><b>Type</b></td>
				<td align="center" width="50px"><b>Status</b></td>
				<td align="center" width="40px"><b>HZ</b></td>
            </tr>';
            foreach ($listcontainer as $key => $container) {
                list($sizeCon, $typeCon, $statusCon, $hzCon) = explode('-', $container->LIST_CONT);
                $nomor = $key + 1;
                $kontainer .= '<tr>
				<td align="center">'.$nomor.'.</td>
				<td align="center">'.$container->NO_CONT.'</td>
				<td align="center">'.$sizeCon.'</td>
				<td align="center">'.$typeCon.'</td>
				<td align="center">'.$statusCon.'</td>
				<td align="center">'.$hzCon.'</td>
				</tr>';
            }
            $kontainer .= '</table>';
            $pdf->AddPage();
            $pdf->writeHtml($judul, true, false, false, false, '');
            $pdf->writeHtml($kontainer, true, false, false, false, '');
        }
        ob_end_clean();
        $pdf->Output($output_name, 'I');
    }
	
	public function get_nota_redaksi($id, $layanan)
	{
		return $this->auth_model->get_nota_redaksi2($id, $layanan);

	}

	public function get_data_barang07(&$noAi, $no_invoice, &$data_table, &$data_table_last, &$current, $get_redaksi_x, $countLine, $angka)
	{
		//data diambil dari trx_line
		$no = $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc = ($data_table->DESCRIPTION == NULL ) ? $data_table->INTERFACE_LINE_ATTRIBUTE2 : $data_table->DESCRIPTION;
		
		//print_r($desc);die;
		$tgl_awal = $data_table->CREATION_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir = $data_table->LAST_UPDATED_DATE;
		// echo "JADI"; die();

		//$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		//print_r($size);die;
		//list($size,$type,$sts,$hz) = split(" ",$att6, 4);
		$hari = $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE10;
		$kemasan = $data_table->INTERFACE_LINE_ATTRIBUTE12;
		$jumlahSatuan = $data_table->INTERFACE_LINE_ATTRIBUTE13;
		$satuan = $data_table->INTERFACE_LINE_ATTRIBUTE14;
		$jumlah = $data_table->AMOUNT;

		// print_r($data_table);die;

		// $data_table ='<table border="1px">';
		$data_table = '';
		if ($desc == "MATERAI") {
			$data_table_last .= '';		
		}else{
			$data_table .= '<tr>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" width="30px">' . $noAi . '</td>';
			$data_table .= '<td align="left" width="170px">' . $desc . '</td>';
			$data_table .= '<td align="right" width="40px">' . $current . '</td>'; //taro disini blum bisa nampil
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right" width="110px">' . number_format($jumlah, 0, ' ', '.') . '</td>';
			
			$data_table .= '</tr>';
			++$noAi;
		}	
	}
	public function get_data_barang10(&$noAi, $no_invoice, &$data_table, &$data_table_last, &$current, $get_redaksi_x, $countLine, $angka)
	{
		//data diambil dari trx_line
		$no = $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc = ($data_table->INTERFACE_LINE_ATTRIBUTE2 == NULL ) ? $data_table->DESCRIPTION : $data_table->INTERFACE_LINE_ATTRIBUTE2;
		//print_r($desc);die;
		$tgl_awal = $data_table->CREATION_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir = $data_table->LAST_UPDATED_DATE;

		//$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		//print_r($size);die;
		//list($size,$type,$sts,$hz) = split(" ",$att6, 4);
		$hari = $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE10;
		$kemasan = $data_table->INTERFACE_LINE_ATTRIBUTE12;
		$jumlahSatuan = $data_table->INTERFACE_LINE_ATTRIBUTE13;
		$satuan = $data_table->INTERFACE_LINE_ATTRIBUTE14;
		$jumlah = $data_table->AMOUNT;

		// print_r($data_table);die;

		// $data_table ='<table border="1px">';
		$data_table = '';
		if ($desc == "MATERAI") {
			$data_table_last .= '';		
		} else {
			$data_table .= '<tr>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" width="30px">' . $noAi . '</td>';
			$data_table .= '<td align="left" width="170px">' . $desc . '</td>';
			$data_table .= '<td align="right" width="40px">' . $current . '</td>'; //taro disini blum bisa nampil
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right" width="110px">' . number_format($jumlah, 0, ' ', '.') . '</td>';
			
			$data_table .= '</tr>';
			++$noAi;	
		}
	}
	public function get_data_rupa14(&$noAi, $no_invoice,&$data_table,&$rupalines,$current) {
		
		$total = 0;
		for($i=0; $i < count($rupalines['data']); $i++) {
			$total = $total + $rupalines['data'][$i]['jumlah'];
		}

		$data_table = '';
		$data_table .= '<tr>';
		$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" width="30px">' . $noAi . '</td>';
		$data_table .= '<td align="left" width="170px">PORT FACILITY SERVICE</td>';
		$data_table .= '<td align="right" width="40px">' . $current . '</td>'; //taro disini blum bisa nampil
		$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right" width="110px">' . number_format($total, 0, ' ', '.') . '</td>';
		
		$data_table .= '</tr>';
		$noAi++;
	}
	public function get_data_barang09(&$noAi, $no_invoice, &$data_table, &$data_table_last, &$current, $get_redaksi_x, $countLine, $angka)
	{
		//data diambil dari trx_line
		$no = $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc = ($data_table->DESCRIPTION == NULL ) ? $data_table->INTERFACE_LINE_ATTRIBUTE2 : $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal = $data_table->CREATION_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir = $data_table->LAST_UPDATED_DATE;

		//$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		//print_r($size);die;
		//list($size,$type,$sts,$hz) = split(" ",$att6, 4);
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE10;
		$jumlah = $data_table->AMOUNT;
		
		footer_nota($jumlah);

		// print_r($data_table);die;

		// $data_table ='<table border="1px">';
		$data_table = '';
		if ($desc == "MATERAI") {
			$data_table_last .= '';		
		}else {
		// $data_table_last ='';
			$data_table .= '<tr>';
			$data_table .= '<td align="center" style="font-size: 11px;font-family: franklingothicbook;" >' . $noAi . '</td>';
			$data_table .= '<td align="center" >' . $desc . '</td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ><strong></strong></td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table .= '<td >' . $current . '</td>'; //taro disini blum bisa nampil
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right" >' . number_format($jumlah, 0, ' ', '.') . '</td>';
			$data_table .= '</tr>';
			$noAi++;
		}
	}	
	public function get_data_barang4(&$noAi, $no_invoice, &$data_table, &$data_table_last, &$current, $counttl)
	{
		//data diambil dari trx_line
		$no = $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc = $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal = $data_table->CREATION_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir = $data_table->LAST_UPDATED_DATE;

		//$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		//print_r($size);die;
		//list($size,$type,$sts,$hz) = split(" ",$att6, 4);
		$hari = $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE10;
		$kemasan = $data_table->INTERFACE_LINE_ATTRIBUTE12;
		$jumlahSatuan = $data_table->INTERFACE_LINE_ATTRIBUTE13;
		$satuan = $data_table->INTERFACE_LINE_ATTRIBUTE14;
		$jumlah = $data_table->AMOUNT;
		
		footer_nota($jumlah);

		// print_r($data_table);die;

		// $data_table ='<table border="1px">';
		$data_table = '';
		// $data_table_last ='';
		if ($desc == "BIAYA ADMINISTRASI") {
			$data_table_last .= '<tr>';
			$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" >[counttl]</td>';
			$data_table_last .= '<td align="center" >' . $desc . '</td>';
			$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" ></td>';
			$data_table_last .= '<td >' . $current . '</td>'; //taro disini blum bisa nampil
			$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right" >' . number_format($jumlah, 0, ' ', '.') . '</td>';
			$data_table_last .= '</tr>';
		}else if ($desc == "MINIMAL") {
			$data_table_last .= '';		
		}else if ($desc == "MATERAI") {
			$data_table_last .= '';		
		}else {
			$data_table .= '<tr>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" >' . $noAi . '</td>';
			$data_table .= '<td align="center" >' . $desc . '</td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" >' . $kemasan . '</td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" >' . number_format($jumlahSatuan, 0, ' ', '.') . '</td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" >' . $satuan . '</td>';
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center" >' . number_format($tarif, 0, ' ', '.') . '</td>';
			$data_table .= '<td >' . $current . '</td>'; //taro disini blum bisa nampil
			$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right" >' . number_format($jumlah, 0, ' ', '.') . '</td>';
			$data_table .= '</tr>';
			$noAi++;
		}
		// $data_table .='</table>';
	}

	public function get_data_barang02(&$noAi, &$data_table, &$data_table_last, &$current, $counttl)
	{
		
		$desc = $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal = $data_table->CREATION_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir = $data_table->LAST_UPDATED_DATE;

		$tglMasuk = $data_table->INTERFACE_LINE_ATTRIBUTE2;
		$tglKeluar = $data_table->INTERFACE_LINE_ATTRIBUTE3;
		$bongkar = $data_table->INTERFACE_LINE_ATTRIBUTE4;
		$muat = $data_table->INTERFACE_LINE_ATTRIBUTE5;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE6;
		// $sewamasa1 = $data_table->INTERFACE_LINE_ATTRIBUTE7;
		// $sewamasa2 = $data_table->INTERFACE_LINE_ATTRIBUTE8;
		// $hari = $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$jumlah = $data_table->AMOUNT;
		// $jumlahSatuan = $data_table->INTERFACE_LINE_ATTRIBUTE13;
		// $satuan = $data_table->INTERFACE_LINE_ATTRIBUTE14;
		// $diff = date_diff(date_create($tglMasuk), date_create($tglKeluar));
		// $jmlhari = $diff->days;
		// $jmlhari = $jmlhari+1;
		// $data_table ='<table border="">';
		$data_table = '';
		if ((int)$jumlah > 0) {
			// $data_table .='<tr><td></td></tr>';
			if ($desc == "MATERAI") {
				$data_table_last .= '';		
			}else {
				$data_table .= '<tr>';
					$data_table .= '<td align="center" style="font-size: 11px;font-family: franklingothicbook;" align="center">' . $noAi . '</td>';
					$data_table .= '<td align="left">' . $desc . '</td>';
					$data_table .= '<td align="center">'.number_format($bongkar, 0, ',', '.').'</td>';
					$data_table .= '<td align="center">'.number_format($muat, 0, ',', '.').'</td>';
					$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($tarif, 0, ' ', '.') . '&nbsp; &nbsp;</td>';
					$data_table .= '<td width="20">' . $current . '</td>'; //taro disini blum bisa nampil
					$data_table .= '<td width="110" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($jumlah, 0, ' ', '.') . '</td>';
					$data_table .= '</tr>';

					$noAi++;
			}
		}
		// $data_table .='</table>';
	}

	public function get_data_barang(&$noAi, &$data_table, &$data_table_last, &$current, $counttl)
	{
		
		$desc = $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal = $data_table->CREATION_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir = $data_table->LAST_UPDATED_DATE;
		
		$tglMasuk = $data_table->INTERFACE_LINE_ATTRIBUTE2;
		$tglKeluar = $data_table->INTERFACE_LINE_ATTRIBUTE3;
		$masa1 = $data_table->INTERFACE_LINE_ATTRIBUTE4;
		$masa2 = $data_table->INTERFACE_LINE_ATTRIBUTE5;
		$masa3 = $data_table->INTERFACE_LINE_ATTRIBUTE6;
		$sewamasa1 = $data_table->INTERFACE_LINE_ATTRIBUTE7;
		$sewamasa2 = $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$sewamasa3 = $data_table->INTERFACE_LINE_ATTRIBUTE9;
		//$hari = $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif = $data_table->INTERFACE_LINE_ATTRIBUTE10;
		$jumlah = $data_table->AMOUNT;
		$jumlahSatuan = $data_table->INTERFACE_LINE_ATTRIBUTE13;
		$satuan = $data_table->INTERFACE_LINE_ATTRIBUTE14;
		$diff = date_diff(date_create($tglMasuk), date_create($tglKeluar));
		$jmlhari = ($diff->days) == 0 ? '' : $diff->days;	
		
		//$date1 = new DateTime($data_table->INTERFACE_LINE_ATTRIBUTE2);
		//$date2 = new DateTime($data_table->INTERFACE_LINE_ATTRIBUTE3);
		
		//$jmlhari = $date2->diff($date1)->format("%a");
		
		
		// $data_table ='<table border="">';
		$data_table = '';
		
		if ((int)$jumlah > 0) {
			// $data_table .='<tr><td></td></tr>';

			if ($desc == "BIAYA ADMINISTRASI") {
				$data_table_last .= '<tr>';
				$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center">' . $counttl . '</td>';
				$data_table_last .= '<td align="left" COLSPAN="5" width="502">' . $desc . '</td>';
				$data_table_last .= '<td>' . $current . '</td>'; //taro disini blum bisa nampil
				$data_table_last .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($jumlah, 0, ' ', '.') . '</td>';
				$data_table_last .= '</tr>';
			} else if ($desc == "MINIMAL") {
				$data_table_last .= '';		
			} else if ($desc == "MATERAI") {
				$data_table_last .= '';		
			} else {
				$data_table .= '<tr>';
				$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center">' . $noAi . '</td>';
				$data_table .= '<td align="left">' . $desc . '</td>';
				$data_table .= '<td align="center">' . $tglMasuk . '<br>' . $tglKeluar . '<br>' . $jmlhari . '</td>';
				$data_table .= '<td align="center">' . $masa1 . '<br>' . $masa2 . '<br>' . $masa3 .'</td>';
				$data_table .= '<td style="font-size: 11px;font-family: franklingothicbook;" align="center">' . number_format($tarif, 0, ' ', '.') . '</td>';
				$data_table .= '<td align="center"  width="102">' . number_format($sewamasa1, 0, ' ', '.') . '<br>' . number_format($sewamasa2, 0, ' ', '.') . '<br>' . number_format($sewamasa3, 0, ' ', '.') . '</td>';
				$data_table .= '<td width="20">' . $current . '</td>'; //taro disini blum bisa nampil
				$data_table .= '<td width="110" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($jumlah, 0, ' ', '.') . '</td>';
				$data_table .= '</tr>';

                ++$noAi;
			}
		}
		// $data_table .='</table>';
	}

	public function common_loader($data, $views)
	{
		/*
		if (!$this->session->userdata('is_login')) {
			redirect(ROOT . 'main_invoice', 'refresh');
		}
		$role_id = $this->session->userdata('role_id');
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		*/
		/*Add Logic apakah sesion eInvoice atau eService : Derry Othman 5 Oct 2019*/
		//eService
		if ($this->session->userdata('invoice')) {
			if (! $this->session->userdata('is_login') ){
				redirect(ROOT.'main_invoice', 'refresh');
			}		
			$role_id =  $this->session->userdata('role_id')	;
			$data['role_child'] = $this->auth_model->get_child_role($role_id);
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

}
class MyCustomPDFWithWatermark extends TCPDF
{
	public function Header()
	{
            // Get the current page break margin
		$bMargin = $this->getBreakMargin();

            // Get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;

            // Disable auto-page-break
		$this->SetAutoPageBreak(false, 0);

            // Define the path to the image that you want to use as watermark.
		if (!defined(img_file)) {
            	// echo img_file;die();
			$img_file = img_file;
		} else {
			$img_file = APP_ROOT . 'assets/images/copy.png';
		}

            // Render the image
		$this->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

            // Restore the auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);

            // Set the starting point for the page content
		$this->setPageMark();
	}
	public function Footer()
	{
	        // Position at 15 mm from bottom
		$this->SetY(-15);
	        // Set font
	        // $this->SetFont('helvetica', 'I', 8);
	        // Page number
		$this->Cell(0, 10, noNotaFooter, 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, "Print Date : " . date("d-M-Y H:i:s") . ' | Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}