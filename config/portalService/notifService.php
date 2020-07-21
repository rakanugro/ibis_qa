<?php
require_once "lib/nusoap.php";

//======= Declare Function Service ========// 
function sendSMS($data_nohp,$content,$usernm,$passwd) {

   //============= cek akses ===================// 
    // db connection
   if ($conn = oci_connect('dw_wportal', 'w3bport4ldw', '192.168.23.15/dbpriok')) {

        //get value result
        $query2 = "select count(*) jml
                   from NOTIF_USER 
                   where trim(username) = trim('$usernm') and trim(password) = trim('$passwd')";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $usercek = $row['JML'];
        }
        
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
  //============= cek akses ===================//

  if($usercek>0)
  {
      $hp_numb = explode("-",$data_nohp);
      $strings = str_replace(" ","+",$content);
      $katar = $strings;

      for ($i = 0; $i < count($hp_numb); ++$i) {
          $nohp = $hp_numb[$i];
          file_get_contents('http://mdmobileads.com/clientapi.php?msisdn='.$nohp.'&senderid=IPC&user=pelindo&password=pelindo123&message='.$katar); 
      }

      //============= insert log service ===================//
       // db connection
       if ($conn = oci_connect('dw_wportal', 'w3bport4ldw', '192.168.23.15/dbpriok')) {

            $query = "insert into NOTIF_LOG_ACCESS values (
                                seq_notif_log.nextval,
                                '".$usernm."',
                                '".$data_nohp."',
                                '".$content."',
                                'SMS',
                                sysdate)";
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            
            oci_close($conn);
       } else {
          $errmsg = oci_error();
          print 'Oracle connect error: ' . $errmsg['message'];
       }  
      //============= insert log service ===================//
      
      return "SMS Sent";
  } 
  else
  {
      return "Invalid User";
  }

}

//======= Declare Function Service ========// 
function sendEMAIL($data_email,$subj,$content,$usernm,$passwd) {

   //============= cek akses ===================// 
    // db connection
   if ($conn = oci_connect('dw_wportal', 'w3bport4ldw', '192.168.23.15/dbpriok')) {

        //get value result
        $query2 = "select count(*) jml
                   from notif_user 
                   where trim(username) = trim('$usernm') and trim(password) = trim('$passwd')";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $usercek = $row['JML'];
        }
        
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
  //============= cek akses ===================//

  if($usercek>0)
  {
 
      require_once "Mail.php"; // PEAR Mail package
      require_once "Mail/mime.php"; // PEAR Mail_Mime packge
 
      // sent email code yang bener
      $from = "C.S Datin Priok <datinpriok@indonesiaport.co.id>";
      $to = $data_email;

      $subject = $subj;

      $headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

      $text = $content;// text and html versions of email.

      $crlf = "\n";

      $mime = new Mail_mime($crlf);
      $mime->setTXTBody($text);
        
      ///$mime->addAttachment($attachment,'application/x-xls',$name,true,'base64'); 

      //do not ever try to call these lines in reverse order
      $body = $mime->get();
      $headers = $mime->headers($headers);

      $host = "mail.indonesiaport.co.id";
      $username = "datinpriok@indonesiaport.co.id";
      $password = "d4t1nc4b";

      $smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,
      'username' => $username,'password' => $password));

      $mail = $smtp->send($to, $headers, $body);

      //============= insert log service ===================//
       // db connection
       if ($conn = oci_connect('dw_wportal', 'w3bport4ldw', '192.168.23.15/dbpriok')) {

            $query = "insert into NOTIF_LOG_ACCESS values (
                                seq_notif_log.nextval,
                                '".$usernm."',
                                '".$data_email."',
                                '".$content."',
                                'EMAIL',
                                sysdate)";
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            
            oci_close($conn);
       } else {
          $errmsg = oci_error();
          print 'Oracle connect error: ' . $errmsg['message'];
       }  
      //============= insert log service ===================//

      if (PEAR::isError($mail)) {
      //  echo("<script>
      //alert('".$mail->getMessage()."');
      // </script>");
      return "email failed";
          
      }
      else {
       //echo $_FILES['kirim_email']['tmp_name'];
      return "email sent";
      } 
  } 
  else
  {
      return "Invalid User";
  }

}

$server = new soap_server();
$server->configureWSDL('portalipc', 'urn:portalipc');
 
$server->wsdl->schemaTargetNamespace = 'portalipc';

$server->register('sendSMS',
            array('receiver' => 'xsd:string','content' => 'xsd:string','username' => 'xsd:string','password' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('sendEMAIL',
            array('receiver' => 'xsd:string','subject' => 'xsd:string','content' => 'xsd:string','username' => 'xsd:string','password' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');  

$server->service($HTTP_RAW_POST_DATA);

?>