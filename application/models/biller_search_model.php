<?php
class Biller_search_model extends CI_Model
{

	public function __construct()
	{
		$this->billing = $this->load->database("default", TRUE);
		$this->billing->reconnect();
		$this->load->database();
		$this->db2 = $this->load->database("forum", TRUE);
		$this->load->library('session');
	}

	public function getAllBiller()
	{
		$query = "SELECT DISTINCT(NAMA_BILLER) FROM VA_MST_BILLER WHERE STATUS = 0";

		$query 	= $this->billing->query($query);
		// print_r($query);
		// die;

		$biller = array();


		foreach ($query->result_array() as $billers) {
			$biller[0][] = $billers['NAMA_BILLER'];
			// print_r($query);
			// die;
		}

		return $biller;
	}
}
