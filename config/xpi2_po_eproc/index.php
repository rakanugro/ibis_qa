<?php
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$Modul Integrasi$                                                         	  |
  | Author                  : -				                                                          |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  | Library					: nusoap																  |
  | Template File           : index.php register_service.php sql_collection.php db_collection.php     |
  |							  data_collection.php f_testService.php exmp_testService.php			  |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By | 
  |---------------------------------------------------------------------------------------------------|

  +---------------------------------------------------------------------------------------------------+
  | Program Unit Name        : xpi2_po_eproc                                                  		  |
  | Description              : Service pack for eproc and pi2 integration                             |
  | Author                   : -                                                        			  |
  | Created Date             : 22-Des-2014                                                            |
  | Last Update Date         :                                                                        |
  | Version                  : 1.0                                                                    |
  |---------------------------------------------------------------------------------------------------|
  | $Modification History$                                                                            |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By |
  +---------------------------------------------------------------------------------------------------+
  */
  
//======= SQL Collection ========//
require_once "sql_collection.php";

//======= SQL Collection ========//
require_once "data_collection.php";

//======= Database Collection ========//
require_once "db_collection.php";

//======= nusoap library ========//
require_once "lib/nusoap.php";

//======= Register Service ========//
require_once "register_service.php";

//======= Set Debug Mode ========//
function getDebugMode()
{
	//default is false // developer mode = true
	return true;
}

//======= Set Debug Mode 2 ========//
function getDebugMode2()
{
	//default is true
	return true;
}

//======= Declare Function Service ========// 
function testService($in_param) {
	try {
		$conn = oriDb();
		
		if(!checkOriDb($conn,$err)) 
			goto Err;
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}
	
	$message = $in_param;
	
	goto Success;
	
	Err:
		closeOriDb($conn);
		return "F,".$err;
	
	Success:
		closeOriDb($conn);
		return "S,".$message;
}

