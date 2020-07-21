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

<script>
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

	$( document ).ready(function() {
		
		$( "#table-request a" ).on( "mouseup", function() {
			$( "#table-request a" ).attr('disabled','disabled');
		});
	});
	
	function clickDialog1(a){
		$('#dialogViewReq').load("<?=ROOT?>/container/view_request/"+a)
		.dialog({modal:false, height:500,width:650,title: 'View Content',close: function( event, ui ) {$('a').removeAttr('disabled');}});
	}
	function clickConfirm(a)
	{
		var r = confirm("Are you sure to confirm?");
		if (r == true) {
			var url = "<?=ROOT?>container/confirm_request";
			$.blockUI();
			$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',REQUEST:a}, function(data){
				$.unblockUI();
				alert(data);
				if(data=="Success")
					location.reload(); 
			});
		}
		$('a').removeAttr('disabled');
	}
</script>

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
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Create New</h2>
                                            <i>(Please click create to make a new extension delivery request)</i>
										</header>
										
										<div class="main-box-body clearfix">
											<form class="form-inline" role="form" action="<?=ROOT?>container/add_delivery_ext">
												<button type="submit" id="submit_form" onclick="" class="btn btn-success">Create</button>
											</form>
											<!--  ap06 -->
											
											<?php 
//												$attributes = array('class' => 'form-inline','role'=>'form');
	//											echo form_open(ROOT.'container/add_delivery_ext',$attributes);
											?>	
											<!-- // ap06 -->

		<!--										<button type="submit" id="submit_form" onclick="" class="btn btn-success">Create</button>-->
											</form>
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
											<label for="exampleAutocomplete">No Request</label>
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
									<h2 class="pull-left">Extension Delivery Booking List</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive clearfix">
										<!--<table class="table table-striped table-hover">-->
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-request" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
										<!--</table>-->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="dialogViewReq"></div>

<script>
		function load_table()
			{
				$.blockUI();
				var url = "<?=ROOT?>container/search_main_delivery_ext";
				var limit = $("#pagelimit").val();
				var search_input = $("#search_input").val();
				$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
											search:search_input,
											page:1,limit:limit},function() {
										  $.unblockUI();
										});
			}
			var table2 = $('#table-request').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
				'columnDefs': [
					{ type: 'date-dd-mmm-yyyy', targets: 2 },
					{ type: 'date-dd-mmm-yyyy', targets: 6 }
				],
				'oTableTools': {
					'aButtons': [
						{
							'sExtends':    'collection',
							'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
							'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
						}
					]
				},
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
		</script>