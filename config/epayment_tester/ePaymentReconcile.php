<?php
include "include.php";

/*Reconcile*/
$modul="getReconcilePtkmPnk";
$start_date="01-09-2015 00:00:00"; // DD-MM-YYYY
$end_date="01-09-2015 23:59:59"; // DD-MM-YYYY
$user_id="66";//userid
$bank_id="";
//cabang
//11006 : TPK BNI IDR 8064331, 11022 : TPK BRI IDR 86901000008303, 11004 : TPK MANDIRI IDR 1200073000031, 11023	TPK CIMB NIAGA IDR 4280100168009
//ptp
//dev
//102006 : PTP BNI IDR 888.600.2013, 104006	PTP Mandiri IDR 120.00.4107201.3, 108006 PTP CIMB Niaga IDR 428.01.00607.00.3
//prod
//105006 : PTP BNI IDR 888.600.2013, 105009	PTP Mandiri IDR 120.00.4107201.3, 105012 PTP CIMB Niaga IDR 428.01.00607.00.3

$org_id="";
//cabang priuk : 83 
//ptp : 1962 (dev), 1825 (prod)

$paid_channel="";//EDC: EDC CLOSEPAYMENT ILCS, NET: INTERNET BANKING ILCS, HOST2 : EPAYMENT HOST 2 HOST TELLER ILCS, ATM : ATM ILCS, BLANK = ALL

$result = $client->call($modul, array("startdate" => "$start_date","enddate" => "$end_date",'channel' => "$paid_channel",'userid' => "$user_id",'bankid' => "$bank_id",'orgid' => "$org_id"));

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