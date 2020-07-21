<?php
define("XMTI_WSDL","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/xmti_ar_invoice/");
define("RECON","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/getStatusNota/");
define("EPAYMENT_LOG","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/epaymentLog/");

define("VESSEL","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/vessel/");
define("CUSTOMER","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/customer/");
define("TRACKING_REQUEST_INVOICE_CONTAINER","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/trackingRequestInvoiceContainer/");
define("TRACKING_CONTAINER","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/trackingContainer/");
define("REQUEST_PERPANJANGAN_DELIVERY","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/requestPerpanjanganDelivery/");
define("REQUEST_DELIVERY_CONTAINER","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/requestDeliveryContainer/");
define("REQUEST_RECEIVING_CONTAINER","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/requestReceivingContainer/");
define("DASHBOARD","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/dashboard/");
define("TRUCK_CONTAINER","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/truckContainer/");

/*PJS*/
define("PORT_COOPERATION","http://api.indonesiaport.co.id/ibis_api_dev/portCooperation/");
define("STATUS_CONT","http://api.indonesiaport.co.id/ibis_api_dev/StatusContainer/");
define("UPLOADSBY","http://api.indonesiaport.co.id/ibis_api_dev/UploadSBY/");
/*PJS*/

define("REQUEST_BATALMUAT","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/requestBatalMuat/");

/*REALISASI BONGKAR MUAT*/ 
define("REQUEST_BONGKAR_MUAT","http://api.indonesiaport.co.id/ibis_api_dev/eServiceFolderProd/requestBongkarMuat/");


/*CDM*/
define("CUSTOMER_DATA","http://api.indonesiaport.co.id/ibis_api_dev/customerDataPTPProd/");
define("SIMOP_CUSTOMER","http://api.indonesiaport.co.id/ibis_api_dev/simopCustomerProd/");
/*CDM*/

/*BILLING ENGINE*/
define("BILLING_ENGINE","http://api.indonesiaport.co.id/ibis_api_dev/billingEngine/be");
/*BILLING ENGINE*/

/*epayment*/
//define("IPAY_INQUIRY",APP_ROOT."/wsdl/eServiceInquiry.wsdl");
// define("IPAY_INQUIRY","https://eservice.indonesiaport.co.id/ci/wsdl/eServiceInquirydev.wsdl");
define("IPAY_INQUIRY","https://eservicetest.indonesiaport.co.id/wsdl/eServiceInquiry.wsdl");

/*epayment*/

/*paymentcash*/
define("PAYMENTCASH_INQUIRY","http://api.indonesiaport.co.id/ePaymentService_Dev/ipcPortal.php");
define("PAYMENTCASH_INQUIRY_ITOS123","http://api.indonesiaport.co.id/ePaymentPtpServiceTo3Domestik_Dev/ipcPortal.php");
define("PAYMENTCASH_INQUIRY_OPUST3","http://api.indonesiaport.co.id/ePaymentPtpServiceT3OG_dev/ipcPortal.php");
define("PAYMENTCASH_INQUIRY_LINI2","http://api.indonesiaport.co.id/ePaymentServiceLineos_Dev/ipcPortaldev.php");
/*paymentcash*/

/*EMATERAI*/
define("EMATERAI_CONNECT","http://api.indonesiaport.co.id/eMateraiService_Dev/ipcportal.php");

/*Order Management*/
define("ORDER_MGT","http://api.indonesiaport.co.id/ibis_api_dev/orderManagement/");
/*Order Management*/

/*API EINVOICE*/
define("API_EINVOICE","http://api.indonesiaport.co.id/einvoice_api_dev/wsapi/index.php");

/*CFS_API*/
define("CFS_API","http://www.ipccfscenter.com/TPSServices/server_plp.php");

/*CFS_API*/
define("EPAYMENT_IPCTPK","http://api.indonesiaport.co.id/ePaymentService_Dev/ipcPortal.php");

class Nusoap_lib
{
      function Nusoap_lib()
      {
            require_once("nusoaplib/nusoap.php");
      }
	  
	  function call_wsdl($wsdl,$modul,$in_data,&$result)
	  {
		$client 	= new nusoap_client($wsdl);
		
        $result = $client->call($modul, $in_data);
		$array_cont = array();
		if ($client->fault) {
			$result = "WSDL FAULT<pre>".var_dump($result)."</pre>";
			return false;
		}
		else {
			$error = $client->getError();
			if ($error) {
				$result = "WSDL ERROR.
								<br>Please check your wsdl url (get @nusoal_lib.php). 
								<br>If the wsdl url blank (in browser), some possible Error : 
								<br>1. No Access to wsdl, please check your connectivity. (please ping the wsdl ip).
								<br>2. Make sure that last wsdl script has no syntax errors (or comments some line in wsdl script typically index file).
								<br><pre>" . $error . "</pre>";
				return false;
			}
			else {
				return true;
			}
			return false;
		}
	  }
	  
	  function call_wsdl_via_file($wsdl,$modul,$in_data,&$result)
	  {
		$client 	= new nusoap_client($wsdl,true);
		
        $result = $client->call($modul, $in_data);
		$array_cont = array();
		if ($client->fault) {
			$result = "WSDL FAULT<pre>".var_dump($result)."</pre>";
			return false;
		}
		else {
			$error = $client->getError();
			if ($error) {
				$result = "WSDL ERROR.
								<br>Please check your wsdl url (get @nusoal_lib.php). 
								<br>If the wsdl url blank (in browser), some possible Error : 
								<br>1. No Access to wsdl, please check your connectivity. (please ping the wsdl ip).
								<br>2. Make sure that last wsdl script has no syntax errors (or comments some line in wsdl script typically index file).
								<br><pre>" . $error . "</pre>";
				return false;
			}
			else {
				return true;
			}
			return false;
		}
	  }	  
}

?>