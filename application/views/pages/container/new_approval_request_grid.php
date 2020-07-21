
<!-- this page specific scripts -->
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/modalEffects.js"></script>

<script>
$(document).ready(function() {
	///sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

var LIMIT_WARNING = 1;
var LIMIT_DANGER = 3;

// Variables
var local_time;
var difference_time = false;

$(document).ready(function(){

	$( "#table-approval a" ).on( "mouseup", function() {
		$( "#table-approval a" ).attr('disabled','disabled');
	});

	$("#search").keyup(function(event){
		if(event.keyCode == 13){
			searchRequest();
		}
	});

	$(".open-popup").fullScreenPopup({
		bgColor: '#e67e22'
	});

	// function to counting req date
	local_time = new Date();
	countingClock();
});

function clickDialog1(a)
{
	$('#dialogViewReq').load("<?=ROOT?>container/view_request/"+a)
	.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

function clickDialog2(a)
{
	$('#dialogViewProforma').load("<?=ROOT?>container/view_proforma/"+a)
	.dialog({modal:false, height:600,width:1200,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

function showFullReview(pathDoc, typeDoc){
	console.log('pathDoc: ' + pathDoc);
	console.log('typeDoc: ' + typeDoc);
	$('#frameDoc11').attr('src', pathDoc);

	$('#frameDoc12').attr('src', pathDoc);

	$('#frameDoc13').attr('src', pathDoc);
	$("#dialogMultiDoc").dialog({modal:false, height:500,width:650,title: 'View '+typeDoc+' file'});
}

function toggleActivateApproveButton(no_req){
	var c='';
	$.each($("img[class=checktick][data-noreq="+no_req+"]"), function(){
		c =  c + $(this).attr('data-valid');
	});
	console.log('text valid: ' + c);
	var valid_c = (c.indexOf('N') == -1);
	console.log('status valid: ' + valid_c);
	if (valid_c){
		$("#BUTTONACTIVE-"+no_req+"").show(); $("#BUTTONINACTIVE-"+no_req+"").hide();
	} else {
		$("#BUTTONACTIVE-"+no_req+"").hide(); $("#BUTTONINACTIVE-"+no_req+"").show();
	}
}

function clickDialogDoc(a,b,c){
	console.log('a: ' + a);
	console.log('b: ' + b);
	console.log('c: ' + c);

	if((b=='NPE') ||(b=='DO')) {
		$('#frameDoc1').attr('src', a);
		$("#dialogDoc1").dialog({
			modal:false,
			height:550,
			width:950,//position:['middle',20],
			title: 'View '+b+' file test',
			buttons: { "Valid": function() {
				if (b=="NPE"){
					var flag_code = "npe_file_flag";
				} else if (b=="DO"){
					flag_code = "do_file_flag";
				}
				var this_obj = $(this);
				var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/Y";
				$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
					$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_tick.png").attr('data-valid', 'Y');
					toggleActivateApproveButton(c);
					this_obj.dialog("close");
				});
			}, "Not Valid": function() {
				if (b=="NPE"){
					var flag_code = "npe_file_flag";
				} else if (b=="DO"){
					flag_code = "do_file_flag";
				}
				var this_obj = $(this);
				var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/N";
				$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
					$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_help.png").attr('data-valid', 'N');
					toggleActivateApproveButton(c);
					this_obj.dialog("close");
				});
			}}
		});

	}
	else if((b=='PEB')||(b=='SPPB')) {
		$('#frameDoc2').attr('src', a);
		$("#dialogDoc2").dialog({
			modal:false,
			height:550,
			width:950,//position:['middle',20],
			title: 'View '+b+' file',
			buttons: { "Valid": function() {
				if (b=="PEB"){
					var flag_code = "peb_file_flag";
				} else if (b=="SPPB"){
					flag_code = "sppb_file_flag";
				}
				var this_obj = $(this);
				var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/Y";
				$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
					$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_tick.png").attr('data-valid', 'Y');
					toggleActivateApproveButton(c);
					this_obj.dialog("close");
				});
			}, "Not Valid": function() {
				if (b=="PEB"){
					var flag_code = "peb_file_flag";
				} else if (b=="SPPB"){
					flag_code = "sppb_file_flag";
				}
				var this_obj = $(this);
				var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/N";
				$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
					$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_help.png").attr('data-valid', 'N');
					toggleActivateApproveButton(c);
					this_obj.dialog("close");
				});
			}}
		});
	}
	else if(b=='BKS'||b=='SPC') {
		$('#frameDoc3').attr('src', a);
		$("#dialogDoc3").dialog({
			modal:false,
			height:550,
			width:950,//position:['middle',20],
			title: 'View Booking Shipping file',
			buttons: { "Valid": function() {
				if (b=="BKS"){
					var flag_code = "bookship_file_flag";
				} else if (b=="SPC"){
					flag_code = "sp_custom_file_flag";
				}
				var this_obj = $(this);
				var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/Y";
				$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
					$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_tick.png").attr('data-valid', 'Y');
					toggleActivateApproveButton(c);
					this_obj.dialog("close");
				});
			}, "Not Valid": function() {
				if (b=="BKS"){
					var flag_code = "bookship_file_flag";
				} else if (b=="SPC"){
					flag_code = "sp_custom_file_flag";
				}
				var this_obj = $(this);
				var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/N";
				$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
					$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_help.png").attr('data-valid', 'N');
					toggleActivateApproveButton(c);
					this_obj.dialog("close");
				});
			}}
		});
	}
	$('a').removeAttr('disabled');
}

