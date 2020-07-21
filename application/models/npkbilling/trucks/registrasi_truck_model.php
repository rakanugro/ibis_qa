<?php

  	class registrasi_truck_model extends CI_Model {

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

	    public function getKendaraan()
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
	                         <request>{"action":"index","db":"mdm","table":"TM_TRUCK_TYPE","start":"","limit":""}</request>
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

	    public function getListTruck() 
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
	                         			"action":"index",
	                         			"db":"mdm",
	                         			"table":"TM_TRUCK",
	                         			"orderby"	:
	                            		[
	                                          	"truck_id_seq",
	                                          	"DESC"
                                       		],
	                         			"start":"","
	                         			limit":""
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

	    public function getTruckCompany($search, $terminal)
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
	                            "action"       : "autoComplete",
	                            "db"           : "mdm",
	                            "table"        : "TM_TRUCK_COMPANY",
	                            "field"        : "comp_name",
	                            "query"        : "'.$search.'",
	                            "where"    	   : 
	                                [
	                                	[
	                                		"comp_branch_id", "=", "' . $terminal[0]['BRANCH_ID'] . '"
	                                	]
	                                ],
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
	              		if($obj->comp_name == "null" || $obj->comp_name == null || $obj->comp_name == "") continue;
	                  	$data[] = array("value"=>$obj->comp_id,"label"=>$obj->comp_name);
	              	}
	              	echo json_encode($data);
	        }
	    } 

	    public function getUpdateregistrasi($truck_id)
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
	                       <request>
	                            {
	                              "action"       : "index",
									"db"           : "mdm",
									"table"        : "TM_TRUCK",
									"page"         : "",
									"start"        : "",
									"limit"        : "",
									"range" 	   : [],
									"selected"     : [],
									"orderby"      : [],
									"filter"       : 
									[
										{
										"operator" : "",
										"value"    : "",
										"property" : ""
										}
									],
									"where"        : [["TRUCK_ID","=", "'.$truck_id.'"]],
								    "whereIn"      : []
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
	            //print_r($response);die();
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];

	            $json = (array)json_decode($out_param);
	            $data = array();

	            foreach ($json['result'] as $obj) {
	            }

	            $data['truck_id']           = $obj->truck_id;
	            $data['truck_cust_name']    = $obj->truck_cust_name;
	            $data['truck_cust_id']      = $obj->truck_cust_id;
	            $data['truck_plat_no']      = $obj->truck_plat_no;
	            $data['truck_plat_exp']     = $obj->truck_plat_exp;
	            $data['truck_rfid']         = $obj->truck_rfid;
	            $data['truck_type_name']    = $obj->truck_type_name;
	            $data['truck_type']         = $obj->truck_type;


	            $data['title']= "Update Truck Registration";

	            $data['kendaraan'] = $this->getKendaraan();

	            $this->common_loader($data,'npkbilling/truck/update_truck');
	                      
	        }
	    }

	    public function createRequstTruck($TRUCK_ID, $TRUCK_PLAT_NO, $TRUCK_CUST_NAME, $TRUCK_CUST_ID, $TRUCK_PLAT_EXP, 
          $TRUCK_TYPE, $TRUCK_TYPE_NAME, $TRUCK_RFID, $terminal)
	    {

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
	                          "action" : "truckRegistration",
	                          "type" : "CREATE",
	                          "truck_id" : "'.$TRUCK_ID.'",
	                          "truck_name" : "",
	                          "truck_plat_no" : "'.$TRUCK_PLAT_NO.'",
	                          "truck_cust_id" : "'.$TRUCK_CUST_ID.'",
	                          "truck_cust_name" : "'.$TRUCK_CUST_NAME.'",
	                          "truck_branch_id" : "' . $terminal[0]['BRANCH_ID'] . '",
	                          "truck_branch_code": "' . $terminal[0]['BRANCH_CODE'] . '",
	                          "truck_date" : "",
	                          "truck_cust_address" : "",
	                          "truck_type" : "'.$TRUCK_TYPE.'",
	                          "truck_terminal_code" : "",
	                          "truck_plat_exp" : "'.$TRUCK_PLAT_EXP.'",
	                          "truck_stnk_no" : "",
	                          "truck_stnk_exp" : "",
	                          "truck_rfid" : "'.$TRUCK_RFID.'",
	                          "truck_type_name" : "'.$TRUCK_TYPE_NAME.'"
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
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseMessage']['_v'];
	            $resp = json_encode($out_param);
	            echo $resp;                      
	        }
	    }

	    public function updateRequestTruck($TRUCK_ID, $TRUCK_PLAT_NO, $TRUCK_CUST_NAME, $TRUCK_CUST_ID, $TRUCK_PLAT_EXP, 
          $TRUCK_TYPE, $TRUCK_TYPE_NAME, $TRUCK_RFID, $terminal)
	    {

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
	                            "action" : "truckRegistration",
	                            "type" : "UPDATE",
	                            "truck_id" : "'.$TRUCK_ID.'",
	                            "truck_name" : "",
	                            "truck_plat_no" : "'.$TRUCK_PLAT_NO.'",
	                            "truck_cust_id" : "'.$TRUCK_CUST_ID.'",
	                            "truck_cust_name" : "'.$TRUCK_CUST_NAME.'",
	                            "truck_branch_id" : "' . $terminal[0]['BRANCH_ID'] . '",
	                          	"truck_branch_code": "' . $terminal[0]['BRANCH_CODE'] . '",
	                            "truck_date" : "",
	                            "truck_cust_address" : "",
	                            "truck_type" : "'.$TRUCK_TYPE.'",
	                            "truck_terminal_code" : "",
	                            "truck_plat_exp" : "'.$TRUCK_PLAT_EXP.'",
	                            "truck_stnk_no" : "",
	                            "truck_stnk_exp" : "",
	                            "truck_rfid" : "'.$TRUCK_RFID.'",
	                            "truck_type_name" : "'.$TRUCK_TYPE_NAME.'"
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
	            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseMessage']['_v'];
	            $resp = json_encode($out_param);
	            echo $resp;    
	        }
	    }

	}
    
?>