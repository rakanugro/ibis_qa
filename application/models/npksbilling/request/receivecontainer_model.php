<?php 
	class receivecontainer_model extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
	    }

	    public function getList ()
	    {
	    	$arrData = '{
	    					"join":
	    					[{
	    						"table":"TM_REFF",
	    						"field2":"TM_REFF.REFF_ID",
	    						"field1":"TX_HDR_REC.REC_STATUS"
	    					}],
	    					"where":
	    					[
	    						["TM_REFF.REFF_TR_ID","=","10"],
	    						["TX_HDR_REC.REC_CUST_ID","=","'.$this->session->userdata('customerid_phd').'"],
	    						["APP_ID","=","2"]
	    					],
	    					"whereIn":[],
	    					"whereIn2":[],
	    					"whereNotIn":[],
	    					"range":[],
	    					"select":[],
	    					"orderby":["TX_HDR_REC.REC_ID","DESC"],
	    					"changeKey":["",""],
	    					"action":"join",
	    					"db":"omuster",
	    					"table":"TX_HDR_REC",
	    					"query":"",
	    					"field":"",
	    					"page":1,
	    					"start":0,
	    					"limit":25
	    				}';
	    	
			$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest'); 

	        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
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


	    public function save($json) {
           	$arrData = ''.$json.'';
    
            $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest'); 

            $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'storeService', 'npk_billing', 'npk_billing');
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
    
                return json_encode($data);    
            }
        }

        public function update ($id) {
			$arrData = '{
							"action":"viewHeaderDetail",
							"data":["HEADER","DETAIL","FILE"],
							"HEADER":
							{
								"DB":"omuster",
								"TABLE":"TX_HDR_REC",
								"PK":["REC_ID","'.$id.'"]
							},
							"DETAIL":
							{
								"DB":"omuster",
								"TABLE":"TX_DTL_REC",
								"FK":["REC_HDR_ID","rec_id"]
							},
							"FILE":
							{
								"DB":"omuster",
								"TABLE":"TX_DOCUMENT",
								"FK":["REQ_NO","rec_no"]
							}
						}';

			$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest'); 

			$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
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
				return $out_param;
						
			}
		}

		public function send ($id) {
			$arrData = '{
							"action":"sendRequestPLG",
							"service_branch_id" : "4",
							"service_branch_code" : "PTG",
							"nota_id":"1",
							"id":"'.$id.'"
						}';

			$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest'); 

			$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'storeService', 'npk_billing', 'npk_billing');
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