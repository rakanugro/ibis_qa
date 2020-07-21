<?php 
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$                                                         					  |
  | Author                  : -                                                         				  |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By | 
  |---------------------------------------------------------------------------------------------------|
  */
  
//======= SQL Collection ========// 
function getPrHeader ($in_org_id, $in_pr_date)
{
	return "SELECT prha.requisition_header_id pr_id, prha.segment1 pr_number,
             prha.creation_date pr_date, prha.authorization_status,
             prha.preparer_id, prha.org_id
        FROM po_requisition_headers_all prha
       WHERE org_id = '$in_org_id'
         AND TRUNC (prha.creation_date) <= '$in_pr_date'
         AND prha.authorization_status = 'APPROVED'
         AND EXISTS (
                SELECT 'lines can be put on a PO'
                  FROM po_requisition_lines_all prl
                 WHERE prl.requisition_header_id = prha.requisition_header_id
                   AND prl.line_location_id IS NULL
                   AND NVL (prl.at_sourcing_flag, 'N') = 'N'
                   AND NVL (prl.cancel_flag, 'N') = 'N'
                   AND NVL (prl.closed_code, 'OPEN') != 'FINALLY CLOSED'
                   AND NVL (prl.modified_by_agent_flag, 'N') = 'N'
                   AND prl.source_type_code = 'VENDOR')
         AND NOT EXISTS (SELECT 1
                           FROM xpi2.xpi2_po_pr_eproc_log a
                          WHERE prha.requisition_header_id = a.req_header_id)";
}

function insertPrHeader($data)
{
	return "INSERT INTO tbl_pr_header
                (req_header_id, no_pr, tgl_pr,
                 preparer_id, org_id, status_read
                )
					VALUES ('$data[PR_ID]', '$data[PR_NUMBER]', '$data[PR_DATE]', '$data[PREPARER_ID]', '$data[ORG_ID]', 0
                )";
}

//
function getPrMaterial($in_req_header_id)
{
	return "SELECT prla.requisition_header_id, msib.segment1 item_number, item_id,
             prla.item_description, unit_meas_lookup_code uom, plt.line_type,
             prla.requisition_line_id line_id, line_num, distribution_num,
             distribution_id, req_line_quantity quantity, prla.unit_price,
             destination_organization_id, deliver_to_location_id,
             destination_type_code, destination_subinventory, currency_code,
             rate_type, rate, rate_date, prda.recoverable_tax,
             prda.nonrecoverable_tax
        FROM po_requisition_lines_all prla,
             po_req_distributions_all prda,
             po_line_types plt,
             mtl_system_items_b msib
       WHERE destination_type_code = 'INVENTORY'
         AND prla.requisition_line_id = prda.requisition_line_id
         AND prla.line_type_id = plt.line_type_id
         AND prla.item_id = msib.inventory_item_id
         AND prla.destination_organization_id = msib.organization_id
         AND prla.requisition_header_id = '$in_req_header_id'";

}

function insertPrMaterial($data)
{
	return "    INSERT INTO tbl_pr_material
                (mtr_pr_id, mtr_kd,
                 mtr_item_id, mtr_deskripsi,
                 mtr_satuan, mtr_line_type,
                 mtr_line_id, mtr_line_num,
                 mtr_distribution_num,
                 mtr_distribution_id_pr, mtr_jumlah,
                 mtr_hps, dest_org_code,
                 deliver_to_location_id,
                 destination_type_code,
                 dest_subinventory, currency_code,
                 rate_type, rate,
                 rate_date, recoverable_tax,
                 nonrecoverable_tax
                )
         VALUES ('$data[MTR_PR_ID]', '$data[MTR_KD]',
                 '$data[MTR_ITEM_ID]', '$data[MTR_DESKRIPSI]',
                 '$data[MTR_SATUAN]', '$data[MTR_LINE_TYPE]',
                 '$data[MTR_LINE_ID]', '$data[MTR_LINE_NUMBER]',
                 '$data[MTR_DISTRIBUTION_NUM]',
                 '$data[MTR_DISTRIBUTION_ID_PR]', '$data[MTR_JUMLAH]',
                 '$data[MTR_HPS]', '$data[DEST_ORG_CODE]',
                 '$data[DELIVER_TO_LOCATION_ID]',
                 '$data[DESTINATION_TYPE_CODE]',
                 '$data[DEST_SUBINVENTORY]', '$data[CURRENCY_CODE]',
                 '$data[RATE_TYPE]', '$data[RATE]',
                 '$data[RATE_DATE]', '$data[RECOVERABLE_TAX]',
                 '$data[NONRECOVERABLE_TAX]'
                )";
}

