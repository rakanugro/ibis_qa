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

	function showFullReview(pathDoc, typeDoc){
		console.log('pathDoc: ' + pathDoc);
		console.log('typeDoc: ' + typeDoc);
		$('#frameDoc11').attr('src', pathDoc);
		
		$('#frameDoc12').attr('src', pathDoc);
		
		$('#frameDoc13').attr('src', pathDoc);
		$("#dialogMultiDoc").dialog({modal:false, height:500,width:650,title: 'View '+typeDoc+' file'});
	}
	
	function clickDialog1(a){
		$('#dialogViewReq').load("<?=ROOT?>container/view_request/"+a).dialog({modal:false, height:500,width:650,title: 'View Content'});
	}
	
	function clickDialogDoc(a,b){
		console.log('a: ' + a);
		console.log('b: ' + b);
		
		if((b=='NPE') ||(b=='DO')) {
			$('#frameDoc1').attr('src', a);
			$("#dialogDoc1").dialog({modal:false, height:500,width:650,title: 'View '+b+' file'});
			
		}
		else if((b=='PEB')||(b=='SPPB')) {
			$('#frameDoc2').attr('src', a);
			$("#dialogDoc2").dialog({modal:false, height:500,width:650,title: 'View '+b+' file'});
		}
		else if(b=='BKS') {
			$('#frameDoc3').attr('src', a);
			$("#dialogDoc3").dialog({modal:false, height:500,width:650,title: 'View Booking Shipping file'});
		}
	}
	
   function approveD(z,a,b)
   {
	    var txt;
		var r = confirm("Do you want to approve?");
		if (r == true) {
			if (z=='RECEIVING')
			{
				var url = "<?=ROOT?>container_receiving/submit_request";
			}
			else if (z=='DELIVERY')
			{
				var url = "<?=ROOT?>container/save_request_delivery";
			}
			else if (z=='PERPANJANGAN DELIVERY')
			{
				var url = "<?=ROOT?>container/save_request_deliveryperp";
			}
			else if ((z=='CALBG') || (z=='CALAG') || (z=='CALDG'))
			{
				var url = "<?=ROOT?>container_alihkapal/save_request_alihkapal";
			}
			
			$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:a,port:b},function(data){
             var obj = jQuery.parseJSON(data);
             if ((obj.rc=="S") || (obj.rc=="OK")){
                 var notification = new NotificationFx({
                        message : '<p>Approve successfully</p>',
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'success', // notice, warning, error or success 
                        onClose : function() {
						  window.open("<?=ROOT?>approval_request/new_main_approval","_self");
					   }
                });
                 notification.show();
             }
             else {
                 var notification = new NotificationFx({
                        message : '<p>Failed</p><br/>'+obj.rcmsg,
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'error' // notice, warning, error or success 
						,
						onClose : function() {
						  window.open("<?=ROOT?>approval_request/new_main_approval","_self");
					   }
                });
             }
        });
		} else {
			alert("cancel");
		}
   }
	
	function searchRequest(page)
	{
		var url = "<?=ROOT?>approval_request/search_table2/"+$("#search").val();
		var limit = $("#pagelimit").val();
		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',page:page,limit:limit});
	}
	
</script>

<script>
	//search table js
	function load_table()
	{
		var url = "<?=ROOT?>approval_request/search_table2";
		var limit = $("#pagelimit").val();
		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',page:1,limit:limit});		
	}
	
	$( document ).ready(function() {
		load_table();
		//autoload
		//var intervalID = setInterval(function(){load_table();}, 20000);
	});
</script>
			
			<div class="row" id="tabledata">
			
			</div>
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
	
	<div id="dialogReject" style="display:none">
		<table class="tablebase">
		<tr>
			<td width="130">Request Number</td>
			<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td>
			<span id="reqnum"></span>
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
				<input type="hidden" id="request_num">
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			&nbsp</td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="button" value="CONFIRM REJECT" class="btn btn-primary" id="confirm_reject"></td>
		</tr>
		</table>
	</div>

	<script>
	
	function rejectD(a)
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
	</script>