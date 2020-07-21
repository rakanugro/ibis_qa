<?php
$dir = dirname('http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);

require_once "lib/nusoap.php";
$client = new nusoap_client($dir); //PROD

$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="getVesselWaitingTime";
$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<port>IDJKT-ALL</port>
					<start_date>20150801000000</start_date>
					<end_date>20150801235959</end_date>
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