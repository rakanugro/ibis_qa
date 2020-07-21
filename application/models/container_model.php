<?php
class Container_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}

	public function getDetailBilling($noReq)
	{
		$query = "select * from transaction_log where request_id= ?";
		$query 	= $this->db->query($query, array($noReq));
		$hasil=$query->row_array();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getUserInfoByRequestNumber($noReq)
	{
		$query = "select b.email, b.name, a.biller_request_id from transaction_log a left join mst_user b on b.username=a.request_by where a.request_id= ?";
		$query 	= $this->db->query($query, array($noReq));
		$hasil=$query->row_array();
		return $hasil;
	}

	public function getTerminalCancel()
	{
		$query = "select TERMINAL, TERMINAL_NAME from mst_terminal where ACTIVE='Y' AND SERVICE_CANCEL='Y' order by TERMINAL_ORDER";

		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function getServiceCancel()
	{
		$query = "select MODUL_DESC, SERVICE_NAME from mst_service_cancel where CANCELLED='Y' order by SERVICE_NAME";
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function update_docfile($varfile,$noReq,$path,$filename,$userid)
	{
		if($varfile=='upload_peb')
		{
			$uploadfile="peb_file";
		}
		else if($varfile=='upload_npe')
		{
			$uploadfile="npe_file";
		}
		else if($varfile=='upload_bookingship')
		{
			$uploadfile="bookship_file";
		}
		else if($varfile=='upload_do')
		{
			$uploadfile="do_file";
		}
		else if($varfile=='upload_sppb')
		{
			$uploadfile="sppb_file";
		}
		else if($varfile=='upload_bea')
		{
			$uploadfile="bc_file";
		}
		else if($varfile=='upload_sp_custom')
		{
			$uploadfile="sp_custom_file";
		}

		$query = "update transaction_log set $uploadfile='$path',
											last_user_activity_code='".strtoupper($varfile).":$filename',
											last_user_activity_userid = ?
						where request_id='$noReq'";
		$this->db->query($query, array($userid));

	}

	public function getKodeModul($noreq)
	{
		$query = "select kode_modul from transaction_log where REQUEST_ID= ?";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();
		return isset($hasil['KODE_MODUL']) ? $hasil['KODE_MODUL'] : 'NO_DATA_FOUND';
	}

	public function getNumberRequestBiller($noreq)
	{
		$query = "select BILLER_REQUEST_ID from transaction_log where REQUEST_ID= ?";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();
		return isset($hasil['BILLER_REQUEST_ID']) ? $hasil['BILLER_REQUEST_ID'] : 'NO_DATA_FOUND';
	}
	
	public function getStatusRequest($noreq)
	{
		$query = "select STATUS_REQ from transaction_log where REQUEST_ID= ?";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();
		return isset($hasil['STATUS_REQ']) ? $hasil['STATUS_REQ'] : 'NO_DATA_FOUND';
	}	

	public function getDataRequestBiller($noreq)
	{
		$query = "select a.PORT_ID,a.TERMINAL_ID,b.ID_SERVICE from transaction_log a join mst_service_cancel b on a.KODE_MODUL=b.KODE_MODUL AND a.MODUL_DESC=b.MODUL_DESC where REQUEST_ID= '$noreq'";
		$query 	= $this->db->query($query);
		$hasil=$query->row_array();
		return $hasil;
	}

	public function getNumberRequestEservice($noreq)
	{
		$query = "select REQUEST_ID from transaction_log where BILLER_REQUEST_ID= ?";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();
		return isset($hasil['REQUEST_ID']) ? $hasil['REQUEST_ID'] : 'NO_DATA_FOUND';

	}

	public function getCustomerId($noreq)
	{
		$query = "select CUSTOMER_ID from transaction_log where REQUEST_ID= ?";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();
		return isset($hasil['CUSTOMER_ID']) ? $hasil['CUSTOMER_ID'] : '';
	}

	public function confirmRequest($noreq,$userid="")
	{
		$query = "update transaction_log set STATUS_REQ='W', LAST_USER_ACTIVITY_CODE = 'CONFIRM_REQUEST', LAST_USER_ACTIVITY_DATE=SYSDATE, LAST_USER_ACTIVITY_USERID = ?  where REQUEST_ID = ?";
		$this->db->query($query, array($userid, $noreq));

		return "Success";
	}

	public function rejectRequest($noreq,$notes,$userid="")
	{
		$query = "update transaction_log set STATUS_REQ='R',
							REJECT_NOTES = ? ,  LAST_USER_ACTIVITY_CODE = 'REJECT_REQUEST',
							LAST_USER_ACTIVITY_USERID = ?,
							LAST_USER_ACTIVITY_ADDIT_DAT1 = ?,
							NPE_FILE_FLAG = NULL,
							PEB_FILE_FLAG = NULL,
							BOOKSHIP_FILE_FLAG = NULL,
							DO_FILE_FLAG = NULL,
							BC_FILE = NULL,
							SPPB_FILE_FLAG = NULL,
							SP_CUSTOM_FILE_FLAG = NULL
							where REQUEST_ID = ?";
		$this->db->query($query, array($notes, $userid, $notes, $noreq));

		return "Success";
	}

	public function updateTransactionLogActivity($noreq,$activity_code,$activity_userid)
	{
		$query = "update transaction_log set LAST_USER_ACTIVITY_CODE = ?, LAST_USER_ACTIVITY_USERID = ?
					where REQUEST_ID =  ?";
		$this->db->query($query, array($activity_code, $activity_userid, $noreq));

		return "Success";
	}

    public function getCountCardPrint($noreq="")
    {

        $query = "SELECT CONCAT(count(1),',')total
            FROM transaction_log_activity
            WHERE REQUEST_ID = ? and LAST_USER_ACTIVITY_CODE='PRINT_CARD'";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();

        $query = "select CONCAT(
							CONCAT(to_char(LAST_USER_ACTIVITY_DATE, 'dd/mm/yyyy hh24:mi:ss'),','),
							LAST_USER_ACTIVITY_USERID
							) total from transaction_log_activity
						WHERE REQUEST_ID = ? and LAST_USER_ACTIVITY_CODE = 'PRINT_CARD' order by LAST_USER_ACTIVITY_DATE desc";

		$query 	= $this->db->query($query, array($noreq));
		$hasil2=$query->row_array();

		return $hasil['TOTAL'].$hasil2['TOTAL'];
    }

	public function getNumberReqAndSource($noreq_query)
	{
		$query = "select BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID,MODUL_DESC MODUL,CASE WHEN MODUL_DESC = 'CALBG' THEN 'BATAL MUAT BEFORE GATEIN'
        WHEN MODUL_DESC = 'CALAG' THEN 'BATAL MUAT AFTER GATEIN'
        WHEN MODUL_DESC = 'CALDG' THEN 'BATAL MUAT DELIVERY'
        ELSE MODUL_DESC
        END MODUL_DESC, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||'('||VOYAGE_IN||')'||' - '||'('||VOYAGE_OUT||')' AS VESVOY,
        REQUEST_DATE, STATUS_REQ, REJECT_NOTES, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE ,BC_FILE
        from transaction_log where REQUEST_ID like '$noreq_query%'";
		//echo $query;die;
		$query 	= $this->db->query($query);
		$hasil=$query->row_array();
		return $hasil;
	}
    public function getTotalListApproval($search="")
    {
		
		$reg_company_id = $this->session->userdata('registrationcompanyid_phd');
		$qidport = "select PORT from mst_terminal where kode_cabang_simkeu = ? and rownum = 1";
		$ridport = $this->db->query($qidport, $reg_company_id);
		$hasil=$ridport->row_array();
		$useridport = $hasil['PORT'];
		
        $query = "SELECT count(1) total
            FROM transaction_log
            WHERE status_req in ('W') and port_id = '$useridport'";
		$query 	= $this->db->query($query);
		$hasil=$query->row_array();
		return $hasil['TOTAL'];
    }
    public function getTotalListApproval2($search="")
    {
		$reg_company_id = $this->session->userdata('registrationcompanyid_phd');
		$qidport = "select PORT from mst_terminal where kode_cabang_simkeu = ? and rownum = 1";
		$ridport = $this->db->query($qidport, $reg_company_id);
		$hasil=$ridport->row_array();
		$useridport = $hasil['PORT'];
		
        $query = "SELECT count(1) total
            FROM transaction_log
            WHERE status_req in ('S','P') and port_id = '$useridport'";
		$query 	= $this->db->query($query);
		$hasil=$query->row_array();
		
		if($hasil['TOTAL']>200)
			return 200;
		else
			return $hasil['TOTAL'];
    }

	public function getTtlListSvcCancel($search="")
	{
		$req_id=$_POST['REQNO'];
		//$terminal=$_POST['TERM'];
		//$type_req=$_POST['TREQ'];
		$cust_id=$this->session->userdata('customerid_phd');
		$query = "SELECT count(1) total
            FROM transaction_log
            WHERE
			status_req<>'P' $search
						   AND request_id='$req_id' and CUSTOMER_ID='$cust_id'
						   --AND TERMINAL_ID='$terminal'
						   --and MODUL_DESC='$type_req'
			";

		$query 	= $this->db->query($query);
		$hasil=$query->row_array();
		return $hasil['TOTAL'];

	}

    public function getListApproval($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;
		$reg_company_id = $this->session->userdata('registrationcompanyid_phd');
		$qidport = "select PORT from mst_terminal where kode_cabang_simkeu = ? and rownum = 1";
		$ridport = $this->db->query($qidport, $reg_company_id);
		$hasil=$ridport->row_array();
		$useridport = $hasil['PORT'];
		
		//echo $useridport;die();
		if($search!="")
		{
			$search = strtoupper($search);
			$search = " and (UPPER(l.request_id) like '%$search%' or UPPER(CUSTOMER_NAME) like '%$search%' or UPPER(TERMINAL_ID) like '%$search%')";
		}

        $query = "SELECT *
				  FROM (SELECT a.*, ROWNUM rnum
						  FROM (  SELECT l.REQUEST_ID,
								 l.BILLER_REQUEST_ID,
								 l.PORT_ID,
								 l.TERMINAL_ID,
								 t.TERMINAL_NAME,
								 l.MODUL_DESC MODUL,
								 CASE
									WHEN l.MODUL_DESC = 'CALBG'
									THEN
									   'BATAL MUAT BEFORE GATEIN'
									WHEN l.MODUL_DESC = 'CALAG'
									THEN
									   'BATAL MUAT AFTER GATEIN'
									WHEN l.MODUL_DESC = 'CALDG'
									THEN
									   'BATAL MUAT DELIVERY'
									ELSE
									   l.MODUL_DESC
								 END
									MODUL_DESC,
								 l.CUSTOMER_NAME,
								 l.CUSTOMER_ADDRESS,
								 l.CUSTOM_NUMBER1,
								 l.CUSTOM_NUMBER2,
								 l.VESSEL || ' ' || l.VOYAGE_IN || '-' || l.VOYAGE_OUT
									AS VESVOY,
								 TO_CHAR (last_user_activity_date, 'dd-mm-yyyy hh24:mi:ss') REQUEST_DATE,
								 TO_CHAR (last_user_activity_date, 'yyyy mm dd hh24 mi ss')
									REQUEST_DATE_STRING,
								 TO_CHAR (SYSDATE, 'yyyy mm dd hh24 mi ss')
									SYSDATE_STRING,
								 l.STATUS_REQ,
								 l.ADDITIONAL_FIELD1,
								 l.ADDITIONAL_FIELD2,
								 l.PEB_FILE,
								 l.NPE_FILE,
								 l.BOOKSHIP_FILE,
								 l.SPPB_FILE,
								 l.DO_FILE,
								 1.BC_FILE,
								 l.SP_CUSTOM_FILE,
								 NVL(NPE_FILE_FLAG, 'N') NPE_FILE_FLAG,
								 NVL(PEB_FILE_FLAG, 'N') PEB_FILE_FLAG,
								 NVL(BOOKSHIP_FILE_FLAG, 'N') BOOKSHIP_FILE_FLAG,
								 NVL(DO_FILE_FLAG, 'N') DO_FILE_FLAG,
								 NVL(SPPB_FILE_FLAG, 'N') SPPB_FILE_FLAG,
								 NVL(SP_CUSTOM_FILE_FLAG, 'N') SP_CUSTOM_FILE_FLAG,
								 NVL((select npe_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
										and modul = l.modul_desc), 'N') NPE_FILE_MANDATORY,
								 NVL((select peb_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
										and modul = l.modul_desc ), 'N') PEB_FILE_MANDATORY,
								 NVL((select bookship_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
										and modul = l.modul_desc), 'N') BOOKSHIP_FILE_MANDATORY,
								 NVL((select do_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
										and modul = l.modul_desc), 'N') DO_FILE_MANDATORY,
								 NVL((select do_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
								and modul = l.modul_desc), 'N') BC_FILE_MANDATORY,
								 NVL((select sppb_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
										and modul = l.modul_desc), 'N') SPPB_FILE_MANDATORY,
								 NVL((select sp_custom_mandatory from doc_config
									where port_id = l.port_id and terminal_id = l.terminal_id
										and modul = l.modul_desc ), 'N') SP_CUSTOM_FILE_MANDATORY,
								CASE
									when    NVL(l.NPE_FILE_FLAG, 'N') = NVL((select npe_mandatory
											from doc_config where port_id = l.port_id and terminal_id = l.terminal_id
												and modul = l.modul_desc), 'N')
										AND
											NVL(l.PEB_FILE_FLAG, 'N') = NVL((select peb_mandatory
											from doc_config where port_id = l.port_id and terminal_id = l.terminal_id
												and modul = l.modul_desc ), 'N')
										AND
											NVL(l.BOOKSHIP_FILE_FLAG, 'N') = NVL((select bookship_mandatory
											from doc_config where port_id = l.port_id and terminal_id = l.terminal_id
												and modul = l.modul_desc), 'N')
										AND
											NVL(l.DO_FILE_FLAG, 'N') = NVL((select do_mandatory
											from doc_config where port_id = l.port_id and terminal_id = l.terminal_id
												and modul = l.modul_desc), 'N')
										AND
											NVL(l.SPPB_FILE_FLAG, 'N') = NVL((select sppb_mandatory
											from doc_config where port_id = l.port_id and terminal_id = l.terminal_id
												and modul = l.modul_desc), 'N')
										AND
											NVL(l.SP_CUSTOM_FILE_FLAG, 'N') = NVL((select sp_custom_mandatory
											from doc_config where port_id = l.port_id and terminal_id = l.terminal_id
												and modul = l.modul_desc ), 'N')
										then 'Y'
								else 'N' end is_approveable
							FROM    transaction_log l
								 LEFT JOIN
									mst_terminal t
								 ON terminal_id = t.terminal
						   WHERE status_req IN ('W') and port_id = '$useridport' $search
						ORDER BY last_user_activity_date DESC) a
					  where ROWNUM <= $upper_bound )
					where rnum  > $lower_bound";
		//echo $query;			
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		// return $this->db->last_query();
		return $hasil;
    }

    public function getListApproval2($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		$reg_company_id = $this->session->userdata('registrationcompanyid_phd');
		$qidport = "select PORT from mst_terminal where kode_cabang_simkeu = ? and rownum = 1";
		$ridport = $this->db->query($qidport, $reg_company_id);
		$hasil=$ridport->row_array();
		$useridport = $hasil['PORT'];		
		if($search!="")
		{
			$search = strtoupper($search);
			$search = " and (UPPER(request_id) like '%$search%' or UPPER(CUSTOMER_NAME) like '%$search%' or UPPER(TERMINAL_ID) like '%$search%')";
		}

        $query = "SELECT *
		  FROM (SELECT a.*, ROWNUM rnum
				  FROM (  SELECT REQUEST_ID,
								 BILLER_REQUEST_ID,
								 PORT_ID,
								 TERMINAL_ID,
								 t.TERMINAL_NAME,
								 MODUL_DESC MODUL,
								 CASE
									WHEN MODUL_DESC = 'CALBG'
									THEN
									   'BATAL MUAT BEFORE GATEIN'
									WHEN MODUL_DESC = 'CALAG'
									THEN
									   'BATAL MUAT AFTER GATEIN'
									WHEN MODUL_DESC = 'CALDG'
									THEN
									   'BATAL MUAT DELIVERY'
									ELSE
									   MODUL_DESC
								 END
									MODUL_DESC,
								 CUSTOMER_NAME,
								 CUSTOMER_ADDRESS,
								 CUSTOM_NUMBER1,
								 CUSTOM_NUMBER2,
								 VESSEL || ' ' || VOYAGE_IN || '-' || VOYAGE_OUT
									AS VESVOY,
								 TO_CHAR (REQUEST_DATE, 'dd-mm-yyyy hh24:mi:ss') REQUEST_DATE,
								 TO_CHAR (last_user_activity_date, 'dd-mm-yyyy hh24:mi:ss') APPROVE_DATE,
								 TO_CHAR (REQUEST_DATE, 'yyyy mm dd hh24 mi ss')
									REQUEST_DATE_STRING,
								 STATUS_REQ,
								 ADDITIONAL_FIELD1,
								 ADDITIONAL_FIELD2,
								 PEB_FILE,
								 NPE_FILE,
								 BOOKSHIP_FILE,
								 SPPB_FILE,
								 DO_FILE,
								 BC_FILE,
								 '' NAME_APPROVE
								 --(select m.name from mst_user m where username =
									--(select tla.LAST_USER_ACTIVITY_USERID from transaction_log_activity tla
										--where tla.request_id=tl.request_id and tla.last_user_activity_code='APPROVE_REQUEST' and rownum = 1)) NAME_APPROVE2
							FROM    transaction_log tl
								 LEFT JOIN mst_terminal t ON terminal_id = t.terminal
						   WHERE status_req IN ('W','S','P') and port_id = '$useridport' $search
						ORDER BY last_user_activity_date DESC) a
					  where ROWNUM <= $upper_bound )
					where rnum  > $lower_bound";
					// echo $query;
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
    }

	public function getListSvcCancel($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;
		$req_id=$_POST['REQNO'];
		//$terminal=$_POST['TERM'];
		//$type_req=$_POST['TREQ'];
		$cust_id=$this->session->userdata('customerid_phd');
		if($search!="")
		{
			$search = strtoupper($search);
			$search = " and (UPPER(request_id) like '%$search%' or UPPER(CUSTOMER_NAME) like '%$search%' or UPPER(TERMINAL_ID) like '%$search%')";
		}

        $query = "SELECT *
		  FROM (SELECT a.*, ROWNUM rnum
				  FROM (  SELECT REQUEST_ID,
								 BILLER_REQUEST_ID,
								 PORT_ID,
								 TERMINAL_ID,
								 t.TERMINAL_NAME,
								 MODUL_DESC MODUL,
								 CASE
									WHEN MODUL_DESC = 'CALBG'
									THEN
									   'BATAL MUAT BEFORE GATEIN'
									WHEN MODUL_DESC = 'CALAG'
									THEN
									   'BATAL MUAT AFTER GATEIN'
									WHEN MODUL_DESC = 'CALDG'
									THEN
									   'BATAL MUAT DELIVERY'
									ELSE
									   MODUL_DESC
								 END
									MODUL_DESC,
								 CUSTOMER_NAME,
								 CUSTOMER_ADDRESS,
								 CUSTOM_NUMBER1,
								 CUSTOM_NUMBER2,
								 VESSEL || ' ' || VOYAGE_IN || '-' || VOYAGE_OUT
									AS VESVOY,
								 REQUEST_DATE,
								 TO_CHAR (REQUEST_DATE, 'yyyy mm dd hh24 mi ss')
									REQUEST_DATE_STRING,
								 STATUS_REQ,
								 ADDITIONAL_FIELD1,
								 ADDITIONAL_FIELD2,
								 PEB_FILE,
								 NPE_FILE,
								 BOOKSHIP_FILE,
								 SPPB_FILE,
								 DO_FILE,
								 BC_FILE
							FROM    transaction_log
								 LEFT JOIN
									mst_terminal t
								 ON terminal_id = t.terminal
						   WHERE status_req<>'P' $search
						   AND request_id='$req_id' and customer_id='$cust_id'
						   --AND TERMINAL_ID='$terminal'
						   --and MODUL_DESC='$type_req'
						ORDER BY request_date DESC) a
					  where ROWNUM <= $upper_bound )
					where rnum  > $lower_bound";
		//echo $query;die;
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
    }

	public function getReqNotPaidByCust($custid,$submittercustid)
	{
		$query = "SELECT a.REQUEST_ID, VESSEL, VOYAGE_IN, VOYAGE_OUT,
						STATUS_REQ, REQUEST_DATE, PAYMENT_DATE,PORT_ID,
						TERMINAL_ID, PRF_NUMBER, TRX_NUMBER, MODUL_DESC,
						(select count(request_number) from payment_confirmation b where a.request_id=b.request_number) confirmed
						FROM TRANSACTION_LOG a WHERE CUSTOMER_ID = ? AND SUBMITTER_CUSTOMER_ID = ? AND STATUS_REQ = 'S' order by request_date desc";

		$query 	= $this->db->query($query, array($custid,$submittercustid));
		return $query->result_array();
	}

	public function getNumberReqAndSourceByCust($custid,$submittercustid)
	{
		$group_id = $this->session->userdata('group_phd');
		if($group_id!="m")
		{
			$search_customer = "where CUSTOMER_ID = ? and SUBMITTER_CUSTOMER_ID = ? ";
		}
		else
		{
			$search_customer = " ";
		}
		
		$query = "SELECT *
FROM (select mt.TERMINAL_NAME, REQUEST_ID,BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID, MODUL_DESC, PRF_NUMBER, TRX_NUMBER, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||VOYAGE_IN||'-'||VOYAGE_OUT AS VESVOY, REQUEST_DATE, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE, BC_FILE, STATUS_REQ, REJECT_NOTES
						from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL) 
						$search_customer
		ORDER BY REQUEST_DATE DESC) data_
WHERE REQUEST_ID NOT LIKE '%RBM%' AND rownum <= 15
ORDER BY rownum";

		//echo $query;die;
		$query 	= $this->db->query($query, array($custid,$submittercustid));
		$hasil=$query->result_array();
		return $hasil;
	}

	public function getNumberReqAndSourceBySearch($custid,$submittercustid,$search)
	{
		$group_id = $this->session->userdata('group_phd');
		if($group_id!="m")
		{
			$search_customer = "and CUSTOMER_ID = ? AND SUBMITTER_CUSTOMER_ID = ?";
		}
		else
		{
			$search_customer = " ";
		}
		
		$query = "SELECT *
FROM (select mt.TERMINAL_NAME, REQUEST_ID,BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID, MODUL_DESC, TRX_NUMBER, PRF_NUMBER, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||VOYAGE_IN||'-'||VOYAGE_OUT AS VESVOY, REQUEST_DATE, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE, BC_FILE,STATUS_REQ, REJECT_NOTES
						from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL)
						where (REQUEST_ID like ? or BILLER_REQUEST_ID like ?) $search_customer
		ORDER BY REQUEST_DATE DESC) data_
WHERE rownum <= 50
ORDER BY rownum";

		//echo $query;die;
		$query 	= $this->db->query($query, array("%".$search."%","%".$search."%",$custid,$submittercustid));
		$hasil=$query->result_array();
		return $hasil;
	}


	public function getNumberReqAndSourceDeliveryBySearch($custid,$submittercustid,$search)
	{
		$query = "SELECT *
FROM (select mt.TERMINAL_NAME, mt.PORT, ADDITIONAL_DATE, REQUEST_ID,BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID, MODUL_DESC, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||VOYAGE_IN||'-'||VOYAGE_OUT AS VESVOY, REQUEST_DATE, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE, BC_FILE,STATUS_REQ, REJECT_NOTES,CONT_QTY,DEL_VIA, CUSTOM_DATE
						from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL)
						where CUSTOMER_ID = ? AND SUBMITTER_CUSTOMER_ID = ? and (REQUEST_ID like ? or BILLER_REQUEST_ID like ?) AND KODE_MODUL = 'PTKM01' AND status_REQ in ('','N','R')
		ORDER BY REQUEST_DATE DESC) data_
