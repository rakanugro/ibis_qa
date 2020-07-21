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
				<h2 class="pull-left">Receiving & SP2 Card List</h2>
			</header>

			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="example1">
						<thead>
							<tr>
								<th>NO</th>
								<th>NOMOR REQUEST</th>
								<th>TANGGAL REQUEST</th>
								<th>STATUS</th>
								<th>CUSTOMER</th>
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

<script>
	$('[data-toggle="tooltip"]').tooltip();
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/receivingspcard/getListRec?",
			data: {},
			success: function(data) {
				//console.log(data);
				var obj = JSON.parse(JSON.parse(data));
				var arr = [];
				var jmlresponse = obj['result']['length'];

				// for (i = 0; i < jmlresponse; i++) {
				// 	var no = 1;
				// 	var no_req = obj['result'][i]['no'];
				// 	var req_date = obj['result'][i]['reqdate'];
				// 	var req_nota = obj['result'][i]['nota'];
				// 	var nota_cust_name = obj['result'][i]['nota_cust_name'];
				// 	var reff_name = obj['result'][i]['nota_cust_name'];
				// }
				var nomor = 1;
				obj['result'].forEach(function(abc) {
					if (abc.nota == "2") {
						var status = "DELIVERY";
					} else if (abc.nota == "1") {
						var status = "RECEIVING";
					}
					table.append(
						'<tr>' +
						'<td>' + nomor++ + '</td>' +
						'<td>' + abc.no + '</td>' +
						'<td>' + abc.reqdate + '</td>' +
						'<td>' + status + '</td>' +
						'<td>' + abc.cust_name + '</td>' +
						'<td style="font-size: 15.7px;">' +
						'<a class="btn btn-danger print-log" data-id="' + abc.no + '" target="_blank" data-toggle="tooltip" title="Print Data" href="<?= apiUrl ?>/print/printRDCardNPKS/' + abc.branch_code + '/' + abc.nota + '/' + abc.id + '"><span class="glyphicon glyphicon-print"></span></a>' +
						'</td>' +
						'</tr>'
					);

				});

				$("#example1").DataTable();
				$.unblockUI();
			}
		});

		$(document).on("click", ".print-log", function() {
			var id = $(this).data('id');
			print_invoice_log(id);
		});
	});
</script>