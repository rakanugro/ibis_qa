<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Container_receiving extends CI_Controller {

	public function __construct() {
                parent::__construct();
                $this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
				$this->load->library('upload');
				$this->load->library('session');
                $this->load->model('user_model');
                $this->load->model('container_model');
				$this->load->model('master_model');
				$this->load->library("Nusoap_lib");
				$this->load->library("commonlib");
				$this->load->library('table');
				$this->load->library('ciqrcode');
				$this->load->library('breadcrumbs');
                $this->load->helper('MY_language_helper');
                require_once(APPPATH.'libraries/htmLawed.php');
        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

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

	}

	public function main_receiving(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Request Number</th>",
			"<th width='100px'>Request Date</th>",
			"<th width='100px'>Status</th>",
			"<th width='100px'>Vessel/Voyage</th>",
			"<th width='100px'>Terminal</th>",
			"<th width='100px'>Via</th>",
			//get_content($this->user_model,"receiving","port"),
			//get_content($this->user_model,"receiving","terminal"),

			"<th width='50px'>POD</th>",
			"<th width='50px'>Qty</th>",
			"<th width='50px'>View</th>",
			"<th width='50px'>Edit</th>",
			"<th width='50px'>Confirm</th>"
		);

		$agent_id=$this->session->userdata('customerid_phd');
		$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
		$request_no="";
		$start_rownum="";
		$end_rownum="";

			$obj = $this->container_model->getNumberRequest($agent_id,$submitter_customer_id,'PTKM00');
			//echo $obj;die;
			//$obj = json_decode($result);
				$i=1;
				foreach ($obj as $key)
				{
					$label_span='<span class="label label-default">N/A</span>';
					$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$key['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
					$edit_link='<span class="label label-default">N/A</span>';
					$cancel_link='<span class="label label-default">N/A</span>';
					$confirm_link='<span class="label label-default">N/A</span>';
					if($key['STATUS_REQ'] == 'N'){
						$label_span = '<span class="label label-info">Draft</span>';

						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/edit_receiving/".$key['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/cancel_receiving/".$key['REQUEST_ID'].'/'.$key['PORT_ID'].'/'.$key['TERMINAL_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$key['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else if($key['STATUS_REQ'] == 'S'){
						$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';

					}
					else if($key['STATUS_REQ'] == 'P' || $key['STATUS_REQ'] == 'T'){
						$label_span='<span class="label label-success">Paid</span>';

					}
					else if($key['STATUS_REQ'] == 'X'){
						 $label_span='<span class="label label-danger">Canceled</span>';
					}
					else if($key['STATUS_REQ'] == 'W'){
						 $label_span='<span class="label label-warning">Waiting Approve</span>';

					}
					else if($key['STATUS_REQ'] == 'R'){
						$label_span='<span class="label label-danger" title="'.$key['REJECT_NOTES'].'">Rejected<img></img></span>';

						$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/edit_receiving/".$key['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
						$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/cancel_receiving/".$key['REQUEST_ID'].'/'.$key['PORT_ID'].'/'.$key['TERMINAL_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
						$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$key['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
					}
					else {
						$label_span='<span class="label label-default">N/A</span>';
					}

					$this->table->add_row(
											$i,
											$key['REQUEST_ID'],
											$key['REQUEST_DATE'],
											$label_span,
											$key['VESVOY'],
											$key['TERMINAL_NAME'],
											$key['DEL_VIA'],
											//$obj->data->request[$i]->id_terminal,
											$key['ADDITIONAL_FIELD3'],
											$key['CONT_QTY'],
											$view_link,
											$edit_link,
											$confirm_link
										);
						$i++;
				}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Receiving Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Receiving Booking";

		$this->common_loader($data,'pages/container/main_receiving');
	}

	public function search_main_receiving(){
				if (!$this->session->userdata('uname_phd'))
				{
					redirect(ROOT.'main', 'refresh');
				}
				$req_id = trim($_POST['search']);
				$this->table->set_heading(
					"<th width='30px'>No</th>",
					"<th width='100px'>Request Number</th>",
					"<th width='100px'>Request Date</th>",
					"<th width='100px'>Status</th>",
					"<th width='100px'>Vessel/Voyage</th>",
					"<th width='100px'>Terminal</th>",
					"<th width='100px'>Via</th>",
					//get_content($this->user_model,"receiving","port"),
					//get_content($this->user_model,"receiving","terminal"),

					"<th width='50px'>POD</th>",
					"<th width='50px'>Qty</th>",
					"<th width='50px'>View</th>",
					"<th width='50px'>Edit</th>",
					"<th width='50px'>Confirm</th>"
				);

				$agent_id=$this->session->userdata('customerid_phd');
				$submitter_customer_id=$this->session->userdata('customeridppjk_phd');
				$request_no="";
				$start_rownum="";
				$end_rownum="";
					//echo $agent_id;
					$obj = $this->container_model->getNumberReqAndSourceReceivingBySearch($agent_id,$submitter_customer_id,$req_id);
					//print_r($obj);die;
					//$obj = json_decode($result);
						$i=1;
						foreach ($obj as $key)
						{
							$label_span='<span class="label label-default">N/A</span>';
							$view_link='<a  class=\'btn btn-primary\' onclick=\'clickDialog1("'.$key['REQUEST_ID'].'");\'><i class=\'fa fa-eye\'></i></a>';
							$edit_link='<span class="label label-default">N/A</span>';
							$cancel_link='<span class="label label-default">N/A</span>';
							$confirm_link='<span class="label label-default">N/A</span>';
							if($key['STATUS_REQ'] == 'N'){
								$label_span = '<span class="label label-info">Draft</span>';

								$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/edit_receiving/".$key['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
								$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/cancel_receiving/".$key['REQUEST_ID'].'/'.$key['PORT_ID'].'/'.$key['TERMINAL_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
								$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$key['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
							}
							else if($key['STATUS_REQ'] == 'S'){
								$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';

							}
							else if($key['STATUS_REQ'] == 'P' || $key['STATUS_REQ'] == 'T'){
								$label_span='<span class="label label-success">Paid</span>';

							}
							else if($key['STATUS_REQ'] == 'X'){
								 $label_span='<span class="label label-danger">Canceled</span>';
							}
							else if($key['STATUS_REQ'] == 'W'){
								 $label_span='<span class="label label-warning">Waiting Approve</span>';

							}
							else if($key['STATUS_REQ'] == 'R'){
								$label_span='<span class="label label-danger" title="'.$key['REJECT_NOTES'].'">Rejected<img></img></span>';

								$edit_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/edit_receiving/".$key['REQUEST_ID'].'"><i class=\'fa fa-pencil\'></i></a>';
								$cancel_link='<a  class=\'btn btn-primary\'  href="'.ROOT."container_receiving/cancel_receiving/".$key['REQUEST_ID'].'/'.$key['PORT_ID'].'/'.$key['TERMINAL_ID'].'"><i class=\'fa fa-trash-o\'></i></a>';
								$confirm_link='<a  class=\'btn btn-primary\' onclick=\'clickConfirm("'.$key['REQUEST_ID'].'");\'><i class=\'fa fa-save\'></i></a>';
							}
							else {
								$label_span='<span class="label label-default">N/A</span>';
							}

							$this->table->add_row(
													$i,
													$key['REQUEST_ID'],
													$key['REQUEST_DATE'],
													$label_span,
													$key['VESVOY'],
													$key['TERMINAL_NAME'],
													$key['DEL_VIA'],
													//$obj->data->request[$i]->id_terminal,
													$key['ADDITIONAL_FIELD3'],
													$key['CONT_QTY'],
													$view_link,
													$edit_link,
													$confirm_link
												);
								$i++;
						}

				$this->load->view('pages/container/search_main_receiving',$data);
	}

	public function search_vessel_modal(){
		//echo 'test';die;
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
		//echo $in_data;die;
		injek($in_data);

		$stack = array();

		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getVesselList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die();
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
			if ($t['VALID_CLOSING'] == 'N' && $t['VALID_ATD'] == 'N'){
				$link_button = "<b style='color:red'>Departure</b>";
			}
			else if($t['VALID_CLOSING'] == 'N' && $t['VALID_ATD'] == 'Y'){
				$link_button = "<b style='color:orange'>Closing Doc</b>";
			}
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

	public function edit_receiving($no_request,$message=null){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$dataReq=$this->container_model->getNumberReqAndSource($no_request);

		$reqNoBiller=$dataReq['BILLER_REQUEST_ID'];
		$portBiller=$dataReq['PORT_ID'];
		$terminalBiller=$dataReq['TERMINAL_ID'];

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
					<request_no>$reqNoBiller</request_no>
					<port_id>$portBiller</port_id>
					<terminal_id>$terminalBiller</terminal_id>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getRequestRecHead",array("in_data" => "$in_data"),$result))
		{
			echo  $result;
			die;
		}
		else
		{
			// echo $result;die();
			$obj = json_decode($result);

			//echo $obj->data->request[0]->term_name;die;
			$data['request_data']['ID_REQ']=$no_request;
			$data['request_data']['ID_REQ_BILLER']=$reqNoBiller;
			$data['request_data']['ID_PORT']=$portBiller;
			$data['request_data']['ID_TERMINAL']=$terminalBiller;
			$data['request_data']['VESSEL']=$obj->data->request[0]->vessel;
			$data['request_data']['VOYAGE_IN']=$obj->data->request[0]->voyin;
			$data['request_data']['VOYAGE_OUT']=$obj->data->request[0]->voyout;
			$data['request_data']['ID_VES_VOYAGE']=$obj->data->request[0]->id_ves_voyage;
			$data['request_data']['OI']=$obj->data->request[0]->oi;
			$data['request_data']['POD']=$obj->data->request[0]->pod;
			$data['request_data']['IDPOD']=$obj->data->request[0]->idpod;
			$data['request_data']['FPOD']=$obj->data->request[0]->fpod;
			$data['request_data']['IDFPOD']=$obj->data->request[0]->idfpod;
			$data['request_data']['PEB']=$obj->data->request[0]->peb;
			$data['request_data']['NPE']=$obj->data->request[0]->npe;
			$data['request_data']['BOOKING_NUMB']=$obj->data->request[0]->bknumb;
			$data['request_data']['VESSEL_CODE']=$obj->data->request[0]->vscode;
			$data['request_data']['VOYAGE']=$obj->data->request[0]->voy;
			$data['request_data']['CALL_SIGN']=$obj->data->request[0]->callsign;
			$data['request_data']['NO_SPP']=$obj->data->request[0]->spp;
			$data['request_data']['NO_SURAT_JALAN']=$obj->data->request[0]->suratjalan;
			$data['request_data']['TERMINAL_NAME']=$obj->data->request[0]->term_name;
			$data['request_data']['TL_FLAG']=$obj->data->request[0]->tl_flag;
			$data['request_data']['PEB_FILE']=$obj->data->request[0]->PEB_FILE;
			{
				$file = explode("-",$data['request_data']['PEB_FILE']);
				//var_dump($file);
				if($file[0]=="")
				{
					$data['request_data']['PEB_FILE'] = "";
				}
			}
			$data['request_data']['NPE_FILE']=$obj->data->request[0]->NPE_FILE;
			{
				$file = explode("-",$data['request_data']['NPE_FILE']);
				//var_dump($file);
				if($file[0]=="")
				{
					$data['request_data']['NPE_FILE'] = "";
				}
			}
			$data['request_data']['BOOKSHIP_FILE']=$obj->data->request[0]->BOOKSHIP_FILE;
			{
				$file = explode("-",$data['request_data']['BOOKSHIP_FILE']);
				//var_dump($file);
				if($file[0]=="")
				{
					$data['request_data']['BOOKSHIP_FILE'] = "";
				}
			}
			$data['carrier_list'] = $obj->data->carrier_list;
		}

		$data['terminal'] = $this->master_model->get_terminal();
		$data['message']=$message;
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Receiving Booking", 'container_receiving/main_receiving');
		$this->breadcrumbs->push("Edit Receiving Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Edit Receiving Booking";

		$this->common_loader($data,'pages/container/edit_receiving');
	}

    public function view_detail_receiving($type=null){
            if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

            $no_request = htmLawed($_POST['norequest']);
            $dataReq=$this->container_model->getNumberReqAndSource($no_request);

			$reqNoBiller=$dataReq['BILLER_REQUEST_ID'];
			$portBiller=$dataReq['PORT_ID'];
			$terminalBiller=$dataReq['TERMINAL_ID'];

			$client = new nusoap_client(REQUEST_RECEIVING_CONTAINER);
			$error = $client->getError();
			if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}
			$modul="getRequestRecDet";
			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
						<request_no>$reqNoBiller</request_no>
						<port_id>$portBiller</port_id>
						<terminal_id>$terminalBiller</terminal_id>
				</data>
			</root>";

			$result = $client->call($modul, array("in_data" => "$in_data"));
			$array_cont = array();
			if ($client->fault) {
				echo "<h2>Fault</h2><pre>";
				print_r($result);
				echo "</pre>";
				exit;
			}
			else {
				$error = $client->getError();
				if ($error) {
					echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
					exit;
				}
				else {
					$obj = json_decode($result);
					//echo var_dump($obj);die;
					$jml=count($obj->data->request);
					for($i=0;$i<$jml;$i++){
						$array_cont[$i]['NO_CONTAINER']=$obj->data->request[$i]->container_number;
						$array_cont[$i]['SIZE_CONT']=$obj->data->request[$i]->size;
						$array_cont[$i]['TYPE_CONT']=$obj->data->request[$i]->type;
						$array_cont[$i]['STATUS_CONT']=$obj->data->request[$i]->status;
						$array_cont[$i]['HEIGHT_CONT']=$obj->data->request[$i]->height;
						$array_cont[$i]['HZ']=$obj->data->request[$i]->hz;
						$array_cont[$i]['CARRIER']=$obj->data->request[$i]->carrier;
					}
				}
			}


			if($type=="add" || $type=="edit"){
				//create table
				$this->table->set_heading("No",
									  "Delete",
									  "Container Number",
                                      "Size",
                                      "Type",
                                      "Status",
                                      "Height",
                                      "HZ",
                                      "Carrier"
                                     );
			} else {
				//create table
				$this->table->set_heading("No",
									  "Container Number",
                                      "Size",
                                      "Type",
                                      "Status",
                                      "Height",
                                      "HZ",
                                      "Carrier"
                                     );
			}


            //print_r($array_cont); die();
			$i=0;
            foreach($array_cont as $ac){
				if($type=="add" || $type=="edit"){
	                $this->table->add_row(
								$i+1,
								"<a onclick='delete_cont(\"".$ac['NO_CONTAINER']."\",\"".$no_request."\")' style='cursor:pointer' title='Delete Container'><span class='fa-stack'><i class='fa fa-square fa-stack-2x'></i>
								<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i></span></a>",
								$ac['NO_CONTAINER'],
								$ac['SIZE_CONT'],
								$ac['TYPE_CONT'],
								$ac['STATUS_CONT'],
								$ac['HEIGHT_CONT'],
								$ac['HZ'],
								$ac['CARRIER']
							);
				} else {
					$this->table->add_row(
							$i+1,
							$ac['NO_CONTAINER'],
							$ac['SIZE_CONT'],
							$ac['TYPE_CONT'],
							$ac['STATUS_CONT'],
							$ac['HEIGHT_CONT'],
							$ac['HZ'],
							$ac['CARRIER']

						);
				}
				$i++;
            }
			$data['type']=$type;
			$this->load->view('pages/container/view_detail_receiving',$data);
    }

		function get_isocode(){
				echo $this->master_model->get_isocode();

		}

		function update_qty_cont(){
			$request_id = htmLawed($_POST["request_no"]);
			$type = htmLawed($_POST["type"]);

			$this->container_model->update_qty_cont($request_id,$type);
		}

    public function delete_container(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $no_container=htmLawed($_POST["NO_CONT"]);
		$no_request=htmLawed($_POST["NO_REQ"]);
		$reqNoBiller=$this->container_model->getNumberRequestBiller($no_request);
		//echo $reqNoBiller;
		$port=htmLawed($_POST["PORT"]);
		$terminal=htmLawed($_POST["TERMINAL"]);
		$vessel_code=htmLawed($_POST["VESSEL_CODE"]);
		$voyage=htmLawed($_POST["VOYAGE"]);
		$carriercont=htmLawed($_POST["CARRIERCONT"]);
		$user_id=$this->session->userdata('uname_phd');
		$stack = array();
		try{
			//echo '\n masuk sini';

			$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<port_code>".$port."</port_code>
							<terminal_code>".$terminal."</terminal_code>
							<id_req>$reqNoBiller</id_req>
							<no_container>$no_container</no_container>
							<user_id>$user_id</user_id>
							<vessel_code>$vessel_code</vessel_code>
							<voyage>$voyage</voyage>
							<carrier>$carriercont</carrier>
						</data>
					</root>";

			if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"delDetailContainer",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				echo $result;
				
				// $obj = json_decode($result);
				// if($obj->data->info)
				// {
				// 	echo($obj->data->info);
				// } else {
				// 	echo "NO,GAGAL";
				// }
				
			}
		} catch (Exception $e) {
			echo "NO,GAGAL";
		}
    }

	public function add_receiving() {
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		if(isset($_POST['submit_header']))
		{
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$fix_char		= array(" ", " ", " ", " ", " ");
			$vessel=isset($_POST['vessel'])? htmLawed($_POST['vessel']) : '';
			$peb_no=isset($_POST['peb_no']) ? htmLawed($_POST['peb_no']) : '';
			$npe_no=isset($_POST['npe_no']) ? htmLawed($_POST['npe_no']) : '';
			$booking_ship_no=isset($_POST['booking_ship_no']) ? htmLawed($_POST['booking_ship_no']) : '';
			$gate_in_date=isset($_POST['param']) ? htmLawed($_POST['param']) : '';
			$customer_id=$this->session->userdata('customerid_phd');
			$submitter_customer_id = $this->session->userdata('customeridppjk_phd');
			$customer_name=$this->session->userdata('customername_phd');
			$customer_address=$this->session->userdata('address_phd');
			$customer_address = base64_encode($customer_address);
			$customer_npwp=$this->session->userdata('npwp_phd');
			$port=isset($_POST['port']) ? htmLawed($_POST['port']) : '';
			$ukk=isset($_POST['ukk']) ? htmLawed($_POST['ukk']) : '';
			$pod=isset($_POST['pod']) ? htmLawed($_POST['pod']) : '';
			$fpod=isset($_POST['fpod']) ? htmLawed($_POST['fpod']) : '';
			$pod_name=isset($_POST['pod_name']) ? htmLawed($_POST['pod_name']) : '';
			$fpod_name=isset($_POST['fpod_name']) ? htmLawed($_POST['fpod_name']) : '';
			$trading_type=isset($_POST['trading_type']) ? htmLawed($_POST['trading_type']) : '';
			$request_no=isset($_POST['request_no']) ? htmLawed($_POST['request_no']) : '';
			$receiving_type=isset($_POST['receiving_type']) ? htmLawed($_POST['receiving_type']) : '';
			$start_shift=isset($_POST['start_shift']) ? htmLawed($_POST['start_shift']) : '';
			$end_shift=isset($_POST['end_shift']) ? htmLawed($_POST['end_shift']) : '';
			$peb_dt=isset($_POST['peb_dt']) ? htmLawed($_POST['peb_dt']) : '';
			$voyin=isset($_POST['voy_in']) ? htmLawed($_POST['voy_in']) : '';
			$voyout=isset($_POST['voy_out']) ? htmLawed($_POST['voy_out']) : '';
			$nospp=isset($_POST['nospp']) ? htmLawed($_POST['nospp']) : '';
			$nosppdom=isset($_POST['nosppdom']) ? htmLawed($_POST['nosppdom']) : '';
			$nosuratjalan=isset($_POST['nosuratjalan']) ? htmLawed($_POST['nosuratjalan']) : '';
			$bookingship009=isset($_POST['bookingship009']) ? htmLawed($_POST['bookingship009']) : '';
			$bookingshipdom=isset($_POST['bookingshipdom']) ? htmLawed($_POST['bookingshipdom']) : '';
			$tgl_npe=isset($_POST['tgl_npe']) ? htmLawed($_POST['tgl_npe']) : '';
			$receiving_via=isset($_POST['receiving_via']) ? htmLawed($_POST['receiving_via']) : '';
			$ship_line=htmLawed($_POST["ship_line"]);
			//declare form validation pemesanan penerimaan default
			$config = array(
				array(
					'field' => 'port',
					'label' => 'Terminal',
					'rules' => 'required'
				),
				array(
					'field' => 'vessel',
					'label' => 'Vessel',
					'rules' => 'required'
				),
				array(
					'field' => 'voy_in',
					'label' => 'Voyage In',
					'rules' => 'required'
				),
				array(
					'field' => 'voy_out',
					'label' => 'Voyage Out',
					'rules' => 'required'
				),
				array(
					'field' => 'end_shift',
					'label' => 'End Shift Reefer',
					'rules' => 'required'
				),
				array(
					'field' => 'trading_type',
					'label' => 'Type of Trade',
					'rules' => 'required'
				),
				array(
					'field' => 'pod_name',
					'label' => 'Port of Discharge',
					'rules' => 'required'
				),
				array(
					'field' => 'pod_name',
					'label' => 'Final Port of Discharge (FPOD)',
					'rules' => 'required'
				),
				array(
					'field' => 'receiving_type',
					'label' => 'Receiving Type',
					'rules' => 'required'
				)
			);

			//declare form validation pemesanan penerimaan internasional
			$internasional = array(
				array(
					'field' => 'peb_no',
					'label' => 'PEB Number',
					'rules' => 'required'
				),
				array(
					'field' => 'npe_no',
					'label' => 'NPE Number',
					'rules' => 'required'
				),
				array(
					'field' => 'booking_ship_no',
					'label' => 'Booking Ship Number',
					'rules' => 'required'
				),
				array(
					'field' => 'peb_dt',
					'label' => 'PEB Date',
					'rules' => 'required'
				)
			);

			if($this->input->post()) {
				if($port[1] == 'T3I' || $port[1] == 'PNJI' || $port[1] == 'PLMI' || $port[1] == 'PNKI') {
					foreach($internasional as $config_internasional) {
						array_push($config, $config_internasional);
					}
				}

				$this->form_validation->set_rules($config); //setting rules inputan pemesanan penerimaan

				if($this->form_validation->run() == false) {
					echo 'salah';
				}
			}

			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<header>
						<peb_no>$peb_no</peb_no>
						<npe_no>$npe_no</npe_no>
						<booking_ship_no>$booking_ship_no</booking_ship_no>
						<gate_in_date>$gate_in_date</gate_in_date>
						<customer_id>$customer_id</customer_id>
						<submitter_customer_id>$submitter_customer_id</submitter_customer_id>						   
						<customer_name>$customer_name</customer_name>
						<customer_npwp>$customer_npwp</customer_npwp>
						<customer_address>$customer_address</customer_address>
						<port>$port</port>
						<ukk>$ukk</ukk>
						<pod>$pod</pod>
						<fpod>$fpod</fpod>
						<pod_name>$pod_name</pod_name>
						<fpod_name>$fpod_name</fpod_name>
						<trading_type>$trading_type</trading_type>
						<request_no>$request_no</request_no>
						<receiving_type>$receiving_type</receiving_type>
						<start_shift>$start_shift</start_shift>
						<end_shift>$end_shift</end_shift>
						<id_user>".$this->session->userdata('userid_simop')."</id_user>
						<id_user_eservice>".$this->session->userdata('uname_phd')."</id_user_eservice>
						<vessel>$vessel</vessel>
						<voyage_in>$voyin</voyage_in>
						<voyage_out>$voyout</voyage_out>
						<nospp>$nospp</nospp>
						<nosppdom>$nosppdom</nosppdom>
						<nosuratjalan>$nosuratjalan</nosuratjalan>
						<bookingship009>$bookingship009</bookingship009>
						<bookingshipdom>$bookingshipdom</bookingshipdom>
						<peb_dt>$peb_dt</peb_dt>
            			<idship_cons>$idship_cons</idship_cons>
						<tgl_npe>$tgl_npe</tgl_npe>
						<receiving_via>$receiving_via</receiving_via>
						<ship_line>$ship_line</ship_line>
					</header>
				</data>
			</root>";
			injek($in_data);

			if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"requestReceivingHeader",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				echo $result;die;
				exit;

				$obj = json_decode($result);


				if($obj->data->info)
				{
					/*$data['no_container'] = $obj->data->request_no;*/
				}
			}
		}

		if(isset($_POST['submit_container']))
		{
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$fix_char		= array(" ", " ", " ", " ", " ");

			$request_no=isset($_POST['request_no']) ? htmLawed($_POST['request_no']) : '';
			$container_no=isset($_POST['container_no']) ? htmLawed($_POST['container_no']) : '';
			$container_size=isset($_POST['container_size']) ? htmLawed($_POST['container_size']) : '';
			$container_type=isset($_POST['container_type']) ? htmLawed($_POST['container_type']) : '';
			$container_status=isset($_POST['container_status']) ? htmLawed($_POST['container_status']) : '';
			$container_height=isset($_POST['container_height']) ? htmLawed($_POST['container_height']) : '';
			$container_weight=isset($_POST['container_weight']) ? htmLawed($_POST['container_weight']) : '';
			$container_operator=isset($_POST['container_operator']) ? htmLawed($_POST['container_operator']) : '';
			$container_dangerous=isset($_POST['container_dangerous']) ? htmLawed($_POST['container_dangerous']) : '';
			$container_transit=isset($_POST['container_transit']) ? htmLawed($_POST['container_transit']) : '';
			$number_booking_ship=isset($_POST['number_booking_ship']) ? htmLawed($_POST['number_booking_ship']) : '';																							
			$container_imo=isset($_POST['container_imo']) ? htmLawed($_POST['container_imo']) : '';
			$container_un=isset($_POST['container_un']) ? htmLawed($_POST['container_un']) : '';
			$container_temperature=isset($_POST['container_temperature']) ? htmLawed($_POST['container_temperature']) : '';
			$container_excess_width=isset($_POST['container_excess_width']) ? htmLawed($_POST['container_excess_width']) : '';
			$container_excess_height=isset($_POST['container_excess_height']) ? htmLawed($_POST['container_excess_height']) : '';
			$container_excess_length=isset($_POST['container_excess_length']) ? htmLawed($_POST['container_excess_length']) : '';

			$container_excess_left=isset($_POST['container_excess_left']) ? htmLawed($_POST['container_excess_left']) : '';
			$container_excess_right=isset($_POST['container_excess_right']) ? htmLawed($_POST['container_excess_right']) : '';
			$container_excess_front=isset($_POST['container_excess_front']) ? htmLawed($_POST['container_excess_front']) : '';
			$container_excess_rear=isset($_POST['container_excess_rear']) ? htmLawed($_POST['container_excess_rear']) : '';

			$trading_type=isset($_POST['trading_type']) ? htmLawed($_POST['trading_type']) : '';
			$carrier   =isset($_POST['carrier']) ? htmLawed($_POST['carrier']) : '';
			$port   =isset($_POST['port']) ? htmLawed($_POST['port']) : '';
			$commodity   =isset($_POST['commodity']) ? htmLawed($_POST['commodity']) : '';
			$tl_type=isset($_POST['tl_type']) ? htmLawed($_POST['tl_type']) : '';
			$vgm=isset($_POST['vgm']) ? htmLawed($_POST['vgm']) : '';
			$nor=isset($_POST['nor']) ? htmLawed($_POST['nor']) : 'N';
			// return json_encode($request_no.' a');

			$reqNoBiller=$this->container_model->getNumberRequestBiller($request_no);

			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<detail>
						<request_no>$reqNoBiller</request_no>
						<container_no>$container_no</container_no>
						<size>$container_size</size>
						<type>$container_type</type>
						<status>$container_status</status>
						<height>$container_height</height>
						<weight>$container_weight</weight>
						<operator>$container_operator</operator>
						<dangerous>$container_dangerous</dangerous>
						<transit>$container_transit</transit>
						<booking_ship>$number_booking_ship</booking_ship>   
						<imo>$container_imo</imo>
						<un>$container_un</un>
						<temperature>$container_temperature</temperature>
						<excess_width>$container_excess_width</excess_width>
						<excess_height>$container_excess_height</excess_height>
						<excess_length>$container_excess_length</excess_length>
						
						<excess_left>$container_excess_left</excess_left>
						<excess_right>$container_excess_right</excess_right>
						<excess_front>$container_excess_front</excess_front>
						<excess_rear>$container_excess_rear</excess_rear>

						<trading_type>$trading_type</trading_type>
						<carrier>$carrier</carrier>
						<port>$port</port>
						<commodity>$commodity</commodity>
						<tl_type>$tl_type</tl_type>
						<nor>$nor</nor>
						<vgm>$vgm</vgm>
					</detail>
				</data>
			</root>";
			injek($in_data);
			// print_r($in_data);
			// die();
			if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"requestReceivingDetail",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				echo $result;die;
				exit;

				$obj = json_decode($result);
			}
		}

		$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Receiving Booking", 'container_receiving/main_receiving');
		$this->breadcrumbs->push("Receiving Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Add Receiving Booking";

		$this->common_loader($data,'pages/container/add_receiving');
	}
	
	public function update_commodity() {
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		$inv_char 	= array("&", "\"", "'", "<", ">");
		$fix_char		= array(" ", " ", " ", " ", " ");
		$request_no=isset($_POST['request_no']) ? htmLawed($_POST['request_no']) : '';
		$all_commodity=isset($_POST['all_commodity']) ? htmLawed($_POST['all_commodity']) : '';
		$port=isset($_POST['port']) ? htmLawed($_POST['port']) : '';
		
		$reqNoBiller=$this->container_model->getNumberRequestBiller($request_no);
		
		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<detail>
					<request_no>$reqNoBiller</request_no>
					<all_commodity>$all_commodity</all_commodity>
					<port>$port</port>
				</detail>
			</data>
		</root>";
		injek($in_data);

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"updateCommodity",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;die;
			exit;

			$obj = json_decode($result);
		}
	}

	public function print_proforma_atch($id_req,$id_port,$id_terminal,$hash){
		//tanpa otentikasi user

		//generate hash
		$customer_id=$this->container_model->getCustomerId($id_req);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($id_req.$customer_id);

		if($hash!=$hash_check)
		{
			if($group_id!="m")
				return;
		}

		$this->load->helper('pdf_helper');
		$reqbiller=$this->container_model->getNumberRequestBiller($id_req);

		$request_no=isset($_GET['req_id']) ? htmLawed($_GET['req_id']) : '' ;

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<detail>
				<no_request>$reqbiller</no_request>
				<no_request_ol>$id_req</no_request_ol>
				<port_code>$id_port</port_code>
				<terminal_code>$id_terminal</terminal_code>
				</detail>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getPDFProformaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);
			//$tbl=base64_decode($obj->data->proforma_html);
			//print_r($tbl); die();
			if($obj->data->proforma_html){

			//update activity log
			if($group_id!="m")
				$this->container_model->updateTransactionLogActivity($id_req,"PRINT_PROFORMA",$id_user_eservice=$this->session->userdata('uname_phd'));

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

			// Get Logo
			$hdrGrup = $obj->data->hdrGrup;
			$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
			// print_r($hdrGrup);
			// die();
			$query = $this->db->query($query, array($id_port,$id_terminal,$hdrGrup));
			$hasil = $query->row_array();
			$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

			$tbl=base64_decode($obj->data->proforma_html);

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

			// print_r($logo);
			// die();
			$pdf->AddPage();
			// set font
			$pdf->SetFont('helvetica', '', 10);
			//Menampilkan Barcode dari nomor nota
			//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			//Logo IPC
			//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
			//$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->setPage(1);
			//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 12, 18, 12, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.$logo, 5, 12, 18, 12, '', '', '', true, 500);			
			$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');

			$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
			$pdf->SetFont('helvetica', 'B', 9);
			//Close and output PDF document
			$pdf->Output($_SERVER['DOCUMENT_ROOT']."/ibis/attachment/$id_req.pdf", 'I');
			}
			else{
				echo "NO,GAGAL";
			}
		}
	}

	public function print_proforma($id_req,$id_port,$id_terminal,$hash=""){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($id_req))
		{
			return;
		}

		$hash = md5($id_req.$this->session->userdata('customerid_phd'));

		$this->print_proforma_atch($id_req,$id_port,$id_terminal,$hash);
	}

	public function print_proforma_thermal($id_req,$id_port,$id_terminal,$hash=""){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		if($hash!=md5($id_req))
		{
			return 'fail';
		}

		$hash = md5($id_req.$this->session->userdata('customerid_phd'));

		$this->print_proatch_thermal($id_req,$id_port,$id_terminal,$hash);
	}

	public function print_proatch_thermal($id_req,$id_port,$id_terminal,$hash){
		//tanpa otentikasi user

		//generate hash
		$customer_id=$this->container_model->getCustomerId($id_req);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($id_req.$customer_id);

		if($hash!=$hash_check)
		{
			if($group_id!="m")
				return;
		}

		$this->load->helper('pdf_helper');
		$reqbiller=$this->container_model->getNumberRequestBiller($id_req);

		$request_no=isset($_GET['req_id']) ? htmLawed($_GET['req_id']) : '' ;

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<detail>
				<no_request>$reqbiller</no_request>
				<no_request_ol>$id_req</no_request_ol>
				<port_code>$id_port</port_code>
				<terminal_code>$id_terminal</terminal_code>
				</detail>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getPDFPro_thermal",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;

			$obj = json_decode($result);
			//$tbl=base64_decode($obj->data->proforma_html);
			//print_r($tbl); die();
			if($obj->data->proforma_html){

			//update activity log
			if($group_id!="m")
				$this->container_model->updateTransactionLogActivity($id_req,"PRINT_PROFORMA",$id_user_eservice=$this->session->userdata('uname_phd'));

			$this->load->helper('pdf_helper');
			tcpdf();
			// create new PDF document
			//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

			$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
			//print_r('test4');die;
			// set header and footer fonts
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			//set margins
			$pdf->SetMargins(3,17, 0);
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
			// Get Logo
			$hdrGrup = $obj->data->hdrGrup;
			$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
			$query = $this->db->query($query, array($id_port,$id_terminal,$hdrGrup));
			$hasil = $query->row_array();
			$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

			$tbl=base64_decode($obj->data->proforma_html);

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
			$pdf->SetFont('helvetica', 'I', 5);
			//Menampilkan Barcode dari nomor nota
			//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			//Logo IPC
			//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
			//$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->setPage(1);
			//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 20, 14, 8, '', '', '', true, 72);
			//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 3, 22, 9, 6, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.$logo, 3, 22, 9, 6, '', '', '', true, 500);
			$pdf->write1DBarcode($obj->data->proforma_id, 'C128', 0, 0, '', 18, 0.4, $style, 'N');

			$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
			$pdf->SetFont('helvetica', 'B', 9);
			//Close and output PDF document
			$pdf->Output($_SERVER['DOCUMENT_ROOT']."/ibis/attachment/$id_req.pdf", 'I');
			}
			else{
				echo "NO,GAGAL";
			}
		}
	}

	public function print_nota_atch($no_request,$port_code,$terminal_code,$hash)
	{

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
			//return;
		}

		$this->load->helper('pdf_helper');

		$nobiller=$this->container_model->getNumberRequestBiller($no_request);
		//$agent_id=25169;

		//create inovoice qr code
		//data hasil qr code
		$hash = md5(ROOT."invoice/val_invoice/1/rec/$no_request/$port_code/$terminal_code/");

		//val_invoice/{validation_version}/{service_type}/{no_request}/{port_code}/{terminal_code}/{challenge_code}
		//pada versi 1, digunakan challenge_code untuk menguji bahwa url yang terbentuk benar hanya dari sistem ipc
		$params['data'] = ROOT."invoice/val_invoice/1/rec/$no_request/$port_code/$terminal_code/$hash";
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = UPLOADFOLDER_.'qr_code/tes.png';
		$this->ciqrcode->generate($params);


		$barcode_location=APP_ROOT.'qr_code/tes.png';
		//$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
		if ($port_code=='IDPNJ')
		{
			$ttd_location = APP_ROOT."config/images/cr/ttd_pjg.png";
		} else {
			$ttd_location = APP_ROOT."config/images/cr/ttd2.png";
		}
		$user = $this->session->userdata('uname_phd');

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<no_request>$nobiller</no_request>
				<no_request_ol>$no_request</no_request_ol>
				<port_code>$port_code</port_code>
				<terminal_code>$terminal_code</terminal_code>
				<barcode_location>$barcode_location</barcode_location>
				<ttd_location>$ttd_location</ttd_location>
				<user>".$user."</user>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getPDFNotaContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);die;
			$obj = json_decode($result);

			if($obj->data->html_tcpdf)
			{
				$footerhtml = base64_decode($obj->data->footer);
				$lampiran_nota = base64_decode($obj->data->lampiran);
				
				//update activity log
				if($group_id!="m")
					$billerId=$this->container_model->updateTransactionLogActivity($no_request,"PRINT_INVOICE",$id_user_eservice=$this->session->userdata('uname_phd'));

				$this->load->helper('pdf_helper');

				tcpdf();
				$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


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
				$pdf->SetAutoPageBreak(TRUE, 10);

				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				//set some language-dependent strings
				$pdf->setLanguageArray(null);

				// Get Logo
				$org_id = $obj->data->org_id;
				$query="SELECT logo FROM mst_labeling WHERE port = ? and terminal = ? and org_id = ? ";
				$query = $this->db->query($query, array($port_code,$terminal_code,$org_id));
				$hasil = $query->row_array();
				$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

				$tbl=base64_decode($obj->data->html_tcpdf);
				//print_r($tbl); die();

				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 9);
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdf->writeHTML($footerhtml, true, false, false, false, '');
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				$pdf->AddPage();
				$pdf->writeHTML($lampiran_nota, true, false, false, false, '');
				$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

				$pdf->setPage(1);
				//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				$pdf->Image(APP_ROOT.$logo, 5, 4, 30, 15, '', '', '', true, 500);
				//$pdf->Image(APP_ROOT.'config/images/cr/ttd2.jpg', 175, 260, 30, 15, '', '', '', true, 72);

				$pdf->SetFont('helvetica', 'B', 9);
				//Close and output PDF document
				$pdf->Output('nota_jasa_kepelabuhanan - '.$obj->data->faktur_id.'.pdf', 'I');

			} else {
				echo "NO,GAGAL";
			}
		}
	}

	public function print_nota($no_request,$port_code,$terminal_code,$hash=""){

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

		$this->print_nota_atch($no_request,$port_code,$terminal_code,$hash);
	}

    public function auto_pod(){
        $term       = htmLawed($_POST["term"]);
				$vessel     = htmLawed($_POST["vessel"]);
        $voyage_in  = htmLawed($_POST["voyin"]);
        $voyage_out = htmLawed($_POST["voyout"]);
        $port=explode("-",htmLawed($_POST["port"]));

        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<pod>$term</pod>
				<vessel>$vessel</vessel>
				<voyage_in>$voyage_in</voyage_in>
				<voyage_out>$voyage_out</voyage_out>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		//log_message('error','>>>>>>>>>> data: '.json_encode($in_data));
		//echo "string"; die();
		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getAutoPOD",array("in_data" => "$in_data"),$result))
		{

			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);
			//log_message('error','>>>>>>>>>> auto POD: '.$result);
			$stack1	= array();
			if($obj->data->pod){
			  for($i=0;$i<count($obj->data->pod);$i++)
				{
					$temp;
					$temp['NM_PELABUHAN']=$obj->data->pod[$i]->nm_pelabuhan;
					$temp['ID_PELABUHAN']=$obj->data->pod[$i]->id_pelabuhan;
					array_push($stack1, $temp);
				}
			}
		}
        echo json_encode($stack1);
    }

	public function auto_pod_new(){
        $term       = htmLawed($_POST["term"]);
		$vessel     = htmLawed($_POST["vessel"]);
        $voyage_in  = htmLawed($_POST["voyin"]);
        $voyage_out = htmLawed($_POST["voyout"]);
        $port=explode("-",htmLawed($_POST["port"]));
		//print_r('test');die;
        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel>$vessel</vessel>
				<voyage_in>$voyage_in</voyage_in>
				<voyage_out>$voyage_out</voyage_out>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		//log_message('error','>>>>>>>>>> data: '.json_encode($in_data));

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getAutoPODNew",array("in_data" => "$in_data"),$result))
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
			if($obj->data->pod){
			  for($i=0;$i<count($obj->data->pod);$i++)
				{
					$temp;
					$temp['NM_PELABUHAN']=$obj->data->pod[$i]->nm_pelabuhan;
					$temp['ID_PELABUHAN']=$obj->data->pod[$i]->id_pelabuhan;
					array_push($stack1, $temp);
				}
			}
		}
        //echo json_encode($stack1);
				$cbpod 	= "<select name='pod' id='pod' class='form-control'>";
				$cbpod  .= "<option value=''>---Pilih---</option>";
				foreach ($stack1 as $key) {
					$cbpod .="<option value='".$key['ID_PELABUHAN']."'><b>".$key['ID_PELABUHAN'].'</b> : '.$key['NM_PELABUHAN']."</option>";
				}
				$cbpod .= "</select>";

				echo  $cbpod;

    }

public function get_shipper(){
        $term       = htmLawed($_POST["term"]);
		$vessel     = htmLawed($_POST["vessel"]);
        $voyage_in  = htmLawed($_POST["voyin"]);
        $voyage_out = htmLawed($_POST["voyout"]);
        $port=explode("-",htmLawed($_POST["port"]));
		//print_r('test');die;
        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel>$vessel</vessel>
				<voyage_in>$voyage_in</voyage_in>
				<voyage_out>$voyage_out</voyage_out>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		//log_message('error','>>>>>>>>>> data: '.json_encode($in_data));

		if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER,"getListShipLine",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			//print_r($result);
			//die();
			$obj = json_decode($result);
			//log_message('error','>>>>>>>>>> auto POD: '.$result);
			$stack1	= array();
			if($obj->data->listshipper){
			  for($i=0;$i<count($obj->data->listshipper);$i++)
				{
					$temp;
					$temp['NM_PELABUHAN']=$obj->data->listshipper[$i]->nama;
					$temp['ID_PELABUHAN']=$obj->data->listshipper[$i]->id_ship;
					array_push($stack1, $temp);
				}
			}
		}
        //echo json_encode($stack1);
				$cbpod 	= "<select name='ship_line_data' id='ship_line_data' class='form-control'>";
				$cbpod  .= "<option value=''>---Pilih---</option>";
				foreach ($stack1 as $key) {
					$cbpod .="<option value='".$key['ID_PELABUHAN']."'><b>".$key['NM_PELABUHAN']."</b></option>";
				}
				$cbpod .= "</select>";

				echo  $cbpod;

    }



    public function auto_carrier(){
        $term       = htmLawed($_GET["term"]);
        $vessel     = htmLawed($_GET["vessel"]);
        $port=explode("-",htmLawed($_GET["port"]));

        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<carrier>$term</carrier>
				<vessel>$vessel</vessel>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getCarrierContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result; die;
			$obj = json_decode($result);
			if($obj->data->pod){
			  for($i=0;$i<count($obj->data->pod);$i++)
				{
					$temp;
					$temp['CODE']=$obj->data->pod[$i]->code;
					$temp['LINE_OPERATOR']=$obj->data->pod[$i]->line_operator;
					array_push($stack1, $temp);
				}
			}
		}

        echo json_encode($stack1);

    }

    public function getListContainer(){
        $norequest = ($_POST["request_no"]);
        $port = explode("-",($_POST["port"]));
        $reply = array();

        $stack = array();
		$reqNoBiller=$this->container_model->getNumberRequestBiller($norequest);
        $in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$reqNoBiller</norequest>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		injek($in_data);

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getListContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			//echo $result;die;
			if($obj->data->listcont)
			{
				for($i=0;$i<count($obj->data->listcont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->listcont[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->listcont[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->listcont[$i]->type_cont;
					$temp['STATUS_CONT']=$obj->data->listcont[$i]->status_cont;
					$temp['HZ']=$obj->data->listcont[$i]->hz;
					$temp['KD_COMODITY']=$obj->data->listcont[$i]->kd_comodity;
					$temp['NM_COMMODITY']=$obj->data->listcont[$i]->nm_commodity;
					$temp['ID_CONT']=$obj->data->listcont[$i]->id_cont;
					$temp['ISO_CODE']=$obj->data->listcont[$i]->iso_code;
					$temp['HEIGHT']=$obj->data->listcont[$i]->height;
					$temp['CARRIER']=$obj->data->listcont[$i]->carrier;
					$temp['OG']=$obj->data->listcont[$i]->og;
					$temp['NO_BOOKING_SHIP']=$obj->data->listcont[$i]->no_booking_ship;
					$temp['TL_FLAG']=$obj->data->listcont[$i]->tl_flag;
					$temp['TEMP']=$obj->data->listcont[$i]->temp;
					$temp['TRANSIT']=$obj->data->listcont[$i]->transit;

					array_push($stack, $temp);
				}
			}
		}

        //print_r($stack); die();
        $data['detail'] = $stack;
		$data['no_request'] = $norequest;
        $this->load->view('pages/container/get_detail_receiving', $data);
    }

    public function auto_commodity(){
        $term       = htmLawed($_GET["term"]);
        $port=explode("-",htmLawed($_GET["port"]));

        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<commodity>$term</commodity>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getCommodityContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			$stack1=array();
			if($obj->data->comm){
			  for($i=0;$i<count($obj->data->comm);$i++)
				{
					$temp;
					$temp['KD_COMMODITY']=$obj->data->comm[$i]->kd_commodity;
					$temp['COMMODITY']=$obj->data->comm[$i]->commodity;
					array_push($stack1, $temp);
				}
			}
		}

        echo json_encode($stack1);

    }

    public function save_request_receiving(){
        $requestno = htmLawed($_POST["request_no"]);
				$reqNoBiller = $this->container_model->getNumberRequestBiller($requestno);
        $port=explode("-",htmLawed($_POST["port"]));

        $in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<biller_request_id>$reqNoBiller</biller_request_id>
						<port_code>".$port[0]."</port_code>
						<terminal_code>".$port[1]."</terminal_code>
					</data>
				</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getCountContainer",array("in_data" => "$in_data"),$result))
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

        $in_data="<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <detail>
                    <request_no>$reqNoBiller</request_no>
                    <port_code>".$port[0]."</port_code>
                    <terminal_code>".$port[1]."</terminal_code>
					<user_id>".$this->session->userdata('uname_phd')."</user_id>
                </detail>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"submitRequestReceiving",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			print_r($result);
			die();
			echo $result;
			exit;
		}
    }

    public function print_card($no_request,$port_code,$terminal_code){
		return;
        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$no_request</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getPDFCardContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			//$tbl=base64_decode($obj->data->proforma_html);
			//print_r($tbl); die();
			$total = $obj->data->jumlah;
			//print_r(count($obj->data->detail_card));
			if($obj->data->detail_card){

				$this->load->helper('pdf_helper');
			   tcpdf();
			// create new PDF document
			//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
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

			//set some language-dependent strings
			$pdf->setLanguageArray(null);


// ---------------------------------------------------------
			//print_r($rowz); die();
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
				$status_cont            =$obj->data->detail_card[$i]->status_cont;
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
				$pdf->AddPage();
				// set font
				$pdf->SetFont('courier', '', 6);
				$tbl = <<<EOD
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


			//Menampilkan Barcode dari nomor nota
			//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			//Logo IPC
			//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
			$pdf->Image(APP_ROOT.'user_guide/images/ipcblack.png', 3, 17, 9, 6, '', '', '', true, 72);
			$pdf->write1DBarcode("$nocont", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->write1DBarcode("$nocont", 'C128', 0, 100, '', 18, 0.4, $style, 'N');

				$nourut++;
			}



			$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
			$pdf->SetFont('courier', 'B', 6);
			//Close and output PDF document
			$pdf->Output('sample.pdf', 'I');
			}
			else{
				echo "NO,GAGAL";
			}
		}
    }

	public function print_card2_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

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

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getPDFCardContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
					//echo $result;die;
                    $obj = json_decode($result);
					//echo $result;die;
                    //$tbl=base64_decode($obj->data->proforma_html);
                    //print_r($tbl); die();
                    $total = $obj->data->jumlah;
                    //print_r(count($obj->data->detail_card));
					$rowz = array();

					//update activity log
					$this->container_model->updateTransactionLogActivity($no_request,"PRINT_CARD",$id_user_eservice=$this->session->userdata('uname_phd'));

					//validasi limit cetakan kartu
					$cetakan_ke = $this->container_model->getCountCardPrint($no_request);
					$vld = $this->container_model->getValidCardPrint($cetakan_ke,'REC');
					//echo $vld;die;

				if($vld=="Y")
				{

                    if($obj->data->detail_card){

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
                    $nourut = 1;
                    $shipper="";
					for($i=0;$i<count($obj->data->detail_card);$i++){
                        $nocont = strtoupper($obj->data->detail_card[$i]->no_container);
                       // echo $nocont; die();
                        $prefx = strtoupper($obj->data->detail_card[$i]->prefix);
                        $clossing_time        =$obj->data->detail_card[$i]->clossing_time;
						$paid_thru2           =$obj->data->detail_card[$i]->paidthru;
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
						$oh              =$obj->data->detail_card[$i]->oh;
						$ol              =$obj->data->detail_card[$i]->ol;
						$ow              =$obj->data->detail_card[$i]->ow;
	   				$start_shift              =$obj->data->detail_card[$i]->start_shift;
						$end_shift              =$obj->data->detail_card[$i]->end_shift;
	          $nama_komodity              =$obj->data->detail_card[$i]->nama_komodity;
						$nama_shipper              =$obj->data->detail_card[$i]->nama_shipper;

						//**** Get corporate, terminal, and logo
						$hdrGrup = $obj->data->detail_card[$i]->hdrGrup;
						$query="SELECT port_name, terminal_name, logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
						if($port_code == 'IDPLM'){
							$query = $this->db->query($query, array('IDPLG',$terminal_code,$hdrGrup));
						} else{
							$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
						}
						
						
						$hasil = $query->row_array();
						$corporate_name = isset($hasil['PORT_NAME']) ? $hasil['PORT_NAME'] : '';
						$terminal_name = isset($hasil['TERMINAL_NAME']) ? $hasil['TERMINAL_NAME'] : '';
						$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

						if($paid_thru2<>'')
						{
							$paid_thru = $paid_thru2." 23:59";
						}
						else
						{
							$paid_thru = $paid_thru2;
						}


            //added shipper khusus jambi&tlk bayur
						if($terminal_name=="Area Jambi" || $terminal_name=="Area Teluk Bayur"){
							$shipper = '
							<br/>
							<tr>
								<td align="left">
									<b><font size="10">Shipper: '.$nama_shipper.'</font></b>
								</td>
								
							</tr>
							';
						}
                        $pdf->AddPage();
					    // set font
					    $pdf->SetFont('courier', '', 6);
						$tbl0= <<<EOD
						<table width="95%">
							<tr>
								<td COLSPAN="6" align="right"><b><font size="18">Gate Pass Receiving Online</font></b></td>
							</tr>
							<tr>
								<td>
								</td>
							</tr>
							<tr>
								<td width="10%">&nbsp;</td>
								<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;$corporate_name</font></b></td>
							</tr>
							<tr>
								<td>
								</td>
							</tr>
							<tr>
								<td width="10%">&nbsp;</td>
								<td COLSPAN="5" align="left"><b><font size="12">&nbsp;&nbsp;$terminal_name</font></b></td>
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
									<b><font size="8">Temperatur (Celcius) / (Start Shift)</font></b>
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
									<b><font size="8">$temp / ($start_shift)</font></b>
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
									<b><font size="10">Status TL || Commodity</font></b>
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
									<b><font size="12">$status_tl || $nama_komodity</font></b>
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
									<b><font size="10">POL / POD / FPOD</font></b>
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
									<b><font size="12">$ipol / $ipod / $fipod</font></b>
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
									<b><font size="9">$kode_pbm</font></b>
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
									<b><font size="8">OH/OW/OL</font></b>
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
									<b><font size="8">$oh/$ow/$ol</font></b>
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
									<b><font size="8">Temperatur (Celcius) / (Start Shift)</font></b>
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
								<b><font size="8">$temp / ($start_shift)</font></b>
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
									<b><font size="10">POL / POD / FPOD</font></b>
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
									<b><font size="12">$ipol / $ipod / $fipod</font></b>
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
									<b><font size="9">$kode_pbm</font></b>
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
									<b><font size="8">OH/OW/OL</font></b>
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
									<b><font size="8">$oh/$ow/$ol</font></b>
								</td>
							</tr>
              $shipper
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


					//Menampilkan Barcode dari nomor nota
					//$pdf->write1DBarcode("$notanya", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
					//Logo IPC
					//$pdf->Image('images/ipc2.jpg', 50, 7, 20, 10, '', '', '', true, 72);
					//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 10, 9, 18, 12, '', '', '', true, 72);
					$pdf->Image(APP_ROOT.$logo, 10, 9, 18, 12, '', '', '', true, 500);
					$pdf->Image(APP_ROOT.'config/cube/img/eir2.png', 15, 116, 180, 50, '', '', '', true, 72);
					//$pdf->writeHTML($tbl, true, false, false, false, '');
					$pdf->writeHTML($tbl0, true, false, false, false, '');
                    $pdf->write1DBarcode("$nocont", 'C128', 18, 30, '', 18, 0.4, $style, 'N');
					$pdf->write1DBarcode("PIN", 'C128', 130, 30, '', 18, 0.4, $style, 'N');
                    $pdf->write1DBarcode("$nocont", 'C128', 18, 198, '', 18, 0.4, $style, 'N');
					$pdf->write1DBarcode("PIN", 'C128', 130, 198, '', 18, 0.4, $style, 'N');

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
                        echo "NO,GAGAL";
                    }

				}
				else
				{
                    echo "CETAKAN KE-".$cetakan_ke."\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
                }

		}
	}

	public function print_card2($no_request,$port_code,$terminal_code,$hash=""){

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

		$this->print_card2_atch($no_request,$port_code,$terminal_code,$hash);
    }


	public function print_card_thermal_atch($no_request,$port_code,$terminal_code,$hash){

		//generate hash
		$customer_id=$this->container_model->getCustomerId($no_request);
		$group_id = $this->session->userdata('group_phd');

		$hash_check = md5($no_request.$customer_id);

		if($hash!=$hash_check)
		{
				return;
		}

		$card_password = $billerId=$this->user_model->get_pdf_password($this->session->userdata('uname_phd'));
		$nobiller=$this->container_model->getNumberRequestBiller($no_request);
		$curdate = date('d/m/Y H:i');

        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <no_request>$nobiller</no_request>
                <port_code>$port_code</port_code>
                <terminal_code>$terminal_code</terminal_code>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"getCardContainerThermal",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
					// echo $result;die;
                    $obj = json_decode($result);
					//echo $result;die;
                    //$tbl=base64_decode($obj->data->proforma_html);
                    //print_r($tbl); die();
                    $total = $obj->data->jumlah;
                    //print_r(count($obj->data->detail_card));
					$rowz = array();

					//update activity log
					$this->container_model->updateTransactionLogActivity($no_request,"PRINT_CARD",$id_user_eservice=$this->session->userdata('uname_phd'));

					//validasi limit cetakan kartu
					$cetakan_ke = $this->container_model->getCountCardPrint($no_request);
					$vld = $this->container_model->getValidCardPrint($cetakan_ke,'REC');
					//echo $vld;die;

				if($vld=="Y")
				{

                    if($obj->data->detail_card){

                    $this->load->helper('pdf_helper');
					tcpdf();
					// create new PDF document
					//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					//$pdf = new TCPDF('P', 'mm', 'A7', true, 'UTF-8', false);
                    $pdf = new TCPDF('P', 'mm', Array(80,130), true, 'UTF-8', false);


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
					$pdf->SetMargins(1, 1, 1);
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
                    $nourut = 1;
					for($i=0;$i<count($obj->data->detail_card);$i++){
                        $nocont = strtoupper($obj->data->detail_card[$i]->no_container);
                       // echo $nocont; die();
                        $prefx = strtoupper($obj->data->detail_card[$i]->prefix);
                        $clossing_time        =$obj->data->detail_card[$i]->clossing_time;
						$paid_thru2           =$obj->data->detail_card[$i]->paidthru;
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
						$no_nota              =$obj->data->detail_card[$i]->no_nota;
						$start_shift              =$obj->data->detail_card[$i]->start_shift;
            $nama_comodity        = $obj->data->detail_card[$i]->nama_comodity;
						//$no_nota              =$obj->data->detail_card[$i]->no_nota;


						//**** Get corporate, terminal, and logo
						$hdrGrup = $obj->data->detail_card[$i]->hdrGrup;
						$query="SELECT port_name, terminal_name, logo FROM mst_labeling WHERE port = ? and terminal = ? and grup = ? ";
						if($port_code == 'IDPLM'){
							$query = $this->db->query($query, array('IDPLG',$terminal_code,$hdrGrup));
						}else{
							$query = $this->db->query($query, array($port_code,$terminal_code,$hdrGrup));
						}
						$hasil = $query->row_array();
						$corporate_name = isset($hasil['PORT_NAME']) ? $hasil['PORT_NAME'] : '';
						$terminal_name = isset($hasil['TERMINAL_NAME']) ? $hasil['TERMINAL_NAME'] : '';
						$logo = isset($hasil['LOGO']) ? $hasil['LOGO'] : '';

						if($paid_thru2<>'')
						{
							$paid_thru = $paid_thru2." 23:59";
						}
						else
						{
							$paid_thru = $paid_thru2;
						}

                        $pdf->AddPage();
					    // set font
					    $pdf->SetFont('courier', '', 6);
						        $tbl = <<<EOD
            <table width="95%">
                <tr>
                    <td COLSPAN="6" align="center"><b><font size="10">&nbsp;&nbsp;$corporate_name</font></b></td>
                </tr>
                <tr>
                    <td COLSPAN="6" align="center"><b><font size="12">$terminal_name</font></b></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td COLSPAN="2" align="left"><b><font size="12">L<br/>$prefx<br/>$cont_numb<br/>$status_cont</font></b></td>
                    <td COLSPAN="2" align="center"><b><font size="9">&nbsp;<br/>$iso_code<br/>$type_cont<br/>$temp<br/>$start_shift</font></b></td>
                    <td COLSPAN="2" align="right"><b><font size="10">$nourut/$total&nbsp;&nbsp;&nbsp;&nbsp;<br/>$berat&nbsp;&nbsp;&nbsp;&nbsp;<br/>$status_tl&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td>
                </tr>
                <tr>
                    <td COLSPAN="8" align="right"><font size="9"><b>$nama_comodity</b></font></td>
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
                    <td COLSPAN="6" align="center"><b><font size="10">PRINT : $curdate</font></b></td>
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
                    <td width="70" align="left"><b><font size="10">Invoice</font></b></td>
                    <td width="10">:</td>
                    <td COLSPAN="4"><b><font size="10">$no_nota</font></b></td>
                </tr>
                <tr>
                    <td width="70" align="left"><b><font size="10">Performa</font></b></td>
                    <td width="10">:</td>
                    <td COLSPAN="4"><b><font size="10">$nobiller</font></b></td>
                </tr>
                <tr>
                    <td width="70" align="left"><b><font size="10">Paid Thru</font></b></td>
                    <td width="10">:</td>
                    <td COLSPAN="4"><b><font size="10">$paid_thru2</font></b></td>
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

					//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 3, 17, 9, 6, '', '', '', true, 72);
					$pdf->Image(APP_ROOT.$logo, 3, 17, 9, 6, '', '', '', true, 500);
					$pdf->write1DBarcode("$nocont", 'C128', 0, 0, '', 18, 0.4, $style, 'N');
					$pdf->writeHTML($tbl, true, false, false, false, '');
					$pdf->write1DBarcode("$nocont", 'C128', 0, 100, '', 18, 0.4, $style, 'N');

                        $nourut++;
                    }

					$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
					$pdf->SetFont('courier', 'B', 6);
					//Close and output PDF document
					$pdf->Output('sample.pdf', 'I');
                    }
                    else{
                        echo "NO,GAGAL";
                    }

				}
				else
				{
                    echo "CETAKAN KE-".$cetakan_ke."\n SUDAH MELEBIHI BATAS CETAK KARTU, SILAKAN HUBUNGI CUSTOMER CARE";
                }

		}
	}

	public function print_card_thermal($no_request,$port_code,$terminal_code,$hash=""){

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

		$this->print_card_thermal_atch($no_request,$port_code,$terminal_code,$hash);
    }

	public function upload_excel(){
			include_once ( APPPATH."libraries/excel_reader2.php");

			//membaca file excel yang diupload
			$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
			//membaca jumlah baris dari data excel
			$baris = $data->rowcount($sheet_index = 0);
			//echo $baris;

			//nilai awal counter jumlah data yang sukses dan yang gagal diimport
			$sukses = 0;
			$gagal = 0;
			$param = '';
			$param_temp="";
			$jumlah_OK=0;
			//echo($baris);
			//import data excel dari baris kedua, karena baris pertama adalah nama kolom
			$req 			= htmLawed($_POST['req_excel']);
			$reqNoBiller = $this->container_model->getNumberRequestBiller($req);
			for ($i = 8; $i <= $baris; $i++) {
				//membaca data nama depan (kolom ke-1)  (No Container)

				$no_container = $data->val($i, 1);
				$type         = $data->val($i, 2);
				$carrier      = $data->val($i, 3);
				$iso_code     = $data->val($i, 4);
				$height       = $data->val($i, 5);
				$size         = $data->val($i, 6);
				$status       = $data->val($i, 7);
				$hz           = $data->val($i, 8);
				$unnumber     = $data->val($i, 9);
				$imo		  = $data->val($i, 10);
				$tmp		  = $data->val($i, 11);
				$ow           = $data->val($i, 12);
				$oh           = $data->val($i, 13);
				$ol           = $data->val($i, 14);

				//$ukk 			= htmLawed($_GET['ukk'];

				$comm			= "";
				$book			= "";
				$ship			= "I";
				$nor 			= "";

				$param_b_var= array(
						"v_nc"=>"$no_container",
						"v_req"=>"$reqNoBiller",
						"v_stc"=>"$status",
						"v_hc"=>"$hz",
						"v_sc"=>"$size",
						"v_tc"=>"$type",
						"v_comm"=>"$comm",
						"v_imo"=>"$imo",
						"v_iso"=>"$iso_code",
						"v_book"=>"$book",
						"v_hgc"=>"$height",
						"v_ship"=>"$ship",
						"v_car"=>"$carrier",
						"v_tmp"=>"$tmp",
						"v_oh"=>"$oh",
						"v_ow"=>"$ow",
						"v_ol"=>"$ol",
						"v_un"=>"$unnumber",
						"v_nor"=>"$nor",
						"v_jnskeg"=>"",
						"v_msg"=>"");

				//var_dump($param_b_var); die;

				$msg="";

				$inv_char 	= array("&", "\"", "'", "<", ">");
				$fix_char	= array(" ", " ", " ", " ", " ");

				$request_no=$req;
				$container_no=$no_container;
				$container_size=$size;
				$container_type=$type;
				$container_status=$status;
				$container_height=$height;
				$container_weight='';
				$container_operator=$carrier;
				$container_dangerous=$hz;
				$container_imo=$imo;
				$container_un='';
				$container_temperature=$tmp;
				$container_excess_width=$ow;
				$container_excess_height=$oh;
				$container_excess_length=$ol;
                $trading_type=isset($_POST['trading_type_excel']) ? htmLawed($_POST['trading_type_excel']) : '';
                $carrier   =$carrier;
                $port   =isset($_POST['port_excel']) ? htmLawed($_POST['port_excel']) : '';
                 $commodity   ='C000000492';

				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<detail>
							<request_no>$reqNoBiller</request_no>
							<container_no>$container_no</container_no>
							<size>$container_size</size>
							<type>$container_type</type>
							<status>$container_status</status>
							<height>$container_height</height>
							<weight>$container_weight</weight>
							<operator>$container_operator</operator>
							<dangerous>$container_dangerous</dangerous>
							<imo>$container_imo</imo>
							<un>$container_un</un>
							<temperature>$container_temperature</temperature>
							<excess_width>$container_excess_width</excess_width>
							<excess_height>$container_excess_height</excess_height>
							<excess_length>$container_excess_length</excess_length>
							<trading_type>$trading_type</trading_type>
							<carrier>$carrier</carrier>
							<port>$port</port>
							<commodity>$commodity</commodity>
						</detail>
					</data>
				</root>";

				//echo $in_data; die;

				if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"requestReceivingDetail",array("in_data" => "$in_data"),$result))
				{
					echo $result;
					die;
				}
				else
				{
					//echo $result;die;
					$obj = json_decode($result);

					if($obj->data=='OK')
					{
						$jumlah_OK++;
						//$data['no_container'] = $obj->data->request_no;
					} else {
						if($no_container!=''){
							$param_temp .= $no_container.' - '.$obj->data.' <br>';
						}
					}
				}
				//$param .= $no_container.' - '.$result.' <br>';

			}
			$param='Jumlah OK '.$jumlah_OK.'<br>';
			$param.=$param_temp;
			//echo($param);
			header("Location: ".ROOT."container_receiving/edit_receiving/".$req."/".($param));
			die();

		}

	public function submit_edit_receiving(){

		$inv_char 	= array("&", "\"", "'", "<", ">");
		$fix_char		= array(" ", " ", " ", " ", " ");

		$request_no=isset($_POST['request_no']) ? htmLawed($_POST['request_no']) : '';
		$container_no=isset($_POST['container_no']) ? htmLawed($_POST['container_no']) : '';
		$container_size=isset($_POST['container_size']) ? htmLawed($_POST['container_size']) : '';
		$container_type=isset($_POST['container_type']) ? htmLawed($_POST[' container_type']) : '';
		$container_status=isset($_POST['container_status']) ? htmLawed($_POST['container_status']) : '';
		$container_height=isset($_POST['container_height']) ? htmLawed($_POST['container_height']) : '';
		$container_weight=isset($_POST['container_weight']) ? htmLawed($_POST['container_weight']) : '';
		$container_operator=isset($_POST['container_operator']) ? htmLawed($_POST['container_operator']) : '';
		$container_dangerous=isset($_POST['container_dangerous']) ? htmLawed($_POST['container_dangerous']) : '';
		$container_imo=isset($_POST['container_imo']) ? htmLawed($_POST['container_imo']) : '';
		$container_un=isset($_POST['container_un']) ? htmLawed($_POST['container_un']) : '';
		$container_temperature=isset($_POST['container_temperature']) ? htmLawed($_POST['container_temperature']) : '';
		$container_excess_width=isset($_POST['container_excess_width']) ? htmLawed($_POST['container_excess_width']) : '';
		$container_excess_height=isset($_POST['container_excess_height']) ? htmLawed($_POST['container_excess_height']) : '';
		$container_excess_length=isset($_POST['container_excess_length']) ? htmLawed($_POST['container_excess_length']) : '';
		$trading_type=isset($_POST['trading_type']) ? htmLawed($_POST['trading_type']) : '';
		$carrier   =isset($_POST['carrier']) ? htmLawed($_POST['carrier']) : '';
		$port   =isset($_POST['port']) ? htmLawed($_POST['port']) : '';
		$commodity   =isset($_POST['commodity']) ? htmLawed($_POST['commodity']) : '';

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<detail>
					<request_no>$request_no</request_no>
					<container_no>$container_no</container_no>
					<size>$container_size</size>
					<type>$container_type</type>
					<status>$container_status</status>
					<height>$container_height</height>
					<weight>$container_weight</weight>
					<operator>$container_operator</operator>
					<dangerous>$container_dangerous</dangerous>
					<imo>$container_imo</imo>
					<un>$container_un</un>
					<temperature>$container_temperature</temperature>
					<excess_width>$container_excess_width</excess_width>
					<excess_height>$container_excess_height</excess_height>
					<excess_length>$container_excess_length</excess_length>
					<trading_type>$trading_type</trading_type>
					<carrier>$carrier</carrier>
					<port>$port</port>
					<commodity>$commodity</commodity>
				</detail>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"requestReceivingDetail",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;
			exit;

			$obj = json_decode($result);

			if($obj->data->info)
			{
				/*$data['no_container'] = $obj->data->request_no;*/
			}
		}

		echo("OK");
		die();
	}

	public function cancel_receiving($request_no,$port,$terminal){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<id_req>$request_no</id_req>
				<port_code>$port</port_code>
				<terminal_code>$terminal</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER,"cancelReceiving",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			echo $result;
			exit;
			$obj = json_decode($result);
			if($obj->data->info)
			{
				/*$data['no_container'] = $obj->data->request_no;*/
			}
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Receiving Booking", 'container_receiving/main_receiving');
		$this->breadcrumbs->push("Receiving Booking", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Add Receiving Booking";

		$this->common_loader($data,'pages/container/add_receiving');
	}
}
