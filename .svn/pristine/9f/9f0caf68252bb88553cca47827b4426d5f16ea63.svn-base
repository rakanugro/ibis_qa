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
		function edit_cont (no_container)
	{
		var terminal = $("#terminal").val();
		if (terminal=='IDJKT-T3I'){
		var no_cont = no_container;
		alert ("Reefer "+no_cont);
	   $('#plugoutext'+no_cont).removeAttr('disabled');
		} else 
		{
			alert('Fitur Edit Reefer Hanya Untuk Request Delivery T3 Ocean Going');
			return false;
		}
	}
	
	function update_plugout(no_container){
	var terminal = $("#terminal").val();
	if (terminal=='IDJKT-T3I'){
	var no_request = $("#old_request").val();
	var no_cont = no_container;
	var plugoutext = $('#plugoutext'+no_cont).val();
	var plugin = $('#plugout'+no_cont).val();

	if((plugoutext==null) || (plugoutext==''))
	{
		alert("Container Reefer Harus Mengisi Tanggal Plugout")
		return false;
	}	 
		
	//alert($('#plugout'+no_cont).val());
	
	var url="<?=ROOT?>container/update_plugout_cont";
	$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_CONTAINER:no_container, NO_REQUEST:no_request, TERMINAL:terminal,PLUG_IN:plugin,PLUG_OUT_EXT:plugoutext},
		function(data){	
			var row_data = data;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];
			if (v_msg!='OK')
			{
				alert('Gagal Edit : plugin >= plugout');
				return false;
			}
			else
			{
				//$("#detail_container").load("<?=ROOT?>container/get_detail_delivery/add/"+no_request+"/"+terminal);
				load_list_container();
				alert(v_msg+'.'+no_container+" Reefer Updated");
			}
		});
	} else 
	{
		alert('Fitur Save Reefer Hanya Untuk Request Delivery T3 Ocean Going');
			return false;
	}
}

