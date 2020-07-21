<?php
class proforma_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}

	public function getListProforma()
	{
		$arrData = '{
			"join": [
				{
					"table": "TM_REFF B",
					"field1": "B.REFF_ID",
					"field2": "TX_HDR_NOTA.NOTA_STATUS"
				}
			],
			"where": [
				[
					"B.REFF_TR_ID",
					"=",
					"14"
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
		}
	}

	public function approve_proforma($action, $nota_id)
	{
		$arrData = '{
			"action": "' . $action . '",
			"service_branch_id" : "4",
			"service_branch_code" : "PTG",
			"nota_id": "' . $nota_id . '",
			"approved": "true"
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
			echo json_encode($out_param);
			// return $data;
		}
	}

	public function reject_proforma($action, $nota_id)
	{
		$arrData = '{
			"action": "' . $action . '",
			"service_branch_id" : "4",
			"service_branch_code" : "PTG",
			"nota_id": "' . $nota_id . '",
			"approved": "false"
		}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

		if (!$result) {
			echo $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];

			$data = array(
				"success" => $header,
				"data" => $out_param
			);
			echo json_encode($out_param);
			// return $data;
		}
	}

	// public function getBankList()
	// {
	// 	$arrData = '{
	//         "action": "index",
	//         "db": "mdm",
	//         "table": "TM_BANK",
	//          "where": [["BRANCH_CODE","=","' . $this->session->userdata('branch_code_npks') . '"],["BRANCH_ID","=","' . $this->session->userdata('branch_id_npks') . '"]],
	//         "orderby": ["BANK_CODE", "asc"],
	//         "limit": 0,
	//         "page": 1,
	//         "start": ""
	//     }';

	// 	$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

	// 	$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

	// 	if (!$result) {
	// 		echo $result;
	// 		die;
	// 	} else {
	// 		$response = $this->xml2array->xml2ary($result['response']);
	// 		$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
	// 		$json = (array) json_decode($out_param);
	// 		return $json['result'];
	// 	}
	// }

	// public function detail_proforma($id)
	// {
	// 	$arrData = '{
	//         "join": [
	//             {
	//                 "table": "TX_HDR_NOTA",
	//                 "field1": "TX_HDR_NOTA.NOTA_ID",
	//                 "field2": "TX_DTL_NOTA.NOTA_HDR_ID"
	//             }
	//         ],
	//         "where": [
	//             [
	//                 "TX_DTL_NOTA.NOTA_HDR_ID",
	//                 "=",
	//                 "' . $id . '"
	//             ]
	//         ],
	//         "whereIn": [],
	//         "select": [],
	//         "orderby": [
	//             "NOTA_DTL_ID",
	//             "desc"
	//         ],
	//         "action": "join",
	//         "db": "omuster",
	//         "table": "TX_DTL_NOTA",
	//         "limit": 0,
	//         "page": 1,
	//         "start": "",
	//         "filter": ""
	//     }';

	// 	$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

	// 	$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

	// 	if (!$result) {
	// 		echo $result;
	// 		die;
	// 	} else {
	// 		$response = $this->xml2array->xml2ary($result['response']);
	// 		$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
	// 		$json = (array) json_decode($out_param);
	// 		return $json['result'];
	// 	}
	// }

	// public function save_payment_cash($data)
	// {
	// 	$xml = $this->esb_npks->esb_api($data, NPK_XML, 'storeService', 'storeServiceInterfaceRequest');

	// 	$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');

	// 	if (!$result) {
	// 		return $result;
	// 		die;
	// 	} else {
	// 		$response = $this->xml2array->xml2ary($result['response']);
	// 		$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
	// 		$header = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:storeServiceResponse']['_c']['storeServiceInterfaceResponse']['_c']['esbHeader']['_c']['responseCode']['_v'];
	// 		$data = array(
	// 			"success" => $header,
	// 			"data" => $out_param
	// 		);
	// 		echo json_encode($out_param);
	// 	}
	// }
}
