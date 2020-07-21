<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class approval_request extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('user_model');
		$this->load->model('container_model');
		$this->load->library("nusoap_lib");
		$this->load->library('table');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		
         require_once(APPPATH.'libraries/htmLawed.php');

        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

		if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) {

			redirect(ROOT.'mainpage', 'refresh');
		}
	}

	public function main_cclbook()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));
		$data['data_term']=$this->container_model->getTerminalCancel();
		$data['data_svc_ccl']=$this->container_model->getServiceCancel();

		$this->breadcrumbs->push("Cancel Booking", 'approval_request/main_cclbook');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Cancel Booking";

		$this->common_loader($data,'pages/container/cancel_booking');

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


	}

	public function new_main_approval()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Approval Request", 'approval_request/new_main_approval');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Approval Request";
		log_message('error','>>>>>>>>>>>>>>>>>>>>> masuk new main approval :');
		$this->common_loader($data,'pages/container/new_approval_request');
	}

	public function main_approval_cancel()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}

		$data['menu_list']=$this->user_model->get_menuList($this->session->userdata('group_phd'));

		$this->breadcrumbs->push("Approval History", 'approval_request/main_approval_cancel');
		$this->breadcrumbs->unshift('Home', '/');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['title']= "Approval History";

		$this->common_loader($data,'pages/container/approval_cancel');
	}

	public function search_table($search="")
	{

		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Request Number</th>",
			"<th width='100px'>Request Date</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>Port / Terminal</th>",
			//get_content($this->user_model,"receiving","terminal"),
			"<th width='100px'>Vessel-Voyage</th>",
			"<th width='100px'>View</th>",
			"<th width='100px'>Document</th>",
			"<th width='100px'>Approve</th>"
		 );

		$datagrid=$this->container_model->getListApproval($page, $limit, $search);
		// print_r($datagrid);
		// die();
		$totallist=$this->container_model->getTotalListApproval($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);
		// print_r("<pre>");
		// print_r($datagrid);
		// print_r("</pre>");
		// die();
		for($i=0;$i<count($datagrid);$i++)
		{
			$no_req = $datagrid[$i]['REQUEST_ID'];
			$no_reqbiller=$datagrid[$i]['BILLER_REQUEST_ID'];

			$request_date = "<div class='clock_container' style='text-align:left'>
				<span style='display:block;margin-bottom:3px;'>".$datagrid[$i]['REQUEST_DATE']."</span>
				<span class='clock_now label label-info'></span>
				<span class='clock_req label label-info'></span>
				<span class='clock_approval label label-info'></span>
				<span class='req_date hidden_content'>"
					.$datagrid[$i]['REQUEST_DATE_STRING'].
				"</span>
				<span class='sysdate hidden_content'>"
					.$datagrid[$i]['SYSDATE_STRING'].
				"</span>
			</div>";

			$doc1view =false;
			$doc2view =false;
			$doc3view =false;

			if($datagrid[$i]['MODUL']=='RECEIVING')
			{
				$doc1='NPE';
				$doc1c='NPE';
				$doc1file=$datagrid[$i]['NPE_FILE'];
				$doc2='PEB';
				$doc2c='PEB';
				$doc2file=$datagrid[$i]['PEB_FILE'];
				$doc3='Booking';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];

				if(
					($datagrid[$i]['PORT_ID']=="IDJKT" && $datagrid[$i]['TERMINAL_ID']=="T3I") || 
					($datagrid[$i]['PORT_ID']=="IDPNJ" && $datagrid[$i]['TERMINAL_ID']=="PNJI")
					)
				{
					$doc1view =true;
					$doc2view =true;
					$doc3view =true;
				} else if(($datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBI") || ($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBI")){
					$doc1file=$datagrid[$i]['BOOKSHIP_FILE'];
					$doc1view =true;
					$doc2view =true;
					$doc3view =true;
				} else if(
					($datagrid[$i]['PORT_ID']=="IDPLM" && $datagrid[$i]['TERMINAL_ID']=="PLMI") || 
					($datagrid[$i]['PORT_ID']=="IDPNK" && $datagrid[$i]['TERMINAL_ID']=="PNKI")
					)
				{
					$doc1view =true;
					$doc2view =true;
					$doc3view =true;
				}else if(
						($datagrid[$i]['PORT_ID']=="IDPNJ" && $datagrid[$i]['TERMINAL_ID']=="PNJD")  ||
						($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBD" || 
						 $datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBD" || 
						 $datagrid[$i]['PORT_ID']=="IDPNK" || $datagrid[$i]['PORT_ID']=="IDPLM"
						)
					) {
					$doc3view =true;	
				}
				
			}
			else if(($datagrid[$i]['MODUL']=='DELIVERY') or ($datagrid[$i]['MODUL']=='PERPANJANGAN DELIVERY'))
			{
				$doc1='DO';
				$doc1c='DO';
				$doc1file=$datagrid[$i]['DO_FILE'];
				$doc2='SPPB';
				$doc2c='SPPB';
				$doc2file=$datagrid[$i]['SPPB_FILE'];
				$doc3='SP Cust.';
				$doc3c='SPC';
				$doc3file=$datagrid[$i]['SP_CUSTOM_FILE'];

				$doc1view =true;
				if(($datagrid[$i]['PORT_ID']=="IDJKT" && $datagrid[$i]['TERMINAL_ID']=="T3I") || 
					($datagrid[$i]['PORT_ID']=="IDPNJ" && $datagrid[$i]['TERMINAL_ID']=="PNJI")
					)
				{
					$doc2view =true;
					$doc3view =true;				
				}else if($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBI" || $datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBI" 
					|| ($datagrid[$i]['PORT_ID']=="IDPNK" && $datagrid[$i]['TERMINAL_ID']=="PNKI") || ($datagrid[$i]['PORT_ID']=="IDPLM" && $datagrid[$i]['TERMINAL_ID']=="PLMI")) {
						$doc1view =true;
						$doc2view =true;
						//$doc3view =true;
				}
			}else if(($datagrid[$i]['MODUL']=='CALBG') or ($datagrid[$i]['MODUL']=='CALAG'))
			{
				$doc1='NPE';
				$doc1c='NPE';
				$doc1file=$datagrid[$i]['NPE_FILE'];
				$doc2='PEB';
				$doc2c='PEB';
				$doc2file=$datagrid[$i]['PEB_FILE'];
				$doc3='Booking';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
				
				if($datagrid[$i]['PORT_ID']=="IDPNJ" && $datagrid[$i]['TERMINAL_ID']=="PNJI")
				{
					$doc1view =true;
					$doc2view =true;
				}elseif(($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBI") || ($datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBI") || ($datagrid[$i]['PORT_ID']=="IDPLM" && $datagrid[$i]['TERMINAL_ID']=="PLMI") || ($datagrid[$i]['PORT_ID']=="IDPNK" && $datagrid[$i]['TERMINAL_ID']=="PNKI")){
					$doc1view =true;
					$doc2view =true;
					$doc3view =true;
				}
				else if(($datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBD") || ($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBD")){
					$doc3view = true;
				}
				else if(($datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBD") || ($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBD")){
					$doc3view = true;
				}else if(($datagrid[$i]['PORT_ID']=="IDPLM" && $datagrid[$i]['TERMINAL_ID']=="PLMD") || ($datagrid[$i]['PORT_ID']=="IDPNK" && $datagrid[$i]['TERMINAL_ID']=="PNKD")){
					$doc3view = true;
				}
			

			}else if(($datagrid[$i]['MODUL']=='CALDG')){
				
				$doc1='DO';
				$doc1c='DO';
				$doc1file=$datagrid[$i]['DO_FILE'];
				$doc2='SPPBE';
				$doc2c='SPPB';
				$doc2file=$datagrid[$i]['SPPB_FILE'];
				$doc3='SP Cust.';
				$doc3c='SPC';
				$doc3file=$datagrid[$i]['SP_CUSTOM_FILE'];

				if(($datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBD") || ($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBD") || ($datagrid[$i]['PORT_ID']=="IDPLM" && $datagrid[$i]['TERMINAL_ID']=="PLMD") || ($datagrid[$i]['PORT_ID']=="IDPNK" && $datagrid[$i]['TERMINAL_ID']=="PNKD")){
						// $doc1view =true;
						// $doc2view =true;
						// $doc3view =true;
				}
				elseif(($datagrid[$i]['PORT_ID']=="IDDJB" && $datagrid[$i]['TERMINAL_ID']=="DJBI") || ($datagrid[$i]['PORT_ID']=="IDTLB" && $datagrid[$i]['TERMINAL_ID']=="TLBI") || ($datagrid[$i]['PORT_ID']=="IDPLM" && $datagrid[$i]['TERMINAL_ID']=="PLMI") || ($datagrid[$i]['PORT_ID']=="IDPNK" && $datagrid[$i]['TERMINAL_ID']=="PNKI")){
					$doc2view =true;
				}
			}
			$document_link="";

			if($doc1view)
			{
				if (($datagrid[$i]['MODUL']=='DELIVERY' && $datagrid[$i]['DO_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='PERPANJANGAN DELIVERY' && $datagrid[$i]['DO_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='RECEIVING' && $datagrid[$i]['NPE_FILE_FLAG'] == 'Y')|| ($datagrid[$i]['MODUL']=='CALBG' && $datagrid[$i]['NPE_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='CALAG' && $datagrid[$i]['NPE_FILE_FLAG'] == 'Y')){
					$icon_status = '<img class="checktick" src="'.IMAGES_.'/cr/small_tick.png" title="Sudah dicheck" data-noreq="'.$no_req.'" data-flag="'.$doc1c.'" data-valid="Y"/>';
				} else {
					$icon_status = '<img class="checktick" src="'.IMAGES_.'/cr/small_help.png" title="Perlu dicheck" data-noreq="'.$no_req.'" data-flag="'.$doc1c.'" data-valid="N"/>';
				}
				$document_link.=$icon_status.
					$doc1.' : <a href=\'javascript:void(0)\' onclick=\'clickDialogDoc("'.$doc1file.'","'.$doc1c.'","'.$no_req.'")\'>
					<img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';
			}
			if($doc2view)
			{
				if (($datagrid[$i]['MODUL']=='DELIVERY' && $datagrid[$i]['SPPB_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='PERPANJANGAN DELIVERY' && $datagrid[$i]['SPPB_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='RECEIVING' && $datagrid[$i]['PEB_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='CALAG' && $datagrid[$i]['PEB_FILE_FLAG'] == 'Y')||
					($datagrid[$i]['MODUL']=='CALBG' && $datagrid[$i]['PEB_FILE_FLAG'] == 'Y')){
					$icon_status = '<img class="checktick" src="'.IMAGES_.'/cr/small_tick.png" title="Sudah dicheck" data-noreq="'.$no_req.'" data-flag="'.$doc2c.'" data-valid="Y"/>';
				} else {
					$icon_status = '<img class="checktick" src="'.IMAGES_.'/cr/small_help.png" title="Perlu dicheck" data-noreq="'.$no_req.'" data-flag="'.$doc2c.'" data-valid="N"/>';
				}
				$document_link.=$icon_status.
					$doc2.' : <a href=\'javascript:void(0)\' onclick=\'clickDialogDoc("'.$doc2file.'","'.$doc2c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';
			}
			if($doc3view)
			{
				if (($datagrid[$i]['MODUL']=='DELIVERY' && $datagrid[$i]['SP_CUSTOM_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='PERPANJANGAN DELIVERY' && $datagrid[$i]['SP_CUSTOM_FILE_FLAG'] == 'Y') ||
					($datagrid[$i]['MODUL']=='RECEIVING' && $datagrid[$i]['BOOKSHIP_FILE_FLAG'] == 'Y')){
					$icon_status = '<img class="checktick" src="'.IMAGES_.'/cr/small_tick.png" title="Sudah dicheck" data-noreq="'.$no_req.'" data-flag="'.$doc3c.'" data-valid="Y"/>';
				} else {
					$icon_status = '<img class="checktick" src="'.IMAGES_.'/cr/small_help.png" title="Perlu dicheck" data-noreq="'.$no_req.'" data-flag="'.$doc3c.'" data-valid="N"/>';
				}
				if($datagrid[$i]['MODUL']=='CALBG' || $datagrid[$i]['MODUL']=='CALAG'){
					$doc3 = 'Book/RO';
				}
				$document_link.=$icon_status.
					$doc3.' : <a href=\'javascript:void(0)\' onclick=\'clickDialogDoc("'.$doc3file.'","'.$doc3c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';
			}

			// print_r($datagrid[$i]['IS_APPROVEABLE']);
			/*$show_doc_link = "<button onclick='showFullReview(\"".$doc1file."\",\"".$doc1c."\")' type='button' class='btn btn-primary'>Review Doc</button>";

			$show_doc_link = "<a class=\"open-popup btn btn-primary\"  href=\"#\" onclick=\"alert('test')\"><i class=\"glyphicon glyphicon-file\">
				<span class='default-font'>Review</span>
			</i></a>
			";*/

			// $datagrid[$i]['IS_APPROVEABLE'] = 'N';
			$view_link='<a class=\'btn btn-primary\' href=\'javascript:void(0)\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a> &nbsp; <a class=\'btn btn-primary\' href=\'javascript:void(0)\' onclick=\'clickDialog2("'.$no_req.'")\'><i class=\'fa fa-money\'></i></a>';
			if ($datagrid[$i]['IS_APPROVEABLE'] == 'Y'){
				$approve_link='<span id=\'BUTTONACTIVE-'.$no_req.'\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'approveD("'.$datagrid[$i]['MODUL'].'","'.$no_req.'","'.$datagrid[$i]['PORT_ID'].'-'.$datagrid[$i]['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a></span>';
				$approve_link.='<span id=\'BUTTONINACTIVE-'.$no_req.'\' style=\'display:none\' class=\'btn\' style=\'cursor:default\'><img src="'.IMAGES_.'button_check_grey.png" title="check semua document untuk approve"/></span>';
			} else {
				$approve_link='<span id=\'BUTTONACTIVE-'.$no_req.'\' style=\'display:none\'><a href=\'javascript:void(0)\' class=\'btn\' onclick=\'approveD("'.$datagrid[$i]['MODUL'].'","'.$no_req.'","'.$datagrid[$i]['PORT_ID'].'-'.$datagrid[$i]['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a></span>';
				$approve_link.='<span id=\'BUTTONINACTIVE-'.$no_req.'\' class=\'btn\' style=\'cursor:default\'><img src="'.IMAGES_.'button_check_grey.png" title="check semua document untuk approve"/></span>';
			}

			$reject_link='<a id=\'BUTTONREJECT-'.$no_req.'\' href=\'#\' class=\'btn\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
			log_message('error','>>>>>>>>>>>>>>>>Approval_request'.$approve_link);
			$this->table->add_row(
				($limit*($page-1))+($i+1),
				$no_req,
				$request_date,
				$this->security->xss_clean($datagrid[$i]['CUSTOMER_NAME']),
				$this->security->xss_clean($datagrid[$i]['TERMINAL_NAME']),
				//$datagrid[$i]['TERMINAL_ID'],
				$this->security->xss_clean($datagrid[$i]['VESVOY']),
				$view_link,
				$document_link, //$show_doc_link,
				$approve_link . $reject_link
			);
		}

		$this->load->view('pages/container/new_approval_request_grid',$data);
	}

	public function search_tb_svcccl($search="")
	{
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Request Number</th>",
			"<th width='100px'>Request Date</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>Port / Terminal</th>",
			//get_content($this->user_model,"receiving","terminal"),
			"<th width='100px'>Vessel-Voyage</th>",
			"<th width='100px'>View</th>",
			"<th width='100px'>Document</th>",
			"<th width='100px'>Cancel"
		 );
		//$this->session->userdata('customerid_phd')
		$datagrid=$this->container_model->getListSvcCancel($page, $limit, $search);
		$totallist=$this->container_model->getTtlListSvcCancel($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		for($i=0;$i<count($datagrid);$i++)
		{
			$no_req = $datagrid[$i]['REQUEST_ID'];
			$no_reqbiller=$datagrid[$i]['BILLER_REQUEST_ID'];

			$request_date = "<div class='clock_container' style='text-align:left'>
				<span style='display:block;margin-bottom:3px;'>".$datagrid[$i]['REQUEST_DATE']."</span>
				<span class='clock_now label label-info'></span>
				<span class='clock_req label label-info'></span>
				<span class='clock_approval label label-info'></span>
				<span class='req_date hidden_content'>"
					.$datagrid[$i]['REQUEST_DATE_STRING'].
				"</span>
			</div>";

			if($datagrid[$i]['STATUS_REQ']=='W')
			{

				$view_link='<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';
				$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid[$i]['MODUL_DESC'].'","'.$no_req.'","'.$datagrid[$i]['PORT_ID'].'-'.$datagrid[$i]['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
			}
			else if($datagrid[$i]['STATUS_REQ']=='R')
			{
				$view_link='Reject';
				$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid[$i]['MODUL_DESC'].'","'.$no_req.'","'.$datagrid[$i]['PORT_ID'].'-'.$datagrid[$i]['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
			}
			else if($datagrid[$i]['STATUS_REQ']=='P')
			{
				$view_link='Request already paid';
				$approve_link='Approved';
			}
			else if($datagrid[$i]['STATUS_REQ']=='S')
			{
				$view_link='Proforma Ready';
				$approve_link='Approved';
			}

			if($datagrid[$i]['MODUL']=='RECEIVING')
			{
				$doc1='NPE';
				$doc1c='NPE';
				$doc1file=$datagrid[$i]['NPE_FILE'];
				$doc2='PEB';
				$doc2c='PEB';
				$doc2file=$datagrid[$i]['PEB_FILE'];
				$doc3='Booking Number';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
			}
			else if(($datagrid[$i]['MODUL']=='DELIVERY') or ($datagrid[$i]['MODUL']=='PERPANJANGAN DELIVERY'))
			{
				$doc1='DO';
				$doc1c='DO';
				$doc1file=$datagrid[$i]['DO_FILE'];
				$doc2='SPPB';
				$doc2c='SPPB';
				$doc2file=$datagrid[$i]['SPPB_FILE'];
				$doc3='Booking Number';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
			}else if(($datagrid[$i]['MODUL']=='CALBG') or ($datagrid[$i]['MODUL']=='CALAG')or ($datagrid[$i]['MODUL']=='CALDG'))
			{
				$doc1='DO';
				$doc1c='DO';
				$doc1file='';
				$doc2='SPPB';
				$doc2c='SPPB';
				$doc2file='';
				$doc3='Booking Number';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
			}

			$document_link=$doc1.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc1file.'","'.$doc1c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc2.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc2file.'","'.$doc2c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc3.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc3file.'","'.$doc3c.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';

			$show_doc_link = "<button onclick='showFullReview(\"".$doc1file."\",\"".$doc1c."\")' type='button' class='btn btn-primary'>Review Doc</button>";

			$show_doc_link = "<a class=\"open-popup btn btn-primary\"  href=\"#\" onclick=\"alert('test')\"><i class=\"glyphicon glyphicon-file\">
				<span class='default-font'>Review</span>
			</i></a>
			";

			$approve_link='<a href=\'#\' onclick=\'cancelOrder("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="Cancel Order"/></a>';
			$view_link='<a class=\'btn btn-primary\' href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';
			$this->table->add_row(
				($limit*($page-1))+($i+1),
				$no_req,
				$request_date,
				$this->security->xss_clean($datagrid[$i]['CUSTOMER_NAME']),
				$this->security->xss_clean($datagrid[$i]['TERMINAL_NAME']),
				//$datagrid[$i]['TERMINAL_ID'],
				$this->security->xss_clean($datagrid[$i]['VESVOY']),
				$view_link,
				$document_link, //$show_doc_link,
				$approve_link
			);
		}

		$this->load->view('pages/container/cancel_booking_grid',$data);
	}


	public function search_table2($search="")
	{
		$page=isset($_POST['page']) ? htmLawed($_POST['page']) : 1;
		$limit=isset($_POST['limit']) ? htmLawed($_POST['limit']) : 10;

		$data['page'] 	= $page;
		$data['limit'] 	= $limit;
		$data['search'] = $search;

		//create table
		$this->table->set_heading(
			"<th width='30px'>No</th>",
			"<th width='100px'>Request Number</th>",
			"<th width='100px'>Request Date</th>",
			"<th width='100px'>Approve Date</th>",
			"<th width='100px'>Customer</th>",
			"<th width='100px'>Port / Terminal</th>",
			//get_content($this->user_model,"receiving","terminal"),
			"<th width='100px'>Vessel-Voyage</th>",
			"<th width='100px'>View</th>",
			"<th width='100px'>Document</th>",
			"<th width='100px'>Status</th>",
			"<th width='100px'>Approval</th>"//,
			//"<th width='100px'>Approve</th>"
		 );

		$datagrid=$this->container_model->getListApproval2($page, $limit, $search);
		$totallist=$this->container_model->getTotalListApproval2($search);
		$data['totallist'] = $totallist;
		$data['totalpage'] = ceil($totallist/$limit);

		for($i=0;$i<count($datagrid);$i++)
		{
			$no_req = $datagrid[$i]['REQUEST_ID'];
			$no_reqbiller=$datagrid[$i]['BILLER_REQUEST_ID'];

			$request_date = "<div class='clock_container' style='text-align:left'>
				<span style='display:block;margin-bottom:3px;'>".$datagrid[$i]['REQUEST_DATE']."</span>
				<span class='clock_now label label-info'></span>
				<span class='clock_req label label-info'></span>
				<span class='clock_approval label label-info'></span>
				<span class='req_date hidden_content'>"
					.$datagrid[$i]['REQUEST_DATE_STRING'].
				"</span>
			</div>";

			if($datagrid[$i]['STATUS_REQ']=='W')
			{

				$view_link='<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';
				$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid[$i]['MODUL_DESC'].'","'.$no_req.'","'.$datagrid[$i]['PORT_ID'].'-'.$datagrid[$i]['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
			}
			else if($datagrid[$i]['STATUS_REQ']=='R')
			{
				$view_link='Reject';
				$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid[$i]['MODUL_DESC'].'","'.$no_req.'","'.$datagrid[$i]['PORT_ID'].'-'.$datagrid[$i]['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
			}
			else if($datagrid[$i]['STATUS_REQ']=='P')
			{
				//$view_link='Request already paid';
				$label_span='<span class="label label-success">Paid</span>';
				$view_link='<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';
				$approve_link='Approved';
			}
			else if($datagrid[$i]['STATUS_REQ']=='S')
			{
				//$view_link='Proforma Ready';
				$label_span='<span class="label label-success">Approved</span> <span class="label label-warning">Not Paid</span>';
				$view_link='<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';
				$approve_link='Approved';
			}

			if($datagrid[$i]['MODUL']=='RECEIVING')
			{
				$doc1='NPE';
				$doc1c='NPE';
				$doc1file=$datagrid[$i]['NPE_FILE'];
				$doc2='PEB';
				$doc2c='PEB';
				$doc2file=$datagrid[$i]['PEB_FILE'];
				$doc3='Booking Number';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
			}
			else if(($datagrid[$i]['MODUL']=='DELIVERY') or ($datagrid[$i]['MODUL']=='PERPANJANGAN DELIVERY'))
			{
				$doc1='DO';
				$doc1c='DO';
				$doc1file=$datagrid[$i]['DO_FILE'];
				$doc2='SPPB';
				$doc2c='SPPB';
				$doc2file=$datagrid[$i]['SPPB_FILE'];
				$doc3='Booking Number';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
			}else if(($datagrid[$i]['MODUL']=='CALBG') or ($datagrid[$i]['MODUL']=='CALAG')or ($datagrid[$i]['MODUL']=='CALDG'))
			{
				$doc1='DO';
				$doc1c='DO';
				$doc1file='';
				$doc2='SPPB';
				$doc2c='SPPB';
				$doc2file='';
				$doc3='Booking Number';
				$doc3c='BKS';
				$doc3file=$datagrid[$i]['BOOKSHIP_FILE'];
			}

			$document_link=$doc1.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc1file.'","'.$doc1c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc2.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc2file.'","'.$doc2c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc3.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc3file.'","'.$doc3c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>';

			$show_doc_link = "<button onclick='showFullReview(\"".$doc1file."\",\"".$doc1c."\")' type='button' class='btn btn-primary'>Review Doc</button>";

			$show_doc_link = "<a class=\"open-popup btn btn-primary\"  href=\"#\" onclick=\"alert('test')\"><i class=\"glyphicon glyphicon-file\">
				<span class='default-font'>Review</span>
			</i></a>
			";

			$approve_link='<a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';

			$this->table->add_row(
				($limit*($page-1))+($i+1),
				$no_req,
				$request_date,
				$datagrid[$i]['APPROVE_DATE'],
				$this->security->xss_clean($datagrid[$i]['CUSTOMER_NAME']),
				$this->security->xss_clean($datagrid[$i]['TERMINAL_NAME']),
				//$datagrid[$i]['TERMINAL_ID'],
				$this->security->xss_clean($datagrid[$i]['VESVOY']),
				$view_link,
				$document_link,
				$label_span,
				$datagrid[$i]['NAME_APPROVE']
				//, //$show_doc_link,
				//$approve_link
			);
		}

		$this->load->view('pages/container/new_approval_request_grid',$data);
	}

	public function get_count_new_approval()
	{
		if(!$this->user_model->checkSession())
		{
			echo "sessionkill";
			die();
		}

		echo $this->container_model->getTotalListApproval();
	}

	public function search_request()
	{
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
		$no_req=htmLawed($_POST['ID_REQ']);
		$datagrid=$this->container_model->getNumberReqAndSource($no_req);
		$this->table->set_heading("No",
                                      "Request Number",
									  "Request Date",
									  "Customer",
                                      "Port",
                                      "Terminal",
                                      "Vessel-Voyage",
                                      "View",
									  "Document",
									  "Approve")
									  ;

	    $i=1;
		$no_reqbiller=$datagrid['BILLER_REQUEST_ID'];
		if($datagrid['STATUS_REQ']=='N')
		{
			$view_link='<a  class=\'btn btn-primary\'  href=\'#\' onclick=\'clickDialog1("'.$no_req.'")\'><i class=\'fa fa-eye\'></i></a>';
			$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid['MODUL_DESC'].'","'.$no_req.'","'.$datagrid['PORT_ID'].'-'.$datagrid['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
		}
		else if($datagrid['STATUS_REQ']=='R')
		{
			$view_link='Reject';
			$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid['MODUL_DESC'].'","'.$no_req.'","'.$datagrid['PORT_ID'].'-'.$datagrid['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';
		}
		else if($datagrid['STATUS_REQ']=='P')
		{
			$view_link='Request already paid';
			$approve_link='Approved';
		}
		else if($datagrid['STATUS_REQ']=='S')
		{
			$view_link='Proforma Ready';
			$approve_link='Approved';
		}

		if($datagrid['MODUL']=='RECEIVING')
		{
			$doc1='NPE';
			$doc1c='NPE';
			$doc1file=$datagrid['NPE_FILE'];
			$doc2='PEB';
			$doc2c='PEB';
			$doc2file=$datagrid['PEB_FILE'];
			$doc3='Booking Number';
			$doc3c='BKS';
			$doc3file=$datagrid['BOOKSHIP_FILE'];
		}
		else if(($datagrid['MODUL']=='DELIVERY') or ($datagrid['MODUL']=='PERPANJANGAN DELIVERY'))
		{
			$doc1='DO';
			$doc1c='DO';
			$doc1file=$datagrid['DO_FILE'];
			$doc2='SPPB';
			$doc2c='SPPB';
			$doc2file=$datagrid['SPPB_FILE'];
			$doc3='Booking Number';
			$doc3c='BKS';
			$doc3file=$datagrid['BOOKSHIP_FILE'];
		}else if(($datagrid['MODUL']=='CALBG') or ($datagrid['MODUL']=='CALAG')or ($datagrid['MODUL']=='CALDG'))
		{
			$doc1='DO';
			$doc1c='DO';
			$doc1file=$datagrid['DO_FILE'];
			$doc2='SPPB';
			$doc2c='SPPB';
			$doc2file=$datagrid['SPPB_FILE'];
			$doc3='Booking Number';
			$doc3c='BKS';
			$doc3file=$datagrid['BOOKSHIP_FILE'];
		}


		$document_link=$doc1.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc1file.'","'.$doc1c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc2.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc2file.'","'.$doc2c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>'.$doc3.' : <a href=\'#\' onclick=\'clickDialogDoc("'.$doc3file.'","'.$doc3c.'","'.$no_req.'")\'><img src="'.IMAGES_.'openfile2.png" width="24px" /></a> <br>
		';

		$approve_link='<a href=\'#\' onclick=\'approveD("'.$datagrid['MODUL'].'","'.$no_req.'","'.$datagrid['PORT_ID'].'-'.$datagrid['TERMINAL_ID'].'")\' title="approve document"><img src="'.IMAGES_.'Button-Ok-icon24.png" /></a> <a href=\'#\' onclick=\'rejectD("'.$no_req.'")\'><img src="'.IMAGES_.'Actions-application-exit-icon.png" title="reject document"/></a>';

		$this->table->add_row(
							$i,
							$no_req,
							$this->security->xss_clean($datagrid['REQUEST_DATE']),
							$this->security->xss_clean($datagrid['CUSTOMER_NAME']),
							$this->security->xss_clean($datagrid['PORT_ID']),
							$this->security->xss_clean($datagrid['TERMINAL_ID']),
							$this->security->xss_clean($datagrid['VESVOY']),
							$view_link,
							$document_link,
							$approve_link
						);

			$i++;

		$this->load->view('pages/container/approval_request_grid');
	}

	public function reject_dialog($a)
	{
		$data['no_request']=$a;
		$this->load->view('pages/container/approval_request_reject',$data);
	}

	public function validate_doc($req_id, $flag_code, $flag_yn)
	{
		echo $this->container_model->setValidDocTransaction($req_id, $flag_code, $flag_yn);
	}
}
