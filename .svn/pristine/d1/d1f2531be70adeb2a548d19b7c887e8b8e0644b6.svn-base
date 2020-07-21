
<!-- this page specific scripts -->
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/modalEffects.js"></script>
	
<script>

function clickDialog1(a)
{
	$('#dialogViewReq').load("<?=ROOT?>container/view_request/"+a)
	.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

function showFullReview(pathDoc, typeDoc){
	console.log('pathDoc: ' + pathDoc);
	console.log('typeDoc: ' + typeDoc);
	$('#frameDoc11').attr('src', pathDoc);
	
	$('#frameDoc12').attr('src', pathDoc);
	
	$('#frameDoc13').attr('src', pathDoc);
	$("#dialogMultiDoc").dialog({modal:false, height:500,width:650,title: 'View '+typeDoc+' file'});
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
	else if(b=='BKS'||b=='SPC') {
		$('#frameDoc3').attr('src', a);
		$("#dialogDoc3").dialog({modal:false, height:500,width:650,title: 'View Booking Shipping file'});
	}
	$('a').removeAttr('disabled');
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
<div id="dialogCancel" style="display:none">
		<table class="tablebase">
		<tr>
			<td width="130">Request Number</td>
			<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td>
			<input type="text" id="request_num" readonly />
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
				
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			&nbsp</td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="button" value="CONFIRM CANCEL" class="btn btn-primary" id="cancel_booking"></td>
		</tr>
		</table>
	</div>


<script>

function cancelOrder(a)
{
	$('#request_num').val(a);
	$('#reqnum').text(a);
	$('#dialogCancel').dialog({modal:false, height:250,width:500,title: 'Cancel Booking',close: function( event, ui ) {$('a').removeAttr('disabled');}});
}

$("#cancel_booking").click(function() {
	var notes = document.getElementById("notes").value;
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
	
	var r = confirm("Cancel Booking will delete all of your booking contains (request, container, document, etc), Do you want to continue?");
	if (r == true) {
		var url = "<?=ROOT?>container/del_RequestAll";
		$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:request_num,REJECT_NOTES:notes}, function(data){
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