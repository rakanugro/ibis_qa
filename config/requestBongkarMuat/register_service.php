<?php
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$                                                         					  |
  | Author                  : -                                                         			  |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By | 
  |---------------------------------------------------------------------------------------------------|
  */

$server = new soap_server();
$server->configureWSDL('portalipc2', 'urn:portalipc2');

$server->wsdl->schemaTargetNamespace = 'portalipc2';

$server->register('testService',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getVesselVoyage',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('requestDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getRequestDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('setApproval',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('getContainerFromRequestDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('requestPerpanjanganDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('requestReceiving',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getRequestReceiving',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');			

$server->register('getContainerFromRequestReceiving',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getDetailContainer',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('createRequestDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('addDetailContainer',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('delDetailContainer',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getDetailDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getRequestDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('saveRequestDelivery',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getPDFProformaContainer',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getPDFNotaContainer',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getCardContainer',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('getCardContainerThermal',
            array('in_param' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
						
$server->service($HTTP_RAW_POST_DATA);

?>