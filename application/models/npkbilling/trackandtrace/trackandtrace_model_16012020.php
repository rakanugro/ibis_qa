<?php
class Trackandtrace_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}

	public function get_terminal() {
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.billing:billing">
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
                                "table": "TM_TERMINAL",
                                "orderby": ["TERMINAL_CODE", "asc"],
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
		
		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.billing:billing/ipc_eService_provider_services_npkBilling_billing_billing_Port"; 

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
	
	public function detail_bl($terminal, $bl_number)
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.tracknTrace:tracknTrace">
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
							</esbBody>
						</getListTracknTraceInterfaceRequest>
					</ipc:getListTracknTrace>
					</soapenv:Body>
				</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.tracknTrace:tracknTrace/ipc_eService_provider_services_npkBilling_tracknTrace_tracknTrace_Port"; 

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
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.tracknTrace:tracknTrace">
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

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.tracknTrace:tracknTrace/ipc_eService_provider_services_npkBilling_tracknTrace_tracknTrace_Port"; 

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
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.billing:billing">
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
									"whereIn": [],
									"select": [],
									"orderby": [
										"BM_ID",
										"desc"
									],
									"action": "join",
									"db": "omcargo",
									"table": "TX_DTL_BM",
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

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.billing:billing/ipc_eService_provider_services_npkBilling_billing_billing_Port"; 

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
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.billing:billing">
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
									"whereIn": [],
									"select": [],
									"orderby": [
										"REC_ID",
										"desc"
									],
									"action": "join",
									"db": "omcargo",
									"table": "TX_DTL_REC",
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

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.billing:billing/ipc_eService_provider_services_npkBilling_billing_billing_Port"; 

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
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.billing:billing">
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
									"whereIn": [],
									"select": [],
									"orderby": [
										"DEL_ID",
										"desc"
									],
									"action": "join",
									"db": "omcargo",
									"table": "TX_DTL_DEL",
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

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.billing:billing/ipc_eService_provider_services_npkBilling_billing_billing_Port"; 

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
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.billing:billing">
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
									"whereIn": [],
									"select": [],
									"orderby": [
										"LUMPS_ID",
										"desc"
									],
									"action": "join",
									"db": "omcargo",
									"table": "TX_DTL_LUMPSUM",
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

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.billing:billing/ipc_eService_provider_services_npkBilling_billing_billing_Port"; 

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
