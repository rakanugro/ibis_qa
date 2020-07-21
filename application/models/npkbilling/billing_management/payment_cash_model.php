<?php 
	class payment_cash_model extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
            
	    }

        public function getListNota(){

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
                                    "action"       : "filter",
                                    "db"           : "omcargo",
                                    "table"        : "TX_HDR_NOTA",
                                    "parameter"    : 
                                    {
                                        "data"	   : ["NOTA_PAID"],
                                        "operator" : ["="],
                                        "value"    : ["N"], 
                                        "type"     : ""
                                    },
                                     "orderby"  :
                                        [
                                            "nota_id",
                                            "DESC"
                                        ],
                                    "start"        : ""
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

            $wsdl = NPK_WSDL ; 

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
                $json = json_encode($out_param);
                return $json;     
            }
        }

        public function getListUper(){
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
                                    "action"       : "filter",
                                    "db"           : "omcargo",
                                    "table"        : "TX_HDR_UPER",
                                    "parameter"    : 
                                    {
                                        "data"	   : ["UPER_PAID"],
                                        "operator" : ["="],
                                        "value"    : ["N"], 
                                        "type"     : ""
                                    },
                                     "orderby"  :
                                        [
                                            "uper_id",
                                            "DESC"
                                        ],
                                    "start"        : ""
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
                $json = json_encode($out_param);
                return $json;     
            }
        }

        public function getBankList($terminal){
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
                                     "where": [["BRANCH_CODE","=","' . $terminal[0]['BRANCH_CODE'] . '"],["BRANCH_ID","=","' . $terminal[0]['BRANCH_ID'] . '"]],
                                    "orderby": ["BANK_CODE", "asc"],
                                    "limit": 0,
                                    "page": 1,
                                    "start": ""
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

        public function detail_payment_nota($id)
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
									"join": [
										{
											"table": "TX_HDR_NOTA",
											"field1": "TX_HDR_NOTA.NOTA_ID",
											"field2": "TX_DTL_NOTA.NOTA_HDR_ID"
										}
									],
									"where": [
										[
											"TX_DTL_NOTA.NOTA_HDR_ID",
											"=",
											"'.$id.'"
										]
									],
									"whereIn": [],
									"select": [],
									"orderby": [
										"NOTA_DTL_ID",
										"desc"
									],
									"action": "join",
									"db": "omcargo",
									"table": "TX_DTL_NOTA",
									"limit": 0,
									"page": 1,
									"start": "",
									"filter": ""
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
                return $json['result'];
            }
        }

        public function detail_payment_uper($id)
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
									"join": [
										{
											"table": "TX_HDR_UPER",
											"field1": "TX_HDR_UPER.UPER_ID",
											"field2": "TX_DTL_UPER.UPER_HDR_ID"
										}
									],
									"where": [
										[
											"TX_DTL_UPER.UPER_HDR_ID",
											"=",
											"'.$id.'"
										]
									],
									"whereIn": [],
									"select": [],
									"orderby": [
										"UPER_DTL_ID",
										"desc"
									],
									"action": "join",
									"db": "omcargo",
									"table": "TX_DTL_UPER",
									"limit": 0,
									"page": 1,
									"start": "",
									"filter": ""
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
                return $json['result'];
            }
        }

        public function save_payment_cash($data)
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
	}
 ?>