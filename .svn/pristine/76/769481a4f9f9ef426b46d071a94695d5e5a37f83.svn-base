								
								<div class="col-lg-12 col-md-8 col-sm-8">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Search</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="tabs-wrapper profile-tabs">
												<div class="tab-content">
													<div class="tab-pane fade in active" id="tab-list_bod">
														<div class="col-lg-12 col-md-5 col-sm-6">
															<div class="form-group">
															<?php 
																$attributes = array('name' => 'customerrank','id'=>'customerrank','role'=>'form');
																echo form_open($action,$attributes);
															?>
																<div class="row">
																	<div class="col-lg-6">
																	From 
																	<?
																		echo form_dropdown('start_month', $opt_start_month, $start_month ,"class='form-control' style='width:300px'");
																	?>
																	</div>
																	<div class="col-lg-6">
																	to 
																	<?
																		echo form_dropdown('end_month', $opt_end_month, $end_month ,"class='form-control' style='width:300px'");
																	?>													
																	</div>
																</div>
																<div class="row">
																	<div class="col-lg-6">
																	Sort By 
																	<?
																		echo form_dropdown('sort_by', $opt_sort_by, $sort_by ,"class='form-control' style='width:300px'");
																	?>													
																	</div>
																	<div class="col-lg-6">
																	Transaction Branch 
																	<?
																		echo form_dropdown('branch', $opt_branch, $branch ,"class='form-control' style='width:300px'");
																	?>													
																	</div>
																</div>
																<div class="row">
																	<div class="col-lg-6">
																	Customer type 
																	<?
																		echo form_dropdown('customer_type', $opt_custtype, $custtype ,"class='form-control' style='width:300px'");
																	?>													
																	</div>
																	<div class="col-lg-6">
																	Service Type 
																	<?php
																		echo form_dropdown('service_type', $opt_service_type, $service_type ,"class='form-control' style='width:300px'",'All');
																	?>													
																	</div>
																</div>
																<div class="row">
																	<div class="col-lg-6">
																	Show Top 
																	<?
																		echo form_dropdown('show_top', $opt_showtop, $showtop ,"class='form-control' style='width:300px'");
																	?>													
																	</div>																
																	<div class="col-lg-6">											
																	</div>
																</div>																
															</div>
															<div class="form-group">
																<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
																<button type="button" id="submitButton" class="btn btn-success">Submit</button>
															</div>														
															<?php echo form_close(); ?>
														</div>
													</div>
												</div>
											</div>
										</div>											
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-12">
										<div class="main-box clearfix">
											<header class="main-box-header clearfix">
											<h4><b></b></h4>
											</header>
											
											<div class="main-box-body clearfix">
												<div class="table-responsive">
													<table class="table table-striped table-hover">
														<?php
																$tmpl = array (
																	'table_open'          => '<table id="table-rank" class="table table-hover">',
																	'heading_row_start'   => '<tr class=\'clickableRow\'>',
																	'heading_row_end'     => '</tr>',
																	'heading_cell_start'   => '',
																	'heading_cell_end'     => ''
															  );

																$this->table->set_template($tmpl);												
																echo $this->table->generate();
															?>
													</table>
												</div>
												<div class="form-group">
													<button type="button" id="downloadButton" class="btn btn-success">Download Excel</button>
												</div>											
											</div>
										</div>	
									</div>	
								</div>
								
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CSS_?>libs/morris.css" type="text/css" />
	
	<!-- this page specific scripts -->
	<script src="<?=JS_?>jquery.knob.js"></script>
	<script src="<?=JS_?>raphael-min.js"></script>
	<script src="<?=JS_?>morris.js"></script>
	
<script>	
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});
</script>

	<script>
		
	//http://stackoverflow.com/a/29033092	
	function hidden_submit(url, params) {
		var f = $("<form id=\"hidden_submit\" target='_blank' method='POST' style='display:none;'></form>").attr({
			action: url
		}).appendTo(document.body);

		for (var i in params) {
			if (params.hasOwnProperty(i)) {
				$('<input type="hidden" />').attr({
					name: params[i].name,
					value: params[i].value
				}).appendTo(f);
				console.log('appending '+i);
			}
			console.log('loop '+i+' end');
		}
		f.submit();
		console.log(f);
		//f.remove();
	}
	
	$(function($) {
		//validation
		$("#submitButton").click(function(){
			$("#customerrank").submit();
		});

		$("#downloadButton").click(function(){
			var tmp = $("#customerrank").serializeArray();
			console.log  (tmp);
			
			var tmp2 = {};
			
			hidden_submit('<?php echo ROOT;?>analytics/customer_rank_excel', tmp);
		});

		
		var table2 = $('#table-rank').dataTable({
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
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		});
	})

	</script>