function populatePO($in_req_header_id) {

	//$message = "Failed";
	//goto Err;

	try {
		$conn['ori'] = oriDb();

		if(!checkOriDb($conn['ori'],$err)) goto Err;

		//CEK STAGING DATA
		$sql = "SELECT STATUS_SYNCRON
					FROM tbl_po_header
				WHERE req_header_id = '$in_req_header_id'";

		if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_po,$err,$debug)) goto Err;

		$row = oci_fetch_array($query_po, OCI_ASSOC);
		$status_syncron_orafin = $row[STATUS_SYNCRON];

		$sql = "SELECT STATUS_SYNCRON
					FROM tbl_po_header
				WHERE req_header_id = '$in_req_header_id'";

		if(!checkOriSQL($conn['ori']['eproc'],$sql,$query_po,$err,$debug)) goto Err;

		$row = oci_fetch_array($query_po, OCI_ASSOC);
		$status_syncron_eproc = $row[STATUS_SYNCRON];
		
		if($status_syncron_eproc=='2')
		{
			$err .= "Sudah di transfer ke orafin, silahkan cek status";
			goto Err;
		}
		
		if($status_syncron_orafin=='2')
		{
			$sql = "SELECT po_id, po_num 
				   FROM tbl_po_header
				   WHERE req_header_id = '$in_req_header_id'";
				   
			if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_po,$err,$debug)) goto Err;
			
			$row = oci_fetch_array($query_po, OCI_ASSOC);
			$po_id = $row[PO_ID];
			$po_num = $row[PO_NUM];
			
			$sql = "UPDATE tbl_po_header
				SET po_id = '$po_id',
				po_num = '$po_num',
				status_syncron = 2,
				syncron_note = 'PO Creation Success'
				WHERE req_header_id = '$in_req_header_id'";
			
			if(!checkOriSQL($conn['ori']['eproc'],$sql,$query_tbl_po_header,$err,$debug)) goto Err;

			$message .= "SUCCESS;";
			goto Success;
		}
					
		/*POPULATE DATA*/
		
		$sql = "DELETE FROM tbl_po_header WHERE req_header_id = '$in_req_header_id'";
		if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_po,$err,$debug)) goto Err;

		//get po header from eproc
		if(!checkOriSQL($conn['ori']['eproc'],getCountPoHeader($in_req_header_id),$query_po_header,$err,$debug)) goto Err;
		$row = oci_fetch_array($query_po_header, OCI_ASSOC);
		if($row[JUMLAH]==0)
		{
			$err .= "Request tidak ditemukan";
			goto Err;
		}
		
		//get po header from eproc
		if(!checkOriSQL($conn['ori']['eproc'],getPoHeader($in_req_header_id),$query_po_header,$err,$debug)) goto Err;

		while ($row = oci_fetch_array($query_po_header, OCI_ASSOC))
		{
			//$message .= $row[ORG_ID].";";
			$header[REQ_HEADER_ID] = $row[REQ_HEADER_ID];
			$header[VENDOR_ID] = $row[VENDOR_ID];
			$header[VENDOR_SITE_ID] = $row[VENDOR_SITE_ID];
			$header[AGENT_ID] = $row[AGENT_ID];
			$header[CURRENCY_CODE] = $row[CURRENCY_CODE];
			$header[ORG_ID] = $row[ORG_ID];
			$header[RATE_TYPE_CODE] = $row[RATE_TYPE_CODE];
			$header[RATE_DATE] = $row[RATE_DATE];
			$header[RATE] = $row[RATE];
			$header[NO_KONTRAK] = $row[NO_KONTRAK];
			$header[TGL_KONTRAK] = $row[TGL_KONTRAK];
			$header[CREATED_BY] = $row[CREATED_BY];
			$header[SOURCE_PO] = $row[SOURCE_PO];
			$header[PO_ID] = $row[PO_ID];
			$header[PO_NUM] = $row[PO_NUM];
			$header[PO_DESCRIPTION] = $row[PO_DESCRIPTION];
			$header[P_FK] = $row[P_FK];
			$header[AGR_FK] = $row[AGR_FK];
			$header[STATUS_SYNCRON] = $row[STATUS_SYNCRON];
			$header[SYNCRON_NOTE] = $row[SYNCRON_NOTE];
			$header[NO_PR] = $row[NO_PR];

			/**/
			$sql = "INSERT INTO apps.tbl_po_header
					  (REQ_HEADER_ID, VENDOR_ID, VENDOR_SITE_ID, AGENT_ID,
					   CURRENCY_CODE, ORG_ID, RATE_TYPE_CODE, RATE_DATE,
					   RATE, NO_KONTRAK, TGL_KONTRAK,
					   CREATED_BY, SOURCE_PO, PO_ID,
					   PO_NUM, PO_DESCRIPTION, P_FK,
					   AGR_FK, STATUS_SYNCRON, SYNCRON_NOTE, NO_PR
					  )
			   VALUES ('$header[REQ_HEADER_ID]', '$header[VENDOR_ID]', '$header[VENDOR_SITE_ID]', '$header[AGENT_ID]',
					   '$header[CURRENCY_CODE]', '$header[ORG_ID]', '$header[RATE_TYPE_CODE]', '$header[RATE_DATE]',
					   '$header[RATE]', '$header[NO_KONTRAK]', '$header[TGL_KONTRAK]',
					   '$header[CREATED_BY]', '$header[SOURCE_PO]', '$header[PO_ID]',
					   '$header[PO_NUM]', '$header[PO_DESCRIPTION]', '$header[P_FK]',
					   '$header[AGR_FK]', '$header[STATUS_SYNCRON]', '$header[SYNCRON_NOTE]','$header[NO_PR]'
					  )";
			
			if(!checkOriSQLAutoCommit($conn['ori']['orafin'],$sql,$query_tbl_po_header,$err,$debug)) goto Err;

			$sql = "DELETE FROM TBL_PO_ITEM_JASA WHERE req_header_id = '$in_req_header_id'";
			if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_po,$err,$debug)) goto Err;
	
			/*get po item jasa from eproc*/
			if(!checkOriSQL($conn['ori']['eproc'],getPoItemJasa($in_req_header_id),$query_po_item_jasa,$err,$debug)) goto Err;

			while ($row = oci_fetch_array($query_po_item_jasa, OCI_ASSOC))
			{
				$line[REQ_HEADER_ID] = $row[REQ_HEADER_ID];
				$line[LINE_NUM] = $row[LINE_NUM];
				$line[ITEM_ID] = $row[ITEM_ID];
				$line[LINE_TYPE] = $row[LINE_TYPE];
				$line[QUANTITY] = $row[QUANTITY];
				$line[UNIT_PRICE] = $row[UNIT_PRICE];
				$line[UNIT_OF_MEASURE] = $row[UNIT_OF_MEASURE];
				$line[SHIPMENT_NUM] = $row[SHIPMENT_NUM];
				$line[SHIP_TO_ORGANIZATION_ID] = $row[SHIP_TO_ORGANIZATION_ID];
				$line[REQ_LINE_REFERENCE_NUM] = $row[REQ_LINE_REFERENCE_NUM];
				$line[REQ_DISTRIBUTION_ID] = $row[REQ_DISTRIBUTION_ID];
				$line[QUANTITY_ORDERED] = $row[QUANTITY_ORDERED];
				$line[ORG_ID] = $row[ORG_ID];
				$line[RECOVERABLE_TAX] = $row[RECOVERABLE_TAX];
				$line[NONRECOVERABLE_TAX] = $row[NONRECOVERABLE_TAX];
				$line[RECOVERY_RATE] = $row[RECOVERY_RATE];
				$line[DESTINATION_TYPE_CODE] = $row[DESTINATION_TYPE_CODE];
				$line[DISTRIBUTION_NUM] = $row[DISTRIBUTION_NUM];
				
				/**/			
				$sql = "INSERT INTO apps.TBL_PO_ITEM_JASA
                         (REQ_HEADER_ID, LINE_NUM, ITEM_ID,
                          LINE_TYPE, QUANTITY,
                          UNIT_PRICE, UNIT_OF_MEASURE, SHIPMENT_NUM,
                          SHIP_TO_ORGANIZATION_ID, REQ_LINE_REFERENCE_NUM,
                          REQ_DISTRIBUTION_ID, QUANTITY_ORDERED, ORG_ID, 
						  RECOVERABLE_TAX, NONRECOVERABLE_TAX,
						  RECOVERY_RATE, DESTINATION_TYPE_CODE, DISTRIBUTION_NUM
                         )
                  VALUES ('$line[REQ_HEADER_ID]', '$line[LINE_NUM]', '$line[ITEM_ID]',
                          '$line[LINE_TYPE]', '$line[QUANTITY]',
                          '$line[UNIT_PRICE]', '$line[UNIT_OF_MEASURE]', '$line[SHIPMENT_NUM]',
                          '$line[SHIP_TO_ORGANIZATION_ID]', '$line[REQ_LINE_REFERENCE_NUM]',
                          '$line[REQ_DISTRIBUTION_ID]', '$line[QUANTITY_ORDERED]', '$line[ORG_ID]',
						  '$line[RECOVERABLE_TAX]', '$line[NONRECOVERABLE_TAX]',
						  '$line[RECOVERY_RATE]', '$line[DESTINATION_TYPE_CODE]', '$line[DISTRIBUTION_NUM]'
                         )";

				if(!checkOriSQLAutoCommit($conn['ori']['orafin'],$sql,$query_po_item,$err,$debug)) goto Err;
				
			}
				
			/*Generate PO : CALL PACKAGE*/
			$sql_gen_po = "Declare 
						l_result_imp         PLS_INTEGER;
						BEGIN 
							APPS.xpi2_po_eproc_webservice_pkg.populate_po_eproc(:in_req_header_id,:out_status,:out_message);
						 END;";

			$stid = oci_parse($conn['ori']['orafin'], $sql_gen_po) or die ('Can not parse query');

			oci_bind_by_name($stid, "in_req_header_id", &$in_req_header_id,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "out_status", &$out_status,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "out_message", &$out_message,1000) or die ('Can not bind variable');

			//$message .= in_req_header_id.";".$out_status.";".$out_message.";";

			if (!oci_execute($stid)) {
			
				$e = oci_error($stid);
				
				$err = $e[message];
				goto Err;
				
			}
			else
			{				
				if($out_status=="F")
				{
				
					$sql = "UPDATE tbl_po_header
					SET status_syncron = 3,
					syncron_note = 'PO Interface Failed, $out_message'
					WHERE req_header_id = '$in_req_header_id'";
		
					rollbackOriDb($conn['ori']);
		
					if(!checkOriSQL($conn['ori']['eproc'],$sql,$query_tbl_po_header,$err,$debug)) goto Err;
					
					$err .= $out_message."+";
					goto Err;
				}
				else if($out_status=="S")
				{
					$sql = "SELECT po_id, po_num 
						   FROM tbl_po_header
						   WHERE req_header_id = '$in_req_header_id'";
						   
					if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_po,$err,$debug)) goto Err;
					
					$row = oci_fetch_array($query_po, OCI_ASSOC);
					$po_id = $row[PO_ID];
					$po_num = $row[PO_NUM];
					
					$sql = "UPDATE tbl_po_header
						SET po_id = '$po_id',
						po_num = '$po_num',
						status_syncron = 2,
						syncron_note = 'PO Creation Success'
						WHERE req_header_id = '$in_req_header_id'";
					
					if(!checkOriSQL($conn['ori']['eproc'],$sql,$query_tbl_po_header,$err,$debug)) goto Err;
				
					$message .= $out_message;
					goto Success;
				}
				else 
				{
					$sql = "UPDATE tbl_po_header
					SET status_syncron = 3,
					syncron_note = 'PO Interface failed, NO OUT STATUS, $out_message'
					WHERE req_header_id = '$in_req_header_id'";
		
					rollbackOriDb($conn['ori']);
		
					if(!checkOriSQL($conn['ori']['eproc'],$sql,$query_tbl_po_header,$err,$debug)) goto Err;

					$err .= $out_message."-";
					goto Err;
				}
			}
		}
		
		$message .= "SUCCESS;";
		goto Success;
		
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}
	
	Err:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "F,".$debug.$err;
	
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "S,".$debug.$message;
}

