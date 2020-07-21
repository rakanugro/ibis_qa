<?php

/*|
 | Function Name 	: syncData
 | Description 		: syncronization data customer
 | Creator			: Endang Fiansyah
 | Creation Date	: 02/07/2015
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function syncData($in_param) {
	
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

		$id = $xml_data->data->id;

		/*------------------------------------------START COLLECTION PROGRAM--------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		$already_insert_agen=false;
		$already_insert_pelanggan = false;
		
		$out_data = array();
		$data = array(
						'update_to_simop' 	=> 'F',
						'message_to_simop' 	=> 'ERROR',
						'update_to_simkeu' 	=> 'F',
						'message_to_simkeu' => 'NO DATA TO BE POPULATED'
						);
						
		$out_data['respons']=$data;

		//update customer setup
		//PL/SQL
		$sql_get_customer_data = "select * from mst_pelanggan_skapal where kd_pelanggan = '$id' and status_iu is null order by created_date asc";

		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$sql_get_customer_data,$query_get_customer_data,$err)) goto Err;
		
		//set status to on prosess = P 
		$sql_update_customer_data = "update mst_pelanggan_skapal set status_iu = 'P' where kd_pelanggan = '$id' and status_iu is null";
		if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data,$query_update_customer_data,$err)) goto Err;
		
		$sql_update_customer_data = "update mst_agen_skapal set insert_update_flag = 'P' where no_account = '$id' and insert_update_flag is null";
		if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data,$query_update_customer_data,$err)) goto Err;
		
		while($row = oci_fetch_array($query_get_customer_data, OCI_ASSOC))
		{
			//simkapal
			$ORG_ID_SIMOP= $row[ORG_ID]!="" ? $row[ORG_ID] : "";
			$KD_PELANGGAN= $row[KD_PELANGGAN]!="" ? $row[KD_PELANGGAN] : "";
			$NAMA_PERUSAHAAN= $row[NAMA_PERUSAHAAN]!="" ? $row[NAMA_PERUSAHAAN] : "";
			$NAMA_PERUSAHAAN_FIX= $row[NAMA_PERUSAHAAN_FIX]!="" ? $row[NAMA_PERUSAHAAN_FIX] : "";
			$NAMA_PERUSAHAAN_FAKTUR_PAJAK= $row[NAMA_PERUSAHAAN_FAKTUR_PAJAK]!="" ? $row[NAMA_PERUSAHAAN_FAKTUR_PAJAK] : "";
			$KELOMPOK_PELANGGAN= $row[KELOMPOK_PELANGGAN]!="" ? $row[KELOMPOK_PELANGGAN] : "";
			$ALAMAT_PERUSAHAAN= $row[ALAMAT_PERUSAHAAN]!="" ? $row[ALAMAT_PERUSAHAAN] : "";
			$KOTA_PERUSAHAAN= $row[KOTA_PERUSAHAAN]!="" ? $row[KOTA_PERUSAHAAN] : "";
			$KODE_POS_PERUSAHAAN= $row[KODE_POS_PERUSAHAAN]!="" ? $row[KODE_POS_PERUSAHAAN] : "";
			$EMAIL_PERUSAHAAN= $row[EMAIL_PERUSAHAAN]!="" ? $row[EMAIL_PERUSAHAAN] : "";
			$BIDANG_USAHA= $row[BIDANG_USAHA]!="" ? $row[BIDANG_USAHA] : "";
			$GRUP_USAHA= $row[GRUP_USAHA]!="" ? $row[GRUP_USAHA] : "";
			$TINGKAT_ORGANISASI= $row[TINGKAT_ORGANISASI]!="" ? $row[TINGKAT_ORGANISASI] : "";
			$NAMA_PENANGGUNG_JAWAB= $row[NAMA_PENANGGUNG_JAWAB]!="" ? $row[NAMA_PENANGGUNG_JAWAB] : "";
			$JABATAN_PENANGGUNG_JAWAB= $row[JABATAN_PENANGGUNG_JAWAB]!="" ? $row[JABATAN_PENANGGUNG_JAWAB] : "";
			$TL_PENANGGUNG_JAWAB= $row[TL_PENANGGUNG_JAWAB]!="" ? $row[TL_PENANGGUNG_JAWAB] : "";
			$TGL_LAHIR_PENANGGUNG_JAWAB= $row[TGL_LAHIR_PENANGGUNG_JAWAB]!="" ? $row[TGL_LAHIR_PENANGGUNG_JAWAB] : "";
			$ALAMAT_KTP= $row[ALAMAT_KTP]!="" ? $row[ALAMAT_KTP] : "";
			$KOTA_PENANGGUNG_JAWAB= $row[KOTA_PENANGGUNG_JAWAB]!="" ? $row[KOTA_PENANGGUNG_JAWAB] : "";
			$KODE_POS_PENANGGUNG_JAWAB= $row[KODE_POS_PENANGGUNG_JAWAB]!="" ? $row[KODE_POS_PENANGGUNG_JAWAB] : "";
			$TELP_PENANGGUNG_JAWAB= $row[TELP_PENANGGUNG_JAWAB]!="" ? $row[TELP_PENANGGUNG_JAWAB] : "";
			$TELP_PERUSAHAAN= $row[TELP_PERUSAHAAN]!="" ? $row[TELP_PERUSAHAAN] : "";
			$FAX_PERUSAHAAN= $row[FAX_PERUSAHAAN]!="" ? $row[FAX_PERUSAHAAN] : "";
			$ALAMAT_KANTOR_PJ= $row[ALAMAT_KANTOR_PJ]!="" ? $row[ALAMAT_KANTOR_PJ] : "";
			$KOTA_KANTOR_PJ= $row[KOTA_KANTOR_PJ]!="" ? $row[KOTA_KANTOR_PJ] : "";
			$KODE_POS_KANTOR_PJ= $row[KODE_POS_KANTOR_PJ]!="" ? $row[KODE_POS_KANTOR_PJ] : "";
			$TELP_KANTOR_PJ= $row[TELP_KANTOR_PJ]!="" ? $row[TELP_KANTOR_PJ] : "";
			$EMAIL_KANTOR_PJ= $row[EMAIL_KANTOR_PJ]!="" ? $row[EMAIL_KANTOR_PJ] : "";
			$NO_KTP_PJ= $row[NO_KTP_PJ]!="" ? $row[NO_KTP_PJ] : "";
			$NO_SIM_PJ= $row[NO_SIM_PJ]!="" ? $row[NO_SIM_PJ] : "";
			$NO_PASPOR_PJ= $row[NO_PASPOR_PJ]!="" ? $row[NO_PASPOR_PJ] : "";
			$NO_LAIN_PJ= $row[NO_LAIN_PJ]!="" ? $row[NO_LAIN_PJ] : "";
			$ALAMAT_PENAGIHAN= $row[ALAMAT_PENAGIHAN]!="" ? $row[ALAMAT_PENAGIHAN] : "";
			$JANGKA_WAKTU= $row[JANGKA_WAKTU]!="" ? $row[JANGKA_WAKTU] : "";
			$LAMP_KTP= $row[LAMP_KTP]!="" ? $row[LAMP_KTP] : "";
			$LAMP_SIM= $row[LAMP_SIM]!="" ? $row[LAMP_SIM] : "";
			$LAMP_PASPOR= $row[LAMP_PASPOR]!="" ? $row[LAMP_PASPOR] : "";
			$LAMP_LAIN= $row[LAMP_LAIN]!="" ? $row[LAMP_LAIN] : "";
			$AGAMA= $row[AGAMA]!="" ? $row[AGAMA] : "";
			$JENIS_KELAMIN= $row[JENIS_KELAMIN]!="" ? $row[JENIS_KELAMIN] : "";
			$JASA_KAPAL= $row[JASA_KAPAL]!="" ? $row[JASA_KAPAL] : "";
			$JASA_BARANG= $row[JASA_BARANG]!="" ? $row[JASA_BARANG] : "";
			$JASA_RUPA= $row[JASA_RUPA]!="" ? $row[JASA_RUPA] : "";
			$JASA_LAIN= $row[JASA_LAIN]!="" ? $row[JASA_LAIN] : "";
			$KD_CABANG= $row[KD_CABANG]!="" ? $row[KD_CABANG] : "";
			$STATUS_PELANGGAN= $row[STATUS_PELANGGAN]!="" ? $row[STATUS_PELANGGAN] : "";
			$NO_NPWP= $row[NO_NPWP]!="" ? $row[NO_NPWP] : "";
			$CMS_FLAG= $row[CMS_FLAG]!="" ? $row[CMS_FLAG] : "";
			$CREATED_DATE= $row[CREATED_DATE]!="" ? $row[CREATED_DATE] : "";
			$CREATED_BY= $row[CREATED_BY]!="" ? $row[CREATED_BY] : "";
			$UPDATE_DATE= $row[UPDATE_DATE]!="" ? $row[UPDATE_DATE] : "";
			$UPDATED_BY= $row[UPDATED_BY]!="" ? $row[UPDATED_BY] : "";
			$IS_IN_VIEW= $row[IS_IN_VIEW]!="" ? $row[IS_IN_VIEW] : "";
			$KODE_PROSES= $row[KODE_PROSES]!="" ? $row[KODE_PROSES] : "";
			$KD_AGEN= $row[KD_AGEN]!="" ? $row[KD_AGEN] : "";
			$KD_PBM= $row[KD_PBM]!="" ? $row[KD_PBM] : "";
			$NEGARA= $row[NEGARA]!="" ? $row[NEGARA] : "";
			$KD_PPN_AGEN= $row[KD_PPN_AGEN]!="" ? $row[KD_PPN_AGEN] : "";
			$KD_THREE_PARTIED= $row[KD_THREE_PARTIED]!="" ? $row[KD_THREE_PARTIED] : "";
			$KD_GUDANG1= $row[KD_GUDANG1]!="" ? $row[KD_GUDANG1] : "";
			$KD_GUDANG2= $row[KD_GUDANG2]!="" ? $row[KD_GUDANG2] : "";
			$BENDERA= $row[BENDERA]!="" ? $row[BENDERA] : "";
			$NM_SINGKAT= $row[NM_SINGKAT]!="" ? $row[NM_SINGKAT] : "";
			$MS_BERLAKU_KTP= $row[MS_BERLAKU_KTP]!="" ? $row[MS_BERLAKU_KTP] : "";
			$MS_BERLAKU_SIM= $row[MS_BERLAKU_SIM]!="" ? $row[MS_BERLAKU_SIM] : "";
			$MS_BERLAKU_PASPOR= $row[MS_BERLAKU_PASPOR]!="" ? $row[MS_BERLAKU_PASPOR] : "";
			$MS_BERLAKU_LAIN= $row[MS_BERLAKU_LAIN]!="" ? $row[MS_BERLAKU_LAIN] : "";
			$PELANGGAN_AKTIF= $row[PELANGGAN_AKTIF]!="" ? $row[PELANGGAN_AKTIF] : "";
			$STATUS_IU= $row[STATUS_IU]!="" ? $row[STATUS_IU] : "";
			$STATUS_SIMKEU= $row[STATUS_SIMKEU]!="" ? $row[STATUS_SIMKEU] : "";
			$ERROR_MESSAGE_SIMKEU= $row[ERROR_MESSAGE_SIMKEU]!="" ? $row[ERROR_MESSAGE_SIMKEU] : "";
			$STATUS_SIMKAPAL= $row[STATUS_SIMKAPAL]!="" ? $row[STATUS_SIMKAPAL] : "";
			$ERROR_MESSAGE_SIMKAPAL= $row[ERROR_MESSAGE_SIMKAPAL]!="" ? $row[ERROR_MESSAGE_SIMKAPAL] : "";
			$INSERT_UPDATE_FLAG= $row[INSERT_UPDATE_FLAG]!="" ? $row[INSERT_UPDATE_FLAG] : "";

			//ambil data dari mst_customer ibis (untuk update ke simkeu)
			$sql_get_customer_data2 = "select * from mst_customer where customer_id = '$id' and rownum = 1 order by create_date desc";
			if(!checkOriSQL($conn['ori']['ibis'],$sql_get_customer_data2,$query_get_customer_data2,$err)) goto Err;
			
			$row2 = oci_fetch_array($query_get_customer_data2, OCI_ASSOC);
			
			$NAME= $row2[ALT_NAME]!="" ? $row2[ALT_NAME] : "";//MENGUNAKAN NAMA DARI FAKTUR PAJAK
			//$NAME= $row2[NAME]!="" ? $row2[NAME] : "";
			$CUSTOMER_ID= $row2[CUSTOMER_ID]!="" ? $row2[CUSTOMER_ID] : "";
			$CUSTOMER_STATUS= "A";//A=ACTIVE,I=INACTIVE
			$ADDRESS= $row2[ADDRESS]!="" ? $row2[ADDRESS] : "";
			$CITY= $row2[CITY]!="" ? $row2[CITY] : "";
			$SITE_USE_CODE= "BILL_TO";
			$PRIMARY_SITE_USE_FLAG= "Y";
			$COUNTRY= "ID";
			$CUSTOMER_TYPE= "R";
			$CUSTOMER_CLASS_CODE= $KELOMPOK_PELANGGAN;
			$CUSTOMER_TAX_REFERENCE= $row2[NPWP]!="" ? $row2[NPWP] : "";
			$EMAIL_ADDRESS= $row2[EMAIL]!="" ? $row2[EMAIL] : "";
			
			//CREATE SET FOR UPDATE TO SIMKAPAL
			$set="";
			if($NAMA_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";
				if($KD_CABANG=="1582")//JAI
					$set .= "NAMA_PERUSAHAAN = '$NAME'";
				else 
					$set .= "NAMA_PERUSAHAAN = '$NAMA_PERUSAHAAN'";
			}
			
			if($KD_CABANG=="1582")//JAI
			{
				if($NAMA_PERUSAHAAN_FIX!="")
				{
					if($set!="") $set .= ",";
					$set .= "NAMA_PELANGGAN_FIX = '$NAMA_PERUSAHAAN_FIX'";
				}
			}
			
			if($KELOMPOK_PELANGGAN!="")
			{
				if($set!="") $set .= ",";
				$set .= "KELOMPOK_PELANGGAN = '$KELOMPOK_PELANGGAN'";
			}
			if($ALAMAT_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";
				$set .= "ALAMAT_PERUSAHAAN = '$ALAMAT_PERUSAHAAN'";
			}
			if($KOTA_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KOTA_PERUSAHAAN = '$KOTA_PERUSAHAAN'";
			}
			if($KODE_POS_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KODE_POS_PERUSAHAAN = '$KODE_POS_PERUSAHAAN'";
			}
			if($EMAIL_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "EMAIL_PERUSAHAAN = '$EMAIL_PERUSAHAAN'";
			}
			if($BIDANG_USAHA!="")
			{
				if($set!="") $set .= ",";		
				$set .= "BIDANG_USAHA = '$BIDANG_USAHA'";
			}
			
				if($KD_CABANG=="1582")
				{
					$GRUP_USAHA="";
				}
				
			if($GRUP_USAHA!="")
			{
				if($set!="") $set .= ",";		
				$set .= "GRUP_USAHA = '$GRUP_USAHA'";
			}
			
			if($TINGKAT_ORGANISASI!="")
			{
				if($set!="") $set .= ",";		
				$set .= "TINGKAT_ORGANISASI = '$TINGKAT_ORGANISASI'";
			}
			if($NAMA_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NAMA_PENANGGUNG_JAWAB = '$NAMA_PENANGGUNG_JAWAB'";
			}
			if($JABATAN_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "JABATAN_PENANGGUNG_JAWAB = '$JABATAN_PENANGGUNG_JAWAB'";
			}
			
				if($KD_CABANG=="1582")//JAI
				{
					$TL_PENANGGUNG_JAWAB="";
				}
				
			if($TL_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "TL_PENANGGUNG_JAWAB = '$TL_PENANGGUNG_JAWAB'";
			}
			if($TGL_LAHIR_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "TGL_LAHIR_PENANGGUNG_JAWAB = '$TGL_LAHIR_PENANGGUNG_JAWAB'";
			}
			if($ALAMAT_KTP!="")
			{
				if($set!="") $set .= ",";		
				$set .= "ALAMAT_KTP = '$ALAMAT_KTP'";
			}
			if($KOTA_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KOTA_PENANGGUNG_JAWAB = '$KOTA_PENANGGUNG_JAWAB'";
			}
			if($KODE_POS_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KODE_POS_PENANGGUNG_JAWAB = '$KODE_POS_PENANGGUNG_JAWAB'";
			}
			if($TELP_PENANGGUNG_JAWAB!="")
			{
				if($set!="") $set .= ",";		
				$set .= "TELP_PENANGGUNG_JAWAB = '$TELP_PENANGGUNG_JAWAB'";
			}
			if($TELP_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "TELP_PERUSAHAAN = '$TELP_PERUSAHAAN'";
			}
			if($FAX_PERUSAHAAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "FAX_PERUSAHAAN = '$FAX_PERUSAHAAN'";
			}
			if($ALAMAT_KANTOR_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "ALAMAT_KANTOR_PJ = '$ALAMAT_KANTOR_PJ'";
			}
			if($KOTA_KANTOR_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KOTA_KANTOR_PJ = '$KOTA_KANTOR_PJ'";
			}
			if($KODE_POS_KANTOR_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KODE_POS_KANTOR_PJ = '$KODE_POS_KANTOR_PJ'";
			}
			if($TELP_KANTOR_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "TELP_KANTOR_PJ = '$TELP_KANTOR_PJ'";
			}
			if($EMAIL_KANTOR_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "EMAIL_KANTOR_PJ = '$EMAIL_KANTOR_PJ'";
			}
			if($NO_KTP_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NO_KTP_PJ = '$NO_KTP_PJ'";
			}
			if($NO_SIM_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NO_SIM_PJ = '$NO_SIM_PJ'";
			}
			if($NO_PASPOR_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NO_PASPOR_PJ = '$NO_PASPOR_PJ'";
			}
			if($NO_LAIN_PJ!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NO_LAIN_PJ = '$NO_LAIN_PJ'";
			}
			if($ALAMAT_PENAGIHAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "ALAMAT_PENAGIHAN = '$ALAMAT_PENAGIHAN'";
			}
			if($JANGKA_WAKTU!="")
			{
				if($set!="") $set .= ",";		
				$set .= "JANGKA_WAKTU = '$JANGKA_WAKTU'";
			}
			if($LAMP_KTP!="")
			{
				if($set!="") $set .= ",";		
				$set .= "LAMP_KTP = '$LAMP_KTP'";
			}
			if($LAMP_SIM!="")
			{
				if($set!="") $set .= ",";		
				$set .= "LAMP_SIM = '$LAMP_SIM'";
			}
			if($LAMP_PASPOR!="")
			{
				if($set!="") $set .= ",";		
				$set .= "LAMP_PASPOR = '$LAMP_PASPOR'";
			}
			if($LAMP_LAIN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "LAMP_LAIN = '$LAMP_LAIN'";
			}
			if($AGAMA!="")
			{
				if($set!="") $set .= ",";		
				$set .= "AGAMA = '$AGAMA'";
			}
			if($JENIS_KELAMIN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "JENIS_KELAMIN = '$JENIS_KELAMIN'";
			}
			
				if($KD_CABANG=="1582")//JAI
				{
					$JASA_KAPAL="";
				}
				
			if($JASA_KAPAL!="")
			{
				if($set!="") $set .= ",";		
				$set .= "JASA_KAPAL = '$JASA_KAPAL'";
			}
			
				if($KD_CABANG=="1582")//JAI
				{
					$JASA_BARANG="";
				}
				
			if($JASA_BARANG!="")
			{				
				if($set!="") $set .= ",";		
				$set .= "JASA_BARANG = '$JASA_BARANG'";
			}
			
				if($KD_CABANG=="1582")//JAI
				{
					$JASA_RUPA="";
				}
				
			if($JASA_RUPA!="")
			{
				if($set!="") $set .= ",";		
				$set .= "JASA_RUPA = '$JASA_RUPA'";
			}
			
				if($KD_CABANG=="1582")
				{
					$JASA_LAIN="";
				}
				
			if($JASA_LAIN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "JASA_LAIN = '$JASA_LAIN'";
			}

				if($KD_CABANG=="1582")
				{
					$KD_CABANG_OLD = $KD_CABANG;
					$KD_CABANG="00";
				}
				
			if($KD_CABANG!="")
			{				
				if($set!="") $set .= ",";		
				$set .= "KD_CABANG = '$KD_CABANG'";
			}
			
			if($STATUS_PELANGGAN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "STATUS_PELANGGAN = '$STATUS_PELANGGAN'";
			}
			if($NO_NPWP!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NO_NPWP = '$NO_NPWP'";
			}
			if($CMS_FLAG!="")
			{
				if($set!="") $set .= ",";		
				$set .= "CMS_FLAG = '$CMS_FLAG'";
			}
			if($UPDATE_DATE!="")
			{
				if($set!="") $set .= ",";		
				$set .= "UPDATE_DATE = '$UPDATE_DATE'";
			}
			if($UPDATED_BY!="")
			{
				if($set!="") $set .= ",";		
				$set .= "UPDATED_BY = '$UPDATED_BY'";
			}
			if($IS_IN_VIEW!="")
			{
				if($set!="") $set .= ",";		
				$set .= "IS_IN_VIEW = '$IS_IN_VIEW'";
			}
			if($KODE_PROSES!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KODE_PROSES = '$KODE_PROSES'";
			}
			if($KD_AGEN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KD_AGEN = '$KD_AGEN'";
			}
			if($KD_PBM!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KD_PBM = '$KD_PBM'";
			}
			if($NEGARA!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NEGARA = '$NEGARA'";
			}
			if($KD_PPN_AGEN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KD_PPN_AGEN = '$KD_PPN_AGEN'";
			}
			if($KD_THREE_PARTIED!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KD_THREE_PARTIED = '$KD_THREE_PARTIED'";
			}
			if($KD_GUDANG1!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KD_GUDANG1 = '$KD_GUDANG1'";
			}
			if($KD_GUDANG2!="")
			{
				if($set!="") $set .= ",";		
				$set .= "KD_GUDANG2 = '$KD_GUDANG2'";
			}
			if($BENDERA!="")
			{
				if($set!="") $set .= ",";		
				$set .= "BENDERA = '$BENDERA'";
			}
			if($NM_SINGKAT!="")
			{
				if($set!="") $set .= ",";		
				$set .= "NM_SINGKAT = '$NM_SINGKAT'";
			}
			if($MS_BERLAKU_KTP!="")
			{
				if($set!="") $set .= ",";		
				$set .= "MS_BERLAKU_KTP = '$MS_BERLAKU_KTP'";
			}
			if($MS_BERLAKU_SIM!="")
			{
				if($set!="") $set .= ",";		
				$set .= "MS_BERLAKU_SIM = '$MS_BERLAKU_SIM'";
			}
			if($MS_BERLAKU_PASPOR!="")
			{
				if($set!="") $set .= ",";		
				$set .= "MS_BERLAKU_PASPOR = '$MS_BERLAKU_PASPOR'";
			}
			if($MS_BERLAKU_LAIN!="")
			{
				if($set!="") $set .= ",";		
				$set .= "MS_BERLAKU_LAIN = '$MS_BERLAKU_LAIN'";
			}
			if($PELANGGAN_AKTIF)
			{
				if($set!="") $set .= ",";		
				$set .= "PELANGGAN_AKTIF = '$PELANGGAN_AKTIF'";
			}
			
			//jaga koneksi
			commitOriDb($conn['ori']);
			
			//loop org id
			//$org_id_arr = array("1822","1823","1824","1825","1826");
			$org_id_arr = array("2782");
			$error_acc = "";
			
			foreach ($org_id_arr as $ORG_ID)
			{
				//update to simkeu
				$sql_populate_customer_billing = "
							BEGIN 
								apps.xpi2_ar_eservice_customer_pkg.populate_customer_billing(
									:in_org_id, 
									:in_customer_name, 
									:in_customer_number, 
									:in_customer_status, 
									:in_address1, 
									:in_city, 
									:in_site_use_code, 
									:in_primary_site_use_flag, 
									:in_country, 
									:in_customer_type, 
									:in_customer_class_code,
									:in_cust_tax_reference, 
									:in_email_address,
									:in_insert_update,
									:out_status,
									:out_message
								);
							 END;";

				$stid = oci_parse($conn['ori']['simkeu'], $sql_populate_customer_billing) or die ('Can not parse query');

				/*if($ORG_ID=="1822"||$ORG_ID=="1825"||$ORG_ID=="1826")
				{
					$INSERT_UPDATE_FLAG="I";
				}
				else
				{
					$INSERT_UPDATE_FLAG="U";
				}*/
				
				oci_bind_by_name($stid, "in_org_id", &$ORG_ID,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_customer_name", &$NAME,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_customer_number", &$CUSTOMER_ID,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_customer_status", &$CUSTOMER_STATUS,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_address1", &$ADDRESS,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_city", &$CITY,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_site_use_code", &$SITE_USE_CODE,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_primary_site_use_flag", &$PRIMARY_SITE_USE_FLAG,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_country", &$COUNTRY,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_customer_type", &$CUSTOMER_TYPE,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_customer_class_code", &$CUSTOMER_CLASS_CODE,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_cust_tax_reference", &$CUSTOMER_TAX_REFERENCE,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_email_address", &$EMAIL_ADDRESS,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "in_insert_update", &$INSERT_UPDATE_FLAG,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "out_status", &$out_status,1000) or die ('Can not bind variable');
				oci_bind_by_name($stid, "out_message", &$out_message,1000) or die ('Can not bind variable');
				
				//$out_status="S";
				if (!oci_execute($stid)) {
				//if (false) {
					$e = oci_error($stid);
					
					$err = $e[message];
					
					$data['update_to_simkeu'] = "F";
					$data['message_to_simkeu'] = $err;

					$error = true;
				}
				else
				{
					$inv_char 	= array("'","\"");
					$fix_char	= array("''"," ");
					$out_message = str_replace($inv_char,$fix_char,$out_message);
					$error_acc .= $out_message.",";
					
					if($out_status=="F")
					{
						//update ke ibis bahwa update ke simkeu gagal
						$sql_update_customer_data2 = "update mst_pelanggan_skapal set status_iu = 'F', status_simkeu = 'F', error_message_simkeu = '$out_message' 
														where kd_pelanggan = '$id' and status_iu = 'P'";
						if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;
						
						$sql_update_customer_data2 = "update mst_agen_skapal set insert_update_flag = 'F' 
														where no_account = '$id' and insert_update_flag = 'P'";
						if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;
						
						$data['update_to_simkeu'] = "F";
						$data['message_to_simkeu'] = $error_acc;
						$out_data['respons']=$data;
						$error = true;
					}
					else if($out_status=="S")
					{			
						//update ke ibis bahwa update ke simkeu berhasil
						$sql_update_customer_data2 = "update mst_pelanggan_skapal set status_simkeu = 'S', error_message_simkeu = '$out_message' 
														where kd_pelanggan = '$id' and status_iu = 'P'";
						if(!checkOriSQLAutoCommit($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;

						$data['update_to_simkeu'] = "S";
						$data['message_to_simkeu'] = "SUCCESS";
						$out_data['respons']=$data;
						
						$sql_get_jumlah_pelanggan_kapal = "select count(*) as jumlah_pelanggan_kapal from mst_pelanggan where kd_pelanggan = '$id'";
						
						//QUERY
						if(!checkOriSQL($conn['ori']['kapal'],$sql_get_jumlah_pelanggan_kapal,$query_get_jumlah_pelanggan_kapal,$err)) goto Err;
						
						$row_jumlah_pelanggan_kapal = oci_fetch_array($query_get_jumlah_pelanggan_kapal, OCI_ASSOC);
						
						if($row_jumlah_pelanggan_kapal[JUMLAH_PELANGGAN_KAPAL]==0)
						{
							//insert ke sim kapal
							//insert ke master pelanggan
							if($KD_CABANG_OLD=="1582")
							{
								$sql_update_kapal = "INSERT INTO mst_pelanggan 
													(	
														ORG_ID,
														KD_PELANGGAN,
														NAMA_PERUSAHAAN,
														KELOMPOK_PELANGGAN,
														ALAMAT_PERUSAHAAN,
														KOTA_PERUSAHAAN,
														KODE_POS_PERUSAHAAN,
														EMAIL_PERUSAHAAN,
														BIDANG_USAHA,
														TINGKAT_ORGANISASI,
														NAMA_PENANGGUNG_JAWAB,
														JABATAN_PENANGGUNG_JAWAB,
														TGL_LAHIR_PENANGGUNG_JAWAB,
														ALAMAT_KTP,
														KOTA_PENANGGUNG_JAWAB,
														KODE_POS_PENANGGUNG_JAWAB,
														TELP_PENANGGUNG_JAWAB,
														TELP_PERUSAHAAN,
														FAX_PERUSAHAAN,
														ALAMAT_KANTOR_PJ,
														KOTA_KANTOR_PJ,
														KODE_POS_KANTOR_PJ,
														TELP_KANTOR_PJ,
														EMAIL_KANTOR_PJ,
														NO_KTP_PJ,
														NO_SIM_PJ,
														NO_PASPOR_PJ,
														ALAMAT_PENAGIHAN,
														AGAMA,
														JENIS_KELAMIN,
														KD_CABANG,
														STATUS_PELANGGAN,
														NO_NPWP,
														CMS_FLAG,
														CREATED_DATE,
														CREATED_BY,
														UPDATE_DATE,
														UPDATED_BY,
														IS_IN_VIEW,
														KODE_PROSES,
														KD_AGEN,
														KD_PBM,
														NEGARA,
														KD_PPN_AGEN,
														KD_THREE_PARTIED,
														BENDERA,
														NM_SINGKAT,
														MS_BERLAKU_KTP,
														MS_BERLAKU_SIM,
														MS_BERLAKU_PASPOR,
														MS_BERLAKU_LAIN,
														PELANGGAN_AKTIF,
														STATUS_IU,
														STATUS_SIMKEU,
														ERROR_MESSAGE,
														NAMA_PELANGGAN_FIX)
													VALUES
													(	
														'$ORG_ID_SIMOP',
														'$KD_PELANGGAN',
														'$NAME',
														'$KELOMPOK_PELANGGAN',
														'$ALAMAT_PERUSAHAAN',
														'$KOTA_PERUSAHAAN',
														'$KODE_POS_PERUSAHAAN',
														'$EMAIL_PERUSAHAAN',
														'$BIDANG_USAHA',
														'$TINGKAT_ORGANISASI',
														'$NAMA_PENANGGUNG_JAWAB',
														'$JABATAN_PENANGGUNG_JAWAB',
														'$TGL_LAHIR_PENANGGUNG_JAWAB',
														'$ALAMAT_KTP',
														'$KOTA_PENANGGUNG_JAWAB',
														'$KODE_POS_PENANGGUNG_JAWAB',
														'$TELP_PENANGGUNG_JAWAB',
														'$TELP_PERUSAHAAN',
														'$FAX_PERUSAHAAN',
														'$ALAMAT_KANTOR_PJ',
														'$KOTA_KANTOR_PJ',
														'$KODE_POS_KANTOR_PJ',
														'$$TELP_KANTOR_PJ',
														'$EMAIL_KANTOR_PJ',
														'$NO_KTP_PJ',
														'$NO_SIM_PJ',
														'$NO_PASPOR_PJ',
														'$ALAMAT_PENAGIHAN',
														'$AGAMA',
														'$JENIS_KELAMIN',
														'$KD_CABANG',
														'$STATUS_PELANGGAN',
														'$NO_NPWP',
														'$CMS_FLAG',
														'$CREATED_DATE',
														'CDM',
														'$UPDATE_DATE',
														'$UPDATED_BY',
														'$IS_IN_VIEW',
														'$KODE_PROSES',
														'$KD_AGEN',
														'$KD_PBM',
														'$NEGARA',
														'$KD_PPN_AGEN',
														'$KD_THREE_PARTIED',
														'$BENDERA',
														'$NM_SINGKAT',
														'$MS_BERLAKU_KTP',
														'$MS_BERLAKU_SIM',
														'$MS_BERLAKU_PASPOR',
														'$MS_BERLAKU_LAIN',
														'$PELANGGAN_AKTIF',
														'$STATUS_IU',
														'$out_status',
														'$out_message',
														'$NAMA_PERUSAHAAN_FIX')";
							}
							else 
							{
								$sql_update_kapal = "INSERT INTO mst_pelanggan 
																(	KD_PELANGGAN,
																	NAMA_PERUSAHAAN,
																	KELOMPOK_PELANGGAN,
																	ALAMAT_PERUSAHAAN,
																	KOTA_PERUSAHAAN,
																	KODE_POS_PERUSAHAAN,
																	EMAIL_PERUSAHAAN,
																	BIDANG_USAHA,
																	GRUP_USAHA,
																	TINGKAT_ORGANISASI,
																	NAMA_PENANGGUNG_JAWAB,
																	JABATAN_PENANGGUNG_JAWAB,
																	TL_PENANGGUNG_JAWAB,
																	TGL_LAHIR_PENANGGUNG_JAWAB,
																	ALAMAT_KTP,
																	KOTA_PENANGGUNG_JAWAB,
																	KODE_POS_PENANGGUNG_JAWAB,
																	TELP_PENANGGUNG_JAWAB,
																	TELP_PERUSAHAAN,
																	FAX_PERUSAHAAN,
																	ALAMAT_KANTOR_PJ,
																	KOTA_KANTOR_PJ,
																	KODE_POS_KANTOR_PJ,
																	TELP_KANTOR_PJ,
																	EMAIL_KANTOR_PJ,
																	NO_KTP_PJ,
																	NO_SIM_PJ,
																	NO_PASPOR_PJ,
																	NO_LAIN_PJ,
																	ALAMAT_PENAGIHAN,
																	JANGKA_WAKTU,
																	LAMP_KTP,
																	LAMP_SIM,
																	LAMP_PASPOR,
																	LAMP_LAIN,
																	AGAMA,
																	JENIS_KELAMIN,
																	JASA_KAPAL,
																	JASA_BARANG,
																	JASA_RUPA,
																	JASA_LAIN,
																	KD_CABANG,
																	STATUS_PELANGGAN,
																	NO_NPWP,
																	CMS_FLAG,
																	CREATED_DATE,
																	CREATED_BY,
																	UPDATE_DATE,
																	UPDATED_BY,
																	IS_IN_VIEW,
																	KODE_PROSES,
																	KD_AGEN,
																	KD_PBM,
																	NEGARA,
																	KD_PPN_AGEN,
																	KD_THREE_PARTIED,
																	KD_GUDANG1,
																	KD_GUDANG2,
																	BENDERA,
																	NM_SINGKAT,
																	MS_BERLAKU_KTP,
																	MS_BERLAKU_SIM,
																	MS_BERLAKU_PASPOR,
																	MS_BERLAKU_LAIN,
																	PELANGGAN_AKTIF,
																	STATUS_IU,
																	STATUS_SIMKEU,
																	ERROR_MESSAGE)
																VALUES
																(	'$KD_PELANGGAN',
																	'$NAMA_PERUSAHAAN',
																	'$KELOMPOK_PELANGGAN',
																	'$ALAMAT_PERUSAHAAN',
																	'$KOTA_PERUSAHAAN',
																	'$KODE_POS_PERUSAHAAN',
																	'$EMAIL_PERUSAHAAN',
																	'$BIDANG_USAHA',
																	'$GRUP_USAHA',
																	'$TINGKAT_ORGANISASI',
																	'$NAMA_PENANGGUNG_JAWAB',
																	'$JABATAN_PENANGGUNG_JAWAB',
																	'$TL_PENANGGUNG_JAWAB',
																	'$TGL_LAHIR_PENANGGUNG_JAWAB',
																	'$ALAMAT_KTP',
																	'$KOTA_PENANGGUNG_JAWAB',
																	'$KODE_POS_PENANGGUNG_JAWAB',
																	'$TELP_PENANGGUNG_JAWAB',
																	'$TELP_PERUSAHAAN',
																	'$FAX_PERUSAHAAN',
																	'$ALAMAT_KANTOR_PJ',
																	'$KOTA_KANTOR_PJ',
																	'$KODE_POS_KANTOR_PJ',
																	'$TELP_KANTOR_PJ',
																	'$EMAIL_KANTOR_PJ',
																	'$NO_KTP_PJ',
																	'$NO_SIM_PJ',
																	'$NO_PASPOR_PJ',
																	'$NO_LAIN_PJ',
																	'$ALAMAT_PENAGIHAN',
																	'$JANGKA_WAKTU',
																	'$LAMP_KTP',
																	'$LAMP_SIM',
																	'$LAMP_PASPOR',
																	'$LAMP_LAIN',
																	'$AGAMA',
																	'$JENIS_KELAMIN',
																	'$JASA_KAPAL',
																	'$JASA_BARANG',
																	'$JASA_RUPA',
																	'$JASA_LAIN',
																	'$KD_CABANG',
																	'$STATUS_PELANGGAN',
																	'$NO_NPWP',
																	'$CMS_FLAG',
																	'$CREATED_DATE',
																	'CDM',
																	'$UPDATE_DATE',
																	'$UPDATED_BY',
																	'$IS_IN_VIEW',
																	'$KODE_PROSES',
																	'$KD_AGEN',
																	'$KD_PBM',
																	'$NEGARA',
																	'$KD_PPN_AGEN',
																	'$KD_THREE_PARTIED',
																	'$KD_GUDANG1',
																	'$KD_GUDANG2',
																	'$BENDERA',
																	'$NM_SINGKAT',
																	'$MS_BERLAKU_KTP',
																	'$MS_BERLAKU_SIM',
																	'$MS_BERLAKU_PASPOR',
																	'$MS_BERLAKU_LAIN',
																	'$PELANGGAN_AKTIF',
																	'$STATUS_IU',
																	'$out_status',
																	'$out_message')";
							}
							
							if(!checkOriSQLAutoCommit($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;
						}
						else 
						{
							//update ke sim kapal
							$sql_update_kapal = "UPDATE mst_pelanggan set $set where kd_pelanggan = '$id'";
						
							if(!checkOriSQL($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;
						}
						//update ke master agen
						$sql_get_customer_data3 = "select * from mst_agen_skapal where no_account = '$id' and insert_update_flag = 'P' order by date_insert asc";
						
						//QUERY
						if(!checkOriSQL($conn['ori']['ibis'],$sql_get_customer_data3,$query_get_customer_data3,$err)) goto Err;

						while($row3 = oci_fetch_array($query_get_customer_data3, OCI_ASSOC))
						{
							$KD_AGEN	= $row3[KD_AGEN]!="" ? $row3[KD_AGEN] : "";
							$KD_CABANG	= $row3[KD_CABANG]!="" ? $row3[KD_CABANG] : "";
							$NM_AGEN	= $row3[NM_AGEN]!="" ? $row3[NM_AGEN] : "";
							$NM_SINGKATAN	= $row3[NM_SINGKATAN]!="" ? $row3[NM_SINGKATAN] : "";
							$ALMT_AGEN	= $row3[ALMT_AGEN]!="" ? $row3[ALMT_AGEN] : "";
							$NO_TLP1	= $row3[NO_TLP1]!="" ? $row3[NO_TLP1] : "";
							$NO_TLP2	= $row3[NO_TLP2]!="" ? $row3[NO_TLP2] : "";
							$NO_TLP3	= $row3[NO_TLP3]!="" ? $row3[NO_TLP3] : "";
							$NO_ACCOUNT	= $row3[NO_ACCOUNT]!="" ? $row3[NO_ACCOUNT] : "";
							$NO_NPWP	= $row3[NO_NPWP]!="" ? $row3[NO_NPWP] : "";
							$KD_PPN_AGEN	= $row3[KD_PPN_AGEN]!="" ? $row3[KD_PPN_AGEN] : "";
							$KD_THREE_PARTIED	= $row3[KD_THREE_PARTIED]!="" ? $row3[KD_THREE_PARTIED] : "";
							$ALAMAT_EMAIL1	= $row3[ALAMAT_EMAIL1]!="" ? $row3[ALAMAT_EMAIL1] : "";
							$ALAMAT_EMAIL2	= $row3[ALAMAT_EMAIL2]!="" ? $row3[ALAMAT_EMAIL2] : "";
							$CATATAN	= $row3[CATATAN]!="" ? $row3[CATATAN] : "";
							$NO_SIUPAL	= $row3[NO_SIUPAL]!="" ? $row3[NO_SIUPAL] : "";
							$TGL_TERBIT_SIUPAL	= $row3[TGL_TERBIT_SIUPAL]!="" ? $row3[TGL_TERBIT_SIUPAL] : "";
							$TGL_BERLAKU_SIUPAL	= $row3[TGL_BERLAKU_SIUPAL]!="" ? $row3[TGL_BERLAKU_SIUPAL] : "";
							$NO_SIOPSUS	= $row3[NO_SIOPSUS]!="" ? $row3[NO_SIOPSUS] : "";
							$TGL_TERBIT_SIOPSUS	= $row3[TGL_TERBIT_SIOPSUS]!="" ? $row3[TGL_TERBIT_SIOPSUS] : "";
							$TGL_BERLAKU_SIOPSUS	= $row3[TGL_BERLAKU_SIOPSUS]!="" ? $row3[TGL_BERLAKU_SIOPSUS] : "";
							$PENANGGUNG_JAWAB	= $row3[PENANGGUNG_JAWAB]!="" ? $row3[PENANGGUNG_JAWAB] : "";
							$TGL_LAHIR	= $row3[TGL_LAHIR]!="" ? $row3[TGL_LAHIR] : "";
							$AGAMA	= $row3[AGAMA]!="" ? $row3[AGAMA] : "";
							$PETUGAS_OPERASIONAL	= $row3[PETUGAS_OPERASIONAL]!="" ? $row3[PETUGAS_OPERASIONAL] : "";
							$MS_BERLAKU_DOMISILI	= $row3[MS_BERLAKU_DOMISILI]!="" ? $row3[MS_BERLAKU_DOMISILI] : "";
							$MS_BERLAKU_ADPEL	= $row3[MS_BERLAKU_ADPEL]!="" ? $row3[MS_BERLAKU_ADPEL] : "";
							$MS_BERLAKU_KTP	= $row3[MS_BERLAKU_KTP]!="" ? $row3[MS_BERLAKU_KTP] : "";
							$SKPT	= $row3[SKPT]!="" ? $row3[SKPT] : "";
							$INSA	= $row3[INSA]!="" ? $row3[INSA] : "";
							$AKTE_PENDIRIAN	= $row3[AKTE_PENDIRIAN]!="" ? $row3[AKTE_PENDIRIAN] : "";
							$DAFTAR_PEMILIK_AKTE	= $row3[DAFTAR_PEMILIK_AKTE]!="" ? $row3[DAFTAR_PEMILIK_AKTE] : "";
							$REF_BANK	= $row3[REF_BANK]!="" ? $row3[REF_BANK] : "";
							$DAFTAR_KAPAL	= $row3[DAFTAR_KAPAL]!="" ? $row3[DAFTAR_KAPAL] : "";
							$ALM_KANTOR_PUSAT	= $row3[ALM_KANTOR_PUSAT]!="" ? $row3[ALM_KANTOR_PUSAT] : "";
							$ALM_KANTOR_CAB	= $row3[ALM_KANTOR_CAB]!="" ? $row3[ALM_KANTOR_CAB] : "";
							$SI_ADPEL	= $row3[SI_ADPEL]!="" ? $row3[SI_ADPEL] : "";
							$DOMISLI_TERAKHIR	= $row3[DOMISLI_TERAKHIR]!="" ? $row3[DOMISLI_TERAKHIR] : "";
							$KTP_PJWB	= $row3[KTP_PJWB]!="" ? $row3[KTP_PJWB] : "";
							$REGUL_CEKPHIS	= $row3[REGUL_CEKPHIS]!="" ? $row3[REGUL_CEKPHIS] : "";
							$WEBSITE	= $row3[WEBSITE]!="" ? $row3[WEBSITE] : "";
							$IS_PERTAMINA	= $row3[IS_PERTAMINA]!="" ? $row3[IS_PERTAMINA] : "";
							$TGL_JAM_ENTRY	= $row3[TGL_JAM_ENTRY]!="" ? $row3[TGL_JAM_ENTRY] : "";
							//newjai
							$SKTD_DIBERIKAN		= $row3[SKTD_DIBERIKAN]!="" ? $row3[SKTD_DIBERIKAN] : "";
							$SKTD_CREATED_DATE	= $row3[SKTD_CREATED_DATE]!="" ? $row3[SKTD_CREATED_DATE] : "";
							$SKTD_NUMBER		= $row3[SKTD_NUMBER]!="" ? $row3[SKTD_NUMBER] : "";
							$SKTD_START			= $row3[SKTD_START]!="" ? $row3[SKTD_START] : "";
							$SKTD_END			= $row3[SKTD_END]!="" ? $row3[SKTD_END] : "";

							//CREATE SET FOR UPDATE TO SIMKAPAL
							$set_agen="";
							if($KD_AGEN!="")
							{
								//if($set!="") $set_agen .= ",";		
								//$set_agen .= "KD_AGEN = '$KD_AGEN'";
							}
							if($KD_CABANG!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "KD_CABANG = '$KD_CABANG'";
							}
							if($NM_AGEN!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NM_AGEN = '$NM_AGEN'";
							}
							if($NM_SINGKATAN!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NM_SINGKATAN = '$NM_SINGKATAN'";
							}
							if($ALMT_AGEN!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "ALMT_AGEN = '$ALMT_AGEN'";
							}
							if($NO_TLP1!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_TLP1 = '$NO_TLP1'";
							}
							if($NO_TLP2!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_TLP2 = '$NO_TLP2'";
							}
							if($NO_TLP3!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_TLP3 = '$NO_TLP3'";
							}
							if($NO_ACCOUNT!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_ACCOUNT = '$NO_ACCOUNT'";
							}
							if($NO_NPWP!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_NPWP = '$NO_NPWP'";
							}
							if($KD_PPN_AGEN!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "KD_PPN_AGEN = '$KD_PPN_AGEN'";
							}
							if($KD_THREE_PARTIED!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "KD_THREE_PARTIED = '$KD_THREE_PARTIED'";
							}
							if($ALAMAT_EMAIL1!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "ALAMAT_EMAIL1 = '$ALAMAT_EMAIL1'";
							}
							if(ALAMAT_EMAIL2)
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "ALAMAT_EMAIL2 = '$ALAMAT_EMAIL2'";
							}
							if($CATATAN!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "CATATAN = '$CATATAN'";
							}
							if($NO_SIUPAL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_SIUPAL = '$NO_SIUPAL'";
							}
							if($TGL_TERBIT_SIUPAL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "TGL_TERBIT_SIUPAL = '$TGL_TERBIT_SIUPAL'";
							}
							if($TGL_BERLAKU_SIUPAL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "TGL_BERLAKU_SIUPAL = '$TGL_BERLAKU_SIUPAL'";
							}
							if($NO_SIOPSUS!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "NO_SIOPSUS = '$NO_SIOPSUS'";
							}
							if($TGL_TERBIT_SIOPSUS!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "TGL_TERBIT_SIOPSUS = '$TGL_TERBIT_SIOPSUS'";
							}
							if($TGL_BERLAKU_SIOPSUS!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "TGL_BERLAKU_SIOPSUS = '$TGL_BERLAKU_SIOPSUS'";
							}
							if($PENANGGUNG_JAWAB!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "PENANGGUNG_JAWAB = '$PENANGGUNG_JAWAB'";
							}
							if($TGL_LAHIR!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "TGL_LAHIR = '$TGL_LAHIR'";
							}
							if($AGAMA!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "AGAMA = '$AGAMA'";
							}
							if($PETUGAS_OPERASIONAL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "PETUGAS_OPERASIONAL = '$PETUGAS_OPERASIONAL'";
							}
							if($MS_BERLAKU_DOMISILI!="") 
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "MS_BERLAKU_DOMISILI = '$MS_BERLAKU_DOMISILI'";
							}
							if($MS_BERLAKU_ADPEL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "MS_BERLAKU_ADPEL = '$MS_BERLAKU_ADPEL'";
							}
							if($MS_BERLAKU_KTP!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "MS_BERLAKU_KTP = '$MS_BERLAKU_KTP'";
							}
							if($SKPT!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "SKPT = '$SKPT'";
							}
							if($INSA!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "INSA = '$INSA'";
							}
							if($AKTE_PENDIRIAN!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "AKTE_PENDIRIAN = '$AKTE_PENDIRIAN'";
							}
							if($DAFTAR_PEMILIK_AKTE!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "DAFTAR_PEMILIK_AKTE = '$DAFTAR_PEMILIK_AKTE'";
							}
							if($REF_BANK!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "REF_BANK = '$REF_BANK'";
							}
							if($DAFTAR_KAPAL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "DAFTAR_KAPAL = '$DAFTAR_KAPAL'";
							}
							if($ALM_KANTOR_PUSAT!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "ALM_KANTOR_PUSAT = '$ALM_KANTOR_PUSAT'";
							}
							if($ALM_KANTOR_CAB!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "ALM_KANTOR_CAB = '$ALM_KANTOR_CAB'";
							}
							if($SI_ADPEL!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "SI_ADPEL = '$SI_ADPEL'";
							}
							if($DOMISLI_TERAKHIR!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "DOMISLI_TERAKHIR = '$DOMISLI_TERAKHIR'";
							}
							if($KTP_PJWB!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "KTP_PJWB = '$KTP_PJWB'";
							}
							if($REGUL_CEKPHIS!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "REGUL_CEKPHIS = '$REGUL_CEKPHIS'";
							}
							if($WEBSITE!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "WEBSITE = '$WEBSITE'";
							}
							if($IS_PERTAMINA!="")
							{
								if($set_agen!="") $set_agen .= ",";		
								$set_agen .= "IS_PERTAMINA = '$IS_PERTAMINA'";
							}
							if($TGL_JAM_ENTRY!="")
							{
								if($set_agen!="") $set_agen .= ",";
								$set_agen .= "TGL_JAM_ENTRY = '$TGL_JAM_ENTRY'";
							}
							//new jai
							if($SKTD_DIBERIKAN!="")
							{
								if($set_agen!="") $set_agen .= ",";
								$set_agen .= "SKTD_DIBERIKAN = '$SKTD_DIBERIKAN'";
							}
							if($SKTD_CREATED_DATE!="")
							{
								if($set_agen!="") $set_agen .= ",";
								$set_agen .= "SKTD_CREATED_DATE = '$SKTD_CREATED_DATE'";
							}
							if($SKTD_NUMBER!="")
							{
								if($set_agen!="") $set_agen .= ",";
								$set_agen .= "SKTD_NUMBER = '$SKTD_NUMBER'";
							}
							if($SKTD_START!="")
							{
								if($set_agen!="") $set_agen .= ",";
								$set_agen .= "SKTD_START = '$SKTD_START'";
							}
							if($SKTD_END!="")
							{
								if($set_agen!="") $set_agen .= ",";
								$set_agen .= "SKTD_END = '$SKTD_END'";
							}							
							
							if($KD_AGEN=="")
								$sql_get_jumlah_agen_kapal = "select count(*) as jumlah_pelanggan_kapal from mst_agen where no_account = '$id'";
							else 
								$sql_get_jumlah_agen_kapal = "select count(*) as jumlah_pelanggan_kapal from mst_agen where kd_agen = '$KD_AGEN'";

							//QUERY
							if(!checkOriSQL($conn['ori']['kapal'],$sql_get_jumlah_agen_kapal,$query_get_jumlah_agen_kapal,$err)) goto Err;

							$row_jumlah_agen_kapal = oci_fetch_array($query_get_jumlah_agen_kapal, OCI_ASSOC);
							
							//if(($INSERT_UPDATE_FLAG=="I"||$row_jumlah_agen_kapal[JUMLAH_PELANGGAN_KAPAL]==0)&&!$already_insert_agen)
							if($row_jumlah_agen_kapal[JUMLAH_PELANGGAN_KAPAL]==0)
							{
								if($KD_AGEN=="")
								{
									$sql_get_new_kd_agen = "select MAX(to_number(kd_Agen))+1 as new_kd_agen from mst_agen WHERE F_IS_NUMBER(KD_AGEn) = 1";
									
									//QUERY
									if(!checkOriSQL($conn['ori']['kapal'],$sql_get_new_kd_agen,$query_get_new_kd_agen,$err)) goto Err;

									$row_new_kd_agen = oci_fetch_array($query_get_new_kd_agen, OCI_ASSOC);
								
									$KD_AGEN = $row_new_kd_agen[NEW_KD_AGEN];
								}
								
								if($KD_CABANG_OLD=="1582")
								{
									$sql_update_kapal = "INSERT INTO mst_agen 
																( 	KD_AGEN,
																	KD_CABANG,
																	NM_AGEN,
																	NM_SINGKATAN,
																	ALMT_AGEN,
																	NO_TLP1,
																	NO_TLP2,
																	NO_TLP3,
																	NO_ACCOUNT,
																	NO_NPWP,
																	KD_PPN_AGEN,
																	KD_THREE_PARTIED,
																	ALAMAT_EMAIL1,
																	ALAMAT_EMAIL2,
																	CATATAN,
																	NO_SIUPAL,
																	TGL_TERBIT_SIUPAL,
																	TGL_BERLAKU_SIUPAL,
																	NO_SIOPSUS,
																	TGL_TERBIT_SIOPSUS,
																	TGL_BERLAKU_SIOPSUS,
																	PENANGGUNG_JAWAB,
																	TGL_LAHIR,
																	AGAMA,
																	PETUGAS_OPERASIONAL,
																	MS_BERLAKU_DOMISILI,
																	MS_BERLAKU_ADPEL,
																	MS_BERLAKU_KTP,
																	SKPT,
																	INSA,
																	AKTE_PENDIRIAN,
																	DAFTAR_PEMILIK_AKTE,
																	REF_BANK,
																	DAFTAR_KAPAL,
																	ALM_KANTOR_PUSAT,
																	ALM_KANTOR_CAB,
																	SI_ADPEL,
																	DOMISLI_TERAKHIR,
																	KTP_PJWB,
																	REGUL_CEKPHIS,
																	WEBSITE,
																	IS_PERTAMINA,
																	TGL_JAM_ENTRY,
																	BYPASS_IDR,
																	SKTD_DIBERIKAN,
																	SKTD_CREATED_DATE,
																	SKTD_NUMBER,
																	SKTD_START,
																	SKTD_END,
																	CREATED_BY,
																	CREATED_DATE 
																)
																VALUES 
																(	'$KD_AGEN',
																	'$KD_CABANG',
																	'$NM_AGEN',
																	'$NM_SINGKATAN',
																	'$ALMT_AGEN',
																	'$NO_TLP1',
																	'$NO_TLP2',
																	'$NO_TLP3',
																	'$NO_ACCOUNT',
																	'$NO_NPWP',
																	'$KD_PPN_AGEN',
																	'$KD_THREE_PARTIED',
																	'$ALAMAT_EMAIL1',
																	'$ALAMAT_EMAIL2',
																	'$CATATAN',
																	'$NO_SIUPAL',
																	'$TGL_TERBIT_SIUPAL',
																	'$TGL_BERLAKU_SIUPAL',
																	'$NO_SIOPSUS',
																	'$TGL_TERBIT_SIOPSUS',
																	'$TGL_BERLAKU_SIOPSUS',
																	'$PENANGGUNG_JAWAB',
																	'$TGL_LAHIR',
																	'$AGAMA',
																	'$PETUGAS_OPERASIONAL',
																	'$MS_BERLAKU_DOMISILI',
																	'$MS_BERLAKU_ADPEL',
																	'$MS_BERLAKU_KTP',
																	'$SKPT',
																	'$INSA',
																	'$AKTE_PENDIRIAN',
																	'$DAFTAR_PEMILIK_AKTE',
																	'$REF_BANK',
																	'$DAFTAR_KAPAL',
																	'$ALM_KANTOR_PUSAT',
																	'$ALM_KANTOR_CAB',
																	'$SI_ADPEL',
																	'$DOMISLI_TERAKHIR',
																	'$KTP_PJWB',
																	'$REGUL_CEKPHIS',
																	'$WEBSITE',
																	'$IS_PERTAMINA',
																	'$TGL_JAM_ENTRY',
																	'N',
																	'$SKTD_DIBERIKAN',
																	'$SKTD_CREATED_DATE',
																	'$SKTD_NUMBER',
																	'$SKTD_START',
																	'$SKTD_END',
																	'CDM',
																	sysdate 
																)
																";									
								}
								else
								{
									$sql_update_kapal = "INSERT INTO mst_agen 
																( 	KD_AGEN,
																	KD_CABANG,
																	NM_AGEN,
																	NM_SINGKATAN,
																	ALMT_AGEN,
																	NO_TLP1,
																	NO_TLP2,
																	NO_TLP3,
																	NO_ACCOUNT,
																	NO_NPWP,
																	KD_PPN_AGEN,
																	KD_THREE_PARTIED,
																	ALAMAT_EMAIL1,
																	ALAMAT_EMAIL2,
																	CATATAN,
																	NO_SIUPAL,
																	TGL_TERBIT_SIUPAL,
																	TGL_BERLAKU_SIUPAL,
																	NO_SIOPSUS,
																	TGL_TERBIT_SIOPSUS,
																	TGL_BERLAKU_SIOPSUS,
																	PENANGGUNG_JAWAB,
																	TGL_LAHIR,
																	AGAMA,
																	PETUGAS_OPERASIONAL,
																	MS_BERLAKU_DOMISILI,
																	MS_BERLAKU_ADPEL,
																	MS_BERLAKU_KTP,
																	SKPT,
																	INSA,
																	AKTE_PENDIRIAN,
																	DAFTAR_PEMILIK_AKTE,
																	REF_BANK,
																	DAFTAR_KAPAL,
																	ALM_KANTOR_PUSAT,
																	ALM_KANTOR_CAB,
																	SI_ADPEL,
																	DOMISLI_TERAKHIR,
																	KTP_PJWB,
																	REGUL_CEKPHIS,
																	WEBSITE,
																	IS_PERTAMINA,
																	TGL_JAM_ENTRY,
																	BYPASS_IDR)
																VALUES 
																(	'$KD_AGEN',
																	'$KD_CABANG',
																	'$NM_AGEN',
																	'$NM_SINGKATAN',
																	'$ALMT_AGEN',
																	'$NO_TLP1',
																	'$NO_TLP2',
																	'$NO_TLP3',
																	'$NO_ACCOUNT',
																	'$NO_NPWP',
																	'$KD_PPN_AGEN',
																	'$KD_THREE_PARTIED',
																	'$ALAMAT_EMAIL1',
																	'$ALAMAT_EMAIL2',
																	'$CATATAN',
																	'$NO_SIUPAL',
																	'$TGL_TERBIT_SIUPAL',
																	'$TGL_BERLAKU_SIUPAL',
																	'$NO_SIOPSUS',
																	'$TGL_TERBIT_SIOPSUS',
																	'$TGL_BERLAKU_SIOPSUS',
																	'$PENANGGUNG_JAWAB',
																	'$TGL_LAHIR',
																	'$AGAMA',
																	'$PETUGAS_OPERASIONAL',
																	'$MS_BERLAKU_DOMISILI',
																	'$MS_BERLAKU_ADPEL',
																	'$MS_BERLAKU_KTP',
																	'$SKPT',
																	'$INSA',
																	'$AKTE_PENDIRIAN',
																	'$DAFTAR_PEMILIK_AKTE',
																	'$REF_BANK',
																	'$DAFTAR_KAPAL',
																	'$ALM_KANTOR_PUSAT',
																	'$ALM_KANTOR_CAB',
																	'$SI_ADPEL',
																	'$DOMISLI_TERAKHIR',
																	'$KTP_PJWB',
																	'$REGUL_CEKPHIS',
																	'$WEBSITE',
																	'$IS_PERTAMINA',
																	'$TGL_JAM_ENTRY',
																	'N'
																)
																";
								}
								
								if(!checkOriSQLAutoCommit($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;
							}
							else
							{
								if($KD_AGEN=="")
								{
									$sql_update_kapal = "UPDATE mst_agen set $set_agen where no_account = '$id'";
								}
								else 
								{
									$sql_update_kapal = "UPDATE mst_agen set $set_agen, updated_by = 'CDM', updated_date = sysdate where kd_agen = '$KD_AGEN'";
								}								
								
								if(!checkOriSQLAutoCommit($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;
							}
							
							if($KD_CABANG_OLD=="1582")
							{							
								//update rekening cms 
								$sql_get_customer_data_auto = "select account_no, bank_id, currency,saldo_min_cms from mst_customer_bank_account a, mst_customer_billing_account b 
															where a.billing_id=b.billing_id 
															and customer_id = '$id' and cms='Y' and a.branch_id='$KD_CABANG'";

								//QUERY
								if(!checkOriSQL($conn['ori']['ibis'],$sql_get_customer_data_auto,$query_get_customer_data_auto,$err)) goto Err;

								while($row_auto = oci_fetch_array($query_get_customer_data_auto, OCI_ASSOC))
								{
									$sql_get_jumlah_rekening_kapal_cms = "select count(*) as jumlah_pelanggan_kapal_cms 
																				from cms where KD_AGEN='$KD_AGEN'";
									
									//QUERY
									if(!checkOriSQL($conn['ori']['kapal'],$sql_get_jumlah_rekening_kapal_cms,$query_get_jumlah_pelanggan_kapal_cms,$err)) goto Err;
				
									$row_jumlah_pelanggan_kapal_cms = oci_fetch_array($query_get_jumlah_pelanggan_kapal_cms, OCI_ASSOC);
								
									$ACCOUNT_NO	= $row_auto[ACCOUNT_NO]!="" ? $row_auto[ACCOUNT_NO] : "";
									$BANK_ID	= $row_auto[BANK_ID]!="" ? $row_auto[BANK_ID] : "";
									$CURRENCY	= $row_auto[CURRENCY]!="" ? $row_auto[CURRENCY] : "";
									$SALDO_MIN_CMS	= $row_auto[SALDO_MIN_CMS]!="" ? $row_auto[SALDO_MIN_CMS] : "";
									
									$NOREK_USD = "";
									$BANK_USD = "";
									$NOREK_IDR = "";
									$BANK_IDR = "";

									if($CURRENCY=="IDR")
									{
										$CMS_VALUTA = "1";
									}
									else if($CURRENCY=="USD") 
									{
										$CMS_VALUTA = "2";
									}
									
									if($BANK_ID=="MANDI")
									{
										$KD_BANK_CMS = "MDR";
									}
									else if($BANK_ID=="NIAGA")
									{
										$KD_BANK_CMS = "CIMB";
									}									
									else if($BANK_ID=="BNI")
									{
										$KD_BANK_CMS = "BNI";
									}
										
									if($row_jumlah_pelanggan_kapal_cms[JUMLAH_PELANGGAN_KAPAL_CMS]==0)
									{																	
										$sql_update_kapal = "INSERT INTO cms 
																		(
																			KD_AGEN,
																			CMS_VALUTA,
																			CMS_SLD_MIN,
																			CMS_NO_REK_BANK,
																			CMS_KD_BANK,
																			PIUTANG,
																			KD_CABANG,
																			STATUS_AKTIF,
																			TGL_JAM_ENTRY 												
																		)
																		VALUES 
																		(
																			'$KD_AGEN',
																			'$CMS_VALUTA',
																			'$SALDO_MIN_CMS',
																			'$ACCOUNT_NO',
																			'$KD_BANK_CMS',
																			'0',
																			'$KD_CABANG',
																			'Y',
																			sysdate 
																		)
																		";
										if(!checkOriSQL($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;
									}
									else 
									{
										$set_cms="";

										if($CMS_VALUTA!="")
										{
											if($set_cms!="") $set_cms .=",";
											$set_cms .= "CMS_VALUTA='$CMS_VALUTA'";
										}
										if($SALDO_MIN_CMS!="")
										{
											if($set_cms!="") $set_cms .=",";
											$set_cms .= "CMS_SLD_MIN='$SALDO_MIN_CMS'";
										}
										if($ACCOUNT_NO!="")
										{
											if($set_cms!="") $set_cms .=",";
											$set_cms .= "CMS_NO_REK_BANK='$ACCOUNT_NO'";
										}
										if($KD_BANK_CMS!="")
										{
											if($set_cms!="") $set_cms .=",";
											$set_cms .= "CMS_KD_BANK='$KD_BANK_CMS'";
										}
										if($KD_CABANG!="")
										{
											if($set_cms!="") $set_cms .=",";
											$set_cms .= "KD_CABANG='$KD_CABANG'";
										}
										
										$sql_update_kapal = "UPDATE cms set $set_cms where KD_AGEN = '$KD_AGEN'";
										
										if(!checkOriSQL($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;								
									}
								}
							}
						}
							
						if($KD_CABANG_OLD!="1582")//belum autocollection
						{
							//update rekening autocollection
							$sql_get_customer_data_auto = "select account_no, bank_id, currency from mst_customer_bank_account a, mst_customer_billing_account b 
														where a.billing_id=b.billing_id 
														and customer_id = '$id' and autocollection='Y'";

							//QUERY
							if(!checkOriSQL($conn['ori']['ibis'],$sql_get_customer_data_auto,$query_get_customer_data_auto,$err)) goto Err;

							while($row_auto = oci_fetch_array($query_get_customer_data_auto, OCI_ASSOC))
							{
								$sql_get_jumlah_rekening_kapal_auto = "select count(*) as jumlah_pelanggan_kapal_auto 
																			from ac_rekening_user where kd_agen = '$id'";

								//QUERY
								if(!checkOriSQL($conn['ori']['kapal'],$sql_get_jumlah_rekening_kapal_auto,$query_get_jumlah_pelanggan_kapal_auto,$err)) goto Err;
			
								$row_jumlah_pelanggan_kapal_auto = oci_fetch_array($query_get_jumlah_pelanggan_kapal_auto, OCI_ASSOC);
							
								$ACCOUNT_NO	= $row_auto[ACCOUNT_NO]!="" ? $row_auto[ACCOUNT_NO] : "";
								$BANK_ID	= $row_auto[BANK_ID]!="" ? $row_auto[BANK_ID] : "";
								$CURRENCY	= $row_auto[CURRENCY]!="" ? $row_auto[CURRENCY] : "";
								
								$NOREK_USD = "";
								$BANK_USD = "";
								$NOREK_IDR = "";
								$BANK_IDR = "";

								$USER_ENTRY = "";
								$KD_CABANG = "01";
								$NO_TELEPON = "";
								$EMAIL = "";

								if($CURRENCY=="IDR")
								{
									$NOREK_IDR = $ACCOUNT_NO;
									
									if($BANK_ID=="MANDI")
									{
										$BANK_IDR = "MDR"; 
									}
									else if($BANK_ID=="NIAGA")
									{
										$BANK_IDR = "CIMB";
									}								
								}
								else if($CURRENCY=="USD") 
								{
									$NOREK_USD = $ACCOUNT_NO;
									
									if($BANK_ID=="MANDI")
									{
										$BANK_USD = "MDR";
									}
									else if($BANK_ID=="NIAGA")
									{
										$BANK_USD = "CIMB";
									}								
								}
									
								if($row_jumlah_pelanggan_kapal_auto[JUMLAH_PELANGGAN_KAPAL_AUTO]==0)
								{																	
									$sql_update_kapal = "INSERT INTO ac_rekening_user 
																	(
																		KD_AGEN,
																		NOREK_USD,
																		BANK_USD,
																		NOREK_IDR,
																		BANK_IDR,
																		INSERT_DATE,
																		USER_ENTRY,
																		KD_CABANG,
																		NO_TELEPON,
																		EMAIL															
																	)
																	VALUES 
																	(
																		'$id',
																		'$NOREK_USD',
																		'$BANK_USD',
																		'$NOREK_IDR',
																		'$BANK_IDR',
																		 sysdate,
																		'CDM',
																		'$KD_CABANG',
																		'$NO_TELEPON',
																		'$EMAIL'
																	)
																	";
									if(!checkOriSQL($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;
								}
								else 
								{
									$set_auto="";

									if($NOREK_USD!="")
									{
										if($set_auto!="") $set_auto .= ",";		
										$set_auto .= "NOREK_USD = '$NOREK_USD'";
										
										if($set_auto!="") $set_auto .= ",";		
										$set_auto .= "BANK_USD = '$BANK_USD'";									
									}
									else if($NOREK_IDR!="")
									{
										if($set_auto!="") $set_auto .= ",";		
										$set_auto .= "NOREK_IDR = '$NOREK_IDR'";
										
										if($set_auto!="") $set_auto .= ",";
										$set_auto .= "BANK_IDR = '$BANK_IDR'";
									}
									
									if($set_auto!="") $set_auto .= ",";		
									$set_auto .= "USER_ENTRY = 'CDM'";
										
									$sql_update_kapal = "UPDATE ac_rekening_user set $set_auto where KD_AGEN = '$id'";
									
									if(!checkOriSQL($conn['ori']['kapal'],$sql_update_kapal,$query_update_kapal,$err)) goto Err;								
								}
							}
						}
						
						$out_message= "SUCCESS";
						//update ke ibis bahwa update ke simkapal berhasil
						$sql_update_customer_data2 = "update mst_pelanggan_skapal set status_iu = 'S', status_simkapal = 'S', error_message_simkapal = '$out_message' 
														where kd_pelanggan = '$id' and status_iu = 'P'";
						if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;

						$sql_update_customer_data2 = "update mst_agen_skapal set insert_update_flag = 'S' 
														where no_account = '$id' and insert_update_flag = 'P'";
						if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;

						$data['update_to_simop'] = "S";
						$data['message_to_simop'] = "SUCCESS";
						$out_data['respons']=$data;
						$error = false;			
					}
					else 
					{
						//update ke ibis bahwa update ke simkeu gagal
						$sql_update_customer_data2 = "update mst_pelanggan_skapal set status_iu = 'F', status_simkeu = 'F', error_message_simkeu = '$out_message' 
														where kd_pelanggan = '$id' and status_iu = 'P'";
						if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;

						$sql_update_customer_data2 = "update mst_agen_skapal set insert_update_flag = 'F' 
														where no_account = '$id' and insert_update_flag = 'P'";
						if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;
						
						$data['update_to_simkeu'] = "F";
						$data['message_to_simkeu'] = $err;
						$out_data['respons']=$data;
						$error = true;
					}
				}
			}
		}/**/

		$out_data['respons']=$data;
		
		if($error)
			goto Err;
		else 
			goto Success;

	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}

	/*------------------------------------------ERROR-------------------------------------------------------------*/
	Err:

		$err = str_replace($inv_char,$fix_char,$err);
		$sql_update_customer_data2 = "update mst_pelanggan_skapal set status_iu = 'F', error_message_simkapal = '$err'
										where kd_pelanggan = '$id' and status_iu = 'P'";
		if(!checkOriSQL($conn['ori']['ibis'],$sql_update_customer_data2,$query_update_customer_data2,$err)) goto Err;

		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($err=="") $err = "ERROR";
		if($out_status=="") $out_status = "F";
		return generateResponse($out_data, $out_status, $err, "json");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS". $err;
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "json");
}

?>