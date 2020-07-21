<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Forgotpassword extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->helper('MY_language_helper');

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
			$this->load->view('main/forgotpassword', $data);
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
	
	public function submit($ajax=""){
		//$this->redirect();
		
		//var_dump(htmLawed($_POST); die;
		$username 		= htmLawed($_POST['username']);
		injek($username);
		
		if($this->input->post('security_code')) {
			$this->form_validation->set_rules('security_code', 'Security Code', 'required|max_length[6]|integer'); //setting rules untuk security_code
			
			if($this->form_validation->run() == false) {
				$this->form_validation->set_message('security code', 'Please check again your security code');
			}
		}

		if($this->user_model->getCountActiveUserDetailbyUsername($username)>0)
		{
			$userinfo = $this->user_model->getActiveUserDetailbyUsername($username);
			$email = $userinfo["EMAIL"];
			$hash = md5($username.rand(1000,9999));
			injek($hash);
			
			$rs = $this->user_model->reset_password_request($username, $hash);
			//echo $rs;
			if($rs)
			{
				$from	= "";
				$to 	= $email;
				$url 	= ROOT."forgotpassword/resetconf/?usid=$username&hash=$hash"; 
				injek($url);
				$subject = "Permintaan Reset Kata Sandi || Reset Password Request";
				$content = "Anda meminta melakukan reset kata sandi untuk : \n
							Nama Pengguna : $username\n
							Untuk mereset password, silahkan klik link dibawah ini untuk lakukan konfirmasi reset password:\n
							<a href=\"$url\">Reset Kata Sandi</a>\n\n
							atau salin dan tempel link :\n
							$url di browser anda.\n\n\n
							Reset Password for username : \n
							Username : $username\n
							To reset password please click link below :\n
							<a href=\"$url\">Reset Password</a>\n
							\n
							or copy and paste this link : \n
							$url in your browser.
							Thank You.
							\n\n\n
							PT IPC Terminal Petikemas \n
								Gedung Terminal Operasi 3, Lantai 2 & 3 \n
								Jalan Raya Pelabuhan No. 23 \n
								Tanjung Priok, Jakarta Utara 14310 \n
							";

				$rs = $this->user_model->email_notification($from, $to, $subject, $content);
				
				if($rs)
				{
					$msg = "?msg=<center><b>Anda melakukan reset kata sandi. Silahkan cek surel untuk konfirmasi.<br><br>Reset Password request. Please Check your email to confirm.<b></center>";
				}
			}			
		}
		else 
		{
			$msg = "?msg=<center><b>Nama pengguna tidak terdaftar atau belum aktif.<br>Username not registered or not active<br><b></center>";
			
		}
		
		if (!$ajax){
			redirect(ROOT."$msg");
		}
		else{
			echo $rs;
		}
	}
	
	public function submit1(){
		
		//var_dump(htmLawed($_POST); die;
		$ajax			= htmLawed($_POST['ajax']);;
		$username 		= htmLawed($_POST['username']);
		$security_code	= htmLawed($_POST['security_code']);
		injek($username);
		
		$mycaptcha = $this->session->userdata('mycaptcha');
		
		if(checkcaptcha($security_code, $mycaptcha) === "OK"){
			$unameCheck = $this->user_model->check_username($username);
			$resetCheck = $this->user_model->count_reset($username);
			
			if(checkcaptcha($security_code, $mycaptcha) === "OK" && $unameCheck !== 0 && $resetCheck === 0){	
				if($this->input->post('security_code')) {
					$this->form_validation->set_rules('security_code', 'Security Code', 'required|max_length[6]|integer'); //setting rules untuk security_code
					
					if($this->form_validation->run() == false) {
						$this->form_validation->set_message('security code', 'Please check again your security code');
					}
				}
				if($this->user_model->getCountActiveUserDetailbyUsername($username)>0)
				{
					$userinfo = $this->user_model->getActiveUserDetailbyUsername($username);
					$email = $userinfo["EMAIL"];
					$hash = md5($username.rand(1000,9999));
					injek($hash);
					$rs = $this->user_model->reset_password_request($username, $hash);
					//echo $rs;
					if($rs)
					{
						$from	= "";
						$to 	= $email;
						$url 	= ROOT."forgotpassword/resetconf/?usid=$username&hash=$hash"; 
						injek($url);
						$subject = "Permintaan Reset Kata Sandi || Reset Password Request";
						$content = "Anda meminta melakukan reset kata sandi untuk : \n
									Nama Pengguna : $username\n
									Untuk mereset password, silahkan klik link dibawah ini untuk lakukan konfirmasi reset password:\n";
									$content.="<a href=".$url.">Reset Kata Sandi</a>";
									$content.="\n
									atau salin dan tempel link :\n
									$url di browser anda.\n\n\n
									Reset Password for username : \n
									Username : $username\n 
									To reset password please click link below :\n
									<a href=\"$url\">Reset Password</a>\n
									\n
									or copy and paste this link : \n
									$url in your browser.
									Thank You.
									\n\n\n
									PT IPC Terminal Petikemas \n
									Gedung Terminal Operasi 3, Lantai 2 & 3 \n
									Jalan Raya Pelabuhan No. 23 \n
									Tanjung Priok, Jakarta Utara 14310 \n
									";

						$rs = $this->user_model->email_notification($from, $to, $subject, $content);
						
						if($rs)
						{
							$msg = "?msg=<center><b>Anda melakukan reset kata sandi. Silahkan cek surel untuk konfirmasi.<br><br>Reset Password request. Please Check your email to confirm.<b></center>";
							$this->user_model->lock_reset($username);
						}
					}			
				}
				else 
				{
					$msg = "?msg=<center><b>Nama pengguna tidak terdaftar atau belum aktif.<br>Username not registered or not active<br><b></center>";
					
				}
				if (!$ajax){
					//redirect(ROOT."$msg");
					echo $msg;
				}
				else{
					echo "Failed";
					//echo $rs;
				}
			} else {
				if(checkcaptcha($security_code, $mycaptcha) !== "OK"){
					echo "NOK";
				} else if($unameCheck === 0){
					echo "NOKuser";
				} else if($resetCheck !== 0){
					echo "NOKreset";
				}
			}
		} else {
			echo "NOK";
		}
	}

	public function resetconf()
	{
		$userid = htmLawed($_GET["usid"]);
		$hash = htmLawed($_GET["hash"]);
		$msg="";
		
		if($this->user_model->get_user($userid, $hash)>0)
		{			
			$data["title"]	= "Reset Pasword";
			$data["page"]	= "Reset";
			$data["msg"]	= $msg;
			
			$this->load->view('config/header_login', $data);
			$this->load->view('main/resetpassword', $data);
			$this->load->view('config/footer_login', $data);
			
			/*$msg="?msg=<center><b>Reset password berhasil. Silahkan lakukan login. <br>
					Reset Password success. Please do login</b></center>";*/
		}
		else
		{
			$msg="?msg=<center><b>Nama pengguna dan/atau sandi tidak cocok. <br> Username and/or password does not match</b></center>";
			redirect(ROOT."$msg");
		}
	}
	
	public function resetpassword()
	{
		$username 		= htmLawed($_POST['username']);
		$encryptedpass 	= htmLawed($_POST['encryptedpass']);
		$msg = "";
		
		if ( $this->is_privilaged('ENABLE_USER') && isset($_POST['enabled']) && strlen($_POST['enabled']) > 0 ){
			$enabled = htmLawed($_POST['enabled']);
		}
		if ( $this->is_privilaged('ASSIGN_USER') && isset($_POST['id_group']) && strlen($_POST['id_group']) > 0 ){
			$id_group = htmLawed($_POST['id_group']);
		}

		$rs = $this->user_model->reset_password($username, $encryptedpass);
		
		if($rs)
		{
			$userinfo = $this->user_model->getActiveUserDetailbyUsername($username);
			$email = $userinfo["EMAIL"];
			
			$from	= "";
			$to 	= $email;
			$url 	= ROOT."forgotpassword/resetconf/?usid=$username&hash=$hash"; 
			$subject = "Reset Kata Sandi || Reset Password";
			$content = "Anda telah melakukan reset kata sandi untuk : \n
						Nama Pengguna : $username\n
						Terimakasih
						\n\n
						Reset Password for username : \n
						Username : $username\n
						Thank You.
						\n\n\n
						PT IPC Terminal Petikemas \n
								Gedung Terminal Operasi 3, Lantai 2 & 3 \n
								Jalan Raya Pelabuhan No. 23 \n
								Tanjung Priok, Jakarta Utara 14310 \n
						";

			$rs = $this->user_model->email_notification($from, $to, $subject, $content);
			
			if($rs)
			{
				$this->user_model->unlock_reset($username);	//unlock reset (forgot password)
				$msg = "?msg=<center><b>Reset kata sandi berhasil. <br><br>Reset Password success.<b></center>";				
			}
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