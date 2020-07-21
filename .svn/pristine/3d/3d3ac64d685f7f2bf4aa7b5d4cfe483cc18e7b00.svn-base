							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Customer List</h2>
										</header>
										
										<div class="main-box-body clearfix"> 
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-customer" class="table table-hover">',
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
					
					<script>		
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		$(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
	});
});
					
						//tables-advanced.html
						var table = $('#table-customer').dataTable({
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
						
						var tt = new $.fn.dataTable.TableTools(table);
						$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
					</script>