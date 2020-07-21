<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
	.label {
		display: inline-block;
	}
</style>
<script>
	$( document ).ready(function() {
		
		$( "#table-request a" ).on( "mouseup", function() {
			$( "#table-request a" ).attr('disabled','disabled');
		});	
	});
	
	function clickDialog1(a)
	{		
		$('#dialogViewReq').load("<?=ROOT?>container/view_request/"+a)
		.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	}
	function clickConfirm(a)
	{
		var r = confirm("Are you sure to confirm?");
		if (r == true) {
			alert("You will confirm this request");
			var url = "<?=ROOT?>container/confirm_request";
			$.post(url, {REQUEST:a,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
				alert(data);
				location.reload(); 
			});
		}
		$('a').removeAttr('disabled');
	}
</script>
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?=CUBE_?>js/jquery.dataTables.shortingEuro.js"></script>
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
<!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>
<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">User</a></li>
										<li class="active"><span>User List</span></li>
									</ol>
									
									<h1>User List</h1>
								</div>
							</div>							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">User List</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive clearfix">
										<?php
											$tmpl = array (
												'table_open'          => '<table id="table-user" class="table table-hover">',
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
					<div id="dialogViewReq"></div>
					
		
					<script>
						var table2 = $('#table-user').dataTable({
							'info': false,
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