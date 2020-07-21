 <?php
 
 class GetPortFPODList extends CI_controller {
 
	function __construct() {
		parent::__construct();

		$this->load->library("Nusoap_lib");
		$this->load->helper("url");
		$this->load->model("user_model");
		$this->load->library('session');	
		//	if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
		//	redirect(ROOT.'mainpage', 'refresh');

                require_once(APPPATH.'libraries/htmLawed.php');
	}
	
	function index() {
		
		$port=isset($_GET['port']) ? htmLawed($_GET['port']) : '';
		$fpod=isset($_GET['fpod_name']) ? htmLawed($_GET['fpod_name']) : '';
		
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
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<fpod>$fpod</fpod>
				<port_code>$port_code</port_code>
				<terminal_code>$terminal_code</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(TRACKING_CONTAINER,"getPortFPODList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			$obj = json_decode($result);

			echo "[";
			if($obj->data->fpod)
			{
				for($i=0;$i<count($obj->data->fpod);$i++)
				{
					if($i==0)
					{
						echo '  {
						"fpod": "'.trim($obj->data->fpod[$i]->fpod).'",
						"fpod_name": "'.trim($obj->data->fpod[$i]->fpod_name).'",
						"country_name": "'.trim($obj->data->fpod[$i]->country_name).'",
						"value": "'.trim($obj->data->fpod[$i]->fpod_name).'",
						"tokens": [
						  "'.trim($obj->data->fpod[$i]->fpod_name).'",
						  ""
						]
					  }';
					}			
					else 
					{
						echo ' ,{
						"fpod": "'.trim($obj->data->fpod[$i]->fpod).'",
						"fpod_name": "'.trim($obj->data->fpod[$i]->fpod_name).'",
						"country_name": "'.trim($obj->data->fpod[$i]->country_name).'",
						"value": "'.trim($obj->data->fpod[$i]->fpod_name).'",
						"tokens": [
						  "'.trim($obj->data->fpod[$i]->fpod_name).'",
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
 
 ?>