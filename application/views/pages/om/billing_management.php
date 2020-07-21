<style>
    div.DTTT.btn-group{
        display:none !important;        
    }

	.label {
		display: inline-block;
	}
</style>

						<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Progress <span id="progress_info" class="label"></span></h2>
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
														<span class="headline">Create Request</span>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress2' class="main-box infographic-box">
														<span class="headline">Request Confirm</span>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress3' class="main-box infographic-box">
														<span class="headline">Request Approval</span>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-xs-12">
													<div id='progress4' class="main-box infographic-box">
														<span class="headline">Payment</span>
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
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2 class="pull-left">Search Request</h2>
										</header>
										<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">No Request / Vessel Name</label>
											<input type="text" class="form-control" id="search_input" name="search_input" value="" placeholder="" style="width:50%;" />
										</div>										
										<div class="form-group example-twitter-oss">
											<input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success"/>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row" id="tabledata">
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
						</div>
							
					</div>
				</div>
				<div id="dialogViewReq"></div>
			</div>
			
		<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
		<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
		<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
		<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
		<script src="<?=CUBE_?>js/classie.js"></script>
		<script src="<?=CUBE_?>js/notificationFx.js"></script>

		<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
		<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
		<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
		<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
		<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
		<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
			
		<script src="<?=JSQ?>jquery-ui.min.js"></script>

		<script>
			$(document).ready(function() {
				//sql injection protection
				$(":input").keyup(function(event) {
					// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
					$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
				});
			});
		
			function load_table()
			{
				$.blockUI();
				var url = "<?=ROOT?>om/billingmanagement/billing_management_check";
				var limit = $("#pagelimit").val();
				var search_input = $("#search_input").val();
				$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
											search:search_input,
											page:1,limit:limit},function() {
										  $.unblockUI();
										});
			}
				
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

			var table2 = $('#table-request').dataTable({
				'info': false,
				"oSearch": {"sSearch": "<?=$search?>","bSmart":false, "bRegex": true},
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
            
		</script>
		
		<script>
			function clickDialog1(a)
			{
				$('#dialogViewReq').load("<?=ROOT?>/om/billingmanagement/view_request/"+a).dialog({modal:false, height:500,width:650,title: 'View Content'});
			}
			function clickConfirm(a)
			{
				var r = confirm("Are you sure to confirm?");
				if (r == true) {
					alert("You will confirm this request");
					var url = "<?=ROOT?>container_receiving/confirm_request";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:a}, function(data){
						alert(data);
						location.reload(); 
					});
				}
			}
		</script>