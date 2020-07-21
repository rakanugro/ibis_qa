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
						<select id="STUFF_TERMINAL" name="STUFF_TERMINAL" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Terminal -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>PBM / EMKL</label>
						<input name="STUFF_PBM_NAME" id="STUFF_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
						<input name="STUFF_PBM_ID" id="STUFF_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Nomor Request</label>
						<input name="STUFF_NO" id="STUFF_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
						<input name="STUFF_ID" id="STUFF_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="STUFF_PENUMPUKAN_OLEH_NAME" id="STUFF_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
						<input name="STUFF_PENUMPUKAN_OLEH_ID" id="STUFF_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" value="<?= $this->session->userdata('customerid_phd') ?>" readonly="">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Date</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="STUFF_DATE" name="STUFF_DATE" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="" readOnly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>From</label>
						<select id="STUFF_FROM" name="STUFF_FROM" class="form-control" required="">
							<option value="not-selected"> -- Please Choose From -- </option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12">
						<label>Payment Method</label>
						<select id="STUFF_PAYMETHOD" name="STUFF_PAYMETHOD" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Payment Method -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<input name="STUFF_ID_NOTA" id="STUFF_ID_NOTA" type="hidden" class="form-control" readonly="">
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
					<input name="STUFF_VESSEL_NAME" id="STUFF_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
					<input type="hidden" id="STUFF_VESSEL_CODE" class="form-control" name="STUFF_VESSEL_CODE" required>
					<input type="hidden" id="STUFF_VESSEL" class="form-control" name="STUFF_VESSEL" required>
				</div>
				<div class="form-group col-xs-6">
					<label>Nama Agen</label>
					<input name="STUFF_VESSEL_AGENT" id="STUFF_VESSEL_AGENT" type="text" class="form-control">
					<input name="STUFF_VESSEL_AGENT_NAME" id="STUFF_VESSEL_AGENT_NAME" type="hidden">
				</div>
				<div class="form-group col-xs-4">
					<label>No PKK</label>
					<input name="STUFF_VESSEL_PKK" id="STUFF_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage In</label>
					<input name="STUFF_VOYIN" id="STUFF_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage Out</label>
					<input name="STUFF_VOYOUT" id="STUFF_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>ETA</label>
					<input name="STUFF_ETA" id="STUFF_ETA" type="text" class="form-control" placeholder="ETA" required="">
				</div>
				<div class="form-group col-xs-6">
					<label>ETD</label>
					<input name="STUFF_ETD" id="STUFF_ETD" type="text" class="form-control" placeholder="ETD" required="">
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
						<label>Stuffing Via</label>
						<select id="DTL_VIA" name="DTL_VIA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Via -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Kemasan</label>
						<select id="DTL_KEMASAN" name="DTL_KEMASAN" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Kemasan -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Start Stuffing</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DTL_TGL_START" name="DTL_TGL_START" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">End Stuffing</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DTL_TGL_END" name="DTL_TGL_END" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="">
						</div>
					</div>
					<div id="dtl-rec-del"></div>
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-danger" type="button" id="list-detail" onclick="save_detail()">
							<span class="glyphicon glyphicon-plus">Add</span>
						</button>
					</div>

					<table class="table table-striped table-hover" id="detail-list">
						<thead>
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

			var no_req = $('#STUFF_NO').val();

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

			var STUFF_TERMINAL = $('#STUFF_TERMINAL');
			var STUFF_PBM_NAME = $('#STUFF_PBM_NAME');
			var STUFF_PENUMPUKAN_OLEH_NAME = $('#STUFF_PENUMPUKAN_OLEH_NAME');
			var STUFF_FROM = $('#STUFF_FROM');
			var STUFF_PAYMETHOD = $('#STUFF_PAYMETHOD');
			var STUFF_VESSEL_NAME = $('#STUFF_VESSEL_NAME');

			$('#DOC_TYPE' + counterdoc).change(function() {
				if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
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
				if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
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
		var STUFF_TERMINAL = $('#STUFF_TERMINAL');
		var STUFF_PBM_NAME = $('#STUFF_PBM_NAME');
		var STUFF_PENUMPUKAN_OLEH_NAME = $('#STUFF_PENUMPUKAN_OLEH_NAME');
		var STUFF_FROM = $('#STUFF_FROM');
		var STUFF_PAYMETHOD = $('#STUFF_PAYMETHOD');
		var STUFF_VESSEL_NAME = $('#STUFF_VESSEL_NAME');

		STUFF_TERMINAL.change(function() {
			if (STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (STUFF_TERMINAL.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		STUFF_PBM_NAME.change(function() {
			if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (STUFF_PBM_NAME.val() == '') {
				$("#btn-show").prop('disabled', true);
			}
		});

		STUFF_PENUMPUKAN_OLEH_NAME.change(function() {
			if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (STUFF_PENUMPUKAN_OLEH_NAME.val() == '') {
				$("#btn-show").prop('disabled', true);
			}
		});

		STUFF_FROM.change(function() {
			if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (STUFF_FROM.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		STUFF_PAYMETHOD.change(function() {
			if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
				if (typeof($('#DOC_NAME' + counterdoc)) != "undefined") {
					if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if (STUFF_PAYMETHOD.val() == 'not-selected') {
				$("#btn-show").prop('disabled', true);
			}
		});

		STUFF_VESSEL_NAME.change(function() {
			if (STUFF_VESSEL_NAME.val() == '') {
				$('#STUFF_VESSEL_CODE').val(null);
				$('#STUFF_VOYIN').val(null);
				$('#STUFF_VOYOUT').val(null);
				$('#STUFF_VESSEL_PKK').val(null);
				$('#STUFF_VESSEL').val(null);
				$('#STUFF_VESSEL_AGENT').val(null);
				$('#STUFF_VESSEL_AGENT_NAME').val(null);
				$('#STUFF_ETA').val(null);
				$('#STUFF_ETD').val(null);
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
				var isSet = $('#STUFF_TERMINAL').append(toAppend);
				if (isSet) {
					$('#STUFF_TERMINAL').val('PTG');
				}
				//$('#STUFF_TERMINAL').append(toAppend);
			}
		});

		//PBM
		$('#STUFF_PBM_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/pbm",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#STUFF_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#STUFF_PBM_NAME').val(ui.item.label);
				$('#STUFF_PBM_ID').val(ui.item.pbm_id);
				return false;
			}
		});

		//Penumpukan Oleh
		$('#STUFF_PENUMPUKAN_OLEH_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/stackby",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#STUFF_TERMINAL').find('option:selected').attr('brchid')
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				console.log(ui);
				$('#STUFF_PENUMPUKAN_OLEH_NAME').val(ui.item.label);
				$('#STUFF_PENUMPUKAN_OLEH_ID').val(ui.item.stack_id);
				return false;
			}
		});

		//from
		$.ajax({
			type: "GET",
			url: "<?= ROOT ?>npksbilling/mdm/from",
			success: function(data) {
				var obj = JSON.parse(data);
				var record = obj['result'];

				var toAppend = '';
				for (var i = 0; i < record.length; i++) {
					toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
				}

				$('#STUFF_FROM').append(toAppend);
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
				var isSet = $('#STUFF_PAYMETHOD').append(toAppend);
				if (isSet) {
					$('#STUFF_PAYMETHOD').val('1');
				}
			}
		});

		//vessel
		$('#STUFF_VESSEL_NAME').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/vessel",
					type: 'GET',
					dataType: 'json',
					data: {
						vessel: request.term
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$('#STUFF_VESSEL_NAME').val(ui.item.label);
				$('#STUFF_VESSEL_CODE').val(ui.item.vesselCode);
				$('#STUFF_VOYIN').val(ui.item.voyageIn);
				$('#STUFF_VOYOUT').val(ui.item.voyageOut);
				$('#STUFF_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#STUFF_VESSEL').val(ui.item.name);
				$('#STUFF_ETA').val(ui.item.eta);
				$('#STUFF_ETD').val(ui.item.etd);

				var STUFF_TERMINAL = $('#STUFF_TERMINAL');
				var STUFF_PBM_NAME = $('#STUFF_PBM_NAME');
				var STUFF_PENUMPUKAN_OLEH_NAME = $('#STUFF_PENUMPUKAN_OLEH_NAME');
				var STUFF_FROM = $('#STUFF_FROM');
				var STUFF_PAYMETHOD = $('#STUFF_PAYMETHOD');
				var STUFF_VESSEL_NAME = $('#STUFF_VESSEL_NAME');

				if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected') {
					if ($('#DOC_NAME' + counterdoc).val() != undefined) {
						if ($('#DOC_TYPE' + counterdoc).val() != 'not-selected' && $('#DOC_NAME' + counterdoc).val() != '' && $('#DOC_NO' + counterdoc).val() != '') {
							$("#btn-show").prop('disabled', false);
						}
					}
				}

				if (STUFF_VESSEL_NAME.val() == '') {
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
						branch_id: $('#STUFF_TERMINAL').find('option:selected').attr('brchid')
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

		//NO_CONTAINER
		$('#DTL_CONT').autocomplete({
			source: function(request, response) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/no_container",
					type: 'GET',
					dataType: 'json',
					data: {
						request: request.term,
						branch_id: $('#STUFF_TERMINAL').find('option:selected').attr('brchid')
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

		//getdata
		$.ajax({
			url: "<?= ROOT ?>npksbilling/stuffing/update_stuff/<?= $id ?>",
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				$.unblockUI();
				if (data.HEADER != "") {
					arrData = data;
					console.log(arrData);
					arrData.HEADER.forEach(function(item, index) {
						$("#STUFF_ID").val(item.stuff_id);
						$("#STUFF_NO").val(item.stuff_no);
						$("#STUFF_CREATE_BY").val();
						$("#STUFF_DATE").val(item.stuff_date);
						$("#STUFF_PBM_NAME").val(item.stuff_pbm_name);
						$("#STUFF_PBM_ID").val(item.stuff_pbm_id);
						$("#STUFF_PENUMPUKAN_OLEH_NAME").val(item.stuff_stackby_name);
						$("#STUFF_PENUMPUKAN_OLEH_ID").val(item.stuff_stackby_id);
						$("#STUFF_FROM").val(item.stuff_from);
						$("#STUFF_PAYMETHOD").val(item.stuff_paymethod);
						$('#STUFF_ID_NOTA').val(item.stuff_nota);
						$("#STUFF_VESSEL_NAME").val(item.stuff_vessel_name);
						$("#STUFF_VESSEL_CODE").val(item.stuff_vessel_code);
						$("#STUFF_VOYIN").val(item.stuff_voyin);
						$("#STUFF_VOYOUT").val(item.stuff_voyout);
						$("#STUFF_VESSEL_PKK").val(item.stuff_vessel_pkk);
						$("#STUFF_VESSEL").val(item.stuff_vessel_name);
						$("#STUFF_VESSEL_AGENT").val(item.stuff_vessel_agent);
						$("#STUFF_VESSEL_AGENT_NAME").val(item.stuff_vessel_agent_name);
						$('#STUFF_ETA').val(item.stuff_vessel_eta);
						$('#STUFF_ETD').val(item.stuff_vessel_etd);
						$('#STUFF_TERMINAL').val(item.stuff_branch_code);
					});

					set_detail();

					$('#show-detail').removeClass('hidden_content');

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].stuff_hdr_id);

					if ($('#STUFF_ID_NOTA').val() == 7) {
						var show_tgl_rec = "";
						var show_tgl_del = "display: none;";
					} else if ($('#STUFF_ID_NOTA').val() == 8) {
						var show_tgl_rec = "";
						var show_tgl_del = "";
					} else if ($('#STUFF_ID_NOTA').val() == 9) {
						var show_tgl_rec = "display: none;";
						var show_tgl_del = "";
					} else {
						var show_tgl_rec = "display: none;";
						var show_tgl_del = "display: none;";
					}

					arrData.DETAIL.forEach(function(detail, index) {
						var kemasan_val = detail.stuff_dtl_cmdty_name;
						if (kemasan_val == null) {
							var kemasan_label = "N/A";
							var dtl_kemasan = "";
							kemasan_val = "";
						} else {
							var kemasan_label = kemasan_val;
							var dtl_kemasan = detail.stuff_dtl_cmdty_id;
						}

						var status_val = detail.stuff_dtl_cont_status;
						if (status_val == null) {
							var status_label = "N/A";
							var dtl_status = "";
							status_val = "";
						} else {
							var status_label = status_val;
							var dtl_status = detail.stuff_dtl_cont_status;
						}

						$('#detail-list tbody').append(
							'<tr>' +
							'<td style="display: none;" class="tbl_dtl_stuff_id">' + detail.stuff_dtl_id + '</td>' +
							'<td style="display: none;" class="tbl_dtl_stuff_hdr_id">' + detail.stuff_hdr_id + '</td>' +

							'<td style="display: none;" class="tbl_dtl_stuff_owner_id">' + detail.stuff_dtl_owner + '</td>' +
							'<td class="tbl_dtl_stuff_owner">' + detail.stuff_dtl_owner_name + '</td>' +

							'<td class="tbl_dtl_stuff_no_cont">' + detail.stuff_dtl_cont + '</td>' +

							'<td style="display: none;" class="tbl_dtl_stuff_size_id">' + detail.stuff_dtl_cont_size + '</td>' +
							'<td class="tbl_dtl_stuff_size_name">' + detail.stuff_dtl_cont_size + '</td>' +

							'<td style="display: none;" class="tbl_dtl_stuff_type_id">' + detail.stuff_dtl_cont_type + '</td>' +
							'<td class="tbl_dtl_stuff_type_name">' + detail.stuff_dtl_cont_type + '</td>' +

							'<td style="display: none;" class="tbl_dtl_stuff_status_id">' + dtl_status + '</td>' +
							'<td style="display: none;" class="tbl_dtl_stuff_status_name">' + status_val + '</td>' +
							'<td class="tbl_dtl_stuff_status_label">' + status_label + '</td>' +

							'<td style="display: none;" class="tbl_dtl_character_id">' + detail.stuff_dtl_cont_danger + '</td>' +
							'<td class="tbl_dtl_character_name">' + detail.stuff_dtl_cont_danger + '</td>' +

							'<td style="display: none;" class="tbl_dtl_stuff_via_id">' + detail.stuff_dtl_via + '</td>' +
							'<td class="tbl_dtl_stuff_via_name">' + detail.stuff_dtl_via_name + '</td>' +

							'<td style="display: none;" class="tbl_dtl_stuff_kemasan_id">' + dtl_kemasan + '</td>' +
							'<td style="display: none;" class="tbl_dtl_stuff_kemasan">' + kemasan_val + '</td>' +
							'<td class="tbl_dtl_stuff_kemasan_label">' + kemasan_label + '</td>' +

							'<td class="tbl_dtl_stuff_date_start">' + detail.stuff_dtl_start_date + '</td>' +

							'<td class="tbl_dtl_stuff_date_end">' + detail.stuff_dtl_end_date + '</td>' +

							'<td style="' + show_tgl_rec + '" class="tbl_dtl_stuff_rec_date">' + detail.stuff_dtl_rec_date + '</td>' +

							'<td style="' + show_tgl_del + '" class="tbl_dtl_stuff_del_date">' + detail.stuff_dtl_del_date + '</td>' +

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
				} else {
					get_id_nota();
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
							var STUFF_TERMINAL = $('#STUFF_TERMINAL');
							var STUFF_PBM_NAME = $('#STUFF_PBM_NAME');
							var STUFF_PENUMPUKAN_OLEH_NAME = $('#STUFF_PENUMPUKAN_OLEH_NAME');
							var STUFF_FROM = $('#STUFF_FROM');
							var STUFF_PAYMETHOD = $('#STUFF_PAYMETHOD');
							var STUFF_VESSEL_NAME = $('#STUFF_VESSEL_NAME');

							console.log(counterdoc);
							console.log($('#DOC_NO' + counterdoc).val());
							console.log($('#DOC_NAME' + counterdoc).val());
							if (STUFF_TERMINAL.val() != 'not-selected' && STUFF_PBM_NAME.val() != '' && STUFF_PENUMPUKAN_OLEH_NAME.val() != '' && STUFF_FROM.val() != 'not-selected' && STUFF_PAYMETHOD.val() != 'not-selected' && STUFF_VESSEL_NAME.val() != '') {
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
		var HDR_ID = $('#STUFF_ID');
		var DTL_ID = $('#DTL_ID');
		var DTL_CONTAINER_OWNER = $('#DTL_CONTAINER_OWNER');
		var DTL_OWNER = $('#DTL_OWNER');
		var DTL_CONT = $('#DTL_CONT');
		var DTL_CONT_SIZE = $('#DTL_CONT_SIZE');
		var DTL_CONT_TYPE = $('#DTL_CONT_TYPE');
		var DTL_CONT_STATUS = $('#DTL_CONT_STATUS');
		var DTL_CONT_DANGER = $('#DTL_CONT_DANGER');
		var DTL_VIA = $('#DTL_VIA');
		var DTL_KEMASAN = $('#DTL_KEMASAN');
		var DTL_TGL_START = $('#DTL_TGL_START');
		var DTL_TGL_END = $('#DTL_TGL_END');

		if ($('#STUFF_ID_NOTA').val() == 7) {
			var DTL_TGL_REC = $('#DTL_TGL_REC').val();
			var DTL_TGL_DEL = $('#STUFF_DATE').val();
			var show_tgl_rec = "";
			var show_tgl_del = "display: none;";
		} else if ($('#STUFF_ID_NOTA').val() == 8) {
			var DTL_TGL_REC = $('#DTL_TGL_REC').val();
			var DTL_TGL_DEL = $('#DTL_TGL_DEL').val();
			var show_tgl_rec = "";
			var show_tgl_del = "";
		} else if ($('#STUFF_ID_NOTA').val() == 9) {
			var DTL_TGL_REC = $('#STUFF_DATE').val();
			var DTL_TGL_DEL = $('#DTL_TGL_DEL').val();
			var show_tgl_rec = "display: none;";
			var show_tgl_del = "";
		} else {
			var DTL_TGL_REC = $('#STUFF_DATE').val();
			var DTL_TGL_DEL = $('#STUFF_DATE').val();
			var show_tgl_rec = "display: none;";
			var show_tgl_del = "display: none;";
		}

		if (DTL_CONTAINER_OWNER.val() == "") {
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
		} else if (DTL_CONT_STATUS.val() != "MTY") {
			alert('Status Container must be Empty !');
			$('#DTL_CONT_STATUS').focus();
			return false;
		} else if (DTL_CONT_DANGER.val() == "not-selected") {
			alert('Please choose Dangerous Goods !');
			$('#DTL_CONT_DANGER').focus();
			return false;
		} else if (DTL_VIA.val() == "not-selected") {
			alert('Please choose Stuffing Via !');
			$('#DTL_VIA').focus();
			return false;
		}

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var owner_id = $(this).find('.tbl_dtl_stuff_owner_id').html();
			var no_cont = $(this).find('.tbl_dtl_stuff_no_cont').html();

			var data_table = owner_id + no_cont;
			var form_data = DTL_OWNER.val() + DTL_CONT.val();

			if (data_table == form_data) {
				countData.push(1);
			}
		});

		if (countData.length > 0) {
			alert('Data sudah ada..');
			return false;
		}

		var status_container = true;
		if ($('#STUFF_ID_NOTA').val() == 7) {
			$.ajax({
				async: false,
				url: "<?= ROOT ?>npksbilling/mdm/cek_container_rec/" + DTL_CONT.val(),
				type: 'GET',
				success: function(data) {
					var arr = JSON.parse(JSON.parse(data));
					if (arr.count > 0) {
						status_container = false;
					}
				}
			});
		} else {
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
		}

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
		var status_val = (DTL_CONT_STATUS.val() != "not-selected") ? $('#DTL_CONT_STATUS option:selected').text() : "";
		if (status_val == "") {
			var status_label = "N/A";
			var dtl_status = "";
		} else {
			var status_label = status_val;
			var dtl_status = DTL_CONT_STATUS.val();
		}
		var size_val = (DTL_CONT_SIZE.val() != "not-selected") ? $('#DTL_CONT_SIZE option:selected').text() : "";
		var type_val = (DTL_CONT_TYPE.val() != "not-selected") ? $('#DTL_CONT_TYPE option:selected').text() : "";
		var sifat_val = (DTL_CONT_DANGER.val() != "not-selected") ? $('#DTL_CONT_DANGER option:selected').text() : "";
		var via_val = (DTL_VIA.val() != "not-selected") ? $('#DTL_VIA option:selected').text() : "";

		$('#detail-list tbody').append(
			'<tr>' +
			'<td style="display: none;" class="tbl_dtl_stuff_id">' + DTL_ID.val() + '</td>' +
			'<td style="display: none;" class="tbl_dtl_stuff_hdr_id">' + HDR_ID.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_stuff_owner_id">' + DTL_OWNER.val() + '</td>' +
			'<td class="tbl_dtl_stuff_owner">' + $('#DTL_CONTAINER_OWNER').val() + '</td>' +

			'<td class="tbl_dtl_stuff_no_cont">' + DTL_CONT.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_stuff_size_id">' + DTL_CONT_SIZE.val() + '</td>' +
			'<td class="tbl_dtl_stuff_size_name">' + DTL_CONT_SIZE.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_stuff_type_id">' + DTL_CONT_TYPE.val() + '</td>' +
			'<td class="tbl_dtl_stuff_type_name">' + DTL_CONT_TYPE.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_stuff_status_id">' + dtl_status + '</td>' +
			'<td style="display: none;" class="tbl_dtl_stuff_status_name">' + status_val + '</td>' +
			'<td class="tbl_dtl_stuff_status_label">' + status_label + '</td>' +

			'<td style="display: none;" class="tbl_dtl_character_id">' + DTL_CONT_DANGER.val() + '</td>' +
			'<td class="tbl_dtl_character_name">' + DTL_CONT_DANGER.val() + '</td>' +

			'<td style="display: none;" class="tbl_dtl_stuff_via_id">' + DTL_VIA.val() + '</td>' +
			'<td class="tbl_dtl_stuff_via_name">' + via_val + '</td>' +

			'<td style="display: none;" class="tbl_dtl_stuff_kemasan_id">' + dtl_kemasan + '</td>' +
			'<td style="display: none;" class="tbl_dtl_stuff_kemasan">' + kemasan_val + '</td>' +
			'<td class="tbl_dtl_stuff_kemasan_label">' + kemasan_label + '</td>' +

			'<td class="tbl_dtl_stuff_date_start">' + DTL_TGL_START.val() + '</td>' +

			'<td class="tbl_dtl_stuff_date_end">' + DTL_TGL_END.val() + '</td>' +

			'<td style="' + show_tgl_rec + '" class="tbl_dtl_stuff_rec_date">' + DTL_TGL_REC + '</td>' +

			'<td style="' + show_tgl_del + '" class="tbl_dtl_stuff_del_date">' + DTL_TGL_DEL + '</td>' +

			'<td>' +
			'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
			'</td>' +
			'</tr>'
		);

	}

	$('#btn-modal-kirim').click(function() {
		save_stuffing();
		return false;
	});

	function save_stuffing() {
		$('#modal-default').modal('hide');
		var details = [];
		var file = [];
		var no_req = $('#STUFF_NO').val();

		$('#detail-list tbody tr').each(function() {
			var dtl_stuff_id = $(this).find('.tbl_dtl_stuff_id').html();

			var cont_owner = $(this).find('.tbl_dtl_stuff_owner').html();
			var cont_owner_id = $(this).find('.tbl_dtl_stuff_owner_id').html();

			var no_cont = $(this).find('.tbl_dtl_stuff_no_cont').html();

			var size_id = $(this).find('.tbl_dtl_stuff_size_id').html();
			var size_name = $(this).find('.tbl_dtl_stuff_size_name').html();

			var type_id = $(this).find('.tbl_dtl_stuff_type_id').html();
			var type_name = $(this).find('.tbl_dtl_stuff_type_name').html();

			var status_id = $(this).find('.tbl_dtl_stuff_status_id').html();
			var status_name = $(this).find('.tbl_dtl_stuff_status_name').html();

			var sifat_id = $(this).find('.tbl_dtl_character_id').html();
			var sifat_name = $(this).find('.tbl_dtl_character_name').html();

			var kemasan_id = $(this).find('.tbl_dtl_stuff_kemasan_id').html();
			var kemasan_name = $(this).find('.tbl_dtl_stuff_kemasan').html();

			var via_id = $(this).find('.tbl_dtl_stuff_via_id').html();
			var via_name = $(this).find('.tbl_dtl_stuff_via_name').html();

			var start_date = $(this).find('.tbl_dtl_stuff_date_start').html();

			var end_date = $(this).find('.tbl_dtl_stuff_date_end').html();

			var rec_date = $(this).find('.tbl_dtl_stuff_rec_date').html();

			var del_date = $(this).find('.tbl_dtl_stuff_del_date').html();

			var tamp = {
				"stuff_dtl_id": null,
				"stuff_hdr_id": null,
				"stuff_dtl_owner": cont_owner_id,
				"stuff_dtl_owner_name": cont_owner,
				"stuff_dtl_cont": no_cont,
				"stuff_dtl_cont_size": size_id,
				"stuff_dtl_cont_type": type_id,
				"stuff_dtl_cont_status": status_id,
				"stuff_dtl_cont_danger": sifat_id,
				"stuff_dtl_via": via_id,
				"stuff_dtl_via_name": via_name,
				"stuff_dtl_rec_date": rec_date,
				"stuff_dtl_del_date": del_date,
				"stuff_dtl_start_date": start_date,
				"stuff_dtl_end_date": end_date,
				"stuff_dtl_cmdty_id": kemasan_id,
				"stuff_dtl_cmdty_name": kemasan_name,
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
			"service_branch_id": $('#STUFF_TERMINAL').find('option:selected').attr('brchid'),
			"service_branch_code": $('#STUFF_TERMINAL').val(),
			"data": [
				"HEADER",
				"DETAIL",
				"FILE"
			],
			"HEADER": {
				"DB": "omuster",
				"TABLE": "TX_HDR_STUFF",
				"PK": "STUFF_ID",
				"VALUE": [{
					"STUFF_ID": $('#STUFF_ID').val(),
					"STUFF_NO": no_req,
					"STUFF_DATE": $('#STUFF_DATE').val(),
					"STUFF_PAYMETHOD": $('#STUFF_PAYMETHOD').val(),
					"STUFF_CUST_ID": "<?= $this->session->userdata('customerid_phd') ?>",
					"STUFF_CUST_NAME": "<?= $this->session->userdata('customernamealt_phd') ?>",
					"STUFF_CUST_NPWP": "<?= $this->session->userdata('npwp_phd') ?>",
					"STUFF_CUST_ACCOUNT": null,
					"STUFF_STACKBY_ID": "<?= $this->session->userdata('customerid_phd') ?>",
					"STUFF_STACKBY_NAME": "<?= $this->session->userdata('customernamealt_phd') ?>",
					"STUFF_VESSEL_CODE": $('#STUFF_VESSEL_CODE').val(),
					"STUFF_VESSEL_NAME": $('#STUFF_VESSEL').val(),
					"STUFF_VOYIN": $('#STUFF_VOYIN').val(),
					"STUFF_VOYOUT": $('#STUFF_VOYOUT').val(),
					"STUFF_VVD_ID": $('#STUFF_VESSEL_PKK').val(),
					"STUFF_VESSEL_ETA": $('#STUFF_ETA').val(),
					"STUFF_VESSEL_ETD": $('#STUFF_ETD').val(),
					"STUFF_BRANCH_ID": $('#STUFF_TERMINAL').find('option:selected').attr('brchid'),
					"STUFF_NOTA": $('#STUFF_ID_NOTA').val(),
					"STUFF_FROM": $('#STUFF_FROM').val(),
					"STUFF_CREATE_BY": "<?= $this->session->userdata('customerid_phd') ?>",
					"STUFF_STATUS": "1",
					"STUFF_VESSEL_AGENT": $('#STUFF_VESSEL_AGENT').val(),
					"STUFF_VESSEL_AGENT_NAME": $('#STUFF_VESSEL_AGENT').val(),
					"STUFF_CUST_ADDRESS": "<?= $this->session->userdata('address_phd') ?>",
					"STUFF_BRANCH_CODE": $('#STUFF_TERMINAL').val(),
					"STUFF_PBM_ID": $('#STUFF_PBM_ID').val(),
					"STUFF_PBM_NAME": $('#STUFF_PBM_NAME').val(),
					"STUFF_VESSEL_PKK": $('#STUFF_VESSEL_PKK').val(),
					"APP_ID": "2"
				}]
			},
			"DETAIL": {
				"DB": "omuster",
				"TABLE": "TX_DTL_STUFF",
				"FK": [
					"stuff_hdr_id",
					"stuff_id"
				],
				"VALUE": (details.length > 0) ? details : []
			},
			"FILE": {
				"DB": "omuster",
				"TABLE": "TX_DOCUMENT",
				"FK": [
					"REQ_NO",
					"stuff_no"
				],
				"VALUE": ((file.length > 0) ? file : [])
			}
		}
		console.log(arrData);
		$.blockUI();

		var STUFF_TERMINAL = $('#STUFF_TERMINAL').val();
		var STUFF_PBM_NAME = $('#STUFF_PBM_NAME').val();
		var STUFF_DATE = $('#STUFF_DATE').val();
		var STACK_BY = $('#STUFF_PENUMPUKAN_OLEH_NAME').val();
		var STUFF_FROM = $('#STUFF_FROM').val();
		var STUFF_PAYMENT_METHOD = $('#STUFF_PAYMETHOD').val();
		var STUFF_VESSEL = $('#STUFF_VESSEL_NAME').val();

		if (STUFF_TERMINAL == 'not-selected') {
			$.unblockUI();
			alert('Terminal Harus diisi !!');
			return false;
		} else if (STUFF_PBM_NAME == '') {
			$.unblockUI();
			alert('PBM / EMKL Harus diisi !!');
			return false;
		} else if (STUFF_DATE == '') {
			$.unblockUI();
			alert('Tanggal Harus diisi !!');
			return false;
		} else if (STACK_BY == '') {
			$.unblockUI();
			alert('Penumpukan Oleh Harus diisi !!');
			return false;
		} else if (STUFF_FROM == 'not-selected') {
			$.unblockUI();
			alert('From Harus diisi !!');
			return false;
		} else if (STUFF_PAYMENT_METHOD == 'not-selected') {
			$.unblockUI();
			alert('Payment Method Harus diisi !!');
			return false;
		} else if (STUFF_VESSEL == '') {
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
			url: "<?= ROOT ?>npksbilling/stuffing/save_stuff/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function(data) {
				if (data.success === 'S') {
					var temp = JSON.parse(data.data);
					var no_req = temp['header']['stuff_no'];
					var notification = new NotificationFx({
						message: '<p>Data ' + no_req + ' Berhasil Disimpan</p><br/>',
						layout: 'growl',
						effect: 'jelly',
						type: 'success'
					});
					stuffing_log(no_req);
					setTimeout(function() {
						window.location = "<?= ROOT ?>npksbilling/stuffing";
					}, 3000);
				} else {
					alert("Data Gagal Disimpan;");
				}
				$.unblockUI();
			}
		});
	}

	function stuffing_log(no_req) {
		var status_req = $('#STUFF_NO').val();

		$.ajax({
			url: "<?= ROOT ?>npksbilling/transaction_log/stuffing_log",
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

	function get_id_nota() {
		$.ajax({
			url: "<?= ROOT ?>npksbilling/stuffing/get_nota_id",
			type: 'GET',
			data: {},
			success: function(data) {
				$.unblockUI();
				var obj = JSON.parse(JSON.parse(data));
				if (obj.result[0]) {
					$('#STUFF_ID_NOTA').val(obj.result[0].nota_id);
					$("#STUFF_ID_NOTA").val();
				} else {
					$('#STUFF_ID_NOTA').val(3);
					$("#STUFF_ID_NOTA").val();
				}
				set_detail();
			}
		});
	}

	function set_detail() {
		if ($("#STUFF_ID_NOTA").val() == 7) {
			$('#dtl-rec-del').html('<div class="form-group col-xs-12"><label for="datepickerDate">Tanggal Receiving</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input id="DTL_TGL_REC" name="DTL_TGL_REC" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required=""></div></div>');
			$('#detail-list thead').append(
				'<tr>' +
				'<th>' + 'Container Owner' + '</th>' +
				'<th>' + 'No Container' + '</th>' +
				'<th>' + 'Ukuran' + '</th>' +
				'<th>' + 'Type' + '</th>' +
				'<th>' + 'Status' + '</th>' +
				'<th>' + 'Dangerous Goods' + '</th>' +
				'<th>' + 'Stuffing Via' + '</th>' +
				'<th>' + 'Kemasan' + '</th>' +
				'<th>' + 'Start Stuffing' + '</th>' +
				'<th>' + 'End Stuffing' + '</th>' +
				'<th>' + 'Tanggal Receiving' + '</th>' +
				'<th>' + '</th>' +
				'</tr>'
			);
		} else if ($("#STUFF_ID_NOTA").val() == 8) {
			$('#dtl-rec-del').html('<div class="form-group col-xs-6"><label for="datepickerDate">Tanggal Receiving</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input id="DTL_TGL_REC" name="DTL_TGL_REC" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required=""></div></div><div class="form-group col-xs-6"><label for="datepickerDate">Tanggal Delivery</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input id="DTL_TGL_DEL" name="DTL_TGL_DEL" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required=""></div></div>');
			$('#detail-list thead').append(
				'<tr>' +
				'<th>' + 'Container Owner' + '</th>' +
				'<th>' + 'No Container' + '</th>' +
				'<th>' + 'Ukuran' + '</th>' +
				'<th>' + 'Type' + '</th>' +
				'<th>' + 'Status' + '</th>' +
				'<th>' + 'Dangerous Goods' + '</th>' +
				'<th>' + 'Stuffing Via' + '</th>' +
				'<th>' + 'Kemasan' + '</th>' +
				'<th>' + 'Start Stuffing' + '</th>' +
				'<th>' + 'End Stuffing' + '</th>' +
				'<th>' + 'Tanggal Receiving' + '</th>' +
				'<th>' + 'Tanggal Delivery' + '</th>' +
				'<th>' + '</th>' +
				'</tr>'
			);
		} else if ($("#STUFF_ID_NOTA").val() == 9) {
			$('#dtl-rec-del').html('<div class="form-group col-xs-12"><label for="datepickerDate">Tanggal Delivery</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input id="DTL_TGL_DEL" name="DTL_TGL_DEL" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required=""></div></div>');
			$('#detail-list thead').append(
				'<tr>' +
				'<th>' + 'Container Owner' + '</th>' +
				'<th>' + 'No Container' + '</th>' +
				'<th>' + 'Ukuran' + '</th>' +
				'<th>' + 'Type' + '</th>' +
				'<th>' + 'Status' + '</th>' +
				'<th>' + 'Dangerous Goods' + '</th>' +
				'<th>' + 'Stuffing Via' + '</th>' +
				'<th>' + 'Kemasan' + '</th>' +
				'<th>' + 'Start Stuffing' + '</th>' +
				'<th>' + 'End Stuffing' + '</th>' +
				'<th>' + 'Tanggal Delivery' + '</th>' +
				'<th>' + '</th>' +
				'</tr>'
			);
		} else {
			$('#detail-list thead').append(
				'<tr>' +
				'<th>' + 'Container Owner' + '</th>' +
				'<th>' + 'No Container' + '</th>' +
				'<th>' + 'Ukuran' + '</th>' +
				'<th>' + 'Type' + '</th>' +
				'<th>' + 'Status' + '</th>' +
				'<th>' + 'Dangerous Goods' + '</th>' +
				'<th>' + 'Stuffing Via' + '</th>' +
				'<th>' + 'Kemasan' + '</th>' +
				'<th>' + 'Start Stuffing' + '</th>' +
				'<th>' + 'End Stuffing' + '</th>' +
				'<th>' + '</th>' +
				'</tr>'
			);
		}
		$("#DTL_TGL_REC").datetimepicker({
			format: "Y-m-d H:i:s",
			autoclose: true,
			todayHighlight: true,
		});
		$("#DTL_TGL_DEL").datetimepicker({
			format: "Y-m-d H:i:s",
			autoclose: true,
			todayHighlight: true,
		});
	}

	$(function() {
		$("#DTL_TGL_START").datetimepicker({
			format: "Y-m-d H:i:s",
			autoclose: true,
			todayHighlight: true,
		});
		$("#DTL_TGL_END").datetimepicker({
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