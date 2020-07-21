<?php
require_once "lib/nusoap.php";

//======= Declare Function Service ========// 
function getProd($category) {
    if ($category == "books") {
        return join(",", array(
            "The WordPress Anthology",
            "PHP Master: Write Cutting Edge Code",
            "Build Your Own Website the Right Way"));
    }    else {
            return "No products listed under that category";
    }
}

function testConnection()
{
	if($conn = oci_connect('billing', 'billing', '192.168.29.88/PNKDBT'))
	{
		return "SUCCESS";
	}
	else
	{
		return "FALSE";
	}
}

function ePaymentInquiry($notanumber, $userid) {

  $kodeperusahaan=substr($notanumber,0,1);

  if($kodeperusahaan=="9")//petikemas
  {
	$kodeperusahaan=substr($notanumber,2,3);
	if($kodeperusahaan=="015")//pnk
		$conn = oci_connect('billing', 'billing', '192.168.29.88/PNKDBT');
	else if($kodeperusahaan=="011")//jkt
		$conn = oci_connect('billing', 'billingptpdom', '192.168.29.88/MTDBT');
	else if($kodeperusahaan=="020")//panjang
		$conn = oci_connect('billing', 'billing', '10.10.12.214/PJGDBT');
	else if($kodeperusahaan=="040")//palembang
		$conn = oci_connect('billing', 'billing', '10.10.12.214/PLGDBT');
	else 
		return "^021^KODE PERUSAHAAN BELUM TERDAFTAR^^^^^^^^^^^^^^^^^^^^";
  }
  else if($kodeperusahaan=="0"||$kodeperusahaan=="1")//uster
  {
	$conn = oci_connect('uster', 'uster', '192.168.29.88/PNKDBT');//pnk
  }
  else 
	return "^022^KODE PERUSAHAAN BELUM TERDAFTAR^^^^^^^^^^^^^^^^^^^^";

  //db connection 
  if($conn)
  {

	//create log
	$inv_char = array("'");
	$fix_char = array("''");
	$req_param = "LOG36,".$notanumber.",".$userid;
	$clip = $_SERVER["REMOTE_ADDR"];
	$req_param = str_replace($inv_char,$fix_char,$req_param);
	$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('INCPTP', '$req_param','$clip')";
	$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
	if (!oci_execute($stid2))
	{
	}
		
		$query = "BEGIN epaymentptkm_inquiryproc
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
		
		$xml_str = "^87^ORA - Database problem,$e[message]";
		
        return $xml_str;
    }
    else
    {
        oci_close($conn);

		$inv_char 	= array("&", "\"", "'", "<", ">", "^");
		$fix_char		= array(" ", " ", " ", " ", " ", " ");
		
		$xml_str = "^$v_outstatus^$v_outmsg^$notanumber^$v_user_id^$v_no_faktur^$v_id_req^".str_replace($inv_char,$fix_char,$v_emkl)."^$v_status^".str_replace($inv_char,$fix_char,$v_alamat)."^$v_vessel^$v_voyage_in^$v_voyage_out^$v_tgl_simpan^$v_tgl_payment^$v_payment_via^$v_total^$v_coa^$v_kd_modul^$v_ket^$v_ket_jenis^$v_apptocess_date^";
		
        return $xml_str;
    }
  }
  else
  {
		$e = oci_error($stid); 
		oci_close($conn);
		
		$xml_str = "^91^Link down";
		
		return $xml_str;
  }
}

