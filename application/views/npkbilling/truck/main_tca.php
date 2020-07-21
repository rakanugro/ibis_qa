
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?=CUBE_?>js/jquery.dataTables.shortingEuro.js"></script>
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<!-- global scripts -->
<style>
	.modal-header {
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }
</style>	

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2>Create New</h2>
                        <i>(Please click create to make a new tca)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npkbilling/tca/create_tca">
						<button type="submit" id="getterminal" onclick="" class="btn btn-success">Create</button>
					</form>
				</div>
			</div>
		</div>	
	</div>
						
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Tca</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th>NO</th>
									<th >NOMOR REQUEST</th>
									<th >CUSTOMER NAME</th>
									<th >NAMA VESSEL</th>
									<th >TIPE KEGIATAN</th>
									<th >NO BL</th>
									<th >TERMINAL NAME</th>
									<th >ACTION</th>
								</tr>	
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-sm" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-sm">
    		<div class="modal-content">
    			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel"><b>Informasi</b></h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<!-- <span aria-hidden="true">&times;</span> -->
        			</button>
      			</div>
      			<div class="modal-body">
        			Apakah anda yakin&hellip;?
      			</div>
      			<div class="modal-footer">
        			<button type="button" id="btn-modal-kirim" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
        			<button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>
        		</div>
        	</div>
  		</div>
	</div>

					
<script>

	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/tca/getListTca?",
	    	data: {},
		    success: function(data){
		    	console.log(data);
				var obj = JSON.parse(JSON.parse(data));
	 	  		var arr =[];
	 			var jmlresponse = obj['result']['length'];
				
				for(i=0;i<jmlresponse;i++)
				{
					var no 			 			= 1;
					var tca_id          		=obj['result'][i]['tca_hdr_id'];
					var tca_req_no          	=obj['result'][i]['tca_req_no'];
					var tca_cust_name          	=obj['result'][i]['tca_cust_name'];
					var tca_vessel_name         =obj['result'][i]['tca_vessel_name'];
					var tca_req_type_name       =obj['result'][i]['tca_req_type_name'];
					var tca_bl         			=obj['result'][i]['tca_bl'];
					var tca_terminal_name       =obj['result'][i]['tca_terminal_name'];
					var tca_status       		=obj['result'][i]['tca_status'];
				}
				obj['result'].forEach(function(abc) {
					var status = (abc.tca_status != 1)? "disabled" : "";
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    	'<td>'+ abc.tca_req_no +'</td>' +
						    	'<td>'+ abc.tca_cust_name +'</td>' +
						    	'<td>'+ abc.tca_vessel_name +'</td>' +
						    	'<td>'+ abc.tca_req_type_name +'</td>' +
						    	'<td>'+ abc.tca_bl +'</td>' +
						    	'<td>'+ abc.tca_terminal_name +'</td>' +
						    '<td>'+
								'<a class="btn btn-success open-AddBookDialog '+ status +'" href="#" data-id="'+abc.tca_id+'" data-toggle="modal" title="Send Tos" data-target="#modal-default"><span class="glyphicon glyphicon-send"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
								'<a class=\'btn btn-primary\' data-toggle="tooltip" title="Lihat Data" href="<?=ROOT?>npkbilling/tca/view_tca?vtcaid='+abc.tca_id +'"><span class="glyphicon glyphicon-list-alt"></span></a>'+ "&nbsp"+
								'<a class=\'btn btn-danger '+ status +'\' data-toggle="tooltip" title="Edit Data" href="<?=ROOT?>npkbilling/tca/update_tca?vtcaid='+abc.tca_id+'"><span class="glyphicon glyphicon-edit"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
							'</td>'+
						'</tr>'
			        );

		       });
		 
		           $("#example1").DataTable();
		           $.unblockUI();
		    }
		});

		$(document).on("click", ".open-AddBookDialog", function () {
			var id = $(this).data('id');
			console.log(id);
			$('#btn-modal-kirim').click(function(){ send(id); return false; });
		});

		function send(id){
			$.blockUI()
			$('#modal-default').modal('hide');

			$.ajax({
				type: "GET",
				url: "<?=ROOT?>npkbilling/tca/send/"+id,
				success: function(data){
					var json = JSON.parse(data);
					console.log(json);
					if(json.success == "S"){
						resp = JSON.parse(json.data);
						no_req = resp.no_req;

						if(resp.Success == true){
							alert('Request berhasil terkirim..');
							sendTca_log(no_req);

							window.location = "<?=ROOT?>npkbilling/tca";
						}
						else{
							alert("Data "+resp.result_msg);
						}
					}else{
						alert(json.data);
					}
					$.unblockUI();
				}
			})
		}

		function sendTca_log(no_req) {
		
			$.ajax({
				url: "<?=ROOT?>npkbilling/transaction_log/sendTca_log",
				type: 'POST',
				//dataType: 'json',
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					no_req 			: no_req,

				},
				success: function( data ) {
					console.log(data);

				}
			});
		}
	});

</script>