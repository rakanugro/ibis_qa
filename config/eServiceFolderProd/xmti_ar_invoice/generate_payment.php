<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://192.168.29.91/xmti_ar_invoice/"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="generatePayment";
$in_no_nota="0100111532000063";

$result = $client->call($modul, array("in_no_nota" => "$in_no_nota"));

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