 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{	log_message('debug','----------------------------main.php/__construct------------------------------------');
            parent::__construct();
            //$this->load->database();
            $this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('url');
			$this->load->model('user_model');
			//$this->load->helper('cookie');
			$this->load->helper(array('captcha','url'));
			/*$this->load->library('session');
            if (! $this->session->userdata('is_login') ){

			 	redirect(ROOT.'main_invoice', 'refresh');
			 //echo site_url('dashboard/page_down')
			}*/
			$this->clear_cache();
			require_once(APPPATH.'libraries/htmLawed.php');
	}

	private function redirect(){
		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function index($token = null)
	{	


		log_message('debug','----------------------------main.php/index------------------------------------');
		// print_r($token);
		// die();
		//Login With Token
		if($token != null){
				$this->user_model->deleteSession();
			$this->user_model->saveSession();

			//print_r('token adalah '.$token);die;
			//$this->session->sess_destroy();
			//$this->clear_cache();
			$token_ref = $this->user_model->get_token_ref($token);
			if(empty($token_ref)){
				log_message('debug','>>> Invalid Token');
				$this->load->view('homepage/index.php',$data);
				//echo $data;die();
				// $this->load->view('homepage/new_login.php',$data);
			}else{
				$username	 = $token_ref['USERNAME'];
				$pass_enc	 = $token_ref['PASSWORD'];;
				$lang		 = 'EN';
				$ipaddress 	 = $this->input->ip_address();
				if($this->user_model->check_user_token($username, $pass_enc, $lang, $ipaddress) =='success'){
					//echo json_encode($this->session->userdata);die;
					log_message('debug','>>> Login with Token');
					redirect(ROOT.'mainpage', 'refresh');
				}else{
					log_message('debug','>>> Fail to Login With Token');
					$this->load->view('homepage/index.php',$data);
					// $this->load->view('homepage/new_login.php',$data);
				}
			}
		}
		else
		{
			$count_failed = $this->session->userdata('captcha_failed_count')+0;
			if($count_failed>50){
				header('Location: '.ROOT."/main/failed_captcha");
				die();
			}
			log_message('debug',$this->session->userdata('session_id').'++main_index++ '.$this->session->userdata('name_phd'));
			/*tambahan ganda*/
			$this->user_model->deleteSession();
			$this->user_model->saveSession();

			$this->load->helper('captcha');
			$vals = array(
					'img_path'	 => UPLOADFOLDER_.'captcha/',
					'img_url'	 => APP_ROOT.'captcha/',
					'img_width'	 => '250',
					'img_height' => 50,
					'word_length' => 5,
					'font_size' => 20,
					'font_path' => UPLOADFOLDER_. 'captcha/font/Verdana.ttf',
					'border' => 1,
					'expiration' => 7200
				);

			// create captcha image
			$cap = create_captcha($vals);

			// store image html code in a variable
			$data['image'] = $cap['image'];

			// store the captcha word in a session
			$this->session->set_userdata('mycaptcha', $cap['word']);

			//AP12
			$this->user_model->saveCaptcha($this->session->userdata('session_id'),$cap['word']);

			$data['username'] = isset($username) ? $username : '';
			/**/
			//if($this->session->userdata('name_phd')){
			if($this->user_model->isUserLogin($this->session->userdata('session_id')))	{
				log_message('debug','>>> Go to Mainpage');
				redirect(ROOT.'mainpage', 'refresh');
			} else {
				log_message('debug','>>> Go to Homepage');
				$this->load->view('homepage/index.php',$data);
				// $this->load->view('homepage/new_login.php',$data);

			}

		}
	}

	public function login_view($username="")
	{

		log_message('debug','----------------------------main.php/login_view------------------------------------');

		//AP12
		$this->user_model->saveSession();

		$this->load->helper('captcha');
		$vals = array(
                'img_path'	 => UPLOADFOLDER_.'captcha/',
                'img_url'	 => APP_ROOT.'captcha/',
                'img_width'	 => '250',
                'img_height' => 50,
				'word_length' => 5,
				'font_size' => 20,
				'font_path' => UPLOADFOLDER_. 'captcha/font/Verdana.ttf',
                'border' => 1,
                'expiration' => 7200
            );

		// create captcha image
		$cap = create_captcha($vals);

		// store image html code in a variable
		$data['image'] = $cap['image'];

		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);

		//AP12
		$this->user_model->saveCaptcha($this->session->userdata('session_id'),$cap['word']);

		$data['username'] = $username;
		$this->load->view('homepage/login.php',$data);
	}

	public function do_log()
	{	
		ini_set("memory_limit","-1");
		set_time_limit(0);
		$this->load->library("Nusoap_lib");

		// Update data Expired
		
		//backup
		//$this->db->query("UPDATE MST_CUSTOMER_ACTIVATION SET PELANGGAN_AKTIF = '0' WHERE  user_id IN (select user_id from mst_customer_activation where (to_date(expired_date, 'dd-mm-yyyy')) - (to_date(sysdate, 'dd-mm-yyyy')) = 0) ");

		log_message('debug','----------------------------main.php/do_log------------------------------------');
		//end login from Token


		//AP12
		//$this->redirect();
		$username	= htmLawed($_POST["username"]);
		$pass		= htmLawed($_POST["password"]);
		$lang		= 'EN';
		$ipaddress 	= $this->input->ip_address();
		$count_failed = $this->session->userdata('captcha_failed_count')+0;
		//echo('test');die;
		$config = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|max_length[50]'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[100]'
			),
			array(
				'field' => 'security_code',
				'label' => 'code',
				'rules' => 'required|max_length[6]|integer'
			)
		);

		if($this->input->post()) {

			$this->form_validation->set_rules($config); //setting rules inputan login

			if($this->form_validation->run() == false) {
				echo validation_errors();
			}
		}

		if($count_failed>50){
			echo "To many fail";
			die;
		}

		//if(htmLawed($_POST['security_code']) == $this->session->userdata('mycaptcha'))

		//AP12
		if($this->user_model->isMatchCaptcha(htmLawed($_POST['security_code'])))
		{

			$rs = $this->user_model->check_user($username, $pass, $lang);

			if( $rs == "success"){
				
							echo "Success";

				$this->db->query("UPDATE MST_CUSTOMER_ACTIVATION SET PELANGGAN_AKTIF = '0' , MASA_BERLAKU = 'EXPIRED' WHERE (to_date(sysdate, 'dd-mm-yyyy')) - (to_date(expired_date, 'dd-mm-yyyy')) >= 0 AND MASA_BERLAKU = 'AKTIF'");


				$cek =  $this->db->query("SELECT CUSTOMER_ID, BRANCH_ID , MASA_BERLAKU FROM MST_CUSTOMER_ACTIVATION WHERE MASA_BERLAKU = 'EXPIRED' AND STATUS_SYNC IS NULL");
				foreach($cek->result() as $r){
					$in_data="
						<root>
							<sc_type>1</sc_type>
							<sc_code>123456</sc_code>
							<data>
								<customer_id>
									".@$r->CUSTOMER_ID." 
								</customer_id>
								<branch_id>
									".@$r->BRANCH_ID."
								</branch_id>
							</data>
						</root>";

						if ($r->MASA_BERLAKU == "EXPIRED")
						{
							$service_name = "syncDeactivationExpired";//priok dan non priok digabung
						}
						if(!$this->nusoap_lib->call_wsdl(CUSTOMER_DATA,$service_name,array("in_data" => "$in_data"),$result))
						{
							echo $result;
							//die;
						}
						else
						{
							//print_r ($r->CUSTOMER_ID);
							$tes = $this->db->query("UPDATE MST_CUSTOMER_ACTIVATION SET STATUS_SYNC = 'SUCCESS' WHERE CUSTOMER_ID = ".$r->CUSTOMER_ID."");
							//$tes = $this->db->query("SELECT CUSTOMER_ID FROM MST_CUSTOMER_ACTIVATION WHERE CUSTOMER_ID = ".@$r->CUSTOMER_ID."");
							
						}	
				}
			}else {
				log_message('info','< Failed login!');

				$temp = $rs;
				$query = $this->user_model->get_user_count($username);
				$rs = $this->user_model->get_content('login',$rs);
				$this->session->set_userdata('msg', $rs);

				if($temp == 'failed' && $query){

					log_message('debug', '< Login for '.$username.': '.$rs.' ('.$query->USERNAME.','.$query->COUNT.').');
					echo $rs.' ('.$query->USERNAME.','.$query->COUNT.').';

				}else{

					log_message('debug', '< Login for '.$username.': '.$rs);
					echo $rs;
				}
			}

		}
		else {
		
			log_message('debug','< wrong captcha');
			$count_failed = $this->session->userdata('captcha_failed_count')+0;
			$count_failed = $count_failed + 1;
			$this->session->set_userdata('captcha_failed_count', $count_failed);
			echo "salah captcha atau captcha anda sudah pernah digunakan, mohon login ulang";
		}

		
		

		$this->user_model->deleteSession();
	}

	public function change_lang($lang)
	{
		$this->session->set_userdata('lang_phd', $lang);
		header('Location: '.ROOT."/mainpage");
	}

	public function logout()
	{
		//AP12
		$this->session->sess_destroy();
		$this->clear_cache();

		redirect(ROOT.'mainpage', 'refresh');
	}


	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

	public function get_captcha(){
		//AP12
		//$this->redirect();

		//outputRaw();
		header("Content-type: image/png");

		$alpha = '23456789ABCDEFGH';
		$code  = "";
		for ($i=0;$i<4;$i++) {
			$code .= substr($alpha, rand(0,strlen($alpha)-1),1);
		}

		$this->session->set_userdata('sess_captcha_phd', md5($code."eservice"));
		$string = $code;
		$im     = imagecreatefrompng(CUBE_."img/captcha.png");
		$white  = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$white);
		$black  = imagecolorallocate($im, 0, 0, 0);
		$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
		imagestring($im,5, $px,8, $string, $black);
		imagepng($im);
		imagedestroy($im);
	}

	public function failed_captcha(){
		//AP12
		//$this->redirect();

		//outputRaw();
		echo("Failed Captcha Limit Reached<br/>");
		echo("Contact System Administrator<br/>");
		die();
	}
}
