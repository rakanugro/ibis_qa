					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">TCA LIST</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<?php
											$tmpl = array (
																'table_open'          => '<table id="table-detail" class="table table-striped table-hover">'
														  );

											$this->table->set_template($tmpl);												
											echo $this->table->generate();
										?>
									</div>
									<?if($type=="add" || $type=="edit"){?>
										<!--<button onclick="save_req()" class="btn btn-success" name="button_add_detail" id="button_add_detail"><?=get_content($this->user_model,"delivery","save");?></button>-->
										<button type="submit" onclick="window.open('<?=ROOT.'om/truck/main_tca'?>','_self')" class="btn btn-success">Next</button>
									<? } else {?>
										<button type="submit" onclick="window.open('<?=ROOT.'om/truck/main_tca'?>','_self')" class="btn btn-success">Back</button>
									<?}?>
								</div>
							</div>
						</div>
					</div>
					
					<script>
					var table2 = $('#table-detail').dataTable({
						'info': false,
						'sDom': 'lTfr<"clearfix">tip',
						'oTableTools': {
							'aButtons': [
							]
						},
						"lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
					});
					</script>
					