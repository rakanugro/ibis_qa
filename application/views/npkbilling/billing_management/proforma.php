
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>
<script src="<?=CUBE_?>js/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />


<style type="text/css">

.upload_info {
    font-size: small;
    font-style: italic;
    float: right;
}
.hidden_content {
	display: none;
}
</style>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Proforma</h2>
									
					<div id="reportrange" class="pull-right daterange-filter">
						<i class="icon-calendar"></i>
						<span></span> <b class="caret"></b>
					</div>
				</header>
									
				<div class="main-box clearfix">
					<div class="modal-body">
						<table id="example1" class="table table-striped table-hover" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>REQUEST NUMBER</th>
									<th>PROFORMA NUMBER</th>
									<th>DEBITUR</th>
									<th>REQUEST DATE</th>
									<th>STATUS</th>
									<th>FILE</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-approve">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Informasi</h4>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin?&hellip;</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button id="btn-modal-approve" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-reject">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Informasi</h4>
				</div>
				<div class="modal-body" style="min-height: 13vh;">
					<!-- <p>Apakah anda yakin?&hellip;</p> -->
					<div class="col-xs-6 hidden_content">
						<label>Remarks</label>
						<input id="DOC_NO" name="DOC_NO" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40">
					</div>
					<div class="col-xs-12">
						<label>Upload Dokumen</label>
						<input type="file" accept=".pdf" name="DOC_NAME" id="DOC_NAME" doc_name="" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc()">
					</div>
					<input type="hidden" id="DOC_PATH" name="DOC_PATH" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
					<input type="hidden" id="DOC_BASH" name="DOC_BASH" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
					<input type="hidden" id="DOC_ID" name="DOC_ID" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button id="btn-modal-reject" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");
		//var apiUrl = 'http://10.88.48.33/api/public';

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/proforma/getListProforma?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
	 	  		var arr =[];
	 			var jmlresponse = obj['result'];
	 			// console.log(obj);
		    	// console.log(data);
	 			// console.log(jmlresponse);
				
				var no = 1;
				if (jmlresponse == '') {
					$.unblockUI();
				}else{

					obj['result'].forEach(function(abc) {
						if (abc.nota_status == '2' || abc.nota_status == '3') {
							var isDisabled = 'disabled';
						} 
						if (abc.doc_path == '' || abc.doc_path == undefined) {
							var isHidden = 'hidden_content';
						}
						// console.log(abc.doc_path);
					    table.append(
					       '<tr>' +
								'<td>'+ no++ +'</td>' +
							    // '<td style="display:none;">'+ abc.nota_id +'</td>' +
							    '<td>'+ abc.nota_req_no +'</td>' +
							    '<td>'+ abc.nota_no +'</td>' +
							    '<td>'+ abc.nota_cust_name +'</td>' +
							    '<td>'+ abc.nota_date +'</td>' +
							    '<td>'+ abc.reff_name +'</td>' +
							    '<td>'+ 
							    	'<a class=\'btn btn-danger print_log '+ isHidden +'\' target="_blank" href="<?=apiUrl?>/'+ abc.doc_path +'"><span class="glyphicon glyphicon-file" title="Lihat Dokumen Reject"></span></a>'+ "&nbsp"+
							    '</td>'+
							    '<td>'+
									'<a class=\'btn btn-danger print_log\' data-id="'+abc.nota_req_no+'" target="_blank"  href="<?=apiUrl?>/print/proforma2/'+ abc.nota_id +'"><span class="glyphicon glyphicon-print" title="Print Proforma"></span></a>'+ "&nbsp"+
									'<a class="btn btn-primary open-AddBookDialogReject" href="#" data-id="'+abc.nota_real_no+'" data-proforma="'+abc.nota_no+'" data-toggle="modal" data-target="#modal-reject" '+isDisabled+'><span class="glyphicon glyphicon-remove" title="Reject Proforma"></span></a>'+ "&nbsp"+
									'<a class="btn btn-success open-AddBookDialogApprove"  href="#" data-id="'+abc.nota_id+'" data-toggle="modal" data-target="#modal-approve" '+isDisabled+'><span class="glyphicon glyphicon-send" title="Approve Proforma"></span></a>'+ "&nbsp"+
								'</td>'+
							'</tr>'
				        );

			       	});
				}

			    $("#example1").DataTable();
				$.unblockUI();	
		    }
		});
	});

	$(document).on("click", ".open-AddBookDialogApprove", function () {
		var id = $(this).data('id');
		$('#btn-modal-approve').click(function(){ 
			approveProforma(id); 
			approve_proforma_log(id); 
			return false; 
		});
	});

	$(document).on("click", ".open-AddBookDialogReject", function () {
		var id = $(this).data('id');
		var proforma_no = $(this).data('proforma')
		// console.log(id);
		$('#btn-modal-reject').click(function(){ 

			var doc_no 		= $('#DOC_NO').val();
			var doc_path 	= $('#DOC_PATH').val();
			var doc_bash 	= $('#DOC_BASH').val();
			var doc_id 		= $('#DOC_ID').val();
			var doc_name 	= $('#DOC_NAME').attr("doc_name");

			if (doc_no != '' || doc_name != '' || doc_no != 'undefined' || doc_name != 'undefined') {
				var temp = {
					"DOC_ID"	: doc_id,
					"REQ_NO"	: proforma_no,
					"DOC_NO"	: doc_no,
					"DOC_NAME"	: doc_name,
					"PATH"		: doc_path,
					"BASE64"	: doc_bash
				}
			}
            // console.log(temp);return;
			rejectProforma(id, proforma_no, temp); 
			reject_proforma_log(id); 
			return false; 
		});
	});

	$(document).on("click", ".print_log", function () {
		var id = $(this).data('id');
		print_proforma_log(id); 
	});

	function approveProforma(nota_id){
		$('#modal-approve').modal('hide');
		var url	= "<?=ROOT?>npkbilling/proforma/approve_proforma";

		$.blockUI();
		$.ajax({
			type: 'post',
			url: url,
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				"action" : "approvedProformaNota",
				"id" : nota_id
			},
			success:function(data){
				var obj = JSON.parse(JSON.parse(data));
				errorMsgEinv = obj.sendNotaTracking[0].response.arResponseDoc.esbBody[0].errorMessage;
				errorEinv = obj.sendNotaTracking[0].response.arResponseDoc.esbBody[0].errorCode;

				if (obj.Success == true) {
					if (errorEinv == "F") {
						var notification = new NotificationFx({
							message : '<p>'+obj.result+'</p><p>Proforma Number : '+ obj.nota_no +'</p><br/><p>Send Nota to E-Invoice : Failed</p>',
							layout : 'growl',
							effect : 'jelly',
							type : 'success' // notice, warning, error or success
						});
					} else {
						var notification = new NotificationFx({
							message : '<p>'+obj.result+'</p><br/><p>Proforma Number : '+ obj.nota_no +'</p><br/><p>Send Nota to E-Invoice : Success</p>',
							layout : 'growl',
							effect : 'jelly',
							type : 'success' // notice, warning, error or success
						});
					}

					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/proforma"; }, 3000);	
				} else {
					var notification = new NotificationFx({
						message : '<p>'+obj.result+'</p><br/><p>Error Message : <br>'+obj.sendNotaErrMsg+'</p>',
						layout : 'growl',
						effect : 'jelly',
						type : 'error' // notice, warning, error or success
					});
					$.unblockUI();
					alert('Data Gagal Disimpan;');
				}

			}
		});
		$.unblockUI();
	}

	function rejectProforma(nota_real_no, proforma_no, file){
		$('#modal-reject').modal('hide');
		var url	= "<?=ROOT?>npkbilling/proforma/reject_proforma";
		$.blockUI();

		// var proforma_no = "";
		// var file = "";
		var arrData = [];
		var arrData = {
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			"action" : "rejectedProformaNota",
			"req_no" : nota_real_no,
		}

		// console.log(arrData);

		if (proforma_no != '') {
			arrData = {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				"action" 		: "rejectedProformaNota",
				"req_no" 		: nota_real_no,
				"proforma_no"	: proforma_no,
				"file"			: file
			}
		}

		console.log(arrData);
		// return;

		$.ajax({
			type: 'post',
			url: url,
			data: arrData,
			success:function(data){
				var obj = JSON.parse(data);
				var response = JSON.parse(obj.data);
				// console.log(response);
				
				if (obj.success == "S") {
					var notification = new NotificationFx({
						message : '<p>'+response.result+'</p><br/><p>Nomor Request : <b>'+response.no_req+'</b></p>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					$.unblockUI();

					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/proforma"; }, 3000);	
				} else {
					var notification = new NotificationFx({
						message : '<p>'+response.result+'</p><br/><p>Error Message : <br>'+response.sendNotaErrMsg+'</p>',
						layout : 'growl',
						effect : 'jelly',
						type : 'error' // notice, warning, error or success
					});
					$.unblockUI();

					// setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/proforma"; }, 3000);
				}

			}
		});
		$.unblockUI();
	}

	function print_proforma_log(id) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/print_proforma_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 			: id,

			},
			success: function( data ) {
				console.log(data);
			}
		});
	}

	function approve_proforma_log(id) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/approve_proforma_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 			: id,

			},
			success: function( data ) {
				console.log(data);
			}
		});
	}

	function reject_proforma_log(id) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/reject_proforma_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 			: id,

			},
			success: function( data ) {
				console.log(data);
			}
		});
	}

	function encodedoc (){
		var inputf = document.getElementById('DOC_NAME').files[0];
		if (inputf != null) {
			var reader = new FileReader();
			reader.readAsArrayBuffer(inputf);
			reader.onloadend = function (oFREvent) {
				var byteArray = new Uint8Array(oFREvent.target.result);
				var file = (new Uint8Array(oFREvent.target.result)).subarray(0, 4); 
				var len = byteArray.byteLength;
				var binary = '';
				for (var i = 0; i < len; i++) {
					binary += String.fromCharCode(byteArray[i]);
				}
				byteArray = window.btoa(binary);
				var path = inputf.name;
				$("#DOC_PATH").val(path);
				$("#DOC_NAME").attr("doc_name",path);
				$("#DOC_BASH").val(byteArray);

				var code = "";
				for (var i = 0; i < file.length; i++) {
					code += file[i].toString(16);
				}

				if(code){
					switch (code) {
						case '89504e47':
							return 'image/png'
						case '25504446':
							// alert('application/pdf');
							$("#btn-show").prop('disabled', false);
						case "ffd8ffe0":
						case "ffd8ffe1":
						case "ffd8ffe2":
							return 'image/jpeg'
						default:
							alert('File harus PDF');
							$('#DOC_NAME').val('');
							$("#btn-show").prop('disabled', true);
					}
				}
			}
		}
	}

</script>
