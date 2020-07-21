<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class appbtlstuf extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		//$this->load->model('booking_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('npksbilling/approval/appbatalstuff_model');
		$this->load->library("nusoap_lib");
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');
		$this->load->library('xml2array');
		$this->load->library('Esb_npks');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views) {
		$this->load->view('templates/om/header', $data);
		$this->load->view('templates/om/top_bar', $data);
		$this->load->view('templates/om/menu_side', $data);
		$this->load->view('templates/om/top-1-breadcrumb', $data);
		$this->load->view('templates/om/top-2-title-nosearch', $data);
		if (is_array($views) ){foreach($views as $view)$this->load->view($view, $data);}else{$this->load->view($views, $data);}
		$this->load->view('templates/om/footer', $data);
	}

	public function redirect(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
	}

	public function index(){
		$this->redirect();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$data['title']= "Approval Batal Stuffing";

		$this->common_loader($data,'npksbilling/approval/approval_batal_stuffing');
	}

	public function getList()
	{
		$data = $this->appbatalstuff_model->getList();
		echo $data;
	}

	public function preview($id,$cancel_id)
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = "Preview Approval Batal stuff";
		$data['id'] = $id;
		$data['cancel_id'] = $cancel_id;
		$data['docType'] = $this->appbatalstuff_model->getDocType();
		$this->common_loader($data, 'npksbilling/approval/preview_batal_stuff');
	}

	public function update_stuff($id = null)
	{
		if ($id) {
			$data = $this->appbatalstuff_model->update_stuff($id);
			echo $data;
		} else {
			$arr = array(
				"HEADER" => ""
			);
			echo json_encode($arr);
		}
	}

	public function getTarif($id)
	{
		$data = $this->appbatalstuff_model->getTarif($id);
		echo json_encode($data);
	}

	public function approve($id)
	{
		$data = $this->appbatalstuff_model->approve($id);
		echo json_encode($data);
	}

	public function reject($id)
	{
		$remarks = $this->input->post('remarks');
		$data = $this->appbatalstuff_model->reject($id, $remarks);
		echo json_encode($data);
	}

}