<?php
include "include.php";

/*Payment*/
$modul="ePaymentPaid";

echo $nomor_nota="0100131760025140";//no nota

$user_id="66";//userid
$bank_id="105009";
//cabang
//11006 : TPK BNI IDR 8064331, 11022 : TPK BRI IDR 86901000008303, 11004 : TPK MANDIRI IDR 1200073000031, 11023	TPK CIMB NIAGA IDR 4280100168009
//ptp
//dev
//102006 : PTP BNI IDR 888.600.2013, 104006	PTP Mandiri IDR 120.00.4107201.3, 108006 CIMB Niaga IDR 428.01.00607.00.3
//prod
//105006 : PTP BNI IDR 888.600.2013, 105009	PTP Mandiri IDR 120.00.4107201.3, 105012 CIMB Niaga IDR 428.01.00607.00.3

$paid_date="150320171205";//tanggal pembayaran dengan format 'ddmmyyyyhh24mi'
$paid_channel="EDC";//EDC: EDC CLOSEPAYMENT ILCS, NET: INTERNET BANKING ILCS, HOST2 : EPAYMENT HOST 2 HOST TELLER ILCS, ATM : ATM ILCS

$result = $client->call($modul, array("nomor_nota" => "$nomor_nota","user_id" => "$user_id",'bank_id' => "$bank_id", 'paid_date' => "$paid_date",'paid_channel' => "$paid_channel"));

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