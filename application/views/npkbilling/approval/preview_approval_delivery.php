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
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete">Request ID</label>
						<input type="text" class="form-control" id="DEL_ID" name="request_id"  placeholder="">
					</div>
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete">Customer</label>
						<input type="text" class="form-control" id="DEL_CUST_NAME" name="customer_name"  placeholder="Customer">
					</div>										
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Terminal</label>
						<input type="text" class="form-control" id="DEL_TERMINAL_NAME" name="terminal_name"  placeholder="">
					</div>				
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Tanggal Request</label>
						<input type="text" class="form-control" id="DEL_DATE" name="tgl_request"  placeholder="tanggal request">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Nomor Request</label>
						<input type="text" class="form-control" id="DEL_NO" name="no_request"  placeholder="nomor request">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Tipe perdagangan</label>
						<input type="text" class="form-control" id="DEL_TRADE_NAME" name="trade_name"  placeholder="">
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
						<input type="text" class="form-control" id="DEL_PIB_PEB_NO" name="no_peb"  placeholder="Nomor PEB/PIB">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
						<input type="text" class="form-control" id="DEL_PIB_PEB_DATE" name="tgl_peb"  placeholder="tanggal PEB/PIB">
					</div>
					<div class='col-lg-6'>
						<label for="exampleAutocomplete">Nomor NPE/SPPB</label>
						<input type="text" class="form-control" id="DEL_NPE_SPPB_NO" name="no_npe"  placeholder="Nomor NPE/SPPB">
					</div>
					<!--<div class='col-lg-6'>
						<label for="exampleAutocomplete">Booking Ship</label>
						<input type="text" class="form-control" id="booking_ship" name="booking_ship"  placeholder="booking_ship">
					</div>-->
				</div>
			</div>
		</div>
	</div>
</div>

<div>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> Vessel</h2>
				</header>
				<div class="main-box-body clearfix">
					<div class="form-group example-twitter-oss">
						<label for="exampleAutocomplete">Vessel</label>
						<input type="text" class="form-control" id="DEL_VESSEL_NAME" name="vessel_name"  placeholder="Vessel">
					</div>										
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">Kade</label>
						<input type="text" class="form-control" id="DEL_KADE" name="kade_name"  placeholder="kade">
					</div>				
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">Voyage in</label>
						<input type="text" class="form-control" id="DEL_VOYIN" name="voyage_in"  placeholder="voyage in">
					</div>
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">Voyage out</label>
						<input type="text" class="form-control" id="DEL_VOYOUT" name="voyage_out"  placeholder="voyage_out">
					</div>
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">ETA</label>
						<input type="text" class="form-control" id="DEL_ETA" name="eta"  placeholder="eta">
					</div>
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">ETD</label>
						<input type="text" class="form-control" id="DEL_ETD" name="etd"  placeholder="etd">
					</div>
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">ETB</label>
						<input type="text" class="form-control" id="DEL_ETB" name="etb"  placeholder="etb">
					</div>	
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">Actual Arrival</label>
						<input type="text" class="form-control" id="DEL_ATD" name="actual_arrival"  placeholder="actual arrival">
					</div>	
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">Actual Departure</label>
						<input type="text" class="form-control" id="DEL_ATA" name="actual_departure"  placeholder="actual departure">
					</div>
					<div class='col-lg-4'>
						<label for="exampleAutocomplete">Open Stack</label>
						<input type="text" class="form-control" id="DEL_OPEN_STACK" name="open_stack"  placeholder="open stack">
					</div>		
					<div class='col-lg-12'>
						<label for="exampleAutocomplete">UKK</label>
						<input type="text" class="form-control" id="DEL_UKK" name="del_ukk"  placeholder="">
					</div>			
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
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> Document</h2>
				</header>
				<div class="main-box-body clearfix" id="document">
					<!--<div class="col-lg-6">
						<label for="exampleAutocomplete">Nomer Dokumen</label>
						<input type="text" class="form-control" id="document_no" name="document_no"  placeholder="Nomor dokumen">

					</div>	
					<div class="col-lg-6">									
						<label for="exampleAutocomplete">Upload Dokumen</label>
						<input type="text" class="form-control" id="document_upload" name="document_upload"  placeholder="Upload dokumen">
					</div>-->
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
								      	<th scope="col">Cargo Owner</th>
								      	<th scope="col">Nomor BL</th>
								       	<th scope="col">Kemasan</th>
								      	<th scope="col">Barang</th>
								      	<th scope="col">Satuan</th>
								      	<th scope="col">Size</th>
								      	<th scope="col">Type</th>
								      	<th scope="col">Status</th>
								      	<th scope="col">Sifat</th>
								      	<th scope="col">Quantity</th>
								      	<th scope="col">Date in</th>
								      	<th scope="col">Date Out</th>
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



	<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> Alat</h2>
				</header>


			<div class="col-lg-12">
				<div class="main-box clearfix">
				    <div class="main-box-body clearfix">
					 	<div class="table-responsive">
					  		<table class="table table-striped table-hover table-bordered" id="sewa_alat">
							  	<thead>
							    	<tr>
								      	<th scope="col">Layanan</th>
								      	<th scope="col">Nama Alat</th>
								      	<th scope="col">Satuan</th>
								      	<th scope="col">Jumlah Alat</th>
								      	<th scope="col">Jumlah/ Durasi pemakaian</th>
								      	<th scope="col">Kemasan</th>
								      	
								      	
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


