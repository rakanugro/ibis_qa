<?php
require_once "lib/nusoap.php";

//======= Declare Function Service ========// 
function getKursUSD($tanggal) {

    // db connection
   if ($conn = oci_connect('dw_wportal', 'w3bport4ldw', '192.168.23.15/dbpriok')) {

        //get value result
		/*
        $query2 = "select jual kurs from (
					select jual from mst_kurs 
					where valas = 'USD' and to_char(kurs_update,'RRRRMMDD') = '$tanggal'
					order by id_kurs desc
					) where rownum=1";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 
		*/
		
		$valas = 'USD';
        $sql = 'BEGIN PROC_DATA_KURS(:v_tanggal, :v_valas, :v_jual); END;';
        $stmt = oci_parse($conn,$sql);            
		//=== INPUT VARIABLE ===//
        oci_bind_by_name($stmt,':v_tanggal',$tanggal,32);
        oci_bind_by_name($stmt,':v_valas',$valas,32);

        //=== OUTPUT VARIABLE ===//
        oci_bind_by_name($stmt,':v_jual',$jual,32);

        // $name = 'Harry';
        oci_execute($stmt); 		
        oci_close($conn);
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
   return $jual;
}

$server = new soap_server();
$server->configureWSDL('portalipc', 'urn:portalipc');
 
$server->wsdl->schemaTargetNamespace = 'portalipc';

$server->register('getKursUSD',
            array('tanggal' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->service($HTTP_RAW_POST_DATA);

?>