<?php
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$Modul Integrasi$                                                         	  |
  | Author                  : Endang Fiansyah				                                          |
  | Owner                   : IPC				                                                      |
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
  | Description              : Service pack for mti staging and orafin integration                    |
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
	//show all query
	return false;
}

//======= Set Debug Mode 2 ========//
function getDebugMode2()
{
	//default is true
	//show query if return failed
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

function populateInvoice($in_no_nota) {

	$inv_char 	= array("'");
	$fix_char		= array("''");
	
	try {
		$conn['ori'] = oriDb();
		
		if(!checkOriDb($conn['ori'],$err)) goto Err;
					
		/*POPULATE DATA*/
		
		$sql = "DELETE FROM xpi2.tth_nota_all2 WHERE no_nota = '$in_no_nota'";
		if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_tth_nota_all2,$err)) goto Err;

		//get nota header from mti
		if(!checkOriSQL($conn['ori']['mti'],getCountNotaHeader($in_no_nota),$query_nota_header,$err)) goto Err;
		$row = oci_fetch_array($query_nota_header, OCI_ASSOC);
		if($row[JUMLAH]==0)
		{
			$err .= "Nota tidak ditemukan";
			goto Err;
		}

		//get nota header from mti
		if(!checkOriSQL($conn['ori']['mti'],getNotaHeader($in_no_nota),$query_nota_header,$err)) goto Err;

		while ($row = oci_fetch_array($query_nota_header, OCI_ASSOC))
		{
		
			$sql_get_ptp_cust_no = "SELECT COUNT(*) as JUMLAH FROM XPI2.MTI_CUSTOMER WHERE CUST_NO_MTI='$row[CUST_NO]'";

			if(!checkOriSQL($conn['ori']['orafin'],$sql_get_ptp_cust_no,$query_mti_customer,$err)) goto Err;
			$row_mti = oci_fetch_array($query_mti_customer, OCI_ASSOC);
			
			if($row_mti['JUMLAH']==0)
			{
				$sql = "UPDATE xmti.tth_nota_all2 
							SET STATUS_NOTA= 'F',
								STATUS_AR = 'F',
								STATUS_ARMSG = 'Customer tidak ditemukan',
								ARPROCESS_DATE = SYSDATE 
						WHERE no_nota = '$in_no_nota'";
	
				if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;

				$err .= "Customer tidak ditemukan";
				goto Err;
			}
			
			$sql_get_ptp_cust_no = "SELECT CUST_NO_PTP, CUST_NAME_PTP FROM XPI2.MTI_CUSTOMER WHERE CUST_NO_MTI='$row[CUST_NO]'";

			if(!checkOriSQL($conn['ori']['orafin'],$sql_get_ptp_cust_no,$query_mti_customer,$err)) goto Err;
			$row_mti = oci_fetch_array($query_mti_customer, OCI_ASSOC);

			//$message .= $row[NO_NOTA].";";
			$header['KD_MODUL'] = $row['KD_MODUL'];
			$header['NO_NOTA'] = $row['NO_NOTA'];
			$header['NO_REQUEST'] = $row['NO_REQUEST'];
			$header['NO_FAKTUR_PAJAK'] = $row['NO_FAKTUR_PAJAK'];					
			$header['CUST_NO_MTI'] = $row['CUST_NO'];
			$header['CUST_NO'] = $row_mti['CUST_NO_PTP'];
			$header['CUST_NAME'] = $row_mti['CUST_NAME_PTP'];
			$header['CUST_ADDR'] = str_replace($inv_char,$fix_char,$row['CUST_ADDR']);
			$header['CUST_NPWP'] = $row['CUST_NPWP'];
			$header['SIGN_CURRENCY'] = $row['SIGN_CURRENCY'];
			$header['TOTAL'] = $row['TOTAL'];
			$header['PPN'] = $row['PPN'];
			$header['KREDIT'] = $row['KREDIT'];
			$header['STATUS_NOTA'] = $row['STATUS_NOTA'];
			$header['KD_CABANG'] = $row['KD_CABANG'];
			$header['KD_CABANG_SIMKEU'] = $row['KD_CABANG_SIMKEU'];
			$header['NO_UKK'] = $row['NO_UKK'];
			$header['DATE_CREATED'] = $row['DATE_CREATED'];
			$header['USER_CREATED'] = $row['USER_CREATED'];
			$header['STATUS_CREATED'] = $row['STATUS_CREATED'];
			$header['DATE_PAID'] = $row['DATE_PAID'];
			$header['USER_PAID'] = $row['USER_PAID'];
			$header['STATUS_PAID'] = $row['STATUS_PAID'];
			$header['PAID_VIA'] = $row['PAID_VIA'];
			$header['RECEIPT_METHOD'] = $row['RECEIPT_METHOD'];
			$header['RECEIPT_ACCOUNT'] = $row['RECEIPT_ACCOUNT'];
			$header['DATE_TRANSFER'] = $row['DATE_TRANSFER'];
			$header['USER_TRANSFER'] = $row['USER_TRANSFER'];
			$header['STATUS_TRANSFER'] = $row['STATUS_TRANSFER'];
			$header['KD_LOCATION'] = $row['KD_LOCATION'];
			$header['VESSEL'] = $row['VESSEL'];
			$header['VOYAGE_IN'] = $row['VOYAGE_IN'];
			$header['VOYAGE_OUT'] = $row['VOYAGE_OUT'];
			$header['BANK_ACCOUNT_ID'] = $row['BANK_ACCOUNT_ID'];
			$header['NOTAPREV'] = $row['NOTAPREV'];
			$header['JENIS_MODUL'] = $row['JENIS_MODUL'];
			$header['PENUMPUKAN_FROM'] = $row['PENUMPUKAN_FROM'];
			$header['PENUMPUKAN_TO'] = $row['PENUMPUKAN_TO'];
			$header['NOMOR_BL_PEB'] = $row['NOMOR_BL_PEB'];
			$header['NO_DO'] = $row['NO_DO'];
			$header['TANGGAL_TIBA'] = $row['TANGGAL_TIBA'];
			$header['BONGKAR_MUAT'] = $row['BONGKAR_MUAT'];
			$header['ORG_ID'] = $row['ORG_ID'];
			$header['RECEIPT_NAME'] = $row['RECEIPT_NAME'];
			$header['ADMINISTRASI'] = $row['ADMINISTRASI'];
			$header['STATUS_NOTA2'] = $row['STATUS_NOTA2'];
			$header['KD_PELUNASAN'] = $row['KD_PELUNASAN'];
			$header['KETERANGAN'] = $row['KETERANGAN'];
			$header['NO_BA'] = $row['NO_BA'];
			$header['STATUS_AR'] = $row['STATUS_AR'];
			$header['STATUS_ARMSG'] = str_replace($inv_char,$fix_char,$row['STATUS_ARMSG']);
			$header['STATUS_RECEIPT'] = $row['STATUS_RECEIPT'];
			$header['STATUS_RECEIPTMSG'] = str_replace($inv_char,$fix_char,$row['STATUS_RECEIPTMSG']);
			$header['ARPROCESS_DATE'] = $row['ARPROCESS_DATE'];
			$header['RECEIPTPROCESS_DATE'] = $row['RECEIPTPROCESS_DATE'];


			/**/
			$sql = "INSERT INTO xpi2.tth_nota_all2 
					  (KD_MODUL,NO_NOTA,NO_REQUEST,NO_FAKTUR_PAJAK,CUST_NO,
						CUST_NAME,CUST_ADDR,CUST_NPWP,SIGN_CURRENCY,TOTAL,
						PPN,KREDIT,STATUS_NOTA,KD_CABANG,KD_CABANG_SIMKEU,
						NO_UKK,DATE_CREATED,USER_CREATED,STATUS_CREATED,DATE_PAID,
						USER_PAID,STATUS_PAID,PAID_VIA,RECEIPT_METHOD,RECEIPT_ACCOUNT,
						DATE_TRANSFER,USER_TRANSFER,STATUS_TRANSFER,KD_LOCATION,VESSEL,
						VOYAGE_IN,VOYAGE_OUT,BANK_ACCOUNT_ID,NOTAPREV,JENIS_MODUL,
						PENUMPUKAN_FROM,PENUMPUKAN_TO,NOMOR_BL_PEB,NO_DO,TANGGAL_TIBA,
						BONGKAR_MUAT,ORG_ID,RECEIPT_NAME,ADMINISTRASI,STATUS_NOTA2,
						KD_PELUNASAN,KETERANGAN,NO_BA,STATUS_AR,STATUS_ARMSG,
						STATUS_RECEIPT,STATUS_RECEIPTMSG,ARPROCESS_DATE,RECEIPTPROCESS_DATE
					  )
			   VALUES ('$header[KD_MODUL]','$header[NO_NOTA]','$header[NO_REQUEST]','$header[NO_FAKTUR_PAJAK]','$header[CUST_NO]',
						'$header[CUST_NAME]','$header[CUST_ADDR]','$header[CUST_NPWP]','$header[SIGN_CURRENCY]','$header[TOTAL]',
						'$header[PPN]','$header[KREDIT]','$header[STATUS_NOTA]','$header[KD_CABANG]','$header[KD_CABANG_SIMKEU]',
						'$header[NO_UKK]','$header[DATE_CREATED]','$header[USER_CREATED]','$header[STATUS_CREATED]','$header[DATE_PAID]',
						'$header[USER_PAID]','$header[STATUS_PAID]','$header[PAID_VIA]','$header[RECEIPT_METHOD]','$header[RECEIPT_ACCOUNT]',
						'$header[DATE_TRANSFER]','$header[USER_TRANSFER]','$header[STATUS_TRANSFER]','$header[KD_LOCATION]','$header[VESSEL]',
						'$header[VOYAGE_IN]','$header[VOYAGE_OUT]','$header[BANK_ACCOUNT_ID]','$header[NOTAPREV]','$header[JENIS_MODUL]',
						'$header[PENUMPUKAN_FROM]','$header[PENUMPUKAN_TO]','$header[NOMOR_BL_PEB]','$header[NO_DO]','$header[TANGGAL_TIBA]',
						'$header[BONGKAR_MUAT]','$header[ORG_ID]','$header[RECEIPT_NAME]','$header[ADMINISTRASI]','$header[STATUS_NOTA2]',
						'$header[KD_PELUNASAN]','$header[KETERANGAN]','$header[NO_BA]','$header[STATUS_AR]','$header[STATUS_ARMSG]',
						'$header[STATUS_RECEIPT]','$header[STATUS_RECEIPTMSG]','$header[ARPROCESS_DATE]','$header[RECEIPTPROCESS_DATE]'

					  )";
			
			if(!checkOriSQLAutoCommit($conn['ori']['orafin'],$sql,$query_tth_nota_all2,$err)) goto Err;
	
			$sql = "DELETE FROM XPI2.TTR_NOTA_ALL lines WHERE lines.kd_uper = '$in_no_nota'";
		 
			if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_po,$err)) goto Err;
	
			//get nota detail from mti
			if(!checkOriSQL($conn['ori']['mti'],getCountNotaLines($in_no_nota),$query_ttr_nota_all,$err)) goto Err;
			$row = oci_fetch_array($query_ttr_nota_all, OCI_ASSOC);
			if($row[JUMLAH]==0)
			{
				$err .= "Detil Nota tidak ditemukan";
				goto Err;
			}
			
			//get sum detail from mti
			$sql = "select sum(tottarif) as total_tarif from xmti.ttr_nota_all where kd_uper = '$in_no_nota'";
			
			if(!checkOriSQL($conn['ori']['mti'],$sql,$query_sum_total_tarif,$err)) goto Err;
			$row = oci_fetch_array($query_sum_total_tarif, OCI_ASSOC);
			if($row['TOTAL_TARIF']!=$header['TOTAL'])
			{
				$err .= "Total header (".$header['TOTAL'].") dan detail (".$row['TOTAL_TARIF'].") berbeda";
				goto Err;
			}
		
			/*get lines from mti*/
			if(!checkOriSQL($conn['ori']['mti'],getNotaLines($in_no_nota),$query_ttr_nota_all,$err)) goto Err;
			
			$line_number = 1;
			while ($row = oci_fetch_array($query_ttr_nota_all, OCI_ASSOC))
			{  
				$line['KD_MODUL'] = $row['KD_MODUL'];
				$line['KD_UPER'] = $row['KD_UPER'];
				$line['KD_PERMINTAAN'] = $row['KD_PERMINTAAN'];
				$line['QTY'] = $row['QTY'];
				$line['SIZE_'] = $row['SIZE_'];
				$line['TYPE_'] = $row['TYPE_'];
				$line['STATUS_'] = $row['STATUS_'];
				$line['TARIF'] = $row['TARIF'];
				$line['TOTTARIF'] = $row['TOTTARIF'];
				$line['URAIAN'] = $row['URAIAN'];
				$line['TOTHARI'] = $row['TOTHARI'];
				$line['HZ'] = $row['HZ'];
				$line['EI'] = $row['EI'];
				$line['OI'] = $row['OI'];
				$line['CRANE'] = $row['CRANE'];
				$line['PLUG_IN'] = $row['PLUG_IN'];
				$line['PLUG_OUT'] = $row['PLUG_OUT'];
				$line['HOURS'] = $row['HOURS'];
				$line['SHIFT'] = $row['SHIFT'];
				$line['SHIFT_BAYAR'] = $row['SHIFT_BAYAR'];
				$line['TGL_AWAL'] = $row['TGL_AWAL'];
				$line['TGL_AKHIR'] = $row['TGL_AKHIR'];
				$line['KETERANGAN'] = $row['KETERANGAN'];
				$line['PPNTARIF'] = $row['PPNTARIF'];
				$line['TOTHR'] = $row['TOTHR'];
				$line['CURRENCY_CODE'] = $row['CURRENCY_CODE'];
				//$line['LINE_NUMBER'] = $row['LINE_NUMBER'];
				$line['LINE_NUMBER'] = $line_number;
				$line['SEQ_ID_CFACC'] = $row['SEQ_ID_CFACC'];
				$line['TAX_FLAG'] = $row['TAX_FLAG'];
				$line['SIZE_TYPE_STAT_HAZ'] = $row['SIZE_TYPE_STAT_HAZ'];
				$line['IMO_CLASS'] = $row['IMO_CLASS'];
				$line['DISCOUNT'] = $row['DISCOUNT'];
				$line['TON'] = $row['TON'];
				$line['M3'] = $row['M3'];
				$line['TIPE_LAYANAN'] = $row['TIPE_LAYANAN'];
				
				/**/
				$sql = "INSERT INTO xpi2.TTR_NOTA_ALL 
                         (KD_MODUL,KD_UPER,KD_PERMINTAAN,QTY,SIZE_,
						 TYPE_,STATUS_,TARIF,TOTTARIF,URAIAN,
						 TOTHARI,HZ,EI,OI,CRANE,
						 PLUG_IN,PLUG_OUT,HOURS,SHIFT,SHIFT_BAYAR,
						 TGL_AWAL,TGL_AKHIR,KETERANGAN,PPNTARIF,TOTHR,
						 CURRENCY_CODE,LINE_NUMBER,SEQ_ID_CFACC,TAX_FLAG,SIZE_TYPE_STAT_HAZ,
						 IMO_CLASS,DISCOUNT,TON,M3,TIPE_LAYANAN
                         )
                  VALUES ('$line[KD_MODUL]','$line[KD_UPER]','$line[KD_PERMINTAAN]','$line[QTY]','$line[SIZE_]',
							'$line[TYPE_]','$line[STATUS_]','$line[TARIF]','$line[TOTTARIF]','$line[URAIAN]',
							'$line[TOTHARI]','$line[HZ]','$line[EI]','$line[OI]','$line[CRANE]',
							'$line[PLUG_IN]','$line[PLUG_OUT]','$line[HOURS]','$line[SHIFT]','$line[SHIFT_BAYAR]',
							'$line[TGL_AWAL]','$line[TGL_AKHIR]','$line[KETERANGAN]','$line[PPNTARIF]','$line[TOTHR]',
							'$line[CURRENCY_CODE]','$line[LINE_NUMBER]','$line[SEQ_ID_CFACC]','$line[TAX_FLAG]','$line[SIZE_TYPE_STAT_HAZ]',
							'$line[IMO_CLASS]','$line[DISCOUNT]','$line[TON]','$line[M3]','$line[TIPE_LAYANAN]'
                         )";
				
				if(!checkOriSQLAutoCommit($conn['ori']['orafin'],$sql,$query_ttr_nota_all2,$err)) goto Err;
				
				$line_number++;
			}
				
			/*POPULATE INVOICE : CALL PACKAGE*/
			$sql_pop_invoice = "
						BEGIN 
							APPS.xmti_ar_invoice_pkg.generate_invoice_billing(
								:in_trx_number,
								:in_org_id,
								:in_source,
								:out_status,
								:out_message);
						 END;";
						 
			$stid = oci_parse($conn['ori']['orafin'], $sql_pop_invoice) or die ('Can not parse query');
			
			$in_source = "MTI";
			oci_bind_by_name($stid, "in_trx_number", &$in_no_nota,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "in_org_id", &$header['ORG_ID'],1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "in_source", &$in_source,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "out_status", &$out_status,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "out_message", &$out_message,1000) or die ('Can not bind variable');

			if (!oci_execute($stid)) {
			
				$e = oci_error($stid);
				
				$err = $e[message];
				goto Err;
				
			}
			else
			{				
				$out_message = str_replace($inv_char,$fix_char,$out_message);
				
				if($out_status=="F")
				{					
					$sql = "UPDATE xmti.tth_nota_all2
					SET STATUS_NOTA= 'F',
						STATUS_AR = 'F',
						STATUS_ARMSG = '$out_message',
						ARPROCESS_DATE = SYSDATE  
					WHERE no_nota = '$in_no_nota'";
		
					if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;
					
					$err .= $out_message;
					goto Err;
				}
				else if($out_status=="S")
				{				
					$sql = "UPDATE xmti.tth_nota_all2
					SET STATUS_NOTA= 'T',
						STATUS_AR = 'S',
						STATUS_ARMSG = '$out_message',
						ARPROCESS_DATE = SYSDATE  
					WHERE no_nota = '$in_no_nota'";
		
					if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;
					
					$message .= $out_message;
					goto Success;
				}
				else 
				{
					$sql = "UPDATE xmti.tth_nota_all2
					SET STATUS_NOTA= 'F',
						STATUS_AR = 'F',
						STATUS_ARMSG = '$out_message',
						ARPROCESS_DATE = SYSDATE  
					WHERE no_nota = '$in_no_nota'";
		
					if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;

					$err .= $out_message;
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

function generatePayment($in_no_nota) {

	$inv_char 	= array("'");
	$fix_char		= array("''");

	try {
		$conn['ori'] = oriDb();

		if(!checkOriDb($conn['ori'],$err)) goto Err;

		/*POPULATE DATA*/
		
		$sql = "DELETE FROM xpi2.tth_nota_all2 WHERE no_nota = '$in_no_nota'";
		if(!checkOriSQL($conn['ori']['orafin'],$sql,$query_tth_nota_all2,$err)) goto Err;

		//get nota header from mti
		if(!checkOriSQL($conn['ori']['mti'],getCountNotaHeader($in_no_nota),$query_nota_header,$err)) goto Err;
		$row = oci_fetch_array($query_nota_header, OCI_ASSOC);
		if($row[JUMLAH]==0)
		{
			$err .= "Nota tidak ditemukan";
			goto Err;
		}

		//get nota header from mti
		if(!checkOriSQL($conn['ori']['mti'],getNotaHeader($in_no_nota),$query_nota_header,$err)) goto Err;

		while ($row = oci_fetch_array($query_nota_header, OCI_ASSOC))
		{
			$sql_get_ptp_cust_no = "SELECT COUNT(*) as JUMLAH FROM XPI2.MTI_CUSTOMER WHERE CUST_NO_MTI='$row[CUST_NO]'";
			
			if(!checkOriSQL($conn['ori']['orafin'],$sql_get_ptp_cust_no,$query_mti_customer,$err)) goto Err;
			$row_mti = oci_fetch_array($query_mti_customer, OCI_ASSOC);
			if($row_mti[JUMLAH]==0)
			{
				$sql = "UPDATE xpi2.tth_nota_all2
				SET STATUS_RECEIPT = 'F',
					STATUS_RECEIPTMSG = 'Customer tidak ditemukan',
					RECEIPTPROCESS_DATE = SYSDATE 
				WHERE no_nota = '$in_no_nota'";
	
				if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;
					
				$err .= "Customer tidak ditemukan";
				goto Err;
			}
		
			$sql_get_ptp_cust_no = "SELECT CUST_NO_PTP, CUST_NAME_PTP FROM XPI2.MTI_CUSTOMER WHERE CUST_NO_MTI='$row[CUST_NO]'";
			
			if(!checkOriSQL($conn['ori']['orafin'],$sql_get_ptp_cust_no,$query_mti_customer,$err)) goto Err;
			$row_mti = oci_fetch_array($query_mti_customer, OCI_ASSOC);
			
			//$message .= $row[NO_NOTA].";";
			$header['KD_MODUL'] = $row['KD_MODUL'];
			$header['NO_NOTA'] = $row['NO_NOTA'];
			$header['NO_REQUEST'] = $row['NO_REQUEST'];
			$header['NO_FAKTUR_PAJAK'] = $row['NO_FAKTUR_PAJAK'];					
			$header['CUST_NO_MTI'] = $row['CUST_NO'];
			$header['CUST_NO'] = $row_mti['CUST_NO_PTP'];
			$header['CUST_NAME'] = $row_mti['CUST_NAME_PTP'];
			$header['CUST_ADDR'] = str_replace($inv_char,$fix_char,$row['CUST_ADDR']);
			$header['CUST_NPWP'] = $row['CUST_NPWP'];
			$header['SIGN_CURRENCY'] = $row['SIGN_CURRENCY'];
			$header['TOTAL'] = $row['TOTAL'];
			$header['PPN'] = $row['PPN'];
			$header['KREDIT'] = $row['KREDIT'];
			$header['STATUS_NOTA'] = $row['STATUS_NOTA'];
			$header['KD_CABANG'] = $row['KD_CABANG'];
			$header['KD_CABANG_SIMKEU'] = $row['KD_CABANG_SIMKEU'];
			$header['NO_UKK'] = $row['NO_UKK'];
			$header['DATE_CREATED'] = $row['DATE_CREATED'];
			$header['USER_CREATED'] = $row['USER_CREATED'];
			$header['STATUS_CREATED'] = $row['STATUS_CREATED'];
			$header['DATE_PAID'] = $row['DATE_PAID'];
			$header['USER_PAID'] = $row['USER_PAID'];
			$header['STATUS_PAID'] = $row['STATUS_PAID'];
			$header['PAID_VIA'] = $row['PAID_VIA'];
			$header['RECEIPT_METHOD'] = $row['RECEIPT_METHOD'];
			$header['RECEIPT_ACCOUNT'] = $row['RECEIPT_ACCOUNT'];
			$header['DATE_TRANSFER'] = $row['DATE_TRANSFER'];
			$header['USER_TRANSFER'] = $row['USER_TRANSFER'];
			$header['STATUS_TRANSFER'] = $row['STATUS_TRANSFER'];
			$header['KD_LOCATION'] = $row['KD_LOCATION'];
			$header['VESSEL'] = $row['VESSEL'];
			$header['VOYAGE_IN'] = $row['VOYAGE_IN'];
			$header['VOYAGE_OUT'] = $row['VOYAGE_OUT'];
			$header['BANK_ACCOUNT_ID'] = $row['BANK_ACCOUNT_ID'];
			$header['NOTAPREV'] = $row['NOTAPREV'];
			$header['JENIS_MODUL'] = $row['JENIS_MODUL'];
			$header['PENUMPUKAN_FROM'] = $row['PENUMPUKAN_FROM'];
			$header['PENUMPUKAN_TO'] = $row['PENUMPUKAN_TO'];
			$header['NOMOR_BL_PEB'] = $row['NOMOR_BL_PEB'];
			$header['NO_DO'] = $row['NO_DO'];
			$header['TANGGAL_TIBA'] = $row['TANGGAL_TIBA'];
			$header['BONGKAR_MUAT'] = $row['BONGKAR_MUAT'];
			$header['ORG_ID'] = $row['ORG_ID'];
			$header['RECEIPT_NAME'] = $row['RECEIPT_NAME'];
			$header['ADMINISTRASI'] = $row['ADMINISTRASI'];
			$header['STATUS_NOTA2'] = $row['STATUS_NOTA2'];
			$header['KD_PELUNASAN'] = $row['KD_PELUNASAN'];
			$header['KETERANGAN'] = $row['KETERANGAN'];
			$header['NO_BA'] = $row['NO_BA'];
			$header['STATUS_AR'] = $row['STATUS_AR'];
			$header['STATUS_ARMSG'] = str_replace($inv_char,$fix_char,$row['STATUS_ARMSG']);
			$header['STATUS_RECEIPT'] = $row['STATUS_RECEIPT'];
			$header['STATUS_RECEIPTMSG'] = str_replace($inv_char,$fix_char,$row['STATUS_RECEIPTMSG']);
			$header['ARPROCESS_DATE'] = $row['ARPROCESS_DATE'];
			$header['RECEIPTPROCESS_DATE'] = $row['RECEIPTPROCESS_DATE'];


			/**/
			$sql = "INSERT INTO xpi2.tth_nota_all2 
					  (KD_MODUL,NO_NOTA,NO_REQUEST,NO_FAKTUR_PAJAK,CUST_NO,
						CUST_NAME,CUST_ADDR,CUST_NPWP,SIGN_CURRENCY,TOTAL,
						PPN,KREDIT,STATUS_NOTA,KD_CABANG,KD_CABANG_SIMKEU,
						NO_UKK,DATE_CREATED,USER_CREATED,STATUS_CREATED,DATE_PAID,
						USER_PAID,STATUS_PAID,PAID_VIA,RECEIPT_METHOD,RECEIPT_ACCOUNT,
						DATE_TRANSFER,USER_TRANSFER,STATUS_TRANSFER,KD_LOCATION,VESSEL,
						VOYAGE_IN,VOYAGE_OUT,BANK_ACCOUNT_ID,NOTAPREV,JENIS_MODUL,
						PENUMPUKAN_FROM,PENUMPUKAN_TO,NOMOR_BL_PEB,NO_DO,TANGGAL_TIBA,
						BONGKAR_MUAT,ORG_ID,RECEIPT_NAME,ADMINISTRASI,STATUS_NOTA2,
						KD_PELUNASAN,KETERANGAN,NO_BA,STATUS_AR,STATUS_ARMSG,
						STATUS_RECEIPT,STATUS_RECEIPTMSG,ARPROCESS_DATE,RECEIPTPROCESS_DATE
					  )
			   VALUES ('$header[KD_MODUL]','$header[NO_NOTA]','$header[NO_REQUEST]','$header[NO_FAKTUR_PAJAK]','$header[CUST_NO]',
						'$header[CUST_NAME]','$header[CUST_ADDR]','$header[CUST_NPWP]','$header[SIGN_CURRENCY]','$header[TOTAL]',
						'$header[PPN]','$header[KREDIT]','$header[STATUS_NOTA]','$header[KD_CABANG]','$header[KD_CABANG_SIMKEU]',
						'$header[NO_UKK]','$header[DATE_CREATED]','$header[USER_CREATED]','$header[STATUS_CREATED]','$header[DATE_PAID]',
						'$header[USER_PAID]','$header[STATUS_PAID]','$header[PAID_VIA]','$header[RECEIPT_METHOD]','$header[RECEIPT_ACCOUNT]',
						'$header[DATE_TRANSFER]','$header[USER_TRANSFER]','$header[STATUS_TRANSFER]','$header[KD_LOCATION]','$header[VESSEL]',
						'$header[VOYAGE_IN]','$header[VOYAGE_OUT]','$header[BANK_ACCOUNT_ID]','$header[NOTAPREV]','$header[JENIS_MODUL]',
						'$header[PENUMPUKAN_FROM]','$header[PENUMPUKAN_TO]','$header[NOMOR_BL_PEB]','$header[NO_DO]','$header[TANGGAL_TIBA]',
						'$header[BONGKAR_MUAT]','$header[ORG_ID]','$header[RECEIPT_NAME]','$header[ADMINISTRASI]','$header[STATUS_NOTA2]',
						'$header[KD_PELUNASAN]','$header[KETERANGAN]','$header[NO_BA]','$header[STATUS_AR]','$header[STATUS_ARMSG]',
						'$header[STATUS_RECEIPT]','$header[STATUS_RECEIPTMSG]','$header[ARPROCESS_DATE]','$header[RECEIPTPROCESS_DATE]'

					  )";
			
			if(!checkOriSQLAutoCommit($conn['ori']['orafin'],$sql,$query_tth_nota_all2,$err)) goto Err;
	
			/*GENERATE RECEIPT : CALL PACKAGE*/
			$sql_pop_invoice = "
						BEGIN 
							APPS.xmti_ar_receipt_pkg.generate_receipt_billing(
								:in_trx_number,
								:in_org_id,
								:in_source,
								:out_status,
								:out_message);
						 END;";
						 
			$stid = oci_parse($conn['ori']['orafin'], $sql_pop_invoice) or die ('Can not parse query');
			
			$in_source = "MTI";
			oci_bind_by_name($stid, "in_trx_number", &$in_no_nota,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "in_org_id", &$header['ORG_ID'],1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "in_source", &$in_source,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "out_status", &$out_status,1000) or die ('Can not bind variable');
			oci_bind_by_name($stid, "out_message", &$out_message,1000) or die ('Can not bind variable');
			
			if (!oci_execute($stid)) {
			
				$e = oci_error($stid);
				
				$err = $e[message];
				goto Err;
				
			}
			else
			{				
				$out_message = str_replace($inv_char,$fix_char,$out_message);
				
				if($out_status=="F")
				{
					$sql = "UPDATE xmti.tth_nota_all2
					SET STATUS_NOTA= 'F',
						STATUS_RECEIPT = 'F',
						STATUS_RECEIPTMSG = '$out_message',
						RECEIPTPROCESS_DATE = SYSDATE  
					WHERE no_nota = '$in_no_nota'";
		
					if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;
					
					$err .= $out_message;
					goto Err;
				}
				else if($out_status=="S")
				{				
					$sql = "UPDATE xmti.tth_nota_all2
					SET STATUS_NOTA= 'S',
						STATUS_RECEIPT = 'S',
						STATUS_RECEIPTMSG = '$out_message',
						RECEIPTPROCESS_DATE = SYSDATE  
					WHERE no_nota = '$in_no_nota'";
		
					if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;
					
					$message .= $out_message;
					goto Success;
				}
				else 
				{
					$sql = "UPDATE xmti.tth_nota_all2
					SET STATUS_NOTA= 'F',
						STATUS_RECEIPT = 'F',
						STATUS_RECEIPTMSG = '$out_message',
						RECEIPTPROCESS_DATE = SYSDATE  
					WHERE no_nota = '$in_no_nota'";
		
					if(!checkOriSQL($conn['ori']['mti'],$sql,$query_tbl_tth_nota_all2,$err)) goto Err;

					$err .= $out_message;
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

function getCustomerOrafin($customer_name, $customer_number, $insert_date_start, $insert_date_end) {

	//Untuk mengganti kalau ada karakter yang tidak valid menjadi karakter yang valid
	$inv_char 	= array("'", "<", ">", "&", "\"");
	$fix_char	= array(" ", " ", " ", " ", " ");

	try {
		$conn['ori'] = oriDb();
		
		if($customer_name!="")
		{
			$search_customer_name .= " and hp.party_name like '%".strtoupper($customer_name)."%' ";
		}
		
		if($customer_number!="")
		{
			$search_customer_number .= " and hca.account_number = '$customer_number' ";
		}

		if($insert_date_start!="")
		{
			$search_customer_number .= " and hca.creation_date >= TO_DATE ('".trim($insert_date_start)."', 'DD/MM/YYYY')";
		}

		if($insert_date_end!="")
		{
			$search_customer_number .= " and hca.creation_date <= (TO_DATE ('".trim($insert_date_end)."', 'DD/MM/YYYY') + 1)";
		}
		
		$sql_get_cust = "SELECT	hou.name, 
							 hp.party_name as customer_Name, 
							 hca.account_number as customer_number, 
							 hca.status as status, 
							 hp.tax_reference AS npwp_nomor, 
							 hl.address1, hl.address2, hl.address3, hl.address4, hl.city, 
							 hl.postal_code, hl.province, 
							 hp.party_type, hp.party_id, hp.party_number, 
							 hca.cust_account_id, 
							 hca.orig_system_reference, hca.customer_type, hca.customer_class_code, 
							 hca.payment_term_id, hcsua.site_use_id, hcsua.cust_acct_site_id, 
							 hcsua.LOCATION, 
							 hcas.party_site_id, hcas.org_id, hcas.bill_to_flag, hcas.status, 
							 hp.orig_system_reference,  hl.country,
							 hl.orig_system_reference, hca.customer_class_code, hca.customer_type,
							 hp.email_address, hca.attribute_category,
							 hca.attribute1 customer_attribute1, hca.attribute2 customer_attribute2,
							 hca.attribute3 customer_attribute3, hca.attribute4 customer_attribute4,
							 hcsua.attribute_category, hcsua.attribute1 site_attribute1,
							 hcsua.attribute2 site_attribute1, hcsua.attribute3 site_attribute1,
							 hcsua.attribute4 site_attribute1,
							 TO_CHAR(hca.creation_date, 'DD-MM-YYYY HH24:Mi:SS') as creation_date 
			FROM ar.hz_cust_accounts hca,
				 ar.hz_parties hp,
				 ar.hz_cust_acct_sites_all hcas,
				 ar.hz_cust_site_uses_all hcsua,
				 ar.hz_party_sites hps,
				 ar.hz_locations hl,
				 ar.hz_organization_profiles hop,
				 apps.hr_operating_units hou
		   WHERE hca.party_id = hp.party_id
			 AND hca.status = 'A'
			 AND hcas.cust_account_id = hca.cust_account_id
			 AND hcas.bill_to_flag = 'P'
			 AND hcas.status = 'A'
			 AND hcsua.status = 'A'
			 AND hcas.cust_acct_site_id = hcsua.cust_acct_site_id
			 AND hcas.party_site_id = hps.party_site_id
			 AND hps.location_id = hl.location_id
			 AND hcsua.site_use_code = 'BILL_TO'
			 AND hop.party_id = hca.party_id
			 AND hou.organization_id = hcas.org_id
			 AND TRUNC (SYSDATE) BETWEEN TRUNC (hop.effective_start_date)
									 AND TRUNC (NVL (hop.effective_end_date, SYSDATE))
			 and hou.organization_id = '1823' 
			 $search_customer_name 
			 $search_customer_number  
		ORDER BY hca.creation_date desc, hou.short_code, hca.account_number, hp.party_name";

		if(!checkOriSQL($conn['ori']['orafin'],$sql_get_cust,$query_get_customer,$err)) goto Err;

		while ($row = oci_fetch_array($query_get_customer, OCI_ASSOC))
		{
			$data .= "
			<c_data>
				<c_name>".str_replace($inv_char,$fix_char,$row[CUSTOMER_NAME])."</c_name>
				<c_number>$row[CUSTOMER_NUMBER]</c_number>
				<c_npwp>$row[NPWP_NOMOR]</c_npwp>
				<c_address>".str_replace($inv_char,$fix_char,$row[ADDRESS1])."</c_address>
				<c_status>$row[STATUS]</c_status>
				<c_insert_date>$row[CREATION_DATE]</c_insert_date>
			</c_data>";

/*			$data .= "
			<c_data>
				<c_name>".str_replace($inv_char,$fix_char,$row[CUSTOMER_NAME])."</c_name>
				<c_number>$row[CUSTOMER_NUMBER]</c_number>
				<c_npwp>$row[NPWP_NOMOR]</c_npwp>
				<c_address>".str_replace($inv_char,$fix_char,$row[ADDRESS1])."</c_address>
				<c_status>$row[STATUS]</c_status>
				<c_insert_date>$row[CREATION_DATE])</c_insert_date>
			</c_data>";*/
		}
		
		$message = "<root>".$data."</root>";
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
		return $err;
	
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		return $message;
}