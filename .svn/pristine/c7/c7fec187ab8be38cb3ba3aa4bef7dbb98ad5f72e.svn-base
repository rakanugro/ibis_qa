 <?php
 
 class GetDetailPKK extends CI_controller {
 
		function __construct() {
			parent::__construct();

			$this->load->library("Nusoap_lib");
			$this->load->helper("url");
			$this->load->helper('MY_language_helper');
			$this->load->library('session');
			
			/*$this->load->model("user_model");
			
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			redirect(ROOT.'mainpage', 'refresh');
			*/
             require_once(APPPATH.'libraries/htmLawed.php');
			
		}
		
		function index() {
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

			//input
			$no_pkk="MRT201000015";
			injek($no_pkk);
			
			if(isset($_POST['no_pkk'])) $no_pkk = htmLawed($_POST['no_pkk']);
			
			log_message('error','>>>>>>>>>>>>>>>> ini getdetailpkk'.$no_pkk);
			$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<no_pkk>$no_pkk</no_pkk>
					<agent_id>165</agent_id>
				</data>
			</root>";
			injek($in_data);
			
			if(!$this->nusoap_lib->call_wsdl(VESSEL,"getDetailPKK",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//call success
				echo $result;
				
				$obj = json_decode($result);
			}
			
		}
 }

 ?>