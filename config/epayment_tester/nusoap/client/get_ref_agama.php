<?php
set_time_limit(0);

require_once("config.php");
require_once("lib/nusoap.php");

$wsdl = URL;

$client = new nusoap_client($wsdl);
$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;

$result = $client->call(
	'ref_tes'		
); 

$data = base64_decode($result);
$data = json_decode($data,true);
echo '<h3>Webservice Client</h3>';
echo '<table border=1><tr><td>Id</td><td>Nama Vessel</td><td>Voyage</td><td>Pelabuhan Asal</td><td>Pel Tujuan</td><td>ETA</td><td>ETD</td></tr>';
for($i=0;$i<$data['data_count'];$i++){
	echo '<tr><td>'.$data['data'][$i]['ID'].'</td><td>'.$data['data'][$i]['NAMA_VESSEL'].'</td>
	<td>'.$data['data'][$i]['VOYAGE'].'</td><td>'.$data['data'][$i]['PEL_ASAL'].'</td>
	<td>'.$data['data'][$i]['PEL_TUJUAN'].'</td><td>'.$data['data'][$i]['ETA'].'</td>
	<td>'.$data['data'][$i]['ETD'].'</td></tr>';
}
echo '</table>';
?>