function approveD(z,a,b)
{
	var txt;
	var r = confirm("Do you want to approve?");
	if (r == true) {
		if (z=='RECEIVING')
		{
			var url = "<?=ROOT?>container_receiving/save_request_receiving";
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
		$.blockUI();
		$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:a,port:b},function(data){
			$.unblockUI();
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
			 $("#BUTTONACTIVE-"+a+"").html('Approved');
			 $("#BUTTONREJECT-"+a+"").html('');
			// window.open("<?=ROOT?>approval_request/new_main_approval","_self");
			 $('a').removeAttr('disabled');
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
			notification.show();
			$('a').removeAttr('disabled');
		 }

	});
	} else {
		$('a').removeAttr('disabled');
	}
}

// represented as first day of January 2001
function countingClock() {
	$(".clock_container").each(function(){
		// get today date
		var today = new Date();

		// get request date
		var data_hidden = $(this).children('.req_date').html().split(" ");
		var req_dates = new Date(
			data_hidden[0], data_hidden[1]-1, data_hidden[2], data_hidden[3], data_hidden[4], data_hidden[5], 0
		);

		// get server time
		var sysdate_hidden = $(this).children('.sysdate').html().split(" ");
		var sysdate = new Date(
			sysdate_hidden[0], sysdate_hidden[1]-1, sysdate_hidden[2], sysdate_hidden[3], sysdate_hidden[4], sysdate_hidden[5], 0
		);

		// get difference with client local time
		if ( !difference_time) {
			difference_time = Math.round( (local_time - sysdate));
		}

		// get Virtual Clock based on Server Time
		var serverClock = new Date( (new Date()).getTime() - difference_time );
		//console.log('Current time: ');
		//console.log(serverClock);

		// get the difference
		//var timeDiff = today.getTime() - req_dates.getTime(); // BASE ON LOCAL TIME
		var timeDiff = serverClock.getTime() - req_dates.getTime(); // BASE ON SERVER TIME
		//showDate($(this).children('.clock_now'), today);
		//showDate($(this).children('.clock_req'), req_dates);
		showCount($(this).children('.clock_approval'), Math.abs( timeDiff /1000) );
	});
	var t = setTimeout(countingClock, 500);
}

function showCount(target_, seconds_target_){
	var limitWarning = LIMIT_WARNING * 3600;
	var limitDanger = LIMIT_DANGER * 3600;
	if ((seconds_target_ >= limitWarning) && (seconds_target_ < limitDanger)){
		target_.removeClass('label-info').addClass('label-warning')
	} else if (seconds_target_ >= limitDanger){
		target_.removeClass('label-info').addClass('label-danger')
	}
	target_.html(secondsToString(seconds_target_));
}

function showDate(target_, date_target_){
	target_.html(date_target_.toString());
}

