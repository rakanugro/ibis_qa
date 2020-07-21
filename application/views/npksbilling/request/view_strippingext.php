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
					<input name="STRIPP_EXT_FROM" id="STRIPP_EXT_FROM" type="text" class="form-control" placeholder="Autocomplete" style="text-transform: uppercase;" disabled>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Tanggal Request Reff</label>
					<input name="STRIPP_EXT_FROM_DATE" id="STRIPP_EXT_FROM_DATE" type="text" class="form-control" placeholder="Tanggal Request Reff" readonly>
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
						<input name="STRIPP_PBM_ID" id="STRIPP_PBM_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
						<input name="STRIPP_PBM_NAME" id="STRIPP_PBM_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nomor Request</label>
						<input name="STRIPP_NO" id="STRIPP_NO" type="text" placeholder="Auto Generate" class="form-control" disabled>
						<input name="STRIPP_ID" id="STRIPP_ID" type="hidden" placeholder="Auto Generate" value="<?=$extension_id?>" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="STRIPP_STACKBY_NAME" id="STRIPP_STACKBY_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="STRIPP_STACKBY_ID" id="STRIPP_STACKBY_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Date</label>
						<input name="STRIPP_DATE" id="STRIPP_DATE" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>To</label>
						<input name="STRIPP_FROM" id="STRIPP_FROM" type="hidden" placeholder="From" class="form-control" disabled>
						<input name="STRIPP_FROM_NAME" id="STRIPP_FROM_NAME" type="text" placeholder="To" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Payment Method</label>
						<input name="STRIPP_PAYMETHOD" id="STRIPP_PAYMETHOD" type="hidden" placeholder="Payment Method" class="form-control" disabled>
						<input name="STRIPP_PAYMETHOD_NAME" id="STRIPP_PAYMETHOD_NAME" type="text" placeholder="Payment Method" class="form-control" disabled>
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
						<input name="STRIPP_VESSEL_NAME" id="STRIPP_VESSEL_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="STRIPP_VESSEL_CODE" id="STRIPP_VESSEL_CODE" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agent</label>
						<input name="STRIPP_VESSEL_AGENT" id="STRIPP_VESSEL_AGENT" type="hidden" placeholder="Nama Agent" class="form-control" disabled>
						<input name="STRIPP_VESSEL_AGENT_NAME" id="STRIPP_VESSEL_AGENT_NAME" type="text" placeholder="Nama Agent" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="STRIPP_VESSEL_PKK" id="STRIPP_VESSEL_PKK" type="text" placeholder="Nomor PKK" class="form-control" disabled>
						<input name="STRIPP_VVD_ID" id="STRIPP_VVD_ID" type="hidden" placeholder="Nomor PKK" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="STRIPP_VOYIN" id="STRIPP_VOYIN" type="text" placeholder="Voyage In" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="STRIPP_VOYOUT" id="STRIPP_VOYOUT" type="text" placeholder="Voyage Out" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="STRIPP_VESSEL_ETA" id="STRIPP_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="STRIPP_VESSEL_ETD" id="STRIPP_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
									<th>Stripping Via</th>
									<th>Kemasan</th>
									<th>Start Stripping</th>
									<th>End Stripping</th>
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

	<input type="hidden" id="STRIPP_CREATE_BY">
	<input type="hidden" id="STRIPP_CREATE_DATE">
	<input type="hidden" id="STRIPP_EXT_LOOP">
	<!-- <input type="hidden" id="DEL_MARK"> -->
	<input type="hidden" id="STRIPP_BRANCH_CODE">
	<input type="hidden" id="STRIPP_BRANCH_ID">
	<!-- <input type="hidden" id="DEL_CLOSING_TIME"> -->

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">		
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<script>

	var counterdet = 0;
	var counterdoc = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {

		$("#add_file").on("click", function () {
			var record = <?php echo json_encode($docType); ?>;

			counterdoc++;

		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#STRIPP_NO').val();

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

		$('#STRIPP_DATE').datetimepicker({
			format:'Y-m-d H:i',
			formatTime:'H:i',
			formatDate:'Y/m/d',
			timepicker:true,
			datepicker:true,
		});

		
		var extension_id = $("#STRIPP_ID").val();

		$.blockUI();
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/strippingext/getDataReq?extension_id="+ extension_id,
			success: function(data){
				var obj = JSON.parse(JSON.parse(data));
				data = obj;
				console.log(data);
				$('#detail-list tbody tr').remove();

				var req_method = (data['HEADER'][0]['stripp_paymethod'] == 2)? "PIUTANG" : "ADVANCED PAYMENT";
				var req_to = '';
				if ((data['HEADER'][0]['stripp_from'] == 1)){
					req_to = "DEPO";
				}else if((data['HEADER'][0]['stripp_from'] == 2)){
					req_to = "TPK";
				}else{
					req_to = "TONGKANG";
				}
						
				// EXTENSION REFERENCE AND HEADER
				$('#STRIPP_EXT_FROM_DATE').val(data['HEADER'][0]['stripp_ext_from_date']);
				$('#STRIPP_EXT_FROM').val(data['HEADER'][0]['stripp_ext_from']);
				$('.auto-generate').removeClass('hidden_content');
				$('#STRIPP_DATE').val(data['HEADER'][0]['stripp_date']);
				$('#STRIPP_NO').val(data['HEADER'][0]['stripp_no']);
				$('#STRIPP_CREATE_DATE').val(data['HEADER'][0]['stripp_create_date']);
				$('#STRIPP_CREATE_BY').val(data['HEADER'][0]['stripp_create_by']);
				$('#STRIPP_PBM_NAME').val(data['HEADER'][0]['stripp_pbm_name']);
				$('#STRIPP_PBM_ID').val(data['HEADER'][0]['stripp_pbm_id']);
				$('#STRIPP_STACKBY_NAME').val(data['HEADER'][0]['stripp_stackby_name']);
				$('#STRIPP_STACKBY_ID').val(data['HEADER'][0]['stripp_stackby_id']);
				$('#STRIPP_FROM').val(data['HEADER'][0]['stripp_from']);
				$('#STRIPP_FROM_NAME').val(req_to);
				$('#STRIPP_PAYMETHOD').val(data['HEADER'][0]['stripp_paymethod']);						
				$('#STRIPP_PAYMETHOD_NAME').val(req_method);						
						
				// VESSEL
				$('#STRIPP_VESSEL_NAME').val(data['HEADER'][0]['stripp_vessel_name']);
				$('#STRIPP_VESSEL_CODE').val(data['HEADER'][0]['stripp_vessel_code']);
				$('#STRIPP_VOYIN').val(data['HEADER'][0]['stripp_voyin']);
				$('#STRIPP_VOYOUT').val(data['HEADER'][0]['stripp_voyout']);
				$('#STRIPP_VESSEL_PKK').val(data['HEADER'][0]['stripp_vessel_pkk']);
				$('#STRIPP_VVD_ID').val(data['HEADER'][0]['stripp_vvd_id']);

				$('#STRIPP_EXT_LOOP').val(data['HEADER'][0]['stripp_ext_loop']);						
				$('#STRIPP_BRANCH_CODE').val(data['HEADER'][0]['stripp_branch_code']);						
				$('#STRIPP_BRANCH_ID').val(data['HEADER'][0]['stripp_branch_id']);									

				// NEW DOCUMENTS
				var record = <?php echo json_encode($docType); ?>;
				data.FILE.forEach(function(file, index){
					if (data.FILE.length != 0) {

						counterdoc++;
						var newRow = $("<tr>");
						var cols = "";						

						cols += '';
						cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control" maxlength="40" disabled><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

						cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" value="'+file.doc_no+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40" disabled></div>';

						cols += '<div class="col-xs-5"><label>Nama File</label></div><div class="col-xs-5"><a href="'+apiUrl+file.doc_path+'" target="_blank">'+file.doc_name+'</a></div>';

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
					var ex_batal = (data['DETAIL'][index]['stripp_dtl_sp2'] != null) ? data['DETAIL'][index]['stripp_dtl_sp2'] : "";
					var owner_name = (data['DETAIL'][index]['stripp_dtl_owner_name'] != null) ? data['DETAIL'][index]['stripp_dtl_owner_name'] : "";
					var owner_id = (data['DETAIL'][index]['stripp_dtl_owner'] != null) ? data['DETAIL'][index]['stripp_dtl_owner'] : "";
					var no_cont = (data['DETAIL'][index]['stripp_dtl_cont'] != null) ? data['DETAIL'][index]['stripp_dtl_cont'] : "";
					var type = (data['DETAIL'][index]['stripp_dtl_cont_type'] != null) ? data['DETAIL'][index]['stripp_dtl_cont_type'] : "";
					var status = (data['DETAIL'][index]['stripp_dtl_cont_status'] != null) ? data['DETAIL'][index]['stripp_dtl_cont_status'] : "";
					var size = (data['DETAIL'][index]['stripp_dtl_cont_size'] != null) ? data['DETAIL'][index]['stripp_dtl_cont_size'] : "";
					var sifat = (data['DETAIL'][index]['stripp_dtl_cont_danger'] != null) ? data['DETAIL'][index]['stripp_dtl_cont_danger'] : "";

					var via_id = (data['DETAIL'][index]['stripp_dtl_via'] != null) ? data['DETAIL'][index]['stripp_dtl_via'] : "";
					var via_name = (data['DETAIL'][index]['stripp_dtl_via_name'] != null) ? data['DETAIL'][index]['stripp_dtl_via_name'] : "";
					var kemasan_id = (data['DETAIL'][index]['stripp_dtl_cmdty_id'] != null) ? data['DETAIL'][index]['stripp_dtl_cmdty_id'] : "";
					var kemasan_name = (data['DETAIL'][index]['stripp_dtl_cmdty_name'] != null) ? data['DETAIL'][index]['stripp_dtl_cmdty_name'] : "";
					var start_date = (data['DETAIL'][index]['stripp_dtl_start_date'] != null) ? data['DETAIL'][index]['stripp_dtl_start_date'] : "";
					var end_date = (data['DETAIL'][index]['stripp_dtl_end_date'] != null) ? data['DETAIL'][index]['stripp_dtl_end_date'] : "";
					var rec_date = (data['DETAIL'][index]['stripp_dtl_rec_date'] != null) ? data['DETAIL'][index]['stripp_dtl_rec_date'] : "";
					var del_date = (data['DETAIL'][index]['stripp_dtl_del_date'] != null) ? data['DETAIL'][index]['stripp_dtl_del_date'] : "";
					var stack_date = (data['DETAIL'][index]['stripp_dtl_stack_date'] != null) ? data['DETAIL'][index]['stripp_dtl_stack_date'] : "";
					var dtl_id = (data['DETAIL'][index]['stripp_dtl_id'] != null) ? data['DETAIL'][index]['stripp_dtl_id'] : "";
					var hdr_id = (data['DETAIL'][index]['stripp_hdr_id'] != null) ? data['DETAIL'][index]['stripp_hdr_id'] : "";

					$('#detail-list tbody').append(
						'<tr>' +
							'<td class="TBL_DTL_STRIPP_SP2">'+ ex_batal +'</td>' +
							'<td style="display:none;" class="TBL_DTL_STRIPP_OWNER_ID">'+ owner_id +'</td>' +
							'<td class="TBL_DTL_STRIPP_OWNER_NAME">'+ owner_name +'</td>' +
							'<td class="TBL_DTL_STRIPP_CONT">'+ no_cont +'</td>' +
							'<td class="TBL_DTL_STRIPP_CONT_SIZE">'+ size +'</td>' + 
							'<td class="TBL_DTL_STRIPP_CONT_TYPE">'+ type +'</td>' +
							'<td class="TBL_DTL_STRIPP_CONT_STATUS">'+ status +'</td>' +
							'<td class="TBL_DTL_STRIPP_CONT_DANGER">'+ sifat +'</td>' +
							'<td style="display:none;" class="TBL_DTL_STRIPP_VIA_ID">'+ via_id +'</td>' +
							'<td class="TBL_DTL_STRIPP_VIA_NAME">'+ via_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_STRIPP_CMDTY_ID">'+ kemasan_id +'</td>' +
							'<td class="TBL_DTL_STRIPP_CMDTY_NAME">'+ kemasan_name +'</td>' +
							'<td class="TBL_DTL_STRIPP_START_DATE">'+ start_date +'</td>' +
							'<td class="TBL_DTL_STRIPP_END_DATE">'+ end_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STRIPP_DEL_DATE">'+ del_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STRIPP_REC_DATE">'+ rec_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STRIPP_STACK_DATE">'+ stack_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STRIPP_DTL_ID">'+ dtl_id +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STRIPP_HDR_ID">'+ hdr_id +'</td>' +
						'</tr>'
					);	

					$('#TBL_DTL_STRIPP_START_DATE'+counterdet).datetimepicker({
						format: 'Y-m-d H:i',
						timepicker:true,
						datepicker:true,
					});

					$('#TBL_DTL_STRIPP_END_DATE'+counterdet).datetimepicker({
						format: 'Y-m-d H:i',
						timepicker:true,
						datepicker:true,
					});
				}
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

	function goBack() {
		window.history.back();
	}

</script>

