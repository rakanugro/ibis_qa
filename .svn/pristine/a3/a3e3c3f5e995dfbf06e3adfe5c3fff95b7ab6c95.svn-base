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

.ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }
</style>

<script>
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
	});

function submitrbm()
{
	var no_request = $("#no_request").val();
	var terminal = $("#port").val();
	var vessel=$( "#vessel_autocomplete" ).val();
	var id_vsb_voyage=$( "#id_vsb_voyage" ).val();
	var vessel_code=$( "#vessel_code" ).val();
	var call_sign=$( "#call_sign" ).val();
	var voyage_in=$( "#voyage_in" ).val();
	var voyage_out=$( "#voyage_out" ).val();
	var eta=$( "#eta" ).val();
	var etd=$( "#etd" ).val();
	var delivery_type=$( "#delivery_type" ).val();
	var delivery_date=$( "#delivery_date" ).val();
	var no_bl=$( "#no_bl" ).val();
	var no_do=$( "#no_do" ).val();
	// var file_do=$( "#do_upload" ).val();
	var do_date=$( "#do_date" ).val();
	var sppbtype=$( "#sppbtype" ).val();
	var no_sppb=$( "#no_sppb" ).val();
	var sppb_date=$( "#sppb_date" ).val();
	var file_sppb=$( "#sppb_upload" ).val();
	var no_sp_custom=$( "#no_sp_custom" ).val();
	var sp_custom_date=$( "#sp_custom_date" ).val();
	var file_sp_custom=$( "#sp_custom_upload" ).val();
	var date_discharge = $( "#date_discharge" ).val();
	var no_book = $( "#nobook" ).val();
	var customer_name = $( "#customer_autocomplete" ).val();
	var customer_id = $( "#kd_pelanggan" ).val();
	var npwp = $( "#npwp" ).val();
	var address = $( "#address" ).val();
	
	/*var arrtdd = delivery_date.split("-");
	var arrtdo = do_date.split("-");*/
	
/*	var martdo =arrtdo[2]+arrtdo[1]+arrtdo[0];*/
/*	var martpd =arrtdd[2]+arrtdd[1]+arrtdd[0];*/

	var cek_international = terminal.slice(-1);
	var delivery_via = $("#delivery_via").val();

	if( terminal=='')
	{
		alert('Terminal tidak boleh kosong');
		return false;
	}

	
	if( vessel=='' || voyage_in=='' || voyage_out=='')
	{
		alert('Kapal tidak valid');
		return false;
	}


	var url="<?=ROOT?>rbm/update_request_rbm";
	$.blockUI();
	$.post(url,{ID_REQ:no_request, TERMINAL:terminal, ID_VSB_VOYAGE: id_vsb_voyage, VESSEL:vessel, VOYAGE_IN:voyage_in, VOYAGE_OUT:voyage_out, ETA:eta, ETD:etd,DELIVERY_DATE:delivery_date, NO_BL:no_bl, NO_DO:no_do, DO_DATE:do_date, SPPB_TYPE:sppbtype, NO_SPPB:no_sppb, DATE_SPPB:sppb_date, NO_SP_CUSTOM:no_sp_custom, DATE_SP_CUSTOM: sp_custom_date, FILE_SPPB:file_sppb, FILE_SP_CUSTOM:file_sp_custom, DATE_DISCHARGE:date_discharge, NO_BOOKING:no_book, DELIVERY_VIA:delivery_via,CUSTOMER_ID:customer_id,CUSTOMER_NAME:customer_name,NPWP:npwp,ADDRESS:address, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
		$.unblockUI();

		var obj = jQuery.parseJSON( data );

		if (obj == 'salah') {
			// alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			alert(obj.msg);
			return false;
		}

		$(':button').attr('disabled','disabled');

		// if (obj == 'ok') {
		// 	// alert('Update RBM successfully !');
		// 	alert(obj.msg);
		// 	window.location.href = "<?=ROOT?>rbm"
		// }
		
		var notification = new NotificationFx({
			message : '<p>Edit RBM successfully</p>',
			layout : 'growl',
			effect : 'jelly',
			type : 'success' // notice, warning, error or success

		});
		notification.show();
		$(':button').removeAttr('disabled');
		window.location.href = "<?=ROOT?>rbm"

		
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

function add_cont(){
	var terminal = $("#port").val();
	var vessel=$( "#vessel_autocomplete" ).val();
	var id_vsb_voyage=$( "#id_vsb_voyage" ).val();
	var vessel_code=$( "#vessel_code" ).val();
	var call_sign=$( "#call_sign" ).val();
	var voyage_in=$( "#voyage_in" ).val();
	var voyage_out=$( "#voyage_out" ).val();
	var no_container = $("#no_container").val();
	var no_request = $("#no_request").val();
	var type_container = $("#type_container").val();
	var size_container = $("#size_container").val();
	var status_container = $("#status_container").val();
	var height_cont = $("#height_cont").val();
	var id_cont = $("#id_cont").val();
	var hz = $("#hz").val();
	var imo_class = $("#imo_class").val();
	var un_number = $("#un_number").val();
	var iso_code = $("#iso_code").val();
	var temp = $("#temp").val();
	var weight = $("#weight").val();
	var carrier = $("#carrier").val();
	var oog = $("#oog").val();
	var over_left = $("#over_left").val();
	var over_right = $("#over_right").val();
	var over_front = $("#over_front").val();
	var over_rear = $("#over_rear").val();
	var over_height = $("#over_height").val();
	var delivery_date=$( "#delivery_date" ).val();
	var date_discharge = $( "#date_discharge" ).val();
	var delivery_type=$( "#delivery_type" ).val();
	var pod = $( "#pod" ).val();
	var pol=$( "#pol" ).val();
	var comodity=$("#comodity").val();
	var plo=$("#plo").val();
	var pli=$("#pli").val();
	var gatein_date=$("#gatein_date").val();
	
	if(type_container==''){
			alert('Pilih kontainer!');
			return false;
	}
	else if ((type_container!=='RFR') && (plo !== undefined) && (plo !== null) && (plo !== '') && (terminal=='IDJKT-T3I' || terminal=='IDJKT-T009D'|| terminal=='IDPNJ-PNJI' || terminal=='IDPNJ-PNJD'))
	{
		alert('Tanggal Plug Out Hanya Diisi Untuk Container Reefer!');
		return false;	
	}
	else if ((type_container!=='RFR') && (plo !== undefined) && (plo !== null) && (plo !== '') && ((terminal!=='IDJKT-T3I') || (terminal!=='IDJKT-T009D'|| terminal!=='IDPNJ-PNJI' || terminal!=='IDPNJ-PNJD')))
	{
		alert('Container Reefer Domestik Kecuali Site Panjang Tidak Perlu Mengisi Plug Out!');
		return false;
	}
	else if (((type_container=='RFR') && (plo=='') && (terminal=='IDJKT-T3I')) || ((type_container=='RFR') && (terminal=='IDJKT-T3I'))){
		if (plo==''){
			alert('Container Reefer, Tanggal Plug Out Tidak Boleh Kosong!');
			return false;
		} 
		else{
			var plox = plo.split(" ");//dateTime[0] = date, dateTime[1] = time
			var plix = pli.split(" ");//dateTime[0] = date, dateTime[1] = time
			var plix_date = plix[0].split("-");
			var plix_time = plix[1].split(":");
			var plix_fin = new Date(plix_date[2], (plix_date[1]-1), plix_date[0], plix_time[0], plix_time[1], 0, 0);
			//-----------------------------------------
			var plox_date = plox[0].split("-");
			var plox_time = plox[1].split(":");
			var plox_fin = new Date(plox_date[2], (plox_date[1]-1), plox_date[0], plox_time[0], plox_time[1], 0, 0);	

			if (plix_fin >= plox_fin){
				alert('Tanggal Plug Out Harus Lebih Besar Dari Tanggal Plug In!');
				return false;
			}			
		}
		//-----------------------------
		//----------------------------
	} 
	else if (((type_container=='RFR') && (plo=='') && (terminal=='IDJKT-T009D')) || ((type_container=='RFR') && (terminal=='IDJKT-T009D'))){
		if (pli !== '' && plo==''){
			alert('Container Reefer, Tanggal Plug Out Tidak Boleh Kosong!');
			alert (pli);
			return false;		
		} 
		else if((pli !== '') && (plo !== '')){
			
			var plix = pli.split(" ");//dateTime[0] = date, dateTime[1] = time
			var plox = plo.split(" ");//dateTime[0] = date, dateTime[1] = time
			var plix_date = plix[0].split("-");
			var plix_time = plix[1].split(":");
			var plix_fin = new Date(plix_date[2], (plix_date[1]-1), plix_date[0], plix_time[0], plix_time[1], 0, 0);
			//-----------------------------------------
			var plox_date = plox[0].split("-");
			var plox_time = plox[1].split(":");
			var plox_fin = new Date(plox_date[2], (plox_date[1]-1), plox_date[0], plox_time[0], plox_time[1], 0, 0);	
				
			if (plix_fin >= plox_fin){
				alert('Tanggal Plug Out Harus Lebih Besar Dari Tanggal Plug In!');
				return false;
			}			
		}
	}
		else if (((type_container=='RFR') && (plo=='') && (terminal=='IDPNJ-PNJI'||terminal=='IDPNJ-PNJD')) || ((type_container=='RFR') && (terminal=='IDPNJ-PNJI'||terminal=='IDPNJ-PNJD')))
	{
		if (pli !== '' && plo=='' && status_container=='FULL')
		{
		alert('Container Reefer FULL, Tanggal Plug Out Tidak Boleh Kosong!');
		alert (pli);
		return false;		
		} 
		else if((pli !== '') && (plo !== '')&& (status_container=='FULL'))
		{
			
				var plix = pli.split(" ");//dateTime[0] = date, dateTime[1] = time
				var plox = plo.split(" ");//dateTime[0] = date, dateTime[1] = time
				var plix_date = plix[0].split("-");
				var plix_time = plix[1].split(":");
				var plix_fin = new Date(plix_date[2], (plix_date[1]-1), plix_date[0], plix_time[0], plix_time[1], 0, 0);
				//-----------------------------------------
				var plox_date = plox[0].split("-");
				var plox_time = plox[1].split(":");
			    var plox_fin = new Date(plox_date[2], (plox_date[1]-1), plox_date[0], plox_time[0], plox_time[1], 0, 0);	
					if (plix_fin >= plox_fin)
					{
					alert('Tanggal Plug Out Harus Lebih Besar Dari Tanggal Plug In!');
					return false;
					}			
			}
			else if((pli !== '') && (plo !== '')&& (status_container=='EMPTY'))
		{
			
				var plix = pli.split(" ");//dateTime[0] = date, dateTime[1] = time
				var plox = plo.split(" ");//dateTime[0] = date, dateTime[1] = time
				var plix_date = plix[0].split("-");
				var plix_time = plix[1].split(":");
				var plix_fin = new Date(plix_date[2], (plix_date[1]-1), plix_date[0], plix_time[0], plix_time[1], 0, 0);
				//-----------------------------------------
				var plox_date = plox[0].split("-");
				var plox_time = plox[1].split(":");
			    var plox_fin = new Date(plox_date[2], (plox_date[1]-1), plox_date[0], plox_time[0], plox_time[1], 0, 0);	
					if (plix_fin >= plox_fin)
					{
					alert('Tanggal Plug Out Harus Lebih Besar Dari Tanggal Plug In!');
					return false;
					}			
			}
		
		
	}
	
	$(':button').attr('disabled','disabled');
	var url="<?=ROOT?>container/add_detail_delivery";
	$.blockUI();
	$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_REQ:no_request,TERMINAL:terminal,ID_VSB_VOYAGE:id_vsb_voyage,VESSEL:vessel,VESSEL_CODE:vessel_code,CALL_SIGN:call_sign,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out,NO_CONTAINER:no_container,SIZE_CONT:size_container,TYPE_CONT:type_container,STATUS_CONT:status_container,HEIGHT_CONT:height_cont,ID_CONT:id_cont,HZ:hz, IMO_CLASS:imo_class, UN_NUMBER:un_number, ISO_CODE:iso_code, TEMP:temp, WEIGHT:weight, CARRIER:carrier, OOG:oog, OVER_LEFT:over_left, OVER_RIGHT: over_right, OVER_FRONT:over_front, OVER_REAR:over_rear, OVER_HEIGHT:over_height,DELIVERY_DATE:delivery_date,DATE_DISCHARGE:date_discharge, DELIVERY_TYPE : delivery_type, POD : pod, POL : pol,PLUG_IN : pli, PLUG_OUT:plo, GATEIN_DATE : gatein_date},
	function(data) {
		$.unblockUI();
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Request gagal : '+v_req);
			}
			else
			{
				$("#no_container").val("");
				$("#type_container" ).val("");
				$("#size_container" ).val("");
				$("#status_container" ).val("");
				$("#height_cont" ).val("");
				$("#id_cont" ).val("");
				$("#hz" ).val("");
				$("#imo_class" ).val("");
				$("#un_number" ).val("");
				$("#iso_code" ).val("");
				$("#temp" ).val("");
				$("#weight" ).val("");
				$("#carrier" ).val("");
				$("#oog" ).val("");
				$("#over_left" ).val("");
				$("#over_right" ).val("");
				$("#over_front" ).val("");
				$("#over_rear" ).val("");
				$("#over_height").val("");
				$("#pli").val("");
				$("#plo").val("");

				var url = "<?=ROOT?>container/get_detail_delivery/add/"+no_request+"/"+terminal;
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
				window.location = "<?=ROOT?>container/main_delivery";
			}
		});
}

