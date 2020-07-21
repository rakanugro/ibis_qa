<?php
class Approval_model extends CI_Model {

	public function __construct(){
		$this->load->database("order_mgt",TRUE);
		//$this->db2 = $this->load->database("order_mgt",TRUE);
		$this->load->library('session');
	}
		
	public function getBookingList($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		if($search!="")
		{
			$search = strtoupper($search);
			$search = " and (UPPER(l.request_id) like '%$search%' or UPPER(CUSTOMER_NAME) like '%$search%' or UPPER(TERMINAL_ID) like '%$search%')";
		}

        $query = "SELECT *
				  FROM (SELECT a.*, ROWNUM rnum
						  FROM (SELECT A.ID_REQCARGO,
									 A.REQ_DATE,
									 CASE A.STATUS_REQ
										WHEN 'N' THEN 'NEW'
										WHEN 'Q' THEN 'UPER LUNAS'
										WHEN 'R' THEN 'REALISASI'
										WHEN 'S' THEN 'PROFORMA'
										WHEN 'U' THEN 'PIUTANG'
										WHEN 'T' THEN 'TRANSFER SIMKEU'
									 END
										STATUS_REQ,
									 A.ID_PORT,
									 A.CUST_NAME,
									 B.SERVICETYPE_NAME,
									 A.VESSEL,
									 A.VOY_IN,
									 A.VOY_OUT
								FROM REQ_CARGOSVC_H A, M_SERVICETYPE B
							   WHERE A.ID_SERVICETYPE = B.ID_SERVICETYPE $search 
							ORDER BY A.REQ_DATE DESC) a
					  where ROWNUM <= $upper_bound )
					where rnum  > $lower_bound";

		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
    }

}?>