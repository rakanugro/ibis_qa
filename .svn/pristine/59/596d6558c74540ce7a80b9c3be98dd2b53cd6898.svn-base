<?php
class Booking_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
		
	public function getpackaging()
	{
		
		$xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <ipc:packagingList>
						 <packagingListInterfaceRequest>
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
							   <packagingName></packagingName>
							   <packagingId></packagingId>
							</esbBody>
							<start>?</start>
							<limit>?</limit>
							<page>?</page>
						 </packagingListInterfaceRequest>
					  </ipc:packagingList>
				   </soapenv:Body>
				</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$params = array(
				'login' => 'npk_billing',
				'password' => 'npk_billing',
				'trace' => 0,
				'exceptions' => 0,
				'location' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL',
				'uri' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL'
			);

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'packagingList', 'npk_billing', 'npk_billing');
		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:packagingListResponse"]["_c"]["packagingListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			$arrtemp = array();
			for ($i=0; $i < count($out_param); $i++) {				
				$datapackaging = (object) array (
								"packagingId" => $out_param[$i]['_c']['packagingId']['_v'],
								"packagingName" => $out_param[$i]['_c']['packagingName']['_v']
								);
				array_push($arrtemp,$datapackaging);
			}
			if(! $arrtemp){
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
			else{
				foreach ($arrtemp as $dropdown){
					$dropdownlist[$dropdown->packagingId] = $dropdown->packagingName;
				}
				$finaldropdown = $dropdownlist;
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
		}
	}
	
	
	public function getcomodity()
	{
		$packagingId = $this->input->get('packagingId');
		
		$xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <ipc:comodityList>
						 <comodityListInterfaceRequest>
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
							   <comodityName></comodityName>
							   <comodityId></comodityId>
							   <packagingId>'. $packagingId .'</packagingId>
							</esbBody>
							<start>?</start>
							<limit>?</limit>
							<page>?</page>
						 </comodityListInterfaceRequest>
					  </ipc:comodityList>
				   </soapenv:Body>
				</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$params = array(
				'login' => 'npk_billing',
				'password' => 'npk_billing',
				'trace' => 0,
				'exceptions' => 0,
				'location' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL',
				'uri' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL'
			);

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'terminalList', 'npk_billing', 'npk_billing');
		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:comodityListResponse"]["_c"]["comodityListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			$arrtemp = array();
			for ($i=0; $i < count($out_param); $i++) {				
				$datapackaging = (object) array (
								"comodityId" => $out_param[$i]['_c']['comodityId']['_v'],
								"comodityName" => $out_param[$i]['_c']['comodityName']['_v']
								);
				array_push($arrtemp,$datapackaging);
			}
			if(! $arrtemp){
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
			else{
				foreach ($arrtemp as $dropdown){
					$dropdownlist[$dropdown->comodityId] = $dropdown->comodityName;
				}
				$finaldropdown = $dropdownlist;
				#$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
		}
	}

	public function getunit()
	{
		$packagingId = $this->input->get('packagingId');
		$comodityId = $this->input->get('comodityId');

		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		   <soapenv:Header/>
		   <soapenv:Body>
		      <ipc:unitComodityList>
		         <comodityListInterfaceRequest>
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
		               <comodityName></comodityName>
		               <comodityId>'.$comodityId.'</comodityId>
		               <packagingId>'.$packagingId.'</packagingId>
		            </esbBody>
		            <start>?</start>
		            <limit>?</limit>
		            <page>?</page>
		         </comodityListInterfaceRequest>
		      </ipc:unitComodityList>
		   </soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'unitComodityList', 'npk_billing', 'npk_billing');
		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:unitComodityListResponse"]["_c"]["unitDetailInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			$arrtemp = array();
			for ($i=0; $i < count($out_param); $i++) {				
				$dataunit = (object) array (
								"unitId" => $out_param[$i]['_c']['unitId']['_v'],
								"unitName" => $out_param[$i]['_c']['unitName']['_v']
								);
				array_push($arrtemp,$dataunit);
			}
			if(! $arrtemp){
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
			else{
				foreach ($arrtemp as $dropdown){
					$dropdownlist[$dropdown->unitId] = $dropdown->unitName;
				}
				$finaldropdown = $dropdownlist;
				#$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
		}


	}

	public function getsize()
	{
		$xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		   <soapenv:Header/>
		   <soapenv:Body>
		      <ipc:sizeList>
		         <sizeListInterfaceRequest>
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
		               <serviceId></serviceId>
		            </esbBody>
		            <start>?</start>
		            <limit>?</limit>
		         </sizeListInterfaceRequest>
		      </ipc:sizeList>
		   </soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'sizeList', 'npk_billing', 'npk_billing');
		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:sizeListResponse"]["_c"]["sizeListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			$arrtemp = array();
			for ($i=0; $i < count($out_param); $i++) {				
				$datasize = (object) array (
								"sizeId" => $out_param[$i]['_c']['sizeId']['_v'],
								"sizeName" => $out_param[$i]['_c']['sizeName']['_v']
								);
				array_push($arrtemp,$datasize);
			}
			if(! $arrtemp){
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
			else{
				foreach ($arrtemp as $dropdown){
					$dropdownlist[$dropdown->sizeId] = $dropdown->sizeName;
				}
				$finaldropdown = $dropdownlist;
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
		}
	}

	public function getcondition()
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		   <soapenv:Header/>
		   <soapenv:Body>
		      <ipc:conditionList>
		         <conditionListInterfaceRequest>
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
		               <bankId></bankId>
		            </esbBody>
		            <start>?</start>
		            <limit>?</limit>
		         </conditionListInterfaceRequest>
		      </ipc:conditionList>
		   </soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'conditionList', 'npk_billing', 'npk_billing');
		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:conditionListResponse"]["_c"]["conditionListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			$arrtemp = array();
			for ($i=0; $i < count($out_param); $i++) {				
				$datapackaging = (object) array (
								"conditionId" => $out_param[$i]['_c']['conditionId']['_v'],
								"conditionName" => $out_param[$i]['_c']['conditionName']['_v']
								);
				array_push($arrtemp,$datapackaging);
			}
			if(! $arrtemp){
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
			else{
				foreach ($arrtemp as $dropdown){
					$dropdownlist[$dropdown->conditionId] = $dropdown->conditionName;
				}
				$finaldropdown = $dropdownlist;
				$finaldropdown[''] = " - Pilih - ";
				return $finaldropdown;
			}
		}
	}

	public function getbookingType()
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		   <soapenv:Header/>
		   <soapenv:Body>
		      <ipc:operationList>
		         <operationListInterfaceRequest>
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
		               <serviceId></serviceId>
		            </esbBody>
		            <start>?</start>
		            <limit>?</limit>
		         </operationListInterfaceRequest>
		      </ipc:operationList>
		   </soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'operationList', 'npk_billing', 'npk_billing');
				
		$tampArray = array();

		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:operationListResponse"]["_c"]["operationListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			//print_r($out_param);die;
			for ($i=0; $i < count($out_param); $i++) { 
				$arrPatition = array();
				array_push($arrPatition, $out_param[$i]['_c']['operationId']['_v'], $out_param[$i]['_c']['operationName']['_v']);
				array_push($tampArray, $arrPatition);				
			}
			// print_r($tampArray);die;
			// $throw = json_encode($tampArray);
			return $tampArray;
		}

	}

	public function getListTerminal() {
		$xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		<soapenv:Header/>
		<soapenv:Body>
		   <ipc:terminalList>
			  <terminalListInterfaceRequest>
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
					<terminalName>BANTEN</terminalName>
				 </esbBody>
				 <start>?</start>
				 <limit>?</limit>
				 <page>?</page>
			  </terminalListInterfaceRequest>
		   </ipc:terminalList>
		</soapenv:Body>
	 </soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$params = array(
				'login' => 'npk_billing',
				'password' => 'npk_billing',
				'trace' => 0,
				'exceptions' => 0,
				'location' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL',
				'uri' => 'http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling?WSDL'
			);

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'terminalList', 'npk_billing', 'npk_billing');
				
		$tampArray = array();

		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:terminalListResponse"]["_c"]["terminalListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			// print_r($out_param);die;
			for ($i=0; $i < count($out_param); $i++) { 
				$arrPatition = array();
				array_push($arrPatition, $out_param[$i]['_c']['idPort']['_v'], $out_param[$i]['_c']['terminalPort']['_v'], $out_param[$i]['_c']['terminalName']['_v']);
				array_push($tampArray, $arrPatition);				
			}
			// print_r($tampArray);die;
			// $throw = json_encode($tampArray);
			return $tampArray;
		}
	}

	public function pbmList()
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		   <soapenv:Header/>
		   <soapenv:Body>
		      <ipc:pbmList>
		         <pbmListInterfaceRequest>
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
		               <pbmId></pbmId>
		               <pbmName></pbmName>
		            </esbBody>
		            <start>?</start>
		            <limit>?</limit>
		            <page>?</page>
		         </pbmListInterfaceRequest>
		      </ipc:pbmList>
		   </soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'pbmList', 'npk_billing', 'npk_billing');
				
		$tampArray = array();

		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:pbmListResponse"]["_c"]["pbmListInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			// print_r($out_param);die;
			for ($i=0; $i < count($out_param); $i++) { 
				$arrPatition = array();
				array_push($arrPatition, $out_param[$i]['_c']['idPbm']['_v'], $out_param[$i]['_c']['customerId']['_v'], $out_param[$i]['_c']['customerName']['_v']);
				array_push($tampArray, $arrPatition);				
			}
			return $tampArray;
		}
	}

	public function agentShippingList()
	{
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="http://ddcappipcesb.indonesiaport.co.id/ipc.npk.billing.provider.wsdl:npkBilling">
		   <soapenv:Header/>
		   <soapenv:Body>
		      <ipc:agentShippingList>
		         <agentShippingListInterfaceRequest>
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
		               <agentId></agentId>
		               <agentName></agentName>
		            </esbBody>
		            <start>?</start>
		            <limit>?</limit>
		            <page>?</page>
		         </agentShippingListInterfaceRequest>
		      </ipc:agentShippingList>
		   </soapenv:Body>
		</soapenv:Envelope>';

		$wsdl = "http://10.88.48.57:5555/ws/ipc.eService.provider.soap:npkBilling/ipc_npk_billing_provider_wsdl_npkBilling_Port";

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'agentShippingList', 'npk_billing', 'npk_billing');
				
		$tampArray = array();

		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:agentShippingListResponse"]["_c"]["agentShippingInterfaceResponse"]["_c"]["esbBody"]["_c"]["results"];
			// print_r($out_param);die;
			for ($i=0; $i < count($out_param); $i++) { 
				$arrPatition = array();
				array_push($arrPatition, $out_param[$i]['_c']['idAgent']['_v'], $out_param[$i]['_c']['customerId']['_v'], $out_param[$i]['_c']['customerName']['_v']);
				array_push($tampArray, $arrPatition);				
			}
			return $tampArray;
		}
	}
}

?>