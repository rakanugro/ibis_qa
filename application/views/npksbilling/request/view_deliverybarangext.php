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
						<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>					
					</div>
				</div>
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
					var dtl_id = (data['DETAIL'][index]['del_cargo_dtl_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_id'] : "";
					var hdr_id = (data['DETAIL'][index]['del_cargo_hdr_id'] != null) ? data['DETAIL'][index]['del_cargo_hdr_id'] : "";


					$('#detail-list tbody').append(
						'<tr>' +
							'<td class="TBL_DTL_CARGO_OWNER_NAME">'+ owner_name +'</td>' +
							'<td style="display:none;" class="TBL_DTL_CARGO_OWNER_ID">'+ owner_id +'</td>' +
							'<td class="TBL_DTL_CARGO_SI_NO">'+ no_bl +'</td>' +
							'<td class="TBL_DTL_CARGO_QTY">'+ jumlah +'</td>' +
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
							'<td class="TBL_DTL_CARGO_DEL_DATE">'+tanggal+'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_CREATE_DATE">'+ create_date +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CARGO_ID">'+ dtl_id +'</td>' +
							'<td style="display: none;" class="TBL_HDR_CARGO_ID">'+ hdr_id +'</td>' +
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

	function goBack() {
		window.history.back();
	}

</script>

