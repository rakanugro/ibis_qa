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
	.hidden_content { display: none; }
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Delivery Extension Reference</b></h2>
			</header>
			
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Request Reff</label>
					<input name="DEL_CARGO_EXT_FROM" id="DEL_CARGO_EXT_FROM" type="text" class="form-control" placeholder="Autocomplete" style="text-transform: uppercase;" disabled>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Tanggal Request Reff</label>
					<input name="DEL_CARGO_EXT_FROM_DATE" id="DEL_CARGO_EXT_FROM_DATE" type="text" class="form-control" placeholder="Tanggal Request Reff" readonly>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="auto-generate hidden_content">
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
				</header>
				
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label>PBM / EMKL</label>
						<input name="DEL_CARGO_PBM_ID" id="DEL_CARGO_PBM_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
						<input name="DEL_CARGO_PBM_NAME" id="DEL_CARGO_PBM_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nomor Request</label>
						<input name="DEL_CARGO_NO" id="DEL_CARGO_NO" type="text" placeholder="Auto Generate" class="form-control" disabled>
						<input name="DEL_CARGO_ID" id="DEL_CARGO_ID" type="hidden" placeholder="Auto Generate" value="<?=$extension_id?>" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="DEL_CARGO_STACKBY_NAME" id="DEL_CARGO_STACKBY_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="DEL_CARGO_STACKBY_ID" id="DEL_CARGO_STACKBY_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Date</label>
						<input name="DEL_CARGO_DATE" id="DEL_CARGO_DATE" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>To</label>
						<input name="DEL_CARGO_TO" id="DEL_CARGO_TO" type="hidden" placeholder="To" class="form-control" disabled>
						<input name="DEL_CARGO_TO_NAME" id="DEL_CARGO_TO_NAME" type="text" placeholder="To" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Payment Method</label>
						<input name="DEL_CARGO_PAYMETHOD" id="DEL_CARGO_PAYMETHOD" type="hidden" placeholder="Payment Method" class="form-control" disabled>
						<input name="DEL_CARGO_PAYMETHOD_NAME" id="DEL_CARGO_PAYMETHOD_NAME" type="text" placeholder="Payment Method" class="form-control" disabled>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Vessel</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label>Vessel</label>
						<input name="DEL_CARGO_VESSEL_NAME" id="DEL_CARGO_VESSEL_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="DEL_CARGO_VESSEL_CODE" id="DEL_CARGO_VESSEL_CODE" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agent</label>
						<input name="DEL_CARGO_VESSEL_AGENT" id="DEL_CARGO_VESSEL_AGENT" type="hidden" placeholder="Nama Agent" class="form-control" disabled>
						<input name="DEL_CARGO_VESSEL_AGENT_NAME" id="DEL_CARGO_VESSEL_AGENT_NAME" type="text" placeholder="Nama Agent" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="DEL_CARGO_VESSEL_PKK" id="DEL_CARGO_VESSEL_PKK" type="text" placeholder="Nomor PKK" class="form-control" disabled>
						<input name="DEL_CARGO_VVD_ID" id="DEL_CARGO_VVD_ID" type="hidden" placeholder="Nomor PKK" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="DEL_CARGO_VOYIN" id="DEL_CARGO_VOYIN" type="text" placeholder="Voyage In" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="DEL_CARGO_VOYOUT" id="DEL_CARGO_VOYOUT" type="text" placeholder="Voyage Out" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="DEL_CARGO_VESSEL_ETA" id="DEL_CARGO_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="DEL_CARGO_VESSEL_ETD" id="DEL_CARGO_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
						<div class="form-group example-twitter-oss">
							<div class="form-group col-xs-1"><br/>
								<a class="btn btn-danger" id="add_file">
							        <span class="glyphicon glyphicon-plus"></span> Tambah Dokumen
							    </a>
							</div>
						</div>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div id='show-detail'>
		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
					</header>

					<div class="main-box-body clearfix">
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
									<th>Delivery Via</th>
									<th>Tanggal Delivery</th>
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
	</div>

	<input type="hidden" id="DEL_CARGO_CREATE_BY">
	<input type="hidden" id="DEL_CARGO_CREATE_DATE">
	<input type="hidden" id="DEL_CARGO_EXT_LOOP">
	<!-- <input type="hidden" id="DEL_MARK"> -->
	<input type="hidden" id="DEL_CARGO_BRANCH_CODE">
	<input type="hidden" id="DEL_CARGO_BRANCH_ID">
	<!-- <input type="hidden" id="DEL_CLOSING_TIME"> -->

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">		
					<div class="form-group example-twitter-oss pull-right">
						<a class="btn btn-danger btn-footer open-AddBookDialogApprove"  href="#" data-toggle="modal" data-target="#modal-save">
							<span class="glyphicon glyphicon-ok-sign" title="Save Request"></span>&nbsp;&nbsp;Save
						</a>
						<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<div class="modal fade" id="modal-save">
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
				<button id="btn-modal-save" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</div>
