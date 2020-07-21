<?php
include "include.php";

/*PTP Barang Reconcile*/
$modul="getReconcilePTPKapalAutocollection";
$start_date="20-02-2014 00:00:00"; // DD-MM-YYYY
$end_date="22-03-2015 23:59:59"; // DD-MM-YYYY

$paid_channel="";//EDC: EDC CLOSEPAYMENT ILCS, NET: INTERNET BANKING ILCS, HOST2 : EPAYMENT HOST 2 HOST TELLER ILCS, ATM : ATM ILCS, BLANK = ALL

$result = $client->call($modul, array("startdate" => "$start_date","enddate" => "$end_date"));

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