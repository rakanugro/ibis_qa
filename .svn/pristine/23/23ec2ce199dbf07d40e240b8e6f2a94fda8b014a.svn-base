<?php

//$server_name = 'http://'. $_SERVER['SERVER_NAME'];
$server_name = 'http://10.10.31.36';
$service_list = array(
				"$server_name/eServiceFolder/trackingContainer/",
				"$server_name/eServiceFolder/requestDeliveryContainer/",
				"$server_name/eServiceFolder/trackingRequestInvoiceContainer/",
				"$server_name/eServiceFolder/requestPerpanjanganDelivery/",
				"$server_name/eServiceFolder/customer/",
				"$server_name/eServiceFolder/vessel/",
				"$server_name/eServiceFolder/requestBongkarMuat/",
				"$server_name/portCooperation/",
				"$server_name/simopCustomer/",
				"$server_name/eServiceFolder/requestReceivingContainer/",
				"$server_name/eServiceFolder/dashboard/",
				"$server_name/transferCustomer/",
				"$server_name/eServiceFolder/requestBatalMuat/",
				"$server_name/StatusContainer/",
			);

//create log file
/*$file = date("Y-m-d h:i:s").";test_all_service_sd.txt";
$log = fopen(dirname(__FILE__)."/log/$file", "wb") or die("can't open file");
fwrite($log, "test_all_service_sd;");*/

require_once "data_collection.php";
require_once "db_collection.php";
require_once "lib/nusoap.php";

$conn['ori'] = oriDb();

if(!checkOriDb($conn['ori'],$err)) goto Err;

foreach ($service_list as $arrservice_list) {
	echo '<br/>'.$arrservice_list.'<br/>';

	$client = new nusoap_client($arrservice_list); //PROD
	$error = $client->getError();
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
		
		$health_check = "F";
		$message = "<h2>Constructor error</h2><pre>" . $error . "</pre>";
		goto SaveOrUpdate;
		//return;
	}
	else 
	{
		$modul="testService";
		$input="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
						</data>
					</root>";
		
		$result = $client->call($modul, array("in_param" => "$input"));

		if ($client->fault) {
			echo "<h2>Fault</h2><pre>";
			print_r($result);
			echo "</pre>";
			
			$health_check = "F";
			$message = "<h2>Fault</h2><pre>".$result."</pre>";
			goto SaveOrUpdate;
		}
		else {
			$error = $client->getError();
			if ($error) {
				echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
				
				$health_check = "F";
				$message = "<h2>Error 2</h2><pre>" . $error . "</pre>";
				goto SaveOrUpdate;
			}
			else {
				echo $result;
				
				$pieces = explode("^", $result);
				
				echo $pieces[0];
				if($pieces[0]=="S")
				{
					$health_check = "S";
					$message = $pieces[1];
					goto SaveOrUpdate;
				}
				{
					$health_check = "F";
					$message = $pieces[1];
					goto SaveOrUpdate;
				}
			}
		}
	}

	SaveOrUpdate:
	
		//get nota header from mti
		$sql = "select count(API_NAME) as jumlah_api from ibis.api_health_check where API_NAME = '$arrservice_list'";

		if(!checkOriSQLAutoCommit($conn['ori']['ibis'],$sql,$query,$err,$debug)) goto Err;

		$row = oci_fetch_array($query, OCI_ASSOC);
		
		if($row[JUMLAH_API]>0)
		{
			$sql = "update ibis.api_health_check set 
								HEALTH_CHECK = '$health_check',
								MESSAGE = '$message',
								LAST_HEALTH_CHECK=sysdate 
								WHERE API_NAME = '$arrservice_list'";
		}
		else
		{
			$sql = "insert into ibis.api_health_check (API_NAME,HEALTH_CHECK,MESSAGE,LAST_HEALTH_CHECK) VALUES ('$arrservice_list','$health_check','$message',sysdate)";
		}
		
		if(!checkOriSQLAutoCommit($conn['ori']['ibis'],$sql,$query,$err,$debug)) goto Err;
}

Err:
echo $err;
echo ";end";
//fwrite($log, ";end");
?>