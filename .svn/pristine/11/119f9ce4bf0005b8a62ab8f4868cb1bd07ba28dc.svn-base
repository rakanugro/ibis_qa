<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Dashboard_invoice extends CI_Controller {

	var $API ="";
	public function __construct(){
	log_message('debug','----------------------------main.php/__construct------------------------------------');
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
		$this->load->library('MX_Encryption');
		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
		$this->load->model('auth_model','auth_model');
        $this->API=API_EINVOICE;
	}

	public function index(){

		$data["customer_name"] = "EINVOICE";

		$role_id =  $this->session->userdata('role_id')	;
		$data['menu_list'] = $this->user_model->get_menuList('j');
		// echo $role_id;die();exit();
		$data['user_role'] = $this->auth_model->get_lastrole($role_id);
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		// echo print_r($data) ;
		// die();

		/*layanan auth*/

		$data['layanan'] = $this->auth_model->get_layanan($role_id);

		// echo $this->session->userdata('user_id');
		//print_r($data['layanan']);
		if (! $this->session->userdata('is_login') ){
		 	redirect(ROOT.'main_invoice', 'refresh');
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/main', $data);
		$this->load->view('templates/footer', $data);
	}


	public function change_role(){
		$user_id =  $this->input->post('user_id');
		$role_id = $this->input->post('role_id');

		$change = $this->auth_model->change_role($user_id,$role_id);

		$this->session->set_userdata('role_id', $role_id);
		$this->session->set_userdata('role_type', $change->INV_ROLE_TYPE);
		$role_id = $this->session->userdata('role_id');


			// $unit = $this->auth_model->get_filter_role($role_id);

			// foreach ($unit as $key => $value) {
			// 	$row_unit[] = $value->INV_UNIT_CODE;

			// }
			//  //print_r($row_unit);
			// $unit_x =  json_encode($row_unit);

			// $this->session->set_userdata('unit_id', $unit_x);

			$cek_unit_org = $this->auth_model->check_unit_org();
			// $unit_org =  $cek_unit_org->INV_UNIT_ORGID;
			foreach ($cek_unit_org as $key => $value) {
					$row_unit_org[] = $value['INV_UNIT_ORGID'];
					$row_unit_code[] = $value['INV_UNIT_CODE'];
			}
			$unit_org =  json_encode($row_unit_org);
			$unit_code =  json_encode($row_unit_code);



			$role_id = $this->session->userdata('role_id');

			$unit = $this->auth_model->get_filter_role($role_id);
			// echo $role_id;
			// die();

			$unit_id = array();
			foreach ($unit as $key => $value) {
					$row_unit[] = $value->INV_UNIT_CODE;
			}
										 // print_r($unit_org);die();
			$unit_x =  json_encode($row_unit);
									//die;

			$this->session->set_userdata('unit_org',$unit_org);
			if ($role_id == 1) {
				$this->session->set_userdata('unit_id', $unit_x);
			} else {
				$this->session->set_userdata('unit_id', $unit_code);
			}
		$data = array(
				'status' => 'success',
				'message' => 'Role Changed',
				'aksi' => ''.ROOT.'dashboard_invoice'
			);

		echo json_encode($data);
	}

	public function change_unit(){
		$user_id =  $this->input->post('user_id');
		$unit_id = $this->input->post('unit_id');
		
		if($unit_id == 'ALL_UNIT') {

			$role_id = $this->session->userdata('role_id');
			$unit = $this->auth_model->get_filter_role($role_id);
			foreach ($unit as $key => $value) {
				$row_unit[] = $value->INV_UNIT_CODE;

			}
			$unit_x =  json_encode($row_unit);
			
			$cek_unit_org = $this->auth_model->check_unit_org();
			foreach ($cek_unit_org as $key => $value) {
					$row_unit_org[] = $value['INV_UNIT_ORGID'];
			}
			$unit_org =  json_encode($row_unit_org);
					
			/*Harusnya ORG ID dan Unit Code nya bisa semua ALL UNIT.  Derry Othman 18 NOv 2019*/		
			$this->session->set_userdata('unit_id', $unit_x);
			$this->session->set_userdata('unit_id_val', $unit_id);
			$this->session->set_userdata('unit_org',$unit_org);

			$data = array(
			'status' => 'success',
			'message' => 'Unit Changed',
			'aksi' => ''.ROOT.'dashboard_invoice'
			);

		}else {
			$row_unit[] = $unit_id;
			$unit_x =  json_encode($row_unit);
			/*Harusnya ORG ID dan Unit COde nya berubah.  Derry Othman 18 NOv 2019*/
			$data_unit = $this->auth_model->get_unit_org($unit_id);
			$unit_id_arr[] = $data_unit->INV_UNIT_CODE;
			$unit_org_arr[] = $data_unit->INV_UNIT_ORGID;
			$this->session->set_userdata('unit_org', json_encode($unit_org_arr));
			$this->session->set_userdata('unit_id', json_encode($unit_id_arr));			

			//$this->session->set_userdata('unit_id', $unit_x);
			$this->session->set_userdata('unit_id_val', $unit_id);

			$data = array(
			'status' => 'success',
			'message' => 'Unit Changed',
			'aksi' => ''.ROOT.'dashboard_invoice'
			);
		}




		echo json_encode($data);
	}

	public function get_services(){
		$role_id = $this->session->userdata('role_id');

		$layanan = $this->auth_model->get_layanan($role_id);
	}

	//Iman Sanjaya Sigma
	function ESBGetDKKRequest($NOUKK,$ORGID,$BRANCHCODE,$TGLJAMTIBA,$TGLJAMBERANGKAT)
    {
        $micro_date = microtime();
        $date_array = explode(" ",$micro_date);
        $date = date("Y-m-d H:i:s",$date_array[1]);
        $date_now =  $date . $date_array[0];

        // var_dump($NOUKK."|".$ORGID."|".$BRANCHCODE."|".$TGLJAMTIBA."|".$TGLJAMBERANGKAT);
        // die();

        $esbHeader = array(
            "externalId" => "TEST00001",
            "timestamp" => $date_now
        );

        $esbBody = array("noUkk" =>  $NOUKK, "orgId" =>  $ORGID, "branchCode" =>  $BRANCHCODE, "tglJamTiba" =>  null, "tglJamBerangkat" =>  null);

        $dkkRequestDoc = array("esbHeader" => $esbHeader, "esbBody" => $esbBody);
        $data = array("inquiryDkkRequest" => $dkkRequestDoc);

        $jsondata = json_encode($data);
        $response = $this->ESBGet($jsondata,"http://10.88.48.57:5555/restv2/inquiryData/dkk");

        // var_dump($NOUKK."|".$ORGID."|".$BRANCHCODE."|".$TGLJAMTIBA."|".$TGLJAMBERANGKAT);
        // var_dump($response);
        // die();

        return $response;
    }

    function ESBGetDTJKDPJKRequest($NOUKK,$KDPPKB)
    {
        $micro_date = microtime();
        $date_array = explode(" ",$micro_date);
        $date = date("Y-m-d H:i:s",$date_array[1]);
        $date_now =  $date . $date_array[0];
        $esbHeader = array(
            "externalId" => "5275682735",
            "timestamp" => $date_now
        );

        $esbBody = array("noUkk" =>  $NOUKK, "kdPpkb" =>  $KDPPKB, "orderByType" =>  "ASC");

        $DTJKDPJKRequestDoc = array("esbHeader" => $esbHeader, "esbBody" => $esbBody);
        $data = array("inquiryDataDtjkDpjkRequest" => $DTJKDPJKRequestDoc);

        $jsondata = json_encode($data);
        $response = $this->ESBGet($jsondata,"http://10.88.48.57:5555/restv2/inquiryData/dtjkdpjk");

        return $response;
    }

    function ESBGetMaterai($BRANCHCODE,$JENISNOTA,$AMOUNT)
        {

            $micro_date = microtime();
            $date_array = explode(" ",$micro_date);
            $date = date("Y-m-d H:i:s",$date_array[1]);
            $date_now =  $date . $date_array[0];
            $AMOUNT = strval($AMOUNT);

            $esbHeader = array(
                "externalId" => "5275682735",
                "timestamp" => $date_now,
            );

            $esbBody = array("pCabang" =>  $BRANCHCODE, "pTipeLayanan" =>  $JENISNOTA, "pAmount" =>  $AMOUNT);

            $MateraiRequestDoc = array("esbHeader" => $esbHeader, "esbBody" => $esbBody);
            $data = array("getAmountMateraiRequest" => $MateraiRequestDoc);

            $jsondata = json_encode($data);
            $response = $this->ESBGet($jsondata,"http://10.88.48.57:5555/restv2/inquiryData/materai");

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
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data,'','&'));
		$ex = curl_exec($ch);
		$result  = json_decode($ex);
		#debug file
         // file_put_contents("C:\server\htdocs\dummy\debug\debugDasboard.txt", print_r(
         // 	array(
         // 		"body" => $ex,
         // 		"url" => $uri,
         // 		"data" => $data,
         // ),true), FILE_APPEND);
		return $result;
	}

	public function get_entity($unit_code){
		return $get_entity = $this->auth_model->get_entity($unit_code);
	}

	public function cekInvoicing($ukk,$KD_PPKB=0){
		$params = array(
					    'NO_UKK' => $ukk,
					    'KD_PPKB' => $KD_PPKB
					);
		$cek = $this->senddataurl('CreateInvoiceKapal/checkObject/',$params,'POST');
		if (empty($cek)) {
			# code...
		} else {
			// $dkks_tailArr = $this->senddataurl('CreateDPJK/index/',$params,'POST');
			// if (strlen($dkks_tailArr->data[0]->BENTUK_3A)!=20) {
			// 	echo "No Nota salah ".$dkks_tailArr->data[0]->BENTUK_3A;
			// } else {
			// 	echo $cek;
			// }
				echo $cek;
			// echo print_r($dkks_tailArr->data[0]->BENTUK_3A);die();
			
		}

			// echo print_r($dkks_tailArr);die();
	}

	public function cekInvoicingKoreksi($ukk){
		$params = array(
					    'NO_UKK' => $ukk
					);
		$cek = $this->senddataurl('CreateInvoiceKapalKoreksi/checkObject/',$params,'POST');
		echo $cek;
	}

	//public function cetak_dpjk($ukk,$cab,$ppkb){
	public function cetak_dpjk($ukk,$cab,$ppkb,$ORGID,$TGLJAMTIBA,$TGLJAMBERANGKAT){
		// var_dump($ukk.'|'.$cab.'|'.$ppkb.'|'.$ORGID.'|'.$TGLJAMTIBA.'|'.$TGLJAMBERANGKAT);
	 	// die();
		date_default_timezone_set('Asia/Jakarta');      //Don't forget this..I had used this..just didn't mention it in the post
		$datetime_variable = new DateTime();
		$datetime_formatted = date_format($datetime_variable, 'Y-m-d H:i:s');
		$bulan = array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');

		$output_name = $cab."_".$ukk."_".$ppkb.".pdf";

		//Iman Sanjaya Sigma

		$GetDataDKK = $this->ESBGetDKKRequest($ukk,$ORGID,$cab,$TGLJAMTIBA,$TGLJAMBERANGKAT);
	    $GetDataDKKByNoUKK = json_decode($GetDataDKK, true);

	    //parse to variable
	    $nama_agen = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['nmAgen'];
		$kd_agen = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['kdAgen'];
		$kd_kapal	= $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['kdKapal'];
		$nama_kapal = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['nmKapal'];
		//$nama_kapal = $ukk."|".$cab."|".$ppkb."|".$ORGID."|".$TGLJAMTIBA."|".$TGLJAMBERANGKAT;
		$no_ukk = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['noUkk'];
		$tgl_jam_berangkat = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['tglJamBerangkat'];
		$tgl_jam_tiba = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['tglJamTiba'];

		$bendera = 'INDONESIA';
		$jenis_pelayaran = strtoupper($GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['pelayaran']);
		$jenis_kapal = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['namaJeniusKapal'];
		$kunjungan = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['kunjungan'];
		$gt_loa = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['loa'];
		$asal = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['pelabuhanAsal'];
		$tujuan = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['pelabuhanTujuan'];
		$sebelum = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['pelabuhanSebelum'];
		$berikutnya =  $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['pelabuhanBerikut'];
		$form_1A = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['kdPpkb'];
		$branch_code = $GetDataDKKByNoUKK['inquiryDkkResponse']['esbBody'][0]['dkk'][0]['branchCode'];

		//End Iman Sanjaya Sigma

		$kop = $this->get_entity($branch_code);

		$params_ = array(

			'NO_UKK' => $ukk,
			'KD_PPKB' => $ppkb,

		);

		$postdata_ = $params_;

			//$dkk_tailArr = $this->senddataurl('CreateDTJK/index/',$postdata_,'POST');

			//$dkks_tailArrss = $this->senddataurl('CreateDPJK/index/',$postdata_,'POST');

			$GetDataDPJKDTJK = $this->ESBGetDTJKDPJKRequest($ukk,$ppkb);
	    	$Alldkks_tailArr = json_decode($GetDataDPJKDTJK, true);
			//var_dump($Alldkks_tailArr);
			//die();
	    	$dkks_tailArr = $Alldkks_tailArr;
	    	$dkk_tailArr = $Alldkks_tailArr['inquiryDataDtjkDpjkResponse']['esbBody']['dataDtjk'];

			$dkks_tail = $dkks_tailArr['inquiryDataDtjkDpjkResponse']['esbBody']['dataDpjk'];
			//$dkk_tail = $dkks_tailArr['inquiryDataDpjkResponse']['esbBody']['data'];
			$kursArr = $Alldkks_tailArr['inquiryDataDtjkDpjkResponse']['esbBody']['kurs'][0];
			$totalResult = $dkks_tailArr['inquiryDataDtjkDpjkResponse']['esbBody']['total'][0];

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
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// // set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// // set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// // set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
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
				$data2 = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_CODE"=>$dkk_header[0]->BRANCH_CODE),'POST');
				// print_r($data2);die();
				$header_nota = array(
								"status_lunas"=>'S',
								"e_logo"=>$data2[0]->INV_ENTITY_LOGO,
								"e_name"=>$data2[0]->INV_ENTITY_NAME,
								"num"=>$dkks_tailArr['inquiryDataDpjkResponse']['esbBody']['data'][0]['bentuk3A'],
								"e_address"=>$data2[0]->INV_ENTITY_ALAMAT,
								"tgl_nota"=>date("d").'-'.$bulan[intval(date("m"))].'-'.date("Y"),
								"bag"=>'KPL',
								"e_npwp"=>$data2[0]->INV_ENTITY_NPWP,
								"e_faktur"=>$data2[0]->INV_ENTITY_FAKTUR);
				// print_r($header_nota);die();
				$this->load->helper('nota_invoice_helper');
				$header1 = header_pranota($header_nota);
				$header1 = '<table><tr><td>&nbsp;</td></tr></table>'.$header1;
				$gambar = "";
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
		                    <td width="420" align="center" style="font-size:24px">DATA TRANSAKSI - JASA KAPAL</td>
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
					  	# code...


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
						// echo print_r($dkk_tailArrA);die();
						foreach ($dkk_tailArrA as $key => $row) {
							if($row["uraian"] == 'PANDU' OR $row["uraian"] == 'TUNDA'  ){ 
								$trx_tail .= '<tr height="15">
									            <td height="25" colspan="4"><div align="left">';
								$trx_tail .= $row["ketUraian"] . " &nbsp;&nbsp;&nbsp;&nbsp;". $row["form2A"];
								$trx_tail .= '</div></td>';
								$trx_tail .= '<td height="25">'. '&nbsp;&nbsp;:'.$row["keterangan2"].'</td>';
								$trx_tail .= '</tr>';
								$trx_tail .=  '<tr style="padding:10px;">
												<td></td>
												<td>'.$row["ppkbKe"].'</td>
												<td></td>
												<td>'.$row["tglJamMulai"].'</td>
												<td>'.$row["tglJamSelesai"].'</td>
												<td>'.$row["keterangan1"].'</td>
												</tr>';


								if ($row["keterangan3"] != '') {
									$trx_tail .= '<tr>';
									$trx_tail .= '<td height="25" colspan="6" align="left">'.$row['keterangan3'].'</td>';
									$trx_tail .= '</tr>';
								}
							} else {
								if ($row["uraian"] == 'BONGKAR/MUAT') {
									$trx_tail .= '<hr />';
								}
								$trx_tail .= '<tr height="15">
								            <td height="25"><div align="left">';
								$trx_tail .= $row["uraian"] ."&nbsp;&nbsp;&nbsp;". $row["ketUraian"];
								$trx_tail .= '</div></td>';
								$trx_tail .=  '<td>'.$row['ppkbKe'].'</td>
												<td>'.$row['form1A'].'</td>
												<td>'.$row['tglJamMulai'].'</td>
												<td>'.$row['tglJamSelesai'].'</td>
												<td>'.$row['keterangan1'].' '.$row["keterangan2"].'</td>
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

				$gambar = "";
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
		                    <td width="200" align="left">Cabang Pelabuhan '.$kop->INV_UNIT_CODE.'</td>
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
			$MATERAI = 0;

			$JenisNota = 'KPL01';
			if($totalResult['signCurrency'] != "Rp."){
				$JenisNota = 'KPL02';
			}

			$AMOUNTJT = str_replace(",00","",$totalResult['ketJumlahTagihan2']);
			$AMOUNTJT = str_replace(".","",$AMOUNTJT);

			$GetDataMaterai = $this->ESBGetMaterai($cab,$JenisNota,$AMOUNTJT);
	    	$GetDataNilaiMaterai = json_decode($GetDataMaterai, true);

	    	$MATERAI = $GetDataNilaiMaterai['getAmountMateraiResponse']['esbBody']['nilaiMaterai'];

	    	if($MATERAI == null || $MATERAI == 0){
	    		$AMOUNTJT2 = str_replace(",00","",$totalResult['jmlTagihanKurs']);
				$AMOUNTJT2 = str_replace(".","",$AMOUNTJT2);

				$GetDataMaterai = $this->ESBGetMaterai($cab,$JenisNota,$AMOUNTJT2);
		    	$GetDataNilaiMaterai = json_decode($GetDataMaterai, true);

		    	$MATERAI = $GetDataNilaiMaterai['getAmountMateraiResponse']['esbBody']['nilaiMaterai'];
	    	}

			// var_dump($dkks_tail);
			// die();
			foreach ($dkks_tail as $key => $datum) {

				 // $jml_ppn += ($datum->JML_PPN);
				 $jml_ppn += 0;
				 $jml_hitung += ($datum['jumlah']);
					    // <td>'.$datum->URAIAN.'<br>'.$datum->URAIAN1.'</td>
				if ($datum['uraian'] == 'UANG LABUH' AND $datum['uraian2'] == '') {
				$trx_tail2 .='
					<tr>
				        <td ><div align="left"> '.$datum['uraian'].' </div></td>
				        <td  align="center">'.$datum['ppkbKe'].'</td>
				        <td >'.$datum['form2A'].'</td>
				        <td >'.$datum['tglJamMulai'].'</td>
				        <td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>
					';
				} else {

				}

				if ($datum['uraian'] == 'UANG TAMBAT') {
					$trx_tail2 .= '<tr>
					        <td align="left"> '.$datum['uraian'].'</td>
					        <td align="center"></td>
					        <td ></td>
					        <td ></td>
					        <td ></td>
					        <td align="left"><div align="left"></div></td>
					        <td align="right">&nbsp;</td>
					        <td align="right"><div align="right"></div></td>
					      </tr>
					      <tr>
					        <td align="left"> '.$datum['uraian1'].'</td>
					        <td align="center">'.$datum['ppkbKe'].'</td>
					        <td >'.$datum['form2A'].'</td>
					        <td >'.$datum['tglJamMulai'].'</td>
					        <td >'.$datum['tglJamSelesai'].'</td>
					        <td  align="left"><div align="left">'.$datum['uraian4'].'</div></td>
					        <td align="right">&nbsp;</td>
					        <td align="right"><div align="right"></div></td>
					      </tr>';

				} else {
				}

				// untuk mendapatkan keterangan uraian MASA
				$masa = substr($datum['uraian1'],0,4); 
				if ($masa == "MASA") {
					$trx_tail2 .= '<tr>
			        <td ><div align="left"></div></td>
			        <td  align="center"><div align="left"></div></td>
			        <td ><div align="center">'.$datum['uraian1'].'</div></td>
			        <td >'.$datum['tglJamMulai'].'</td>
					<td >'.$datum['tglJamSelesai'].'</td>
			        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
			        <td align="right">'.$datum['keteranganFormulaD'].'</td>
			        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
			      </tr>';
				} else {
				}

				$trx_tail2 .= '<tr>';
				if ($datum['gerakan'] != '' AND $datum['gerakanDari'] != '' AND $datum['gerakanKe'] != '' AND $datum['uraian'] == 'UANG PANDU') {
					$trx_tail2 .= '<td  colspan="8"><div align="left">'.$datum['gerakan'].$datum['gerakanDari'].$datum['gerakanKe'].'</div></td>';
				}
				$trx_tail2 .= '</tr>';

				if ($datum['uraian'] == 'UANG PANDU' ) {
					$trx_tail2 .= '<tr>
					        <td ><div align="left">'.$datum['uraian'].'</div></td>
					        <td  align="center"><div align="center">'.$datum['ppkbKe'].'</div></td>
					        <td ><div align="center">'.$datum['form2A'].'</div></td>
					        <td >'.$datum['tglJamMulai'].'</td>
							<td >'.$datum['tglJamSelesai'].'</td>
					        <td  align="left">'.$datum['uraian5'].' : '.$datum['keteranganPerhitungan'].'</td>
					        <td align="right">'.$datum['keteranganFormulaD'].'</td>
					        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
					      </tr>';
				}

				if ($datum['uraian2'] == 'TARIF TAMBAHAN') {
					$trx_tail2 .= '<tr>
						        <td ><div align="left"></div></td>
						        <td  colspan="2" align="center"><div align="right">'.$datum['uraian2'].' : </div></td>
						        <td ></td>
						        <td ></td>
						        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
						        <td align="right">'.$datum['keteranganFormulaD'].'</td>
						        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
						      </tr>';
				}

				if ($datum['uraian'] == 'UANG TUNDA') {
					$trx_tail2 .= '<tr>
							        <td  colspan="5"><div align="left"> '.$datum['uraian'].' '.$datum['uraian1'].' </div></td>
							        <td  align="left"><div align="left"></div></td>
							        <td align="right">&nbsp;</td>
							        <td  align="right"><div align="right"></div></td>
							      </tr>';
				}

	  			if ($datum['uraian2'] == 'TARIF TETAP' ) {
	  				$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum['uraian2'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td ><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>';
	  			}

				if ($datum['uraian2'] == 'TARIF VARIABEL' ) {
					$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum['uraian2'].' &nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>';
				}

				if ($datum['uraian2'] == 'SURCHARGE' ) {
					$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum['uraian2'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>';
				}	

	  			if ($datum['uraian2'] == 'PAKET' ) {
	  				$trx_tail2 .= '<tr>
			        <td ></td>
			        <td  colspan="2"><div align="left">'.$datum['uraian2'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
			        <td >'.$datum['tglJamMulai'].'</td>
					<td >'.$datum['tglJamSelesai'].'</td>
			        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
			        <td align="right">'.$datum['keteranganFormulaD'].'</td>
			        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
			      </tr>';
	  			}

	  			if ($datum['uraian2'] == 'BIAYA TETAP EMERGENCY' ) {
	  				$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum['uraian2'] .'&nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>';
	  			}

	  			if ($datum['uraian2'] == 'SURCHARGE EMERGENCY' ) {
	  				$trx_tail2 .= '<tr>
				        <td ></td>
				        <td  colspan="2"><div align="left">'.$datum['uraian2'].' &nbsp;&nbsp;&nbsp;&nbsp;:</div></td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>';
	  			}

			  if ($datum['uraian'] == 'UANG KEPIL' ) {
			  	$trx_tail2 .= '<tr>
					        <td  align="left">'.$datum['uraian'].'</td>
					        <td  colspan="2" align="left">'.$datum['uraian1'].'</td>
					        <td >'.$datum['tglJamMulai'].'</td>
							<td >'.$datum['tglJamSelesai'].'</td>
					        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
					        <td align="right">'.$datum['keteranganFormulaD'].'</td>
					        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
					      </tr>';
			  }

				if ($datum['uraian3'] != "") {
					$trx_tail2 .= '<tr>
				        <td  align="left">'.$datum['uraian'].'</td>
				        <td  colspan="2" align="left">'.$datum['uraian1'].'</td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
				      </tr>';
				}
				if ($datum['uraian'] == 'UANG SAMPAH') {
					$trx_tail2 .= '<tr>
			        <td ><div align="left"> '.$datum['uraian'].' </div></td>
			        <td  align="center">'.$datum['form2A'].'</td>
			        <td  align="left"></td>
			        <td >'.$datum['tglJamMulai'].'</td>
					<td >'.$datum['tglJamSelesai'].'</td>
			        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
			        <td align="right">'.$datum['keteranganFormulaD'].'</td>
			        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
			      </tr>';
				}
				if ($datum['uraian'] == 'PEMBULATAN ATAS PELY JASA MINIMAL') {
					$trx_tail2 .= '<tr>
			        <td ><div align="left"> '.$datum['uraian'].' </div></td>
			        <td align="center"></td>
			        <td>&nbsp;</td>
			        <td>&nbsp;</td>
			        <td >&nbsp;</td>
			        <td  align="left">&nbsp;</td>
			        <td align="right">'.$datum['keteranganFormulaD'].'</td>
			        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
			      </tr>';
				}

				if ($datum['uraian'] == 'BONGKAR/MUAT') {
					$data_bm = $datum;    
				}

				if ($datum['uraian'] == 'UANG AIR') {
					$trx_tail2 .= '<tr>
				        <td ><div align="left"> '.$datum['uraian'].' </div></td>
				        <td  align="center">'.$datum['ppkbKe'].'</td>
				        <td >'.$datum['form2A'].'</td>
				        <td >'.$datum['tglJamMulai'].'</td>
						<td >'.$datum['tglJamSelesai'].'</td>
				        <td  align="left"> '.$datum['keteranganPerhitungan'].' </td>
				        <td align="right">'.$datum['keteranganFormulaD'].'</td>
				        <td  align="right"><div align="right">'.$datum['keteranganJumlah'].'</div></td>
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
						    <td width="30" align="right">'.$totalResult['signCurrency'].'</td>
						    <td align="right" width="100">'.$totalResult['ppnDikenakan'].'</td>
						  </tr>
						  <tr>
						    <td>a. PPN dipungut sendiri</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult['signCurrency'].'</td>
						    <td align="right">'.$totalResult['ppnDikenakan10'].'</td>
						  </tr>
						  <tr>
						    <td>b. PPN dipungut Pemungut </td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult['signCurrency'].'</td>
						    <td align="right">0</td>
						  </tr>
						  <tr>
						    <td>c. PPN tidak dipungut</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult['signCurrency'].'</td>
						    <td align="right">0</td>
						  </tr>
						  <tr>
						    <td>d. PPN dibebaskan</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">'.$totalResult['signCurrency'].'</td>
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
						  </tr>';
			if($MATERAI > 0){
			   $pajak .= '<tr>
						    <td>Materai</td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td></td>
						    <td align="right">Rp.</td>
						    <td align="right">'.number_format($MATERAI,2,',','.').'</td>
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
						  </tr>';
			}


			 $pajak .= '</table>';

			 // $JumlahPerhitungan = 0;
			 // $JumlahPerhitungan = $totalResult->KET_JUMLAH_TAGIHAN2 + $MATERAI;

			 	//Membuat Nilai Jumlah Perhitungan yang ditambah Nilai Materai
			 	$JumlahPerhitungan = str_replace(",00","",$totalResult['ketJumlahTagihan2']);
				$JumlahPerhitungan = str_replace(".","",$JumlahPerhitungan);
				$JumlahPerhitungan = $JumlahPerhitungan + $MATERAI;
				//End Membuat Nilai Jumlah Perhitungan yang ditambah Nilai Materai

				//Membuat Nilai Jumlah Perhitungan Dalam Rupiah yang ditambah Nilai Materai
			 	$JumlahPerhitunganDalamRupiah = str_replace(",00","",$totalResult['jmlTagihanKurs']);
				$JumlahPerhitunganDalamRupiah = str_replace(".","",$JumlahPerhitunganDalamRupiah);
				$JumlahPerhitunganDalamRupiah = $JumlahPerhitunganDalamRupiah + $MATERAI;
				//End Membuat Nilai Jumlah Perhitungan Dalam Rupiah yang ditambah Nilai Materai

				//Membuat Nilai Piutang yang ditambah Nilai Materai
			 	$JumlahPiutang = str_replace(",00","",$totalResult['piutang']);
				$JumlahPiutang = str_replace(".","",$JumlahPiutang);
				$JumlahPiutang = $JumlahPiutang + $MATERAI;
				//End Membuat Nilai Piutang yang ditambah Nilai Materai

				//Validasi Sisa Piutang
				$UangJaminan = str_replace(",00","",$totalResult['uangJaminan']);
				$UangJaminan = str_replace(".","",$UangJaminan);
				//End Validasi Sisa Piutang

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
								    <td  align="right">'.$totalResult['signCurrency'].'</td>
								    <td  align="right">'.number_format($JumlahPerhitungan,2,',','.').'</td>
								  </tr>';
								    // <td  align="right">'.number_format($jml_hitung+$jml_ppn,0,',','.').'</td>
				if ($totalResult['signCurrency'] != "Rp.") {

					if($UangJaminan == $JumlahPerhitunganDalamRupiah){
						$JumlahPiutang = 0;
					}
					
					$total_perhitungan .= '	  
								  <tr>
								    <td>2. KURS YANG BERLAKU</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">1 USD =</td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.$kursArr['kursRate'].'</td>
								  </tr>
								  <tr>
								    <td COLSPAN="3">3. JUMLAH PERHITUNGAN (DALAM RUPIAH)</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($JumlahPerhitunganDalamRupiah,2,',','.').'</td>
								  </tr>
								  <tr>
								    <td>4. UANG JAMINAN NO</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($UangJaminan,2,',','.').'</td>
								  </tr>
								  <tr>
								    <td>5. PIUTANG</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($JumlahPiutang,2,',','.').'</td>
								  </tr>
								</table>';
				} else {

					if($UangJaminan == $JumlahPerhitungan){
						$JumlahPiutang = 0;
					}

					$total_perhitungan .= '	  
								  <tr>
								    <td>2. UANG JAMINAN NO</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($UangJaminan,2,',','.').'</td>
								  </tr>
								  <tr>
								    <td>3. PIUTANG</td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td></td>
								    <td  align="right">Rp.</td>
								    <td  align="right">'.number_format($JumlahPiutang,2,',','.').'</td>
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
						    <th style="" width="430">'.$totalResult['piutangNumword'].'</th>
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

	public function cetak_dpjk_dtjk($ukk,$cab,$ppkb){

		date_default_timezone_set('Asia/Jakarta');      //Don't forget this..I had used this..just didn't mention it in the post
		$datetime_variable = new DateTime();
		$bulan = array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
		$datetime_formatted = date_format($datetime_variable, 'Y-m-d H:i:s');
		// $datetime_formatted  = '27/03/2018 14:00';
		$dec_ukk_ppkb = explode("|",$this->mx_encryption->decrypt($enc_ukk_ppkb));
		//print_r($dec_ukk_ppkb);
		//die();
		// $ukk = $dec_ukk_ppkb[0];
		// $ppkb = $dec_ukk_ppkb[1];
		$ukk = $ukk;
		$ppkb = $ppkb;
		// cek token
		/*$real_token = md5(sha1(md5(base64_encode(base64_encode($ukk).base64_encode($ppkb)))));

		if($check_token != $real_token) {
			echo 'invalid token';
			//echo $real_token;
			die();
		}*/
		$params = array(
			    'NO_UKK' => $ukk,
			    'BRANCH_CODE' => $cab,
			);

		$postdata =$params;
		$dkk_header = $this->senddataurl('reviewDKK/cetak4a/',$postdata,'POST');
		// $value = $this->getdataurl('invh/pdf/KAPAL/'.$id);
		foreach ($dkk_header as $key => $value) {


				/*$nama_agen = $value->CUSTOMER_NAME;
				$kd_agen = $value->CUSTOMER_NUMBER;
				$nama_kapal = $value->INTERFACE_HEADER_ATTRIBUTE2;
				$no_ukk = $value->INTERFACE_HEADER_ATTRIBUTE6;
				$bendera = 'INDONESIA';
				$jenis_pelayaran = strtoupper($value->INTERFACE_HEADER_ATTRIBUTE3);
				$jenis_kapal =$value->INTERFACE_HEADER_ATTRIBUTE9;
				$kunjungan = $value->INTERFACE_HEADER_ATTRIBUTE13;
				$gt_loa = $value->INTERFACE_HEADER_ATTRIBUTE11.'/'.$value->INTERFACE_HEADER_ATTRIBUTE12;
				$asal = $value->INTERFACE_HEADER_ATTRIBUTE7;
				$tujuan = $value->INTERFACE_HEADER_ATTRIBUTE8;
				$form_1A = $value->INTERFACE_HEADER_ATTRIBUTE1;
				
				$kd_kapal	= $value->KD_KAPAL;
				$tgl_jam_berangkat = $value->TGL_JAM_BERANGKAT;
				$tgl_jam_tiba = $value->TGL_JAM_TIBA;
				$sebelum = $value->PELABUHAN_SEBELUM;
				$berikutnya =  $value->PELABUHAN_BERIKUT;
				$branch_code = $value->BRANCH_CODE;*/

				
				$nama_agen = $value->NM_AGEN;
				$kd_agen = $value->KD_AGEN;
				$kd_kapal	= $value->KD_KAPAL;
				$nama_kapal = $value->NM_KAPAL;
				$no_ukk = $value->NO_UKK;
				$tgl_jam_berangkat = $value->TGL_JAM_BERANGKAT;
				$tgl_jam_tiba = $value->TGL_JAM_TIBA;

				$bendera = 'INDONESIA';
				$jenis_pelayaran = strtoupper($value->PELAYARAN);
				$jenis_kapal =$value->NAMA_JENIS_KAPAL;
				$kunjungan = $value->KUNJUNGAN;
				$gt_loa = $value->GRT.'/'.$value->LOA;
				$asal = $value->PELABUHAN_ASAL;
				$tujuan = $value->PELABUHAN_TUJUAN;
				$sebelum = $value->PELABUHAN_SEBELUM;
				$berikutnya =  $value->PELABUHAN_BERIKUT;
				$form_1A = $value->KD_PPKB;
				$branch_code = $value->BRANCH_CODE;



			}

		$kop = $this->get_entity($branch_code);

		$params_ = array(

			'NO_UKK' => $ukk,
			'KD_PPKB' => $ppkb,


		);

		$postdata_ =$params_;

		$dkk_tailArr = $this->senddataurl('CreateDTJK/index/',$postdata_,'POST');

		$dkks_tailArr = $this->senddataurl('CreateDPJK/index/',$postdata_,'POST');

		$dkks_tail = $dkks_tailArr->data;
		$dkk_tail = $dkks_tailArr->data;
		$kursArr = $dkks_tailArr->kurs[0];
		$totalResult = $dkks_tailArr->total[0];

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
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// // set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// // set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// // set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
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
			$data2 = $this->senddataurl('reviewSimopRupa/searchHeader/',array("INV_UNIT_CODE"=>$dkk_header[0]->BRANCH_CODE),'POST');
			// print_r($data2);die();
			$header_nota = array(
							"status_lunas"=>'S',
							"e_logo"=>$data2[0]->INV_ENTITY_LOGO,
							"e_name"=>$data2[0]->INV_ENTITY_NAME,
							"num"=>$dkks_tailArr->data[0]->BENTUK_3A,
							"e_address"=>$data2[0]->INV_ENTITY_ALAMAT,
							"tgl_nota"=>date("d").'-'.$bulan[intval(date("m"))].'-'.date("Y"),
							"bag"=>'KPL',
							"e_npwp"=>$data2[0]->INV_ENTITY_NPWP,
							"e_faktur"=>$data2[0]->INV_ENTITY_FAKTUR);
			// print_r($header_nota);die();
			$this->load->helper('nota_invoice_helper');
			$header1 = header_pranota($header_nota);
			$header1 = '<table><tr><td>&nbsp;</td></tr></table>'.$header1;
			$gambar = "";
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
	                   	<td width="200" align="left">Cabang Pelabuhan '.$kop->INV_UNIT_CODE.'</td>
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
	                /*'<table border="0px">
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

	                </table>';*/

	         $judul ='<table>
	        			<tr>
	                    <td width="110" align="left"></td>
	                    <td width="420" align="center" style="font-size:24px">DATA TRANSAKSI - JASA KAPAL</td>
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
	        	<table style="padding-top20px;">
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

				  foreach ($dkk_tail as $key => $nilai) {
				  	# code...


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
					// echo print_r($dkk_tailArrA);die();
					foreach ($dkk_tailArrA as $key => $row) {
						if($row["URAIAN"] == 'PANDU' OR $row["URAIAN"] == 'TUNDA'  ){ 
							$trx_tail .= '<tr height="15">
								            <td height="25" colspan="4"><div align="left">';
							$trx_tail .= $row["KET_URAIAN"] . " &nbsp;&nbsp;&nbsp;&nbsp;". $row["FORM2A"];
							$trx_tail .= '</div></td>';
							$trx_tail .= '<td height="25">'. '&nbsp;&nbsp;:'.$row["KETERANGAN2"].'</td>';
							$trx_tail .= '</tr>';
							$trx_tail .=  '<tr style="padding:10px;">
											<td></td>
											<td>'.$row["PPKB_KE"].'</td>
											<td></td>
											<td>'.$row["TGL_JAM_MULAI"].'</td>
											<td>'.$row["TGL_JAM_SELESAI"].'</td>
											<td>'.$row["KETERANGAN1"].'</td>
											</tr>';


							if ($row["KETERANGAN3"] != '') {
								$trx_tail .= '<tr>';
								$trx_tail .= '<td height="25" colspan="6" align="left">'.$row['KETERANGAN3'].'</td>';
								$trx_tail .= '</tr>';
							}
						} else {
							if ($row["URAIAN"] == 'BONGKAR/MUAT') {
								$trx_tail .= '<hr />';
							}
							$trx_tail .= '<tr height="15">
							            <td height="25"><div align="left">';
							$trx_tail .= $row["URAIAN"] ."&nbsp;&nbsp;&nbsp;". $row["KET_URAIAN"];
							$trx_tail .= '</div></td>';
							$trx_tail .=  '<td>'.$row['PPKB_KE'].'</td>
											<td>'.$row['FORM1A'].'</td>
											<td>'.$row['TGL_JAM_MULAI'].'</td>
											<td>'.$row['TGL_JAM_SELESAI'].'</td>
											<td>'.$row['KETERANGAN1'].' '.$row["KETERANGAN2"].'</td>
											</tr>';
							
						}

					}

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




	        $output_name = "REPORT NOTA DPJK";
	        $pdf->SetFont('gotham', '', 8);
	        $pdf->writeHtml($header1, true, false, false, false, '');
	        $pdf->SetFont('courier', '', 8);
	        $pdf->writeHtml($judul, true, false, false, false, '');
	        $pdf->writeHtml($trx_header, true, false, false, false, '');
	        $pdf->writeHtml($trx_tail, true, false, false, false, '');
	        $pdf->writeHtml($footer1, true, false, false, false, '');

	        $pdf->startPageGroup();
	        // add a page
			$pdf->AddPage();


			

			$header = '<table border="0px">
					<tr>
	                    <td width="200" align="left" rowspan="2">'.$gambar.'</td>
	                    <td width="350" align="right"></td>
	                    <td width="100" align="left"></td>
	                    <td width="20" align="left"></td>
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
	                   	<td width="200" align="left">Cabang Pelabuhan '.$kop->INV_UNIT_CODE.'</td>
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
				    <th style="border-bottom: 1px solid black;" height="15px" width="110" align="left"></th>
				    <th style="border-bottom: 1px solid black;" height="15px" width="50" align="left"></th>
				    <th style="border-bottom: 1px solid black;" height="15px" ></th>
				    <th style="border-bottom: 1px solid black;" height="15px" width="70" ></th>
				    <th style="border-bottom: 1px solid black;" height="15px" width="70" ></th>
				    <th style="border-bottom: 1px solid black;" height="15px" width="140" ></th>
				    <th style="border-bottom: 1px solid black;" height="15px" width="30" ></th>
				    <th style="border-bottom: 1px solid black;" height="15px" width="80"  ></th>
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
		/*
		foreach ($dkks_tail as $key => $nilai2) {
			 $jml_ppn += ($nilai2->JML_PPN);
			 $jml_hitung += ($nilai2->JUMLAH);
			$trx_tail2 .='
				  <tr style="padding:10px;">
				    <td>'.$nilai2->URAIAN.'</td>
				    <td style="font-size: 11px;font-family: franklingothicbook;" >'.$nilai2->PPKB_KE.'</td>
				    <td>'.$nilai2->FORM1A.'</td>
				    <td>'.$nilai2->TGL_JAM_MULAI.'</td>
				    <td>'.$nilai2->TGL_JAM_MULAI.'</td>
				    <td>'.$nilai2->KETERANGAN_PERHITUNGAN.' </td>
				    <td align="right">Rp.</td>
				    <td align="right" style="font-size: 11px;font-family: franklingothicbook;" >'.number_format($nilai2->JUMLAH,0,',','.').'</td>
				  </tr>';


		}*/

		$jml_ppn = 0;
		$jml_hitung = 0;
		$kursRate = 0 ; 
		foreach ($dkks_tail as $key => $datum) {
			$jml_ppn += ($datum->JML_PPN);
			$jml_hitung += ($datum->JUMLAH);
				    // <td>'.$datum->URAIAN.'<br>'.$datum->URAIAN1.'</td>
			if ($datum->URAIAN == 'UANG LABUH' AND $datum->URAIAN2 == '') {
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
			if ($masa == "MASA") {
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
			if ($datum->GERAKAN != '' AND $datum->GERAKAN_DARI != '' AND $datum->GERAKAN_KE != '' AND $datum->URAIAN == 'UANG PANDU') {
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

			if ($datum->URAIAN3 != "") {
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
				if ($totalResult->SIGN_CURRENCY != "Rp.") {
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
								    <td  align="right">'.$totalResult->UANG_JAMINAN.'</td>
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
								    <td  align="right">'.$totalResult->UANG_JAMINAN.'</td>
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
					    <th style="" width="430">'.ucwords($terbilang).'</th>
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
	        //$output_name = "my_dtjk.pdf";
	         $pdf->Output($output_name, 'I');
	        // $path =base_url('uploads/'.$output_name.'');
	        // $pdf->Output($path, 'F');
	}

}
