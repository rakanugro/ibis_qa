<?php

/*|
 | Function Name 	: getPDFProformaContainer
 | Description 		: get PDF Nota Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getPDFNotaContainer($in_param) {

	try {
		/*------------------------------------------SETUP CONNECTION----------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*------------------------------------------SETUP CLIENT INPUT PARAMETER----------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter
		$agent_id = $xml_data->data->agent_id;
		$request_no = $xml_data->data->request_no;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data = array();
		$def = "";
		
		//get receiving info
		$request = array();

		//PL/SQL
		$query = "select * from req_receiving_h where customer_id='$agent_id'";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$query,$query_request,$err,$debug)) goto Err; 
		//FETCH QUERY
		
		$html_tcpdf = "
					Nota<br>
					Req Num $request_no <br>
					
					<table>
					<thead><tr><td>th1</td><td>th2</td><td>th3</td></tr></thead> 
					<tbody><tr><td>tb1</td><td>tb2</td><td>tb3</td></tr></tbody>
					</table>";

		$data = array(
						"html_tcpdf" => base64_encode($html_tcpdf)
						);

		$out_data = array();
		$out_data['data']=$data;
		
		goto Success;
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}

	/*------------------------------------------ERROR-------------------------------------------------------------*/
	Err:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($err=="") $err = "ERR";
		if($out_status=="") $out_status = "F";
		return generateResponse($out_data, $out_status, $err, "json");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS";
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "json");
}

?>