<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class truckregistrasi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('booking_model');
        $this->load->model('master_model');
        $this->load->model('container_model');
        $this->load->model('npkbilling/trucks/registrasi_truck_model');
        $this->load->model('npkbilling/master/mdm_model');
        $this->load->library("nusoap_lib");
        $this->load->library("sendcurl_lib");
        $this->load->library("table");
        $this->load->library('commonlib');
        $this->load->library('ciqrcode');
        $this->load->helper('MY_language_helper');
        $this->load->library('MX_Encryption');
        $this->load->library('xml2array');

        $this->load->library('breadcrumbs');
        require_once(APPPATH.'libraries/mime_type_lib.php');
        require_once(APPPATH.'libraries/htmLawed.php');
    }

    public function common_loader($data,$views) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('templates/menu_side', $data);
        $this->load->view('templates/top-1-breadcrumb', $data);
        $this->load->view('templates/top-2-title-nosearch', $data);
        $this->load->view($views, $data);
        $this->load->view('templates/footer', $data);
    }

    public function redirect(){
      if (!$this->session->userdata('uname_phd')){
        redirect(ROOT.'main', 'refresh');
      }
    }

    public function index()
    {
        $this->redirect();
        $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
        $data['title']= "TRUCK REGISTRATION";

        $this->common_loader($data,'npkbilling/truck/main_truck');
    }

    public function getListTruck()
    {
      $data = $this->registrasi_truck_model->getListTruck();
      echo json_decode($data);
    }

    public function createTruck()
    {
        $this->redirect();
        $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
        $data['title']= "Form Truck Registration";
        $data['kendaraan'] = $this->registrasi_truck_model->getKendaraan();
        $this->common_loader($data,'npkbilling/truck/create_truck');
    }

    public function getUpdateregistrasi()
    {
        $truck_id = $this->input->get('vtruck');
        $data = $this->registrasi_truck_model->getUpdateregistrasi($truck_id);
        echo json_decode($data);
    }

    public function getTruckCompany()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $search = $this->security->xss_clean(htmlentities(strtoupper($_POST["search"])));
        $data = $this->registrasi_truck_model->getTruckCompany($search, $terminal);
        echo json_decode($data);
    }

    public function createRequstTruck()
    {
        $TRUCK_ID         = htmlspecialchars(cleanstring($this->input->post['TRUCK_ID']));
        $TRUCK_PLAT_NO    = htmlspecialchars(cleanstring($this->input->post['TRUCK_PLAT_NO']));
        $TRUCK_CUST_NAME  = htmlspecialchars(cleanstring($this->input->post['TRUCK_CUST_NAME']));
        $TRUCK_CUST_ID    = htmlspecialchars(cleanstring($this->input->post['TRUCK_CUST_ID']));
        $TRUCK_PLAT_EXP   = htmlspecialchars(cleanstring($this->input->post['TRUCK_PLAT_EXP']));
        $TRUCK_TYPE       = htmlspecialchars(cleanstring($this->input->post['TRUCK_TYPE']));
        $TRUCK_TYPE_NAME  = htmlspecialchars(cleanstring($this->input->post['TRUCK_TYPE_NAME']));
        $TRUCK_RFID       = htmlspecialchars(cleanstring($this->input->post['TRUCK_RFID']));
        $terminal         = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $APP_ID           = 2;

        $data = $this->registrasi_truck_model->createRequstTruck($TRUCK_ID, $TRUCK_PLAT_NO, $TRUCK_CUST_NAME, $TRUCK_CUST_ID, $TRUCK_PLAT_EXP, 
          $TRUCK_TYPE, $TRUCK_TYPE_NAME, $TRUCK_RFID, $terminal);
        echo json_decode($data);
    }

    public function updateRequestTruck()
    {
        $TRUCK_ID         = htmlspecialchars(cleanstring($this->input->post['TRUCK_ID']));
        $TRUCK_PLAT_NO    = htmlspecialchars(cleanstring($this->input->post['TRUCK_PLAT_NO']));
        $TRUCK_CUST_NAME  = htmlspecialchars(cleanstring($this->input->post['TRUCK_CUST_NAME']));
        $TRUCK_CUST_ID    = htmlspecialchars(cleanstring($this->input->post['TRUCK_CUST_ID']));
        $TRUCK_PLAT_EXP   = htmlspecialchars(cleanstring($this->input->post['TRUCK_PLAT_EXP']));
        $TRUCK_TYPE       = htmlspecialchars(cleanstring($this->input->post['TRUCK_TYPE']));
        $TRUCK_TYPE_NAME  = htmlspecialchars(cleanstring($this->input->post['TRUCK_TYPE_NAME']));
        $TRUCK_RFID       = htmlspecialchars(cleanstring($this->input->post['TRUCK_RFID']));
        $terminal         = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $APP_ID           = 2;

        $data = $this->registrasi_truck_model->updateRequestTruck($TRUCK_ID, $TRUCK_PLAT_NO, $TRUCK_CUST_NAME, $TRUCK_CUST_ID, $TRUCK_PLAT_EXP, 
          $TRUCK_TYPE, $TRUCK_TYPE_NAME, $TRUCK_RFID, $terminal);
        echo json_decode($data);
    }
}


