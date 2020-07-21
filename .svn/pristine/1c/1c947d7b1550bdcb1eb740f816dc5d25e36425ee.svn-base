<?php

class OMDBConnect{ 

	public function createInputData($querystring, $paramarray=null){
		$paramstring = '';
		
		if (!is_null($paramarray)){
			foreach ($paramarray as $k => $p){
				$paramstring .= "<param><key>$k</key><value>$p</value></param>";
			}			
		}
		
		$securitykey = "p3npin3appl3appl3pi3";
		$hash = md5($securitykey.$querystring);
		
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<security>$hash</security>
			<data>
				<query>$querystring</query>
				<params>
					$paramstring
				</params>
			</data>
		</root>";

		return preg_replace('/\s+/', ' ',$in_data);
	}

	public function getCleanMD5($querystring){
		$q = preg_replace('/\s+/', ' ',trim($querystring));
		return md5($q);
	}
	
	
	public function query($query, $params=null){
		$ci = &get_instance();		
		$ci->load->library("Nusoap_lib");

		$service_name = 'omQuery';
		
		$in_data = $this->createInputData($query, $params);
		
		$success = $ci->nusoap_lib->call_wsdl(BILLING_ENGINE, $service_name, array("in_data" => "$in_data"), $result);
		return array(	'success' => $success, 
						'result'  => $result	);
		
	}
	
	public function getOne($rs){
		$result = json_decode($rs['result']); 
		$data = $result->data;
		return (array) $data[0];
	}
	
	public function getAll($rs){
		$result = json_decode($rs['result']); 
		$data = $result->data;
		$rows = array();		
		foreach ($data as $d){
			$rows[] = (array) $d;
		}			
		return $rows;
	}

	
}
?>