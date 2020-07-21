<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_?>js/sweetalert2/dist/sweetalert2.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>js/sweetalert2/dist/sweetalert2.min.css"/>
<!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<style type="text/css">
.separate_content {
	width:31%;
    height:100px;
    border:1px solid red;
    margin-right:10px;
    float:left;
}

.btn_click{
	cursor: pointer;
	background: #cdcdcd;
	padding: 7px;
	border-radius: 20%;
	font-size: 13px;
	color: #000;
}

.glyphicon:hover{
	font-size: 15px;
	background: #717171;
}
</style>

<div>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> Header</h2>
				</header>
				<div class="main-box-body clearfix">
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Request ID</label>
						<input type="text" class="form-control" id="LUMPS_NO" name="request_id"  placeholder="Request ID">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Tanggal Request</label>
						<input type="text" class="form-control" id="LUMPS_DATE" name="tgl_request"  placeholder="tanggal request">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Nomor Kontrak</label>
						<input type="text" class="form-control" id="LUMPS_CONTRACT_NO" name="Nomor_Kontrak"  placeholder="">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Customer</label>
						<input type="text" class="form-control" id="LUMPS_CUST_NAME" name="customer_name"  placeholder="Customer">
					</div>										
					<div class='col-lg-12'>
						<label for="exampleAutocomplete">NPWP Customer</label>
						<input type="text" class="form-control" id="LUMPS_CUST_NPWP" name="npwp_customer"  placeholder="">
					</div>				
					
					<div class='col-lg-12'>
						<label for="exampleAutocomplete">Alamat Customer</label>
						<input type="text" class="form-control" id="LUMPS_CUST_ADDRESS" name="alamat_customer"  placeholder="">
					</div>
					<div class='col-lg-12'>
						<label for="exampleAutocomplete">Tipe Perdagangan</label>
						<input type="text" class="form-control" id="LUMPS_BOOKING_TYPE_NAME" name="tipe_perdagangan"  placeholder="">
					</div>
					</div>			
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="row" id="international_content">
	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> International</h2>
				</header>
				
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Nomor PEB/PIB</label>
						<input type="text" class="form-control" id="LUMPS_PIB_PEB_NO" name="no_peb"  placeholder="Nomor PEB/PIB">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
						<input type="text" class="form-control" id="LUMPS_PIB_PEB_DATE" name="tgl_peb"  placeholder="tanggal PEB/PIB">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Nomor NPE/SPPB</label>
						<input type="text" class="form-control" id="LUMPS_NPE_SPPB_NO" name="no_npe"  placeholder="Nomor NPE/SPPB">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> Detail</h2>
				</header>


			<div class="col-lg-12">
				<div class="main-box clearfix">
				    <div class="main-box-body clearfix">
					 	<div class="table-responsive">
					  		<table class="table table-striped table-hover table-bordered" id="detail">
							  	<thead>
							    	<tr>
								      	
								      	<th scope="col">Nomor BL</th>
								      	
								      	<th scope="col">Kemasan</th>
								      	
								      	<th scope="col">Quantity</th>
								      	<th scope="col">Satuan</th>
								      	
								      	<!--<th scope="col" >ACTION</th>-->
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
	</div>
</div>

<div class="form-group example-twitter-oss" align="right">
		<a onclick="save_approval('approve')" class="btn btn-sm btn-danger">APPROVE</a>
		<a onclick="show_reject('reject')" class="btn btn-sm btn-primary">REJECT</a>
	</div>

