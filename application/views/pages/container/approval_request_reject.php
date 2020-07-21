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
	<td>Notes</td>
	<td>
		: <input type="text" class="form-control" id="request_no" name="notest" placeholder="" title="Notes">
	</td>
</tr>
<tr>
	<td colspan='2'>
		<input type="text" class="form-control" id="request_no" name="notest" placeholder="" title="Notes">
	</td>
</tr>
</table>

<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});
</script>