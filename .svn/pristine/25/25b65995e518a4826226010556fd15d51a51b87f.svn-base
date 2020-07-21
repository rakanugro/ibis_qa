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

function nmPelanggan($noreq) {

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '192.168.23.16/orcl')) {

        $query = "select cust_name, cust_addr from req_dlv_h where trim(no_request) = trim('$noreq')";
        $query = oci_parse($conn, $query);
        oci_execute($query); 

        while ($row = oci_fetch_array($query, OCI_ASSOC))
        {
            $nm_plg = $row['CUST_NAME'];
            $almt_plg = $row['CUST_ADDR'];
        }
        // echo $query.';'; 

        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

    return "Nama Pelanggan : ".$nm_plg."<br/>Alamat Pelanggan : ".$almt_plg;
}

function getReckonPLP($awal,$akhir,$channel) {

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '10.10.33.25/orcl')) {

        //get value result
    if($channel=="OTHERS")
    {
        $query2 = "select no_nota,
                          to_char(tgl_nota,'DD/MM/RRRR') tgl_nota,
                          faktur_pajak,
                          tagihan,
                          ppn,
                          total_tagihan,
                          status,
                          cust_no,
                          cust_name,
                          cust_tax_no,
                          cust_address,
                          lunas,
                          to_char(tgl_entry_lunas,'DD/MM/RRRR HH24:MI:SS') tgl_lunas,
                          receipt_method,
                          receipt_account,
                          currency,
                          username,
                          terminal,
                          no_request,
                          bank_id,
                          yard,
                          jenis_nota,
                          user_service,
                          payment_channel
                   from bil_nota_ptp_h 
                   where to_char(tgl_entry_lunas,'RRRRMMDDHH24MI') between trim('$awal') and trim('$akhir')
                   and trim(user_service) = 'ILCS'
                   order by tgl_entry_lunas desc";
    }
    else
    {
        $query2 = "select no_nota,
                          to_char(tgl_nota,'DD/MM/RRRR') tgl_nota,
                          faktur_pajak,
                          tagihan,
                          ppn,
                          total_tagihan,
                          status,
                          cust_no,
                          cust_name,
                          cust_tax_no,
                          cust_address,
                          lunas,
                          to_char(tgl_entry_lunas,'DD/MM/RRRR HH24:MI:SS') tgl_lunas,
                          receipt_method,
                          receipt_account,
                          currency,
                          username,
                          terminal,
                          no_request,
                          bank_id,
                          yard,
                          jenis_nota,
                          user_service,
                          payment_channel
                   from bil_nota_ptp_h 
                   where to_char(tgl_entry_lunas,'RRRRMMDDHH24MI') between trim('$awal') and trim('$akhir')
                   and trim(payment_channel) = upper('$channel')
                   and trim(user_service) = 'ILCS'
                   order by tgl_entry_lunas desc";
    }

        $query2 = oci_parse($conn, $query2);
        oci_execute($query2);

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $no_nota = $row['NO_NOTA'];
            $tgl_nota = $row['TGL_NOTA'];
            $faktur = $row['FAKTUR_PAJAK'];
            $tagihan = $row['TAGIHAN'];
            $ppn = $row['PPN'];
            $total = $row['TOTAL_TAGIHAN'];
            $stat = TRIM($row['STATUS']);
            $custno = $row['CUST_NO'];
            $custnm = $row['CUST_NAME'];
            $custnpwp = $row['CUST_TAX_NO'];
            $custaddr = $row['CUST_ADDRESS'];
            $lunas = $row['LUNAS'];
            $tgl_lunas = $row['TGL_LUNAS'];
            $receipt_mtd = $row['RECEIPT_METHOD'];
            $receipt_acc = $row['RECEIPT_ACCOUNT'];
            $currency = $row['CURRENCY'];
            $usernm = $row['USERNAME'];
            $term = $row['TERMINAL'];
            $noreq = $row['NO_REQUEST'];
            $bankid = $row['BANK_ID'];
            $yard = $row['YARD'];
            $jns_nota = $row['JENIS_NOTA'];
            $user_servis = $row['USER_SERVICE'];
            $pay_channel = $row['PAYMENT_CHANNEL'];

            $detail_reckon .= "<trx><no_nota>".$no_nota."</no_nota><tgl_nota>".$tgl_nota."</tgl_nota><faktur_pajak>".$faktur."</faktur_pajak><tagihan>".$tagihan."</tagihan><ppn>".$ppn."</ppn><total>".$total."</total><status>".$stat."</status><cust_number>".$custno."</cust_number><cust_name>".$custnm."</cust_name><cust_npwp>".$custnpwp."</cust_npwp><cust_address>".$custaddr."</cust_address><lunas>".$lunas."</lunas><tgl_lunas>".$tgl_lunas."</tgl_lunas><receipt_method>".$receipt_mtd."</receipt_method><receipt_account>".$receipt_acc."</receipt_account><currency>".$currency."</currency><user>".$usernm."</user><terminal>".$term."</terminal><no_request>".$noreq."</no_request><bank_id>".$bankid."</bank_id><yard>".$yard."</yard><jenis_nota>".$jns_nota."</jenis_nota><user_service>".$user_servis."</user_service><payment_channel>".$pay_channel."</payment_channel></trx>";
        }
        
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

    $xml_str = '<?xml version="1.0" encoding="UTF-8"?><document>'.$detail_reckon.'</document>';

    return $xml_str;
}

