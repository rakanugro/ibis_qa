<?php
require_once "lib/nusoap.php";

//======= Declare Function Service ========// 
function getProd($category) {
    if ($category == "books") {
        return join(",", array(
            "The WordPress Anthology",
            "PHP Master: Write Cutting Edge Code",
            "Build Your Own Website the Right Way"));
    }    else {
            return "No products listed under that category";
    }
}

function testConnection()
{
	if($conn = oci_connect('billing', 'billing', '192.168.29.88/PNKDBT'))
	{
		return "SUCCESS";
	}
	else
	{
		return "FALSE";
	}
}

function ePaymentInquiry($notanumber, $userid) {
	
  $conn = oci_connect('ibis', 'ibis321', '10.10.33.25/ORCL');

  //db connection 
  if($conn)
  {
	
    //create log
	$inv_char2 = array("'");
	$fix_char2 = array("''");
	$lg_id = $notanumber.":".rand(10, 99);
	$req_param = "LOG36,".$notanumber.",".$userid;
	$clip = $_SERVER["REMOTE_ADDR"];
	$lg_id = str_replace($inv_char2,$fix_char,$lg_id);
	$req_param = str_replace($inv_char2,$fix_char,$req_param);
	$log_query_req = "INSERT INTO TB_INTERFACE_LOG (LG_ID, LG_TYPE, REQ_PARAM,IP) VALUES ('$lg_id', 'PAY', '$req_param','$clip')";
	$stid2 = oci_parse($conn, $log_query_req) or die ('Can not parse query');
    if (!oci_execute($stid2))
	{
	}
		
		
	$sql = "select TRX_NUMBER_BILLING from multinota where trx_number='$notanumber'";
		
	$stid = oci_parse($conn, $sql);

    if (!oci_execute($stid)) {
		$e = oci_error($stid); 
        oci_close($conn);
		
		$xml_str = "^87^Biller database problem^$e[message]";
		
		//UPDATE LOG
		$res_param = str_replace($inv_char2,$fix_char2,$xml_str);
		$log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'F', RES_PARAM = '$xml_str', DATE_RES = sysdate where LG_ID = '$lg_id'";
		$stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
		oci_execute($stid3);
		
        return $xml_str;
    }
    else
    {
//		return "ok2";
		$i = 0;
		$trx_number="";
		while ($row = oci_fetch_array($stid, OCI_ASSOC))
		{
			if($trx_number!="")
				$trx_number .="^";
			$trx_number .= $row['TRX_NUMBER_BILLING'];
			$i++;
		}				

		if($i==0)
		{
			$xml_str = "^79^Data multinota tidak ditemukan";
			
			//UPDATE LOG
			$res_param = str_replace($inv_char2,$fix_char2,$xml_str);
			$log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'F', RES_PARAM = '$xml_str', DATE_RES = sysdate where LG_ID = '$lg_id'";
			$stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
			oci_execute($stid3);
		
		}
		else if($i==1)
		{
			$xml_str = "^78^Data multinota harus lebih dari 1";
			
			//UPDATE LOG
			$res_param = str_replace($inv_char2,$fix_char2,$xml_str);
			$log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'F', RES_PARAM = '$xml_str', DATE_RES = sysdate where LG_ID = '$lg_id'";
			$stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
			oci_execute($stid3);			
		}
		else 
		{
			
			$xml_str = "^00^SUCCESS^$trx_number";
			
			//UPDATE LOG
			$res_param = str_replace($inv_char2,$fix_char2,$xml_str);
			$log_query_resp = "UPDATE TB_INTERFACE_LOG SET RES_CODE = 'S', RES_PARAM = '$xml_str', DATE_RES = sysdate where LG_ID = '$lg_id'";
			$stid3 = oci_parse($conn, $log_query_resp) or die ('Can not parse query');
			oci_execute($stid3);			
		}
		
		oci_close($conn);
        return $xml_str;
    }
  }
  else
  {
		$e = oci_error($stid); 
		oci_close($conn);
		
		$xml_str = "^91^Link down";
		
		return $xml_str;
  }
}

$server = new soap_server();
$server->configureWSDL('portalipc2', 'urn:portalipc2');
 
$server->wsdl->schemaTargetNamespace = 'portalipc2';
 
$server->register('getProd',
            array('category' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('testConnection',
            array('category' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');

$server->register('ePaymentInquiry',
            array('trxnumber' => 'xsd:string','userid' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc2',
            'urn:portalipc2#pollServer');
			
$server->service($HTTP_RAW_POST_DATA);