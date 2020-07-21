<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Container_alihkapal extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->model('master_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('ciqrcode');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		require_once(APPPATH.'libraries/htmLawed.php');
		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		$this->load->model('auth_model','auth_model');
		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');

	}

	public function common_loader($data,$views){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

    public function index(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }
    }

    public function main_alihkapal(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $agent_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');

        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
				<agent_id>$agent_id</agent_id>
				<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
				<param>param</param>
            </data>
        </root>";
// echo $in_data;die();
		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getListRequestBMCompressed",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die();
			$obj = json_decode($result);
			if($obj->data->listrequest){
				for($i=0;$i<count($obj->data->listrequest);$i++)
				{
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$obj->data->listrequest[$i]->no_request.'");\'><i class=\'fa fa-eye\'></i></a>';
					$confirm_link='<span class="label label-default">N/A</span>';
					if($obj->data->listrequest[$i]->statusreq=="N"){
					$label_span='<span class="label label-info">Draft</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_alihkapal/edit_alihkapal/".$obj->data->listrequest[$i]->no_request."/".$obj->data->listrequest[$i]->port_id."/".$obj->data->listrequest[$i]->terminal_id.'/E"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->listrequest[$i]->no_request.'");\'><i class=\'fa fa-save\'></i></a>';
					} else if($obj->data->listrequest[$i]->statusreq=="S"){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
						$edit_link='';

					} else if($obj->data->listrequest[$i]->statusreq=="W"){
						$label_span='<span class="label label-warning">Waiting Approve</span>';
						$edit_link='';

					}else if($obj->data->listrequest[$i]->statusreq=="R"){
						$label_span='<span class="label label-danger" title="'.$obj->data->listrequest[$i]->reject_notes.'">Rejected</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_alihkapal/edit_alihkapal/".$obj->data->listrequest[$i]->no_request."/".$obj->data->listrequest[$i]->port_id."/".$obj->data->listrequest[$i]->terminal_id.'/E"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->listrequest[$i]->no_request.'");\'><i class=\'fa fa-save\'></i></a>';

					}else if($obj->data->listrequest[$i]->statusreq=="P" || $datareq[$i]['STATUS_REQ']=="T"){
						$label_span='<span class="label label-success">Paid</span>';
						$edit_link='';
					} else {
						$label_span='<span class="label label-default">N/A</span>';
						$edit_link='';
					}

					$this->table->add_row(
												$i+1,
												$obj->data->listrequest[$i]->no_request,
												$obj->data->listrequest[$i]->tgl_req,
												$label_span,
												$obj->data->listrequest[$i]->vessel.'/'.$obj->data->listrequest[$i]->voyin.'-'.$obj->data->listrequest[$i]->voyout,
												$obj->data->listrequest[$i]->port_id . " / ". $obj->data->listrequest[$i]->terminal_id,
												$obj->data->listrequest[$i]->tipebm,
												$obj->data->listrequest[$i]->jml_cont,
												$view_link,
												$edit_link,
												$confirm_link
											);
				}
			}
		}

        $data = '';
        $this->table->set_heading('No',
									"Request Number",
									"Request Date",
									"Status",
									"Vessel - Voyage",
									"POL / Terminal",
									"Tipe BM",
									"Quantity",
									'View',
									'Edit',
                                    "Request Confirm");

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Loading Cancel Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Loading Cancel Booking";

		$this->common_loader($data,'pages/container/main_alihkapal');

    }

    public function add_alihkapal(){
         if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $data = '';

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Loading Cancel Request", 'container_alihkapal/main_alihkapal');
		$this->breadcrumbs->push("Create Request", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Create New Loading Cancel Request";

		$this->common_loader($data,'pages/container/add_alihkapal');
    }

    public function submit_alihkapal() {

        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $port = explode("-",htmLawed($_POST["port"]));
		    $tipebm = htmLawed($_POST['tipebm']);
        $vessel_name = htmLawed($_POST['vessel']);
        $voyage_in = htmLawed($_POST['voyage_in']);
        $voyage_out = htmLawed($_POST['voyage_out']);
		    $etd = htmLawed($_POST['etd']);
        $shipping_line = htmLawed($_POST['shipping_line']);

		    $pod = htmLawed($_POST['pod_name']);
        $id_pod = htmLawed($_POST['pod']);
        $fpod = htmLawed($_POST['fpod_name']);
        $id_fpod = htmLawed($_POST['fpod']);
        $booknum = htmLawed($_POST['booking_numb']);

    		$tgl_del = htmLawed($_POST['tgldel']);
    		$nosuratjalan = htmLawed($_POST['nosuratjalan']);
			$peb = htmLawed($_POST['peb_no']);
			$npe = htmLawed($_POST['npe_no']);

        $no_ukk_baru = htmLawed($_POST['ukk']);
    		$vesselcode = htmLawed($_POST['vesselcode']);
    		$callsign = htmLawed($_POST['callsign']);

    		$customer_id = $this->session->userdata('custid_phd');
    		$submitter_customer_id = $this->session->userdata('customeridppjk_phd');
    		$customer_name = $this->session->userdata('customername_phd');
        $cust_alamat = $this->session->userdata('address_phd');
        $cust_npwp = $this->session->userdata('npwp_phd');
        $ship_line=htmLawed($_POST["ship_line"]);

		//validasi booking number
		$validStatus=$this->container_model->getValidBookNo(trim($booknum));
		if($validStatus==0)
		{
			echo ",Booking Number Not Found,";die;
		}

		//declare form validation pemesanan alih kapal domestik default
		$config = array(
			array(
				'field' => 'port',
				'label' => 'Terminal',
				'rules' => 'required'
			),
			array(
				'field' => 'tipebm',
				'label' => 'Type Of Loading Cancel',
				'rules' => 'required'
			),
			array(
				'field' => 'vessel',
				'label' => 'Vessel',
				'rules' => 'required'
			),
			array(
				'field' => 'voyage_in',
				'label' => 'Voyage In',
				'rules' => 'required'
			),
			array(
				'field' => 'voyage_out',
				'label' => 'Voyage Out',
				'rules' => 'required'
			),
			array(
				'field' => 'pod',
				'label' => 'Port Of Destination (POD)',
				'rules' => 'required'
			),
			array(
				'field' => 'fpod',
				'label' => 'Final Port (FPOD)',
				'rules' => 'required'
			),
			array(
				'field' => 'booking_numb',
				'label' => 'Booking Number',
				'rules' => 'required'
			)
		);
		
		//declare form validation pemesanan penerimaan internasional panjang
			$pnji = array(
				array(
					'field' => 'peb_no',
					'label' => 'PEB Number',
					'rules' => 'required'
				),
				array(
					'field' => 'npe_no',
					'label' => 'NPE Number',
					'rules' => 'required'
				)
			);
		//tambahan config form validation pemesanan alih kapal ketika terminal domestik 009
		$domestik009 = array(

				'field' => 'nosuratjalan',
				'label' => 'No Surat Jalan',
				'rules' => 'required'

		);

		//tambahan config form validation pemesanan alih kapal ketika tipe muat delivery
		$delivery = array(
				'field' => 'tgldel',
				'label' => 'Delivery Date',
				'rules' => 'required'
			);

		if($this->input->post()) {
			if($port[1] == 'T009D') {
				foreach($domestik009 as $config_domestik009) {
					array_push($config, $config_domestik009);
				}
			} else if(($port[1] == 'PNJI') AND (($tipebm == 'CALBG') OR (($tipebm == 'CALAG')))) {
				foreach($pnji as $config_pnji) {
					array_push($config, $config_pnji);
				}
			}else if($port[1] == 'PNJD') {
				foreach($domestik009 as $config_domestik009) {
					array_push($config, $config_domestik009);
				}
			} else if($tipebm == 'CALDG') {
				array_push($config, $delivery);
			}

			$this->form_validation->set_rules($config); //setting rules inputan pemesanan alih kapal

			//insert header
			if($this->form_validation->run() == false) {
				echo 'salah';
			} else {

				$uname_phd=$this->session->userdata('uname_phd');
				if($port[0]=="IDTLB" || $port[0]=="IDDJB"){
					$cekpaid_data = "<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<detail>
							<booknum>$booknum</booknum>
							<port_code>".$port[0]."</port_code>
							<terminal_code>".$port[1]."</terminal_code>
							<uname_phd>".$this->session->userdata('userid_simop')."</uname_phd>
							<uname_eservice>".$this->session->userdata('uname_phd')."</uname_eservice>
						</detail>
					</data>
				</root>";
			    //echo $cekpaid_data;die;

				injek($cekpaid_data);
				if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"checkPaymentReceivingNumber",array("in_param" => "$cekpaid_data"),$result))
				{
					//echo 'submitRequestBatalmuat'.$result;
					log_message('debug', $result);
					// die;
				}
				else
				{
					$obj_check_payment = json_decode($result);
					//echo $obj_check_payment;die;
					if(isset($obj_check_payment->data->data))
					{
						$pay_status = $obj_check_payment->data->data;
						//echo $pay_status;die;
						if ($pay_status==='P')
						{
							$in_data="<root>
								<sc_type>1</sc_type>
								<sc_code>123456</sc_code>
								<data>
									<detail>
										<vessel>$vessel_name</vessel>
										<voyage_in>$voyage_in</voyage_in>
										<voyage_out>$voyage_out</voyage_out>
										<fpod>$fpod</fpod>
										<id_fpod>$id_fpod</id_fpod>
										 <pod>$pod</pod>
										<id_pod>$id_pod</id_pod>
										<booknum>$booknum</booknum>
										<customer_id>$customer_id</customer_id>
										<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
										<shipping_line>$shipping_line</shipping_line>
										<etd>$etd</etd>
										<customer_name>$customer_name</customer_name>
										<cust_alamat>$cust_alamat</cust_alamat>
										<cust_npwp>$cust_npwp</cust_npwp>
										<no_ukk_baru>$no_ukk_baru</no_ukk_baru>
										<port_code>".$port[0]."</port_code>
										<terminal_code>".$port[1]."</terminal_code>
										 <tipebm>$tipebm</tipebm>
										  <tgl_delivery>$tgl_del</tgl_delivery>
										   <nosuratjalan>$nosuratjalan</nosuratjalan>
										   <peb>$peb</peb>
										   <npe>$npe</npe>
										   <callsign>$callsign</callsign>
										  <vesselcode>$vesselcode</vesselcode>
										  <ship_line>$ship_line</ship_line>
										  <uname_phd>".$this->session->userdata('userid_simop')."</uname_phd>
										  <uname_eservice>".$this->session->userdata('uname_phd')."</uname_eservice>
									</detail>
								</data>
							</root>";
							injek($in_data);
					// echo $in_data; die();
							if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"submitRequestBatalmuat",array("in_data" => "$in_data"),$result))
							{
								// echo 'submitRequestBatalmuat'.$result;
								log_message('debug', $result);
								// die;
							}
							else
							{
								 //echo  'submitRequestBatalmuat'.$result;die();
								$obj = json_decode($result);
								// print_r($obj);
								if(isset($obj->data->data))
								{
									//echo $obj->data->data;die;
									$datax = $obj->data->data;
									$data = explode(",",$datax);
									$request_no = $data[1];
									//insert detail
									$in_data2="<root>
										<sc_type>1</sc_type>
										<sc_code>123456</sc_code>
										<data>
											<detail>
												<port_code>".$port[0]."</port_code>
												<terminal_code>".$port[1]."</terminal_code>
												<tipebm>$tipebm</tipebm>
												<vessel>$vessel_name</vessel>
												<voyin>$voyage_in</voyin>
												<request_no>$booknum</request_no>
											</detail>
										</data>
									</root>";
						// echo $in_data2;die();
									if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"autoContainerBatalmuatAll",array("in_data" => "$in_data2"),$result))
									{
										// echo 'autoContainerBatalmuatAll'.$result;
										die;
									}
									else
									{
										// echo 'autoContainerBatalmuatAll'.$result; die();
										$obj2 = json_decode($result);
						  // echo $obj2; die();
										if($obj2->data->container)
										{
											// $reslt=array();
											for($i=0;$i<count($obj2->data->container);$i++)
											{
												$nocontainer=$obj2->data->container[$i]->no_container;
												$size=$obj2->data->container[$i]->size_cont;
												$type=$obj2->data->container[$i]->type_cont;
												$status=$obj2->data->container[$i]->status;
												$height=$obj2->data->container[$i]->height;
												$hz=$obj2->data->container[$i]->hz;
												//$temp['KD_BARANG']=$obj2->data->container[$i]->kd_barang;
												$ukk_old=$obj2->data->container[$i]->no_ukk;

												$reqNoBiller=$this->container_model->getNumberRequestBiller($request_no);

												$in_data3="<root>
													<sc_type>1</sc_type>
													<sc_code>123456</sc_code>
													<data>
														<detail>
															<request_no>$request_no</request_no>
															<ukk_old>$ukk_old</ukk_old>
															<ukk_new>$no_ukk_baru</ukk_new>
															<container>$nocontainer</container>
															<size>$size</size>
															<type>$type</type>
															<status>$status</status>
															<height>$height</height>
															<hz>$hz</hz>
															<etd>$etd</etd>
															<port>$port</port>
															<port_code>".$port[0]."</port_code>
															<terminal_code>".$port[1]."</terminal_code>
															<reqNoBiller>$reqNoBiller</reqNoBiller>
															<vessel>$vessel_name</vessel>
															<voyage_in>$voyage_in</voyage_in>
															<voyage_out>$voyage_out</voyage_out>
														</detail>
													</data>
												</root>";
							  					//echo $in_data3; die();
												if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"AddContainerBM",array("in_data" => "$in_data3"),$result))
												{
													 echo $result;
													 die;
												}
												else
												{
												   // echo  $result;die();
													$obj3 = json_decode($result);
													// array_push($reslt,$obj3);
													//echo $obj3;die;
													if($obj3->data->data == 'OK')
													{
														//echo $obj3->data->data;
														echo $obj->data->data;
													} else {
														echo "NO,GAGAL:".$obj3->data->data;
													}
												}
											}
											// print_r($reslt);die;
										}
									}
									//insert detail

								} else {
									echo "NO,GAGAL:".$obj->rcmsg;
								}
							}
						} else {
							echo "NO,Your receiving number '".$booknum."' still not paid !";
						}
					}
				}
			}else{
				//selain teluk bayur & jambi
						$in_data="<root>
									<sc_type>1</sc_type>
									<sc_code>123456</sc_code>
									<data>
										<detail>
											<vessel>$vessel_name</vessel>
											<voyage_in>$voyage_in</voyage_in>
											<voyage_out>$voyage_out</voyage_out>
											<fpod>$fpod</fpod>
											<id_fpod>$id_fpod</id_fpod>
											 <pod>$pod</pod>
											<id_pod>$id_pod</id_pod>
											<booknum>$booknum</booknum>
											<customer_id>$customer_id</customer_id>
											<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
											<shipping_line>$shipping_line</shipping_line>
											<etd>$etd</etd>
											<customer_name>$customer_name</customer_name>
											<cust_alamat>$cust_alamat</cust_alamat>
											<cust_npwp>$cust_npwp</cust_npwp>
											<no_ukk_baru>$no_ukk_baru</no_ukk_baru>
											<port_code>".$port[0]."</port_code>
											<terminal_code>".$port[1]."</terminal_code>
											 <tipebm>$tipebm</tipebm>
											  <tgl_delivery>$tgl_del</tgl_delivery>
											   <nosuratjalan>$nosuratjalan</nosuratjalan>
											   <peb>$peb</peb>
											   <npe>$npe</npe>
											   <callsign>$callsign</callsign>
											  <vesselcode>$vesselcode</vesselcode>
											  <ship_line>$ship_line</ship_line>
											  <uname_phd>".$this->session->userdata('userid_simop')."</uname_phd>
											  <uname_eservice>".$this->session->userdata('uname_phd')."</uname_eservice>
										</detail>
									</data>
								</root>";
								injek($in_data);
						// echo $in_data; die();
								if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"submitRequestBatalmuat",array("in_data" => "$in_data"),$result))
								{
									// echo 'submitRequestBatalmuat'.$result;
									log_message('debug', $result);
									// die;
								}
								else
								{
									// echo  'submitRequestBatalmuat'.$result;die();
									$obj = json_decode($result);
									// print_r($obj);
									if(isset($obj->data->data))
									{
										//echo $obj->data->data;die;
										$datax = $obj->data->data;
										$data = explode(",",$datax);
										$request_no = $data[1];
										//insert detail
										$in_data2="<root>
											<sc_type>1</sc_type>
											<sc_code>123456</sc_code>
											<data>
												<detail>
													<port_code>".$port[0]."</port_code>
													<terminal_code>".$port[1]."</terminal_code>
													<tipebm>$tipebm</tipebm>
													<vessel>$vessel_name</vessel>
													<voyin>$voyage_in</voyin>
													<request_no>$booknum</request_no>
												</detail>
											</data>
										</root>";
							// echo $in_data2;die();
										if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"autoContainerBatalmuatAll",array("in_data" => "$in_data2"),$result))
										{
											// echo 'autoContainerBatalmuatAll'.$result;
											die;
										}
										else
										{
											//echo 'autoContainerBatalmuatAll'.$result; die();
											$obj2 = json_decode($result);
							  // echo $obj2; die();
											if($obj2->data->container)
											{
												// $reslt=array();
												for($i=0;$i<count($obj2->data->container);$i++)
												{
													$nocontainer=$obj2->data->container[$i]->no_container;
													$size=$obj2->data->container[$i]->size_cont;
													$type=$obj2->data->container[$i]->type_cont;
													$status=$obj2->data->container[$i]->status;
													$height=$obj2->data->container[$i]->height;
													$hz=$obj2->data->container[$i]->hz;
													//$temp['KD_BARANG']=$obj2->data->container[$i]->kd_barang;
													$ukk_old=$obj2->data->container[$i]->no_ukk;

													$reqNoBiller=$this->container_model->getNumberRequestBiller($request_no);

													$in_data3="<root>
														<sc_type>1</sc_type>
														<sc_code>123456</sc_code>
														<data>
															<detail>
																<request_no>$request_no</request_no>
																<ukk_old>$ukk_old</ukk_old>
																<ukk_new>$no_ukk_baru</ukk_new>
																<container>$nocontainer</container>
																<size>$size</size>
																<type>$type</type>
																<status>$status</status>
																<height>$height</height>
																<hz>$hz</hz>
																<etd>$etd</etd>
																<port>$port</port>
																<port_code>".$port[0]."</port_code>
																<terminal_code>".$port[1]."</terminal_code>
																<reqNoBiller>$reqNoBiller</reqNoBiller>
																<vessel>$vessel_name</vessel>
																<voyage_in>$voyage_in</voyage_in>
																<voyage_out>$voyage_out</voyage_out>
															</detail>
														</data>
													</root>";
								  					//echo $in_data3; die();
													if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"AddContainerBM",array("in_data" => "$in_data3"),$result))
													{
														 echo $result;
														 die;
													}
													else
													{
													    //echo  $result;die();
														$obj3 = json_decode($result);
														// array_push($reslt,$obj3);
														//echo $obj3;die;
														if($obj3->data->data == 'OK')
														{
															//echo $obj3->data->data;
															echo $obj->data->data;
														} else {
															echo "NO,GAGAL:".$obj3->data->data;
														}
													}
												}
												
											}else{

												$del_transaction_log = $this->container_model->deleteTransactionLogLoadingCancel($request_no); //dell transaction log saat gagal submit loading cancel berdasarkan reuest id

												echo "NO,GAGAL: NO REQUEST RECEIVING BELUM MELAKUKAN PEMBAYARAN ATAU SUDAH DIPAKAI SEBELUMNYA <br />
												- ATAU CEK HOLD CONTAINER 
												";
											}
										}
										//insert detail

									} else {
										echo "NO,GAGAL:".$obj->rcmsg;
									}
								}
				}
				
			}
		}
    }

    public function autoContainer(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $port = explode("-",htmLawed($_GET["port"]));
        $no_container = htmLawed($_GET["term"]);
		$tipebm = htmLawed($_GET["tipebm"]);
		$vessel = htmLawed($_GET["vessel"]);
		$voyin = htmLawed($_GET["voyin"]);
		$noreq = htmLawed($_GET["no_request"]);

        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <detail>
                    <no_container>$no_container</no_container>
                    <port_code>".$port[0]."</port_code>
                    <terminal_code>".$port[1]."</terminal_code>
					<tipebm>$tipebm</tipebm>
					<vessel>$vessel</vessel>
					<voyin>$voyin</voyin>
					<no_request>$noreq</no_request>
                </detail>
            </data>
        </root>";

		$stack = array();
		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"autoContainerBatalmuat",array("in_data" => "$in_data"),$result))
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
					$temp['NO_CONTAINER']=$obj->data->container[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->container[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->container[$i]->type_cont;
					$temp['STATUS']=$obj->data->container[$i]->status;
					$temp['HEIGHT']=$obj->data->container[$i]->height;
					$temp['HZ']=$obj->data->container[$i]->hz;
					$temp['KD_BARANG']=$obj->data->container[$i]->kd_barang;
					$temp['NO_UKK']=$obj->data->container[$i]->no_ukk;
					array_push($stack, $temp);
				}
			}
			echo json_encode($stack);
		}
    }

    public function addcontainerBM(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

		$port 		= explode("-",htmLawed($_POST["port"]));
		$request_no = htmLawed($_POST['request_no']);
        $ukk_old 	= htmLawed($_POST['ukk_old']);
		$ukk_new 	= htmLawed($_POST['ukk_new']);
		$container	= htmLawed($_POST['container_no']);
		$size 		= htmLawed($_POST['container_size']);
		$type 		= htmLawed($_POST['container_type']);
		$status 	= htmLawed($_POST['container_status']);
		$height 	= htmLawed($_POST['container_height']);
		$hz 		= htmLawed($_POST['hz']);
		$etd 		= htmLawed($_POST['etd']);

		$reqNoBiller=$this->container_model->getNumberRequestBiller($request_no);

        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <detail>
                    <request_no>$request_no</request_no>
                    <ukk_old>$ukk_old</ukk_old>
                    <ukk_new>$ukk_new</ukk_new>
                    <container>$container</container>
                    <size>$size</size>
                    <type>$type</type>
                    <status>$status</status>
					<height>$height</height>
                    <hz>$hz</hz>
                    <etd>$etd</etd>
                    <port>$port</port>
					<port_code>".$port[0]."</port_code>
                    <terminal_code>".$port[1]."</terminal_code>
					 <reqNoBiller>$reqNoBiller</reqNoBiller>
                </detail>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"AddContainerBM",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo  $result;die();
			$obj = json_decode($result);
			//echo $obj;die;
			if($obj->data->data == 'OK')
			{
				echo $obj->data->data;
			} else {
				echo "NO,GAGAL:".$obj->data->data;
			}
		}
    }

    public function getListContainer($request_no, $portid, $terminal, $type){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $data = '';
        $this->table->set_heading('No',/*'Act',*/'No Container','Size','Type','Status','Kd Brg','Hz','Tgl Stack','Tgl Departure');

		    $reqNoBiller=$this->container_model->getNumberRequestBiller($request_no);

        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                    <norequest>$reqNoBiller</norequest>
					          <port_code>$portid</port_code>
					          <terminal_code>$terminal</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getListContainerBM",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo  $result;die;

			$obj = json_decode($result);
			 if($obj->data->listcont){
				for($i=0;$i<count($obj->data->listcont);$i++)
				{
					$view_link='<a class=\'btn btn-primary\'
          onclick=\'del_cont("'.$request_no.'","'.$obj->data->listcont[$i]->no_container.'","'.$portid.'","'.$terminal.'")\' >
          <i class=\'fa fa-trash-o\'></i></a>';
					$this->table->add_row(
						$i+1,
						$view_link,
						$obj->data->listcont[$i]->no_container,
						$obj->data->listcont[$i]->size_cont,
						$obj->data->listcont[$i]->type_cont,
						$obj->data->listcont[$i]->status_cont,
						$obj->data->listcont[$i]->id_cont,
						$obj->data->listcont[$i]->hz,
						$obj->data->listcont[$i]->tgl_stack,
						$obj->data->listcont[$i]->tgl_departure
					);
				}
			}
		}

		if ($type=="E"){
			//create table
			$this->table->set_heading('No',
			  'Delete',
			  'Container Number',
			  'Size',
			  'Type',
			  'Status',
			  'Id Cont',
			  'HZ',
			  'Stacking Date',
			  'Time Of Departure'
			 );
		} else {
			//create table
			$this->table->set_heading('No',
			  'Container Number',
			  'Size',
			  'Type',
			  'Status',
			  'Id Cont',
			  'HZ',
			  'Stacking Date',
			  'Time Of Departure'
			 );
		}

		$data['type']=$type;
		$this->load->view('pages/container/get_detail_alihkapal', $data);

    }

    public function delete_container(){
        //echo "string"; die();
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }
        $nocont = htmLawed($_POST['nocont']);
        $idreq = htmLawed($_POST['id_req']);
        $port = htmLawed($_POST['port']);
        $terminal = htmLawed($_POST['terminal']);
        $reqNoBiller=$this->container_model->getNumberRequestBiller($idreq);
        try{
        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <detail>
                    <no_container>$nocont</no_container>
                    <id_req>$reqNoBiller</id_req>
                    <port>$port</port>
                    <terminal>$terminal</terminal>
                </detail>
            </data>
        </root>";
        // echo $in_data; die;
        if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"delDetailContainerBM",array("in_data" => "$in_data"),$result))
  			{
  				echo $result;
  				die;
  			}
  			else
  			{
  				echo $result;
  			}

      } catch (Exception $e) {
        echo "NO,GAGAL";
      }

    }

    public function edit_alihkapal($noreq, $portid, $terminal, $tipe){

		$reqNoBiller=$this->container_model->getNumberRequestBiller($noreq);
		$data = '';
        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                    <request_id>$reqNoBiller</request_id>
					<port_code>$portid</port_code>
					<terminal_code>$terminal</terminal_code>
            </data>
        </root>";
    // echo $in_data; die();
		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getRequestBM",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			if($obj->data->request)
			{
				$data['request_data'][0]['ID_REQ'] = $obj->data->request[0]->id_req;
				$data['request_data'][0]['ID_REQ_IBIS'] = $noreq;
				$data['request_data'][0]['VESSEL'] = $obj->data->request[0]->vessel;
				$data['request_data'][0]['VOYIN'] = $obj->data->request[0]->voyin;
				$data['request_data'][0]['VOYOUT'] = $obj->data->request[0]->voyout;
				$data['request_data'][0]['BOOKINGNUMB'] = $obj->data->request[0]->bookingnum;
				$data['request_data'][0]['SHIPPING'] = $obj->data->request[0]->shipping;
				$data['request_data'][0]['FPOD'] = $obj->data->request[0]->fpod;
				$data['request_data'][0]['IDFPOD'] = $obj->data->request[0]->idfpod;
				$data['request_data'][0]['UKK'] = $obj->data->request[0]->ukk;
				$data['request_data'][0]['ID_PORT'] = $portid;
				$data['request_data'][0]['ID_TERMINAL'] = $terminal;
				$data['request_data'][0]['ETA'] = $obj->data->request[0]->eta;
				$data['request_data'][0]['ETD'] = $obj->data->request[0]->etd;
				$data['request_data'][0]['TIPE'] = $tipe;
				$data['request_data'][0]['TERMINAL_NAME'] =  $obj->data->request[0]->term_name;
				$data['request_data'][0]['NO_SURATJALAN'] =  $obj->data->request[0]->nosrtjln;
				$data['request_data'][0]['NO_SPP'] =  $obj->data->request[0]->nospp;
				$data['request_data'][0]['TGL_DEL'] =  $obj->data->request[0]->tgldel;
				$data['request_data'][0]['TIPEBM'] =  $obj->data->request[0]->tipebm;
			}
		}

		$data['terminal'] = $this->master_model->get_terminal();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("View Request", 'container_alihkapal/main_alihkapal');
		$this->breadcrumbs->push("View Request", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "View Loading Cancel Request";

		$this->common_loader($data,'pages/container/edit_alihkapal');
    }

	public function save_request_alihkapal(){
		$no_request	= htmLawed($_POST["request_no"]);
		$port		= explode("-",htmLawed($_POST["port"]));

		$stack = array();
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);

        $in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<biller_request_id>$reqNoBiller</biller_request_id>
						<port_code>".$port[0]."</port_code>
						<terminal_code>".$port[1]."</terminal_code>
					</data>
				</root>";
		//echo $in_data;die;		
		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getCountContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->rc!="S")
			{
				echo $result;
				die;
			}
		}

		//no error
		// port code : IDJKT, IDPNK
		// terminal code :  T3I,T3D,T2D,T1D
		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$reqNoBiller</no_request>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
				<user_id>".$this->session->userdata('uname_phd')."</user_id>
			</data>
		</root>";

		//print_r($in_data);die;
		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"saveRequestBatalMuat",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;exit;

			$obj = json_decode($result);

			if($obj->rc!="S")
			{
				echo "NO,".$obj->rcmsg;
			}
			else if($obj->data->data)
			{
				echo($obj->data->data);
			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_proforma_bm_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			if($group_id!="m")
				return;
		}

		$stack = array();

		$billerId=$this->container_model->getNumberRequestBiller($no_request);

		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$billerId</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getPDFProformaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			$hdrGrup = $obj->data->hdrGrup;
			$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
			$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
			$hasil = $query->row_array();
			$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : 'config/cube/img/ipc_logo.png';
			if($obj->data->html_tcpdf)
			{

				//update activity log
				if($group_id!="m")
					$this->container_model->updateTransactionLogActivity($no_request,"PRINT_PROFORMA",$id_user_eservice=$this->session->userdata('uname_phd'));

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
				$pdf->SetMargins(3, 4, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);


// ---------------------------------------------------------

				$tbl=base64_decode($obj->data->html_tcpdf);

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
				$pdf->SetFont('helvetica', '', 10);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				//$pdf->write1DBarcode("Ivan", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->setPage(1);
				$pdf->Image(APP_ROOT.$logo, 5, 12, 18, 12, '', '', '', true, 500);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_proforma_bm($no_request,$port_code,$terminal_code,$hash=""){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->download_proforma_bm_atch($no_request,$port_code,$terminal_code,$hash);
	}

	function download_probm_thermal($no_request,$port_code,$terminal_code,$hash=""){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->download_probm_thermal_atch($no_request,$port_code,$terminal_code,$hash);
	}

	function download_probm_thermal_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			if($group_id!="m")
				return;
		}

		$stack = array();

		$billerId=$this->container_model->getNumberRequestBiller($no_request);

		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$billerId</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getPDFPro_thermal",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			$hdrGrup = $obj->data->hdrGrup;
			$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
			$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
			$hasil = $query->row_array();
			$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : 'config/cube/img/ipc_logo.png';
			if($obj->data->html_tcpdf)
			{

				//update activity log
				if($group_id!="m")
					$this->container_model->updateTransactionLogActivity($no_request,"PRINT_PROFORMA",$id_user_eservice=$this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();
				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);

				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(3, 17, 0);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);


