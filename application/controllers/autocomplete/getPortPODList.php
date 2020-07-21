 <?php
 
 class GetPortPODList extends CI_controller {
 
		function __construct() {
			parent::__construct();

			$this->load->library("Nusoap_lib");
			$this->load->helper("url");
			$this->load->model("user_model");
			$this->load->library('session');
			//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			//redirect(ROOT.'mainpage', 'refresh');

                        require_once(APPPATH.'libraries/htmLawed.php');

		}
		
		function index() {
			
			$client = new nusoap_client(TRACKING_CONTAINER);

			$error = $client->getError();
			if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}
			
			$port=isset($_GET['port']) ? htmLawed($_GET['port']) : '';
			$pod=isset($_GET['pod_name']) ? htmLawed($_GET['pod_name']) : '';
			$vessel=isset($_GET['vessel']) ? htmLawed($_GET['vessel']) : '';
			$voyin=isset($_GET['voyin']) ? htmLawed($_GET['voyin']) : '';
			$voyout=isset($_GET['voyout']) ? htmLawed($_GET['voyout']) : '';
			
			
			$port_code="";
			$terminal_code="";
			if($port!="")
			{
				$port=explode("-", $port);
				$port_code=$port[0];
				$terminal_code=$port[1];
			}
			
			
			//no error
			// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
			// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
			$modul="getPortPODList";
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port_code>$port_code</port_code>
					<terminal_code>$terminal_code</terminal_code>
					<pod>$pod</pod>
					<vessel>$vessel</vessel>
					<voyout>$voyout</voyout>
					<voyin>$voyin</voyin>
				</data>
			</root>";

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
					//call success
					//echo "<br>----response---<br>";
					//echo $result;
					
					//contoh decode data
					//echo "<br>----decode-----";
					$obj = json_decode($result);
					//echo "<br>";
					//echo $obj->sc_type;echo "<br>";
					//echo $obj->sc_code;echo "<br>";
					//echo $obj->rc;echo "<br>";
					//echo $obj->rcmsg;echo "<br>";
					//echo base64_decode($obj->data->query);
					
					echo "[";
					if($obj->data->pod)
					{
						for($i=0;$i<count($obj->data->pod);$i++)
						{
							if($i==0)
							{
								echo '  {
								"pod": "'.trim($obj->data->pod[$i]->pod).'",
								"pod_name": "'.trim($obj->data->pod[$i]->pod_name).'",
								"country_name": "'.trim($obj->data->pod[$i]->country_name).'",
								"value": "'.trim($obj->data->pod[$i]->pod_name).'",
								"tokens": [
								  "'.trim($obj->data->pod[$i]->pod_name).'",
								  ""
								]
							  }';
							}			
							else 
							{
								echo ' ,{
								"pod": "'.trim($obj->data->pod[$i]->pod).'",
								"pod_name": "'.trim($obj->data->pod[$i]->pod_name).'",
								"country_name": "'.trim($obj->data->pod[$i]->country_name).'",
								"value": "'.trim($obj->data->pod[$i]->pod_name).'",
								"tokens": [
								  "'.trim($obj->data->pod[$i]->pod_name).'",
								  ""
								]
							  }';
							}
							
						}
					}
					echo "]";
				}
			}		
		}
 }
 
 ?>
 