<div class="col-lg-12">
		<div class="main-box">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left"><span class="glyphicon glyphicon-folder-open"></span> Preview Uper</h2>
				</header>


			<div class="col-lg-12">
				<div class="main-box clearfix">
				    <div class="main-box-body clearfix">
					 	<div class="table-responsive">
					  		<table class="table table-striped table-hover table-bordered" id="penumpukan">
							  	<thead>	
							    	<tr>
							    		
								      	<th rowspan="2" scope="col">BL/SI/DO</th>
								      	<th rowspan="2" scope="col">Kemasan</th>
								      	<th rowspan="2" scope="col">Barang</th>
								      	<th rowspan="2" scope="col">QTY</th>
								      	<th rowspan="2" scope="col">Satuan</th>
								      	<th colspan="2" scope="col" class="text-center">Hari</th>
								      	<th colspan="2" scope="col" class="text-center">Tarif</th>
								      	<th rowspan="2" scope="col">Total</th>

								      	
								      	<!--<th scope="col" >ACTION</th>-->
							    	</tr>
							    		<th colspan="1">Massa 1</th>
							    		<th colspan="1">Massa 2</th>
							    		<th colspan="1">Massa 1</th>
							    		<th colspan="1">Massa 2</th>
							  		<tr>
							       </tr>
							  	</thead>
						  		<tbody>
								    
						  		</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="main-box clearfix">
				    <div class="main-box-body clearfix">
					 	<div class="table-responsive">
					  		<table class="table table-striped table-hover table-bordered" id="alat">
							  	<thead>
							  		
							    	<tr>
							    		
								      	<th scope="col">Layanan</th>
								      	<th scope="col">Nama Alat</th>
								      	<th scope="col">Satuan</th>
								      	<th scope="col">Jumlah Alat</th>
								      	<th scope="col">Jumlah /Durasi Pemakaian</th>
								      	<th scope="col">Tarif Dasar</th>
								      	<th scope="col">Total</th>
								      	
								      	
								      	
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


			
					

					<div class="main-box-body clearfix">
					<div class="col-xs-8">
						
					</div>
					<div class="col-xs-4" style="float: right;">
						<div class="form-group col-xs-12">
							<h2><label>Total</label></h2>
							
						</div>
						<div class="form-group col-xs-12">
							<label>DPP</label>
							<input name="UPER_DPP" id="UPER_DPP" type="text" style="text-align: right;" class="form-control" placeholder="DPP" readonly>
						</div>
						<div class="form-group col-xs-12">
							<label>PPN 10%</label>
							<input name="UPER_PPN" id="UPER_PPN" type="text" style="text-align: right;" class="form-control" placeholder="PPN" readonly>
						</div>
						<div class="form-group col-xs-12">
							<label>TOTAL UPER</label>
							<input name="UPER_AMOUNT" id="UPER_AMOUNT" type="text" style="text-align: right;" class="form-control" placeholder="TOTAL" readonly>
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
			urlaction = "<?php echo ROOT ?>npkbilling/approval_delivery/ApprovalNow/<?php echo $id_param; ?>";
		}else{
			urlaction = "<?php echo ROOT ?>npkbilling/approval_delivery/RejectNow/<?php echo $id_param; ?>";
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
							if (array_data['Success'] == undefined) {
								$.unblockUI();
								Swal.fire({
									icon: 'success',
									title: array_data['result'],
									showConfirmButton: false,
									timer: 1500
								})
								setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/approval_delivery"; }, 1000);	
							} else {
								if (array_data['Success'] == true){
									$.unblockUI();
									Swal.fire({
										icon: 'success',
										title: array_data['result'],
										showConfirmButton: false,
										timer: 1500
									})
									setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/approval_delivery"; }, 1000);
								}else{
									$.unblockUI();
									Swal.fire({
										icon: 'error',
										title: array_data['result'],
										showConfirmButton: false,
										timer: 1500
									})
								}
							}
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
					$('#modal_reject').modal('hide');
					if (array_data['Success'] == undefined) {
						$.unblockUI();
						Swal.fire({
							icon: 'success',
							title: array_data['result'],
							showConfirmButton: false,
							timer: 1500
						})
						setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/approval_delivery"; }, 1000);	
					} else {
						if (array_data['Success'] == true){
							$('#modal_reject').modal('hide');
							$.unblockUI();
							Swal.fire({
								icon: 'success',
								title: array_data['result'],
								showConfirmButton: false,
								timer: 1500
							})
							setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/approval_delivery"; }, 1000);
						}else{
							$.unblockUI();
							Swal.fire({
								icon: 'error',
								title: array_data['result'],
								showConfirmButton: false,
								timer: 1500
							})
						}
					}
				}
			});
		}

	}


	$(function() {
    $('#DEL_DATE').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

	$(function() {
    $('#DEL_PIB_PEB_DATE').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

	$(function() {
    $('#DEL_ETA').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

$(function() {
    $('#DEL_ETD').datepicker({
      //language: 'pt-BR'
      Default: 'mm/dd/yyyy'
    });
  });

$(function() {
    $('#DEL_ETB').datepicker({
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

	

	$.ajax({

      url: "<?=ROOT?>npkbilling/approval_delivery/getListApprovalPreview?id="+<?php echo $id_param;?>,
      type: "GET",
      dataType : 'json',
      success: function (data) {
        //console.log(data);

        var  data = JSON.parse(data);
         console.log(data);
        var  head = data.HEADER[0];
        //console.log(data.HEADER);
        $('input#DEL_ID').val(head.del_id);
        $('input#DEL_CUST_NAME').val(head.del_cust_name);
        $('input#DEL_TERMINAL_NAME').val(head.del_terminal_name);
        $('input#DEL_DATE').val(head.del_date);
        $('input#DEL_NO').val(head.del_no);
        $('input#DEL_PBM_NAME').val(head.del_pbm_name);
        $('input#DEL_TRADE_NAME').val(head.del_trade_name);
        $('input#DEL_TERMINAL_NAME').val(head.del_terminal_name);
        $('input#DEL_SHIPPING_AGENT_NAME').val(head.del_shipping_agent_name);
        $('input#DEL_VESSEL_NAME').val(head.del_vessel_name);
        $('input#DEL_KADE').val(head.del_kade);
        $('input#DEL_VOYIN').val(head.del_voyin);
        $('input#DEL_VOYOUT').val(head.del_voyout);
        $('input#DEL_ETA').val(head.del_eta);
        $('input#DEL_ETD').val(head.del_etd);
        $('input#DEL_ETB').val(head.del_etb);
        $('input#DEL_ATD').val(head.del_atd);
        $('input#DEL_ATA').val(head.del_ata);

        $('input#DEL_OPEN_STACK').val(head.del_open_stack);
        $('input#DEL_UKK').val(head.del_ukk);

        $('input#DEL_PIB_PEB_NO').val(head.del_pib_peb_no);
        $('input#DEL_PIB_PEB_DATE').val(head.del_pib_peb_date);
        $('input#DEL_NPE_SPPB_NO').val(head.del_npe_sppb_no);

         if(head.del_trade_name !="Internasional")
   {    
       $("#international_content").hide();
   }
    


        data.FILE.forEach(function(row) {
        	//console.log(row);
		        $( "#document" ).append( 'doc_no : '+ '<input type="text" value= ' + row.doc_no + '>');
		        $( "#document" ).append( ' ');
		        $( "#document" ).append( ' ');
		        $( "#document" ).append( ' ');
		        $( "#document" ).append( 'doc_path : <a href = "<?=apiUrl; ?>/'+ row.doc_path + '" > '+ row.doc_name +'</a>');
		        //console.log(apiUrl);
        });

        var table = $("#detail tbody");
        data.DETAIL.forEach(function(abc) {
        	if(abc.dtl_unit_name == null) abc.dtl_unit_name = "N/A";
        	 if(abc.dtl_cont_size == null) abc.dtl_cont_size = "N/A";
        	 if(abc.dtl_cont_status == null) abc.dtl_cont_status = "N/A";
        	 if(abc.dtl_status == null) abc.dtl_status = "N/A";

				    table.append(
				       '<tr>' +

								
						   	
						    '<td>'+ abc.dtl_cust_name +'</td>' +
						    '<td>'+ abc.dtl_del_bl +'</td>' +
						    '<td>'+ abc.dtl_pkg_name +'</td>' +
						    '<td>'+ abc.dtl_cmdty_name +'</td>' +
						    '<td>'+ abc.dtl_unit_name +'</td>' +
						    '<td>'+ abc.dtl_cont_size +'</td>' +
						    '<td>'+ abc.dtl_cont_status +'</td>' +
						    '<td>'+ abc.dtl_status +'</td>' +
						    '<td>'+ abc.dtl_character_name +'</td>' +
						    '<td>'+ abc.dtl_qty +'</td>' +
						    '<td>'+ abc.dtl_in+'</td>' +
						    '<td>'+ abc.dtl_out+'</td>' +
								
						'</tr>'
			        );

		       });

        data.ALAT.forEach(function(abc) {
        if(abc.package_name == null ) abc.package_name ="N/A";

        
        	 var table = $("#sewa_alat tbody");
        	
		    table.append(
		       '<tr>' +

					'<td>'+ abc.group_tariff_name +'</td>' +	
				     '<td>'+ abc.eq_type_name +'</td>' +
				    '<td>'+ abc.eq_unit_name +'</td>' +
				    '<td>'+ abc.eq_qty +'</td>' +
				     '<td>'+ abc.unit_qty +'</td>' +
				    '<td>'+ abc.package_name +'</td>' +
				    
						
				'</tr>'
	        );   
		
     		/*var table = $("#retribusi_alat tbody");
          	
			    table.append(
			       '<tr>' +

							
					    '<td>'+ abc.eq_type_name +'</td>' +
					    '<td>'+ abc.eq_unit_name +'</td>' +
					    '<td>'+ abc.eq_qty +'</td>' +
					    '<td>'+ abc.package_name +'</td>' +
					    
							
					'</tr>'
		        );*/
		

		 
  });




      },
      error: function (xhr, status, msg) {
        alert('Status: ' + status + "\n" + msg);
      }
    })

	
	
</script>
<script type="text/javascript">
	
$.ajax({

      url: "<?=ROOT?>npkbilling/approval_delivery/get_viewuper?id="+<?php echo $id_param;?>,
      type: "GET",
      dataType : 'json',
      success: function (data) {
      	//console.log(data)
        var data = JSON.parse(data);
        console.log(data);
        var  result = data.result[0];

         $('input#UPER_DPP').val(result.uper_dpp);
         $('input#UPER_PPN').val(result.uper_ppn);
      	 $('input#UPER_AMOUNT').val(result.uper_amount);

      	 //var Handling = data.Handling;
      	 var table = $("#penumpukan tbody");
      	 data.result[0].nota_view[0].Penumpukan.forEach(function(abc) {

      	 	 table.append(
				       '<tr>' +

								
						    '<td>'+ abc.no_bl +'</td>' +
						    '<td>'+ abc.package_name+'</td>' +
						    '<td>'+ abc.commodity_name +'</td>' +
						    '<td>'+ abc.qty +'</td>' +
						    '<td>'+ abc.unit_name +'</td>' +
						  	'<td>'+ abc.masa1 +'</td>' +
						  	'<td>'+ abc.masa2 +'</td>' +
							'<td>'+ abc.trf1 +'</td>' +	
							'<td>'+ abc.trf2 +'</td>' +
							'<td>'+ abc.dpp +'</td>' +

						'</tr>'
			        );


      	 });


      	 var table = $("#alat tbody");
      	 data.result[0].nota_view[1].Alat.forEach(function(abc) {

      	 	 table.append(
				       '<tr>' +

								
						    '<td>'+ abc.group_tariff_name +'</td>' +
						    '<td>'+ abc.equipment_name+'</td>' +
						    '<td>'+ abc.unit_name +'</td>' +
						    '<td>'+ abc.eq_qty +'</td>' +
						    '<td>'+ abc.qty +'</td>' +
						  	'<td>'+ abc.tariff_uper +'</td>' +
							'<td>'+ abc.dpp_uper +'</td>' +	
						'</tr>'
			        );


      	 });


      	/* var table = $("#rupa tbody");
      	 data.result[0].nota_view[2].Rupa.forEach(function(abc) {

      	 	 table.append(
				       '<tr>' +

								
						    '<td>'+ abc.group_tariff_name +'</td>' +
						    '<td>'+ abc.no_bl+'</td>' +
						    '<td>'+ abc.commodity_name +'</td>' +
						    '<td>'+ abc.qty +'</td>' +
						  	'<td>'+ abc.tariff_uper +'</td>' +
							'<td>'+ abc.dpp_uper +'</td>' +	
						'</tr>'
			        );


      	 });*/


      
      },
      error: function (xhr, status, msg) {
        alert('Status: ' + status + "\n" + msg);
      }
    })

</script>