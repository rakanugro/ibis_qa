


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
											<li class="active"><span>Container Status Check</span></li>
										</ol>
										
										<h1>Container Status Check</h1>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<header class="main-box-header clearfix">
										<h2>Upload Container List</h2>
									</header>
									
									<div class="main-box-body clearfix">
										<form onsubmit="return cek_upload()" class="form-inline" role="form" enctype="multipart/form-data" role="form" action="<?=ROOT?>port_cooperation/container_status_check" method="post">
											<div class="form-group example-twitter-oss">
													<label>File Excel : </label>
														<div class="form-group">
															<div class="col-xs-12">
																<label class="ace-file-input">
																	<input type="file" id="attachment" name="attachment" size="20">
																</label>
															</div>
														</div>
												</div><br>
												<button type="submit" class="btn btn-success">Upload</button>
										</form>
									</div>
								</div>
							</div>	
						</div>
						
				
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Container Status Check</h2>
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
			
			</div>

</div>