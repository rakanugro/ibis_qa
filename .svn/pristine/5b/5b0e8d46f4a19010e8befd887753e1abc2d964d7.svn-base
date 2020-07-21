<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_?>js/jquery.datetimepicker.full.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>

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
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
	});

	
	
function save_req(){
	var url="<?=ROOT?>container/save_request_delivery";
	var terminal = $("#port").val();
	var no_request = $("#no_request").val();
	$.post(url,{NO_REQUEST:no_request, TERMINAL:terminal},
		function(data){
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Save gagal : '+v_msg);
				return false;
			}
			else
			{
				alert(v_msg+"."+v_req);
				window.location = "<?=ROOT?>container/main_delivery";
			}
		});
}


function add_truck(){
	var terminal = $("#port").val();
	//alert (terminal);
	var tid=$( "#tid" ).val();
	var truck_number=$( "#truck_number" ).val();
	var bl_number=$( "#bl_number" ).val();
	var truck_company=$( "#truck_company" ).val();
	var rfid_code=$( "#rfid_code" ).val();
	var no_req = $("#no_req").val();
	var id_vvd = $("#id_vvd").val();
	var e_i=$("#e_i").val();
	var id_servicetype=$("#id_servicetype").val();
	var service_type=$("#service_type").val();
	var id_truck=$("#id_truck").val();
	
	if(tid==''){
			alert('TID atau Truck Number Kosong!');
			return false;
			
	} else if(truck_number==''){
			alert('TID atau Truck Number Kosong!');
			return false;
			
	} else if(truck_company==''){
			alert('TID atau Truck Number Kosong!');
			return false;
	}
	
	$(':button').attr('disabled','disabled');
	var url="<?=ROOT?>om/truck/add_detail_truck";
	$.blockUI();
	$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_REQUEST:no_req,TERMINAL:terminal,TID:tid,TRUCK_NUMBER:truck_number,ID_VVD:id_vvd,BL_NUMBER:bl_number,TRUCK_COMPANY:truck_company,RFID_CODE:rfid_code,EI:e_i,ID_SERVICETYPE:id_servicetype,SERVICE_TYPE:service_type,ID_TRUCK:id_truck},
	function(data) {
		$.unblockUI();
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert(v_req);
			}
			else
			{
				$("#tid").val("");
				$("#truck_number" ).val("");
				$("#truck_company" ).val("");
				$("#rfid_code" ).val("");
				$("#id_truck" ).val("");

				var url = "<?=ROOT?>om/truck/get_detail_truck/edit/"+no_req;
				$("#detail_container").load(url);

				var notification = new NotificationFx({
					message : '<p>TCA Sukses</p>',
					layout : 'growl',
					effect : 'jelly',
					type : 'success' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			$(':button').removeAttr('disabled');
	});
}

function delete_container(tca_truck_id){
	var terminal = $("#port").val();
	var no_request = $("#no_req").val();
	var bl_number=$( "#bl_number" ).val();
	var id_truck=$("#id_truck").val();

	var url="<?=ROOT?>om/truck/del_tca";
		$.post(url,{TID:tca_truck_id, NO_REQUEST:no_request,BL_NUMBER:bl_number,TERMINAL:terminal,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
		function(data){
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Delete gagal : '+v_msg+'.'+v_req);
			}
			else
			{
				$("#detail_container").load("<?=ROOT?>om/truck/get_detail_truck/edit/"+no_request);
				alert(v_msg+'.'+tca_truck_id+" deleted");
			}
		});
	$('a').removeAttr('disabled');
}

