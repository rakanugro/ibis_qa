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
function submitheader()
{
	var terminal = $("#port").val();
	var company_name=$( "#company_name" ).val();
	var company_address=$( "#company_address" ).val();
	var company_phone=$( "#company_phone" ).val();
	var association_company=$( "#association_company" ).val();
	

	
	if(company_name=='')
	{
		alert('Company Name tidak boleh kosong');
		return false;
	}
	
	if(company_phone=='')
	{
		alert('Company Phone tidak boleh kosong');
		return false;
	}
	
	if( company_address=='')
	{
		alert('Company Address tidak boleh kosong');
		return false;
	}
	
	if(association_company=='')
	{
		alert('Association Company tidak boleh kosong');
		return false;
	}

	var url="<?=ROOT?>truck_container/master_truck_company";
	$.blockUI();
	$.post(url,{TERMINAL:terminal,COMPANY_NAME:company_name,COMPANY_PHONE:company_phone,COMPANY_ADDRESS:company_address,ASSOCIATION_COMPANY:association_company,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
		//alert(data);
		$.unblockUI();
		if(data == 'salah') {
			alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			return false;
		}
	
		$(':button').attr('disabled','disabled');
		
		var obj = jQuery.parseJSON( data );
		//alert(var obj);
		if(obj.rc=="F") {
			alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
			$(':button').removeAttr('disabled');
		}
		else if(obj.data.info==null) {
			alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
			$(':button').removeAttr('disabled');
		}
		else
		{ 	
			var row_data = obj.data.info;
			var explode = row_data.split(',');
			var v_msg = explode[0];
			var v_req = explode[1];

			if(v_msg!="OK")
			{
				alert(v_req);
			}
			else
			{
				document.getElementById('submit_header').style.display = "none";
				alert("Simpan Berhasil");
				
				window.location = "<?=ROOT?>truck_container/master_truck_company";

				// show the notification
				notification.show();
			}
			$(':button').removeAttr('disabled');
			
		}
	});
}


</script>
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Master Truck Company</h2>
								</header>
									<div class="main-box-body clearfix">
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control">
												<option value=""> -- Please Choose Terminal -- </option>
												<?php
												foreach($terminal as $term)
												{
												?>
													<option 
													value="<?=$term["KODE_CABANG_SIMKEU"]?>-<?=$term["ID_PORT"]?>-<?=$term["PORT"].'-'.$term["TERMINAL"]?>" <?= $term["TERMINAL"]==$terminal_code? 'selected' : '' ?>>
													<?=$term["TERMINAL_NAME"]?>
													</option>
												<?php
												}
												?>
												</select>
										</div>
										
										<div class="form-group example-twitter-oss">	
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Trucking Company Name<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Trucking Company Name" title="Masukkan data perusahaan" size="8">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Company Address<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" title="Masukkan alamat perusahaan" size="8">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Company Phone<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Company Phone" title="Masukkan nomor perusahaan" size="8" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Association Company<font color="red">*</font></label>
												<input type="text" class="form-control" id="association_company" name="association_company" placeholder="Association Company" title="Association Company" size="10">
											</div>
											<div class="form-group col-xs-6">
												<font color="red">*)field is required</font>
											</div>
											<div class="form-group col-xs-6">
												<button id="submit_header" onclick="submitheader()" class="btn btn-success">Save</button>
											</div>
										</div>
										
								</div>
							</div>
						</div>
					</div>
					