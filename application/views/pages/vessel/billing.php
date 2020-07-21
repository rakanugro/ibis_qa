<!--script src="<?=CUBE_?>js/jquery-1.7.2.min.js"></script-->
<!--script src="<?=CUBE_?>js/jquery.blockUI.js"></script-->
							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?=$xheadtable?></h2>
											<h6><?=$xclickdetail?></h6>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-pkk" class="table table-hover">',
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
							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?=$xprogress?> <span id="progress_info" class="label"></span></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="progress progress-striped progress-4x">
												<div id="progress_bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
													<span class="sr-only">80% Complete (danger)</span>
												</div> 
											</div>
											<div class="row">
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress1' class="main-box infographic-box">
														<span class="headline"><?=$xprogress1?></span>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress2' class="main-box infographic-box">
														<span class="headline"><?=$xprogress2?></span>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress3' class="main-box infographic-box">
														<span class="headline"><?=$xprogress3?></span>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress4' class="main-box infographic-box">
														<span class="headline"><?=$xprogress4?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2><?=$xmainhead1?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="col-lg-1 control-label"><?=$xno_pranota?></label>
													<div class="col-lg-2">
														<input type="text" id="no_pranota" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div id="form-dpjk" class="col-lg-2" style="visibility: hidden;">
														<a id="link_dtjk" class="btn btn-primary" target="_blank">DTJK <i class="fa fa-file-pdf-o"></i></a>&nbsp;
														<a id="link_dpjk" class="btn btn-primary" target="_blank">DPJK <i class="fa fa-file-pdf-o"></i></a>
													</div>
													<label class="col-lg-3 control-label"><?=$xnotification?></label>
													<div class="col-lg-4">
														<input type="text" id="notif_via" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-1 control-label"><?=$xno_nota?></label>
													<div class="col-lg-2">
														<input type="text" id="no_nota" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div id="form-nota" class="col-lg-2" style="visibility: hidden;">
														<a id="link_nota" class="btn btn-primary" target="_blank">NOTA <i class="fa fa-file-pdf-o"></i></a>
													</div>
													<label class="col-lg-3 control-label"><?=$xpay_method?></label>
													<div class="col-lg-4">
														<input type="text" id="pay_method" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-1 control-label">Email</label>
													<div class="col-lg-4">
														<input type="text" id="email" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<label class="col-lg-3 control-label">Status</label>
													<div class="col-lg-4">
														<input type="text" id="pay_status" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-1 control-label"><?=$xbill_address?></label>
													<div class="col-lg-4">
														<input type="text" id="address" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<label class="col-lg-3 control-label"><?=$xamount_nota?></label>
													<div class="col-lg-1">
														<input type="text" id="currency" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-3">
														<input type="text" id="nota_amount" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div id="form-uper" class="form-group" style="display: none;">
													<label class="col-lg-1 control-label"></label>
													<div class="col-lg-4"></div>
													<label class="col-lg-3 control-label"><?=$xuper?></label>
													<div class="col-lg-1">
														<input type="text" id="curr_uper" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-3">
														<input type="text" id="jum_uper" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<label class="col-lg-1 control-label"></label>
													<div class="col-lg-4"></div>
													<label id="lbl_sisa_piutang" class="col-lg-3 control-label"></label>
													<div class="col-lg-1">
														<input type="text" id="curr_sisa_piutang" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-3">
														<input type="text" id="sisa_piutang" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div id="form-ac" class="form-group" style="display: none;">
													<label class="col-lg-1 control-label"></label>
													<div class="col-lg-4"></div>
													<label class="col-lg-3 control-label"><?=$xtotal_hold?></label>
													<div class="col-lg-1">
														<input type="text" id="curr_hold" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-3">
														<input type="text" id="total_hold" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<label class="col-lg-1 control-label"></label>
													<div class="col-lg-4"></div>
													<label class="col-lg-3 control-label">Deduct</label>
													<div class="col-lg-1">
														<input type="text" id="curr_deduct" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-3">
														<input type="text" id="total_deduct" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>	
							</div>
							
						</div>
					</div>
					
					<script>
					//pkk table clickable
					$('#table-pkk').on('click', 'tr', function () {
						// $.blockUI({ message: '<h1><br>loading...</h1><br><img src="<?=CUBE_?>img/loading.gif" /><br><br>' });
						//no pkk
						var name = $('td', this).eq(0).text();

						//detail pkk
						$.post( "<?=ROOT?>data/getDetailPKK", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',no_pkk: name})
							.done(function( data ) {
								//alert( "Data Loaded: " + data );
								var obj = jQuery.parseJSON(data);
								
								$("#no_pranota").val("");
								$("#no_nota").val("");
								$("#email").val("");
								$("#address").val("");
								$("#pay_method").val("");
								$("#pay_status").val("");
								$("#currency").val("");
								$("#nota_amount").val("");
								$("#form-uper").hide();
								$("#curr_uper").val("");
								$("#jum_uper").val("");
								$("#curr_sisa_piutang").val("");
								$("#sisa_piutang").val("");
								$("#form-ac").hide();
								$("#curr_hold").val("");
								$("#total_hold").val("");
								$("#curr_deduct").val("");
								$("#total_deduct").val("");
								$("#form-dpjk").css("visibility", "hidden");
								$("#form-nota").css("visibility", "hidden");
								if ( typeof obj.data.billing !== "undefined" && obj.data.billing) {
									$("#no_pranota").val(obj.data.info.bentuk_3a);
									if(obj.data.info.kd_proses>=4 && obj.data.info.kd_proses!=7)
										$("#no_nota").val(obj.data.billing.no_nota);
									$("#email").val(obj.data.billing.email_perusahaan);
									$("#address").val(obj.data.billing.alamat_perusahaan);
									// $("#pay_method").val(obj.data.info.payment_type);
									$("#pay_status").val('Not paid yet');
									$("#currency").val(obj.data.billing.kd_currency);
									$("#nota_amount").val(obj.data.billing.jumlah_tagihan2);
									if(obj.data.billing.uang_jaminan > 0) {
										$("#pay_method").val("UPER");
										$("#form-uper").show();
										$("#curr_uper").val(obj.data.billing.kd_currency);
										$("#jum_uper").val(obj.data.billing.uang_jaminan2);
										$("#curr_sisa_piutang").val(obj.data.billing.kd_currency);
										if(obj.data.billing.sisa_uper > 0) {
											$("#sisa_piutang").val(obj.data.billing.sisa_uper2);
											$("#lbl_sisa_piutang").html("<?=$xsisa_uper?>");
										}
										else {
											$("#sisa_piutang").val(obj.data.billing.piutang2);
											$("#lbl_sisa_piutang").html("<?=$xpiutang?>");
										}
									}
									else {
										if(obj.data.billing.jumlah_hold_ac > 0) {
											$("#pay_method").val("AUTO COLLECTION");
											$("#form-ac").show();
											$("#curr_hold").val(obj.data.billing.kd_currency);
											$("#total_hold").val(obj.data.billing.jumlah_hold_ac2);
											$("#curr_deduct").val(obj.data.billing.kd_currency);
											$("#total_deduct").val(obj.data.billing.deduct_ac2);
										}
										else
											$("#pay_method").val("CMS");
									}
								}
								
								$("#progress_info").removeClass('label-danger');
								$("#progress_info").removeClass('label-info');
								$("#progress_info").text(obj.data.info.proses);
								$("#progress_bar").removeClass('progress-bar-danger');
								$("#progress_bar").removeClass('progress-bar-info');
								$("#progress_bar").width('0%');
								$("#progress1").removeClass('colored purple-bg');
								$("#progress1").removeClass('colored red-bg');
								$("#progress2").removeClass('colored purple-bg');
								$("#progress3").removeClass('colored purple-bg');
								$("#progress4").removeClass('colored purple-bg');
								if(obj.data.info.kd_proses>=4 && obj.data.info.kd_proses!=7) {
									$("#progress_bar").width('90%');
									$("#progress_bar").addClass('progress-bar-info');
									$("#progress_info").addClass('label-info');
									$("#progress1").addClass('colored purple-bg');
									$("#progress2").addClass('colored purple-bg');
									$("#progress3").addClass('colored purple-bg');
									$("#form-dpjk").css("visibility", "visible");
									$("#form-nota").css("visibility", "visible");
									$("#link_dtjk").attr('href','<?=ROOT?>pkk/download_dtjk/'+name);
									$("#link_dpjk").attr('href','<?=ROOT?>pkk/download_dpjk/'+name);
									$("#link_nota").attr('href','<?=ROOT?>pkk/download_nota/'+name);
									if ( typeof obj.data.nota !== "undefined" && obj.data.nota) {
										if(obj.data.nota.lunas > 0) {
											$("#progress4").addClass('colored purple-bg');
											$("#progress_bar").width('100%');
											$("#pay_status").val('Paid');
										}
									}
								}
								else if(obj.data.info.kd_proses==3) {
									$("#progress_bar").width('75%');
									$("#progress_bar").addClass('progress-bar-info');
									$("#progress_info").addClass('label-info');
									$("#progress1").addClass('colored purple-bg');
									$("#progress2").addClass('colored purple-bg');
									$("#progress3").addClass('colored purple-bg');
								}
								else if(obj.data.info.kd_proses==2) {
									$("#progress_bar").width('50%');
									$("#progress_bar").addClass('progress-bar-info');
									$("#progress_info").addClass('label-info');
									$("#progress1").addClass('colored purple-bg');
									$("#progress2").addClass('colored purple-bg');
								}
								else if(obj.data.info.kd_proses==1) {
									$("#progress_bar").width('25%');
									$("#progress_bar").addClass('progress-bar-info');
									$("#progress_info").addClass('label-info');
									$("#progress1").addClass('colored purple-bg');
								}
								else if(obj.data.info.kd_proses==7) {
									$("#progress_bar").width('100%');
									$("#progress_bar").addClass('progress-bar-danger');
									$("#progress_info").addClass('label-danger');
									$("#progress1").addClass('colored red-bg');
								}
								
						}).fail(function() {
							alert("error");
						  });
						//alert(name);
						// $.unblockUI({ onUnblock: function(){  }});
					});
		
						//tables-advanced.html
						var table = $('#table-pkk').dataTable({
							'info': false,
							'order': [[ 4, "desc" ]],
							/*'sDom': 'lTfr<"clearfix">tip',
							'oTableTools': {
								'aButtons': [
									{
										'sExtends':    'collection',
										'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
										'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
									}
								]
							},*/
							"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
						});
						
						/*var tt = new $.fn.dataTable.TableTools(table);
						$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');*/
					</script>