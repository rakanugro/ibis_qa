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
						<input type="text" name="TCA_TERMINAL_NAME" id="TCA_TERMINAL_NAME" class="form-control" readonly>
						<input type="hidden" name="TCA_TERMINAL_CODE" id="TCA_TERMINAL_CODE" class="form-control" readonly>
						<input type="hidden" name="TCA_BRANCH_CODE" id="TCA_BRANCH_CODE" class="form-control" readonly>
						<input type="hidden" name="TCA_BRANCH_ID" id="TCA_BRANCH_ID" class="form-control" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label>Tipe Layanan</label>
						<span style="color: red">*</span>
						<input type="text" name="TCA_REQ_TYPE_NAME" id="TCA_REQ_TYPE_NAME" class="form-control" readonly>
						<input type="hidden" name="TCA_REQ_TYPE" id="TCA_REQ_TYPE" class="form-control" readonly>
					</div>
					<div class="form-group col-lg-6">
						<label for="datepickerDate">Nomor Request</label>
						<span style="color: red">*</span>
						<input name="TCA_REQ_NO" id="TCA_REQ_NO" type="text" class="form-control getBLDel" placeholder="Autocomplete" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">BL/SI/DO</label>
						<span style="color: red">*</span>
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
						<span style="color: red">*</span>
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
					<form>
						<div class="form-inline" role="form">
							<div class="form-group">
								<label for="exampleTooltip">TRUCK ID / TRUCK NUMBER</label>
								<input id="DTL_ID" name="DTL_ID" type="hidden" class="form-control">	
								<input id="TCA_HDR_ID" name="TCA_HDR_ID" type="hidden" class="form-control">	
								<input id="tid" name="truck_id" type="text" class="form-control" placeholder="Truck ID">	
								<input id="TRUCK_TYPE" name="TRUCK_TYPE" type="text" class="form-control" readonly>	
								<input id="TRUCK_TYPE_NAME" name="TRUCK_TYPE_NAME" type="text" class="form-control" readonly>
								<input id="TRUCK_CUST_ID" name="TRUCK_CUST_ID" type="text" class="form-control" readonly>
								<input id="TRUCK_CUST_NAME" name="TRUCK_CUST_NAME" type="text" class="form-control" readonly>
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
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="detail-list">
							<thead>
								<tr>
									<!-- <th width='50px'>TCA DTL ID</th>
									<th width='50px'>TCA HEADER ID</th> -->
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
						<button id="submit_header" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
						<button id="submit_header" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
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
        			<button type="button" id="btn-modal-kirim" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Save</button>
        		</div>
        	</div>
  		</div>
	</div>


