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
  
//======= Data Collection ========// 
function prCollection($row,&$data)
{
	$data[PR_ID] = $row[PR_ID];
	$data[PR_NUMBER] = $row[PR_NUMBER];
	$data[PR_DATE] = $row[PR_DATE];
	$data[PREPARER_ID] = $row[PREPARER_ID];
	$data[ORG_ID] = $row[ORG_ID];
	
	return true;
}

function prMaterialCollection($row,&$data)
{	
	$inv_char 	= array("'");
	$fix_char	= array(" ");
	
	$data[MTR_KD] = $row[ITEM_NUMBER];
	$data[MTR_ITEM_ID] = $row[ITEM_ID];
	$data[MTR_DESKRIPSI] = str_replace($inv_char,$fix_char,$row[ITEM_DESCRIPTION]);
	$data[MTR_SATUAN] = $row[UOM];
	$data[MTR_LINE_TYPE] = $row[LINE_TYPE];
	$data[MTR_LINE_ID] = $row[LINE_ID];
	$data[MTR_LINE_NUMBER] = $row[LINE_NUM];
	$data[MTR_DISTRIBUTION_NUM] = $row[DISTRIBUTION_NUM];
	$data[MTR_DISTRIBUTION_ID_PR] = $row[DISTRIBUTION_ID];
	$data[MTR_JUMLAH] = $row[QUANTITY];
	$data[MTR_HPS] = $row[UNIT_PRICE];
	$data[DEST_ORG_CODE] = $row[DESTINATION_ORGANIZATION_ID];
	$data[DELIVER_TO_LOCATION_ID] = $row[DELIVER_TO_LOCATION_ID];
	$data[DESTINATION_TYPE_CODE] = $row[DESTINATION_TYPE_CODE];
	$data[DEST_SUBINVENTORY] = $row[DESTINATION_SUBINVENTORY];
	$data[CURRENCY_CODE] = $row[CURRENCY_CODE];
	$data[RATE_TYPE] = $row[RATE_TYPE];
	$data[RATE] = $row[RATE];
	$data[RATE_DATE] = $row[RATE_DATE];
	$data[RECOVERABLE_TAX] = $row[RECOVERABLE_TAX];
	$data[NONRECOVERABLE_TAX] = $row[NONRECOVERABLE_TAX];	
	
	
	return true;
}

function prJasaCollection($row,&$data)
{
	$inv_char 	= array("'");
	$fix_char	= array(" ");
	
	$data[JS_KD] = $row[ITEM_NUMBER];
	$data[JS_ITEM_ID] = $row[ITEM_ID];
	$data[JS_DESKRIPSI] = str_replace($inv_char,$fix_char,$row[ITEM_DESCRIPTION]);
	$data[JS_SATUAN] = $row[UOM];
	$data[JS_LINE_TYPE] = $row[LINE_TYPE];
	$data[JS_LINE_ID] = $row[LINE_ID];
	$data[JS_LINE_NUMBER] = $row[LINE_NUM];
	$data[JS_DISTRIBUTION_NUM] = $row[DISTRIBUTION_NUM];
	$data[JS_DISTRIBUTION_ID_PR] = $row[DISTRIBUTION_ID];
	$data[JS_JUMLAH] = $row[QUANTITY];
	$data[JS_HPS] = $row[UNIT_PRICE];
	$data[DEST_ORG_CODE] = $row[DESTINATION_ORGANIZATION_ID];
	$data[DELIVER_TO_LOCATION_ID] = $row[DELIVER_TO_LOCATION_ID];
	$data[DESTINATION_TYPE_CODE] = $row[DESTINATION_TYPE_CODE];
	$data[DEST_SUBINVENTORY] = $row[DESTINATION_SUBINVENTORY];
	$data[CURRENCY_CODE] = $row[CURRENCY_CODE];
	$data[RATE_TYPE] = $row[RATE_TYPE];
	$data[RATE] = $row[RATE];
	$data[RATE_DATE] = $row[RATE_DATE];
	$data[RECOVERABLE_TAX] = $row[RECOVERABLE_TAX];
	$data[NONRECOVERABLE_TAX] = $row[NONRECOVERABLE_TAX];
	
	return true;
}

function itemCollection($row,&$data)
{
	$inv_char 	= array("'");
	$fix_char	= array(" ");
		
	$data[ITEM_KD] = $row[KODE_ITEM];
	$data[ITEM_ID] = $row[INVENTORY_ITEM_ID];
	$data[ITEM_ORG_ID] = $row[ORGANIZATION_ID];
	$data[ITEM_DESKRIPSI] = str_replace($inv_char,$fix_char,$row[DESCRIPTION]);
	$data[ITEM_SATUAN] = $row[UOM];
	$data[ITEM_FLAG] = $row[INVENTORY_ITEM_FLAG];
	
	return true;
}

function jasaCollection($row,&$data)
{
	$inv_char 	= array("'");
	$fix_char	= array(" ");
		
	$data[ITEM_KD] = $row[KODE_ITEM];
	$data[ITEM_ID] = $row[INVENTORY_ITEM_ID];
	$data[ITEM_ORG_ID] = $row[ORGANIZATION_ID];
	$data[ITEM_DESKRIPSI] = str_replace($inv_char,$fix_char,$row[DESCRIPTION]);
	$data[ITEM_SATUAN] = $row[UOM];
	$data[ITEM_FLAG] = $row[INVENTORY_ITEM_FLAG];
	
	return true;
}

function vendorCollection($row,&$data)
{
	$inv_char 	= array("'");
	$fix_char	= array(" ");
		
	$data[ID_VENDOR] = $row[ID_VENDOR];
	$data[SITE_ID] = $row[SITE_ID];
	$data[ORG_ID] = $row[ORG_ID];
	$data[SITE_CODE] = $row[SITE_CODE];
	$data[VENDOR_NO] = $row[VENDOR_NO];
	$data[NPWP_VENDOR] = $row[NPWP_VENDOR];
	$data[NM_VENDOR] = str_replace($inv_char,$fix_char,$row[NM_VENDOR]);
	$data[NM_VENDOR_ALT] = str_replace($inv_char,$fix_char,$row[NM_VENDOR_ALT]);
	$data[ALMT_VENDOR] = str_replace($inv_char,$fix_char,$row[ALMT_VENDOR]);
	$data[NO_TLP] = $row[NO_TLP];
	$data[STATUS_READ] = $row[STATUS_READ];
	
	return true;
}
?>