
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
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Invoice</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th>NO</th>
									<th >NOMOR REQUEST</th>
									<th >NOMOR NOTA</th>
									<th >NOMOR FAKTUR</th>
									<th >DEBITUR</th>
									<th >TANGGAL NOTA</th>
									<th >STATUS</th>
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
					
<script>  


	$('[data-toggle="tooltip"]').tooltip();
	$(document).ready(function() { 
		$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/invoice/getListInvoice?",
	    	data: {},
		    success: function(data){
		    	console.log(data);
				var obj = JSON.parse(JSON.parse(data));
	 	  		var arr =[];
	 			var jmlresponse = obj['result']['length'];
				
				for(i=0;i<jmlresponse;i++)
				{
					var no 			 	= 1;
					var nota_id     	=obj['result'][i]['nota_id'];
					var nota_req_no     =obj['result'][i]['nota_req_no'];
					var nota_no         =obj['result'][i]['nota_no'];
					var nota_faktur_no 	=obj['result'][i]['nota_faktur_no'];
					var nota_cust_name  =obj['result'][i]['nota_cust_name'];
					var nota_date       =obj['result'][i]['nota_date'];
					var reff_name       =obj['result'][i]['nota_cust_name'];
				}
				obj['result'].forEach(function(abc) {
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>'+ abc.nota_req_no +'</td>' +
						    '<td>'+ abc.nota_no +'</td>' +
						    '<td>'+ abc.nota_faktur_no +'</td>' +
						    '<td>'+ abc.nota_cust_name +'</td>' +
						    '<td>'+ abc.nota_date +'</td>' +
						    '<td>'+ '<b style="color:blue;">' +abc.reff_name +'</b>'+'</td>' +
						    '<td style="font-size: 15.7px;">'+
								'<a class="btn btn-danger print-log" data-id="'+abc.nota_req_no+'" target="_blank" data-toggle="tooltip" title="Print Data" href="<?=ROOT?>npkbilling/invoice/getdatacetak?vnota='+abc.nota_no+'"><span class="glyphicon glyphicon-print"></span></a>'+
							'</td>'+
						'</tr>'
			        );

		       });
		 
		           $("#example1").DataTable();
		           $.unblockUI();
		    }
		});

		$(document).on("click", ".print-log", function () {
			var id = $(this).data('id');
			print_invoice_log(id); 
		});
	});


		function print_invoice_log(id) {
			$.ajax({
				url: "<?=ROOT?>npkbilling/transaction_log/print_invoice_log",
				type: 'POST',
				//dataType: 'json',
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					no_req 			: id,

				},
				success: function( data ) {
					console.log(data);
				}
			});
		}
</script>