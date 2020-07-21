 <?php

 class GetCustomerList extends CI_controller {

		function __construct() {
			parent::__construct();

			$this->load->library("Nusoap_lib");
			$this->load->helper("url");
			$this->load->library('session');
			$this->load->model("user_model");
			$this->load->model("master_model");
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

		function index() 
		{
			//echo "test";die;
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
			//echo $term;
			//echo $port.' L';die;
			$stack = $this->master_model->get_customerList($term,$port[0],$port[1]);
			
            echo json_encode($stack);
		}
 }

 ?>
