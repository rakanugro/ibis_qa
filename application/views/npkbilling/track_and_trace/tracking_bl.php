
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
<script src="<?=CUBE_?>js/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>js/sweetalert2/dist/sweetalert2.min.css"/>

<style type="text/css">

.upload_info {
    font-size: small;
    font-style: italic;
    float: right;
}
.hidden_content {
	display: none;
}

table#table_detail_bl {
  border-collapse: collapse;
  width: 100%;
}

table#table_detail_bl th, td {
  text-align: left;
  padding: 8px;
}

table#table_detail_bl tr:nth-child(even) {background-color: #f2f2f2;}

</style>
							
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<div class="main-box clearfix">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Search Request</h2>
					</header>
					<div class="main-box-body clearfix">
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete">Terminal</label>
						<select id="terminal" name="terminal" class="form-control">
							<option value="not-selected"> -- Please Choose Terminal  -- </option>
						</select>
					</div>
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete">BL Number</label>
						<input class="form-control" id="bl_number" name="bl_number" placeholder="BL Number">
					</div>
					<div class="form-group example-twitter-oss">
						<input type="button" onclick="search_tracktrace()" value="Search" id="search_tracktrace" name="search_tracktrace" class="btn btn-danger"/>
						<input type="button" onclick="reset_input()" id="reset" name="reset" class="btn btn-primary" value="Reset"/>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row show_detail">
		<div class="col-lg-12">
			<div class="main-box">
				<div class="main-box clearfix">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Detail BL</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="table_detail_bl">
								<thead>
									<tr>
										<th>No</th>
										<th>No BL</th>
										<th>Jenis Curah</th>
										<th>Jenis Barang</th>
										<th>Jumlah</th>
										<th>Satuan</th>
										<th>Vessel</th>
										<th>PBM</th>
										<th>Jenis Perdagangan</th>
									</tr>	
								</thead>
								<tbody id="tbodydetailbl">
								</tbody>
							</table>
						</div>
						<!-- <table id="table_detail_bl">
							<tr>
								<td>No BL</td>
								<td>:</td>
								<td><span id="blNumber">0123 2345 2789</span></td>
							</tr>
							<tr>
								<td>Jenis Curah</td>
								<td>:</td>
								<td><span id="packageName">Curah Kering</span></td>
							</tr>
							<tr>
								<td>Jenis Barang</td>
								<td>:</td>
								<td><span id="cargoName">Gandum</span></td>
							</tr>
							<tr>
								<td>Jumlah</td>
								<td>:</td>
								<td><span id="quantity">10000</span></td>
							</tr>
							<tr>
								<td>Satuan</td>
								<td>:</td>
								<td><span id="unit">Ton</span></td>
							</tr>
							<tr>
								<td>Vessel</td>
								<td>:</td>
								<td><span id="vesselName">Moerisk / J00123</span></td>
							</tr>
							<tr>
								<td>PBM</td>
								<td>:</td>
								<td><span id="blCustName">PTP</span></td>
							</tr>
							<tr>
								<td>Jenis Perdagangan</td>
								<td>:</td>
								<td><span id="jenis_perdagangan">Internasional</span></td>
							</tr>
						</table> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row show_detail">
		<div class="col-lg-12">
			<div class="main-box">
				<div class="main-box clearfix">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Activity</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:black">
									<div class="panel-heading" style="background-color: #f2f2f2">
										<h4 class="panel-title" style="color: black">
											Gate In
										</h4>
									</div>
								</a>
								<div id="collapse1" class="panel-collapse collapse in">
									<div class="panel-body">
										<table class="table_activity">
											<tr>
												<td>Gate In Date</td>
												<td>:</td>
												<td><span id="muat_gate_in">-</span></td>
											</tr>
											<tr>
												<td>Truck Number</td>
												<td>:</td>
												<td><span id="muat_truck_number">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color:black">
									<div class="panel-heading" style="background-color: #f2f2f2">
										<h4 class="panel-title" style="color: black">
											Placement
										</h4>
									</div>
								</a>
								<div id="collapse2" class="panel-collapse collapse">
									<div class="panel-body">
										<table class="table_activity">
											<tr>
												<td>Placement Date</td>
												<td>:</td>
												<td><span id="muat_placement_date">-</span></td>
											</tr>
											<tr>
												<td>Location</td>
												<td>:</td>
												<td><span id="muat_location">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="color:black">
									<div class="panel-heading" style="background-color: #f2f2f2">
										<h4 class="panel-title" style="color: black">
											Stevedoring (Muat)
										</h4>
									</div>
								</a>
								<div id="collapse3" class="panel-collapse collapse">
									<div class="panel-body">
										<table class="table_activity">
											<tr>
												<td>Stevedoring Date</td>
												<td>:</td>
												<td><span id="stevedoring_muat_date">-</span></td>
											</tr>
											<tr>
												<td>Location</td>
												<td>:</td>
												<td><span id="stevedoring_muat_location">-</span></td>
											</tr>
											<tr>
												<td>To Vessel</td>
												<td>:</td>
												<td><span id="stevedoring_muat_to_vessel">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="color:black">
									<div class="panel-heading" style="background-color: #f2f2f2">
										<h4 class="panel-title" style="color: black">
											Stevedoring (Bongkar)
										</h4>
									</div>
								</a>
								<div id="collapse4" class="panel-collapse collapse">
									<div class="panel-body">
										<table class="table_activity">
											<tr>
												<td>Stevedoring Date</td>
												<td>:</td>
												<td><span id="stevedoring_bongkar_date">-</span></td>
											</tr>
											<tr>
												<td>Location</td>
												<td>:</td>
												<td><span id="stevedoring_bongkar_location">-</span></td>
											</tr>
											<tr>
												<td>From Vessel</td>
												<td>:</td>
												<td><span id="stevedoring_bongkar_from_vessel">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse5" style="color:black">
									<div class="panel-heading" style="background-color: #f2f2f2">
										<h4 class="panel-title" style="color: black">
											Placement
										</h4>
									</div>
								</a>
								<div id="collapse5" class="panel-collapse collapse">
									<div class="panel-body">
										<table class="table_activity">
											<tr>
												<td>Placement Date</td>
												<td>:</td>
												<td><span id="bongkar_placement_date">-</span></td>
											</tr>
											<tr>
												<td>Location</td>
												<td>:</td>
												<td><span id="bongkar_location">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse6" style="color:black">
									<div class="panel-heading" style="background-color: #f2f2f2">
										<h4 class="panel-title" style="color: black">
											Gate Out
										</h4>
									</div>
								</a>
								<div id="collapse6" class="panel-collapse collapse">
									<div class="panel-body">
										<table class="table_activity">
											<tr>
												<td>Gate Out Date</td>
												<td>:</td>
												<td><span id="bongkar_gate_out">-</span></td>
											</tr>
											<tr>
												<td>Truck Number</td>
												<td>:</td>
												<td><span id="bongkar_truck_number">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row show_detail">
		<div class="col-lg-12">
			<div class="main-box">
				<div class="main-box clearfix">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">History BL</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="table_history_bl">
								<thead>
									<tr>
										<th>NO</th>
										<th>REQUEST</th>
										<th>BOOKING NUMBER</th>
										<th>DATE</th>
										<th>STATUS UPER</th>
										<th>STATUS PROFORMA</th>
									</tr>	
								</thead>
								<tbody id="tbodytrackntrace">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
