<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class rbm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		
		require_once(APPPATH.'libraries/mime_type_lib.php');
        require_once(APPPATH.'libraries/htmLawed.php');



        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		/*if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {

			redirect(ROOT.'mainpage', 'refresh');
		}*/
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


	public function index() 
	{

		$this->redirect();

		$search_data_rbm = isset($_POST['search']) ? htmLawed($_POST['search']) : '';

		// $user_id = $this->session->userdata('customerid_phd');
		// $username = $this->session->userdata('uname_phd');
		$access_login = $this->session->userdata('group_phd');
		// $asdad = $this->session->userdata('userid_simop');
		// $hghghgh = $this->session->userdata('sub_group_phd');
		// $customer_id = $this->session->userdata('customerid_phd');
		// $submitter_customer_id = $this->session->userdata('customeridppjk_phd');//diubah ke submitter-case ppjk

		// echo $username .'<br>';
		// echo $jasdjsada .'<br>';
		// echo $asdad .'<br>';
		// echo $hghghgh .'<br>';
		// echo $customer_id .'<br>';
		// echo $submitter_customer_id .'<br>';
		
		

		$this->breadcrumbs->push("Realisasi Bongkar Muat", 'rmb/rbm');
		$this->breadcrumbs->unshift('Home', '/');
		$data = array(
			'title'				=> "Realisasi Bongkar Muat",
			'breadcrumbs' 		=> $this->breadcrumbs->show(),
			'access_login'		=> $access_login
		);

		
		// $data['breadcrumbs'] = $this->breadcrumbs->show();
		// $data['title']= "Realisasi Bongkar Muat";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');
		
		$this->common_loader($data,'pages/container/rbm');
		
	}


	public function load_data_rbm()
	{
			
		// print_r($this->session->userdata);
		// die();
		$this->redirect();

		$search_data_rbm = isset($_POST['search']) ? htmLawed($_POST['search']) : '';
		$access_login = $this->session->userdata('group_phd');
		
		if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
			$actions = '';
			$result = $this->container_model->getDataRbm($search_data_rbm);


		}
		elseif ($access_login == 'd') { // customer 
			$customer_id = $this->session->userdata('customerid_phd');

			$actions = "<th width=\'5%\'>ACCEPT/REJECT</th>";
			$result = $this->container_model->getDataRbmByCustomer($search_data_rbm,$customer_id);
			// print_r($result);
			// die();

		}

		//create table
		$this->table->set_heading(
			"<th width='5%'>NO</th>",
			"<th width='5%'>REQUEST NUMBER</th>",
			"<th width='20%'>VESSEL / VOYAGE</th>",
			"<th width='20%'>KATEGORI</th>",
			"<th width='5%'>PELABUHAN/TERM.</th>",
			"<th width='10%'>STATUS</th>",
			"<th width='5%'>VIEW</th>",
			"<th width='10%'>PRINT RBM</th>",
			"<th width='5%'>PRANOTA</th>",
			"<th width='5%'>NOTA</th>",
			$actions
		);
			
	
			/*if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
				$act_user = "";
			}
			elseif ($access_login == 'd') { // customer 
				$act_user = $baca;
			}
			*/

		// print_r($result);
		// die();

		$i = 1;
		foreach ($result as $row)
		{
			// $approve_link ='<span class="btn" style="cursor:default"><img src="'.IMAGES_.'button_check_grey.png" title="check semua document untuk approve"/></span>';
			
			$print_rbm = '<a href="#" class="btn btn-default" title="Print RBM"><i class="fa fa-print"></i></a>';
			$print_rbm2 = '<a href="#" class="btn btn-default" title="Print RBM New"><i class="fa fa-print"></i></a>';
			$pranota = '<a  href="#" class="btn btn-default" title="Pranota"><i class="fa fa-print"></i></a>';
			$nota = '';
			$accept_and_reject = '<a style="color: #8bc34a;"><i class="fa fa-check"></i></a> | <a><i class="fa fa-times"></i></a>';

			// if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
			// 	$approve_link = '';
			// 	$reject_link = '';
			// }
			// elseif ($access_login == 'd') { // customer 
				$approve_link = '<span id="'.$row['REQUEST_ID'].'" class="approve_rbm"><a href="javascript:void(0)" class="btn" title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a></span>';
				$reject_link = '<a href="#" class="btn" onclick=\'rejectD("'.$row['REQUEST_ID'].'", "'.$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'].'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
			// }


			if ($row['STATUS_REQ'] == 'N') 
			{
				$print_rbm = '<a href="rbm/download_rbm/'.$row['REQUEST_ID'].'" class="btn btn-warning" target="_blank" title="Print RBM"><i class="fa fa-print"></i></a>';
				$print_rbm2 = '<a href="rbm/download_rbm_new/'.$row['REQUEST_ID'].'" class="btn btn-danger" target="_blank" title="Print RBM New"><i class="fa fa-print"></i></a>';
				$pranota = '<a  href="rbm/download_pranota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-success" target="_blank" title="Pranota"><i class="fa fa-print"></i></a>';
				$status_rbm = '<span class="label label-info">New</span>';

				$reload = '';
				$view_link = '';
				if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
					$act_user = '';
				}
				elseif ($access_login == 'd') { // customer 
					$act_user = $approve_link . $reject_link;
				}
			} 
			elseif ($row['STATUS_REQ'] == 'W') 
			{
				$print_rbm = '<a href="rbm/download_rbm/'.$row['REQUEST_ID'].'" class="btn btn-warning" target="_blank" title="Print RBM"><i class="fa fa-print"></i></a>';
				$print_rbm2 = '<a href="rbm/download_rbm_new/'.$row['REQUEST_ID'].'" class="btn btn-danger" target="_blank" title="Print RBM New"><i class="fa fa-print"></i></a>';
				$pranota = '<a  href="rbm/download_pranota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-success" target="_blank" title="Pranota"><i class="fa fa-print"></i></a>';
				$status_rbm = '<span style="font-weight: bold; color: #ffc107;">Waiting Approval</span>';
				$reload = '';
				$view_link = '<a class="btn btn-primary" onclick=\'viewRejectD("'.$row['REQUEST_ID'].'", "'.$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'].'", "'.$row['REJECT_NOTES'].'")\'><i class="fa fa-eye"></i></a>';
				if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
					$act_user = '';
				}
				elseif ($access_login == 'd') { // customer 
					$act_user = $approve_link . $reject_link;
				}

			}
			elseif ($row['STATUS_REQ'] == 'AP') 
			{
				$act_user = '';
				// Button print, etc.
				$print_rbm = '<a href="rbm/download_rbm/'.$row['REQUEST_ID'].'" class="btn btn-warning" target="_blank" title="Print RBM"><i class="fa fa-print"></i></a>';
				$print_rbm2 = '<a href="rbm/download_rbm_new/'.$row['REQUEST_ID'].'" class="btn btn-danger" target="_blank" title="Print RBM New"><i class="fa fa-print"></i></a>';
				$pranota = '<a  href="rbm/download_pranota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-success" target="_blank" title="Pranota"><i class="fa fa-print"></i></a>';
				// $nota = '<a href="rbm/download_nota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-info" target="_blank" title="Nota"><i class="fa fa-print"></i></a>';
				$status_rbm = '<span class="label label-success">Approved</span>';
				$reload = '';
				$view_link = '';
				$approve_link = '';
				$reject_link = '';
			}
			elseif ($row['STATUS_REQ'] == 'A') 
			{
				$act_user = '';
				// Button print, etc.
				$print_rbm = '<a href="rbm/download_rbm/'.$row['REQUEST_ID'].'" class="btn btn-warning" target="_blank" title="Print RBM"><i class="fa fa-print"></i></a>';
				$print_rbm2 = '<a href="rbm/download_rbm_new/'.$row['REQUEST_ID'].'" class="btn btn-danger" target="_blank" title="Print RBM New"><i class="fa fa-print"></i></a>';
				$pranota = '<a  href="rbm/download_pranota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-success" target="_blank" title="Pranota"><i class="fa fa-print"></i></a>';
				$nota = '<a href="rbm/download_nota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-info" target="_blank" title="Nota"><i class="fa fa-print"></i></a>';
				$status_rbm = '<span class="label label-success">Approved</span>';
				$reload = '';
				$view_link = '';
				$approve_link = '';
				$reject_link = '';
			}
			elseif ($row['STATUS_REQ'] == 'R') 
			{
				$print_rbm = '<a href="rbm/download_rbm/'.$row['REQUEST_ID'].'" class="btn btn-warning" target="_blank" title="Print RBM"><i class="fa fa-print"></i></a>';
				$print_rbm2 = '<a href="rbm/download_rbm_new/'.$row['REQUEST_ID'].'" class="btn btn-danger" target="_blank" title="Print RBM New"><i class="fa fa-print"></i></a>';
				$pranota = '<a  href="rbm/download_pranota_rbm/'.$row['REQUEST_ID'].'" class="btn btn-success" target="_blank" title="Pranota"><i class="fa fa-print"></i></a>';
				$status_rbm = '<span class="label label-warning">Waiting Confrim</span>';
				$reload = '';
				$view_link = '<a class="btn btn-primary" onclick=\'viewRejectD("'.$row['REQUEST_ID'].'", "'.$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'].'", "'.$row['REJECT_NOTES'].'")\'><i class="fa fa-eye"></i></a>';

			}
			elseif ($row['STATUS_REQ'] == 'AR') 
			{

				
				$status_rbm = '<span class="label label-danger">Rejected</span>';
				$approve_link = '';
				$reject_link = '';
				$view_link = '<a class="btn btn-primary" onclick=\'viewRejectD("'.$row['REQUEST_ID'].'", "'.$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'].'", "'.$row['REJECT_NOTES'].'")\'><i class="fa fa-eye"></i></a>';
			}

			if ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDPLM-PLMD') // PALEMBANG  DOMESTIK
			{
				$terminal = 'Palembang - Domestik';
			}
			elseif ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDTLB-TLBD') // TELUKBAYUR  DOMESTIK
			{
				$terminal = 'Teluk Byur - Domestik';
			}
			elseif ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDPNK-PNKD') // PONTIANAK  DOMESTIK
			{
				$terminal = 'Pontianak - Domestik'; 
			}
			elseif ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDDJB-DJBD') // JAMBI  DOMESTIK
			{
				$terminal = 'Jambi - Domestik';
			}


			if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
				// $sdfsd = '';
				$this->table->add_row(
					$i++,
					$row['REQUEST_ID'],
					$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'],
					$row['KATEGORI'],
					$terminal,
					array('data' => $status_rbm, 'align' => 'center'),
					$view_link,
					$print_rbm . $print_rbm2,
					$pranota,
					$nota
				);
			}
			elseif ($access_login == 'd') { // customer 
				// $sdfsd = array('data' => $act_user, 'align' => 'center');
				$this->table->add_row(
					$i++,
					$row['REQUEST_ID'],
					$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'],
					$row['KATEGORI'],
					$terminal,
					array('data' => $status_rbm, 'align' => 'center'),
					$view_link,
					$print_rbm . $print_rbm2,
					$pranota,
					$nota,
					array('data' => $act_user, 'align' => 'center')
				);
			}
		}

		// $data['result_history']	= $this->container_model->notesHistoryRbm($req_num);

		$this->load->view('pages/container/search_rbm', $data);
	}


	public function view_rbm($req_id)
	{
		$data['result_data_rbm'] = $this->container_model->getDataRbmByID($req_id);
		$data['rejection_history'] = $this->container_model->notesHistoryRbm($req_id);
		
		echo json_encode($data);
	}


	public function auto_vessel_delivery(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["term"])));

		injek($term);

		$port			= explode("-",$this->security->xss_clean(htmlentities($_GET["port"])));
		$stack = array();

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT,"getVesselVoyage",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);
			// die();
			$obj = json_decode($result);

			//echo $this->db->last_query();
			if($obj->data->vessel)
			{
				for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$temp;
					$temp['VESSEL']=$obj->data->vessel[$i]->vessel_name;
					$temp['VOYAGE_IN']=$obj->data->vessel[$i]->voyage_in;
					$temp['VOYAGE_OUT']=$obj->data->vessel[$i]->voyage_out;
					$temp['VOYAGE']=$obj->data->vessel[$i]->voyage;
					$temp['ETA']=$obj->data->vessel[$i]->eta;
					$temp['ETB']=$obj->data->vessel[$i]->etb;
					$temp['ETD']=$obj->data->vessel[$i]->etd;
					$temp['ATA']=$obj->data->vessel[$i]->ata;
					$temp['ATB']=$obj->data->vessel[$i]->atb;
					$temp['ATD']=$obj->data->vessel[$i]->atd;
					$temp['ID_VSB_VOYAGE']=$obj->data->vessel[$i]->id_vsb_voyage;
					$temp['VESSEL_CODE']=$obj->data->vessel[$i]->vessel_code;
					$temp['CALL_SIGN']=$obj->data->vessel[$i]->call_sign;
					$temp['DATE_DISCHARGE']=$obj->data->vessel[$i]->date_discharge;
					$temp['NO_BOOKING']=$obj->data->vessel[$i]->no_booking;
					array_push($stack, $temp);
				}
			}
		}

		$data['vessel'] = $stack;
			$this->load->library("table");
			$this->table->set_heading(
					'Vessel',
					'Voyage In',
					'Voyage Out',
					'ETA',
					'ETD',
					'Pilih'
				);

			$i=0;
			foreach ($stack as $t){
				$this->table->add_row(
					$t['VESSEL']." (".$t['NO_BOOKING'].")",
					$t['VOYAGE_IN'],
					$t['VOYAGE_OUT'],
					$t['ETA'],
					$t['ETD'],
					 '<a data-dismiss="modal" style="cursor:pointer" class="table-link click_detail bank_detail" onclick="complete(\''.$t['VESSEL'].'\',\''.$t['VOYAGE_IN'].'\',\''.$t['VOYAGE_OUT'].'\',\''.$t['VOYAGE'].'\',\''.$t['ID_VSB_VOYAGE'].'\',\''.$t['VESSEL_CODE'].'\',\''.$t['CALL_SIGN'].'\',
					 \''.$t['DATE_DISCHARGE'].'\',\''.$t['ETD'].'\',\''.$t['ETA'].'\',\''.$t['NO_BOOKING'].'\')"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				);
					$i++;
			}

			$this->load->view('pages/container/search_vessel_modal',$data);
	}


	public function add_rbm()
	{
		$this->redirect();

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));

		$this->breadcrumbs->push("Create New RBM Request", 'rmb/rbm');
		$this->breadcrumbs->unshift('Home','Realisasi Bongkar Muat','Realisasi Bongkar Muat', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Create Realisasi Bongkar Muat";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');


		$this->common_loader($data,'pages/container/create_rbm');
	}


	public function create_request_rbm() 
	{
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_rbm-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$type_req='NEW'; //NEW for Delivery, EXT for Extention
		$sp2p_number=""; //NULL for Delivery, NUMBER for Extention
		$old_req=""; //NULL for Delivery, OLD req for Extention
		$no_ukk=$_POST["ID_VSB_VOYAGE"];
		$vessel=$_POST["VESSEL"];
		$eta=$_POST["ETA"];
		$etd=$_POST["ETD"];
		// $vessel_code=$_POST["VESSEL_CODE"];
		// $call_sign=$_POST["CALL_SIGN"];
		$voyage_in=$_POST["VOYAGE_IN"];
		$voyage_out=$_POST["VOYAGE_OUT"];
		$customer_id=$_POST["CUSTOMER_ID"];;
		$submitter_customer_id = $this->session->userdata('customeridppjk_phd');
		$customer_name=$_POST["CUSTOMER_NAME"];
		$address=$_POST["ADDRESS"];;
		$npwp=$_POST["NPWP"];
		$status="N";
		$no_do=$_POST["NO_DO"];
		$date_do=$_POST["DO_DATE"];
		$sppb_type=$_POST["SPPB_TYPE"];
		$no_sppb=$_POST["NO_SPPB"];
		$date_sppb=$_POST["DATE_SPPB"];
		$no_sp_custom=$_POST["NO_SP_CUSTOM"];
		$date_sp_custom=$_POST["DATE_SP_CUSTOM"];
		$no_bl=$_POST["NO_BL"];
		$date_delivery=$_POST["DELIVERY_DATE"];
		$date_ext="";
		$date_old_del="";
		$date_discharge=$_POST["DATE_DISCHARGE"];
		$date_request=""; //nanti akan sysdate
		$id_user=$this->session->userdata('userid_simop');
		$id_user_eservice=$this->session->userdata('uname_phd');
		$quantity=""; //akan diupdate saat detail
		$remark="";
		$is_edit="";
		// $delivery_type=$_POST["DELIVERY_TYPE"];
		$nobook=$_POST["NO_BOOKING"];
		$ship_line=$_POST["ship_line"];
		$delivery_via=$_POST["DELIVERY_VIA"];

		$operator=$_POST["OPERATOR"];
		//declare form validation pemesanan pengeluaran default
		$config = array(
			array(
				'field' => 'TERMINAL',
				'label' => "Terminal",
				'rules' => 'required'
			),
			// array(
			// 	'field' => 'ID_VSB_VOYAGE',
			// 	'label' => "Vessel",
			// 	'rules' => 'required'
			// ),
			// array(
			// 	'field' => 'VESSEL_CODE',
			// 	'label' => "Vessel",
			// 	'rules' => 'required'
			// ),
			array(
				'field' => 'VOYAGE_IN',
				'label' => "Voyage In",
				'rules' => 'required'
			),
			array(
				'field' => 'VOYAGE_OUT',
				'label' => "Voyage Out",
				'rules' => 'required'
			),
			// array(
			// 	'field' => 'DELIVERY_TYPE',
			// 	'label' => "Delivery Type",
			// 	'rules' => 'required'
			// ),
			// array(
			// 	'field' => 'DELIVERY_DATE',
			// 	'label' => "Delivery Date",
			// 	'rules' => 'required'
			// )
		);

		//declare form validation pemesanan pengeluaran internasional
		if($no_sppb<>''){
			$internasional = array(
				array(
					'field' => 'NO_SPPB',
					'label' => "SPPB Number",
					'rules' => 'required'
				),
				array(
					'field' => 'DATE_SPPB',
					'label' => "SPPB Date",
					'rules' => 'required'
				)
			);			
		}
		else if($no_sp_custom<>'')
		{
			$internasional = array(
				array(
					'field' => 'NO_SP_CUSTOM',
					'label' => "SP Custom Number",
					'rules' => 'required'
				),
				array(
					'field' => 'DATE_SP_CUSTOM',
					'label' => "SP Custom Date",
					'rules' => 'required'
				)
			);		
			
		}
		

		if($this->input->post()) {
			if($port[1] == 'T3I') {
				foreach($internasional as $config_internasional) {
					array_push($config, $config_internasional);
				}
			}
			
			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran
			if($this->form_validation->run() == false) {
				log_message('debug', '>>> --0.1-- salah');
				echo 'salah';
			} else {
				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
				$address = base64_encode($address);
				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>".$port[0]."</port_code>
						<terminal_code>".$port[1]."</terminal_code>
						<type_req>$type_req</type_req>
						<sp2p_number>$sp2p_number</sp2p_number>
						<old_req>$old_req</old_req>
						<no_ukk>$no_ukk</no_ukk>
						<vessel>$vessel</vessel>
						<voyage_in>$voyage_in</voyage_in>
						<voyage_out>$voyage_out</voyage_out>
						<eta>$eta</eta>
						<etd>$etd</etd>
						<customer_id>$customer_id</customer_id>
						<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
						<customer_name>$customer_name</customer_name>
						<address>$address</address>
						<npwp>$npwp</npwp>
						<status>$status</status>
						<no_do>$no_do</no_do>
						<date_do>$date_do</date_do>
						<sppb_type>$sppb_type</sppb_type>
						<no_sppb>$no_sppb</no_sppb>
						<date_sppb>$date_sppb</date_sppb>
						<no_sp_custom>$no_sp_custom</no_sp_custom>
						<date_sp_custom>$date_sp_custom</date_sp_custom>
						<no_bl>$no_bl</no_bl>
						<date_delivery>$date_delivery</date_delivery>
						<date_ext>$date_ext</date_ext>
						<date_old_del>$date_old_del</date_old_del>
						<date_discharge>$date_discharge</date_discharge>
						<date_request>$date_request</date_request>
						<id_user>$id_user</id_user>
						<id_user_eservice>$id_user_eservice</id_user_eservice>
						<quantity>$quantity</quantity>
						<remark>$remark</remark>
						<is_edit>$is_edit</is_edit>
						<no_booking>$nobook</no_booking>
						<delivery_via>$delivery_via</delivery_via>
						<ship_line>$ship_line</ship_line>
						<operator>$operator</operator>
					</data>
				</root>";
				// print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				// print_r($in_data);
				// die();
				if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "CreateRequestRbm", array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{

					/*echo $result;
					die;*/

					print_r($result);
					die();	
					
				}
			}
		}
	}


	// public function edit_rbm($req_id)
	// {
	// 	$this->redirect();

	// 	$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));

	// 	$this->breadcrumbs->push("Edit RBM Request", 'rmb/rbm');
	// 	$this->breadcrumbs->unshift('Home','Realisasi Bongkar Muat','Realisasi Bongkar Muat', '/');
	// 	$data['breadcrumbs'] = $this->breadcrumbs->show();

	// 	$data['title']= "Edit Realisasi Bongkar Muat";
	// 	log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');


	// 	$getdata = $this->container_model->getDataRbmByID($req_id);

	// 	// if ($getdata['REQUEST_ID'] == '' || $getdata['STATUS_REQ'] = 'AR')
	// 	if ($getdata['REQUEST_ID'] == '')
	// 	{
	// 		redirect(ROOT.'mainpage', 'refresh');
	// 	}
	// 	else
	// 	{
	// 		if ($getdata['PORT_ID'].'-'.$getdata['TERMINAL_ID'] == 'IDPLM-PLMD') // PALEMBANG  DOMESTIK
	// 		{
	// 			$port_id_and_terminal_id = 'IDPLM-PLMD';
	// 		}
	// 		elseif ($getdata['PORT_ID'].'-'.$getdata['TERMINAL_ID'] == 'IDTLB-TLBD') // TELUKBAYUR  DOMESTIK
	// 		{
	// 			$port_id_and_terminal_id = 'IDTLB-TLBD';
	// 		}
	// 		elseif ($getdata['PORT_ID'].'-'.$getdata['TERMINAL_ID'] == 'IDPNK-PNKD') // PONTIANAK  DOMESTIK
	// 		{
	// 			$port_id_and_terminal_id = 'IDPNK-PNKD'; 
	// 		}
	// 		elseif ($getdata['PORT_ID'].'-'.$getdata['TERMINAL_ID'] == 'IDDJB-DJBD') // JAMBI  DOMESTIK
	// 		{
	// 			$port_id_and_terminal_id = 'IDDJB-DJBD'; 
	// 		}

	// 		$data['req_id'] = $getdata['REQUEST_ID'];
	// 		$data['vessel'] = $getdata['VESSEL'];
	// 		$data['port_id_and_terminal_id'] = $port_id_and_terminal_id;
	// 		$data['voyage_in'] = $getdata['VOYAGE_IN'];
	// 		$data['voyage_out'] = $getdata['VOYAGE_OUT'];
	// 		$data['eta'] = $getdata['ETA'];
	// 		$data['etd'] = $getdata['ETD'];
	// 		$data['customer_name'] = $getdata['CUSTOMER_NAME'];
	// 		$data['customer_address'] = $getdata['CUSTOMER_ADDRESS'];
	// 		$data['npwp'] = $getdata['CUSTOMER_TAXID'];
	// 		$this->common_loader($data, 'pages/container/edit_rbm');
	// 	}
	// }


	// public function update_request_rbm() 
	// {
		
	// 	if (!$this->session->userdata('uname_phd'))
	// 	{
	// 		redirect(ROOT.'main', 'refresh');
	// 	}
	// 	log_message('debug','------------------------create_request_rbm-----------------------------');
	// 	$port=explode("-",$_POST["TERMINAL"]);
	// 	$id_req=$_POST["ID_REQ"];
	// 	$type_req='NEW'; //NEW for Delivery, EXT for Extention
	// 	$sp2p_number=""; //NULL for Delivery, NUMBER for Extention
	// 	$old_req=""; //NULL for Delivery, OLD req for Extention
	// 	$no_ukk=$_POST["ID_VSB_VOYAGE"];
	// 	$vessel=$_POST["VESSEL"];
	// 	// $vessel_code=$_POST["VESSEL_CODE"];
	// 	// $call_sign=$_POST["CALL_SIGN"];
	// 	$voyage_in=$_POST["VOYAGE_IN"];
	// 	$voyage_out=$_POST["VOYAGE_OUT"];
	// 	$eta=$_POST["ETA"];
	// 	$etd=$_POST["ETD"];
	// 	$customer_id=$_POST["CUSTOMER_ID"];;
	// 	$submitter_customer_id = $this->session->userdata('customeridppjk_phd');
	// 	$customer_name=$_POST["CUSTOMER_NAME"];
	// 	$address=$_POST["ADDRESS"];;
	// 	$npwp=$_POST["NPWP"];
	// 	$status="N";
	// 	$no_do=$_POST["NO_DO"];
	// 	$date_do=$_POST["DO_DATE"];
	// 	$sppb_type=$_POST["SPPB_TYPE"];
	// 	$no_sppb=$_POST["NO_SPPB"];
	// 	$date_sppb=$_POST["DATE_SPPB"];
	// 	$no_sp_custom=$_POST["NO_SP_CUSTOM"];
	// 	$date_sp_custom=$_POST["DATE_SP_CUSTOM"];
	// 	$no_bl=$_POST["NO_BL"];
	// 	$date_delivery=$_POST["DELIVERY_DATE"];
	// 	$date_ext="";
	// 	$date_old_del="";
	// 	$date_discharge=$_POST["DATE_DISCHARGE"];
	// 	$date_request=""; //nanti akan sysdate
	// 	$id_user=$this->session->userdata('userid_simop');
	// 	$id_user_eservice=$this->session->userdata('uname_phd');
	// 	$quantity=""; //akan diupdate saat detail
	// 	$remark="";
	// 	$is_edit="";
	// 	// $delivery_type=$_POST["DELIVERY_TYPE"];
	// 	$nobook=$_POST["NO_BOOKING"];
	// 	$ship_line=$_POST["ship_line"];
	// 	$delivery_via=$_POST["DELIVERY_VIA"];
	// 	//declare form validation pemesanan pengeluaran default
	// 	$config = array(
	// 		array(
	// 			'field' => 'TERMINAL',
	// 			'label' => "Terminal",
	// 			'rules' => 'required'
	// 		),
	// 		// array(
	// 		// 	'field' => 'ID_VSB_VOYAGE',
	// 		// 	'label' => "Vessel",
	// 		// 	'rules' => 'required'
	// 		// ),
	// 		// array(
	// 		// 	'field' => 'VESSEL_CODE',
	// 		// 	'label' => "Vessel",
	// 		// 	'rules' => 'required'
	// 		// ),
	// 		array(
	// 			'field' => 'VOYAGE_IN',
	// 			'label' => "Voyage In",
	// 			'rules' => 'required'
	// 		),
	// 		array(
	// 			'field' => 'VOYAGE_OUT',
	// 			'label' => "Voyage Out",
	// 			'rules' => 'required'
	// 		),
	// 		// array(
	// 		// 	'field' => 'DELIVERY_TYPE',
	// 		// 	'label' => "Delivery Type",
	// 		// 	'rules' => 'required'
	// 		// ),
	// 		// array(
	// 		// 	'field' => 'DELIVERY_DATE',
	// 		// 	'label' => "Delivery Date",
	// 		// 	'rules' => 'required'
	// 		// )
	// 	);

	// 	//declare form validation pemesanan pengeluaran internasional
	// 	if($no_sppb<>''){
	// 		$internasional = array(
	// 			array(
	// 				'field' => 'NO_SPPB',
	// 				'label' => "SPPB Number",
	// 				'rules' => 'required'
	// 			),
	// 			array(
	// 				'field' => 'DATE_SPPB',
	// 				'label' => "SPPB Date",
	// 				'rules' => 'required'
	// 			)
	// 		);			
	// 	}
	// 	else if($no_sp_custom<>'')
	// 	{
	// 		$internasional = array(
	// 			array(
	// 				'field' => 'NO_SP_CUSTOM',
	// 				'label' => "SP Custom Number",
	// 				'rules' => 'required'
	// 			),
	// 			array(
	// 				'field' => 'DATE_SP_CUSTOM',
	// 				'label' => "SP Custom Date",
	// 				'rules' => 'required'
	// 			)
	// 		);		
			
	// 	}

	// 	$status = '';
	// 	$msg = '';
		

	// 	if($this->input->post()) {
	// 		if($port[1] == 'T3I') {
	// 			foreach($internasional as $config_internasional) {
	// 				array_push($config, $config_internasional);
	// 			}
	// 		}
			
	// 		$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran
	// 		if($this->form_validation->run() == false) {
	// 			log_message('debug', '>>> --0.1-- salah');
	// 			$status = 'salah';
	// 			$msg = 'Masih terdapat kesalahan input, silakan periksa kembali inputan anda.';
	// 		} else {

	// 			// get img transaction log rbm
	// 			$get_file_transaction_rbm_log = $this->container_model->getDataRbmByID($id_req);
	// 			$my_file_trans = $get_file_history['DO_UPLOAD'];

	// 			$update_data = $this->container_model->reload_rbm($id_req, $port[0], $port[1], $no_ukk, $vessel, $voyage_in, $voyage_out, $customer_name, $address, $npwp, $eta, $etd);

	// 			if ($update_data)
	// 			{
	// 				$status = 'ok';
	// 				$msg = 'Update data RBM successfully !';

	// 				// remove file transaction
	// 				if (file_exists($my_file_trans)) 
	// 				{
 //                        unlink($my_file_trans);
 //                    }
	// 				// get data history
	// 				$get_file_history = $this->container_model->getAllNotesHistoryRbmByID($id_req);

	// 				foreach ($get_file_history as $row)
	// 				{
	// 					$my_file_history = $row['FILE_UPLOAD'];
	// 					// remove file history
	// 					if (file_exists($my_file_history)) 
	// 					{
	//                         unlink($my_file_history);
	//                     }
	//                     // Delete deleteHistoryRejectionRbm
	// 					$this->container_model->deleteHistoryRejectionRbm($id_req);
	// 				}
	// 			}
	// 			else
	// 			{
	// 				log_message('debug', $update_data);
	// 				$status = $update_data;
	// 				$msg = 'Error';
	// 				die;
	// 			}
	// 		}
	// 		echo json_encode(array('status' => $status, 'msg' => $msg));
	// 	}
	// }


	public function download_rbm($keycode)
	{

		$this->redirect();
		
		$data = $this->container_model->getDataRbmByID($keycode);
		// print_r($data);
		// die();
		$port_id = $data['PORT_ID'];
		$terminal_id = $data['TERMINAL_ID'];
		$category = $data['KATEGORI'];
		$id_vsb_voyage = $data['NO_UKK'];

		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if ($uname_phd == '') 
		{
			redirect(ROOT.'mainpage', 'refresh');
		} 
		else 
		{

			$in_data = "<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<port_code>$port_id</port_code>
								<terminal_code>$terminal_id</terminal_code>
								<user>$uname_phd</user>
								<no_ukk>$id_vsb_voyage</no_ukk>
								<id_kategori>$category</id_kategori>
							</data>
						</root>";
			// print_r($in_data);
			// die();
			if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "getPrintRbm", array("in_data" => "$in_data"), $result))
			{
				echo $result;
				die;
			}
			else
			{
				// echo $result;
				// die();
			

				$obj = json_decode($result);


				if ($obj->data->html_tcpdf)
				{
					$this->load->helper('pdf_helper');

					tcpdf();
					// create new PDF document
					//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
					// create new PDF document
					// set header and footer fonts
					$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					$pdf->SetMargins(5, 16, 8);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					$pdf->setPrintHeader(false);
					$pdf->SetPrintFooter(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);

					// ---------------------------------------------------------

					$tbl = base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 8);

					$pdf->writeHTML($tbl, true, false, false, false, '');

					// $pdf->AddPage();
					$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
					
					//Close and output PDF document
					$pdf->Output('print_rbm.pdf', 'I');

				} 
				else 
				{
					echo "GAGAL";
				}
			}
		}
	}


	public function download_rbm_new($keycode)
	{

		$this->redirect();
		$data = $this->container_model->getDataRbmByID($keycode);
		// print_r($data);
		// die();
		$port_id = $data['PORT_ID'];
		$terminal_id = $data['TERMINAL_ID'];
		$category = $data['KATEGORI'];
		$id_vsb_voyage = $data['NO_UKK'];

		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if ($uname_phd == '') 
		{
			redirect(ROOT.'mainpage', 'refresh');
		} 
		else 
		{

			$in_data = "<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<port_code>$port_id</port_code>
								<terminal_code>$terminal_id</terminal_code>
								<user>$uname_phd</user>
								<no_ukk>$id_vsb_voyage</no_ukk>
								<kategori>$category</kategori>
							</data>
						</root>";
			// print_r($in_data);
			// die();
			if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "getPrintRbmNew", array("in_data" => "$in_data"), $result))
			{
				echo $result;
				die;
			}
			else
			{

				// echo $result;
				// die;

				$obj = json_decode($result);

				if ($obj->data->html_tcpdf)
				{
					// 
					$this->load->helper('pdf_helper');

					tcpdf();
					// create new PDF document
					//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
					// create new PDF document
					// set header and footer fonts
					$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					$pdf->SetMargins(5, 16, 8);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					$pdf->setPrintHeader(false);
					$pdf->SetPrintFooter(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);

					// ---------------------------------------------------------

					$tbl = base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 8);

					$pdf->writeHTML($tbl, true, false, false, false, '');

					// $pdf->AddPage();
					$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
					
					//Close and output PDF document
					$pdf->Output('print_rbm_new.pdf', 'I');

				} 
				else 
				{
					echo "GAGAL";
				}
			}
		}
	}


	public function download_pranota_rbm($keycode)
	{

		$this->redirect();
		
		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);


		$data = $this->container_model->getDataRbmByID($keycode);
		// print_r(json_encode($this->session->userdata));
		// die();
		$port_id = $data['PORT_ID'];
		$terminal_id = $data['TERMINAL_ID'];
		$category = $data['KATEGORI'];
		$id_vsb_voyage = $data['NO_UKK'];

		$customerid_phd = $data['CUSTOMER_ID'];

		if ($uname_phd == '') 
		{
			redirect(ROOT.'mainpage', 'refresh');
		} 
		else 
		{

			$in_data = "<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data> 
								<port_code>$port_id</port_code>
								<terminal_code>$terminal_id</terminal_code>
								<user>$uname_phd</user>
								<id_vsb>$id_vsb_voyage</id_vsb>
								<category>$category</category>
								<kd_pelanggan>$customerid_phd</kd_pelanggan>
							</data>
						</root>";
			// print_r($in_data);
			// die();
			if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "getPrintRbmPranota", array("in_data" => "$in_data"), $result))
			{
				echo $result;
				die;
			}
			else
			{

				// echo $result;
				// die;

				$obj = json_decode($result);

				if ($obj->data->html_tcpdf)
				{
					// 
					$this->load->helper('pdf_helper');

					tcpdf();
					// create new PDF document
					//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

					// create new PDF document
					// set header and footer fonts
					$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


					//set margins
					$pdf->SetMargins(5, 9, 8);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					$pdf->setPrintHeader(false);
					$pdf->SetPrintFooter(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					//set image scale factor
					// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					//set some language-dependent strings
					// $pdf->setLanguageArray(null);

					// ---------------------------------------------------------

					$tbl = base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 9);

					$pdf->writeHTML($tbl, true, false, false, false, '');

					// $pdf->AddPage();
					$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
					
					//Close and output PDF document
					$pdf->Output('print_pranota_rbm.pdf', 'I');

				} 
				else 
				{
					echo "GAGAL";
				}
			}
		}
	}


	public function download_nota_rbm($keycode)
	{

		$this->redirect();
		$data = $this->container_model->getDataRbmByID($keycode);
		// print_r($data);
		// die();
		$port_id = $data['PORT_ID'];
		$terminal_id = $data['TERMINAL_ID'];
		$category = $data['KATEGORI'];
		$id_vsb_voyage = $data['NO_UKK'];

		$uname_phd = $this->session->userdata('uname_phd');
		log_message('debug', 'nilai uname_phd: '.$uname_phd);

		if ($uname_phd == '') 
		{
			redirect(ROOT.'mainpage', 'refresh');
		} 
		else 
		{

			$in_data = "<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data> 
								<port_code>$port_id</port_code>
								<terminal_code>$terminal_id</terminal_code>
								<user>$uname_phd</user>
								<no_ukk>$id_vsb_voyage</no_ukk>
								<kategori>$category</kategori>
								<key_a>$keycode</key_a>
							</data>
						</root>";
			// print_r($in_data);
			// die();
			if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "getPrintRbmNota", array("in_data" => "$in_data"), $result))
			{
				echo $result;
				die;
			}
			else
			{

				// echo $result;
				// die;

				$obj = json_decode($result);

				if ($obj->data->html_tcpdf)
				{
					// 
					$this->load->helper('pdf_helper');

					tcpdf();
					// create new PDF document
					//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
					// set header and footer fonts
					$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					//set margins
					//$pdf->SetMargins(5, 16, 8);
					$pdf->SetMargins(6, 8, 10, 0);
					//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					$pdf->setPrintHeader(false);
					$pdf->SetPrintFooter(false);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					// ---------------------------------------------------------

					$tbl = base64_decode($obj->data->html_tcpdf);

					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 9);

					$pdf->writeHTML($tbl, true, false, false, false, '');

					// $pdf->AddPage();
					$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
					
					//Close and output PDF document
					$pdf->Output('print_nota_rbm.pdf', 'I');

				} 
				else 
				{
					echo "GAGAL";
				}
			}
		}
	}


	public function approval_rbm()
	{

		$this->redirect();

		$access_login = $this->session->userdata('group_phd');
		$msg = '';
		$status = '';

		if ( $this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$req_id	= $this->input->post('reqnum');

			$getdata = $this->container_model->getDataRbmByID($req_id);
			$kategori = $getdata['KATEGORI']; 
			$port_id = $getdata['PORT_ID'];
			$terminal_id = $getdata['TERMINAL_ID'];
			$no_ukk = $getdata['NO_UKK'];
			$customer_id = $this->session->userdata('customerid_phd');
			$cek = $this->container_model->cek_rbm($no_ukk,$req_id);
			// print_r($cek);
			// die();
			$cek = (int) $cek;

						
			if ($cek == 0 ) 
			{
				// print_r('0');
				// die();
				// echo 'success';
				

				$in_data = "<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<port_code>$port_id</port_code>
									<terminal_code>$terminal_id</terminal_code>
									<user_id>$customer_id</user_id>
									<no_ukk>$no_ukk</no_ukk>
									<request_no>$req_id</request_no>
								</data>
							</root>";
				// print_r($in_data) ;
				// die();
				if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "SaveFinalRbm", array("in_data" => "$in_data"), $result))
				{
					echo $result;
					die;
				}
				else
				{
					// print_r($result);
					// die();
					$obj = json_decode($result);
					if ($obj->rc!="S")
					{
						$msg__wsdl = "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						$update_status = $this->container_model->approvalnRbm($req_id);
						
						$msg__wsdl =($obj->data->info);
						$status = 'success';
						$msg = 'Approve RBM ('.$req_id.') and Final successfully ! ';
					} else {
						$msg__wsdl = "NO,GAGAL";
					}
				}
			} 
			else 
			{
				// print_r('lebih');
				// die();
				$update_status = $this->container_model->approvalnRbm($req_id);
				$status = 'success';
				$msg = 'Approve RBM ('.$req_id.') successfully !';
			}

			echo json_encode(array('status' => $status, 'msg' => $msg, 'msg__wsdl' => $msg__wsdl));
		}
	}


	public function rejection_rbm()
	{

		$this->redirect();

		if ( $this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$req_id	= $this->input->post('reqnum');
			$notes 	= $this->input->post('note');
			// echo $req_id . $notes;
			
			$access_login = $this->session->userdata('group_phd');

			if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
				$user = 'Admin';
			}
			elseif ($access_login == 'd') { // customer 
				$user = 'User';
			}

			$folderfile = 'attachment';
			// $file = basename($_FILES['file']['name'], '.pdf');
			// if ($file != "") {$file = $file.'-'.time();}

			$path = UPLOADFOLDER_.$folderfile;

			$config['upload_path']		= $path;
			$config['allowed_types']	= 'xlsx|xls|ods|csv|doc|pdf';
			$config['remove_space'] 	= TRUE;

			$this->load->library('upload');
			$this->upload->initialize($config);
			$msg = '';
			$status = '';

			if ($this->upload->do_upload('documment_rejection'))
			{
				$file_upload = array('upload_data' => $this->upload->data());

				$file = APP_ROOT.$folderfile."/".$file_upload['upload_data']['file_name'];
				
				$params = array(
					'REQUEST_ID'		=>	$req_id,
					// 'DATE_REJECTION'	=>	$no_proforma,
					'USER_REJECTION'	=>	$user,
					'STATUS_REJECTION'	=>	'R',
					'NOTE_REJECTION'	=>	$notes,
					'FILE_UPLOAD'		=>	$file
				);

				// print_r($params);
				// die;
				
		        $update_status = $this->container_model->rejectionRbm($req_id, $notes, $file);
				$insert_history_rejection = $this->container_model->historyRejection($params);

				if ($update_status AND $insert_history_rejection) 
				{
					$status = 'success';
					$msg = 'Reject RBM ('.$req_id.') successfully !';
				} 
				else 
				{
					$status = 'failed';
					$msg = 'GAGAL !';
				}
			}
			else 
			{ 

				$params = array(
					'REQUEST_ID'		=>	$req_id,
					// 'DATE_REJECTION'	=>	$no_proforma,
					'USER_REJECTION'	=>	$user,
					'STATUS_REJECTION'	=>	'R',
					'NOTE_REJECTION'	=>	$notes,
					'FILE_UPLOAD'		=>	''
				);

				// print_r($params);
				// die;
				
		        $update_status = $this->container_model->rejectionRbm($req_id, $notes, $file);
				$insert_history_rejection = $this->container_model->historyRejection($params);

				if ($update_status AND $insert_history_rejection) 
				{
					$status = 'success';
					$msg = 'Reject RBM ('.$req_id.') successfully !';
				} 
				else 
				{
					$status = 'failed';
					$msg = 'GAGAL !';
				}
				// $status = 'error';
            	// $msg = $this->upload->display_errors('', '');
		        // echo $this->upload->display_errors(); 
		    } 

		    echo json_encode(array('status' => $status, 'msg' => $msg));
		}
	}


	public function apprejectlist()
	{
		$data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("RBM Rejection List", ' apprejectlist/new_main_approval');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title'] = "Rejection List";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');
		
		$access_login = $this->session->userdata('group_phd');

		$result = $this->container_model->approveRejectionListRbm();

		//create table
		$this->table->set_heading(
			"<th width='30px'>NO</th>",
			"<th width='30px'>REQUEST NUMBER</th>",
			"<th width='30px'>VESSEL / VOYAGE</th>",
			"<th width='30px'>PELABUHAN/TERM.</th>",
			"<th width='30px'>STATUS</th>",
			"<th width='30px'>VIEW</th>",
			"<th width='100px'>PRINT RBM</th>",
			"<th width='30px'>PRANOTA</th>",
			"<th width='30px'>NOTA</th>",
			"<th width='30px'>ACCEPT/REJECT</th>"
		);

		$i = 1;
		foreach ($result as $row)
		{
			// Button print, etc.
			$view_link = '<a class="btn btn-primary" onclick=\'viewRejectAR("'.$row['REQUEST_ID'].'", "'.$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'].'", "'.$row['REJECT_NOTES'].'")\'><i class="fa fa-eye"></i></a>';
			$print_rbm = '<a href="download_rbm/'.$row['NO_UKK'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'" class="btn btn-warning" target="_blank" title="Print RBM"><i class="fa fa-print"></i></a>';
			$print_rbm2 = '<a href="download_rbm_new/'.$row['NO_UKK'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'" class="btn btn-info" target="_blank" title="Print RBM New"><i class="fa fa-print"></i></a>';
			$pranota = '<a  href="download_pranota_rbm/'.$row['NO_UKK'].'/'.$row['PORT_ID'].'/'.$row['TERMINAL_ID'].'/1" class="btn btn-success" target="_blank" title="Pranota"><i class="fa fa-print"></i></a>';
			$nota = '<a href="" class="btn btn-default" title="Nota"><i class="fa fa-print"></i></a>';
			$approve_link = '<span id="'.$row['REQUEST_ID'].'" class="comfirm_reject"><a href="javascript:void(0)" class="btn" title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a></span>';
			$reject_link = '<a href="#" class="btn" onclick=\'rejectAR("'.$row['REQUEST_ID'].'", "'.$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'].'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';

			if ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDPLM-PLMD') // PALEMBANG  DOMESTIK
			{
				$terminal = 'Palembang - Domestik';
			}
			elseif ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDTLB-TLBD') // TELUKBAYUR  DOMESTIK
			{
				$terminal = 'Teluk Byur - Domestik';
			}
			elseif ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDPNK-PNKD') // PONTIANAK  DOMESTIK
			{
				$terminal = 'Pontianak - Domestik'; 
			}
			elseif ($row['PORT_ID'].'-'.$row['TERMINAL_ID'] == 'IDDJB-DJBD') // JAMBI  DOMESTIK
			{
				$terminal = 'Jambi - Domestik';
			}


			if ($row['STATUS_REQ'] == 'R') 
			{
				
				$status_rbm = '<span class="label label-warning">Waiting Confrim</span>';

				$this->table->add_row(
					$i++,
					$row['REQUEST_ID'],
					$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'],
					$terminal,
					array('data' => $status_rbm, 'align' => 'center'),
					$view_link,
					$print_rbm . $print_rbm2,
					$pranota,
					$nota,
					$approve_link . $reject_link
				);
			}
			elseif ($row['STATUS_REQ'] == 'AR') 
			{
				
				$status_rbm = '<span class="label label-danger">Rejected</span>';

				$this->table->add_row(
					$i++,
					$row['REQUEST_ID'],
					$row['VESSEL'] .'/'. $row['VOYAGE_IN'] .'-'. $row['VOYAGE_OUT'],
					$terminal,
					array('data' => $status_rbm, 'align' => 'center'),
					$view_link,
					$print_rbm . $print_rbm2,
					$pranota,
					$nota,
					''
				);
			}
			
		}

		$this->common_loader($data,'pages/container/apprejectlist');
	}


	public function RejectApproveFinal()
	{

		$this->redirect();

		$access_login = $this->session->userdata('group_phd');
		$msg = '';
		$status = '';

		// print_r(json_encode($this->session->userdata('customerid_phd')));
		// die();
		if ( $this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$req_id	= $this->input->post('reqnum');
			$notes 	= $this->input->post('note');

			$getdata = $this->container_model->getDataRbmByID($req_id);

			$port_id = $getdata['PORT_ID'];
			$terminal_id = $getdata['TERMINAL_ID'];
			$no_ukk = $getdata['NO_UKK'];
			$customer_id = $this->session->userdata('customerid_phd');
				$status = 'success';
				$msg = 'Approve RBM ('.$req_id.') successfully !';

				$in_data = "<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<port_code>$port_id</port_code>
									<terminal_code>$terminal_id</terminal_code>
									<user_id>$customer_id</user_id>
									<no_ukk>$no_ukk</no_ukk>
									<no_request>$req_id</no_request>
								</data>
							</root>";

				if (!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT, "dischLoadCancel", array("in_data" => "$in_data"), $result))
				{
					$msg__wsdl = $result;
					die;
				}
				else
				{
					// echo $result;
					// die;

					$obj = json_decode($result);
					if ($obj->rc!="S")
					{
						$msg__wsdl = "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						$update_status = $this->container_model->approveRejectFinal($req_id, $notes);
						
						$msg__wsdl =($obj->data->info);
					} else {
						$msg__wsdl = "NO,GAGAL";
					}
				}
			

			echo json_encode(array('status' => $status, 'msg' => $msg, 'msg__wsdl' => $msg__wsdl));
		}
	}
	

	public function rejected_approval()
	{

		$this->redirect();

		if ( $this->input->server('REQUEST_METHOD') == 'POST') 
		{

			// edit by eko
	  //       $in_data="<root>
	  //           <sc_type>1</sc_type>
	  //           <sc_code>123456</sc_code>
	  //           <data>
	  //               <detail>
	  //                   <request_no>$reqNoBiller</request_no>
	  //                   <port_code>".$port[0]."</port_code>
	  //                   <terminal_code>".$port[1]."</terminal_code>
			// 			<user_id>".$this->session->userdata('uname_phd')."</user_id>
	  //               </detail>
	  //           </data>
	  //       </root>";

			// if(!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT,"submitRequestReceiving",array("in_data" => "$in_data"),$result))
			// {
			// 	echo $result;
			// 	die;
			// }
			// else
			// {
			// 	echo $result;
			// 	exit;
			// }

			// end edit by eko
			$req_id	= $this->input->post('reqnum');
			$notes 	= $this->input->post('note');
			// echo $req_id . $notes;
			
			$access_login = $this->session->userdata('group_phd');

			if ($access_login == '1' || $access_login == 'c' || $access_login == 'o') { // Admin
				$user = 'Admin';
			}
			elseif ($access_login == 'd') { // customer 
				$user = 'User';
			}

			$folderfile = 'attachment';
			// $file = basename($_FILES['file']['name'], '.pdf');
			// if ($file != "") {$file = $file.'-'.time();}

			$path = UPLOADFOLDER_.$folderfile;

			$config['upload_path']		= $path;
			$config['allowed_types']	= 'xlsx|xls|ods|csv|doc|pdf';
			$config['remove_space'] 	= TRUE;

			$this->load->library('upload');
			$this->upload->initialize($config);
			$msg = '';
			$status = '';

			if ($this->upload->do_upload('documment_rejection'))
			{
				$file_upload = array('upload_data' => $this->upload->data());

				$file = APP_ROOT.$folderfile."/".$file_upload['upload_data']['file_name'];
				
				$params = array(
					'REQUEST_ID'		=>	$req_id,
					// 'DATE_REJECTION'	=>	$no_proforma,
					'USER_REJECTION'	=>	$user,
					'STATUS_REJECTION'	=>	'W',
					'NOTE_REJECTION'	=>	$notes,
					'FILE_UPLOAD'		=>	$file
				);

				// print_r($params);
				// die;
				
		        $update_status = $this->container_model->rejected_ApprovalRbm($req_id, $notes, $file);
				$insert_history_rejection = $this->container_model->historyRejection($params);

				if ($update_status AND $insert_history_rejection) 
				{
					$status = 'success';
					$msg = 'Reject RBM ('.$req_id.') successfully !';
				} 
				else 
				{
					$status = 'failed';
					$msg = 'GAGAL !';
				}
			}
			else 
			{ 
				$params = array(
					'REQUEST_ID'		=>	$req_id,
					// 'DATE_REJECTION'	=>	$no_proforma,
					'USER_REJECTION'	=>	$user,
					'STATUS_REJECTION'	=>	'W',
					'NOTE_REJECTION'	=>	$notes,
					'FILE_UPLOAD'		=>	$file
				);

				// print_r($params);
				// die;
				
		        $update_status = $this->container_model->rejected_ApprovalRbm($req_id, $notes, $file);
				$insert_history_rejection = $this->container_model->historyRejection($params);

				if ($update_status AND $insert_history_rejection) 
				{
					$status = 'success';
					$msg = 'Reject RBM ('.$req_id.') successfully !';
				} 
				else 
				{
					$status = 'failed';
					$msg = 'GAGAL !';
				}
				// $status = 'error';
    //         	$msg = $this->upload->display_errors('', '');
		        // echo $this->upload->display_errors(); 
		    } 

		    echo json_encode(array('status' => $status, 'msg' => $msg));
		}
	}
		

	public function auto_operator(){

		$id_vsb_voyage     = htmLawed($_POST["id_vsb_voyage"]);
        $port=explode("-",htmLawed($_POST["port"]));
		//print_r('test');die;
        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_vsb_voyage>$id_vsb_voyage</id_vsb_voyage>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		//log_message('error','>>>>>>>>>> data: '.json_encode($in_data));
		
		if(!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT,"getOperator",array("in_data" => "$in_data"),$result))
		{

			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			//log_message('error','>>>>>>>>>> auto POD: '.$result);
			$stack1	= array();
			if($obj->data->operator){
			  for($i=0;$i<count($obj->data->operator);$i++)
				{
					$temp;
					$temp['NAME']=$obj->data->operator[$i]->name;
					$temp['ID_OPR']=$obj->data->operator[$i]->id_operator;
					array_push($stack1, $temp);
				}
			}
		}
        // echo json_encode($stack1);
		$cbpod 	= "<select name='pod' id='pod' class='form-control'>";
		$cbpod  .= "<option value=''>---Pilih---</option>";
		foreach ($stack1 as $key) {
			$cbpod .="<option value='".$key['ID_OPR']."'><b>".$key['NAME']."</option>";
		}
		$cbpod .= "</select>";

		echo  $cbpod;

	}
}
	