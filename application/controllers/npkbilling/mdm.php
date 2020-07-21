<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class mdm extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('npkbilling/master/mdm_model');
        $this->load->library("sendcurl_lib");
        $this->load->library('xml2array');
    }

    public function index(){
        echo 'test';
    }

    public function get_terminalList()
    {
        $data =  $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        echo json_encode($data);
    }
    
    public function terminal(){
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $data = $this->mdm_model->terminal($terminal);
        echo json_decode($data);
    }

    public function pbm(){
        $data = $this->mdm_model->pbm();
        echo json_decode($data);
    }

    public function tipeperdagangan(){
        $data = $this->mdm_model->tipeperdagangan();
        echo json_decode($data);
    }

    public function shippingagen(){
        $data = $this->mdm_model->shippingagen();
        echo json_decode($data);
    }

    public function tipekegiatan(){
        $data = $this->mdm_model->tipekegiatan();
        echo json_decode($data);
    }

    public function kemasan(){
        $data = $this->mdm_model->kemasan();
        echo json_decode($data);
    }

    public function barang($id){
        $data = $this->mdm_model->barang($id);
        echo json_decode($data);
    }

    public function stacking_id()
    {
        $data = $this->mdm_model->stacking_id();
        echo json_decode($data);
    }

    public function lapangan()
    {
        $data = $this->mdm_model->lapangan();
        echo json_decode($data);
    }

    public function gudang()
    {
        $data = $this->mdm_model->gudang();
        echo json_decode($data);
    }

    public function satuan(){
        $data = $this->mdm_model->satuan();
        echo json_decode($data);
    }

    public function vessel($params){
        $data = $this->mdm_model->vessel($params);
        echo json_decode($data);
    }

    public function auto_vessel($params){
        $data = $this->mdm_model->auto_vessel($params);
        echo json_decode($data);
    }

    public function alat(){
        $data = $this->mdm_model->alat();
        echo json_decode($data);
    }

    public function unit_alat(){
        $data = $this->mdm_model->unit_alat();
        echo json_decode($data);
    }

    public function size(){
        $data = $this->mdm_model->size();
        echo json_decode($data);
    }

    public function type(){
        $data = $this->mdm_model->type();
        echo json_decode($data);
    }

    public function status(){
        $data = $this->mdm_model->status();
        echo json_decode($data);
    }

    public function sifat_barang(){
        $data = $this->mdm_model->sifat_barang();
        echo json_decode($data);
    }

    public function customer($params){
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $data = $this->mdm_model->customer($params, $terminal);
        echo json_decode($data);
    }

    public function cek_session(){
        print_r($this->session);
        var_dump($this->session->userdata('customerid_phd'));
        echo $this->session_userdata;
    }

    public function layanan_alat(){
        $terminal = $this->mdm_model->get_terminalList($this->session->userdata('sub_group_phd'));
        $data = $this->mdm_model->layanan_alat($terminal);
        echo json_decode($data);
    }





}
	