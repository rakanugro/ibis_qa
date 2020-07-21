<?php

require_once "lib/nusoap.php";
$client = new nusoap_client("http://192.168.29.91/xpi2_po_eproc/"); //development
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="populatePR";
$param1="83";
$param2="22-Jan-2015";

//create log file
$file = date("Y-m-d h:i:s").";".$modul.".txt";
$log = fopen("./log/$file", "wb") or die("can't open file");
fwrite($log, $modul);

$result = $client->call($modul, array("in_param" => "$param1","in_param2" => "$param2"));

if ($client->fault) {
	echo "<h2>Fault</h2><pre>";
	print_r($result);
	echo "</pre>";
	
	fwrite($log, "<h2>Fault</h2><pre>");
	fwrite($log, $result);
	fwrite($log, "</pre>");
}
else {
	$error = $client->getError();
	if ($error) {
		echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
		
		fwrite($log, "<h2>Error 2</h2><pre>" . $error . "</pre>");
	}
	else {
		//Header('Content-type: text/xml');
		echo $result;
		
		fwrite($log, $result);
	}
}	

?> 