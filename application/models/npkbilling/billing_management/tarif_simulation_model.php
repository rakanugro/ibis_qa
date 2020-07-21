<?php
class Tarif_simulation_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
		
    public function get_booking_type() {
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
								"action"     : "whereQuery",
								"db"         : "mdm",
								"table"      : "TM_NOTA",
								"whereIn"    :  ["nota_id", ["13", "14", "15"]],
								"where" 	 : [["service_code", "=", "1"]],
								"whereNotIn" : [],
								"orderby"       : ["NOTA_NAME", "asc"],
								"selected"   : [],
								"start" 	 : "",
								"limit" 	 : "",
								"page"       : ""
																
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

    public function get_pbm() {
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
							    "action": "filter",
							    "db": "mdm",
							    "table": "TM_CUSTOMER",
							    "parameter": {
							        "data": [
							            "IS_PBM"
							        ],
							        "operator": [
							            "="
							        ],
							        "value": [
							            "Y"
							        ],
							        "type": ""
							    },
							    "orderby": [
							        "name",
							        "asc"
							    ],
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

    public function stacking_area()
		{
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
	                            "action"     : "whereIn",
	                            "db"         : "mdm",
	                            "table"      : "TM_REFF",
	                            "whereIn"    : ["reff_tr_id", [11]],
	                            "where"      : [[]],
	                            "limit": 0,
							    "page": 1,
							    "start": 0   
	                        } </request>
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
	          $json = (array)json_decode($out_param);
              
              return $json['result']; 
	        }
		}

    public function get_trade_type() {
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
                                "action" : "filter",
                                "db" : "omcargo",
                                "table" : "TM_REFF",
                                "parameter" : 
                                {
                                    "data" : ["REFF_TR_ID"],
                                    "operator" : ["="],
                                    "value" : ["7"], 
                                    "type" : ""
                                },
                                "orderby": ["reff_name", "asc"],
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
					            "action"        : "autoComplete",
					            "db"            : "mdm",
					            "table"         : "TM_PACKAGE",
					            "field"         : "PACKAGE_NAME",
					            "query"         : "",
					            "where"         : [["NVL(PACKAGE_PARENT_CODE, 0)","=", "0"]],
					            "orderby"       : ["PACKAGE_NAME", "asc"],
					            "limit"         : 0,
					            "page"          : 1,
					            "start"         : 0
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

    public function get_commodity($package_id) {
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
					            "action": "join",
					            "db": "mdm",
					            "table": "TM_COMMODITY",
					            "field" : ["TM_COMMODITY.commodity_name"],
					            "query" : "",
					            "join": [
					            {
					                "table": "TM_PACKAGE",
					                "field1": "TM_PACKAGE.PACKAGE_ID",
					                "field2": "TM_COMMODITY.PACKAGE_ID"
					            }
					            ],
					            "where":[["TM_PACKAGE.package_parent_id","=","'.$package_id.'"]],
					            "select": [],
					            "orderby": [
					            "COMMODITY_NAME",
					            "asc"
					            ],
					            "limit": 0,
					            "page": 1,
					            "start": 0
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
	
	public function get_tipe_kegiatan() {
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
							"action"     : "whereIn",
							"db"         : "omcargo",
							"table"      : "TM_REFF",
							"whereIn"    :  [],
							"where" 	 :  [["REFF_TR_ID", "=", "2"]],
							"whereNotIn" : [],
							"orderby"    : ["reff_name", "ASC"],
							"selected"   : [],
							"start" 	 : "",
							"limit" 	 : "",
							"page"       : ""				
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
	
	public function get_size() {
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
								"table": "TM_CONT_SIZE",
								"page": "",
								"start": "",
								"limit": ""
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
	
	public function get_tipe() {
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
								"table": "TM_CONT_TYPE",
								"page": "",
								"start": "",
								"limit": ""
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
	
	public function get_status() {
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
								"table": "TM_CONT_STATUS",
								"page": "",
								"start": "",
								"limit": ""
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
								"orderby": ["unit_name", "asc"],
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
	
	public function get_sifat() {
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
                           {"action":"whereIn","db":"mdm","table":"TM_CHARACTER","where":[],"whereIn":["CHARACTER_ID",["1","2","0"]],"whereNotIn":[],"orderby":["CHARACTER_NAME","asc"],"limit":0,"page":1,"start":0}
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
							   "orderby":["equipment_type_name","asc"],
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
			               <request>{"orderby":["comp_nota_name","ASC"],"where":[["NOTA_ID","=","13"],["COMP_NOTA_VIEW","=","3"],["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],["BRANCH_CODE","=","' . $terminal[0]['BRANCH_CODE'] . '"]],"action":"index","db":"mdm","table":"TM_COMP_NOTA","start":0,"limit":0,"page":1}</request>
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
	          $json = (array)json_decode($out_param);
              
              return $json['result'];   
	                  
	        }
		}
	
	public function get_tarif_simulation($jsonData) {
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
				// print_r($out_param);
				$data = array(
					"success" => $header,
					"data" => $out_param
				);

				return json_encode($data);    
	        }
	}
	
}
?>