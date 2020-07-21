
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
    div.DTTT.btn-group{
        display:none !important;        
    }
	.label {
		display: inline-block;
	}
	a.disabled {
		pointer-events: none;
		cursor: default;
	}
</style>					
	
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2>Create New</h2>
                        <i>(Please click create to make a new Bongkar / Muat Request)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npkbilling/request_bm/create_bm">
						<button type="submit" id="submit_form" onclick="" class="btn btn-success">Create</button>
					</form>
				</div>
			</div>
		</div>	
	</div>
						
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Booking / Muat</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th>NO</th>
									<th >NOMOR REQUEST</th>
									<th >TANGGAL REQUEST</th>
									<th >CUSTOMER NAME</th>
									<th >NAMA VESSEL</th>
									<th >STATUS</th>
									<th >REMARK</th>
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

	<div class="modal fade" id="modal-default">
		<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Informasi</h4>
			</div>
			<div class="modal-body">
			<p>Apakah anda yakin ?&hellip;</p>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
			<a href="#" id="btn-modal-kirim" class="btn btn-primary">Kirim</a>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
					
<script>
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/request_bm/getListRequestBm?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
		    	console.log(obj);
				var arr =[];
				var no 	= 1;
	 			var jmlresponse = obj.length;
				var status = "";
				obj.result.forEach(function(abc) {
					var mark = (abc.bm_mark)? abc.bm_mark : "";
					var status = (abc.bm_status == 3 || abc.bm_status == 2)? "disabled" : "";
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>'+ abc.bm_no +'</td>' +
						    '<td>'+ abc.bm_date +'</td>' +
						    '<td>'+ abc.bm_cust_name +'</td>' +
						    '<td>'+ abc.bm_vessel_name +'</td>' +
						    '<td style="font-weight:bold;">'+ abc.reff_name +'</td>' +
						    '<td>'+ mark +'</td>' +
							'<td>'+
								'<a class="btn btn-success open-AddBookDialog '+ status +'"  href="#" data-id="'+abc.bm_id+'" data-toggle="modal" title="Send Approval" data-target="#modal-default"><span class="glyphicon glyphicon-send"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
								'<a class="btn btn-primary" href="<?=ROOT?>npkbilling/request_bm/view/'+abc.bm_id+'""><span class="glyphicon glyphicon-list-alt" data-toggle="tooltip" title="Lihat Data"></span></a>'+ "&nbsp"+"&nbsp"+
								'<a class="btn btn-info '+ status +'"" href="<?=ROOT?>npkbilling/request_bm/update/'+abc.bm_id+'" data-toggle="tooltip" title="Update Data"><span class="glyphicon glyphicon-edit"></span></a>'+
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
			$.blockUI();
			$('#modal-default').modal('hide');
			$.ajax({
				type: "GET",
				url: "<?=ROOT?>npkbilling/request_bm/send/"+id,
				success: function(data){
					$.unblockUI();
					var json 	= JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);
						no_req = resp.no_req;
						
						if(resp.Success == true){
							alert('Request berhasil terkirim..');
							sendBM_log(no_req);

							window.location = "<?=ROOT?>npkbilling/request_bm";
						}
						else{
							alert(resp.result_msg);
						}
					}
				}
			})
		}

	function sendBM_log(no_req) {
		
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/sendBM_log",
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