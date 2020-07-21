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
					<label>Terminal</label>
						<select id="BM_TERMINAL_CODE" name="BM_TERMINAL_CODE" class="form-control">
							<option value="not-selected"> -- Please Choose Terminal  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Nomor Request</label>
						<input name="BM_NO" id="BM_NO" type="text" class="form-control" placeholder="Auto Generate" readonly>
						<input name="BM_ID" id="BM_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly>

					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Request</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_DATE" name="BM_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" readOnly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>PBM</label>
						<select id="BM_PBM_ID" name="BM_PBM_ID" class="form-control">
							<option value="not-selected"> -- Please Choose PBM -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<select id="BM_TRADE_TYPE" name="BM_TRADE_TYPE" class="form-control">
							<option value="not-selected"> -- Please Choose Tipe Perdagangan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Shipping Agent</label>
						<select id="BM_SHIPPING_AGENT_ID" name="BM_SHIPPING_AGENT_ID" class="form-control">
							<option value="not-selected"> -- Please Choose Shipping Agent -- </option>
						</select>
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
						<input type="text" id="BM_PIB_PEB_NO" name="BM_PIB_PEB_NO" class="form-control" required>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
                      	<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_PIB_PEB_DATE" name="BM_PIB_PEB_DATE" type="text" class="form-control" id="datepickerDate">
							<div class="input-group-btn">
								<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true" onclick="search_no_peb()"></span>
								</button>
							</div>
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">No NPE/SPPB</label>
						<input id="BM_NPE_SPPB_NO" name="BM_NPE_SPPB_NO" type="text" class="form-control" id="exampleTooltip">
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
						<input type="text" id="BM_VESSEL_NAME" class="form-control" name="BM_VESSEL_NAME" placeholder="Autocomplete" title="Masukkan data kapal" required>
						<input type="hidden" id="BM_VESSEL_CODE" class="form-control" name="BM_VESSEL_CODE" required>
						<input type="hidden" id="BM_VESSEL" class="form-control" name="BM_VESSEL" required>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Kade</label>
						<input type="text" class="form-control" id="BM_KADE" name="BM_KADE" placeholder="Kade" title="Masukkan data kade" size="8" readonly>
						<input type="hidden" class="form-control" id="BM_VVD_ID" name="BM_VVD_ID" placeholder="Kade" title="Masukkan data kade" size="8" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Voyage In</label>
						<input type="text" class="form-control" id="BM_VOYIN" name="BM_VOYIN" placeholder="Voyage In" title="Masukkan data kapal" size="8" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Voyage Out</label>
						<input type="text" class="form-control" id="BM_VOYOUT" name="BM_VOYOUT" placeholder="Voyage Out" title="Masukkan data kapal" size="8" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETA</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input type="text" class="form-control" id="BM_ETA" name="BM_ETA" placeholder="ETA" title="Masukkan data kapal" size="8" readonly>
						</div>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETD</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input type="text" class="form-control" id="BM_ETD" name="BM_ETD" placeholder="ETD" title="Masukkan data kapal" size="8" readonly>
						</div>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETB</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input type="text" class="form-control" id="BM_ETB" name="BM_ETB" placeholder="ETB" title="Masukkan data ETB" size="8" readonly>
						</div> 
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">ATA</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_ATA" name="BM_ATA" type="text" class="form-control" id="datepickerDate" placeholder="ATA" readonly>
						</div>
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">ATD</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_ATD" name="BM_ATD" type="text" class="form-control" id="datepickerDate" placeholder="ATD" readonly>
						</div>
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">Open Stack</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_OPEN_STACK" name="BM_OPEN_STACK" type="text" class="form-control" placeholder="Open Stack" readonly>
						</div>
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">UKK</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_UKK" name="BM_UKK" type="text" class="form-control placeholder="UKK" readonly>
						</div>
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
					<div class="form-group col-xs-4 cargo-owner">
						<label>Cargo Owner</label>
							<input id="CARGO_OWNER" name="CARGO_OWNER" type="text" class="form-control" value="<?=$this->session->userdata('customername_phd')?>">
							<input id="CARGO_OWNER_ID" name="CARGO_OWNER_ID" type="hidden" value="<?=$this->session->userdata('customerid_phd')?>" class="form-control">			
					</div>
					<div class="form-group col-xs-4 npwp">
						<label>NPWP</label>
							<input id="NPWP" name="NPWP" type="text" class="form-control" value="<?=$this->session->userdata('npwp_phd')?>" readOnly>
					</div>
					<div class="form-group col-xs-4 alamat">
						<label>Alamat</label>
						<input id="ALAMAT" name="ALAMAT" type="text" class="form-control" value="<?=$this->session->userdata('address_phd')?>" readOnly>			
					</div>
					<div class="form-group col-xs-12">
						<label>Tipe Kegiatan</label>
						<select id="DTL_BM_TYPE_ID" name="DTL_BM_TYPE_ID" class="form-control">
							<option value="not-selected"> -- Please Choose Tipe Kegiatan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Nomor BL/SI/DO</label>
						<input id="DTL_BM_BL" name="DTL_BM_BL" type="text" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label>Truck Losing</label>
						<select id="DTL_BM_TL" name="DTL_BM_TL" class="form-control">
							<option value="not-selected"> -- Please Choose Truck Losing  -- </option>
							<option value="Y">Yes</option>
							<option value="N">No</option>
						</select>
					</div>
					<div class="form-group col-xs-4 kemasan">
						<label>Kemasan</label>
						<select id="DTL_PKG_ID" name="DTL_PKG_ID" class="form-control">
							<option pkgid="" value="not-selected"> -- Please Choose Kemasan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4 hidden_content">
						<label>Kemasan Tamp</label>
						<input type="text" name="DTL_PKG_TMP" id="DTL_PKG_TMP" class="form-control">
					</div>
					<div class="form-group col-xs-4 barang">
						<label>Barang</label>
						<select id="DTL_CMDTY_ID" name="DTL_CMDTY_ID" class="form-control">
							<option value="not-selected"> -- Please Choose Barang  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4 barang">
						<label>Satuan</label>
						<select id="DTL_UNIT_ID" name="DTL_UNIT_ID" class="form-control">
							<option value="not-selected"> -- Please Choose Satuan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4 cont hidden_content">
						<label>Size</label>
						<select id="DTL_CONT_SIZE" name="DTL_CONT_SIZE" class="form-control">
							<option pkgid="" value="not-selected"> -- Please Choose Size  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4 cont hidden_content">
						<label>Type</label>
						<select id="DTL_CONT_TYPE" name="DTL_CONT_TYPE" class="form-control">
							<option value="not-selected"> -- Please Choose Type  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-4 cont hidden_content">
						<label>Status</label>
						<select id="DTL_CONT_STATUS" name="DTL_CONT_STATUS" class="form-control">
							<option value="not-selected"> -- Please Choose Status  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-12">
						<label>Sifat</label>
						<select id="DTL_CHARACTER_ID" name="DTL_CHARACTER_ID" class="form-control">
							<option value="not-selected"> -- Please Choose Sifat  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Quantity</label>
						<input id="DTL_QTY" name="DTL_QTY" type="number" min="1" class="form-control">
					</div>
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-danger" type="button" id="list-detail" onclick="save_detail()">
							<span class="glyphicon glyphicon-plus">Add</span>
						</button>
					</div>

					<table class="table table-striped table-hover" id="detail-list">
						<thead>
							<tr>
								<th style="display: none;">DTL ID</th>
								<th style="display: none;">HDR ID</th>
								<th>Cargo Owner</th>
								<th style="display: none;">Cargo Owner ID</th>
								<th style="display: none;">Tipe Kegiatan</th>
								<th>Tipe Kegiatan</th>
								<th>Nomor BL/SI/DO</th>
								<th style="display: none;">Truck Losing</th>
								<th>Truck Losing</th>
								<th style="display: none;">Kemasan</th>
								<th>Kemasan</th>
								<th style="display: none;">Barang</th>
								<th>Barang</th>
								<th style="display: none;">Satuan</th>
								<th>Satuan</th>
								<th style="display: none;">Size</th>
								<th>Size</th>
								<th style="display: none;">Size</th>
								<th>Type</th>
								<th style="display: none;">Type</th>
								<th>Status</th>
								<th style="display: none;">Status</th>
								<th>Sifat</th>
								<th style="display: none;">Sifat</th>
								<th>Quantity</th>
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
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Alat</b></h2>
				</header>
				<input type="hidden" class="form-control" id="EQ_RENT_ID" name="EQ_RENT_ID" readonly>
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
						</select>
						<input type="hidden" class="form-control" id="EQ_TYPE_NAME_RENT" name="EQ_TYPE_NAME_RENT" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Jumlah Alat</label>
						<input id="EQ_QTY_RENT" name="EQ_QTY_RENT" type="number" min="1" class="form-control">
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Satuan</label>
						<select id="EQ_UNIT_ID_RENT" name="EQ_UNIT_ID_RENT" class="form-control">
							<option value="not-selected"> -- Please Choose  Satuan  -- </option>
						</select>
						<input type="hidden" class="form-control" id="EQ_UNIT_NAME_RENT" name="EQ_UNIT_NAME_RENT" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Jumlah/Durasi Pemakaian</label>
						<input id="EQ_DURASI_RENT" name="EQ_DURASI_RENT" type="number" min="1" class="form-control">
					</div>
					<div class="form-group col-xs-12">
						<label>Kemasan</label>
						<select id="PACKAGE_ID_RENT" name="PACKAGE_ID_RENT" class="form-control">
							<option value="not-selected"> -- Please Choose Kemasan  -- </option>
						</select>
						<input type="hidden" class="form-control" id="PACKAGE_NAME_RENT" name="PACKAGE_NAME_RENT" readonly>
					</div>
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-danger" type="button" id="list-rental" onclick="save_rental()">
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

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">		
					<div class="form-group example-twitter-oss pull-right">
						<button id="submit_header" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
						<button id="submit_header" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>			
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
<!-- /.modal -->

