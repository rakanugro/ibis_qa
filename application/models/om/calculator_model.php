<?php
class Calculator_model extends CI_Model {

	public function __construct(){
		$this->load->library('session');
		$this->load->library('OMDBConnect');
		$this->load->library("Nusoap_lib");

	}
		
	public function calculate($request_no, $recalc=0){
		$service_name = 'calculate';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<request_no>$request_no</request_no>
				<recalculate>$recalc</recalculate>
			</data>
		</root>";
		
		//return $in_data; die;
		
		if(!$this->nusoap_lib->call_wsdl(BILLING_ENGINE,$service_name,array("in_data" => "$in_data"),$result)){
			//echo $result;die;
			return $result;
		}
		else{
			//echo $result;die;
			return $result;
		}

	}
	
	public function getNotaCore($headquery, $headparams){
		
		$rs = $this->omdbconnect->query($headquery, $headparams);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			$header = $this->omdbconnect->getOne($rs);
		}
		
		//get Detail
		$query = "select 
					a.tarif tariff,
					a.tottarif total_tariff,
						a.* from ttd_nota_all a where id_nota = :idnota";
		$params = array();
		$params[':idnota'] = $header['ID_NOTA'];
		
		$rs = $this->omdbconnect->query($query, $params);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			$detail = $this->omdbconnect->getAll($rs);		
		}
		
		//finally
		return array (	'header' => $header, 'detail' => $detail	);
		
	}
	
	
}?>