$(document).ready(function() {

	 <?
	 
		if($message){?>
		alert('<?=str_replace("<br>","\\n",urldecode($message))?>');

		<?}

	?>
		$('#plo').datetimepicker({
		format: 'd-m-Y H:i'
	});
	
	var url = "<?=ROOT?>om/truck/get_detail_truck/edit/<?=$request_data[0]['ID_REQ']?>";
	$("#detail_container").load(url);

//======================================= autocomplete container==========================================//
	$( "#tid" ).autocomplete({
		minLength: 4,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>om/truck/auto_truck_number",{ term: $( "#tid" ).val(), port: $("#port").val()}, response);

			},
		focus: function( event, ui )
		{
			$( "#tid" ).val( ui.item.TID);
			return false;
		},
		select: function( event, ui )
		{

			$("#tid").val( ui.item.TID);
			$("#truck_number" ).val( ui.item.TRUCK_NUMBER);
			$("#rfid_code" ).val( ui.item.RFID_CODE);
			$("#truck_company" ).val( ui.item.COMPANY_NAME);
			$("#id_truck" ).val( ui.item.ID_TRUCK);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.TID + "<br>" +item.TRUCK_NUMBER+" - " +item.COMPANY_NAME+"</a>")
		.appendTo( ul );

	};
//======================================= autocomplete container==========================================//

	//validasi saat edit do upload
	$('#file_do').change(function() {

		var nama1,panjang1;
		nama1=document.getElementById('file_do').value;
		panjang1=nama1.length;

		if(panjang1>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('file_do').value="";

		}

		var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
		var files = document.getElementById('file_do').files[0].type;

		if(files != sDoType) {
			alert('Mime type file: '+files+ '.\nFile tidak valid.');
			document.getElementById('file_do').value="";
			return false;
		}
	});

	//validasi saat edit sp custom upload
	$('#file_sp_custom').change(function() {

		var nama2,panjang2;
		nama2=document.getElementById('file_sp_custom').value;
		panjang2=nama2.length;

		if(panjang2>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('file_sp_custom').value="";

		}


		var sCustomType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
		var files = document.getElementById('file_sp_custom').files[0].type;

		if(files != sCustomType) {
			alert('Mime type file: '+files+ '.\nFile tidak valid.');
			document.getElementById('file_sp_custom').value="";
			return false;
		}
	});

	//validasi saat edit upload file excel
	$('#userfile').change(function() {

		var nama3,panjang3;
		nama3=document.getElementById('userfile').value;
		panjang3=nama3.length;

		if(panjang3>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('userfile').value="";

		}

		var files = document.getElementById('userfile').files[0].type;
		var sUserFile = ['application/vnd.ms-excel',
							'application/msexcel',
							'application/x-msexcel',
							'application/xls',
							'application/x-xls',
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
						]; //mime type application/excel saja yang diperbolehkan, selainnya muncul pesan kesalahan
		if (sUserFile.indexOf(files) > -1) {
			console.log('File valid'); //In the array!
		} else {
			alert('Mime type file: '+files+ '.\nFile tidak valid.'); //Not in the array
			document.getElementById('userfile').value="";
			return false;
		}
	});
	
		//validasi saat upload file excel
	$('#userfile').change(function() {
		var files = document.getElementById('userfile').files[0].type;
		var sUserFile = ['application/vnd.ms-excel',
							'application/msexcel',
							'application/x-msexcel',
							'application/xls',
							'application/x-xls',
							'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
						]; //mime type application/excel saja yang diperbolehkan, selainnya muncul pesan kesalahan
		if (sUserFile.indexOf(files) > -1) {
			console.log('File valid'); //In the array!
		} else {
			alert('Mime type file: '+files+ '.\nFile tidak valid.'); //Not in the array
			return false;
		}
	});
});