// ---------------------------------------------------------

				$tbl=base64_decode($obj->data->html_tcpdf);

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
				$pdf->SetFont('helvetica', '', 5);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				//$pdf->write1DBarcode("Ivan", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->setPage(1);
				$pdf->Image(APP_ROOT.$logo,3, 22, 9, 6, '', '', '', true, 500);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png',3, 22, 9, 6, '', '', '', true, 72);
				$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_invoice_bm_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			//return;
		}

		$stack = array();

		$nobiller=$this->container_model->getNumberRequestBiller($no_request);

		{//create inovoice qr code
			//data hasil qr code
			$hash = md5(ROOT."invoice/val_invoice/1/loadc/$no_request/$port_code/$terminal_code/");

			//val_invoice/{validation_version}/{service_type}/{no_request}/{port_code}/{terminal_code}/{challenge_code}
			//pada versi 1, digunakan challenge_code untuk menguji bahwa url yang terbentuk benar hanya dari sistem ipc
			$params['data'] = ROOT."invoice/val_invoice/1/loadc/$no_request/$port_code/$terminal_code/$hash";
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = UPLOADFOLDER_.'qr_code/tes.png';
			$this->ciqrcode->generate($params);
		}

		$barcode_location=APP_ROOT.'qr_code/tes.png';
		//$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
    if ($port_code=='IDPNJ')
		{
			$ttd_location = APP_ROOT."config/images/cr/ttd_pjg.png";
		} else {
			$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
		}
		$user = $this->session->userdata('uname_phd');

		//echo $nobiller;
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$nobiller</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
				<barcode_location>".$barcode_location."</barcode_location>
				<ttd_location>$ttd_location</ttd_location>
				<user>".$user."</user>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getPDFNotaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			// Get Logo added by kens
			$org_id = $obj->data->org_id;
			$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and org_id = ? ";
			$query = $this->db->query($query, array($port_code,$terminal_code,$org_id));
			$hasil = $query->row_array();
			$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : 'config/cube/img/ipc_logo.png';


			if($obj->data->html_tcpdf)
			{
				$footerhtml = base64_decode($obj->data->footer);
				$lampiran_nota = base64_decode($obj->data->lampiran);
				
				if($group_id!="m")
					$this->container_model->updateTransactionLogActivity($no_request,"PRINT_INVOICE",$id_user_eservice=$this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();

				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
				// create new PDF document
				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(5, 5, 15);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

				$tbl=base64_decode($obj->data->html_tcpdf);

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
				$pdf->SetFont('courier', '', 9);
				//Menampilkan Barcode dari nomor nota
				//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
				//Logo IPC
				//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->writeHTML($footerhtml, true, false, false, false, '');
				$pdf->Image(APP_ROOT.$logo, 5, 4, 30, 15, '', '', '', true, 500);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				// $pdf->AddPage();
				// $pdf->writeHTML($lampiran_nota, true, false, false, false, '');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

				$pdf->setPage(1);
				$pdf->Image(APP_ROOT.$logo, 5, 4, 30, 15, '', '', '', true, 500);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				//$pdf->Image(APP_ROOT.'config/images/cr/ttd2.jpg', 175, 238, 30, 15, '', '', '', true, 72);

				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_jasa_kepelabuhanan - '.$obj->data->faktur_id.'.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}
	}

	function download_invoice_bm($no_request,$port_code,$terminal_code,$hash=""){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if($dataBilling["STATUS_REQ"]!="P")
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->download_invoice_bm_atch($no_request,$port_code,$terminal_code,$hash);
	}

	function download_card_bmdel_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			return;
		}

		$stack = array();

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getPDFCardContainerDel",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->html_tcpdf)
			{

				$tbl=base64_decode($obj->data->html_tcpdf);

				echo($tbl);die();

			}
		}

	}

	function download_card_bmdel($no_request,$port_code,$terminal_code,$hash=""){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		//validasi cetakan CALAG
		$cardst = substr($no_request,0,4);
		if($cardst=="RLCA")
		{
			echo "BATAL MUAT AFTER GATE IN TIDAK PERLU CETAK KARTU...!";die;
		}

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if($dataBilling["STATUS_REQ"]!="P")
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->download_card_bmdel_atch($no_request,$port_code,$terminal_code,$hash);
	}

	function download_card_bmdel_thermal($no_request,$port_code,$terminal_code){
		$stack = array();

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$no_request</no_request>
				<port_code>".$port_code."</port_code>
				<terminal_code>".$terminal_code."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getCardContainerThermal",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->html_tcpdf)
			{
				$this->load->helper('pdf_helper');

				tcpdf();

				// create new PDF document
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				// $pdf = new MYPDF('P', 'mm', 'A7', true, 'UTF-8', false);
				$pdf = new TCPDF('P', 'mm', Array(80,130), true, 'UTF-8', false);

				// set header and footer fonts
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				//set margins
				$pdf->SetMargins(1, 1, 1);
				//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->setPrintHeader(false);

				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------
				for($i=0;$i<count($obj->data->html_tcpdf);$i++)
				{
					$tbl=base64_decode($obj->data->html_tcpdf[$i]->TCPDF);
					// add a page
					$pdf->AddPage();
					// set font
					$pdf->SetFont('courier', '', 6);

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
							'fontsize' => 8,
							'stretchtext' => 4
						);

					//Menampilkan Barcode dari nomor nota
					//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
					//Logo IPC
					$pdf->write1DBarcode($obj->data->html_tcpdf[$i]->NO_CONTAINER, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
					$pdf->writeHTML($tbl, true, false, false, false, '');
					$pdf->write1DBarcode($obj->data->html_tcpdf[$i]->NO_CONTAINER, 'C128', 0, 100, '', 18, 0.4, $style, 'N');

				}

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

				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('sample.pdf', 'I');
			} else {
				echo "NO,GAGAL";
			}
		}

	}

	public function download_card_bm_atch($no_request,$port_code,$terminal_code,$hash){
		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			return;
		}

		$card_password = $billerId=$this->user_model->get_pdf_password($this->session->userdata('uname_phd'));
		$nobiller=$this->container_model->getNumberRequestBiller($no_request);

        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";
		//echo $in_data;die;
        if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getPDFCardContainerRec",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			$hdrGrup = $obj->data->hdrGrup;
			$query="SELECT logo, terminal_name FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
			$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
			$hasil = $query->row_array();
			$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : 'config/cube/img/ipc_logo.png';
			if (($terminal_code=='T1D') OR ($terminal_code=='T009D'))
			{
				$terminal_desc='TERMINAL 1 DOMESTIK';
			}
			else if($terminal_code=='T2D')
			{
				$terminal_desc='TERMINAL 1 DOMESTIK';
			}
			else if($terminal_code=='T3D')
			{
				$terminal_desc='TERMINAL 3 DOMESTIK';
			}
			else if($terminal_code=='T3I')
			{
				$terminal_desc='TERMINAL 3 INTERNASIONAL';
			}
			else if($terminal_code=='PNJI')
			{
				$terminal_desc='TERMINAL PETIKEMAS PANJANG';
			}
			else if($terminal_code=='PNJD')
			{
				$terminal_desc='TERMINAL PETIKEMAS PANJANG';
			}else if($port_code=="IDPNK")
			{
				$terminal_desc = $hasil['TERMINAL_NAME'];
			}
			

			//echo $result; die;
			//$tbl=base64_decode($obj->data->proforma_html);
			//print_r($tbl); die();
			$total = $obj->data->jumlah;
			//print_r(count($obj->data->detail_card));
			if($obj->data->detail_card){

			//update activity log
			$this->container_model->updateTransactionLogActivity($no_request,"PRINT_CARD",$id_user_eservice=$this->session->userdata('uname_phd'));
			$cetakan_ke = $this->container_model->getCountCardPrint($no_request);
			//validasi limit cetakan kartu
			$vld = $this->container_model->getValidCardPrint($cetakan_ke,'CALBG');
			if($vld=="N")
			{
				echo "CETAKAN KE-".$cetakan_ke."\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";die;
			}	

			$this->load->helper('pdf_helper');
			tcpdf();
			// create new PDF document
			//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


			// set header and footer fonts
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetProtection 	($permissions = array('print', 'print'),
										$user_pass = $card_password,
										$owner_pass = null,
										$mode = 0,
										$pubkeys = null
									);
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			//set margins
			$pdf->SetMargins(3, 3, 3);
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			$pdf->setPrintHeader(false);

			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, 10);

			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			//set some language-dependent strings
			$pdf->setLanguageArray(null);


