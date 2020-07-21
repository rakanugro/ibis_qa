<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<!-- script src="<?=CUBE_?>js/jquery-ui.min.js"></script -->
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<?php //echo var_dump($request_data);die;?>
<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});

	$("#is_vgmterminal").on('click',function(){
			//alert('test');
			if(document.getElementById("is_vgmterminal").checked){
				$("#container_vgm").attr('style','display:none');
			}
			else {
				$("#container_vgm").removeAttr('style','display:none');
			}
	});
});

$(function() {
	getIsoCode($("#container_size").val(),$("#container_type").val(),$("#container_height").val(),$("#port").val());
	$( "#vessel_autocomplete" ).autocomplete({
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
		.append( "<a align='center'><p class='repo-language'>" + item.VESSEL + "</p><p class='repo-name'>" +item.VOYAGE_IN+"-"+item.VOYAGE_OUT+"</p></a>")
		.appendTo( ul );
	};



	$( "#pod_autocomplete" ).autocomplete({
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
	}).data( "uiAutocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.NM_PELABUHAN + "<br>" +item.ID_PELABUHAN+"</a>")
		.appendTo( ul );
	};

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
	}).data( "uiAutocomplete" )._renderItem = function( ul, item ){
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.CODE + "<br>" +item.LINE_OPERATOR+"</a>")
		.appendTo( ul );
	};*/


	$( "#commodity" ).autocomplete({
		minLength: 3,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>container_receiving/auto_commodity?",{  term: $( "#commodity" ).val(),
																		  port: $('#port').val()
																		 }, response);
			},
		focus: function( event, ui )
		{
			$( "#commodity" ).val( ui.item.COMMODITY);
			return false;
		},
		select: function( event, ui )
		{
			$( "#commodity" ).val( ui.item.COMMODITY);
			$( "#kd_commodity" ).val( ui.item.KD_COMMODITY);

			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item ){
		//console.log('TEST');
		//console.log(ul);
		console.log(item);
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.COMMODITY + "<br>" +item.KD_COMMODITY+"</a>")
		.appendTo( ul );

	};
	
	$( "#all_commodity" ).autocomplete({
		minLength: 3,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>container_receiving/auto_commodity?",{  term: $( "#all_commodity" ).val(),
																		  port: $('#port').val()
																		 }, response);
			},
		focus: function( event, ui )
		{
			$( "#all_commodity" ).val( ui.item.COMMODITY);
			return false;
		},
		select: function( event, ui )
		{
			$( "#all_commodity" ).val( ui.item.COMMODITY);
			$( "#all_kd_commodity" ).val( ui.item.KD_COMMODITY);

			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item ){
		//console.log('TEST');
		//console.log(ul);
		console.log(item);
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.COMMODITY + "<br>" +item.KD_COMMODITY+"</a>")
		.appendTo( ul );

	};

	// Validasi Container
	$("#container_autocomplete").keyup(function(event) {
		var inp = String.fromCharCode(event.keyCode);
		var val = $(this).val();
		if (/[a-zA-Z]/.test(inp)){
			$(this).val(val.toUpperCase());
		} else if (/ /.test(inp)){
			$(this).val( val.replace(' ', '') );
		}

		if (val.length == 11){
			var validate_status = validate_container(val, false);
			// show message/feedback
			if (validate_status){
				$('#cont_status_icon')
					.addClass('glyphicon-ok').removeClass('glyphicon-remove');
				$(this).parent()
					.removeClass('has-error');
				$('#error_text').parent().hide();
				$('#invalid_container').val("false");
			} else {
				$('#cont_status_icon')
					.addClass('glyphicon-remove').removeClass('glyphicon-ok');
				$(this).parent()
					.addClass('has-error');
				$('#error_text').parent().hide();
				//$('#error_text').html('Invalid Container').parent().show();
			}
		}
		$('#invalid_container').val("true");
	}).on('focusout', function(){
		var val = $(this).val();
		if (val.length < 11){
			// show message/feedback
			$('#cont_status_icon')
				.addClass('glyphicon-remove').removeClass('glyphicon-ok');
			$(this).parent()
				.addClass('has-error');
			$('#error_text').html('Container number length less than 11 letters and digits').parent().show();
		}
	});



		$("#container_size").on('change', function(){
			if($('#container_size').val() == '21') {
				$('#container_height').val('9.6');
				$("#container_type").val('DRY');
				document.getElementById("container_height").disabled=true;
				document.getElementById("container_type").disabled=true;
			} else {
				$('#container_height').val('8.6');
				document.getElementById("container_height").disabled=false;
				document.getElementById("container_type").disabled=false;
			}
			
			getIsoCode($("#container_size").val(),$("#container_type").val(),$("#container_height").val(),$("#port").val());
			
		});
		// Validasi tipe
		$("#container_type").on('change', function(){
			if ($(this).val() == 'RFR'){
				$('#container_temperature').prop('disabled', false);
				$('#component_reefer').removeClass('hidden_content');
			}
			else {
				$('#container_temperature').prop('disabled', true);
				$('#component_reefer').addClass('hidden_content');
			}
			
			if ($(this).val() == 'HQ'){
				$('#container_height').val('9.6');
			}
			else {
				$('#container_height').val('8.6');
			}
			getIsoCode($("#container_size").val(),$("#container_type").val(),$("#container_height").val(),$("#port").val());
		});

		$("#reefer_nor").on('change', function(){
			if ($(this).val() == 'Y'){
				$('#container_temperature').prop('disabled', true);
			} else if ($(this).val() == 'N'&&$("#container_type").val() == 'RFR') {
				$('#container_temperature').prop('disabled', false);
			}
		});

		$("#container_status").on('change', function(){
			if ($(this).val() == 'F'){
				$("#commodity").val("GENERAL CARGO");
				$('#kd_commodity').val('C000000492');
			} else {
				$("#commodity").val("EMPTY");
				$('#kd_commodity').val('C000001383');
			}
		});

	$("#container_dangerous").on('change', function(){
		if ($(this).val() == 'Y'){
			$('#container_imo').prop('disabled', false);
			$('#container_un').prop('disabled', false);
		} else if ($(this).val() == 'N'){
			$('#container_imo').prop('disabled', true);
			$('#container_un').prop('disabled', true);
		}
	});

	$("#container_height").on('change', function(){
		if ($(this).val() == 'OOG'){
			$('#container_excess_width').prop('disabled', false);
			$('#container_excess_height').prop('disabled', false);
			$('#container_excess_length').prop('disabled', false);
			
			$('#container_excess_left').prop('disabled', false);
			$('#container_excess_right').prop('disabled', false);
			$('#container_excess_front').prop('disabled', false);
			$('#container_excess_rear').prop('disabled', false);
		} else {
			$('#container_excess_width').prop('disabled', true);
			$('#container_excess_height').prop('disabled', true);
			$('#container_excess_length').prop('disabled', true);

			$('#container_excess_left').prop('disabled', true);
			$('#container_excess_right').prop('disabled', true);
			$('#container_excess_front').prop('disabled', true);
			$('#container_excess_rear').prop('disabled', true);
		}

		getIsoCode($("#container_size").val(),$("#container_type").val(),$("#container_height").val(),$("#port").val());
	});
});

