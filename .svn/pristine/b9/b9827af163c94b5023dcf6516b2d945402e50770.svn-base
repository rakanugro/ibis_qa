<?php
include "include.php";

/*Reconcile*/
$modul="ePaymentJKMPTP";
$trx_number = "010.010-14.60.021268";
$bank_account_id = "105012";//bank niaga = 108006
//ptp
//dev
//102006 : PTP BNI IDR 888.600.2013, 104006	PTP Mandiri IDR 120.00.4107201.3, 108006 PTP CIMB Niaga IDR 428.01.00607.00.3
//prod
//105006 : PTP BNI IDR 888.600.2013, 105009	PTP Mandiri IDR 120.00.4107201.3, 105012 PTP CIMB Niaga IDR 428.01.00607.00.3
$amount = "100000";
$receipt_date = "22-11-2014";//format dd-mm-yyyy
$receipt_category = "";
$receipt_source = "NET";//NET = Internet banking
$receipt_comment = "";

$result = $client->call($modul, 
array("in_trx_number" => "$trx_number","in_bank_account_id" => "$bank_account_id","in_amount" => "$amount","in_receipt_date" => "$receipt_date","in_receipt_category" => "$receipt_category","in_receipt_source" =>"$receipt_source","in_receipt_comment" =>"$receipt_comment","kd_modul" => "$kd_modul"));

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