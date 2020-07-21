<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://10.10.31.36/deliveryOrder"); //PROD
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	return;
}
  
$modul="insertDeliveryOrderTest";
$input="<root>
					<sc_type>2</sc_type>
					<sc_user>123456</sc_user>
					<sc_code>123456</sc_code>
					<data>
						<d_o>
							<do_no>123</do_no>
							<ves_callsign>ves callsign</ves_callsign>
							<ves_voyin>ves voyin</ves_voyin>
							<ves_voyout>ves voyout</ves_voyout>
							<ves_name>ves name</ves_name>
							<ves_ukk>ves ukk</ves_ukk>
							<expired_date>01-08-2015</expired_date>
							<detail>
								<container>
									<no>123456</no>
									<carrier>con carrier</carrier>
									<isocode>cont isocode</isocode>
									<status>cont status </status>
								</container>
								<container>
									<no>1234567</no>
									<carrier >con carrier U1</carrier>
									<isocode>cont isocode U2</isocode>
									<status>cont status U3</status>						
								</container>
							</detail>
						</d_o>
						<d_o>
							<do_no>1234</do_no>
							<ves_callsign>ves callsign U1</ves_callsign>
							<ves_voyin>ves voyin U1</ves_voyin>
							<ves_voyout>ves voyout U1</ves_voyout>
							<ves_name>ves name U1</ves_name>
							<ves_ukk>ves ukk U1</ves_ukk>
							<expired_date>01-09-2015</expired_date>
							<detail>
								<container>
									<no>123456</no>
									<carrier>con carrier U1</carrier>
									<isocode>cont isocode U1</isocode>
									<status>cont status U1</status>
								</container>								
							</detail>
						</d_o>						
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