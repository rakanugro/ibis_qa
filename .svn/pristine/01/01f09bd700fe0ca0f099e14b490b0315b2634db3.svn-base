<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://192.168.29.91/ePaymentPtpService/ipcPortal.php"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}
// $modul="HelloWord";
// $name="INGGOM";

$modul="ePaymentBarangEdc";
$nota="XXX111421000011"; //string
$tgl_pelunasan="21/02/2014"; //string
$amount=1000; //number
$user="HelloWord"; //string
$via="HelloWord"; //string
$nojkm="HelloWord"; //string
$kdbank="HelloWord"; //string
$company="HelloWord";//string

// $result = $client->call($modul, array("helloword" => "$name"));

$result = $client->call($modul, array("nota" => "$nota","tgl_pelunasan" => "$tgl_pelunasan","amount" => "$amount","user" => "$user","via" => "$via","nojkm" => "$nojkm","kdbank" => "$kdbank","company" => "$company"));

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