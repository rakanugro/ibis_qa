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
	<td>Request Number</td>
	<td>: <?=$no_request;?></td>
</tr>
<tr>
	<td>Module</td>
	<td>: <?=$rowdata['MODUL_DESC'];?></td>
</tr>

<tr>
	<td>Customer Name</td>
	<td>: <?=$rowdata['CUSTOMER_NAME'];?></td>
</tr>
<tr>
	<td>Customer Address</td>
	<td>: <?=$rowdata['CUSTOMER_ADDRESS'];?></td>
</tr>
<tr>
	<td>NPWP</td>
	<td>: <?=$NPWP;?></td>
</tr>
<tr>
	<td>Vessel ( voy )</td>
	<td>: <?=$rowdata['VESVOY'];?> </td>
</tr>
<?php if($rowdata['MODUL_DESC'] == 'DELIVERY') { ?>
<tr>
	<td>Tanggal Bongkar</td>
	<td>: <?=$DISCH_DATE;?> </td>
</tr>
<tr>
	<td>Tanggal SPPB</td>
	<td>: <?=$TGL_SPPB;?> </td>
</tr>
<?php } ?>
</table>
<BR>
<p class="tablebase"><b>Data Perhitungan Container</b></p>
<table border=1 class="tablebased">
	<tr>
		
		<td class="headtb" width="200">KETERANGAN</td>
		<td class="headtb" width="100">TGL AWAL</td>
		<td class="headtb" width="100">TGL AKHIR</td>
		<td class="headtb" width="80">BOX</td>
		<td class="headtb" width="80">SZ</td>
		<td class="headtb" width="80">TY</td>
		<td class="headtb" width="80">ST</td>
		<td class="headtb" width="80">HZ</td>
		<td class="headtb" width="80">HR</td>
		<td class="headtb" width="150">TARIF</td>
		<td class="headtb" width="80">VAL</td>
		<td class="headtb" width="200">JUMLAH</td>
	</tr>
<? 
$i=1;
foreach($row_detail as $rowd){?>
	<tr>
		<td class="tablebased"><?=$rowd['KETERANGAN'];?></td>
		<td class="tablebased"><?=$rowd['TGL_START_STACK'];?></td>
		<td class="tablebased"><?=$rowd['TGL_END_STACK'];?></td>
		<td class="tablebased"><?=$rowd['JUMLAH_CONT'];?></td>
		<td class="tablebased"><?=$rowd['UKURAN'];?></td>
		<td class="tablebased"><?=$rowd['TYPE'];?></td>
		<td class="tablebased"><?=$rowd['STATUS'];?></td>
		<td class="tablebased"><?=$rowd['HZ'];?></td>
		<td class="tablebased"><?=$rowd['JUMLAH_HARI'];?></td>
		<td align="right"><?=$rowd['TARIF'];?> &nbsp;</td>
		<td class="tablebased">IDR</td>
		<td align="right"><?=$rowd['SUB_TOTAL'];?> &nbsp;</td>
		
	</tr>
<?
$i++;
}?>
	<tr>
		<td colspan="10" align="right">Administrasi &nbsp;</td>
		<td colspan="2" align="right"><?=$ADM;?> &nbsp;</td>
	</tr>
	<tr>
		<td colspan="10" align="right">Dasar Pengenaan Pajak &nbsp;</td>
		<td colspan="2" align="right"><?=$DPP;?> &nbsp;</td>
	</tr>
	<tr>
		<td colspan="10" align="right">Jumlah PPN &nbsp;</td>
		<td colspan="2" align="right"><?=$PPN;?> &nbsp;</td>
	</tr>
	<tr>
		<td colspan="10" align="right">Bea Materai &nbsp;</td>
		<td colspan="2" align="right"><?=$MATERAI;?> &nbsp;</td>
	</tr>
	<tr>
		<td colspan="10" align="right">Jumlah Dibayar &nbsp;</td>
		<td colspan="2" align="right"><?=$TOTAL;?> &nbsp;</td>
	</tr>
</table>

	



	
	
