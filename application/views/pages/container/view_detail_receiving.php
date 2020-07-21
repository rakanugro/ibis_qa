<div class="row" id="rowdetail">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Container List</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-receiving" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
									</div>
									<?if($type=='edit'){?>
										<input type="button" value="Submit Request" onclick="alldone()" id="submit_all" name="submit_all" class="btn btn-success"/>
										<button type="submit" onclick="window.open('<?=ROOT.'container_receiving/main_receiving'?>','_self')" class="btn btn-success">Next</button>
									<?} else {?>
										<button type="submit" onclick="window.open('<?=ROOT.'container_receiving/main_receiving'?>','_self')" class="btn btn-success">Back</button>
									<?}?>
								</div>
                                
							</div>
						</div>
					</div>

<script>
    function alldone(){
        var request_no = $("#request_no").val();
        var port = $("#port").val();
        var url = "<?=ROOT?>/container_receiving/submit_request";
        $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',request_no:request_no,port:port},function(data){
             var obj = jQuery.parseJSON(data);
             if(obj.rc=="S"){
                 var notification = new NotificationFx({
                        message : '<p>Permintaan Receiving Berhasil</p>',
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'success', // notice, warning, error or success 
                        onClose : function() {
						  window.open("<?=ROOT?>container_receiving/main_receiving","_self");
					   }
                });
                 notification.show();
             }
             else {
                 var notification = new NotificationFx({
                        message : '<p>Permintaan Receiving Gagal </p><br/>'+obj.rcmsg,
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'error' // notice, warning, error or success 
                });
             }
        });
    }


			var table2 = $('#table-receiving').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
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