//datepicker
$('#start_shift').datepicker({
	format: 'dd-mm-yyyy 00:00'
});

function calculate(b) {
	if (b.length > 9) {
		var a = {};
		a.A = 10; a.B = 12; a.C = 13; a.D = 14; a.E = 15; a.F = 16; a.G = 17; a.H = 18;
		a.I = 19; a.J = 20; a.K = 21; a.L = 23; a.M = 24; a.N = 25; a.O = 26; a.P = 27;
		a.Q = 28; a.R = 29; a.S = 30; a.T = 31; a.U = 32; a.V = 34; a.W = 35; a.X = 36;
		a.Y = 37; a.Z = 38;
		var c = [];
		c[0] = 1; c[1] = 2; c[2] = 4; c[3] = 8; c[4] = 16;
		c[5] = 32; c[6] = 64; c[7] = 128; c[8] = 256; c[9] = 512;
		var d = [],
			e = 0;
		for (lcv = 0; lcv < 4; lcv++) d[lcv] = a[b.charAt(lcv)];
		for (lcv = 4; lcv < 10; lcv++) d[lcv] = parseInt(b.charAt(lcv), 10);
		for (lcv = 0; lcv < 10; lcv++) {
			d[lcv] *= c[lcv];
			e += d[lcv]
		}
		De = e % 11;
		if (De == 10) De = 0;
		return De
	} else alert()
}

function validate_container(input, bypass_valid){
	var output = false;
	if (bypass_valid != true){
		input = input.replace(/^\s*([\S\s]*?)\s*$/, "$1");
		if (/^[A-Z]{4}\d{6,7}/.test(input)) {
			var temp = {};
			checkDigit = calculate(input.replace("-", ""));
			output =
				input.length > 10 && input.length < 13 ?
					checkDigit == input.replace("-", "").charAt(10) ?
						true :
						false :
					input.length == 10 ?
						false : //'{' + input + ": " + checkDigit + "}" :
					false;
		} else {
			// output =
			// input.length == 0 ? "\n" : "\n" + input + " Bad";
			output = false;
		}
		console.log(output);
	} else {
		output = true;
	}
	return output;
}

function validate_upload_form(){
	//alert(document.forms["upload_form"]["fname"].value);
	//.return false;
	var x = document.forms["upload_form"]["userfile"].value;
    if (x == null || x == "") {
        alert("Please choose file to be uploaded");
        return false;
    }
}

function getIsoCode($size,$type,$height,$terminal){
		var url = "<?=ROOT?>container_receiving/get_isocode";
		$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',SC:$size,TC:$type,HGC:$height,PORT:$terminal}, function(data){
				//alert(data);
				$("#isocodevalue").html(data);
		});
}

function updqty($type){
		var request_no = $("#request_no").val();
		$.post("<?=ROOT?>container_receiving/update_qty_cont",{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,type:$type},function(data){});
}

</script>

<script type="text/javascript">

