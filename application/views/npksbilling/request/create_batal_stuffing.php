<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" href="<?=CUBE_?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />

    <!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<style type="text/css">
.upload_info {
    font-size: small;
    font-style: italic;
    float: right;
}
.hidden_content {
	display: none;
}
#component_type {
	float: left;
}
#component_reefer {
	float: left;
	margin-left: 10px;
}
.main-box-footer {
	text-align: center;
	margin-bottom: 30px;
}
.btn-footer{
	width: 100px;
}

input[type=radio] {
    vertical-align: middle;
    width: 17px;
    height: 17px;
}

</style>

<script>
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
			</header>
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label>Request Id Reff</label>
					<input name="request_id_reff" id="request_id_reff" type="text" class="form-control" placeholder="Autocomplete" required="">
				</div>
				<div class="form-group col-xs-6">
					<label>Nomor Request</label>
					<input name="nomor_request" id="nomor_request" type="text" class="form-control" placeholder="Auto Generate" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>PBM / EMKL</label>
					<input name="pbm" id="pbm" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>From</label>
					<input name="from" id="from" type="text" class="form-control" placeholder="From" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>Penumpukan Oleh</label>
					<input name="penumpukan_oleh" id="penumpukan_oleh" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>Payment Method</label>
					<input name="payment_method" id="payment_method" type="text" class="form-control" placeholder="Payment Method" required="" readonly="">
					<input name="cancelled_id" id="cancelled_id" type="hidden" class="form-control" placeholder="cancelled_id" required="" readonly="
					">
					<input name="stuff_branch_id" id="stuff_branch_id" type="hidden" class="form-control" placeholder="stuff_branch_id" required="" readonly="
					">
					<input name="stuff_branch_code" id="stuff_branch_code" type="hidden" class="form-control" placeholder="stuff_branch_code" required="" readonly="
					">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Customer</b></h2>
			</header>
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-12">
					<label>Customer</label>
					<input name="stuff_cust_name" id="stuff_cust_name" type="text" class="form-control" placeholder="Autocomplete" required="" required="">
				</div>
				<div class="form-group col-xs-12">
					<label>NPWP</label>
					<input name="stuff_cust_npwp" id="stuff_cust_npwp" type="text" class="form-control" placeholder="Auto Generate" required="" readonly="">
				</div>
				<div class="form-group col-xs-12">
					<label>Alamat</label>
					<input name="stuff_cust_address" id="stuff_cust_address" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Data Kapal</b></h2>
			</header>
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label>Vessel</label>
					<input name="vessel" id="vessel" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>Nama Agen</label>
					<input name="nama_agen" id="nama_agen" type="text" class="form-control" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>No PKK</label>
					<input name="no_pkk" id="no_pkk" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage In</label>
					<input name="voyage_in" id="voyage_in" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
				</div>
				<div class="form-group col-xs-4">
					<label>Voyage Out</label>
					<input name="voyage_out" id="voyage_out" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>Port Of Loading</label>
					<input name="port_of_loading" id="port_of_loading" type="text" class="form-control" placeholder="Port Of Loading" required="" readonly="">
				</div>
				<div class="form-group col-xs-6">
					<label>Port Of Destination</label>
					<input name="port_of_destination" id="port_of_destination" type="text" class="form-control" placeholder="Port Of Destination" required="" readonly="">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 ">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Dokumen</b></h2>
			</header>
			<div class="main-box-body clearfix" id="document">
				<!-- <table id="myTable" class=" table order-list list_file">
					<tr>
						
					</tr>
					<div class="form-group example-twitter-oss">
						<div class="form-group col-xs-3">
							<label>Type Dokumen</label>
							<select id="type_document1" name="type_document1" class="form-control" required="">
								<option value="not-selected">Type Dokumen</option>
							</select>		
						</div>
						<div class="form-group col-xs-3">
							<label>Nomor Dokumen</label>
							<input id="DOC_NO1" name="DOC_NO1" type="text" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40" placeholder="Nomor Dokumen" required="">
						</div>
						<div class="form-group col-xs-3">
							<label>Upload Dokumen</label>
							<input type="file" accept=".pdf" name="DOC_NAME1" value="" id="DOC_NAME1" data-toggle="tooltip" data-placement="bottom" size="100" required="">
						</div>
						<div class="form-group col-xs-1" style="margin: 28px 0 0px 0px;">
						<label>&nbsp;</label>
							<a href="" id="FILE_DOWNLOAD1"> </a>
						</div>
						<input type="hidden" id="DOC_PATH1" name="DOC_PATH1" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
						<input type="hidden" id="DOC_BASH1" name="DOC_BASH1" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">

						<input type="hidden" id="DOC_ID1" name="DOC_ID1" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">							
						<div class="form-group col-xs-1"><br/>
							<a class="btn btn-danger" id="add_file">
						        <span class="glyphicon glyphicon-plus"></span> 
						    </a>
						</div>
					</div>
				</table> -->
			</div>
		</div>
	</div>
