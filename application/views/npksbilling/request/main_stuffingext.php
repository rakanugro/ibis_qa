
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
                        <i>(Please click create to make a new Extention Stuffing)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npksbilling/stuffingext/create_stuffingext">
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
					<h2 class="pull-left">List Extention Stuffing</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th>NO</th>
									<th >NOMOR REQUEST</th>
									<th >REQUEST DATE</th>
									<th >REQUEST NUMBER</th>
									<th >TANGGAL REQUEST</th>
									<th >CARGO OWNER</th>
									<th >VESSEL</th>
									<th >STATUS</th>
									<th >MARK</th>
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
	</div>
</div>
					
<script>
	$(document).ready(function() {
		//$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/stuffingext/getList?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
		    	var no = 1;
				obj.result.forEach(function(rec) {
					var mark = (rec.stuff_msg)? rec.stuff_msg : "";
					var status = (rec.stuff_status == 3 || rec.stuff_status == 2 || rec.stuff_status == 5)? "disabled" : "";
					var tanggal = (rec.stuff_ext_from_date != null)? rec.stuff_ext_from_date : "";
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>'+ rec.stuff_no +'</td>' +
						    '<td>'+ rec.stuff_date +'</td>' +
						    '<td>'+ rec.stuff_ext_from +'</td>' +
						    '<td>'+ tanggal +'</td>' +
						    '<td>'+ rec.stuff_cust_name +'</td>' +
						    '<td>'+ rec.stuff_vessel_name +'</td>' +
						    '<td style="font-weight:bold;"> '+ rec.reff_name +'</td>' +
						    '<td>'+ mark +'</td>' +
							'<td>'+
								'<a class="btn btn-success open-AddBookDialog '+status+'" href="#" data-id="'+rec.stuff_id+'" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-send"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
								'<a class="btn btn-primary" href="<?=ROOT?>npksbilling/stuffingext/view/'+rec.stuff_id +'"><span class="glyphicon glyphicon-list-alt"></span></a>'+ "&nbsp"+"&nbsp"+
								'<a class="btn btn-danger '+status+'" href="<?=ROOT?>npksbilling/stuffingext/getUpdateList/'+rec.stuff_id+'"><span class="glyphicon glyphicon-edit"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
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
			//console.log(id);
			$('#modal-default').modal('hide');
			$.ajax({
				type: "GET",
				url: "<?=ROOT?>npksbilling/stuffingext/send/"+id,
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);

						if(resp.Success == true){
							alert('Request berhasil terkirim..');
							sendstuffingext_log(resp.no_req);

							window.location = "<?=ROOT?>npksbilling/stuffingext";
						}
						else{
							alert(resp.result_msg);
						}
					}
				}
			})
		}

		function sendstuffingext_log(no_req) {
			$.ajax({
				url: "<?=ROOT?>npksbilling/transaction_log/sendstuffingext_log",
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