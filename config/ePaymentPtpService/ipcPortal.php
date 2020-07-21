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
	if($conn = oci_connect('barang_prod', '$Prod_b4r4ngpassd', '10.10.30.23/peldb'))
	{
		return "SUCCESS";
	}
	else
	{
		return "FALSE";
	}
}

function ePaymentInquiry($notanumber, $userid) {

  //db connection 
  //if ($conn = oci_connect('billing', 'billing', '192.168.29.88/TOSDBTEST')) 
  if($conn = oci_connect('billing', 'billingdesember2014', '192.168.29.85/TOSDB'))
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
		
	$query = "BEGIN BILLING.ptp_epaymentptkm_inquiryproc
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
						<message>Biller database problem</message>
					</xml>";*/
		
		$xml_str = "^87^ORA - Database problem,$e[message]";
		
        return $xml_str;
    }
    else
    {
        oci_close($conn);

		$inv_char 	= array("&", "\"", "'", "<", ">","^");
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
  //if ($conn = oci_connect('billing', 'billing', '192.168.29.88/TOSDBTEST')) 
  if($conn = oci_connect('billing', 'billingdesember2014', '192.168.29.85/TOSDB'))
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

	$query = "BEGIN BILLING.ptp_epaymentptkm_paymentproc(
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
						<message>Biller database problem</message>
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
		
		$inv_char 	= array("&", "\"", "'", "<", ">","^");
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

function getReconcilePTP($start,$end,$paid_channel,$userid="",$bankid="",$orgid="") {

   // db connection
  //if ($conn = oci_connect('billing', 'billing', '192.168.29.88/TOSDBTEST'))
  if($conn = oci_connect('billing', 'billingdesember2014', '192.168.29.85/TOSDB'))
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

function getReconcilePTPBarang($start,$end,$paid_channel,$userid="",$bankid="") {

   // db connection
   if($conn = oci_connect('barang_prod', '$Prod_b4r4ngpass', '10.10.30.23/peldb'))
   {
		if($paid_channel!='') {
			$filter .=" and pelunasan_via='$paid_channel' ";
		}
		
		if($userid!="")
		{
			$filter .=" and user_pelunasan='$userid' ";
		}
		
		if($bankid!="")
		{
			$filter .=" and kd_bank='$bankid' ";
		}
					 
        $query2 = "select tbp.*, TO_CHAR(TGL_PELUNASAN, 'YYYYMMDDHH24MiSS') as TANGGAL_PELUNASAN from tb_paynota tbp WHERE TGL_PELUNASAN BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') $filter";
					 
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
						<no_nota>".$row['NO_NOTA']."</no_nota>
						<no_faktur>".$row['NO_FAKTUR']."</no_faktur>
						<tgl_nota>".$row['TGL_NOTA']."</tgl_nota>
						<bprp_id>".$row['BPRP_ID']."</bprp_id>
						<bl_no>".$row['BL_NO']."</bl_no>
						<do_no>".$row['DO_NO']."</do_no>
						<company_id>".$row['COMPANY_ID']."</company_id>
						<nama_perusahaan>".str_replace($inv_char,$fix_char,$row['NAMA_PERUSAHAAN'])."</nama_perusahaan>
						<alamat_perusahaan>".str_replace($inv_char,$fix_char,$row['ALAMAT_PERUSAHAAN'])."</alamat_perusahaan>
						<no_npwp>".$row['NO_NPWP']."</no_npwp>
						<email_perusahaan>".$row['EMAIL_PERUSAHAAN']."</email_perusahaan>
						<vessel_id>".$row['VESSEL_ID']."</vessel_id>
						<nm_kapal>".$row['NM_KAPAL']."</nm_kapal>
						<call_sign>".$row['CALL_SIGN']."</call_sign>
						<principal>".$row['PRINCIPAL']."</principal>
						<whouse_id>".$row['WHOUSE_ID']."</whouse_id>
						<kade>".$row['KADE']."</kade>
						<lokasi>".$row['LOKASI']."</lokasi>
						<voyage_no>".$row['VOYAGE_NO']."</voyage_no>
						<status_bm>".$row['STATUS_BM']."</status_bm>
						<v_taxbase>".$row['V_TAXBASE']."</v_taxbase>
						<v_pierdiscount>".$row['V_PIERDISCOUNT']."</v_pierdiscount>
						<v_formprice>".$row['V_FORMPRICE']."</v_formprice>
						<v_taxvalue>".$row['V_TAXVALUE']."</v_taxvalue>
						<v_tobepaid>".$row['V_TOBEPAID']."</v_tobepaid>
						<tgl_pelunasan>".$row['TANGGAL_PELUNASAN']."</tgl_pelunasan>
						<amount_pelunasan>".$row['AMOUNT_PELUNASAN']."</amount_pelunasan>
						<user_pelunasan>".$row['USER_PELUNASAN']."</user_pelunasan>
						<id_seq>".$row['ID_SEQ']."</id_seq>
						<pelunasan_via>".$row['PELUNASAN_VIA']."</pelunasan_via>
						<terminal>".$row['TERMINAL']."</terminal>
						<no_jkm>".$row['NO_JKM']."</no_jkm>
						<kd_bank>".$row['KD_BANK']."</kd_bank>
						<bank_desc>".$row['BANK_DESC']."</bank_desc>
						<company_source>".$row['COMPANY_SOURCE']."</company_source>
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
					
		//$xml_str = "^91^Link down";
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
	//$xml_str = $detail_reckon;

    return $xml_str;
	
}

function getReconcilePTPKapalAutocollection($start,$end) {

   // db connection
  if($conn = oci_connect('KAPAL_PROD', '$Prod_k4p4lpass', '10.10.30.22:1521/peldb'))
   {
		$query2 = "select TRX_NUMBER, TO_CHAR(TRX_DATE, 'YYYYMMDDHH24MiSS') as TRX_DATE, CURRENCY_CODE, STATUS, a.NO_PPKB, KODE_KAWASAN, TAGIHAN_NOTA, c.NAMA_PERUSAHAAN, d.bank_id   
						from ac_deduct_nota b left join ac_ppkb_log d on b.no_ppkb=d.no_ppkb, ptp_nota_header a left join mst_pelanggan c ON c.kd_pelanggan=a.customer_number 
						where a.trx_number=b.no_nota and d.ppkb_ke='1' and TRX_DATE BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS')";

		$tmp = $query2;
		
        $query2 = oci_parse($conn, $query2);

		if (!oci_execute($query2))
		{
			$e = oci_error($stid); 
			oci_close($conn);

			$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<xml>
				<status>87</status>
				<message>ORA - Database problem;$tmp</message>
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
				$trx_number = $row['TRX_NUMBER'];
				$trx_date = $row['TRX_DATE'];
				$currency_code = $row['CURRENCY_CODE'];
				$status = $row['STATUS'];
				$no_ppkb = $row['NO_PPKB'];
				$kode_kawasan = $row['KODE_KAWASAN'];
				$tagihan_nota = $row['TAGIHAN_NOTA'];
				$nama_perusahaan = $row['NAMA_PERUSAHAAN'];
				$bank_id = $row['BANK_ID'];

				$detail_reckon .= "<trx>
						<trx_number>".$trx_number."</trx_number>
						<trx_date>".$trx_date."</trx_date>
						<currency_code>".$currency_code."</currency_code>
						<status>".$status."</status>
						<no_ppkb>".$no_ppkb."</no_ppkb>
						<kode_kawasan>".$kode_kawasan."</kode_kawasan>
						<tagihan_nota>".$tagihan_nota."</tagihan_nota>
						<nama_perusahaan>".$nama_perusahaan."</nama_perusahaan>
						<bank_id>".$bank_id."</bank_id>
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
					
		//$xml_str = "^91^Link down";
					
        return $xml_str;
   }
	
	$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><xml>".$detail_reckon."</xml>";
	
	//$xml_str = $detail_reckon;

    return $xml_str;
	
}

function ePaymentBarangEdc($nota, $tgl_pelunasan, $amount, $user, $via, $nojkm, $kdbank, $company ) 
{
  // db connection
  if($conn = oci_connect('barang_prod', '$Prod_b4r4ngpass', '10.10.30.22:1521/peldb'))
  {
  
  	//create log
	// $inv_char = array("'");
	// $fix_char = array("''");
	// $lg_id = $nomor_nota.":".rand(10, 99);
	// $req_param = "LOG,".$nomor_nota.",".$user_id.",".$bank_id.",".$paid_date.",".$paid_channel;
	// $clip = $_SERVER["REMOTE_ADDR"];
	// $lg_id = str_replace($inv_char,$fix_char,$lg_id);
	// $req_param = str_replace($inv_char,$fix_char,$req_param);
	// $log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_ID, LG_TYPE, REQ_PARAM,IP) VALUES ('$lg_id', 'PAY', '$req_param','$clip')";
	// $stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
	
	
    // if (!oci_execute($stid2))
	// {
	// }
	
	//BEGIN PAYMENT
	$query = "BEGIN pack_edc_brg.insert_nota(:v_nota,
											 :v_tgl_pelunasan,
											 :v_amount,
											 :v_user, 
											 :v_via, 
											 :v_nojkm, 
											 :v_kdbank, 
											 :v_company,
											 :v_status, 
											 :v_msg, 
											 :v_email
											); END;";

	// v_nota in varchar2, 
    // v_tgl_pelunasan in date,
    // v_amount in number,
    // v_user in varchar2, 
    // v_via in varchar2, 
    // v_nojkm in varchar2, 
    // v_kdbank in varchar2, 
    // v_company in varchar2										
	
	//($nota, $tgl_pelunasan, $amount, $user, $via, $nojkm, $kdbank, $company )
											
    $stid = oci_parse($conn, $query) or die ('Can not parse query');

		//Parameter Input
        oci_bind_by_name($stid, "v_nota", &$nota,50) or die ('Can not bind variable');
		oci_bind_by_name($stid, "v_tgl_pelunasan", &$tgl_pelunasan,10) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_amount", &$amount,10) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_user", &$user,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_via", &$via,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_nojkm", &$nojkm,20) or die ('Can not bind variable');
		oci_bind_by_name($stid, "v_kdbank", &$kdbank,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_company", &$company,100) or die ('Can not bind variable');
		
		//Parameter Output
        oci_bind_by_name($stid, "v_status", &$status,20) or die ('Can not bind variable');
        oci_bind_by_name($stid, "v_msg", &$msg,100) or die ('Can not bind variable');
		oci_bind_by_name($stid, "v_email", &$email,100) or die ('Can not bind variable');

    if (!oci_execute($stid)) 
	{
		$e = oci_error($stid); 
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>87</status>
						<message>ORA - Database problem</message>
					</xml>";*/
					
		$xml_str = "^87^ORA - Database problem^$e[message]^$tgl_pelunasan";

		//UPDATE LOG
		// $res_param = str_replace($inv_char2,$fix_char2,$xml_str);
		// $log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'S', RES_PARAM = '$res_param', DATE_RES = sysdate where LG_ID = '$lg_id'";
		// $stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
		// if (!oci_execute($stid3))
		// {	
		// }
	
		oci_close($conn);
        return $xml_str;
    }
    else
    {
		$inv_char = array("&", "\"", "'", "<", ">");
		$fix_char = array(" ", " ", " ", " ", " ");
	
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
					
		// $xml_str = "^$v_outstatus^$v_outmsg^$nomor_nota^$v_no_faktur^$v_id_req^".str_replace($inv_char,$fix_char,$v_emkl)."^".str_replace($inv_char,$fix_char,$v_alamat)."^$v_vessel^$v_voyage_in^$v_voyage_out^$v_tgl_simpan^$v_tgl_payment^$v_payment_via^$v_total^$v_coa^$v_kd_modul^$v_ket^$v_ket_jenis^$v_apptocess_date^";
		
		$xml_str ="$status^$msg^$email";

		//UPDATE LOG
		// $res_param = str_replace($inv_char2,$fix_char2,$xml_str);
		// $log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'S', RES_PARAM = '$res_param', DATE_RES = sysdate where LG_ID = '$lg_id'";
		// $stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
		// if (!oci_execute($stid3))
		// {	
		// }

        oci_close($conn);		
        return $xml_str;
    }   
  }
  else
  {
		oci_close($conn);
		
		$e = oci_error($stid); 
		/*$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xml>
						<status>91</status>
						<message>Link down</message>
					</xml>";*/
		
		$xml_str = "^91^Link down^$e[message]";

		return $xml_str;
  }
}

function HelloWord($param)
{
	//if($conn = oci_connect('barang_prod', '$Prod_b4r4ngpass', 'dr-scan.indonesiaport.co.id/peldb'))
	//$conn = oci_connect('billing', 'billing', '10.10.12.218/orcl');
	//$conn = oci_connect('barang_prod', 'barang_prod', '10.10.12.218/peldb');
	$conn = oci_connect('barang_prod', '$Prod_b4r4ngpass', '10.10.30.22:1521/peldb');
	
	$query="select NAME from tr_kade where name like '%$param%'";
		
	$query2 = oci_parse($conn, $query);
	
	// oci_execute($query2);
	
	// while ($row = oci_fetch_array($query2, OCI_ASSOC))
		// {
			// $name = $row['NAME'];
			
			// $result .= "<trx>
					// <name>".$name."</name>
			   // </trx>";								
		// }
	
	if (!oci_execute($query2))
	{
		$e = oci_error($stid); 
		oci_close($conn);

		$xml_str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
		<xml>
			<status>87</status>
			<message>ORA - Database problem</message>
		</xml>";
					
		return $xml_str;
	}
	else 
	{
	
		while ($row = oci_fetch_array($query2, OCI_ASSOC))
		{
			$name = $row['NAME'];
			
			$result .= "<trx>
					<name>".$name."</name>
			   </trx>";								
		}
		
		return $result;
		
	}
	
	
	
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

$server->register('getReconcilePTP',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string','org_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getReconcilePTPBarang',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string','user_id' => 'xsd:string','bank_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getReconcilePTPKapalAutocollection',
            array('awal' => 'xsd:string','akhir' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('ePaymentBarangEdc',
            array('nota' => 'xsd:string','tgl_pelunasan' => 'xsd:string','amount' => 'xsd:string', 'user' => 'xsd:string','via' => 'xsd:string','nojkm' => 'xsd:string','kdbank' => 'xsd:string','company' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('HelloWord',
            array('helloword' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->service($HTTP_RAW_POST_DATA);