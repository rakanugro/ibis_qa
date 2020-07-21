<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class approval_extension extends CI_Controller {

  public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->library('session');
    $this->load->library('xml2array');
        $this->load->model('user_model');
        $this->load->model('container_model');
    $this->load->model('master_model');
    $this->load->library("Nusoap_lib");
    $this->load->library("commonlib");
    $this->load->library('table');
    $this->load->library('ciqrcode');
    $this->load->library('breadcrumbs');
    $this->load->library('sendcurl_lib');
        $this->load->helper('MY_language_helper');
        //$this->session->userdata('branch_code_npk');
        require_once(APPPATH.'libraries/htmLawed.php');

    if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
      redirect(ROOT.'mainpage', 'refresh');
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

  public function index(){
    if (!$this->session->userdata('uname_phd'))
    {
      redirect(ROOT.'main', 'refresh');
    }

    $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

    $this->breadcrumbs->push("Approval Extension", '/');
    $this->breadcrumbs->unshift('Home', '/');
    $data['breadcrumbs'] = $this->breadcrumbs->show();

    $data['title']= "Approval Extension";

    $this->common_loader($data,'npkbilling/approval/approval_extension');
  }

  public function preview_approval_extension()
  {
    $data['id_param'] = $this->input->get('id');
    $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

    $this->breadcrumbs->push("Approval Extension", '/');
    $this->breadcrumbs->unshift('Home', '/');
    $data['breadcrumbs'] = $this->breadcrumbs->show();

    $data['title']= "Preview Approval Extension";

    $this->common_loader($data,'npkbilling/approval/preview_approval_extension');

  }

  public function create_disload()
  {
    //$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
    $data['terminal'] = $this->getListTerminal();
    $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

    $this->breadcrumbs->push("disload Booking", 'container_disload/main_disload');
    $this->breadcrumbs->push("disload Booking", '/');
    $this->breadcrumbs->unshift('Home', '/');
    $data['breadcrumbs'] = $this->breadcrumbs->show();

    $data['title']= "Create Request disload";

    $this->common_loader($data,'npkbilling/booking/create_disload');
  }

  public function getListApprovalExtension()

  {

      $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:indexService>
         <indexServiceInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <request>{
            "action"     : "join",
            "db"         : "omcargo",
            "table"      : "TX_HDR_DEL",
            "join"       : 
            [
            {
                "table"  : "TM_REFF",
                "field2" : "TM_REFF.REFF_ID",
                "field1" : "TX_HDR_DEL.DEL_STATUS"
            }
            ], 
            "where"      : [["TM_REFF.REFF_TR_ID", "=", "8"], ["TX_HDR_DEL.DEL_EXT_LOOP", ">", "1"], ["TX_HDR_DEL.DEL_EXT_STATUS", "=", "Y"], ["TX_HDR_DEL.DEL_STATUS", "=", "2"], ["TX_HDR_DEL.APP_ID","=","2"]],
            "whereIn"    : [],
            "whereIn2"   : [],
            "whereNotIn" : [],
            "range"      : [],
            "select"     : [],
            "orderby"    : ["TX_HDR_DEL.DEL_ID", "DESC"],
            "changeKey"  : ["",""],
            "query"      : "",
            "field"      : "",
            "limit"      : 25,
            "page"       : 1,
            "start"      : 0
        }</request>
            </esbBody>
            <esbSecurity>
               <orgId>?</orgId>
               <batchSourceId>?</batchSourceId>
               <lastUpdateLogin>?</lastUpdateLogin>
               <userId>?</userId>
               <respId>?</respId>
               <ledgerId>?</ledgerId>
               <respAppId>?</respAppId>
               <batchSourceName>?</batchSourceName>
            </esbSecurity>
         </indexServiceInterfaceRequest>
      </ipc:indexService>
   </soapenv:Body>
</soapenv:Envelope>';

      $wsdl = NPK_WSDL;

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'indexService', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

      $response = $this->xml2array->xml2ary($result['response']);
      //$out_param = sponse);die();
      $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
      $aa = json_encode($out_param);
      echo $aa;
    }

  }

 public function getListApprovalPreview()

  {
    $id = $this->input->get('id');
    // $id2 = $this->input->get('id');


      $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:indexService>
         <indexServiceInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <request>{
  "action" : "viewHeaderDetail",
  "data"   : ["HEADER", "DETAIL", "SPLIT_NOTA", "ALAT", "FILE"],
  "HEADER" : {
    "DB"     : "omcargo",
    "TABLE"  : "TX_HDR_DEL",
    "PK"     : ["DEL_ID","'.$id.'"]
  },
  
  "SPLIT_NOTA":
  {
    "DB"    : "omcargo",
    "TABLE" : "TX_SPLIT_NOTA",
    "FK"     : ["REQ_NO","del_no"]
  },
  
  "ALAT": {
    "DB"    : "omcargo",
    "TABLE" : "TX_EQUIPMENT",
    "FK"     : ["REQ_NO","del_no"]
  },
  
  "DETAIL": {
    "DB"     : "omcargo",
  "TABLE"  : "TX_DTL_DEL",
  "FK"     : ["HDR_DEL_ID","del_id"]
  },
  
  "FILE": {
    "DB"     : "omcargo",
  "TABLE"  : "TX_DOCUMENT",
  "FK"     : ["REQ_NO","del_no"]
  }
}</request>
            </esbBody>
            <esbSecurity>
               <orgId>?</orgId>
               <batchSourceId>?</batchSourceId>
               <lastUpdateLogin>?</lastUpdateLogin>
               <userId>?</userId>
               <respId>?</respId>
               <ledgerId>?</ledgerId>
               <respAppId>?</respAppId>
               <batchSourceName>?</batchSourceName>
            </esbSecurity>
         </indexServiceInterfaceRequest>
      </ipc:indexService>
   </soapenv:Body>
</soapenv:Envelope>';

      $wsdl = NPK_WSDL;

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'indexService', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

                  

      $response = $this->xml2array->xml2ary($result['response']);
      //print_r($response);die();
      $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
      $aa = json_encode($out_param);
    //print_r($out_param);die();
      echo $aa;
    }

  }


  public function ApprovalNow($id)
  {
    //print_r($id);die;

    $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:storeService>
         <storeServiceInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <request>{
    "action" : "approvalRequest",
    "table" : "TX_HDR_DEL",
    "id" : "'.$id.'",
    "msg" : "accepted",
    "approved" : "true"
  }</request>
            </esbBody>
            <esbSecurity>
               <orgId>?</orgId>
               <batchSourceId>?</batchSourceId>
               <lastUpdateLogin>?</lastUpdateLogin>
               <userId>?</userId>
               <respId>?</respId>
               <ledgerId>?</ledgerId>
               <respAppId>?</respAppId>
               <batchSourceName>?</batchSourceName>
            </esbSecurity>
         </storeServiceInterfaceRequest>
      </ipc:storeService>
   </soapenv:Body>
</soapenv:Envelope>';

  $wsdl = NPK_WSDL;

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'storeService', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

                  

      $response = $this->xml2array->xml2ary($result['response']);
      //print_r($response);die();
      $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
      $send_response = json_encode($out_param);
      echo $send_response;
      die();
      

      
    }

  }

  public function RejectNow($id)
  {
    //print_r($id);die;

    $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:storeService>
         <storeServiceInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <request>{
    "action" : "approvalRequest",
    "table" : "TX_HDR_DEL",
    "id" : "'.$id.'",
    "msg" : "rejected",
    "approved" : "false"
  }</request>
            </esbBody>
            <esbSecurity>
               <orgId>?</orgId>
               <batchSourceId>?</batchSourceId>
               <lastUpdateLogin>?</lastUpdateLogin>
               <userId>?</userId>
               <respId>?</respId>
               <ledgerId>?</ledgerId>
               <respAppId>?</respAppId>
               <batchSourceName>?</batchSourceName>
            </esbSecurity>
         </storeServiceInterfaceRequest>
      </ipc:storeService>
   </soapenv:Body>
</soapenv:Envelope>';

  $wsdl = NPK_WSDL;

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'storeService', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

                  

      $response = $this->xml2array->xml2ary($result['response']);
      //print_r($response);die();
      $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
      $send_response = json_encode($out_param);
      echo $send_response;
      die();
      
    }

  }


  public function get_viewuper()
  {
    $id = $this->input->get('id');

    $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:viewService>
         <viewServiceInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <request>{
    "action" : "viewTempUper",
    "table" : "TX_HDR_DEL",
    "id" : "'.$id.'"
  }</request>
            </esbBody>
            <esbSecurity>
               <orgId>?</orgId>
               <batchSourceId>?</batchSourceId>
               <lastUpdateLogin>?</lastUpdateLogin>
               <userId>?</userId>
               <respId>?</respId>
               <ledgerId>?</ledgerId>
               <respAppId>?</respAppId>
               <batchSourceName>?</batchSourceName>
            </esbSecurity>
         </viewServiceInterfaceRequest>
      </ipc:viewService>
   </soapenv:Body>
</soapenv:Envelope>';


  $wsdl = NPK_WSDL;

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'viewService', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

      $response = $this->xml2array->xml2ary($result['response']);
      //print_r($response);die();
      $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:viewServiceResponse']['_c']['viewServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
      //print_r($out_param); die();
      $aa = json_encode($out_param);
    
      echo $aa;
    }

    
  }


  public function getListTerminal() {
    $xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
          <soapenv:Header/>
          <soapenv:Body>
             <ipc:terminalList>
              <terminalListInterfaceRequest>
               <esbHeader>
                <!--Optional:-->
                <internalId>?</internalId>
                <!--Optional:-->
                <externalId>?</externalId>
                <!--Optional:-->
                <timestamp>?</timestamp>
                <!--Optional:-->
                <responseTimestamp>?</responseTimestamp>
                <!--Optional:-->
                <responseCode>?</responseCode>
                <!--Optional:-->
                <responseMessage>?</responseMessage>
               </esbHeader>
               <esbBody>
                <terminalName>BANTEN</terminalName>
               </esbBody>
               <start>?</start>
               <limit>?</limit>
               <page>?</page>
              </terminalListInterfaceRequest>
             </ipc:terminalList>
          </soapenv:Body>
         </soapenv:Envelope>';

    $wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

    $params = array(
        'login' => 'npk_billing',
        'password' => 'npk_billing',
        'trace' => 0,
        'exceptions' => 0,
        'location' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL',
        'uri' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL'
      );

    $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'terminalList', 'npk_billing', 'npk_billing');
        
    $tampArray = array();

    if(!$result){
      echo $result;
    }else{
      $response = $this->xml2array->xml2ary($result['response']);
      $out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:terminalListResponse"]["_c"]["terminalListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
      // print_r($out_param);die;
      for ($i=0; $i < count($out_param); $i++) { 
        $arrPatition = array();
        array_push($arrPatition, $out_param[$i]['_c']['idPort']['_v'], $out_param[$i]['_c']['terminalPort']['_v'], $out_param[$i]['_c']['terminalName']['_v']);
        array_push($tampArray, $arrPatition);       
      }
      // print_r($tampArray);die;
      // $throw = json_encode($tampArray);
      return $tampArray;
    }
  }

  public function auto_vessel(){
    if (!$this->session->userdata('uname_phd'))
    {
      redirect(ROOT.'main', 'refresh');
    }

    $vessel     = $this->security->xss_clean(htmlentities(strtoupper($_GET["vessel"])));
    $port     = $this->security->xss_clean(htmlentities($_GET["port"]));
    $stack = array();

    $xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
           <soapenv:Header/>
           <soapenv:Body>
              <ipc:trackingVessel>
                 <trackingVesselInterfaceRequest>
                    <esbHeader>
                       <!--Optional:-->
                       <internalId>?</internalId>
                       <!--Optional:-->
                       <externalId>?</externalId>
                       <!--Optional:-->
                       <timestamp>?</timestamp>
                       <!--Optional:-->
                       <responseTimestamp>?</responseTimestamp>
                       <!--Optional:-->
                       <responseCode>?</responseCode>
                       <!--Optional:-->
                       <responseMessage>?</responseMessage>
                    </esbHeader>
                    <esbBody>
                       <ibisTerminalCode>'.$port.'</ibisTerminalCode>
                       <vesselName>'.$vessel.'</vesselName>
                    </esbBody>
                 </trackingVesselInterfaceRequest>
              </ipc:trackingVessel>
           </soapenv:Body>
        </soapenv:Envelope>';

    $wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

    $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'trackingVessel', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

      $response = $this->xml2array->xml2ary($result['response']);
      $response = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:trackingVesselResponse']['_c']['trackingVesselInterfaceResponse']['_c']['esbBody']['_c']['results'];
      $aa = json_encode($response);
      echo $aa;
    }
    
  } 

  public function auto_no_peb(){
    $tgl_peb = $this->security->xss_clean(htmlentities(strtoupper($_GET["tgl_peb"])));
    $no_peb  =$this->security->xss_clean(htmlentities(strtoupper($_GET["no_peb"])));
    $npwp    =$this->security->xss_clean(htmlentities(strtoupper($_GET["npwp"])));

    $tgl_peb = str_replace('-', '', $tgl_peb);
    $npwp = str_replace('-', '', str_replace('.', '', $npwp));
    
    $xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
         <soapenv:Header/>
         <soapenv:Body>
            <ipc:searchPEB>
               <searchPEBRequest>
                  <esbHeader>
                     <!--Optional:-->
                     <internalId>?</internalId>
                     <!--Optional:-->
                     <externalId>?</externalId>
                     <!--Optional:-->
                     <timestamp>?</timestamp>
                     <!--Optional:-->
                     <responseTimestamp>?</responseTimestamp>
                     <!--Optional:-->
                     <responseCode>?</responseCode>
                     <!--Optional:-->
                     <responseMessage>?</responseMessage>
                  </esbHeader>
                  <esbBody>
                     <username>PLDB</username>
                     <password>PLDB12345</password>
                     <noPEB>'.$no_peb.'</noPEB>
                     <tglPEB>'.$tgl_peb.'</tglPEB>
                     <npwp>'.$npwp.'</npwp>
                  </esbBody>
               </searchPEBRequest>
            </ipc:searchPEB>
         </soapenv:Body>
      </soapenv:Envelope>';

      /*<noPEB>010976</noPEB>
         <tglPEB>30072019</tglPEB>
         <npwp>018696153055000</npwp>
      */
    $wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

    $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'searchPEB', 'npk_billing', 'npk_billing');
    if(!$result){
      echo $result;
    }else{
      $response = $this->xml2array->xml2ary($result['response']);
      $out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:searchPEBResponse"]["_c"]["searchPEBInterfaceResponse"]["_c"]["esbBody"]["_c"]["npe"]["_c"];

      $result = $out_param['header']['_c']['noNpe']['_v'];

      echo $result;
    }
  }

  public function Search_list()
  {
    $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.approval:approval">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:getListApprovaldisload>
         <getListApprovaldisloadInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <booking_type>disload</booking_type>
               <booking_number></booking_number>
               <booking_id></booking_id>
               <booking_respond></booking_respond>
            </esbBody>
            <start>?</start>
            <limit>?</limit>
            <page>?</page>
         </getListApprovaldisloadInterfaceRequest>
      </ipc:getListApprovaldisload>
   </soapenv:Body>
</soapenv:Envelope>';

      $wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.approval:approval/ipc_eService_provider_services_npkBilling_approval_approval_Port";

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'getListApprovaldisload', 'npk_billing', 'npk_billing');

    if(!$result){
      echo $result;
      die;
      
    }else{

      $response = $this->xml2array->xml2ary($result['response']);
      $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:getListApprovaldisloadResponse']['_c']['getListApprovaldisloadInterfaceResponse']['_c']['esbBody']['_c']['results'];
      //var_dump($response);
      $aa = json_encode($out_param);
      echo $aa;
    }
  }

  public function search_main($search=""){
            
    $search = isset($_POST['search']) ? htmLawed($_POST['search']) : "";
    
    $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.approval:approval">
   <soapenv:Header/>
   <soapenv:Body>
      <ipc:getListApprovaldisload>
         <getListApprovaldisloadInterfaceRequest>
            <esbHeader>
               <!--Optional:-->
               <internalId>?</internalId>
               <!--Optional:-->
               <externalId>?</externalId>
               <!--Optional:-->
               <timestamp>?</timestamp>
               <!--Optional:-->
               <responseTimestamp>?</responseTimestamp>
               <!--Optional:-->
               <responseCode>?</responseCode>
               <!--Optional:-->
               <responseMessage>?</responseMessage>
            </esbHeader>
            <esbBody>
               <booking_type>'.$_POST['booking_type'].'</booking_type>
               <booking_number>'.$search.'</booking_number>
               <booking_id></booking_id>
               <booking_respond></booking_respond>
            </esbBody>
            <start>?</start>
            <limit>?</limit>
            <page>?</page>
         </getListApprovaldisloadInterfaceRequest>
      </ipc:getListApprovaldisload>
   </soapenv:Body>
</soapenv:Envelope>';

      $wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.approval:approval/ipc_eService_provider_services_npkBilling_approval_approval_Port";

      $result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'getListApprovaldisload', 'npk_billing', 'npk_billing');
      
      if(!$result){
        echo $result;
      }
      else
      {
        $response = $this->xml2array->xml2ary($result['response']);
        $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:getListApprovaldisloadResponse']['_c']['getListApprovaldisloadInterfaceResponse']['_c']['esbBody']['_c']['results'];
        
        $results = array();

        if(is_array($out_param)) {
          for($i=0;$i<count($out_param);$i++) {
            if($out_param['_a']['xsi:nil'] == true) {
              
            } else {
              $row = array(
                 
                           'h_receive_no' => isset($out_param[$i]['_c']['h_receive_no']['_v']) ? $out_param[$i]['_c']['h_receive_no']['_v'] : $out_param['_c']['h_receive_no']['_v'],
                            'operation_name' => isset($out_param[$i]['_c']['operation_name']['_v']) ? $out_param[$i]['_c']['operation_name']['_v'] : $out_param['_c']['operation_name']['_v'],
                           'h_receive_date' => isset($out_param[$i]['_c']['h_receive_date']['_v']) ? $out_param[$i]['_c']['h_receive_date']['_v'] : $out_param['_c']['h_receive_date']['_v'],
                          
                           'customer_name' => isset($out_param[$i]['_c']['customer_name']['_v']) ? $out_param[$i]['_c']['customer_name']['_v'] : $out_param['_c']['customer_name']['_v'],
                           'branch_name' => isset($out_param[$i]['_c']['branch_name']['_v']) ? $out_param[$i]['_c']['branch_name']['_v'] : $out_param['_c']['branch_name']['_v'],
                           'terminal_name' => isset($out_param[$i]['_c']['terminal_name']['_v']) ? $out_param[$i]['_c']['terminal_name']['_v'] : $out_param['_c']['terminal_name']['_v'],
                           'pbm_name' => isset($out_param[$i]['_c']['pbm_name']['_v']) ? $out_param[$i]['_c']['pbm_name']['_v'] : $out_param['_c']['pbm_name']['_v'],
                           
                           'date_in' => isset($out_param[$i]['_c']['date_in']['_v']) ? $out_param[$i]['_c']['date_in']['_v'] : $out_param['_c']['date_in']['_v'],
                            'actual_departure' => isset($out_param[$i]['_c']['actual_departure']['_v']) ? $out_param[$i]['_c']['actual_departure']['_v'] : $out_param['_c']['actual_departure']['_v'],
                            'actual_arrived' => isset($out_param[$i]['_c']['actual_arrived']['_v']) ? $out_param[$i]['_c']['actual_arrived']['_v'] : $out_param['_c']['actual_arrived']['_v'],
                           'status_text' => isset($out_param[$i]['_c']['status_text']['_v']) ? $out_param[$i]['_c']['status_text']['_v'] : $out_param['_c']['status_text']['_v']

              );
              array_push($results, $row);
            }
          }
        }
        

        $aa = json_encode((array) $results);

        echo $aa;
      }

    }

}