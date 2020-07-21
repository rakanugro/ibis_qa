<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.theme.css" />
<script src="<?= CUBE_ ?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?= CUBE_ ?>js/jquery.dataTables.shortingEuro.js"></script>
<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>
<script src="<?= JSQ ?>jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<!-- global scripts -->
<style>
	div.DTTT.btn-group {
		display: none !important;
	}

	.label {
		display: inline-block;
	}

	a.disabled {
		pointer-events: none;
		cursor: default;
	}
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				<h2 class="pull-left">Proforma List</h2>
			</header>

			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="example1">
						<thead>
							<tr>
								<th>NO</th>
								<th>NOMOR REQUEST</th>
								<th>NOMOR PROFORMA</th>
								<th>DEBITUR</th>
								<th>TANGGAL REQUEST</th>
								<th>STATUS</th>
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
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
				<button id="btn-modal-approve" class="btn btn-primary">Ya</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-reject">
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
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
				<button id="btn-modal-reject" class="btn btn-primary">Ya</button>
			</div>
		</div>
	</div>
</div>
<!-- <div class="modal fade" id="modal-reject">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Informasi</h4>
			</div>
			<div class="modal-body" style="min-height: 13vh;"> -->
<!-- <p>Apakah anda yakin?&hellip;</p> -->
<!-- <div class="col-xs-6 hidden_content">
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
</div> -->

