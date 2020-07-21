<?php
require_once "lib/nusoap.php";

//======= Declare Function Service ========// 

function ePaymentInquiry($notanumber, $userid) {

  //db connection 
  //if ($conn = oci_connect('billing_to3_dom', 'billingto3', '192.168.23.26/dbdev')) 
  //0100131561000022
  $kodeperusahaan=substr($notanumber,3,3);
  if($kodeperusahaan=='013'){
	$schema_name='itos_billing';
	$schema_pwd='itos_BILLING';
	$schema_host='192.168.23.26/dbdev';
  }
  else if($kodeperusahaan=='012'){
	$schema_name='itos_billing';
	$schema_pwd='itos_BILLING';
	$schema_host='192.168.23.26/dbdev';
  }
  else if($kodeperusahaan=='011'){
	$schema_name='itos_billing';
	$schema_pwd='itos_BILLING';
	$schema_host='192.168.23.26/dbdev';
  }
  
  
  if ($conn = oci_connect($schema_name, $schema_pwd, $schema_host)) 
  {

	//create log
	$inv_char = array("'");
	$fix_char = array("''");
	$req_param = "LOG,".$notanumber.",".$userid;
	$clip = $_SERVER["REMOTE_ADDR"];
	$req_param = str_replace($inv_char,$fix_char,$req_param);
	$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('INCPTP', '$req_param','$clip')";
	$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
	if (!oci_execute($stid2))
	{
	}
		
	$query = "BEGIN itos_billing.ptp_epaymentptkm_inquiryproc
				(
					:vd_no_nota,
					:vd_user_id,
					:vd_no_faktur,
					:vd_id_req,
					:vd_emkl,
					:vd_status,
					:vd_alamat,
					:vd_vessel,
					:vd_voyage_in,
					:vd_voyage_out,
					:vd_tgl_simpan,
					:vd_tgl_payment,
					:vd_payment_via,
					:vd_total,
					:vd_coa,
					:vd_kd_modul,
					:vd_ket,
					:vd_ket_jenis,
					:vd_apptocess_date,
					:vd_outstatus,
					:vd_outmsg,
					:vd_clip
				); END;";

    $stid = oci_parse($conn, $query) or die ('Can not parse query');

		$clip = $_SERVER["REMOTE_ADDR"];
		
        oci_bind_by_name($stid, "vd_no_nota", &$notanumber,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_user_id", &$userid,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_no_faktur", &$v_no_faktur,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_id_req", &$v_id_req,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_emkl", &$v_emkl,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_status", &$v_status,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_alamat", &$v_alamat,200) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_vessel", &$v_vessel,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_voyage_in", &$v_voyage_in,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_voyage_out", &$v_voyage_out,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_tgl_simpan", &$v_tgl_simpan,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_tgl_payment", &$v_tgl_payment,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_payment_via", &$v_payment_via,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_total", &$v_total,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_coa", &$v_coa,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_kd_modul", &$v_kd_modul,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_ket", &$v_ket,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_ket_jenis", &$v_ket_jenis,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_apptocess_date", &$v_apptocess_date,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_outstatus", &$v_outstatus,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_outmsg", &$v_outmsg,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_clip", &$clip,100) or die ('Can not bind variable');

    if (!oci_execute($stid)) {
		$e = oci_error($stid); 
        oci_close($conn);
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>87</status>
						<message>ORA - Database problem</message>
					</xml>";*/
		
		$xml_str = "^87^ORA - Database problem,$e[message]";
		
        return $xml_str;
    }
    else
    {
        oci_close($conn);
		
		$inv_char 	= array("&", "\"", "'", "<", ">", "^");
		$fix_char		= array(" ", " ", " ", " ", " ", " ");
		
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>$v_outstatus</status>
						<message>$v_outmsg</message>
						<nota_number>$notanumber</nota_number>
						<user_id>$v_user_id</user_id>
						<no_faktur>$v_no_faktur</no_faktur>
						<id_req>$v_id_req</id_req>
						<emkl>".str_replace($inv_char,$fix_char,$v_emkl)."</emkl>
						<status>$v_status</status>
						<alamat>".str_replace($inv_char,$fix_char,$v_alamat)."</alamat>
						<vessel>$v_vessel</vessel>
						<voyage_in>$v_voyage_in</voyage_in>
						<voyage_out>$v_voyage_out</voyage_out>
						<tgl_simpan>$v_tgl_simpan</tgl_simpan>
						<tgl_payment>$v_tgl_payment</tgl_payment>
						<payment_via>$v_payment_via</payment_via>
						<total>$v_total</total>
						<coa>$v_coa</coa>
						<kd_modul>$v_kd_modul</kd_modul>
						<jenis>$v_ket</jenis>
						<keterangan_jenis>$v_ket_jenis</keterangan_jenis>
						<apptoacess_dated>$v_apptocess_date</apptoacess_dated>
					</xml>";*/
		
		$xml_str = "^$v_outstatus^$v_outmsg^$notanumber^$v_user_id^$v_no_faktur^$v_id_req^".str_replace($inv_char,$fix_char,$v_emkl)."^$v_status^".str_replace($inv_char,$fix_char,$v_alamat)."^$v_vessel^$v_voyage_in^$v_voyage_out^$v_tgl_simpan^$v_tgl_payment^$v_payment_via^$v_total^$v_coa^$v_kd_modul^$v_ket^$v_ket_jenis^$v_apptocess_date^";
		
        return $xml_str;
    }
  }
  else
  {
		$e = oci_error($stid); 
		oci_close($conn);
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>91</status>
						<message>Link down</message>
					</xml>";*/
		
		$xml_str = "^91^Link down";
		
		return $xml_str;
  }
}

