<style>
.tablebase
{
	font-size: 13px;
}
.tablebased
{
	font-size: 11px;
	border-color:#e84e40;
	text-align:center;
}

.headtb
{
	background-color:#e84e40;
	color : white;
	text-align:center;
}
</style>
<table class="tablebase">
<tr>
	<td>Cabang Transaksi</td>
	<td> :&nbsp</td>
	<td><?=$register["NAMA_CABANG"];?></td>
</tr>
<tr>
	<td>&nbsp </td>
	<td></td>
</tr>
<tr>
	<td>Notes</td>
	<td> :&nbsp</td>
	<td><?=$submit_notes;?></td>
</tr>
<tr>
	<td>&nbsp </td>
	<td></td>
</tr>
<tr>
	<td><b>Summary Data Pelanggan</b></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>ID Customer</td>
	<td> : </td>
	<td><?php
	if($register['CUSTOMER_ID']!="")
		echo $register['CUSTOMER_ID'];
	else 
		echo $register['CUSTOMER_ID_T'];
	?>
	</td>
</tr>
<tr>
	<td>Nama Customer</td>
	<td> : </td>
	<td><?php
	if($register['NAME']!="")
		echo $register['NAME'];
	else 
		echo $register['NAME_T'];
	?>
	</td>
</tr>
<tr>
	<td>Alamat Customer</td>
	<td> : </td>
	<td><?php
	if($register['ADDRESS']!="")
		echo $register['ADDRESS'];
	else 
		echo $register['ADDRESS_T'];
	?>
	</td>
</tr>
<tr>
	<td>Telephone/Email</td>
	<td> : </td>
	<td><?php
	if($register['PHONE']!="")
		echo $register['PHONE'];
	else 
		echo $register['PHONE_T'];
	?>
	/
	<?php
	if($register['EMAIL']!="")
		echo $register['EMAIL'];
	else 
		echo $register['EMAIL_T'];
	?>	
	</td>
</tr>
<tr>
	<td>NPWP</td>
	<td> : </td>
	<td><?php
	if($register['NPWP']!="")
		echo $register['NPWP'];
	else 
		echo $register['NPWP_T'];
	?>
	</td>
</tr>
<tr>
	<td>&nbsp </td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><b>Customer Hierarchy</b></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>Pusat</td>
	<td> : </td>
	<td><?php echo $customer_hq['NAME']?> </td>
</tr>
<tr>
	<td valign="top">Cabang Perusahaan</td>
	<td valign="top"> : </td>
	<td>
		<?php
			foreach($customer_branch as $rowcbranch)
			{
				echo $rowcbranch["NAME"]."<br>";
			}
		?>
	</td>
</tr>
<tr>
	<td>Anak Perusahaan</td>
	<td> : </td>
	<td>
		<?php
			foreach($customer_child as $rowcchild)
			{
				echo $rowcchild["NAME"]."<br>";
			}
		?>
	</td>
