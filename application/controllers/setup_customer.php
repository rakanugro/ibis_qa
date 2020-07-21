<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Setup_customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->helper('form'); 
		$this->load->library('form_validation'); 
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('breadcrumbs');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);				
		
		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) 
			redirect(ROOT.'mainpage', 'refresh');
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

	public function index(){
	
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		
		//create table
		$this->table->set_heading('No', 'Customer ID', 'Customer Name', 'Email', 'Phone', 'Service', 'Action');

		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id></customer_id>
				<customer_name></customer_name>
			</data>
		</root>";

		if(!$this->nusoap_lib->call_wsdl(CUSTOMER,"getCustomer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$result;
			$obj = json_decode($result);
			
			if($obj->data->customer)
			{						
				for($i=0;$i<count($obj->data->customer);$i++)
				{
					$this->table->add_row(
						$i+1,
						htmlspecialchars($obj->data->customer[$i]->customer_id),
						htmlspecialchars($obj->data->customer[$i]->customer_name),
						htmlspecialchars($obj->data->customer[$i]->email),
						htmlspecialchars($obj->data->customer[$i]->phone),
						htmlspecialchars($obj->data->customer[$i]->service),
						'<a href="'.ROOT.'setup_customer/edit?cid='.$obj->data->customer[$i]->customer_id.'" class="table-link">
							<span class="fa-stack">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
							</span>
						</a>'
						);

				}
			}				
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Setup', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Customer List';

		$this->common_loader($data,'pages/customer/setup_customer');
	}
	
	public function edit(){

		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$customer_id = isset($_GET['cid']) ? $_GET['cid'] : '' ;
		$customer_name = isset($_GET['customer_name']) ? $_GET['customer_name'] : '' ;
		
		$in_data="<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<customer_id>$customer_id</customer_id>
				<customer_name>$customer_name</customer_name>
			</data>
		</root>";
		
		if(!$this->nusoap_lib->call_wsdl(CUSTOMER,"getCustomerDetail",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//echo "<br>----response---<br>";
			//echo $result;
			
			//contoh decode data
			//echo "<br>----decode-----";
			$obj = json_decode($result);
			//echo "<br>";
			//echo $obj->sc_type;echo "<br>";
			//echo $obj->sc_code;echo "<br>";
			//echo $obj->rc;echo "<br>";
			//echo $obj->rcmsg;echo "<br>";
			
			if($obj->data->customer)
			{
				for($i=0;$i<count($obj->data->customer);$i++)
				{
					$data['customer_id']=$obj->data->customer[$i]->customer_id;
					$data['customer_name']=$obj->data->customer[$i]->customer_name;
					$data['address']=$obj->data->customer[$i]->address;
					$data['address']=$obj->data->customer[$i]->address;
					$data['npwp']=$obj->data->customer[$i]->npwp;
					$data['email']=$obj->data->customer[$i]->email;
					$data['phone']=$obj->data->customer[$i]->phone;
					
					foreach ($obj->data->customer[$i]->service as $value){
						$data[$value->service]="checked";
					}
					
				}
			}				
		}
			
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		
		$this->breadcrumbs->push('Setup', '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		$data['title']= 'Customer List';

		$this->common_loader($data,'pages/customer/setup_customer_edit');
	}
	
	public function update(){
	
			if (!$this->session->userdata('uname_phd'))
			{
				redirect(ROOT.'main', 'refresh');
			}
	
			if(isset($_POST['submit_form']))
			{						
				$client = new nusoap_client(CUSTOMER);

				$error = $client->getError();
				if ($error) {echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";return;}
				
				$customer_id=isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
				$sms00=isset($_POST['sms00']) ? $_POST['sms00'] : '';
				$eml00=isset($_POST['eml00']) ? $_POST['eml00'] : '';
				$vsl00=isset($_POST['vsl00']) ? $_POST['vsl00'] : '';
				$ctn00=isset($_POST['ctn00']) ? $_POST['ctn00'] : '';
				$brg00=isset($_POST['brg00']) ? $_POST['brg00'] : '';
				
				$setup="";
				
				if($sms00=="true")
				{
					if($setup!="") $setup .=",";
					$setup .= "SMS00";
				}

				if($eml00=="true")
				{
					if($setup!="") $setup .=",";
					$setup .= "EML00";
				}
				
				if($vsl00=="true")
				{
					if($setup!="") $setup .=",";
					$setup .= "VSL00";
				}

				if($ctn00=="true")
				{
					if($setup!="") $setup .=",";
					$setup .= "CTN00";
				}

				if($brg00=="true")
				{
					if($setup!="") $setup .=",";
					$setup .= "BRG00";
				}
				
				//no error
				$modul="updateCustomer";
				$in_data="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<customer_id>$customer_id</customer_id>
						<setup>$setup</setup>
					</data>
				</root>";
				
				if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT,"autoContainerBatalmuat",array("in_data" => "$in_data"),$result))
				{
					echo $result;
					die;
				}
				else
				{
					echo $result;
					
					$obj = json_decode($result);					
				}
			}
	}	
}