</div>



<script>

	var counterRental = 0;
	var counterRetribution = 0;
	var counterdoc = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {

		$("#add_file").on("click", function () {
			var record = <?php echo json_encode($docType); ?>;

			counterdoc++;

		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#DEL_NO').val();

		    cols += '';

		    cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control" maxlength="40"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

		    cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';

		    cols += '<div class="col-xs-4"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" id="DOC_NAME'+counterdoc+'" doc_name="" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc('+counterdoc+')"></div>';

			cols +=	'<input type="hidden" id="DOC_PATH'+counterdoc+'" name="DOC_PATH'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols +=	'<input type="hidden" id="DOC_BASH'+counterdoc+'" name="DOC_BASH'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols +=	'<input type="hidden" id="DOC_ID'+counterdoc+'" name="DOC_ID'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';
		    
		    newRow.append(cols);

			$(".list_file").append(newRow);

			var toAppend = '';
			for(var i=0;i<record.length;i++){
				toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
			}
			$('#DOC_TYPE'+counterdoc).append(toAppend);

		});

		$("table.list_file").on("click", ".ibtnDel", function (event) {
		        $(this).closest("tr").remove();       
		        counterdoc--;
		});

		$('#DEL_DATE').datetimepicker({
			format:'Y-m-d H:i',
			formatTime:'H:i',
			formatDate:'Y/m/d',
			timepicker:true,
			datepicker:true,
		});

		
		var extension_id = $("#DEL_CARGO_ID").val();

		$.blockUI();
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/deliverybarangext/getDataReq?extension_id="+ extension_id,
			success: function(data){
				var obj = JSON.parse(JSON.parse(data));
				data = obj;
				console.log(data);
				$('#detail-list tbody tr').remove();

				var req_method = (data['HEADER'][0]['del_cargo_paymethod'] == 2)? "PIUTANG" : "ADVANCED PAYMENT";
				var req_to = '';
				if ((data['HEADER'][0]['del_cargo_to'] == 1)){
					req_to = "DEPO";
				}else if((data['HEADER'][0]['del_cargo_to'] == 2)){
					req_to = "TPK";
				}else{
					req_to = "GUDANG";
				}
						
				// EXTENSION REFERENCE AND HEADER
				$('#DEL_CARGO_EXT_FROM_DATE').val(data['HEADER'][0]['del_cargo_ext_from_date']);
				$('#DEL_CARGO_EXT_FROM').val(data['HEADER'][0]['del_cargo_ext_from']);
				$('.auto-generate').removeClass('hidden_content');
				$('#DEL_CARGO_DATE').val(data['HEADER'][0]['del_cargo_date']);
				$('#DEL_CARGO_NO').val(data['HEADER'][0]['del_cargo_no']);
				$('#DEL_CARGO_PBM_NAME').val(data['HEADER'][0]['del_cargo_pbm_name']);
				$('#DEL_CARGO_PBM_ID').val(data['HEADER'][0]['del_cargo_pbm_id']);
				$('#DEL_CARGO_STACKBY_NAME').val(data['HEADER'][0]['del_cargo_stackby_name']);
				$('#DEL_CARGO_STACKBY_ID').val(data['HEADER'][0]['del_cargo_stackby_id']);
				$('#DEL_CARGO_TO').val(data['HEADER'][0]['del_cargo_to']);
				$('#DEL_CARGO_TO_NAME').val(req_to);
				$('#DEL_CARGO_PAYMETHOD').val(data['HEADER'][0]['del_cargo_paymethod']);						
				$('#DEL_CARGO_PAYMETHOD_NAME').val(req_method);						
						
				// VESSEL
				$('#DEL_CARGO_VESSEL_NAME').val(data['HEADER'][0]['del_cargo_vessel_name']);
				$('#DEL_CARGO_VESSEL_CODE').val(data['HEADER'][0]['del_cargo_vessel_code']);
				$('#DEL_CARGO_VOYIN').val(data['HEADER'][0]['del_cargo_voyin']);
				$('#DEL_CARGO_VOYOUT').val(data['HEADER'][0]['del_cargo_voyout']);
				$('#DEL_CARGO_VESSEL_PKK').val(data['HEADER'][0]['del_cargo_vessel_pkk']);
				$('#DEL_CARGO_VVD_ID').val(data['HEADER'][0]['del_cargo_vvd_id']);
				$("#DEL_CARGO_VESSEL_ETA").val(data['HEADER'][0]['del_cargo_vessel_eta']);
				$("#DEL_CARGO_VESSEL_ETD").val(data['HEADER'][0]['del_cargo_vessel_etd']);

				$('#DEL_CARGO_CREATE_BY').val(data['HEADER'][0]['del_cargo_create_by']);								
				$('#DEL_CARGO_EXT_LOOP').val(data['HEADER'][0]['del_cargo_ext_loop']);						
				$('#DEL_CARGO_BRANCH_CODE').val(data['HEADER'][0]['del_cargo_branch_code']);						
				$('#DEL_CARGO_BRANCH_ID').val(data['HEADER'][0]['del_cargo_branch_id']);
															

				// NEW DOCUMENTS
				var record = <?php echo json_encode($docType); ?>;
				data.FILE.forEach(function(file, index){
					if (data.FILE.length != 0) {

						counterdoc++;
						var newRow = $("<tr>");
						var cols = "";						

						cols += '';
						cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control" maxlength="40"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

						cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" value="'+file.doc_no+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';

						cols += '<div class="col-xs-4"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" value="'+file.doc_name+'" id="DOC_NAME'+counterdoc+'" doc_name="'+file.doc_name+'" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc('+counterdoc+')"><a href="'+apiUrl+file.doc_path+'" target="_blank">'+file.doc_name+'</a></div>';

						cols +=	'<input type="hidden" id="DOC_PATH'+counterdoc+'" name="DOC_PATH'+counterdoc+'" value="'+file.doc_path+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

						cols +=	'<input type="hidden" id="DOC_BASH'+counterdoc+'" name="DOC_BASH'+counterdoc+'" value="'+file.base64+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

						cols +=	'<input type="hidden" id="DOC_ID'+counterdoc+'" name="DOC_ID'+counterdoc+'" value="'+file.doc_id+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

						cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';

						newRow.append(cols);

						$(".list_file").append(newRow);

						var toAppend = '';
						for(var i=0;i<record.length;i++){
							var isSelect = (record[i]['reff_id'] == file.doc_type) ? 'selected' : '';
							toAppend += '<option value="'+record[i]['reff_id']+'" '+ isSelect +'>'+record[i]['reff_name']+'</option>';
						}
						$('#DOC_TYPE'+counterdoc).append(toAppend);
					}
				});
						
				// DETAILS
				for (let index = 0; index < data['DETAIL'].length; index++) {
					var owner_name 	= (data['DETAIL'][index]['del_cargo_dtl_owner_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_owner_name'] : "";
					var owner_id = (data['DETAIL'][index]['del_cargo_dtl_owner'] != null) ? data['DETAIL'][index]['del_cargo_dtl_owner'] : "";
					var no_bl = (data['DETAIL'][index]['del_cargo_dtl_si_no'] != null) ? data['DETAIL'][index]['del_cargo_dtl_si_no'] : "";
					var jumlah = (data['DETAIL'][index]['del_cargo_dtl_qty'] != null) ? data['DETAIL'][index]['del_cargo_dtl_qty'] : "";
					var sifat_id = (data['DETAIL'][index]['del_cargo_dtl_character_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_character_id'] : "";
					var sifat_name = (data['DETAIL'][index]['del_cargo_dtl_character_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_character_name'] : "";
					var kemasan_id = (data['DETAIL'][index]['del_cargo_dtl_pkg_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_pkg_id'] : "";
					var kemasan_name = (data['DETAIL'][index]['del_cargo_dtl_pkg_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_pkg_name'] : "";
					var barang_id = (data['DETAIL'][index]['del_cargo_dtl_cmdty_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_cmdty_id'] : "";
					var barang_name = (data['DETAIL'][index]['del_cargo_dtl_cmdty_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_cmdty_name'] : "";
					var satuan_id = (data['DETAIL'][index]['del_cargo_dtl_unit_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_unit_id'] : "";
					var satuan_name = (data['DETAIL'][index]['del_cargo_dtl_unit_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_unit_name'] : "";
					var via_id = (data['DETAIL'][index]['del_cargo_dtl_via'] != null) ? data['DETAIL'][index]['del_cargo_dtl_via'] : "";
					var via_name = (data['DETAIL'][index]['del_cargo_dtl_via_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_via_name'] : "";
					var tanggal = (data['DETAIL'][index]['del_cargo_dtl_del_date'] != null) ? data['DETAIL'][index]['del_cargo_dtl_del_date'] : "";
					var create_date = (data['DETAIL'][index]['del_cargo_dtl_create_date'] != null) ? data['DETAIL'][index]['del_cargo_dtl_create_date'] : "";
					var stack_date = (data['DETAIL'][index]['del_cargo_dtl_stack_date'] != null) ? data['DETAIL'][index]['del_cargo_dtl_stack_date'] : "";
					var pkg_parent_id = (data['DETAIL'][index]['del_cargo_dtl_pkg_parent_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_pkg_parent_id'] : "";
					var dtl_iscancelled = (data['DETAIL'][index]['del_cargo_dtl_iscancelled'] != null) ? data['DETAIL'][index]['del_cargo_dtl_iscancelled'] : "";
					var stack_area_id = (data['DETAIL'][index]['del_cargo_dtl_stack_area'] != null) ? data['DETAIL'][index]['del_cargo_dtl_stack_area'] : "";
					var stack_area_name = (data['DETAIL'][index]['del_cargo_dtl_stack_area_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_stack_area_name'] : "";
					var real_qty = (data['DETAIL'][index]['del_cargo_dtl_real_qty'] != null) ? data['DETAIL'][index]['del_cargo_dtl_real_qty'] : "";
					var canc_qty = (data['DETAIL'][index]['del_cargo_dtl_canc_qty'] != null) ? data['DETAIL'][index]['del_cargo_dtl_canc_qty'] : "";
					var real_date = (data['DETAIL'][index]['del_cargo_dtl_real_date'] != null) ? data['DETAIL'][index]['del_cargo_dtl_real_date'] : "";
					var fl_real = (data['DETAIL'][index]['del_cargo_fl_real'] != null) ? data['DETAIL'][index]['del_cargo_fl_real'] : "";
					var dtl_id = (data['DETAIL'][index]['del_cargo_dtl_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_id'] : "";
					var hdr_id = (data['DETAIL'][index]['del_cargo_hdr_id'] != null) ? data['DETAIL'][index]['del_cargo_hdr_id'] : "";


					$('#detail-list tbody').append(
						'<tr>' +
							'<td class="TBL_DTL_CARGO_OWNER_NAME">'+ owner_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_OWNER_ID">'+ owner_id +'</td>' +
							'<td class="TBL_DTL_CARGO_SI_NO">'+ no_bl +'</td>' +
							'<td class="TBL_DTL_CARGO_QTY"><input id="TBL_DTL_CARGO_QTY" type="number" class="form-control" value="'+ jumlah +'"></td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_CHARACTER_ID">'+ sifat_id +'</td>' +
							'<td class="TBL_DTL_CARGO_CHARACTER_NAME">'+ sifat_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_PKG_ID">'+ kemasan_id +'</td>' +
							'<td class="TBL_DTL_CARGO_PKG_NAME">'+ kemasan_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_CMDTY_ID">'+ barang_id +'</td>' +
							'<td class="TBL_DTL_CARGO_CMDTY_NAME">'+ barang_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_UNIT_ID">'+ satuan_id +'</td>' +
							'<td class="TBL_DTL_CARGO_UNIT_NAME">'+ satuan_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_VIA_ID">'+ via_id +'</td>' +
							'<td class="TBL_DTL_CARGO_VIA_NAME">'+ via_name +'</td>' +
							'<td class="TBL_DTL_CARGO_DEL_DATE"><input id="TBL_DTL_CARGO_DEL_DATE" name="dtl_out" type="text" class="form-control" id="datepickerDate" value="'+ tanggal +'"></td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_CREATE_DATE">'+ create_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_STACK_DATE">'+ stack_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_PKG_PARENT_ID">'+ pkg_parent_id +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_ISCANCELLED">'+ dtl_iscancelled +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_STACK_AREA">'+ stack_area_id +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_STACK_AREA_NAME">'+ stack_area_name +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_REAL_QTY">'+ real_qty +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_FL_REAL">'+ fl_real +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_CANC_QTY">'+ canc_qty +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_REAL_DATE">'+ real_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_ID">'+ dtl_id +'</td>' +
							'<td style="display: none;" class="TBL_HDR_CARGO_ID">'+ hdr_id +'</td>' +
							'<td>' +
								'<a class="btn btn-primary btn-delete-detail"><i class="fa fa-trash-o"></i></a>' +
							'</td>' +
						'</tr>'
					);	
				}

				$('#TBL_DTL_CARGO_DEL_DATE').datetimepicker({
					format: 'Y-m-d H:i',
					timepicker:true,
					datepicker:true,
				});
				$.unblockUI();
			}
		});


		// DETAIL
		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			$(this).closest("tr").remove();       
		});
		// END DETAIL

	});

	function encodedoc (counterdoc){
		var inputf = document.getElementById('DOC_NAME'+counterdoc).files[0];
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
				$("#DOC_PATH"+counterdoc).val(path);
				$("#DOC_NAME"+counterdoc).attr("doc_name",path);
				$("#DOC_BASH"+counterdoc).val(byteArray);

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
							//$("#btn-show").prop('disabled', false);
						case "ffd8ffe0":
						case "ffd8ffe1":
						case "ffd8ffe2":
							return 'image/jpeg'
						default:
							alert('File harus PDF');
							$('#DOC_NAME'+counterdoc).val('');
							//$("#btn-show").prop('disabled', true);
					}
				}
			}
		}
	}

	$(document).on("click", ".open-AddBookDialogApprove", function () {
		$('#btn-modal-save').click(function(){ 
			save_extension(); 
			return false; 
		});
	});

	function save_extension() {
		$('#modal-save').modal('hide');
		var details = [];
		var files = [];
		var del_no = $('#DEL_CARGO_EXT_FROM').val();

		$('#detail-list tbody tr').each(function(){
			var sifat_name		= $(this).find('.TBL_DTL_CARGO_CHARACTER_NAME').html();
			var kemasan_name	= $(this).find('.TBL_DTL_CARGO_PKG_NAME').html();
			var barang_name		= $(this).find('.TBL_DTL_CARGO_CMDTY_NAME').html();
			var via_name		= $(this).find('.TBL_DTL_CARGO_VIA_NAME').html();
			var satuan_name		= $(this).find('.TBL_DTL_CARGO_UNIT_NAME').html();
			kemasan_name 	= kemasan_name != "" ? kemasan_name : null;
			barang_name 	= barang_name != "" ? barang_name : null;
			via_name 		= via_name != "" ? via_name : null;
			satuan_name 	= satuan_name != "" ? satuan_name : null;
			sifat_name 		= sifat_name != "" ? sifat_name : null;

			var temp = {
				"DEL_CARGO_DTL_ID": $(this).find('.TBL_DTL_CARGO_ID').html(),
                "DEL_CARGO_HDR_ID": $(this).find('.TBL_HDR_CARGO_ID').html(),
                "DEL_CARGO_DTL_SI_NO": $(this).find('.TBL_DTL_CARGO_SI_NO').html(),
                "DEL_CARGO_DTL_QTY": $(this).find('#TBL_DTL_CARGO_QTY').val(),
                "DEL_CARGO_DTL_VIA": $(this).find('.TBL_DTL_CARGO_VIA_ID').html(),
                "DEL_CARGO_DTL_PKG_ID": $(this).find('.TBL_DTL_CARGO_PKG_ID').html(),
                "DEL_CARGO_DTL_PKG_NAME": kemasan_name,
                "DEL_CARGO_DTL_UNIT_ID": $(this).find('.TBL_DTL_CARGO_UNIT_ID').html(),
                "DEL_CARGO_DTL_UNIT_NAME": satuan_name,
                "DEL_CARGO_DTL_CMDTY_ID": $(this).find('.TBL_DTL_CARGO_CMDTY_ID').html(),
                "DEL_CARGO_DTL_CMDTY_NAME": barang_name,
                "DEL_CARGO_DTL_CHARACTER_ID": $(this).find('.TBL_DTL_CARGO_CHARACTER_ID').html(),
                "DEL_CARGO_DTL_CHARACTER_NAME": sifat_name,
                "DEL_CARGO_DTL_DEL_DATE": $(this).find('#TBL_DTL_CARGO_DEL_DATE').val(),
                "DEL_CARGO_DTL_CREATE_DATE": $(this).find('.TBL_DTL_CARGO_CREATE_DATE').html(),
                "DEL_CARGO_DTL_STACK_DATE": $(this).find('.TBL_DTL_CARGO_STACK_DATE').html(),
                "DEL_CARGO_DTL_EXT_DATE": null,
                "DEL_CARGO_DTL_VIA_NAME": via_name,
                "DEL_CARGO_DTL_OWNER": $(this).find('.TBL_DTL_CARGO_OWNER_ID').html(),
                "DEL_CARGO_DTL_OWNER_NAME": $(this).find('.TBL_DTL_CARGO_OWNER_NAME').html(),
                "DEL_CARGO_DTL_PKG_PARENT_ID": $(this).find('.TBL_DTL_CARGO_PKG_PARENT_ID').html(),
                "DEL_CARGO_DTL_ISCANCELLED": $(this).find('.TBL_DTL_CARGO_ISCANCELLED').html(),
                "DEL_CARGO_DTL_STACK_AREA": $(this).find('.TBL_DTL_CARGO_STACK_AREA').html(),
                "DEL_CARGO_DTL_STACK_AREA_NAME": $(this).find('.TBL_DTL_CARGO_STACK_AREA_NAME').html(),
                "DEL_CARGO_DTL_REAL_QTY": $(this).find('.TBL_DTL_CARGO_REAL_QTY').html(),
                "DEL_CARGO_FL_REAL": $(this).find('.TBL_DTL_CARGO_FL_REAL').html(),
                "DEL_CARGO_DTL_CANC_QTY": $(this).find('.TBL_DTL_CARGO_CANC_QTY').html(),
                "DEL_CARGO_DTL_REAL_DATE": $(this).find('.TBL_DTL_CARGO_REAL_DATE').html()
			}
			details.push(temp);
		});

		for (let index = 1; index <= counterdoc; index++) {
			var doc_no 		= $('#DOC_NO'+index).val();
			var doc_path 	= $('#DOC_PATH'+index).val();
			var doc_type 	= $('#DOC_TYPE'+index).val();
			var doc_bash 	= $('#DOC_BASH'+index).val();
			var doc_id 		= $('#DOC_ID'+index).val();
			var doc_name 	= $('#DOC_NAME'+index).attr("doc_name");
			if (doc_no != '' || doc_name != '' || doc_no != 'undefined' || doc_name != 'undefined') {
				var temp = {
					"DOC_ID"	: doc_id,
					"REQ_NO"	: del_no,
					"DOC_NO"	: doc_no,
					"DOC_TYPE"	: doc_type,
					"DOC_NAME"	: doc_name,
					"PATH"		: doc_path,
					"BASE64"	: doc_bash
				}
				files.push(temp);
			}
		}

		arrData = 
			{
				"action": "saveheaderdetail",
				"service_branch_id" : "4",
				"service_branch_code" : "PTG",
			  	"data": [
				    "HEADER",
				    "DETAIL",
				    "FILE"
				],
				"HEADER": {
				    "DB": "omuster",
			        "TABLE": "TX_HDR_DEL_CARGO",
			        "PK": "DEL_CARGO_ID",
			        "VALUE": [
				    {
						"APP_ID": 2,
						"DEL_CARGO_ID": $('#DEL_CARGO_ID').val(),
		                "DEL_CARGO_NO": $('#DEL_CARGO_NO').val(),
		               	"DEL_CARGO_DATE": $('#DEL_CARGO_DATE').val(),
		                "DEL_CARGO_PAYMETHOD": $('#DEL_CARGO_PAYMETHOD').val(),
		                "DEL_CARGO_CUST_ID": "<?=$this->session->userdata('customerid_phd')?>",
		                "DEL_CARGO_CUST_NAME": "<?=$this->session->userdata('customernamealt_phd')?>",
		                "DEL_CARGO_CUST_NPWP": "<?=$this->session->userdata('npwp_phd')?>",
		                "DEL_CARGO_CUST_ACCOUNT": null,
		                "DEL_CARGO_STACKBY_ID": $('#DEL_CARGO_STACKBY_ID').val(),
		                "DEL_CARGO_STACKBY_NAME": $('#DEL_CARGO_STACKBY_NAME').val(),
		                "DEL_CARGO_VESSEL_CODE": $('#DEL_CARGO_VESSEL_CODE').val(),
		                "DEL_CARGO_VESSEL_NAME": $('#DEL_CARGO_VESSEL_NAME').val(),
		                "DEL_CARGO_VOYIN": $('#DEL_CARGO_VOYIN').val(),
		                "DEL_CARGO_VOYOUT": $('#DEL_CARGO_VOYOUT').val(),
		                "DEL_CARGO_VVD_ID": $('#DEL_CARGO_VVD_ID').val(),
		                "DEL_CARGO_VESSEL_ETA": $('#DEL_CARGO_VESSEL_ETA').val(),
	                	"DEL_CARGO_VESSEL_ETD": $('#DEL_CARGO_VESSEL_ETD').val(),
		                "DEL_CARGO_BRANCH_ID": $('#DEL_CARGO_BRANCH_ID').val(),
		                "DEL_CARGO_NOTA": "23",
		                "DEL_CARGO_TO": $('#DEL_CARGO_TO').val(),
		                "DEL_CARGO_CREATE_BY": "1",
		                "DEL_CARGO_STATUS": 1,
		                "DEL_CARGO_VESSEL_AGENT": "-",
		                "DEL_CARGO_VESSEL_AGENT_NAME": "-",
		                "DEL_CARGO_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
		                "DEL_CARGO_BRANCH_CODE": $('#DEL_CARGO_BRANCH_CODE').val(),
		                "DEL_CARGO_PBM_ID": $('#DEL_CARGO_PBM_ID').val(),
		                "DEL_CARGO_PBM_NAME": $('#DEL_CARGO_PBM_NAME').val(),
		                "DEL_CARGO_VESSEL_PKK": $('#DEL_CARGO_VESSEL_PKK').val(),
		                "DEL_CARGO_EXT_FROM": $('#DEL_CARGO_EXT_FROM').val(),
		                "DEL_CARGO_EXT_FROM_DATE": $('#DEL_CARGO_EXT_FROM_DATE').val(),
		                "DEL_CARGO_EXT_LOOP": parseInt($('#DEL_CARGO_EXT_LOOP').val())+1,
		                "DEL_CARGO_EXT_STATUS": "Y"
					}]
				},
				"DETAIL": {
				    "DB": "omuster",
			        "TABLE": "TX_DTL_DEL_CARGO",
			        "FK": [
				      	"DEL_CARGO_HDR_ID",
				      	"del_cargo_id"
				    ],
					"VALUE": (details.length > 0) ? details : []
				},
				"FILE": {
				    "DB": "omuster",
			        "TABLE": "TX_DOCUMENT",
			        "FK": [
				      	"REQ_NO",
				      	"del_cargo_no"
			    	],
					"VALUE": (files.length > 0) ? files : []
				}
			}

		console.log(arrData);
		//return false;

		if(details.length == 0){
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}
		else if(files.length == 0){
			$.unblockUI();
			alert('File harus diisi !!');
			return false;
		}
		
		$.blockUI();

		$.ajax({
			url: "<?=ROOT?>npksbilling/deliverybarangext/save_extension",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var response = JSON.parse(data.data);
					var req_no = response.header.del_cargo_no;

					var notification = new NotificationFx({
						message : '<p>Data '+req_no+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					deliverybarangext_log(req_no);
					setTimeout(function(){ window.location = "<?=ROOT?>npksbilling/deliverybarangext"; }, 3000);	
				} else {
					$.unblockUI();
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});	
	}

	function deliverybarangext_log(req_no) {
		var status_req = $('#DEL_CARGO_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/deliverybarangext_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				status_req		: status_req,
				no_req 			: req_no

			},
			success: function( data ) {
				if (data !=null) {
					console.log('Data Tersimpan ke LOG')
				}

			}
		});
	}

	function goBack() {
		window.history.back();
	}

</script>

