<?php
class Esb_npks
{
	function esb_api($arrData, $npk_xml, $api, $type) {
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ipc="'.$npk_xml.'">
			   <soapenv:Header/>
			   <soapenv:Body>
			      <ipc:'.$api.'>
			         <'.$type.'>
			            <esbHeader>
			               <!--Optional:-->
			               <internalId></internalId>
			               <!--Optional:-->
			               <externalId></externalId>
			               <!--Optional:-->
			               <timestamp></timestamp>
			               <!--Optional:-->
			               <responseTimestamp></responseTimestamp>
			               <!--Optional:-->
			               <responseCode></responseCode>
			               <!--Optional:-->
			               <responseMessage></responseMessage>
			            </esbHeader>
			            <esbBody>
			               <request>'.$arrData.'</request>
			            </esbBody>
			            <esbSecurity>
			               <orgId></orgId>
			               <batchSourceId>?</batchSourceId>
			               <lastUpdateLogin>?</lastUpdateLogin>
			               <userId>?</userId>
			               <respId>?</respId>
			               <ledgerId>?</ledgerId>
			               <respAppId>?</respAppId>
			               <batchSourceName>?</batchSourceName>
			            </esbSecurity>
			         </'.$type.'>
			      </ipc:'.$api.'>
			   </soapenv:Body>
			</soapenv:Envelope>';

		return $xml;
	}	
}