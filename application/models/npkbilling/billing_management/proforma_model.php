<?php
class proforma_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
		
   	public function getListProforma (){
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
						    "action": "listProforma",
						    "where": [
				                ["B.REFF_TR_ID", "=", "13"],
				                ["TX_HDR_NOTA.NOTA_CUST_ID", "=", "'.$this->session->userdata('customerid_phd').'"]
				            ],
						    "start": "0",
				            "limit": "0",
				            "page": "1"
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
		// print_r($xml);die;
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

    public function approve_proforma ($action, $nota_id) {
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
						<request>
						{
							"action" 	: "'.$action.'",
							"id" 		: "'.$nota_id.'"
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
					</storeServiceInterfaceRequest>
				</ipc:storeService>
			</soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = NPK_WSDL; 

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'storeService', 'npk_billing', 'npk_billing');
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
			echo json_encode($out_param);
			// return $data;
					
		}
	}

	public function reject_proforma ($action, $nota_real_no, $proforma_no, $file) {
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
						<request>
						{
							"action" 		: "'.$action.'",
							"req_no" 		: "'.$nota_real_no.'",
							"proforma_no" 	: "'.$proforma_no.'",
							"file" 			: '.$file.'
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
    
                    echo json_encode($data); 
					
		}
	}
}
?>