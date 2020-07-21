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
						<select id="BM_TERMINAL_CODE" name="BM_TERMINAL_CODE" class="form-control" disabled>
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
						<select id="BM_PBM_ID" name="BM_PBM_ID" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose PBM -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<select id="BM_TRADE_TYPE" name="BM_TRADE_TYPE" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose Tipe Perdagangan  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Shipping Agent</label>
						<select id="BM_SHIPPING_AGENT_ID" name="BM_SHIPPING_AGENT_ID" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose Shipping Agent -- </option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12" id='international_content'>
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>International</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label for="exampleAutocomplete">No PEB/PIB</label>
						<input type="text" id="BM_PIB_PEB_NO" name="BM_PIB_PEB_NO" class="form-control" placeholder="No PEB/PIB" required disabled>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
                      	<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="BM_PIB_PEB_DATE" name="BM_PIB_PEB_DATE" type="text" class="form-control" id="datepickerDate" placeholder="Tanggal PEB/PIB" disabled>
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">No NPE/SPPB</label>
						<input id="BM_NPE_SPPB_NO" name="BM_NPE_SPPB_NO" type="text" class="form-control" placeholder="No NPE/SPPB" id="exampleTooltip" disabled>
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
						<input type="text" id="BM_VESSEL_NAME" class="form-control" name="BM_VESSEL_NAME" placeholder="Autocomplete" title="Masukkan data kapal" required disabled>
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
					</table>
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
						<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>					
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>	


<script>
	
	var counterdoc = 0;
	counterdetail = 0;
	counterrent = 0;
	counterretri = 0;
	//var apiUrl = "http://10.88.48.33/api/public/";

	function goBack() {
		window.history.back();
	}

	$(document).ready(function() {
		$.blockUI();
		

		// $('#BM_TRADE_TYPE').on('change', function(){
		// 	var trade_type = $(this).val();
		// 	if (trade_type == 'I'){
		// 		$('#international_content').removeClass('hidden_content');
		// 	} else {
		// 		$('#international_content').addClass('hidden_content');
		// 	}
		// });

		// if($('#BM_TRADE_TYPE').val() == 'I'){
		// 	$('#international_content').removeClass('hidden_content');
		// } else {
		// 	$('#international_content').addClass('hidden_content');
		// }

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

						if(item.bm_trade_name !="Internasional"){    
					       $("#international_content").hide();
					   }
					});

					$('#show-detail').removeClass('hidden_content');

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].hdr_bm_id);
					arrData.DETAIL.forEach(function(detail, index){
						var comodity_name = (detail.dtl_cmdty_name)? detail.dtl_cmdty_name : "N/A";
						var comodity_id = (detail.dtl_cmdty_id)? detail.dtl_cmdty_id : "";
						var unit_id = (detail.dtl_unit_id)? detail.dtl_unit_id : "";
						var unit_name = (detail.dtl_unit_name)? detail.dtl_unit_name :  "N/A";
						var size = (detail.dtl_cont_size)? detail.dtl_cont_size : "";
						var size_name = (detail.dtl_cont_size)? detail.dtl_cont_size : "N/A";
						var type = (detail.dtl_cont_type)? detail.dtl_cont_type : "";
						var type_name = (detail.dtl_cont_type)? detail.dtl_cont_type : "N/A";
						var status = (detail.dtl_cont_status)? detail.dtl_cont_status : "";
						var status_name  = (detail.dtl_cont_status)? detail.dtl_cont_status : "N/A";
						var cust_name = (detail.dtl_cust_id)? detail.dtl_cust_name : "N/A";
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
							'</tr>'
						);
					});

					arrData.ALAT.forEach(function(alat, index){
							var kemasan = (alat.package_id != null)? alat.package_name : "N/A";
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
								'</tr>'
							);
					});

					arrData.FILE.forEach(function(file, index){
						if (arrData.FILE.length != 0) {
							counterdoc++;
							var newRow = $("<tr>");
							var cols = "";

							cols += '';
							cols += '<div class="col-xs-6"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" value="'+file.doc_no+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40" disabled></div>';

							cols += '<div class="col-xs-5"><label>Nama File</label></div><div class="col-xs-5"><a href="<?=apiUrl?>/'+file.doc_path+'" target="_blank">'+file.doc_name+'</a></div>';
								
							newRow.append(cols);

							$(".list_file").append(newRow);
						}
					});

				}
			}
		});

	});

</script>

