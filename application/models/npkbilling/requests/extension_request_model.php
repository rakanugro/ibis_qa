<?php 
  class Extension_request_model extends CI_Model {

      public function __construct(){
          $this->load->database();
          $this->load->library('session');
      }

      public function get_list_extension() {
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
                                        "action": "join",
                                        "db": "omcargo",
                                        "table": "TX_HDR_DEL",
                                        "join": [
                                          {
                                            "table": "TM_REFF",
                                            "field2": "TM_REFF.REFF_ID",
                                            "field1": "TX_HDR_DEL.DEL_STATUS"
                                          }
                                        ],
                                        "where": [
                                          [
                                            "TM_REFF.REFF_TR_ID",
                                            "=",
                                            "8"
                                          ],
                                          [
                                            "TX_HDR_DEL.DEL_EXT_LOOP",
                                            ">",
                                            "1"
                                          ],
                                          [
                                            "TX_HDR_DEL.DEL_CUST_ID",
                                            "=",
                                            "'.$this->session->userdata('customerid_phd').'"
                                          ],
                                          [
                                            "TX_HDR_DEL.APP_ID",
                                            "=",
                                            "2"
                                          ]
                                        ],
                                        "select": [],
                                        "orderby": [
                                          "TX_HDR_DEL.DEL_ID",
                                          "DESC"
                                        ],
                                        "page": 1,
                                        "start": 0,
                                        "limit": 0
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

        public function get_nomor_request($input, $terminal) {
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
                                        "action"       : "autoComplete",
                                        "db"           : "omcargo",
                                        "table"        : "TX_HDR_DEL",
                                        "field"        : "DEL_NO",
                                        "query"        : "'.$input.'",
                                         "where"       : 
                                          [
                                            [
                                              "del_status", "=", "3"
                                            ],
                                            [
                                              "del_cust_id", "=", "'.$this->session->userdata('customerid_phd').'"
                                            ],
                                            [
                                              "del_branch_id", "=", "' . $terminal[0]['BRANCH_ID'] . '"
                                            ]
                                          ],
                                        "page"         : "",
                                        "start"        : "",
                                        "limit"        : ""   
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

                    //print_r($xml);die();

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
          $data[] = array("label"=>$obj->del_no);
        }

        echo json_encode($data);
          }
        }

        public function auto_generate_by_noreq($input) {
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
                                        "data"   : ["HEADER", "DETAIL","SPLIT_NOTA","ALAT","FILE"],
                                        "HEADER" : {
                                            "DB"     : "omcargo",
                                            "TABLE"  : "TX_HDR_DEL",
                                            "PK"     : ["DEL_NO","'.$input.'"]
                                        },
                                        
                                        "DETAIL": {
                                            "DB"     : "omcargo",
                                          "TABLE"  : "TX_DTL_DEL",
                                          "FK"     : ["HDR_DEL_ID","del_id"]
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
                                        
                                        "FILE": {
                                            "DB"     : "omcargo",
                                          "TABLE"  : "TX_DOCUMENT",
                                          "FK"     : ["REQ_NO","del_no"]
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

        public function layanan_alat ($terminal) {
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
                     <request>{"orderby":["COMP_FORM_ORDER","ASC"],"where":[["NOTA_ID","=","13"],["COMP_NOTA_VIEW","=","3"],["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"], ["BRANCH_CODE","=","' . $terminal[0]['BRANCH_CODE'] . '"]],"action":"index","db":"mdm","table":"TM_COMP_NOTA","start":0,"limit":0,"page":1}</request>
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
            return json_encode($out_param);
                    
          }
    }

        public function get_alat() {
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
                                   "action":"index",
                                   "db":"mdm",
                                   "table":"TM_EQUIPMENT_TYPE",
                                   "orderby":["EQUIPMENT_TYPE_NAME","asc"],
                                   "limit":0,
                                   "page":1,
                                   "start":1
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
                                    "action": "index",
                                    "db": "mdm",
                                    "table": "TM_UNIT",
                                    "orderby": ["UNIT_NAME", "asc"],
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

        public function save_extension($jsonData) {
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
                                        '.$jsonData.'
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
                 //print_r($xml);die();
    
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

        public function get_extension_views($extension_id) {
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
                                        "data"   : ["HEADER", "DETAIL", "SPLIT_NOTA", "ALAT", "FILE"],
                                        "HEADER" : {
                                            "DB"     : "omcargo",
                                            "TABLE"  : "TX_HDR_DEL",
                                            "PK"     : ["DEL_ID","'.$extension_id.'"]
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
                  echo json_encode($out_param);
                  
                  // $json = (array)json_decode($out_param);

                  // print_r($json);die;
                  
                  // return $json;     
                }
        }

        public function send_extension_approval() {
            $extension_id = $this->input->post('extension_id');

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
                                    "action" : "sendRequest",
                                    "table" : "TX_HDR_DEL",
                                    "id" : '.$extension_id.'
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
                    // print_r($xml);die;

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
                  return json_encode($out_param); 
                }
        }
  }
 ?>