<script>
	
	var counterdoc = 0;
	counterdetail = 0;
	counterrent = 0;
	counterretri = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {
		$.blockUI();
		$('#BM_PIB_PEB_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});
		
		$('#BM_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		$('#date_out').datepicker({
			format: 'dd-mm-yyyy'
		});

		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		$("table#detail-rental").on("click", ".btn-delete-detail-rental", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		$("table#detail-retribution").on("click", ".btn-delete-detail-retribution", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		// --------------- //
		//counterdoc = 1;
		$("#add_file").on("click", function () {
			counterdoc++;
		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#BM_NO').val();

		    cols += '';
		    cols += '<div class="col-xs-6"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';
		   	cols += '<div class="col-xs-5"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" id="DOC_NAME'+counterdoc+'" doc_name="" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc('+counterdoc+')"></div>';
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

		$('#BM_TRADE_TYPE').on('change', function(){
			var trade_type = $(this).val();
			if (trade_type == 'I'){
				$('#international_content').removeClass('hidden_content');
			} else {
				$('#international_content').addClass('hidden_content');
			}
		});

		if($('#BM_TRADE_TYPE').val() == 'I'){
			$('#international_content').removeClass('hidden_content');
		} else {
			$('#international_content').addClass('hidden_content');
		}

	  	$("#btn-show").click(function(){
	    	$('#show-detail').removeClass('hidden_content');
	  	});

		// validasi header
		$("#btn-show").prop('disabled', true);
		$('#DOC_NAME1').change(function(){
			var BM_TERMINAL_CODE		= $('#BM_TERMINAL_CODE').val();
			var BM_DATE					= $('#BM_DATE').val();
			var BM_PBM_ID				= $('#BM_PBM_ID').val();
			var BM_SHIPPING_AGENT_ID	= $('#BM_SHIPPING_AGENT_ID').val();
			var BM_TRADE_TYPE			= $('#BM_TRADE_TYPE').val();
			var BM_PIB_PEB_NO			= $('#BM_PIB_PEB_NO').val();
			var BM_PIB_PEB_DATE			= $('#BM_PIB_PEB_DATE').val();

			if (BM_TERMINAL_CODE == 'not-selected') {
				$('#BM_TERMINAL_CODE').focus()
			} else if (BM_DATE == '') {
				$('#BM_DATE').focus()
			} else if (BM_PBM_ID == '') {
				$('#BM_PBM_ID').focus()
			} else if (BM_SHIPPING_AGENT_ID == '') {
				$('#BM_SHIPPING_AGENT_ID').focus()
			}else if (BM_TRADE_TYPE == '') {
				$('#BM_TRADE_TYPE').focus()
			} else{
				$("#btn-show").prop('disabled', false);
			}

		});

		//validasi detail
		// $("#list-detail").prop('disabled', true);
		$('#DTL_QTY').click(function(){
			var DTL_BM_TYPE_ID		= $('#DTL_BM_TYPE_ID').val();
			var DTL_BM_BL			= $('#DTL_BM_BL').val();
			var DTL_BM_TL			= $('#DTL_BM_TL').val();
			var DTL_PKG_ID			= $('#DTL_CMDTY_ID').find('option:selected').attr('pgkid');
			var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID').val();
			var DTL_UNIT_ID			= $('#DTL_UNIT_ID').val();
			var DTL_CHARACTER_ID	= $('#DTL_CHARACTER_ID').val();
			var DTL_QTY				= $('#DTL_QTY').val();
			
			
			if (DTL_BM_TYPE_ID == 'not-selected') {
				$('#DTL_BM_TYPE_ID').focus()
			} else if (DTL_BM_BL == '') {
				$('#DTL_BM_BL').focus()
			}else if (DTL_BM_TL == 'not-selected') {
				$('#DTL_BM_TL').focus()
			}else if (DTL_PKG_ID == 'not-selected') {
				$('#DTL_PKG_ID').focus()
			}else if (DTL_CMDTY_ID == 'not-selected') {
				$('#DTL_CMDTY_ID').focus()
			}else if (DTL_UNIT_ID == 'not-selected') {
				$('#DTL_UNIT_ID').focus()
			}else if (DTL_CHARACTER_ID == 'not-selected') {
				$('#DTL_CHARACTER_ID').focus()
			}
			
			$('#DTL_QTY').keyup(function(){
				if ($('#DTL_QTY').val() != ''){
					$("#list-detail").prop('disabled', false);
				}else{
					$("#list-detail").prop('disabled', true);
				}
			});

		});

		//validasi rental
		// $("#list-rental").prop('disabled', true);
		$('#EQ_QTY_RENT').change(function(){
			var EQ_TYPE_ID_RENT = $('#EQ_TYPE_ID_RENT').val();
			var EQ_UNIT_ID_RENT = $('#EQ_UNIT_ID_RENT').val();
			var EQ_QTY_RENT 	= $('#EQ_QTY_RENT').val();
			var PACKAGE_ID_RENT = $('#PACKAGE_ID_RENT').val();
			
			if (EQ_TYPE_ID_RENT == 'not-selected') {
				$('#EQ_TYPE_ID_RENT').focus()
			} else if (EQ_UNIT_ID_RENT == 'not-selected') {
				$('#EQ_UNIT_ID_RENT').focus()
			}else if (EQ_QTY_RENT == '') {
				$('#EQ_QTY_RENT').focus()
			}
			
		});

		//terminal
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/terminal",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
					for(var i=0;i<record.length;i++){
						toAppend += '<option value="'+record[i]['terminal_code']+'">'+record[i]['terminal_name']+'</option>';
					}
				
				var isSet = $('#BM_TERMINAL_CODE').append(toAppend);
				if(isSet){
					$('#BM_TERMINAL_CODE').val('T01');
				}
			}
		});

		//pbm
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/pbm",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['customer_id']+'">'+record[i]['name']+'</option>';
				}
				
				$('#BM_PBM_ID').append(toAppend);
			}
		});

		//tipe perdagangan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/tipeperdagangan",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#BM_TRADE_TYPE').append(toAppend);
			}
		});

		//shipping agen
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/shippingagen",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['customer_id']+'">'+record[i]['name']+'</option>';
				}
				
				$('#BM_SHIPPING_AGENT_ID').append(toAppend);
			}
		});

		//tipe kegiatan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/tipekegiatan",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DTL_BM_TYPE_ID').append(toAppend);
			}
		});

		//kemasan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/kemasan",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['package_id']+'">'+record[i]['package_name']+'</option>';
				}
				
				$('#DTL_PKG_ID').append(toAppend);
				$('#PACKAGE_ID_RENT').append(toAppend);
				$('#PACKAGE_ID_RETRI').append(toAppend);
			}
		});

		//satuan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/satuan",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['unit_id']+'">'+record[i]['unit_name']+'</option>';
				}
				
				$('#DTL_UNIT_ID').append(toAppend);
			}
		});

		//sifat barang
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/sifat_barang",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['character_id']+'">'+record[i]['character_name']+'</option>';
				}
				
				$('#DTL_CHARACTER_ID').append(toAppend);
			}
		});

		//alat
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/alat",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['equipment_type_id']+'">'+record[i]['equipment_type_name']+'</option>';
				}
				
				$('#EQ_TYPE_ID_RETRI').append(toAppend);
				$('#EQ_TYPE_ID_RENT').append(toAppend);
			}
		});

		//unit alat
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/unit_alat",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj;
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['unit_id']+'">'+record[i]['unit_name']+'</option>';
				}
				
				$('#EQ_UNIT_ID_RENT').append(toAppend);
				$('#EQ_UNIT_ID_RETRI').append(toAppend);
			}
		});

		//container size
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/size",
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

		//container type
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/type",
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

		//container status
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/status",
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

		//Layanan alat
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/layanan_alat",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['group_tariff_id']+'">'+record[i]['comp_nota_name']+'</option>';
				}
				
				$('#EQ_GROUP_TARIFF').append(toAppend);
			}
		});

		//kemacan changeed
		$('#DTL_PKG_ID').on('change', function() {
			var val = this.value;
			if(val != 8){
				$.ajax({
					type: "GET",
					url: "<?=ROOT?>npkbilling/mdm/barang/"+ val,
					success: function(data){
						if(!data){
							return false;
						}
						var obj = JSON.parse(data);
						var record = obj['result'];
						var toAppend = '';
						for(var i=0;i<record.length;i++){
							toAppend += '<option pgkid="'+record[i]['package_id']+'" value="'+record[i]['commodity_id']+'">'+record[i]['commodity_name']+'</option>';
						}
						$('#DTL_CMDTY_ID').find('option').remove().end().append('<option value="not-selected"> -- Please Choose Barang  -- </option>');
						$('#DTL_CMDTY_ID').append(toAppend);
					}
				});

				$('.kemasan').removeClass('col-xs-12'); 
				$('.kemasan').addClass('col-xs-4'); 

				$('.barang').removeClass('hidden_content'); 
				//container
				$('.cont').addClass('hidden_content');
				$('#DTL_CONT_SIZE').val("not-selected");
				$('#DTL_CONT_TYPE').val("not-selected");
				$('#DTL_CONT_STATUS').val("not-selected");

			}
			else{
				$('.kemasan').removeClass('col-xs-4'); 
				$('.kemasan').addClass('col-xs-12'); 
				//barang
				$('.barang').addClass('hidden_content'); 
				$('#DTL_CMDTY_ID').val("not-selected");
				$('#DTL_UNIT_ID').val("not-selected");
				//container
				$('.cont').removeClass('hidden_content');
			}
		}).change();

		$('#BM_VESSEL_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npkbilling/mdm/vessel/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#BM_VESSEL_NAME').val(ui.item.label);
				$('#BM_VESSEL_CODE').val(ui.item.vesselCode);
				$('#BM_KADE').val(ui.item.idKade);
				$('#BM_VOYIN').val(ui.item.voyageIn);
				$('#BM_VOYOUT').val(ui.item.voyageOut);
				$('#BM_ETA').val(ui.item.eta);
				$('#BM_ETD').val(ui.item.etd);
				$('#BM_ETB').val(ui.item.etb);
				$('#BM_ATD').val(ui.item.atd);
				$('#BM_ATA').val(ui.item.ata); 
				$('#BM_VVD_ID').val(ui.item.idVsbVoyage);
				$('#BM_OPEN_STACK').val(ui.item.openStack);
				$('#BM_UKK').val(ui.item.idUkkSimop);
				$('#BM_VESSEL').val(ui.item.name);
				
				return false;
			}
		});

		$('#CARGO_OWNER').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npkbilling/mdm/customer/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#CARGO_OWNER').val(ui.item.label);
				$('#CARGO_OWNER_ID').val(ui.item.customer_id);
				$('#NPWP').val(ui.item.npwp);
				$('#ALAMAT').val(ui.item.address);
				return false;
			}
		});

		$('#DTL_PKG_ID').on('change', function() {
			var DTL_PKG_ID = $(this).val();
			$('#DTL_PKG_TMP').val(DTL_PKG_ID);
		});

		$('#DTL_CMDTY_ID').on('change', function() {
			var DTL_CMDTY_ID = $(this).val();
			var parent_id =  $(this).find('option:selected').attr('pgkid');
			$('#DTL_PKG_TMP').val(parent_id);
		});

		//getdata
		$.ajax({
			url: "<?=ROOT?>npkbilling/request_bm/update_bm/<?=$id?>",
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				$.unblockUI();
				if(data.HEADER != ""){
					arrData = data;
					console.log(arrData);
					arrData.HEADER.forEach(function(item, index){
						$("#BM_ID").val(item.bm_id);
						$("#BM_NO").val(item.bm_no);
						$("#BM_STATUS").val(1);
						$("#BM_BRANCH_ID").val(12);
						$("#BM_CREATE_BY").val();
						$("#BM_TERMINAL_CODE").val(item.bm_terminal_code);
						$("#BM_DATE").val(item.bm_date);
						$("#BM_PBM_ID").val(item.bm_pbm_id);
						$("#BM_TRADE_TYPE").val(item.bm_trade_type);
						$("#BM_SHIPPING_AGENT_ID").val(item.bm_shipping_agent_id);
						$("#BM_CUST_ID").val(item.bm_cust_id);
						$("#BM_CUST_NPWP").val(item.bm_cust_npwp);
						$("#BM_CUST_ADDRESS").val(item.bm_cust_address);
						$("#BM_PIB_PEB_NO").val(item.bm_pib_peb_no);
						$("#BM_PIB_PEB_DATE").val(item.bm_pib_peb_date); 
						$("#BM_NPE_SPPB_NO").val(item.bm_npe_sppb_no); 
						$("#BM_VESSEL_CODE").val(item.bm_vessel_code);
						$("#BM_VESSEL_NAME").val(item.bm_vessel_name);
						$("#BM_VESSEL").val(item.bm_vessel_name);    
						$("#BM_VVD_ID").val(item.bm_vvd_id); 
						$("#BM_KADE").val(item.bm_kade);
						$("#BM_VOYIN").val(item.bm_voyin); 
						$("#BM_VOYOUT").val(item.bm_voyout); 
						$("#BM_ETA").val(item.bm_eta); 
						$("#BM_ETD").val(item.bm_etd); 
						$("#BM_ETB").val(item.bm_etb); 
						$("#BM_ATA").val(item.bm_ata); 
						$("#BM_ATD").val(item.bm_atd); 
						$("#BM_OPEN_STACK").val(item.bm_open_stack); 
						$("#BM_UKK").val(item.bm_ukk); 
					});

					$('#show-detail').removeClass('hidden_content');

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].hdr_bm_id);
					arrData.DETAIL.forEach(function(detail, index){
						var comodity_name = (detail.dtl_cmdty_name)? detail.dtl_cmdty_name : "";
						var comodity_id = (detail.dtl_cmdty_id)? detail.dtl_cmdty_id : "";
						var unit_id = (detail.dtl_unit_id)? detail.dtl_unit_id : "";
						var unit_name = (detail.dtl_unit_name)? detail.dtl_unit_name :  "";
						var size = (detail.dtl_cont_size)? detail.dtl_cont_size : "";
						var size_name = (detail.dtl_cont_size)? detail.dtl_cont_size : "";
						var type = (detail.dtl_cont_type)? detail.dtl_cont_type : "";
						var type_name = (detail.dtl_cont_type)? detail.dtl_cont_type : "";
						var status = (detail.dtl_cont_status)? detail.dtl_cont_status : "";
						var status_name  = (detail.dtl_cont_status)? detail.dtl_cont_status : "";
						var cust_name = (detail.dtl_cust_id)? detail.dtl_cust_name : "";
						var cust_id = (detail.dtl_cust_id)? detail.dtl_cust_id : "";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td class="tbl_dtl_bm_owner">'+ cust_name +'</td>' +
								'<td style="display: none;" class="tbl_dtl_bm_owner_id">'+ cust_id +'</td>' +

								'<td style="display: none;" class="tbl_dtl_bm_id">'+ detail.dtl_bm_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_bm_hdr_id">'+ detail.hdr_bm_id +'</td>' +

								'<td style="display: none;" class="tbl_dtl_bm_type_id">'+ detail.dtl_bm_type_id +'</td>' +
								'<td class="tbl_dtl_bm_type_name">'+ detail.dtl_bm_type +'</td>' +
								
								'<td class="tbl_dtl_bm_bl">'+ detail.dtl_bm_bl +'</td>' +
								
								'<td style="display: none;" class="tbl_dtl_bm_tl">'+ detail.dtl_bm_tl +'</td>' +
								'<td class="tbl_dtl_bm_tl_name">'+ detail.dtl_bm_tl +'</td>' +
								
								'<td style="display: none;" class="tbl_dtl_pkg_id">'+ detail.dtl_pkg_id +'</td>' +
								'<td class="tbl_dtl_pkg_name">'+ detail.dtl_pkg_name +'</td>' +
								
								'<td style="display: none;" class="tbl_dtl_cmdty_id">'+ comodity_id +'</td>' +
								'<td class="tbl_dtl_cmdty_name">'+  comodity_name +'</td>' +
								
								'<td style="display: none;" class="tbl_dtl_unit_id">'+ unit_id +'</td>' +
								'<td class="tbl_dtl_unit_name">'+ unit_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_size_id">'+ size +'</td>' +
								'<td class="tbl_dtl_size_name">'+ size_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_type_id">'+ type +'</td>' +
								'<td class="tbl_dtl_type_name">'+ type_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_status_id">'+ status +'</td>' +
								'<td class="tbl_dtl_status_name">'+ status_name +'</td>' +


								'<td style="display: none;" class="tbl_dtl_character_id">'+ detail.dtl_character_id +'</td>' +
								'<td class="tbl_dtl_character_name">'+ detail.dtl_character_name +'</td>' +
								
								'<td class="tbl_dtl_qty">'+ detail.dtl_qty +'</td>' +
								
								'<td>' +
									'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
								'</td>' +
							'</tr>'
						);
					});

					arrData.ALAT.forEach(function(alat, index){
							var kemasan = (alat.package_id != null)? alat.package_name : "";
							var kemasan_id = (alat.package_id != null)? alat.package_id : "";
							$('#detail-rental').append(
								'<tr>' +
									'<td style="display:none;" class="tbl_eq_id">'+ alat.eq_id +'</td>' +
									'<td style="display:none;" class="tbl_group_tariff_id">'+ alat.group_tariff_id +'</td>' +
									'<td class="tbl_group_tariff">'+ alat.group_tariff_name +'</td>' +
									'<td style="display:none;" class="tbl_eq_type_id">'+ alat.eq_type_id +'</td>' +
									'<td class="tbl_eq_type_name">'+ alat.eq_type_name +'</td>' +
									'<td class="tbl_eq_qty">'+ alat.eq_qty +'</td>' +
									'<td style="display:none;" class="tbl_eq_unit_id">'+ alat.eq_unit_id +'</td>' +
									'<td class="tbl_eq_unit_name">'+ alat.eq_unit_name +'</td>' +
									'<td class="tbl_eq_duration">'+ alat.unit_qty +'</td>' +
									'<td style="display:none;" class="tbl_package_id">'+ kemasan_id +'</td>' +
									'<td class="tbl_package_name">'+ kemasan +'</td>' +
									'<td>' +
										'<a class="btn btn-primary btn-delete-detail-rental"><span class="glyphicon glyphicon-trash"></span></a>' +
									'</td>' +
								'</tr>'
							);
					});

					arrData.FILE.forEach(function(file, index){
						if (arrData.FILE.length != 0) {
							counterdoc++;
							var newRow = $("<tr>");
							var cols = "";

							cols += '';
							cols += '<div class="col-xs-6"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" value="'+file.doc_no+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';

							cols += '<div class="col-xs-5"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" value="'+file.doc_name+'" id="DOC_NAME'+counterdoc+'" doc_name="'+file.doc_name+'" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc('+counterdoc+')"><a href="'+apiUrl+file.doc_path+'" target="_blank">'+file.doc_name+'</a></div>';
							cols +=	'<input type="hidden" id="DOC_PATH'+counterdoc+'" name="DOC_PATH'+counterdoc+'" value="'+file.doc_path+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
							cols +=	'<input type="hidden" id="DOC_BASH'+counterdoc+'" name="DOC_BASH'+counterdoc+'" value="'+file.base64+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
							cols +=	'<input type="hidden" id="DOC_ID'+counterdoc+'" name="DOC_ID'+counterdoc+'" value="'+file.doc_id+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';
							cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';
								
							newRow.append(cols);

							$(".list_file").append(newRow);
						}
					});

				}
			}
		});

	});

	//list detail
	function save_detail() {
		counterdetail++;
		var HDR_ID				= $('#BM_ID');
		var DTL_ID				= $('#DTL_ID');
		var DTL_BM_TYPE_ID		= $('#DTL_BM_TYPE_ID');
		var DTL_BM_BL			= $('#DTL_BM_BL');
		var DTL_BM_TL			= $('#DTL_BM_TL');
		var DTL_PKG_ID			= $('#DTL_PKG_TMP');
		var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID');
		var DTL_UNIT_ID			= $('#DTL_UNIT_ID');
		var DTL_CHARACTER_ID	= $('#DTL_CHARACTER_ID');
		var DTL_QTY				= $('#DTL_QTY');
		var DTL_CONT_SIZE		= $('#DTL_CONT_SIZE');
		var DTL_CONT_TYPE		= $('#DTL_CONT_TYPE');
		var DTL_CONT_STATUS		= $('#DTL_CONT_STATUS');
		var CARGO_OWNER_ID		= $('#CARGO_OWNER_ID');
		var CARGO_OWNER			= $('#CARGO_OWNER');

		if(CARGO_OWNER_ID.val() == ""){
			alert('Please choose cargo owner !');
			$('#CARGO_OWNER').focus();
			return false;
		}
		else if (DTL_BM_TYPE_ID.val() == "not-selected") {
			alert('Please choose Tipe Kegiatan !');
			$('#DTL_BM_TYPE_ID').focus();
			return false;
		}else if(DTL_BM_BL.val() == "") {
			alert('Please choose BL !');
			$('#DTL_BM_BL').focus();
			return false;
		}else if(DTL_BM_TL.val() == "not-selected") {
			alert('Please choose Truck Losing !');
			$('#DTL_BM_TL').focus();
			return false;
		}else if(!DTL_PKG_ID) {
			alert('Please choose Kemasan !');
			$('#DTL_PKG_ID').focus();
			return false;
		}else if(DTL_CHARACTER_ID.val() == "not-selected") {
			alert('Please choose Sifat !');
		}else if(DTL_QTY.val()== "") {
			alert('Please choose Quantity !');
			$('#DTL_QTY').focus();
			return false;
		}

		if(DTL_PKG_ID.val() == 8){
			if (DTL_CONT_SIZE.val() == "not-selected") {
				alert('Please choose Size !');
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
			}
		}
		else{
			if(DTL_CMDTY_ID.val() == "not-selected") {
				alert('Please choose Barang !');
				$('#DTL_CMDTY_ID').focus();
				return false;
			}else if(DTL_UNIT_ID.val() == "not-selected") {
				alert('Please choose Satuan !');
				$('#DTL_UNIT_ID').focus();
				return false;
			}
		}

		var countData = new Array();
		$('#detail-list tbody tr').each(function() {

			var type_kegiatan_id = $(this).find('.tbl_dtl_bm_type_id').html(); 
			var no_bl = $(this).find('.tbl_dtl_bm_bl').html();		
			var truck_losing_id = $(this).find('.tbl_dtl_bm_tl').html();		
			var kemasan_id = $(this).find('.tbl_dtl_pkg_id').html();		
			var barang_id = $(this).find('.tbl_dtl_cmdty_id').html();		
			var unit_id = $(this).find('.tbl_dtl_unit_id').html();		
			var size_id = $(this).find('.tbl_dtl_size_id').html();		
			var type_id = $(this).find('.tbl_dtl_type_id').html();		
			var status_id = $(this).find('.tbl_dtl_status_id').html();		
			var sifat_id = $(this).find('.tbl_dtl_character_id').html();
			var owner_id = 	$(this).find('.tbl_dtl_bm_owner').html();	

			var data_table = type_kegiatan_id + no_bl + truck_losing_id + kemasan_id + barang_id + unit_id + size_id + type_id + status_id + sifat_id;
			var form_data = DTL_BM_TYPE_ID.val() + DTL_BM_BL.val() + DTL_BM_TL.val() + DTL_PKG_ID.val() + DTL_CMDTY_ID.val() +  DTL_UNIT_ID.val() + DTL_CONT_SIZE.val() + DTL_CONT_TYPE.val() + DTL_CONT_STATUS.val() + DTL_CHARACTER_ID.val();
			
			var data_owner_table = owner_id + no_bl;
			var data_owner_form = CARGO_OWNER_ID.val() + DTL_BM_BL.val();

			if(data_owner_table == data_owner_form){
				countData.push(1);
			}

			if (data_table == form_data) {
				countData.push(1);
			}
		});

		if(countData.length > 0){
			alert('Data sudah ada..');
			return false;
		}

		var brg_val = (DTL_CMDTY_ID.val() != "not-selected")? $('#DTL_CMDTY_ID option:selected').text() : "";
		var satuan_val = (DTL_UNIT_ID.val() != "not-selected")? $('#DTL_UNIT_ID option:selected').text() : "";
		var size_val = (DTL_CONT_SIZE.val() != "not-selected")? $('#DTL_CONT_SIZE option:selected').text() : "";
		var type_val = (DTL_CONT_TYPE.val() != "not-selected")? $('#DTL_CONT_TYPE option:selected').text() : "";
		var status_val = (DTL_CONT_STATUS.val() != "not-selected")? $('#DTL_CONT_STATUS option:selected').text() :"";

		$('#detail-list tbody').append(
			'<tr>' +
				'<td style="display: none;" class="tbl_dtl_bm_id">'+ DTL_ID.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_bm_hdr_id">'+ HDR_ID.val() +'</td>' +

				'<td class="tbl_dtl_bm_owner">'+ CARGO_OWNER.val() +'</td>' +
				'<td style="display: none;" class="tbl_dtl_bm_owner_id">'+ CARGO_OWNER_ID.val() +'</td>' +

				'<td style="display: none;" class="tbl_dtl_bm_type_id">'+ DTL_BM_TYPE_ID.val() +'</td>' +
				'<td class="tbl_dtl_bm_type_name">'+ $('#DTL_BM_TYPE_ID option:selected').text() +'</td>' +
				
				'<td class="tbl_dtl_bm_bl">'+ DTL_BM_BL.val() +'</td>' +
				
				'<td style="display: none;" class="tbl_dtl_bm_tl">'+ DTL_BM_TL.val() +'</td>' +
				'<td class="tbl_dtl_bm_tl_name">'+ $('#DTL_BM_TL option:selected').text() +'</td>' +
				
				'<td style="display: none;" class="tbl_dtl_pkg_id">'+ DTL_PKG_ID.val() +'</td>' +
				'<td class="tbl_dtl_pkg_name">'+ $('#DTL_PKG_ID option:selected').text() +'</td>' +
				
				'<td style="display: none;" class="tbl_dtl_cmdty_id">'+ DTL_CMDTY_ID.val() +'</td>' +
				'<td class="tbl_dtl_cmdty_name">'+ brg_val +'</td>' +
				
				'<td style="display: none;" class="tbl_dtl_unit_id">'+ DTL_UNIT_ID.val() +'</td>' +
				'<td class="tbl_dtl_unit_name">'+ satuan_val +'</td>' +

				'<td style="display: none;" class="tbl_dtl_size_id">'+ DTL_CONT_SIZE.val() +'</td>' +
				'<td class="tbl_dtl_size_name">'+ size_val +'</td>' +

				'<td style="display: none;" class="tbl_dtl_type_id">'+ DTL_CONT_TYPE.val() +'</td>' +
				'<td class="tbl_dtl_type_name">'+ type_val +'</td>' +

				'<td style="display: none;" class="tbl_dtl_status_id">'+ DTL_CONT_STATUS.val() +'</td>' +
				'<td class="tbl_dtl_status_namE">'+ status_val +'</td>' +


				'<td style="display: none;" class="tbl_dtl_character_id">'+ DTL_CHARACTER_ID.val() +'</td>' +
				'<td class="tbl_dtl_character_name">'+ $('#DTL_CHARACTER_ID option:selected').text() +'</td>' +
				
				'<td class="tbl_dtl_qty">'+ DTL_QTY.val() +'</td>' +
				
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
				'</td>' +
			'</tr>'
		);

		//$("#list-detail").prop('disabled', true);
		$('#DTL_BM_BL').keyup(function(){
			if ($('#DTL_BM_BL').val() != ''){
				$("#list-detail").prop('disabled', false);
			}else{
				$("#list-detail").prop('disabled', true);
			}
		});	
	}

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
							$("#btn-show").prop('disabled', false);
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


	//list rental
	function save_rental() {
		counterrent++;
		var EQ_TYPE_ID_RENT			= $('#EQ_TYPE_ID_RENT').val();
		var EQ_UNIT_ID_RENT			= $('#EQ_UNIT_ID_RENT').val();
		var EQ_QTY_RENT				= $('#EQ_QTY_RENT').val();
		var EQ_DURASI_RENT			= $('#EQ_DURASI_RENT').val();
		var PACKAGE_ID_RENT			= ($('#PACKAGE_ID_RENT').val() != "not-selected")? $('#PACKAGE_ID_RENT').val() : "";
		var PACKAGE_RENT			= ($('#PACKAGE_ID_RENT').val() != "not-selected")? $('#PACKAGE_ID_RENT option:selected').text() : "";
		var EQ_LAYANAN_ID			= ($('#EQ_GROUP_TARIFF').val() != "not-selected")? $('#EQ_GROUP_TARIFF').val() : "";
		var EQ_LAYANAN 				= ($('#EQ_GROUP_TARIFF').val() != "not-selected")? $('#EQ_GROUP_TARIFF option:selected').text() : "";
		
		var totalData = new Array();
		$('#detail-rental tbody tr').each(function(){
			var alat_id = $(this).find('.tbl_eq_type_id').html(); 
			var alat_unit_id = $(this).find('.tbl_eq_unit_id').html(); 
			var alat_kemasan_id = $(this).find('.tbl_package_id').html();
			var layanan_id = $(this).find('.tbl_group_tariff_id').html();

			var data_tabel = layanan_id + alat_id + alat_unit_id + alat_kemasan_id;
			var data_form = EQ_LAYANAN_ID + EQ_TYPE_ID_RENT + EQ_UNIT_ID_RENT + PACKAGE_ID_RENT;
			if(data_tabel == data_form){
				totalData.push(1);	
			}
		});

		if(totalData.length > 0){
			alert('Data sudah ada..');
			return false;
		}

		if(EQ_LAYANAN_ID == ""){
			alert('Layanan harus disi..');
			return false;
		}
		else if(EQ_TYPE_ID_RENT == 'not-selected'){
			alert('Nama alat harus diisi..');
			return false;
		} else if(EQ_QTY_RENT == ""){
			alert('Jumlah alat harus diisi..');
			return false;
		} else if(EQ_UNIT_ID_RENT == 'not-selected'){
			alert('Satuan harus diisi..');
			return false;
		} else if (EQ_DURASI_RENT == ""){
			alert('Jumlah/Durasi harus diisi..');
			return false;
		}

		$('#detail-rental').append(
			'<tr>' +
				'<td style="display:none;" class="tbl_eq_id"></td>' +
				'<td style="display:none;" class="tbl_group_tariff_id">'+ EQ_LAYANAN_ID +'</td>' +
				'<td class="tbl_group_tariff">'+ EQ_LAYANAN +'</td>' +
				'<td style="display:none;" class="tbl_eq_type_id">'+ EQ_TYPE_ID_RENT +'</td>' +
				'<td class="tbl_eq_type_name">'+ $('#EQ_TYPE_ID_RENT option:selected').text() +'</td>' +
				'<td class="tbl_eq_qty">'+ EQ_QTY_RENT +'</td>' +
				'<td style="display:none;" class="tbl_eq_unit_id">'+EQ_UNIT_ID_RENT +'</td>' +
				'<td class="tbl_eq_unit_name">'+$('#EQ_UNIT_ID_RENT option:selected').text() +'</td>' +
				'<td class="tbl_eq_duration">'+ EQ_DURASI_RENT +'</td>' +
				'<td style="display:none;" class="tbl_package_id">'+ PACKAGE_ID_RENT +'</td>' +
				'<td class="tbl_package_name">'+ PACKAGE_RENT +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail-rental"><span class="glyphicon glyphicon-trash"></span></a>' +
				'</td>' +
			'</tr>'
		);	
	}

	function search_no_peb(){
		$.blockUI();
		var tgl     = $('#BM_PIB_PEB_DATE').val();
		var tglexp  = tgl.split('-');
		var tgl_peb = tglexp[0]+tglexp[1]+tglexp[2];
		var no_peb  = $('#BM_PIB_PEB_NO').val();
		var npwp    = "018696153055000";
		$.get("<?=ROOT?>npkbilling/request_bm/auto_no_peb?",{tgl_peb: tgl_peb,no_peb: no_peb, npwp:npwp}, function(data){
		console.log(data);
		if(data != ''){
			$("#BM_NPE_SPPB_NO").val(data);
		}else{
			alert('Data Tidak Ditemukan')
		}
		$.unblockUI();
		});
	}

	$('#btn-modal-kirim').click(function(){ save_bm(); return false; });
	
	function save_bm(){
		$('#modal-default').modal('hide');
		var details = [];
		var alat = [];
		var file = [];
		var no_req = $('#BM_NO').val();

		$('#detail-list tbody tr').each(function() {
			var dtl_bm_id = $(this).find('.tbl_dtl_bm_id').html(); 
			var bm_hdr_id = $(this).find('.tbl_dtl_bm_hdr_id').html(); 

			var cargo_owner = $(this).find('.tbl_dtl_bm_owner').html();	
			var cargo_owner_id = $(this).find('.tbl_dtl_bm_owner_id').html();	

			var type_kegiatan_id = $(this).find('.tbl_dtl_bm_type_id').html(); 
			var type_kegiatan_text = $(this).find('.tbl_dtl_bm_type_name').html(); 

			var no_bl = $(this).find('.tbl_dtl_bm_bl').html();		

			var type_kegiatan_id = $(this).find('.tbl_dtl_bm_type_id').html();		
			var type_kegiatan_text	= $(this).find('.tbl_dtl_bm_type_name').html();

			var truck_losing_id = $(this).find('.tbl_dtl_bm_tl').html();		
			var truck_losing_name	= $(this).find('.tbl_dtl_bm_tl_name').html();

			var kemasan_id = $(this).find('.tbl_dtl_pkg_id').html();		
			var kemasan_name	= $(this).find('.tbl_dtl_pkg_name').html();

			var barang_id = $(this).find('.tbl_dtl_cmdty_id').html();		
			var barang_name	= $(this).find('.tbl_dtl_cmdty_name').html();

			var unit_id = $(this).find('.tbl_dtl_unit_id').html();		
			var unit_name = $(this).find('.tbl_dtl_unit_name').html();

			var size_id = $(this).find('.tbl_dtl_size_id').html();		
			var size_name	= $(this).find('.tbl_dtl_size_name').html();

			var type_id = $(this).find('.tbl_dtl_type_id').html();		
			var type_name	= $(this).find('.tbl_dtl_type_name').html();

			var status_id = $(this).find('.tbl_dtl_status_id').html();		
			var status_name	= $(this).find('.tbl_dtl_status_name').html();

			var sifat_id = $(this).find('.tbl_dtl_character_id').html();		
			var sifat_name	= $(this).find('.tbl_dtl_character_name').html();

			var qty = $(this).find('.tbl_dtl_qty').html()

			var tamp = {
				"DTL_BM_ID": null,
				"HDR_BM_ID": null,
				"DTL_BM_TYPE_ID": type_kegiatan_id,
				"DTL_BM_TYPE": type_kegiatan_text,
				"DTL_BM_BL": no_bl,
				"DTL_CUST_ID": cargo_owner_id,
                "DTL_CUST_NAME": cargo_owner,
				"DTL_BM_TL": truck_losing_id,
				"DTL_PKG_ID": kemasan_id,
				"DTL_PKG_NAME": kemasan_name,
				"DTL_CMDTY_ID": (barang_id != "not-selected")? barang_id : "",
				"DTL_CMDTY_NAME": barang_name,
				"DTL_UNIT_ID": (unit_id != "not-selected")? unit_id : "",
				"DTL_UNIT_NAME": unit_name,
				"DTL_CONT_SIZE": (size_id != "not-selected")? size_id : "",
				"DTL_CONT_TYPE": (type_id != "not-selected")? type_id : "",
				"DTL_CONT_STATUS": (status_id != "not-selected")? status_id : "",
				"DTL_CHARACTER_ID": sifat_id,
				"DTL_CHARACTER_NAME": sifat_name,
				"DTL_QTY": qty,				 			
			}
			details.push(tamp);
		});

		$('#detail-rental tbody tr').each(function(){
			var alat_eq_id = $(this).find('.tbl_eq_id').html(); 
			var alat_id = $(this).find('.tbl_eq_type_id').html(); 
			var alat_name = $(this).find('.tbl_eq_type_name').html(); 
			var alat_unit_id = $(this).find('.tbl_eq_unit_id').html(); 
			var alat_unit_name = $(this).find('.tbl_eq_unit_name').html(); 
			var alat_kemasan_id = $(this).find('.tbl_package_id').html(); 
			var alat_kemasan_name = ($(this).find('.tbl_package_name').html() != "")? $(this).find('.tbl_package_name').html() : ""; 
			var alat_qty = $(this).find('.tbl_eq_qty').html();
			var group_tariff_id = $(this).find('.tbl_group_tariff_id').html();
			var group_traiff_name = $(this).find('.tbl_group_tariff').html();
			var alat_durasi = $(this).find('.tbl_eq_duration').html();

			var temp = {
				"EQ_ID": alat_eq_id,
				"REQ_NO": no_req,
				"GROUP_TARIFF_ID": group_tariff_id,
				"GROUP_TARIFF_NAME": group_traiff_name,
				"EQ_TYPE_ID": alat_id,
				"EQ_TYPE_NAME": alat_name,
				"EQ_UNIT_ID": alat_unit_id,
				"EQ_UNIT_NAME": alat_unit_name,
				"EQ_QTY": alat_qty,
				"UNIT_QTY": alat_durasi,
				"PACKAGE_ID": alat_kemasan_id,
				"PACKAGE_NAME": alat_kemasan_name
			}
			alat.push(temp);
		});


		for (let index = 1; index <= counterdoc; index++) {
			var doc_no = $('#DOC_NO'+index).val();
			var doc_path = $('#DOC_PATH'+index).val();
			var doc_bash = $('#DOC_BASH'+index).val();
			var doc_id = $('#DOC_ID'+index).val();
			var doc_name 	= $('#DOC_NAME'+index).val();

			if (doc_no != '') {
				var temp = {
					"DOC_ID": doc_id,
					"REQ_NO": no_req,
					"DOC_NO": doc_no,
					"DOC_NAME"	: doc_name,
					"PATH": doc_path,
					"BASE64": doc_bash
				}
				file.push(temp);	
			}
		}

		arrData = {
            "action" : "saveheaderdetail",
            "data"   : ["HEADER", "DETAIL", "SPLIT_NOTA", "ALAT", "FILE"],
            "HEADER": {
                "DB"     : "omcargo",
                "TABLE"  : "TX_HDR_BM",
                "PK"     : "BM_ID",
                "VALUE"  : [{
					"APP_ID": "2",
					"BM_ID": $('#BM_ID').val(),
					"BM_NO": no_req,
					"BM_STATUS": 1,
					"BM_BRANCH_ID": 12,
					"BM_BRANCH_CODE": "BTN",
					"BM_CREATE_BY": 1,
					"BM_TERMINAL_CODE": $('#BM_TERMINAL_CODE').val(),
					"BM_TERMINAL_NAME": $('#BM_TERMINAL_CODE option:selected').text(),
					"BM_DATE": $('#BM_DATE').val(),
					"BM_PBM_ID": $('#BM_PBM_ID').val(),
					"BM_PBM_NAME": $('#BM_PBM_ID option:selected').text(),
					"BM_TRADE_TYPE": $('#BM_TRADE_TYPE').val(),
					"BM_TRADE_NAME": $('#BM_TRADE_TYPE option:selected').text(),
					"BM_SHIPPING_AGENT_ID": $('#BM_SHIPPING_AGENT_ID').val(),
					"BM_SHIPPING_AGENT_NAME": $('#BM_SHIPPING_AGENT_ID option:selected').text(),
					"BM_SPLIT": "N",
					"BM_CUST_ID": "<?=$this->session->userdata('customerid_phd')?>",
					"BM_CUST_NAME": "<?=$this->session->userdata('customername_phd')?>",
					"BM_CUST_NPWP": "<?=$this->session->userdata('npwp_phd')?>",
					"BM_CUST_ADDRESS": "<?=$this->session->userdata('address_phd')?>",
					"BM_PIB_PEB_NO": "",
					"BM_PIB_PEB_DATE": "",
					"BM_NPE_SPPB_NO": "",
					"BM_VESSEL_CODE": $('#BM_VESSEL_CODE').val(),
					"BM_VESSEL_NAME": $('#BM_VESSEL').val(),
					"BM_VVD_ID": $('#BM_VVD_ID').val(),
					"BM_KADE": $('#BM_KADE').val(),
					"BM_VOYIN": $('#BM_VOYIN').val(),
					"BM_VOYOUT": $('#BM_VOYOUT').val(),
					"BM_ETA": $('#BM_ETA').val(),
					"BM_ETD": $('#BM_ETD').val(),
					"BM_ETB": $('#BM_ETB').val(),
					"BM_ATA": $('#BM_ATD').val(),
					"BM_ATD": $('#BM_ATA').val(),
					"BM_OPEN_STACK": $('#BM_OPEN_STACK').val(),
					"BM_UKK": $('#BM_UKK').val()
                }]
			},
			"SPLIT_NOTA": {
				"DB": "omcargo",
				"FK": [
					"REQ_NO",
					"bm_no"
				],
				"TABLE": "TX_SPLIT_NOTA",
				"VALUE": []
			},
            "ALAT": {
                "DB"    : "omcargo",
                "TABLE" : "TX_EQUIPMENT",
                "FK"    : ["REQ_NO","bm_no"],
                "VALUE" : (alat.length > 0) ? alat : []
            },
            "DETAIL": {
                "DB"     : "omcargo",
                "TABLE"  : "TX_DTL_BM",
                "FK"     : ["HDR_BM_ID","bm_id"],
                "VALUE"  : (details.length > 0) ? details : []
            },
            "FILE": {
                "DB"     : "omcargo",
                "TABLE"  : "TX_DOCUMENT",
                "FK"     : ["REQ_NO","bm_no"],
                "VALUE"  : (file.length > 0) ? file : []
            }
		}
		
		console.log(arrData);
		$.blockUI();

		var BM_TERMINAL_CODE		= $('#BM_TERMINAL_CODE').val();
		var BM_DATE					= $('#BM_DATE').val();
		var BM_PBM_ID				= $('#BM_PBM_ID').val();
		var BM_SHIPPING_AGENT_ID	= $('#BM_SHIPPING_AGENT_ID').val();
		var BM_TRADE_TYPE			= $('#BM_TRADE_TYPE').val();
		var BM_PIB_PEB_NO			= $('#BM_PIB_PEB_NO').val();
		var BM_PIB_PEB_DATE			= $('#BM_PIB_PEB_DATE').val();

		if (BM_TERMINAL_CODE == 'not-selected') {
			$.unblockUI();
			alert('Terminal Harus diisi !!');
			return false;
		} else if (BM_DATE == '') {
			$.unblockUI();
			alert('Tanggal Harus diisi !!');
			return false;
		} else if (BM_PBM_ID == 'not-selected') {
			$.unblockUI();
			alert('PBM Harus diisi !!');
			return false;
		} else if (BM_SHIPPING_AGENT_ID == 'not-selected') {
			$.unblockUI();
			alert('Shipping Agent Harus diisi !!');
			return false;
		} else if (BM_TRADE_TYPE == 'not-selected') {
			$.unblockUI();
			alert('Trade Type si !!');
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

		//return false;

		$.ajax({
			url: "<?=ROOT?>npkbilling/request_bm/save_bm/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var temp 				= JSON.parse(data.data);
					var no_req 				= temp['header']['bm_no'];
					var terminal_id 		= temp['header']['bm_terminal_code'];
					var cust_id 			= temp['header']['bm_cust_id'];
					var cust_name 			= temp['header']['bm_cust_name'];
					var cust_address 		= temp['header']['bm_cust_address'];
					var cust_npwp	 		= temp['header']['bm_cust_npwp'];
					var ukk	 				= temp['header']['bm_ukk'];
					var vessel_name	 		= temp['header']['bm_vessel_name'];
					var voyage_in	 		= temp['header']['bm_voyin'];
					var voyage_out	 		= temp['header']['bm_voyout'];
					var eta 		 		= temp['header']['bm_eta'];
					var etd 		 		= temp['header']['bm_etd'];
					var req_date 		 	= temp['header']['bm_date'];

					var notification = new NotificationFx({
						message : '<p>Data '+no_req+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' 
					});
					bm_log(no_req,terminal_id,cust_id,cust_name,cust_address,cust_npwp,ukk,vessel_name,voyage_in,voyage_out,eta,etd,req_date);
					
					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_bm"; }, 3000);
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	
	function bm_log(no_req,terminal_id,cust_id,cust_name,cust_address,cust_npwp,ukk,vessel_name,voyage_in,voyage_out,eta,etd,req_date) {
		var status_req = $('#BM_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/bm_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				status_req		: status_req,
				no_req 			: no_req,
				terminal_id 	: terminal_id,
				cust_id 		: cust_id,
				cust_name 		: cust_name,
				cust_address 	: cust_address,
				cust_npwp		: cust_npwp,
				ukk 		    : ukk,
				vessel_name 	: vessel_name,
				voyage_in 		: voyage_in, 
				voyage_out 		: voyage_out,
				eta 			: eta,
				etd 			: etd,
				req_date 		: req_date

			},
			success: function( data ) {
				console.log(data);

			}
		});
	}

}


</script>

