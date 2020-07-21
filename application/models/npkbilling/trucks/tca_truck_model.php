<?php

  	class tca_truck_model extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
	    }

	    public function common_loader($data,$views) {
	        $this->load->view('templates/header', $data);
	        $this->load->view('templates/top_bar', $data);
	        $this->load->view('templates/menu_side', $data);
	        $this->load->view('templates/top-1-breadcrumb', $data);
	        $this->load->view('templates/top-2-title-nosearch', $data);
	        $this->load->view($views, $data);
	        $this->load->view('templates/footer', $data);
	    }

	   	public function getListTca() 
	   	{

	        $xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
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
		                            "action"    : "whereIn",
		                            "db"        : "omcargo",
		                            "table"     : "TX_HDR_TCA",
		                            "whereIn"   : 
		                            	[[]],
		                            "where"     : 
		                            	[	
		                            		["TCA_CUST_ID", "=", "'.$this->session->userdata('customerid_phd').'"],
		                            		["APP_ID", "=", "2"]

		                            	],
		                            "orderby"	:
		                            	["TCA_ID","DESC"],
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
	            echo json_encode($out_param);
	                      
	        }
	    }

	    public function getListLayanan()
	    {
	        $xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
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
	                            "db"         : "omcargo",
	                            "table"      : "TM_REFF",
	                            "whereIn"    : ["reff_id", [1,2,3]],
	                            "where"      : [["reff_tr_id", "=", "12"]],
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

	    public function getNoRequestRec($search, $terminal)
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
	                            "action"       : "autoComplete",
	                            "db"           : "omcargo",
	                            "table"        : "TX_HDR_REC",
	                            "field"        : "rec_no",
	                            "query"        : "'.$search.'",
	                             "where"       : 
	                             	[
	                            		["rec_status", "=", "3"],
	                            		["rec_cust_id", "=", "'.$this->session->userdata('customerid_phd').'"],
	                            		["rec_branch_id", "=", "' . $terminal[0]['BRANCH_ID'] . '"],
	                            		["rec_branch_code", "=", "' . $terminal[0]['BRANCH_CODE'] . '"]
	                            	],
	                            "changeKey"    : ["rec_","req_"],
	                            "page"         : "",
	                            "start"        : "",
	                            "limit"        : ""   
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
	            $data = array();

	            foreach ($json['result'] as $obj) {
	                $data[] = array(
	                    "value"=>$obj->rec_id,
	                    "label"=>$obj->rec_no);
	            }
	            echo json_encode($data);
	        }
	    }

	    public function getNoBlRec($id, $terminal)
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
									    "action": "join",
									    "db": "omcargo",
									    "table": "TX_HDR_REC",
									    "join": [
									        {
									            "table": "TX_DTL_REC",
									            "field1": "TX_DTL_REC.HDR_REC_ID",
									            "field2": "TX_HDR_REC.REC_ID"
									        }
									    ],
									    "where": [
									        ["TX_HDR_REC.REC_STATUS","=","3"],
									        ["rec_branch_id","=","' . $terminal[0]['BRANCH_ID'] . '"],
									        ["TX_HDR_REC.REC_NO","=","'.$id.'"]
									    ],
									    "select": [],
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
	            return $result;
	            die;
	        }
	        else
	        {
	            $response = $this->xml2array->xml2ary($result['response']);
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];

	            $json = (array)json_decode($out_param);
	            echo json_encode($json['result']);
	                      
	        }
	    }

	    public function autocompletBlRec($id, $terminal)
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
									    "action": "join",
									    "db": "omcargo",
									    "table": "TX_HDR_REC",
									    "join": [
									        {
									            "table": "TX_DTL_REC",
									            "field1": "TX_DTL_REC.HDR_REC_ID",
									            "field2": "TX_HDR_REC.REC_ID"
									        }
									    ],
									    "where": [
									        ["TX_HDR_REC.REC_STATUS","=","3"],
									        ["TX_HDR_REC.REC_BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],
									        ["TX_DTL_REC.HDR_REC_ID","=","'.$id.'"]
									    ],
									    "select": [],
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
	            return $result;
	            die;
	        }
	        else
	        {
	            $response = $this->xml2array->xml2ary($result['response']);
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
	            //print_r($out_param);die();
	            $json = (array)json_decode($out_param);
	            echo json_encode($json['result']);
	                      
	        }
	    }

	    public function getNoRequestDel($search, $terminal)
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
	                            "action"       : "autoComplete",
	                            "db"           : "omcargo",
	                            "table"        : "TX_HDR_DEL",
	                            "field"        : "del_no",
	                            "query"        : "'.$search.'",
	                            "where"        : 
	                            	[
	                            		["del_status", "=", "3"],
	                            		["del_cust_id", "=", "'.$this->session->userdata('customerid_phd').'"],				
	                            		["del_branch_id", "=", "' . $terminal[0]['BRANCH_ID'] . '"],
	                            		["del_branch_code", "=", "' . $terminal[0]['BRANCH_CODE'] . '"]
	                            	],
	                            "changeKey"    : ["del_","req_"],
	                            "page"         : "",
	                            "start"        : "",
	                            "limit"        : ""   
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
	            $data = array();

	            foreach ($json['result'] as $obj) {
	                $data[] = array("value"=>$obj->del_id,"label"=>$obj->del_no);
	            }
	            echo json_encode($data);
	        }
	    }

	    public function getNoBlDel($id, $terminal)
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
									    "action": "join",
									    "db": "omcargo",
									    "table": "TX_HDR_DEL",
									    "join": [
									        {
									            "table": "TX_DTL_DEL",
									            "field1": "TX_DTL_DEL.HDR_DEL_ID",
									            "field2": "TX_HDR_DEL.DEL_ID"
									        }
									    ],
									    "where": [
									        ["TX_HDR_DEL.DEL_STATUS","=","3"],
									        ["del_branch_id","=","' . $terminal[0]['BRANCH_ID'] . '"],
									        ["TX_HDR_DEL.DEL_NO","=","'.$id.'"]
									    ],
									    "select": [],
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
	            return $result;
	            die;
	        }
	        else
	        {
	            $response = $this->xml2array->xml2ary($result['response']);
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];

	            $json = (array)json_decode($out_param);
	            echo json_encode($json['result']);
	                      
	        }
	    }

	    public function autocompletBlDel($id, $terminal)
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
									    "action": "join",
									    "db": "omcargo",
									    "table": "TX_HDR_DEL",
									    "join": [
									        {
									            "table": "TX_DTL_DEL",
									            "field1": "TX_DTL_DEL.HDR_DEL_ID",
									            "field2": "TX_HDR_DEL.DEL_ID"
									        }
									    ],
									    "where": [
									        ["TX_HDR_DEL.DEL_STATUS","=","3"],
									        ["TX_HDR_DEL.DEL_BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],
									        ["TX_DTL_DEL.HDR_DEL_ID","=","'.$id.'"]
									    ],
									    "select": [],
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
	            return $result;
	            die;
	        }
	        else
	        {
	            $response = $this->xml2array->xml2ary($result['response']);
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
	            //print_r($out_param);die();
	            $json = (array)json_decode($out_param);
	            echo json_encode($json['result']);
	                      
	        }
	    }

	    public function getNoRequestBm($search, $terminal)
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
	                            "action"       : "autoComplete",
	                            "db"           : "omcargo",
	                            "table"        : "TX_HDR_BM",
	                            "field"        : "bm_no",
	                            "query"        : "'.$search.'",
	                            "where"        : 
	                            	[
	                            		["bm_status", "=", "3"],
	                            		["bm_cust_id", "=", "'.$this->session->userdata('customerid_phd').'"],
	                            		["bm_branch_id", "=", "' . $terminal[0]['BRANCH_ID'] . '"],
	                            		["bm_branch_code", "=", "' . $terminal[0]['BRANCH_CODE'] . '"]
	                            	],
	                            "changeKey"    : ["bm_","req_"],
	                            "page"         : "",
	                            "start"        : "",
	                            "limit"        : ""   
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
	            $data = array();

	            foreach ($json['result'] as $obj) {
	                $data[] = array(
	                    "value"=>$obj->bm_id,
	                    "label"=>$obj->bm_no);
	            }
	            echo json_encode($data);
	        }
	    }

	    public function getNoBlBm($id, $terminal)
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
									    "action": "join",
									    "db": "omcargo",
									    "table": "TX_HDR_BM",
									    "join": [
									        {
									            "table": "TX_DTL_BM",
									            "field1": "TX_DTL_BM.HDR_BM_ID",
									            "field2": "TX_HDR_BM.BM_ID"
									        }
									    ],
									    "where": [
									        ["TX_HDR_BM.BM_STATUS","=","3"],
									        ["DTL_BM_TL","=","Y"],
									        ["TX_HDR_BM.BM_BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],
									        ["TX_HDR_BM.BM_NO","=","'.$id.'"]
									    ],
									    "select": [],
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
	            return $result;
	            die;
	        }
	        else
	        {
	            $response = $this->xml2array->xml2ary($result['response']);
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];

	            $json = (array)json_decode($out_param);
	            echo json_encode($json['result']);
	                      
	        }
	    }

	    public function autocompletBlBm($id, $terminal)
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
								    "action": "join",
								    "db": "omcargo",
								    "table": "TX_HDR_BM",
								    "join": [
								        {
								            "table": "TX_DTL_BM",
								            "field1": "TX_DTL_BM.HDR_BM_ID",
								            "field2": "TX_HDR_BM.BM_ID"
								        }
								    ],
								    "where": [
								        ["TX_HDR_BM.BM_STATUS","=","3"],
								        ["DTL_BM_TL","=","Y"],
								        ["TX_HDR_BM.BM_BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],
								        ["TX_DTL_BM.hdr_bm_id","=","'.$id.'"]
								    ],
								    "select": [],
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
	            return $result;
	            die;
	        }
	        else
	        {
	            $response = $this->xml2array->xml2ary($result['response']);
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
	            //print_r($out_param);die();
	            $json = (array)json_decode($out_param);
	            echo json_encode($json['result']);
	                      
	        }
	    }  

	    public function getTruckId($search, $terminal)
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
							    "query": "'.$search.'",
							    "where": [
							        ["TRUCK_BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"],
							        ["TRUCK_BRANCH_CODE","=","' . $terminal[0]['BRANCH_CODE'] . '"]
							    ],
							    "whereIn": [],
							    "orderby": ["TRUCK_ID","desc"],
							    "action": "whereQuery",
							    "db": "mdm",
							    "table": "TM_TRUCK",
							    "field": "truck_id",
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
	            $data = array();

	            foreach ($json['result'] as $obj) {
	                $data[] = array(
	                            "value"=>$obj->truck_id,
	                            "truck_type"=>$obj->truck_type,
	                            "truck_type_name"=>$obj->truck_type_name,
	                            "truck_cust_id"=>$obj->truck_cust_id,
	                            "truck_cust_name"=>$obj->truck_cust_name
	                        );
	            }
	            echo json_encode($data);
	        }
	    }  

	    public function getUpdateTca($id)
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
	                          "action" : "viewHeaderDetail",
	                          "data"   : ["HEADER", "DETAIL"],
	                          "changeKey" : ["bm_", "del_"],
	                          
	                          "HEADER" : {
	                            "DB"     : "omcargo",
	                            "TABLE"  : "TX_HDR_TCA",
	                            "PK"     : ["TCA_ID","'.$id.'"]
	                          },
	                          
	                          "DETAIL": {
	                            "DB"     : "omcargo",
	                            "TABLE"  : "TX_DTL_TCA",
	                            "FK"     : ["TCA_HDR_ID","tca_id"]
	                          }
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
	            $aa = json_encode($out_param);
	            echo $aa;
	        }
	    }

	    public function updateRequestTca($data) 
	    {
			$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
				<soapenv:Header/>
				<soapenv:Body>
					<ipc:storeService>
	         			<storeServiceInterfaceRequest>
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
							<request>'.$data.'</request>
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
						</storeServiceInterfaceRequest>
					</ipc:storeService>
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
				$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
				$header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
				$data = array(
					"success" => $header,
					"data" => $out_param
				);
				return json_encode($data);
						
			}
		}

		 public function createRequestTca($data) 
	    {
			$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
				<soapenv:Header/>
				<soapenv:Body>
					<ipc:storeService>
	         			<storeServiceInterfaceRequest>
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
							<request>'.$data.'</request>
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
						</storeServiceInterfaceRequest>
					</ipc:storeService>
				</soapenv:Body>
			</soapenv:Envelope>';

			//print_r($xml);die();

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
				$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
				$header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
				$data = array(
					"success" => $header,
					"data" => $out_param
				);
				return json_encode($data);
						
			}
		}

		public function send ($id) {
			$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_XML.'">
				<soapenv:Header/>
				<soapenv:Body>
					<ipc:storeService>
	         			<storeServiceInterfaceRequest>
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
							<request>{"action":"sendTCA","table":"TX_HDR_TCA","id":"'.$id.'"}</request>
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
				$header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];

				$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
				
				$data = array(
					"success" => $header,
					"data" => $out_param
				);
				return $data;
	        }
		}
	}
?>