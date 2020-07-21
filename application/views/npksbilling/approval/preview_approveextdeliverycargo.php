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
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Delivery Extension Reference</b></h2>
			</header>
			
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Request Reff</label>
					<input name="DEL_CARGO_EXT_FROM" id="DEL_CARGO_EXT_FROM" type="text" class="form-control" placeholder="Autocomplete" style="text-transform: uppercase;" disabled>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Tanggal Request Reff</label>
					<input name="DEL_CARGO_EXT_FROM_DATE" id="DEL_CARGO_EXT_FROM_DATE" type="text" class="form-control" placeholder="Tanggal Request Reff" readonly>
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
						<label>PBM / EMKL</label>
						<input name="DEL_CARGO_PBM_ID" id="DEL_CARGO_PBM_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
						<input name="DEL_CARGO_PBM_NAME" id="DEL_CARGO_PBM_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nomor Request</label>
						<input name="DEL_CARGO_NO" id="DEL_CARGO_NO" type="text" placeholder="Auto Generate" class="form-control" disabled>
						<input name="DEL_CARGO_ID" id="DEL_CARGO_ID" type="hidden" placeholder="Auto Generate" value="<?=$extension_id?>" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="DEL_CARGO_STACKBY_NAME" id="DEL_CARGO_STACKBY_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="DEL_CARGO_STACKBY_ID" id="DEL_CARGO_STACKBY_ID" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Date</label>
						<input name="DEL_CARGO_DATE" id="DEL_CARGO_DATE" type="text" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>To</label>
						<input name="DEL_CARGO_TO" id="DEL_CARGO_TO" type="hidden" placeholder="To" class="form-control" disabled>
						<input name="DEL_CARGO_TO_NAME" id="DEL_CARGO_TO_NAME" type="text" placeholder="To" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Payment Method</label>
						<input name="DEL_CARGO_PAYMETHOD" id="DEL_CARGO_PAYMETHOD" type="hidden" placeholder="Payment Method" class="form-control" disabled>
						<input name="DEL_CARGO_PAYMETHOD_NAME" id="DEL_CARGO_PAYMETHOD_NAME" type="text" placeholder="Payment Method" class="form-control" disabled>
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
					<div class="form-group col-xs-6">
						<label>Vessel</label>
						<input name="DEL_CARGO_VESSEL_NAME" id="DEL_CARGO_VESSEL_NAME" type="text" placeholder="Autocomplate" class="form-control" disabled>
						<input name="DEL_CARGO_VESSEL_CODE" id="DEL_CARGO_VESSEL_CODE" type="hidden" placeholder="Autocomplate" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agent</label>
						<input name="DEL_CARGO_VESSEL_AGENT" id="DEL_CARGO_VESSEL_AGENT" type="hidden" placeholder="Nama Agent" class="form-control" disabled>
						<input name="DEL_CARGO_VESSEL_AGENT_NAME" id="DEL_CARGO_VESSEL_AGENT_NAME" type="text" placeholder="Nama Agent" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="DEL_CARGO_VESSEL_PKK" id="DEL_CARGO_VESSEL_PKK" type="text" placeholder="Nomor PKK" class="form-control" disabled>
						<input name="DEL_CARGO_VVD_ID" id="DEL_CARGO_VVD_ID" type="hidden" placeholder="Nomor PKK" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="DEL_CARGO_VOYIN" id="DEL_CARGO_VOYIN" type="text" placeholder="Voyage In" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="DEL_CARGO_VOYOUT" id="DEL_CARGO_VOYOUT" type="text" placeholder="Voyage Out" class="form-control" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="DEL_CARGO_VESSEL_ETA" id="DEL_CARGO_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="DEL_CARGO_VESSEL_ETD" id="DEL_CARGO_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
						<div class="form-group example-twitter-oss">
						</div>
					</table>
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
									<th>Jumlah</th>
									<th>Sifat</th>
									<th>Kemasan</th>
									<th>Barang</th>
									<th>Satuan</th>
									<th>Delivery Via</th>
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
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail Tagihan <?php $cust_name ?></b></h2>
				</header>	

				<div id="bd-penumpukan" hidden="true">
					<header class="main-box-header clearfix">
						<h2><b>penumpukan</b></h2>
					</header>
					<div class="main-box-body clearfix">
						<table id="penumpukan" class=" table order-list">
							<thead>
								<tr>
									<th rowspan="2" style="text-align: left;">No</th>
									<th rowspan="2" style="text-align: left;">Layanan</th>
									<th colspan="3" style="text-align: center;">Keterangan</th>
									<th rowspan="2" style="text-align: center;">Quantity</th>
									<th rowspan="2" style="text-align: center;">Date</th>
									<th colspan="2" style="text-align: center;">Hari</th>
									<th colspan="2" style="text-align: center;">Tarif </th>
									<th rowspan="2" style="text-align: right;">Total</th>
								</tr>
								<tr>
									<th>Size</th>
									<th>Type</th>
									<th>Status</th>
									<th>Massa 1</th>
									<th>Massa 2</th>
									<th>Massa 1</th>
									<th>Massa 2</th>
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

	<input type="hidden" id="DEL_CARGO_CREATE_BY">
	<input type="hidden" id="DEL_CARGO_CREATE_DATE">
	<input type="hidden" id="DEL_CARGO_EXT_LOOP">
	<!-- <input type="hidden" id="DEL_MARK"> -->
	<input type="hidden" id="DEL_CARGO_BRANCH_CODE">
	<input type="hidden" id="DEL_CARGO_BRANCH_ID">
	<!-- <input type="hidden" id="DEL_CLOSING_TIME"> -->

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

	var counterRental = 0;
	var counterRetribution = 0;
	var counterdoc = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$.blockUI();

	$.ajax({
		type: "GET",
		url: "<?=ROOT?>npksbilling/approveextdeliverycargo/preview/<?=$id ?>",
		success: function(data){
			var obj = JSON.parse(JSON.parse(data));
			data = obj;
			console.log(data);
			$('#detail-list tbody tr').remove();

			var req_method = (data['HEADER'][0]['del_cargo_paymethod'] != 2)? "PIUTANG" : "ADVANCED PAYMENT";
			var req_to = '';
			if ((data['HEADER'][0]['del_cargo_to'] == 1)){
				req_to = "DEPO";
			}else if((data['HEADER'][0]['del_cargo_to'] == 2)){
				req_to = "TPK";
			}else{
				req_to = "GUDANG";
			}
						
			// EXTENSION REFERENCE AND HEADER
			$('#DEL_CARGO_EXT_FROM_DATE').val(data['HEADER'][0]['del_cargo_ext_from_date']);
			$('#DEL_CARGO_EXT_FROM').val(data['HEADER'][0]['del_cargo_ext_from']);
			$('.auto-generate').removeClass('hidden_content');
			$('#DEL_CARGO_DATE').val(data['HEADER'][0]['del_cargo_date']);
			$('#DEL_CARGO_NO').val(data['HEADER'][0]['del_cargo_no']);
			$('#DEL_CARGO_PBM_NAME').val(data['HEADER'][0]['del_cargo_pbm_name']);
			$('#DEL_CARGO_STACKBY_NAME').val(data['HEADER'][0]['del_cargo_stackby_name']);
			$('#DEL_CARGO_STACKBY_ID').val(data['HEADER'][0]['del_cargo_stackby_id']);
			$('#DEL_CARGO_TO').val(data['HEADER'][0]['del_cargo_to']);
			$('#DEL_CARGO_TO_NAME').val(req_to);
			$('#DEL_CARGO_PAYMETHOD').val(data['HEADER'][0]['del_cargo_paymethod']);						
			$('#DEL_CARGO_PAYMETHOD_NAME').val(req_method);						
						
				// VESSEL
			$('#DEL_CARGO_VESSEL_NAME').val(data['HEADER'][0]['del_cargo_vessel_name']);
			$('#DEL_CARGO_VESSEL_CODE').val(data['HEADER'][0]['del_cargo_vessel_code']);
			$('#DEL_CARGO_VOYIN').val(data['HEADER'][0]['del_cargo_voyin']);
			$('#DEL_CARGO_VOYOUT').val(data['HEADER'][0]['del_cargo_voyout']);
			$('#DEL_CARGO_VESSEL_PKK').val(data['HEADER'][0]['del_cargo_vessel_pkk']);
			$('#DEL_CARGO_VVD_ID').val(data['HEADER'][0]['del_cargo_vvd_id']);
			$("#DEL_CARGO_VESSEL_ETA").val(data['HEADER'][0]['del_cargo_vessel_eta']);
			$("#DEL_CARGO_VESSEL_ETD").val(data['HEADER'][0]['del_cargo_vessel_etd']);

			$('#DEL_CARGO_CREATE_BY').val(data['HEADER'][0]['del_cargo_create_by']);								
			$('#DEL_CARGO_EXT_LOOP').val(data['HEADER'][0]['del_cargo_ext_loop']);						
			$('#DEL_CARGO_BRANCH_CODE').val(data['HEADER'][0]['del_cargo_branch_code']);						
			$('#DEL_CARGO_BRANCH_ID').val(data['HEADER'][0]['del_cargo_branch_id']);
															

			// NEW DOCUMENTS
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
						
			// DETAILS
			for (let index = 0; index < data['DETAIL'].length; index++) {
				var owner_name 	= (data['DETAIL'][index]['del_cargo_dtl_owner_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_owner_name'] : "";
				var owner_id = (data['DETAIL'][index]['del_cargo_dtl_owner'] != null) ? data['DETAIL'][index]['del_cargo_dtl_owner'] : "";
				var no_bl = (data['DETAIL'][index]['del_cargo_dtl_si_no'] != null) ? data['DETAIL'][index]['del_cargo_dtl_si_no'] : "";
				var jumlah = (data['DETAIL'][index]['del_cargo_dtl_qty'] != null) ? data['DETAIL'][index]['del_cargo_dtl_qty'] : "";
				var sifat_id = (data['DETAIL'][index]['del_cargo_dtl_character_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_character_id'] : "";
				var sifat_name = (data['DETAIL'][index]['del_cargo_dtl_character_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_character_name'] : "";
				var kemasan_id = (data['DETAIL'][index]['del_cargo_dtl_pkg_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_pkg_id'] : "";
				var kemasan_name = (data['DETAIL'][index]['del_cargo_dtl_pkg_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_pkg_name'] : "";
				var barang_id = (data['DETAIL'][index]['del_cargo_dtl_cmdty_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_cmdty_id'] : "";
				var barang_name = (data['DETAIL'][index]['del_cargo_dtl_cmdty_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_cmdty_name'] : "";
				var satuan_id = (data['DETAIL'][index]['del_cargo_dtl_unit_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_unit_id'] : "";
				var satuan_name = (data['DETAIL'][index]['del_cargo_dtl_unit_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_unit_name'] : "";
				var via_id = (data['DETAIL'][index]['del_cargo_dtl_via'] != null) ? data['DETAIL'][index]['del_cargo_dtl_via'] : "";
				var via_name = (data['DETAIL'][index]['del_cargo_dtl_via_name'] != null) ? data['DETAIL'][index]['del_cargo_dtl_via_name'] : "";
				var tanggal = (data['DETAIL'][index]['del_cargo_dtl_del_date'] != null) ? data['DETAIL'][index]['del_cargo_dtl_del_date'] : "";
				var create_date = (data['DETAIL'][index]['del_cargo_dtl_create_date'] != null) ? data['DETAIL'][index]['del_cargo_dtl_create_date'] : "";
				var dtl_id = (data['DETAIL'][index]['del_cargo_dtl_id'] != null) ? data['DETAIL'][index]['del_cargo_dtl_id'] : "";
				var hdr_id = (data['DETAIL'][index]['del_cargo_hdr_id'] != null) ? data['DETAIL'][index]['del_cargo_hdr_id'] : "";


				$('#detail-list tbody').append(
					'<tr>' +
						'<td class="TBL_DTL_CARGO_OWNER_NAME">'+ owner_name +'</td>' +
						'<td style="display:none;" class="TBL_DTL_CARGO_OWNER_ID">'+ owner_id +'</td>' +
						'<td class="TBL_DTL_CARGO_SI_NO">'+ no_bl +'</td>' +
						'<td class="TBL_DTL_CARGO_QTY">'+ jumlah +'</td>' +
						'<td style="display:none;" class="TBL_DTL_CARGO_CHARACTER_ID">'+ sifat_id +'</td>' +
						'<td class="TBL_DTL_CARGO_CHARACTER_NAME">'+ sifat_name +'</td>' +
						'<td style="display:none;" class="TBL_DTL_CARGO_PKG_ID">'+ kemasan_id +'</td>' +
						'<td class="TBL_DTL_CARGO_PKG_NAME">'+ kemasan_name +'</td>' +
						'<td style="display:none;" class="TBL_DTL_CARGO_CMDTY_ID">'+ barang_id +'</td>' +
						'<td class="TBL_DTL_CARGO_CMDTY_NAME">'+ barang_name +'</td>' +
						'<td style="display:none;" class="TBL_DTL_CARGO_UNIT_ID">'+ satuan_id +'</td>' +
						'<td class="TBL_DTL_CARGO_UNIT_NAME">'+ satuan_name +'</td>' +
						'<td style="display:none;" class="TBL_DTL_CARGO_VIA_ID">'+ via_id +'</td>' +
						'<td class="TBL_DTL_CARGO_VIA_NAME">'+ via_name +'</td>' +
						'<td class="TBL_DTL_CARGO_DEL_DATE">'+tanggal+'</td>' +
						'<td style="display: none;" class="TBL_DTL_CARGO_CREATE_DATE">'+ create_date +'</td>' +
						'<td style="display: none;" class="TBL_DTL_CARGO_ID">'+ dtl_id +'</td>' +
						'<td style="display: none;" class="TBL_HDR_CARGO_ID">'+ hdr_id +'</td>' +
					'</tr>'
				);	
			}

			$('#TBL_DTL_CARGO_DEL_DATE').datetimepicker({
				format: 'Y-m-d H:i',
				timepicker:true,
				datepicker:true,
			});
			$.unblockUI();
		}
	});

	$.ajax({

      	url: "<?=ROOT?>npksbilling/approveextdeliverycargo/preview_uper/<?=$id?>",
      	type: "GET",
      	dataType : 'json',
      	success: function (data) {
        	var table = $("#penumpukan tbody");
        	var no =1;
        	var jmlresponse = data['result']['length'];

        	$('#UPER_DPP').val(data.result[0].dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
         	$('#UPER_PPN').val(data.result[0].ppn.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      		$('#UPER_AMOUNT').val(data.result[0].total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

        	if (jmlresponse == 0 ) {
 				$("#bd-penumpukan").hide();
 			}else{
 				$("#bd-penumpukan").show();
	      	 	data.result[0].nota_view[0].Penumpukan.forEach(function(abc) {
	      	 		var masa1 = (abc.masa1 == null)? "N/A" : abc.masa1;
	      	 		var masa2 = (abc.masa2 == null)? "N/A" : abc.masa2;
	      	 		var trf1 = (abc.trf1 == null)? "N/A" : abc.trf1;
	      	 		var trf2 = (abc.trf2 == null)? "N/A" : abc.trf2;
	      	 		table.append(
						'<tr>' +
					    	'<td style="text-align: left;">'+ no++ +'</td>' +
					    	'<td style="text-align: left;">'+ abc.no_bl +'</td>' +
					    	'<td style="text-align: left;">'+ abc.cont_size +'</td>' +
					    	'<td style="text-align: left;">'+ abc.cont_type +'</td>' +
					    	'<td style="text-align: left;">'+ abc.cont_status +'</td>' +
					    	'<td style="text-align: center;">'+ abc.qty +'</td>' +
					    	'<td style="text-align: center;">'+ abc.date_in_out +'</td>' +
					    	'<td style="text-align: center;">'+ masa1 +'</td>' +
					    	'<td style="text-align: center;">'+ masa2 +'</td>' +
					    	'<td style="text-align: center;">'+ trf1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
					    	'<td style="text-align: center;">'+ trf2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
					    	'<td style="text-align: right;">'+ abc.dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						'</tr>'
			        );
	      	 	});
	      	 	$("#penumpukan").DataTable();
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
				url: "<?=ROOT?>npksbilling/approveextdeliverycargo/approve/<?=$id?>",
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);
						console.log(resp.result);
						console.log(resp.no_req);

						if(resp.no_req != "" || resp.no_req != undefined){
							alert('Request '+resp.no_req+' berhasil Approve');

							window.location = "<?=ROOT?>npksbilling/approveextdeliverycargo";
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
				url: "<?=ROOT?>npksbilling/approveextdeliverycargo/reject/<?=$id?>",
				data: {
		            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		            remarks: remarks
		        },
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);
						console.log(resp.result);
						console.log(resp.no_req);

						if(resp.no_req != "" || resp.no_req != undefined){
							alert('Request '+resp.no_req+' berhasil Reject');

							window.location = "<?=ROOT?>npksbilling/approveextdeliverycargo";
						}
						else{
							alert("Request Gagagl Reject");
						}
					}
				}
			})
		}

	}

</script>

