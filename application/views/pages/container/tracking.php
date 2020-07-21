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
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}<>@!|._\[\]/\\]/gi, ''));
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
			if($_GET['container_number']!="")
			{
				if ($no_container=="")
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
		var container_number = $( "#container_number" ).val();
		var port = $( "select[name=port]" ).val();
		
		//alert(container_number);
		//alert(port);
		
		if(container_number=="")
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
											<h2>Choose Vessel</h2>
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
														$vessel_name = isset($_GET["vessel_name"])? $_GET["vessel_name"]:"";
														$voyage_in = isset($_GET["voyage_in"])? $_GET["voyage_in"]:"";
														$voyage_out = isset($_GET["voyage_out"])? $_GET["voyage_out"]:"";
														$container_number = isset($_GET["container_number"])? $_GET["container_number"]:"";
														
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
													<td><label for="exampleAutocomplete">Vessel <i>*Optional</i></label></td>
													<td>
														<input type="text" class="form-control" id="vessel_autocomplete" name="vessel_name" value="<?=$vessel_name?>" placeholder="autocomplete" title="Masukkan data kapal">
														<input type="text" class="form-control" id="voyage_in" name="voyage_in" value="<?=$voyage_in?>" data-toggle="tooltip" data-placement="bottom" title="voyage in" size="5" readonly>
														<input type="text" class="form-control" id="voyage_out" name="voyage_out" value="<?=$voyage_out?>" data-toggle="tooltip" data-placement="bottom" title="voyage out" size="5" readonly>
														<input type="button" class="btn btn-success" value="reset" onclick="resetVessel();"><i>*Optional</i>
													</td>
													</tr>
													<tr>
													<td><label for="exampleTooltip">Container Number</label></td>
													<td><input type="text" class="form-control" id="container_number" name="container_number" value="<?=$container_number?>" data-toggle="tooltip" data-placement="bottom" title="masukkan nomor kontainer">&nbsp;&nbsp;
													<? if($maxpoint>0)
													{ ?>
													<select id="container_point" name="container_point" class="form-control">
														<?php
														for($j=1;$j<=$maxpoint;$j++)
														{
															if($j==$point)
																$selected = "selected";
															else 
																$selected = "";
														?>
															<option value="<?=$j?>" <?=$selected?> ><?=$j?></option>
														<?php
														}
														?>
													</select><? } ?></td>
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
									<h2>Container Data</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<form role="form">
										<div class="form-group">
											<label for="exampleTooltip">Container Number</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="nomor kontainer" value="<?php echo $no_container?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Vessel / Voyage In / Voyage Out</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Vessel" size="50" value="<?php echo $vessel." / ".$voyagein." / ".$voyageout?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Size / Type / Full Status</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Ukuran, Tipe, Status" size="10" value="<?php echo $size." / ".$type." / ".$status?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Bayplan Position</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Bayplan Position" size="10" value="<?php echo $bayplan_position?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">ISO Code</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="ISO Code" size="10" value="<?php echo $iso_code?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">No Seal</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Seal Id" size="10" value="<?php echo $seal_id?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Hazard / UN Number / IMO Class</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Status Berbahaya" size="10" value="<?php echo $hazard.' / '.$un_number.' / '.$imo_class?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Port of Loading / Port of Discharge/ Final Port of Discharge</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Pelabuhan Asal dan Tujuan" size="10" value="<?=$pol.' / '.$pod.'/'.$fpod?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Id Booking / No Booking (Lini2)</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Booking Lini2" size="10" value="<?=$point.' / '.$nobooking?>" readonly>
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
											<label for="exampleTooltip">Last Status</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Status Terakhir" value="<?php echo $activity?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Container Location</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Lokasi Container" size="10" value="<?php echo $cont_location?>" readonly>
										</div>
																				<div class="form-group">
											<label for="exampleTooltip">Damage Code</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="damage code" size="10" value="<?php echo $damage_code?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Weight</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Berat" size="10" value="<?php echo $weight?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Temperature</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Temperatur" size="10" value="<?php echo $reefer_temp?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Hold Status</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Status Segel Merah" size="10" value="<?php echo $hold_status?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Paid Thru</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Masa Berlaku" size="10" value="<?php echo $paidthru?>" readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Tractor No.</label>
											<input type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Plat Nomor" size="10" value="<?php echo $nopol?>" readonly>
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
																				  "No Request Billing",
																				  "Type",
																				  "Proforma Number",
																				  "Status",
																				  "Request Date",
																				  "Payment Date",
																				  "Paid Thru",
																				  "Customer"
																			 );
													}
													$this->table->set_template($tmpl);
													for($i=0;$i<count($billing);$i++){
														$this->table->add_row(
															$billing[$i]['no'],
															$billing[$i]['no_request_ol'],
															$billing[$i]['no_request'],
															$billing[$i]['request_type'],
															$billing[$i]['no_proforma'],
															$billing[$i]['status'],
															$billing[$i]['date_request'],
															$billing[$i]['date_payment'],
															$billing[$i]['paid_thru'],
															$billing[$i]['customer']
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