<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stuffingext extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('npksbilling/request/stuffingext_model');
        $this->load->model('npksbilling/master/mdm_model');
        $this->load->library("esb_npks");
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
        $data['title']= "Extension Stuffing";
        $this->common_loader($data,'npksbilling/request/main_stuffingext');
    }

    public function create_stuffingext()
    {
        $this->redirect();
        $data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
        $data['title'] = "Extension Stuffing";
        $data['docType'] = $this->mdm_model->getDocType();

        $this->common_loader($data,'npksbilling/request/create_stuffingext');        
    }  

    public function getList()
    {
        $data = $this->stuffingext_model->getList();
        echo $data;
    }

    public function get_nomor_request()
    {
        $input  = strtoupper($this->input->get('search'));
        $data   = $this->stuffingext_model->get_nomor_request($input);

        echo json_decode($data);
    }

    public function auto_generate_by_noreq()
    {
        $search = $this->input->get('search');
        $data   = $this->stuffingext_model->auto_generate_by_noreq($search);

        echo json_encode($data);
    }

    public function save_extension() {
        $jsonData = $this->input->post('data');
        echo $jsonData = $this->stuffingext_model->save_extension($jsonData);
    }

    public function getUpdateList($extension_id)
    {
        $data['title']              = "Edit Extension Stuffing";
        $data['extension_id']       = $extension_id;
        $data['docType'] = $this->mdm_model->getDocType();

        $this->common_loader($data,'npksbilling/request/edit_stuffingext');
    }

    public function view($extension_id)
    {
        $data['extension_id'] = $extension_id;
        $data['docType'] = $this->mdm_model->getDocType();
        $this->common_loader($data,'npksbilling/request/view_stuffingext');   
    }

    public function getDataReq()
    {
        $extension_id = $_GET['extension_id'];
        $data = $this->stuffingext_model->get_extension_views($extension_id);
        echo json_decode($data);
    }

    public function send($id){
        $data = $this->stuffingext_model->send($id);
        echo json_encode($data);
    }
}

?>

