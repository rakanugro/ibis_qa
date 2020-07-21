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
        
        
        // tgl do
            
        $( "#no_request" ).val('<?=$request_data["ID_REQ"]?>');
        $( "#old_request" ).val('<?=$request_data["OLD_REQ"]?>');
        $( "#no_do" ).val( '<?=$request_data["NO_DO"]?>');
        $( "#no_sppb" ).val( '<?=$request_data["NO_SPPB"]?>');
        $( "#vessel" ).val( '<?=$request_data["VESSEL"]?>');
        $( "#voyage_in" ).val( '<?=$request_data["VOYAGE_IN"]?>');
        $( "#voyage_out" ).val( '<?=$request_data["VOYAGE_OUT"]?>');
        $("#terminal").val('<?=$request_data["PORT_ID"].'-'.$request_data["TERMINAL_ID"]?>');
        
    });

</script>
<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>
<div id="content-wrapper">

    <?php //var_dump($request_data)?>
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Container</a></li>
										<li><a href="<?=ROOT?>/container/main_delivery">Extension Delivery</a></li>
										<li class="active"><span>View Extension Delivery Booking</span></li>
									</ol>
									
									<h1>View Extension Delivery Booking</h1>
								</div>
							</div>
							
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Booking Information</h2>
								</header>
								
									<div class="main-box-body clearfix">
									<!--<form role="form">-->
										<div class="form-group">
												<label>Terminal</label>
												<select id="terminal" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Choose Terminal">
													<option></option>
													<option value="IDJKT-T1D">Tanjung Priok - Terminal 1 Domestik</option>
													<option value="IDJKT-T2D">Tanjung Priok - Terminal 2 Domestik</option>
													<option value="IDJKT-T3D">Tanjung Priok - Terminal 3 Domestik</option>
													<option value="IDJKT-T3I">Tanjung Priok - Terminal 3 Internasional</option>
													<option value="IDJKT-L2">Tanjung Priok - Lini 2</option>
													<option value="IDPNK-TPK">Pontianak - Terminal Petikemas</option>
													<option value="IDJKT-ITOST">Tanjung Priok - ITOS TEST</option>
												</select>
										</div>
                                        
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete"><b style="font-decoration:italics">Request Number</b> </label>
											<input type="text" class="form-control" id="no_request" Readonly >
										</div>
                                        
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete"><b style="font-decoration:italics">Ex Request Number (Billing)</b> </label>
											<input type="text" class="form-control" id="old_request" data-toggle="tooltip" data-placement="bottom" title="Type your old delivery booking number">
                                            <input type="hidden" id="sp2p_number" name="sp2p_number">
										</div>
                                        
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel </label>
											<input type="text" class="form-control" id="vessel" Readonly >
											<input type="hidden" class="form-control" id="id_vsb_voyage">
										</div>
                                        
                                        <div class="form-group col-xs-6">
                                            <input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" size="8" readonly>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" size="8" readonly>
                                        </div>
                                        
										<div class="form-group">
												<label>Delivery Type</label>
												<select id="delivery_type" class="form-control">
													<option></option>
													<option value="N">Yard</option>
													<option value="Y">Truck Loosing</option>
												</select>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Extension Delivery Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="perpdelivery_date" name="perpdelivery_date" type="text" class="form-control" id="datepickerDate">
											</div>
											<span class="help-block">format mm-dd-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">BL Number</label>
											<input type="text" id="no_bl" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor BL" size="10">
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Delivery Order Number</label>
											<input type="text" id="no_do" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor Delivery Order" size="10">
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Delivery Order Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" id="tgl_do" name="tgl_do" class="form-control" id="datepickerDate">
											</div>
											<span class="help-block">format mm-dd-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Upload Delivery Order</label>
											<input type="file" id="file_do" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload Delivery Order" size="10">
										</div>
									<!--</form>-->
								</div>								
							</div>
						</div>	
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>International Information</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<!--<form role="form">-->
										<div class="form-group">
											<label for="exampleTooltip">SPPB Number</label>
											<input type="text" class="form-control" id="no_sppb" data-toggle="tooltip" data-placement="bottom" title="Nomor SPPB">
										</div>
                                        <div class="form-group col-md-12">
											<label for="datepickerDate">SPPB Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sppb_date" name="sppb_date" type="text" class="form-control" id="datepickerDate">
											</div>
											<span class="help-block">format mm-dd-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Upload SPPB</label>
											<input type="file" id="file_sppb" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SPPB">
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SP Custom Number</label>
											<input type="text" class="form-control" id="no_sp_custom" data-toggle="tooltip" data-placement="bottom" title="Nomor SP Custom" size="10">
										</div>
                                        <div class="form-group col-md-12">
											<label for="datepickerDate">SP Custom Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sp_custom_date" name="sp_custom_date" type="text" class="form-control" id="datepickerDate">
											</div>
											<span class="help-block">format mm-dd-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Upload SP Custom</label>
											<input type="file" id="file_sp_custom" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SP Custom" size="10">
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
										<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-delivery" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
									</div>
                                    <button type="submit" onclick="window.open('<?=ROOT.'container/main_delivery_ext'?>','_self')" class="btn btn-success">Back</button>
								</div>
                                
							</div>
						</div>
					</div>

<script>
			var table2 = $('#table-delivery').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
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
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');					
		</script>