<?php
class appbookstuff_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    public function getList()
    {
        $arrData = '{
            "join": [
                {
                    "table": "TM_REFF",
                    "field2": "TM_REFF.REFF_ID",
                    "field1": "TX_HDR_STUFF.STUFF_STATUS"
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
                    "APP_ID",
                    "=",
                    "2"
                ],
                [
                    "TX_HDR_STUFF.STUFF_STATUS",
                    "=",
                    "2"
                ]
            ],
            "whereIn": [],
            "whereIn2": [],
            "whereNotIn": [],
            "range": [],
            "select": [],
            "orderby": [
                "TX_HDR_STUFF.STUFF_ID",
                "DESC"
            ],
            "changeKey": [
                "",
                ""
            ],
            "action": "join",
            "db": "omuster",
            "table": "TX_HDR_STUFF",
            "query": "",
            "field": "",
            "page": 1,
            "start": 0,
            "limit": 25
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

    public function getTarif($id, $nota_id)
    {
        $arrData = '{
			"action": "viewTempTariffPLG",
			"nota_id": "' . $nota_id . '",
			"id": "' . $id . '"
		}';

        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'viewService', 'viewServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

        if (!$result) {
            return $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:viewServiceResponse']['_c']['viewServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            return $out_param;
        }
    }

    public function approve($id, $nota_id)
    {
        $arrData = '{
            "action" : "approvalRequestPLG",
            "nota_id" : "' . $nota_id . '",
            "id" : "' . $id . '",
            "msg" : "",
            "approved" : "true",
            "service_branch_id" : "4",
			"service_branch_code" : "PTG"
        }';
        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            return $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            return json_encode($out_param);
        }
    }

    public function reject($id, $nota_id, $remarks)
    {
        $arrData = '{
            "action" : "approvalRequestPLG",
            "nota_id" : "' . $nota_id . '",
            "id" : "' . $id . '",
            "msg" : "' . $remarks . '",
            "approved" : "false",
            "service_branch_id" : "4",
			"service_branch_code" : "PTG"
        }';
        $xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');

        $result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
        if (!$result) {
            return $result;
            die;
        } else {
            $response = $this->xml2array->xml2ary($result['response']);
            $out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
            return json_encode($out_param);
        }
    }
}
