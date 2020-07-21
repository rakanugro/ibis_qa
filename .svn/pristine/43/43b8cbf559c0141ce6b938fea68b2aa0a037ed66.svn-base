
<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Daftar Account Manager</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<div class="row">
											<div class="col-md-12">
												<div class="pull-right">
												<?php
												if(!$is_view_only)
													{
												?>
													<button class="btn btn-primary click_add list_am"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Tambah</button>
												<?php
													}
												?>
												</div>
											</div>
										</div>
										<div class="table-responsive clearfix">
											<?php
												$tmpl = array (
																	'table_open'          => '<table id="table_am" class="table table-hover">',
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

		<script>
			$(function(){
				
				$('.click_add.list_am').click(function(){
					window.location.href="<?=ROOT?>register/am/<?=$billing_id?>";
				});
				
				$('.click_detail.am_detail').click(function(){
					//alert($(this).data('am_id'));
					edit_am($(this).data('am_id'));
				});
				
				$('.click_delete.am_detail').click(function(){
					//alert($(this).data('am_id'));
					delete_am($(this).data('am_id'));
				});				
				
			});
			
			var table2 = $('#table_am').dataTable({
				'info': true,
				'sDom': 'lTfr<"clearfix">tip',
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			//$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');		
			
		</script>
