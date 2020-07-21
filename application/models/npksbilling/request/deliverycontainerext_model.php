<?php 
	class deliverycontainerext_model extends CI_Model {

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
	    							"field1":"TX_HDR_DEL.DEL_STATUS"
	    						}
	    					],
	    					"where":[
	    						["TM_REFF.REFF_TR_ID","=","10"],
	    						["TX_HDR_DEL.DEL_CUST_ID","=","'.$this->session->userdata('customerid_phd').'"],
	    						["TX_HDR_DEL.DEL_EXT_STATUS","=","Y"],
	    						["APP_ID","=","2"]
	    					],
	    					"whereIn":[],
	    					"whereIn2":[],
	    					"whereNotIn":[],
	    					"range":[],
	    					"select":[],
	    					"orderby":["TX_HDR_DEL.DEL_ID","DESC"],
	    					"changeKey":["",""],
	    					"action":"join",
	    					"db":"omuster",
	    					"table":"TX_HDR_DEL",
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
	      					"action":"autoComplete",
	      					"db":"omuster",
	      					"table":"TX_HDR_DEL",
	      					"field":"DEL_NO",
	      					"query":"'.$input.'",
	      					"where": [
	      						["del_status", "=", "3"]
	      					],
	      					"page":"",
	      					"start":"",
	      					"limit":""
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
          			$data[] = array("label"=>$obj->del_no);
        		}

        		echo json_encode($data);
          	}
	    }

	    public function auto_generate_by_noreq($input)
	    {
	    	$arrData = '{
	    					"action":"viewHeaderDetail",
	    					"data":["HEADER","DETAIL","FILE"],
	    					"HEADER":
	    					{
	    						"DB":"omuster",
	    						"TABLE":"TX_HDR_DEL",
	    						"PK":["DEL_NO","'.$input.'"]
	    					},
	    					 "DETAIL": {
						        "DB": "omuster",
						        "TABLE": "TX_DTL_DEL",
						        "WHERE": [
						            [
						                "DEL_DTL_ISACTIVE",
						                "=",
						                "Y"
						            ]
						        ],
						        "FK": [
						            "DEL_HDR_ID",
						            "del_id"
						        ]
						    },
	    					"FILE":
	    					{
	    						"DB":"omuster",
	    						"TABLE":"TX_DOCUMENT",
	    						"FK":["REQ_NO","del_no"]
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
           $arrData = '{
           					"action":"viewHeaderDetail",
           					"data":["HEADER","DETAIL","FILE"],
           					"HEADER":
           					{
           						"DB":"omuster",
           						"TABLE":"TX_HDR_DEL",
           						"PK":["DEL_ID","'.$extension_id.'"]
           					},
           					"DETAIL":
           					{
           						"DB":"omuster",
           						"TABLE":"TX_DTL_DEL",
           						"FK":["DEL_HDR_ID","del_id"]
           					},
           					"FILE":
           					{
           						"DB":"omuster",
           						"TABLE":"TX_DOCUMENT",
           						"FK":["REQ_NO","del_no"]
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
                echo json_encode($out_param);   
            }
        }

        public function send ($id) {
			$arrData = '{
							"action":"sendRequestPLG",
							"service_branch_id" : "4",
							"service_branch_code" : "PTG",
							"nota_id":"16",
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