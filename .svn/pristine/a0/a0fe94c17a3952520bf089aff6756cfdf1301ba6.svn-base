<script src="<?=CUBE_?>js/bootstrap.js"></script>
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
<script>
$( document ).ready(function() {
	var url = "<?=ROOT?>container_alihkapal/getListContainer/<?=$request_data[0]['ID_REQ_IBIS']?>/<?=$request_data[0]['ID_PORT']?>/<?=$request_data[0]['ID_TERMINAL']?>/<?=$request_data[0]['TIPE']?>";
	$("#detailreq").load(url);
});
</script>


<script src="<?=CUBE_?>js/bootstrap.js"></script>
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

<script>
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
		alert('data');
        $.post( "<?=ROOT?>container_alihkapal/addcontainerBM", {request_no:request_no, container_no:container_autocomplete,
                                                         container_size:container_size, container_type:container_type, container_status:container_status,
                                                         port:port,ukk_old:ukk_old,ukk_new:ukk_new,etd:etd,hz:hz,isocode:isocode,container_height:container_height})
														 
            .done(function( data ) {
				if(data == "OK")
                {
					alert('tes');
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
                    $("#detailreq").load(url,{},function(data){ });
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
    

</script>

<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Container</a></li>
										<li><a href="<?=ROOT?>/container_receiving/main_receiving">View Request</a></li>
										<li class="active"><span>View Request</span></li>
									</ol>
									
									<h1>View Loading Cancel Request</h1>
								</div>
							</div>
							
							<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<header class="main-box-header clearfix">
										<h2>Booking Data</h2>
									</header>
								
									<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Request Number </label>
											<input type="text" class="form-control" id="request_no" name="request_no" value="<?=$request_data[0]['ID_REQ_IBIS']?>" readonly>
										</div>									
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" readonly>
												<option value="<?=$request_data[0]["ID_PORT"]?>-<?=$request_data[0]["ID_TERMINAL"]?>" selected><?=$request_data[0]["TERMINAL_NAME"]?></option>
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
													<option value="<?=$request_data[0]["TIPEBM"]?>" selected><?=get_content($this->user_model,'alihkapal',$request_data[0]["TIPEBM"])?></option>
													<option value="CALBG">Loading Cancel Before Gatein</option>
													<option value="CALAG">Loading Cancel After Gatein</option>
													<option value="CALDG">Loading Cancel Delivery</option>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel </label>
											<input type="text" class="form-control" id="vessel_autocomplete" name="vessel_autocomplete" placeholder="autocomplete" value="<?=$request_data[0]['VESSEL']?>">
											<input type="text" id="voyage_in" name="voyage_in" placeholder="Voyage In" value="<?=$request_data[0]['VOYIN']?>">
											<input type="text" id="voyage_out" name="voyage_out" placeholder="Voyage Out" value="<?=$request_data[0]['VOYOUT']?>">
											<input type="hidden" class="form-control" id="ukk" name="ukk" value="<?=$request_data[0]['UKK']?>" placeholder="autocomplete" readonly>
										</div>
										
                                        <div class="form-group example-twitter-oss">
                                        <label for="exampleAutocomplete">ETA </label>
                                        <input type="text" class="form-control" id="eta" name="eta" placeholder="autocomplete" value="<?=$request_data[0]['ETA']?>" readonly>
                                        </div>
                                        <div class="form-group example-twitter-oss">
                                            <label for="exampleAutocomplete">ETD </label>
                                            <input type="text" class="form-control" id="etd" name="etd" placeholder="autocomplete" value="<?=$request_data[0]['ETD']?>" readonly>
                                        </div>
                                        <div class="form-group example-twitter-oss">
                                            <label for="exampleAutocomplete">Shipping Line </label>
                                            <input type="text" class="form-control" id="shipping_line" name="shipping_line"  value="<?=$request_data[0]['SHIPPING']?>" placeholder="autocomplete" readonly>
                                        </div>
									</div>								
								</div>
							</div>	
							<div class="col-lg-6">
								<div class="main-box">
									<header class="main-box-header clearfix">
									
									</header>
								
									<div class="main-box-body clearfix">
										<!--
										<div class="form-group">
												<label><?//=get_content($this->user_model,"alihkapal","trading_type");?></label>
												<select id="trading_type" name="trading_type" class="form-control" readonly>
													<option value="I">Domestik</option>
													<option value="O">Internasional</option>
												</select>
										</div>-->
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Final Port (FPOD)</label>
											<input type="text" class="form-control" id="fpod_autocomplete" name="fpod_autocomplete" placeholder="autocomplete" value="<?=$request_data[0]['FPOD']?>">
											<input type="hidden" id="idfpod" name="idfpod" value="<?=$request_data[0]['IDFPOD']?>"/>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Booking Number</label>
											<input type="text" class="form-control" id="booking_numb" name="booking_numb" value="<?=$request_data[0]['BOOKINGNUMB']?>">
										</div>
										<div class="form-group example-twitter-oss">
													<label>Delivery Date</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
														<input class="form-control" id="tgl_delivery" name='tgl_delivery' type="text"  value="<?=$request_data[0]['TGL_DEL']?>">
													</div>
										</div>
										<div class="form-group">
												<label for="exampleTooltip">No SPP</label>
												<input type="text" class="form-control" id="nospp" name="nospp" data-toggle="tooltip"  value="<?=$request_data[0]['NO_SPP']?> "data-placement="bottom" title="Nomor SPP" size="10">
										</div>
										<div class="form-group">
												<label for="exampleTooltip">No Surat Jalan</label>
												<input type="text" class="form-control" id="nosuratjalan" name="nosuratjalan"  value="<?=$request_data[0]['NO_SURATJALAN']?>" data-toggle="tooltip" data-placement="bottom" title="Nomor Surat Jalan" size="10">
										</div>
									<!--	<input type="button" value="Simpan" onclick="submitheader()" id="submit_header" name="submit_header" class="btn btn-success"/>-->
								</div>		
							</div>
						</div>	
						<div class="row" id="container_data" name="container_data">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Data Kontainer</h2>
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
							
					</div>
						</div>
					</div>
    <div id="detailreq"></div>
</div>

	<script>
	$(function() {
		$('#tgl_delivery').datepicker({
			format: 'dd-mm-yyyy'
		});
    
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
        .append( "<a align='center'><p class='repo-language'>" + item.VESSEL + "</p><p class='repo-name'>" +item.VOYAGE_IN+"-"+item.VOYAGE_OUT+"</p></a>")
        .appendTo( ul );

        };
        
        $( "#container_autocomplete" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>container_alihkapal/autoContainer?",{  term: $( "#container_autocomplete" ).val(), 
                                                                          port: $('#port').val(),
																		  tipebm: $('#tipebm').val(),
																		   vessel: $('#vessel_autocomplete').val(),
																		  voyin: $('#voyage_in').val()
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
        
        
       
    });
        
      
	</script>
