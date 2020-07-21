 <?php

 class GetVesselList extends CI_controller {

		function __construct() {
			parent::__construct();

			$this->load->library("Nusoap_lib");
			$this->load->helper("url");
			$this->load->library('session');
			$this->load->model("user_model");
			$this->load->helper('MY_language_helper');
			log_message('error','>>>>>>>> ini vesell phd:'.$this->session->userdata('group_phd').'-------'.$this->uri->segment(1).'----'. $this->uri->segment(2));
			/*if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {
				log_message('error','>>>>>0>>>');
			redirect(ROOT.'mainpage', 'refresh');
			}*/
			if (! $this->session->userdata('is_login') ){
				if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
				{
					redirect(ROOT.'mainpage', 'refresh');
				}		
			}
            //            require_once(APPPATH.'libraries/htmLawed.php');
		}

		function index() {
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

			//no error
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
                            array_push($stack, $temp);
						}
					}

				}
			}
             echo json_encode($stack);
		}
 }

 ?>