function ePaymentPaid($nomor_nota, $user_id, $bank_id, $paid_date, $paid_channel) {
	
  $kodeperusahaan=substr($nomor_nota,0,1);

  if($kodeperusahaan=="9")//petikemas
  {
	$kodeperusahaan=substr($nomor_nota,2,3);
	if($kodeperusahaan=="015")//pnk
		$conn = oci_connect('billing', 'billing', '192.168.29.88/PNKDBT');
	else if($kodeperusahaan=="011")//jkt
		$conn = oci_connect('billing', 'billingptpdom', '192.168.29.88/MTDBT');
	else if($kodeperusahaan=="020")//panjang
		$conn = oci_connect('billing', 'billing', '10.10.12.214/PJGDBT');
	else if($kodeperusahaan=="040")//palembang
		$conn = oci_connect('billing', 'billing', '10.10.12.214/PLGDBT');	
	else 
		return "^021^KODE PERUSAHAAN BELUM TERDAFTAR^^^^^^^^^^^^^^^^^^^^";
  }
  else if($kodeperusahaan=="0"||$kodeperusahaan=="1")//uster
  {
	$conn = oci_connect('uster', 'uster', '192.168.29.88/PNKDBT');//pnk
  }
  else 
	return "^022^KODE PERUSAHAAN BELUM TERDAFTAR^^^^^^^^^^^^^^^^^^^^";

  // db connection
  if($conn)
  {
  
    //create log
	$inv_char2 = array("'");
	$fix_char2 = array("''");
	$lg_id = $nomor_nota.":".rand(10, 99);
	$req_param = "LOG36,".$nomor_nota.",".$user_id.",".$bank_id.",".$paid_date.",".$paid_channel;
	$clip = $_SERVER["REMOTE_ADDR"];
	$lg_id = str_replace($inv_char2,$fix_char,$lg_id);
	$req_param = str_replace($inv_char2,$fix_char,$req_param);
	$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_ID, LG_TYPE, REQ_PARAM,IP) VALUES ('$lg_id', 'PAY', '$req_param','$clip')";
	$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
    if (!oci_execute($stid2))
	{
	}

		$query = "BEGIN epaymentptkm_paymentproc(
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
												:vd_nota,
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
		oci_bind_by_name($stid, "vd_nota", &$v_nota,100) or die ('Can not bind variable');
		
        oci_bind_by_name($stid, "v_outstatus", &$v_outstatus,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_outmsg", &$v_outmsg,100) or die ('Can not bind variable');

    if (!oci_execute($stid)) {
		$e = oci_error($stid);
					
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
					
		$xml_str = "^$v_outstatus^$v_outmsg^$nomor_nota^$v_no_faktur^$v_id_req^".str_replace($inv_char,$fix_char,$v_emkl)."^".str_replace($inv_char,$fix_char,$v_alamat)."^$v_vessel^$v_voyage_in^$v_voyage_out^$v_tgl_simpan^$v_tgl_payment^$v_payment_via^$v_total^$v_coa^$v_kd_modul^$v_ket^$v_ket_jenis^$v_apptocess_date^$v_nota^";

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
		
		$xml_str = "^91^Link down";
		
		return $xml_str;
  }
}

function getReconcilePtkmPnk($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {


   // db connection
  if($conn = oci_connect('billing', 'billing', '192.168.29.88/PNKDBT'))
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG36,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		$filter .=" and status_nota<>'X' ";
		
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
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
    return $xml_str;
	
}

function getReconcilePtkmPjg($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {


   // db connection
  if($conn = oci_connect('BILLING', 'billing', '10.10.12.214/PJGDBT'))
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG36,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		$filter .=" and status_nota<>'X' ";
		
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
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
    return $xml_str;
	
}

function getReconcilePtkmPlg($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {


   // db connection
  if($conn = oci_connect('billing', 'billing', '10.10.12.214/PLGDBT'))
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG36,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		$filter .=" and status_nota<>'X' ";
		
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
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
    return $xml_str;
	
}

function getReconcilePtkm009($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {


   // db connection
  if($conn = oci_connect('billing', 'billing', '192.168.29.88/MTDBT'))
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG36,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		$filter .=" and status_nota<>'X' ";
		
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
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
    return $xml_str;
	
}

function getReconcileUsterPnk($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {

   // db connection
  if($conn = oci_connect('uster', 'uster', '192.168.29.88/PNKDBT'))
   {
   
       	//create log
		$inv_char = array("'");
		$fix_char = array("''");
		$req_param = "LOG36,".$start.",".$end.",".$paid_channel.",".$userid.",".$bankid.",".$orgid;
		$clip = $_SERVER["REMOTE_ADDR"];
		$req_param = str_replace($inv_char,$fix_char,$req_param);
		$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_TYPE, REQ_PARAM,IP) VALUES ('RECONPTP', '$req_param','$clip')";
		$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
		if (!oci_execute($stid2))
		{
		}
		
		$paid_channel = "";
		if($paid_channel!='') {
			$filter .=" and receipt_method='$paid_channel' ";
		}
		
		if($userid!="")
		{
			$filter .=" and userid_lunas='$userid' ";
		}
		
		if($orgid!="")
		{
			//$filter .=" and ORG_ID='$orgid' ";
		}
		
		if($bankid!="")
		{
			$query = "SELECT bank_account_name FROM billing.mst_bank_simkeu where bank_id = '$bankid'";
			
			$tmp2=$query;
			
			$query = oci_parse($conn, $query);
			if (!oci_execute($query))
			{
				
			}
			else
			{
				$row = oci_fetch_array($query, OCI_ASSOC);
				
				$receipt_account = $row['BANK_ACCOUNT_NAME'];
			}
			
			$filter .=" and receipt_account='$receipt_account'";
		}
					
		$query2 = "select trx_number as no_nota, '' as no_request, '' as cust_name,  total, ppn, kredit, 
        TO_CHAR(tgl_pelunasan, 'YYYYMMDDHH24MiSS') as DATE_PAID, userid_lunas as user_paid, receipt_method as paid_via, receipt_account
        from itpk_nota_header 
		where tgl_pelunasan BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
				$filter
		order by trx_Date desc";
					 
$tmp = $query2;

        $query2 = oci_parse($conn, $query2);
		
		if (!oci_execute($query2))
		{
			$e = oci_error($stid); 
			oci_close($conn);

			$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>87</status>
				<message>ORA - Database problem;$e[message]</message>
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
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
    return $xml_str;
	
}

$server = new soap_server();
$server->configureWSDL('portalipc2', 'urn:portalipc2');
 
$server->wsdl->schemaTargetNamespace = 'portalipc2';
 
$server->register('getProd',
            array('category' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('testConnection',
            array('category' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

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

$server->register('getReconcilePtkm009',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');			

$server->register('getReconcilePtkmPnk',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getReconcilePtkmPjg',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getReconcilePtkmPlg',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getReconcileUsterPnk',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->service($HTTP_RAW_POST_DATA);