function edcInquery($noreq) {
	

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '10.10.33.25/orcl')) {
	   
	   //return "coba2";

    //=========================== lOGGING ================================//
        $querylog = "insert into LOG_EPAYMENT_SERVICE (NO_REQUEST,
                                                       API_SERVICE,
                                                       CREATED_DATE,
                                                       CREATED_BY,
                                                       STATUS) 
                                                      values
                                                            ('".$noreq."',
                                                             'INQUIRY',
                                                             SYSDATE,
                                                             'ILCS',
                                                             'CALL PROCEDURE')";
        $stid_log = oci_parse($conn, $querylog);
        oci_execute($stid_log);
      
    //=========================== lOGGING ================================//    

        $query = "BEGIN EDC_INQUERY_NEO('".$noreq."'); end;";
        $stid = oci_parse($conn, $query);

        oci_execute($stid);

        //get value result
        $query2 = "select msg,
                          tgl_request,
                          jenis_request,
                          nama_pelanggan,
                          amount,
                          nm_user
                   from temp_edc_inquery 
                   where trim(no_request) = trim('$noreq')";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $user = $row['NM_USER'];
            $tagihan = $row['AMOUNT'];
            $nm_plg = TRIM($row['NAMA_PELANGGAN']);
            $jns_req = $row['JENIS_REQUEST'];
            $tgl_req = $row['TGL_REQUEST'];
            $message_edc = $row['MSG'];
        }
        
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

    return $message_edc."^".$tgl_req."^".$jns_req."^".$nm_plg."^".$tagihan."^".$user;
}

