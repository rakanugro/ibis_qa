<?php 
  class Lumpsum_request_model extends CI_Model {

      public function __construct(){
          $this->load->database();
          $this->load->library('session');
      }

      public function get_list_lumpsum() {
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
                                    <request>
                                    {
                                        "action"   : "join",
                                        "db"       : "omcargo",
                                        "table"    : "TX_HDR_LUMPSUM",
                                        "join"     : 
                                        [
                                        {
                                            "table"  : "TM_REFF",
                                            "field1" : "TM_REFF.REFF_ID",
                                            "field2" : "TX_HDR_LUMPSUM.LUMPS_STATUS"
                                        }
                                        ], 
                                        "where"    : [["TM_REFF.REFF_TR_ID", "=", "8"],["TX_HDR_LUMPSUM.lumps_cust_id", "=", "'.$this->session->userdata('customerid_phd').'"],["TX_HDR_LUMPSUM.APP_ID", "=", "2"]],
                                        "select"   : [],
                                        "orderby": [
                                          "TX_HDR_LUMPSUM.lumps_id",
                                          "DESC"
                                        ],
                                        "limit": 0,
                                        "page": 1,
                                        "start": 1
                                     }
                                    </request>
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
          if(!$result)
          {
            echo $result;
            die;
          }
          else
          {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
              
              $json = (array) json_decode($out_param);
              
              return $json['result'];
          }
        }
        
        public function get_nomor_kontrak($input) {
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
                                    <request>
                                    {
                                        "action": "whereQuery",
                                        "db": "omcargo",
                                        "table": "TM_LUMPSUM",
                                        "field": "lumpsum_no",
                                        "query": "'.$input.'",
                                        "page": "",
                                        "start": "",
                                        "limit": ""
                                    }
                                    </request>
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
          if(!$result)
          {
            echo $result;
            die;
          }
          else
          {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
              
              $json = (array)json_decode($out_param);
        $data = array();

        foreach ($json['result'] as $obj) {
          $data[] = array("label"=>$obj->lumpsum_no);
        }

        echo json_encode($data);
          }
        }

        public function get_tipe_kegiatan() {
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
                                    <request>
                                    {
                                        "action"   : "whereQuery",
                                        "db"       : "omcargo",
                                        "table"    : "TM_REFF",
                                        "query"    : "",
                                        "field"    : "reff_name",
                                        "where"    : [["reff_tr_id","=", "12"]],
                                        "whereIn"  : ["reff_id", ["1","2"]],
                                        "start"    : "",
                                        "limit"    : "",
                                        "page"     : ""
                                    }
                                    </request>
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
          if(!$result)
          {
            echo $result;
            die;
          }
          else
          {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
              
              $json = (array) json_decode($out_param);
              
              return $json['result'];
          }
        }
        
        public function get_package() {
            $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
                   <soapenv:Header/>
                   <soapenv:Body>
                      <ipc:indexService>
                         <indexServiceInterfaceRequest>
                            <esbHeader>
                               <!--Optional:-->
                               <internalId></internalId>
                               <!--Optional:-->
                               <externalId></externalId>
                               <!--Optional:-->
                               <timestamp></timestamp>
                               <!--Optional:-->
                               <responseTimestamp></responseTimestamp>
                               <!--Optional:-->
                               <responseCode></responseCode>
                               <!--Optional:-->
                               <responseMessage></responseMessage>
                            </esbHeader>
                            <esbBody>
                               <request>
                               {
                                    "action": "index",
                                    "db": "mdm",
                                    "table": "TM_PACKAGE",
                                    "orderby": ["PACKAGE_NAME", "asc"],
                                    "limit": 0,
                                    "page": 1,
                                    "start": 1
                                }
                               </request>
                            </esbBody>
                            <esbSecurity>
                               <orgId></orgId>
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
                if(!$result)
                {
                  echo $result;
                  die;
                }
                else
                {
                  $response = $this->xml2array->xml2ary($result['response']);
                  $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
                  
                  $json = (array)json_decode($out_param);
                  
                  return $json['result'];     
                }
        }

        public function get_satuan() {
            $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
                   <soapenv:Header/>
                   <soapenv:Body>
                      <ipc:indexService>
                         <indexServiceInterfaceRequest>
                            <esbHeader>
                               <!--Optional:-->
                               <internalId></internalId>
                               <!--Optional:-->
                               <externalId></externalId>
                               <!--Optional:-->
                               <timestamp></timestamp>
                               <!--Optional:-->
                               <responseTimestamp></responseTimestamp>
                               <!--Optional:-->
                               <responseCode></responseCode>
                               <!--Optional:-->
                               <responseMessage></responseMessage>
                            </esbHeader>
                            <esbBody>
                               <request>
                              {
                                  "action": "unit",
                                  "unit_subject": "3",
                                  "orderby": [
                                      "UNIT_NAME",
                                      "ASC"
                                  ]
                              }
                               </request>
                            </esbBody>
                            <esbSecurity>
                               <orgId></orgId>
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
                if(!$result)
                {
                  echo $result;
                  die;
                }
                else
                {
                  $response = $this->xml2array->xml2ary($result['response']);
                  $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
                  
                  $json = (array)json_decode($out_param);
                  
                  return $json;     
                }
        }

        public function save_lumpsum($data) {

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
                                <request>'.$data.'</request>
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
                if(!$result)
                {
                  echo $result;
                  die;
                }
                else
                {

                  $response = $this->xml2array->xml2ary($result['response']);
                  $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
                  $header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
                  $data = array(
                    "success" => $header,
                    "data" => $out_param
                  );
                  return json_encode($data);
                }
        }

        public function update_lumpsum ($id) {
          $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
            <soapenv:Header/>
            <soapenv:Body>
              <ipc:indexService>
                <indexServiceInterfaceRequest>
                <esbHeader>
                  <!--Optional:-->
                  <internalId></internalId>
                  <!--Optional:-->
                  <externalId></externalId>
                  <!--Optional:-->
                  <timestamp></timestamp>
                  <!--Optional:-->
                  <responseTimestamp></responseTimestamp>
                  <!--Optional:-->
                  <responseCode></responseCode>
                  <!--Optional:-->
                  <responseMessage></responseMessage>
                </esbHeader>
                <esbBody>
                  <request>{
					    "action": "viewHeaderDetail",
					    "data": [
					        "HEADER",
					        "DETAIL"
					    ],
					    "HEADER": {
					        "DB": "omcargo",
					        "TABLE": "TX_HDR_LUMPSUM",
					        "PK": [
					            "LUMPS_ID",
					            "'.$id.'"
					        ]
					    },
					    "DETAIL": {
					        "DB": "omcargo",
					        "TABLE": "TX_DTL_LUMPSUM",
					        "FK": [
					            "HDR_LUMPS_ID",
					            "lumps_id"
					        ]
					    }
					}</request>
                </esbBody>
                <esbSecurity>
                  <orgId></orgId>
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
          if(!$result)
          {
            return $result;
            die;
          }
          else
          {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            return $out_param;
                
          }
        }

        public function get_lumpsum_views($lumpsum_id) {
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
                                    <request>
                                    {
                                        "action" : "viewHeaderDetail",
                                        "data"   : ["HEADER", "DETAIL"],
                                        "HEADER" : {
                                            "DB"     : "omcargo",
                                            "TABLE"  : "TX_HDR_LUMPSUM",
                                            "PK"     : ["LUMPS_ID","'.$lumpsum_id.'"]
                                        },
                                        "DETAIL": {
                                            "DB"     : "omcargo",
                                            "TABLE"  : "TX_DTL_LUMPSUM",
                                            "FK"     : ["HDR_LUMPS_ID","lumps_id"]
                                        }
                                }
                                    </request>
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
                if(!$result)
                {
                  echo $result;
                  die;
                }
                else
                {
                  $response = $this->xml2array->xml2ary($result['response']);
                  $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
                  
                  $json = (array)json_decode($out_param);
                  
                  return $json;     
                }
        }

        public function send_lumpsum_approval() {
            $lumpsum_id = $this->input->post('lumpsum_id');

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
                                <request>
                                {
                                    "action" : "update",
                                    "db"     : "omcargo",
                                    "table"  : "TX_HDR_LUMPSUM",
                                    "update" : { "LUMPS_STATUS " : 2 },
                                    "where"  : { "LUMPS_ID" : '.$lumpsum_id.' }
                                }
                            </request>
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
                if(!$result)
                {
                  echo $result;
                  die;
                }
                else
                {
                  $response = $this->xml2array->xml2ary($result['response']);
                  $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
                                      
                  return $out_param == 'S' ? 'Success' : 'Failed';     
                }
        }

  }
 ?>