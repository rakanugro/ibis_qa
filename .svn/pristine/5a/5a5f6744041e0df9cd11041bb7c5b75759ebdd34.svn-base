<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_invoice extends CI_Controller {


	public function __construct()
	{	log_message('debug','----------------------------main.php/__construct------------------------------------');
            parent::__construct();
            //$this->load->database();
            $this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('url');
			//$this->load->model('user_model');
			//$this->load->helper('cookie');
			$this->load->library('session');
			$this->load->helper(array('captcha','url'));
			require_once(APPPATH.'libraries/htmLawed.php');
	}

	public function index(){

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

		$this->load->view('homepage/new_login',$data);
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(ROOT.'main_invoice');
	}
}