<script>
	var urut = 0;
	var temptcaid = new Array();

	$(document).ready(function() {

	  	$("#btn-detail").prop('disabled', true);
		$('#tid').keyup(function(){
			if ($('#tid').val() != ''){
				$("#btn-detail").prop('disabled', false);
			}else{
				$("#btn-detail").prop('disabled', true);
			}
		});

		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			urut--;
			$(this).closest("tr").remove();      
			var trckid = $(this).data('truckid');
			temptcaid = jQuery.grep(temptcaid, function(value) {
			  return value != trckid;
			});    
		});
		//GET TRUCK 
		$('#tid').autocomplete({
			minLength : 3,
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
				$('#tid').val(ui.item.value);
				$('#TRUCK_TYPE').val(ui.item.truck_type);
				$('#TRUCK_TYPE_NAME').val(ui.item.truck_type_name);
				$('#TRUCK_CUST_ID').val(ui.item.truck_cust_id);
				$('#TRUCK_CUST_NAME').val(ui.item.truck_cust_name);
				
				return false;
			}
		});
	});

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
			        	$('#TCA_BRANCH_ID').val(item.tca_branch_id);
			        	$('#TCA_BRANCH_CODE').val(item.tca_branch_code);
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
						temptcaid.push(abc.tca_truck_id);
						table.append(
						    '<tr>' +
						       	// '<td class="tbl_dtl_id">'+ abc.dtl_id +'</td>' +
						       	// '<td class="tbl_tca_hdr_id">'+ abc.tca_hdr_id +'</td>' +
						       	'<td class="tbl_truck_id">'+ abc.tca_truck_id +'</td>' +
						       	'<td class="tbl_truck_type">'+ abc.truck_type +'</td>' +
						       	'<td class="tbl_truck_type_name">'+ abc.truck_type_name +'</td>' +
						       	'<td class="tbl_cust_id">'+ abc.truck_cust_id +'</td>' +
						       	'<td class="tbl_cust_name">'+ abc.truck_cust_name +'</td>' +
						       	'<td>' +
										'<button type="button" class="btn btn-primary btn-delete-detail" data-truckid="'+abc.tca_truck_id+'">Delete</button>'+
								'</td>' +
							'</tr>'
					    );
					    $("#detail-list").DataTable();
				  	});
		      	}
		    }
	    })


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

		$('#detail-list').append(
			
			'<tr>' +
				// '<td class="tbl_dtl_id"></td>' +
				// '<td class="tbl_tca_hdr_id"></td>' +
				'<td class="tbl_truck_id">'+TRUCK_ID+'</td>' +
				'<td class="tbl_truck_type">'+TRUCK_TYPE+'</td>' +
				'<td class="tbl_truck_type_name">'+TRUCK_TYPE_NAME+'</td>' +
				'<td class="tbl_cust_id">'+TRUCK_CUST_ID+'</td>' +
				'<td class="tbl_cust_name">'+TRUCK_CUST_NAME+'</td>' +
				'<td>' +
					'<button type="button" class="btn btn-primary btn-delete-detail" data-truckid="'+TRUCK_ID+'">Delete</button>'+
				'</td>' +
			'</tr>'
		);
	}

	$('#btn-modal-kirim').click(function(){ update_tca(); return false; });

	function update_tca() {
		$('#modal-default').modal('hide');
		var details = [];

		$('#detail-list tbody tr').each(function(){
			var dtl_id 				= $(this).find('.tbl_dtl_id').html(); 
			var tca_hdr_id 			= $(this).find('.tbl_tca_hdr_id').html(); 
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

		});

		arrData = {
            "action" : "saveheaderdetail",
            "data"   : ["HEADER", "DETAIL"],
            "HEADER": {
                "DB": "omcargo",
                "TABLE": "TX_HDR_TCA",
                "PK": "TCA_ID",
                "VALUE": [{

					"TCA_ID"                    : $('#TCA_ID').val(),
                    "TCA_REQ_NO"                : $('#TCA_REQ_NO').val(),
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
                    "TCA_TERMINAL_NAME"         : $('#TCA_TERMINAL_NAME').val(),
                    "TCA_REQ_TYPE"              : $('#TCA_REQ_TYPE').val(),
                    "TCA_REQ_TYPE_NAME"         : $('#TCA_REQ_TYPE_NAME').val(),
                    "TCA_UNIT_NAME"             : $('#TCA_UNIT_NAME').val(),
                    "TCA_QTY"                   : $('#TCA_QTY').val(),
                    "TCA_TRADE_TYPE"            : $('#TCA_TRADE_TYPE').val(),
                    "TCA_TRADE_NAME"            : $('#TCA_TRADE_NAME').val(),
                    "TCA_BRANCH_ID"             : $('#TCA_BRANCH_ID').val(),
                    "TCA_BRANCH_CODE"           : $('#TCA_BRANCH_CODE').val(),
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

		if(details.length == 0){
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}
		
		var tca_req_no =  $('#TCA_REQ_NO').val();
		
		$.ajax({
			url: "<?=ROOT?>npkbilling/tca/updateRequestTca/",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				if (data.success === 'S') {
					var notification = new NotificationFx({
						message : '<p>Data Berhasil '+tca_req_no+' Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					tca_log(tca_req_no);

					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/tca"; }, 3000);	
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}

	function tca_log(tca_req_no) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/update_tca_log",
			type: 'POST',
			//dataType: 'json',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				no_req 			: tca_req_no

			},
			success: function( data ) {
				console.log(data);

			}
		});
	}
</script>	
