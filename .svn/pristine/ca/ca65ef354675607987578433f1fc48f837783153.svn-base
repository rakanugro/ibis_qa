<?php

class BEMaster{ 
	private $ci;
	
	public function __construct(){
		$this->ci = &get_instance();		
		$this->ci->load->library("Nusoap_lib");
	}
	
	public function query($query, $params){
		$service_name = 'omQuery';
		
		$in_data = $this->createInputData($query, $params);
		
		$success = $this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE, $service_name, array("in_data" => "$in_data"), $result);
		return array(	'success' => $success, 
						'result'  => $result	);
		
	}

	public function getCompanyName($company_id){
		$service_name = 'getCompanyName';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<company_id>$company_id</company_id>
			</data>
		</root>";
				
		if(!$this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			return json_decode($result)->data;
		}
		else{
			return json_decode($result)->data;
		}		
	}

	public function getBranchName($branch_code){
		$service_name = 'getBranchName';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<branch_code>$branch_code</branch_code>
			</data>
		</root>";
				
		if(!$this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			return json_decode($result)->data;
		}
		else{
			return json_decode($result)->data;
		}		
	}

	public function getPortName($port_id){
		$service_name = 'getPortName';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_id>$port_id</port_id>
			</data>
		</root>";
					
		if(!$this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			return json_decode($result)->data;
		}
		else{
			return json_decode($result)->data;
		}		
	}

	public function getHoldingName($holding_id){
		$service_name = 'getHoldingName';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<holding_id>$holding_id</holding_id>
			</data>
		</root>";
					
		if(!$this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			return json_decode($result)->data;
		}
		else{
			return json_decode($result)->data;
		}		
	}	
	
	public function getMgrName($holding_id,$company_id,$port_id,$servicetype_id,$mgr){
		$service_name = 'getMgrName';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<holding_id>$holding_id</holding_id>
				<company_id>$company_id</company_id>
				<port_id>$port_id</port_id>
				<servicetype_id>$servicetype_id</servicetype_id>
				<manager>$mgr</manager>
			</data>
		</root>";
					
		if(!$this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			return json_decode($result)->data;
		}
		else{
			return json_decode($result)->data;
		}		
	}

	public function getMgrNipp($holding_id,$company_id,$port_id,$servicetype_id,$mgr){
		$service_name = 'getMgrNipp';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<holding_id>$holding_id</holding_id>
				<company_id>$company_id</company_id>
				<port_id>$port_id</port_id>
				<servicetype_id>$servicetype_id</servicetype_id>
				<manager>$mgr</manager>
			</data>
		</root>";
					
		if(!$this->ci->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			return json_decode($result)->data;
		}
		else{
			return json_decode($result)->data;
		}		
	}	
	
}
?>