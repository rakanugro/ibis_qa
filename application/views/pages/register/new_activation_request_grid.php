
<!-- this page specific scripts -->
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/modalEffects.js"></script>

<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

var LIMIT_WARNING = 5;
var LIMIT_DANGER = 6;

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
	$('#dialogViewReq').load("<?=ROOT?>register/view_request/"+a)
	.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

function syncD(z){
	var txt;
	var r = confirm("Do you want to sync?");
	if (r == true) {
		
		var url = "<?=ROOT?>register/sync_customer";
		
		$.blockUI();
		
		$.ajax({
			type: "POST",
			url: url,
			data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',customer_id:z },
			timeout: 150000, // in milliseconds
			success: function(data) {
				$.unblockUI();
				alert(data);
				$('a').removeAttr('disabled');
				window.open("<?=ROOT?>register/customer_approval","_self");
			},
			error: function(request, status, err) {
				$.unblockUI();
				$('a').removeAttr('disabled');
				window.open("<?=ROOT?>register/customer_approval","_self");
				
				if(status == "timeout") {
					//gotoDir(pmcat_id, pcat_id);
				}
			}
		});
	} else {
		$('a').removeAttr('disabled');
	}
}

function approveD(z)
{
	var txt;
	var r = confirm("Do you want to approve?");
	if (r == true) {
		
		var url = "<?=ROOT?>register/approve_customer";
		
		$.blockUI();
		
		$.ajax({
			type: "POST",
			url: url,
			data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',customer_id:z },
			timeout: 150000, // in milliseconds
			success: function(data) {
				$.unblockUI();
				alert(data);
				window.open("<?=ROOT?>register/customer_approval","_self");
				$('a').removeAttr('disabled');
			},
			error: function(request, status, err) {
				window.open("<?=ROOT?>register/customer_approval","_self");
				$('a').removeAttr('disabled');			
			
				if(status == "timeout") {
					//gotoDir(pmcat_id, pcat_id);
				}
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
	var limitWarning = LIMIT_WARNING * 86400;
	var limitDanger = LIMIT_DANGER * 86400;
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
	if (seconds > 0){
	var numdays = Math.floor(seconds/ 86400);
	var numhours = Math.floor(((seconds % 31536000) % 86400) / 3600);
	var numminutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
	var numseconds = Math.round( (((seconds % 31536000) % 86400) % 3600) % 60 );
	var textnumdays = '';
	if (numdays > 0){
		var textnumdays = numdays + " d ";
	}
	return textnumdays + "<span class='clock_text'>" + numhours + ":" + numminutes + ":" + numseconds + "</span> s";
	} else{
		 return "<span class='clock_text'>Aktivasi<span><br /><span class='clock_text'>Time Out</span>";
	}
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
.digitalfont {
    font-family: 'Digital-7', sans-serif;
}
.font25 {font-size: 25px;}
.font16 {font-size: 16px;}
.font14 {font-size: 14px;}
.font12 {font-size: 12px;}
.font10 {font-size: 10px;}
</style>


<div class="col-lg-12">
	<div class="main-box clearfix">
		<header class="main-box-header clearfix">
			<h2 class="pull-left"><u>Daftar Pelanggan yang Diaktivasi tanpa Registrasi di CDM</u></h2>

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


<script>

function rejectD(a)
{
	$('#cust_num').val(a);
	$('#custnum').text(a);
	$('#dialogReject').dialog({modal:false, height:250,width:500,title: 'Reject Request',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

$("#confirm_reject").click(function() {
	var notes = $("#notes").val();
	var cust_num = $("#cust_num").val();

	if(cust_num=="")
	{
		alert("custumer number empty");
		$("#cust_num").focus();
		return false;
	}

	if(notes=="")
	{
		alert("notes empty");
		$("#notes").focus();
		return false;
	}

	var r = confirm("Do you want to reject ?");
	if (r == true) {
		var url = "<?=ROOT?>register/reject_request";
		$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',cust_num:cust_num,REJECT_NOTES:notes}, function(data){
			alert(data);
			location.reload();
		});
		$('a').removeAttr('disabled');
	} else {
		alert("cancel");
		$('a').removeAttr('disabled');
	}
});
</script>
