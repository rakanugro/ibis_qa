<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Truck_container extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model'); 
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views){
		//$this->output->set_header('X-FRAME-OPTIONS: DENY'); 
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function create_truck_registration($port1 = null, $port2 = null) {
		
		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>Customer Name</th>",
		  "<th width='100px'>Truck ID</th>",
		  "<th width='100px'>License Plate</th>",
		  "<th width='100px'>RFID Code</th>",
		  "<th width='100px'>KIU</th>",
		  "<th width='100px'>Status KIR</th>",
		  "<th width='100px'>Tanggal Berlaku</th>",
		  "<th width='50px'>EDIT</th>"
		 );
		 
		 //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		//$customer_id=$this->session->userdata('customerid_phd');
		
		
		 //  $in_data = "<root>
			// 	<sc_type>1</sc_type>
			// 	<sc_code>123456</sc_code>
			// 	<data>
			// 		<port_code>IDPLM</port_code>
			// 		<terminal_code>PLMD</terminal_code>
			// 	</data>
			// </root>";

		if(!empty($port1)&&!empty($port2)){

			$in_data = "<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port1."</port_code>
					<terminal_code>".$port2."</terminal_code>
					<search></search>
				</data>
			</root>";
			
					$stack = array();
					if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTruckReg",array("in_data" => "$in_data"),$result))
					{
			 			echo "<script>alert('Data Tidak Ditemukan');</script>";
					}
					else
					{
						// echo $result;
						// die; 
						$obj = json_decode($result);

						if($obj->data->listreq)
						{

							$i=1;
								
								for($i=0;$i<count($obj->data->listreq);$i++)
								{
									echo $obj->data->listreq[$i]->ID_SERVICETYPE;
								
									$label_span='<span class="label label-default">N/A</span>';
									//$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
									$view_link ='<span class="label label-default">N/A</span>';
									//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
									$edit_link='<span class="label label-default">N/A</span>';
									$cancel_link='<span class="label label-default">N/A</span>';
									$confirm_link='<span class="label label-default">N/A</span>';

									$label_span='<span class="label label-info">Draft</span>';
									//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
									$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."truck_containers/edit_tid/".$obj->data->listreq[$i]->TID.'"><i class=\'fa fa-pencil\'></i></a>';

									// print_r($obj);
									// die();
									$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/cancel_tid/".$obj->data->listreq[$i]->TID.'"><i class=\'fa fa-trash-o\'></i></a>';
									$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';

								if(!empty($port1)&&!empty($port2)){
									$this->table->add_row(
										$i+1,
										$obj->data->listreq[$i]->NAME,
										$obj->data->listreq[$i]->TID,
										$obj->data->listreq[$i]->TRUCK_NUMBER,
										$obj->data->listreq[$i]->RFID_CODE,
										$obj->data->listreq[$i]->KIU,
										$obj->data->listreq[$i]->STATUS_KIR,
										$obj->data->listreq[$i]->TGL_BERLAKU,
										$edit_link
										//$confirm_link
									);			
								}		
								
							}
					 	} else {
							echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
						}
			}			
		}else{
			echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
		}			
		//print_r($in_data);die;
		
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Truck Service", '/container/main_delivery');
		$this->breadcrumbs->push("Input Truck ID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Truck ID Registration";	
		$data['terminal_code'] = $port2;
		//$this->redirect('www.google.com');
		//$this->common_loader($data,'pages/om/truck_reg_container');
		$this->common_loader($data,'pages/container/truck_reg_container');
		
	}
	public function search_truck_registration() {
		// $this->redirect();
		// print_r('a');

		// $this->redirect();

		// print_r("expression");
		// die();

		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>Customer Name</th>",
		  "<th width='100px'>Truck ID</th>",
		  "<th width='100px'>License Plate</th>",
		  "<th width='100px'>RFID Code</th>",
		  "<th width='100px'>KIU</th>",
		  "<th width='100px'>Status KIR</th>",
		  "<th width='100px'>Tanggal Berlaku</th>",
		  "<th width='50px'>EDIT</th>"
		 );

		 //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		//$customer_id=$this->session->userdata('customerid_phd');


		 //  $in_data = "<root>
			// 	<sc_type>1</sc_type>
			// 	<sc_code>123456</sc_code>
			// 	<data>
			// 		<port_code>IDPLM</port_code>
			// 		<terminal_code>PLMD</terminal_code>
			// 	</data>
			// </root>";

		$search=isset($_POST['search']) ? htmLawed($_POST['search']) : 10;
		$port1=isset($_POST['port_code']) ? htmLawed($_POST['port_code']) : 10;
		$port2=isset($_POST['terminal_code']) ? htmLawed($_POST['terminal_code']) : 10;

		if(!empty($port1)&&!empty($port2)){

			$in_data = "<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port1."</port_code>
					<terminal_code>".$port2."</terminal_code>
					<search>".$search."</search>
				</data>
			</root>";

					$stack = array();
					if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTruckReg",array("in_data" => "$in_data"),$result))
					{
			 			echo "<script>alert('Data Tidak Ditemukan');</script>";
					}
					else
					{
						// echo $result;
						// die; 
						$obj = json_decode($result);

						if($obj->data->listreq)
						{

							$i=1;
								
								for($i=0;$i<count($obj->data->listreq);$i++)
								{
									echo $obj->data->listreq[$i]->ID_SERVICETYPE;
								
								$label_span='<span class="label label-default">N/A</span>';
								//$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
								$view_link ='<span class="label label-default">N/A</span>';
								//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
								$edit_link='<span class="label label-default">N/A</span>';
								$cancel_link='<span class="label label-default">N/A</span>';
								$confirm_link='<span class="label label-default">N/A</span>';

									$label_span='<span class="label label-info">Draft</span>';
									//$view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."/container/view_delivery/".$obj->data->request[$i]->id_req.'"><i class=\'fa fa-eye\'></i></a>';
									$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."truck_container/edit_tid/".$obj->data->listreq[$i]->TID.'/'.$port1.'/'.$port2.'"><i class=\'fa fa-pencil\'></i></a>';
									$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$obj->data->listreq[$i]->TID.','.$port1.','.$port2.'");\'><i class=\'fa fa-eye\'></i></a>';
									// print_r($obj);
									// die();
									$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."om/truck/cancel_tid/".$obj->data->listreq[$i]->TID.'"><i class=\'fa fa-trash-o\'></i></a>';
									$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$row['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';

								if(!empty($port1)&&!empty($port2)){
										$this->table->add_row(
													$i+1,
													$obj->data->listreq[$i]->NAME,
													$obj->data->listreq[$i]->TID,
													$obj->data->listreq[$i]->TRUCK_NUMBER,
													$obj->data->listreq[$i]->RFID_CODE,
													$obj->data->listreq[$i]->KIU,
													$obj->data->listreq[$i]->STATUS_KIR,
													$obj->data->listreq[$i]->TGL_BERLAKU,
													$edit_link
													//$confirm_link
												);			
									}		
								
							}
					 	} else {
							echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
						}
			}			
		}else{
			echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
		}			
		//print_r($in_data);die;


		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Truck Service", '/container/main_delivery');
		$this->breadcrumbs->push("Input Truck ID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Truck ID Registration";	
		$data['terminal_code'] = $port2;
		//$this->redirect('www.google.com');
		//$this->common_loader($data,'pages/om/truck_reg_container');
		// $this->common_loader($data,'pages/container/truck_reg_container');
		$this->load->view('pages/container/table_truck_reg_container', $data);

	}

	//menambahkan button print
	public function table_truck_registration() {
		$reponse = array(
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
                );
		$port1 = $this->input->post('port1');
		$port2 = $this->input->post('port2');

		$this->table->set_heading(
		  "<th width='30px'>NO</th>",
		  "<th width='100px'>Customer Name</th>",
		  "<th width='100px'>Truck ID</th>",
		  "<th width='100px'>License Plate</th>",
		  "<th width='100px'>RFID Code</th>",
		  "<th width='100px'>KIU</th>",
		  "<th width='100px'>Status KIR</th>",
		  "<th width='100px'>Tanggal Berlaku</th>",
		  "<th width='50px'>EDIT</th>",
		  "<th width='50px'>PRINT</th>"
		 );		
		

		if(!empty($port1)&&!empty($port2)){

			$in_data = "<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>".$port1."</port_code>
					<terminal_code>".$port2."</terminal_code>
				</data>
			</root>";			
		}			
		// print_r($in_data);
		// die();
		$stack = array();
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTruckReg",array("in_data" => "$in_data"),$result))
		{
 			echo "<script>alert('Data Tidak Ditemukan');</script>";
		}
		else
		{
			// echo $result;die; 
			$obj = json_decode($result);

			if($obj->data->listreq)
			{

				$i=1;
					
					for($i=0;$i<count($obj->data->listreq);$i++)
					{
						echo $obj->data->listreq[$i]->ID_SERVICETYPE;
					
						$label_span='<span class="label label-default">N/A</span>';
						$view_link ='<span class="label label-default">N/A</span>';
						$edit_link='<span class="label label-default">N/A</span>';
						$print_link='<span class="label label-default">N/A</span>';
						$cancel_link='<span class="label label-default">N/A</span>';
						$confirm_link='<span class="label label-default">N/A</span>';

						$label_span='<span class="label label-info">Draft</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."truck_container/edit_tid/".$obj->data->listreq[$i]->TID.'/'.$port1.'/'.$port2.'"><i class=\'fa fa-pencil\'></i></a>';
						$print_link='<a  class=\'btn btn-primary\'  href="'.ROOT."truck_container/print_tid/".$obj->data->listreq[$i]->TID.'/'.$port1.'/'.$port2.'" target="_blank"><i class=\'fa fa-print\'></i></a>';
						$cancel_link='<span class="label label-default">N/A</span>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->listreq[$i]->TID.','.$port1.','.$port2.'");\'><i class=\'fa fa-save\'></i></a>';
						$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$obj->data->listreq[$i]->TID.','.$port1.','.$port2.'");\'><i class=\'fa fa-eye\'></i></a>';

					if(!empty($port1)&&!empty($port2)){
							$this->table->add_row(
										$i+1,
										$obj->data->listreq[$i]->NAME,
										$obj->data->listreq[$i]->TID,
										$obj->data->listreq[$i]->TRUCK_NUMBER,
										$obj->data->listreq[$i]->RFID_CODE,
										$obj->data->listreq[$i]->KIU,
										$obj->data->listreq[$i]->STATUS_KIR,
										$obj->data->listreq[$i]->TGL_BERLAKU,
										$edit_link,
										$print_link
										//$confirm_link
									);			
						}		
					
				}
		 	} else {
				echo "<span style='color:red'>" .$obj->rcmsg. "</span>";
			}
		}
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$data['statRFID'] = $this->container_model->getCheckRFID($port1);

		$this->breadcrumbs->push("Truck Service", '/container/main_delivery');
		$this->breadcrumbs->push("Input Truck ID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Truck ID Registration";	
		$data['terminal_code'] = $port2;
		//$this->common_loader($data,'pages/container/table_truck_reg_container');
		$this->load->view('pages/container/table_truck_reg_container',$data);
		//echo "x";
		
	}
	
	public function create_register_id() {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_register_id-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$port[2];
		$port[3];
		$customer_name=$_POST["CUSTOMER_NAME"];
		$customer_address=$_POST["CUSTOMER_ADDRESS"];
		$registrant_phone=$_POST["REGISTRANT_PHONE"];
		$company_name=$_POST["COMPANY_NAME"];
		$company_phone=$_POST["COMPANY_PHONE"];
		$truck_number=$_POST["TRUCK_NUMBER"];
		$truck_id=$_POST["TRUCK_ID"];
		$email=$_POST["EMAIL"];
		$kiu=$_POST["KIU"];
		$expired_kiu=$_POST["EXPIRED_KIU"];
		$no_stnk=$_POST["NO_STNK"];
		$expired_stnk=$_POST["EXPIRED_STNK"];
		$tgl=$_POST["TGL"];
		$rfid_code=$_POST["RFID_CODE"];
		$association_company=$_POST["ASSOCIATION_COMPANY"];

		if($this->container_model->getCheckRFID($port[2]) == '1') {
			$rfid_code = $_POST["txt_rfid"];
		}

		if($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
				$address = base64_encode($address);
				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>$port[2]</port_code>
						<terminal_code>$port[3]</terminal_code>
						<customer_name>$customer_name</customer_name>
						<customer_address>$customer_address</customer_address>
						<registrant_phone>$registrant_phone</registrant_phone>
						<company_name>$company_name</company_name>
						<company_phone>$company_phone</company_phone>
						<truck_number>$truck_number</truck_number>
						<truck_id>$truck_id</truck_id>
						<email>$email</email>
						<kiu>$kiu</kiu>
						<expired_kiu>$expired_kiu</expired_kiu>
						<no_stnk>$no_stnk</no_stnk>
						<expired_stnk>$expired_stnk</expired_stnk>
						<tgl>$tgl</tgl>
						<rfid_code>$rfid_code</rfid_code>
						<association_company>$association_company</association_company>			
					</data>
				</root>";
				
				//log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);
				//print_r($in_data);die();
				if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"createRegisterTID",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
			
		}
	}
	

	public function edit_tid($tid,$port1,$port2){
		
		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));		
		
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<tid>$tid</tid>
				<port_code>".$port1."</port_code>
				<terminal_code>".$port2."</terminal_code>
			</data>
		</root>";
		//print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getEditTID",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//var_dump($obj); die;
			if($obj->data->request)
			{
				//--------------------------------------------

				$data['request_data'][0]['TID'] = $obj->data->request[0]->tid;
				$data['request_data'][0]['TRUCK_NUMBER'] = $obj->data->request[0]->truck_number;
				$data['request_data'][0]['REGISTRANT_NAME'] = $obj->data->request[0]->registrant_name;
				$data['request_data'][0]['REGISTRANT_PHONE'] = $obj->data->request[0]->registrant_phone;	
				$data['request_data'][0]['COMPANY_NAME'] = $obj->data->request[0]->company_name;
				$data['request_data'][0]['COMPANY_ADDRESS'] = $obj->data->request[0]->company_address;	
				$data['request_data'][0]['COMPANY_PHONE'] = $obj->data->request[0]->company_phone;
				$data['request_data'][0]['EMAIL'] = $obj->data->request[0]->email;
				$data['request_data'][0]['KIU'] = $obj->data->request[0]->kiu;
				$data['request_data'][0]['EXPIRED_KIU'] = $obj->data->request[0]->expired_kiu;
				$data['request_data'][0]['NO_STNK'] = $obj->data->request[0]->no_stnk;
				$data['request_data'][0]['EXPIRED_STNK'] = $obj->data->request[0]->expired_stnk;
				$data['request_data'][0]['EXPIRED_DATE'] = $obj->data->request[0]->expired_date;
				$data['request_data'][0]['RFID_CODE'] = $obj->data->request[0]->rfid_code;		
				$data['request_data'][0]['ASSOCIATION_COMPANY'] = $obj->data->request[0]->association_company;	
			}
		}
		// print_r($port2);
		// die();
		$data['message'] = $message;

		$data['terminal'] = $this->master_model->get_terminal();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$data['statRFID'] = $this->container_model->getCheckRFID($port1);

		$this->breadcrumbs->push("TID Registration", 'truck_container/create_truck_registration');
		$this->breadcrumbs->push("Edit TID", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['port1'] = $port1;
		$data['port2'] = $port2;
		
		$data['title']= "Edit TID";
		$this->common_loader($data,'pages/container/edit_tid');
	}

	public function search_eservice(){
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$customer_id=$this->session->userdata('customerid_phd');
		$port			= explode("-",$_GET["port"]);
		$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["no_request"])));	
		$no_container	= $this->security->xss_clean(htmlentities(strtoupper($_GET["no_container"])));
		
		$data = $reqNoBiller=$this->container_model->getNoRequest($term,$port[0]);
		
		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];
		$stack = array();
		$address = base64_encode($address);
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>$no_req</no_req>
				<port>$port</port>
				<customer_id>$customer_id</customer_id>
				<terminal_id>$terminal_id</terminal_id>
				<modul_desc>$modul_desc</modul_desc>
				<no_container>$no_container</no_container>
			</data>
		</root>";
		
		//injek($in_data);
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTCAContainerEservice",array("in_data" => "$in_data"),$result))
		{
			log_message('debug',$result);	
			echo $result;
			die;
		}
		else
		{
			// echo $result;
			// die;
			$obj = json_decode($result);
			
				if($obj->data->list_cont)
			{
				for($i=0;$i<count($obj->data->list_cont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->list_cont[$i]->no_container;
					$temp['PIN_NUMBER']=$obj->data->list_cont[$i]->pin_number;

					array_push($stack, $temp);
					//print_r($stack);die;
				}
			}
		}
		
        echo json_encode($stack);
	}
	
	public function search_noneservice(){
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$no_request			= $this->security->xss_clean(htmlentities(strtoupper ($_GET["no_request"])));
		$no_container			= $this->security->xss_clean(htmlentities(strtoupper ($_GET["no_container"])));
		$request			= $this->security->xss_clean(htmlentities(strtoupper ($_GET["request"])));
		$customer_id=$this->session->userdata('customerid_phd');
		$port			= explode("-",$_GET["port"]);
				

		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<no_container>$no_container</no_container>
				<request>$request</request>
				<customer_id>$customer_id</customer_id>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		injek($in_data);
		//print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTCAContainerNoneservice",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;
			//die;
			$obj = json_decode($result);
			if($obj->data->list_cont)
			{
				for($i=0;$i<count($obj->data->list_cont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->list_cont[$i]->no_container;
					$temp['PIN_NUMBER']=$obj->data->list_cont[$i]->pin_number;
					array_push($stack, $temp);	
				}
			}
		}
		echo json_encode($stack);
	}
	
	
	public function main_tca(){


		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$this->breadcrumbs->push("Truck ID Association", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "TID ASSOCIATION";

		$this->common_loader($data,'pages/container/main_tca_container');
	}

	public function main_tca_m2m(){


		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$this->breadcrumbs->push("Truck ID Association", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "TID ASSOCIATION";

		$this->common_loader($data,'pages/container/main_tca_container_m2m');
	}

	
	public function save_tca_association() {
	
	if (!$this->session->userdata('uname_phd'))
	{
		redirect(ROOT.'main', 'refresh');
	}
	log_message('debug','------------------------create_register_id-----------------------------');
	
	$no_request = strtoupper($this->input->post('no_request'));
	$eservice = $this->input->post('eservice');
	
	$type = strtoupper($this->input->post('type'));
	$terminal = explode("-",$this->input->post('terminal'));
	$no_container = $this->input->post('no_container');
	$truck_id = $this->input->post('truck_id');
	$pin_number = $this->input->post('pin_number');

	if($eservice=='yes'){

		$data = $reqNoBiller=$this->container_model->getNoRequest($no_request,$terminal[0]);
		
		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];	

		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_req."</no_req>
				<port_code>".$port."</port_code>
				<modul_desc>".$modul_desc."</modul_desc>
				<terminal_code>".$terminal_id."</terminal_code>
				<no_container>".$no_container."</no_container>
				<tid_container>".$truck_id."</tid_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"saveTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
	}
	else{
					
		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_request."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$type."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<no_container>".$no_container."</no_container>
				<tid_container>".$truck_id."</tid_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		//print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"saveTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}	
		
			
		}
	}

	public function save_tca_association_m2m() {
	
	if (!$this->session->userdata('uname_phd'))
	{
		redirect(ROOT.'main', 'refresh');
	}
	log_message('debug','------------------------create_register_id-----------------------------');
	
	$no_request = strtoupper($this->input->post('no_request'));
	$eservice = $this->input->post('eservice');
	
	$type = strtoupper($this->input->post('type'));
	$terminal = explode("-",$this->input->post('terminal'));
	$no_container = $this->input->post('no_container');
	$truck = $this->input->post('truck');
	$pin_number = $this->input->post('pin_number');
	// return 
	if($eservice=='yes'){

		$data = $reqNoBiller=$this->container_model->getNoRequest($no_request,$terminal[0]);

		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];	

		$stack = array();
		//$address = base64_encode($address);

		// print_r(json_encode($truck_id));
		// die();
		$xmltruk = '';
		foreach ($truck as $key => $value) {
			if(!empty($value)){
				$xmltruk = $xmltruk.'<truck><TID>'.$value.'</TID></truck>';
			}
		}

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_req."</no_req>
				<port_code>".$port."</port_code>
				<modul_desc>".$modul_desc."</modul_desc>
				<terminal_code>".$terminal_id."</terminal_code>
				<no_container>".$no_container."</no_container>
				".$xmltruk."
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"saveTCARequest",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					

					//print_r($result);die;
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
	}
	else{
					
		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_request."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$type."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<no_container>".$no_container."</no_container>
				<tid_container>".$truck_id."</tid_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		//print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"saveTCARequest",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}	
		
			
		}
	}
	
	public function auto_truck_company(){
			
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$company_name			= $_GET["company_name"];

		$port			= explode("-",$_GET["port"]);
		

		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<company_name>$company_name</company_name>
				<port_code>".$port[2]."</port_code>
				<terminal_code>".$port[3]."</terminal_code>
			</data>
		</root>";
		injek($in_data);

		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTruckCompany",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->container)
			{
				for($i=0;$i<count($obj->data->container);$i++)
				{
					$temp;
					$temp['COMPANY_NAME']=$obj->data->container[$i]->company_name;
					$temp['COMPANY_ADDRESS']=$obj->data->container[$i]->company_address;
					$temp['COMPANY_PHONE']=$obj->data->container[$i]->company_phone;
					$temp['ASSOCIATION_COMPANY']=$obj->data->container[$i]->association_company;
					array_push($stack, $temp);
				}
			}
		}
		echo json_encode($stack);
	}
	
	public function auto_truck_number(){
			
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$truck_id			= $_GET["term"];

		$port			= explode("-",$_GET["port"]);
				

		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<truck_id>$truck_id</truck_id>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		injek($in_data);
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTruckID",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			if($obj->data->container)
			{
				for($i=0;$i<count($obj->data->container);$i++)
				{
					$temp;
					$temp['CDY_TRCK_CODE']=$obj->data->container[$i]->cdy_trck_code;
					$temp['CDY_TRCK_EDI']=$obj->data->container[$i]->cdy_trck_edi;
					array_push($stack, $temp);
				}
			}
		}
		echo json_encode($stack);
	}

	public function auto_no_request(){
			
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$no_request		= $_GET["term"];

		$port			= explode("-",$_GET["port"]);
		
		$customer_id = $this->session->userdata('customerid_phd');
		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$data = $this->container_model->getNoRequestByCustomer($no_request,$port[0],$customer_id); 
		// echo json_encode($data);
		// die();
		foreach ($data as $key => $value) {
			$temp;
			$temp['CDY_TRCK_CODE']=$value->REQUEST_ID;
			$temp['CDY_TRCK_EDI']='NO REQUST BILLER: '.$value->BILLER_REQUEST_ID;
			array_push($stack, $temp);
		}
				
		echo json_encode($stack);
	}
	
	public function update_register_id() {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------create_request_delivery-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$port[0];
		$port[1];
		$registrant_name=$_POST["REGISTRANT_NAME"];
		$registrant_phone=$_POST["REGISTRANT_PHONE"];
		$company_name=$_POST["COMPANY_NAME"];
		$company_phone=$_POST["COMPANY_PHONE"];
		$truck_number=$_POST["TRUCK_NUMBER"];
		$truck_id=$_POST["TRUCK_ID"];
		$company_address=$_POST["COMPANY_ADDRESS"];
		$email=$_POST["EMAIL"];
		$kiu=$_POST["KIU"];
		$expired_kiu=$_POST["EXPIRED_KIU"];
		$no_stnk=$_POST["NO_STNK"];
		$expired_stnk=$_POST["EXPIRED_STNK"];
		$expired_date=$_POST["EXPIRED_DATE"];
		$rfid_code=$_POST["RFID_CODE"];
		$association_company=$_POST["ASSOCIATION_COMPANY"];
		$truck_id_old=$_POST["TRUCK_ID_OLD"];

		if($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

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
						<registrant_name>$registrant_name</registrant_name>
						<registrant_phone>$registrant_phone</registrant_phone>
						<company_name>$company_name</company_name>
						<company_phone>$company_phone</company_phone>
						<truck_number>$truck_number</truck_number>
						<truck_id>$truck_id</truck_id>
						<truck_id_old>$truck_id_old</truck_id_old>
						<company_address>$company_address</company_address>
						<email>$email</email>
						<kiu>$kiu</kiu>
						<expired_kiu>$expired_kiu</expired_kiu>
						<no_stnk>$no_stnk</no_stnk>
						<expired_stnk>$expired_stnk</expired_stnk>
						<expired_date>$expired_date</expired_date>
						<rfid_code>$rfid_code</rfid_code>
						<association_company>$association_company</association_company>
					</data>
				</root>";
				//print_r($in_data);die;
				log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);

				if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"updateRegisterTID",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					// print_r($result);
					// die();
					log_message('debug', '--4--'.$result);
					echo $result;
					return;

					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
			
		}
	}
	
		public function master_truck_company() {
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		log_message('debug','------------------------master_truck_company-----------------------------');
		$port=explode("-",$_POST["TERMINAL"]);
		$port[2];
		$port[3];
		$company_name=$_POST["COMPANY_NAME"];
		$company_address=$_POST["COMPANY_ADDRESS"];
		$company_phone=$_POST["COMPANY_PHONE"];
		$association_company=$_POST["ASSOCIATION_COMPANY"];

		if($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan pengeluaran

				// no error
				// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
				// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
				$address = base64_encode($address);
				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<port_code>$port[2]</port_code>
						<terminal_code>$port[3]</terminal_code>
						<company_name>$company_name</company_name>
						<company_phone>$company_phone</company_phone>
						<company_address>$company_address</company_address>
						<association_company>$association_company</association_company>							
					</data>
				</root>";
				
				//log_message('debug', '>>> --1--'.$in_data);
				injek($in_data);
				//print_r($in_data);die();
				if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"createMasterTruck",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
			
		}
		$data['title']= "Master Truck Company";
		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$this->common_loader($data,'pages/container/master_truck_company');
	}
	
	public function cancel_tca(){


		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$this->breadcrumbs->push("Truck ID Cancellation", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "TID CANCELLATION";

		$this->common_loader($data,'pages/container/cancel_tca');
	}

	public function cancel_tca_m2m(){


		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$this->breadcrumbs->push("Truck ID Cancellation", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "TID CANCELLATION";

		$this->common_loader($data,'pages/container/cancel_tca_m2m');
	}
	
	public function cancel_tca_association() {

	if (!$this->session->userdata('uname_phd'))
	{
		redirect(ROOT.'main', 'refresh');
	}
	log_message('debug','------------------------create_register_id-----------------------------');
	
	$no_request = $this->input->post('no_request');
	$eservice = $this->input->post('eservice');
	$type = strtoupper($this->input->post('type'));
	$terminal = explode("-",$this->input->post('terminal'));
	$no_container = $this->input->post('no_container');
	$truck_id = $this->input->post('truck_id');
	$pin_number = $this->input->post('pin_number');

	if($eservice=='yes'){
		
		$data = $reqNoBiller=$this->container_model->getNoRequest($no_request,$terminal[0]);

		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];	
		

		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_req."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$modul_desc."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<no_container>".$no_container."</no_container>
				<tid_container>".$truck_id."</tid_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"cancelTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					die();
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
	}
	else{
					
		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_request."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$type."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<no_container>".$no_container."</no_container>
				<tid_container>".$truck_id."</tid_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		//print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"cancelTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}	
		}
	}
	public function cancel_tca_association_m2m() {
	
	if (!$this->session->userdata('uname_phd'))
	{
		redirect(ROOT.'main', 'refresh');
	}
	log_message('debug','------------------------create_register_id-----------------------------');
	
	$no_request = $this->input->post('no_request');
	$eservice = $this->input->post('eservice');
	$type = strtoupper($this->input->post('type'));
	$terminal = explode("-",$this->input->post('terminal'));
	$truck_id = $this->input->post('truck_id');

	if($eservice=='yes'){

		
		$data = $reqNoBiller=$this->container_model->getNoRequest($no_request,$terminal[0]);

		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];	
		

		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_req."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$modul_desc."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<tid_container>".$truck_id."</tid_container>
			</data>
		</root>";
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"cancelTCAM2m",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					// log_message('debug', '--4--'.$result);
					// echo $result;
					// die();
					//die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
	}
	}
		
		public function search_cancel(){
			
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
			
			$customer_id	= $this->session->userdata('customerid_phd');
			$port			= explode("-",$_GET["port"]);
			$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["no_request"])));	
			$truck_id	= $this->security->xss_clean(htmlentities(strtoupper($_GET["truck_id"])));
			
			$data = $reqNoBiller=$this->container_model->getNoRequest($term,$port[0]);
			
			$no_req = $data['BILLER_REQUEST_ID'];
			$port =  $data['PORT_ID']; 
			$terminal_id = $data['TERMINAL_ID'];
			$modul_desc = $data['MODUL_DESC'];
			$stack = array();
			$address = base64_encode($address);
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_req>$no_req</no_req>
					<port>$port</port>
					<customer_id>$customer_id</customer_id>
					<terminal_id>$terminal_id</terminal_id>
					<modul_desc>$modul_desc</modul_desc>
					<truck_id>$truck_id</truck_id>
				</data>
			</root>";
			
			//injek($in_data);
			// print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"searchCancelTCAEservice",array("in_data" => "$in_data"),$result))
			{
				log_message('debug',$result);	
				echo $result;
				die;
			}
			else
			{
				// echo $result;
				// die;
				$obj = json_decode($result);
				
					if($obj->data->list_cont)
				{
					for($i=0;$i<count($obj->data->list_cont);$i++)
					{
						$temp;
						$temp['TRUCK_ID']=$obj->data->list_cont[$i]->truck_id;
						$temp['TRUCK_NUMBER']=$obj->data->list_cont[$i]->truck_number;

						array_push($stack, $temp);
						//print_r($stack);die;
					}
				}
			}
			
	        echo json_encode($stack);
		}
	public function cancel_eservice(){
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		$customer_id	= $this->session->userdata('customerid_phd');
		$port			= explode("-",$_GET["port"]);
		$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["no_request"])));	
		$no_container	= $this->security->xss_clean(htmlentities(strtoupper($_GET["no_container"])));
		
		$data = $reqNoBiller=$this->container_model->getNoRequest($term,$port[0]);
		
		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];
		$stack = array();
		$address = base64_encode($address);
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>$no_req</no_req>
				<port>$port</port>
				<customer_id>$customer_id</customer_id>
				<terminal_id>$terminal_id</terminal_id>
				<modul_desc>$modul_desc</modul_desc>
				<no_container>$no_container</no_container>
			</data>
		</root>";
		
		//injek($in_data);
		// print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"cancelTCAEservice",array("in_data" => "$in_data"),$result))
		{
			log_message('debug',$result);	
			echo $result;
			die;
		}
		else
		{
			// echo $result;
			//die;
			$obj = json_decode($result);
			
				if($obj->data->list_cont)
			{
				for($i=0;$i<count($obj->data->list_cont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->list_cont[$i]->no_container;
					$temp['TRUCK_ID']=$obj->data->list_cont[$i]->truck_id;
					$temp['PIN_NUMBER']=$obj->data->list_cont[$i]->pin_number;
					$temp['TRUCK_NUMBER']=$obj->data->list_cont[$i]->truck_number;

					array_push($stack, $temp);
					//print_r($stack);die;
				}
			}
		}
		
        echo json_encode($stack);
	}
	
	public function cancel_noneservice(){
		
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$no_request			= $this->security->xss_clean(htmlentities(strtoupper ($_GET["no_request"])));
		$no_container		= $this->security->xss_clean(htmlentities(strtoupper ($_GET["no_container"])));
		$request			= $this->security->xss_clean(htmlentities(strtoupper ($_GET["request"])));
		$customer_id		= $this->session->userdata('customerid_phd');
		$port				= explode("-",$_GET["port"]);
				

		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<no_container>$no_container</no_container>
				<request>$request</request>
				<customer_id>$customer_id</customer_id>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		injek($in_data);
		
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"cancelTCANonEservice",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;
			//die;
			$obj = json_decode($result);
			if($obj->data->list_cont)
			{
				for($i=0;$i<count($obj->data->list_cont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->list_cont[$i]->no_container;
					$temp['TRUCK_ID']=$obj->data->list_cont[$i]->truck_id;
					$temp['PIN_NUMBER']=$obj->data->list_cont[$i]->pin_number;
					$temp['TRUCK_NUMBER']=$obj->data->list_cont[$i]->truck_number;
					array_push($stack, $temp);	
				}
			}
		}
		echo json_encode($stack);
	}
	
	public function check_save_tca() {

	if (!$this->session->userdata('uname_phd'))
	{
		redirect(ROOT.'main', 'refresh');
	}
	log_message('debug','------------------------create_register_id-----------------------------');
	
	$no_request 		= $this->input->post('no_request');
	$eservice 			= $this->input->post('eservice');
	$type 				= strtoupper($this->input->post('type'));
	$terminal 			= explode("-",$this->input->post('terminal'));
	$truck_id 			= $this->input->post('truck_id');
	$no_container 		= $this->input->post('no_container');
	$pin_number 		= $this->input->post('pin_number');
	$customer_id		= $this->session->userdata('customerid_phd');
	//echo $customer_id;die;

	if($eservice=='yes'){
	
		$data = $reqNoBiller=$this->container_model->getNoRequest($no_request,$terminal[0]);
		// print_r($data);
		// die();
		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];	

		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_req."</no_req>
				<port_code>".$port."</port_code>
				<modul_desc>".$modul_desc."</modul_desc>
				<terminal_code>".$terminal_id."</terminal_code>
				<tid_container>".$truck_id."</tid_container>
				<customer_id>".$customer_id."</customer_id>
				<no_container>".$no_container."</no_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		

		
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"checkTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					// print_r($result);
					// die();
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					// die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
	}
	else{
					
		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_request."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$type."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<tid_container>".$truck_id."</tid_container>
				<customer_id>".$customer_id."</customer_id>
				<no_container>".$no_container."</no_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		//print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"checkTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					// print_r($result);
					// die();
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					// die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}	
		
			
		}
	}
	public function check_save_tca_m2m() {
		// echo json_encode("value");
	if (!$this->session->userdata('uname_phd'))
	{
		redirect(ROOT.'main', 'refresh');
	}
	// log_message('debug','------------------------create_register_id-----------------------------');
	
	$no_request 		= $this->input->post('no_request');
	$eservice 			= $this->input->post('eservice');
	$type 				= strtoupper($this->input->post('type'));
	$terminal 			= explode("-",$this->input->post('terminal'));
	$truck_id 			= $this->input->post('truck_id');
	$customer_id		= $this->session->userdata('customerid_phd');
	//echo $customer_id;die;

	if($eservice=='yes'){
	
		$data = $reqNoBiller=$this->container_model->getNoRequest($no_request,$terminal[0]);
		// print_r($data);
		// die();
		$no_req = $data['BILLER_REQUEST_ID'];
		$port =  $data['PORT_ID']; 
		$modul_desc = $data['MODUL_DESC'];
		$terminal_id = $data['TERMINAL_ID'];	

		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_req."</no_req>
				<port_code>".$port."</port_code>
				<modul_desc>".$modul_desc."</modul_desc>
				<terminal_code>".$terminal_id."</terminal_code>
				<tid_container>".$truck_id."</tid_container>
				<customer_id>".$customer_id."</customer_id>
				<no_container>".$no_container."</no_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		// print_r($in_data);
		// die();

		
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"checkTCAEserviceM2m",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					// print_r($result);
					// die();
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					// die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "NO,".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}
	}
	else{
					
		$stack = array();
		//$address = base64_encode($address);
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_req>".$no_request."</no_req>
				<port_code>".$terminal[0]."</port_code>
				<modul_desc>".$type."</modul_desc>
				<terminal_code>".$terminal[1]."</terminal_code>
				<tid_container>".$truck_id."</tid_container>
				<customer_id>".$customer_id."</customer_id>
				<no_container>".$no_container."</no_container>
				<pin_number>".$pin_number."</pin_number>
			</data>
		</root>";
		//print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"checkTCAContainer",array("in_data" => "$in_data"),$result))
				{
					log_message('debug',$result);
					echo $result;
					die;
				}
				else
				{
					// print_r($result);
					// die();
					log_message('debug', '--4--'.$result);
					echo $result;
					return;
					// die;
					
					$obj = json_decode($result);
					
					if($obj->rc!="S")
					{
						echo "".$obj->rcmsg;
					}
					else if($obj->data->info)
					{
						echo($obj->data->info);
					} else {
						echo "NO,GAGAL";
					}
				}	
		
			
		}
	}
	public function truck_monitoring(){


	$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
	$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
	$this->breadcrumbs->push("Truck ID Monitoring", '/');
	$this->breadcrumbs->unshift('Home', '/');
	$data['breadcrumbs'] = $this->breadcrumbs->show();

	$data['title']= "TRUCK MONITORING";

	$this->common_loader($data,'pages/container/truck_monitoring');
	}
	
	
	public function auto_truck_monitoring() {

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$truck_id			= $_GET["truck_id"];
		$port			= explode("-",$_GET["port"]);

		$stack = array();
		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<truck_id>$truck_id</truck_id>
				<port_code>".$port[2]."</port_code>
				<terminal_code>".$port[3]."</terminal_code>
			</data>
		</root>";
		// injek($in_data);
		//print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getTruckMonitoring",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{

			// echo $result;die;
			$obj = json_decode($result);
			if($obj->data->container)
			{
					// print_r($obj->data->container);
					// die();
					foreach ($obj->data->container as $key => $value) {
							# code...
						if($value->status == 'F'){
							$status = 'TCA Finished';
						} else if($value->status == 'C'){
							$status = 'TCA Cancelled';
						} else if($value->status == 'R'){
							$status = 'Truck Associated';
						} else if($value->status == 'P'){
							$status = 'Truck On Terminal Job';
						} else{
							$status = $value->status;
						}
						$temp['TRUCK_ID']=$value->truck_id;
						$temp['STATUS']=$status;
						$temp['NO_CONTAINER']=$value->no_container;
						if(!empty($value->no_request_eservice)){
							$temp['NO_REQUEST']=$value->no_request. "<br />Req Eservice : (".$value->no_request_eservice.")";
						}else{
							$temp['NO_REQUEST']=$value->no_request;
						}
						array_push($stack, $temp);
					}	
					// print_r(json_encode($stack));
					// die();
			}
			else
			{
				$in_data="	<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<tid>$truck_id</tid>
						<port_code>".$port[2]."</port_code>
						<terminal_code>".$port[3]."</terminal_code>
					</data>
				</root>";
				if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getEditTID",array("in_data" => "$in_data"),$results))
				{
					echo $results;
					die;
				}
				else
				{
					$datas = json_decode($results);
					// $stack = array();
					if(is_numeric($truck_id)){
						$truck_id=$truck_id;
					}else{
						$truck_id="";
					}
					if(count($datas->data->request) > 0){						
						$temp['TRUCK_ID']=$truck_id;
						$temp['STATUS']='TRUCK TERSEDIA';
						$temp['NO_CONTAINER1']='';
						$temp['NO_CONTAINER2']='';
						$temp['NO_REQUEST']='';
						array_push($stack, $temp);
					}else{						
						$temp['TRUCK_ID']=$truck_id;
						$temp['STATUS']='TRUCK TIDAK TERDAFTAR';
						$temp['NO_CONTAINER1']='';
						$temp['NO_CONTAINER2']='';
						$temp['NO_REQUEST']='';
						array_push($stack, $temp);	
					}
				}
			}
		}
		
		$data['container'] = $stack;
		$this->load->library("table");
		$this->table->set_heading(
				'Truck ID',
				'Container',
				'No Request',
				'Status'
			);
			
			
			foreach ($stack as $key => $value) {
				if ($value['STATUS'] == 'P' or $value['STATUS'] == 'R'){
					$value['STATUS'] = "TRUCK SUDAH DIASOSIASI";
				}
				$this->table->add_row(
					$value['TRUCK_ID'],
					$value['NO_CONTAINER'],
					$value['NO_REQUEST'],
					$value['STATUS']
				);
			}
			
			
		$this->load->view('pages/container/table_truck_monitoring',$data);
	}

	public function view_truck($tid,$port1,$port2)
		{
			$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));		
			
			$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
			//print_r($reqNoBiller);die;

			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<tid>$tid</tid>
					<port_code>".$port1."</port_code>
					<terminal_code>".$port2."</terminal_code>
				</data>
			</root>";
			//print_r($in_data);die;
			if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getEditTID",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				// echo $result;die;
				$obj = json_decode($result);
				//var_dump($obj); die;
				if($obj->data->request)
				{
					//--------------------------------------------

					$data['request_data'][0]['TID'] = $obj->data->request[0]->tid;
					$data['request_data'][0]['TRUCK_NUMBER'] = $obj->data->request[0]->truck_number;
					$data['request_data'][0]['REGISTRANT_NAME'] = $obj->data->request[0]->registrant_name;
					$data['request_data'][0]['REGISTRANT_PHONE'] = $obj->data->request[0]->registrant_phone;	
					$data['request_data'][0]['COMPANY_NAME'] = $obj->data->request[0]->company_name;
					$data['request_data'][0]['COMPANY_ADDRESS'] = $obj->data->request[0]->company_address;	
					$data['request_data'][0]['COMPANY_PHONE'] = $obj->data->request[0]->company_phone;
					$data['request_data'][0]['EMAIL'] = $obj->data->request[0]->email;
					$data['request_data'][0]['KIU'] = $obj->data->request[0]->kiu;
					$data['request_data'][0]['EXPIRED_KIU'] = $obj->data->request[0]->expired_kiu;
					$data['request_data'][0]['NO_STNK'] = $obj->data->request[0]->no_stnk;
					$data['request_data'][0]['EXPIRED_STNK'] = $obj->data->request[0]->expired_stnk;
					$data['request_data'][0]['EXPIRED_DATE'] = $obj->data->request[0]->expired_date;
					$data['request_data'][0]['RFID_CODE'] = $obj->data->request[0]->rfid_code;		
					$data['request_data'][0]['ASSOCIATION_COMPANY'] = $obj->data->request[0]->association_company;	
				}
			}
			$this->load->view('pages/container/view_tid',$data);
			// $this->common_loader($data,'pages/container/view_tid');
		}
		
	//function untuk print TID
	public function print_tid($tid,$port1,$port2){
		
		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));		
		
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		//print_r($reqNoBiller);die;

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<tid>$tid</tid>
				<port_code>".$port1."</port_code>
				<terminal_code>".$port2."</terminal_code>
			</data>
		</root>";
		//print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(TRUCK_CONTAINER,"getEditTID",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//var_dump($obj); die;
			if($obj->data->request)
			{
				//--------------------------------------------

				$data['request_data'][0]['TID'] = $obj->data->request[0]->tid;
				$data['request_data'][0]['TRUCK_NUMBER'] = $obj->data->request[0]->truck_number;
				$data['request_data'][0]['REGISTRANT_NAME'] = $obj->data->request[0]->registrant_name;
				$data['request_data'][0]['REGISTRANT_PHONE'] = $obj->data->request[0]->registrant_phone;	
				$data['request_data'][0]['COMPANY_NAME'] = $obj->data->request[0]->company_name;
				$data['request_data'][0]['COMPANY_ADDRESS'] = $obj->data->request[0]->company_address;	
				$data['request_data'][0]['COMPANY_PHONE'] = $obj->data->request[0]->company_phone;
				$data['request_data'][0]['EMAIL'] = $obj->data->request[0]->email;
				$data['request_data'][0]['KIU'] = $obj->data->request[0]->kiu;
				$data['request_data'][0]['EXPIRED_KIU'] = $obj->data->request[0]->expired_kiu;
				$data['request_data'][0]['NO_STNK'] = $obj->data->request[0]->no_stnk;
				$data['request_data'][0]['EXPIRED_STNK'] = $obj->data->request[0]->expired_stnk;
				$data['request_data'][0]['EXPIRED_DATE'] = $obj->data->request[0]->expired_date;
				$data['request_data'][0]['RFID_CODE'] = $obj->data->request[0]->rfid_code;		
				$data['request_data'][0]['ASSOCIATION_COMPANY'] = $obj->data->request[0]->association_company;	
			}
		}
		// // print_r($port2);
		// // die();
		// $data['message'] = $message;

		// $data['terminal'] = $this->master_model->get_terminal();

		// $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		// $this->breadcrumbs->push("TID Registration", 'truck_container/create_truck_registration');
		// $this->breadcrumbs->push("Print TID", '/');
		// $this->breadcrumbs->unshift('Home', '/');
		// $data['breadcrumbs'] = $this->breadcrumbs->show();
		// $data['port1'] = $port1;
		// $data['port2'] = $port2;
		
		// $data['title']= "Print TID";
		// $this->common_loader($data,'pages/container/views_print');


		// *************************************************
		$this->print_tid_card($data['request_data'][0]['TID'], $data['request_data'][0]['TRUCK_NUMBER'], $data['request_data'][0]['RFID_CODE']);

	}
	
	public function print_tid_card($tid, $nopol, $rfid) {
		$this->load->helper('pdf_helper');
		tcpdf();

		// create new PDF document
		$pageLayout = array(85, 55); //  or array($height, $width) 
		$pdf = new TCPDF('L', 'mm', $pageLayout, true, 'UTF-8', false);
		// $pdf = new TCPDF('L', 'mm', 'A7', true, 'UTF-8', false);

		// set header and footer fonts
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(3, 4, 0);
		//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->setPrintHeader(false);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 10);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		$pdf->setLanguageArray(null);

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
			'fontsize' => 4,
			'stretchtext' => 4
		);

		$pdf->AddPage();
		// set font
		$pdf->SetFont('helvetica', 'B', 13);
		$pdf->setPage(1);

		$pdf->Cell( 80, 18.5, '', 0, 1, 'R');
		$pdf->Cell( 80, 5, '', 0, 1, 'R');
		// $pdf->Cell( 80, 5, $tid, 0, 1, 'R');
		$pdf->Cell( 80, 9, $tid, 0, 1, 'R');
		$pdf->Cell( 80, 5, $nopol, 0, 1, 'R');

		$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
		$pdf->SetFont('helvetica', 'B', 9);
		//Close and output PDF document
		$pdf->Output($_SERVER['DOCUMENT_ROOT']."/ibis/attachment/$tid.pdf", 'I');
	}
	
}