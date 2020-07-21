<?php
require_once "lib/nusoap.php";

//======= Declare Function Service ========// 

function getDataCustomer($name) {

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '192.168.23.44/orcl')) {

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

function getInvoiceOBX($params,$usernm,$passwd) {

  /* XML Input */
  /*
<?xml version="1.0" encoding="UTF-8"?><document>
<header>
  <jns_req></jns_req>
  <no_req_old></no_req_old>
  <cust_id></cust_id>
  <cust_name></cust_name>
  <cust_npwp></cust_npwp>
  <cust_addr></cust_addr>
  <no_do></no_do>
  <no_bl></no_bl>
  <jns_sppb></jns_sppb>
  <no_sppb></no_sppb>
  <paid_thru></paid_thru>
  <tgl_sppb></tgl_sppb>
  <vessel></vessel>
  <voyage></voyage>
  <tgl_tiba></tgl_tiba>
  <user></user>
  <kode_lap></kode_lap>
</header>
<detail>
  <container>
    <number></number>
    <size></size>
    <type></type>
    <status></status>
    <hz></hz>
    <start></start>
    <end></end>
    <out_lini1></out_lini1>
  </container>
  <container>
    <number></number>
    <size></size>
    <type></type>
    <status></status>
    <hz></hz>
    <start></start>
    <end></end>
    <out_lini1></out_lini1>
  </container>
</detail>
</document>
  */  


  /* PARSING XML */
  $data = simplexml_load_string($params);

  $dt_header = $data->header;
  $jns_req   = $dt_header->jns_req;
  $noreq_old = $dt_header->no_req_old;
  $idcust    = $dt_header->cust_id;  
  $nmcust    = $dt_header->cust_name;
  $npwpcust  = $dt_header->cust_npwp;
  $addrcust  = $dt_header->cust_addr;
  $nodo      = $dt_header->no_do;
  $nobl      = $dt_header->no_bl;
  $jns_sppb  = $dt_header->jns_sppb;
  $no_sppb   = $dt_header->no_sppb;
  $paidthru  = $dt_header->paid_thru;
  $tglsppb   = $dt_header->tgl_sppb;
  $vessel    = $dt_header->vessel;
  $voyage    = $dt_header->voyage;
  $tgltiba   = $dt_header->tgl_tiba;
  $user      = $dt_header->user;
  $kode_lap  = $dt_header->kode_lap;

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '192.168.23.44/orcl')) {

    //=========================== Authentifikasi ================================//

        $sqlauth_1 = 'BEGIN PROC_AUTH_BILLING_ONL(:v_api, :v_usernm, :v_passwd, :v_xmls, :v_jnsnota, :v_status, :v_msg, :v_response); END;';
        $stmt_auth1 = oci_parse($conn,$sqlauth_1);
            
        //=== INPUT VARIABLE ===//
        oci_bind_by_name($stmt_auth1,':v_api','getInvoiceOBX',32);
        oci_bind_by_name($stmt_auth1,':v_usernm',$usernm,32);
        oci_bind_by_name($stmt_auth1,':v_passwd',$passwd,32);
        oci_bind_by_name($stmt_auth1,':v_xmls',$params,2000);
        oci_bind_by_name($stmt_auth1,':v_jnsnota','DELIVERY',32);
        oci_bind_by_name($stmt_auth1,':v_status','SERVICE ACCESS',32);

        //=== OUTPUT VARIABLE ===//
        oci_bind_by_name($stmt_auth1,':v_msg',$msg_auth,32);
        oci_bind_by_name($stmt_auth1,':v_response',$response_auth,32);

        // $name = 'Harry';
        oci_execute($stmt_auth1);
      
    //=========================== Authentifikasi ================================//      

  if($msg_auth=="OK")
  {
      if($jns_req=="NEW")
      {
          // HEADER
          $sql = 'BEGIN PROC_CREATE_DLV_ONL(:cust_id, :cust_name, :cust_npwp, :cust_addr, :no_do, :no_bl, :jns_sppb, :no_sppb, :paid_thru, :tgl_sppb, :vessel, :voyage, :tgl_tiba, :user, :kd_lap, :id_dlv, :no_req, :msg); END;';
          $stmt = oci_parse($conn,$sql);
          
          //=== INPUT VARIABLE ===//
          oci_bind_by_name($stmt,':cust_id',$idcust,32);
          oci_bind_by_name($stmt,':cust_name',$nmcust,32);
          oci_bind_by_name($stmt,':cust_npwp',$npwpcust,32);
          oci_bind_by_name($stmt,':cust_addr',$addrcust,32);
          oci_bind_by_name($stmt,':no_do',$nodo,32);
          oci_bind_by_name($stmt,':no_bl',$nobl,32);
          oci_bind_by_name($stmt,':jns_sppb',$jns_sppb,32);
          oci_bind_by_name($stmt,':no_sppb',$no_sppb,32);
          oci_bind_by_name($stmt,':paid_thru',$paidthru,32);
          oci_bind_by_name($stmt,':tgl_sppb',$tglsppb,32);
          oci_bind_by_name($stmt,':vessel',$vessel,32);
          oci_bind_by_name($stmt,':voyage',$voyage,32);
          oci_bind_by_name($stmt,':tgl_tiba',$tgltiba,32);
          oci_bind_by_name($stmt,':user',$user,32);
          oci_bind_by_name($stmt,':kd_lap',$kode_lap,32);     

          //=== OUTPUT VARIABLE ===//
          oci_bind_by_name($stmt,':id_dlv',$id_dlv,32);
          oci_bind_by_name($stmt,':no_req',$no_req,32);
          oci_bind_by_name($stmt,':msg',$msg,32);

          // $name = 'Harry';
          oci_execute($stmt);

          // DETAIL
          $dt_container = $data->container;  
          foreach ($dt_container as $dt_cont)
          {
            $nocont     = $dt_cont->number;  
            $szcont     = $dt_cont->size;
            $tycont     = $dt_cont->type;
            $stscont    = $dt_cont->status;
            $hzcont     = $dt_cont->hz;
            $start      = $dt_cont->start;
            $end        = $dt_cont->end;
            $out_lini1  = $dt_cont->out_lini1;

            $sqldetail = 'BEGIN PROC_ADD_CONT_DLV_ONL(:v_idreq, :v_nocont, :v_size, :v_type, :v_status, :v_hz, :v_start, :v_end, :v_outlini1, :v_msg); END;';
            $stmt_det = oci_parse($conn,$sqldetail);
            
            //=== INPUT VARIABLE ===//
            oci_bind_by_name($stmt_det,':v_idreq',$id_dlv,32);
            oci_bind_by_name($stmt_det,':v_nocont',$nocont,32);
            oci_bind_by_name($stmt_det,':v_size',$szcont,32);
            oci_bind_by_name($stmt_det,':v_type',$tycont,32);
            oci_bind_by_name($stmt_det,':v_status',$stscont,32);
            oci_bind_by_name($stmt_det,':v_hz',$hzcont,32);
            oci_bind_by_name($stmt_det,':v_start',$start,32);
            oci_bind_by_name($stmt_det,':v_end',$end,32);
            oci_bind_by_name($stmt_det,':v_outlini1',$out_lini1,32);

            //=== OUTPUT VARIABLE ===//
            oci_bind_by_name($stmt_det,':v_msg',$msg,32);

            // $name = 'Harry';
            oci_execute($stmt_det);
          }

          // INVOICE CALCULATION
          $calcInvoice = "BEGIN PROC_SAVE_NOTA_TEMP_DLV_ONL('$id_dlv','$jenis_req','013','$user','$kode_lap'); END;";
          $hitungInvoice = oci_parse($conn, $calcInvoice);
          oci_execute($hitungInvoice);

          // GET DATA INVOICE
          $getInvoice = "select LINE_NUMBER, 
                                KETERANGAN,
                                TARIF,
                                BIAYA,
                                PPN,
                                SIZE_CONT,
                                TYPE_CONT,
                                STS_CONT,
                                HZ,
                                JML_CONT,
                                TO_CHAR(START_STACK,'YYYYMMDDHH24MI') START,
                                TO_CHAR(END_STACK,'YYYYMMDDHH24MI') END,
                                JML_HARI,
                                TAX_FLAG
                          from TEMP_NOTA_ONL_D 
                          where ID_DLV = '$id_dlv'";
          $dataInvoice = oci_parse($conn, $getInvoice);
          oci_execute($dataInvoice); 

          $invoiceInfo = "";
          while ($row = oci_fetch_array($dataInvoice, OCI_ASSOC))
          {
            $line    = $row['LINE_NUMBER'];
            $ket     = $row['KETERANGAN'];
            $trf     = $row['TARIF'];
            $by      = $row['BIAYA'];
            $ppn     = $row['PPN'];
            $sz      = $row['SIZE_CONT'];
            $ty      = $row['TYPE_CONT'];
            $sts     = $row['STS_CONT'];
            $hz      = $row['HZ'];
            $jmlcont = $row['JML_CONT'];
            $mulai   = $row['START'];
            $akhir   = $row['END'];
            $jmlhari = $row['JML_HARI'];
            $tx      = $row['TAX_FLAG'];

            $invoiceInfo .= "<invoice><no_req>".$no_req."</no_req><line_number>".$line."</line_number><keterangan>".$ket."</keterangan><tarif>".$trf."</tarif><biaya>".$by."</biaya><ppn>".$ppn."</ppn><size>".$sz."</size><type>".$ty."</type><status>".$sts."</status><hz>".$hz."</hz><jml_cont>".$jmlcont."</jml_cont><start>".$mulai."</start><end>".$akhir."</end><jml_hari>".$jmlhari."</jml_hari><tax_flag>".$receipt_acc."</tax_flag></invoice>";        
          }            

          oci_close($conn);
      }
      else
      {
          // HEADER
          $sql = 'BEGIN proc_create_ext_dlv_onl(:v_noreq_old, :v_del_date, :v_user, :id_dlv, :no_req, :msg); END;';
          $stmt = oci_parse($conn,$sql);
          
          //=== INPUT VARIABLE ===//
          oci_bind_by_name($stmt,':v_noreq_old',$noreq_old,32);
          oci_bind_by_name($stmt,':v_del_date',$paidthru,32);
          oci_bind_by_name($stmt,':v_user',$user,32);

          //=== OUTPUT VARIABLE ===//
          oci_bind_by_name($stmt,':id_dlv',$id_dlv,32);
          oci_bind_by_name($stmt,':no_req',$no_req,32);
          oci_bind_by_name($stmt,':msg',$msg,32);

          // $name = 'Harry';
          oci_execute($stmt);

          // DETAIL
          $dt_container = $data->container;  
          foreach ($dt_container as $dt_cont)
          {
            $nocont     = $dt_cont->number;  
            $szcont     = $dt_cont->size;
            $tycont     = $dt_cont->type;
            $stscont    = $dt_cont->status;
            $hzcont     = $dt_cont->hz;
            $start      = $dt_cont->start;
            $end        = $dt_cont->end;
            $out_lini1  = $dt_cont->out_lini1;

            $sqldetail = 'BEGIN PROC_ADD_CONT_DLV_ONL(:v_idreq, :v_nocont, :v_size, :v_type, :v_status, :v_hz, :v_start, :v_end, :v_outlini1, :v_msg); END;';
            $stmt_det = oci_parse($conn,$sqldetail);
            
            //=== INPUT VARIABLE ===//
            oci_bind_by_name($stmt_det,':v_idreq',$id_dlv,32);
            oci_bind_by_name($stmt_det,':v_nocont',$nocont,32);
            oci_bind_by_name($stmt_det,':v_size',$szcont,32);
            oci_bind_by_name($stmt_det,':v_type',$tycont,32);
            oci_bind_by_name($stmt_det,':v_status',$stscont,32);
            oci_bind_by_name($stmt_det,':v_hz',$hzcont,32);
            oci_bind_by_name($stmt_det,':v_start',$start,32);
            oci_bind_by_name($stmt_det,':v_end',$end,32);
            oci_bind_by_name($stmt_det,':v_outlini1',$out_lini1,32);

            //=== OUTPUT VARIABLE ===//
            oci_bind_by_name($stmt_det,':v_msg',$msg,32);

            // $name = 'Harry';
            oci_execute($stmt_det);
          }

          // INVOICE CALCULATION
          $calcInvoice = "BEGIN PROC_SAVE_NOTA_TEMP_DLV_ONL('$id_dlv','$jenis_req','013','$user','$kode_lap'); END;";
          $hitungInvoice = oci_parse($conn, $calcInvoice);
          oci_execute($hitungInvoice);

          // GET DATA INVOICE
          $getInvoice = "select LINE_NUMBER, 
                                KETERANGAN,
                                TARIF,
                                BIAYA,
                                PPN,
                                SIZE_CONT,
                                TYPE_CONT,
                                STS_CONT,
                                HZ,
                                JML_CONT,
                                TO_CHAR(START_STACK,'YYYYMMDDHH24MI') START,
                                TO_CHAR(END_STACK,'YYYYMMDDHH24MI') END,
                                JML_HARI,
                                TAX_FLAG
                          from TEMP_NOTA_ONL_D 
                          where ID_DLV = '$id_dlv'";
          $dataInvoice = oci_parse($conn, $getInvoice);
          oci_execute($dataInvoice); 

          $invoiceInfo = "";
          while ($row = oci_fetch_array($dataInvoice, OCI_ASSOC))
          {
            $line    = $row['LINE_NUMBER'];
            $ket     = $row['KETERANGAN'];
            $trf     = $row['TARIF'];
            $by      = $row['BIAYA'];
            $ppn     = $row['PPN'];
            $sz      = $row['SIZE_CONT'];
            $ty      = $row['TYPE_CONT'];
            $sts     = $row['STS_CONT'];
            $hz      = $row['HZ'];
            $jmlcont = $row['JML_CONT'];
            $mulai   = $row['START'];
            $akhir   = $row['END'];
            $jmlhari = $row['JML_HARI'];
            $tx      = $row['TAX_FLAG'];

            $invoiceInfo .= "<invoice><no_req>".$no_req."</no_req><line_number>".$line."</line_number><keterangan>".$ket."</keterangan><tarif>".$trf."</tarif><biaya>".$by."</biaya><ppn>".$ppn."</ppn><size>".$sz."</size><type>".$ty."</type><status>".$sts."</status><hz>".$hz."</hz><jml_cont>".$jmlcont."</jml_cont><start>".$mulai."</start><end>".$akhir."</end><jml_hari>".$jmlhari."</jml_hari><tax_flag>".$receipt_acc."</tax_flag></invoice>";        
          }            

          oci_close($conn);
      }
  }
  else
  {
      $invoiceInfo .= "<invoice>".$response_auth."</invoice>";
  }

   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

  /* XML Output */
  /*
<?xml version="1.0" encoding="UTF-8"?><document>
<invoice>
  <no_req></no_req>
  <line_number></line_number>
  <keterangan></keterangan>
  <tarif></tarif>
  <biaya></biaya>
  <ppn></ppn>
  <size></size>
  <type></type>
  <status></status>
  <hz></hz>
  <jml_cont></jml_cont>
  <start></start>
  <end></end>
  <jml_hari></jml_hari>
  <tax_flag></tax_flag>
</invoice>
</document>
  */

    $xml_str = '<?xml version="1.0" encoding="UTF-8"?><document>'.$invoiceInfo.'</document>';
    return $xml_str;
}