</div>

<!-- <div class="row">
	<div class="col-lg-12 ">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail Container</b></h2>
			</header>
			<input id="DTL_ID" name="DTL_ID" type="hidden" class="form-control">
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-4">
					<label>No Container</label>
					<input name="DTL_NO_CONTAINER" id="DTL_NO_CONTAINER" type="text" class="form-control" placeholder="No Container" required="">
				</div>
				<div class="form-group col-xs-4">
					<label>Status</label>
					<select id="DTL_STATUS" name="DTL_STATUS" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Status  -- </option>
					</select>
				</div>
				<div class="form-group col-xs-4">
					<label>Via</label>
					<select id="DTL_VIA" name="DTL_VIA" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Via  -- </option>
					</select>
				</div>
				<div class="form-group col-xs-4">
					<label>Ukuran</label>
					<select id="DTL_UKURAN" name="DTL_UKURAN" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Ukuran  -- </option>
					</select>
				</div>
				<div class="form-group col-xs-4">
					<label>Sifat</label>
					<select id="DTL_SIFAT" name="DTL_SIFAT" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Sifat  -- </option>
					</select>
				</div>
				<div class="form-group col-xs-4">
					<label for="datepickerDate">Tanggal stuffing</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<input id="DTL_TGL_RCV" name="DTL_TGL_RCV" type="text" class="form-control" value="<?=date('m/d/Y')?>" required="" readOnly>
					</div>
				</div>
				<div class="form-group col-xs-4">
					<label>Type</label>
					<select id="DTL_TYPE" name="DTL_TYPE" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Type  -- </option>
					</select>
				</div>
				<div class="form-group col-xs-4">
					<label>Komoditi</label>
					<select id="DTL_KOMODITI" name="DTL_KOMODITI" class="form-control" required="">
						<option value="not-selected"> -- Please Choose Komoditi  -- </option>
					</select>
				</div>
				<div class="form-group col-xs-4">
					<label>Container Owner</label>
					<input name="DTL_CONTAINER_OWNER" id="DTL_CONTAINER_OWNER" type="text" class="form-control" placeholder="Autocomplete" required="">
				</div>
				<div class="form-group example-twitter-oss pull-right">
					<button class="btn btn-danger" type="button" id="list-detail" onclick="save_detail()">
						<span class="glyphicon glyphicon-plus">Add</span>
					</button>
				</div> -->

				
			<!-- </div>
		</div>
	</div>
</div>
 -->
<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				<table class="table table-striped table-hover" id="detail-list">
					<thead>
						<tr>
							<th>NO</th>
							<th>No Container</th>
							<th>Ukuran</th>
							<th>Type</th>
							<th>Status</th>
							<th>Sifat</th>
							<th>Komoditi</th>
							<th>Via</th>
							<th>Tanggal Stuffing</th>
							<th>Container Owner</th>
							<th>Cancel</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>	
				&nbsp;
			</header>
			<div class="main-box-body clearfix">		
				<div class="form-group example-twitter-oss pull-right">
					<button id="submit_header" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-save"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
					<button id="submit_header" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
					<!-- <input type="button" value="Get Selected" onclick="GetSelected()" /> -->
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-save">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Informasi</h4>
			</div>
			<div class="modal-body">
				<p>Apakah anda yakin?&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button id="btn-modal-save" class="btn btn-primary" onclick="save_request()">Simpan</button>
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->

