<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://10.10.31.36/portalService/ipcPortaldev.php"); //development



$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

// $modul="edcInquery";/*inquiry*/
$modul="edcPayment";/*payment*/

$noreq="211150500002";//nomor nota_number
$jenisnota="DELIVERY ANTAR PULAU";
$nm_user="DIDI";
$bank="MANDIRI";
$tgl_bayar="21/11/2014";
$trace_number="002524";
$approval_code="270951";
$channel="EDC";

// $result = $client->call($modul, array("no_request" => "$noreq"));
$result = $client->call($modul, array("no_request" => "$noreq", "jenisnota" => "$jenisnota","nm_user" => "$nm_user","bank" => "$bank","tgl_bayar" => "$tgl_bayar","trace_number" => "$trace_number","approval_code" => "$approval_code","channel" => "$channel"));

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
		//echo "tes= ";
        echo $result;
		
		/*
		$xml_data = new SimpleXMLElement($result);
		
		//var_dump($xml_data);
		
		echo $xml_data->status;
		echo $xml_data->message;
		echo $xml_data->nota_number;*/
		
    }
	
}
?>