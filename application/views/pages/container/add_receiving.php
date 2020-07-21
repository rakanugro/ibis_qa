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
</style>

<script>
$(document).ready(function() {
	$("#shipper").hide();
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
  var currentDate = new Date();
  var day = currentDate.getDate();
  var month = currentDate.getMonth() + 1;
  var year = currentDate.getFullYear();
  var hour = currentDate.getHours();
  var minute = currentDate.getMinutes() + 1;
  /* $("#start_shift").on('click', function(){
      $("#start_shift").val(day+'-'+month+'-'+year+' '+hour+':'+minute);
  }); */
  
		$('#start_shift').datetimepicker({
		format: 'd-m-Y H:i'
	});
	
			$('#end_shift').datetimepicker({
		format: 'd-m-Y H:i'
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

	$(document).ready(function(){
		$("#container_type option[value='OVD']").hide();
		$('.over_left').hide();
		$('.over_right').hide();
		$('.over_front').hide();
		$('.over_rear').hide();
		$('#port').on('change', function(){
			var termn=$('#port').val();
			var kode_perdagangan = $(this).val().slice(-1);

			if (kode_perdagangan == 'I'){
				$('#international_content').removeClass('hidden_content');
				$("#trading_type").val("I");
				$("#trading_type2").val("International");
			} else {
				$('#international_content').addClass('hidden_content');
				$("#trading_type").val("D");
				$("#trading_type2").val("Domestik");
				$('#field_vgm_weight').attr('style','display:none');
			}

			$("#receiving_type option[value='TL']").removeAttr("disabled");
			$("#frm_receiving_via").addClass('hidden_content');
			$("#frm_npe").addClass('hidden_content');
			$("#receiving_type option[value='TL']").show();
			$('#pjg_domestik_content').removeClass('hidden_content');
			$('#tlbd_tlbi_content').addClass('hidden_content');

			var terminal = ( $(this).val().split('-') )[1];
			// receiving_via

			if (terminal == 'T009D'){
				$('.over_left').hide();
				$('.over_right').hide();
				$('.over_front').hide();
				$('.over_rear').hide();
				$('.over_width').show();
				$('.over_length').show();

				if ($("#receiving_type").val() == "TL"){
					$("#receiving_type").val("");
				}
				$("#receiving_type option[value='TL']").prop('disabled',true);
				$('#nolnol9_content').removeClass('hidden_content');
				$('#pjg_domestik_content').addClass('hidden_content');
			} else if (terminal == 'PNJD'){
				$('.over_left').hide();
				$('.over_right').hide();
				$('.over_front').hide();
				$('.over_rear').hide();
				$('.over_width').show();
				$('.over_length').show();

				$('#pjg_domestik_content').removeClass('hidden_content');
				$('#nolnol9_content').addClass('hidden_content');
				
				
			} else if (terminal == 'DJBD' || terminal == 'DJBI' || terminal == 'TLBD' || terminal == 'TLBI'){
				$('.over_left').hide();
				$('.over_right').hide();
				$('.over_front').hide();
				$('.over_rear').hide();
				$('.over_width').show();
				$('.over_length').show();

				if(terminal=='TLBD' || terminal=='TLBI'){
					$("#container_type option[value='OVD']").show();
				}else{
					$("#container_type option[value='OVD']").hide();
				}
				$('#receiving_type').val('LAP');
				$("#receiving_type option[value='TL']").attr("disabled", "disabled");
				$("#receiving_type option[value='TL']").hide();
				$("#start_shift").removeAttr("disabled");
				$("#frm_receiving_via").removeClass('hidden_content');
				$("#frm_npe").removeClass('hidden_content');
				// console.log("ganti");
				if(terminal == 'DJBD' || terminal == 'TLBD'){
					// alert('a');
					$('#pjg_domestik_content').addClass('hidden_content');
					$('#nolnol9_content').addClass('hidden_content');	
					$('#tlbd_tlbi_content').removeClass('hidden_content');
				} else{
					$('#pjg_domestik_content').addClass('hidden_content');
					$('#nolnol9_content').addClass('hidden_content');	
					$('#tlbd_tlbi_content').addClass('hidden_content');
				}

			} else if (terminal == 'PLMD' || terminal == 'PLMI' || terminal == 'PNKD' || terminal == 'PNKI'){
				$('.over_left').hide();
				$('.over_right').hide();
				$('.over_front').hide();
				$('.over_rear').hide();
				$('.over_width').show();
				$('.over_length').show();

				$('#receiving_type').val('LAP');
				$("#receiving_type option[value='TL']").attr("disabled", "disabled");
				$("#receiving_type option[value='TL']").hide();
				$("#start_shift").removeAttr("disabled");
				$("#frm_receiving_via").removeClass('hidden_content');
				$("#frm_npe").removeClass('hidden_content');
				// console.log("ganti");
				if(terminal == 'PLMD' || terminal == 'PNKD'){
					// alert('a');
					$('#pjg_domestik_content').addClass('hidden_content');
					$('#nolnol9_content').addClass('hidden_content');	
					$('#tlbd_tlbi_content').removeClass('hidden_content');
				} else{
					$('#pjg_domestik_content').addClass('hidden_content');
					$('#nolnol9_content').addClass('hidden_content');	
					$('#tlbd_tlbi_content').addClass('hidden_content');
				}
			} else if(terminal=="T3D" || terminal=="T3I" || terminal=="JICT2"){
				$('.over_left').show();
				$('.over_right').show();
				$('.over_front').show();
				$('.over_rear').show();
				$('.over_width').hide();
				$('.over_length').hide();

			} else {
				$('.over_left').hide();
				$('.over_right').hide();
				$('.over_front').hide();
				$('.over_rear').hide();
				$('.over_width').show();
				$('.over_length').show();

				$("#container_type option[value='OVD']").hide();
				$('#pjg_domestik_content').addClass('hidden_content');
				$('#nolnol9_content').addClass('hidden_content');
				$("#receiving_type option[value='TL']").prop('disabled',false);
				// $("")
				// if(termn=="IDDJB-DJBD" || termn=="IDDJB-DJBI" || termn=="IDTLB-TLBI" || termn=="IDTLB-TLBD"){
				// 	$('#receiving_type').attr('disabled',false);
				// 	$('#receiving_type').find('[value="TONGKANG"]').remove();
				// 	$('#receiving_type').find('[value="LAP"]').remove();
				// 	$('#receiving_type').append('<option value="TONGKANG">Tongkang</option>');
				// }else{
				// 	$('#receiving_type').find('[value="TONGKANG"]').remove();
				// 	$('#receiving_type').attr('disabled',false);
				// 	$("#receiving_type option[value='TL']").prop('disabled',false);
				// 	$('#pjg_domestik_content').addClass('hidden_content');
				// 	$('#nolnol9_content').addClass('hidden_content');
				// 	$("#receiving_type option[value='TL']").prop('disabled',false);
				// }
				
			}

			if (terminal == 'T3I' || terminal == 'PNJI' || terminal == 'PNJD'){
				$('#receiving_type').val('LAP');
				$("#receiving_type option[value='TL']").attr("disabled", "disabled");
				$("#start_shift").removeAttr("disabled");
			}else{

			}

			if (terminal == 'PNJI' || terminal == 'PNJD') {
				$('#div_container_transit').removeClass('hidden_content');
				$('#apply_all_commodity').removeClass('hidden_content');
				document.getElementById('start_shift').removeAttribute('readonly');
				document.getElementById('end_shift').removeAttribute('readonly');
				//
			} else {
				//alert('haha');
				$('#div_container_transit').addClass('hidden_content');
				$('#apply_all_commodity').addClass('hidden_content');
				$('#start_shift').attr('readonly', true);
				$('#end_shift').attr('readonly', true);
				//$("#start_shift").attr('disabled','disabled');
			}
			
			$("#vessel_autocomplete").val("");
			$("#voyage_in").val("");
			$("#voyage_out").val("");
			$("#ukk").val("");
			$("#vessel_code").val("");
			$("#voyage").val("");
			$("#call_sign").val("");
			$("#eta").val("");
			$("#etd").val("");
			$("#end_shift").val("");
		});

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
					$('#error_text').html('Invalid Container').parent().show();
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
				$("#commodity").val("GENERAL CARGO            ");
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
        //alert('test');
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

		//validasi saat peb_upload upload
		$('#peb_upload').change(function() {

			var sSppb = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('peb_upload').files[0].type;

			var namafile4,panjangfile4;
			namafile4=document.getElementById('peb_upload').value;
			panjangfile4=namafile4.length;

			if(panjangfile4>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('peb_upload').value="";

			}

			if(files != sSppb) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('peb_upload').value="";
				return false;
			}
		});
	//npe_upload
		$('#npe_upload').change(function() {

			var sSppb = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('npe_upload').files[0].type;

			var namafile5,panjangfile5;
			namafile5=document.getElementById('npe_upload').value;
			panjangfile5=namafile5.length;

			if(panjangfile5>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('npe_upload').value="";

			}

			if(files != sSppb) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('npe_upload').value="";
				return false;
			}
		});






	//booking_ship_upload

	$('#booking_ship_upload').change(function() {

			var sSppb = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('booking_ship_upload').files[0].type;

			var namafile6,panjangfile6;
			namafile6=document.getElementById('booking_ship_upload').value;
			panjangfile6=namafile6.length;

			if(panjangfile6>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('booking_ship_upload').value="";

			}

			if(files != sSppb) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('booking_ship_upload').value="";
				return false;
			}
		});

		$('#booking_ship_upload_dom').change(function() {

			var sSppb = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('booking_ship_upload_dom').files[0].type;

			var namafile6,panjangfile6;
			namafile6=document.getElementById('booking_ship_upload_dom').value;
			panjangfile6=namafile6.length;

			if(panjangfile6>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('booking_ship_upload_dom').value="";

			}

			if(files != sSppb) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('booking_ship_upload_dom').value="";
				return false;
			}
		});

		$('#booking_ship_upload_dom1').change(function() {

			var sSppb = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
			var files = document.getElementById('booking_ship_upload_dom1').files[0].type;

			var namafile6,panjangfile6;
			namafile6=document.getElementById('booking_ship_upload_dom1').value;
			panjangfile6=namafile6.length;

			if(panjangfile6>255){
				alert('panjang file tidak boleh lebih dari 255');
				document.getElementById('booking_ship_upload_dom1').value="";

			}

			if(files != sSppb) {
				alert('Mime type file: '+files+ '.\nFile tidak valid.');
				document.getElementById('booking_ship_upload_dom1').value="";
				return false;
			}
		});


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


    function submitheader() {

        var port = $("#port").val();
        var vessel_autocomplete = $("#vessel_autocomplete").val();
        var ukk = $("#ukk").val();

        var pod_name = $( "#comboPOD option:selected" ).text();
        var fpod_name = $( "#comboFPOD option:selected" ).text();

        var pod = $( "#comboPOD option:selected" ).val();
        var fpod = $( "#comboFPOD option:selected" ).val();
        //alert(pod_name+pod+fpod_name+fpod);
        var trading_type = $("#trading_type").val();
        var receiving_type = $("#receiving_type").val();
		    var voyin=$("#voyage_in").val();
		    var voyout=$("#voyage_out").val();
        //optional
        var peb = $("#peb_no").val();
        var npe = $("#npe_no").val();
        var booking_ship = $("#booking_ship_no").val();
        var request_no = $("#request_no").val();
		var nospp = $("#nospp").val();
		var nosppdom = $("#nosppdom").val();
        var nosuratjalan = $("#nosuratjalan").val();
		var bookingship009 = $("#bookingship009").val();
		var bookingshipdom = $("#bookingshipdom").val();
		var end_shift=$("#end_shift").val();
		var start_shift=$("#start_shift").val();
		var peb_dt=$("#peb_dt").val();
		var valid_eta=$("#valid_eta").val();
		var receiving_via = $("#receiving_via").val();
		var tgl_npe = $("#tgl_npe").val();
		var ship_line = $( "#ship_line_data " ).val();

        if(port=="")
        {
            alert("Terminal harus diisi");
            $( "#port" ).focus();
            return false;
        }

        if(vessel_autocomplete=="")
        {
            alert("Kapal harus diisi");
            $( "#vessel_autocomplete" ).focus();
            return false;
        }
		/*
        if(valid_eta=="N")
        {
            alert("ETA Vessel yang anda pilih kurang Dari 9 Jam");
            $( "#vessel_autocomplete" ).focus();
            return false;
        }
		*/
        if(ukk=="")
        {
            alert("ID VVD tidak boleh kosong");
            $( "#ukk" ).focus();
            return false;
        }

        if(trading_type=="")
        {
            alert("Jenis Perdagangan harus diisi");
            $( "#trading_type" ).focus();
            return false;
        }

        if(pod=="")
        {
            alert("POD tidak boleh kosong");
            $( "#comboPOD" ).focus();
            return false;
        }

        if(fpod=="")
        {
            alert("FPOD tidak boleh kosong");
            $( "#comboFPOD" ).focus();
            return false;
        }

        if(receiving_type=="")
        {
            alert("Jenis penerimaan harus diisi");
            $( "#receiving_type" ).focus();
            return false;
		}

		//sementara dikomen validasi utk jambi tunggu keputusan
		if ((port == "IDJKT-T3I" && peb == "") || (port == "IDPNJ-PNJI" && peb == "") || (port == "IDPLM-PLMI" && peb == "") || (port == "IDPNK-PNKI" && peb == "") /*|| (port == "IDDJB-DJBI" && peb == "") || (port == "IDTLB-TLBI" && peb == "")*/)
		{
			alert("Nomor PEB harus diisi");
            $( "#peb_no" ).focus();
            return false;
		}

		//sementara dikomen validasi utk jambi tunggu keputusan
		if ((port == "IDJKT-T3I" && peb_dt=="") || (port == "IDPNJ-PNJI" && peb_dt == "") || (port == "IDPLM-PLMI" && peb_dt == "") || (port == "IDPNK-PNKI" && peb_dt == "") /*|| (port == "IDDJB-DJBI" && peb_dt == "") || (port == "IDTLB-TLBI" && peb_dt == "")*/)
        {
            alert("PEB Date harus diisi");
            $( "#peb_dt" ).focus();
            return false;
        }

        //sementara dikomen validasi utk jambi tunggu keputusan
		if ((port == "IDJKT-T3I" && npe == "") || (port == "IDPNJ-PNJI" && npe == "") || (port == "IDPLM-PLMI" && npe == "") || (port == "IDPNK-PNKI" && npe == "")/*|| (port == "IDDJB-DJBI" && npe == "") || (port == "IDTLB-TLBI" && npe == "")*/)
		{
			alert("Nomor NPE harus diisi");
            $( "#npe_no" ).focus();
            return false;
		}

		if ((port == "IDJKT-T3I" || port == "IDPNJ-PNJI" || port == "IDDJB-DJBI" || port=="IDTLB-TLBI") && booking_ship == "" || (port == "IDPLM-PLMI" && booking_ship == "") || (port == "IDPNK-PNKI" && booking_ship == ""))

		{
			alert("Nomor Booking Ship harus diisi");
            $( "#booking_ship_no" ).focus();
            return false;
		}		
		if (port == "IDPNJ-PNJD" && bookingshipdom == "")
		{
			alert("Nomor Booking Ship harus diisi");
            $( "#bookingshipdom" ).focus();
            return false;
		}

		//sementara dikomen validasi utk jambi tunggu keputusan
		if ((port == "IDJKT-T3I" && $("#peb_upload").val() == "") || (port == "IDPNJ-PNJI" && $("#peb_upload").val() == "") || (port == "IDPLM-PLMI" && $("#peb_upload").val() == "") || (port == "IDPNK-PNKI" && $("#peb_upload").val() == "") /*|| (port == "IDDJB-DJBI" && $("#peb_upload").val() == "") || (port == "IDTLB-TLBI" && $("#peb_upload").val() == "")*/)
		{
			alert("Dokumen PEB Wajib Diupload");
            $( "#peb_upload" ).focus();
            return false;
		}

		if ((port == "IDJKT-T3I" && $("#npe_upload").val() == "") || (port == "IDPNJ-PNJI" && $("#npe_upload").val() == "") || (port == "IDPLM-PLMI" && $("#npe_upload").val() == "")  || (port == "IDPNK-PNKI" && $("#npe_upload").val() == "") )
		{
			alert("Dokumen NPE Wajib Diupload");
            $( "#npe_upload" ).focus();
            return false;
		}
		if ((port == "IDJKT-T3I" && $("#booking_ship_upload").val() == "") || (port == "IDPNJ-PNJI" && $("#booking_ship_upload").val() == "") || (port == "IDPLM-PLMI" && $("#booking_ship_upload").val() == "") || (port == "IDPNK-PNKI" && $("#booking_ship_upload").val() == ""))
		{
		  alert("Dokumen Booking Ship Wajib Diupload");
				$( "#booking_ship_upload" ).focus();
				return false;
		}
		
		if (port == "IDPNJ-PNJD" && $("#booking_ship_upload_dom").val() == "")
		{
		  alert("Dokumen Booking Ship Wajib Diupload");
				$( "#booking_ship_upload_dom" ).focus();
				return false;
		}
		if ((port == "IDTLB-TLBD" || port == "IDDJB-DJBD" || port=="IDPNK-PNKD" || port=="IDPLM-PLMD") && $("#booking_ship_upload_dom1").val() == "")
		{
		 		alert("Dokumen Booking Ship/ Dokumen RO Wajib Diupload");
				$( "#booking_ship_upload_dom1" ).focus();
				return false;
		}
		if (port == "IDJKT-T009D" && $("#nospp").val() == "" && $("#nosuratjalan").val() == "")
		{
			alert("Nomor SPP atau Nomor Surat Jalan Harus Diisi");
				return false;
		}
		
		if (port == "IDPNJ-PNJD" && $("#nosppdom").val() == "")
		{
			alert("Nomor SPP Harus Diisi");
				return false;
		}
		$(':button').attr('disabled','disabled');
        var submit_header = '1';
		var url = "<?=ROOT?>container_receiving/add_receiving";
        $.blockUI();
        $.post(url,{
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						submit_header:submit_header,
						peb_no: peb,
						npe_no: npe,
						booking_ship_no: booking_ship,
						port: port,
						ukk: ukk,
						pod: pod,
						fpod: fpod,
						pod_name: pod_name,
						fpod_name: fpod_name,
						trading_type: trading_type,
						request_no: request_no,
						receiving_type: receiving_type,
						vessel:vessel_autocomplete,
						voy_in:voyin,
						voy_out:voyout,
						nospp:nospp,
						nosppdom:nosppdom,
						nosuratjalan:nosuratjalan,
						bookingship009:bookingship009,
						bookingshipdom:bookingshipdom,
						start_shift:start_shift,
						end_shift:end_shift,
						peb_dt:peb_dt,
						receiving_via:receiving_via,
						tgl_npe:tgl_npe,
						ship_line:ship_line
					},
				function(data){
			var obj = jQuery.parseJSON(data);
      $.unblockUI();
			if(obj.data.data==null){
				alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
			} else {
				var x = document.getElementById("container_size");

				if(port=="IDJKT-T3I" || port=="IDPNJ-PNJI" || port=="IDPNJ-PNJD"){
					var opt = document.createElement('option');
					opt.value = '20';
					opt.innerHTML = '20';
					x.appendChild(opt);
					var opt = document.createElement('option');
					opt.value = '40';
					opt.innerHTML = '40';
					x.appendChild(opt);
					var opt = document.createElement('option');
					opt.value = '45';
					opt.innerHTML = '45';
					x.appendChild(opt);
				}
				else
				{
					var opt = document.createElement('option');
					opt.value = '20';
					opt.innerHTML = '20';
					x.appendChild(opt);
					var opt = document.createElement('option');
					opt.value = '21';
					opt.innerHTML = '21';
					x.appendChild(opt);
					var opt = document.createElement('option');
					opt.value = '40';
					opt.innerHTML = '40';
					x.appendChild(opt);
					var opt = document.createElement('option');
					opt.value = '45';
					opt.innerHTML = '45';
					x.appendChild(opt);
				}

				if (port != "IDJKT-T009D") {
					if (port == "IDPNJ-PNJD") {
						submitFileBookingShipDOM(obj.data.data.request_no);
					} else if (port == "IDTLB-TLBD" || port == "IDDJB-DJBD" || port == "IDPLM-PLMD"  || port == "IDPNK-PNKD") {
						submitFileBookingShipDOM(obj.data.data.request_no);
					} else if (port == "IDPNJ-PNJD") {
						submitFileBookingShipDOM(obj.data.data.request_no);
					} else {
						submitFilePEB(obj.data.data.request_no);
						submitFileNPE(obj.data.data.request_no);
						submitFileBookingShip(obj.data.data.request_no);
					}
				}

				document.getElementById('submit_header').style.display = "none";
				alert("Simpan request berhasil");
				$('#start_shift').attr('readonly', true);
				$('#end_shift').attr('readonly', true);
				$("#container_data").attr('class', 'row');
				$("#container_excel").attr('class', 'row');
				$("#req_excel").val(obj.data.data.request_no);
				$("#request_no").val(obj.data.data.request_no);
				$("#port_excel").val($("#port").val());
				$("#trading_type_excel").val($("#trading_type").val());

				// set carrier
				for(var idx=0;idx<obj.data.data.carrier_list.length;idx++){
					$("#container_operator")
						 .append($("<option></option>")
						 .attr("value",obj.data.data.carrier_list[idx].code)
						 .text(obj.data.data.carrier_list[idx].line_operator));
				}

				var notification = new NotificationFx({
					message : '<p>Anda mendapatkan no request </p>('+obj.data.data.request_no+')',
					layout : 'growl',
					effect : 'jelly',
					type : 'success' // notice, warning, error or success

				});

				// show the notification
				notification.show();
        getIsoCode($("#container_size").val(),$("#container_type").val(),$("#container_height").val(),$("#port").val());
			}
			$(':button').removeAttr('disabled');
        });
    }

	function submitFileNPE(reqNo)
	{
		var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/npe_upload";
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

	function submitFilePEB(reqNo)
	{
		var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/peb_upload";
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

	function submitFileBookingShip(reqNo)
	{
		var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/booking_ship_upload";
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
	
	function submitFileBookingShipDOM(reqNo)
	{
		var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/booking_ship_upload_dom";
        var formData = new FormData($('.myForm4')[0]);
		
		//alert(formUrl);

        $.ajax({
                url: formUrl,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data, textSatus, jqXHR){
					// alert('success');
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert(data);
                }
        });
	}
	function delete_cont(nocont,noreq,carrier_cont) {
		$.blockUI();
        var url = "<?=ROOT?>container_receiving/delete_container";
        var str = $("#port").val();
		var res = str.split("-");
		var port = res[0];
		var terminal = res[1];

		var vessel_code = $( "#vessel_code" ).val();
		var call_sign = $( "#call_sign" ).val();
		var voyage = $( "#voyage" ).val();
        $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_CONT:nocont,NO_REQ:noreq,PORT:port,TERMINAL:terminal,VESSEL_CODE:vessel_code,CALL_SIGN:call_sign,VOYAGE:voyage,CARRIERCONT:carrier_cont},function(data){
			//alert( "Data Loaded: " + data );
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

            var url = "<?=ROOT?>container_receiving/getListContainer";
			var request_no = $("#request_no").val();
			$("#detailreq").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,port:str},function(data){ });

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
            $( "#container_status']" ).focus();
            return false;
        }
        if(container_height=="")
        {
            alert("Tinggi Container harus diisi");
            $( "select[name='container_high']" ).focus();
            return false;
        }

        if(container_weight == ""){
            alert("Weight NPE Harus Diisi");
            $("#container_weight").focus();
            return false;
        }

        var explode = port.split('-');
        if(explode[0]!="IDDJB" || explode[0]!="IDTLB" || explode[0]!="IDPLM" || explode[0]!="IDPNK"){
	        if(kode_perdagangan == 'I'){
	      		if(!document.getElementById("is_vgmterminal").checked){
      				if(vgm == ""){
      					alert("Bila anda tidak menunjuk terminal sebagai penyedia vgm, kolom weight vgm wajib diisixx");
      					$("#container_vgm").focus();
      					return false;
      				}
	      		}
	      	}
	     }	

        if(container_operator=="")
        {
            alert("Operator/Carrier Container harus diisi");
            $( "select[name='container_operator']" ).focus();
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
      $.blockUI();
		$(':button').attr('disabled','disabled');
		var url="<?=ROOT?>container_receiving/add_receiving";
        $.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',submit_container:true, request_no:request_no, container_no:container_autocomplete,
                                                         container_size:container_size, container_type:container_type, container_status:container_status,
                                                         container_height:container_height, container_weight:container_weight, container_operator:container_operator,
                                                         container_dangerous:container_dangerous, container_transit:container_transit, number_booking_ship:number_booking_ship, 
														 container_imo:container_imo, container_un:container_un,
                                                         container_temperature:container_temperature, container_excess_width:container_excess_width,
                                                         container_excess_height:container_excess_height, container_excess_length:container_excess_length,
                                                         trading_type:trading_type, carrier:carrier,port:port,commodity:commodity, tl_type:tl_type, nor: nor, vgm:vgm,
                                                         container_excess_left:container_excess_left,
														 container_excess_right:container_excess_right,
														 container_excess_front:container_excess_front,
														 container_excess_rear:container_excess_rear
                                                        })
            .done(function( data ) {
              $.unblockUI();
                var obj = jQuery.parseJSON(data);
                //alert( "Data Loaded: " + obj.rc );

				if(obj.rc=="F")
				{
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
                   // $('#table-container tr:last').after('<tr><td>'+container_autocomplete+'</td><td>'+container_size+'</td><td>'+container_type+'</td><td>'+container_status+'</td><td>'+container_height+'</td><td>'+container_dangerous+'</td><td>'+container_operator+'</td></tr>');
                    // create the notification
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
                    $("#detailreq").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,port:port},function(data){ });
                    $("#container_autocomplete").val("");
                    $("#container_weight").val("");
                    $("#container_imo").val("");
                    $("#container_un").val("");
                    $("#container_temperature").val("");
                    $("#container_excess_width").val("");
                    $("#container_excess_height").val("");
                    $("#container_excess_length").val("");
                }
                else {
					$('#submit_container').removeAttr('disabled');
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
        }).fail(function() {
            alert("error, simpan container gagal");
			$(':button').removeAttr('disabled');
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
				$("#detailreq").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,port:port},function(data){ });

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

					<div class="row">
						<div class="col-lg-6 ">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Booking Data</h2>
								</header>

									<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Request Number</label>
											<input type="text" class="form-control" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
										</div>
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control">
												<option> -- Please Choose Terminal -- </option>
												<?php
												foreach($terminal as $term)
												{
												?>
													<option value="<?=$term["PORT"]?>-<?=$term["TERMINAL"]?>"><?=$term["TERMINAL_NAME"]?></option>
												<?php
												}
												?>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
                      <div class="form-wrapper cf">
										      <input type="text" id="vessel_autocomplete"
                          name="vessel_autocomplete" placeholder="Search here..." title="Masukkan data kapal" required>
                          <button type="submit" onclick="search_vessel()">Search</button>
                      </div>
                    	<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" readonly>
											</div>
											<input type="hidden" class="form-control" id="ukk" name="ukk" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											<input type="hidden" id="vessel_code" name="vessel_code">
											<input type="hidden" id="voyage" name="voyage">
											<input type="hidden" id="call_sign" name="call_sign">
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Estimate Time Arrival (ETA)</label>
												<input type="text" class="form-control" id="eta" name="eta" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Estimate Time Departure (ETD)</label>
												<input type="text" class="form-control" id="etd" name="etd" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											</div>
										</div>

										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label>Start Shift Reefer</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													<input class="form-control" id="start_shift" name='start_shift' type="text" readonly placeholder="Untuk Reefer Klik Disini">
												</div>
											</div>
											<div class="form-group col-xs-6">
												<label>End Shift Reefer</label>
												<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input class="form-control" id="end_shift" name='end_shift' type="text" readonly>
											</div>
											</div>
										</div>

                    <div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Open Stack</label>
												<input type="text" class="form-control" id="openstack" name="openstack"  readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Closing Time</label>
												<input type="text" class="form-control" id="closing" name="closing" readonly>
											</div>
										</div>
                    <div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Closing Time Document</label>
												<input type="text" class="form-control" id="closingdoc" name="closingdoc" readonly>
											</div>
                      <div class="form-group col-xs-6">
                        <label for="exampleAutocomplete">Booking Limit</label>
                        <input type="text" class="form-control" id="booking_limit" name="booking_limit" readonly>
                      </div>
										</div>

										<div class="form-group">
												<label>Type of Trade</label>
												<input class="form-control" id="trading_type2" name='trading_type2' type="text" readonly>
												<input class="form-control" id="trading_type" name='trading_type' type="hidden">
												<!--<select id="trading_type" name="trading_type" class="form-control" readonly>
													<option></option>
													<option value="O"><?=get_content($this->user_model,"receiving","international");?></option>
													<option value="I"><?=get_content($this->user_model,"receiving","domestic");?></option>
												</select>-->
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Port of Discharge</label>
						                      <div id="comboPOD"></div>
						                      <input type="hidden" id="idpod" name="idpod"/>
																</div>
																<div class="form-group example-twitter-oss">
																	<label for="exampleAutocomplete">Final Port of Discharge (FPOD)</label>
						                      <div id="comboFPOD"></div>
						                      <input type="hidden" id="idfpod" name="idfpod"/>
										</div>
										<div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete" id="shipper">Shipper</label>
                                       
										<div id="ship_line"></div>
                                    </div>
										<div class="form-group">
												<label>Receiving Type</label>
												<select id="receiving_type" name="receiving_type" class="form-control">
													<option></option>
													<option value="LAP">Yard</option>
													<option value="TL">Truck Loosing</option>
												</select>
										</div>
										<div class="form-group hidden_content" id="frm_receiving_via">
												<label>Receiving VIA</label>
												<select id="receiving_via" name="receiving_via" class="form-control">
													<option value="TRUCK">Truck</option>
													<!-- <option value="TONGKANG">Tongkang</option> -->
												</select>
										</div>
										<button id="submit_header" onclick="submitheader();" class="btn btn-success"/>Save</button>
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
											<label for="exampleTooltip">Nomor PEB</label>
											<input type="text" class="form-control" id="peb_no" name="peb_no" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB" maxlength="40" >
										</div>
										<div class="form-group">
											<label for="exampleTooltip">PEB Date</label>
											<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="peb_dt" name="peb_dt" data-toggle="tooltip" data-placement="bottom" title="Date PEB" style="width:30%">
											</div>
										</div>
										<div class="form-group">
											<form  action="POST" class="myForm1" enctype="multipart/form-data">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<label for="exampleTooltip">Upload PEB</label>
											<input type="file" accept=".pdf" id="peb_upload" name="peb_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB">
                                            <span class='upload_info'>
                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                            </span>
											</form>
										</div>
										<div class="form-group">

											<label for="exampleTooltip">Nomor NPE</label>
											<input type="text" class="form-control" id="npe_no" name="npe_no" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10" maxlength="40" >
										</div>
										<div class="form-group hidden_content" id="frm_npe">
											<label for="exampleTooltip">NPE Date</label>
											<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="tgl_npe" name="tgl_npe" data-toggle="tooltip" data-placement="bottom" title="Date PEB" style="width:30%">
											</div>
										</div>
										<div class="form-group">
											<form  action="POST" class="myForm2" enctype="multipart/form-data">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<label for="exampleTooltip">Upload NPE</label>
											<input type="file" accept=".pdf" id="npe_upload" name="npe_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10">
                                            <span class='upload_info'>
                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                            </span>
											</form>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Booking Ship</label>
											<input type="text" class="form-control" id="booking_ship_no" name="booking_ship_no" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10" maxlength="40" >
										</div>
										<div class="form-group">
											<form  action="POST" class="myForm3" enctype="multipart/form-data">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<label for="exampleTooltip">Upload Booking Ship</label>
											<input type="file" accept=".pdf" id="booking_ship_upload" name="booking_ship_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10">
                                            <span class='upload_info'>
                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                            </span>
											</form>
										</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6 hidden_content" id='nolnol9_content'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>*Terminal 1 (009) Only</h2>
								</header>

								<div class="main-box-body clearfix">
										<div class="form-group">
											<label for="exampleTooltip">NO SPP</label>
											<input type="text" class="form-control" id="nospp" name="nospp" data-toggle="tooltip" data-placement="bottom" title="Nomor SPP" size="10" maxlength="40" >
										</div>
										<div class="form-group">
											<label for="exampleTooltip">No. Surat Jalan</label>
											<input type="text" class="form-control" id="nosuratjalan" name="nosuratjalan" data-toggle="tooltip" data-placement="bottom" title="Nomor Surat Jalan" size="10" maxlength="40" >
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Booking Ship</label>
											<input type="text" class="form-control" id="bookingship009" name="bookingship009" data-toggle="tooltip" data-placement="bottom" title="Booking Ship" size="10" maxlength="40" >
										</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 hidden_content" id='tlbd_tlbi_content'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Lampiran Dokumen</h2>
								</header>

									<div class="main-box-body clearfix">
											<div class="form-group">
												<form  action="POST" class="myForm4" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">Upload Booking Ship/ Dokumen RO</label>
												<input type="file"  id="booking_ship_upload_dom1" name="booking_ship_upload_dom" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10">
	                                            <span class='upload_info'>
	                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
	                                            </span>
												</form>
											</div>
									</div>
							</div>
						</div>
						<div class="col-lg-6 hidden_content" id='pjg_domestik_content'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2 id="h2intersuler">*Intersuler</h2>
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
											<form  action="POST" class="myForm4" enctype="multipart/form-data">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<label for="exampleTooltip">Upload Booking Ship</label>
											<input type="file" accept=".pdf" id="booking_ship_upload_dom" name="booking_ship_upload_dom" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10">
                                            <span class='upload_info'>
                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                            </span>
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
															<option value="OVD">OVD</option>
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
													   <input type="text" class="form-control" id="container_imo" name="container_imo" data-toggle="tooltip" data-placement="bottom" title="IMO Class, isi jika kontainer bebahaya" disabled="disabled">
                                                    </div>
                                                </div>
                                                <div class="form-group">
													<label for="exampleTooltip">Commodity*</label>
                                                    <div class="input-group">
													   <input type="text" value="GENERAL CARGO            " class="form-control" id="commodity" name="commodity" data-toggle="tooltip" data-placement="bottom" title="Komoditas Kontainer">
                                                       <input type="hidden" value="C000000492" id="kd_commodity"/>
                                                    </div>
                                                </div>
                                             </div>
                                             <div style="width:30%; float:right">
												<div class="form-group">
													<label for="exampleTooltip">UN Number*</label>
                                                    <div class="input-group">
													   <input type="text" class="form-control" id="container_un" name="container_un" data-toggle="tooltip" data-placement="bottom" title="UN Number, isi jika kontainer bebahaya" disabled="disabled">
                                                    </div>
                                                </div>

												<div class="form-group">
													<label for="exampleTooltip">Temperature*</label>
                                                    <div class="input-group">
													   <input type="text" class="form-control" id="container_temperature" name="container_temperature" data-toggle="tooltip" data-placement="bottom" title="Temperatur, isi jika kontainer adalah Reefer" disabled="disabled">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group over_left">
													<label for="exampleTooltip">Over Left*</label>
													<div class="input-group">
													   <input type="text" class="form-control" id="container_excess_left" name="container_excess_left" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
													</div>
												</div>
												<div class="form-group over_right">
													<label for="exampleTooltip">Over Right*</label>
													<div class="input-group">
													   <input type="text" class="form-control" id="container_excess_right" name="container_excess_right" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
													</div>
												</div>

												<div class="form-group over_width">
													<label for="exampleTooltip">Over Width*</label>
                                                    <div class="input-group">
													   <input type="text" class="form-control" id="container_excess_width" name="container_excess_width" data-toggle="tooltip" data-placement="bottom" title="Kelebihan Lebar, isi jika kontainer tidak standar (OOG)" disabled="disabled">
                                                	</div>
                                            	</div>

                                                <div class="form-group over_front">
													<label for="exampleTooltip">Over Front*</label>
													<div class="input-group">
													   <input type="text" class="form-control" id="container_excess_front" name="container_excess_front" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
													</div>
												</div>
												<div class="form-group over_rear">
													<label for="exampleTooltip">Over Rear*</label>
													<div class="input-group">
													   <input type="text" class="form-control" id="container_excess_rear" name="container_excess_rear" data-toggle="tooltip" data-placement="bottom" disabled="disabled">
													</div>
												</div>

												
												<div class="form-group over_length">
													<label for="exampleTooltip">Over Length*</label>
                                                    <div class="input-group">
													   <input type="text" class="form-control" id="container_excess_length" name="container_excess_length" data-toggle="tooltip" data-placement="bottom" title="Kelebihan Panjang, isi jika kontainer tidak standar (OOG)" disabled="disabled">
                                                    </div>
												</div>
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
												<input type="button" id="submit_container" name="submit_container" onclick="submit_container();" value="Add Container" class="btn btn-success"/>
                                        </div>
												
										
                    </div>
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
					<div class="row" id="container_excel" name="container_excel">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Upload FIle Excel</h2>
								</header>

								<div class="main-box-body clearfix">
										<form method="post" enctype="multipart/form-data" action="<?=ROOT?>container_receiving/upload_excel">
											<div class="form-group">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">Upload</label>
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
					<div id="detailreq"></div>
          <div id="modalplaceholder"></div>
          <input type="hidden" id="valid_eta" />

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
        $.get("<?=ROOT?>container_receiving/search_vessel_modal",{term : vesselname, port: port}, function(data){
              $('#modalplaceholder').html(data).children().modal('show');
          });
      }

  }


