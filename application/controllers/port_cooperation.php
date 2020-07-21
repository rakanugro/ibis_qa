<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Port_Cooperation extends CI_Controller {

	public function __construct(){
                parent::__construct();
                $this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->model('user_model');
				$this->load->model('container_model');
				$this->load->library("Nusoap_lib");
				$this->load->library("table");
				$this->load->helper('MY_language_helper');
				$this->load->library('session');
        require_once(APPPATH.'libraries/htmLawed.php');
        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		$this->load->model('auth_model','auth_model');
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function index(){
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
			redirect(ROOT.'port_cooperation/vessel_schedule', 'refresh');
	}

	public function vessel_schedule($startDate=null,$endDate=null){

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
        $this->table->set_heading('No',
								  'id joint vessel',
                                  'Vessel',
                                  'Voyage In',
                                  'Voyage Out',
                                  'Call Sign',
                                  'Operator Name',
                                  'ETA',
                                  'ETD',
                                  'ATA',
                                  'ATD',
                                  'Terminal'
                                 );
        $jktsby = 'JKTSBY';
        if($startDate == ''){
            $d=strtotime("-1 Months");
            $startDate = date("d-m-Y",$d);
            $endDate = date("d-m-Y");
        }
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<polpod>$jktsby</polpod>
				<startDate>$startDate</startDate>
				<endDate>$endDate</endDate>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"getVVD2",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$vesseltosby = array();
			$stack1 = array();
			//echo $result;die;
			$obj = json_decode($result);
			if($obj->data->vessel){
			  for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$this->table->add_row(
												$i+1,
												$obj->data->vessel[$i]->id_joint_vessel,
												$obj->data->vessel[$i]->vessel,
												$obj->data->vessel[$i]->voyage_in,
												$obj->data->vessel[$i]->voyage_out,
												$obj->data->vessel[$i]->call_sign,
												$obj->data->vessel[$i]->operator_name,
												$obj->data->vessel[$i]->eta,
												$obj->data->vessel[$i]->etd,
												$obj->data->vessel[$i]->ata,
												$obj->data->vessel[$i]->atd,
												$obj->data->vessel[$i]->terminal
											);
				}
			}


			/*if($obj->data->vesselsby){
				for($j=0;$j<count($obj->data->vesselsby);$j++)
				{

							$vesseltosby[$j]['no']              = $j+1;
							$vesseltosby[$j]['id_joint_vessel'] = $obj->data->vesselsby[$j]->id_joint_vessel;
							$vesseltosby[$j]['vessel']          = $obj->data->vesselsby[$j]->vessel;
							$vesseltosby[$j]['voyage_in']       = $obj->data->vesselsby[$j]->voyage_in;
							$vesseltosby[$j]['voyage_out']      = $obj->data->vesselsby[$j]->voyage_out;
							$vesseltosby[$j]['call_sign']       = $obj->data->vesselsby[$j]->call_sign;
							$vesseltosby[$j]['operator_name']   = $obj->data->vesselsby[$j]->operator_name;
							$vesseltosby[$j]['eta']             = $obj->data->vesselsby[$j]->eta;
							$vesseltosby[$j]['etd']             = $obj->data->vesselsby[$j]->etd;
							$vesseltosby[$j]['ata']             = $obj->data->vesselsby[$j]->ata;
							$vesseltosby[$j]['atd']             = $obj->data->vesselsby[$j]->atd;
							$vesseltosby[$j]['terminal']        = $obj->data->vesselsby[$j]->terminal;

				}
			}*/
		}

        $data['heading'] = 'Vessel Schedule';
        $data['subheading1'] = 'Jakarta to Surabaya';
        $data['subheading2'] = 'Surabaya to Jakarta';
       // $data['vesseltosby']=$vesseltosby;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/port_cooperation/vessel_schedule', $data);
		$this->load->view('templates/footer', $data);
	}

	public function container_status_list(){
		if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

		//create table
		$this->table->set_heading("No", "Container Number", "Status","ISO Code", "Size","Carrier","Gate In Date","Load Date","Discharge Date","Gate Out Date","Complete");

		if(isset($_GET['vessel_name'])){
			$vessel_name=htmLawed($_GET['vessel_name']);
			$id_joint_vessel=htmLawed($_GET['id_joint_vessel']);
			$voyage_in=htmLawed($_GET['voyage_in']);
			$voyage_out=htmLawed($_GET['voyage_out']);
			$pol=htmLawed($_GET['pol']);
			$terminal=htmLawed($_GET['terminal']);

			$data["id_joint_vessel"]	= $id_joint_vessel;
			$data["vesselInfo"]		= $this->user_model->get_vessel_info($id_joint_vessel);

			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<vessel_name>$vessel_name</vessel_name>
					<id_joint_vessel>$id_joint_vessel</id_joint_vessel>
					<voyage_in>$voyage_in</voyage_in>
					<voyage_out>$voyage_out</voyage_out>
					<pol>$pol</pol>
					<terminal>$terminal</terminal>
				</data>
			</root>";

			$size20fcl = 0;
			$size40fcl = 0;
			$size45fcl = 0;

			if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"getContainerStatusList",array("in_data" => "$in_data"),$result))
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

						if (($obj->data->container[$i]->size == 20) AND ($obj->data->container[$i]->status == 'FULL')){
							$size20fcl = $size20fcl+1;
						} else if (($obj->data->container[$i]->size == 40) AND ($obj->data->container[$i]->status == 'FULL')){
							$size40fcl = $size40fcl+1;
						} else if (($obj->data->container[$i]->size == 45) AND ($obj->data->container[$i]->status == 'FULL')){
							$size45fcl = $size45fcl+1;
						}

						$complete="";
						if($obj->data->container[$i]->gate_out_date!=""){
							$complete="Complete";
						}
						$this->table->add_row(
							$i+1,
							$obj->data->container[$i]->no_container,
							$obj->data->container[$i]->status,
							$obj->data->container[$i]->iso_code,
							$obj->data->container[$i]->size,
							$obj->data->container[$i]->carrier,
							$obj->data->container[$i]->gate_in_date,
							$obj->data->container[$i]->load_date,
							$obj->data->container[$i]->discharge_date,
							$obj->data->container[$i]->gate_out_date,
							$complete
						);
					}
				}
			}

			$data["size20fcl"]	= $size20fcl;
			$data["size40fcl"]	= $size40fcl;
			$data["size45fcl"]	= $size45fcl;
		}



		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/port_cooperation/container_status_list', $data);
		$this->load->view('templates/footer', $data);
	}

	public function container_status_check(){
		if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

		//create table
		$this->table->set_heading("No",
								  "Container Number",
								  'Terminal',
								  "Vessel",
								  'EI', 'Status','POD/POL',
								  "Gate In Date",
								  "Load Date",
								  "Discharge Date",
								  "Gate Out Date",
								  "Complete");

		if (isset($_FILES['attachment']['tmp_name'])){
			//class phpExcelReader
		include "excel_reader2.php";

		// membaca file excel yang diupload
		$data_excell = new Spreadsheet_Excel_Reader($_FILES['attachment']['tmp_name']);

		$baris 		 = $data_excell->rowcount($sheet_index = 0);
		//echo $baris;die;
		$container   = "";
		for ($i = 2; $i <= $baris; $i++) {
			$nocont       = $data_excell->val($i,1);
			if ($i < $baris){
				$container   .= $nocont .',';
			} else if ($i = $baris){
				$container   .= $nocont;
			}
		}

				$bar = $baris -1; // tidak termasuk header
				//echo $container; die;

				$customer_id=$this->session->userdata('customerid_phd');

				$in_data="	<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<customer_id>$customer_id</customer_id>
						<jml_baris>$bar</jml_baris>
						<container>$container</container>
					</data>
				</root>";

				if(!$this->nusoap_lib->call_wsdl(STATUS_CONT,"getStatusContainer",array("in_data" => "$in_data"),$result))
				{
					echo $result;
					die;
				}
				else
				{
					//echo $result;die;
					$obj = json_decode($result);

					if($obj->data->status)
					{
						//print_r($obj->data->status);
						for($i=0;$i<count($obj->data->status);$i++)
						{
							if ($obj->data->status[$i]->ei == 'E'){
								$gati = $obj->data->status[$i]->gate_date;
								$gato = '';
							} else {
								$gato = $obj->data->status[$i]->gate_date;
								$gati = '';
							}

							if ($obj->data->status[$i]->ei == 'E'){
								$load = $obj->data->status[$i]->confirm_date;
								$disc = '';
							} else {
								$disc = $obj->data->status[$i]->confirm_date;
								$load = '';
							}

							if (($gati <> NULL) AND ($gato <> NULL) AND ($load <> NULL) AND ($disc <> NULL)){
								$complete = 'C';
							} else {
								$complete = 'U';
							}

							if (($obj->data->status[$i]->terminal_id == NULL) || ($obj->data->status[$i]->terminal_id == '')) {
								$terminal = '<i>not found</i>';
								$vessel   = '<i>not found</i>';
								$ei       = '<i>not found</i>';
								$size     = '<i>not found</i>';
								$podpol   = '<i>not found</i>';
							} else {
								$terminal = $obj->data->status[$i]->terminal_id;
								$vessel   = $obj->data->status[$i]->vessel;
								$ei       = $obj->data->status[$i]->ei;
								$size     = $obj->data->status[$i]->size;
								$podpol   = $obj->data->status[$i]->podpol;
							}

							$this->table->add_row(
								$i+1,
								$obj->data->status[$i]->no_cont,
								$terminal,
								$vessel,
								$ei,
								$size,
								$podpol,
								$gati,
								$load,
								$disc,
								$gato,
								$complete
							);
						}
					}
				}

		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/port_cooperation/container_statusbyupload', $data);
		$this->load->view('templates/footer', $data);
	}


	public function autocomplete_vessel(){
		$term			= strtoupper($_GET["term"]);

        $rauto = $this->container_model->autocompleteVesselVoy($term);

		echo json_encode($rauto);
        die();
	}

	public function downloadtemplatecontainer(){
		redirect('../templateupload/TemplateContainerStatus.xls');
	}

    public function dashboard_monitoring($startDate=null,$endDate=null){

        //no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
        $this->table->set_heading("No",
                                  "Vessel",
                                  "Voyage (In-Out)",
                                  "Call Sign",
                                  "Operator Name",
                                  "ETA",
                                  "ETD",
                                  "ATA",
                                  "ATD",
                                  "Terminal",
                                  "Qty 20F",
                                  "Qty 40F",
                                  "Qty 45F"
                                 );
        $jktsby = 'JKTSBY';
        if($startDate == ''){
            $date=date_create("10-03-2015");
            $startDate = date_format($date,"d-m-Y");
            $endDate = date("d-m-Y");
        }
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<polpod>$jktsby</polpod>
				<startDate>$startDate</startDate>
				<endDate>$endDate</endDate>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"getDashboardMonitoring2",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//echo $result;die;
			$obj = json_decode($result);

			$vesselmrt = array();
			$vesseltnt = array();
			$vesselctp = array();
			$vesseltms = array();

			$stack1 = array();

			if($obj->data->vesselspil){
			  for($i=0;$i<count($obj->data->vesselspil);$i++)
				{
					$this->table->add_row(
												$i+1,
												$obj->data->vesselspil[$i]->vessel,
												$obj->data->vesselspil[$i]->voyage,
												$obj->data->vesselspil[$i]->call_sign,
												$obj->data->vesselspil[$i]->operator_name,
												$obj->data->vesselspil[$i]->eta,
												$obj->data->vesselspil[$i]->etd,
												$obj->data->vesselspil[$i]->ata,
												$obj->data->vesselspil[$i]->atd,
												$obj->data->vesselspil[$i]->terminal,
												$obj->data->vesselspil[$i]->qty_20,
												$obj->data->vesselspil[$i]->qty_40,
												$obj->data->vesselspil[$i]->qty_45
											);
				}
			}

			// TEMAS

			if($obj->data->vesseltms){
					 for($j=0;$j<count($obj->data->vesseltms);$j++)
						{

									$vesseltms[$j]['no']              = $j+1;
									$vesseltms[$j]['vessel']          = $obj->data->vesseltms[$j]->vessel;
									$vesseltms[$j]['voyage']          = $obj->data->vesseltms[$j]->voyage;
									$vesseltms[$j]['call_sign']       = $obj->data->vesseltms[$j]->call_sign;
									$vesseltms[$j]['operator_name']   = $obj->data->vesseltms[$j]->operator_name;
									$vesseltms[$j]['eta']             = $obj->data->vesseltms[$j]->eta;
									$vesseltms[$j]['etd']             = $obj->data->vesseltms[$j]->etd;
									$vesseltms[$j]['ata']             = $obj->data->vesseltms[$j]->ata;
									$vesseltms[$j]['atd']             = $obj->data->vesseltms[$j]->atd;
									$vesseltms[$j]['terminal']        = $obj->data->vesseltms[$j]->terminal;
									$vesseltms[$j]['qty_20']          = $obj->data->vesseltms[$j]->qty_20;
									$vesseltms[$j]['qty_40']          = $obj->data->vesseltms[$j]->qty_40;
									$vesseltms[$j]['qty_45']          = $obj->data->vesseltms[$j]->qty_45;

						}
			}

			if($obj->data->vesseltnt){

				for($j=0;$j<count($obj->data->vesseltnt);$j++)
						{

									$vesseltnt[$j]['no']              = $j+1;
									$vesseltnt[$j]['vessel']          = $obj->data->vesseltnt[$j]->vessel;
									$vesseltnt[$j]['voyage']          = $obj->data->vesseltnt[$j]->voyage;
									$vesseltnt[$j]['call_sign']       = $obj->data->vesseltnt[$j]->call_sign;
									$vesseltnt[$j]['operator_name']   = $obj->data->vesseltnt[$j]->operator_name;
									$vesseltnt[$j]['eta']             = $obj->data->vesseltnt[$j]->eta;
									$vesseltnt[$j]['etd']             = $obj->data->vesseltnt[$j]->etd;
									$vesseltnt[$j]['ata']             = $obj->data->vesseltnt[$j]->ata;
									$vesseltnt[$j]['atd']             = $obj->data->vesseltnt[$j]->atd;
									$vesseltnt[$j]['terminal']        = $obj->data->vesseltnt[$j]->terminal;
									$vesseltnt[$j]['qty_20']          = $obj->data->vesseltnt[$j]->qty_20;
									$vesseltnt[$j]['qty_40']          = $obj->data->vesseltnt[$j]->qty_40;
									$vesseltnt[$j]['qty_45']          = $obj->data->vesseltnt[$j]->qty_45;

						}
			}

			if($obj->data->vesselmrt){

				for($j=0;$j<count($obj->data->vesselmrt);$j++)
						{

									$vesselmrt[$j]['no']              = $j+1;
									$vesselmrt[$j]['vessel']          = $obj->data->vesselmrt[$j]->vessel;
									$vesselmrt[$j]['voyage']          = $obj->data->vesselmrt[$j]->voyage;
									$vesselmrt[$j]['call_sign']       = $obj->data->vesselmrt[$j]->call_sign;
									$vesselmrt[$j]['operator_name']   = $obj->data->vesselmrt[$j]->operator_name;
									$vesselmrt[$j]['eta']             = $obj->data->vesselmrt[$j]->eta;
									$vesselmrt[$j]['etd']             = $obj->data->vesselmrt[$j]->etd;
									$vesselmrt[$j]['ata']             = $obj->data->vesselmrt[$j]->ata;
									$vesselmrt[$j]['atd']             = $obj->data->vesselmrt[$j]->atd;
									$vesselmrt[$j]['terminal']        = $obj->data->vesselmrt[$j]->terminal;
									$vesselmrt[$j]['qty_20']          = $obj->data->vesselmrt[$j]->qty_20;
									$vesselmrt[$j]['qty_40']          = $obj->data->vesselmrt[$j]->qty_40;
									$vesselmrt[$j]['qty_45']          = $obj->data->vesselmrt[$j]->qty_45;

						}
			}

			if($obj->data->vesselctp){

			   for($j=0;$j<count($obj->data->vesselctp);$j++)
						{

									$vesselctp[$j]['no']              = $j+1;
									$vesselctp[$j]['vessel']          = $obj->data->vesselctp[$j]->vessel;
									$vesselctp[$j]['voyage']          = $obj->data->vesselctp[$j]->voyage;
									$vesselctp[$j]['call_sign']       = $obj->data->vesselctp[$j]->call_sign;
									$vesselctp[$j]['operator_name']   = $obj->data->vesselctp[$j]->operator_name;
									$vesselctp[$j]['eta']             = $obj->data->vesselctp[$j]->eta;
									$vesselctp[$j]['etd']             = $obj->data->vesselctp[$j]->etd;
									$vesselctp[$j]['ata']             = $obj->data->vesselctp[$j]->ata;
									$vesselctp[$j]['atd']             = $obj->data->vesselctp[$j]->atd;
									$vesselctp[$j]['terminal']        = $obj->data->vesselctp[$j]->terminal;
									$vesselctp[$j]['qty_20']          = $obj->data->vesselctp[$j]->qty_20;
									$vesselctp[$j]['qty_40']          = $obj->data->vesselctp[$j]->qty_40;
									$vesselctp[$j]['qty_45']          = $obj->data->vesselctp[$j]->qty_45;

						}
			}

			$data['vesseltms'] 	= $vesseltms;
			$data['vesseltnt'] 	= $vesseltnt;
			$data['vesselmrt'] 	= $vesselmrt;
			$data['vesselctp'] 	= $vesselctp;
			$data['ctp20']     	= $obj->data->ctp20;
			$data['ctp40']		= $obj->data->ctp40;
			$data['ctp45']		= $obj->data->ctp45;
			$data['spil20']		= $obj->data->spil20;
			$data['spil40']		= $obj->data->spil40;
			$data['spil45']		= $obj->data->spil45;
			$data['tms20']		= $obj->data->tms20;
			$data['tms40']		= $obj->data->tms40;
			$data['tms45']		= $obj->data->tms45;
			$data['tnt20']		= $obj->data->tnt20;
			$data['tnt40']		= $obj->data->tnt40;
			$data['tnt45']		= $obj->data->tnt45;
			$data['mrt20']		= $obj->data->mrt20;
			$data['mrt40']		= $obj->data->mrt40;
			$data['mrt45']		= $obj->data->mrt45;
		}

        $data['heading'] ='Dashboard Monitoring';
        $data['subheading1'] = "Jakarta to Surabaya";
        $data['subheading2'] = "Surabaya to Jakarta";

        $data['startDate']   = $startDate;
        $data['endDate']	 = $endDate;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/port_cooperation/dashboard_monitoring', $data);
		$this->load->view('templates/footer', $data);
	}

    public function request_restitusi(){
        if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}


        $idgroup = $this->session->userdata('group_phd');

        if($idgroup == '4'){
            $this->table->set_heading("No",
                                      "ID Joint Vessel",
                                      "Vessel",
                                      "Voyage",
                                      "Container Valid",
                                      "Request"
                                      //get_content($this->user_model,"port_cooperation","view")
                                     );

            //$array_req = $this->container_model->get_vesselrestitution_req();

            $customer_id=$this->session->userdata('custid_phd');

            $in_data="	<root>
                <sc_type>1</sc_type>
                <sc_code>123456</sc_code>
                <data>
                    <cust_id>$customer_id</cust_id>
                </data>
            </root>";

			if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"get_vesselrestitution_req",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				$obj = json_decode($result);
				$restitusi_link="";
				$view_link="";
				for($i=0;$i<count($obj->data->vessel);$i++){
					if($obj->data->vessel[$i]->cont_valid !=0){
						$restitusi_link='<a  class=\'btn btn-primary\'  href="#" onclick="requestRestitution(\''.$obj->data->vessel[$i]->id_joint_vessel.'\',\''.trim($obj->data->vessel[$i]->vessel).'\',\''.$obj->data->vessel[$i]->voyage_in.'\',\''.$obj->data->vessel[$i]->voyage_out.'\',\''.$obj->data->vessel[$i]->terminal.'\',\''.$obj->data->vessel[$i]->call_sign.'\')"><i class=\'fa fa-envelope\'></i></a>';
					}
					else {
						$restitusi_link = '';
					}
					$view_link='<a  class=\'btn btn-primary\'  href="#" onclick="viewRestitution(\''.$obj->data->vessel[$i]->id_joint_vessel.'\')"><i class=\'fa fa-eye\'></i></a>';

					$this->table->add_row(
						$i+1,
						$obj->data->vessel[$i]->id_joint_vessel,
						$obj->data->vessel[$i]->vessel,
						$obj->data->vessel[$i]->voyage_in." / ".$obj->data->vessel[$i]->voyage_out,
						$obj->data->vessel[$i]->cont_valid,
						$restitusi_link
						//$view_link
					);
				}
			}
        }
        if($idgroup != '4'){
            $customer_id = 'ipc';
        }
		$array_req = $this->container_model->get_listrestitution_req($customer_id);
        $restitution_list=array();
        if(!empty($array_req))
        for($i=0;$i<count($array_req);$i++){

            $view_link='<a  class=\'btn btn-primary\'  href="'.ROOT."port_cooperation/view_restitusi/".$array_req[$i]['ID_REQ'].'"><i class=\'fa fa-eye\'></i></a>';
			$cancel_link="";

            $confirm_link ='<a  class=\'btn btn-primary\' target="_blank"  href="'.ROOT."port_cooperation/calculate_restitution/".$array_req[$i]['ID_REQ'].'/'.$array_req[$i]['ID_PORT'].'"><i class=\'fa  fa-print\'></i></a>';
            if($array_req[$i]['STATUS_REQ'] == 'S'){
                $label_span = '<span class="label label-info">Posted</span>';
				$cancel_link='<a  class=\'btn btn-primary\'  href="#" onclick="cancelRestitution(\''.$array_req[$i]['ID_REQ'].'\')"><i class=\'fa fa-trash-o\'></i></a>';
                $approve_link = '<a  title="Approve Dokumen" class=\'btn btn-primary\'  href="#" onclick="approveRestitution(\''.$array_req[$i]['ID_REQ'].'\')"><i class=\'fa fa-check-square\'></i></a>';
                $complete_link = "";
                $uncomplete_link = '<a  title="Uncomplete Document" class=\'btn btn-primary\'  href="#" onclick="uncompletedocRestitution(\''.$array_req[$i]['ID_REQ'].'\')"><i class=\'fa  fa-minus-square\'></i></a>';
            }
            else if($array_req[$i]['STATUS_REQ'] == 'D'){
                $label_span='<span class="label label-warning">Approved Doc.</span>';
                $approve_link = $array_req[$i]['DATE_DOC_OK'];
                $complete_link = '<a  title = "Complete Dokumen" class=\'btn btn-primary\'  href="#" onclick="completeRestitution(\''.$array_req[$i]['ID_REQ'].'\')"><i class=\'fa fa-check-square\'></i></a>';
                $uncomplete_link = '<a  title="Uncomplete Document" class=\'btn btn-primary\'  href="#" onclick="uncompletedocRestitution(\''.$array_req[$i]['ID_REQ'].'\')"><i class=\'fa  fa-minus-square\'></i></a>';

            }
            else if($array_req[$i]['STATUS_REQ'] == 'R'){
                $label_span='<span class="label label-success">Complete Req.</span> <br/> ('.$array_req[$i]['NO_JKK'].')';
                $approve_link = $array_req[$i]['DATE_DOC_OK'];
                $complete_link = $array_req[$i]['DATE_REQ_OK'];
                $uncomplete_link = $array_req[$i]['DATE_DOC_NO'];
            }
            else if($array_req[$i]['STATUS_REQ'] == 'T'){
                $label_span='<div class="blink_me"><span class="label label-danger">Unapproved Doc.</span></div>';
                $approve_link = '<a  title="Approve Dokumen" class=\'btn btn-primary\'  href="#" onclick="approveRestitution(\''.$array_req[$i]['ID_REQ'].'\')"><i class=\'fa fa-check-square\'></i></a>';
                $complete_link = $array_req[$i]['DATE_REQ_OK'];
                $uncomplete_link = $array_req[$i]['DATE_DOC_NO'];

            }
            else {
                $label_span='<span class="label label-danger">Cancel</span>';
                $approve_link = $array_req[$i]['DATE_DOC_OK'];
                $complete_link = $array_req[$i]['DATE_REQ_OK'];
                $uncomplete_link = '';
            }

            $sumreq = $this->container_model->sum_restitution($array_req[$i]['ID_REQ']);

		    if($idgroup == 3){
					$restitution_list[$i]['no']=$i+1;
                    $restitution_list[$i]['no_request']=$array_req[$i]['ID_REQ'];
                    $restitution_list[$i]['vessel']=$array_req[$i]['VESSEL'];
                    $restitution_list[$i]['voyage']=$array_req[$i]['VOYAGE_IN'].'-'.$array_req[$i]['VOYAGE_OUT'];
                    $restitution_list[$i]['port']=$array_req[$i]['ID_PORT'].'-'.$array_req[$i]['ID_TERMINAL'];
                    //$restitution_list[$i]['terminal']=$array_req[$i]['ID_TERMINAL'];
                    $restitution_list[$i]['req_date']=$array_req[$i]['DATE_REQUEST'];
                    $restitution_list[$i]['amount']=number_format($sumreq['AMOUNT']);
                    $restitution_list[$i]['doc_uncom']=$uncomplete_link;
                    $restitution_list[$i]['date_doc']=$approve_link;
                    $restitution_list[$i]['date_req']=$complete_link;
                    $restitution_list[$i]['status']=$label_span;
                    $restitution_list[$i]['view']=$view_link;
                    $restitution_list[$i]['qty']=$array_req[$i]['QTY'];
                    $restitution_list[$i]['calc']=$confirm_link;
            }
            else {
                    $restitution_list[$i]['no']=$i+1;
                    $restitution_list[$i]['no_request']=$array_req[$i]['ID_REQ'];
                    $restitution_list[$i]['vessel']=$array_req[$i]['VESSEL'];
                    $restitution_list[$i]['voyage']=$array_req[$i]['VOYAGE_IN'].'-'.$array_req[$i]['VOYAGE_OUT'];
                    $restitution_list[$i]['port']=$array_req[$i]['ID_PORT'].'-'.$array_req[$i]['ID_TERMINAL'];
                    //$restitution_list[$i]['terminal']=$array_req[$i]['ID_TERMINAL'];
                    $restitution_list[$i]['req_date']=$array_req[$i]['DATE_REQUEST'];
                    $restitution_list[$i]['amount']=number_format($sumreq['AMOUNT']);
                    $restitution_list[$i]['date_doc']=$array_req[$i]['DATE_DOC_OK'];
                    $restitution_list[$i]['date_req']=$array_req[$i]['DATE_REQ_OK'];
                    $restitution_list[$i]['status']=$label_span;
                    $restitution_list[$i]['view']=$view_link;
                    $restitution_list[$i]['qty']=$array_req[$i]['QTY'];
                    $restitution_list[$i]['calc']=$confirm_link;
					$restitution_list[$i]['cancel']=$cancel_link;
            }
        }

        $data['idgroup']=$idgroup;
		$data['restitution_list']=$restitution_list;

        $this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/port_cooperation/request_restitusi', $data);
		$this->load->view('templates/footer', $data);
    }

    public function add_req_restitution(){

            if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

            $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

	        $this->load->view('templates/header', $data);
			$this->load->view('templates/top_bar', $data);
			$this->load->view('templates/menu_side', $data);
			$this->load->view('pages/port_cooperation/add_restitution', $data);
			$this->load->view('templates/footer', $data);
    }

    public function autoVesselList(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

		$term     = strtoupper($_GET["term"]);
		$stack    = array();

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"autoVVDRestitusi",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);

			if($obj->data->vessel)
			{
				for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$temp;
					$temp['VESSEL']=trim($obj->data->vessel[$i]->vessel_name);
					$temp['VOYAGE_IN']=trim($obj->data->vessel[$i]->voyage_in);
					$temp['VOYAGE_OUT']=trim($obj->data->vessel[$i]->voyage_out);
					$temp['POL']=$obj->data->vessel[$i]->pol;
					$temp['ID_JOINT_VESSEL']=$obj->data->vessel[$i]->id_joint_vessel;
					$temp['TERMINAL']=$obj->data->vessel[$i]->terminal;
					$temp['CALL_SIGN']=$obj->data->vessel[$i]->call_sign;
					array_push($stack, $temp);
				}
			}
		}

		echo json_encode($stack);

    }

    public function create_header_restitusi(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }
        $vessel          = htmLawed($_POST['VESSEL']);
        $voyage_in       = htmLawed($_POST['VOYAGE_IN']);
        $voyage_out      = htmLawed($_POST['VOYAGE_OUT']);
        $terminal        = htmLawed($_POST['TERMINAL']);
        $call_sign       = htmLawed($_POST['CALL_SIGN']);
        $request_no      = htmLawed($_POST['REQUEST_NO']);

        $customer_id=$this->session->userdata('customerid_phd');
        $customer_name =$this->session->userdata('customername_phd');

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
                <header>
				<vessel_name>$vessel</vessel_name>
				<voyage_in>$voyage_in</voyage_in>
				<voyage_out>$voyage_out</voyage_out>
				<terminal>$terminal</terminal>
				<customer>$customer_id</customer>
				<customer_name>$customer_name</customer_name>
				<call_sign>$call_sign</call_sign>
				<no_request>$request_no</no_request>
                </header>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"saveHeaderRestitusi",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
            $obj =  json_decode($result);
            print_r($obj->data->data->request_no);
            exit;
		}

    }

    public function get_list_restcontainer(){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $vessel          = htmLawed($_POST['VESSEL']);
        $voyage_in       = htmLawed($_POST['VOYAGE_IN']);
        $voyage_out      = htmLawed($_POST['VOYAGE_OUT']);
        $terminal        = htmLawed($_POST['TERMINAL']);
        $call_sign       = htmLawed($_POST['CALL_SIGN']);
        $id_joint_vessel = htmLawed($_POST['ID_JOINT']);
        $pol             = htmLawed($_POST['ID_POL']);
        $id_req          = htmLawed($_POST['REQUEST_NO']);

        $stack = array();

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$vessel</vessel_name>
				<voyage_in>$voyage_in</voyage_in>
				<voyage_out>$voyage_out</voyage_out>
				<terminal>$terminal</terminal>
				<call_sign>$call_sign</call_sign>
				<id_joint_vessel>$id_joint_vessel</id_joint_vessel>
				<pol>$pol</pol>
				<id_req>$id_req</id_req>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"getListRestitutionCont",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
            $obj = json_decode($result);
            if($obj->data->container)
            {
                for($i=0;$i<count($obj->data->container);$i++)
					{
						$temp;
						$temp['NO_CONTAINER']=$obj->data->container[$i]->no_container;
						$temp['SIZE_']=$obj->data->container[$i]->size;
						$temp['STATUS']=$obj->data->container[$i]->status;
						$temp['ISO_CODE']=$obj->data->container[$i]->iso_code;
						$temp['IMO']=$obj->data->container[$i]->imo;
						$temp['CARRIER']=$obj->data->container[$i]->carrier;
						$temp['GATE_IN_DATE']=$obj->data->container[$i]->gate_in_date;
						$temp['LOAD_DATE']=$obj->data->container[$i]->load_date;
						$temp['DISCHARGE_DATE']=$obj->data->container[$i]->discharge_date;
						$temp['GATE_OUT_DATE']=$obj->data->container[$i]->gate_out_date;
						$temp['NILAI']=$obj->data->container[$i]->nilai;
						array_push($stack, $temp);
					}
            }
		}

        $data['detail'] = $stack;
        $this->load->view('pages/port_cooperation/get_list_restcontainer', $data);


    }

    public function save_detail_req_restitusi(){
        $alldetail = htmLawed($_POST["alldetail"]);

        $container = "";
        $jum =count($alldetail);

        for($i=0; $i < count($alldetail); $i++){
            $container .= "'".$alldetail[$i]."'";
            if($jum!=1 && $i != $jum-1){
                $container .=",";
            }
        }

        $container = base64_encode($container);
        $ID_REQ = htmLawed($_POST["ID_REQ"]);

        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <alldetail>$container</alldetail>
                <id_request>$ID_REQ</id_request>
            </data>
        </root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"saveDetailReqRestitusi",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
            $error = $client->getError();
			if ($error) {
				echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
			}
            else{
                $obj = json_decode($result);

				if($obj->data->info)
				{
				    print_r($obj->data->info);
                    exit;

				} else {
					echo "NO,GAGAL";
				}
            }
		}

    }

    public function view_restitusi($id_req = null){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }


        $data['rowhead'] = $this->container_model->get_restitution_req($id_req);
        $data['rowdetail'] = $this->container_model->get_restitution_cont($id_req);

        $this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/port_cooperation/view_restitusi', $data);
		$this->load->view('templates/footer', $data);

    }

    public function confirm_restitusi($id_req = null){
        $this->container_model->save_confirm_restitusi($id_req);

        redirect('port_cooperation/request_restitusi');
    }


	public function request_restitution(){
		if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

		$id_joint_vessel = htmLawed($_POST['ID_JOINT_VESSEL']);
		$vessel          = htmLawed($_POST['VESSEL']);
        $voyage_in       = htmLawed($_POST['VOYAGE_IN']);
        $voyage_out      = htmLawed($_POST['VOYAGE_OUT']);
        $terminal        = htmLawed($_POST['TERMINAL']);
        $call_sign       = htmLawed($_POST['CALL_SIGN']);
        $customer_id=$this->session->userdata('custid_phd');
        $customer_name =$this->session->userdata('customername_phd');

		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
                <header>
					<id_joint_vessel>$id_joint_vessel</id_joint_vessel>
					<vessel>$vessel</vessel>
					<voyage_in>$voyage_in</voyage_in>
					<voyage_out>$voyage_out</voyage_out>
					<terminal>$terminal</terminal>
					<customer>$customer_id</customer>
					<customer_name>$customer_name</customer_name>
					<call_sign>$call_sign</call_sign>
				</header>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(PORT_COOPERATION,"saveRestitusi",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj =  json_decode($result);
			print_r($obj->data->data->request_no);
			exit;
		}
    }

	public function cancel_restitution(){
		$id_req=htmLawed($_POST['ID_REQ']);

        $this->container_model->cancel_restitution($id_req);
        echo 'OK,SUCCESS';
        exit;
	}

    public function approve_restitution(){
        $id_req = htmLawed($_POST['ID_REQ']);
        $this->container_model->complete_document($id_req);
        echo 'OK,SUCCESS';
        exit;
    }

    public function complete_restitution(){
        $id_req = htmLawed($_POST['ID_REQ']);
        $no_jkk = htmLawed($_POST['NO_JKK']);
        $remark = htmLawed($_POST['REMARK']);
        $this->container_model->complete_request($id_req, $no_jkk, $remark);
        echo 'OK,SUCCESS';
        exit;
    }

    public function uncomplete_document(){
        $id_req = htmLawed($_POST['ID_REQ']);
        $this->container_model->uncomplete_document($id_req);
        echo 'OK,SUCCESS';
        exit;
    }

    public function calculate_restitution($id_req=null,$id_port=null){
        if (!$this->session->userdata('uname_phd'))
        {
            redirect(ROOT.'main', 'refresh');
        }

        $array_calc = $this->container_model->calculate_restitution($id_req);

        $det_req = $this->container_model->get_restitution_req_cust($id_req);

        $this->load->helper('pdf_helper');

        tcpdf();

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


        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //$image_file = K_PATH_IMAGES.'ipc_logo.jpg';
		//$this->SetXY(200, 0);
		 //$this->Image($image_file, 20, 20, 30, 'C', 'JPG', 'C', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font

		$pdf->SetFont('Times', 'B', 14);
		$pdf->SetXY(0, 0);
		$pdf->Cell(0, 15, 'PT PELABUHAN TANJUNG PRIOK', 0, false, 'C', 0, '', 0, false, 'T', 'M');

		$pdf->SetFont('Times', 'B', 15);
		$pdf->SetXY(0, 15);
		$pdf->Cell(0, 15, 'PERHITUNGAN RESTITUSI CONTAINER JAKARTA<->SURABAYA', 0, false, 'C', 0, '', 0, false, 'T', 'M');

		$pdf->setPrintHeader(true);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $customer_name =$det_req['NAME'];
        $customer_addr = $det_req['ADDRESS'];
        $customer_npwp = $det_req['NPWP'];

// ---------------------------------------------------------
        $tbl1 = '';
        $amountall = 0;
        $now = date('d-M-Y');
        foreach($array_calc as $ac){
            $size = $ac['SIZE_'];
            $alat = $ac['CRANE'];
            $tarif = $ac['TARIF'];
            $amount = number_format($ac['AMOUNT']);
            $amount1 = $ac['AMOUNT'];
            $qty = $ac['QTY'];
            $amountall = $amountall+$amount1;
            $tbl1 .= <<<EOD
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> $size</td>
                    <td> $alat</td>
                    <td> $tarif</td>
                    <td> $qty</td>
                    <td align="right"> $amount</td>
                </tr>
EOD;
        }

            $ppn = 0.1*$amountall;
            $tot_ppn = $amountall+$ppn;
            $pph = 0.02*$amountall;
            $tot_pph = $tot_ppn-$pph;
            $amountall_ = number_format($amountall);
            $ppn_ = number_format($ppn);
            $tot_ppn_ = number_format($tot_ppn);
            $pph_ = number_format($pph);
            $tot_pph_ = number_format($tot_pph);


             $tbl= <<<EOD
        <table cellpadding="1.5" cellspacing="1" border="0" style="border-width: 1px; border-color:#000000;
        border-style: solid;border-left-width: 1px; border-left-color:#000000; border-left-style: solid;
        border-right-width: 1px; border-right-color:#000000; border-right-style: solid">
            <tr>
                <td colspan="5" align="center" style="border-bottom-width: 1px; border-bottom-color:#000000; border-bottom-style: solid"><h3>RINCIAN PERHITUNGAN RESTITUSI CONTAINER JAKARTA-SURABAYA</h3><br/></td>
            </tr>
            <tr>
                <td ></td>
                <td width="10px"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td >No. Request</td>
                <td width="10px">:</td>
                <td colspan="2">$id_req</td>
            </tr>
            <tr>
                <td>Perusahaan</td>
                <td>:</td>
                <td colspan="2">$det_req[NAME]</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="2">$customer_addr</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>:</td>
                <td colspan="2">$customer_npwp</td>
            </tr>
            <tr>
                <td>Nama Kapal</td>
                <td>:</td>
                <td colspan="2">$det_req[VESSEL]</td>
            </tr>
            <tr>
                <td>Voyage In/Out</td>
                <td>:</td>
                <td colspan="2">$det_req[VOYAGE_IN]-$det_req[VOYAGE_OUT]</td>
            </tr>
            <tr>
                <td>Terminal</td>
                <td>:</td>
                <td colspan="2">$id_port</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="2"></td>
            </tr>

        </table>

        <table border="0" style="border-width: 1px; border-color:#000000; border-style: solid;border-left: 1px #000000 solid;
        border-right: 1px #000000 solid;">
        <tr>
            <td colspan="7"></td>
        </tr><tr>
            <td colspan="7" style="border-bottom: 1px #000000 solid;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>SIZE</td>
            <td> ALAT</td>
            <td> TARIF</td>
            <td> QTY</td>
            <td align="right"> AMOUNT</td>
        </tr>
        <tr>
            <td  ></td>
            <td  ></td>
            <td colspan="5" style="border-top: 1px #000000 solid;"></td>
        </tr>
        $tbl1
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td  ></td>
            <td  ></td>
            <td align="right" colspan="3" style="border-top: 1px #000000 solid;">JUMLAH BIAYA</td>
            <td align="right" style="border-top: 1px #000000 solid;">Rp.</td>
            <td align="right" style="border-top: 1px #000000 solid;"> $amountall_</td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td  ></td>
            <td  ></td>
            <td align="right" colspan="3" >PPN 10%</td>
            <td align="right" >Rp.</td>
            <td align="right" > $ppn_</td>
        </tr>
        <tr>
            <td  ></td>
            <td  ></td>
            <td align="right" colspan="3" >JUMLAH BIAYA</td>
            <td align="right" >Rp.</td>
            <td align="right" style="border-top: 1px #000000 solid;"> $tot_ppn_</td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td  ></td>
            <td  ></td>
            <td align="right" colspan="3" >PPH 2%</td>
            <td align="right" >Rp.</td>
            <td align="right"> $pph_</td>
        </tr>
        <tr>
            <td  ></td>
            <td  ></td>
            <td align="right" colspan="3" >BIAYA DIBAYARKAN</td>
            <td align="right" >Rp.</td>
            <td align="right" style="border-top: 1px #000000 solid;"> $tot_pph_</td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="7" ></td>
        </tr>
        <tr>
            <td colspan="7" style="border-bottom: 1px #000000 solid;"></td>
        </tr>
   </table>
   Tanggal Cetak: $now
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

        $pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
        $pdf->SetFont('helvetica', 'B', 9);
        //Close and output PDF document
        $pdf->Output('sample2.pdf', 'I');

    }
}
