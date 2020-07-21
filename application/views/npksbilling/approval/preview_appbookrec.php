<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" href="<?=CUBE_?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />

    <!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

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
.btn-footer{
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
					<div class="form-group col-xs-6">
						<label>PBM / EMKL</label>
						<input name="REC_PBM_NAME" id="REC_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input name="REC_PBM_ID" id="REC_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Nomor Request</label>
						<input name="REC_NO" id="REC_NO" type="text" class="form-control" placeholder="Auto Generate" disabled>
						<input name="REC_ID" id="REC_ID" type="hidden" class="form-control" placeholder="Auto Generate" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>From</label>
						<select id="REC_FROM" name="REC_FROM" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose From  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Payment Method</label>
						<select id="REC_PAYMETHOD" name="REC_PAYMETHOD" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose Payment Method  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Date</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="REC_DATE" name="REC_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" disabled readOnly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="REC_STACKBY_NAME" id="REC_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input name="REC_STACKBY_ID" id="REC_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
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
						<input name="REC_VESSEL_NAME" id="REC_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input type="hidden" id="REC_VESSEL_CODE" class="form-control" name="REC_VESSEL_CODE" required>
						<input type="hidden" id="REC_VESSEL" class="form-control" name="REC_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="REC_VESSEL_AGENT" id="REC_VESSEL_AGENT" type="text" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="REC_VESSEL_PKK" id="REC_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" disabled>
						<input name="REC_VVD_ID" id="REC_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="REC_VOYIN" id="REC_VOYIN" type="text" class="form-control" placeholder="Voyage In" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="REC_VOYOUT" id="REC_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="REC_VESSEL_ETA" id="REC_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="REC_VESSEL_ETD" id="REC_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
					</table>
				
					<div class="form-group example-twitter-oss pull-right">
			        </div>
				</div>
			</div>
		</div>
	</div>

<div class="" id='show-detail'>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
				</header>
				<input id="DTL_ID" name="DTL_ID" type="hidden" class="form-control">
				<div class="main-box-body clearfix">

					<table class="table table-striped table-hover" id="detail-list">
						<thead>
							<tr>
								<th>Container Owner</th>
								<th>No Container</th>
								<th>Ukuran</th>
								<th>Type</th>
								<th>Status</th>
								<th>Sifat</th>
								<th>Komoditi</th>
								<th>Via</th>
								<th>Tanggal Rencana Receiving</th>
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
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail Tagihan</b></h2>
				</header>

				<div id="bd-handling" hidden="true">
					<header class="main-box-header clearfix">
						<h2><b>Handling</b></h2>
					</header>
					<div class="main-box-body clearfix">
						<table id="handling" class=" table order-list">
							<thead>
								<tr>
									<th rowspan="2" style="text-align: left;">No</th>
									<th rowspan="2" style="text-align: left;">Layanan</th>
									<th colspan="3" style="text-align: left;">Keterangan</th>
									<th rowspan="2" style="text-align: center;">Quantity</th>
									<th rowspan="2" style="text-align: right;">Tarif Dasar</th>
									<th rowspan="2" style="text-align: right;">Total</th>
								</tr>
								<tr>
									<th>Size</th>
									<th>Type</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>

					<div class="main-box-body clearfix">
						<div class="col-xs-8">
							
						</div>
						<div class="col-xs-4" style="float: right;">
							<div class="form-group col-xs-12">
								<label>DPP</label>
								<input name="UPER_DPP" id="UPER_DPP" type="text" style="text-align: right;" class="form-control" placeholder="DPP" readonly>
							</div>
							<div class="form-group col-xs-12">
								<label>PPN 10%</label>
								<input name="UPER_PPN" id="UPER_PPN" type="text" style="text-align: right;" class="form-control" placeholder="PPN" readonly>
							</div>
							<div class="form-group col-xs-12">
								<label>TOTAL UPER</label>
								<input name="UPER_AMOUNT" id="UPER_AMOUNT" type="text" style="text-align: right;" class="form-control" placeholder="TOTAL" readonly>
							</div>
						</div>
					</div>
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
						<button onclick="show_approve('approve')" class="btn btn-danger btn-footer"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Approve</button>
						<button onclick="show_reject('reject')" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Reject</button>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- model reject -->
<div class="modal fade" id="modal-reject">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Input Remarks</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea class="form-control" id="alasan_reject" name="alasan_reject"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button onclick="save_approval('reject',$('#alasan_reject').val())" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</div>
</div>

<!-- model approve -->
<div class="modal fade" id="modal-approve">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
					<h4 class="modal-title">Informasi</h4>
			</div>
			<div class="modal-body">
				<p>Apakah anda yakin ?&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button onclick="save_approval('approve')" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</div>
</div>

<script>
	
	var counterdoc = 0;
	counterdetail = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {
		
		$('#date').datepicker({
			format: 'dd-mm-yyyy'
		});

		$('#REC_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		//ADD_FILE
		$("#add_file").on("click", function () {
			var record = <?php echo json_encode($docType); ?>;

			counterdoc++;

		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#REC_NO').val();

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

		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		//from
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/from",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#REC_FROM').append(toAppend);
			}
		});

		//payment method
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/paymethod",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_order']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#REC_PAYMETHOD').append(toAppend);
			}
		});

	});

	//encode file
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
				$("#DOC_NAME"+counterdoc).attr("doc_name", path);
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

						case "ffd8ffe0":
						case "ffd8ffe1":
						case "ffd8ffe2":
							return 'image/jpeg'
						default:
							alert('File harus PDF');
							$('#DOC_NAME'+counterdoc).val('');
							$("#btn-show").prop('disabled', true);
					}
				}
			}
		}
	}

	//getHeaderDetail
	//var id_rec = "<?=$id?>";
	
	$.blockUI();
	$.ajax({
		url: "<?=ROOT?>npksbilling/appbookrec/preview/<?=$id?>",
		type: 'GET',
		dataType: 'json',
		success: function( data ) {
			if(data.HEADER != ""){
				$.unblockUI();
				arrData = data;
				arrData.HEADER.forEach(function(item, index){
					$("#REC_ID").val(item.rec_id);
					$("#REC_NO").val(item.rec_no);
					$("#REC_DATE").val(item.rec_date);
					$("#REC_PAYMETHOD").val(item.rec_paymethod);
					$("#REC_CUST_ID").val(item.rec_cust_id);
					$("#REC_CUST_NAME").val(item.rec_cust_name);
					$("#REC_CUST_ADDRESS").val(item.rec_cust_address);
					$("#REC_CUST_NPWP").val(item.rec_cust_npwp);
					$("#REC_CUST_ACCOUNT").val(item.rec_cust_account);
					$("#REC_STACKBY_ID").val(item.rec_stackby_id);
					$("#REC_STACKBY_NAME").val(item.rec_stackby_name);
					$("#REC_VESSEL_CODE").val(item.rec_vessel_code);
					$("#REC_VESSEL_NAME").val(item.rec_vessel_name);
					$("#REC_VOYIN").val(item.rec_voyin);
					$("#REC_VOYOUT").val(item.rec_voyout);
					$("#REC_VVD_ID").val(item.rec_vvd_id);
					$("#REC_VESSEL_POL").val(item.rec_vessel_pol);
					$("#REC_VESSEL_POD").val(item.rec_vessel_pod);
					$("#REC_BRANCH_ID").val(4);
					$("#REC_NOTA").val(item.rec_nota);
					$("#REC_FROM").val(item.rec_from);
					$("#REC_CREATE_BY").val(item.rec_create_by);
					$("#REC_STATUS").val(item.rec_status);
					$("#REC_VESSEL_AGENT").val(item.rec_vessel_agent);
					$("#REC_VESSEL_AGENT_NAME").val(item.rec_vessel_agent_name);
					$("#REC_BRANCH_CODE").val(item.rec_branch_code);
					$("#REC_PBM_ID").val(item.rec_pbm_id);
					$("#REC_PBM_NAME").val(item.rec_pbm_name);
					$("#REC_VESSEL_PKK").val(item.rec_vessel_pkk);
					$("#REC_VESSEL_ETA").val(item.rec_vessel_eta);
					$("#REC_VESSEL_ETD").val(item.rec_vessel_etd);
				});

				$('#show-detail').removeClass('hidden_content');
				arrData.DETAIL.forEach(function(detail, index){
					var owner_name = (detail.rec_dtl_owner_name)? detail.rec_dtl_owner_name : "";
					var owner_id = (detail.rec_dtl_owner)? detail.rec_dtl_owner : "";
					var size_id = (detail.rec_dtl_cont_size)? detail.rec_dtl_cont_size : "";
					var size_name = (detail.rec_dtl_cont_size)? detail.rec_dtl_cont_size : "";
					var type_id = (detail.rec_dtl_cont_type)? detail.rec_dtl_cont_type : "";
					var type_name = (detail.rec_dtl_cont_type)? detail.rec_dtl_cont_type : "";
					var status_id = (detail.rec_dtl_cont_status)? detail.rec_dtl_cont_status : "";
					var status_name = (detail.rec_dtl_cont_status)? detail.rec_dtl_cont_status : "";
					var sifat_id = (detail.rec_dtl_cont_danger)? detail.rec_dtl_cont_danger : "";
					var sifat_name = (detail.rec_dtl_cont_danger)? detail.rec_dtl_cont_danger : "";
					var barang_id = (detail.rec_dtl_cmdty_id)? detail.rec_dtl_cmdty_id : "";
					var barang_name = (detail.rec_dtl_cmdty_name)? detail.rec_dtl_cmdty_name : "";
					var via_id = (detail.rec_dtl_via)? detail.rec_dtl_via : "";
					var via_name = (detail.rec_dtl_via_name)? detail.rec_dtl_via_name : "";

					$('#detail-list tbody').append(
						'<tr>' +
							'<td style="display: none;" class="tbl_dtl_id">'+ detail.rec_dtl_id +'</td>' +
							'<td style="display: none;" class="tbl_dtl_hdr_id">'+ detail.rec_hdr_id +'</td>' +

							'<td style="display: none;" class="tbl_dtl_owner_id">'+ owner_id +'</td>' +
							'<td class="tbl_dtl_owner_name">'+ owner_name +'</td>' +

							'<td class="tbl_dtl_cont">'+ detail.rec_dtl_cont +'</td>' +

							'<td style="display: none;" class="tbl_dtl_size_id">'+ size_id +'</td>' +
							'<td class="tbl_dtl_size_name">'+ size_name +'</td>' +

							'<td style="display: none;" class="tbl_dtl_type_id">'+ type_id +'</td>' +
							'<td class="tbl_dtl_type_name">'+ type_name +'</td>' +

							'<td style="display: none;" class="tbl_dtl_status_id">'+ status_id +'</td>' +
							'<td class="tbl_dtl_status_name">'+ status_name +'</td>' +

							'<td style="display: none;" class="tbl_dtl_character_id">'+ sifat_id +'</td>' +
							'<td class="tbl_dtl_character_name">'+ sifat_name +'</td>' +

							'<td style="display: none;" class="tbl_dtl_cmdty_id">'+ barang_id +'</td>' +
							'<td class="tbl_dtl_cmdty_name">'+ barang_name +'</td>' +

							'<td style="display: none;" class="tbl_dtl_via_id">'+ via_id +'</td>' +
							'<td class="tbl_dtl_via_name">'+ via_name +'</td>' +

							'<td class="tbl_dtl_date_plan">'+ detail.rec_dtl_date_plan +'</td>' +
						'</tr>'
					);
				});

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

			}
		}
	});

	$.ajax({

      	url: "<?=ROOT?>npksbilling/appbookrec/preview_uper/<?=$id?>",
      	type: "GET",
      	dataType : 'json',
      	success: function (data) {
      		console.log(data);
        	//var data = JSON.parse(data);
        	var table = $("#handling tbody");
        	var no =1;
        	var jmlresponse = data['result']['length'];

        	$('#UPER_DPP').val(data.result[0].dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
         	$('#UPER_PPN').val(data.result[0].ppn.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      		$('#UPER_AMOUNT').val(data.result[0].total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

        	if (jmlresponse == 0 ) {
 				$("#bd-handling").hide();
 			}else{
 				$("#bd-handling").show();
	      	 	data.result[0].nota_view[0].Handling.forEach(function(abc) {
	      	 		table.append(
						'<tr>' +
					    	'<td style="text-align: left;">'+ no++ +'</td>' +
					    	'<td style="text-align: left;">'+ abc.group_tariff_name +'</td>' +
					    	'<td style="text-align: left;">'+ abc.cont_size +'</td>' +
					    	'<td style="text-align: left;">'+ abc.cont_type +'</td>' +
					    	'<td style="text-align: left;">'+ abc.cont_status +'</td>' +
					    	'<td style="text-align: center;">'+ abc.qty +'</td>' +
					    	'<td style="text-align: right;">'+ abc.tariff.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
					    	'<td style="text-align: right;">'+ abc.dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						'</tr>'
			        );
	      	 	});
	      	 	$("#handling").DataTable();
				$.unblockUI();
	 		}
 
      	 	
      	}
    })



    function show_reject(){
		$('#modal-reject').modal();
	}

	 function show_approve(){
		$('#modal-approve').modal();
	}



	function save_approval(action, remarks)
	{
		$.blockUI()
		if (action == 'approve'){
			$('#modal-approve').modal('hide');
			$.ajax({
				type: "GET",
				url: "<?=ROOT?>npksbilling/appbookrec/approve/<?=$id?>",
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);
						no_req = resp.no_req;
						console.log(resp.result);
						console.log(resp.no_req);

						if(resp.no_req != "" || resp.no_req != undefined){
							alert('Request '+resp.no_req+' berhasil Approve');
							approvereceivingcontainer_log(no_req);

							window.location = "<?=ROOT?>npksbilling/appbookrec";
						}
						else{
							alert("Request Gagagl Approve");
						}
					}
				}
			})
		}else{
			$('#modal-reject').modal('hide');
			$.ajax({
				type: "POST",
				url: "<?=ROOT?>npksbilling/appbookrec/reject/<?=$id?>",
				data: {
		            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		            remarks: remarks
		        },
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);
						no_req = resp.no_req;
						console.log(resp.result);
						console.log(resp.no_req);

						if(resp.no_req != "" || resp.no_req != undefined){
							alert('Request '+resp.no_req+' berhasil Reject');
							rejectreceivingcontainer_log(no_req);

							window.location = "<?=ROOT?>npksbilling/appbookrec";
						}
						else{
							alert("Request Gagagl Reject");
						}
					}
				}
			})
		}

	}

	function rejectreceivingcontainer_log(no_req) {
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/rejectreceivingcontainer_log",
			type: 'POST',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 	: no_req,

			},
			success: function( data ) {
				if (data !=null) {
					console.log('Data Tersimpan ke LOG')
				}

			}
		});
	}

	function approvereceivingcontainer_log(no_req) {
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/approvereceivingcontainer_log",
			type: 'POST',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 	: no_req,

			},
			success: function( data ) {
				if (data !=null) {
					console.log('Data Tersimpan ke LOG')
				}

			}
		});
	}
</script>
