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

<!-- global scripts -->
<script src="<?= JSQ ?>jquery-ui.min.js"></script>

<style type="text/css">
	.upload_info {
		font-size: small;
		font-style: italic;
		float: right;
	}

	.hidden_content {
		display: none;
	}

	#component_type {
		float: left;
	}

	#component_reefer {
		float: left;
		margin-left: 10px;
	}

	.main-box-footer {
		text-align: center;
		margin-bottom: 30px;
	}

	.btn-footer {
		width: 100px;
	}

	input[type=radio] {
		vertical-align: middle;
		width: 17px;
		height: 17px;
	}
</style>

<script>
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
			</header>
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-12">
					<label>Terminal</label>
					<select id="REC_TERMINAL" name="REC_TERMINAL" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Terminal -- </option>
					</select>
				</div>
				<div class="form-group col-xs-6">
					<label>PBM / EMKL</label>
					<input name="REC_PBM_NAME" id="REC_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
					<input name="REC_PBM_ID" id="REC_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
				</div>
				<div class="form-group col-xs-6">
					<label for="datepickerDate">Nomor Request</label>
					<input name="REC_NO" id="REC_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
					<input name="REC_ID" id="REC_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>Penumpukan Oleh</label>
					<input name="REC_PENUMPUKAN_OLEH_NAME" id="REC_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" placeholder="Autocomplete" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
					<input name="REC_PENUMPUKAN_OLEH_ID" id="REC_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" placeholder="Autocomplete" value="<?= $this->session->userdata('customerid_phd') ?>" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label for="datepickerDate">Date</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<input id="REC_DATE" name="REC_DATE" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" readonly="" disabled>
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label>From</label>
					<select id="REC_FROM" name="REC_FROM" class="form-control" required="">
						<option value="not-selected"> -- Please Choose From -- </option>
					</select>
				</div>
				<div class="form-group col-xs-6">
					<label>Payment Method</label>
					<select id="REC_PAYMETHOD" name="REC_PAYMETHOD" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Payment Method -- </option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Data Kapal</b></h2>
			</header>
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label>Vessel</label>
					<input name="REC_VESSEL_NAME" id="REC_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
					<input type="hidden" id="REC_VESSEL_CODE" class="form-control" name="REC_VESSEL_CODE" required>
					<input type="hidden" id="REC_VESSEL" class="form-control" name="REC_VESSEL" required>
				</div>
				<div class="form-group col-xs-6">
					<label>Nama Agen</label>
					<input name="REC_VESSEL_AGENT" id="REC_VESSEL_AGENT" type="text" class="form-control">
					<input name="REC_VESSEL_AGENT_NAME" id="REC_VESSEL_AGENT_NAME" type="hidden">
				</div>
				<div class="form-group col-xs-4">
					<label>No PKK</label>
					<input name="REC_VESSEL_PKK" id="REC_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage In</label>
					<input name="REC_VOYIN" id="REC_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage Out</label>
					<input name="REC_VOYOUT" id="REC_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>ETA</label>
					<input name="REC_ETA" id="REC_ETA" type="text" class="form-control" placeholder="ETA" required="">
				</div>
				<div class="form-group col-xs-6">
					<label>ETD</label>
					<input name="REC_ETD" id="REC_ETD" type="text" class="form-control" placeholder="ETD" required="">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 ">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Dokumen</b></h2>
			</header>

			<div class="main-box-body clearfix">
				<table id="myTable" class="table order-list list_file">
					<tr>

					</tr>
					<div class="form-group example-twitter-oss">
						<div class="form-group col-xs-1"><br />
							<a class="btn btn-danger" id="add_file">
								<span class="glyphicon glyphicon-plus"></span> Tambah Dokumen
							</a>
						</div>
					</div>
				</table>

				<div class="form-group example-twitter-oss pull-right">
					<button type="button" class="btn btn-danger" id="btn-show">
						<span class="glyphicon glyphicon-ok-sign"></span> Show Detail
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="hidden_content" id='show-detail'>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
				</header>
				<input id="DTL_ID" name="DTL_ID" type="hidden" class="form-control">
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-4">
						<label>Cargo Owner</label>
						<input id="DTL_CARGO_OWNER" name="DTL_CARGO_OWNER" type="text" class="form-control" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
						<input id="DTL_OWNER" name="DTL_OWNER" type="hidden" value="<?= $this->session->userdata('customerid_phd') ?>" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>BL/SI/DO</label>
						<input name="DTL_NO_SI" id="DTL_NO_SI" type="text" class="form-control" placeholder="BL/SI/DO" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Jumlah</label>
						<input name="DTL_JUMLAH" id="DTL_JUMLAH" type="number" class="form-control" placeholder="Jumlah" min="0" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Sifat</label>
						<select id="DTL_DANGER" name="DTL_DANGER" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Sifat -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Kemasan</label>
						<select id="DTL_KEMASAN" name="DTL_KEMASAN" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Kemasan -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4 hidden_content">
						<label>Kemasan Tamp</label>
						<input type="text" name="DTL_PKG_TMP" id="DTL_PKG_TMP" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>Barang</label>
						<select id="DTL_CMDTY_ID" name="DTL_CMDTY_ID" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Barang -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Satuan</label>
						<select id="DTL_UNIT_ID" name="DTL_UNIT_ID" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Satuan -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Receiving Via</label>
						<select id="DTL_VIA" name="DTL_VIA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Via -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Stacking Area</label>
						<select id="DTL_STACKING_AREA" name="DTL_STACKING_AREA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Stacking Area -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Receiving</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="REC_DATE_PLAN" name="REC_DATE_PLAN" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="">
						</div>
					</div>
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-danger" type="button" id="list-detail" onclick="save_detail()">
							<span class="glyphicon glyphicon-plus">Add</span>
						</button>
					</div>

					<table class="table table-striped table-hover" id="detail-list">
						<thead>
							<tr>
								<th>Cargo Owner</th>
								<th>BL/SI/DO</th>
								<th>Jumlah</th>
								<th>Sifat</th>
								<th>Kemasan</th>
								<th>Barang</th>
								<th>Satuan</th>
								<th>Receiving Via</th>
								<th>Stacking Area</th>
								<th>Tanggal Receiving</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">
					<div class="form-group example-twitter-oss pull-right">
						<button id="submit_header" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
						<button id="submit_header" class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>
					</div>
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
				<button id="btn-modal-kirim" class="btn btn-primary">Simpan</button>
			</div>

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	var counterdoc = 0;
	counterdetail = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	function goBack() {
		window.history.back();
	}

	$(document).ready(function() {
		$.blockUI();

		//ADD_FILE
		$("#add_file").on("click", function() {
			var record = <?php echo json_encode($docType); ?>;

			counterdoc++;

			var newRow = $("<tr>");
			var cols = "";

			var no_req = $('#REC_NO').val();

			cols += '';

			cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE' + counterdoc + '" name="DOC_TYPE' + counterdoc + '" class="form-control"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

			cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO' + counterdoc + '" name="DOC_NO' + counterdoc + '" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';

			cols += '<div class="col-xs-4"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME' + counterdoc + '" id="DOC_NAME' + counterdoc + '" doc_name="" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc(' + counterdoc + ')"></div>';

			cols += '<input type="hidden" id="DOC_PATH' + counterdoc + '" name="DOC_PATH' + counterdoc + '" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols += '<input type="hidden" id="DOC_BASH' + counterdoc + '" name="DOC_BASH' + counterdoc + '" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols += '<input type="hidden" id="DOC_ID' + counterdoc + '" name="DOC_ID' + counterdoc + '" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';

			newRow.append(cols);

			$(".list_file").append(newRow);

			var REC_TERMINAL = $('#REC_TERMINAL');
			var REC_PBM_NAME = $('#REC_PBM_NAME');
			var REC_PENUMPUKAN_OLEH_NAME = $('#REC_PENUMPUKAN_OLEH_NAME');
			var REC_FROM = $('#REC_FROM');
			var REC_PAYMETHOD = $('#REC_PAYMETHOD');
			var REC_VESSEL_NAME = $('#REC_VESSEL_NAME');

			$('#DOC_TYPE' + counterdoc).change(function() {
				if (REC_TERMINAL.val() != 'not-selected' && REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NO' + counterdoc).val().length > 1 && $('#DOC_NAME' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					} else {
						$("#btn-show").prop('disabled', true);
					}
				}
				if ($('#DOC_TYPE').val() == 'not-selected') {
					$("#btn-show").prop('disabled', true);
				}
			});

			$('#DOC_NO' + counterdoc).change(function() {
				if (REC_TERMINAL.val() != 'not-selected' && REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NO' + counterdoc).val().length > 1 && $('#DOC_NAME' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					} else {
						$("#btn-show").prop('disabled', true);
					}
				}
				if ($('#DOC_NO').val() == '') {
					$("#btn-show").prop('disabled', true);
				}
			});

			var toAppend = '';
			for (var i = 0; i < record.length; i++) {
				toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
			}
			$('#DOC_TYPE' + counterdoc).append(toAppend);

		});

		$("table.list_file").on("click", ".ibtnDel", function(event) {
			$(this).closest("tr").remove();
			counterdoc--;
			if (count_file() == 0) {
				$("#btn-show").prop('disabled', true);
			}
		});

		$("table#detail-list").on("click", ".btn-delete-detail", function(event) {
			counterdetail--;
			$(this).closest("tr").remove();
		});

		$("#btn-show").click(function() {
			$('#show-detail').removeClass('hidden_content');
		});

		$("#btn-show").prop('disabled', true);

		//validasi header
		var REC_TERMINAL = $('#REC_TERMINAL');
		var REC_PBM_NAME = $('#REC_PBM_NAME');
		var REC_PENUMPUKAN_OLEH_NAME = $('#REC_PENUMPUKAN_OLEH_NAME');
		var REC_FROM = $('#REC_FROM');
		var REC_PAYMETHOD = $('#REC_PAYMETHOD');
		var REC_VESSEL_NAME = $('#REC_VESSEL_NAME');

		REC_TERMINAL.change(function() {
			if (REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (REC_TERMINAL.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		REC_PBM_NAME.change(function() {
			if (REC_TERMINAL.val() != 'not-selected' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (REC_PBM_NAME.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		REC_PENUMPUKAN_OLEH_NAME.change(function() {
			if (REC_TERMINAL.val() != 'not-selected' && REC_PBM_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (REC_PENUMPUKAN_OLEH_NAME.val() == '') {
				$("#btn-show").prop('disabled', true);
			}
		});

		REC_FROM.change(function() {
			if (REC_TERMINAL.val() != 'not-selected' && REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (REC_FROM.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		REC_PAYMETHOD.change(function() {
			if (REC_TERMINAL.val() != 'not-selected' && REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (REC_PAYMETHOD.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		REC_VESSEL_NAME.change(function() {
			if (REC_VESSEL_NAME.val() == '') {
				$('#REC_VESSEL_CODE').val(null);
				$('#REC_VOYIN').val(null);
				$('#REC_VOYOUT').val(null);
				$('#REC_VESSEL_PKK').val(null);
				$('#REC_VESSEL').val(null);
				$('#REC_VESSEL_AGENT').val(null);
				$('#REC_VESSEL_AGENT_NAME').val(null);
				$('#REC_ETA').val(null);
				$('#REC_ETD').val(null);
				$("#btn-show").prop('disabled', true);
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
				var isSet = $('#REC_TERMINAL').append(toAppend);
				if (isSet) {
					$('#REC_TERMINAL').val('PTG');
				}
				//$('#REC_TERMINAL').append(toAppend);
			}
		});

		//PBM
		$('#REC_PBM_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/pbm",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#REC_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#REC_PBM_NAME').val(ui.item.label);
				$('#REC_PBM_ID').val(ui.item.pbm_id);
				return false;
			}
		});

		//Penumpukan Oleh
		$('#REC_PENUMPUKAN_OLEH_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/stackby",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#REC_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#REC_PENUMPUKAN_OLEH_NAME').val(ui.item.label);
				$('#REC_PENUMPUKAN_OLEH_ID').val(ui.item.stack_id);
				return false;
			}
		});

		//from
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/from_cargo",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
				}

				$('#REC_FROM').append(toAppend);
			}
		});

		//payment method
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/paymethod",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_order'] + '">' + record[i]['reff_name'] + '</option>';
				}
				var isSet = $('#REC_PAYMETHOD').append(toAppend);
				if (isSet) {
					$('#REC_PAYMETHOD').val('1');
				}
			}
		});

		//vessel
		$('#REC_VESSEL_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/vessel",
					type: 'GET',
					data: {
						vessel: request.term
					},
					dataType: 'json',
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$('#REC_VESSEL_NAME').val(ui.item.label);
				$('#REC_VESSEL_CODE').val(ui.item.vesselCode);
				$('#REC_VOYIN').val(ui.item.voyageIn);
				$('#REC_VOYOUT').val(ui.item.voyageOut);
				$('#REC_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#REC_VESSEL').val(ui.item.name);
				$('#REC_ETA').val(ui.item.eta);
				$('#REC_ETD').val(ui.item.etd);

				var REC_TERMINAL = $('#REC_TERMINAL');
				var REC_PBM_NAME = $('#REC_PBM_NAME');
				var REC_PENUMPUKAN_OLEH_NAME = $('#REC_PENUMPUKAN_OLEH_NAME');
				var REC_FROM = $('#REC_FROM');
				var REC_PAYMETHOD = $('#REC_PAYMETHOD');
				var REC_VESSEL_NAME = $('#REC_VESSEL_NAME');

				if (REC_TERMINAL.val() != 'not-selected' && REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected') {
					if ($('#DOC_NAME' + counterdoc).val() != undefined) {
						if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
							$("#btn-show").prop('disabled', false);
						}
					}
				}

				if (REC_VESSEL_NAME.val() == '') {
					$("#btn-show").prop('disabled', true);
				}
			}
		});

		//customer
		$('#DTL_CARGO_OWNER').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/customer",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#REC_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$('#DTL_CARGO_OWNER').val(ui.item.label);
				$('#DTL_OWNER').val(ui.item.customer_id);
				return false;
			}
		});

		//via
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/via",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
				}

				$('#DTL_VIA').append(toAppend);
			}
		});

		//kemacan changeed
		$('#DTL_KEMASAN').on('change', function() {
			var val = this.value;
			if (val != 8) {
				$.ajax({
					type: "GET",
					url: "<?= ROOT ?>npksbilling/mdm/barang_tamp/" + val,
					success: function(data) {
						if (!data) {
							return false;
						}
						var obj = JSON.parse(data);
						var record = obj['result'];
						var toAppend = '';
						for (var i = 0; i < record.length; i++) {
							toAppend += '<option pgkid="' + record[i]['package_id'] + '" value="' + record[i]['commodity_id'] + '">' + record[i]['commodity_name'] + '</option>';
						}
						$('#DTL_CMDTY_ID').find('option').remove().end().append('<option value="not-selected"> -- Please Choose Barang  -- </option>');
						$('#DTL_CMDTY_ID').append(toAppend);
					}
				});
			} else {
				$('#DTL_CMDTY_ID').val("not-selected");
			}
		}).change();

		//kemasan
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/kemasan_cargo",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['package_id'] + '">' + record[i]['package_name'] + '</option>';
				}

				$('#DTL_KEMASAN').append(toAppend);
			}
		});

		//sifat
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/sifat_cargo",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['character_id'] + '">' + record[i]['character_name'] + '</option>';
				}

				$('#DTL_DANGER').append(toAppend);
			}
		});

		//satuan
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/satuan_cargo",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['unit_id'] + '">' + record[i]['unit_name'] + '</option>';
				}

				$('#DTL_UNIT_ID').append(toAppend);
			}
		});

		//barang
		// $.ajax({
		// 	type: "GET",
		// 	url: "<?= ROOT ?>npksbilling/mdm/barang",
		// 	success: function(data) {
		// 		var obj = JSON.parse(data);
		// 		var record = obj['result'];

		// 		var toAppend = '';
		// 		for (var i = 0; i < record.length; i++) {
		// 			toAppend += '<option value="' + record[i]['commodity_id'] + '">' + record[i]['commodity_name'] + '</option>';
		// 		}

		// 		$('#DTL_CMDTY_ID').append(toAppend);
		// 	}
		// });

		//stacking area
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/stacking",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
				}

				$('#DTL_STACKING_AREA').append(toAppend);
			}
		});

		$('#DTL_KEMASAN').on('change', function() {
			if ($('#DTL_KEMASAN').val() == "not-selected") {
				$('#DTL_CMDTY_ID').find('option').remove().end().append('<option value="not-selected"> -- Please Choose Barang  -- </option>');
			} else {
				var DTL_PKG_ID = $(this).val();
				$('#DTL_PKG_TMP').val(DTL_PKG_ID);
			}
		});

		$('#DTL_CMDTY_ID').on('change', function() {
			var DTL_CMDTY_ID = $(this).val();
			var parent_id = $(this).find('option:selected').attr('pgkid');
			$('#DTL_PKG_TMP').val(parent_id);
		});

		//getdata
		$.ajax({
			url: "<?= ROOT ?>npksbilling/receivebarang/update_rec/<?= $id ?>",
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				$.unblockUI();
				if (data.HEADER != "") {
					arrData = data;
					console.log(arrData);
					arrData.HEADER.forEach(function(item, index) {
						$("#REC_ID").val(item.rec_cargo_id);
						$("#REC_NO").val(item.rec_cargo_no);
						$("#REC_CREATE_BY").val();
						$("#REC_DATE").val(item.rec_cargo_date);
						$("#REC_PBM_NAME").val(item.rec_cargo_pbm_name);
						$("#REC_PBM_ID").val(item.rec_cargo_pbm_id);
						$("#REC_PENUMPUKAN_OLEH_NAME").val(item.rec_cargo_stackby_name);
						$("#REC_PENUMPUKAN_OLEH_ID").val(item.rec_cargo_stackby_id);
						$("#REC_FROM").val(item.rec_cargo_from);
						$("#REC_PAYMETHOD").val(item.rec_cargo_paymethod);
						$("#REC_VESSEL_NAME").val(item.rec_cargo_vessel_name);
						$("#REC_VESSEL_CODE").val(item.rec_cargo_vessel_code);
						$("#REC_VOYIN").val(item.rec_cargo_voyin);
						$("#REC_VOYOUT").val(item.rec_cargo_voyout);
						$("#REC_VESSEL_PKK").val(item.rec_cargo_vessel_pkk);
						$("#REC_VESSEL").val(item.rec_cargo_vessel_name);
						$("#REC_VESSEL_AGENT").val(item.rec_cargo_vessel_agent);
						$("#REC_VESSEL_AGENT_NAME").val(item.rec_cargo_vessel_agent_name);
						$('#REC_ETA').val(item.rec_cargo_vessel_eta);
						$('#REC_ETD').val(item.rec_cargo_vessel_etd);
						$('#REC_TERMINAL').val(item.rec_cargo_branch_code);
					});

					$('#show-detail').removeClass('hidden_content');

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].rec_cargo_hdr_id);
					arrData.DETAIL.forEach(function(detail, index) {
						$('#detail-list tbody').append(
							'<tr>' +
							'<td style="display: none;" class="tbl_dtl_rec_id">' + detail.rec_cargo_dtl_id + '</td>' +
							'<td style="display: none;" class="tbl_dtl_rec_hdr_id">' + detail.rec_cargo_hdr_id + '</td>' +

							'<td class="tbl_dtl_rec_owner">' + detail.rec_cargo_dtl_owner_name + '</td>' +
							'<td style="display: none;" class="tbl_dtl_rec_owner_id">' + detail.rec_cargo_dtl_owner + '</td>' +

							'<td class="tbl_dtl_rec_no_si">' + detail.rec_cargo_dtl_si_no + '</td>' +

							'<td class="tbl_dtl_rec_jumlah">' + detail.rec_cargo_dtl_qty + '</td>' +

							'<td style="display: none;" class="tbl_dtl_character_id">' + detail.rec_cargo_dtl_character_id + '</td>' +
							'<td class="tbl_dtl_character_name">' + detail.rec_cargo_dtl_character_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_rec_kemasan_id">' + detail.rec_cargo_dtl_pkg_id + '</td>' +
							'<td class="tbl_dtl_rec_kemasan">' + detail.rec_cargo_dtl_pkg_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_rec_kemasan_parent_id">' + detail.rec_cargo_dtl_pkg_parent_id + '</td>' +

							'<td style="display: none;" class="tbl_dtl_komoditi_id">' + detail.rec_cargo_dtl_cmdty_id + '</td>' +
							'<td class="tbl_dtl_komoditi_name">' + detail.rec_cargo_dtl_cmdty_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_rec_satuan_id">' + detail.rec_cargo_dtl_unit_id + '</td>' +
							'<td class="tbl_dtl_rec_satuan_name">' + detail.rec_cargo_dtl_unit_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_rec_via_id">' + detail.rec_cargo_dtl_via + '</td>' +
							'<td class="tbl_dtl_rec_via_name">' + detail.rec_cargo_dtl_via_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_rec_stacking_area_id">' + detail.rec_cargo_dtl_stack_area + '</td>' +
							'<td class="tbl_dtl_rec_stacking_area_name">' + detail.rec_cargo_dtl_stack_area_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_rec_date_plan">' + detail.rec_cargo_dtl_rec_date + '</td>' +
							'<td>' + detail.rec_cargo_dtl_rec_date + '</td>' +

							'<td>' +
							'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
							'</td>' +
							'</tr>'
						);
					});

					var record = <?php echo json_encode($docType); ?>;
					data.FILE.forEach(function(file, index) {
						if (data.FILE.length != 0) {

							counterdoc++;
							var newRow = $("<tr>");
							var cols = "";

							cols += '';
							cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE' + counterdoc + '" name="DOC_TYPE' + counterdoc + '" class="form-control" maxlength="40"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

							cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO' + counterdoc + '" name="DOC_NO' + counterdoc + '" value="' + file.doc_no + '" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';

							cols += '<div class="col-xs-4"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME' + counterdoc + '" value="' + file.doc_name + '" id="DOC_NAME' + counterdoc + '" doc_name="' + file.doc_name + '" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc(' + counterdoc + ')"><a href="' + apiUrl + file.doc_path + '" target="_blank">' + file.doc_name + '</a></div>';

							cols += '<input type="hidden" id="DOC_PATH' + counterdoc + '" name="DOC_PATH' + counterdoc + '" value="' + file.doc_name + '" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

							cols += '<input type="hidden" id="DOC_BASH' + counterdoc + '" name="DOC_BASH' + counterdoc + '" value="' + file.base64 + '" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

							cols += '<input type="hidden" id="DOC_ID' + counterdoc + '" name="DOC_ID' + counterdoc + '" value="' + file.doc_id + '" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

							cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';

							newRow.append(cols);

							$(".list_file").append(newRow);

							var toAppend = '';
							for (var i = 0; i < record.length; i++) {
								var isSelect = (record[i]['reff_id'] == file.doc_type) ? 'selected' : '';
								toAppend += '<option value="' + record[i]['reff_id'] + '" ' + isSelect + '>' + record[i]['reff_name'] + '</option>';
							}
							$('#DOC_TYPE' + counterdoc).append(toAppend);
						}
					});
				}
			}
		});
	});

	//encode file
	function encodedoc(counterdoc) {
		var inputf = document.getElementById('DOC_NAME' + counterdoc).files[0];
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
				$("#DOC_PATH" + counterdoc).val(path);
				$("#DOC_NAME" + counterdoc).attr("doc_name", path);
				$("#DOC_BASH" + counterdoc).val(byteArray);

				var code = "";
				for (var i = 0; i < file.length; i++) {
					code += file[i].toString(16);
				}

				if (code) {
					switch (code) {
						case '89504e47':
							return 'image/png';
						case '25504446':
							//PDF
							var REC_PBM_NAME = $('#REC_PBM_NAME');
							var REC_PENUMPUKAN_OLEH_NAME = $('#REC_PENUMPUKAN_OLEH_NAME');
							var REC_FROM = $('#REC_FROM');
							var REC_PAYMETHOD = $('#REC_PAYMETHOD');
							var REC_VESSEL_NAME = $('#REC_VESSEL_NAME');

							console.log(counterdoc);
							console.log($('#DOC_NO' + counterdoc).val());
							console.log($('#DOC_NAME' + counterdoc).val());
							if (REC_PBM_NAME.val() != '' && REC_PENUMPUKAN_OLEH_NAME.val() != '' && REC_FROM.val() != 'not-selected' && REC_PAYMETHOD.val() != 'not-selected' && REC_VESSEL_NAME.val() != '') {
								if ($('#DOC_NAME' + counterdoc).val() != undefined) {
									if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
										$("#btn-show").prop('disabled', false);
									}
								}
							} else {
								$("#btn-show").prop('disabled', true);
								alert('Field header & vessel wajib diisi');
							}

							case "ffd8ffe0":
							case "ffd8ffe1":
							case "ffd8ffe2":
								return 'image/jpeg'
							default:
								alert('File harus PDF');
								$('#DOC_NAME' + counterdoc).val('');
								$("#btn-show").prop('disabled', true);
					}
				}
			}
		}
	}

	function save_detail() {
		counterdetail++;
		var HDR_ID = $('#REC_ID');
		var DTL_ID = $('#DTL_ID');
		var DTL_CARGO_OWNER = $('#DTL_CARGO_OWNER');
		var DTL_OWNER = $('#DTL_OWNER');
		var DTL_NO_SI = $('#DTL_NO_SI');
		var DTL_JUMLAH = $('#DTL_JUMLAH');
		var DTL_VIA = $('#DTL_VIA');
		var DTL_KEMASAN = $('#DTL_KEMASAN');
		var DTL_KEMASAN_TAMP = $('#DTL_PKG_TMP');
		var DTL_DANGER = $('#DTL_DANGER');
		var DTL_UNIT_ID = $('#DTL_UNIT_ID');
		var DTL_CMDTY_ID = $('#DTL_CMDTY_ID');
		var DTL_STACKING_AREA = $('#DTL_STACKING_AREA');
		var REC_DATE_PLAN = $('#REC_DATE_PLAN');

		if (DTL_OWNER.val() == "") {
			alert('Please choose Container Owner !');
			$('#DTL_OWNER').focus();
			return false;
		} else if (DTL_CARGO_OWNER.val() == "") {
			alert('Please choose Container Owner !');
			$('#DTL_CARGO_OWNER').focus();
			return false;
		} else if (DTL_NO_SI.val() == "") {
			alert('Please choose No SI !');
			$('#DTL_NO_SI').focus();
			return false;
		} else if (DTL_JUMLAH.val() == "") {
			alert('Please choose Jumlah !');
			$('#DTL_JUMLAH').focus();
			return false;
		} else if (DTL_DANGER.val() == "not-selected") {
			alert('Please choose Sifat !');
			$('#DTL_DANGER').focus();
			return false;
		} else if (DTL_KEMASAN.val() == "not-selected") {
			alert('Please choose Kemasan !');
			$('#DTL_KEMASAN').focus();
			return false;
		} else if (DTL_CMDTY_ID.val() == "not-selected") {
			alert('Please choose Barang !');
			$('#DTL_CMDTY_ID').focus();
			return false;
		} else if (DTL_KEMASAN_TAMP.val() == "") {
			alert('Please choose Barang !');
			$('#DTL_CMDTY_ID').focus();
			return false;
		} else if (DTL_UNIT_ID.val() == "not-selected") {
			alert('Please choose Satuan !');
			$('#DTL_UNIT_ID').focus();
			return false;
		} else if (DTL_VIA.val() == "not-selected") {
			alert('Please choose Via !');
			$('#DTL_VIA').focus();
			return false;
		} else if (DTL_STACKING_AREA.val() == "not-selected") {
			alert('Please choose Stacking Area !');
			$('#DTL_STACKING_AREA').focus();
			return false;
		}

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var owner_id = $(this).find('.tbl_dtl_rec_owner_id').html();
			var no_si = $(this).find('.tbl_dtl_rec_no_si').html();
			var barang = $(this).find('.tbl_dtl_komoditi_id').html();

			var data_table = owner_id + no_si + barang;
			var form_data = DTL_OWNER.val() + DTL_NO_SI.val() + DTL_CMDTY_ID.val();

			if (data_table == form_data) {
				countData.push(1);
			}
		});

		if (countData.length > 0) {
			alert('Data sudah ada..');
			return false;
		}

		var via_val = (DTL_VIA.val() != "not-selected") ? $('#DTL_VIA option:selected').text() : "";
		var sifat_val = (DTL_DANGER.val() != "not-selected") ? $('#DTL_DANGER option:selected').text() : "";
		var satuan = (DTL_UNIT_ID.val() != "not-selected") ? $('#DTL_UNIT_ID option:selected').text() : "";
		var komoditi = (DTL_CMDTY_ID.val() != "not-selected") ? $('#DTL_CMDTY_ID option:selected').text() : "";
		var kemasan_val = (DTL_KEMASAN.val() != "not-selected") ? $('#DTL_KEMASAN option:selected').text() : "";
		var stacking_area_val = (DTL_STACKING_AREA.val() != "not-selected") ? $('#DTL_STACKING_AREA option:selected').text() : "";

		$('#detail-list tbody').append(
			'<tr>' +
			'<td style="display: none;" class="tbl_dtl_rec_id">' + DTL_ID.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_rec_hdr_id">' + HDR_ID.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_owner_id">' + DTL_OWNER.val() + '</td>' +
			'<td class="tbl_dtl_rec_owner">' + $('#DTL_CARGO_OWNER').val() + '</td>' +

			'<td class="tbl_dtl_rec_no_si">' + DTL_NO_SI.val() + '</td>' +

			'<td class="tbl_dtl_rec_jumlah">' + DTL_JUMLAH.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_character_id">' + DTL_DANGER.val() + '</td>' +
			'<td class="tbl_dtl_character_name">' + sifat_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_kemasan_id">' + DTL_KEMASAN.val() + '</td>' +
			'<td class="tbl_dtl_rec_kemasan">' + kemasan_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_kemasan_parent_id">' + DTL_KEMASAN_TAMP.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_komoditi_id">' + DTL_CMDTY_ID.val() + '</td>' +
			'<td class="tbl_dtl_komoditi_name">' + komoditi + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_satuan_id">' + DTL_UNIT_ID.val() + '</td>' +
			'<td class="tbl_dtl_rec_satuan_name">' + satuan + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_via_id">' + DTL_VIA.val() + '</td>' +
			'<td class="tbl_dtl_rec_via_name">' + via_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_stacking_area_id">' + DTL_STACKING_AREA.val() + '</td>' +
			'<td class="tbl_dtl_rec_stacking_area_name">' + stacking_area_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_rec_date_plan">' + REC_DATE_PLAN.val() + '</td>' +
			'<td>' + REC_DATE_PLAN.val() + '</td>' +

			'<td>' +
			'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
			'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function() {
		save_rec();
		return false;
	});

	function save_rec() {
		$('#modal-default').modal('hide');
		var details = [];
		var file = [];
		var no_req = $('#REC_NO').val();

		$('#detail-list tbody tr').each(function() {
			var dtl_rec_id = $(this).find('.tbl_dtl_rec_id').html();

			var cargo_owner = $(this).find('.tbl_dtl_rec_owner').html();
			var cargo_owner_id = $(this).find('.tbl_dtl_rec_owner_id').html();

			var no_si = $(this).find('.tbl_dtl_rec_no_si').html();

			var jumlah = $(this).find('.tbl_dtl_rec_jumlah').html();

			var via_id = $(this).find('.tbl_dtl_rec_via_id').html();
			var via_name = $(this).find('.tbl_dtl_rec_via_name').html();

			var kemasan_id = $(this).find('.tbl_dtl_rec_kemasan_id').html();
			var kemasan_name = $(this).find('.tbl_dtl_rec_kemasan').html();

			var kemasan_parent_id = $(this).find('.tbl_dtl_rec_kemasan_parent_id').html();

			var sifat_id = $(this).find('.tbl_dtl_character_id').html();
			var sifat_name = $(this).find('.tbl_dtl_character_name').html();

			var tgl_rencana_rec = $(this).find('.tbl_dtl_rec_date_plan').html();

			var satuan_id = $(this).find('.tbl_dtl_rec_satuan_id').html();
			var satuan_name = $(this).find('.tbl_dtl_rec_satuan_name').html();

			var stack_area_id = $(this).find('.tbl_dtl_rec_stacking_area_id').html();
			var stack_area_name = $(this).find('.tbl_dtl_rec_stacking_area_name').html();

			var komoditi_id = $(this).find('.tbl_dtl_komoditi_id').html();
			var komoditi_name = $(this).find('.tbl_dtl_komoditi_name').html();

			var tamp = {
				"REC_CARGO_DTL_ID": null,
				"REC_CARGO_HDR_ID": null,
				"REC_CARGO_DTL_OWNER": cargo_owner_id,
				"REC_CARGO_DTL_OWNER_NAME": cargo_owner,
				"REC_CARGO_DTL_SI_NO": no_si,
				"REC_CARGO_DTL_QTY": jumlah,
				"REC_CARGO_DTL_CHARACTER_ID": sifat_id,
				"REC_CARGO_DTL_CHARACTER_NAME": sifat_name,
				"REC_CARGO_DTL_PKG_ID": kemasan_id,
				"REC_CARGO_DTL_PKG_NAME": kemasan_name,
				"REC_CARGO_DTL_PKG_PARENT_ID": kemasan_parent_id,
				"REC_CARGO_DTL_CMDTY_ID": komoditi_id,
				"REC_CARGO_DTL_CMDTY_NAME": komoditi_name,
				"REC_CARGO_DTL_UNIT_ID": satuan_id,
				"REC_CARGO_DTL_UNIT_NAME": satuan_name,
				"REC_CARGO_DTL_VIA": via_id,
				"REC_CARGO_DTL_VIA_NAME": via_name,
				"REC_CARGO_DTL_REC_DATE": tgl_rencana_rec,
				"REC_CARGO_DTL_STACK_AREA": stack_area_id,
				"REC_CARGO_DTL_STACK_AREA_NAME": stack_area_name,
				"id": ""
			}
			details.push(tamp);

		});

		for (let index = 1; index <= counterdoc; index++) {
			var doc_type = $('#DOC_TYPE' + index).val();
			var doc_no = $('#DOC_NO' + index).val();
			var doc_path = $('#DOC_PATH' + index).val();
			var doc_bash = $('#DOC_BASH' + index).val();
			var doc_id = $('#DOC_ID' + index).val();
			var doc_name = $('#DOC_NAME' + index).val();

			if (doc_no != '') {
				var temp = {
					"DOC_ID": doc_id,
					"REQ_NO": no_req,
					"DOC_NO": doc_no,
					"PATH": doc_path,
					"DOC_TYPE": doc_type,
					"BASE64": doc_bash
				}
				file.push(temp);
			}
		}

		arrData = {
			"action": "saveheaderdetail",
			"service_branch_id": $('#REC_TERMINAL').find('option:selected').attr('brchid'),
			"service_branch_code": $('#REC_TERMINAL').val(),
			"data": [
				"HEADER",
				"DETAIL",
				"FILE"
			],
			"HEADER": {
				"DB": "omuster",
				"TABLE": "TX_HDR_REC_CARGO",
				"PK": "REC_CARGO_ID",
				"VALUE": [{
					"REC_CARGO_ID": $('#REC_ID').val(),
					"REC_CARGO_NO": no_req,
					"REC_CARGO_DATE": $('#REC_DATE').val(),
					"REC_CARGO_PAYMETHOD": $('#REC_PAYMETHOD').val(),
					"REC_CARGO_CUST_ID": "<?= $this->session->userdata('customerid_phd') ?>",
					"REC_CARGO_CUST_NAME": "<?= $this->session->userdata('customernamealt_phd') ?>",
					"REC_CARGO_CUST_NPWP": "<?= $this->session->userdata('npwp_phd') ?>",
					"REC_CARGO_CUST_ACCOUNT": null,
					"REC_CARGO_STACKBY_ID": "<?= $this->session->userdata('customerid_phd') ?>",
					"REC_CARGO_STACKBY_NAME": "<?= $this->session->userdata('customernamealt_phd') ?>",
					"REC_CARGO_VESSEL_CODE": $('#REC_VESSEL_CODE').val(),
					"REC_CARGO_VESSEL_NAME": $('#REC_VESSEL').val(),
					"REC_CARGO_VOYIN": $('#REC_VOYIN').val(),
					"REC_CARGO_VOYOUT": $('#REC_VOYOUT').val(),
					"REC_CARGO_VVD_ID": $('#REC_VESSEL_PKK').val(),
					"REC_CARGO_VESSEL_ETA": $('#REC_ETA').val(),
					"REC_CARGO_VESSEL_ETD": $('#REC_ETD').val(),
					"REC_CARGO_BRANCH_ID": $('#REC_TERMINAL').find('option:selected').attr('brchid'),
					"REC_CARGO_NOTA": "21",
					"REC_CARGO_FROM": $('#REC_FROM').val(),
					"REC_CARGO_CREATE_BY": "<?= $this->session->userdata('customerid_phd') ?>",
					"REC_CARGO_STATUS": "1",
					"REC_CARGO_VESSEL_AGENT": $('#REC_VESSEL_AGENT').val(),
					"REC_CARGO_VESSEL_AGENT_NAME": $('#REC_VESSEL_AGENT').val(),
					"REC_CARGO_CUST_ADDRESS": "<?= $this->session->userdata('address_phd') ?>",
					"REC_CARGO_BRANCH_CODE": $('#REC_TERMINAL').val(),
					"REC_CARGO_PBM_ID": $('#REC_PBM_ID').val(),
					"REC_CARGO_PBM_NAME": $('#REC_PBM_NAME').val(),
					"REC_CARGO_VESSEL_PKK": $('#REC_VESSEL_PKK').val(),
					"APP_ID": "2"
				}]
			},
			"DETAIL": {
				"DB": "omuster",
				"TABLE": "TX_DTL_REC_CARGO",
				"FK": [
					"REC_CARGO_HDR_ID",
					"rec_cargo_id"
				],
				"VALUE": (details.length > 0) ? details : []
			},
			"FILE": {
				"DB": "omuster",
				"TABLE": "TX_DOCUMENT",
				"FK": [
					"REQ_NO",
					"rec_cargo_no"
				],
				"VALUE": ((file.length > 0) ? file : [])
			}
		}
		console.log(arrData);
		$.blockUI();

		var REC_PBM_NAME = $('#REC_PBM_NAME').val();
		var REC_DATE = $('#REC_DATE').val();
		var STACK_BY = $('#REC_PENUMPUKAN_OLEH_NAME').val();
		var REC_FROM = $('#REC_FROM').val();
		var REC_PAYMENT_METHOD = $('#REC_PAYMETHOD').val();
		var REC_VESSEL = $('#REC_VESSEL_NAME').val();

		if (REC_PBM_NAME == '') {
			$.unblockUI();
			alert('PBM / EMKL Harus diisi !!');
			return false;
		} else if (REC_DATE == '') {
			$.unblockUI();
			alert('Tanggal Harus diisi !!');
			return false;
		} else if (STACK_BY == '') {
			$.unblockUI();
			alert('Penumpukan Oleh Harus diisi !!');
			return false;
		} else if (REC_FROM == 'not-selected') {
			$.unblockUI();
			alert('From Harus diisi !!');
			return false;
		} else if (REC_PAYMENT_METHOD == 'not-selected') {
			$.unblockUI();
			alert('Payment Method Harus diisi !!');
			return false;
		} else if (REC_VESSEL == '') {
			$.unblockUI();
			alert('Data Vessel Harus diisi !!');
			return false;
		}

		if (file.length == 0) {
			$.unblockUI();
			alert('File harus diisi !!');
			return false;
		} else if (details.length == 0) {
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}

		$.ajax({
			url: "<?= ROOT ?>npksbilling/receivebarang/save_rec/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function(data) {
				if (data.success === 'S') {
					var temp = JSON.parse(data.data);
					var no_req = temp['header']['rec_cargo_no'];
					var notification = new NotificationFx({
						message: '<p>Data ' + no_req + ' Berhasil Disimpan</p><br/>',
						layout: 'growl',
						effect: 'jelly',
						type: 'success'
					});
					receivecargo_log(no_req);
					setTimeout(function() {
						window.location = "<?= ROOT ?>npksbilling/receivebarang";
					}, 3000);
				} else {
					alert("Data Gagal Disimpan;");
				}
				$.unblockUI();
			}
		});
	}

	function receivecargo_log(no_req) {
		var status_req = $('#REC_NO').val();

		$.ajax({
			url: "<?= ROOT ?>npksbilling/transaction_log/receivecargo_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				status_req: status_req,
				no_req: no_req

			},
			success: function(data) {
				if (data != null) {
					console.log('Data Tersimpan ke LOG');
				}

			}
		});
	}

	function count_file() {
		var file = [];
		for (let index = 1; index <= counterdoc; index++) {
			file.push(1);
		}
		return file.length;
	}

	$(function() {
		$("#REC_DATE_PLAN").datetimepicker({
			format: "Y-m-d H:i:s",
			autoclose: true,
			todayHighlight: true,
		});
	});
</script>
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/select2.css" type="text/css" />