$(document).ready(function() {
	$("#shipper").hide();
	//sql injection protection
	$(":input").keyup(function(event) {
        // $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
	
	$('#terminal').on('change', function(){
		console.log($(this).val());
        if($(this).val() != ""){
            $("#old_request").removeAttr('readonly');
        } else {
			$("#old_request").prop('readonly', true);
		}

		var terminal = $(this).val().slice(-1);
		console.log(terminal);
		if (terminal == 'I'){
			$('#international_content').removeClass('hidden_content');
		} else {
			$('#international_content').addClass('hidden_content');
		}

		var explode = $(this).val().split('-');
		if(explode[0]=="IDTLB" || explode[0]=="IDDJB"){
			$("#shipper").show();
			$.post("<?=ROOT?>container_receiving/get_shipper",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	                                                                    port: $('#terminal').val()
	                                                                  },function(data){
	          $("#ship_line").html(data);
	      });
		}else{
			$("#shipper").hide();
		}
	});

    $( "#old_request" ).autocomplete({
		minLength: 5,
		source: function(request, response) {
			$.getJSON("<?=ROOT?>container/auto_old_norequest_delivery?",{  term: $( "#old_request" ).val(), port: $("#terminal").val()}, response);
		},
		focus: function( event, ui )
		{
			$( "#old_request" ).val( ui.item.ID_REQ);
			return false;
		},
		select: function( event, ui )
		{
			$( "#old_request" ).val( ui.item.ID_REQ_OL);
            $( "#old_request_billing" ).val( ui.item.ID_REQ);
			$( "#no_do" ).val( ui.item.NO_DO);
			$( "#tgl_do" ).val( ui.item.DATE_DO);
			$( "#no_sppb" ).val( ui.item.NO_SPPB);
			$( "#sppb_date" ).val( ui.item.DATE_SPPB);
			$( "#no_sp_custom" ).val( ui.item.NO_SP_CUSTOM);
			$( "#sp_custom_date" ).val( ui.item.DATE_SP_CUSTOM);
			$( "#no_bl" ).val( ui.item.NO_BL);
			$( "#vessel" ).val( ui.item.VESSEL);
            $( "#call_sign" ).val( ui.item.VESSEL);
			$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
			$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
			$( "#id_vsb_voyage" ).val( ui.item.ID_VSB_VOYAGE);
			$( "#sp2p_number" ).val( ui.item.SP2P_NUMBER);
            $( "#delivery_type" ).val(ui.item.TL_FLAG);
			$( "#date_delivery_old" ).val(ui.item.DATE_DELIVERY);
			//$( "#vessel_code" ).val( ui.item.VESSEL_CODE);
			//$( "#vessel_code" ).val( ui.item.DATE_DELIVERY);
			//$( "#vessel_code" ).val( ui.item.VESSEL_CODE);

            $("#list_container_table tbody td:first").html("<i>Loading...</i>");

            load_list_container(ui.item.ID_REQ);
			return false;
		}
	}).data( "uiAutocomplete" )._renderItem = function( ul, item )
	{
        var id_req_ol = "";
        if (item.ID_REQ_OL != "") {
            id_req_ol = " (" + item.ID_REQ_OL + ")";
        }
		return $( "<li></li>" )
		.data( "item.autocomplete", item )
		.append( "<a align='center'>" + item.ID_REQ + id_req_ol + "<br>" +item.VESSEL+" [" +item.VOYAGE_IN+" - " +item.VOYAGE_OUT+"]</a>")
		.appendTo( ul );

	};

    $('#perpdelivery_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

	$('#tgl_do').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});


		$('#do_upload').change(function() {
		//alert('asdad');
		var namafile15,panjangfile15;
		namafile15=document.getElementById('do_upload').value;
		panjangfile15=namafile15.length;

		if(panjangfile15>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('do_upload').value="";

		}

		var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
		var files = document.getElementById('do_upload').files[0].type;

		if(files != sDoType) {
			alert('Mime type file: '+files+ '.\nFile tidak valid.');
			document.getElementById('do_upload').value="";
			return false;
		}
	});

	//validasi saat sppb upload
	$('#file_sppb').change(function() {

		//alert('asdad');
		var namafile16,panjangfile16;
		namafile16=document.getElementById('file_sppb').value;
		panjangfile16=namafile16.length;

		if(panjangfile16>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('file_sppb').value="";

		}

		var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
		var files = document.getElementById('file_sppb').files[0].type;

		if(files != sDoType) {
			alert('Mime type file: '+files+ '.\nFile tidak valid.');
			document.getElementById('file_sppb').value="";
			return false;
		}
	});

	//validasi saat sp custom upload
	$('#file_sp_custom').change(function() {


		//alert('asdad');
		var namafile17,panjangfile17;
		namafile17=document.getElementById('file_sp_custom').value;
		panjangfile17=namafile17.length;

		if(panjangfile17>255){
			alert('panjang file tidak boleh lebih dari 255');
			document.getElementById('file_sp_custom').value="";

		}
		var sDoType = 'application/pdf'; //mime type application/pdf saja yang diperbolehkan, selainnya muncul pesan kesalahan
		var files = document.getElementById('file_sp_custom').files[0].type;

		if(files != sDoType) {
			alert('Mime type file: '+files+ '.\nFile tidak valid.');
			document.getElementById('file_sp_custom').value="";
			return false;
		}
	});
});

    function submitFileDO(reqNo)
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

	function submitFileSPCustom(reqNo){
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
	
	function toggle(source) {
		checkboxes = document.getElementsByName('deliveryperp_chk');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}

    function load_list_container(){
        var url = "<?=ROOT?>container/list_container_delivery_perp";
		var no_req_old_perp = $("#old_request_billing").val();
		var terminal = $("#terminal").val();
        $.post(url,{
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            ID_REQ:no_req_old_perp,
            PORT: terminal
        },function(data){
            var htmlListCont = "";
            for(var i=0;i<data.length;i++){
                htmlListCont += "<tr>";
                var temp_ = "<td> <input type='checkbox' name='deliveryperp_chk' value="
                    +data[i].NO_CONTAINER+ "></td>" +
					'<td> <a class="btn btn-primary" onclick="delete_container(\''+data[i].NO_CONTAINER+'\')"><i class="fa fa-trash-o"></i></a></td>'+
					'<td> <a class="btn btn-primary" onclick="edit_cont(\''+data[i].NO_CONTAINER+'\')"><i class="fa fa-chain"></i></a></td>'+
					'<td> <a class="btn btn-primary" onclick="update_plugout(\''+data[i].NO_CONTAINER+'\')"><i class="fa fa-save"></i></a></td>'+
                    "<td>" +data[i].NO_CONTAINER+ "</td>" +
                    "<td>" +data[i].SIZE_CONT+ "</td>" +
                    "<td>" +data[i].TYPE_CONT+ "</td>" +
                    "<td>" +data[i].STATUS_CONT+ "</td>" +
                    "<td>" +data[i].HEIGHT_CONT+ "</td>" +
                    "<td>" +data[i].HZ+ "</td>" +
                    "<td>" +data[i].CARRIER+ "</td>"+
					"<td> <input type ='text' class='form-control' value ='"+data[i].PLUG_OUT+"' id='plugout"+data[i].NO_CONTAINER+"' name ='plugout' size ='100' readonly/></td>"+
					"<td> <input type ='text' class='form-control' value ='"+data[i].PLUG_OUT_EXT+"' onclick='$(\"#plugoutext"+data[i].NO_CONTAINER+"\").datetimepicker(); $(\"#plugoutext"+data[i].NO_CONTAINER+"\").datetimepicker(\"show\");'  id='plugoutext"+data[i].NO_CONTAINER+"' name ='plugoutext' size ='100' disabled/></td>"
					;
                htmlListCont += temp_;
                htmlListCont += "</tr>";
            }
            $("#list_container_table tbody").html(htmlListCont);
        }, 'json');
    }

	function delete_container(no_container){
		var terminal = $("#terminal").val();
		var no_request = $("#no_request").val();

		var url="<?=ROOT?>container/del_cont_req_delivery_perp";
		$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_CONTAINER:no_container, NO_REQUEST:no_request, TERMINAL:terminal},
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
					load_list_container();
					alert(v_msg+'.'+no_container+" deleted");
				}
			});
	}
	
    function create_request() {
		
		var tgl_do  = $("#tgl_do").val();
		var no_do   = $("#no_do").val();
		var file_do = $('.myForm1 #do_upload').val();
		var terminal = $('#terminal').val();
		var is_shipping = '<?=$is_shipping;?>';
		
		var perpdelivery_date = $("#perpdelivery_date").val();
		var datedelvold = $("#date_delivery_old").val();
		//date_delivery_old
		var arrtdo = tgl_do.split("-");
		var arrtpp = perpdelivery_date.split("-");
		var arrtdold = datedelvold.split("-");
		var martdo =arrtdo[2]+arrtdo[1]+arrtdo[0];
		var martpp =arrtpp[2]+arrtpp[1]+arrtpp[0];
		var martdold =arrtdold[2]+arrtdold[1]+arrtdold[0];
		var ship_line = $( "#ship_line_data " ).val();
		
        if($("#perpdelivery_date").val() == ''){
            //alert('TANGGAL PERPANJANGAN DELIVERY HARUS DIISI');

			var notification = new NotificationFx({
                    message : '<p>TANGGAL PERPANJANGAN DELIVERY HARUS DIISI</p>',
                    layout : 'growl',
                    effect : 'jelly',
                    type : 'warning' // notice, warning, error or success

                });
                // show the notification
                notification.show();
                $("#perpdelivery_date").focus();
				$(':button').removeAttr('disabled');
        }
		else if(no_do == ''){
			alert('nomor DO kosong');
			return false;			
		}
		else if(file_do == '' && !(is_shipping=='Y' && terminal.slice(-1)!='I') ){
			alert('file DO kosong');
			return false;			
		}
		else if(martpp<=martdold){
			alert('tanggal perpanjangan >= tanggal maximum delivery request sebelumnya');
			return false;
		}
		else if(martpp>martdo){
			alert('tanggal perpanjangan > tanggal valid DO');
			return false;
		}
        else {
            var old_request = $("#old_request").val();
			var delivery_type = $("#delivery_type").val();

            var no_bl   = $("#no_bl").val();

            
            var no_sppb = $("#no_sppb").val();
            var no_sp_custom = $("#no_sp_custom").val();
            var sp2p_number = $("#sp2p_number").val();
            var sppb_date = $("#sppb_date").val();
            var sp_custom_date = $("#sp_custom_date").val();
            
            var deliveryperp_chk = $("input[name=deliveryperp_chk]:checked").map(function(){
                return $(this).val();
            }).get();

            var url = "<?=ROOT?>container/create_delivery_perp";
            $.blockUI();
            $.post(url,{
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                OLD_REQUEST:old_request,
				DELIVERY_TYPE:delivery_type,
                TGL_DELIVERYPERP :perpdelivery_date,
                NO_BL:no_bl,
                NO_DO:no_do,
                TGL_DO:tgl_do,
                NO_SPPB:no_sppb,
                NO_SP_CUSTOM:no_sp_custom,
                SP2P_NUMBER:sp2p_number,
                SPPB_DATE:sppb_date,
                SP_CUSTOM_DATE:sp_custom_date,
                TERMINAL: terminal,
                ship_line:ship_line,
                CONT_CHECKED: deliveryperp_chk
            } ,function(data) {
              $.unblockUI();
				if(data == 'salah') {
					alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
					return false;
				}

				if(data == 'Invalid_date') {
					alert('Tanggal Delivery Request sebelumnya >= Tanggal Ekstensi');
					return false;
				}
				$(':button').attr('disabled');

                var row_data = data;
                var explode = row_data.split(',');
                var v_msg = explode[1];
                var v_req = explode[2];

				submitFileDO(explode[2]);
				submitFileSPPB(explode[2]);
				submitFileSPCustom(explode[2]);

                if (v_msg!='OK')
                {
                    // create the notification
                    var notification = new NotificationFx({
                        message : v_msg+v_req,
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'error' // notice, warning, error or success

                    });
                    // show the notification
                    notification.show();
                }
                else
                {
                    $( "#no_request" ).val(v_req);
                    document.getElementById("terminal").readOnly = true;
                    document.getElementById("vessel").readOnly = true;
                    document.getElementById("voyage_in").readOnly = true;
                    document.getElementById("voyage_out").readOnly = true;
                    document.getElementById("delivery_type").readOnly = true;
                    document.getElementById("no_bl").readOnly = true;
                    document.getElementById("no_do").readOnly = true;
                    document.getElementById("tgl_do").readOnly = true;
                    document.getElementById("do_upload").readOnly = true;
                    document.getElementById("no_sppb").readOnly = true;
                    document.getElementById("file_sppb").readOnly = true;
                    document.getElementById("no_sp_custom").readOnly = true;
                    document.getElementById("file_sp_custom").readOnly = true;
                    //$("#delivery_date").datepicker('disable');
                    //$("#do_date").datepicker('disable');
                    //document.getElementById('btn_create').style.display = "none";
                    // var urldetail = "<?=ROOT?>/container/get_old_detail_delivery";
                    // $("#rowdetail").load(urldetail,{OLD_REQUEST :old_request},function(data){

                    // });

                    //alert('Request Perpanjangan Berhasil');
                    // create the notification
                    // var notification = new NotificationFx({
                        // message : '<p>Nomor Request Perpanjangan Anda </p><br/>'+v_req,
                        // layout : 'growl',
                        // effect : 'jelly',
                        // type : 'success' // notice, warning, error or success

                    // });
                    // // show the notification
                    // notification.show();
                    alert("Nomor Request Perpanjangan Anda: " + v_req);
                    window.location.replace("<?=ROOT?>/container/main_delivery_ext");
                }

            });

            //datepicker
            $('#start_shift').datepicker({
              format: 'dd-mm-yyyy 00:00'
            });
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
									<!--<form role="form">-->

                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete"><b style="font-decoration:italics">Request Number</b> </label>
											<input type="text" class="form-control" id="no_request" Readonly>
										</div>

                                        <div class="form-group">
												<label>Terminal</label>
												<select id="terminal" name="terminal" class="form-control">
												<option value=''> -- Please Choose Terminal -- </option>
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
											<label for="exampleAutocomplete"><b style="font-decoration:italics">Ex Request Number</b> </label>
											<input type="text" class="form-control" id="old_request" data-toggle="tooltip" data-placement="bottom" placeholder="autocomplete" title="Masukkan data no request delivery yang lama" Readonly>
                                            <input type="hidden" id="sp2p_number" name="sp2p_number">
										</div>

                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete"><b style="font-decoration:italics">Ex Request Number (Billing)</b> </label>
											<input type="text" class="form-control" id="old_request_billing" data-toggle="tooltip" data-placement="bottom" title="Berisi no request Ext Delivery versi Billing" Readonly>
                                            <input type="hidden" id="sp2p_number" name="sp2p_number">
										</div>

										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
											<input type="text" class="form-control" id="vessel" Readonly >
											<input type="hidden" class="form-control" id="id_vsb_voyage">
                                            <input type="hidden" class="form-control" id="call_sign">
                                        </div>

                                        <div class="form-group col-xs-6">
                                            <input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" size="8" readonly>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" size="8" readonly>
                                        </div>


										<div class="form-group">
												<label>Delivery Type</label>
												<input type="text" id="delivery_type" class="form-control" readonly />
										</div>

										<div class="form-group">
											<label for="exampleTooltip">BL Number</label>
											<input type="text" id="no_bl" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor BL" maxlength="40" size="10" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Delivery Order Number</label>
											<input type="text" id="no_do" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor Delivery Order" maxlength="20" size="10" readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Valid DO (Delivery Order) Date</label>
											<div class="input-group">
												<input type="text" id="tgl_do" name="tgl_do" class="form-control"/>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Date Delivery (Old Request)</label>
											<div class="input-group">
												<input type="text" id="date_delivery_old" name="date_delivery_old" class="form-control" readonly />
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>

										<div class="form-group col-md-12">
											<label>Extension Delivery Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="perpdelivery_date" name="perpdelivery_date" type="text" class="form-control"> <!--  id="datepickerDate"-->
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group example-twitter-oss">
	                                        <label for="exampleAutocomplete" id="shipper">Shipper</label>
	                                       
											<div id="ship_line"></div>
	                                    </div>
										<div class="form-group">
                                            <form action="POST" class="myForm1" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <label for="exampleTooltip">Upload Delivery Order</label>
                                                <input type="file" accept=".pdf" id="do_upload" name="do_upload" data-toggle="tooltip" data-placement="bottom" title="Upload Delivery Order">
                                                <span class='upload_info'>
                                                    Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                                </span>
                                            </form>
										</div>

									<!--</form>-->
								</div>
							</div>
						</div>
						<div class="col-lg-6 hidden_content"  id='international_content'>
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>International Only</h2>
								</header>

								<div class="main-box-body clearfix">
									<!--<form role="form">-->
										<div class="form-group">
											<label for="exampleTooltip">SPPB Number</label>
											<input type="text" class="form-control" id="no_sppb" data-toggle="tooltip" data-placement="bottom" title="Nomor SPPB" maxlength="40" readonly>
										</div>
                                        <div class="form-group col-md-12">
											<label for="datepickerDate">SPPB Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sppb_date" name="sppb_date" type="text" class="form-control" id="datepickerDate" readonly>
											</div>
											<span class="help-block">format mm-dd-yyyy</span>
										</div>
										<div class="form-group">
                                            <form  action="POST" class="myForm2" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <label for="exampleTooltip">Upload SPPB</label>
                                                <input type="file" id="file_sppb" name="file_sppb" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Upload SPPB" accept=".pdf">
                                                <span class='upload_info'>
                                                    Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                                </span>
                                            </form>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SP Custom Number</label>
											<input type="text" class="form-control" id="no_sp_custom" data-toggle="tooltip" data-placement="bottom" title="Nomor SP Custom" size="10" maxlength="40" readonly>
										</div>
                                        <div class="form-group col-md-12">
											<label for="datepickerDate">SP Custom Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sp_custom_date" name="sp_custom_date" type="text" class="form-control" id="datepickerDate" readonly>
											</div>
											<span class="help-block">format mm-dd-yyyy</span>
										</div>
										<div class="form-group">
                                            <form  action="POST" class="myForm3" enctype="multipart/form-data">
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <label for="exampleTooltip">Upload SP Custom</label>
                                                <input type="file" id="file_sp_custom" name="file_sp_custom" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Upload SP Custom" accept=".pdf">
                                                <span class='upload_info'>
                                                    Accepted File Type: PDF, Max Size: <?php echo $max_size?>
                                                </span>
                                            </form>
										</div>
									<!--</form>-->
								</div>
							</div>
						</div>
					</div>
					<!--<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Data Kontainer</h2>
										</header>

										<div class="main-box-body clearfix">
											<form class="form-inline" role="form">
												<div class="form-group">
													<label for="exampleTooltip">No Kontainer</label>
													<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor Kontainer">
												</div>
												<button type="submit" class="btn btn-success">Simpan</button>
											</form>
										</div>
									</div>
								</div>
							</div>-->
						</div>
					</div>
					<!--<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Upload FIle Excel</h2>
								</header>

								<div class="main-box-body clearfix">
									<form class="form-inline" role="form">
										<div class="form-group">
											<label for="exampleTooltip">Upload</label>
											<input type="file" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload file Excel">
										</div>
										<button type="submit" class="btn btn-success">Upload</button>
										<a href="">Download Template</a>
									</form>
								</div>
							</div>
						</div>
					</div>-->
					<div class="row" id="rowdetail">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Container List</h2>
								</header>

								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover" id='list_container_table'>
											<thead>
												<tr>
                                                    <th><input type='checkbox' onClick="toggle(this)"></th>
													<th>Delete</th>
													<th>Edit</th>
													<th>Save</th>
													<th><span>Container Number</span></a></th>
													<th><span>Size</span></a></th>
													<th><span>Type</span></a></th>
													<th><span>Status</span></a></th>
													<th><span>Height</span></a></th>
													<th><span>Hazard</span></a></th>
													<th><span>Carrier</span></a></th>
													<th><span>Plug IN EXT</span></a></th>
													<th><span>Plug OUT EXT</span></a></th>
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
													<td>
														<a href="#">-</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>

                                    <button id="btn_create" name="btn_create" class="btn btn-success" onclick="create_request()">Save</button>
								</div>

							</div>
						</div>
					</div>


	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