</tr>
</table>
<br>
<p class="tablebase"><b>General Information</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("NAME"=>"Nama Perusahaan",
"ADDRESS"=>"Alamat Perusahaan",
"NPWP"=>"NPWP",
"EMAIL"=>"Email",
"WEBSITE"=>"Website",
"PHONE"=>"Phone",
"COMPANY_TYPE"=>"Jenis Perusahaan",
"ALT_NAME"=>"Nama Perusahaan untuk Faktur Pajak",
"DEED_ESTABLISHMENT"=>"Akte Pendirian Perusahaan",
"CUSTOMER_GROUP"=>"Kelompok Pelanggan",
"SVC_VESSEL"=>"Layanan Kapal",
"SVC_CARGO"=>"Layanan Barang/Petikemas",
"SVC_CONTAINER"=>"Layanan Barang/Petikemas",
"SVC_MISC"=>"Layanan Rupa2",
"IS_SUBSIDIARY"=>"Anak Perusahaan?",
"HOLDING_NAME"=>"Induk Usaha",
"EMPLOYEE_COUNT"=>"Jumlah Karyawan", 
"IS_MAIN_BRANCH"=>"Kantor Pusat?",
"PARTNERSHIP_DATE"=>"Menjadi Partner Sejak",
"PROVINCE"=>"Profinsi",
"CITY"=>"Kota",
"KECAMATAN"=>"Kecamatan", 
"KELURAHAN"=>"Kelurahan", 
"POSTAL_CODE"=>"Kode POS",
"FAX"=>"Fax", 
"PARENT_ID"=>"Kantor Pusat ID", 
"IS_SHIPPING_AGENT"=>"Shipping Agent?", 
"IS_SHIPPING_LINE"=>"Shipping Line?",
"IS_PBM"=>"PBM?",
"IS_FF"=>"FF?",
"IS_EMKL"=>"EMKL?",
"IS_PPJK"=>"PPJK?",
"IS_CONSIGNEE"=>"Cargo Owner?",
"HEADQUARTERS_ID"=>"Kantor Pusat ID", 
"HEADQUARTERS_NAME"=>"Kantor Pusat",
"ACCEPTANCE_DOC"=>"Dokumen Berita Acara Serah Terima", 
"ACCEPTANCE_DOC_DATE"=>"Tanggal Berita Acara Serah Terima Dokumen"
);
foreach($field_check as $key => $value){
	if($register[$key]!=$register[$key."_T"])
	{
		if($register[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($register[$key."_T"]==""&$register[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$register[$key];?></td>
	<td class="tablebased"><?=$register[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}?>
</table>
<br>
<p class="tablebase"><b>Billing Accounts</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("ADDRESS_BILLING"=>"Alamat Penagihan",
"PROVINCE_BILLING"=>"Provinsi",
"CITY_BILLING"=>"Kota / Kabupaten",
"KECAMATAN_BILLING"=>"Kecamatan",
"KELURAHAN_BILLING"=>"Kelurahan / Desa",
"POSTAL_CODE_BILLING"=>"Kode Pos",
"PHONE_BILLING"=>"Telepon",
"EMAIL_BILLING"=>"Alamat Surel Penagihan",
"BILLING_CUSTOMER_ID"=>"Pelanggan ID"
);

foreach($billing as $billing2){
foreach($field_check as $key => $value){
	if($billing2[$key]!=$billing2[$key."_T"])
	{
		if($billing2[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($billing2[$key."_T"]==""&$billing2[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$billing2[$key];?></td>
	<td class="tablebased"><?=$billing2[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}
}
?>
</table>
<br>
<p class="tablebase"><b>Banks</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("ACCOUNT_NO"=>"Rekening",
"CURRENCY"=>"Mata Uang",
"AUTOCOLLECTION"=>"Autocollection?",
"AUTOCOLLECTION_BM_BARANG"=>"Autocollection BM Barang?",
"CMS"=>"CMS?",
"BANK_NAME"=>"Bank"
);

foreach($bank as $bank2){
foreach($field_check as $key => $value){
	if($bank2[$key]!=$bank2[$key."_T"])
	{
		if($bank2[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($bank2[$key."_T"]==""&$bank2[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$bank2[$key];?></td>
	<td class="tablebased"><?=$bank2[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}
}
?>
</table>
<br>
<p class="tablebase"><b>Account Managers</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("TITLE_AM"=>"Jabatan", 
"NAME_AM"=>"Nama", 
"ADDRESS_AM"=>"Alamat", 
"PROVINCE_AM"=>"Provinsi", 
"CITY_AM"=>"Kota/Kabupaten", 
"KECAMATAN_AM"=>"Kecamatan", 
"KELURAHAN_AM"=>"Kelurahan", 
"POSTAL_CODE_AM"=>"Kode Pos", 
"PHONE_AM"=>"Telepon", 
"HANDPHONE_AM"=>"Handphone", 
"EMAIL_AM"=>"Email"

);
foreach($am as $am2){
foreach($field_check as $key => $value){
	if($am2[$key]!=$am2[$key."_T"])
	{
		if($am2[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($am2[$key."_T"]==""&$am2[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$am2[$key];?></td>
	<td class="tablebased"><?=$am2[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}
}
?>
</table>
<br>
<p class="tablebase"><b>CEO</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("NAME_CEO"=>"Nama Pemimpin Perusahaan", 
"ADDRESS_CEO"=>"Alamat Pemimpin Perusahaan", 
"PROVINCE_CEO"=>"Provinsi", 
"CITY_CEO"=>"Kota/Kabupaten", 
"KECAMATAN_CEO"=>"Kecamatan", 
"KELURAHAN_CEO"=>"Kelurahan", 
"POSTAL_CODE_CEO"=>"Kode POS", 
"PHONE_CEO"=>"Telepon", 
"HANDPHONE_CEO"=>"Handphone", 
"EMAIL_CEO"=>"Email", 
"LOCATION_BIRTH_CEO"=>"Tempat Lahir", 
"DATE_BIRTH_CEO"=>"Tanggal Lahir", 
"NATIONALITY_CEO"=>"Kewarganegaraan", 
"KTP_CEO"=>"KTP", 
"PASSPORT_CEO"=>"Passpord", 
"SEX_CEO"=>"Jenis Kelamin Pemimpin Perusahaan", 
"RELIGION_CEO"=>"Agama Kelamin Pemimpin Perusahaan",
"KTP_EXPIRE_DATE_CEO"=>"Tanggal Berlaku KTP", 
"PASSPORT_EXPIRE_DATE_CEO"=>"Tanggal Berlaku Passport"
);
foreach($field_check as $key => $value){
	if($ceo[$key]!=$ceo[$key."_T"])
	{
		if($ceo[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($ceo[$key."_T"]==""&$ceo[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$ceo[$key];?></td>
	<td class="tablebased"><?=$ceo[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}?>
</table>
<br>
<p class="tablebase"><b>BOD</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("TITLE_BOD"=>"Jabatan", 
"NAME_BOD"=>"Nama", 
"ADDRESS_BOD"=>"Alamat",
"PROVINCE_BOD"=>"Provinsi", 
"CITY_BOD"=>"Kota/Kabupaten", 
"KECAMATAN_BOD"=>"Kecamatan", 
"KELURAHAN_BOD"=>"Kelurahan",
"POSTAL_CODE_BOD"=>"Kode POS", 
"PHONE_BOD"=>"Telepon", 
"HANDPHONE_BOD"=>"Handphone", 
"EMAIL_BOD"=>"Email"
);
foreach($bod as $bod2){
foreach($field_check as $key => $value){
	if($bod2[$key]!=$bod2[$key."_T"])
	{
		if($bod2[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($bod2[$key."_T"]==""&$bod2[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$bod2[$key];?></td>
	<td class="tablebased"><?=$bod2[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}
}
?>
</table>
<br>
<p class="tablebase"><b><?=$custom_name?></b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = $custom_field_check;
foreach($field_check as $key => $value){
	if($custom[$key]!=$custom[$key."_T"])
	{
		if($custom[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($custom[$key."_T"]==""&$custom[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$custom[$key];?></td>
	<td class="tablebased"><?=$custom[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}?>
</table>
<br>
<p class="tablebase"><b>PIC</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array("NAME_PIC"=>"Nama Penanggung Jawab", 
"KTP_PIC"=>"KTP", 
"RELIGION_PIC"=>"Agama",
"ADDRESS_PIC"=>"Alamat", 
"PROVINCE_PIC"=>"Provinsi", 
"CITY_PIC"=>"Kota/Kabupaten",
"KECAMATAN_PIC"=>"Kecamatan", 
"KELURAHAN_PIC"=>"Kelurahan", 
"POSTAL_CODE_PIC"=>"Kode POS"
);
foreach($pic as $pic2){
foreach($field_check as $key => $value){
	if($pic2[$key]!=$pic2[$key."_T"])
	{
		if($pic2[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($pic2[$key."_T"]==""&$pic2[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$pic2[$key];?></td>
	<td class="tablebased"><?=$pic2[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}
}
?>
</table>

<br>

<p class="tablebase"><b>PPJK-CONSIGNEE</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No</td>
	<td class="headtb" width="150">Operation</td>
	<td class="headtb" width="200">Field</td>
	<td class="headtb" width="80">Old Value</td>
	<td class="headtb" width="80">New Value</td>
	<td class="headtb" width="80">Change Date</td>
</tr>
<? 
$i=1;
$field_check = array(
"CONSIGNEE_ID"=>"CONSIGNEE CUSTOMER ID", 
"CREATED_DATE"=>"CREATED DATE",
"EXPIRED_DATE"=>"EXPIRED DATE", 
"CREATE_USER"=>"CREATE USER", 
"EDIT_USER"=>"EDIT USER",
"EDIT_DATE"=>"EDIT DATE", 
"BRANCH_ID"=>"BRANCH CODE"
);
foreach($ppjk_consignee as $ppjk_consignee2){
foreach($field_check as $key => $value){
	if($ppjk_consignee2[$key]!=$ppjk_consignee2[$key."_T"])
	{
		if($ppjk_consignee2[$key]=="")
		{
			$operation = "CREATE";
		}
		else if($ppjk_consignee2[$key."_T"]==""&$ppjk_consignee2[$key]!="")
		{
			$operation = "DELETE";
		}
		else
		{
			$operation = "UPDATE";
		}
?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$operation;?></td>
	<td class="tablebased"><?=$value;?></td>
	<td class="tablebased"><?=$ppjk_consignee2[$key];?></td>
	<td class="tablebased"><?=$ppjk_consignee2[$key."_T"];?></td>
	<td class="tablebased"></td>
</tr>
<?
$i++;
	}

}
}
?>
</table>