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
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/bootstrap/searchbt.css" />

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
					<div class="row">
						<div class="form-group col-xs-6">
							<label>PBM / EMKL</label>
							<input name="FUMI_PBM_NAME" id="FUMI_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
							<input name="FUMI_PBM_ID" id="FUMI_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
						</div>
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Nomor Request</label>
							<input name="FUMI_NO" id="FUMI_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
							<input name="FUMI_ID" id="FUMI_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Date</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input id="FUMI_DATE" name="FUMI_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" disabled readOnly>
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label>From</label>
							<input name="FUMI_FROM" id="FUMI_FROM" type="text" class="form-control" placeholder="Auto Generate" readonly="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-12">
							<label>Payment Method</label>
							<input name="FUMI_PAYMETHOD" id="FUMI_PAYMETHOD" type="text" class="form-control" placeholder="Auto Generate" readonly="">
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
						<input name="FUMI_VESSEL_NAME" id="FUMI_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input type="hidden" id="FUMI_VESSEL_CODE" class="form-control" name="FUMI_VESSEL_CODE" required>
						<input type="hidden" id="FUMI_VESSEL" class="form-control" name="DEL_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="FUMI_VESSEL_AGENT" id="FUMI_VESSEL_AGENT" type="text" class="form-control" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="FUMI_VESSEL_PKK" id="FUMI_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" disabled readonly="">
						<input name="FUMI_VVD_ID" id="FUMI_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" disabled readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="FUMI_VOYIN" id="FUMI_VOYIN" type="text" class="form-control" placeholder="Voyage In" disabled readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="FUMI_VOYOUT" id="FUMI_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" disabled readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="FUMI_VESSEL_ETA" id="FUMI_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="FUMI_VESSEL_ETD" id="FUMI_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
						</div>
					</table>
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
								<th>Type Fumigasi</th>
								<th>Ukuran</th>
								<th>Type</th>
								<th>Status</th>
								<th>Dangerous Goods</th>
								<th>Kemasan</th>
								<th>Tanggal Kegiatan</th>
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
						<button id="submit_header" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-default" onclick="goBack()"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Back</button>		
					</div>
				</div>
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

		$('#FUMI_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		$(function() {
			$("#DTL_REAL_DATE").datetimepicker({
				format: "Y-m-d H:i:s",
				autoclose: true,
				todayHighlight: true,
			});
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

		$("#btn-show").click(function(){
	    	$('#show-detail').removeClass('hidden_content');
	  	});

		// validasi header
		$("#btn-show").prop('disabled', true);

		//PBM
		$('#FUMI_PBM_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/pbm/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				console.log(ui);
				$('#FUMI_PBM_NAME').val(ui.item.label);
				$('#FUMI_PBM_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//stackby
		$('#FUMI_STACKBY_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/stackby/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				console.log(ui);
				$('#FUMI_STACKBY_NAME').val(ui.item.label);
				$('#FUMI_STACKBY_ID').val(ui.item.pbm_id);
				
				return false;
			}
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
				
				$('#FUMI_FROM').append(toAppend);
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
				$('#FUMI_PAYMETHOD').append(toAppend);
			}
		});

		//vessel
		$('#FUMI_VESSEL_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/vessel/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#FUMI_VESSEL_NAME').val(ui.item.label);
				$('#FUMI_VESSEL_CODE').val(ui.item.vesselCode);
				$('#FUMI_VOYIN').val(ui.item.voyageIn);
				$('#FUMI_VOYOUT').val(ui.item.voyageOut);
				$('#FUMI_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#FUMI_VVD_ID').val(ui.item.idUkkSimop);
				$('#FUMI_VESSEL_ETA').val(ui.item.eta);
				$('#FUMI_VESSEL_ETD').val(ui.item.etd);
				$('#FUMI_VESSEL').val(ui.item.name);
				
				return false;
			}
		});

		//customer
		$('#DTL_CONTAINER_OWNER').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/customer/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#DTL_CONTAINER_OWNER').val(ui.item.label);
				$('#DTL_OWNER').val(ui.item.customer_id);
				return false;
			}
		});

		//no_container
		$('#DTL_CONT').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/no_container/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#DTL_CONT').val(ui.item.label);
				$('#DTL_CONT_SIZE').val(ui.item.size);
				$('#DTL_CONT_TYPE').val(ui.item.type);
				return false;
			}
		});

		//size
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/size",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['cont_size']+'">'+record[i]['cont_desc']+'</option>';
				}
				
				$('#DTL_CONT_SIZE').append(toAppend);
			}
		});

		//type
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/type",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['cont_type']+'">'+record[i]['cont_type_desc']+'</option>';
				}
				
				$('#DTL_CONT_TYPE').append(toAppend);
			}
		});

		//status
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/status",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['cont_status']+'">'+record[i]['cont_status_desc']+'</option>';
				}
				
				$('#DTL_CONT_STATUS').append(toAppend);
			}
		});

		//sifat
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/sifat",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DTL_CONT_DANGER').append(toAppend);
			}
		});

		//barang
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/barang",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['commodity_id']+'">'+record[i]['commodity_name']+'</option>';
				}
				
				$('#DTL_CMDTY_ID').append(toAppend);
			}
		});

		//type_fumigasi
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/type_fumigasi",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#FUMI_DTL_TYPE').append(toAppend);
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

	function goBack() {
		window.history.back();
	}

	//getdata
	var id_fumi = "<?=$id?>";
	if(id_fumi != ""){
		$.blockUI();
		$.ajax({
			url: "<?=ROOT?>npksbilling/fumigasi/update_fumigasi/"+id_fumi,
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				if(data.HEADER != ""){
					$.unblockUI();
					arrData = data;
					arrData.HEADER.forEach(function(item, index){
						var req_method = (data['HEADER'][0]['fumi_paymethod'] == 1)? "ADVANCED PAYMENT" : "";
						var req_from = '';
						if ((data['HEADER'][0]['fumi_from'] == 1)){
							req_from = "DEPO";
						}else if((data['HEADER'][0]['fumi_from'] == 2)){
							req_from = "TPK";
						}

						$("#FUMI_ID").val(item.fumi_id);
						$("#FUMI_NO").val(item.fumi_no);
						$("#FUMI_DATE").val(item.fumi_date);
						$("#FUMI_PAYMETHOD").val(req_method);
						$("#FUMI_CUST_ID").val(item.fumi_cust_id);
						$("#FUMI_CUST_NAME").val(item.fumi_cust_name);
						$("#FUMI_CUST_ADDRESS").val(item.fumi_cust_address);
						$("#FUMI_CUST_NPWP").val(item.fumi_cust_npwp);
						$("#FUMI_CUST_ACCOUNT").val(item.fumi_cust_account);
						$("#FUMI_STACKBY_ID").val(item.fumi_stackby_id);
						$("#FUMI_STACKBY_NAME").val(item.fumi_stackby_name);
						$("#FUMI_VESSEL_CODE").val(item.fumi_vessel_code);
						$("#FUMI_VESSEL_NAME").val(item.fumi_vessel_name);
						$("#FUMI_VOYIN").val(item.fumi_voyin);
						$("#FUMI_VOYOUT").val(item.fumi_voyout);
						$("#FUMI_VVD_ID").val(item.fumi_vvd_id);
						$("#FUMI_VESSEL_ETA").val(item.fumi_vessel_eta);
						$("#FUMI_VESSEL_ETD").val(item.fumi_vessel_etd);
						$("#FUMI_BRANCH_ID").val(4);
						$("#FUMI_NOTA").val(item.fumi_nota);
						$("#FUMI_FROM").val(req_from);
						$("#FUMI_CREATE_BY").val(item.fumi_create_by);
						$("#FUMI_STATUS").val(1);
						$("#FUMI_VESSEL_AGENT").val(item.fumi_vessel_agent);
						$("#FUMI_VESSEL_AGENT_NAME").val(item.fumi_vessel_agent_name);
						$("#FUMI_BRANCH_CODE").val(item.fumi_branch_code);
						$("#FUMI_PBM_ID").val(item.fumi_pbm_id);
						$("#FUMI_PBM_NAME").val(item.fumi_pbm_name);
						$("#FUMI_VESSEL_PKK").val(item.fumi_vessel_pkk);
						$("#FUMI_VESSEL").val(item.fumi_vessel_name);
					});

					$('#show-detail').removeClass('hidden_content');
					arrData.DETAIL.forEach(function(detail, index){
						var owner_name = (detail.fumi_dtl_owner_name)? detail.fumi_dtl_owner_name : "";
						var owner_id = (detail.fumi_dtl_owner)? detail.fumi_dtl_owner : "";
						var size_id = (detail.fumi_dtl_cont_size)? detail.fumi_dtl_cont_size : "";
						var size_name = (detail.fumi_dtl_cont_size)? detail.fumi_dtl_cont_size : "";
						var type_id = (detail.fumi_dtl_cont_type)? detail.fumi_dtl_cont_type : "";
						var type_name = (detail.fumi_dtl_cont_type)? detail.fumi_dtl_cont_type : "";
						var status_id = (detail.fumi_dtl_cont_status)? detail.fumi_dtl_cont_status : "";
						var status_name = (detail.fumi_dtl_cont_status)? detail.fumi_dtl_cont_status : "";
						var sifat_id = (detail.fumi_dtl_cont_danger)? detail.fumi_dtl_cont_danger : "";
						var sifat_name = (detail.fumi_dtl_cont_danger)? detail.fumi_dtl_cont_danger : "";
						var barang_id = (detail.fumi_dtl_cmdty_id)? detail.fumi_dtl_cmdty_id : "";
						var barang_name = (detail.fumi_dtl_cmdty_name)? detail.fumi_dtl_cmdty_name : "";
						var type_fumi_id = (detail.fumi_dtl_type)? detail.fumi_dtl_type : "";
						var type_fumi_name = (detail.fumi_dtl_type_name)? detail.fumi_dtl_type_name : "";
						var no_container = (detail.fumi_dtl_cont)? detail.fumi_dtl_cont : "";
						var real_date = (detail.fumi_dtl_real_date)? detail.fumi_dtl_real_date : "";
						var dtl_id = (detail.fumi_dtl_id)? detail.fumi_dtl_id : "";
						var hdr_id = (detail.fumi_hdr_id)? detail.fumi_hdr_id : "";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td style="display: none;" class="tbl_dtl_id">'+ dtl_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_hdr_id">'+ hdr_id +'</td>' +

								'<td style="display: none;" class="tbl_dtl_owner_id">'+ owner_id +'</td>' +
								'<td class="tbl_dtl_owner_name">'+ owner_name +'</td>' +

								'<td class="tbl_dtl_cont">'+ no_container +'</td>' +

								'<td style="display: none;" class="tbl_dtl_type_fumi_id">'+ type_fumi_id +'</td>' +
								'<td class="tbl_dtl_type_fumi_name">'+ type_fumi_name +'</td>' +

								'<td class="tbl_dtl_size_id">'+ size_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_size_name">'+ size_name +'</td>' +

								'<td class="tbl_dtl_type_id">'+ type_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_type_name">'+ type_name +'</td>' +

								'<td class="tbl_dtl_status_id">'+ status_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_status_name">'+ status_name +'</td>' +

								'<td class="tbl_dtl_character_id">'+ sifat_name +'</td>' +
								'<td style="display: none;" class="tbl_dtl_character_name">'+ sifat_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_cmdty_id">'+ barang_id +'</td>' +
								'<td class="tbl_dtl_cmdty_name">'+ barang_name +'</td>' +

								'<td class="tbl_dtl_real_date">'+ real_date +'</td>' +
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
	}

</script>