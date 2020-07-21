<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class transaction_log extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');

		$this->load->library('breadcrumbs');
		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');
	}


	public function redirect()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
	}


	public function common_loader($data, $views)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function receivecontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		} else {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendreceivecontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectreceivingcontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvereceivingcontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function deliverycontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		} else {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function senddeliverycontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectdeliverycontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvedeliverycontainer_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function receivecargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST RECEIVING CARGO','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		} else {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST RECEIVING CARGO','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendreceivecargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL RECEIVING CARGO','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectreceivecargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL RECEIVING CARGO','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvereceivecargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL RECEIVING CARGO','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function stuffing_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		} else {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendstuffing_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectstuffing_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvestuffing_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function stripping_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		} else {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendstripping_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectstripping_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvestripping_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectdeliverycargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvedeliverycargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectfumi_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvefumi_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejectplug_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL PLUGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approveplug_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL PLUGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecttl_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvetl_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtl_del_cargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtl_del_cargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtl_del_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtl_del_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtlrec_cargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL RECEIVING BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtlrec_cargo_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL RECEIVING BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtlrec_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtlrec_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL RECEIVING CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtl_stuf_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtl_stuf_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtl_tl_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtl_tl_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtl_plug_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL PLUGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtl_plug_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL PLUGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	function rejecbtl_fumi_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT APPROVAL BATAL FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approvebtl_fumi_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE APPROVAL BATAL FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function savepayment_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SAVE PAYMENT','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function approveproforma_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE PROFORMA','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function rejectproforma_log()
	{
		$maxVal = 1;
		$format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '" . $format . "%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format . $autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT PROFORMA','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function fumigasi_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendfumigasi_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL FUMIGASI','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function pluggingreefer_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST PLUGGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST PLUGGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendpluggingreefer_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL PLUGGIN REEFER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function deliverybarang_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function senddeliverybarang_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function trucklosing_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendtrucklosing_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL TRUCK LOOSING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function deliverycontainerext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST EXTENSION DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST EXTENSION DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function senddeliverycontainerext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL EXTENSION DELIVERY CONTAINER','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function deliverybarangext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST EXTENSION DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST EXTENSION DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function senddeliverybarangext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL EXTENSION DELIVERY BARANG','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function stuffingext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST EXTENSION STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST EXTENSION STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendstuffingext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL EXTENSION STUFFING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}

	public function strippingext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal; 

		$REQUEST_ID 				= $format.$autoNumber;
		$STATUS_REQ					= $this->input->post('status_req');
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST EXTENSION STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";				
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST EXTENSION STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
			return $this->db->query($query);
		}
	}

	public function sendstrippingext_log()
	{
		$maxVal =1;
	    $format = 'OLNPKS';
		$autoNumber = '000000';
		$request_no = '';

		$query = "SELECT MAX(SUBSTR(REQUEST_ID,-6)+1) max_val FROM TRANSACTION_LOG WHERE REQUEST_ID LIKE '".$format."%'";
		$res = $this->db->query($query);
		$result = $res->result();
		$maxVal = $result[0]->MAX_VAL;
		$autoNumber = substr($autoNumber, strlen($maxVal));
		$autoNumber .= $maxVal;

		$REQUEST_ID 				= $format.$autoNumber;
		$BILLER_REQUEST_ID			= $this->input->post('no_req');
		$CUSTOMER_ID				= $this->session->userdata('customerid_phd');
		$CUSTOMER_NAME				= $this->session->userdata('customernamealt_phd');
		$CUSTOMER_ADDRESS			= $this->session->userdata('address_phd');
		$CUSTOMER_TAXID				= $this->session->userdata('npwp_phd');

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL EXTENSION STRIPPING','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID')";
		return $this->db->query($query);
	}
}
