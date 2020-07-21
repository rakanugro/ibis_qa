<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Uploadsby extends CI_Controller {

	public function __construct(){
                parent::__construct();
                $this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
				$this->load->library('session');
                $this->load->model('user_model');
				$this->load->model('container_model');
				$this->load->library("Nusoap_lib");
				$this->load->library("table");
				$this->load->helper('MY_language_helper');
				$this->load->helper('download');

			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
				redirect(ROOT.'mainpage', 'refresh');
	}

	public function upload_vvd(){
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

			//create table
			$this->table->set_heading('No',
								  'ID Joint Vessel',
                                  'Vessel',
                                  'Voyage In',
                                  'Voyage Out',
                                  'Call Sign',
                                  'Operator Name',
								  'Terminal',
                                  'ETA',
                                  'ETD',
                                  'ATA',
                                  'ATD',
								  'Insert Date'
                                 );

			if (isset($_FILES['attachment']['tmp_name'])){
			//class phpExcelReader
			include "excel_reader2.php";

			// membaca file excel yang diupload
			$data_excell = new Spreadsheet_Excel_Reader($_FILES['attachment']['tmp_name']);

			$baris 		 = $data_excell->rowcount($sheet_index = 0);
			//echo $baris;die;
			$vvd   = "";
			for ($i = 2; $i <= $baris; $i++) {

				$idjointves   = $data_excell->val($i,1);
				$vessel       = $data_excell->val($i,2);
				$voyin        = $data_excell->val($i,3);
				$voyout       = $data_excell->val($i,4);
				$callsign     = $data_excell->val($i,5);
				$opid         = $data_excell->val($i,6);
				$opname       = $data_excell->val($i,7);
				$eta          = $data_excell->val($i,8);
				$etb          = $data_excell->val($i,9);
				$etd          = $data_excell->val($i,10);
				$ata          = $data_excell->val($i,11);
				$atb          = $data_excell->val($i,12);
				$atd          = $data_excell->val($i,13);
				$terminal     = $data_excell->val($i,14);

				$vvd		  .="<data>
									<idjointvessel>$idjointves</idjointvessel>
									<vessel>$vessel</vessel>
									<voyin>$voyin</voyin>
									<voyout>$voyout</voyout>
									<callsign>$callsign</callsign>
									<opid>$opid</opid>
									<opname>$opname</opname>
									<eta>$eta</eta>
									<etb>$etb</etb>
									<etd>$etd</etd>
									<ata>$ata</ata>
									<atb>$atb</atb>
									<atd>$atd</atd>
									<terminal>$terminal</terminal>
								</data>";

				}

					$bar = $baris -1; // tidak termasuk header
					//echo $container; die;

					$client = new nusoap_client(UPLOADSBY);
					$error = $client->getError();
					if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}

					$customer_id=$this->session->userdata('customerid_phd');

					$modul="getVVDSby";
					$in_data="	<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<body>
							<jml_baris>$bar</jml_baris>
							$vvd
						</body>
					</root>";


					$result = $client->call($modul, array("in_data" => "$in_data"));
					//print_r($result);die;
					if($client->fault){
						echo "<h2>Fault</h2><pre>";
						print_r($result);
						echo "</pre>";
					}
					else{
						$error = $client->getError();
						if($error){
							echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
						}
						else{
							$obj = json_decode($result);
							//print_r(count($obj->data->datavvd));die;
							if($obj->data->schedule){
							  for($i=0;$i<count($obj->data->schedule);$i++)
								{
																$this->table->add_row(
																$i+1,
																$obj->data->schedule[$i]->idjointves,
																$obj->data->schedule[$i]->vessel,
																$obj->data->schedule[$i]->voyage_in,
																$obj->data->schedule[$i]->voyage_out,
																$obj->data->schedule[$i]->callsign,
																$obj->data->schedule[$i]->operator_name,
																$obj->data->schedule[$i]->terminal,
																$obj->data->schedule[$i]->eta,
																$obj->data->schedule[$i]->etd,
																$obj->data->schedule[$i]->ata,
																$obj->data->schedule[$i]->atd,
																$obj->data->schedule[$i]->insdate
															);
								}
							}
						}
					}

			}


			$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

			$this->load->view('templates/header', $data);
			$this->load->view('templates/top_bar', $data);
			$this->load->view('templates/menu_side', $data);
			$this->load->view('pages/uploadsby/upload_vvd', $data);
			$this->load->view('templates/footer', $data);
	}

	public function upload_codecocoarri(){
		if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

		//create table
		  $this->table->set_heading('No',
									'ID JOINT VESSEL',
                                  'Vessel',
                                  'Voyage In',
                                  'Voyage Out',
                                  'No Container',
                                  'EI',
                                  'IN/OUT',
                                  'ISOCODE',
                                  'TRUCK ID',
                                  'GATE IN',
                                  'GATE OUT',
								  'Insert Date'
								);

		if (isset($_FILES['attachment']['tmp_name'])){
			//class phpExcelReader
			$kategori = $this->input->post('kategori');

			//print_r($kategori);die;
			include "excel_reader2.php";

			// membaca file excel yang diupload
			$data_excell = new Spreadsheet_Excel_Reader($_FILES['attachment']['tmp_name']);

			$baris 		 = $data_excell->rowcount($sheet_index = 0);
			$coarri 	 = array();
			$codecocoarri   = "";
			for ($i = 2; $i <= $baris; $i++) {


				if ($kategori == 'codeco') {

							$idjointves   = $data_excell->val($i,1);
							$vessel       = $data_excell->val($i,2);
							$callsign     = $data_excell->val($i,3);
							$voyin        = $data_excell->val($i,4);
							$voyout       = $data_excell->val($i,5);
							$opid         = $data_excell->val($i,6);
							$eta          = $data_excell->val($i,7);
							$etd          = $data_excell->val($i,8);
							$ata          = $data_excell->val($i,9);
							$atd          = $data_excell->val($i,10);
							$nocont       = $data_excell->val($i,11);
							$inout       = $data_excell->val($i,12);
							$ei           = $data_excell->val($i,13);
							$pod          = $data_excell->val($i,14);
							$pol          = $data_excell->val($i,15);
							$status       = $data_excell->val($i,16);
							$isocode      = $data_excell->val($i,17);
							$carrier      = $data_excell->val($i,18);
							$imo          = $data_excell->val($i,19);
							$temp         = $data_excell->val($i,20);
							$weight       = $data_excell->val($i,21);
							$sealid       = $data_excell->val($i,22);
							$hz           = $data_excell->val($i,23);
							$notruck      = $data_excell->val($i,24);
							$unnumber     = $data_excell->val($i,25);
							$truckindate  = $data_excell->val($i,26);
							$truckoutdate = $data_excell->val($i,27);

							$codecocoarri .="<data>
												<idjointvessel>$idjointves</idjointvessel>
												<vessel>$vessel</vessel>
												<callsign>$callsign</callsign>
												<voyin>$voyin</voyin>
												<voyout>$voyout</voyout>
												<opid>$opid</opid>
												<eta>$eta</eta>
												<etd>$etd</etd>
												<ata>$ata</ata>
												<atd>$atd</atd>
												<nocont>$nocont</nocont>
												<inout>$inout</inout>
												<ei>$ei</ei>
												<pod>$pod</pod>
												<pol>$pol</pol>
												<status>$status</status>
												<isocode>$isocode</isocode>
												<carrier>$carrier</carrier>
												<imo>$imo</imo>
												<temp>$temp</temp>
												<weight>$weight</weight>
												<sealid>$sealid</sealid>
												<hz>$hz</hz>
												<notruck>$notruck</notruck>
												<unnumber>$unnumber</unnumber>
												<truckindate>$truckindate</truckindate>
												<truckoutdate>$truckoutdate</truckoutdate>
											</data>";
					} else {

							$idjointves   = $data_excell->val($i,1);
							$vessel       = $data_excell->val($i,2);
							$callsign     = $data_excell->val($i,3);
							$voyin        = $data_excell->val($i,4);
							$voyout       = $data_excell->val($i,5);
							$opid         = $data_excell->val($i,6);
							$eta          = $data_excell->val($i,7);
							$etd          = $data_excell->val($i,8);
							$ata          = $data_excell->val($i,9);
							$atd          = $data_excell->val($i,10);
							$nocont       = $data_excell->val($i,11);
							$inout        = $data_excell->val($i,12);
							$pod          = $data_excell->val($i,13);
							$pol          = $data_excell->val($i,14);
							$status       = $data_excell->val($i,15);
							$isocode      = $data_excell->val($i,16);
							$carrier      = $data_excell->val($i,17);
							$imo          = $data_excell->val($i,18);
							$temp         = $data_excell->val($i,19);
							$ei           = $data_excell->val($i,20);
							$weight       = $data_excell->val($i,21);
							$sealid       = $data_excell->val($i,22);
							$hz           = $data_excell->val($i,23);
							$bplocation   = $data_excell->val($i,24);
							$unnumber     = $data_excell->val($i,25);
							$disch        = $data_excell->val($i,26);
							$load         = $data_excell->val($i,27);

							$codecocoarri .="<data>
												<idjointvessel>$idjointves</idjointvessel>
												<vessel>$vessel</vessel>
												<callsign>$callsign</callsign>
												<voyin>$voyin</voyin>
												<voyout>$voyout</voyout>
												<opid>$opid</opid>
												<eta>$eta</eta>
												<etd>$etd</etd>
												<ata>$ata</ata>
												<atd>$atd</atd>
												<nocont>$nocont</nocont>
												<inout>$inout</inout>
												<pod>$pod</pod>
												<pol>$pol</pol>
												<status>$status</status>
												<isocode>$isocode</isocode>
												<carrier>$carrier</carrier>
												<imo>$imo</imo>
												<temp>$temp</temp>
												<ei>$ei</ei>
												<weight>$weight</weight>
												<sealid>$sealid</sealid>
												<hz>$hz</hz>
												<bplocation>$bplocation</bplocation>
												<unnumber>$unnumber</unnumber>
												<discharge>$disch</discharge>
												<loading>$load</loading>
											</data>";


					}
				}

					$bar = $baris -1; // tidak termasuk header
					//echo $container; die;

					$client = new nusoap_client(UPLOADSBY);
					$error = $client->getError();
					if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}

					$customer_id=$this->session->userdata('customerid_phd');

					$modul="getCodecoCoarri";
					$in_data="	<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<body>
							<jml_baris>$bar</jml_baris>
							<kategori>$kategori</kategori>
							$codecocoarri
						</body>
					</root>";

					//print_r($in_data);die;
					$result = $client->call($modul, array("in_data" => "$in_data"));
					print_r($result);die;
					if($client->fault){
						echo "<h2>Fault</h2><pre>";
						print_r($result);
						echo "</pre>";
					}
					else{
						$error = $client->getError();
						if($error){
							echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
						}
						else{
							$obj = json_decode($result);
							print_r(count($obj->data->result));die;
							if($obj->data->datacodeco){
							  for($i=0;$i<count($obj->data->datacodeco);$i++)
								{

										$this->table->add_row(
																$i+1,
																$obj->data->datacodeco[$i]->idjointves,
																$obj->data->datacodeco[$i]->vessel,
																$obj->data->datacodeco[$i]->voyage_in,
																$obj->data->datacodeco[$i]->voyage_out,
																$obj->data->datacodeco[$i]->nocontainer,
																$obj->data->datacodeco[$i]->ei,
																$obj->data->datacodeco[$i]->inout,
																$obj->data->datacodeco[$i]->isocode,
																$obj->data->datacodeco[$i]->no_truck,
																$obj->data->datacodeco[$i]->truckin,
																$obj->data->datacodeco[$i]->truckout,
																$obj->data->datacodeco[$i]->datesend
															);
								}
							}

							if($obj->data->datacoarri){
							  for($i=0;$i<count($obj->data->datacoarri);$i++)
								{
									$coarri[$i]['no']			= $i+1;
									$coarri[$i]['idjointves']	= $obj->data->datacoarri[$i]->idjointves;
									$coarri[$i]['vessel']		= $obj->data->datacoarri[$i]->vessel;
									$coarri[$i]['voyage_in']	= $obj->data->datacoarri[$i]->voyagein;
									$coarri[$i]['voyage_out']	= $obj->data->datacoarri[$i]->voyageout;
									$coarri[$i]['nocontainer']	= $obj->data->datacoarri[$i]->nocontainer;
									$coarri[$i]['ei']			= $obj->data->datacoarri[$i]->ei;
									$coarri[$i]['inout']		= $obj->data->datacoarri[$i]->inout;
									$coarri[$i]['isocode']		= $obj->data->datacoarri[$i]->isocode;
									$coarri[$i]['bplocation']	= $obj->data->datacoarri[$i]->location;
									$coarri[$i]['disc']			= $obj->data->datacoarri[$i]->disc;
									$coarri[$i]['load']			= $obj->data->datacoarri[$i]->load;
									$coarri[$i]['datesend']		= $obj->data->datacoarri[$i]->datesend;
								}
							}
						}
					}

			$data['coarri'] = $coarri;
		}



		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('pages/uploadsby/upload_codecocoarri', $data);
		$this->load->view('templates/footer', $data);
	}

	public function downloadvvd(){
		redirect('../templateupload/TemplateVVD.xls');
	}


	public function downloadcodeco(){
		redirect('../templateupload/TemplateCodeco.xls');
	}

	public function downloadcoarri(){
		redirect('../templateupload/TemplateCoarri.xls');
	}
}

?>
