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
				<div class="row">
					<div class="form-group col-xs-6">
						<label>Terminal</label>
						<select id="DEL_TERMINAL" name="DEL_TERMINAL" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Terminal -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>PBM / EMKL</label>
						<input name="DEL_PBM_NAME" id="DEL_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
						<input name="DEL_PBM_ID" id="DEL_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Nomor Request</label>
						<input name="DEL_NO" id="DEL_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
						<input name="DEL_ID" id="DEL_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="DEL_PENUMPUKAN_OLEH_NAME" id="DEL_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
						<input name="DEL_PENUMPUKAN_OLEH_ID" id="DEL_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" value="<?= $this->session->userdata('customerid_phd') ?>" readonly="">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Date</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_DATE" name="DEL_DATE" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" readonly="" disabled>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>To</label>
						<select id="DEL_TO" name="DEL_TO" class="form-control" required="">
							<option value="not-selected"> -- Please Choose To -- </option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12">
						<label>Payment Method</label>
						<select id="DEL_PAYMETHOD" name="DEL_PAYMETHOD" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Payment Method -- </option>
						</select>
					</div>
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
					<input name="DEL_VESSEL_NAME" id="DEL_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
					<input type="hidden" id="DEL_VESSEL_CODE" class="form-control" name="DEL_VESSEL_CODE" required>
					<input type="hidden" id="DEL_VESSEL" class="form-control" name="DEL_VESSEL" required>
				</div>
				<div class="form-group col-xs-6">
					<label>Nama Agen</label>
					<input name="DEL_VESSEL_AGENT" id="DEL_VESSEL_AGENT" type="text" class="form-control">
					<input name="DEL_VESSEL_AGENT_NAME" id="DEL_VESSEL_AGENT_NAME" type="hidden">
				</div>
				<div class="form-group col-xs-4">
					<label>No PKK</label>
					<input name="DEL_VESSEL_PKK" id="DEL_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage In</label>
					<input name="DEL_VOYIN" id="DEL_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage Out</label>
					<input name="DEL_VOYOUT" id="DEL_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>ETA</label>
					<input name="DEL_ETA" id="DEL_ETA" type="text" class="form-control" placeholder="ETA" required="">
				</div>
				<div class="form-group col-xs-6">
					<label>ETD</label>
					<input name="DEL_ETD" id="DEL_ETD" type="text" class="form-control" placeholder="ETD" required="">
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
					<div class="form-group col-xs-6">
						<label>Container Owner</label>
						<input id="DTL_CONTAINER_OWNER" name="DTL_CONTAINER_OWNER" type="text" class="form-control" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
						<input id="DTL_OWNER" name="DTL_OWNER" type="hidden" value="<?= $this->session->userdata('customerid_phd') ?>" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label>No Container</label>
						<input name="DTL_CONT" id="DTL_CONT" type="text" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Ukuran</label>
						<select id="DTL_CONT_SIZE" name="DTL_CONT_SIZE" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Ukuran -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Type</label>
						<select id="DTL_CONT_TYPE" name="DTL_CONT_TYPE" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Type -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Status</label>
						<select id="DTL_CONT_STATUS" name="DTL_CONT_STATUS" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Status -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Dangerous Goods</label>
						<select id="DTL_CONT_DANGER" name="DTL_CONT_DANGER" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Dangerous Goods -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Kemasan</label>
						<select id="DTL_KEMASAN" name="DTL_KEMASAN" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Kemasan -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Delivery Via</label>
						<select id="DTL_VIA" name="DTL_VIA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Via -- </option>
						</select>
					</div>
					<div class="form-group col-xs-12">
						<label for="datepickerDate">Tanggal Rencana Delivery</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DTL_DATE_PLAN" name="DTL_DATE_PLAN" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="">
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
								<th>Container Owner</th>
								<th>No Container</th>
								<th>Ukuran</th>
								<th>Type</th>
								<th>Status</th>
								<th>Dangerous Goods</th>
								<th>Kemasan</th>
								<th>Via</th>
								<th>Tanggal Rencana Delivery</th>
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

			var no_req = $('#DEL_NO').val();

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

			var DEL_TERMINAL = $('#DEL_TERMINAL');
			var DEL_PBM_NAME = $('#DEL_PBM_NAME');
			var DEL_PENUMPUKAN_OLEH_NAME = $('#DEL_PENUMPUKAN_OLEH_NAME');
			var DEL_TO = $('#DEL_TO');
			var DEL_PAYMETHOD = $('#DEL_PAYMETHOD');
			var DEL_VESSEL_NAME = $('#DEL_VESSEL_NAME');

			$('#DOC_TYPE' + counterdoc).change(function() {
				if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
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
				if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
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
		var DEL_TERMINAL = $('#DEL_TERMINAL');
		var DEL_PBM_NAME = $('#DEL_PBM_NAME');
		var DEL_PENUMPUKAN_OLEH_NAME = $('#DEL_PENUMPUKAN_OLEH_NAME');
		var DEL_TO = $('#DEL_TO');
		var DEL_PAYMETHOD = $('#DEL_PAYMETHOD');
		var DEL_VESSEL_NAME = $('#DEL_VESSEL_NAME');

		DEL_TERMINAL.change(function() {
			if (DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (DEL_TERMINAL.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_PBM_NAME.change(function() {
			if (DEL_TERMINAL.val() != 'not-selected' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (DEL_PBM_NAME.val() == '') {
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_PENUMPUKAN_OLEH_NAME.change(function() {
			if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (DEL_PENUMPUKAN_OLEH_NAME.val() == '') {
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_TO.change(function() {
			if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (DEL_TO.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_PAYMETHOD.change(function() {
			if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (DEL_PAYMETHOD.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_VESSEL_NAME.change(function() {
			if (DEL_VESSEL_NAME.val() == '') {
				$('#DEL_VESSEL_CODE').val(null);
				$('#DEL_VOYIN').val(null);
				$('#DEL_VOYOUT').val(null);
				$('#DEL_VESSEL_PKK').val(null);
				$('#DEL_VESSEL').val(null);
				$('#DEL_VESSEL_AGENT').val(null);
				$('#DEL_VESSEL_AGENT_NAME').val(null);
				$('#DEL_ETA').val(null);
				$('#DEL_ETD').val(null);
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
				var isSet = $('#DEL_TERMINAL').append(toAppend);
				if (isSet) {
					$('#DEL_TERMINAL').val('PTG');
				}
				//$('#DEL_TERMINAL').append(toAppend);
			}
		});

		//PBM
		$('#DEL_PBM_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/pbm",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#DEL_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#DEL_PBM_NAME').val(ui.item.label);
				$('#DEL_PBM_ID').val(ui.item.pbm_id);
				return false;
			}
		});

		//Penumpukan Oleh
		$('#DEL_PENUMPUKAN_OLEH_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/stackby",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#DEL_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#DEL_PENUMPUKAN_OLEH_NAME').val(ui.item.label);
				$('#DEL_PENUMPUKAN_OLEH_ID').val(ui.item.stack_id);
				return false;
			}
		});

		//To
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/del_to",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_order'] + '">' + record[i]['reff_name'] + '</option>';
				}

				$('#DEL_TO').append(toAppend);
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
				var isSet = $('#DEL_PAYMETHOD').append(toAppend);
				if (isSet) {
					$('#DEL_PAYMETHOD').val('1');
				}
			}
		});

		//vessel
		$('#DEL_VESSEL_NAME').autocomplete({
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
				$('#DEL_VESSEL_NAME').val(ui.item.label);
				$('#DEL_VESSEL_CODE').val(ui.item.vesselCode);
				$('#DEL_VOYIN').val(ui.item.voyageIn);
				$('#DEL_VOYOUT').val(ui.item.voyageOut);
				$('#DEL_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#DEL_VESSEL').val(ui.item.name);
				$('#DEL_ETA').val(ui.item.eta);
				$('#DEL_ETD').val(ui.item.etd);

				var DEL_TERMINAL = $('#DEL_TERMINAL');
				var DEL_PBM_NAME = $('#DEL_PBM_NAME');
				var DEL_PENUMPUKAN_OLEH_NAME = $('#DEL_PENUMPUKAN_OLEH_NAME');
				var DEL_TO = $('#DEL_TO');
				var DEL_PAYMETHOD = $('#DEL_PAYMETHOD');
				var DEL_VESSEL_NAME = $('#DEL_VESSEL_NAME');

				if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected') {
					if ($('#DOC_NAME' + counterdoc).val() != undefined) {
						if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
							$("#btn-show").prop('disabled', false);
						}
					}
				}

				if (DEL_VESSEL_NAME.val() == '') {
					$("#btn-show").prop('disabled', true);
				}
			}
		});

		//customer
		$('#DTL_CONTAINER_OWNER').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/customer",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#DEL_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$('#DTL_CONTAINER_OWNER').val(ui.item.label);
				$('#DTL_OWNER').val(ui.item.customer_id);
				return false;
			}
		});

		//size
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/size",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['cont_size'] + '">' + record[i]['cont_desc'] + '</option>';
				}

				$('#DTL_CONT_SIZE').append(toAppend);
			}
		});

		//type
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/type",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['cont_type'] + '">' + record[i]['cont_type_desc'] + '</option>';
				}

				$('#DTL_CONT_TYPE').append(toAppend);
			}
		});

		//status
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/status",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['cont_status'] + '">' + record[i]['cont_status_desc'] + '</option>';
				}

				$('#DTL_CONT_STATUS').append(toAppend);
			}
		});

		//sifat
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/sifat",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
				}

				$('#DTL_CONT_DANGER').append(toAppend);
			}
		});

		//kemasan
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/barang",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['commodity_id'] + '">' + record[i]['commodity_name'] + '</option>';
				}

				$('#DTL_KEMASAN').append(toAppend);
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

		//NO CONTAINER
		$('#DTL_CONT').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/no_container",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#DEL_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#DTL_CONT').val(ui.item.label);
				$('#DTL_CONT_SIZE').val(ui.item.size);
				$('#DTL_CONT_TYPE').val(ui.item.type);
				return false;
			}
		});

		//getdata
		$.ajax({
			url: "<?= ROOT ?>npksbilling/deliverycontainer/update_del/<?= $id ?>",
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				$.unblockUI();
				if (data.HEADER != "") {
					arrData = data;
					console.log(arrData);
					arrData.HEADER.forEach(function(item, index) {
						$("#DEL_ID").val(item.del_id);
						$("#DEL_NO").val(item.del_no);
						$("#DEL_CREATE_BY").val();
						$("#DEL_DATE").val(item.del_date);
						$("#DEL_PBM_NAME").val(item.del_pbm_name);
						$("#DEL_PBM_ID").val(item.del_pbm_id);
						$("#DEL_PENUMPUKAN_OLEH_NAME").val(item.del_stackby_name);
						$("#DEL_PENUMPUKAN_OLEH_ID").val(item.del_stackby_id);
						$("#DEL_TO").val(item.del_to);
						$("#DEL_PAYMETHOD").val(item.del_paymethod);
						$("#DEL_VESSEL_NAME").val(item.del_vessel_name);
						$("#DEL_VESSEL_CODE").val(item.del_vessel_code);
						$("#DEL_VOYIN").val(item.del_voyin);
						$("#DEL_VOYOUT").val(item.del_voyout);
						$("#DEL_VESSEL_PKK").val(item.del_vessel_pkk);
						$("#DEL_VESSEL").val(item.del_vessel_name);
						$("#DEL_VESSEL_AGENT").val(item.del_vessel_agent);
						$("#DEL_VESSEL_AGENT_NAME").val(item.del_vessel_agent_name);
						$('#DEL_ETA').val(item.del_vessel_eta);
						$('#DEL_ETD').val(item.del_vessel_etd);
						$('#DEL_TERMINAL').val(item.del_branch_code);
					});

					$('#show-detail').removeClass('hidden_content');

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].del_hdr_id);
					arrData.DETAIL.forEach(function(detail, index) {
						var kemasan_val = detail.del_dtl_cmdty_name;
						if (kemasan_val == null) {
							var kemasan_label = "N/A";
							var dtl_kemasan = "";
							kemasan_val = "";
						} else {
							var kemasan_label = kemasan_val;
							var dtl_kemasan = detail.del_dtl_cmdty_name;
						}

						$('#detail-list tbody').append(
							'<tr>' +
							'<td style="display: none;" class="tbl_dtl_del_id">' + detail.del_dtl_id + '</td>' +
							'<td style="display: none;" class="tbl_dtl_del_hdr_id">' + detail.del_hdr_id + '</td>' +

							'<td style="display: none;" class="tbl_dtl_del_owner_id">' + detail.del_dtl_owner + '</td>' +
							'<td class="tbl_dtl_del_owner">' + detail.del_dtl_owner_name + '</td>' +

							'<td class="tbl_dtl_del_no_cont">' + detail.del_dtl_cont + '</td>' +

							'<td class="tbl_dtl_del_size_id">' + detail.del_dtl_cont_size + '</td>' +
							'<td style="display: none;" class="tbl_dtl_del_size_name">' + detail.del_dtl_cont_size + '</td>' +

							'<td class="tbl_dtl_del_type_id">' + detail.del_dtl_cont_type + '</td>' +
							'<td style="display: none;" class="tbl_dtl_del_type_name">' + detail.del_dtl_cont_type + '</td>' +

							'<td class="tbl_dtl_del_status_id">' + detail.del_dtl_cont_status + '</td>' +
							'<td style="display: none;" class="tbl_dtl_del_status_name">' + detail.del_dtl_cont_status + '</td>' +

							'<td class="tbl_dtl_character_id">' + detail.del_dtl_cont_danger + '</td>' +
							'<td style="display: none;" class="tbl_dtl_character_name">' + detail.del_dtl_cont_danger + '</td>' +

							'<td style="display: none;" class="tbl_dtl_cmdty_id">' + dtl_kemasan + '</td>' +
							'<td style="display: none;" class="tbl_dtl_cmdty_name">' + kemasan_val + '</td>' +
							'<td class="tbl_dtl_cmdty_label">' + kemasan_label + '</td>' +

							'<td style="display: none;" class="tbl_dtl_del_via_id">' + detail.del_dtl_via + '</td>' +
							'<td class="tbl_dtl_del_via_name">' + detail.del_dtl_via_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_del_date_plan">' + detail.del_dtl_date_plan + '</td>' +
							'<td>' + detail.del_dtl_date_plan + '</td>' +

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
							var DEL_TERMINAL = $('#DEL_TERMINAL');
							var DEL_PBM_NAME = $('#DEL_PBM_NAME');
							var DEL_PENUMPUKAN_OLEH_NAME = $('#DEL_PENUMPUKAN_OLEH_NAME');
							var DEL_TO = $('#DEL_TO');
							var DEL_PAYMETHOD = $('#DEL_PAYMETHOD');
							var DEL_VESSEL_NAME = $('#DEL_VESSEL_NAME');

							console.log(counterdoc);
							console.log($('#DOC_NO' + counterdoc).val());
							console.log($('#DOC_NAME' + counterdoc).val());
							if (DEL_TERMINAL.val() != 'not-selected' && DEL_PBM_NAME.val() != '' && DEL_PENUMPUKAN_OLEH_NAME.val() != '' && DEL_TO.val() != 'not-selected' && DEL_PAYMETHOD.val() != 'not-selected' && DEL_VESSEL_NAME.val() != '') {
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
		var HDR_ID = $('#DEL_ID');
		var DTL_ID = $('#DTL_ID');
		var DTL_CONT = $('#DTL_CONT');
		var DTL_CONTAINER_OWNER = $('#DTL_CONTAINER_OWNER');
		var DTL_CONT_SIZE = $('#DTL_CONT_SIZE');
		var DTL_CONT_TYPE = $('#DTL_CONT_TYPE');
		var DTL_CONT_STATUS = $('#DTL_CONT_STATUS');
		var DTL_CONT_DANGER = $('#DTL_CONT_DANGER');
		var DTL_KEMASAN = $('#DTL_KEMASAN');
		var DTL_VIA = $('#DTL_VIA');
		var DTL_DATE_PLAN = $('#DTL_DATE_PLAN');
		var DTL_OWNER = $('#DTL_OWNER');
		var DTL_ISACTIVE = "";
		var DTL_REAL_DATE = "";

		if (DTL_OWNER.val() == "") {
			alert('Please choose Container Owner !');
			$('#DTL_OWNER').focus();
			return false;
		} else if (DTL_CONTAINER_OWNER.val() == "") {
			alert('Please choose Container Owner !');
			$('#DTL_CONTAINER_OWNER').focus();
			return false;
		} else if (DTL_CONT.val() == "") {
			alert('Please choose No Container !');
			$('#DTL_CONT').focus();
			return false;
		} else if (DTL_CONT_SIZE.val() == "not-selected") {
			alert('Please choose Ukuran !');
			$('#DTL_CONT_SIZE').focus();
			return false;
		} else if (DTL_CONT_TYPE.val() == "not-selected") {
			alert('Please choose Type !');
			$('#DTL_CONT_TYPE').focus();
			return false;
		} else if (DTL_CONT_STATUS.val() == "not-selected") {
			alert('Please choose Status !');
			$('#DTL_CONT_STATUS').focus();
			return false;
		} else if (DTL_CONT_DANGER.val() == "not-selected") {
			alert('Please choose Dangerous Goods !');
			$('#DTL_CONT_DANGER').focus();
			return false;
		} else if (DTL_VIA.val() == "not-selected") {
			alert('Please choose Receiving Via !');
			$('#DTL_VIA').focus();
			return false;
		} else if (DTL_DATE_PLAN.val() == "") {
			alert('Please choose Tanggal Rencana Receiving !');
			$('#DTL_DATE_PLAN').focus();
			return false;
		}

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var owner_id = $(this).find('.tbl_dtl_del_owner_id').html();
			var no_cont = $(this).find('.tbl_dtl_del_no_cont').html();

			var data_table = owner_id + no_cont;
			var form_data = DTL_OWNER.val() + DTL_CONT.val();

			if (data_table == form_data) {
				countData.push(1);
			}
		});

		if (countData.length > 0) {
			alert('Container tidak boleh sama.');
			return false;
		}

		var status_container = true;
		$.ajax({
			async: false,
			url: "<?= ROOT ?>npksbilling/mdm/cek_container/" + DTL_CONT.val(),
			type: 'GET',
			success: function(data) {
				var arr = JSON.parse(JSON.parse(data));
				if (arr.count < 1) {
					status_container = false;
				}
			}
		});

		if (!status_container) {
			alert('Status Container Gate In or In Yard.');
			$('#DTL_CONT').focus();
			return false;
		}

		var kemasan_val = (DTL_KEMASAN.val() != "not-selected") ? $('#DTL_KEMASAN option:selected').text() : "";
		if (kemasan_val == "") {
			var kemasan_label = "N/A";
			var dtl_kemasan = "";
		} else {
			var kemasan_label = kemasan_val;
			var dtl_kemasan = DTL_KEMASAN.val();
		}
		var size_val = (DTL_CONT_SIZE.val() != "not-selected") ? $('#DTL_CONT_SIZE option:selected').text() : "";
		var type_val = (DTL_CONT_TYPE.val() != "not-selected") ? $('#DTL_CONT_TYPE option:selected').text() : "";
		var status_val = (DTL_CONT_STATUS.val() != "not-selected") ? $('#DTL_CONT_STATUS option:selected').text() : "";
		var sifat_val = (DTL_CONT_DANGER.val() != "not-selected") ? $('#DTL_CONT_DANGER option:selected').text() : "";
		var via_val = (DTL_VIA.val() != "not-selected") ? $('#DTL_VIA option:selected').text() : "";

		$('#detail-list tbody').append(
			'<tr>' +
			'<td style="display: none;" class="tbl_dtl_del_id">' + DTL_ID.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_del_hdr_id">' + HDR_ID.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_del_owner_id">' + DTL_OWNER.val() + '</td>' +
			'<td class="tbl_dtl_del_owner">' + $('#DTL_CONTAINER_OWNER').val() + '</td>' +

			'<td class="tbl_dtl_del_no_cont">' + DTL_CONT.val() + '</td>' +

			'<td class="tbl_dtl_del_size_id">' + DTL_CONT_SIZE.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_del_size_name">' + size_val + '</td>' +

			'<td class="tbl_dtl_del_type_id">' + DTL_CONT_TYPE.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_del_type_name">' + type_val + '</td>' +

			'<td class="tbl_dtl_del_status_id">' + DTL_CONT_STATUS.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_del_status_name">' + status_val + '</td>' +

			'<td class="tbl_dtl_character_id">' + DTL_CONT_DANGER.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_character_name">' + sifat_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_cmdty_id">' + dtl_kemasan + '</td>' +
			'<td style="display: none;" class="tbl_dtl_cmdty_name">' + kemasan_val + '</td>' +
			'<td class="tbl_dtl_cmdty_label">' + kemasan_label + '</td>' +

			'<td style="display: none;" class="tbl_dtl_del_via_id">' + DTL_VIA.val() + '</td>' +
			'<td class="tbl_dtl_del_via_name">' + via_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_del_date_plan">' + DTL_DATE_PLAN.val() + '</td>' +
			'<td>' + DTL_DATE_PLAN.val() + '</td>' +

			'<td>' +
			'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
			'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function() {
		save_delivery_container();
		return false;
	});

	function save_delivery_container() {
		$('#modal-default').modal('hide');
		var details = [];
		var file = [];
		var del_req = $('#DEL_NO').val();

		$('#detail-list tbody tr').each(function() {
			var dtl_del_id = $(this).find('.tbl_dtl_del_id').html();

			var cont_owner = $(this).find('.tbl_dtl_del_owner').html();
			var cont_owner_id = $(this).find('.tbl_dtl_del_owner_id').html();

			var no_cont = $(this).find('.tbl_dtl_del_no_cont').html();

			var kemasan_id = $(this).find('.tbl_dtl_cmdty_id').html();
			var kemasan_name = $(this).find('.tbl_dtl_cmdty_name').html();

			var size_id = $(this).find('.tbl_dtl_del_size_id').html();
			var size_name = $(this).find('.tbl_dtl_del_size_name').html();

			var type_id = $(this).find('.tbl_dtl_del_type_id').html();
			var type_name = $(this).find('.tbl_dtl_del_type_name').html();

			var status_id = $(this).find('.tbl_dtl_del_status_id').html();
			var status_name = $(this).find('.tbl_dtl_del_status_name').html();

			var sifat_id = $(this).find('.tbl_dtl_character_id').html();
			var sifat_name = $(this).find('.tbl_dtl_character_name').html();

			var via_id = $(this).find('.tbl_dtl_del_via_id').html();
			var via_name = $(this).find('.tbl_dtl_del_via_name').html();

			var date_plan = $(this).find('.tbl_dtl_del_date_plan').html();


			var tamp = {
				"DEL_DTL_ID": null,
				"DEL_HDR_ID": null,
				"DEL_DTL_OWNER": (cont_owner_id != "not-selected") ? cont_owner_id : "",
				"DEL_DTL_OWNER_NAME": cont_owner,
				"DEL_DTL_CONT": no_cont,
				"DEL_DTL_CONT_SIZE": (size_id != "not-selected") ? size_id : "",
				"DEL_DTL_CONT_TYPE": (type_id != "not-selected") ? type_id : "",
				"DEL_DTL_CONT_STATUS": (status_id != "not-selected") ? status_id : "",
				"DEL_DTL_CONT_DANGER": (sifat_id != "not-selected") ? sifat_id : "",
				"DEL_DTL_VIA": (via_id != "not-selected") ? via_id : "",
				"DEL_DTL_VIA_NAME": via_name,
				"DEL_DTL_CMDTY_ID": kemasan_id,
				"DEL_DTL_CMDTY_NAME": kemasan_name,
				"DEL_DTL_DATE_PLAN": date_plan,
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
					"REQ_NO": del_req,
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
			"service_branch_id": $('#DEL_TERMINAL').find('option:selected').attr('brchid'),
			"service_branch_code": $('#DEL_TERMINAL').val(),
			"data": [
				"HEADER",
				"DETAIL",
				"FILE"
			],
			"HEADER": {
				"DB": "omuster",
				"TABLE": "TX_HDR_DEL",
				"PK": "DEL_ID",
				"VALUE": [{
					"DEL_ID": $('#DEL_ID').val(),
					"DEL_NO": del_req,
					"DEL_DATE": $('#DEL_DATE').val(),
					"DEL_PAYMETHOD": $('#DEL_PAYMETHOD').val(),
					"DEL_CUST_ID": "<?= $this->session->userdata('customerid_phd') ?>",
					"DEL_CUST_NAME": "<?= $this->session->userdata('customernamealt_phd') ?>",
					"DEL_CUST_NPWP": "<?= $this->session->userdata('npwp_phd') ?>",
					"DEL_STACKBY_ID": "<?= $this->session->userdata('customerid_phd') ?>",
					"DEL_STACKBY_NAME": "<?= $this->session->userdata('customernamealt_phd') ?>",
					"DEL_VESSEL_CODE": $('#DEL_VESSEL_CODE').val(),
					"DEL_VESSEL_NAME": $('#DEL_VESSEL').val(),
					"DEL_VOYIN": $('#DEL_VOYIN').val(),
					"DEL_VOYOUT": $('#DEL_VOYOUT').val(),
					"DEL_VVD_ID": $('#DEL_VESSEL_PKK').val(),
					"DEL_VESSEL_ETA": $('#DEL_ETA').val(),
					"DEL_VESSEL_ETD": $('#DEL_ETD').val(),
					"DEL_BRANCH_ID": $('#DEL_TERMINAL').find('option:selected').attr('brchid'),
					"DEL_NOTA": "2",
					"DEL_TO": $('#DEL_TO').val(),
					"DEL_CREATE_BY": "<?= $this->session->userdata('customerid_phd') ?>",
					"DEL_STATUS": "1",
					"DEL_VESSEL_AGENT": $('#DEL_VESSEL_AGENT').val(),
					"DEL_VESSEL_AGENT_NAME": $('#DEL_VESSEL_AGENT').val(),
					"DEL_CUST_ADDRESS": "<?= $this->session->userdata('address_phd') ?>",
					"DEL_BRANCH_CODE": $('#DEL_TERMINAL').val(),
					"DEL_PBM_ID": $('#DEL_PBM_ID').val(),
					"DEL_PBM_NAME": $('#DEL_PBM_NAME').val(),
					"DEL_VESSEL_PKK": $('#DEL_VESSEL_PKK').val(),
					"APP_ID": "2"
				}]
			},
			"DETAIL": {
				"DB": "omuster",
				"TABLE": "TX_DTL_DEL",
				"FK": [
					"DEL_HDR_ID",
					"del_id"
				],
				"VALUE": (details.length > 0) ? details : []
			},
			"FILE": {
				"DB": "omuster",
				"TABLE": "TX_DOCUMENT",
				"FK": [
					"REQ_NO",
					"del_no"
				],
				"VALUE": ((file.length > 0) ? file : [])
			}
		}
		console.log(arrData);
		$.blockUI();

		var DEL_TERMINAL = $('#DEL_TERMINAL').val();
		var DEL_PBM_NAME = $('#DEL_PBM_NAME').val();
		var DEL_DATE = $('#DEL_DATE').val();
		var STACK_BY = $('#DEL_PENUMPUKAN_OLEH_NAME').val();
		var DEL_TO = $('#DEL_TO').val();
		var DEL_PAYMENT_METHOD = $('#DEL_PAYMETHOD').val();
		var DEL_VESSEL = $('#DEL_VESSEL_NAME').val();

		if (DEL_TERMINAL == 'not-selected') {
			$.unblockUI();
			alert('Terminal Harus diisi !!');
			return false;
		} else if (DEL_PBM_NAME == '') {
			$.unblockUI();
			alert('PBM / EMKL Harus diisi !!');
			return false;
		} else if (DEL_DATE == '') {
			$.unblockUI();
			alert('Tanggal Harus diisi !!');
			return false;
		} else if (STACK_BY == '') {
			$.unblockUI();
			alert('Penumpukan Oleh Harus diisi !!');
			return false;
		} else if (DEL_TO == 'not-selected') {
			$.unblockUI();
			alert('To Harus diisi !!');
			return false;
		} else if (DEL_PAYMENT_METHOD == 'not-selected') {
			$.unblockUI();
			alert('Payment Method Harus diisi !!');
			return false;
		} else if (DEL_VESSEL == '') {
			$.unblockUI();
			alert('Data Vessel Harus diisi !!');
			return false;
		}

		if (details.length == 0) {
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		} else if (file.length == 0) {
			$.unblockUI();
			alert('File harus diisi !!');
			return false;
		}

		$.ajax({
			url: "<?= ROOT ?>npksbilling/deliverycontainer/save_del/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function(data) {
				if (data.success === 'S') {
					var temp = JSON.parse(data.data);
					var no_req = temp['header']['del_no'];
					var notification = new NotificationFx({
						message: '<p>Data ' + no_req + ' Berhasil Disimpan</p><br/>',
						layout: 'growl',
						effect: 'jelly',
						type: 'success'
					});
					deliverycontainer_log(no_req);
					setTimeout(function() {
						window.location = "<?= ROOT ?>npksbilling/deliverycontainer";
					}, 3000);
				} else {
					alert("Data Gagal Disimpan;");
				}
				$.unblockUI();
			}
		});
	}

	function deliverycontainer_log(no_req) {
		var status_req = $('#DEL_NO').val();

		$.ajax({
			url: "<?= ROOT ?>npksbilling/transaction_log/deliverycontainer_log",
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
		$("#DTL_DATE_PLAN").datetimepicker({
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