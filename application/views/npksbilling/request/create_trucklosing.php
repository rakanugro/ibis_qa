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
							<select id="TL_BRANCH_CODE" name="TL_BRANCH_CODE" class="form-control" required="">
								<option value="not-selected"> -- Please Choose From  -- </option>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label>PBM / EMKL</label>
							<input name="TL_PBM_NAME" id="TL_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
							<input name="TL_PBM_ID" id="TL_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Nomor Request</label>
							<input name="TL_NO" id="TL_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
							<input name="TL_ID" id="TL_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
						</div>
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Date</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input id="TL_DATE" name="TL_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" required="" readOnly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label>Penumpukan Oleh</label>
							<input name="TL_STACKBY_NAME" id="TL_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
							<input name="TL_STACKBY_ID" id="TL_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
						</div>
						<div class="form-group col-xs-6">
							<label>Receiving From</label>
							<select id="TL_FROM" name="TL_FROM" class="form-control" required="">
								<option value="not-selected"> -- Please Choose Receiving From  -- </option>
								<option value="1">DEPO</option>
								<option value="2">TPK</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label>Delivery From</label>
							<select id="TL_TO" name="TL_TO" class="form-control" required="">
								<option value="not-selected"> -- Please Choose Delivery From  -- </option>
								<option value="1">DEPO</option>
								<option value="2">TPK</option>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label>Payment Method</label>
							<select id="TL_PAYMETHOD" name="TL_PAYMETHOD" class="form-control" required="">
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
						<input name="TL_VESSEL_NAME" id="TL_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
						<input type="hidden" id="TL_VESSEL_CODE" class="form-control" name="TL_VESSEL_CODE" required>
						<input type="hidden" id="TL_VESSEL" class="form-control" name="TL_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="TL_VESSEL_AGENT" id="TL_VESSEL_AGENT" type="text" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="TL_VESSEL_PKK" id="TL_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
						<input name="TL_VVD_ID" id="TL_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" required="" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="TL_VOYIN" id="TL_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="TL_VOYOUT" id="TL_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="TL_VESSEL_ETA" id="TL_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" required="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="TL_VESSEL_ETD" id="TL_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" required="">
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
					<div class="form-group col-xs-4">
						<label>Container Owner</label>
						<input id="DTL_OWNER_NAME" name="DTL_OWNER_NAME" type="text" class="form-control" value="<?=$this->session->userdata('customernamealt_phd')?>">
						<input id="DTL_OWNER" name="DTL_OWNER" type="hidden" value="<?=$this->session->userdata('customerid_phd')?>" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>No Container</label>
						<input name="DTL_CONT" id="DTL_CONT" type="text" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>TL</label>
						<select id="DTL_IS_TL" name="DTL_IS_TL" class="form-control" required="">
							<option value="not-selected"> -- Please Choose TL  -- </option>
						</select>
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
					<div class="form-group col-xs-6">
						<label>Dangerous Goods(DG)</label>
						<select id="DTL_CONT_DANGER" name="DTL_CONT_DANGER" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Dangerous Goods  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Kemasan</label>
						<select id="DTL_CMDTY_ID" name="DTL_CMDTY_ID" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Kemasan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Receiving Via</label>
						<select id="DTL_REC_VIA" name="DTL_REC_VIA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose TLeiving Via  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Delivery Via</label>
						<select id="DTL_DEL_VIA" name="DTL_DEL_VIA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Delivery Via  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Receiving</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DTL_REC_DATE" name="DTL_REC_DATE" type="text" class="form-control" value="<?=date('Y-m-d H:i:s')?>" required="">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Delivery</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DTL_DEL_DATE" name="DTL_DEL_DATE" type="text" class="form-control" value="<?=date('Y-m-d H:i:s')?>" required="">
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

			var TL_PBM_NAME			= $('#TL_PBM_NAME');
			var TL_FROM				= $('#TL_FROM');
			var TL_TO					= $('#TL_TO');
			var TL_PAYMETHOD			= $('#TL_PAYMETHOD');
			var TL_STACKBY_NAME		= $('#TL_STACKBY_NAME');
			var TL_VESSEL				= $('#TL_VESSEL');

			$('#DOC_NO'+counterdoc).keypress(function(){
				if (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_TO.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_STACKBY_NAME.val() != 'not-selected' && TL_VESSEL.val() != '')  {
					if($('#DOC_NO'+counterdoc).val().length > 1 && $('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
					else{
						$("#btn-show").prop('disabled', true);
					}
				}
			});

			$('#DOC_NO'+counterdoc).keydown(function(){
				if (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_TO.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_STACKBY_NAME.val() != 'not-selected' && TL_VESSEL.val() != '')  {
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

		var TL_PBM_NAME			= $('#TL_PBM_NAME');
		var TL_FROM				= $('#TL_FROM');
		var TL_TO				= $('#TL_TO');
		var TL_PAYMETHOD		= $('#TL_PAYMETHOD');
		var TL_STACKBY_NAME		= $('#TL_STACKBY_NAME');
		var TL_VESSEL			= $('#TL_VESSEL');

		TL_PBM_NAME.keypress(function(){
			if (TL_FROM.val() != 'not-selected' &&  TL_TO.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_STACKBY_NAME.val() != '' && TL_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(TL_PBM_NAME.val() == ''){
				$("#btn-show").prop('disabled', true);
			}
		})

		TL_FROM.change(function(){
			if (TL_TO.val() != 'not-selected' && TL_PBM_NAME.val() != '' && TL_PAYMETHOD.val() != 'not-selected' && TL_STACKBY_NAME.val() != '' && TL_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(TL_FROM.val() == 'not-selected'){
				$("#btn-show").prop('disabled', true);
			}
		});

		TL_PAYMETHOD.change(function(){
			if (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_TO.val() != 'not-selected' && TL_STACKBY_NAME.val() != '' && TL_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(TL_PAYMETHOD.val() == 'not-selected'){
				$("#btn-show").prop('disabled', true);
			}
		});

		TL_STACKBY_NAME.keypress(function(){
			if (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_TO.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(TL_STACKBY_NAME.val() == ''){
				$("#btn-show").prop('disabled', true);
			}
		});

		TL_TO.keypress(function(){
			if (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(TL_TO.val() == 'not-selected'){
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

				var isSet = $('#TL_BRANCH_CODE').append(toAppend);
				if(isSet){
					$('#TL_BRANCH_CODE').val('PTG');
				}
			}
		});

		//PBM
		$('#TL_PBM_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#TL_BRANCH_CODE").find('option:selected').attr('brchid');
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
				$('#TL_PBM_NAME').val(ui.item.label);
				$('#TL_PBM_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//stackby
		$('#TL_STACKBY_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#TL_BRANCH_CODE").find('option:selected').attr('brchid');
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
				$('#TL_STACKBY_NAME').val(ui.item.label);
				$('#TL_STACKBY_ID').val(ui.item.pbm_id);
				
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
				
		// 		$('#TL_FROM').append(toAppend);
		// 	}
		// });

		// //tO
		// $.ajax({
		//     type: "GET",
		//    	url: "<?=ROOT?>npksbilling/mdm/to",
		// 	success: function(data){
		// 		var obj = JSON.parse(data);
		// 		var record = obj['result'];
		
		// 		var toAppend = '';
		// 		for(var i=0;i<record.length;i++){
		// 			toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
		// 		}
				
		// 		$('#TL_TO').append(toAppend);
		// 	}
		// });

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

				var isSet = $('#TL_PAYMETHOD').append(toAppend);
				if(isSet){
					$('#TL_PAYMETHOD').val('1');
				}
			}
		});

		//vessel
		$('#TL_VESSEL_NAME').autocomplete({
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
				$('#TL_VESSEL_NAME').val(ui.item.label);
				$('#TL_VESSEL_CODE').val(ui.item.vesselCode);
				$('#TL_VOYIN').val(ui.item.voyageIn);
				$('#TL_VOYOUT').val(ui.item.voyageOut);
				$('#TL_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#TL_VVD_ID').val(ui.item.idUkkSimop);
				$('#TL_VESSEL_ETA').val(ui.item.eta);
				$('#TL_VESSEL_ETD').val(ui.item.etd);
				$('#TL_VESSEL').val(ui.item.name);

				var TL_PBM_NAME			= $('#TL_PBM_NAME');
				var TL_FROM				= $('#TL_FROM');
				var TL_TO					= $('#TL_TO');
				var TL_PAYMETHOD			= $('#TL_PAYMETHOD');
				var TL_STACKBY_NAME		= $('#TL_STACKBY_NAME');
				var TL_VESSEL			= $('#TL_VESSEL');

				if (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_TO.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_STACKBY_NAME.val() != '')  {
						if($('#DOC_NAME'+counterdoc).val() != undefined){
							if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
								$("#btn-show").prop('disabled', false);
							}
						}
				}
				if (TL_VESSEL.val() == ''){
					$("#btn-show").prop('disabled', true);
				}
				
				return false;
			}
		});

		//customer
		$('#DTL_CONTAINER_OWNER').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#TL_BRANCH_CODE").find('option:selected').attr('brchid');
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
				var branch_id =  $("#TL_BRANCH_CODE").find('option:selected').attr('brchid');
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/no_cont_rec/",
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

				var isSet = $('#DTL_IS_TL').append(toAppend);
				if(isSet){
					$('#DTL_IS_TL').val('Y');
				}
			}
		});

		$('#TL_BRANCH_CODE').on('change', function() {
			var branch_id =  $(this).find('option:selected').attr('brchid');
			$('#TL_BRANCH_ID').val(branch_id);
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

							var TL_PBM_NAME			= $('#TL_PBM_NAME');
							var TL_FROM				= $('#TL_FROM');
							var TL_TO				= $('#TL_TO');
							var TL_PAYMETHOD		= $('#TL_PAYMETHOD');
							var TL_STACKBY_NAME		= $('#TL_STACKBY_NAME');
							var TL_VESSEL			= $('#TL_VESSEL');

							console.log(counterdoc);
							console.log($('#DOC_NO'+counterdoc).val());
							console.log($('#DOC_NAME'+counterdoc).val());
							if  (TL_PBM_NAME.val() != '' && TL_FROM.val() != 'not-selected' && TL_TO.val() != 'not-selected' && TL_PAYMETHOD.val() != 'not-selected' && TL_STACKBY_NAME.val() != '' && TL_VESSEL.val() != '') {
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
						$("#TL_ID").val(item.tl_id);
						$("#TL_NO").val(item.tl_no);
						$("#TL_DATE").val(item.tl_date);
						$("#TL_PAYMETHOD").val(item.tl_paymethod);
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
						$("#TL_BRANCH_ID").val(item.tl_branch_id);
						$("#TL_NOTA").val(item.tl_nota);
						//$("#TL_CO").val(item.tl_cortltion);
						//$("#TL_NO").val(item.tl_cortltion_date);
						//$("#TL_NO").val(item.tl_print_card);
						$("#TL_FROM").val(item.tl_from);
						$("#TL_TO").val(item.tl_to);
						$("#TL_CREATE_BY").val(item.tl_create_by);
						//$("#TL_CREATE_DATE").val(item.tl_create_date);
						//$("#TL_NO").val(item.tl_bl);
						//$("#TL_NO").val(item.tl_do);
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
		var DTL_TL				= $('#DTL_IS_TL');
		var DTL_CONT_SIZE		= $('#DTL_CONT_SIZE');
		var DTL_CONT_TYPE		= $('#DTL_CONT_TYPE');
		var DTL_CONT_STATUS		= $('#DTL_CONT_STATUS');
		var DTL_CONT_DANGER		= $('#DTL_CONT_DANGER');
		var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID');
		var DTL_REC_VIA			= $('#DTL_REC_VIA');
		var DTL_DEL_VIA			= $('#DTL_DEL_VIA');
		var DTL_REC_DATE		= $('#DTL_REC_DATE');
		var DTL_DEL_DATE		= $('#DTL_DEL_DATE');
		var DTL_OWNER			= $('#DTL_OWNER');
		var DTL_OWNER_NAME		= $('#DTL_OWNER_NAME');

		var StartDate= document.getElementById('DTL_REC_DATE').value;
	  	var EndDate= document.getElementById('DTL_DEL_DATE').value;
	  	var eDate = new Date(EndDate);
	  	var sDate = new Date(StartDate);

		if(DTL_OWNER.val() == ""){
			alert('Please choose Container Owner !');
			$('#DTL_OWNER').focus();
			return false;
		}
		else if (DTL_CONT.val() == "") {
			alert('Please choose No Container !');
			$('#DTL_CONT').focus();
			return false;
		}else if (DTL_TL.val() == "not-selected") {
			alert('Please choose TL !');
			$('#DTL_TL').focus();
			return false;
		}else if(DTL_CONT_SIZE.val() == "not-selected") {
			alert('Please choose Ukuran !');
			$('#DTL_CONT_SIZE').focus();
			return false;
		}else if(DTL_CONT_TYPE.val() == "not-selected") {
			alert('Please choose Type !');
			$('#DTL_CONT_TYPE').focus();
			return false;
		}else if(DTL_CONT_STATUS.val() == "not-selected") {
			alert('Please choose Status !');
			$('#DTL_CONT_STATUS').focus();
			return false;
		}else if(DTL_CONT_DANGER.val() == "not-selected") {
			alert('Please choose Sifat !');
			$('#DTL_CONT_DANGER').focus();
			return false;
		}else if(DTL_CMDTY_ID.val() == "not-selected") {
			alert('Please choose Kemasan !');
			$('#DTL_CMDTY_ID').focus();
			return false;
		}else if(DTL_REC_VIA.val() == "not-selected") {
			alert('Please choose Receiving Via !');
			$('#DTL_REC_VIA').focus();
			return false;
		}else if(DTL_DEL_VIA.val() == "not-selected") {
			alert('Please choose Delivery Via !');
			$('#DTL_DEL_VIA').focus();
			return false;
		}else if(StartDate!= '' && StartDate!= '' && sDate> eDate || sDate< eDate){
	    	alert("Jika TL Tanggal Receiving & Delivery Harus sama.");
	    	return false;
	    }

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var cargo_owner_id = $(this).find('.tbl_dtl_owner_id').html();		
			var no_cont = $(this).find('.tbl_dtl_cont').html();	
			var no_tl = $(this).find('.tbl_dtl_tl').html();	
			var barang_id = $(this).find('.tbl_dtl_cmdty_id').html();	
			var size_id = $(this).find('.tbl_dtl_size_id').html();		
			var type_id = $(this).find('.tbl_dtl_type_id').html();		
			var status_id = $(this).find('.tbl_dtl_status_id').html();		
			var sifat_id = $(this).find('.tbl_dtl_character_id').html();		
			var rec_via_id = $(this).find('.tbl_dtl_rec_via_id').html();		
			var del_via_id = $(this).find('.tbl_dtl_del_via_id').html();		

			var data_table =no_cont +  size_id + type_id + status_id + sifat_id + barang_id + rec_via_id + del_via_id;
			var form_data = DTL_CONT.val() + DTL_CONT_SIZE.val() + DTL_CONT_TYPE.val() + DTL_CONT_STATUS.val() +  DTL_CONT_DANGER.val() + DTL_CMDTY_ID.val() + DTL_REC_VIA.val() + DTL_DEL_VIA.val();
			
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

		// var status_container = false;
		// $.ajax({
		// 	async: false,
		// 	url: "<?= ROOT ?>npksbilling/mdm/cek_container/" + DTL_CONT.val(),
		// 	type: 'GET',
		// 	success: function(data) {
		// 		var arr = JSON.parse(JSON.parse(data));
		// 		if (arr.count < 1) {
		// 			status_container = true;
		// 		}
		// 	}
		// });

		// if (!status_container) {
		// 	alert('Status Container Gate In or In Yard.');
		// 	$('#DTL_CONT').focus();
		// 	return false;
		// }

		var brg_val = (DTL_CMDTY_ID.val() != "not-selected")? $('#DTL_CMDTY_ID option:selected').text() : "";
		var size_val = (DTL_CONT_SIZE.val() != "not-selected")? $('#DTL_CONT_SIZE option:selected').text() : "";
		var type_val = (DTL_CONT_TYPE.val() != "not-selected")? $('#DTL_CONT_TYPE option:selected').text() : "";
		var status_val = (DTL_CONT_STATUS.val() != "not-selected")? $('#DTL_CONT_STATUS option:selected').text() :"";
		var sifat_val = (DTL_CONT_DANGER.val() != "not-selected")? $('#DTL_CONT_DANGER option:selected').text() :"";
		var rec_via = (DTL_REC_VIA.val() != "not-selected")? $('#DTL_REC_VIA option:selected').text() :"";
		var del_via = (DTL_DEL_VIA.val() != "not-selected")? $('#DTL_DEL_VIA option:selected').text() :"";

		$('#detail-list tbody').append(
			'<tr>' +
				'<td style="display: none;" class="tbl_dtl_id">'+ DTL_ID.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_hdr_id">'+ HDR_ID.val() +'</td>' +

				'<td style="display: none;" class="tbl_dtl_owner_id">'+ DTL_OWNER.val() +'</td>' +
				'<td class="tbl_dtl_owner_name">'+ DTL_OWNER_NAME.val() +'</td>' +

				'<td class="tbl_dtl_cont">'+ DTL_CONT.val() +'</td>' +
				'<td class="tbl_dtl_tl">'+ DTL_TL.val() +'</td>' +

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

				'<td style="display: none;" class="tbl_dtl_rec_via_id">'+ DTL_REC_VIA.val() +'</td>' +
				'<td class="tbl_dtl_rec_via_name">'+ rec_via +'</td>' +

				'<td style="display: none;" class="tbl_dtl_del_via_id">'+ DTL_DEL_VIA.val() +'</td>' +
				'<td class="tbl_dtl_del_via_name">'+ del_via +'</td>' +

				'<td class="tbl_dtl_rec_date">'+ DTL_REC_DATE.val() +'</td>' +
				'<td class="tbl_dtl_del_date">'+ DTL_DEL_DATE.val() +'</td>' +
				
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
				'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function(){ save_trucklosing(); return false; });

	function save_trucklosing() {
		$('#modal-default').modal('hide');
		var details = [];
		var file = [];
		var no_req = $("#TL_NO").val();

		$('#detail-list tbody tr').each(function() {
			var dtl_tl_id = $(this).find('.tbl_dtl_id').html(); 

			var cargo_owner_id = $(this).find('.tbl_dtl_owner_id').html();	
			var cargo_owner_name = $(this).find('.tbl_dtl_owner_name').html();	

			var no_cont = $(this).find('.tbl_dtl_cont').html();	
			var no_tl = $(this).find('.tbl_dtl_tl').html();	

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

			var rec_via_id = $(this).find('.tbl_dtl_rec_via_id').html();		
			var rec_via_name	= $(this).find('.tbl_dtl_rec_via_name').html();

			var del_via_id = $(this).find('.tbl_dtl_del_via_id').html();		
			var del_via_name	= $(this).find('.tbl_dtl_del_via_name').html();

			var del_date	= $(this).find('.tbl_dtl_del_date').html();
			var rec_date	= $(this).find('.tbl_dtl_rec_date').html();

			var tamp = {
				"TL_DTL_ID": dtl_tl_id,
                "TL_HDR_ID": $("#TL_ID").val(),
                "TL_DTL_CONT": no_cont,
                "TL_DTL_CONT_SIZE": (size_id != "not-selected")? size_id : "",
                "TL_DTL_CONT_TYPE": (type_id != "not-selected")? type_id : "",
                "TL_DTL_CONT_STATUS": (status_id != "not-selected")? status_id : "",
                "TL_DTL_CONT_DANGER": (sifat_id != "not-selected")? sifat_id : "",
                "TL_DTL_CMDTY_ID": (barang_id != "not-selected")? barang_id : "",
                "TL_DTL_CMDTY_NAME": barang_name,
                "TL_DTL_REC_VIA": (rec_via_id != "not-selected")? rec_via_id : "",
                "TL_DTL_ACTIVITY_DATE": null,
                "TL_DTL_OWNER": cargo_owner_id,
                "TL_DTL_OWNER_NAME": cargo_owner_name,
                "TL_DTL_VIA_REC_NAME": rec_via_name,
                "TL_DTL_SI_NO": null,
                "TL_DTL_QTY": null,
                "TL_DTL_CHARACTER_ID": null,
                "TL_DTL_CHARACTER_NAME": null,
                "TL_DTL_PKG_ID": "8",
                "TL_DTL_PKG_NAME": null,
                "TL_DTL_UNIT_ID": null,
                "TL_DTL_UNIT_NAME": null,
                "TL_DTL_DEL_VIA": (del_via_id != "not-selected")? del_via_id : "",
                "TL_DTL_DEL_VIA_NAME": del_via_name,
                "TL_DTL_ISACTIVE": "Y",
                "TL_DTL_REC_DATE": rec_date,
                "TL_DTL_DEL_DATE": del_date,
                "TL_DTL_IS_TL": (no_tl != "not-selected")? no_tl : "",
                "TL_DTL_ISCANCELLED": "N"
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
		        "TABLE": "TX_HDR_TL",
		        "PK": "TL_ID",
		        "VALUE": [
		            {
		                "APP_ID": 2,
		                "TL_ID": $("#TL_ID").val(),
		                "TL_NO": no_req,
		                "TL_DATE": $("#TL_DATE").val(),
		                "TL_PAYMETHOD": $("#TL_PAYMETHOD").val(),
		                "TL_CUST_ID":  "<?=$this->session->userdata('customerid_phd')?>",
			            "TL_CUST_NAME":  "<?=$this->session->userdata('customernamealt_phd')?>",
			            "TL_CUST_NPWP":  "<?=$this->session->userdata('npwp_phd')?>",
		                "TL_CUST_ACCOUNT": null,
		                "TL_STACKBY_ID": $("#TL_STACKBY_ID").val(),
		                "TL_STACKBY_NAME": $("#TL_STACKBY_NAME").val(),
		                "TL_VESSEL_CODE": $("#TL_VESSEL_CODE").val(),
		                "TL_VESSEL_NAME": $("#TL_VESSEL").val(),
		                "TL_VOYIN": $("#TL_VOYIN").val(),
		                "TL_VOYOUT": $("#TL_VOYOUT").val(),
		                "TL_VVD_ID": $("#TL_VVD_ID").val(),
		                "TL_VESSEL_ETD": $("#TL_VESSEL_ETD").val(),
		                "TL_BRANCH_ID":  $('#TL_BRANCH_CODE').find('option:selected').attr('brchid'),
		                "TL_NOTA": "20",
		                "TL_FROM": $("#TL_FROM").val(),
		                "TL_TO": $("#TL_TO").val(),
		                "TL_CREATE_BY": "1",
		                "TL_STATUS": 1,
		                "TL_VESSEL_AGENT": "",
		                "TL_VESSEL_AGENT_NAME": "",
		                "TL_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
		                "TL_BRANCH_CODE":  $("#TL_BRANCH_CODE").val(),
		                "TL_PBM_ID": $("#TL_PBM_ID").val(),
		                "TL_PBM_NAME": $("#TL_PBM_NAME").val(),
		                "TL_VESSEL_PKK": $("#TL_VESSEL_PKK").val()
		            }
		        ]
		    },
            "DETAIL": {
                "DB"     : "omuster",
                "TABLE"  : "TX_DTL_TL",
                "FK"     : ["TL_HDR_ID","tl_id"],
                "VALUE"  : (details.length > 0) ? details : []
            },
            "FILE": {
                "DB"     : "omuster",
                "TABLE"  : "TX_DOCUMENT",
                "FK"     : ["REQ_NO","tl_no"],
                "VALUE"  : (file.length > 0) ? file : []
            }
		}
		console.log(arrData);
		//return false;
		$.blockUI();

		// var REC_PBM_NAME		= $('#REC_PBM_NAME').val();
		// var REC_STACKBY_NAME	= $('#REC_STACKBY_NAME').val();
		// var REC_FROM			= $('#REC_FROM').val();
		// var REC_PAYMETHOD		= $('#REC_PAYMETHOD').val();

		// if (REC_PBM_NAME == '') {
		// 	$.unblockUI();
		// 	alert('PBM Harus diisi !!');
		// 	return false;
		// } else if (REC_STACKBY_NAME == '') {
		// 	$.unblockUI();
		// 	alert('Penumpukan Harus diisi !!');
		// 	return false;
		// }else if (REC_FROM == 'not-selected') {
		// 	$.unblockUI();
		// 	alert('From Harus diisi !!');
		// 	return false;
		// }else if (REC_PAYMETHOD == 'not-selected') {
		// 	$.unblockUI();
		// 	alert('Payment Method Harus diisi !!');
		// 	return false;
		// }

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
			url: "<?=ROOT?>npksbilling/trucklosing/save/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var temp = JSON.parse(data.data);
					var no_req = temp['header']['tl_no'];

					var notification = new NotificationFx({
						message : '<p>Data '+no_req+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success'
					});
					trucklosing_log(no_req);
					setTimeout(function(){ window.location = "<?=ROOT?>npksbilling/trucklosing"; }, 3000);	
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}

	function trucklosing_log() {
		var status_req = $('#TL_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/trucklosing_log",
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


<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/select2.css" type="text/css" />
