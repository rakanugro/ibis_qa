
<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
	.label {
		display: inline-block;
	}
</style>

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
	
	$( "#truck_id_" ).autocomplete({
		
		minLength: 3,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>truck_container/auto_truck_number",{<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo
								$this->security->get_csrf_hash(); ?>' ,  term: $( "#truck_id_" ).val(), port: $("#port_").val()}, response);

			},
		focus: function( event, ui )
		{
			$( "#truck_id_" ).val( ui.item.CDY_TRCK_CODE);
			return false;
		},
		select: function( event, ui )
		{

			$("#truck_id_").val( ui.item.CDY_TRCK_CODE);
			$("#truck_number_" ).val( ui.item.CDY_TRCK_EDI);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.CDY_TRCK_CODE + "<br>" +item.CDY_TRCK_EDI+" </a>")
		.appendTo( ul );

	};
	
	$( "#truck_id" ).autocomplete({
		
		minLength: 3,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>truck_container/auto_truck_number",{<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo
								$this->security->get_csrf_hash(); ?>' ,  term: $( "#truck_id" ).val(), port: $("#port").val()}, response);

			},
		focus: function( event, ui )
		{
			$( "#truck_id" ).val( ui.item.CDY_TRCK_CODE);
			return false;
		},
		select: function( event, ui )
		{

			$("#truck_id").val( ui.item.CDY_TRCK_CODE);
			$("#truck_number" ).val( ui.item.CDY_TRCK_EDI);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.CDY_TRCK_CODE + "<br>" +item.CDY_TRCK_EDI+" </a>")
		.appendTo( ul );

	};
	
	$( "#no_container_noneservice" ).autocomplete({
		
		minLength: 4,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>truck_container/search_noneservice",{<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo
								$this->security->get_csrf_hash(); ?>' ,  no_container: $( "#no_container_noneservice" ).val() ,  no_request: $( "#search_noneservice" ).val(), port: $("#port_").val(), request: $("#request").val()}, response);

			},
		focus: function( event, ui )
		{
			$( "#no_container_noneservice" ).val( ui.item.NO_CONTAINER);
			return false;
		},
		select: function( event, ui )
		{
			$("#no_container_noneservice").val( ui.item.NO_CONTAINER);	
			$("#no_container_").val( ui.item.NO_CONTAINER);	
			$("#pin_number_" ).val( ui.item.PIN_NUMBER);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'><p class='repo-language'>" + item.NO_CONTAINER + "</p></a>")
		.appendTo( ul );

	};


	$( "#no_container_eservice" ).autocomplete({
		
		minLength: 4,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>truck_container/search_eservice",{<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo
								$this->security->get_csrf_hash(); ?>' ,  no_container: $( "#no_container_eservice" ).val() ,  no_request: $( "#search_eservice" ).val(), port: $("#port").val()}, response);

			},
		focus: function( event, ui )
		{
			$( "#no_container_eservice" ).val( ui.item.NO_CONTAINER);
			return false;
		},
		select: function( event, ui )
		{
			$("#no_container_eservice").val( ui.item.NO_CONTAINER);	
			$("#no_container").val( ui.item.NO_CONTAINER);	
			$("#pin_number" ).val( ui.item.PIN_NUMBER);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'><p class='repo-language'>" + item.NO_CONTAINER + "</p></a>")
		.appendTo( ul );

	};
});

	$( document ).ready(function() {
		
		$( "#table-request a" ).on( "mouseup", function() {
			$( "#table-request a" ).attr('disabled','disabled');
		});	
	});
	
	function clickDialog1(a)
	{
		$('#dialogViewReq').load("<?=ROOT?>/container/view_request/"+a)
		.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	}
	function clickConfirm(a)
	{
		var r = confirm("Are you sure to confirm?");
		if (r == true) {
			var url = "<?=ROOT?>container/confirm_request";
			$.blockUI();
			$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:a}, function(data){
				$.unblockUI();
				alert(data);
				if(data=="Success")
					location.reload(); 
			});
		}
		$('a').removeAttr('disabled');
	}
	/* 
	$('#service').on('change', function(){
		alert ($(this).val().slice(-2));
		 var service = $(this).val().slice(-2);
		console.log(service);
		if (service == 'es') {
			$('#eservice').removeClass('hidden_content');
			$('#non_eservice').addClass('hidden_content');
		}
		else  {
			$('#eservice').addClass('hidden_content');
			$('#non_eservice').removeClass('hidden_content');
		} 
	
	}); */
	
	function select_service(value){
		
		if (value == 'yes') {
			$('#eservice').show();
			$('#non_eservice').hide();
			 $('#load_data_from_search').html('');
		}
		else if (value == 'non'){
			$('#eservice').hide();
			$('#non_eservice').show();
			 $('#load_data_from_search').html('');
		} 
		else{
			$('#eservice').hide();
			$('#non_eservice').hide();
			 $('#load_data_from_search').html('');
		}
	}
		 
	function save_tca_association_eservice()
	{
	var terminal = $("#port").val();
	var eservice = $("#service").val();
	var no_request = $("#search_eservice").val();
	var no_container = $("#no_container").val();
	var truck_id = $("#truck_id").val();
	var pin_number = $("#pin_number").val();
	
	if(no_request=='')
	{
		alert('No Request tidak boleh kosong');
		return false;
	}
	
	if(no_container=='')
	{
		alert('No Container tidak boleh kosong');
		return false;
	}
	
	if(truck_id=='')
	{
		alert('Truck ID tidak boleh kosong');
		return false;
	}
	
	var url="<?=ROOT?>truck_container/check_save_tca";
	$.blockUI();
	$.post(url,{terminal:terminal,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
	
		var obj = jQuery.parseJSON( data );
		
		if(obj.rc == 'F' && obj.data == null ){
			$.unblockUI();
			alert('TRUCK SUDAH DI TCA KAN OLEH CUSTOMER LAIN');
				return false;
		}
		else if(obj.data.info == 'OK') {
			var url="<?=ROOT?>truck_container/save_tca_association";
			$.post(url,{terminal:terminal,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				
				$.unblockUI();
				var obj = jQuery.parseJSON( data );
				if(obj.rc=="F") {
				alert("Request Gagal : "+obj.rcmsg);
				$(':button').removeAttr('disabled');
				return false;
				}
			else {					
				alert("Asosiasi Truck Berhasil");
				window.location = "<?=ROOT?>truck_container/main_tca";
				}
			}
			);
		}
		else if(obj.data.info == 'OKTCA'){
			$.unblockUI();
			var txt;
			if (confirm("TRUCK SUDAH DIASOSIAKAN SEBELUMNYA, KLICK 'OK' JIKA SETUJU BAWA COMBO ")) {
				var url="<?=ROOT?>truck_container/save_tca_association";
				$.post(url,{terminal:terminal,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				$.unblockUI();
				var obj = jQuery.parseJSON( data );
				if(obj.rc=="F") {
				alert("Request Gagal : "+obj.rcmsg);
				$(':button').removeAttr('disabled');
				return false;
				}
			else {					
				alert("Asosiasi Truck Berhasil");
				window.location = "<?=ROOT?>truck_container/main_tca";
				}
			}
				);
			} 
		}
		else if(obj.data.info == 'NO'){
			$.unblockUI();
			{
				alert("CONTAINER SUDAH TERASOSIASI");
				$(':button').removeAttr('disabled');
				return false;
				}
		}

		else if(obj.data.info == 'M2M'){
			$.unblockUI();
			{
				alert("TRUCK SUDAH TERASOSIASI M2M");
				$(':button').removeAttr('disabled');
				return false;
				}
		}
		
		else if(obj.data.info == 'NOTCA1'){
			$.unblockUI();
			{
				alert("TRUCK SUDAH DIASOSIASI DENGAN 2 CONTAINER");
				$(':button').removeAttr('disabled');
				return false;
				}
		}
	});
	
	/* var url="<?=ROOT?>truck_container/save_tca_association";
	$.blockUI();
	$.post(url,{terminal:terminal,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
		//alert(data);
		$.unblockUI();
		if(data == 'salah') {
			alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			return false;
		}
	
		//$(':button').attr('disabled','disabled');
		
		var obj = jQuery.parseJSON( data );
		//alert(var obj);
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
				alert("Registrasi Truck Berhasil");
				
				window.location = "<?=ROOT?>truck_container/create_truck_registration";
				// show the notification
				notification.show();
			}
			$(':button').removeAttr('disabled');
		}
	}); */

	}
	
	function save_tca_association_noneservice()
	{
	var terminal = $("#port_").val();
	var type = $( "#request" ).val();
	var eservice = $("#service").val();
	var no_request = $("#search_noneservice").val();
	var no_container = $("#no_container_").val();
	var truck_id = $("#truck_id_").val();
	var pin_number = $("#pin_number_").val();
	
	if(no_request=='')
	{
		alert('No Request tidak boleh kosong');
		return false;
	}
	
	if(no_container=='')
	{
		alert('No Container tidak boleh kosong');
		return false;
	}
	
	if(truck_id=='')
	{
		alert('Truck ID tidak boleh kosong');
		return false;
	}
	
	var url="<?=ROOT?>truck_container/check_save_tca";
	$.blockUI();
	$.post(url,{terminal:terminal,type:type,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
	
		var obj = jQuery.parseJSON( data );
		console.log(obj.data.info);
		if(obj.rc == 'F' && obj.data == null ){
			$.unblockUI();
			alert('TRUCK SUDAH DI TCA KAN OLEH CUSTOMER LAIN');
				return false;
		}
		else if(obj.data.info == 'CONT_MTY'){
			$.unblockUI();
			var txt;
			if (confirm("TRUCK SUDAH DIASOSIAKAN SEBELUMNYA, KLICK 'OK' JIKA SETUJU BAWA COMBO EMPTY ")) {
				$.blockUI();
				var url="<?=ROOT?>truck_container/save_tca_association";
				$.post(url,{terminal:terminal,type:type,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				$.unblockUI();
				var obj = jQuery.parseJSON( data );
				if(obj.rc=="F") {
				alert("Request Gagal : "+obj.rcmsg);
				$(':button').removeAttr('disabled');
				return false;
				}
			else {					
				alert("Asosiasi Truck Berhasil");
				//window.location = "<?=ROOT?>truck_container/main_tca";
				}
			}
				);
			} 
		}
		else if(obj.data.info == 'OK') {
			var url="<?=ROOT?>truck_container/save_tca_association";
			$.post(url,{terminal:terminal,type:type,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				
				$.unblockUI();
				var obj = jQuery.parseJSON( data );
				if(obj.rc=="F") {
				alert("Request Gagal : "+obj.rcmsg);
				$(':button').removeAttr('disabled');
				return false;
				}
			else {					
				alert("Asosiasi Truck Berhasil");
				//window.location = "<?=ROOT?>truck_container/main_tca";
				}
			}
			);
		}
		else if(obj.data.info == 'OKTCA'){
			$.unblockUI();
			var txt;
			if (confirm("TRUCK SUDAH DIASOSIAKAN SEBELUMNYA, KLICK 'OK' JIKA SETUJU BAWA COMBO ")) {
				$.blockUI();
				var url="<?=ROOT?>truck_container/save_tca_association";
				$.post(url,{terminal:terminal,type:type,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				$.unblockUI();
				var obj = jQuery.parseJSON( data );
				if(obj.rc=="F") {
				alert("Request Gagal : "+obj.rcmsg);
				$(':button').removeAttr('disabled');
				return false;
				}
			else {					
				alert("Asosiasi Truck Berhasil");
				//window.location = "<?=ROOT?>truck_container/main_tca";
				}
			}
				);
			} 
		}
		else if(obj.data.info == 'NO'){
			$.unblockUI();
			{
				alert("CONTAINER SUDAH TERASOSIASI");
				$(':button').removeAttr('disabled');
				return false;
				}
		}
		
		else if(obj.data.info == 'NOTCA1'){
			$.unblockUI();
			{
				alert("Truck Sudah di Asosiasikan dengan 1 Container");
				$(':button').removeAttr('disabled');
				return false;
				}
		}
		
		else if(obj.data.info == 'NOTCA2'){
			$.unblockUI();
			{
				alert("Truck Sudah di Asosiasikan dengan 2 Container");
				$(':button').removeAttr('disabled');
				return false;
				}
		}
		
	});
	
/* 	var url="<?=ROOT?>truck_container/save_tca_association";
	$.blockUI();
	$.post(url,{terminal:terminal,type:type,eservice:eservice,no_request:no_request,no_container:no_container,truck_id:truck_id,pin_number:pin_number,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
		//alert(data);
		$.unblockUI();
		if(data == 'salah') {
			alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			return false;
		}
	
		$(':button').attr('disabled','disabled');
		
		var obj = jQuery.parseJSON( data );
		//alert(var obj);
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
				document.getElementById('submit_header_').style.display = "none";
				alert("Asosiasi Truck Berhasil");
				
				window.location = "<?=ROOT?>truck_container/main_tca";
				
				// show the notification
				notification.show();
			}
			//$(':button').removeAttr('disabled');
			
		}
	}); */
	}
