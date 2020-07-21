<?php
//Init
require_once "lib/nusoap.php";
require_once "db_collection.php";

$client = new nusoap_client("http://192.168.29.91/xmti_ar_invoice/"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}

//======= Set Debug Mode ========//
function getDebugMode()
{
	//default is false // developer mode = true
	return true;
}

//======= Set Debug Mode 2 ========//
function getDebugMode2()
{
	//default is true
	return true;
}

echo $modul="generatePayment";

//create log file
$file = date("Y-m-d h:i:s").";".$modul.".txt";
$log = fopen(dirname(__FILE__)."/log/$file", "wb") or die("can't open file");
fwrite($log, $modul);

$conn['ori'] = oriDb();

if(!checkOriDb($conn['ori'],$err)) goto Err;

//get nota header from mti
$sql = "SELECT NO_NOTA FROM xmti.tth_nota_all2 where STATUS_NOTA='T' and bank_account_id is not null ";
if(!checkOriSQL($conn['ori']['mti'],$sql,$query_nota_header,$err,$debug)) goto Err;

while ($row = oci_fetch_array($query_nota_header, OCI_ASSOC))
{
	$in_no_nota=$row['NO_NOTA'];

	$result = $client->call($modul, array("in_no_nota" => "$in_no_nota"));

	if ($client->fault) {
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
		
		fwrite($log, "<h2>Fault</h2><pre>");
		fwrite($log, $result);
		fwrite($log, "</pre>");
	}
	else {
		$error = $client->getError();
		if ($error) {
			echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
			
			fwrite($log, "<h2>Error 2</h2><pre>" . $error . "</pre>");
		}
		else {
			//Header('Content-type: text/xml');
			echo $result;
			
			fwrite($log, $result);
		}
	}			
}

Err:
echo $err;
echo ";end";
fwrite($log, ";end");

?>