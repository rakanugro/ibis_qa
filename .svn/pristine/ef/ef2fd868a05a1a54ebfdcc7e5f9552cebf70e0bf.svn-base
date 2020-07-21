<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

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
   $this->load->model('bank_model');
   $this->load->model('container_model');
   $this->load->model('layanan_model');
   $this->load->model('va_expired');
   $this->load->model('va_model');
   $this->load->model('biller_model');
   $this->load->library("Nusoap_lib");
   $this->load->library("table");
   $this->load->library('commonlib');
   $this->load->library('ciqrcode');
   $this->load->helper('MY_language_helper');
   $this->load->helper('MY_currency_helper');
   $this->load->library('MX_Encryption');

   $this->load->library('breadcrumbs');
   require_once(APPPATH.'libraries/mime_type_lib.php');
   require_once(APPPATH.'libraries/htmLawed.php');
   require_once(APPPATH.'libraries/esbConnection.php');

   $this->load->model('auth_model','auth_model');

   if (! $this->session->userdata('is_login') ){
     redirect(ROOT.'main_invoice', 'refresh');
   }

 }

 public function index(){
   print_r("expression");
   die();
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

 public function common_loader_einvoce($data,$views) {
   if (! $this->session->userdata('is_login') ){
     redirect('main_invoice');
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


 public function add_by_proforma(){
   if($this->session->userdata('role_type') != null){
     $data = array();
     $data['services'] = $this->layanan_model->getAllLayanan();

     $this->breadcrumbs->push("Add By Proforma", '/');
     $this->breadcrumbs->unshift('Transaction', '/');
     $data['breadcrumbs'] = $this->breadcrumbs->show();

     $data['title'] = "Add Transaction";

     $role_id =  $this->session->userdata('role_id')	;
     $data['menu_list'] = $this->user_model->get_menuList('j');
     $data['user_role'] = $this->auth_model->get_lastrole($role_id);
     $data['role_child'] = $this->auth_model->get_child_role($role_id);

     $data['layanan'] = $this->auth_model->get_layanan($role_id);
     $data['services'] = $this->layanan_model->getAllLayanan();

     $this->common_loader($data,'pages/va/add_proforma');
   }
 }

 public function search_by_proforma()
 {
   $search_input = trim($_POST['search']);
   $layanan = trim($_POST['layanan']);
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $curl = curl_init();

   $data = array(
     "inquiryRequest" => array(
       'esbHeader' => array(
         'internalId' => '',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => date('Y-m-d H:i:s.u'),
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'layanan' => strtoupper($layanan),
         'trxNumber' => $search_input,
         'customerNumber' => null
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->arInvoiceArray;
   }

   $sequence = 1;
   $datas = array();

   foreach ($arInvoiceArray as $key => $value) {
       $datas[] = array(
         'id' => $sequence,
         "trx_date"  => $value->trxDate,
         "proforma" 	=> $value->trxNumber,
         "customer" 	=> $esbBody->customerName,
         "customer_number" => $esbBody->customerNumber,
         "service"  	=> $value->jenisNota,
         "cabang"   	=> $cabang[0]->INV_UNIT_NAME,
         "amount"   	=> str_replace(',', '', $value->amount),
         "amount_currency" => 'Rp. '. format_rupiah(str_replace(',', '', $value->amount)),
         "payment_code" => $value->paymentCode
       );

       $sequence++;
   }

   echo json_encode($datas);

 }
 public function add_by_customer(){
   if($this->session->userdata('role_type') != null){
     $data = array();
     $data['services'] = $this->layanan_model->getAllLayanan();

     if($this->session->userdata('role_type') == 'Super Admin'){
         $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
         $role_id =  $this->session->userdata('role_id')	;
         $data['user_role'] = $this->auth_model->get_lastrole($role_id);
         $data['role_child'] = $this->auth_model->get_child_role($role_id);

         $this->breadcrumbs->push("Add By Customer", '/');
         $this->breadcrumbs->unshift('Transaction', '/');
         $data['breadcrumbs'] = $this->breadcrumbs->show();

         $data['title']= "Add Transaction";

         $this->common_loader($data,'pages/va/add_by_customer');
     }else if($this->session->userdata('role_type') == 'Admin Unit'){
         $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
         $role_id =  $this->session->userdata('role_id')	;
         $data['user_role'] = $this->auth_model->get_lastrole($role_id);
         $data['role_child'] = $this->auth_model->get_child_role($role_id);

         $this->breadcrumbs->push("Add By Customer", '/');
         $this->breadcrumbs->unshift('Transaction', '/');
         $data['breadcrumbs'] = $this->breadcrumbs->show();

         $data['title']= "Add Transaction";
         $data['layanan'] = $this->auth_model->get_layanan($role_id);

         $this->common_loader($data,'pages/va/add_by_customer');
     } else{
         $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
         $role_id =  $this->session->userdata('role_id')	;
         $data['user_role'] = $this->auth_model->get_lastrole($role_id);
         $data['role_child'] = $this->auth_model->get_child_role($role_id);

         $this->breadcrumbs->push("Add By Customer", '/');
         $this->breadcrumbs->unshift('Transaction', '/');
         $data['breadcrumbs'] = $this->breadcrumbs->show();

         $data['title']= "Add Transaction";
         $data['layanan'] = $this->auth_model->get_layanan($role_id);

         $this->common_loader($data,'pages/va/add_by_customer');
     }

   }
 }

 public function search_by_customer()
 {
     $search_input = trim($_POST['search']);
     $layanan = trim($_POST['layanan']);
     $unit_org = $this->session->userdata('unit_org');
     $unit_implode = json_decode($unit_org, true);
     $unit_branch = $this->session->userdata('unit_id');
     $branch_implode = json_decode($unit_branch, true);
     $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
     $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
     $current_unit = $unit_id[0]->INV_UNIT_ORGID;

     $curl = curl_init();

     $data = array(
       "inquiryRequest" => array(
         'esbHeader' => array(
           'internalId' => '',
           'externalId' => $this->externalID().'-'.uniqid(),
           'timestamp'  => date('Y-m-d H:i:s.u'),
         ),
         'esbBody' => array(
           'orgId' => $current_unit,
           'layanan' => strtoupper($layanan),
           'trxNumber' => null,
           'customerNumber' => $search_input
         )
       )
     );

     curl_setopt_array($curl, array(
       CURLOPT_PORT => ESB_PORT,
       CURLOPT_URL => INQUIRY,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 30,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS => json_encode($data),
       CURLOPT_HTTPHEADER => array(
         "Authorization: ".VA_AUTH_BASIC,
         "Cache-Control: no-cache",
         "Content-Type: application/json"
       ),
     ));

     $response = curl_exec($curl);
     $err = curl_error($curl);

     curl_close($curl);

     if ($err) {
       echo "cURL Error #:" . $err;
     } else {

       $datajson = $response;
       $hasildecode = json_decode($datajson);
       $inquiryResponse = $hasildecode->inquiryResponse;
       $esbBody = $inquiryResponse->esbBody;
       $esbHeader = $inquiryResponse->esbHeader;
       $arInvoiceArray = $esbBody->arInvoiceArray;
     }

     $datas = array();
     $sequence = 1;

     foreach ($arInvoiceArray as $key => $value) {
       if($value->paymentCode) {
         $checkbox = "<input type='checkbox' name='mycheckboxes' value='{$value->trxNumber}' disabled>";
       } else {
         $checkbox = "<input type='checkbox' name='mycheckboxes' value='{$value->trxNumber}'>";
       }
       $datas[] = array(
         'checkbox' => $checkbox,
         "id" => $sequence,
         "trx_date" 	=> $value->trxDate,
         "proforma" 	=> $value->trxNumber,
         "customer" 	=> $esbBody->customerName,
         "service"  	=> $value->jenisNota,
         "cabang"   	=> $cabang[0]->INV_UNIT_NAME,
         "amount"   	=>  str_replace(',', '', $value->amount),
         "amount_currency"   	=>  'Rp. '. format_rupiah(str_replace(',', '', $value->amount)),
         "payment_code" => $value->paymentCode,
         "action"    => '<button class="btn btn-success btn-sm ibtnDel"><i class="fa fa-pencil-square-o"></i></button>'
       );

       $sequence++;
     }

     echo json_encode(array('data' => $datas));
 }

 function rupiah($angka){

   $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
   return $hasil_rupiah;

 }

 public function submit_payment(){
   date_default_timezone_set("Asia/Jakarta");

   // all input post
   $proforma_number = $this->input->post('proforma_number');
   $layanan = $this->input->post('layanan');
   $post_data = $this->input->post('data');

   // all session
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);

   // get branch & biller
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;
   $biller_code = $this->biller_model->getBillerCode($unit_id[0]->INV_UNIT_ID);
   $kode_biller = $biller_code[0]->KODE_BILLER;
   $kode_cabang = $biller_code[0]->KODE_CABANG;

   // set all variables
   $query_string_layanan = array();
   $query_string_proforma = array();
   $existing = array();
   $temp_detail = array();
   $collection_layanan = array();
   $total_amount = 0;
   $current_proforma = array();

   // check code biller
   if(!$biller_code) {
     echo json_encode(array('status' => 'failed', 'msg' => 'Biller Code Cabang '.$unit_branch.' Tidak terdaftar.'));
     exit;
   }

   // check data empty or zero
   if(count($post_data) == 0) {
     echo json_encode(array('status' => 'failed', 'msg' => 'Data kosong'));
     exit;
   }

   if(count($post_data) > 0) {

     $last_customer_number[] = $post_data[0]['customer_number'];
     $last_expired_date = $this->va_expired->getExpired($unit_implode[0],$post_data[0]['layanan']);

     // get nomor va
     $nomor_va = $this->va_model->getVANumber($unit_implode[0], $unit_id[0]->INV_UNIT_ID);

     // check if customer not same
     foreach ($post_data as $row) {
       // check if expired date different
       if(!in_array($row['customer_number'], $last_customer_number)) {
           echo json_encode(array('status' => 'error', 'msg' => 'Gagal, Data yang di checkout beda customer'));
           exit;
       }
       // check if expired date different
       $current_expired_date = $this->va_expired->getExpired($unit_implode[0],$row['layanan']);
       if($last_expired_date[0]['EXPIRED_IN_DAY'] != $current_expired_date[0]['EXPIRED_IN_DAY']) {
           echo json_encode(array('status' => 'error', 'msg' => 'Gagal, Expired date berbeda'));
           exit;
       }
       $total_amount += str_replace(',', '', $row['amount']);
     }

     if($total_amount > 500000000) {
       echo json_encode(array('status' => 'error', 'msg' => 'Gagal, Jumlah tagihan lebih dari Rp.500 Juta.'));
       exit;
     }

     foreach($post_data as $row) {
       $detail[] = (object) array(
         "trxNumber" => $row['proforma'],
         "amount"   	=> str_replace(',', '', $row['amount']),
         "jenisNota" => $row['service'],
         "trxDate" 	=> $row['trx_date'],
         "layanan"   => $row['layanan']
       );
       $current_proforma[] = $row['proforma'];
     }

     if(count($detail) > 0)
     {
         // get nomor va
         $nomor_va = $this->va_model->getVANumber($unit_implode[0], $unit_id[0]->INV_UNIT_ID);
         $customer_number = $post_data[0]['customer_number'];
         $customer_name = $post_data[0]['customer'];
         $expired_date =  $this->va_expired->getExpired($unit_implode[0],$post_data[0]['layanan']);
         $Date = date('Y-m-d');

         $insert_data = array(
           "iudVAKonsolidasiRequest" => array(
             'esbHeader' => array(
               'internalId' => '',
               'externalId' => $this->externalID().'-'.uniqid(),
               'timestamp'  => date('Y-m-d H:i:s.u'),
             ),
             'esbBody' => array(
               "userId" => $user_id,
               "orgId" => $current_unit,
               "billerCode" => $kode_biller,
               "customerNumber" => "{$customer_number}",
               "customerName" => "{$customer_name}",
               "paymentCode" => $nomor_va,
               "totalAmount" => "{$total_amount}",
               "generateDate" => date('Y-m-d H:i:00'),
               "expiredDate" => date('Y-m-d '.$expired_date[0]['EXPIRED_TIME'], strtotime($Date. ' + '.$expired_date[0]['EXPIRED_IN_DAY'].' days')),
               "receiptMethod" => "BANK",
               "currencyCode" => "IDR",
               "operation" => "insert",
               "details" => $detail
             )
           )
         );

         $curl = curl_init();

         curl_setopt_array($curl, array(
           CURLOPT_PORT => ESB_PORT,
           CURLOPT_URL => KONSOLIDASI_VA,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 30,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "POST",
           CURLOPT_POSTFIELDS => json_encode($insert_data),
           CURLOPT_HTTPHEADER => array(
             "Authorization: ".VA_AUTH_BASIC,
             "Cache-Control: no-cache",
             "Content-Type: application/json"
           ),
         ));

         $response = curl_exec($curl);
         $err = curl_error($curl);

         curl_close($curl);

         if ($err) {
           echo "cURL Error #:" . $err;
         } else {

           $datajson = $response;
           $parseResponse = json_decode($datajson);
           $inquiryResponse = $parseResponse->iudVAKonsolidasiResponse;
           $esbBody = $inquiryResponse->esbBody;

           if($esbBody->status == 'S') {
             $remove_cart = $this->va_model->remove_cart_bulk($user_id, $unit_implode[0], $current_proforma);
             echo json_encode(array('status' => 'success', 'msg' => 'Checkout Data Berhasil', 'total' => count($detail) ,'url' => base_url().'index.php/va/transaction/detail_payment_code?payment_code='.$nomor_va.'&customer_number='.$customer_number));
             exit;
           } else {
             echo json_encode(array('status' => 'error', 'msg' => $esbBody->message));
             exit;
           }
         }
     }
   }
 }

 public function detail_payment_code()
 {
   if($this->session->userdata('role_type') == null) {
     redirect(ROOT.'main_invoice', 'refresh');
   }

   $payment_code = $this->input->get('payment_code');
   $customer_number = $this->input->get('customer_number');

   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $user_id = $this->session->userdata('user_id');

   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;
   $current_id = $unit_id[0]->INV_UNIT_ID;

   $this->breadcrumbs->push("Add By Proforma", '/');
   $this->breadcrumbs->unshift('Transaction', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();
   $data['layanan'] = $this->auth_model->get_layanan($role_id);

   $data['title']= "Add Transaction";

   $post_data = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'paymentCode' => $payment_code,
         'customerNumber' => $customer_number
       )
     )
   );

   $curl = curl_init();

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($post_data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $sequence = 1;

   foreach ($arInvoiceArray as $key => $value) {
     $datas[] = array(
       "id" => $sequence,
       "trx_date" 	=> $value->trxDate,
       "proforma" 	=> $value->proforma,
       "service"  	=> $value->jenisNota,
       "amount"   	=> str_replace(',', '', $value->amount),
       "jumlah"    => str_replace(',', '', $value->amount),
       "layanan"   => $value->layanan
     );

     $sequence += 1;
   }

   $data["proforma_detail"] = $datas;
   $data["proforma_header"] = $esbBody;
   $data["cabang"] = $cabang;

   $data["banks"] = $this->bank_model->getBillerBank($current_id);
   $this->common_loader_einvoce($data,'pages/va/detail_payment_code');
 }

 public function list_transaction(){
   $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
   $role_id =  $this->session->userdata('role_id')	;
   $data['user_role'] = $this->auth_model->get_lastrole($role_id);
   $data['role_child'] = $this->auth_model->get_child_role($role_id);

   $this->breadcrumbs->push("List Transaction", '/');
   $this->breadcrumbs->unshift('Transaction', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();
   $data['layanan'] = $this->auth_model->get_layanan($role_id);

   $data['title']= "List Transaction";
   $data['from_date'] = date('m-d-Y');
   $data['to_date'] = date('m-d-Y');
   $this->common_loader($data,'pages/va/list_transaction');
 }

 public function search_transaction()
 {
   $type = trim($_POST['layanan']);
   $from = $this->input->post('from_date');
   $to = $this->input->post('to_date');
   $search_input = $this->input->post('search');

   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;
   $role = $this->session->userdata('role_type');

   $curl = curl_init();

   $data = array(
     "inquiryVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => date('Y-m-d H:i:s.u'),
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'startDate' => $from == '' ? date('Y-m-d') : $from,
         'endDate' => $to == '' ? date('Y-m-d') : $to,
         'filterDate' => $type,
         'filterFields' => ($search_input == '') ? null : $search_input,
         'userId' => null,
         'customerNumber' => null,
         'statusMerchant' => null,
         'bankName' => null,
       ),
       'esbSecurity' => array(
         "orgId"=> $current_unit,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $datas = array();
   $sequence = 1;

   for ($i=0;$i<count($arInvoiceArray);$i++) {

     if($arInvoiceArray[$i]->statusBank ==  '') {
         $action = '<a target="new" href="/index.php/va/transaction/detail_transaction?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a onclick="print_bill(`'.$arInvoiceArray[$i]->customerNumber.'`, `'.$arInvoiceArray[$i]->paymentCode.'`)" class="btn btn-warning btn-sm"><i class="fa fa-files-o"></i></a>';
     }else if($arInvoiceArray[$i]->statusBank == 'S') {
         $action = '<a target="new" href="/index.php/va/transaction/detail_transaction?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a onclick="print_transaction(`'.$arInvoiceArray[$i]->customerNumber.'`, `'.$arInvoiceArray[$i]->paymentCode.'`)" class="btn btn-warning btn-sm"><i class="fa fa-files-o"></i></a>';
     } else {
         $action = '<a target="new" href="/index.php/va/transaction/detail_transaction?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a onclick="print_bill(`'.$arInvoiceArray[$i]->customerNumber.'`, `'.$arInvoiceArray[$i]->paymentCode.'`)" class="btn btn-warning btn-sm"><i class="fa fa-file-text"></i></a>';
     }

     if($role != 'Customer/Self Service') {
         $action .= '<a onclick="cancel_transaction(`'.$arInvoiceArray[$i]->customerNumber.'`, `'.$arInvoiceArray[$i]->paymentCode.'`)" class="btn btn-primary btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>';
     }

     $datas[] = array(
       "payment_code" 	=> $arInvoiceArray[$i]->paymentCode,
       "trx_date" 	=> date('d-m-Y', strtotime($arInvoiceArray[$i]->trxDate)),
       "customer" 	=> $arInvoiceArray[$i]->customerNumber,
       "bank_name" => $arInvoiceArray[$i]->bankName == '-1' ? '' : $arInvoiceArray[$i]->bankName,
       "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
       "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
       "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
       "status_bank" => $arInvoiceArray[$i]->statusBank == 'S' ? 'Success' : $arInvoiceArray[$i]->statusBank,
       "amount" => 'Rp ' . format_rupiah(str_replace(',', '', $arInvoiceArray[$i]->totalAmount)),
       'expired_date' => date('d-m-Y H:i:s', strtotime($arInvoiceArray[$i]->expiredDate)),
       'action' => $action
     );
     $sequence++;
   }

   // '<a target="new" href="http://localhost/ibis_qa/index.php/va/transaction/detail_transaction?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
   //              <a target="new" href="http://localhost/ibis_qa/index.php/va/transaction/print_bill" class="btn btn-warning btn-sm"><i class="fa fa-files-o"></i></a>
   //              <a target="new" href="http://localhost/ibis_qa/index.php/va/transaction/print_transaction" class="btn btn-warning btn-sm"><i class="fa fa-file-text"></i></a>
   //              <a target="new" href="http://localhost/ibis_qa/index.php/va/transaction/edit_transaction?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a>
   //              <a target="new" href="http://localhost/ibis_qa/index.php/va/transaction/detail_transaction?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-primary btn-sm"><i class="fa fa-times"></i></a>'

   echo json_encode(array('data' => $datas));

 }

 public function force_flagging(){
   $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
   $role_id =  $this->session->userdata('role_id')	;
   $data['user_role'] = $this->auth_model->get_lastrole($role_id);
   $data['role_child'] = $this->auth_model->get_child_role($role_id);

   $this->breadcrumbs->push("Force Flagging", '/');
   $this->breadcrumbs->unshift('Transaction', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();
   $data['layanan'] = $this->auth_model->get_layanan($role_id);

   $data['title']= "List Force Flagging";

   $this->common_loader($data,'pages/va/force_flagging');
 }

 public function list_force_flagging()
 {
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $search_input = $this->input->post('search_input');

   $curl = curl_init();

   $data = array(
     "inquiryVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'startDate' => null,
         'endDate' => null,
         'filterDate' => 'transaction_date',
         'filterFields' => ($search_input == '') ? null : $search_input,
         'userId' => null,
         'customerNumber' => null,
         'statusMerchant' => null,
         'bankName' => null,
       ),
       'esbSecurity' => array(
         "orgId"=> $current_unit,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $datas = array();
   $sequence = 1;
   $action = '';

   for ($i=0;$i<count($arInvoiceArray);$i++) {
     if($arInvoiceArray[$i]->statusPaymentGate == '' && $arInvoiceArray[$i]->statusMerchant == '' && $arInvoiceArray[$i]->statusBank == 'S') {
        $action = '<a href="/index.php/va/transaction/detail_force_flagging?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>';
     } else {
        $action = '';
     }

     if($arInvoiceArray[$i]->statusPaymentGate == '' && $arInvoiceArray[$i]->statusMerchant == '' && $arInvoiceArray[$i]->statusBank == 'S') {
       $datas[] = array(
         "id" => $sequence,
         "payment_code" 	=> $arInvoiceArray[$i]->paymentCode,
         "trx_date" 	=> date('d-m-Y', strtotime($arInvoiceArray[$i]->trxDate)),
         "customer" 	=> $arInvoiceArray[$i]->customerNumber,
         "bank_name" => $arInvoiceArray[$i]->bankName == '-1' ? '': $arInvoiceArray[$i]->bankName,
         "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
         "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
         "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
         "status_bank" => $arInvoiceArray[$i]->statusBank == 'S' ? 'Success' :  $arInvoiceArray[$i]->statusBank,
         "amount" => 'Rp ' . format_rupiah(str_replace(',', '', $arInvoiceArray[$i]->totalAmount)),
         'expired_date' => $arInvoiceArray[$i]->expiredDate,
         'action' => $action
       );
       $sequence++;
     }


   }

   echo json_encode(array('data' => $datas));
 }

 public function detail_force_flagging(){
   $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
   $unit_org = $this->session->userdata('unit_org');

   $role_id =  $this->session->userdata('role_id');
   $data['role_child'] = $this->auth_model->get_child_role($role_id);
   $data['layanan'] = $this->auth_model->get_layanan($role_id);

   $this->breadcrumbs->push("Detail Force Flagging", '/');
   $this->breadcrumbs->unshift('Force Flagging', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();

   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $data['title']= "Detail Force Flagging - ". $this->input->get('payment_code');

   $curl = curl_init();

   $request = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $unit_implode[0],
         'paymentCode' => $this->input->get('payment_code'),
         'customerNumber' => $this->input->get('customer_number'),
       ),
       'esbSecurity' => array(
         "orgId"=> $unit_implode[0],
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($request),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceDetail = $esbBody->details;
     $arInvoiceHeader = $esbBody;
   }

   $datas = array();
   $sequence = 1;

   // print_r($arInvoiceHeader);exit;

   if(count($arInvoiceDetail) > 0) {
     for ($i=0;$i<count($arInvoiceDetail);$i++) {
       $datas[] = array(
         "id" => $sequence,
         "payment_code" 	=> $arInvoiceDetail[$i]->paymentCode,
         "trx_date" 	=> date('d-m-Y', strtotime($arInvoiceDetail[$i]->trxDate)),
         "proforma" 	=> $arInvoiceDetail[$i]->proforma,
         "no_invoice" 	=> $arInvoiceDetail[$i]->noInvoice,
         "customer" 	=> $arInvoiceHeader->customerNumber,
         "service" => $arInvoiceDetail[$i]->jenisNota,
         "port" => $arInvoiceHeader->billerName,
         "amount" => str_replace(',', '', $arInvoiceDetail[$i]->amount)
       );
       $sequence++;
     }
   } else {
     redirect('/va/transaction/force_flagging');
   }


   // trx_date proforma no invoice customer service cabang amount

   $data["payment_detail"] = $datas;
   $data["payment_header"] = $arInvoiceHeader;

   $this->common_loader($data,'pages/va/detail_force_flagging');

 }

 public function detail_transaction(){
   $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $unit_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $role_id =  $this->session->userdata('role_id');
   $data['user_role'] = $this->auth_model->get_lastrole($role_id);
   $data['role_child'] = $this->auth_model->get_child_role($role_id);
   $data['layanan'] = $this->auth_model->get_layanan($role_id);

   $this->breadcrumbs->push("Detail Transaction", '/');
   $this->breadcrumbs->unshift('Transaction', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();

   $data['title']= "Detail Transaction - ". $this->input->get('payment_code');

   $curl = curl_init();

   $request = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => date('Y-m-d H:i:s.u'),
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'paymentCode' => $this->input->get('payment_code'),
         'customerNumber' => $this->input->get('customer_number'),
       ),
       'esbSecurity' => array(
         "orgId"=> $current_unit,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($request),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceDetail = $esbBody->details;
     $arInvoiceHeader = $esbBody;
   }

   $datas = array();
   $sequence = 1;

   for ($i=0;$i<count($arInvoiceDetail);$i++) {
     $datas[] = array(
       "id" => $sequence,
       "payment_code" 	=> $arInvoiceDetail[$i]->paymentCode,
       "trx_date" 	=> $arInvoiceDetail[$i]->trxDate,
       "proforma" 	=> $arInvoiceDetail[$i]->proforma,
       "no_invoice" 	=> $arInvoiceDetail[$i]->noInvoice,
       "customer" 	=> $arInvoiceHeader->customerNumber,
       "jenis_nota" => $arInvoiceDetail[$i]->jenisNota,
       "service" => $arInvoiceDetail[$i]->layanan,
       "port" => $arInvoiceHeader->billerName,
       "amount" => str_replace(',', '', $arInvoiceDetail[$i]->amount)
     );
     $sequence++;
   }

   // trx_date proforma no invoice customer service cabang amount

   $data["payment_detail"] = $datas;
   $data["payment_header"] = $arInvoiceHeader;

   $this->common_loader($data,'pages/va/detail_transaction');

 }

 public function edit_transaction(){
   $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $unit_id = $this->biller_model->getBranchId($unit_branch);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $this->breadcrumbs->push("Edit Transaction", '/');
   $this->breadcrumbs->unshift('Transaction', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();

   $data['title']= "Edit Transaction";

   $curl = curl_init();

   $request = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'paymentCode' => $this->input->get('payment_code'),
         'customerNumber' => $this->input->get('customer_number'),
       ),
       'esbSecurity' => array(
         "orgId"=> $current_unit,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($request),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceDetail = $esbBody->details;
     $arInvoiceHeader = $esbBody;
   }

   $datas = array();
   $sequence = 1;

   // print_r($arInvoiceHeader);exit;

   for ($i=0;$i<count($arInvoiceDetail);$i++) {
     $datas[] = array(
       "id" => $sequence,
       "payment_code" 	=> $arInvoiceDetail[$i]->paymentCode,
       "trx_date" 	=> $arInvoiceDetail[$i]->trxDate,
       "proforma" 	=> $arInvoiceDetail[$i]->proforma,
       "no_invoice" 	=> $arInvoiceDetail[$i]->noInvoice,
       "customer" 	=> $arInvoiceHeader->customerNumber,
       "service" => $arInvoiceDetail[$i]->jenisNota,
       "port" => $arInvoiceHeader->billerName,
       "amount" => str_replace(',', '', $arInvoiceDetail[$i]->amount)
     );
     $sequence++;
   }

   // trx_date proforma no invoice customer service cabang amount

   $data["payment_detail"] = $datas;
   $data["payment_header"] = $arInvoiceHeader;

   $this->common_loader($data, 'pages/va/edit_transaction');
   // $this->load->view('pages/va/edit_transaction', $data);
 }

 public function search_edit_transaction(){

       $req_id = trim($_POST['search']);
       $this->table->set_heading(
         "<th>Trx Date</th>",
         "<th>Proforma</th>",
         "<th>Customer</th>",
         "<th>Service</th>",
         "<th>Cabang</th>",
         "<th>Amount</th>",
         "<th>Action</th>"
       );

       $start_rownum="";
       $end_rownum="";

       $i = 1;
       $data = array();

       $datas = array(
         "id" => '1',
         "trx_date" 	=> '29-Mar-19',
         "proforma"  =>	'proforma',
         "customer"  =>	'30-Mar-19',
         "service"   =>	'Mandiri',
         "cabang"   	=>	'Success',
         "amount"   	=>	'Success'
       );

       array_push($data, $datas);


       foreach ($data as $key => $value) {

         $btn = '';
         $btn .= '<a class="btn btn-default" href="'.ROOT.'va/transaction/delete_transaction/1111">delete</a>';
         $this->table->add_row(
                     $value["trx_date"],
                     $value["proforma"],
                     $value["customer"],
                     $value["service"],
                     $value["cabang"],
                     $value["amount"],
                     $btn
         );

         $i++;
       }


       $this->load->view('pages/va/search_edit_transaction',$data);
 }

 public function checkout_transaction_customer(){
   if($this->session->userdata('role_type') != null){
     if($this->session->userdata('role_type') == 'Super Admin'){

       $this->breadcrumbs->push("Add By Proforma", '/');
       $this->breadcrumbs->unshift('Transaction', '/');
       $data['breadcrumbs'] = $this->breadcrumbs->show();

       $data['title']= "Add Transaction";

       $datanya = array();
       $datas = array(
         "id" => '1',
         "txt_date" 	=> '29-Mar-19',
         "proforma" 	=> '9589299282822888888881',
         "customer" 	=> 'GLOBAL SARANA KENCANA',
         "service"  	=> 'PETIKEMAS',
         "cabang"   	=> 'Panjang',
         "amount"   	=>	1200000,
         "paycode"   =>	'paycode'
       );

       // array_push($datanya, $datas);
       $data["payment_detail"] = $datanya;
       $this->common_loader_einvoce($data,'pages/va/detail_payment_code');
     }
   } else{
     $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

     $this->breadcrumbs->push("Add By Proforma", '/');
     $this->breadcrumbs->unshift('Transaction', '/');
     $data['breadcrumbs'] = $this->breadcrumbs->show();

     $data['title']= "Add Transaction";

     $datanya = array();
     $datas = array(
       "id" => '1',
       "txt_date" 	=> '29-Mar-19',
       "proforma" 	=> '9589299282822888888881',
       "customer" 	=> 'GLOBAL SARANA KENCANA',
       "service"  	=> 'PETIKEMAS',
       "cabang"   	=> 'Panjang',
       "amount"   	=>	1200000,
       "paycode"   =>	'paycode'
     );

     array_push($datanya, $datas);
     $data["payment_detail"] = $datanya;

     $this->common_loader($data,'pages/va/detail_payment_code');
   }


 }

 public function download_transaction()
 {
   $type = $this->input->get('layanan');
   $from = $this->input->get('from_date');
   $to   = $this->input->get('to_date');

   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $curl = curl_init();

   $collections = array(
     "inquiryVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $unit_implode[0],
         'startDate' => $from,
         'endDate' => $to,
         'filterDate' => 'transaction_date',
         'filterFields' => null,
         'userId' => null,
         'customerNumber' => null,
         'statusMerchant' => null,
         'bankName' => null,
       ),
       'esbSecurity' => array(
         "orgId"=> $current_unit,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($collections),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $datas = array();
   $sequence = 1;

   for ($i=0;$i<count($arInvoiceArray);$i++) {
     $datas[] = array(
       "id" => $sequence,
       "payment_code" 	=> $arInvoiceArray[$i]->paymentCode,
       "trx_date" 	=> $arInvoiceArray[$i]->trxDate,
       "customer" 	=> $arInvoiceArray[$i]->customerNumber,
       "bank_name" => $arInvoiceArray[$i]->bankName,
       "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
       "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
       "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
       "amount" => str_replace(',', '', $arInvoiceArray[$i]->totalAmount),
       'expired_date' => $arInvoiceArray[$i]->expiredDate
     );
     $sequence++;
   }

   $data['list'] = $datas;
   $data['filename'] = 'list_transaction_'.date('dmY', strtotime($from)).'-'.date('dmY',strtotime($to));

   $this->load->view('pages/va/list_transaction_excel', $data);
 }

 public function remove_transaction()
 {
   $user_id = $this->session->userdata('user_id');
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $biller_code = $this->biller_model->getBillerCode($unit_id[0]->INV_UNIT_ID);
   $kode_biller = $biller_code[0]->KODE_BILLER;
   $kode_cabang = $biller_code[0]->KODE_CABANG;

   $customerNumber   = $this->input->post('customer_number');
   $paymentCode    = $this->input->post('payment_code');

   $curl = curl_init();

   $data = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $unit_org,
         'paymentCode' => $paymentCode,
         'customerNumber' => $customerNumber
       ),
       'esbSecurity' => array(
         "orgId"=> $unit_org,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->arInvoiceArray;
   }


   if (count($arInvoiceArray) > 0) {
     $billerCode = $esbBody->billerName;
     $customerName = $esbBody->customerName;
     $totalAmount = $esbBody->totalAmount;
     $generateDate = $esbBody->trxDate;
     $expiredDate = $esbBody->expiredDate;
   }

   $curl = curl_init();

   $data = array(
     "iudVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
          "userId" => $user_id,
          "orgId" => $unit_org,
          "billerCode" => $billerCode,
          "customerNumber" => $customerNumber,
          "customerName" => $customerName,
          "paymentCode" => $paymentCode,
          "totalAmount" => $totalAmount,
          "generateDate" => date("Y-m-d H:i:s", strtotime($generateDate)),
          "expiredDate" => date("Y-m-d H:i:s", strtotime($expiredDate)),
          "receiptMethod" => "BANK",
          "currencyCode" => "IDR",
          "operation" => "update"
       ),
       'esbSecurity' => array(
         "orgId"=>"84",
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->iudVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->message;
   }

   if(count($arInvoiceArray) > 0) {
     echo json_encode(array('status' => 'success'));
   } else {
     echo json_encode(array('status' => 'error'));
   }
 }

 public function download_force_flagging()
 {
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $unit_id = $this->biller_model->getBranchId($unit_branch);
   $cabang = $this->biller_model->getDataBranch($unit_org);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $proforma_number = $this->input->get('proforma');

   $curl = curl_init();

   $collections = array(
     "inquiryVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => date('Y-m-d H:i:s.u'),
       ),
       'esbBody' => array(
         'orgId' => $unit_org,
         'startDate' => null,
         'endDate' => null,
         'filterDate' => 'transaction_date',
         'filterFields' => $proforma_number == '' ? null : $proforma_number,
         'userId' => null,
         'customerNumber' => null,
         'statusMerchant' => "F",
         'bankName' => null,
       ),
       'esbSecurity' => array(
         "orgId"=> $unit_org,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($collections),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $datas = array();
   $sequence = 1;

   for ($i=0;$i<count($arInvoiceArray);$i++) {
     $datas[] = array(
       "id" => $sequence,
       "payment_code" 	=> $arInvoiceArray[$i]->paymentCode,
       "trx_date" 	=> $arInvoiceArray[$i]->trxDate,
       "customer" 	=> $arInvoiceArray[$i]->customerNumber,
       "bank_name" => $arInvoiceArray[$i]->bankName,
       "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
       "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
       "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
       "status_bank" => $arInvoiceArray[$i]->statusMerchant,
       "amount" => str_replace(',', '', $arInvoiceArray[$i]->totalAmount),
       'expired_date' => $arInvoiceArray[$i]->expiredDate,
       'action' => '<a href="/index.php/va/transaction/detail_force_flagging?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>'
     );
     $sequence++;
   }

   $data['force_flagging'] = $datas;

   $this->load->view('pages/va/force_flagging_excel', $data);
 }

 public function add_to_cart()
 {
   $data = $this->input->post('data');
   $layanan = $this->input->post('layanan');

   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $success = array();
   $failed = array();

   $datas = array();

   $res = array();

   if(count($data) > 0)
   {
     foreach($data as $value)
     {
       $curl = curl_init();

       $data = array(
         "inquiryRequest" => array(
           'esbHeader' => array(
             'internalId' => '',
             'externalId' => $this->externalID().'-'.uniqid(),
             'timestamp'  => date('Y-m-d H:i:s.u'),
           ),
           'esbBody' => array(
             'orgId' => $current_unit,
             'layanan' => strtoupper($layanan),
             'trxNumber' => $value,
             'customerNumber' => null
           )
         )
       );

       curl_setopt_array($curl, array(
         CURLOPT_PORT => ESB_PORT,
         CURLOPT_URL => INQUIRY,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_POSTFIELDS => json_encode($data),
         CURLOPT_HTTPHEADER => array(
           "Authorization: ".VA_AUTH_BASIC,
           "Cache-Control: no-cache",
           "Content-Type: application/json"
         ),
       ));

       $response = curl_exec($curl);
       $err = curl_error($curl);

       curl_close($curl);

       if ($err) {
         echo "cURL Error #:" . $err;
       } else {

         $datajson = $response;
         $hasildecode = json_decode($datajson);
         $inquiryResponse = $hasildecode->inquiryResponse;
         $esbBody = $inquiryResponse->esbBody;
         $esbHeader = $inquiryResponse->esbHeader;
         $arInvoiceArray = $esbBody->arInvoiceArray;

         $res[] = $response;
       }

       foreach ($arInvoiceArray as $key => $value) {
           $checkout = $this->va_model->checkout(array(
             'TRX_NUMBER' => $value->trxNumber,
             'ORG_ID' => $current_unit,
             'LAYANAN' => $value->jenisNota,
             'CUSTOMER_NAME' => $esbBody->customerName,
             'CUSTOMER_NUMBER' => $esbBody->customerNumber,
             'AMOUNT' => str_replace(',', '', $value->amount),
             'TRX_DATE' => $value->trxDate,
             'USER_ID' => $user_id,
             'CABANG'  => $unit_id[0]->INV_UNIT_NAME,
             'SERVICES' => $layanan
           ));

           if($checkout['STATUS'] == 'SUCCESS') {
             $success[] = $checkout['TRX_NUMBER'];
           } else {
             $failed[] = $checkout['TRX_NUMBER'];
           }
       }
     }

     echo json_encode(array('success' => count($success), 'failed' => count($failed)));
   }
 }

 public function cart()
 {
   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $role_id =  $this->session->userdata('role_id');
   $data['menu_list'] = $this->user_model->get_menuList('j');
   $data['user_role'] = $this->auth_model->get_lastrole($role_id);
   $data['role_child'] = $this->auth_model->get_child_role($role_id);
   $data['layanan'] = $this->auth_model->get_layanan($role_id);

   $this->breadcrumbs->push("All List", '/');
   $this->breadcrumbs->unshift('Cart', '/');
   $data['breadcrumbs'] = $this->breadcrumbs->show();

   $data['title'] = "List Cart";
   $data['lists'] = $this->va_model->all_cart($user_id, $current_unit);

   $this->common_loader($data,'pages/va/cart');
 }

 public function search_by_cart()
 {
   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $result = $this->va_model->all_cart($user_id, $current_unit);

   $data = array();

   if(count($result) > 0) {
     foreach($result as $key) {
       $data[] = array(
         'proforma' => $key['TRX_NUMBER'],
         'service' => $key['LAYANAN'],
         'customer_name' => $key['CUSTOMER_NAME'],
         'customer_number' => $key['CUSTOMER_NUMBER'],
         'amount' => $key['AMOUNT'],
         'amount_format' => 'Rp ' . format_rupiah(str_replace(',', '', $key['AMOUNT'])),
         'trx_date' => $key['TRX_DATE'],
         'cabang' => $key['CABANG'],
         'action' => '<button class="btn btn-primary btn-sm" onclick="deleteCart(`'.trim($key['TRX_NUMBER']).'`)"><i class="fa fa-times"></i></button>'
       );
     }
   }

   echo json_encode(array('data' => $data));
 }

 public function delete_cart()
 {
   $data = $this->input->post('data');

   $user_id = $this->session->userdata('user_id');
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   //
   $result = $this->va_model->remove_cart($user_id, $current_unit, $data);
   //
   echo json_decode(array('status' => 'DELETE_CART', 'code' => '200'));
 }

 public function checkout_cart()
 {
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $user_id = $this->session->userdata('user_id');
   $user_implode = json_decode($user_id, true);
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   // $cabang = $this->biller_model->getDataBranch($unit_org);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;
   $biller_code = $this->biller_model->getBillerCode($unit_id[0]->INV_UNIT_ID);
   $kode_biller = $biller_code[0]->KODE_BILLER;
   $kode_cabang = $biller_code[0]->KODE_CABANG;

   $result = $this->va_model->all_cart($user_id, $current_unit);

   // check code biller
   if(!$biller_code) {
     echo json_encode(array('status' => 'failed', 'msg' => 'Biller Code Cabang '.$unit_branch.' Tidak terdaftar.'));
     exit;
   }

   // check data empty or zero
   if(count($result) == 0) {
     echo json_encode(array('status' => 'failed', 'msg' => 'Data kosong'));
     exit;
   }

   $berhasil = array();
   $data = array();
   $current_proforma = array();
   $temp_detail = array();
   $last_customer_number = array();
   $total_amount = 0;
   $last_customer_number = array();
   $detail = array();

   if(count($result) > 0) {

     $last_customer_number[] = $result[0]['CUSTOMER_NUMBER'];
     $last_expired_date = $this->va_expired->getExpired($unit_implode[0],$result[0]['SERVICES']);

     // get nomor va
     $nomor_va = $this->va_model->getVANumber($unit_implode[0], $unit_id[0]->INV_UNIT_ID);

     // check if customer not same
     foreach ($result as $row) {
       // check if expired date different
       if(!in_array($row['CUSTOMER_NUMBER'], $last_customer_number)) {
           echo json_encode(array('status' => 'error', 'msg' => 'Gagal, Data yang di checkout beda customer'));
           exit;
       }
       // check if expired date different
       $current_expired_date = $this->va_expired->getExpired($unit_implode[0],$row['SERVICES']);
       if($last_expired_date[0]['EXPIRED_IN_DAY'] != $current_expired_date[0]['EXPIRED_IN_DAY']) {
           echo json_encode(array('status' => 'error', 'msg' => 'Gagal, Expired date berbeda'));
           exit;
       }
       $total_amount += str_replace(',', '', $row['AMOUNT']);
     }
   }

   if($total_amount > 500000000) {
     echo json_encode(array('status' => 'error', 'msg' => 'Gagal, Jumlah tagihan lebih dari Rp.500 Juta.'));
     exit;
   }

   foreach($result as $row) {
     $detail[] = (object) array(
       "trxNumber" => $row['TRX_NUMBER'],
       "amount"   	=> str_replace(',', '', $row['AMOUNT']),
       "jenisNota" => $row['LAYANAN'],
       "trxDate" 	=> $row['TRX_DATE'],
       "layanan"   => $row['SERVICES']
     );
     $current_proforma[] = $row['TRX_NUMBER'];
   }

   if(count($detail) > 0) {
     // get nomor va
     $nomor_va = $this->va_model->getVANumber($unit_implode[0], $unit_id[0]->INV_UNIT_ID);
     $customer_number = $result[0]['CUSTOMER_NUMBER'];
     $customer_name = $result[0]['CUSTOMER_NAME'];
     $expired_date =  $this->va_expired->getExpired($unit_implode[0], $result[0]['SERVICES']);
     $Date = date('Y-m-d');

     $insert_data = array(
         "iudVAKonsolidasiRequest" => array(
           'esbHeader' => array(
             'internalId' => '',
             'externalId' => $this->externalID().'-'.uniqid(),
             'timestamp'  => date('Y-m-d H:i:s.u'),
           ),
           'esbBody' => array(
             "userId" => $user_id,
             "orgId" => $current_unit,
             "billerCode" => $kode_biller,
             "customerNumber" => "{$customer_number}",
             "customerName" => "{$customer_name}",
             "paymentCode" => $nomor_va,
             "totalAmount" => "{$total_amount}",
             "generateDate" => date('Y-m-d H:i:00'),
             "expiredDate" => date('Y-m-d '.$expired_date[0]['EXPIRED_TIME'], strtotime($Date. ' + '.$expired_date[0]['EXPIRED_IN_DAY'].' days')),
             "receiptMethod" => "BANK",
             "currencyCode" => "IDR",
             "operation" => "insert",
             "details" => $detail
           )
         )
       );

     $curl = curl_init();

     curl_setopt_array($curl, array(
       CURLOPT_PORT => ESB_PORT,
       CURLOPT_URL => KONSOLIDASI_VA,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 30,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS => json_encode($insert_data),
       CURLOPT_HTTPHEADER => array(
         "Authorization: ".VA_AUTH_BASIC,
         "Cache-Control: no-cache",
         "Content-Type: application/json"
       ),
     ));

     $response = curl_exec($curl);
     $err = curl_error($curl);

     curl_close($curl);

     if ($err) {
       echo "cURL Error #:" . $err;
     } else {

       $datajson = $response;
       $hasildecode = json_decode($datajson);
       $inquiryResponse = $hasildecode->iudVAKonsolidasiResponse;
       $esbBody = $inquiryResponse->esbBody;
       $esbHeader = $inquiryResponse->esbHeader;
       $arInvoiceArray = $esbBody->details;

       if($esbBody->status == 'S') {
         $remove_cart = $this->va_model->remove_cart_bulk($user_id, $unit_implode[0], $current_proforma);
         echo json_encode(array('status' => 'success', 'msg' => 'Checkout Data Berhasil', 'total' => count($detail) ,'url' => base_url().'index.php/va/transaction/detail_payment_code?payment_code='.$nomor_va.'&customer_number='.$customer_number));
         exit;
       } else {
         echo json_encode(array('status' => 'error', 'msg' => $esbBody->message));
         exit;
       }
     }
   }
 }

 public function print_bill()
 {
     $this->common_loader($data,'pages/va/print_bill');
 }
 //
 public function print_transaction()
 {
     $this->common_loader($data,'pages/va/print_transaction');
 }

 public function get_print_bill()
 {
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);

   $cabang = $this->biller_model->getDataBranch($unit_id[0]->INV_UNIT_ORGID);
   $current_id = $unit_id[0]->INV_UNIT_ID;
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $payment_code = $this->input->post('payment_code');
   $customer_number = $this->input->post('customer_number');

   $post_data = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'paymentCode' => $payment_code,
         'customerNumber' => $customer_number
       )
     )
   );

   $curl = curl_init();

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($post_data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);


   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {
     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   // print_r($arInvoiceArray);exit;

   $sequence = 1;
   $datas = array();
   $total=0;

   foreach ($arInvoiceArray as $key => $value) {
     $datas[] = array(
       "id" => $sequence,
       "trx_date" 	=> date('d-m-Y', strtotime($value->trxDate)),
       "proforma" 	=> $value->proforma,
       "service"  	=> $value->jenisNota,
       "amount"   	=> str_replace(',', '', $value->amount),
       "amount_format" => 'Rp ' . format_rupiah(str_replace(',', '', $value->amount)),
       "layanan"   => $value->layanan,
       "biller_name" => $esbBody->billerName,
       "customer_name" => $esbBody->customerName,
       "customer_number" => $esbBody->customerNumber,
       "expired_date" => date('d-m-Y H:i:s', strtotime($esbBody->expiredDate)),
       "total_amount" => $esbBody->totalAmount,
       "payment_code" => $payment_code,
     );

     $total += str_replace(',', '', $value->amount);

     $sequence += 1;
   }

   $banks = $this->bank_model->getBillerBank($current_id);
   $list_bank = array();

   foreach($banks as $row) {
     $list_banks[] = array('bank' => $row->NAMA_BANK, 'payment_code' => $row->PAYMENT_CODE);
   }

   echo json_encode(array('status' => 'success', 'msg' => 'Data ditemukan', 'result' => $datas, 'banks' => $list_banks, 'total' => format_rupiah(str_replace(',', '', $total))));
 }

 public function get_print_payment()
 {
   $unit_branch = $this->session->userdata('unit_id');
   $branch_implode = json_decode($unit_branch, true);
   $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
   $cabang = $this->biller_model->getDataBranch($unit_id[0]->INV_UNIT_ORGID);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $payment_code = $this->input->post('payment_code');
   $customer_number = $this->input->post('customer_number');

   $post_data = array(
     "inquiryDetailVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'paymentCode' => $payment_code,
         'customerNumber' => $customer_number
       )
     )
   );

   $curl = curl_init();

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_DETAIL_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($post_data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {
     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryDetailVAResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $sequence = 1;

   $datas = array(
     "id" => $sequence,
     "paid_date" 	=> $esbBody->paymentDate,
     "amount"  => 'Rp ' . format_rupiah(str_replace(',', '', $value->totalAmount)),
     "biller_name" => $esbBody->billerName,
     "customer_name" => $esbBody->customerName,
     "customer_number" => $esbBody->customerNumber,
     "payment_code" => $payment_code,
     "payment_gateway" => $esbBody->statusPaymentGate,
     "merchant" => $esbBody->statusMerchant,
     "bank" => $esbBody->bankName,
     "refnum" => $esbBody->refNum
   );

   echo json_encode(array('status' => 'success', 'msg' => 'Data ditemukan', 'result' => $datas));
 }

 public function search_recon()
 {
   $unit_org = $this->session->userdata('unit_org');
   $unit_implode = json_decode($unit_org, true);
   $unit_branch = $this->session->userdata('unit_id');
   $unit_id = $this->biller_model->getBranchId($unit_branch);
   $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
   $current_unit = $unit_id[0]->INV_UNIT_ORGID;

   $curl = curl_init();

   $data = array(
     "inquiryVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
         'orgId' => $current_unit,
         'startDate' => null,
         'endDate' => null,
         'filterDate' => 'transaction_date',
         'filterFields' => null,
         'userId' => null,
         'customerNumber' => null,
         'statusMerchant' => "F",
         'bankName' => null,
       ),
       'esbSecurity' => array(
         "orgId"=> $current_unit,
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => INQUIRY_KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
     echo "cURL Error #:" . $err;
   } else {

     $datajson = $response;
     $hasildecode = json_decode($datajson);
     $inquiryResponse = $hasildecode->inquiryVAKonsolidasiResponse;
     $esbBody = $inquiryResponse->esbBody;
     $esbHeader = $inquiryResponse->esbHeader;
     $arInvoiceArray = $esbBody->details;
   }

   $datas = array();
   $sequence = 1;

   for ($i=0;$i<count($arInvoiceArray);$i++) {
     $datas[] = array(
       "id" => $sequence,
       "payment_code" 	=> $arInvoiceArray[$i]->paymentCode,
       "trx_date" 	=> $arInvoiceArray[$i]->trxDate,
       "customer" 	=> $arInvoiceArray[$i]->customerNumber,
       "bank_name" => $arInvoiceArray[$i]->bankName,
       "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
       "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
       "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
       "status_bank" => $arInvoiceArray[$i]->statusMerchant,
       "amount" => str_replace(',', '', $arInvoiceArray[$i]->totalAmount),
       'expired_date' => $arInvoiceArray[$i]->expiredDate,
       'action' => '<a href="/index.php/va/transaction/detail_force_flagging?customer_number='.$arInvoiceArray[$i]->customerNumber.'&payment_code='.$arInvoiceArray[$i]->paymentCode.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>'
     );
     $sequence++;
   }

   echo json_encode(array('data' => $datas));
 }

 public function update_transaction()
 {
   $billerCode = $this->input->post('biller_code');
   $customerNumber = $this->input->post('customer_number');
   $customerName = $this->input->post('customer_name');
   $paymentCode = $this->input->post('payment_code');
   $expiredDate = $this->input->post('expired_date');
   $totalAmount = $this->input->post('total_amount');
   $details     = $this->input->post('details');

   $curl = curl_init();

   $data = array(
     "iudVAKonsolidasiRequest" => array(
       'esbHeader' => array(
         'internalId' => '123',
         'externalId' => $this->externalID().'-'.uniqid(),
         'timestamp'  => '2019-10-05 07:40:31.834',
       ),
       'esbBody' => array(
          "userId" =>"189",
          "orgId" => "85",
          "billerCode" => $billerCode,
          "customerNumber" => $customerNumber,
          "customerName" => $customerName,
          "paymentCode" => $paymentCode,
          "totalAmount" => "$totalAmount",
          "generateDate"=> "",
          "expiredDate"=> $expiredDate,
          "receiptMethod"=>"BANK",
          "currencyCode" => 'IDR',
          "operation" => "update",
          "details" => $details
       ),
       'esbSecurity' => array(
         "orgId"=>"85",
         "batchSourceId"=>"",
         "lastUpdateLogin"=>"",
         "userId"=>"",
         "respId"=>"",
         "ledgerId"=>"",
         "respApplId"=>"",
         "batchSourceName"=>""
       )
     )
   );

   curl_setopt_array($curl, array(
     CURLOPT_PORT => ESB_PORT,
     CURLOPT_URL => KONSOLIDASI_VA,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => json_encode($data),
     CURLOPT_HTTPHEADER => array(
       "Authorization: ".VA_AUTH_BASIC,
       "Cache-Control: no-cache",
       "Content-Type: application/json"
     ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   // echo json_encode($esbBody);
 }

 public function flagging_payment()
 {
   $no_va = $this->input->post('payment_code');

   if($no_va == '') {
     echo json_encode(array('status' => 'error', 'code' => '503'));
   }

   $curl = curl_init();

   curl_setopt_array($curl, array(
      CURLOPT_PORT => TIBCO_PORT,
      CURLOPT_URL => TIBCO_FORCE_FLAGGING,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n\t\"data\": {\n\t\t\"paymentCode\": \"{$no_va}\"\n\t}\n}",
      CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Accept-Encoding: gzip, deflate",
        "Content-Type: application/json",
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      if(strstr($response, 'Already paid')) {
         echo json_encode(array('status' => 'error', 'code' => '201'));
      } else if(strstr($response, 'java.')) {
         echo json_encode(array('status' => 'error', 'code' => '500'));
      } else if(strstr($response, '-99') && strlen($response) == 3) {
         echo json_encode(array('status' => 'error', 'code' => '501'));
      } else if(strstr($response, '1') && strlen($response) == 1) {
         echo json_encode(array('status' => 'success', 'code' => '200'));
      } else if(strstr($response, 'Not yet paid')) {
         echo json_encode(array('status' => 'error', 'code' => '501'));
      } else {

      }
    }
  }

 public function externalID()
 {
    return strtotime(date('d-m-Y H:i:s'));
 }

}
