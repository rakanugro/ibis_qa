
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
			<h2 class="pull-left">Request List</h2>

			<div class="filter-block pull-right">
				<div class="form-group pull-right">
					 <select id="pagelimit" name="pagelimit" onchange="searchRequest()" class="form-control">
					  <option value="1" <?php if($limit==10) echo "selected"?> >1</option>
					  <option value="10" <?php if($limit==10) echo "selected"?> >10</option>
					  <option value="20" <?php if($limit==20) echo "selected"?>>20</option>
					  <option value="30" <?php if($limit==30) echo "selected"?>>30</option>
					  <option value="40" <?php if($limit==40) echo "selected"?>>40</option>
					  <option value="50" <?php if($limit==50) echo "selected"?>>50</option>
					  <option value="100" <?php if($limit==100) echo "selected"?>>100</option>
					</select>
				</div>
				<div class="form-group pull-left">
					<input type="text" id="search" name="search" value="<?php echo $search?>" class="form-control" placeholder="Search...">
					<a onclick="searchRequest()"><i class="fa fa-search search-icon"></i></a>
				</div>
			</div>
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
				<div class="form-group">
					<?php echo "<b>Total $totallist Daftar, $totalpage Halaman</b>"?>
					<ul class="pagination pull-right">
						<li><a onclick="searchRequest('<?php if($page-1>0) echo ($page-1); else echo 1;?>');"><i class="fa fa-chevron-left"></i></a></li>
						<?php for($i=1;$i<=$totalpage;$i++) {?>
							<li><a onclick="searchRequest('<?php echo $i?>');"><?php echo $i?></a></li>
						<?php }?>
						<li><a onclick="searchRequest('<?php if($page+1>$totalpage) echo $page; else echo ($page+1);?>');"><i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</div>
		</div>
	</div>
</div>