<script>
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");
		//var apiUrl = 'http://10.88.48.33/api/public';

		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/proforma/getListProforma?",
			data: {},
			success: function(data) {
				var obj = JSON.parse(JSON.parse(data));
				var arr = [];
				var jmlresponse = obj['result']['length'];
				// console.log(obj);
				// console.log(data);
				//console.log(jmlresponse);
				// var isDisabled2 = '';
				// var isDisabled3 = '';
				var no = 1;
				obj['result'].forEach(function(abc) {
					if (abc.nota_req_no.substring(0, 3) == 'CNL') {
						var hide = 'style="display:none"';
					}
					if (abc.nota_status == '4' || abc.nota_status == '3') {
						var isDisabled1 = 'disabled';
						var isDisabled2 = 'disabled';
						var isDisabled3 = 'disabled';
					} else if (abc.nota_status == '2' || abc.nota_status == '5') {
						var isDisabled1 = 'disabled';
						var isDisabled2 = 'disabled';
					} else {
						var isDisabled3 = 'disabled';
					}
					if (abc.doc_path == '' || abc.doc_path == undefined) {
						var isHidden = 'hidden_content';
					}
					// console.log(abc.doc_path);
					table.append(
						'<tr>' +
						'<td>' + no++ + '</td>' +
						// '<td style="display:none;">'+ abc.nota_id +'</td>' +
						'<td>' + abc.nota_req_no + '</td>' +
						'<td>' + abc.nota_proforma_no + '</td>' +
						'<td>' + abc.nota_cust_name + '</td>' +
						'<td>' + abc.nota_req_date + '</td>' +
						'<td>' + abc.reff_name + '</td>' +
						'<td>' +
						'<a class=\'btn btn-danger print_log\' data-id="' + abc.nota_req_no + '" target="_blank"  href="<?= apiUrl ?>/print/proformaNPKS/' + abc.nota_id + '"><span class="glyphicon glyphicon-print" title="Print Proforma"></span></a>' + "&nbsp" +
						'<a class="btn btn-primary open-AddBookDialogReject" href="#" data-id="' + abc.nota_id + '" data-proforma="' + abc.nota_no + '" data-toggle="modal" data-target="#modal-reject" ' + isDisabled1 + '><span class="glyphicon glyphicon-remove" title="Reject Proforma"></span></a>' + "&nbsp" +
						'<a class="btn btn-success open-AddBookDialogApprove"  href="#" data-id="' + abc.nota_id + '" data-toggle="modal" data-target="#modal-approve" ' + isDisabled2 + '><span class="glyphicon glyphicon-ok" title="Approve Proforma"></span></a>' + "&nbsp" +
						'<a class=\'btn btn-primary print-log\' data-id="' + abc.nota_req_no + '" href="<?= ROOT ?>npksbilling/payment_cash/view_payment/' + abc.nota_id + '-' + 'nota' + '/N"' + isDisabled3 + ' ' + hide + '><span class="glyphicon glyphicon-list-alt" title="Confirmation"></span></a>' +
						'</td>' +
						'</tr>'
					);

				});

				$("#example1").DataTable();
				$.unblockUI();
			}
		});
	});

	$(document).on("click", ".open-AddBookDialogApprove", function() {
		var id = $(this).data('id');
		$('#btn-modal-approve').click(function() {
			approveProforma(id);
			return false;
		});
	});

	$(document).on("click", ".open-AddBookDialogReject", function() {
		var id = $(this).data('id');
		$('#btn-modal-reject').click(function() {
			rejectProforma(id);
			return false;
		});
		// var proforma_no = $(this).data('proforma');
		// console.log(id);
		// alert(proforma_no);
		// $('#btn-modal-reject').click(function() {

		// 	var doc_no = $('#DOC_NO').val();
		// 	var doc_path = $('#DOC_PATH').val();
		// 	var doc_bash = $('#DOC_BASH').val();
		// 	var doc_id = $('#DOC_ID').val();
		// 	var doc_name = $('#DOC_NAME').attr("doc_name");

		// 	if (doc_no != '' || doc_name != '' || doc_no != 'undefined' || doc_name != 'undefined') {
		// 		var temp = {
		// 			"DOC_ID": doc_id,
		// 			"REQ_NO": proforma_no,
		// 			"DOC_NO": doc_no,
		// 			"DOC_NAME": doc_name,
		// 			"PATH": doc_path,
		// 			"BASE64": doc_bash
		// 		}
		// 	}
		// 	// console.log(temp);return;
		// 	rejectProforma(id, proforma_no, temp);
		// 	reject_proforma_log(id);
		// 	return false;
		// });
	});

	$(document).on("click", ".print_log", function() {
		var id = $(this).data('id');
		print_proforma_log(id);
	});

	function approveProforma(nota_id) {
		$.blockUI();
		$('#modal-approve').modal('hide');
		// $.blockUI();
		var url = "<?= ROOT ?>npksbilling/proforma/approve_proforma";
		$.ajax({
			type: 'POST',
			url: url,
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				"action": "approvalProformaPLG",
				"id": nota_id
			},
			success: function(data) {
				var obj = JSON.parse(JSON.parse(data));
				console.log(data);
				if (obj.result === "Success, approved!") {
					var notification = new NotificationFx({
						message: '<p>' + obj.result + '</p><br/><p>Proforma Number : ' + obj.nota_no + '</p><br/><p>Send Nota to E-Invoice : Success</p>',
						layout: 'growl',
						effect: 'jelly',
						type: 'success' // notice, warning, error or success
					});
					approveproforma_log(obj.nota_no);
				} else {
					var notification = new NotificationFx({
						message: '<p>' + obj.result + '</p><p>Proforma Number : ' + obj.nota_no + '</p><br/><p>Send Nota to E-Invoice : Failed</p>',
						layout: 'growl',
						effect: 'jelly',
						type: 'success' // notice, warning, error or success
					});
					$.unblockUI();
				}
				setTimeout(function() {
					window.location = "<?= ROOT ?>npksbilling/proforma";
				}, 3000);

				$.unblockUI();
			}
		});
	}

	function rejectProforma(nota_id) {
		$.blockUI();
		$('#modal-reject').modal('hide');
		//$.blockUI();
		var url = "<?= ROOT ?>npksbilling/proforma/reject_proforma";

		// var proforma_no = "";
		// var file = "";
		var arrData = [];
		var arrData = {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			"action": "approvalProformaPLG",
			"id": nota_id
		}

		// console.log(arrData);

		// if (proforma_no != '') {
		// 	arrData = {
		// 		'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
		// 		"action": "approvalProformaPLG",
		// 		"id": nota_id
		// 	}
		// }

		console.log(arrData);
		// return;

		$.ajax({
			type: 'post',
			url: url,
			data: arrData,
			success: function(data) {
				var obj = JSON.parse(JSON.parse(data));
				// console.log(response);

				if (obj.result === "Success, rejected!") {
					var notification = new NotificationFx({
						message: '<p>' + obj.result + '</p><br/><p>Nomor Request : <b>' + obj.nota_no + '</b></p>',
						layout: 'growl',
						effect: 'jelly',
						type: 'success' // notice, warning, error or success
					});
					rejectproforma_log(obj.nota_no);
					$.unblockUI();

					setTimeout(function() {
						window.location = "<?= ROOT ?>npksbilling/proforma";
					}, 3000);
				} else {
					var notification = new NotificationFx({
						message: '<p>' + obj.result + '</p><br/>',
						layout: 'growl',
						effect: 'jelly',
						type: 'error' // notice, warning, error or success
					});
				}
				$.unblockUI();
			}
		});
	}

	function approveproforma_log(no_req) {

		$.ajax({
			url: "<?= ROOT ?>npksbilling/transaction_log/approveproforma_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req: no_req

			},
			success: function(data) {
				if (data != null) {
					console.log('Data Tersimpan ke LOG')
				}

			}
		});
	}

	function rejectproforma_log(no_req) {

		$.ajax({
			url: "<?= ROOT ?>npksbilling/transaction_log/rejectproforma_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req: no_req

			},
			success: function(data) {
				if (data != null) {
					console.log('Data Tersimpan ke LOG')
				}

			}
		});
	}

	function print_proforma_log(id) {
		$.ajax({
			url: "<?= ROOT ?>npksbilling/transaction_log/print_proforma_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req: id,

			},
			success: function(data) {
				console.log(data);
			}
		});
	}

	function encodedoc() {
		var inputf = document.getElementById('DOC_NAME').files[0];
		if (inputf != null) {
			var reader = new FileReader();
			reader.readAsArrayBuffer(inputf);
			reader.onloadend = function(oFREvent) {
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
				$("#DOC_NAME").attr("doc_name", path);
				$("#DOC_BASH").val(byteArray);

				var code = "";
				for (var i = 0; i < file.length; i++) {
					code += file[i].toString(16);
				}

				if (code) {
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