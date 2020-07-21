
<!-- top-2-title-search -->
<?php
	if (!isset($searchterm)){
		$searchterm = '';	
	}
?>
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										
										<header class="main-box-header clearfix">
											<h2 class="pull-left"><?=$title;?></h2>
											
											<div class="filter-block pull-right">
												<div class="row">
													<div class="form-group pull-left">
													<?php
														echo form_dropdown('customer_location', $opt_customer_location, $lokasi_pelangganterm ,"class='form-control' onchange=\"change()\""," - Pilih Lokasi - ");
													?>
													</div>												
													<div class="form-group pull-left">
													<?php
														echo form_dropdown('customer_type', $opt_customer_type, $jenis_pelangganterm ,"class='form-control' onchange=\"change()\""," - Pilih Jenis Pelanggan - ");
													?>
													</div>
													<div class="form-group pull-left">
													<?php
														echo form_dropdown('service_type', $opt_service_type, $service_typeterm ,"class='form-control' onchange=\"change()\""," - Pilih Jenis Layanan - ");
													?>
													</div>													
													<div class="form-group pull-left">
													<?php
														echo form_dropdown('status_approval', $opt_status_approval, $status_approvalterm ,"class='form-control' onchange=\"change()\""," - Pilih Status Approval - ");
													?>
													</div>
													<div class="form-group pull-left">
													<?php
														echo form_dropdown('status_customer', $opt_status_customer, $status_customerterm ,"class='form-control' onchange=\"change()\""," - Pilih Status Customer - ");
													?>
													</div>		
													<div class="form-group pull-left">
													<?php 
														$sel_cfs_type = array(
															($cfsterm=='CFS'?'CFS':'')
														);
														$x = options_params($box_cfs_type, 'cfs_type', '', $sel_cfs_type,$disabled,"onchange=\"change()\"");
														echo options_group_loader('checkbox', $x);
													?>	
													</div>
													<div class="form-group pull-left">
														<input type="text" class="form-control" placeholder="Search..." id="searchBox" value="<?php if($searchterm!="empty") echo $searchterm;?>">
														<i class="fa fa-search search-icon"></i>
													</div>
												<?php if($this->session->userdata('group_phd') != 'a'){	?>
													<div class="form-group pull-left">
														<a href="#" class="btn btn-primary pull-right" id="addCustomerButton">
															<i class="fa fa-plus-circle fa-lg"></i> Tambah Pelanggan
														</a>
													</div>
												<?php } ?>
												</div>
											</div>
										</header>
										
									</div>
								</div>
							</div>
						
						</div><!-- closing div -->						
					</div><!-- closing div -->				
<!-- top-2-title-search -->
