<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://192.168.29.91/xmti_ar_invoice/"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul				=	"getCustomerOrafin";
$customer_name		=	"VALEO AC INDONESIA, PT";//dikosongkan untuk ambil semua 
$customer_number	=	"";//dikosongkan untuk ambil semua
$insert_date_start	=	"";//dikosongkan untuk ambil semua
$insert_date_end	=	"";//dikosongkan untuk ambil semua

$result = $client->call($modul, array("customer_name" => "$customer_name", "customer_number" => "$customer_number", "insert_date_start" => "$insert_date_start", "insert_date_end" => "$insert_date_end"));

if ($client->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>"; 
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
    }
    else {
		//Header('Content-type: text/xml');
        echo $result;
    }
}
?>