function populatePR($in_org_id,$in_pr_date) {

	try {
		$conn['ori'] = oriDb();

		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*get pr header from pi2*/
		if(!checkOriSQL($conn['ori']['orafin'],getPrHeader($in_org_id,$in_pr_date),$query0,$err,$debug)) goto Err;

		while ($row = oci_fetch_array($query0, OCI_ASSOC))
		{
			//data collection 
			prCollection($row,$dataPr);

			//insert pr header to eproc
			if(!checkOriSQL($conn['ori']['eproc'],insertPrHeader($dataPr),$query1,$err,$debug)) goto Next;
			
			/*get pr material from pi2*/
			if(!checkOriSQL($conn['ori']['orafin'],getPrMaterial($dataPr[PR_ID]),$query2,$err,$debug)) goto Err;
		
			while ($row2 = oci_fetch_array($query2, OCI_ASSOC))
			{
				//data collection 
				$dataMaterial[MTR_PR_ID] = $dataPr[PR_ID];
				
				prMaterialCollection($row2,$dataMaterial);
				
				//insert pr material to eproc
				if(!checkOriSQL($conn['ori']['eproc'],insertPrMaterial($dataMaterial),$query3,$err,$debug)) goto Err;
			}

			/*get pr jasa from pi2*/
			if(!checkOriSQL($conn['ori']['orafin'],getPrJasa($dataPr[PR_ID]),$query4,$err,$debug)) goto Err;

			while ($row3 = oci_fetch_array($query4, OCI_ASSOC))
			{
				//data collection 
				$dataJasa[JS_PR_ID] = $dataPr[PR_ID];

				prJasaCollection($row3,$dataJasa);
				
				//insert pr material to eproc
				if(!checkOriSQL($conn['ori']['eproc'],insertPrJasa($dataJasa),$query5,$err,$debug)) goto Err;
			}
			
			$message .= "Success Transfer PR Number:".$dataPr[PR_NUMBER]."<br>";
			
			goto Lanjut;
			
			Next:
			$message .= "Duplicate/Error PR Number:".$dataPr[PR_NUMBER]."<br>";
			
			Lanjut:
		}
		
		$message .= "SUCCESS;";
		goto Success;
		
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}
	
	Err:
		rollbackOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "F,".$debug.$err;
	
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "S,".$debug.$message;
}