function complete($vessel,$voyin,$voyout,$eta,$etd,$ukk,$vesselcode,$callsign,$voyage,$closedoc,$close,$contlimit,$openstack,$opname,$valid_eta){
      $( "#vessel_autocomplete" ).val( $vessel);
      $( "#voyage_in" ).val( $voyin);
      $( "#voyage_out" ).val( $voyout);
      $( "#eta" ).val( $eta);
      $( "#etd" ).val( $etd);
      $( "#end_shift" ).val( $etd);
      $( "#ukk" ).val( $ukk);
      $( "#vessel_code" ).val( $vesselcode);
      $( "#call_sign" ).val( $callsign);
      $( "#voyage" ).val( $voyage);
      $( "#closing" ).val( $close);
      $( "#openstack" ).val( $openstack);
      $( "#closingdoc" ).val( $closedoc);
      $( "#booking_limit" ).val( $contlimit);
      $( "#valid_eta" ).val( $valid_eta);

      $('#modalplaceholder').attr('display','none');

      $.post("<?=ROOT?>container_receiving/auto_pod_new",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                                                                    term: $( "#pod_autocomplete" ).val(),
                                                                    vessel: $("#vessel_autocomplete").val(),
                                                                    voyin: $("#voyage_in").val(),
                                                                    voyout: $("#voyage_out").val(),
                                                                    port: $('#port').val()
                                                                  },function(data){
          $("#comboPOD").html(data);
          $("#comboFPOD").html(data);
      });

      var port = $('#port').val();
      var explode = port.split('-');
      if(explode[0]=="IDTLB" || explode[0]=="IDDJB"){	
      	$("#shipper").show();
      	$.post("<?=ROOT?>container_receiving/get_shipper",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	                                                                    term: $( "#pod_autocomplete" ).val(),
	                                                                    vessel: $("#vessel_autocomplete").val(),
	                                                                    voyin: $("#voyage_in").val(),
	                                                                    voyout: $("#voyage_out").val(),
	                                                                    port: $('#port').val()
	                                                                  },function(data){
	          $("#ship_line").html(data);
	      });
      }else{
      	$("#shipper").hide();
      }
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


        $( "#commodity" ).autocomplete({
        minLength: 4,
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
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.COMMODITY + "<br>" +item.KD_COMMODITY+"</a>")
        .appendTo( ul );

        };
    });
	
	
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

	//datepicker
	/*var picker = $('#start_shift').datepicker({
		format: 'dd-mm-yyyy 00:00',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});*/

	var picker = $('#peb_dt').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(0),
		todayBtn: true,
		todayHighlight: true
	});
	var picker1 = $('#tgl_npe').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(0),
		todayBtn: true,
		todayHighlight: true
	});
	//.val(moment().format("D-M-YYYY 00:00"));

	</script>

<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
