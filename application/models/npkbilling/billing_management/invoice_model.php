<?php 
	class invoice_model extends CI_Model 
    {

	    public function __construct()
        {
	      	$this->load->database();
	      	$this->load->library('session');
	    }

        public function getListInvoice()
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
                                        "join": [
                                            {
                                                "table": "TM_REFF B",
                                                "field1": "B.REFF_ID",
                                                "field2": "TX_HDR_NOTA.NOTA_PAID"
                                            }
                                        ],
                                        "where": [
                                            [
                                                "B.REFF_TR_ID",
                                                "=",
                                                "9"
                                            ],
                                            [
                                                "TX_HDR_NOTA.NOTA_STATUS",
                                                "=",
                                                "2"
                                            ],
                                            [
                                                "TX_HDR_NOTA.NOTA_FAKTUR_NO",
                                                "!=",
                                                "null"
                                            ],
                                            [
                                                "TX_HDR_NOTA.NOTA_CUST_ID",
                                                "=",
                                                "'.$this->session->userdata('customerid_phd').'"
                                            ]
                                        ],
                                        "orderby": [
                                            "TX_HDR_NOTA.NOTA_ID",
                                            "DESC"
                                        ],
                                        "action": "join",
                                        "db": "omcargo",
                                        "table": "TX_HDR_NOTA",
                                        "page": 1,
                                        "start": 0,
                                        "limit": 25
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
            };
        }
	}
 ?>