function edcPayment($noreq,$jenisnota,$nm_user,$bank,$tgl_bayar,$no_struk,$apv_code,$channel_type) {

   if($channel_type==null)
   {
      $chn = "EDC";
   }
   elseif (TRIM($channel_type)=='TELLER') 
   {
      $chn = "H2H";
   }
   else
   {
      $chn = TRIM($channel_type);
   } 

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '10.10.33.25/orcl')) {

/*
      if($chn=='EDC')    
      {  
          $query = "BEGIN EDC_PAID_NEO('".$noreq."','".$jenisnota."','".$nm_user."','".$bank."','".$tgl_bayar."','".$no_struk."','".$apv_code."','".$chn."'); end;";
          $stid = oci_parse($conn, $query);
          oci_execute($stid);

          //get value result
          $query2 = "select msg,
                            no_nota,
                            tgl_nota,
                            amount,
                            keterangan,
                            lapangan,
  						    ptp_status
                     from temp_edc_paid 
                     where trim(no_request) = trim('$noreq')";
          $query2 = oci_parse($conn, $query2);
          oci_execute($query2); 

          while ($row = oci_fetch_array($query2, OCI_ASSOC))
          {
              $lap = $row['LAPANGAN'];
              $ket = $row['KETERANGAN'];
              $tagihan = $row['AMOUNT'];
              $no_nota = $row['NO_NOTA'];
              $tgl_nota = $row['TGL_NOTA'];
              $msg_edc_payment = $row['MSG'];
  			      $status_ptp = $row['PTP_STATUS'];
          }
      }
      else
*/
      
      if(($chn=='H2H')||($chn=='EDC'))
      {
            $sql = 'BEGIN H2H_PAID(:noreq, :jenisnota, :nm_user, :bank, :tgl_bayar, :no_struk, :apv_code, :chn, :lap, :ket, :tagihan, :no_nota, :tgl_nota, :msg, :stat_ptp); END;';
            $stmt = oci_parse($conn,$sql);
            //=== INPUT VARIABLE ===//
            oci_bind_by_name($stmt,':noreq',$noreq,32);
            oci_bind_by_name($stmt,':jenisnota',$jenisnota,32);
            oci_bind_by_name($stmt,':nm_user',$nm_user,32);
            oci_bind_by_name($stmt,':bank',$bank,32);
            oci_bind_by_name($stmt,':tgl_bayar',$tgl_bayar,32);
            oci_bind_by_name($stmt,':no_struk',$no_struk,32);
            oci_bind_by_name($stmt,':apv_code',$apv_code,32);
            oci_bind_by_name($stmt,':chn',$chn,32);

            //=== OUTPUT VARIABLE ===//
            oci_bind_by_name($stmt,':lap',$lap,32);
            oci_bind_by_name($stmt,':ket',$ket,32);
            oci_bind_by_name($stmt,':tagihan',$tagihan,32);
            oci_bind_by_name($stmt,':no_nota',$no_nota,32);
            oci_bind_by_name($stmt,':tgl_nota',$tgl_nota,32);
            oci_bind_by_name($stmt,':msg',$msg_edc_payment,32);
            oci_bind_by_name($stmt,':stat_ptp',$status_ptp,32);

            // $name = 'Harry';
            oci_execute($stmt);         
      }
      else
      {
            $msg_edc_payment = "PAYMENT ERROR";
            $ket = "PAYMENT CHANNEL IS NOT REGISTERED";
      }  

        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

    return $msg_edc_payment."^".$no_nota."^".$tgl_nota."^".$tagihan."^".$ket."^".$lap."^".$status_ptp;
}



function holdContainer($idrec,$nocont) {
    return "ID REC ".$idrec." NO CONTAINER ".$nocont;
}
 
function releaseContainer($idrec,$nocont) {
    return "ID REC ".$idrec." NO CONTAINER ".$nocont;
}

$server = new soap_server();
$server->configureWSDL('portalipc', 'urn:portalipc');
 
$server->wsdl->schemaTargetNamespace = 'portalipc';
 
$server->register('getProd',
            array('category' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('getReckonPLP',
            array('awal' => 'xsd:string','akhir' => 'xsd:string','channel' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('edcInquery',
            array('no_request' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('nmPelanggan',
            array('no_request' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('edcPayment',
            array('no_request' => 'xsd:string','jenisnota' => 'xsd:string','nm_user' => 'xsd:string','bank' => 'xsd:string','tgl_bayar' => 'xsd:string','trace_number' => 'xsd:string','approval_code' => 'xsd:string','channel' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('holdContainer',
            array('idRec' => 'xsd:integer'),
            array('noContainer' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('releaseContainer',
            array('idRec' => 'xsd:integer'),
            array('noContainer' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->service($HTTP_RAW_POST_DATA);