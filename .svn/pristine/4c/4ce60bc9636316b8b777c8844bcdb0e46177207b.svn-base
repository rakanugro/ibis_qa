
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Billing List</h2>
										<h6>&nbsp&nbsp Click to see progress</h6>
									</header>
									
									<div class="main-box-body clearfix">
										<div class="table-responsive clearfix">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-request" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
										</div>
									</div>
								</div>
							</div>
							
							<script>
								var table2 = $('#table-request').dataTable({
									'info': false,
									/*"oSearch": {"sSearch": "<?=$search?>","bSmart":false, "bRegex": true},
									'sDom': 'lTfr<"clearfix">tip',
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

								//pkk table clickable
								$('#table-request').on('click', 'tr', function () {
									var name = $('td', this).eq(1).text();
									
									//alert(name);
									
									//detail pkk
									$.post( "<?=ROOT?>container/get_detail_billing", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',no_req: name})
										.done(function( data ) {
											
										var obj = jQuery.parseJSON(data);
											
										$("#progress_info").removeClass('label-danger');
										$("#progress_info").removeClass('label-info');
										$("#progress_info").text();
										$("#progress_bar").removeClass('progress-bar-danger');
										$("#progress_bar").removeClass('progress-bar-info');
										$("#progress_bar").width('0%');
										$("#progress1").removeClass('colored purple-bg');
										$("#progress1").removeClass('colored red-bg');
										$("#progress2").removeClass('colored purple-bg');
										$("#progress3").removeClass('colored purple-bg');
										$("#progress4").removeClass('colored purple-bg');
										$("#progress1").removeClass('colored yellow-bg');
										$("#progress2").removeClass('colored yellow-bg');
										$("#progress3").removeClass('colored yellow-bg');
										$("#progress4").removeClass('colored yellow-bg');
										
										//alert(obj.STATUS_REQ);
										
										if(obj.STATUS_REQ == "N" || obj.STATUS_REQ == null) 
										{
											$("#progress_bar").width('25%');
											$("#progress_bar").addClass('progress-bar-info');
											$("#progress_info").addClass('label-info');
											$("#progress_info").text("Create Request");
											$("#progress1").addClass('colored purple-bg');
											$("#progress2").addClass('colored yellow-bg');
										}
										else if(obj.STATUS_REQ == "W") 
										{
											$("#progress_bar").width('50%');
											$("#progress_bar").addClass('progress-bar-info');
											$("#progress_info").addClass('label-info');
											$("#progress_info").text("Request Confirm");
											$("#progress1").addClass('colored purple-bg');
											$("#progress2").addClass('colored purple-bg');
											$("#progress3").addClass('colored yellow-bg');
										}
										else if(obj.STATUS_REQ == "S") 
										{
											$("#progress_bar").width('75%');
											$("#progress_bar").addClass('progress-bar-info');
											$("#progress_info").addClass('label-info');
											$("#progress_info").text("Request Approval");
											$("#progress1").addClass('colored purple-bg');
											$("#progress2").addClass('colored purple-bg');
											$("#progress3").addClass('colored purple-bg');
											$("#progress4").addClass('colored yellow-bg');
										}				
										else if(obj.STATUS_REQ == "P") 
										{
											$("#progress_bar").width('100%');
											$("#progress_bar").addClass('progress-bar-info');
											$("#progress_info").addClass('label-info');
											$("#progress_info").text("Done");
											$("#progress1").addClass('colored purple-bg');
											$("#progress2").addClass('colored purple-bg');
											$("#progress3").addClass('colored purple-bg');
											$("#progress4").addClass('colored purple-bg');
										}
										else if(obj.STATUS_REQ == "R") 
										{
											$("#progress_bar").width('25%');
											$("#progress_bar").addClass('progress-bar-danger');
											$("#progress_info").addClass('label-danger');
											$("#progress_info").text("Create Request");
											$("#progress1").addClass('colored red-bg');
										}
										
									}).fail(function() {
										alert("error");
									});
								});								
							</script>