
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
            
            
            $( "#request_no" ).val('<?=$request_data["ID_REQ"]?>');
            $("#port").val('<?=$request_data["ID_PORT"].'-'.$request_data["ID_TERMINAL"]?>');
			$( "#vessel_autocomplete" ).val( '<?=$request_data["VESSEL"]?>');
			$( "#voyage_in" ).val( '<?=$request_data["VOYAGE_IN"]?>');
			$( "#voyage_out" ).val( '<?=$request_data["VOYAGE_OUT"]?>');
			$( "#ukk" ).val( '<?=$request_data["ID_VES_VOYAGE"]?>');
			$( "#trading_type" ).val( '<?=$request_data["OI"]?>');
			$( "#pod_autocomplete" ).val( '<?=$request_data["POD"]?>');
			$( "#fpod_autocomplete" ).val( '<?=$request_data["FPOD"]?>');
			$( "#peb_no" ).val( '<?=$request_data["PEB"]?>');
			$( "#npe_no" ).val( '<?=$request_data["NPE"]?>');
            $("#booking_ship_no").val('<?=$request_data["BOOKING_NUMB"]?>');
			$("#receiving_type").val('<?=$request_data['TL_FLAG']?>');
        
            var url = "<?=ROOT?>container_receiving/view_detail_receiving";
            $("#rowdetail").load(url,{norequest:'<?=$request_data["ID_REQ"]?>'});
        
    });
    
    
    
    function delete_cont($nocont,$noreq) {
        var url = "<?=ROOT?>/container_receiving/delete_container";
        var port = '<?=$request_data["ID_PORT"]?>';
        var terminal = '<?=$request_data["ID_TERMINAL"]?>';
        $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',NO_CONT:$nocont,NO_REQ:$noreq,PORT:port,TERMINAL:terminal},function(data){
            $("#rowdetail").load(url,{norequest:$noreq});
        });
           
    }

                    
    
</script>

<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>

<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Container</a></li>
										<li><a href="<?=ROOT?>/container_receiving/main_receiving">Receiving Booking</a></li>
										<li class="active"><span>View Receiving Booking</span></li>
									</ol>
									
									<h1>View Receiving Booking</h1>
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
											<label for="exampleAutocomplete">Request Number</label>
											<input type="text" class="form-control" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
										</div>									
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" disabled>
													<option></option>
													<option value="IDJKT-T1D">Tanjung Priok - Terminal 1 Domestik</option>
													<option value="IDJKT-T2D">Tanjung Priok - Terminal 2 Domestik</option>
													<option value="IDJKT-T3D">Tanjung Priok - Terminal 3 Domestik</option>
													<option value="IDJKT-T3I">Tanjung Priok - Terminal 3 Internasional</option>
													<option value="IDJKT-VAS">Tanjung Priok - Lini 2</option>
													<option value="IDPNK-TPK">Pontianak - Terminal Petikemas</option>
                                                    <option value="IDJKT-ITOST">Tanjung Priok - ITOS TEST</option>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
											<input type="text" class="form-control" id="vessel_autocomplete" name="vessel_autocomplete" placeholder="autocomplete" title="Masukkan data kapal" readonly>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Voyage</label>
											<input type="text" class="form-control" id="voyage_in" name="voyage_in" readonly>
											-
											<input type="text" class="form-control" id="voyage_out" name="voyage_out"  readonly>
										</div>										
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">ID VVD </label>
											<input type="text" class="form-control" id="ukk" name="ukk"  readonly>
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
											<label for="exampleAutocomplete">Port of Discharge</label>
											<input type="text" class="form-control" id="pod_autocomplete" name="pod_autocomplete" readonly>
                                            <input type="hidden" id="idpod" name="idpod" readonly/>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Final Port of Discharge (FPOD)</label>
											<input type="text" class="form-control" id="fpod_autocomplete" name="fpod_autocomplete" readonly>
                                            <input type="hidden" id="idfpod" name="idfpod" readonly/>
										</div>
										<div class="form-group">
												<label>Receiving Type</label>
												<select id="receiving_type" name="receiving_type" class="form-control" disabled>
													<option></option>
													<option value="N">Yard</option>
													<option value="Y">Truck Loosing</option>
												</select>
										</div>
								</div>								
							</div>
						</div>	
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>*International Only</h2>
								</header>
								
								<div class="main-box-body clearfix">
									
										<div class="form-group">
											<label for="exampleTooltip">PEB Number</label>
											<input type="text" class="form-control" id="peb_no" name="peb_no" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Upload PEB</label>
											<input type="text" class="form-control" id="peb_upload" name="peb_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor PEB" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">NPE Number</label>
											<input type="text" class="form-control" id="npe_no" name="npe_no" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Upload NPE</label>
											<input type="text" class="form-control" id="npe_upload" name="npe_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor NPE" size="10" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Booking Ship Number</label>
											<input type="text" class="form-control" id="booking_ship_no" name="booking_ship_no" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Upload Booking Ship</label>
											<input type="text" class="form-control" id="booking_ship_upload" name="booking_ship_upload" data-toggle="tooltip" data-placement="bottom" title="Nomor Booking Ship" size="10" readonly>
										</div>
									
								</div>		
							</div>
						</div>	
					</div>
					
					<div class="row" id="rowdetail">
				
					</div>

					
				

	