function populateItem($in_org_id,$in_update_date) {

	try {
		$conn['ori'] = oriDb();
		
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*populate item*/
		$sql = "DELETE tbl_item WHERE item_org_id = '$in_org_id'";
		/*delete all item from eproc*/
		if(!checkOriSQL($conn['ori']['eproc'],$sql,$query0,$err,$debug)) goto Err;
		
		/*get item from pi2*/
		if(!checkOriSQL($conn['ori']['orafin'],getItem($in_org_id,$in_update_date),$query0,$err,$debug)) goto Err;
	
		while ($row = oci_fetch_array($query0, OCI_ASSOC))
		{
			//data collection 
			itemCollection($row,$dataItem);

			//insert item to eproc			
			if(!checkOriSQL($conn['ori']['eproc'],insertItem($dataItem),$query1,$err,$debug)) goto Next;
			
			$message .= "Success Transfer Item ID:".$dataItem[ITEM_ID]."<br>";
			goto Lanjut;
			
			Next:
			$message .= "Duplicate/Error Item ID:".$dataItem[ITEM_ID]."<br>";
			
			Lanjut:
		}
		
		/*populate jasa*/
		$sql = "DELETE tbl_jasa WHERE jasa_org_id = '$in_org_id'";
		/*delete all item from eproc*/
		if(!checkOriSQL($conn['ori']['eproc'],$sql,$query0,$err,$debug)) goto Err;
		
		/*get jasa from pi2*/
		if(!checkOriSQL($conn['ori']['orafin'],getJasa($in_org_id,$in_update_date),$query0,$err,$debug)) goto Err;
	
		while ($row = oci_fetch_array($query0, OCI_ASSOC))
		{
			//data collection 
			jasaCollection($row,$dataJasa);

			//insert item to eproc			
			if(!checkOriSQL($conn['ori']['eproc'],insertJasa($dataJasa),$query1,$err,$debug)) goto Next2;
			
			$message .= "Success Transfer Jasa ID:".$dataJasa[ITEM_ID]."<br>";
			goto Lanjut2;
			
			Next2:
			$message .= "Duplicate/Error Jasa ID:".$dataJasa[ITEM_ID]."<br>";
			
			Lanjut2:			
		}		
		
		$message .= "SUCCESS;";
		goto Success;
		
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}
	
	Err:
		rollbackOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "F,".$debug.$err;
	
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "S,".$debug.$message;
}

