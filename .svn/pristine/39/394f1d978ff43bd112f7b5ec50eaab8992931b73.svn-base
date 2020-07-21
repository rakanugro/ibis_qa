		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">Daftar Tiket</h2>
					
					<div id="reportrange" class="pull-right daterange-filter">
						<i class="icon-calendar"></i>
						<span></span> <b class="caret"></b>
					</div>
				</header>
				
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<?php
								$tmpl = array (
													'table_open'          => '<table id="table-ticket" class="table table-hover">',
													'heading_row_start'   => '<tr class=\'clickableRow\'>'
											  );

								$this->table->set_template($tmpl);												
								echo $this->table->generate();
						?>
					</div>
				</div>
			</div>
		</div>
		
		<script>		
		$(document).ready(function() {
			var table2 = $('#table-ticket').dataTable({
				'info': false,
				"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
			});
		});				
		</script>