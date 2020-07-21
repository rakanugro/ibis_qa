
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

.upload_info {
    font-size: small;
    font-style: italic;
    float: right;
}
.hidden_content {
	display: none;
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
					<div class="form-group col-xs-12" hidden="true">
						<label for="exampleTooltip">Uper ID</label>
						<input name="UPER_ID" id="UPER_ID" type="text" class="form-control" placeholder="Uper ID" readonly value="<?php echo $data; ?>">
					</div>
					<div class="form-group col-xs-12" hidden="true">
						<label for="exampleTooltip">Nota ID</label>
						<input name="NOTA_ID" id="NOTA_ID" type="text" class="form-control" placeholder="Uper ID" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Tanggal Request</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input id="UPER_DATE" name="UPER_DATE" type="text" class="form-control" placeholder="Tanggal Request" id="datepickerDate" readonly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Nomor Request</label>
						<input name="UPER_REQ_NO" id="UPER_REQ_NO" type="text" class="form-control" placeholder="Nomor Request" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Terminal</label>
						<input name="UPER_TERMINAL_CODE" id="UPER_TERMINAL_CODE" type="text" class="form-control" placeholder="Terminal" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>PBM</label>
						<input name="UPER_PBM_NAME" id="UPER_PBM_NAME" type="text" class="form-control" placeholder="-" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<input name="UPER_TRADE_NAME" id="UPER_TRADE_NAME" type="text" class="form-control" placeholder="Tipe Perdagangan" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Shipping Agent</label>
						<input name="UPER_SHIPPING_AGENT_NAME" id="UPER_SHIPPING_AGENT_NAME" type="text" class="form-control" placeholder="-" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Nomor Uper</label>
						<input name="UPER_NO" id="UPER_NO" type="text" class="form-control" placeholder="Nomor Uper" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label>Debitur</label>
						<input name="UPER_CUST_NAME" id="UPER_CUST_NAME" type="text" class="form-control" placeholder="Debitur" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail Tagihan</b></h2>
				</header>

				<div id="bd-penumpukan" hidden="true">
					<header class="main-box-header clearfix">
						<h2><b>Penumpukan</b></h2>
					</header>
					<div class="main-box-body clearfix">
						<table id="penumpukan" class=" table order-list list_file">
							<thead>
								<tr>
									<th rowspan="2">No</th>
									<th rowspan="2">BL/SI/DO</th>
									<th rowspan="2">Kemasan</th>
									<th rowspan="2">Barang</th>
									<th rowspan="2">QTY</th>
									<th rowspan="2">Satuan</th>
									<th colspan="2" style="text-align: center;">Hari</th>
									<th colspan="2" style="text-align: center;">Tarif</th>
									<th rowspan="2" style="text-align: center;">Total</th>
								</tr>
								<tr>
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
				</div>
	
				<div id="bd-handling" hidden="true">
					<header class="main-box-header clearfix">
						<h2><b>Handling</b></h2>
					</header>
					<div class="main-box-body clearfix">
						<table id="layanan" class=" table order-list list_file">
							<thead>
								<tr>
									<th style="text-align: left;">No</th>
									<th style="text-align: left;">Layanan</th>
									<th style="text-align: left;">BL/SI/DO</th>
									<th style="text-align: left;">Barang</th>
									<th style="text-align: center;">QTY</th>
									<th style="text-align: center;">Tarif Dasar</th>
									<th style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>

				<div id="bd-alat" hidden="true">
					<header class="main-box-header clearfix">
						<h2><b>Alat</b></h2>
					</header>

					<div class="main-box-body clearfix">
						<table id="alat" class=" table order-list list_file">
							<thead>
								<tr>
									<th style="text-align: left;">No</th>
									<th style="text-align: left;">Layanan</th>
									<th style="text-align: left;">Nama Alat</th>
									<th style="text-align: center;">Satuan Alat</th>
									<th style="text-align: center;">Jumlah Alat</th>
									<th style="text-align: center;">Jumlah/Durasi Pemakaian</th>
									<th style="text-align: center;">Tarif Dasar</th>
									<th style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>

				<div id="bd-rupa" hidden="true">
					<header class="main-box-header clearfix">
						<h2><b>Rupa - Rupa</b></h2>
					</header>
					<div class="main-box-body clearfix">
						<table id="rupa" class=" table order-list list_file">
							<thead>
								<tr>
									<th style="text-align: left;">No</th>
									<th style="text-align: left;">Layanan</th>
									<!-- <th>BL/SI/DO</th> -->
									<!-- <th>Barang</th> -->
									<th style="text-align: center;">QTY</th>
									<th style="text-align: center;">Tarif Dasar</th>
									<th style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
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
	$(document).ready(function() {
		$.blockUI();
		var uper_id = $("#UPER_ID").val();


		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/uper/getDataUper?uper_id="+ uper_id,
	    	data: {},
		    success: function(data){
		    	// console.log(data);
				var obj = JSON.parse(JSON.parse(data));
	 			// console.log(obj);
	 	  		var arr =[];
	 			var jmlresponse = obj['result']['length'];
	 			// console.log(jmlresponse);

				obj['result'].forEach(function(abc) {
					$("#UPER_DATE").val(abc.uper_date);
					$("#UPER_REQ_NO").val(abc.uper_req_no);
					$("#UPER_TERMINAL_CODE").val(abc.uper_terminal_name);
					$("#UPER_PBM_NAME").val(abc.uper_pbm_name);
					$("#UPER_TRADE_NAME").val(abc.uper_trade_name);
					$("#UPER_SHIPPING_AGENT_NAME").val(abc.uper_shipping_agent_name);
					$("#UPER_NO").val(abc.uper_no);
					$("#UPER_CUST_NAME").val(abc.uper_cust_name);
					$("#NOTA_ID").val(abc.uper_nota_id);
					$("#UPER_DPP").val(abc.uper_dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
					$("#UPER_PPN").val(abc.uper_ppn.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
					$("#UPER_AMOUNT").val(abc.uper_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

					var penumpukan_id = "1";
					var handling_id = "2";
					var alat_id = "3";
					var rupa_id = "4";
					var table_penumpukan = "#penumpukan";
					var table_handling = "#layanan";
					var table_alat = "#alat";
					var table_rupa = "#rupa";

					var where = [["UPER_HDR_ID", "=", abc.uper_id]];

					if (abc.uper_nota_id == "13" || abc.uper_nota_id == 13) {
						getGroupTariffId(abc.uper_nota_id, handling_id, where, table_handling);
						getGroupTariffId(abc.uper_nota_id, alat_id, where, table_alat);
						getGroupTariffId(abc.uper_nota_id, rupa_id, where, table_rupa);
						$("#bd-handling").show();
						$("#bd-alat").show();
						$("#bd-rupa").show();
					} else {
						getGroupTariffId(abc.uper_nota_id, penumpukan_id, where, table_penumpukan);
						getGroupTariffId(abc.uper_nota_id, handling_id, where, table_handling);
						getGroupTariffId(abc.uper_nota_id, alat_id, where, table_alat);
						getGroupTariffId(abc.uper_nota_id, rupa_id, where, table_rupa);
						$("#bd-penumpukan").show();
						$("#bd-handling").show();
						$("#bd-alat").show();
						$("#bd-rupa").show();
					}
		       	});

				$('#UPER_DATE').datetimepicker({
					format: 'Y-m-d H:i'
				});
		 
		    }
		});

		function getGroupTariffId(nota_id, category, where, table){
			$.ajax({
			    type: "GET",
			   	url: "<?=ROOT?>npkbilling/uper/getGroupTariffId?nota_id="+ nota_id +"&category="+category,
		    	data: {},
			    success: function(data){
			    	var obj = JSON.parse(JSON.parse(data));
		 	  		var arr =[];
		 			var jmlresponse = obj['result']['length'];
			    	// console.log(obj);

			    	arrGroupTariff = [];
			    	obj['result'].forEach(function(abc) {
					    arrGroupTariff.push(abc.group_tariff_id);
			       	});

			    	arrGroupedTariff = [
			    		"DTL_GROUP_TARIFF_ID",
			    		arrGroupTariff
			    	];
			    	// console.log(arrGroupedTariff);
			    	onLoadTariff(where, arrGroupedTariff, category)
			    }
			});
		}

		function onLoadTariff(where, whereIn, category){
			$.ajax({
			    type: "GET",
			   	url: "<?=ROOT?>npkbilling/uper/onLoadTariff?where="+ JSON.stringify(where) +"&whereIn="+JSON.stringify(whereIn),
		    	data: {},
			    success: function(data){
			    	var obj = JSON.parse(JSON.parse(data));
		 	  		var arr =[];
		 			// var jmlresponse = obj['result']['length'];
			    	// console.log(obj);
			    	if (category == 1 || category == "1") {
 				    	setDataPenumpukan(obj);
			    	} else if (category == 2 || category == "2") {
 				    	setDataHandling(obj);
			    	} else if (category == 3 || category == "3") {
 				    	setDataAlat(obj);
			    	} else if (category == 4 || category == "4") {
 				    	setDataRupa(obj);
			    	}
			    }
			});
		}

		function setDataPenumpukan(obj){
			var table = $("#penumpukan tbody");
			var jmlresponse = obj['result']['length'];

			if (jmlresponse == 0 ) {
 				$("#bd-penumpukan").hide();
 			} else {
				var no = 1;
	 			obj['result'].forEach(function(abc) {
	 				masa1 = (abc.masa1 != null) ? abc.masa1 : "N/A";
	 				masa2 = (abc.masa2 != null) ? abc.masa2 : "N/A";
	 				trf1up = (abc.trf1up != null) ? abc.trf1up : "N/A";
	 				trf2up = (abc.trf2up != null) ? abc.trf2up : "N/A";
				    table.append(
						'<tr>' +
						'<td>'+ no++ +'</td>' +
					    '<td>'+ abc.dtl_bl +'</td>' +
					    '<td>'+ abc.dtl_package +'</td>' +
					    '<td>'+ abc.dtl_commodity +'</td>' +
					    '<td>'+ abc.dtl_qty +'</td>' +
					    '<td>'+ abc.dtl_unit_name +'</td>' +
					    '<td style="text-align: center;">'+ masa1 +'</td>' +
					    '<td style="text-align: center;">'+ masa2 +'</td>' +
					    '<td style="text-align: right;">'+ trf1up.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
					    '<td style="text-align: right;">'+ trf2up.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
					    '<td style="text-align: right;">'+ abc.dtl_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
					'</tr>'
			        );
		       	});
	 		}
			$("#penumpukan").DataTable();
			$.unblockUI();
		}

		function setDataHandling(obj){
			var table = $("#layanan tbody");
			var jmlresponse = obj['result']['length'];
 			// console.log(obj);
 			// console.log(jmlresponse);
 			if (jmlresponse == 0 ) {
 				$("#bd-handling").hide();
 			} else {
				var no = 1;
	 			obj['result'].forEach(function(abc) {
				    table.append(
				       '<tr>' +
							'<td style="text-align: left;">'+ no++ +'</td>' +
						    '<td style="text-align: left;">'+ abc.dtl_group_tariff_name +'</td>' +
						    '<td style="text-align: left;">'+ abc.dtl_bl +'</td>' +
						    '<td style="text-align: left;">'+ abc.dtl_commodity +'</td>' +
						    '<td style="text-align: center;">'+ abc.dtl_qty +'</td>' +
						    '<td style="text-align: right;">'+ abc.dtl_total_tariff.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						    '<td style="text-align: right;">'+ abc.dtl_dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						'</tr>'
			        );
		       	});
 			}
	 
			$("#layanan").DataTable();
			$.unblockUI();
		}

		function setDataAlat(obj){
			var table = $("#alat tbody");
			var jmlresponse = obj['result']['length'];
			// console.log(obj);
			// console.log(jmlresponse);
			if (jmlresponse == 0) {
				$("#bd-alat").hide()
			} else {
				var no = 1;
				obj['result'].forEach(function(abc) {
					table.append(
						'<tr>' +
						'<td style="text-align: left;">'+ no++ +'</td>' +
						'<td style="text-align: left;">'+ abc.dtl_group_tariff_name +'</td>' +
						'<td style="text-align: left;">'+ abc.dtl_equipment +'</td>' +
						'<td style="text-align: center;">'+ abc.dtl_unit_name +'</td>' +
						'<td style="text-align: center;">'+ abc.dtl_eq_qty +'</td>' +
						'<td style="text-align: center;">'+ abc.dtl_qty +'</td>' +
						'<td style="text-align: right;">'+ abc.dtl_total_tariff.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						'<td style="text-align: right;">'+ abc.dtl_dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						'</tr>'
						);
				});

				$("#alat").DataTable();
				$.unblockUI();
			}
		}

		function setDataRupa(obj){
			var table = $("#rupa tbody");
			var jmlresponse = obj['result']['length'];
 			// console.log(obj);
 			// console.log(jmlresponse);
 			if (jmlresponse == 0) {
				$("#bd-rupa").hide()
			} else {
				var no = 1;
	 			obj['result'].forEach(function(abc) {
				    table.append(
				       '<tr>' +
							'<td style="text-align: left;">'+ no++ +'</td>' +
						    '<td style="text-align: left;">'+ abc.dtl_group_tariff_name +'</td>' +
						    // '<td>'+ abc.dtl_bl +'</td>' +
						    // '<td>'+ abc.dtl_commodity +'</td>' +
						    '<td style="text-align: center;">'+ abc.dtl_qty +'</td>' +
						    '<td style="text-align: right;">'+ abc.dtl_total_tariff.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						    '<td style="text-align: right;">'+ abc.dtl_dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +'</td>' +
						'</tr>'
			        );
		       	});
	 		}
			$("#layanan").DataTable();
			$.unblockUI();
		}

	});

	function goBack() {
		window.history.back();
	}
</script>