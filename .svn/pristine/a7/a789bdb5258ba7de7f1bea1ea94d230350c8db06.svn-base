<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://intranet.indonesiaport.co.id/xpi2_po_eproc/"); //development
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="populateItem";
$in_org_id="82";
$in_update_date="30-JAN-2015";

$result = $client->call($modul, array("in_org_id" => "$in_org_id","in_update_date" => "$in_update_date"));

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