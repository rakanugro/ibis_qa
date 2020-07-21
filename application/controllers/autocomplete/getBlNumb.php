 <?php

 class GetBlNumb extends CI_controller {

		function __construct() {
			parent::__construct();

			$this->load->library("Nusoap_lib");
			$this->load->helper("url");
			$this->load->library('session');
			$this->load->model("user_model");
			$this->load->model("master_model");
			$this->load->helper('MY_language_helper');
			require_once(APPPATH.'libraries/htmLawed.php');
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

		function index() 
		{
			$term = strtoupper($_GET["term"]);
			$ukk = strtoupper($_GET["ukk"]);
			$port=explode("-",htmLawed($_GET["port"]));
			
			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<key_name>".$term."</key_name>
					<ukk>".$ukk."</ukk>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getBlNumb",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				//print_r($result);die;
				$obj = json_decode($result);
				//log_message('error','>>>>>>>>>> auto POD: '.$result);
				$stack1	= array();
				if($obj->data->bl){
				  for($i=0;$i<count($obj->data->bl);$i++)
					{
						$temp;
						$temp['BL_NUMBER']=$obj->data->bl[$i]->bl_number;
						$temp['ID_VVD']=$obj->data->bl[$i]->id_vvd;
						array_push($stack1, $temp);
					}
				}
			}
        
			
            echo json_encode($stack1);
		}
 }

 ?>
