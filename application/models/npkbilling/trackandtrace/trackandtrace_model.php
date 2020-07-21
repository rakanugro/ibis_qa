<?php
class Trackandtrace_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->where_paid = "Y";
	}
	
	public function detail_bl($terminal, $bl_number)
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_TRACK_AND_TRACE.'">
					<soapenv:Header/>
					<soapenv:Body>
					<ipc:getListTracknTrace>
						<getListTracknTraceInterfaceRequest>
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
								<blNumber>'.$bl_number.'</blNumber>
								<vesselName>?</vesselName>
							</esbBody>
						</getListTracknTraceInterfaceRequest>
					</ipc:getListTracknTrace>
					</soapenv:Body>
				</soapenv:Envelope>';

		$wsdl = NPK_TRACK_AND_TRACE_PORT; 

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'getListTracknTrace', 'npk_billing', 'npk_billing');
		
		if(!$result)
		{
			echo $result;
			die;
		}
		else
		{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:getListTracknTraceResponse']['_c']['getListTracknTraceInterfaceResponse']['_c']['esbBody']['_c']['results'];
			$json = json_encode($out_param);
			return $json;     
		}
	}

	public function history_activity($terminal, $bl_number)
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_TRACK_AND_TRACE.'">
				   <soapenv:Header/>
				   <soapenv:Body>
				      <ipc:getListHandling>
				         <getListHandlingInterfaceRequest>
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
				               <blNumber>'.$bl_number.'</blNumber>
				            </esbBody>
				         </getListHandlingInterfaceRequest>
				      </ipc:getListHandling>
				   </soapenv:Body>
				</soapenv:Envelope>';

		$wsdl = NPK_TRACK_AND_TRACE_PORT; 

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'getListTracknTrace', 'npk_billing', 'npk_billing');
		
		if(!$result)
		{
			echo $result;
			die;
		}
		else
		{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:getListHandlingResponse']['_c']['getListHandlingInterfaceResponse']['_c']['esbBody']['_c']['results'];
			$json = json_encode($out_param);
			return $json;     
		}
	}

	public function history_bl_bongkar_muat($terminal, $bl_number){
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
									"join" : [
								    	{
									        "table": "TX_HDR_BM",
											"field1": "TX_HDR_BM.BM_ID",
											"field2": "TX_DTL_BM.HDR_BM_ID"
								    	}
								    	],
								    "where": [
								    	[
									        "TX_DTL_BM.DTL_BM_BL",
											"=",
											"'.$bl_number.'"
								    	]
								    	
								    ],
								    "orderby" : ["BM_ID","ASC"],
								    "action": "join",
								    "table" : "TX_DTL_BM",
								    "selected" : [
								    				"TX_HDR_BM.*", 
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_BM.BM_NO) jumlah_uper",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_BM.BM_NO AND TX_HDR_UPER.UPER_PAID = \'Y\') jumlah_uper_bayar",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_BM.BM_NO) jumlah_nota",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_BM.BM_NO AND TX_HDR_NOTA.NOTA_PAID = \'Y\') jumlah_nota_bayar"
								    			],
								    "db" : "omcargo",
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
			$json = json_encode($out_param);
			return $json;     
		}
	}

	public function history_bl_receiving($terminal, $bl_number){
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
									"join" : [
								    	{
									        "table": "TX_HDR_REC",
											"field1": "TX_HDR_REC.REC_ID",
											"field2": "TX_DTL_REC.HDR_REC_ID"
								    	}
								    	],
								    "where": [
								    	[
									        "TX_DTL_REC.DTL_REC_BL",
											"=",
											"'.$bl_number.'"
								    	]
								    	
								    ],
								    "orderby" : ["REC_ID","ASC"],
								    "action": "join",
								    "table" : "TX_DTL_REC",
								    "selected" : [
								    				"TX_HDR_REC.*", 
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_REC.REC_NO) jumlah_uper",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_REC.REC_NO AND TX_HDR_UPER.UPER_PAID = \'Y\') jumlah_uper_bayar",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_REC.REC_NO) jumlah_nota",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_REC.REC_NO AND TX_HDR_NOTA.NOTA_PAID = \'Y\') jumlah_nota_bayar"
								    			],
								    "db" : "omcargo",
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
			$json = json_encode($out_param);
			return $json;     
		}
	}

	public function history_bl_delivery($terminal, $bl_number){
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
									"join" : [
								    	{
									        "table": "TX_HDR_DEL",
											"field1": "TX_HDR_DEL.DEL_ID",
											"field2": "TX_DTL_DEL.HDR_DEL_ID"
								    	}
								    	],
								    "where": [
								    	[
									        "TX_DTL_DEL.DTL_DEL_BL",
											"=",
											"'.$bl_number.'"
								    	]
								    	
								    ],
								    "orderby" : ["DEL_ID","ASC"],
								    "action": "join",
								    "table" : "TX_DTL_DEL",
								    "selected" : [
								    				"TX_HDR_DEL.*", 
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_DEL.DEL_NO) jumlah_uper",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_DEL.DEL_NO AND TX_HDR_UPER.UPER_PAID = \'Y\') jumlah_uper_bayar",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_DEL.DEL_NO) jumlah_nota",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_DEL.DEL_NO AND TX_HDR_NOTA.NOTA_PAID = \'Y\') jumlah_nota_bayar"
								    			],
								    "db" : "omcargo",
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
			$json = json_encode($out_param);
			return $json;     
		}
	}

	public function history_bl_lumpsum($terminal, $bl_number){
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
									"join" : [
								    	{
									        "table": "TX_HDR_LUMPSUM",
											"field1": "TX_HDR_LUMPSUM.LUMPS_ID",
											"field2": "TX_DTL_LUMPSUM.HDR_LUMPS_ID"
								    	}
								    	],
								    "where": [
								    	[
									        "TX_DTL_LUMPSUM.DTL_BL",
											"=",
											"'.$bl_number.'"
								    	]
								    	
								    ],
								    "orderby" : ["LUMPS_ID","ASC"],
								    "action": "join",
								    "table" : "TX_DTL_LUMPSUM",
								    "selected" : [
								    				"TX_HDR_LUMPSUM.*", 
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_LUMPSUM.LUMPS_NO) jumlah_uper",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_UPER WHERE TX_HDR_UPER.UPER_REQ_NO = TX_HDR_LUMPSUM.LUMPS_NO AND TX_HDR_UPER.UPER_PAID = \'Y\') jumlah_uper_bayar",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_LUMPSUM.LUMPS_NO) jumlah_nota",
								    				"(SELECT COUNT(*) FROM BILLING_ORDER_NPK.TX_HDR_NOTA WHERE TX_HDR_NOTA.NOTA_REQ_NO = TX_HDR_LUMPSUM.LUMPS_NO AND TX_HDR_NOTA.NOTA_PAID = \'Y\') jumlah_nota_bayar"
								    			],
								    "db" : "omcargo",
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
			$json = json_encode($out_param);
			return $json;     
		}
	}
}
?>
