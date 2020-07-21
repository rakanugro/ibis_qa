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
				<input id="CARGO_DTL_ID" name="CARGO_DTL_ID" type="hidden" class="form-control">
				<div class="main-box-body clearfix">
					<div class="row">
						<div class="form-group col-xs-6">
							<label>Terminal</label>
							<select id="DEL_CARGO_BRANCH_CODE" name="DEL_CARGO_BRANCH_CODE" class="form-control" required="">
								<option value="not-selected"> -- Please Choose From  -- </option>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label>PBM / EMKL</label>
							<input name="DEL_CARGO_PBM_NAME" id="DEL_CARGO_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
							<input name="DEL_CARGO_PBM_ID" id="DEL_CARGO_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Nomor Request</label>
							<input name="DEL_CARGO_NO" id="DEL_CARGO_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
							<input name="DEL_CARGO_ID" id="DEL_CARGO_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
						</div>
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Date</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input id="DEL_CARGO_DATE" name="DEL_CARGO_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" required="" readOnly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label>Penumpukan Oleh</label>
							<input name="DEL_CARGO_STACKBY_NAME" id="DEL_CARGO_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
							<input name="DEL_CARGO_STACKBY_ID" id="DEL_CARGO_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
						</div>
						<div class="form-group col-xs-6">
							<label>To</label>
							<select id="DEL_CARGO_TO" name="DEL_CARGO_TO" class="form-control" required="">
								<option value="not-selected"> -- Please Choose To  -- </option>
								<option value="1">DEPO</option>
								<option value="2">TPK</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-12">
							<label>Payment Method</label>
							<select id="DEL_CARGO_PAYMETHOD" name="DEL_CARGO_PAYMETHOD" class="form-control" required="">
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
						<input name="DEL_CARGO_VESSEL_NAME" id="DEL_CARGO_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="">
						<input type="hidden" id="DEL_CARGO_VESSEL_CODE" class="form-control" name="DEL_CARGO_VESSEL_CODE" required>
						<input type="hidden" id="DEL_CARGO_VESSEL" class="form-control" name="DEL_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="DEL_CARGO_VESSEL_AGENT" id="DEL_CARGO_VESSEL_AGENT" type="text" class="form-control" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="DEL_CARGO_VESSEL_PKK" id="DEL_CARGO_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
						<input name="DEL_CARGO_VVD_ID" id="DEL_CARGO_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" required="" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="DEL_CARGO_VOYIN" id="DEL_CARGO_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="DEL_CARGO_VOYOUT" id="DEL_CARGO_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="DEL_CARGO_VESSEL_ETA" id="DEL_CARGO_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" required="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="DEL_CARGO_VESSEL_ETD" id="DEL_CARGO_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" required="">
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
				<input id="CARGO_DTL_STACK_DATE" name="CARGO_DTL_STACK_DATE" type="hidden" class="form-control">
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-4">
						<label>Cargo Owner</label>
						<input id="CARGO_DTL_OWNER_NAME" name="CARGO_DTL_OWNER_NAME" type="text" class="form-control" value="<?=$this->session->userdata('customernamealt_phd')?>">
						<input id="CARGO_DTL_OWNER" name="CARGO_DTL_OWNER" type="hidden" value="<?=$this->session->userdata('customerid_phd')?>" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>BL/SI/DO</label>
						<input name="CARGO_DTL_SI_NO" id="CARGO_DTL_SI_NO" type="text" class="form-control" placeholder="No BL/SI/DO" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Jumlah</label>
						<input name="CARGO_DTL_QTY" id="CARGO_DTL_QTY" type="number" min="1" class="form-control" placeholder="Jumlah" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Sifat</label>
						<input name="CARGO_DTL_CHARACTER_NAME" id="CARGO_DTL_CHARACTER_NAME" type="text" class="form-control" placeholder="Sifat" required="">
						<input name="CARGO_DTL_CHARACTER_ID" id="CARGO_DTL_CHARACTER_ID" type="hidden" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-4">
						<label>Kemasan</label>
						<input name="CARGO_DTL_PKG_NAME" id="CARGO_DTL_PKG_NAME" type="text" class="form-control" placeholder="Kemasan" required="">
						<input name="CARGO_DTL_PKG_ID" id="CARGO_DTL_PKG_ID" type="hidden" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-4 hidden_content">
						<label>Kemasan Tamp</label>
						<input type="text" name="CARGO_DTL_PKG_TMP" id="CARGO_DTL_PKG_TMP" class="form-control">
					</div>
					<div class="form-group col-xs-4">
						<label>Barang</label>
						<input name="CARGO_DTL_CMDTY_NAME" id="CARGO_DTL_CMDTY_NAME" type="text" class="form-control" placeholder="Barang" required="">
						<input name="CARGO_DTL_CMDTY_ID" id="CARGO_DTL_CMDTY_ID" type="hidden" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-6">
						<label>Satuan</label>
						<input name="CARGO_DTL_UNIT_NAME" id="CARGO_DTL_UNIT_NAME" type="text" class="form-control" placeholder="Satuan" required="">
						<input name="CARGO_DTL_UNIT_ID" id="CARGO_DTL_UNIT_ID" type="hidden" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-6">
						<label>Delivery Via</label>
						<select id="CARGO_DTL_VIA" name="CARGO_DTL_VIA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Via  -- </option>
						</select>
						<input name="CARGO_DTL_VIA_NAME" id="CARGO_DTL_VIA_NAME" type="hidden" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-6">
						<label>Stacking Area</label>
						<select id="CARGO_DTL_STACK_AREA" name="CARGO_DTL_STACK_AREA" class="form-control" required="">
							<option value="not-selected"> -- Please Choose Stacking Area  -- </option>
						</select>
						<input name="CARGO_DTL_STACK_AREA_NAME" id="CARGO_DTL_STACK_AREA_NAME" type="hidden" class="form-control" placeholder="No Container" required="">
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Delivery</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="CARGO_DTL_DEL_DATE" name="CARGO_DTL_DEL_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>">
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
								<th>Cargo Owner</th>
								<th>BL/SI/DO</th>
								<th>Jumlah</th>
								<th>Sifat</th>
								<th>Kemasan</th>
								<th>Barang</th>
								<th>Satuan</th>
								<th>Delivery Via</th>
								<th>Stacking Area</th>
								<th>Tanggal Receiving</th>
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

		$('#DEL_CARGO_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		$(function() {
			$("#CARGO_DTL_DEL_DATE").datetimepicker({
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

			var no_req = $('#DEL_CARGO_NO').val();

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

			var DEL_CARGO_PBM_NAME			= $('#DEL_CARGO_PBM_NAME');
			var DEL_CARGO_TO				= $('#DEL_CARGO_TO');
			var DEL_CARGO_PAYMETHOD			= $('#DEL_CARGO_PAYMETHOD');
			var DEL_CARGO_STACKBY_NAME		= $('#DEL_CARGO_STACKBY_NAME');
			var DEL_CARGO_VESSEL		= $('#DEL_CARGO_VESSEL');

			$('#DOC_NO'+counterdoc).keypress(function(){
				if (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != 'not-selected' && DEL_CARGO_VESSEL.val() != '')  {
					if($('#DOC_NO'+counterdoc).val().length > 1 && $('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
					else{
						$("#btn-show").prop('disabled', true);
					}
				}
			});

			$('#DOC_NO'+counterdoc).keydown(function(){
				if (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != 'not-selected' && DEL_CARGO_VESSEL.val() != '')  {
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

		//validasi header
		$("#btn-show").prop('disabled', true);

		var DEL_CARGO_PBM_NAME			= $('#DEL_CARGO_PBM_NAME');
		var DEL_CARGO_TO				= $('#DEL_CARGO_TO');
		var DEL_CARGO_PAYMETHOD			= $('#DEL_CARGO_PAYMETHOD');
		var DEL_CARGO_STACKBY_NAME		= $('#DEL_CARGO_STACKBY_NAME');
		var DEL_CARGO_VESSEL			= $('#DEL_CARGO_VESSEL');

		DEL_CARGO_PBM_NAME.keypress(function(){
			if (DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != '' && DEL_CARGO_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(DEL_CARGO_PBM_NAME.val() == ''){
				$("#btn-show").prop('disabled', true);
			}
		})

		DEL_CARGO_TO.change(function(){
			if (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != '' && DEL_CARGO_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(DEL_CARGO_TO.val() == 'not-selected'){
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_CARGO_PAYMETHOD.change(function(){
			if (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != '' && DEL_CARGO_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(DEL_CARGO_PAYMETHOD.val() == 'not-selected'){
				$("#btn-show").prop('disabled', true);
			}
		});

		DEL_CARGO_STACKBY_NAME.keypress(function(){
			if (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_VESSEL.val() != '')  {
				if(typeof($('#DOC_NAME'+counterdoc)) != "undefined"){
					if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
						$("#btn-show").prop('disabled', false);
					}
				}
			}
			if(DEL_CARGO_STACKBY_NAME.val() == ''){
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

				var isSet = $('#DEL_CARGO_BRANCH_CODE').append(toAppend);
				if(isSet){
					$('#DEL_CARGO_BRANCH_CODE').val('PTG');
				}
			}
		});

		//PBM
		$('#DEL_CARGO_PBM_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#DEL_CARGO_BRANCH_CODE").find('option:selected').attr('brchid');
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
				$('#DEL_CARGO_PBM_NAME').val(ui.item.label);
				$('#DEL_CARGO_PBM_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//stackby
		$('#DEL_CARGO_STACKBY_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#DEL_CARGO_BRANCH_CODE").find('option:selected').attr('brchid');
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
				$('#DEL_CARGO_STACKBY_NAME').val(ui.item.label);
				$('#DEL_CARGO_STACKBY_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//to
		// $.ajax({
		//     type: "GET",
		//    	url: "<?=ROOT?>npksbilling/mdm/to_cargo",
		// 	success: function(data){
		// 		var obj = JSON.parse(data);
		// 		var record = obj['result'];
		
		// 		var toAppend = '';
		// 		for(var i=0;i<record.length;i++){
		// 			toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
		// 		}
				
		// 		$('#DEL_CARGO_TO').append(toAppend);
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
				
				var isSet = $('#DEL_CARGO_PAYMETHOD').append(toAppend);
				if(isSet){
					$('#DEL_CARGO_PAYMETHOD').val('1');
				}
			}
		});

		//vessel
		$('#DEL_CARGO_VESSEL_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?= ROOT ?>npksbilling/mdm/vessel",
					type: 'GET',
					data: {
						vessel: request.term
					},
					dataType: 'json',
					success: function(data) {
						response(data);
					}
				});
			},
			select: function (event, ui) {
				$('#DEL_CARGO_VESSEL_NAME').val(ui.item.label);
				$('#DEL_CARGO_VESSEL_CODE').val(ui.item.vesselCode);
				$('#DEL_CARGO_VOYIN').val(ui.item.voyageIn);
				$('#DEL_CARGO_VOYOUT').val(ui.item.voyageOut);
				$('#DEL_CARGO_VESSEL_PKK').val(ui.item.idVsbVoyage);
				$('#DEL_CARGO_VVD_ID').val(ui.item.idUkkSimop);
				$('#DEL_CARGO_VESSEL_ETA').val(ui.item.eta);
				$('#DEL_CARGO_VESSEL_ETD').val(ui.item.etd);
				$('#DEL_CARGO_VESSEL').val(ui.item.name);

				var DEL_CARGO_PBM_NAME			= $('#DEL_CARGO_PBM_NAME');
				var DEL_CARGO_TO				= $('#DEL_CARGO_TO');
				var DEL_CARGO_PAYMETHOD			= $('#DEL_CARGO_PAYMETHOD');
				var DEL_CARGO_STACKBY_NAME		= $('#DEL_CARGO_STACKBY_NAME');
				var DEL_CARGO_VESSEL			= $('#DEL_CARGO_VESSEL');

				if (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != '')  {
						if($('#DOC_NAME'+counterdoc).val() != undefined){
							if($('#DOC_NAME'+counterdoc).val() != '' && $('#DOC_NO'+counterdoc).val() != '' && $('#DOC_TYPE'+counterdoc).val() != 'not-selected'){
								$("#btn-show").prop('disabled', false);
							}
						}
				}
				if (DEL_CARGO_VESSEL.val() == ''){
					$("#btn-show").prop('disabled', true);
				}
				
				return false;
			}
		});

		//customer
		$('#CARGO_DTL_OWNER_NAME').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#DEL_CARGO_BRANCH_CODE").find('option:selected').attr('brchid');
				console.log(request);
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
				$('#CARGO_DTL_OWNER_NAME').val(ui.item.label);
				$('#CARGO_DTL_OWNER').val(ui.item.customer_id);
				return false;
			}
		});

		//sifat
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/sifat_cargo",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['character_id']+'">'+record[i]['character_name']+'</option>';
				}
				
				$('#CARGO_DTL_CHARACTER_ID').append(toAppend);
			}
		});

		

		//stacking
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/stacking",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#CARGO_DTL_STACK_AREA').append(toAppend);
			}
		});

		//kemasan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/kemasan_cargo",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['package_id']+'">'+record[i]['package_name']+'</option>';
				}
				
				$('#CARGO_DTL_PKG_ID').append(toAppend);
			}
		});

		//barang
		// $('#CARGO_DTL_PKG_ID').on('change', function() {
		// 	var val = this.value;
		// 	$.ajax({
		// 		type: "GET",
		// 		url: "<?=ROOT?>npksbilling/mdm/barang_cargo/"+ val,
		// 		success: function(data){
		// 			if(!data){
		// 				return false;
		// 			}
		// 			var obj = JSON.parse(data);
		// 			var record = obj['result'];
		// 			var toAppend = '';
		// 			for(var i=0;i<record.length;i++){
		// 				toAppend += '<option pgkid="'+record[i]['package_id']+'" value="'+record[i]['commodity_id']+'">'+record[i]['commodity_name']+'</option>';
		// 			}
		// 			//$('#CARGO_DTL_CMDTY_ID').find('option').remove().end().append('<option value="not-selected"> -- Please Choose Barang  -- </option>');
		// 			$('#CARGO_DTL_CMDTY_ID').append(toAppend);
		// 		}
		// 	});
		// });

		//NO SI
		$('#CARGO_DTL_SI_NO').autocomplete({
			source: function( request, response ) {
				var branch_id =  $("#DEL_CARGO_BRANCH_CODE").find('option:selected').attr('brchid');
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/no_si/",
					type: 'GET',
					dataType: 'json',
					data: {request:request.term, branch_id:branch_id},
					success: function( data ) {
						console.log(data);
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#CARGO_DTL_SI_NO').val(ui.item.label);
				$('#CARGO_DTL_QTY').val(ui.item.qty);
				$('#CARGO_DTL_CHARACTER_ID').val(ui.item.sifat_id);
				$('#CARGO_DTL_CHARACTER_NAME').val(ui.item.sifat_name);
				$('#CARGO_DTL_PKG_ID').val(ui.item.pkg_id);
				$('#CARGO_DTL_PKG_NAME').val(ui.item.pkg_name);
				$('#CARGO_DTL_CMDTY_ID').val(ui.item.cmdty_id);
				$('#CARGO_DTL_CMDTY_NAME').val(ui.item.cmdty_name);
				$('#CARGO_DTL_PKG_TMP').val(ui.item.pkg_parent_id);
				$('#CARGO_DTL_UNIT_ID').val(ui.item.satuan_id);
				$('#CARGO_DTL_UNIT_NAME').val(ui.item.satuan_name);
				$('#CARGO_DTL_STACK_DATE').val(ui.item.stack_date);
				return false;
			}
		});

		//barang tmp
		$('#CARGO_DTL_PKG_ID').on('change', function() {
			var DTL_PKG_ID = $(this).val();
			$('#CARGO_DTL_PKG_TMP').val(DTL_PKG_ID);
		});

		$('#CARGO_DTL_CMDTY_ID').on('change', function() {
			var DTL_CMDTY_ID = $(this).val();
			var parent_id =  $(this).find('option:selected').attr('pgkid');
			$('#CARGO_DTL_PKG_TMP').val(parent_id);
		});

		//satuan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/satuan_cargo",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['unit_id']+'">'+record[i]['unit_name']+'</option>';
				}
				
				$('#CARGO_DTL_UNIT_ID').append(toAppend);
			}
		});

		//via
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
				
				$('#CARGO_DTL_VIA').append(toAppend);
			}
		});

		$('#DEL_CARGO_BRANCH_CODE').on('change', function() {
			var branch_id =  $(this).find('option:selected').attr('brchid');
			$('#DEL_CARGO_BRANCH_ID').val(branch_id);
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

							var DEL_CARGO_PBM_NAME			= $('#DEL_CARGO_PBM_NAME');
							var DEL_CARGO_TO				= $('#DEL_CARGO_TO');
							var DEL_CARGO_PAYMETHOD			= $('#DEL_CARGO_PAYMETHOD');
							var DEL_CARGO_STACKBY_NAME		= $('#DEL_CARGO_STACKBY_NAME');
							var DEL_CARGO_VESSEL			= $('#DEL_CARGO_VESSEL');

							console.log(counterdoc);
							console.log($('#DOC_NO'+counterdoc).val());
							console.log($('#DOC_NAME'+counterdoc).val());
							if  (DEL_CARGO_PBM_NAME.val() != '' && DEL_CARGO_TO.val() != 'not-selected' && DEL_CARGO_PAYMETHOD.val() != 'not-selected' && DEL_CARGO_STACKBY_NAME.val() != '' && DEL_CARGO_VESSEL.val() != '') {
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
	var id_del = "<?=$id?>";
	if(id_del != ""){
		$.blockUI();
		$.ajax({
			url: "<?=ROOT?>npksbilling/deliverybarang/update_receivingBarang/"+id_del,
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				console.log(data);
				if(data.HEADER != ""){
					$.unblockUI();
					arrData = data;
					arrData.HEADER.forEach(function(item, index){
						$("#DEL_CARGO_ID").val(item.del_cargo_id);
						$("#DEL_CARGO_NO").val(item.del_cargo_no);
						$("#DEL_CARGO_DATE").val(item.del_cargo_date);
						$("#DEL_CARGO_PAYMETHOD").val(item.del_cargo_paymethod);
						$("#DEL_CARGO_CUST_ID").val(item.del_cargo_cust_id);
						$("#DEL_CARGO_CUST_NAME").val(item.del_cargo_cust_name);
						$("#DEL_CARGO_CUST_ADDRESS").val(item.del_cargo_cust_address);
						$("#DEL_CARGO_CUST_NPWP").val(item.del_cargo_cust_npwp);
						$("#DEL_CARGO_CUST_ACCOUNT").val(item.del_cargo_cust_account);
						$("#DEL_CARGO_STACKBY_ID").val(item.del_cargo_stackby_id);
						$("#DEL_CARGO_STACKBY_NAME").val(item.del_cargo_stackby_name);
						$("#DEL_CARGO_VESSEL_CODE").val(item.del_cargo_vessel_code);
						$("#DEL_CARGO_VESSEL_NAME").val(item.del_cargo_vessel_name);
						$("#DEL_CARGO_VOYIN").val(item.del_cargo_voyin);
						$("#DEL_CARGO_VOYOUT").val(item.del_cargo_voyout);
						$("#DEL_CARGO_VVD_ID").val(item.del_cargo_vvd_id);
						$("#DEL_CARGO_VESSEL_ETA").val(item.del_cargo_vessel_eta);
						$("#DEL_CARGO_VESSEL_ETA").val(item.del_cargo_vessel_etd);
						$("#DEL_CARGO_BRANCH_ID").val(item.del_cargo_branch_id);
						$("#DEL_CARGO_NOTA").val(item.del_cargo_nota);
						//$("#DEL_CARGO_CO").val(item.del_cargo_corDEL_CARGOtion);
						//$("#DEL_CARGO_NO").val(item.del_cargo_corDEL_CARGOtion_date);
						//$("#DEL_CARGO_NO").val(item.del_cargo_print_card);
						$("#DEL_CARGO_TO").val(item.del_cargo_to);
						$("#DEL_CARGO_CREATE_BY").val(item.del_cargo_create_by);
						//$("#DEL_CARGO_CREATE_DATE").val(item.del_cargo_create_date);
						//$("#DEL_CARGO_NO").val(item.del_cargo_bl);
						//$("#DEL_CARGO_NO").val(item.del_cargo_do);
						$("#DEL_CARGO_STATUS").val(1);
						$("#DEL_CARGO_VESSEL_AGENT").val(item.del_cargo_vessel_agent);
						$("#DEL_CARGO_VESSEL_AGENT_NAME").val(item.del_cargo_vessel_agent_name);
						$("#DEL_CARGO_BRANCH_CODE").val(item.del_cargo_branch_code);
						$("#DEL_CARGO_PBM_ID").val(item.del_cargo_pbm_id);
						$("#DEL_CARGO_PBM_NAME").val(item.del_cargo_pbm_name);
						$("#DEL_CARGO_VESSEL_PKK").val(item.del_cargo_vessel_pkk);
						$("#DEL_CARGO_VESSEL").val(item.del_cargo_vessel_name);
					});

					$('#show-detail').removeClass('hidden_content');
					arrData.DETAIL.forEach(function(detail, index){
						var owner_name = (detail.del_cargo_dtl_owner_name)? detail.del_cargo_dtl_owner_name : "";
						var owner_id = (detail.del_cargo_dtl_owner)? detail.del_cargo_dtl_owner : "";
						var no_bl = (detail.del_cargo_dtl_si_no)? detail.del_cargo_dtl_si_no : "";
						var jumlah = (detail.del_cargo_dtl_qty)? detail.del_cargo_dtl_qty : "";
						var sifat_id = (detail.del_cargo_dtl_character_id)? detail.del_cargo_dtl_character_id : "";
						var sifat_name = (detail.del_cargo_dtl_character_name)? detail.del_cargo_dtl_character_name : "";
						var kemasan_pkg_id = (detail.del_cargo_dtl_pkg_parent_id)? detail.del_cargo_dtl_pkg_parent_id : "";
						var kemasan_id = (detail.del_cargo_dtl_pkg_id)? detail.del_cargo_dtl_pkg_id : "";
						var kemasan_name = (detail.del_cargo_dtl_pkg_name)? detail.del_cargo_dtl_pkg_name : "";
						var barang_id = (detail.del_cargo_dtl_cmdty_id)? detail.del_cargo_dtl_cmdty_id : "";
						var barang_name = (detail.del_cargo_dtl_cmdty_name)? detail.del_cargo_dtl_cmdty_name : "";
						var satuan_id = (detail.del_cargo_dtl_unit_id)? detail.del_cargo_dtl_unit_id : "";
						var satuan_name = (detail.del_cargo_dtl_unit_name)? detail.del_cargo_dtl_unit_name : "";
						var via_id = (detail.del_cargo_dtl_via)? detail.del_cargo_dtl_via : "";
						var via_name = (detail.del_cargo_dtl_via_name)? detail.del_cargo_dtl_via_name : "";
						var stacking_id = (detail.del_cargo_dtl_stack_area)? detail.del_cargo_dtl_stack_area : "";
						var stacking_name = (detail.del_cargo_dtl_stack_area_name)? detail.del_cargo_dtl_stack_area_name : "";
						var tanggal_del = (detail.del_cargo_dtl_del_date)? detail.del_cargo_dtl_del_date : "";
						var stack_date = (detail.del_cargo_dtl_stack_date)? detail.del_cargo_dtl_stack_date : "";
						var del_dtl_id = (detail.del_cargo_dtl_id)? detail.del_cargo_dtl_id : "";
						var del_hdr_id = (detail.del_cargo_hdr_id)? detail.del_cargo_hdr_id : "";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td style="display: none;" class="tbl_cargo_dtl_id">'+ del_dtl_id +'</td>' +
								'<td style="display: none;" class="tbl_cargo_dtl_hdr_id">'+ del_hdr_id +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_owner_id">'+ owner_id +'</td>' +
								'<td class="tbl_cargo_dtl_owner_name">'+ owner_name +'</td>' +

								'<td class="tbl_cargo_dtl_bl">'+ no_bl +'</td>' +

								'<td class="tbl_cargo_dtl_qty">'+jumlah +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_character_id">'+ sifat_id +'</td>' +
								'<td class="tbl_cargo_dtl_character_name">'+ sifat_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_pkg_id">'+ kemasan_id +'</td>' +
								'<td class="tbl_cargo_dtl_pkg_name">'+ kemasan_name +'</td>' +
								'<td style="display: none;" class="tbl_cargo_dtl_pkg_parent_id">'+ kemasan_pkg_id +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_cmdty_id">'+ barang_id +'</td>' +
								'<td class="tbl_cargo_dtl_cmdty_name">'+ barang_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_unit_id">'+ satuan_id +'</td>' +
								'<td class="tbl_cargo_dtl_unit_name">'+ satuan_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_via_id">'+ via_id +'</td>' +
								'<td class="tbl_cargo_dtl_via_name">'+ via_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_stack_area">'+ stacking_id +'</td>' +
								'<td class="tbl_cargo_dtl_stack_area_name">'+ stacking_name +'</td>' +

								'<td class="tbl_cargo_dtl_del_date">'+ tanggal_del +'</td>' +
								'<td style="display: none;" class="tbl_cargo_dtl_stack_date">'+ stack_date +'</td>' +
								
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
		var CARGO_HDR_ID			= $('#CARGO_HDR_ID');
		var CARGO_DTL_ID			= $('#CARGO_DTL_ID');
		var CARGO_DTL_SI_NO			= $('#CARGO_DTL_SI_NO');
		var CARGO_DTL_QTY			= $('#CARGO_DTL_QTY');
		var CARGO_DTL_VIA			= $('#CARGO_DTL_VIA');
		var CARGO_DTL_STACK_AREA	= $('#CARGO_DTL_STACK_AREA');
		var CARGO_DTL_PKG_ID		= $('#CARGO_DTL_PKG_ID');
		var CARGO_DTL_PKG_NAME		= $('#CARGO_DTL_PKG_NAME');
		var CARGO_DTL_UNIT_ID		= $('#CARGO_DTL_UNIT_ID');
		var CARGO_DTL_UNIT_NAME		= $('#CARGO_DTL_UNIT_NAME');
		var CARGO_DTL_CMDTY_ID		= $('#CARGO_DTL_CMDTY_ID');
		var CARGO_DTL_CMDTY_NAME	= $('#CARGO_DTL_CMDTY_NAME');
		var CARGO_DTL_CHARACTER_ID	= $('#CARGO_DTL_CHARACTER_ID');
		var CARGO_DTL_CHARACTER_NAME= $('#CARGO_DTL_CHARACTER_NAME');
		var CARGO_DTL_DEL_DATE		= $('#CARGO_DTL_DEL_DATE');
		var CARGO_DTL_CREATE_DATE	= "";
		var CARGO_DTL_STACK_DATE	= $('#CARGO_DTL_STACK_DATE');
		var CARGO_DTL_EXT_DATE		= "";
		var CARGO_DTL_OWNER			= $('#CARGO_DTL_OWNER');
		var CARGO_DTL_OWNER_NAME	= $('#CARGO_DTL_OWNER_NAME');
		var CARGO_DTL_PKG_PARENT_ID	= $('#CARGO_DTL_PKG_TMP');

		if(CARGO_DTL_OWNER.val() == ""){
			alert('Please choose Cargo Owner !');
			$('#CARGO_DTL_OWNER').focus();
			return false;
		}
		else if (CARGO_DTL_SI_NO.val() == "") {
			alert('Please choose No BL/SI/DO !');
			$('#CARGO_DTL_SI_NO').focus();
			return false;
		}else if(CARGO_DTL_QTY.val() == "") {
			alert('Please choose Jumlah !');
			$('#CARGO_DTL_QTY').focus();
			return false;
		}else if(CARGO_DTL_CHARACTER_ID.val() == "not-selected") {
			alert('Please choose Sifat !');
			$('#CARGO_DTL_CHARACTER_ID').focus();
			return false;
		}else if(!CARGO_DTL_PKG_PARENT_ID) {
			alert('Please choose kemasan !');
			$('#CARGO_DTL_PKG_ID').focus();
			return false;
		}else if(CARGO_DTL_CMDTY_ID.val() == "not-selected") {
			alert('Please choose Barang !');
			$('#CARGO_DTL_CMDTY_ID').focus();
			return false;
		}else if(CARGO_DTL_UNIT_ID.val() == "not-selected") {
			alert('Please choose Satuan !');
			$('#CARGO_DTL_UNIT_ID').focus();
			return false;
		}else if(CARGO_DTL_VIA.val() == "not-selected") {
			alert('Please choose Via !');
			$('#CARGO_DTL_VIA').focus();
			return false;
		}else if(CARGO_DTL_STACK_AREA.val() == "not-selected") {
			alert('Please choose Stacking Area !');
			$('#CARGO_DTL_STACK_AREA').focus();
			return false;
		}else if(CARGO_DTL_DEL_DATE.val() == "") {
			alert('Please choose Tanggal Delivery !');
			$('#CARGO_DTL_DEL_DATE').focus();
			return false;
		}

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var no_bl = $(this).find('.tbl_cargo_dtl_bl').html();				
			var jumlah = $(this).find('.tbl_cargo_dtl_qty').html();				
			var kemasan_id = $(this).find('.tbl_cargo_dtl_pkg_id').html();		
			var barang_id = $(this).find('.tbl_cargo_dtl_cmdty_id').html();		
			var unit_id = $(this).find('.tbl_cargo_dtl_unit_id').html();		
			var sifat_id = $(this).find('.tbl_cargo_dtl_character_id').html();
			var owner_id = 	$(this).find('.tbl_cargo_dtl_owner_id').html();

			var data_table = no_bl + kemasan_id + barang_id + unit_id + jumlah + sifat_id;
			var form_data = CARGO_DTL_SI_NO.val() + CARGO_DTL_PKG_ID.val() + CARGO_DTL_CMDTY_ID.val() +  CARGO_DTL_UNIT_ID.val() + CARGO_DTL_QTY.val() + CARGO_DTL_CHARACTER_ID.val();

			// var data_owner_table = owner_id + no_bl;
			// var data_owner_form = CARGO_DTL_OWNER.val() + CARGO_DTL_SI_NO.val();

			// if(data_owner_table == data_owner_form){
			// 	countData.push(1);
			// }
			if (data_table == form_data) {
				countData.push(1);
			}
		});

		if(countData.length > 0){
			alert('No BL/SI tidak boleh sama');
			return false;
		}

		var kemasan_val = (CARGO_DTL_PKG_ID.val() != "not-selected")? $('#CARGO_DTL_PKG_ID option:selected').text() : "";
		var brg_val = (CARGO_DTL_CMDTY_ID.val() != "not-selected")? $('#CARGO_DTL_CMDTY_ID option:selected').text() : "";
		var sifat_val = (CARGO_DTL_CHARACTER_ID.val() != "not-selected")? $('#CARGO_DTL_CHARACTER_ID option:selected').text() :"";
		var via_val = (CARGO_DTL_VIA.val() != "not-selected")? $('#CARGO_DTL_VIA option:selected').text() :"";
		var satuan_val = (CARGO_DTL_UNIT_ID.val() != "not-selected")? $('#CARGO_DTL_UNIT_ID option:selected').text() :"";
		var stack_val = (CARGO_DTL_STACK_AREA.val() != "not-selected")? $('#CARGO_DTL_STACK_AREA option:selected').text() :"";
		//var stack_date  = 	$(this).find('.tbl_cargo_dtl_stack_date').html();

		$('#detail-list tbody').append(
			'<tr>' +
				'<td style="display: none;" class="tbl_cargo_dtl_id">'+ CARGO_DTL_ID.val() +'</td>' +
				'<td style="display: none;" class="tbl_cargo_dtl_hdr_id">'+ CARGO_HDR_ID.val() +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_owner_id">'+ CARGO_DTL_OWNER.val() +'</td>' +
				'<td class="tbl_cargo_dtl_owner_name">'+ CARGO_DTL_OWNER_NAME.val() +'</td>' +

				'<td class="tbl_cargo_dtl_bl">'+ CARGO_DTL_SI_NO.val() +'</td>' +

				'<td class="tbl_cargo_dtl_qty">'+ CARGO_DTL_QTY.val() +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_character_id">'+ CARGO_DTL_CHARACTER_ID.val() +'</td>' +
				'<td class="tbl_cargo_dtl_character_name">'+ CARGO_DTL_CHARACTER_NAME.val() +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_pkg_id">'+ CARGO_DTL_PKG_ID.val() +'</td>' +
				'<td style="display: none;" class="tbl_cargo_dtl_pkg_parent_id">'+ CARGO_DTL_PKG_PARENT_ID.val() +'</td>' +
				'<td class="tbl_cargo_dtl_pkg_name">'+ CARGO_DTL_PKG_NAME.val() +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_cmdty_id">'+ CARGO_DTL_CMDTY_ID.val() +'</td>' +
				'<td class="tbl_cargo_dtl_cmdty_name">'+ CARGO_DTL_CMDTY_NAME.val() +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_unit_id">'+ CARGO_DTL_UNIT_ID.val() +'</td>' +
				'<td class="tbl_cargo_dtl_unit_name">'+ CARGO_DTL_UNIT_NAME.val() +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_via_id">'+ CARGO_DTL_VIA.val() +'</td>' +
				'<td class="tbl_cargo_dtl_via_name">'+ via_val +'</td>' +

				'<td style="display: none;" class="tbl_cargo_dtl_stack_area">'+ CARGO_DTL_STACK_AREA.val() +'</td>' +
				'<td class="tbl_cargo_dtl_stack_area_name">'+ stack_val +'</td>' +

				'<td class="tbl_cargo_dtl_del_date">'+ CARGO_DTL_DEL_DATE.val() +'</td>' +
				'<td style="display: none;" class="tbl_cargo_dtl_stack_date">'+ CARGO_DTL_STACK_DATE.val() +'</td>' +
				
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
				'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function(){ save_delivery_barang(); return false; });

	function save_delivery_barang() {
		$('#modal-default').modal('hide');
		var details = [];
		var file = [];
		var no_req = $('#DEL_CARGO_NO').val();

		$('#detail-list tbody tr').each(function() {
			var dtl_cargo_dtl_id = $(this).find('.tbl_cargo_dtl_id').html(); 
			var cargo_hdr_id = $(this).find('.tbl_cargo_dtl_hdr_id').html(); 
			var cargo_dtl_owner_id = $(this).find('.tbl_cargo_dtl_owner_id').html(); 
			var cargo_dtl_owner_name = $(this).find('.tbl_cargo_dtl_owner_name').html(); 
			var cargo_dtl_si_no = $(this).find('.tbl_cargo_dtl_bl').html(); 
			var cargo_dtl_qty = $(this).find('.tbl_cargo_dtl_qty').html(); 
			var cargo_dtl_character_id = $(this).find('.tbl_cargo_dtl_character_id').html(); 
			var cargo_dtl_character_name = $(this).find('.tbl_cargo_dtl_character_name').html(); 
			var cargo_dtl_pkg_id = $(this).find('.tbl_cargo_dtl_pkg_id').html(); 
			var cargo_dtl_pkg_name = $(this).find('.tbl_cargo_dtl_pkg_name').html(); 
			var cargo_dtl_pkg_parent_id = $(this).find('.tbl_cargo_dtl_pkg_parent_id').html(); 
			var cargo_dtl_cmdty_id = $(this).find('.tbl_cargo_dtl_cmdty_id').html(); 
			var cargo_dtl_cmdty_name = $(this).find('.tbl_cargo_dtl_cmdty_name').html(); 
			var cargo_dtl_unit_id = $(this).find('.tbl_cargo_dtl_unit_id').html(); 
			var cargo_dtl_unit_name = $(this).find('.tbl_cargo_dtl_unit_name').html(); 
			var cargo_dtl_via_id = $(this).find('.tbl_cargo_dtl_via_id').html(); 
			var cargo_dtl_stack_area = $(this).find('.tbl_cargo_dtl_stack_area').html(); 
			var cargo_dtl_stack_area_name = $(this).find('.tbl_cargo_dtl_stack_area_name').html(); 
			var cargo_dtl_via_name = $(this).find('.tbl_cargo_dtl_via_name').html(); 
			var cargo_dtl_del_date = $(this).find('.tbl_cargo_dtl_del_date').html(); 
			var cargo_dtl_stack_date = $(this).find('.tbl_cargo_dtl_stack_date').html(); 
			
			var tamp = {
				"DEL_CARGO_DTL_ID": dtl_cargo_dtl_id,
                "DEL_CARGO_HDR_ID": $('#DEL_CARGO_ID').val(),
                "DEL_CARGO_DTL_SI_NO": cargo_dtl_si_no,
                "DEL_CARGO_DTL_QTY": cargo_dtl_qty,
                "DEL_CARGO_DTL_VIA": (cargo_dtl_via_id != "not-selected")? cargo_dtl_via_id : "",
                "DEL_CARGO_DTL_PKG_ID": (cargo_dtl_pkg_id != "not-selected")? cargo_dtl_pkg_id : "",
                "DEL_CARGO_DTL_PKG_NAME": cargo_dtl_pkg_name,
                "DEL_CARGO_DTL_UNIT_ID": (cargo_dtl_unit_id != "not-selected")? cargo_dtl_unit_id : "",
                "DEL_CARGO_DTL_UNIT_NAME": cargo_dtl_unit_name,
                "DEL_CARGO_DTL_CMDTY_ID": (cargo_dtl_cmdty_id != "not-selected")? cargo_dtl_cmdty_id : "",
                "DEL_CARGO_DTL_CMDTY_NAME": cargo_dtl_cmdty_name,
                "DEL_CARGO_DTL_CHARACTER_ID": (cargo_dtl_character_id != "not-selected")? cargo_dtl_character_id : "",
                "DEL_CARGO_DTL_CHARACTER_NAME": cargo_dtl_character_name,
                "DEL_CARGO_DTL_DEL_DATE": cargo_dtl_del_date,
                "DEL_CARGO_DTL_CREATE_DATE": $('#DEL_CARGO_DATE').val(),
                "DEL_CARGO_DTL_STACK_DATE": cargo_dtl_stack_date,
                "DEL_CARGO_DTL_EXT_DATE": null,
                "DEL_CARGO_DTL_VIA_NAME": cargo_dtl_via_name,
                "DEL_CARGO_DTL_OWNER": (cargo_dtl_owner_id != "")? cargo_dtl_owner_id : "",
                "DEL_CARGO_DTL_OWNER_NAME": cargo_dtl_owner_name,
                "DEL_CARGO_DTL_PKG_PARENT_ID": cargo_dtl_pkg_parent_id,
                "DEL_CARGO_DTL_ISCANCELLED": "N",
                "DEL_CARGO_DTL_STACK_AREA": (cargo_dtl_stack_area != "not-selected")? cargo_dtl_stack_area : "",
                "DEL_CARGO_DTL_STACK_AREA_NAME": cargo_dtl_stack_area_name,
                "DEL_CARGO_DTL_REAL_QTY": null,
                "DEL_CARGO_FL_REAL": "1",
                "DEL_CARGO_DTL_CANC_QTY": "0",
                "DEL_CARGO_DTL_REAL_DATE": null
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
		        "TABLE": "TX_HDR_DEL_CARGO",
		        "PK": "DEL_CARGO_ID",
		        "VALUE": [
		        {
		            "APP_ID": 2,
		            "DEL_CARGO_ID": $('#DEL_CARGO_ID').val(),
	                "DEL_CARGO_NO": no_req,
	                "DEL_CARGO_DATE": $('#DEL_CARGO_DATE').val(),
	                "DEL_CARGO_PAYMETHOD": $('#DEL_CARGO_PAYMETHOD').val(),
	                "DEL_CARGO_CUST_ID": "<?=$this->session->userdata('customerid_phd')?>",
	                "DEL_CARGO_CUST_NAME": "<?=$this->session->userdata('customernamealt_phd')?>",
	                "DEL_CARGO_CUST_NPWP": "<?=$this->session->userdata('npwp_phd')?>",
	                "DEL_CARGO_CUST_ACCOUNT": null,
	                "DEL_CARGO_STACKBY_ID": $('#DEL_CARGO_STACKBY_ID').val(),
	                "DEL_CARGO_STACKBY_NAME": $('#DEL_CARGO_STACKBY_NAME').val(),
	                "DEL_CARGO_VESSEL_CODE": $('#DEL_CARGO_VESSEL_CODE').val(),
	                "DEL_CARGO_VESSEL_NAME": $('#DEL_CARGO_VESSEL').val(),
	                "DEL_CARGO_VOYIN": $('#DEL_CARGO_VOYIN').val(),
	                "DEL_CARGO_VOYOUT": $('#DEL_CARGO_VOYOUT').val(),
	                "DEL_CARGO_VVD_ID": $('#DEL_CARGO_VVD_ID').val(),
	                "DEL_CARGO_VESSEL_ETA": $('#DEL_CARGO_VESSEL_ETA').val(),
	                "DEL_CARGO_VESSEL_ETD": $('#DEL_CARGO_VESSEL_ETD').val(),
	                "DEL_CARGO_BRANCH_ID": $('#DEL_CARGO_BRANCH_CODE').find('option:selected').attr('brchid'),
	                "DEL_CARGO_NOTA": "22",
	                "DEL_CARGO_TO": $('#DEL_CARGO_TO').val(),
	                "DEL_CARGO_CREATE_BY": "1",
	                "DEL_CARGO_STATUS": 1,
	                "DEL_CARGO_VESSEL_AGENT": "-",
	                "DEL_CARGO_VESSEL_AGENT_NAME": "-",
	                "DEL_CARGO_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
	                "DEL_CARGO_BRANCH_CODE": $('#DEL_CARGO_BRANCH_CODE').val(),
	                "DEL_CARGO_PBM_ID": $('#DEL_CARGO_PBM_ID').val(),
	                "DEL_CARGO_PBM_NAME": $('#DEL_CARGO_PBM_NAME').val(),
	                "DEL_CARGO_VESSEL_PKK": $('#DEL_CARGO_VESSEL_PKK').val()

		        }]
		    },
            "DETAIL": {
                "DB"     : "omuster",
                "TABLE"  : "TX_DTL_DEL_CARGO",
                "FK"     : ["DEL_CARGO_HDR_ID","del_cargo_id"],
                "VALUE"  : (details.length > 0) ? details : []
            },
            "FILE": {
                "DB"     : "omuster",
                "TABLE"  : "TX_DOCUMENT",
                "FK"     : ["REQ_NO","del_cargo_no"],
                "VALUE"  : (file.length > 0) ? file : []
            }
		}
		console.log(arrData);
		//return false;
		$.blockUI();

		var DEL_CARGO_PBM_NAME		= $('#DEL_CARGO_PBM_NAME').val();
		var DEL_CARGO_STACKBY_NAME	= $('#DEL_CARGO_STACKBY_NAME').val();
		var DEL_CARGO_TO			= $('#DEL_CARGO_TO').val();
		var DEL_CARGO_PAYMETHOD		= $('#DEL_CARGO_PAYMETHOD').val();

		if (DEL_CARGO_PBM_NAME == '') {
			$.unblockUI();
			alert('PBM Harus diisi !!');
			return false;
		} else if (DEL_CARGO_STACKBY_NAME == '') {
			$.unblockUI();
			alert('Penumpukan Harus diisi !!');
			return false;
		}else if (DEL_CARGO_TO == 'not-selected') {
			$.unblockUI();
			alert('From Harus diisi !!');
			return false;
		}else if (DEL_CARGO_PAYMETHOD == 'not-selected') {
			$.unblockUI();
			alert('Payment Method Harus diisi !!');
			return false;
		}

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
			url: "<?=ROOT?>npksbilling/deliverybarang/save/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var temp = JSON.parse(data.data);
					var no_req = temp['header']['del_cargo_no'];

					var notification = new NotificationFx({
						message : '<p>Data '+no_req+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success'
					});
					deliverybarang_log(no_req);
					setTimeout(function(){ window.location = "<?=ROOT?>npksbilling/deliverybarang"; }, 3000);	
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}

	function deliverybarang_log(no_req) {
		var status_req = $('#DEL_CARGO_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npksbilling/transaction_log/deliverybarang_log",
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