</script>
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?=CUBE_?>js/jquery.dataTables.shortingEuro.js"></script>
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_?>js/sweetalert.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/sweetalert.css"/>

<!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>					
				<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Booking Data</h2>
								</header>

									<div class="main-box-body clearfix">
									
									<div class="col-sm-2">
									  <label class="control-label">SERVICE</label>
									</div>  
									<div class="col-sm-6">  
									  <select id="service" name="service" class="form-control" placeholder="" maxlength="100" onchange="select_service(this.value)">
										<option value="">Select</option>
										<option value="yes">Eservice</option>
										<option value="non">Non Eservice</option>
									  </select>
									</div>
										
									</div>
							</div>
						</div>
				</div>				
				<div class="row">		
						<div class="col-lg-12 hidden_content"  id='eservice'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Eservice</h2>
								</header>
								<div class="main-box-body clearfix">
									<div class="form-group">
										<div class="col-sm-8">
								<div class="form-group">
											<label>Terminal</label>
											<select id="port" name="port" class="form-control" onchange="cekTipeYd()">
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
									<div class="form-group col-xs-12">
										<label for="exampleAutocomplete">No Request<font color="red">*</font></label>
										<input type="text" class="form-control" id="search_eservice" name="search_eservice" placeholder="No Request" class="no_request" title="Masukkan data customer" size="8">
									</div>
									<div class="form-group col-xs-12">
										<label for="exampleAutocomplete">No Container<font color="red">*</font></label>
										<input type="text" class="form-control" id="no_container_eservice" name="no_container_eservice" placeholder="No Container" title="Masukkan data customer" size="8">
									</div>
									<div class="form-group col-xs-12">
										<div class="form-group col-xs-3">
											<label for="exampleAutocomplete">No Container</label>
											<input type="text" class="form-control" id="no_container" name="no_container"  title="Masukkan data customer" size="4" value="<?=$request_data[0]['NO_CONTAINER']?>"readonly>
										</div>										
										<div class="form-group col-xs-3">
											<label for="exampleAutocomplete">PIN Number</label>
											<input type="text" class="form-control" id="pin_number" name="pin_number" placeholder="PIN Number" title="Masukkan data customer" size="4" value="<?=$request_data[0]['PIN_NUMBER']?>" readonly>
										
										</div>
										<div class="form-group col-xs-3">
											<label for="exampleAutocomplete">Truck ID<font color="red">*</font></label>
											<input type="text" class="form-control" id="truck_id" name="truck_id" placeholder="Truck ID" title="Masukkan data customer" size="4">
										</div>
										<div class="form-group col-xs-3">
											<label for="exampleAutocomplete">Truck Number</label>
											<input type="text" class="form-control" id="truck_number" name="truck_number"  title="Masukkan data customer" size="4" readonly>
											<!-- <input type="hidden" class="form-control" id="pin_number" name="pin_number" placeholder="PIN Number" title="Masukkan data customer" size="4" value="<?=$request_data[0]['PIN_NUMBER']?>" readonly> -->
										</div>
									</div>
									<div>
										  <button id="submit_header" class="btn btn-success" onclick="save_tca_association_eservice()">Save</button>
									</div>		
								</div>
								</div>
							</div>
						</div>
				</div>		
				<div class="row">		
						<div class="col-lg-12 hidden_content"  id='non_eservice'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Non Eservice</h2>
								</header>
								<div class="main-box-body clearfix">
									<div class="form-group">
										<div class="col-sm-8">  
										
										<div class="form-group">
												<label>Terminal</label>
												<select id="port_" name="port_" class="form-control" onchange="cekTipeYd()">
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
										<div class ="form-group">
										  <label>Type Service</label>
											<select id="request" name="request" class="form-control" placeholder="" maxlength="100" >
											<option value="">Select</option>
											<option value="receiving">Receiving</option>
											<option value="delivery">Delivery</option>
											<option value="caldg">Batal Muat Delivery</option>
										  </select>
										</div>
										<div class="form-group col-xs-12">
											<label for="exampleAutocomplete">No Request<font color="red">*</font></label>
											<input type="text" class="form-control" id="search_noneservice" name="search_noneservice" placeholder="No Request" class="no_request" title="Masukkan data customer" size="8">
										</div>
										<div class="form-group col-xs-12">
											<label for="exampleAutocomplete">No Container<font color="red">*</font></label>
											<input type="text" class="form-control" id="no_container_noneservice" name="no_container_noneservice" placeholder="No Container" title="Masukkan data customer" size="8">
										</div>
										<div class="form-group col-xs-12">
											<div class="form-group col-xs-4">
												<label for="exampleAutocomplete">No Container</label>
												<input type="text" class="form-control" id="no_container_" name="no_container_"  title="Masukkan data customer" size="8" readonly>
											</div>
											<div class="form-group col-xs-4">
												<label for="exampleAutocomplete">Truck ID<font color="red">*</font></label>
												<input type="text" class="form-control" id="truck_id_" name="truck_id_" placeholder="Truck ID" title="Masukkan data customer" size="8">
											</div>
											<div class="form-group col-xs-4">
												<label for="exampleAutocomplete">Truck Number</label>
												<input type="text" class="form-control" id="truck_number_" name="truck_number_"  title="Masukkan data customer" size="8" readonly>
												<input type="hidden" class="form-control" id="pin_number_" name="pin_number_" placeholder="PIN Number" title="Masukkan data customer" size="8" readonly>
											</div>
										</div>
										<div>
											  <button id="submit_header_" class="btn btn-success" onclick="save_tca_association_noneservice()">Save</button>
										</div>	  
									</div>
									</div>
										
								</div>
							</div>
						</div>
				</div>
				
				<!--<div class="row">		
						<div class="col-lg-12"  id='Container List'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Container Association</h2>
								</header>
								<div class="main-box-body clearfix">
									<div class="form-group">
										<div class="col-sm-12">  
										<div class="form-group col-xs-4">
											<label for="exampleAutocomplete">No Container<font color="red">*</font></label>
											<input type="text" class="form-control" id="no_container" name="no_container" placeholder="No Container" title="Masukkan data customer" size="8" value="<?=$request_data[0]['NO_CONTAINER']?>"readonly>
										</div>
										<div class="form-group col-xs-4">
											<label for="exampleAutocomplete">Truck ID<font color="red">*</font></label>
											<input type="text" class="form-control" id="truck_id_" name="truck_id_" placeholder="Truck ID" title="Masukkan data customer" size="8">
										</div>
										<div class="form-group col-xs-4">
											<label for="exampleAutocomplete">PIN Number<font color="red">*</font></label>
											<input type="text" class="form-control" id="pin_number_" name="pin_number_" placeholder="PIN Number" title="Masukkan data customer" size="8" value="<?=$request_data[0]['PIN_NUMBER']?>" readonly>
										</div>
										<div>
											<button id="btn_create" name="btn_create" class="btn btn-success" onclick="save_tca_association()">Save</button>
										</div>	  
									</div>
									</div>
										
								</div>
							</div>
						</div>
				</div>-->
					
					<!-- <div class="row" id="rowdetail">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Container List</h2>
								</header>

								 
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<form id="detail_truck">
										<table class="table table-striped table-hover" id='list_container_table'>
											<thead>
												<tr>
                                                    <th><input type='checkbox' onClick="toggle(this)"></th>
													<th><span>Container Number</span></a></th>
													<th><span>Truck ID</span></a></th>
													<th><span>PIN Number</span></a></th>
												</tr>
											</thead>
											<tbody id="load_data_from_search">
												
											</tbody>
										</table>
										</form>
									</div>

                                    <button id="btn_create" name="btn_create" class="btn btn-success" onclick="save_tca_association()">Save</button>
								</div>
							</div>
						</div>
					</div> -->
					 <div id="modalplaceholder"></div>
					 
