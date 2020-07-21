<?php
class invoice_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    public function getListInvoice()
    {
        $arrData = '{
            "join": [
                {
                    "table": "TM_REFF B",
                    "field1": "B.REFF_ID",
                    "field2": "TX_HDR_NOTA.NOTA_PAID"
                }
            ],
            "where": [
                [
                    "B.REFF_TR_ID",
                    "=",
                    "15"
                ],
                [
                    "TX_HDR_NOTA.NOTA_STATUS",
                    "=",
                    "3"
                ],
                [
                    "TX_HDR_NOTA.NOTA_PAID",
                    "=",
                    "Y"
                ],
				[
					"TX_HDR_NOTA.NOTA_CUST_ID",
					"=",
					"' . $this->session->userdata('customerid_phd') . '"
				]
            ],
            "orderby": [
                "TX_HDR_NOTA.NOTA_ID",
                "DESC"
            ],
            "action": "join",
            "db": "omuster",
            "table": "TX_HDR_NOTA",
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
