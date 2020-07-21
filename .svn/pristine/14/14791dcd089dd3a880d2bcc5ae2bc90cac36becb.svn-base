<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('my_view_helper');
		$this->load->helper('my_options_helper');
		$this->load->helper('my_format_helper');
		$this->load->helper('my_autocomplete_helper');
		$this->load->helper('my_notification_helper');
		$this->load->helper('MY_language_helper');

		$this->load->library('form_validation');
		$this->load->library('breadcrumbs');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('session');

		$this->load->model('user_model');
		$this->load->model('customer_registration_model');
		$this->load->model('options_model');
		$this->load->model('container_model');
		$this->load->model('analytics_model');
		$this->load->model('branch_model');

		require_once(APPPATH.'libraries/htmLawed.php');

		$this->load->model('auth_model','auth_model');
		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {

			redirect(ROOT.'mainpage', 'refresh');
		}
			//show_error(YOU_DONT_HAVE_ACCESS);
	}

	public function tesidbaru(){
		//var_dump( $this->customer_registration_model->get_new_customer_id() );
		$x = $this->customer_registration_model->get_new_customer_id();
		echo $x['CUSTOMER_ID'];
	}

//-------TAG

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

	public function edit_user($username="")
	{
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['request_data'] = $this->user_model->getUserDetailbyUsername($username);
        $data['data_ppjk'] = $this->user_model->getConsigneeByPpjk($username);

		$data['box_group_type']	= $this->options_model->getUserGroupList()->result('array');
		$data['box_terminal_type'] = $this->options_model->getTerminalList()->result('array');
		$data['box_ppjk'] = $this->options_model->getOptions("PPJKCONFIRMATION","ID")->result('array');

		$data['opt_registration_branch']		= rsArrToOptArr(	$this->options_model->getRegistrationBranch()->result('array')	);
		
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
            'IS_PPJK' => $this->security->xss_clean($_POST['is_ppjk']),
            'CUSTOMER_ID' => $this->security->xss_clean($_POST['customer_id']),
            'ACTIVE' => $this->security->xss_clean($_POST['active']),
            'TERMINAL_TYPE' => $terminal_type,
            'REGISTRATION_COMPANY_ID' => $this->security->xss_clean($_POST['registration_branch']),
            'USERNAME' => $this->security->xss_clean($_POST['username']),
            'USERNAME_CREATE' => $this->session->userdata('uname_phd')//,
            //'OUT_MESSAGE' => ''
		);

		//var_dump($params);

		if($this->customer_registration_model->update_user($params)==true)
			echo true;
		else
			echo false;
	}

	public function get_customer_list()
	{
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

        if ($_GET["type"] == 'multi'){
            $customer_data_temp = $this->customer_registration_model->find_customer_withlabel(strtoupper(htmLawed($_GET["customer_name"])));
            $customer_data = array();
            foreach($customer_data_temp as $temp){
                array_push($customer_data, array(
                    'label' => $temp->LABEL, // return data with key "small letter"
                    'value' => $temp->VALUE
                ));
            }
        } else {
            $customer_data = $this->customer_registration_model->find_customer(strtoupper(htmLawed($_GET["customer_name"])),strtoupper(htmLawed($_GET["org_id"])));
        }
        header('Content-Type: application/json');
		echo json_encode($customer_data);
	}
    
