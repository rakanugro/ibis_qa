<?php 
	class Mdm_model extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
		}

		public function get_terminalList($id_sub_group)
		{

			$query = "select a.id_sub_group, a.branch_id, a.branch_code, a.id_terminal, b.terminal_name
						  from tm_branch a left join mst_terminal b on a.id_port = b.id_port 
						  where '$id_sub_group' like '%' || a.id_sub_group || '%'";

			$query 	= $this->db->query($query);
			return $query->result_array();
		}

	    public function terminal ($terminal) {
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
			               <request>{"q":"","where":[["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],["BRANCH_CODE","=","' . $terminal[0]['BRANCH_CODE'] . '"]],"whereIn":[],"whereNotIn":[],"orderby":["TERMINAL_NAME","desc"],"action":"whereIn","db":"mdm","table":"TM_TERMINAL","limit":0,"page":1,"start":0}</request>
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
		
		public function pbm () {
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
			               <request>{"action":"filter","db":"mdm","table":"TM_CUSTOMER","parameter":{"data":["IS_PBM"],"operator":["="],"value":["Y"],"type":""},"orderby":["CUSTOMER_ID_SEQ","asc"],"limit":0,"page":1,"start":1}</request>
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
		
		public function tipeperdagangan () {
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
			               <request>{"action":"filter","db":"omcargo","table":"TM_REFF","parameter":{"data":["REFF_TR_ID"],"operator":["="],"value":["7"],"type":""},"orderby":["REFF_ORDER","asc"],"limit":0,"page":1,"start":1}</request>
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
		
		public function shippingagen () {
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
			               <request>{"action":"filter","db":"mdm","table":"TM_CUSTOMER","parameter":{"data":["IS_SHIPPING_AGENT"],"operator":["="],"value":["Y"],"type":""},"orderby":["CUSTOMER_ID_SEQ","asc"],"limit":0,"page":1,"start":1}</request>
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
		
		public function tipekegiatan () {
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
			               <request>{"action":"whereIn","db":"omcargo","table":"TM_REFF","whereIn":[],"where":[["REFF_TR_ID","=","2"]],"whereNotIn":[],"start":0,"limit":0,"page":0}</request>
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
		
		public function kemasan () {
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
	          return json_encode($out_param);
	                  
	        }
		}
		
		public function barang ($id) {
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
					            "where":[["TM_PACKAGE.package_parent_id","=","'.$id.'"]],
					            "select": [],
					            "orderby": [
					            "COMMODITY_NAME",
					            "asc"
					            ],
					            "limit": 0,
					            "page": 1,
					            "start": 0
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
	          return json_encode($out_param);
	                  
	        }
		}
		
		public function stacking_id()
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
			               <request>
			               {
							    "action": "whereIn",
							    "db": "mdm",
							    "table": "TM_REFF",
							    "whereIn": [
							        "reff_tr_id",
							        [
							            11
							        ]
							    ],
							    "where": [
							        []
							    ],
							    "orderby": [
							        "reff_name",
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

		public function lapangan()
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
		                    "action": "index",
		                    "db": "mdm",
		                    "table": "TM_YARD",
		                    "orderby": ["YARD_NAME", "asc"],
		                    "limit": 0,
		                    "page": 1,
		                    "start": 1
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
	          return json_encode($out_param);
	                  
	        }
		}

		public function gudang()
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
			                    "action": "index",
			                    "db": "mdm",
			                    "table": "TM_STORAGE",
			                    "orderby": ["STORAGE_NAME", "asc"],
			                    "limit": 0,
			                    "page": 1,
			                    "start": 1
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
	          return json_encode($out_param);
	                  
	        }
		}

		public function satuan () {
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
			               <request>{"action":"index","db":"mdm","table":"TM_UNIT","orderby":["UNIT_NAME","asc"],"limit":0,"page":1,"start":1}</request>
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
		
		public function vessel ($params) {
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
			               <request>{"action":"vessel_index","query":"'.strtoupper($params).'","ibis_terminal_code":"201"}</request>
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
			$data = array();

			foreach ($json['result'] as $obj) {
				$label = $obj->vessel." - ".$obj->voyage;
				$data[] = array(
							"label"=>$label,
							"name"=>$obj->vessel,
							"eta"=>$obj->eta,
							"etd"=>$obj->etd,
							"etb"=>$obj->etb,
							"ata"=>$obj->ata,
							"atd"=>$obj->atd,
							"voyageIn"=>$obj->voyageIn,
							"voyageOut"=>$obj->voyageOut,
							"vesselCode"=>$obj->vesselCode,
							"idKade"=>$obj->idKade,
							"idVsbVoyage"=>$obj->idVsbVoyage,
							"voyage"=>$obj->voyage,
							"openStack"=>$obj->openStack,
							"idUkkSimop"=>$obj->idUkkSimop
						);
			}
			// print_r($data);die;
			echo json_encode($data);                   
	        }
		}
		
		public function auto_vessel($vessel) { 
			$xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_VESSEL.'">
			<soapenv:Header/>
			<soapenv:Body>
				<ipc:getVesselList>
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
						<ibisTerminalCode>201</ibisTerminalCode>
						<vesselName>'.$vessel.'</vesselName>
						</esbBody>
					</trackingVesselInterfaceRequest>
				</ipc:getVesselList>
			</soapenv:Body>
			</soapenv:Envelope>';

			$wsdl = NPK_VESSEL_PORT;

			$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'getVesselList', 'npk_billing', 'npk_billing');

			if(!$result){
				echo $result;
				die;
				
			}else{

				$response = $this->xml2array->xml2ary($result['response']);
				$response = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:getVesselListResponse']['_c']['trackingVesselInterfaceResponse']['_c']['esbBody']['_c']['results'];
				$aa = json_encode($response);
				
				echo $aa;
			}
		
		}

		public function alat () {
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
			               <request>{"action":"index","db":"mdm","table":"TM_EQUIPMENT_TYPE","orderby":["EQUIPMENT_TYPE_NAME","asc"],"limit":0,"page":1,"start":1}</request>
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

		public function unit_alat () {
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
						    "action": "unit",
						    "unit_subject" : "3",
						    "orderby" : ["UNIT_NAME", "ASC"]
						    
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
	          return json_encode($out_param);
	                  
	        }
		}

		public function size () {
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
			               <request>{"action":"index","db":"mdm","table":"TM_CONT_SIZE","orderby":["CONT_SIZE","asc"],"limit":0,"page":1,"start":1}</request>
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

		public function type () {
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
			               <request>{"action":"index","db":"mdm","table":"TM_CONT_TYPE","orderby":["CONT_TYPE","asc"],"limit":0,"page":1,"start":1}</request>
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

		public function status () {
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
			               <request>{"action":"index","db":"mdm","table":"TM_CONT_STATUS","orderby":["CONT_STATUS","asc"],"limit":0,"page":1,"start":1}</request>
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

		public function sifat_barang () {
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
			               <request>{"action":"whereIn","db":"mdm","table":"TM_CHARACTER","where":[],"whereIn":["CHARACTER_ID",["1","2","0"]],"whereNotIn":[],"orderby":["CHARACTER_NAME","asc"],"limit":0,"page":1,"start":0}</request>
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

		public function customer ($params, $terminal) {
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
			               <request>{"action":"autoComplete","db":"mdm","table":"TM_CUSTOMER","field":"NAME","query":"'.$params.'","orderby":["CUSTOMER_ID_SEQ","DESC"],"selected":[],"whereIn":[],"where":[["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"]],"limit":0,"page":1,"start":0}</request>
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
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
							"label"=>$obj->alt_name,
							"customer_id"=>$obj->customer_id,
							"address"=>$obj->address,
							"npwp"=>$obj->npwp
						);
			}
			// print_r($data);die;
			echo json_encode($data);                   
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
			               <request>{"orderby":["COMP_FORM_ORDER","ASC"],"where":[["NOTA_ID","=","13"],["COMP_NOTA_VIEW","=","3"],["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],["BRANCH_CODE","=","' . $terminal[0]['BRANCH_CODE'] . '"]],"action":"index","db":"mdm","table":"TM_COMP_NOTA","start":0,"limit":0,"page":1}</request>
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

		







	}
 ?>