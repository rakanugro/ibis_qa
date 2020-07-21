<?php
include "include.php";

/*PTP Barang Reconcile*/
$modul="getReconcilePTPBarang";
$start_date="09-10-2014 00:00:00"; // DD-MM-YYYY
$end_date="31-12-2014 23:59:59"; // DD-MM-YYYY
$user_id="ILCS";//userid
$bank_id="";//102006 : PTP BNI IDR 888.600.2013, 104006	PTP Mandiri IDR 120.00.4107201.3

$paid_channel="";//EDC: EDC CLOSEPAYMENT ILCS, NET: INTERNET BANKING ILCS, HOST2 : EPAYMENT HOST 2 HOST TELLER ILCS, ATM : ATM ILCS, BLANK = ALL

$result = $client->call($modul, array("startdate" => "$start_date","enddate" => "$end_date",'channel' => "$paid_channel",'userid' => "$user_id",'bankid' => "$bank_id"));

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