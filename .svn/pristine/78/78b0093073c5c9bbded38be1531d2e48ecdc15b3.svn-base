
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Receiving Booking List</h2>

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
														'table_open'          => '<table id="table-request" class="table table-hover">',
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
								</div>
							</div>
						</div>
            <script>
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