$( document ).ready(function() {

		//validasi saat edit peb upload
		$('#peb_upload').change(function() {

			var namafile9,panjangfile9;
			namafile9=document.getElementById('peb_upload').value;
			panjangfile9=namafile9.length;

			if(panjangfile9>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('peb_upload').value="";

			}

			var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('peb_upload').files[0].type;

			if(files != sDoType) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('peb_upload').value="";
				return false;
			}
		});

		//validasi saat edit npe upload
		$('#npe_upload').change(function() {

			var namafile8,panjangfile8;
			namafile8=document.getElementById('npe_upload').value;
			panjangfile8=namafile8.length;

			if(panjangfile8>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('npe_upload').value="";

			}
			var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('npe_upload').files[0].type;

			if(files != sDoType) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('npe_upload').value="";
				return false;
			}
		});

		//validasi saat edit booking ship upload
		$('#booking_ship_upload').change(function() {

			var namafile7,panjangfile7;
			namafile7=document.getElementById('booking_ship_upload').value;
			panjangfile7=namafile7.length;

			if(panjangfile7>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('booking_ship_upload').value="";

			}

			var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('booking_ship_upload').files[0].type;

			if(files != sDoType) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('booking_ship_upload').value="";
				return false;
			}
		});

		//validasi saat edit upload file excel
		$('#userfile').change(function() {

			var namafile6,panjangfile6;
			namafile6=document.getElementById('userfile').value;
			panjangfile6=namafile6.length;

			if(panjangfile6>255){
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

	<?
		if($message){?>
			alert('<?=str_replace("<br>","\\n",urldecode($message))?>');

		<?}
	?>
	$( "#request_no" ).val('<?=$request_data["ID_REQ"];?>');
	$( "#req_excel" ).val('<?=$request_data["ID_REQ"];?>');
	$("#port").val('<?=$request_data["ID_PORT"].'-'.$request_data["ID_TERMINAL"]?>');
	$("#port_excel").val('<?=$request_data["ID_PORT"].'-'.$request_data["ID_TERMINAL"]?>');
	$( "#vessel_autocomplete" ).val( '<?=$request_data["VESSEL"]?>');
	$( "#voyage_in" ).val( '<?=$request_data["VOYAGE_IN"]?>');
	$( "#voyage_out" ).val( '<?=$request_data["VOYAGE_OUT"]?>');
	$( "#ukk" ).val( '<?=$request_data["ID_VES_VOYAGE"]?>');
	$( "#trading_type" ).val( '<?=$request_data["OI"]?>');
	$( "#trading_type_excel" ).val( '<?=$request_data["OI"]?>');
	$( "#pod_autocomplete" ).val( '<?=$request_data["IDPOD"].' : '.$request_data["POD"]?>');
	$( "#fpod_autocomplete" ).val( '<?=$request_data["IDFPOD"].' : '.$request_data["FPOD"];?>');
	$( "#peb_no" ).val( '<?=$request_data["PEB"]?>');
	$( "#npe_no" ).val( '<?=$request_data["NPE"]?>');
	$("#booking_ship_no").val('<?=$request_data["BOOKING_NUMB"]?>');
	$( "#peb_file" ).val( '<?=$request_data["PEB_FILE"]?>');
	$( "#npe_file" ).val( '<?=$request_data["NPE_FILE"]?>');
	$( "#bookship_file" ).val( '<?=$request_data["BOOKSHIP_FILE"]?>');
	$( "#booking_ship_upload_dom" ).val( '<?=$request_data["BOOKSHIP_FILE"]?>');
	$( "#npe_no" ).val( '<?=$request_data["NPE"]?>');
	$("#booking_ship_no").val('<?=$request_data["BOOKING_NUMB"]?>');
	$( "#vessel_code" ).val( '<?=$request_data["VESSEL_CODE"]?>');
	$( "#voyage" ).val( '<?=$request_data["VOYAGE"]?>');
	$("#call_sign").val('<?=$request_data["CALL_SIGN"]?>');
	$("#receiving_type").val('<?=$request_data["TL_FLAG"]?>');
	//$("#receiving_type").val('<?=$request_data["DEV_VIA"]?>');
	$("#nospp").val('<?=$request_data["NO_SPP"]?>');
	$("#nosppdom").val('<?=$request_data["NO_SPP"]?>');
	$("#nosuratjalan").val('<?=$request_data["NO_SURAT_JALAN"]?>');
	$("#bookingship009").val('<?=$request_data["BOOKING_NUMB"]?>');
	$("#bookingshipdom").val('<?=$request_data["BOOKING_NUMB"]?>');
	 //alert('<?=$request_data['TL_FLAG']?>');

	var kode_perdagangan = $("#port").val().slice(-1);

	if (kode_perdagangan == 'I'){
		$('#international_content').removeClass('hidden_content');
		$('#field_vgm_weight').removeAttr('style','display:none');
	} else {
		$('#international_content').addClass('hidden_content');
		$('#field_vgm_weight').attr('style','display:none');
	}

	var terminal = ( $("#port").val().split('-') )[1];
	if (terminal == 'T009D'){
		$('#nolnol9_content').removeClass('hidden_content');
		$('#pjg_domestik_content').addClass('hidden_content');
	} else if (terminal == 'PNJD'){
		$('#pjg_domestik_content').removeClass('hidden_content');
		$('#nolnol9_content').addClass('hidden_content');
	} else {
		$('#nolnol9_content').addClass('hidden_content');
		$('#pjg_domestik_content').addClass('hidden_content');
	}
	
	if (terminal == 'PNJI' || terminal == 'PNJD') {
		$('#div_container_transit').removeClass('hidden_content');
		$('#apply_all_commodity').removeClass('hidden_content');
	} else {
		$('#div_container_transit').addClass('hidden_content');
		$('#apply_all_commodity').addClass('hidden_content');
	}

	var url = "<?=ROOT?>container_receiving/view_detail_receiving/edit";
	$("#rowdetail").load("<?=ROOT?>container_receiving/getListContainer",{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:'<?=$request_data["ID_REQ"];?>',port:'<?=$request_data["ID_PORT"];?>'+'-'+'<?=$request_data["ID_TERMINAL"];?>'});
});

function delete_cont(nocont,noreq,carrier_cont) {
	$.blockUI();
	var url = "<?=ROOT?>container_receiving/delete_container";
	var port = '<?=$request_data["ID_PORT"]?>';
	var terminal = '<?=$request_data["ID_TERMINAL"]?>';
	var vessel_code = $( "#vessel_code" ).val();
	var call_sign = $( "#call_sign" ).val();
	var voyage = $( "#voyage" ).val();
	//alert('test');
	$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_CONT:nocont,NO_REQ:noreq,PORT:port,TERMINAL:terminal,VESSEL_CODE:vessel_code,CALL_SIGN:call_sign,VOYAGE:voyage,CARRIERCONT:carrier_cont},function(data){
		var obj = jQuery.parseJSON(data);

		if(obj.rc=="F")
		{
			var notification = new NotificationFx({
				message : '<p>Delete Container Gagal </p><br/>'+obj.rcmsg,
				layout : 'growl',
				effect : 'jelly',
				type : 'error' // notice, warning, error or success

			});
		}
		else if(obj.data.info=="OK")
		{
			var notification = new NotificationFx({
				message : '<p>Delete Container Sukses</p>',
				layout : 'growl',
				effect : 'jelly',
				type : 'success' // notice, warning, error or success

			});

		}
		else{
			var notification = new NotificationFx({
				message : '<p>Delete Container Gagal </p><br/>'+obj.data,
				layout : 'growl',
				effect : 'jelly',
				type : 'error' // notice, warning, error or success

			});
		}
		$.unblockUI();	
		// show the notification
		notification.show();
		$("#rowdetail").load("<?=ROOT?>container_receiving/getListContainer",{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:noreq,port:port+'-'+terminal});
	});

}