function ePaymentPaid($nomor_nota, $user_id, $bank_id, $paid_date, $paid_channel ) {
  // db connection
  //if ($conn = oci_connect('billing_to3_dom', 'billingto3', '192.168.23.26/dbdev')) 
  $kodeperusahaan=substr($nomor_nota,3,3);
  if($kodeperusahaan=='013'){
	$schema_name='itos_billing';
	$schema_pwd='itos_BILLING';
	$schema_host='192.168.23.26/dbdev';
  }
  else if($kodeperusahaan=='012'){
	$schema_name='itos_billing';
	$schema_pwd='itos_BILLING';
	$schema_host='192.168.23.26/dbdev';
  }
  else if($kodeperusahaan=='011'){
	$schema_name='itos_billing';
	$schema_pwd='itos_BILLING';
	$schema_host='192.168.23.26/dbdev';
  }
  
  
  if ($conn = oci_connect($schema_name, $schema_pwd, $schema_host)) 
  {
  
    //create log
	$inv_char2 = array("'");
	$fix_char2 = array("''");
	$lg_id = $nomor_nota.":".rand(10, 99);
	$req_param = "LOG,".$nomor_nota.",".$user_id.",".$bank_id.",".$paid_date.",".$paid_channel;
	$clip = $_SERVER["REMOTE_ADDR"];
	$lg_id = str_replace($inv_char2,$fix_char,$lg_id);
	$req_param = str_replace($inv_char2,$fix_char,$req_param);
	$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_ID, LG_TYPE, REQ_PARAM,IP) VALUES ('$lg_id', 'PAY', '$req_param','$clip')";
	$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
    if (!oci_execute($stid2))
	{
	}

	$query = "BEGIN itos_billing.ptp_epaymentptkm_paymentproc(
											:v_no_nota, 
											:v_user_id, 
											:v_bank, 
											:v_paid_date, 
											:v_paid_channel, 
												:vd_no_faktur,
												:vd_id_req,
												:vd_emkl,
												:vd_status,
												:vd_alamat,
												:vd_vessel,
												:vd_voyage_in,
												:vd_voyage_out,
												:vd_tgl_simpan,
												:vd_tgl_payment,
												:vd_payment_via,
												:vd_total,
												:vd_coa,
												:vd_kd_modul,
												:vd_ket,
												:vd_ket_jenis,
												:vd_apptocess_date,											
											:v_outstatus,
											:v_outmsg
											); END;";

    $stid = oci_parse($conn, $query) or die ('Can not parse query');

        oci_bind_by_name($stid, "v_no_nota", &$nomor_nota,50) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_user_id", &$user_id,10) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_bank", &$bank_id,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_paid_date", &$paid_date,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_paid_channel", &$paid_channel,20) or die ('Can not bind variable');
		
        oci_bind_by_name($stid, "vd_no_faktur", &$v_no_faktur,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_id_req", &$v_id_req,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_emkl", &$v_emkl,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_status", &$v_status,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_alamat", &$v_alamat,200) or die ('Can not bind variable');
        oci_bind_by_name($stid, "vd_vessel", &$v_vessel,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_voyage_in", &$v_voyage_in,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_voyage_out", &$v_voyage_out,150) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_tgl_simpan", &$v_tgl_simpan,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_tgl_payment", &$v_tgl_payment,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_payment_via", &$v_payment_via,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_total", &$v_total,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_coa", &$v_coa,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_kd_modul", &$v_kd_modul,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_ket", &$v_ket,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_ket_jenis", &$v_ket_jenis,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "vd_apptocess_date", &$v_apptocess_date,100) or die ('Can not bind variable');
		
        oci_bind_by_name($stid, "v_outstatus", &$v_outstatus,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_outmsg", &$v_outmsg,100) or die ('Can not bind variable');

    if (!oci_execute($stid)) {
		$e = oci_error($stid); 
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>87</status>
						<message>ORA - Database problem</message>
					</xml>";*/
					
		$xml_str = "^87^ORA - Database problem,$e[message]";
		
		//UPDATE LOG
		$res_param = str_replace($inv_char2,$fix_char2,$xml_str);
		$log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'S', RES_PARAM = '$res_param', DATE_RES = sysdate where LG_ID = '$lg_id'";
		$stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
		if (!oci_execute($stid3))
		{
		}
		
		oci_close($conn);
        return $xml_str;
    }
    else
    {
		
		$inv_char 	= array("&", "\"", "'", "<", ">", "^");
		$fix_char		= array(" ", " ", " ", " ", " ", " ");
		
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>$v_outstatus</status>
						<message>$v_outmsg</message>
						<nota_number>$nomor_nota</nota_number>
						<no_faktur>$v_no_faktur</no_faktur>
						<id_req>$v_id_req</id_req>
						<emkl>".str_replace($inv_char,$fix_char,$v_emkl)."</emkl>
						<alamat>".str_replace($inv_char,$fix_char,$v_alamat)."</alamat>
						<vessel>$v_vessel</vessel>
						<voyage_in>$v_voyage_in</voyage_in>
						<voyage_out>$v_voyage_out</voyage_out>
						<tgl_simpan>$v_tgl_simpan</tgl_simpan>
						<tgl_payment>$v_tgl_payment</tgl_payment>
						<payment_via>$v_payment_via</payment_via>
						<total>$v_total</total>
						<coa>$v_coa</coa>
						<kd_modul>$v_kd_modul</kd_modul>
						<jenis>$v_ket</jenis>
						<keterangan_jenis>$v_ket_jenis</keterangan_jenis>
						<apptoacess_dated>$v_apptocess_date</apptoacess_dated>						
					</xml>";*/
					
		$xml_str = "^$v_outstatus^$v_outmsg^$nomor_nota^$v_no_faktur^$v_id_req^".str_replace($inv_char,$fix_char,$v_emkl)."^".str_replace($inv_char,$fix_char,$v_alamat)."^$v_vessel^$v_voyage_in^$v_voyage_out^$v_tgl_simpan^$v_tgl_payment^$v_payment_via^$v_total^$v_coa^$v_kd_modul^$v_ket^$v_ket_jenis^$v_apptocess_date^";

		if($v_outstatus=="00")
		{
			$conn2 = oci_connect('IBIS', 'ibis321', '10.10.33.25:1521/ORCL');

			$query = "update transaction_log set 
												status_req = 'P' 
												,trx_number = '$nomor_nota' 
												,trx_date = sysdate 
												,payment_by = '$user_id'
												,payment_status = 'S'
												,payment_channel = '$paid_channel'
												,LAST_USER_ACTIVITY_CODE = 'PAYMENT'
												,LAST_USER_ACTIVITY_USERID = '$user_id'
							where prf_number = '$nomor_nota'";

			$stid5 = oci_parse($conn2, $query) or die ('Can not parse query');
			if (!oci_execute($stid5))
			{
			}

			oci_close($conn2);
	
		}
		
		//UPDATE LOG
		$res_param = str_replace($inv_char2,$fix_char2,$xml_str);
		$log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'S', RES_PARAM = '$res_param', DATE_RES = sysdate where LG_ID = '$lg_id'";
		$stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
		if (!oci_execute($stid3))
		{
		}
	
        oci_close($conn);	
        return $xml_str;
    }   
  }
  else
  {
		$e = oci_error($stid); 
		oci_close($conn);
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>91</status>
						<message>Link down</message>
					</xml>";*/
		
		$xml_str = "^91^Link down";
		
		return $xml_str;
  }
}

