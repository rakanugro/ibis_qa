
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
	
	<!-- <div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
                    
				</header>	
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npkbilling/payment/create_bm">
						<button type="submit" id="submit_form" onclick="" class="btn btn-success">iPay</button>
					</form>
				</div>
			</div>
		</div>	
	</div> -->
						
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Payment</h2>
					<br><br>
					<table>
						<tr>
							<td bgcolor="#6fcaf7" width="35px">&nbsp;</td>
							<td width="15px">:</td>
							<td width="35px">Nota</td>
						</tr>
						<tr>
							<td bgcolor="#e7e7e7" width="35px">&nbsp;</td>
							<td width="15px">:</td>
							<td width="35px">Uper</td>
						</tr>
					</table>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="table_payment_cash">
							<thead>
								<tr>
									<th>NO</th>
									<th>REQUEST NUMBER</th>
									<th>VESSEL - VOYAGE</th>
									<th>POST - TERMINAL</th>
									<th>REQUEST DATE</th>
									<th>STATUS</th>
                                    <th>ACTION</th>
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
	$(document).ready(function() {
		//$.blockUI();
		var table = $("#table_payment_cash tbody");

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/payment_cash/getListPaymentCash?",
	    	data: {},
		    success: function(data){
                var data_fix = JSON.parse(data);
				var obj_nota_list = JSON.parse(JSON.parse(data_fix['NotaList']));
				var obj_uper_list = JSON.parse(JSON.parse(data_fix['UperList']));
				var no = 1;

				if (obj_nota_list['count'] > 0){
					for(var a = 0; a < obj_nota_list['count']; a++){
						if (obj_nota_list['result'][a]['nota_paid'] == 'N'){
							var status_nota_paid = '<span class="label label-danger">Not Paid</span>';
						}else{
							var status_nota_paid = '<span class="label label-success">Paid</span>';
						}
						table.append(
						'<tr style="background-color:#6fcaf7">' +
								'<td>'+ no++ +'</td>' +
								'<td>'+ obj_nota_list['result'][a]['nota_req_no'] +'</td>' +
								'<td>'+ obj_nota_list['result'][a]['nota_vessel_name'] +'</td>' +
								'<td>'+ obj_nota_list['result'][a]['nota_terminal'] +'</td>' +
								'<td>'+ obj_nota_list['result'][a]['nota_date'] +'</td>' +
								// '<td>'+ obj_nota_list['result'][a]['nota_status'] + ' ' + obj_nota_list['result'][a]['nota_paid'] +'</td>' +
								'<td>'+ status_nota_paid + '</td>' +
								'<td>'+
									'<a class=\'btn btn-success print-log\' data-id="'+ obj_nota_list['result'][a]['nota_req_no']+'" href="<?=ROOT?>npkbilling/payment_cash/view_payment_cash/'+obj_nota_list['result'][a]['nota_id']+'-'+'nota'+'"><span class="glyphicon glyphicon-search"></span></a>'+ 
								'</td>'+
							'</tr>'
						);
					}
				}

				if (obj_uper_list['count'] > 0){
					for(var a = 0; a < obj_uper_list['count']; a++){
						if (obj_uper_list['result'][a]['uper_paid'] == 'N'){
							var status_uper_paid = '<span class="label label-danger">Not Paid</span>';
						}else{
							var status_uper_paid = '<span class="label label-success">Paid</span>';
						}
						table.append(
						'<tr style="background-color:#e7e7e7">' +
								'<td>'+ no++ +'</td>' +
								'<td>'+ obj_uper_list['result'][a]['uper_req_no'] +'</td>' +
								'<td>'+ obj_uper_list['result'][a]['uper_vessel_name'] +'</td>' +
								'<td>'+ obj_uper_list['result'][a]['uper_terminal_code'] + ' - ' + obj_uper_list['result'][a]['uper_terminal_name'] +'</td>' +
								'<td>'+ obj_uper_list['result'][a]['uper_date'] +'</td>' +
								// '<td>'+ obj_uper_list['result'][a]['uper_status'] + ' ' + obj_uper_list['result'][a]['uper_paid'] +'</td>' +
								'<td>'+ status_uper_paid + '</td>' +
								'<td>'+
									'<a class=\'btn btn-success print-log\' data-id="'+obj_uper_list['result'][a]['uper_req_no']+'" href="<?=ROOT?>npkbilling/payment_cash/view_payment_cash/'+obj_uper_list['result'][a]['uper_id']+'-'+'uper'+'"><span class="glyphicon glyphicon-search"></span></a>'+ 
								'</td>'+
							'</tr>'
						);
					}
				}

                $("#table_payment_cash").DataTable();
               // $.unblockUI();
		    }
		});

		$(document).on("click", ".print-log", function () {
			var id = $(this).data('id');
			cash_uper(id); 
		});
	});


		function cash_uper(id) {
			$.ajax({
				url: "<?=ROOT?>npkbilling/transaction_log/cash_uper",
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