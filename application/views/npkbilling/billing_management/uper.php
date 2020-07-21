
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>
<script src="<?=CUBE_?>js/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />


<style type="text/css">

.upload_info {
    font-size: small;
    font-style: italic;
    float: right;
}
.hidden_content {
	display: none;
}
</style>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Uper</h2>
									
					<div id="reportrange" class="pull-right daterange-filter">
						<i class="icon-calendar"></i>
						<span></span> <b class="caret"></b>
					</div>
				</header>
									
				<div class="main-box clearfix">
					<div class="modal-body">
						<table id="example1" class="table table-striped table-hover" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>REQUEST NUMBER</th>
									<th>UPER NUMBER</th>
									<th>DEBITUR</th>
									<th>UPER DATE</th>
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

	<div class="modal fade" id="modal-printuper" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Print Uper<span></span></h4>
				</div>
				<div class="modal-body pop-up-body clearfix">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");
		//var apiUrl = 'http://10.88.48.33/';

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/uper/getListUper?",
	    	data: {},
	    	headers: {
	    		'token':'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJiZWFyZXIiLCJzdWIiOiIxMiIsImV4cCI6MTU3NDQxNDUxM30.FBPMmx4HfqkK-O857zlycRzdjOyaSJvEPeHQsUjGy3g',
	    	},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
	 	  		var arr =[];
	 			var jmlresponse = obj['length'];
		    	// console.log(data);
	 			// console.log(obj);
	 			// console.log(jmlresponse);
				
				var no = 1;
				obj['result'].forEach(function(abc) {
					if (abc.uper_paid != 'Y') {
						var isDisabled = 'disabled';
					} 
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>'+ abc.uper_req_no +'</td>' +
						    '<td>'+ abc.uper_no +'</td>' +
						    '<td>'+ abc.uper_cust_name +'</td>' +
						    '<td>'+ abc.uper_date +'</td>' +
						    '<td>'+ abc.reff_name +'</td>' +
						    '<td>'+
								'<a class=\'btn btn-danger\'  href="<?=ROOT?>npkbilling/uper/view_uper/'+ abc.uper_id +'"><span class="glyphicon glyphicon-eye-open" title="View Detail Uper"></span></a>'+ "&nbsp"+
								'<a class=\'btn btn-success print_log\' data-id="'+abc.uper_req_no+'" target="_blank"  href="<?=apiUrl?>/print/uper2/'+ abc.uper_id +'" title="Print Uper"><span class="glyphicon glyphicon-print"></span></a>'+ "&nbsp"+
								'<a class=\'btn btn-primary print_log\' data-id="'+abc.uper_req_no+'" target="_blank"  href="<?=apiUrl?>/print/uperPaid2/'+ abc.uper_no +'" '+ isDisabled +' title="Print Bukti Bayar"><span class="glyphicon glyphicon-list-alt"></span></a>'+ "&nbsp"+
							'</td>'+
						'</tr>'
			        );

		       	});
		 
				$("#example1").DataTable();
				$.unblockUI();
		    }
		});

		$(document).on("click", ".print_log", function () {
			var id = $(this).data('id');
			print_uper_log(id); 
		});

	});

	function print_uper_log(id) {
		$.ajax({
			url: "<?=ROOT?>npkbilling/transaction_log/print_uper_log",
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

	function modalclick(){
		$('#modal-printuper').modal('toggle');
	}
</script>
