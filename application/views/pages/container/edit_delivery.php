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
.ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }

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


function add_cont()
{
	var terminal = $("#port").val();
	var vessel=$( "#vessel" ).val();
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

  if(type_container=='')
	{
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

	else if (((type_container=='RFR') && (plo=='') && (terminal=='IDJKT-T3I')) || ((type_container=='RFR') && (terminal=='IDJKT-T3I')))
	{
		if (plo=='')
		{
		alert('Container Reefer, Tanggal Plug Out Tidak Boleh Kosong!');
		return false;
		} 
		else	
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
		//-----------------------------

		//----------------------------
		
	} 
	else if (((type_container=='RFR') && (plo=='') && (terminal=='IDJKT-T009D')) || ((type_container=='RFR') && (terminal=='IDJKT-T009D')))
	{
		if (pli !== '' && plo=='')
		{
		alert('Container Reefer, Tanggal Plug Out Tidak Boleh Kosong!');
		alert (pli);
		return false;		
		} 
		else if((pli !== '') && (plo !== ''))
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
		$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ID_REQ:no_request,TERMINAL:terminal,ID_VSB_VOYAGE:id_vsb_voyage,VESSEL:vessel,VESSEL_CODE:vessel_code,CALL_SIGN:call_sign,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out,NO_CONTAINER:no_container,SIZE_CONT:size_container,TYPE_CONT:type_container,STATUS_CONT:status_container,HEIGHT_CONT:height_cont,ID_CONT:id_cont,HZ:hz, IMO_CLASS:imo_class, UN_NUMBER:un_number, ISO_CODE:iso_code, TEMP:temp, WEIGHT:weight, CARRIER:carrier, OOG:oog, OVER_LEFT:over_left, OVER_RIGHT: over_right, OVER_FRONT:over_front, OVER_REAR:over_rear, OVER_HEIGHT:over_height,DELIVERY_DATE:delivery_date,DATE_DISCHARGE:date_discharge, DELIVERY_TYPE : delivery_type, POD : pod, POL : pol, PLUG_IN : pli, PLUG_OUT:plo},
		function(data){
			$.unblockUI();
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Request gagal : '+v_msg+','+v_req);
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

function delete_container(no_container){
	var terminal = $("#port").val();
	var no_request = $("#no_request").val();
	var vessel_code=$( "#vessel_code" ).val();
	var voyage=$( "#voyage" ).val();
  $.blockUI();
	var url="<?=ROOT?>container/del_cont_req_delivery";
	$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_CONTAINER:no_container, NO_REQUEST:no_request, TERMINAL:terminal, VESSEL_CODE:vessel_code, VOYAGE:voyage},
		function(data){
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Delete gagal : '+v_msg+'.'+v_req);
				return false;
			}
			else
			{
				$("#detail_container").load("<?=ROOT?>container/get_detail_delivery/add/"+no_request+"/"+terminal);
				alert(v_msg+'.'+no_container+" deleted");
			}
			$.unblockUI();
		});
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

	var url = "<?=ROOT?>container/get_detail_delivery/edit/<?=$request_data[0]['ID_REQ']?>/<?=$request_data[0]['ID_PORT']?>-<?=$request_data[0]['ID_TERMINAL']?>";
	$("#detail_container").load(url);

	var terminal = "<?=$request_data[0]['ID_TERMINAL']?>";
	terminal = terminal.slice(-1);
	if (terminal == 'I'){
		$('#international_content').removeClass('hidden_content');
	} else {
		$('#international_content').addClass('hidden_content');
	}

//======================================= autocomplete container==========================================//
	$( "#no_container" ).autocomplete({
		minLength: 11,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>container/auto_container_delivery?",{  term: $( "#no_container" ).val(), vessel_code: $("#vessel_code").val(), voyage_in: $("#voyage_in").val(), voyage_out: $("#voyage_out").val(),port: $("#port").val(),del_type : $("#delivery_type").val(),no_booking : $("#nobook").val(),vessel: $("#vessel").val()}, response);
			},
		focus: function( event, ui )
		{
			$( "#no_container" ).val( ui.item.NO_CONTAINER);
			return false;
		},
		select: function( event, ui )
		{
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
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.NO_CONTAINER + "<br>" +item.TYPE_CONT+" - " +item.SIZE_CONT+" - " +item.STATUS_CONT+"</a>")
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
});

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
											<input name="no_request" id="no_request" type="text" class="form-control" placeholder="-" data-toggle="tooltip" data-placement="bottom" title="Nomor Permintaan" size="20" value="<?=$request_data[0]['ID_REQ']?>" readOnly>
										</div>
										<div class="form-group">
											<label>Terminal</label>
											<select id="port" name="port" class="form-control" readonly>
											<option value="<?=$request_data[0]["ID_PORT"]?>-<?=$request_data[0]["ID_TERMINAL"]?>" selected><?=$request_data[0]["TERMINAL_NAME"]?></option>
											</select>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel / Voyage In - Voyage Out</label>
											<input type="text" class="form-control" id="vessel" name="vessel" placeholder="Auto Complete" title="Entry Vessel Data" value="<?=$request_data[0]['VESSEL']?>" Readonly>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['VOYAGE_IN']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['VOYAGE_OUT']?>" readonly>
											</div>

											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ETA</label>
												<input type="text" class="form-control" id="eta" name="eta" placeholder="ETA" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['ETA']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ETD</label>
												<input type="text" class="form-control" id="etd" name="etd" placeholder="ETD" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['ETD']?>" readonly>
											</div>
											<div class="form-group col-xs-12">
												<label for="exampleAutocomplete">No Booking (Lini2)</label>
												<input type="text" class="form-control" id="nobook" name="nobook" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['NO_BOOKING']?>" readonly>
											</div>

											<input type="hidden" id="id_vsb_voyage" name="id_vsb_voyage" value="<?=$request_data[0]['ID_VES_VOYAGE']?>">
											<input type="hidden" id="vessel_code" name="vessel_code" value="<?=$request_data[0]['VESSEL_CODE']?>">
											<input type="hidden" id="voyage" name="voyage"  value="<?=$request_data[0]['VOYAGE']?>">
											<input type="hidden" id="call_sign" name="call_sign" value="<?=$request_data[0]['CALL_SIGN']?>">
											<input type="hidden" id="date_discharge" name="date_discharge" value="<?=$request_data[0]['DATE_DISCHARGE']?>">
										</div>


										<div class="form-group">
												<label>Delivery Type</label>

												<select name="delivery_type" id="delivery_type" class="form-control" disabled>
													<?if(!isset($request_data[0]['TL_FLAG'])||$request_data[0]['TL_FLAG']=="N" ){?>
														
														<option value="LAP" <?php echo $request_data[0]['DEV_VIA']=="LAP"?"selected":""?>>Yard</option>
														<option value="TONGKANG" <?php echo $request_data[0]['DEV_VIA']=="TONGKANG"?"selected":""?>>Tongkang</option>

													<?} else { ?>

														<option value="TL" selected>Truck Loosing</option>
													<?}?>
												</select>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Delivery Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="delivery_date" name="delivery_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_DELIVERY']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">No BL</label>
											<input name="no_bl" id="no_bl" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor BL" size="10" value="<?=$request_data[0]['NO_BL']?>" maxlength="40" Readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Delivery Order Number</label>
											<input name="no_do" id="no_do" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor Delivery Order" size="10" value="<?=$request_data[0]['NO_DO']?>" maxlength="20" Readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Valid DO(Delivery Order) Dat</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="do_date" name="do_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_DO']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Delivery Order Upload</label>
		
											<br/>
											<?=end(explode('/',$request_data[0]['DO_FILE']))?>
										</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 hidden_content" id="international_content">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>*International Only</h2>
								</header>

								<div class="main-box-body clearfix">
									<form role="form">
										<div class="form-group">
											<label for="exampleTooltip">SPPB Number</label>
											<input id="no_sppb" name="no_sppb" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor SPPB" value="<?=$request_data[0]['NO_SPPB']?>" maxlength="40" Readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">SPPB Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sppb_date" name="sppb_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_SPPB']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SPPB Upload</label>
											<br/>
												<?=end(explode('/',$request_data[0]['SPPB_FILE']))?>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SP Custom Number</label>
											<input id="no_sp_custom" name="no_sp_custom"type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor SP Custom" size="10" value="<?=$request_data[0]['NO_SP_CUSTOM']?>" maxlength="40" Readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">SP Custom Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sp_custom_date" name="sp_custom_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_SP_CUSTOM']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SP Custom Upload</label>
											
											<br/>
											<!--<input id="file_sp_custom" name="file_sp_custom" type="file" accept=".pdf" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SP Custom" size="10">-->
											<?=end(explode('/',$request_data[0]['SP_CUSTOM_FILE']))?>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Data Kontainer</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="form-inline" role="form">
												<div class="form-group">
													<label for="exampleTooltip">Container Data</label>
													<input id="no_container" name="no_container" type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Nomor Kontainer">
													<input id="type_container" name="type_container" type="text" class="form-control" placeholder="Type" data-toggle="tooltip" data-placement="bottom" title="Type" size="8" onchange="cekTipeCont()" readOnly>
													<input id="size_container" name="size_container" type="text" class="form-control" placeholder="Size" data-toggle="tooltip" data-placement="bottom" title="Size" size="8" readOnly>
													<input id="status_container" name="status_container" type="text" class="form-control" placeholder="Status" data-toggle="tooltip" data-placement="bottom" title="Status" size="8" readOnly>
													<input id="pli" name="pli" type="text" class="form-control" placeholder="Plugin for Reefer" data-toggle="tooltip" data-placement="bottom" title="Plug In" size="20" readonly>
													<input id="plo" name="plo" type="text" class="form-control" placeholder="Plugout for Reefer" data-toggle="tooltip" data-placement="bottom" title="Plug Out" size="20">
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
												</div>
												<button onclick="add_cont()" class="btn btn-success" name="button_add_detail" id="button_add_detail">Add</button>
												<br><i><font size='1'>*Field Reefer Plug-Out Hanya Diisi Untuk Container Reefer Ocean Going / Terminal 009</font></i></br>
											</div>
											<span class="loading"></span>
										</div>
									</div>
								</div>
							</div>
					<div class="row" id="container_excel" name="container_excel">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Excel File Upload</h2>
								</header>

								<div class="main-box-body clearfix">
										<form method="post" enctype="multipart/form-data" action="<?=ROOT?>container/upload_excel_delivery">
											<div class="form-group">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<label for="exampleTooltip">Upload</label>
												<input type="hidden" id="req_excel" name="req_excel" value="<?=$request_data[0]['ID_REQ']?>">
												<input type="hidden" id="terminal_excel" name="terminal_excel" value="<?=$request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']?>">
												<input type="hidden" id="vessel_excel" name="vessel_excel" value="<?=$request_data[0]['VESSEL']?>">
												<input type="hidden" id="id_vsb_voyage_excel" name="id_vsb_voyage_excel" value="<?=$request_data[0]['ID_VES_VOYAGE']?>">
												<input type="hidden" id="vessel_code_excel" name="vessel_code_excel" value="<?=$request_data[0]['VESSEL_CODE']?>">
												<input type="hidden" id="call_sign_excel" name="call_sign_excel" value="<?=$request_data[0]['CALL_SIGN']?>">
												<input type="hidden" id="voyage_in_excel" name="voyage_in_excel" value="<?=$request_data[0]['VOYAGE_IN']?>">
												<input type="hidden" id="voyage_out_excel" name="voyage_out_excel" value="<?=$request_data[0]['VOYAGE_OUT']?>">
												<input type="hidden" id="date_delivery_excel" name="date_delivery_excel" value="<?=$request_data[0]['DATE_DELIVERY']?>">
												<input type="hidden" id="date_discharge_excel" name="date_discharge_excel" value="<?=$request_data[0]['DATE_DISCHARGE']?>">
												<input type="hidden" id="delivery_type_excel" name="delivery_type_excel" value="<?=$request_data[0]['TL_FLAG']?>">
												<input type="file" id="userfile" accept=".xls" name="userfile" data-toggle="tooltip" data-placement="bottom" title="Upload file Excel">
											</div>
											<button type="submit" id="submit_file" name="submit_file" class="btn btn-success">Upload</button>
										</form>
										<a href="<?=APP_ROOT?>templateupload/Template_Upload_Container_Delivery.xls">Download Template</a>

								</div>
							</div>
						</div>
					</div>
					<div id="detail_container" class="row">
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
									<button type="submit" onclick="window.open('<?=ROOT.'container/main_delivery'?>','_self')" class="btn btn-success">Next</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />