<?php
class Bank_search_model extends CI_Model
{

	public function __construct()
	{
		$this->billing = $this->load->database("default", TRUE);
		$this->billing->reconnect();
		$this->load->database();
		$this->db2 = $this->load->database("forum", TRUE);
		$this->load->library('session');
	}

	public function getAllBank1()
	{
		$query = "SELECT DISTINCT(NAMA_BANK) FROM VA_MST_BANK WHERE STATUS = 1";

		$query 	= $this->billing->query($query);
		// print_r($query);
		// die;

		$bank = array();


		foreach ($query->result_array() as $banks) {
			$bank[0][] = $banks['NAMA_BANK'];
			// print_r($query);
			// die;
		}

		return $bank;
	}
}