<script>
		
	  
	  function search_eservice(){
		var search_eservice = $("#search_eservice").val();
		var no_container_eservice = $('#no_container_eservice').val();
		  
		if(search_eservice == ''){
			$("#search_eservice").focus();
			alert('Mohon diisi kolomnya');
		}
		else {
			$.get("<?=ROOT?>truck_container/search_eservice?",{term : search_eservice,no_container:no_container_eservice}, 
			function(data){
				
				 // $('#modalplaceholder').html(data).children().modal('show');
				// $("#list_data").append(temp_);
				// alert(data[i].NO_CONTAINER);
				
				// console.log(data.length);
				
				// var rows = [{container: 'a'}, {container: 'b'}];
				var myArray = JSON.parse(data);
				console.log(myArray.length);
				
				var htmlListCont = "";
				for (var i = 0; i < myArray.length; i++) {
					htmlListCont += '<tr>';
					var temp_ = "<td></td>"+
					"<td style='display:none;'> <input type='checkbox' name='deliveryperp_chk' value="+myArray[i].NO_CONTAINER+" checked></td>" +
					'<td> <input type="text" name="no_container" class="no_container" value="'+myArray[i].NO_CONTAINER+'" disabled/></td>'+
					'<td> <input type="text" name="truck_id" id="truck_id'+i+'" class="truck_id" /> </td>'+
					'<td> <input type="text" name="pin_number" class="pin_number" /> </td>';
					htmlListCont += temp_;
					htmlListCont += '</tr>';
				}
				
				$('#load_data_from_search').html(htmlListCont);
				// document.getElementById("load_data_from_search").innerHTML = html;
			});		
		}
	}
	 	
		function load_table()
			{
				$.blockUI();
				var url = "<?=ROOT?>om/truck/search_main_tca";
				var limit = $("#pagelimit").val();
				var search_input = $("#search_input").val();
				$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
											search:search_input,
											page:1,limit:limit},function() {
										  $.unblockUI();
										});
			}
			var table2 = $('#table-request').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
				'columnDefs': [
					{ type: 'date-dd-mmm-yyyy', targets: 2 },
					{ type: 'date-dd-mmm-yyyy', targets: 6 }
				],
				'oTableTools': {
					'aButtons': [
						{
							'sExtends':    'collection',
							'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
							'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
						}
					]
				},
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
							
		</script>