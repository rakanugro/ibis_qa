<?php 
	class delivery_request_model extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
	    }

	    public function getList() {
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
			               <request>{"action":"join","db":"omcargo","table":"TX_HDR_DEL","join":[{"table":"TM_REFF","field1":"TM_REFF.REFF_ID","field2":"TX_HDR_DEL.DEL_STATUS"}],"where":[["TM_REFF.REFF_TR_ID","=","8"],["TX_HDR_DEL.DEL_EXT_LOOP","=","1"], ["DEL_CUST_ID","=","'.$this->session->userdata('customerid_phd').'"], ["TX_HDR_DEL.APP_ID","=","2"]],"whereIn":[],"select":[],"orderby":["DEL_ID","desc"],"limit":0,"page":1,"start":1}</request>
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
	          return json_encode($out_param);
	                  
	        }
	    }
		public function auto_vessel($vessel){

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

		public function auto_no_peb($tgl_peb,$no_peb,$npwp){
		$xml ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.NPK_PEB.'">
   			<soapenv:Header/>
			   <soapenv:Body>
			      <ipc:searchPEB>
			         <searchPEBRequest>
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
			               <username>PLDB</username>
			               <password>PLDB12345</password>
			               <noPEB>'.$no_peb.'</noPEB>
			               <tglPEB>'.$tgl_peb.'</tglPEB>
			               <npwp>'.$npwp.'</npwp>
			            </esbBody>
			         </searchPEBRequest>
			      </ipc:searchPEB>
			   </soapenv:Body>
			</soapenv:Envelope>';

			/*<noPEB>010976</noPEB>
			   <tglPEB>30072019</tglPEB>
			   <npwp>018696153055000</npwp>
			*/
		$wsdl = NPK_PEB_PORT;

		$result = $this->sendcurl_lib->SendCurl($xml, $wsdl, 'searchPEB', 'npk_billing', 'npk_billing');
		if(!$result){
			echo $result;
		}else{
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param= $response["soapenv:Envelope"]["_c"]["soapenv:Body"]["_c"]["ser-root:searchPEBResponse"]["_c"]["searchPEBInterfaceResponse"]["_c"]["esbBody"]["_c"]["npe"]["_c"];

			$result = $out_param['header']['_c']['noNpe']['_v'];

			echo $result;
		}
	}

	public function save ($data) {
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

		//echo $xml; die();

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

	public function update ($id) {
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
						<request>{"action":"viewHeaderDetail","data":["HEADER","DETAIL","SPLIT_NOTA","ALAT","FILE"],"HEADER":{"DB":"omcargo","TABLE":"TX_HDR_DEL","PK":["DEL_ID","'.$id.'"]},"SPLIT_NOTA":{"DB":"omcargo","TABLE":"TX_SPLIT_NOTA","FK":["REQ_NO","del_no"]},"ALAT":{"DB":"omcargo","TABLE":"TX_EQUIPMENT","FK":["REQ_NO","del_no"]},"DETAIL":{"DB":"omcargo","TABLE":"TX_DTL_DEL","FK":["HDR_DEL_ID","del_id"]},"FILE":{"DB":"omcargo","TABLE":"TX_DOCUMENT","FK":["REQ_NO","del_no"]}}</request>
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
			// var_dump($out_param); die();
			return $out_param;
					
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
						<request>{"action":"sendRequest","table":"TX_HDR_DEL","nota_id": 15,"id":"'.$id.'"}</request>
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

		// echo $xml; die();

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
			return $data;
					
		}
	}




	}
 ?>