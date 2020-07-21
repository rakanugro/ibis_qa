<?php
include "include.php";

$modul="ePaymentInquiry";/*inquiry*/

$nota_number="0100111774001080";//nomor nota_number

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