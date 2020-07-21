<?php
class appbtlrec_model extends CI_Model
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
                    "table": "TX_HDR_REC",
                    "field2": "TX_HDR_REC.REC_NO",
                    "field1": "TX_HDR_CANCELLED.CANCELLED_REQ_NO"
                },
                {
                    "table": "TM_REFF",
                    "field2": "TM_REFF.REFF_ID",
                    "field1": "TX_HDR_CANCELLED.CANCELLED_STATUS"
                }
            ],
            "where": [
                [
                    "TM_REFF.REFF_TR_ID",
                    "=",
                    "10"
                ],
                [
                    "TX_HDR_CANCELLED.CANCELLED_TYPE",
                    "=",
                    "1"
                ],
                [
                    "TX_HDR_CANCELLED.CANCELLED_BRANCH_ID",
                    "=",
                    "4"
                ],
                [
                    "TX_HDR_CANCELLED.CANCELLED_BRANCH_CODE",
                    "=",
                    "PTG"
                ],
                [
                    "TX_HDR_CANCELLED.CANCELLED_STATUS",
                    "=",
                    "2"
                ],
                [
                    "TX_HDR_CANCELLED.APP_ID",
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
                "TX_HDR_CANCELLED.CANCELLED_ID",
                "DESC"
            ],
            "changeKey": [
                "",
                ""
            ],
            "action": "join",
            "db": "omuster",
            "table": "TX_HDR_CANCELLED",
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

    public function get_cancel_id($id)
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
                "TABLE": "TX_HDR_CANCELLED",
                "PK": [
                    "CANCELLED_REQ_NO",
                    "' . $id . '"
                ]
            },
            "DETAIL": {
                "DB": "omuster",
                "TABLE": "TX_DTL_CANCELLED",
                "FK": [
                    "CANCL_HDR_ID",
                    "cancelled_id"
                ]
            },
            "FILE": {
                "DB": "omuster",
                "TABLE": "TX_DOCUMENT",
                "FK": [
                    "REQ_NO",
                    "cancelled_no"
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

    public function get_data($id)
    {
        $arrData = '{
            "action": "viewHeaderDetail",
            "data": [
                "HEADER",
                "DETAIL"
            ],
            "HEADER": {
                "DB": "omuster",
                "TABLE": "TX_HDR_REC",
                "PK": [
                    "REC_ID",
                    "' . $id . '"
                ]
            },
            "DETAIL": {
                "DB": "omuster",
                "TABLE": "TX_DTL_REC",
                "WHERE": [
                    [
                        "REC_DTL_ISCANCELLED",
                        "=",
                        "Y"
                    ]
                ],
                "FK": [
                    "REC_HDR_ID",
                    "rec_id"
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

    public function approve($id)
    {
        $arrData = '{
            "action" : "approvalRequestPLG",
            "nota_id" : "1",
            "id" : "' . $id . '",
            "msg" : "",
            "approved" : "true",
            "canceled": "true",
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

    public function reject($id, $remarks)
    {
        $arrData = '{
            "action" : "approvalRequestPLG",
            "nota_id" : "1",
            "id" : "' . $id . '",
            "msg" : "' . $remarks . '",
            "approved" : "false",
            "canceled": "true",
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
