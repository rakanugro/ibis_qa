<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Register_list extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('my_view_helper');
		$this->load->helper('my_options_helper');
		$this->load->helper('my_format_helper');
		$this->load->helper('my_autocomplete_helper');
		$this->load->helper('my_notification_helper');
		$this->load->helper('MY_language_helper');

		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('breadcrumbs');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');

		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
		$this->load->model('options_model');

		require_once(APPPATH.'libraries/htmLawed.php');

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {

			redirect(ROOT.'mainpage', 'refresh');
		}
	}
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/// CUSTOMER  ////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	private $order = null;
	private $sort = 'DESC';
	private $limit = 10;
	private $offset = 0;
	private $currentpage = 1;


	public function list_customer($search = '', $jenis_pelanggan=''){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Daftar Pelanggan', '/register/list_pelanggan');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['moduleuri'] = $this->uri->segment(1);
		$data['methoduri'] = $this->uri->segment(2);
		$data['currentpage'] = $this->currentpage;
		$data['offset'] = $this->offset;
		$data['limit'] = $this->limit;
		$data['title']= 'Daftar Pelanggan';

		$registration_company_id = $this->session->userdata('registrationcompanyid_phd');
		$data['user_group']= $this->session->userdata('group_phd');

		if($search=="empty") $search = "";
		$search = urldecode($search);
		$search = html_entity_decode($search);
		$data['searchterm'] = $search;
		$data['jenis_pelangganterm']  =$jenis_pelanggan;

		$search = str_replace(array("'"),array("''"),$search);
		$data['table']		= $this->customer_registration_model->view_list($search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan);
		$data['pageinfo'] 	= $this->customer_registration_model->view_list_info($search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan);


		$data = array_merge($data, $this->general_data());

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/register/top-1-breadcrumb', $data);
		$this->load->view('pages/register/top-2-title-search', $data);
		$this->load->view('pages/register/list', $data);
		$this->load->view('pages/register/bottom-2-closing');
		$this->load->view('pages/register/bottom-1-closing');
		$this->load->view('templates/footer', $data);
	}

	public function gotopage($page, $search = '', $jenis_pelanggan=''){
		$this->currentpage = $page;
		$this->offset = $this->offset + ($this->limit * ($page-1));
		$this->list_customer($search, $jenis_pelanggan);
	}

	public function setLimit($lim){
		$this->limit = $lim;
	}

	public function setOrder($ord){
		$this->order = $ord;
	}

	public function setOffset($off){
		$this->offset = $off;
	}

	public function setSort($srt){
		$this->sort = $srt;
	}
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/// USER  ////////////////////////////////////////////////////////////////////////////////////////////////////////	
	public function list_user(){
		log_message('debug','< unverfied user');
		if (!$this->session->userdata('uname_phd')){
			log_message('error','< unverfied user');
			header('Location: '.ROOT."/mainpage");
			//redirect(ROOT.'mainpage', 'refresh');
		}

		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Daftar Pelanggan', '/register/list_pelanggan');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$result=$this->user_model->getUserList();

		$this->table->set_heading("No",
								  "eService Username",
								  "Name",
								  "Email",
								  "User Category",
								  "eService Customer",
								  "Terminal",
								  "Created By",
								  "Created Date",
								  "Active",
								  "Edit"
		);

		$i=1;
		foreach ($result as $row)
		{
			$edit_link = "<a class='btn btn-primary' href='".ROOT."register/edit_user/".$row['USERNAME']."'><i class='fa fa-pencil'></i></a>";
			if($row['ENABLED']=="1")
				$enabled = "Y";
			else
				$enabled = "";

			$id_sub_group_arr = explode(",", $row['ID_SUB_GROUP']);

			$sub_group_name="";
			foreach ($id_sub_group_arr as $id_sub_group) {
				$result =$this->user_model->getSubGroupName($id_sub_group);

				if($result!="")
				{
					if($sub_group_name!="")
					{
						$sub_group_name .=",</br>";
					}

					$sub_group_name .=$result;
				}

			}

			if($sub_group_name=="")
				$sub_group_name="-";

			$this->table->add_row(
				$i++,
				$this->security->xss_clean($row['USERNAME']),
				$this->security->xss_clean($row['NAME']),
				$this->security->xss_clean($row['EMAIL']),
				$this->security->xss_clean($row['NAME_GROUP']),
				$this->security->xss_clean($row['CUSTOMER_NAME']),
				$sub_group_name,
				$this->security->xss_clean($row['CREATED_BY']),
				$this->security->xss_clean($row['CREATED_DATE']),
				$enabled,
				$edit_link
			);
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/register/list_user', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit_user($username=""){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['request_data'] = $this->user_model->getUserDetailbyUsername($username);

		$data['box_group_type']	= $this->options_model->getUserGroupList()->result('array');
		$data['box_terminal_type'] = $this->options_model->getTerminalList()->result('array');

		$data['group_type'] = $data['request_data']['ID_GROUP'];//radio only 1 value
		$id_sub_group_array = explode(",",$data['request_data']['ID_SUB_GROUP']);
		$data['terminal_type']= $id_sub_group_array;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/register/edit_user', $data);
		$this->load->view('templates/footer', $data);
	}

	public function update_user()
	{
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$terminal_type = "";
		if(isset($_POST['terminal_type']))
		{
			foreach ($this->security->xss_clean($_POST['terminal_type']) as $value) {
				$terminal_type .= ",$value,";
			}
		}
		//log_message('error','>>>>>>>>>>>>>>>>>> terminal: '.json_encode($terminal_type));
		$params = array(
							'NAME' => $this->security->xss_clean($_POST['name']),
							'EMAIL' => $this->security->xss_clean($_POST['email']),
							'CATEGORY' => $this->security->xss_clean($_POST['category']),
							'CUSTOMER_ID' => $this->security->xss_clean($_POST['customer_id']),
							'ACTIVE' => $this->security->xss_clean($_POST['active']),
							'TERMINAL_TYPE' => $terminal_type,
							'USERNAME' => $this->security->xss_clean($_POST['username'])
		);

		//var_dump($params);

		if($this->customer_registration_model->update_user($params)==true)
			echo true;
		else
			echo false;
	}

	
}