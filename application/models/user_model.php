<?php
class User_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
	
	public function check_user($username, $pass, $lang)
	{
		log_message('debug','<< check_user: '.$username);
		$query 	= "SELECT A.USERNAME,
						   A.PASSWORD,
						   A.NAME,
						   A.ID_GROUP,
						   A.ID_SUB_GROUP,
						   a.enabled,
						   D.CUSTOMER_ID,
						   D.NAME CUSTOMER_NAME,
						   D.ALT_NAME,
						   D.ADDRESS,
						   D.NPWP,
                           A.CUSTOMER_ID CUST_ID,
						   A.USER_ID_SIMOP,
						   A.EXTERNAL_ID,--new 03/30/2016
						   A.BRANCH_ID,--new 03/30/2016
						   A.REGISTRATION_COMPANY_ID, --new 03/30/2016
						   A.IS_PPJK 
					  FROM MST_USER A
						   INNER JOIN MST_GROUP B
							  ON A.ID_GROUP = B.ID_GROUP
						   LEFT JOIN MST_CUSTOMER_BILLING_ACCOUNT C
							  ON A.CUSTOMER_ID = C.BILLING_CUSTOMER_ID 
						   LEFT JOIN MST_CUSTOMER D 
							  ON C.CUSTOMER_ID = D.CUSTOMER_ID
					 WHERE USERNAME=?";
		$query 	= $this->db->query($query,array($username));
	
		if($query->num_rows() > 0)
		{
			$row	= $query->row_array();
				
			$md5_string = md5($pass.$row['USERNAME']);
			
			if($row['ENABLED'] == 0){
				
				//AP08
				log_message('debug','<< Delete count for '.$username);
				$this->delete_count_account($username);
				
				return 'disabled';
			}
			
			if($row['PASSWORD']==$md5_string){
			
				//AP12
				if($this->isUserActive($username)){
					log_message('debug','<< '.$username.' has been actived, will destroy!');
								
					$this->kick_account($username);
					log_message('debug','<< previos session user '.$username.' destroyed!');
				}	
			
				$this->session->set_userdata(array(
					'uname_phd' => $row["USERNAME"], 
					'name_phd'=> $row["NAME"],
					'group_phd'=> $row["ID_GROUP"],
					'sub_group_phd'=> $row["ID_SUB_GROUP"],
					'customerid_phd'=> $row["CUST_ID"],
					'customeridppjk_phd'=> $row["CUST_ID"],
					'custid_phd' => $row["CUST_ID"],
					'userid_simop' => $row["USER_ID_SIMOP"],
					'customername_phd' => $row["CUSTOMER_NAME"],
					'customernamealt_phd' => $row["ALT_NAME"],
					'address_phd' => $row["ADDRESS"],
					'npwp_phd' => $row["NPWP"],
					'lang_phd' => $lang,
					'externalid_phd'=> $row["BRANCH_ID"],
					'branchid_phd'=> $row["BRANCH_ID"],
					'is_ppjk_phd'=> $row["IS_PPJK"],
					'eservice'=> TRUE,
					'einvoice'=> FALSE,							
					'un'=> $username
				));
			
				
				if($row["REGISTRATION_COMPANY_ID"]!="")
					$this->session->set_userdata('registrationcompanyid_phd', $row["REGISTRATION_COMPANY_ID"]);

				$query2 = "UPDATE MST_USER
							   SET LAST_LOGIN = SYSDATE
							 WHERE USERNAME = ?";
				$this->db->query($query2,array($username));
				
				//AP12 lock as active user
				$this->LOCK_ACCOUNT($username,$this->session->userdata('session_id'));
				log_message('debug','< User '.$username.' is active!');
				//end AP12
				
				//AP08
				$this->delete_count_account($username);
				
				log_message('info','< Succes login!');
				return "success";
				
			}else{
				
				//AP08 cek ke table LOCK_ACCOUNT
				$this->count_account($username);
				
				log_message('info','< Failed login!');
				return "failed";
			}
		}
		return "failed";
	}

	
	//--------------------------------------- AP12 -----------------------------------------
	public function get_user_count($username){
		log_message('debug','>>> get_user_count');
		$query = "SELECT USERNAME, COUNT FROM LOCK_ACCOUNT WHERE FLAG=0 AND USERNAME = ?";
		$rs = $this->db->query($query,array($username))->row();
		return $rs;
	}
	
	
	public function getAllUserActive(){
		log_message('debug','>>> getAllUserActive');
		$query = "SELECT ID, USERNAME FROM LOCK_ACCOUNT WHERE FLAG=1";
		$data = $this->db->query($query);	
		return $data;
	}
	
	
	public function isUserLogin($sessid){
		log_message('debug','>>> isUserLogin: '.$sessid);
		$query = "SELECT ID FROM LOCK_ACCOUNT WHERE FLAG=1 AND SESSION_ID = ?";
		$data = $this->db->query($query,array($sessid));
		log_message('debug','>>> row: '.$data->num_rows());
		if($data->num_rows() > 0){
			return true;
		}else
			return false;
	}
	
	//AP12
	/**
	* Mengecek apakah user aktif
	*/
	public function isUserActive($username){
		log_message('debug','>>> isUserActive');
		$query = "SELECT ID FROM LOCK_ACCOUNT WHERE FLAG=1 AND USERNAME = ?";
		$data = $this->db->query($query,array($username));
		if($data->num_rows() > 0){
			return true;
		}else
			return false;
	}
	
	/**
	* Mengunci user agar tidak terjadi concurrent user
	*/
	public function LOCK_ACCOUNT($username,$sessid){
		
		log_message('debug','>>> LOCK_ACCOUNT');
		$max_id = $this->db->query("SELECT MAX(ID) ID FROM LOCK_ACCOUNT")->row()->ID;
		
		$query = " insert into LOCK_ACCOUNT (id, username, flag,session_id,group_id)	values (?,?,?,?,?)";
		$result = $this->db->query($query,array($max_id+1, $username,1,$sessid,$this->session->userdata('group_phd')));
	}
	
	/**
	* Menghapus status lock user 
	*/
	public function kick_account($username){
		log_message('debug','>>> kick_account');

		
		$query = " delete ".$this->session->sess_table_name." WHERE EXISTS
				(SELECT session_id FROM LOCK_ACCOUNT WHERE username='".$username."')";
		$result = $this->db->query($query,array($username));
		
		$query = " delete LOCK_ACCOUNT where FLAG=1 AND username = ? ";
		$result = $this->db->query($query,array($username));
		log_message('debug','>>> kicked '.$username);
			
		
	}
	
	/**
	* Menyimpan session id 7 ll
	*/
	public function saveSession(){
		//log_message('debug','>>> saveSession');
		//mencegah error kalau session_id yg sama di insert kembali
		$query="delete ".$this->session->sess_table_name." where session_id = '".$this->session->userdata['session_id']."'";
		$this->db->query($query);
		
		$query="INSERT INTO ".$this->session->sess_table_name." (session_id, ip_address, user_agent, last_activity, user_data) VALUES 
			        ('".$this->session->userdata['session_id']."',
					'".$this->session->userdata['ip_address']."',
					'".$this->session->userdata['user_agent']."',
					'".$this->session->userdata['last_activity']."','')";
			$this->db->query($query);
	}

	public function checkSession(){
		$query = 'select count(session_id) ID
					from LOCK_ACCOUNT 
					where session_id=\''.$this->session->userdata('session_id').'\'';

		$result = $this->db->query($query)->row_array();
		//---------------------------
		
		if($result['ID']>0 )
			return true;
		else
			return false;
	}
	
	public function deleteSession(){
		//log_message('debug','>>> saveSession');
		//mencegah error kalau session_id yg sama di insert kembali
		$query="delete ".$this->session->sess_table_name." where session_id = '".$this->session->userdata['session_id']."'";
		$this->db->query($query);
	}
	
	/** 
	* AP12
	* Menyimpan session id & captcha
	*/
	public function saveCaptcha($sessid,$captcha){
		log_message('debug','>>> saveCaptcha');
		
		$this->session->set_userdata('captcha', $captcha);
		
		/*$query = "select count(*) ID
					from ".$this->session->sess_table_name."
					where session_id='".$this->session->userdata('session_id')."'";

		$result = $this->db->query($query)->row_array();
		//---------------------------
		
		if($result['ID']>0 )
		{

		}
		else
		{
			$query="INSERT INTO ".$this->session->sess_table_name." (session_id, ip_address, user_agent, last_activity, user_data) VALUES 
						('".$this->session->userdata['session_id']."',
						'".$this->session->userdata['ip_address']."',
						'".$this->session->userdata['user_agent']."',
						'".$this->session->userdata['last_activity']."','')";
				$this->db->query($query);		
		}
		
		$query = " update ".$this->session->sess_table_name." set captcha='".$captcha."' where session_id='".$sessid."'";
		$result = $this->db->query($query,array($captcha));*/	
	}
	
	public function isMatchCaptcha($captcha){
		log_message('debug','>>> isMatchCaptcha');
		
		if($this->session->userdata('captcha')==$captcha)
			return true;
		else 
			return false;
		
		/*$query = "SELECT session_id FROM ".$this->session->sess_table_name." WHERE session_id = '".$this->session->userdata('session_id')."' AND captcha='".$captcha."'";
		$data = $this->db->query($query);
		
		if($data->num_rows() > 0)
			return true;
		else
			return false;*/
	}
	
	
	
	/**
	* Menghitung kesalahan input password pada user
	* jika sampai 3 kali kesalahan maka user akan di disabled
	*/
	public function count_account($username){
		log_message('debug','>>> count_account');
		$flag = 0;
		if (!$this->session->userdata('uname_phd'))
		{
			$flag = 0;
		}
		else
		{
			$flag = 1; //AP08 - bruteforce change password profile
		}
		//$query = "SELECT ID, USERNAME, COUNT FROM LOCK_ACCOUNT WHERE FLAG=0 AND USERNAME = ?";
		$query = "SELECT ID, USERNAME, COUNT FROM LOCK_ACCOUNT WHERE FLAG=? AND USERNAME = ?";
		$data = $this->db->query($query,array($flag, $username));
		$max_id = $this->db->query("SELECT MAX(ID) ID FROM LOCK_ACCOUNT")->row()->ID;
		
		if($data->num_rows() > 0){
			// update count untuk username tersebut
			$query = " update LOCK_ACCOUNT set count = ? where FLAG=? AND  username = ? ";
			$result = $this->db->query($query,array($data->result_array[0]['COUNT']+1, $flag, $username));
		}else{
			// insert ke table LOCK_ACCOUNT
			$query = " insert into LOCK_ACCOUNT (id, username, count, flag)
					values (?,?,?,?)";
			$result = $this->db->query($query,array($max_id+1, $username, 1, $flag));
		}

		if($data->result_array[0]['COUNT'] >= 3){
			// enable mst_user = 0			
			$query = " update mst_user set enabled = ? where username = ? ";
			$result = $this->db->query($query,array(0, $username));
			
			if(isset($result)){
				$query = " delete lock_account where FLAG=? AND username = ? ";
				$result = $this->db->query($query,array($flag, $username));
			}
		}
	}
	

	/**
	* Menghapus record kesalahan user
	*/
	public function delete_count_account($username){
		log_message('debug','>>> delete_count_account');
		$query = "SELECT ID, USERNAME, COUNT FROM LOCK_ACCOUNT WHERE FLAG=0 AND USERNAME = ?";
		$query = $this->db->query($query,array($username));
		if($query->num_rows() > 0){
			// update count untuk username tersebut
			$query = " delete LOCK_ACCOUNT where FLAG=0 AND username = ? ";
			$result = $this->db->query($query,array($username));
		}
	}
	
	//-------------------------------------end AP12---------------------------------------------
	
	
	//--------------------------------------- AP08 ----------------------------------------------
	/**
	* Mengunci forgot password pada user
	*/
	public function lock_reset($username){
		$max_id = $this->db->query("SELECT MAX(ID) ID FROM LOCK_ACCOUNT")->row()->ID;
		$query = " insert into lock_account (id, username, flag)	values (?,?,?)";
		$result = $this->db->query($query,array($max_id+1, $username, 2));
	}
	
	/**
	* Menghitung forgot password pada user
	* jika sudah reset password, tidak bisa reset lagi hingga account diaktifkan
	*/
	public function count_reset($username){
		$flag = 2;
		
		//delete lock kalau sudah expired lebih dari 7 hari
		$query = " delete lock_account where FLAG=2 AND username = ? and (sysdate - create_time) > 7";
		$result = $this->db->query($query,array($username));
			
		$query = "SELECT ID, USERNAME, COUNT FROM LOCK_ACCOUNT WHERE FLAG=? AND USERNAME = ?";
		$data = $this->db->query($query,array($flag, $username));
		
		return $data->num_rows();
	}
	
	/**
	* Menghapus status lock reset password 
	*/
	public function unlock_reset($username){
		$query = "SELECT ID, USERNAME, COUNT FROM LOCK_ACCOUNT WHERE FLAG=2 AND USERNAME = ?";
		$query = $this->db->query($query,array($username));
		if($query->num_rows() > 0){
			// update count untuk username tersebut
			$query = " delete lock_account where FLAG=2 AND username = ? ";
			$result = $this->db->query($query,array($username));
		}
	}
	//------------------------------------ end AP08 --------------------------------------------
	
	public function get_menuList($id_group)
	{
		
		if($this->session->userdata('lang_phd')=='ID'){
			$query = "SELECT ID_MENU, MENU_IDN AS MENU, LINK, PARENT,LINK_TARGET FROM ACL_MENU 
						WHERE AUTHENTICATE LIKE '%$id_group%' and (TAG is null or TAG not like '%$id_group%') and FLAG is null ORDER BY PARENT, PRIORITY ASC";
		} else {
			$query = "SELECT ID_MENU, MENU_ENG AS MENU, LINK, PARENT,LINK_TARGET FROM ACL_MENU 
						WHERE AUTHENTICATE LIKE '%$id_group%' and (TAG is null or TAG not like '%$id_group%') and FLAG is null ORDER BY PARENT, PRIORITY ASC";
		}

		$query 	= $this->db->query($query);
		return $query->result_array();
	}
	
	public function getConsigneeOfPPJKList($userid)
	{
		$query = "select pc.userid, pc.consignee_id, pc.created_date, pc.expired_date, pc.notes, mc.name
				from PPJK_CONSIGNEE pc
				left join mst_customer mc on pc.consignee_id = mc.customer_id 
				where USERID = ?
        ORDER BY CREATED_DATE DESC";

		$query 	= $this->db->query($query, array($userid));
		$hasil=$query->result_array();
		return $hasil;
	}
	
	public function getConsigneeOfPPJK($userid, $consignee)
	{
		$query = "select pc.userid, pc.consignee_id, pc.created_date, pc.expired_date, pc.notes, mc.name, mc.npwp
				from PPJK_CONSIGNEE pc
				left join mst_customer mc on pc.consignee_id = mc.customer_id 
				where USERID = ? and mc.name like ?
        ORDER BY CREATED_DATE DESC";

		$query 	= $this->db->query($query, array($userid, "%".$consignee."%"));
		$hasil=$query->result_array();
		return $hasil;
	}
	
	public function get_terminalList($id_sub_group)
	{
		
		$query = "select PORT, TERMINAL, TERMINAL_NAME 
			from mst_terminal 
			where '$id_sub_group' like '%' || id_sub_group || '%' and active = 'Y'";
		
		$query 	= $this->db->query($query);
		return $query->result_array();
	}

	
	public function get_terminalName($port,$terminal)
	{
		
		$query = "select TERMINAL_NAME 
			from mst_terminal 
			where PORT = ? and TERMINAL = ?";
		
		$result 	= $this->db->query($query,array($port,$terminal));
		$row = $result->row_array();
		return $row['TERMINAL_NAME'];
	}

	
	public function getCountActiveUserDetailbyUsername($username)
	{
	
		$query		= "SELECT * FROM MST_USER 
						WHERE USERNAME = ? and enabled = ?";
		$result 	= $this->db->query($query,array($username,1));
	
		return $result->num_rows();
	}
	
	public function getActiveUserDetailbyUsername($username)
	{
	
		$query		= "SELECT * FROM MST_USER 
						WHERE USERNAME = ? and enabled = ?";
		$result 	= $this->db->query($query,array($username,1));
	
		return $result->row_array();
	}
	
	public function get_content($modul,$key)
	{
		//echo $modul . '<br/>' . $key; die();
		if($this->session->userdata('lang_phd')=='ID'){
			$query = "SELECT CONTENT_IDN AS CONTENT FROM MST_CONTENT WHERE MODUL=? AND KEY=?";
		} else {
			$query = "SELECT CONTENT_ENG AS CONTENT FROM MST_CONTENT WHERE MODUL=? AND KEY=?";
		}
		$result 	= $this->db->query($query,array($modul,$key));
		$row = $result->row_array();
		return $row['CONTENT'];
	}
	
	public function check_username($username){
		$query 	= "SELECT USERNAME
					  FROM MST_USER
					 WHERE USERNAME=?";
		$result 	= $this->db->query($query,array($username));
		
		return $result->num_rows();
	}
	
	public function create_user($username, $encryptedpass, $name, $email, $id_group, $enabled, $created_by, $hash){
		$query = " insert into mst_user (username, password, name, email, id_group, enabled, created_by, created_date, hash)
					values (?,?,?,?,?,?,?,sysdate, ?) ";
		$result = $this->db->query($query,array($username,$encryptedpass,$name,$email,$id_group,$enabled,$created_by, $hash));
		
		return $this->db->affected_rows();
	}
	
	public function get_user($userid,$hash)
	{
		$query 	= "SELECT USERNAME
					  FROM MST_USER
					 WHERE USERNAME=? and HASH = ?";
		$result 	= $this->db->query($query,array($userid,$hash));
		
		return $result->num_rows();
	}

	public function reset_password_request($username, $hash){
		$query = " update mst_user set hash = ? where username = ? ";
		$result = $this->db->query($query,array($hash, $username));
		
		return $this->db->affected_rows();
	}

	public function reset_password($username, $encryptedpass){
		$query = " update mst_user set password = ? where username = ? ";
		$result = $this->db->query($query,array($encryptedpass, $username));
		
		return $this->db->affected_rows();
	}
	
	public function enable_user($userid,$hash)
	{
		$query = "update mst_user set enabled = 1 where username=? and hash = ?";
		$result = $this->db->query($query,array($userid,$hash));
		
		return $result;
	}

	public function email_notification($from, $to, $subject, $content){
		$query = " insert into email_lg (from_email, to_email, html_data, text_data, subject_email)
					values (?,?,?,?,?) ";
		$result = $this->db->query($query, array($from, $to, $content, strip_tags($content), $subject));
		
		return $this->db->affected_rows();
	}
	
	public function update_password($username, $encryptedoldpass, $encryptednewpass){
		$query = " update mst_user set ( password = ? ) 
					where username = ? and password = ? ";
		$result = $this->db->query($query,array($encryptednewpass,$username,$encryptedoldpass));			
	
		return $this->db->affected_rows();
	}
	
	public function update_user($username, $name, $email, $id_group){
		$query = " update mst_user set ( name = ?, email = ?, id_group = ? ) 
					where username = ? ";
		$result = $this->db->query($query,array($name,$email,$id_group,$username));			
	
		return $this->db->affected_rows();
	}
	
	public function delete_user($username){
		$query = " delete from mst_user where username = ? ";
		$result = $this->db->query($query,array($username));
		
		return $this->db->affected_rows();
	}
	
	public function check_privilage($username, $privilage){
		$query = " select count(1) AMT 
					from mst_user u 
					inner join mst_privilage p on p.id_group = u.id_group
					where u.username = '?'
					and p.privilage_type = '?' ";
		$result = $this->db->query($query,array($username,$privilage))->row_array();
		
		return $result['AMT'];
	}
	
		public function get_vessel_info($idjointvessel)
	{
		$query	= "SELECT * FROM MST_SBY_JOINT_VESSEL WHERE ID_JOINT_VESSEL = ?";
		$result = $this->db->query($query,array($idjointvessel));
		return $result->row_array();
	}

	/*
	* Cek hak akses user group terhadap controller
	* 
	*/
 	public function check_user_access($id_group, $controller_name, $method_name="", $method_name2="")
	{
		$m='';
		if($method_name)
			$m = '/'.$method_name;

		if($method_name2)
			$m .= '/'.$method_name2;
		
		//check bypass
		$query = " select count(id_menu) jml 
		from acl_menu 
		where bypass = '1' and link like '$controller_name$m%'";

		$result = $this->db->query($query)->row_array();
		$n=$result['JML'];
		
		if($n>0)
		{
			
		}
		else
		{
			//AP12 ----------------
			$n = 0;
			$query = 'select count(session_id) ID
						from LOCK_ACCOUNT 
						where session_id=\''.$this->session->userdata('session_id').'\'';

			$result = $this->db->query($query)->row_array();
			//---------------------------
			
			if($result['ID']>0 ){
				$query = " select count(id_menu) jml 
						from acl_menu 
						where authenticate like '%$id_group%' and link like '$controller_name$m%'";

				$result = $this->db->query($query)->row_array();
				$n=$result['JML'];
			}
		}
		
		//set last activity to now
		$this->session->set_userdata(array(
					'last_activity' => time()));
					
		if($n>0)
			return true;
		else
			return false;
	}	
	
	public function get_pdf_password($username){
		$query = "select substr(password,-5) pdf_password from mst_user where username=?";
		$result = $this->db->query($query,array($username))->row_array();
		
		return $result['PDF_PASSWORD'];
	}

	public function getUserList()
	{
		$query = "select a.username,a.name, a.email,a.enabled,a.last_login,a.created_by,a.created_date,a.customer_id,a.id_group,a.id_sub_group, 
							b.name as customer_name, c.name_group 
						from mst_user a 
							left join mst_customer b on b.customer_id=a.customer_id 
							left join mst_group c on c.id_group = a.id_group
						order by username ";
		//echo $query;die;
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
	}

	public function getUserDetailbyUsername($username)
	{
	
		$query		= "SELECT a.username,a.name, a.email,a.enabled,to_char(last_login, 'dd-mm-yyyy hh24:mi:ss') as last_login,
								a.created_by,to_char(a.created_date, 'dd-mm-yyyy hh24:mi:ss') as created_date,to_char(a.updated_date, 'dd-mm-yyyy hh24:mi:ss') as updated_date,
								a.customer_id,a.id_group,a.id_sub_group, 
							b.name as customer_name, c.name_group, a.registration_company_id, a.is_ppjk   
						FROM MST_USER a 
							LEFT JOIN MST_CUSTOMER_BILLING_ACCOUNT d on a.customer_id = d.billing_customer_id 
							LEFT JOIN MST_CUSTOMER b on b.customer_id=d.customer_id
							left join mst_group c on c.id_group = a.id_group 
						WHERE USERNAME=?";
		$result 	= $this->db->query($query,$username);
	
		return $result->row_array();
	}
    
	public function getConsigneeByPpjk($username)
	{
		$query		= "SELECT 
               a.consignee_id, b.name
            FROM IBIS.PPJK_CONSIGNEE a
                LEFT JOIN MST_CUSTOMER b ON  a.consignee_id = b.customer_id 
            where a.userid = ? and a.expired_date > sysdate";
		$result 	= $this->db->query($query,$username);
	
		return $result->result_array();
	}
	
	public function getSubGroupName($groupid)
	{
		$query = "select sub_group_name  
						from mst_sub_group
						where id_sub_group=?";
						
		$result 	= $this->db->query($query,array($groupid));
		if ($result->num_rows()>0)
		{
			$result = $result->row_array();
			return $result['SUB_GROUP_NAME'];
		}
		else 
			return "";
		
	}	
	
	public function getCustomerIdByUsername($username)
	{
		$query = "select customer_id   
						from mst_user 
						where username=?";
						
		$result 	= $this->db->query($query,array($username));
		if ($result->num_rows()>0)
		{
			$result = $result->row_array();
			return $result['CUSTOMER_ID'];
		}
		else 
			return "";		
	}
	
	/*Get Port, Company, Holding ID*/
	public function get_idPCH($idsubgroup)
	{
		$query = "select distinct id_port, id_company, id_holding, kode_cabang_simkeu
					from mst_terminal
					where '".$idsubgroup."' like '%' || id_sub_group || '%' and active = 'Y'";
		//echo $query;die;
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
	}
	
	public function get_terminalListCargo($id_sub_group)
	{
		//echo 'ID_SG: '.$id_sub_group;die;
		
		$query = "select PORT, TERMINAL, TERMINAL_NAME, KODE_CABANG_SIMKEU, ID_PORT
			from mst_terminal 
			where '$id_sub_group' like '%' || id_sub_group || '%' and active = 'Y'";
		
		$query 	= $this->db->query($query);
		return $query->result_array();
	}


	//login with token 
	function get_token_ref($token){
		$q = $this->db->query("select * from M_TOKEN_MYCARGO where TOKENS = '$token'")->row_array();
		/* $q = $this->db->select('*')->from('M_TOKEN_MYCARGO')
		->where('TOKENS',$token)
		->get()
		->row_array() */

		return $q;
	}

	public function check_user_token($username, $pass, $lang, $ip = null)
	{
		//Login with data from token 
		log_message('debug','<< check_user_with_token: '.$username);
		$query 	= "SELECT A.USERNAME,
						   A.PASSWORD,
						   A.NAME,
						   A.ID_GROUP,
						   A.ID_SUB_GROUP,
						   a.enabled,
						   D.CUSTOMER_ID,
						   D.NAME CUSTOMER_NAME,
						   D.ADDRESS,
						   D.NPWP,
                           A.CUSTOMER_ID CUST_ID,
						   A.USER_ID_SIMOP,
						   A.EXTERNAL_ID,--new 03/30/2016
						   A.BRANCH_ID,--new 03/30/2016
						   A.REGISTRATION_COMPANY_ID, --new 03/30/2016
						   A.IS_PPJK 
					  FROM MST_USER A
						   INNER JOIN MST_GROUP B
							  ON A.ID_GROUP = B.ID_GROUP
						   LEFT JOIN MST_CUSTOMER_BILLING_ACCOUNT C
							  ON A.CUSTOMER_ID = C.BILLING_CUSTOMER_ID 
						   LEFT JOIN MST_CUSTOMER D 
							  ON C.CUSTOMER_ID = D.CUSTOMER_ID
					 WHERE USERNAME=?";
		$query 	= $this->db->query($query,array($username));
	
		if($query->num_rows() > 0)
		{
			$row	= $query->row_array();		
			if($row['ENABLED'] == 0){
				
				//AP08
				log_message('debug','<< Delete count for '.$username);
				$this->delete_count_account($username);
				
				return 'disabled';
				}
			
			if($row['PASSWORD']==$pass){
			
				//AP12
				if($this->isUserActive($username)){
					log_message('debug','<< '.$username.' has been actived, will destroy!');
								
					$this->kick_account($username);
					log_message('debug','<< previos session user '.$username.' destroyed!');
				}	
			
				$this->session->set_userdata(array(
					'uname_phd' => $row["USERNAME"], 
					'name_phd'=> $row["NAME"],
					'group_phd'=> $row["ID_GROUP"],
					'sub_group_phd'=> $row["ID_SUB_GROUP"],
					'customerid_phd'=> $row["CUST_ID"],
					'customeridppjk_phd'=> $row["CUST_ID"],
					'custid_phd' => $row["CUST_ID"],
					'userid_simop' => $row["USER_ID_SIMOP"],
					'customername_phd' => $row["CUSTOMER_NAME"],
					'address_phd' => $row["ADDRESS"],
					'npwp_phd' => $row["NPWP"],
					'lang_phd' => $lang,
					'externalid_phd'=> $row["BRANCH_ID"],
					'branchid_phd'=> $row["BRANCH_ID"],
					'is_ppjk_phd'=> $row["IS_PPJK"],
					'un'=> $username));
			
				
				if($row["REGISTRATION_COMPANY_ID"]!="")
					$this->session->set_userdata('registrationcompanyid_phd', $row["REGISTRATION_COMPANY_ID"]);

				$query2 = "UPDATE MST_USER
							SET LAST_LOGIN = SYSDATE
							WHERE USERNAME = ?";
				$this->db->query($query2,array($username));
				
				//AP12 lock as active user
				$this->LOCK_ACCOUNT($username,$this->session->userdata('session_id'));
				log_message('debug','< User '.$username.' is active!');
				//end AP12
				
				//AP08
				$this->delete_count_account($username);
				
				log_message('info','< Succes login!');
				return "success";
				
			}else{
				
				//AP08 cek ke table LOCK_ACCOUNT
				$this->count_account($username);
				
				log_message('info','< Failed login!');
				return "failed";
			}
		}
		return "failed";
	}
	
}?>