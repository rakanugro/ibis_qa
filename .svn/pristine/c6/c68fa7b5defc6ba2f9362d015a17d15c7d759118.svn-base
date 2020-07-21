<?php
class Va_expired extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->forum = $this->load->database("forum",TRUE);
		$this->load->library('session');
	}

	public function getExpired($org_id, $layanan)
	{
		$query = "select * from VA_MST_EXPIRED where ORG_ID = '{$org_id}' AND LAYANAN = '{$layanan}' AND STATUS = '0'";

		$query = $this->forum->query($query);

	  return $result = $query->result_array();
	}

}?>
