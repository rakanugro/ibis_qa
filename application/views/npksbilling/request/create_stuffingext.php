
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
					<input name="STUFF_EXT_FROM" id="STUFF_EXT_FROM" type="text" class="form-control" placeholder="Autocomplete" style="text-transform: uppercase;">
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Tanggal Request Reff</label>
					<input name="STUFF_EXT_FROM_DATE" id="STUFF_EXT_FROM_DATE" type="text" class="form-control" placeholder="Tanggal Request Reff" readonly>
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
						<input name="STUFF_PBM_ID" id="STUFF_PBM_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
						<input name="STUFF_PBM_NAME" id="STUFF_PBM_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nomor Request</label>
						<input name="STUFF_NO" id="STUFF_NO" type="text" placeholder="Auto Generate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="STUFF_STACKBY_NAME" id="STUFF_STACKBY_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="STUFF_STACKBY_ID" id="STUFF_STACKBY_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Date</label>
						<input name="STUFF_DATE" id="STUFF_DATE" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>To</label>
						<input name="STUFF_FROM" id="STUFF_FROM" type="hidden" placeholder="To" class="form-control" disabled>
						<input name="STUFF_FROM_NAME" id="STUFF_FROM_NAME" type="text" placeholder="To" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Payment Method</label>
						<input name="STUFF_PAYMETHOD" id="STUFF_PAYMETHOD" type="hidden" placeholder="Payment Method" class="form-control" disabled>
						<input name="STUFF_PAYMETHOD_NAME" id="STUFF_PAYMETHOD_NAME" type="text" placeholder="Payment Method" class="form-control" disabled>
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
						<input name="STUFF_VESSEL_NAME" id="STUFF_VESSEL_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="STUFF_VESSEL_CODE" id="STUFF_VESSEL_CODE" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agent</label>
						<input name="STUFF_VESSEL_AGENT_NAME" id="STUFF_VESSEL_AGENT_NAME" type="text" placeholder="Nama Agent" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="STUFF_VESSEL_PKK" id="STUFF_VESSEL_PKK" type="text" placeholder="Nomor PKK" class="form-control" disabled>
						<input name="STUFF_VVD_ID" id="STUFF_VVD_ID" type="hidden" placeholder="Nomor PKK" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="STUFF_VOYIN" id="STUFF_VOYIN" type="text" placeholder="Voyage In" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="STUFF_VOYOUT" id="STUFF_VOYOUT" type="text" placeholder="Voyage Out" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="STUFF_VESSEL_ETA" id="STUFF_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="STUFF_VESSEL_ETD" id="STUFF_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
									<th>Ex Batal SP 2</th>
									<th>Container Owner</th>
									<th>No Container</th>
									<th>Ukuran</th>
									<th>Type</th>
									<th>Status</th>
									<th>Dangerous Goods</th>
									<th>Stuffing Via</th>
									<th>Kemasan</th>
									<th>Start Stuffing</th>
									<th>End Stuffing</th>
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

	<input type="hidden" id="STUFF_CREATE_BY">
	<input type="hidden" id="STUFF_CREATE_DATE">
	<input type="hidden" id="STUFF_EXT_LOOP">
	<!-- <input type="hidden" id="STUFF_MARK"> -->
	<input type="hidden" id="STUFF_BRANCH_CODE">
	<input type="hidden" id="STUFF_BRANCH_ID">
	<!-- <input type="hidden" id="STUFF_CLOSING_TIME"> -->

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

	var counterdoc = 0;
	var counterdet = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {

		$("#add_file").on("click", function () {
			var record = <?php echo json_encode($docType); ?>;

			counterdoc++;

		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#DEL_NO').val();

		    cols += '';

		    cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

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

		// GET CURRENT DATE 

		var today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();
		var hour = today.getHours();
        var minute = today.getMinutes();
        var second = today.getSeconds();

		today = yyyy + '-' + mm + '-' + dd + ' ' + hour + ':' + minute + ':' + second;

		// END CURRENT DATE

		// AUTOCOMPLETE NOMOR REQUEST
				
		$('#STUFF_EXT_FROM').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "<?=ROOT?>npksbilling/stuffingext/get_nomor_request",
					type: 'GET',
					dataType: "json",
					data: {
						search: request.term
					},
					success: function( data ) {
						console.log(data);
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#STUFF_EXT_FROM').val(ui.item.label);
				
				$.blockUI();

				$.ajax({
					url: "<?=ROOT?>npksbilling/stuffingext/auto_generate_by_noreq",
					type: 'GET',
					dataType: "json",
					data: {
						search: ui.item.label
					},
					success: function( data ) {
						$.unblockUI();
						console.log(data);
						$('#detail-list tbody tr').remove();

						var req_method = (data['HEADER'][0]['stuff_paymethod'] == 2)? "PIUTANG" : "ADVANCED PAYMENT";
						var req_to = '';
						if ((data['HEADER'][0]['stuff_from'] == 1)){
							req_to = "DEPO";
						}else if((data['HEADER'][0]['stuff_from'] == 2)){
							req_to = "TPK";
						}else{
							req_to = "TONGKANG";
						}
						
						// EXTENSION REFERENCE AND HEADER
						$('#STUFF_EXT_FROM_DATE').val(data['HEADER'][0]['stuff_date']);
						$('.auto-generate').removeClass('hidden_content');
						$("#STUFF_EXT_FROM").attr('disabled','disabled');
						$('#STUFF_DATE').val(today);
						$('#STUFF_CREATE_DATE').val(data['HEADER'][0]['stuff_create_date']);
						$('#STUFF_CREATE_BY').val(data['HEADER'][0]['stuff_create_by']);
						$('#STUFF_PBM_NAME').val(data['HEADER'][0]['stuff_pbm_name']);
						$('#STUFF_PBM_ID').val(data['HEADER'][0]['stuff_pbm_id']);
						$('#STUFF_STACKBY_NAME').val(data['HEADER'][0]['stuff_stackby_name']);
						$('#STUFF_STACKBY_ID').val(data['HEADER'][0]['stuff_stackby_id']);
						$('#STUFF_FROM').val(data['HEADER'][0]['stuff_from']);
						$('#STUFF_FROM_NAME').val(req_to);
						$('#STUFF_PAYMETHOD').val(data['HEADER'][0]['stuff_paymethod']);						
						$('#STUFF_PAYMETHOD_NAME').val(req_method);						
						
						// VESSEL
						$('#STUFF_VESSEL_NAME').val(data['HEADER'][0]['stuff_vessel_name']);
						$('#STUFF_VESSEL_CODE').val(data['HEADER'][0]['stuff_vessel_code']);
						$('#STUFF_VOYIN').val(data['HEADER'][0]['stuff_voyin']);
						$('#STUFF_VOYOUT').val(data['HEADER'][0]['stuff_voyout']);
						$('#STUFF_VESSEL_PKK').val(data['HEADER'][0]['stuff_vessel_pkk']);
						$('#STUFF_VVD_ID').val(data['HEADER'][0]['stuff_vvd_id']);

						$('#STUFF_EXT_LOOP').val(data['HEADER'][0]['stuff_ext_loop']);						
						$('#STUFF_BRANCH_CODE').val(data['HEADER'][0]['stuff_branch_code']);						
						$('#STUFF_BRANCH_ID').val(data['HEADER'][0]['stuff_branch_id']);									

						// NEW DOCUMENTS
						var record = <?php echo json_encode($docType); ?>;
						data.FILE.forEach(function(file, index){
							if (data.FILE.length != 0) {

								counterdoc++;
								var newRow = $("<tr>");
								var cols = "";						

								cols += '';
								cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

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
						
						//DETAILS
						for (let index = 0; index < data['DETAIL'].length; index++) {
							counterdet++;
							var ex_batal = (data['DETAIL'][index]['stuff_dtl_sp2'] != null) ? data['DETAIL'][index]['stuff_dtl_sp2'] : "";
							var owner_name = (data['DETAIL'][index]['stuff_dtl_owner_name'] != null) ? data['DETAIL'][index]['stuff_dtl_owner_name'] : "";
							var owner_id = (data['DETAIL'][index]['stuff_dtl_owner'] != null) ? data['DETAIL'][index]['stuff_dtl_owner'] : "";
							var no_cont = (data['DETAIL'][index]['stuff_dtl_cont'] != null) ? data['DETAIL'][index]['stuff_dtl_cont'] : "";
							var type = (data['DETAIL'][index]['stuff_dtl_cont_type'] != null) ? data['DETAIL'][index]['stuff_dtl_cont_type'] : "";
							var status = (data['DETAIL'][index]['stuff_dtl_cont_status'] != null) ? data['DETAIL'][index]['stuff_dtl_cont_status'] : "";
							var size = (data['DETAIL'][index]['stuff_dtl_cont_size'] != null) ? data['DETAIL'][index]['stuff_dtl_cont_size'] : "";
							var sifat = (data['DETAIL'][index]['stuff_dtl_cont_danger'] != null) ? data['DETAIL'][index]['stuff_dtl_cont_danger'] : "";

							var via_id = (data['DETAIL'][index]['stuff_dtl_via'] != null) ? data['DETAIL'][index]['stuff_dtl_via'] : "";
							var via_name = (data['DETAIL'][index]['stuff_dtl_via_name'] != null) ? data['DETAIL'][index]['stuff_dtl_via_name'] : "";
							var kemasan_id = (data['DETAIL'][index]['stuff_dtl_cmdty_id'] != null) ? data['DETAIL'][index]['stuff_dtl_cmdty_id'] : "";
							var kemasan_name = (data['DETAIL'][index]['stuff_dtl_cmdty_name'] != null) ? data['DETAIL'][index]['stuff_dtl_cmdty_name'] : "";
							var start_date = (data['DETAIL'][index]['stuff_dtl_end_date'] != null) ? data['DETAIL'][index]['stuff_dtl_end_date'] : "";
							var end_date = "N/A";
							var rec_date = (data['DETAIL'][index]['stuff_dtl_rec_date'] != null) ? data['DETAIL'][index]['stuff_dtl_rec_date'] : "";
							var del_date = (data['DETAIL'][index]['stuff_dtl_del_date'] != null) ? data['DETAIL'][index]['stuff_dtl_del_date'] : "";
							var stack_date = (data['DETAIL'][index]['stuff_dtl_stack_date'] != null) ? data['DETAIL'][index]['stuff_dtl_stack_date'] : "";
							var dtl_id = (data['DETAIL'][index]['stuff_dtl_id'] != null) ? data['DETAIL'][index]['stuff_dtl_id'] : "";
							var hdr_id = (data['DETAIL'][index]['stuff_hdr_id'] != null) ? data['DETAIL'][index]['stuff_hdr_id'] : "";

							$('#detail-list tbody').append(
								'<tr>' +
									'<td class="TBL_DTL_STUFF_SP2">'+ ex_batal +'</td>' +
									'<td style="display:none;" class="TBL_DTL_STUFF_OWNER_ID">'+ owner_id +'</td>' +
									'<td class="TBL_DTL_STUFF_OWNER_NAME">'+ owner_name +'</td>' +
									'<td class="TBL_DTL_STUFF_CONT">'+ no_cont +'</td>' +
									'<td class="TBL_DTL_STUFF_CONT_SIZE">'+ size +'</td>' + 
									'<td class="TBL_DTL_STUFF_CONT_TYPE">'+ type +'</td>' +
									'<td class="TBL_DTL_STUFF_CONT_STATUS">'+ status +'</td>' +
									'<td class="TBL_DTL_STUFF_CONT_DANGER">'+ sifat +'</td>' +
									'<td style="display:none;" class="TBL_DTL_STUFF_VIA_ID">'+ via_id +'</td>' +
									'<td class="TBL_DTL_STUFF_VIA_NAME">'+ via_name +'</td>' +
									'<td style="display:none;" class="TBL_DTL_STUFF_CMDTY_ID">'+ kemasan_id +'</td>' +
									'<td class="TBL_DTL_STUFF_CMDTY_NAME">'+ kemasan_name +'</td>' +
									'<td class="TBL_DTL_STUFF_START_DATE"><input id="TBL_DTL_STUFF_START_DATE'+counterdet+'" class="start_date" type="text" class="form-control" id="datepickerDate" value="'+ start_date +'"></td>' +
									'<td class="TBL_DTL_STUFF_END_DATE"><input id="TBL_DTL_STUFF_END_DATE'+counterdet+'" class="end_date" type="text" class="form-control" id="datepickerDate" value="'+ end_date +'"></td>' +
									'<td style="display: none;" class="TBL_DTL_STUFF_DEL_DATE">'+ del_date +'</td>' +
									'<td style="display: none;" class="TBL_DTL_STUFF_REC_DATE">'+ rec_date +'</td>' +
									'<td style="display: none;" class="TBL_DTL_STUFF_STACK_DATE">'+ stack_date +'</td>' +
									'<td style="display: none;" class="TBL_DTL_STUFF_ID">'+ dtl_id +'</td>' +
									'<td style="display: none;" class="TBL_DTL_STUFF_HDR_ID">'+ hdr_id +'</td>' +
									'<td>' +
										'<a class="btn btn-primary btn-delete-detail"><i class="fa fa-trash-o"></i></a>' +
									'</td>' +
								'</tr>'
							);	



							$('#TBL_DTL_STUFF_START_DATE'+counterdet).datetimepicker({
								format: 'Y-m-d H:i',
								timepicker:true,
								datepicker:true,
							});

							$('#TBL_DTL_STUFF_END_DATE'+counterdet).datetimepicker({
								format: 'Y-m-d H:i',
								timepicker:true,
								datepicker:true,
							});
						}
						$.unblockUI();
					}
				});
			}
		});

		// END AUTOCOMPLETE NOMOR REQUEST

	
		// DETAIL
		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			$(this).closest("tr").remove();       
		});

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
		var stuff_no = $('#STUFF_EXT_FROM').val();

		$('#detail-list tbody tr').each(function(){
			var size 			= $(this).find('.TBL_DTL_STUFF_CONT_SIZE').html(); 
			var status			= $(this).find('.TBL_DTL_STUFF_CONT_STATUS').html(); 
			var type			= $(this).find('.TBL_DTL_STUFF_CONT_TYPE').html();
			var sifat			= $(this).find('.TBL_DTL_STUFF_CONT_DANGER').html();
			var kemasan_id		= $(this).find('.TBL_DTL_STUFF_CMDTY_ID').html();
			var kemasan_name	= $(this).find('.TBL_DTL_STUFF_CMDTY_NAME').html();
			var via_id			= $(this).find('.TBL_DTL_STUFF_VIA_ID').html();
			var via_name			= $(this).find('.TBL_DTL_STUFF_VIA_NAME').html();
			size = size != "" ? size : null;
			status = status != "" ? status : null;
			type = type != "" ? type : null;
			kemasan_name = kemasan_name != "" ? kemasan_name : null;
			sifat = sifat != "" ? sifat : null;

			var temp = {
				
                "STUFF_DTL_ID": null,
                "STUFF_HDR_ID": null,
                "STUFF_DTL_CONT": $(this).find('.TBL_DTL_STUFF_CONT').html(),
                "STUFF_DTL_CONT_SIZE": size,
                "STUFF_DTL_CONT_TYPE": type,
                "STUFF_DTL_CONT_STATUS": status,
                "STUFF_DTL_CONT_DANGER": sifat,
                "STUFF_DTL_CMDTY_ID": kemasan_id,
                "STUFF_DTL_CMDTY_NAME": kemasan_name,
                "STUFF_DTL_VIA": via_id,
                "STUFF_DTL_SP2": $(this).find('.TBL_DTL_STUFF_SP2').html(),
                "STUFF_DTL_STACK_DATE": $(this).find('.TBL_DTL_STUFF_STACK_DATE').html(),
                "STUFF_DTL_STUFF_DATE": null,
                "STUFF_DTL_CONT_FROM": null,
                "STUFF_DTL_SEAL_NO": null,
                "STUFF_DTL_OWNER": $(this).find('.TBL_DTL_STUFF_OWNER_ID').html(),
                "STUFF_DTL_OWNER_NAME": $(this).find('.TBL_DTL_STUFF_OWNER_NAME').html(),
                "STUFF_DTL_EXT_DATE": null,
                "STUFF_DTL_REAL_DATE": null,
                "STUFF_DTL_ISACTIVE": "Y",
                "STUFF_DTL_VIA_NAME": $(this).find('.TBL_DTL_STUFF_VIA_NAME').html(),
                "STUFF_DTL_DEL_VIA": null,
                "STUFF_DTL_DEL_VIA_NAME": null,
                "STUFF_DTL_DEL_DATE": $(this).find('.TBL_DTL_STUFF_DEL_DATE').html(),
                "STUFF_DTL_REC_DATE": $(this).find('.TBL_DTL_STUFF_REC_DATE').html(),
                "STUFF_DTL_START_DATE": $(this).find('.start_date').val(),
                "STUFF_DTL_END_DATE": $(this).find('.end_date').val(),
                "STUFF_DTL_ISCANCELLED": "N",
                "STUFF_DTL_STACKING_AREA": "1"
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
					"REQ_NO"	: stuff_no,
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
				    "TABLE": "TX_HDR_STUFF",
				    "PK": "STUFF_ID",
				    "VALUE": [
				    {
						"APP_ID": 2,
						"STUFF_ID": "",
		                "STUFF_NO": "",
		                "STUFF_DATE": $("#STUFF_DATE").val(),
		                "STUFF_PAYMETHOD": $("#STUFF_PAYMETHOD").val(),
		               	"STUFF_CUST_ID": "<?=$this->session->userdata('customerid_phd')?>",
		                "STUFF_CUST_NAME": "<?=$this->session->userdata('customernamealt_phd')?>",
		                "STUFF_CUST_NPWP": "<?=$this->session->userdata('npwp_phd')?>",
		                "STUFF_CUST_ACCOUNT": null,
		                "STUFF_STACKBY_ID": $("#STUFF_STACKBY_ID").val(),
		                "STUFF_STACKBY_NAME": $("#STUFF_STACKBY_NAME").val(),
		                "STUFF_VESSEL_CODE": $("#STUFF_VESSEL_CODE").val(),
		                "STUFF_VESSEL_NAME": $("#STUFF_VESSEL_NAME").val(),
		                "STUFF_VOYIN": $("#STUFF_VOYIN").val(),
		                "STUFF_VOYOUT": $("#STUFF_VOYOUT").val(),
		                "STUFF_VVD_ID": $("#STUFF_VVD_ID").val(),
		                "STUFF_VESSEL_ETA": $("#STUFF_VESSEL_ETA").val(),
		                "STUFF_VESSEL_ETD": $("#STUFF_VESSEL_ETD").val(),
		                "STUFF_BRANCH_ID": $("#STUFF_BRANCH_ID").val(),
		                "STUFF_NOTA": "17",
		                "STUFF_FROM": $("#STUFF_FROM").val(),
		                "STUFF_CREATE_BY": "1",
		                "STUFF_STATUS": 1,
		                "STUFF_VESSEL_AGENT": "",
		                "STUFF_VESSEL_AGENT_NAME": "",
		                "STUFF_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
		                "STUFF_BRANCH_CODE": $("#STUFF_BRANCH_CODE").val(),
		                "STUFF_PBM_ID": $("#STUFF_PBM_ID").val(),
		                "STUFF_PBM_NAME": $("#STUFF_PBM_NAME").val(),
		                "STUFF_VESSEL_PKK": $("#STUFF_VESSEL_PKK").val(),
		                "STUFF_EXT_FROM": $("#STUFF_EXT_FROM").val(),
		                "STUFF_EXT_FROM_DATE": $("#STUFF_EXT_FROM_DATE").val(),
		                "STUFF_EXT_LOOP": parseInt($('#STUFF_EXT_LOOP').val())+1,
		                "STUFF_EXT_STATUS": "Y"
					}]
				},
				"DETAIL": {
				    "DB": "omuster",
				    "TABLE": "TX_DTL_STUFF",
				    "FK": [
				      	"STUFF_HDR_ID",
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
					"VALUE": (files.length > 0) ? files : []
			}
		}

		console.log(arrData);
		//return false;
		$.blockUI();
		
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

		$.ajax({
			url: "<?=ROOT?>npksbilling/stuffingext/save_extension",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var response = JSON.parse(data.data);
					var req_no = response.header.stuff_no;

					var notification = new NotificationFx({
						message : '<p>Data '+req_no+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					stuffingext_log(req_no);
					setTimeout(function(){ window.location = "<?=ROOT?>npksbilling/stuffingext"; }, 3000);	
				} else {
					$.unblockUI();
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});	
	}

	function stuffingext_log(req_no) {
		var status_req = $('#STUFF_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/stuffingext_log",
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

