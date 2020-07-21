<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<ol class="breadcrumb">
										<li><a href="#">Jakarta<->Surabaya</a></li>
										<li class="active"><span>Master Vessel</span></li>
									</ol>
									<h1>Master Vessel</h1>
									</ol>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Master Vessel</h2>
                                        </header>
                                        
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="tbl_jktsby" class="table table-hover">',
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
					
 