WHERE rownum <= 50
ORDER BY rownum";

		//echo $query;die;
		$query 	= $this->db->query($query, array($custid,$submittercustid,"%".$search."%","%".$search."%"));
		$hasil=$query->result_array();
		return $hasil;
	}


	public function getNumberReqAndSourceReceivingBySearch($custid,$submittercustid,$search)
	{
		$query = "SELECT *
	FROM (select mt.TERMINAL_NAME, mt.PORT, ADDITIONAL_DATE, REQUEST_ID,BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID, MODUL_DESC, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||VOYAGE_IN||'-'||VOYAGE_OUT AS VESVOY, REQUEST_DATE, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE,BC_FILE,STATUS_REQ, REJECT_NOTES,CONT_QTY,DEL_VIA, CUSTOM_DATE
						from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL)
						where CUSTOMER_ID = ? AND SUBMITTER_CUSTOMER_ID = ?  and (REQUEST_ID like ? or BILLER_REQUEST_ID like ?) AND KODE_MODUL = 'PTKM00' AND status_REQ in ('','N','R')
		ORDER BY REQUEST_DATE DESC) data_
	WHERE rownum <= 50
	ORDER BY rownum";

		//echo $query;die;
		$query 	= $this->db->query($query, array($custid,$submittercustid,"%".$search."%","%".$search."%"));
		$hasil=$query->result_array();
		return $hasil;
	}

	//-------------main_delivery
		public function getNumberRequest($custid,$submittercustid,$kode_modul)
	{
		$query = "SELECT *
FROM (select mt.TERMINAL_NAME, mt.PORT, ADDITIONAL_DATE,REQUEST_ID,BILLER_REQUEST_ID,PORT_ID, TERMINAL_ID, MODUL_DESC, CUSTOMER_NAME, CUSTOMER_ADDRESS, CUSTOM_NUMBER1, CUSTOM_NUMBER2, VESSEL ||' '||VOYAGE_IN||'-'||VOYAGE_OUT AS VESVOY, REQUEST_DATE, ADDITIONAL_FIELD1, ADDITIONAL_FIELD2,ADDITIONAL_FIELD3, PEB_FILE, NPE_FILE, BOOKSHIP_FILE, SPPB_FILE, DO_FILE,STATUS_REQ, REJECT_NOTES, CONT_QTY,DECODE (DEL_VIA,'LAP','YARD',DEL_VIA) DEL_VIA, CUSTOM_DATE
						from transaction_log l left join mst_terminal mt on (l.PORT_ID = mt.PORT and l.TERMINAL_ID = mt.TERMINAL)
						where CUSTOMER_ID = ? AND SUBMITTER_CUSTOMER_ID = ? AND KODE_MODUL = ? AND status_REQ in ('','N','R')
		ORDER BY REQUEST_DATE DESC) data_
WHERE rownum <= 5
ORDER BY rownum";

		//echo $query;die;
		$query 	= $this->db->query($query, array($custid,$submittercustid,$kode_modul));
		$hasil=$query->result_array();
		return $hasil;
	}

	//--------------------------


	public function get_request_delivery($no_request)
	{
		$query 	= "SELECT REQUEST_ID,
						PORT_ID,
						TERMINAL_ID, DO_FILE, BC_FILE,SP_CUSTOM_FILE, SPPB_FILE
					FROM TRANSACTION_LOG WHERE REQUEST_ID = ?";
		$query 	= $this->db->query($query,array($no_request));
		return $query->result_array();
	}

    public function get_request_ext_delivery($no_request)
	{
        $query = "select
                request_id id_req,
                biller_request_id old_req,
                no_ukk id_ves_voyage,
                vessel,
                voyage_in,
                voyage_out,
                customer_id,
                customer_name,
                customer_address address,
                customer_taxid npwp,
				PORT_ID,
				TERMINAL_ID
            from transaction_log where
            request_id = ?";
		$query 	= $this->db->query($query,array($no_request));
        $data = $query->result_array();
		return $data[0];
	}

    public function get_container_ext_delivery($no_request){
        /*$query 	= "SELECT ID_REQ, NO_CONTAINER, SIZE_CONT,
                   TYPE_CONT, STATUS_CONT, HEIGHT_CONT,
                   ID_CONT, HZ, IMO_CLASS,
                   UN_NUMBER, ISO_CODE, TEMP,
                   DISABLED, WEIGHT, CARRIER,
                   OOG, OVER_LEFT, OVER_RIGHT,
                   OVER_FRONT, OVER_REAR, OVER_HEIGHT
                   FROM REQ_DELIVERY_D WHERE ID_REQ=?";*/
        $query = "select
                request_id id_req,
                biller_request_id old_req,
                ADDITIONAL_FIELD1 no_do,
                CUSTOM_NUMBER1 no_sppb,
                no_ukk id_ves_voyage,
                vessel,
                voyage_in,
                voyage_out,
                customer_id,
                customer_name,
                customer_address address,
                customer_taxid npwp,
                port_id,
                terminal_id
            from transaction_log where
            request_id = ?";
		$query 	= $this->db->query($query,array($no_request));
        $data = $query->result_array();
		return $data[0];
    }

    public function get_listrestitution_req($cust_id){
        if($cust_id != 'ipc'){
            $filtercust = "AND CUSTOMER_ID LIKE '%$cust_id%'";
        }
        else {
            $filtercust = "";
        }
        $query = "  SELECT REQ_RESTITUTION_H.ID_REQ,
                     VESSEL,
                     VESSEL_CODE,
                     CALL_SIGN,
                     VOYAGE_IN,
                     VOYAGE_OUT,
                     CUSTOMER_ID,
                     CUSTOMER_NAME,
                     ID_VES_VOY,
                     TO_CHAR(DATE_REQUEST,'DD/MM/RRRR HH24:MI:SS') DATE_REQUEST,
                     ID_PORT,
                     ID_TERMINAL,
                     STATUS_REQ,
                     ID_JOINT_VESSEL,
                     TO_CHAR(DATE_DOC_OK,'DD/MM/RRRR HH24:MI:SS') DATE_DOC_OK,
                     TO_CHAR(DATE_REQ_OK,'DD/MM/RRRR HH24:MI:SS') DATE_REQ_OK,
                     TO_CHAR(DATE_DOC_NO,'DD/MM/RRRR HH24:MI:SS') DATE_DOC_NO,
                     NO_JKK,
                     REMARK,
                     COUNT(NO_CONTAINER) QTY
                FROM REQ_RESTITUTION_H,
                REQ_RESTITUTION_D
                WHERE REQ_RESTITUTION_H.ID_REQ = REQ_RESTITUTION_D.ID_REQ $filtercust
                GROUP BY
                REQ_RESTITUTION_H.ID_REQ,
                     VESSEL,
                     VESSEL_CODE,
                     CALL_SIGN,
                     VOYAGE_IN,
                     VOYAGE_OUT,
                     CUSTOMER_ID,
                     CUSTOMER_NAME,
                     ID_VES_VOY,
                     TO_CHAR(DATE_REQUEST,'DD/MM/RRRR HH24:MI:SS'),
                     ID_PORT,
                     ID_TERMINAL,
                     STATUS_REQ,
                     ID_JOINT_VESSEL,
                     TO_CHAR(DATE_DOC_OK,'DD/MM/RRRR HH24:MI:SS'),
                     TO_CHAR(DATE_REQ_OK,'DD/MM/RRRR HH24:MI:SS'),
                     TO_CHAR(DATE_DOC_NO,'DD/MM/RRRR HH24:MI:SS'),
                     NO_JKK,
                     REMARK
                ORDER BY date_request DESC";
        $rquery = $this->db->query($query);
        $data = $rquery->result_array();
        return $data;
    }

	public function get_vesselrestitution_req(){
        $query = "SELECT A.ID_JOINT_VESSEL,
                     A.VESSEL,
                     A.VOYAGE_IN,
                     A.VOYAGE_OUT,
                     A.TERMINAL,
                     A.CALL_SIGN,
                     COUNT (NO_CONTAINER) COUNT_CONTAINER
                FROM    MST_SBY_JOINT_VESSEL A
                     INNER JOIN
                        SBY_CODECO B
                     ON (A.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL)
               WHERE A.POL = 'IDJKT'
                     AND B.NO_CONTAINER NOT IN
                            (SELECT NO_CONTAINER
                               FROM    REQ_RESTITUTION_D C
                                    INNER JOIN
                                       REQ_RESTITUTION_H D
                                    ON (C.ID_REQ = D.ID_REQ)
                              WHERE D.ID_JOINT_VESSEL = B.ID_JOINT_VESSEL)
                     AND (TRUCK_OUT_DATE IS NOT NULL OR TRUCK_OUT_DATE = '')
					 AND STATUS LIKE 'F%'
            GROUP BY A.ID_JOINT_VESSEL,
                     A.VESSEL,
                     A.VOYAGE_IN,
                     A.VOYAGE_OUT,
                     A.TERMINAL,
                     A.CALL_SIGN
                     ORDER BY ID_JOINT_VESSEL";
        $rquery = $this->db->query($query);
        $data = $rquery->result_array();
        return $data;
    }

    public function get_restitution_req($noreq){
        $query = "SELECT ID_REQ, VESSEL, VESSEL_CODE,
                   CALL_SIGN, VOYAGE_IN, VOYAGE_OUT,
                   CUSTOMER_ID, CUSTOMER_NAME, ID_VES_VOY,
                   DATE_REQUEST, ID_PORT, ID_TERMINAL, STATUS_REQ
                FROM REQ_RESTITUTION_H where ID_REQ=?";
        $rquery = $this->db->query($query,array($noreq));
        $data = $rquery->result_array();
        return $data[0];
    }

    public function get_restitution_req_cust($noreq){
        $query = "SELECT ID_REQ, VESSEL, VESSEL_CODE,
                   CALL_SIGN, VOYAGE_IN, VOYAGE_OUT,
                   MST_CUSTOMER.CUSTOMER_ID, MST_CUSTOMER.NAME, MST_CUSTOMER.ADDRESS, MST_CUSTOMER.NPWP ,ID_VES_VOY,
                   DATE_REQUEST, ID_PORT, ID_TERMINAL, STATUS_REQ
                FROM REQ_RESTITUTION_H, MST_CUSTOMER where REQ_RESTITUTION_H.CUSTOMER_ID = MST_CUSTOMER.CUSTOMER_ID AND ID_REQ=?";
        $rquery = $this->db->query($query,array($noreq));
        $data = $rquery->result_array();
        return $data[0];
    }


    public function get_restitution_cont($noreq){
        $query = "SELECT ID_REQ, NO_CONTAINER, SIZE_,
                TYPE_, STATUS_, TO_CHAR(GATE_IN, 'DD/MM/RRRR HH24:MI:SS') GATE_IN,
                TO_CHAR(LOAD_DATE,'DD/MM/RRRR HH24:MI:SS') LOAD_DATE, TO_CHAR(DISCH_DATE,'DD/MM/RRRR HH24:MI:SS') DISCH_DATE,
                TO_CHAR(GATE_OUT,'DD/MM/RRRR HH24:MI:SS') GATE_OUT,
                AKTIF
                FROM REQ_RESTITUTION_D WHERE ID_REQ=?";
        $rquery = $this->db->query($query,array($noreq));
        $data = $rquery->result_array();
        return $data;
    }

    public function save_confirm_restitusi($id_req){
        $query_head = "UPDATE REQ_RESTITUTION_H SET STATUS_REQ = 'R' WHERE ID_REQ =?";
        $this->db->query($query_head,array($id_req));
        $query_detail = "UPDATE REQ_RESTITUTION_D SET AKTIF = 'T' WHERE ID_REQ=?";
        $this->db->query($query_detail,array($id_req));
    }

    public function calculate_restitution($id_req){
        $qcalc = "SELECT COUNT (no_container) qty,
                         req_restitution_d.size_,
                         CASE WHEN crane_type LIKE 'QC%' THEN 'CC' ELSE crane_type END crane,
                         COUNT (no_container) * tarif amount,
                         tarif
                    FROM req_restitution_d, mst_tarif
                   WHERE     id_req = ?
                         AND req_restitution_d.size_ = mst_tarif.size_
                         AND CASE WHEN crane_type LIKE 'QC%' THEN 'CC' else crane_type END = mst_tarif.alat
                GROUP BY req_restitution_d.size_, crane_type, tarif";
        $rcalc = $this->db->query($qcalc, $id_req);
        $data = $rcalc->result_array();
        return $data;
    }

    public function sum_restitution($id_req){
        $qsum = "SELECT sum(COUNT (no_container) * tarif) amount
                    FROM req_restitution_d, mst_tarif
                   WHERE     id_req = ?
                         AND req_restitution_d.size_ = mst_tarif.size_
                         AND CASE WHEN crane_type LIKE 'QC%' THEN 'CC' else crane_type END = mst_tarif.alat
                GROUP BY req_restitution_d.size_, crane_type, tarif";
        $rsum = $this->db->query($qsum, $id_req);
        $data = $rsum->result_array();
        return $data[0];
    }

    public function complete_document($id_req){
        $username = $this->session->userdata('uname_phd');
        $qupd = "UPDATE REQ_RESTITUTION_H SET DATE_DOC_OK = SYSDATE, STATUS_REQ = 'D', DDO_USER='$username' WHERE ID_REQ=?";
        $this->db->query($qupd,array($id_req));
    }

    public function complete_request($id_req,$jkk,$remark){
        $username = $this->session->userdata('uname_phd');
        $qupd = "UPDATE REQ_RESTITUTION_H SET DATE_REQ_OK = SYSDATE, NO_JKK = ?, REMARK = ?', STATUS_REQ = 'R', DRO_USER = ? WHERE ID_REQ=?";
        $this->db->query($qupd,array($jkk, $remark, $username, $id_req));
    }

    public function uncomplete_document($id_req){
        $username = $this->session->userdata('uname_phd');
        $qupd = "UPDATE REQ_RESTITUTION_H SET DATE_DOC_NO=SYSDATE, STATUS_REQ = 'T', DDN_USER = ? WHERE ID_REQ=?";
        $this->db->query($qupd,array($username, $id_req));
    }

    public function autocompleteVesselVoy($vessel_name){
        $qselect = "SELECT ID_JOINT_VESSEL, VESSEL, VOYAGE_IN, VOYAGE_OUT, POL, TERMINAL
						FROM MST_SBY_JOINT_VESSEL
					   WHERE VESSEL LIKE '%$vessel_name%' OR VOYAGE_IN LIKE '%$vessel_name%' OR VOYAGE_OUT LIKE '%$vessel_name%'
					ORDER BY ID_JOINT_VESSEL DESC";
        $rdata = $this->db->query($qselect);
        $data = $rdata->result_array();
        return $data;
    }

    public function cancel_restitution($id_req){
        $qdelete = "DELETE REQ_RESTITUTION_H WHERE ID_REQ = ?";
        $this->db->query($qdelete, array($id_req));
        $qdelete1 = "DELETE REQ_RESTITUTION_D WHERE ID_REQ = ?";
        $this->db->query($qdelete1, array($id_req));
    }

    public function getListRequestBM(){
        $qselect = "SELECT PORT_ID, TERMINAL_ID,REQUEST_ID, CASE WHEN MODUL_DESC = 'CALBG' THEN 'BEFORE GATEIN'
					WHEN MODUL_DESC = 'CALAG' THEN 'AFTER GATEIN'
					WHEN MODUL_DESC = 'CALDG' THEN 'DELIVERY' END TIPEBM
					 , VESSEL, VOYAGE_IN, VOYAGE_OUT, STATUS_REQ, TO_CHAR(REQUEST_DATE,'DD/MM/RRRR HH24:MI:SS') TGL_REQ
					 FROM TRANSACTION_LOG WHERE KODE_MODUL = 'PTKM08' ORDER BY TGL_REQ DESC";
        $rselect = $this->db->query($qselect);
        $data = $rselect->result_array();
        return $data;
    }

	public function getRequestHistory($requestid){
        $qselect = "select concat(concat(concat(to_char(last_user_activity_date, 'dd/mm/yyyy hh24:mi:ss'), ':'),
        			concat(b.name, ',')), last_user_activity_code) as history from transaction_log_activity
					a left join mst_user b on a.last_user_activity_userid = b.username
					where request_id = ? and (last_user_activity_code is not null or last_user_activity_code <> '') order by last_user_activity_date desc";
        $rselect = $this->db->query($qselect, array($requestid));
        $data = $rselect->result_array();
        return $data;
	}


	public function create_payment_confirmation($params){
		$query	= "insert into PAYMENT_CONFIRMATION(
						REQUEST_NUMBER, PROFORMA_NUMBER, USER_ID, PAYMENT_METHOD, PAYMENT_VIA, SUBMIT_DATE, PAYMENT_AMOUNT, PAYMENT_CONFIRMATION_STATUS
					)
					values (
						?, ?, ?, ?, ?, SYSDATE, ?, ?
					)";
		return	$this->db->query($query, $params);
	}

    public function validate_receiving_booking_number($booknum,$port_code,$terminal_code)
    {

        $query = "SELECT count(1) total
            FROM transaction_log
            WHERE request_id =  ? and port_id = ? and terminal_id = ? and kode_modul = 'PTKM00'";
		$query 	= $this->db->query($query,array($booknum,$port_code,$terminal_code));
		$hasil=$query->row_array();
		return $hasil['TOTAL'];
    }

	public function setValidDocTransaction($req_id, $flag_code, $flag_yn){
		if ($flag_code == 'npe_file_flag' || $flag_code == 'peb_file_flag' || $flag_code == 'bookship_file_flag' ||
			$flag_code == 'do_file_flag' || $flag_code == 'sppb_file_flag' || $flag_code == 'sp_custom_file_flag'   ){
			$qupd = "update transaction_log set last_user_activity_code = ?, $flag_code = ? where request_id = ?";
			$this->db->query($qupd, array('VALIDATE DOC '.$flag_code, $flag_yn, $req_id));
		}
		return $req_id;
	}

	public function getValidCardPrint($cetekanke,$service)
    {
        $query = "SELECT LIMIT_PRINT
				FROM CARD_CONFIG
				WHERE SERVICE_TYPE = ? ";
		$query 	= $this->db->query($query, array($service));
		$hasil=$query->row_array();

		$valid = $hasil['LIMIT_PRINT']-$cetekanke;

		if($valid>=0)
		{
			$vld = "Y";
		}
		else
		{
			$vld = "N";
		}

		return $vld;
    }

	public function getMaxCardPrint($service)
    {
        $query = "SELECT LIMIT_PRINT
				FROM CARD_CONFIG
				WHERE SERVICE_TYPE = ? ";
		$query 	= $this->db->query($query, array($service));
		$hasil=$query->row_array();

		return $hasil['LIMIT_PRINT'];
    }

	public function update_card_limit($params){
		$query	= "BEGIN IBIS.PROC_CARD_LIMIT(?, ?, ?, ?, ?); END;";
		return	$this->db->query($query, $params);
	}

	public function update_qty_cont($request_id,$type){

		if($type == 'delete') {
			$qty_query = "SELECT CASE WHEN NVL(CONT_QTY,0) = 0 THEN 0
			ELSE NVL(CONT_QTY,0)-1 END NEWQTY FROM transaction_log WHERE request_id = '$request_id'";
		}
		else {
			$qty_query = "SELECT NVL(CONT_QTY,0)+1 NEWQTY FROM transaction_log WHERE request_id = '$request_id'";
		}
		$resultqty = $this->db->query($qty_query);
		$r 				 = $resultqty->row_array();
		$qty 			 = $r['NEWQTY'];
		$params = array(
			'QTY'   			=>	$qty,
			'REQUEST_ID'				=>	$request_id
		);
		$query = "UPDATE transaction_log SET CONT_QTY = ? WHERE request_id = ?";
		$this->db->query($query,$params);
	}

	public function getValidBookNo($noreq)
	{
		$query = "select count(*) JML from transaction_log where REQUEST_ID= ?";
		$query 	= $this->db->query($query, array($noreq));
		$hasil=$query->row_array();
		return isset($hasil['JML']) ? $hasil['JML'] : 'NO_DATA_FOUND';
	}

	public function update_qty_all($qty,$request_id){
		$params = array(
			'QTY'   			=>	$qty,
			'REQUEST_ID'				=>	$request_id
		);
		$query = "UPDATE transaction_log SET CONT_QTY = ? WHERE request_id = ?";
		$this->db->query($query,$params);
	}

	public function getDataTerminal($term)
	{
		$query = "select port, terminal, terminal_name from mst_terminal where id_sub_group = ?";
		$query = $this->db->query($query, array($term));
		$hasil = $query->row_array();
		return $hasil;
	}

	public function getNoRequest($request_id,$id_port)
	{	
		$qselect = "select BILLER_REQUEST_ID,MODUL_DESC,PORT_ID,TERMINAL_ID FROM TRANSACTION_LOG WHERE REQUEST_ID = '$request_id' and PORT_ID = '$id_port'";
		
		$rselect = $this->db->query($qselect);
        $data = $rselect->row_array();
		// return $this->db->last_query();
        return $data;
	}

	public function getNoRequestByCustomer($request_id,$id_port,$customer_id)
	{	
			$del = "";
			if($id_port=="IDPNJ"){
				$del = " AND MODUL_DESC IN ('DELIVERY','PERPANJANGAN DELIVERY')";
			}
			$qselect = "select REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,PORT_ID,TERMINAL_ID FROM TRANSACTION_LOG WHERE REQUEST_ID = '$request_id' and PORT_ID = '$id_port' and CUSTOMER_ID = '$customer_id' $del";
			
			$rselect = $this->db->query($qselect);
	        $data = $rselect->result();
			// return $this->db->last_query();
	        return $data;
	}

	public function getHdrGrup($noreq)
	{		
		$query = "select PRF_NUMBER from transaction_log where REQUEST_ID= ?";
		$query = $this->db->query($query, array($noreq));
		$hasil = $query->row_array();
		$prfNumber = isset($hasil['PRF_NUMBER']) ? $hasil['PRF_NUMBER'] : '';

		if(substr($prfNumber, 3, 1)=="." and substr($prfNumber, 4, 1)=="8")
			$data = "TPK";
		else
			$data = "PTP";

		return $data;
	}

	public function getDataRbm($search = "")
	{
		if (!empty($search))
		{
			$search = " AND REQUEST_ID LIKE '%$search%'";
		} 
		else 
		{
			$search = "";
		}

		$query = "SELECT * FROM transaction_log WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' $search ORDER BY REQUEST_ID DESC";
		$query = $this->db->query($query);
		$hasil = $query->result_array();
		return $hasil;
	}

	public function getDataRbmByCustomer($search = "", $customer_id = "")
	{
		if (!empty($search))
		{
			$search = " AND REQUEST_ID LIKE '%$search%'";
		} 
		else 
		{
			$search = "";
		}

		$query = "SELECT * FROM transaction_log WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' $search AND CUSTOMER_ID = '".$customer_id."' ORDER BY REQUEST_ID DESC";
		$query = $this->db->query($query);
		// return $this->db->last_query();
		$hasil = $query->result_array();
		return $hasil;
	}

	public function getDataRbmByID($id) 
	{
		$query = "SELECT request_id, vessel, voyage_in, voyage_out, eta, etd, port_id, terminal_id, reject_notes, do_file, no_ukk,customer_id, customer_name, customer_address, customer_taxid, status_req, do_file,kategori,port_id,terminal_id FROM transaction_log WHERE request_id = ?";
		$query = $this->db->query($query, array($id));
		$hasil = $query->row_array();
		return $hasil;
	}

	public function notesHistoryRbm($req_id)
	{
        $qselect = "SELECT concat(concat(concat(to_char(date_rejection, 'dd/mm/yyyy hh24:mi:ss'), ', '),
        			concat(user_rejection, ': ')), note_rejection) AS history, file_upload FROM history_rejection_rbm
					WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND request_id = ? AND (date_rejection IS NOT NULL) ORDER BY date_rejection DESC";
        $rselect = $this->db->query($qselect, array($req_id));
        $data = $rselect->result_array();
        return $data;
	}

	public function getAllNotesHistoryRbmByID($req_id)
	{
        $qselect = "SELECT * FROM history_rejection_rbm
					WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND request_id = ? ORDER BY date_rejection DESC";
        $rselect = $this->db->query($qselect, array($req_id));
        $data = $rselect->result_array();
        return $data;
	}

	public function deleteHistoryRejectionRbm($req_id)
	   {
        $qdelete = "DELETE history_rejection_rbm WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND request_id = ?";
        $this->db->query($qdelete, array($id_req));
    }

	public function approvalnRbm($req_id) 
	{
		$query = "UPDATE transaction_log
					SET STATUS_REQ = 'AP' 
					WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND REQUEST_ID = ?";
		return $this->db->query($query, array($req_id));
	}

	public function rejectionRbm($req_id, $notes, $file) 
	{
		// $this->db->where('REQUEST_ID', $req_id);
		// return $this->db->update('transaction_log', $data);

		$query = "UPDATE transaction_log 
					SET STATUS_REQ = 'R', REJECT_NOTES = ?, DO_FILE = ?
					WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND REQUEST_ID = ?";
		return $this->db->query($query, array($notes, $file, $req_id));
	}

	public function approveRejectionListRbm()
	{
		$query = "SELECT * FROM transaction_log WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND STATUS_REQ = 'R' OR STATUS_REQ = 'AR'";
		$query = $this->db->query($query);
		$hasil = $query->result_array();
		return $hasil;
	}
	
		public function approveRejectFinal($req_id) 
	{
		$query = "UPDATE transaction_log 
					SET STATUS_REQ = 'AR' 
					WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND REQUEST_ID = ?";
		return $this->db->query($query, array($req_id));
	}

	public function rejected_ApprovalRbm($req_id, $notes, $file) 
	{
		$query = "UPDATE transaction_log 
					SET STATUS_REQ = 'W', REJECT_NOTES = ?, DO_FILE = ?
					WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND REQUEST_ID = ?";
		return $this->db->query($query, array($notes, $file, $req_id));
	}

	public function historyRejection($params)
	{
        $query	= "INSERT INTO HISTORY_REJECTION_RBM (
						REQUEST_ID, DATE_REJECTION, USER_REJECTION, STATUS_REJECTION, NOTE_REJECTION, FILE_UPLOAD
					)
					VALUES (
						?, SYSDATE, ?, ?, ?, ?
					)";
		return $this->db->query($query, $params);
	}

	public function reload_rbm($req_id, $port_code, $terminal_code, $no_ukk, $vessel, $voyage_in, $voyage_out, $customer_name, $address, $npwp, $eta, $etd) 
	{
		$query = "UPDATE transaction_log 
						SET PORT_ID = ?,
							TERMINAL_ID = ?,
							NO_UKK = ?,
							VESSEL = ?,
							VOYAGE_IN = ?,
							VOYAGE_OUT = ?,
							DO_FILE = '',
							CUSTOMER_NAME = ?,
							CUSTOMER_ADDRESS = ?,
							customer_taxid = ?,
							REJECT_NOTES = '',
							STATUS_REQ = 'N',
							ETA = ?,
							ETD = ?
						WHERE SUBSTR(REQUEST_ID, 0, 3) = 'RBM' AND REQUEST_ID = ?";
		return $this->db->query($query, array($port_code, $terminal_code, $no_ukk, $vessel, $voyage_in, $voyage_out, $customer_name, $address, $npwp, $eta, $etd, $req_id));
	}

	public function cek_rbm($no_ukk,$req_id)
	{

	        $query = "SELECT count(*) total
	            FROM transaction_log
	            WHERE no_ukk = ? AND (STATUS_REQ = 'N' OR STATUS_REQ = 'W' OR STATUS_REQ = 'R') AND SUBSTR(REQUEST_ID, 0,3) = 'RBM' AND REQUEST_ID <> ?";
			$query 	= $this->db->query($query,array($no_ukk,$req_id));
			$hasil=$query->row_array();
			// return $this->db->last_query();
			return $hasil['TOTAL'];
	}

	public function deleteTransactionLogLoadingCancel($request_no)
	{
        $qdelete = "DELETE transaction_log WHERE request_id = ?";
        $this->db->query($qdelete, array($request_no));
    }
	
	public function getCheckRFID($port)
	{
		$query = "SELECT NVL(MAX(STATUS_RFID), 0) STAT FROM CONFIG_TERMINAL WHERE TERMINAL_CODE = '$port' ";
		$query 	= $this->db->query($query);
		$hasil = $query->row_array();
		return $hasil['STAT'];
	}	

	public function getIdPort($term)
	{
		$query = "select id_port from mst_terminal where id_sub_group = ?";
		$query = $this->db->query($query, array($term));
		$hasil = $query->row_array();

		$terminal_code = '';
		
		if($hasil['ID_PORT'] != null){
			$terminal_code = $hasil['ID_PORT'];

		}else{
			$terminal_code = '';
		}

		return $terminal_code;
	}
	
}
?>
