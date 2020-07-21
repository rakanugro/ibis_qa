
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
                        <i>(Please click create to make a new Batal Fumigasi)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npksbilling/fumigasibatal/create_fumigasibatal">
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
					<h2 class="pull-left">List Batal Fumigasi</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="example1">
							<thead>
								<tr>
									<th>NO</th>
									<th >NOMOR REQUEST</th>
									<th >NOMOR REQUEST REFF</th>
									<th >TANGGAL REQUEST</th>
									<th >CARGO OWNER</th>
									<th >VESSEL</th>
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

<script type="text/javascript">
	
	$(document).ready(function() {
	    var table = $("#example1 tbody");
		//var booking_type = 'receiving';

		$.ajax({
		    type: "GET",

		   	url: "<?=ROOT?>npksbilling/fumigasibatal/getListfumigasibatal",
	    	data: {},  // <== change is here
		    success: function(data){

		    	//console.log(data);
		    	var obj = JSON.parse(JSON.parse(data));
		    	console.log(obj);
		    	var arr =[];
	            var jmlresponse = obj['length'];
	            //alert(jmlresponse);
	           var no = 1;

				obj['result'].forEach(function(abc) {
					if(abc.cancelled_status == "1") abc.cancelled_status = "DRAFT"; 
					if(abc.cancelled_status == "2") abc.cancelled_status = "SEND";
					if(abc.cancelled_status == "9") abc.cancelled_status = "CANCEL";
					if(abc.cancelled_status == "4") abc.cancelled_status = "REJECT";
					var status = ((abc.cancelled_status != "DRAFT") && (abc.cancelled_status != "REJECT")) ? "disabled" : "";
				    table.append(
				       '<tr>' +
							
							'<td>'+ no++ +'</td>' + 
							
						    '<td>'+ abc.cancelled_no +'</td>' +
						    '<td>'+ abc.cancelled_req_no +'</td>' +
						    
						    '<td>'+ abc.cancelled_create_date +'</td>' +
						    '<td>'+ abc.fumi_cust_name +'</td>' +
						    '<td>'+ abc.fumi_vessel_name +'</td>' +
						    '<td>'+ abc.cancelled_status +'</td>' +
						    '<td>'+
						    	'<a class="btn btn-success open-AddBookDialog '+status+'" href="#" data-id="'+abc.cancelled_id+'" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-send"></span></a>'+ "&nbsp"+"&nbsp"+"&nbsp"+
						    	'<a class=\'btn btn-danger\'  href="<?=ROOT?>npksbilling/fumigasibatal/view/'+abc.cancelled_id+'" ><span class="glyphicon glyphicon-list-alt"></span></a>'+"&nbsp"+"&nbsp"+"&nbsp"+ 
								'<a class="btn btn-primary '+status+'"   href="<?=ROOT?>npksbilling/fumigasibatal/edit_fumigasibatal/'+abc.cancelled_id+'" ><span class="glyphicon glyphicon-edit"></span></a>'+
								
								//'<a class=\'btn btn-primary\'  href="<?=ROOT?>"><span class="glyphicon glyphicon-trash"></span></a>'+
								
							'</td>'+
						'</tr>'
			        );

		       });
		 
		           $("#example1").DataTable();
		           $.unblockUI();
		    }
				
				
		

	});
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
				url: "<?=ROOT?>npksbilling/fumigasibatal/send/"+id,
				success: function(data){
					$.unblockUI();
					var json = JSON.parse(data);
					if(json.success == "S"){
						resp = JSON.parse(json.data);

						if(resp.Success == true){
							alert('Request berhasil terkirim..');

							window.location = "<?=ROOT?>npksbilling/fumigasibatal";
						}
						else{
							alert(resp.result_msg);
						}
					}
				}
			})
		}
</script>