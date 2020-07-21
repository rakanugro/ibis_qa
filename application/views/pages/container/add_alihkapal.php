<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>

<style type="text/css">
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
});

$(document).ready(function(){
$("#shipper").hide();
	$('#port').on('change', function(){
		var terminal = ( $(this).val().split('-') )[1];
		var jns_bm= ($("#tipebm").val());
		$('#frmGroupBookingShip').addClass('hidden_content');
		$('#frmGroupSpbe').addClass('hidden_content');
		$('#frmGroupLainnya').addClass('hidden_content');
		if (terminal == 'T009D') {
			$('#nolnol9_content').removeClass('hidden_content');
			$('#pnji_content').addClass('hidden_content');
				if (jns_bm =='CALDG'){
				$('#batalmuatdel_content').removeClass('hidden_content');
				$('#nolnol9_content').addClass('hidden_content');
				} else
				{
				$('#batalmuatdel_content').addClass('hidden_content');
				$('#nolnol9_content').removeClass('hidden_content');
				}
		} 
		else if(terminal =='PNJI'){
			$('#pnji_content').removeClass('hidden_content');
			$('#nolnol9_content').addClass('hidden_content');
			//$('#batalmuatdel_content').addClass('hidden_content');
			if (jns_bm =='CALDG'){
				$('#batalmuatdel_content').removeClass('hidden_content');
				$('#pnji_content').addClass('hidden_content');
			} else
			{
				$('#batalmuatdel_content').addClass('hidden_content');
				$('#pnji_content').removeClass('hidden_content');
			}
		}
		else if(terminal =='PNJD'){
			$('#nolnol9_content').removeClass('hidden_content');
			$('#pnji_content').addClass('hidden_content');
			//$('#batalmuatdel_content').addClass('hidden_content');
				if (jns_bm =='CALDG'){
					$('#batalmuatdel_content').removeClass('hidden_content');
					$('#nolnol9_content').addClass('hidden_content');
				} else
				{
					$('#batalmuatdel_content').addClass('hidden_content');
					$('#nolnol9_content').removeClass('hidden_content');
				}
		}
		else if(terminal =='DJBD' || terminal =='TLBD' || terminal =='PNKD' || terminal =='PLMD'){

			
			$('#nolnol9_content').addClass('hidden_content');
			$('#pnji_content').addClass('hidden_content');
			if (jns_bm =='CALDG'){
				$('#batalmuatdel_content').removeClass('hidden_content');
				$('#pnji_content').addClass('hidden_content');
				$('#frmGroupSpbe').addClass('hidden_content');
				$('#nolnol9_content').removeClass('hidden_content');
				$('#frmGroupLainnya').removeClass('hidden_content');
			} else
			{
				$('#batalmuatdel_content').addClass('hidden_content');
				$('#pnji_content').addClass('hidden_content');				
				$('#frmGroupBookingShip').removeClass('hidden_content');
				$('#frmGroupSpbe').addClass('hidden_content');
				$('#frmGroupLainnya').removeClass('hidden_content');
			}
			// alert(terminal);
		}
		else if(terminal =='DJBI' || terminal == 'TLBI' || terminal =='PNKI' || terminal =='PLMI'){
			$('#pnji_content').removeClass('hidden_content');
			$('#nolnol9_content').addClass('hidden_content');
			//$('#batalmuatdel_content').addClass('hidden_content');
			if (jns_bm =='CALDG'){
				$('#batalmuatdel_content').removeClass('hidden_content');
				$('#pnji_content').addClass('hidden_content');
				$('#frmGroupSpbe').removeClass('hidden_content');
				$('#frmGroupLainnya').removeClass('hidden_content');
			} else
			{
				$('#batalmuatdel_content').addClass('hidden_content');
				$('#pnji_content').removeClass('hidden_content');				
				$('#frmGroupBookingShip').removeClass('hidden_content');
				$('#frmGroupSpbe').addClass('hidden_content');
			}
		}
		else {
			$('#nolnol9_content').addClass('hidden_content');
			$('#pnji_content').addClass('hidden_content');
			$('#batalmuatdel_content').addClass('hidden_content');
		}
	});

	$('#tipebm').on('change', function(){
		var terminal = ( $("#port").val().split('-') )[1];
		if ( $(this).val() == 'CALDG' ){
			$('#batalmuatdel_content').removeClass('hidden_content');
			$('#nolnol9_content').addClass('hidden_content');
			$('#pnji_content').addClass('hidden_content');
			$('#frmGroupLainnya').addClass('hidden_content');
			if(terminal=='DJBI' || terminal=='TLBI' || terminal=='PLMI' || terminal=='PNKI'){
				$('#frmGroupBookingShip').addClass('hidden_content');
				$('#frmGroupSpbe').removeClass('hidden_content');
				$('#frmGroupLainnya').removeClass('hidden_content');
				
			}else if(terminal=='DJBD' || terminal=='TLBD' || terminal=='PLMD' || terminal=='PNKD'){
				$('#frmGroupBookingShip').addClass('hidden_content');
				$('#frmGroupSpbe').addClass('hidden_content');
				$('#frmGroupLainnya').removeClass('hidden_content');

			} else{
				$('#frmGroupSpbe').addClass('hidden_content');
			}	
			

		} else {
			$('#batalmuatdel_content').addClass('hidden_content');
			$('#nolnol9_content').removeClass('hidden_content');
			$('#frmGroupBookingShip').addClass('hidden_content');
			$('#frmGroupLainnya').addClass('hidden_content');
			if(terminal=='PNJI')
			{ 
				$('#pnji_content').removeClass('hidden_content');
				$('#nolnol9_content').addClass('hidden_content');
			} else if(terminal=='DJBI' || terminal=='TLBI' || terminal=='PLMI' || terminal=='PNKI'){
				$('#pnji_content').removeClass('hidden_content');
				$('#nolnol9_content').addClass('hidden_content');
				$('#pnji_content').removeClass('hidden_content');				
				$('#frmGroupBookingShip').removeClass('hidden_content');
				$('#frmGroupSpbe').addClass('hidden_content');
			} else if(terminal=='DJBD' || terminal=='TLBD'  || terminal=='PLMD' || terminal=='PNKD'){
				$('#batalmuatdel_content').addClass('hidden_content');
				$('#pnji_content').addClass('hidden_content');				
				$('#frmGroupBookingShip').removeClass('hidden_content');
				$('#frmGroupSpbe').addClass('hidden_content');
				$('#frmGroupLainnya').removeClass('hidden_content');
			} else
			{
				$('#pnji_content').addClass('hidden_content');
				$('#nolnol9_content').removeClass('hidden_content');
			}
			
		}
	});
});

