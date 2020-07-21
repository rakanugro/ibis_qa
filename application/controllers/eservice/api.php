<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library("Nusoap_lib");
		$this->load->library('MX_Encryption');
		// $this->nusoap_server = new soap_server();
		// $this->nusoap_server->configureWSDL('e-invoice','urn:einvoice_server');
    }

    function getdatacetak(){
        if ($this->input->server('REQUEST_METHOD') == 'GET'){
            $kode = $this->input->get('kode');
            if ($kode == 'billingedii'){
                $tipe = $this->input->get('tipe');
                $no = $this->input->get('no');
                $enc_trx_number = $this->mx_encryption->encrypt($no);
                if($tipe == 'uper'){
                    echo "http://eserviceqa.indonesiaport.co.id/index.php/einvoice/payment/cetak_uper/uper/".$enc_trx_number;
                }
                else if($tipe == 'nota'){
                    echo "http://eserviceqa.indonesiaport.co.id/index.php/einvoice/nota/cetak_barang/barang/".$enc_trx_number;
                    
                }
            }
        }else{
            echo "failed";
        }
    }

    function index(){
        echo "page not found"; die();
    }
    
}