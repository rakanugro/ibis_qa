<?php
class Billing_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		//$this->db2 = $this->load->database("order_mgt",TRUE);
		$this->load->library('session');
		$this->load->library("Nusoap_lib");
	}
		
	public function getNumberReqAndSourceByCust($custid)
	{
		$group_id = $this->session->userdata('group_phd');
		if($group_id!="m")
		{
			$search_customer = "where CUSTOMER_ID = ?";
		}
		else
		{
			$search_customer = " ";
		}
		
		$query = "SELECT *
FROM (select mt.TERMINAL_NAME, REQUEST_ID,BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID, MODUL_DESC, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||VOYAGE_IN||'-'||VOYAGE_OUT AS VESVOY, REQUEST_DATE, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE,STATUS_REQ, REJECT_NOTES
						from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL) 
						$search_customer
		ORDER BY REQUEST_DATE DESC) data_
WHERE rownum <= 15
ORDER BY rownum";

		//echo $query;die;
		$query 	= $this->db->query($query, array($custid));
		$hasil=$query->result_array();
		return $hasil;
	}

}?>