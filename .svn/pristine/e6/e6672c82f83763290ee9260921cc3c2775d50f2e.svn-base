<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Reguser extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->helper(array('captcha','url'));
		$this->load->helper('my_language_helper');
			
                require_once(APPPATH.'libraries/htmLawed.php');
	}

	public function index($msg=""){
		if($this->session->userdata('name_phd')){
			redirect(ROOT.'mainpage', 'refresh');
		} else {
			$data["title"]	= "Register New User";
			$data["page"]	= "login";
			$data["msg"]	= $msg;
			
			$data['image'] = $this->getNewCaptcha();
			
			$this->load->view('config/header_login', $data);
			$this->load->view('main/reguser', $data);
			$this->load->view('config/footer_login', $data);
		}

	}

	public function getNewCaptcha($ajax=false)
	{
		$this->load->helper('captcha');
	
		$vals = array(
			'img_path'	 => UPLOADFOLDER_.'captcha/',
			'img_url'	 => APP_ROOT.'captcha/',
			'img_width'	 => '240',
			'img_height' => 50,
			'word_length' => 6,
			'font_size' => 20,
			'font_path' => UPLOADFOLDER_. 'captcha/font/Verdana.ttf',
			'border' => 1, 
			'expiration' => 7200
		);

		// create captcha image
		$cap = create_captcha($vals);
		
		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);

		// store image html code in a variable
		if($ajax)
			echo $cap['image'];
		else 
			return $cap['image'];
	}
	
	public function checksecuritycode()
	{
		if(htmLawed($_POST['security_code']) == $this->session->userdata('mycaptcha'))
		{
			echo "OK";
		}
		else
			echo "NOK";
	}
	
	public function submit($ajax="") {
	
		// var_dump(htmLawed($_POST); die;
		$username 		= htmLawed($_POST['username']);
		$encryptedpass	= htmLawed($_POST['encryptedpass']);
		$name			= htmLawed($_POST['name']);
		$email			= htmLawed($_POST['email']);
		$security_code	= htmLawed($_POST['security_code']);
		$created_by		= htmLawed($_POST['created_by']);
		$enabled		= 0;
		$id_group		= "0"; //default id group = 0
		
		injek($username);
		injek($encryptedpass);
		injek($name);
		injek($email);
		injek($security_code);
		injek($created_by);
		injek($enabled);
		injek($id_group);
				
		//setting rangkaian rules pada variable config
		$config = array(
			array(
				'field' => 'username',
				'label' => 'User Name',
				'rules' => 'required|max_length[100]'
			),
			array(
				'field' => 'name',
				'label' => 'Real Name',
				'rules' => 'required|max_length[100]'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|max_length[100]|valid_email'
			),
			array(
				'field' => 'security_code',
				'label' => 'code',
				'rules' => 'required|max_length[6]|integer',
				
			)
		);
		
		if($this->input->post()) {
			$this->form_validation->set_rules($config); //setting rules inputan register user
			
			if($this->form_validation->run() == false) {				
				echo 'salah';
				return;
			}
		}
		
		if ( $this->is_privilaged('ENABLE_USER') && isset($_POST['enabled']) && strlen($_POST['enabled']) > 0 ){
			$enabled = htmLawed($_POST['enabled']);
		}
		if ( $this->is_privilaged('ASSIGN_USER') && isset($_POST['id_group']) && strlen($_POST['id_group']) > 0 ){
			$id_group = htmLawed($_POST['id_group']);
		}		
		
		$hash = md5($username.$encryptedpass.rand(1000,9999));
		
		$rs = $this->user_model->create_user($username, $encryptedpass, $name, $email, $id_group, $enabled, $created_by, $hash);
		
		if($rs)
		{
			$from	= "";
			$to 	= $email;
			$url 	= ROOT."reguser/activation/?usid=$username&hash=$hash"; 
			$subject = "Aktivasi Pendaftaran Pengguna || User Registration Activation";
			$content = "Anda telah mendaftarkan nama pengguna : \n
						Nama Pengguna : $username\n
						Pendaftaran anda telah berhasil. Untuk mulai menggunakan nama pengguna tersebut, silahkan klik link dibawah ini untuk konfirmasi dan aktivasi :\n
						<a href=\"$url\">Aktivasi Pengguna</a>\n
						\n
						atau salin dan tempel link :\n
						$url di browser anda.\n\n
						Your username : \n
						Username : $username\n
						Has been registered. Please click link below to confirm and activate the user.\n
						<a href=\"$url\">Activate User</a>\n
						\n
						or copy and paste this link : \n
						$url in your browser.\n
						Warm Regards,\n

						PT IPC Terminal Petikemas\n
						Gedung Terminal Operasi 3, Lantai 2 & 3\n
						Jalan Raya Pelabuhan No. 23\n
						Tanjung Priok, Jakarta Utara 14310\n
					";
							
			

			$rs = $this->user_model->email_notification($from, $to, $subject, $content);
			
			if($rs)
			{
				$msg = "?msg=<center><b>Anda melakukan pendaftaran pengguna. Silahkan cek surel untuk konfirmasi dan aktivasi nama pengguna anda.<br><br>Registration Success. Please Check your email to confirm and activate the user.<b></center>";
			}
		}
		
		if (!$ajax){
			redirect(ROOT."$msg");
		}
		else{
			echo $rs;
		}
	}

	public function submit1() {
		$username 		= htmLawed($_POST['username']);
		$encryptedpass	= htmLawed($_POST['encryptedpass']);
		$name			= htmLawed($_POST['name']);
		$email			= htmLawed($_POST['email']);
		$security_code	= htmLawed($_POST['security_code']);
		$created_by		= htmLawed($_POST['created_by']); //user-ibis
		$enabled		= 0;
		$id_group		= "0"; //default id group = 0
		
		injek($username);
		injek($encryptedpass);
		injek($name);
		injek($email);
		injek($security_code);
		injek($created_by);
		injek($enabled);
		injek($id_group);
		
		$mycaptcha = $this->session->userdata('mycaptcha');
		
		if(checkcaptcha($security_code, $mycaptcha) === "OK"){
			$unameCheck = $this->user_model->check_username($username);			
			
			if(checkcaptcha($security_code, $mycaptcha) === "OK" && $unameCheck === 0){	
				//setting rangkaian rules pada variable config
				$config = array(
					array(
						'field' => 'username',
						'label' => 'User Name',
						'rules' => 'required|max_length[50]|alpha_numeric'
					),
					array(
						'field' => 'name',
						'label' => 'Real Name',
						'rules' => 'required|max_length[100]'
					),
					array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'required|max_length[100]|valid_email'
					),
					array(
						'field' => 'security_code',
						'label' => 'code',
						'rules' => 'required|max_length[6]|integer',
						
					)
				);
				
				if($this->input->post()) {
					$this->form_validation->set_rules($config); //setting rules inputan register user
					
					if($this->form_validation->run() == false) {				
						echo 'salah';
						return;
					}
				}
				
				if ( $this->is_privilaged('ENABLE_USER') && isset($_POST['enabled']) && strlen($_POST['enabled']) > 0 ){
					$enabled = htmLawed($_POST['enabled']);
				}
				if ( $this->is_privilaged('ASSIGN_USER') && isset($_POST['id_group']) && strlen($_POST['id_group']) > 0 ){
					$id_group = htmLawed($_POST['id_group']);
				}		
				
				$hash = md5($username.$encryptedpass.rand(1000,9999));
				
				$rs = $this->user_model->create_user($username, $encryptedpass, $name, $email, $id_group, $enabled, $created_by, $hash);
				
				if($rs)
				{
					log_message('debug','<<<<<<< if rs');
					$from	= "e-service@indonesiaport.co.id";
					$to 	= $email;
					$url 	= ROOT."reguser/activation/?usid=$username&hash=$hash"; 
					$subject = "Aktivasi Pendaftaran Pengguna || User Registration Activation";
					$content = "Anda telah mendaftarkan nama pengguna : \n\r <br/> 
								Nama Pengguna : $username \n\r <br/> 
								Pendaftaran anda telah berhasil. Untuk mulai menggunakan nama pengguna tersebut, silahkan klik link dibawah ini untuk konfirmasi dan aktivasi : \n\r <br/>
								Aktivasi Pengguna \n\r <br/>
								\n\r <br/>
								atau salin dan tempel link : \n\r <br/>
								$url di browser anda. \n\r <br/> \n\r <br/>
								Your username :  \n\r <br/>
								Username : $username \n\r <br/>
								Has been registered. Please click link below to confirm and activate the user. \n\r <br/>
								Activate User \n\r <br/> \n\r <br/>
								or copy and paste this link :  \n\r <br/>
								$url in your browser.
								Warm Regards, \n\r <br/>

								PT IPC Terminal Petikemas \n\r <br/>
								Gedung Terminal Operasi 3, Lantai 2 & 3 \n\r <br/>
								Jalan Raya Pelabuhan No. 23 \n\r <br/>
								Tanjung Priok, Jakarta Utara 14310 \n\r <br/>
								";

					$rs = $this->user_model->email_notification($from, $to, $subject, $content);
					
					if($rs)
					{
						$msg = "?msg=<center><b>Anda melakukan pendaftaran pengguna. Silahkan cek surel untuk konfirmasi dan aktivasi nama pengguna anda.<br><br>Registration Success. Please Check your email to confirm and activate the user.<b></center>";
						echo $msg;
					}
				}else{
					echo "Failed";
				}	
			} else {
				if(checkcaptcha($security_code, $mycaptcha) !== "OK"){
					echo "NOK";
				} else if($unameCheck !== 0){
					echo "NOKuser";
				}
			}
		} else {
			echo "NOK";
		}
	}
	
	public function activation()
	{
		$userid = htmLawed($_GET["usid"]);
		$hash = htmLawed($_GET["hash"]);
		if($this->user_model->get_user($userid, $hash)>0)
		{
			if($this->user_model->enable_user($userid, $hash))
			{
				$msg = "?msg=<center><b>Aktivasi user berhasil. Silahkan lakukan login. <br><br> Activation is success. Please do login.<b></center>";
			}
		}
		else
		{
			$msg = "?msg=<center><b>Nama pengguna dan/atau sandi tidak cocok. <br><br> Username and/or password does not match<b></center>";
		}
		redirect(ROOT."$msg");
	}
	
	public function update(){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		
		echo "Under Construction";
	}
	
	public function check_username($username){
		if (!$this->session->userdata('uname_phd')){
			redirect(ROOT.'main', 'refresh');
		}
		
		echo (boolean) $this->user_model->check_username($username);
	}
	
	public function is_privilaged($privilage){
		if ( $this->session->userdata('name_phd') && $this->user_model->check_privilage($this->session->userdata('name_phd'),$privilage) > 0 ){
			return true;
		}
		else {
			return false;
		}
	}
	
	
}