function populateVendor($in_org_id,$in_update_date) {
	
	try {
		$conn['ori'] = oriDb();
		
		if(!checkOriDb($conn['ori'],$err)) goto Err;

		$sql = "DELETE tbl_vendor WHERE org_id = '$in_org_id'";
		/*delete all vendor from eproc`*/
		if(!checkOriSQL($conn['ori']['eproc'],$sql,$query0,$err,$debug)) goto Err;
		
		/*get vendor from pi2*/
		if(!checkOriSQL($conn['ori']['orafin'],getVendor($in_org_id,$in_update_date),$query0,$err,$debug)) goto Err;
	
		while ($row = oci_fetch_array($query0, OCI_ASSOC))
		{
			//data collection 
			vendorCollection($row,$dataVendor);

			//insert vendor to eproc			
			if(!checkOriSQL($conn['ori']['eproc'],insertVendor($dataVendor),$query1,$err,$debug)) goto Next;
			
			$message .= "Success Transfer Vendor ID:".$dataVendor[ID_VENDOR]."<br>";
			goto Lanjut;
			
			Next:
			$message .= "Duplicate/Error Vendor ID:".$dataVendor[ID_VENDOR]."<br>";
			
			Lanjut:			
		}
		
		$message .= "SUCCESS;";
		goto Success;
		
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}

	Err:
		rollbackOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "F,".$debug.$err;

	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return "S,".$debug.$message;
}