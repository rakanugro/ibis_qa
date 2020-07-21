<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Maintenance extends CI_Controller {

	public function __construct(){
                parent::__construct();
                $this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->model('user_model');
				$this->load->model('master_model');
				$this->load->library("Nusoap_lib");
				$this->load->library("table");
				$this->load->helper('MY_language_helper');
				$this->load->library('session');

				//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		$this->load->model('auth_model','auth_model');
			if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
		

	}

	public function master_tarif(){
			  if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

		    $this->table->set_heading("No",
								  "Size",
                                  "Equipment",
                                  "Fare",
								  'EDIT'
                                 );

			$datatarif = $this->master_model->get_master_tarif();

            for($i=0;$i<count($datatarif);$i++)
			{
				$view_link = '<a  class=\'btn btn-primary\'  href="'.ROOT."maintenance/edit_tarif/".$datatarif[$i]['KD_TARIF'].'"><i class=\'fa fa-eye\'></i></a>';
				$this->table->add_row(
													$i+1,
													$datatarif[$i]['SIZE_'],
													$datatarif[$i]['ALAT'],
													$datatarif[$i]['TARIF'],
													$view_link
												);
			}

            $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

	        $this->load->view('templates/header', $data);
			$this->load->view('templates/top_bar', $data);
			$this->load->view('templates/menu_side', $data);
			$this->load->view('pages/maintenance/master_tarif', $data);
			$this->load->view('templates/footer', $data);
	}

	public function edit_tarif($id){
			  if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

            $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
			$data['datatarif'] = $this->master_model->get_master_tarifbyid($id);

	        $this->load->view('templates/header', $data);
			$this->load->view('templates/top_bar', $data);
			$this->load->view('templates/menu_side', $data);
			$this->load->view('pages/maintenance/edit_tarif', $data);
			$this->load->view('templates/footer', $data);
	}

	public function update_tarif(){
			  if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
			//print_r($this->input->post('kd_tarif'));die;
			$this->master_model->update_tarif($this->input->post('kd_tarif'),$this->input->post('tarif'));

			redirect(ROOT.'maintenance/master_tarif', 'refresh');

	}


	public function master_vessel(){
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}

		    $this->table->set_heading("No",
								 "Vessel Code",
                                  "Vessel",
                                  "Call Sign",
                                  "Operator Name"
                                 );

			$datavessel = $this->master_model->get_master_vessel();

                  for($i=0;$i<count($datavessel);$i++)
				    {
						$this->table->add_row(
													$i+1,
													$datavessel[$i]['VESSEL_CODE'],
													$datavessel[$i]['VESSEL_NAME'],
													$datavessel[$i]['CALL_SIGN'],
													$datavessel[$i]['OPERATOR_NAME']
												);
					}


            $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

	        $this->load->view('templates/header', $data);
			$this->load->view('templates/top_bar', $data);
			$this->load->view('templates/menu_side', $data);
			$this->load->view('pages/maintenance/master_vessel', $data);
			$this->load->view('templates/footer', $data);
	}

}

?>
