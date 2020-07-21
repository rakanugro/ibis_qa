<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Booking extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('om/booking_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');

		$this->load->library('breadcrumbs');
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		//if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
			redirect(ROOT.'mainpage', 'refresh');
	}

	public function common_loader($data,$views) {
		$this->load->view('templates/om/header', $data);
		$this->load->view('templates/om/top_bar', $data);
		$this->load->view('templates/om/menu_side', $data);
		$this->load->view('templates/om/top-1-breadcrumb', $data);
		$this->load->view('templates/om/top-2-title-nosearch', $data);
		if (is_array($views) ){foreach($views as $view)$this->load->view($view, $data);}else{$this->load->view($views, $data);}
		$this->load->view('templates/om/footer', $data);
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

		$this->breadcrumbs->push("Booking List", 'om/request');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Booking List";

		$this->common_loader($data,'pages/om/request');
	}

	public function search_table($search="")
	{
		$customer_id=$this->session->userdata('customerid_phd');
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th>No</th>",
			"<th>No Request</th>",
			"<th>Tgl Request</th>",
			"<th>Pengguna Jasa</th>",
			"<th>Vessel / Voyage</th>",
			"<th>Port / Terminal</th>",
			"<th>Jenis Layanan</th>",
			"<th>Status Req</th>",
			"<th>Aksi</th>"
		);

		$result = $this->user_model->get_idPCH($this->session->userdata('sub_group_phd'));
		$id_port =  implode("', '", array_map(function ($result) {
					  return $result['ID_PORT'];
					}, $result));
		$id_company =  implode("', '", array_map(function ($result) {
					  return $result['ID_COMPANY'];
					}, $result));
		$id_holding =  implode("', '", array_map(function ($result) {
					  return $result['ID_HOLDING'];
					}, $result));

		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<search>$search</search>
							<upper_bound>$upper_bound</upper_bound>
							<lower_bound>$lower_bound</lower_bound>
							<customer_id>$customer_id</customer_id>
						</data>
					</root>";
					
		// echo ORDER_MGT;die;
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getBookingList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//print_r($result);die();
			$obj = json_decode($result);

			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
					if($obj->data->listreq[$i]->ket_status_req=='NEW'){
						$print = '<a class="btn btn-primary" href="'.ROOT.'om/booking/edit_booking/'.$obj->data->listreq[$i]->id_reqcargo.'" target="_blank"><i class="fa fa-pencil"></i></a>';
					}
					else
					{
						$print ='Not Available';
					}
					
					$this->table->add_row(
						$i+1,
						$obj->data->listreq[$i]->id_reqcargo,
						$obj->data->listreq[$i]->req_date,
						$obj->data->listreq[$i]->cust_name,
						$obj->data->listreq[$i]->vessel ."<br/>".$obj->data->listreq[$i]->voy_in." - ".$obj->data->listreq[$i]->voy_out,
						$obj->data->listreq[$i]->id_port,
						$obj->data->listreq[$i]->servicetype_name,
						$obj->data->listreq[$i]->ket_status_req,
						$print
					);
				}
			}
		}

		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<search>$search</search>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<customer_id>$customer_id</customer_id>
						</data>
					</root>";

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getTotalBookingList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//call success
			//echo $result;die;
			$obj = json_decode($result);

			// print_r($obj);

			if($obj->data->listreq)
			{
				$jml = $obj->data->listreq->jml;
			}
		}

		$totallist=$jml;
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		$this->load->view('pages/om/request_grid',$data);
	}
	
	public function edit_booking($id_request)
	{
		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$result = $this->user_model->get_idPCH($this->session->userdata('sub_group_phd'));
		$id_port =  implode(', ', array_map(function ($result) {
					  return $result['ID_PORT'];
					}, $result));
		$id_company =  implode(', ', array_map(function ($result) {
					  return $result['ID_COMPANY'];
					}, $result));
		$id_holding =  implode(', ', array_map(function ($result) {
					  return $result['ID_HOLDING'];
					}, $result));
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
						</data>
					</root>";
		
		$stack = array();
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getServiceType",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
							$temp;
							$temp['ID_SERVICETYPE']=$obj->data->listreq[$i]->ID_SERVICETYPE;
							$temp['SERVICETYPE_NAME']=$obj->data->listreq[$i]->SERVICETYPE_NAME;
							array_push($stack, $temp);
				}
			}
		}
		/*data header detail*/
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
							<id_request>$id_request</id_request>
						</data>
					</root>";
		
		$stack2 = array();
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getDataBooking",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			//print_r($result);die;
			$obj = json_decode($result);
			if($obj->data->data_head)
			{
				for($i=0;$i<count($obj->data->data_head);$i++)
				{
					$kd_Cab=$this->master_model->getSimkeuKodeCabang($obj->data->data_head[$i]->ID_PORT);
					$hdata['ID_REQ']=$obj->data->data_head[$i]->ID_REQ;
					$hdata['ID_PORT']=$kd_Cab['KODE_CABANG_SIMKEU'].'-'.$obj->data->data_head[$i]->ID_PORT;
					$hdata['ID_CUST']=$obj->data->data_head[$i]->ID_CUST;
					$hdata['CUST_NAME']=$obj->data->data_head[$i]->CUST_NAME;
					$hdata['CUST_ADDR']=$obj->data->data_head[$i]->CUST_ADDR;
					$hdata['CUST_NPWP']=$obj->data->data_head[$i]->CUST_NPWP;
					$hdata['DO_DATE']=$obj->data->data_head[$i]->DO_DATE;
					$hdata['DO_NUMBER']=$obj->data->data_head[$i]->DO_NUMBER;
					$hdata['ID_VVD']=$obj->data->data_head[$i]->ID_VVD;
					$hdata['VESSEL']=$obj->data->data_head[$i]->VESSEL;
					$hdata['VOY_IN']=$obj->data->data_head[$i]->VOY_IN;
					$hdata['VOY_OUT']=$obj->data->data_head[$i]->VOY_OUT;
					$hdata['ID_SERVICETYPE']=$obj->data->data_head[$i]->ID_SERVICETYPE;
					$hdata['POD']=$obj->data->data_head[$i]->POD;
					$hdata['POL']=$obj->data->data_head[$i]->POL;
					$hdata['POR']=$obj->data->data_head[$i]->POR;
					$hdata['STACKIN_DATE']=$obj->data->data_head[$i]->STACKIN_DATE;
					$hdata['STACKOUT_DATE']=$obj->data->data_head[$i]->STACKOUT_DATE;
					$hdata['SPPB_OR_PE']=$obj->data->data_head[$i]->SPPB_OR_PE;
					$hdata['SPPB_OR_PE_DATE']=$obj->data->data_head[$i]->SPPB_OR_PE_DATE;
					$hdata['ETA']=$obj->data->data_head[$i]->ETA;
					$hdata['ETD']=$obj->data->data_head[$i]->ETD;
					$hdata['CLOSE']=$obj->data->data_head[$i]->CLOSE;
					$hdata['CLOSED']=$obj->data->data_head[$i]->CLOSED;
					$hdata['OPEND']=$obj->data->data_head[$i]->OPEND;
				}
			}
			
			if($obj->data->data_detail)
			{
				for($i=0;$i<count($obj->data->data_detail);$i++)
				{
					$temp;
					$temp['ID_CARGO']=$obj->data->data_detail[$i]->ID_CARGO;
					$temp['CARGO_NAME']=$obj->data->data_detail[$i]->CARGO_NAME;
					$temp['HS_CODE']=$obj->data->data_detail[$i]->HS_CODE;
					$temp['ID_PKG']=$obj->data->data_detail[$i]->ID_PKG;
					$temp['QTY']=$obj->data->data_detail[$i]->QTY;
					$temp['HZ']=$obj->data->data_detail[$i]->HZ;
					$temp['DS']=$obj->data->data_detail[$i]->DS;
					$temp['BL_NUMBER']=$obj->data->data_detail[$i]->BL_NUMBER;
					$temp['BL_DATE']=$obj->data->data_detail[$i]->BL_DATE;
					$temp['STACKIN_DATE']=$obj->data->data_detail[$i]->STACKIN_DATE;
					$temp['STACKOUT_DATE']=$obj->data->data_detail[$i]->STACKOUT_DATE;
					$temp['E_I']=$obj->data->data_detail[$i]->E_I;
					$temp['TL_FLAG']=$obj->data->data_detail[$i]->TL_FLAG;
					$temp['TON']=$obj->data->data_detail[$i]->TON;
					$temp['CUBIC']=$obj->data->data_detail[$i]->CUBIC;
					$temp['WHOUSE_ID']=$obj->data->data_detail[$i]->WHOUSE_ID;
					$temp['OI']=$obj->data->data_detail[$i]->OI;
					
					array_push($stack2, $temp);
				}
			}
		}
		
		/*data header detail*/
		
		$this->breadcrumbs->push("Booking List", 'om/booking');
		$this->breadcrumbs->push("Request Service", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['svclist'] =$stack;
		$data['data_headreq']=$hdata;
		$data['data_detail']=$stack2;
		
		//print_r($data['data_detail']);die;
		$data['title']= "Create Booking Service";
		$data['edit']= "Y";
		//print_r('test');die;
		$this->common_loader($data,'pages/om/request_header');
	}
	
	public function create_request_cargo()
	{
		$data['terminal'] = $this->user_model->get_terminalListCargo($this->session->userdata('sub_group_phd'));
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['max_size'] = $this->commonlib->file_upload_max_size_mb();
		
		$customer_name=$this->session->userdata('customername_phd');
		
		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$result = $this->user_model->get_idPCH($this->session->userdata('sub_group_phd'));
		$id_port =  implode(', ', array_map(function ($result) {
					  return $result['ID_PORT'];
					}, $result));
		$id_company =  implode(', ', array_map(function ($result) {
					  return $result['ID_COMPANY'];
					}, $result));
		$id_holding =  implode(', ', array_map(function ($result) {
					  return $result['ID_HOLDING'];
					}, $result));
		$in_data = "<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<id_port>$id_port</id_port>
							<id_company>$id_company</id_company>
							<id_holding>$id_holding</id_holding>
						</data>
					</root>";
		$stack = array();
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getServiceType",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			if($obj->data->listreq)
			{
				for($i=0;$i<count($obj->data->listreq);$i++)
				{
							$temp;
							$temp['ID_SERVICETYPE']=$obj->data->listreq[$i]->ID_SERVICETYPE;
							$temp['SERVICETYPE_NAME']=$obj->data->listreq[$i]->SERVICETYPE_NAME;
							array_push($stack, $temp);
				}
			}
		}
		$this->breadcrumbs->push("Booking List", 'om/booking');
		$this->breadcrumbs->push("Request Service", '/');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['svclist'] =$stack;
		$data['title']= "Create Booking Service";
		$data['edit']= "N";
		//print_r('test');die;
		$this->common_loader($data,'pages/om/request_header');
	}

	public function load_detail_req($SVC_TYPE,$UKK)
	{
		if($SVC_TYPE=='01')
		{
			$data['svc_type']=$SVC_TYPE;
			$data['ukk']=$UKK;
			$this->load->view('pages/om/request_cargo_rc',$data);
		}
		else if($SVC_TYPE=='02')
		{
			$data['svc_type']=$SVC_TYPE;
			$data['ukk']=$UKK;
			$this->load->view('pages/om/request_cargo_dl',$data);
		}
		else if(($SVC_TYPE=='00'))
		{
			$data['svc_type']=$SVC_TYPE;
			$data['ukk']=$UKK;
			$this->load->view('pages/om/request_cargo_dcld',$data);
		}
	}
	
	public function auto_whoryd(){
        $port=explode("-",htmLawed($_POST["port"]));
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		//print_r($in_data);die;

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getWhOrYd",array("in_data" => "$in_data"),$result))
		{

			echo $result;
			die;
		}
		else
		{
			//print_r($result);die;
			$obj = json_decode($result);
			//log_message('error','>>>>>>>>>> auto POD: '.$result);
			$stack1	= array();
			if($obj->data->whouse){
			  for($i=0;$i<count($obj->data->whouse);$i++)
				{
					$temp;
					$temp['W_NAME']=$obj->data->whouse[$i]->whouse_name;
					$temp['W_ID']=$obj->data->whouse[$i]->whouse_id;
					array_push($stack1, $temp);
				}
			}
		}
        //echo json_encode($stack1);
				$cbpod 	= "<select name='wh_id' id='wh_id' class='form-control'>";
				$cbpod  .= "<option value=''>---Pilih---</option>";
				foreach ($stack1 as $key) {
					$cbpod .="<option value='".$key['W_ID']."'><b>".$key['W_ID'].'</b> : '.$key['W_NAME']."</option>";
				}
				$cbpod .= "</select>";

				echo  $cbpod;

    }
	
	public function auto_pkgtype()
	{
        $port=explode("-",htmLawed($_POST["port"]));
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		//print_r($in_data);die;

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getPkgId",array("in_data" => "$in_data"),$result))
		{

			echo $result;
			die;
		}
		else
		{
			//print_r($result);die;
			$obj = json_decode($result);
			//log_message('error','>>>>>>>>>> auto POD: '.$result);
			$stack1	= array();
			if($obj->data->pkg){
			  for($i=0;$i<count($obj->data->pkg);$i++)
				{
					$temp;
					$temp['ID_PKG']=$obj->data->pkg[$i]->id_pkg;
					$temp['PKG_NAME']=$obj->data->pkg[$i]->pkg_name;
					array_push($stack1, $temp);
				}
			}
		}
        //echo json_encode($stack1);
				$cbpod 	= "<select name='pkg_id' id='pkg_id' class='form-control'>";
				$cbpod  .= "<option value=''>---Pilih---</option>";
				foreach ($stack1 as $key) {
					$cbpod .="<option value='".$key['PKG_NAME']."'>".$key['PKG_NAME']."</option>";
				}
				$cbpod .= "</select>";

				echo  $cbpod;

    }
	
	
	public function save_recdelv(){
		
        $port=explode("-",htmLawed($_POST["PORT"]));
		$data_master=$this->master_model->getHoldingCompany($port[1]);
		$id_holding=$data_master['ID_HOLDING'];
		$id_compny=$data_master['ID_COMPANY'];
		$CNAME=$_POST['CNAME'];
		$CADD=$_POST['CADD'];
		$CONAME=$_POST['CONAME'];
		$COID=$_POST['COID'];		
		$CNPWP=$_POST['CNPWP'];
		$CID=$_POST['CID'];
		$SVCT=$_POST['SVCT'];
		$UKK=$_POST['UKK'];
		$VES=$_POST['VES'];
		$VIN=$_POST['VIN'];
		$VOT=$_POST['VOT'];
		$DON=$_POST['DON'];
		$DOD=$_POST['DOD'];
		$POL=$_POST['POL'];
		$POD=$_POST['POD'];
		$POR=$_POST['POR'];
		$STD=$_POST['STD'];
		$WHI=$_POST['WHI'];
		$END=$_POST['END'];
		$MVT=$_POST['MVT'];
		$SPB=$_POST['SPB'];
		$SPD=$_POST['SPD'];
		$PYC=$_POST['PYC'];
		$IDR=$_POST['IDR'];
		$ETA=$_POST['ETA'];
		$ETD=$_POST['ETD'];
		$userid=$this->session->userdata('uname_phd');
		/*data detail*/
		$HSC=$_POST['HSC'];
		$CRI=$_POST['CRI'];
		$CRN=$_POST['CRN'];
		$PKG=$_POST['PKG'];
		$QTY=$_POST['QTY'];
		$TON=$_POST['TON'];
		$CBC=$_POST['CBC'];
		$HZD=$_POST['HZD'];
		$DST=$_POST['DST'];
		$TTY=$_POST['TTY'];
		$BLN=$_POST['BLN'];
		$BLD=$_POST['BLD'];
		$TYA=$_POST['TYA'];
		$SIZE=$_POST['SIZE'];
		$TYPE=$_POST['TYPE'];
		$STATUS=$_POST['STATUS'];
		
		//print_r(count($HSC));die;
		for($i=0;$i<count($HSC);$i++){
			if($SVCT=='00'){
				$move_type=	$MVT[$i];
				$trade_type=$TTY[$i];
				$bl_number=$BLN[$i];
				$bl_date=$BLD[$i];
				$ei=$TYA[$i];
			}
			else
			{
				$move_type=	$MVT;
				$trade_type=$TTY;
				$bl_number=$BLN;
				$bl_date=$BLD;
				$ei=$TYA;
			}
			
			
			$detail_data=$detail_data."<cargo>
				<hscode>".$HSC[$i]."</hscode>
				<cargo_id>".$CRI[$i]."</cargo_id>
				<cargo_name>".$CRN[$i]."</cargo_name>
				<pkg>".$PKG[$i]."</pkg>
				<qty>".$QTY[$i]."</qty>
				<ton>".$TON[$i]."</ton>
				<cbc>".$CBC[$i]."</cbc>
				<hz>".$HZD[$i]."</hz>
				<ds>".$DST[$i]."</ds>
				<size>".$SIZE[$i]."</size>
				<type>".$TYPE[$i]."</type>
				<status>".$STATUS[$i]."</status>
				<move_ty>".$move_type."</move_ty>
				<trade>".$trade_type."</trade>
				<blnumber>".$bl_number."</blnumber>
				<bldate>".$bl_date."</bldate>
				<ei>".$ei."</ei>
			</cargo>";
		}
		//print_r($detail_data);die;
		/*data detail*/
		
		/*create header*/
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<headers>
					<port_code>".$port[0]."</port_code>
					<terminal_code>".$port[1]."</terminal_code>
					<id_holding>".$id_holding."</id_holding>
					<id_company>".$id_compny."</id_company>
					<id_cust>".$CID."</id_cust>
					<cust_name>".$CNAME."</cust_name>
					<cust_addr>".$CADD."</cust_addr>
					<cust_npwp>".$CNPWP."</cust_npwp>
					<id_servicetype>".$SVCT."</id_servicetype>
					<id_vvd>".$UKK."</id_vvd>
					<vessel>".$VES."</vessel>
					<voy_in>".$VIN."</voy_in>
					<voy_out>".$VOT."</voy_out>
					<do_number>".$DON."</do_number>
					<do_date>".$DOD."</do_date>
					<pod>".$POD."</pod>
					<pol>".$POL."</pol>
					<por>".$POR."</por>
					<stackin_date>".$STD."</stackin_date>
					<stackout_date>".$END."</stackout_date>
					<userid>".$userid."</userid>
					<whouseid>".$WHI."</whouseid>
					<sppb_npe>".$SPB."</sppb_npe>
					<sppb_npe_date>".$SPD."</sppb_npe_date>
					<channel_payment>".$PYC."</channel_payment>
					<no_req>".$IDR."</no_req>
					<eta>".$ETA."</eta>
					<etd>".$ETD."</etd>
					<co_name>".$CONAME."</co_name>
					<co_id>".$COID."</co_id>
				</headers>
				<details>
					$detail_data
				</details>
			</data>
		</root>";
		//print_r($in_data);die;

		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"saveReqBooking",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;
			// die;
			//
			$obj = json_decode($result);
			//print_r($obj);die;
			//log_message('error','>>>>>>>>>> auto POD: '.$result);
			
			$v_out=$obj->data->result->OUT;
			$v_req=$obj->data->result->NO_REQ;
			
		}
        /*create header*/
		
		
		echo $v_out.'^'.$v_req;
    }
	
	public function auto_vessel_npk(){
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
		// terminal code :  T3I,T3D,T2D,T1D //bisa diisi kosong untuk ambil semua terminal
		$in_data="	<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<vessel_name>$term</vessel_name>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		// print_r($in_data);
		// die();
		if(!$this->nusoap_lib->call_wsdl(ORDER_MGT,"getVesselList",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			// echo $result;die;
			$obj = json_decode($result);

			if($obj->data->vessel)
			{
				for($i=0;$i<count($obj->data->vessel);$i++)
				{
					$temp;
					$temp['VESSEL']=$obj->data->vessel[$i]->VESSEL;
					$temp['VOYAGE_IN']=$obj->data->vessel[$i]->VOYAGE_IN;
					$temp['VOYAGE_OUT']=$obj->data->vessel[$i]->VOYAGE_OUT;
					$temp['VOYAGE']=$obj->data->vessel[$i]->VOYAGE;
					$temp['ETA']=$obj->data->vessel[$i]->ETA;
					$temp['OPEN_STACK']=$obj->data->vessel[$i]->OPEN_STACK;
					$temp['ETD']=$obj->data->vessel[$i]->ETD;
					$temp['CLOSING_TIME']=$obj->data->vessel[$i]->CLOSING_TIME;
					$temp['CLOSING_TIME_DOC']=$obj->data->vessel[$i]->CLOSING_TIME_DOC;
					$temp['ID_VSB_VOYAGE']=$obj->data->vessel[$i]->ID_VSB_VOYAGE;
					$temp['VESSEL_CODE']=$obj->data->vessel[$i]->VESSEL_CODE;
					$temp['CALL_SIGN']=$obj->data->vessel[$i]->CALL_SIGN;
					$temp['START_WORK']=$obj->data->vessel[$i]->START_WORK;
					//$temp['DATE_DISCHARGE']=$obj->data->vessel[$i]->date_discharge;
					//$temp['NO_BOOKING']=$obj->data->vessel[$i]->no_booking;
					array_push($stack, $temp);
				}
			}
		}

			$data['vessel'] = $stack;
			$this->load->library("table");
			$this->table->set_heading(
					'Vessel',
					'Voyage In',
					'Voyage Out',
					'ETA',
					'ETD',
					'Pilih'
				);

			$i=0;
			foreach ($stack as $t){
				$isi=$t['VESSEL'].'^'.$t['VOYAGE_IN'].'^'.$t['VOYAGE_OUT'].'^'.$t['ETA'].'^'.$t['ETD'].'^'.$t['OPEN_STACK'].'^'.$t['CLOSING_TIME'].'^'.$t['CLOSING_TIME_DOC'].'^'.$t['ID_VSB_VOYAGE'].'^'.$t['VESSEL_CODE'].'^'.$t['CALL_SIGN'].'^'.$t['START_WORK'];
				$this->table->add_row(
					$t['VESSEL']." (".$t['NO_BOOKING'].")",
					$t['VOYAGE_IN'],
					$t['VOYAGE_OUT'],
					$t['ETA'],
					$t['ETD'],
					 '<a data-dismiss="modal" style="cursor:pointer" class="table-link click_detail bank_detail" onclick="complete(\''.$isi.'\')"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-edit    fa-stack-1x fa-inverse"></i></span></a>'
				);
					$i++;
			}

			$this->load->view('pages/container/search_vessel_modal',$data);
	}
	
}
