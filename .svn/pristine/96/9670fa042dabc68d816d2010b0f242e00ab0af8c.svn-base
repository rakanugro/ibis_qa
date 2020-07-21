<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<style type="text/css">
.separate_content {
	width:31%;
    height:100px;
    border:1px solid red;
    margin-right:10px;
    float:left;
}
</style>

<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}<>|\[\]/\\]/gi, ''));
	});
});
	
	function searchRequest(page)
	{
		var url = "<?=ROOT?>register/search_customer_approval/"+$("#search").val();
		var limit = $("#pagelimit").val();
		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',page:page,limit:limit});
	}
	
</script>

<script>
	//search table js
	function load_table()
	{
		var url = "<?=ROOT?>register/search_customer_approval";
		var limit = $("#pagelimit").val();
		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',page:1,limit:limit});		
	}
	
	$( document ).ready(function() {
		load_table();
		//autoload
		var intervalID = setInterval(function(){load_table();}, 120000);
	});
</script>
			
			<div class="row" id="tabledata">
			
			</div>
		</div>
	</div>
	
	<div id="dialogViewReq"></div>
	
	<div id="dialogReject" style="display:none">
		<table class="tablebase">
		<tr>
			<td width="130">Request Number</td>
			<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td>
			<span id="custnum"></span>
			</td>
		</tr>		
		<tr>
			<td colspan="3">&nbsp</td>
		</tr>		
		<tr>
			<td>Notes</td>
			<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td>
				<textarea class="form-control" id="notes" name="notes" placeholder="" title="Notes" cols="30"></textarea>
				<input type="hidden" id="cust_num">
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp</td>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="button" value="CONFIRM REJECT" class="btn btn-primary" id="confirm_reject"></td>
		</tr>
		</table>
	</div>