function submit_container() {

	var request_no = $("#request_no").val();
	var bookingshipdom = $("#bookingshipdom").val();
	var booking_ship_no = $("#booking_ship_no").val();
	var container_autocomplete = $("#container_autocomplete").val();
	var container_size = $("#container_size").val();
	var container_type = $("#container_type").val();
	var container_status = $("#container_status").val();
	var container_height = $("#container_height").val();
	//optional
	var container_weight = $("#container_weight").val();
	var container_operator = $("#container_operator").val();
	var container_dangerous = $("#container_dangerous").val();
	var container_transit = $("#container_transit").val();
	var container_imo = $("#container_imo").val();
	var container_un = $("#container_un").val();
	var container_temperature = $("#container_temperature").val();
	var container_excess_width = $("#container_excess_width").val();
	var container_excess_height = $("#container_excess_height").val();
	var container_excess_length = $("#container_excess_length").val();
	
	var container_excess_left = $("#container_excess_left").val();
	var container_excess_right = $("#container_excess_right").val();
	var container_excess_front = $("#container_excess_front").val();
	var container_excess_rear = $("#container_excess_rear").val();
	
	var trading_type = $("#trading_type").val();
	var port = $("#port").val();
	var carrier = $("#container_operator").val();
	var commodity = $("#kd_commodity").val();
	var tl_type = $("#receiving_type").val();
	var nor = $("#reefer_nor").val();
	var vgm = $("#container_vgm").val();
	var kode_perdagangan = $("#port").val().slice(-1);
	
	var number_booking_ship = "";
		if (port == 'IDPNJ-PNJI') {
			number_booking_ship = booking_ship_no;
		} else if (port == 'IDPNJ-PNJD') {
			number_booking_ship = bookingshipdom;
		}
	if($('#invalid_container').val()=="true")
	{
		var r = confirm("Invalid Container.\nDo you want to Submit?");
		if(!r)
		{
			return;
		}
	}

	if(request_no=="")
	{
		alert("Simpan data permintaan dan dapatkan no request");
		$( "#request_no" ).focus();
		return false;
	}
	if(container_autocomplete=="")
	{
		alert("No Kontainer harus diisi");
		$( "#container_autocomplete" ).focus();
		return false;
	}
	if(container_size=="")
	{
		alert("Ukuran Container harus diisi");
		$( "#container_size" ).focus();
		return false;
	}
	if(container_type=="")
	{
		alert("Tipe Container harus diisi");
		$( "#container_type" ).focus();
		return false;
	}
	if(container_status=="")
	{
		alert("Status Container harus diisi");
		$( "#container_status" ).focus();
		return false;
	}
	if(container_height=="")
	{
		alert("Tinggi Container harus diisi");
		$( "#container_high" ).focus();
		return false;
	}

	if(container_weight == ""){
			alert("Weight NPE Harus Diisi");
			$("#container_weight").focus();
			return false;
	}
	var explode = port.split('-');
	      if(explode[0]!="IDDJB"){
			if(kode_perdagangan == 'I'){
				if(!document.getElementById("is_vgmterminal").checked){
						if(vgm == ""){
							alert("Bila anda tidak menunjuk terminal sebagai penyedia vgm, kolom weight vgm wajib diisi");
							$("#container_vgm").focus();
							return false;
						}
				}
			}
		}	

	if(container_operator=="")
	{
		alert("Operator/Carrier Container harus diisi");
		$( "#container_operator" ).focus();
		return false;
	}

	//VALIDASI TIPE CONTAINER
	//JIKA TO3 & JICT2
	if(explode[1]=="T3D"||explode[1]=="T3I"||explode[1]=="JICT2"){
		if(container_height=="OOG" && (container_excess_left=="" &&  container_excess_right=="" && container_excess_front=="" && container_excess_rear==""))
		{
			alert("Over Left, Over Right, Over Front, Rear harus diisi");
			$( "#container_excess_width" ).focus();
			return false;
		}
	}else{

		if(container_height=="OOG" && (container_excess_width=="" &&  container_excess_height=="" && container_excess_length==""))
		{
			alert("Over Width, Over Height, Over Length harus diisi");
			$( "#container_excess_width" ).focus();
			return false;
		}
	}

	if(container_type=="RFR" && container_temperature=="" && nor=="N")
	{
		alert("Temperature harus diisi");
		$( "#container_temperature" ).focus();
		return false;
	}

	/*$.post( "<?=ROOT?>container_receiving/submit_edit_receiving", {submit_container:true, request_no:request_no, container_no:container_autocomplete,
													 container_size:container_size, container_type:container_type, container_status:container_status,
													 container_height:container_height, container_weight:container_weight, container_operator:container_operator,
													 container_dangerous:container_dangerous, container_imo:container_imo, container_un:container_un,
													 container_temperature:container_temperature, container_excess_width:container_excess_width,
													 container_excess_height:container_excess_height, container_excess_length:container_excess_length,
													 trading_type:trading_type, carrier:carrier,port:port,commodity:commodity, tl_type:tl_type
													})*/

	$(':button').attr('disabled','disabled');
	$.blockUI();
	$.post( "<?=ROOT?>container_receiving/add_receiving", {
													 '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
													 submit_container:true, request_no:request_no, container_no:container_autocomplete,
													 container_size:container_size, container_type:container_type, container_status:container_status,
													 container_height:container_height, container_weight:container_weight, container_operator:container_operator,
													 container_dangerous:container_dangerous, container_transit:container_transit, number_booking_ship:number_booking_ship, container_imo:container_imo, container_un:container_un,
													 container_temperature:container_temperature, container_excess_width:container_excess_width,
													 container_excess_height:container_excess_height, container_excess_length:container_excess_length,
													 trading_type:trading_type, carrier:carrier,port:port,commodity:commodity, tl_type:tl_type, nor: nor,
													 vgm : vgm,
													 container_excess_left:container_excess_left,
													 container_excess_right:container_excess_right,
													 container_excess_front:container_excess_front,
													 container_excess_rear:container_excess_rear
													})
		.done(function( data ) {
			//alert( "Data Loaded: " + data );
			var obj = jQuery.parseJSON(data);

			if(obj.rc=="F")
			{
				$('#submit_container').removeAttr('disabled');
				var notification = new NotificationFx({
					message : '<p>Tambah Container Gagal </p><br/>'+obj.rcmsg,
					layout : 'growl',
					effect : 'jelly',
					type : 'error' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			else if(obj.data=="OK")
			{
				$('#submit_container').removeAttr('disabled');
				var notification = new NotificationFx({
					message : '<p>Tambah Container Sukses</p>',
					layout : 'growl',
					effect : 'jelly',
					type : 'success' // notice, warning, error or success

				});

				// show the notification
				notification.show();

				var url = "<?=ROOT?>container_receiving/getListContainer";
				var request_no = $("#request_no").val();
				$("#rowdetail").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,port:port},function(data){ });

				$("#container_autocomplete").val("");
				$("#container_weight").val("");
				$("#container_vgm").val("");
				$("#container_imo").val("");
				$("#container_un").val("");
				$("#container_temperature").val("");
				$("#container_excess_width").val("");
				$("#container_excess_height").val("");
				$("#container_excess_length").val("");
				//alert("ivan ganteng");
			}
			else{
				var res = obj.data.split(".");
				var remark = res[1];

				var notification = new NotificationFx({
					message : '<p>Tambah Container Gagal </p><br/>'+remark,
					layout : 'growl',
					effect : 'jelly',
					type : 'error' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			$(':button').removeAttr('disabled');
			$.unblockUI();
	}).fail(function() {
		alert("error, simpan container gagal");
		$(':button').removeAttr('disabled');
		$.unblockUI();
	});

	return false;
}

function apply_comm_to_all_cont() {

	var request_no = $("#request_no").val();
	var all_commodity = $("#all_kd_commodity").val();
	var port = $("#port").val();
	
	if(request_no=="")
	{
		alert("Simpan data permintaan dan dapatkan no request");
		$( "#request_no" ).focus();
		return false;
	}
	if(all_commodity=="")
	{
		alert("Commodity tidak valid");
		$( "#all_commodity" ).focus();
		return false;
	}
	
	$(':button').attr('disabled','disabled');
	$.blockUI();
	$.post( "<?=ROOT?>container_receiving/update_commodity", {
													 '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
													 request_no:request_no, all_commodity:all_commodity, port:port
													})
		.done(function( data ) {
			//console.log( "Data Loaded: " + data );
			var obj = jQuery.parseJSON(data);

			if(obj.rc=="F")
			{
				$('#apply_comm_to_all_cont').removeAttr('disabled');
				var notification = new NotificationFx({
					message : '<p>Update Commodity Gagal </p><br/>'+obj.rcmsg,
					layout : 'growl',
					effect : 'jelly',
					type : 'error' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			else if(obj.data=="OK")
			{
				$('#apply_comm_to_all_cont').removeAttr('disabled');
				var notification = new NotificationFx({
					message : '<p>Update Commodity Sukses</p>',
					layout : 'growl',
					effect : 'jelly',
					type : 'success' // notice, warning, error or success

				});

				// show the notification
				notification.show();

				var url = "<?=ROOT?>container_receiving/getListContainer";
				var request_no = $("#request_no").val();
				$("#rowdetail").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,port:port},function(data){ });

				$("#container_autocomplete").val("");
				$("#container_weight").val("");
				$("#container_vgm").val("");
				$("#container_imo").val("");
				$("#container_un").val("");
				$("#container_temperature").val("");
				$("#container_excess_width").val("");
				$("#container_excess_height").val("");
				$("#container_excess_length").val("");
				//alert("ivan ganteng");
			}
			else{
				var res = obj.data.split(".");
				var remark = res[1];

				var notification = new NotificationFx({
					message : '<p>Update Commodity Gagal </p><br/>'+remark,
					layout : 'growl',
					effect : 'jelly',
					type : 'error' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			$(':button').removeAttr('disabled');
			$.unblockUI();
	}).fail(function() {
		alert("error, Update Commodity gagal");
		$(':button').removeAttr('disabled');
		$.unblockUI();
	});

	return false;
}

</script>

<style>
    div.DTTT.btn-group{
        display:none !important;
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
</style>

				<div class="row">
					<div class="col-lg-6">
						<div class="main-box">
							<header class="main-box-header clearfix">
								<h2>Booking Data</h2>
							</header>

							<div class="main-box-body clearfix">
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Request Number</label>
									<input type="text" class="form-control" id="request_no" name="request_no" value="<?=$request_data["ID_REQ"];?>" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Request Number Biller</label>
									<input type="text" class="form-control" id="request_no_biller" name="request_no_biller" value="<?=$request_data["ID_REQ_BILLER"];?>" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
								</div>
								<div class="form-group">
									<label>Terminal</label>
									<select id="port" name="port" class="form-control" readonly>
									<option value="<?=$request_data["ID_PORT"]?>-<?=$request_data["ID_TERMINAL"]?>" selected><?=$request_data["TERMINAL_NAME"]?></option>
									</select>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Vessel</label>
									<input type="text" class="form-control" id="vessel_autocomplete" name="vessel_autocomplete" placeholder="autocomplete" title="Masukkan data kapal" readOnly>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Voyage In</label>
									<input type="text" class="form-control" id="voyage_in" name="voyage_in" readonly>
									Voyage Out
									<input type="text" class="form-control" id="voyage_out" name="voyage_out"  readonly>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">ID VVD </label>
									<input type="text" class="form-control" id="ukk" name="ukk"  readonly>
									<input type="hidden" id="vessel_code" name="vessel_code">
									<input type="hidden" id="call_sign" name="call_sign">
									<input type="hidden" id="voyage" name="voyage">
								</div>
								<div class="form-group">
										<label>Type of Trade</label>
										<select id="trading_type" name="trading_type" class="form-control" disabled>
											<option></option>
											<option value="O">International</option>
											<option value="I">Domestic</option>
										</select>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Port of Discharge (POD)</label>
									<input type="text" class="form-control" id="pod_autocomplete" name="pod_autocomplete" readonly>
									<input type="hidden" id="idpod" name="idpod"/>
								</div>
								<div class="form-group example-twitter-oss">
									<label for="exampleAutocomplete">Final Port of Discharge (FPOD)</label>
									<input type="text" class="form-control" id="fpod_autocomplete" name="fpod_autocomplete" readonly>
									<input type="hidden" id="idfpod" name="idfpod"/>
								</div>
								<div class="form-group">
										<label>Receiving Type</label>
										<select id="receiving_type" name="receiving_type" class="form-control" disabled>
											<option></option>
											<option value="LAP">Yard</option>
											<option value="TL">Truck Loosing</option>
										</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 hidden_content" id='international_content'>
						<div class="main-box">
							<header class="main-box-header clearfix">
								<h2>*International Only</h2>
							</header>

							<div class="main-box-body clearfix">
									<div class="form-group">
										<label for="exampleTooltip">No. PEB</label>
										<input type="text" class="form-control" id="peb_no" name="peb_no" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB" maxlength="40" readonly>
									</div>
									<div class="form-group">
										<form  action="POST" class="myForm1" enctype="multipart/form-data">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<label for="exampleTooltip">Upload PEB</label>
										<input type="text" id="peb_file" name="peb_file" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB" size="40" readonly>
										</form>
									</div>
									<div class="form-group">

										<label for="exampleTooltip">No. NPE</label>
										<input type="text" class="form-control" id="npe_no" name="npe_no" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10" maxlength="40" readonly>
									</div>
									<div class="form-group">
										<form  action="POST" class="myForm2" enctype="multipart/form-data">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<label for="exampleTooltip">Upload NPE</label>
										<input type="text" id="npe_file" name="npe_file" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="40" readonly>
										</form>
									</div>
									<div class="form-group">
										<label for="exampleTooltip">Booking Ship</label>
										<input type="text" class="form-control" id="booking_ship_no" name="booking_ship_no" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10" maxlength="40" readonly>
									</div>
									<div class="form-group">
										<form  action="POST" class="myForm3" enctype="multipart/form-data">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<label for="exampleTooltip">Upload Booking Ship</label>
										<input type="text" id="bookship_file" name="bookship_file" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="40" readonly>
										</form>
									</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 hidden_content" id='nolnol9_content'>
						<div class="main-box">
							<header class="main-box-header clearfix">
								<h2>*Khusus Terminal 1 (009)</h2>
							</header>

							<div class="main-box-body clearfix">
									<div class="form-group">
										<label for="exampleTooltip">No. SPP</label>
										<input type="text" class="form-control" id="nospp" name="nospp" data-toggle="tooltip" data-placement="bottom" title="Nomor SPP" size="10" maxlength="40" readonly>
									</div>
									<div class="form-group">
										<label for="exampleTooltip">No. Surat Jalan</label>
										<input type="text" class="form-control" id="nosuratjalan" name="nosuratjalan" data-toggle="tooltip" data-placement="bottom" title="Nomor Surat Jalan" size="10" maxlength="40" readonly>
									</div>
									<div class="form-group">
										<label for="exampleTooltip">Booking Ship</label>
										<input type="text" class="form-control" id="bookingship009" name="bookingship009" data-toggle="tooltip" data-placement="bottom" title="Booking Ship" size="10" maxlength="40" readonly>
									</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 hidden_content" id='pjg_domestik_content'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>*Intersuler</h2>
								</header>

								<div class="main-box-body clearfix">
										<div class="form-group">
											<label for="exampleTooltip">NO SPP</label>
											<input type="text" class="form-control" id="nosppdom" name="nosppdom" data-toggle="tooltip" data-placement="bottom" title="Nomor SPP" size="10" maxlength="40" >
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Booking Ship</label>
											<input type="text" class="form-control" id="bookingshipdom" name="bookingshipdom" data-toggle="tooltip" data-placement="bottom" title="Booking Ship" size="10" maxlength="40" >
										</div>
										<div class="form-group">
											<form  action="POST" class="myForm3" enctype="multipart/form-data">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<label for="exampleTooltip">Upload Booking Ship</label>
											<input type="text" id="booking_ship_upload_dom" name="booking_ship_upload_dom" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="40" readonly>
											</form>
										</div>
								</div>
							</div>
						</div>
				</div>
				<div class="row" id="container_data" name="container_data">
					<div class="col-lg-12">
						<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Container Data</h2>
								</header>

								<div class="main-box-body clearfix">

									<div id="error_message" class="alert alert-danger hidden_content" role="alert">
									  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									  <span class="sr-only">Error:</span>
									  <span id="error_text"></span>
									  <input type="hidden" id="invalid_container" name="invalid_container" value="false">
									</div>
									<div style="width:30%; float:left;">
										<div class="form-group has-feedback">
											<label for="container_autocomplete">Container Number</label>
											<div class="input-group">
												<input type="text" maxlength="11" class="form-control" id="container_autocomplete" name="container_autocomplete" placeholder="" data-toggle="tooltip" data-placement="bottom" title="Nomor Kontainer">
												<span id="cont_status_icon" class="glyphicon form-control-feedback" aria-hidden="true"></span>
											</div>
										</div>
										<div class="form-group">
											<label for="container_size">Size</label>
											<div class="input-group">
											<select id="container_size" name="container_size" class="form-control">
												<option value="20">20</option>
												<? if($request_data["ID_TERMINAL"]!='T3I' && $request_data["ID_TERMINAL"]!='PNJI' && $request_data["ID_TERMINAL"]!='PNJD' ){?><option value="21">21</option><?}?>
												<option value="40">40</option>
												<option value="45">45</option>
											</select>
											</div>
										</div>
										<div class="form-group">
											<div id='component_type'>
												<label for="container_type">Type</label>
												<div class="input-group">
												<select id="container_type" name="container_type" class="form-control">
													<option value="DRY">Dry</option>
													<option value="HQ">High Cube</option>
													<option value="RFR">Reefer</option>
													<option value="OT">Open Top</option>
													<option value="TNK">Tank</option>
													<option value="FLT">Flat Rack</option>
												</select>
												</div>
											</div>
											<div id='component_reefer' class='hidden_content'>
												<label for="container_type">Reefer NOR</label>
												<div class="input-group">
												<select id="reefer_nor" name="reefer_nor" class="form-control">
													<option value="Y">Yes</option>
													<option value="N" selected="selected">No</option>
												</select>
												</div>
											</div>
											<div style="clear:both"></div>
										</div>
										<div class="form-group">
											<label for="container_status">Status</label>
											<div class="input-group">
											<select id="container_status" name="container_status" class="form-control">
												<option value="F">Full</option>
												<option value="E">Empty</option>
											</select>
											</div>
										</div>
										<div class="form-group">
											<label for="container_height">Height</label>
											<div class="input-group">
											<select id="container_height" name="container_height" class="form-control">
												<option value="8.6">8,6</option>
												<option value="9.6">9,6</option>
												<option value="OOG">Not Standart (OOG)</option>
											</select>
											</div>
										</div>

										<!-- ISO CODE -->
										<div class="form-group alert alert-success" style="width:175px">
										  <span id="isocode_text">ISO Code: <b id="isocodevalue"></b></span>
										</div>
									</div>
									<div style="width:30%;float:left">
										<div class="form-group">
											<label for="container_weight">Weight NPE (Kg)</label>
											<div class="input-group">
											<input type="text" class="form-control" id="container_weight" name="container_weight" data-toggle="tooltip" data-placement="bottom" title="Berat">
											</div>
										</div>
										<div class="form-group" id="field_vgm_weight">
													<label for="container_vgm">Weight VGM (Kg)</label>
													<div class="input-group">
																	<div style="color:#e84e40" title="Centang, Jika Anda Bersedia Menunjuk Terminal Sebagai Penyedia VGM Container Anda"><input type="checkbox" id="is_vgmterminal"/> * VGM Terminal</div>
																	<input type="text" class="form-control" id="container_vgm" name="container_vgm" data-toggle="tooltip" data-placement="bottom" title="VGM">
													</div>
										</div>
										<div class="form-group">
											<label for="container_operator">Operator (Carrier)</label>
											<div class="input-group">
											<!-- input id="container_operator" name="container_operator" class="form-control" placeholder="autocomplete"/ -->
											<select id="container_operator" name="container_operator" class="form-control">
												<option value="">-- Select Carrier --</option>
												<?php
													foreach($carrier_list as $item){
														echo "<option value='" .$item->code. "'>" .$item->code. ' | ' .$item->line_operator. "</option>";
													}
												?>
											</select>
											</div>
										</div>

										<div class="form-group">
											<label for="container_dangerous">Hazard</label>
											<div class="input-group">
											<select id="container_dangerous" name="container_dangerous" class="form-control">
												<option value="N">No</option>
												<option value="Y">Yes</option>
											</select>
											</div>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">IMO Class*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_imo" name="container_imo" data-toggle="tooltip" data-placement="bottom" title="IMO Class, isi jika kontainer berbahaya" disabled="disabled">
											</div>

											<label for="exampleTooltip">UN Number*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_un" name="container_un" data-toggle="tooltip" data-placement="bottom" title="UN Number, isi jika kontainer berbahaya" disabled="disabled">
											</div>
										</div>
										<div class="form-group">
											<!-- sss -->
										</div>
									</div>

									<div style="width:30%; float:right">

										<div class="form-group">
											<label for="exampleTooltip">Commodity*</label>
											<div class="input-group">
											   <input type="text" value="GENERAL CARGO            " class="form-control" id="commodity" name="commodity" data-toggle="tooltip" data-placement="bottom" title="Komoditas Kontainer">
											   <input type="hidden" value="C000000492" id="kd_commodity"/>
											</div>
										</div>

										<div class="form-group">
											<label for="exampleTooltip">Temperature*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_temperature" name="container_temperature" data-toggle="tooltip" data-placement="bottom" title="Temperatur, isi jika kontainer adalah Reefer" disabled="disabled">
											</div>
										</div>
										<?php if($request_data["ID_TERMINAL"]=="JICT2" || $request_data["ID_TERMINAL"]=="T3D" || $request_data["ID_TERMINAL"]=="T3I"):?>
												<div class="form-group">
													<label for="exampleTooltip">Over Left*</label>
													<div class="input-group">
													   <input type="text" class="form-control" id="container_excess_left" name="container_excess_left" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
													</div>
												</div>
												<div class="form-group">
													<label for="exampleTooltip">Over Right*</label>
													<div class="input-group">
													   <input type="text" class="form-control" id="container_excess_right" name="container_excess_right" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
													</div>
												</div>	
											<?php else: ?>
										<div class="form-group">
											<label for="exampleTooltip">Over Width*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_excess_width" name="container_excess_width" data-toggle="tooltip" data-placement="bottom" title="Kelebihan Lebar, isi jika kontainer tidak standar (OOG)" disabled="disabled">
											</div>
										</div>
									<?php endif; ?>

									<?php if($request_data["ID_TERMINAL"]=="JICT2" || $request_data["ID_TERMINAL"]=="T3D" || $request_data["ID_TERMINAL"]=="T3I"):?>
										<div class="form-group">
											<label for="exampleTooltip">Over Front*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_excess_front" name="container_excess_front" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
											</div>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Over Rear*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_excess_rear" name="container_excess_rear" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
											</div>
										</div>
									<?php else:?>
										<div class="form-group">
											<label for="exampleTooltip">Over Length*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_excess_length" name="container_excess_length" data-toggle="tooltip" data-placement="bottom" title="Kelebihan Panjang, isi jika kontainer tidak standar (OOG)" disabled="disabled">
											</div>
										</div>	
									<?php endif; ?>
										<div class="form-group">
											<label for="exampleTooltip">Over Height*</label>
											<div class="input-group">
											   <input type="text" class="form-control" id="container_excess_height" name="container_excess_height" data-toggle="tooltip" data-placement="bottom" title="Kelebihan Tinggi, isi jika kontainer tidak standar (OOG)" disabled="disabled">
											</div>
										</div>
										
										<div class="form-group" id='div_container_transit'>
											<label for="container_transit">Transit</label>
											<div class="input-group">
											<select id="container_transit" name="container_transit" class="form-control">
												<option value="T">T</option>
												<option value="Y">Y</option>
											</select>
											</div>
										</div>
										<input type="button" onclick="submit_container()" value="Add Container" id="submit_container" name="submit_container" class="btn btn-success"/>
									</div>
								
							</div>
							<div class="main-box-body clearfix">
								<div style="width:100%;"  id="apply_all_commodity" class="form-inline">
									<label for="exampleTooltip">* Apply Commodity To All Container</label>
									<input type="text" class="form-control" id="all_commodity" name="all_commodity" data-toggle="tooltip" data-placement="bottom" title="Komoditas Kontainer">
									<input type="hidden" id="all_kd_commodity"/>
									<input type="button" onclick="apply_comm_to_all_cont()" value="Apply" id="apply_comm_to_all_cont" name="apply_comm_to_all_cont" class="btn btn-default"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="container_excel" name="container_excel">
				<div class="col-lg-12">
					<div class="main-box clearfix">
						<header class="main-box-header clearfix">
							<h2 class="pull-left">Upload FIle Excel</h2>
						</header>

						<div class="main-box-body clearfix">
							<form name="upload_form" method="post" enctype="multipart/form-data" action="<?=ROOT?>container_receiving/upload_excel/" onsubmit="return validate_upload_form()">
								<div class="form-group">
									<label for="exampleTooltip">Upload</label>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<input type="hidden" id="req_excel" name="req_excel">
									<input type="hidden" id="port_excel" name="port_excel">
									<input type="hidden" id="trading_type_excel" name="trading_type_excel">
									<input type="file" accept=".xls" id="userfile" name="userfile" data-toggle="tooltip" data-placement="bottom" title="Upload file Excel">
								</div>
								<button type="submit" id="submit_file" name="submit_file" class="btn btn-success">Upload</button>
							</form>
							<a href="<?=APP_ROOT?>templateupload/Template_Upload_Container_Receiving.xls">Download Template</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="rowdetail"></div>