function submitheader() {
	var port = $("#port").val();
	var vessel_autocomplete = $("#vessel_autocomplete").val();
	var ukk = $("#ukk").val();
	var fpod = $( "#comboFPOD option:selected" ).val();
	var fpod_name = $( "#comboFPOD option:selected" ).text();
	var pod = $( "#comboPOD option:selected" ).val();
	var pod_name = $( "#comboPOD option:selected" ).text();
	var trading_type = $("#trading_type").val();
	//optional
	var booking_ship = $("#booking_numb").val();
	var voyage_in = $("#voyage_in").val();
	var voyage_out = $("#voyage_out").val();
	var shipping_line = $("#shipping_line").val();
	var etd = $("#etd").val();
	var tipebm = $("#tipebm").val();
	var tgldel_ = $("#tgl_delivery").val();
	var peb = $("#peb_no").val();
	var npe = $("#npe_no").val();


	var nosuratjalan = $("#nosuratjalan").val();
	var vesselcode = $("#vesselcode").val();
	var callsign = $("#callsign").val();
	var callsign = $("#callsign").val();
	var ship_line = $( "#ship_line_data " ).val();
	var shipper = $("#ship_line_data").val();

	if (tipebm == "") {
		 alert("Tipe Batal muat harus diisi");
		$( "#tipebm" ).focus();
		return false;
	}

	if (tipebm =='CALDG') {
		if ((port == "IDTLB-TLBI" || port == "IDDJB-DJBI") && $("#sppb_upload").val() == "")
		{
			alert("Dokumen SPPB Wajib Diupload");
		    $( "#sppb_upload" ).focus();
		    return false;
		} 
		if (tgldel_ == ""){
		 alert("Tanggal delivery harus diisi");
		$( "#tgl_delivery" ).focus();
		return false;
		}
	}
	if ((tipebm =='CALAG') || (tipebm =='CALBG')){
	 	if (port == "IDPNJ-PNJI" && peb == "")
		{
			alert("Nomor PEB harus diisi");
            $( "#peb_no" ).focus();
            return false;
		}
		
		if (port == "IDPNJ-PNJI" && npe == "")
		{
			alert("Nomor NPE harus diisi");
            $( "#npe_no" ).focus();
            return false;
		}

		if (port == "IDPNJ-PNJI" && $("#npe_upload").val() == "")
		{
			alert("Dokumen NPE Wajib Diupload");
            $( "#npe_upload" ).focus();
            return false;
		}
		
		if (port == "IDPNJ-PNJI" && $("#peb_upload").val() == "")
		{
			alert("Dokumen PEB Wajib Diupload");
            $( "#peb_upload" ).focus();
            return false;
		} 
		if ((port == "IDTLB-TLBI" || port == "IDTLB-TLBD" || port == "IDDJB-DJBI" || port == "IDDJB-DJBD") && $("#booking_ship_upload").val() == "")
		{
			alert("Dokumen RO Wajib Diupload");
		    $( "#booking_ship_upload" ).focus();
		    return false;
		}
		
	}

	if(port=="")
	{
		var notification = new NotificationFx({
			message : '<p>Terminal harus diisi </p>',
			layout : 'growl',
			effect : 'jelly',
			type : 'warning' // notice, warning, error or success

		});
		// show the notification
		notification.show();
		$( "#port" ).focus();
		return false;
	}

	if(vessel_autocomplete=="")
	{
		var notification = new NotificationFx({
			message : '<p>Kapal harus diisi </p>',
			layout : 'growl',
			effect : 'jelly',
			type : 'warning' // notice, warning, error or success

		});
		// show the notification
		notification.show();
		$( "#vessel_autocomplete" ).focus();
		return false;
	}

	if(ukk=="")
	{
		var notification = new NotificationFx({
			message : '<p>ID VVD tidak boleh kosong </p>',
			layout : 'growl',
			effect : 'jelly',
			type : 'warning' // notice, warning, error or success

		});
		// show the notification
		notification.show();
		$( "#ukk" ).focus();
		return false;
	}

	if(pod_name=="")
	{
		var notification = new NotificationFx({
			message : '<p>POD tidak boleh kosong </p>',
			layout : 'growl',
			effect : 'jelly',
			type : 'warning' // notice, warning, error or success

		});
		// show the notification
		notification.show();
		//$( "#pod_autocomplete" ).focus();
		$( "#comboPOD" ).focus();
		return false;
	}

	var url = "<?=ROOT?>container_alihkapal/submit_alihkapal";
	$.blockUI();
	$.post(url,{
		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		tgldel :tgldel_,
		peb_no: peb,
		npe_no: npe,
		vessel:vessel_autocomplete,
		voyage_in:voyage_in,
		voyage_out:voyage_out,
		booking_numb: booking_ship,
		port: port,
		ukk: ukk,
		fpod: fpod,
		fpod_name:
		fpod_name,
		pod: pod,
		pod_name: pod_name,
		shipping_line:shipping_line,
		etd:etd,
		tipebm:tipebm,
		nosuratjalan:nosuratjalan,
		vesselcode:vesselcode,
		callsign:callsign,ship_line:ship_line},
	function(data) {
		$.unblockUI();
		if(data == 'salah') { //pasang validasi sisi server
			alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			return false;
		}

		$(':button').attr('disabled');
		//alert(data);
		var explode = data.split(',');
		//alert(explode[0]);
		if(explode[0] == 'OK'){
			$("#container_data").attr('class', 'row');
			$("#request_no").val(explode[1]);
			$("#submit_header").attr('style','display:none');
			var notification = new NotificationFx({
				message : '<p>Anda mendapatkan no request </p>('+explode[1]+')',
				layout : 'growl',
				effect : 'jelly',
				type : 'success' // notice, warning, error or success
			});
			// show the notification
			notification.show();

			var port = $("#port").val();
			var explode = port.split('-');
			var portid = explode[0];
			var term   = explode[1];
			var request_no = $("#request_no").val();
			
				if (port == "IDPNJ-PNJI") {
						submitFilePEB(request_no);
						submitFileNPE(request_no);
				} 
				if (port == "IDTLB-TLBI" || port == "IDDJB-DJBI" || port == "IDPLM-PLMI" || port == "IDPNK-PNKI") {
					if(tipebm == 'CALAG' || tipebm == 'CALBG'){
						submitFilePEB(request_no);
						submitFileNPE(request_no);
						// alert('a');
						submitFileRO(request_no);	
					} else{
						submitFileSppb(request_no);
						submitFileLainnya(request_no);
					}

				}
				if(port == 'IDTLB-TLBD' || port == 'IDDJB-DJBD' || port == "IDPLM-PLMD" || port == "IDPNK-PNKD"){
					if(tipebm == 'CALAG' || tipebm == 'CALBG'){
						submitFileRO(request_no);	
						submitFileLainnya(request_no);
					} else{
						submitFileLainnya(request_no);
					}
				}

			
			var url = "<?=ROOT?>container_alihkapal/getListContainer/"+request_no+"/"+portid+"/"+term+"/E";
			$("#detailreq").load(url,{
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},function(data){ });

		}
		else {
			var notification = new NotificationFx({
				message : '<p>Request Gagal </p>'+explode[1],
				layout : 'growl',
				effect : 'jelly',
				type : 'error' // notice, warning, error or success

			});
			// show the notification
			notification.show();
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
		function submitFileRO(reqNo)
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
		function submitFileSppb(reqNo)
		{
			var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/sppb_upload";
	        var formData = new FormData($('.myForm4')[0]);

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
		function submitFileLainnya(reqNo)
		{
			var formUrl = "<?=ROOT?>container/upload_doc/"+reqNo+"/lainnya_upload";
	        var formData = new FormData($('.myForm5')[0]);

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
function submit_container() {
	var request_no = $("#request_no").val();
	var container_autocomplete = $("#container_autocomplete").val();
	var container_size = $("#container_size").val();
	var container_type = $("#container_type").val();
	var container_status = $("#container_status").val();
	var container_height = $("#container_height").val();
	var ukk_old = $("#no_ukk_old").val();
	var ukk_new = $("#ukk").val();
	var etd = $("#etd").val();
	var hz = $("#hz").val();
	var isocode = $("#isocode").val();
	var port = $("#port").val();
	var explode = port.split('-');
	var portid = explode[0];
	var term   = explode[1];
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
	$.blockUI();
	$.post( "<?=ROOT?>container_alihkapal/addcontainerBM", {
		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,
		container_no:container_autocomplete,
		container_size:container_size,
		container_type:container_type,
		container_status:container_status,
		port:port,
		ukk_old:ukk_old,
		ukk_new:ukk_new,
		etd:etd,
		hz:hz,
		isocode:isocode,
		container_height:container_height})

		.done(function( data ) {
			$.unblockUI();
			if(data == "OK")
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

				var request_no = $("#request_no").val();
				var url = "<?=ROOT?>container_alihkapal/getListContainer/"+request_no+"/"+portid+"/"+term+"/E";
				$("#detailreq").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},function(data){ });
				$("#container_autocomplete").val("");
				$("#container_size").val("");
				$("#container_type").val("");
				$("#container_status").val("");
				 $("#container_height").val("");
				$("#isocode").val("");
				$("#hz").val("");
			}
			else if(data=="EXIST"){
				var notification = new NotificationFx({
					message : '<p>Gagal, Container Sudah ditambahkan </p><br/>',
					layout : 'growl',
					effect : 'jelly',
					type : 'error' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}
			else{
				var notification = new NotificationFx({
					message : '<p>Tambah Container Gagal </p><br/> ' +data,
					layout : 'growl',
					effect : 'jelly',
					type : 'error' // notice, warning, error or success

				});

				// show the notification
				notification.show();
			}

	}).fail(function() {
		alert("error, simpan container gagal");
	});

	return false;
}

/*function del_cont($nocont,$idreq){
    var url = "<?=ROOT?>container_alihkapal/delete_container";
    $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',nocont:$nocont,idreq:$idreq},function(data){
        var notification = new NotificationFx({
            message : '<p>Delete Container Success </p><br/>',
            layout : 'growl',
            effect : 'jelly',
            type : 'success' // notice, warning, error or success

        });

        // show the notification
        notification.show();
    });
}*/

</script>

					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Loading Cancel Request</h2>
								</header>

									<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Request Number </label>
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
											<label for="exampleAutocomplete">Type Of Loading Cancel </label>
											<select id="tipebm" name="tipebm" class="form-control">
												 <option></option>
													<option value="CALBG">Loading Cancel Before Gatein</option>
													 <option value="CALAG">Loading Cancel After Gatein</option>
													<option value="CALDG">Loading Cancel Delivery</option>
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
											<input type="hidden" class="form-control" id="ukk" name="ukk" placeholder="ukk" readonly>
											<input type="hidden" class="form-control" id="vesselcode" name="vesselcode" placeholder="vesselcode" readonly>
											<input type="hidden" class="form-control" id="callsign" name="callsign" placeholder="callsign" readonly>
										</div>

                                        <div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete">ETA</label>
                                        <input type="text" class="form-control" id="eta" name="eta" placeholder="autocomplete" readonly>
                                        </div>
                                        <div class="form-group example-twitter-oss">
                                            <label for="exampleAutocomplete">ETD </label>
                                            <input type="text" class="form-control" id="etd" name="etd" placeholder="autocomplete" readonly>
                                        </div>
                                        <div class="form-group example-twitter-oss">
                                            <label for="exampleAutocomplete">Shipping Line</label>
                                            <input type="text" class="form-control" id="shipping_line" name="shipping_line" placeholder="autocomplete" readonly>
                                        </div>

								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
								</header>

								<div class="main-box-body clearfix">

                                    <div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete">Port of Discharge (POD)</label>
                                        <!--<input type="text" class="form-control" id="pod_autocomplete" name="pod_autocomplete" placeholder="autocomplete" title="Masukkan data POD">-->
                                        <input type="hidden" id="idpod" name="idpod"/>
										<div id="comboPOD"></div>
                                    </div>
									 <div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete">Final Port of Discharge (FPOD)</label>
                                        <!--<input type="text" class="form-control" id="fpod_autocomplete" name="fpod_autocomplete" placeholder="autocomplete" title="Masukkan data FPOD">-->
                                        <input type="hidden" id="idfpod" name="idfpod"/>
										<div id="comboFPOD"></div>
                                    </div>
                                     <div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete" id="shipper">Shipper</label>
                                       
										<div id="ship_line"></div>
                                    </div>
                                    <div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete">Booking Number ( No Request Receiving Number)</label>
                                        <input type="text" class="form-control" id="booking_numb" name="booking_numb" maxlength="40" >
                                    </div>

									<div id='batalmuatdel_content' class='hidden_content'>
										<div class="form-group example-twitter-oss">
											<label>Delivery Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input class="form-control" id="tgl_delivery" name='tgl_delivery' type="text">
											</div>
										</div>
									</div>

									<div id='nolnol9_content' class='hidden_content'>
										<div class="form-group">


											<label for="exampleTooltip">No Surat Jalan</label>
											<input type="text" class="form-control" id="nosuratjalan" name="nosuratjalan" data-toggle="tooltip" data-placement="bottom" title="Nomor Surat Jalan" size="10" maxlength="40" >
										</div>
									</div>
									
									<div id='pnji_content' class='hidden_content'>
										<div class="form-group">
											<label for="exampleTooltip">Nomor PEB</label>
											<input type="text" class="form-control" id="peb_no" name="peb_no" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB" maxlength="40" >
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
											
									</div>
									<div id='frmGroupBookingShip' class='hidden_content'>
											<div class="form-group">
												<form  action="POST" class="myForm3" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">Upload Booking Ship/ RO</label>
												<input type="file" accept=".pdf" id="booking_ship_upload" name="booking_ship_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10">
	                                            <span class='upload_info'>
	                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
	                                            </span>
												</form>
											</div>
									</div>
									<div id='frmGroupSpbe' class='hidden_content'>
											<div class="form-group">
												<form  action="POST" class="myForm4" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">Upload SPPBE</label>
												<input type="file" accept=".pdf" id="sppb_upload" name="sppb_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10">
	                                            <span class='upload_info'>
	                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
	                                            </span>
												</form>
											</div>
									</div>
									<div id='frmGroupLainnya' class='hidden_content'>
											<div class="form-group">
												<form  action="POST" class="myForm5" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">Upload Dokumen Lainnya</label>
												<input type="file" accept=".pdf" id="lainnya_upload" name="lainnya_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10">
	                                            <span class='upload_info'>
	                                                Accepted File Type: PDF, Max Size: <?php echo $max_size?>
	                                            </span>
												</form>
											</div>
									</div>
									<input type="button" value="Simpan" onclick="submitheader()" id="submit_header" name="submit_header" class="btn btn-success"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="container_data" name="container_data">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Data Container</h2>
										</header>

										<div class="main-box-body clearfix">
								            <div class="form-inline">
												<div class="form-group">
													<label for="container_autocomplete">No Kontainer</label>
													<input type="text" class="form-control" id="container_autocomplete" name="container_autocomplete" placeholder="" data-toggle="tooltip" data-placement="bottom" title="Nomor Kontainer">
                                                    <input type="hidden" id="no_ukk_old" />
                                                    <input title="Size" type="text" size="10" id="container_size" name="container_size" class="form-control" readonly data-toggle="tooltip" data-placement="bottom"/>
                                                    <input title="Type" type="text" size="10" id="container_type" name="container_type" class="form-control" readonly data-toggle="tooltip" data-placement="bottom"/>
                                                    <input title="Status" type="text"  size="10" id="container_status" name="container_status" class="form-control" readonly data-toggle="tooltip" data-placement="bottom"/>
													<input title="Status" type="text"  size="10" id="container_height" name="container_height" class="form-control" readonly data-toggle="tooltip" data-placement="bottom"/>
                                                    <input title="Iso Code" type="text"  size="10" id="isocode" name="isocode" class="form-control" readonly data-toggle="tooltip" data-placement="bottom"/>
                                                    <input title="Dangerous" type="text" id="hz" name="hz" class="form-control" readonly size="10" data-toggle="tooltip" data-placement="bottom"/>
                                                </div>
                                            </div>

												<input type="button" onclick="submit_container()" value="Simpan" id="submit_container" name="submit_container" class="btn btn-success"/>

										</div>
									</div>
								</div>
							</div>

					<div id="detailreq"></div>
		<div id="modalplaceholder"></div>
</div>


	<script>
  function search_vessel(){
      var vesselname = $("#vessel_autocomplete").val();
      var port       = $('#port').val();
			var cal_type   = $("#tipebm").val();
      //var url = "<?=ROOT?>autocomplete/getVesselList";
      if(vesselname == ''){
          $("#vessel_autocomplete").focus();
          alert('Mohon diisi kolomnya');
      }
      else{
				if(cal_type == 'CALDG'){
					$.get("<?=ROOT?>container_alihkapal/search_vessel_caldl?",{term : vesselname, port: port}, function(data){
								$('#modalplaceholder').html(data).children().modal('show');
						});
				}
				else {
        	$.get("<?=ROOT?>container_receiving/search_vessel_modal",{term : vesselname, port: port}, function(data){
              $('#modalplaceholder').html(data).children().modal('show');
          });
				}
      }

  }

  function complete($vessel,$voyin,$voyout,$eta,$etd,$ukk,$vesselcode,$callsign,$voyage,$closedoc,$close,$contlimit,$openstack,$opname){
      $( "#vessel_autocomplete" ).val( $vessel);
      $( "#vesselcode" ).val( $vesselcode);
      $( "#voyage_in" ).val( $voyin);
      $( "#voyage_out" ).val( $voyout);
      $( "#eta" ).val( $eta);
      $( "#etd" ).val( $etd);
		  $( "#shipping_line" ).val( $opname);
		  $( "#ukk" ).val( $ukk);

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

		$('#tgl_delivery').datepicker({
			format: 'dd-mm-yyyy',
			startDate: new Date(),
			todayBtn: true,
			todayHighlight: true
		});

		/*
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
            $( "#ukk" ).val( ui.item.NO_UKK);
            $( "#shipping_line" ).val( ui.item.OPNAME);
			$( "#vesselcode" ).val( ui.item.VESSEL_CODE);
			$( "#callsign" ).val( ui.item.CALL_SIGN);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'><p class='repo-language'>" + item.VESSEL + "</p><p class='repo-name'>Voyage in " +item.VOYAGE_IN+"- Voyage out "+item.VOYAGE_OUT+"</p></a>")
        .appendTo( ul );

        };
		*/

        $( "#container_autocomplete" ).autocomplete({
        minLength: 11,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>container_alihkapal/autoContainer?",{  term: $( "#container_autocomplete" ).val(),
                                                                          port: $('#port').val(),
																		  tipebm: $('#tipebm').val(),
																		  vessel: $('#vessel_autocomplete').val(),
																		  voyin: $('#voyage_in').val(),
																		  no_request: $("#booking_numb").val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#container_autocomplete" ).val( ui.item.NO_CONTAINER);
            return false;
        },
        select: function( event, ui )
        {
            $( "#container_autocomplete" ).val( ui.item.NO_CONTAINER);
            $( "#container_size" ).val( ui.item.SIZE_CONT);
            $( "#container_type" ).val( ui.item.TYPE_CONT);
            $( "#container_status" ).val( ui.item.STATUS);
			$( "#container_height" ).val( ui.item.HEIGHT);
            $( "#no_ukk_old" ).val( ui.item.NO_UKK);
            $( "#hz" ).val( ui.item.HZ);
            $( "#isocode" ).val( ui.item.KD_BARANG);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'><p class='repo-language'>" + item.NO_CONTAINER + "<br/>" +item.SIZE_CONT+"|"+item.STATUS+"</a>")
        .appendTo( ul );

        };


        /*
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
            $( "#fpod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            return false;
        },
        select: function( event, ui )
        {
            $( "#fpod_autocomplete" ).val( ui.item.NM_PELABUHAN);
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

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.NM_PELABUHAN + "<br>" +item.ID_PELABUHAN+"</a>")
        .appendTo( ul );

        };
		*/


    });


	</script>
