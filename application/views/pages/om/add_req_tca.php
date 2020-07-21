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
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
		
		
				$( "#no_req" ).autocomplete({
		minLength: 3,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>om/truck/auto_request_bl?",{  term: $( "#no_req" ).val(), port: $("#port").val()}, response);
		},
		focus: function( event, ui )
		{
			$( "#no_req" ).val( ui.item.ID_REQ);
			return false;
		},
		select: function( event, ui )
		{
			$( "#no_req" ).val( ui.item.ID_REQ);
			$( "#customer_id" ).val( ui.item.ID_CUST);
			$( "#customer_name" ).val( ui.item.CUST_NAME);
            $( "#vessel" ).val( ui.item.VESSEL);
			$( "#id_vvd" ).val( ui.item.ID_VVD);
			$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
			$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
			$( "#voyage" ).val( ui.item.VOYAGE);
			$( "#pkg_name" ).val( ui.item.PKG_NAME);
			$( "#qty" ).val( ui.item.QTY);
			$( "#ton" ).val( ui.item.TON);
			$( "#bl_number" ).val( ui.item.BL_NUMBER);
			$( "#bl_date" ).val( ui.item.BL_DATE);
			$( "#e_i" ).val( ui.item.E_I);
			$( "#hs_code" ).val( ui.item.HS_CODE);
			$( "#id_servicetype" ).val( ui.item.ID_SERVICETYPE);
			$( "#service_type" ).val( ui.item.SERVICETYPE_NAME);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.ID_REQ+"<br>" +item.VESSEL+" [" +item.VOYAGE_IN+" - " +item.VOYAGE_OUT+"]</a>")
		.appendTo( ul );

	};
	
			$( "#customer_name" ).autocomplete({
				minLength: 5,
				source: function(request, response) {
					$.getJSON("<?=ROOT?>autocomplete/getCustomerList?",{  term: $( "#customer_name" ).val(),
																				  port: $('#port').val()
																				 }, response);
					},
				focus: function( event, ui )
				{
					$( "#customer_name" ).val( ui.item.NAME);
					return false;
				},
				select: function( event, ui )
				{
					$( "#customer_name" ).val( ui.item.NAME);
					$( "#customer_add" ).val( ui.item.ADDRESS);
					$( "#customer_npwp" ).val( ui.item.NPWP);
					$( "#customer_id" ).val( ui.item.CUSTOMER_ID);
					return false;
				}
			}).data( "uiAutocomplete" )._renderItem = function( ul, item )
			{
				return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a align='center'><p class='repo-language'>" + item.NAME + "</p><p class='repo-name'>" +item.ADDRESS+"</p></a>")
				.appendTo( ul );
		};
		
    
		
		
	});

