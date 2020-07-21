<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://192.168.29.91/xpi2_po_eproc/"); //development
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="populatePO";
$req_header_id="31103";

$result = $client->call($modul, array("in_req_header_id" => "$req_header_id"));

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