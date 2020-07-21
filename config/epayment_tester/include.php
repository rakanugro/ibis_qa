<?php
require_once "nusoap/service/lib/nusoap.php";
//$client = new nusoap_client("http://192.168.29.91/ePaymentPtpService/ipcPortal.php"); //production
//$client = new nusoap_client("http://10.10.31.36/ePaymentPtpService/ipcPortal.php"); //production
//$client = new nusoap_client("http://192.168.212.31/ePaymentPtpService/ipcPortal.php"); //production
//$client = new nusoap_client("http://10.10.31.36/ePaymentPtpService_Dev/ipcPortal.php"); //development
//$client = new nusoap_client("http://10.10.31.36/ePaymentPtpServiceTo3Domestik/ipcPortal.php"); //production
//$client = new nusoap_client("http://192.168.212.31/ePaymentPtpServiceTo3Domestik/ipcPortal.php"); //production
//$client = new nusoap_client("http://192.168.212.31/ePaymentPtpService/ipcPortal.php"); //development
//$client = new nusoap_client("http://10.10.31.36/ePaymentPtpServiceTo3Domestik_Dev/ipcPortal.php"); //development
//$client = new nusoap_client("http://10.10.33.56/ePaymentPtpServiceTo3Domestik_Dev/ipcPortal.php"); //development
//$client = new nusoap_client("http://intranet.indonesiaport.co.id/ePaymentPtpServiceDev/ipcPortal.php"); //development
//$client = new nusoap_client("http://192.168.212.31/xpi2_po_eproc"); //development
//$client = new nusoap_client("http://10.10.31.36/ePaymentPnkService_Dev/ipcPortal.php"); //development
//$client = new nusoap_client("http://10.10.31.36/ePaymentService_Dev/ipcPortal.php"); //development  -- 009
//$client = new nusoap_client("http://10.10.31.36/ePaymentService/ipcPortal.php"); //PRODUCTION
//$client = new nusoap_client("http://192.168.212.31/ePaymentService/ipcPortal.php"); //PRODUCTION
//$client = new nusoap_client("http://192.168.212.31/ePaymentPtpServiceTo3Domestik/ipcPortal.php"); //development to3 domestik
//$client = new nusoap_client("http://10.10.33.139/ePaymentPtpService/ipcPortal.php"); //development to3 domestik
//$client = new nusoap_client("http://www.ipccfscenter.com/TPSServices/server_plp.php"); //cfs
$client = new nusoap_client("http://10.10.32.244:9763/services/WSO2_TRAINING_FIAN?wsdl"); //cfs

$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
return;
}