function getReconcilePTPt1($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {

   // db connection
   //if  ($conn = oci_connect('billing_to3_dom', 'billingto3', '192.168.23.26/dbdev')) 
   if ($conn = oci_connect('itos_billing', 'itos_BILLING', '192.168.23.26/dbdev')) 
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		if($paid_channel!='') {
			$filter .=" and paid_via='$paid_channel' ";
		}
		
		if($userid!="")
		{
			$filter .=" and user_paid='$userid' ";
		}
		
		if($orgid!="")
		{
			$filter .=" and ORG_ID='$orgid' ";
		}
		
		if($bankid!="")
		{
			$query = "SELECT RECEIPT_ACCOUNT FROM xpi2_ar_receipt_method_v WHERE BANK_ACCOUNT_ID = '$bankid'";
			
			$tmp2=$query;
			
			$query = oci_parse($conn, $query);
			if (!oci_execute($query))
			{
				
			}
			else
			{
				$row = oci_fetch_array($query, OCI_ASSOC);
				
				$receipt_account = $row['RECEIPT_ACCOUNT'];
			}
					
			$filter .=" and receipt_account='$receipt_account'";
		}
		
        //get value result
/*        $query2 = "select NO_NOTA, DATE_PAID from tth_nota_all2 WHERE to_char(DATE_PAID,'DDMMYYYYHH24MI') between trim('$start') and trim('$end') $filter
					 ORDER BY DATE_PAID ASC";*/
					 
        $query2 = "select NO_NOTA, NO_REQUEST, CUST_NAME, TOTAL, PPN, KREDIT, TO_CHAR(DATE_PAID, 'YYYYMMDDHH24MiSS') as DATE_PAID, USER_PAID, PAID_VIA, RECEIPT_ACCOUNT from tth_nota_all2 WHERE DATE_PAID BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') $filter
					 ORDER BY DATE_PAID ASC";
					 
$tmp = $query2;

        $query2 = oci_parse($conn, $query2);
		
		if (!oci_execute($query2))
		{
			$e = oci_error($stid); 
			oci_close($conn);

			$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>87</status>
				<message>ORA - Database problem</message>
			</xml>";
						
			//$xml_str = "^87^ORA - Database problem";
						
			return $xml_str;
		}
		else 
		{
		
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$inv_char 	= array("&", "\"", "'", "<", ">");
		
			while ($row = oci_fetch_array($query2, OCI_ASSOC))
			{
				$no_nota = $row['NO_NOTA'];
				$no_req = $row['NO_REQUEST'];
				$cust_name = $row['CUST_NAME'];
				$total = $row['TOTAL'];
				$ppn = $row['PPN'];
				$kredit = $row['KREDIT'];
				$date_paid = $row['DATE_PAID'];
				$user_paid = $row['USER_PAID'];
				$paid_via = $row['PAID_VIA'];
				$receipt_account = $row['RECEIPT_ACCOUNT'];
				
				$detail_reckon .= "<trx>
						<no_nota>".$no_nota."</no_nota>
						<no_request>".$no_req."</no_request>
						<customer>".str_replace($inv_char,$fix_char,$cust_name)."</customer>
						<total>".$total."</total>
						<ppn>".$ppn."</ppn>
						<kredit>".$kredit."</kredit>
						<user_paid>".$user_paid."</user_paid>
						<date_paid>".$date_paid."</date_paid>
						<paid_via>".$paid_via."</paid_via>
						<receipt_account>".$receipt_account."</receipt_account>
				   </trx>";
								   
				//$detail_reckon .= "|".$no_nota."^".$no_req."^".str_replace($inv_char,$fix_char,$cust_name)."^".$total."^".$ppn."^".$kredit."^".$user_paid."^".$date_paid."^".$paid_via."^".$receipt_account."";
				
			}			
		}
        oci_close($conn);
   } else {
		$e = oci_error($stid); 
        oci_close($conn);

		$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>91</status>
				<message>Link down</message>
			</xml>";
					
		//$xml_str = "^91^Link down";
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
	//$xml_str = $detail_reckon;

    return $xml_str;
	
}

function getReconcilePTPt2($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {

   // db connection
   //if  ($conn = oci_connect('billing_to3_dom', 'billingto3', '192.168.23.26/dbdev')) 
   if ($conn = oci_connect('itos_billing', 'itos_BILLING', '192.168.23.26/dbdev')) 
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		if($paid_channel!='') {
			$filter .=" and paid_via='$paid_channel' ";
		}
		
		if($userid!="")
		{
			$filter .=" and user_paid='$userid' ";
		}
		
		if($orgid!="")
		{
			$filter .=" and ORG_ID='$orgid' ";
		}
		
		if($bankid!="")
		{
			$query = "SELECT RECEIPT_ACCOUNT FROM xpi2_ar_receipt_method_v WHERE BANK_ACCOUNT_ID = '$bankid'";
			
			$tmp2=$query;
			
			$query = oci_parse($conn, $query);
			if (!oci_execute($query))
			{
				
			}
			else
			{
				$row = oci_fetch_array($query, OCI_ASSOC);
				
				$receipt_account = $row['RECEIPT_ACCOUNT'];
			}
					
			$filter .=" and receipt_account='$receipt_account'";
		}
		
        //get value result
/*        $query2 = "select NO_NOTA, DATE_PAID from tth_nota_all2 WHERE to_char(DATE_PAID,'DDMMYYYYHH24MI') between trim('$start') and trim('$end') $filter
					 ORDER BY DATE_PAID ASC";*/
					 
        $query2 = "select NO_NOTA, NO_REQUEST, CUST_NAME, TOTAL, PPN, KREDIT, TO_CHAR(DATE_PAID, 'YYYYMMDDHH24MiSS') as DATE_PAID, USER_PAID, PAID_VIA, RECEIPT_ACCOUNT from tth_nota_all2 WHERE DATE_PAID BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') $filter
					 ORDER BY DATE_PAID ASC";
					 
$tmp = $query2;

        $query2 = oci_parse($conn, $query2);
		
		if (!oci_execute($query2))
		{
			$e = oci_error($stid); 
			oci_close($conn);

			$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>87</status>
				<message>ORA - Database problem</message>
			</xml>";
						
			//$xml_str = "^87^ORA - Database problem";
						
			return $xml_str;
		}
		else 
		{
		
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$inv_char 	= array("&", "\"", "'", "<", ">");
		
			while ($row = oci_fetch_array($query2, OCI_ASSOC))
			{
				$no_nota = $row['NO_NOTA'];
				$no_req = $row['NO_REQUEST'];
				$cust_name = $row['CUST_NAME'];
				$total = $row['TOTAL'];
				$ppn = $row['PPN'];
				$kredit = $row['KREDIT'];
				$date_paid = $row['DATE_PAID'];
				$user_paid = $row['USER_PAID'];
				$paid_via = $row['PAID_VIA'];
				$receipt_account = $row['RECEIPT_ACCOUNT'];
				
				$detail_reckon .= "<trx>
						<no_nota>".$no_nota."</no_nota>
						<no_request>".$no_req."</no_request>
						<customer>".str_replace($inv_char,$fix_char,$cust_name)."</customer>
						<total>".$total."</total>
						<ppn>".$ppn."</ppn>
						<kredit>".$kredit."</kredit>
						<user_paid>".$user_paid."</user_paid>
						<date_paid>".$date_paid."</date_paid>
						<paid_via>".$paid_via."</paid_via>
						<receipt_account>".$receipt_account."</receipt_account>
				   </trx>";
								   
				//$detail_reckon .= "|".$no_nota."^".$no_req."^".str_replace($inv_char,$fix_char,$cust_name)."^".$total."^".$ppn."^".$kredit."^".$user_paid."^".$date_paid."^".$paid_via."^".$receipt_account."";
				
			}			
		}
        oci_close($conn);
   } else {
		$e = oci_error($stid); 
        oci_close($conn);

		$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>91</status>
				<message>Link down</message>
			</xml>";
					
		//$xml_str = "^91^Link down";
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
	//$xml_str = $detail_reckon;

    return $xml_str;
	
}

function getReconcilePTPt3($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {

   // db connection
   //if  ($conn = oci_connect('billing_to3_dom', 'billingto3', '192.168.23.26/dbdev')) 
   if ($conn = oci_connect('itos_billing', 'itos_BILLING', '192.168.23.26/dbdev')) 
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		if($paid_channel!='') {
			$filter .=" and paid_via='$paid_channel' ";
		}
		
		if($userid!="")
		{
			$filter .=" and user_paid='$userid' ";
		}
		
		if($orgid!="")
		{
			$filter .=" and ORG_ID='$orgid' ";
		}
		
		if($bankid!="")
		{
			$query = "SELECT RECEIPT_ACCOUNT FROM xpi2_ar_receipt_method_v WHERE BANK_ACCOUNT_ID = '$bankid'";
			
			$tmp2=$query;
			
			$query = oci_parse($conn, $query);
			if (!oci_execute($query))
			{
				
			}
			else
			{
				$row = oci_fetch_array($query, OCI_ASSOC);
				
				$receipt_account = $row['RECEIPT_ACCOUNT'];
			}
					
			$filter .=" and receipt_account='$receipt_account'";
		}
		
        //get value result
/*        $query2 = "select NO_NOTA, DATE_PAID from tth_nota_all2 WHERE to_char(DATE_PAID,'DDMMYYYYHH24MI') between trim('$start') and trim('$end') $filter
					 ORDER BY DATE_PAID ASC";*/
					 
        $query2 = "select NO_NOTA, NO_REQUEST, CUST_NAME, TOTAL, PPN, KREDIT, TO_CHAR(DATE_PAID, 'YYYYMMDDHH24MiSS') as DATE_PAID, USER_PAID, PAID_VIA, RECEIPT_ACCOUNT from tth_nota_all2 WHERE DATE_PAID BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') $filter
					 ORDER BY DATE_PAID ASC";
					 
$tmp = $query2;

        $query2 = oci_parse($conn, $query2);
		
		if (!oci_execute($query2))
		{
			$e = oci_error($stid); 
			oci_close($conn);

			$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>87</status>
				<message>ORA - Database problem</message>
			</xml>";
						
			//$xml_str = "^87^ORA - Database problem";
						
			return $xml_str;
		}
		else 
		{
		
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$inv_char 	= array("&", "\"", "'", "<", ">");
		
			while ($row = oci_fetch_array($query2, OCI_ASSOC))
			{
				$no_nota = $row['NO_NOTA'];
				$no_req = $row['NO_REQUEST'];
				$cust_name = $row['CUST_NAME'];
				$total = $row['TOTAL'];
				$ppn = $row['PPN'];
				$kredit = $row['KREDIT'];
				$date_paid = $row['DATE_PAID'];
				$user_paid = $row['USER_PAID'];
				$paid_via = $row['PAID_VIA'];
				$receipt_account = $row['RECEIPT_ACCOUNT'];
				
				$detail_reckon .= "<trx>
						<no_nota>".$no_nota."</no_nota>
						<no_request>".$no_req."</no_request>
						<customer>".str_replace($inv_char,$fix_char,$cust_name)."</customer>
						<total>".$total."</total>
						<ppn>".$ppn."</ppn>
						<kredit>".$kredit."</kredit>
						<user_paid>".$user_paid."</user_paid>
						<date_paid>".$date_paid."</date_paid>
						<paid_via>".$paid_via."</paid_via>
						<receipt_account>".$receipt_account."</receipt_account>
				   </trx>";
								   
				//$detail_reckon .= "|".$no_nota."^".$no_req."^".str_replace($inv_char,$fix_char,$cust_name)."^".$total."^".$ppn."^".$kredit."^".$user_paid."^".$date_paid."^".$paid_via."^".$receipt_account."";
				
			}			
		}
        oci_close($conn);
   } else {
		$e = oci_error($stid); 
        oci_close($conn);

		$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>91</status>
				<message>Link down</message>
			</xml>";
					
		//$xml_str = "^91^Link down";
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
	//$xml_str = $detail_reckon;

    return $xml_str;
	
}

function ePaymentJKMPTP ($in_trx_number,$in_bank_account_id,$in_amount,$in_receipt_date,$in_receipt_category,$in_receipt_source,$in_receipt_comment, $kd_modul) {
	//create log
	//$conn1 = oci_connect('billing_to3_dom', 'billingto3', '192.168.23.26/dbdev');
	$kodeperusahaan=substr($in_trx_number,3,3);
	  if($kodeperusahaan=='013'){
		$schema_name='itos_billing';
		$schema_pwd='itos_BILLING';
		$schema_host='192.168.23.26/dbdev';
	  }
	  else if($kodeperusahaan=='012'){
		$schema_name='itos_billing';
		$schema_pwd='itos_BILLING';
		$schema_host='192.168.23.26/dbdev';
	  }
	  else if($kodeperusahaan=='011'){
		$schema_name='itos_billing';
		$schema_pwd='itos_BILLING';
		$schema_host='192.168.23.26/dbdev';
	  }
  
  
  
	
	$conn = oci_connect($schema_name, $schema_pwd, $schema_host);
	$conn2 = oci_connect('SIMOP', 'simopprod', '10.10.12.253:1527/REDO');
	
	if ($conn2 && $conn1)
	{
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG,".$notanumber.",".$userid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('JKMPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn1, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		$query = "BEGIN apps.xptp_ar_ilcs_epay_pkg.generate_epay (
				 :in_trx_number, 
				 :in_bank_account_id, 
				 :in_amount, 
				 :in_receipt_date, 
				 :in_receipt_category, 
				 :in_receipt_source, 
				 :in_receipt_comment, 
				 :out_jkm_number, 
				 :out_status, 
				 :out_message
				 ); END;";

		$stid = oci_parse($conn2, $query) or die ('Can not parse query');

		$clip = $_SERVER["REMOTE_ADDR"];
		
        oci_bind_by_name($stid, "in_trx_number", &$in_trx_number,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "in_bank_account_id", &$in_bank_account_id,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "in_amount", &$in_amount,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "in_receipt_date", &$in_receipt_date,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "in_receipt_category", &$in_receipt_category,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "in_receipt_source", &$in_receipt_source,100) or die ('Can not bind variable');
        oci_bind_by_name($stid, "in_receipt_comment", &$in_receipt_comment,200) or die ('Can not bind variable');
		oci_bind_by_name($stid, "out_jkm_number", &$out_jkm_number,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "out_status", &$out_status,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "out_message", &$out_message,100) or die ('Can not bind variable');

    if (!oci_execute($stid)) {
		$e = oci_error($stid); 
        oci_close($conn2);
		
		$xml_str = "^87^ORA - Database problem^$e[message]";
		
        return $xml_str;
    }
    else
    {
        oci_close($conn2);
		
		$inv_char 	= array("&", "\"", "'", "<", ">");
		$fix_char		= array(" ", " ", " ", " ", " ");

		$xml_str = "^$v_outstatus^$v_outmsg^$notanumber^$v_user_id^$v_no_faktur^$v_id_req^".str_replace($inv_char,$fix_char,$v_emkl)."^$v_status^".str_replace($inv_char,$fix_char,$v_alamat)."^$v_vessel^$v_voyage_in^$v_voyage_out^$v_tgl_simpan^$v_tgl_payment^$v_payment_via^$v_total^$v_coa^$v_kd_modul^$v_ket^$v_ket_jenis^$v_apptocess_date^";
		
		$log_query_jkm = "UPDATE TTH_NOTA_ALL2 SET STATUS_RECEIPT = '$v_outstatus',STATUS_RECEIPTMSG= '$v_outmsg',NO_JKM = '$out_jkm_number' WHERE TRIM(NO_NOTA) = TRIM($in_trx_number)";
		$stid2 = oci_parse($conn1, $log_query_jkm) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
        return $xml_str;
    }
  }
  else
  {
		$e = oci_error($stid); 
		oci_close($conn2);
		
		$xml_str = "^91^Link down";
		
		return $xml_str;
  }
}

$server = new soap_server();
$server->configureWSDL('portalipc2', 'urn:portalipc2');
 
$server->wsdl->schemaTargetNamespace = 'portalipc2';

$server->register('ePaymentInquiry',
            array('trxnumber' => 'xsd:string','userid' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('ePaymentPaid',
            array('trxnumber' => 'xsd:string','userid' => 'xsd:string','bankid' => 'xsd:string', 'paiddate' => 'xsd:string','paidchannel' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getReconcilePTPt1',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getReconcilePTPt2',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getReconcilePTPt3',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

			
			
$server->register('ePaymentJKMPTP',
            array('in_trx_number' => 'xsd:string','in_bank_account_id' => 'xsd:string','in_amount' => 'xsd:string','in_receipt_date' => 'xsd:string','in_receipt_category' => 'xsd:string','in_receipt_source' => 'xsd:string','in_receipt_comment' => 'xsd:string','kd_modul' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');			

$server->service($HTTP_RAW_POST_DATA);