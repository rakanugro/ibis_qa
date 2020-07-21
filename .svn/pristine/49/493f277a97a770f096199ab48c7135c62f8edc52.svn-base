 <?php

 class GetHsCode extends CI_controller {

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
			$port=explode("-",htmLawed($_GET["port"]));
			
			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<key_name>".$term."</key_name>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
				</data>
			</root>";

			if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getHsCode",array("in_data" => "$in_data"),$result))
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
				if($obj->data->hscode){
				  for($i=0;$i<count($obj->data->hscode);$i++)
					{
						$temp;
						$temp['ID_CARGO']=$obj->data->hscode[$i]->id_cargo;
						$temp['HS_CODE']=$obj->data->hscode[$i]->hs_code;
						$temp['CARGO_NAME']=$obj->data->hscode[$i]->cargo_name;
						$temp['SIZE_']=$obj->data->hscode[$i]->size;
						$temp['TYPE_']=$obj->data->hscode[$i]->type;
						$temp['STATUS_']=$obj->data->hscode[$i]->status;
						array_push($stack1, $temp);
					}
				}
			}
        
			
            echo json_encode($stack1);
		}
 }

 ?>