//
function getPrJasa($in_req_header_id)
{
	return "      SELECT prla.requisition_header_id, msib.segment1 item_number, item_id,
             prla.item_description, unit_meas_lookup_code uom, plt.line_type,
             prla.requisition_line_id line_id, line_num, distribution_num,
             distribution_id, req_line_quantity quantity, prla.unit_price,
             destination_organization_id, deliver_to_location_id,
             destination_type_code, currency_code, rate_type, rate, rate_date,
             prda.recoverable_tax, prda.nonrecoverable_tax
        FROM po_requisition_lines_all prla,
             po_req_distributions_all prda,
             po_line_types plt,
             mtl_system_items_b msib
       WHERE destination_type_code = 'EXPENSE'
         AND prla.requisition_line_id = prda.requisition_line_id
         AND prla.line_type_id = plt.line_type_id
         AND prla.item_id = msib.inventory_item_id
         AND prla.destination_organization_id = msib.organization_id
         AND prla.requisition_header_id = '$in_req_header_id'";
}
function insertPrJasa($data)
{
	return "   INSERT INTO tbl_pr_jasa
                (js_pr_id, js_kd, js_item_id,
                 js_deskripsi, js_satuan,
                 js_line_type, js_line_id,
                 js_line_num, js_distribution_num,
                 js_distribution_id_pr, js_jumlah,
                 js_hps, dest_org_code,
                 deliver_to_location_id, destination_type_code,
                 currency_code, rate_type, rate,
                 rate_date, recoverable_tax,
                 nonrecoverable_tax
                )
         VALUES ('$data[JS_PR_ID]', '$data[JS_KD]', '$data[JS_ITEM_ID]',
                 '$data[JS_DESKRIPSI]', '$data[JS_SATUAN]',
                 '$data[JS_LINE_TYPE]', '$data[JS_LINE_ID]',
                 '$data[JS_LINE_NUMBER]', '$data[JS_DISTRIBUTION_NUM]',
                 '$data[JS_DISTRIBUTION_ID_PR]', '$data[JS_JUMLAH]',
                 '$data[JS_HPS]', '$data[DEST_ORG_CODE]',
                 '$data[DELIVER_TO_LOCATION_ID]', '$data[DESTINATION_TYPE_CODE]',
                 '$data[CURRENCY_CODE]', '$data[RATE_TYPE]', '$data[RATE]',
                 '$data[RATE_DATE]', '$data[RECOVERABLE_TAX]',
                 '$data[NONRECOVERABLE_TAX]'
                )";
}

function getItem ($in_org_id, $in_update_date)
{
	return "SELECT item.segment1 kode_item, item.inventory_item_id,
             hou.organization_id, item.description,
             item.primary_unit_of_measure uom, item.inventory_item_flag,
             item.last_update_date
        FROM inv.mtl_system_items_b item,
             hr.hr_organization_information hoi,
             apps.hr_operating_units hou
       WHERE hoi.org_information_context = 'Accounting Information'
         AND hoi.org_information3 = hou.organization_id
         AND item.organization_id = hoi.organization_id
         AND item.enabled_flag = 'Y'
         AND hou.organization_id = '$in_org_id'
         AND TRUNC (item.last_update_date) <= '$in_update_date' 
		 AND item.inventory_item_flag = 'Y' 
		 order by item.last_update_date desc";
}

function insertItem ($data)
{
	return "INSERT INTO tbl_item
                      (item_kd, item_id, item_org_id, item_deskripsi,
                       item_satuan, create_date)
				VALUES ('$data[ITEM_KD]','$data[ITEM_ID]','$data[ITEM_ORG_ID]','$data[ITEM_DESKRIPSI]','$data[ITEM_SATUAN]',SYSDATE)";
}


