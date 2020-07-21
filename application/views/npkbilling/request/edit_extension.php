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
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Extension Reference</b></h2>
			</header>
			
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Request Reff</label>
					<input name="DEL_EXT_FROM" id="DEL_EXT_FROM" type="text" class="form-control" value="<?=$extension_views['HEADER'][0]->del_ext_from?>" readonly>
					<input name="DEL_ID" id="DEL_ID" type="hidden" class="form-control" value="<?=$extension_id?>" readonly>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Tanggal Request Reff</label>
					<input name="DEL_EXT_FROM_DATE" id="DEL_EXT_FROM_DATE" type="text" class="form-control" value="<?=$extension_views['HEADER'][0]->del_date?>" readonly>
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
						<label>Terminal</label>
						<input name="DEL_TERMINAL_NAME" id="DEL_TERMINAL_NAME" type="text" class="form-control" placeholder="Terminal" readonly>
						<input name="DEL_TERMINAL_CODE" id="DEL_TERMINAL_CODE" type="hidden" class="form-control" placeholder="Terminal" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Nomor Request</label>
						<input name="DEL_NO" id="DEL_NO" type="text" class="form-control" placeholder="Auto Generate" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Request</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_DATE" name="DEL_DATE" type="text" class="form-control" id="datepickerDate" readonly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<input name="DEL_TRADE_NAME" id="DEL_TRADE_NAME" type="text" class="form-control" placeholder="Tipe Perdagangan" readonly>
						<input name="DEL_TRADE_TYPE" id="DEL_TRADE_TYPE" type="hidden" class="form-control" placeholder="Tipe Perdagangan" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 hidden_content" id='international_content'>
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>International</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label for="exampleAutocomplete">No PEB/PIB</label>
						<input type="text" id="DEL_PIB_PEB_NO" name="DEL_PIB_PEB_NO" class="form-control" title="Masukkan No PEB" placeholder="No PEB/PIB" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
                      	<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_PIB_PEB_DATE" name="DEL_PIB_PEB_DATE" type="text" class="form-control" id="datepickerDate" placeholder="Tanggal PEB/PIB" readonly>
							<!-- <div class="input-group-btn">
								<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</button>
							</div> -->
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">No NPE/SPPB</label>
						<input id="DEL_NPE_SPPB_NO" name="DEL_NPE_SPPB_NO" type="text" class="form-control" id="exampleTooltip" placeholder="No NPE/SPPB" readonly>
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
					<div class="form-group col-xs-12">
						<label for="exampleAutocomplete">Vessel</label>
						<input type="text" id="DEL_VESSEL_NAME" name="DEL_VESSEL_NAME"  class="form-control" placeholder="Autocomplete" title="Masukkan data kapal" readonly>
						<input type="hidden" id="DEL_VESSEL_CODE" name="DEL_VESSEL_CODE"  class="form-control" placeholder="Autocomplete" title="Masukkan data kapal" readonly>
						<input type="hidden" id="DEL_VVD_ID" name="DEL_VVD_ID"  class="form-control" placeholder="Autocomplete" title="Masukkan data kapal" readonly>
						<input type="hidden" id="DEL_SPLIT" name="DEL_SPLIT"  class="form-control" placeholder="Autocomplete" title="Masukkan data kapal" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Kade</label>
						<input type="text" class="form-control" id="DEL_KADE" name="DEL_KADE" placeholder="Kade" title="Masukkan data kade" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Voyage In</label>
						<input type="text" class="form-control" id="DEL_VOYIN" name="DEL_VOYIN" placeholder="Voyage In" title="Masukkan data kapal" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Voyage Out</label>
						<input type="text" class="form-control" id="DEL_VOYOUT" name="DEL_VOYOUT" placeholder="Voyage Out" title="Masukkan data kapal" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETA</label>
						<input type="text" class="form-control" id="DEL_ETA" name="DEL_ETA" placeholder="ETA" title="Masukkan data kapal" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETD</label>
						<input type="text" class="form-control" id="DEL_ETD" name="DEL_ETD" placeholder="ETD" title="Masukkan data kapal" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETB</label>
						<input type="text" class="form-control" id="DEL_ETB" name="DEL_ETB" placeholder="ETB" title="Masukkan data ETB" readonly> 
					</div>
					<div class="form-group col-xs-4">
						<label for="datepickerDate">Actual Departure</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_ATD" name="DEL_ATD" type="text" class="form-control" id="datepickerDate" placeholder="Actual Departure" readonly>
						</div>
					</div>
					<div class="form-group col-xs-4">
						<label for="datepickerDate">Actual Destination</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_ATA" name="DEL_ATA" type="text" class="form-control" id="datepickerDate" placeholder="Actual Destination" readonly>
						</div>
					</div>
					<div class="form-group col-xs-4">
						<label for="datepickerDate">Open Stack</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_OPEN_STACK" name="DEL_OPEN_STACK" type="text" class="form-control" id="datepickerDate" placeholder="Actual Destination" readonly>
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="datepickerDate">UKK</label>
						<input id="DEL_UKK" name="DEL_UKK" type="text" class="form-control" id="datepickerDate" placeholder="UKK" readonly>
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
				
					<!-- <div class="form-group example-twitter-oss pull-right">
						<button type="button" class="btn btn-danger" id="btn-show">
			          		<span class="glyphicon glyphicon-ok-sign"></span> Show Detail
			        	</button>
			        </div> -->
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
									<th>Kemasan</th>
									<th>Barang</th>
									<th>Satuan</th>
									<th>Size</th>
									<th>Type</th>
									<th>Status</th>
									<th>Sifat</th>
									<th>Stacking Area Type</th>
									<th>Stacking Area</th>
									<th>Quantity</th>
									<th>Date In</th>
									<th>Date Out</th>
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

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Alat</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="form-group col-xs-12">
						<label>Layanan</label>
						<select id="EQ_GROUP_TARIFF" name="EQ_GROUP_TARIFF" class="form-control">
							<option value="not-selected"> -- Please Choose Layanan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-12">
						<label>Nama Alat</label>
						<select id="EQ_TYPE_ID_RENT" name="EQ_TYPE_ID_RENT" class="form-control">
							<option value="not-selected"> -- Please Choose Nama Alat  -- </option>
							<?php foreach($alat as $alt){ ?>
								<option value="<?=$alt->equipment_type_id?>"><?=$alt->equipment_type_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" class="form-control" id="EQ_TYPE_NAME_RENT" name="EQ_TYPE_NAME_RENT" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Satuan</label>
						<select id="EQ_UNIT_ID_RENT" name="EQ_UNIT_ID_RENT" class="form-control">
							<option value="not-selected"> -- Please Choose  Satuan  -- </option>
							<?php foreach($satuan as $stn){ ?>
								<option value="<?=$stn->unit_id?>"><?=$stn->unit_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" class="form-control" id="EQ_UNIT_NAME_RENT" name="EQ_UNIT_NAME_RENT" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Jumlah/Durasi Pemakaian</label>
						<input id="EQ_UNIT_QTY" name="EQ_UNIT_QTY" type="number" min="1" class="form-control" placeholder="Jumlah/Durasi Pemakaian">
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Jumlah Alat</label>
						<input id="EQ_QTY_RENT" name="EQ_QTY_RENT" type="number" class="form-control" placeholder="Jumlah Alat">
					</div>
					<div class="form-group col-xs-12">
						<label>Kemasan</label>
						<select id="PACKAGE_ID_RENT" name="PACKAGE_ID_RENT" class="form-control">
							<option value="not-selected"> -- Please Choose Kemasan  -- </option>
							<?php foreach($package as $pkg){ ?>
								<option value="<?=$pkg->package_id?>"><?=$pkg->package_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" class="form-control" id="PACKAGE_NAME_RENT" name="PACKAGE_NAME_RENT" readonly>
					</div>
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-danger" type="button" id="list-rental">
							<span class="glyphicon glyphicon-plus">Add</span>
						</button>
					</div>

					<table class="table table-striped table-hover" id="detail-rental">
						<thead>
							<tr>
								<th style="display:none;">ID</th>
								<th style="display:none;">Layanan ID</th>
								<th>Layanan</th>
								<th style="display:none;">Nama Alat ID</th>
								<th>Nama Alat</th>
								<th>Jumlah Alat</th>
								<th style="display:none;">Satuan ID</th>
								<th>Satuan</th>
								<th>Jumlah/Durasi Pemakaian</th>
								<th style="display:none;">Kemasan ID</th>
								<th>Kemasan</th>
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

	<input type="hidden" id="DEL_CREATE_BY">
	<!-- <input type="hidden" id="DEL_CREATE_DATE"> -->
	<input type="hidden" id="DEL_EXT_LOOP">
	<!-- <input type="hidden" id="DEL_MARK"> -->
	<input type="hidden" id="DEL_BRANCH_CODE">
	<input type="hidden" id="DEL_BRANCH_ID">
	<!-- <input type="hidden" id="DEL_CLOSING_TIME"> -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">		
					<div class="form-group example-twitter-oss pull-right">
						<button id="submit_header" class="btn btn-danger btn-footer" onclick="save_extension()"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
						<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>						
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
	//var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {

		$("#add_file").on("click", function () {
			counterdoc++;

		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#DEL_NO').val();


		    cols += '';
		    cols += '<div class="col-xs-6"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';
		    cols += '<div class="col-xs-5"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" id="DOC_NAME'+counterdoc+'" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc('+counterdoc+')"></div>';
			cols +=	'<input type="hidden" id="DOC_PATH'+counterdoc+'" name="DOC_PATH'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
			cols +=	'<input type="hidden" id="DOC_BASH'+counterdoc+'" name="DOC_BASH'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
			cols +=	'<input type="hidden" id="DOC_ID'+counterdoc+'" name="DOC_ID'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
			cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';
		    
		    newRow.append(cols);

			$(".list_file").append(newRow);

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

		
		var extension_id = $("#DEL_ID").val();

		$.blockUI();
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/request_extension/getDataReq?extension_id="+ extension_id,
			success: function(data){
				var obj = JSON.parse(JSON.parse(data));
				data = obj;
				console.log(data);
				$('#detail-list tbody tr').remove();
				$('#detail-rental tbody tr').remove();
				$('#detail-retribution tbody tr').remove();
				
				// TRADE TYPE
				data['HEADER'][0]['del_trade_type'] == 'I' ? $('#international_content').removeClass('hidden_content') : $('#international_content').addClass('hidden_content');
				
				// EXTENSION REFERENCE AND HEADER
				$('#DEL_EXT_FROM_DATE').val(data['HEADER'][0]['del_date']);
				$('#DEL_EXT_FROM').val(data['HEADER'][0]['del_ext_from']);
				$('.auto-generate').removeClass('hidden_content');
				$('#DEL_NO').val(data['HEADER'][0]['del_no']);
				$('#DEL_TERMINAL_NAME').val(data['HEADER'][0]['del_terminal_name']);
				$('#DEL_TERMINAL_CODE').val(data['HEADER'][0]['del_terminal_code']);
				$('#DEL_DATE').val(data['HEADER'][0]['del_date']);
				$('#DEL_TRADE_NAME').val(data['HEADER'][0]['del_trade_name']);
				$('#DEL_TRADE_TYPE').val(data['HEADER'][0]['del_trade_type']);

				// TRADE TYPE INTERNATION ONLY
				$('#DEL_PIB_PEB_NO').val(data['HEADER'][0]['del_pib_peb_no']);
				$('#DEL_PIB_PEB_DATE').val(data['HEADER'][0]['del_pib_peb_date']);
				$('#DEL_NPE_SPPB_NO').val(data['HEADER'][0]['del_npe_sppb_no']);

				$('#DEL_SPLIT').val(data['HEADER'][0]['del_split']);							
				
				// VESSEL
				$('#DEL_VESSEL_NAME').val(data['HEADER'][0]['del_vessel_name']);
				$('#DEL_VESSEL_CODE').val(data['HEADER'][0]['del_vessel_code']);
				$('#DEL_KADE').val(data['HEADER'][0]['del_kade']);
				$('#DEL_VOYIN').val(data['HEADER'][0]['del_voyin']);
				$('#DEL_VOYOUT').val(data['HEADER'][0]['del_voyout']);
				$('#DEL_ETA').val(data['HEADER'][0]['del_eta']);
				$('#DEL_ETD').val(data['HEADER'][0]['del_etd']);
				$('#DEL_ETB').val(data['HEADER'][0]['del_etb']);
				$('#DEL_ATD').val(data['HEADER'][0]['del_atd']);
				$('#DEL_ATA').val(data['HEADER'][0]['del_ata']);
				$('#DEL_OPEN_STACK').val(data['HEADER'][0]['del_open_stack']);
				$('#DEL_UKK').val(data['HEADER'][0]['del_ukk']);

				$('#DEL_CREATE_BY').val(data['HEADER'][0]['del_create_by']);							
				// $('#DEL_CREATE_DATE').val(data['HEADER'][0]['del_create_date']);							
				$('#DEL_EXT_LOOP').val(data['HEADER'][0]['del_ext_loop']);										
				// $('#DEL_MARK').val(data['HEADER'][0]['del_mark']);							
				$('#DEL_BRANCH_CODE').val(data['HEADER'][0]['del_branch_code']);						
				$('#DEL_BRANCH_ID').val(data['HEADER'][0]['del_branch_id']);						
				// $('#DEL_CLOSING_TIME').val(data['HEADER'][0]['del_closing_time']);							

				// NEW DOCUMENTS
				data.FILE.forEach(function(file, index){
					if (data.FILE.length != 0) {
						counterdoc++;
						var newRow = $("<tr>");
						var cols = "";

						cols += '';
						cols += '<div class="col-xs-6"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" value="'+file.doc_no+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';
						cols += '<div class="col-xs-5"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" value="'+file.doc_name+'" id="DOC_NAME'+counterdoc+'" doc_name="'+file.doc_name+'" data-toggle="tooltip" data-placement="bottom" size="100"><a href="<?=apiUrl?>/'+file.doc_path+'" target="_blank">'+file.doc_name+'</a></div>';
						cols +=	'<input type="hidden" id="DOC_PATH'+counterdoc+'" name="DOC_PATH'+counterdoc+'" value="'+file.doc_path+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
						cols +=	'<input type="hidden" id="DOC_BASH'+counterdoc+'" name="DOC_BASH'+counterdoc+'" value="'+file.base64+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
						cols +=	'<input type="hidden" id="DOC_ID'+counterdoc+'" name="DOC_ID'+counterdoc+'" value="'+file.doc_id+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
						cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';

						newRow.append(cols);

						$(".list_file").append(newRow);
					}
				});
				
				// DETAILS
				for (let index = 0; index < data['DETAIL'].length; index++) {
					var cust_name 	= (data['DETAIL'][index]['dtl_cust_name'] != null) ? data['DETAIL'][index]['dtl_cust_name'] : "";
					var cust_id		= (data['DETAIL'][index]['dtl_cust_id'] != null) ? data['DETAIL'][index]['dtl_cust_id'] : "";
					var bl_no 		= (data['DETAIL'][index]['dtl_del_bl'] != null) ? data['DETAIL'][index]['dtl_del_bl'] : "";
					var pkg_name 	= (data['DETAIL'][index]['dtl_pkg_name'] != null) ? data['DETAIL'][index]['dtl_pkg_name'] : "";
					var cmdty_name 	= (data['DETAIL'][index]['dtl_cmdty_name'] != null) ? data['DETAIL'][index]['dtl_cmdty_name'] : "N/A";
					var unit_name 	= (data['DETAIL'][index]['dtl_unit_name'] != null) ? data['DETAIL'][index]['dtl_unit_name'] : "N/A";
					var cont_size 	= (data['DETAIL'][index]['dtl_cont_size'] != null) ? data['DETAIL'][index]['dtl_cont_size'] : "N/A";
					var cont_type 	= (data['DETAIL'][index]['dtl_cont_type'] != null) ? data['DETAIL'][index]['dtl_cont_type'] : "N/A";
					var cont_status = (data['DETAIL'][index]['dtl_cont_status'] != null) ? data['DETAIL'][index]['dtl_cont_status'] : "N/A";
					var char_name 	= (data['DETAIL'][index]['dtl_character_name'] != null) ? data['DETAIL'][index]['dtl_character_name'] : "N/A";
					var qty 		= (data['DETAIL'][index]['dtl_qty'] != null) ? data['DETAIL'][index]['dtl_qty'] : "";
					var out 		= (data['DETAIL'][index]['dtl_out'] != null) ? data['DETAIL'][index]['dtl_out'] : "";
					var dtl_id 		= (data['DETAIL'][index]['dtl_del_id'] != null) ? data['DETAIL'][index]['dtl_del_id'] : "";
					var hdr_id 		= (data['DETAIL'][index]['hdr_del_id'] != null) ? data['DETAIL'][index]['hdr_del_id'] : "";					
					// var date_in 	= $.datepicker.formatDate('yyyy-mm-dd H:i', data['DETAIL'][index]['dtl_in']);

					var stack_type 		= (data['DETAIL'][index]['dtl_stacking_type_name'] != null) ? data['DETAIL'][index]['dtl_stacking_type_name'] : "";
					var stack_type_id	= (data['DETAIL'][index]['dtl_stacking_type_id'] != null) ? data['DETAIL'][index]['dtl_stacking_type_id'] : "";
					var stack_area 		= (data['DETAIL'][index]['dtl_stacking_area_name'] != null) ? data['DETAIL'][index]['dtl_stacking_area_name'] : "";
					var stack_area_id	= (data['DETAIL'][index]['dtl_stacking_area_id'] != null) ? data['DETAIL'][index]['dtl_stacking_area_id'] : "";

					$('#detail-list tbody').append(
						'<tr>' +
							'<td class="TBL_DTL_CUST_NAME">'+ cust_name +'</td>' +
							'<td style="display: none;" class="TBL_DTL_CUST_ID">'+ data['DETAIL'][index]['dtl_cust_id'] +'</td>' +
							'<td class="TBL_DTL_BL_NO">'+ bl_no +'</td>' +
							'<td class="TBL_DTL_PKG_ID" style="display: none;">'+ data['DETAIL'][index]['dtl_pkg_id'] +'</td>' +
							'<td class="TBL_DTL_PKG_NAME">'+ pkg_name +'</td>' +
							'<td class="TBL_DTL_CMDTY_ID" style="display: none;">'+ data['DETAIL'][index]['dtl_cmdty_id'] +'</td>' +
							'<td class="TBL_DTL_CMDTY_NAME">'+ cmdty_name +'</td>' +
							'<td class="TBL_DTL_UNIT_ID" style="display: none;">'+ data['DETAIL'][index]['dtl_unit_id'] +'</td>' +
							'<td class="TBL_DTL_UNIT_NAME">'+ unit_name +'</td>' +
							'<td class="TBL_DTL_CONT_SIZE">'+ cont_size +'</td>' +
							'<td class="TBL_DTL_CONT_TYPE">'+ cont_type +'</td>' +
							'<td class="TBL_DTL_CONT_STATUS">'+ cont_status +'</td>' +
							'<td class="TBL_DTL_CHAR_ID" style="display: none;">'+ data['DETAIL'][index]['dtl_character_id'] +'</td>' +
							'<td class="TBL_DTL_CHAR_NAME">'+ char_name +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STACKING_TYPE_ID">'+ stack_type_id +'</td>' +
							'<td class="TBL_DTL_STACKING_TYPE_NAME">'+ stack_type +'</td>' +
							'<td style="display: none;" class="TBL_DTL_STACKING_AREA_ID">'+ stack_area_id +'</td>' +
							'<td class="TBL_DTL_STACKING_AREA_NAME">'+ stack_area +'</td>' +
							'<td class="TBL_DTL_QTY"><input id="TBL_DTL_QTY" type="number" class="form-control" value="'+ qty +'"></td>' +
							'<td class="TBL_DTL_IN">'+ data['DETAIL'][index]['dtl_in'] +'</td>' +
							'<td class="TBL_DTL_OUT"><input id="TBL_DTL_OUT" name="dtl_out" type="text" class="form-control" id="datepickerDate" value="'+ out +'"></td>' +
							'<td style="display: none;" class="TBL_DTL_ID">'+ dtl_id +'</td>' +
							'<td style="display: none;" class="TBL_HDR_ID">'+ hdr_id +'</td>' +
							'<td>' +
								'<a class="btn btn-primary btn-delete-detail"><i class="fa fa-trash-o"></i></a>' +
							'</td>' +
						'</tr>'
					);	
				}

				$('#TBL_DTL_OUT').datetimepicker({
					format: 'Y-m-d H:i',
					timepicker:true,
					datepicker:true,
				});

				for (let index = 0; index < data['ALAT'].length; index++) {
					var pkg_name 	= (data['ALAT'][index]['package_name'] != null) ? data['ALAT'][index]['package_name'] : "N/A";
					$('#detail-rental tbody').append(
						'<tr>' +

							'<td class="TBL_EQ_ID" style="display: none;">'+ data['ALAT'][index]['eq_id'] +'</td>' +
							'<td class="TBL_EQ_GROUP_TARIFF_ID" style="display: none;">'+ data['ALAT'][index]['group_tariff_id'] +'</td>' +
							'<td class="TBL_EQ_GROUP_TARIFF_NAME">'+ data['ALAT'][index]['group_tariff_name'] +'</td>' +
							'<td class="TBL_EQ_TYPE_ID" style="display: none;">'+ data['ALAT'][index]['eq_type_id'] +'</td>' +
							'<td class="TBL_EQ_TYPE_NAME">'+ data['ALAT'][index]['eq_type_name'] +'</td>' +
							'<td class="TBL_EQ_UNIT_ID" style="display: none;">'+ data['ALAT'][index]['eq_unit_id'] +'</td>' +
							'<td class="TBL_EQ_UNIT_NAME">'+ data['ALAT'][index]['eq_unit_name'] +'</td>' +
							'<td class="TBL_EQ_QTY">'+ data['ALAT'][index]['eq_qty'] +'</td>' +
							'<td class="TBL_EQ_UNIT_QTY">'+ data['ALAT'][index]['unit_qty'] +'</td>' +
							'<td class="TBL_PACKAGE_ID" style="display: none;">'+ data['ALAT'][index]['package_id'] +'</td>' +
							'<td class="TBL_PACKAGE_NAME">'+ pkg_name +'</td>' +
							'<td>' +
								'<a class="btn btn-primary btn-delete-detail-rental"><i class="fa fa-trash-o"></i></a>' +
							'</td>' +
						'</tr>'
					);
				}
				$.unblockUI();
			}
		});


		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/request_extension/layanan_alat",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['comp_nota_id']+'">'+record[i]['comp_nota_name']+'</option>';
				}
				
				$('#EQ_GROUP_TARIFF').append(toAppend);
			}
		});


		// DETAIL
			$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
				$(this).closest("tr").remove();       
			});
		// END DETAIL

		// RENTAL

			$('#list-rental').click(function(){
				var EQ_TYPE_ID_RENT = $('#EQ_TYPE_ID_RENT').val();
				var EQ_UNIT_ID_RENT = $('#EQ_UNIT_ID_RENT').val();
				var EQ_QTY_RENT 	= $('#EQ_QTY_RENT').val();
				var PACKAGE_ID_RENT = $('#PACKAGE_ID_RENT').val();
				
				if (EQ_TYPE_ID_RENT == 'not-selected') {
					alert('Please choose Tipe Kegiatan !');
					$('#EQ_TYPE_ID_RENT').focus()
				} else if (EQ_UNIT_ID_RENT == 'not-selected') {
					alert('Please choose unit !');
					$('#EQ_UNIT_ID_RENT').focus()
				} else if (EQ_QTY_RENT == '') {
					alert('Please choose Quantity !');
					$('#EQ_QTY_RENT').focus()
				} else {
					add_rental();
				}
				
			});

			$("table#detail-rental").on("click", ".btn-delete-detail-rental", function (event) {
				counterRental--;
				$(this).closest("tr").remove();       
			});

		// END RENTAL

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
				var myarr = path.split(".");

				let str = myarr[myarr.length-1];
				var pathakhir = str.toUpperCase();
				console.log(pathakhir);

				$("#DOC_PATH"+counterdoc).val(path);
				$("#DOC_NAME"+counterdoc).attr("doc_name",path);
				$("#DOC_BASH"+counterdoc).val(byteArray);

				var code = "";
				for (var i = 0; i < file.length; i++) {
					code += file[i].toString(16);
				}

				if (pathakhir != 'PHP') {
					if(code){
						switch (code) {
							case '25504446':

								break;

							case "ffd8ffe0":
							case "ffd8ffe1":
							default:
								alert('File harus PDF');
								$('#DOC_NAME'+counterdoc).val('');
								$("#btn-show").prop('disabled', true);
						}
					}
				}else{
					alert('File harus PDF');
							$('#DOC_NAME'+counterdoc).val('');
							$("#btn-show").prop('disabled', true);
				}
			}
		}
	}

	function add_rental() {
		counterRental++;
		var EQ_GROUP_TARIFF_ID	= $('#EQ_GROUP_TARIFF').val();
		var EQ_TYPE_ID			= $('#EQ_TYPE_ID_RENT').val();
		var EQ_UNIT_ID			= $('#EQ_UNIT_ID_RENT').val();
		var EQ_QTY				= $('#EQ_QTY_RENT').val();
		var EQ_UNIT_QTY			= $('#EQ_UNIT_QTY').val();
		var PACKAGE_ID			= ($('#PACKAGE_ID_RENT').val() != "not-selected")? $('#PACKAGE_ID_RENT').val() : null;
		var PACKAGE_NAME 		= ($('#PACKAGE_ID_RENT').val() != "not-selected")? $('#PACKAGE_ID_RENT option:selected').text() : "N/A";
		
		$('#detail-rental').append(
		
			'<tr>' +
				'<td class="TBL_EQ_GROUP_TARIFF_ID" style="display:none;">'+ EQ_GROUP_TARIFF_ID +'</td>' +
				'<td class="TBL_EQ_GROUP_TARIFF_NAME">'+ $('#EQ_GROUP_TARIFF option:selected').text() +'</td>' +
				'<td class="TBL_EQ_TYPE_ID" style="display:none;">'+ EQ_TYPE_ID +'</td>' +
				'<td class="TBL_EQ_TYPE_NAME">'+ $('#EQ_TYPE_ID_RENT option:selected').text() +'</td>' +
				'<td class="TBL_EQ_UNIT_ID" style="display:none;">'+EQ_UNIT_ID +'</td>' +
				'<td class="TBL_EQ_UNIT_NAME">'+ $('#EQ_UNIT_ID_RENT option:selected').text() +'</td>' +
				'<td class="TBL_EQ_QTY">'+ EQ_QTY +'</td>' +
				'<td class="TBL_EQ_UNIT_QTY">'+ EQ_UNIT_QTY +'</td>' +
				'<td class="TBL_PACKAGE_ID" style="display:none;">'+ PACKAGE_ID +'</td>' +
				'<td class="TBL_PACKAGE_NAME">'+ PACKAGE_NAME +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail-rental"><i class="fa fa-trash-o"></i></a>' +
				'</td>' +
			'</tr>'
		);	
	}

	function save_extension() {
		var details = [];
		var alats = [];
		var files = [];
		var del_no = $('#DEL_NO').val();

		$('#detail-list tbody tr').each(function(){
			var cont_size 	= $(this).find('.TBL_DTL_CONT_SIZE').html(); 
			var cont_status	= $(this).find('.TBL_DTL_CONT_STATUS').html(); 
			var cont_type	= $(this).find('.TBL_DTL_CONT_TYPE').html()
			var stack_type	= $(this).find('.TBL_DTL_STACKING_TYPE_NAME').html(); 
			var stack_area	= $(this).find('.TBL_DTL_STACKING_AREA_NAME').html(); 

			cont_size = cont_size != "N/A" ? cont_size : null;
			cont_status = cont_status != "N/A" ? cont_status : null;
			cont_type = cont_type != "N/A" ? cont_type : null;
			stack_type = stack_type != "N/A" ? stack_type : null;
			stack_area = stack_area != "N/A" ? stack_area : null;

			var temp = {
				"DTL_DEL_BL": $(this).find('.TBL_DTL_BL_NO').html(),
				"DTL_PKG_ID": $(this).find('.TBL_DTL_PKG_ID').html(),
				"DTL_PKG_NAME": $(this).find('.TBL_DTL_PKG_NAME').html(),
				"DTL_CMDTY_ID": $(this).find('.TBL_DTL_CMDTY_ID').html(),
				"DTL_CMDTY_NAME": $(this).find('.TBL_DTL_CMDTY_NAME').html(),
				"DTL_UNIT_ID": $(this).find('.TBL_DTL_UNIT_ID').html(),
				"DTL_UNIT_NAME": $(this).find('.TBL_DTL_UNIT_NAME').html(),
				"DTL_CONT_SIZE": cont_size,
				"DTL_CONT_STATUS": cont_status,
				"DTL_CONT_TYPE": cont_type,
				"DTL_CHARACTER_ID": $(this).find('.TBL_DTL_CHAR_ID').html(),
				"DTL_CHARACTER_NAME": $(this).find('.TBL_DTL_CHAR_NAME').html(),
				"DTL_STACKING_TYPE_ID": $(this).find('.TBL_DTL_STACKING_TYPE_ID').html(),
				"DTL_STACKING_TYPE_NAME": stack_type,
				"DTL_STACKING_AREA_ID": $(this).find('.TBL_DTL_STACKING_AREA_ID').html(),
				"DTL_STACKING_AREA_NAME": stack_area,
				// "DTL_QTY": $(this).find('.TBL_DTL_QTY').html(),
				// "DTL_OUT": $(this).find('.TBL_DTL_OUT').html().substring(0, 10),
				"DTL_QTY": $(this).find('#TBL_DTL_QTY').val(),
				"DTL_IN": $(this).find('.TBL_DTL_IN').html(),
				"DTL_OUT": $(this).find('#TBL_DTL_OUT').val(),
				"DTL_CUST_ID": $(this).find('.TBL_DTL_CUST_ID').html(),
				"DTL_CUST_NAME": $(this).find('.TBL_DTL_CUST_NAME').html(),
				"DTL_DEL_ID": $(this).find('.TBL_DTL_ID').html(),
				"HDR_DEL_ID": $(this).find('.TBL_HDR_ID').html()	 	
			}
			details.push(temp);
		});

		$('#detail-rental tbody tr').each(function(){; 
			var alat_eq_id 			 = $(this).find('.TBL_EQ_ID').html(); 
			var eq_group_tariff_id 	 = $(this).find('.TBL_EQ_GROUP_TARIFF_ID').html(); 
			var eq_group_tariff_name = $(this).find('.TBL_EQ_GROUP_TARIFF_NAME').html(); 
			var eq_type_id 			 = $(this).find('.TBL_EQ_TYPE_ID').html(); 
			var eq_type_name 	     = $(this).find('.TBL_EQ_TYPE_NAME').html(); 
			var eq_qty 		 	     = $(this).find('.TBL_EQ_QTY').html();
			var eq_unit_qty 		 = $(this).find('.TBL_EQ_UNIT_QTY').html();
			var eq_unit_id 		     = $(this).find('.TBL_EQ_UNIT_ID').html();  
			var eq_unit_name 	= $(this).find('.TBL_EQ_UNIT_NAME').html();  
			var eq_pkg_id		= $(this).find('.TBL_PACKAGE_ID').html(); 
			var eq_pkg_name		= $(this).find('.TBL_PACKAGE_NAME').html(); 

			eq_pkg_id = eq_pkg_id != "null" ? eq_pkg_id : null;
			eq_pkg_name = eq_pkg_name != "N/A" ? eq_pkg_name : null;

			var temp = {
				"EQ_ID": alat_eq_id,
				"EQ_QTY": eq_qty,
				"EQ_TYPE_ID": eq_type_id,
				"EQ_TYPE_NAME": eq_type_name,
				"EQ_UNIT_ID": eq_unit_id,
				"EQ_UNIT_NAME": eq_unit_name,
				"GROUP_TARIFF_ID": eq_group_tariff_id,
				"GROUP_TARIFF_NAME": eq_group_tariff_name,
				"PACKAGE_ID": eq_pkg_id,
				"PACKAGE_NAME": eq_pkg_name,
				"REQ_NO": del_no,
				"UNIT_QTY": eq_unit_qty
			}
			alats.push(temp);
		});

		for (let index = 1; index <= counterdoc; index++) {
			var doc_no 		= $('#DOC_NO'+index).val();
			var doc_path 	= $('#DOC_PATH'+index).val();
			var doc_bash 	= $('#DOC_BASH'+index).val();
			var doc_id 		= $('#DOC_ID'+index).val();
			var doc_name 	= $('#DOC_NAME'+index).val();

			if (doc_no != '') {
				temp = {
					"DOC_ID"	: doc_id,
					"REQ_NO"	: del_no,
					"DOC_NO"	: doc_no,
					"DOC_NAME"	: doc_name,
					"PATH"		: doc_path,
					"BASE64"	: doc_bash
				}
				files.push(temp);
			}
		}

		arrData = {
			"action": "saveheaderdetail",
			"data": [
				"HEADER",
				"DETAIL",
				"SPLIT_NOTA",
				"ALAT",
				"FILE"
			],
			"HEADER": {
				"DB": "omcargo",
				"TABLE": "TX_HDR_DEL",
				"PK": "DEL_ID",
				"VALUE": [{
					"APP_ID" : 2,
					"DEL_ID": $('#DEL_ID').val(),
					"DEL_NO": $('#DEL_NO').val(),
					"DEL_STATUS": 1,
					"DEL_TERMINAL_CODE": $('#DEL_TERMINAL_CODE').val(),
					"DEL_TERMINAL_NAME": $('#DEL_TERMINAL_NAME').val(),
					"DEL_DATE": $('#DEL_DATE').val(),
					"DEL_TRADE_TYPE": $('#DEL_TRADE_TYPE').val(),
					"DEL_TRADE_NAME": $('#DEL_TRADE_NAME').val(),
					"DEL_SPLIT": $('#DEL_SPLIT').val(),
					"DEL_CUST_ID": "<?=$this->session->userdata('custid_phd')?>",
					"DEL_CUST_NAME": "<?=$this->session->userdata('customernamealt_phd')?>",
					"DEL_CUST_NPWP": "<?=$this->session->userdata('npwp_phd')?>",
					"DEL_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
					"DEL_PIB_PEB_NO": $('#DEL_PIB_PEB_NO').val(),
					"DEL_PIB_PEB_DATE": $('#DEL_PIB_PEB_DATE').val(),
					"DEL_NPE_SPPB_NO": $('#DEL_NPE_SPPB_NO').val(),
					"DEL_VESSEL_CODE": $('#DEL_VESSEL_CODE').val(),
					"DEL_VESSEL_NAME": $('#DEL_VESSEL_NAME').val(),
					"DEL_VVD_ID": $('#DEL_VVD_ID').val(),
					"DEL_KADE": $('#DEL_KADE').val(),
					"DEL_VOYIN": $('#DEL_VOYIN').val(),
					"DEL_VOYOUT": $('#DEL_VOYOUT').val(),
					"DEL_ETA": $('#DEL_ETA').val(),
					"DEL_ETD": $('#DEL_ETD').val(),
					"DEL_ETB": $('#DEL_ETB').val(),
					"DEL_ATA": $('#DEL_ATA').val(),
					"DEL_ATD": $('#DEL_ATD').val(),
					"DEL_CREATE_BY" : $('#DEL_CREATE_BY').val(),
					// "DEL_CREATE_DATE" : $('#DEL_CREATE_DATE').val(),
					"DEL_EXT_FROM" : $('#DEL_EXT_FROM').val(),
					"DEL_EXT_LOOP" : parseInt($('#DEL_EXT_LOOP').val())+1,
					"DEL_EXT_STATUS" : "Y",
					"DEL_EXT_FROM_DATE" : $('#DEL_EXT_FROM_DATE').val(),
					"DEL_BRANCH_CODE" : $('#DEL_BRANCH_CODE').val(),
					"DEL_BRANCH_ID" : $('#DEL_BRANCH_ID').val(),
					// "DEL_MARK" : $('#DEL_MARK').val(),
					"DEL_OPEN_STACK" : $('#DEL_OPEN_STACK').val(),
					// "DEL_CLOSING_TIME" : $('#DEL_CLOSING_TIME').val(),
					"DEL_UKK" : $('#DEL_UKK').val()
				}]
			},
			"SPLIT_NOTA": {
				"DB": "omcargo",
				"TABLE": "TX_SPLIT_NOTA",
				"FK": [
				"REQ_NO",
				"del_no"
				],
				"VALUE": []
			},
			"ALAT": {
				"DB": "omcargo",
				"TABLE": "TX_EQUIPMENT",
				"FK": [
				"REQ_NO",
				"del_no"
				],
				"VALUE": (alats.length > 0) ? alats : []
			},
			"DETAIL": {
				"DB": "omcargo",
				"TABLE": "TX_DTL_DEL",
				"FK": [
				"HDR_DEL_ID",
				"del_id"
				],
				"VALUE": (details.length > 0) ? details : []
			},
			"FILE": {
				"DB": "omcargo",
				"TABLE": "TX_DOCUMENT",
				"FK": [
				"REQ_NO",
				"del_no"
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
			url: "<?=ROOT?>npkbilling/request_extension/save_extension",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var response = JSON.parse(data.data);
					var no_req = response.header.del_no;

					var notification = new NotificationFx({
						message : '<p>Data '+no_req+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' 
					});
					extension_log(no_req);

					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_extension"; }, 3000);	
				} else {
					$.unblockUI();
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();

			}
		});	
	}

	function extension_log(no_req) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/extension_update_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 			: no_req,
			},
			success: function( data ) {
				console.log(data);

			}
		});
	}

	function goBack() {
		window.history.back();
	}

</script>

