<?php
class Auth_model extends CI_Model {

public function __construct(){
		$this->forum = $this->load->database("forum",TRUE);
		$this->forum->reconnect();
		// $this->load->database();
	}

	//public function is_expired_periode($user_id,$role_id) {
	public function is_expired_periode($user_id) {
		$user_id = $user_id;
		//$role_id = $role_id;
		//
		//$query = "SELECT * FROM INV_MST_USERROLE WHERE INV_ROLE_ID=? AND INV_USER_ID=? AND TO_DATE (SYSDATE, 'dd-mm-yyyy') BETWEEN TO_DATE (INV_USERROLE_EFECTIVE, 'dd-mm-yyyy') AND TO_DATE (INV_USERROLE_EXPIRED, 'dd-mm-yyyy')";
		$query = "SELECT * FROM INV_MST_USERROLE WHERE INV_USER_ID=? AND TO_DATE (SYSDATE, 'dd-mm-yyyy') BETWEEN TO_DATE (INV_USERROLE_EFECTIVE, 'dd-mm-yyyy') AND TO_DATE (INV_USERROLE_EXPIRED, 'dd-mm-yyyy')";

		//$result = $this->forum->query($query,array($role_id,$user_id));
		$result = $this->forum->query($query,array($user_id));

		$num = $result->num_rows();
		if($num > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_by_username($username) {
		$username = addslashes($username);
		$query 	= "SELECT
					A.INV_USER_ID,
					A.INV_USER_USERNAME,
					A.INV_USER_NAME,
					A.INV_USER_PASSWORD,
					A.INV_USER_NIPP,
					A.INV_USER_ROLE_ID,
					A.INV_USER_ENTITY_ID,
					A.INV_USER_STATUS,
					B.INV_ROLE_TYPE,
					B.INV_ENTITY_CODE

					FROM INV_MST_USER A
					LEFT JOIN  INV_MST_ROLE B
					ON a.INV_USER_ROLE_ID =  B.INV_ROLE_ID

					WHERE A.INV_USER_USERNAME=?";

		$result =  $this->forum->query($query,array($username));
		// print_r($this->forum);die();

		return $result->row();
	/*	$this->forum->select(*);
		$this->forum->from('INV_MST_USER A');
		$this->forum->join('INV_MST_ROLE B','a.INV_USER_ROLE_ID','B.INV_ROLE_ID');
		$this->forum->where('A.INV_USER_USERNAME',$username);*/
	}

	public function get_by_username_password($username, $password){
		//$username = addslashes($username);
		//$password = addslashes($password);

		$query 	= "SELECT
					A.INV_USER_ID,
					A.INV_USER_USERNAME,
					A.INV_USER_PASSWORD,
					A.INV_USER_NIPP,
					A.INV_USER_ROLE_ID,
					A.INV_USER_ENTITY_ID,
					A.INV_USER_STATUS,
					B.INV_ROLE_TYPE,
					B.INV_ENTITY_CODE

					FROM INV_MST_USER A
					LEFT JOIN  INV_MST_ROLE B
					ON a.INV_USER_ROLE_ID =  B.INV_ROLE_ID

					WHERE A.INV_USER_USERNAME=? AND A.INV_USER_PASSWORD=? ";

		$result =  $this->forum->query($query,array($username,$password));

		return $result->row();



	}

	public function get_child_role($role_id){
		$user_id = $this->session->userdata('user_id');
		$role_id = $role_id;

		$query 	= "SELECT a.*,b.INV_UNIT_CODE FROM INV_MST_USERROLE a inner join INV_MST_ROLE b on a.INV_ROLE_ID =  b.INV_ROLE_ID
		/*	WHERE TO_DATE(a.INV_USERROLE_EXPIRED ,'YYYY-MM-dd') >= TO_DATE(SYSDATE, 'YYYY-MM-dd')  */
			WHERE a.INV_USERROLE_EXPIRED >= SYSDATE
			AND  a.INV_USER_ID=? ORDER BY a.INV_ROLE_NAME ASC";

		$result =  $this->forum->query($query,array($user_id));
		return $result->result();
	}

	public function get_filter_role($role_id){
		$role_id = $this->session->userdata('role_id');
		$role_type = $this->session->userdata('role_type');


		switch ($role_type) {
   				case "Super Admin":

   						$query = "SELECT b.INV_UNIT_CODE, b.INV_UNIT_NAME, b.INV_UNIT_ORGID,
										 b.INV_UNIT_NAME || ' (' || b.INV_UNIT_ORGID || ')' INV_UNIT_NAME_DISP
									   , (b.INV_UNIT_CODE||'-'||b.INV_UNIT_ORGID) INV_CODE_ORGID
									FROM INV_MST_UNIT b GROUP BY b.INV_UNIT_CODE, b.INV_UNIT_NAME, b.INV_UNIT_ORGID
									";
        		break;

        		case "Admin Entity" :


        		$query 	= "SELECT c.INV_UNIT_CODE, c.INV_UNIT_NAME
						FROM INV_MST_USER a
						INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID = b.INV_ROLE_ID
						INNER JOIN INV_MST_UNIT c on b.INV_ENTITY_CODE = c.INV_ENTITY_CODE
						WHERE a.INV_USER_ROLE_ID = ?  GROUP BY c.INV_UNIT_CODE, c.INV_UNIT_NAME ";

        		break;

        		case "Admin Unit" :

        		$user_id = $this->session->userdata('user_id');
					$query = "SELECT * from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy') AND a.INV_USER_ID=".$user_id."";
        		break;
        		case "Customer Service" :

        		$user_id = $this->session->userdata('user_id');
					$query = "SELECT * from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy') AND a.INV_USER_ID=".$user_id."";
        		break;

        		case "User" :

				$user_id = $this->session->userdata('user_id');
					$query = "SELECT *
					from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
					WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
					AND a.INV_USER_ID=".$user_id."";

        		break;

						case "Billing VA" :

						$user_id = $this->session->userdata('user_id');
						$query = "SELECT *
						from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
						WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
						AND a.INV_USER_ID=".$user_id."";

        		break;

						case "Super Admin VA" :

						$user_id = $this->session->userdata('user_id');
						$query = "SELECT *
						from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
						WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
						AND a.INV_USER_ID=".$user_id."";

        		break;

						case "Admin VA" :

						$user_id = $this->session->userdata('user_id');
						$query = "SELECT *
						from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
						WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
						AND a.INV_USER_ID=".$user_id."";

        		break;

						case "Keuangan VA" :

						$user_id = $this->session->userdata('user_id');
						$query = "SELECT *
						from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
						WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
						AND a.INV_USER_ID=".$user_id."";

        		break;

						case "Customer/Self Service" :

						$user_id = $this->session->userdata('user_id');
						$query = "SELECT *
						from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
						WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
						AND a.INV_USER_ID=".$user_id."";

        		break;
        	}

        	$result =  $this->forum->query($query,array($role_id));
        	 return $result->result();

	}

	public function get_lastrole($role_id){

	$user_id = $this->session->userdata('user_id');
	$role_id = $role_id;

	/*$query 	= "SELECT MIN(XX.INV_ROLE_ID) ROLE
			FROM
			(
			SELECT * FROM INV_MST_USERROLE a
			WHERE TO_DATE(a.INV_USERROLE_EXPIRED ,'YYYY-MM-dd') >= TO_DATE(SYSDATE, 'YYYY-MM-dd')
			AND  a.INV_USER_ID=?) xx";*/
			//dd-mm-yyyy
			$query 	= "SELECT MIN(XX.INV_ROLE_ID) ROLE
					FROM
					(
					SELECT * FROM INV_MST_USERROLE a
					WHERE TO_DATE(a.INV_USERROLE_EXPIRED ,'dd-mm-yyyy') >= TO_DATE(SYSDATE, 'dd-mm-yyyy')
					AND  a.INV_USER_ID=?) xx";

	/*$query2 = "SELECT *
			from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
			WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'YYYY-MM-dd')
			AND a.INV_USER_ID=?";*/
			$query2 = "SELECT *
					from INV_MST_USER a INNER JOIN INV_MST_ROLE b on a.INV_USER_ROLE_ID =  b.INV_ROLE_ID
					WHERE  a.INV_USER_EXPIRED > TO_DATE(SYSDATE, 'dd-mm-yyyy')
					AND a.INV_USER_ID=?";


	$result =  $this->forum->query($query,array($user_id));

	$hasil =  $result->row();

	if(count($hasil)>1){

		$result =  $this->forum->query($query,array($user_id));

	    return $result->result();

	} else {


		$result =  $this->forum->query($query2,array($user_id));

		 return $result->row();

	}
}


	public function change_role($user_id, $role_id){
		$role_id = $role_id;
		$user_id  = $user_id;

		$query = "SELECT *
			FROM INV_MST_ROLE a
			WHERE a.INV_ROLE_ID=?";

		$result =  $this->forum->query($query,array($role_id));
		 return $result->row();
	}


	public function get_layanan($role_id){
		$role_id = $role_id;
		$query 	= "
			SELECT * FROM INV_MST_ROLE a
			INNER JOIN INV_MST_UNIT b ON a.INV_UNIT_CODE = b.INV_UNIT_CODE
			WHERE a.INV_ENTITY_CODE = b.INV_ENTITY_CODE and a.INV_ROLE_ID=?";
		$result =  $this->forum->query($query,array($role_id));

		file_put_contents("C:\DEBUGPORTAL\get_layanan.txt", print_r(
         	array(
         		"query" => $query,
         		"result" => $result,
         ),true), FILE_APPEND);

		return $result->row();
	}



	public function check_unit_org(){
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 1) {
			$query 	= "	SELECT distinct b.INV_UNIT_ORGID
							--a.INV_ROLE_ID,a.INV_ROLE_TYPE,b.INV_UNIT_CODE,b.INV_UNIT_ORGID
					FROM  INV_MST_ROLE a
					INNER JOIN INV_MST_UNIT b ON a.INV_UNIT_CODE = b.INV_UNIT_CODE
					WHERE a.INV_ENTITY_CODE = b.INV_ENTITY_CODE";
		} else {
			$query 	= "	SELECT a.INV_ROLE_ID,a.INV_ROLE_TYPE,b.INV_UNIT_CODE,b.INV_UNIT_ORGID
					FROM  INV_MST_ROLE a
					INNER JOIN INV_MST_UNIT b ON a.INV_UNIT_CODE = b.INV_UNIT_CODE
					WHERE a.INV_ENTITY_CODE = b.INV_ENTITY_CODE AND a.INV_ROLE_ID=? ";
		}

		file_put_contents("C:\DEBUGPORTAL\check_unit_org.txt", print_r(
         	array(
         		"query" => $query,
         		"role_id" => $role_id,
         ),true), FILE_APPEND);

		$result =  $this->forum->query($query,array($role_id));
		// return $result->row();
		return $result->result_array();
	}


	public function get_menuList($id){
		$id = $id;

		$query = "SELECT ID_MENU, MENU_IDN AS MENU, LINK, PARENT,LINK_TARGET  FROM INV_MENU_NAV
						 ORDER BY PARENT, PRIORITY,ID_MENU ASC";
		$query 	= $this->forum->query($query);
				return $query->result_array();
	}

	public function get_subentity($code){

		$query 	= "
			SELECT * FROM INV_MST_UNIT  a
			WHERE a.INV_ENTITY_CODE=?";
		$result =  $this->forum->query($query,array($code));
		return $result->result();


	}

	public function get_entity($code){

		$query 	= "
			SELECT a.INV_UNIT_CODE,b.*,ROWNUM b_rownum
			FROM INV_MST_UNIT a INNER  JOIN INV_MST_ENTITY b ON a.INV_ENTITY_CODE = b.INV_ENTITY_CODE
			WHERE a.INV_UNIT_CODE=? AND ROWNUM=1
			ORDER BY a.INV_UNIT_CODE";
		$result =  $this->forum->query($query,array($code));
		return $result->row();

	}


	public function get_nota_redaksi($id, $layanan){
		$query 	= "
			SELECT INV_MST_REDAKSI.INV_REDAKSI_NOTE,INV_MST_REDAKSI.INV_REDAKSI_ATAS,
					case
					when (substr(nvl(XEINVC_AR_INVOICE_HEADER.TRX_NUMBER_PREV,XEINVC_AR_INVOICE_HEADER.trx_number),1,3) in ('080','070'))
						 and (PPN_DIBEBASKAN is not null or (PPN_TIDAK_DIPUNGUT is not null)) then
						 INV_MST_REDAKSI.INV_REDAKSI_PAJAK
					else null
				   end INV_REDAKSI_PAJAK FROM XEINVC_AR_INVOICE_HEADER
			LEFT JOIN INV_MST_UNIT ON XEINVC_AR_INVOICE_HEADER.ORG_ID = INV_MST_UNIT.INV_UNIT_ORGID
			LEFT JOIN INV_MST_REDAKSI ON INV_MST_UNIT.INV_UNIT_ID = INV_MST_REDAKSI.INV_UNIT_ID
			WHERE XEINVC_AR_INVOICE_HEADER.BILLER_REQUEST_ID='".$id."' AND INV_MST_REDAKSI.INV_NOTA_JENIS LIKE '".$layanan."'";
			 // echo "====>";die();
	    // echo "===x";print_r($this->forum);die();
		/*$this->forum->select('*');
	    $this->forum->from('XEINVC_AR_INVOICE_HEADER');
	    $this->forum->join('INV_MST_UNIT','XEINVC_AR_INVOICE_HEADER.ORG_ID = INV_MST_UNIT.INV_UNIT_ORGID','LEFT');
	    $this->forum->join('INV_MST_REDAKSI','INV_MST_UNIT.INV_UNIT_ID = INV_MST_REDAKSI.INV_UNIT_ID','LEFT');
	    $this->forum->where('XEINVC_AR_INVOICE_HEADER.BILLER_REQUEST_ID',$id);
	    $this->forum->like('INV_MST_REDAKSI.INV_NOTA_JENIS',$layanan);*/
		    // $num3 = $this->forum->count_all_results();
		// $query = $this->forum->get();
        // $result = $query->result_array();
        // echo "===>";print_r($query);die();
			 // echo $id.", ".$layanan.$query;die();
		$result =  $this->forum->query($query);
		// print_r($result);die();
		return $result->row();

	}
	public function get_nota_redaksi2($id, $layanan){
		$query 	= "
			SELECT INV_MST_REDAKSI.INV_REDAKSI_NOTE,INV_MST_REDAKSI.INV_REDAKSI_ATAS,INV_MST_REDAKSI.INV_REDAKSI_BAWAH,
				   case
					when (substr(nvl(XEINVC_AR_INVOICE_HEADER.TRX_NUMBER_PREV,XEINVC_AR_INVOICE_HEADER.trx_number),1,2) in ('08','07'))  --3) in ('080','070')) --update cetakan REDAKSI PPN DIBEBASKAN 12-11-19 BY SIGMA
						 and (PPN_DIBEBASKAN is not null or (PPN_TIDAK_DIPUNGUT is not null)) then
						 INV_MST_REDAKSI.INV_REDAKSI_PAJAK
					else null
				   end INV_REDAKSI_PAJAK FROM XEINVC_AR_INVOICE_HEADER
			LEFT JOIN INV_MST_UNIT ON XEINVC_AR_INVOICE_HEADER.ORG_ID = INV_MST_UNIT.INV_UNIT_ORGID
			LEFT JOIN INV_MST_REDAKSI ON INV_MST_UNIT.INV_UNIT_ID = INV_MST_REDAKSI.INV_UNIT_ID
			WHERE XEINVC_AR_INVOICE_HEADER.BILLER_REQUEST_ID='".$id."' AND INV_MST_REDAKSI.INV_NOTA_JENIS LIKE '".$layanan."'";
			// echo $query;die();
		$result =  $this->forum->query($query);
		// print_r($result);die();
		return $result->row();

	}

	public function get_unit_org($unit_id){
		$vunit_id = $unit_id;
		$query = "SELECT b.INV_UNIT_CODE, b.INV_UNIT_NAME, b.INV_UNIT_ORGID,
										 b.INV_UNIT_NAME || ' (' || b.INV_UNIT_ORGID || ')' INV_UNIT_NAME_DISP
									   , (b.INV_UNIT_CODE||'-'||b.INV_UNIT_ORGID) INV_CODE_ORGID
									FROM INV_MST_UNIT b
									WHERE (b.INV_UNIT_CODE||'-'||b.INV_UNIT_ORGID) = '".$vunit_id."'
									GROUP BY b.INV_UNIT_CODE, b.INV_UNIT_NAME, b.INV_UNIT_ORGID
									";

		$result =  $this->forum->query($query);
		 return $result->row();
	}

}

?>
