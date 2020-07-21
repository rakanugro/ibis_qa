
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
                        <i>(Please click create to make a new truck)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npkbilling/truckregistrasi/createTruck">
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
					<h2 class="pull-left">List Truck Registration</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th>NO</th>
									<th >TID</th>
									<th >CUSTOMER NAME</th>
									<th >RFID CODE</th>
									<th >TYPE KENDARAAN</th>
									<th >PLAT NUMBER</th>
									<th >TANGGAL EXPIRED</th>
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
		   	url: "<?=ROOT?>npkbilling/truckregistrasi/getListTruck?",
	    	data: {},
		    success: function(data){
		    	console.log(data);
				var obj = JSON.parse(JSON.parse(data));
	 	  		var arr =[];
	 			var jmlresponse = obj['result']['length'];
				
				for(i=0;i<jmlresponse;i++)
				{
					var no 			 		= 1;
					var truck_id          	=obj['result'][i]['truck_id'];
					var truck_cust_name     =obj['result'][i]['truck_cust_name'];
					var truck_rfid          =obj['result'][i]['ruck_rfid'];
					var truck_type     		=obj['result'][i]['truck_type'];
					var truck_plat_no       =obj['result'][i]['truck_plat_no'];
					var truck_plat_exp      	=obj['result'][i]['truck_plat_exp'];
				}
				obj['result'].forEach(function(abc) {
				    table.append(
				       '<tr>' +
							'<td>'+ no++ +'</td>' +
						    '<td>'+ abc.truck_id +'</td>' +
						    '<td>'+ abc.truck_cust_name +'</td>' +
						    '<td>'+ abc.truck_rfid +'</td>' +
						    '<td>'+ abc.truck_type +'</td>' +
						    '<td>'+ abc.truck_plat_no +'</td>' +
						    '<td>'+ abc.truck_plat_exp +'</td>' +
						    '<td>'+
								'<a class=\'btn btn-danger\' data-toggle="tooltip" title="Edit Data" href="<?=ROOT?>npkbilling/truckregistrasi/getUpdateregistrasi?vtruck='+abc.truck_id+'"><span class="glyphicon glyphicon-edit"></span></a>'+
							'</td>'+
						'</tr>'
			        );

		       });
		 
		           $("#example1").DataTable();
		           $.unblockUI();
		    }
		});
	});

</script>