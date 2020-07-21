
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

<script>
</script>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
				</header>
				
				<!-- <form method="POST" id="uper_form"> -->
					<div class="main-box-body clearfix">
						<div class="form-group col-xs-12" hidden="true">
							<label for="exampleTooltip">Uper ID</label>
							<input name="UPER_ID" id="UPER_ID" type="text" class="form-control" placeholder="Uper ID" readonly value="<?php echo $data; ?>">
						</div>
						<div class="form-group col-xs-6">
							<label for="exampleTooltip">Nomor Uper</label>
							<input name="UPER_NO" id="UPER_NO" type="text" class="form-control" placeholder="Nomor Uper" readonly>
						</div>
						<div class="form-group col-xs-6">
							<label for="exampleTooltip">Nomor Request</label>
							<input name="UPER_REQ_NO" id="UPER_REQ_NO" type="text" class="form-control" placeholder="Nomor Request" readonly>
						</div>
						<div class="form-group col-xs-6">
							<label for="exampleTooltip">Amount</label>
							<input name="UPER_AMOUNT" id="UPER_AMOUNT" type="text" class="form-control" placeholder="Amount" readonly>
						</div>
						<div class="form-group col-xs-6" hidden="true">
							<label for="exampleTooltip">Debitur ID</label>
							<input name="UPER_CUST_ID" id="UPER_CUST_ID" type="text" class="form-control" placeholder="Debitur ID" readonly>
						</div>
						<div class="form-group col-xs-6">
							<label for="exampleTooltip">Debitur</label>
							<input name="UPER_CUST_NAME" id="UPER_CUST_NAME" type="text" class="form-control" placeholder="Debitur" readonly>
						</div>
						<div class="form-group col-xs-6">
							<label for="datepickerDate">Payment Date</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input id="PAY_DATE" name="PAY_DATE" type="text" class="form-control" id="datepickerDate">
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label>Payment Method</label>
							<select id="PAY_MENTHOD" name="PAY_MENTHOD" class="form-control">
								<!-- <option value=""> -- Please Choose Payment Method -- </option> -->
							</select>
						</div>
						<div class="form-group col-xs-6" id="pb_field" hidden="true">
							<label>Bank Tujuan</label>
							<select id="PAY_BANK" name="PAY_BANK" class="form-control">
								<option value=""> -- Please Choose Destination Bank -- </option>
							</select>
						</div>
						<div class="form-group col-xs-6" id="pdb_field" hidden="true">
							<label>Bank Pengirim</label>
							<select id="PAY_DEST_BANK" name="PAY_DEST_BANK" class="form-control">
								<option value=""> -- Please Choose Sending Bank -- </option>
							</select>
						</div>
						<div class="form-group col-xs-6" id="pdano_field" hidden="true">
							<label for="exampleTooltip">Sender Account Number</label>
							<input name="PAY_DEST_ACCOUNT_NO" id="PAY_DEST_ACCOUNT_NO" type="text" class="form-control" placeholder="Sender's Account Number">
						</div>
						<div class="form-group col-xs-6" id="pdaname_field" hidden="true">
							<label for="exampleTooltip">Account Owner</label>
							<input name="PAY_DEST_ACCOUNT_NAME" id="PAY_DEST_ACCOUNT_NAME" type="text" class="form-control" placeholder="Account Owner">
						</div>
						<div class="form-group col-xs-3" hidden="true">
							<label>Doc Name</label>
							<input id="name_doc" name="name_doc" type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
						</div>
						<div class="form-group col-xs-3">
							<!--<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">-->
							<label>Upload Bukti Pembayaran</label>
							<input type="file" accept=".pdf" name="do_upload" id="do_upload" data-toggle="tooltip" data-placement="bottom" title="Upload Bukti Pembayaran" size="100">
						</div>
						<div class="form-group col-xs-12">
							<label for="exampleTooltip">Note</label>
							<textarea name="PAY_NOTE" id="PAY_NOTE" type="textarea" class="form-control" placeholder="Notes...." cols="30" rows="10"></textarea>
						</div>
						<input type="hidden" id="base64_doc" name="base64_doc" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
						<!-- <div class="main-box-body clearfix">		
							<div class="form-group example-twitter-oss pull-right">
								<button id="submit_header" class="btn btn-danger btn-footer" onclick="confirm_uper()"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
								<button id="submit_header" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
							</div>
						</div> -->
					</div>
				<!-- </form> -->
			</div>
		</div>
	</div>

	<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				&nbsp;
			</header>
			<div class="main-box-body clearfix">		
				<div class="form-group example-twitter-oss pull-right">
					<button class="btn btn-danger btn-footer" onclick="confirm_uper()"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Save</button>
					<button class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
				</div>
			</div>
		</div>
	</div>
</div>	

