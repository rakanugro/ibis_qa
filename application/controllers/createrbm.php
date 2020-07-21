<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class createrbm extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		
         require_once(APPPATH.'libraries/htmLawed.php');

        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		/*if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {

			redirect(ROOT.'mainpage', 'refresh');
		}*/
	}

	public function common_loader($data,$views){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index(){}

	public function main_billing(){
		$this->breadcrumbs->push("Create New RBM Request", 'rmb/rbm');
		$this->breadcrumbs->unshift('Home','Realisasi Bongkar Muat', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Create Realisasi Bongkar Muat";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');
		$this->common_loader($data,'pages/container/createrbm');
	}
	public function auto_customer_rbm(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$term			= $this->security->xss_clean(htmlentities(strtoupper($_GET["term"])));

		injek($term);

		$port			= explode("-",$this->security->xss_clean(htmlentities($_GET["port"])));
		$stack = array();

		//no error
		// port code : IDJKT, IDPNK //bisa diisi kosong untuk ambil semua port
		// terminal code :  T3I,T3D,T2D,T1D,L2D,L2I //bisa diisi kosong untuk ambil semua terminal
		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<company_name>$term</company_name>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(REQUEST_BONGKAR_MUAT,"getListCustomer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// print_r($result);
			// die();
			$obj = json_decode($result);

			//echo $this->db->last_query();
			if($obj->data->vessel)
			{
				for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$temp;
					$temp['ALAMAT_PERUSAHAAN']=$obj->data->vessel[$i]->alamat_perusahaan;
					$temp['KD_PELANGGAN']=$obj->data->vessel[$i]->kd_pelanggan;
					$temp['NAMA_PERUSAHAAN']=$obj->data->vessel[$i]->nama_perusahaan;
					$temp['NO_NPWP']=$obj->data->vessel[$i]->no_npwp;
					array_push($stack, $temp);
				}
			}
		}

		$data['vessel'] = $stack;
			$this->load->library("table");
			$this->table->set_heading(
					'Nama Perusahaan',
					'Kode Pelanggan',
					'NO NPWP',
					'Pilih'
				);

			$i=0;
			foreach ($stack as $t){
				$this->table->add_row(
					$t['NAMA_PERUSAHAAN'],
					$t['KD_PELANGGAN'],
					$t['NO_NPWP'],
					 '<a data-dismiss="modal" style="cursor:pointer" class="table-link click_detail bank_detail" onclick="completeCustomer(\''.$t['KD_PELANGGAN'].'\',\''.$t['NAMA_PERUSAHAAN'].'\',\''.$t['NO_NPWP'].'\',\''.$t['ALAMAT_PERUSAHAAN'].'\')"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				);
					$i++;
			}

			$this->load->view('pages/container/search_list_customer',$data);
	}

}
	