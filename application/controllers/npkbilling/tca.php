<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tca extends CI_Controller {

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
        $this->load->model('npkbilling/trucks/tca_truck_model');
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
        $data['title']= "TCA NPK BILLING ";
        $this->common_loader($data,'npkbilling/truck/main_tca');
    }

    public function create_tca()
    {
        $this->redirect();
        $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
        $data['title'] = "TCA NPK BILLING";
        $data['terminal'] = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $data['layanan'] = $this->tca_truck_model->getListLayanan();

        $this->common_loader($data,'npkbilling/truck/create_tca');        
    }

    public function getListTca() {
        $data = $this->tca_truck_model->getListTca();
        echo json_decode($data);
    }

    public function getNoRequestRec()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $search = $this->security->xss_clean(htmlentities(strtoupper($_POST["search"])));
        $data = $this->tca_truck_model->getNoRequestRec($search, $terminal);
        echo json_decode($data);       
    }

    public function getNoBlRec()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->getNoBlRec($id, $terminal);
        echo json_decode($data);  
    }

    public function autocompletBlRec()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->autocompletBlRec($id, $terminal);
        echo json_decode($data); 
    }

    public function getNoRequestDel()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $search = $this->security->xss_clean(htmlentities(strtoupper($_POST["search"])));
        $data = $this->tca_truck_model->getNoRequestDel($search, $terminal);
        echo json_decode($data);
    }

    public function getNoBlDel()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd')); 
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->getNoBlDel($id, $terminal);
        echo json_decode($data);
    }

    public function autocompletBlDel()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd')); 
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->autocompletBlDel($id, $terminal);
        echo json_decode($data);
    }

    public function getNoRequestBm()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd')); 
        $search = $this->security->xss_clean(htmlentities(strtoupper($_POST["search"])));
        $data = $this->tca_truck_model->getNoRequestBm($search, $terminal);
        echo json_decode($data);
    }

    public function getNoBlBm()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd')); 
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->getNoBlBm($id, $terminal);
        echo json_decode($data);
    }
    
    public function autocompletBlBm()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd')); 
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->autocompletBlBm($id, $terminal);
        echo json_decode($data);
    }

    public function update_tca()
    {
        $data['tca_id'] = $this->input->get('vtcaid');
        $data['title']= "Update TCA ";
        $this->common_loader($data,'npkbilling/truck/update_tca');
    }

    public function view_tca()
    {
        $data['tca_id'] = $this->input->get('vtcaid');
        $data['title']= "View TCA ";
        $this->common_loader($data,'npkbilling/truck/view_tca');
    }

    public function getUpdateTca()
    {
        $id = $this->input->get('id');
        $data = $this->tca_truck_model->getUpdateTca($id);
        echo json_decode($data);

    }

    public function updateRequestTca()
    { 
        $json = $this->input->post('data');
        echo $data = $this->tca_truck_model->updateRequestTca($json);
    }    


    public function getTruckId()
    {
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd')); 
        $search = $this->input->post("search");
        $data = $this->tca_truck_model->getTruckId($search, $terminal);
        echo json_decode($data);
    }

    public function send($id){
        $data = $this->tca_truck_model->send($id);
        echo json_encode($data);
    }

    public function createRequestTca()
    { 
        $json = $this->input->post('data');
        echo $data = $this->tca_truck_model->createRequestTca($json);
    }
}

?>

