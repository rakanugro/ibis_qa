<?php

date_default_timezone_set('Asia/Bangkok');
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//session_start();
require APPPATH.'helpers/tcpdf/tcpdf.php';
class Nota extends CI_Controller
{
    public $API = '';

    public function __construct()
    {
        // echo "===>cek";die();
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
        // $uri = SITE_WSAPI.'/'.$url;
        //$uri = $this->API.'/'.$url;
        $uri = API_EINVOICE.'/'.$url;
        // print_r($uri);die();
        $apiKey = '123456';
        $params = array(
            'Content-Type: application/json',
            'x-api-key:'.$apiKey,
        );

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
        $ex = curl_exec($ch);

        /*if (preg_match("/OK/i", $ex)) {
            $result = "curl sukses! (OUTPUT: ".$ex.")";
            echo $result; exit;
        } else {
            $result = "curl gagal! (OUTPUT: ".$ex.")";
            echo $result; exit;
        }*/

        $data = json_decode($ex);
        return $data;
    }

    protected function senddataurl($url, $data, $type)
    {
        //$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
        $uri = API_EINVOICE.'/'.$url;
        //die($uri);
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $ex = curl_exec($ch);
        /*if (preg_match("/OK/i", $ex)) {
            $result = "curl sukses! (OUTPUT: ".$ex.")";
            echo $result; die();
        } else {
            $result = "curl gagal! (OUTPUT: ".$ex.")";
            echo $result; die();
        }*/

        $result = json_decode($ex);
        // $ex = curl_exec($ch);
        /*file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
             array(
                 'body' => $ex,
                 'url' => $uri,
                 'data' => $data,
         ), true), FILE_APPEND);*/

        return $result;
    }

    public function notakapal()
    {
        // $data = $this->getdataurl('invh');
        $role_id = $this->session->userdata('role_id');
        $data['layanan'] = $this->auth_model->get_layanan($role_id);
        $this->common_loader($data, 'invoice/nota/kapal/cekpkk');
    }

    public function pkksearch()
    {
        $postdata = $_POST;
        $postdata['KD_CABANG'] = '10';
        $postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');
        $start = !empty($_POST['length']) ? $_POST['start'] : 0;
        $length = !empty($_POST['length']) ? $_POST['length'] : 10;
        $draw = !empty($_POST['draw']) ? $_POST['draw'] : 0;
        $postdata['offset'] = $start + $length;
        // echo print_r($postdata); die();
        $arrayData = $this->senddataurl('reviewPKK/', $postdata, 'POST');
        $header = json_decode(json_encode($arrayData->header), true);
        $data = array(
                'data' => array(),
            );
        $num = 1;
        // echo print_r($arrayData->header->RUPA05);die();
        foreach ($arrayData->data as $key => $value) {
            $data['data'][$key] = $value;
            $data['data'][$key]->num = $num;
            //$data['data'][$key]->
            //$data['data'][$key]->AMOUNT_TOTAL = number_format($value->AMOUNT_TOTAL);
            //$data['data'][$key]->notaJenis = $header[$value->KODE_LAYANAN];
            //$data['data'][$key]->action = '<a onclick="Cetak(\''.$value->TRX_NUMBER.'\',\''.$value->KODE_LAYANAN.'\')"  class="btn btn-primary"><i class="fa fa-print"></i> </a>';
            // <a target="" href="'.ROOT.'einvoice/cibarang/cetak_barang/barang/'.$value->TRX_NUMBER.'"><i class="button">Invoice</i></a>
        }
        $dataTableArr = array(
            'draw' => intval($draw),
            'recordsTotal' => intval($arrayData->recordsTotal),
            'recordsFiltered' => intval($arrayData->recordsTotal),
        );
        $dataTableArr = array_merge($dataTableArr, $data);
        echo json_encode($dataTableArr);
    }

    public function sendemail()
    {
        $this->common_loader($data, 'pages/mails/send_mails');
    }

    public function send_mail()
    {
        /*$config = Array(
            'protocol'	=> 'smtp',
            'smtp_host'	=> 'ssl://smtp.googlemail.com',
            'smtp_port'	=> 465,
            'smtp_user'	=> 'jefiegeofani@gmail.com',
            'smtp_pass'	=> 'geofani1390',
            'mailtype'	=> 'html',
            'charset'	=> 'iso-8859-1'
           );
           $this->load->library('email', $config);
           $this->email->set_newline("\r\n");
           $this->email->from('jefiegeofani@gmail.com', 'Admin Re:Code');
           $this->email->to('jefiegeofani@gmail.com');
           $this->email->subject('Percobaan email');
           $this->email->message('Ini adalah email percobaan untuk Tutorial CodeIgniter: Mengirim Email via Gmail SMTP menggunakan Email Library CodeIgniter @ recodeku.blogspot.com');
           print_r($message);
           if (!$this->email->send()) {
            show_error($this->email->print_debugger());
           }else{
            echo 'Success to send email';
           } */
        require_once APPPATH.'libraries/PHPMailerAutoload.php';
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jefiegeofani@gmail.com';
        $mail->Password = 'geofani1390';
        $mail->Port = 465;

        $mail->setFrom('jefiegeofani@gmail.com', 'Percobaan');
        $mail->addAddress('jefiegeofani@gmail.com', 'penerima');
        $mail->addReplyTo('jefiegeofani@gmail.com', 'percobaan');
        $mail->isHTML(true);

        $mail->Subject = 'Percobaan';
        $mail->Body = 'This is percobaan Bung';
        $mail->AltBody = 'This is Body buat non HTML';
        $destino = 'jefiegeofani@gmail.com'; // Who is addressed the email to
        $mail->AddAddress('jefiegeofani@gmaail.com', 'Cahya Dy');
        $mail->AddAttachment('');      // some attached files
        $mail->AddAttachment('');

        if ($mail->Send()) {
            $data['message'] = 'Message sent correctly!';
        } else {
            $data['message'] = 'Error: '.$mail->ErrorInfo;
        }

        $this->load->view('send_mails.php', $data);

        /*$from_email = "jefiegeofani@gmail.com";
        $to_email = $this->input->post('mail_customer');
        $receive = $this->input->post('customer_');

        //Load email library
        $this->load->library('email');

        $this->email->from($from_email, 'Jefie Geofani');
        $this->email->to($to_email);
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        //print_r($this->email);

        //Send mail
        if($this->email->send())
            $this->session->set_flashdata("email_sent","Email sent successfully.");
        else
            $this->session->set_flashdata("email_sent","Error in sending Email.");
            $this->load->view('send_mails');*/
    }

    public function dkk()
    {
        // $data = $this->getdataurl('invh');
        $role_id = $this->session->userdata('role_id');
        $data['layanan'] = $this->auth_model->get_layanan($role_id);
        $this->common_loader($data, 'invoice/nota/kapal/datakapalkeluar');
    }

    public function kapal($layanan)
    {
        $role_id = $this->session->userdata('role_id');

        if ($layanan == 'kapal') {
            $data['layanan'] = $this->auth_model->get_layanan($role_id);
            $data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/KAPAL');
            //$this->common_loader($data, 'invoice/nota/kapal/kapal');
			if ($this->session->userdata('eservice')) {
				$this->common_loader($data, 'invoice/nota/kapal/kapaleservice');
			} else {
				$this->common_loader($data, 'invoice/nota/kapal/kapal');
			}			
        } elseif ($layanan == 'koreksi') {
            $data['layanan'] = $this->auth_model->get_layanan($role_id);
            $data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/KAPAL');
            $this->common_loader($data, 'invoice/nota/kapal/koreksi');
        }
    }

    public function kapalupdate()
    {
        $postdata = ($_POST);
        /*print_r($postdata);die();*/
        $dataArray = $this->senddataurl('InvoiceHeader/statusCetak', $postdata, 'POST');
    }

/*TIDAK TERPAKAI SEMENTARA
	public function kapalsearch()
    {
        $postdata = ($_POST);

        $kapal = $this->senddataurl('invh/search/', $postdata, 'POST');

        $data = array();
        $no = 1;
        // echo print_r($data);die();
        foreach ($kapal as $item) {
            $notaJenis = $this->getdataurl('mstnota/getData/'.$item->HEADER_SUB_CONTEXT);

            if (count($notaJenis) > 0) {
                foreach ($notaJenis as $key => $jenis) {
                    $jenisNota = $jenis->INV_NOTA_JENIS;
                }
            } else {
                $jenisNota = '';
            }

            $row = array();
            /*$row[] = $no++;*/
            /*$row[] = htmlspecialchars($item->TRX_NUMBER, ENT_QUOTES);
            $row[] = htmlspecialchars($item->INTERFACE_HEADER_ATTRIBUTE6, ENT_QUOTES); //PKK
            $row[] = htmlspecialchars($item->INTERFACE_HEADER_ATTRIBUTE1, ENT_QUOTES); //PPKB
            $row[] = htmlspecialchars($jenisNota, ENT_QUOTES);
            $row[] = htmlspecialchars(date('Y-m-d', strtotime($item->TRX_DATE, ENT_QUOTES)));
            $row[] = htmlspecialchars($item->CUSTOMER_NAME, ENT_QUOTES);
            $row[] = "<div align='right'>".(strpos($item->AMOUNT, ',') == '') ? number_format($item->AMOUNT, 0, ',', ',') : $item->AMOUNT.'</div>';
            if ($item->STATUS_LUNAS == 'Y') {
                $status = 'LUNAS';
            } elseif ($item->STATUS_LUNAS == 'X') {
                $status = 'KOREKSI';
            } else {
                $status = 'BELUM LUNAS';
            }
            $token_dpjk_dtjk = md5(sha1(md5(base64_encode(base64_encode($item->INTERFACE_HEADER_ATTRIBUTE6).base64_encode($item->INTERFACE_HEADER_ATTRIBUTE1)))));
            $token_nota = md5(sha1(md5(base64_encode($item->TRX_NUMBER))));

            $row[] = htmlspecialchars($status, ENT_QUOTES);

            if ($item->STATUS_CETAK == 1) {
                $row[] = '<input type=checkbox name=c1 style="width:20px;height:20px" class="disabled" disabled checked >';
            } else {
                $row[] = '<input type=checkbox name=c1 style="width:20px;height:20px" class="disabled" disabled >';
            }

            if ($item->STATUS_KIRIM_EMAIL == 1) {
                $row[] = '<input type=checkbox  style="width:20px;height:20px" name=c1 class="disabled" disabled checked >';
            } else {
                $row[] = '<input type=checkbox name=c1  style="width:20px;height:20px" class="disabled" disabled >';
            }
            // $data['data'][$key]->action = '<center><a target="_blank" class="btn btn-primary fa-lg" href="'.ROOT.'einvoice/nota/cetak_nota/RUPARUPA/'.$enc_trx_number.'"><i class="fa fa-print"></i> Cetak</a></center>';

            $enc_trx_number = $this->mx_encryption->encrypt($item->TRX_NUMBER);

            $enc_ukk_ppkb = $this->mx_encryption->encrypt($item->INTERFACE_HEADER_ATTRIBUTE6.'|'.$item->INTERFACE_HEADER_ATTRIBUTE1);
            // $item->BRANCH_CODE
            $row[] = '<a class="btn btn-sm btn-primary" target="_blank" title=" CETAK DTJK DPJK" href="'.ROOT.'dashboard_invoice/cetak_dpjk_dtjk/'.$item->INTERFACE_HEADER_ATTRIBUTE6.'/'.$item->BRANCH_CODE.'/'.$item->INTERFACE_HEADER_ATTRIBUTE1.'/'.$enc_trx_number.'" > <i class="fa fa-print"></i></a> |



			<a class="btn btn-sm btn-primary" target="_blank"  href="'.ROOT.'einvoice/nota_kapal/cetak_nota_kapal/'.$enc_trx_number.'" data-ukk="'.$item->TRX_NUMBER.'" data-cabang="10"  id="btn_'.$item->TRX_NUMBER.'" title="Cetak NOTA" onclick="cetak_nota()" data-id="'.$item->TRX_NUMBER.'" > <i class="fa fa-print"></i>  NOTA</a>';

            $data[] = $row;
        }
        $output = array(
                'data' => $data,
        );
        //output to json format
        echo json_encode($output);
    }*/
	
	public function kapalsearch()
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
		
		$nJenis = json_decode(json_encode($arrayData,true),true);
		//$notaJenis = $this->getdataurl('mstnota/getData/'.$nJenis[0][HEADER_SUB_CONTEXT]);
        // START PENAMBAHAN JENIS NOTA BY SIGMA 11/11/19
		$notaJenis = $this->getdataurl('mstnota/getData/'.$nJenis[result][0][HEADER_SUB_CONTEXT].'/'.$nJenis[result][0][HEADER_CONTEXT]);
        // STOP PENAMBAHAN JENIS NOTA BY SIGMA 11/11/19

            if (count($notaJenis) > 0) {
                foreach ($notaJenis as $jn => $jenis) {
                    $jenisNota = $jenis->INV_NOTA_JENIS;
                }
            } else {
                $jenisNota = '';
            }

        foreach ($arrayData->result as $key => $value) {
            $data['data'][$key] = $value;
            $data['data'][$key]->num = $num;
            $data['data'][$key]->TRX_DATE = $value->TRX_DATE;//date('Y-m-d', strtotime($value->TRX_DATE));
            $token_cetak_kapal = md5(sha1(md5(base64_encode($value->TRX_NUMBER).base64_encode('kapal'))));
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
			$data['data'][$key]->NO_PKK = $value->INTERFACE_HEADER_ATTRIBUTE6;
			$data['data'][$key]->NO_PPKB = $value->INTERFACE_HEADER_ATTRIBUTE1;
			$data['data'][$key]->NAMA_KAPAL = $value->VESSEL_NAME;
			$data['data'][$key]->KUNJUNGAN = $value->INTERFACE_HEADER_ATTRIBUTE4;
			$data['data'][$key]->JENIS = $jenisNota;
            $data['data'][$key]->PC = "<input type=checkbox style='width:20px;height:20px' disabled $cetak>";
            $data['data'][$key]->STATUS_LUNAS = $statusL;
            $data['data'][$key]->AMOUNT = number_format($value->AMOUNT, 0, ' ', '.');
            $data['data'][$key]->PK = "<input type=checkbox  style='width:20px;height:20px' disabled $email>";

			$data['data'][$key]->PER_KUNJUNGAN = $value->PER_KUNJUNGAN_FROM ." s/d ".$value->PER_KUNJUNGAN_TO;
			$data['data'][$key]->VESSEL_NAME = $value->VESSEL_NAME;
			
			//add by Derry utk view PDJK di eService
			if ($this->session->userdata('eservice')) {
				$data['data'][$key]->action = '<a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota_kapal/cetak_nota_kapal/'.$enc_trx_number.'"><i class="fa fa-print" ></i> Cetak Nota</a><p>'.
				'<div></div><a class="btn btn-sm btn-primary btn-xs print_dpjk btn-ok"  href="javascript:void(0)" data-ukk="'.$value->INTERFACE_HEADER_ATTRIBUTE6.'" data-cabang="10" data-branch="'.$value->BRANCH_CODE.'" data-ppkb="'.$value->INTERFACE_HEADER_ATTRIBUTE1.'" title="Cetak DPJK" onclick="print_dpjk()" data-id="'.$value->INTERFACE_HEADER_ATTRIBUTE6.'" > <i class="fa fa-print"></i> DTJK/DPJK</a> ';
			} else {	
				$data['data'][$key]->action = '<a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota_kapal/cetak_nota_kapal/'.$enc_trx_number.'"><i class="fa fa-print" ></i> Cetak Nota</a>';
            } 				
            //$data['data'][$key]->action = '<a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota_kapal/cetak_nota_kapal/'.$enc_trx_number.'"><i class="fa fa-print" ></i> Cetak</a>';
                
        }

