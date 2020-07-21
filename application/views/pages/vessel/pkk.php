						<script src="<?=CUBE_?>js/jquery.dataTables.shortingCustom.js"></script>
			<script src="<?=CUBE_?>js/jquery.dataTables.shortingEuro.js"></script>
							
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
								<div class="col-lg-6">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2><?=$xmainhead1?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xnm_kapal?></label>
													<div class="col-lg-9">
													<input type="text" id="nama_kapal" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xbendera?></label>
													<div class="col-lg-9">
													<input type="text" id="bendera" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">LOA</label>
													<div class="col-lg-9">
													<input type="text" id="loa" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">DWT / GRT</label>
													<div class="col-lg-4">
														<input type="text" id="dwt" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-1" align="center">/</div>
													<div class="col-lg-4">
														<input type="text" id="grt" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xdraft?></label>
													<div class="col-lg-4">
														<input type="text" id="front_draft" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
													<div class="col-lg-1" align="center">/</div>
													<div class="col-lg-4">
														<input type="text" id="back_draft" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xkemasan?></label>
													<div class="col-lg-9">
													<input type="text" id="cont_type" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xtipe_voyage?></label>
													<div class="col-lg-9">
													<input type="text" id="voy_type" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xkunjungan?></label>
													<div class="col-lg-9">
													<input type="text" id="kunjungan" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>					
											</form>
										</div>
									</div>
								</div>	
								<div class="col-lg-6">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2><?=$xmainhead2?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="col-lg-3 control-label">Voyage In</label>
													<div class="col-lg-9">
													<input type="text" id="voyage_in" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Voyage Out</label>
													<div class="col-lg-9">
													<input type="text" id="voyage_out" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xpel_asal?></label>
													<div class="col-lg-9">
													<input type="text" id="start" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xpel_sebelum?></label>
													<div class="col-lg-9">
													<input type="text" id="previous" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xpel_berikut?></label>
													<div class="col-lg-9">
													<input type="text" id="next" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xpel_tujuan?></label>
													<div class="col-lg-9">
													<input type="text" id="end" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xtgl_tiba?></label>
													<div class="col-lg-9">
													<input type="text" id="arrival_time" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>												
												<div class="form-group">
													<label class="col-lg-3 control-label"><?=$xtgl_berangkat?></label>
													<div class="col-lg-9">
													<input type="text" id="departure_time" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" readonly>
													</div>
												</div>												
											</form>
										</div>
									</div>
								</div>									
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?=$xmainhead4?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-rpk" class="table table-hover">'
																  );
																  
													$this->table->clear();
													//create table
													$this->table->set_heading($xno_rpk,$xren_tambat,$xstatus_rpk);
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
											<h2><?=$xmainhead3?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-ppkb" class="table table-hover">'
																  );
																  
													$this->table->clear();
													//create table
													$this->table->set_heading($xservice_code, $xpelayanan, 'PPKB', $xtgl_entry,$xtgl_penetapan, $xstatus_ppkb, $xcetak_ppkb);
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
					
					<script>
					//pkk table clickable
					$('#table-pkk').on('click', 'tr', function () {
						//no pkk
						var name = $('td', this).eq(0).text();
						//alert(name);
						//detail pkk
						$.post( "<?=ROOT?>data/getDetailPKK", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',no_pkk: name})
							.done(function( data ) {
								
								var obj = jQuery.parseJSON(data);

								$('#nama_kapal').val(obj.data.vessel.vessel_name);
								$('#bendera').val(obj.data.vessel.flag);
								$('#loa').val(obj.data.vessel.loa);
								$('#dwt').val(obj.data.vessel.dwt);
								$('#grt').val(obj.data.vessel.grt);
								if(obj.data.vessel.front_draft) $('#front_draft').val(obj.data.vessel.front_draft); else $('#front_draft').val('n/a'); 
								if(obj.data.vessel.back_draft) $('#back_draft').val(obj.data.vessel.back_draft);else $('#back_draft').val('n/a'); 
								$('#cont_type').val(obj.data.vessel.kemasan);
								$('#voy_type').val(obj.data.vessel.voy_type);
								$('#kunjungan').val(obj.data.vessel.kunjungan);
								$('#voyage_in').val(obj.data.info.voyage_in);
								$('#voyage_out').val(obj.data.info.voyage_out);
								$('#start').val(obj.data.info.first_port);
								$('#previous').val(obj.data.info.previous_port);
								$('#next').val(obj.data.info.next_port); $('#end').val(obj.data.info.last_port);
								$('#arrival_time').val(obj.data.info.ata);
								$('#departure_time').val(obj.data.info.atd);
								
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
									if ( typeof obj.data.nota !== "undefined" && obj.data.nota) {
										if(obj.data.nota.lunas > 0) {
											$("#progress4").addClass('colored purple-bg');
											$("#progress_bar").width('100%');
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
								
								var i,j;
								// $('#table-ppkb > tbody > tr:nth-child(n+2)').remove();
								$('#table-ppkb').find("tr:gt(0)").remove();
								for(i=0;i<obj.data.ppkb.length;i++)
								{
									/*for(j=0;j<obj.data.ppkb.length;j++)
									{
										if ( typeof obj.data.ppkb[i].service[j] !== "undefined" && obj.data.ppkb[i].service[j]) {
											ppkb_ke=obj.data.ppkb[i].no_ppkb;
											print = '<a class="btn btn-primary" href="<?=ROOT?>pkk/download_ppkb/'+ppkb_ke.replace("-", "/")+'" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
											$('#table-ppkb tr:last').after('<tr><td>'+obj.data.ppkb[i].service[j].service_name+'</td><td>'+obj.data.ppkb[i].no_ppkb+'</td><td>'+obj.data.ppkb[i].tgl_entry+'</td><td>'+obj.data.ppkb[i].tgl_penetapan+'</td><td>'+obj.data.ppkb[i].status_ppkb+'</td><td>'+print+'</td></tr>');
										}
									}*/
									ppkb_ke=obj.data.ppkb[i].no_ppkb;
									print = '<a class="btn btn-primary" href="<?=ROOT?>pkk/download_ppkb/'+ppkb_ke.replace("-", "/")+'" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
									$('#table-ppkb tr:last').after('<tr><td>'+obj.data.ppkb[i].service_code+'</td><td>'+obj.data.ppkb[i].pelayanan+'</td><td>'+obj.data.ppkb[i].no_ppkb+'</td><td>'+obj.data.ppkb[i].tgl_entry+'</td><td>'+obj.data.ppkb[i].tgl_penetapan+'</td><td>'+obj.data.ppkb[i].status_ppkb+'</td><td>'+print+'</td></tr>');
								}
								
								$('#table-rpk').find("tr:gt(0)").remove();
								for(i=0;i<obj.data.rpk.length;i++)
								{
									ket_rencana1="Kade : "+obj.data.rpk[i].nm_kade+" &nbsp;&nbsp;&nbsp;&nbsp; Meter : "+obj.data.rpk[i].m_awal+" - "+obj.data.rpk[i].m_akhir;
									ket_rencana2="Mulai Tambat: "+obj.data.rpk[i].tgl_mulai_tambat;
									ket_rencana3="Selesai Tambat: "+obj.data.rpk[i].tgl_selesai_tambat;
									$('#table-rpk tr:last').after('<tr><td>'+obj.data.rpk[i].no_rpk+'</td><td>'+ket_rencana1+'<br/>'+ket_rencana2+'<br/>'+ket_rencana3+'</td><td>'+obj.data.rpk[i].status+'</td></tr>');
								}
								
						}).fail(function() {
							alert("error");
						  });
						//alert(name);
					});
		
						//tables-advanced.html
						var table = $('#table-pkk').dataTable({
							'info': false,
							'columnDefs': [
								{ type: 'date-euro', targets: 4 },
								{ type: 'date-euro', targets: 5 }
							],
							"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
						});
					</script>