<?php
class Dashboard_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}

	public function get_throughput($port, $start_date, $end_date)
	{
		$query = "SELECT (SELECT THROUGHPUT FROM DASHBOARD_THROUGHPUT_DATA 
			WHERE port = ? 
				and start_date = ? 
				and end_date = ?
				and trans_type='E') THROUGHPUT_E,
        (SELECT THROUGHPUT FROM DASHBOARD_THROUGHPUT_DATA 
			WHERE port = ? 
				and start_date = ?
				and end_date = ?
				and trans_type='I') THROUGHPUT_I,
		(SELECT THROUGHPUT FROM DASHBOARD_THROUGHPUT_DATA 
			WHERE port = ? 
				and start_date = ?
				and end_date = ?
				and trans_type='T') THROUGHPUT_T FROM DUAL";
				
		$query 	= $this->db->query($query, array($port, $start_date, $end_date, $port, $start_date, $end_date, $port, $start_date, $end_date));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
				
			if($row['THROUGHPUT_E']!="")
			{
				if(is_numeric(trim($row['THROUGHPUT_E']))&&is_numeric(trim($row['THROUGHPUT_I']))&&is_numeric(trim($row['THROUGHPUT_T'])))
					return trim($row['THROUGHPUT_E']).",".trim($row['THROUGHPUT_I']).",".trim($row['THROUGHPUT_T']);
				else 
					return "F";
			}
			else
			{
				return "F";
			}
		}
		else 
		{
			return "F";	
		}
	}
	
	public function set_throughput($port, $start_date, $end_date, $trans_type, $throughput)
	{						
		$query 	= "INSERT INTO DASHBOARD_THROUGHPUT_DATA (PORT,START_DATE,END_DATE,TRANS_TYPE,THROUGHPUT) 
                    VALUES (?, ?, ?, ?, ?)";
				
		$query 	= $this->db->query($query, array($port, $start_date, $end_date, $trans_type, $throughput));
	}
	
	public function get_order_summary($customer_id="")
	{
		$query__ = "";
		$query_ = "";
		if($customer_id!="")
		{
			$query_ = "customer_id = '$customer_id' and ";
			$query__ = "where customer_id = '$customer_id' ";
		}
		
		$query = "select 
						(select count(*) from transaction_log $query__ ) tot_order_all,
						(select count(*) from transaction_log where $query_ status_req='N' OR status_req is null) tot_order_draft, 
						(select count(*) from transaction_log where $query_ status_req='W') tot_order_wait, 
						(select count(*) from transaction_log where $query_ status_req='S') tot_order_save, 
						(select count(*) from transaction_log where $query_ status_req='R') tot_order_reject, 
						(select count(*) from transaction_log where $query_ status_req='P') tot_order_paid 
				from dual";
	   
		$result = $this->db->query($query);

		return $result->row_array();
	}

	public function get_customer_basic_profile($customer_id="")
	{
		$query = "select name customer_name from mst_customer where customer_id = ?";
	   
		$result = $this->db->query($query, array($customer_id));

		return $result->row_array();
	}	
}
?>