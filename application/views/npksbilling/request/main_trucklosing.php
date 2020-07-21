
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
</style>
						
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2>Create New</h2>
                    <i>(Please click create to make a new Truck Loosing request)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npksbilling/trucklosing/create_trucklosing">
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
					<h2 class="pull-left">List Truck Loosing</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th >NO</th>
									<th >NOMOR REQUEST</th>
									<th >TANGGAL REQUEST</th>
									<th >CARGO OWNER</th>
									<th >VESSEL</th>
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
		   	url: "<?=ROOT?>npksbilling/trucklosing/getList?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
		    	var no = 1;
		    	if (obj == null) {
		    		alert("ESB not Connected");
		    	}else{

					obj.result.forEach(function(rec) {
						var mark = (rec.tl_msg)? rec.tl_msg : "";
						var status = (rec.tl_status == 3 || rec.tl_status == 2 || rec.tl_status == 5)? "disabled" : "";
					    table.append(
					       '<tr>' +
								'<td>'+ no++ +'</td>' +
							    '<td>'+ rec.tl_no +'</td>' +
							    '<td>'+ rec.tl_date +'</td>' +
							    '<td>'+ rec.tl_cust_name +'</td>' +
							    '<td>'+ rec.tl_vessel_name +'</td>' +
							    '<td style="font-weight:bold;"> '+ rec.reff_name +'</td>' +
							    '<td>'+ mark +'</td>' +
								'<td>'+
									'<a class="btn btn-success open-AddBookDialog '+status+'" href="#" data-id="'+rec.tl_id+'" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-send"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
									'<a class="btn btn-primary" href="<?=ROOT?>npksbilling/trucklosing/view/'+rec.tl_id +'"><span class="glyphicon glyphicon-list-alt"></span></a>'+ "&nbsp"+"&nbsp"+
									'<a class="btn btn-danger '+status+'" href="<?=ROOT?>npksbilling/trucklosing/update/'+rec.tl_id+'"><span class="glyphicon glyphicon-edit"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
								'</td>'+
							'</tr>'
				        );

			       });	
		    	}
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
				url: "<?=ROOT?>npksbilling/trucklosing/send/"+id,
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);

						if(resp.Success == true){
							alert('Request berhasil terkirim..');
							sendtrucklosing_log(resp.no_req);

							window.location = "<?=ROOT?>npksbilling/trucklosing";
						}
						else{
							alert(resp.result_msg);
						}
					}
				}
			})
		}

		function sendtrucklosing_log(no_req) {
			$.ajax({
				url: "<?=ROOT?>npksbilling/transaction_log/sendtrucklosing_log",
				type: 'POST',
				//dataType: 'json',
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					no_req 			: no_req

				},
				success: function( data ) {
					if (data !=null) {
						console.log('Data Tersimpan ke LOG')
					}

				}
			});
		}
	});
</script>