function getJasa ($in_org_id, $in_update_date)
{
	return "SELECT item.segment1 kode_item, item.inventory_item_id,
             hou.organization_id, item.description,
             item.primary_unit_of_measure uom, item.inventory_item_flag,
             item.last_update_date
        FROM inv.mtl_system_items_b item,
             hr.hr_organization_information hoi,
             apps.hr_operating_units hou
       WHERE hoi.org_information_context = 'Accounting Information'
         AND hoi.org_information3 = hou.organization_id
         AND item.organization_id = hoi.organization_id
         AND item.enabled_flag = 'Y'
         AND hou.organization_id = '$in_org_id'
         AND TRUNC (item.last_update_date) <= '$in_update_date'
		 AND NVL (item.inventory_item_flag, 'N') = 'N' 
		 order by item.last_update_date desc";
}

function insertJasa ($data)
{
	return "INSERT INTO tbl_jasa
                      (jasa_kd, jasa_id, jasa_org_id, jasa_deskripsi,
                       jasa_satuan, create_date)
				VALUES ('$data[ITEM_KD]','$data[ITEM_ID]','$data[ITEM_ORG_ID]','$data[ITEM_DESKRIPSI]','$data[ITEM_SATUAN]',SYSDATE)";
}

function getVendor ($in_org_id, $in_update_date)
{
	return "SELECT aps.vendor_id id_vendor, apsa.vendor_site_id site_id,
             apsa.org_id, apsa.vendor_site_code site_code,
             aps.segment1 vendor_no, aps.vat_registration_num npwp_vendor,
             aps.vendor_name nm_vendor, aps.vendor_name_alt nm_vendor_alt,
                apsa.address_line1
             || DECODE (NVL (apsa.address_line2, 'X'),
                        'X', NULL,
                        ' ' || apsa.address_line2
                       )
             || DECODE (NVL (apsa.address_line3, 'X'),
                        'X', NULL,
                        ' ' || apsa.address_line3
                       )
             || DECODE (NVL (apsa.address_line4, 'X'),
                        'X', NULL,
                        ' ' || apsa.address_line4
                       ) almt_vendor,
             apsa.phone no_tlp, 0 status_read, apsa.last_update_date
        FROM ap_suppliers aps, ap_supplier_sites_all apsa
       WHERE aps.vendor_id = apsa.vendor_id
         AND apsa.inactive_date IS NULL
         AND aps.vendor_type_lookup_code NOT IN
                                            ('INTERNAL SUPPLIER', 'EMPLOYEE')
         AND apsa.purchasing_site_flag = 'Y'
         AND apsa.org_id = '$in_org_id'
         AND TRUNC (apsa.last_update_date) <= '$in_update_date'";
}

function insertVendor ($data)
{
	return "INSERT INTO tbl_vendor
                      (id_vendor, site_id, org_id, site_code, vendor_no,
                       npwp_vendor, nm_vendor, nm_vendor_alt, almt_vendor,
                       no_tlp, status_read, create_date)
				VALUES ('$data[ID_VENDOR]','$data[SITE_ID]','$data[ORG_ID]','$data[SITE_CODE]','$data[VENDOR_NO]',
						'$data[NPWP_VENDOR]','$data[NM_VENDOR]','$data[NM_VENDOR_ALT]','$data[ALMT_VENDOR]',
						'$data[NO_TELP]','$data[STATUS_READ]',SYSDATE)";
}

function getPoHeader($in_req_header_id)
{	
	return "SELECT *  
          FROM   tbl_po_header      
          WHERE  req_header_id = '$in_req_header_id'";
}

function getCountPoHeader($in_req_header_id)
{	
	return "SELECT count(*) as jumlah   
          FROM   tbl_po_header      
          WHERE  req_header_id = '$in_req_header_id'";
}

function getPoItemJasa($in_req_header_id)
{	
	return "SELECT * 
            FROM tbl_po_item_jasa
           WHERE req_header_id = '$in_req_header_id'";
}
?>