 <?php
 
 class Example_client extends CI_controller {
 
		function __construct() {
			parent::__construct();

			$this->load->library("Nusoap_lib");
			$this->load->model('user_model');
			$this->load->helper("url");
			
			//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);
			
			
		}
		
		function index() {
			
			$client = new nusoap_client(XMTI);

			$error = $client->getError();

			if ($error) {
				echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
				return;
			}

			$modul				=	"getCustomerOrafin";
			$customer_name		=	"MT & L INDONESIA, PT";//dikosongkan untuk ambil semua
			$customer_number	=	"";//dikosongkan untuk ambil semua
			$insert_date_start	=	"";//dikosongkan untuk ambil semua
			$insert_date_end	=	"";//dikosongkan untuk ambil semua

			$result = $client->call($modul, array("customer_name" => "$customer_name", "customer_number" => "$customer_number", "insert_date_start" => "$insert_date_start", "insert_date_end" => "$insert_date_end"));

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
					//Header('Content-type: text/xml');
					echo $result;
				}
			}
		
		}
 }
 
 ?>