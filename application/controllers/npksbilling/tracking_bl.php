<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class tracking_bl extends CI_Controller
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
		$this->load->model('npksbilling/trackandtrace/trackandtrace_model');
		$this->load->model('npksbilling/master/mdm_model');
		$this->load->model('om/booking_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("sendcurl_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('xml2array');

		$this->load->library('breadcrumbs');
		require_once(APPPATH . 'libraries/mime_type_lib.php');
		require_once(APPPATH . 'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if (!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT . 'mainpage', 'refresh');
	}

	public function common_loader($data, $views)
	{
		$this->load->view('templates/om/header', $data);
		$this->load->view('templates/om/top_bar', $data);
		$this->load->view('templates/om/menu_side', $data);
		$this->load->view('templates/om/top-1-breadcrumb', $data);
		$this->load->view('templates/om/top-2-title-nosearch', $data);
		if (is_array($views)) {
			foreach ($views as $view) $this->load->view($view, $data);
		} else {
			$this->load->view($views, $data);
		}
		$this->load->view('templates/om/footer', $data);
	}

	public function redirect()
	{
		if (!$this->session->userdata('uname_phd')) {
			redirect(ROOT . 'main', 'refresh');
		}
	}

	public function index()
	{
		$this->redirect();

		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Track and Trace", 'tracking_bl');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Track and Trace";
		$data['terminal'] = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));

		$this->common_loader($data, 'npksbilling/track_and_trace/tracking_bl');
	}

	public function search_tracktrace()
	{
		$json = $this->input->post('data');
		$code = base64_encode($json);
		$data['detail_bl'] = $this->trackandtrace_model->detail_bl($code);
		// $data['history_activity'] = $this->trackandtrace_model->history_activity($terminal, $bl_number);
		// $data['history_bl_bongkar_muat'] = $this->trackandtrace_model->history_bl_bongkar_muat($terminal, $bl_number);
		// $data['history_bl_receiving'] = $this->trackandtrace_model->history_bl_receiving($terminal, $bl_number);
		// $data['history_bl_delivery'] = $this->trackandtrace_model->history_bl_delivery($terminal, $bl_number);
		// $data['history_bl_lumpsum'] = $this->trackandtrace_model->history_bl_lumpsum($terminal, $bl_number);
		echo json_encode($data);
	}

	public function tes()
	{
		$arrdata = '{
			"action": "trackAndTrace",
			"data": [
				{
					"NO_CONTAINER": "BOBI0000002",
					"BRANCH_ID": "4"
				}
			]
		}';
		echo $arrdata;
		echo base64_encode($arrdata);
	}
}