// ---------------------------------------------------------
			//print_r($rowz); die();
			$shipper="";
			$nourut = 1;
			for($i=0;$i<count($obj->data->detail_card);$i++){
				$nocont = strtoupper($obj->data->detail_card[$i]->no_container);
			   // echo $nocont; die();
				$prefx = strtoupper($obj->data->detail_card[$i]->prefix);
				$clossing_time        =$obj->data->detail_card[$i]->clossing_time;
				$paid_thru            =$obj->data->detail_card[$i]->paidthru;
				$etd                  =$obj->data->detail_card[$i]->etd;
				$vessel               =$obj->data->detail_card[$i]->vessel;
				$voyage               =$obj->data->detail_card[$i]->voyage;
				$voyage_out           =$obj->data->detail_card[$i]->voyage_out;
				$status_cont          =$obj->data->detail_card[$i]->status_cont;
				$size_cont            =$obj->data->detail_card[$i]->size_cont;
				$type_cont            =$obj->data->detail_card[$i]->type_cont;
				$no_container         =$obj->data->detail_card[$i]->no_container;
				$berat                =$obj->data->detail_card[$i]->berat;
				$pelabuhan_tujuan     =$obj->data->detail_card[$i]->pelabuhan_tujuan;
				$fpod                 =$obj->data->detail_card[$i]->fpod;
				$ipod                 =$obj->data->detail_card[$i]->ipod;
				$fipod                =$obj->data->detail_card[$i]->fipod;
				$peb                  =$obj->data->detail_card[$i]->peb;
				$npe                  =$obj->data->detail_card[$i]->npe;
				$kode_pbm             =$obj->data->detail_card[$i]->kode_pbm;
				$imo_class            =$obj->data->detail_card[$i]->imo_class;
				$temp                 =$obj->data->detail_card[$i]->temp;
				$iso_code             =$obj->data->detail_card[$i]->iso_code;
				$ipol                 =$obj->data->detail_card[$i]->ipol;
				$tgl_request          =$obj->data->detail_card[$i]->tgl_request;
				$prefix               =$obj->data->detail_card[$i]->prefix;
				$cont_numb            =$obj->data->detail_card[$i]->cont_numb;
				$booking_numb         =$obj->data->detail_card[$i]->booking_numb;
				$status_tl            =$obj->data->detail_card[$i]->status_tl;
				$seal_id              =$obj->data->detail_card[$i]->seal_id;
				$corporate_name       =$obj->data->detail_card[$i]->corporate_name;
				$emkl              =$obj->data->detail_card[$i]->emkl;
				$nama_shipper              =$obj->data->detail_card[$i]->nama_shipper;
				$pin_number               =$obj->data->detail_card[$i]->pin_number;
				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 6);
				//added shipper khusus jambi
				if($port_code=="IDDJB" || $port_code=="IDTLB"){
						$shipper = '<tr>
	                        <td align="left" colspan="3">
	                            <b><font size="10">Shipper : '.$nama_shipper.'</font></b>
	                        </td>                       
	                    </tr>';
				}
				$tbl0= <<<EOD
				<table width="95%">
					<tr>
						<td COLSPAN="6" align="right"><b><font size="18">Gate Pass Batal Muat Online</font></b></td>
					</tr>
					<tr>
						<td>
						</td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp; $corporate_name</font></b></td>
					</tr>
					<tr>
						<td>
						</td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp; $terminal_desc</font></b></td>
					</tr>
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="center">
							<b><font size="12">No Container</font></b>
						</td>
						<td align="center">
							<b><font size="12">PIN</font></b>
						</td>
					</tr>
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="left">
							<b><font size="10">No Container</font></b>
						</td>
						<td align="left">
							<b><font size="10">Seal Number</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nocont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$seal_id</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_cont</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">ISO Code</font></b>
						</td>
						<td align="left">
							<b><font size="10">Size/Type</font></b>
						</td>
						<td align="left">
							<b><font size="10">Temperatur</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$iso_code</font></b>
						</td>
						<td align="left">
							<b><font size="12">$size_cont/$type_cont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$temp</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">No Urut</font></b>
						</td>
						<td align="left">
							<b><font size="10">Berat</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status TL</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nourut/$total</font></b>
						</td>
						<td align="left">
							<b><font size="12">$berat</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_tl</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Vessel</font></b>
						</td>
						<td align="left">
							<b><font size="10">Voyage</font></b>
						</td>
						<td align="left">
							<b><font size="10">POL / POD</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$vessel</font></b>
						</td>
						<td align="left">
							<b><font size="12">$voyage_in/$voyage_out</font></b>
						</td>
						<td align="left">
							<b><font size="12">$ipol / $ipod</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Customer</font></b>
						</td>
						<td align="left">
							<b><font size="10">ETD</font></b>
						</td>
						<td align="left">
							<b><font size="10">Clossing Time</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="9">$emkl</font></b>
						</td>
						<td align="left">
							<b><font size="12">$etd</font></b>
						</td>
						<td align="left">
							<b><font size="12">$clossing_time</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">IMO Class</font></b>
						</td>
						<td align="left">
							<b><font size="10">Booking No</font></b>
						</td>
						<td align="left">
							<b><font size="10">No Request</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$imo_class</font></b>
						</td>
						<td align="left">
							<b><font size="12">$booking_numb</font></b>
						</td>
						<td align="left">
							<b><font size="12">$no_request ($nobiller)</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="8">Paid Thru</font></b>
						</td>
						<td align="left">
							<b><font size="8">Cetakan ke</font></b>
						</td>
						<td align="left">
							<b><font size="8"></font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="8">$paid_thru</font></b>
						</td>
						<td align="left">
							<b><font size="8">$cetakan_ke</font></b>
						</td>
						<td align="left">
							<b><font size="8"></font></b>
						</td>
					</tr>
					$shipper
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/><font size="8">Keterangan :</font>
				<br/><font size="8">1. Kartu ini harap dibawa saat melakukan gate in</font>
				<br/><font size="8">2. Harap perhatikan Clossing Time dan Paid Thru</font>
				<br/><font size="8">3. Periksa kembali no container yang tertera pada kartu</font>
				<br/><font size="8">4. Bila kartu ini hilang harap segera melapor ke IPC</font>
				<br/><font size="8">5. Bila menemukan kartu ini harap menyerahkan pada IPC</font>
				<p align="center"><b><font size="10">Please fold here - Do not tear (Silahkan lipat di sini - Jangan disobek)</font></b></p>
				<br/>
				<p align="center"><b><font size="10">Gate Copy</font></b></p>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="center">
							<b><font size="12">No Container</font></b>
						</td>
						<td align="center">
							<b><font size="12">PIN</font></b>
						</td>
					</tr>
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<table width="95%">
					<tr>
						<td align="left">
							<b><font size="10">No Container</font></b>
						</td>
						<td align="left">
							<b><font size="10">Seal Number</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nocont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$seal_id</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_cont</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">ISO Code</font></b>
						</td>
						<td align="left">
							<b><font size="10">Size/Type</font></b>
						</td>
						<td align="left">
							<b><font size="10">Temperatur</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$iso_code</font></b>
						</td>
						<td align="left">
							<b><font size="12">$size_cont/$type_cont</font></b>
						</td>
						<td align="left">
							<b><font size="12">$temp</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">No Urut</font></b>
						</td>
						<td align="left">
							<b><font size="10">Berat</font></b>
						</td>
						<td align="left">
							<b><font size="10">Status TL</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$nourut/$total</font></b>
						</td>
						<td align="left">
							<b><font size="12">$berat</font></b>
						</td>
						<td align="left">
							<b><font size="12">$status_tl</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Vessel</font></b>
						</td>
						<td align="left">
							<b><font size="10">Voyage</font></b>
						</td>
						<td align="left">
							<b><font size="10">POL / POD</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$vessel</font></b>
						</td>
						<td align="left">
							<b><font size="12">$voyage/$voyage_out</font></b>
						</td>
						<td align="left">
							<b><font size="12">$ipol / $ipod</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">Customer</font></b>
						</td>
						<td align="left">
							<b><font size="10">ETD</font></b>
						</td>
						<td align="left">
							<b><font size="10">Clossing Time</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="9">$emkl</font></b>
						</td>
						<td align="left">
							<b><font size="12">$etd</font></b>
						</td>
						<td align="left">
							<b><font size="12">$clossing_time</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="10">IMO Class</font></b>
						</td>
						<td align="left">
							<b><font size="10">Booking No</font></b>
						</td>
						<td align="left">
							<b><font size="10">No Request</font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="12">$imo_class</font></b>
						</td>
						<td align="left">
							<b><font size="12">$booking_numb</font></b>
						</td>
						<td align="left">
							<b><font size="12">$no_request</font></b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="8">Paid Thru</font></b>
						</td>
						<td align="left">
							<b><font size="8">Cetakan ke</font></b>
						</td>
						<td align="left">
							<b><font size="8"></font></b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<b><font size="8">$paid_thru</font></b>
						</td>
						<td align="left">
							<b><font size="8">$cetakan_ke</font></b>
						</td>
						<td align="left">
							<b><font size="8"></font></b>
						</td>
					</tr>
				</table>

