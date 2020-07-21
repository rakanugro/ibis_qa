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
	<td>Customer</td>
	<td>: <?=$rowdata['CUSTOMER_NAME'];?></td>
</tr>
<tr>
	<td></td>
	<td>&nbsp;<?=$rowdata['CUSTOMER_ADDRESS'];?></td>
</tr>
<tr>
	<td>Custom Doc* (NPE/SPPB)</td>
	<td>: <?=$rowdata['CUSTOM_NUMBER1'];?></td>
</tr>
<tr>
	<td>Custom Doc** (PEB)</td>
	<td>: <?=$rowdata['CUSTOM_NUMBER2'];?></td>
</tr>
<tr>
	<td>Shipping Doc* (Booking Number/DO/BL)</td>
	<td>: <?=$rowdata['ADDITIONAL_FIELD1'];?><? if($rowdata['ADDITIONAL_FIELD2']<>'') { ?>/<?=$rowdata['ADDITIONAL_FIELD2'];?><? } ?></td>
</tr>
<tr>
	<td>Call Sign</td>
	<td>: <?=isset($rowdata['CALL_SIGN'])?$rowdata['CALL_SIGN']:'';?></td>
</tr>

<tr>
	<td>Vessel ( voy )</td>
	<td>: <?=$rowdata['VESVOY'];?> </td>
</tr>
<tr>
	<td>POD</td>
	<td>: <? echo $POD;?> </td>
</tr>
<tr>
	<td>FPOD</td>
	<td>: <? echo $FPOD;?> </td>
</tr>
<tr>
	<td>Period Request</td>
	<td>: <?=$START_PERIOD;?> s/d <? echo $END_PERIOD;
	if($rowdata['MODUL_DESC']!="RECEIVING")
	{
	?> Ext : <? echo $EXT_PERIOD;
	}
	?></td>
</tr>
<tr>
	<td>Movement Type (TL/Yard)</td>
	<td>: <?=$TL_FLAG;?> </td>
</tr>

<?php if($rowdata['MODUL_DESC'] =="RECEIVING") { 
	if($rowdata['PORT_ID']=="IDPLM" || $rowdata['PORT_ID']=="IDPNK"){
	}else{
 ?>
<tr>
	<td>Start Shift Reefer</td>
	<td>: <? echo $START_SHIFT ; ?> </td>
</tr>
<tr>
	<td>End Shift Reefer</td>
	<td>: <? echo $END_SHIFT ; ?> </td>
</tr>
<tr>
	<td>Shift Reefer</td>
	<td>: <? echo $SHIFT_REEFER ; ?> </td>
</tr>
<?php 
	}
}?>


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
<p class="tablebase"><b>Data Detail Container</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No.</td>
	<td class="headtb" width="150">Container</td>
	<td class="headtb" width="200">Spec</td>
	<td class="headtb" width="80">Iso code</td>
	<td class="headtb" width="80">Hz</td>
	<td class="headtb" width="80">Height</td>
	<td class="headtb" width="80">Carrier</td>
	<?php if($rowdata['MODUL_DESC'] =="DELIVERY") {?>
	<td class="headtb" width="100">Plug IN</td>
	<td class="headtb" width="100">Plug OUT</td>
	<td class="headtb" width="100">Jumlah Shift</td>
	<?php }?>
	
	<?php if($rowdata['MODUL_DESC'] =="PERPANJANGAN DELIVERY") {?>
	<td class="headtb" width="100">Plug IN EXT</td>
	<td class="headtb" width="100">Plug OUT EXT</td>
	<td class="headtb" width="100">Jumlah Shift</td>
	<?php }?>
	
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
	<?php if($rowdata['MODUL_DESC'] =="DELIVERY") {?>
	<td class="tablebased"><?=$rowd['PLUG_IN'];?></td>
	<td class="tablebased"><?=$rowd['PLUG_OUT'];?></td>
	<td class="tablebased"><?=$rowd['JML_SHIFT'];?></td>
	<?php }?>
	
	<?php if($rowdata['MODUL_DESC'] =="PERPANJANGAN DELIVERY") {?>
	<td class="tablebased"><?=$rowd['PLUG_OUT'];?></td>
	<td class="tablebased"><?=$rowd['PLUG_OUT_EXT'];?></td>
	<td class="tablebased"><?=$rowd['JML_SHIFT'];?></td>
	<?php }?>
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