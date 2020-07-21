<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
require(APPPATH.'helpers/tcpdf/tcpdf.php');
class Payment extends CI_Controller {

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
		//$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
		require_once(APPPATH.'libraries/nusoap_lib.php');
		
		// if (! $this->session->userdata('is_login') ){
				// if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
				// {
					// redirect(ROOT.'mainpage', 'refresh');
				// }		
			// }
        $this->API=API_EINVOICE;
	}

	protected function getdataurl($url)
	{
		//$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
		$uri = API_EINVOICE . '/' . $url;
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		// $data = json_decode(curl_exec($ch));
		// return $data;
		$ex = curl_exec($ch);
		/*if (preg_match("/OK/i", $ex)) {
		        $result = "curl sukses! (OUTPUT: ".$ex.")";
		    } else {
		        $result = "curl gagal! (OUTPUT: ".$ex.")";
		    }

		echo $result; exit;*/
		$result  = json_decode($ex);
		return $result;
	}

	protected function senddataurl($url,$data,$type){
		//echo API_EINVOICE; exit;
		//$uri = $this->API.'/'.$url; //HTTP://localhost/invoiceapi/index.php/invh
		$uri = API_EINVOICE.'/'.$url;
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
		// $result  = json_decode(curl_exec($ch));
		$ex = curl_exec($ch);

		/*if (preg_match("/OK/i", $ex)) {
			$result = "curl sukses! (OUTPUT: ".$ex.")";
		} else {
			$result = "curl gagal! (OUTPUT: ".$ex.")";
		}

		echo $result; die;*/
		/*file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
		 array(
			 "body" => $ex,
			 "url" => $uri,
			 "data" => $data,
	 ),true), FILE_APPEND);*/

		 $result  = json_decode($ex);
	
	return $result;
		//    echo $result;

	}

	function paymentsearch(){
		$postdata = ($_POST);
		// var_dump($postdata); die();
		$layanan = array(
							"KPL"=> "KAPAL",
							"BRG"=> "BARANG",
							"RUPA"=> "RUPA RUPA",
							"PTKM"=> "PETIKEMAS",
						);
		//print_r($postdata);die();
		$data = array(
				'data' => array()
			);
		$jenisNota = $this->getMstNota($postdata['LAYANAN']);
		$start = !empty($_POST['start']) ? $_POST['start'] : 0;
		$length = !empty($_POST['length']) ? $_POST['length'] : 10;
		$draw = !empty($_POST['draw']) ? $_POST['draw'] : 0;
		$postdata["offset"] = $start + $length;
		$num = 1;
		// var_dump($postdata); die();

		//print_r($jenisNota);die;
		 if ($postdata['LAYANAN'] == "PTKM") {
			//print_r($postdata);die();
			$arrayData = $this->senddataurl('Payment/search/',$postdata,'POST');
			//echo "aaa"; die();
            //print_r($arrayData);die();
			foreach ($arrayData as $key => $value) {
				$data['data'][$key] = $value;
				// print_r($value->ID_REQ."hhhh");
				$statusL = "LUNAS";
				if (isset($value->STATUS) && ($value->STATUS == "S" || $value->STATUS == "N")) {
					$statusL = "BELUM LUNAS";
				}
				$tot = (strpos($value->TOTAL, ",") == '') ? number_format($value->TOTAL, 0, ',', ',') : $value->TOTAL;
				$data['data'][$key]->TTL = $tot;
				if (empty($data['data'][$key]->LAYANAN)) {
					$data['data'][$key]->LAYANAN = $value->KET;
				}
				/*$data['data'][$key]->LAYANAN = $value->KET;*/
				$data['data'][$key]->STAT = $statusL;
				$data['data'][$key]->NAMAKAPAL = $value->VESSEL;
				$data['data'][$key]->TGLKEGIATAN = $value->INTERFACE_HEADER_ATTRIBUTE6;
				$data['data'][$key]->TGL_SIMPAN = $value->TGL_SIMPAN;//date('Y-m-d', strtotime($value->TGL_SIMPAN));
				$data['data'][$key]->num = $num;
				$data['data'][$key]->action = '<button type="button-warning" class="btn btn-link" onclick="paymentupdate(' . "'" . $value->ID_NOTA . "'" . ')" ><i class="fa fa-money fa-2x yellow" ></i></button>';
				$num++;
			}
			# code...
		} 
		// elseif(($postdata['LAYANAN'] == "BRG") || ($postdata['LAYANAN'] == "KPL") || ($postdata['LAYANAN'] == "RUPA")) {
		else {
			$num = 1 + $start;
			
			$postdata['BILLER_REQUEST_ID'] = $postdata['ID_NOTA'];
			$postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');
			$arrayData = $this->senddataurl('InvoiceHeader/search/', $postdata, 'POST');

			foreach ($arrayData->data as $key => $value) {
				$data['data'][$key] = $value;
				$statusL = "BELUM LUNAS";
				if (isset($value->STATUS) && $value->STATUS != null) {
					$statusL = "LUNAS";
				}
				$pratot = $value->AMOUNT - $value->UANG_JAMINAN;
				$tot = (strpos($pratot, ",") == '') ? number_format($pratot, 0, ',', ',') : $pratot;//(strpos($value->AMOUNT, ",") == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT;
				$data['data'][$key]->TTL = $tot;
				$data['data'][$key]->STAT = $statusL;
				$data['data'][$key]->num = $num;
				$data['data'][$key]->TGL_SIMPAN = $value->TGL_SIMPAN;//date('Y-m-d', strtotime($value->TGL_SIMPAN));
                // START PENAMBAHAN GRID ID_REQ BY SIGMA 11/11/19
                if ($postdata['LAYANAN'] == "RUPA" && $value->HEADER_SUB_CONTEXT == "RUPA15" || $postdata['LAYANAN'] == "KPL") {
                    $data['data'][$key]->ID_REQ = $value->INTERFACE_HEADER_ATTRIBUTE6;
                } else {
                    $data['data'][$key]->ID_REQ = "-";
                }
                // STOP PENAMBAHAN GRID ID_REQ BY SIGMA 11/11/19
				$data['data'][$key]->MODUL = $layanan[$value->HEADER_CONTEXT];
				if ($postdata['LAYANAN'] == "KPL") {
					$namakapal = $value->VESSEL_NAME;
					$tanggalkegiatan = $value->INTERFACE_HEADER_ATTRIBUTE4;
				} elseif($postdata['LAYANAN'] == "BRG") {
					$namakapal = (($value->VESSEL_NAME) == NULL ? (($value->INTERFACE_HEADER_ATTRIBUTE2) == NULL ? '-' : $value->INTERFACE_HEADER_ATTRIBUTE2) : $value->VESSEL_NAME);
					$tanggalkegiatan = (($value->PER_KUNJUNGAN_FROM) == NULL ? '-' : $value->PER_KUNJUNGAN_FROM).' s.d '.(($value->PER_KUNJUNGAN_TO) == NULL ? '-' : $value->PER_KUNJUNGAN_TO);
				} else {
					$namakapal = $value->INTERFACE_HEADER_ATTRIBUTE1;
					$tanggalkegiatan = $value->INTERFACE_HEADER_ATTRIBUTE9;
				}
				$data['data'][$key]->NAMAKAPAL = $namakapal;
				$data['data'][$key]->TGLKEGIATAN = $tanggalkegiatan;
				// $data['data'][$key]->LAYANAN = "PENUMPUKAN";
				$data['data'][$key]->action = '<button type="button-warning" class="btn btn-link" onclick="paymentupdate(' . "'" . $value->ID_NOTA . "'" . ')" ><i class="fa fa-money fa-2x yellow" ></i></button>';
				if (isset($jenisNota[$value->HEADER_SUB_CONTEXT])) {
					$data['data'][$key]->LAYANAN = $jenisNota[$value->HEADER_SUB_CONTEXT];
				} else {
					$data['data'][$key]->LAYANAN = "-";
				}
				// $data['data'][$key]['action'] = "action";
				$num++;
			}
			$dataTableArr = array(
				"draw" => intval($draw),
				"recordsTotal" => intval($arrayData->recordsTotal),
				"recordsFiltered" => intval($arrayData->recordsTotal),
			);
			$data = array_merge($dataTableArr, $data);
		}
		echo json_encode($data);
	}


	function getMstNotaList($codeNota)
	{
		$paramNota = "";
		$notaJenis = $this->getdataurl('mstnota/getData/' . $codeNota);
		echo json_encode($notaJenis);
	}

	function getMstNota($codeNota)
	{
		$jenisNota = array();
		$notaJenis = $this->getdataurl('mstnota/getData/' . $codeNota);
		foreach ($notaJenis as $key => $value) {
			$jenisNota[$value->INV_NOTA_CODE] = $value->INV_NOTA_JENIS;
		}
		return $jenisNota;
	}

   function ESBGetDataBankSimkeu()
    {
        $micro_date = microtime();
        $date_array = explode(" ",$micro_date);
        $date = date("Y-m-d H:i:s",$date_array[1]);
        $date_now =  $date . $date_array[0];
		$OrgID = json_decode($this->session->userdata('unit_org'));
			
		
        $esbHeader = array(
            "externalId" => "23948274",
            "timestamp" => $date_now
        );

        $esbBody = array("orgId" => $OrgID[0]);

        $BankRequestData = array("esbHeader" => $esbHeader, "esbBody" => $esbBody);
        $data = array("inquiryDataBankRequest" => $BankRequestData);

        $jsondata = json_encode($data);
        //$response = $this->ESBGet($jsondata,"http://10.88.48.57:5555/restv2/inquiryData/bank/simkeu");
        $response = $this->ESBGet($jsondata,ESB_API."inquiryData/bank/simkeu");
		

        return $response;
    }

	function ESBGet($data,$url)
    {

        $username = "billing";
        $password = "b1Llin9";

        $curl = curl_init($url);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "$data",
            CURLOPT_HTTPAUTH => CURLAUTH_ANY,
            CURLOPT_USERPWD => "$username:$password",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $responesnya = "cURL Error #:" . $err;
        } else {
            $responesnya = $response;
        }

        return $responesnya;
    }

	
	function paymentcash(){	
		// echo "<pre>"; print_r($this->session->userdata); exit;
		$param = ($_POST);
		$postdata = array('INV_SOURCE_ID' => '');
		// print_r($postdata);die;

		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);

		$data['nota']  =  $this->getdataurl('mstnota/dropdown/INV_NOTA_CODE');
		$data['nota']  =  $this->getdataurl('mstnota/dropdown/INV_NOTA_JENIS');	
		//$data['nota1']  =  $this->getdataurl('mstnota/dropdown/INV_NOTA_JENIS');
		$data['nota1']  =  $this->getdataurl('mstnota/dropdown/INV_NOTA_LAYANAN');
			
		$data['bank']  =  $this->senddataurl('bank/search/',$postdata,'POST');		
		$data['bank']  =  $this->getdataurl('bank');

		$this->common_loader($data,'invoice/payment/paymentcash/paymentcash');		

		//print_r($data['nota']);die;
		
		// echo "nampil 4";
	}

	function paymentedit()
	{
		// $id=$_POST['ID_NOTA'];
		$postdata = ($_POST);
		// var_dump($postdata); die();
		$postdata['UNIT_CODE'] = $this->session->userdata('unit_id');
		$postdata['ORG_ID'] = $this->session->userdata('unit_org');
		// print_r($postdata);die();
		// $data  =  $this->getdataurl('payment/'.$id);
		$data = $this->senddataurl('payment/getedit/', $postdata, 'POST');			
		// $data  =  $this->senddataurl('payment/search/',$postdata,'POST');	
		// print_r($data[0]->layanan);die;
		// $id_nota=json_encode($data);
		if (empty($data[0]->LAYANAN)) {
			$data[0]->LAYANAN = $data[0]->KET;
		}
		echo json_encode($data);
	}
	function paymenteditBarang()
	{
		$id = $_POST['ID_NOTA'];
		$layanan = array(
			"KPL" => "KAPAL",
			"BRG" => "BARANG",
			"RUPA" => "RUPA RUPA",
			"PTKM" => "PETIKEMAS",
		);
		// $postdata = ($_POST);	
		// print_r($postdata);die;
		$arrayData = $this->getdataurl('InvoiceHeader/' . $id);

		$data = $arrayData->data;
		$jenisNota = $this->getMstNota($data[0]->HEADER_CONTEXT);
		// $data  =  $this->senddataurl('payment/search/',$postdata,'POST');	
		// print_r($data);die;
		// $id_nota=json_encode($data);
		$data[0]->ID_REQ = "-";
		$data[0]->ORG_ID = $data[0]->ORG_ID;
		$data[0]->KD_MODUL = $jenisNota[$data[0]->HEADER_SUB_CONTEXT];
		
		/* 20180927 3ono */
		if ($data[0]->HEADER_CONTEXT == 'KPL') {
			$MDL_DESC = 'KAPAL';
		} elseif ($data[0]->HEADER_CONTEXT == 'BRG') {
			$MDL_DESC = 'BARANG';
		} elseif ($data[0]->HEADER_CONTEXT == 'RUPA') {
			$MDL_DESC = 'RUPA RUPA';
		} elseif ($data[0]->HEADER_CONTEXT == 'PTKM') {
			$MDL_DESC = 'PETIKEMAS';
		} else {
			$MDL_DESC = '-';
		}
		/*****************************/
		
		$data[0]->KD_MODUL = $MDL_DESC;
		if (isset($jenisNota[$data[0]->HEADER_SUB_CONTEXT])) {
			$data[0]->LAYANAN = $jenisNota[$data[0]->HEADER_SUB_CONTEXT];
		} else {
			$data[0]->LAYANAN = "-";
		}
		// $data[0]->LAYANAN = "PENUMPUKAN";
		$data[0]->TOTAL = $data[0]->AMOUNT - $data[0]->UANG_JAMINAN;//$data[0]->AMOUNTBAYAR;
		$data[0]->tot = $data[0]->AMOUNT - $data[0]->UANG_JAMINAN;
		echo json_encode($data);
	}
	function paymentGetBank()
	{
		$postdata = $_POST;
		// echo $this->session->userdata('unit_id');echo $this->session->userdata('unit_id');die();
		$unt_id = json_decode($this->session->userdata('unit_id'),true);
		if($unt_id[0] == 'ITPK')
		{
			$uc = 'TPK';
		}
		else
		{
			$uc = $this->session->userdata('unit_id');
		}
		$postdata['UNIT_CODE'] = $uc;//$this->session->userdata('unit_id');
		$postdata['ORG_ID'] = $this->session->userdata('unit_org');
		$postdata['CURRENCY'] = "IDR";
		// echo print_r($this->session->all_userdata();die();
		// $postdata['KD_CABANG'] = 10;
		// print_r($this->session);die();
		$layanan = array(
			"KPL" => "KAPAL",
			"BRG" => "BARANG",
			"RUPA" => "RUPA RUPA",
			"PTKM" => "PETIKEMAS",
		);
		

		/*ubah get bank dr CI ke ESB. Derry Othman 28 Okt 2019*/		
		$GetBank = $this->ESBGetDataBankSimkeu();
	    $GetDataBank = json_decode($GetBank, true);
		$dataBank = $GetDataBank['inquiryDataBankResponse']['esbBody']['dataBank'];
		
		/*
		if ($postdata['LAYANAN'] == "PTKM" || $postdata['LAYANAN'] == "PETIKEMAS") {
			// $arrayData  =  $this->getdataurl('bank');
			$arrayData = $this->senddataurl('bank/searchPTKM/', $postdata, 'POST');
		} else {
			$arrayData = $this->senddataurl('bank/searchKapal/', $postdata, 'POST');
		}
		*/
		
		//echo json_encode($arrayData);
		echo json_encode($dataBank);
	}

	function gettoken()

	{
		echo '1234';
		die;
		echo $this->security->get_csrf_token_name();
		echo $this->security->get_csrf_hash();
	}

	function paymentsave()
	{
		$data = ($_POST);
		//var_dump($data);die();	
		// $result = $this->senddataurl('payment/',$data,'PUT');
		//$urlnya = APP_ROOT."wsdl/eServiceInquiry.wsdl";
		$id_nota = $data['ID_NOTA'];
		$nconSEEBM = preg_replace('/[^A-Za-z0-9\  ]/', '', $id_nota);
		$GET_LAYANAN = substr($nconSEEBM,8,2);
		$id_nota = $data['ID_NOTA'];
		$id_req = $data['ID_REQ'];
		$layanan_lini2 = $data['LAYANAN'];
		// var_dump($layanan_lini2); die();
		$unit_code = json_decode($data['UNIT_CODE']);
		// if(empty($data['RECEIPT_ACCOUNT'])){
		// 	$bank_account ="0";
		// }else{
		$bank_account = $data['RECEIPT_ACCOUNT'];
		// }
		$bank_nm = $data['RECEIPT_METHOD'];
		$user = $this->session->userdata('user_id');
		$paiddate = date("dmYHi");
		$unit_code = json_decode($this->session->userdata('unit_id'));
		$comments = $data['COMMENTS'];
		$cms_yn = $data['CMS_YN'];
		$tgl_terima = $data['TANGGAL_TERIMA'];
		$norekkoran = $data['NOREK_KORAN'];
		$channel_type = $data['RECEIPT_ACCOUNT2'];
		$in_data = array(
			"trxnumber" => "$id_nota",
			"userid" => "$user"
		);
		$in_data_lini2  = array("noreq" => "$id_req");
			//print_r($in_data);die();
		$in_datapaid = array(
			"trxnumber" => "$id_nota",
			"userid" => "$user",
			"bankid" => "$bank_account",	//uda jalan
			"paiddate" => "$paiddate",
			"paidchannel" => "$bank_nm",
			"comments" => "$comments",
			"cms_yn" => "$cms_yn",
			"tgl_terima" => "$tgl_terima",
			"norekkoran" => "$norekkoran",
		);
		//print_r(PAYMENTCASH_INQUIRY); die();
		$in_datapaid_lini2 = array(
			"noreq" => "$id_req",
			"jenisnota" => "$layanan_lini2",
			"nm_user" => "$user",
			"bank" => "$bank_account",	//uda jalan
			"tgl_bayar" => "$paiddate",
			// "paidchannel" => "$bank_nm",
			"no_struk" => " ",
			"apv_code" => " ",
			"channel_type" => "$channel_type",
			"cms_yn" => "$cms_yn",
			"tgl_terima" => "$tgl_terima",
			"norekkoran" => "$norekkoran",
		);

		$rest = substr($id_nota, 4,3);
		if ($rest == '831' && ($layanan_lini2 == 'HCS' || $layanan_lini2 == 'BHD' || $layanan_lini2 == 'DLV' || $layanan_lini2 == 'BHD'))
		 {
		$client = new nusoap_client(PAYMENTCASH_INQUIRY_LINI2);
		$error = $client->getError();
		if ($error) {
			echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
		}
		$result = $client->call("edcInquery", $in_data_lini2); //print_r($in_data);die(); //uda JALAN
		if ($client->fault) {
		    // echo "<h2>Fault Inquiry</h2><pre>";
		    // echo "</pre>";
			$data1 = array("status" => "failure Client Fault");
		} else {
			$error = $client->getError();
			if ($error) {
				echo "<h2>Error edcInquery</h2><pre>" . $error . "</pre>";
				$data1 = array("status" => "failure ");
		    // print_r($result);
			} else {
				$result = explode("^", $result);
				$response_codeInquiri = $result[1];
				$response_messageInquiri = $result[2];
				if ($response_codeInquiri == "00")  {
					$result2 = $client->call("edcPayment", $in_datapaid_lini2);
					//var_dump($result2); die();
					if ($client->fault) {
					    // echo "<h2>Fault Inquiry</h2><pre>";
					    // print_r($result2);
					    // echo "</pre>";
						$data1 = array("status" => "failure edcPayment", "message" => "error");
					} else {
						$error = $client->getError();
						if ($error) {
							$data1 = array("status" => "failure Client", "message" => "error");
					        // echo "<h2>Error Inquiry Paid</h2><pre>" . $error . "</pre>";
						} else {
					        // echo "<h2>Inquiry Pay</h2><pre>";
					         // echo $result."---".$result2;
					        // echo "</pre>";
							$result2 = explode("^", $result2);
							$response_codePay = $result2[1];
							$response_messagePay = $result2[2];
							// echo $response_codeInquiri."---".$response_codePay;
							if ($response_codePay == "00") {
								$data1 = array("status" => "success", "message" => "Data Saved");
							} else {
								$data1 = array("status" => "failure", "message" => $response_messagePay);
							}
						}
					}
				} else {
					$data1 = array("status" => "failure", "message" => $response_messageInquiri);
				}
			}
		}
		 }  /*else{
			$client = new nusoap_client(PAYMENTCASH_INQUIRY); */
	else if($GET_LAYANAN =='70' || $GET_LAYANAN =='62')
	{
		$in_datapaid_SEEBM = array(
				"RECEIPT_NUMBER" => $data['ID_NOTA'],
				"USER_ID" => "$user",
				"BANK_ID" => $data['BANK_ID'],
				"PAIDDATE" => date("d-M-Y"),
				"RECEIPT_METHOD" => $data['RECEIPT_METHOD'],
				"RECEIPT_ACCOUNT2" => $data['RECEIPT_ACCOUNT2'],
				"COMMENTS" => $data['COMMENTS'],
				"CMS_YN" => $data['CMS_YN'],
				"TANGGAL_TERIMA" => $data['TANGGAL_TERIMA'],
				"REMARK_TO_BANK_ID" => $data['REMARK_TO_BANK_ID'],
				"RECEIPT_ACCOUNT" => $data['RECEIPT_ACCOUNT'],
				"NOREK_KORAN" => $data['NOREK_KORAN'],
			);		
			
		$result = $this->senddataurl('SimopReceiptHeader/SEEBM/', $in_datapaid_SEEBM, 'POST');
		$checkstat = json_decode(json_encode($result), True);
		//print_r($checkstat['status']);die;
		if($checkstat['status'] == 'S' || $checkstat[0]['status'] == 'S' || $result == 'S' || $result == NULL)
		{
			$data1 = array("status" => "success", "result" => $result, "success", "message" => "Data Saved");
		}
		else
		{
			$data1 = array("status" => "failure", "result" => $result, "message" => "Data Not Saved");
		}	
		
	}
	else
	{
			
			$ncon = preg_replace('/[^A-Za-z0-9\  ]/', '', $id_nota);
			$pID_NOTA = substr($ncon,0,6);
			
			if($pID_NOTA =='010013' || $pID_NOTA =='010822' || $pID_NOTA =='010012' || $pID_NOTA =='010812' || $pID_NOTA =='010811' || $pID_NOTA =='010013' || $pID_NOTA =='010011')
			{
				$client = new nusoap_client(PAYMENTCASH_INQUIRY_ITOS123);	
			}
			else if($pID_NOTA =='010010' || $pID_NOTA =='010821')
			{
				$client = new nusoap_client(PAYMENTCASH_INQUIRY_OPUST3);	
			}		
			else
			{
				$client = new nusoap_client(PAYMENTCASH_INQUIRY);
			}
		// var_dump($client2); die();
		//print_r(PAYMENTCASH_INQUIRY); die(); //http://localhost/ePaymentService_Dev/ipcPortal.php
		// $result = $client->call("edcInquery", $in_data_lini2); 
		$error = $client->getError();
		if ($error) {
			echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
		}
		$result = $client->call("ePaymentInquiry", $in_data); //print_r($in_data);die(); //uda JALAN
		if ($client->fault) {
		    // echo "<h2>Fault Inquiry</h2><pre>";
		    // echo "</pre>";
			$data1 = array("status" => "failure Client Fault");
		} else {
			$error = $client->getError();
			if ($error) {
				$result = explode("^", $result);
				$response_codeInquiri = $result[1];
				echo "<h2>Error Inquiry</h2><pre>" . $error . "   ".$response_codeInquiri."</pre>";
				$data1 = array("status" => "failure ");
		    // print_r($result);
			} else {
				$result = explode("^", $result);
				$response_codeInquiri = $result[1];
				$response_messageInquiri = $result[2];
				if ($response_codeInquiri == "00") {
					$result2 = $client->call("ePaymentPaid", $in_datapaid);
					if ($client->fault) {
					    // echo "<h2>Fault Inquiry</h2><pre>";
					    // print_r($result2);
					    // echo "</pre>";
						$data1 = array("status" => "failure ePaymentPaid", "message" => "error");
					} else {
						$error = $client->getError();
						if ($error) {
							$data1 = array("status" => "failure Client", "message" => "error");
					        // echo "<h2>Error Inquiry Paid</h2><pre>" . $error . "</pre>";
						} else {
					        // echo "<h2>Inquiry Pay</h2><pre>";
					         // echo $result."---".$result2;
					        // echo "</pre>";
							$result2 = explode("^", $result2);
							$response_codePay = $result2[1];
							$response_messagePay = $result2[2];
							// echo $response_codeInquiri."---".$response_codePay;
							if ($response_codePay == "00") {
								$data1 = array("status" => "success", "message" => "Data Saved");
							} else {
								$data1 = array("status" => "failure", "message" => $response_messagePay);
							}
						}
					}
				} else {
					$data1 = array("status" => "failure", "message" => $response_messageInquiri);
				}
			}
		}

	}
		$postlognota = array(
			"TRX_NUMBER" => $id_nota,
			"ACTIVITY" => "PAYMENT",
			"JENIS_PAYMENT" => "INVOICE",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		/*print_r($postlognota);die();*/
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');
		// echo "<h2>Request</h2>";
		// echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
		// echo "<h2>Response</h2>";
		// echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
		echo json_encode($data1);
	}
	function paymentsaveConsolidasi()
	{
		$postdata = ($_POST);
		$_POST['RECEIPT_ACCOUNT'] = $_POST['RECEIPT_ACCOUNT2'];
		// print_r($postdata);die();
		$result = $this->senddataurl('CreateReceiptSimop/', $postdata, 'POST');
		echo json_encode($result);
		$postlognota = array(
			"TRX_NUMBER" => $postdata['RECEIPT_NUMBER'],
			"ACTIVITY" => "PAYMENT",
			"JENIS_PAYMENT" => "INVOICE",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota/', $postlognota, 'POST');
		
		//echo json_encode($result);
		
		/*$postdata = ($_POST);
		$id=$_POST['ID_NOTA'];
		$bulan  = array("","Jan", "Feb", "Mar", "Apr", "May", "Jun",
							"Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		// $postdata = ($_POST);	dwadwad
		// print_r($postdata);die;
		$dateD = date("d");  
		$dateM = $bulan[date("n")];  
		$dateY = date("Y");  
		$data  =  $this->getdataurl('InvoiceHeader/detail/'.$id);	
		$insertParam['ORG_ID'] = $data->ORG_ID;	
		$insertParam['RECEIPT_NUMBER'] = $postdata['ID_NOTA'];	
		$insertParam['RECEIPT_METHOD'] = $postdata['RECEIPT_METHOD'];	
		$insertParam['RECEIPT_ACCOUNT'] = $postdata['RECEIPT_ACCOUNT'];	
		$insertParam['BANK_ID'] = $postdata['RECEIPT_ACCOUNT'];	
		$insertParam['CUSTOMER_NUMBER'] = $data->CUSTOMER_NUMBER;	
		$insertParam['RECEIPT_DATE'] = $dateD."-".$dateM."-".$dateY;	
		$insertParam['CURRENCY_CODE'] = $data->CURRENCY_CODE;	
		$insertParam['STATUS'] = $data->STATUS;	
		$insertParam['AMOUNT'] = $data->AMOUNT;	
		$insertParam['PROCESS_FLAG'] = $data->PROCESS_FLAG;	
		$insertParam['ERROR_MESSAGE'] = $data->ERROR_MESSAGE;	
		$insertParam['API_MESSAGE'] = $data->API_MESSAGE;	
		$insertParam['ATTRIBUTE_CATEGORY'] = $data->ATTRIBUTE_CATEGORY;	
		$insertParam['REFERENCE_NUM'] = $data->REFERENCE_NUM;	
		$insertParam['RECEIPT_TYPE'] = $data->RECEIPT_TYPE;	
		$insertParam['RECEIPT_SUB_TYPE'] = $data->RECEIPT_SUB_TYPE;	
		$insertParam['CREATED_BY'] = $data->CREATED_BY;	
		$insertParam['CREATION_DATE'] = $data->CREATION_DATE;	
		$insertParam['TERMINAL'] = $data->TERMINAL;	
		$insertParam['ATTRIBUTE1'] = $data->ATTRIBUTE1;	
		$insertParam['ATTRIBUTE2'] = $data->ATTRIBUTE2;	
		$insertParam['ATTRIBUTE3'] = $data->ATTRIBUTE3;	
		$insertParam['ATTRIBUTE4'] = $data->ATTRIBUTE4;	
		$insertParam['ATTRIBUTE5'] = $data->ATTRIBUTE5;	
		$insertParam['ATTRIBUTE6'] = $data->ATTRIBUTE6;	
		$insertParam['ATTRIBUTE7'] = $data->ATTRIBUTE7;	
		$insertParam['ATTRIBUTE8'] = $data->ATTRIBUTE8;	
		$insertParam['ATTRIBUTE9'] = $data->ATTRIBUTE9;	
		$insertParam['ATTRIBUTE10'] = $data->ATTRIBUTE10;	
		$insertParam['ATTRIBUTE11'] = $data->ATTRIBUTE11;	
		$insertParam['ATTRIBUTE12'] = $data->ATTRIBUTE12;	
		$insertParam['ATTRIBUTE13'] = $data->ATTRIBUTE13;	
		$insertParam['ATTRIBUTE14'] = $data->ATTRIBUTE14;	
		$insertParam['ATTRIBUTE15'] = $data->ATTRIBUTE15;	
		$insertParam['STATUS_RECEIPT'] = $data->STATUS_RECEIPT;	
		$insertParam['SOURCE_INVOICE'] = $data->SOURCE_INVOICE;	
		$insertParam['STATUS_RECEIPTMSG'] = $data->STATUS_RECEIPTMSG;	
		$insertParam['INVOICE_NUM'] = $data->INVOICE_NUM;	
		$insertParam['AMOUNT_ORIG'] = $data->AMOUNT_ORIG;	
		$insertParam['LAST_UPDATE_DATE'] = $data->LAST_UPDATE_DATE;	
		$insertParam['LAST_UPDATED_BY'] = $data->LAST_UPDATED_BY;	
		$insertParam['BRANCH_CODE'] = $data->BRANCH_CODE;	
		$insertParam['BRANCH_ACCOUNT'] = $data->BRANCH_ACCOUNT;	
		$insertParam['SOURCE_INVOICE_TYPE'] = "BRG";	
		$insertParam['REMARK_TO_BANK_ID'] = $data->REMARK_TO_BANK_ID;	
		$insertParam['SOURCE_SYSTEM'] = $data->SOURCE_SYSTEM;	
		// print_r($insertParam);die;
		// $result = $this->senddataurl('payment/',$data,'PUT');
		//$urlnya = APP_ROOT."wsdl/eServiceInquiry.wsdl";

		// $id_nota = $data['ID_NOTA'];
		$result = $this->senddataurl('InvoiceHeader/pay/',$insertParam,'POST');
		
		// echo "34";
		echo json_encode($result);*/
	}

	function upersearch()
	{
		$postdata = ($_POST);
		$data2 = array(
			'data' => array()
		);
		$num = 1;

		// $layanan_select = $_POST['LAYANAN'];
		// $status_select = $_POST['STATUS_LUNAS'];
		// $nomor_entri = $_POST['NO_UPER'];
		if ($postdata['LAYANAN'] == 'PETIKEMAS') {
			$data = $this->senddataurl('Uper/search/', $postdata, 'POST');
			foreach ($data as $key => $value) {
				$data2['data'][$key] = $value;
				$statusL = "LUNAS";
				$kapallaut = $value->ATTRIBUTE8;
				$tglkegiatan = $value->ATTRIBUTE9;				
				if (isset($value->STATUS) && $value->STATUS == "N") {
					$statusL = "BELUM LUNAS";
					$kapallaut = $value->VESSEL;
					$tglkegiatan = "-";				
				}
				$enable1 = "";
				$enable2 = "";
				if ($value->STATUS == "P") {
					$enable1 = "hide";
					$enable2 = "";
				} else {
					$enable1 = "";
					$enable2 = "hide";
				}
				$enc_trx_number = $this->mx_encryption->encrypt($value->NO_UPER);
				$tot = (strpos($value->TOTAL, ",") == '') ? number_format($value->TOTAL, 0, ',', ',') : $value->TOTAL;
				$data2['data'][$key]->TTL = $tot;
				$data2['data'][$key]->STAT = $statusL;
				$data2['data'][$key]->num = $num;
				$data2['data'][$key]->NAMAKAPAL = $kapallaut;
				$data2['data'][$key]->TGLKEGIATAN = $tglkegiatan;
				$data2['data'][$key]->PPKBKE = "-";
				$data2['data'][$key]->TGL_SIMPAN = $value->TGL_SIMPAN;//date('Y-m-d', strtotime($value->TGL_SIMPAN));
				$data2['data'][$key]->action = '<button type="button" class="btn-warning btn-link ' . $enable1 . '" onclick="paymentupdate(' . "'" . $value->NO_UPER . "'" . ')" ><i class="fa fa-money fa-2x " ></i></button><a target="_blank" class="btn btn-primary ' . $enable2 . '" href="' . ROOT . 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number . '"> <i class="fa fa-print" ></i></a>';
				// $data['data'][$key]['action'] = "action";
				$num++;
			}
		} elseif ($postdata['LAYANAN'] == 'KAPAL') {
			if ($postdata['STATUS_LUNAS'] == "P") {
				$data = $this->senddataurl('invh/searcUpr/', $postdata, 'POST');
				$statusL = "LUNAS";
				// $data = '{data:[]}';
				$num1 = 1;
				foreach ($data as $key => $value) {
					$data2['data'][$key] = $value;

					$enable1 = "hide";
					$enable2 = "";
					$ppkb_ke = substr($value->RECEIPT_NUMBER, 0, -1);
						// $value->PPKB_KE
					$tot = (strpos($value->AMOUNT, ",") == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT;
					$data2['data'][$key]->NO_UPER = $value->RECEIPT_NUMBER;
					$data2['data'][$key]->num = $num1;
					$data2['data'][$key]->MODUL = "KAPAL";
					$data2['data'][$key]->TGL_SIMPAN = $value->RECEIPT_DATE;
					if($value->ATTRIBUTE3 == NULL)
					{
						$lol=$value->CUSTOMER_NUMBER;
					}
					else
					{
						$lol=$value->ATTRIBUTE3;
					}
					$enc_trx_number = $this->mx_encryption->encrypt($value->RECEIPT_NUMBER);
					$data2['data'][$key]->EMKL = $lol;
					$nama_kapal = $value->ATTRIBUTE8 == NULL ? '' : $value->ATTRIBUTE8;
					$tgl_kegiatan = $value->ATTRIBUTE9 == NULL ? '' : $value->ATTRIBUTE9;
					$data2['data'][$key]->NAMAKAPAL = $nama_kapal;
					$data2['data'][$key]->TGLKEGIATAN = $tgl_kegiatan;
					$data2['data'][$key]->TTL = $tot;
					$data2['data'][$key]->STAT =/* $value->KD_PPKB_STATUS */ $statusL;
					$data2['data'][$key]->PPKBKE = $ppkb_ke;
					$data2['data'][$key]->TGL_SIMPAN = $value->RECEIPT_DATE;//date('Y-m-d', strtotime($value->RECEIPT_DATE));
					$data2['data'][$key]->action = '<button type="button" class="btn-warning btn-link ' . $enable1 . '" onclick="paymentupdate(' . "'" . $value->KD_PPKB . "'" . ')" ><i class="fa fa-money fa-2x " ></i></button><a target="_blank" class="btn btn-primary ' . $enable2 . '" href="' . ROOT . 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number . '"> <i class="fa fa-print" ></i></a>';
							// $data['data'][$key]['action'] = "action";
					$num1++;
				}
			} else {
				$data = $this->senddataurl('CreateUperKapal/search/', $postdata, 'POST');
				$statusL = "BELUM LUNAS";
				$num1 = 1;
				foreach ($data as $key => $value) {
					$data2['data'][$key] = $value;
					// $no_uper = $value->NO_UPER;
					// $arrayData = $this->senddataurl('invh/searcUpr/',$postdata,'POST');
					// foreach ($arrayData as $data_uper) {
					// 	$dataUper = $data_uper->RECEIPT_NUMBER;
					// }
					$enable1 = "";
					$enable2 = "hide";
						// if ($value->STATUS=="P"){
						// 	$enable1="hide";
						// 	$enable2="";
						// } else {
						// 	$enable1="";
						// 	$enable2="hide";
						// }
						// $tot = number_format(10000,0,",",".");
					$tot = (strpos($value->JUMLAH_UPER, ",") == '') ? number_format($value->JUMLAH_UPER, 0, ',', ',') : $value->JUMLAH_UPER;
						// $data2['data'][$key]->NO_UPER = $value->KD_PPKB;
					$enc_trx_number = $this->mx_encryption->encrypt($value->NO_UPER);
					$data2['data'][$key]->num = $num1;
					$data2['data'][$key]->MODUL = "KAPAL";
					$data2['data'][$key]->TGL_SIMPAN = $value->TGL_JAM_ENTRY;
					$data2['data'][$key]->NAMAKAPAL = $value->NM_KAPAL;
					$data2['data'][$key]->TGLKEGIATAN = $value->PERIODE_KUNJUNGAN;
					$data2['data'][$key]->EMKL = $value->NM_AGEN;
					$data2['data'][$key]->TTL = $tot;
					$data2['data'][$key]->STAT =/* $value->KD_PPKB_STATUS */ $statusL;
					$data2['data'][$key]->PPKBKE = $value->PPKB_KE;
					$data2['data'][$key]->TGL_SIMPAN = $value->TGL_SIMPAN;//date('Y-m-d', strtotime($value->TGL_SIMPAN));
					$data2['data'][$key]->action = '<button type="button" class="btn-warning btn-link ' . $enable1 . '" onclick="paymentupdate(' . "'" . $value->NO_UPER . "'" . ')" ><i class="fa fa-money fa-2x " ></i></button><a target="_blank" class="btn btn-primary ' . $enable2 . '" href="' . ROOT . 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number . '"> <i class="fa fa-print" ></i></a>';
							// $data['data'][$key]['action'] = "action";
					$num1++;

				}
			}
		} elseif ($postdata['LAYANAN'] == 'BARANG') {
			/*$postdata = ($_POST);
			// print_r($postdata);die();
			// $postdata['KD_PPKB'] = $postdata['ID_NOTA'];
			// $postdata['PPKB_KE'] = 1;
			// $ke = $postdata['PPKB_KE'];
			// $data  =  $this->senddataurl('uper/search/',$postdata,'POST');
			if($postdata['STATUS_LUNAS']=="P"){
				$data = $this->senddataurl('CreateUperBarang/view_uperbrg/',$postdata,'POST');
				$statusL = "LUNAS";
				// $data = '{data:[]}';
				$num1 =1;
				foreach ($data as $key => $value) {
					$data2['data'][$key] = $value;

						$enable1="hide";
						$enable2="";
						$ppkb_ke = substr($value->NOMOR_UPER,0,-1);
						// $value->PPKB_KE
						$tot = (strpos($value->AMOUNT,",")=='')?number_format($value->AMOUNT,0,',',','):$value->AMOUNT;
						$tot = (strpos($value->V_TOBEPAID,",")=='')?number_format($value->V_TOBEPAID,0,',',','):$value->V_TOBEPAID;
						$data2['data'][$key]->NO_UPER = $value->NOMOR_UPER;
						$data2['data'][$key]->num = $num1;
						$data2['data'][$key]->MODUL = "BARANG";
						$data2['data'][$key]->TGL_SIMPAN = $value->TGL_UPER;
						$data2['data'][$key]->EMKL = $value->COMPNAME;
						$data2['data'][$key]->NM_AGEN = $value->COMPNAME;
						$data2['data'][$key]->TTL = $tot;
						$data2['data'][$key]->STAT =/* $value->KD_PPKB_STATUS */ $statusL;
						/*$data2['data'][$key]->PPKBKE =$ppkb_ke;
						$data2['data'][$key]->TGL_SIMPAN = date('Y-m-d', strtotime($value->TGL_UPER));
						$data2['data'][$key]->action = '<button type="button" class="btn-warning btn-link '.$enable1.'" onclick="paymentupdate('."'".$value->NOMOR_UPER."'".')" ><i class="fa fa-money fa-2x " ></i></button><a target="_blank" class="btn btn-primary '.$enable2.'" href="'.ROOT.'einvoice/payment/cetak_uper/uper/'.$value->NOMOR_UPER.'"> <i class="fa fa-print" ></i></a>';
							// $data['data'][$key]['action'] = "action";
						$num1++;*/

						$postdata = ($_POST);
						// print_r($postdata);die();
						// $postdata['KD_PPKB'] = $postdata['ID_NOTA'];
						// $postdata['PPKB_KE'] = 1;
						// $ke = $postdata['PPKB_KE'];
						// $data  =  $this->senddataurl('uper/search/',$postdata,'POST');
						if ($postdata['STATUS_LUNAS'] == "P") {
							$data = $this->senddataurl('invh/searcUpBrg/', $postdata, 'POST');
							$statusL = "LUNAS";
							// $data = '{data:[]}';
							$num1 = 1;
							foreach ($data as $key => $value) {
								$data2['data'][$key] = $value;
			
								$enable1 = "hide";
								$enable2 = "";
								$ppkb_ke = substr($value->RECEIPT_NUMBER, 0, -1);
									// $value->PPKB_KE
								$tot = (strpos($value->AMOUNT, ",") == '') ? number_format($value->AMOUNT, 0, ',', ',') : $value->AMOUNT;
								$data2['data'][$key]->NO_UPER = $value->RECEIPT_NUMBER;
								$data2['data'][$key]->num = $num1;
								$data2['data'][$key]->MODUL = "BARANG";
								$data2['data'][$key]->TGL_SIMPAN = $value->RECEIPT_DATE;
									if($value->ATTRIBUTE3 == NULL)
								{
									$lol=$value->CUSTOMER_NUMBER;
								}
								else
								{
									$lol=$value->ATTRIBUTE3;
								}
								$enc_trx_number = $this->mx_encryption->encrypt($value->RECEIPT_NUMBER);
								$data2['data'][$key]->EMKL = $lol;
								$data2['data'][$key]->NAMAKAPAL = $value->ATTRIBUTE8;
								$data2['data'][$key]->TGLKEGIATAN = $value->ATTRIBUTE9;
								$data2['data'][$key]->TTL = $tot;
								$data2['data'][$key]->STAT =/* $value->KD_PPKB_STATUS */ $statusL;
								$data2['data'][$key]->PPKBKE = $ppkb_ke;
								$data2['data'][$key]->TGL_SIMPAN = $value->RECEIPT_DATE;//date('Y-m-d', strtotime($value->RECEIPT_DATE));
								$data2['data'][$key]->action = '<button type="button" class="btn-warning btn-link ' . $enable1 . '" onclick="paymentupdate(' . "'" . $value->KD_PPKB . "'" . ')" ><i class="fa fa-money fa-2x " ></i></button><a target="_blank" class="btn btn-primary ' . $enable2 . '" href="' . ROOT . 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number . '"> <i class="fa fa-print" ></i></a>';
										// $data['data'][$key]['action'] = "action";
								$num1++;
			
			
							}
						} else {
							$data = $this->senddataurl('CreateUperBarang/view_uperbrg/', $postdata, 'POST');
							$statusL = "BELUM LUNAS";
							$num1 = 1;
							foreach ($data as $key => $value) {
								$data2['data'][$key] = $value;
								// $no_uper = $value->NO_UPER;
								// $arrayData = $this->senddataurl('invh/searcUpr/',$postdata,'POST');
								// foreach ($arrayData as $data_uper) {
								// 	$dataUper = $data_uper->RECEIPT_NUMBER;
								// }
								$enable1 = "";
								$enable2 = "hide";
									// if ($value->STATUS=="P"){
									// 	$enable1="hide";
									// 	$enable2="";
									// } else {
									// 	$enable1="";
									// 	$enable2="hide";
									// }
									// $tot = number_format(10000,0,",",".");
								$enc_trx_number = $this->mx_encryption->encrypt($value->NOMOR_UPER);
								$tot = (strpos($value->V_TOBEPAID, ",") == '') ? number_format($value->V_TOBEPAID, 0, ',', ',') : $value->V_TOBEPAID;
									// $data2['data'][$key]->NO_UPER = $value->KD_PPKB;
								$data2['data'][$key]->num = $num1;
								$data2['data'][$key]->MODUL = "BARANG";
								$data2['data'][$key]->NO_UPER = $value->NOMOR_UPER;
								$data2['data'][$key]->TGL_SIMPAN = $value->TGL_UPER;
								$data2['data'][$key]->EMKL = $value->COMPNAME;
								$data2['data'][$key]->NM_AGEN = $value->COMPNAME;
								$data2['data'][$key]->NAMAKAPAL = $value->NM_KAPAL;
								$data2['data'][$key]->TGLKEGIATAN = $value->TGL_UPER2_C;
								$data2['data'][$key]->TTL = $tot;
								$data2['data'][$key]->STAT =/* $value->KD_PPKB_STATUS */ $statusL;
								$data2['data'][$key]->PPKBKE = $value->PPKB_KE;
								$data2['data'][$key]->TGL_SIMPAN = $value->TGL_UPER;//date('Y-m-d', strtotime($value->TGL_UPER));
								$data2['data'][$key]->action = '<button type="button" class="btn-warning btn-link ' . $enable1 . '" onclick="paymentupdate(' . "'" . $value->NOMOR_UPER . "'" . ')" ><i class="fa fa-money fa-2x " ></i></button><a target="_blank" class="btn btn-primary ' . $enable2 . '" href="' . ROOT . 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number . '"> <i class="fa fa-print" ></i></a>';
										// $data['data'][$key]['action'] = "action";
								$num1++;
			
							}
						}
		}
		echo json_encode($data2);
	}

	function uperpayment()
	{
		$postdata = array('INV_SOURCE_ID' => '');
		$role_id = $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$data['nota'] = $this->getdataurl('mstnota/dropdown/INV_NOTA_CODE');
		$data['nota1'] = $this->getdataurl('mstnota/dropdown/INV_NOTA_JENIS');
		// $data['bank']  =  $this->senddataurl('bank/search/',$postdata,'POST');		
		$data['bank'] = $this->getdataurl('bank');
		// print_r($data['bank']);die;	


		$this->common_loader($data, 'invoice/payment/uperpayment/uperpayment');

	}

	function uperedit()
	{
		$id = $_POST['NO_NOTA'];
		$data = $this->getdataurl('uper/' . $id);
		echo json_encode($data);
	}
	function upereditKapal()
	{
		$id = $_POST['NO_NOTA'];
		$postdata = ($_POST);	
		// print_r($postdata);die;
		$org_id = json_decode($this->session->userdata('unit_org'));
		// $data1 = json_decode(json_encode($this->getdataurl('CreateUperKapal/' . $id)), true);
		$data1 = json_decode(json_encode($this->getdataurl('CreateUperKapal/' .$id.'/'.$org_id[0])), true);
		// $data  =  $this->senddataurl('payment/search/',$postdata,'POST');
		// echo $data."iiiiiiiiiiiiii";	
		// $data[0]->ID_REQ = "-";
		// print_r($data1[0]);die();
		// $data1[0]["NO_UPER"] = $data1[0]['KD_PPKB'];
		$data1[0]["KD_MODUL"] = "KAPAL";
		$data1[0]["LAYANAN"] = "KAPAL";
		$data1[0]["TOTAL"] = $data1[0]['JUMLAH_UPER'];
		$data1[0]["TOTALPAY"] = $data1[0]['JUMLAH_UPER'];
		$data[0]["TOTAL"] = $data[0]['AMOUNT'];
		echo json_encode($data1);
	}
	function upereditBarang()
	{
		$id = $_POST['NO_NOTA'];
		$postdata = ($_POST);
		$postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');
		$postdata['ORG_ID'] = $this->session->userdata('unit_org');
		// print_r($postdata);die;
		$data1 = json_decode(json_encode($this->senddataurl('CreateUperBarang/view_uperbrg/', $postdata, 'POST')), true);
		
		// $data1  =  json_decode(json_encode($this->getdataurl('CreateUperKapal/'.$id)),true);
		// $data  =  $this->senddataurl('payment/search/',$postdata,'POST');
		// echo $data."iiiiiiiiiiiiii";	
		// $data[0]->ID_REQ = "-";
		// echo print_r($data1[0]);die();
		$data1[0]["NO_UPER"] = $data1[0]['NO_UPER'];
		$data1[0]["KD_MODUL"] = "BARANG";
		$data1[0]["LAYANAN"] = "BARANG";
		$data1[0]["TOTAL"] = $data1[0]['V_TOBEPAID'];
		$data1[0]["TOTALPAY"] = $data1[0]['V_TOBEPAID'];
		//$data1[0]["TOTAL"] = $data1[0]['V_TOBEPAID'];
		echo json_encode($data1);
	}
	function upersave()
	{
		$data = ($_POST);
		/*print_r($data);die();*/
		$data['USER_LUNAS'] = $this->session->userdata('user_id');
		$data['BANK_ID'] = $data['RECEIPT_ACCOUNT'];
		$data['TOTAL'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data['TOTAL']);
		$data['STATUS_LUNAS']='N';
		$data['UNIT_ID'] = $this->session->userdata('unit_id');
		// ('entity',$data,'PUT');
		// print_r($data);die();
		$result = $this->senddataurl('Uper/save_new', $data, 'POST');
		
		$postlognota = array(
			"TRX_NUMBER" => $data['NO_UPER'],
			"CUSTOMER_NAME" => $data['EMKL'],
			"AMOUNT_RECEIPT" => $data['TOTAL'],
			"LAYANAN" => "PTKM",
			"ACTIVITY" => "PAYMENT",
			"JENIS_NOTA" => "",
			"JENIS_PAYMENT" => "UPER",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota2/', $postlognota, 'POST');
		// ('entity',$data,'PUT');
		// $result = $this->senddataurl('uper',$data,'PUT');
		// var_dump($result);
		echo json_encode($result);
	}
	
	function upersaveKapal()
	{
		$postdata = ($_POST);
		
		$id = $postdata['NO_UPER'];
		$postdata['TRX_DATE_RECEIPT'] = date("d-M-y", strtotime($postdata['TRX_DATE_RECEIPT']));
		/*print_r($id);die();	*/
		 //$data1 = json_decode(json_encode($this->getdataurl('CreateUperKapal/' . $id)), true);
		/*print_r($data1);die();*/
		// $postdata['ORG_ID'] = json_decode($postdata['ORG_ID']);
		// print_r($postdata);die();
		$postdata['BANK_ID'] = $postdata['RECEIPT_ACCOUNT'];
		$postdata['KD_PPKB'] = substr($postdata['NO_UPER'], 0, -2);
		$postdata['PPKB_KE'] = substr($postdata['NO_UPER'], -1);
		$postdata['AMOUNT_UPDATE_UPER'] = preg_replace('/[^A-Za-z0-9\-]/', '', $postdata['TOTALPAY']);
		$postdata['TOTAL'] = preg_replace('/[^A-Za-z0-9\-]/', '', $postdata['TOTAL']);
		// $id=$postdata['KD_PPKB'];
		// $data1  =  json_decode(json_encode($this->getdataurl('CreateUperKapal/'.$id)),true);
		// $postdata['PPKB_KE'] = $data1[0]['PPKB_KE'];
		
		//print_r($postdata); die();

		$data = $this->senddataurl('CreateUperKapal/', $postdata, 'POST');
		/*print_r($data);die();*/

		$postlognota = array(
			"TRX_NUMBER" => $postdata['NO_UPER'],
			"CUSTOMER_NAME" => $postdata['NM_AGEN'],
			"AMOUNT_RECEIPT" => $postdata['TOTAL'],
			"LAYANAN" => "KPL",
			"ACTIVITY" => "PAYMENT",
			"JENIS_NOTA" => "",
			"JENIS_PAYMENT" => "UPER",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota3/', $postlognota, 'POST');
		echo json_encode($data);

	}
	function upersaveBarang()
	{
		$postdata = ($_POST);
		$postdata['TRX_DATE_RECEIPT'] = date("d-M-y", strtotime($postdata['TRX_DATE_RECEIPT']));
		$BRANCH_CODE = json_decode($this->session->userdata('unit_id'), true);
		$ORG_ID = json_decode($this->session->userdata('unit_org'), true);
		$id = $postdata['NO_UPER'];
		$postdata['BRANCH_CODE'] = $this->session->userdata('unit_id');
		
		//print_r(json_encode($postdata)); die();
		//$data1 = json_decode(json_encode($this->senddataurl('CreateUperBarang/view_uperbrg/', $postdata, 'POST')), true);
		// print_r($data1);die();
		// $data1  =  json_decode(json_encode($this->getdataurl('CreateUperBarang/'.$id)),true);
		// $postdata['TGL_UPER'] = $postdata['RECEIPT_ACCOUNT'];
		$postdata['BANK_ID'] = $postdata['RECEIPT_ACCOUNT'];
		$postdata['KD_PPKB'] = substr($postdata['NO_UPER'], 0, -2);
		$postdata['PPKB_KE'] = substr($postdata['NO_UPER'], -1);
		$postdata['AMOUNT_UPDATE_UPER'] = preg_replace('/[^A-Za-z0-9\-]/', '', $postdata['TOTALPAY']);
		$postdata['RECEIPT_AMOUNT'] = preg_replace('/[^A-Za-z0-9\-]/', '', $postdata['TOTALPAY']);
		$postdata['CURRENCY_RATE'] = "";

		$postdata['BRANCH_CODE'] = $BRANCH_CODE[0];
		$postdata['ORG_ID'] = $ORG_ID[0];
		// print_r(json_encode($postdata));die();
		//var_dump($postdata);die();
		$data = $this->senddataurl('CreateUperBarang/', $postdata, 'POST');

		$postlognota = array(
			"TRX_NUMBER" => $postdata['NO_UPER'],
			"CUSTOMER_NAME" => $postdata['NM_AGEN'],
			"AMOUNT_RECEIPT" => $postdata['TOTALPAY'],
			"LAYANAN" => "KPL",
			"ACTIVITY" => "PAYMENT",
			"JENIS_NOTA" => "",
			"JENIS_PAYMENT" => "UPER",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota3/', $postlognota, 'POST');
		echo json_encode($data);

	}
	public function cetak_uper_all2()
	{
		$postdata = ($_POST);
		$data = $this->senddataurl('uper/search/', $postdata, 'POST');
		echo json_encode($data);
	}
	public function cetak_uper_all()
	{
		// $postdata = ($_POST);
		// print_r($postdata);die();
		// $this->load->helper('pdf_helper');
		// tcpdf();
		$layanan = $this->uri->segment(4);
		$jenis = $this->uri->segment(5);
		$id = $this->uri->segment(6);
		// print_r($layanan . "-" . $jenis . "-" . $id);
		if ($jenis == "PETIKEMAS") {
			$postdata['NO_UPER'] = $id;
		 	// $postdata['LAYANAN'] => $jenis
			$data = $this->senddataurl('uper/search/', $postdata, 'POST');
			foreach ($data_uper as $data_uper) {
				if ($data_uper->NO_UPER == "P") {
					$statusbayar = "BELUM LUNAS";
				} else {
					$statusbayar = "LUNAS";
				}
				$no_uper = $data_uper->NO_UPER;
				$layanan = $data_uper->MODUL;
				$tgl_nota = $data_uper->TGL_SIMPAN;
				$customer = $data_uper->EMKL;
				$jumlahtotal = $data_uper->TOTAL;
				$statusbayar = $statusbayar;
			}
		} else if ($jenis == "KAPAL") {
			$postdata['KD_PPKB'] = $id;
		 	// $postdata['LAYANAN'] => $jenis
			$data = $this->senddataurl('createuperkapal/', $postdata, 'GET');
			foreach ($data_uper as $data_uper) {
				$no_uper = $data_uper->KD_PPKB;
				$layanan = $data_uper->KAPAL;
				$tgl_nota = $data_uper->TGL_JAM_ENTRY;
				$customer = $data_uper->NM_AGEN;
				$jumlahtotal = $data_uper->JUMLAH_UPER;
				$statusbayar = "BELUM LUNAS";
			}
		} else {

		}
			// print_r($data);die();

        // $id2 	= $id;
		$judul = 'preview cetak uper all';
			
				
				// $emkl 		= $data_uper->EMKL;
				
				// $tgl_nota 	= $data_uper->TRX_DATE;
				// $simpan 	= $data_uper->TGL_SIMPAN;
				// $lunas 		= $data_uper->TGL_SIMPAN;
				// $nouper 	= $data_uper->NO_UPER;
				// $bayar		= $data_uper->PAYMENT_VIA;
				// $c_address = $data_uper->CUSTOMER_ADDRESS;
				// $nomornpwp = $data_uper->CUSTOMER_NPWP;
				// $kapal 	   = $data_uper->VESSEL_NAME;
				
				// $no_req    = $data_uper->BILLER_REQUEST_ID;
				// $dagang    = $data_uper->JENIS_PERDAGANGAN;
				// $current   = $data_uper->CURRENCY_CODE;

			//$entitas = $this->getdataurl('entity/'.$id2);
		$data_entity = $this->getdataurl('entity/301');
			//print_r($entitas);die; 
				//print_r($e_name);die;
				//data header nota
		$e_name = $data_entity->INV_ENTITY_NAME;
		$e_address = $data_entity->INV_ENTITY_ALAMAT;
		$e_npwp = $data_entity->INV_ENTITY_NPWP;

			//ambil dari db_invoice
		$data_pejabat = $this->getdataurl('pejabat/1'); //pake di tbl unit (unit/11) 
		$start_date = $data_pejabat->INV_PEJABAT_EFECTIVE;
		$pejabat = $data_pejabat->INV_PEJABAT_NAME;
		$nip_pejabat = $data_pejabat->INV_PEJABAT_NIPP;
				
				$ORG_ID = $data_uper->ORG_ID;
				$BRANCH_CODE = $data_uper->BRANCH_CODE;
				$data_wilayah = $this->senddataurl('unit/searchUnitUper/',array("INV_UNIT_ORGID"=>$ORG_ID,"INV_UNIT_CODE"=>$BRANCH_CODE),'POST');	
				//print_r($data_wilayah);die;
				$unit_wilayah = $data_wilayah[0]->INV_UNIT_NAME;
				//print_r($unit_wilayah);die;
				$alamat_wilayah = $data_wilayah[0]->INV_UNIT_ALAMAT;

			// print_r($id2);die;
			//$trxline = $this->getdataurl('invl/'.$id2);
			// print_r($trxline);die;
			// $jum_amount=0;
			// $tax_amount=0;
			// $total_amount=0;
			// foreach ($trxline as $jumlah) {
			// 	$total_amount = $jumlah;
			// 	//perhitungan pengenaan pajak 
			// 	$jum = $jumlah->AMOUNT;
			// 	$jum_amount = $jum_amount + $jum;

			// 	$tax = $jumlah->TAX_AMOUNT;
			// 	$tax_amount = $tax_amount + $tax;

			// 	$jum_total = $jum_amount + $tax_amount;
			// 	$total_amount = $total_amount+$jum_total;
		
			// 	//barcode
			// 	$idsecret = $this->encrypt->encode($TRX_NUMBER);

			// 	$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
				//$params['level'] = 'H';
				//$params['size'] = 10;
				//$randomfilename = rand(1000, 9999);
				// $params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
				// $this->ciqrcode->generate($params);
				// $barcode_location=APP_ROOT."qr_code/$randomfilename.png";
		$enc_trx_number = $this->mx_encryption->encrypt($data_uper->NO_UPER);
		$url_enc = 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number;
		$params['data'] = ROOT . $url_enc;
		$params['level'] = 'H';
		$params['size'] = 10;
		$randomfilename = rand(1000, 9999);
				/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
				die();exit();*/
		$params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
		$this->ciqrcode->generate($params);
		$barcode_location = APP_ROOT . "qr_code/" . $randomfilename . ".png";
		$ttd_location = APP_ROOT . "config/images/cr/ttd2.png";
			//}	

			//terbilang
		$huruf = $this->getdataurl('others/terbilang/' . $jumlah);
		foreach ($huruf as $bilang) {
			$terbilang = $bilang->NILAI;
			$terbilang = $terbilang . 'Rupiah';
		}
			// ---tutup data -----------

		$title = "Report Nota uper";


		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(17, 0);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->SetAutoPageBreak(true);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray(null);
		$pdf->SetPrintFooter(false);
		$pdf->SetHeaderMargin(false);
		$pdf->SetTopMargin(5);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->SetHeaderData(
			PDF_HEADER_LOGO,
			PDF_HEADER_LOGO_WIDTH,
			PDF_HEADER_TITLE . ' 011',
			PDF_HEADER_STRING
		);
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('courier', '', 8);
		$pdf->AddPage();
		$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			//'border' => true,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0, 0, 0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'courier',
			'fontsize' => 4,
			'stretchtext' => 4
		);

		$header = '<table>
				<tr>
                    <td width="70"></td><td COLSPAN="12" align="left"><b>' . $e_name . '</b></td>
                </tr>
                <tr>
                    <td width="70"></td><td COLSPAN="12" align="left">' . $e_address . '</td>  
                </tr>

                <tr>
                    <td width="70"></td><td COLSPAN="12" align="left">NPWP:' . $e_npwp . ' </td>  
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

		$judul = '<table>
        			<tr>
	                    <td COLSPAN="2" align="center" style="background-color:#ff4000;color:white;">
	                    <b>UANG UNTUK DIPERHITUNGKAN (UPER) PEMBAYARAN RENCANA BONGKAR MUAT</b></td>  	
                	</tr>
        		</table>';

		$lampiran = '<table>
                	<tr>

	                    <td COLSPAN="2" align="left" width="120px">Sudah Terima Dari</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="230px">' . $emkl . '</td>

	                    
	                    <td COLSPAN="2" align="left" width="90px">No Account</td>
	                    <td COLSPAN="2" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="250px">' . $bayar . '</td>
                	</tr>

                	<tr>

	                    <td COLSPAN="2" align="left" width="120px">Untuk Kapal</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="230px">' . $kapal . '</td>

	                    
	                    <td COLSPAN="2" align="left" width="90px">No ID</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px">' . $nouper . '</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $simpan . '/' . $lunas . '</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Nomor Uper</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $nouper . '</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Untuk Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">UPER Bongkar Muat</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">UPER Bongkar Muat</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px"></td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Jumlah UPER</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">Rp.' . number_format($jumlah, 2, ',', ',') . '</td>
                	</tr>

 
                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Jumlah Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">Rp.' . number_format($jumlah, 2, ',', ',') . '</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Cara Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $bayar . '</td>
                	</tr>

        			</table>';

		$tbl = '<table border>
        			<tr>
        				<td COLSPAN="2" align="left" width="120px">Catatan</td>
        			</tr>
        		</table>';
		switch ($layanan) {
			case "uper":
				foreach ($trxline as $line) {
					$data_table = $line;
				//print_r($line);die;
					$this->get_data_petikemas($no_invoice, $data_table, $current);
					$tbl .= $data_table;

				}
				$output_name = "LAPORAN PDF NOTA UPER";
				break;
		}

		$jml_footer = '<table>
						<tr>
							<td COLSPAN="2" align="left" width="80px">Terbilang</td>
							<td COLSPAN="1" align="left" width="10px">:</td>
	                    	<td COLSPAN="7" align="left">' . $terbilang . '</td></br>
						</tr>
					   </table>';

		$ttd_footer = '<table>
						<tr>
		                    <td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">Jakarta, ' . $start_date . '</td>
                		</tr>

                		<tr>
		                    
		                    <td COLSPAN="2" align="right" width="550px">Manajer Keuangan</td>
                		</tr>

                		<tr>
		                    <td COLSPAN="2" align="left" width="100px"><img height="100" width="100" src="' . $barcode_location . '" /></td>
		                    <td COLSPAN="2" align="right" width="457px"><img height="100" width="100" src="' . $ttd_location . '" /></td>
		                    
                		</tr>
      
                		<tr>
                			<td COLSPAN="2" align="left" width="100px"></td>
		                    <td COLSPAN="2" align="center" width="800px">' . $pejabat . '</td>
                		</tr>

                		<tr>
                			<td COLSPAN="2" align="right" width="545px">NIPP.' . $nip_pejabat . '</td>
                		</tr>

                		<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">' . $unit_wilayah . '</td>
							<td COLSPAN="2" align="left" width="5px"></td>
						</tr>

						<tr>
	                		<td width="5"></td><td COLSPAN="10" align="left">' . $alamat_wilayah . '</td>
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
	public function cetak_uper($layanan, $no_invoice = "")
	{
		// echo "12345";
		// $this->load->helper('pdf_helper');
		$this->load->helper('nota_invoice_helper');
		// tcpdf();
		//$id = $this->uri->segment(5);
        // print_r($id);die;
		$id = $this->mx_encryption->decrypt($no_invoice);
		$id2 = $id;
		$judul = 'preview cetak uper';



		switch ($layanan) {

			// case "ruparupa":
			case "uper":
				$id = $this->mx_encryption->decrypt($no_invoice);
				$id2 = $id;
				$jnsNota = $this->getMstNota("KPL");
			//$id2=$qs;
			// $id2 	= $id; //diaktifin data gak muncul
				$data_header = $this->getdataurl('/Uper/pdf/PETIKEMAS/' . $id2);
				$data_uper = $this->getdataurl('uper/' . $id2);

			// print_r($data_header); die();
			// $data_uper = $this->getdataurl('uper/pdf/PETIKEMAS/'.$id2);

			// print_r($data_uper."hhhhhhhhhhhhhhhhhh");die;

			// $data_header = $this->getdataurl('uper/pdf/PETIKEMAS/'.$id2);
			// echo $id2;
			// print_r($data_uper);die;
			// print_r($data_header);die;

			//ambil data dari trx_header
				$uper_data = $data_header;
				$emkl = $data_header->EMKL;
			// print_r($emkl);die;
				$kapal = $data_header->ATTRIBUTE8;
				$tgl_nota = $data_header->RECEIPT_DATE;
			// print_r($data_header);die();
				$kdNota = $data_header->ATTRIBUTE14;
				if (isset($jnsNota[$kdNota])) {
					$JENIS = $jnsNota[$kdNota];
				} else {
					$JENIS = "UPER Bongkar Muat";
				}
				$e_name = $data_header->INV_ENTITY_NAME;
				$simpan = $data_header->TGL_SIMPAN;
				$lunas = $data_header->TGL_SIMPAN;
				$nouper = $data_header->ATTRIBUTE1;
				//$jumlah_uper = $data_header->ATTRIBUTE15;//AMOUNT;
				$jumlah_uper = $data_header->AMOUNT_ORIG;//AMOUNT;
				$jumlah_bayar = $data_header->AMOUNT;//AMOUNT;
			// $jumlah_bayar = $data_header->ATTRIBUTE15;
				$bayar = $data_header->BANK_ID;
				$kdPelanggan = $data_header->CUSTOMER_NUMBER;
				$MODUL = $data_header->MODUL;
				$bankAccount = $data_header->RECEIPT_ACCOUNT;
			// $kunjunganStart = $data_header->ATTRIBUTE9;
				$kunjunganEnd = $data_header->ATTRIBUTE6;
				$status_bayar = $data_header->STATUS;
				$faktor_note = $data_header->ATTRIBUTE1;
				$TGL_LUNAS = $data_header->RECEIPT_DATE;
				$KD_MODUL = $data_header->RECEIPT_TYPE;
				$tgl_nota2 = $data_header->RECEIPT_DATE;
				$jabatan_pejabat = $data_header->INV_PEJABAT_JABATAN;
				$status_lunas = $data_header->STATUS_LUNAS;
				$ORG_ID = $data_header->ORG_ID;
				
				//$BRANCH_CODE = $data_header->BRANCH_CODE;		

				if($data_header->BRANCH_CODE == 'ITPK')
				{
					$BRANCH_CODE = 'TPK';
				}
				else
				{
					$BRANCH_CODE = $data_header->BRANCH_CODE;
				}
				
				$comments = $data_header->COMMENTS; /* 20180831 3ono */

			// $voyage     = $data_header->ATTRIBUTE13;
				$tgl_periode = $data_header->ATTRIBUTE9;
			// $data_header = $this->getdataurl('Unit/searchDetail/'.$ORG_ID);
			// echo print_r($data_header);die();
				// $notaJenis = $this->getdataurl('mstnota/getData/'.$MODUL);
				// echo print_r($notaJenis);die();
				// if(count($notaJenis)>0){
				// 	$jenisNota = $notaJenis[0]->INV_NOTA_JENIS;
				// }else{
				// 	$jenisNota = "-";
				// }

				$status_bayar = $data_header->STATUS; 
				// $faktor_note 		= $data_header->INV_FAKTUR_NOTE;
				$jabatan_pejabat = $data_header->INV_PEJABAT_JABATAN;
				$status_lunas = $data_header->STATUS_LUNAS;
				$e_logo = $data_header->INV_ENTITY_LOGO;
				$pejabat = $data_header->INV_PEJABAT_NAME;
				$nip_pejabat = $data_header->INV_PEJABAT_NIPP;
				$ttd_pejabat = $data_header->INV_PEJABAT_TTD;
				$e_address = ($data_header->INV_ENTITY_ALAMAT == '') ? "-" : $data_header->INV_ENTITY_ALAMAT;
				$e_npwp = ($data_header->INV_ENTITY_NPWP == '') ? "-" : $data_header->INV_ENTITY_NPWP;
				$e_faktur = ($data_header->INV_ENTITY_FAKTUR == '') ? "-" : $data_header->INV_ENTITY_FAKTUR;
				$start_date = $data_header->INV_PEJABAT_EFECTIVE;
				$pejabat = $data_header->INV_PEJABAT_NAME;
				$nip_pejabat = $data_header->INV_PEJABAT_NIPP;
				$e_name = $data_header->INV_ENTITY_NAME;
				$e_address = $data_header->INV_ENTITY_ALAMAT;
				$e_npwp = $data_header->INV_ENTITY_NPWP;
				// $notaJenis = $this->getdataurl('mstnota/getData/'.$KD_MODUL);
				// if(count($notaJenis)>0){
				// 	$jenisNota = $notaJenis[0]->INV_NOTA_JENIS;
				// }else{
				// 	$jenisNota = "-";
				// }
				define('noNotaFooter', $id2);
				$header_nota = array(
						// "faktor_note" => $faktor_note,
					"status_lunas" => "Y",
					"status_bayar" => $status_bayar,
					"e_logo" => $e_logo,
					"e_name" => $e_name,
					"num" => $nouper,
					"e_address" => $e_address,
					"tgl_nota" => $tgl_nota2,
					"e_npwp" => $e_npwp,
					"e_faktur" => '',
					"uper" => 'y'
				);
				$judul_nota = array("jenisNota" => $jenisNota);
				// echo print_r($header_nota);die();
			// print_r($data_uper);die;
			//$entitas = $this->getdataurl('entity/'.$id2);

			// $data_entity = $this->getdataurl('entity/'.$data_header->INV_ENTITY_ID);
			// //print_r($entitas);die; 
			// 	//print_r($e_name);die;
			// 	//data header nota
			// $e_name 	 = $data_entity->INV_ENTITY_NAME;
			// $e_address   = $data_entity->INV_ENTITY_ALAMAT;
			// $e_npwp      = $data_entity->INV_ENTITY_NPWP;
			// //ambil dari db_invoice
			// $data_pejabat = $this->getdataurl('pejabat/'.$data_header->INV_PEJABAT_ID); //pake di tbl unit (unit/11) 
			// $start_date 	= $data_pejabat->INV_PEJABAT_EFECTIVE;
			// $pejabat 		= $data_pejabat->INV_PEJABAT_NAME;
			// $nip_pejabat 	= $data_pejabat->INV_PEJABAT_NIPP; 
			

			// // $data_entity = $this->getdataurl('entity/301');
			// //print_r($entitas);die; 
			// 	//print_r($e_name);die;
			// 	//data header nota
			// $e_name 	 = $data_header->INV_ENTITY_NAME;
			// $e_address   = $data_header->INV_ENTITY_ALAMAT;
			// $e_npwp      = $data_header->INV_ENTITY_NPWP;

			// //ambil dari db_invoice
			// //$data_pejabat = $this->getdataurl('pejabat/1'); //pake di tbl unit (unit/11) 
			// $start_date 	= $data_header->INV_PEJABAT_EFECTIVE;
			// $pejabat 		= $data_header->INV_PEJABAT_NAME;
			// $nip_pejabat 	= $data_header->INV_PEJABAT_NIPP; 
			 $unit_loc  		= $data_header->INV_UNIT_LOCATION;
			// $tgl_nota  		= $data_header->RECEIPT_DATE;

				$data_wilayah = $this->senddataurl('unit/searchUnitUper/',array("INV_UNIT_ORGID"=>$ORG_ID,"INV_UNIT_CODE"=>$BRANCH_CODE),'POST');	
				//print_r($data_wilayah);die;
				$unit_wilayah = $data_wilayah[0]->INV_UNIT_NAME;
				//print_r($unit_wilayah);die;
				$alamat_wilayah = $data_wilayah[0]->INV_UNIT_ALAMAT;
			
			// print_r($id2);die;
			//$trxline = $this->getdataurl('invl/'.$id2);
			// print_r($trxline);die;
			// $jum_amount=0;
			// $tax_amount=0;
			// $total_amount=0;
			// foreach ($trxline as $jumlah) {
			// 	$total_amount = $jumlah;
			// 	//perhitungan pengenaan pajak 
			// 	$jum = $jumlah->AMOUNT;
			// 	$jum_amount = $jum_amount + $jum;

			// 	$tax = $jumlah->TAX_AMOUNT;
			// 	$tax_amount = $tax_amount + $tax;

			// 	$jum_total = $jum_amount + $tax_amount;
			// 	$total_amount = $total_amount+$jum_total;
		
			// 	//barcode
			// 	$idsecret = $this->encrypt->encode($TRX_NUMBER);

			// 	$params['data'] = ROOT."cetak/cetak_nota?".$idsecret;
				//$params['level'] = 'H';
				//$params['size'] = 10;
				//$randomfilename = rand(1000, 9999);
				// $params['savename'] = UPLOADFOLDER_."qr_code/$randomfilename.png";
				// $this->ciqrcode->generate($params);
				// $barcode_location=APP_ROOT."qr_code/$randomfilename.png";				
				$enc_trx_number = $this->mx_encryption->encrypt($data_header->RECEIPT_NUMBER);

				$url_enc = 'einvoice/payment/cetak_uper/uper/' . $enc_trx_number;
				
				$params['data'] = ROOT . $url_enc;
				$params['level'] = 'H';
				$params['size'] = 10;
				$randomfilename = rand(1000, 9999);
				/*echo UPLOADFOLDER_."qr_code/new_".$randomfilename.".png";
				die();exit();*/
				$params['savename'] = UPLOADFOLDER_ . "qr_code/" . $randomfilename . ".png";
				$this->ciqrcode->generate($params);
				$barcode_location = APP_ROOT . "qr_code/" . $randomfilename . ".png";
				$ttd_location = APP_ROOT . "config/images/cr/ttd2.png";
			//}

			//terbilang
				$huruf = $this->getdataurl('others/terbilang/' . $jumlah_bayar);
				foreach ($huruf as $bilang) {
					$terbilang = $bilang->NILAI;
					$terbilang = $terbilang . 'Rupiah';
				}
			// ---tutup data -----------

				$title = "Report Nota uper";
				break;

		}


		$postlognota = array(
			"TRX_NUMBER" => $id2,
			"ACTIVITY" => "CETAK",
			"USER_ID" => $this->session->userdata('user_id'),
		);
		$datalog = $this->senddataurl('lognota/insertlognota2/', $postlognota, 'POST');
		$pdf = new MyCustomPDFWithWatermark('P', 'mm', 'A4', true, 'UTF-8', false);
		// $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle($title);
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(17, 0);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->SetAutoPageBreak(true);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray(null);
		$pdf->SetPrintFooter(false);
		$pdf->SetHeaderMargin(false);
		$pdf->SetTopMargin(5);
		$pdf->SetFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		/*template settingan pdf*/
		list($pdf, $style) = format_nota($header_nota);
		// echo print_r($pdf);die();

		$header = header_nota($header_nota); 
		$judul = judul_uper_nota($judul_nota);
// masih jumlah pembayaran berdasarkan uper
		$lampiran = '<table>
                	<tr>

	                    <td COLSPAN="2" align="left" width="120px">Sudah Terima Dari</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="270px">' . $emkl . '</td>

	                    
	                    <td COLSPAN="2" align="left" width="90px">No Account</td>
	                    <td COLSPAN="2" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="250px">' . $kdPelanggan . '</td>
                	</tr>

                	<tr>

	                    <td COLSPAN="2" align="left" width="120px">Untuk Kapal / Voyage</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="270px">' . $kapal . '</td></tr>';


		$lampiranxx .= '<td COLSPAN="2" align="left" width="90px">No ID</td>
	                    <td COLSPAN="1" align="left"  width="10px">:</td>
                   		<td COLSPAN="2" align="left"  width="170px">' . $nouper . '</td>
                	</tr>';

		$lampiran .= '<tr>
	                    <td COLSPAN="2" align="left" width="120px">Periode Kunjungan</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $tgl_periode . '</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Nomor Uper</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $nouper . '</td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Untuk Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $JENIS . '</td>
                	</tr>';

				if($jumlah_uper > 0)
				{
                $lampiran .= '<tr>
	                    <td COLSPAN="2" align="left" width="120px">Jumlah UPER</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">Rp. ' . number_format(round(number_format($jumlah_uper, 0, '', ''),1),0,'.', '.') . '</td>
                	</tr>


                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Jumlah Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">Rp. ' . number_format(round(number_format($jumlah_bayar, 0, '', ''),1),0,'.', '.') . '</td>
                	</tr>';
				}
				else
				{
                $lampiran .= '<tr>
	                    <td COLSPAN="2" align="left" width="120px">Jumlah UPER</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">Rp. ' . number_format(round(number_format($jumlah_bayar, 0, '', ''),1),0,'.', '.') . '</td>
                	</tr>


                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Jumlah Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">Rp. ' . number_format(round(number_format($jumlah_bayar, 0, '', ''),1),0,'.', '.') . '</td>
                	</tr>';					
				}
				
			$lampiran .= '<tr>
                		<td COLSPAN="2" align="left" width="120px"></td>
						<td COLSPAN="1" align="left" width="10px"></td>
	                    <td COLSPAN="2" align="left" width="300px"></td>
                	</tr>

                	<tr>
	                    <td COLSPAN="2" align="left" width="120px">Cara Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $bankAccount . '</td>
                	</tr>';
		$lampiran .= '<tr>
	                    <td COLSPAN="2" align="left" width="120px">Tanggal Pembayaran</td>
						<td COLSPAN="1" align="left" width="10px">:</td>
	                    <td COLSPAN="2" align="left" width="300px">' . $TGL_LUNAS . '</td>
                	</tr>';
		
		if($status_bayar = "P")
						{
						$lampiran .= '<tr>
										<td COLSPAN="2" align="left" width="120px">Keterangan</td>
										<td COLSPAN="1" align="left" width="10px">:</td>
										<td COLSPAN="2" align="left" width="300px">' .$comments. '</td>
									</tr>';
						}
						else
						{
						$lampiran .= '<tr>
										<td COLSPAN="2" align="left" width="120px">Keterangan</td>
										<td COLSPAN="1" align="left" width="10px">:</td>
										<td COLSPAN="2" align="left" width="300px">BELUM LUNAS</td>
									</tr>';
						}
		
		$lampiran .= '</table>';

    /*  //  $tbl = '<table border>
        //			<tr>
        //				<td align="left">Catatan :</td>
        //			</tr>
        //			<tr>
        //				<td align="left">Pembayaran Tunai dianggap sah jika ada cap register PT. Pelabuhan Indonesia Cabang Tanjung Priok</td>
        //			</tr>
        //			<tr>
        //				<td align="left">Pembayaran dengan Perhitungan dianggap sah jika ada cap perhitungan dan otorisasi Manager Keuangan</td>
        //			</tr>
        //		</table>';*/
		switch ($layanan) {
			case "uper":
				foreach ($trxline as $line) {
					$data_table = $line;
				//print_r($line);die;
					$this->get_data_petikemas($no_invoice, $data_table, $current);
					$tbl .= $data_table;

				}
				$output_name = "NOTA UPER " . $nouper . ".pdf";
				break;
		}

		$jum_amount = ($data_header->AMOUNT_DASAR_PENGHASILAN == '') ? 0 : $data_header->AMOUNT_DASAR_PENGHASILAN;
		$tax_amount = ($data_header->PPN_10PERSEN == '') ? 0 : $data_header->PPN_10PERSEN; //buat ppn potongan 10 persen
		$total_amount = ($data_header->AMOUNT == '') ? 0 : $data_header->AMOUNT;
		$materai = ($data_header->AMOUNT_MATERAI == '') ? 0 : $data_header->AMOUNT_MATERAI;


		$footer_nota = array(
			"headerContext" => $headerContext,
			"headerSubContext" => $header_context,
			"terbilang" => $terbilang,
			"barcode_location" => $barcode_location,
			"tgl_nota" => $tgl_nota,
			"unit_loc" => $unit_loc,
			"jabatan_pejabat" => $jabatan_pejabat,
			"ttd_pejabat" => $ttd_pejabat,
			"pejabat" => $pejabat,
			"nip_pejabat" => $nip_pejabat,
			"current" => $current,
			"jum_amount" => $jum_amount,
			"ppn_sendiri" => $ppn_sendiri,
			"u_piutang" => $u_piutang,
			"total_amount" => $total_amount,
			"tgl_nota" => $tgl_nota,
			"data" => array()
		);
		$footer_nota["data"] = array(
			"current" => $current,
			"jum_amount" => $jum_amount,
			"tax_amount" => $tax_amount,
			"materai" => $materai,
			"jum_amount" => $jum_amount,
			"ppn_sendiri" => $ppn_sendiri,
			"u_piutang" => $u_piutang,
			"tgl_nota" => $tgl_nota
		);
		$footer = footer_nota($footer_nota);

		// $jml_footer = '<table>
		// 				<tr>
		// 					<td COLSPAN="2" align="left" width="80px">Terbilang</td>
		// 					<td COLSPAN="1" align="left" width="10px">:</td>
	 //                    	<td COLSPAN="7" align="left">'.$terbilang.'</td></br>
		// 				</tr>
		// 			   </table>';

		// $ttd_footer ='<table>
		// 				<tr>
		//                     <td COLSPAN="2" align="left" width="100px"></td>
		//                     <td COLSPAN="2" align="center" width="800px">Jakarta, '.$start_date.'</td>
  //               		</tr>

  //               		<tr>
		                    
		//                     <td COLSPAN="2" align="right" width="550px">Manajer Keuangan</td>
  //               		</tr>

  //               		<tr>
		//                     <td COLSPAN="2" align="left" width="100px"><img height="100" width="100" src="'.$barcode_location.'" /></td>
		//                     <td COLSPAN="2" align="right" width="457px"><img height="100" width="100" src="'.$ttd_location.'" /></td>
		                    
  //               		</tr>
      
  //               		<tr>
  //               			<td COLSPAN="2" align="left" width="100px"></td>
		//                     <td COLSPAN="2" align="center" width="800px">'.$pejabat.'</td>
  //               		</tr>

  //               		<tr>
  //               			<td COLSPAN="2" align="right" width="545px">NIPP.'.$nip_pejabat.'</td>
  //               		</tr>

  //               		<tr>
	 //                		<td width="5"></td><td COLSPAN="10" align="left">'.$unit_wilayah.'</td>
		// 					<td COLSPAN="2" align="left" width="5px"></td>
		// 				</tr>

		// 				<tr>
	 //                		<td width="5"></td><td COLSPAN="10" align="left">'.$alamat_wilayah.'</td>
		// 					<td COLSPAN="2" align="left" width="5px"></td>
		// 				</tr>
		// 			  </table>';

		$ematerai_nota = array(
			"unit_wilayah" => $unit_wilayah,
			"alamat_wilayah" => $alamat_wilayah
		);
		$ematerai_nota = ematerai_nota($ematerai_nota);
		$pdf->writeHtml($header, true, false, false, false, '');
		$pdf->writeHtml($judul, true, false, false, false, '');
		$pdf->writeHtml($lampiran, true, false, false, false, '');
		$pdf->writeHtml($tbl, true, false, false, false, '');
		$pdf->writeHtml($footer, true, false, false, false, '');
		$pdf->SetPrintFooter(true);
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		//$pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		$pdf->SetY(260);
		$pdf->writeHtml($ematerai_nota, true, false, false, false, '');
		$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->Output($output_name, 'I');



	}


	public function del_RequestAll()
	{
		//echo "test";
		// $no_request=$_POST['REQUEST'];
		// $reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		$reason = $_POST['REJECT_NOTES'];
		$user_id = $this->session->userdata('userid_simop');
		$mekanisme = 'MANUAL';

		$databiller = $this->container_model->getDataRequestBiller($no_request);
		//echo "test";die;
		//json_encode($databiller);die;
		$port = $databiller['PORT_ID'];
		$terminal = $databiller['TERMINAL_ID'];
		//echo $terminal;die;
		$service = $databiller['ID_SERVICE'];
		//echo('test');die;
		try {

			$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<port_code>$port</port_code>
							<terminal_code>$terminal</terminal_code>
							<id_reqol>$no_request</id_reqol>
							// <id_req>$reqNoBiller</id_req>
							<type_req>$service</type_req>
							<user_id>$user_id</user_id>
							<reason>$reason</reason>
							<mekanisme>$mekanisme</mekanisme>
						</data>
					</root>";


			if (!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER, "cancelBooking", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
				//echo $result;

				$obj = json_decode($result);
				if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
					//echo $result;
				}
			}
		} catch (Exception $e) {
			echo "NO Exception,GAGAL";
		}
	}

	public function common_loader($data, $views)
	{
		if (!$this->session->userdata('is_login')) {
			redirect(ROOT . 'main_invoice', 'refresh');
		}
		$role_id = $this->session->userdata('role_id');
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function redirect()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
	}

	public function index()
	{

		$this->redirect();

		//search container
		//input
		$bl_number = "";
		$container_point = "";
		$billing = null;
		if (isset($_GET['port'])) {
			$port = explode("-", $_GET["port"]);
		}
		if (isset($_GET['bl_number'])) $bl_number = $_GET['bl_number'];

		//create table
		$this->table->set_heading("No", "No Pol Truck", "TID", "Point", "Gate In Time", "Gate Out Time", 'Weight', 'Quantity', 'Status');
		$this->table->set_heading("No", "No Pol Truck", "TID", "Point", "Gate In Time", "Gate Out Time", 'Weight', 'Quantity', 'Status');

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));

		//output
		$data['no_container'] = "";
		$data['vessel'] = "";
		$data['voyage_in'] = "";
		$data['voyage_out'] = "";
		$data['status'] = "";
		$data['location'] = "";
		$data['size'] = "";
		$data['type'] = "";
		$data['status'] = "";
		$data['hazard'] = "";
		$data['imo_class'] = "";
		$data['un_number'] = "";
		$data['iso_code'] = "";
		$data['height'] = "";
		$data['pol'] = "";
		$data['pod'] = "";
		$data['weight'] = "";
		$data['e_i'] = "";
		$data['hold_status'] = "";
		$data['activity'] = "";
		$data['cont_location'] = "";
		$data['reefer_temp'] = "";
		$data['weight'] = "";
		$data['hold_status'] = "";
		$data['paidthru'] = "";
		$data['point'] = "";
		$data['maxpoint'] = "";
		if ($bl_number != "") {
			$in_data = "<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<bl_number>$bl_number</bl_number>
					<port_code>" . $port[0] . "</port_code>
					<terminal_code>" . $port[1] . "</terminal_code>
				</data>
			</root>";
			//echo $in_data;die;
			if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getDetailCargo", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
				//echo $result;die;


				$obj = json_decode($result);
				//echo $obj->data->info->weight;
				//die();

				if ($obj->data->info) {
					$data['vessel'] = $obj->data->info->vessel;
					$data['voyage'] = $obj->data->info->voyage;
					$data['bl_number'] = $obj->data->info->bl_number;
					$data['cargo_name'] = $obj->data->info->cargo_name;
					$data['package_name'] = $obj->data->info->package_name;
					$data['weight'] = $obj->data->info->weight;
					$data['quantity'] = $obj->data->info->quantity;
					$data['volume'] = $obj->data->info->volume;
					$data['hs_code'] = $obj->data->info->hs_code;
					$data['weight_realization'] = $obj->data->info->weight_realization;
					$data['quantity_realization'] = $obj->data->info->quantity_realization;
					$data['volume_realization'] = $obj->data->info->volume_realization;
					$data['trade'] = $obj->data->info->trade;
					$data['e_i'] = $obj->data->info->e_i;
					$data['tl'] = $obj->data->info->tl;
					$data['cust_name'] = $obj->data->info->cust_name;
					$data['cust_addr'] = $obj->data->info->cust_addr;




					for ($i = 0; $i < count($obj->data->handling); $i++) {
						$this->table->add_row(
							$i + 1,
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

					for ($i = 0; $i < count($obj->data->billing); $i++) {
						$billing[$i]['no'] = $i + 1;
						$billing[$i]['id_req'] = $obj->data->billing[$i]->id_req;
						$billing[$i]['bl_number'] = $obj->data->billing[$i]->bl_number;
						$billing[$i]['bl_date'] = $obj->data->billing[$i]->bl_date;
						$billing[$i]['tl_flag'] = $obj->data->billing[$i]->tl_flag;
						$billing[$i]['oi'] = $obj->data->billing[$i]->oi;
						$billing[$i]['status'] = $obj->data->billing[$i]->status;
						$billing[$i]['type_payment'] = $obj->data->billing[$i]->type_payment;
					}
				}
			}
		}
		$data['billing'] = $billing;

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Track & Trace Cargo", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Track & Trace Cargo";

		$this->common_loader($data, 'pages/om/tracking');
	}

	public function main_tca()
	{

		$this->redirect();
		$customer_id = $this->session->userdata('customerid_phd');
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
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getHeaderTCA", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);

			if ($obj->data->listreq) {

				$i = 1;
				for ($i = 0; $i < count($obj->data->listreq); $i++) {
					$label_span = '<span class="label label-default">N/A</span>';
					$view_link = '<a  class=\'btn btn-primary\' onclick=\'clickDialog1("' . $row['REQUEST_ID'] . '");\'><i class=\'fa fa-eye\'></i></a>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link = '<span class="label label-default">N/A</span>';
					$cancel_link = '<span class="label label-default">N/A</span>';
					$confirm_link = '<span class="label label-default">N/A</span>';

					$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "om/truck/edit_tca/" . $obj->data->listreq[$i]->NO_REQUEST . '"><i class=\'fa fa-pencil\'></i></a>';

					$this->table->add_row(
						$i + 1,
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
				echo "<span style='color:red'>" . $obj->rcmsg . "</span>";
			}
		}

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Truck ID Association", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "TID ASSOCIATION";

		$this->common_loader($data, 'pages/om/main_tca');
	}


	public function search_main_tca($search = "")
	{

		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
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
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<search>$search</search>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getHeaderTCA", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);

			if ($obj->data->listreq) {

				$i = 1;
				for ($i = 0; $i < count($obj->data->listreq); $i++) {
					$label_span = '<span class="label label-default">N/A</span>';
					$view_link = '<a  class=\'btn btn-primary\' onclick=\'clickDialog1("' . $row['REQUEST_ID'] . '");\'><i class=\'fa fa-eye\'></i></a>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link = '<span class="label label-default">N/A</span>';
					$cancel_link = '<span class="label label-default">N/A</span>';
					$confirm_link = '<span class="label label-default">N/A</span>';

					$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "om/truck/edit_tca/" . $obj->data->listreq[$i]->NO_REQUEST . '"><i class=\'fa fa-pencil\'></i></a>';

					$this->table->add_row(
						$i + 1,
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
				echo "<span style='color:red'>" . $obj->rcmsg . "</span>";
			}
		}
		$this->load->view('pages/om/search_main_tca', $data);
	}

	public function upload_excel()
	{
		include_once(APPPATH . "libraries/excel_reader2.php");

			//membaca file excel yang diupload
		$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
			//membaca jumlah baris dari data excel
		$baris = $data->rowcount($sheet_index = 0);
			//echo $baris;

			//nilai awal counter jumlah data yang sukses dan yang gagal diimport
		$sukses = 0;
		$gagal = 0;
		$param = '';
		$param_temp = "";
		$jumlah_OK = 0;
			//echo($baris);
			//import data excel dari baris kedua, karena baris pertama adalah nama kolom
		$req = htmLawed($_POST['req_excel']);
		$reqNoBiller = $this->container_model->getNumberRequestBiller($req);
		for ($i = 8; $i <= $baris; $i++) {
				//membaca data nama depan (kolom ke-1)  (No Container)

			$no_container = $data->val($i, 1);
			$type = $data->val($i, 2);
			$carrier = $data->val($i, 3);
			$iso_code = $data->val($i, 4);
			$height = $data->val($i, 5);
			$size = $data->val($i, 6);
			$status = $data->val($i, 7);
			$hz = $data->val($i, 8);
			$unnumber = $data->val($i, 9);
			$imo = $data->val($i, 10);
			$tmp = $data->val($i, 11);
			$ow = $data->val($i, 12);
			$oh = $data->val($i, 13);
			$ol = $data->val($i, 14);

				//$ukk 			= htmLawed($_GET['ukk'];

			$comm = "";
			$book = "";
			$ship = "I";
			$nor = "";

			$param_b_var = array(
				"v_nc" => "$no_container",
				"v_req" => "$reqNoBiller",
				"v_stc" => "$status",
				"v_hc" => "$hz",
				"v_sc" => "$size",
				"v_tc" => "$type",
				"v_comm" => "$comm",
				"v_imo" => "$imo",
				"v_iso" => "$iso_code",
				"v_book" => "$book",
				"v_hgc" => "$height",
				"v_ship" => "$ship",
				"v_car" => "$carrier",
				"v_tmp" => "$tmp",
				"v_oh" => "$oh",
				"v_ow" => "$ow",
				"v_ol" => "$ol",
				"v_un" => "$unnumber",
				"v_nor" => "$nor",
				"v_jnskeg" => "",
				"v_msg" => ""
			);

				//var_dump($param_b_var); die;

			$msg = "";

			$inv_char = array("&", "\"", "'", "<", ">");
			$fix_char = array(" ", " ", " ", " ", " ");

			$request_no = $req;
			$container_no = $no_container;
			$container_size = $size;
			$container_type = $type;
			$container_status = $status;
			$container_height = $height;
			$container_weight = '';
			$container_operator = $carrier;
			$container_dangerous = $hz;
			$container_imo = $imo;
			$container_un = '';
			$container_temperature = $tmp;
			$container_excess_width = $ow;
			$container_excess_height = $oh;
			$container_excess_length = $ol;
			$trading_type = isset($_POST['trading_type_excel']) ? htmLawed($_POST['trading_type_excel']) : '';
			$carrier = $carrier;
			$port = isset($_POST['port_excel']) ? htmLawed($_POST['port_excel']) : '';
			$commodity = '';

			$in_data = "<root>
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

			if (!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER, "requestReceivingDetail", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
					//echo $result;die;
				$obj = json_decode($result);

				if ($obj->data == 'OK') {
					$jumlah_OK++;
						//$data['no_container'] = $obj->data->request_no;
				} else {
					if ($no_container != '') {
						$param_temp .= $no_container . ' - ' . $obj->data . ' <br>';
					}
				}
			}
				//$param .= $no_container.' - '.$result.' <br>';

		}
		$param = 'Jumlah OK ' . $jumlah_OK . '<br>';
		$param .= $param_temp;
			//echo($param);
		header("Location: " . ROOT . "container_receiving/edit_receiving/" . $req . "/" . ($param));
		die();

	}

	public function add_req_tca()
	{

		$this->redirect();

		$customer_id = $this->session->userdata('customerid_phd');
		$customer_name = $this->session->userdata('customername_phd');
		$address = $this->session->userdata('address_phd');
		$id_port = implode("', '", array_map(function ($result) {
			return $result['ID_PORT'];
		}, $result));
		$id_company = implode("', '", array_map(function ($result) {
			return $result['ID_COMPANY'];
		}, $result));
		$id_holding = implode("', '", array_map(function ($result) {
			return $result['ID_HOLDING'];
		}, $result));

		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Request TCA", '/om/truck/main_tca');
		$this->breadcrumbs->push("Create New Request TCA", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "TID ASSOCIATION";

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>IDJKT</port_code>
				<terminal_code>T3I</terminal_code>
			</data>
		</root>";

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		
		//echo $in_data; die;	

		$this->common_loader($data, 'pages/om/add_req_tca');
	}

	public function main_delivery_ext()
	{

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

		$customer_id = $this->session->userdata('customerid_phd');
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getListRequestDeliveryPerpCompressed", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo result;die;
			$obj = json_decode($result);

			if (isset($obj->data->list_req)) {
				for ($i = 0; $i < count($obj->data->list_req); $i++) {
					$confirm_link = '<span class="label label-default">N/A</span>';
					$view_link = '<a  class=\'btn btn-primary\'  onclick=\'clickDialog1("' . $obj->data->list_req[$i]->id_req . '")\'><i class=\'fa fa-eye\'></i></a>';
					if ($obj->data->list_req[$i]->status == 'N') {
						$label_span = '<span class="label label-info">Draft</span>';

						$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "container/edit_delivery_ext/" . $obj->data->list_req[$i]->id_req . '"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link = '<a  class=\'btn btn-primary\' onclick=\'clickConfirm("' . $obj->data->list_req[$i]->id_req . '");\'><i class=\'fa fa-save\'></i></a>';
					} else if ($obj->data->list_req[$i]->status == 'S') {
						$label_span = '<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';

					} else if ($obj->data->list_req[$i]->status == 'W') {
						$label_span = '<span class="label label-warning">Waiting Approve</span>';

					} else if ($obj->data->list_req[$i]->status == 'R') {
						$label_span = '<span class="label label-danger" title="' . $obj->data->list_req[$i]->reject_notes . '">Rejected</span>';

						$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "container/edit_delivery_ext/" . $obj->data->list_req[$i]->id_req . '"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link = '<a  class=\'btn btn-primary\' onclick=\'clickConfirm("' . $obj->data->list_req[$i]->id_req . '");\'><i class=\'fa fa-save\'></i></a>';
					} else if ($obj->data->list_req[$i]->status == 'P' || $obj->data->list_req[$i]->status == 'T') {
						$label_span = '<span class="label label-success">Paid</span>';

					} else {
						$label_span = '<span class="label label-danger">N/A</span>';

					}
					$this->table->add_row(
						$i + 1,
						$obj->data->list_req[$i]->id_req,
						$obj->data->list_req[$i]->date_request,
						$label_span,
						$obj->data->list_req[$i]->vessel . " " . $obj->data->list_req[$i]->voyage_in . "-" . $obj->data->list_req[$i]->voyage_out,
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

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Extension Delivery", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Extension Delivery";

		$this->common_loader($data, 'pages/container/main_delivery_ext');
	}

	public function search_main_delivery_ext()
	{

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

		$page = isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit = isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : 10;

		$customer_id = $this->session->userdata('customerid_phd');
		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<search>$search</search>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getListRequestDeliveryPerpCompressed", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if (isset($obj->data->list_req)) {
				for ($i = 0; $i < count($obj->data->list_req); $i++) {
					$confirm_link = '<span class="label label-default">N/A</span>';
					$view_link = '<a  class=\'btn btn-primary\'  onclick=\'clickDialog1("' . $obj->data->list_req[$i]->id_req . '")\'><i class=\'fa fa-eye\'></i></a>';
					if ($obj->data->list_req[$i]->status == 'N') {
						$label_span = '<span class="label label-info">Draft</span>';

						$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "container/edit_delivery_ext/" . $obj->data->list_req[$i]->id_req . '"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link = '<a  class=\'btn btn-primary\' onclick=\'clickConfirm("' . $obj->data->list_req[$i]->id_req . '");\'><i class=\'fa fa-save\'></i></a>';
					} else if ($obj->data->list_req[$i]->status == 'S') {
						$label_span = '<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';

					} else if ($obj->data->list_req[$i]->status == 'W') {
						$label_span = '<span class="label label-warning">Waiting Approve</span>';

					} else if ($obj->data->list_req[$i]->status == 'R') {
						$label_span = '<span class="label label-danger" title="' . $obj->data->list_req[$i]->reject_notes . '">Rejected</span>';

						$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "container/edit_delivery_ext/" . $obj->data->list_req[$i]->id_req . '"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link = '<a  class=\'btn btn-primary\' onclick=\'clickConfirm("' . $obj->data->list_req[$i]->id_req . '");\'><i class=\'fa fa-save\'></i></a>';
					} else if ($obj->data->list_req[$i]->status == 'P' || $obj->data->list_req[$i]->status == 'T') {
						$label_span = '<span class="label label-success">Paid</span>';

					} else {
						$label_span = '<span class="label label-danger">N/A</span>';

					}
					$this->table->add_row(
						$i + 1,
						$obj->data->list_req[$i]->id_req,
						$obj->data->list_req[$i]->date_request,
						$label_span,
						$obj->data->list_req[$i]->vessel . " " . $obj->data->list_req[$i]->voyage_in . "-" . $obj->data->list_req[$i]->voyage_out,
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
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		$no_req = $_POST["no_req"];
		injek($no_req);
		$result = $this->container_model->getDetailBilling($no_req);

		echo json_encode($result);
	}

	public function billing_management($search = "")
	{
		//$this->redirect();

		$customer_id = $this->session->userdata('customerid_phd');
		$group_id = $this->session->userdata('group_phd');

		//create table
		$result = $this->container_model->getNumberReqAndSourceByCust($customer_id);
		$cekship = $this->master_model->cek_shippingline();
		$is_shipping = $this->master_model->cek_shippingline();
		if ($is_shipping == 'N') {
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
		} else {
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
		$i = 1;
		foreach ($result as $row) {
			$label_span = "";
			$view_link = '<a  class=\'btn btn-primary\' onclick=\'clickDialog1("' . $row['REQUEST_ID'] . '");\'><i class=\'fa fa-eye\'></i></a>';
			$urlcard_blanko = "";
			if ($row['MODUL_DESC'] == 'RECEIVING') {
				$urlproforma = ROOT . "container_receiving/print_proforma";
				$urlproforma2 = ROOT . "container_receiving/print_proforma_thermal";
				$urlnota = ROOT . "container_receiving/print_nota";
				$urlcard = ROOT . "container_receiving/print_card2";
				$urlcardthermal = ROOT . "container_receiving/print_card_thermal";
			} else if (($row['MODUL_DESC'] == 'DELIVERY') or ($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY')) {
				$urlproforma = ROOT . "container/download_proforma_delivery";
				$urlproforma2 = ROOT . "container/dw_prodelv_thermal";
				$urlnota = ROOT . "container/download_invoice_delivery";
				$urlcard = ROOT . "container/print_card_delivery";
				$urlcardthermal = "";
				$urlcard_blanko = ROOT . "container/print_card_delply";
			} else if (($row['MODUL_DESC'] == 'CALBG') or ($row['MODUL_DESC'] == 'CALDG') or ($row['MODUL_DESC'] == 'CALAG')) {
				$urlproforma = ROOT . "container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT . "container_alihkapal/download_probm_thermal";
				$urlnota = ROOT . "container_alihkapal/download_invoice_bm";
				if (($row['MODUL_DESC'] == 'CALBG') or ($row['MODUL_DESC'] == 'CALDG'))
					$urlcard = ROOT . "container_alihkapal/download_card_bm";
				else
					$urlcard = ROOT . "container_alihkapal/download_card_bmdel";
				$urlcardthermal = "";
			} else {
				$urlproforma = ROOT . "container/download_proforma_ext_delivery";
				$urlproforma2 = ROOT . "container/dw_prodelv_thermal";
				$urlnota = ROOT . "container/download_nota_ext_delivery";
				$urlcard = ROOT . "container/print_card_delivery";
				$urlcardthermal = "";
			}

			if ($row['STATUS_REQ'] == "N") {
				$label_span = '<span class="label label-info">Draft</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "W") {
				$label_span = '<span class="label label-warning">Waiting Approve</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "R") {
				$label_span = '<span class="label label-danger" title="' . $row['REJECT_NOTES'] . '">Reject</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "S") {
				$label_span = '<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='" . $urlproforma . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'>
				<i class='fa fa-file-pdf-o'></i></a>";
				//if($cekship=='Y')
				if (1) {
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='" . $urlproforma2 . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				} else {
					$proformalink2 = "";
				}

				$proformalink = $proformalink1 . $proformalink2;
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "P" || $row['STATUS_REQ'] == "T") {
				$label_span = '<span class="label label-success">Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='" . $urlproforma . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-pdf-o'></i></a>";
				$notalink = "<a class='btn btn-primary' target='_blank' href='" . $urlnota . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-pdf-o'></i></a>";
				$cardlink = "<a class='btn btn-primary' target='_blank' href='" . $urlcard . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-text-o'></i></a>";
				if (($row['MODUL_DESC'] == 'DELIVERY') || ($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY')) {
					$cardlink .= " <a title='SP2 Blanko' class='btn btn-success' $disable_card target='_blank' href='" . $urlcard_blanko . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-files-o'></i></a>";
				}
				if ($row['MODUL_DESC'] == 'RECEIVING') {
					$cardthermallink = "<a class='btn btn-primary' target='_blank' $disable_card href='" . $urlcardthermal . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-text-o'></i></a>";
				} else
					$cardthermallink = "-";

				//if($cekship=='Y')
				if (1) {
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='" . $urlproforma2 . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				} else {
					$proformalink2 = "";
				}
				$proformalink = $proformalink1 . $proformalink2;
			} else {
				$label_span = '<span class="label label-danger">N/A</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}

			if ($group_id == "m") {
				$cardlink = "<a class='btn btn-primary' disabled href=''><i class='fa fa-file-text-o'></i></a>";
				$cardthermallink = "<a class='btn btn-primary'  disabled  href=''><i class='fa fa-file-text-o'></i></a>";
			}

			$is_shipping = $this->master_model->cek_shippingline();
			if ($is_shipping == 'N') {
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
			} else {
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

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Billing Management", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Billing Management"; //get_content($this->user_model,"billing_management","billing_management");

		$this->common_loader($data, 'pages/container/billing_management');

	}

	public function search_billing_management()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}

		$group_id = $this->session->userdata('group_phd');


		$page = isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit = isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : 10;

		$customer_id = $this->session->userdata('customerid_phd');
		$cekship = $this->master_model->cek_shippingline();
		//create table
		$result = $this->container_model->getNumberReqAndSourceBySearch($customer_id, $search);

		$is_shipping = $this->master_model->cek_shippingline();
		if ($is_shipping == 'N') {
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
		} else {
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
		$i = 1;
		foreach ($result as $row) {
			$label_span = "";
			$view_link = '<a  class=\'btn btn-primary\' onclick=\'clickDialog1("' . $row['REQUEST_ID'] . '");\'><i class=\'fa fa-eye\'></i></a>';
			$urlcard_blanko = "";
			if ($row['MODUL_DESC'] == 'RECEIVING') {
				$urlproforma = ROOT . "container_receiving/print_proforma";
				$urlproforma2 = ROOT . "container_receiving/print_proforma_thermal";
				$urlnota = ROOT . "container_receiving/print_nota";
				$urlcard = ROOT . "container_receiving/print_card2";
				$urlcardthermal = ROOT . "container_receiving/print_card_thermal";
			} else if (($row['MODUL_DESC'] == 'DELIVERY') or ($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY')) {
				$urlproforma = ROOT . "container/download_proforma_delivery";
				$urlproforma2 = ROOT . "container/dw_prodelv_thermal";
				$urlnota = ROOT . "container/download_invoice_delivery";
				$urlcard = ROOT . "container/print_card_delivery";
				$urlcardthermal = "";
				$urlcard_blanko = ROOT . "container/print_card_delply";
			} else if (($row['MODUL_DESC'] == 'CALBG') or ($row['MODUL_DESC'] == 'CALDG') or ($row['MODUL_DESC'] == 'CALAG')) {
				$urlproforma = ROOT . "container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT . "container_alihkapal/download_probm_thermal";
				$urlnota = ROOT . "container_alihkapal/download_invoice_bm";
				if (($row['MODUL_DESC'] == 'CALBG') or ($row['MODUL_DESC'] == 'CALDG'))
					$urlcard = ROOT . "container_alihkapal/download_card_bm";
				else
					$urlcard = ROOT . "container_alihkapal/download_card_bmdel";
				$urlcardthermal = "";
			} else {
				$urlproforma = ROOT . "container/download_proforma_ext_delivery";
				$urlproforma2 = ROOT . "container/dw_prodelv_thermal";
				$urlnota = ROOT . "container/download_nota_ext_delivery";
				$urlcard = ROOT . "container/print_card_delivery";
				$urlcardthermal = "";
			}

			if ($row['STATUS_REQ'] == "N") {
				$label_span = '<span class="label label-info">Draft</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "W") {
				$label_span = '<span class="label label-warning">Waiting Approve</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "R") {
				$label_span = '<span class="label label-danger" title="' . $row['REJECT_NOTES'] . '">Reject</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "S") {
				$label_span = '<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='" . $urlproforma . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'>
				<i class='fa fa-file-pdf-o'></i></a>";
				//if($cekship=='Y')
				if (1) {
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='" . $urlproforma2 . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				} else {
					$proformalink2 = "";
				}

				$proformalink = $proformalink1 . $proformalink2;
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			} else if ($row['STATUS_REQ'] == "P" || $row['STATUS_REQ'] == "T") {
				$label_span = '<span class="label label-success">Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='" . $urlproforma . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-pdf-o'></i></a>";
				$notalink = "<a class='btn btn-primary' target='_blank' href='" . $urlnota . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-pdf-o'></i></a>";
				$cardlink = "<a class='btn btn-primary' target='_blank' href='" . $urlcard . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-text-o'></i></a>";
				if ($row['MODUL_DESC'] == 'DELIVERY') {
					$cardlink .= " <a title='SP2 Blanko' class='btn btn-success' target='_blank' href='" . $urlcard_blanko . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-files-o'></i></a>";
				}
				if ($row['MODUL_DESC'] == 'RECEIVING') {
					$cardthermallink = "<a class='btn btn-primary' target='_blank' href='" . $urlcardthermal . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'><i class='fa fa-file-text-o'></i></a>";
				} else
					$cardthermallink = "-";

				//if($cekship=='Y')
				if (1) {
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='" . $urlproforma2 . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				} else {
					$proformalink2 = "";
				}
				$proformalink = $proformalink1 . $proformalink2;
			} else {
				$label_span = '<span class="label label-danger">N/A</span>';
				$proformalink = "-";
				$notalink = "-";
				$cardlink = "-";
				$cardthermallink = "-";
			}

			if ($group_id == "m") {
				$cardlink = "<a class='btn btn-primary' disabled href=''><i class='fa fa-file-text-o'></i></a>";
				$cardthermallink = "<a class='btn btn-primary'  disabled  href=''><i class='fa fa-file-text-o'></i></a>";
			}

			$is_shipping = $this->master_model->cek_shippingline();
			if ($is_shipping == 'N') {
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
			} else {
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

	public function search_main_truck()
	{
		//echo "hahaha";
		//die();
		$this->redirect();
		$customer_id = $this->session->userdata('customerid_phd');
		$group_id = $this->session->userdata('group_phd');

		$page = isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit = isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search = isset($_POST['search']) ? htmLawed($_POST['search']) : 10;
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
		$customer_id = $this->session->userdata('customerid_phd');
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<search_tid>$search</search_tid>
			</data>
		</root>";
		//echo $in_data;
		//die();

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "srchTruckReg", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;
			//die;
			$obj = json_decode($result);

			if ($obj->data->listreq) {

				$i = 1;
				for ($i = 0; $i < count($obj->data->listreq); $i++) {
					$label_span = '<span class="label label-default">N/A</span>';
					$view_link = '<a  class=\'btn btn-primary\' onclick=\'clickDialog1("' . $row['REQUEST_ID'] . '");\'><i class=\'fa fa-eye\'></i></a>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link = '<span class="label label-default">N/A</span>';
					$cancel_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "om/truck/cancel_tid/" . $obj->data->listreq[$i]->TID . '"><i class=\'fa fa-trash-o\'></i></a>';
					$confirm_link = '<span class="label label-default">N/A</span>';

					$this->table->add_row(
						$i + 1,
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
				echo "<span style='color:red'>" . $obj->rcmsg . "</span>";
			}
		}

		$this->load->view('pages/om/search_main_truck', $data);;
	}

	public function upload_excel_truck()
	{
			//include "excel_reader2.php";
		include_once(APPPATH . "libraries/excel_reader2.php");
		$port_excel = $_POST['port_excel'];
		$id_req_excel = $_POST['id_req_excel'];
		$bl_number_excel = $_POST['bl_number_excel'];
		$id_vvd_excel = $_POST['id_vvd_excel'];
		$e_i_excel = $_POST['e_i_excel'];
		$id_servicetype_excel = $_POST['id_servicetype_excel'];
		$servicetype_excel = $_POST['servicetype_excel'];
			
			//get detail delivery
		$port = explode("-", $port_excel);

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
		$param_temp = "";
		$temp = null;
		$jumlah_OK = 0;
			//echo($baris);die;
			//import data excel dari baris kedua, karena baris pertama adalah nama kolom
		for ($i = 2; $i <= $baris; $i++) {
				//membaca data nama depan (kolom ke-1)  (No Container)
			$no_truck = $data->val($i, 1);
				//$ukk 			= $_GET['ukk'];
			if ($no_truck != "") {
				$stack = array();

					//no error
					// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
					// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal

				$in_data = "	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<tid>$no_truck</tid>
								<port_code>" . $port[0] . "</port_code>
								<terminal_code>" . $port[1] . "</terminal_code>
							</data>
						</root>";
					//echo $in_data;die;
				injek($in_data);
				if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getTruckID", array("in_data" => "$in_data"), $result)) {
					echo $result;
					die;
				} else {
						//echo $result;die;
					$obj = json_decode($result);

					if ($obj->data->container) {
						for ($j = 0; $j < count($obj->data->container); $j++) {
							$temp = null;
							$temp['TID'] = $obj->data->container[$j]->tid;
							$temp['TRUCK_NUMBER'] = $obj->data->container[$j]->truck_number;
							$temp['PROXIMITY'] = $obj->data->container[$j]->rfid_code;
							$temp['COMPANY_NAME'] = $obj->data->container[$j]->company_name;
							$temp['ID_TRUCK'] = $obj->data->container[$j]->id_truck;
							array_push($stack, $temp);
						}
					}
				}

					//add container to request delivery
				$stack = array();

				if ($temp != null) {
					try {
							//no error
							// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
							// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
						$in_data = "	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>" . $port[0] . "</port_code>
					<terminal_code>" . $port[1] . "</terminal_code>
					<no_req>$id_req_excel</no_req>
					<tid>" . $temp['TID'] . "</tid>
					<truck_number>" . $temp['TRUCK_NUMBER'] . "</truck_number>
					<bl_number>$bl_number_excel</bl_number>
					<truck_company>" . $temp['COMPANY_NAME'] . "</truck_company>
					<rfid_code>" . $temp['PROXIMITY'] . "</rfid_code>
					<ei>$e_i_excel</ei>
					<id_vvd>$id_vvd_excel</id_vvd>
					<id_servicetype>$id_servicetype_excel</id_servicetype>
					<service_type>$servicetype_excel</service_type>
					<id_truck>" . $temp['ID_TRUCK'] . "</id_truck>
				</data>
			</root>";
						injek($in_data);
			
			//echo $in_data;
			//die();
						if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "addDetailTCA", array("in_data" => "$in_data"), $result)) {
							echo $result;
							die;
						} else {
								//echo $result;die;
							$obj = json_decode($result);


							if ($obj->data->info) {
								if ($obj->data->info == 'OK') {
									$jumlah_OK++;
								} else {
									$param_temp .= $no_truck . ' - ' . $obj->data->info . ' <br>';
								}
							} else {
								$param_temp .= $no_truck . ' Sudah Terinput <br> ';
							}
						}

					} catch (Exception $e) {
						echo "NO,GAGAL1";
					}
				} else {
					$param_temp .= $no_truck . ' - Truck Not Found <br>';
				}
			}
		}
		$param = 'Jumlah OK ' . $jumlah_OK . '<br>';
		$param .= $param_temp;
			//echo($param_temp);
			//print_r($param_temp);
			//$param='Jumlah OK '.$jumlah_OK.'<br>';
			//$param.=$param_temp;
			//echo($param);
		$param = str_replace("^", "-", $param);
		$param = str_replace(",", " ", $param);
		header("Location: " . ROOT . "om/truck/edit_tca/" . $id_req_excel . "/" . ($param));
		die();
	}

	public function payment()
	{

		$this->redirect();

		//create table
		$this->table->set_heading('NO', '', 'REQUEST NUMBER', 'VESSEL - VOYAGE', 'PORT - TERMINAL', 'REQUEST DATE', 'STATUS', 'DOWNLOAD PROFORMA');

		$customer_id = $this->session->userdata('custid_phd');

		$result = $this->container_model->getReqNotPaidByCust($customer_id);

		$i = 0;
		$cekship = $this->master_model->cek_shippingline();
		foreach ($result as $row) {
			$label_span = "";

			$inv_char = array("+");
			$fix_char = array(" ");

			$vessel_get = str_replace($inv_char, $fix_char, urlencode($row['VESSEL']));
			$voyage_in_get = urlencode($row['VOYAGE_IN']);
			$voyage_out_get = urlencode($row['VOYAGE_OUT']);

			if ($row['MODUL_DESC'] == 'RECEIVING') {
				$urlproforma = ROOT . "container_receiving/print_proforma";
				$urlproforma2 = ROOT . "container_receiving/print_proforma_thermal";
				$urlnota = ROOT . "container_receiving/print_nota";
				$urlcard = ROOT . "container_receiving/print_card2";
			} else if ($row['MODUL_DESC'] == 'DELIVERY') {
				$urlproforma = ROOT . "container/download_proforma_delivery";
				$urlproforma2 = ROOT . "container/dw_prodelv_thermal";
				$urlnota = ROOT . "container/download_invoice_delivery";
				$urlcard = ROOT . "container/print_card_delivery";
			} else if ($row['MODUL_DESC'] == 'PERPANJANGAN DELIVERY') {
				$urlproforma = ROOT . "container/download_proforma_delivery";
				$urlproforma2 = ROOT . "container/dw_prodelv_thermal";
				$urlnota = ROOT . "container/download_nota_ext_delivery";
				$urlcard = ROOT . "container/print_card_delivery";
			} else if ($row['MODUL_DESC'] == 'CALBG') {
				$urlproforma = ROOT . "container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT . "container_alihkapal/download_probm_thermal";
				$urlnota = ROOT . "container_alihkapal/download_invoice_bm";
				$urlcard = ROOT . "container_alihkapal/download_card_bm";
			} else if ($row['MODUL_DESC'] == 'CALAG') {
				$urlproforma = ROOT . "container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT . "container_alihkapal/download_probm_thermal";
				$urlnota = ROOT . "container_alihkapal/download_invoice_bm";
				$urlcard = ROOT . "container_alihkapal/download_card_bm";
			} else if ($row['MODUL_DESC'] == 'CALDG') {
				$urlproforma = ROOT . "container_alihkapal/download_proforma_bm";
				$urlproforma2 = ROOT . "container_alihkapal/download_probm_thermal";
				$urlnota = ROOT . "container_alihkapal/download_invoice_bm";
				$urlcard = ROOT . "container_alihkapal/download_card_bm";
			}

			if ($row['CONFIRMED'] > 0) {
				$confirmed = '<span class="badge badge-success"><i class="fa fa-check"> confirmed</span>';
			} else
				$confirmed = '';

			if ($row['STATUS_REQ'] == "N") {
				$label_span = '<span class="label label-info">Draft</span>';
				$download_proforma = "-";
				$payment = "-";
				$download_invoice = "-";
				$download_card = "-";
				$checkbox = "";
			} else if ($row['STATUS_REQ'] == "W") {
				$label_span = '<span class="label label-warning">Waiting Approve</span>';
				$download_proforma = "-";
				$payment = "-";
				$download_invoice = "-";
				$download_card = "-";
				$checkbox = "";
			} else if ($row['STATUS_REQ'] == "R") {
				$label_span = '<span class="label label-danger">Reject</span>';
				$download_proforma = "-";
				$payment = "-";
				$download_invoice = "-";
				$download_card = "-";
				$checkbox = "";
			} else if ($row['STATUS_REQ'] == "S") {
				$label_span = '<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='" . $urlproforma . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'>
				<i class='fa fa-file-pdf-o'></i></a>";
				if ($cekship == 'Y') {
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='" . $urlproforma2 . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				} else {
					$proformalink2 = "";
				}

				$download_proforma = $proformalink1 . $proformalink2;


				$payment = '<a class="btn btn-primary" href="' . ROOT . "container/payment_confirmation/" . $row['REQUEST_ID'] . '/' . $row['PORT_ID'] . '/' . $row['TERMINAL_ID'] . '/' . $row['PRF_NUMBER'] . '/' . $vessel_get . '/' . $voyage_in_get . '/' . $voyage_out_get . '" title="Konfirmasi Pembayaran"><i class="fa fa-money"></i></a>
				' . $confirmed;
				$download_invoice = "-";
				$download_card = "-";
				$checkbox = '<input type="checkbox" id="id_proforma" name="id_proforma[]" value="' . $row['PRF_NUMBER'] . '"/>';
			} else if ($row['STATUS_REQ'] == "P" || $row['STATUS_REQ'] == "T") {
				$label_span = '<span class="label label-success">Paid</span>';
				$proformalink1 = "<a class='btn btn-primary' target='_blank' href='" . $urlproforma . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "'>
				<i class='fa fa-file-pdf-o'></i></a>";
				if ($cekship == 'Y') {
					$proformalink2 = " <a class='btn btn-success' target='_blank' href='" . $urlproforma2 . "/" . $row['REQUEST_ID'] . "/" . $row['PORT_ID'] . "/" . $row['TERMINAL_ID'] . "/" . md5($row['REQUEST_ID']) . "' title='proforma thermal'>
					<i class='fa fa-files-o'></i></a>";
				} else {
					$proformalink2 = "";
				}

				$download_proforma = $proformalink1 . $proformalink2;
				$payment = '-';
				$download_invoice = '<a class="btn btn-primary" href="' . $urlnota . "/" . $row['REQUEST_ID'] . '/' . $row['PORT_ID'] . '/' . $row['TERMINAL_ID'] . '" title="Download Nota"><i class="fa fa-file-pdf-o"></a>';
				$download_card = '<a class="btn btn-primary" href="' . $urlcard . "/" . $row['REQUEST_ID'] . '/' . $row['PORT_ID'] . '/' . $row['TERMINAL_ID'] . '" title="Download Kartu"><i class="fa fa-file-pdf-o"></a>';
				$checkbox = "";
			} else {
				$label_span = '<span class="label label-danger">N/A</span>';
				$download_proforma = "-";
				$payment = '-';
				$download_invoice = "-";
				$download_card = "-";
				$checkbox = "";
			}

			$this->table->add_row(
				++$i,
				$checkbox,
				$this->security->xss_clean($row['REQUEST_ID']),
				$this->security->xss_clean($row['VESSEL']) . " " . $this->security->xss_clean($row['VOYAGE_IN']) . "-" . $this->security->xss_clean($row['VOYAGE_OUT']),
				$this->security->xss_clean($row['PORT_ID']) . "-" . $this->security->xss_clean($row['TERMINAL_ID']),
				$this->security->xss_clean($row['REQUEST_DATE']),
				$label_span,
				$download_proforma//,
				//$payment
//						$download_invoice,
//						$download_card
			);
		}

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Invoice and Payment', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = 'Invoice and Payment';

		$this->common_loader($data, 'pages/container/payment');
	}

	public function payment_history()
	{
		$customer_id = $this->session->userdata('customerid_phd');

		$app_id = "ebpp_01";
		$user = "ptp";
		$pass = "ptp";

		$key = base64_encode(sha1("SeIPel2" . $app_id . $user . $pass . $customer_id));

		$data['url'] = IPAY_LOG . "?app_id=" . $app_id . "&user=" . $user . "&pass=" . $pass . "&cust_id=" . $customer_id . "&key=" . $key;
		$this->common_loader($data, 'pages/epayment/payment_history_ilcs');
	}

	public function upload_doc($req, $varfile)
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		$file = '';

		try {
			if ($varfile == 'do_upload') {
				$folderfile = 'upload_do';
				$file = basename($_FILES['do_upload']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			} else if ($varfile == 'sppb_upload') {
				$folderfile = 'upload_sppb';
				$file = basename($_FILES['sppb_upload']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			} else if ($varfile == 'sp_custom_upload') {
				$folderfile = 'upload_sp_custom';
				$file = basename($_FILES['sp_custom_upload']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			} else if ($varfile == 'peb_upload') {
				$folderfile = 'upload_peb';
				$file = basename($_FILES['peb_upload']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			} else if ($varfile == 'npe_upload') {
				$folderfile = 'upload_npe';
				$file = basename($_FILES['npe_upload']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			} else if ($varfile == 'booking_ship_upload') {
				$folderfile = 'upload_bookingship';
				$file = basename($_FILES['booking_ship_upload']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			} else if ($varfile == 'booking_ship_upload_dom') {
				$folderfile = 'upload_bookingship';
				$file = basename($_FILES['booking_ship_upload_dom']['name'], '.pdf');
				if ($file != "") {
					$file = $file . '-' . time();
				}
			}

			$path = UPLOADFOLDER_ . $folderfile;
			$config = array(
				'upload_path' => $path,
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => true,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'file_name' => $file,
				'max_width' => "1024"
			);

			$this->load->library('upload');
			$this->upload->initialize($config);
			if ($varfile == 'booking_ship_upload_dom') {
				$varfile = 'booking_ship_upload';
			}
			$this->upload->do_upload($varfile);
			$data = $this->upload->data();
			$fullpath = APP_ROOT . $folderfile . "/" . $data['file_name']; //file_name
			echo $this->upload->display_errors('<p>', '</p>');

			$fullfile = $path . "/" . $data['file_name']; //full file_name
			log_message('debug', 'value fullfile: ' . $fullfile);
			$this->scan_virus($fullfile); //scan file disini

			injek($folderfile);
			injek($req);
			injek($fullpath);
			injek($data['file_name']);
			if (isset($data['file_name']) && $data['file_name'] != "")//kalau tidak ada filenya jangan di simpan di log
			$this->container_model->update_docfile($folderfile, $req, $fullpath, $data['file_name'], $this->session->userdata('uname_phd'));

			echo "sukses";
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			echo show_error($err->getMessage());
		}
	}

	public function scan_virus($file)
	{
		/* contoh result scan clamav
		file valid				-> index.php: OK ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 0 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 13.927 sec (0 m 13 s)
		file terinfeksi virus	-> eicar.com.txt: Eicar-Test-Signature FOUND ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 1 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 14.098 sec (0 m 14 s) */
		$scan_process = shell_exec('clamscan ' . $file);
		log_message('debug', 'hasil scan: ' . $scan_process);
		if (strpos($scan_process, 'OK') != false) {
			log_message('debug', 'hasil scan file: ' . $file . ' tidak terinfeksi virus.');
			return 'lolos';
		} else {
			log_message('debug', 'hasil scan file: ' . $file . ' terinfeksi virus');
			return 'infected';
		}
	}

	public function confirm_request()
	{
		$this->redirect();

		$req = htmLawed($_POST['REQUEST']);

		$status_req = $this->container_model->getStatusRequest($req);

		if ($status_req == "W") {
			echo "Failed, Request Already Confirm";
			die();
		} else if ($status_req == "S") {
			echo "Failed, Request Already Approve";
			die();
		} else if ($status_req == "P") {
			echo "Failed, Request Already Paid";
			die();
		}

		$reqNoBiller = $this->container_model->getNumberRequestBiller($req);
		$kodeModul = $this->container_model->getKodeModul($req);
		$detail = $this->container_model->getDetailBilling($req);

		switch ($kodeModul) {
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

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<biller_request_id>$reqNoBiller</biller_request_id>
				<port_code>" . $detail['PORT_ID'] . "</port_code>
				<terminal_code>" . $detail['TERMINAL_ID'] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl($wsdl, "getCountContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);
			if ($obj->rc != "S") {
				echo $obj->rcmsg;
				die;
			}
		}

		$is_shipping = $this->master_model->cek_shippingline();
		if ($is_shipping == 'Y' && $detail['TERMINAL_ID'] <> 'T3I' && $detail['TERMINAL_ID'] <> 'PNJI') {
			$this->container_model->confirmRequest($req, $this->session->userdata('uname_phd'));
			switch ($kodeModul) {
				case "PTKM00"://receiving
					$in_data = "<root>
										<sc_type>1</sc_type>
										<sc_code>123456</sc_code>
										<data>
												<detail>
														<request_no>$reqNoBiller</request_no>
														<port_code>" . $detail['PORT_ID'] . "</port_code>
														<terminal_code>" . $detail['TERMINAL_ID'] . "</terminal_code>
														<user_id>" . $this->session->userdata('uname_phd') . "</user_id>
												</detail>
										</data>
								</root>";

					if (!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER, "submitRequestReceiving", array("in_data" => "$in_data"), $result)) {
						echo $result;
						exit;
					} else {
						$rwresult = json_decode($result);
						if ($rwresult->rc == 'S') {
							echo "Success";
						} else {
							echo "Failed, " . $rwresult->rcmsg;
						}
						die();
					}
					break;
				case "PTKM01"://delivery
						//$wsdl = REQUEST_DELIVERY_CONTAINER;
					$in_data = "	<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<no_request>$reqNoBiller</no_request>
									<port_code>" . $detail['PORT_ID'] . "</port_code>
									<terminal_code>" . $detail['TERMINAL_ID'] . "</terminal_code>
									<user_id>" . $this->session->userdata('uname_phd') . "</user_id>
								</data>
							</root>";

					if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "saveRequestDelivery", array("in_data" => "$in_data"), $result)) {
						echo $result;
						exit;
					} else {
									//echo $result;die;
						$rwresult = json_decode($result);
						if ($rwresult->rc == 'S') {
							echo "Success";
						} else {
							echo "Failed, " . $rwresult->rcmsg;
						}
						die();
					}

					break;
				case "PTKM07"://delivery perpanjangan
						//$wsdl = REQUEST_PERPANJANGAN_DELIVERY;
					$in_data = "	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_request>$reqNoBiller</no_request>
								<port_code>" . $detail['PORT_ID'] . "</port_code>
								<terminal_code>" . $detail['TERMINAL_ID'] . "</terminal_code>
								<user_id>" . $this->session->userdata('uname_phd') . "</user_id>
							</data>
						</root>";

					if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "submitRequestDeliveryPerp", array("in_data" => "$in_data"), $result)) {
						echo $result;
						exit;
					} else {
						$rwresult = json_decode($result);
						if ($rwresult->rc == 'S') {
							echo "Success";
						} else {
							echo "Failed, " . $rwresult->rcmsg;
						}
						die();
					}
					break;
				case "PTKM08"://batal muat
							//$wsdl = REQUEST_BATALMUAT;
					$in_data = "	<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<no_request>$reqNoBiller</no_request>
									<port_code>" . $detail['PORT_ID'] . "</port_code>
									<terminal_code>" . $detail['TERMINAL_ID'] . "</terminal_code>
									<user_id>" . $this->session->userdata('uname_phd') . "</user_id>
								</data>
							</root>";

							//print_r($in_data);die;
					if (!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT, "saveRequestBatalMuat", array("in_data" => "$in_data"), $result)) {
						echo $result;
						die;
					} else {
						$rwresult = json_decode($result);
						if ($rwresult->rc == 'S') {
							echo "Success";
						} else {
							echo "Failed, " . $rwresult->rcmsg;
						}
						die();
					}
					break;
				default:
					$wsdl = "not defined modul";
					break;
			}
		} else {
			echo $this->container_model->confirmRequest($req, $this->session->userdata('uname_phd'));
		}
	}

	public function reject_request()
	{
		$this->redirect();

		$req = $_POST['REQUEST'];
		$reject_notes = $_POST['REJECT_NOTES'];

		echo $this->container_model->rejectRequest($req, $reject_notes, $this->session->userdata('uname_phd'));

		$results = $this->container_model->getUserInfoByRequestNumber($req);
		$from = "";
		$to = $results["EMAIL"];
		$subject = "Request Rejected Notification - " . $req;
		$content = "Yth. " . $results["NAME"] . ",<br>
					<br>
					Request Anda dengan Nomor Request " . $req . "/" . $results["BILLER_REQUEST_ID"] . " telah ditolak dengan alasan berikut:<br>
					<br>
					$reject_notes.<br>
					<br>
					<br>
					Untuk informasi dan bantuan lebih lanjut, mohon menghubungi Customer Service kami di nomor (021) 4301080 ext. 2713.<br>
					<br>
					<br>
					Terima kasih,<br>
					<br>
					<br>
					<br>
					PT. Pelabuhan Tanjung Priok<br>
					<br>
					JL.Raya Pelabuhan No.8 Tanjung Priok Jakarta 14310<br>
					DKI Jakarta, Indonesia<br>
					www.priokport.co.id<br>
					<br>
					<br>
					<br>
					Dear " . $results["NAME"] . ",<br>
					<br>
					Your booking request with request number " . $req . "/" . $results["BILLER_REQUEST_ID"] . " has been rejected with the following reason :
					<br>
					$reject_notes.<br>
					<br>
					For any information and inquiries, please call our customer service at (021) 4301080 ext. 2713.<br>
					<br>
					<br>
					Warm Regards,<br>
					<br>
					<br>
					<br>
					PT. Pelabuhan Tanjung Priok<br>
					<br>
					JL.Raya Pelabuhan No.8 Tanjung Priok Jakarta 14310<br>
					DKI Jakarta, Indonesia<br>
					www.priokport.co.id<br>
					";

		$rs = $this->user_model->email_notification($from, $to, $subject, $content);


	}

	public function create_truck_registration()
	{

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
		$id_port = implode(', ', array_map(function ($result) {
			return $result['ID_PORT'];
		}, $result));
		$id_company = implode(', ', array_map(function ($result) {
			return $result['ID_COMPANY'];
		}, $result));
		$id_holding = implode(', ', array_map(function ($result) {
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
		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getTruckReg", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);

			if ($obj->data->listreq) {

				$i = 1;

				for ($i = 0; $i < count($obj->data->listreq); $i++) {
						//echo $obj->data->listreq[$i]->ID_SERVICETYPE;

					$label_span = '<span class="label label-default">N/A</span>';
					//$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					$view_link = '<span class="label label-default">N/A</span>';
					//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link = '<span class="label label-default">N/A</span>';
					$cancel_link = '<span class="label label-default">N/A</span>';
					$confirm_link = '<span class="label label-default">N/A</span>';

					$label_span = '<span class="label label-info">Draft</span>';
						//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
					$edit_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "om/truck/edit_tid/" . $obj->data->listreq[$i]->TID . '"><i class=\'fa fa-pencil\'></i></a>';
					$cancel_link = '<a  class=\'btn btn-primary\'  href="' . ROOT . "om/truck/cancel_tid/" . $obj->data->listreq[$i]->TID . '"><i class=\'fa fa-trash-o\'></i></a>';
					$confirm_link = '<a  class=\'btn btn-primary\' onclick=\'clickConfirm("' . $row['REQUEST_ID'] . '");\'><i class=\'fa fa-save\'></i></a>';


					$this->table->add_row(
						$i + 1,
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
				echo "<span style='color:red'>" . $obj->rcmsg . "</span>";
			}
		}

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Truck Service", '/container/main_delivery');
		$this->breadcrumbs->push("Input Truck ID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Truck ID Registration";

		$this->common_loader($data, 'pages/om/truck_reg');
	}

	public function edit_tca($no_request, $message = null)
	{

		$this->redirect();

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));

		$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<request_id>$no_request</request_id>
				<port_code>" . $data['request_data'][0]['PORT_ID'] . "</port_code>
				<terminal_code>" . $data['request_data'][0]['TERMINAL_ID'] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getEditTCA", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			//var_dump($obj); die;
			if ($obj->data->request) {
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

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Request TCA", '/container/main_delivery');
		$this->breadcrumbs->push("Edit Request TCA", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Edit Request TCA";

		$this->common_loader($data, 'pages/om/edit_tca');
	}

	public function edit_tid($tid)
	{

		$this->redirect();

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));

		$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<tid>$tid</tid>
				<port_code>" . $data['request_data'][0]['PORT_ID'] . "</port_code>
				<terminal_code>" . $data['request_data'][0]['TERMINAL_ID'] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getEditTID", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			//var_dump($obj); die;
			if ($obj->data->request) {
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

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("TID Registration", 'truck/create_truck_registration');
		$this->breadcrumbs->push("Edit TID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Edit TID";

		$this->common_loader($data, 'pages/om/edit_tid');
	}



	public function add_delivery_ext()
	{

		$this->redirect();

		$data['is_shipping'] = $this->master_model->cek_shippingline();
		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Extension Delivery", '/container/main_delivery_ext');
		$this->breadcrumbs->push("Add Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Extension Delivery Booking";

		$this->common_loader($data, 'pages/container/add_delivery_ext');
	}

	public function edit_delivery_ext($norequest)
	{

		$this->redirect();

		$data['request_data'] = $this->container_model->get_request_ext_delivery($norequest);

		$reqNoBiller = $this->container_model->getNumberRequestBiller($norequest);

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<request_id>$reqNoBiller</request_id>
				<port_code>" . $data['request_data']['PORT_ID'] . "</port_code>
				<terminal_code>" . $data['request_data']['TERMINAL_ID'] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getRequestDeliveryExt", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->request) {
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

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Extension Delivery", '/container/main_delivery_ext');
		$this->breadcrumbs->push("Add Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Extension Delivery Booking";

		$this->common_loader($data, 'pages/container/edit_delivery_ext');
	}

	public function auto_vessel_delivery()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}

		$term = $this->security->xss_clean(htmlentities(strtoupper($_GET["term"])));

		injek($term);

		$port = explode("-", $this->security->xss_clean(htmlentities($_GET["port"])));
		$stack = array();

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
				<port_code>" . $port[0] . "</port_code>
				<terminal_code>" . $port[1] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getVesselVoyage", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->vessel) {
				for ($i = 0; $i < count($obj->data->vessel); $i++) {
					$temp;
					$temp['VESSEL'] = $obj->data->vessel[$i]->vessel_name;
					$temp['VOYAGE_IN'] = $obj->data->vessel[$i]->voyage_in;
					$temp['VOYAGE_OUT'] = $obj->data->vessel[$i]->voyage_out;
					$temp['VOYAGE'] = $obj->data->vessel[$i]->voyage;
					$temp['ETA'] = $obj->data->vessel[$i]->eta;
					$temp['ETB'] = $obj->data->vessel[$i]->etb;
					$temp['ETD'] = $obj->data->vessel[$i]->etd;
					$temp['ATA'] = $obj->data->vessel[$i]->ata;
					$temp['ATB'] = $obj->data->vessel[$i]->atb;
					$temp['ATD'] = $obj->data->vessel[$i]->atd;
					$temp['ID_VSB_VOYAGE'] = $obj->data->vessel[$i]->id_vsb_voyage;
					$temp['VESSEL_CODE'] = $obj->data->vessel[$i]->vessel_code;
					$temp['CALL_SIGN'] = $obj->data->vessel[$i]->call_sign;
					$temp['DATE_DISCHARGE'] = $obj->data->vessel[$i]->date_discharge;
					$temp['NO_BOOKING'] = $obj->data->vessel[$i]->no_booking;
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

		$i = 0;
		foreach ($stack as $t) {
			$this->table->add_row(
				$t['VESSEL'] . " (" . $t['NO_BOOKING'] . ")",
				$t['VOYAGE_IN'],
				$t['VOYAGE_OUT'],
				$t['ETA'],
				$t['ETD'],
				'<a data-dismiss="modal" style="cursor:pointer" class="table-link click_detail bank_detail" onclick="complete(\'' . $t['VESSEL'] . '\',\'' . $t['VOYAGE_IN'] . '\',\'' . $t['VOYAGE_OUT'] . '\',\'' . $t['VOYAGE'] . '\',\'' . $t['ID_VSB_VOYAGE'] . '\',\'' . $t['VESSEL_CODE'] . '\',\'' . $t['CALL_SIGN'] . '\',
					 \'' . $t['DATE_DISCHARGE'] . '\',\'' . $t['ETD'] . '\',\'' . $t['ETA'] . '\',\'' . $t['NO_BOOKING'] . '\')"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
			);
			$i++;
		}

		$this->load->view('pages/container/search_vessel_modal', $data);
	}

	public function auto_truck_number()
	{

		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}

		$term = $_GET["term"];

		$port = explode("-", $_GET["port"]);


		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<tid>$term</tid>
				<port_code>" . $port[0] . "</port_code>
				<terminal_code>" . $port[1] . "</terminal_code>
			</data>
		</root>";
		injek($in_data);

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getTruckID", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			if ($obj->data->container) {
				for ($i = 0; $i < count($obj->data->container); $i++) {
					$temp;
					$temp['TID'] = $obj->data->container[$i]->tid;
					$temp['TRUCK_NUMBER'] = $obj->data->container[$i]->truck_number;
					$temp['RFID_CODE'] = $obj->data->container[$i]->rfid_code;
					$temp['COMPANY_NAME'] = $obj->data->container[$i]->company_name;
					$temp['ID_TRUCK'] = $obj->data->container[$i]->id_truck;
					array_push($stack, $temp);
				}
			}
		}
		echo json_encode($stack);
	}

	public function create_register_id()
	{

		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		log_message('debug', '------------------------create_request_delivery-----------------------------');
		$port = explode("-", $_POST["TERMINAL"]);
		$truck_number = $_POST["TRUCK_NUMBER"];
		$truck_id = $_POST["TRUCK_ID"];
		$rfid_code = $_POST["RFID_CODE"];
		$customer_id = $_POST["CUSTOMER_ID"];
		$customer_name = $_POST["CUSTOMER_NAME"];
		$address = $_POST["CUSTOMER_ADDRESS"];
		$kend_type = $_POST["KEND_TYPE"];
		$tgl = $_POST["TANGGAL"];

		if ($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$address = base64_encode($address);
			$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>" . $port[0] . "</port_code>
						<terminal_code>" . $port[1] . "</terminal_code>
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
			log_message('debug', '>>> --1--' . $in_data);
			injek($in_data);

			if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "createRegisterTID", array("in_data" => "$in_data"), $result)) {
				log_message('debug', $result);
				echo $result;
				die;
			} else {
				log_message('debug', '--4--' . $result);
				echo $result;
				return;

				$obj = json_decode($result);

				if ($obj->rc != "S") {
					echo "NO," . $obj->rcmsg;
				} else if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}

		}
	}

	public function update_register_id()
	{

		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		log_message('debug', '------------------------create_request_delivery-----------------------------');
		$port = explode("-", $_POST["TERMINAL"]);
		$truck_number = $_POST["TRUCK_NUMBER"];
		$truck_id = $_POST["TRUCK_ID"];
		$rfid_code = $_POST["RFID_CODE"];
		$customer_id = $_POST["CUSTOMER_ID"];
		$customer_name = $_POST["CUSTOMER_NAME"];
		$address = $_POST["CUSTOMER_ADDRESS"];
		$kend_type = $_POST["KEND_TYPE"];
		$tgl = $_POST["TANGGAL"];

		if ($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$address = base64_encode($address);
			$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>" . $port[0] . "</port_code>
						<terminal_code>" . $port[1] . "</terminal_code>
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
			log_message('debug', '>>> --1--' . $in_data);
			injek($in_data);

			if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "updateRegisterTID", array("in_data" => "$in_data"), $result)) {
				log_message('debug', $result);
				echo $result;
				die;
			} else {
				log_message('debug', '--4--' . $result);
				echo $result;
				return;

				$obj = json_decode($result);

				if ($obj->rc != "S") {
					echo "NO," . $obj->rcmsg;
				} else if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}

		}
	}


	public function cancel_tid($tid)
	{

		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		log_message('debug', '------------------------create_request_delivery-----------------------------');
		
		
		//$port=explode("-",$_POST["TERMINAL"]);
		//$truck_number=$_POST["TRUCK_NUMBER"];
		//$truck_id=$_POST["TRUCK_ID"];
		//$rfid_code=$_POST["RFID_CODE"];
		$customer_id = $this->session->userdata('customerid_phd');
		$customer_name = $this->session->userdata('customername_phd');
		$address = $this->session->userdata('address_phd');


		$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$address = base64_encode($address);
		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<truck_id>$tid</truck_id>
					</data>
				</root>";
				//print_r($in_data);die;
		log_message('debug', '>>> --1--' . $in_data);
		injek($in_data);

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "delRegisterTID", array("in_data" => "$in_data"), $result)) {
			log_message('debug', $result);
			echo $result;
			die;
		} else {
			log_message('debug', '--4--' . $result);

			$obj = json_decode($result);

			if ($obj->rc != "S") {
				echo "NO," . $obj->rcmsg;
			} else if ($obj->data->info) {

				echo "<script type='text/javascript'>
        alert('Penghapusan TID Berhasil');
        location = '" . ROOT . "om/truck/create_truck_registration';
      </script>";
					//header("Location: ".ROOT."om/truck/create_truck_registration");
					
					//die();
						//die();

			} else {
				echo "NO,GAGAL";
			}

		}

	}

	public function add_detail_truck()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		$port = explode("-", $_POST["TERMINAL"]);
		$no_req = $_POST["NO_REQUEST"];
		$tid = $_POST["TID"];
		$truck_number = $_POST["TRUCK_NUMBER"];
		$bl_number = $_POST["BL_NUMBER"];
		$truck_company = $_POST["TRUCK_COMPANY"];
		$rfid_code = $_POST["RFID_CODE"];
		$ei = $_POST["EI"];
		$id_vvd = $_POST["ID_VVD"];
		$id_servicetype = $_POST["ID_SERVICETYPE"];
		$service_type = $_POST["SERVICE_TYPE"];
		$id_truck = $_POST["ID_TRUCK"];

		$stack = array();
		try {


			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$in_data = "	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>" . $port[0] . "</port_code>
					<terminal_code>" . $port[1] . "</terminal_code>
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
			if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "addDetailTCA", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
				//echo $result;die();

				$obj = json_decode($result);

				if ($obj->rc == "F") {
					echo "NO," . $obj->rcmsg;
				} else if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,Exception";
		}
	}

	public function del_cont_req_delivery_perp()
	{
		$port = explode("-", $_POST["TERMINAL"]);
		$no_container = $_POST["NO_CONTAINER"];
		$no_request = $_POST["NO_REQUEST"];
		$user_id = $this->session->userdata('userid_simop');
		$stack = array();

		//echo $no_request;
		try {
			$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);
			//echo $reqNoBiller;die;
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
			$in_data = "	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>" . $port[0] . "</port_code>
					<terminal_code>" . $port[1] . "</terminal_code>
					<id_req>$reqNoBiller</id_req>
					<no_container>$no_container</no_container>
					<user_id>$user_id</user_id>
				</data>
			</root>";

			if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "delDetailContainerPerp", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
				//echo $result;die();

				$obj = json_decode($result);
				if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
	}
	
	//----------------------------------------------
	public function update_plugout_cont()
	{
		$port = explode("-", $_POST["TERMINAL"]);
		$no_container = $_POST["NO_CONTAINER"];
		$no_request = $_POST["NO_REQUEST"];
		$plugin = $_POST["PLUG_IN"];
		$plugoutext = $_POST["PLUG_OUT_EXT"];
		$user_id = $this->session->userdata('userid_simop');
		$stack = array();

		//echo $no_request;
		try {
			$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);
			//echo $reqNoBiller;die;
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$in_data = "	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>" . $port[0] . "</port_code>
					<terminal_code>" . $port[1] . "</terminal_code>
					<id_req>$reqNoBiller</id_req>
					<no_container>$no_container</no_container>
					<user_id>$user_id</user_id>
					<plugin>$plugin</plugin>
					<plugoutext>$plugoutext</plugoutext>
				</data>
			</root>";

			if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "updatePlugoutCont", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
				//echo $result;die();

				$obj = json_decode($result);
				if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
	}
	//----------------------------------------------

	public function del_tca()
	{
		$port = explode("-", $_POST["TERMINAL"]);
		$tid = $_POST["TID"];
		$no_request = $_POST["NO_REQUEST"];
		$id_vvd = $_POST["ID_VVD"];
		$bl_number = $_POST["BL_NUMBER"];
		$id_truck = $_POST["ID_TRUCK"];

		$stack = array();

		//echo $no_request;
		try {
			$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);
			//echo $reqNoBiller;die;
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$in_data = "	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>" . $port[0] . "</port_code>
					<terminal_code>" . $port[1] . "</terminal_code>
					<tid>$tid</tid>
					<no_request>$no_request</no_request>
					<bl_number>$bl_number</bl_number>
				</data>
			</root>";
			
			//echo $in_data;
			//die();
			if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "delDetailTCA", array("in_data" => "$in_data"), $result)) {
				echo $result;
				die;
			} else {
				//echo $result;die();

				$obj = json_decode($result);
				if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
	}

	public function get_detail_truck($type, $no_req)
	{
		if ($type == "add" || $type == "edit") {
			//create table
			$this->table->set_heading('No', 'Hapus', 'TCA TRUCK ID', 'TCA TRUCK NUMBER', 'TCA TRUCK COMPANY', 'PROXIMITY');
		} else {
			//create table
			$this->table->set_heading('No', 'Hapus', 'TCA TRUCK ID', 'TCA TRUCK NUMBER', 'TCA TRUCK COMPANY', 'PROXIMITY');
		}

		$stack = array();
		$port = explode("-", $terminal);
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_req</no_request>
				<port_code>" . $port[0] . "</port_code>
				<terminal_code>" . $port[1] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getDetailTCA", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result); //var_dump($obj);die();
			if ($obj->data->container) {
				for ($i = 0; $i < count($obj->data->container); $i++) {
					if ($type == "add" || $type == "edit") {
						$this->table->add_row(
							$i + 1,
							'<a class="btn btn-primary" onclick="delete_container(\'' . $obj->data->container[$i]->tca_truck_id . '\')"><i class="fa fa-trash-o"></i></a>',
							$obj->data->container[$i]->tca_truck_id,
							$obj->data->container[$i]->tca_truck_number,
							$obj->data->container[$i]->tca_truck_company,
							$obj->data->container[$i]->proximity
						);
					} else {
						$this->table->add_row(
							$i + 1,
							$obj->data->container[$i]->tca_truck_id,
							$obj->data->container[$i]->tca_truck_number,
							$obj->data->container[$i]->tca_truck_company,
							$obj->data->container[$i]->proximity
						);
					}
				}
			}
		}

		$data['type'] = $type;
		$this->load->view('pages/om/get_detail_truck', $data);
	}

	public function list_container_delivery_perp()
	{
		$this->redirect();

		$id_req = $_POST["ID_REQ"];
		$port = explode("-", $_POST['PORT']);
		$port_code = $port[0];
		$terminal_code = $port[1];
		//$port_code = substr($_POST['PORT'], 0, 5);
		//$terminal_code = substr($_POST['PORT'], 6, 3);
		$stack = array();

		$id_user = $this->session->userdata('uname_phd');

		$reply = array();
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>$id_req</id_req>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
			</data>
		</root>";
        //echo $in_data ; die;

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getOldListContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->list_cont) {
				for ($i = 0; $i < count($obj->data->list_cont); $i++) {
					$temp;
					$temp['NO_CONTAINER'] = $obj->data->list_cont[$i]->no_container;
					$temp['SIZE_CONT'] = $obj->data->list_cont[$i]->size_cont;
					$temp['TYPE_CONT'] = $obj->data->list_cont[$i]->type_cont;
					$temp['STATUS_CONT'] = $obj->data->list_cont[$i]->status_cont;
					$temp['HEIGHT_CONT'] = $obj->data->list_cont[$i]->height;
					$temp['HZ'] = $obj->data->list_cont[$i]->hz;
					//$temp['WEIGHT']=$obj->data->list_cont[$i]->weight;
					$temp['CARRIER'] = $obj->data->list_cont[$i]->carrier;
					$temp['PLUG_OUT'] = $obj->data->list_cont[$i]->plug_out;
					$temp['PLUG_IN'] = $obj->data->list_cont[$i]->plug_in;
					$temp['PLUG_OUT_EXT'] = $obj->data->list_cont[$i]->plug_out_ext;


					array_push($stack, $temp);
				}
			}
		}

		echo json_encode($stack);
	}

	public function list_container_delivery_perp_new_req()
	{
		$this->redirect();

		$id_req = $_POST["ID_REQ"];
		$port = explode("-", $_POST['PORT']);
		$port_code = $port[0];
		$terminal_code = $port[1];
		//$port_code = substr($_POST['PORT'], 0, 5);
		//$terminal_code = substr($_POST['PORT'], 6, 3);
		$stack = array();

		$id_user = $this->session->userdata('uname_phd');

		$reply = array();
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>$id_req</id_req>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
			</data>
		</root>";
        //echo $in_data ; die;

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getOldListContainerPerp", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->list_cont) {
				for ($i = 0; $i < count($obj->data->list_cont); $i++) {
					$temp;
					$temp['NO_CONTAINER'] = $obj->data->list_cont[$i]->no_container;
					$temp['SIZE_CONT'] = $obj->data->list_cont[$i]->size_cont;
					$temp['TYPE_CONT'] = $obj->data->list_cont[$i]->type_cont;
					$temp['STATUS_CONT'] = $obj->data->list_cont[$i]->status_cont;
					$temp['HEIGHT_CONT'] = $obj->data->list_cont[$i]->height;
					$temp['HZ'] = $obj->data->list_cont[$i]->hz;
					//$temp['WEIGHT']=$obj->data->list_cont[$i]->weight;
					$temp['CARRIER'] = $obj->data->list_cont[$i]->carrier;
					$temp['PLUG_OUT'] = $obj->data->list_cont[$i]->plug_out;
					$temp['PLUG_OUT_EXT'] = $obj->data->list_cont[$i]->plug_out_ext;

					array_push($stack, $temp);
				}
			}
		}

		echo json_encode($stack);
	}


	public function auto_request_bl()
	{
		log_message('debug', 'nilai term' . $term);
		$term = strtoupper($_GET["term"]);
		log_message('debug', 'nilai term' . $port);
		$port = explode("-", $_GET["port"]);
		$stack = array();
		$customer_id = $this->session->userdata('customerid_phd');
		//$customer_id=$this->session->userdata('custid_phd');

		$in_data = "	<root>
                            <sc_type>1</sc_type>
                            <sc_code>123456</sc_code>
                            <data>
                                    <noreq>$term</noreq>
                                    <port_code>" . $port[0] . "</port_code>
                                    <terminal_code>" . $port[1] . "</terminal_code>
                                    <customer_id>$customer_id</customer_id>
                            </data>
                        </root>";

		log_message('error', 'nilai in data: ' . json_encode($in_data));

		if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "getRequestBL", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			//echo $result;
			if ($obj->data->old_req) {
				for ($i = 0; $i < count($obj->data->old_req); $i++) {
					$temp;
					$temp['ID_CUST'] = $obj->data->old_req[$i]->id_cust;
					$temp['ID_REQ'] = $obj->data->old_req[$i]->id_req;
					$temp['CUST_NAME'] = $obj->data->old_req[$i]->cust_name;
					$temp['VESSEL'] = $obj->data->old_req[$i]->vessel;
					$temp['VOYAGE'] = $obj->data->old_req[$i]->voyage;
					$temp['VOYAGE_IN'] = $obj->data->old_req[$i]->voy_in;
					$temp['VOYAGE_OUT'] = $obj->data->old_req[$i]->voy_out;
					$temp['PKG_NAME'] = $obj->data->old_req[$i]->pkg_name;
					$temp['QTY'] = $obj->data->old_req[$i]->qty;
					$temp['TON'] = $obj->data->old_req[$i]->ton;
					$temp['BL_NUMBER'] = $obj->data->old_req[$i]->bl_number;
					$temp['BL_DATE'] = $obj->data->old_req[$i]->bl_date;
					$temp['E_I'] = $obj->data->old_req[$i]->e_i;
					$temp['ID_VVD'] = $obj->data->old_req[$i]->id_vvd;
					$temp['HS_CODE'] = $obj->data->old_req[$i]->hs_code;
					$temp['ID_SERVICETYPE'] = $obj->data->old_req[$i]->id_servicetype;
					$temp['SERVICETYPE_NAME'] = $obj->data->old_req[$i]->servicetype_name;
					array_push($stack, $temp);
				}
			}
		}
		log_message('error', 'nilai stacj: ' . json_encode($stack));
		echo json_encode($stack);

	}



	public function create_request_tca()
	{

		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
		log_message('debug', '------------------------create_request_delivery-----------------------------');
		$port = explode("-", $_POST["TERMINAL"]);
		$no_request = $_POST["NO_REQUEST"];
		$vessel = $_POST["VESSEL"];
		$voyage_in = $_POST["VOYAGE_IN"];
		$voyage_out = $_POST["VOYAGE_OUT"];
		$customer_id = $_POST["CUSTOMER_ID"];
		$customer_name = $_POST["CUSTOMER_NAME"];
		$pkg_name = $_POST["PKG_NAME"];
		$qty = $_POST["QTY"];
		$ton = $_POST["TON"];
		$bl_number = $_POST["BL_NUMBER"];
		$bl_date = $_POST["BL_DATE"];
		$id_vvd = $_POST["ID_VVD"];
		$ei = $_POST["EI"];
		$hs_code = $_POST["HS_CODE"];
		$id_servicetype = $_POST["ID_SERVICETYPE"];
		$service_type = $_POST["SERVICE_TYPE"];
		
		//declare form validation pemesanan pengeluaran default
	

		//declare form validation pemesanan pengeluaran internasional



		if ($this->input->post()) {
				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$address = base64_encode($address);
			$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>" . $port[0] . "</port_code>
						<terminal_code>" . $port[1] . "</terminal_code>
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
			log_message('debug', '>>> --1--' . $in_data);
			injek($in_data);

			if (!$this->nusoap_lib->call_wsdl(ORDER_MGT, "createRequestTCA", array("in_data" => "$in_data"), $result)) {
				log_message('debug', $result);
				echo $result;
				die;
			} else {
				log_message('debug', '--4--' . $result);
				echo $result;
				die;

				$obj = json_decode($result);
				if ($obj->rc != "S") {
					echo "NO," . $obj->rcmsg;
				} else if ($obj->data->info) {
					echo ($obj->data->info);
				} else {
					echo "NO,GAGAL";
				}
			}
		}
	}

	public function save_request_delivery()
	{
		$no_request = $_POST["request_no"];
		$port = explode("-", $_POST["port"]);

		$stack = array();

		$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);

		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<biller_request_id>$reqNoBiller</biller_request_id>
						<port_code>" . $port[0] . "</port_code>
						<terminal_code>" . $port[1] . "</terminal_code>
					</data>
				</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getCountContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);
			if ($obj->rc != "S") {
				echo $result;
				die;
			}
		}

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$reqNoBiller</no_request>
				<port_code>" . $port[0] . "</port_code>
				<terminal_code>" . $port[1] . "</terminal_code>
				<user_id>" . $this->session->userdata('uname_phd') . "</user_id>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "saveRequestDelivery", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			echo $result;
			exit;
		}
	}

	public function save_request_deliveryperp()
	{
		$no_request = $_POST["request_no"];
		$port = explode("-", $_POST["port"]);

		$stack = array();

		$reqNoBiller = $this->container_model->getNumberRequestBiller($no_request);

		$in_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<biller_request_id>$reqNoBiller</biller_request_id>
						<port_code>" . $port[0] . "</port_code>
						<terminal_code>" . $port[1] . "</terminal_code>
					</data>
				</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getCountContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);
			if ($obj->rc != "S") {
				echo $result;
				die;
			}
		}

		//no error
		// port code : IDJKT, IDPNK
		// terminal code :  T3I,T3D,T2D,T1D
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$reqNoBiller</no_request>
				<port_code>" . $port[0] . "</port_code>
				<terminal_code>" . $port[1] . "</terminal_code>
				<user_id>" . $this->session->userdata('uname_phd') . "</user_id>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "submitRequestDeliveryPerp", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			echo $result;
			exit;
		}
	}

	public function create_delivery_perp()
	{
		$old_request = $_POST["OLD_REQUEST"];
		$delivery_type = $_POST["DELIVERY_TYPE"];
		$tgl_perp = $_POST["TGL_DELIVERYPERP"];
		$no_bl = $_POST["NO_BL"];
		$no_do = $_POST["NO_DO"];
		$tgl_do = $_POST["TGL_DO"];
		$no_sppb = $_POST["NO_SPPB"];
		$no_sp_custom = $_POST["NO_SP_CUSTOM"];
		$sp2p_number = $_POST["SP2P_NUMBER"];
		$sppb_date = $_POST["SPPB_DATE"];
		$no_request = $_POST["NO_REQUEST"];
		$sp_custom_date = $_POST["SP_CUSTOM_DATE"];
		$port = explode("-", $_POST["TERMINAL"]);
		$port_code = $port[0];
		$terminal_code = $port[1];
        //$port_code = substr($_POST['TERMINAL'], 0, 5);
        //$terminal_code = substr($_POST['TERMINAL'], 6, 3);
		$checked_container = json_encode($_POST['CONT_CHECKED']);

		$id_user = $this->session->userdata('userid_simop');
		$id_user_eservice = $this->session->userdata('uname_phd');

		$OldreqNoBiller = $this->container_model->getNumberRequestBiller($old_request);
		$no_request = $this->container_model->getNumberRequestBiller($no_request);
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
		if ($no_sp_custom == '') {
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

		if ($no_sppb == '') {
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

		if ($this->input->post()) {
			if ($port[1] == 'T3I') {
				foreach ($internasional as $config_internasional) {
					array_push($config, $config_internasional);
				}
			}

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan perp pengeluaran

			if ($this->form_validation->run() == false) {
				echo 'salah';
			} else {
				$in_data = "	<root>
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

				if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "createRequestDeliveryPerp", array("in_data" => "$in_data"), $result)) {
					//echo $result;
					log_message('debug', $result);
					die;
				} else {
					//echo $result;die;
					log_message('debug', $result);
					$obj = json_decode($result);
					//echo $result;
					//var_dump($result); die;
					if ($obj->data->info) {
						echo "<response>," . $obj->data->info . ",</response>";
						echo "<port_code>" . $port_code . "</port_code>";
						echo "<terminal_code>" . $terminal_code . "</terminal_code>";
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

	public function save_detail_delivery_perp()
	{
		$alldetail = $_POST["alldetail"];

		$container = "";
		$jum = count($alldetail);

		for ($i = 0; $i < count($alldetail); $i++) {
			$container .= "'" . $alldetail[$i] . "'";
			if ($jum != 1 && $i != $jum - 1) {
				$container .= ",";
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
		$port = explode("-", $_POST["TERMINAL"]);

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
                <port_code>" . $port[0] . "</port_code>
                <terminal_code>" . $port[1] . "</terminal_code>
            </data>
        </root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "saveDetailReqPerp", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			if ($obj->data->info) {
				echo ($obj->data->info);

			} else {
				echo "NO,GAGAL";
			}
		}

	}

	function download_proforma_delivery_atch($no_request, $port_code, $terminal_code, $hash)
	{

		//generate hash
		$customer_id = $this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request . $customer_id);

		if ($hash != $hash_check) {
			if ($group_id != "m")
				return;
		}

		$stack = array();

		$billerId = $this->container_model->getNumberRequestBiller($no_request);
		if ($billerId == "NO_DATA_FOUND") die('No Data Transaction found');
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$billerId</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>" . $port_code . "</port_code>
				<terminal_code>" . $terminal_code . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getPDFProformaContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->html_tcpdf) {
				//update activity log
				if ($group_id != "m")
					$billerId = $this->container_model->updateTransactionLogActivity($no_request, "PRINT_PROFORMA", $id_user_eservice = $this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();
				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(true, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

// ---------------------------------------------------------

				$tbl = base64_decode($obj->data->html_tcpdf);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0, 0, 0),
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
				$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo $result;
				echo "NO,GAGAL";
			}
		}
	}

	function download_proforma_delivery($no_request, $port_code, $terminal_code, $hash = "")
	{

		$this->redirect();

		if ($hash != md5($no_request)) {
			return;
		}

		$hash = md5($no_request . $this->session->userdata('customerid_phd'));

		$this->download_proforma_delivery_atch($no_request, $port_code, $terminal_code, $hash);

	}

	function dw_prodelv_thermal($no_request, $port_code, $terminal_code, $hash = "")
	{

		$this->redirect();

		if ($hash != md5($no_request)) {
			return;
		}

		$hash = md5($no_request . $this->session->userdata('customerid_phd'));

		$this->dw_prodelv_thermal_atch($no_request, $port_code, $terminal_code, $hash);

	}

	function dw_prodelv_thermal_atch($no_request, $port_code, $terminal_code, $hash)
	{

		//generate hash
		$customer_id = $this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request . $customer_id);

		if ($hash != $hash_check) {
			if ($group_id != "m")
				return;
		}

		$stack = array();

		$billerId = $this->container_model->getNumberRequestBiller($no_request);
		if ($billerId == "NO_DATA_FOUND") die('No Data Transaction found');
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$billerId</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>" . $port_code . "</port_code>
				<terminal_code>" . $terminal_code . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getPDFPro_thermal", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->html_tcpdf) {
				//update activity log
				if ($group_id != "m")
					$billerId = $this->container_model->updateTransactionLogActivity($no_request, "PRINT_PROFORMA", $id_user_eservice = $this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();
				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3, 17, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(true, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

// ---------------------------------------------------------

				$tbl = base64_decode($obj->data->html_tcpdf);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0, 0, 0),
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
				$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 5, 20, 14, 8, '', '', '', true, 72);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo $result;
				echo "NO,GAGAL";
			}
		}
	}

	function download_invoice_delivery_atch($no_request, $port_code, $terminal_code, $hash)
	{

		//generate hash
		$customer_id = $this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request . $customer_id);

		if ($hash != $hash_check) {
			//return;
		}

		$stack = array();

		$nobiller = $this->container_model->getNumberRequestBiller($no_request);

		{//create inovoice qr code
			//data hasil qr code
			$hash = md5(ROOT . "invoice/val_invoice/1/del/$no_request/$port_code/$terminal_code/");

			//val_invoice/{validation_version}/{service_type}/{no_request}/{port_code}/{terminal_code}/{challenge_code}
			//pada versi 1, digunakan challenge_code untuk menguji bahwa url yang terbentuk benar hanya dari sistem ipc
			$params['data'] = ROOT . "invoice/val_invoice/1/del/$no_request/$port_code/$terminal_code/$hash";
			$params['level'] = 'H';
			$params['size'] = 10;
			$randomfilename = rand(1000, 9999);
			$params['savename'] = UPLOADFOLDER_ . "qr_code/$randomfilename.png";
			$this->ciqrcode->generate($params);
		}

		$barcode_location = APP_ROOT . "qr_code/$randomfilename.png";
		$ttd_location = APP_ROOT . "config/images/cr/ttd2.png";
		$user = $this->session->userdata('uname_phd');

		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$nobiller</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>" . $port_code . "</port_code>
				<terminal_code>" . $terminal_code . "</terminal_code>
				<barcode_location>" . $barcode_location . "</barcode_location>
				<ttd_location>" . $ttd_location . "</ttd_location>
				<user>" . $user . "</user>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getPDFNotaContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			if ($obj->data->html_tcpdf) {
				$footerhtml = base64_decode($obj->data->footer);
				$lampiran_nota = base64_decode($obj->data->lampiran);
				
				//update activity log
				if ($group_id != "m")
					$billerId = $this->container_model->updateTransactionLogActivity($no_request, "PRINT_INVOICE", $id_user_eservice = $this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();

				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
				// create new PDF document
				// set header and footer fonts
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(5, 5, 15);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(true, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

				$tbl = base64_decode($obj->data->html_tcpdf);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0, 0, 0),
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
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();

				$pdf->setPage(1);
				$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				//$pdf->Image(APP_ROOT.'config/images/cr/ttd2.jpg', 175, 260, 30, 15, '', '', '', true, 72);

				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_jasa_kepelabuhanan - ' . $obj->data->faktur_id . '.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_invoice_delivery($no_request, $port_code, $terminal_code, $hash = "")
	{

		$this->redirect();

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if ($dataBilling["STATUS_REQ"] != "P") {
			redirect(ROOT . 'main', 'refresh');
		}

		if ($hash != md5($no_request)) {
			return;
		}

		$hash = md5($no_request . $this->session->userdata('customerid_phd'));
		$this->download_invoice_delivery_atch($no_request, $port_code, $terminal_code, $hash);

	}

	function download_card_delivery($no_request, $port_code, $terminal_code)
	{
		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');

		$stack = array();

		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<port_code>" . $port_code . "</port_code>
				<terminal_code>" . $terminal_code . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getCardContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			if ($obj->data->html_tcpdf) {

				$tbl = base64_decode($obj->data->html_tcpdf);

				echo ($tbl);
				die();

			}
		}

	}

	function download_card_delivery_thermal($no_request, $port_code, $terminal_code)
	{
		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');

		$stack = array();

		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<port_code>" . $port_code . "</port_code>
				<terminal_code>" . $terminal_code . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getCardContainerThermal", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);
			if ($obj->data->html_tcpdf) {
				$this->load->helper('pdf_helper');

				tcpdf();

				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				// $pdf = new MYPDF('P', 'mm', 'A7', true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', array(80, 130), true, 'UTF-8', false);

				// set header and footer fonts
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(1, 1, 1);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(true, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------
				for ($i = 0; $i < count($obj->data->html_tcpdf); $i++) {
					$tbl = base64_decode($obj->data->html_tcpdf[$i]->TCPDF);
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
						'fgcolor' => array(0, 0, 0),
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
					'fgcolor' => array(0, 0, 0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 4,
					'stretchtext' => 4
				);

				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}

	}

	function payment_confirmation($no_request, $id_port, $id_terminal, $id_proforma, $vessel, $voyage_in, $voyage_out)
	{
		$this->redirect();

		$data['no_request'] = $no_request;
		$data['id_proforma'] = $id_proforma;

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Payment', 'container/payment');
		$this->breadcrumbs->push('Payment Confirmation', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = 'Payment Confirmation';

		$this->common_loader($data, 'pages/container/payment_confirmation');
	}

	function save_payment_confirmation()
	{
		$no_request = $_POST["no_request"];
		$no_proforma = $_POST["no_proforma"];
		$method = $_POST["method"];
		$via = $_POST["via"];
		$amount = $_POST["amount"];

		$params = array(
			'REQUEST_NUMBER' => $no_request,
			'PROFORMA_NUMBER' => $no_proforma,
			'USER_ID' => $this->session->userdata('uname_phd'),
			'PAYMENT_METHOD' => $method,
			'PAYMENT_VIA' => $via,
			'PAYMENT_AMOUNT' => $amount,
			'PAYMENT_CONFIRMATION_STATUS' => 'N'
		);

		if ($this->container_model->create_payment_confirmation($params)) {
			echo 'OK';
		} else {
			echo 'KO';
		}
	}

	function download_proforma_ext_delivery($no_request, $port_code, $terminal_code)
	{

		$this->redirect();

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');

		$nobiller = $this->container_model->getNumberRequestBiller($no_request);
		$in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getPDFProformaContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			if ($obj->data->proforma_html) {

				$this->load->helper('pdf_helper');

				tcpdf();
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(true, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

				$tbl = base64_decode($obj->data->proforma_html);

				$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					//'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0, 0, 0),
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
				$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');

				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('proforma_ext.pdf', 'I');

			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_nota_ext_delivery($no_request, $port_code, $terminal_code)
	{

		$this->redirect();

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');

		$nobiller = $this->container_model->getNumberRequestBiller($no_request);
		$in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getPDFNotaContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			if ($obj->data->nota_html) {

				$this->load->helper('pdf_helper');

				tcpdf();
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


				// set header and footer fonts
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(1, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(true, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

				$tbl = base64_decode($obj->data->nota_html);
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
					'fgcolor' => array(0, 0, 0),
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
				$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_ext.pdf', 'I');

			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_card_ext_delivery($no_request, $port_code, $terminal_code)
	{

		$this->redirect();

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');


		$nobiller = $this->container_model->getNumberRequestBiller($no_request);
		$in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_PERPANJANGAN_DELIVERY, "getHTMLCardContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			$obj = json_decode($result);
			if ($obj->data->card_html) {

				$tbl = base64_decode($obj->data->card_html);

				echo $tbl;
				die();

			} else {
				echo "NO,GAGAL";
			}
		}
	}

	public function print_card_delivery_atch($no_request, $port_code, $terminal_code, $hash)
	{

		$this->redirect();

		//generate hash
		$customer_id = $this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request . $customer_id);

		if ($hash != $hash_check) {
			return;
		}

		//AP
		$uname_phd = $this->session->userdata('uname_phd');

		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');

		$card_password = $billerId = $this->user_model->get_pdf_password($this->session->userdata('uname_phd'));

		$billerId = $this->container_model->getNumberRequestBiller($no_request);

		$in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$billerId</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getPDFCardContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);
			//$tbl=base64_decode($obj->data->proforma_html);
			//print_r($tbl); die();
			$total = $obj->data->jumlah;

			//update activity log
			$this->container_model->updateTransactionLogActivity($no_request, "PRINT_CARD", $id_user_eservice = $this->session->userdata('uname_phd'));
			$cetakan_ke = $this->container_model->getCountCardPrint($no_request);

			//validasi limit cetakan kartu
			$vld = $this->container_model->getValidCardPrint($cetakan_ke, 'DEL');
			//echo $vld;die;

			if ($vld == "Y") {
			//print_r(count($obj->data->detail_card));
				if ($obj->data->detail_card) {

					$this->load->helper('pdf_helper');
					tcpdf();
			// create new PDF document
			//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


			// set header and footer fonts
					$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
					$pdf->SetProtection(
						$permissions = array('print', 'print'),
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
					$pdf->SetAutoPageBreak(true, 10);

			//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			//set some language-dependent strings
					$pdf->setLanguageArray(null);

// ---------------------------------------------------------

					if ($port_code == 'IDJKT') {
						$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
					} else if ($port_code == 'IDPNK') {
						$corporate_name = "PT. IPC TERMINAL PETIKEMAS";
					}

					if ($terminal_code == 'T3I') {
						$terminal_name = 'TERMINAL 3 OCEAN GOING';
					} else if ($terminal_code == 'T3D') {
						$terminal_name = 'TERMINAL 3 DOMESTIK';
					} else if ($terminal_code == 'T2D') {
						$terminal_name = 'TERMINAL 2 DOMESTIK';
					} else if ($terminal_code == 'T1D') {
						$terminal_name = 'TERMINAL 1 DOMESTIK';
					} else if ($terminal_code == 'T009D') {
						$terminal_name = 'TERMINAL 1 009 (DOMESTIK)';
					} else if ($terminal_code == 'L2D') {
						$terminal_name = 'TERMINAL LINI 2 DOMESTIK';
					} else if ($terminal_code == 'L2I') {
						$terminal_name = 'TERMINAL LINI 2 INTERNATIONAL';
					}

			//print_r($rowz); die();
					$nourut = 1;
					for ($i = 0; $i < count($obj->data->detail_card); $i++) {
						$nocont = strtoupper($obj->data->detail_card[$i]->no_container);
			   // echo $nocont; die();
						$prefx = strtoupper($obj->data->detail_card[$i]->prefix);
						$clossing_time = $obj->data->detail_card[$i]->clossing_time;
						$paid_thru2 = $obj->data->detail_card[$i]->paidthru;
						$etd = $obj->data->detail_card[$i]->etd;
						$vessel = $obj->data->detail_card[$i]->vessel;
						$voyage = $obj->data->detail_card[$i]->voyage;
						$voyage_out = $obj->data->detail_card[$i]->voyage_out;
						$status_cont = $obj->data->detail_card[$i]->status_cont;
						$size_cont = $obj->data->detail_card[$i]->size_cont;
						$type_cont = $obj->data->detail_card[$i]->type_cont;
						$no_container = $obj->data->detail_card[$i]->no_container;
						$berat = $obj->data->detail_card[$i]->berat;
						$pelabuhan_tujuan = $obj->data->detail_card[$i]->pelabuhan_tujuan;
						$fpod = $obj->data->detail_card[$i]->fpod;
						$ipod = $obj->data->detail_card[$i]->ipod;
						$fipod = $obj->data->detail_card[$i]->fipod;
						$peb = $obj->data->detail_card[$i]->peb;
						$npe = $obj->data->detail_card[$i]->npe;
						$kode_pbm = $obj->data->detail_card[$i]->kode_pbm;
						$imo_class = $obj->data->detail_card[$i]->imo_class;
						$temp = $obj->data->detail_card[$i]->temp;
						$iso_code = $obj->data->detail_card[$i]->iso_code;
						$ipol = $obj->data->detail_card[$i]->ipol;
						$tgl_request = $obj->data->detail_card[$i]->tgl_request;
						$prefix = $obj->data->detail_card[$i]->prefix;
						$cont_numb = $obj->data->detail_card[$i]->cont_numb;
						$booking_numb = $obj->data->detail_card[$i]->booking_numb;
						$status_tl = $obj->data->detail_card[$i]->status_tl;
						$no_do = $obj->data->detail_card[$i]->no_do;
						$tgl_do = $obj->data->detail_card[$i]->tgl_do;
						$seal_id = $obj->data->detail_card[$i]->seal_id;
						$plug_out = $obj->data->detail_card[$i]->plug_out;

						if ($paid_thru2 <> '') {
							$paid_thru = $paid_thru2 . " 23:59";
						} else {
							$paid_thru = $paid_thru2;
						}

						$pdf->AddPage();
				// set font
						$pdf->SetFont('courier', '', 6);
						$tbl0 = <<<EOD
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
							'fgcolor' => array(0, 0, 0),
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
						$pdf->Image(APP_ROOT . 'config/cube/img/ipc_logo.png', 10, 9, 18, 12, '', '', '', true, 72);
						$pdf->Image(APP_ROOT . 'config/cube/img/eir2.png', 15, 115, 180, 50, '', '', '', true, 72);
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

					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->SetFont('courier', 'B', 6);
			//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			} else {
				echo "CETAKAN KE-" . $cetakan_ke . "\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
			}

		}
	}

	public function print_card_delply_atch($no_request, $port_code, $terminal_code, $hash = "")
	{

		$this->redirect();
			//generate hash
		$customer_id = $this->container_model->getCustomerId($no_request);
		$hash_check = md5($no_request . $customer_id);
		if ($hash != $hash_check) {
			return;
		}
			//AP
		$uname_phd = $this->session->userdata('uname_phd');
		if ($uname_phd == '')
			redirect(ROOT . 'mainpage', 'refresh');

		$card_password = $billerId = $this->user_model->get_pdf_password($this->session->userdata('uname_phd'));
		$billerId = $this->container_model->getNumberRequestBiller($no_request);

		$in_data = "<root>
	            <sc_type>1</sc_type>
	            <sc_code>123456</sc_code>
	            <data>
	                <no_request>$billerId</no_request>
	                <port_code>$port_code</port_code>
	                <terminal_code>$terminal_code</terminal_code>
	            </data>
	        </root>";

		if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getPDFCardContainer", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
				//echo $result;die;
			$obj = json_decode($result);
				//$tbl=base64_decode($obj->data->proforma_html);
				//print_r($tbl); die();
			$total = $obj->data->jumlah;
				//update activity log
			$this->container_model->updateTransactionLogActivity($no_request, "PRINT_CARD", $id_user_eservice = $this->session->userdata('uname_phd'));
			$cetakan_ke = $this->container_model->getCountCardPrint($no_request);
				//validasi limit cetakan kartu
			$vld = $this->container_model->getValidCardPrint($cetakan_ke, 'DEL');
				//echo $vld;die;
			if ($vld == "Y") {
				//print_r(count($obj->data->detail_card));
				if ($obj->data->detail_card) {

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
					$pdf->SetProtection(
						$permissions = array('print', 'print'),
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
					$pdf->SetAutoPageBreak(true, 10);
				//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				//set some language-dependent strings
					$pdf->setLanguageArray(null);
	// ---------------------------------------------------------
					if ($port_code == 'IDJKT') {
						$corporate_name = "PT. PELABUHAN TANJUNG PRIOK";
					} else if ($port_code == 'IDPNK') {
						$corporate_name = "PT. IPC TERMINAL PETIKEMAS";
					}

					if ($terminal_code == 'T3I') {
						$terminal_name = 'TERMINAL 3 OCEAN GOING';
						$app_name = 'OPUS';
					} else if ($terminal_code == 'T3D') {
						$terminal_name = 'TERMINAL 3 DOMESTIK';
						$app_name = 'ITOS';
					} else if ($terminal_code == 'T2D') {
						$terminal_name = 'TERMINAL 2 DOMESTIK';
						$app_name = 'ITOS';
					} else if ($terminal_code == 'T1D') {
						$terminal_name = 'TERMINAL 1 DOMESTIK';
						$app_name = 'ITOS';
					} else if ($terminal_code == 'T009D') {
						$terminal_name = 'TERMINAL 1 009 (DOMESTIK)';
						$app_name = 'OPUS';
					} else if ($terminal_code == 'L2D' || $terminal_code == 'L2I') {
						$terminal_name = 'LINI 2';
						$app_name = 'LineOS';
					}

				//print_r($rowz); die();
					$nourut = 1;
					for ($i = 0; $i < count($obj->data->detail_card); $i++) {
						$nocont = strtoupper($obj->data->detail_card[$i]->no_container);
				   // echo $nocont; die();
						$prefx = strtoupper($obj->data->detail_card[$i]->prefix);
						$id_nota = $obj->data->detail_card[$i]->id_nota;
						$id_req = $obj->data->detail_card[$i]->id_req;
						$disch_date = $obj->data->detail_card[$i]->disch_date;
						$posisi = $obj->data->detail_card[$i]->posisi;
						$clossing_time = $obj->data->detail_card[$i]->clossing_time;
						$paid_thru2 = $obj->data->detail_card[$i]->paidthru;
						$etd = $obj->data->detail_card[$i]->etd;
						$vessel = $obj->data->detail_card[$i]->vessel;
						$voyage = $obj->data->detail_card[$i]->voyage;
						$voyage_out = $obj->data->detail_card[$i]->voyage_out;
						$status_cont = $obj->data->detail_card[$i]->status_cont;
						$size_cont = $obj->data->detail_card[$i]->size_cont;
						$type_cont = $obj->data->detail_card[$i]->type_cont;
						$no_container = $obj->data->detail_card[$i]->no_container;
						$berat = $obj->data->detail_card[$i]->berat;
						$pelabuhan_tujuan = $obj->data->detail_card[$i]->pelabuhan_tujuan;
						$fpod = $obj->data->detail_card[$i]->fpod;
						$ipod = $obj->data->detail_card[$i]->ipod;
						$fipod = $obj->data->detail_card[$i]->fipod;
						$peb = $obj->data->detail_card[$i]->peb;
						$npe = $obj->data->detail_card[$i]->npe;
						$kode_pbm = $obj->data->detail_card[$i]->kode_pbm;
						$imo_class = $obj->data->detail_card[$i]->imo_class;
						$temp = $obj->data->detail_card[$i]->temp;
						$iso_code = $obj->data->detail_card[$i]->iso_code;
						$ipol = $obj->data->detail_card[$i]->ipol;
						$tgl_request = $obj->data->detail_card[$i]->tgl_request;
						$prefix = $obj->data->detail_card[$i]->prefix;
						$cont_numb = $obj->data->detail_card[$i]->cont_numb;
						$booking_numb = $obj->data->detail_card[$i]->booking_numb;
						$status_tl = $obj->data->detail_card[$i]->status_tl;
						$no_do = $obj->data->detail_card[$i]->no_do;
						$tgl_do = $obj->data->detail_card[$i]->tgl_do;
						$seal_id = $obj->data->detail_card[$i]->seal_id;

						if ($paid_thru2 <> '') {
							$paid_thru = $paid_thru2 . " 23:59";
						} else {
							$paid_thru = $paid_thru2;
						}

						$pdf->AddPage();
					// set font
						$pdf->SetFont('courier', '', 6);

						if ($type_cont == 'RFR') {
							$tblrfr = '<font style="font-size:24px">PLUG OUT</font> : <br/> <font style="font-size:24px">' . $plug_out . '</font>';
						}
						$dates = date('d-m-y h:i');

						$tbl0 = <<<EOD
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
							'fgcolor' => array(0, 0, 0),
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

					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->ln();
					$pdf->SetFont('courier', 'B', 6);
				//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
				} else {
					echo "NO,GAGAL";
				}
			} else {
				echo "CETAKAN KE-" . $cetakan_ke . "\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
			}

		}
	}

	public function print_card_delivery($no_request, $port_code, $terminal_code, $hash = "")
	{

		$this->redirect();

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if ($dataBilling["STATUS_REQ"] != "P") {
			redirect(ROOT . 'main', 'refresh');
		}

		if ($hash != md5($no_request)) {
			return;
		}

		$hash = md5($no_request . $this->session->userdata('customerid_phd'));

		$this->print_card_delivery_atch($no_request, $port_code, $terminal_code, $hash);

	}

	public function print_card_delply($no_request, $port_code, $terminal_code, $hash = "")
	{

		$this->redirect();
		$dataBilling = $this->container_model->getDetailBilling($no_request);
		if ($dataBilling["STATUS_REQ"] != "P") {
			redirect(ROOT . 'main', 'refresh');
		}

		if ($hash != md5($no_request)) {
			return;
		}

		$hash = md5($no_request . $this->session->userdata('customerid_phd'));
		$this->print_card_delply_atch($no_request, $port_code, $terminal_code, $hash);
	}

	public function upload_excel_delivery()
	{
			//include "excel_reader2.php";
		include_once(APPPATH . "libraries/excel_reader2.php");

		$terminal_excel = $_POST['terminal_excel'];
		$vessel_excel = $_POST['vessel_excel'];
		$id_vsb_voyage_excel = $_POST['id_vsb_voyage_excel'];
		$vessel_code_excel = $_POST['vessel_code_excel'];
		$call_sign_excel = $_POST['call_sign_excel'];
		$voyage_in_excel = $_POST['voyage_in_excel'];
		$voyage_out_excel = $_POST['voyage_out_excel'];
		$req = $_POST['req_excel'];
		$reqori = $this->container_model->getNumberRequestBiller($req);
		$date_delivery_excel = $_POST['date_delivery_excel'];
		$date_discharge_excel = $_POST['date_discharge_excel'];
		$delivery_type_excel = $_POST['delivery_type_excel'];
		if (($delivery_type_excel == 'N') || ($delivery_type_excel == 'LAP')) {
			$delivery_type_excel = 'YARD';
		} else {
			$delivery_type_excel = 'TL';
		}
			//get detail delivery
		$port = explode("-", $terminal_excel);
		$vessel_code = $vessel_code_excel;
		$voyage_in = $voyage_in_excel;
		$voyage_out = $voyage_out_excel;

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
		$param_temp = "";
		$temp = null;
		$jumlah_OK = 0;
			//echo($baris);die;
			//import data excel dari baris kedua, karena baris pertama adalah nama kolom
		for ($i = 2; $i <= $baris; $i++) {
				//membaca data nama depan (kolom ke-1)  (No Container)
			$no_container = $data->val($i, 1);
				//$ukk 			= $_GET['ukk'];
			if ($no_container != "") {
				$stack = array();

					//no error
					// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
					// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal

				if ($port[1] == 'L2D' || $port[1] == 'L2I') {
					$in_data = "	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_container>$no_container</no_container>
								<port_code>" . $port[0] . "</port_code>
								<terminal_code>" . $port[1] . "</terminal_code>
								<vessel_code>$vessel_code</vessel_code>
								<voyage_in>$voyage_in</voyage_in>
								<voyage_out>$voyage_out</voyage_out>
								<del_type>$delivery_type_excel</del_type>
								<vessel>$vessel_excel</vessel>
							</data>
						</root>";
						//echo $in_data;
				} else {
					$in_data = "	<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<no_container>$no_container</no_container>
								<port_code>" . $port[0] . "</port_code>
								<terminal_code>" . $port[1] . "</terminal_code>
								<vessel_code>$vessel_code</vessel_code>
								<voyage_in>$voyage_in</voyage_in>
								<voyage_out>$voyage_out</voyage_out>
								<del_type>$delivery_type_excel</del_type>
							</data>
						</root>";
				}
					//echo $in_data;die;
				if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "getDetailContainer", array("in_data" => "$in_data"), $result)) {
					echo $result;
					die;
				} else {
						//echo $result;die;
					$obj = json_decode($result);

					if ($obj->data->container) {
						for ($j = 0; $j < count($obj->data->container); $j++) {
							$temp = null;
							$temp['NO_CONTAINER'] = $obj->data->container[$j]->no_container;
							$temp['SIZE_CONT'] = $obj->data->container[$j]->size_cont;
							$temp['TYPE_CONT'] = $obj->data->container[$j]->type_cont;
							$temp['STATUS_CONT'] = $obj->data->container[$j]->status_cont;
							$temp['HEIGHT_CONT'] = $obj->data->container[$j]->height_cont;
							$temp['ID_CONT'] = $obj->data->container[$j]->id_cont;
							$temp['HZ'] = $obj->data->container[$j]->hz;
							$temp['IMO_CLASS'] = $obj->data->container[$j]->imo_class;
							$temp['UN_NUMBER'] = $obj->data->container[$j]->un_number;
							$temp['ISO_CODE'] = $obj->data->container[$j]->iso_code;
							$temp['TEMP'] = $obj->data->container[$j]->temp;
							$temp['WEIGHT'] = $obj->data->container[$j]->weight;
							$temp['CARRIER'] = $obj->data->container[$j]->carrier;
							$temp['OOG'] = $obj->data->container[$j]->oog;
							$temp['OVER_LEFT'] = $obj->data->container[$j]->over_left;
							$temp['OVER_RIGHT'] = $obj->data->container[$j]->over_right;
							$temp['OVER_FRONT'] = $obj->data->container[$j]->over_front;
							$temp['OVER_REAR'] = $obj->data->container[$j]->over_rear;
							$temp['OVER_HEIGHT'] = $obj->data->container[$j]->over_height;
							$temp['POD'] = $obj->data->container[$j]->pod;
							$temp['POL'] = $obj->data->container[$j]->pol;
							$temp['COMODITY'] = $obj->data->container[$j]->comodity;
							array_push($stack, $temp);
						}
					}
				}

					//add container to request delivery
				$stack = array();

				if ($temp != null) {
					try {
							//no error
							// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
							// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
						$in_data = "	<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<port_code>" . $port[0] . "</port_code>
									<terminal_code>" . $port[1] . "</terminal_code>
									<id_req>$reqori</id_req>
									<id_ves_voyage>$id_vsb_voyage_excel</id_ves_voyage>
									<vessel>$vessel_excel</vessel>
									<vessel_code>$vessel_code_excel</vessel_code>
									<call_sign>$call_sign_excel</call_sign>
									<voyage_in>$voyage_in_excel</voyage_in>
									<voyage_out>$voyage_out_excel</voyage_out>
									<no_container>" . $temp['NO_CONTAINER'] . "</no_container>
									<size_cont>" . $temp['SIZE_CONT'] . "</size_cont>
									<type_cont>" . $temp['TYPE_CONT'] . "</type_cont>
									<status_cont>" . $temp['STATUS_CONT'] . "</status_cont>
									<height_cont>" . $temp['HEIGHT_CONT'] . "</height_cont>;
									<id_cont>" . $temp['ID_CONT'] . "</id_cont>
									<hz>" . $temp['HZ'] . "</hz>
									<imo_class>" . $temp['IMO_CLASS'] . "</imo_class>
									<un_number>" . $temp['UN_NUMBER'] . "</un_number>
									<iso_code>" . $temp['ISO_CODE'] . "</iso_code>
									<temp>" . $temp['TEMP'] . "</temp>
									<disabled></disabled>
									<weight>" . $temp['WEIGHT'] . "</weight>
									<carrier>" . $temp['CARRIER'] . "</carrier>
									<oog>" . $temp['OOG'] . "</oog>
									<over_left>" . $temp['OVER_LEFT'] . "</over_left>
									<over_right>" . $temp['OVER_RIGHT'] . "</over_right>
									<over_front>" . $temp['OVER_FRONT'] . "</over_front>
									<over_rear>" . $temp['OVER_REAR'] . "</over_rear>
									<over_height>" . $temp['OVER_HEIGHT'] . "</over_height>
									<date_delivery>$date_delivery_excel</date_delivery>
									<date_discharge>$date_discharge_excel</date_discharge>
									<delivery_type>$delivery_type_excel</delivery_type>
									<pod>" . $temp['POD'] . "</pod>
									<pol>" . $temp['POL'] . "</pol>
								</data>
							</root>";
							//echo $in_data;die;
						if (!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "addDetailContainer", array("in_data" => "$in_data"), $result)) {
							echo $result;
							die;
						} else {
								//echo $result;die;
							$obj = json_decode($result);

							if ($obj->data->info) {
								if ($obj->data->info == 'OK') {
									$jumlah_OK++;
								} else {
									$param_temp .= $no_container . ' - ' . $obj->data->info . ' <br>';
								}
							} else {
								echo "NO,GAGAL";
							}
						}

					} catch (Exception $e) {
						echo "NO,GAGAL";
					}
				} else {
					$param_temp .= $no_container . ' - Container Not Found <br>';
				}
			}
		}
		$param = 'Jumlah OK ' . $jumlah_OK . '<br>';
		$param .= $param_temp;
			//echo($param_temp);
			//print_r($param_temp);
			//$param='Jumlah OK '.$jumlah_OK.'<br>';
			//$param.=$param_temp;
			//echo($param);
		$param = str_replace("^", "-", $param);
		$param = str_replace(",", " ", $param);
		header("Location: " . ROOT . "container/edit_delivery/" . $req . "/" . ($param));
		die();
	}

	public function view_request($a)
	{
		$data['no_request'] = $a;
		$datahead = $this->container_model->getNumberReqAndSource($a);
		$data['rowdata'] = $datahead;

		if ($datahead['MODUL'] == 'RECEIVING') {
			$wsdl = REQUEST_RECEIVING_CONTAINER;
			$modul = "getListContainer";
		} else if ($datahead['MODUL'] == 'DELIVERY') {
			$wsdl = REQUEST_DELIVERY_CONTAINER;
			$modul = "getListContainer";
		} else if ($datahead['MODUL'] == 'PERPANJANGAN DELIVERY') {
			$wsdl = REQUEST_PERPANJANGAN_DELIVERY;
			$modul = "getListContainerDelivery";
		} else if (($datahead['MODUL'] == 'CALBG') or ($datahead['MODUL'] == 'CALAG') or ($datahead['MODUL'] == 'CALDG')) {
			$wsdl = REQUEST_BATALMUAT;
			$modul = "getListContainerBM";
		}

		$stack = array();
		$reqNoBiller = $datahead['BILLER_REQUEST_ID'];

		$in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$reqNoBiller</norequest>
				<port_code>" . $datahead['PORT_ID'] . "</port_code>
				<terminal_code>" . $datahead['TERMINAL_ID'] . "</terminal_code>
			</data>
		</root>";

		if (!$this->nusoap_lib->call_wsdl($wsdl, "$modul", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->listcont) {
				for ($i = 0; $i < count($obj->data->listcont); $i++) {
					$temp;
					$temp['NO_CONTAINER'] = $obj->data->listcont[$i]->no_container;
					$temp['SIZE_CONT'] = $obj->data->listcont[$i]->size_cont;
					$temp['TYPE_CONT'] = $obj->data->listcont[$i]->type_cont;
					$temp['STATUS_CONT'] = $obj->data->listcont[$i]->status_cont;
					$temp['HZ'] = $obj->data->listcont[$i]->hz;
					$temp['KD_COMODITY'] = $obj->data->listcont[$i]->kd_comodity;
					$temp['ID_CONT'] = $obj->data->listcont[$i]->id_cont;
					$temp['ISO_CODE'] = $obj->data->listcont[$i]->iso_code;
					$temp['HEIGHT'] = $obj->data->listcont[$i]->height;
					$temp['CARRIER'] = $obj->data->listcont[$i]->carrier;
					$temp['OG'] = $obj->data->listcont[$i]->og;
					$temp['PLUG_IN'] = $obj->data->listcont[$i]->plug_in;
					$temp['PLUG_OUT'] = $obj->data->listcont[$i]->plug_out;
					$temp['PLUG_OUT_EXT'] = $obj->data->listcont[$i]->plug_out_ext;
					$temp['JML_SHIFT'] = $obj->data->listcont[$i]->jml_shift;
					$POD = $obj->data->listcont[$i]->pod;
					$FPOD = $obj->data->listcont[$i]->fpod;
					$start_shift = $obj->data->listcont[$i]->start_shift;
					$end_shift = $obj->data->listcont[$i]->end_shift;
					$shift_reefer = $obj->data->listcont[$i]->shift_rfr;
					$temp['NO_BOOKING_SHIP'] = $obj->data->listcont[$i]->no_booking_ship;
					$tl = $obj->data->listcont[$i]->tl_flag;
					$call_sign = $obj->data->listcont[$i]->call_sign;
					$stpr = $obj->data->listcont[$i]->start_period;
					$enpr = $obj->data->listcont[$i]->end_period;
					$expr = $obj->data->listcont[$i]->ext_period;
					array_push($stack, $temp);
				}
			}
		}


		$data['TL_FLAG'] = $tl;
		$data['CALL_SIGN'] = $call_sign;
		$data['POD'] = $POD;
		$data['FPOD'] = $FPOD;
		$data['START_SHIFT'] = $start_shift;
		$data['END_SHIFT'] = $end_shift;
		$data['SHIFT_REEFER'] = $shift_reefer;
		$data['START_PERIOD'] = $stpr;
		$data['END_PERIOD'] = $enpr;
		$data['EXT_PERIOD'] = $expr;
		$data['row_detail'] = $stack;
		$data['row_history'] = $this->container_model->getRequestHistory($a);
		$this->load->view('pages/container/approval_request_viewreq', $data);
	}

	public function auto_vessel_all()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}

		$term = $this->security->xss_clean(htmlentities(strtoupper($_GET["term"])));

		injek($term);

		$port = explode("-", $this->security->xss_clean(htmlentities($_GET["port"])));
		$stack = array();

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data = "	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
				<port_code>" . $port[0] . "</port_code>
				<terminal_code>" . $port[1] . "</terminal_code>
			</data>
		</root>";
        //echo $in_data;die;
		if (!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER, "getVesselVoyage", array("in_data" => "$in_data"), $result)) {
			echo $result;
			die;
		} else {
			//echo $result;die;
			$obj = json_decode($result);

			if ($obj->data->vessel) {
				for ($i = 0; $i < count($obj->data->vessel); $i++) {
					$temp;
					$temp['VESSEL'] = $obj->data->vessel[$i]->vessel_name;
					$temp['VOYAGE_IN'] = $obj->data->vessel[$i]->voyage_in;
					$temp['VOYAGE_OUT'] = $obj->data->vessel[$i]->voyage_out;
					array_push($stack, $temp);
				}
			}
		}

		echo json_encode($stack);
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
		$img_file = APP_ROOT . 'assets/images/copy.png';

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
