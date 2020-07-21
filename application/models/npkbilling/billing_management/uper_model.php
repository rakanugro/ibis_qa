<?php
class uper_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
		
   	public function getListUper (){
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
							"action"   : "join",
							"db"       : "omcargo",
							"table"    : "TX_HDR_UPER",
							"join"     : 
							[
							{
								"table"  : "TM_REFF B",
								"field2" : "B.REFF_ID",
								"field1" : "TX_HDR_UPER.UPER_PAID"
							}
							], 
							"where"    : [
								["B.REFF_TR_ID", "=", "9"], 
								["TX_HDR_UPER.UPER_CUST_ID", "=", "'.$this->session->userdata('customerid_phd').'"],
								["TX_HDR_UPER.APP_ID", "=", "2"]
							],
							"orderby"  : ["TX_HDR_UPER.UPER_ID", "DESC"],
							"page": 1,
							"start": 0,
							"limit": 0
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
	
	public function getDataUper ($uper_id){
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
		               	"action"    : "whereQuery",
		               	"db"        : "omcargo",
		               	"table"     : "TX_HDR_UPER",
		               	"where"     : [["UPER_ID", "=", '.$uper_id.']],
		               	"limit"     : 25,
						"page"      : 1,
						"start"     : 0
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

    public function getListPaymentMethod (){
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
		               	"action"    : "whereQuery",
		               	"db"        : "omcargo",
		               	"table"     : "TM_REFF",
		               	"where"     : [["REFF_TR_ID", "=", "5"]],
		               	"limit"     : 25,
		               	"page"      : 1,
		               	"start"     : 0
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

    public function getListBank (){
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
		               	"table": "TM_BANK",
		               	"orderby": ["BANK_NAME", "asc"],
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

    public function confirm_uper() {
    	$data = json_encode($this->input->post());
    	// print_r($data);
    	// var_dump($data);
    	// var_dump(json_encode($data));
    	// exit();
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
                            '.$data.'
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
        // echo $xml;
        // exit();
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

    public function getGroupTariffId ($nota_id, $category, $terminal){
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
		               	"action"   : "whereIn",
		               	"db"       : "mdm",
		               	"table"    : "TM_COMP_NOTA",
		               	"where"    : 
			               	[
				               	["NOTA_ID", "=", "'.$nota_id.'"], 
				               	["COMP_NOTA_VIEW", "=", "'.$category.'"], 
				               	["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"]
			               	],
		               	"limit"     : 0,
		               	"page"      : 1,
		               	"start"     : 0
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
          echo json_encode($out_param);
                  
        }
    }

    public function onLoadTariff ($where, $whereIn){
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
		               	"action"    : "whereIn",
		               	"db"        : "omcargo",
		               	"table"     : "V_TX_DTL_UPER",
		               	"whereIn"   : '.$whereIn.',
		               	"where"     : '.$where.',
		               	"orderby"   : ["DTL_GROUP_TARIFF_ID", "asc"],
		               	"limit"     : 0,
		               	"page"      : 1,
		               	"start"     : 0
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

}
?>