function submitheader()
{
	var terminal = $("#port").val();
	var no_req = $("#no_req").val();
	var customer_id = $("#customer_id").val();
	var customer_name = $("#customer_name").val();
	var id_vvd = $("#id_vvd").val();
	var vessel=$( "#vessel" ).val();
	var voyage_in=$( "#voyage_in" ).val();
	var voyage_out=$( "#voyage_out" ).val();
	var pkg_name=$( "#pkg_name" ).val();
	var qty=$( "#qty" ).val();
	var ton=$( "#ton" ).val();
	var bl_number=$( "#bl_number" ).val();
	var bl_date=$("#bl_date").val();
	var e_i=$("#e_i").val();
	var hs_code=$("#hs_code").val();
	var id_servicetype=$("#id_servicetype").val();
	var service_type=$("#service_type").val();

	if( terminal=='')
	{
		alert('Terminal tidak boleh kosong');
		return false;
	}
	
	if( customer_name=='')
	{
		alert('Customer tidak boleh kosong');
		return false;
	}
	
	if( customer_id=='')
	{
		alert('No Customer tidak boleh kosong');
		return false;
	}

	if( vessel=='' || voyage_in=='' || voyage_out=='')
	{
		alert('Kapal tidak valid');
		return false;
	}

	if (no_req=='')
	{
		alert('no request tidak boleh kosong');
		return false;
	}

	if(bl_number=='')
	{
		alert('bl number tidak boleh kosong');
		return false;
	}

	if(service_type == ''){
		alert('service type harus terisi');
		return false;
	}

	var url="<?=ROOT?>om/truck/create_request_tca";
	$.blockUI();
	$.post(url,{TERMINAL:terminal,NO_REQUEST:no_req,CUSTOMER_ID:customer_id,CUSTOMER_NAME:customer_name,ID_VVD:id_vvd,VESSEL:vessel,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out, PKG_NAME:pkg_name, QTY:qty, TON:ton, BL_NUMBER:bl_number, BL_DATE:bl_date, EI:e_i, HS_CODE:hs_code, ID_SERVICETYPE:id_servicetype, SERVICE_TYPE:service_type,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
		$.unblockUI();
		if(data == 'salah') {
			alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			return false;
		}

		$(':button').attr('disabled','disabled');

		var obj = jQuery.parseJSON( data );

		if(obj.rc=="F") {
			alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
			$(':button').removeAttr('disabled');
		}
		else if(obj.data.info==null) {
			alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
			$(':button').removeAttr('disabled');
		}
		else
		{
			var row_data = obj.data.info;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];

			if(v_msg!="OK")
			{
				alert(v_req);
			}
			else
			{
				document.getElementById('submit_header').style.display = "none";
				alert("Simpan request berhasil");
				$("#container_data").attr('class', 'row');
				$("#container_excel").attr('class', 'row');
				$("#detail_container").attr('class', 'row');
				$('#port_excel').val(terminal);
				$('#bl_number_excel').val(bl_number);
				$('#id_req_excel').val(no_req);
				$('#id_vvd_excel').val(id_vvd);	
			    $('#e_i_excel').val(e_i);
				$('#id_servicetype_excel').val(id_servicetype);
				$('#servicetype_excel').val(service_type);
	
				var notification = new NotificationFx({
					message : '<p>Anda Berhasil Create TCA</p>',
					layout : 'growl',
					effect : 'jelly',
					type : 'success' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			$(':button').removeAttr('disabled');
		}
	});
}

function submitFileDO(reqNo)
{
	var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/do_upload";

	var formData = new FormData($('.myForm1')[0]);
	$.ajax({
			url: formUrl,
			type: 'POST',
			data: formData,
			mimeType: "multipart/form-data",
			contentType: true,
			cache: false,
			processData: false,
			success: function(data, textStatus, jqXHR){
				//alert('success');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(data);
			}
	});



}


function submitFileOK(reqNo)
{
	var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/do_upload";
	var formData = new FormData($('.myForm1')[0]);

	$.ajax({
			url: formUrl,
			type: 'POST',
			data: formData,
			mimeType: "multipart/form-data",
			contentType: false,
			cache: false,
			processData: false,
			success: function(data, textSatus, jqXHR){
				//alert('success');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(data);
			}
	});
}


function submitFileSPPB(reqNo)
{
	var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/sppb_upload";
	var formData = new FormData($('.myForm2')[0]);

	$.ajax({
			url: formUrl,
			type: 'POST',
			data: formData,
			mimeType: "multipart/form-data",
			contentType: false,
			cache: false,
			processData: false,
			success: function(data, textSatus, jqXHR){
				//alert('success');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(data);
			}
	});
}

function submitFileSPCUSTOM(reqNo)
{
	var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/sp_custom_upload";
	var formData = new FormData($('.myForm3')[0]);

	$.ajax({
			url: formUrl,
			type: 'POST',
			data: formData,
			mimeType: "multipart/form-data",
			contentType: false,
			cache: false,
			processData: false,
			success: function(data, textSatus, jqXHR){
				//alert('success');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(data);
			}
	});
}

function add_truck(){
	var terminal = $("#port").val();
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
				alert('Request gagal');
			}
			else
			{
				$("#tid").val("");
				$("#truck_number" ).val("");
				$("#truck_company" ).val("");
				$("#rfid_code" ).val("");
				$("#id_truck" ).val("");

				var url = "<?=ROOT?>om/truck/get_detail_truck/add/"+no_req;
				$("#detail_container").load(url);

				var notification = new NotificationFx({
					message : '<p>Tambah Container Sukses</p>',
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

//save_req tidak digunakan
function save_req(){
	var url="<?=ROOT?>container/save_request_delivery";
	var terminal = $("#terminal").val();
	var no_request = $("#no_request").val();
	$.post(url,{NO_REQUEST:no_request, TERMINAL:terminal,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
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
				alert(v_msg);
				window.location = "<?=ROOT?>container/main_tca";
			}
		});
}

function delete_container(tca_truck_id){
	var terminal = $("#port").val();
	var no_request = $("#no_req").val();
	var id_vvd = $("#id_vvd").val();
	var bl_number=$( "#bl_number" ).val();
	var id_truck=$("#id_truck").val();

	var url="<?=ROOT?>om/truck/del_tca";
	$.post(url,{TID:tca_truck_id, NO_REQUEST:no_request,ID_VVD:id_vvd,BL_NUMBER:bl_number,ID_TRUCK:id_truck,TERMINAL:terminal,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
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
				$("#detail_container").load("<?=ROOT?>om/truck/get_detail_truck/add/"+no_request);
				alert(v_msg+'.'+tca_truck_id+" deleted");
			}
		});
	$('a').removeAttr('disabled');
}

$(document).ready(function() {

	var sPdfType = ['application/pdf',
						'application/x-download',
						'application/force-download'
					]; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan

	$("#container_data").attr('class', 'row hidden');
	$("#container_excel").attr('class', 'row hidden');
	$("#detail_container").attr('class', 'row hidden');

	$('#port').on('change', function(){
		var terminal = $(this).val().slice(-1);
		console.log(terminal);
		if (terminal == 'I'){
			$('#international_content').removeClass('hidden_content');
		} else {
			$('#international_content').addClass('hidden_content');
		}
		

	});
//=================++++++++++++++=========
//http://localhost/ibis_qa/index.php/container/auto_vessel_delivery?&term=SINAR+&port=IDJKT-T2D


//==============++++++++++++
	//======================================= autocomplete vessel==========================================//
	/*$( "#vessel_autocomplete" ).autocomplete({
		minLength: 3,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>container/auto_vessel_delivery?",{term:$( "#vessel_autocomplete" ).val(), port: $("#port").val()}, response);
			},
		focus: function( event, ui )
		{
			//alert(ui.item.VESSEL);
			$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
			return false;
		},
		select: function( event, ui )
		{

			$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
			$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
			$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
			$( "#voyage" ).val( ui.item.VOYAGE);
			$( "#id_vsb_voyage" ).val( ui.item.ID_VSB_VOYAGE);
			$( "#vessel_code" ).val( ui.item.VESSEL_CODE);
			$( "#call_sign" ).val( ui.item.CALL_SIGN);
			$( "#date_discharge" ).val( ui.item.DATE_DISCHARGE);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.VESSEL + "<br>Voyage in " +item.VOYAGE_IN+" - Voyage out " +item.VOYAGE_OUT+"</a>")
		.appendTo( ul );

	};*/
//======================================= autocomplete vessel==========================================//

//======================================= autocomplete container==========================================//
	$( "#tid" ).autocomplete({
		minLength: 3,
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

	$('#delivery_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

	//$('#delivery_date').bind("onSelect",function(a,b){alert("ivan ganteng");});

	$('#do_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

	$('#sppb_date').datepicker({
		format: 'dd-mm-yyyy'
	});

	$('#sp_custom_date').datepicker({
		format: 'dd-mm-yyyy'
	});
	$('#plo').datetimepicker({
		format: 'd-m-Y H:i'
	});

	//validasi saat do upload
	$('#do_upload').change(function() {
		var namafile,panjangfile;
		namafile=document.getElementById('do_upload').value;
		panjangfile=namafile.length;

		if(panjangfile>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('do_upload').value="";
		}

		var sDoType = ['application/pdf',
						'application/x-download',
						'application/force-download'
					]; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
		var files = document.getElementById('do_upload').files[0].type;

		if (sPdfType.indexOf(files) > -1) {
			console.log('File valid'); //In the array!
		} else {
			alert('Mime type file: '+files+ '.\nFile tidak valid.'); //Not in the array
			document.getElementById('do_upload').value="";
			return false;
		}
	});

	//validasi saat sppb upload
	$('#sppb_upload').change(function() {
		var files = document.getElementById('sppb_upload').files[0].type;

		var namafile2,panjangfile2;
		namafile2=document.getElementById('sppb_upload').value;
		panjangfile2=namafile2.length;

		if(panjangfile2>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('sppb_upload').value="";
		}

		if (sPdfType.indexOf(files) > -1) {
			console.log('File valid'); //In the array!
		} else {
			alert('Mime type file: '+files+ '.\nFile tidak valid.'); //Not in the array
			document.getElementById('sppb_upload').value="";
			return false;
		}
	});

	//validasi saat sp custom upload
	$('#sp_custom_upload').change(function() {
		var files = document.getElementById('sp_custom_upload').files[0].type;

		var namafile3,panjangfile3;
		namafile3=document.getElementById('sp_custom_upload').value;
		panjangfile3=namafile3.length;

		if(panjangfile3>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('sp_custom_upload').value="";
		}

		if (sPdfType.indexOf(files) > -1) {
			console.log('File valid'); //In the array!
		} else {
			alert('Mime type file: '+files+ '.\nFile tidak valid.'); //Not in the array
			document.getElementById('sp_custom_upload').value="";
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

function cekTipeYd()
{
	var termn=$('#port').val();
	//alert('tes');
	if(termn=='IDJKT-T3I' || termn=='IDJKT-L2D' || termn=='IDJKT-L2I'){
		$("#delivery_type").val('LAP');
		$('#delivery_type').attr('disabled',true);
	} else if (termn=='IDJKT-T009D')
	{
		if ($("#delivery_type").val() == "TL"){
			$('#delivery_type').attr('disabled',false);
					$("#delivery_type").val("");
				}
				$("#delivery_type option[value='TL']").prop('disabled',true);
	} else
	{
		$('#delivery_type').attr('disabled',false);
		$("#delivery_type option[value='TL']").prop('disabled',false);
	}
	
	if(termn=='IDJKT-L2D' || termn=='IDJKT-L2I'){
		$('.custom-hidden').hide();
	}
}
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
												<option> -- Please Choose Terminal -- </option>
												<?php
												foreach($terminal as $term)
												{
												?>
													<option value="<?=$term["KODE_CABANG_SIMKEU"]?>-<?=$term["ID_PORT"]?>"><?=$term["TERMINAL_NAME"]?></option>
												<?php
												}
												?>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ID Customer</label>
												<input type="text" class="form-control" id="customer_id" name="customer_id" size="8" value="<?=$this->session->userdata('customerid_phd');?>" readonly >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Customer Name</label>
												<input type="text" class="form-control" id="customer_name" name="customer_name" size="8" value="<?=$this->session->userdata('customername_phd');?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Entry No Request / BL</label>
												<input type="text" class="form-control" id="no_req" name="no_req" placeholder="autocomplete" size="20">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">VESSEL</label>
												<input type="text" class="form-control" id="vessel" name="vessel" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">VOYAGE</label>
												<input type="text" class="form-control" id="voyage" name="voyage" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">PKG NAME</label>
												<input type="text" class="form-control" id="pkg_name" name="pkg_name" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">QTY</label>
												<input type="text" class="form-control" id="qty" name="qty" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">TON</label>
												<input type="text" class="form-control" id="ton" name="ton" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">NO BL</label>
												<input type="text" class="form-control" id="bl_number" name="bl_number" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">BL DATE</label>
												<input type="text" class="form-control" id="bl_date" name="bl_date" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">HS CODE</label>
												<input type="text" class="form-control" id="hs_code" name="hs_code" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Service Type</label>
												<input type="text" class="form-control" id="service_type" name="service_type" size="8" readonly>
											</div>
											<input type="hidden" id="voyage_in" name="voyage_in">
											<input type="hidden" id="voyage_out" name="voyage_out">
											<input type="hidden" id="id_vvd" name="id_vvd">
											<input type="hidden" id="id_servicetype" name="id_servicetype">
											<input type="hidden" id="e_i" name="e_i">
										</div>
										<button id="submit_header" onclick="submitheader()" class="btn btn-success">Save</button>
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
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<input type="hidden" id="port_excel" name="port_excel" value="">
											<input type="hidden" id="id_req_excel" name="id_req_excel" value="">
											<input type="hidden" id="bl_number_excel" name="bl_number_excel" value="">
											<input type="hidden" id="id_vvd_excel" name="id_vvd_excel" value="">
											<input type="hidden" id="e_i_excel" name="e_i_excel" value="">
											<input type="hidden" id="id_servicetype_excel" name="id_servicetype_excel" value="">
											<input type="hidden" id="servicetype_excel" name="servicetype_excel" value="">
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


	<script>

  function search_vessel(){
      var vesselname = $("#vessel_autocomplete").val();
      var port       = $('#port').val();
      //var url = "<?=ROOT?>autocomplete/getVesselList";
      if(vesselname == ''){
          $("#vessel_autocomplete").focus();
          alert('Mohon diisi kolomnya');
      }
      else{
        $.get("<?=ROOT?>container/auto_vessel_delivery?",{term : vesselname, port: port}, function(data){
              $('#modalplaceholder').html(data).children().modal('show');
          });
      }

  }

  function complete($vessel,$voyin,$voyout,$voyage,$id_vsb_voyage,$vessel_code,$call_sign,$date_discharge,$etd,$eta,$nobook){
      $( "#vessel_autocomplete" ).val($vessel);
			$( "#voyage_in" ).val($voyin);
			$( "#voyage_out" ).val($voyout);
			$( "#voyage" ).val($voyage);
			$( "#id_vsb_voyage" ).val($id_vsb_voyage);
			$( "#vessel_code" ).val($vessel_code);
			$( "#call_sign" ).val($call_sign);
			$( "#date_discharge" ).val($date_discharge);
			$( "#etd" ).val($etd);
			$( "#eta" ).val($eta);
			$( "#nobook" ).val($nobook);

      $('#modalplaceholder').attr('display','none');
  }

	$(function() {
		$("#container_data").attr('class', 'row hidden');
		$("#container_excel").attr('class', 'row hidden');

    /*    $( "#vessel_autocomplete" ).autocomplete({
			minLength: 5,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>autocomplete/getVesselList?",{  term: $( "#vessel_autocomplete" ).val(),
																			  port: $('#port').val()
																			 }, response);
				},
			focus: function( event, ui )
			{
				$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
				return false;
			},
			select: function( event, ui )
			{
				$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
				$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
				$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
				$( "#eta" ).val( ui.item.ETA);
				$( "#etd" ).val( ui.item.ETD);
				$( "#end_shift" ).val( ui.item.ETD);
				$( "#ukk" ).val( ui.item.UKK);
				$( "#vessel_code" ).val( ui.item.VESSEL_CODE);
				$( "#call_sign" ).val( ui.item.CALL_SIGN);
				$( "#voyage" ).val( ui.item.VOYAGE);

				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item )
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'><p class='repo-language'>" + item.VESSEL + "</p><p class='repo-name'>Voyage in " +item.VOYAGE_IN+"- Voyage out "+item.VOYAGE_OUT+"</p></a>")
			.appendTo( ul );
    };*/



      /*  $( "#pod_autocomplete" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>container_receiving/auto_pod?",{  term: $( "#pod_autocomplete" ).val(),
                                                                          vessel: $("#vessel_autocomplete").val(),
                                                                          voyin: $("#voyage_in").val(),
                                                                          voyout: $("#voyage_out").val(),
                                                                          port: $('#port').val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#pod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            return false;
        },
        select: function( event, ui )
        {
            $( "#pod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            $( "#idpod" ).val( ui.item.ID_PELABUHAN);
            $( "#fpod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            $( "#idfpod" ).val( ui.item.ID_PELABUHAN);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.NM_PELABUHAN + "<br>" +item.ID_PELABUHAN+"</a>")
        .appendTo( ul );

        };

        $( "#fpod_autocomplete" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>container_receiving/auto_pod?",{  term: $( "#fpod_autocomplete" ).val(),
                                                                          vessel: $("#vessel_autocomplete").val(),
                                                                          voyin: $("#voyage_in").val(),
                                                                          voyout: $("#voyage_out").val(),
                                                                          port: $('#port').val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#fod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            return false;
        },
        select: function( event, ui )
        {
            $( "#fpod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            $( "#idfpod" ).val( ui.item.ID_PELABUHAN);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.NM_PELABUHAN + "<br>" +item.ID_PELABUHAN+"</a>")
        .appendTo( ul );

      };*/

        /*$( "#container_operator" ).autocomplete({
        minLength: 3,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>/container_receiving/auto_carrier?",{  term: $( "#container_operator" ).val(),
                                                                          vessel: $("#vessel_autocomplete").val(),
                                                                          port: $('#port').val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#container_operator" ).val( ui.item.CODE);
            return false;
        },
        select: function( event, ui )
        {
            $( "#container_operator" ).val( ui.item.CODE);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.CODE + "<br>" +item.LINE_OPERATOR+"</a>")
        .appendTo( ul );

        };*/
    });

	//datepicker
	var picker = $('#start_shift').datepicker({
		format: 'dd-mm-yyyy 00:00',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

	var picker = $('#peb_dt').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});
	//.val(moment().format("D-M-YYYY 00:00"));

	</script>
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
