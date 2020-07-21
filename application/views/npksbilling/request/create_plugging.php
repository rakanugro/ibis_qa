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
							<label>Terminal</label>
							<select id="PLUG_BRANCH_CODE" name="PLUG_BRANCH_CODE" class="form-control" required="">
								<option value="not-selected"> -- Please Choose Terminal  -- </option>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label>PBM / EMKL</label>
							<input name="PLUG_PBM_NAME" id="PLUG_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
							<input name="PLUG_PBM_ID" id="PLUG_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Nomor Request</label>
							<input name="PLUG_NO" id="PLUG_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
							<input name="PLUG_ID" id="PLUG_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
						</div>
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Date</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input id="PLUG_DATE" name="PLUG_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" required="" readOnly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label>From</label>
							<select id="PLUG_FROM" name="PLUG_FROM" class="form-control" required="">
								<option value="not-selected"> -- Please Choose From  -- </option>
								<option value="1">DEPO</option>
								<option value="2">TPK</option>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label>Payment Method</label>
							<select id="PLUG_PAYMETHOD" name="PLUG_PAYMETHOD" class="form-control" required="">
								<option value="not-selected"> -- Please Choose Payment Method  -- </option>
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
						<input name="PLUG_VESSEL_NAME" id="PLUG_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
						<input type="hidden" id="PLUG_VESSEL_CODE" class="form-control" name="PLUG_VESSEL_CODE" required>
						<input type="hidden" id="PLUG_VESSEL" class="form-control" name="DEL_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="PLUG_VESSEL_AGENT" id="PLUG_VESSEL_AGENT" type="text" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="PLUG_VESSEL_PKK" id="PLUG_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
						<input name="PLUG_VVD_ID" id="PLUG_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" required="" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="PLUG_VOYIN" id="PLUG_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="PLUG_VOYOUT" id="PLUG_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="PLUG_VESSEL_ETA" id="PLUG_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" required="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="PLUG_VESSEL_ETD" id="PLUG_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" required="">
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
							<div class="form-group col-xs-1"><br/>
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
						<input id="DTL_OWNER_NAME" name="DTL_OWNER_NAME" type="text" class="form-control" value="<?=$this->session->userdata('customernamealt_phd')?>">
						<input id="DTL_OWNER" name="DTL_OWNER" type="hidden" value="<?=$this->session->userdata('customerid_phd')?>" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label>No Container</label>
						<input name="DTL_CONT" id="DTL_CONT" type="text" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Ukuran</label>
						<select id="DTL_CONT_SIZE" name="DTL_CONT_SIZE" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Ukuran  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Type</label>
						<select id="DTL_CONT_TYPE" name="DTL_CONT_TYPE" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Type  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Status</label>
						<select id="DTL_CONT_STATUS" name="DTL_CONT_STATUS" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Status  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Dangerous Goods(DG)</label>
						<select id="DTL_CONT_DANGER" name="DTL_CONT_DANGER" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Dangerous Goods  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label>Kemasan</label>
						<select id="DTL_CMDTY_ID" name="DTL_CMDTY_ID" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Kemasan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4">
						<label for="datepickerDate">Tanggal Kegiatan</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DTL_REAL_DATE" name="DTL_REAL_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" required="">
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

			var no_req = $('#PLUG_NO').val();

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

			var PLUG_PBM_NAME			= $('#PLUG_PBM_NAME');
			var PLUG_FROM				= $('#PLUG_FROM');
			var PLUG_PAYMETHOD			= $('#PLUG_PAYMETHOD');
			var PLUG_VESSEL				= $('#PLUG_VESSEL');

			$('#DOC_NO'+counterdoc).keypress(function(){
				if (PLUG_PBM_NAME.val() != '' && PLUG_FROM.val() != 'not-selected' && PLUG_PAYMETHOD.val() != 'not-selected' && PLUG_VESSEL.val() != '')  {
					if($('#DOC_NO'+counterdoc).val().length > 1 && $('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
					else{
						$("#btn-show").prop('disabled', true);
					}
				}
			});

			$('#DOC_NO'+counterdoc).keydown(function(){
				if (PLUG_PBM_NAME.val() != '' && PLUG_FROM.val() != 'not-selected' && PLUG_PAYMETHOD.val() != 'not-selected' && PLUG_VESSEL.val() != '')  {
					if($('#DOC_NO'+counterdoc).val().length > 1 && $('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
					else{
						$("#btn-show").prop('disabled', true);
					}
				}
			});

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

		var PLUG_PBM_NAME			= $('#PLUG_PBM_NAME');
		var PLUG_FROM				= $('#PLUG_FROM');
		var PLUG_PAYMETHOD			= $('#PLUG_PAYMETHOD');
		var PLUG_VESSEL			= $('#PLUG_VESSEL');

		PLUG_PBM_NAME.keypress(function(){
			if (PLUG_FROM.val() != 'not-selected' && PLUG_PAYMETHOD.val() != 'not-selected' && PLUG_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(PLUG_PBM_NAME.val() == ''){
				$("#btn-show").prop('disabled', true);
			}
		})

		PLUG_FROM.change(function(){
			if (PLUG_PBM_NAME.val() != '' && PLUG_PAYMETHOD.val() != 'not-selected' && PLUG_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(PLUG_FROM.val() == 'not-selected'){
				$("#btn-show").prop('disabled', true);
			}
		});

		PLUG_PAYMETHOD.change(function(){
			if (PLUG_PBM_NAME.val() != '' && PLUG_FROM.val() != 'not-selected' && PLUG_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(PLUG_PAYMETHOD.val() == 'not-selected'){
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

				var isSet = $('#PLUG_BRANCH_CODE').append(toAppend);
				if(isSet){
					$('#PLUG_BRANCH_CODE').val('PTG');
				}
			}
		});

		//PBM
		$('#PLUG_PBM_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#PLUG_BRANCH_CODE").find('option:selected').attr('brchid');
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/pbm/",
					type: 'GET',
					dataType: 'json',
					data: {request:request.term, branch_id:branch_id},
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				console.log(ui);
				$('#PLUG_PBM_NAME').val(ui.item.label);
				$('#PLUG_PBM_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//stackby
		$('#PLUG_STACKBY_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#PLUG_BRANCH_CODE").find('option:selected').attr('brchid');
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/stackby/",
					type: 'GET',
					dataType: 'json',
					data: {request:request.term, branch_id:branch_id},
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				console.log(ui);
				$('#PLUG_STACKBY_NAME').val(ui.item.label);
				$('#PLUG_STACKBY_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//from
		// $.ajax({
		//     type: "GET",
		//    	url: "<?=ROOT?>npksbilling/mdm/from",
		// 	success: function(data){
		// 		var obj = JSON.parse(data);
		// 		var record = obj['result'];
		
		// 		var toAppend = '';
		// 		for(var i=0;i<record.length;i++){
		// 			toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
		// 		}
				
		// 		$('#PLUG_FROM').append(toAppend);
		// 	}
		// });

		//payment method
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/paymethod_fumi",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_order']+'">'+record[i]['reff_name']+'</option>';
				}
				var isSet = $('#PLUG_PAYMETHOD').append(toAppend);
				if(isSet){
					$('#PLUG_PAYMETHOD').val('2');
				}
			}
		});

		//vessel
		$('#PLUG_VESSEL_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/vessel",
					type: 'GET',
					dataType: 'json',
					data: {
						vessel: request.term
					},
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#PLUG_VESSEL_NAME').val(ui.item.label);
				$('#PLUG_VESSEL_CODE').val(ui.item.vesselCode);
				$('#PLUG_VOYIN').val(ui.item.voyageIn);
				$('#PLUG_VOYOUT').val(ui.item.voyageOut);
				$('#PLUG_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#PLUG_VVD_ID').val(ui.item.idUkkSimop);
				$('#PLUG_VESSEL_ETA').val(ui.item.eta);
				$('#PLUG_VESSEL_ETD').val(ui.item.etd);
				$('#PLUG_VESSEL').val(ui.item.name);

				var PLUG_PBM_NAME			= $('#PLUG_PBM_NAME');
				var PLUG_FROM				= $('#PLUG_FROM');
				var PLUG_PAYMETHOD			= $('#PLUG_PAYMETHOD');
				var PLUG_VESSEL			= $('#PLUG_VESSEL');

				if (PLUG_PBM_NAME.val() != '' && PLUG_FROM.val() != 'not-selected' && PLUG_PAYMETHOD.val() != 'not-selected')  {
						if($('#DOC_NAME'+counterdoc).val() != undefined){
							if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
								$("#btn-show").prop('disabled', false);
							}
						}
				}
				if (PLUG_VESSEL.val() == ''){
					$("#btn-show").prop('disabled', true);
				}
				
				return false;
			}
		});

		//customer
		$('#DTL_CONTAINER_OWNER').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#PLUG_BRANCH_CODE").find('option:selected').attr('brchid');
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/customer/",
					type: 'GET',
					dataType: 'json',
					data: {request:request.term, branch_id:branch_id},
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
				var branch_id =  $("#PLUG_BRANCH_CODE").find('option:selected').attr('brchid');
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/no_container/",
					type: 'GET',
					dataType: 'json',
					data: {request:request.term, branch_id:branch_id},
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

		$('#PLUG_BRANCH_CODE').on('change', function() {
			var branch_id =  $(this).find('option:selected').attr('brchid');
			$('#PLUG_BRANCH_ID').val(branch_id);
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

							var PLUG_PBM_NAME			= $('#PLUG_PBM_NAME');
							var PLUG_TO					= $('#PLUG_TO');
							var PLUG_PAYMETHOD			= $('#PLUG_PAYMETHOD');
							var PLUG_VESSEL				= $('#PLUG_VESSEL');

							console.log(counterdoc);
							console.log($('#DOC_NO'+counterdoc).val());
							console.log($('#DOC_NAME'+counterdoc).val());
							if  (PLUG_PBM_NAME.val() != '' && PLUG_TO.val() != 'not-selected' && PLUG_PAYMETHOD.val() != 'not-selected' &&PLUG_VESSEL.val() != '') {
								if($('#DOC_NAME'+counterdoc).val() != undefined){
									if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
										$("#btn-show").prop('disabled', false);
									}
								}
							}
							else{
								$("#btn-show").prop('disabled', true);
								alert('Field header & vessel wajib diisi');
							}

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
	var id_plug = "<?=$id?>";
	if(id_plug != ""){
		$.blockUI();
		$.ajax({
			url: "<?=ROOT?>npksbilling/pluggingreefer/update_plugging/"+id_plug,
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				if(data.HEADER != ""){
					$.unblockUI();
					arrData = data;
					arrData.HEADER.forEach(function(item, index){
						$("#PLUG_ID").val(item.plug_id);
						$("#PLUG_NO").val(item.plug_no);
						$("#PLUG_DATE").val(item.plug_date);
						$("#PLUG_PAYMETHOD").val(item.plug_paymethod);
						$("#PLUG_CUST_ID").val(item.plug_cust_id);
						$("#PLUG_CUST_NAME").val(item.plug_cust_name);
						$("#PLUG_CUST_ADDRESS").val(item.plug_cust_address);
						$("#PLUG_CUST_NPWP").val(item.plug_cust_npwp);
						$("#PLUG_CUST_ACCOUNT").val(item.plug_cust_account);
						$("#PLUG_STACKBY_ID").val(item.plug_stackby_id);
						$("#PLUG_STACKBY_NAME").val(item.plug_stackby_name);
						$("#PLUG_VESSEL_CODE").val(item.plug_vessel_code);
						$("#PLUG_VESSEL_NAME").val(item.plug_vessel_name);
						$("#PLUG_VOYIN").val(item.plug_voyin);
						$("#PLUG_VOYOUT").val(item.plug_voyout);
						$("#PLUG_VVD_ID").val(item.plug_vvd_id);
						$("#PLUG_VESSEL_ETA").val(item.plug_vessel_eta);
						$("#PLUG_VESSEL_ETD").val(item.plug_vessel_etd);
						$("#PLUG_BRANCH_ID").val(item.plug_branch_id);
						$("#PLUG_NOTA").val(item.plug_nota);
						//$("#PLUG_CO").val(item.plug_corPLUGtion);
						//$("#PLUG_NO").val(item.plug_corPLUGtion_date);
						//$("#PLUG_NO").val(item.plug_print_card);
						$("#PLUG_FROM").val(item.plug_from);
						$("#PLUG_CREATE_BY").val(item.plug_create_by);
						//$("#PLUG_CREATE_DATE").val(item.plug_create_date);
						//$("#PLUG_NO").val(item.plug_bl);
						//$("#PLUG_NO").val(item.plug_do);
						$("#PLUG_STATUS").val(1);
						$("#PLUG_VESSEL_AGENT").val(item.plug_vessel_agent);
						$("#PLUG_VESSEL_AGENT_NAME").val(item.plug_vessel_agent_name);
						$("#PLUG_BRANCH_CODE").val(item.plug_branch_code);
						$("#PLUG_PBM_ID").val(item.plug_pbm_id);
						$("#PLUG_PBM_NAME").val(item.plug_pbm_name);
						$("#PLUG_VESSEL_PKK").val(item.plug_vessel_pkk);
						$("#PLUG_VESSEL").val(item.plug_vessel_name);
					});

					$('#show-detail').removeClass('hidden_content');
					arrData.DETAIL.forEach(function(detail, index){
						var owner_name = (detail.plug_dtl_owner_name)? detail.plug_dtl_owner_name : "";
						var owner_id = (detail.plug_dtl_owner)? detail.plug_dtl_owner : "";
						var size_id = (detail.plug_dtl_cont_size)? detail.plug_dtl_cont_size : "";
						var size_name = (detail.plug_dtl_cont_size)? detail.plug_dtl_cont_size : "";
						var type_id = (detail.plug_dtl_cont_type)? detail.plug_dtl_cont_type : "";
						var type_name = (detail.plug_dtl_cont_type)? detail.plug_dtl_cont_type : "";
						var status_id = (detail.plug_dtl_cont_status)? detail.plug_dtl_cont_status : "";
						var status_name = (detail.plug_dtl_cont_status)? detail.plug_dtl_cont_status : "";
						var sifat_id = (detail.plug_dtl_cont_danger)? detail.plug_dtl_cont_danger : "";
						var sifat_name = (detail.plug_dtl_cont_danger)? detail.plug_dtl_cont_danger : "";
						var barang_id = (detail.plug_dtl_cmdty_id)? detail.plug_dtl_cmdty_id : "";
						var barang_name = (detail.plug_dtl_cmdty_name)? detail.plug_dtl_cmdty_name : "";
						var no_container = (detail.plug_dtl_cont)? detail.plug_dtl_cont : "";
						var real_date = (detail.plug_dtl_activity_date)? detail.plug_dtl_activity_date : "";
						var dtl_id = (detail.plug_dtl_id)? detail.plug_dtl_id : "";
						var hdr_id = (detail.plug_hdr_id)? detail.plug_hdr_id : "";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td style="display: none;" class="tbl_dtl_id">'+ dtl_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_hdr_id">'+ hdr_id +'</td>' +

								'<td style="display: none;" class="tbl_dtl_owner_id">'+ owner_id +'</td>' +
								'<td class="tbl_dtl_owner_name">'+ owner_name +'</td>' +

								'<td class="tbl_dtl_cont">'+ no_container +'</td>' +

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

								'<td class="tbl_dtl_real_date">'+ real_date +'</td>' +
								
								'<td>' +
									'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
								'</td>' +
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

				}
			}
		});
	}

	function save_detail() {
		counterdetail++;
		var HDR_ID				= $('#REC_ID');
		var DTL_ID				= $('#DTL_ID');
		var DTL_CONT			= $('#DTL_CONT');
		var DTL_CONT_SIZE		= $('#DTL_CONT_SIZE');
		var DTL_CONT_TYPE		= $('#DTL_CONT_TYPE');
		var DTL_CONT_STATUS		= $('#DTL_CONT_STATUS');
		var DTL_CONT_DANGER		= $('#DTL_CONT_DANGER');
		var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID');
		var DTL_OWNER			= $('#DTL_OWNER');
		var DTL_OWNER_NAME		= $('#DTL_OWNER_NAME');
		var DTL_REAL_DATE		= $('#DTL_REAL_DATE');

		if(DTL_OWNER.val() == ""){
			alert('Please choose Container Owner !');
			$('#DTL_OWNER').focus();
			return false;
		}
		else if (DTL_CONT.val() == "") {
			alert('Please choose No Container !');
			$('#DTL_CONT').focus();
			return false;
		}else if(DTL_CONT_SIZE.val() == "not-selected") {
			alert('Please choose Ukuran !');
			$('#DTL_CONT_SIZE').focus();
			return false;
		}else if(DTL_CONT_STATUS.val() == "not-selected") {
			alert('Please choose Status !');
			$('#DTL_CONT_STATUS').focus();
			return false;
		}else if(DTL_CONT_DANGER.val() == "not-selected") {
			alert('Please choose Sifat !');
			$('#DTL_CONT_DANGER').focus();
			return false;
		}else if(DTL_REAL_DATE.val() == "") {
			alert('Please choose Tanggal Kegiatan!');
			$('#DTL_REAL_DATE').focus();
			return false;
		}

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var cargo_owner_id = $(this).find('.tbl_dtl_owner_id').html();	
			var no_cont = $(this).find('.tbl_dtl_cont').html();			
			var barang_id = $(this).find('.tbl_dtl_cmdty_id').html();		
			var size_id = $(this).find('.tbl_dtl_size_id').html();	
			var type_id = $(this).find('.tbl_dtl_type_id').html();		
			var status_id = $(this).find('.tbl_dtl_status_id').html();	
			var sifat_id = $(this).find('.tbl_dtl_character_id').html();		

			var data_table =no_cont + size_id + type_id + status_id + sifat_id + barang_id;
			var form_data = DTL_CONT.val() + DTL_CONT_SIZE.val() + DTL_CONT_TYPE.val() + DTL_CONT_STATUS.val() +  DTL_CONT_DANGER.val() + DTL_CMDTY_ID.val();
			
			var data_owner_table = cargo_owner_id + no_cont;
			var data_owner_form = DTL_OWNER.val() + DTL_CONT.val();

			if(data_owner_table == data_owner_form){
				countData.push(1);
			}

			if (data_table == form_data) {
				countData.push(1);
			}
		});

		if(countData.length > 0){
			alert('Nomor Container tidak boleh sama');
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
			alert('Status Container is not In Yard.');
			$('#DTL_CONT').focus();
			return false;
		}

		var brg_val = (DTL_CMDTY_ID.val() != "not-selected")? $('#DTL_CMDTY_ID option:selected').text() : "";
		var size_val = (DTL_CONT_SIZE.val() != "not-selected")? $('#DTL_CONT_SIZE option:selected').text() : "";
		var type_val = (DTL_CONT_TYPE.val() != "not-selected")? $('#DTL_CONT_TYPE option:selected').text() : "";
		var status_val = (DTL_CONT_STATUS.val() != "not-selected")? $('#DTL_CONT_STATUS option:selected').text() :"";
		var sifat_val = (DTL_CONT_DANGER.val() != "not-selected")? $('#DTL_CONT_DANGER option:selected').text() :"";

		$('#detail-list tbody').append(
			'<tr>' +
				'<td style="display: none;" class="tbl_dtl_id">'+ DTL_ID.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_hdr_id">'+ HDR_ID.val() +'</td>' +

				'<td style="display: none;" class="tbl_dtl_owner_id">'+ DTL_OWNER.val() +'</td>' +
				'<td class="tbl_dtl_owner_name">'+ DTL_OWNER_NAME.val() +'</td>' +

				'<td class="tbl_dtl_cont">'+ DTL_CONT.val() +'</td>' +

				'<td class="tbl_dtl_size_id">'+ DTL_CONT_SIZE.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_size_name">'+ size_val +'</td>' +

				'<td class="tbl_dtl_type_id">'+ DTL_CONT_TYPE.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_type_name">'+ type_val +'</td>' +

				'<td class="tbl_dtl_status_id">'+ DTL_CONT_STATUS.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_status_name">'+ status_val +'</td>' +

				'<td class="tbl_dtl_character_id">'+ DTL_CONT_DANGER.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_character_name">'+ sifat_val +'</td>' +

				'<td style="display: none;" class="tbl_dtl_cmdty_id">'+ DTL_CMDTY_ID.val() +'</td>' +
				'<td class="tbl_dtl_cmdty_name">'+ brg_val +'</td>' +

				'<td class="tbl_dtl_real_date">'+ DTL_REAL_DATE.val() +'</td>' +
				
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
				'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function(){ save_pluggging(); return false; });

	function save_pluggging() {
		$('#modal-default').modal('hide');
		var details = [];
		var file = [];
		var no_req = $('#PLUG_NO').val();

		$('#detail-list tbody tr').each(function() {
			var dtl_plug_id = $(this).find('.tbl_dtl_id').html(); 

			var cargo_owner_id = $(this).find('.tbl_dtl_owner_id').html();	
			var cargo_owner_name = $(this).find('.tbl_dtl_owner_name').html();	

			var no_cont = $(this).find('.tbl_dtl_cont').html();	

			var type_fumi_id = $(this).find('.tbl_dtl_type_fumi_id').html();	
			var type_fumi_name = $(this).find('.tbl_dtl_type_fumi_name').html();	

			var barang_id = $(this).find('.tbl_dtl_cmdty_id').html();		
			var barang_name	= $(this).find('.tbl_dtl_cmdty_name').html();

			var size_id = $(this).find('.tbl_dtl_size_id').html();		
			var size_name	= $(this).find('.tbl_dtl_size_name').html();

			var type_id = $(this).find('.tbl_dtl_type_id').html();		
			var type_name	= $(this).find('.tbl_dtl_type_name').html();

			var status_id = $(this).find('.tbl_dtl_status_id').html();		
			var status_name	= $(this).find('.tbl_dtl_status_name').html();

			var sifat_id = $(this).find('.tbl_dtl_character_id').html();		
			var sifat_name	= $(this).find('.tbl_dtl_character_name').html();

			var tanggal_kegiatan = $(this).find('.tbl_dtl_real_date').html();

			var tamp = {
				"PLUG_DTL_ID": dtl_plug_id,
                "PLUG_HDR_ID": $('#PLUG_ID').val(),
                "PLUG_DTL_OWNER": (cargo_owner_id != "not-selected")? cargo_owner_id : "",
                "PLUG_DTL_OWNER_NAME": cargo_owner_name,
                "PLUG_DTL_CONT": no_cont,
                "PLUG_DTL_CONT_SIZE": (size_id != "not-selected")? size_id : "",
                "PLUG_DTL_Cont_TYPE": (type_id != "not-selected")? type_id : "",
                "PLUG_DTL_Cont_STATUS": (status_id != "not-selected")? status_id : "",
                "PLUG_DTL_Cont_DANGER": (sifat_id != "not-selected")? sifat_id : "",
                "PLUG_DTL_CMDTY_ID": (barang_id != "not-selected")? barang_id : "",
                "PLUG_DTL_CMDTY_NAME": barang_name,
                "PLUG_DTL_ACTIVITY_DATE": tanggal_kegiatan
			}
			details.push(tamp);
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
            "service_branch_id" : "4",
			"service_branch_code" : "PTG",
            "data"   : ["HEADER", "DETAIL", "FILE"],
            "HEADER": {
		        "DB": "omuster",
		        "TABLE": "TX_HDR_PLUG",
		        "PK": "PLUG_ID",
		        "VALUE": [
		            {
		                "APP_ID": 2,
		                "PLUG_ID": $('#PLUG_ID').val(),
		                "PLUG_NO": $('#PLUG_NO').val(),
		                "PLUG_DATE": $('#PLUG_DATE').val(),
		                "PLUG_PAYMETHOD": $('#PLUG_PAYMETHOD').val(),
		                "PLUG_CUST_ID": "<?=$this->session->userdata('customerid_phd')?>",
		                "PLUG_CUST_NAME": "<?=$this->session->userdata('customernamealt_phd')?>",
		                "PLUG_CUST_NPWP": "<?=$this->session->userdata('npwp_phd')?>",
		                "PLUG_CUST_ACCOUNT": null,
		                "PLUG_VESSEL_CODE": $('#PLUG_VESSEL_CODE').val(),
		                "PLUG_VESSEL_NAME": $('#PLUG_VESSEL').val(),
		                "PLUG_VOYIN": $('#PLUG_VOYIN').val(),
		                "PLUG_VOYOUT": $('#PLUG_VOYOUT').val(),
		                "PLUG_VVD_ID": $('#PLUG_VVD_ID').val(),
		                "PLUG_VESSEL_ETA": $('#PLUG_VESSEL_ETA').val(),
		                "PLUG_VESSEL_ETD": $('#PLUG_VESSEL_ETD').val(),
		                "PLUG_BRANCH_ID": $('#PLUG_BRANCH_CODE').find('option:selected').attr('brchid'),
		                "PLUG_NOTA": "6",
		                "PLUG_FROM": $('#PLUG_FROM').val(),
		                "PLUG_CREATE_BY": "1",
		                "PLUG_STATUS": 1,
		                "PLUG_VESSEL_AGENT": "",
		                "PLUG_VESSEL_AGENT_NAME": "",
		                "PLUG_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
		                "PLUG_BRANCH_CODE": $('#PLUG_BRANCH_CODE').val(),
		                "PLUG_PBM_ID": $('#PLUG_PBM_ID').val(),
		                "PLUG_PBM_NAME": $('#PLUG_PBM_NAME').val(),
		                "PLUG_VESSEL_PKK": $('#PLUG_VESSEL_PKK').val()
		            }
		        ]
		    },
            "DETAIL": {
                "DB": "omuster",
		        "TABLE": "TX_DTL_PLUG",
		        "FK": [
		            "PLUG_HDR_ID",
		            "plug_id"
		        ],
                "VALUE"  : (details.length > 0) ? details : []
            },
            "FILE": {
               "DB": "omuster",
		        "TABLE": "TX_DOCUMENT",
		        "FK": [
		            "REQ_NO",
		            "plug_no"
		        ],
                "VALUE"  : (file.length > 0) ? file : []
            }
		}
		console.log(arrData);
		//return false;
		$.blockUI();

	// 	// var REC_PBM_NAME		= $('#REC_PBM_NAME').val();
	// 	// var REC_STACKBY_NAME	= $('#REC_STACKBY_NAME').val();
	// 	// var REC_FROM			= $('#REC_FROM').val();
	// 	// var REC_PAYMETHOD		= $('#REC_PAYMETHOD').val();

	// 	// if (REC_PBM_NAME == '') {
	// 	// 	$.unblockUI();
	// 	// 	alert('PBM Harus diisi !!');
	// 	// 	return false;
	// 	// } else if (REC_STACKBY_NAME == '') {
	// 	// 	$.unblockUI();
	// 	// 	alert('Penumpukan Harus diisi !!');
	// 	// 	return false;
	// 	// }else if (REC_FROM == 'not-selected') {
	// 	// 	$.unblockUI();
	// 	// 	alert('From Harus diisi !!');
	// 	// 	return false;
	// 	// }else if (REC_PAYMETHOD == 'not-selected') {
	// 	// 	$.unblockUI();
	// 	// 	alert('Payment Method Harus diisi !!');
	// 	// 	return false;
	// 	// }

		if(details.length == 0){
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}
		else if(file.length == 0){
			$.unblockUI();
			alert('File harus diisi !!');
			return false;
		}

		$.ajax({
			url: "<?=ROOT?>npksbilling/pluggingreefer/save/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var temp = JSON.parse(data.data);
					var no_req = temp['header']['plug_no'];

					var notification = new NotificationFx({
						message : '<p>Data '+no_req+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success'
					});
					pluggingreefer_log(no_req);
					setTimeout(function(){ window.location = "<?=ROOT?>npksbilling/pluggingreefer"; }, 3000);	
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}

	function pluggingreefer_log(no_req) {
		var status_req = $('#PLUG_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/pluggingreefer_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				status_req		: status_req,
				no_req 			: no_req

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