 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_Fe extends CI_Controller {

	public function __construct()
	{	

		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('MX_Encryption');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');
	}

	public function index(){
		print_r("expression");
		die();
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


	public function add_by_proforma(){
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Add By Proforma", '/');
		$this->breadcrumbs->unshift('Transaction', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Add Transaction";
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Trx Date</th>",
			"<th width='100px'>Proforma</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>Service</th>",
			"<th width='100px'>Cabang</th>",
			"<th width='100px'>Amount</th>",
			"<th width='50px'>Action</th>"
		);

		print_r($data);
		die();
		$this->common_loader($data,'pages/va/add_proforma');

		
	}

	public function search_by_proforma(){
		$search_input = trim($_POST['search_input']);
		$layanan = trim($_POST['layanan']);



		$datas = array(
			"id" => '1',
			"txt_date" 	=> '29-Mar-19',
			"proforma" 	=> '9589299282822888888881',
			"customer" 	=> 'GLOBAL SARANA KENCANA',
			"service"  	=> 'PETIKEMAS',
			"cabang"   	=> 'Panjang',
			"amount"   	=>	1200000,
			"paycode"   =>	'paycode'
		);

		echo json_encode($datas);		
	}
	public function add_by_customer(){
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Add By Proforma", '/');
		$this->breadcrumbs->unshift('Transaction', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Add Transaction";
		$this->table->set_heading(
			"<th width='30px'>#</th>",
			"<th width='30px'>No</th>",
			"<th width='100px'>Trx Date</th>",
			"<th width='100px'>Proforma</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>Service</th>",
			"<th width='100px'>Cabang</th>",
			"<th width='100px'>Amount</th>",
			"<th width='50px'>Action</th>"
		);
		$this->common_loader($data,'pages/va/add_by_customer');
	}
	public function search_by_customer(){

				$req_id = trim($_POST['search']);
				$this->table->set_heading(
					"<th>#</th>",
					"<th >No</th>",
					"<th >Trx Date</th>",
					"<th>Proforma</th>",
					"<th >Customer</th>",
					"<th>Service</th>",
					"<th>Cabang</th>",
					"<th>Amount</th>",
					"<th>Action</th>"
				);

				$start_rownum="";
				$end_rownum="";

				$i = 1;
				$data = array();

				$datas = array(
					"id" => '1',
					"txt_date" 	=> '29-Mar-19',
					"proforma" 	=> '9589299282822888888881',
					"customer" 	=> 'GLOBAL SARANA KENCANA',
					"service"  	=> 'PETIKEMAS',
					"cabang"   	=> 'Panjang',
					"amount"   	=>	1200000,
					"paycode"   =>	'paycode'
				);

				array_push($data, $datas);


				foreach ($data as $key => $value) {

					$this->table->add_row(
											'<input type="checkbox" name="id[]" value="'.$value["id"].'">',
											$i,
											$value["trx_date"],
											$value["proforma"],
											$value["customer"],
											$value["service"],
											$value["cabang"],
											$value["amount"],
											$value["paycode"]
					);

					$i++;
				}
				
				
				$this->load->view('pages/va/search_by_customer',$data);
	}

	function rupiah($angka){
		
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	 
	}

	public function submit_payment(){
		print_r($_POST);
		// die();

		$payment_code = 'a';

		redirect(ROOT.'va/transaction/detail_payment_code/'.$payment_code);
	}

	public function detail_payment_code(){

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Add By Proforma", '/');
		$this->breadcrumbs->unshift('Transaction', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Add Transaction";
		
		$datanya = array();
		$datas = array(
			"id" => '1',
			"txt_date" 	=> '29-Mar-19',
			"proforma" 	=> '9589299282822888888881',
			"customer" 	=> 'GLOBAL SARANA KENCANA',
			"service"  	=> 'PETIKEMAS',
			"cabang"   	=> 'Panjang',
			"amount"   	=>	1200000,
			"paycode"   =>	'paycode'
		);

		array_push($datanya, $datas);
		$data["payment_detail"] = $datanya;

		$this->common_loader($data,'pages/va/detail_payment_code');

	}

	public function list_transaction(){
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("List Transaction", '/');
		$this->breadcrumbs->unshift('Transaction', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "List Transaction";
		$this->table->set_heading(
			"<th width='100px'>Trx Date</th>",
			"<th width='100px'>Payment Code</th>",
			"<th width='100px'>Expired Date</th>",
			"<th width='100px'>Bank</th>",
			"<th width='100px'>Status Payment Gate</th>",
			"<th width='100px'>Status Bank</th>",
			"<th width='50px'>Status Merchant</th>",
			"<th width='50px'>Action</th>"
		);
		$this->common_loader($data,'pages/va/list_transaction');
	}

	public function search_transaction(){

				$req_id = trim($_POST['search']);
				$this->table->set_heading(
					"<th>Trx Date</th>",
					"<th>Payment Code</th>",
					"<th>Expired Date</th>",
					"<th>Bank</th>",
					"<th>Status Payment Gate</th>",
					"<th>Status Bank</th>",
					"<th>Status Merchant</th>",
					"<th>Action</th>"
				);

				$start_rownum="";
				$end_rownum="";

				$i = 1;
				$data = array();

				$datas = array(
					"id" => '1',
					"trx_date" 			=> '29-Mar-19',
					"paycode"   		=>	'paycode',
					"expired_date"  	=>	'30-Mar-19',
					"bank"   			=>	'Mandiri',
					"status_gate"   	=>	'Success',
					"status_bank"   	=>	'Success',
					"status_merchant"   =>	'Success'
				);

				array_push($data, $datas);


				foreach ($data as $key => $value) {

					$btn = '';
					$btn .= '<a class="btn btn-default" href="'.ROOT.'va/transaction/detail_transaction/1111"><i class="fa fa-eye"></i></a>';					
					$btn .= '<a class="btn btn-default" href="'.ROOT.'va/transaction/edit_transaction/1111"><i class="fa fa-edit"></i></a>';
					$btn .= '<a class="btn btn-default" href="'.ROOT.'va/transaction/print_transaction/1111"><i class="fa fa-print"></i></a>';
					$this->table->add_row(
											$value["trx_date"],
											$value["paycode"],
											$value["expired_date"],
											$value["bank"],
											$value["status_gate"],
											$value["status_bank"],
											$value["status_merchant"],
											$btn
					);

					$i++;
				}
				
				
				$this->load->view('pages/va/search_list_transaction',$data);
	}
	public function force_flagging(){
		print_r("expression");
		die();
	}

	public function detail_transaction(){
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Detail Transaction", '/');
		$this->breadcrumbs->unshift('Transaction', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Detail Transaction";
		
		$datanya = array();
		$datas = array(
			"id" => '1',
			"txt_date" 	=> '29-Mar-19',
			"proforma" 	=> '9589299282822888888881',
			"customer" 	=> 'GLOBAL SARANA KENCANA',
			"service"  	=> 'PETIKEMAS',
			"cabang"   	=> 'Panjang',
			"amount"   	=>	1200000,
			"paycode"   =>	'paycode'
		);

		array_push($datanya, $datas);
		$data["payment_detail"] = $datanya;

		$this->common_loader($data,'pages/va/detail_transaction');

	}
	public function edit_transaction(){
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Edit Transaction", '/');
		$this->breadcrumbs->unshift('Transaction', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Edit Transaction";
		$this->table->set_heading(
			"<th width='100px'>Trx Date</th>",
			"<th width='100px'>Proforma</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>Service</th>",
			"<th width='100px'>Cabang</th>",
			"<th width='100px'>Amount</th>",
			"<th width='50px'>Action</th>"
		);
		$this->common_loader($data,'pages/va/edit_transaction');
	}
	public function search_edit_transaction(){

				$req_id = trim($_POST['search']);
				$this->table->set_heading(
					"<th>Trx Date</th>",
					"<th>Proforma</th>",
					"<th>Customer</th>",
					"<th>Service</th>",
					"<th>Cabang</th>",
					"<th>Amount</th>",
					"<th>Action</th>"
				);

				$start_rownum="";
				$end_rownum="";

				$i = 1;
				$data = array();

				$datas = array(
					"id" => '1',
					"trx_date" 	=> '29-Mar-19',
					"proforma"  =>	'proforma',
					"customer"  =>	'30-Mar-19',
					"service"   =>	'Mandiri',
					"cabang"   	=>	'Success',
					"amount"   	=>	'Success'
				);

				array_push($data, $datas);


				foreach ($data as $key => $value) {

					$btn = '';
					$btn .= '<a class="btn btn-default" href="'.ROOT.'va/transaction/delete_transaction/1111">delete</a>';				
					$this->table->add_row(
											$value["trx_date"],
											$value["proforma"],
											$value["customer"],
											$value["service"],
											$value["cabang"],
											$value["amount"],
											$btn
					);

					$i++;
				}
				
				
				$this->load->view('pages/va/search_edit_transaction',$data);
	}
	public function print_transaction(){
		print_r("expression");
		die();
	}

	
}
