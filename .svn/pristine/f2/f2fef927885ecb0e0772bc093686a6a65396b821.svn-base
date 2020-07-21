<?php
require_once "nusoap/service/lib/nusoap.php";
$client = new nusoap_client("http://192.168.212.31/ePaymentPtpService/ipcPortal.php"); //development


$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="ePaymentInquiry";/*inquiry*/

//cabang
$nota_number="010.010-14.60.013373";//nomor nota_number -- ok already paid
$nota_number="010.010-14.66.000056";//nomor nota_number -- error transfer nota
$nota_number="010.010-14.66.000054";//nomor nota_number -- error transfer nota
$nota_number="010.010-14.60.013393";//nomor nota_number -- ok e parsing
$nota_number="010.010-14.70.014004";//nomor nota_number -- ok e parsing
$nota_number="010.010-14.60.013390";//nomor nota_number
$nota_number="010.010-14.60.013372";//nomor nota_number
$nota_number="010.100-14.71.000009";//nomor nota_number
$nota_number="010.010-14.60.013360";//nomor nota_number
$nota_number="010.010-14.60.013350";//nomor nota_number
$nota_number="010.010-14.70.014003";//nomor nota_number
$nota_number="010.010-14.60.021268";//nomor nota_number

//pt ptp
$nota_number="0100131460000006";//nomor nota_number

$user_id="66";//ILCS:66

$result = $client->call($modul, array("nota_number" => "$nota_number", "user_id" => "$user_id"));

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
		
		/*
		$xml_data = new SimpleXMLElement($result);
		
		//var_dump($xml_data);
		
		echo $xml_data->status;
		echo $xml_data->message;
		echo $xml_data->nota_number;*/
		
    }
	
}