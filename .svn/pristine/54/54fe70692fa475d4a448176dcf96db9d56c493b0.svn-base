<style>
    div.DTTT.btn-group{
        display:none !important;
    }
	.label {
		display: inline-block;
	}
</style>
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

	function clickDialog1(a)
	{
		$('#dialogViewReq').load("<?=ROOT?>container/view_request/"+a)
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

							<div class="row">
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h2>Create New</h2>
                                            <i>(Please click create to make a new receiving request)</i>
										</header>

										<div class="main-box-body clearfix">
											  <form class="form-inline" role="form" action="<?=ROOT?>container_receiving/add_receiving">
												<button type="submit" id="submit_form" onclick="" class="btn btn-success">Create</button>
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
					<div class="row" id="gridRequest">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Receiving Booking List</h2>

									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>

								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<?php
											$tmpl = array (
												'table_open'          => '<table id="table-request" class="table table-hover">',
												'heading_row_start'   => '<tr class=\'clickableRow\'>',
												'heading_row_end'     => '</tr>',
												'heading_cell_start'   => '',
												'heading_cell_end'     => ''
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
          function load_table()
            {
              //alert('test');
              $.blockUI();
              var url = "<?=ROOT?>container_receiving/search_main_receiving";
              var limit = $("#pagelimit").val();
              var search_input = $("#search_input").val();
              //alert(search_input);
              $("#gridRequest").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                            search:search_input,
                            page:1,limit:limit},function() {
                            $.unblockUI();
                          });
            }
					var table2 = $('#table-request').dataTable({
						'info': false,
						'sDom': 'lTfr<"clearfix">tip',
						'columnDefs': [
							{ type: 'date-dd-mmm-yyyy', targets: 2 }
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

					var tt2 = new $.fn.dataTable.TableTools(table2);
					$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');
					</script>
