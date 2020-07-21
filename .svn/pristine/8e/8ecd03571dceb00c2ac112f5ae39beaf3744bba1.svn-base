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

//======= SQL Collection ========// 
function getAllQuery ($modul,$start,$end,&$result)
{
		if($modul=="PTP_OPUS_TO3"||$modul=="PTP_ITOS_TO3"||$modul=="PTP_ITOS_TO2"||$modul=="PTP_ITOS_TO1"||$modul=="PTP_009_NEW"||$modul=="PNK_OPUS"||$modul=="PJG_OPUS")//NBS
		{
			if($modul=="PTP_OPUS_TO3")
			{
				$result["modul"] = "PTP OPUS TO3";
				$dblink="APPS_OPUS_LINK2"; 
			}
			else if($modul=="PTP_ITOS_TO3")
			{
				$result["modul"] = "PTP ITOS TO3";
				$dblink="APPS_ITOS_PROD_T3_LINK";
			}
			else if($modul=="PTP_ITOS_TO2")
			{
				$result["modul"] = "PTP ITOS TO2";
				$dblink="APPS_ITOS_PROD_T2_LINK";
			}
			else if($modul=="PTP_ITOS_TO1")
			{
				$result["modul"] = "PTP ITOS TO1";
				$dblink="APPS_ITOS_PROD_T1_LINK";
			}
			else if($modul=="PTP_009_NEW")
			{
				$result["modul"] = "PTP 009 NEW";
				$dblink="APPS_OPUS009_BILLING";
			}
			else if($modul=="PNK_OPUS")
			{
				$result["modul"] = "PNK OPUS";
				$dblink="APPS_OPUS_PNK_LINK";
			}
			else if($modul=="PJG_OPUS")
			{
				$result["modul"] = "PJG OPUS";
				$dblink="APPS_OPUSPJG_BILLING";
			}
			
			$result["query_count_allnota"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";
			$result["query_row_allnota"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg, hdr.arprocess_date,  
		sign_currency as currency, receipt_account as bank  
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_arnotfound"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM TTH_NOTA_ALL2@$dblink hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.trx_number is null 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";
			$result["query_row_arnotfound"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg, hdr.arprocess_date, 
		sign_currency as currency, receipt_account as bank 
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.trx_number is null 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_receiptnotfound"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd')
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";	
			$result["query_row_receiptnotfound"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg,hdr.arprocess_date, 
		sign_currency as currency, receipt_account as bank 
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_overpayment"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_applied > hdr.kredit 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd')
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";	
			$result["query_row_overpayment"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg, hdr.arprocess_date, 
		sign_currency as currency, receipt_account as bank 
    FROM TTH_NOTA_ALL2@$dblink hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_applied > hdr.kredit 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	}
	else if($modul=="PTP_LINI2")
	{
			$result["dblink"]="apps_portal_ebs";

			$result["modul"] = "PTP LINI2";
			$result["query_count_allnota"] = "SELECT to_char(b.tgl_nota,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE (apsa.amount_applied>0 or apsa.amount_applied is null)
		AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(b.tgl_nota,'yyyy/MM/dd') 
    ORDER BY to_char(b.tgl_nota,'yyyy/MM/dd') desc";
			$result["query_row_allnota"] = "SELECT b.no_nota as trx_number, 
        b.tgl_nota as trx_date_simop,
        b.total_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        b.user_service as user_paid, 'n/a', 'n/a', 'n/a', 'n/a',
		currency, receipt_account as bank 
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) 
			AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY b.tgl_nota desc, currency, bank";
	
			$result["query_count_arnotfound"] = "SELECT to_char(b.tgl_nota,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE apsa.trx_number is null   
				AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(b.tgl_nota,'yyyy/MM/dd') 
    ORDER BY to_char(b.tgl_nota,'yyyy/MM/dd') desc";	
			$result["query_row_arnotfound"] = "SELECT b.no_nota as trx_number, 
        b.tgl_nota as trx_date_simop,
        b.total_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        b.user_service as user_paid, 'n/a', 'n/a', 'n/a', 'n/a',
		currency, receipt_account as bank     
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE apsa.trx_number is null   
					AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY b.tgl_nota desc, currency, bank";
	
			$result["query_count_receiptnotfound"] = "SELECT to_char(b.tgl_nota,'yyyy/MM/dd') as trx_date, count(*) as trx_count    
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE apsa.amount_due_remaining > 0 
						AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(b.tgl_nota,'yyyy/MM/dd')  
    ORDER BY to_char(b.tgl_nota,'yyyy/MM/dd') desc";	
			$result["query_row_receiptnotfound"] = "SELECT b.no_nota as trx_number, 
        b.tgl_nota as trx_date_simop,
        b.total_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        b.user_service as user_paid, 'n/a', 'n/a', 'n/a', 'n/a',
		currency, receipt_account as bank    
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE apsa.amount_due_remaining > 0 
							AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY trx_date_simop desc, currency, bank";

			$result["query_count_overpayment"] = "SELECT to_char(b.tgl_nota,'yyyy/MM/dd') as trx_date, count(*) as trx_count    
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE apsa.amount_applied > b.total_tagihan 
						AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(b.tgl_nota,'yyyy/MM/dd')  
    ORDER BY to_char(b.tgl_nota,'yyyy/MM/dd') desc";	
			$result["query_row_overpayment"] = "SELECT b.no_nota as trx_number, 
        b.tgl_nota as trx_date_simop,
        b.total_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        b.user_service as user_paid, 'n/a', 'n/a', 'n/a', 'n/a',
		currency, receipt_account as bank  
    FROM billing_obx.bil_nota_ptp_h@apps_portal_ebs b
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = b.no_nota 
    WHERE apsa.amount_applied > b.total_tagihan  
							AND b.tgl_nota BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY trx_date_simop desc, currency, bank";	
	}
	else if($modul=="PTP_KAPAL_AUTOCOLLECTION")
	{
			$result["dblink"]="apps_simop_link";
			
			$result["modul"] = "PTP KAPAL AUTOCOLLECTION";
			$result["query_count_allnota"] = "SELECT to_char(hdr.insert_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.insert_date,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc";
			$result["query_row_allnota"] = "SELECT hdr.no_nota as trx_number, 
        hdr.insert_date as trx_date_simop,
        p.jumlah_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 
		b.currecy as currency, bank_id as bank 
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.ac_ppkb_log@apps_simop_link b on hdr.no_ppkb=b.no_ppkb 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
	and b.ppkb_ke='1' 
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_arnotfound"] = "SELECT to_char(hdr.insert_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
    WHERE apsa.trx_number is null 
	AND hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.insert_date,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc";
			$result["query_row_arnotfound"] = "SELECT hdr.no_nota as trx_number, 
        hdr.insert_date as trx_date_simop,
        p.jumlah_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 
		b.currecy as currency, bank_id as bank   
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.ac_ppkb_log@apps_simop_link b on hdr.no_ppkb=b.no_ppkb 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
    WHERE apsa.trx_number is null 
	AND hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    and b.ppkb_ke='1' 
	ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_receiptnotfound"] = "SELECT to_char(hdr.insert_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
	WHERE apsa.amount_due_remaining > 0 
	AND hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.insert_date,'yyyy/MM/dd')
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc";	
			$result["query_row_receiptnotfound"] = "SELECT hdr.no_nota as trx_number, 
        hdr.insert_date as trx_date_simop,
        p.jumlah_tagihan as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 
		b.currecy as currency, bank_id as bank   
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.ac_ppkb_log@apps_simop_link b on hdr.no_ppkb=b.no_ppkb 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
	and b.ppkb_ke='1' 
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_overpayment"] = "SELECT to_char(hdr.insert_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
    WHERE apsa.amount_applied > hdr.tagihan_nota 
	AND hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.insert_date,'yyyy/MM/dd')
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc";	
			$result["query_row_overpayment"] = "SELECT hdr.no_nota as trx_number, 
        hdr.insert_date as trx_date_simop,
        hdr.tagihan_nota as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 
		b.currecy as currency, bank_id as bank   
    FROM kapal_prod.ac_deduct_nota@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	LEFT JOIN kapal_prod.ac_ppkb_log@apps_simop_link b on hdr.no_ppkb=b.no_ppkb 
	LEFT JOIN kapal_prod.tt_dpjk_total@apps_simop_link p on hdr.no_pkk=p.no_ukk 
    WHERE apsa.amount_applied > hdr.tagihan_nota  
	AND hdr.insert_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
	and b.ppkb_ke='1' 
    ORDER BY to_char(hdr.insert_date,'yyyy/MM/dd') desc, currency, bank";	
	}
	else if($modul=="PTP_BARANG")
	{
			$result["modul"] = "PTP BARANG";
			$result["query_count_allnota"] = "SELECT to_char(hdr.trx_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.trx_date,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc";
			$result["query_row_allnota"] = "SELECT hdr.trx_number as trx_number, 
        hdr.trx_date as trx_date_simop,
        (select SUM(round(dtl.amount*1.1))FROM barang_prod.ptp_nota_detail@apps_simop_link dtl where dtl.trx_number=hdr.trx_number) as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a',
		currency_code as currency, receipt_account as bank 
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_arnotfound"] = "SELECT to_char(hdr.trx_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
    WHERE apsa.trx_number is null 
	AND hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.trx_date,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc";
			$result["query_row_arnotfound"] = "SELECT hdr.trx_number as trx_number, 
        hdr.trx_date as trx_date_simop,
        (select SUM(round(dtl.amount*1.1))FROM barang_prod.ptp_nota_detail@apps_simop_link dtl where dtl.trx_number=hdr.trx_number) as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a',
		currency_code as currency, receipt_account as bank   
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
    WHERE apsa.trx_number is null 
	AND hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_receiptnotfound"] = "SELECT to_char(hdr.trx_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.trx_date,'yyyy/MM/dd')
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc";	
			$result["query_row_receiptnotfound"] = "SELECT hdr.trx_number as trx_number, 
        hdr.trx_date as trx_date_simop,
        (select SUM(round(dtl.amount*1.1))FROM barang_prod.ptp_nota_detail@apps_simop_link dtl where dtl.trx_number=hdr.trx_number) as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a',
		currency_code as currency, receipt_account as bank   
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_overpayment"] = "SELECT to_char(hdr.trx_date,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
    WHERE apsa.amount_applied > (select SUM(round(dtl.amount*1.1))FROM barang_prod.ptp_nota_detail@apps_simop_link dtl where dtl.trx_number=hdr.trx_number) 
	AND hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.trx_date,'yyyy/MM/dd')
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc";	
			$result["query_row_overpayment"] = "SELECT hdr.trx_number as trx_number, 
        hdr.trx_date as trx_date_simop,
        (select SUM(round(dtl.amount*1.1))FROM barang_prod.ptp_nota_detail@apps_simop_link dtl where dtl.trx_number=hdr.trx_number) as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        'n/a', 'n/a', 'n/a', 'n/a', 'n/a',
		currency_code as currency, receipt_account as bank   
    FROM barang_prod.ptp_nota_header@apps_simop_link hdr
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.trx_number 
    WHERE apsa.amount_applied > (select SUM(round(dtl.amount*1.1))FROM barang_prod.ptp_nota_detail@apps_simop_link dtl where dtl.trx_number=hdr.trx_number)  
	AND hdr.trx_date BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.trx_date,'yyyy/MM/dd') desc, currency, bank";	
	}
	else if($modul=="PTP_009")
	{			
			$result["modul"] = "PTP 009";
			$result["query_count_allnota"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";
			$result["query_row_allnota"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg, 
		sign_currency as currency, receipt_account as bank 
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
	WHERE (apsa.amount_applied>0 or apsa.amount_applied is null) and hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_arnotfound"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count  
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.trx_number is null 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";
			$result["query_row_arnotfound"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg,
		sign_currency as currency, receipt_account as bank 
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.trx_number is null 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_receiptnotfound"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd')
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";	
			$result["query_row_receiptnotfound"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg,
		sign_currency as currency, receipt_account as bank 
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_due_remaining > 0 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";
	
			$result["query_count_overpayment"] = "SELECT to_char(hdr.date_created,'yyyy/MM/dd') as trx_date, count(*) as trx_count 
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_applied > hdr.kredit 
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    GROUP BY to_char(hdr.date_created,'yyyy/MM/dd')
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc";	
			$result["query_row_overpayment"] = "SELECT hdr.no_nota as trx_number, 
        hdr.date_created as trx_date_simop,
        hdr.kredit as amount,
        apsa.amount_due_remaining, apsa.amount_credited, apsa.amount_applied,
        hdr.user_paid, hdr.status_receiptmsg, hdr.status_nota, hdr.status_ar, hdr.status_armsg,
		sign_currency as currency, receipt_account as bank 
    FROM XMTI.TTH_NOTA_ALL2 hdr 
    LEFT JOIN ar_payment_schedules_all apsa on apsa.trx_number = hdr.no_nota 
    WHERE apsa.amount_applied > hdr.kredit  
	AND hdr.date_created BETWEEN TO_DATE ('".trim($start)."', 'DD/MM/YYYY HH24:MI:SS') and TO_DATE ('".trim($end)."', 'DD/MM/YYYY HH24:MI:SS') 
    ORDER BY to_char(hdr.date_created,'yyyy/MM/dd') desc, currency, bank";	
	}
}
?>