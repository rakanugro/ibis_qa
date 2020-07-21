<div class="table-responsive clearfix">
	<?php
			$tmpl = array (
								'table_open'          => '<table id="table-vessel-schedule" class="table table-hover">',
								'heading_row_start'   => '<tr class=\'clickableRow\'>'
						  );

			$this->table->set_template($tmpl);												
			echo $this->table->generate();
		?>
</div>

<script>
var table3 = $('#table-vessel-schedule').dataTable({
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
			
			var tt3 = new $.fn.dataTable.TableTools(table3);
			//$( tt3.fnContainer() ).insertBefore('div.dataTables_wrapper');	
</script>