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
	<td>Request Type</td>
	<td>: <?=$rowdata['MODUL_DESC'];?></td>
</tr>

<tr>
	<td>Customer</td>
	<td>: <?=$rowdata['CUSTOMER_NAME'];?></td>
</tr>
<tr>
	<td></td>
	<td>&nbsp;<?=$rowdata['CUSTOMER_ADDRESS'];?></td>
</tr>
<tr>
	<td>Vessel - Voyage</td>
	<td>: <?=$rowdata['VESVOY'];?> </td>
</tr>
<tr>
	<td>BL Number - Date</td>
	<td>: <? echo $POD;?> </td>
</tr>
<tr>
	<td>Movement Type</td>
	<td>: <? echo $FPOD;?> </td>
</tr>
<tr>
	<td>Period Date</td>
	<td>: <?=$START_PERIOD;?> s/d <? echo $END_PERIOD;
	if($rowdata['MODUL_DESC']!="RECEIVING")
	{
	?> Ext : <? echo $EXT_PERIOD;
	}
	?></td>
</tr>

<?php
if($rowdata['STATUS_REQ']=="R")
{
?>
<tr>
	<td>Reject Notes</td>
	<td>: [ <font color="red" size="3"><b><?php echo $rowdata['REJECT_NOTES'];?><b></font> ]</td>
</tr>
<?php	
}
?>
</table>
<BR>
<p class="tablebase"><b>Data Detail Cargo</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No.</td>
	<td class="headtb" width="150">Cargo Name</td>
	<td class="headtb" width="200">Package Name</td>
	<td class="headtb" width="80">Qty</td>
	<td class="headtb" width="80">Unit</td>
	<td class="headtb" width="80">Ton</td>
	<td class="headtb" width="80">Cubic</td>
	<td class="headtb" width="80">HZ</td>
	<td class="headtb" width="80">DS</td>
</tr>
<? 
$i=1;
foreach($row_detail as $rowd){?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$rowd['NO_CONTAINER'];?></td>
	<td class="tablebased"><?=$rowd['SIZE_CONT'];?> <?=$rowd['TYPE_CONT'];?> <?=$rowd['STATUS_CONT'];?></td>
	<td class="tablebased"><?=$rowd['ISO_CODE'];?></td>
	<td class="tablebased"><?=$rowd['HZ'];?></td>
	<td class="tablebased"><?=$rowd['HEIGHT'];?></td>
	<td class="tablebased"><?=$rowd['CARRIER'];?></td>
	<td class="tablebased"><?=$rowd['HEIGHT'];?></td>
	<td class="tablebased"><?=$rowd['CARRIER'];?></td>
</tr>
<?
$i++;
}?>
</table>
<br/>
<table class="tablebase">
<tr>
	<td>History:</td>
</tr>
<?
foreach($row_history as $rowd){?>
<tr>
	<td><?=$rowd['HISTORY'];?></td>
</tr>
<?
}?>
</table>