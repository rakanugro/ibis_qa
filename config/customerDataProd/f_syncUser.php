<?php

/*|
 | Function Name 	: syncData
 | Description 		: synchronization user simkapal for agent
 | Creator			: Ibnu Alam
 | Creation Date	: 04/09/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function syncUser($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$id = $xml_data->data->id;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$already_insert_customer=false;
		$already_insert_agen=false;
		$already_insert_user=false;
		
		$out_data = array();
		$data = array(
						'update_status' 	=> 'F',
						'update_message' 	=> 'ERR'
						);

		$out_data['respons']=$data;
		
		//GET ibis user data
		{
			//PL/SQL
			$sql_get_ibis_user_data = "select user_id,real_name,info_email_address,customer_id from mst_customer_skapal_user where customer_id = '$id'";

			//QUERY
			if(!checkOriSQL($conn['ori']['ibis'],$sql_get_ibis_user_data,$query_get_ibis_user_data,$err)) goto Err;
			$row_get_ibis_user_data = oci_fetch_array($query_get_ibis_user_data, OCI_ASSOC);
			
			$user_id = $row_get_ibis_user_data[USER_ID]!="" ? $row_get_ibis_user_data[USER_ID] : "";
			$real_name = $row_get_ibis_user_data[REAL_NAME]!="" ? $row_get_ibis_user_data[REAL_NAME] : "";
			$email = $row_get_ibis_user_data[INFO_EMAIL_ADDRESS]!="" ? $row_get_ibis_user_data[INFO_EMAIL_ADDRESS] : "";
		}
		
		//GET kode agen kapal & jumlah user
		{
			//PL/SQL
			$sql_get_kapal_user = "select kd_agen from mst_agen where no_account = '$id'";
			//QUERY
			if(!checkOriSQL($conn['ori']['kapal'],$sql_get_kapal_user,$query_get_kapal_user,$err)) goto Err;
			$row_get_kapal_user = oci_fetch_array($query_get_kapal_user);
			
			$kd_agen = $row_get_kapal_user[KD_AGEN];

			//PL/SQL
			$sql_get_jumlah_user_kapal = "select count(*) as jumlah_user from acl_user where tipe_agen = '$kd_agen'";

			//QUERY
			if(!checkOriSQL($conn['ori']['kapal'],$sql_get_jumlah_user_kapal,$query_get_jumlah_user_kapal,$err)) goto Err;

			$row_get_jumlah_user_kapal = oci_fetch_array($query_get_jumlah_user_kapal, OCI_ASSOC);
			
			$jumlah_user = $row_get_jumlah_user_kapal[JUMLAH_USER];
		}
		
		//INSERT OR UPDATE user
		{
			$password = "123456";//default password
			$kd_cabang = "01";//hardcoded
			$enabled = "1";//hardcoded
			
			if($jumlah_user==0)//insert new user
			{
				//PL/SQL
				$sql_insert_user_kapal = "insert into acl_user (userid,password,realname,email,enabled,tipe_agen,kd_cabang) 
														values ('$user_id','$password','$real_name','$email','$enabled','$kd_agen','$kd_cabang')";

				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$sql_insert_user_kapal,$query_insert_user_kapal,$err)) goto Err;
				
				//PL/SQL
				$sql_insert_user_kapal = "insert into acl_group_member (groupname,userid,user_entry) 
														values ('PELANGGAN_INTERNAL','$user_id','admin')";

				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$sql_insert_user_kapal,$query_insert_user_kapal,$err)) goto Err;
				
			}
			else//update user
			{
				//PL/SQL
				$sql_update_user_kapal = "update acl_user set 
															realname='$real_name',
															email='$email',
															enabled='$enabled',
															kd_cabang='$kd_cabang' 
															where tipe_agen = '$kd_agen'";

				//QUERY
				if(!checkOriSQL($conn['ori']['kapal'],$sql_update_user_kapal,$query_update_user_kapal,$err)) goto Err;
			}

			$data['update_status']="S";
			$data['update_message']="SUCCESS";
		}
		
		$out_data['respons']=$data;
		
		if($error)
			goto Err;
		else 
			goto Success;

	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}

	/*------------------------------------------ERROR-------------------------------------------------------------*/
	Err:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($err=="") $err = "ERR";
		if($out_status=="") $out_status = "F";
		return generateResponse($out_data, $out_status, $err, "json");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS". $err;
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "json");
}

?>