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
	<td>: <?=$servicetype_name;?></td>
</tr>

<tr>
	<td>Customer</td>
	<td>: <?=$cust_name;?></td>
</tr>
<tr>
	<td></td>
	<td>&nbsp;<?=$cust_addr;?></td>
</tr>
<tr>
	<td>Vessel - Voyage</td>
	<td>: <?=$vessel;?> - <?=$voy_in;?>/<?=$voy_out;?></td>
</tr>
<tr>
	<td>BL Number - Date</td>
	<td>: <?=$bl_number;?></td>
</tr>
<tr>
	<td>Movement Type (TL/Yard)</td>
	<td>: <?=$ket_tl;?> </td>
</tr>
<tr>
	<td>Period Request</td>
	<td>: <?=$stackin;?> s/d <?=$stackout;?></td>
</tr>

</table>
<BR>
<p class="tablebase"><b>Data Detail Cargo</b></p>
<table border=1 class="tablebased">
<tr>
	<td class="headtb" width="5">No.</td>
	<td class="headtb" width="150">Cargo Name</td>
	<td class="headtb" width="150">Package Name</td>
	<td class="headtb" width="80">Qty</td>
	<td class="headtb" width="80">Unit</td>
	<td class="headtb" width="80">Ton</td>
	<td class="headtb" width="80">Cubic</td>
	<td class="headtb" width="80">Hz</td>
	<td class="headtb" width="80">Ds</td>
</tr>
<? 
$i=1;
foreach($row_detail as $rowd){?>
<tr>
	<td class="tablebased"><?=$i;?></td>
	<td class="tablebased"><?=$rowd['cargo_name'];?></td>
	<td class="tablebased"><?=$rowd['pkg_name'];?></td>
	<td class="tablebased"><?=$rowd['qty'];?></td>
	<td class="tablebased"><?=$rowd['unit'];?></td>
	<td class="tablebased"><?=$rowd['ton'];?></td>
	<td class="tablebased"><?=$rowd['cubic'];?></td>
	<td class="tablebased"><?=$rowd['hz'];?></td>
	<td class="tablebased"><?=$rowd['ds'];?></td>
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