EOD;

				$tbl = <<<EOD
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<table width="95%">
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">&nbsp;&nbsp;PT Pelabuhan Tanjung Priok</font></b></td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="12">TERMINAL 2</font></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td COLSPAN="2" align="left"><b><font size="12">L<br/>$prefx<br/>$cont_numb<br/>$status_cont</font></b></td>
			<td COLSPAN="2" align="center"><b><font size="10">&nbsp;<br/>$iso_code<br/>$type_cont<br/>$temp</font></b></td>
			<td COLSPAN="2" align="right"><b><font size="10">$nourut/$total&nbsp;&nbsp;&nbsp;&nbsp;<br/>$berat&nbsp;&nbsp;&nbsp;&nbsp;<br/>$status_tl&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><font size="12"><b>RECEIVING</b></font></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">$vessel</font></b></td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">Voy. $voyage/$voyage_out</font></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">ETD : $etd</font></b></td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">Closing : $clossing_time</font></b></td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">$ipol / $ipod</font></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td COLSPAN="6" align="center"><b><font size="10">$kode_pbm</font></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="70" align="left"><b><font size="10">IMO Code</font></b></td>
			<td width="10">:</td>
			<td COLSPAN="4"><b><font size="10">$imo_class</font></b></td>
		</tr>
		<tr>
			<td width="70" align="left"><b><font size="10">Document</font></b></td>
			<td width="10">:</td>
			<td COLSPAN="4"><b><font size="10">$booking_numb</font></b></td>
		</tr>
		<tr>
			<td width="70" align="left"><b><font size="10">Performa</font></b></td>
			<td width="10">:</td>
			<td COLSPAN="4"><b><font size="10">$no_request</font></b></td>
		</tr>
		<tr>
			<td width="70" align="left"><b><font size="10">Paid Thru</font></b></td>
			<td width="10">:</td>
			<td COLSPAN="4"><b><font size="10">$paid_thru</font></b></td>
		</tr>
	</table>

