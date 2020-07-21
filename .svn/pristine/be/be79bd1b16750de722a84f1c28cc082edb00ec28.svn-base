<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_controller{


public function __construct()
	{	log_message('debug','----------------------------main.php/__construct------------------------------------');
            parent::__construct();

            $this->load->helper('url');
            $this->load->helper('form');
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->helper('url');
			$this->load->model('auth_model','auth_model');
			//$this->load->helper('cookie');
			$this->load->helper(array('captcha','url'));
			$this->load->helper('captcha');

	}

public function auth(){

	if($this->input->post('security_code') !== $this->session->userdata('mycaptcha')) {
		$data = array(
			'status' => 'error',
			'message' => 'Captcha salah'
		);
		echo json_encode($data);
		die();
	}

	$this->form_validation->set_rules('username','username','required');
	$this->form_validation->set_rules('password','password','required');

	$username	= $this->input->post('username');
 	$password	= md5($this->input->post('password'));

	if($this->form_validation->run() == FALSE)
		{

			$data = array(
					'status' => 'error',
					'message' => 'Periksa username password Anda'
					);

		} else {
			//$user = $this->auth_model->get_by_username_password($username,$password);
			$user = $this->auth_model->get_by_username($username);
			// die();
			if($user) {
				if($password === $user->INV_USER_PASSWORD) {
					// login sukses
					$data_user = array(
											'username' =>$user->INV_USER_USERNAME,
											'name' =>$user->INV_USER_NAME,
											'user_id'	=>$user->INV_USER_ID,
											'level' =>$user->INV_USER_NIPP,
											'role_id'=>$user->INV_USER_ROLE_ID,
											'entity_id' =>$user->INV_USER_ENTITY_ID,
											'entity_code'=> $user->INV_ENTITY_CODE,
											'status' =>$user->INV_USER_STATUS,
											'role_type' => $user->INV_ROLE_TYPE,
											'invoice' => TRUE,
											'is_login' => TRUE
					);

					//cek periode role
					//$is_valid_role = $this->auth_model->is_expired_periode($data_user['user_id'],$data_user['role_id']);
					$is_valid_role = $this->auth_model->is_expired_periode($data_user['user_id']);
					if($is_valid_role === false) {
					$data = array(
									'status' => 'error',
									'message' => 'Periode expired'
									);
					echo json_encode($data);
					die();
					}
					//print_r($data_user);

					$this->session->set_userdata($data_user);
											/*get unit org id*/
					$cek_unit_org = $this->auth_model->check_unit_org();
					// $unit_org =  $cek_unit_org->INV_UNIT_ORGID;
					foreach ($cek_unit_org as $key => $value) {
							$row_unit_org[] = $value['INV_UNIT_ORGID'];
					}
					$unit_org =  json_encode($row_unit_org);



					$role_id = $this->session->userdata('role_id');

					$unit = $this->auth_model->get_filter_role($role_id);
					// echo $role_id;
					// die();

					$unit_id = array();
					foreach ($unit as $key => $value) {
							$row_unit[] = $value->INV_UNIT_CODE;
					}
												 // print_r($unit_org);die();
					$unit_x =  json_encode($row_unit);
											//die;

					if($role_id != 1) {
						$current_org = json_decode($unit_org, true);
						$current_id = json_decode($unit_x, true);
						$current_org_arr[] = $current_org[0];
						$current_id_arr[] = $current_id[0];
						$this->session->set_userdata('unit_org', json_encode($current_org_arr));
						$this->session->set_userdata('unit_id', json_encode($current_id_arr));
					} else {
						$this->session->set_userdata('unit_org', $unit_org);
						$this->session->set_userdata('unit_id', $unit_x);
					}

					$data = array(
									'status' => 'success',
									'message' => 'Success'
					);
					echo json_encode($data);
					die();
				} else {
					// login gagal password salah
					$data = array(
						'status' => 'error',
						'message' => 'Password salah'
					);
					echo json_encode($data);
					die();
				}
			} else {
				// username tidak ditemukan
				$data = array(
					'status' => 'error',
					'message' => 'Username salah'
				);
				echo json_encode($data);
				die();
			}
		}
	}

}

?>
