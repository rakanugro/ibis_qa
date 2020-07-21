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
						<input type="text" name="TCA_TERMINAL_NAME" id="TCA_TERMINAL_NAME" class="form-control" readonly>
						<input type="hidden" name="TCA_TERMINAL_CODE" id="TCA_TERMINAL_CODE" class="form-control" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label>Tipe Layanan</label>
						<input type="text" name="TCA_REQ_TYPE_NAME" id="TCA_REQ_TYPE_NAME" class="form-control" readonly>
						<input type="hidden" name="TCA_REQ_TYPE" id="TCA_REQ_TYPE" class="form-control" readonly>
					</div>
					<div class="form-group col-lg-6">
						<label for="datepickerDate">Nomor Request</label>
						<input name="TCA_REQ_NO" id="TCA_REQ_NO" type="text" class="form-control getBLDel" placeholder="Autocomplete" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">BL/SI/DO</label>
						<input name="TCA_BL" id="TCA_BL" type="text" class="form-control" placeholder="Vessel" readonly>
						<input name="TCA_ID" id="TCA_ID" type="hidden" class="form-control" placeholder="Autocomplete" readonly>
					</div>
					<div class="form-group col-lg-6">
						<label for="datepickerDate">Nama Customer</label>
						<input name="TCA_CUST_NAME" id="TCA_CUST_NAME" type="text" class="form-control" placeholder="Nama Customer" readonly>
						<input name="TCA_CUST_ID" id="TCA_CUST_ID" type="hidden" class="form-control" placeholder="Nama Customer" readonly>
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
						<input name="TCA_VESSEL_CODE" id="TCA_VESSEL_CODE" type="hidden" class="form-control" placeholder="Vessel" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal BL</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="TCA_BL_DATE" name="TCA_BL_DATE" type="text" class="form-control" placeholder="Tanggal BL" id="datepickerDate" readonly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Kemasan</label>
						<input type="text" name="TCA_PKG_NAME" id="TCA_PKG_NAME" class="form-control" placeholder="Kemasan" readonly>
						<input type="hidden" name="TCA_PKG_IDE" id="TCA_PKG_ID" class="form-control" placeholder="Kemasan" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Quantity</label>
						<input name="TCA_QTY" id="TCA_QTY" type="number" class="form-control" placeholder="Quantity" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Satuan</label>
						<input name="TCA_UNIT_NAME" id="TCA_UNIT_NAME" type="text" class="form-control" placeholder="Satuan" readonly>
						<input name="TCA_UNIT_ID" id="TCA_UNIT_ID" type="hidden" class="form-control" placeholder="Satuan" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Hscode</label>
						<input name="TCA_HS_CODE" id="TCA_HS_CODE" type="text" class="form-control" placeholder="Hscode" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<input type="text" name="TCA_TRADE_NAME" id="TCA_TRADE_NAME" class="form-control" placeholder="Tipe Perdagangan" readonly>
						<input type="hidden" name="TCA_TRADE_TYPE" id="TCA_TRADE_TYPE" class="form-control" placeholder="Tipe Perdagangan" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="detail-list">
							<thead>
								<tr>
									<th width='50px'>NO</th>
									<!-- <th width='50px'>TCA DTL ID</th> -->
									<!-- <th>TCA HEADER ID</th> -->
									<th width='50px'>TID</th>
									<th width='50px'>Vechile Type ID</th>
									<th width='50px'>Vechile Type</th>
									<th width='50px'>Truck Company ID</th>
									<th width='50px'>Truck Company Name</th>
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
						<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>					
					</div>
				</div>
			</div>
		</div>
	</div>	


<script>
	var urut = 0;

	function goBack() {
		window.history.back();
	}

	$.blockUI();
	$.ajax({
		url: "<?=ROOT?>npkbilling/tca/getUpdateTca?id="+<?php echo $tca_id;?>,
	    type: "GET",
	    dataType : 'json',
	    success: function (data) {
	       	if(data.HEADER != ""){
				arrData = JSON.parse(data);
				console.log(arrData);
				arrData.HEADER.forEach(function(item, index){
			        $('#TCA_TERMINAL_NAME').val(item.tca_terminal_name);
			        $('#TCA_TERMINAL_CODE').val(item.tca_terminal_code);
			        $('#TCA_REQ_DATE').val(item.tca_req_date);
			        $('#TCA_REQ_TYPE_NAME').val(item.tca_req_type_name);
			        $('#TCA_REQ_TYPE').val(item.tca_req_type);
			        $('#TCA_REQ_NO').val(item.tca_req_no);
			        $('#TCA_ID').val(item.tca_id);
			        $('#TCA_CUST_NAME').val(item.tca_cust_name);
			        $('#TCA_CUST_ID').val(item.tca_cust_id);
			        $('#TCA_VESSEL_NAME').val(item.tca_vessel_name);
			        $('#TCA_VESSEL_CODE').val(item.tca_vessel_code);
			        $('#TCA_BL').val(item.tca_bl);
			        $('#TCA_BL_DATE').val(item.tca_bl_date);
			        $('#TCA_PKG_NAME').val(item.tca_pkg_name);
			        $('#TCA_PKG_ID').val(item.tca_pkg_id);
			        $('#TCA_QTY').val(item.tca_qty);
			        $('#TCA_UNIT_NAME').val(item.tca_unit_name);
			        $('#TCA_UNIT_ID').val(item.tca_unit_id);
			        $('#TCA_HS_CODE').val(item.tca_hs_code);
			        $('#TCA_TRADE_NAME').val(item.tca_trade_name);
			        $('#TCA_TRADE_TYPE').val(item.tca_trade_type);
					$.unblockUI();
				});

				var table = $("#detail-list");
				var Nomor = 1;
				arrData.DETAIL.forEach(function(abc, index){
					table.append(
						'<tr>' +
						    '<td>'+ Nomor++ +'</td>' +
						    // '<td>'+ abc.dtl_id +'</td>' +
						    // '<td>'+ abc.tca_hdr_id +'</td>' +
						    '<td>'+ abc.tca_truck_id +'</td>' +
						    '<td>'+ abc.truck_type +'</td>' +
						    '<td>'+ abc.truck_type_name +'</td>' +
						    '<td>'+ abc.truck_cust_id +'</td>' +
						    '<td>'+ abc.truck_cust_name +'</td>' +
						'</tr>'
					);
					$("#detail-list").DataTable();
				});
		    }
		}
	})
</script>	
