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
						<select id="DEL_TERMINAL_CODE" name="DEL_TERMINAL_CODE" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose Terminal -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Nomor Request</label>
						<input name="DEL_NO" id="DEL_NO" type="text" class="form-control" placeholder="Auto Generate" readonly>
						<input name="DEL_ID" id="DEL_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly>

					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Request</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_DATE" name="DEL_DATE" type="text" class="form-control" value="<?=date('Y-m-d H:i')?>" readOnly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<select id="DEL_TRADE_TYPE" name="DEL_TRADE_TYPE" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose Tipe Perdagangan  -- </option>
							<option value="D">Domestik</option><option value="I">Internasional</option>
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
						<input type="text" id="DEL_PIB_PEB_NO" name="DEL_PIB_PEB_NO" class="form-control" title="Masukkan No PEB" placeholder="No PEB/PIB" required disabled>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
                      	<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_PIB_PEB_DATE" name="DEL_PIB_PEB_DATE" type="text" class="form-control" id="datepickerDate" placeholder="Tanggal PEB/PIB" disabled>
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">No NPE/SPPB</label>
						<input id="DEL_NPE_SPPB_NO" name="DEL_NPE_SPPB_NO" type="text" class="form-control" placeholder="No NPE/SPPB" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" maxlength="40" readonly="" disabled>
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
						<input type="text" id="DEL_VESSEL_NAME" class="form-control" name="DEL_VESSEL_NAME" placeholder="Autocomplete" title="Masukkan data kapal" required disabled>
						<input type="hidden" id="DEL_VESSEL_CODE" class="form-control" name="DEL_VESSEL_CODE" placeholder="Autocomplete" title="Masukkan data kapal" required>
						<input type="hidden" id="DEL_VESSEL" class="form-control" name="DEL_VESSEL" placeholder="Autocomplete" title="Masukkan data kapal" required>

					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Kade</label>
						<input type="text" class="form-control" id="DEL_KADE" name="DEL_KADE" placeholder="Kade" title="Masukkan data kade" size="8" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Voyage In</label>
						<input type="text" class="form-control" id="DEL_VOYIN" name="DEL_VOYIN" placeholder="Voyage In" title="Masukkan data kapal" size="8" readonly>
						<input type="hidden" class="form-control" id="DEL_VVD_ID" name="DEL_VVD_ID" placeholder="DEL_VVD_ID" title="Masukkan data kapal" size="8" readonly>

					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">Voyage Out</label>
						<input type="text" class="form-control" id="DEL_VOYOUT" name="DEL_VOYOUT" placeholder="Voyage Out" title="Masukkan data kapal" size="8" readonly>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETA</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input type="text" class="form-control" id="DEL_ETA" name="DEL_ETA" placeholder="ETA" title="Masukkan data kapal" size="8" readonly>
						</div>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETD</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input type="text" class="form-control" id="DEL_ETD" name="DEL_ETD" placeholder="ETD" title="Masukkan data kapal" size="8" readonly>
						</div>
					</div>
					<div class="form-group col-xs-4">
						<label for="exampleAutocomplete">ETB</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input type="text" class="form-control" id="DEL_ETB" name="DEL_ETB" placeholder="ETB" title="Masukkan data ETB" size="8" readonly>
						</div> 
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">ATA</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_ATA" name="DEL_ATA" type="text" class="form-control" id="datepickerDate" placeholder="ATA" readonly>
						</div>
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">ATD</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_ATD" name="DEL_ATD" type="text" class="form-control" id="datepickerDate" placeholder="ATD" readonly>
						</div>
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">Open Stack</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_OPEN_STACK" name="DEL_OPEN_STACK" type="text" class="form-control" id="datepickerDate" placeholder="Actual Destination" readonly>
						</div>
					</div>
					<div class="form-group col-xs-3">
						<label for="datepickerDate">UKK</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_UKK" name="DEL_UKK" type="text" class="form-control placeholder="UKK" readonly>
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
								<th>Nomor BL/SI/DO</th>
								<th style="display: none;">Kemasan</th>
								<th>Kemasan</th>
								<th style="display: none;">Barang</th>
								<th>Barang</th>
								<th style="display: none;">Satuan</th>
								<th>Satuan</th>
								<th>Size</th>
								<th>Type</th>
								<th>Status</th>
								<th>Sifat</th>
								<th style="display: none;">Sifat</th>
								<th>Quantity</th>
								<th>Stacking Area Type</th>
								<th>Stacking Area</th>
								<th>Date Out</th>
								<th>Date In</th>
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

		// $('#DEL_TRADE_TYPE').on('change', function(){
		// 	var trade_type = $(this).val();
		// 	if (trade_type == 'I'){
		// 		$('#international_content').removeClass('hidden_content');
		// 	} else {
		// 		$('#international_content').addClass('hidden_content');
		// 	}
		// });
		
		// if($('#DEL_TRADE_TYPE').val() == 'I'){
		// 	$('#international_content').removeClass('hidden_content');
		// } else {
		// 	$('#international_content').addClass('hidden_content');
		// }
		
	  	$("#btn-show").click(function(){
	    	$('#show-detail').removeClass('hidden_content');
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
				
				var isSet = $('#DEL_TERMINAL_CODE').append(toAppend);
				if(isSet){
					$('#DEL_TERMINAL_CODE').val('T01');
				}
			}
		});
	});

	//getdata
	var id_rec = "<?=$id?>";
	if(id_rec != ""){
		$.ajax({
			url: "<?=ROOT?>npkbilling/request_delivery/update_delivery/"+id_rec,
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				$.unblockUI();
				if(data.HEADER != ""){
					arrData = data;
					console.log(arrData);
					arrData.HEADER.forEach(function(item, index){
						$("#DEL_ID").val(item.del_id);
						$("#DEL_NO").val(item.del_no);
						$("#DEL_STATUS").val(1);
						$("#DEL_BRANCH_ID").val(12);
						$("#DEL_CREATE_BY").val();
						$("#DEL_TERMINAL_CODE").val(item.del_terminal_code);
						$("#DEL_DATE").val(item.del_date);
						$("#DEL_PDEL_ID").val(item.del_pbm_id);
						$("#DEL_TRADE_TYPE").val(item.del_trade_type);
						$("#DEL_SHIPPING_AGENT_ID").val(item.del_shipping_agent_id);
						$("#DEL_CUST_ID").val(item.del_cust_id);
						$("#DEL_CUST_NPWP").val(item.del_cust_npwp);
						$("#DEL_CUST_ADDRESS").val(item.del_cust_address);
						$("#DEL_PIB_PEB_NO").val(item.del_pib_peb_no);
						$("#DEL_PIB_PEB_DATE").val(item.del_pib_peb_date); 
						$("#DEL_NPE_SPPB_NO").val(item.del_npe_sppb_no); 
						$("#DEL_VESSEL_CODE").val(item.del_vessel_code);
						$("#DEL_VESSEL_NAME").val(item.del_vessel_name); 
						$("#DEL_VESSEL").val(item.del_vessel_name);  
						$("#DEL_VVD_ID").val(item.del_vvd_id); 
						$("#DEL_KADE").val(item.del_kade);
						$("#DEL_VOYIN").val(item.del_voyin); 
						$("#DEL_VOYOUT").val(item.del_voyout); 
						$("#DEL_ETA").val(item.del_eta); 
						$("#DEL_ETD").val(item.del_etd); 
						$("#DEL_ETB").val(item.del_etb); 
						$("#DEL_ATA").val(item.del_ata); 
						$("#DEL_ATD").val(item.del_atd); 
						$("#DEL_OPEN_STACK").val(item.del_open_stack); 
						$("#DEL_UKK").val(item.del_ukk);
						$('#DEL_VESSEL').val(item.del_vessel_name);

						if(item.del_trade_name !="Internasional"){    
					       $("#international_content").hide();
					   }
					});

					$('#show-detail').removeClass('hidden_content');

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].hdr_del_id);
					arrData.DETAIL.forEach(function(detail, index){
						var comodity_name = (detail.dtl_cmdty_name)? detail.dtl_cmdty_name : "N/A";
						var comodity_id = (detail.dtl_cmdty_id)? detail.dtl_cmdty_id : "";
						var unit_id = (detail.dtl_unit_id)? detail.dtl_unit_id : "";
						var unit_name = (detail.dtl_unit_name)? detail.dtl_unit_name : "N/A";
						var size = (detail.dtl_cont_size)? detail.dtl_cont_size : "";
						var size_name = (detail.dtl_cont_size)? detail.dtl_cont_size : "N/A";
						var type = (detail.dtl_cont_type)? detail.dtl_cont_type : "";
						var type_name = (detail.dtl_cont_type)? detail.dtl_cont_type : "N/A";
						var status = (detail.dtl_cont_status)? detail.dtl_cont_status : "";
						var status_name = (detail.dtl_cont_status)? detail.dtl_cont_status : "N/A";
						var cust_name = (detail.dtl_cust_id)? detail.dtl_cust_name : "N/A";
						var cust_id = (detail.dtl_cust_id)? detail.dtl_cust_id : "";
						var stacking_type_id = (detail.dtl_stacking_type_id)? detail.dtl_stacking_type_id : "N/A";
						var stacking_type_name  = (detail.dtl_stacking_type_name)? detail.dtl_stacking_type_name : "N/A";
						var stacking_area_id  = (detail.dtl_stacking_area_id)? detail.dtl_stacking_area_id : "N/A";
						var stacking_area_name  = (detail.dtl_stacking_area_name)? detail.dtl_stacking_area_name : "N/A";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td class="tbl_dtl_del_owner">'+ cust_name +'</td>' +
								'<td style="display: none;" class="tbl_dtl_del_owner_id">'+ cust_id +'</td>' +

								'<td style="display: none;" class="tbl_dtl_del_id">'+ detail.dtl_del_id +'</td>' +
								'<td style="display: none;" class="tbl_dtl_del_hdr_id">'+ detail.hdr_del_id +'</td>' +
								
								'<td class="tbl_dtl_del_bl">'+ detail.dtl_del_bl +'</td>' +
								
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
								'<td class="tbl_dtl_status_namE">'+ status_name +'</td>' +


								'<td style="display: none;" class="tbl_dtl_character_id">'+ detail.dtl_character_id +'</td>' +
								'<td class="tbl_dtl_character_name">'+ detail.dtl_character_name +'</td>' +
								
								'<td class="tbl_dtl_qty">'+ detail.dtl_qty +'</td>' +

								'<td style="display: none;" class="tbl_dtl_stacking_type_id">'+ stacking_type_id +'</td>' +
								'<td class="tbl_dtl_stacking_type_name">'+ stacking_type_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_stacking_area_id">'+ stacking_area_id +'</td>' +
								'<td class="tbl_dtl_stacking_area_name">'+ stacking_area_name +'</td>' +

								'<td class="tbl_dtl_dateout">'+ detail.dtl_out +'</td>' +

								'<td class="tbl_dtl_datein">'+ detail.dtl_in +'</td>' +
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
	}

</script>