<script>
$(document).ready(function() {
    // $('#example').DataTable();
});

$(document).ready(function(){
	$('.show_detail').hide();
	$("#btn_trackReceiving").click(function(){
		$("#modal_trackReceiving").modal();
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
				
			$('#terminal').append(toAppend);
		}
	});
});

function reset_input(){
	$('#bl_number').val("");
	$('#terminal').val("");
}

function search_tracktrace(){
	var url = "<?=ROOT?>npkbilling/tracking_bl/search_tracktrace";
	var terminal = $('#terminal').val();
	var bl_number = $('#bl_number').val();
	$.blockUI();
	var tablebl = $("#table_detail_bl").DataTable();
	var table = $("#table_history_bl").DataTable();
	tablebl.clear().draw();
	table.clear().draw();
	$.ajax({
		url: url,
		type: 'POST',
		data: {
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',				
			terminal 		: terminal,
			bl_number 		: bl_number,
		},
		success:function(data) {
			var data_fix = JSON.parse(data);
			var obj_detail_bl = JSON.parse(data_fix['detail_bl']);
			var obj_activity = JSON.parse(data_fix['history_activity']);
			
			if(obj_detail_bl == null){
				Swal.fire({
		            icon: 'error',
		            title: 'Data Tidak Ada.',
		            showConfirmButton: false,
		            timer: 1500
		        });
				$(".show_detail").hide();
			}else{
				if (obj_detail_bl instanceof Array) {
				  	for(var i = 0; i < obj_detail_bl.length; i++){
				  		tablebl.row.add(
				  			$('<tr>' +
				  				'<td>' + (i + 1) + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['blNumber']['_v'] + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['packageName']['_v'] + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['cargoName']['_v'] + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['quantity']['_v'] + '</td>' +
				  				// '<td>' + obj_detail_bl[i]['_c']['weightRealization']['_v'] + '</td>' + // satuan belum ada
				  				'<td>' +  '-' + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['vesselName']['_v'] + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['blCustName']['_v'] + '</td>' +
				  				'<td>' + obj_detail_bl[i]['_c']['ei'][1]['_v'] + '</td>' +
				  			'<tr>')
				  		).draw();
				  	}
				} else {
				  	tablebl.row.add(
			  			$('<tr>' +
			  				'<td>' + 1 + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['blNumber']['_v'] + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['packageName']['_v'] + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['cargoName']['_v'] + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['quantity']['_v'] + '</td>' +
			  				// '<td>' + obj_detail_bl['_c']['weightRealization']['_v'] + '</td>' +
			  				'<td>' +  '-' + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['vesselName']['_v'] + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['blCustName']['_v'] + '</td>' +
			  				'<td>' + obj_detail_bl['_c']['ei'][1]['_v'] + '</td>' +
			  			'<tr>')
			  		).draw();
				}

				$(".show_detail").fadeIn();
			}

			for (var ac = 0; ac < obj_activity.length; ac++){
				if ((obj_activity[ac]['_c']['statusStevedoring']['_v']).toUpperCase() == 'MUAT'){
					$('#muat_gate_in').html(obj_activity[ac]['_c']['truckInDate']['_v']);
					$('#muat_truck_number').html(obj_activity[ac]['_c']['truckNumber']['_v']);
					$('#muat_placement_date').html(obj_activity[ac]['_c']['truckInDate']['_v']);
					$('#muat_location').html(obj_activity[ac]['_c']['gateIn']['_v']+'&nbsp;'+'&nbsp;'+'/'+'&nbsp;'+'&nbsp;'+obj_activity[ac]['_c']['idTerminal']['_v']);
					$('#stevedoring_muat_date').html(obj_activity[ac]['_c']['stevedoringDate']['_v']);
					$('#stevedoring_muat_location').html(obj_activity[ac]['_c']['gateIn']['_v']+'&nbsp;'+'&nbsp;'+'/'+'&nbsp;'+'&nbsp;'+obj_activity[ac]['_c']['idTerminal']['_v']);
					$('#stevedoring_muat_to_vessel').html(obj_activity[ac]['_c']['vesselName']['_v']);
				}else if ((obj_activity[ac]['_c']['statusStevedoring']['_v']).toUpperCase() == 'BONGKAR'){
					$('#stevedoring_bongkar_date').html(obj_activity[ac]['_c']['stevedoringDate']['_v']);
					$('#stevedoring_bongkar_location').html(obj_activity[ac]['_c']['gateOut']['_v']+'&nbsp;'+'&nbsp;'+'/'+'&nbsp;'+'&nbsp;'+obj_activity[ac]['_c']['idTerminal']['_v']);
					$('#stevedoring_bongkar_from_vessel').html(obj_activity[ac]['_c']['vesselName']['_v']);
					$('#bongkar_placement_date').html(obj_activity[ac]['_c']['truckOutDate']['_v']);
					$('#bongkar_location').html(obj_activity[ac]['_c']['gateOut']['_v']+'&nbsp;'+'&nbsp;'+'/'+'&nbsp;'+'&nbsp;'+obj_activity[ac]['_c']['idTerminal']['_v']);
					$('#bongkar_gate_out').html(obj_activity[ac]['_c']['truckOutDate']['_v']);
					$('#bongkar_truck_number').html(obj_activity[ac]['_c']['truckNumber']['_v']);
				}
			}

			var obj_history_bl_bongkar_muat = JSON.parse(JSON.parse(data_fix['history_bl_bongkar_muat']));
			var obj_history_bl_delivery = JSON.parse(JSON.parse(data_fix['history_bl_delivery']));
			var obj_history_bl_lumpsum = JSON.parse(JSON.parse(data_fix['history_bl_lumpsum']));
			var obj_history_bl_receiving = JSON.parse(JSON.parse(data_fix['history_bl_receiving']));
			var no = 1;
			var status_uper = '';
			var status_nota = '';

			if (obj_history_bl_bongkar_muat['count'] > 0){
				for(var a = 0; a < obj_history_bl_bongkar_muat['count']; a++){

					if (obj_history_bl_bongkar_muat['result'][a]['jumlah_uper'] <= 0){
						status_uper = '<span class="label label-info">Tidak Ada Uper</span>';
					}else{
						if (obj_history_bl_bongkar_muat['result'][a]['jumlah_uper'] > obj_history_bl_bongkar_muat['result'][a]['jumlah_uper_bayar']){
							status_uper = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_uper = '<span class="label label-success">Lunas</span>';
						}
					}

					if (obj_history_bl_bongkar_muat['result'][a]['jumlah_nota'] <= 0){
						status_nota = '<span class="label label-info">Tidak Ada Proforma</span>';
					}else{
						if (obj_history_bl_bongkar_muat['result'][a]['jumlah_nota'] > obj_history_bl_bongkar_muat['result'][a]['jumlah_nota_bayar']){
							status_nota = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_nota = '<span class="label label-success">Lunas</span>';
						}
					}

					table.row.add(
				       $('<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>BONGKAT MUAT</td>' +
						    '<td>'+ obj_history_bl_bongkar_muat['result'][a]['bm_no'] +'</td>' +
						    '<td>'+ obj_history_bl_bongkar_muat['result'][a]['bm_date'] +'</td>' +
						    '<td>'+ status_uper +'</td>' +
						    '<td>'+ status_nota +'</td>' +
						'</tr>')
			        ).draw();
				}
			}

			if (obj_history_bl_receiving['count'] > 0){
				for(var a = 0; a < obj_history_bl_receiving['count']; a++){

					if (obj_history_bl_receiving['result'][a]['jumlah_uper'] <= 0){
						status_uper = '<span class="label label-info">Tidak Ada Uper</span>';
					}else{
						if (obj_history_bl_receiving['result'][a]['jumlah_uper'] > obj_history_bl_receiving['result'][a]['jumlah_uper_bayar']){
							status_uper = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_uper = '<span class="label label-success">Lunas</span>';
						}
					}

					if (obj_history_bl_receiving['result'][a]['jumlah_nota'] <= 0){
						status_nota = '<span class="label label-info">Tidak Ada Proforma</span>';
					}else{
						if (obj_history_bl_receiving['result'][a]['jumlah_nota'] > obj_history_bl_receiving['result'][a]['jumlah_nota_bayar']){
							status_nota = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_nota = '<span class="label label-success">Lunas</span>';
						}
					}

					table.row.add(
				       $('<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>RECEIVING</td>' +
						    '<td>'+ obj_history_bl_receiving['result'][a]['rec_no'] +'</td>' +
						    '<td>'+ obj_history_bl_receiving['result'][a]['rec_date'] +'</td>' +
						    '<td>'+ status_uper +'</td>' +
						    '<td>'+ status_nota +'</td>' +
						'</tr>')
			        ).draw();
				}
			}

			if (obj_history_bl_delivery['count'] > 0){
				for(var a = 0; a < obj_history_bl_delivery['count']; a++){
					
					if (obj_history_bl_delivery['result'][a]['jumlah_uper'] <= 0){
						status_uper = '<span class="label label-info">Tidak Ada Uper</span>';
					}else{
						if (obj_history_bl_delivery['result'][a]['jumlah_uper'] > obj_history_bl_delivery['result'][a]['jumlah_uper_bayar']){
							status_uper = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_uper = '<span class="label label-success">Lunas</span>';
						}
					}

					if (obj_history_bl_delivery['result'][a]['jumlah_nota'] <= 0){
						status_nota = '<span class="label label-info">Tidak Ada Proforma</span>';
					}else{
						if (obj_history_bl_delivery['result'][a]['jumlah_nota'] > obj_history_bl_delivery['result'][a]['jumlah_nota_bayar']){
							status_nota = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_nota = '<span class="label label-success">Lunas</span>';
						}
					}

					table.row.add(
				       $('<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>DELIVERY</td>' +
						    '<td>'+ obj_history_bl_delivery['result'][a]['del_no'] +'</td>' +
						    '<td>'+ obj_history_bl_delivery['result'][a]['del_date'] +'</td>' +
						    '<td>'+ status_uper +'</td>' +
						    '<td>'+ status_nota +'</td>' +
						'</tr>')
			        ).draw();
				}
			}

			if (obj_history_bl_lumpsum['count'] > 0){
				for(var a = 0; a < obj_history_bl_lumpsum['count']; a++){

					if (obj_history_bl_lumpsum['result'][a]['jumlah_uper'] <= 0){
						status_uper = '<span class="label label-info">Tidak Ada Uper</span>';
					}else{
						if (obj_history_bl_lumpsum['result'][a]['jumlah_uper'] > obj_history_bl_lumpsum['result'][a]['jumlah_uper_bayar']){
							status_uper = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_uper = '<span class="label label-success">Lunas</span>';
						}
					}

					if (obj_history_bl_lumpsum['result'][a]['jumlah_nota'] <= 0){
						status_nota = '<span class="label label-info">Tidak Ada Proforma</span>';
					}else{
						if (obj_history_bl_lumpsum['result'][a]['jumlah_nota'] > obj_history_bl_lumpsum['result'][a]['jumlah_nota_bayar']){
							status_nota = '<span class="label label-danger">Belum Lunas</span>';
						}else{
							status_nota = '<span class="label label-success">Lunas</span>';
						}
					}
					table.row.add(
				       $('<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>LUMPSUM</td>' +
						    '<td>'+ obj_history_bl_lumpsum['result'][a]['lumps_no'] +'</td>' +
						    '<td>'+ obj_history_bl_lumpsum['result'][a]['lumps_date'] +'</td>' +
						    '<td>'+ status_uper +'</td>' +
						    '<td>'+ status_nota +'</td>' +
						'</tr>')
			        ).draw();
				}
			}
			$.unblockUI();
		}
	});
}

</script>

	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
