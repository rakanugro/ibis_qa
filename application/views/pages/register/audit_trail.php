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
<?
foreach($row_history as $rowd){?>
<tr>
	<td><?=$rowd['HISTORY'];?></td>
</tr>
<?
}?>
</table>