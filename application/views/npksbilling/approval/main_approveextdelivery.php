
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
					<h2 class="pull-left">List Approval Extension Delivery Container</h2>
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
					
<script>
	$(document).ready(function() {
		$.blockUI();
		var table = $("#example1 tbody");

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/approveextdelivery/getList?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
		    	var no = 1;
				obj.result.forEach(function(rec) {
					var mark = (rec.del_msg)? rec.del_msg : "";
					var status = (rec.del_status == 3 || rec.del_status == 2)? "disabled" : "";
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>'+ rec.del_no +'</td>' +
						    '<td>'+ rec.del_date +'</td>' +
						    '<td>'+ rec.del_cust_name +'</td>' +
						    '<td>'+ rec.del_vessel_name +'</td>' +
						    '<td style="font-weight:bold;"> '+ rec.reff_name +'</td>' +
						    '<td>'+ mark +'</td>' +
							'<td>'+
								'<a class="btn btn-danger" href="<?=ROOT?>npksbilling/approveextdelivery/view/'+rec.del_id +'"><span class="glyphicon glyphicon-list-alt"></span></a>'+ "&nbsp"+"&nbsp"+
						'</tr>'
			        );

		       });
		 
		           $("#example1").DataTable();
		           $.unblockUI();
		    }
		});
	});
</script>