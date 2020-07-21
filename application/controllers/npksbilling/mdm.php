<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class mdm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('npksbilling/master/mdm_model');
        $this->load->library("sendcurl_lib");
        $this->load->library('xml2array');
        $this->load->library('esb_npks');
    }

    public function get_terminalList()
    {
        $data =  $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        echo json_encode($data);
    }

    public function pbm()
    {
        $params = $this->input->get('request');
        $branch_id = $this->input->get('branch_id');
        $data = $this->mdm_model->pbm($params, $branch_id);
        echo json_decode($data);
    }

    public function stackby()
    {
        $params = $this->input->get('request');
        $branch_id = $this->input->get('branch_id');
        $data = $this->mdm_model->stackby($params, $branch_id);
        echo json_decode($data);
    }

    public function from()
    {
        $data = $this->mdm_model->from();
        echo json_decode($data);
    }

    public function paymethod()
    {
        $data = $this->mdm_model->paymethod();
        echo json_decode($data);
    }

    public function paymethod_fumi()
    {
        $data = $this->mdm_model->paymethod_fumi();
        echo json_decode($data);
    }

    public function vessel()
    {
        $params = $this->input->get('vessel');
        $data = $this->mdm_model->vessel($params);
        echo json_decode($data);
    }

    public function type_document()
    {
        $data = $this->mdm_model->type_document();
        echo json_decode($data);
    }

    public function customer()
    {
        $params = $this->input->get('request');
        $branch_id = $this->input->get('branch_id');
        $data = $this->mdm_model->customer($params, $branch_id);
        echo json_decode($data);
    }

    public function size()
    {
        $data = $this->mdm_model->size();
        echo json_decode($data);
    }

    public function type()
    {
        $data = $this->mdm_model->type();
        echo json_decode($data);
    }

    public function status()
    {
        $data = $this->mdm_model->status();
        echo json_decode($data);
    }

    public function sifat()
    {
        $data = $this->mdm_model->sifat();
        echo json_decode($data);
    }

    public function barang()
    {
        $data = $this->mdm_model->barang();
        echo json_decode($data);
    }

    public function via()
    {
        $data = $this->mdm_model->via();
        echo json_decode($data);
    }

    public function sifat_cargo()
    {
        $data = $this->mdm_model->sifat_cargo();
        echo json_decode($data);
    }

    public function kemasan_cargo()
    {
        $data = $this->mdm_model->kemasan_cargo();
        echo json_decode($data);
    }

    public function barang_cargo($id)
    {
        $data = $this->mdm_model->barang_cargo($id);
        echo json_decode($data);
    }

    public function satuan_cargo()
    {
        $data = $this->mdm_model->satuan_cargo();
        echo json_decode($data);
    }

    public function via_cargo()
    {
        $data = $this->mdm_model->via_cargo();
        echo json_decode($data);
    }

    public function to()
    {
        $data = $this->mdm_model->to();
        echo json_decode($data);
    }

    public function no_container()
    {
        $params = $this->security->xss_clean(htmlentities(strtoupper($_GET["request"])));
        $branch_id = $this->input->get('branch_id');
        $data = $this->mdm_model->no_container($params, $branch_id);
        echo json_decode($data);
    }

    public function no_cont_rec()
    {
        $params = $this->security->xss_clean(htmlentities(strtoupper($_GET["request"])));
        $branch_id = $this->input->get('branch_id');
        $data = $this->mdm_model->no_cont_rec($params, $branch_id);
        echo json_decode($data);
    }

    public function type_fumigasi()
    {
        $data = $this->mdm_model->type_fumigasi();
        echo json_decode($data);
    }

    public function no_tl()
    {
        $data = $this->mdm_model->no_tl();
        echo json_decode($data);
    }

    public function to_cargo()
    {
        $data = $this->mdm_model->to_cargo();
        echo json_decode($data);
    }

    public function stacking()
    {
        $data = $this->mdm_model->stacking();
        echo json_decode($data);
    }

    //to container
    public function del_to()
    {
        $data = $this->mdm_model->del_to();
        echo json_decode($data);
    }

    //from cargo
    public function from_cargo()
    {
        $data = $this->mdm_model->from_cargo();
        echo json_decode($data);
    }

    //barang tamp
    public function barang_tamp($id)
    {
        $data = $this->mdm_model->barang_tamp($id);
        echo json_decode($data);
    }

    //ExBatalSP2
    public function exbatalsp2()
    {
        $data = $this->mdm_model->exbatalsp2();
        echo json_decode($data);
    }

    public function no_si()
    {
        $params = $this->security->xss_clean(htmlentities(strtoupper($_GET["request"])));
        $branch_id = $this->input->get('branch_id');
        $data = $this->mdm_model->no_si($params, $branch_id);
        echo json_decode($data);
    }

    //cek container
    public function cek_container($params)
    {
        $data = $this->mdm_model->cek_container($params);
        echo json_decode($data);
    }

    public function cek_container_rec($params)
    {
        $data = $this->mdm_model->cek_container_rec($params);
        echo json_decode($data);
    }
}
