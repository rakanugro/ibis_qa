<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*constant manual*/
define('APPNAME',"ibis_qa");
define('MAIN_DOMAIN', "http://".$_SERVER['SERVER_NAME']);
define('ROOT', MAIN_DOMAIN."/".APPNAME."/index.php/");
define('APP_ROOT', MAIN_DOMAIN."/".APPNAME."/");
define('UPLOADFOLDER_', $_SERVER['DOCUMENT_ROOT']."/".APPNAME."/");

define('CSS_', APP_ROOT."config/cube/css/");
define('CSS2_', APP_ROOT."config/css/");
define('CUBE_', APP_ROOT."config/cube/");
define('JSQ', APP_ROOT."config/jquery114/");
define('BSS_', APP_ROOT."config/bootstrap/css/");
define('JS_', APP_ROOT."config/cube/js/");
define('FILE_', APP_ROOT."config/file/");
define('IMAGES_', APP_ROOT."config/images/");

//localhost
define('IPAY', "http://103.19.81.26:28089/iPay/application/home");
define('IPAY_NEW', "http://103.19.80.113/ebpp_rec_edit/api/eservice");
define('IPAY_LOG', "https://103.19.80.113/ebpp_rec_edit/api/history_payment");
define('SMARTPAY', "http://103.19.81.26:28089/iPay/application/home");
define('VGM', "http://intranet.indonesiaport.co.id/solas/index_dev.php");

//ID
//define('JAI_ORG2', "2862");
define('JAI_ORG', "1582");

//https://eservice.indonesiaport.co.id
/*define('IPAY', "https://103.19.81.26:8443/iPay/application/home");
define('IPAY_LOG', "https://logiview.ilcs.co.id:8080/apex/f?p=149:1:::::P1_CUSTOMER:");
define('SMARTPAY', "https://103.19.81.26:28089/iPay/application/home");*/

define('YOU_DONT_HAVE_ACCESS', "SORRY,, you don't have access to this page");
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// START CONSTANTS NPK-BILLING
define('NPK_XML', "http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.billing:billing");
define('NPK_WSDL', "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.billing:billing/ipc_eService_provider_services_npkBilling_billing_billing_Port");

define('NPK_VESSEL', "http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.vessel:vessel");
define('NPK_VESSEL_PORT', "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.vessel:vessel/ipc_eService_provider_services_npkBilling_vessel_vessel_Port");

define('NPK_PEB', "http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.tpsOnline:searchPEB");
define('NPK_PEB_PORT', "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.tpsOnline:searchPEB/ipc_eService_provider_services_npkBilling_tpsOnline_searchPEB_Port");

define('NPK_TRACK_AND_TRACE', "http://ddcappipcesb.indonesiaport.co.id/ipc.eService.provider.services.npkBilling.tracknTrace:tracknTrace");
define('NPK_TRACK_AND_TRACE_PORT', "http://10.88.48.57:5555/ws/ipc.eService.provider.services.npkBilling.tracknTrace:tracknTrace/ipc_eService_provider_services_npkBilling_tracknTrace_tracknTrace_Port");

define('apiUrl', "http://10.88.48.33/api/public");
//END CONSTANTS NPK-BILLING

define('NPKS_TRACK_AND_TRACE', "http://ddcappipcesb.indonesiaport.co.id/ipc.npks.palembang.provider.soap.repo:repo");
define('NPKS_TRACK_AND_TRACE_PORT', "http://10.88.48.57:5555/ws/ipc.npks.palembang.provider.soap.repo:repo/ipc_npks_palembang_provider_soap_repo_repo_Port");


/* End of file constants.php */
/* Location: ./application/config/constants.php */
