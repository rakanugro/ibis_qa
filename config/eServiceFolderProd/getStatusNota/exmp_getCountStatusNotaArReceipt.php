<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://10.10.31.36/getStatusNota"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="getCountStatusNotaArReceipt";
$in_data="	<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<start_date>01-01-2015 00:00:00</start_date> 
					<end_date>28-02-2015 23:59:59</end_date>
					<modul>ALL</modul>
				</data>
			</root>";

$result = $client->call($modul, array("in_param" => "$in_data"));

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