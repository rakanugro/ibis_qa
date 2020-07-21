<?php

/*|
 | Function Name 	: getPDFProformaContainer
 | Description 		: get PDF Proforma Container
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			:   
 |*/
function getPDFProformaContainer($in_param) {

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
		
		$tbl = '
			<table border=\'0\'>
				<tr>                    
					<td COLSPAN="2" align="left"><font size="8"><b>$data[ID_NOTA]</b></font></td>
					<td width="100"><font size="8"><b>$date</b></font></td>
                </tr> 
                <tr>                    
                    <td COLSPAN="3" align="left"><font size="8"><b>$data[ID_REQ]</b></font>  </td>
                </tr>                  
                
                <tr>
                    <td COLSPAN="6">POD: $data[IPOD] | $data[PELABUHAN_TUJUAN]</td>					
                </tr>                
                
                <tr>
                    <td COLSPAN="6"><b>RECEIVING</b></td>                                        
                </tr>                
                              
                <tr>                    
                    <td COLSPAN="4" align="left"><font size="6"><b>$data[EMKL]</b></font></td>					
                </tr>
                <tr>                    
                    <td COLSPAN="4" align="left"><font size="6"><b>$data[NPWP]</b></font></td>                    
                </tr>
                <tr>                    
                    <td COLSPAN="4" align="left"><font size="6"><b>$data[ALAMAT]</b></font></td>					
                </tr>
                <tr>                    
                    <td COLSPAN="4" align="left"><font size="6"><b>$data[VESSEL] / $data[VOYAGE]</b></font></td>
                    
                </tr>    
                
                <tr>
                    <td></td>
                </tr>
                
                <tr>
                    <td width="80" align="left"><font size="6"><b>PENUMPUKAN DARI :</b></font> </td>                    
                    <td colspan="5"><font size="6"><b>$data[TGL_STACK] s/d $data[TGL_MUAT]</b></font></td>                    
                </tr>                
                <tr>                            
                    <th colspan="3" width="100"><font size="6"><b>KETERANGAN</b></font></th>
                    <th width="10" align="left"><font size="6"><b>BX</b></font></th>
                
                    <th width="50" align="left"><font size="6"><b>CONTENT</b></font></th>
                    <th width="10" align="left"><font size="6"><b>HZ</b></font></th>
                    
                    <th width="43" align="left"><font size="6"><b>TARIF</b></font></th>                    
                    <th width="43" align="left"><font size="6" ><b>JUMLAH</b></font></th>
                </tr>
                
                <tr>
                    <td colspoan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="700">
                    </td>
                </tr>
				$detail
				<tr>
                    <td colspoan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="700">
                    </td>
                </tr>
				
		</table>';
		
		$html_tcpdf = $tbl."  
					Proforma<br>
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