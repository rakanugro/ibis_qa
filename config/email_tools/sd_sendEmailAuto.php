<?php

//Init
require_once "lib/nusoap.php";
require_once "db_collection.php";

$client = new nusoap_client("http://192.168.29.91/email_tools/"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

//======= Set Debug Mode ========//
function getDebugMode()
{
	//default is false // developer mode = true
	return true;
}

//======= Set Debug Mode 2 ========//
function getDebugMode2()
{
	//default is true
	return true;
}

//Action
$modul="sendEmailAuto";
$in_data="<root>
	<sc_type>1</sc_type>
	<sc_code>123456</sc_code>
	<data>
		<data_source></data_source>
	</data>
</root>";

//create log file
//$file = date("Y-m-d h:i:s").";".$modul.".txt";
//$log = fopen(dirname(__FILE__)."/log/$file", "wb") or die("can't open file");
//fwrite($log, $modul);

$result = $client->call($modul, array("in_param" => "$in_data"));

if ($client->fault) {
	echo "<h2>Fault</h2><pre>";
	print_r($result);
	echo "</pre>";
	
	//fwrite($log, "<h2>Fault</h2><pre>");
	//fwrite($log, $result);
	//fwrite($log, "</pre>");
	
}
else {
	$error = $client->getError();
	if ($error) {
		echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
		
		//fwrite($log, "<h2>Error 2</h2><pre>" . $error . "</pre>");
	}
	else {
		//Header('Content-type: text/xml');
		echo $result;
		
		//fwrite($log, $result);
	}
}

Err:
echo $err;
echo ";end";
fwrite($log, ";end");
?>