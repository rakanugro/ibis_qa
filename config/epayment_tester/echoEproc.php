<?php
include "include.php";

//$modul="testService";
//$modul="generatePO";
$modul="populatePR";
$param1="85";
$param2="11-Dec-2014";

$result = $client->call($modul, array("in_param" => "$param1","in_param2" => "$param2"));

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