<script type="text/javascript">
	$('#PAY_MENTHOD').on('change', function(){
		// console.log($(this).val());
		if ($(this).val() == 2) {
			$('#pb_field').show();
			$('#pdb_field').show();
			$('#pdano_field').show();
			$('#pdaname_field').show();
			$('#PAY_BANK').prop('required',true);
			$('#PAY_DEST_BANK').prop('required',true);
			$('#PAY_DEST_ACCOUNT_NO').prop('required',true);
			$('#PAY_DEST_ACCOUNT_NAME').prop('required',true);
		} else {
			$('#pb_field').hide();
			$('#pdb_field').hide();
			$('#pdano_field').hide();
			$('#pdaname_field').hide();
			$('#PAY_BANK').prop('required',false);
			$('#PAY_DEST_BANK').prop('required',false);
			$('#PAY_DEST_ACCOUNT_NO').prop('required',false);
			$('#PAY_DEST_ACCOUNT_NAME').prop('required',false);
		}
	});

	

	$(document).ready(function() {
		$.blockUI();
		var uper_id = $("#UPER_ID").val();

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/uper/getDataUper?uper_id="+ uper_id,
	    	data: {},
		    success: function(data){
		    	// console.log(data);
				var obj = JSON.parse(JSON.parse(data));
	 			// console.log(obj);
				
				obj['result'].forEach(function(abc) {
					$("#UPER_NO").val(abc.uper_no);
					$("#UPER_REQ_NO").val(abc.uper_req_no);
					$("#UPER_CUST_NAME").val(abc.uper_cust_name);
					$("#UPER_AMOUNT").val(abc.uper_amount);
		       	});
		    }
		});

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/uper/getListPaymentMethod?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
		    	// console.log(data);
		    	// console.log(obj);
				
				obj['result'].forEach(function(abc) {
					$('#PAY_MENTHOD').append($('<option>').text(abc.reff_name).attr('value', abc.reff_id));
		       	});
		    }
		});

		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npkbilling/uper/getListBank?",
	    	data: {},
		    success: function(data){
				var obj = JSON.parse(JSON.parse(data));
		    	// console.log(data);
		    	// console.log(obj);
				
				obj['result'].forEach(function(abc) {
					$('#PAY_BANK').append($('<option>').text(abc.bank_name).attr('value', abc.bank_code));
		       	});

				obj['result'].forEach(function(abc) {
					$('#PAY_DEST_BANK').append($('<option>').text(abc.bank_name).attr('value', abc.bank_code));
		       	});

				$.unblockUI();
		    }
		});
	});

	$('#do_upload').change( function(event) {
		var inputf = document.getElementById('do_upload').files[0];
		if (inputf != null) {
			var reader = new FileReader();
			reader.readAsArrayBuffer(inputf);
			reader.onloadend = function (oFREvent) {
				var byteArray = new Uint8Array(oFREvent.target.result);
				var len = byteArray.byteLength;
				var binary = '';
				for (var i = 0; i < len; i++) {
					binary += String.fromCharCode(byteArray[i]);
				}
				byteArray = window.btoa(binary);
				var path = inputf.name;
				$("#base64_doc").val(byteArray);
				$("#name_doc").val(path);
				// console.log(path);
				// console.log($("#base64_doc").val());
			}
		}
	});

	function confirm_uper() {
		var url	= "<?=ROOT?>npkbilling/uper/confirm_uper";

		arrData = {
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			action: 'storePayment',
			pay_no : $('#UPER_NO').val(),
			pay_req_no : $('#UPER_REQ_NO').val(),
			pay_method : $('#PAY_MENTHOD').val(),
			pay_cust_id : $('#UPER_CUST_ID').val(),
			pay_cust_name : $('#UPER_CUST_NAME').val(),
			pay_bank_code : $('#PAY_BANK').val(),
			pay_bank_name : ($('#PAY_BANK').val() != "") ? $('#PAY_BANK option:selected').text() : "",
			pay_branch_id : '12',
			pay_account_no : '080',
			pay_account_name : 'BANTEN',
			pay_dest_bank_code: $('#PAY_DEST_BANK').val(),
			pay_dest_bank_name: ($('#PAY_DEST_BANK').val() != "") ? $('#PAY_DEST_BANK option:selected').text() : "",
			pay_dest_account_no: $('#PAY_DEST_ACCOUNT_NO').val(),
			pay_dest_account_name: $('#PAY_DEST_ACCOUNT_NAME').val(),
			pay_amount : $('#UPER_AMOUNT').val(),
			pay_date : $('#PAY_DATE').val(),
			pay_note : $('#PAY_NOTE').val(),
			pay_type : '1',
			pay_create_by : '<?php echo $this->session->userdata('custid_phd') ?>',
			pay_file : {
				PATH : $('#name_doc').val(),
				BASE64 : $('#base64_doc').val()
			}
		}
		// ($('#PAY_DEST_BANK').val() != null) ? $('#PAY_DEST_BANK option:selected').text() : null,
		console.log(arrData);

		$.ajax({
			type: 'post',
			url: url,
			data: arrData,
			success:function(data){

				if (data === 'Success') {
					var notification = new NotificationFx({
						message : '<p>Data Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});

					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/uper"; }, 3000);	
				} else {
					var notification = new NotificationFx({
						message : '<p>Data Gagal Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'error' // notice, warning, error or success
					});

					// setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/uper"; }, 3000);
				}

			}
		});
	}
</script>