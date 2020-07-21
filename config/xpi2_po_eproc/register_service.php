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

$server->register('populatePO',
            array('in_req_header_id' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('populatePR',
            array('in_org_id' => 'xsd:string','in_pr_date' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->register('populateItem',
            array('in_org_id' => 'xsd:string','in_update_date' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('populateVendor',
            array('in_org_id' => 'xsd:string','in_update_date' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->service($HTTP_RAW_POST_DATA);

?>