<script>
$(document).ready(function() {
		//======================================= autocomplete vessel==========================================//
		$( "#vessel_autocomplete" ).autocomplete({
			minLength: 3,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>port_cooperation/autocomplete_vessel",{  term: $( "#vessel_autocomplete" ).val()}, response);
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
				$( "#pol" ).val( ui.item.POL);
				$( "#id_joint_vessel" ).val( ui.item.ID_JOINT_VESSEL);
				$( "#terminal" ).val( ui.item.TERMINAL);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'>" + item.VESSEL + "<br>From : " +item.POL+ "<br>" +item.VOYAGE_IN+" - " +item.VOYAGE_OUT+"</a>")
			.appendTo( ul );
		
		};
		//======================================= autocomplete vessel==========================================//
	});

</script>


			<div id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<div id="content-header" class="clearfix">
									<div class="pull-left">
										<ol class="breadcrumb">
											<li><a href="#">Home</a></li>
											<li><a href="#">Promo Jakarta-Surabaya</a></li>
											<li class="active"><span>Container Status List</span></li>
										</ol>
										
										<h1>Container Status List</h1>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<header class="main-box-header clearfix">
										<h2>Choose Vessel</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<form class="form-inline" role="form">
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Vessel</label>
												<input type="text" class="form-control" id="vessel_autocomplete" name="vessel_name" placeholder="autocomplete" title="Masukkan data kapal">
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" data-toggle="tooltip" data-placement="bottom" title="voyage in" size="5">
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" data-toggle="tooltip" data-placement="bottom" title="voyage out" size="5">
												<input type="hidden" class="form-control" id="pol" name="pol" data-toggle="tooltip" data-placement="bottom" title="voyage out" size="5">
												<input type="hidden" class="form-control" id="id_joint_vessel" name="id_joint_vessel" data-toggle="tooltip" data-placement="bottom" title="voyage out" size="5">
												<input type="hidden" class="form-control" id="terminal" name="terminal" data-toggle="tooltip" data-placement="bottom" title="terminal" size="5">
											</div><br>
											<button type="submit" class="btn btn-success">Search</button>
										</form>
									</div>
								</div>
							</div>	
						</div>
						
						<?php
						if(isset($vesselInfo) && (count($vesselInfo) > 0))
						{
						?>
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<header class="main-box-header clearfix">
										<h2><b><?=$vesselInfo["VESSEL"]?> - <?=$vesselInfo["CALL_SIGN"]?></b></h2>
										
										<span>&nbsp;Voyage IN : <?=$vesselInfo["VOYAGE_IN"]?> </span> &nbsp; &nbsp; <span>  &nbsp;Voyage OUT : <?=$vesselInfo["VOYAGE_OUT"]?> </span> &nbsp; &nbsp; <span>&nbsp;Port of Loading : <?=$vesselInfo["POL"]?> </span>&nbsp; &nbsp; <span >&nbsp;Port of Discharge : <?=$vesselInfo["POD"]?> </span> 
										<br>										
										<span>&nbsp;Total 20 Full : <?=$size20fcl?> </span> &nbsp; &nbsp; <span>  &nbsp;Total 40 Full : <?=$size40fcl?> </span> &nbsp; &nbsp; <span>&nbsp;Total 45 Full : <?=$size45fcl?> </span>
										
									</header>
									
									
								</div>
							</div>	
						</div>
						<?php
						}
						?>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Container Status List</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<div class="table-responsive clearfix">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-status" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<script>
			var table2 = $('#table-status').dataTable({
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
				"lengthMenu": [[-1, 10, 25, 50], ["All",10, 25, 50]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');					
		</script>
		
		