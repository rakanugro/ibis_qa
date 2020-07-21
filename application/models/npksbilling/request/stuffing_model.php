<?php
class stuffing_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    public function getList($id_nota)
    {
        $arrData = '{
            "action": "join",
            "db": "omuster",
            "table": "TX_HDR_STUFF",
            "join": [
                {
                    "table": "TM_REFF",
                    "field1": "TM_REFF.REFF_ID",
                    "field2": "TX_HDR_STUFF.STUFF_STATUS"
                }
            ],
            "where": [
                [
                    "TM_REFF.REFF_TR_ID",
                    "=",
                    "10"
                ],
                [
                    "TX_HDR_STUFF.STUFF_CUST_ID",
                    "=",
                    "' . $this->session->userdata('customerid_phd') . '"
                ],
                [
                    "TX_HDR_STUFF.STUFF_NOTA",
                    "=",
                    "' . $id_nota . '"
                ],
				[
					"APP_ID",
					"=",
					"2"
				]
            ],
            "whereIn": [],
            "select": [],
            "orderby": [
                "STUFF_ID",
                "desc"
            ],
            "limit": 0,
            "page": 1,
            "start": 1
        }';

        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            echo $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            echo json_encode($out_param);
        }
    }

    public function save_stuff($data)
    {
        $xml = $this->esb_npks->esb_api($data, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            return $result;
            die;
        } else {
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

    public function update_stuff($id)
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
                "TABLE": "TX_HDR_STUFF",
                "PK": [
                    "STUFF_ID",
                    "' . $id . '"
                ]
            },
            "DETAIL": {
                "DB": "omuster",
                "TABLE": "TX_DTL_STUFF",
                "FK": [
                    "STUFF_HDR_ID",
                    "stuff_id"
                ]
            },
            "FILE": {
                "DB": "omuster",
                "TABLE": "TX_DOCUMENT",
                "FK": [
                    "REQ_NO",
                    "stuff_no"
                ]
            }
        }';

        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            return $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            return $out_param;
        }
    }

    public function send($id, $id_nota, $branch_id, $branch_code)
    {
        $arrData = '{
			"action": "sendRequestPLG",
			"nota_id": "' . $id_nota . '",
			"id": "' . $id . '",
			"service_branch_id" : "' . $branch_id . '",
			"service_branch_code" : "' . $branch_code . '"
		}';

        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            return $result;
            die;
        } else {
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

    public function getDocType()
    {
        $arrData = '{
			"query": "",
			"orderby": [],
			"where": [
				[
					"reff_tr_id",
					"=",
					"9"
				]
			],
			"action": "index",
			"db": "omuster",
			"table": "TM_REFF",
			"limit": 0,
			"page": 1,
			"start": 0
		}';

        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            echo $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            //echo json_encode($out_param);

            $json = (array) json_decode($out_param);

            return $json['result'];
        }
    }

    public function get_nota_id()
    {
        $arrData = '{
            "action": "index",
            "db": "mdm",
            "table": "TS_NOTA",
            "where": [
                [
                    "BRANCH_ID",
                    "=",
                    "4"
                ],
                [
                    "BRANCH_CODE",
                    "=",
                    "PTG"
                ],
                [
                    "NOTA_ID_PARENT",
                    "=",
                    "3"
                ],
                [
                    "FLAG_STATUS",
                    "=",
                    "Y"
                ]
            ],
            "orderby": [],
            "limit": 0,
            "page": 1,
            "start": 0
        }';

        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            echo $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            echo json_encode($out_param);
        }
    }
}
