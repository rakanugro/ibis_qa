
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Daftar Kontainer</h2>
								</header>

								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<?php
											$tmpl = array (
													'table_open'          => '<table id="table-detail" class="table table-striped table-hover">',
													'heading_row_start'   => '<tr class=\'clickableRow\'>'
											  );

											$this->table->set_template($tmpl);
											echo $this->table->generate();
										?>
									</div>

								</div>

								<!--<button type="submit" onclick="window.open('<?=ROOT.'container_alihkapal/main_alihkapal'?>','_self')" class="btn btn-success">Submit Request</button>-->
								<button type="submit" onclick="window.open('<?=ROOT.'container_alihkapal/main_alihkapal'?>','_self')" class="btn btn-success">Next</button>
							</div>
						</div>
					</div>

<script src="<?=CUBE_?>js/notificationFx.js"></script>

<style>
    div.DTTT.btn-group{
        display:none !important;
    }
</style>

<script>
var table2 = $('#table-detail').dataTable({
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
    "lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
});

var tt2 = new $.fn.dataTable.TableTools(table2);
$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');

function del_cont(id_req, nocont, port, terminal){
	var url = "<?=ROOT?>container_alihkapal/delete_container";
	//alert(url);
	$.blockUI();
	$.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',id_req:id_req, nocont:nocont, port:port, terminal:terminal}, function(data){
		var obj = jQuery.parseJSON(data);
		$.unblockUI();
		if(obj.rc=="F")
		{
			var notification = new NotificationFx({
				message : '<p>Delete Container Gagal </p><br/>'+obj.rcmsg,
				layout : 'growl',
				effect : 'jelly',
				type : 'error' // notice, warning, error or success

			});
		}
		else if(obj.data.info=="OK")
		{
			var notification = new NotificationFx({
				message : '<p>Delete Container Sukses</p>',
				layout : 'growl',
				effect : 'jelly',
				type : 'success' // notice, warning, error or success

			});
		}
		else{
			var notification = new NotificationFx({
				message : '<p>Delete Container Gagal </p><br/>'+obj.data,
				layout : 'growl',
				effect : 'jelly',
				type : 'error' // notice, warning, error or success

			});
		}
		notification.show();

		var url = "<?=ROOT?>container_alihkapal/getListContainer/"+id_req+"/"+port+"/"+terminal+"/E";
		$("#detailreq").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},function(data){ });

	});
}

function save_req(){
    var url = "<?=ROOT?>container_alihkapal/save_request_alihkapal";
    var request_no = $("#request_no").val();
    var port = $("#port").val();
    $("#button_add_detail").attr("style","display:none");
    $.post(url,{request_no:request_no,port:port},function(data){
		alert(data);
         if(data=="OK")
        {
			alert('tes');
            var notification = new NotificationFx({
                message : '<p>Simpan Request Berhasil</p>',
                layout : 'growl',
                effect : 'jelly',
                type : 'success', // notice, warning, error or success
                ttl : 1000,
                onClose : function() {
                    window.open("<?=ROOT?>container_alihkapal/main_alihkapal","_self");
                    return false; }
            });

            // show the notification
            notification.show();
			alert('tes lagi');
        }
        else {
            alert('test2');
            var notification = new NotificationFx({
                message : '<p>Simpan Request Gagal</p> '+data,
                layout : 'growl',
                effect : 'jelly',
                type : 'error', // notice, warning, error or success
                ttl : 1000,
                onClose : function() {
                    window.open("<?=ROOT?>container_alihkapal/main_alihkapal","_self");
                    return false; }

            });

            // show the notification
            notification.show();

        }
    });
}
</script>
