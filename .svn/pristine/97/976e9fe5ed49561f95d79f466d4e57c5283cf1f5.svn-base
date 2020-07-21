<?php
require_once('config.php'); 
require_once('lib/nusoap.php');
require_once('function.php');


$server = new soap_server;
$server->soap_defencoding = 'UTF-8';
$server->configureWSDL(WSDL_NAME, 'urn:'.WSDL_NAME);

$server->register('ref_agama', array('passwd' => 'xsd:string', 'compressed' => 'xsd:int'), array('return' => 'xsd:string'),
    'urn:'.WSDL_NAME, 'urn:'.WSDL_NAME.'#ref_agama',
    'rpc', 'encoded',
	'<br><blockquote>Referensi Agama<br>'.$s_count
);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>
