<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://10.10.31.36/epaymentLog"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

$modul="getAutoTotalHold";
$input="<root>
					<sc_type>1</sc_type>
					<sc_code>123456</sc_code>
					<data>
						<no_rek>$no_rek</no_rek> 
						<currency>$end_date</currency>
						<nama_agen>$sbmodul</nama_agen>
					</data>
				</root>";

$result = $client->call($modul, array("in_param" => "$input"));

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