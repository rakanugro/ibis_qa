<?php
class Api_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
	
	public function get_apiList()
	{
		$query = "SELECT api_name,health_check,message,to_char(last_health_check, 'yyyy/mm/dd hh24:mi:ss') as last_health_check,connection_time 
					FROM API_HEALTH_CHECK order by health_check desc";

		$query 	= $this->db->query($query);
		return $query->result_array();
	}
}?>