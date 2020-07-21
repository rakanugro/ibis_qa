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
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[?~`!$<>|{}+@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}<>@!|._\[\]/\\]/gi, ''));
		});
		
		//======================================= autocomplete vessel==========================================//
		$( "#vessel_autocomplete" ).autocomplete({
			minLength: 3,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>autocomplete/getVesselList",{  term: $( "#vessel_autocomplete" ).val(), port: $("#port").val()}, response);
				},
			focus: function( event, ui ) 
			{
				$( "#vessel" ).val( ui.item.VESSEL);
				return false;
			},
			select: function( event, ui ) 
			{
				$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
				$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
				$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'>" + item.VESSEL + "<br>" +item.VOYAGE_IN+" - " +item.VOYAGE_OUT+"</a>")
			.appendTo( ul );
		
		};
		
		<?php
			if($_GET['bl_number']!="")
			{
				if ($bl_number=="")
				{
			?>
					var notification = new NotificationFx({
						message : '<p>Data Tidak Ditemukan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'error' // notice, warning, error or success
						
					});

					// show the notification
					notification.show();
			<?php
				}		
			else {?>
					var notification = new NotificationFx({
						message : '<p>Data Ditemukan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
						
					});

					// show the notification
					notification.show();
			<?php }  
			}
		?>
	});

	function check()
	{
		var bl_number = $( "#bl_number" ).val();
		var port = $( "select[name=port]" ).val();
		
		alert(bl_number);
		//alert(port);
		
		if(bl_number=="")
		{
			alert("Nomor Container harus diisi");
			$( "#container_number" ).focus();
			return false;
		}
		
		if(port=="")
		{
			alert("Terminal harus diisi");
			$( "select[name=port]" ).focus();
			return false;
		}		
	}
</script>

<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<!--<h2><?//=get_content($this->user_model,"tracking","choose_vessel")?></h2>-->
											<h2>Search BL</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-inline" role="form">
												<div class="form-group">
													<table>
													<tr>
													<td width="20%"><label>Terminal</label></td>
													<td>
														<select id="port" name="port" class="form-control">
														<option value=""> -- Please Choose Terminal -- </option>
														
														<?php
														$port = isset($_GET["port"])? $_GET["port"]:"";
														$bl_number = isset($_GET["bl_number"])? $_GET["bl_number"]:"";
														
														foreach($terminal as $term)
														{
															if($port==$term["PORT"]."-".$term["TERMINAL"])
																$selected = "selected";
															else 
																$selected = "";
														?>
															<option value="<?=$term["PORT"]?>-<?=$term["TERMINAL"]?>" <?=$selected?> ><?=$term["TERMINAL_NAME"]?></option>
														<?php
														}
														?>
														</select>
													</td>
													</tr>
													<tr>
													</tr>
													<tr>
													<td><label for="exampleTooltip">BL Number</label></td>
													<td><input type="text" class="form-control" id="bl_number" name="bl_number" value="<?=$bl_number?>" data-toggle="tooltip" data-placement="bottom" title="masukkan nomor kontainer">&nbsp;&nbsp;
													</tr>													
													</table>
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">													
												</div><br/>
												<button type="submit" class="btn btn-success" onclick="return check();">Search</button>
											</form>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Cargo Data</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<form role="form">
										<div class="form-group">
											<label for="exampleTooltip">VESSEL</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="nomor kontainer" value="<?php echo $vessel?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">VOYAGE</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Vessel" size="50" value="<?php echo $voyage?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">BL NUMBER</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Ukuran, Tipe, Status" size="10" value="<?php echo $bl_number?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">CARGO NAME</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="ISO Code" size="10" value="<?php echo $cargo_name?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">PACKAGE NAME</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Status Berbahaya" size="10" value="<?php echo $package_name?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">WEIGHT</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Pelabuhan Asal dan Tujuan" value="<?php echo $weight?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">QUANTITY</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $quantity?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">VOLUME</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $quantity?>" readonly>
										</div>
									</form>
								</div>								
							</div>
						</div>	
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2></h2>
								</header>
								
								<div class="main-box-body clearfix">
									<form role="form">
									<div class="form-group">
									<div class="form-group">
											<label for="exampleTooltip">Customer Name</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $cust_name?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Customer Address</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $cust_addr?>" readonly>
										</div>
											<label for="exampleTooltip">HS CODE</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $hs_code?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">EI</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $e_i?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">TL</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $tl?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Weight Realization</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $weight_realization?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Quantity Realization</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $quantity_realization?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Volume Realization</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?php echo $volume_realization?>" readonly>
										</div>
									</form>
								</div>		
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Handling History</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-handling" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Billing History</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-billing" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );
													$this->table->clear();
													//create table
													if(isset($idgroup))
													{
														if($idgroup == 3){
															$this->table->set_heading("No", 
																					  "No Request",
																					  "Vessel",
																					  "Voyage",
																					  "Port",
																					  "Terminal",
																					  "Status",
																					  "View",
																					  "Confirm"
																				 );
														}
													}
													else {
														$this->table->set_heading("No", 
																				  "No Request",
																				  "BL Number",
																				  "Tanggal BL",
																				  "TL",
																				  "OI",
																				  "Status",
																				  "Tipe Pembayaran"
																			 );
													}
													$this->table->set_template($tmpl);
													for($i=0;$i<count($billing);$i++){
														$this->table->add_row(
															$billing[$i]['no'],
															$billing[$i]['id_req'],
															$billing[$i]['bl_number'],
															$billing[$i]['bl_date'],
															$billing[$i]['tl_flag'],
															$billing[$i]['oi'],
															$billing[$i]['status'],
															$billing[$i]['type_payment']
															
														);
													}
													echo $this->table->generate();
												?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
		<script>
			function resetVessel()
			{
				$('#vessel_autocomplete').val("");
				$('#voyage_in').val("");
				$('#voyage_out').val("");
			}
		
			var table2 = $('#table-handling').dataTable({
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
				"lengthMenu": [[-1, 10, 25, 50], ["All", 10, 25, 50]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');

			var table3 = $('#table-billing').dataTable({
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
				"lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
			});
			
			var tt3 = new $.fn.dataTable.TableTools(table3);
			//$( tt3.fnContainer() ).insertBefore('div.dataTables_wrapper');							
		</script>
		
		
	<script>
		$("#container_number").keyup(function(event) {
			var inp = String.fromCharCode(event.keyCode);
			var val = $(this).val();
			if (/[a-zA-Z]/.test(inp)){
				$(this).val(val.toUpperCase());
			} else if (/ /.test(inp)){
				$(this).val( val.replace(' ', '') );
			}
		});
	</script>