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

	
	//search table js
	function load_table()
	{
		$.blockUI();
		var url = "<?=ROOT?>approval_request/search_tb_svcccl";
		var limit = $("#pagelimit").val();
		var request_no = $("#request_no").val();

		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
									REQNO:request_no,
									page:1,limit:limit},function() {
										  $.unblockUI();
										});		
	}
	
</script>
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="main-box clearfix">
							<header class="main-box-header clearfix">
								<h2 class="pull-left">Search Request</h2>
							</header>
							<div class="main-box-body clearfix">
							<div class="form-group example-twitter-oss">
								<label for="exampleAutocomplete">No Request</label>
								<input type="text" class="form-control" id="request_no" name="request_no" value="" placeholder="" style="width:50%;" />
							</div>
<!-- 							<div class="form-group example-twitter-oss">
								<label for="exampleAutocomplete">Terminal</label>
								<select type="text" class="form-control" id="terminal" name="terminal" value="" placeholder="" style="width:50%;">
								
								<? foreach ($data_term as $row)
									{?><option value="<?=$row['TERMINAL'];?>"><?=$row['TERMINAL_NAME'];?></option>
									<?}?>
								</select>
							</div>
							<div class="form-group example-twitter-oss">
								<label for="exampleAutocomplete">Type Request</label>
								<select type="text" class="form-control" id="type_req" name="type_req" value="" placeholder="" style="width:50%;">
									<? foreach ($data_svc_ccl as $row)
									{?><option value="<?=$row['MODUL_DESC'];?>"><?=$row['SERVICE_NAME'];?></option>
									<?}?>
								</select>
							</div> -->
							
							<div class="form-group example-twitter-oss">
								<input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success"/>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="tabledata"></div>
		</div>
	</div>
							
	<div id="dialogDoc1" style="display:none">
	    <div>
	    <iframe id="frameDoc1" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
	    </div>
	</div> 
	<div id="dialogDoc2" style="display:none">
	    <div>
	    <iframe id="frameDoc2" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
	    </div>
	</div> 
	<div id="dialogDoc3" style="display:none">
	    <div>
	    <iframe id="frameDoc3" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
	    </div>
	</div> 

	<div id="dialogMultiDoc" style="display:none">
	    <div class='separate_content'>
			<iframe id="frameDoc11" style="position: absolute; width:30%;height: 100%; border: none"></iframe>
	    </div>
		<div class='separate_content'>
			<iframe id="frameDoc12" style="position: absolute; width:30%;height: 100%; border: none"></iframe>
		</div>
		<div class='separate_content'>
			<iframe id="frameDoc13" style="position: absolute; width:30%;height: 100%; border: none"></iframe>
		</div>
	</div> 
	
	<div id="dialogViewReq"></div>
	
	
	<script>
	
	/*function rejectD(a)
    {
		$('#request_num').val(a);
		$('#reqnum').text(a);
		$('#dialogReject').dialog({modal:false, height:250,width:500,title: 'Cancel Approval'});
	}
			
	
	$("#confirm_reject").click(function() {
		var notes = $("#notes").val();
		var request_num = $("#request_num").val();
		
		var r = confirm("Do you want to reject?");
		if (r == true) {
			//alert("You will reject this request");
			var url = "<?=ROOT?>container/reject_request";
			$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:request_num,REJECT_NOTES:notes}, function(data){
				alert(data);
				location.reload(); 
			});
		} else {
			alert("cancel");
		}
	});
	*/
	</script>