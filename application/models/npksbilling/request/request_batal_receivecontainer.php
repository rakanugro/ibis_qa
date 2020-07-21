<?php 
	class request_batal_receivecontainer extends CI_Model {

	    public function __construct(){
	      	$this->load->database();
	      	$this->load->library('session');
	    }

	    //for list batal
	    public function getListreceivecontainerbatal()
	    {
	    	$arrData = '{
            "action"     : "join",
            "db"         : "omuster",
            "table"      : "TX_HDR_CANCELLED",
            "join"       : 
            [
            {
                "table"  : "TX_HDR_REC",
                "field2" : "TX_HDR_REC.REC_NO",
                "field1" : "TX_HDR_CANCELLED.CANCELLED_REQ_NO"
            },
            {
                "table"  : "TM_REFF",
                "field2" : "TM_REFF.REFF_ID",
                "field1" : "TX_HDR_CANCELLED.CANCELLED_STATUS"
            }
            ], 
            "where"      : [["TM_REFF.REFF_TR_ID", "=", "10"],
                            ["TX_HDR_CANCELLED.CANCELLED_TYPE", "=", "1"],
                            ["TX_HDR_REC.REC_CUST_ID","=","' . $this->session->userdata('customerid_phd') . '"],
							["TX_HDR_CANCELLED.APP_ID", "=", "2" ]  
                            
                        ],
            "whereIn"    : [],
            "whereIn2"   : [],
            "whereNotIn" : [],
            "range"      : [],
            "select"     : [],
            "orderby"    : ["TX_HDR_CANCELLED.CANCELLED_ID", "DESC"],
            "changeKey"  : ["",""],
            "query"      : "",
            "field"      : "",
            "limit"      : 25,
            "page"       : 1,
            "start"      : 0
        }';


			 $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest'); 

		

			$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

		if(!$result){
			echo $result;
			die;
			
		}else{

			$response = $this->xml2array->xml2ary($result['response']);
			//print_r($response);die();
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			echo json_encode($out_param);
		
		}

	}


//end list

	
	public function get_nomor_request($input) {
        $arrData = '{
                                        "action"       : "autoComplete",
                                        "db"           : "omuster",
                                        "table"        : "TX_HDR_REC",
                                        "field"        : "REC_NO",
                                        "query"        : "'.$input.'",
                                         "where"       : 
                                          [
                                            [
                                              "rec_status", "=", "3"
                                            ]
                                          ],
                                        "page"         : "",
                                        "start"        : "",
                                        "limit"        : ""   
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
          $data[] = array("label"=>$obj->rec_no);
        }

        echo json_encode($data);
          }
        }
	    
	    public function auto_generate_by_noreq($input) 
	    {
        $arrData = '{
					    "action": "viewHeaderDetail",
					    "data": [
					        "HEADER",
					        "DETAIL",
					        "FILE"
					    ],
					    "HEADER": {
					        "DB": "omuster",
					        "TABLE": "TX_HDR_REC",
					        "PK": [
					            "REC_NO",
					            "'.$input.'"
					        ]
					    },
					    "DETAIL": {
					        "DB": "omuster",
					        "TABLE": "TX_DTL_REC",
					         "WHERE" : [["rec_dtl_iscancelled", "=","N"]],
					        "FK": [
					            "REC_HDR_ID",
					            "rec_id"
					        ]
					    },
					    "FILE": {
					        "DB": "omuster",
					        "TABLE": "TX_DOCUMENT",
					        "FK": [
					            "REQ_NO",
					            "rec_no"
					        ]
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

         public function preview($id)
	    {

					
               $arrData = '{
		               "action": "viewHeaderDetail",
		                "data": [
		                    "HEADER",
		                    "HEADER_REQ",
		                    "DETAIL",
		                    "FILE"
		                ],
		                "HEADER": {
		                    "DB": "omuster",
		                    "TABLE": "TX_HDR_CANCELLED",
		                    "PK": [
		                        "CANCELLED_ID",
		                        "'.$id.'"
		                    ]
		                },
		                "HEADER_REQ": {
		                    "DB"     : "omuster",
		                    "TABLE"  : "TX_HDR_REC",
		                    "FK"     : ["REC_NO","cancelled_req_no"]
		                },
		                "DETAIL": {
		                    "DB"    : "omuster",
		                    "TABLE" : "TX_DTL_CANCELLED",
		                    "JOIN"  : [
		                        {
		                            "table" : "TX_DTL_REC",
		                            "field1" : "TX_DTL_CANCELLED.CANCL_CONT",
		                            "field2" : "TX_DTL_REC.REC_DTL_CONT"
		                            
		                        }],
		                    "FK": [
		                        "CANCL_HDR_ID",
		                        "cancelled_id"
		                    ]
		                },
		                "FILE": {
		                    "DB"     : "omuster",
		                    "TABLE"  : "TX_DOCUMENT",
		                    "FK"     : ["REQ_NO","cancelled_req_no"]
		                }
		            }';

			 $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		

			$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

		if(!$result){
			echo $result;
			die;
			
		}else{

			$response = $this->xml2array->xml2ary($result['response']);
			//print_r($response);die();
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			echo json_encode($out_param);
		
		}

	}

	

	
	public function save_request($jsonData)
	{

		$arrData = ''.$jsonData.'';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');
		//print_r($xml);die;
		

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'storeService', 'npk_billing', 'npk_billing');

		if(!$result){
			echo $result;
			die;
			
		}else{

			 $response = $this->xml2array->xml2ary($result['response']);
             $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
             $header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
                   // print_r($response);die;
              $data = array(
                   "success" => $header,
                    "data" => $out_param
                );
    
             return json_encode($data);    
		
		}




	}       

	public function update_request($jsonData)
	{

		$arrData = ''.$jsonData.'';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');
		//print_r($xml);die;
		

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'storeService', 'npk_billing', 'npk_billing');

		if(!$result){
			echo $result;
			die;
			
		}else{

			 $response = $this->xml2array->xml2ary($result['response']);
             $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
             $header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
                   // print_r($response);die;
              $data = array(
                   "success" => $header,
                    "data" => $out_param
                );
    
             return json_encode($data);    
		
		}

		


	}       


	public function send ($id) {

			$arrData = '{
                    "action" : "sendRequestPLG",
                    "nota_id" :"1", 
                    "id" : "'.$id.'" ,
                    "canceled" : "true"
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