<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class entity extends CI_Controller {

	var $API="";

	public function __construct(){
		parent::__construct();
		$this->forum = $this->load->database("forum",TRUE);
    	$this->forum->reconnect();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		if (! $this->session->userdata('is_login') ){
		 	redirect('main_invoice');
		}
		$this->load->model('user_model');
		$this->load->model('master_model');
		$this->load->model('container_model');
		$this->load->model('materai_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("table");
		$this->load->library('commonlib');
		$this->load->library('ciqrcode');
		$this->load->helper('MY_language_helper');
		$this->load->library('breadcrumbs');
		define('IMAGES_ENTITY_', APP_ROOT."uploads/entity/");
		require_once(APPPATH.'libraries/mime_type_lib.php');
		require_once(APPPATH.'libraries/htmLawed.php');

		$this->API=API_EINVOICE;


	}

	protected function getdataurl($url){
		$uri = API_EINVOICE.'/'.$url;
		//$uri = SITE_WSAPI.'/'.$url;
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:'.$apiKey
	   	);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		$data  = json_decode(curl_exec($ch));
		return $data;
	}

	protected function senddataurl($url,$data,$type){

        $time = time();
		$uri = API_EINVOICE.'/'.$url;
		// die($uri);
		$apiKey = '123456';
		$params = array(
			'Content-Type: application/x-www-form-urlencoded',
			'x-api-key:'.$apiKey
	   	);

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$type);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data,'','&'));
		$ex = curl_exec($ch);
		$result  = json_decode($ex);
		#debug file
         file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
         	array(
         		"body" => $ex,
         		"url" => $uri,
         		"data" => $data,
         ),true), FILE_APPEND);
		return $result;
	}

	function masterentity(){
		$data['prods'] = $this->getdataurl('entity');
		$data['data_materai'] = $this->getdataurl('materai');
		$data['data_faktur'] = $this->getdataurl('faktur');
		$data['unit'] = $this->getdataurl('unit');
		$role_id =  $this->session->userdata('role_id')	;
		$data['layanan'] = $this->auth_model->get_layanan($role_id);
		$this->common_loader($data,'invoice/administrasi/masterentity/masterentity');
	}

	function masterentitysearch(){
		$postdata = ($_POST);
		// print_r($_POST);die;
		$arrayData = $this->senddataurl('entity/search/',$postdata,'POST');
		$data = array(
				'data' => array()
			);
		$num = 1;
		foreach ($arrayData as $key => $value) {
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			$data['data'][$key]->action = '<button type="button" id="INV_ENTITY_CODE'.$num.'" name="INV_ENTITY_CODE3" onclick="editall('.$value->INV_ENTITY_ID.')" class="btn btn-primary btn-sm" ><i class="fa fa-pencil-square"></i></button>';
			// $data['data'][$key]['action'] = "action";
			$num++;
		}

		echo json_encode($data);
	}

	function masterentitysave(){
		$data = ($_POST);
		$logoName = $this->upload_img("req" ,"INV_ENTITY_LOGO",$data);
		$data['INV_ENTITY_LOGO'] = $logoName;
		$result = $this->senddataurl('entity',$data,'PUT');
		echo json_encode($result);

	}

	function masterentityedit(){
		$data1 = ($_POST);
		$id=$_POST['INV_ENTITY_ID'];

		$data  =  $this->getdataurl('entity/'.$id);
		echo json_encode($data);
	}

	function masterentityupdate(){

		$datas = ($_POST);
		// if ($data['INV_ENTITY_LOGO1NOTIF'] == "false") {
		// 	# code...
		// }
		// $data[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
		$data['INV_ENTITY_CODE'] = $datas["INV_ENTITY_CODEEDIT"];
		$data['INV_ENTITY_NAME'] = $datas["INV_ENTITY_NAME1"];
		$data['INV_ENTITY_ALAMAT'] = $datas["INV_ENTITY_ALAMAT1"];
		$data['INV_ENTITY_NPWP'] = $datas["INV_ENTITY_NPWP1"];
		// $data['INV_ENTITY_LOGO1NOTIF'] = $datas["INV_ENTITY_LOGO1NOTIF"];
		$data['INV_ENTITY_STATUS'] = $datas["INV_ENTITY_STATUS1"];
		$data['INV_ENTITY_ID'] = $datas["INV_ENTITY_ID1"];
		if (
			!empty($_FILES['INV_ENTITY_LOGO1']['name']) &&
			!empty($_FILES['INV_ENTITY_LOGO1']['type']) &&
			!empty($_FILES['INV_ENTITY_LOGO1']['tmp_name'])
		) {
			$logoName = $this->upload_img("req" ,"INV_ENTITY_LOGO1",$data);
			$data['INV_ENTITY_LOGO'] = $logoName;
		} else {
			$data['INV_ENTITY_LOGO'] = $datas['INV_ENTITY_LOGO1NOTIF'];
		}
		// unset($data['INV_ENTITY_LOGO1NOTIF']);
		// echo print_r($data);
		// echo print_r($_FILES); die();
		$result = $this->senddataurl('entity',$data,'POST'); //kalau update ganti PUT jadi POST
		echo json_encode($result);
	}

	function masterentityhapus(){
		$data = ($_POST);
		$result = $this->senddataurl('entity',$data,'DELETE');
		echo json_encode($result);
	}
	
	/* START Muhamad Sholihin */
	function mastermaterai(){
		$data['entity'] = $this->getdataurl('entity');
		$data['unit'] = $this->getdataurl('unit');
		$data['nota'] = $this->getdataurl('nota');

		$role_id =  $this->session->userdata('role_id')	;
		$this->common_loader($data,'invoice/administrasi/mastermaterai/mastermaterai');
	}

	function searchmastermaterai(){
		$postdata = ($_POST);
        $arrayData = $this->senddataurl('mastermaterai/searchmastermaterai/',$postdata,'POST');
        $data = array(
            'data' => array()
		);
		$num = 1;		
        foreach($arrayData as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
            $data['data'][$key]['action'] = '<button type="button" id="INV_EMATERAI_ID3" name="INV_EMATERAI_ID3" onclick="editmaterai(\''.$data['data'][$key]['INV_EMATERAI_ID'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="update_materai"><i class="fa fa-pencil-square"></i></button>';
            $num++;
        }

        echo json_encode($data);
	}

	function savemastermaterai(){
		$data = ($_POST);
		$sql = "INSERT INTO INV_MST_EMATERAI 
							(INV_ENTITY_ID, 
							INV_EMATERAI_NUMBER, 
							INV_EMATERAI_REDAKSI, 
							INV_EMATERAI_EFECTIVE, 
							INV_EMATERAI_END, 
							INV_EMATERAI_NOMINAL,
							INV_EMATERAI_MIN_AMOUNT,
							CREATED_DATE,
							INV_EMATERAI_STATUS)
                VALUES ('".$data['INV_ENTITY_ID']."',
						'".$data['INV_EMATERAI_NUMBER']."',
						'".$data['INV_EMATERAI_REDAKSI']."',
						'".$data['INV_EFF_START_DATE']."',
						'".$data['INV_EFF_END_DATE']."',
						'".$data['INV_EMATERAI_NOMINAL']."',
						'".$data['INV_EMATERAI_MIN_AMOUNT']."',
						sysdate,'Active')";
					
		$query = $this->forum->query($sql);
		echo json_encode($query);
	}

	function editmastermaterai(){
		$postdata = ($_POST);
		$data = $this->senddataurl('mastermaterai/editmastermaterai/',$postdata,'POST');
		echo json_encode($data);
	}

	function updatemastermaterai(){
		$postdata = ($_POST);
		$sql = "UPDATE INV_MST_EMATERAI 
                SET INV_EMATERAI_EFECTIVE 	= '".$postdata['INV_EMATERAI_EFECTIVE']."',
					INV_EMATERAI_END	= '".$postdata['INV_EMATERAI_END']."',
					UPDATED_DATE		= sysdate
				WHERE INV_EMATERAI_ID 	= '".$postdata['INV_EMATERAI_ID']."'";
		$query = $this->forum->query($sql);
		echo json_encode($query);

	}
	/* END */

	function mastermateraisearch(){
		$postdata = ($_POST);
		$arrayData = $this->senddataurl('materai/search/',$postdata,'POST');
		$data = array(
				'data' => array()
			);
		$num = 1;
		foreach ($arrayData as $key => $value) {
			$data['data'][$key] = $value;
			$data['data'][$key]->num = $num;
			$data['data'][$key]->INV_EMATERAI_EFECTIVE = date('Y-m-d', strtotime($value->INV_EMATERAI_EFECTIVE));
			$data['data'][$key]->INV_EMATERAI_END = date('Y-m-d', strtotime($value->INV_EMATERAI_END));
			$data['data'][$key]->action = '<button type="button" id="INV_ENTITY_CODE'.$num.'" onclick="editmaterai('.$value->INV_EMATERAI_ID.')" class="btn btn-primary btn-sm" ><i class="fa fa-pencil-square"></i></button>';
			// $data['data'][$key]['action'] = "action";
			$num++;
		}

		echo json_encode($data);
	}

	function mastermateraisave(){

		//cara pertama
		$data = ($_POST);
		// print_r($data);	die;
		// $code = array('INV_ENTITY_ID'=>$data['INV_ENTITY_ID']);
		// $result1 = $this->senddataurl('entity/search/',$code,'POST');
		// foreach ($result1 as $row) {
		// 	$data['INV_ENTITY_ID']=$row->INV_ENTITY_ID;
		// }
		$result = $this->senddataurl('materai',$data,'PUT');
		echo json_encode($result);
	}

	function mastermateraiedit(){
		$data2 = ($_POST);
		$id=$_POST['INV_EMATERAI_ID'];
		$data  =  $this->getdataurl('materai/'.$id);
		echo json_encode($data);
	}

	function mastermateraiupdate(){
		$data = ($_POST);
		$result = $this->senddataurl('materai',$data,'POST'); //kalau update ganti PUT jadi POST
		echo json_encode($result);
	}

	function mastermateraihapus(){
		$data = ($_POST);
		$result = $this->senddataurl('materai',$data,'DELETE');
		echo json_encode($result);
	}

	function masterfaktur(){
		$data['prods'] = $this->getdataurl('entity');
		$data['data_materai'] = $this->getdataurl('materai');
		$data['data_faktur'] = $this->getdataurl('faktur');
		$this->common_loader($data,'invoice/administrasi/masterentity/masterentity');
	}

	function masterfaktursearch(){
		$postdata = ($_POST);
		// print_r('123');die;
		$data = $this->senddataurl('faktur/search/',$postdata,'POST');
		$data2 = array(
				'data' => array()
			);
		foreach ($data as $key => $value) {
			$data2['data'][$key] = $value;
			$data2['data'][$key]->INV_FAKTUR_EFECTIVE = date('Y-m-d', strtotime($value->INV_FAKTUR_EFECTIVE));
			$data2['data'][$key]->INV_FAKTUR_EXPIRED = date('Y-m-d', strtotime($value->INV_FAKTUR_EXPIRED));
		}
		// print_r($data);die;
		echo json_encode($data);
	}

	function masterfaktursave(){

		//cara pertama
		$data = ($_POST);
		// $code = array('INV_ENTITY_CODE'=>$data['INV_ENTITY_ID']);
		// $result1 = $this->senddataurl('entity/search/',$code,'POST');
		// foreach ($result1 as $row) {
		// 	$data['INV_ENTITY_ID']=$row->INV_ENTITY_ID;
		// }

		$result = $this->senddataurl('faktur',$data,'PUT');
		// print_r($data);	die;
		echo json_encode($result);

	}

	function masterfakturedit(){
		$data1 = ($_POST);
		$id=$_POST['INV_FAKTUR_ID'];

		$data  =  $this->getdataurl('faktur/'.$id);
		echo json_encode($data);
	}

	function masterfakturupdate(){

		//cara pertama
		$data = ($_POST);
		$result = $this->senddataurl('faktur',$data,'POST'); //kalau update ganti PUT jadi POST
		echo json_encode($result);
	}

	function masterfakturhapus(){
		$data = ($_POST);
		$result = $this->senddataurl('faktur',$data,'DELETE');
		echo json_encode($result);
	}

	//MASTERBANK
	function masterbanksearch(){
		$postdata = ($_POST);
		// print_r('123');die;
		$data = $this->senddataurl('bank/search/',$postdata,'POST');
		// print_r($data);die;
		echo json_encode($data);
	}

	function masterbanksave(){

		//cara pertama
		$data = ($_POST);
		$result = $this->senddataurl('bank',$data,'PUT');
		echo json_encode($result);

	}

	function masterbankedit(){
		$data1 = ($_POST);
		$id=$_POST['INV_BANK_ID'];

		$data  =  $this->getdataurl('bank/'.$id);
		echo json_encode($data);
	}

	function masterbankupdate(){

		//cara pertama
		$data = ($_POST);
		$result = $this->senddataurl('bank',$data,'POST'); //kalau update ganti PUT jadi POST
		echo json_encode($result);
	}

	function masterbankhapus(){
		$data = ($_POST);
		$result = $this->senddataurl('bank',$data,'DELETE');
		echo json_encode($result);
	}
	//ENDMASTERBANK

	#mastersignbank
	function mastersignbanksearch(){
		$postdata = ($_POST);
		// print_r('123');die;
		$data = $this->senddataurl('signbank/search/',$postdata,'POST');
		// print_r($data);die;
		echo json_encode($data);
	}

	function mastersignbanksave(){

		//cara pertama
		$data = ($_POST);
		$result = $this->senddataurl('signbank',$data,'PUT');
		echo json_encode($result);

	}

	function mastersignbankedit(){
		$data1 = ($_POST);
		$id=$_POST['INV_SIGNBANK_ID'];

		$data  =  $this->getdataurl('signbank/'.$id);
		echo json_encode($data);
	}

	function mastersignbankupdate(){
		//cara pertama
		$data = ($_POST);
		$result = $this->senddataurl('signbank',$data,'POST'); //kalau update ganti PUT jadi POST
		echo json_encode($result);
	}

	function mastersignbankhapus(){
		$data = ($_POST);
		$result = $this->senddataurl('signbank',$data,'DELETE');
		echo json_encode($result);
	}
	#endmastersignbank


	public function upload_img($req,$varfile,$param)
	{
		// if (!$this->session->userdata('uname_phd'))
		// {
		// 	redirect(ROOT.'main', 'refresh');
		// }
		$file = '';

		try
        {
			if($varfile=='INV_ENTITY_LOGO')
			{
				$folderfile='uploads/entity';
				$ext = pathinfo($_FILES['INV_ENTITY_LOGO']['name'], PATHINFO_EXTENSION);
				$file = basename($param['INV_ENTITY_CODE']."_".$param['INV_ENTITY_NAME'], '.'.$ext);
				if ($file != "") {
					$file = $file.'-'.time();
				}
			}
			if($varfile=='INV_ENTITY_LOGO1')
			{
				$folderfile='uploads/entity';
				$ext = pathinfo($_FILES['INV_ENTITY_LOGO1']['name'], PATHINFO_EXTENSION);
				$file = basename($param['INV_ENTITY_CODE']."_".$param['INV_ENTITY_NAME'], '.'.$ext);
				if ($file != "") {
					$file = $file.'-'.time();
				}
			}

			$path= UPLOADFOLDER_.$folderfile;
			$config = array(
				'upload_path' => $path,
				'allowed_types' => "gif|jpg|png|jpeg",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				//'max_height' => "768",
				'file_name' => sha1($file),
				//'max_width' => "1024"
			);

			$this->load->library('upload');
            $this->upload->initialize($config);

			$this->upload->do_upload($varfile);
			$data=$this->upload->data();
			$fullpath=APP_ROOT.$folderfile."/".$data['file_name']; //file_name
			// echo $this->upload->display_errors('<p>', '</p>');

			$fullfile = $path."/".$data['file_name']; //full file_name
			log_message('debug', 'value fullfile: '.$fullfile);
			// $this->scan_virus($fullfile); //scan file disini

			injek($folderfile);
			injek($req);
			injek($fullpath);
			injek($data['file_name']);

			return $data['orig_name'];
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            echo show_error($err->getMessage());
			return "";
		}
	}
	public function scan_virus($file) {
		/* contoh result scan clamav
		file valid				-> index.php: OK ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 0 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 13.927 sec (0 m 13 s)
		file terinfeksi virus	-> eicar.com.txt: Eicar-Test-Signature FOUND ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 1 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 14.098 sec (0 m 14 s) */
		$scan_process = shell_exec('clamscan '.$file);
		log_message('debug', 'hasil scan: '.$scan_process);
		if(strpos($scan_process, 'OK') != false) {
			log_message('debug', 'hasil scan file: '.$file.' tidak terinfeksi virus.');
			return 'lolos';
		} else {
			log_message('debug', 'hasil scan file: '.$file.' terinfeksi virus');
			return 'infected';
		}
	}


	public function common_loader($data,$views) {
		if (! $this->session->userdata('is_login') ){
		 	redirect(ROOT.'main_invoice', 'refresh');
		}
		$role_id =  $this->session->userdata('role_id')	;
		$data['role_child'] = $this->auth_model->get_child_role($role_id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function redirect(){
		if (!$this->session->userdata('uname_phd'))
		{
			redirect(ROOT.'main', 'refresh');
		}
	}

}
