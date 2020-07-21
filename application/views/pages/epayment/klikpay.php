							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Payment via iPay</h2>
										</header>

										<div class="main-box-body clearfix">
											<div class="table-responsive">
											
											<!--<form method="post" id="klikpay" name="klikpay" action="<?php echo $url;?>" target="my_iframe">
											<!--<form method="post" id="klikpay" name="klikpay" action="<?php echo $url;?>" onsubmit="target_popup(this)">
												<input type="hidden" id="id" name="id" value=''>
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											</form>-->
											
											<iframe name="my_iframe" src="<?php echo $url;?>" width="100%" height="1000"></iframe>
		
											<script>
													/*function target_popup(form) {
														window.open('', 'formpopup', 'width=900,height=800,resizeable,scrollbars');
														form.target = 'formpopup';
													}*/
													
													//$("#klikpay").submit();
													
											</script>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>