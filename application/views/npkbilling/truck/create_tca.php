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
.modal-header {
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }

</style>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
				</header>
				
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-12">
						<label>Terminal</label>
						<span style="color: red">*</span>
						<select id="TCA_TERMINAL_CODE" name="TCA_TERMINAL_CODE" class="form-control">
							<option value="not-selected"> -- Please Choose Terminal  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-12">
						<label>Tipe Layanan</label>
						<span style="color: red">*</span>
						<select id="TCA_REQ_TYPE" name="TCA_REQ_TYPE" class="form-control" onchange="getnametype(this);">
								<option value="not-selected"> -- Please Layanan  -- </option>
							<?php foreach($layanan as $la){ ?>
								<option value="<?=$la->reff_id?>"><?=$la->reff_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" name="TCA_REQ_TYPE_NAME" id="TCA_REQ_TYPE_NAME" class="form-control">
					</div>
					<div class="form-group col-lg-6 hidden_content" id='layanan_DEL'>
						<label for="datepickerDate">Nomor Request</label>
						<span style="color: red">*</span>
						<input name="TCA_REQ_NO_DEL" id="TCA_REQ_NO_DEL" type="text" class="form-control getBLDel" placeholder="Autocomplete">
					</div>
					<div class="form-group col-lg-6 hidden_content" id='layanan_REC'>
						<label for="datepickerDate">Nomor Request</label>
						<span style="color: red">*</span>
						<input name="TCA_REQ_NO_REC" id="TCA_REQ_NO_REC" type="text" class="form-control getBLRec" placeholder="Autocomplete">
					</div>
					<div class="form-group col-lg-6 hidden_content" id='layanan_BM'>
						<label for="datepickerDate">Nomor Request</label>
						<span style="color: red">*</span>
						<input name="TCA_REQ_NO_BM" id="TCA_REQ_NO_BM" type="text" class="form-control" placeholder="Autocomplete">
					</div>
					<div class="form-group col-xs-6 hidden_content" id="hidden_bl">
						<label for="datepickerDate">BL/SI/DO</label>
						<span style="color: red">*</span>
						<select id="TCA_BL" name="TCA_BL" class="form-control TCA_BL">
							<option value="not-selected"></option>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="datepickerDate">Nama Customer</label>
						<input name="TCA_CUST_NAME" id="TCA_CUST_NAME" type="text" class="form-control" placeholder="Nama Customer" readonly>
						<input name="TCA_CUST_ID" id="TCA_CUST_ID" type="hidden" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Request</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="TCA_REQ_DATE" name="TCA_REQ_DATE" type="text" class="form-control" placeholder="Tanggal Request" id="datepickerDate" readonly>
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="datepickerDate">Vessel</label>
						<input name="TCA_VESSEL_NAME" id="TCA_VESSEL_NAME" type="text" class="form-control" placeholder="Vessel" readonly>
						<input name="TCA_VESSEL_CODE" id="TCA_VESSEL_CODE" type="hidden" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal BL</label>
						<span style="color: red">*</span>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="TCA_BL_DATE" name="TCA_BL_DATE" type="text" class="form-control" placeholder="Tanggal BL" id="datepickerDate">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Kemasan</label>
						<input type="text" name="TCA_PKG_NAME" id="TCA_PKG_NAME" class="form-control" placeholder="Kemasan" readonly>
						<input type="hidden" name="TCA_PKG_ID" id="TCA_PKG_ID" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Quantity</label>
						<input name="TCA_QTY" id="TCA_QTY" type="number" class="form-control" placeholder="Quantity" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Satuan</label>
						<input name="TCA_UNIT_NAME" id="TCA_UNIT_NAME" type="text" class="form-control" placeholder="Satuan" readonly>
						<input type="hidden" name="TCA_UNIT_ID" id="TCA_UNIT_ID" class="form-control">
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Hscode</label>
						<input name="TCA_HS_CODE" id="TCA_HS_CODE" type="text" class="form-control" placeholder="Hscode">
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<input type="text" name="TCA_TRADE_NAME" id="TCA_TRADE_NAME" class="form-control" placeholder="Tipe Perdagangan" readonly>
						<input type="hidden" name="TCA_TRADE_TYPE" id="TCA_TRADE_TYPE" class="form-control">
					</div>

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

				<div class="main-box-body clearfix">
					<form>
						<div class="form-inline" role="form">
							<div class="form-group">
								<label for="exampleTooltip">TRUCK ID / TRUCK NUMBER</label>
								<input id="tid" name="tid" type="text" class="form-control" placeholder="Truck ID">	
								<input id="TRUCK_TYPE" name="TRUCK_TYPE" type="text" class="form-control" readOnly>	
								<input id="TRUCK_TYPE_NAME" name="TRUCK_TYPE_NAME" type="text" class="form-control" readOnly>
								<input id="TRUCK_CUST_ID" name="TRUCK_CUST_ID" type="text" class="form-control" readOnly>
								<input id="TRUCK_CUST_NAME" name="TRUCK_CUST_NAME" type="text" class="form-control" readOnly>
							</div>
							<button type="button" class="btn btn-danger" id="btn-detail" onclick="save_detail()"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Add</button>
						<div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>LIST DETAIL</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover tca-detail-truck-list" id="detail-list">
							<thead>
								<tr>
									<th width='50px'>TID</th>
									<th width='50px'>Vechile Type ID</th>
									<th width='50px'>Vechile Type</th>
									<th width='50px'>Truck Company ID</th>
									<th width='50px'>Truck Company Name</th>
									<th width='50px'>DELETE</th>
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
					<div class="form-group example-twitter-oss pull-right">
						<button type="submit" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
						<button id="submit_header" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-sm" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-sm">
    		<div class="modal-content">
    			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel"><b>Informasi</b></h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<!-- <span aria-hidden="true">&times;</span> -->
        			</button>
      			</div>
      			<div class="modal-body">
        			Apakah anda yakin&hellip;?
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>
        			<button type="button" id="btn-modal-kirim" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
        		</div>
        	</div>
  		</div>
	</div>


<script>
	var urut = 0;
	var temptcaid = new Array();

	function clearTCAListTruck() {
		var cek = $('table.tca-detail-truck-list tbody').html();
		if (cek.length > 0) {
			console.log(cek.length);
			$('table.tca-detail-truck-list tbody').html('');
		}
		temptcaid = new Array();
	}

	$("#btn-detail").prop('disabled', true);
	$('#tid').keyup(function(){
		if ($('#tid').val() != ''){
			$("#btn-detail").prop('disabled', false);
		}else{
			$("#btn-detail").prop('disabled', true);
		}
		});

	$(document).ready(function(){
		// $("#btn-show").click(function(){
	    	
	 //  	});

	  	$('#btn-show').click(function(){
			var TCA_TERMINAL_CODE		= $('#TCA_TERMINAL_CODE').val();
			var TCA_REQ_TYPE			= $('#TCA_REQ_TYPE').val();
			var TCA_REQ_NO_REC			= $('#TCA_REQ_NO_REC').val();
			var TCA_REQ_NO_DEL			= $('#TCA_REQ_NO_DEL').val();
			var TCA_REQ_NO_BM			= $('#TCA_REQ_NO_BM').val();
			var TCA_BL					= $('#TCA_BL').val();
			var TCA_BL_DATE				= $('#TCA_BL_DATE').val();

			if (TCA_TERMINAL_CODE == 'not-selected') {
				alert("Please Choose Terminal !");
				return false;
			} else if (TCA_REQ_TYPE == 'not-selected') {
				alert("Please Choose Tipe Layanan !");
				return false;
			} else if (TCA_REQ_NO_REC == '' && TCA_REQ_NO_DEL == '' && TCA_REQ_NO_BM =='') {
				alert("Please Choose Nomor Request !");
				return false;
			} else if (TCA_BL == 'not-selected') {
				alert("Please Choose Nomor BL !");
				return false;
			}else if (TCA_BL_DATE == '') {
				alert("Please Choose Tanggal BL !");
				return false;
			}else{
				$('#show-detail').removeClass('hidden_content');
				return false;
			}

		});


		$('#TCA_BL').on('change', function () {
			clearTCAListTruck();
		});

		// show hide no req
		$('#TCA_REQ_TYPE').on('change', function(){
			var TCA_REQ_TYPE = $(this).val();
			if (TCA_REQ_TYPE == 1){
				$('#layanan_REC').removeClass('hidden_content');
				$('#hidden_bl').removeClass('hidden_content');
			}else{
				$('#layanan_REC').addClass('hidden_content');
			}

			if (TCA_REQ_TYPE == 2){
				$('#layanan_DEL').removeClass('hidden_content');
				$('#hidden_bl').removeClass('hidden_content');
			}else{
				$('#layanan_DEL').addClass('hidden_content');
			}

			if (TCA_REQ_TYPE == 3){
				$('#layanan_BM').removeClass('hidden_content');
				$('#hidden_bl').removeClass('hidden_content');
			}else{
				$('#layanan_BM').addClass('hidden_content');
			}

			//clearTCAListTruck();
		});

		//FORM NO DEL DISABLED
		$("#TCA_BL").prop('disabled', true);
		$('#TCA_REQ_NO_DEL').keyup(function(){
			$("#TCA_BL").prop('disabled', false);
		});

		//FORM NO REC DISABLED
		$("#TCA_BL").prop('disabled', true);
		$('#TCA_REQ_NO_REC').keyup(function(){
			$("#TCA_BL").prop('disabled', false);
		});

		//FORM NO BM DISABLED
		$("#TCA_BL").prop('disabled', true);
		$('#TCA_REQ_NO_BM').keyup(function(){
			$("#TCA_BL").prop('disabled', false);
		});

		// BTN DELETE TRUCK
		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			urut--;
			$(this).closest("tr").remove();
			var trckid = $(this).data('truckid');
			temptcaid = jQuery.grep(temptcaid, function(value) {
			  return value != trckid;
			});       
		});

		// TCA DATE
		$('#TCA_BL_DATE').datetimepicker({
			format: 'Y-m-d H:i'
		});

		// RECEIVING
		$('#TCA_REQ_NO_REC').autocomplete({
			minLength: 3,
			source: function( request, response ) {
				
				$.blockUI();
				$.ajax({
					url: "<?=ROOT?>npkbilling/tca/getNoRequestRec",
					type: 'post',
					dataType: "json",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						search:request.term
					},
					success: function( data ) {
						obj = data.length;
						if (obj == 0) {
							alert('data kosong');
						}else{
							response( data );	
						}
						$.unblockUI();
					}
				});
			},
			select: function (event, ui) {
				$('#TCA_REQ_NO_REC').val(ui.item.label);
				
				$.blockUI();
				$.ajax({
					type: "GET",
					url: "<?=ROOT?>npkbilling/tca/getNoBlRec?",
					data: {id:ui.item.label},
					success: function(data){
						if(!data){
						}
						var obj = JSON.parse(data);
						var record = obj;
						var toAppend = '';
						for(var i=0;i<record.length;i++){
							toAppend += '<option hdrrec="'+record[i]['hdr_rec_id']+'" dtlrec="'+record[i]['dtl_rec_id']+'" value="'+record[i]['dtl_rec_bl']+'">'+record[i]['dtl_rec_bl']+'</option>';
						}
						console.log(toAppend);
						$('#TCA_BL').find('option').remove().end().append('<option value="not-selected"> -- Please Choose No BL  -- </option>');
						$('#TCA_BL').append(toAppend);

						$.unblockUI();
					}
				});
				return false;
			}

		});

		//AUTOCOMPLETE
		$('#TCA_BL').on('change', function () {
	        var hdrrec = $(this).find('option:selected').attr('hdrrec');
	        var dtlrec = $(this).find('option:selected').attr('dtlrec');

	        $.blockUI();
	        $.ajax({
				url: "<?=ROOT?>npkbilling/tca/autocompletBlRec",
				type: 'GET',
				data: {
					id:hdrrec
				},
				success: function(data) {
					if(!data){
						return false;
					}
					
					var obj = JSON.parse(data);
					for (var ac = 0; ac < obj.length; ac++){
						if (dtlrec == obj[ac]['dtl_rec_id']) {

							$('#TCA_CUST_NAME').val(obj[ac]['rec_cust_name']);
							$('#TCA_CUST_ID').val(obj[ac]['rec_cust_id']);
							$('#TCA_REQ_DATE').val(obj[ac]['rec_date']);
							$('#TCA_VESSEL_NAME').val(obj[ac]['rec_vessel_name']);
							$('#TCA_VESSEL_CODE').val(obj[ac]['rec_vessel_code']);
							$('#TCA_PKG_NAME').val(obj[ac]['dtl_pkg_name']);
							$('#TCA_PKG_ID').val(obj[ac]['dtl_pkg_id']);
							$('#TCA_QTY').val(obj[ac]['dtl_qty']);
							$('#TCA_UNIT_NAME').val(obj[ac]['dtl_unit_name']);
							$('#TCA_UNIT_ID').val(obj[ac]['dtl_unit_id']);
							$('#TCA_HS_CODE').val('');
							$('#TCA_TRADE_NAME').val(obj[ac]['rec_trade_name']);
							$('#TCA_TRADE_TYPE').val(obj[ac]['rec_trade_type']);

							$.unblockUI();
						}
					}
				}

			});
	        clearTCAListTruck();
	    });
	    //END


	    // DELIVERY
		$('#TCA_REQ_NO_DEL').autocomplete({
			minLength: 3,
			source: function( request, response ) {
				
				$.blockUI();
				$.ajax({
					url: "<?=ROOT?>npkbilling/tca/getNoRequestDel",
					type: 'post',
					dataType: "json",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						search:request.term
					},
					success: function( data ) {
						obj = data.length;
						if (obj == 0) {
							alert('data kosong');
						}else{
							response( data );	
						}
						$.unblockUI();
					}
				});
			},
			select: function (event, ui) {
				$('#TCA_REQ_NO_DEL').val(ui.item.label);
				
				$.blockUI();
				$.ajax({
					type: "GET",
					url: "<?=ROOT?>npkbilling/tca/getNoBlDel?",
					data: {id:ui.item.label},
					success: function(data){
						if(!data){
						}
						var obj = JSON.parse(data);
						var record = obj;
						var toAppend = '';
						for(var i=0;i<record.length;i++){
							toAppend += '<option hdrdel="'+record[i]['hdr_del_id']+'" dtldel="'+record[i]['dtl_del_id']+'" value="'+record[i]['dtl_del_bl']+'">'+record[i]['dtl_del_bl']+'</option>';
						}
						console.log(toAppend);
						$('#TCA_BL').find('option').remove().end().append('<option value="not-selected"> -- Please Choose No BL  -- </option>');
						$('#TCA_BL').append(toAppend);

						$.unblockUI();
					}
				});
				return false;
			}

		});

		//AUTOCOMPLETE
		$('#TCA_BL').on('change', function () {
	        var hdrdel = $(this).find('option:selected').attr('hdrdel');
	        var dtldel = $(this).find('option:selected').attr('dtldel');

	        $.blockUI();
	        $.ajax({
				url: "<?=ROOT?>npkbilling/tca/autocompletBlDel",
				type: 'GET',
				data: {
					id:hdrdel
				},
				success: function(data) {
					if(!data){
						return false;
					}
					
					var obj = JSON.parse(data);
					for (var ac = 0; ac < obj.length; ac++){
						if (dtldel == obj[ac]['dtl_del_id']) {

							$('#TCA_CUST_NAME').val(obj[ac]['del_cust_name']);
							$('#TCA_CUST_ID').val(obj[ac]['del_cust_id']);
							$('#TCA_REQ_DATE').val(obj[ac]['del_date']);
							$('#TCA_VESSEL_NAME').val(obj[ac]['del_vessel_name']);
							$('#TCA_VESSEL_CODE').val(obj[ac]['del_vessel_code']);
							$('#TCA_PKG_NAME').val(obj[ac]['dtl_pkg_name']);
							$('#TCA_PKG_ID').val(obj[ac]['dtl_pkg_id']);
							$('#TCA_QTY').val(obj[ac]['dtl_qty']);
							$('#TCA_UNIT_NAME').val(obj[ac]['dtl_unit_name']);
							$('#TCA_UNIT_ID').val(obj[ac]['dtl_unit_id']);
							$('#TCA_HS_CODE').val('');
							$('#TCA_TRADE_NAME').val(obj[ac]['del_trade_name']);
							$('#TCA_TRADE_TYPE').val(obj[ac]['del_trade_type']);
						}
					}

					$.unblockUI();
				}

			});
			return false;
			clearTCAListTruck();
	    });
	    //END

	     // BONGKAR MUAT
		$('#TCA_REQ_NO_BM').autocomplete({
			minLength: 3,
			source: function( request, response ) {
				
				$.blockUI();
				$.ajax({
					url: "<?=ROOT?>npkbilling/tca/getNoRequestBm",
					type: 'post',
					dataType: "json",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						search:request.term
					},
					success: function( data ) {
						console.log(data);
						obj = data.length;
						if (obj == 0) {
							alert('data kosong');
						}else{
							response( data );	
						}
						$.unblockUI();
					}
				});
			},
			select: function (event, ui) {
				$('#TCA_REQ_NO_BM').val(ui.item.label);
				
				$.blockUI();
				$.ajax({
					type: "GET",
					url: "<?=ROOT?>npkbilling/tca/getNoBlBm?",
					data: {id:ui.item.label},
					success: function(data){
						if(!data){
						}
						var obj = JSON.parse(data);
						var record = obj;
						var toAppend = '';
						for(var i=0;i<record.length;i++){
							toAppend += '<option hdrbm="'+record[i]['hdr_bm_id']+'" dtlbm="'+record[i]['dtl_bm_id']+'" value="'+record[i]['dtl_bm_bl']+'">'+record[i]['dtl_bm_bl']+'</option>';
						}
						$('#TCA_BL').find('option').remove().end().append('<option value="not-selected"> -- Please Choose No BL  -- </option>');
						$('#TCA_BL').append(toAppend);

						$.unblockUI();
					}
				});
				return false;
			}

		});

		//AUTOCOMPLETE
		$('#TCA_BL').on('change', function () {
	        var hdrbm = $(this).find('option:selected').attr('hdrbm');
	        var dtlbm = $(this).find('option:selected').attr('dtlbm');

	        $.blockUI();
	        $.ajax({
				url: "<?=ROOT?>npkbilling/tca/autocompletBlBm",
				type: 'GET',
				data: {
					id:hdrbm
				},
				success: function(data) {
					if(!data){
						return false;
					}
					
					var obj = JSON.parse(data);

					for (var ac = 0; ac < obj.length; ac++){
						if (dtlbm == obj[ac]['dtl_bm_id']) {
							$('#TCA_CUST_NAME').val(obj[ac]['bm_cust_name']);
							$('#TCA_CUST_ID').val(obj[ac]['bm_cust_id']);
							$('#TCA_REQ_DATE').val(obj[ac]['bm_date']);
							$('#TCA_VESSEL_NAME').val(obj[ac]['bm_vessel_name']);
							$('#TCA_VESSEL_CODE').val(obj[ac]['bm_vessel_code']);
							$('#TCA_PKG_NAME').val(obj[ac]['dtl_pkg_name']);
							$('#TCA_PKG_ID').val(obj[ac]['dtl_pkg_id']);
							$('#TCA_QTY').val(obj[ac]['dtl_qty']);
							$('#TCA_UNIT_NAME').val(obj[ac]['dtl_unit_name']);
							$('#TCA_UNIT_ID').val(obj[ac]['dtl_unit_id']);
							$('#TCA_TRADE_NAME').val(obj[ac]['bm_trade_name']);
							$('#TCA_TRADE_TYPE').val(obj[ac]['bm_trade_type']);
						}
					}

					$.unblockUI();
				}

			});
			return false;
			clearTCAListTruck();
	    });
	    //END

		//GET TRUCK 
		$('#tid').autocomplete({
			minLength: 3,
			source: function( request, response ) {

				$.blockUI();
				$.ajax({
					url: "<?=ROOT?>npkbilling/tca/getTruckId",
					type: 'post',
					dataType: "json",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						search:request.term
					},
					success: function(msg) {
						var obj = msg.length;
						if (obj == 0) {
							alert('Data kosong');
						}else{
							response(msg);	
						}
						$.unblockUI();	
					}
				});
			},
			select: function (event, ui) {
				$('#tid').val(ui.item.value);
				$('#TRUCK_TYPE').val(ui.item.truck_type);
				$('#TRUCK_TYPE_NAME').val(ui.item.truck_type_name);
				$('#TRUCK_CUST_ID').val(ui.item.truck_cust_id);
				$('#TRUCK_CUST_NAME').val(ui.item.truck_cust_name);
				
				return false;
			}
		});

		//terminal
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/mdm/get_terminalList",
			success: function(data){
				var obj = JSON.parse(data);
				var toAppend = '';

				for(var i=0;i<obj.length;i++){
					toAppend += '<option value="' + obj[i]['ID_TERMINAL'] + '" brchid="' + obj[i]['BRANCH_ID'] + '" brchcode="' + obj[i]['BRANCH_CODE'] + '">' + obj[i]['TERMINAL_NAME'] + '</option>';
				}
				
				$('#TCA_TERMINAL_CODE').append(toAppend);
			}
		});
	});
	
	function getSelectedText(elementId) {
		var elt = document.getElementById(elementId);
		if(elt == null){
			return '';
		}else{
			if (elt.selectedIndex == -1)
				return null;
			return elt.options[elt.selectedIndex].text;
		}
	}

	function getnameterminal(sel) {
		var text = sel.options[sel.selectedIndex].text;
		$("#TCA_TERMINAL_NAME").val(text);
	}

	function getnametype(sel) {
		var text = sel.options[sel.selectedIndex].text;
		$("#TCA_REQ_TYPE_NAME").val(text);
	}

	function save_detail() {
		urut++;
		var TRUCK_ID			= $('#tid').val();
		var TRUCK_TYPE			= $('#TRUCK_TYPE').val();
		var TRUCK_TYPE_NAME		= $('#TRUCK_TYPE_NAME').val();
		var TRUCK_CUST_ID		= $('#TRUCK_CUST_ID').val();
		var TRUCK_CUST_NAME		= $('#TRUCK_CUST_NAME').val();
		
		$('#tid').val('');
		$('#TRUCK_TYPE').val('');
		$('#TRUCK_TYPE_NAME').val('');
		$('#TRUCK_CUST_ID').val('');
		$('#TRUCK_CUST_NAME').val('');

		if (temptcaid.indexOf(TRUCK_ID) != -1) {
			alert('truck telah ditambahkan');
			return false;
		}

		temptcaid.push(TRUCK_ID);

		$('#detail-list tbody').append(
			
			'<tr>' +
				'<td class="tbl_truck_id">'+ TRUCK_ID +'</td>' +
				'<td class="tbl_truck_type">'+ TRUCK_TYPE +'</td>' +
				'<td class="tbl_truck_type_name">'+ TRUCK_TYPE_NAME +'</td>' +
				'<td class="tbl_cust_id">'+ TRUCK_CUST_ID +'</td>' +
				'<td class="tbl_cust_name">'+ TRUCK_CUST_NAME +'</td>' +
				'<td>' +
					'<button type="button" class="btn btn-primary btn-delete-detail" data-truckid="'+TRUCK_ID+'">Hapus</button>'+
				'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function(){ save_tca(); return false; });

	function save_tca() {
		$('#modal-default').modal('hide');
		var details = [];

		var TCA_REQ_TYPE = $("#TCA_REQ_TYPE").val();
		if (TCA_REQ_TYPE == 1) {
			var tca_req = $('#TCA_REQ_NO_REC').val();
		}else if (TCA_REQ_TYPE == 2) {
			var tca_req = $('#TCA_REQ_NO_DEL').val();
		}else if (TCA_REQ_TYPE == 3) {
			var tca_req = $('#TCA_REQ_NO_BM').val();
		}

		$('#detail-list tbody tr').each(function(){
			var truck_id 			= $(this).find('.tbl_truck_id').html(); 
			var truck_type 			= $(this).find('.tbl_truck_type').html(); 
			var truck_type_name 	= $(this).find('.tbl_truck_type_name').html(); 
			var truck_cust_id 		= $(this).find('.tbl_cust_id').html(); 
			var truck_cust_name 	= $(this).find('.tbl_cust_name').html();

			var temp = {
				"DTL_ID"            : null,
                "TCA_HDR_ID"        : null,
                "TCA_TRUCK_ID"      : truck_id,
                "TRUCK_TYPE"        : truck_type,
                "TRUCK_TYPE_NAME"   : truck_type_name,
                "TRUCK_CUST_ID"     : truck_cust_id,
                "TRUCK_CUST_NAME"   : truck_cust_name
			}
			details.push(temp);

			console.log(details);
		});

		arrData = {
            "action" : "saveheaderdetail",
            "data"   : ["HEADER", "DETAIL"],
            "HEADER": {
                "DB": "omcargo",
                "TABLE": "TX_HDR_TCA",
                "PK": "TCA_ID",
                "VALUE": [{

					"TCA_ID"                    : null,
                    "TCA_REQ_NO"                : tca_req,
                    "TCA_CUST_ID"               : $('#TCA_CUST_ID').val(),
                    "TCA_CUST_NAME"             : $('#TCA_CUST_NAME').val(),
                    "TCA_VESSEL_CODE"           : $('#TCA_VESSEL_CODE').val(),
                    "TCA_VESSEL_NAME"           : $('#TCA_VESSEL_NAME').val(),
                    "TCA_PKG_ID"                : $('#TCA_PKG_ID').val(),
                    "TCA_PKG_NAME"              : $('#TCA_PKG_NAME').val(),
                    "TCA_BL"                    : $('#TCA_BL').val(),
                    "TCA_BL_DATE"               : $('#TCA_BL_DATE').val(),
                    "TCA_HS_CODE"               : $('#TCA_HS_CODE').val(),
                    "TCA_UNIT_ID"               : $('#TCA_UNIT_ID').val(),
                    "TCA_TERMINAL_CODE"         : $('#TCA_TERMINAL_CODE').val(),
                    "TCA_TERMINAL_NAME"         : $('#TCA_TERMINAL_CODE option:selected').text(),
                    "TCA_REQ_TYPE"              : $('#TCA_REQ_TYPE').val(),
                    "TCA_REQ_TYPE_NAME"         : $('#TCA_REQ_TYPE_NAME').val(),
                    "TCA_UNIT_NAME"             : $('#TCA_UNIT_NAME').val(),
                    "TCA_QTY"                   : $('#TCA_QTY').val(),
                    "TCA_TRADE_TYPE"            : $('#TCA_TRADE_TYPE').val(),
                    "TCA_TRADE_NAME"            : $('#TCA_TRADE_NAME').val(),
                    "TCA_BRANCH_ID"				: $('#TCA_TERMINAL_CODE').find('option:selected').attr('brchid'),
					"TCA_BRANCH_CODE"			: $('#TCA_TERMINAL_CODE').find('option:selected').attr('brchcode'),
                    "TCA_REQ_DATE"              : $('#TCA_REQ_DATE').val(),
                    "TCA_STATUS"                : "1",
                    "TCA_CREATE_BY"             : null,
                    "APP_ID"                    : "2"

                }]
			},
            "DETAIL": {
               	"DB": "omcargo",
               	"TABLE": "TX_DTL_TCA",
                "FK": ["TCA_HDR_ID","tca_id"],
                "VALUE": (details.length > 0) ? details : []
             }
		}
			
		console.log(arrData);
		//return false;
		$.blockUI();

		var TCA_TERMINAL_CODE		= $('#TCA_TERMINAL_CODE').val();
		var TCA_REQ_TYPE			= $('#TCA_REQ_TYPE').val();
		var TCA_REQ_NO_REC			= $('#TCA_REQ_NO_REC').val();
		var TCA_REQ_NO_DEL			= $('#TCA_REQ_NO_DEL').val();
		var TCA_REQ_NO_BM			= $('#TCA_REQ_NO_BM').val();
		var TCA_BL					= $('#TCA_BL').val();
		var TCA_BL_DATE				= $('#TCA_BL_DATE').val();

		if (TCA_TERMINAL_CODE == 'not-selected') {
			$.unblockUI();
			alert("Please Choose Terminal !");
			return false;
		} else if (TCA_REQ_TYPE == 'not-selected') {
			$.unblockUI();
			alert("Please Choose Tipe Layanan !");
			return false;
		} else if (TCA_REQ_NO_REC == '' && TCA_REQ_NO_DEL == '' && TCA_REQ_NO_BM =='') {
			$.unblockUI();
			alert("Please Choose Nomor Request !");
			return false;
		} else if (TCA_BL == 'not-selected') {
			$.unblockUI();
			alert("Please Choose Nomor BL !");
			return false;
		}else if (TCA_BL_DATE == '') {
			$.unblockUI();
			alert("Please Choose Tanggal BL !");
			return false;
		}

		if(details.length == 0){
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}

		//return false;

		$.ajax({
			url: "<?=ROOT?>npkbilling/tca/createRequestTca/",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				console.log(data);
				var temp = JSON.parse(data.data);
				var no_req = temp['header']['tca_req_no'];
				
				if (data.success === 'S') {
					var notification = new NotificationFx({
						message : '<p>Data '+no_req+'  Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					tca_log(no_req);

					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/tca"; }, 3000);	
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}

	function tca_log(no_req) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/insert_tca_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 			: no_req

			},
			success: function( data ) {
				console.log(data);

			}
		});
	}
</script>	
