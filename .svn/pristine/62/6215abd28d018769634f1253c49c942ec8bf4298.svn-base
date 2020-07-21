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


     
<div id="modalplaceholder"></div>
<div id="detail_container" name="detail_container" class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				<h2 class="pull-left"></h2>
			</header>

			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table class="table table-striped table-hover">

						<?php
							$tmpl = array (
								'table_open'          => '<table id="table-request" class="table table-hover">',
								'heading_row_start'   => '<tr class=\'clickableRow\'>',
								'heading_row_end'     => '</tr>',
								'heading_cell_start'   => '',
								'heading_cell_end'     => ''
						  );

							$this->table->set_template($tmpl);												
							echo $this->table->generate();
						?>
						<!-- <thead>
							<tr>
								<th><span>NO</span></a></th>
								<th><span>Number Request</span></a></th>
								<th><span>Vessel - Voyage</span></a></th>
								<th><span>Pelabuhan / Terminal</span></a></th>
								<th><span>Status</span></a></th>
								<th><span>View</span></a></th>
								<th><span>Print RBM</span></a></th>
								<th><span>Pranota</span></a></th>
								<th><span>Nota</span></a></th>
							</tr>
						</thead> -->
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="dialogViewReq"></div>

<!-- popup rejection -->
<div id="dialogReject" style="display:none">
	<form action="#" method="post" id="action_approval_rejection">
		<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
		<table class="tablebase">
			<tr>
				<td width="130">Request Number</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
				<!-- <span id="reqnum"></span> -->
				<input id="reqnum" name="reqnum" class="form-control" type="text" readonly="readonly">
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>
			<tr>
				<td width="130">Vessel - Voyage</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
				<input id="vessel_and_voyage" class="form-control" type="text" readonly="readonly">
				</td>
			</tr>				
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>		
			<tr>
				<td>Notes</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
					<textarea class="form-control" id="notes_rejection" name="note" placeholder="" title="Notes" cols="30"></textarea>
					<span style="font-size: 10px; font-style: italic; color: #e84e40;">*Max 255 karakter</span>
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>
			<tr>
				<td width="130">Document</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
				<input type="file" id="documment_rejection" name="documment_rejection" class="form-control">
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>	
			<tr>
				<td colspan="3" align="right"><input type="button" value="CONFIRM REJECT" class="btn btn-primary" id="confirm_reject"></td>
			</tr>
		</table>
	</form>
</div>
<!-- end: popup rejection -->

<!-- popup View rejection -->
<div id="viewDialogReject" style="display:none">
	<form action="#" method="post" id="view_approval_rejection">
		<table class="tablebase">
			<tr>
				<td width="130">Request Number</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
				<!-- <span id="reqnum"></span> -->
				<input id="view_reqnum" class="form-control" type="text" readonly="readonly">
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>
			<tr>
				<td width="130">Vessel - Voyage</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
				<input id="view_vessel_and_voyage" class="form-control" type="text" readonly="readonly">
				</td>
			</tr>				
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>		
			<tr>
				<td>Notes</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
					<textarea class="form-control" id="view_notes_rejection" placeholder="" title="Notes" cols="30" disabled="disabled"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp</td>
			</tr>
			<tr>
				<td width="130">Document</td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
				<td>
				<a href="#" id="file_reject"></a>
				</td>
			</tr>	
		</table>
		<!-- <br> -->
		<hr>
		<div>
			<div class="the_title_rejection">Notes History</div>
			<div id="rejection_history" style="float: left; width: 100%; font-size: 12px;">
			</div>
		</div>
	</form>
</div>
<!-- end: popup View rejection -->