<script>

	//var apiUrl = "http://10.88.48.33/api/public/";
	counterdoc = 1;
	counterdetail = 0;

	$(document).ready(function() {

		$('#DTL_TGL_stuff').datepicker({
			format: 'dd-mm-yyyy'
		});

		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		// --------------- //
		

	});

	//list detail
	
	function save_request() {

			$('#modal-save').modal('hide');
			var details = [];
			var table = document.getElementById("detail-list");
	 		var i = 1;
	 		
	      	        //Loop through the CheckBoxes.
	      	//for (var i = 0, row; row = table.rows[i]; i++) {

	            $("input:checkbox[name=check]:checked").each(function () {
	              // console.log('ad');
	              
	           
			 		var temp = {
			 			"CANCL_DTL_ID":"",
			 			"CANCL_CONT" : $('#dtl_cont' + $(this).val() ).val()
			 		}
			       
	         		details.push(temp);
	         		arrDataEdit = {
                            "action" : "update",
                            "db"     : "omuster",
                            "table"  : "TX_DTL_STUFF",
                            "update" : 
                            {
                                "STUFF_DTL_ISCANCELLED" : "Y"
                            },
                            "where" : 
                            {
                                "STUFF_DTL_ID" : $('#stuff_dtl_id' + $(this).val()).val()
                            }
                        };

        $.ajax({
			url: "<?=ROOT?>npksbilling/stuffingbatal/update_request",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrDataEdit)
			},
			success: function( data ) {
				//alert(data);
				if (data.success === 'S') {
					
					
				} else {
					$.unblockUI();
					alert('Data Gagal Disimpan;');
				}
				
			}
		});	
	         		i++;
	     		});
	//}
	   		//console.log(details);
			//alert(message);


		arrData = 
			{
				"action": "saveheaderdetail",
				"service_branch_id" : $('#stuff_branch_id').val(),
				"service_branch_code" : $('#stuff_branch_code').val() ,
				"data": [
					"HEADER",
					"DETAIL"
					
				],
				"HEADER": {
					"DB": "omuster",
					"TABLE": "TX_HDR_CANCELLED",
					"PK": "CANCELLED_ID",
					"VALUE": [{
					
						"CANCELLED_ID" : "" ,
						"CANCELLED_NO" : "" ,
						"CANCELLED_REQ_NO" :$('#request_id_reff').val(),
						"CANCELLED_CREATE_BY" : "<?= $this->session->userdata('user_id') ?>"  ,
						"CANCELLED_STATUS": 1,
						"CANCELLED_TYPE" : 5,
						"CANCELLED_BRANCH_ID" : $('#stuff_branch_id').val() ,
						"CANCELLED_BRANCH_CODE" : $('#stuff_branch_code').val(), 
						"APP_ID" : 2 
					}]
				},
	
				"DETAIL" : {
                "DB"     : "omuster",
                "TABLE"  : "TX_DTL_CANCELLED",
                "FK"     : ["cancl_hdr_id","cancelled_id"],
                "VALUE"  : (details.length > 0) ? details : []
            }
        } 

       
       
		console.log(arrData);

			
		$.blockUI();

		$.ajax({
			url: "<?=ROOT?>npksbilling/stuffingbatal/save_request",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				//alert(data);
				if (data.success === 'S') {
					var response = JSON.parse(data.data);
					var cancelled_req_no = response.header.stuff_no;

					var notification = new NotificationFx({
						message : '<p>Data Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					//extension_log(stuff_no);
				

					


					setTimeout(function(){ window.location = "<?=ROOT?>npksbilling/stuffingbatal/"; }, 2000);	
				} else {
					$.unblockUI();
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});	


	}

	//display data
	$('#request_id_reff').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "<?=ROOT?>npksbilling/stuffingbatal/get_nomor_request",
					type: 'GET',
					dataType: "json",
					data: {
						search: request.term
					},
					success: function( data ) {
						console.log(data);
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#request_id_reff').val(ui.item.label);
				
				$.blockUI();

				$.ajax({
					url: "<?=ROOT?>npksbilling/stuffingbatal/auto_generate_by_noreq",
					type: 'GET',
					dataType: "json",
					data: {
						search: ui.item.label
					},
					success: function( data ) {
						$.unblockUI();
						// TRADE TYPE
						/*data['HEADER'][0]['del_trade_type'] == 'I' ? $('#international_content').removeClass('hidden_content') : $('#international_content').addClass('hidden_content');*/
						var req_method = (data['HEADER'][0]['stuff_paymethod']==2)? "PIUTANG" : "ADVANCE PAYMENT";
						var req_to = '';
						if ((data['HEADER'][0]['stuff_from']== 1)){
							req_to = "DEPO";
						} else {
							req_to = "TPK";
						}
						
						// EXTENSION REFERENCE AND HEADER
						$('#stuff_branch_id').val(data['HEADER'][0]['stuff_branch_id']);
						$('#stuff_branch_code').val(data['HEADER'][0]['stuff_branch_code']);

       					$('#cancelled_id').val(data["HEADER"][0]['cancelled_id']);
       					//$('#request_id_reff').val(data["HEADER_REQ"][0]['stuff_no']);
       					$('#nomor_request').val(data["HEADER"][0]['cancelled_no']);
						$('#pbm').val(data['HEADER'][0]['stuff_pbm_name']);
						
						$('#from').val(req_to);
						$('#penumpukan_oleh').val(data['HEADER'][0]['stuff_stackby_name']);
						$('#payment_method').val(req_method);

						//customer
						$('#stuff_cust_name').val(data['HEADER'][0]['stuff_cust_name']);
						$('#stuff_cust_npwp').val(data['HEADER'][0]['stuff_cust_npwp']);
						$('#stuff_cust_address').val(data['HEADER'][0]['stuff_cust_address']);
						

											
						// VESSEL
						$('#vessel').val(data['HEADER'][0]['stuff_vessel_name']);
						$('#nama_agen').val(data['HEADER'][0]['stuff_vessel_agent_name']);
						$('#no_pkk').val(data['HEADER'][0]['stuff_vessel_pkk']);
						$('#voyage_in').val(data['HEADER'][0]['stuff_voyin']);
						$('#voyage_out').val(data['HEADER'][0]['stuff_voyout']);
						$('#port_of_loading').val(data['HEADER'][0]['stuff_vessel_pol']);
						$('#port_of_destination').val(data['HEADER'][0]['stuff_vessel_pod']);
						
					//FILES
						data.FILE.forEach(function(row) {
		        	//console.log(row);
		        		$( "#document" ).append( 'doc_type : '+ '<input type="text" value= '+row.doc_type+'>');
				        $( "#document" ).append( 'doc_no : '+ '<input type="text" value= '+row.doc_no+'>');
				        $( "#document" ).append( ' ');
				        $( "#document" ).append( ' ');
				        $( "#document" ).append( 'doc_path : <a href = "<?=apiUrl; ?>/' + row.doc_path + '" > '+ row.doc_name +'</a>');
				        $( "#document" ).append( '<br>');

		        });
						
						// DETAILS
						  var table = $("#detail tbody");
						  var no = 1;
						  var i = 1;
						    					
        					data.DETAIL.forEach(function(abc) {
							
							$('#detail-list tbody').append(
								'<tr>' +
									'<td>'+ no++ +'</td>' +
									'<td>'+ abc.stuff_dtl_cont +'</td>' +
									'<td>'+ abc.stuff_dtl_cont_size+'</td>' +
									'<td>'+ abc.stuff_dtl_cont_type+'</td>' +
									'<td>'+ abc.stuff_dtl_cont_status+'</td>' +
									'<td>'+ abc.stuff_dtl_cont_danger+'</td>' +
									'<td>'+ abc.stuff_dtl_cmdty_name +'</td>' +
									'<td>'+ abc.stuff_dtl_via+'</td>' +
									'<td>'+ abc.stuff_dtl_date_plan+'</td>' +
									'<td>'+ abc.stuff_dtl_owner_name +'</td>' +
									
									'<td>' +
										'<input type="checkbox" class="cb" name="check" id="chk'+i+'"  value="'+i+'" />' +
										'<input type="hidden" name="name1" id="stuff_dtl_id'+i+'" value="'+abc.stuff_dtl_id +'"/>' +
										'<input type="hidden" name="name2" id="dtl_cont'+i+'" value="'+abc.stuff_dtl_cont +'"/>' +
										
									'</td>' +
								'</tr>'
							);	
							i++;
						 });

						$('#TBL_DTL_OUT').datetimepicker({
							format: 'Y-m-d H:i',
							timepicker:true,
							datepicker:true,
						});

						
					}
				});

				return false;
			}
		});

	

</script>
