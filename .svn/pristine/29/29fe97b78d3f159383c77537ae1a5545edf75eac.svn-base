<?php
class Ticket_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
	
	public function create_ticket($params)
	{
		
		$query = "INSERT INTO HELPDESK_TICKET_HEADER(
								TICKET_NUMBER,
								TICKET_USER_ID,
								TICKET_TITLE,
								REQUEST_NUMBER,
								TICKET_MESSAGE,
								TICKET_ATTACHMENT_FILE_NAME,
								TICKET_STATUS,
								TICKET_SUBMIT_DATE,
								TICKET_CHANNEL,
								TICKET_TYPE,
								TICKET_BRANCH_ID,
								INTERACTION_TYPE,
								SERVICE_TYPE,
								SF_TICKET_ID
								)
						VALUES (?,?,?,?,?,?,'N',sysdate,?,?,?, ?,?, ?)
						";
		$result = $this->db->query($query,array(
												$params['TICKET_NUMBER'],
												$params['USER_ID'],
												$params['TITLE'],
												$params['REQUEST_NUMBER'],
												$params['MESSAGE'],
												$params['ATTACHMENT'],
												$params['TICKET_CHANNEL'],
												$params['TICKET_TYPE'],
												$params['BRANCH_ID'],
												$params['INTERACTION_TYPE'],
												$params['SERVICE_TYPE'],
												$params['SF_TICKET_ID']
												 ));

		return $result;
	}
	
	public function create_ticket_message($params)
	{		
		$query = "INSERT INTO HELPDESK_TICKET_MESSAGE(
								TICKET_NUMBER,
								TICKET_MESSAGE,
								TICKET_ATTACHMENT_FILE_NAME,
								TICKET_USER_ID,
								TICKET_CHANGE_STATUS_HISTORY,
								TICKET_CHANGE_ACTIVITY_HISTORY,
								CREATED_DATE
								)
						VALUES (?,?,?,?,?,?,sysdate)
						";

		$result = $this->db->query($query,$params);

		return $result;
	}	
	
	public function update_ticket($params)
	{		
		$query = "update HELPDESK_TICKET_HEADER set TICKET_STATUS = ?,TICKET_ACTIVITY = ? where TICKET_NUMBER = ?";
		$result = $this->db->query($query,$params);

		return $result;
	}	
	
	public function getTicketByUserName($username,$max_row,$search="")
	{
		$where="";
		if($search!="")
		{
			$search = strtoupper($search);
			
			switch($search)
			{
				case "OPEN":
					$search2 = " OR ticket_status = 'N'";
				break;
				case "PROGRESS":
					$search2 = " OR ticket_status = 'O'";
				break;
				case "ON":
					$search2 = " OR ticket_status = 'O'";
				break;				
				case "ON PROGRESS":
					$search2 = " OR ticket_status = 'O'";
				break;
				case "CLOSED":
					$search2 = " OR ticket_status = 'C'";
				break;
				case "PENGADUAN":
					$search2 = " OR ticket_type = 'OTHER'";
				break;
				case "PENGADUAN LAINNYA":
					$search2 = " OR ticket_type = 'OTHER'";
				break;
				case "KARTU":
					$search2 = " OR ticket_type = 'CLMT'";
				break;
				case "AKSES KARTU":
					$search2 = " OR ticket_type = 'CLMT'";
				break;
				case "PEMBUKAAN LIMIT":
					$search2 = " OR ticket_type = 'CLMT'";
				break;
				case "PEMBUKAAN LIMIT AKSES KARTU":
					$search2 = " OR ticket_type = 'CLMT'";
				break;				
				default:
				break;
			}
			
			$where = "and (
							UPPER(ticket_number) like ? 
							or UPPER(ticket_title) like ? 
							or UPPER(b.name) like ? 
							or UPPER(c.name) like ? 
							$search2 
						)";
		}
		
		$query = "SELECT *
FROM (select TICKET_NUMBER, TICKET_TITLE, to_char(TICKET_SUBMIT_DATE,'dd-MON-YYYY hh24:mi:ss') TICKET_SUBMIT_DATE, TICKET_STATUS, TICKET_TYPE, b.name, e.name CUSTOMER_NAME,
			(select b.ticket_message from helpdesk_ticket_message b where b.ticket_number = a.ticket_number and rownum = 1 
			and b.created_date =  (select max(c.created_date) from helpdesk_ticket_message c where c.ticket_number = a.ticket_number)) cs 
			from helpdesk_ticket_header a 
						left join mst_user b on b.username = a.ticket_user_id 
						left join mst_customer_billing_account c on c.billing_customer_id = b.customer_id 
						left join mst_customer e on e.customer_id = c.customer_id 
						left join mst_hr_operating_units d on d.branch_id = a.ticket_branch_id and enabled_gui = 'Y'
			where TICKET_USER_ID = ? $where ORDER BY TICKET_NUMBER DESC) data_
