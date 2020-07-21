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
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2>Create New</h2>
				<i>(Please click create to make a new Stripping)</i>
			</header>

			<div class="main-box-body clearfix">
				<form class="form-inline" role="form" action="<?= ROOT ?>npksbilling/stripping/create_stripping">
					<button type="submit" id="submit_form" onclick="" class="btn btn-success">Create</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				<h2 class="pull-left">List Stripping</h2>
			</header>
			<input type="hidden" id="STRIPP_ID_NOTA">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="example1">
						<thead>
							<tr>
								<th>NO</th>
								<th>NOMOR REQUEST</th>
								<th>TANGGAL REQUEST</th>
								<th>CARGO OWNER</th>
								<th>VESSEL NAME</th>
								<th>STATUS</th>
								<th>ACTIONS</th>
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

<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Informasi</h4>
			</div>
			<div class="modal-body">
				<p>Apakah anda yakin ?&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-modal-kirim" class="btn btn-primary">Kirim</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
			async: false,
			url: "<?= ROOT ?>npksbilling/stripping/get_nota_id",
			type: 'GET',
			data: {},
			success: function(data) {
				var obj = JSON.parse(JSON.parse(data));
				if (obj == null) {
					alert('ESB not Connected');
					$.unblockUI();
				} else {
					if (obj.result[0]) {
						$('#STRIPP_ID_NOTA').val(obj.result[0].nota_id);
						$("#STRIPP_ID_NOTA").val();
					} else {
						$('#STRIPP_ID_NOTA').val(4);
						$("#STRIPP_ID_NOTA").val();
					}
				}
			}
		});

		var id_nota = $("#STRIPP_ID_NOTA").val();
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/stripping/getList/" + id_nota,
			data: {},
			success: function(data) {
				var obj = JSON.parse(JSON.parse(data));
				var no = 1;
				obj.result.forEach(function(stripp) {
					//var mark = (rec.stripp_mark)? rec.stripp_mark : "";
					var status = ((stripp.stripp_status != 1) && (stripp.stripp_status != 4)) ? "disabled" : "";
					table.append(
						'<tr>' +
						'<td>' + no++ + '</td>' +
						'<td>' + stripp.stripp_no + '</td>' +
						'<td>' + stripp.stripp_date + '</td>' +
						'<td>' + stripp.stripp_cust_name + '</td>' +
						'<td>' + stripp.stripp_vessel_name + '</td>' +
						'<td style="font-weight:bold;"> ' + stripp.reff_name + '</td>' +
						//'<td>'+ mark +'</td>' +
						'<td>' +
						'<a class="btn btn-success open-AddBookDialog ' + status + '" href="#" data-id="' + stripp.stripp_id + '" data-nota_id="' + stripp.stripp_nota + '" data-bcid="' + stripp.stripp_branch_id + '" data-bcode="' + stripp.stripp_branch_code + '" data-toggle="modal" title="Send Approval" data-target="#modal-default"><span class="glyphicon glyphicon-send"></span></a>' + "&nbsp" + "&nbsp" + "&nbsp" +
						'<a class="btn btn-primary" href="<?= ROOT ?>npksbilling/stripping/view/' + stripp.stripp_id + '" title="Lihat Data"><span class="glyphicon glyphicon-list-alt"></span></a>' + "&nbsp" + "&nbsp" +
						'<a class="btn btn-danger ' + status + '" href="<?= ROOT ?>npksbilling/stripping/update/' + stripp.stripp_id + '" data-toggle="tooltip" title="Update Data"><span class="glyphicon glyphicon-edit"></span></a>' + "&nbsp" + "&nbsp" + "&nbsp" +
						'</td>' +
						'</tr>'
					);
				});
				$("#example1").DataTable();
				$.unblockUI();
			}
		});

		$(document).on("click", ".open-AddBookDialog", function() {
			var id = $(this).data('id');
			var id_nota = $(this).data('nota_id');
			var branch_id = $(this).data('bcid');
			var branch_code = $(this).data('bcode');
			console.log(id);
			$('#btn-modal-kirim').click(function() {
				send(id, id_nota, branch_id, branch_code);
				return false;
			});
		});

		function send(id, id_nota, branch_id, branch_code) {
			$.blockUI();
			$('#modal-default').modal('hide');
			$.ajax({
				type: "GET",
				url: "<?= ROOT ?>npksbilling/stripping/send/" + id + "/" + id_nota + "/" + branch_id + "/" + branch_code,
				success: function(data) {
					$.unblockUI();
					var json = JSON.parse(data);
					if (json.success == "S") {
						resp = JSON.parse(json.data);
						no_req = resp.no_req;
						if (resp.Success == true) {
							alert('Request berhasil terkirim..');
							sendstripping_log(no_req);
							window.location = "<?= ROOT ?>npksbilling/stripping";
						} else {
							alert(resp.result_msg);
						}
					}
				}
			})
		}

		function sendstripping_log(no_req) {

			$.ajax({
				url: "<?= ROOT ?>npksbilling/transaction_log/sendstripping_log",
				type: 'POST',
				//dataType: 'json',
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
					no_req: no_req,

				},
				success: function(data) {
					console.log(data);
					if (data != null) {
						console.log('Data Tersimpan ke LOG');
					}
				}
			});
		}
	});
</script>