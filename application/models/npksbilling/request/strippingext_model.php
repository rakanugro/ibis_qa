<?php 
	class strippingext_model extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
	    }

	    public function getList ()
	    {
	    	$arrData = '{
	    					"join":[
	    					{
	    						"table":"TM_REFF",
	    						"field2":"TM_REFF.REFF_ID",
	    						"field1":"TX_HDR_STRIPP.STRIPP_STATUS"
	    					}
	    				],
	    				"where":[
	    					["TM_REFF.REFF_TR_ID","=","10"],
	    					["TX_HDR_STRIPP.STRIPP_CUST_ID","=","'.$this->session->userdata('customerid_phd').'"],
	    					["APP_ID","=","2"],
	    					["STRIPP_EXT_STATUS","=","Y"]
	    				],
	    				"whereIn":[],
	    				"whereIn2":[],
	    				"whereNotIn":[],
	    				"range":[],
	    				"select":[],
	    				"orderby":["TX_HDR_STRIPP.STRIPP_ID","DESC"],
	    				"changeKey":["",""],
	    				"action":"join",
	    				"db":"omuster",
	    				"table":"TX_HDR_STRIPP",
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

	    public function get_nomor_request($input) {

	      	$arrData = '{
	      					"query":"'.$input.'",
	      					"orderby":["STRIPP_ID","DESC"],
	      					"selected":[],
	      					"whereIn":[],
	      					"where":[
	      						["STRIPP_STATUS","=","3"]
	      					],
	      					"action":"autoComplete",
	      					"db":"omuster",
	      					"table":"TX_HDR_STRIPP",
	      					"field":"STRIPP_NO",
	      					"limit":0,
	      					"page":1,
	      					"start":0
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
              
              	$json = (array)json_decode($out_param);
        		$data = array();

        		foreach ($json['result'] as $obj) {
          			$data[] = array("label"=>$obj->stripp_no);
        		}

        		echo json_encode($data);
          	}
	    }


	    public function auto_generate_by_noreq($search)
	    {
	    	$arrData = '{
	    					"action":"viewHeaderDetail",
	    					"data":["HEADER","DETAIL","FILE"],
	    					"HEADER":{
	    						"DB":"omuster",
	    						"TABLE":"TX_HDR_STRIPP",
	    						"PK":["STRIPP_NO","'.$search.'"]
	    					},
	    					"DETAIL":{
	    						"DB":"omuster",
	    						"TABLE":"TX_DTL_STRIPP",
	    						"FK":["STRIPP_HDR_ID","stripp_id"]
	    					},
	    					"FILE":{
	    						"DB":"omuster",
	    						"TABLE":"TX_DOCUMENT",
	    						"FK":["REQ_NO","stripp_no"]
	    					}
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
	              
	           	$json = (array)json_decode($out_param);

	        	return $json;
          	}

	    }

	    public function save_extension($jsonData) {
           	
           	$arrData = ''.$jsonData.'';
    
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

	    public function get_extension_views($extension_id) {
            $arrData = '{"action":"viewHeaderDetail","data":["HEADER","DETAIL","FILE","NOTA"],"HEADER":{"DB":"omuster","TABLE":"TX_HDR_STRIPP","PK":["STRIPP_ID","'.$extension_id.'"]},"DETAIL":{"DB":"omuster","TABLE":"TX_DTL_STRIPP","FK":["STRIPP_HDR_ID","stripp_id"]},"FILE":{"DB":"omuster","TABLE":"TX_DOCUMENT","FK":["REQ_NO","stripp_no"]},"NOTA":{"DB":"mdm","TABLE":"TS_NOTA","FK":["NOTA_ID","stripp_nota"]}}';

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

        public function send ($id) {
			$arrData = '{
							"action":"sendRequestPLG",
							"service_branch_id" : "4",
							"service_branch_code" : "PTG",
							"nota_id":"18",
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