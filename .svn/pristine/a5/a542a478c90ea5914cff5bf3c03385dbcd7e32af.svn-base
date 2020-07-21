<?php
class Uper_model extends CI_Model {

	public function __construct(){
		$this->load->library('session');
		$this->load->library('OMDBConnect');

	}


	public function getUper($uper_id){

		$wsdl = ORDER_MGT;
		$service_name = 'printUper';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_uper>$uper_id</id_uper>
			</data>
		</root>";

		$stack = array();
		if(!$this->nusoap_lib->call_wsdl($wsdl,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else {
			$obj = json_decode($result);
			$stack = $obj->data->retval;
			$obj_head = $stack[0];
			unset($stack[0]);
			$obj_detail = array_values($stack);
		}
		//get Header
		$returnval = array('header' => $obj_head, 'detail' => $obj_detail);

		return $returnval;
	}

	public function getUperList(){
		$filter = "";

		$query = "select to_char(uper_date,'DD MON YYYY') fmtdate, a.* from tth_uper a $filter";

		$rs = $this->omdbconnect->query($query);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			return $this->omdbconnect->getAll($rs);
		}
	}

	public function getOfficer($id_holding,$id_company,$id_port,$id_servicetype,$ttd_pos){
		$qofficer = "Select * From M_OFFICER WHERE ID_HOLDING = '$id_holding' AND ID_COMPANY = '$id_company' AND ID_PORT = '$id_port' AND ID_SERVICETYPE = '$id_servicetype'
		AND TTD_POSITION = '$ttd_pos'";
		$rs = $this->omdbconnect->query($qofficer);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			$resultdata = $this->omdbconnect->getAll($rs);
			return $resultdata[0];
		}
	}

	public function getRealisasi($req_id){

		$wsdl = ORDER_MGT;
		$service_name = 'printRealisasi';
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>$req_id</id_req>
			</data>
		</root>";

		$stack = array();
		if(!$this->nusoap_lib->call_wsdl($wsdl,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else {
			$obj = json_decode($result);
			$stack = $obj->data->retval;
		}

		$returnval = array('header' => $stack->header[0], 'detailImp' => $stack->import, 'detailExp' => $stack->export, 'detailEq' => $stack->equipment);

		return $returnval;

	}

}?>