WHERE rownum <= $max_row
ORDER BY rownum";
		
		return $this->db->query($query, array($username,"%".$search."%","%".$search."%","%".$search."%","%".$search."%"))->result_array();
	}
	
	public function getTicketHelpdesk($search="",$branch_id)
	{
		if($search!="")
		{
			$search = strtoupper($search);
			
			switch($search)
			{
				case "OPENNPENDING":
					$search2 = " OR ticket_status = 'N' OR ticket_status = 'O'";
				break;				
				case "OPEN":
					$search2 = " OR ticket_status = 'N'";
				break;
				case "PROGRESS":
					$search2 = " OR ticket_status = 'O'";
				break;
				case "ON":
					$search2 = " OR ticket_status = 'O'";
				break;				
				case "ON PROGRESS":
					$search2 = " OR ticket_status = 'O'";
				break;
				case "CLOSED":
					$search2 = " OR ticket_status = 'C'";
				break;
				case "PENGADUAN":
					$search2 = " OR ticket_type = 'OTHER'";
				break;
				case "PENGADUAN LAINNYA":
					$search2 = " OR ticket_type = 'OTHER'";
				break;
				case "KARTU":
					$search2 = " OR ticket_type = 'CLMT'";
				break;
				case "AKSES KARTU":
					$search2 = " OR ticket_type = 'CLMT'";
				break;
				case "PEMBUKAAN LIMIT":
					$search2 = " OR ticket_type = 'CLMT'";
				break;
				case "PEMBUKAAN LIMIT AKSES KARTU":
					$search2 = " OR ticket_type = 'CLMT'";
				break;				
				default:
				break;
			}
			
			$where = "where 
							(UPPER(ticket_number) like ? 
							or UPPER(ticket_title) like ? 
							or UPPER(b.name) like ? 
							or UPPER(b.name) like ? 
							$search2 )
							";
		}
		
		if($where!="")
		{
			$where .= " and a.ticket_branch_id = '$branch_id'";
		}
		else 
			$where = " where a.ticket_branch_id = '$branch_id'";
		
		$query = "SELECT *
FROM (select TICKET_NUMBER, TICKET_TITLE, to_char(TICKET_SUBMIT_DATE,'dd-MON-YYYY hh24:mi:ss') TICKET_SUBMIT_DATE, TICKET_STATUS, TICKET_TYPE, b.name, e.name CUSTOMER_NAME,
			(select b.ticket_message from helpdesk_ticket_message b where b.ticket_number = a.ticket_number and rownum = 1 
			and b.created_date =  (select max(c.created_date) from helpdesk_ticket_message c where c.ticket_number = a.ticket_number)) cs, 
			d.name branch 			
			from helpdesk_ticket_header a 
					left join mst_user b on b.username=a.TICKET_USER_ID 
					left join mst_customer_billing_account c on c.billing_customer_id = b.customer_id 
					left join mst_customer e on e.customer_id = c.customer_id 
					left join mst_hr_operating_units d on d.branch_id = a.ticket_branch_id and enabled_gui = 'Y'
			$where 
			ORDER BY decode    
 (a.TICKET_STATUS
    , 'N', 1
      , 'O', 2
      , 'C', 3
      , 4), TICKET_NUMBER DESC) data_
WHERE rownum <= 100
ORDER BY rownum";
		
		return $this->db->query($query, array("%".$search."%","%".$search."%","%".$search."%","%".$search."%"))->result_array();
	}

	public function getTicketDetailbyTicketNumber($ticket_number)
	{
		$query		= "SELECT ticket_number, ticket_title, to_char(TICKET_SUBMIT_DATE, 'dd-MON-yyyy hh24:mi:ss') TICKET_SUBMIT_DATE, request_number, ticket_status, ticket_message, ticket_attachment_file_name, ticket_type, ticket_channel, ticket_activity, b.name, c.name CUSTOMER_NAME 
						from helpdesk_ticket_header a 
					left join mst_user b on b.username=a.TICKET_USER_ID 
					left join mst_customer c on c.customer_id = b.customer_id 
						WHERE ticket_number=?";
		$result 	= $this->db->query($query,$ticket_number);
		// return $this->db->last_query();
		return $result->row_array();
	}

	public function getTicketMessagebyTicketNumber($ticket_number)
	{
		$query		= "SELECT a.ticket_message, a.ticket_attachment_file_name, to_char(a.created_date, 'dd-mm-yyyy hh24:mi:ss') created_date, 
								a.ticket_user_id, b.name 
						from helpdesk_ticket_message a left join mst_user b on a.ticket_user_id=b.username 
						WHERE ticket_number=? order by a.created_date asc";
		$result 	= $this->db->query($query,$ticket_number);
	
		return $result->result_array();
	}
	
	
	public function getTotalListTicket()
	{
		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		
        $query = "SELECT count(1) total
            FROM HELPDESK_TICKET_HEADER
            WHERE ticket_status in ('N','O') and ticket_branch_id = ?";
		$query 	= $this->db->query($query,$branch_id);
		$hasil=$query->row_array();
		
		return $hasil['TOTAL'];
	}	

	public function get_token($u_phd){
		$query = $this->db->query("SELECT * FROM HELPDESK_TOKEN_SF WHERE FLAG_EXPIRED = 'N' AND USERID = '$u_phd'");
		return $query;
	}

	public function insert_token($arr_data){
		$this->db->insert('HELPDESK_TOKEN_SF', $arr_data);
	}

	public function get_ticket_number()
	{
		$query = "	BEGIN ef_get_request_number
						(
							'TICKET',
							'TNUMBER',
							'',
							:out_message
						);
				  	END;";
		$query = oci_parse($this->db->conn_id, $query) or die ('Can not parse query');
		oci_bind_by_name($query, 'out_message', $out_param,1000) or die ('Can not bind variable');
		oci_execute($query);

		return $out_param;
	}


}?>