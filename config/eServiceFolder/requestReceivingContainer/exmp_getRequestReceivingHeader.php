<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://192.168.29.91/requestReceivingContainer"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="getRequestReceivingHeader";
$in_data="<root>
	<sc_type>1</sc_type>
	<sc_code>123456</sc_code>
	<data>
		<agent_id>25169</agent_id>
		<request_no></request_no>
		<start_rownum></start_rownum>
		<end_rownum></end_rownum>
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