</script>
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>TCA DATA</h2>
								</header>

									<div class="main-box-body clearfix">
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" onchange="cekTipeYd()">

			
													<option value="<?=$request_data[0]['ID_TERMINAL']?>-<?=$request_data[0]['ID_TERMINAL']?>"><?=$request_data[0]['TERMINAL_NAME']?></option>
						
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ID Customer</label>
												<input type="text" class="form-control" id="customer_id" name="customer_id" size="8" value="<?=$request_data[0]['CUSTOMER_ID']?>" readonly >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Customer Name</label>
												<input type="text" class="form-control" id="customer_name" name="customer_name" size="8" value="<?=$request_data[0]['CUSTOMER_NAME']?>" readonly >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Entry No Request / BL</label>
												<input type="text" class="form-control" id="no_req" name="no_req" placeholder="autocomplete" value="<?=$request_data[0]['ID_REQ']?>" size="20" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">VESSEL</label>
												<input type="text" class="form-control" id="vessel" name="vessel" size="8" value="<?=$request_data[0]['VESSEL']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">VOYAGE</label>
												<input type="text" class="form-control" id="voyage" name="voyage" value="<?=$request_data[0]['VOYAGE_IN']?>-<?=$request_data[0]['VOYAGE_OUT']?>" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">PKG NAME</label>
												<input type="text" class="form-control" id="pkg_name" name="pkg_name" size="8" value="<?=$request_data[0]['PKG_NAME']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">QTY</label>
												<input type="text" class="form-control" id="qty" name="qty" size="8" value="<?=$request_data[0]['QTY']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">TON</label>
												<input type="text" class="form-control" id="ton" name="ton" size="8" value="<?=$request_data[0]['TON']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">NO BL</label>
												<input type="text" class="form-control" id="bl_number" name="bl_number" size="8" value="<?=$request_data[0]['BL_NUMBER']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">BL DATE</label>
												<input type="text" class="form-control" id="bl_date" name="bl_date" value="<?=$request_data[0]['BL_DATE']?>" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">HS CODE</label>
												<input type="text" class="form-control" id="hs_code" name="hs_code" size="8" value="<?=$request_data[0]['HS_CODE']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Service Type</label>
												<input type="text" class="form-control" id="service_type" name="service_type" value="<?=$request_data[0]['SERVICE_TYPE']?>" size="8" readonly>
											</div>
											<input type="hidden" id="voyage_in" name="voyage_in" value="<?=$request_data[0]['VOYAGE_IN']?>">
											<input type="hidden" id="voyage_out" name="voyage_out" value="<?=$request_data[0]['VOYAGE_OUT']?>">
											<input type="hidden" id="id_servicetype" name="id_servicetype" value="<?=$request_data[0]['ID_SERVICETYPE']?>">
												<input type="hidden" id="id_vvd" name="id_vvd" value="<?=$request_data[0]['ID_VVD']?>">
											<input type="hidden" id="e_i" name="e_i" value="<?=$request_data[0]['E_I']?>">
										</div>
								</div>
							</div>
						</div>
					</div>
							<div id="container_data" name="container_data" class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>TCA Data</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="form-inline" role="form">
												<div class="form-group">
													<label for="exampleTooltip">TRUCK ID / TRUCK NUMBER</label>
													<input id="tid" name="tid" type="text" class="form-control" data-toggle="tooltip" data-placement="bottom">
													
													<input id="truck_number" name="truck_number" type="text" class="form-control" placeholder="Type" data-toggle="tooltip" data-placement="bottom" title="Type" size="8" readOnly>
													<input id="id_truck" name="id_truck" type="hidden" class="form-control" placeholder="Type" data-toggle="tooltip" data-placement="bottom" title="Type" size="8" readOnly>
													<input id="truck_company" name="truck_company" type="text" class="form-control" placeholder="truck company" data-toggle="tooltip" data-placement="bottom" title="Size" size="30" readOnly>
													
													<input id="rfid_code" name="rfid_code" type="hidden" class="form-control" placeholder="truck company" data-toggle="tooltip" data-placement="bottom" title="Size" size="8" readOnly>
												<button onclick="add_truck();" class="btn btn-success">Add</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					
					<div id="container_excel" name="container_excel" class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Excel File Upload</h2>
								</header>

								<div class="main-box-body clearfix">
									<form method="post" enctype="multipart/form-data" action="<?=ROOT?>om/truck/upload_excel_truck">
										<div class="form-group">
											<label for="exampleTooltip">Upload</label>
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<input type="hidden" id="port_excel" name="port_excel" value="<?=$request_data[0]['PORT_CODE']?>-<?=$request_data[0]['ID_TERMINAL']?>">
											<input type="hidden" id="id_req_excel" name="id_req_excel" value="<?=$request_data[0]['ID_REQ']?>">
											<input type="hidden" id="bl_number_excel" name="bl_number_excel" value="<?=$request_data[0]['BL_NUMBER']?>">
											<input type="hidden" id="id_vvd_excel" name="id_vvd_excel" value="<?=$request_data[0]['ID_VVD']?>">
											<input type="hidden" id="e_i_excel" name="e_i_excel" value="<?=$request_data[0]['E_I']?>">
											<input type="hidden" id="id_servicetype_excel" name="id_servicetype_excel" value="<?=$request_data[0]['ID_SERVICETYPE']?>">
											<input type="hidden" id="servicetype_excel" name="servicetype_excel" value="<?=$request_data[0]['SERVICE_TYPE']?>">
											<input type="file" accept=".xls" id="userfile" name="userfile" data-toggle="tooltip" data-placement="bottom" title="Upload file Excel">
										</div>
										<button type="submit" class="btn btn-success">Upload</button>
										<a href="<?=APP_ROOT?>templateupload/Template_Upload_Truck_Association.xls">Download Template</a>
									</form>
								</div>
							</div>
						</div>
					</div>
					 <div id="modalplaceholder"></div>
					<div id="detail_container" name="detail_container" class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Truck Association List</h2>
								</header>

								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
												 <th>No</th>
												 <th>Hapus</th>
													<th><span>TCA TRUCK ID</span></a></th>
													<th><span>TCA TRUCK NUMBER</span></a></th>
													<th><span>TCA TRUCK COMPANY</span></a></th>
													<th><span>PROXIMITY</span></a></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														-
													</td>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														-
													</td>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														<a href="#">-</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!--<button onclick="save_req()" class="btn btn-success" name="button_add_detail" id="button_add_detail"><?=get_content($this->user_model,"delivery","save");?></button>-->
									<button type="submit" onclick="window.open('<?=ROOT.'om/truck/main_tca'?>','_self');" class="btn btn-success">Next</button>
								</div>
							</div>
						</div>
					</div>
			
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />

