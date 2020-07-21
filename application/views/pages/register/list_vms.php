<?php
	if(!isset($opt_bank)){$opt_bank = rsArrToOptArr(	load_options('BANK','ID')->result('array')	);}
	if(!isset($box_currency)){$box_currency = load_options('CURRENCY','ID')->result('array');}
	if(!isset($box_autocollection)){$box_autocollection = load_options('AUTOCOLLECTION','ID')->result('array');}
	
?>

<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Daftar User VMS</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<div class="row">
											<div class="col-md-12">
												<div class="pull-right">
												
													<button type="button" class="btn btn-primary click_add list_bank"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Tambah</button>
												</div>
											</div>
										</div>
										<div class="table-responsive clearfix">
											<?php
												$tmpl = array (
																	'table_open'          => '<table id="table_bank" class="table table-hover">',
																	'heading_row_start'   => '<tr class=\'clickableRow\'>'
															  );

												$this->table->set_template($tmpl);												
												echo $this->table->generate();
											?>
										</div>
									</div>
								</div>

		<script>
			$(function(){
				
				$('.click_add.list_bank').click(function(){
					showModal_bank();
				});

				$('.click_detail.bank_detail').click(function(){
					//alert($(this).data('bank_account_id'));
					edit_bank($(this).data('bank_account_id'));
				});
				
				$('.click_delete.bank_detail').click(function(){
					//alert($(this).data('bank_account_id'));
					delete_bank($(this).data('bank_account_id'));
				});
			});
			
			var table2 = $('#table_bank').dataTable({
				'info': true,
				'sDom': 'lTfr<"clearfix">tip',
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
						
			var tt2 = new $.fn.dataTable.TableTools(table2);
			//$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');		

		</script>