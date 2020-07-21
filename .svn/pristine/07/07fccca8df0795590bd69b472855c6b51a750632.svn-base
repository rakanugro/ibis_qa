<?php
class Layanan_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->db2 = $this->load->database("forum", TRUE);
		$this->load->library('session');
	}

	public function getAllLayanan()
	{
		$query = "SELECT DISTINCT(INV_NOTA_LAYANAN) FROM INV_MST_NOTA WHERE INV_NOTA_STATUS = 'Active'";

		$query 	= $this->db2->query($query);

		$layanan = array();

		foreach ($query->result_array() as $service)
		{
			$layanan[0][] = $service['INV_NOTA_LAYANAN'];
		}

		return $layanan;
	}
}?>