//-------TAG

	public function common_loader($data,$views,$back=null){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/register/top-1-breadcrumb', $data);
		$this->load->view('pages/register/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		if ($back){$this->load->view('pages/register/gotoindex', $data);}
		$this->load->view('pages/register/bottom-2-closing');
		$this->load->view('pages/register/bottom-1-closing');
		$this->load->view('templates/footer', $data);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////

	public function is_view_only($data,$customer_id="",$allow_save="x")
	{
		$sign = 0;
		if($customer_id!="")
		{
			$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
			$registrationcompanyid_cust = $this->customer_registration_model->get_registration_company_id($customer_id);

			if($registrationcompanyid!=$registrationcompanyid_cust)
			{
				$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($registrationcompanyid);
				
				$sign = $this->customer_registration_model->get_branch_sign_by_branch_id($customer_id,$branch_id);
			}
			else
			{
				$sign = "full";
			}
		}
		
		if($allow_save=="0" or $this->session->userdata('group_phd')=="a")
		{
			$data['is_view_only'] = true;
			$data['is_readonly'] = "readonly";
			$data['disabled'] = "disabled";
			$data['submit'] = "Lanjut";
			return true;			
		}
		if($sign=="full" or $allow_save=="1")
		{
			$data['submit'] = "Simpan";
			return false;
		}
		else if($sign>0){
			$data['is_view_only'] = true;
			$data['is_readonly'] = "readonly";
			$data['disabled'] = "disabled";
			$data['submit'] = "Lanjut";
			return true;			
		}
		else {
			$data['is_view_only'] = true;
			$data['is_readonly'] = "readonly";
			$data['disabled'] = "disabled";
			$data['submit'] = "Lanjut";
			$data['create'] = "Lanjut";
			return true;
		}
	}
	
// general information form

	public function general_information(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Tambah Pelanggan', '/register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Pelanggan';
		
		$data['registrationcompanyid'] = $this->session->userdata('registrationcompanyid_phd');
		
		$this->is_view_only(&$data);
		
		$data = array_merge($data, $this->general_data());

		$this->common_loader($data,'pages/register/register');
	}

	public function general_data(){

		//options
		$data['opt_customer_group']		= rsArrToOptArr(	$this->options_model->getOptions('CUSTOMERGROUP','ID')->result('array')	);
		$data['opt_customer_segment']	= rsArrToOptArr(	$this->options_model->getOptions('KLBI','ID')->result('array')	);
		$data['box_service_type']		= $this->options_model->getOptions('SERVICETYPE','ID')->result('array');
		$data['box_register_type']		= $this->options_model->getOptions('REGISTERTYPE','ID')->result('array');
		$data['box_company_type']		= $this->options_model->getOptions('COMPANYTYPE','ID')->result('array');
		$data['box_citizenship']		= $this->options_model->getOptions('CITIZENSHIP','ID')->result('array');

		$data['box_customer_type']		= $this->options_model->getOptions('CUSTOMERTYPE','ID')->result('array');

		$data['opt_customer_location']		= rsArrToOptArr( $this->customer_registration_model->getCustomer_location()->result('array') );
		$data['opt_customer_type']		= rsArrToOptArr( $this->options_model->getOptions('CUSTOMERTYPE','ID')->result('array') );
		$data['opt_service_type']		= rsArrToOptArr( $data['box_service_type']	 );
		$data['opt_status_approval']		= rsArrToOptArr( $this->options_model->getOptions('STATUSAPPROVAL','ID')->result('array') );
		$data['opt_status_customer']		= rsArrToOptArr( $this->options_model->getOptions('STATUSCUSTOMER','ID')->result('array') );
		if($this->session->userdata('registrationcompanyid_phd')=="83")
			$data['box_cfs_type']		= $this->options_model->getOptions('CFSTYPE','ID')->result('array');
		
		$data['box_yesno']				= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['box_employee_count']		= $this->options_model->getOptions('EMPLOYEECOUNT','ID')->result('array');
		$data['box_entity_type']		= $this->options_model->getOptions('ENTITYTYPE','ID')->result('array');
		$data['box_reg_type']			= $this->options_model->getOptions('REGTYPE','ID')->result('array');
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );

		$data['opt_years'] 				= rsArrToOptArr(years_options('limited'));

		return $data;
	}

	// !update = insert
	public function general_params($act = 'insert'){
		$ip = $this->input->ip_address();
		$user = $this->session->userdata('uname_phd');
		$site = current_url();

		$is_mitra 		= 'N';
		$is_customer 	= 'N';
		
		//service type
		$svc_vessel 	='N';
		$svc_container	='N';
		$svc_cargo		='N';
		$svc_misc		='N';

		$is_shipping_agent = 'N';
		$is_shipping_line = 'N';
		$is_pbm = 'N';
		$is_ff = 'N';
		$is_emkl = 'N';
		$is_ppjk = 'N';
		$is_consignee = 'N';
		$is_rupa = 'N';

		//var_dump($_POST); die;

		if(isset($_POST['register_type'])){
			foreach ($_POST['register_type'] as $s){
				$s = htmLawed($s);
				if ($s == 'MTR'){
					$is_mitra = 'Y';
				}
				else if ($s == 'CUS'){
					$is_customer = 'Y';
				}
			}
		}
		
		if(isset($_POST['service_type'])){
			foreach ($_POST['service_type'] as $s){
				$s = htmLawed($s);
				if ($s == 'VESSE'){
					$svc_vessel = 'Y';
				}
				else if ($s == 'CONGC'){
					$svc_cargo = 'Y';
					$svc_container = 'Y';
				}
				else if ($s == 'MISC'){
					$svc_misc = 'Y';
				}
			}
		}
		
		if(isset($_POST['reg_type'])){
			foreach ($_POST['reg_type'] as $s){
				$s = htmLawed($s);
				if ($s == 'CUS'){
					$svc_customer = 'Y';
				}
				else if ($s == 'MTR'){
					$svc_mitra = 'Y';
				}
			}
		}
		
		//company type
		$is_shipping_agent = 'N';
		$is_shipping_line = 'N';
		// etc, to be added later...

		/*if(isset($_POST['customer_type'])){
			foreach ($_POST['customer_type'] as $c){
				if($c == 'SHIPA'){
					$is_shipping_agent = 'Y';
				}
				else if ($c == 'SHIPL'){
					$is_shipping_line = 'Y';
				}
				else if ($c == 'STVCO'){
					$is_pbm = 'Y';
				}
				else if ($c == 'FFORW'){
					$is_ff = 'Y';
				}
				else if ($c == 'EMKL'){
					$is_emkl = 'Y';
				}
				else if ($c == 'PPJK'){
					$is_ppjk = 'Y';
				}
				else if ($c == 'CONSG'){
					$is_consignee = 'Y';
				}
				// etc...
			}
		}*/
		if(isset($_POST['customer_type'])){
			if(htmLawed($_POST['customer_type']) == 'SHIPA'){
				$is_shipping_agent = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'SHIPL'){
				$is_shipping_line = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'STVCO'){
				$is_pbm = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'FFORW'){
				$is_ff = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'EMKL'){
				$is_emkl = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'PPJK'){
				$is_ppjk = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'CONSG'){
				$is_consignee = 'Y';
			}
			else if (htmLawed($_POST['customer_type']) == 'RUPA'){
				$is_rupa = 'Y';
			}
		}

		if(isset($_POST['employee_count']))
			$employee_count = htmLawed($_POST['employee_count']);
		else
			$employee_count = 0;

		//main / branch
		$main_branch = 'N';
		if(htmLawed($_POST['entity_type'])=='MAIN'){
			$main_branch = 'Y';
		}

		if(isset($_POST['main_branch_name']))
		{
			$main_branch_name = htmLawed($_POST['main_branch_name']);
		}
		else
			$main_branch_name = "";

		//handling disabled inputs

		$holding_name = '';
		if (isset($_POST['holding_name'])){
			$holding_name = htmLawed($_POST['holding_name']);
		}
//var_dump($_POST);
		if($act == 'insert'){ //if insert
			//$cust_id = '';
			//if($_POST['reg_type']=='NEW'){
			//	$cust_id = $this->customer_registration_model->get_new_customer_id();
			//}
			//else{
			//	$cust_id = $_POST['simop_customer_id'];
			//}
			$params = array(
						'CUSTOMER_ID'	=> htmLawed($_POST['simop_customer_id']),
						'NAME'			=> str_replace(array("'"),array("''"),htmLawed($_POST['name'])),
						'ADDRESS'		=> str_replace(array("'"),array("''"),htmLawed($_POST['address'])),
						'CITIZENSHIP'			=> htmLawed($_POST['citizenship']),
						'NPWP'			=> htmLawed($_POST['npwp']),
						'PASSPORT'			=> htmLawed($_POST['passport']),
						'EMAIL'			=> htmLawed($_POST['email']),
						'WEBSITE'		=> htmLawed($_POST['website']),
						'PHONE'			=> htmLawed($_POST['phone_area_code']).'.'.htmLawed($_POST['phone']),
						'COMPANY_TYPE'	=> htmLawed($_POST['company_type']),
						'IS_MITRA'		=> $is_mitra,
						'IS_CUSTOMER'	=> $is_customer,
						'ALT_NAME'		=> str_replace(array("'"),array("''"),htmLawed($_POST['alt_name'])),
						'DEED_ESTABLISHMENT'	=> htmLawed($_POST['deed_establishment']),
						'CUSTOMER_GROUP'		=> htmLawed($_POST['customer_group']),
						//'CUSTOMER_TYPE'		=> $_POST['customer_type'],  // expanded to is_shipping_agent, etc..
						'SVC_VESSEL'		=> $svc_vessel, //custom!
						'SVC_CARGO'			=> $svc_cargo, //custom!
						'SVC_CONTAINER'		=> $svc_container, //custom!
						'SVC_MISC'			=> $svc_misc, //custom! 
						'IS_SUBSIDIARY'		=> htmLawed($_POST['is_subsidiary']),
						'HOLDING_NAME'		=> $holding_name, //custom!
						'EMPLOYEE_COUNT'	=> $employee_count,
						'IS_MAIN_BRANCH'	=> $main_branch, //custom!
						'PARTNERSHIP_DATE'	=> htmLawed($_POST['partnership_date']),
						'PROVINCE'			=> htmLawed($_POST['address_prov']),
						'CITY'			=> htmLawed($_POST['address_city']),
						'KECAMATAN'		=> htmLawed($_POST['address_kecamatan']),
						'KELURAHAN'		=> htmLawed($_POST['address_kelurahan']),
						'POSTAL_CODE'	=> htmLawed($_POST['postal_code']),
						'FAX'			=> htmLawed($_POST['fax_area_code']).'.'.htmLawed($_POST['fax']).'.'.htmLawed($_POST['fax_ext']),
						'PARENT_ID'		=> htmLawed($_POST['holding_company_id']),
						'IS_SHIPPING_LINE'	=>	$is_shipping_line,
						'IS_SHIPPING_AGENT'	=>	$is_shipping_agent,
						'IS_PBM'			=>	$is_pbm,
						'IS_FF'				=>	$is_ff,
						'IS_EMKL'			=>	$is_emkl,
						'IS_PPJK'			=>	$is_ppjk,
						'IS_CONSIGNEE'		=>	$is_consignee,
						'IS_RUPA'	=>	$is_rupa,
						'CREATE_BY'		=> $user, // custom!
						'CREATE_VIA'	=> $site, // custom!
						'CREATE_IP'		=> $ip, // custom!
						'REG_TYPE'		=> htmLawed($_POST['reg_type']),
						'HEADQUARTERS_ID'		=> htmLawed($_POST['main_branch_id']),
						'HEADQUARTERS_NAME'		=> $main_branch_name,
						'ACCEPTANCE_DOC'		=> htmLawed($_FILES['acceptance_doc']['name']),
						'ACCEPTANCE_DOC_DATE'	=> htmLawed($_POST['acceptance_doc_date']),
						'REGISTRATION_COMPANY_ID'		=> $this->session->userdata('registrationcompanyid_phd')
					);

		}
		else{ //update
			if (!isset($_POST['simop_customer_id']) || htmLawed($_POST['simop_customer_id']) == '' || htmLawed($_POST['simop_customer_id']) == null){
				$cust_id = htmLawed($_POST['simop_customer_id_nosync']);
			}
			else{
				$cust_id = htmLawed($_POST['simop_customer_id']);
			}

			$params = array(
						'NAME'			=> str_replace(array("'"),array("''"),htmLawed($_POST['name'])),
						'ADDRESS'		=> str_replace(array("'"),array("''"),htmLawed($_POST['address'])),
						'CITIZENSHIP'			=> htmLawed($_POST['citizenship']),
						'NPWP'			=> htmLawed($_POST['npwp']),
						'PASSPORT'			=> htmLawed($_POST['passport']),
						'EMAIL'			=> htmLawed($_POST['email']),
						'WEBSITE'		=> htmLawed($_POST['website']),
						'PHONE'			=> htmLawed($_POST['phone_area_code']).'.'.htmLawed($_POST['phone']),
						'COMPANY_TYPE'	=> htmLawed($_POST['company_type']),
						'IS_MITRA'		=> $is_mitra,
						'IS_CUSTOMER'	=> $is_customer,						
						'REGISTER_TYPE'	=> htmLawed($_POST['register_type']),
						'ALT_NAME'		=> str_replace(array("'"),array("''"),htmLawed($_POST['alt_name'])),
						'DEED_ESTABLISMENT'	=> htmLawed($_POST['deed_establishment']),
						'CUSTOMER_GROUP'	=> htmLawed($_POST['customer_group']),
						//'CUSTOMER_TYPE'		=> $_POST['customer_type'],			// see above
						'SVC_VESSEL'		=> $svc_vessel, //custom!
						'SVC_CARGO'			=> $svc_cargo, //custom!
						'SVC_CONTAINER'		=> $svc_container, //custom!
						'SVC_MISC'			=> $svc_misc, //custom!
						'IS_SUBSIDIARY'		=> htmLawed($_POST['is_subsidiary']),
						'HOLDING_NAME'		=> $holding_name, //custom!
						'EMPLOYEE_COUNT'	=> $employee_count,
						'IS_MAIN_BRANCH'	=> $main_branch, //custom!
						'PARTNERSHIP_DATE'	=> htmLawed($_POST['partnership_date']),
						'PROVINCE'			=> htmLawed($_POST['address_prov']),
						'CITY'			=> htmLawed($_POST['address_city']),
						'KECAMATAN'		=> htmLawed($_POST['address_kecamatan']),
						'KELURAHAN'		=> htmLawed($_POST['address_kelurahan']),
						'POSTAL_CODE'	=> htmLawed($_POST['postal_code']),
						'FAX'			=> htmLawed($_POST['fax_area_code']).'.'.htmLawed($_POST['fax']).'.'.htmLawed($_POST['fax_ext']),
						'PARENT_ID'		=> htmLawed($_POST['holding_company_id']),
						'IS_SHIPPING_LINE'	=>	$is_shipping_line,
						'IS_SHIPPING_AGENT'	=>	$is_shipping_agent,
						'IS_PBM'			=>	$is_pbm,
						'IS_FF'				=>	$is_ff,
						'IS_EMKL'			=>	$is_emkl,
						'IS_PPJK'			=>	$is_ppjk,
						'IS_CONSIGNEE'		=>	$is_consignee,
						'IS_RUPA'	=>	$is_rupa,
						'EDIT_BY'		=> $user, // custom!
						'EDIT_VIA'		=> $site, // custom!
						'EDIT_IP'		=> $ip, // custom!
						'HEADQUARTERS_ID'		=> htmLawed($_POST['main_branch_id']),
						'HEADQUARTERS_NAME'		=> $main_branch_name,
						'ACCEPTANCE_DOC'		=> htmLawed($_POST['acceptance_doc']),
						'ACCEPTANCE_DOC_DATE'	=> htmLawed($_POST['acceptance_doc_date']),						
						'CUSTOMER_ID'	=> $cust_id // custom!
					);

		}
		return $params;
	}

	public function general_params_activation($act = 'insert'){
		//
		$ip = $this->input->ip_address();
		$user_id = $this->session->userdata('uname_phd');
		$site = current_url();
		//print_r($this->session->userdata); die();
		$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($registrationcompanyid);

		if($act == 'insert'){ //if insert
			$Alasan = "";
			if($_POST['alasan'] == 'Umum'){
				
				$Alasan = " Dokumen Registrasi Telah Lengkap & Butuh Layanan Cepat";
			}else{
				$Alasan = $_POST['alasan-khusus'];
			}
			$date_activation = date('d-m-Y');
			$date_expired = date("d-m-Y", mktime(0,0,0,date("m"), date("d")+7, date("Y")));

			$masa_berlaku = 'AKTIF';
			//date('dd-mm-YYYY', date("d")+7, date("m"), date("Y"));
			
			//print_r($_POST); die();
			$params = array(
							'CUSTOMER_ID'			=> $_POST['simop_customer_id'],
							'CUSTOMER_NAME'		=> $_POST['simop_customer_name'],
							'BRANCH_ID'			=> $branch_id,
							'CUSTOMER_TYPE'			=> '',
							'NPWP'			=> $_POST['npwp'],
							'ALASAN'	=> $Alasan,
							'ACTIVATION_DATE'		=> $date_activation,
							'EXPIRED_DATE'		=> $date_expired,
							'MASA_BERLAKAU' => $masa_berlaku,
							'USER_ID'		=> $user_id
					);

				//var_dump($params); die();

		}
		
		
		return $params;
	}
	
	public function general_params_deactivation($act = 'insert'){
		//
		$ip = $this->input->ip_address();
		$user_id = $this->session->userdata('uname_phd');
		$site = current_url();
		//print_r($this->session->userdata); die();
		$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
		
//		
		 
		if($act == 'insert'){

			$date_deactivation = date('d-m-Y');
			//print_r($_POST); die();
			$params = array(
							'BILLING_CUSTOMER_ID'			=> $_POST['simop_customer_id'],
							'CUSTOMER_NAME'		=> $_POST['simop_customer_name'],
							'BRANCH_ID'			=> $_POST['branch_id'],
							'CUSTOMER_TYPE'			=> '',
							'NPWP'			=> $_POST['npwp'],
							'USER_ID'		=> $user_id,
							'ALASAN'	=> $_POST['alasan']
					);
			//var_dump($params); die();

		 
		}
		
		return $params;
	}

	public function validate_insa_member_no()
	{
		if($this->customer_registration_model->validate_insa_member_no(htmLawed($_POST['insa_member_no']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_siopsus()
	{
		if($this->customer_registration_model->validate_siopsus(htmLawed($_POST['siopsus']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_siupal()
	{
		if($this->customer_registration_model->validate_siupal(htmLawed($_POST['siupal']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_siapdel()
	{
		if($this->customer_registration_model->validate_siapdel(htmLawed($_POST['siapdel']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_apbmi()
	{
		if($this->customer_registration_model->validate_apbmi(htmLawed($_POST['apbmi']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_siupbm()
	{
		if($this->customer_registration_model->validate_siupbm(htmLawed($_POST['siupbm']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			if($this->customer_registration_model->validate_blacklist(htmLawed($_POST['siupbm']),"SIUP")>0)
			{
				echo "BLACKLIST";
			}
			else 
				echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_alfi()
	{
		if($this->customer_registration_model->validate_alfi(htmLawed($_POST['alfi']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_siujpt()
	{
		if($this->customer_registration_model->validate_siujpt(htmLawed($_POST['siujpt']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_npwp()
	{
		if($this->customer_registration_model->validate_npwp(htmLawed($_POST['npwp']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			if($this->customer_registration_model->validate_blacklist(htmLawed($_POST['npwp']),"NPWP")>0)
			{
				echo "BLACKLIST";
			}
			else 
				echo "OK";
		}
		else
		{
			echo "KO";
		}
	}
	
	public function validate_passport()
	{
		if($this->customer_registration_model->validate_passport(htmLawed($_POST['passport']),htmLawed($_POST['customer_id']),htmLawed($_POST['registration_company_id']))==0)
		{
			if($this->customer_registration_model->validate_blacklist(htmLawed($_POST['passport']),"PASSPORT")>0)
			{
				echo "BLACKLIST";
			}
			else 
				echo "OK";
		}
		else
		{
			echo "KO";
		}
	}	
	
	public function validate_blacklist()
	{
		if($this->customer_registration_model->validate_blacklist_double(htmLawed($_POST['blacklist_id']),htmLawed($_POST['attribute']),htmLawed($_POST['value']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}
	
	public function validate_ktp_ceo()
	{
		if($this->customer_registration_model->validate_blacklist(htmLawed($_POST['ktp']),'ID')>0)
		{
			echo "BLACKLIST";
		}
		else
		{
			echo "OK";
		}
	}

	public function validate_agent_branch()
	{
		if($this->customer_registration_model->validate_agent_branch(htmLawed($_POST['branch']),htmLawed($_POST['customer_id']),htmLawed($_POST['shipping_agent_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function validate_bank_branch()
	{
		if($this->customer_registration_model->validate_bank_branch(htmLawed($_POST['branch']),htmLawed($_POST['billing_id']),htmLawed($_POST['bank_account_id']))==0)
		{
			echo "OK";
		}
		else
		{
			echo "KO";
		}
	}

	public function scan_virus($file) {
		/* contoh result scan clamav
		file valid				-> index.php: OK ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 0 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 13.927 sec (0 m 13 s)
		file terinfeksi virus	-> eicar.com.txt: Eicar-Test-Signature FOUND ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 1 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 14.098 sec (0 m 14 s) */
		$scan_process = shell_exec('clamscan '.$file);
		log_message('debug', 'hasil scan: '.$scan_process);
		if(strpos($scan_process, 'OK') != false) {
			log_message('debug', 'hasil scan file: '.$file.' tidak terinfeksi virus.');
			return 'lolos';
		} else { 
			log_message('debug', 'hasil scan file: '.$file.' terinfeksi virus');
			return 'infected';
		}
	}
	
	
	public function submit(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = $this->general_params('insert');
		$id="";
		
		if($_FILES['acceptance_doc']['name']!="")
		{
			$file = time().'-'.$_FILES['acceptance_doc']['name'];
			$folderfile='upload_bast_customer';

			$path= UPLOADFOLDER_.$folderfile;
			$config = array(
				'upload_path' => $path,
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "10048000", // Can be set to particular file size , here it is 10 MB(10048 Kb)
				'max_height' => "768",
				'file_name' => $file,
				'max_width' => "1024"
			);
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('acceptance_doc'))
			{
				$data=$this->upload->data();
				$fullpath=APP_ROOT.$folderfile."/".$data['file_name']; //file_name
				$this->upload->display_errors('<p>', '</p>');
				
				$fullfile = $path."/".$data['file_name']; //full file_name
				log_message('debug', 'value fullfile: '.$fullfile);
				$this->scan_virus($fullfile); //scan file disini
				
				$params["ACCEPTANCE_DOC"] = $data['file_name'];
			}
			else
			{
				$params["ACCEPTANCE_DOC"]="";
				echo $this->upload->display_errors('<p>', '</p>');
			}
		}
					
		if ($this->customer_registration_model->create_customer($params,$id) > 0){
			
			if ($params['REG_TYPE'] == 'NEW'){
				$prm = array(
							'NAME'			=> str_replace(array("'"),array("''"),htmLawed($_POST['name'])),
							'ADDRESS'		=> htmLawed($_POST['address']),
							'NPWP'			=> htmLawed($_POST['npwp']),
							'PASSPORT'			=> htmLawed($_POST['passport']),
							'EMAIL'			=> htmLawed($_POST['email']),
							'POSTAL_CODE'	=> htmLawed($_POST['postal_code']),
							'REG_TYPE'		=> htmLawed($_POST['reg_type'])
						);
				$_POST['simop_customer_id'] = $this->customer_registration_model->find_customer_id($prm);
			}

			redirect(ROOT.'register/index/'.htmLawed($_POST['simop_customer_id']), 'refresh');
		}
		else{
			redirect(ROOT.'register/failed', 'refresh');
		}
	}

	public function submitActivation(){
		$this->load->library("Nusoap_lib");

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'register/activasi/', 'refresh');
		}

		$params = $this->general_params_activation('insert');
		$id=$_POST['simop_customer_id'];
		
		//print_r($params); die();
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id>". $id ."</id>
				<branch_id>". $params['BRANCH_ID'] ."</branch_id>
			</data>
		</root>";
		
		$service_name = "syncActivation";//priok dan non priok digabung
		
		if(!$this->nusoap_lib->call_wsdl(CUSTOMER_DATA,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->respons->syncActivationStatus!="S")
			{
				echo "<script>alert('Gagal di Aktivasi!');history.go(-1);</script>";
				//alert('FAILED');
			}
			else
			{	
				//alert('SUCCESS');
				echo "<script>alert('Berhasil di Aktivasi');history.go(-1);</script>";
			}
		}
		
		//print_r($_POST); die();		
		if ($this->customer_registration_model->create_activation($params,$id) > 0){
			redirect(ROOT.'register/activation_customer', 'refresh');
		}
		else{
			redirect(ROOT.'register/failed', 'refresh');
		}
	}

	public function submitDeactivation(){
		//print_r($_POST); die();
		$this->load->library("Nusoap_lib");


		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'register/deactivasi', 'refresh');
		}
		// print_r("dsadsadsa"); die();

		$params = $this->general_params_deactivation('insert');
		$id=$_POST['simop_customer_id'];
		//print_r($params); die;
		
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id>". $id ."</id>
				<branch_id>". $params['BRANCH_ID'] ."</branch_id>
			</data>
		</root>";
		//die();
		
		$service_name = "syncDeactivation";//priok dan non priok digabung
		
		if(!$this->nusoap_lib->call_wsdl(CUSTOMER_DATA,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->respons->syncDeactivationStatus!="S")
			{
				echo "<script>alert('Gagal di Deaktivasi!');history.go(-1);</script>";
				//alert('FAILED');
			}
			else
			{
				echo "<script>alert('Sukses di Deaktivasi!');history.go(-1);</script>";
				
			}
		}
		
		if ($this->customer_registration_model->create_deactivation($params,$id) > 0){
			redirect(ROOT.'register/deactivation_customer', 'refresh');
		}
		else{
			redirect(ROOT.'register/failed', 'refresh');
		}
	}



	public function failed($cust_id = ''){
		if ($cust_id == ''){
			$this->general_information();
		}
		else{
			$this->edit($cust_id);
		}
		$this->load->view('pages/register/failed');
	}

	public function edit($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('Edit Data Pelanggan '.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['register']=$this->customer_registration_model->read_customer($customer_id); //print_r($data['register']);die;
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		if($this->is_view_only(&$data,$customer_id))
		{
			$data['action']= ROOT . "register/index/".$customer_id;
			$data['title']= 'Lihat Data Pelanggan';
		}
		else
		{
			$data['action']= ROOT . "register/update";
			$data['title']= 'Ubah Data Pelanggan';
		}
		
		$data['registrationcompanyid'] = $data['register']['REGISTRATION_COMPANY_ID'];
		
		$folderfile='upload_bast_customer';
		$data['file_link'] = APP_ROOT.$folderfile."/".$data['register']['ACCEPTANCE_DOC'];

		$data['simop_name'] 	= $this->getSimopName($data['register']['CUSTOMER_ID'],$data['register']['REGISTRATION_COMPANY_ID']);

		$data = array_merge($data, $this->general_data());

		$this->common_loader($data,'pages/register/register');
	}

	public function update(){
		//die;
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = $this->general_params('update');

		if($_FILES['acceptance_doc']['name']!="")
		{
			$file = time().'-'.$_FILES['acceptance_doc']['name'];
			$folderfile='upload_bast_customer';

			$path= UPLOADFOLDER_.$folderfile;
			$config = array(
				'upload_path' => $path,
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'file_name' => $file,
				'max_width' => "1024"
			);
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('acceptance_doc'))
			{
				$data=$this->upload->data();
				$fullpath=APP_ROOT.$folderfile."/".$data['file_name']; //file_name
				$this->upload->display_errors('<p>', '</p>');
				
				$fullfile = $path."/".$data['file_name']; //full file_name
				log_message('debug', 'value fullfile: '.$fullfile);
				$this->scan_virus($fullfile); //scan file disini
				
				$params["ACCEPTANCE_DOC"] = $data['file_name'];
			}
			else
			{
				$params["ACCEPTANCE_DOC"]="";
				echo $this->upload->display_errors('<p>', '</p>');
			}
		}
		
		if ($this->customer_registration_model->update_customer($params) > 0){
			redirect(ROOT.'register/index/'.$params['CUSTOMER_ID'], 'refresh');
		}
		else{
			redirect(ROOT.'register/failed/'.$params['CUSTOMER_ID'], 'refresh');
		}
	}

	public function delete($customer_id, $urinext = '', $methodnext = ''){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		if ($this->customer_registration_model->delete_customer($customer_id) )	{
			if (strlen($methodnext)>0){
				$methodnext = "/$methodnext";
			}
			redirect(ROOT.html_entity_decode($urinext).html_entity_decode($methodnext),'refresh');
		}
		else{
			redirect(ROOT.'register/failed/'.htmLawed($_POST['customer_id']));
		}
	}

	public function list_customer($page_type='',$search = '', $jenis_pelanggan='', $service_type='', $status_approval='', $status_customer='',$lokasi_pelanggan='', $cfs = ''){

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

		$search = urldecode($search);
		$search = html_entity_decode($search);
		$data['searchterm'] = $search;
		$data['lokasi_pelangganterm']  =$lokasi_pelanggan;
		$data['jenis_pelangganterm']  =$jenis_pelanggan;
		$data['service_typeterm']  =$service_type;
		$data['status_approvalterm']  =$status_approval;
		$data['status_customerterm']  =$status_customer;
		$data['cfsterm']  = $cfs;
		
		if($search=="empty") $search = "";
		if($lokasi_pelanggan=="empty") $lokasi_pelanggan = "";
		if($jenis_pelanggan=="empty") $jenis_pelanggan = "";
		if($service_type=="empty") $service_type = "";
		if($status_approval=="empty") $status_approval = "";
		if($status_customer=="empty") $status_customer = "";
		if($cfs=="empty") $cfs = "";

		$search = str_replace(array("'"),array("''"),$search);
		
		if($page_type=="download_excell")
		{
			$this->limit = 99999999;
		}
		
		$data['table']		= $this->customer_registration_model->view_list("",$search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan,$service_type,$status_approval, $status_customer,$lokasi_pelanggan,$cfs);
		$data['pageinfo'] 	= $this->customer_registration_model->view_list('info',$search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan,$service_type,$status_approval, $status_customer,$lokasi_pelanggan,$cfs);

		if($page_type=="download_excell")
		{
			$data['filename'] = "Customer_List_".date('Y.m.d_H.i.s');
			$this->load->view('rptexcel/customer_list_excel', $data);			
		}
		else
		{
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
	}
	
	public function activation_customer($page_type='',$search = '', $jenis_pelanggan='', $service_type='', $status_approval='', $status_customer='',$lokasi_pelanggan='', $cfs = ''){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Aktivasi Pelanggan', '/register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submitActivation";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Menu Aktivasi Data Pelanggan';
		
		$data['registrationcompanyid'] = $this->session->userdata('registrationcompanyid_phd');
		$data['table']		= $this->customer_registration_model->view_list_aktivasi("",$search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan,$service_type,$status_approval, $status_customer,$lokasi_pelanggan,$cfs);
		//print_r($data['table']); die();
		$data['pageinfo'] 	= $this->customer_registration_model->view_list_aktivasi('info',$search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan,$service_type,$status_approval, $status_customer,$lokasi_pelanggan,$cfs);
		
		$this->is_view_only(&$data);
			$data = array_merge($data, $this->general_data());
			$this->common_loader($data,'pages/register/activasi');	
		
	}

	public function deactivation_customer($page_type='',$search = '', $jenis_pelanggan='', $service_type='', $status_approval='', $status_customer='',$lokasi_pelanggan='', $cfs = ''){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Deaktivasi Pelanggan', '/register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submitDeactivation";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Menu Deaktivasi Data Pelanggan';
		
		$data['registrationcompanyid'] = $this->session->userdata('registrationcompanyid_phd');
		$data['table']		= $this->customer_registration_model->view_list_deaktivasi("",$search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan,$service_type,$status_approval, $status_customer,$lokasi_pelanggan,$cfs);
		//print_r($data['table']); die();
		$data['pageinfo'] 	= $this->customer_registration_model->view_list_deaktivasi('info',$search, $this->limit, $this->offset, $this->order, $this->sort,$registration_company_id,$jenis_pelanggan,$service_type,$status_approval, $status_customer,$lokasi_pelanggan,$cfs);
		
		$this->is_view_only(&$data);
			$data = array_merge($data, $this->general_data());
			$this->common_loader($data,'pages/register/deactivasi');	
		
	}

	public function gotopage($page_type='',$page, $search = '', $jenis_pelanggan='', $service_type='', $status_approval='', $status_customer='',$lokasi_pelanggan='',$cfs=''){
		$this->currentpage = $page;
		$this->offset = $this->offset + ($this->limit * ($page-1));
		$this->list_customer($page_type,$search, $jenis_pelanggan, $service_type, $status_approval, $status_customer,$lokasi_pelanggan,$cfs);
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


////////////////////////////////////////////////////////////////////////////////////////////////////
	//billing form
	public function billing($customer_id){

		if (!isset($_POST['is_main_branch'])){$is_main_branch = 'N';}

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$this->load->model('branch_model');

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('Billing List', '/register/billing_list/'.$customer_id);
		$this->breadcrumbs->push('Billing Account'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/billing/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_billing";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Mendaftarkan Billing Account';

		$allow_save = false;
		$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
		$registrationcompanyid_cust = $this->customer_registration_model->get_registration_company_id($customer_id);
		if($registrationcompanyid!=$registrationcompanyid_cust)
		{
			$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($registrationcompanyid);
			
			$sign = $this->customer_registration_model->get_branch_sign_by_branch_id($customer_id,$branch_id);
			if($sign>0)
				$allow_save = true;
		}
		else
		{
			$allow_save = true;
		}				
		$this->is_view_only(&$data,$customer_id,$allow_save);
		
		$data['customer_id'] 		= $customer_id;

		$data['default_branch_id'] = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		
		$hq_row = $this->customer_registration_model->get_hq_id($customer_id)->row_array();
		$data['register']=$this->customer_registration_model->read_customer($customer_id);

		if (isset($hq_row['HQ_ID'])){
			$data['hq_id'] = $hq_row['HQ_ID'];
		}
		else{
			$data['hq_id'] = '';
		}

		//options
		$data['box_reg_type']			= $this->options_model->getOptions('REGTYPE','ID')->result('array');
		$data['box_yesno']				= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );
		$data['opt_branch']				= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'),"",$customer_id)->result('array') );
		if($this->session->userdata('registrationcompanyid_phd')=="83")
			$data['box_cfs_type']		= $this->options_model->getOptions('CFSTYPE','ID')->result('array');

		$branch_id = $this->session->userdata('registrationcompanyid_phd');

		$data['sites']			= $this->customer_registration_model->get_sites_by_branch_id($branch_id)->result('array');

		$this->common_loader($data, 'pages/register/register_billing');
	}

	public function billing_edit($billing_id){

		if (!isset($_POST['is_main_branch'])){$is_main_branch = 'N';}

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$this->load->model('branch_model');

		//--
		$data['billing'] 		= $this->customer_registration_model->read_billing_account($billing_id);
		$customer_id 			= $data['billing']['CUSTOMER_ID'];
		$data['sites']			= $this->customer_registration_model->get_sites($billing_id)->result('array');
		//--

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('Billing List', 'register/billing_list/'.$customer_id);
		$this->breadcrumbs->push('Billing Account', 'register/billing_edit/'.$billing_id);
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['menu_list']	= $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
				
		$sign = $this->customer_registration_model->get_count_billing_by_branch_id($billing_id,$branch_id);
		
		if($this->is_view_only(&$data,$customer_id,$sign))
		{
			$data['action']		= ROOT . "register/index/".$customer_id;
			$data['title'] 		= 'Lihat Billing Account';
		}
		else
		{
			$data['action']		= ROOT . "register/billing_update";
			$data['title'] 		= 'Sunting Billing Account';
		}
		
		$data['customer_id'] 	= $customer_id;
		$data['isEditing'] 		= false;
		$data['simop_name'] 	= $this->getSimopName($data['billing']['BILLING_CUSTOMER_ID'],$this->customer_registration_model->get_org_id_by_branch_id($data['billing']['BRANCH_ID'],true));

		//echo $data['simop_name']; die;

		//options
		$data['box_yesno']			= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['opt_province']		= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );
		$data['opt_branch']			= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'),$data['billing']['BRANCH_ID'])->result('array') );
		$data['box_reg_type']		= $this->options_model->getOptions('REGTYPE','ID')->result('array');
		if($this->session->userdata('registrationcompanyid_phd')=="83")
			$data['box_cfs_type']		= $this->options_model->getOptions('CFSTYPE','ID')->result('array');

		$this->common_loader($data, 'pages/register/register_billing', true);
	}

	public function submit_billing(){

		if (htmLawed($_POST['is_main_branch']) == 'Y'){
			$billing_customer_id = htmLawed($_POST['customer_id']);
		}

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$row_id = $this->customer_registration_model->get_new_billing_id();
		$billing_id = $row_id['BILLING_ID'];

		if(htmLawed($_POST['reg_type_billing'])=="NEW")
		{
			$billing_customer_id = "";
		}
		else
		{
			$billing_customer_id = htmLawed($_POST['billing_customer_id']);
		}

		if(isset($_POST['cfs_type'])){
			foreach ($_POST['cfs_type'] as $s){
				$s = htmLawed($s);
				if ($s == 'CFS'){
					$svc_cfs = 'Y';
				}
			}
		}
		
		$params = array(
					'BILLING_ID'			=> $billing_id,
					'CUSTOMER_ID' 			=> htmLawed($_POST['customer_id']),
					'ADDRESS_BILLING' 		=> htmLawed($_POST['address_billing']),
					'PROVINCE_BILLING' 		=> htmLawed($_POST['address_prov_billing']),
					'CITY_BILLING'	 		=> htmLawed($_POST['address_city_billing']),
					'KECAMATAN_BILLING' 	=> htmLawed($_POST['address_kecamatan_billing']),
					'KELURAHAN_BILLING' 	=> htmLawed($_POST['address_kelurahan_billing']),
					'POSTAL_CODE_BILLING' 	=> htmLawed($_POST['postal_code_billing']),
					'PHONE_BILLING'	=> htmLawed($_POST['phone_area_code_billing']).'.'.htmLawed($_POST['phone_billing']),
					'EMAIL_BILLING' 		=> htmLawed($_POST['email_billing']),
					'HQ_ID' 				=> htmLawed($_POST['hq_id']),
					'BRANCH_ID' 			=> htmLawed($_POST['branch_billing']),
					'BILLING_CUSTOMER_ID' 	=> $billing_customer_id,
					'IS_MAIN_BRANCH' 		=> htmLawed($_POST['is_main_branch']),
					'REG_TYPE_BILLING' 		=> htmLawed($_POST['reg_type_billing']),
					'CFS' 					=> htmLawed($svc_cfs)
				);
		
		//var_dump($params);die;
		
		$paramsite = array();
		if (isset($_POST['site'])){
			foreach ($_POST['site'] as $s){
				$s = htmLawed($s);
				$paramsite[] = array('BILLING_ID' => $billing_id, 'SITE_ID'=>$s);
			}
		}

		/*if ($params['REG_TYPE_BILLING'] == 'NEW' ){
			if ($params['IS_MAIN_BRANCH'] == 'N'){
				unset($params['BILLING_CUSTOMER_ID']);
			}
			else{
				$params['BILLING_CUSTOMER_ID'] = $params['CUSTOMER_ID'];
			}
		}*/
		//$params['BILLING_CUSTOMER_ID'] = $params['CUSTOMER_ID'];

		if(	$this->customer_registration_model->create_billing_account($params)	){

			if(htmLawed($_POST['hq_id']) == '' && htmLawed($_POST['is_main_branch']) == 'Y'){
				$this->customer_registration_model->update_hq($billing_customer_id);
			}

			$this->customer_registration_model->update_sites(htmLawed($_POST['billing_id']), $paramsite);

			redirect(ROOT.'register/billing_edit/'.$billing_id.'#bank_placeholder', 'refresh');
		}
		else {
			echo "err";
		}

	}

	public function billing_update(){

		if(htmLawed($_POST['reg_type_billing']=="NEW"))
		{
			$billing_customer_id = htmLawed($_POST['customer_id']);
		}
		else
		{
			$billing_customer_id = htmLawed($_POST['billing_customer_id']);
		}

		if(isset($_POST['cfs_type'])){
			foreach ($_POST['cfs_type'] as $s){
				$s = htmLawed($s);
				if ($s == 'CFS'){
					$svc_cfs = 'Y';
				}
			}
		}
		
		$params = array(
						'CUSTOMER_ID'			=> htmLawed($_POST['customer_id']),
						'ADDRESS_BILLING'		=> htmLawed($_POST['address_billing']),
						'PROVINCE_BILLING'		=> htmLawed($_POST['address_prov_billing']),
						'CITY_BILLING'			=> htmLawed($_POST['address_city_billing']),
						'KECAMATAN_BILLING'		=> htmLawed($_POST['address_kecamatan_billing']),
						'KELURAHAN_BILLING'		=> htmLawed($_POST['address_kelurahan_billing']),
						'POSTAL_BILLING'	=> htmLawed($_POST['postal_code_billing']),
						'PHONE_BILLING'	=> htmLawed($_POST['phone_area_code_billing']).'.'.htmLawed($_POST['phone_billing']),
						'EMAIL_BILLING'			=> htmLawed($_POST['email_billing']),
						'HQ_ID'					=> htmLawed($_POST['hq_id']),
						'BRANCH_ID'				=> htmLawed($_POST['branch_billing']),
						'BILLING_CUSTOMER_ID'	=> $billing_customer_id,
						'IS_MAIN_BRANCH'		=> htmLawed($_POST['is_main_branch']),
						'REG_TYPE_BILLING' 		=> htmLawed($_POST['reg_type_billing']),
						'CFS' 					=> htmLawed($svc_cfs),
						'BILLING_ID'			=> htmLawed($_POST['billing_id'])
					);
		//var_dump($params);
		$paramsite = array();
		if (isset($_POST['site'])){
			foreach ($_POST['site'] as $s){
				$s = htmLawed($s);
				$paramsite[] = array('BILLING_ID' => htmLawed($_POST['billing_id']), 'SITE_ID'=>$s);
			}
		}
		
		if( $this->customer_registration_model->update_billing_account($params) ){
			if ($this->customer_registration_model->update_sites(htmLawed($_POST['billing_id']), $paramsite)){
				redirect(ROOT.'register/billing_list/'.htmLawed($_POST['customer_id']), 'refresh');
			}
		}
		echo "err";
	}

	public function billing_delete($billing_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		return $this->customer_registration_model->delete_billing_account($billing_id);
	}

	public function billing_list($customer_id){

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('Billing List'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Daftar Billing Account';

		$branch_id_counter = $this->customer_registration_model->get_count_branch_id_by_org_id($this->session->userdata('registrationcompanyid_phd'));
		$allow_save = 0;
		
		if($this->customer_registration_model->get_count_billing_account_by_org_id($customer_id,$this->session->userdata('registrationcompanyid_phd'))<$branch_id_counter)
		{
			$allow_save = 1;
		}
		
		$this->is_view_only(&$data,$customer_id,$allow_save);
			
		$data['customer_id'] = $customer_id;

		$this->table = $this->billing_table($customer_id);

		$this->common_loader($data, 'pages/register/list_billing',true);
	}

	public function billing_table($customer_id){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Customer ID Billing',
				'Cabang',
				'Alamat',
				'Status',
				'Action'
			);

		$t_table = $this->customer_registration_model->view_list_billing($customer_id)->result("array");
		$i = 1;
		
		foreach ($t_table as $t){
			$stat = '<span class="label label-warning">Incomplete</span>';


			if ($t['AM']+$t['BANK'] > 0){
				$stat = '<span class="label label-success">Complete</span>';
			}

			if($this->customer_registration_model->get_all_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'),$t['BRANCH_ID'])>0)
				$allow_save = true;
			else 
				$allow_save = false;
			
			if($this->is_view_only(&$data,$customer_id,$allow_save))
			{
				$action = '<a class="table-link        click_detail billing_detail" data-billing_id="'.$t['BILLING_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-eye    fa-stack-1x fa-inverse"></i></span></a>';
			}
			else
			{				
				$action = '<a class="table-link        click_detail billing_detail" data-billing_id="'.$t['BILLING_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>';	
			}
			
			$this->table->add_row(
				$i++,
				$t['BILLING_CUSTOMER_ID'],
				$t['BRANCH'],
				$t['ADDRESS_BILLING'],
				$stat,
				$action
			);
		}
		return $this->table;
	}

	public function get_last_billing_id($params){

		//return $this->customer_registration_model->get_last_billing_id($params)
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	// bank modal form
	public function bank_list($billing_id,$customer_id){
		$data['action']= "";

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
				
		$sign = $this->customer_registration_model->get_count_billing_by_branch_id($billing_id,$branch_id);
		
		$view_only = $this->is_view_only(&$data,$customer_id,$sign);
			
		$this->table = $this->bank_table($billing_id,$view_only);

		$this->load->view('pages/register/list_bank', $data);
	}

	public function bank_table($billing_id,$view_only){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Rekening',
				'Bank',
				'Mata Uang',
				'Autocollection Kapal',
				'Autocollection Barang',
				'Autocollection B/M Barang',
				//'CMS',
				'Action'
			);

		$t_table = $this->customer_registration_model->view_list_bank($billing_id)->result("array");

		$i = 1;
		foreach ($t_table as $t){
			
			$do_action="";
			if(!$view_only)
			{
				$do_action = '<a class="table-link        click_detail bank_detail" data-bank_account_id="'.$t['BANK_ACCOUNT_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				.'<a class="table-link danger click_delete bank_detail" data-bank_account_id="'.$t['BANK_ACCOUNT_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>';
			}
			
			$this->table->add_row(
				$i++,
				$t['ACCOUNT_NO'],
				$t['BANK_NAME'],
				$t['CURRENCY'],
				$t['AUTOCOLLECTION'],
				$t['AUTOCOLLECTION_BARANG'],
				$t['AUTOCOLLECTION_BM_BARANG'],
				//$t['CMS'],
				$do_action
			);
		}

		return $this->table;
	}

	public function submit_bank(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		if(htmLawed($_POST['cms'])=="Y")
		{
			$saldo_minimum_cms = htmLawed($_POST['saldo_minimum_cms']);

			if($saldo_minimum_cms=="")
				$saldo_minimum_cms=0;
		}
		else
			$saldo_minimum_cms = 0;

		if(!isset($_POST['autocollection'])){$_POST['autocollection'] = 'N';}
		if(!isset($_POST['autocollection_barang'])){$_POST['autocollection_barang'] = 'N';}
		if(!isset($_POST['autocollection_bm_barang'])){$_POST['autocollection_bm_barang'] = 'N';}
		$params = array(
						'BILLING_ID'	=> htmLawed($_POST['billing_id']),
						'ACCOUNT_NO'	=> htmLawed($_POST['account_no']),
						'BANK_ID'		=> htmLawed($_POST['bank_id']),
						'CURRENCY'		=> htmLawed($_POST['currency']),
						'AUTOCOLLECTION'=> htmLawed($_POST['autocollection']),
						"AUTOCOLLECTION_BARANG"	=> htmLawed($_POST['autocollection_barang']),
						"AUTOCOLLECTION_BM_BARANG"	=> htmLawed($_POST['autocollection_bm_barang']),
						'CMS'=> htmLawed($_POST['cms']),
						'SALDO_MIN_CMS'=> $saldo_minimum_cms,
						'TOKEN_ID'=> htmLawed($_POST['token_id'])
					);

		return $this->customer_registration_model->create_bank($params);
	}

	public function update_bank(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		if(htmLawed($_POST['cms']=="Y"))
		{
			$saldo_minimum_cms = htmLawed($_POST['saldo_minimum_cms']);

			if($saldo_minimum_cms=="")
				$saldo_minimum_cms=0;
		}
		else
			$saldo_minimum_cms = 0;

		if(!isset($_POST['autocollection'])){$_POST['autocollection'] = 'N';}
		if(!isset($_POST['autocollection_barang'])){$_POST['autocollection_barang'] = 'N';}
		if(!isset($_POST['autocollection_bm_barang'])){$_POST['autocollection_bm_barang'] = 'N';}
		$params = array(
						"ACCOUNT_NO"		=> htmLawed($_POST['account_no']),
						"BANK_ID"			=> htmLawed($_POST['bank_id']),
						"CURRENCY"			=> htmLawed($_POST['currency']),
						"AUTOCOLLECTION"	=> htmLawed($_POST['autocollection']),
						"AUTOCOLLECTION_BARANG"	=> htmLawed($_POST['autocollection_barang']),
						"AUTOCOLLECTION_BM_BARANG"	=> htmLawed($_POST['autocollection_bm_barang']),
						'CMS'				=> htmLawed($_POST['cms']),
						'SALDO_MIN_CMS'		=> $saldo_minimum_cms,
						'BRANCH_ID'       	=> htmLawed($_POST['branch']),
						"TOKEN_ID"			=> htmLawed($_POST['token_id']),
						"BANK_ACCOUNT_ID"	=> htmLawed($_POST['bank_account_id'])
					);

		return $this->customer_registration_model->update_bank($params, htmLawed($_POST['billing_id']));
	}

	public function delete_bank($bank_account_id){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		return $this->customer_registration_model->delete_bank($bank_account_id);
	}


////////////////////////////////////////////////////////////////////////////////////////////////////
	//ceo form
	public function ceo($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('CEO'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/ceo');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_ceo";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Mendaftarkan CEO';
		
		$this->is_view_only(&$data,$customer_id);

		//options
		$data['opt_sex']				= rsArrToOptArr(	$this->options_model->getOptions('SEX','ID')->result('array')	);
		$data['opt_religion']			= rsArrToOptArr(	$this->options_model->getOptions('RELIGION','ID')->result('array')	);
		$data['box_yesno']				= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['box_nationality']		= $this->options_model->getOptions('NATIONALITY','ID')->result('array');
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );

		$data['customer_id']=$customer_id;
		$data['ceo_id']="";
		$data['ceo']=null;
		$data['isEditing']=false;
		$this->common_loader($data,'pages/register/register_ceo');
	}

	public function submit_ceo(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		if (!isset($_POST['ktp'])){$_POST['ktp'] = '';}
		if (!isset($_POST['ktp_expire_date_ceo'])){$_POST['ktp_expire_date_ceo'] = '';}
		if (!isset($_POST['passport'])){$_POST['passport'] = '';}
		if (!isset($_POST['passport_expire_date_ceo'])){$_POST['passport_expire_date_ceo'] = '';}

		$params = array(
					'customer_id_ceo'		=>htmLawed($_POST['customer_id_ceo']),
					'name_ceo'				=>htmLawed($_POST['name_ceo']),
					'address_ceo'			=>htmLawed($_POST['address_ceo']),
					'address_prov_ceo'		=>htmLawed($_POST['address_prov_ceo']),
					'address_city_ceo'		=>htmLawed($_POST['address_city_ceo']),
					'city_type'				=>"",
					'address_kecamatan_ceo'	=>htmLawed($_POST['address_kecamatan_ceo']),
					'address_kelurahan_ceo'	=>htmLawed($_POST['address_kelurahan_ceo']),
					'postal_code_ceo'		=>htmLawed($_POST['postal_code_ceo']),
					'phone_ceo'				=>htmLawed($_POST['phone_area_code_ceo']).'.'.htmLawed($_POST['phone_ceo']),
					'hp_ceo'				=>htmLawed($_POST['hp_ceo']),
					'email_ceo'				=>htmLawed($_POST['email_ceo']),
					'location_birth_ceo'	=>htmLawed($_POST['location_birth_ceo']),
					'birthdate_ceo'			=>htmLawed($_POST['birthdate_ceo']),
					'nationality'			=>htmLawed($_POST['nationality']),
					'ktp'					=>htmLawed($_POST['ktp']),
					'passport'				=>htmLawed($_POST['passport']),
					'sex'					=>htmLawed($_POST['sex']),
					'religion'				=>htmLawed($_POST['religion']),
					'ktp_expire_date_ceo'		=>htmLawed($_POST['ktp_expire_date_ceo']),
					'passport_expire_date_ceo'	=>htmLawed($_POST['passport_expire_date_ceo'])
				);

		if(	$this->customer_registration_model->create_ceo($params)	){

			redirect(ROOT.'register/index/'.htmLawed($_POST['customer_id_ceo']), 'refresh');
		}
		else {
			echo "err";
		}
	}

	public function ceo_edit($ceo_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['ceo'] 		= $this->customer_registration_model->read_ceo($ceo_id);
		$customer_id = $data['ceo']['CUSTOMER_ID'];

		$this->load->model('customer_registration_model');

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('Edit CEO'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/ceo_edit/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['ceo_id'] 	= $ceo_id;
		$data['isEditing'] 	= true;

		//var_dump($data['ceo']); die;

		//options
		$data['action']= ROOT . "register/submit_edit_ceo";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Edit CEO';
		
		if($this->is_view_only(&$data,$customer_id))
		{
			$data['action']= ROOT . 'register/index/'.$customer_id;
			$data['title'] = 'Lihat CEO';
		}
		else
		{
			$data['action']= ROOT . "register/submit_edit_ceo";
			$data['title'] = 'Edit CEO';
		}
		
		//options
		$data['opt_sex']				= rsArrToOptArr(	$this->options_model->getOptions('SEX','ID')->result('array')	);
		$data['opt_religion']			= rsArrToOptArr(	$this->options_model->getOptions('RELIGION','ID')->result('array')	);
		$data['box_yesno']				= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['box_nationality']		= $this->options_model->getOptions('NATIONALITY','ID')->result('array');
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );

		$data['customer_id'] = "";
		$data['isEditing'] 		= true;
		$this->common_loader($data, 'pages/register/register_ceo');
	}

	public function submit_edit_ceo(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		if (!isset($_POST['ktp'])){$_POST['ktp'] = '';}
		if (!isset($_POST['ktp_expire_date_ceo'])){$_POST['ktp_expire_date_ceo'] = '';}
		if (!isset($_POST['passport'])){$_POST['passport'] = '';}
		if (!isset($_POST['passport_expire_date_ceo'])){$_POST['passport_expire_date_ceo'] = '';}
		$params = array(
					'customer_id_ceo'		=>htmLawed($_POST['customer_id_ceo']),
					'name_ceo'				=>htmLawed($_POST['name_ceo']),
					'address_ceo'			=>htmLawed($_POST['address_ceo']),
					'address_prov_ceo'		=>htmLawed($_POST['address_prov_ceo']),
					'address_city_ceo'		=>htmLawed($_POST['address_city_ceo']),
					'city_type'				=>"",
					'address_kecamatan_ceo'	=>htmLawed($_POST['address_kecamatan_ceo']),
					'address_kelurahan_ceo'	=>htmLawed($_POST['address_kelurahan_ceo']),
					'postal_code_ceo'		=>htmLawed($_POST['postal_code_ceo']),
					'phone_ceo'				=>htmLawed($_POST['phone_area_code_ceo']).'.'.htmLawed($_POST['phone_ceo']),
					'hp_ceo'				=>htmLawed($_POST['hp_ceo']),
					'email_ceo'				=>htmLawed($_POST['email_ceo']),
					'location_birth_ceo'	=>htmLawed($_POST['location_birth_ceo']),
					'birthdate_ceo'			=>htmLawed($_POST['birthdate_ceo']),
					'nationality'			=>htmLawed($_POST['nationality']),
					'ktp'					=>htmLawed($_POST['ktp']),
					'passport'				=>htmLawed($_POST['passport']),
					'sex'					=>htmLawed($_POST['sex']),
					'religion'				=>htmLawed($_POST['religion']),
					'ktp_expire_date_ceo'		=>htmLawed($_POST['ktp_expire_date_ceo']),
					'passport_expire_date_ceo'	=>htmLawed($_POST['passport_expire_date_ceo']),
					'id_ceo'				=>htmLawed($_POST['id_ceo'])
				);

		if(	$this->customer_registration_model->update_ceo($params)	){

			//redirect(ROOT.'register/ceo_edit/'.$_POST['id_ceo'], 'refresh');
			redirect(ROOT.'register/index/'.htmLawed($_POST['customer_id_ceo']), 'refresh');
		}
		else {
			echo "err";
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	//account manager form
	public function am($billing_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$cust_row = $this->customer_registration_model->get_customer_id_by_billing_id($billing_id);
		$customer_id = $cust_row['CUSTOMER_ID'];

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('Billing List', 'register/billing_list/'.$customer_id);
		$this->breadcrumbs->push('Billing List', 'register/billing_edit/'.$billing_id);
		$this->breadcrumbs->push('Billing Account', 'register/am_list/'.$billing_id);
		$this->breadcrumbs->push('Account Manager', 'register/am/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_am";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Mendaftarkan Account Manager Baru';
		
		$this->is_view_only(&$data,$customer_id,true);

		//options
		$data['isEditing'] 				= false;
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );
		$data['billing_id'] 			= $billing_id;
		$this->common_loader($data, 'pages/register/register_am');
	}

	public function am_list($billing_id, $listonly=null){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$cust_row = $this->customer_registration_model->get_customer_id_by_billing_id($billing_id);
		$customer_id = $cust_row['CUSTOMER_ID'];
			
		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
				
		$sign = $this->customer_registration_model->get_count_billing_by_branch_id($billing_id,$branch_id);
		
		$view_only = $this->is_view_only(&$data,$customer_id,$sign);
		
		$data['billing_id']=$billing_id;
		$this->table = $this->am_table($billing_id,$view_only);

		if ($listonly){
			$this->load->view('pages/register/list_am', $data);
		}
		else{
			$data['customer_id']= $customer_id;

			$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
			$this->breadcrumbs->push('Billing Account', '/register/billing_edit/'.$billing_id);
			$this->breadcrumbs->push('List Account Manager', '/register/am_list/');
			$this->breadcrumbs->unshift('Home', '/');
			$data['breadcrumbs'] = $this->breadcrumbs->show();

			$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
			$data['title'] = 'Pendaftaran Pelanggan';
			$this->common_loader($data, 'pages/register/list_am', true);
		}

	}

	public function am_table($billing_id,$is_view_only){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Nama',
				'Jabatan',
				'Action'
			);
		$params = array(
			'billing_id'=>$billing_id
		);
		$t_table = $this->customer_registration_model->view_list_am($params)->result("array");

		$i=1;
		foreach ($t_table as $t){
			
			if(!$is_view_only)
			{
				$do_action = 				 '<a class="table-link        click_detail am_detail" data-am_id="'.$t['AM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				.'<a class="table-link danger click_delete am_detail" data-am_id="'.$t['AM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>';
			}
			else
			{
				$do_action = 				 '<a class="table-link        click_detail am_detail" data-am_id="'.$t['AM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>';
				
			}

			$this->table->add_row(
				$i++,
				$t['NAME_AM'],
				$t['TITLE_AM'],
				$do_action 
			);
		}
		return $this->table;
	}

	public function submit_am(){
		$params = array(
					'billing_id_am'		=>htmLawed($_POST['billing_id_am']),
					'title_am'			=>htmLawed($_POST['title_am']),
					'name_am'			=>htmLawed($_POST['name_am']),
					'address_am'		=>htmLawed($_POST['address_am']),
					'address_prov_am'	=>htmLawed($_POST['address_prov_am']),
					'address_city_am'	=>htmLawed($_POST['address_city_am']),
					'city type'			=>'',
					'address_kecamatan_am'	=>htmLawed($_POST['address_kecamatan_am']),
					'address_kelurahan_am'	=>htmLawed($_POST['address_kelurahan_am']),
					'postal_code_am'		=>htmLawed($_POST['postal_code_am']),
					'phone_am'				=>htmLawed($_POST['phone_area_code_am']).'.'.htmLawed($_POST['phone_am']),
					'hp_am'					=>htmLawed($_POST['hp_am']),
					'email_am'				=>htmLawed($_POST['email_am'])
				);

		if(	$this->customer_registration_model->create_account_manager($params)	){

			redirect(ROOT.'register/billing_edit/'.htmLawed($_POST['billing_id_am']), 'refresh');
		}
		else {
			echo "err";
		}

	}

	public function am_edit($am_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['am'] = $this->customer_registration_model->read_account_manager($am_id);
		$billing_id = $data['am']['BILLING_ID'];
		//echo $billing_id; //die;
		//echo 'ASDASDASD';

		
		$cust_row = $this->customer_registration_model->get_customer_id_by_billing_id($billing_id);
		$customer_id = $cust_row['CUSTOMER_ID'];
		//echo $customer_id; die;

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('Billing List', '/register/billing_list/'.$customer_id);
		$this->breadcrumbs->push('Billing Account', '/register/billing_edit/'.$billing_id);
		$this->breadcrumbs->push('Account Manager List', '/register/am_list/'.$billing_id);
		$this->breadcrumbs->push('Account Manager', '/register/am/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['am_id'] 	= $am_id;
		$data['isEditing'] 		= true;

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
				
		$sign = $this->customer_registration_model->get_count_billing_by_branch_id($billing_id,$branch_id);
		
		if($this->is_view_only(&$data,$customer_id,$sign))
		{
			$data['action']= ROOT . '/register/billing_edit/'.$billing_id;
			$data['title'] = 'Lihat Account Manager';
		}
		else
		{
			$data['action']= ROOT . "register/submit_edit_am";
			$data['title'] = 'Edit Account Manager';
		}
		
		//options
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );
		//$data['billing_id'] = "";
		$this->common_loader($data, 'pages/register/register_am');
	}

	public function submit_edit_am(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$params = array(
					'billing_id_am'			=>htmLawed($_POST['billing_id_am']),
					'title_am'				=>htmLawed($_POST['title_am']),
					'name_am'				=>htmLawed($_POST['name_am']),
					'address_am'			=>htmLawed($_POST['address_am']),
					'address_prov_am'		=>htmLawed($_POST['address_prov_am']),
					'address_city_am'		=>htmLawed($_POST['address_city_am']),
					'city type'				=>'',
					'address_kecamatan_am'	=>htmLawed($_POST['address_kecamatan_am']),
					'address_kelurahan_am'	=>htmLawed($_POST['address_kelurahan_am']),
					'postal_code_am'		=>htmLawed($_POST['postal_code_am']),
					'phone_am'				=>htmLawed($_POST['phone_area_code_am']).'.'.htmLawed($_POST['phone_am']),
					'hp_am'					=>htmLawed($_POST['hp_am']),
					'email_am'				=>htmLawed($_POST['email_am']),
					'am_id'					=>htmLawed($_POST['id_am'])
				);

		if(	$this->customer_registration_model->update_account_manager($params)	){

			redirect(ROOT.'register/billing_edit/'.htmLawed($_POST['billing_id_am']), 'refresh');
		}
		else {
			echo "err";
		}

	}

	public function delete_am($am_id){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		return $this->customer_registration_model->delete_am($am_id);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
	//board of directors form
	public function bod($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('List BOD', 'register/bod_list/'.$customer_id);
		$this->breadcrumbs->push('BOD'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/bod/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_bod";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Mendaftarkan Pimpinan Baru';
		
		$this->is_view_only(&$data,$customer_id);
		
		//options
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );
		$data['isEditing'] 		= false;
		$data['customer_id'] = $customer_id;
		$this->common_loader($data,'pages/register/register_bod');
	}

	//bod
	public function bod_list($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('List BOD'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/bod_list/'.$customer_id);
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->is_view_only(&$data,$customer_id);
		
		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Daftar BOD';
		$data['customer_id']=$customer_id;
		$this->table = $this->bod_table($customer_id);

		$this->common_loader($data, 'pages/register/list_bod', true);
	}

	public function bod_table($customer_id){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Nama',
				'Jabatan',
				'Action'
			);
		$params = array(
			'customer_id'=>$customer_id
		);
		$t_table = $this->customer_registration_model->view_list_bod($params)->result("array");

		$i=1;
		foreach ($t_table as $t){
			
			if($this->is_view_only(&$data,$customer_id))
			{
				$action = '<a class="table-link        click_detail bod_detail" data-bod_id="'.$t['BOD_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-eye    fa-stack-1x fa-inverse"></i></span></a>';
			}
			else
			{
				$action = '<a class="table-link        click_detail bod_detail" data-bod_id="'.$t['BOD_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				.'<a class="table-link danger click_delete bod_detail" data-bod_id="'.$t['BOD_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>';
			}
		
			$this->table->add_row(
				$i,
				$t['NAME_BOD'],
				$t['TITLE_BOD'],
				$action 
			);
			$i++;
		}
		return $this->table;
	}

	public function submit_bod(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$params = array(
					'customer_id_bod'		=>htmLawed($_POST['customer_id_bod']),
					'title_bod'				=>htmLawed($_POST['title_bod']),
					'name_bod'				=>htmLawed($_POST['name_bod']),
					'address_bod'			=>htmLawed($_POST['address_bod']),
					'address_prov_bod'		=>htmLawed($_POST['address_prov_bod']),
					'address_city_bod'		=>htmLawed($_POST['address_city_bod']),
					'city type'				=>'',
					'address_kecamatan_bod'	=>htmLawed($_POST['address_kecamatan_bod']),
					'address_kelurahan_bod'	=>htmLawed($_POST['address_kelurahan_bod']),
					'postal_code_bod'		=>htmLawed($_POST['postal_code_bod']),
					'phone_bod'				=>htmLawed($_POST['phone_area_code_bod']).'.'.htmLawed($_POST['phone_bod']),
					'hp_bod'				=>htmLawed($_POST['hp_bod']),
					'email_bod'				=>htmLawed($_POST['email_bod'])
				);

		if(	$this->customer_registration_model->create_bod($params)	){

			redirect(ROOT.'register/bod_list/'.htmLawed($_POST['customer_id_bod']), 'refresh');
		}
		else {
			echo "err";
		}

	}

	public function bod_delete($bod_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		return $this->customer_registration_model->delete_bod($bod_id);
	}

	public function bod_edit($bod_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['bod'] 		= $this->customer_registration_model->read_bod($bod_id);
		$customer_id 		= $data['bod']['CUSTOMER_ID'];

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('List BOD', '/register/bod_list/'.$customer_id);
		$this->breadcrumbs->push('BOD'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/bod/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['bod_id'] 	= $bod_id;
		$data['isEditing'] 		= true;
		
		if($this->is_view_only(&$data,$customer_id))
		{
			$data['action']= ROOT . '/register/bod_list/'.$customer_id;
			$data['title'] = 'Lihat BOD';
		}
		else
		{
			$data['action']= ROOT . "register/submit_edit_bod";
			$data['title'] = 'Edit BOD';
		}
			
		//options
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		//options
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );
		$data['customer_id'] = "";
		$this->common_loader($data, 'pages/register/register_bod');
	}

	public function submit_edit_bod(){

		$params = array(
					'customer_id_bod'		=>htmLawed($_POST['customer_id_bod']),
					'title_bod'				=>htmLawed($_POST['title_bod']),
					'name_bod'				=>htmLawed($_POST['name_bod']),
					'address_bod'			=>htmLawed($_POST['address_bod']),
					'address_prov_bod'		=>htmLawed($_POST['address_prov_bod']),
					'address_city_bod'		=>htmLawed($_POST['address_city_bod']),
					'city type'				=>'',
					'address_kecamatan_bod'	=>htmLawed($_POST['address_kecamatan_bod']),
					'address_kelurahan_bod'	=>htmLawed($_POST['address_kelurahan_bod']),
					'postal_code_bod'		=>htmLawed($_POST['postal_code_bod']),
					'phone_bod'				=>htmLawed($_POST['phone_area_code_bod']).'.'.htmLawed($_POST['phone_bod']),
					'hp_bod'				=>htmLawed($_POST['hp_bod']),
					'email_bod'				=>htmLawed($_POST['email_bod']),
					'id_bod'				=>htmLawed($_POST['id_bod'])
				);

		if(	$this->customer_registration_model->update_bod($params)	){

			redirect(ROOT.'register/bod_list/'.htmLawed($_POST['customer_id_bod']), 'refresh');
		}
		else {
			echo "err";
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	//non pbm
	public function non_pbm($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('Tambah Pelanggan'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_non_pbm";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Pelanggan';
		
		$this->is_view_only(&$data,$customer_id);
		
		$data['customer_id'] = $customer_id;

		//options
		$data['box_three_partied']		= $this->options_model->getOptions('THREEPARTIEDCODE','ID')->result('array');

		$data['register']=$this->customer_registration_model->read_customer($customer_id); //print_r($data['register']);die;

		if($data['register']['IS_FF']=="Y")
			$data['header'] = "FREIGHT FORWARDER";
		else if($data['register']['IS_EMKL']=="Y")
			$data['header'] = "EMKL";
		else if($data['register']['IS_PPJK']=="Y")
			$data['header'] = "PPJK";
		else if($data['register']['IS_CONSIGNEE']=="Y")
			$data['header'] = "CONSIGNEE";

		$this->common_loader($data,'pages/register/register_non_pbm');
	}

	public function non_pbm_params(){
		$params = array(
					'THREE_PARTIED_CODE'	=> htmLawed($_POST['three_partied_code']),
					'SIUJPT'				=> htmLawed($_POST['siujpt']),
					'SIUJPT_EXPIRED_DATE'	=> htmLawed($_POST['siujpt_expired_date']),
					'TDG'					=> htmLawed($_POST['tdg']),
					'ALFI'					=> htmLawed($_POST['alfi']),
					'CUSTOMER_ID'			=> htmLawed($_POST['customer_id']),
					'NON_PBM_ID'			=> htmLawed($_POST['non_pbm_id'])
				);

		return $params;
	}

	public function submit_non_pbm(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = $this->non_pbm_params();

		if(	$this->customer_registration_model->create_non_pbm($params)	){

			redirect(ROOT.'register/index/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else {
			echo "err";
		}
	}

	public function non_pbm_edit($pbm_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$data['non_pbm'] = $this->customer_registration_model->read_non_pbm($pbm_id);
		$customer_id = $data['non_pbm']['CUSTOMER_ID'];


		$data['register']=$this->customer_registration_model->read_customer($customer_id); //print_r($data['register']);die;

		if($data['register']['IS_FF']=="Y")
			$data['header'] = "FREIGHT FORWARDER";
		else if($data['register']['IS_EMKL']=="Y")
			$data['header'] = "EMKL";
		else if($data['register']['IS_PPJK']=="Y")
			$data['header'] = "PPJK";
		else if($data['register']['IS_CONSIGNEE']=="Y")
			$data['header'] = "CONSIGNEE";

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push($data['header'].$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/non_pbm_update";
		
		if($this->is_view_only(&$data,$customer_id))
		{
			$data['action']= ROOT . 'register/index/'.$customer_id;
			$data['title'] = 'Lihat Pelanggan';
		}
		else
		{
			$data['action']= ROOT . "register/non_pbm_update";
			$data['title'] = 'Pendaftaran Pelanggan';
		}
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		//options
		$data['box_three_partied']		= $this->options_model->getOptions('THREEPARTIEDCODE','ID')->result('array');

		$data['skapal_user_status'] = $this->customer_registration_model->check_user_simkapal_sync($pbm_id,$customer_id);
		$data['skapal_user_data'] = $this->customer_registration_model->view_detail_user_simkapal($pbm_id,$customer_id)->row_array();
		if (sizeof($data['skapal_user_data'])<=0){
			unset($data['skapal_user_data']);
			$data['skapal_user_data_record'] = 0;
		}
		else
		{
			$data['skapal_user_data_record'] = sizeof($data['skapal_user_data']);
		}

		$this->common_loader($data,'pages/register/register_non_pbm');
	}

	public function non_pbm_update(){

		$params = $this->non_pbm_params();

		//VAR_DUMP($params);

		if(	$this->customer_registration_model->update_non_pbm($params)	){
			redirect(ROOT.'register/index/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else {
			echo "err";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	//PPJK
	public function load_ppjk_consg($customer_id){
	}
	
	public function ppjk_consg_list($customer_id){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('List Consignee EMKL'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();		
		
		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['opt_viewbranch']=rsArrToOptArr($this->branch_model->getBranchOptions()->result('array'));
		$data['sel_viewbranch'] = '03';
		
		if (!in_array($this->session->userdata('group_phd'), array('2'))){
			$data['is_readonly'] = 'readonly';
		}
		
		$data['list_consg'] = $this->customer_registration_model->get_ppjk_consignee_list($customer_id);
		$data['ppjk_id'] = $customer_id;
		
		//var_dump($data['list_consg']);die;
		$data["customer_id"] = $customer_id;
		
		$this->common_loader($data,'pages/register/list_ppjk_consg', true);
	}
	
	public function submit_ppjk_consg(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$branch_id = $branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		
		$params = array(
						'PPJK_ID'	=> htmLawed($_POST['ppjk_id']),
						'CONSIGNEE_ID'	=> htmLawed($_POST['consignee_id']),
						'EXPIRED_DATE'	=> htmLawed($_POST['expired_date']),
						'USERID' => htmLawed($this->session->userdata('uname_phd')),
						'BRANCH_ID' => $branch_id
					);
		if($this->customer_registration_model->count_consignee_ppjk(htmLawed($_POST['ppjk_id']),htmLawed($_POST['consignee_id']))>0)
			echo "already_add";
		else  
			echo $this->customer_registration_model->create_ppjk_consignee($params);
	}
	
	public function update_ppjk_consg(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		
		$params = array(
						'EXPIRED_DATE'	=> htmLawed($_POST['expired_date']),
						'ID'	=> htmLawed($_POST['id'])
						
					);
		
		echo $this->customer_registration_model->update_ppjk_consignee($params);
	}		
	
	public function ppjk_consg_delete($id){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		
		return $this->customer_registration_model->delete_ppjk_consg($id);
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	//pbm
	public function pbm($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('Tambah Pelanggan'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_pbm";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Pelanggan';
		
		$allow_save = false;
		$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
		$registrationcompanyid_cust = $this->customer_registration_model->get_registration_company_id($customer_id);
		if($registrationcompanyid!=$registrationcompanyid_cust)
		{
			$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($registrationcompanyid);
			
			$sign = $this->customer_registration_model->get_branch_sign_by_branch_id($customer_id,$branch_id);
			if($sign>0)
				$allow_save = true;
		}
		else
		{
			$allow_save = true;
		}		
		$this->is_view_only(&$data,$customer_id,$allow_save);

		$data['customer_id'] = $customer_id;

		//options
		$data['opt_branch']			= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'))->result('array') );		
		$data['box_three_partied']		= $this->options_model->getOptions('THREEPARTIEDCODE','ID')->result('array');
		$data['register']=$this->customer_registration_model->read_customer($customer_id); //print_r($data['register']);die;

		$this->common_loader($data,'pages/register/register_pbm');
	}

	public function pbm_params(){
		$params = array(
					'THREE_PARTIED_CODE'	=> htmLawed($_POST['three_partied_code']),
					'SIUPBM'				=> htmLawed($_POST['siupbm']),
					'SIUPBM_PUBLISH_DATE'	=> htmLawed($_POST['siupbm_publish_date']),
					'APBMI'					=> htmLawed($_POST['apbmi']),
					'CUSTOMER_ID'			=> htmLawed($_POST['customer_id']),
					'BRANCH_ID'				=> htmLawed($_POST['branch']),
					'PBM_ID'				=> htmLawed($_POST['pbm_id'])
				);

		return $params;
	}

	public function submit_pbm(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = $this->pbm_params();

		if(	$this->customer_registration_model->create_pbm($params)	){

			redirect(ROOT.'register/pbm_list/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else {
			echo "err";
		}
	}

	public function pbm_list($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['customer_id'] = $customer_id;

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$data['customer_id']);
		$this->breadcrumbs->push('PBM List'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/pbm_list');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran PBM';

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		if($this->customer_registration_model->get_count_pbm_by_branch_id($customer_id,$branch_id)==0)
		{
			$allow_save = true;
		}
		else
		{
			$allow_save = false;
		}
		
		$this->is_view_only(&$data,$customer_id,$allow_save);
		
		$this->table = $this->pbm_table($customer_id);

		$this->common_loader($data, 'pages/register/list_pbm', true);
	}

	public function pbm_table($customer_id){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Cabang',
				'Kode PBM',
				'SIUPBM',
				'Action'
			);

		$t_table = $this->customer_registration_model->view_list_pbm($customer_id)->result("array");

		$i=1;		
		foreach ($t_table as $t){

			if($t['BRANCH_ID']==$this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')))
				$allow_save = true;
			else 
				$allow_save = false;
		
			if($this->is_view_only(&$data,$customer_id,$allow_save))
			{
				$action = '<a class="table-link        click_detail pbm_detail" data-pbm_id="'.$t['PBM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-eye    fa-stack-1x fa-inverse"></i></span></a>';
			}
			else
			{
				// $action = '<a class="table-link        click_detail pbm_detail" data-pbm_id="'.$t['PBM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				// .'<a class="table-link danger click_delete pbm_detail" data-pbm_id="'.$t['PBM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>';								
				$action = '<a class="table-link        click_detail pbm_detail" data-pbm_id="'.$t['PBM_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>';				
			}
		
			$this->table->add_row(
				$i++,
				$t['BRANCH_NAME'],
				$t['EXTERNAL_ID'],
				$t['SIUPBM'],
				$action
			);
		}
		return $this->table;
	}
	
	public function pbm_edit($pbm_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$data['pbm'] = $this->customer_registration_model->read_pbm($pbm_id);
		$customer_id = $data['pbm']['CUSTOMER_ID'];

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$customer_id);
		$this->breadcrumbs->push('PBM'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		if($data['pbm']['BRANCH_ID']==$this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')))
			$allow_save = true;
		else 
			$allow_save = false;
		
		if($this->is_view_only(&$data,$customer_id,$allow_save))
		{
			$data['action']= ROOT . 'register/pbm_list/'.$customer_id;
			$data['title'] = 'Lihat Pelanggan';
		}
		else
		{
			$data['action']= ROOT . "register/pbm_update";
			$data['title'] = 'Pendaftaran Pelanggan';
		}
		
		//options
		$data['box_three_partied']		= $this->options_model->getOptions('THREEPARTIEDCODE','ID')->result('array');

		$data['skapal_user_status'] = $this->customer_registration_model->check_user_simkapal_sync($pbm_id,$customer_id);
		$data['skapal_user_data'] = $this->customer_registration_model->view_detail_user_simkapal($pbm_id,$customer_id)->row_array();
		if (sizeof($data['skapal_user_data'])<=0){
			unset($data['skapal_user_data']);
			$data['skapal_user_data_record'] = 0;
		}
		else
		{
			$data['skapal_user_data_record'] = sizeof($data['skapal_user_data']);
		}
		
		$data['opt_branch']			= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'),$data['pbm']['BRANCH_ID'])->result('array') );

		$this->common_loader($data,'pages/register/register_pbm');
	}

	public function pbm_update(){

		$params = $this->pbm_params();

		//VAR_DUMP($params);

		if(	$this->customer_registration_model->update_pbm($params)	){
			redirect(ROOT.'register/pbm_list/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else {
			echo "err";
		}
	}	
////////////////////////////////////////////////////////////////////////////////////////////////////
	// shipping agent
	public function shipping_agent($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('Tambah Pelanggan'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/edit');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_sa";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Pelanggan';
		
		$allow_save = false;
		$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
		$registrationcompanyid_cust = $this->customer_registration_model->get_registration_company_id($customer_id);
		if($registrationcompanyid!=$registrationcompanyid_cust)
		{
			$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($registrationcompanyid);
			
			$sign = $this->customer_registration_model->get_branch_sign_by_branch_id($customer_id,$branch_id);
			if($sign>0)
				$allow_save = true;
		}
		else
		{
			$allow_save = true;
		}
		$this->is_view_only(&$data,$customer_id,$allow_save);

		$data['customer_id'] = $customer_id;

		//options
		$data['box_three_partied']		= $this->options_model->getOptions('THREEPARTIEDCODE','ID')->result('array');
		$data['box_route_type']			= $this->options_model->getOptions('ROUTETYPE','ID')->result('array');

		$data['opt_branch']			= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'))->result('array') );
		
		$data['register']=$this->customer_registration_model->read_customer($customer_id); //print_r($data['register']);die;
		
		$this->common_loader($data,'pages/register/register_sa');
	}

	public function shipping_agent_params(){

		$route_tramper = 'N';
		$route_liner = 'N';

		foreach($_POST['route_type'] as $r){
			$r = htmLawed($r);
			if($r == 'TRAMP'){
				$route_tramper = 'Y';
			}
			else if($r == 'LINER'){
				$route_liner = 'Y';
			}
		}
		
		$external_id = "";

		if(isset($_POST['sktd']))
		{
			$sktd = htmLawed($_POST['sktd']);
		}
		else
			$sktd = "";

		if(isset($_POST['sktd_publish_date']))
		{
			$sktd_publish_date = htmLawed($_POST['sktd_publish_date']);
		}
		else
			$sktd_publish_date = "";

		if(isset($_POST['sktd_created_date']))
		{
			$sktd_created_date = htmLawed($_POST['sktd_created_date']);
		}
		else
			$sktd_created_date = "";

		if(isset($_POST['sktd_start']))
		{
			$sktd_start = htmLawed($_POST['sktd_start']);
		}
		else
			$sktd_start = "";

		if(isset($_POST['sktd_end']))
		{
			$sktd_end = htmLawed($_POST['sktd_end']);

		}
		else
			$sktd_end = "";

		if(isset($_POST['npwp']))
		{
			$npwp = htmLawed($_POST['npwp']);
		}
		else
			$npwp = "";

		if(isset($_POST['address']))
		{
			$address = htmLawed($_POST['address']);
		}
		else
			$address = "";

		if(isset($_POST['branch']))
		{
			$branch = htmLawed($_POST['branch']);
		}
		else
			$branch = "";

		$params = array(
					'THREE_PARTIED_CODE'	=> htmLawed($_POST['three_partied_code']),
					'SIAPDEL'				=> htmLawed($_POST['siapdel']),
					'SIAPDEL_EXPIRE_DATE'	=> htmLawed($_POST['siapdel_expire_date']),
					'INSA_MEMBER_NO'		=> htmLawed($_POST['insa_member_no']),
					'SKPT'					=> htmLawed($_POST['skpt']),
					'SIUPAL'				=> htmLawed($_POST['siupal']),
					'SIUPAL_PUBLISH_DATE'	=> htmLawed($_POST['siupal_publish_date']),
					'SIUPAL_EXPIRE_DATE'	=> htmLawed($_POST['siupal_expire_date']),
					'SIOPSUS'				=> htmLawed($_POST['siopsus']),
					'SIOPSUS_PUBLISH_DATE'	=> htmLawed($_POST['siopsus_publish_date']),
					'SIOPSUS_EXPIRE_DATE'	=> htmLawed($_POST['siopsus_expire_date']),
					'SIUPKK'				=> htmLawed($_POST['siupkk']),
					'SIUPKK_PUBLISH_DATE'	=> htmLawed($_POST['siupkk_publish_date']),
					'SIUPKK_EXPIRE_DATE'	=> htmLawed($_POST['siupkk_expire_date']),		
					'SKTD'					=> $sktd,
					'SKTD_PUBLISH_DATE'		=> $sktd_publish_date,
					'SKTD_CREATED_DATE'		=> date('d-m-Y'),
					'SKTD_START'			=> $sktd_start,
					'SKTD_END'			    => $sktd_end,
					'ROUTE_TRAMPER'			=> $route_tramper,	// custom!
					'ROUTE_LINER'			=> $route_liner,	// custom!
					'CUSTOMER_ID'			=> htmLawed($_POST['customer_id']),
					'NPWP'					=> $npwp,
					'ADDRESS'				=> $address,
					'BRANCH_ID'				=> $branch,
					'EXTERNAL_ID'			=> $external_id,
					'SHIPPING_AGENT_ID'		=> htmLawed($_POST['shipping_agent_id'])
				);
		//print_r($params); die();

		return $params;
	}

	public function submit_sa(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = $this->shipping_agent_params();
		$id=$_POST['simop_customer_id'];
		
		//print_r($params); die();
		

		if(	$this->customer_registration_model->create_shipping_agent($params)	){
			redirect(ROOT.'register/shipping_agent_list/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else {
			echo "err";
		}
	}

	public function shipping_agent_list($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['customer_id'] = $customer_id;

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$data['customer_id']);
		$this->breadcrumbs->push('Shipping Agent List'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/sa_pic_list');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Shipping Agent';

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		if($this->customer_registration_model->get_count_shipping_agent_by_branch_id($customer_id,$branch_id)==0)
		{
			$allow_save = true;
		}
		else
		{
			$allow_save = false;
		}
		
		$this->is_view_only(&$data,$customer_id,$allow_save);
		
		$this->table = $this->shipping_agent_table($customer_id);

		$this->common_loader($data, 'pages/register/list_shipping_agent', true);
	}

	public function shipping_agent_table($customer_id){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Cabang',
				'Kode Agen',
				'SI ADPEL',
				'Action'
			);

		$t_table = $this->customer_registration_model->view_list_sa($customer_id)->result("array");

		$i=1;		
		foreach ($t_table as $t){

			if($t['BRANCH_ID']==$this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')))
				$allow_save = true;
			else 
				$allow_save = false;
			
			if($this->is_view_only(&$data,$customer_id,$allow_save))
			{
				$action = '<a class="table-link        click_detail sa_detail" data-shipping_agent_id="'.$t['SHIPPING_AGENT_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-eye    fa-stack-1x fa-inverse"></i></span></a>';
			}
			else
			{
				// $action = '<a class="table-link        click_detail sa_detail" data-shipping_agent_id="'.$t['SHIPPING_AGENT_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				// .'<a class="table-link danger click_delete sa_detail" data-shipping_agent_id="'.$t['SHIPPING_AGENT_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>';				
				$action = '<a class="table-link        click_detail sa_detail" data-shipping_agent_id="'.$t['SHIPPING_AGENT_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>';				
				
			}
		
			$this->table->add_row(
				$i++,
				$t['BRANCH_NAME'],
				$t['EXTERNAL_ID'],
				$t['SIAPDEL'],
				$action
			);
		}
		return $this->table;
	}

	public function shipping_agent_delete($shipping_agent_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		return $this->customer_registration_model->delete_shipping_agent($shipping_agent_id);
	}
	
	public function shipping_agent_edit($shipping_agent_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$data['sa'] = $this->customer_registration_model->read_shipping_agent($shipping_agent_id);
		$customer_id = $data['sa']['CUSTOMER_ID'];

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('Shipping Agent'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		if($data['sa']['BRANCH_ID']==$this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')))
			$allow_save = true;
		else 
			$allow_save = false;
	
		if($this->is_view_only(&$data,$customer_id,$allow_save))
		{
			$data['action']= ROOT . '/register/shipping_agent_list/'.$customer_id;
			$data['title'] = 'Lihat Pelanggan';
		}
		else
		{
			$data['action']= ROOT . "register/shipping_agent_update";
			$data['title'] = 'Pendaftaran Pelanggan';
		}
		
		//options
		$data['box_three_partied']		= $this->options_model->getOptions('THREEPARTIEDCODE','ID')->result('array');
		$data['box_route_type']			= $this->options_model->getOptions('ROUTETYPE','ID')->result('array');

		$data['skapal_user_status'] = $this->customer_registration_model->check_user_simkapal_sync($shipping_agent_id,$customer_id);
		$data['skapal_user_data'] = $this->customer_registration_model->view_detail_user_simkapal($shipping_agent_id,$customer_id)->row_array();
		if (sizeof($data['skapal_user_data'])<=0){
			unset($data['skapal_user_data']);
			$data['skapal_user_data_record'] = 0;
		}
		else
		{
			$data['skapal_user_data_record'] = sizeof($data['skapal_user_data']);
		}

		$data['opt_branch']			= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'),$data['sa']['BRANCH_ID'])->result('array') );
		$data['mandatory'] = $this->customer_registration_model->mandatory_shipping_agent($shipping_agent_id);
		$this->common_loader($data,'pages/register/register_sa');
	}
	
	public function echo_user_simkapal_sync_status($shipping_agent_id){
		echo $this->customer_registration_model->check_user_simkapal_sync($shipping_agent_id);
	}

	public function shipping_agent_update(){

		$params = $this->shipping_agent_params();

		//echo htmLawed($_POST['customer_id']); die;

		if(	$this->customer_registration_model->update_shipping_agent($params)	){
			//print_r($_POST['customer_id']); die;
			redirect(ROOT.'register/shipping_agent_list/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else {
			echo "err";
		}
	}

	/////////---------- sim kapal user

	public function user_check_old_password(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}


		$md5_string = md5(htmLawed($_POST['old_password']).htmLawed($_POST['user_id']));

		$params = array(
			'USER_ID'			=>	htmLawed($_POST['user_id'])
		);


		if($this->session->userdata('try_check_password')>4)
		{
			echo "Attempt max, please relogin to change password";
		}
		else
		{
			if($this->session->userdata('uname_phd')==htmLawed($_POST['user_id']))
			{
				$password = $this->customer_registration_model->user_check_old_password($params);

				if($md5_string==$password)
				{
					echo 1;
				}
				else
				{
					$username = $this->session->userdata('uname_phd');
					$this->user_model->count_account($username); 	// cek ke table lock_acount
					$try_check_password=$this->session->userdata('try_check_password');
					if($try_check_password==0 || $try_check_password=="")
						$try_check_password=1;
					else
						$try_check_password++;

					$this->session->set_userdata('try_check_password', $try_check_password);
					if($try_check_password>=3){
						echo "Old password failed. ".$this->session->userdata('try_check_password')." attempt\nYour user login is not activated.";
					}else{
						echo "Old password failed. ".$this->session->userdata('try_check_password')." attempt";
					}
				}
			}
			else
			{
				$try_check_password=$this->session->userdata('try_check_password');
				if($try_check_password==0 || $try_check_password=="")
					$try_check_password=1;
				else
					$try_check_password++;

				$this->session->set_userdata('try_check_password', $try_check_password);

				echo "fail authentication. ".$this->session->userdata('try_check_password')." attempt";
			}
		}
	}

	public function user_change_password(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$md5_string = md5(htmLawed($_POST['new_password']).htmLawed($_POST['user_id']));

		$params = array(
			'NEW_PASSWORD'		=>	$md5_string,
			'USER_ID'			=>	htmLawed($_POST['user_id'])
		);

		echo $this->customer_registration_model->update_user_password($params);
	}

	public function skapal_user_submit(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$user = $this->session->userdata('uname_phd');

		//echo'<br/><br/><br/>';
		//var_dump($params);

		$params = array(
			'USER_ID'					=>	htmLawed($_POST['user_id']),
			'REAL_NAME'					=>	htmLawed($_POST['real_name']),
			'INFO_EMAIL_ADDRESS'		=>	htmLawed($_POST['info_email_address']),
			'CREATED_BY' 				=> 	$user,
			'CUSTOMER_ID'				=>	htmLawed($_POST['customer_id']),
			'INFO_SMS_NUMBER'			=>	htmLawed($_POST['info_sms_number']),
			'ID_GROUP' 					=> 	"e",
			'EXTERNAL_ID'				=>	htmLawed($_POST['external_id']),
			'BRANCH_ID'					=>	htmLawed($_POST['branch_id']),
			'REGISTRATION_COMPANY_ID'	=>	$this->session->userdata('registrationcompanyid_phd')
		);

		$this->customer_registration_model->create_user_eservice($params);

		$params = array(
			'USER_ID'					=>	htmLawed($_POST['user_id']),
			'REAL_NAME'					=>	htmLawed($_POST['real_name']),
			'CUSTOMER_ID'				=>	htmLawed($_POST['customer_id']),
			'INFO_SMS_NUMBER'			=>	htmLawed($_POST['info_sms_number']),
			'INFO_EMAIL_ADDRESS'		=>	htmLawed($_POST['info_email_address']),
			'CREATED_BY' 				=> 	$user,
			'INTERNAL_ID'				=>	htmLawed($_POST['shipping_agent_id'])
		);

		return $this->customer_registration_model->create_user_simkapal($params);
	}

	public function skapal_user_update(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$user = $this->session->userdata('uname_phd');

		$params = array(
			'REAL_NAME'					=>	htmLawed($_POST['real_name']),
			'INFO_EMAIL_ADDRESS'		=>	htmLawed($_POST['info_email_address']),
			'INFO_SMS_NUMBER'			=>	htmLawed($_POST['info_sms_number']),
			'BRANCH_ID'					=>	htmLawed($_POST['branch_id']),
			'USER_ID'					=>	htmLawed($_POST['user_id'])
		);

		$this->customer_registration_model->update_user_eservice($params);

		$params = array(
						'REAL_NAME'				=>	htmLawed($_POST['real_name']),
						'INFO_SMS_NUMBER'		=>	htmLawed($_POST['info_sms_number']),
						'INFO_EMAIL_ADDRESS'	=>	htmLawed($_POST['info_email_address']),
						'CUSTOMER_ID'			=>	htmLawed($_POST['customer_id']), //selector
						'INTERNAL_ID'			=>	htmLawed($_POST['shipping_agent_id'])
					);

		return $this->customer_registration_model->update_user_simkapal($params);
	}

	public function send_success_notification($user_id){
		return $this->customer_registration_model->set_user_reg_success($user_id);
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	// pic form
	public function sa_pic($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['customer_id'] = $customer_id;

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$data['customer_id']);
		$this->breadcrumbs->push('PIC List', 'register/sa_pic_list');
		$this->breadcrumbs->push('Shipping Agent PIC'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/sa_pic');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= ROOT . "register/submit_sa_pic";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Pelanggan';
		
		$allow_save = 0;
		$registrationcompanyid = $this->session->userdata('registrationcompanyid_phd');
		$registrationcompanyid_cust = $this->customer_registration_model->get_registration_company_id($customer_id);
		if($registrationcompanyid!=$registrationcompanyid_cust)
		{
			$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($registrationcompanyid);
			
			$sign = $this->customer_registration_model->get_branch_sign_by_branch_id($customer_id,$branch_id);
			if($sign>0)
				$allow_save = 1;
		}
		else
		{
			$allow_save = 1;
		}
		
		echo $allow_save;
		$this->is_view_only(&$data,$customer_id,$allow_save);

		//options
		$data['opt_branch']				= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'))->result('array') );
		$data['opt_sex']				= rsArrToOptArr(	$this->options_model->getOptions('SEX','ID')->result('array')	);
		$data['opt_religion']			= rsArrToOptArr(	$this->options_model->getOptions('RELIGION','ID')->result('array')	);
		$data['box_yesno']				= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['box_nationality']		= $this->options_model->getOptions('NATIONALITY','ID')->result('array');
		$data['opt_province']			= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );

		$this->common_loader($data,'pages/register/register_sa_pic');
	}

	public function sa_pic_list($customer_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['customer_id'] = $customer_id;
		$data['pic_type']="";

		$this->breadcrumbs->push('Pelanggan', 'register/index/'.$data['customer_id']);
		$this->breadcrumbs->push($data['pic_type'].' PIC List'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), 'register/sa_pic_list');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		if($this->is_view_only(&$data,$customer_id,$allow_save=true))
		{
			$data['title'] = 'Daftar PIC';
		}
		else
		{
			$data['title'] = 'Pendaftaran Pelanggan';
		}
		
		$this->table = $this->sa_pic_table($customer_id);

		$this->common_loader($data, 'pages/register/list_sa_pic', true);
	}

	public function sa_pic_table($customer_id){

		$this->load->library("table");
		$this->table->set_heading(
				'No',
				'Cabang',
				'Nama',
				'No Kontak',
				'Action'
			);

		$t_table = $this->customer_registration_model->view_list_sa_pic($customer_id)->result("array");

		$i=1;
		foreach ($t_table as $t){
			
			 if($t['BRANCH_ID']==$this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')))
				$allow_save = true;
			else 
				$allow_save = false;
			
			if($this->is_view_only(&$data,$customer_id,$allow_save))
			{
				$data['title'] = 'Daftar PIC';
				$action = '<a class="table-link click_edit pic_detail" data-pic_id="'.$t['PIC_ID'].'" ><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-eye    fa-stack-1x fa-inverse"></i></span></a>';
			}
			else
			{
				$data['title'] = 'Pendaftaran Pelanggan';
				$action = '<a class="table-link click_edit pic_detail" data-pic_id="'.$t['PIC_ID'].'" ><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				.'<a class="table-link danger click_delete pic_detail" data-pic_id="'.$t['PIC_ID'].'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a>';				
			}
		
			$this->table->add_row(
				$i++,
				$t['BRANCH'],
				$t['NAME_PIC'],
				$t['PHONE_PIC'].' / '.$t['HANDPHONE_PIC'],
				$action 
				
			);
		}
		return $this->table;
	}

	public function submit_sa_pic(){

		$params = array(
			'CUSTOMER_ID'	=>	htmLawed($_POST['customer_id']),
			'NAME_PIC'			=>	htmLawed($_POST['name_pic']),
			'KTP_PIC'			=>	htmLawed($_POST['ktp_pic']),
			'RELIGION_PIC'		=>	htmLawed($_POST['religion_pic']),
			'ADDRESS_PIC'		=>	str_replace(array("'"),array("''"),htmLawed($_POST['address_pic'])),
			'PROVINCE_PIC'		=>	htmLawed($_POST['address_prov_pic']),
			'CITY_PIC'			=>	htmLawed($_POST['address_city_pic']),
			'CITY_TYPE_PIC'		=>	'',
			'KECAMATAN_PIC'		=>	htmLawed($_POST['address_kecamatan_pic']),
			'KELURAHAN_PIC'		=>	htmLawed($_POST['address_kelurahan_pic']),
			'POSTAL_CODE_PIC'	=>	htmLawed($_POST['postal_code_pic']),
			'PHONE_PIC'			=>	htmLawed($_POST['phone_area_code_pic']).'.'.htmLawed($_POST['phone_pic']),
			'HANDPHONE_PIC'		=>	htmLawed($_POST['handphone_pic']),
			'EMAIL_PIC'			=>	htmLawed($_POST['email_pic']),
			'BRANCH_ID'			=>	htmLawed($_POST['branch'])
		);

		//echo'<br/><br/><br/>';
		//var_dump($params);

		if ($this->customer_registration_model->create_sa_pic($params)){

			redirect(ROOT.'register/sa_pic_list/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else{
			echo "Err...";
		}
	}

	public function sa_pic_delete($pic_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		return $this->customer_registration_model->delete_pic($pic_id);
	}

	public function sa_pic_edit($pic_id){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		///
		$data['pic']				= $this->customer_registration_model->read_sa_pic($pic_id);
		$customer_id 				= $data['pic']['CUSTOMER_ID'];
		$data['customer_id']		= $customer_id;
		///

		$this->breadcrumbs->push('Pelanggan', '/register/index/'.$customer_id);
		$this->breadcrumbs->push('PIC List', '/register/sa_pic_list/'.$customer_id);
		$this->breadcrumbs->push('Shipping Agent PIC'.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/sa_pic');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		if($data['pic']['BRANCH_ID']==$this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')))
			$allow_save = true;
		else 
			$allow_save = false;
		
		if($this->is_view_only(&$data,$customer_id,$allow_save))
		{
			$data['action']= ROOT . '/register/sa_pic_list/'.$customer_id;
			$data['title'] = 'Lihat Pelanggan';
		}
		else
		{
			$data['action']= ROOT . "register/sa_pic_update";
			$data['title'] = 'Pendaftaran Pelanggan';
		}
			
		//options
		$data['opt_branch']			= rsArrToOptArr( $this->branch_model->getBranchOptions($this->session->userdata('registrationcompanyid_phd'),$data['pic']['BRANCH_ID'])->result('array') );
		$data['opt_sex']			= rsArrToOptArr(	$this->options_model->getOptions('SEX','ID')->result('array')	);
		$data['opt_religion']		= rsArrToOptArr(	$this->options_model->getOptions('RELIGION','ID')->result('array')	);
		$data['box_yesno']			= $this->options_model->getOptions('YESNO','ID')->result('array');
		$data['box_nationality']	= $this->options_model->getOptions('NATIONALITY','ID')->result('array');
		$data['opt_province']		= rsArrToOptArr( $this->options_model->getProvinceList()->result('array') );


		$this->common_loader($data,'pages/register/register_sa_pic');
	}

	public function sa_pic_update(){

		//var_dump($_POST);die;

		$params = array(
			'CUSTOMER_ID'	=>	htmLawed($_POST['customer_id']),
			'NAME_PIC'			=>	htmLawed($_POST['name_pic']),
			'KTP_PIC'			=>	htmLawed($_POST['ktp_pic']),
			'RELIGION_PIC'		=>	htmLawed($_POST['religion_pic']),
			'ADDRESS_PIC'		=>	str_replace(array("'"),array("''"),htmLawed($_POST['address_pic'])),
			'PROVINCE_PIC'		=>	htmLawed($_POST['address_prov_pic']),
			'CITY_PIC'			=>	htmLawed($_POST['address_city_pic']),
			'CITY_TYPE_PIC'		=>	'',
			'KECAMATAN_PIC'		=>	htmLawed($_POST['address_kecamatan_pic']),
			'KELURAHAN_PIC'		=>	htmLawed($_POST['address_kelurahan_pic']),
			'POSTAL_CODE_PIC'	=>	htmLawed($_POST['postal_code_pic']),
			'PHONE_PIC'			=>	htmLawed($_POST['phone_area_code_pic']).'.'.htmLawed($_POST['phone_pic']),
			'HANDPHONE_PIC'		=>	htmLawed($_POST['handphone_pic']),
			'EMAIL_PIC'			=>	htmLawed($_POST['email_pic']),
			'PIC_ID'			=>	htmLawed($_POST['pic_id'])
		);

		if ($this->customer_registration_model->update_sa_pic($params)){

			redirect(ROOT.'register/sa_pic_list/'.htmLawed($_POST['customer_id']), 'refresh');
		}
		else{
			echo "Err...";
		}
	}


////////////////////////////////////////////////////////////////////////////////////////////////////
	// index

	public function index($customer_id = null){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		if(!$this->session->userdata('notify')){
			$notify = array();
		}
		else{
			$notify = $this->session->userdata('notify');
		}

		//notify('Menyimpan data sukses', array('type' => 'success', 'title'=>'Hore!'));
		//notify('wowowow', array('type' => 'warning', 'title'=>'Mufassa'));
		//notify('yeyeyey', array('type' => 'danger' ));
		//notify('uhuhuhu');

		if ($customer_id != null){
			$data['customer_id'] = $customer_id;
			
			if($this->session->userdata('group_phd')!='a')
				$user_branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
			else 
				$user_branch_id;
			
			$data['reg_progress'] = $this->customer_registration_model->check_reg_status($customer_id,$user_branch_id);
			$data['cust_types'] = $this->customer_registration_model->check_customer_type($customer_id);
			$data['billing_ids'] = $this->customer_registration_model->get_billing_ids($customer_id)->result("array");
			$data['box_branch'] = $this->options_model->getOptionsBranch()->result("array");
			$data['last_sync_status'] = $this->customer_registration_model->last_sync_status($customer_id);
			$data['status_approval'] = $this->customer_registration_model->check_submit($customer_id);
			$data['reject_notes'] = $this->customer_registration_model->reject_notes($customer_id);

			$branch_registration = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->customer_registration_model->get_customer_registration_company_id($customer_id));
			$branch_sign = $this->customer_registration_model->get_branch_sign($customer_id);
			
			$branch_sign_array = explode(",", $branch_sign);
			$data['sel_branch'] = array($branch_registration);

			foreach ($branch_sign_array as $bsa)
			{
				if($bsa!=$branch_registration)
				{
					array_push($data['sel_branch'],$bsa);
				}
			}
			
			
			//sa
			$row_sa_id = $this->customer_registration_model->get_shipping_agent_id($customer_id);
			if ($row_sa_id){
				$data['shipping_agent_id'] = $row_sa_id['SHIPPING_AGENT_ID'];
			}

			//pbm
			$row_pbm_id = $this->customer_registration_model->get_pbm_id($customer_id);
			if ($row_pbm_id){
				$data['pbm_id'] = $row_pbm_id['PBM_ID'];
			}

			//ff
			$row_non_pbm_id = $this->customer_registration_model->get_non_pbm_id($customer_id);
			if ($row_non_pbm_id){
				$data['non_pbm_id'] = $row_non_pbm_id['NON_PBM_ID'];
			}

			$row_ceo_id = $this->customer_registration_model->get_ceo_id($customer_id);
			if ($row_ceo_id){
				$data['ceo_id'] = $row_ceo_id['CEO_ID'];
			}

			$this->table->set_heading(
			  "<th width='30px'>NO</th>",
			  "<th width='100px'>Notes</th>",
			  "<th width='100px'>Tanggal Submit</th>",
			  "<th width='100px'>User</th>"
			);
			
			$audit_trail = $this->customer_registration_model->getListAuditTrail($customer_id);
			
			$i=1;
			foreach($audit_trail as $at)
			{
				$this->table->add_row(
							$i,
							$at['NOTES'],
							$at['DATE_INSERT2'],
							$at['NAME']
				);
				$i++;
			}
		 
			//var_dump($reg_progress); die;
		}

		$this->breadcrumbs->push('Pelanggan '.$this->customer_registration_model->get_customer_name_for_breadcrumbs($customer_id), '/register/index');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['action']= "";
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['title'] = 'Pendaftaran Pelanggan';
		$this->common_loader($data,'pages/register/index');
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	public function audit_trail($customer_id){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$data['row_history']=$this->customer_registration_model->getHistory($customer_id);

		$this->load->view('pages/register/audit_trail',$data);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////

	// for calling select options
	public function loadlocation($location_type, $filter, $name, $id){
		$loctype = strtolower($location_type);

		if (!in_array($loctype, array("postalcode", "city", "kecamatan", "kelurahan") )){
			return 0;
		}

		$loctype1 = ucfirst($loctype);
		$func = "Get".$loctype."List"; //ex. "city" -> GetCityList, etc...

		$data['opt_'.$loctype]			= rsArrToOptArr( $this->options_model->$func('',$filter)->result('array') );
		$data['name_assigned']			= $name;
		$data['id_assigned']			= $id;

		$this->load->view('pages/register/'.$loctype, $data);
	}

	public function load_site($branch, $site0 = null,$disabled=""){
		//var_dump ($_POST);
		if ($site0 == null && isset($_POST['sites'])){
			$sites = htmLawed($_POST['sites']);
		}
		else{
			$sites = $site0 ? $site0 : array();
		}

		//$this->load->view('pages/register/tester');
		$this->load->model('branch_model');
		$w = $this->branch_model->getSiteOptions($branch)->result('array');

		$x = options_params($w, 'site[]', '', $sites ,$disabled);

		//var_dump($_POST);
		echo options_group_loader('checkbox-down', $x);
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	// autocomplete feeder
	// for searching presaved companies, ex. for finding main branch/holding company
	public function searchcompanies($search,$branch_id){
		$search = urldecode($search);
		$x = $this->options_model->getCompanyList($search,$branch_id)->result('array');
		echo rsArrToJSON($x);
	}

	// autocomplete feeder
	// get list of company name, company id from sim kapal
	public function test($search){
		$this->load->library("Nusoap_lib");

		//$search = "pt tanto";
		$search = urldecode($search);
		$search = html_entity_decode($search);

		//custom tokenizer
		$tokens = preg_split("/[\s,]+/", $search);
		$str = "";
		foreach ($tokens as $token){
			$str .=	"
					<company>
						<company_name>$token</company_name>
					</company>";
		}
		
		//echo $str; die;

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		
		if($branch_id=="01")//priok
		{
			$service_name = "getCompanyList";
		}
		else
		{
			$service_name = "getCompanyListCabang";
		}
			
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<companies>"
				. $str .
				"
				</companies>
				<branch_id>$branch_id 
				</branch_id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(SIMOP_CUSTOMER,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//"value" key required for typeahead
			foreach ($obj->data->companies as $com ){
				$com->value = $com->company_name;
			}
			echo json_encode( $obj->data->companies );
		}
	}

	public function testDeactivasi($search){
		$this->load->library("Nusoap_lib");

		//$search = "pt tanto";
		$search = urldecode($search);
		$search = html_entity_decode($search);

		//custom tokenizer
		$tokens = preg_split("/[\s,]+/", $search);
		$str = "";
		foreach ($tokens as $token){
			$str .=	"
					<company>
						<company_name>$token</company_name>
					</company>";
		}
		
		//echo $str; die;

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		
		if($branch_id=="01")//priok
		{
			$service_name = "getDeactiveCustomer";
		}
		else
		{
			$service_name = "getDeactiveCustomer";
		}
			
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<companies>"
				. $str .
				"
				</companies>
				<branch_id>
					$branch_id 
				</branch_id>
			</data>
		</root>";
		
		
		if(!$this->nusoap_lib->call_wsdl(SIMOP_CUSTOMER,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//"value" key required for typeahead
			foreach ($obj->data->companies as $com ){
				$com->value = $com->company_name;
			}
			echo json_encode( $obj->data->companies );
		}
	}

	public function testActivasi($search){
		$this->load->library("Nusoap_lib");

		//$search = "pt tanto";
		$search = urldecode($search);
		$search = html_entity_decode($search);

		//custom tokenizer
		$tokens = preg_split("/[\s,]+/", $search);
		$str = "";
		foreach ($tokens as $token){
			$str .=	"
					<company>
						<company_name>$token</company_name>
					</company>";
		}
	

		$branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		
		//print_r($branch_id); die();
		
		if($branch_id == "01")
		{
			$service_name = "getActiveCustomer";
		}
		else
		{
			$service_name = "getActiveCustomerList";
		}
			
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<companies>"
				. $str .
				"
				</companies>
				<branch_id>
					$branch_id 
				</branch_id>
			</data>
		</root>";
		

		if(!$this->nusoap_lib->call_wsdl(SIMOP_CUSTOMER,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//"value" key required for typeahead
			foreach ($obj->data->companies as $com ){
				$com->value = $com->company_name;
			}
			echo json_encode( $obj->data->companies );
		}
	}
	

	// not an autocomplete feeder
	public function getSimopName($customer_id,$registration_company_id){
		$this->load->library("Nusoap_lib");
		
		if($registration_company_id=="83")
		{
			$service_name = "getCompanyName";
		}
		else
		{
			$service_name = "getCompanyNameBranch";
		}
		
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<company_id>". $customer_id ."</company_id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(SIMOP_CUSTOMER,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//echo $obj->data->company_name;
			return $obj->data->company_name;
		}
		//echo "wawawaw";
		//var_dump($result);
	}

	public function syncUserSKapal($id){

		//echo "done for  $id";
		///*

		$this->load->library("Nusoap_lib");

		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id>". $id ."</id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(CUSTOMER_DATA,"syncUser",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;
		}
		//*/
	}

	public function print_cust($customer_id)
	{
				$this->load->helper('pdf_helper');

				tcpdf();

				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				// $pdf = new MYPDF('P', 'mm', 'A7', true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(8, 1, 8);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				$customer=$this->customer_registration_model->read_customer($customer_id); //print_r($data['register']);die;

				$row_ceo_id = $this->customer_registration_model->get_ceo_id($customer_id);
				if ($row_ceo_id){
					$ceo_id = $row_ceo_id['CEO_ID'];
					$ceo=$this->customer_registration_model->read_ceo($ceo_id); //print_r($data['register']);die;
					if($ceo['SEX_CEO']=="M")
						$ceo['SEX_CEO'] = "Laki-laki";
					else if($ceo['SEX_CEO']=="F")
						$ceo['SEX_CEO'] = "Perempuan";
					$jabatan_ceo = "CEO/DIREKTUR";
				}
				else{
					$ceo = array(
					            'CEO_ID' => '',
								'CUSTOMER_ID' => '',
								'NAME_CEO' => '',
								'ADDRESS_CEO' => '',
								'PROVINCE_CEO' => '',
								'CITY_CEO' => '',
								'CITY_TYPE_CEO' => '',
								'KECAMATAN_CEO' => '',
								'KELURAHAN_CEO' => '',
								'POSTAL_CODE_CEO' => '',
								'PHONE_CEO' => '',
								'HANDPHONE_CEO' => '',
								'EMAIL_CEO' => '',
								'LOCATION_BIRTH_CEO' => '',
								'DATE_BIRTH_CEO' => '',
								'NATIONALITY_CEO' => '',
								'KTP_CEO' => '',
								'PASSPORT_CEO' => '',
								'SEX_CEO' => '',
								'RELIGION_CEO' => '',
								'KTP_EXPIRE_DATE_CEO' => '',
								'PASSPORT_EXPIRE_DATE_CEO' => ''
								);
					$jabatan_ceo = "";
				}

				$bod_list = $this->customer_registration_model->view_list_bod($customer_id)->result("array");
				$am_list = $this->customer_registration_model->view_list_am_by_customer_id($customer_id)->result("array");
				$pic_list = $this->customer_registration_model->view_list_sa_pic($customer_id)->result("array");
				$biling_list = $this->customer_registration_model->view_list_billing($customer_id)->result("array");
				$consignee_list = $this->customer_registration_model->get_ppjk_consignee_list($customer_id)->result("array");

				$left_spc = " ";
				$logo_ipc = APP_ROOT.'config/cube/img/ipc_logo.png';
				
				if($customer["IS_SHIPPING_LINE"]=="Y")
					$jenis_pelanggan = "SHIPPING LINE";
				else if($customer["IS_SHIPPING_AGENT"]=="Y")
					$jenis_pelanggan = "SHIPPING LINE";
				else if($customer["IS_PBM"]=="Y")
					$jenis_pelanggan = "PBM";
				else if($customer["IS_EMKL"]=="Y")
					$jenis_pelanggan = "EMKL";
				else if($customer["IS_CONSIGNEE"]=="Y")
					$jenis_pelanggan = "CARGO OWNER";
				else if($customer["IS_PPJK"]=="Y")
					$jenis_pelanggan = "PPJK";
				
				if($customer["NPWP"]!="")
					$customer_npwp_passport_info = "<tr><td width=\"270px\"><b>NPWP</b></td><td>: <b>$customer[NPWP]</b></td></tr>";
				else if($customer["PASSPORT"]!="")
					$customer_npwp_passport_info = "<tr><td width=\"270px\"><b>PASSPORT</b></td><td>: <b>$customer[PASSPORT]</b></td></tr>";
				
// ---------------------------------------------------------
				$tbl=<<<EOD

				<table align="center"><tr><td align="left" width="25%"><img src="$logo_ipc" width="150px"></td><td align="left" width="75%"><b><h2>    APLIKASI PELANGGAN JASA PELABUHAN</h2></b></td></tr></table>

				<div style="border:2px solid black;">
					<table align="left" style="">
					<tr><td width="270px"><b>No Account</b></td><td>: <b>$customer_id</b></td></tr>
					$customer_npwp_passport_info 
					<tr><td><b></b></td><td></td></tr>
					<tr><td ><b>Jenis Pelanggan</b></td><td>: <b>$jenis_pelanggan</b></td></tr>
					<tr><td><b></b></td><td></td></tr>
					</table>

					<table align="left">
					<tr><td width="270px"><b>DATA PERUSAHAAN</b></td><td></td></tr>
					<tr><td>$left_spc Nama Perusahaan</td><td>: $customer[NAME]</td></tr>
					<tr><td>$left_spc Alamat Perusahaan</td><td>: $customer[ADDRESS]</td></tr>
					<tr><td>$left_spc Telephone</td><td>: $customer[PHONE]</td></tr>
					<tr><td>$left_spc Email</td><td>: $customer[EMAIL]</td></tr>
					<tr><td></td><td></td></tr>
					</table>

					<table align="left" width="100%" cellpadding="5">
					<tr><td colspan="6"><b>PENGURUS PERUSAHAAN</b></td></tr>
					<tr bgcolor="#e1d7d5">
					<th width="40px"><b>No</b></th>
					<th><b>Nama</b></th>
					<th width="100px"><b>Jabatan</b></th>
					<th width="140px"><b>Alamat</b></th>
					<th width="90x"><b>HP</b></th>
					<th width="100px"><b>Email</b></th>
					<th ><b>No. Tanda Pengenal </b></th>
					</tr>
EOD;
					$i = 1;
					if($row_ceo_id)
					{
						$tbl .="
						<tr>
							<td>1</td>
							<td>$ceo[NAME_CEO]</td>
							<td>CEO</td>
							<td>$ceo[ADDRESS_CEO]</td>
							<td>$ceo[PHONE_CEO]</td>
							<td>$ceo[EMAIL_CEO]</td>
							<td>$ceo[KTP_CEO]</td>
						</tr>
						";
						$i++;
					}

					foreach ($am_list as $am){
						$tbl.="<tr>
						<td>$i</td>
						<td>$am[NAME_AM]</td>
						<td>$am[TITLE_AM]</td>
						<td>$am[ADDRESS_AM]</td>
						<td>$am[HANDPHONE_AM]</td>
						<td>$am[EMAIL_AM]</td>
						<td>-</td>
						</tr>";
						$i++;
					}
					
					foreach ($bod_list as $bod){
						$tbl.="<tr>
						<td>$i</td>
						<td>$bod[NAME_BOD]</td>
						<td>$bod[TITLE_BOD]</td>
						<td>$bod[ADDRESS_BOD]</td>
						<td>$bod[HANDPHONE_BOD]</td>
						<td>$bod[EMAIL_BOD]</td>
						<td>-</td>
						</tr>";
						$i++;
					}
					
					foreach ($pic_list as $pic){
						$tbl.="<tr>
						<td>$i</td>
						<td>$pic[NAME_PIC]</td>
						<td>PIC</td>
						<td>$pic[ADDRESS_PIC]</td>
						<td>$pic[HANDPHONE_PIC]</td>
						<td>$pic[EMAIL_PIC]</td>
						<td>-</td>
						</tr>";
						$i++;
					}

					$tbl .= <<<EOD
					</table>
					<br>
					<br>
					<table align="left" width="100%" cellpadding="5">
					<tr><td colspan="5"><b>ALAMAT PENAGIHAN</b></td></tr>
					<tr bgcolor="#e1d7d5">
					<th ><b>NO.</b></th>
					<th ><b>Cabang</b></th>
					<th ><b>Alamat</b></th>
					<th ><b>Email</b></th>
					<th ><b>Telephone</b></th>
					</tr>
EOD;

					$i=1;
					foreach ($biling_list as $biling){
						$tbl.="<tr>
						<td>$i</td>
						<td>$biling[CITY_BILLING]</td>
						<td>$biling[ADDRESS_BILLING]</td>
						<td>$biling[EMAIL_BILLING]</td>
						<td>$biling[PHONE_BILLING]</td>
						</tr>";
						$i++;
					}
					
					if($customer["IS_PPJK"]=="Y")
					{
						$tbl .= <<<EOD
						</table>
						<br>
						<br>
						<table align="left" width="100%" cellpadding="5">
						<tr><td colspan="5"><b>DAFTAR CONSIGNEE</b></td></tr>
						<tr bgcolor="#e1d7d5">
						<th ><b>NO.</b></th>
						<th ><b>ID Consignee</b></th>
						<th ><b>Nama</b></th>
						<th ><b>Kadaluarsa</b></th>
						<th ><b>Cabang Pendaftaran Consignee</b></th>
						</tr>
EOD;

						$i=1;
						foreach ($consignee_list as $cl){
							$tbl.="<tr>
							<td>$i</td>
							<td>$cl[CONSIGNEE_ID]</td>
							<td>$cl[CONSIGNEE_NAME]</td>
							<td>$cl[EXPIRED_DATE]</td>
							<td>$cl[BRANCH]</td>
							</tr>";
							$i++;
						}
					}
					
					$tbl .= <<<EOD
					</table>
					

					<!--<table align="left">
					<tr><td></td></tr>
					<tr><td><font size="10">Dengan  ini  menyatakan  bahwa  informasi  yang  kami  berikan  adalah  benar  adanya  dan  kami  setuju  serta  bersedia  terikat  sanggup  memenuhi  segala  ketentuan  dan  syarat-syarat  dalam
ketentuan  umum  Berlanggananan  Jasa  lainnya  di  Pelabuhan  Tanjung  Priok  yang  menjadi  satu  kesatuan  dengan  Formulir  Pendaftaran  ini,  termasuk  memberikan  informasi  atas  segala
perubahan yang ada (aspek administrasi/lokasi domisili) di perusahaan kami, pada kesempatan pertama. </font></td></tr>
					</table>

					<table align="left">
					<tr>
					<td width="50%"><b>Diisi Oleh Cabang Pelabuhan Tanjung Priok</b></td>
					<td width="50%" align="center"><b>Pemohon</b></td>
					</tr>
					</table>-->

				</div>
EOD;

				// add a page
				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 12);

				$style = array(
						'position' => '',
						'align' => 'C',
						'stretch' => false,
						'fitwidth' => true,
						'cellfitalign' => '',
						//'border' => true,
						'hpadding' => 'auto',
						'vpadding' => 'auto',
						'fgcolor' => array(0,0,0),
						'bgcolor' => false, //array(255,255,255),
						'text' => true,
						'font' => 'helvetica',
						'fontsize' => 12,
						'stretchtext' => 4
					);
				$pdf->writeHTML($tbl, true, false, false, false, '');

				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output("$customer[NAME].pdf", 'I');
	}

	////////////////////////////////////////////////////////////////////////////////////////////////
	//
	public function loadmodal($modal){
		return modal_loader($modal);
	}

	public function loadmodal_edit($modal, $type, $id){
		$method = 'view_detail_'.$type;
		$data['detail'] = $this->customer_registration_model->$method($id,'')->row_array();
		return modal_loader($modal, $data);
	}

	public function loadmodal_local($modal){
		$data["branch_id"] =  $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
		return view_loader('pages/register/modals/'.$modal, $data);
	}

	public function loadmodal_local_edit($modal, $type, $id){
		$method = 'view_detail_'.$type;
		$data['detail'] = $this->customer_registration_model->$method($id)->row_array();
		return view_loader('pages/register/modals/'.$modal, $data);
	}

	public function testarray(){

		$arr = array (
					'D' => '111',
					'C' => '121',
					'B' => '112',
					'A' => '222'
				);

		var_dump ($arr);

		echo '<br/>then<br/>';

		unset($arr['C']);

		var_dump ($arr);

		die;

	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Card Print Config
	public function limit_card(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$customer_id = $this->session->userdata('customerid_phd');
		$user_id = $this->session->userdata('uname_phd');
		$customer_name = $this->session->userdata('customername_phd');

        $data['user_id']=$user_id;
		$data['rec_card']=$this->container_model->getMaxCardPrint('REC');
		$data['del_card']=$this->container_model->getMaxCardPrint('DEL');
		$data['calbg_card']=$this->container_model->getMaxCardPrint('CALBG');
		$data['calag_card']=$this->container_model->getMaxCardPrint('CALAG');

		//var_dump($data);
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push('Set Print Card', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['title']= 'Set Print Card';

		$this->common_loader($data,'pages/container/limit_card');

	}

	public function update_limit_card(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$user_id = $this->session->userdata('uname_phd');
		if(isset($_POST['submit_form']))
		{

			$rec_limit=isset($_POST['rec']) ? htmLawed($_POST['rec']) : '';
			$del_limit=isset($_POST['del']) ? htmLawed($_POST['del']) : '';
			$calbg_limit=isset($_POST['calbg']) ? htmLawed($_POST['calbg']) : '';
			$calag_limit=isset($_POST['calag']) ? htmLawed($_POST['calag']) : '';

			injek($rec_limit);
			injek($del_limit);
			injek($calbg_limit);
			injek($calag_limit);

			$setup="";

			if($rec_limit=="true")
			{
				if($setup!="") $setup .=",";
				$setup .= "REC_LIMIT";
			}

			if($del_limit=="true")
			{
				if($setup!="") $setup .=",";
				$setup .= "DEL_LIMIT";
			}

			if($calbg_limit=="true")
			{
				if($setup!="") $setup .=",";
				$setup .= "CALBG_LIMIT";
			}

			if($calag_limit=="true")
			{
				if($setup!="") $setup .=",";
				$setup .= "CALAG_LIMIT";
			}

		$params = array(
			'USER_ID'   			=>	$user_id,
			'REC_CARD'				=>	$rec_limit,
			'DEL_CARD'				=>	$del_limit,
			'CALBG_CARD'			=>	$calbg_limit,
			'CALAG_CARD'	        =>	$calag_limit
		);

		if($this->container_model->update_card_limit($params))
		{
			echo 'OK';
		}
		else
		{
			echo 'NO';
		}
		}
	}
	
	
	//////////// blacklist
	
	public function blacklist_customer($search="",$otherterm=""){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Daftar Blacklist Pelanggan', '/register/blacklist');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['title']= 'Daftar Blacklist Pelanggan';

		$data['moduleuri'] = $this->uri->segment(1);
		$data['methoduri'] = $this->uri->segment(2);
		$data['currentpage'] = $this->currentpage;
		$data['offset'] = $this->offset;
		$data['limit'] = $this->limit;
		
		if($search=="empty") $search = "";
		$search = urldecode($search);
		$search = html_entity_decode($search);
		$data['searchterm'] = $search;
		$data['otherterm']  =$otherterm;

		$search = str_replace(array("'"),array("''"),$search);
		$data['table']		= $this->customer_registration_model->blacklist_list($search, $this->limit, $this->offset, $this->order, $this->sort,$otherterm);
		$data['pageinfo'] 	= $this->customer_registration_model->blacklist_list_info($search, $this->limit, $this->offset, $this->order, $this->sort,$otherterm);
		$data['opt_attribute']		= rsArrToOptArr( $this->options_model->getOptions('BLACKLISTATRIBUTE','ID')->result('array') );
		$this->common_loader($data,'pages/register/main_blacklist');
	}

	public function gotopageblacklist($page, $search = '', $term=''){
		$this->currentpage = $page;
		$this->offset = $this->offset + ($this->limit * ($page-1));
		$this->blacklist_customer($search, $term);
	}
	
	public function load_blacklist_customer(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		$this->breadcrumbs->push('Pelanggan', '/register');
		$this->breadcrumbs->push('Daftar Blacklist Pelanggan', '/register/blacklist');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['title']= 'Daftar Blacklist Pelanggan';

		$data['moduleuri'] = $this->uri->segment(1);
		$data['methoduri'] = $this->uri->segment(2);
		$data['currentpage'] = $this->currentpage;
		$data['offset'] = $this->offset;
		$data['limit'] = $this->limit;
		
		if($search=="empty") $search = "";
		$search = urldecode($search);
		$search = html_entity_decode($search);
		$data['searchterm'] = $search;
		$data['otherterm']  =$otherterm;

		$search = str_replace(array("'"),array("''"),$search);
		$data['table']		= $this->customer_registration_model->blacklist_list($search, $this->limit, $this->offset, $this->order, $this->sort,$otherterm);
		$data['pageinfo'] 	= $this->customer_registration_model->blacklist_list_info($search, $this->limit, $this->offset, $this->order, $this->sort,$otherterm);
		$data['opt_attribute']		= rsArrToOptArr( $this->options_model->getOptions('BLACKLISTATRIBUTE','ID')->result('array') );
		
		$this->load->view('pages/register/list_blacklist_t', $data);
	}
	
	public function submit_blacklist(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = array(
						'BLACKLIST_ATTRIBUTE'	=> htmLawed($_POST['attribute']),
						'BLACKLIST_VALUE'	=> htmLawed($_POST['value']),
						'NOTES'	=> htmLawed($_POST['notes']),
						'USERID' => htmLawed($this->session->userdata('uname_phd'))
					);

		return $this->customer_registration_model->create_blacklist($params);
	}
	
	public function update_blacklist(){

		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$params = array(
						'BLACKLIST_ATTRIBUTE'	=> htmLawed($_POST['attribute']),
						'BLACKLIST_VALUE'	=> htmLawed($_POST['value']),
						'NOTES'	=> htmLawed($_POST['notes']),
						'USERID' => htmLawed($this->session->userdata('uname_phd')),
						'BLACKLIST_ID'	=> htmLawed($_POST['blacklist_id']),
					);

		return $this->customer_registration_model->update_blacklist($params);
	}
	
	public function delete_blacklist(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$this->customer_registration_model->delete_blacklist(); 
		
		echo "Success Inactive";
	}	
	
	public function activate_blacklist($blacklist_id){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}

		$this->customer_registration_model->activate_blacklist($blacklist_id);
		
		echo "Success Active";
	}	
	////////////

	//////////// submit customer
	public function submit_customer($customer_id)
	{
		$this->customer_registration_model->submit_customer($customer_id);
		$this->customer_registration_model->add_audit_trail($customer_id,$_POST["notes"],$this->session->userdata('uname_phd'));
		$result=$this->customer_registration_model->check_submit($customer_id);
		
		echo $result;

	}
	
	//////////// approval customer
	
	public function customer_approval(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$this->breadcrumbs->push("Customer Approval Request", 'register/customer_approval');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Customer Approval Request";
		$this->common_loader($data,'pages/register/new_approval_request');
	}
	
	public function search_customer_approval($search="")
	{
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Customer ID</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>NPWP</th>",
			"<th width='100px'>Request Date</th>",
			"<th width='100px'>Cabang</th>",
			"<th width='100px'>Approval Type</th>",
			"<th width='100px'>Status</th>",
			"<th width='100px'>View</th>",
			"<th width='100px'>Approve</th>"
		 );

		$datagrid=$this->customer_registration_model->getListApproval($page, $limit, $search);
		$totallist=$this->customer_registration_model->getTotalListApproval($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		for($i=0;$i<count($datagrid);$i++)
		{
			$request_date = "<div class='clock_container' style='text-align:left'>
				<span style='display:block;margin-bottom:3px;'>".$datagrid[$i]['REQUEST_DATE']."</span>
				<span class='clock_now label label-info'></span>
				<span class='clock_req label label-info'></span>
				<span class='clock_approval label label-info'></span>
				<span class='req_date hidden_content'>"
					.$datagrid[$i]['REQUEST_DATE_STRING'].
				"</span>
				<span class='sysdate hidden_content'>"
					.$datagrid[$i]['SYSDATE_STRING'].
				"</span>
			</div>";

			switch($datagrid[$i]['TYPE_APPROVAL'])
			{
				case "C":
					$tipe_approval = "CREATE";
				break;
				case "U":
					$tipe_approval = "UPDATE";
				break;				
			}
			
			if($datagrid[$i]['STATUS_APPROVAL']=="W")
				$status_approval = '<span class="label label-warning">Waiting Approve</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="P")
				$status_approval = '<span class="label label-warning">Approve/Syn In Progress</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="A")
				$status_approval = '<span class="label label-success">Approved</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="R")
				$status_approval = '<span class="label label-danger" title="'.$x['REJECT_NOTES'].'">Reject</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="FP")
				$status_approval = '<span class="label label-danger"">Failed Sync</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="N")
				$status_approval = '<span class="label label-info">Draft</span>';
			else 
				$status_approval = $x['STATUS_APPROVAL'];
																
			$view_link='<a class=\'btn btn-primary\' href=\'javascript:void(0)\' onclick=\'clickDialog1("'.$datagrid[$i]['CUSTOMER_ID_T'].'")\'><i class=\'fa fa-eye\'></i></a>';
			$approve_link='<span id=\'BUTTONACTIVE-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'approveD("'.$datagrid[$i]['CUSTOMER_ID_T'].'")\'><img src="'.IMAGES_.'Button-Ok-icon24.png" title="approve document"/></a></span>';
			$reject_link='<span id=\'BUTTONREJECT-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'rejectD("'.$datagrid[$i]['CUSTOMER_ID_T'].'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a></span>';
			$sync_link = '<span id=\'BUTTONSYNC-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'syncD("'.$datagrid[$i]['CUSTOMER_ID_T'].'")\'><img src="'.IMAGES_.'Button-sync-icon24.png" title="sync document"/></a></span>';			
			
			if($datagrid[$i]['STATUS_APPROVAL'] == "P" || $datagrid[$i]['STATUS_APPROVAL'] == "FP"){
				$reject_link = "";
				$approve_link = "";
			}
			else {
				$sync_link = "";			
			}
			
			
			log_message('error','>>>>>>>>>>>>>>>>Approval_request'.$approve_link);
			$this->table->add_row(
				($limit*($page-1))+($i+1),
				$datagrid[$i]['CUSTOMER_ID_T'],
				$datagrid[$i]['ALT_NAME_T'],
				$datagrid[$i]['NPWP_T'],
				$request_date,
				$this->security->xss_clean($datagrid[$i]['NAMA_CABANG']),
				$tipe_approval,
				$status_approval,
				$view_link,
				$sync_link . $approve_link . $reject_link
			);
		}

		$this->load->view('pages/register/new_approval_request_grid',$data);
	}
	
	public function search_customer_activation()
	{
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search = $_POST['ambil'];
		
		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Customer ID</th>",
			"<th width='100px'>Nama Pelanggan</th>",
			"<th width='100px'>Cabang Pendaftaran Pertama</th>",
			"<th width='100px'>NPWP</th>",
			"<th width='100px'>Alasan</th>",
			"<th width='100px'>Waktu Aktivasi</th>"
		 );

		$datagrid=$this->customer_registration_model->getListActivation($page, $limit, $search);
		$totallist=$this->customer_registration_model->getTotalListActivation($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		for($i=0;$i<count($datagrid);$i++)
		{
			$request_date = "<div class='clock_container' style='text-align:left'>
				<span style='display:block;margin-bottom:3px;'>".$datagrid[$i]['REQUEST_DATE']."</span>
				<span class='clock_now label label-info'></span>
				<span class='clock_req label label-info'></span>
				<span class='clock_approval label label-info'></span>
				<span class='req_date hidden_content'>"
					.$datagrid[$i]['REQUEST_DATE_STRING'].
				"</span>
				<span class='sysdate hidden_content'>"
					.$datagrid[$i]['SYSDATE_STRING'].
				"</span>
			</div>";

			switch($datagrid[$i]['TYPE_APPROVAL'])
			{
				case "C":
					$tipe_approval = "CREATE";
				break;
				case "U":
					$tipe_approval = "UPDATE";
				break;				
			}
			
			if($datagrid[$i]['STATUS_APPROVAL']=="W")
				$status_approval = '<span class="label label-warning">Waiting Approve</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="P")
				$status_approval = '<span class="label label-warning">Approve/Syn In Progress</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="A")
				$status_approval = '<span class="label label-success">Approved</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="R")
				$status_approval = '<span class="label label-danger" title="'.$x['REJECT_NOTES'].'">Reject</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="FP")
				$status_approval = '<span class="label label-danger"">Failed Sync</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="N")
				$status_approval = '<span class="label label-info">Draft</span>';
			else 
				$status_approval = $x['STATUS_APPROVAL'];
																
			$view_link='<a class=\'btn btn-primary\' href=\'javascript:void(0)\' onclick=\'clickDialog1("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><i class=\'fa fa-eye\'></i></a>';
			$approve_link='<span id=\'BUTTONACTIVE-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'approveD("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><img src="'.IMAGES_.'Button-Ok-icon24.png" title="approve document"/></a></span>';
			$reject_link='<span id=\'BUTTONREJECT-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'rejectD("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a></span>';
			$sync_link = '<span id=\'BUTTONSYNC-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'syncD("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><img src="'.IMAGES_.'Button-sync-icon24.png" title="sync document"/></a></span>';			
			
			if($datagrid[$i]['STATUS_APPROVAL'] == "P" || $datagrid[$i]['STATUS_APPROVAL'] == "FP"){
				$reject_link = "";
				$approve_link = "";
			}
			else {
				$sync_link = "";			
			}
			
			
			log_message('error','>>>>>>>>>>>>>>>>Approval_request'.$approve_link);
			$this->table->add_row(
				($limit*($page-1))+($i+1),
				$datagrid[$i]['CUSTOMER_ID'],
				$datagrid[$i]['CUSTOMER_NAME'],
				$datagrid[$i]['NAME'],
				$datagrid[$i]['NPWP'],
				$datagrid[$i]['ALASAN'],
				$request_date
			);
		}

		$this->load->view('pages/register/new_activation_request_grid',$data);
	}
	
	
	public function search_customer_deactivation($search="")
	{
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Customer ID</th>",
			"<th width='100px'>Nama Pelanggan</th>",
			"<th width='100px'>Cabang Pendaftaran Pertama</th>",
			"<th width='100px'>NPWP</th>",
			"<th width='100px'>Alasan</th>"
			//"<th width='100px'>Sisa Hari</th>"
		 );

		$datagrid=$this->customer_registration_model->getListDeactivation($page, $limit, $search);
		$totallist=$this->customer_registration_model->getTotalListDeactivation($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		for($i=0;$i<count($datagrid);$i++)
		{
			$request_date = "<div class='clock_container' style='text-align:left'>
				<span style='display:block;margin-bottom:3px;'>".$datagrid[$i]['REQUEST_DATE']."</span>
				<span class='clock_now label label-info'></span>
				<span class='clock_req label label-info'></span>
				<span class='clock_approval label label-info'></span>
				<span class='req_date hidden_content'>"
					.$datagrid[$i]['REQUEST_DATE_STRING'].
				"</span>
				<span class='sysdate hidden_content'>"
					.$datagrid[$i]['SYSDATE_STRING'].
				"</span>
			</div>";

			switch($datagrid[$i]['TYPE_APPROVAL'])
			{
				case "C":
					$tipe_approval = "CREATE";
				break;
				case "U":
					$tipe_approval = "UPDATE";
				break;				
			}
			
			if($datagrid[$i]['STATUS_APPROVAL']=="W")
				$status_approval = '<span class="label label-warning">Waiting Approve</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="P")
				$status_approval = '<span class="label label-warning">Approve/Syn In Progress</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="A")
				$status_approval = '<span class="label label-success">Approved</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="R")
				$status_approval = '<span class="label label-danger" title="'.$x['REJECT_NOTES'].'">Reject</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="FP")
				$status_approval = '<span class="label label-danger"">Failed Sync</span>';
			else if($datagrid[$i]['STATUS_APPROVAL']=="N")
				$status_approval = '<span class="label label-info">Draft</span>';
			else 
				$status_approval = $x['STATUS_APPROVAL'];
																
			$view_link='<a class=\'btn btn-primary\' href=\'javascript:void(0)\' onclick=\'clickDialog1("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><i class=\'fa fa-eye\'></i></a>';
			$approve_link='<span id=\'BUTTONACTIVE-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'approveD("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><img src="'.IMAGES_.'Button-Ok-icon24.png" title="approve document"/></a></span>';
			$reject_link='<span id=\'BUTTONREJECT-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'rejectD("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a></span>';
			$sync_link = '<span id=\'BUTTONSYNC-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'syncD("'.$datagrid[$i]['CUSTOMER_ID'].'")\'><img src="'.IMAGES_.'Button-sync-icon24.png" title="sync document"/></a></span>';			
			
			if($datagrid[$i]['STATUS_APPROVAL'] == "P" || $datagrid[$i]['STATUS_APPROVAL'] == "FP"){
				$reject_link = "";
				$approve_link = "";
			}
			else {
				$sync_link = "";			
			}
			
			
			log_message('error','>>>>>>>>>>>>>>>>Approval_request'.$approve_link);
			$this->table->add_row(
				($limit*($page-1))+($i+1),
				$datagrid[$i]['CUSTOMER_ID'],
				$datagrid[$i]['CUSTOMER_NAME'],
				$datagrid[$i]['NAME'],
				$datagrid[$i]['NPWP'],
				$datagrid[$i]['ALASAN']
				//$request_date
			);
		}

		$this->load->view('pages/register/new_deactivation_request_grid',$data);
	}
	
	
	public function approve_customer($customer_id){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$registration_company_id=$this->customer_registration_model->get_registration_company_id($customer_id);
		
		$this->customer_registration_model->approve_customer(htmLawed($_POST['customer_id']));
		//$this->customer_registration_model->update_activation(htmLawed($_POST['customer_id']));
		$this->sync_all(htmLawed($_POST['customer_id']),$registration_company_id);
	}

	public function auto_approve_customer($customer_id){
		$registration_company_id=$this->customer_registration_model->get_registration_company_id($customer_id);
		
		$this->customer_registration_model->approve_customer(htmLawed($customer_id));
		$this->sync_all(htmLawed($customer_id),$registration_company_id);
	}
	
	public function sync_customer(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$registration_company_id=$this->customer_registration_model->get_registration_company_id(htmLawed($_POST['customer_id']));

		$this->customer_registration_model->approve_customer(htmLawed($_POST['customer_id']));
		$this->sync_all(htmLawed($_POST['customer_id']),$registration_company_id);
	}
	
	public function get_sync_type($customer_id){

		$x = 'U';

		if($this->customer_registration_model->get_reg_type_general($customer_id) == 'NEW'){
			if ($this->customer_registration_model->check_sync_insert_history($customer_id) == 0){
				$x = 'I';
			}
		}
		return $x;
	}

	public function check_sync($customer_id)
	{
		//simulate
		//for($i=0;$i<=1;$i++)//test 120 loop. 120*1sec = 120sec = 2 min
		//{
			$result=$this->customer_registration_model->check_sync($customer_id);

			$message_to_simop  = $result['ERROR_MESSAGE_SIMKEU'];
			$message_to_simkeu  = $result['ERROR_MESSAGE_SIMKAPAL'];
			$update_to_simop  = $result['STATUS_SIMKAPAL'];
			$update_to_simkeu = $result['STATUS_SIMKEU'];
			$status_iu = $result['STATUS_IU'];

			if($update_to_simop=='S' && $update_to_simkeu=='S')
			{
				$rcmsg = "Success";
			}
			else
			{
				$rcmsg = "Failed";
			}

			//if($update_to_simop!='P' && $update_to_simkeu!='P')//process done, break loop. error/success break the loop
				//$i=1000;
			//else
				//sleep(1);
		//}

		$rc = "S";
		echo $rc."^".$rcmsg."^".$message_to_simop."^".$message_to_simkeu."^".$update_to_simop."^".$update_to_simkeu."^".$status_iu;

	}
	
	public function sync_all($customer_id,$registration_company_id=""){

//		echo $this->populate_staging($customer_id);
		if($this->populate_staging($customer_id)){
			$rs = $this->syncSimopSimkeu($customer_id,$registration_company_id);
			echo $rs;
		}
		else{
			echo "Failed to populate staging table;";
			$this->customer_registration_model->update_customer_status($customer_id, "FP");
		}
	}

	public function populate_staging($customer_id){
		//call procedure to populate simop/simkeu staging
		$iu = $this->get_sync_type($customer_id);
		//echo $iu; die;

		return $this->customer_registration_model->sync_db($customer_id, $iu);
	}

	public function syncSimopSimkeu($id,$registration_company_id=""){
		$this->load->library("Nusoap_lib");

		$this->syncCFS($id);
		
		$in_data="
		<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id>". $id ."</id>
			</data>
		</root>";
		
		$service_name = "syncDataCabang";//priok dan non priok digabung
		
		if(!$this->nusoap_lib->call_wsdl(CUSTOMER_DATA,$service_name,array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->respons->update_to_simop!="S"&&$obj->data->respons->update_to_simkeu!="S")
			{
				echo "FAILED";
			}
			else
			{
				$this->syncCFS($id);
			}
			
			echo "\n";
			echo "\n";
			echo "\n";
			echo $obj->data->respons->message_to_simkeu." (SIMKEU)";
			echo "\n";
			echo $obj->data->respons->message_to_simop." (SIMOP)";					
			die;
		}

	}
	
	public function syncCFS($customer_id)
	{
        // xml post structure
		
		if($this->customer_registration_model->is_customer_cfs($customer_id))
		{
			$this->customer_registration_model->set_sync_cfs_only($customer_id);
		}

		$data_customer = $this->customer_registration_model->read_customer_cfs_all($customer_id);
		
		if ($data_customer['BILLING_CUSTOMER_ID']!="")
		{
			$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
			<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:UploadCustomerDatawsdl">
			<soapenv:Header/>
			<soapenv:Body>
			<urn:UploadCustomerData soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
				<fStream xsi:type="xsd:string"><![CDATA[<?xml version="1.0" encoding="UTF-8" ?>
					<DOCUMENT xmlns="UploadCustomerData.xsd">
					<CDM>
					<CUSTOMER_ID_SEQ>'.$data_customer['CUSTOMER_ID_SEQ'].'</CUSTOMER_ID_SEQ>
					<CUSTOMER_ID>'.$data_customer['BILLING_CUSTOMER_ID'].'</CUSTOMER_ID>
					<CUSTOMER_LABEL>'.$data_customer['CUSTOMER_LABEL'].'</CUSTOMER_LABEL>
					<NAME>'.$data_customer['NAME'].'</NAME>
					<ADDRESS>'.$data_customer['ADDRESS'].'</ADDRESS>
					<NPWP>'.$data_customer['NPWP'].'</NPWP>
					<EMAIL>'.$data_customer['EMAIL'].'</EMAIL>
					<WEBSITE>'.$data_customer['WEBSITE'].'</WEBSITE>
					<PHONE>'.$data_customer['PHONE'].'</PHONE>
					<COMPANY_TYPE>'.$data_customer['COMPANY_TYPE'].'</COMPANY_TYPE>
					<ALT_NAME>'.$data_customer['ALT_NAME'].'</ALT_NAME>
					<DEED_ESTABLISHMENT>'.$data_customer['XX'].'</DEED_ESTABLISHMENT>
					<CUSTOMER_GROUP>'.$data_customer['CUSTOMER_GROUP'].'</CUSTOMER_GROUP>
					<CUSTOMER_TYPE>'.$data_customer['CUSTOMER_TYPE'].'</CUSTOMER_TYPE>
					<SVC_VESSEL>'.$data_customer['SVC_VESSEL'].'</SVC_VESSEL>
					<SVC_CARGO>'.$data_customer['SVC_CARGO'].'</SVC_CARGO>
					<SVC_CONTAINER>'.$data_customer['SVC_CONTAINER'].'</SVC_CONTAINER>
					<SVC_MISC>'.$data_customer['SVC_MISC'].'</SVC_MISC>
					<IS_SUBSIDIARY>'.$data_customer['IS_SUBSIDIARY'].'</IS_SUBSIDIARY>
					<HOLDING_NAME>'.$data_customer['HOLDING_NAME'].'</HOLDING_NAME>
					<EMPLOYEE_COUNT>'.$data_customer['EMPLOYEE_COUNT'].'</EMPLOYEE_COUNT>
					<IS_MAIN_BRANCH>'.$data_customer['IS_MAIN_BRANCH'].'</IS_MAIN_BRANCH>
					<PARTNERSHIP_DATE></PARTNERSHIP_DATE>
					<PROVINCE>'.$data_customer['PROVINCE'].'</PROVINCE>
					<CITY>'.$data_customer['CITY'].'</CITY>
					<CITY_TYPE>'.$data_customer['CITY_TYPE'].'</CITY_TYPE>
					<KECAMATAN>'.$data_customer['KECAMATAN'].'</KECAMATAN>
					<KELURAHAN>'.$data_customer['KELURAHAN'].'</KELURAHAN>
					<POSTAL_CODE>'.$data_customer['POSTAL_CODE'].'</POSTAL_CODE>
					<FAX>'.$data_customer['FAX'].'</FAX>
					<PARENT_ID>'.$data_customer['PARENT_ID'].'</PARENT_ID>
					<CREATE_BY>'.$data_customer['CREATE_BY'].'</CREATE_BY>
					<CREATE_DATE>'.$data_customer['XX'].'</CREATE_DATE>
					<CREATE_VIA>'.$data_customer['CREATE_VIA'].'</CREATE_VIA>
					<CREATE_IP>'.$data_customer['CREATE_IP'].'</CREATE_IP>
					<EDIT_BY>'.$data_customer['EDIT_BY'].'</EDIT_BY>
					<EDIT_DATE>'.$data_customer['XX'].'</EDIT_DATE>
					<EDIT_VIA>'.$data_customer['EDIT_VIA'].'</EDIT_VIA>
					<EDIT_IP>'.$data_customer['EDIT_IP'].'</EDIT_IP>
					<IS_SHIPPING_AGENT>'.$data_customer['IS_SHIPPING_AGENT'].'</IS_SHIPPING_AGENT>
					<IS_SHIPPING_LINE>'.$data_customer['IS_SHIPPING_LINE'].'</IS_SHIPPING_LINE>
					<REG_TYPE>'.$data_customer['REG_TYPE'].'</REG_TYPE>
					<IS_PBM>'.$data_customer['IS_PBM'].'</IS_PBM>
					<IS_FF>'.$data_customer['IS_FF'].'</IS_FF>
					<IS_EMKL>'.$data_customer['IS_EMKL'].'</IS_EMKL>
					<IS_PPJK>'.$data_customer['IS_PPJK'].'</IS_PPJK>
					<IS_CONSIGNEE>'.$data_customer['IS_CONSIGNEE'].'</IS_CONSIGNEE>
					<REGISTRATION_COMPANY_ID>'.$data_customer['REGISTRATION_COMPANY_ID'].'</REGISTRATION_COMPANY_ID>
					<HEADQUARTERS_ID>'.$data_customer['HEADQUARTERS_ID'].'</HEADQUARTERS_ID>
					<HEADQUARTERS_NAME>'.$data_customer['HEADQUARTERS_NAME'].'</HEADQUARTERS_NAME>
					<STATUS_APPROVAL>'.$data_customer['STATUS_APPROVAL'].'</STATUS_APPROVAL>
					<TYPE_APPROVAL>'.$data_customer['TYPE_APPROVAL'].'</TYPE_APPROVAL>
					<STATUS_CUSTOMER>'.$data_customer['STATUS_CUSTOMER'].'</STATUS_CUSTOMER>
					<CONFIRM_DATE>'.$data_customer['XX'].'</CONFIRM_DATE>
					<APPROVE_DATE>'.$data_customer['XX'].'</APPROVE_DATE>
					<ACCEPTANCE_DOC>'.$data_customer['ACCEPTANCE_DOC'].'</ACCEPTANCE_DOC>
					<ACCEPTANCE_DOC_DATE>'.$data_customer['XX'].'</ACCEPTANCE_DOC_DATE>
					<REJECT_NOTES>'.$data_customer['REJECT_NOTES'].'</REJECT_NOTES>
					<REJECT_USER>'.$data_customer['REJECT_USER'].'</REJECT_USER>
					<REJECT_DATE>'.$data_customer['XX'].'</REJECT_DATE>
					<BRANCH_SIGN>'.$data_customer['BRANCH_SIGN'].'</BRANCH_SIGN>
					<PASSPORT>'.$data_customer['PASSPORT'].'</PASSPORT>
					<CITIZENSHIP>'.$data_customer['CITIZENSHIP'].'</CITIZENSHIP>
					</CDM>
					</DOCUMENT>]]>
				</fStream>
			 <Type xsi:type="xsd:string">insert</Type>
		  </urn:UploadCustomerData>
	   </soapenv:Body>
	</soapenv:Envelope>';   // data from the form, e.g. some ID number

			   $headers = array(
							"Content-type: text/xml;charset=\"utf-8\"",
							"Accept: text/xml",
							"Cache-Control: no-cache",
							"Pragma: no-cache",
							"SOAPAction: http://connecting.website.com/WSDL_Service/GetPrice", 
							"Content-length: ".strlen($xml_post_string),
						); //SOAPAction: your op URL

				// PHP cURL  for https connection with auth
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
				curl_setopt($ch, CURLOPT_URL, CFS_API);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

				// converting
				$response = curl_exec($ch); 
				curl_close($ch);

				// converting
				$response1 = str_replace("<soap:Body>","",$response);
				$response2 = str_replace("</soap:Body>","",$response1);
				
				//var_dump($response2);
				$clean_xml = str_ireplace('SOAP-ENV:', 'SOAP:', $response2);
				$clean_xml = str_ireplace('ns1:', '', $clean_xml);
				//var_dump($clean_xml);
				$xml = simplexml_load_string($clean_xml);
				//var_dump($xml);
				//echo $xml->Body->UploadCustomerDataResponse->UploadCustomerDataResult;
				
				if($xml->Body->UploadCustomerDataResponse->UploadCustomerDataResult=="Berhasil insert data")
				{
					echo "\n";
					echo $xml->Body->UploadCustomerDataResponse->UploadCustomerDataResult." (CFS)";
					
					$this->customer_registration_model->set_success_sync_cfs($customer_id);
				}
				else
				{
					echo "\n";
					echo $xml->Body->UploadCustomerDataResponse->UploadCustomerDataResult." (CFS)";
				}
		}
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////
	public function sign_customer($customer_id)
	{
		$data = implode(",",$_POST['data']);
		
		$this->customer_registration_model->sign_customer($customer_id,$data);
		echo "Success";
	}

	//moved to Analytics
	//public function customer_rank()
	
	//moved to Customer_profile
	//public function customer_profile($customer_iid)  

	
//reject request
	public function reject_request()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$cust_num=$_POST['cust_num'];
		$reject_notes=$_POST['REJECT_NOTES'];

		echo $this->customer_registration_model->rejectRequest($cust_num,$reject_notes,$this->session->userdata('uname_phd'));
	}
	
	public function view_request($customer_id)
	{
		
		$data['customer_id']=$customer_id;
		$data['register']=$this->customer_registration_model->read_customer_all($customer_id);
		$data['customer_hq']=$this->customer_registration_model->read_customer_hq($customer_id);
		$data['customer_branch']=$this->customer_registration_model->read_customer_branch($customer_id);
		$data['customer_child']=$this->customer_registration_model->read_customer_child($customer_id);
		
		$data['billing']=$this->customer_registration_model->read_billing_account_all($customer_id);
		$data['bank']=$this->customer_registration_model->read_bank_all($customer_id);
		$data['am']=$this->customer_registration_model->read_am_all($customer_id);
		$data['ceo']=$this->customer_registration_model->read_ceo_all($customer_id);
		$data['bod']=$this->customer_registration_model->read_bod_all($customer_id);
		$data['pic']=$this->customer_registration_model->read_pic_all($customer_id);
		
		$data['submit_notes']=$this->customer_registration_model->get_submit_notes($customer_id);
		
		if($data['register']['IS_SHIPPING_AGENT_T']=="Y")
		{
			$data['custom_name']="Shipping Agent";
			$data['custom']=$this->customer_registration_model->shiping_agent_all($customer_id);
			$data['custom_field_check'] = array("THREE_PARTIED_CODE"=>"Three Partied Code",
												"SIAPDEL"=>"SI ADPEL",
												"SIAPDEL_EXPIRE_DATE"=>"Masa Berlaku ADPEL", 
												"INSA_MEMBER_NO"=>"Nomor Anggota INSA", 
												"SKPT"=>"SKPT", 
												"SIUPAL"=>"SIUPAL", 
												"SIUPAL_PUBLISH_DATE"=>"Tanggal Terbit SIUPAL", 
												"SIUPAL_EXPIRE_DATE"=>"Masa Berlaku SIUPAL", 
												"SIOPSUS"=>"No Siopsus", 
												"SIOPSUS_PUBLISH_DATE"=>"Tanggal Terbit Siopsus", 
												"SIOPSUS_EXPIRE_DATE"=>"Masa Berlaku Siopsus", 
												"ROUTE"=>"Jenis Trayek:Tramper",  
												"ROUTE_LINER"=>"Jenis Trayek:Liner"
												);
		}
		else if($data['register']['IS_PBM_T']=="Y")
		{
			$data['custom_name']="PBM";
			$data['custom']=$this->customer_registration_model->pbm_all($customer_id);
			$data['custom_field_check'] = array("THREE_PARTIED_CODE"=>"Three Partied Code", 
												"SIUPBM"=>"Surat Izin Usaha Perusahaan Bongkar Muat (SIUPBM)", 
												"SIUPBM_PUBLISH_DATE"=>"Tanggal Terbit Surat Izin Usaha Perusahaan Bongkar Muat (SIUPBM)", 
												"APBMI"=>"Asosiasi Perusahaan Bongkar Muat Indonesia(APBMI)"
												);
		}
		else if($data['register']['IS_EMKL_T']=="Y")
		{
			$data['custom_name']="EMKL";
			$data['custom']=$this->customer_registration_model->non_pbm_all($customer_id);
			$data['custom_field_check'] = array("THREE_PARTIED_CODE"=>"Three Partied Code",
												"SIUJPT"=>"Surat Izin Jasa Pengurusan Transportasi (SIUJPT)", 
												"SIUJPT_EXPIRED_DATE"=>"Tanggal Terbit Surat Izin Jasa Pengurusan Transportasi (SIUJPT)", 
												"TDG"=>"Tanda Daftar Gudang (TDG)", 
												"ALFI"=>"Asosiasi Logistik & Forwarding Indonesia (ALFI)"
												);
		}
		else if($data['register']['IS_PPJK_T']=="Y")
		{
			$data['custom_name']="PPJK";
			$data['custom']=$this->customer_registration_model->non_pbm_all($customer_id);
			$data['custom_field_check'] = array("THREE_PARTIED_CODE"=>"Three Partied Code",
												"SIUJPT"=>"Surat Izin Jasa Pengurusan Transportasi (SIUJPT)", 
												"SIUJPT_EXPIRED_DATE"=>"Tanggal Terbit Surat Izin Jasa Pengurusan Transportasi (SIUJPT)", 
												"TDG"=>"Tanda Daftar Gudang (TDG)", 
												"ALFI"=>"Asosiasi Logistik & Forwarding Indonesia (ALFI)"
												);
		}

		$data['ppjk_consignee']=$this->customer_registration_model->ppjk_consignee_all($customer_id);
		
		$this->load->view('pages/register/approval_request_viewreq',$data);
	}

//-------TAG

	private $order = null;
	private $sort = 'DESC';
	private $limit = 10;
	private $offset = 0;
	private $currentpage = 1;
//-------TAG

}
