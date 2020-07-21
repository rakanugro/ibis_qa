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
    $(function(){
      $( "#vessel" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>port_cooperation/autoVesselList?",{  term: $( "#vessel" ).val()}, response);
            },
        focus: function( event, ui ) 
        {
            $( "#vessel" ).val( ui.item.VESSEL);
            return false;
        },
        select: function( event, ui ) 
        {
            $( "#vessel" ).val( ui.item.VESSEL);
            $( "#voyage_in" ).val( ui.item.VOYAGE_IN);
            $( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
            $( "#terminal" ).val( ui.item.TERMINAL);
            $( "#id_pol" ).val( ui.item.POL);
            $( "#call_sign" ).val( ui.item.CALL_SIGN);
            $( "#id_joint_vessel" ).val( ui.item.ID_JOINT_VESSEL);
            
            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'><p class='repo-language'>" + item.VESSEL + "</p><p class='repo-name'>" +item.VOYAGE_IN+"-"+item.VOYAGE_OUT+"</p></a>")
        .appendTo( ul );

        };
        
    });
    
    function create_request(){
        if($("#vessel").val() == ''){
            //alert('TANGGAL PERPANJANGAN DELIVERY HARUS DIISI');
                
			var notification = new NotificationFx({
                    message : '<p>Kapal Harus Diisi</p>',
                    layout : 'growl',
                    effect : 'jelly',
                    type : 'warning' // notice, warning, error or success

                });
                // show the notification
                notification.show();
                $("#vessel").focus();
        }
        else {
            var vessel      = $("#vessel").val();
            var voyage_in   = $("#voyage_in").val();
            var voyage_out  = $("#voyage_out").val();
            var terminal    = $("#terminal").val();
            var call_sign   = $("#call_sign").val();
            var id_vesvoy   = $("#id_vesvoy").val();
            var request_no  = $("#no_request").val();
            var id_joint_vessel  = $("#id_joint_vessel").val();
            var id_pol        = $("#id_pol").val();
            
            var url = "<?=ROOT?>port_cooperation/create_header_restitusi";
            $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',VESSEL:vessel,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out,TERMINAL:terminal,CALL_SIGN:call_sign,
                        REQUEST_NO:request_no,ID_JOINT:id_joint_vessel},function(data){
                alert(data);
                var row_data = data;
                var explode = row_data.split(',');
                var v_msg = explode[0];
                var v_req = explode[1];
                if (v_msg!='OK')
			{
                // create the notification
                var notification = new NotificationFx({
                    message : '<p>Restitution Booking Failed</p><br/>'+v_req,
                    layout : 'growl',
                    effect : 'jelly',
                    type : 'error' // notice, warning, error or success

                });
                // show the notification
                notification.show();
				return false;
			}
			else
			{
				$( "#no_request" ).val(v_req);
				$("#delivery_date").datepicker('disable');
				$("#do_date").datepicker('disable');
                var req_no = v_req;
				document.getElementById('btn_create').style.display = "none";
                var urldetail = "<?=ROOT?>port_cooperation/get_list_restcontainer";
                $("#rowdetail").load(urldetail,{VESSEL:vessel,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out,TERMINAL:terminal,CALL_SIGN:call_sign,
                        ID_VESVOY:id_vesvoy,REQUEST_NO:req_no,ID_JOINT:id_joint_vessel,ID_POL:id_pol},function(data){
                    
                });
                
				alert('Restitution Booking Success');
                // create the notification
                var notification = new NotificationFx({
                    message : '<p>Nomer Request Perpanjangan Anda </p><br/>'+v_msg,
                    layout : 'growl',
                    effect : 'jelly',
                    type : 'success' // notice, warning, error or success

                });
                // show the notification
                notification.show();
			}
            });
        }
    }
</script>
<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Kontainer</a></li>
										<li><a href="<?=ROOT?>container/main_delivery">Permintaan Restitusi</a></li>
										<li class="active"><span>Tambah Permintaan</span></li>
									</ol>
									
									<h1>Tambah Permintaan Restitusi</h1>
								</div>
							</div>
							
					<div class="row">
						<div class="col-lg-10">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Data Permintaan</h2>
								</header>
								
									<div class="main-box-body clearfix">
									<!--<form role="form">-->                                        
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete"><b style="font-decoration:italics">No Request Restitusi</b> </label>
											<input type="text" class="form-control" id="no_request" Readonly>
										</div>
                                        
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Kapal </label>
											<input type="text" class="form-control" id="vessel"  title="Masukkan data kapal">
											<input type="hidden" class="form-control" id="id_vsb_voyage" placeholder="autocomplete" >
											<input type="hidden" class="form-control" id="call_sign" placeholder="autocomplete" >
											<input type="hidden" class="form-control" id="id_joint_vessel" placeholder="autocomplete" >
                                            <input type="text" id="voyage_in" placeholder="voyage in"  size="8" Readonly> 
                                            <input type="text" id="voyage_out" placeholder="voyage_out"  size="8" Readonly>
										</div>
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Terminal </label>
											<input type="text" class="form-control" id="terminal" Readonly>
										</div>
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">POD </label>
											<input type="text" class="form-control" id="id_pod" Readonly>
										</div>
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">POL </label>
											<input type="text" class="form-control" id="id_pol" Readonly>
										</div>
										
										<button id="btn_create" name="btn_create" class="btn btn-success" onclick="create_request()">Simpan</button>
									<!--</form>-->
								</div>								
							</div>
						</div>	
						
					</div>
					
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
									<h2 class="pull-left">Daftar Kontainer</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><span>No Kontainer</span></a></th>
													<th><span>Ukuran</span></a></th>
													<th><span>Tipe</span></a></th>
													<th><span>Status</span></a></th>
													<th><span>Tinggi</span></a></th>
													<th><span>Berbahaya</span></a></th>
													<th><span>Carrier</span></a></th>
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
								</div>
							</div>
						</div>
					</div>