function saveInvoiceOBX($noreq,$user) {

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '192.168.23.44/orcl')) {

        $query = "BEGIN PACK_CREATE_NOTA_PTP.SAVE_NOTA_DLV_ONL('$noreq','$user'); END;";
        $stid = oci_parse($conn, $query);

        oci_execute($stid);

        //get value result
        $query2 = "select NO_NOTA
                   from BIL_NOTA_DLV_ONL_H 
                   where trim(NO_REQUEST) = trim('$noreq')";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $no_nota = $row['NO_NOTA'];
        }
        
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

    return $no_nota;
}

function createAdviceOBX($no_nota,$bank_id,$channel,$tgl_bayar,$trc_numb,$apv_numb) {

    // db connection
   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '192.168.23.44/orcl')) {

      //get value result
      $query2 = "SELECT NO_NOTA,
                        NO_REQUEST,
                        TO_CHAR(TGL_NOTA,'DD/MM/RRRR HH24:MI:SS') TGL_NOTA,
                        CUST_NO,
                        CUST_NAME,
                        CUST_TAX_NO,
                        CUST_ADDR,              
                        TAGIHAN,
                        PPN,
                        TOTAL_TAGIHAN,
                        YARD
                      FROM BIL_NOTA_DLV_ONL_H
                     WHERE TRIM(NO_NOTA) = TRIM('$no_nota')";
      $query2 = oci_parse($conn, $query2);
      oci_execute($query2); 

      while ($row = oci_fetch_array($query2, OCI_ASSOC))
      {
        $no_nota  = $row['NO_NOTA'];
        $no_req   = $row['NO_REQUEST'];
        $tgl_nota = $row['TGL_NOTA'];
        $cust_no  = $row['CUST_NO'];
        $cust_nm  = $row['CUST_NAME'];
        $cust_tx  = $row['CUST_TAX_NO'];
        $cust_adr = $row['CUST_ADDR'];
        $tghn     = $row['TAGIHAN'];
        $ppn      = $row['PPN'];
        $ttl_tghn = $row['TOTAL_TAGIHAN'];
        $yd       = $row['YARD'];
      }  

      $user = "EDII";
      $tgl_cutoff = -10;
      $params = $no_nota."^".$no_req."^".$tgl_nota."^".$cust_no."^".$cust_nm."^".$cust_tx."^".$cust_adr."^".$ttl_tghn."^".$yd."^".$user."^".$tghn."^".$ppn."^".$tgl_cutoff;

      // HEADER TRANSFER STAGGING
      $sql_xpi2 = "begin pack_ar_transfer.proc_trf_delivery_onl('$params'); end;";
      $sql_xpi2 = oci_parse($conn, $sql_xpi2);
      oci_execute($sql_xpi2);

      // DETAIL TRANSFER STAGGING
      $sql_xpi3 = "begin pack_ar_transfer.proc_trf_delivery_onl_detail('$no_nota','$tgl_cutoff'); end;";
      $sql_xpi3 = oci_parse($conn, $sql_xpi3);
      oci_execute($sql_xpi3);

      // AR SIMKEU TRANSFER
      $query = "BEGIN PROC_PAYMENTCASH_DLV_ONL('$no_nota','$bank_id','$channel','$tgl_bayar'); END;";
      $stid = oci_parse($conn, $query);
      oci_execute($stid);

      oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

    return "Advice Success";
}


function generateReceiptOBX($no_nota) {
  
    // db connection
   if ($conn = oci_connect('PORTAL_EBS', 'r4has1a', '192.168.23.44/orcl')) {

        $query = "BEGIN GET_RECEIPT_BIL_ONL('$no_nota'); END;";
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }    

   return "Receipt Success";
}
 

$server = new soap_server();
$server->configureWSDL('portalipc', 'urn:portalipc');
 
$server->wsdl->schemaTargetNamespace = 'portalipc';

$server->register('getDataCustomer',
            array('name' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('getInvoiceOBX',
            array('xmlstring' => 'xsd:string','username' => 'xsd:string','password' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('saveInvoiceOBX',
            array('no_request' => 'xsd:string','user' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('createAdviceOBX',
            array('no_nota' => 'xsd:string','bank_id' => 'xsd:string','channel' => 'xsd:string','tgl_bayar' => 'xsd:string','trc_numb' => 'xsd:string','apv_numb' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('generateReceiptOBX',
            array('no_nota' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->service($HTTP_RAW_POST_DATA);