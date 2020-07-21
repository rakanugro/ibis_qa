<?php

use Faker\Provider\DateTime;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reconciliation extends CI_Controller
{

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
    $this->load->model('layanan_model');
    $this->load->model('biller_model');
    $this->load->library("nusoap_lib");
    $this->load->library("table");
    $this->load->library('commonlib');
    $this->load->library('ciqrcode');
    $this->load->helper('MY_language_helper');
    $this->load->helper('MY_currency_helper');
    $this->load->library('MX_Encryption');

    $this->load->library('breadcrumbs');
    require_once(APPPATH . 'libraries/mime_type_lib.php');
    require_once(APPPATH . 'libraries/htmLawed.php');
    require_once(APPPATH . 'libraries/esbConnection.php');

    $this->load->model('auth_model', 'auth_model');
  }

  public function common_loader($data, $views)
  {
    $this->load->view('templates/header', $data);
    $this->load->view('templates/top_bar', $data);
    $this->load->view('templates/menu_side', $data);
    $this->load->view('templates/top-1-breadcrumb', $data);
    $this->load->view('templates/top-2-title-nosearch', $data);
    $this->load->view($views, $data);
    $this->load->view('templates/footer', $data);
  }

  public function daily_summary_recon()
  {
    if ($this->session->userdata('role_type') != null) {

      $data = array();
      $data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
      $role_id =  $this->session->userdata('role_id');
      $data['user_role'] = $this->auth_model->get_lastrole($role_id);
      $data['role_child'] = $this->auth_model->get_child_role($role_id);
      $data['services'] = $this->layanan_model->getAllLayanan();
      $data['menu_list'] = $this->user_model->get_menuList('j');
      $data['layanan'] = $this->auth_model->get_layanan($role_id);

      $this->breadcrumbs->push("Daily Summary Report", '/');
      $this->breadcrumbs->unshift('Reporting VA', '/');
      $data['breadcrumbs'] = $this->breadcrumbs->show();

      $data['title'] = "Daily Summary Report";
      $data['from_date'] = date('Y-m-d');
      $data['to_date'] = date('Y-m-d');

      $this->common_loader($data, 'pages/va/daily_summary_reconciliation');
    }
  }

  public function transaction_recon()
  {
    if ($this->session->userdata('role_type') != null) {

      $data = array();
      $data['services'] = $this->layanan_model->getAllLayanan();

      $data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
      $role_id =  $this->session->userdata('role_id');
      $data['user_role'] = $this->auth_model->get_lastrole($role_id);
      $data['role_child'] = $this->auth_model->get_child_role($role_id);
      $data['layanan'] = $this->auth_model->get_layanan($role_id);

      $this->breadcrumbs->push("Transaction Report", '/');
      $this->breadcrumbs->unshift('Reporting VA', '/');
      $data['breadcrumbs'] = $this->breadcrumbs->show();

      $data['title'] = "Transaction Report";
      $data['from_date'] = date('Y-m-d');
      $data['to_date'] = date('Y-m-d');


      $this->common_loader($data, 'pages/va/transaction_recon');
    }
  }

  public function search_total_reconciliation()
  {


    $jenis_date = $this->input->post('jenis_date');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $search_input = $this->input->post('search');

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;

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
          'startDate' => $from_date == '' ? date('d-m-Y') : $from_date,
          'endDate' => $to_date == '' ? date('d-m-Y') : $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => null,
        ),
        'esbSecurity' => array(
          "orgId" => $unit_org,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
        )
      )
    );
    // print_r($data);
    //exit;

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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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

    $sequence = 1;

    $collections = array();
    $array_data = array();

    foreach ($arInvoiceArray as $result) {
      // $totalTrx += $result->totalAmount;
      $jumlah += 1;
      $collections[$result->bankName . '_quantity'] += 1;
      $collections[$result->bankName . '_amount'] += $result->totalAmount;
      if ($result->statusMerchant === '') {
        $result_failed += 1;
      } elseif ($result->statusMerchant === 'Failed') {
        $result_failed += 1;
      } else {
        $result_success += 1;
        $totalTrx += $result->totalAmount;
      }
    }
    $dari = $from_date == '' ? date('Y-m-d') : $from_date;
    $sampai = $to_date == '' ? date('Y-m-d') : $to_date;
    // print_r($sampai);
    // exit;

    $array_data[] = array(
      'id' => $sequence,
      'trx_date' =>   $dari . '-' . $sampai,
      'total_trx' => 'Rp ' . format_rupiah($totalTrx),
      'jumlah' => $jumlah,
      'bni_qty' => $collections['BNI_quantity'],
      'bni_amount' => 'Rp ' . format_rupiah($collections['BNI_amount']),
      'bri_qty' => $collections['BRI_quantity'],
      'bri_amount' => 'Rp ' . format_rupiah($collections['BRI_amount']),
      'mandiri_qty' => $collections['MANDIRI_quantity'],
      'mandiri_amount' => 'Rp ' . format_rupiah($collections['MANDIRI_amount']),
      'receipt' => $result_success,
      'receipt_null' => $result_failed
    );
    // print_r($array_data);
    //exit;

    $sequence++;


    echo json_encode(array('data' => $array_data));
    exit;
  }
  public function search_reconciliation()
  {

    $jenis_date = $this->input->post('jenis_date');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $bank = strtoupper($this->input->post('bank'));

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;


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
          'startDate' => $from_date == '' ? date('Y-m-d') : $from_date,
          'endDate' => $to_date == '' ? date('Y-m-d') : $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => $bank,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
        )
      )
    );
    // print_r($data);
    // exit;
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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


    $sequence = 1;
    $collections = array();
    $array_datas = array();

    foreach ($arInvoiceArray as $result) {

      $collections[date('d-m-Y', strtotime($result->trxDate))]['jumlah'] += 1;
      $collections[date('d-m-Y', strtotime($result->trxDate))][$result->bankName . '_quantity'] += 1;
      $collections[date('d-m-Y', strtotime($result->trxDate))][$result->bankName . '_amount'] += $result->totalAmount;
      if ($result->statusMerchant === '') {
        $collections[date('d-m-Y', strtotime($result->trxDate))]['result_failed'] += 1;
      } elseif ($result->statusMerchant === 'Failed') {
        $collections[date('d-m-Y', strtotime($result->trxDate))]['result_failed'] += 1;
      } else {
        $collections[date('d-m-Y', strtotime($result->trxDate))]['result_success'] += 1;
        $collections[date('d-m-Y', strtotime($result->trxDate))]['totalTrx'] += $result->totalAmount;
      }
    }

    foreach ($collections as $row => $value) {
      $action = '<a target="new" href="/index.php/va/reconciliation/getDetailDailySummaryRecon?start_date=' . date('Y-m-d', strtotime($row)) . '&end_date=' . date('Y-m-d', strtotime($row)) . '" class="btn">' . $value['jumlah'] . '</a>';
      $array_datas[] = array(
        'id' => $sequence,
        'trx_date' => date('d-m-Y', strtotime($row)),
        'total_trx' => 'Rp ' . format_rupiah($value['totalTrx']),
        'jumlah' => $action,
        'bni_qty' => $value['BNI_quantity'],
        'bni_amount' => 'Rp ' . format_rupiah($value['BNI_amount']),
        'bri_qty' => $value['BRI_quantity'],
        'bri_amount' => 'Rp ' . format_rupiah($value['BRI_amount']),
        'mandiri_qty' => $value['MANDIRI_quantity'],
        'mandiri_amount' => 'Rp ' . format_rupiah($value['MANDIRI_amount']),
        'receipt' => $value['result_success'],
        'receipt_null' => $value['result_failed']
      );

      $sequence++;
    }

    echo json_encode(array('data' => $array_datas));
    exit;
  }


  public function search_transaction_report()
  {
    $type = trim($_POST['layanan']);
    $from = $this->input->post('from_date');
    $to = $this->input->post('to_date');
    $search_input = $this->input->post('search');
    $bank = strtoupper($this->input->post('bank'));


    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;

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
          'filterDate' => 'transaction_date',
          'filterFields' => ($search_input == '') ? null : $search_input,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => $bank,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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

    for ($i = 0; $i < count($arInvoiceArray); $i++) {

      $datas[] = array(
        "id" => $sequence,
        "payment_code"   => $arInvoiceArray[$i]->paymentCode,
        "trx_date"   => $arInvoiceArray[$i]->trxDate,
        "customer"   => $arInvoiceArray[$i]->customerNumber,
        "bank_name" => $arInvoiceArray[$i]->bankName,
        "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
        "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
        "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
        "status_bank" => $arInvoiceArray[$i]->statusBank == 'S' ? 'Success' : $arInvoiceArray[$i]->statusBank,
        "amount" => 'Rp ' . format_rupiah(str_replace(',', '', $arInvoiceArray[$i]->totalAmount)),
        'expired_date' => $arInvoiceArray[$i]->expiredDate,
        "biller"   => $cabang[0]->INV_UNIT_NAME
      );
      $sequence++;
    }


    echo json_encode(array('data' => $datas));
  }



  public function summary_recon()
  {
    print_r("expression");
    die();
  }
  public function search_summary_reconciliation()
  {
    $jenis_date = $this->input->post('jenis_date');
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
          'startDate' => $from,
          'endDate' => $to,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => null,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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

    for ($i = 0; $i < count($arInvoiceArray); $i++) {



      $datas[] = array(
        "id" => $sequence,
        "payment_code"   => $arInvoiceArray[$i]->paymentCode,
        "trx_date"   => $arInvoiceArray[$i]->trxDate,
        "customer"   => $arInvoiceArray[$i]->customerNumber,
        "bank_name" => $arInvoiceArray[$i]->bankName,
        "jkm_number" => $arInvoiceArray[$i]->jkmNumber,
        "status_payment" => $arInvoiceArray[$i]->statusPaymentGate,
        "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
        "status_bank" => $arInvoiceArray[$i]->statusMerchant,
        "amount" => 'Rp ' . format_rupiah(str_replace(',', '', $arInvoiceArray[$i]->totalAmount)),
        "biller" => $arInvoiceArray[$i]->orgId

      );
      $sequence++;
    }


    echo json_encode(array('data' => $datas));
  }

  public function dashboard()
  {
    $data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
    $role_id =  $this->session->userdata('role_id');
    $data['user_role'] = $this->auth_model->get_lastrole($role_id);
    $data['role_child'] = $this->auth_model->get_child_role($role_id);
    $data['layanan'] = $this->auth_model->get_layanan($role_id);
    $this->breadcrumbs->push("Dashboard Report VA", '/');
    $this->breadcrumbs->unshift('Dashboard VA', '/');
    $data['breadcrumbs'] = $this->breadcrumbs->show();
    $data_dashboard = $this->search_dashboard_new();
    $data['data_dash'] = $data_dashboard['collections'];
    $data['data_graph'] = $data_dashboard['graphs'];
    $data['title'] = "Dashboard Report";

    // $data_dashboard['graphs']

    // print_r($data['data_graph']['BNI']);exit;

    $this->common_loader($data, 'pages/va/dashboard');
  }

  /* public function search_dashboard()
  {

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;

    $start_date = date('Y-m-01');
    $end_date = date('Y-m-t');


    $curl = curl_init();


    $data = array(
      "inquiryRequest" => array(
        'esbHeader' => array(
          'internalId' => '',
          'externalId' => $this->externalID().'-'.uniqid(),
          'timestamp'  => date('Y-m-d H:i:s.u'),
        ),
        'esbBody' => array(
          'details' => array(
            array(
              'orgId' => $current_unit,
              'startDate' => $start_date,
              'endDate' => $end_date
            )
          )
        ),
        "esbSecurity" => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""

        )
      )
    );



    curl_setopt_array($curl, array(
      CURLOPT_PORT => ESB_PORT,
      CURLOPT_URL => INQUIRY_DASHBOARD_VA,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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
      $inquiryResponse = $hasildecode->inquiryDashboardVAResponse;
      $esbBody = $inquiryResponse->esbBody;
      $esbHeader = $inquiryResponse->esbHeader;
      $arInvoiceArray = $esbBody->details;
    }

    /// print_r($arInvoiceArray);exit;

    $normalize_cabang = array();
    $collection_by_settledate = array();

    $total_mandiri = 0;
    $total_bni = 0;
    $total_bri = 0;

    if (count($arInvoiceArray) > 0) {

      foreach ($arInvoiceArray as $result) {
        $cabang = $this->biller_model->getDataBranch($result->orgId);
        $normalize_cabang[$cabang[0]->INV_UNIT_NAME][] = $result;
        $collection_by_settledate[$cabang[0]->INV_UNIT_NAME][$result->settleDate] = $result->details;
      }
    }

    foreach ($collection_by_settledate as $key => $row) {
      foreach ($row as $keys => $value) {
        foreach ($value as $detail) {
          $datas[] = array(
            'cabang' => $key,
            'settle_date' => $keys,
            'bank_name' => $detail->bankName,
            'total_amount' =>  $detail->totalAmount
          );
        }
      }
    }

    return $datas;
  }*/

  public function download_reconciliation()
  {
    $jenis_date = $this->input->get('jenis_date');
    $from_date = $this->input->get('from_date');
    $to_date   = $this->input->get('to_date');

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
          'externalId' => '123',
          'timestamp'  => '2019-10-05 07:40:31.834',
        ),
        'esbBody' => array(
          'orgId' => $current_unit,
          'startDate' => $from_date,
          'endDate' => $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => null,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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

    for ($i = 0; $i < count($arInvoiceArray); $i++) {
      $datas[] = array(
        "id" => $sequence,
        "trx_date"   => $arInvoiceArray[$i]->trxDate,
        "payment_code"   => $arInvoiceArray[$i]->paymentCode,
        "biller"   => $cabang[0]->INV_UNIT_NAME,
        "bank_name" => $arInvoiceArray[$i]->bankName,
        "status_merchant" => $arInvoiceArray[$i]->statusMerchant,
        "status_bank" => $arInvoiceArray[$i]->statusBank == 'S' ? 'Success' : $arInvoiceArray[$i]->statusBank,
        "amount" => 'Rp ' . format_rupiah(str_replace(',', '', $arInvoiceArray[$i]->totalAmount)),
        "jkm_number" => $arInvoiceArray[$i]->jkmNumber

      );
      //print_r($datas);
      //exit;
      $sequence++;
    }

    $data['list'] = $datas;
    $data['filename'] = 'list_reconciliation_'.date('dmY', strtotime($from_date)).'-'.date('dmY',strtotime($to_date));

    $this->load->view('pages/va/list_reconciliation_excel', $data);
  }

  public function download_summary_reconciliation()
  {
    $jenis_date = $this->input->post('jenis_date');
    $from_date = $this->input->get('from_date');
    $to_date   = $this->input->get('to_date');
    $bank = strtoupper($this->input->post('bank'));

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;


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
          'startDate' => $from_date,
          'endDate' => $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => $bank,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
        )
      )
    );
    // print_r($data);
    // exit;
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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


    $sequence = 1;
    $collections = array();
    $array_datas = array();

    foreach ($arInvoiceArray as $result) {

      $collections[date('d-m-Y', strtotime($result->trxDate))]['jumlah'] += 1;
      $collections[date('d-m-Y', strtotime($result->trxDate))][$result->bankName . '_quantity'] += 1;
      $collections[date('d-m-Y', strtotime($result->trxDate))][$result->bankName . '_amount'] += $result->totalAmount;
      if ($result->statusMerchant === '') {
        $collections[date('d-m-Y', strtotime($result->trxDate))]['result_failed'] += 1;
      } elseif ($result->statusMerchant === 'Failed') {
        $collections[date('d-m-Y', strtotime($result->trxDate))]['result_failed'] += 1;
      } else {
        $collections[date('d-m-Y', strtotime($result->trxDate))]['result_success'] += 1;
        $collections[date('d-m-Y', strtotime($result->trxDate))]['totalTrx'] += $result->totalAmount;
      }
    }

    foreach ($collections as $row => $value) {
      $array_datas[] = array(
        'id' => $sequence,
        'trx_date' => date('d-m-Y', strtotime($row)),
        'total_trx' => 'Rp ' . format_rupiah($value['totalTrx']),
        'jumlah' => $value['jumlah'],
        'bni_qty' => $value['BNI_quantity'],
        'bni_amount' => $value['BNI_amount'] != '' ? 'Rp ' . format_rupiah($value['BNI_amount']) : 'Rp. 0',
        'bri_qty' => $value['BRI_quantity'],
        'bri_amount' => $value['BRI_amount'] != '' ? 'Rp ' . format_rupiah($value['BRI_amount']) : 'Rp. 0',
        'mandiri_qty' => $value['MANDIRI_quantity'],
        'mandiri_amount' => $value['MANDIRI_amount'] != '' ? 'Rp ' . format_rupiah($value['MANDIRI_amount']) : 'Rp. 0',
        'receipt' => $value['result_success'],
        'receipt_null' => $value['result_failed']
      );

      $sequence++;
    }

    $data['list'] = $array_datas;
    $data['filename'] = 'list_summary_reconciliation_'.date('dmY', strtotime($from_date)).'-'.date('dmY',strtotime($to_date));

    $this->load->view('pages/va/list_summary_reconciliation_excel', $data);
  }

  public function download_summary_reconciliation2()
  {
    $jenis_date = $this->input->post('jenis_date');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $bank = strtoupper($this->input->post('bank'));

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;


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
          'startDate' => $from_date == '' ? date('Y-m-d') : $from_date,
          'endDate' => $to_date == '' ? date('Y-m-d') : $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => $bank,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
        )
      )
    );
    // print_r($data);
    // exit;
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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


    $sequence = 1;
    $collections = array();
    $array_datas = array();

    foreach ($arInvoiceArray as $result) {
      $collections[$result->trxDate]['totalTrx'] += $result->totalAmount;
      $collections[$result->trxDate]['jumlah'] += 1;
      $collections[$result->trxDate][$result->bankName . '_quantity'] += 1;
      $collections[$result->trxDate][$result->bankName . '_amount'] += $result->totalAmount;
      if ($result->statusMerchant === 'failed') {
        $collections[$result->trxDate]['result_failed'] += 1;
      } else {
        $collections[$result->trxDate]['result_success'] += 1;
      }
    }

    foreach ($collections as $row => $value) {
      $array_datas[] = array(
        'id' => $sequence,
        'trx_date' => $row,
        'total_trx' => $value['totalTrx'],
        'jumlah' => $value['jumlah'],
        'bni_qty' => $value['BNI_quantity'],
        'bni_amount' => $value['BNI_amount'],
        'bri_qty' => $value['BRI_quantity'],
        'bri_amount' => $value['BRI_amount'],
        'mandiri_qty' => $value['MANDIRI_quantity'],
        'mandiri_amount' => $value['MANDIRI_amount'],
        'receipt' => $value['result_success'],
        'receipt_null' => $value['result_failed']
      );
      // print_r($array_datas);
      // exit;

      $sequence++;
    }

    $data['list'] = $array_datas;
    $data['filename'] = 'list_summary_reconciliation_'.date('dmY', strtotime($from_date)).'-'.date('dmY',strtotime($to_date));

    $this->load->view('pages/va/list_summary_reconciliation_excel', $data);
  }
  function rupiah($angka)
  {
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
  }

  public function getDetailDailySummaryRecon()
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

    $from = $this->input->get('start_date');
    $to = $this->input->get('end_date');
    $type = 'transaction_date';
    $search_input = '';

    $this->breadcrumbs->push("Daily Summary Report", '/');
    $this->breadcrumbs->unshift('Reporting VA', '/');
    $data['breadcrumbs'] = $this->breadcrumbs->show();

    $data['title'] = "Details Daily Summary Report";

    $curl = curl_init();

    $query = array(
      "inquiryDetailVAKonsolidasiRequest" => array(
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
          'statusMerchant' => 'S',
          'bankName' => null,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
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
      CURLOPT_POSTFIELDS => json_encode($query),
      CURLOPT_HTTPHEADER => array(
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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
      $arInvoiceDetail = $esbBody->details;
    }

    $datas = array();
    $sequence = 1;

    for ($i = 0; $i < count($arInvoiceDetail); $i++) {
      $datas[] = array(
        "id" => $sequence,
        "payment_code"   => $arInvoiceDetail[$i]->paymentCode,
        "trx_date"   => $arInvoiceDetail[$i]->trxDate,
        "customer"   => $arInvoiceDetail[$i]->customerNumber,
        "bank" => $arInvoiceDetail[$i]->bankName,
        "no_jkm" => $arInvoiceDetail[$i]->jkmNumber,
        "status_merchant" => $arInvoiceDetail[$i]->statusMerchant,
        "status_payment" =>  $arInoviceDetail[$i]->statusPaymentGate,
        "status_bank"    =>  $arInvoiceDetail[$i]->statusBank == 'S' ? 'Success' : $arInvoiceDetail[$i]->statusBank,
        "amount" => str_replace(',', '', $arInvoiceDetail[$i]->totalAmount)
      );
      $sequence++;
    }

    // print_r($hasildecode);exit;

    // trx_date proforma no invoice customer service cabang amount

    $data["payment_detail"] = $datas;
    $data["payment_header"] = $arInvoiceHeader;

    $this->common_loader($data, 'pages/va/detail_summary_recon');
  }

  public function search_dashboard_new()
  {
    $jenis_date = $this->input->post('jenis_date');
    $from_date = date('Y-m-01');
    $to_date = date('Y-m-t');
    $search_input = $this->input->post('search');

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;

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
          'startDate' => $from_date,
          'endDate' => $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => null,
        ),
        'esbSecurity' => array(
          "orgId" => $unit_org,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
        )
      )
    );
    // print_r($data);
    //exit;

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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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

    $sequence = 1;

    $collections = array();
    $date_sequence = array();
    $current_period = array();

    $list=array();
    $month = date('m');
    $year = date('Y');

    foreach ($arInvoiceArray as $bank) {
      for($d=1; $d<=31; $d++)
      {
          $time=mktime(12, 0, 0, $month, $d, $year);
          if (date('m', $time)==$month)
              $list[$bank->bankName][date('d-m-Y', $time)] = 0;
      }
    }

    foreach ($arInvoiceArray as $result) {
      $collections[$result->bankName]['totalAmount'] += $result->totalAmount;
      $collections[$result->bankName]['totalTrx'] += 1;
      $collections[$result->bankName][date('d-m-Y', strtotime($result->trxDate))] += 1;
      $list[$result->bankName][date('d-m-Y', strtotime($result->trxDate))] += 1;
    }

    foreach($list as $index => $row) {
      foreach($row as $key => $total_trx) {
        $current_period[$index][] = array($key, $total_trx);
      }
    }

    $final = array();

    foreach($current_period as $key => $value) {
      $final[] = (object) array(
        'name' => $key,
        'data' => $value
      );
    }

    return array('collections' => $collections, 'graphs' => $final);
    //exit;
  }

  public function search_chart()
  {

    $jenis_date = $this->input->post('jenis_date');
    $from_date = date('Y-m-01');
    $to_date = date('Y-m-t');
    $bank = strtoupper($this->input->post('bank'));

    $unit_org = $this->session->userdata('unit_org');
    $unit_implode = json_decode($unit_org, true);
    $unit_branch = $this->session->userdata('unit_id');
    $branch_implode = json_decode($unit_branch, true);
    $unit_id = $this->biller_model->getBranchId($branch_implode[0]);
    $cabang = $this->biller_model->getDataBranch($unit_implode[0]);
    $current_unit = $unit_id[0]->INV_UNIT_ORGID;


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
          'startDate' => $from_date,
          'endDate' => $to_date,
          'filterDate' => 'transaction_date',
          'filterFields' => null,
          'userId' => null,
          'customerNumber' => null,
          'statusMerchant' => 'S',
          'bankName' => $bank,
        ),
        'esbSecurity' => array(
          "orgId" => $current_unit,
          "batchSourceId" => "",
          "lastUpdateLogin" => "",
          "userId" => "",
          "respId" => "",
          "ledgerId" => "",
          "respApplId" => "",
          "batchSourceName" => ""
        )
      )
    );
    // print_r($data);
    // exit;
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
        "Authorization: Basic dmFfdXNlcjp2MXJUdWFMXzRjQzB1blQ=",
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


    $sequence = 1;
    $collections = array();
    $array_datas = array();

    foreach ($arInvoiceArray as $result) {

      $collections[$result->trxDate]['jumlah'] += 1;
      $collections[$result->trxDate][$result->bankName . '_quantity'] += 1;
      $collections[$result->trxDate][$result->bankName . '_amount'] += $result->totalAmount;
      if ($result->statusMerchant === '') {
        $collections[$result->trxDate]['result_failed'] += 1;
      } elseif ($result->statusMerchant === 'Failed') {
        $collections[$result->trxDate]['result_failed'] += 1;
      } else {
        $collections[$result->trxDate]['result_success'] += 1;
        $collections[$result->trxDate]['totalTrx'] += $result->totalAmount;
      }
    }


    foreach ($collections as $row => $value) {

      $array_datas[] = array(
        'id' => $sequence,
        'trx_date' => $row,
        'total_trx' => 'Rp ' . format_rupiah($value['totalTrx']),
        'jumlah' => $action,
        'bni_qty' => format_rupiah($value['BNI_quantity']),
        'bni_amount' => 'Rp ' . format_rupiah($value['BNI_amount']),
        'bri_qty' => format_rupiah($value['BRI_quantity']),
        'bri_amount' => 'Rp ' . format_rupiah($value['BRI_amount']),
        'mandiri_qty' => format_rupiah($value['MANDIRI_quantity']),
        'mandiri_amount' => 'Rp ' . format_rupiah($value['MANDIRI_amount']),
        'receipt' => $value['result_success'],
        'receipt_null' => $value['result_failed']
      );

      $sequence++;
    }
    return $array_datas;
    //exit;
  }

  public function get_chart_ajax()
  {
    $data_dashboard = $this->search_dashboard_new();
    $chart = $data_dashboard['graphs'];

    echo json_encode($chart);
    exit;
  }

  public function externalID()
  {
     return strtotime(date('d-m-Y H:i:s'));
  }

}