function delete_container(no_container){
	var terminal = $("#port").val();
	var no_request = $("#no_request").val();
	var vessel_code=$( "#vessel_code" ).val();
	var voyage=$( "#voyage" ).val();

	var url="<?=ROOT?>container/del_cont_req_delivery";
	$.post(url,{NO_CONTAINER:no_container, NO_REQUEST:no_request, TERMINAL:terminal, VESSEL_CODE:vessel_code, VOYAGE:voyage,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
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
				$("#detail_container").load("<?=ROOT?>container/get_detail_delivery/add/"+no_request+"/"+terminal);
				alert(v_msg+'.'+no_container+" deleted");
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
	$( "#no_container" ).autocomplete({
		minLength: 11,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>container/auto_container_delivery?",{ term: $( "#no_container" ).val(), vessel_code: $("#vessel_code").val(), voyage_in: $("#voyage_in").val(), voyage_out: $("#voyage_out").val(),port: $("#port").val(),del_type : $("#delivery_type").val(),no_booking : $("#nobook").val(),vessel: $("#vessel_autocomplete").val()}, response);

			},
		focus: function( event, ui )
		{
			$( "#no_container" ).val( ui.item.NO_CONTAINER);
			return false;
		},
		select: function( event, ui )
		{
			$('.loading').html("sedang mencari data....");
			$("#no_container").val( ui.item.NO_CONTAINER);
			$("#type_container" ).val( ui.item.TYPE_CONT);
			$("#size_container" ).val( ui.item.SIZE_CONT);
			$("#status_container" ).val( ui.item.STATUS_CONT);
			$("#height_cont" ).val( ui.item.HEIGHT_CONT);
			$("#id_cont" ).val( ui.item.ID_CONT);
			$("#hz" ).val( ui.item.HZ);
			$("#imo_class" ).val( ui.item.IMO_CLASS);
			$("#un_number" ).val( ui.item.UN_NUMBER);
			$("#iso_code" ).val( ui.item.ISO_CODE);
			$("#temp" ).val( ui.item.TEMP);
			$("#weight" ).val( ui.item.WEIGHT);
			$("#carrier" ).val( ui.item.CARRIER);
			$("#oog" ).val( ui.item.OOG);
			$("#over_left" ).val( ui.item.OVER_LEFT);
			$("#over_right" ).val( ui.item.OVER_RIGHT);
			$("#over_front" ).val( ui.item.OVER_FRONT);
			$("#over_rear" ).val( ui.item.OVER_REAR);
			$("#over_height").val( ui.item.OVER_HEIGHT);
			$("#pod" ).val( ui.item.POD);
			$("#pol" ).val( ui.item.POL);
			$("#comodity").val( ui.item.COMODITY);
			$("#pli").val( ui.item.PLUG_IN);
			$("#gatein_date").val( ui.item.GATEIN_DATE);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.NO_CONTAINER + "<br>" +item.TYPE_CONT+" - " +item.SIZE_CONT+" - " +item.STATUS_CONT+"</a>")
		.appendTo( ul );
		$('.loading').html("");
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
	$('#vessel_autocomplete').val('');
	$('#voyage_in').val('');
	$('#voyage_out').val('');
	$('#eta').val('');
	$('#etd').val('');

	var termn=$('#port').val();
	//alert('tes');
	$("#delivery_type option[value='TL']").removeAttr("disabled");
	$("#delivery_type").removeAttr("disabled");
	$("#delivery_type option[value='TL']").show();
	$("#frm_delivery_via").addClass('hidden_content');
	if(termn=='IDJKT-T3I' || termn=='IDJKT-L2D' || termn=='IDJKT-L2I' ||termn=='IDPNJ-PNJI'|| termn=='IDPNJ-PNJD'){
		$("#delivery_type").val('LAP');
		$('#delivery_type').attr('disabled',true);
	} else if (termn=='IDJKT-T009D')
	{
		if ($("#delivery_type").val() == "TL"){
					$("#delivery_type").val("");
		}
		$("#delivery_type option[value='TL']").prop('disabled',true);
	} else if (termn == 'IDDJB-DJBD' || termn == 'IDDJB-DJBI' || termn == 'IDTLB-TLBD' || termn == 'IDTLB-TLBI')
	{
		$('#delivery_type').val('LAP');
		$("#delivery_type option[value='TL']").attr("disabled", "disabled");
		$("#delivery_type option[value='TL']").hide();
		$("#frm_delivery_via").removeClass('hidden_content');

	} else
	{

		// if(termn=="IDDJB-DJBD" || termn=="IDDJB-DJBI" || termn=="IDTLB-TLBI" || termn=="IDTLB-TLBD"){
		// 	$('#delivery_type').attr('disabled',false);
		// 	$('#delivery_type').find('[value="TONGKANG"]').remove();
		// 	$('#delivery_type').find('[value="LAP"]').remove();
		// 	$('#delivery_type').append('<option value="TONGKANG">Tongkang</option>');
		// }else{
		// 	$('#delivery_type').find('[value="TONGKANG"]').remove();
		// 	$('#delivery_type').attr('disabled',false);
		// 	$("#delivery_type option[value='TL']").prop('disabled',false);
		// }
	}
	
	if(termn=='IDJKT-L2D' || termn=='IDJKT-L2I'){
		$('.custom-hidden').hide();
	}
}
</script>
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Booking Data</h2>
								</header>

									<div class="main-box-body clearfix">
										<div class="form-group">
											<label for="exampleTooltip">Request Number</label>
											<input name="no_request" id="no_request" type="text" class="form-control" placeholder="-" data-toggle="tooltip" data-placement="bottom" value="<?php echo $req_id; ?>" title="Nomor Permintaan" size="20" readOnly>
										</div>
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" onchange="cekTipeYd()">
												<option> -- Please Choose Terminal -- </option>

												<?php
												foreach($terminal as $term)
												{

													if ($term['PORT'].'-'.$term['TERMINAL'] == $port_id_and_terminal_id)
													{
														$selected = 'selected';
													}
													else
													{
														$selected = '';
													}
													// echo '<option value="'. $term['PORT'] .'-'. $term['TERMINAL'] .'" '.$selected.'>'. $vessel .'</option>';

													echo '<option value="'. $term['PORT'] .'-'. $term['TERMINAL'] .'" '.$selected.'>'. $term['TERMINAL_NAME'] .'</option>';
												}
												?>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
											<div class="form-wrapper cf">
												<input type="text" id="vessel_autocomplete"
												name="vessel_autocomplete" value="<?= $vessel; ?>" placeholder="Search here..." title="Masukkan data kapal" required>
												<button type="submit" onclick="search_vessel()">Search</button>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" value="<?= $voyage_in; ?>" placeholder="Voyage In" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" value="<?= $voyage_out; ?>" placeholder="Voyage Out" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ETA</label>
												<input type="text" class="form-control" id="eta" name="eta" value="<?= $eta; ?>" placeholder="ETA" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ETD</label>
												<input type="text" class="form-control" id="etd" name="etd" value="<?= $etd; ?>" placeholder="ETD" title="Masukkan data kapal" size="8" readonly>
											</div>
											<label for="exampleAutocomplete">Customer</label>
											<div class="form-wrapper cf">
												<input type="text" id="customer_autocomplete"
												name="customer_autocomplete" placeholder="Search here..." title="Masukkan data kapal" value="<?php echo $customer_name; ?>" required>
												<button type="submit" onclick="search_customer()">Search</button>
											</div>
											<div class="form-group col-xs-12">
												<label>NPWP</label>
												<input type="text" class="form-control" id="npwp" name="npwp" value="<?php echo $npwp; ?>">
											</div>
											<div class="form-group col-xs-12">
												<label>Address</label>
												<input type="text" class="form-control" id="address" name="address" value="<?php echo $customer_address; ?>">
												<input type="hidden" class="form-control" id="kd_pelanggan" name="kd_pelanggan">
											</div>

											<input type="hidden" id="id_vsb_voyage" name="id_vsb_voyage">
											<input type="hidden" id="vessel_code" name="vessel_code">
											<input type="hidden" id="voyage" name="voyage">
											<input type="hidden" id="call_sign" name="call_sign">
											<input type="hidden" id="date_discharge" name="date_discharge">
										</div>
										
										<button id="submit_header" onclick="submitrbm()" class="btn btn-success">Save</button>
								</div>
							</div>
						</div>
						<div class="col-lg-6 hidden_content"  id='international_content'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>*International Only</h2>
								</header> 

								<div class="main-box-body clearfix">
										<div class="form-group">
												<label>SPPB Type</label>
												<select id="sppbtype" name="sppbtype" class="form-control" onchange="cekTipeYd()">
													<option value=""> -- Please Choose -- </option>
												<?php
												foreach($sppbtype as $datasppb)
												{
												?>
													<option value="<?=$datasppb["ID_DOKUMEN"]?>"><?=$datasppb["NAMA_DOKUMEN"]?></option>
												<?php
												}
												?>
												</select>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SPPB Number</label>
											<input id="no_sppb" name="no_sppb" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor SPPB" maxlength="40">
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">SPPB Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sppb_date" name="sppb_date" type="text" class="form-control" id="datepickerDate">
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<form  action="POST" class="myForm2" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">SPPB Upload</label>
												<input id="sppb_upload" name="sppb_upload" type="file" accept=".pdf" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SPPB" size="100" />
												<span class='upload_info'>
												Accepted File Type: PDF, Max Size: <?php echo $max_size?></span>
											</form>
										</div>
										<div class="form-group  custom-hidden">
											<label for="exampleTooltip">SP Custom Number</label>
											<input id="no_sp_custom" name="no_sp_custom"type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor SP Custom" size="10" maxlength="40">
										</div>
										<div class="form-group col-md-12  custom-hidden">
											<label for="datepickerDate">SP Custom Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sp_custom_date" name="sp_custom_date" type="text" class="form-control" id="datepickerDate">
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group custom-hidden" >
											<form  action="POST" class="myForm3" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">SP Custom Upload</label>
												<input id="sp_custom_upload" name="sp_custom_upload" type="file" accept=".pdf" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SP Custom" size="100">
												<span class='upload_info'>
												Accepted File Type: PDF, Max Size: <?php echo $max_size?></span>
											</form>
										</div>
								</div>
							</div>
						</div>
					</div>
							<div id="container_data" name="container_data" class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Container Data</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="form-inline" role="form">
												<div class="form-group">
													<label for="exampleTooltip">Container Number</label>
													<input id="no_container" name="no_container" type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Nomor Kontainer">
													<span class="loading" style="display:none"></span>
													<input id="type_container" name="type_container" type="text" class="form-control" placeholder="Type" data-toggle="tooltip" data-placement="bottom" title="Type" size="8" onchange="cekTipeCont()" readOnly>
													<input id="size_container" name="size_container" type="text" class="form-control" placeholder="Size" data-toggle="tooltip" data-placement="bottom" title="Size" size="8" readOnly>
													<input id="status_container" name="status_container" type="text" class="form-control" placeholder="Status" data-toggle="tooltip" data-placement="bottom" title="Status" size="8" readOnly>
													<input id="pli" name="pli" type="text" class="form-control" placeholder="Plugin for Reefer" data-toggle="tooltip" data-placement="bottom" title="Plug In" size="18" readonly>
													<input id="plo" name="plo" type="text" class="form-control" placeholder="Plugout for Reefer" data-toggle="tooltip" data-placement="bottom" title="Plug Out" size="18">		
													<input id="height_cont" name="height_cont" type="hidden">
													<input id="id_cont" name="id_cont" type="hidden">
													<input id="hz" name="hz" type="hidden">
													<input id="imo_class" name="imo_class" type="hidden">
													<input id="un_number" name="un_number" type="hidden">
													<input id="iso_code" name="iso_code" type="hidden">
													<input id="temp" name="temp" type="hidden">
													<input id="weight" name="weight" type="hidden">
													<input id="carrier" name="carrier" type="hidden">
													<input id="oog" name="oog" type="hidden">
													<input id="over_left" name="over_left" type="hidden">
													<input id="over_right" name="over_right" type="hidden">
													<input id="over_front" name="over_front" type="hidden">
													<input id="over_rear" name="over_rear" type="hidden">
													<input id="over_height" name="over_height" type="hidden">
													<input id="pod" name="pod" type="hidden">
													<input id="pol" name="pol" type="hidden">
													<input id="comodity" name="comodity" type="hidden">
													<input id="gatein_date" name="gatein_date" type="hidden">
												</div>
												<button onclick="add_cont();" class="btn btn-success">Add</button>
												<br><i><font size='1'>*Field Reefer Plug-Out Hanya Diisi Untuk Container Reefer Ocean Going</font></i></br>
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
									<form method="post" enctype="multipart/form-data" action="<?=ROOT?>container/upload_excel_delivery">
										<div class="form-group">
											<label for="exampleTooltip">Upload</label>
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<input type="hidden" id="req_excel" name="req_excel" value="">
											<input type="hidden" id="terminal_excel" name="terminal_excel" value="">
											<input type="hidden" id="vessel_excel" name="vessel_excel" value="">
											<input type="hidden" id="id_vsb_voyage_excel" name="id_vsb_voyage_excel" value="">
											<input type="hidden" id="vessel_code_excel" name="vessel_code_excel" value="">
											<input type="hidden" id="call_sign_excel" name="call_sign_excel" value="">
											<input type="hidden" id="voyage_in_excel" name="voyage_in_excel" value="">
											<input type="hidden" id="voyage_out_excel" name="voyage_out_excel" value="">
											<input type="hidden" id="date_delivery_excel" name="date_delivery_excel" value="">
											<input type="hidden" id="date_discharge_excel" name="date_discharge_excel" value="">
											<input type="hidden" id="delivery_type_excel" name="delivery_type_excel" value="">
											<input type="file" accept=".xls" id="userfile" name="userfile" data-toggle="tooltip" data-placement="bottom" title="Upload file Excel">
										</div>
										<button type="submit" class="btn btn-success">Upload</button>
										<a href="<?=APP_ROOT?>templateupload/Template_Upload_Container_Delivery.xls">Download Template</a>
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
									<h2 class="pull-left">Container List</h2>
								</header>

								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><span>Container Number</span></a></th>
													<th><span>Size</span></a></th>
													<th><span>Type</span></a></th>
													<th><span>Status</span></a></th>
													<th><span>Height</span></a></th>
													<th><span>Hazard</span></a></th>
													<th><span>Carrier</span></a></th>
													<th><span>Plug IN</span></a></th>
													<th><span>Plug OUT</span></a></th>
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
									<button type="submit" onclick="window.open('<?=ROOT.'container/main_delivery'?>','_self');" class="btn btn-success">Next</button>
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
  function search_customer(){
      var vesselname = $("#customer_autocomplete").val();
      var port       = $('#port').val();
      //var url = "<?=ROOT?>autocomplete/getVesselList";
      if(vesselname == ''){
          $("#customer_autocomplete").focus();
          alert('Mohon diisi kolomnya');
      }
      else{
        $.get("<?=ROOT?>createrbm/auto_customer_rbm?",{term : vesselname, port: port}, function(data){
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
    function completeCustomer($kd_pelanggan,$nama_perusahaan,$no_npwp,$alamat_perusahaan){
        $( "#customer_autocomplete" ).val($nama_perusahaan);
  			$( "#npwp" ).val($no_npwp);
  			$( "#address" ).val($alamat_perusahaan);
  			$( "#kd_pelanggan" ).val($kd_pelanggan);

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