<script>
	// Rejection popap
	function rejectAR(a, b)
	{
		$('#reqnum').val(a);
		$('#vessel_and_voyage').val(b);
		$('#dialogReject').dialog({modal:false, height:250,width:500,title: 'Reject RBM',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	}

	// View rejection popup
	// function viewRejectAR(a, b, c)
	// {
	// 	$('#view_reqnum').val(a);
	// 	$('#view_vessel_and_voyage').val(b);
	// 	$('#view_notes_rejection').val(c);
	// 	$('#viewDialogReject').dialog({modal:false, height:250,width:500,title: 'View Rejection RBM',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	// }

	// View rejection popup
	function viewRejectAR(a, b, c)
	{
		$('#view_reqnum').val(a);
		$('#view_vessel_and_voyage').val(b);
		$('#view_notes_rejection').val(c);
		$('#viewDialogReject').dialog({modal:false, height:300,width:500,title: 'View Rejection RBM',close: function( event, ui ) {$('a').removeAttr('disabled');}});

		$.ajax({
            dataType: 'json',
            type: 'POST',
            url: "<?=ROOT?>/rbm/view_rbm/"+a,
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
            beforeSend: function() {
                // $.blockUI();
                $('#view_reqnum').val('Loading ...');
                $('#view_vessel_and_voyage').val('Loading ...');
                $('#view_notes_rejection').val('Loading ...');
                $('#rejection_history').text('Loading ...');
                $('#file_reject').text('Loading ...');
            }
        }).done(function(response) {
        	$('#view_reqnum').val(response.result_data_rbm.REQUEST_ID);
        	$('#view_vessel_and_voyage').val(response.result_data_rbm.VESSEL+' / '+response.result_data_rbm.VOYAGE_IN+'-'+response.result_data_rbm.VOYAGE_OUT);
        	$('#view_notes_rejection').val(response.result_data_rbm.REJECT_NOTES);
			$('#rejection_history').text('');

			if (response.result_data_rbm.DO_FILE != null) {
				var doc = response.result_data_rbm.DO_FILE;
			} else {
				var doc = '#';
			}

			$('#file_reject').html('<a href="'+doc+'" style="color: blue;">Data</a>');

        	$.each(response.rejection_history, function(index, val) {
                // alert(val.HISTORY); 
                var nama_file = "";
                var file = val.FILE_UPLOAD;
                if (!val.FILE_UPLOAD) {
                	val.FILE_UPLOAD = "";
                } else {
                	nama_file = file.split("/");
                	if (nama_file[5]) {
                		nama_file = nama_file[5];
                	} else {
                		nama_file = "";
                	}
                }

                $('#rejection_history').append('<span style="float: left; width: 100%;">'+val.HISTORY+'<a href="'+val.FILE_UPLOAD+'" style="color: blue;"> '+nama_file+'</a></span>');
			});

        }).fail(function(response) {
        	alert(response);
            console.log('Failed');
        });
	}


	var table2 = $('#table-request').dataTable({
		'info': false,
		'sDom': 'lTfr<"clearfix">tip',
		'columnDefs': [
			{ type: 'date-dd-mmm-yyyy', targets: 2 },
			{ type: 'date-dd-mmm-yyyy', targets: 6 }
		],
		'oTableTools': {
			'aButtons': [
				{
					'sExtends':    'collection',
					'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
					'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
				}
			]
		},
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
	});


	// confrim reject
	$(document).on('click', '.comfirm_reject', function() {
		var reqnum = this.id;
		var load_data = "<?=ROOT?>rbm/load_data_rbm";

	    if (confirm('Do you want to confrim reject RBM ('+reqnum+') ?')) {
	        $.ajax({
	            // dataType: 'json',
	            type: 'POST',
	            url: "<?=ROOT?>/rbm/RejectApproveFinal",
	            data: {reqnum: reqnum, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
	            beforeSend: function() {
	                // $.blockUI();
	            }
	        }).done(function(data, status) {

	        	if (data.status == 'success') {
	        		alert(data.msg);
	        		// location.reload();
	        	} 
	        	else if (data.status == 'failed') {;
	        		alert(data.msg);
	        		$("#tabledata").load(load_data, function(){
	        			$.unblockUI();
	        		});
	        	}

	        	location.reload();

	        }).fail(function(data) {

	        	alert(data);
	            console.log('Failed');
	        });
	    }
	});

	// Reject RBM
	// $('#confirm_reject').on('click', function() {

	// 	var reqnum = $('#reqnum').val();
	// 	var note = $('#notes_rejection').val();
	// 	var load_data = "<?=ROOT?>rbm/load_data_rbm";
	// 	// var documment_rejection = $('#documment_rejection').val();

	// 	if( note == '') {
	// 		alert('Notes tidak boleh kosong !');
	// 		$('#notes_rejection').css('border','1px solid #f00').focus();
	// 		return false;
	// 	} else {

	// 		$.ajax({
	//             // dataType: 'json',
	//             type: 'POST',
	//             url: "<?=ROOT?>/rbm/rejected_approval",
	//             data: {reqnum: reqnum, note: note, '<?php //echo $this->security->get_csrf_token_name(); ?>' : '<?php //echo $this->security->get_csrf_hash(); ?>'},
	//             beforeSend: function() {
	//                 $.blockUI();
	//             }
	//         }).done(function(data) {

	//         	if (data == 'success') {
	//         		alert('Reject RBM successfully !');
	//         		/*$("#tabledata").load(load_data, function(){
	//         			$.unblockUI();
	//         		});*/
	// 				// $.unblockUI();
	// 				location.reload();
	//         	} 
	//         	else if (data == 'failed') {
	//         		alert('GAGAL !');
	//         	}

	//         }).fail(function(data) {

	//         	alert(data);
	//             console.log('Failed');
	//         });
	//     }
	// });

	// Reject RBM
	$("#confirm_reject").click(function(event) {
	    event.preventDefault();
	    var form_data = new FormData($('#action_approval_rejection')[0]);
		var reqnum = $('#reqnum').val();
		var note = $('#notes_rejection').val();
		// var load_data = "<?=ROOT?>rbm/load_data_rbm";
		// var documment_rejection = $('#documment_rejection').val();

		if( note == '') {
			alert('Notes tidak boleh kosong !');
			$('#notes_rejection').css('border','1px solid #f00').focus();
			return false;
		} else {

			$.ajax({
	            dataType: 'json',
	            url: "<?=ROOT?>/rbm/rejected_approval",
	            type: 'POST',
	            data: form_data,
				processData: false,
				contentType: false,
				cache: false,
	            // data: {reqnum: reqnum, note: note, '<?php // echo $this->security->get_csrf_token_name(); ?>' : '<?php // echo $this->security->get_csrf_hash(); ?>'},
	            beforeSend: function() {
	                $.blockUI();
	            }
	        }).done(function(data, status) {
	        	$.unblockUI();
	        	if (data.status == 'success') {
	        		alert(data.msg);
	        	} 
	        	else if (data.status == 'failed') {;
	        		alert(data.msg);
	        	}
	        	else if (data.status == 'error') {
	        		alert(data.msg);
	        	}	

	        	location.reload();

	        }).fail(function(data) {
	        	alert(data);
	            console.log('Failed');
	        });
	    }
	});

	$('#notes_rejection').bind('keydown paste', function() {
		$(this).removeAttr('style');
	});
					
</script>	