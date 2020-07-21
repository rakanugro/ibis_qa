<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
			</header>
			
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Request</label>
					<input name="LUMPS_NO" id="LUMPS_NO" type="text" class="form-control" placeholder="Auto Generate" readonly>
					<input name="LUMPS_ID" id="LUMPS_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Kontrak</label>
					<span style="color: red">*</span>
					<input name="LUMPS_CONTRACT_NO" id="LUMPS_CONTRACT_NO" type="text" class="form-control" placeholder="Autocomplete" readonly>
				</div>
				<div class="form-group col-xs-6">
					<label for="datepickerDate">Tanggal Request</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<input id="LUMPS_DATE" name="LUMPS_DATE" type="text" class="form-control" readonly>
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label>Tipe Kegiatan</label>
					<span style="color: red">*</span>
					<select id="LUMPS_BOOKING_TYPE" name="LUMPS_BOOKING_TYPE" class="form-control">
						<option value="not-selected"> -- Please Choose Tipe Kegiatan  -- </option>
						<?php foreach ($tipe_kegiatan as $tpkeg) { ?>		
							<option value="<?=$tpkeg->reff_id?>"><?=$tpkeg->reff_name?></option>			
						<?php } ?>
					</select>
					<input type="hidden" id="LUMPS_BOOKING_TYPE_NAME" name="LUMPS_BOOKING_TYPE_NAME" class="form-control">
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
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">BL/SI/DO</label>
						<span style="color: red">*</span>
						<input name="DTL_BL" id="DTL_BL" type="text" class="form-control" placeholder="Nomor BL">
					</div>
					<div class="form-group col-xs-12">
						<label>Kemasan</label>
						<span style="color: red">*</span>
						<select id="DTL_PKG_ID" name="DTL_PKG_ID" class="form-control">
						<option value="not-selected"> -- Please Choose Kemasan  -- </option>
							<?php foreach($package as $pkg){ ?>
								<option value="<?=$pkg->package_id?>"><?=$pkg->package_name?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Quantity</label>
						<span style="color: red">*</span>
						<input name="DTL_QTY" id="DTL_QTY" type="number" class="form-control" placeholder="Quantity">
					</div>
					<div class="form-group col-xs-12">
						<label>Satuan</label>
						<span style="color: red">*</span>
						<select name="UNIT_ID" id="DTL_UNIT_ID" class="form-control">
						<option value="not-selected"> -- Please Choose Unit -- </option>
							<?php foreach($satuan as $stn){ ?>
								<option value="<?=$stn->unit_id?>"><?=$stn->unit_name?></option>
							<?php } ?>
						</select>
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
								<th>Nomor BL/SI/DO</th>
								<th style="display: none;">Kemasan</th>
								<th>Kemasan</th>
								<th>Quantity</th>
								<th style="display: none;">Satuan</th>
								<th>Satuan</th>
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
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				&nbsp;
			</header>
			<div class="main-box-body clearfix">		
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
	</div>
</div>	

<script>
	counterdetail = 0;

	$(document).ready(function() {

		$('#LUMPS_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		// AUTOCOMPLETE NOMOR KONTRAK
			
			$('#LUMPS_CONTRACT_NO').autocomplete({
				source: function( request, response ) {
					$.ajax({
						url: "<?=ROOT?>npkbilling/request_lumpsum/get_nomor_kontrak",
						type: 'GET',
						dataType: "json",
						data: {
							search: request.term
						},
						success: function( data ) {
							response( data );
						}
					});
				},
				select: function (event, ui) {
					$('#LUMPS_CONTRACT_NO').val(ui.item.label);
					
					return false;
				}
			});

		// END AUTOCOMPLETE NOMOR KONTRAK


		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		$.ajax({
			url: "<?=ROOT?>npkbilling/request_lumpsum/update_lumpsum/<?=$id?>",
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				$.unblockUI();
				if(data.HEADER != ""){
					arrData = data;
					console.log(arrData);
					arrData.HEADER.forEach(function(item, index){
						$("#LUMPS_ID").val(item.lumps_id);
						$("#LUMPS_NO").val(item.lumps_no);
						$("#LUMPS_CONTRACT_NO").val(item.lumps_contract_no);
						$("#LUMPS_DATE").val(item.lumps_date);
						$("#LUMPS_BOOKING_TYPE").val(item.lumps_booking_type);
						$("#LUMPS_BOOKING_TYPE_NAME").val(item.lumps_booking_type_name);
					});

					$('#DTL_HDR_ID').val(arrData.DETAIL[0].hdr_bm_id);
					arrData.DETAIL.forEach(function(detail, index){
						var no_bl 			= (detail.dtl_bl)? detail.dtl_bl : "";
						var qty 			= (detail.dtl_qty)? detail.dtl_qty : "";
						var kemasan_id 		= (detail.dtl_pkg_id)? detail.dtl_pkg_id : "";
						var kemasan_name 	= (detail.dtl_pkg_name)? detail.dtl_pkg_name : "";
						var unit_id 		= (detail.dtl_unit_id)? detail.dtl_unit_id : "";
						var unit_id 		= (detail.dtl_unit_name)? detail.dtl_unit_name : "";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td class="tbl_dtl_bl">'+ detail.dtl_bl +'</td>' +
								'<td class="tbl_dtl_qty">'+ detail.dtl_qty +'</td>' +
								
								'<td style="display: none;" class="tbl_dtl_pkg_id">'+ detail.dtl_pkg_id +'</td>' +
								'<td class="tbl_dtl_pkg_name">'+ detail.dtl_pkg_name +'</td>' +

								'<td style="display: none;" class="tbl_dtl_unit_id">'+ detail.dtl_unit_id +'</td>' +
								'<td class="tbl_dtl_unit_name">'+ detail.dtl_unit_name +'</td>' +
								
								'<td>' +
									'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
								'</td>' +
							'</tr>'
						);
					});

				}
			}
		});
		
	});

	function save_detail() {
		counterdetail++;
		var HDR_ID				= "";
		var DTL_ID				= "";
		var DTL_BL				= $('#DTL_BL');
		var DTL_QTY				= $('#DTL_QTY');
		var DTL_PKG_ID			= $('#DTL_PKG_ID');
		var DTL_UNIT_ID			= $('#DTL_UNIT_ID');

		if(DTL_BL.val() == "") {
			alert('Please choose BL !');
			$('#DTL_BL').focus();
			return false;
		}else if(DTL_PKG_ID.val() == 'not-selected') {
			alert('Please choose Kemasan !');
			$('#DTL_PKG_ID').focus();
			return false;	
		}else if(DTL_QTY.val()== "") {
			alert('Please choose Quantity !');
			$('#DTL_QTY').focus();
			return false;
		}else if(DTL_UNIT_ID.val() == 'not-selected') {
			alert('Please choose satuan !');
			$('#DTL_UNIT_ID').focus();
			return false;	
		}

		$('#detail-list tbody').append(
			'<tr>' +
				
				'<td class="tbl_dtl_bl">'+ DTL_BL.val() +'</td>' +
				'<td class="tbl_dtl_qty">'+ DTL_QTY.val() +'</td>' +
				
				'<td style="display: none;" class="tbl_dtl_pkg_id">'+ DTL_PKG_ID.val() +'</td>' +
				'<td class="tbl_dtl_pkg_name">'+ $('#DTL_PKG_ID option:selected').text() +'</td>' +
				
				'<td style="display: none;" class="tbl_dtl_unit_id">'+ DTL_UNIT_ID.val() +'</td>' +
				'<td class="tbl_dtl_unit_name">'+ $('#DTL_UNIT_ID option:selected').text() +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><span class="glyphicon glyphicon-trash"></span></a>' +
				'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function(){ save_lumpsum(); return false; });

	function save_lumpsum() {
		$('#modal-default').modal('hide');
		var details = [];

		$('#detail-list tbody tr').each(function() {
			var dtl_bm_id = $(this).find('.tbl_dtl_bm_id').html(); 
			var bm_hdr_id = $(this).find('.tbl_dtl_bm_hdr_id').html(); 

			var no_bl = $(this).find('.tbl_dtl_bl').html();		

			var kemasan_id = $(this).find('.tbl_dtl_pkg_id').html();		
			var kemasan_name	= $(this).find('.tbl_dtl_pkg_name').html();

			var unit_id = $(this).find('.tbl_dtl_unit_id').html();		
			var unit_name = $(this).find('.tbl_dtl_unit_name').html();

			var qty = $(this).find('.tbl_dtl_qty').html()

			var tamp = {
				"DTL_ID": null,
				"HDR_LUMPS_ID": null,
				"DTL_BL": no_bl,
				"DTL_PKG_ID": kemasan_id,
				"DTL_PKG_NAME": kemasan_name,
				"DTL_UNIT_ID": (unit_id != "not-selected")? unit_id : "",
				"DTL_UNIT_NAME": unit_name,
				"DTL_QTY": qty		 			
			}
			details.push(tamp);
		});

		arrData = {
            "action" : "saveheaderdetail",
            "data"   : ["HEADER", "DETAIL"],
            "HEADER": {
                "DB"     : "omcargo",
                "TABLE"  : "TX_HDR_LUMPSUM",
                "PK"     : "LUMPS_ID",
                "VALUE"  : [{
					"LUMPS_ID" : $('#LUMPS_ID').val(),
					"LUMPS_NO" : $('#LUMPS_NO').val(),
					"LUMPS_CONTRACT_NO" : $('#LUMPS_CONTRACT_NO').val(),	
					"LUMPS_CUST_ID" : '<?=$this->session->userdata('custid_phd')?>',
					"LUMPS_CUST_NAME" : '<?=$this->session->userdata('customernamealt_phd')?>',
					"LUMPS_CUST_ADDRESS" : '<?=$this->session->userdata('address_phd')?>',
					"LUMPS_CUST_NPWP" : '<?=$this->session->userdata('npwp_phd')?>',
					"LUMPS_BOOKING_TYPE" : $('#LUMPS_BOOKING_TYPE').val(),
					"LUMPS_BOOKING_TYPE_NAME" : $('#LUMPS_BOOKING_TYPE option:selected').text(),
					"LUMPS_DATE" : $('#LUMPS_DATE').val(),
					"LUMPS_STATUS" : '1',
					"LUMPS_BRANCH_ID" : '<?=$terminal[0]['BRANCH_ID']?>',
					"LUMPS_BRANCH_CODE" : '<?=$terminal[0]['BRANCH_CODE']?>',
					"LUMPS_CREATE_BY": null,
					"APP_ID": 2
                }]
			},
            "DETAIL": {
                "DB"     : "omcargo",
                "TABLE"  : "TX_DTL_LUMPSUM",
                "FK"     : ["HDR_LUMPS_ID","lumps_id"],
                "VALUE"  : (details.length > 0) ? details : []
            }
		}

		console.log(arrData);
		$.blockUI();

		var LUMPS_CONTRACT_NO		= $('#LUMPS_CONTRACT_NO').val();
		var LUMPS_BOOKING_TYPE		= $('#LUMPS_BOOKING_TYPE').val();

		if (LUMPS_CONTRACT_NO == '') {
			$.unblockUI();
			alert('No Kontrak Harus diisi !!');
			return false;
		} else if (LUMPS_BOOKING_TYPE == 'not-selected') {
			$.unblockUI();
			alert('Booking Type diisi !!');
			return false;
		} 

		if(details.length == 0){
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}

		//return false;

		$.ajax({
			url: "<?=ROOT?>npkbilling/request_lumpsum/save_lumpsum/",
			type: 'POST',
			dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var temp 				= JSON.parse(data.data);
					var no_req 				= temp['header']['lumps_no'];
					var notification = new NotificationFx({
						message : '<p>Data '+no_req+' Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' 
					});
					lumpsum_log(no_req);
					
					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_lumpsum"; }, 3000);
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}

	function lumpsum_log(no_req){
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/lumpsum_update_log",
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

</script>