function secondsToString(seconds){
	var numdays = Math.floor(seconds/ 86400);
	var numhours = Math.floor(((seconds % 31536000) % 86400) / 3600);
	var numminutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
	var numseconds = Math.round( (((seconds % 31536000) % 86400) % 3600) % 60 );
	var textnumdays = '';
	if (numdays > 0){
		var textnumdays = numdays + " d ";
	}
	return textnumdays + "<span class='clock_text'>" + numhours + ":" + numminutes + ":" + numseconds + "</span> s";
}

</script>

<style type="text/css">
.hidden_content {
	display:none;
}
.table th {
	text-align: left;
}
.clock_approval {
    height: 40px;
    display: inline-block;
    padding: 5px;
}
.clock_text {
	font-size: 20pt;
}
.default-font {
	font-family: 'Open Sans', sans-serif;
}
</style>


<div class="col-lg-12">
	<div class="main-box clearfix">
		<header class="main-box-header clearfix">
			<h2 class="pull-left">Request List</h2>

			<div class="filter-block pull-right">
				<div class="form-group pull-right">
					 <select id="pagelimit" name="pagelimit" onchange="searchRequest()" class="form-control">
					  <option value="1" <?php if($limit==10) echo "selected"?> >1</option>
					  <option value="10" <?php if($limit==10) echo "selected"?> >10</option>
					  <option value="20" <?php if($limit==20) echo "selected"?>>20</option>
					  <option value="30" <?php if($limit==30) echo "selected"?>>30</option>
					  <option value="40" <?php if($limit==40) echo "selected"?>>40</option>
					  <option value="50" <?php if($limit==50) echo "selected"?>>50</option>
					  <option value="100" <?php if($limit==100) echo "selected"?>>100</option>
					</select>
				</div>
				<div class="form-group pull-left">
					<input type="text" id="search" name="search" value="<?php echo $search?>" class="form-control" placeholder="Search...">
					<a onclick="searchRequest()"><i class="fa fa-search search-icon"></i></a>
				</div>
			</div>
		</header>

		<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<?php
							$tmpl = array (
								'table_open'          => '<table id="table-approval" class="table table-hover">',
								'heading_row_start'   => '<tr class=\'clickableRow\'>',
								'heading_row_end'     => '</tr>',
								'heading_cell_start'   => '',
								'heading_cell_end'     => ''
							);

							$this->table->set_template($tmpl);
							echo $this->table->generate();
						?>
					</table>
				</div>
				<div class="form-group">
					<?php echo "<b>Total $totallist Daftar, $totalpage Halaman</b>"?>
					<ul class="pagination pull-right">
						<li><a onclick="searchRequest('<?php if($page-1>0) echo ($page-1); else echo 1;?>');"><i class="fa fa-chevron-left"></i></a></li>
						<?php for($i=1;$i<=$totalpage;$i++) {?>
							<li><a onclick="searchRequest('<?php echo $i?>');"><?php echo $i?></a></li>
						<?php }?>
						<li><a onclick="searchRequest('<?php if($page+1>$totalpage) echo $page; else echo ($page+1);?>');"><i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</div>
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
<div id="dialogViewReq"></div>
<div id="dialogViewProforma"></div>


<script>

function rejectD(a)
{
	$('#request_num').val(a);
	$('#reqnum').text(a);
	$('#dialogReject').dialog({modal:false, height:250,width:500,title: 'Reject Request',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

$("#confirm_reject").click(function() {
	var notes = $("#notes").val();
	var request_num = $("#request_num").val();

	if(request_num=="")
	{
		alert("request num empty");
		$("#request_num").focus();
		return false;
	}

	if(notes=="")
	{
		alert("notes empty");
		$("#notes").focus();
		return false;
	}

	var r = confirm("Do you want to reject?");
	if (r == true) {
		$.blockUI();
		var url = "<?=ROOT?>container/reject_request";
		$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:request_num,REJECT_NOTES:notes}, function(data){
			alert(data);
			$.unblockUI();
			location.reload();
		});
		$('a').removeAttr('disabled');
	} else {
		alert("cancel");
		$('a').removeAttr('disabled');
	}
});
</script>