        echo json_encode($data);
    }

    public function kapalkoreksi()
    {
        $postdata = ($_POST);
        $postdata['ORG_ID'] = $this->session->userdata('unit_org');
        $postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');

        $kapal = $this->senddataurl('CreateInvoiceKapalKoreksi/viewKoreksi/', $postdata, 'POST');

        $data = array();
        $no = 1;
        //echo print_r($kapal->header);die();

        foreach ($kapal as $item) {//print_r($item);die;
            //$notaJenis = $this->getdataurl('mstnota/getData/'.$item->HEADER_SUB_CONTEXT);

            if (count($notaJenis) > 0) {
                foreach ($notaJenis as $key => $jenis) {
                    $jenisNota = $jenis->INV_NOTA_JENIS;
                }
            } else {
                $jenisNota = '';
            }

            $row = array();
            /*$row[] = $no++;*/
            //$row[] = htmlspecialchars($item->TRX_NUMBER,ENT_QUOTES);
            $row[] = htmlspecialchars($item->NO_UKK, ENT_QUOTES);
            $row[] = htmlspecialchars($item->KD_PPKB, ENT_QUOTES); //PKK
            $row[] = htmlspecialchars($item->PELAYARAN_PKK, ENT_QUOTES); //PPKB
            $row[] = htmlspecialchars(date('d-m-Y', strtotime($item->TGL_JAM_BERANGKAT, ENT_QUOTES)));
            $row[] = htmlspecialchars($item->NM_AGEN, ENT_QUOTES);
            $row[] = "<div align='right'>".(strpos($item->AMOUNT, ',') == '') ? number_format($item->AMOUNT, 0, ',', ',') : $item->AMOUNT.'</div>';
            if ($item->STATUS_LUNAS == 'Y') {
                $status = 'LUNAS';
            } elseif ($item->STATUS_LUNAS == 'X') {
                $status = 'KOREKSI';
            } else {
                $status = 'BELUM LUNAS';
            }
            $token_dpjk_dtjk = md5(sha1(md5(base64_encode(base64_encode($item->INTERFACE_HEADER_ATTRIBUTE6).base64_encode($item->INTERFACE_HEADER_ATTRIBUTE1)))));
            $token_nota = md5(sha1(md5(base64_encode($item->TRX_NUMBER))));

            $row[] = htmlspecialchars($status, ENT_QUOTES);

            if ($item->STATUS_CETAK == 1) {
                $row[] = '<input type=checkbox name=c1 style="width:20px;height:20px" class="disabled" disabled checked >';
            } else {
                $row[] = '<input type=checkbox name=c1 style="width:20px;height:20px" class="disabled" disabled >';
            }

            if ($item->STATUS_KIRIM_EMAIL == 1) {
                $row[] = '<input type=checkbox  style="width:20px;height:20px" name=c1 class="disabled" disabled checked >';
            } else {
                $row[] = '<input type=checkbox name=c1  style="width:20px;height:20px" class="disabled" disabled >';
            }
            // $data['data'][$key]->action = '<center><a target="_blank" class="btn btn-primary fa-lg" href="'.ROOT.'einvoice/nota/cetak_nota/RUPARUPA/'.$enc_trx_number.'"><i class="fa fa-print"></i> Cetak</a></center>';

            $enc_trx_number = $this->mx_encryption->encrypt($item->TRX_NUMBER);

            $enc_ukk_ppkb = $this->mx_encryption->encrypt($item->INTERFACE_HEADER_ATTRIBUTE6.'|'.$item->INTERFACE_HEADER_ATTRIBUTE1);
            // $item->BRANCH_CODE
			$row[] = '<a class="btn btn-sm btn-primary btn-xs print_dpjk btn-ok"  href="javascript:void(0)" data-ukk="'.$item->NO_UKK.'" data-cabang="10" data-branch="'.$item->BRANCH_CODE.'" data-ppkb="'.$item->KD_PPKB.'" title="Cetak Koreksi"  data-id="'.$item->NO_UKK.'" > <i class="fa fa-refresh"></i>   </a>  
			
			| <a class="btn btn-sm btn-primary" target="_blank"  href="'.ROOT.'einvoice/nota_kapal/cetak_nota_kapal/'.$enc_trx_number.'" data-ukk="'.$item->TRX_NUMBER.'" data-cabang="10"  id="btn_'.$item->TRX_NUMBER.'" title="Cetak NOTA" onclick="cetak_nota()" data-id="'.$item->TRX_NUMBER.'" > <i class="fa fa-print"></i>   </a>'; 
			
			$data[] = $row;
		}
		$output = array(
				"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function allsearch()
	{
		$postdata = ($_POST);
		$data['nota'] = $this->getdataurl('nota');
		/*print_r($postdata);die();*/
		$dataArray = $this->senddataurl('pengiriman/search/',$postdata,'POST');
		$data = array(
			'data'=>array()
		);
		$num = 1;
		foreach($dataArray as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values);
	 		}
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			$data['data'][$key]->NOTA_DATE =  date('Y-m-d', strtotime($value->NOTA_DATE));
			$enc_trx_number = $this->mx_encryption->encrypt($value->NO_NOTA);
			$data['data'][$key]->action = '<center><button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_main" onclick="kirim(\''.$enc_trx_number.'\',\''.$value->CUSTOMER.'\',\''.$value->TO_EMAIL.'\',\''.$value->LAYANAN.'\')" data-dismiss="modal"><i class="fa fa-envelope fa-1" aria-hidden="true"></i></button></center>';
			// $data['data'][$key]->action = "action";
            if ($value->SEND_STATUS == '1') {
                $data['data'][$key]->SEND_STATUS = 'SUDAH';
			}else{
                $data['data'][$key]->SEND_STATUS = 'BELUM';
			}
            ++$num;
		}
		echo json_encode($data);
	}

	public function allnotasearch()
	{
		$postdata = ($_POST);
		$data['nota'] = $this->getdataurl('nota');
		$dataArray = $this->senddataurl('Pengiriman/search/',$postdata,'POST');
		$data = array(
			'data'=>array()
		);
/*		echo print_r($dataArray); die();*/
		$num = 1;
		foreach($dataArray as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values);
			}
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			//$data['data'][$key]->NOTA_DATE =  date('Y-m-d H:i:s', strtotime($value->NOTA_DATE));
            $data['data'][$key]->BESARAN = (strpos($value->BESARAN, ',') == '') ? number_format($value->BESARAN, 0, ',', ',') : $value->BESARAN;
            if ($value->STATUS_TTD == '1') {
				$data['data'][$key]->action = '<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_main" data-dismiss="modal" disabled><i class="fa fa-check fa-1" aria-hidden="true"></i></button></center>';
			}else{
				$data['data'][$key]->action = '<center><button onclick="ttdCustomer(\''.$value->NO_NOTA.'\')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_main" data-dismiss="modal"><i class="fa fa-check fa-1" aria-hidden="true"></i></button></center>';
				$data['data'][$key]->NOTA_DATE =  date('Y-m-d H:i:s', strtotime($value->NOTA_DATE));
			}
			/*echo($value->STATUS_TTD);*/

            if ($value->STATUS_TTD == '1') {
                $data['data'][$key]->STATUS_TTD = 'SUDAH';
			}else{
                $data['data'][$key]->STATUS_TTD = 'BELUM';
			}

            ++$num;
		}
		echo json_encode($data);
	}

	public function updateAllNota()
	{
		$postdata = ($_POST);
		/*print_r($postdata);die();*/
		$dataArray = $this->senddataurl('pengiriman/statusKirim',$postdata,'POST');

	}

	public function periodikfilter()
	{
		/*$postdata = ($_POST);*/
		$user['datauser'] = $this->session->userdata('unit_org');
		$this->common_loader($data,'Pejabat/datapengiriman/',$user,'POST');
	}

	public function periodiksearch()
	{
		$postdata = ($_POST);
		$dataArray = $this->senddataurl('periodik/search/',$postdata,'POST');
		$data = array(
			'data'=>array()
		);
		$num = 1;
		foreach($dataArray as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values);
			}
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			//$data['data'][$key]->TGL_PELUNASAN = date('y-m-d', strtotime($value->TGL_PELUNASAN));//;
			//if($value->TGL_PELUNASAN !== "") {
				//$data['data'][$key]->TGL_PELUNASAN = date('Y-m-d', strtotime($value->TGL_PELUNASAN));
			//}
			$data['data'][$key]->AMOUNT_DASAR_PENGHASILAN = (strpos($value->AMOUNT_DASAR_PENGHASILAN,",")=='')?number_format($value->AMOUNT_DASAR_PENGHASILAN,0,',',','):$value->AMOUNT_DASAR_PENGHASILAN;
			$data['data'][$key]->AMOUNT = (strpos($value->AMOUNT,",")=='')?number_format($value->AMOUNT,0,',',','):$value->AMOUNT;
			$data['data'][$key]->PPN_10PERSEN = (strpos($value->PPN_10PERSEN,",")=='')?number_format($value->PPN_10PERSEN,0,',',','):$value->PPN_10PERSEN;
			$data['data'][$key]->RECEIPT_ACCOUNT = $value->RECEIPT_ACCOUNT;
            if ($value->STATUS_LUNAS == '') {
                $data['data'][$key]->STATUS_LUNAS = 'BELUM LUNAS';
            } elseif ($value->STATUS_LUNAS == 'Y') {
                $data['data'][$key]->STATUS_LUNAS = 'LUNAS';
				$data['data'][$key]->TGL_PELUNASAN = date('Y-m-d', strtotime($value->TGL_PELUNASAN));
            } elseif ($value->STATUS_LUNAS == 'X') {
                $data['data'][$key]->STATUS_LUNAS = 'KOREKSI';
			}
            if ($value->AR_STATUS == 'S') {
                $data['data'][$key]->AR_STATUS = 'TRANSFER';
            } elseif ($value->AR_STATUS == 'F') {
                $data['data'][$key]->AR_STATUS = 'GAGAL';
			}else {
                $data['data'][$key]->AR_STATUS = 'BELUM TRANSFER';
			}


			$num++;
		}
		echo json_encode($data);
	}

    public function adv_kapal()
    {
		$this->common_loader($data,'invoice/nota/kapal/kapaladvance');
	}
	
    public function adv_kapal_koreksi()
    {
		$this->common_loader($data,'invoice/nota/kapal/kapaladvancekoreksi');
	}
	
	public function petikemas()
	{
		$postdata = ($_POST);
		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		
        if (isset($postdata['ID_NOTA'])) {
		$idnota = $postdata['ID_NOTA'];
        } else {
            $idnota = '';
        }
        
		if($idnota !=''){
			$data['prods'] = $this->getdataurl('invh');
		}
		$data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/PETIKEMAS');
		//$this->common_loader($data,'invoice/nota/petikemas/petikemas');

		if ($this->session->userdata('eservice')) {
			$this->common_loader($data,'invoice/nota/petikemas/petikemaseservice');
		} else {
			$this->common_loader($data,'invoice/nota/petikemas/petikemas');
		}			

	}

	public function adv_petikemas()
    {
        $postdata = ($_POST);
        //print_r($postdata); die();
        $arrayData = $this->senddataurl('invh/search/', $postdata, 'POST');
        //print_r($arrayData); die();
        $length = (int)$postdata['length'];

        $data = array(
                'recordsTotal' => $length,
                'recordsFiltered' => $arrayData->recordsFiltered,
                'data' => array(),
            );
        $jenisNota = $this->getMstNota('PTKM');
        $num = 1;
        //print_r($arrayData); die();
        foreach ($arrayData->result as $key => $value) {
            $data['data'][$key] = $value;
            /*$data['data'][$key]->num = $num;*/
            $data['data'][$key]->TRX_DATE = $value->TRX_DATE;//date('Y-m-d', strtotime($value->TRX_DATE));
            // $token_cetak_nota = md5(sha1(md5(base64_encode($value->TRX_NUMBER).base64_encode('petikemas'))));
            $enc_trx_number = $this->mx_encryption->encrypt($value->TRX_NUMBER);
            $cetak = '';
            $email = '';
            if ($value->STATUS_CETAK == '1') {
                $cetak = 'checked';
            }
            if ($value->STATUS_KIRIM_EMAIL == '1') {
                $email = 'checked';
            }
			$data['data'][$key]->NAMA_KAPAL = $value->VESSEL_NAME;
            $data['data'][$key]->KEGIATAN = $value->CREATION_DATE;
            $data['data'][$key]->cetak = '<center><input type=checkbox name=c1 disabled '.$cetak.' style="width: 20px;height: 20px;"></center>';
            $data['data'][$key]->kirim = '<center><input type=checkbox name=c1 disabled '.$email.' style="width: 20px;height: 20px;"></center>';
            $data['data'][$key]->jumlah = (strpos($value->AMOUNT, ',') == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT;
            // $data['data'][$key]->action = '<center><a target="_blank" class="btn btn-primary fa-lg" href="'.ROOT.'einvoice/nota/cetak_nota/petikemas/'.$value->TRX_NUMBER.'/'.$token_cetak_nota.'"><i class="fa fa-print"></i> Cetak</a></center>';
            $data['data'][$key]->action = '<center><a target="_blank" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota/cetak_nota/petikemas/'.$enc_trx_number.'"><i class="fa fa-print"></i> Cetak</a></center>';

            if (isset($jenisNota[$value->HEADER_SUB_CONTEXT])) {
                if ($data['data'][$key]->SOURCE_INVOICE_TYPE == 'OPUS' && substr($data['data'][$key]->BILLER_REQUEST_ID, 0, 3) == 'REX') {
                    // $judul_nota = array("jenisNota"=>'RE-EXPORT');
                    $data['data'][$key]->JENIS = $jenisNota['PTKM15'];
                } elseif ($data['data'][$key]->SOURCE_INVOICE_TYPE == 'OPUS' && $data['data'][$key]->HEADER_SUB_CONTEXT == 'PTKM05') {
                    // $judul_nota = array("jenisNota"=>'HI CO SCAN');
                    $data['data'][$key]->JENIS = 'BEHANDLE';
                } elseif ($data['data'][$key]->SOURCE_INVOICE_TYPE == 'OPUS' && $data['data'][$key]->HEADER_SUB_CONTEXT == 'PTKM12') {
                    // $judul_nota = array("jenisNota"=>'HI CO SCAN');
                    $data['data'][$key]->JENIS = 'HI CO SCAN';
                } else {
                    // $judul_nota = array("jenisNota"=>$jenisNota);
                    $data['data'][$key]->JENIS = $jenisNota[$value->HEADER_SUB_CONTEXT];
                }
            } else {
                $data['data'][$key]->JENIS = '-';
            }
            if ($value->STATUS == 'P') {
                $data['data'][$key]->STATUS = 'Invoice';
            }
			
            if ($value->STATUS_LUNAS == 'S' || $value->STATUS_LUNAS == '' || $value->STATUS_LUNAS == null) {
                $data['data'][$key]->STATUS = 'BELUM LUNAS';
            } elseif ($value->STATUS_LUNAS == 'Y') {
                $data['data'][$key]->STATUS = 'LUNAS';
            } elseif ($value->STATUS_LUNAS == 'X') {
                $data['data'][$key]->STATUS = 'KOREKSI';
            } elseif ($value->STATUS_LUNAS == 'P') {
                $data['data'][$key]->STATUS = 'LUNAS';
            } else {
                $data['data'][$key]->STATUS = 'BELUM LUNAS';
            }
            ++$num;
        }
        //print_r($data);
        echo json_encode($data);
    }

	public function barang()
	{
		
		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/BARANG');
		//$this->common_loader($data,'invoice/nota/barang/barang');
		
		if ($this->session->userdata('eservice')) {
			$this->common_loader($data,'invoice/nota/barang/barangeservice');
		} else {
			$this->common_loader($data,'invoice/nota/barang/barang');
		}		
	}

    public function createbarang()
    {
		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/BARANG');
		$this->common_loader($data,'invoice/nota/barang/createinvoicebarang');
	}

    public function count_layanan_nota()
    {
		$postdata = array();
		// $data = $this->getdataurl('invh/count_layanan/');
		$postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');
		$postdata['ORG_ID'] = $this->session->userdata('unit_org');
		// echo print_r($postdata);die();
		$data = $this->senddataurl('invh/count_layanan/',$postdata,'POST');
		echo json_encode($data);

	}

    public function count_lunas_nota()
    {
		$data = $this->getdataurl('invh/count_lunas/');
		echo json_encode($data);
	}

    public function pkk_search()
    {
		$postdata = ($_POST);
		//print_r($postdata);
		$start = !empty($_POST['start']) ? $_POST['start'] : 0;
		$length = !empty($_POST['length']) ? $_POST['length'] : 10;
		$draw = !empty($_POST['draw']) ? $_POST['draw'] : 0;
        $postdata['offset'] = $start + $length;
        $postdata['orderby'] = !empty($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
        $postdata['ordertype'] = !empty($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
		$arrayData = $this->senddataurl('reviewPKK/search/',$postdata,'POST');
		//print_r($arrayData);
		$data = array(
				'data' => array()
			);
		$num = 1 +$start;
		foreach ($arrayData->data as $key => $value) {
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			$data['data'][$key]->TGL_JAM_TIBA = date('Y-m-d H:i:s', strtotime($value->TGL_JAM_TIBA));
			$data['data'][$key]->TGL_JAM_BERANGKAT = date('Y-m-d H:i:s', strtotime($value->TGL_JAM_BERANGKAT));
            ++$num;
		}
		
		$dataTableArr = array(
            'draw' => intval($draw),
            'recordsTotal' => intval($arrayData->recordsTotal),
            'recordsFiltered' => intval($arrayData->recordsTotal),
		);
		$dataTableArr = array_merge($dataTableArr,$data);
		echo json_encode($dataTableArr);
	}

    public function mailsearch()
    {
		$postdata = ($_POST);
		$data = $this->senddataurl('email/search/',$postdata,'POST');
		echo json_encode($data);
	}

    public function adv_barang()
    {
		$this->common_loader($data,'invoice/nota/barang/barangadvance');
	}

    public function createrupa()
    {
		// $data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/RUPA');
		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$this->common_loader($data,'invoice/nota/ruparupa/createruparupa');
	}

    public function invoicerupa()
    {
		$postdata = ($_POST);
        $num = $postdata['TRX_NUMBER'];
		$postdata['user_id'] =  $this->session->userdata('user_id');
		$arrayData = $this->senddataurl('CreateInvoiceRupa/',$postdata,'POST');
		// var_dump($arrayData); die();
        $postdataEmaterai = array('TRX_NUMBER' => $num);
		$datax = $this->senddataurl('Ematerai/insertematerai/', $postdataEmaterai,'POST');
		$datakirim = $this->senddataurl('Pengiriman/insertpengiriman/', $postdataEmaterai, 'POST');
		$postlognota = array(
                                'TRX_NUMBER' => $postdata['TRX_NUMBER'],
                                'ACTIVITY' => 'INVOICE',
                                'USER_ID' => $this->session->userdata('user_id'),
							);
	    $datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');
		echo json_encode($arrayData);
	}

    public function ruparupa()
    {
		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);		
		$data['jenisnota'] = $this->getdataurl('mstnota/viewSelectJenisNota/RUPA');
		//$this->common_loader($data,'invoice/nota/ruparupa/ruparupa');
		//add by Derry utk eService : 21 Oct 2019
		if ($this->session->userdata('eservice')) {
			$this->common_loader($data,'invoice/nota/ruparupa/ruparupaeservice');
		} else {
			$this->common_loader($data,'invoice/nota/ruparupa/ruparupa');
		}			
	}
	public function nota_rupasearch()
    {
        $postdata = ($_POST);
        $arrayData = $this->senddataurl('invh/search/', $postdata, 'POST');
        $jenisNota = $this->getMstNota('RUPA');
        $length = (int)$postdata['length'];

        $data = array(
            'recordsTotal' => $length,
            'recordsFiltered' => $arrayData->recordsFiltered,
            'data' => array(),
            );
        $num = 1;
        foreach ($arrayData->result as $key => $value) {
            $data['data'][$key] = $value;
            $data['data'][$key]->TRX_DATE = $value->TRX_DATE;//date('Y-m-d', strtotime($value->TRX_DATE));
            // $data['data'][$key]->num = $num;
            $statusL = 'BELUM LUNAS';
            if (isset($value->STATUS_LUNAS) && $value->STATUS_LUNAS == 'Y') {
                $statusL = 'LUNAS';
            }
            // $token_cetak_nota = md5(sha1(md5(base64_encode($value->TRX_NUMBER).base64_encode('RUPARUPA'))));
            $enc_trx_number = $this->mx_encryption->encrypt($value->TRX_NUMBER);
            // $data['data'][$key]->AMOUNT = "Rp. ".number_format($value->AMOUNT,0,',','.');
            $data['data'][$key]->AMOUNT = (strpos($value->AMOUNT, ',') == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT;
            $cetak = '';
            $email = '';
            if (intval($value->STATUS_CETAK) > 0) {
                $cetak = 'checked';
            }
            if ($value->STATUS_KIRIM_EMAIL == '1') {
                $email = 'checked';
            }
            $data['data'][$key]->PC = "<input name='c".$num."' type=checkbox disabled ".$cetak." style='width: 20px;height: 20px;'>";
            $data['data'][$key]->STATUS_LUNAS = $statusL;
			$data['data'][$key]->NAMA_KAPAL = $value->INTERFACE_HEADER_ATTRIBUTE1;
			$data['data'][$key]->BILLER_REQUEST_ID = ($value->HEADER_SUB_CONTEXT) != 'RUPA16' ? $value->BILLER_REQUEST_ID : $value->INTERFACE_HEADER_ATTRIBUTE11;
            $data['data'][$key]->KEGIATAN = $value->CREATION_DATE;
            $data['data'][$key]->PK = "<input name='k".$num."' type=checkbox disabled ".$email." style='width: 20px;height: 20px;'>";
            // $data['data'][$key]->action = '<center><a target="_blank" class="btn btn-primary fa-lg" href="'.ROOT.'einvoice/nota/cetak_nota/RUPARUPA/'.$value->TRX_NUMBER.'/'.$token_cetak_nota.'"><i class="fa fa-print"></i> Cetak</a></center>';
            $data['data'][$key]->action = '<center><a target="_blank" onclick="Cetak()" class="btn btn-primary btn-sm" href="'.ROOT.'einvoice/nota/cetak_nota/RUPARUPA/'.$enc_trx_number.'"><i class="fa fa-print"></i> Cetak</a></center>';
            if (isset($jenisNota[$value->HEADER_SUB_CONTEXT])) {
                $data['data'][$key]->JENIS = $jenisNota[$value->HEADER_SUB_CONTEXT];
            } else {
                $data['data'][$key]->JENIS = '-';
            }
        }
        echo json_encode($data);
    }

    public function getMstNota($codeNota)
    {
		$jenisNota = array();
		$notaJenis = $this->getdataurl('mstnota/getData/'.$codeNota);
		foreach ($notaJenis as $key => $value) {
			$jenisNota[$value->INV_NOTA_CODE] = $value->INV_NOTA_JENIS;
		}
		return $jenisNota;
	}
	public function ruparupasearch()
	{
		$postdata = ($_POST);
        $postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');
        $postdata['ORG_ID'] = $this->session->userdata('unit_org');
		$start = !empty($_POST['start']) ? $_POST['start'] : 0;
		$length = !empty($_POST['length']) ? $_POST['length'] : 10;
		$draw = !empty($_POST['draw']) ? $_POST['draw'] : 0;
        $postdata['offset'] = $start + $length;
        $postdata['orderby'] = !empty($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
        $postdata['ordertype'] = !empty($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
		
		$arrayData = $this->senddataurl('reviewSimopRupa/datatable/',$postdata,'POST');
		$data = array(
				'data' => array()
			);
		// print_r($postdata);die();
		$num = 0;

		foreach ($arrayData->data as $key => $value) {
            if ($value->STATUS != '1') {
				$data['data'][$num] = $value;
				$data['data'][$key]->TGL_PRANOTA =  date('Y-m-d', strtotime($value->TGL_PRANOTA));
                $data['data'][$num]->AREA = 'JAMBI';
				$data['data'][$num]->CETAK_STATUS = '<input type="checkbox" name="c'.$num.'" checked="">';
				$data['data'][$num]->KIRIM_STATUS = '<input type="checkbox" name="k'.$num.'" checked="">';
				$data['data'][$num]->TRX_NUMBER = $value->TRX_NUMBER;
				$data['data'][$num]->CUSTOMER_NAME = $value->CUSTOMER_NAME;
				$data['data'][$num]->TGL_PRANOTA = $value->TGL_PRANOTA;
				$layanan = $value->KODE_LAYANAN;
				/*$notaJenis = $this->getdataurl('mstnota/getData/'.$value->KODE_LAYANAN);
				if(count($notaJenis)>0){
					$value->KODE_LAYANAN = $notaJenis[0]->INV_NOTA_JENIS;
				}else{
					$value->KODE_LAYANAN = "-";
				}*/

				$data['data'][$num]->KODE_LAYANAN = $value->NAMA_LAYANAN;
				// $data['data'][$num]->AMOUNT_TOTAL = "Rp. ".$value->AMOUNT_TOTAL;
                $data['data'][$num]->AMOUNT_TOTAL = (strpos($value->AMOUNT_TOTAL, ',') == '') ? number_format($value->AMOUNT_TOTAL, 0, ',', ',') : $value->AMOUNT_TOTAL;
				$keterangan = '<a class="btn btn-sm btn-primary btn-sm"  href="javascript:void(0)" onclick="print_rupa(\''.$value->TRX_NUMBER.'\',\''.$layanan.'\',\''.$value->BRANCH_ACCOUNT.'\',\''.$value->BRANCH_CODE.'\',\''.$value->CUSTOMER_NAME.'\',\''.$value->ORG_ID.'\')"> <i class="fa fa-print"></i> Preview</a>';
				$data['data'][$num]->action = $keterangan;
				$keterangan2 = '<a target="_blank" class="btn btn-primary" href="'.ROOT.'einvoice/nota/cetak_ruparupa/ruparupa/'.$value->TRX_NUMBER.'"><i class="fa fa-print" ></i></a>';
				$data['data'][$num]->action2 = $keterangan2;
                $data['data'][$num]->STATUS = 'BELUM LUNAS';
				$data['data'][$num]->RNUM = ($_POST['start']+ $num+1);
                ++$num;
			}

		}
		$dataTableArr = array(
            'draw' => intval($draw),
            'recordsTotal' => intval($arrayData->recordsTotal),
            'recordsFiltered' => intval($arrayData->recordsTotal),
		);
		$dataTableArr = array_merge($dataTableArr,$data);
		echo json_encode($dataTableArr);
	}
	/*public function cetak_rupa($layanan,$no_invoice=""){
		$this->load->helper('pdf_helper');
		tcpdf();
        $id    = $this->uri->segment(5);
		$judul = 'priview cetak ruparupa';
		// echo $this->uri->segment(4)."-".$this->uri->segment(5);die();exit();
		switch($layanan){
			case "ruparupa":
				$data_header = $this->getdataurl('invh/'.$id2);
				print_r($data_header);die();exit();
		}
	}*/
    public function adv_rupa()
    {
		$this->common_loader($data,'invoice/nota/ruparupa/ruparupaadvance');
	}
	
    public function get_entity($unit_code)
    {
		return $get_entity = $this->auth_model->get_entity($unit_code);
	}
	
	public function cetak_koreksi($ukk,$ppkb)
	{
		date_default_timezone_set('Asia/Jakarta');      //Don't forget this..I had used this..just didn't mention it in the post
		$datetime_variable = new DateTime();
		$datetime_formatted = date_format($datetime_variable, 'Y-m-d H:i:s');
		$bulan = array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
		// $datetime_formatted  = '27/03/2018 14:00';
		$params = array(
			    'NO_UKK' => $ukk,
				'KD_PPKB' => $ppkb,
			    //'BRANCH_CODE' => $cab,
				
			    // 'KD_CABANG' => $this->input->post('KD_CABANG'),
			);

        $output_name = $ukk.'_'.$ppkb.'.pdf';

		$postdata =$params;
		$dkk_header = $this->senddataurl('CreateInvoiceKapalKoreksi/viewKoreksiDetail/',$postdata,'POST');
		 $BRANCH_CODE = json_decode($this->session->userdata('unit_id'),true);
		
			foreach ($dkk_header-> header as $key => $value) {  //print_r($value);die;
					$nama_agen = $value->NM_AGEN;
					$kd_agen = $value->KD_AGEN;
					$kd_kapal	= $value->KD_KAPAL;
					$nama_kapal = $value->NM_KAPAL; //KOSONG
					$no_ukk = $value->NO_UKK;
					$tgl_jam_berangkat = $value->TGL_JAM_BERANGKAT;
					$tgl_jam_tiba = $value->TGL_JAM_TIBA;

					$bendera = 'INDONESIA';
					$jenis_pelayaran = strtoupper($value->PELAYARAN_KAPAL);
					$jenis_kapal =$value->NAMA_JENIS_KAPAL;
					$kunjungan = $value->KUNJUNGAN;
					$gt_loa = $value->KP_GRT.'/'.$value->KP_LOA;
					$asal = $value->PELABUHAN_ASAL;
					$tujuan = $value->PELABUHAN_TUJUAN;
					$sebelum = $value->PELABUHAN_SEBELUM;
					$berikutnya =  $value->PELABUHAN_BERIKUT;
					$form_1A = $value->KD_PPKB;
					$branch_code =$BRANCH_CODE[0];
				}

				foreach ($dkk_header-> Detail as $key => $value) {  //print_r($value);die;
					$BENTUK_3A = $value->BENTUK_3A;
				}
			$kop = $this->get_entity($branch_code); //print_r($kop);die;

			$params_ = array(
				'NO_UKK' => $ukk,
				'KD_PPKB' => $ppkb,
			);

			$postdata_ =$params_;

			//$dkk_tailArr = $this->senddataurl('CreateInvoiceKapalKoreksi/viewKoreksi/',$postdata_,'POST') ; //KOSONG
			$dkk_tailArr = $dkk_header -> Detail ; //KOSONG
			$dkks_tailArr = $dkk_header -> Detail;

			$dkks_tail = $dkk_header -> Detail; 
			$dkk_tail = $dkk_header -> Detail;
			$kursArr = $dkks_tailArr->kurs[0];
			$totalResult = $dkks_tailArr->total[0];
				// print_r($dkk_tailArr);die();
			// echo print_r($kursArr);
			// echo print_r($totalResult);die();

			$this->load->helper('pdf_helper');
			tcpdf();
			//echo "hello";
			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor($nama_agen);
			$pdf->SetTitle($no_ukk);
			$pdf->SetSubject($kop->INV_ENTITY_NAME);
			$pdf->SetKeywords('NOTA DPJK DTJK '.$nama_agen.'');

			// set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// // set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// // set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once dirname(__FILE__).'/lang/eng.php';
			    $pdf->setLanguageArray($l);
			}

			    $pdf->SetFont('courier', '', 8);
			    $pdf->startPageGroup();
				$pdf->AddPage();
				//$pdf->Image(APP_ROOT.'uploads/entity/'.$kop->INV_ENTITY_LOGO, 12, 3, 20, 15, '', '', '', true, 70);
				$style = array(
							'position' => '',
							'align' => 'C',
							'stretch' => false,
							'fitwidth' => true,
							'cellfitalign' => '',
							//'border' => true,
							'hpadding' => 'auto',
							'vpadding' => '10px',
							'fgcolor' => array(0,0,0),
							'bgcolor' => false, //array(255,255,255),
							'text' => true,
							'font' => 'Arial',
							'fontsize' => 4,
							'stretchtext' => 4
						);
				
				//$postdata['BRANCH_CODE'] = $BRANCH_CODE[0];
        $data2 = $this->senddataurl('reviewSimopRupa/searchHeader/', array('INV_UNIT_CODE' => $BRANCH_CODE[0]), 'POST');
				
				$header_nota = array(
                                'status_lunas' => 'S',
                                'e_logo' => $data2[0]->INV_ENTITY_LOGO,
                                'e_name' => $data2[0]->INV_ENTITY_NAME,
                                'num' => $BENTUK_3A,
                                'e_address' => $data2[0]->INV_ENTITY_ALAMAT,
                                'tgl_nota' => date('d').'-'.$bulan[intval(date('m'))].'-'.date('Y'),
                                'bag' => 'KPL',
                                'e_npwp' => $data2[0]->INV_ENTITY_NPWP,
                                'e_faktur' => $data2[0]->INV_ENTITY_FAKTUR, );
				// print_r($header_nota);die();
				$this->load->helper('nota_invoice_helper');
				$header1 = header_pranota($header_nota);
				$header1 = '<table><tr><td>&nbsp;</td></tr></table>'.$header1;
        $gambar = '';
				if (file_exists(APP_ROOT.'uploads/entity/'.$kop->INV_ENTITY_LOGO)) {
			    	$gambar = '<img width="350" height="200" src="'.APP_ROOT.'uploads/entity/'.$kop->INV_ENTITY_LOGO.'">';
				} else {
			    	$gambar = '<div width="350" height="40" src="'.APP_ROOT.'uploads/entity/"></div>';
				}

				$header = '<table border="0px">
						<tr>
		                    <td width="200" align="left" rowspan="2">'.$gambar.'</td>
		                    <td width="230" align="right"></td>
		                    <td width="200" align="right">FM.101010</td>
		                </tr>
		                <tr>
		                    <td width="200" align="left"></td>
		                    <td width="90" align="left">TANGGAL</td>
		                    <td width="20" align="left">:</td>
		                    <td width="120" align="right">'.$datetime_formatted.'</td>
		                </tr>
						<tr>
		                    <td width="200" align="left"><b>'.$kop->INV_ENTITY_NAME.'</b></td>
		                    <td width="210" align="right"></td>

		                </tr>
		                <tr>
		                    <td width="200" align="left">Cabang Pelabuhan '.$kop->INV_UNIT_CODE.'</td>
		                    <td width="250" align="right"></td>
		                    <td width="80" align="left"></td>
		                    <td width="20" align="left"></td>
		                    <td width="100" align="left"></td>
		                </tr>
		                 <tr>
		                    <td width="350" align="left">'.$kop->INV_ENTITY_ALAMAT.'</td>
		                    <td width="100" align="right"></td>
		                    <td width="80" align="left"></td>
		                    <td width="20" align="left"></td>
		                    <td width="100" align="left"></td>
		                </tr>
		                <tr>
		                    <td width="70">
		                    </td><td COLSPAN="12" align="left"></td>
		                    <td COLSPAN="2" align="left" width="150px"></td>
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
		                    <td width="110" align="left"></td>
		                    <td width="450" align="center" style="font-size:24px">DATA TRANSAKSI - JASA KAPAL</td>
		                    <td width="100" align="left"></td>
		                	</tr>
		                	<tr>
		                    <td width="200" align="left"></td>
		                    <td width="250" align="center">TANGGAL KAPAL KELUAR: '.$tgl_jam_berangkat.'</td>
		                    <td width="80" align="left"></td>
		                    <td width="20" align="left"></td>
		                    <td width="100" align="left"></td>
		                </tr>
		        		</table>
		        		<table border-bottom="1px">
		        			<tr>
		                    <td width="640" align="left" style="border-bottom:1px solid #000"></td>

		                	</tr>


		        		</table>';

		        $trx_header = '<table border="0px">
						<tr>
		                    <td width="130" align="left">NAMA KAPAL</td>
		            		<td width="20" align="left">:</td>
		            		<td width="180" align="left">'.$nama_kapal.'</td>
		            		 <td width="150" align="left">KUNJUNGAN/KEGIATAN</td>
		            		<td width="20" align="left">:</td>
		            		<td width="180" align="left">KAPAL NIAGA / UMUM</td>
		                </tr>
		                <tr>
		                	<td width="130" align="left">KODE KAPAL/No.UKK</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$kd_kapal.'/'.$no_ukk.'</td>
		                	<td width="150" align="left">MASA KUNJUNGAN</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$tgl_jam_tiba.' s/d '.$tgl_jam_berangkat.'</td>
		                </tr>

		                <tr>
		                	<td width="130" align="left">AGEN</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$kd_agen.' ~ '.$nama_agen.'</td>
		                	<td width="150" align="left">GTA/LOA</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$gt_loa.' Meter</td>
		                </tr>
		                <tr>
			                <td width="130" align="left">BENDERA</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$bendera.'</td>
			                <td width="150" align="left">ASAL/TUJUAN</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$asal.' / '.$tujuan.' </td>
		                </tr>
		                <tr>
			                <td width="130" align="left">JENIS PELAYARAN</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$jenis_pelayaran.' / NON REGULAR</td>
			                 <td width="150" align="left">SEBELUM /BERIKUT</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$sebelum.' / '.$berikutnya.'</td>
		                </tr>
		                <tr>
			                <td width="130" align="left">JENIS KAPAL</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$jenis_kapal.'</td>
			                <td width="150" align="left">No Form 1A</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$form_1A.'</td>
		                </tr>

		                <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>




		                </table>

		        ';

		        $trx_tail .= '
		        	<table style="padding-top20px;" border="1">
					  <tr>
					    <th style="border-bottom: 1px solid black;" height="15px" width="120" align="left">URAIAN</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="50" align="left">1A-KE</th>
					    <th style="border-bottom: 1px solid black;" height="15px" >NO.BUKTI</th>
					    <th style="border-bottom: 1px solid black;" height="15px">TGL-JAM MULAI</th>
					    <th style="border-bottom: 1px solid black;" height="15px">TGL-JAM SELESAI</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="160" >KETERANGAN</th>
					  </tr>
					  <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>

					  ';

					  foreach ($dkk_tailArr as $key => $nilai) {
            // code...

						// $trx_tail .=  '<tr style="padding:10px;">
						// <td>'.$nilai->URAIAN.'</td>
						// <td>'.$nilai->PPKB_KE.'</td>
						// <td>'.$nilai->FORM1A.'</td>
						// <td>'.$nilai->TGL_JAM_MULAI.'</td>
						// <td>'.$nilai->TGL_JAM_SELESAI.'</td>
						// <td>'.$nilai->KETERANGAN1.'</td>
						// </tr>';
							}
						$dkk_tailArrA = json_decode(json_encode($dkk_tailArr),true);
						 //echo print_r($dkk_tailArrA);die();
						foreach ($dkk_tailArrA as $key => $row) {
            if ($row['URAIAN'] == 'PANDU' or $row['URAIAN'] == 'TUNDA') {
								$trx_tail .= '<tr height="15">
									            <td height="25" colspan="4"><div align="left">';
                $trx_tail .= $row['KET_URAIAN'].' &nbsp;&nbsp;&nbsp;&nbsp;'.$row['FORM2A'];
								$trx_tail .= '</div></td>';
                $trx_tail .= '<td height="25">'.'&nbsp;&nbsp;:'.$row['KETERANGAN2'].'</td>';
								$trx_tail .= '</tr>';
								$trx_tail .=  '<tr style="padding:10px;">
												<td></td>
												<td>'.$row['PPKB_KE'].'</td>
												<td></td>
												<td>'.$row['TGL_JAM_MULAI'].'</td>
												<td>'.$row['TGL_JAM_SELESAI'].'</td>
												<td>'.$row['KETERANGAN1'].'</td>
												</tr>';

                if ($row['KETERANGAN3'] != '') {
									$trx_tail .= '<tr>';
									$trx_tail .= '<td height="25" colspan="6" align="left">'.$row['KETERANGAN3'].'</td>';
									$trx_tail .= '</tr>';
								}
							} else {
                if ($row['URAIAN'] == 'BONGKAR/MUAT') {
									$trx_tail .= '<hr />';
								}
								$trx_tail .= '<tr height="15">
								            <td height="25"><div align="left">';
                $trx_tail .= $row['URAIAN'].'&nbsp;&nbsp;&nbsp;'.$row['KET_URAIAN'];
								$trx_tail .= '</div></td>';
								$trx_tail .=  '<td>'.$row['PPKB_KE'].'</td>
												<td>'.$row['FORM1A'].'</td>
												<td>'.$row['TGL_JAM_MULAI'].'</td>
												<td>'.$row['TGL_JAM_SELESAI'].'</td>
												<td>'.$row['KETERANGAN1'].' '.$row['KETERANGAN2'].'</td>
												</tr>';
							}
						}

						/*
						$trx_tail .= 
						$trx_tail .= 
						*/
						/*$trx_tail .=  '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						</table>
						';*/

		        $footer1 ='<table>
						  <tr cellpadding="4" cellspacing="6">
						    <th style="border-bottom: 1px solid black;margin-top:40px;" height="15px" ></th>
						    <th style="border-bottom: 1px solid black;"></th>
						    <th style="border-bottom: 1px solid black;"></th>
						    <th style="border-bottom: 1px solid black;"></th>
						    <th  style="border-bottom: 1px solid black;"></th>
						    <th style="border-bottom: 1px solid black;"></th>
						  </tr>
						</table>';

		        //$output_name = "REPORT NOTA DPJK";
		        $pdf->SetFont('gotham', '', 8);
		        $pdf->writeHtml($header1, true, false, false, false, '');
		        $pdf->SetFont('courier', '', 8);
		        // $pdf->writeHtml($header, true, false, false, false, '');
		        $pdf->writeHtml($judul, true, false, false, false, '');
		        $pdf->writeHtml($trx_header, true, false, false, false, '');
		        $pdf->writeHtml($trx_tail, true, false, false, false, '');
		        $pdf->writeHtml($footer1, true, false, false, false, '');

		        $pdf->startPageGroup();
		        // add a page
				$pdf->AddPage();

        $gambar = '';
				if (file_exists(APP_ROOT.'uploads/entity/'.$kop->INV_ENTITY_LOGO)) {
			    	$gambar = '<img width="350" height="200" src="'.APP_ROOT.'uploads/entity/'.$kop->INV_ENTITY_LOGO.'">';
				} else {
			    	$gambar = '<div width="350" height="40" src="'.APP_ROOT.'uploads/entity/"></div>';
				}

				$header = '<table border="0px">
						<tr>
		                    <td width="200" align="left" rowspan="2">'.$gambar.'</td>
		                    <td width="350" align="right"></td>
		                    <td width="100" align="left"></td>
		                    <td width="20" align="left"></td>

		                </tr>
						<tr>
		                    <td width="200" align="left"></td>
		                    <td width="30" align="right"></td>
                    		<td width="100" align="left">FM.01/01/01/74</td>
		                    <td width="20" align="left"></td>
		                    <td width="100" align="left"  style="font-size:8px">Dicetak Tanggal : '.$datetime_formatted.'</td>
		                </tr>
		                <tr>
		                    <td width="200" align="left"><b>'.$kop->INV_ENTITY_NAME.'</b></td>
		                    <td width="250" align="right"></td>
		                    <td width="80" align="left"></td>
		                    <td width="20" align="left"></td>
		                    <td width="100" align="left"></td>
		                </tr>
		                <tr>
		                    <td width="200" align="left">Cabang Pelabuhan '.$kop->NO_UKK.'</td>
		                    <td width="230" align="right"></td>
		                    <td width="80" align="left">BENTUK 3A</td>
		                    <td width="20" align="left">:</td>
		                    <td width="130" align="left">010.010.18-10.003372 </td>
		                </tr>

		                <tr>
		                	<td width="200" align="left"></td>
		                    <td width="230" align="right"></td>
		                    <td width="80" align="left">TANGGAL</td>
		                    <td width="20" align="left">:</td>
		                    <td width="130" align="left">'.$datetime_formatted.'</td>
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
		                     <td width="110" align="left"></td>
		                    <td width="420" align="center" style="font-size:24px">DATA PERHITUNGAN - JASA KAPAL</td>
		                    <td width="100" align="left"></td>
		                	</tr>
		                	<tr>
		                    <td width="200" align="left"></td>
		                    <td width="250" align="center">TANGGAL KAPAL KELUAR: '.$tgl_jam_berangkat.'</td>
		                    <td width="80" align="left"></td>
		                    <td width="20" align="left"></td>
		                    <td width="100" align="left"></td>
		                </tr>
		        		</table>
		        		<table border-bottom="1px">
		        			<tr>
		                    <td width="660" align="left" style="border-bottom:1px solid #000"></td>

		                	</tr>


		        		</table>';

		        $trx_header = '<table border="0px">
						<tr>
		                    <td width="130" align="left">NAMA KAPAL</td>
		            		<td width="20" align="left">:</td>
		            		<td width="180" align="left">'.$nama_kapal.'</td>
		            		 <td width="150" align="left">KUNJUNGAN/KEGIATAN</td>
		            		<td width="20" align="left">:</td>
		            		<td width="180" align="left">KAPAL NIAGA / UMUM</td>
		                </tr>
		                <tr>
		                	<td width="130" align="left">KODE KAPAL/No.UKK</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$kd_kapal.'/'.$no_ukk.'</td>
		                	<td width="150" align="left">MASA KUNJUNGAN</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$tgl_jam_tiba.' s/d '.$tgl_jam_berangkat.'</td>
		                </tr>

		                <tr>
		                	<td width="130" align="left">AGEN</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$kd_agen.' ~ '.$nama_agen.'</td>
		                	<td width="150" align="left">GTA/LOA</td>
		                	<td width="20" align="left">:</td>
		                	<td width="180" align="left">'.$gt_loa.' Meter</td>
		                </tr>
		                <tr>
			                <td width="130" align="left">BENDERA</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$bendera.'</td>
			                <td width="150" align="left">ASAL/TUJUAN</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$asal.' / '.$tujuan.' </td>
		                </tr>
		                <tr>
			                <td width="130" align="left">JENIS PELAYARAN</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$jenis_pelayaran.' / NON REGULAR</td>
			                 <td width="150" align="left">SEBELUM /BERIKUT</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$sebelum.' / '.$berikutnya.'</td>
		                </tr>
		                <tr>
			                <td width="130" align="left">JENIS KAPAL</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$jenis_kapal.'</td>
			                <td width="150" align="left">No Form 1A</td>
			                <td width="20" align="left">:</td>
			                <td width="180" align="left">'.$form_1A.'</td>
		                </tr>

		                <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>




		                </table>

		        ';

		       $trx_tail2 .=' <table border="0px" >
					  <tr>
					    <th style="border-bottom: 1px solid black;" height="15px" width="120" align="left"></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="40" align="left"></th>
					    <th style="border-bottom: 1px solid black;" height="15px" ></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="70" ></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="70" ></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="140" ></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="30" ></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="100"  ></th>
					  </tr>
					  </table>';

		        $trx_tail2 .= '
		        	<table border="0px" >
					  <tr>
					    <th style="border-bottom: 1px solid black;" height="15px" width="120" align="left">URAIAN</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="40" align="left">1A-KE</th>
					    <th style="border-bottom: 1px solid black;" height="15px" >NO.2A</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="70" >TGL-JAM MULAI</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="70" >TGL-JAM SELESAI</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="140" >PERHITUNGAN</th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="30" ></th>
					    <th style="border-bottom: 1px solid black;" height="15px" width="100"  >JUMLAH</th>
					  </tr>
					  <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>';
			$jml_ppn = 0;
			$jml_hitung = 0;
			$kursRate = 0 ; 
			// echo print_r($dkks_tail); die();
			foreach ($dkks_tail as $key => $datum) {
				 $jml_ppn += ($datum->JML_PPN);
				 $jml_hitung += ($datum->JUMLAH);
					    // <td>'.$datum->URAIAN.'<br>'.$datum->URAIAN1.'</td>
            if ($datum->URAIAN == 'UANG LABUH' and $datum->URAIAN2 == '') {
				$trx_tail2 .='
					<tr>
				        <td ><div align="left"> '.$datum->URAIAN.' </div></td>
				        <td  align="center">'.$datum->PPKB_KE.'</td>
				        <td >'.$datum->FORM2A.'</td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>
					';
				} else {
				}

				if ($datum->URAIAN == 'UANG TAMBAT') {
					$trx_tail2 .= '<tr>
					        <td align="left"> '.$datum->URAIAN.'</td>
					        <td align="center"></td>
					        <td ></td>
					        <td ></td>
					        <td ></td>
					        <td align="left"><div align="left"></div></td>
					        <td align="right">&nbsp;</td>
					        <td align="right"><div align="right"></div></td>
					      </tr>
					      <tr>
					        <td align="left"> '.$datum->URAIAN1.'</td>
					        <td align="center">'.$datum->PPKB_KE.'</td>
					        <td >'.$datum->FORM2A.'</td>
					        <td >'.$datum->TGL_JAM_MULAI.'</td>
					        <td >'.$datum->TGL_JAM_SELESAI.'</td>
					        <td  align="left"><div align="left">'.$datum->URAIAN4.'</div></td>
					        <td align="right">&nbsp;</td>
					        <td align="right"><div align="right"></div></td>
					      </tr>';

				} else {
				}

				// untuk mendapatkan keterangan uraian MASA
				$masa = substr($datum->URAIAN1,0,4); 
            if ($masa == 'MASA') {
					$trx_tail2 .= '<tr>
			        <td ><div align="left"></div></td>
			        <td  align="center"><div align="left"></div></td>
			        <td ><div align="center">'.$datum->URAIAN1.'</div></td>
			        <td >'.$datum->TGL_JAM_MULAI.'</td>
			        <td >'.$datum->TGL_JAM_SELESAI.'</td>
			        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
			        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
			        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
			      </tr>';
				} else {
				}

				$trx_tail2 .= '<tr>';
            if ($datum->GERAKAN != '' and $datum->GERAKAN_DARI != '' and $datum->GERAKAN_KE != '' and $datum->URAIAN == 'UANG PANDU') {
					$trx_tail2 .= '<td  colspan="8"><div align="left">'.$datum->GERAKAN.$datum->GERAKAN_DARI.$datum->GERAKAN_KE.'</div></td>';
				}
				$trx_tail2 .= '</tr>';

				if ($datum->URAIAN == 'UANG PANDU' ) {
					$trx_tail2 .= '<tr>
					        <td ><div align="left">'.$datum->URAIAN.'</div></td>
					        <td  align="center"><div align="center">'.$datum->PPKB_KE.'</div></td>
					        <td ><div align="center">'.$datum->FORM2A.'</div></td>
					        <td >'.$datum->TGL_JAM_MULAI.'</td>
					        <td >'.$datum->TGL_JAM_SELESAI.'</td>
					        <td  align="left">'.$datum->URAIAN5.' : '.$datum->KETERANGAN_PERHITUNGAN.'</td>
					        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
					        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
					      </tr>';
				}

				if ($datum->URAIAN2 == 'TARIF TAMBAHAN') {
					$trx_tail2 .= '<tr>
						        <td ><div align="left"></div></td>
						        <td  colspan="2" align="center"><div align="right">'.$datum->URAIAN2.' : </div></td>
						        <td ></td>
						        <td ></td>
						        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
						        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
						        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
						      </tr>';
				}

				if ($datum->URAIAN == 'UANG TUNDA') {
					$trx_tail2 .= '<tr>
							        <td  colspan="5"><div align="left"> '.$datum->URAIAN.' '.$datum->URAIAN1.' </div></td>
							        <td  align="left"><div align="left"></div></td>
							        <td align="right">&nbsp;</td>
							        <td  align="right"><div align="right"></div></td>
							      </tr>';
				}

	  			if ($datum->URAIAN2 == 'TARIF TETAP' ) {
	  				$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum->URAIAN2.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td ><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
	  			}

				if ($datum->URAIAN2 == 'TARIF VARIABEL' ) {
					$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum->URAIAN2.' &nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
				}

				if ($datum->URAIAN2 == 'SURCHARGE' ) {
					$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum->URAIAN2.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
				}	

	  			if ($datum->URAIAN2 == 'PAKET' ) {
	  				$trx_tail2 .= '<tr>
			        <td ></td>
			        <td  colspan="2"><div align="left">'.$datum->URAIAN2.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
			        <td >'.$datum->TGL_JAM_MULAI.'</td>
			        <td >'.$datum->TGL_JAM_SELESAI.'</td>
			        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
			        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
			        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
			      </tr>';
	  			}

	  			if ($datum->URAIAN2 == 'BIAYA TETAP EMERGENCY' ) {
	  				$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum->URAIAN2.'&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
	  			}

	  			if ($datum->URAIAN2 == 'SURCHARGE EMERGENCY' ) {
	  				$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum->URAIAN2.' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
	  			}

			  if ($datum->URAIAN == 'UANG KEPIL' ) {
			  	$trx_tail2 .= '<tr>
					        <td  align="left">'.$datum->URAIAN.'</td>
					        <td  colspan="2" align="left">'.$datum->URAIAN1.'</td>
					        <td >'.$datum->TGL_JAM_MULAI.'</td>
					        <td >'.$datum->TGL_JAM_SELESAI.'</td>
					        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
					        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
					        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
					      </tr>';
			  }

            if ($datum->URAIAN3 != '') {
					$trx_tail2 .= '<tr>
				        <td  align="left">'.$datum->URAIAN.'</td>
				        <td  colspan="2" align="left">'.$datum->URAIAN1.'</td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
				}
				if ($datum->URAIAN == 'UANG SAMPAH') {
					$trx_tail2 .= '<tr>
			        <td ><div align="left"> '.$datum->URAIAN.' </div></td>
			        <td  align="center">'.$datum->FORM2A.'</td>
			        <td  align="left"></td>
			        <td >'.$datum->TGL_JAM_MULAI.'</td>
			        <td >'.$datum->TGL_JAM_SELESAI.'</td>
			        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
			        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
			        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
			      </tr>';
				}
				if ($datum->URAIAN == 'PEMBULATAN ATAS PELY JASA MINIMAL') {
					$trx_tail2 .= '<tr>
			        <td ><div align="left"> '.$datum->URAIAN.' </div></td>
			        <td align="center"></td>
			        <td>&nbsp;</td>
			        <td>&nbsp;</td>
			        <td >&nbsp;</td>
			        <td  align="left">&nbsp;</td>
			        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
			        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
			      </tr>';
				}

				if ($datum->URAIAN == 'BONGKAR/MUAT') {
					$data_bm = $datum;    
				}

				if ($datum->URAIAN == 'UANG AIR') {
					$trx_tail2 .= '<tr>
				        <td ><div align="left"> '.$datum->URAIAN.' </div></td>
				        <td  align="center">'.$datum->PPKB_KE.'</td>
				        <td >'.$datum->FORM2A.'</td>
				        <td >'.$datum->TGL_JAM_MULAI.'</td>
				        <td >'.$datum->TGL_JAM_SELESAI.'</td>
				        <td  align="left"> '.$datum->KETERANGAN_PERHITUNGAN.' </td>
				        <td align="right">'.$datum->KETERANGAN_FORMULA_D.'</td>
				        <td  align="right"><div align="right">'.$datum->KETERANGAN_JUMLAH.'</div></td>
				      </tr>';
				}

					// $trx_tail2 .= '';
				/*$trx_tail2 .='
					  <tr style="padding:10px;">
					    <td>'.$datum->URAIAN.'</td>
					    <td>'.$datum->PPKB_KE.'</td>
					    <td>'.$datum->FORM1A.'</td>
					    <td>'.$datum->TGL_JAM_MULAI.'</td>
					    <td>'.$datum->TGL_JAM_MULAI.'</td>
					    <td>'.$datum->KETERANGAN_PERHITUNGAN.' </td>
					    <td align="right">'.$totalResult->SIGN_CURRENCY.'</td>
					    <td align="right">'.$datum->JUMLAH.'</td>
					  </tr>';*/
			}

			$total_all = ($jml_hitung+$jml_ppn);

			$huruf = $this->getdataurl('others/terbilang/'.$total_all);
					foreach ($huruf as $bilang) {
						$terbilang = $bilang->NILAI;
						$terbilang = $terbilang.'rupiah';
					}

			$ppn_b = (10/100)*$jml_ppn;

					$trx_tail2 .='<tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>
					</table>
		        ';

		        $pajak ='<table border="0px">
						  <tr>
						    <th>PAJAK PERTAMBAHAN NILAI</th>
						  </tr>
						  <tr>
						    <td width="140">DASAR PERHITUNGAN PAJAK</td>
						    <td width="20"></td>
						    <td width="80"></td>
						    <td width="80"></td>
						    <td width="80"></td>
						    <td width="120" ></td>
						    <td width="30" align="right">'.$totalResult->SIGN_CURRENCY.'</td>
						    <td align="right" width="100">'.$totalResult->PPN_DIKENAKAN.'</td>
						  </tr>
						  <tr>
						    <td>a. PPN dipungut sendiri</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult->SIGN_CURRENCY.'</td>
						    <td align="right">'.$totalResult->PPN_DIKENAKAN_10.'</td>
						  </tr>
						  <tr>
						    <td>b. PPN dipungut Pemungut </td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult->SIGN_CURRENCY.'</td>
						    <td align="right">0</td>
						  </tr>
						  <tr>
						    <td>c. PPN tidak dipungut</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult->SIGN_CURRENCY.'</td>
						    <td align="right">0</td>
						  </tr>
						  <tr>
						    <td>d. PPN dibebaskan</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult->SIGN_CURRENCY.'</td>
						    <td align="right">0</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						  </tr>
						</table>';

				$total_perhitungan = '<table>
								  <tr>
								   <th width="140" align="left"></th>
								    <th width="20"></th>
								    <th width="80"></th>
								    <th width="80"></th>
								    <th width="80"></th>
								    <th width="120" ></th>
								    <th width="30"></th>
								    <th align="right" width="100"></th>
								  </tr>
								  <tr>
								    <td>1. JUMLAH PERHITUNGAN</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">'.$totalResult->SIGN_CURRENCY.'</td>
								    <td  align="right">'.$totalResult->KET_JUMLAH_TAGIHAN2.'</td>
								  </tr>';
								    // <td  align="right">'.number_format($jml_hitung+$jml_ppn,0,',','.').'</td>
        if ($totalResult->SIGN_CURRENCY != 'Rp.') {
					$total_perhitungan .= '	  
								  <tr>
								    <td>2. KURS YANG BERLAKU</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">1 USD =</td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.$kursArr->KURS_RATE.'</td>
								  </tr>
								  <tr>
								    <td COLSPAN="3">3. JUMLAH PERHITUNGAN (DALAM RUPIAH)</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.$totalResult->JML_TAGIHAN_KURS.'</td>
								  </tr>
								  <tr>
								    <td>4. UANG JAMINAN NO</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($totalResult->UANG_JAMINAN,0,'.',',').'</td>
								  </tr>
								  <tr>
								    <td>5. PIUTANG</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.$totalResult->PIUTANG.'</td>
								  </tr>
								</table>';
				} else {
					$total_perhitungan .= '	  
								  <tr>
								    <td>2. UANG JAMINAN NO</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($totalResult->UANG_JAMINAN,0,'.',',').'</td>
								  </tr>
								  <tr>
								    <td>3. PIUTANG</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.$totalResult->PIUTANG.'</td>
								  </tr>
								</table>';
				}
				
		        $footer1 ='<table>
						  <tr cellpadding="4" cellspacing="6">
						    <th style="border-bottom: 1px solid black;margin-top:40px;" height="15px" ></th>
						    <th style="border-bottom: 1px solid black;"></th>
						    <th style="border-bottom: 1px solid black;"></th>
						    <th style="border-bottom: 1px solid black;"></th>
						    <th  style="border-bottom: 1px solid black;"></th>
						    <th style="border-bottom: 1px solid black;"></th>
						  </tr>
						</table>';

		       $footer ='<table>
						  <tr cellpadding="4" cellspacing="6">
						    <th style="" height="15px" >BONGKAR/MUAT</th>
						    <th style=""></th>
						    <th style=""></th>
						    <th style=""></th>
						    <th  style=""></th>
						    <th style="">Peti Kemas(6) ~ Masa I : 3 Hari</th>
						  </tr>
						</table>';

				$terbilang ='<table border="0px">
						  <tr cellpadding="4" cellspacing="6">
						    <th style="" width="120" >TERBILANG</th>
						    <th style="" width="30">:</th>
						    <th style="" width="430">'.$totalResult->PIUTANG_NUMWORD.'</th>
						    <th style="" width="20"></th>
						    <th  style="" width="20"></th>
						    <th style="" width="20"></th>
						  </tr>
						</table>';

				$ket ='<p  style="font-size:8px"><i>PPN DIPUNGUT SENDIRI Karena Tidak ada Operator Kapal;</i> </p>';

				$pdf->SetFont('gotham', '', 8);
		        $pdf->writeHtml($header1, true, false, false, false, '');
		        $pdf->SetFont('courier', '', 8);
		        // $pdf->writeHtml($header, true, false, false, false, '');
		        $pdf->writeHtml($judul, true, false, false, false, '');
		        $pdf->writeHtml($trx_header, true, false, false, false, '');
		        $pdf->writeHtml($trx_tail2, true, false, false, false, '');
		        $pdf->writeHtml($pajak, true, false, false, false, '');
		        $pdf->writeHtml($total_perhitungan, true, false, false, false, '');
		        // $pdf->writeHtml($footer1, true, false, false, false, '');
		        // $pdf->writeHtml($footer, true, false, false, false, '');
		        // $pdf->writeHtml($terbilang, true, false, false, false, '');
		        // $pdf->writeHtml($ket, true, false, false, false, '');

		        $pdf->lastPage();
		         $pdf->Output($output_name, 'I');
		        // $path =base_url('uploads/'.$output_name.'');
		        // $pdf->Output($path, 'F');

	}
	
    public function priview_create_nota($trxNumber = null, $layanan = null, $brancid = null, $branccode = null)
    {
		$this->load->helper('pdf_helper');
		tcpdf();
		$this->load->helper('nota_invoice_helper');
		// echo "jahahahah"; die();
		// echo $trxNumber."|||||".$layanan;
        $postdata['TRX_NUMBER'] = $trxNumber;
        $postdata['KODE_LAYANAN'] = $layanan;
		// $postdata['BRACH_CODE'] = $this->session->all_userdata();

		$kdLayanan = $layanan;

		// $trxNumber 	= 0;
        $layanan = '-';
		$branchAc	= 0;
		$branchCd 	= 0;
        $name = '-';
        $periode = '-';
        $custNum = '-';
        $alamat = '-';
        $nocontract = '-';
        $nokoreksi = '-';
		$dataPranota = array();
		$dataPranota['trxNumber'] = $trxNumber;
		$dataPranota['branchCd']  = $branccode;//'JBI';
		$data = $this->senddataurl('ReviewHeaderSimopRupa/',$postdata,'POST');
		// print_r($postdata); die();
		$layanan = $this->senddataurl('ReviewSimopRupa/',$postdata,'POST');
		// print_r($layanan);die();
		if(count($layanan)>0){
			$layanan = $layanan[0]->NAMA_LAYANAN;
		}
        $tgl_pra = '-';
		// $data4 = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_CODE"=>"$data[0]->BRANCH_ACCOUNT"),'POST');
		// print_r($judul);die();
		// echo json_encode($data);die();
		if(count($data)>0){
            if ($kdLayanan == 'RUPA04') {
				$dataPranota['ID_PELANGGAN'] = $data[0]->ID_PELANGGAN;
				$dataPranota['NAMA_PENGGUNA'] = $data[0]->NAMA_PENGGUNA;
				$dataPranota['ALAMAT_PERUSAHAAN'] = $data[0]->ALAMAT_PERUSAHAAN;
				$dataPranota['LOKASI_PASANG'] = $data[0]->LOKASI_PASANG;
				$dataPranota['BULAN'] = $data[0]->BULAN;
				$dataPranota['TAHUN'] = $data[0]->TAHUN;
				$dataPranota['NO_REKENING_LISTRIK'] = $data[0]->NO_REKENING_LISTRIK;
				$dataPranota['TOTAL_TAGIHAN'] = $data[0]->TOTAL_TAGIHAN;
				$tgl_pra 						= $dataPranota['BULAN'].'-'.$dataPranota['TAHUN'];
            } elseif ($kdLayanan == 'RUPA05') {
				$dataPranota['trxNumber'] 		= $data[0]->NO_TAGIHAN;
				$dataPranota['Tanggal'] 		= $data[0]->PERIODE_AWAL;
				$dataPranota['name'] 			= $data[0]->NAMA_PELANGGAN;
				$dataPranota['custNum'] 		= $data[0]->ID_PELANGGAN;
				$dataPranota['alamat'] 			= $data[0]->ALAMAT_PELANGGAN;
				$dataPranota['nocontract']		= $data[0]->NO_KONTRAK_SEWA;
				$dataPranota['tglcontract'] 	= $data[0]->TANGGAL_KONTRAK;
				$dataPranota['noPersetujuan'] 	= $data[0]->NO_PERSETUJUAN;
				$dataPranota['katsewa'] 		= $data[0]->NAMA_KATEGORI_SEWA;
				$dataPranota['luas'] 			= $data[0]->LUAS;
				$dataPranota['lokasi']			= $data[0]->ALAMAT_1;
				$dataPranota['periodeawal']		= $data[0]->PERIODE_TAGIHAN_AWAL;
				$dataPranota['periodeakhr']		= $data[0]->PERIODE_TAGIHAN_AKHIR;
				$dataPranota['peruntukan']		= $data[0]->NAMA_PERUNTUKAN;
                $dataPranota['descript'] = '	&nbsp;&nbsp;<table>
														<tr><td>Biaya perhitungan '.$dataPranota['katsewa'].', berdasarkan No. Persetujuan <b>'.$dataPranota['noPersetujuan'].'</b>, untuk penggunaan '.$dataPranota['peruntukan'].' seluas '.number_format($dataPranota['luas'], 0, '', '.').' m<sup>2</sup> yang berlokasi di '.$dataPranota['lokasi'].'</td></tr>
														<tr><td>untuk periode '.$dataPranota['periodeawal'].' s/d '.$dataPranota['periodeakhr'].'</td></tr>
														<tr><td>dengan rincian sbb:</td></tr>
													</table>';
				$dataPranota['TAGIHAN'] 		= $data[0]->TAGIHAN;
				$tgl_pra 						= $dataPranota['tglcontract'];
				/*$layanan   	= $data[0]->NAMA_LAYANAN;
				$branchAc	= $data[0]->BRANCH_ACCOUNT;
				$branchCd 	= $data[0]->BRANCH_CODE;
				$periode	= $data[0]->PERIODE;
				$nokoreksi	= "-";*/
            } elseif ($kdLayanan == 'RUPA06') {
				$dataPranota['KD_CABANG'] = $data[0]->KD_CABANG;
				$dataPranota['BRANCH_CODE'] = $data[0]->BRANCH_CODE;
				$dataPranota['BRANCH_ACCOUNT'] = $data[0]->BRANCH_ACCOUNT;
				$dataPranota['trxNumber'] = $data[0]->TRX_NUMBER;
				$dataPranota['TGL_PRANOTA'] = $data[0]->TGL_PRANOTA;
				$dataPranota['CUSTOMER_NUMBER'] = $data[0]->CUSTOMER_NUMBER;
				$dataPranota['CUSTOMER_NAME'] = $data[0]->CUSTOMER_NAME;
				$dataPranota['KODE_LAYANAN'] = $data[0]->KODE_LAYANAN;
				$dataPranota['AMOUNT_TOTAL'] = $data[0]->AMOUNT_TOTAL;
				$dataPranota['PERIODE'] = $data[0]->PERIODE;
				$tgl_pra = $dataPranota['TGL_PRANOTA'];
            } elseif ($kdLayanan == 'RUPA07' || $kdLayanan == 'RUPA13') {
				//echo print_r ($data);die; //test api
				$dataPranota['KD_CABANG'] = $data[0]->KD_CABANG;
				$dataPranota['ID_JENIS_SEWA'] = $data[0]->ID_JENIS_SEWA;
				$dataPranota['NO_PERMOHONAN'] = $data[0]->NO_PERMOHONAN;
				$dataPranota['TANGGAL_PERMOHONAN'] = $data[0]->TANGGAL_PERMOHONAN;
				$dataPranota['NO_SURAT_PERUSAHAAN'] = $data[0]->NO_SURAT_PERUSAHAAN;
				$dataPranota['PERIODE_AWAL'] = $data[0]->PERIODE_AWAL;
				$dataPranota['PERIODE_AKHIR'] = $data[0]->PERIODE_AKHIR;
				$dataPranota['ID_PELANGGAN'] = $data[0]->ID_PELANGGAN;
				$dataPranota['KD_KAPAL'] = $data[0]->KD_KAPAL;
				$dataPranota['NM_KAPAL'] = $data[0]->NM_KAPAL;
				$dataPranota['NAMA_PELANGGAN'] = $data[0]->NAMA_PELANGGAN;
				$dataPranota['ALAMAT_PELANGGAN'] = $data[0]->ALAMAT_PELANGGAN;
				$dataPranota['NAMA_PEMOHON'] = $data[0]->NAMA_PEMOHON;
				$dataPranota['CATATAN'] = $data[0]->CATATAN;
				$dataPranota['TAHAPAN'] = $data[0]->TAHAPAN;
				$dataPranota['JUMLAH'] = $data[0]->JUMLAH;
				$dataPranota['BIAYA'] = $data[0]->TOTAL;
				$dataPranota['BIAYA_ROUND'] = $data[0]->BIAYA_ROUND;
				$dataPranota['TOTAL_ROUND'] = $data[0]->TOTAL_ROUND;
				$dataPranota['PPN'] = $data[0]->PPN;
				$dataPranota['PPN2'] = $data[0]->PPN2;
				$dataPranota['TOTAL'] = $data[0]->BIAYA;
				$dataPranota['SIMKEU_FLAG'] = $data[0]->SIMKEU_FLAG;
				$dataPranota['SIMKEU_PROCESS'] = $data[0]->SIMKEU_PROCESS;
				$dataPranota['PAID_STATUS'] = $data[0]->PAID_STATUS;
				$dataPranota['STATUS_SPK'] = $data[0]->STATUS_SPK;
				$dataPranota['SATUAN_PAKAI'] = $data[0]->SATUAN_PAKAI;
                $dataPranota['nokoreksi'] = '-';
				$tgl_pra = $dataPranota['TANGGAL_PERMOHONAN'];
				$periode = $dataPranota['PERIODE_AWAL'].' s/d '.$dataPranota['PERIODE_AKHIR'];
            } elseif ($kdLayanan == 'RUPA09') {
				$dataPranota['KD_CABANG'] = $data[0]->KD_CABANG;
				$dataPranota['TRX_NUMBER'] = $data[0]->TRX_NUMBER;
				$dataPranota['TGL_PRANOTA'] = $data[0]->TGL_PRANOTA;
				$dataPranota['CUSTOMER_NUMBER'] = $data[0]->CUSTOMER_NUMBER;
				$dataPranota['CUSTOMER_NAME'] = $data[0]->CUSTOMER_NAME;
				$dataPranota['CUSTOMER_ADDRESS'] = $data[0]->CUSTOMER_ADDRESS;
				$dataPranota['AMOUNT_TOTAL'] = $data[0]->AMOUNT_TOTAL;
				$tgl_pra = $dataPranota['TGL_PRANOTA']; //echo print_r($dataPranota);die;
            } elseif ($kdLayanan == 'RUPA12') {
				$dataPranota['ID_BKT_HEADER'] = $data[0]->ID_BKT_HEADER;
				$dataPranota['TANGGAL_PERMOHONAN'] = $data[0]->TANGGAL_PERMOHONAN;
				$dataPranota['ID_PELANGGAN'] = $data[0]->ID_PELANGGAN;
				$dataPranota['NAMA_PELANGGAN'] = $data[0]->NAMA_PELANGGAN;
				$dataPranota['KD_KAPAL'] = $data[0]->KD_KAPAL;
				$dataPranota['NM_KAPAL'] = $data[0]->NM_KAPAL;
				$dataPranota['NO_PERMOHONAN'] = $data[0]->NO_PERMOHONAN;
				$dataPranota['NAMA_PEMOHON'] = $data[0]->NAMA_PEMOHON;
				$dataPranota['KD_CABANG'] = $data[0]->KD_CABANG;
				$dataPranota['CATATAN'] = $data[0]->CATATAN;
				$dataPranota['PPN_FREE'] = $data[0]->PPN_FREE;
				$dataPranota['PERIODE_AWAL'] = $data[0]->PERIODE_AWAL;
				$dataPranota['PERIODE_AWAL2'] = $data[0]->PERIODE_AWAL2;
				$dataPranota['PERIODE_AKHIR'] = $data[0]->PERIODE_AKHIR;
				$dataPranota['PERIODE_AKHIR2'] = $data[0]->PERIODE_AKHIR2;
				$dataPranota['TAGIHAN'] = $data[0]->TAGIHAN;
				$dataPranota['TAGIHAN2'] = $data[0]->TAGIHAN2;
				$dataPranota['PPN'] = $data[0]->PPN;
				$dataPranota['TOTAL'] = $data[0]->TOTAL;
				$dataPranota['PAID_STATUS'] = $data[0]->PAID_STATUS;
				$dataPranota['TOTAL2'] = $data[0]->TOTAL2;
				$tgl_pra = $dataPranota['TANGGAL_PERMOHONAN'];
				$periode = $dataPranota['PERIODE_AWAL'].' s/d '.$dataPranota['PERIODE_AKHIR'];
            } elseif ($kdLayanan == 'RUPA14') {
				$dataPranota['ORG_ID'] = $data[0]->ORG_ID;
				$dataPranota['PORT_ID'] = $data[0]->PORT_ID;
				$dataPranota['NO_NOTA'] = $data[0]->NO_NOTA;
				$dataPranota['trxNumber'] = $data[0]->NO_NOTA;
				$dataPranota['DNOTA'] = $data[0]->DNOTA;
				$dataPranota['DTA'] = $data[0]->DTA;
				$dataPranota['DTD'] = $data[0]->DTD;
				$dataPranota['QTY'] = $data[0]->QTY;
				$dataPranota['TARIF_KEBERSIHAN'] = $data[0]->TARIF_KEBERSIHAN;
				$dataPranota['TARIF_SUPERVISI'] = $data[0]->TARIF_SUPERVISI;
				$dataPranota['KD_PELANGGAN'] = $data[0]->KD_PELANGGAN;
				$dataPranota['NM_PELANGGAN'] = $data[0]->NM_PELANGGAN;
				$dataPranota['ALAMAT_PERUSAHAAN'] = $data[0]->ALAMAT_PERUSAHAAN;
				$dataPranota['NO_NPWP'] = $data[0]->NO_NPWP;
				$dataPranota['KD_KAPAL'] = $data[0]->KD_KAPAL;
				$dataPranota['NM_KAPAL'] = $data[0]->NM_KAPAL;
				$dataPranota['KD_CABANG'] = $data[0]->KD_CABANG;
				$dataPranota['KD_KADE'] = $data[0]->KD_KADE;
				$dataPranota['NM_KADE'] = $data[0]->NM_KADE;
				$dataPranota['PERDAGANGAN'] = $data[0]->PERDAGANGAN;
				$dataPranota['VOYAGE'] = $data[0]->VOYAGE;
				$dataPranota['KD_PBM'] = $data[0]->KD_PBM;
				$dataPranota['NM_PBM'] = $data[0]->NM_PBM;
				$dataPranota['BIAYA'] = $data[0]->BIAYA;
				$dataPranota['PPN_AMOUNT'] = $data[0]->PPN_AMOUNT;
				$dataPranota['AMOUNT_TOT_DUS'] = $data[0]->AMOUNT_TOT_DUS;
				$dataPranota['AMOUNT_TOT'] = $data[0]->AMOUNT_TOT;
				$tgl_pra = $dataPranota['DNOTA']; //echo print_r($dataPranota);die;
 			}
		}
		// print_r($dataPranota);die();
		define('noNotaFooter', $dataPranota['trxNumber']);
		// print_r($this->session->userdata('role_id'));die();
		/*lalalalal*/
		
		// $ORG_ID = $data[0]->ORG_ID; 
		// $BRANCH_CODE = $data[0]->BRANCH_CODE;
		$ORG_ID = $brancid; 
        $BRANCH_CODE = $branccode;
		
		// $data2 = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_CODE"=>$dataPranota['branchCd']),'POST');
        $data2 = $this->senddataurl('reviewSimopRupa/searchHeader/', array('INV_UNIT_ORGID' => $ORG_ID, 'INV_UNIT_CODE' => $BRANCH_CODE), 'POST');
		// print_r($data);die();
		// echo "||".$branchCd."||";print_r($data2);echo "||";//die();
		$header_nota = array(
                        'status_lunas' => 'S',
                        'e_logo' => $data2[0]->INV_ENTITY_LOGO,
                        'e_name' => $data2[0]->INV_ENTITY_NAME,
                        'num' => $dataPranota['trxNumber'],
                        'e_address' => $data2[0]->INV_ENTITY_ALAMAT,
                        'tgl_nota' => $tgl_pra,
                        'bag' => 'RUPA',
                        'e_npwp' => $data2[0]->INV_ENTITY_NPWP,
                        'e_faktur' => $data2[0]->INV_ENTITY_FAKTUR, );
		// print_r($header_nota);echo "||";
		// die();
		$header1 = header_pranota($header_nota);
		// echo $value->HEADER_SUB_CONTEXT;die();
		$postdata['KODE_LAYANAN'] = $kdLayanan;
		$data3 = $this->senddataurl('reviewDetailSimopRupa/',$postdata,'POST');
		// print_r($data3);die();
		/*echo json_encode($data3);
		die();*/
		// print_r($data3);die();
        // $data3 = $this->getdataurl('reviewDetailSimopRupa/'.$id);
        // echo "||";print_r($data3);die();
        $output_name = 'LAPORAN PDF PRANOTA '.$dataPranota['trxNumber'].'.pdf';
		$header = '<table>
			<tr>
                
                <td width="560" align="left" style="font-weight: bold;"></td>
            </tr>
            <tr>
            	<td width="560" align="left"></td>
            </tr>
            <tr>
            	<td width="560" align="left"></td>
            </tr>
        </table>';
        /*$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);*/
        // $pdf = new MyCustomPDFWithWatermark('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle($dataPranota['trxNumber']);
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(12, 0);
		// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->setLanguageArray(null);
		// $pdf->SetPrintFooter(false);
		$pdf->SetHeaderMargin(false);
		$pdf->SetTopMargin(5);
		$pdf->SetFooterMargin(20);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011',
       PDF_HEADER_STRING);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
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
		/* isinya */
		$judul = '';
        if ($kdLayanan == 'RUPA04') {
			$judul = '<table>
				<tr>
	                <td COLSPAN="2" align="center" width="100%"><hr></td>
				</tr>
				<tr>
					<br>
	                <td COLSPAN="2" align="center" width="100%"><b>PRANOTA '.strtoupper($layanan).'</b></td>
				</tr>
				<tr>
					<br>
	                <td COLSPAN="2" align="center" width="100%"><br/><hr></td>
				</tr>
	        </table>';
		}else if($kdLayanan=="RUPA05"){
			$judul = '<table>
				<tr>
	                <td COLSPAN="2" align="center" width="100%"><hr></td>
				</tr>
				<tr>
					<br>
	                <td COLSPAN="2" align="center" width="100%"><b>PRANOTA '.strtoupper($layanan).'</b></td>
				</tr>
				<tr>
					<br>
	                <td COLSPAN="2" align="center" width="100%"><br/><hr></td>
				</tr>
	        </table>';
		}else if($kdLayanan=="RUPA06"){
			$judul = '<table>
				<tr>
					<br>
	                <td  align="center" width="100%"></td>
				</tr>
				<tr>
					<br>
	                <br>
	                <td COLSPAN="2" align="center" width="100%"><b>PRANOTA '.strtoupper($layanan).'<br>'.strtoupper($dataPranota['CUSTOMER_NAME']).'</b></td>
				</tr>
				<tr>
					<br>
					<br>
	                <td align="center" width="100%"><br/></td>
				</tr>
	        </table>';
		}else if($kdLayanan=="RUPA13"){
			$judul = '<table>
				<tr>
					<br>
	                <td  align="center" width="100%"></td>
				</tr>
				<tr>
					<br>
	                <br>
	                <td COLSPAN="2" align="center" width="100%"><b>PRANOTA DAN PERHITUNGAN JASA<br><u>PORT FACILITY SERVICE</u></b></td>
				</tr>
				<tr>
					<br>
					<br>
	                <td align="center" width="100%"><br/></td>
				</tr>
	        </table>';
		}else {
			$judul = '<table>
				<tr>
	                <td COLSPAN="2" align="center" width="100%"><b>PRANOTA '.strtoupper($layanan).'</b></td>
				</tr>
				<tr>
	                <td COLSPAN="2" align="center" width="100%"><b>'.strtoupper($dataPranota['NAMA_PELANGGAN']).'</b></td>
				</tr>
	        </table>';
		}
		$lampiran = '';
		if($kdLayanan=="RUPA04"){
			$lampiran = '<table>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No. Tagihan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No. Koreksi Nota</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($nokoreksi).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Id Pelanggan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['ID_PELANGGAN']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Pelanggan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['NAMA_PENGGUNA']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No. Rek</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['NO_REKENING_LISTRIK']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Alamat</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['ALAMAT_PERUSAHAAN']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Lokasi Pasang</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['LOKASI_PASANG']).'</b></td>
	            </tr>
	        </table>';
		}else if($kdLayanan=="RUPA05"){
			$lampiran = '<table border="0px">
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No. Tagihan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No. Koreksi Nota</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($nokoreksi).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Tanggal</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.$dataPranota['Tanggal'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Pelanggan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130%"><b>'.strtoupper($dataPranota['name']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No. Account</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['custNum']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Alamat</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.strtoupper($dataPranota['alamat']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>No Kontrak</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;" width="230px"><b>'.strtoupper($dataPranota['nocontract']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>Tgl Kontrak</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="230px"><b>'.$dataPranota['tglcontract'].'</b></td>
	            </tr>
	        </table>';
		}else if($kdLayanan=="RUPA06"){
			// if (strtoupper($layanan) == "PAS HARIAN DISTRIBUSI DAN PENDAPATAN") {
				$lampiran = '<table>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>NO.PRANOTA</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="130px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>TANGGAL</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['TGL_PRANOTA'].'</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>Periode</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" width="230px"><b>'.$dataPranota['PERIODE'].'</b></td>
		            </tr>
		        </table>';
			/*} else {
				$lampiran = '<table>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>NO.PRANOTA</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="130px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>TANGGAL</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['TGL_PRANOTA'].'</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>Periode</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" width="230px"><b>'.$dataPranota['PERIODE'].'</b></td>
		            </tr>
		        </table>';
			}*/
			// echo strtoupper($layanan);die();
		}else if($kdLayanan=="RUPA07"){
			$lampiran = '<table>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>NO.PRANOTA</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="130px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>NO. KOREKSI NOTA</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['nokoreksi'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>PERIODE</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="230px"><b>'.$dataPranota['PERIODE_AWAL']." s/d ".$dataPranota['PERIODE_AKHIR'].'</b></td>
	            </tr>
	        </table>';
		}else if($kdLayanan=="RUPA09"){
			// if (strtoupper($layanan) == "PAS HARIAN DISTRIBUSI DAN PENDAPATAN") {
				$lampiran = '<table>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>NO.PRANOTA</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="130px"><b>'.strtoupper($dataPranota['TRX_NUMBER']).'</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>TANGGAL</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['TGL_PRANOTA'].'</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="2" align="left" width="100px"><b>Periode</b></td>
						<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
		                <td COLSPAN="2" align="left" width="230px"><b>'.$dataPranota['PERIODE'].'</b></td>
		            </tr>
		        </table>'; //echo print_r($dataPranota); die;
			}else if($kdLayanan=="RUPA12"){
			$lampiran = '<table>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>No.Pranota</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;font-weight: bold;" width="230px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>Pelanggan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['NAMA_PELANGGAN'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>Pemohon</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['NAMA_PEMOHON'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>Kapal</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['NM_KAPAL'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>Tanggal</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;font-weight: bold;" width="230px"><b>'.$dataPranota['PERIODE_AWAL2']." s/d ".$dataPranota['PERIODE_AKHIR2'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>Kegiatan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>-</b></td>
	            </tr>
	        </table>';
        } elseif ($kdLayanan == 'RUPA13') {
			$lampiran = '<table>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>NO.PRANOTA</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="130px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>NO. KOREKSI NOTA</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>'.$dataPranota['nokoreksi'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="120px"><b>PERIODE</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="230px"><b>'.$dataPranota['PERIODE_AWAL']." s/d ".$dataPranota['PERIODE_AKHIR'].'</b></td>
	            </tr>
	        </table>';
		}else if($kdLayanan=="RUPA14"){
			$Jnsdagang = (strpos($dataPranota['PERDAGANGAN'],",")=='DN')?"DALAM NEGERI":"LUAR NEGERI";
			$lampiran = '<table>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>NO.PRANOTA</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;" width="190px"><b>'.strtoupper($dataPranota['NO_NOTA']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>Debitur</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$dataPranota['KD_PELANGGAN']." - ".$dataPranota['NM_PELANGGAN'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>Alamat</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$dataPranota['ALAMAT_PERUSAHAAN'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>Npwp</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$dataPranota['NO_NPWP'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>Nama Kapal / VOY / Tanggal</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$dataPranota['NM_KAPAL'].' / '.$dataPranota['VOYAGE'].' / '.$dataPranota['DNOTA'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>Jenis Perdagangan</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$Jnsdagang.'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>ETA / ETD</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$dataPranota['DTA'].' / '.$dataPranota['DTD'].'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="190px"><b>Kade / Dermaga</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="190px"><b>'.$dataPranota['KD_KADE'].' / '.$dataPranota['NM_KADE'].'</b></td>
	            </tr>
	        </table>';
		}else {
			$lampiran = '<table>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>NO.PRANOTA</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="130px"><b>'.strtoupper($dataPranota['trxNumber']).'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>TANGGAL</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" width="130px"><b>'.$tgl_pra.'</b></td>
	            </tr>
	            <tr>
	                <td COLSPAN="2" align="left" width="100px"><b>PERIODE</b></td>
					<td COLSPAN="1" align="left" width="10px"><b>:</b></td>
	                <td COLSPAN="2" align="left" style="font-size: 11px;font-family: franklingothicbook;" width="230px"><b>'.$periode.'</b></td>
	            </tr>
	        </table>';
		}
		$tbl = '';
		if($kdLayanan=="RUPA05"){
			$tbl = '<table border="">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="430px"><b>Perhitungan Kontrak</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="225px"><b>Keterangan</b></td>
	            </tr>';
		}else if($kdLayanan=="RUPA06"){
			if (strpos(strtoupper($layanan),"DISTRIBUSI DAN PENDAPATAN") != "") {
				$tbl = '<table border="1">
		            <tr>
		                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px">NO</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="220px">JENIS PAS</td>
						<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="70px">NO. SERI</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px">LEMBAR</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px">TARIF</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="165px">TOTAL</td>
		            </tr>';
			} else {
				$tbl = '<table border="1">
		            <tr>
		                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px">NO</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="220px">JENIS PAS</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="115px">JML PAS</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="115px">TARIF</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="165px">TOTAL</td>
		            </tr>';

			}
		}else if($kdLayanan=="RUPA07"){
			$tbl = '<table border="1">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px"><b>NO</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="220px"><b>JENIS ALAT</b></td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="70px"><b>DURASI (JAM)</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px"><b>TARIF</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px"><b>TARIF SEBELUM SHARING</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="165px"><b>TOTAL</b></td>
	            </tr>';
		}else if($kdLayanan=="RUPA12"){
			$tbl = '<table border="1">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px"><b>NO</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="70px"><b>TANGGAL</b></td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="150px"><b>JENIS KEGIATAN</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="170px"><b>PERHITUNGAN</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="140px"><b>JUMLAH</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="120px"><b>KETERANGAN</b></td>
	            </tr>';
	            // echo $tbl;die();
		}else if($kdLayanan=="RUPA13"){
			$tbl = '<table border="1">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px"><b>NO</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="180px"><b>JENIS ALAT</b></td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="70px"><b>KAPASITAS</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="40px"><b>JML ALAT</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px"><b>JAM / TON</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px"><b>TARIF</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="165px"><b>TOTAL</b></td>
	            </tr>';
	            // echo $tbl;die();
		}else if($kdLayanan=="RUPA14"){
			$tbl = '<table border="1">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px"><b>NO</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="100px"><b>KEGIATAN</b></td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="100px"><b>JENIS KEMASAN</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="100px"><b>JENIS BARANG</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px"><b>QTY</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px"><b>TARIF</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="165px"><b>PENDAPATAN</b></td>
	            </tr>';
	            // echo $tbl;die();
		}else{
			$tbl = '<table border="1">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px">NO</td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="220px">JENIS PAS</td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="70px">JML PAS</td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="160px">TARIF</td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="165px">TOTAL</td>
	            </tr>';
		}
        $total_amount = 0;
        if($kdLayanan=="RUPA05"){
        	$tbl.='<tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="left" width="430px">'.$dataPranota['descript'].' <br/>';
        	$tbl.= '<table>';
	        $i=0;
	        //print_r($data3);//die();
	        $ppn = 0;
        	for ($i=0; $i < count($data3); $i++) {
	        	$tbl.= '<tr>
	        			<td width="50" style="font-size: 11px;font-family: franklingothicbook;" align="center">&nbsp;'.($i+1).'</td>
	        			<td width="180" align="left">'.$data3[$i]->NAMA_JENIS_BIAYA.'</td>
	        			<td width="180" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($data3[$i]->BIAYA, 0, ' ', '.').'</td>
	        			</tr>';
	        	$ppn += $data3[$i]->PPN;
	            // $total_amount += $data3[$i]->AMOUNT;
	        }
	        $tagihan = strpos($dataPranota['TAGIHAN'],".");
	        // $ppn = strpos($dataPranota['TAGIHAN'],".");
	        if($tagihan==""){
	        	$tagihan = strpos($dataPranota['TAGIHAN'],",");
	        	// $ppn = strpos($dataPranota['TAGIHAN'],",");
	        	if($tagihan==""){
	        		$tagihan = number_format($dataPranota['TAGIHAN'], 0, ' ', '.');
	        	}else{
	        		// $ppn = str_replace(",", "", $ppn);
	        		$tagihan = str_replace(",", "", $dataPranota['TAGIHAN']);
	        		$tagihan = number_format($tagihan, 0, ' ', ',');
	        	}
	        }else{
        		// $ppn = str_replace(".", "", $ppn);
	        }
	        // $ppn = $dataPranota['TAGIHAN']*0.1;
	        // print_r($dataPranota);die();
	        $tbl.= '<tr>
	        			<td width="50" style="font-size: 11px;font-family: franklingothicbook;" align="center">&nbsp;'.($i+1).'</td>
	        			<td width="180" align="left">PPN 10%</td>
	        			<td width="180" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($ppn, 0, ' ', '.').'</td>
        			</tr>
        			<tr>
	        			<td width="50" align="center">&nbsp;</td>
	        			<td width="180" align="left"><b>TOTAL</b></td>
	        			<td width="180" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$tagihan.'</td>
        			</tr>
        			</table>
        		</td>
                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left" width="225px"></td>

            </tr>

            </table>';
        }else if($kdLayanan=="RUPA06"){
        	$parsingTitik = "p".substr($dataPranota['AMOUNT_TOTAL'],-3);
        	if ($parsingTitik == "p.00" || $parsingTitik == "p,00") {
        		$amountParse = substr($dataPranota['AMOUNT_TOTAL'],0,-3);
        	} else {
        		$amountParse = $dataPranota['AMOUNT_TOTAL'];
        	}
        	$amountParse = str_replace(".", "", $amountParse);
        	$amountParse = str_replace(",", "", $amountParse);

        	// echo $parsingTitik;die();
        	// $sebelumPPN = $amountParse;
        	// $ppnAmount = $amountParse*0.1;
			// $setelahPPN = $amountParse+$ppnAmount;
			$setelahPPN = (int)$amountParse;
			$sebelumPPN = round((100/110) * $setelahPPN);
			$ppnAmount = $setelahPPN - $sebelumPPN;
			if (strtoupper($layanan) == "PAS HARIAN DISTRIBUSI DAN PENDAPATAN") {
        		// echo print_r($data3);die();
	        	for ($i=0; $i < count($data3); $i++) {
					$jumlah_pas = (int)$data3[$i]->JUMLAH_PAS;
					$tarif_pas = (int)$data3[$i]->TARIF;
					$amount_pas = $data3[$i]->AMOUNT;
	        	$tbl.= '<tr>
			                <td COLSPAN="9" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="center" width="40px">'.($i+1).'</td>
			                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left" width="220px">&nbsp;'.$data3[$i]->JENIS_PAS.'</td>
							<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="70px">&nbsp;'.$data3[$i]->NO_SERI.'</td>
			                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="80px">&nbsp;'.number_format($jumlah_pas, 0, '', '.').'</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="80px">'.number_format($tarif_pas, 0, ' ', '.').'&nbsp;&nbsp;</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($amount_pas, 0, ' ', '.').'&nbsp;&nbsp;</td>
			            </tr>';
		        }
		    } else {
		    	for ($i=0; $i < count($data3); $i++) {
					$jumlah_pas = (int)$data3[$i]->JUMLAH_PAS;
					$tarif_pas = (int)$data3[$i]->TARIF;
					$amount_pas = $data3[$i]->AMOUNT;
	        	$tbl.= '<tr>
			                <td COLSPAN="9" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="center" >'.($i+1).'</td>
			                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->JENIS_PAS.'</td>
							<td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" >&nbsp;'.number_format($jumlah_pas, 0, '', '.').'</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right">'.number_format($tarif_pas, 0, ' ', '.').'&nbsp;&nbsp;</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right">'.number_format($amount_pas, 0, ' ', '.').'&nbsp;&nbsp;</td>
			            </tr>';
		        }
		    }
	        $tbl.='<tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px">TOTAL :&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($sebelumPPN, 0, ' ', '.').'&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px">PPN 10% :&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($ppnAmount, 0, ' ', '.').'&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px">JUMLAH PENDAPATAN :&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($setelahPPN, 0, ' ', '.').'&nbsp;&nbsp;</td>
		            </tr>
		        </table>';
	        $tbl.='<div style="line-height: 100px;">&nbsp;</div><table>
        			<tr>
        				<td width="330px" align="center">Yang Menerima</td>
        				<td width="330px" align="center">&nbsp;</td>
        			</tr>
        			<tr>
        				<td width="330px" align="center"><br/><br/><br/><br/><br/><br/>..............</td>
        				<td width="330px" align="center">&nbsp;</td>
        			</tr>
	        	</table>';
        }else if($kdLayanan=="RUPA07"){/*rupa07*/
        	//echo json_encode($data3);die();//
        	for ($i=0; $i < count($data3); $i++) {
        	$tbl.= '<tr>
		                <td COLSPAN="9" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="center" width="40px">'.($i+1).'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left" width="220px">&nbsp;'.$data3[$i]->NAMA_JENIS_ALAT.'</td>
						<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="70px">'.(int)$data3[$i]->DURASI_JAM * (int)$data3[$i]->JUMLAH.'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right" width="80px">'.number_format($data3[$i]->TARIF).'&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right" width="80px">0&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right" width="165px">'.number_format($data3[$i]->BIAYA).'&nbsp;&nbsp;</td>
		            </tr>';
	        }
	        $tbl.='<tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px"><b>JUMLAH</b>&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['BIAYA']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px"><b>PPN 10%</b>&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['PPN']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px"><b>TOTAL</b>&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['TOTAL']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		        </table>';
	        $tbl.='	<div style="line-height: 20px;"><b>CATATAN: '.'<b></div>
	        		<div style="line-height: 100px;"></div>
	        	<table>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
	        	</table>';
        }else if($kdLayanan=="RUPA09"){
			//echo print_r ($data3);die;
        	$parsingTitik = "p".substr($dataPranota['AMOUNT_TOTAL'],-3);
        	if ($parsingTitik == "p.00" || $parsingTitik == "p,00") {
        		$amountParse = substr($dataPranota['AMOUNT_TOTAL'],0,-3);
        	} else {
        		$amountParse = $dataPranota['AMOUNT_TOTAL'];
        	}
        	$amountParse = str_replace(".", "", $amountParse);
        	$amountParse = str_replace(",", "", $amountParse);

        	// echo $parsingTitik;die();
        	$sebelumPPN = $amountParse;
        	$ppnAmount = $amountParse*0.1;
        	$setelahPPN = $amountParse+$ppnAmount;
			if (strtoupper($layanan) == "PAS HARIAN DISTRIBUSI DAN PENDAPATAN") {
        	// echo print_r($data3);die();
	        	for ($i=0; $i < count($data3); $i++) {
	        	$tbl.= '<tr>
			                <td COLSPAN="9" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="center" width="40px">'.($i+1).'</td>
			                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left" width="220px">&nbsp;'.$data3[$i]->NAMA_TARIF_AIR_DARAT.'</td>
			                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="40px">&nbsp;'.$data3[$i]->PEMAKAIAN.'</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="80px">'.number_format($data3[$i]->TARIF_BLOK1, 0, ' ', '.').'&nbsp;&nbsp;</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($data3[$i]->TAGIHAN, 0, ' ', '.').'&nbsp;&nbsp;</td>
			            </tr>';
		        }
		    } else {
		    	for ($i=0; $i < count($data3); $i++) {
	        	$tbl.= '<tr>
			                <td COLSPAN="9" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="center" >'.($i+1).'</td>
			                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->NAMA_TARIF_AIR_DARAT.'</td>
							<td COLSPAN="2" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->PEMAKAIAN.'</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="80px">'.number_format($data3[$i]->TARIF_BLOK1, 0, ' ', '.').'&nbsp;&nbsp;</td>
			                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($data3[$i]->TAGIHAN, 0, ' ', '.').'&nbsp;&nbsp;</td>
			            </tr>';
		        }
		    }
	        $tbl.='<tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px">TOTAL :</td>
		                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($sebelumPPN, 0, ' ', '.').'&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px">PPN 10% :</td>
		                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($ppnAmount, 0, ' ', '.').'&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px">JUMLAH PENDAPATAN :</td>
		                <td COLSPAN="2" style="font-size: 12px;font-family: Calibri;franklingothicbook:22px;line-height: 24px;" align="right" width="165px">'.number_format($setelahPPN, 0, ' ', '.').'&nbsp;&nbsp;</td>
		            </tr>
		        </table>';
	        $tbl.='<div style="line-height: 100px;">&nbsp;</div><table>
        			<tr>
        				<td width="330px" align="center">Yang Menerima</td>
        				<td width="330px" align="center">&nbsp;</td>
        			</tr>
        			<tr>
        				<td width="330px" align="center"><br/><br/><br/><br/><br/><br/>..............</td>
        				<td width="330px" align="center">&nbsp;</td>
        			</tr>
	        	</table>';
        }
		else if($kdLayanan=="RUPA12"){
        	/*$tbl = '<table border="1">
	            <tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;" align="center" width="40px"><b>NO</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="180px"><b>TANGGAL</b></td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center" width="200px"><b>JENIS KEGIATAN</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="200px"><b>PERHITUNGAN</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="140px"><b>JUMLAH</b></td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center" width="180px"><b>KETERANGAN</b></td>
	            </tr>';*/
            for ($i = 0; $i < count($data3); ++$i) {
        		$tbl.= '<tr>
		                <td COLSPAN="9" width="40px" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="center">'.($i+1).'</td>
		                <td COLSPAN="2" width="70px" style="height:22px;line-height: 24px;" align="center">&nbsp;'.$data3[$i]->TGL_BKT_DETAIL2.'</td>
		                <td COLSPAN="2" width="150px" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->NAMA_TARIF_RUPA2.'</td>
		                <td COLSPAN="2" width="170px" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->VOLUME2." ".$data3[$i]->ID_SATUAN." x Rp. ".$data3[$i]->TARIF2.'</td>
		                <td COLSPAN="2" width="140px" style="height:22px;line-height: 24px;" align="right">'.$data3[$i]->TAGIHAN2.'&nbsp;&nbsp;</td>
		                <td COLSPAN="2" width="120px" style="height:22px;line-height: 24px;">&nbsp;</td>
		            </tr>';
	        }
	        $tbl.='<tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="430px"><b>JUMLAH</b>&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="120px"><b>'.$dataPranota['TAGIHAN2'].'</b>&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="120px"><b>&nbsp;</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="430px"><b>PPN 10%</b>&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="120px"><b>'.$dataPranota['PPN'].'</b>&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="120px"><b>&nbsp;</b></td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="430px"><b>TOTAL</b>&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="120px"><b>'.$dataPranota['TOTAL'].'</b>&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="120px"><b>&nbsp;</b></td>
		            </tr>
		        </table>';
	        $tbl.='	<div style="line-height: 20px;"><b>CATATAN: '.'<b></div>
	        		<div style="line-height: 100px;"></div>
	        	<table>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
	        	</table>';
        } elseif ($kdLayanan == 'RUPA13') {
            for ($i = 0; $i < count($data3); ++$i) {
                $labels = ($data3[$i]->KAPASITAS == 'WHL') ? ' M3' : ' TON';
        	$tbl.= '<tr>
		                <td COLSPAN="9" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="center">'.($i+1).'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->NAMA_JENIS_ALAT.'</td>
						<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center">'.number_format($data3[$i]->KAPASITAS).$labels.'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center">'.number_format($data3[$i]->JUMLAH).'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right">'.number_format($data3[$i]->DURASI_JAM).'&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right">'.number_format($data3[$i]->TARIF).'&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" width="145px" align="right">'.number_format($data3[$i]->BIAYA).'&nbsp;&nbsp;</td>
		            </tr>';
	        }
	        $tbl.='<tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px"><b>JUMLAH</b> </td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['BIAYA']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px"><b>PPN 10%</b> </td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['PPN2']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="490px"><b>TOTAL</b> </td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['TOTAL2']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		        </table>';
	        $tbl.='	<div style="line-height: 20px;"><b>CATATAN: '.'<b></div>
	        		<div style="line-height: 100px;"></div>
	        	<table>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
	        	</table>';
        } elseif ($kdLayanan == 'RUPA14') {
            for ($i = 0; $i < count($data3); ++$i) {
            // $labels = ($data3[$i]->KAPASITAS=='WHL')?" M3":" TON";
			//echo print_r($dataPranota);die;
        	$tbl.= '<tr>
		                <td COLSPAN="9" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="center">'.($i+1).'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left">&nbsp;'.$data3[$i]->JENIS.'</td>
						<td COLSPAN="1" style="height:22px;line-height: 24px;" align="center">'.$data3[$i]->KEMASAN.'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="center">'.$data3[$i]->NM_BARANG.'</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right">'.number_format($data3[$i]->QTY).'&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="right">'.number_format($data3[$i]->TARIF).'&nbsp;&nbsp;</td>
		                <td COLSPAN="2" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;" width="145px" align="right">'.number_format($data3[$i]->PENDAPATAN).'&nbsp;&nbsp;</td>
		            </tr>';
	        }
	        $tbl.='<tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="500px"><b>JUMLAH</b>&nbsp;&nbsp;&nbsp; </td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['AMOUNT_TOT']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="500px"><b>ADMINISTRASI</b>&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['PPN2']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="500px"><b>PPN 10%</b>&nbsp;&nbsp;&nbsp;</td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['PPN_AMOUNT']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		            <tr>
		                <td COLSPAN="9" style="line-height: 24px;" align="right" width="500px"><b>TOTAL</b>&nbsp;&nbsp;&nbsp; </td>
		                <td COLSPAN="9" style="line-height: 24px;" align="center" width="20px"><b>Rp</b></td>
		                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="146px"><b>'.number_format($dataPranota['AMOUNT_TOT_DUS']).'</b>&nbsp;&nbsp;</td>
		            </tr>
		        </table>';
	        $tbl.='	<div style="line-height: 20px;"><b>CATATAN: '.'<b></div>
	        		<div style="line-height: 100px;"></div>
	        	<table>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
        			<tr>
        				<td width="330px" align="center"></td>
        				<td width="330px" align="center"></td>
        			</tr>
	        	</table>';
        }else{
            for ($i = 0; $i < count($data3); ++$i) {
	        	$tbl.='<tr>
	                <td COLSPAN="9" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="center" width="40px">'.($i+1).'</td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;" align="left" width="220px">&nbsp;'.$data3[$i]->NAMA_TARIF_RUPA2.'</td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="center" width="70px">'.number_format($data3[$i]->VOLUME).'</td>
					<td COLSPAN="1" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="160px">'.$data3[$i]->TARIF2.'&nbsp;&nbsp;</td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="165px">'.$data3[$i]->TAGIHAN2.'&nbsp;&nbsp;</td>
	            </tr>';
	        }
	        $parsingTitik = "p".substr($dataPranota['TOTAL'],-3);
        	if ($parsingTitik == "p.00" || $parsingTitik == "p,00") {
        		$amountParse = substr($dataPranota['TOTAL'],0,-3);
        	} else {
        		$amountParse = $dataPranota['TOTAL'];
        	}
        	$amountParse = str_replace(".", "", $amountParse);
        	$amountParse = str_replace(",", "", $amountParse);

	        // $dataPranota['TOTAL']
	        $huruf = $this->getdataurl('others/terbilang/'.$amountParse);
	        // print_r($huruf);die();
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang.'Rupiah';
				}
			$tbl.='<tr>
	                <td COLSPAN="4" style="height:22px;line-height: 24px;" align="left" width="490">&nbsp;Terbilang : '.ucwords($terbilang).'</td>
	                <td COLSPAN="2" style="height:22px;line-height: 24px;font-size: 11px;font-family: franklingothicbook;" align="right" width="165px">'.number_format($amountParse, 0, ' ', ',').'&nbsp;&nbsp;</td>
	            </tr>';
	        $tbl.='</table>
	        <p><b>CATATAN:</b><p>';
        }
        $ematerai_nota = array(
        				"fm"=>"FM.01/04/05/04",
						"amountMaterai"=>"",
						"redaksi"=>"",
						"status_lunas"=>"",
						/*
						"unit_wilayah"=>$data2[0]->INV_ENTITY_NAME,
						"alamat_wilayah"=>$data2[0]->INV_ENTITY_ALAMAT,
						*/
						"unit_wilayah"=>$data2[0]->INV_UNIT_NAME,
						"alamat_wilayah"=>$data2[0]->INV_UNIT_ALAMAT,
					);

		$ematerai_nota = ematerai_nota($ematerai_nota);

		/* settingan pdf */
		$pdf->SetFont('gotham', '', 8);
		$pdf->writeHtml($header1, true, false, false, false, '');
		// $pdf->SetFont('courier', '', 8);
		
		$pdf->writeHtml($header, true, false, false, false, '');
		$pdf->writeHtml($judul, true, false, false, false, '');
		$pdf->writeHtml($lampiran, true, false, false, false, '');
		$pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->SetY(260);
		$pdf->writeHtml($ematerai_nota, true, false, false, false, '');

		// $pdf->writeHtml($footer, true, false, false, false, '');
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		// $pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		// $pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');
	}
	/*public function headerTest(){
		// echo "ahhahaha";die();
		$data = array(	"e_logo"=>"",
						"e_name"=>"",
						"num"=>"",
						"e_address"=>"",
						"tgl_nota"=>"",
						"e_npwp"=>"",
						"e_faktur"=>"",
						"jenisNota"=>"",
					);
		$data['e_logo'] = "hahahahaha";
		$data['e_name'] = "hahahahaha";
		$data['num'] = "hahahahaha";
		$data['e_address'] = "hahahahaha";
		$data['tgl_nota'] = "hahahahaha";
		$data['e_npwp'] = "hahahahaha";
		$data['e_faktur'] = "hahahahaha";
		$data['jenisNota'] = "hahahahaha";
		// print_r($data);
		// echo $data['e_logo'];
		$this->load->helper('nota_invoice_helper');
		$lol = header_nota($data);
		echo "===>".$lol;
	}*/
	public function get_nota_redaksi($id,$layanan){
		return $this->auth_model->get_nota_redaksi2($id,$layanan);
	}

	

	/*petikemas*/
	public function cetak_nota($layanan,$no_invoice="")
	{
        // $this->load->helper('nota_invoice_helper');
		$this->load->helper('pdf_helper');
		tcpdf();
		$this->load->helper('nota_invoice_helper');
		// echo "$Layanan";
		// $this->load->library('Nama_fungsi');
		//$qs = $this->input->server('QUERY_STRING');
		// $real_token = md5(sha1(md5(base64_encode($no_invoice).base64_encode($layanan))));
		/*if($check_token != $real_token) {
			echo 'invalid token';
			die();
		}*/
    	// $id    = $this->uri->segment(5);
		if($layanan!="RUPARUPA"){
			$layanan = strtolower($layanan);
		}
	    // $id    = $no_invoice;
		$id    = $this->mx_encryption->decrypt($no_invoice);


    	// echo $layanan."||".$id."||".$check_token; die();
		//echo $no_invoice;
		//echo '<br>';
  		//echo $id; die();
    	$id2 	= $id;
		switch($layanan)
		{
			case "petikemas":
				$id2 	= $id; //diaktifin data gak muncul
				$data_header = $this->getdataurl('invh/pdf/PETIKEMAS/'.$id2);

				//ambil data dari trx_header
				$num       = $data_header->TRX_NUMBER;
				$tgl_nota  = $data_header->TRX_DATE;

				$org_id  = $data_header->ORG_ID;
				$unit_code  = $data_header->BRANCH_CODE;
				$custname  = $data_header->CUSTOMER_NAME;
				$c_number  = $data_header->CUSTOMER_NUMBER;
				$c_address = $data_header->CUSTOMER_ADDRESS;
				$nomornpwp = $data_header->CUSTOMER_NPWP;
				$kapal 	   = $data_header->VESSEL_NAME;
				$kunjungan = $data_header->PER_KUNJUNGAN_FROM;
				$to_kun    = $data_header->PER_KUNJUNGAN_TO;
				$no_req    = $data_header->BILLER_REQUEST_ID;
				$dagang    = $data_header->INTERFACE_HEADER_ATTRIBUTE3;
				$current   = $data_header->CURRENCY_CODE;
				$ex_num    = $data_header->TRX_NUMBER_PREV;
				$header_context = $data_header->HEADER_SUB_CONTEXT;
				$headerContext = $data_header->HEADER_CONTEXT;
				$entityId = $data_header->INV_ENTITY_ID;
				$amountMaterai = ($data_header->AMOUNT_MATERAI=='')?"0":$data_header->AMOUNT_MATERAI;
				$redaksi = "-";
				$no_uper = $data_header->INTERFACE_HEADER_ATTRIBUTE6;
				$voyinout = $data_header->INTERFACE_HEADER_ATTRIBUTE5;
				$uang_jaminan = $data_header->UANG_JAMINAN;
				$piutang = $data_header->PIUTANG;
				$tgl_request = $data_header->TRX_DATE;

				$unit_loc  = $data_header->INV_UNIT_LOCATION;
				// echo $amountMaterai."||";
				// echo $entityId;die();
				if($entityId!=""){
					/*$getmaterai = array("TOTAL_TAGIHAN"=>$data_header->AMOUNT,"ORG_ID"=>$this->session->userdata('unit_id'),"BRANCH_CODE"=>$this->session->userdata('unit_org'),"HEADER_CONTEXT"=>$headerContext);
					$redaksis = $this->senddataurl('GetEmaterai',$getmaterai,'POST');
					$amountMaterai = $redaksis->NILAI_MATERAI;
					$redaksi = $redaksis->INV_EMATERAI_REDAKSI;*/
					/*
					$dataPost = array("INV_ENTITY_ID"=>$entityId);
					$entity = $this->senddataurl('entity/search',$dataPost,'POST');
					if(count($entity)>0){
						// echo "|||".$entity[0]->INV_ENTITY_ID."|||";
						$dataPost2 = array("INV_ENTITY_ID"=>$entityId);
						// print_r($dataPost2);echo "||";
						$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi',$dataPost2,'POST');
						if(count($redaksi)>0){
							$redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI=='')?"-":$redaksi[0]->INV_EMATERAI_REDAKSI;
						}else{
							$redaksi = "-";
						}
					}
					*/
					
						$dataPost2 = array("TRX_NUMBER"=>$num);
						$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksiHist',$dataPost2,'POST');
						if(count($redaksi)>0){
							$redaksi = ($redaksi[0]->INV_REDAKSI=='')?"-":$redaksi[0]->INV_REDAKSI;
						}else{
							$redaksi = "-";
						}
						
				}
				// print_r($data_header);die();
				// print_r($redaksi);die();
				/*$administrasi = "0";
				print_r($data_header);
				die();exit();*/
				//print_r($data_header->TRX_NUMBER);die;
				$data_administrasi = $this->getdataurl('invh/admin/PETIKEMAS/'.$data_header->TRX_NUMBER);
				//print_r($data_administrasi);die;
				$administrasi = $data_administrasi[0]->TOTTARIF;
				//echo "<pre>";print_r($administrasi);die;
                $e_name = ($data_header->INV_ENTITY_NAME == '') ? '-' : $data_header->INV_ENTITY_NAME;
                //print_r($e_name);die;
                $e_address = ($data_header->INV_ENTITY_ALAMAT == '') ? '-' : $data_header->INV_ENTITY_ALAMAT;
                $enpwp_ = ($data_header->INV_ENTITY_NPWP == '') ? '-' : $data_header->INV_ENTITY_NPWP;
                $e_faktur = $data_header->INV_ENTITY_FAKTUR;
                $e_npwp = ($data_header->INV_ENTITY_NPWP == '') ? '-' : $data_header->INV_ENTITY_NPWP;
                $e_faktur = ($data_header->INV_ENTITY_FAKTUR == '') ? '-' : $data_header->INV_ENTITY_FAKTUR;
                $e_logo = $data_header->INV_ENTITY_LOGO;
				$pejabat 		= $data_header->INV_PEJABAT_NAME;
				$nip_pejabat 	= $data_header->INV_PEJABAT_NIPP;
				$ttd_pejabat 	= $data_header->INV_PEJABAT_TTD;

				//tambahan
				$status_bayar 	= $data_header->STATUS;
				$status_lunas 	= $data_header->STATUS_LUNAS;
				$faktor_note = $data_header->INV_FAKTUR_NOTE;
				$jabatan_pejabat =  $data_header->INV_PEJABAT_JABATAN;
				// print_r($data_header);die();
                if ($e_logo == '') {
                    $e_logo = 'default.png';
				}
                if ($ttd_pejabat == '') {
                    $ttd_pejabat = 'ttd_default.png';
                }
                $jenisNota = '';
				$notaJenis = $this->getdataurl('mstnota/getData/'.$data_header->HEADER_SUB_CONTEXT);
				//print_r(substr($data_header->BILLER_REQUEST_ID,0,3));die;
				if(count($notaJenis)>0){
					$jenisNota = $notaJenis[0]->INV_NOTA_JENIS;
				}else{
					$jenisNota = "-";
				}
				$postdata3 = array("ID_REQ"=>$no_req);
				$NmShipper = $this->senddataurl('payment/shipper',$postdata3,'POST'); //integrasi_model->getshipper($no_req);
				$NmShipper = $NmShipper[0]->NAMA_SHIPPER;
				// print_r($NmShipper."--");die();
				// $postdata4 = array("ID_REQ"=>$no_req);
				// $NoCont = $this->senddataurl('payment/container',$postdata4,'POST'); //integrasi_model->getshipper($no_req);
				// $NoCont = $NoCont[0]->NO_CONTAINER;
				// print_r($NoCont."--".$no_req);die();
				
				// $jenisNota = $notaJenis[0]->INV_NOTA_JENIS;
				/*print_r($data_header);
				echo "<br/><br/>";
				print_r($notaJenis);
				die();*/

					// echo $e_logo; die();
				//$entitas = $this->getdataurl('entity/'.$id2);
				// $entitas = $this->getdataurl('entity/'.$org_id);
				//print_r($entitas);die;
				//foreach ($entitas as $e_data) {
					//$data_entity = $e_data;
					//$e_name 	 = $data_entity->INV_ENTITY_NAME;

					//print_r($e_faktur);die;


				//}

				/*//ambil dari db_invoice
				$data_pejabat = $this->getdataurl('pejabat/211'); //pake di tbl unit (unit/11)
					// $start_date 	= $data_pejabat->INV_PEJABAT_EFECTIVE;
					$pejabat 		= $data_header->INV_PEJABAT_NAME;
					$nip_pejabat 	= $data_header->INV_PEJABAT_NIPP;
					// $unit_wilayah 	= $data_unit->INV_UNIT_WILAYAH;
					// $unit_alamat 	= $data_unit->INV_UNIT_ALAMAT;*/

				// $data_wilayah = $this->getdataurl('wilayah/1');
				//print_r($data_wilayah);die;
				// print_r($data_header);die();
				
				//PRIOK ZONASI mungkin bisa di sederhanakan lagi
				//$ncon = preg_replace('/[^A-Za-z0-9\  ]/', '', $data_header->TRX_NUMBER);
				//$pID_NOTA = substr($ncon,3,3);
				//print_r($data_header->ORG_ID);die;
				if($data_header->ORG_ID == '1827' && $data_header->BRANCH_CODE == 'TPK')
				{
					$data_header_unit_zonasi = $this->getdataurl('invh/unitzonasi/PETIKEMAS/'.$data_header->TRX_NUMBER);
					$e_name 	 = ($data_header_unit_zonasi[0]->INV_ENTITY_NAME=='')?"-":$data_header_unit_zonasi[0]->INV_ENTITY_NAME;
					//print_r($e_name);die;					
					$e_address   = ($data_header_unit_zonasi[0]->INV_ENTITY_ALAMAT=='')?"-":$data_header_unit_zonasi[0]->INV_ENTITY_ALAMAT;
					$enpwp_      = ($data_header_unit_zonasi[0]->INV_ENTITY_NPWP=='')?"-":$data_header_unit_zonasi[0]->INV_ENTITY_NPWP;
					$e_faktur 	 = $data_header_unit_zonasi[0]->INV_ENTITY_FAKTUR;
					$e_npwp      = ($data_header_unit_zonasi[0]->INV_ENTITY_NPWP=='')?"-":$data_header_unit_zonasi[0]->INV_ENTITY_NPWP;
					$e_faktur 	 = ($data_header_unit_zonasi[0]->INV_ENTITY_FAKTUR=='')?"-":$data_header_unit_zonasi[0]->INV_ENTITY_FAKTUR;
					$e_logo		 = $data_header_unit_zonasi[0]->INV_ENTITY_LOGO;					
					$unit_wilayah 	= $data_header_unit_zonasi[0]->INV_ENTITY_NAME;
					$alamat_wilayah = $data_header_unit_zonasi[0]->INV_UNIT_ALAMAT;				
				}
				else
				{
					$e_name 	 = ($data_header->INV_ENTITY_NAME=='')?"-":$data_header->INV_ENTITY_NAME;
					//print_r($e_name);die;				
					$e_address   = ($data_header->INV_ENTITY_ALAMAT=='')?"-":$data_header->INV_ENTITY_ALAMAT;
					$enpwp_      = ($data_header->INV_ENTITY_NPWP=='')?"-":$data_header->INV_ENTITY_NPWP;
					$e_faktur 	 = $data_header->INV_ENTITY_FAKTUR;
					$e_npwp      = ($data_header->INV_ENTITY_NPWP=='')?"-":$data_header->INV_ENTITY_NPWP;
					$e_faktur 	 = ($data_header->INV_ENTITY_FAKTUR=='')?"-":$data_header->INV_ENTITY_FAKTUR;
					$e_logo		 = $data_header->INV_ENTITY_LOGO;					
					$unit_wilayah 	= $data_header->INV_UNIT_NAME;
					$alamat_wilayah = $data_header->INV_UNIT_ALAMAT;
					
				}	
				//print_r($unit_wilayah);die;
				$STATUS_KOREKSI 	= $data_header->STATUS_KOREKSI;	
				$headerSubContext = $data_header->HEADER_SUB_CONTEXT;
				
					//print_r($alamat_wilayah);die;
					/*print_r($data_wilayah);
					echo "<br/><br/>";
					print_r($data_header);
				die();exit();*/
				// print_r($id2);die;
                $header_nota = array('faktor_note' => $faktor_note,
                        'status_lunas' => $status_lunas,
                        'STATUS_KOREKSI' => $STATUS_KOREKSI,
                        'e_logo' => $e_logo,
						'headerSubContext' => $headerSubContext,
                        'e_name' => $e_name,
                        'num' => $num,
                        'e_address' => $e_address,
                        'tgl_nota' => $tgl_nota,
                        'e_npwp' => $e_npwp,
                        'ex_num' => $ex_num,
                        'e_faktur' => $faktor_note,
                        'administrasi' => $administrasi, );
				if($data_header->SOURCE_INVOICE_TYPE == 'OPUS' && substr($data_header->BILLER_REQUEST_ID,0,3) == 'REX'){
                            $judul_nota = array('jenisNota' => 'RE-EXPORT');
                        } /*elseif ($data_header->SOURCE_INVOICE_TYPE == 'OPUS' && $data_header->HEADER_SUB_CONTEXT == 'PTKM05') {
                            $judul_nota = array('jenisNota' => 'HI CO SCAN');
                        }*/ else {
                            $judul_nota = array('jenisNota' => $jenisNota);
				}
				$trxline = $this->getdataurl('invl/'.$id2);
				// print_r($trxline);die;
				
				/*$tax_amount=0; //buat PPn potongan 10 persen
				$total_amount=0;
				$materai = 6000;*/
				$tax_amount=($data_header->PPN_10PERSEN=='')?0:$data_header->PPN_10PERSEN; //buat PPn potongan 10 persen
				//if($data_header->BRANCH_CODE!='TPK' || $data_header->BRANCH_CODE!='PTP')
				//{
					//$materai = ($data_header->AMOUNT_MATERAI=='')?0:$data_header->AMOUNT_MATERAI;
					$materai = $amountMaterai;
				//}
				$dpptemp = $data_header->AMOUNT_DASAR_PENGHASILAN - $materai;
				$jum_amount=($data_header->AMOUNT_DASAR_PENGHASILAN=='') ? 0 : ((($dpptemp * 0.10) == $tax_amount) ? $dpptemp : $data_header->AMOUNT_DASAR_PENGHASILAN);
				$total_amount=($data_header->AMOUNT=='')?0:$data_header->AMOUNT;

				//print_r($data_header);die;
				
				/*foreach ($trxline as $jumlah) {
					$total_amount = $jumlah;
					//perhitungan pengenaan pajak
					$jum = $jumlah->AMOUNT;
					$jum_amount = $jum_amount + $jum;

					$tax = $jumlah->TAX_AMOUNT;
					$tax_amount = $tax_amount + $tax;

					$jum_total = $jum_amount + $tax_amount;
					$total_amount = $total_amount+$jum_total+$materai;
					//barcode
					//$idsecret = $this->encrypt->encode($TRX_NUMBER);

					//$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
					//$params['level'] = 'H';
					//$params['size'] = 10;
					//$randomfilename = rand(1000, 9999);
					// $params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
					// $this->ciqrcode->generate($params);
					// $barcode_location=APP_ROOT."qr_code/$randomfilename.png";
					// $ttd_location = APP_ROOT."config/images/cr/ttd2.png";
				}*/

				//barcode
				// $idsecret = $this->encrypt->encode($num);
				$idsecret = $num;

				// $params['data'] = ROOT."einvoice/nota/cetak_barang/barang/".$idsecret."/".$check_token;
				// $url_enc = $this->nama_fungsi->enkripsi('cetak','download',array('id'=>$idsecret));
				$enc_trx_number = $this->mx_encryption->encrypt($data_header->TRX_NUMBER);

				$url_enc = 'einvoice/nota/cetak_nota/petikemas/'.$enc_trx_number;
				$params['data'] = ROOT.$url_enc;
				// $params['data'] = ROOT."einvoice/nota/cetak_nota/petikemas/".$idsecret."/".$real_token;
				$params['level'] = 'H';
				$params['size'] = 10;
				$randomfilename = rand(1000, 9999);
				/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
				die();exit();*/
                $params['savename'] = UPLOADFOLDER_."qr_code/".$randomfilename.".jpg";
				//$params['savename'] = APP_ROOT."qr_code/".$randomfilename.".jpg";
                //$params['savename'] = "http://eservicetest.indonesiaport.co.id/qr_code/".$randomfilename.".jpg";
				$this->ciqrcode->generate($params);
                /*echo UPLOADFOLDER_."qr_code/".$randomfilename.".png";
                die();exit();
*/
				//$barcode_location=APP_ROOT."qr_code/".$randomfilename.".png";
				$barcode_location=APP_ROOT."qr_code/".$randomfilename.".jpg";
                $ttd_location = APP_ROOT."config/images/cr/ttd2.png";
                              
                //terbilang
				
		
		if($piutang == '0'){
			$terbilang = '-';
		}elseif($piutang > 0){
			if(substr($piutang, -2,1) == '.'){
				$amount_terbilang = substr($piutang, 0, -2);
			}else if(substr($piutang, -3,1) == '.'){				
				$amount_terbilang = substr($piutang, 0, -3);
			}else{
				$amount_terbilang = $piutang;
			}
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}else{
			$amount_terbilang = $total_amount;
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}
				
					$title = "Report Nota Petikemas";
			break;


			case "RUPARUPA":
				// echo 'invh/pdf/RUPARUPA/'.$id."<br/><br/>";
				$data_header = $this->getdataurl('invh/pdf/RUPARUPA/'.$id);
				//ambil data dari trx_header
				$num       = $data_header->TRX_NUMBER;
				$tgl_nota  = $data_header->TRX_DATE;

				$org_id  = $data_header->ORG_ID;
				$custname  = $data_header->CUSTOMER_NAME;
				// $custname  = $data_header->ATTRIBUTE3;
				$c_number  = $data_header->CUSTOMER_NUMBER;
				// $c_number  = $data_header->ATTRIBUTE2;
				$c_address = $data_header->CUSTOMER_ADDRESS;
				// $c_address = $data_header->ATTRIBUTE4;
				$nomornpwp = $data_header->CUSTOMER_NPWP;
				// $nomornpwp = $data_header->ATTRIBUTE5;
				$kapal 	   = $data_header->VESSEL_NAME;
				$kunjungan = date("d-M-y", strtotime($data_header->PER_KUNJUNGAN_FROM));
				$to_kun    = date("d-M-y", strtotime($data_header->PER_KUNJUNGAN_TO));
				$no_req    = $data_header->BILLER_REQUEST_ID;
				$ex_num    = $data_header->TRX_NUMBER_PREV;
				$unit_loc  = $data_header->INV_UNIT_LOCATION;

				$kdnmkapal = ($data_header->INTERFACE_HEADER_ATTRIBUTE1=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE1; /* 20180928 3ono */																											   
				$tanggalKontrak = ($data_header->INTERFACE_HEADER_ATTRIBUTE2=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE2;
				$tanggalKontrakrupa05 =(substr($tanggalKontrak,0,9));
				$tanggalPersetuuanrupa05 =(substr($tanggalKontrak,11,10));
				$noKegiatan	 	= ($data_header->INTERFACE_HEADER_ATTRIBUTE3=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE3; /* 20180928 3ono */
				$noMeter	 	= ($data_header->INTERFACE_HEADER_ATTRIBUTE4=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE4; /* pada rupa08 noMeter sebagai no SPK */
				$noPersetujuan 	= ($data_header->INTERFACE_HEADER_ATTRIBUTE5=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE5;
				$daya 		   	= ($data_header->INTERFACE_HEADER_ATTRIBUTE6=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE6;
				$luasTanah 		= ($data_header->INTERFACE_HEADER_ATTRIBUTE7=='')?"0":$data_header->INTERFACE_HEADER_ATTRIBUTE7;
				$luasBangunan 	= ($data_header->INTERFACE_HEADER_ATTRIBUTE8=='')?"0":$data_header->INTERFACE_HEADER_ATTRIBUTE8;
				//$periode 		= ($data_header->INTERFACE_HEADER_ATTRIBUTE9=='')?"-":date("d-M-y", strtotime($data_header->INTERFACE_HEADER_ATTRIBUTE9));
				$periode 		= $data_header->INTERFACE_HEADER_ATTRIBUTE9; //=='')?"-":date("d-M-y", strtotime($data_header->INTERFACE_HEADER_ATTRIBUTE9));
				$lokasiKontrak 	= ($data_header->INTERFACE_HEADER_ATTRIBUTE10=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE10;
				$no_kontrak    	= ($data_header->INTERFACE_HEADER_ATTRIBUTE11=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE11; /* pada rupa08 no_kontrak sebagai no Bukti */
				$custNumb    	= ($data_header->INTERFACE_HEADER_ATTRIBUTE12=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE12;
				
				$kdnmkade   	= ($data_header->INTERFACE_HEADER_ATTRIBUTE13=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE13;
				$tglJamMulai   	= ($data_header->INTERFACE_HEADER_ATTRIBUTE14=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE14;
				$tglJamSelesai 	= ($data_header->INTERFACE_HEADER_ATTRIBUTE15=='')?"-":$data_header->INTERFACE_HEADER_ATTRIBUTE15;
				// $custNumbListrik= ($data_header->ATTRIBUTE2=='')?"-":$data_header->ATTRIBUTE2;
				$dagang    = $data_header->JENIS_PERDAGANGAN;
				$current   = $data_header->CURRENCY_CODE;
				$header_context = $data_header->HEADER_SUB_CONTEXT;
				$headerContext = $data_header->HEADER_CONTEXT;
				$entityId = $data_header->INV_ENTITY_ID;
				$amountMaterai = ($data_header->AMOUNT_MATERAI=='')?"0":$data_header->AMOUNT_MATERAI;
				$redaksi = "-";
				if($entityId!=""){
					//$dataPost2 = array("INV_ENTITY_ID"=>$entityId);
					$dataPost2 = array("TRX_NUMBER"=>$num);
					//$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksi',$dataPost2,'POST');
					$redaksi = $this->senddataurl('ematerai/getEmateraiRedaksiHist',$dataPost2,'POST');
					if(count($redaksi)>0){
						//$redaksi = ($redaksi[0]->INV_EMATERAI_REDAKSI=='')?"-":$redaksi[0]->INV_EMATERAI_REDAKSI;
						$redaksi = ($redaksi[0]->INV_REDAKSI=='')?"-":$redaksi[0]->INV_REDAKSI;
					}else{
						$redaksi = "-";
					}
				}
				/*$getmaterai = array("TOTAL_TAGIHAN"=>$data_header->AMOUNT,"ORG_ID"=>$this->session->userdata('unit_id'),"BRANCH_CODE"=>$this->session->userdata('unit_org'),"HEADER_CONTEXT"=>$headerContext);
				$redaksis = $this->senddataurl('GetEmaterai',$getmaterai,'POST');
				$amountMaterai = $redaksis->NILAI_MATERAI;
				$redaksi = $redaksis->INV_EMATERAI_REDAKSI;*/
				
				$administrasi = "0";
				$tanggalKegiatan = ($data_header->CREATION_DATE=='')?"-":$data_header->CREATION_DATE;
				$tanggalKegiatan .= " s.d ".($data_header->LAST_UPDATED_DATE=='')?"-":$data_header->LAST_UPDATED_DATE;
				$e_name 	 = ($data_header->INV_ENTITY_NAME=='')?"-":$data_header->INV_ENTITY_NAME;

				$e_address   = ($data_header->INV_ENTITY_ALAMAT=='')?"-":$data_header->INV_ENTITY_ALAMAT;
				$e_npwp      = ($data_header->INV_ENTITY_NPWP=='')?"-":$data_header->INV_ENTITY_NPWP;
				$e_faktur 	 = $data_header->INV_ENTITY_FAKTUR;
				if($e_faktur==""){
					$e_faktur="-";
				}
				$e_logo		 = $data_header->INV_ENTITY_LOGO;
				$pejabat 		= $data_header->INV_PEJABAT_NAME;
				$nip_pejabat 	= $data_header->INV_PEJABAT_NIPP;
				$ttd_pejabat 	= $data_header->INV_PEJABAT_TTD;
				//tambahan
				$status_bayar 	= $data_header->STATUS;
				$status_lunas 	= $data_header->STATUS_LUNAS;
				$STATUS_KOREKSI 	= $data_header->STATUS_KOREKSI;
				$faktor_note = $data_header->INV_FAKTUR_NOTE;
				$jabatan_pejabat =  $data_header->INV_PEJABAT_JABATAN;
				$piutang =  ($data_header->PIUTANG=='')?0:$data_header->PIUTANG;
				$sharing =  '0';
				$pbb =  '0';
				// echo json_encode($data_header);
				/*print_r($data_header);*/
				// die();
				if($e_logo==""){
					$e_logo = "default.png";
				}
				if($ttd_pejabat==""){
					$ttd_pejabat = "ttd_default.jpg";
				}

				$jenisNota = "";
				$notaJenis = $this->getdataurl('mstnota/getData/'.$data_header->HEADER_SUB_CONTEXT);
				if(count($notaJenis)>0){/*ADD BY ROZAK ITSD 12082019*/
                    if($data_header->ATTRIBUTE7 == 'NON TANAH'){
                        $jenisNota = "NON TANAH DAN BANGUNAN";
                    }else{
                        $jenisNota = $notaJenis[0]->INV_NOTA_JENIS;
                    }
                    /*END ADD*/
				}else{
					$jenisNota = "-";
				}
				/*print_r($data_header);
				echo "<br/><br/>";
				echo $jenisNota;
				echo "<br/><br/>";
				print_r($notaJenis);
				die();*/

				// $data_wilayah = $this->getdataurl('wilayah/1');
				$unit_wilayah 	= $data_header->INV_UNIT_NAME;
				$alamat_wilayah = $data_header->INV_UNIT_ALAMAT;
				// print_r($data_header);die();
                $header_nota = array('faktor_note' => $faktor_note,
                        'status_lunas' => $status_lunas,
                        'STATUS_KOREKSI' => $STATUS_KOREKSI,
                        'e_logo' => $e_logo,
                        'e_name' => $e_name,
                        'num' => $num,
                        'e_address' => $e_address,
                        'tgl_nota' => $tgl_nota,
                        'e_npwp' => $e_npwp,
                        'ex_num' => $ex_num,
                        'e_faktur' => $faktor_note, );
                $judul_nota = array('jenisNota' => $jenisNota);
				// echo 'invl/'.$id2."<br/><br/><br/>";
				$trxline = $this->getdataurl('invl/'.$id2);
				// print_r($trxline);die();
				$jum_amount=($data_header->AMOUNT_DASAR_PENGHASILAN=='')?0:$data_header->AMOUNT_DASAR_PENGHASILAN;
				$tax_amount=($data_header->PPN_10PERSEN=='')?0:$data_header->PPN_10PERSEN; //buat PPn potongan 10 persen
				$total_amount=($data_header->AMOUNT=='')?0:$data_header->AMOUNT;
				$materai = ($data_header->AMOUNT_MATERAI=='')?0:$data_header->AMOUNT_MATERAI;
				$materai  = $amountMaterai;
				$ppn_dikenakan	= ($data_header->PPN_DIPUNGUT_SENDIRI=='')?0:$data_header->PPN_DIPUNGUT_SENDIRI;
				$ppn_dibebaskan = ($data_header->PPN_DIBEBASKAN=='')?0:$data_header->PPN_DIBEBASKAN;
				/*foreach ($trxline as $jumlah) {
					$total_amount = $jumlah;
					//perhitungan pengenaan pajak
					$jum = $jumlah->AMOUNT;
					$jum_amount = $jum_amount + $jum;

					$tax = $jumlah->TAX_AMOUNT;
					$tax_amount = $tax_amount + $tax;

					$jum_total = $jum_amount + $tax_amount;
					$total_amount = $total_amount+$jum_total;
				}
				$total_amount += $materai + $piutang + $sharing + $pbb;*/

				//barcode
				$idsecret = $num;
				$enc_trx_number = $this->mx_encryption->encrypt($data_header->TRX_NUMBER);

				$url_enc = 'einvoice/nota/cetak_nota/RUPARUPA/'.$enc_trx_number;

				// $url_enc = $this->nama_fungsi->enkripsi('cetak','download',array('id'=>$idsecret));
				$params['data'] = ROOT.$url_enc;
				// $params['data'] = ROOT."einvoice/nota/cetak_nota/RUPARUPA/".$idsecret."/".$real_token;
				$params['level'] = 'H';
				$params['size'] = 10;
				$randomfilename = rand(1000, 9999);
				$params['savename'] = UPLOADFOLDER_."qr_code/".$randomfilename.".png";
				$this->ciqrcode->generate($params);
				$barcode_location=APP_ROOT."qr_code/".$randomfilename.".png";
				$ttd_location = APP_ROOT."config/images/cr/ttd2.png";

				//terbilang
				$huruf = $this->getdataurl('others/terbilang/'.$total_amount);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang.'Rupiah';
				}
				$title = "Report Nota Ruparupa";
			break;
		}
		$dataCustomer = $this->senddataurl('MstCustomer/',$id2,'POST');
		// if ($c_number == '') {
		// 	if (count($dataCustomer) > 0) {
		// 		$c_number = $dataCustomer[0]->INV_CUSTOMER_NOMER;
		// 	}
		// }
		// $spesial_customer = $this->cust_model->cek_special_cus($c_number);
		if($custname==""){
			// if($c_number!=""){
				if(count($dataCustomer)>0){
					$custname 	= $dataCustomer[0]->INV_CUSTOMER_NAMA;
					// $c_address 	= $dataCustomer[0]->INV_CUSTOMER_ALAMAT;
					// $nomornpwp 	= $dataCustomer[0]->INV_CUSTOMER_NPWP;
				}
			// }
		} if($c_address==""){
			if(count($dataCustomer)>0){
				$c_address 	= $dataCustomer[0]->INV_CUSTOMER_ALAMAT;
			}
		} if($nomornpwp==""){
			if(count($dataCustomer)>0){
				$nomornpwp 	= $dataCustomer[0]->INV_CUSTOMER_NPWP;
			}
		}
		
		$get_redaksi_x= $this->get_nota_redaksi($num,$jenisNota);

			$paramStatus['BILLER_REQUEST_ID'] = $no_req;
			$resultS = $this->senddataurl('InvoiceHeader/statusCetak/',$paramStatus,'POST');

			$postlognota = array(
								"TRX_NUMBER"=>$num,
								"ACTIVITY"=>"CETAK",
								"USER_ID"=>$this->session->userdata('user_id'),
							);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');

		//$query = $this->M_report->cetak_pdf();
		//$pdf->Cell(0,30, $judul, 0, 2, 'C', 0,FALSE);
		// <td width="120"></td><td COLSPAN="12" align="left"><font size="12"><b>$corporate_name | $terminal_name</b></font></td> //contoh pdf ambil paramater
		//<td width="120"></td><td COLSPAN="12" align="left"><b>NPWP : $corporate_npwp</b></td> //contoh pdf ambil paramater
		//$pdf->setfont(Ã¢â‚¬ËœcourierÃ¢â‚¬â„¢l
		// echo APP_ROOT.'uploads/entity/'.$e_logo;

		/*template settingan pdf*/
		 define('noNotaFooter', $num);

		// $headerDt = format_nota($header_nota, $special_number); /** untuk aktifkan special customer */
		$headerDt = format_nota($header_nota);
		// echo("===>".$headerDt);die();
		$pdf = $headerDt[0];
		$style = $headerDt[1];
		// print_r($style);die();
		// $pdf = format_nota($header_nota);

		/*template header pdf*/
		$header = header_nota($header_nota);
		$judul = judul_nota($judul_nota);
        switch ($layanan) {
            case 'petikemas':
				$lampiranKiri = '<tr>
				                    <td COLSPAN="2" align="left" width="80px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$c_number.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >'.$c_address.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$nomornpwp.'</td>
				                </tr>';
				if ($header_context =='PTKM00'||$header_context == 'PTKM01' || $header_context =='PTKM06' || $header_context =='PTKM11' || $header_context =='PTKM13')
				{
					$lampiranKanan = "";
					if (!empty($kapal)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Nama Kapal / Voyage</td>
				                    <td COLSPAN="1" width="10px" align="left">:</td>
			                   		<td COLSPAN="2" align="left" width="400px">'.$kapal.' / '.$voyinout.'</td>
			                	</tr>';
				    }
					if (!empty($kunjungan)) {
						if($kunjungan != '' && $to_kun == '')
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$kunjungan.'</td>
			                	</tr>';							
						}else if($kunjungan == '' && $to_kun != '')
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$to_kun.'</td>
			                	</tr>';								
						}else
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$kunjungan." s/d ".$to_kun.'</td>
			                	</tr>';								
						}
				    }
					else if (empty($kunjungan)) {
						if(!empty($no_uper))
						{
							$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left">Periode Kunjungan</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$no_uper." s/d ".$no_uper.'</td>
									</tr>';
						}else{
							$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left">Periode Kunjungan</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">-</td>
									</tr>';							
						}
				    }					
					if (!empty($no_req)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">No. Request</td>
				                    <td COLSPAN="1" align="left">:</td>
			                        <td COLSPAN="2" align="left">'.$no_req.'</td>
			                	</tr>';
				    }
				    if (!empty($tgl_request)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Tgl. Request</td>
				                    <td COLSPAN="1" align="left">:</td>
			                        <td COLSPAN="2" align="left">'.$tgl_request.'</td>
			                	</tr>';
				    }
					if (!empty($dagang)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Jenis Perdagangan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">'.$dagang.'</td>
			                	</tr>';
				    }
				    if (!empty($NmShipper)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Shipper</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">'.$NmShipper.'</td>
			                	</tr>';
				    }
					$lampiran = '<table>
			        			<tr>
				                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
			                	</tr>
			                	<tr>
				                	<td COLSPAN="5" width="350px">
					                    <table>
						                	'.$lampiranKiri.'
							             </table>
					        		</td>
				                    <td COLSPAN="5">
					                    <table>
					                    '.$lampiranKanan.'
					                    </table>
				                    </td>
				                  </tr>
			        			</table>';

				}
				else if ($header_context == 'PTKM02')
				{
			        if (!empty($kapal)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Nama Kapal / VOYAGE</td>
				                    <td COLSPAN="1"  width="10px" align="left">:</td>
			                   		<td COLSPAN="2" align="left" width="400px">'.$kapal.' / '.$voyinout.'</td>
			                	</tr>';
				    }
					if (!empty($kunjungan)) {
						if($kunjungan != '' && $to_kun == '')
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$kunjungan.'</td>
			                	</tr>';							
						}else if($kunjungan == '' && $to_kun != '')
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$to_kun.'</td>
			                	</tr>';								
						}else
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$kunjungan." s/d ".$to_kun.'</td>
			                	</tr>';								
						}
				    }
					else if (empty($kunjungan)) {
						if(!empty($no_uper))
						{
							$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left">Periode Kunjungan</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$no_uper." s/d ".$no_uper.'</td>
									</tr>';
						}else{
							$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left">Periode Kunjungan</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">-</td>
									</tr>';							
						}
				    }
				     if (!empty($tgl_request)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Tgl. Request</td>
				                    <td COLSPAN="1" align="left">:</td>
			                        <td COLSPAN="2" align="left">'.$tgl_request.'</td>
			                	</tr>';
				    }
				    $lampiranKanann .= '<tr>
					    				<td COLSPAN="2" align="left">Nomor DO/BL</td>
					                    <td COLSPAN="1" align="left">:</td>
				                        <td COLSPAN="2" align="left">-</td>
				                	</tr>';
					if (!empty($dagang)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Jenis Perdagangan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">'.$dagang.'</td>
			                	</tr>';
				    }
				    if (!empty($NmShipper)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Shipper </td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">'.$NmShipper.'</td>
			                	</tr>';
				    }

			        $lampiran = '<table>
			        			<tr>
				                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
			                	</tr>
			                	<tr>
				                	<td COLSPAN="5" width="350px">
					                    <table>
						                	'.$lampiranKiri.'
							             </table>
					        		</td>
				                    <td COLSPAN="5">
					                    <table>
					                    '.$lampiranKanan.'
					                    </table>
				                    </td>
				                    </tr>
			        			</table>';

				}
				else if ($header_context == 'PTKM05' || $header_context == 'PTKM07' || $header_context == 'PTKM08')
				{
			        if (!empty($kapal)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Nama Kapal / VOYAGE</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                   		<td COLSPAN="2" align="left" width="400px">'.$kapal.' / '.$voyinout.'</td>
			                	</tr>';
				    }
					if (!empty($kunjungan)) {
						if($kunjungan != '' && $to_kun == '')
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$kunjungan.'</td>
			                	</tr>';							
						}else if($kunjungan == '' && $to_kun != '')
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$to_kun.'</td>
			                	</tr>';								
						}else
						{
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left">:</td>
			                  		<td COLSPAN="2" align="left">'.$kunjungan." s/d ".$to_kun.'</td>
			                	</tr>';								
						}
				    }
					else if (empty($kunjungan)) {
						if(!empty($no_uper))
						{
							$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left">Periode Kunjungan</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$no_uper." s/d ".$no_uper.'</td>
									</tr>';
						}else{
							$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left">Periode Kunjungan</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">-</td>
									</tr>';							
						}
				    }
					if (!empty($no_req)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">No. Request</td>
				                    <td COLSPAN="1" align="left">:</td>
			                        <td COLSPAN="2" align="left">'.$no_req.'</td>
			                	</tr>';
				    }
				     if (!empty($tgl_request)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Tgl. Request</td>
				                    <td COLSPAN="1" align="left">:</td>
			                        <td COLSPAN="2" align="left">'.$tgl_request.'</td>
			                	</tr>';
				    }
				     if (!empty($NmShipper)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Shipper </td>
				                    <td COLSPAN="1" align="left">:</td>
			                   		<td COLSPAN="2" align="left">'.$NmShipper.'</td>
			                	</tr>';
				    }
                   	 if (!empty($dagang)) {
					   $lampiranKanan .= '<tr>
				    <td COLSPAN="2" align="left">Jenis Perdagangan</td>
		                    <td COLSPAN="1" align="left">:</td>
	                   		<td COLSPAN="2" align="left">'.$dagang.'</td>
			                	</tr>';
                   		}
			        $lampiran = '<table>
			        			<tr>
				                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
			                	</tr>
			                	<tr>
				                	<td COLSPAN="5" width="350px">
					                    <table>
						                	'.$lampiranKiri.'
							             </table>
					        		</td>
				                    <td COLSPAN="5">
					                    <table>
					                    '.$lampiranKanan.'
					                    </table>
				                    </td>
				                   </tr>
			        			</table>';

				}
				break;
			case "RUPARUPA":
				if ($header_context =='RUPA04')
				{
					$lampiran = '<table>
	        			<tr>
		                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
	                	</tr>
	                	<tr>
		                    <td COLSPAN="2" align="left" width="50px">Nama</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
		                    <td COLSPAN="2" align="left" width="320px">'.$custname.'</td>
		                    <td COLSPAN="2" align="left" width="120px">No Account</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="320px">'.$custNumb.'</td>
	                	</tr>
	                	<tr>
		                    <td COLSPAN="2" align="left">Nomor</td>
							<td COLSPAN="1" align="left">:</td>
		            		<td COLSPAN="2" align="left">'.$c_number.'</td>';
		            if(!empty($noMeter)){
		            $lampiran .='<td COLSPAN="2" align="left">No Meter</td>
		                    <td COLSPAN="1" align="left">:</td>
	                   		<td COLSPAN="2" align="left">'.$noMeter.'</td>';
	                   	}
	                $lampiran .='</tr>

	                	<tr>
		                    <td COLSPAN="2" align="left" >Alamat</td>
							<td COLSPAN="1" align="left" >:</td>
		                    <td COLSPAN="2" align="left" >'.$c_address.'</td>';
		             if(!empty($custNumb)){
		             $lampiran .= '<td COLSPAN="2" align="left">ID Pelanggan</td>
		                    <td COLSPAN="1" align="left">:</td>
	                        <td COLSPAN="2" align="left">'.$custNumb.'</td>';
	                 }
	                $lampiran .= '</tr>

	                	<tr>
		                    <td COLSPAN="2" align="left">NPWP</td>
							<td COLSPAN="1" align="left">:</td>
		                    <td COLSPAN="2" align="left">'.$nomornpwp.'</td>';
		             if(!empty($daya)){
		            $lampiran .='<td COLSPAN="2" align="left">Daya</td>
		                    <td COLSPAN="1" align="left">:</td>
	                   		<td COLSPAN="2" align="left">'.$daya.'</td>';
	                   }
	                $lampiran .=' </tr>
	                	<tr>
		                    <td COLSPAN="2" align="left">&nbsp;</td>
							<td COLSPAN="1" align="left">&nbsp;</td>
		                    <td COLSPAN="2" align="left">&nbsp;</td>
		                    <td COLSPAN="2" align="left">Rekening Bulan</td>
		                    <td COLSPAN="1" align="left">:</td>
	                   		<td COLSPAN="2" align="left">'.$periode.'</td>
	                	</tr>
	        			</table>';

				}else if ($header_context =='RUPA05')
				{
						$lampiranKiri = '<tr>
				                    <td COLSPAN="2" align="left" width="80px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$c_number.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >'.$c_address.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$nomornpwp.'</td>
				                </tr>';

					$lampiranKanan = "";
				    if (!empty($noPersetujuan)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="120px">No Persetujuan</td>
			                    <td COLSPAN="1" align="left"  width="10px">:</td>
		                   		<td COLSPAN="2" align="left"  width="320px">'.$noPersetujuan.'</td>
			                	</tr>';
				    } 
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="120px">Tanggal Persetujuan</td>
			                    <td COLSPAN="1" align="left"  width="10px">:</td>
		                   		<td COLSPAN="2" align="left"  width="320px">'.$tanggalPersetuuanrupa05.'</td>
			                	</tr>';
				    if (!empty($no_kontrak)) {
					    $lampiranKanan .= '<tr>
				               	<td COLSPAN="2" align="left">No. Kontrak</td>
			                    <td COLSPAN="1" align="left">:</td>
		                        <td COLSPAN="2" align="left">'.$no_kontrak.'</td>
			                	</tr>';
				    } 
				    if (!empty($tanggalKontrak)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="120px">Tanggal Kontrak</td>
			                    <td COLSPAN="1" align="left"  width="10px">:</td>
		                   		<td COLSPAN="2" align="left"  width="320px">'.$tanggalKontrakrupa05.'</td>
			                	</tr>';
				    } 
				    if (!empty($lokasiKontrak)) {
					    $lampiranKanan .= '<tr>
				               	<td COLSPAN="2" align="left">Lokasi</td>
			                    <td COLSPAN="1" align="left">:</td>
		                        <td COLSPAN="2" align="left">'.$lokasiKontrak.'</td>
			                	</tr>';
				    } 
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="120px">Luas Tanah</td>
			                    <td COLSPAN="1" align="left"  width="10px">:</td>
		                   		<td COLSPAN="2" align="left"  width="320px">'.$luasTanah.' m2</td>
			                	</tr>';

				    if (!empty($luasBangunan)) {
					    $lampiranKanan .= '<tr>
				               	<td COLSPAN="2" align="left">Luas Bangunan</td>
			                    <td COLSPAN="1" align="left">:</td>
		                        <td COLSPAN="2" align="left">'.$luasBangunan.'</td>
			                	</tr>';
				    } 
				    if (!empty($periode)) {
					    $lampiranKanan .= '<tr>
				               	<td COLSPAN="2" align="left">Periode</td>
			                    <td COLSPAN="1" align="left">:</td>
		                   		<td COLSPAN="2" align="left">'.str_replace("S/D","s/d",$periode).'</td>
			                	</tr>';
				    } 
					$lampiran = '<table>
			        			<tr>
				                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
			                	</tr>
			                	<tr>
				                	<td COLSPAN="5" width="350px">
					                    <table>
						                	'.$lampiranKiri.'
							             </table>
					        		</td>
				                    <td COLSPAN="5">
					                    <table>
					                    '.$lampiranKanan.'
					                    </table>
				                    </td>
				                  </tr>
			        			</table>';

				} else if ($header_context == 'RUPA08') /* 20180927 3ono, ruparupa LIMBAH */
				{
					$lampiranKiri = '<tr>
										<td COLSPAN="2" align="left" width="80px">Nama</td>
										<td COLSPAN="1" align="left" width="10px">:</td>
										<td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left">Nomor</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$c_number.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left" >Alamat</td>
										<td COLSPAN="1" align="left" >:</td>
										<td COLSPAN="2" align="left" >'.$c_address.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left">NPWP</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$nomornpwp.'</td>
									</tr>';
									
					$lampiranKanan = "";
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">No. Kegiatan</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$noKegiatan.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">No. Permohonan</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$noPersetujuan.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">No. SPK</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$noMeter.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">No. Bukti</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$no_kontrak.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">Kode / Nama Kapal</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$kdnmkapal.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">Kode / Nama Kade</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$kdnmkade.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">Tgl Jam Mulai</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$tglJamMulai.'</td>
									   </tr>';
					$lampiranKanan .= '<tr>
										<td COLSPAN="2" align="left" width="120px">Tgl Jam Selesai</td>
										<td COLSPAN="1" align="left"  width="10px">:</td>
										<td COLSPAN="2" align="left"  width="320px">'.$tglJamSelesai.'</td>
									   </tr>';
								
					$lampiran = '<table>
								<tr>
									<td COLSPAN="3"><b>Penerima Jasa</b></td>
								</tr>
								<tr>
									<td COLSPAN="5" width="350px">
										<table>
											'.$lampiranKiri.'
										 </table>
									</td>
									<td COLSPAN="5">
										<table>
										'.$lampiranKanan.'
										</table>
									</td>
								  </tr>
								</table>';
				
				}else if ($header_context =='RUPA09')
				{
						$lampiranKiri = '<tr>
				                    <td COLSPAN="2" align="left" width="80px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$c_number.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >'.$c_address.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$nomornpwp.'</td>
				                </tr>';

					$lampiranKanan = "";
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="120px">Jasa</td>
			                    <td COLSPAN="1" align="left"  width="10px">:</td>
		                   		<td COLSPAN="2" align="left"  width="320px">'.$noMeter.'</td>
			                	</tr>';
				    
				    if (!empty($periode)) {
					    $lampiranKanan .= '<tr>
				               	<td COLSPAN="2" align="left">Periode</td>
			                    <td COLSPAN="1" align="left">:</td>
		                   		<td COLSPAN="2" align="left">'.str_replace("S/D","s/d",$periode).'</td>
			                	</tr>';
				    } 
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="120px">No. Rekening</td>
			                    <td COLSPAN="1" align="left"  width="10px">:</td>
		                   		<td COLSPAN="2" align="left"  width="320px">'.$tanggalKontrak.'</td>
			                	</tr>';					
					$lampiran = '<table>
			        			<tr>
				                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
			                	</tr>
			                	<tr>
				                	<td COLSPAN="5" width="350px">
					                    <table>
						                	'.$lampiranKiri.'
							             </table>
					        		</td>
				                    <td COLSPAN="5">
					                    <table>
					                    '.$lampiranKanan.'
					                    </table>
				                    </td>
				                  </tr>
			        			</table>';

				}else if ($header_context =='RUPA14')
				{				$lampiranKiri = '<tr>
				                    <td COLSPAN="2" align="left" width="80px">Nama</td>
									<td COLSPAN="1" align="left" width="10px">:</td>
				                    <td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
				                </tr>
				                <tr>
				                    <td COLSPAN="2" align="left">Nomor</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$c_number.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left" >Alamat</td>
									<td COLSPAN="1" align="left" >:</td>
				                    <td COLSPAN="2" align="left" >'.$c_address.'</td>
				                </tr>
			                	<tr>
				                    <td COLSPAN="2" align="left">NPWP</td>
									<td COLSPAN="1" align="left">:</td>
				                    <td COLSPAN="2" align="left">'.$nomornpwp.'</td>
				                </tr>';

					$lampiranKanan = "";
				    if (!empty($periode) && count($periode)>1) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left" width="145px">Periode Kunjungan</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                  		<td COLSPAN="2" align="left"  width="320px">'.str_replace("S/D","s/d",$periode).'</td>
			                	</tr>';
				    } 
				    if (!empty($data_header->INTERFACE_HEADER_ATTRIBUTE1)) {
					   $lampiranKanan .= '<tr>
				    <td COLSPAN="2" align="left" width="145px">Nomor | BPR/BL/DO</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE11.'</td>
			                	</tr>';
                   		}
                   	 if (!empty($data_header->INTERFACE_HEADER_ATTRIBUTE1)) {
					   $lampiranKanan .= '<tr>
				    <td COLSPAN="2" align="left" width="145px">Nama Kapal/VOY/Tanggal</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td>
			                	</tr>';
                   		}
                   	 if (!empty($data_header->INTERFACE_HEADER_ATTRIBUTE2)) {
					   $lampiranKanan .= '<tr>
				    <td COLSPAN="2" align="left" width="145px">Jenis Perdagangan</td>
		                    <td COLSPAN="1" align="left"  width="10px">:</td>
	                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE2.'</td>
			                	</tr>';
                   		}
					$lampiran = '<table>
			        			<tr>
				                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
			                	</tr>
			                	<tr>
				                	<td COLSPAN="5" width="350px">
					                    <table>
						                	'.$lampiranKiri.'
							             </table>
					        		</td>
				                    <td COLSPAN="5">
					                    <table>
					                    '.$lampiranKanan.'
					                    </table>
				                    </td>
				                  </tr>
			        			</table>';

				}else if ($header_context =='RUPA06' || $header_context =='RUPA07' || $header_context =='RUPA13'|| $header_context =='RUPA12')
				{
					/*if ($header_context == "RUPA12") {
                   		$header_context = "RUPA15";#DEBUGONLY
					}*/
					$lampiran = '<table>
        			<tr>
	                    <td COLSPAN="3"><b>Penerima Jasa</b></td>
                	</tr>
                	<tr>
	                    <td COLSPAN="2" align="left" width="50px">Nama</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="320px">'.$custname.'</td>';					
	                if ($header_context =='RUPA06' ||  $header_context =='RUPA14' || $header_context =='RUPA07'){
	                	//if(!empty($periode) && count($periode)>1){
						if(!empty($periode)){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">Tanggal Kegiatan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.str_replace("S/D","s/d",$periode).'</td>';
                   		}else if (!empty($kunjungan)) {
							$lampiran .='<td COLSPAN="2" align="left" width="120px">Tanggal Kegiatan</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                  		<td COLSPAN="2" align="left"  width="320px">'.$kunjungan." s/d ".$to_kun.'</td>';	 
						}else{
                   			$lampiran .= '<td COLSPAN="2" align="left" width="120px">&nbsp;</td>
		                    <td COLSPAN="1" align="left"  width="10px">&nbsp;</td>
	                   		<td COLSPAN="2" align="left"  width="320px">&nbsp;</td>';
                   		}
	                }else if($header_context =='RUPA12'){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">&nbsp;</td>
	                    <td COLSPAN="1" align="left"  width="10px">&nbsp;</td>
                   		<td COLSPAN="2" align="left"  width="320px">&nbsp;</td>'; 
	                }else if($header_context =='RUPA13'){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">&nbsp;</td>
	                    <td COLSPAN="1" align="left"  width="10px">&nbsp;</td>
                   		<td COLSPAN="2" align="left"  width="320px">&nbsp;</td>';
	                }else if($header_context =='RUPA15'){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td>';


	                }
	                // echo print_r($data_header);die();
                	$lampiran .= '</tr>
                	<tr>
	                    <td COLSPAN="2" align="left">Nomor</td>
						<td COLSPAN="1" align="left">:</td>
	                    <td COLSPAN="2" align="left">'.$c_number.'</td>';
	                if ($header_context =='RUPA06'){
						$lampiran .=
									'
									<td COLSPAN="2" align="left">Jenis PAS</td>
									<td COLSPAN="1" align="left">:</td>
									<td COLSPAN="2" align="left">'.$tanggalKontrak.'</td>
									';
	                }else if ($header_context =='RUPA07' || $header_context =='RUPA12'||$header_context =='RUPA13'){
                	$lampiran .=
	                	'<td COLSPAN="2" align="left">&nbsp;</td>
	                    <td COLSPAN="1" align="left">&nbsp;</td>
                   		<td COLSPAN="2" align="left">&nbsp;</td>';
	                }
                	$lampiran .=
                	'</tr>
                	<tr>
	                    <td COLSPAN="2" align="left" >Alamat</td>
						<td COLSPAN="1" align="left" >:</td>
	                    <td COLSPAN="2" align="left" >'.$c_address.'</td>';
	                if($header_context =='RUPA15'){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td>';
	                } else {
	               	$lampiran .='
	               		<td COLSPAN="2" align="left">&nbsp;</td>
	                    <td COLSPAN="1" align="left">&nbsp;</td>
                        <td COLSPAN="2" align="left">&nbsp;</td>';
                    }
                	$lampiran .='</tr>
                	<tr>
	                    <td COLSPAN="2" align="left">NPWP</td>
						<td COLSPAN="1" align="left">:</td>
	                    <td COLSPAN="2" align="left">'.$nomornpwp.'</td>';
	                if($header_context =='RUPA15'){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">Nomor PKK</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td>';
	                } else {
	                $lampiran .='<td COLSPAN="2" align="left">&nbsp;</td>
	                    <td COLSPAN="1" align="left">&nbsp;</td>
                   		<td COLSPAN="2" align="left">&nbsp;</td>';
                   	}
                	$lampiran .='</tr>
        			</table>';

        			/*print_r($data_header);
					echo "<br/><br/>";
					echo $jenisNota;
					echo "<br/><br/>";
					print_r($notaJenis);
					die();*/

				}else if ($header_context =='RUPA15')
				{

					$lampiranKanan = "";
					if (!empty($data_header->INTERFACE_HEADER_ATTRIBUTE1)) {
					    $lampiranKanan .= '<tr>
				               		<td COLSPAN="2" align="left">Nama Kapal</td>
				                    <td COLSPAN="1" align="left" width="10px">:</td>
			                   		<td COLSPAN="2" align="left">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td>
			                	</tr>';
				    }

				    if (!empty($data_header->INTERFACE_HEADER_ATTRIBUTE9)) {
					    $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE9.'</td></tr>
				                	';
				    }

				    if (!empty($data_header->INTERFACE_HEADER_ATTRIBUTE1)){
					    $lampiranKanan .= '<tr><td COLSPAN="2" align="left" width="120px">Nomor PKK</td>
	                    	<td COLSPAN="1" align="left"  width="10px">:</td>
                 			<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td></tr>';
				    }
				   
					$lampiran = '<table>
						<tr>
							<td COLSPAN="3"><b>Penerima Jasa</b></td>
						</tr>
						<tr>
							<td COLSPAN="5" width="350px">
								<table>
									<tr>
										<td COLSPAN="2" align="left" width="80px">Nama</td>
										<td COLSPAN="1" align="left" width="10px">:</td>
										<td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left">Nomor</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$c_number.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left" >Alamat</td>
										<td COLSPAN="1" align="left" >:</td>
										<td COLSPAN="2" align="left" >'.$c_address.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left">NPWP</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$nomornpwp.'</td>
									</tr>
								 </table>
							</td>
							<td COLSPAN="5">
								<table>
								'.$lampiranKanan.'
								</table>
							</td>
						 </tr>
					</table>';
	                /*if($header_context =='RUPA15'){
	                	$lampiran .= '<td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.$data_header->INTERFACE_HEADER_ATTRIBUTE1.'</td>';
	                } else {
	               	$lampiran .='
	               		<td COLSPAN="2" align="left">&nbsp;</td>
	                    <td COLSPAN="1" align="left">&nbsp;</td>
                        <td COLSPAN="2" align="left">&nbsp;</td>';
                    }*/
	                // if($header_context =='RUPA15'){
	                // 	$lampiran .= '';
	                // } else {
	                // $lampiran .='<td COLSPAN="2" align="left">&nbsp;</td>
	                //     <td COLSPAN="1" align="left">&nbsp;</td>
                 //   		<td COLSPAN="2" align="left">&nbsp;</td>';
                 //   	}

        			/*print_r($data_header);
					echo "<br/><br/>";
					echo $jenisNota;
					echo "<br/><br/>";
					print_r($notaJenis);
					die();*/	
				}else if ($header_context =='RUPA17' || $header_context =='RUPA16') /* 20180928 3ono, ruparupa BUNKERING */
				{
					$lampiranKiri = '<tr>
										<td COLSPAN="2" align="left" width="80px">Nama</td>
										<td COLSPAN="1" align="left" width="10px">:</td>
										<td COLSPAN="2" align="left" width="220px">'.$custname.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left">Nomor</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$c_number.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left" >Alamat</td>
										<td COLSPAN="1" align="left" >:</td>
										<td COLSPAN="2" align="left" >'.$c_address.'</td>
									</tr>
									<tr>
										<td COLSPAN="2" align="left">NPWP</td>
										<td COLSPAN="1" align="left">:</td>
										<td COLSPAN="2" align="left">'.$nomornpwp.'</td>
									</tr>';
					if($header_context =='RUPA17')
					{
						$lampiranKanan = "";
						$lampiranKanan .= '<tr>
											<td COLSPAN="2" align="left" width="120px">Tanggal Kegiatan</td>
											<td COLSPAN="1" align="left"  width="10px">:</td>
											<td COLSPAN="2" align="left"  width="320px">'.$periode.'</td>
										   </tr>';
						$lampiranKanan .= '<tr>
											<td COLSPAN="2" align="left" width="120px">Bukti Pendukung</td>
											<td COLSPAN="1" align="left"  width="10px">:</td>
											<td COLSPAN="2" align="left"  width="320px">'.$noPersetujuan.'</td>
										   </tr>';
					}else if($header_context =='RUPA16')
					{
						$lampiranKanan = "";
						$lampiranKanan .= '<tr>
											<td COLSPAN="2" align="left" width="120px">Nama Kapal</td>
											<td COLSPAN="1" align="left"  width="10px">:</td>
											<td COLSPAN="2" align="left"  width="320px">'.$kdnmkapal.'</td>
										   </tr>';	
						$lampiranKanan .= '<tr>
											<td COLSPAN="2" align="left" width="120px">Nomor PKK</td>
											<td COLSPAN="1" align="left"  width="10px">:</td>
											<td COLSPAN="2" align="left"  width="320px">'.$no_kontrak.'</td>
										   </tr>';	
						$lampiranKanan .= '<tr>
											<td COLSPAN="2" align="left" width="120px">Nomor PPKB</td>
											<td COLSPAN="1" align="left"  width="10px">:</td>
											<td COLSPAN="2" align="left"  width="320px">'.$kdnmkade.'</td>
										   </tr>';						
						if(!empty($periode)){
	                	$lampiranKanan .= '<td COLSPAN="2" align="left" width="120px">Tanggal Kegiatan</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="320px">'.str_replace("S/D","s/d",$periode).'</td>';
                   		}else if (!empty($kunjungan)) {
							$lampiranKanan .='<td COLSPAN="2" align="left" width="120px">Tanggal Kegiatan</td>
				                    <td COLSPAN="1" align="left"  width="10px">:</td>
			                  		<td COLSPAN="2" align="left"  width="320px">'.$kunjungan." s/d ".$to_kun.'</td>';	 
						}else{
                   			$lampiranKanan .= '<td COLSPAN="2" align="left" width="120px">&nbsp;</td>
		                    <td COLSPAN="1" align="left"  width="10px">&nbsp;</td>
	                   		<td COLSPAN="2" align="left"  width="320px">&nbsp;</td>';
                   		}										
					}
					
					$lampiran = '<table>
								<tr>
									<td COLSPAN="3"><b>Penerima Jasa</b></td>
								</tr>
								<tr>
									<td COLSPAN="5" width="350px">
										<table>
											'.$lampiranKiri.'
										 </table>
									</td>
									<td COLSPAN="5">
										<table>
										'.$lampiranKanan.'
										</table>
									</td>
								  </tr>
								</table>';
					
				}
			break;
		}
		$lampiran .= '<table><tr><td style="line-height: 14px;">&nbsp;</td></tr></table>';
		// $judul ='<table>
        // 			<tr>
	       //              <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA JASA KEPELABUHAN</b></td>
        //         	</tr>
        // 		</table>';
		switch ($layanan) {
			case 'petikemas':
				$countdetail = json_decode(json_encode($trxline),true);
				//print_r($countdetail);die;
				if ($header_context == 'PTKM00' || $header_context == 'PTKM01' || $header_context =='PTKM07' || $header_context =='PTKM06')
				{
					$tbl = '<table>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="90"><b>Jenis Jasa</b></td>
        				<td align="center" width="70"><b>Tgl Awal</b></td>
        				<td align="center" width="70"><b>Tgl Akhir</b></td>
        				<td align="center" width="30"><b>BOX</b></td>
        				<td align="center" width="40"><b>Size</b></td>
        				<td align="center" width="40"><b>Type</b></td>
        				<td align="center" width="40"><b>STS</b></td>
        				<td align="center" width="30"><b>HZ</b></td>
        				<td align="center" width="30"><b>Hari</b></td>
        				<td align="center" width="75"><b>Tarif</b></td>
        				<td align="center" width="27"></td>
        				<td align="center" width="75"><b>Jumlah</b></td>
        			</tr>
        			</table>';
				}
				else if ($header_context == 'PTKM02')
				{
					$tbl = '<table border>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="90"><b>Jenis Jasa</b></td>
        				<td align="center" width="40"><b>E/I</b></td>
        				<td align="center" width="40"><b>I/O</b></td>
        				<td align="center" width="40"><b>CR</b></td>
        				<td align="center" width="40"><b>SZ</b></td>
        				<td align="center" width="40"><b>TY</b></td>
        				<td align="center" width="40"><b>ST</b></td>
        				<td align="center" width="40"><b>HZ</b></td>
        				<td align="center" width="27"><b>BOX</b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="67"><b>Tarif</b></td>
        				<td align="center" width="50"></td>
        				<td align="center" width="82"><b>Jumlah</b></td>
        			</tr>
        			</table>';
				}
				else
				{
					$tbl = '<table >
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="90"><b>Jenis Jasa</b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="40"><b>Box</b></td>
        				<td align="center" width="40"><b>Size</b></td>
        				<td align="center" width="40"><b>Type</b></td>
        				<td align="center" width="40"><b>STS</b></td>
        				<td align="center" width="40"><b>HZ</b></td>
        				<td align="center" width="40"><b>Hari</b></td>
        				<td align="center" width="50"><b></b></td>
        				<td align="center" width="45"><b>Tarif</b></td>
        				<td align="center" width="27"></td>
        				<td align="center" width="75"><b>Jumlah</b></td>
        			</tr>
        			</table>';
				}
			break;
			case 'RUPARUPA':
				if ($header_context == 'RUPA06')
				{
					$tbl = '<table>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="210"><b>Uraian</b></td>
        				<td align="center" width="120"><b>Volume</b></td>
        				<td align="center" width="160"><b>Tarif</b></td>
        				<td align="center" width="27"></td>
        				<td align="center" width="120"><b>Jumlah</b></td>
        			</tr>
        			</table>';
				}else if($header_context == 'RUPA07')
				{
					$tbl = '<table>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="180"><b>Uraian</b></td>
        				<td align="center" width="100"><b>Volume</b></td>
        				<td align="center" width="100"><b>Hari</b></td>
        				<td align="center" width="100"><b>Tarif</b></td>
        				<td align="center" width="27"></td>
        				<td align="center" width="120"><b>Jumlah</b></td>
        			</tr>
        			</table>';
				}else if($header_context == 'RUPA08') /* 20180927 3ono */
				{
					$tbl = '<table>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
						<td align="center" width="20"></td>
        				<td align="center" width="260"><b>Jenis Jasa</b></td>
        				<td align="center" width="100"><b>Volume (ton)</b></td>
        				<td align="center" width="100"><b>Tarif</b></td>
        				<td align="center" width="57"></td>
        				<td align="center" width="100"><b>Jumlah</b></td>
        			</tr>
        			</table>';
				}else if($header_context == 'RUPA16')
				{
					$tbl = '<table>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
						<td align="center" width="20"></td>
        				<td align="center" width="100"><b>No Bukti</b></td>
        				<td align="center" width="70"><b>Kade</b></td>
        				<td align="center" width="100"><b>Tanggal Mulai</b></td>
        				<td align="center" width="70"><b>Volume</b></td>
        				<td align="center" width="70"><b>Tarif</b></td>
        				<td align="center" width="90"><b>Kurs</b></td>
        				<td align="center" width="40"></td>
        				<td align="center" width="100"><b>Jumlah</b></td>
        			</tr>
        			</table>';
                }else if($header_context == 'RUPA17') /* 20180928 3ono */
				{
					$tbl = '<table>
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
						<td align="center" width="20"></td>
        				<td align="center" width="260"><b>Jenis Jasa</b></td>
        				<td align="center" width="100"><b>Volume (liter)</b></td>
        				<td align="center" width="100"><b>Tarif</b></td>
        				<td align="center" width="57"></td>
        				<td align="center" width="100"><b>Jumlah</b></td>
        			</tr>
        			</table>';
                }
            break;
        }

        switch ($layanan) {
            // case "kapal":

            // 	$this->get_data_kapal($no_invoice,$data_table);
            // 	$tbl .= $data_table;
            // 	$output_name = "LAPORAN PDF NOTA KAPAL";
            // break;
            case 'petikemas':

                if (($trxline->DESCRIPTION == 'ADM' || $trxline->DESCRIPTION == 'MATERAI') && $trxline->LINE_NUMBER == 1) {
                    $no = 0;
                } else {
                    $no = 1;
                }
                //print_r($trxline);die;
				//print_r(count($countdetail));die;
				if($header_context == 'PTKM02')
				{
					$PTKM02lines = array('data' => array(), 'total' => 0);
					foreach ($trxline as $line) {
					/*exclude materai dari cetakan line : Derry Othman 24 Okt 2019*/
					if ($line->DESCRIPTION == 'MATERAI') continue;
						$data_table = $line;
						//print_r($data_table);die;						
                        if ($data_table->DESCRIPTION != 'MATERAI') {
							if ($data_table->DESCRIPTION != 'ADM') {
								$PTKM02lines['data'][] = array(
									'no' => $data_table->LINE_NUMBER,
									'desc' => $data_table->DESCRIPTION,
									'tgl_awal' => $data_table->START_DATE,
									'tgl_akhir' => $data_table->END_DATE,
									'ei' => $data_table->INTERFACE_LINE_ATTRIBUTE2,
									'io' => $data_table->INTERFACE_LINE_ATTRIBUTE3,
									'cr' => $data_table->INTERFACE_LINE_ATTRIBUTE4,
									'box' => $data_table->INTERFACE_LINE_ATTRIBUTE7,
									'att6' => $data_table->INTERFACE_LINE_ATTRIBUTE6,
									'hari' => $data_table->INTERFACE_LINE_ATTRIBUTE9,
									'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE8,
									'jumlah' => $data_table->AMOUNT,
									'curr' => $data_table->INTERFACE_LINE_ATTRIBUTE13,
								);
							}
							
							$tbl .= $data_table;
						}
						
					}		

					if(count($countdetail) <= 46)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
					}
					
					elseif(count($countdetail) > 46 && count($countdetail) <= 101)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$tbl1 .= $data_table1;
					}
					
					elseif(count($countdetail) > 101 && count($countdetail) <= 156)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$this->get_data_petikemas2_long2($no_invoice, $data_table2, $PTKM02lines);
						$tbl1 .= $data_table1;
						$tbl2 .= $data_table2;
					}
					
					elseif(count($countdetail) > 156 && count($countdetail) <= 211)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$this->get_data_petikemas2_long2($no_invoice, $data_table2, $PTKM02lines);
						$this->get_data_petikemas2_long3($no_invoice, $data_table3, $PTKM02lines);
						$tbl1 .= $data_table1;
						$tbl2 .= $data_table2;
						$tbl3 .= $data_table3;
					}
					
					elseif(count($countdetail) > 211 && count($countdetail) <= 266)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$this->get_data_petikemas2_long2($no_invoice, $data_table2, $PTKM02lines);
						$this->get_data_petikemas2_long3($no_invoice, $data_table3, $PTKM02lines);
						$this->get_data_petikemas2_long4($no_invoice, $data_table4, $PTKM02lines);
						$tbl1 .= $data_table1;
						$tbl2 .= $data_table2;
						$tbl3 .= $data_table3;
						$tbl4 .= $data_table4;
					}
					
					elseif(count($countdetail) > 266 && count($countdetail) <= 321)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$this->get_data_petikemas2_long2($no_invoice, $data_table2, $PTKM02lines);
						$this->get_data_petikemas2_long3($no_invoice, $data_table3, $PTKM02lines);
						$this->get_data_petikemas2_long4($no_invoice, $data_table4, $PTKM02lines);
						$this->get_data_petikemas2_long5($no_invoice, $data_table5, $PTKM02lines);
						$tbl1 .= $data_table1;
						$tbl2 .= $data_table2;
						$tbl3 .= $data_table3;
						$tbl4 .= $data_table4;
						$tbl5 .= $data_table5;
					}
					
					elseif(count($countdetail) > 321 && count($countdetail) <= 376)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$this->get_data_petikemas2_long2($no_invoice, $data_table2, $PTKM02lines);
						$this->get_data_petikemas2_long3($no_invoice, $data_table3, $PTKM02lines);
						$this->get_data_petikemas2_long4($no_invoice, $data_table4, $PTKM02lines);
						$this->get_data_petikemas2_long5($no_invoice, $data_table5, $PTKM02lines);
						$this->get_data_petikemas2_long6($no_invoice, $data_table6, $PTKM02lines);
						$tbl1 .= $data_table1;
						$tbl2 .= $data_table2;
						$tbl3 .= $data_table3;
						$tbl4 .= $data_table4;
						$tbl5 .= $data_table5;
						$tbl6 .= $data_table6;
					}
					
					elseif(count($countdetail) > 376)
					{
						$this->get_data_petikemas2($no_invoice, $data_table, $PTKM02lines);
						$this->get_data_petikemas2_long1($no_invoice, $data_table1, $PTKM02lines);
						$this->get_data_petikemas2_long2($no_invoice, $data_table2, $PTKM02lines);
						$this->get_data_petikemas2_long3($no_invoice, $data_table3, $PTKM02lines);
						$this->get_data_petikemas2_long4($no_invoice, $data_table4, $PTKM02lines);
						$this->get_data_petikemas2_long5($no_invoice, $data_table5, $PTKM02lines);
						$this->get_data_petikemas2_long6($no_invoice, $data_table6, $PTKM02lines);
						$this->get_data_petikemas2_long7($no_invoice, $data_table7, $PTKM02lines);
						$tbl1 .= $data_table1;
						$tbl2 .= $data_table2;
						$tbl3 .= $data_table3;
						$tbl4 .= $data_table4;
						$tbl5 .= $data_table5;
						$tbl6 .= $data_table6;
						$tbl7 .= $data_table7;
					}
					
					$tbl .= $data_table;
					
				}
				else
				{
					foreach ($trxline as $line) {
						/*exclude materai dari cetakan line : Derry Othman 24 Okt 2019*/
						if ($line->DESCRIPTION == 'MATERAI') continue;
						$data_table = $line;

						if ($data_table->DESCRIPTION != 'MATERAI') {
							if ($data_table->DESCRIPTION != 'ADM') {
								if ($header_context == 'PTKM00' || $header_context == 'PTKM01' || $header_context == 'PTKM07' || $header_context == 'PTKM06') {
									//print_r($data_table);die;
									$this->get_data_petikemas($no, $no_invoice, $data_table, $current);
								} else {		//print_r($data_table);die;
									$this->get_data_petikemas3($no, $no_invoice, $data_table, $current);
								}

								$tbl .= $data_table;
								++$no;
							}
						}
					}
				}
				
				//$array = json_decode(json_encode($trxline), True);
				//print_r($array[2]['LINE_NUMBER']);die;
				
				//print_r($tbl1);die;

            break;
            case 'RUPARUPA':
                $rupalines = array('data' => array(), 'total' => 0);
                $dataRUPA14 = '';
                $dataRUPA12 = '';
                $dataRUPA15 = '';
                $dataRUPA09 = '';
                $dataRUPA05 = '';
                $nomor_urut = 0;
                foreach ($trxline as $line) {
					/*exclude materai dari cetakan line : Derry Othman 24 Okt 2019*/
					if ($line->DESCRIPTION == 'MATERAI') continue;
                    ++$nomor_urut;
                    $data_table = $line;
                    if ($header_context == 'RUPA06') {
                        $this->get_data_rupa2($no_invoice, $data_table, $current, $nomor_urut);
                    } elseif ($header_context == 'RUPA07') {
                        // $this->get_data_rupa7($no_invoice,$data_table,$current);
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
                    } elseif ($header_context == 'RUPA08') /* 20180927 3ono */
                    {
                        $rupalines['data'][] = array(
                            'no' => $data_table->LINE_NUMBER,
                            'desc' => $data_table->DESCRIPTION,

                            // $cr 		= $data_table->CURRENCY_CODE;
                            'cr' => 'IDR',
                            'volume' => number_format($data_table->INTERFACE_LINE_ATTRIBUTE2),
                            'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE3,
                            'jumlah' => $data_table->AMOUNT,
                        );
                    } elseif ($header_context == 'RUPA14') {
                        // $this->get_data_rupa14($no_invoice,$data_table,$current);
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
                    } elseif ($header_context == 'RUPA04') {
                        $this->get_data_rupa3($no_invoice, $data_table, $current, $get_redaksi_x);
                    } elseif ($header_context == 'RUPA05') {
                        // echo $data_table->SERVICE_TYPE;
                        if ($data_table->SERVICE_TYPE == 'ADMINISTRASI') {
                            $rupalines['data']['admin'] = $data_table->AMOUNT;
                        } elseif (($data_table->SERVICE_TYPE == 'TANAH' && $data_table->LINE_DOC == 'TANAH BULANAN') || $data_table->SERVICE_TYPE == 'TANAH BULANAN' || $data_table->SERVICE_TYPE == 'SEWA BANGUNAN BULANAN' || $data_table->SERVICE_TYPE == 'SEWA BANGUNAN') {
                            $rupalines['data']['bulan'] += $data_table->AMOUNT;
                        } elseif (($data_table->SERVICE_TYPE == 'TANAH' && $data_table->LINE_DOC == 'TANAH TAHUNAN') || $data_table->SERVICE_TYPE == 'SEWA TANAH TAHUNAN' || $data_table->SERVICE_TYPE == 'TANAH TAHUNAN' || $data_table->SERVICE_TYPE == 'SEWA BANGUNAN TAHUNAN' || $data_table->SERVICE_TYPE == 'SEWA BANGUNAN') {
                            $rupalines['data']['tahun'] += $data_table->AMOUNT;
                        } elseif ($data_table->SERVICE_TYPE == 'AIR') {
                            $rupalines['data']['air'] += $data_table->AMOUNT;
                        } elseif ($data_table->SERVICE_TYPE == 'SAMPAH') {
                            $rupalines['data']['sampah'] += $data_table->AMOUNT;
                        } elseif ($data_table->SERVICE_TYPE == 'PAS') {
                            $rupalines['data']['pas'] += $data_table->AMOUNT;
                        } elseif ($data_table->SERVICE_TYPE == 'PBB') {
                            $pbb += $data_table->AMOUNT;
                        }
                        $rupalines['total'] += $data_table->AMOUNT;
                    } elseif ($header_context == 'RUPA12') {
                        // print_r($data_table);die();
                        $rupalines['data'][] = array(
                                                    'line' => $data_table->LINE_NUMBER,
                                                    'desc' => $data_table->DESCRIPTION,
                                                    'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE3,
                                                    'satuan' => $data_table->INTERFACE_LINE_ATTRIBUTE4,
                                                    'harga' => $data_table->AMOUNT,
                                                    'x' => $data_table->INTERFACE_LINE_ATTRIBUTE2,
                                                );
                    } elseif ($header_context == 'RUPA15') {
                        // print_r($data_table);die();
                        //
                        $rupalines['data'][] = array(
                                                    'line' => $data_table->LINE_NUMBER,
                                                    'desc' => $data_table->DESCRIPTION,
                                                    'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE3,
                                                    'satuan' => $data_table->INTERFACE_LINE_ATTRIBUTE4,
                                                    'harga' => $data_table->AMOUNT,
                                                    'x' => $data_table->INTERFACE_LINE_ATTRIBUTE2,
                                                );
                    } elseif ($header_context == 'RUPA13') {
                        $rupalines['data'][] = array(
                                                    'line' => $data_table->LINE_NUMBER,
                                                    'desc' => $data_table->DESCRIPTION,
                                                    'harga' => $data_table->AMOUNT,
                                                );
                    // $this->get_data_rupa13($no_invoice,$data_table,$current);
                    } elseif ($header_context == 'RUPA16')
                    {
                        $rupalines['data'][] = array(
                            'no' => $data_table->LINE_NUMBER,
                            'kurs' => $data_table->INTERFACE_LINE_ATTRIBUTE12,
                            'bukti' => $data_table->INTERFACE_LINE_ATTRIBUTE13,
							'kade' => $data_table->INTERFACE_LINE_ATTRIBUTE14,
							'start' => date("d-M-y", strtotime($data_table->INTERFACE_LINE_ATTRIBUTE15)),
							'volume' => number_format($data_table->INTERFACE_LINE_ATTRIBUTE4),
                            // $cr 		= $data_table->CURRENCY_CODE;
                            'cr' => 'IDR',
                            'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE5,
                            'jumlah' => $data_table->AMOUNT,
                        );
                    }elseif ($header_context == 'RUPA17') /* 20180928 3ono  */
                    {
                        $rupalines['data'][] = array(
                            'no' => $data_table->LINE_NUMBER,
                            'desc' => $data_table->DESCRIPTION,

                            // $cr 		= $data_table->CURRENCY_CODE;
                            'cr' => 'IDR',
                            'volume' => number_format($data_table->INTERFACE_LINE_ATTRIBUTE2),
                            'tarif' => $data_table->INTERFACE_LINE_ATTRIBUTE3,
                            'jumlah' => $data_table->AMOUNT,
                        );
                    }

                    $tbl .= $data_table;
                    /*$tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;*/
                    /*$tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;*/
                    /*$tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;*/
                    /*$tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;
                    $tbl .= $data_table;*/
                }
                if ($header_context == 'RUPA05') {
                    // echo "lol = ".$header_context;die();
                    $this->get_data_rupa5($no_invoice, $data_table, $rupalines);
                    $dataRUPA05 .= $data_table;
                // $tbl .= $data_table;
                } elseif ($header_context == 'RUPA12') {
                    $this->get_data_rupa12($no_invoice, $data_table, $rupalines, $get_redaksi_x);
                    $dataRUPA12 .= $data_table;
                // $tbl .= $data_table;
                } elseif ($header_context == 'RUPA15') {
                    $this->get_data_rupa15($no_invoice, $data_table, $rupalines, $get_redaksi_x);
                    $dataRUPA15 .= $data_table;
                // $tbl .= $data_table;
                } elseif ($header_context == 'RUPA13') {
                    $this->get_data_rupa13($no_invoice, $data_table, $rupalines);
                    $tbl .= $data_table;
                } elseif ($header_context == 'RUPA07') {
                    $this->get_data_rupa7($no_invoice, $data_table, $rupalines);
                    $tbl .= $data_table;
                } elseif ($header_context == 'RUPA08') {	/* 20180927 3ono */
                    $this->get_data_rupa8($no_invoice, $data_table, $rupalines);
                    $tbl .= $data_table;
                } elseif ($header_context == 'RUPA09') {
                    if ($data_table->SERVICE_TYPE = 'AIR') {
                        $rupalines['data']['amount_air'] = $data_table->AMOUNT;
                    }
                    $this->get_data_rupa9($no_invoice, $data_table, $rupalines);
                    $dataRUPA09 .= $data_table;
                // $tbl .= $data_table;
                } elseif ($header_context == 'RUPA14') {
                    $this->get_data_rupa14($no_invoice, $data_table, $rupalines, $get_redaksi_x);
                    $dataRUPA14 .= $data_table;
                // $tbl .= $data_table;
                } elseif ($header_context == 'RUPA16') { 
                    $this->get_data_rupa16($no_invoice, $data_table, $rupalines);
                    $tbl .= $data_table;
                }elseif ($header_context == 'RUPA17') { /* 20180928 3ono */
                    $this->get_data_rupa17($no_invoice, $data_table, $rupalines);
                    $tbl .= $data_table;
                }
            break;
        }
        if (count($get_redaksi_x) > 0) {
            $redaksis = $get_redaksi_x->INV_REDAKSI_ATAS;
        } else {
            $redaksis = '';
        }

        $footer_nota = array(
                            'headerContext' => $headerContext,
                            'headerSubContext' => $header_context,
                            'terbilang' => $terbilang,
                            'barcode_location' => $barcode_location,
                            'tgl_nota' => $tgl_nota,
                            'jabatan_pejabat' => $jabatan_pejabat,
                            'ttd_pejabat' => $ttd_pejabat,
                            'pejabat' => $pejabat,
                            'nip_pejabat' => $nip_pejabat,
                            'unit_wilayah' => $unit_wilayah,
                            'alamat_wilayah' => $alamat_wilayah,
                            'current' => $current,
                            'get_redaksi_x' => $get_redaksi_x,
                            'unit_loc' => $unit_loc,
                            'data' => array(),
                        );

        switch ($headerContext) {
            case 'PTKM':
                $footer_nota['data'] = array('administrasi' => $administrasi, 'jum_amount' => $jum_amount, 'tax_amount' => $tax_amount, 'materai' => $materai, 'total_amount' => $total_amount, 'no_uper' => $no_uper, 'uang_jaminan' => $uang_jaminan, 'piutang' => $piutang);
            break;
            case 'RUPA':
                if ($header_context == 'RUPA05') {
                    $footer_nota['data'] = array('current' => $current, 'jum_amount' => $jum_amount, 'tax_amount' => $tax_amount, 'materai' => $materai, 'piutang' => $piutang, 'sharing' => $sharing, 'pbb' => $pbb, 'total_amount' => $total_amount);
                } elseif ($header_context == 'RUPA04') {
                    $footer_nota['data'] = array('current' => $current, 'jum_amount' => $jum_amount, 'tax_amount' => $tax_amount, 'materai' => $materai, 'total_amount' => $total_amount);
                } elseif ($header_context == 'RUPA15') {
                    $footer_nota['data'] = array('current' => $current, 'jum_amount' => $jum_amount, 'tax_amount' => $tax_amount, 'materai' => $materai, 'total_amount' => $total_amount, 'ppn_dikenakan' => $ppn_dikenakan, 'ppn_dibebaskan' => $ppn_dibebaskan);
                } elseif ($header_context == 'RUPA09') {
                    $footer_nota['data'] = array('current' => $current, 'jum_amount' => $jum_amount, 'tax_amount' => $tax_amount, 'materai' => $materai, 'total_amount' => $total_amount, 'ppn_dikenakan' => $ppn_dikenakan, 'ppn_dibebaskan' => $ppn_dibebaskan);
                } else {
                    $footer_nota['data'] = array('current' => $current, 'jum_amount' => $jum_amount, 'tax_amount' => $tax_amount, 'materai' => $materai, 'total_amount' => $total_amount);
                }

                if (!empty($dataRUPA05)) {
                    $footer_nota['data']['dataRUPA05'] = $dataRUPA05;
                    $footer_nota['data']['redaksibody'] = $redaksis;
                }
                if (!empty($dataRUPA12)) {
                    $footer_nota['data']['dataRUPA12'] = $dataRUPA12;
                    $footer_nota['data']['redaksibody'] = $redaksis;
                }
                if (!empty($dataRUPA15)) {
                    $footer_nota['data']['dataRUPA15'] = $dataRUPA15;
                    $footer_nota['data']['redaksibody'] = $redaksis;
                }
                if (!empty($dataRUPA09)) {
                    $footer_nota['data']['dataRUPA09'] = $dataRUPA09;
                    $footer_nota['data']['redaksibody'] = $redaksis;
                }
                if (!empty($dataRUPA14)) {
                    $footer_nota['data']['dataRUPA14'] = $dataRUPA14;
                    $footer_nota['data']['redaksibody'] = $redaksis;
                }
            break;
        }

        // echo $headerContext."<br/>";

        $footer = footer_nota($footer_nota, $id);
        // echo $tbl.$footer;die();
        // $ematerai_nota = "";
        $ematerai_nota = array(
                        'amountMaterai' => $amountMaterai,
                        'redaksi' => $redaksi,
                        'status_lunas' => $status_lunas,
                        'unit_wilayah' => $unit_wilayah,
                        'alamat_wilayah' => $alamat_wilayah,
                    );
        $ematerai_nota = ematerai_nota($ematerai_nota);
        /*if($status_lunas=="Y"){

        }*/
        $output_name = $header_context.'_'.$id.'.pdf';
        // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->writeHtml($header, true, false, false, false, '');
        // $pdf->SetFont('courier', '', 8);
        $pdf->writeHtml($judul, true, false, false, false, '');
        $pdf->writeHtml($lampiran, true, false, false, false, '');
        /*
		if($header_context != 'PTKM02' )
		{
			$pdf->writeHtml($tbl, true, false, false, false, '');
		}
		*/
		if($header_context != 'PTKM02' && ($header_context == 'PTKM06' && count($countdetail) <= 11) )
		{
			$pdf->writeHtml($tbl, true, false, false, false, '');
		}
		elseif($header_context == 'PTKM06' && count($countdetail) > 11)
		{
			$pdf->writeHtml($tbl, true, false, false, false, '');
			$pdf->addpage();
			$pdf->writeHtml($header, true, false, false, false, '');
			$pdf->writeHtml($judul, true, false, false, false, '');
		}		
		else
		{
			if(count($countdetail) <= 46)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				
				if(count($countdetail) > 25)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
			}
			elseif(count($countdetail) > 46 && count($countdetail) <= 101)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				
				if(count($countdetail) > 75)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
			}
			elseif(count($countdetail) > 101 && count($countdetail) <= 156)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl2, true, false, false, false, '');
				
				if(count($countdetail) > 135)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
			}
			
			elseif(count($countdetail) > 156 && count($countdetail) <= 211)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl2, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl3, true, false, false, false, '');
				
				if(count($countdetail) > 190)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
			}
			
			elseif(count($countdetail) > 211 && count($countdetail) <= 266)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl2, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl3, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl4, true, false, false, false, '');
				
				if(count($countdetail) > 240)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
				
			}
			
			elseif(count($countdetail) > 266 && count($countdetail) <= 321)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl2, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl3, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl4, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl5, true, false, false, false, '');
				
				if(count($countdetail) > 300)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
				
			}
			
			elseif(count($countdetail) > 321 && count($countdetail) <= 376)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl2, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl3, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl4, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl5, true, false, false, false, '');	
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl6, true, false, false, false, '');	

				if(count($countdetail) > 355)
				{
					$pdf->SetY(800);
					$pdf->writeHtml($header, true, false, false, false, '');
					$pdf->writeHtml($judul, true, false, false, false, '');
				}
				
			}
			
			elseif(count($countdetail) > 376)
			{
				$pdf->writeHtml($tbl, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl1, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl2, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl3, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl4, true, false, false, false, '');
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl5, true, false, false, false, '');	
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl6, true, false, false, false, '');	
				$pdf->SetY(800);
				$pdf->writeHtml($header, true, false, false, false, '');
				$pdf->writeHtml($judul, true, false, false, false, '');
				$pdf->writeHtml($tbl7, true, false, false, false, '');					
			}
		}	
        $pdf->writeHtml($footer, true, false, false, false, '');
        $pdf->SetY(260);
        $pdf->writeHtml($ematerai_nota, true, false, false, false, '');
        // $pdf->writeHtml($jml_footer, true, false, false, false, '');
        // $pdf->writeHtml($tgl_footer, true, false, false, false, '');
        // $pdf->writeHtml($barcoded, true, false, false, false, '');
        // $pdf->writeHtml($ttd_footer, true, false, false, false, '');
        //$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
        // $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
        $pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
        //$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');

        switch ($layanan) {
            case 'petikemas':

            //$postdata4 = array('ID_REQ' => $no_req,'TRX_NUMBER'=>$num);
            $postdata4 = array('TRX_NUMBER'=>$num);
             //print_r($unit_code);die();
            $NoCont = $this->senddataurl('payment/container', $postdata4, 'POST');
            //print_r($NoCont[0]->NO_CONTAINER."--".$NoCont[0]->SZ."--".$NoCont[0]->TY."--".$NoCont[0]->ST."--".$NoCont[0]->HZ);die();

        $judul = '<table><thead nobr="true">
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
                	</tr>';

        $judul .= '</thead></table>';

            $nx = 0;
            $tabsCon = '<table border="0px">
					<thead nobr="true">
        			<tr nobr="true">
        				<td align="center" width="35" height="15"><b>No</b></td>
        				<td align="center" width="100" height="15"><b>No Container</b></td>
        				<td align="center" width="40" height="15"><b>Size</b></td>
        				<td align="center" width="45" height="15"><b>Type</b></td>
        				<td align="center" width="50" height="15"><b>Status</b></td>
        				<td align="center" width="40" height="15"><b>HZ</b></td>
        			</tr>
					</thead>';
                    // print_r($NoCont[0]);die();

            foreach ($NoCont as $line) {
                //echo print_r($line);
                $list_ctr = $line->LIST_CONT;
                list($size, $type, $sts, $hz) = split('-', $list_ctr, 4);
                ++$nx;
                $tabsCon .= '<tbody nobr="true"><tr nobr="true">
								<td align="center" width="35" height="15">'.$nx.'</td>
								<td align="center" width="100" height="15">'.$line->NO_CONTAINER.'</td>
								<td align="center" width="40" height="15">'.$size.'</td>
								<td align="center" width="45" height="15">'.$type.'</td>
								<td align="center" width="50" height="15">'.$sts.'</td>
								<td align="center" width="40" height="15">'.$hz.'</td>
							</tr></tbody>';
                // $data_table2 = $line->NO_CONTAINER;
            }
            $tabsCon .= '</table>';
            $ContainerNo = $tabsCon;
            /*$ContainerNo = '<table>
                                <tr>
                                    <td><b>No. Containers</b></td>
                                </tr>
                                <tr>
                                    <td>
                                            '.$tabsCon.'
                                    </td>
                                  </tr>
                                </table>';*/
            // echo $ContainerNo;die();
            // echo $tabsCon; die();
             if (count($NoCont) > 0) {
                 // $pdf->writeHtml($header, true, false, false, false, '');
                 // $pdf->SetFont('courier', '', 8);
                 
                 // $pdf->SetY(30);
                 // $pdf->writeHtml($tabsCon, true, false, false, false, '');
                 // $pdf->writeHtml($judul, true, false, false, false, '');
				 $pdf->AddPage();
				 $pdf->writeHtml($judul, true, false, false, false);
				 $pdf->resetColumns();
				 $pdf->setEqualColumns(2,84);  // KEY PART -  number of cols and width
				 $pdf->selectColumn();  		 
				 $pdf->writeHTML($tabsCon, true, false, false, false);
				 $pdf->resetColumns();	
             }		 
			 
            // $pdf->writeHtml($ContainerNo, true, false, false, false, '');
        }
		
		ob_end_clean();
		$pdf->Output($output_name, 'I');
	}



	public function cetak_kapal($layanan,$no_invoice=""){
		$this->load->helper('pdf_helper');
		tcpdf();
		//$qs = $this->input->server('QUERY_STRING');
        $id    = $this->uri->segment(5);
        // echo $id; die(); exit();

        //print_r($id);die;
		  //$id2 = $this->encrypt->decode($qs);
		// print_r($qs);die;
		$judul = 'priview cetak kapal';

		switch($layanan){
			case "kapal":
			//$id2=$qs;
			$id2 = $id;

			$data_header = $this->getdataurl('invh/'.$id2);
			// echo "<pre>";
			// print_r($data_header); die(); exit();
			// echo "</pre>";
				//ambil data dari trx_header
			$num       			= $data_header->TRX_NUMBER;
			$tgl_nota  			= $data_header->TRX_DATE;
			$custname  			= $data_header->CUSTOMER_NAME;
			$c_number  			= $data_header->CUSTOMER_NUMBER;
			$c_address 			= $data_header->CUSTOMER_ADDRESS; //print_r($c_address);die;
			$nomornpwp 			= $data_header->CUSTOMER_NPWP;
			$kapal 	  			= $data_header->VESSEL_NAME;
			$kunjungan 			= $data_header->PER_KUNJUNGAN_FROM;
			$to_kun    			= $data_header->PER_KUNJUNGAN_TO;
			$ppkb 	   			= $data_header->INTERFACE_HEADER_ATTRIBUTE1;
			$bukti	   			= $data_header->INTERFACE_HEADER_ATTRIBUTE6;
			$no_req    			=
			$dagang    			= $data_header->JENIS_PERDAGANGAN;
			$current   			= $data_header->CURRENCY_CODE;
			$ppn_sendiri		= $data_header->PPN_DIPUNGUT_SENDIRI;
			$ppn_pemungut		= $data_header->PPN_DIPUNGUT_PEMUNGUT;
			$ppn_tdk_dipungut	= $data_header->PPN_TIDAK_DIPUNGUT;
			$ppn_dibebaskan		= $data_header->PPN_DIBEBASKAN;
			$u_jaminan			= $data_header->UANG_JAMINAN;
			$u_piutang			= $data_header->PIUTANG;
			$a_terbilang		= $data_header->AMOUNT_TERBILANG;

			//$entitas = $this->getdataurl('entity/'.$id2);
			$entitas = $this->getdataurl('entity/72');
			//print_r($entitas);die;
			//foreach ($entitas as $e_data) {
				//$data_entity = $e_data;
				//$e_name 	 = $data_entity->INV_ENTITY_NAME;
				$e_name 	 = $entitas->INV_ENTITY_NAME;
				$e_address   = $entitas->INV_ENTITY_ALAMAT;
				$e_npwp      = $entitas->INV_ENTITY_NPWP;
				$e_faktur 	 = $entitas->INV_ENTITY_FAKTUR;
				//print_r($e_faktur);die;

			//}

			//ambil dari db_invoice
			$data_pejabat = $this->getdataurl('pejabat/1');
				$pejabat 		= $data_pejabat->INV_PEJABAT_NAME;
				$nip_pejabat 	= $data_pejabat->INV_PEJABAT_NIPP;
				//echo '----'.$data_pejabat; die(); exit();

			$data_wilayah = $this->getdataurl('wilayah/1');
				$unit_wilayah 	= $data_wilayah->INV_WILAYAH_NAME;
				$alamat_wilayah = $data_wilayah->INV_WILAYAH_ALAMAT;


			// print_r($id2);die;
			$trxline = $this->getdataurl('invl/'.$id2);
			// print_r($trxline);die;
			$jum_amount=0;
			$tax_amount=0;
			$total_amount=0;
			foreach ($trxline as $jumlah) {
				$total_amount = $jumlah;
				//perhitungan pengenaan pajak
				$jum = $jumlah->AMOUNT;
				$jum_amount = $jum_amount + $jum;

				$tax = $jumlah->TAX_AMOUNT;
				$tax_amount = $tax_amount + $tax;

				$jum_total = $jum_amount + $tax_amount;
				$total_amount = $total_amount+$jum_total;

				//barcode
				//$idsecret = $this->encrypt->encode($TRX_NUMBER);

				//$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
				$params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
				$this->ciqrcode->generate($params);
				$barcode_location=APP_ROOT."qr_code/$randomfilename.png";
				$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
			}

			//echo 'aaaaa'.$total_amount; die(); exit();

			//terbilang
			if($u_piutang == '0'){
			
					$terbilang = '-';
		}elseif($u_piutang > 0){
			if(substr($u_piutang, -2,1) == '.'){
				$amount_terbilang = substr($u_piutang, 0, -2);
			}else if(substr($u_piutang, -3,1) == '.'){				
				$amount_terbilang = substr($u_piutang, 0, -3);
			}else{
				$amount_terbilang = $u_piutang;
			}
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}else{
			$amount_terbilang = $total_amount;
			$amount_terbilang = str_replace(',00','',$amount_terbilang);
			$amount_terbilang = preg_replace('/\./', '', $amount_terbilang); 
			$amount_terbilang = str_replace('-','',$amount_terbilang);
			$huruf = $this->getdataurl('others/terbilang/' . $amount_terbilang);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang .'Rupiah';
				}
		}
			// ---tutup data -----------
				$title ="Report Nota Kapal";
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
	    $pdf->SetFont('courier', '', 8);
		$pdf->AddPage();
		$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
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
                    <td width="70"></td><td COLSPAN="12" align="left">NP: '.$e_npwp.'</td>
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
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA PENJUALAN JASA KEPELABUHAN</b></td>
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
                   		<td COLSPAN="2" align="left"  width="170px">'.$kunjungan.'/'.$to_kun.'</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="50px">Alamat</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$c_address.'</td>

	               		<td COLSPAN="2" align="left" width="120px">Nomor PPKB</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                        <td COLSPAN="2" align="left"  width="170px">'.$ppkb.'</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="50px">NPWP</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$nomornpwp.'</td>

	                    <td COLSPAN="2" align="left" width="120px">Bukti Pendukung</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px">'.$bukti.'</td>
                	</tr>

        			</table>';

        $tbl = '<table border="">
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="120"><b>Nama Jasa</b></td>
        				<td align="center" width="100"><b></b></td>
        				<td align="center" width="70"><b>Jumlah</b></td>
        				<td align="center" width="70"><b></b></td>
        				<td align="left" width="300"><b>Ketentuan</b></td>
        			</tr>
        		</table>';
		switch($layanan)
		{

			case "kapal":
			foreach ($trxline as $line) {
				$data_table = $line;
				//print_r($line);die;
				$this->get_data_kapal($no_invoice,$data_table,$current);
				$tbl .= $data_table;

			}
				$output_name = "LAPORAN PDF NOTA KAPAL";
				break;
		}

		$footer = '<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="190px">DASAR PENGENAAN PAJAK</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.number_format($jum_amount, 0, ' ', '.').'</td>
                		</tr><br/>

	                	<tr>
		                    <td COLSPAN="2" align="left" width="190px">PPN 10%</td>
		                    <td COLSPAN="2" align="right" width="50px"></td>
	                   		<td COLSPAN="1" align="right" width="70px"></td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px">a.PPn dipungut sendiri</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.$ppn_sendiri.'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px">b.PPn dipungut pemungut</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.$ppn_pemungut.'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px">c.PPn tidak dipungut</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.$ppn_tdk_dipungut.'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px">d.PPn dibebaskan</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.$ppn_dibebaskan.'</td>
                		</tr><br/>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px">Materai</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px"></td>
                		</tr>

	                	<tr>
		                    <td COLSPAN="2" align="left" width="190px">Jumlah Tagihan</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.number_format($jum_amount, 0, ' ', '.').'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px">Uang Jaminan</td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.$u_jaminan.'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="190px"><b>Piutang</b></td>
		                    <td COLSPAN="2" align="right" width="50px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.$u_piutang.'</td>
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
		                    <td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">Jambi, '.$tgl_nota.'</td>
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

                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
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
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name.".pdf", 'I');
	}

	public function cetak_ruparupa($layanan,$no_invoice=""){
		$this->load->helper('pdf_helper');
		tcpdf();
		//$qs = $this->input->server('QUERY_STRING');
        $id    = $this->uri->segment(5);
        //print_r($id);die;
		  //$id2 = $this->encrypt->decode($qs);
		// print_r($qs);die;
		$judul = 'priview cetak ruparupa';
		// echo "===>";die();exit();
		switch($layanan)
		{
			case "RUPARUPA":
			//$id2=$qs;
			$id2 	= $id;
			$data_header = $this->getdataurl('invh/pdf/RUPARUPA/'.$id2);
			$num       = $data_header->TRX_NUMBER;
			$tgl_nota  = $data_header->TRX_DATE;
			//print_r($tgl_nota);die;
			$org_id  = $data_header->ORG_ID;
			$custname  = $data_header->CUSTOMER_NAME;
			$c_number  = $data_header->CUSTOMER_NUMBER;
			$c_address = $data_header->CUSTOMER_ADDRESS;
			$nomornpwp = $data_header->CUSTOMER_NPWP;
			$kapal 	   = $data_header->VESSEL_NAME;
			$kunjungan = $data_header->PER_KUNJUNGAN_FROM;
			$to_kun    = $data_header->PER_KUNJUNGAN_TO;
			$no_req    = $data_header->BILLER_REQUEST_ID;
			$dagang    = $data_header->JENIS_PERDAGANGAN;
			$current   = $data_header->CURRENCY_CODE;
			$header_context = $data_header->HEADER_SUB_CONTEXT;
			$administrasi = "0";
			/*print_r($data_header);
			die();exit();*/
			$e_name 	 = $data_header->INV_ENTITY_NAME;
			//print_r($e_name);die;
			$e_address   = $data_header->INV_ENTITY_ALAMAT;
			$e_npwp      = $data_header->INV_ENTITY_NPWP;
			$e_faktur 	 = $data_header->INV_ENTITY_FAKTUR;
			$e_logo		 = $data_header->INV_ENTITY_LOGO;
			$pejabat 		= $data_header->INV_PEJABAT_NAME;
			$nip_pejabat 	= $data_header->INV_PEJABAT_NIPP;
			$ttd_pejabat 	= $data_header->INV_PEJABAT_TTD;
			// print_r($data_header);die();exit();
				/*
				//ambil data dari trx_header
				$num       = $data_header->TRX_NUMBER;
				$tgl_nota  = $data_header->TRX_DATE;
				$custname  = $data_header->CUSTOMER_NAME;
				$c_number  = $data_header->CUSTOMER_NUMBER;
				$c_address = $data_header->CUSTOMER_ADDRESS; //print_r($c_address);die;
				$nomornpwp = $data_header->CUSTOMER_NPWP;
				$kapal 	   = $data_header->VESSEL_NAME;
				$kunjungan = $data_header->PER_KUNJUNGAN_FROM;
				$to_kun    = $data_header->PER_KUNJUNGAN_TO;
				//print_r($to_kun);die;
				$no_req    =
				$dagang    = $data_header->JENIS_PERDAGANGAN;
				$current   = $data_header->CURRENCY_CODE;

			//$entitas = $this->getdataurl('entity/'.$id2);
			$entitas = $this->getdataurl('entity/72');
			//print_r($entitas);die;
			//foreach ($entitas as $e_data) {
				//$data_entity = $e_data;
				//$e_name 	 = $data_entity->INV_ENTITY_NAME;
				$e_name 	 = $entitas->INV_ENTITY_NAME;
				$e_address   = $entitas->INV_ENTITY_ALAMAT;
				$e_npwp      = $entitas->INV_ENTITY_NPWP;
				$e_faktur 	 = $entitas->INV_ENTITY_FAKTUR;
				//print_r($e_faktur);die;

			//}

			//ambil dari db_invoice
			$data_pejabat = $this->getdataurl('pejabat/1');
				$start_date 	= $data_pejabat->INV_PEJABAT_EFECTIVE;
				$pejabat 		= $data_pejabat->INV_PEJABAT_NAME;
				$nip_pejabat 	= $data_pejabat->INV_PEJABAT_NIPP;*/

			$data_wilayah = $this->getdataurl('wilayah/1');
				$unit_wilayah 	= $data_wilayah->INV_WILAYAH_NAME;
				$alamat_wilayah = $data_wilayah->INV_WILAYAH_ALAMAT;


			// print_r($id2);die;
			$trxline = $this->getdataurl('invl/'.$id2);
			// print_r($trxline);die;
			$jum_amount=0;
			$tax_amount=0;
			$total_amount=0;
			$materai = 6000;
			foreach ($trxline as $jumlah) {
				$total_amount = $jumlah;
				//perhitungan pengenaan pajak
				$jum = $jumlah->AMOUNT;
				$jum_amount = $jum_amount + $jum;

				$tax = $jumlah->TAX_AMOUNT;
				$tax_amount = $tax_amount + $tax;

				$jum_total = $jum_amount + $tax_amount;
				$total_amount = $total_amount+$jum_total;

				/*//barcode
				//$idsecret = $this->encrypt->encode($TRX_NUMBER);

				//$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
				//$params['level'] = 'H';
				//$params['size'] = 10;
				//$randomfilename = rand(1000, 9999);
				$params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
				$this->ciqrcode->generate($params);
				$barcode_location=APP_ROOT."qr_code/$randomfilename.png";
				$ttd_location = APP_ROOT."config/images/cr/ttd2.png";*/
			}
			//barcode
			// $idsecret = $this->encrypt->encode($num);
			$idsecret = $num;

			$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
			$params['level'] = 'H';
			$params['size'] = 10;
			$randomfilename = rand(1000, 9999);
			/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
			die();exit();*/
			$params['savename'] = UPLOADFOLDER_."qr_code/".$randomfilename.".png";
			$this->ciqrcode->generate($params);
			$barcode_location=APP_ROOT."qr_code/".$randomfilename.".png";
			$ttd_location = APP_ROOT."config/images/cr/ttd2.png";

			//terbilang
			$huruf = $this->getdataurl('others/terbilang/'.$total_amount);
			foreach ($huruf as $bilang) {
				$terbilang = $bilang->NILAI;
				$terbilang = $terbilang.'Rupiah';
			}
			// ---tutup data -----------
				$title ="Report Nota Ruparupa";
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
	    $pdf->SetFont('courier', '', 8);
		$pdf->AddPage();
		$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
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
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;"><b>NOTA PENJUALAN JASA KEPELABUHAN</b></td>
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

	               		<td COLSPAN="2" align="left" width="120px">Bukti Pendukung</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                        <td COLSPAN="2" align="left"  width="170px"></td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="50px">NPWP</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">'.$nomornpwp.'</td>

	                    <td COLSPAN="2" align="left" width="120px">No Bukti</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px"></td>
                	</tr>

        			</table>';

        $tbl = '<table border="">
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="100"><b>Jenis Jasa</b></td>
        				<td align="center" width="260"><b>Jumlah Barang</b></td>
        				<td align="right"  width="70"><b>Tarif</b></td>
        				<td align="center" width="30"><b></b></td>
        				<td align="center" width="70"><b>Jumlah</b></td>

        			</tr>
        		</table>';
		switch($layanan)
		{

			case "RUPARUPA":
			foreach ($trxline as $line) {
				$data_table = $line;
				//print_r($line);die;
				$this->get_data_ruparupa($no_invoice,$data_table,$current);
				$tbl .= $data_table;

			}
				$output_name = "LAPORAN PDF NOTA RUPARUPA";
				break;
		}

		$footer = '<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="250px">DASAR PENGENAAN PAJAK</td>
		                    <td COLSPAN="2" align="right" width="230px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.number_format($jum_amount, 0, ' ', '.').'</td>
                		</tr>

	                	<tr>
		                    <td COLSPAN="2" align="left" width="250px">PPN 10%</td>
		                    <td COLSPAN="2" align="right" width="230px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.number_format($tax_amount, 0, ' ', '.').'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="250px">Materai</td>
		                    <td COLSPAN="2" align="right" width="230px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.number_format($materai, 0, ' ', '.').'</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="250px"><b>Jumlah Tagihan</b></td>
		                    <td COLSPAN="2" align="right" width="230px">'.$current.'</td>
	                   		<td COLSPAN="1" align="right" width="70px">'.number_format($total_amount, 0, ' ', '.').'</td>
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
		                    <td COLSPAN="2" align="center" width="800px">Jambi, '.$tgl_nota.'</td>
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

                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
							<td COLSPAN="2" align="left" width="5px"></td>
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
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->Output($output_name, 'I');
	}

	public function get_data_kapal($no_invoice,&$data_table,&$current) {

		//data diambil dari trx_line
		$no 		= $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc 		= $data_table->DESCRIPTION;
		//print_r($desc);die;
		$ketentuan = $data_table->SERVICE_TYPE;
		// print_r($ketentuan);die;
		//$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		//print_r($size);die;
		//list($size,$type,$sts,$hz) = split(" ",$att6, 4);
		$hari 		= $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$jumlah 	= $data_table->AMOUNT;
		//print_r($jumlah);die;

		//print_r($jumlah);die;

		$data_table ='<table border="">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="20">'.$no.'</th>';
		$data_table .='<th align="left" width="120">'.$desc.'</th>';
		$data_table .='<th align="right" width="100">'.$current.'</th>';
		$data_table .='<th align="right" width="70">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .='<th align="left" width="70"></th>';
		$data_table .='<th align="left" width="245">'.$ketentuan.'</th>';
		$data_table .='</tr>';
		$data_table .='</table>';
	}

	public function get_data_petikemas($no,$no_invoice,&$data_table,&$current) {
		//data diambil dari trx_line
		//$no 		= $data_table->LINE_NUMBER;
		//print_r($no);die;
		
		$desc 		= $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal 	= $data_table->START_DATE;
		//print_r($tgl_awal);die;
		$tgl_akhir 	= $data_table->END_DATE;
		$box 		= $data_table->INTERFACE_LINE_ATTRIBUTE7;
		$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		//print_r($size);die;
		list($size,$sts,$type,$hz) = explode(" ",$att6, 4);
		$hari 		= $data_table->INTERFACE_LINE_ATTRIBUTE9;
		$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$jumlah 	= $data_table->AMOUNT;
		if(empty($tgl_awal)){
			$tgl_awal ='';//'-';
		}
		if(empty($tgl_akhir)){
			$tgl_akhir='';//'-';
		}
		if (empty($box)){
			$box = '';//'0';
		}
		if (empty($size)){
			$size ='';//'0';
		}
		if (empty($type)){
			$type ='';//'-';
		}
		if (empty($sts)){
			$sts ='';//'-';
		}
		if (empty($hz)){
			$hz='';//'-';	
		}
		if (empty($hari)){
			$hari ='';//'0';
		}
		if (empty($tarif)){
			$tarif ='';//'0';
		}

		//print_r($jumlah);die;
		$data_table ='<table>';
		$data_table .='<tr>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$no.'</th>';
		$data_table .='<th align="left" width="90">'.$desc.'</th>';
		$data_table .='<th align="center" width="70">'.$tgl_awal.'</th>';
		$data_table .='<th align="center" width="70">'.$tgl_akhir.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.$box.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$size.'</th>';
		$data_table .='<th align="center" width="40">'.$type.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$sts.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.$hz.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.$hari.'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="70">'.number_format($tarif, 0, ' ', '.').'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="27">'.$current.'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .='</tr>';
		$data_table .='</table>';

	}
	public function get_data_rupa5($no_invoice,&$data_table,&$rupalines) {
		$awal = "";
		$isi = "";
		$nomor = 0;
		$bulan =($rupalines['data']['bulan']=='0'|| $rupalines['data']['bulan']=='')?"0":number_format($rupalines['data']['bulan'], 0, ' ', '.');
		$tahun =($rupalines['data']['tahun']=='0'|| $rupalines['data']['tahun']=='')?"0":number_format($rupalines['data']['tahun'], 0, ' ', '.');
		$admin =($rupalines['data']['admin']=='0'|| $rupalines['data']['admin']=='')?"0":number_format($rupalines['data']['admin'], 0, ' ', '.');
		$sampah =($rupalines['data']['sampah']=='0'|| $rupalines['data']['sampah']=='')?"0":number_format($rupalines['data']['sampah'], 0, ' ', '.');
		$air =($rupalines['data']['air']=='0'|| $rupalines['data']['air']=='')?"0":number_format($rupalines['data']['air'], 0, ' ', '.');
		$pas =($rupalines['data']['pas']=='0'|| $rupalines['data']['pas']=='')?"0":number_format($rupalines['data']['pas'], 0, ' ', '.');
		// $faktorMeter = $data_table->INTERFACE_LINE_ATTRIBUTE4;
		$data_table = '<table border="0px">';
		$data_table .='<tr>';
		$data_table .='<th width="30">1</th>';
		$data_table .='<th width="60">Jenis Jasa</th>';
		$data_table .='<th width="150">&nbsp;</th>';
		$data_table .='<th width="190">&nbsp;</th>';
		// $data_table .='<th width="100">&nbsp;</th>';
		$data_table .='</tr><tr>';
		$data_table .='<th width="30">&nbsp;</th>';
		$data_table .='<th width="30">a)</th>';
		$data_table .='<th align="left" width="180">Bulanan</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$bulan.'</th>';
		$data_table .='<th width="20">&nbsp;</th>';
		
		$data_table .='</tr><tr>';
		$data_table .='<th width="30">&nbsp;</th>';
		$data_table .='<th width="30">b)</th>';
		$data_table .='<th align="left" width="180">Tahunan</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$tahun.'</th>';
		$data_table .='</tr>';
		$data_table .='<tr>';
		$data_table .='<th width="30">2</th>';
		$data_table .='<th width="150">Uang Administrasi</th>';
		$data_table .='<th width="60">&nbsp;</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$admin.'</th>';
		$data_table .='</tr>';
		$data_table .='<tr>';
		$data_table .='<th width="30">3</th>';
		$data_table .='<th width="60">Biaya Air</th>';
		$data_table .='<th width="150">&nbsp;</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$air.'</th>';
		$data_table .='</tr>';
		$data_table .='<tr>';
		$data_table .='<th width="30">4</th>';
		$data_table .='<th width="150">Biaya Sampah</th>';
		$data_table .='<th width="60">&nbsp;</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$sampah.'</th>';
		$data_table .='</tr>';
		$data_table .='<tr>';
		$data_table .='<th width="30">5</th>';
		$data_table .='<th width="150">Biaya Pas/Retribusi</th>';
		$data_table .='<th width="60">&nbsp;</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$pas.'</th>';
		$data_table .='</tr>';
		$data_table .='<tr>';
		$data_table .='<th width="30">&nbsp;</th>';
		$data_table .='<th width="150">&nbsp;</th>';
		$data_table .='<th width="60">&nbsp;</th>';
		$data_table .='<th align="right" width="50">&nbsp;</th>';
		$data_table .='<th align="right" width="100" style="border-bottom:1px solid #000;">&nbsp;</th>';
		$data_table .='</tr></table>';
	}
	
	public function get_data_rupa9($no_invoice,&$data_table,&$rupalines) {
		$awal = "";
		$isi = "";
		$nomor = 0;
		// $bulan =($rupalines['data']['AMOUNT']=='0'|| $rupalines['data']['AMOUNT']=='')?"0":number_format($rupalines['data']['bulan'], 0, ' ', '.');
		// $tahun =($rupalines['data']['tahun']=='0'|| $rupalines['data']['tahun']=='')?"0":number_format($rupalines['data']['tahun'], 0, ' ', '.');
		$bulan = ($rupalines['data']['amount_air']=='0'|| $rupalines['data']['amount_air']=='') ? '0' : number_format($rupalines['data']['amount_air'], 0, '', '.');
		$lainnya = ($rupalines['data']['lainnya']=='0'|| $rupalines['data']['lainnya']=='') ? '0' : number_format($rupalines['data']['lainnya'], 0, '', '.');
		$data_table .='<table><tr>';
		$data_table .='<th width="30">1</th>';
		$data_table .='<th width="60">Jenis Jasa</th>';
		$data_table .='<th width="145">&nbsp;</th>';
		$data_table .='<th width="190">&nbsp;</th>';
		// $data_table .='<th width="100">&nbsp;</th>';
		$data_table .='</tr><tr>';
		$data_table .='<th width="30">&nbsp;</th>';
		$data_table .='<th width="30">a)</th>';
		$data_table .='<th align="left" width="175">Bulanan</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$bulan.'</th>';
		$data_table .='<th width="20">&nbsp;</th>';
		
		$data_table .='</tr><tr>';
		$data_table .='<th width="30">&nbsp;</th>';
		$data_table .='<th width="30">b)</th>';
		$data_table .='<th align="left" width="175">Lain-lain</th>';
		$data_table .='<th align="right" width="50">: IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$lainnya.'</th>';
		$data_table .='</tr>';
		$data_table .='<tr>';
		$data_table .='<th width="30">&nbsp;</th>';
		$data_table .='<th width="145">&nbsp;</th>';
		$data_table .='<th width="60">&nbsp;</th>';
		$data_table .='<th align="right" width="50">&nbsp;</th>';
		$data_table .='<th align="right" width="100" style="border-bottom:1px solid #000;">&nbsp;</th>';
		$data_table .='</tr>';
	}
	public function get_data_rupa12($no_invoice,&$data_table,&$rupalines,$redaksis) {
		$data_table .='<table>';
		$data_table .='<tr>';
		$data_table .='<th width="315">Untuk Pembayaran Jasa Pelabuhan Lainnya</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='</tr>';
		// echo "==>".count($rupalines['data']);die();
		if(count($redaksis)>0){
			$redaksis = $redaksis->INV_REDAKSI_ATAS;
		}else{
			$redaksis = "";
		}
		$i = 0;
        for ($i = 0; $i < count($rupalines['data']); ++$i) {
			// print_r($rupalines['data']);die();
			$data_table .='<tr>';
			$data_table .='<td align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.($i+1).'</td>';
			$data_table .='<td align="left" width="140">'.$rupalines['data'][$i]['desc'].'</td>';
			$data_table .='<td align="center" width="55">'.$rupalines['data'][$i]['x']." ".$rupalines['data'][$i]['satuan'].'</td>';
			$data_table .='<td align="center" width="6">x</td>';
			$data_table .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="62">'.number_format($rupalines['data'][$i]['tarif'], 0, ' ', '.').'</td>';
			$data_table .='<td align="right" width="25"> IDR</td>';
			$data_table .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="102">'.number_format($rupalines['data'][$i]['harga'], 0, ' ', '.').'</td>';
			$data_table .='<td width="10">&nbsp;</td>';
			if($i==0){
				$data_table .='<td width="150"></td>';
				// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">'.$redaksis.'</td>';
				// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">ss.</td>';
			}
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}
	public function get_data_rupa15($no_invoice,&$data_table,&$rupalines,$redaksis) {
		$data_table .='<table>';
		$data_table .='<tr>';
		$data_table .='<th><b>No</b></th>';
		$data_table .='<th width="250"><b>Jenis Jasa</b></th>';
		$data_table .='<th><b>Jumlah</b></th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='</tr>';
		// echo "==>".count($rupalines['data']);die();
		if(count($redaksis)>0){
			$redaksis = $redaksis->INV_REDAKSI_ATAS;
		}else{
			$redaksis = "";
		}
		$i = 0;
        for ($i = 0; $i < count($rupalines['data']); ++$i) {
			// print_r($rupalines['data']);die();
			$data_table .='<tr>';
			$data_table .='<td align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.$rupalines['data'][$i]['line'].'</td>';
			$data_table .='<td align="left" width="225">'.$rupalines['data'][$i]['desc'].'</td>';
			$data_table .='<td align="right" width="40"> IDR</td>';
			$data_table .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="102">'.number_format($rupalines['data'][$i]['harga'], 0, ' ', '.').'</td>';
			$data_table .='<td width="10">&nbsp;</td>';
			if($i==0){
				$data_table .='<td width="150"></td>';
				// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">'.$redaksis.'</td>';
				// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">ss</td>';
			}
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}
	public function get_data_rupa14($no_invoice,&$data_table,&$rupalines,$redaksis) {
		$data_table .='<table>';
		$data_table .='<tr>';
		$data_table .='<th><b>No</b></th>';
		$data_table .='<th width="250"><b>Jenis Jasa</b></th>';
		$data_table .='<th><b>Jumlah</b></th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='</tr>';
		// echo "==>".count($rupalines['data']);die();
		if(count($redaksis)>0){
			$redaksis = $redaksis->INV_REDAKSI_ATAS;
		}else{
			$redaksis = "";
		}
		$total = 0;
        for ($i = 0; $i < count($rupalines['data']); ++$i) {
			$total = $total + $rupalines['data'][$i]['jumlah'];
		}
		/*
		$i = 0; 
		for ($i=0; $i < count($rupalines['data']); $i++) {
			// print_r($rupalines['data']);die();
			$data_table .='<tr>';
			$data_table .='<td align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.($i+1).'</td>';
			$data_table .='<td align="left" width="225">'.$rupalines['data'][$i]['desc'].'</td>';
			$data_table .='<td align="right" width="40"> IDR</td>';
			$data_table .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="102">'.number_format($rupalines['data'][$i]['jumlah'], 0, ' ', '.').'</td>';
			$data_table .='<td width="10">&nbsp;</td>';
			if($i==0){
				$data_table .='<td width="150"></td>';
				// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">'.$redaksis.'</td>';
				// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">ss</td>';
			}
			$data_table .='</tr>';
		}
		*/
		$data_table .='<tr>';
		$data_table .='<td align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">1.</td>';
		$data_table .='<td align="left" width="225">Port Facility Service</td>';
		$data_table .='<td align="right" width="40"> IDR</td>';
		$data_table .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="102">'.number_format($total, 0, ' ', '.').'</td>';
		$data_table .='<td width="10">&nbsp;</td>';
		$data_table .='<td width="150"></td>';
		// if($i==0){
		// 		$data_table .='<td width="150"></td>';
		// 		// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">'.$redaksis.'</td>';
		// 		// $data_table .='<td width="150" rowspan="'.(count($rupalines['data'])+4).'">ss</td>';
		// }
		$data_table .='</tr>';
		$data_table .='</table>';
	}
	public function get_data_rupa13($no_invoice,&$data_table,&$current) {
		$data_table .='<table>';
		$data_table .='<tr>';
		$data_table .='<th width="315">Jenis Jasa</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='<th>&nbsp;</th>';
		$data_table .='</tr>';
		// echo "==>".count($rupalines['data']);die();
        for ($i = 0; $i < count($current['data']); ++$i) {
			$data_table .='<tr>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.$current['data'][$i]['line'].'</th>';
			$data_table .='<th align="left" width="150">'.$current['data'][$i]['desc'].'</th>';
			$data_table .='<th width="345">&nbsp;</th>';
			$data_table .='<th align="right" width="32">: IDR</th>';
			$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($current['data'][$i]['harga'], 0, ' ', '.').'</th>';
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}
	public function get_data_rupa3($no_invoice,&$data_table,&$current,$ketentuan) {
		$awal = "";
		$isi = "";
		$nomor = 0;
		$faktorMeter = $data_table->INTERFACE_LINE_ATTRIBUTE4;
		if(count($ketentuan)>0){
			$ketentuan = $ketentuan->INV_REDAKSI_ATAS;
		}else{
			$ketentuan = "";
		}

		$data_tables .='<table><tr>';
		$data_tables .='<td width="30">1</td>';
		$data_tables .='<td width="150">Angka Pemakaian LWBP</td>';
		$data_tables .='<td width="150">&nbsp;</td>';
		$data_tables .='<td width="15">&nbsp;</td>';
		$data_tables .='<td width="100">&nbsp;</td>';
		$data_tables .='<td width="20" align="center">&nbsp;</td>';
		$data_tables .='<td width="230" align="left"><b>KETENTUAN</b></td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">a)</td>';
		$data_tables .='<td align="left" width="180">Baru</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE2, 0, ' ', '.').'</td>';
		$data_tables .='<td align="left" width="20" rowspan="18">&nbsp;</td>';
		$data_tables .='<td width="230" rowspan="18">'.$ketentuan.'</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">b)</td>';
		$data_tables .='<td align="left" width="180">Lama</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE3, 0, ' ', '.').'</td>';
		$data_tables .='</tr>';
		$data_tables .='<tr>';
		$data_tables .='<td width="30">2</td>';
		$data_tables .='<td width="150">Angka Pemakaian WBP</td>';
		$data_tables .='<td width="150">&nbsp;</td>';
		$data_tables .='<td width="315">&nbsp;</td>';
		$data_tables .='<td width="100">&nbsp;</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">a)</td>';
		$data_tables .='<td align="left" width="180">Baru</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">0</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">b)</td>';
		$data_tables .='<td align="left" width="180">Lama</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">0</td>';
		$data_tables .='</tr>';
		$data_tables .='<tr>';
		$data_tables .='<td align="left" width="30">3</td>';
		$data_tables .='<td width="110">Faktor Meter</td>';
		$data_tables .='<td align="left" width="100">&nbsp;</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($faktorMeter, 0, ' ', '.').'</td>';
		$data_tables .='</tr>';
		$data_tables .='<tr>';
		$data_tables .='<td width="30">4</td>';
		$data_tables .='<td width="60">Pemakaian</td>';
		$data_tables .='<td width="150">&nbsp;</td>';
		$data_tables .='<td width="20">&nbsp;</td>';
		$data_tables .='<td width="100">&nbsp;</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">a)</td>';
		$data_tables .='<td align="left" width="180">LWBP</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE5, 0, ' ', '.').'</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">b)</td>';
		$data_tables .='<td align="left" width="180">WBP</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE6, 0, ' ', '.').'</td>';
		$data_tables .='</tr>';
		$data_tables .='<tr>';
		$data_tables .='<td width="30">5</td>';
		$data_tables .='<td width="60">Tarif</td>';
		$data_tables .='<td width="150">&nbsp;</td>';
		$data_tables .='<td width="315">&nbsp;</td>';
		$data_tables .='<td width="100">&nbsp;</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">a)</td>';
		$data_tables .='<td align="left" width="180">LWBP</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">0</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">b)</td>';
		$data_tables .='<td align="left" width="180">WBP</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">0</td>';
		$data_tables .='</tr>';
		$data_tables .='<tr>';
		$data_tables .='<td width="30">6</td>';
		$data_tables .='<td width="150">Jumlah Harga Listrik</td>';
		$data_tables .='<td width="150">&nbsp;</td>';
		$data_tables .='<td width="315">&nbsp;</td>';
		$data_tables .='<td width="100">&nbsp;</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">a)</td>';
		$data_tables .='<td align="left" width="180">Harga Tarif I</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE7, 0, ' ', '.').'</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">b)</td>';
		$data_tables .='<td align="left" width="180">Harga Tarif II</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE8, 0, ' ', '.').'</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">c)</td>';
		$data_tables .='<td align="left" width="180">Biaya Beban</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE9, 0, ' ', '.').'</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">d)</td>';
		$data_tables .='<td align="left" width="180">P.P.J.U</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE10, 0, ' ', '.').'</td>';
		$data_tables .='</tr><tr>';
		$data_tables .='<td width="30">&nbsp;</td>';
		$data_tables .='<td width="30">e)</td>';
		$data_tables .='<td align="left" width="180">T.T.L.B</td>';
		$data_tables .='<td align="left" width="20">:</td>';
		$data_tables .='<td align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($data_table->INTERFACE_LINE_ATTRIBUTE11, 0, ' ', '.').'</td>';
		$data_tables .='</tr></table>';
		$data_table = $data_tables;

	}
	public function get_data_rupa2($no_invoice,&$data_table,&$current, $nomor_urut = null) {
		// $no 		= $data_table->LINE_NUMBER;
		$no = $nomor_urut != null ? $nomor_urut : 1;
		// echo print_r($no); die();
		$desc 		= $data_table->DESCRIPTION;
		$lembar		= $data_table->INTERFACE_LINE_ATTRIBUTE2;
		// $cr 		= $data_table->CURRENCY_CODE;
		$cr 		= "IDR";
		$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE3;
		$jumlah 	= $data_table->AMOUNT;
		$data_table ='<table>';
		$data_table .='<tr>';
		$data_table .='<th align="left" style="font-size: 11px;font-family: franklingothicbook;" width="30">'.$no.'</th>';
		$data_table .='<th align="left" width="200">'.$desc.'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="120">'.number_format($lembar, 0, ' ', '.').'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="160">'.number_format($tarif, 0, ' ', '.').'</th>';
		$data_table .='<th align="right" width="47">'.$cr.'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .='</tr>';
		$data_table .='</table>';
	}
	// public function get_data_rupa7($no_invoice,&$data_table,&$current) {
	// 	$no 		= $data_table->LINE_NUMBER;
	// 	$desc 		= $data_table->DESCRIPTION;
	// 	$lembar		= $data_table->INTERFACE_LINE_ATTRIBUTE2;
	// 	$hari		= $data_table->INTERFACE_LINE_ATTRIBUTE5;
	// 	// $cr 		= $data_table->CURRENCY_CODE;
	// 	$cr 		= "IDR";
	// 	$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE3;
	// 	$jumlah 	= $data_table->AMOUNT;
	// 	$data_table ='<table>';
	// 	$data_table .='<tr>';
	// 	$data_table .='<th align="left" style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$no.'</th>';
	// 	$data_table .='<th align="left" width="180">'.$desc.'</th>';
	// 	$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$lembar.'</th>';
	// 	$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$hari.'</th>';
	// 	$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($tarif, 0, ' ', '.').'</th>';
	// 	$data_table .='<th align="right" width="57">'.$cr.'</th>';
	// 	$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($jumlah, 0, ' ', '.').'</th>';
	// 	$data_table .='</tr>';
	// 	$data_table .='</table>';
	// }

	public function get_data_rupa7($no_invoice,&$data_table,&$current) {
		$data_table .='<table>';
		// echo "==>".count($rupalines['data']);die();
				$j=1;
        for ($i = 0; $i < count($current['data']); ++$i) {
			$data_table .='<tr>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$j++.'</th>';
			$data_table .='<th align="left" width="180">'.$current['data'][$i]['desc'].'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$current['data'][$i]['lembar'].'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.$current['data'][$i]['jam'].'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($current['data'][$i]['tarif'], 0, ' ', '.').'</th>';
		$data_table .='<th align="right" width="57">'.$current['data'][$i]['cr'].'</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}
	/* 20180927 3ono */
	public function get_data_rupa8($no_invoice,&$data_table,&$current) {
		$data_table .='<table>';
		$j=1;
		
        for ($i = 0; $i < count($current['data']); ++$i) {
			$data_table .='<tr>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$j++.'</th>';
			$data_table .='<th align="right" width="20"> </th>';
			$data_table .='<th align="left" width="260">'.$current['data'][$i]['desc'].'</th>';
			$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($current['data'][$i]['volume'], 0, ' ', '.').'</th>';
			$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($current['data'][$i]['tarif'], 0, ' ', '.').'</th>';
			$data_table .='<th align="right" width="57">'.$current['data'][$i]['cr'].'</th>';
			$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}
	
	/* 20180928 3ono */
	public function get_data_rupa17($no_invoice,&$data_table,&$current) {
		$data_table .='<table>';
		$j=1;
		
		for ($i=0; $i < count($current['data']); $i++) {
			$data_table .='<tr>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$j++.'</th>';
			$data_table .='<th align="right" width="20"> </th>';
			$data_table .='<th align="center" width="100">'.$current['data'][$i]['bukti'].'</th>';
			$data_table .='<th align="center" width="70">'.$current['data'][$i]['kade'].'</th>';
			$data_table .='<th align="center" width="100">'.$current['data'][$i]['start'].'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="70">'.number_format($current['data'][$i]['volume'], 0, ' ', '.').'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="70">'.number_format($current['data'][$i]['tarif'], 2).'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="90">'.number_format($current['data'][$i]['kurs'], 0).'</th>';
			$data_table .='<th align="left" width="70">'.$current['data'][$i]['cr'].'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="50">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}
	public function get_data_rupa16($no_invoice,&$data_table,&$current) {
		$data_table .='<table>';
		$j=1;
		
        for ($i = 0; $i < count($current['data']); ++$i) {
			$data_table .='<tr>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="20">'.$j++.'</th>';
			$data_table .='<th align="right" width="20"> </th>';
			$data_table .='<th align="center" width="100">'.$current['data'][$i]['bukti'].'</th>';
			$data_table .='<th align="center" width="70">'.$current['data'][$i]['kade'].'</th>';
			$data_table .='<th align="center" width="100">'.$current['data'][$i]['start'].'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="70">'.number_format($current['data'][$i]['volume'], 0, ' ', '.').'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="70">'.number_format($current['data'][$i]['tarif'], 2).'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="90">'.number_format($current['data'][$i]['kurs'], 0).'</th>';
			$data_table .='<th align="left" width="70">'.$current['data'][$i]['cr'].'</th>';
			$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="50">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table .='</tr>';
		}
		$data_table .='</table>';
	}	
	public function get_data_petikemas2($no_invoice, &$data_table, &$current)
    {
        //data diambil dari trx_line
        //$no 		= $data_table->LINE_NUMBER;
        //print_r($no);die;
		//$nomor = $data_table['LINE_NUMBER'];
        /*$desc = $data_table['DESCRIPTION'];//$data_table->DESCRIPTION;
        //print_r($desc);die;
        $tgl_awal = $data_table['START_DATE'];//$data_table->START_DATE;
        //print_r($tgl_awal);die;
        $tgl_akhir = $data_table['END_DATE'];//$data_table->END_DATE;
        $ei = $data_table['INTERFACE_LINE_ATTRIBUTE2'];//$data_table->INTERFACE_LINE_ATTRIBUTE2;
        $io = $data_table['INTERFACE_LINE_ATTRIBUTE3'];//$data_table->INTERFACE_LINE_ATTRIBUTE3;
        $cr = $data_table['INTERFACE_LINE_ATTRIBUTE4'];//$data_table->INTERFACE_LINE_ATTRIBUTE4;
        $box = $data_table['INTERFACE_LINE_ATTRIBUTE7'];//$data_table->INTERFACE_LINE_ATTRIBUTE7;
        $att6 = $data_table['INTERFACE_LINE_ATTRIBUTE6'];//$data_table->INTERFACE_LINE_ATTRIBUTE6;
        // print_r($size."ddddddd");die;
        list($size, $sts, $type, $hz) = explode(' ', $att6, 4);
        $hari = $data_table['INTERFACE_LINE_ATTRIBUTE9'];//$data_table->INTERFACE_LINE_ATTRIBUTE9;
        $tarif = $data_table['INTERFACE_LINE_ATTRIBUTE8'];//$data_table->INTERFACE_LINE_ATTRIBUTE8;
        $jumlah = $data_table['AMOUNT'];//$data_table->AMOUNT;
        $curr = $data_table['INTERFACE_LINE_ATTRIBUTE13'];//$data_table->INTERFACE_LINE_ATTRIBUTE13;
        if (empty($tgl_awal)) {
            $tgl_awal = ''; //'-';
        }
        if (empty($tgl_akhir)) {
            $tgl_akhir = ''; //'-';
        }
        if (empty($box)) {
            $box = ''; //'0';
        }
        if (empty($size)) {
            $size = ''; //'0';
        }
        if (empty($type)) {
            $type = ''; //'-';
        }
        if (empty($sts)) {
            $sts = ''; //'-';
        }
        if (empty($hz)) {
            $hz = ''; //'-';
        }
        if (empty($hari)) {
            $hari = ''; //'0';
        }
        if (empty($tarif)) {
            $tarif = ''; //'0';
        }
        if (empty($ei)) {
            $ei = ''; //'-';
        }
        if (empty($io)) {
            $io = ''; //'-';
        }
        if (empty($cr)) {
            $cr = ''; //'-';
        }

        //print_r($jumlah);die;
		$data_table = '<table>';
		$data_table .= '<tr>';
		$data_table .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$no.'</th>';
		$data_table .= '<th width="90" align="center">'.$desc.'</th>';
		$data_table .= '<th width="40" align="center">'.$ei.'</th>';
		$data_table .= '<th width="40" align="center">'.$io.'</th>';
		$data_table .= '<th width="40" align="center">'.$cr.'</th>';
		$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
		$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
		$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
		$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
		$data_table .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$box.'</th>';
		$data_table .= '<th width="40" align="center">'.$curr.'</th>';
		$data_table .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($tarif, 2, ',', '.').'</th>';
		$data_table .= '<th width="50" align="center">IDR</th>';
		$data_table .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .= '</tr>';
		$data_table .= '</table>';*/
		
		$data_table .= '<table>';
        $j = 1;
		//print_r($PTKM02lines['data']);die;
		if(count($current['data']) <= 45)
		{
			for ($i = 0; $i < count($current['data']); ++$i) {
				
				list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
				$data_table .= '<tr>';
				$data_table .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
				$data_table .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
				$data_table .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
				$data_table .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
				$data_table .= '<th width="50" align="center">IDR</th>';
				$data_table .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
				$data_table .= '</tr>';
			}
		}
		else
		{
			for ($i = 0; $i < 45; ++$i) {
				
				list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
				$data_table .= '<tr>';
				$data_table .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
				$data_table .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
				$data_table .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
				$data_table .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
				$data_table .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
				$data_table .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
				$data_table .= '<th width="50" align="center">IDR</th>';
				$data_table .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
				$data_table .= '</tr>';
			}
		}
		
        $data_table .= '</table>';			
		
    }
	
	public function get_data_petikemas2_long1($no_invoice, &$data_table1, &$current)
    {
		
		$data_table1 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		
		if(count($current['data']) > 45 && count($current['data']) <= 100)
		{
			for ($i = 45; $i < count($current['data']); ++$i) {
					
					list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
					$data_table1 .= '<tr>';
					$data_table1 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
					$data_table1 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
					$data_table1 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
					$data_table1 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
					$data_table1 .= '<th width="50" align="center">IDR</th>';
					$data_table1 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
					$data_table1 .= '</tr>';
			}
		}
		else
		{
			for ($i = 45; $i < 100; ++$i) {
					
					list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
					$data_table1 .= '<tr>';
					$data_table1 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
					$data_table1 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
					$data_table1 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
					$data_table1 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
					$data_table1 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
					$data_table1 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
					$data_table1 .= '<th width="50" align="center">IDR</th>';
					$data_table1 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
					$data_table1 .= '</tr>';
			}
		}
		
        $data_table1 .= '</table>';			
		
    }

	public function get_data_petikemas2_long2($no_invoice, &$data_table2, &$current)
    {
		
		$data_table2 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		if(count($current['data']) > 155)
		{
			for ($i = 100; $i < 155; ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table2 .= '<tr>';
			$data_table2 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table2 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table2 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table2 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table2 .= '<th width="50" align="center">IDR</th>';
			$data_table2 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table2 .= '</tr>';
			}	
		}
		else
		{
			for ($i = 100; $i < count($current['data']); ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table2 .= '<tr>';
			$data_table2 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table2 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table2 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table2 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table2 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table2 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table2 .= '<th width="50" align="center">IDR</th>';
			$data_table2 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table2 .= '</tr>';		
			}
		}		
			
        $data_table2 .= '</table>';			
		
    }
	
	public function get_data_petikemas2_long3($no_invoice, &$data_table3, &$current)
    {
		
		$data_table3 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		if(count($current['data']) > 155 && count($current['data']) <= 210)
		{
			for ($i = 155; $i < count($current['data']); ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table3 .= '<tr>';
			$data_table3 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table3 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table3 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table3 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table3 .= '<th width="50" align="center">IDR</th>';
			$data_table3 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table3 .= '</tr>';		
			}
		}
		else
		{
			for ($i = 155; $i < 210; ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table3 .= '<tr>';
			$data_table3 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table3 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table3 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table3 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table3 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table3 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table3 .= '<th width="50" align="center">IDR</th>';
			$data_table3 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table3 .= '</tr>';
			}	
		}		
			
        $data_table3 .= '</table>';			
		
    }		
	
	public function get_data_petikemas2_long4($no_invoice, &$data_table4, &$current)
    {
		
		$data_table4 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		if(count($current['data']) > 210 && count($current['data']) <= 265)
		{
			for ($i = 210; $i < count($current['data']); ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table4 .= '<tr>';
			$data_table4 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table4 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table4 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table4 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table4 .= '<th width="50" align="center">IDR</th>';
			$data_table4 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table4 .= '</tr>';		
			}
		}
		else
		{
			for ($i = 210; $i < 265; ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table4 .= '<tr>';
			$data_table4 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table4 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table4 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table4 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table4 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table4 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table4 .= '<th width="50" align="center">IDR</th>';
			$data_table4 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table4 .= '</tr>';
			}	
		}		
			
        $data_table4 .= '</table>';			
		
    }	

	public function get_data_petikemas2_long5($no_invoice, &$data_table5, &$current)
    {
		
		$data_table5 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		if(count($current['data']) > 265 && count($current['data']) <= 320)
		{
			for ($i = 265; $i < count($current['data']); ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table5 .= '<tr>';
			$data_table5 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table5 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table5 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table5 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table5 .= '<th width="50" align="center">IDR</th>';
			$data_table5 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table5 .= '</tr>';		
			}
		}
		else
		{
			for ($i = 265; $i < 320; ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table5 .= '<tr>';
			$data_table5 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table5 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table5 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table5 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table5 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table5 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table5 .= '<th width="50" align="center">IDR</th>';
			$data_table5 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table5 .= '</tr>';
			}	
		}		
			
        $data_table5 .= '</table>';			
		
    }

	public function get_data_petikemas2_long6($no_invoice, &$data_table6, &$current)
    {
		
		$data_table6 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		if(count($current['data']) > 320 && count($current['data']) <= 375)
		{
			for ($i = 320; $i < count($current['data']); ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table6 .= '<tr>';
			$data_table6 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table6 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table6 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table6 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table6 .= '<th width="50" align="center">IDR</th>';
			$data_table6 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table6 .= '</tr>';		
			}
		}
		else
		{
			for ($i = 320; $i < 375; ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table6 .= '<tr>';
			$data_table6 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table6 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table6 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table6 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table6 .= '<th width="50" align="center">IDR</th>';
			$data_table6 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table6 .= '</tr>';
			}	
		}		
			
        $data_table6 .= '</table>';			
		
    }
	
	public function get_data_petikemas2_long7($no_invoice, &$data_table7, &$current)
    {
		
		$data_table7 .= '<table>';
        $j = 1;
		//print_r(count($current['data']));die;
		if(count($current['data']) > 375)
		{
			for ($i = 375; $i < count($current['data']); ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table7 .= '<tr>';
			$data_table7 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table7 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table7 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table7 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table7 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table7 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table7 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table7 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table7 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table7 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table7 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table7 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table7 .= '<th width="50" align="center">IDR</th>';
			$data_table7 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table7 .= '</tr>';		
			}
		}
		/*else
		{
			for ($i = 375; $i < 430; ++$i) {
			
			list($size, $type, $sts, $hz) = explode(' ', $current['data'][$i]['att6'], 4);
			$data_table6 .= '<tr>';
			$data_table6 .= '<th width="20" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['no'].'</th>';
			$data_table6 .= '<th width="90" align="center">'.$current['data'][$i]['desc'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['ei'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['io'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['cr'].'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$size.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$type.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$sts.'</th>';
			$data_table6 .= '<th width="40" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$hz.'</th>';
			$data_table6 .= '<th width="27" style="font-size: 11px;font-family: franklingothicbook;" align="center">'.$current['data'][$i]['box'].'</th>';
			$data_table6 .= '<th width="40" align="center">'.$current['data'][$i]['curr'].'</th>';
			$data_table6 .= '<th width="67" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['tarif'], 2, ',', '.').'</th>';
			$data_table6 .= '<th width="50" align="center">IDR</th>';
			$data_table6 .= '<th width="82" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($current['data'][$i]['jumlah'], 0, ' ', '.').'</th>';
			$data_table6 .= '</tr>';
			}	
		}*/		
			
        $data_table7 .= '</table>';			
		
    }	
	public function get_data_petikemas3($no,$no_invoice,&$data_table,&$current) {
		//data diambil dari trx_line	
		//$no 		= $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc 		= $data_table->DESCRIPTION;
		//print_r($desc);die;
		$tgl_awal 	= $data_table->START_DATE;
		$tgl_akhir 	= $data_table->END_DATE;
		$ei 		= $data_table->INTERFACE_LINE_ATTRIBUTE2;
		$io 		= $data_table->INTERFACE_LINE_ATTRIBUTE3;
		$cr 		= $data_table->INTERFACE_LINE_ATTRIBUTE4;
		$box 		= $data_table->INTERFACE_LINE_ATTRIBUTE7;
		$att6 		= $data_table->INTERFACE_LINE_ATTRIBUTE6;
		// print_r($ei."-".$io."-".$cr."-".$box."-".$att6);die;
		list($size,$sts,$type,$hz) = explode(" ",$att6, 4);
		$hari 		= $data_table->INTERFACE_LINE_ATTRIBUTE9;
		// print_r($size);die;
		$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$jumlah 	= $data_table->AMOUNT;
		if(empty($tgl_awal)){
			$tgl_awal ='';//'-';
		}
		if(empty($tgl_akhir)){
					$tgl_akhir='';//'-';
				}
		if (empty($box)){
			$box = '';//'0';
		}
		if (empty($size)){
			$size ='';//'0';
		}
		if (empty($type)){
			$type ='';//'-';
		}
		if (empty($sts)){
			$sts ='';//'-';
		}
		if (empty($hz)){
			$hz='';//'-';	
		}
		if (empty($hari)){
			$hari ='';//'0';
		}
		if (empty($tarif)){
			$tarif ='';//'0';
		}
		if (empty($ei)){
			$ei ='';//'-';
		}
		if (empty($io)){
			$io ='';//'-';
		}
		if (empty($cr)){
			$cr ='';//'-';
		}
		//print_r(count($data_table->LINE_NUMBER));die;
		$data_table ='<table>';
		$data_table .='<tr>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="35">'.$no.'</th>';
		$data_table .='<th align="left" COLSPAN="3" width="155">'.$desc.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$box.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$size.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$type.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$sts.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$hz.'</th>';
		$data_table .='<th align="center" style="font-size: 11px;font-family: franklingothicbook;" width="40">'.$hari.'</th>';
		// $data_table .='<th align="center" width="40">&nbsp;</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100">'.number_format($tarif, 0, ' ', '.').'</th>';
		$data_table .='<th align="center" width="37">IDR</th>';
		$data_table .='<th align="right" style="font-size: 11px;font-family: franklingothicbook;" width="90">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .='</tr>';	
		$data_table .='</table>';
		/*$tbl = '<table >
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="90"><b>Jenis Jasa</b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="40"><b>Box</b></td>
        				<td align="center" width="40"><b>Size</b></td>
        				<td align="center" width="40"><b>Type</b></td>
        				<td align="center" width="40"><b>STS</b></td>
        				<td align="center" width="40"><b>HZ</b></td>
        				<td align="center" width="40"><b>Hari</b></td>
        				<td align="center" width="50"><b></b></td>
        				<td align="center" width="75"><b>Tarif</b></td>
        				<td align="center" width="27"></td>
        				<td align="right" width="75"><b>Jumlah</b></td>
        			</tr>
        			</table>';*/
		/*$tbl = '<table >
        			<tr>
        				<td align="center" width="20"><b>No</b></td>
        				<td align="center" width="90"><b>Jenis Jasa</b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="40"><b></b></td>
        				<td align="center" width="40"><b>Box</b></td>
        				<td align="center" width="40"><b>Size</b></td>
        				<td align="center" width="40"><b>Type</b></td>
        				<td align="center" width="40"><b>STS</b></td>
        				<td align="center" width="40"><b>HZ</b></td>
        				<td align="center" width="40"><b>Hari</b></td>
        				<td align="center" width="50"><b></b></td>
        				<td align="center" width="40"><b>Tarif</b></td>
        				<td align="center" width="27"></td>
        				<td align="right" width="61"><b>Jumlah</b></td>
        			</tr>
        			</table>';*/
	}

	public function get_data_ruparupa($no_invoice,&$data_table,&$current){
		//data diambil dari trx_line
		$no 		= $data_table->LINE_NUMBER;
		//print_r($no);die;
		$desc 		= $data_table->DESCRIPTION;
		$jml_barang = $data_table->INTERFACE_LINE_ATTRIBUTE2;
		$tarif  	= $data_table->INTERFACE_LINE_ATTRIBUTE8;
		$jumlah 	= $data_table->AMOUNT;

		//print_r($jumlah);die;

		$data_table ='<table border="">';
		$data_table .='<tr>';
		$data_table .='<th align="center" width="20">'.$no.'</th>';
		$data_table .='<th align="left" width="100">'.$desc.'</th>';
		$data_table .='<th align="center" width="260">'.$jml_barang.'</th>';
		$data_table .='<th align="right" width="70">'.$tarif.'</th>';
		$data_table .='<th align="right" width="30">'.$current.'</th>'; //taro disini blum bisa nampil
		$data_table .='<th align="right" width="70">'.number_format($jumlah, 0, ' ', '.').'</th>';
		$data_table .='</tr>';
		$data_table .='</table>';

	}

	public function common_loader($data,$views) {
		/*
		if (! $this->session->userdata('is_login') ){
		 	redirect(ROOT.'main_invoice', 'refresh');
		}
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
		
		//$role_id =  $this->session->userdata('role_id')	;
		//$data['role_child'] = $this->auth_model->get_child_role($role_id);
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
        for ($i = 8; $i <= $baris; ++$i) {
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

                if ($obj->data == 'OK') {
                    ++$jumlah_OK;
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

            if (isset($obj->data->list_req)) {
                for ($i = 0; $i < count($obj->data->list_req); ++$i) {
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

            if (isset($obj->data->list_req)) {
                for ($i = 0; $i < count($obj->data->list_req); ++$i) {
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
                    $cardthermallink = "<a class='btn btn-primary' target='_blank' $disable_card href='".$urlcardthermal.'/'.$row['REQUEST_ID'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'/'.md5($row['REQUEST_ID'])."'><i class='fa fa-file-text-o'></i></a>";
                } else {
                    $cardthermallink = '-';
				}

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
                for ($i = 0; $i < count($obj->data->listreq); ++$i) {
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

        $this->load->view('pages/om/search_main_truck', $data);
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
        for ($i = 2; $i <= $baris; ++$i) {
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

                    if ($obj->data->container) {
                        for ($j = 0; $j < count($obj->data->container); ++$j) {
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

                            if ($obj->data->info) {
                                if ($obj->data->info == 'OK') {
                                    ++$jumlah_OK;
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
            } else {
                $confirmed = '';
			}

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
            if ($obj->data->old_req) {
                for ($i = 0; $i < count($obj->data->old_req); ++$i) {
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

        for ($i = 0; $i < count($alldetail); ++$i) {
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
                for ($i = 0; $i < count($obj->data->html_tcpdf); ++$i) {
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
                    for ($i = 0; $i < count($obj->data->detail_card); ++$i) {
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

                        if ($paid_thru2 != '') {
                            $paid_thru = $paid_thru2.' 23:59';
                        } else {
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

                        ++$nourut;
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
                    for ($i = 0; $i < count($obj->data->detail_card); ++$i) {
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

                        if ($paid_thru2 != '') {
                            $paid_thru = $paid_thru2.' 23:59';
                        } else {
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

                        ++$nourut;
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
        for ($i = 2; $i <= $baris; ++$i) {
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

                    if ($obj->data->container) {
                        for ($j = 0; $j < count($obj->data->container); ++$j) {
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

                            if ($obj->data->info) {
                                if ($obj->data->info == 'OK') {
                                    ++$jumlah_OK;
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

            if ($obj->data->listcont) {
                for ($i = 0; $i < count($obj->data->listcont); ++$i) {
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

	public function masterdkksearch(){
		// $this->load->library('session');
		$postdata = ($_POST);
		$postdata["ORG_ID"] = $this->session->userdata('unit_org');
		$postdata["BRANCH_CODE"] = $this->session->userdata('unit_id');
		// print_r($postdata);die();
		// if($this->input->post('KD_CABANG')){
		$dkk = $this->senddataurl('reviewDKK/',$postdata,'POST');
		/*} else {
			$dkk = $this->senddataurl('reviewDKK/',$postdata,'GET');
			// $dkk = $this->getdataurl('reviewDKK/search/');
		}*/
		// print_r($dkk);die();
		//umar_dkk
		$data = array();
		$no = 1;
		foreach ($dkk as $item) {
			// $pec = explode(" ", date('Y-m-d', strtotime($item->TGL_JAM_BERANGKAT)));
			// $data['data'][$key]->TRX_DATE =  date('Y-m-d', strtotime($value->TRX_DATE));
			$pec = explode(" ",$item->TGL_JAM_BERANGKAT);
			$tgl = date('Y-m-d',strtotime($pec[0]));
			$waktu = $pec[1];
			$row = array();
			$row[] = $no++;
			$row[] = $item->NO_UKK;
			$row[] = $item->KD_PPKB;	
			$row[] = $item->NM_AGEN;
			$row[] = $item->NM_KAPAL;
			$row[] = $tgl;
			$row[] = $waktu;
			$row[] = '<a class="btn btn-sm btn-primary btn-xs print_dpjk btn-ok"  href="javascript:void(0)" data-ukk="'.$item->NO_UKK.'" data-cabang="10" data-branch="'.$item->BRANCH_CODE.'" data-ppkb="'.$item->KD_PPKB.'" data-org="'.$item->ORG_ID.'" data-jamtiba="'.$item->TGL_JAM_TIBA.'" data-jamberangkat="'.$item->TGL_JAM_BERANGKAT.'" title="Cetak DPJK" data-id="'.$item->NO_UKK.'" > <i class="fa fa-print"></i> Preview</a> ';			
			// $row[][$key]->tgl =  date('Y-m-d', strtotime($value->tgl));
			//$row[] = '<a class="btn btn-sm btn-primary btn-xs print_dpjk btn-ok"  href="javascript:void(0)" data-ukk="'.$item->NO_UKK.'" data-cabang="10" data-branch="'.$item->BRANCH_CODE.'" data-ppkb="'.$item->KD_PPKB.'" title="Cetak DPJK" onclick="print_dpjk()" data-id="'.$item->NO_UKK.'" > <i class="fa fa-print"></i> Preview</a> ';
			$data[] = $row;
		}
		$output = array(
				"data" => $data,
		);
		//output to json format
		echo json_encode($output);
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