EOD;
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
				'fontsize' => 8,
				'stretchtext' => 4
			);

			$style_pin = array(
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
				'fontsize' => 13,
				'stretchtext' => 8
			);	

			//Menampilkan Barcode dari nomor nota
			//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			//Logo IPC
			//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 10, 9, 18, 12, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 30, 115, 180, 50, '', '', '', true, 72);
			//$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($tbl0, true, false, false, false, '');
			$pdf->write1DBarcode("$nocont", 'C128', 18, 30, '', 18, 0.4, $style, 'N');
			//$pdf->write1DBarcode("PIN", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
			if($port_code=="IDPNK"){
				$pdf->write1DBarcode("$pin_number", 'C128', 130, 30, '', 18, 0.5, $style_pin, 'N');
			}else{
				$pdf->write1DBarcode("PIN", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
			}
			$pdf->write1DBarcode("$nocont", 'C128', 18, 195, '', 18, 0.4, $style, 'N');
			$pdf->write1DBarcode("PIN", 'C128', 130, 195, '', 18, 0.4, $style, 'N');

			$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '5,10', 'color' => array(0, 0, 0));

			// Line
			$pdf->Line(5, 180, 195, 180, $style3);

			//$pdf->writeHTML($tbl, true, false, false, false, '');
			//$pdf->write1DBarcode("PIN", 'C128', 0, 100, '', 18, 0.4, $style, 'N');

				$nourut++;
			}



			$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
			$pdf->SetFont('courier', 'B', 6);
			//Close and output PDF document
			$pdf->Output('sample.pdf', 'I');
			}
			else{
				echo $obj->rcmsg;
			}
		}
	}

	public function download_card_bm($no_request,$port_code,$terminal_code,$hash=""){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$dataBilling = $this->container_model->getDetailBilling($no_request);

		if($dataBilling["STATUS_REQ"]!="P")
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($no_request))
		{
			return;
		}

		$hash = md5($no_request.$this->session->userdata('customerid_phd'));

		$this->download_card_bm_atch($no_request,$port_code,$terminal_code,$hash);
    }

    public function search_main_alihkapal(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;
		$search=isset($_POST['search']) ? htmLawed($_POST['search']) : 10;
		//echo $search;die();

        $agent_id=$this->session->userdata('customerid_phd');
        $submitter_customer_id=$this->session->userdata('customeridppjk_phd');

        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
			    <no_request>$search</no_request>
				<agent_id>$agent_id</agent_id>
				<submitter_customer_id>$submitter_customer_id</submitter_customer_id>
				<param>param</param>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"getListRequestBMFilter",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die();
			$obj = json_decode($result);
			if($obj->data->listrequest){
				for($i=0;$i<count($obj->data->listrequest);$i++)
				{
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$obj->data->listrequest[$i]->no_request.'");\'><i class=\'fa fa-eye\'></i></a>';
					$confirm_link='<span class="label label-default">N/A</span>';
					if($obj->data->listrequest[$i]->statusreq=="N"){
					$label_span='<span class="label label-info">Draft</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_alihkapal/edit_alihkapal/".$obj->data->listrequest[$i]->no_request."/".$obj->data->listrequest[$i]->port_id."/".$obj->data->listrequest[$i]->terminal_id.'/E"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->listrequest[$i]->no_request.'");\'><i class=\'fa fa-save\'></i></a>';
					} else if($obj->data->listrequest[$i]->statusreq=="S"){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
						$edit_link='';

					} else if($obj->data->listrequest[$i]->statusreq=="W"){
						$label_span='<span class="label label-warning">Waiting Approve</span>';
						$edit_link='';

					}else if($obj->data->listrequest[$i]->statusreq=="R"){
						$label_span='<span class="label label-danger" title="'.$obj->data->listrequest[$i]->reject_notes.'">Rejected</span>';
						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_alihkapal/edit_alihkapal/".$obj->data->listrequest[$i]->no_request."/".$obj->data->listrequest[$i]->port_id."/".$obj->data->listrequest[$i]->terminal_id.'/E"><i class=\'fa fa-pencil\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$obj->data->listrequest[$i]->no_request.'");\'><i class=\'fa fa-save\'></i></a>';

					}else if($obj->data->listrequest[$i]->statusreq=="P" || $datareq[$i]['STATUS_REQ']=="T"){
						$label_span='<span class="label label-success">Paid</span>';
						$edit_link='';
					} else {
						$label_span='<span class="label label-default">N/A</span>';
						$edit_link='';
					}

					$this->table->add_row(
												$i+1,
												$obj->data->listrequest[$i]->no_request,
												$obj->data->listrequest[$i]->tgl_req,
												$label_span,
												$obj->data->listrequest[$i]->vessel.'/'.$obj->data->listrequest[$i]->voyin.'-'.$obj->data->listrequest[$i]->voyout,
												$obj->data->listrequest[$i]->port_id . " / ". $obj->data->listrequest[$i]->terminal_id,
												$obj->data->listrequest[$i]->tipebm,
												$obj->data->listrequest[$i]->jml_cont,
												$view_link,
												$edit_link,
												$confirm_link
											);
				}
			}
		}

        $data = '';
        $this->table->set_heading('No',
									"Request Number",
									"Request Date",
									"Status",
									"Vessel - Voyage",
									"POL / Terminal",
									"Tipe BM",
									"Quantity",
									'View',
									'Edit',
                                    "Request Confirm");

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Loading Cancel Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Loading Cancel Booking";

		$this->load->view('pages/container/search_main_alihkapal',$data);

    }

    public function search_vessel_caldl(){
        if (!$this->session->userdata('uname_phd'))
        {
          redirect(ROOT.'main', 'refresh');
        }

        $term = $_POST['term'];
        $port = $_POST['port'];
          log_message('error','>>>>>1>>>');
          if (!$this->session->userdata('uname_phd'))
          {
            redirect(ROOT.'main', 'refresh');
          }
          log_message('error','>>>>>2>>>');
          $client = new nusoap_client(TRACKING_CONTAINER);
          $term			= strtoupper($_GET["term"]);
          if(($_GET["port"])!=""){
            log_message('error','>>>>>3>>>');
            $port = explode("-",($_GET["port"]));
          }else
          {
            log_message('error','>>>>>4>>>');
            $port[0] = "";
            $port[1] = "";
          }
          log_message('error','>>>>>5>>>');
          $error = $client->getError();
          if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}
          // port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
          // terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
          $modul="getVesselList";
          $in_data="	<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
              <vessel_name>$term</vessel_name>
              <port_code>".$port[0]."</port_code>
              <terminal_code>".$port[1]."</terminal_code>
            </data>
          </root>";
          injek($in_data);

                $stack = array();
          $result = $client->call($modul, array("in_data" => "$in_data"));
          if ($client->fault) {
            echo "<h2>Fault</h2><pre>";
            print_r($result);
            echo "</pre>";
          }
          else {
            $error = $client->getError();
            if ($error) {
              echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
            }
            else {
              //echo $result;
              $obj = json_decode($result);

              if($obj->data->vessel)
              {
                for($i=0;$i<count($obj->data->vessel);$i++)
                {
                      $temp;
                      $temp['VESSEL']=$obj->data->vessel[$i]->vessel_name;
                      $temp['VESSEL_CODE']=$obj->data->vessel[$i]->vessel_code;
                      $temp['CALL_SIGN']=$obj->data->vessel[$i]->call_sign;
                      $temp['VOYAGE']=$obj->data->vessel[$i]->voyage;
                      $temp['VOYAGE_IN']=$obj->data->vessel[$i]->voyage_in;
                      $temp['VOYAGE_OUT']=$obj->data->vessel[$i]->voyage_out;
                      $temp['UKK']=$obj->data->vessel[$i]->id_vsb_voyage;
                      $temp['ETA']=$obj->data->vessel[$i]->eta;
                      $temp['ETD']=$obj->data->vessel[$i]->etd;
                      $temp['OPNAME']=$obj->data->vessel[$i]->opname;
                      $temp['NO_UKK']=$obj->data->vessel[$i]->id_vsb_voyage;
                      $temp['CLOSSING_TIME_DOC']=$obj->data->vessel[$i]->clossing_time_doc;
                      $temp['CLOSING']=$obj->data->vessel[$i]->closing;
                      $temp['CONT_LIMIT']=$obj->data->vessel[$i]->cont_limit;
                      $temp['OPEN_STACK']=$obj->data->vessel[$i]->open_stack;
                      $temp['VALID_CLOSING']=$obj->data->vessel[$i]->valid_closing;
                      $temp['VALID_ATD']=$obj->data->vessel[$i]->valid_atd;
                      array_push($stack, $temp);
                }
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
          $link_button = '<a data-dismiss="modal" style="cursor:pointer" class="table-link click_detail bank_detail" onclick="complete(\''.$t['VESSEL'].'\',\''.$t['VOYAGE_IN'].'\',\''.$t['VOYAGE_OUT'].'\',\''.$t['ETA'].'\',\''.$t['ETD'].'\',\''.$t['UKK'].'\',\''.$t['VESSEL_CODE'].'\',
          \''.$t['CALL_SIGN'].'\',\''.$t['VOYAGE'].'\',\''.$t['CLOSSING_TIME_DOC'].'\',\''.$t['CLOSING'].'\',\''.$t['CONT_LIMIT'].'\',\''.$t['OPEN_STACK'].'\',\''.$t['OPNAME'].'\',\''.$t['VALID_CLOSING'].'\')"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>';
          /*if ($t['VALID_CLOSING'] == 'N' && $t['VALID_ATD'] == 'N'){
            $link_button = "<b style='color:red'>Departure</b>";
          }
          else if($t['VALID_CLOSING'] == 'N' && $t['VALID_ATD'] == 'Y'){
            $link_button = "<b style='color:orange'>Closing Doc</b>";
          }*/
          $this->table->add_row(
            $t['VESSEL'],
            $t['VOYAGE_IN'],
            $t['VOYAGE_OUT'],
            $t['ETA'],
            $t['ETD'],
            $link_button
          );
            $i++;
        }

        $this->load->view('pages/container/search_vessel_modal',$data);
    }


}
