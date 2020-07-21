<?php
class Sendcurl_lib
{
	function Sendcurl_lib()
      {
            require_once("nusoaplib/nusoap.php");
      }

	  function SendCurl($xml, $url, $SOAPAction, $soapUser, $soapPassword) {
		$header[] = 'Content-Type: text/xml';
		$header[] = 'SOAPAction: "' . $SOAPAction . '"';
		$header[] = 'Content-length: ' . strlen($xml);
		$header[] = 'Connection: close';

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_POST, true);                                                                   
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
		curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$password);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		$response = curl_exec($ch);
		if (!curl_errno($ch)) {
			$return['return'] = TRUE;
			$return['info'] = curl_getinfo($ch);
			$return['response'] = $response;
		} else {
			$return['return'] = FALSE;
			$return['errno'] = curl_errno($ch);
			$return['info'] = curl_error($ch);
			$return['response'] = '';
		}
		return $return;
	}	  
}