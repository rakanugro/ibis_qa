<div id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<div id="content-header" class="clearfix">
									<div class="pull-left">
										<ol class="breadcrumb">
											<li><a href="#">Home</a></li>
											<li><a href="#">Promo Jakarta-Surabaya</a></li>
											<li class="active"><span>Upload Vessel Schedule</span></li>
										</ol>
										
										<h1>Upload Vessel Schedule</h1>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<header class="main-box-header clearfix">
										<h2>Upload Vessel Schedule</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<form onsubmit="return cek_upload()" class="form-inline" role="form" enctype="multipart/form-data" role="form" action="<?=ROOT?>uploadsby/upload_vvd" method="post">
											<div class="form-group example-twitter-oss">
													<label>File Excel : </label>
														<div class="form-group">
															<div class="col-xs-12">
																<label class="ace-file-input">
																	<input type="file" id="attachment" name="attachment" size="20">
																</label>
																<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
															</div>
														</div>
												</div><br>
												<button type="submit" class="btn btn-success">Upload</button>
										</form>
										<br />
										Download Template Excel : <a href="downloadvvd" target="_blank">Template Upload VVD</a>
										<br />
									</div>
								</div>
							</div>	
						</div>
						
						
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Vessel Schedule Surabaya</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<div class="table-responsive clearfix">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-status" class="table table-hover">',
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
			</div>

<script>
			var table2 = $('#table-status').dataTable({
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
				"lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');					
		</script>
		
		