<!-- Modal reject -->
<div class="modal fade" id="modal_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Input Remarks</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea class="form-control" id="alasan_reject" name="alasan_reject"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" onclick="save_approval('reject',$('#alasan_reject').val())" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function show_reject(){
		$('#modal_reject').modal();
	}

	function save_approval(action, remarks)
	{
		var text = '';
		var urlaction = "";
		if (action == 'approve'){
			urlaction = "<?php echo ROOT ?>npkbilling/approval_lumpsum/ApprovalNow/<?php echo $id_param; ?>";
		}else{
			urlaction = "<?php echo ROOT ?>npkbilling/approval_lumpsum/RejectNow/<?php echo $id_param; ?>";
		}
		if (action == 'approve'){
			text = "Apakah Anda Yakin Approve Data Ini ?";
			Swal.fire({
				title: text,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak'
			}).then((result) => {
				if (result.value) {
					$.blockUI();
					$.ajax({
						url: urlaction,
						type: 'GET',
						dataType: 'json',
						success: function(data) {
							var array_data = JSON.parse(data);
							var result = array_data['result'];
							Swal.fire({
								icon: 'success',
								title: 'Success, Approved Request ' + result[0]['lumps_no'],
								showConfirmButton: false,
								timer: 1500
							})
							setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/approval_lumpsum"; }, 1000);	
						}
					});
				}
			});
		}else{
			$.ajax({
				url: urlaction,
				type: 'POST',
		        dataType: 'json',
		        data: {
		            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		            remarks: remarks
		        },
				success: function(data) {
					var array_data = JSON.parse(data);
					var result = array_data['result'];

					$('#modal_reject').modal('hide');
					Swal.fire({
						icon: 'success',
						title: 'Success, Rejected Request ' + result[0]['lumps_no'],
						showConfirmButton: false,
						timer: 1500
					})
					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/approval_lumpsum"; }, 1000);	
				}
			});
		}

	}


	$(function() {
    $('#tgl_request').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

	$(function() {
    $('#eta').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

$(function() {
    $('#etd').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

$(function() {
    $('#etb').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

$(function() {
    $('#actual_departure').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

$(function() {
    $('#final_destination').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });


	//$("#detail").DataTable();
	//$("#sewa_alat").DataTable();
	//$("#retribusi_alat").DataTable();

	$("#international_content").hide();
	$("#tipe_perdagangan").change(function(){
   if($(this).val()=="International")
   {    
       $("#international_content").show();
   }
    else
    {
        $("#international_content").hide();
    }
});

	$.ajax({

      url: "<?=ROOT?>npkbilling/approval_lumpsum/getListApprovalPreview?id="+<?php echo $id_param;?>,
      type: "GET",
      dataType : 'json',
      success: function (data) {
        console.log(data);

        var  data = JSON.parse(data);
         console.log(data);
        var  head = data.HEADER[0];
        //console.log(data.HEADER);
        $('input#LUMPS_NO').val(head.lumps_no);
        $('input#LUMPS_DATE').val(head.lumps_date);
        $('input#LUMPS_CONTRACT_NO').val(head.lumps_contract_no);
        $('input#LUMPS_CUST_NAME').val(head.lumps_cust_name);
         $('input#LUMPS_CUST_NPWP').val(head.lumps_cust_npwp);
          $('input#LUMPS_CUST_ADDRESS').val(head.lumps_cust_address);
           $('input#LUMPS_BOOKING_TYPE_NAME').val(head.lumps_booking_type_name);
        $('input#LUMPS_TERMINAL_NAME').val(head.lumps_terminal_name);
        
        $('input#LUMPS_NO').val(head.lumps_no);
        $('input#LUMPS_PBM_NAME').val(head.lumps_pbm_name);
        $('input#LUMPS_TRADE_NAME').val(head.lumps_trade_name);
        $('input#LUMPS_TERMINAL_NAME').val(head.lumps_terminal_name);
        $('input#LUMPS_SHIPPING_AGENT_NAME').val(head.lumps_shipping_agent_name);
        $('input#LUMPS_VESSEL_NAME').val(head.lumps_vessel_name);
        $('input#LUMPS_KADE').val(head.lumps_kade);
        $('input#LUMPS_VOYIN').val(head.lumps_voyin);
        $('input#LUMPS_VOYOUT').val(head.lumps_voyout);
        $('input#LUMPS_ETA').val(head.lumps_eta);
        $('input#LUMPS_ETD').val(head.lumps_etd);
        $('input#LUMPS_ETB').val(head.lumps_etb);
        $('input#LUMPS_ATD').val(head.lumps_atd);
        $('input#LUMPS_ATA').val(head.lumps_ata);
        $('input#LUMPS_PIB_PEB_NO').val(head.lumps_pib_peb_no);
        $('input#LUMPS_PIB_PEB_DATE').val(head.lumps_pib_peb_date);
        $('input#LUMPS_NPE_SPPB_NO').val(head.lumps_npe_sppb_no);


        data.FILE.forEach(function(row) {
        	//console.log(row);
		        $( "#document" ).append( 'doc_no : '+ '<input type="text" value= '+row.doc_no+'>');
		        $( "#document" ).append( ' ');
		        $( "#document" ).append( ' ');
		        $( "#document" ).append( ' ');
		       $( "#document" ).append( 'doc_path : <a href = "<?=apiUrl; ?>/' + row.doc_path + '" > '+ row.doc_name +'</a>');
        });

        var table = $("#detail tbody");
        data.DETAIL.forEach(function(abc) {
				    table.append(
				       '<tr>' +

								
						     //'<td>'+ abc.dtl_lumps_id +'</td>' +
						    '<td>'+ abc.dtl_bl +'</td>' +
						    '<td>'+ abc.dtl_pkg_name +'</td>' +
						    '<td>'+ abc.dtl_qty +'</td>' +
						    '<td>'+ abc.dtl_unit_name +'</td>' +
						    
						    
								
						'</tr>'
			        );

		       });

         var table = $("#sewa_alat tbody");
        data.ALAT.forEach(function(abc) {
        	
				    table.append(
				       '<tr>' +

								
						     '<td>'+ abc.eq_type_name +'</td>' +
						    '<td>'+ abc.eq_unit_name +'</td>' +
						    '<td>'+ abc.eq_qty +'</td>' +
						    '<td>'+ abc.package_name +'</td>' +
						    
								
						'</tr>'
			        );
        	

		       });


         var table = $("#retribusi_alat tbody");
        data.ALAT.forEach(function(abc) {
        	
				    table.append(
				       '<tr>' +

								
						    '<td>'+ abc.dtl_lumps_id +'</td>' +
						    '<td>'+ abc.dtl_lumps_bl +'</td>' +
						    '<td>'+ abc.dtl_lumps_tl +'</td>' +
						    '<td>'+ abc.dtl_cmdt_name +'</td>' +
						    '<td>'+ abc.dtl_unit_name +'</td>' +
						    '<td>'+ abc.dtl_cont_size +'</td>' +
						    '<td>'+ abc.dtl_cont_status +'</td>' +
						    '<td>'+ abc.dtl_status +'</td>' +
						    '<td>'+ abc.dtl_character_name +'</td>' +
						    '<td>'+ abc.dtl_qty +'</td>' +
						    '<td>'+ abc.dtl_create_date+'</td>' +
								
						'</tr>'
			        );
				

		       });




      },
      error: function (xhr, status, msg) {
        alert('Status: ' + status + "\n" + msg);
      }
    })
	
</script>