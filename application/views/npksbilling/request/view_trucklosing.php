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
					<div class="form-group col-xs-6">
						<label>PBM / EMKL</label>
						<input name="TL_PBM_NAME" id="TL_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input name="TL_PBM_ID" id="TL_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Nomor Request</label>
						<input name="TL_NO" id="TL_NO" type="text" class="form-control" placeholder="Auto Generate" disabled>
						<input name="TL_ID" id="TL_ID" type="hidden" class="form-control" placeholder="Auto Generate" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Date</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="TL_DATE" name="TL_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" disabled readOnly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="TL_STACKBY_NAME" id="TL_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input name="TL_STACKBY_ID" id="TL_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Receiving From</label>
						<input name="TL_FROM" id="TL_FROM" type="text" class="form-control" placeholder="Autocomplete" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Delivery From</label>
						<input name="TL_TO" id="TL_TO" type="text" class="form-control" placeholder="Autocomplete" disabled>
					</div>
					<div class="form-group col-xs-12">
						<label>Payment Method</label>
						<input name="TL_PAYMETHOD" id="TL_PAYMETHOD" type="text" class="form-control" placeholder="Autocomplete" disabled>
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
						<input name="TL_VESSEL_NAME" id="TL_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input type="hidden" id="TL_VESSEL_CODE" class="form-control" name="TL_VESSEL_CODE" required>
						<input type="hidden" id="TL_VESSEL" class="form-control" name="TL_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="TL_VESSEL_AGENT" id="TL_VESSEL_AGENT" type="text" class="form-control" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="TL_VESSEL_PKK" id="TL_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" disabled readonly="">
						<input name="TL_VVD_ID" id="TL_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" disabled readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="TL_VOYIN" id="TL_VOYIN" type="text" class="form-control" placeholder="Voyage In" disabled readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="TL_VOYOUT" id="TL_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" disabled readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="TL_VESSEL_ETA" id="TL_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="TL_VESSEL_ETD" id="TL_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
								<th>TL</th>
								<th>Ukuran</th>
								<th>Type</th>
								<th>Status</th>
								<th>Dangerous Goods</th>
								<th>Kemasan</th>
								<th>Receiving Via</th>
								<th>Delivery Via</th>
								<th>Tanggal Receiving</th>
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

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">		
					<div class="form-group example-twitter-oss pull-right">
						<button id="submit_header" class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>			
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

		$('#TL_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		$(function() {
			$("#DTL_REC_DATE").datetimepicker({
				format: "Y-m-d H:i:s",
				autoclose: true,
				todayHighlight: true,
			});

			$("#DTL_DEL_DATE").datetimepicker({
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

			var no_req = $('#TL_NO').val();

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
		$('#TL_PBM_NAME').autocomplete({
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
				$('#TL_PBM_NAME').val(ui.item.label);
				$('#TL_PBM_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//stackby
		$('#TL_STACKBY_NAME').autocomplete({
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
				$('#TL_STACKBY_NAME').val(ui.item.label);
				$('#TL_STACKBY_ID').val(ui.item.pbm_id);
				
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
				
				$('#TL_FROM').append(toAppend);
			}
		});

		//tO
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/to",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#TL_TO').append(toAppend);
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
				
				$('#TL_PAYMETHOD').append(toAppend);
			}
		});

		//vessel
		$('#TL_VESSEL_NAME').autocomplete({
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
				$('#TL_VESSEL_NAME').val(ui.item.label);
				$('#TL_VESSEL_CODE').val(ui.item.vesselCode);
				$('#TL_VOYIN').val(ui.item.voyageIn);
				$('#TL_VOYOUT').val(ui.item.voyageOut);
				$('#TL_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#TL_VVD_ID').val(ui.item.idUkkSimop);
				$('#TL_VESSEL_ETA').val(ui.item.eta);
				$('#TL_VESSEL_ETD').val(ui.item.etd);
				$('#TL_VESSEL').val(ui.item.name);
				
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

		//via receiving
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/via",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DTL_REC_VIA').append(toAppend);
			}
		});

		//via delivery
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/via",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DTL_DEL_VIA').append(toAppend);
			}
		});

		//tl
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/no_tl",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DTL_IS_TL').append(toAppend);
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

	//getdata
	var id_rec = "<?=$id?>";
	if(id_rec != ""){
		$.blockUI();
		$.ajax({
			url: "<?=ROOT?>npksbilling/trucklosing/update_truckLosing/"+id_rec,
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				console.log(data);
				if(data.HEADER != ""){
					$.unblockUI();
					arrData = data;
					arrData.HEADER.forEach(function(item, index){
						var req_method = (data['HEADER'][0]['tl_paymethod'] == 1)? "ADVANCED PAYMENT" : "";
						var req_from = '';
						var req_to = '';
						if ((data['HEADER'][0]['tl_from'] == 1)){
							req_from = "DEPO";
						}else if((data['HEADER'][0]['tl_from'] == 2)){
							req_from = "TPK";
						}

						if ((data['HEADER'][0]['tl_to'] == 1)){
							req_to = "DEPO";
						}else if((data['HEADER'][0]['tl_to'] == 2)){
							req_to = "TPK";
						}

						$("#TL_ID").val(item.tl_id);
						$("#TL_NO").val(item.tl_no);
						$("#TL_DATE").val(item.tl_date);
						$("#TL_PAYMETHOD").val(req_method);
						$("#TL_CUST_ID").val(item.tl_cust_id);
						$("#TL_CUST_NAME").val(item.tl_cust_name);
						$("#TL_CUST_ADDRESS").val(item.tl_cust_address);
						$("#TL_CUST_NPWP").val(item.tl_cust_npwp);
						$("#TL_CUST_ACCOUNT").val(item.tl_cust_account);
						$("#TL_STACKBY_ID").val(item.tl_stackby_id);
						$("#TL_STACKBY_NAME").val(item.tl_stackby_name);
						$("#TL_VESSEL_CODE").val(item.tl_vessel_code);
						$("#TL_VESSEL_NAME").val(item.tl_vessel_name);
						$("#TL_VOYIN").val(item.tl_voyin);
						$("#TL_VOYOUT").val(item.tl_voyout);
						$("#TL_VVD_ID").val(item.tl_vvd_id);
						$("#TL_VESSEL_ETA").val(item.tl_vessel_eta);
						$("#TL_VESSEL_ETD").val(item.tl_vessel_etd);
						$("#TL_BRANCH_ID").val(4);
						$("#TL_NOTA").val(item.tl_nota);
						$("#TL_FROM").val(req_from);
						$("#TL_TO").val(req_to);
						$("#TL_CREATE_BY").val(item.tl_create_by);
						$("#TL_STATUS").val(1);
						$("#TL_VESSEL_AGENT").val(item.tl_vessel_agent);
						$("#TL_VESSEL_AGENT_NAME").val(item.tl_vessel_agent_name);
						$("#TL_BRANCH_CODE").val(item.tl_branch_code);
						$("#TL_PBM_ID").val(item.tl_pbm_id);
						$("#TL_PBM_NAME").val(item.tl_pbm_name);
						$("#TL_VESSEL_PKK").val(item.tl_vessel_pkk);
						$("#TL_VESSEL").val(item.tl_vessel_name);
					});

					$('#show-detail').removeClass('hidden_content');
					arrData.DETAIL.forEach(function(detail, index){
						var owner_name = (detail.tl_dtl_owner_name)? detail.tl_dtl_owner_name : "";
						var owner_id = (detail.tl_dtl_owner)? detail.tl_dtl_owner : "";
						var no_cont = (detail.tl_dtl_cont)? detail.tl_dtl_cont : "";
						var no_tl = (detail.tl_dtl_is_tl)? detail.tl_dtl_is_tl : "";
						var size_id = (detail.tl_dtl_cont_size)? detail.tl_dtl_cont_size : "";
						var size_name = (detail.tl_dtl_cont_size)? detail.tl_dtl_cont_size : "";
						var type_id = (detail.tl_dtl_cont_type)? detail.tl_dtl_cont_type : "";
						var type_name = (detail.tl_dtl_cont_type)? detail.tl_dtl_cont_type : "";
						var status_id = (detail.tl_dtl_cont_status)? detail.tl_dtl_cont_status : "";
						var status_name = (detail.tl_dtl_cont_status)? detail.tl_dtl_cont_status : "";
						var sifat_id = (detail.tl_dtl_cont_danger)? detail.tl_dtl_cont_danger : "";
						var sifat_name = (detail.tl_dtl_cont_danger)? detail.tl_dtl_cont_danger : "";
						var barang_id = (detail.tl_dtl_cmdty_id)? detail.tl_dtl_cmdty_id : "";
						var barang_name = (detail.tl_dtl_cmdty_name)? detail.tl_dtl_cmdty_name : "";
						var rec_via_id = (detail.tl_dtl_rec_via)? detail.tl_dtl_rec_via : "";
						var rec_via_name = (detail.tl_dtl_via_rec_name)? detail.tl_dtl_via_rec_name : "";
						var del_via_id = (detail.tl_dtl_del_via)? detail.tl_dtl_del_via : "";
						var del_via_name = (detail.tl_dtl_del_via_name)? detail.tl_dtl_del_via_name : "";
						
						$('#detail-list tbody').append(
							'<tr>' +
								'<td style="display: none;" class="tbl_dtl_id">'+ detail.tl_dtl_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_hdr_id">'+ detail.tl_hdr_id +'</td>' +

								'<td style="display: none;" class="tbl_dtl_owner_id">'+ owner_id +'</td>' +
								'<td class="tbl_dtl_owner_name">'+ owner_name +'</td>' +

								'<td class="tbl_dtl_cont">'+ no_cont +'</td>' +
								'<td class="tbl_dtl_tl">'+ no_tl +'</td>' +

								'<td class="tbl_dtl_size_id">'+ size_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_size_name">'+ size_name +'</td>' +

								'<td class="tbl_dtl_type_id">'+ type_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_type_name">'+ type_name +'</td>' +

								'<td class="tbl_dtl_status_id">'+ status_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_status_name">'+ status_name +'</td>' +

								'<td class="tbl_dtl_character_id">'+ sifat_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_character_name">'+ sifat_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_cmdty_id">'+ barang_id +'</td>' +
								'<td class="tbl_dtl_cmdty_name">'+ barang_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_rec_via_id">'+ rec_via_id +'</td>' +
								'<td class="tbl_dtl_rec_via_name">'+ rec_via_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_del_via_id">'+ del_via_id +'</td>' +
								'<td class="tbl_dtl_del_via_name">'+ del_via_name +'</td>' +

								'<td class="tbl_dtl_rec_date">'+ detail.tl_dtl_rec_date +'</td>' +
								'<td class="tbl_dtl_del_date">'+ detail.tl_dtl_del_date +'</td>' +
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

							cols += '<div class="col-xs-5"><label>Nama File</label></div><div class="col-xs-5"><a href="'+apiUrl+file.doc_path+'" 	target="_blank">'+file.doc_name+'</a></div>';

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

	function goBack() {
		window.history.back();
	}

</script>
