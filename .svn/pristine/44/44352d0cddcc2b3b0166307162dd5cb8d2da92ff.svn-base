
<!-- this page specific scripts -->
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/modalEffects.js"></script>
	
<style type="text/css">
.hidden_content {
	display:none;
}
.table th {
	text-align: left;
}
.clock_approval {
    height: 40px;
    display: inline-block;
    padding: 5px;
}
.clock_text {
	font-size: 20pt;
}
.default-font {
	font-family: 'Open Sans', sans-serif;
}
</style>


<div class="col-lg-12">
	<div class="main-box clearfix">
		<header class="main-box-header clearfix">
			<h2 class="pull-left">Container List</h2>
		</header>
		
		<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<?php
							$tmpl = array (
								'table_open'          => '<table id="table-approval" class="table table-hover">',
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

<div id="dialogDoc1" style="display:none">
    <div>
    <iframe id="frameDoc1" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
    </div>
</div> 
<div id="dialogDoc2" style="display:none">
    <div>
    <iframe id="frameDoc2" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
    </div>
</div> 
<div id="dialogDoc3" style="display:none">
    <div>
    <iframe id="frameDoc3" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
    </div>
</div>