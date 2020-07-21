<?php
class Mdm_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}

	public function get_terminalList($id_sub_group)
	{

		$query = "select a.id_sub_group, a.branch_id, a.branch_code, a.id_terminal, b.terminal_name
					  from tm_branch a left join mst_terminal b on a.id_port = b.id_port 
					  where '$id_sub_group' like '%' || a.id_sub_group || '%'";

		$query 	= $this->db->query($query);
		return $query->result_array();
	}

	public function pbm($params, $branch_id)
	{

		$arrData = '{
							"query":"' . $params . '",
							"orderby":["CUSTOMER_ID_SEQ","DESC"],
							"selected":[],
							"whereIn":[],
							"where":[
								["IS_PBM","=","Y"],
								["BRANCH_ID","=","' . $branch_id . '"]
							],
							"action":"autoComplete",
							"db":"mdm",
							"table":"TM_CUSTOMER",
							"field":"NAME",
							"limit":0,
							"page":1,
							"start":0
						}';
		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');
		//print_r($xml);die();

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
					"label" => $obj->alt_name,
					"pbm_id" => $obj->customer_id
				);
			}
			// print_r($data);die;
			echo json_encode($data);
		}
	}

	public function stackby($params, $branch_id)
	{

		$arrData = '{
							"query":"' . $params . '",
							"orderby":["CUSTOMER_ID_SEQ","DESC"],
							"selected":[],
							"whereIn":[],
							"where":[["BRANCH_ID","=","' . $branch_id . '"]],
							"action":"autoComplete",
							"db":"mdm",
							"table":"TM_CUSTOMER",
							"field":"NAME",
							"limit":0,
							"page":1,
							"start":0
						}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
					"label" => $obj->alt_name,
					"pbm_id" => $obj->customer_id
				);
			}
			// print_r($data);die;
			echo json_encode($data);
		}
	}

	public function from()
	{

		$arrData = '{
	    					"query":"",
	    					"orderby":[],
	    					"where":[["reff_tr_id","=","5"]],
	    					"action":"index",
	    					"db":"omuster",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function to()
	{

		$arrData = '{
	    					"query":"",
	    					"orderby":[],
	    					"where":[["reff_tr_id","=","5"]],
	    					"action":"index",
	    					"db":"omuster",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function paymethod()
	{
		$arrData = '{
	       				"query":"",
	       				"orderby":[],
	       				"where":[
	       					["reff_tr_id","=","8"],
	       					["reff_id","=","1"]
	       				],
	       				"action":"index",
	       				"db":"omuster",
	       				"table":"TM_REFF",
	       				"limit":0,
	       				"page":1,
	       				"start":0
	       			}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function paymethod_fumi()
	{
		$arrData = '{
	       					"query":"",
	       					"orderby":[],
	       					"where":[["reff_tr_id","=","8"],["reff_order","=","2"]],
	       					"action":"index",
	       					"db":"omuster",
	       					"table":"TM_REFF",
	       					"limit":0,
	       					"page":1,
	       					"start":0
	       				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function vessel($params)
	{
		$arrData = '{
	   						"action":"getVesselNpks",
	   						"query":"' . strtoupper($params) . '",
	   						"limit":0,
	   						"page":1,
	   						"start":1
	   					}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'viewService', 'viewServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'viewService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:viewServiceResponse']['_c']['viewServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$label = "Vessel: " . $obj->vessel . " || " . "Voyage:  (" . $obj->voyageIn . "/" . $obj->voyageOut . ")";
				$data[] = array(
					"label" => $label,
					"name" => $obj->vessel,
					"eta" => $obj->eta,
					"etd" => $obj->etd,
					"etb" => $obj->etb,
					"ata" => $obj->ata,
					"atd" => $obj->atd,
					"voyageIn" => $obj->voyageIn,
					"voyageOut" => $obj->voyageOut,
					"vesselCode" => $obj->vesselCode,
					"idKade" => $obj->idKade,
					"idVsbVoyage" => $obj->idVsbVoyage,
					"voyage" => $obj->voyage,
					"openStack" => $obj->openStack,
					"idUkkSimop" => $obj->idUkkSimop
				);
			}
			echo json_encode($data);
		}
	}

	public function type_document()
	{
		$arrData = '{
	   						"query":"",
	   						"parameter":
	   							{
	   								"data":["reff_tr_id"],
	   								"operator":["="],
	   								"value":["9"],
	   								"type":""
	   						},
	   						"action":"filter",
	   						"db":"omuster",
	   						"table":"TM_REFF",
	   						"page":1,
	   						"start":0,
	   						"limit":25
	   					}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function customer($params, $branch_id)
	{
		$arrData = '{
						    "action": "autoComplete",
						    "db": "mdm",
						    "table": "TM_CUSTOMER",
						    "field": "NAME",
						    "query": "' . $params . '",
						    "orderby":["NAME","desc"],
						    "selected": [],
						    "whereIn": [],
						   	"where":[
						   		["BRANCH_ID","=","' . $branch_id . '"],
						   	],
						    "limit": 0,
						    "page": 1,
						    "start": 0
						}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
					"label" => $obj->alt_name,
					"customer_id" => $obj->customer_id
				);
			}
			// print_r($data);die;
			echo json_encode($data);
		}
	}

	public function size()
	{
		$arrData = '{
	    					"query":"",
	    					"action":"index",
	    					"db":"mdm",
	    					"table":"TM_CONT_SIZE",
	    					"page":"",
	    					"start":"",
	    					"limit":""
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function type()
	{
		$arrData = '{
	    					"query":"",
	    					"action":"index",
	    					"db":"mdm",
	    					"table":"TM_CONT_TYPE",
	    					"page":"",
	    					"start":"",
	    					"limit":""
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function status()
	{
		$arrData = '{
	    					"query":"",
	    					"action":"index",
	    					"db":"mdm",
	    					"table":"TM_CONT_STATUS",
	    					"page":"",
	    					"start":"",
	    					"limit":""
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function sifat()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":["reff_tr_id","asc"],
	    					"where":[["reff_tr_id","=","6"]],
	    					"action":"index",
	    					"db":"mdm",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":1
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function barang()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":["COMMODITY_NAME","asc"],
	    					"action":"index",
	    					"db":"mdm",
	    					"table":"TM_COMMODITY",
	    					"limit":0,
	    					"page":1,
	    					"start":1
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function via()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":[],
	    					"where":[["reff_tr_id","=","19"]],
	    					"action":"index",
	    					"db":"omuster",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function getDocType()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":[],
	    					"where":[["reff_tr_id","=","9"]],
	    					"action":"index",
	    					"db":"omuster",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":0
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

	public function sifat_cargo()
	{
		$arrData = '{
	    					"q":"",
	    					"where":[],
	    					"whereIn":["CHARACTER_ID",["1","2","0"]],
	    					"whereNotIn":[],
	    					"orderby":["CHARACTER_NAME","desc"],
	    					"action":"whereIn",
	    					"db":"mdm",
	    					"table":"TM_CHARACTER",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function kemasan_cargo()
	{
		$arrData = '{
					            "action"        : "autoComplete",
					            "db"            : "mdm",
					            "table"         : "TM_PACKAGE",
					            "field"         : "PACKAGE_NAME",
					            "query"         : "",
					            "where"         : [["NVL(PACKAGE_PARENT_CODE, 0)","=", "0"]],
					            "orderby"       : ["PACKAGE_NAME", "asc"],
					            "limit"         : 0,
					            "page"          : 1,
					            "start"         : 0
					        }';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function barang_cargo($id)
	{
		$arrData = '{
					            "action": "join",
					            "db": "mdm",
					            "table": "TM_COMMODITY",
					            "field" : ["TM_COMMODITY.commodity_name"],
					            "query" : "",
					            "join": [
					            {
					                "table": "TM_PACKAGE",
					                "field1": "TM_PACKAGE.PACKAGE_ID",
					                "field2": "TM_COMMODITY.PACKAGE_ID"
					            }
					            ],
					            "where":[["TM_PACKAGE.package_parent_id","=","' . $id . '"]],
					            "select": [],
					            "orderby": [
					            "COMMODITY_NAME",
					            "asc"
					            ],
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
			return json_encode($out_param);
		}
	}

	public function satuan_cargo()
	{
		$arrData = '{
	    					"q":"",
	    					"filter_1":
	    					{
	    						"data":["unit_subject"],
	    						"operator":["="],
	    						"value":["3"],
	    						"type":"or"
	    					},
	    					"table":
	    					[
	    						"TS_UNIT",
	    						"TM_UNIT"],
	    						"schema":["omcargo","mdm"],
	    						"relation":["unit_id","unit_id"],
	    						"filter_2":{"data":[],
	    						"operator":[],
	    						"value":[],
	    						"type":""
	    					},
	    					"action":"join_filter",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function via_cargo()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":[],
	    					"where":[["reff_tr_id","=","17"]],
	    					"action":"index",
	    					"db":"omuster",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function no_container($params, $branch_id)
	{
		$arrData = '{
	    					"query":"' . $params . '",
	    					"orderby":[],
	    					"selected":[],
	    					"whereIn":[],
	    					"where":[
	    						["BRANCH_ID","=","' . $branch_id . '"],
	    						["CONT_LOCATION","=","IN_YARD"]
	    					],
	    					"action":"autoComplete",
	    					"db":"omuster",
	    					"table":"TS_CONTAINER",
	    					"field":"CONT_NO",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');
		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
					"label" => $obj->cont_no,
					"size" => $obj->cont_size,
					"type" => $obj->cont_type
				);
			}
			echo json_encode($data);
		}
	}

	function no_cont_rec($params, $branch_id)
	{
		$arrData = '{
					    "query": "'.$params.'",
					    "orderby": [],
					    "selected": [],
					    "whereNotIn": [
					        "CONT_LOCATION",
					        ["GATI","IN_YARD"]
					    ],
					    "where": [
					        ["BRANCH_ID","=","'.$branch_id.'"],
					        ["BRANCH_CODE","=","PTG"]
					    ],
					    "action": "autoComplete",
					    "db": "omuster",
					    "table": "TS_CONTAINER",
					    "field": "CONT_NO",
					    "limit": 0,
					    "page": 1,
					    "start": 0
					}';
		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');
		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
					"label" => $obj->cont_no,
					"size" => $obj->cont_size,
					"type" => $obj->cont_type
				);
			}
			echo json_encode($data);
		}
	}

	public function type_fumigasi()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":["REFF_ORDER","ASC"],
	    					"selected":[],
	    					"whereIn":[],
	    					"where":[["REFF_TR_ID","=","12"]],
	    					"whereNotIn":[],
	    					"action":"autoComplete",
	    					"db":"mdm",
	    					"table":"TM_REFF",
	    					"field":"",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function no_tl()
	{
		$arrData = '{
						    "query": "",
						    "orderby": ["reff_tr_id","asc"],
						    "where": [
						        ["reff_tr_id","=","6"],
						        ["reff_order","=","1"]
						    ],
						    "action": "index",
						    "db": "mdm",
						    "table": "TM_REFF",
						    "limit": 0,
						    "page": 1,
						    "start": 1
						}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function to_cargo()
	{
		$arrData = '{
						    "query": "",
						    "orderby": [],
						    "where": [
						        ["reff_tr_id","=","17"]
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
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function stacking()
	{
		$arrData = '{
	    					"query":"",
	    					"orderby":[],
	    					"where":[["reff_tr_id","=","21"]],
	    					"action":"index",
	    					"db":"omuster",
	    					"table":"TM_REFF",
	    					"limit":0,
	    					"page":1,
	    					"start":0
	    				}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	//model to untuk container
	public function del_to()
	{
		$arrData = '{
                "query": "",
                "orderby": [],
                "where": [
                    [
                        "reff_tr_id",
                        "=",
                        "5"
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
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	//model from cargo
	public function from_cargo()
	{
		$arrData = '{
                "query": "",
                "orderby": [],
                "where": [
                    [
                        "reff_tr_id",
                        "=",
                        "25"
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
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	//model barang tamp
	public function barang_tamp($id)
	{
		$arrData = '{
                "action": "join",
                "db": "mdm",
                "table": "TM_COMMODITY",
                "field": [
                    "TM_COMMODITY.commodity_name"
                ],
                "query": "",
                "join": [
                    {
                        "table": "TM_PACKAGE",
                        "field1": "TM_PACKAGE.PACKAGE_ID",
                        "field2": "TM_COMMODITY.PACKAGE_ID"
                    }
                ],
                "where": [
                    [
                        "TM_PACKAGE.package_parent_id",
                        "=",
                        "' . $id . '"
                    ]
                ],
                "select": [],
                "orderby": [
                    "COMMODITY_NAME",
                    "asc"
                ],
                "limit": 0,
                "page": 1,
                "start": 0
            }';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	//model ExBatalSP2
	public function exbatalsp2()
	{
		$arrData = '{
                "query": "",
                "orderby": [
                    "reff_tr_id",
                    "asc"
                ],
                "where": [
                    [
                        "reff_tr_id",
                        "=",
                        "6"
                    ]
                ],
                "action": "index",
                "db": "mdm",
                "table": "TM_REFF",
                "limit": 0,
                "page": 1,
                "start": 1
            }';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');

		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			return json_encode($out_param);
		}
	}

	public function no_si($params, $branch_id)
	{
		$arrData = '{
					    "query": "' . $params . '",
					    "join": [
					        {
					            "table": "TX_HDR_REC_CARGO B",
					            "field1": "A.REC_CARGO_HDR_ID",
					            "field2": "B.REC_CARGO_ID"
					        },
					        {
					            "table": "TX_REALISASI_CARGO C",
					            "field1": "B.REC_CARGO_NO",
					            "field2": "C.REAL_REQ_NO"
					        }
					    ],
					    "where": [
					        ["B.REC_CARGO_BRANCH_ID","=","' . $branch_id . '"],
					        ["B.REC_CARGO_BRANCH_CODE","=","PTG"],
					        ["B.REC_CARGO_STATUS","=","5"]
					    ],
					    "field": "REC_CARGO_DTL_SI_NO",
					    "orderby": "",
					    "action": "join",
					    "table": "TX_DTL_REC_CARGO A",
					    "db": "omuster",
					    "page": 1,
					    "start": 0,
					    "limit": 0
					}';

		$xml = $this->esb_npks->esb_api($arrData, NPK_XML, 'indexService', 'indexServiceInterfaceRequest');
		$result = $this->sendcurl_lib->SendCurl($xml, NPK_WSDL, 'indexService', 'npk_billing', 'npk_billing');
		if (!$result) {
			return $result;
			die;
		} else {
			$response = $this->xml2array->xml2ary($result['response']);
			$out_param = $response['soapenv:Envelope']['_c']['soapenv:Body']['_c']['ser-root:indexServiceResponse']['_c']['indexServiceInterfaceResponse']['_c']['esbBody']['_c']['response']['_v'];
			$json = (array) json_decode($out_param);
			$data = array();

			foreach ($json['result'] as $obj) {
				$data[] = array(
					"label" => $obj->rec_cargo_dtl_si_no,
					"qty" => $obj->rec_cargo_dtl_qty,
					"sifat_id" => $obj->rec_cargo_dtl_character_id,
					"sifat_name" => $obj->rec_cargo_dtl_character_name,
					"pkg_id" => $obj->rec_cargo_dtl_pkg_id,
					"pkg_name" => $obj->rec_cargo_dtl_pkg_name,
					"cmdty_id" => $obj->rec_cargo_dtl_cmdty_id,
					"cmdty_name" => $obj->rec_cargo_dtl_cmdty_name,
					"pkg_parent_id" => $obj->rec_cargo_dtl_pkg_parent_id,
					"satuan_id" => $obj->rec_cargo_dtl_unit_id,
					"satuan_name" => $obj->rec_cargo_dtl_unit_name,
					"stack_date" => $obj->real_date
				);
			}
			echo json_encode($data);
		}
	}

	//cek container
	public function cek_container($params)
	{
		$arrData = '{
			"action": "whereIn",
			"db": "omuster",
			"table": "TS_CONTAINER",
			"where": [
				[
					"BRANCH_ID",
					"=",
					"4"
				],
				[
					"CONT_NO",
					"=",
					"' . $params . '"
				],
				[
					"CONT_LOCATION",
					"=",
					"IN_YARD"
				],
				[
					"BRANCH_CODE",
					"=",
					"PTG"
				]
			],
			"whereIn": [],
			"whereNotIn": [],
			"orderby": [
				"CONT_COUNTER",
				"desc"
			],
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

	public function cek_container_rec($params)
	{
		$arrData = '{
						"action":"whereIn",
						"db":"omuster",
						"table":"TS_CONTAINER",
						"where":[
							["BRANCH_ID","=","4"],
							["CONT_NO","=","'.$params.'"],
							["BRANCH_CODE","=","PTG"]
						],
						"whereIn":[],
						"whereNotIn":["CONT_LOCATION",["GATI","IN_YARD"]],
						"orderby":["CONT_COUNTER","desc"],
						"limit":1,
						"page":1,
						"start":0
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
