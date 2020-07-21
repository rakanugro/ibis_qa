<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class transaction_log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('booking_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('npkbilling/requests/bm_request_model');
		$this->load->library("nusoap_lib");
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
	}


	public function redirect()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
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

	public function bm_log()
	{
	    $maxVal =1;
	    $format = 'OLNPK';
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
		$TERMINAL_ID				= $this->input->post('terminal_id');
		$CUSTOMER_ID				= $this->input->post('cust_id');
		$CUSTOMER_NAME				= $this->input->post('cust_name');
		$CUSTOMER_ADDRESS			= $this->input->post('cust_address');
		$CUSTOMER_TAXID				= $this->input->post('cust_npwp');
		$NO_UKK						= $this->input->post('ukk');
		$VESSEL						= $this->input->post('vessel_name');
		$VOYAGE_IN					= $this->input->post('voyage_in');
		$VOYAGE_OUT					= $this->input->post('voyage_out');
		$ETA						= $this->input->post('eta');
		$ETD						= $this->input->post('etd');
		$LAST_USER_ACTIVITY_USERID	= $this->session->userdata('name_phd');
		$REQUEST_DATE				= $this->input->post('req_date');
		$REQUEST_BY					= $this->session->userdata('name_phd');


		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,TERMINAL_ID,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID,REQUEST_BY,NO_UKK,VESSEL,VOYAGE_IN,VOYAGE_OUT,LAST_USER_ACTIVITY_USERID,ETA,ETD) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST BONGKAR MUAT','$TERMINAL_ID','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID','$REQUEST_BY','$NO_UKK','$VESSEL','$VOYAGE_IN','$VOYAGE_OUT','$LAST_USER_ACTIVITY_USERID','$ETA','$ETD')";
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,TERMINAL_ID,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID,REQUEST_BY,NO_UKK,VESSEL,VOYAGE_IN,VOYAGE_OUT,LAST_USER_ACTIVITY_USERID,ETA,ETD) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST BONGKAR MUAT','$TERMINAL_ID','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID','$REQUEST_BY','$NO_UKK','$VESSEL','$VOYAGE_IN','$VOYAGE_OUT','$LAST_USER_ACTIVITY_USERID','$ETA','$ETD')";
			return $this->db->query($query);
		}
	}

	public function delivery_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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
		$TERMINAL_ID				= $this->input->post('terminal_id');
		$CUSTOMER_ID				= $this->input->post('cust_id');
		$CUSTOMER_NAME				= $this->input->post('cust_name');
		$CUSTOMER_ADDRESS			= $this->input->post('cust_address');
		$CUSTOMER_TAXID				= $this->input->post('cust_npwp');
		$NO_UKK						= $this->input->post('ukk');
		$VESSEL						= $this->input->post('vessel_name');
		$VOYAGE_IN					= $this->input->post('voyage_in');
		$VOYAGE_OUT					= $this->input->post('voyage_out');
		$ETA						= $this->input->post('eta');
		$ETD						= $this->input->post('etd');
		$LAST_USER_ACTIVITY_USERID	= $this->session->userdata('name_phd');
		$MODUL_DESC					= 'DELIVERY';
		$REQUEST_DATE				= $this->input->post('req_date');
		$REQUEST_BY					= $this->session->userdata('name_phd');


		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,TERMINAL_ID,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID,REQUEST_BY,NO_UKK,VESSEL,VOYAGE_IN,VOYAGE_OUT,LAST_USER_ACTIVITY_USERID,ETA,ETD) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST DELIVERY','$TERMINAL_ID','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID','$REQUEST_BY','$NO_UKK','$VESSEL','$VOYAGE_IN','$VOYAGE_OUT','$LAST_USER_ACTIVITY_USERID','$ETA','$ETD')";
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,TERMINAL_ID,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID,REQUEST_BY,NO_UKK,VESSEL,VOYAGE_IN,VOYAGE_OUT,LAST_USER_ACTIVITY_USERID,ETA,ETD) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST DELIVERY','$TERMINAL_ID','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID','$REQUEST_BY','$NO_UKK','$VESSEL','$VOYAGE_IN','$VOYAGE_OUT','$LAST_USER_ACTIVITY_USERID','$ETA','$ETD')";
			return $this->db->query($query);
		}
	}

	public function receiving_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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
		$TERMINAL_ID				= $this->input->post('terminal_id');
		$CUSTOMER_ID				= $this->input->post('cust_id');
		$CUSTOMER_NAME				= $this->input->post('cust_name');
		$CUSTOMER_ADDRESS			= $this->input->post('cust_address');
		$CUSTOMER_TAXID				= $this->input->post('cust_npwp');
		$NO_UKK						= $this->input->post('ukk');
		$VESSEL						= $this->input->post('vessel_name');
		$VOYAGE_IN					= $this->input->post('voyage_in');
		$VOYAGE_OUT					= $this->input->post('voyage_out');
		$ETA						= $this->input->post('eta');
		$ETD						= $this->input->post('etd');
		$LAST_USER_ACTIVITY_USERID	= $this->session->userdata('name_phd');
		$MODUL_DESC					= 'RECEIVING';
		$REQUEST_DATE				= $this->input->post('req_date');
		$REQUEST_BY					= $this->session->userdata('name_phd');


		if ($STATUS_REQ == "") {
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,TERMINAL_ID,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID,REQUEST_BY,NO_UKK,VESSEL,VOYAGE_IN,VOYAGE_OUT,LAST_USER_ACTIVITY_USERID,ETA,ETD) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST RECEIVING','$TERMINAL_ID','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID','$REQUEST_BY','$NO_UKK','$VESSEL','$VOYAGE_IN','$VOYAGE_OUT','$LAST_USER_ACTIVITY_USERID','$ETA','$ETD')";
			return $this->db->query($query);
		}else{
			$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC,TERMINAL_ID,CUSTOMER_ID,CUSTOMER_NAME,CUSTOMER_ADDRESS,CUSTOMER_TAXID,REQUEST_BY,NO_UKK,VESSEL,VOYAGE_IN,VOYAGE_OUT,LAST_USER_ACTIVITY_USERID,ETA,ETD) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST RECEIVING','$TERMINAL_ID','$CUSTOMER_ID','$CUSTOMER_NAME','$CUSTOMER_ADDRESS','$CUSTOMER_TAXID','$REQUEST_BY','$NO_UKK','$VESSEL','$VOYAGE_IN','$VOYAGE_OUT','$LAST_USER_ACTIVITY_USERID','$ETA','$ETD')";
			return $this->db->query($query);
		}
	}

	public function sendBM_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL BONGKAR MUAT')";
		return $this->db->query($query);
	}

	public function sendRec_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL RECEIVING')";
		return $this->db->query($query);
	}

	public function sendDel_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL DELIVERY')";
		return $this->db->query($query);
	}

	public function extension_insert_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST EXTENSION')";
		return $this->db->query($query);
	}

	public function extension_update_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST EXTENSION')";
		return $this->db->query($query);
	}

	public function sendExt_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL REQUEST EXTENSION')";
		return $this->db->query($query);
	}

	public function lumpsum_insert_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT REQUEST LUMPSUM')";
		return $this->db->query($query);
	}

	public function lumpsum_update_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE REQUEST LUMPSUM')";
		return $this->db->query($query);
	}

	public function sendLumps_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND APPROVAL REQUEST LUMPSUM')";
		return $this->db->query($query);
	}

	public function print_uper_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','PRINT UPER')";
		return $this->db->query($query);
	}

	public function print_proforma_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','PRINT PROFORMA')";
		return $this->db->query($query);
	}

	public function approve_proforma_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','APPROVE PROFORMA')";
		return $this->db->query($query);
	}

	public function reject_proforma_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','REJECT PROFORMA')";
		return $this->db->query($query);
	}

	public function print_invoice_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','PRINT INVOICE')";
		return $this->db->query($query);
	}

	public function cash_uper()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','BAYAR UPER')";
		return $this->db->query($query);
	}

	public function insert_tca_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','INSERT TCA')";
		return $this->db->query($query);
	}

	public function update_tca_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','UPDATE TCA')";
		return $this->db->query($query);
	}

	public function sendTca_log()
	{
		$maxVal =1;
	    $format = 'OLNPK';
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

		$query	= "INSERT INTO TRANSACTION_LOG(REQUEST_ID,BILLER_REQUEST_ID,MODUL_DESC) VALUES('$REQUEST_ID','$BILLER_REQUEST_ID','SEND TCA TOS')";
		return $this->db->query($query);
	}

}