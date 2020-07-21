<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class manage extends CI_Controller
{

	var $API = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('auth_model', 'auth_model');
		/*if (! $this->session->userdata('is_login') ){
		 	redirect('main_invoice');
		}*/
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('branch_model');
		$this->load->model('container_model');
		$this->load->library("nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		define('IMAGES_ENTITY_', APP_ROOT . "uploads/ttd/");
		define('IMAGES_TTD_', APP_ROOT . "uploads/ttd/");
		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');


		$this->load->model('biller_model');
		$this->load->model('bank_model');



		// if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
		// 	redirect(ROOT.'mainpage', 'refresh');
		// $this->API=API_EINVOICE;


	}
	protected function getdataurl($url)
	{
		$uri = API_EINVOICE . '/' . $url;

		//print_r($uri); die();
		//$uri = SITE_WSAPI.'/'.$url;
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		$data  = json_decode(curl_exec($ch));
		return $data;
	}
	function biller()
	{
		$user_id = $this->session->userdata('user_id');
		$unit_branch = $this->session->userdata('unit_id');
		$branch_implode = json_decode($unit_branch, true);
		$unit_id = $this->biller_model->getBranchId($branch_implode[0]);
		$current_unit = $unit_id[0]->INV_UNIT_ORGID;

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$this->breadcrumbs->push("Master Biller", '/');
		$this->breadcrumbs->unshift('Manage VA', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$role_id =  $this->session->userdata('role_id');
		$unit_id = $this->session->userdata('unit_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);

		if($current_unit == 87) {
			$data['unit1'] = $this->biller_model->getDataUnit($role_id);
		} else {
			$data['unit1'] = $this->biller_model->getDataBranch($current_unit);
		}

		$data['title'] = "Master Biller";

		//$role_id =  $this->session->userdata('role_id');


		/*if ($this->session->userdata('role_type') == 'Super Admin') {

			$data['unit'] = $this->biller_model->getDataUnit();
			$data['unit1'] = $this->biller_model->getDataUnit();
		} else {

			$data['unit'] = $this->biller_model->getDataUnit();
			$data['unit1'] = $this->biller_model->getDataUnit();
			$data['layanan'] = $this->auth_model->get_layanan($role_id);
			// $data['entity'] = $this->senddataurl('entity/search/',$dataArray,'POST');

		}
		$role_id =  $this->session->userdata('role_id');*/

		$this->common_loader($data, 'pages/va/master_biller');
	}

	public function common_loader($data, $views)
	{
		if (!$this->session->userdata('is_login')) {
			redirect('main_invoice');
		}
		$role_id =  $this->session->userdata('role_id');
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}


	function masterbillersearch()
	{
		$user_id = $this->session->userdata('user_id');
		$unit_branch = $this->session->userdata('unit_id');
		$branch_implode = json_decode($unit_branch, true);
		$unit_id = $this->biller_model->getBranchId($branch_implode[0]);
		$current_unit = $unit_id[0]->INV_UNIT_ORGID;

		$postdata = ($_POST);
		$id = $postdata['ID'];

		if($current_unit != 87) {
			$dataArray = $this->biller_model->getDataBillers($where, $unit_id[0]->INV_UNIT_ID);
			$dataCabang = $this->branch_model->getBranchOptions($unit_id[0]->INV_UNIT_ORGID);
		} else {
			$dataArray = $this->biller_model->getDataBiller();
			// $dataCabang = $this->branch_model->getBranchOptions($unit_id[0]->INV_UNIT_ORGID);
		}

		$data = array(
			'data' => array()
		);
		$num = 1;
		foreach ($dataArray as $key => $value) {
			//echo json_encode($value);
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values, ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
			$data['data'][$key]['action'] = '<button type="button" onclick="editbiller(\'' . $data['data'][$key]['ID'] . '\')"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_biller">Edit</button>';

			$num++;
		}
		echo json_encode($data);
	}

	function masterbilleredit()
	{
		$user_id = $this->session->userdata('user_id');
		$unit_branch = $this->session->userdata('unit_id');
		$branch_implode = json_decode($unit_branch, true);
		$unit_id = $this->biller_model->getBranchId($branch_implode[0]);
		$current_unit = $unit_id[0]->INV_UNIT_ORGID;

		$postdata = ($_POST);
		$id = $postdata['ID'];
		if ($postdata['ID'] != null) {
			$where = "WHERE ID = '" . $postdata['ID'] . "' AND ROWNUM = 1";
		}

		$data = array();

		if($current_unit == 87) {
			$dataArray = $this->biller_model->getDataBillerWhereId($postdata['ID']);
		} else {
			$dataArray = $this->biller_model->getDataBillers($where, $unit_id[0]->INV_UNIT_ID);
		}

		foreach ($dataArray as $key => $value) {
			$data['ID'] = $value->ID;
			$data['NAMA_BILLER'] = $value->NAMA_BILLER;
			$data['TELEPON'] = $value->TELEPON;
			$data['KODE_BILLER'] = $value->KODE_BILLER;
			$data['EMAIL'] = $value->EMAIL;
			$data['NPWP'] = $value->NPWP;
			$data['STATUS'] = $value->STATUS;
			$data['INV_ID_UNIT'] = $value->INV_ID_UNIT;
			$data['ALAMAT'] = $value->ALAMAT;
			$data['KOTA'] = $value->KOTA;
			$data['KODE_CABANG'] = $value->KODE_CABANG;
		}
		echo json_encode($data);
	}

	function savebiller()
	{
		$this->form_validation->set_rules('KODE_BILLER', 'Kode', 'required');
		$this->form_validation->set_rules('TELEPON', 'Telepon', 'required|max_length[14]');
		$this->form_validation->set_rules('EMAIL', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('KOTA', 'Kota', 'required');
		$this->form_validation->set_rules('ALAMAT', 'Alamat', 'required');
		$this->form_validation->set_rules('NPWP', 'Npwp', 'required|numeric|exact_length[15]');
		$this->form_validation->set_rules('STATUS', 'Status', 'required|in_list[0,1]');
		$this->form_validation->set_rules('UNIT', 'Unit');

		$user_id = $this->session->userdata('user_id');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			echo json_encode(array('status' => 'error', 'error' => $errors));
			exit;
		} else {
			$param = array(
				"NAMA_BILLER" => $this->input->post("NAME_BILLER"),
				"TELEPON" => $this->input->post("TELEPON"),
				"KODE_BILLER" => $this->input->post("KODE_BILLER"),
				"EMAIL" => $this->input->post("EMAIL"),
				"KOTA" => $this->input->post("KOTA"),
				"ALAMAT" => $this->input->post("ALAMAT"),
				"NPWP" => $this->input->post("NPWP"),
				"STATUS" => $this->input->post("STATUS"),
				"INV_UNIT_ID" => $this->input->post("UNIT"),
				"CREATED_BY" => $user_id,
				"KODE_CABANG" => $this->input->post("KODE_CABANG")
			);
			//print_r($param);
			//exit;

			$respon = new stdClass();
			$insert = $this->biller_model->insert_biller($param);
			if ($insert) {
				echo json_encode(array('status' => 'success', 'msg' => ' Record added successfully.'));
				exit;
			} else {
				echo json_encode(array('status' => 'error', 'msg' => 'Data gagal di simpan.'));
				exit;
			}
		}
	}

	function masterbillerupdate()
	{
		$user_id = $this->session->userdata('user_id');

		$this->form_validation->set_rules('KODE_BILLER', 'Kode', 'required');
		$this->form_validation->set_rules('TELEPON', 'Telepon', 'required|max_length[14]');
		$this->form_validation->set_rules('EMAIL', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('KOTA', 'Kota', 'required');
		$this->form_validation->set_rules('ALAMAT', 'Alamat', 'required');
		$this->form_validation->set_rules('NPWP', 'Npwp', 'required|numeric|exact_length[15]');
		$this->form_validation->set_rules('STATUS', 'Status', 'required|in_list[0,1]');
		$this->form_validation->set_rules('UNIT', 'Unit', 'required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			echo json_encode(array('status' => 'error', 'error' => $errors));
			exit;
		} else {
			$param = array(
				"NAMA_BILLER" => $this->input->post("NAMA_BILLER"),
				"TELEPON" => $this->input->post("TELEPON"),
				"KODE_BILLER" => $this->input->post("KODE_BILLER"),
				"EMAIL" => $this->input->post("EMAIL"),
				"KOTA" => $this->input->post("KOTA"),
				"ALAMAT" => $this->input->post("ALAMAT"),
				"NPWP" => $this->input->post("NPWP"),
				"STATUS" => $this->input->post("STATUS"),
				"INV_UNIT_ID" => $this->input->post("UNIT"),
				"KODE_CABANG" => $this->input->post("KODE_CABANG"),
				"ID" => $this->input->post("ID"),
			);
			//print_r($param);
			//exit();

			$check = $this->biller_model->checkBiller($this->input->post("KODE_BILLER"), $user_id);

			$check_code = $this->biller_model->checkKodeCabang($this->input->post("KODE_CABANG"), $user_id);

			if ($check_code) {
				echo json_encode(array('status' => 'error', 'msg' => 'Data kode cabang telah digunakan, silahkan gunakan yang lain'));
				exit;
			}

			if (!$check && !$check_code) {
				$result = $this->biller_model->update_biller($param);
				if ($result) {
					$result = 'success';
					echo json_encode($result);
					exit;
				}
			}

			echo json_encode(array('status' => 'error', 'msg' => 'Data kode biller telah digunakan, silahkan gunakan yang lain'));
			exit;
		}
	}

	protected function senddataurl($url, $data, $type)
	{

		$time = time();
		// file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", $ex, FILE_APPEND);
		$uri = API_EINVOICE . '/' . $url;
		// die($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/x-www-form-urlencoded',
			'x-api-key:' . $apiKey
		);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$ex = curl_exec($ch);
		$result  = json_decode($ex);
		#debug file
		/*file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
	         	array(
	         		"body" => $ex,
	         		"url" => $uri,
	         		"data" => $data,
	         ),true), FILE_APPEND);*/
		return $result;
	}

	public function redirect()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
	}

	function bank()
	{

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$this->breadcrumbs->push("Master Bank", '/');
		$this->breadcrumbs->unshift('Manage VA', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$role_id =  $this->session->userdata('role_id');
		$data['layanan'] = $this->auth_model->get_layanan($role_id);

		$data['title'] = "Master Bank";

		// if($this->session->userdata('role_type') == 'Super Admin') {

		// 	$data['unit'] = $this->biller_model->getDataUnit();

		// } else {

		// 	$data['unit'] = $this->biller_model->getDataUnit();
		// 	// $data['entity'] = $this->senddataurl('entity/search/',$dataArray,'POST');

		// }


		$role_id =  $this->session->userdata('role_id');

		$this->common_loader($data, 'pages/va/master_bank');
	}
	function save_bank()
	{
		$param = array();
		// echo json_encode($this->input->post());
		// die();
		$param = array(
			"KODE_BANK" => $this->input->post("KODE_BANK"),
			"NAME_BANK" => $this->input->post("NAMA_BANK"),
			"STATUS" => $this->input->post("STATUS")
		);

		$respon = new stdClass();
		$insert = $this->bank_model->insert_bank($param);
		if ($insert) {
			$respon->status = 'success';
		} else {
			$respon->status = 'failed';
		}

		echo json_encode($respon);
	}

	function masterbanksearch()
	{
		$postdata = ($_POST);


		if ($postdata['SEARCH'] != null && $postdata['SEARCH_BY'] != null) {
			if ($postdata['SEARCH_BY'] == 'Bank Code') {
				$where = "WHERE KODE_BANK = '" . $postdata['SEARCH'] . "'";
			} else {
				$where = "WHERE NAMA_BANK = '" . $postdata['SEARCH'] . "'";
			}
		}

		// echo json_encode($where);
		// die();
		$dataArray = $this->bank_model->getDataBank($where);

		$data = array(
			'data' => array()
		);
		$num = 1;
		foreach ($dataArray as $key => $value) {
			// echo json_encode($value);
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values, ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
			$data['data'][$key]['action'] = '<button type="button" onclick="editbank(\'' . $data['data'][$key]['ID'] . '\')"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_bank">Edit</button>';

			$num++;
		}
		echo json_encode($data);
	}

	function masterbankedit()
	{
		$postdata = ($_POST);
		$id = $postdata['ID'];
		if ($postdata['ID'] != null) {
			$where = "WHERE ID = '" . $postdata['ID'] . "' AND ROWNUM = 1";
		}

		$data = array();
		$dataArray = $this->bank_model->getDataBank($where);
		foreach ($dataArray as $key => $value) {
			$data['KODE_BANK'] = $value->KODE_BANK;
			$data['NAMA_BANK'] = $value->NAMA_BANK;
			$data['STATUS_BANK'] = $value->STATUS;
		}
		echo json_encode($data);
	}

	function masterbankupdate()
	{
		$postdata = ($_POST);
		$param = array(
			"KODE_BANK" => $postdata['KODE_BANK'],
			"NAMA_BANK" => $postdata['NAMA_BANK'],
			"STATUS_BANK" => $postdata['STATUS_BANK'],
			"ID" => $postdata['ID'],
		);

		$result = $this->bank_model->update_bank($param);
		$unactive_config_biller = $this->bank_model->config_biller($postdata['ID'], $postdata['STATUS_BANK']);
		if ($result) {
			$result = 'success';
		}
		echo json_encode($result);
	}


	function config_biller_bank()
	{
		$user_id = $this->session->userdata('user_id');
		$unit_branch = $this->session->userdata('unit_id');
		$branch_implode = json_decode($unit_branch, true);
		$unit_id = $this->biller_model->getBranchId($branch_implode[0]);
		$current_unit = $unit_id[0]->INV_UNIT_ORGID;
		$role_id =  $this->session->userdata('role_id');

		$data['biller'] = $this->bank_model->getDataBiller($unit_id[0]->INV_UNIT_ID);
		$data['biller1'] = $this->bank_model->getDataBiller($unit_id[0]->INV_UNIT_ID);
		$data['bank'] = $this->bank_model->getDataBanks();
		$data['bank1'] = $this->bank_model->getDataBanks();
		$data['layanan'] = $this->auth_model->get_layanan($role_id);

		$this->common_loader($data, 'pages/va/master_config_biller_bank');
	}

	function save_config_biller_bank()
	{
		$params = array();
		// echo json_encode($this->input->post());
		// die();
		$params = array(
			"ID_BILLER" => $this->input->post("ID_BILLER"),
			"ID_BANK" => $this->input->post("ID_BANK"),
			"NAMA_CONFIG" => $this->input->post("NAMA_CONFIG"),
			"NO_ACCOUNT" => $this->input->post("NO_ACCOUNT"),
			"MERCHANT_CODE" => $this->input->post("MERCHANT_CODE"),
			"PAYMENT_CODE" => $this->input->post("PAYMENT_CODE"),
			"STATUS" => $this->input->post("STATUS")
		);
		//print_r($param);
		//exit;

		$respon = new stdClass();
		$insert = $this->bank_model->insert_config_biller_bank($params);
		if ($insert) {
			$respon->status = 'success';
		} else {
			$respon->status = 'success';
		}

		echo json_encode($respon);
	}

	function masterconfigbanksearch()
	{
		$user_id = $this->session->userdata('user_id');
		$unit_branch = $this->session->userdata('unit_id');
		$branch_implode = json_decode($unit_branch, true);
		$unit_id = $this->biller_model->getBranchId($branch_implode[0]);
		$current_unit = $unit_id[0]->INV_UNIT_ORGID;

		if($current_unit != 87) {
			$dataArray = $this->bank_model->getDataConfigBillerBank('false', $unit_id[0]->INV_UNIT_ID);
		} else {
			$dataArray = $this->bank_model->getDataConfigBillerBank('true');
		}

		$data = array(
			'data' => array()
		);
		$num = 1;
		foreach ($dataArray as $key => $value) {
			// echo json_encode($value);
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values, ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
			$data['data'][$key]['action'] = '<button type="button" onclick="editbillerbank(\'' . $data['data'][$key]['ID'] . '\')"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update_bb">Edit</button>';

			$num++;
		}
		echo json_encode($data);
	}

	function masterbillerbankedit()
	{
		$postdata = ($_POST);
		$id = $postdata['ID'];
		if ($postdata['ID'] != null) {
			$where = "WHERE cb.ID = '" . $postdata['ID'] . "' AND ROWNUM = 1";
		}

		$data = array();

		$dataArray = $this->bank_model->getBillerCurrent($postdata['ID']);

		foreach ($dataArray as $key => $value) {
			$data['ID_BANK'] = $value->ID_BANK;
			$data['ID_BILLER'] = $value->ID_BILLER;
			$data['NAMA_CONFIG'] = $value->NAMA_CONFIG;
			$data['MERCHANT_CODE'] = $value->MERCHANT_CODE;
			$data['PAYMENT_CODE'] = $value->PAYMENT_CODE;
			$data['NO_ACCOUNT'] = $value->NO_ACCOUNT;
			$data['STATUS'] = $value->STATUS;
		}
		echo json_encode($data);
	}
	function update_config_biller_bank()
	{
		$postdata = ($_POST);
		$param = array(
			"ID_BILLER" => $postdata['ID_BILLER'],
			"ID_BANK" => $postdata['ID_BANK'],
			"NAMA_CONFIG" => $postdata['NAMA_CONFIG'],
			"NO_ACCOUNT" => $postdata['NO_ACCOUNT'],
			"MERCHANT_CODE" => $postdata['MERCHANT_CODE'],
			"PAYMENT_CODE" => $postdata['PAYMENT_CODE'],
			"STATUS" => $postdata['STATUS'],
			"ID" => $postdata['ID']
		);
		//print_r($param);
		//exit;

		$respon = new stdClass();
		$result = $this->bank_model->update_biller_bank($param);
		// echo json_encode($param);
		// die();
		if ($result) {
			$result = 'success';
		}

		echo json_encode($result);
	}
}
