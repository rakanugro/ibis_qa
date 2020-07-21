<?php
class spps_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    public function getListSpps()
    {
        $arrData = '{
            "orderby": [
                "ID",
                "DESC"
            ],
            "where": [
                [
                    "CUST_NAME",
                    "=",
                    "' . $this->session->userdata('customernamealt_phd') . '"
                ]
            ],
            "action": "index",
            "db": "omuster",
            "table": "V_LIST_SPPS",
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
        };
    }
}
