
<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
</style>
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Daftar PBM</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<div class="row">
											<div class="col-md-12">
												<div class="pull-right">
													<?php
													if(!$is_view_only)
													{
													?>
													<button class="btn btn-primary click_add list_pbm"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Tambah</button>
													<?
													}
													?>													
												</div>
											</div>
										</div>
										<div class="table-responsive clearfix">
											<?php
												$tmpl = array (
																	'table_open'          => '<table id="table_pbm" class="table table-hover">',
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
			// jquery extend function
			// http://stackoverflow.com/questions/8389646/send-post-data-on-redirect-with-javascript-jquery/23347763#23347763
			function redirectPost(location, args){
				var form = '';
				$.each( args, function( key, value ) {
					//value = value.split('"').join('\"')
					form += '<input type="hidden" name="'+key+'" value="'+value+'">';
				});
				$('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
			}
			
			$('.click_add.list_pbm').click(function(){
				var url = "<?php echo ROOT;?>register/pbm/"+'<?php echo $customer_id?>';
				redirectPost(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',test:'12345a'});
			});
			
			$('.click_detail.pbm_detail').click(function(){
				var id = $(this).data("pbm_id");
				var url = "<?php echo ROOT;?>register/pbm_edit/"+id;
				redirectPost(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',test:'12345a'});
			});
			
			$('.click_delete.pbm_detail').click(function(){
				if (confirm('Anda yakin akan menghapus data ini?')){
					var id = $(this).data("pbm_id");
					var url = "<?php echo ROOT;?>register/pbm_delete/"+id;
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',test:'12345a'})
					.done(function(){
						window.location.reload();
					})
				}
			});
	
			var table2 = $('#table_shipping_agent').dataTable({
				'info': true,
				'sDom': 'lTfr<"clearfix">tip',
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			
		</script>
