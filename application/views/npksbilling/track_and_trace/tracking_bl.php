<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>
<script src="<?= CUBE_; ?>js/ipc/addressloading.js"></script>
<script src="<?= CUBE_; ?>js/ipc/validation.js"></script>
<script src="<?= CUBE_ ?>js/hogan.js"></script>
<script src="<?= CUBE_ ?>js/typeahead.min.js"></script>
<script src="<?= CUBE_ ?>js/jquery.datetimepicker.full.js"></script>
<script src="<?= CUBE_ ?>js/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/bootstrap/searchbt.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>js/sweetalert2/dist/sweetalert2.min.css" />

<style type="text/css">
	.upload_info {
		font-size: small;
		font-style: italic;
		float: right;
	}

	.hidden_content {
		display: none;
	}

	table#table_detail_bl {
		border-collapse: collapse;
		width: 100%;
	}

	table#table_detail_bl th,
	td {
		text-align: left;
		padding: 8px;
	}

	table#table_detail_bl tr:nth-child(even) {
		background-color: #f2f2f2;
	}
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">Search Request</h2>
				</header>
				<div class="main-box-body clearfix">
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete">Terminal</label>
						<select class="form-control" id="TERMINAL" name="TERMINAL">
							<option value="">-- Please Choose One --</option>
						</select>
					</div>
					<div class="form-group example-twitter-oss">
						<label>Tipe Kegiatan</label>
						<select name="TYPE_KEGIATAN" id="TYPE_KEGIATAN" class="form-control">
							<option value="">-- Please Choose One --</option>
							<option value="container">CONTAINER</option>
							<option value="barang">BARANG</option>
						</select>
					</div>
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete" id="barang" class="hidden_content">SI Number</label>
						<label for="exampleAutocomplete" id="container">Container Number</label>
						<input class="form-control" id="BL_NUMBER" name="BL_NUMBER" placeholder="Number">
					</div>
					<div class="form-group example-twitter-oss">
						<input type="button" onclick="search_tracktrace()" value="Search" id="search_tracktrace" name="search_tracktrace" class="btn btn-danger" />
						<input type="button" onclick="search_tracktracecrg()" value="Search" id="search_tracktracecrg" name="search_tracktracecrg" class="btn btn-danger hidden_content" />
						<input type="button" onclick="reset_input()" id="reset" name="reset" class="btn btn-primary" value="Reset" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row show_detail">
	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">History</h2>
				</header>
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="table_detail_bl">
							<thead>
								<tr>
									<th>No</th>
									<th>Nomor Container</th>
									<th>Activity</th>
									<th>Yard</th>
									<th>Block</th>
									<th>Date</th>
									<th>Nomor Request</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody id="tbodydetailbl">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row show_detailcrg">
	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">History</h2>
				</header>
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="table_detail_crg">
							<thead>
								<tr>
									<th>No</th>
									<th>NOMOR SI</th>
									<th>Activity</th>
									<th>DATE</th>
									<th>NOMOR REQUEST</th>
									<th>DATE REQUEST</th>
									<th>TOTAL</th>
									<th>USER</th>
								</tr>
							</thead>
							<tbody id="tbodydetailblcrg">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$.blockUI();

		$('#TYPE_KEGIATAN').on('change', function() {
			var kegiatan_type = $(this).val();
			if (kegiatan_type === 'container') {
				$('#barang').addClass('hidden_content');
				$('#search_tracktracecrg').addClass('hidden_content');
				$('#search_tracktrace').removeClass('hidden_content');
				$('#container').removeClass('hidden_content');

				//NO CONTAINER
				$('#BL_NUMBER').autocomplete({
					source: function(request, response) {
						console.log(request);
						$.ajax({
							url: "<?= ROOT ?>npksbilling/mdm/no_container",
							type: 'GET',
							dataType: 'json',
							data: {
								request: request.term,
								branch_id: $('#TERMINAL').find('option:selected').attr('brchid')
							},
							success: function(data) {
								response(data);
							}
						});
					},
					select: function(event, ui) {
						console.log(ui);
						$('#BL_NUMBER').val(ui.item.label);
						return false;
					}
				});

			} else if (kegiatan_type === 'barang') {
				$('#container').addClass('hidden_content');
				$('#barang').removeClass('hidden_content');
				$('#search_tracktracecrg').removeClass('hidden_content');
				$('#search_tracktrace').addClass('hidden_content');

				$('#BL_NUMBER').autocomplete({
					source: function(request, response) {
						var branch_id = $("#TERMINAL").find('option:selected').attr('brchid');
						$.ajax({
							url: "<?= ROOT ?>npksbilling/mdm/no_si/",
							type: 'GET',
							dataType: 'json',
							data: {
								request: request.term,
								branch_id: branch_id
							},
							success: function(data) {
								response(data);
							}
						});
					},
					select: function(event, ui) {
						console.log(ui);
						$('#BL_NUMBER').val(ui.item.label);
						return false;
					}
				});
			}
		});

		//TERMINAL
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/get_terminalList",
			success: function(data) {
				var obj = JSON.parse(data);
				var toAppend = '';
				for (var i = 0; i < obj.length; i++) {
					toAppend += '<option value="' + obj[i]['BRANCH_CODE'] + '" brchid="' + obj[i]['BRANCH_ID'] + '">' + obj[i]['TERMINAL_NAME'] + '</option>';
				}

				$('#TERMINAL').append(toAppend);
				$.unblockUI();
			}
		});

		// $('#example').DataTable();
	});

	$(document).ready(function() {
		$('.show_detail').hide();
		$('.show_detailcrg').hide();
		$("#btn_trackReceiving").click(function() {
			$("#modal_trackReceiving").modal();
		});
	});

	function reset_input() {
		$('#BL_NUMBER').val("");
		$('#TERMINAL').val("");
		$('#TYPE_KEGIATAN').val("");
	}


	function search_tracktracecrg() {
		$('.show_detail').hide();
		var terminal = $('#TERMINAL').find('option:selected').attr('brchid');
		var val = $('#TERMINAL').val();
		var type_kegiatan = $('#TYPE_KEGIATAN').val();
		var bl_number = $('#BL_NUMBER').val();

		if (val === "" || bl_number === "" || type_kegiatan == "") {
			Swal.fire({
				icon: 'error',
				title: 'Form harus diisi dengan lengkap !!!',
				showConfirmButton: false,
				timer: 1500
			})
			return false;
		}

		var arrdata = {
			"action": "trackAndTraceBrg",
			"data": [{
				"NO_SI": bl_number,
				"BRANCH_ID": terminal
			}]
		}
		console.log(arrdata);
		$.blockUI();
		var tableblcrg = $("#table_detail_crg").DataTable();
		// var table = $("#table_history_bl").DataTable();
		tableblcrg.clear().draw();
		// table.clear().draw();
		$.ajax({
			url: "<?= ROOT ?>npksbilling/tracking_bl/search_tracktrace",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrdata)
			},
			success: function(data) {
				// console.log(data['detail_bl']);
				var data_fix = JSON.parse(data['detail_bl']);
				// console.log(data_fix['_v']);
				if (data_fix == null) {
					Swal.fire({
						icon: 'error',
						title: 'Data Tidak Bisa Ditemukan!',
						showConfirmButton: false,
						timer: 1500
					})
					return false;
				} else {
					var obj_detail_bl = JSON.parse(data_fix['_v']);
					var fix = JSON.parse(atob(obj_detail_bl['result']));
					var tabledata = fix['result'][0];
					console.log(tabledata.length);
					var no = 1;
					for (var i = 0; i < tabledata.length; i++) {
						tableblcrg.row.add(
							$('<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_SI'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_ACTIVITY'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_DATE'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_NOREQ'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_DATE_REQ'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_TOTAL'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_USER'] + '</td>' +
								'<tr>')
						).draw();
					};
					$(".show_detailcrg").fadeIn();
				}
				$.unblockUI();
			}
		});
	}

	function search_tracktrace() {
		$('.show_detailcrg').hide();
		var terminal = $('#TERMINAL').find('option:selected').attr('brchid');
		var val = $('#TERMINAL').val();
		var type_kegiatan = $('#TYPE_KEGIATAN').val();
		var bl_number = $('#BL_NUMBER').val();

		if (val === "" || bl_number === "" || type_kegiatan == "") {
			Swal.fire({
				icon: 'error',
				title: 'Form harus diisi dengan lengkap !!!',
				showConfirmButton: false,
				timer: 1500
			})
			return false;
		}

		var arrdata = {
			"action": "trackAndTrace",
			"data": [{
				"NO_CONTAINER": bl_number,
				"BRANCH_ID": terminal
			}]
		}
		console.log(arrdata);
		$.blockUI();
		var tablebl = $("#table_detail_bl").DataTable();
		// var table = $("#table_history_bl").DataTable();
		tablebl.clear().draw();
		// table.clear().draw();
		$.ajax({
			url: "<?= ROOT ?>npksbilling/tracking_bl/search_tracktrace",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrdata)
			},
			success: function(data) {
				// console.log(data['detail_bl']);
				var data_fix = JSON.parse(data['detail_bl']);
				// console.log(data_fix['_v']);
				if (data_fix == null) {
					Swal.fire({
						icon: 'error',
						title: 'Data Tidak Bisa Ditemukan!',
						showConfirmButton: false,
						timer: 1500
					})
					return false;
				} else {
					var obj_detail_bl = JSON.parse(data_fix['_v']);
					var fix = JSON.parse(atob(obj_detail_bl['result']));
					var tabledata = fix['result'][0];
					console.log(tabledata.length);
					var no = 1;
					for (var i = 0; i < tabledata.length; i++) {
						if (fix['result'][0][i]['HIST_CONT_STATUS'] == null) {
							var status = ""
						} else {
							var status = fix['result'][0][i]['HIST_CONT_STATUS'];
						}
						if (fix['result'][0][i]['HIST_YARD'] == null) {
							var yard = ""
						} else {
							var yard = fix['result'][0][i]['HIST_YARD'];
						}

						if (fix['result'][0][i]['HIST_BLOCK'] == null) {
							var block = ""
						} else {
							var block = fix['result'][0][i]['HIST_BLOCK'];
						}
						tablebl.row.add(
							$('<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_CONT'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_ACTIVITY'] + '</td>' +
								'<td>' + yard + '</td>' +
								'<td>' + block + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_DATE'] + '</td>' +
								'<td>' + fix['result'][0][i]['HIST_NOREQ'] + '</td>' +
								'<td>' + status + '</td>' +
								'<tr>')
						).draw();
					};
					$(".show_detail").fadeIn();
				}
				$.unblockUI();
			}
		});
	}
</script>

<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/select2.css" type="text/css" />