<?
	//print_r($opt_postalcode); die;
	if (!isset($pic)){
		$pic = array(
						'PIC_ID'			=>	'',
						'CUSTOMER_ID'		=>	'',
						'NAME_PIC'			=>	'',
						'KTP_PIC'			=>	'',
						'RELIGION_PIC'		=>	'',
						'ADDRESS_PIC'		=>	'',
						'PROVINCE_PIC'		=>	'',
						'CITY_PIC'			=>	'',
						'CITY_TYPE_PIC'		=>	'',
						'KECAMATAN_PIC'		=>	'',
						'KELURAHAN_PIC'		=>	'',
						'POSTAL_CODE_PIC'	=>	'',
						'PHONE_PIC'			=>	'',
						'HANDPHONE_PIC'		=>	'',
						'EMAIL_PIC'			=>	''
					);	
	}
	
//	var_dump($pic);
	
	//informasi 
	
	if(!isset($isEditing)){$isEditing = false;}
	if(!isset($customer_id)){$customer_id = '';}
	if(!isset($shipping_agent_id)){$shipping_agent_id = $pic['CUSTOMER_ID'];}
	
	//dll
	$sel_province_pic = $pic['PROVINCE_PIC'];
	$sel_religion_pic = $pic['RELIGION_PIC'];
	
	//custom format
	$sel_area_code = '';
	$sel_phone = ''; 
	parse_phone($pic['PHONE_PIC'], $sel_area_code, $sel_phone);

?>
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />

									
									<div class="row">
										
										<?php 
										$attributes = array('name' => 'picform','id'=>'picform','role'=>'form');
										echo form_open($action,$attributes);
										?>
											<div class="main-box-body clearfix">
												
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>Informasi Penanggung Jawab Operasional</h2>
															</header>
															
															<div class="main-box-body clearfix">
															
																<div class="form-group">
																	<label>Cabang</label>
																	<? 	
																		if($sa['BRANCH_ID']!="")
																			$enable_branch_edit = "readonly";
																		else 
																			$enable_branch_edit = "";
																		
																		echo form_dropdown('branch', $opt_branch, $pic['BRANCH_ID'] ,"class='form-control' $enable_branch_edit ". $is_readonly);
																	?>
																</div>
																
																<div class="form-group col-md-12">
																	<label for="name_pic">Nama Penanggung Jawab</label>
																	<input type="text" class="form-control withTooltip" id="name_pic" name="name_pic" data-toggle="tooltip" data-placement="bottom" title="Nama sesuai KTP" value="<?php echo $pic['NAME_PIC'];?>" <?=$is_readonly?>/>
																	<input type="hidden" name="customer_id" value="<?php echo $customer_id;?>"></input>
																	<input type="hidden" name="pic_id" value="<?php echo $pic['PIC_ID'];?>"></input>
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																</div>
																															

																<div class="form-group col-md-6">
																	<label for="ktp_pic">KTP</label>
																	<div class="input-group">
																		<label style="display:none">KTP</label>
																		<span class="input-group-addon"><i class="fa fa-user"></i></span>
																		<input type="text" class="form-control ktp" id="ktp_pic" name="ktp_pic" value="<?php echo $pic['KTP_PIC'];?>" <?=$is_readonly?>/>
																	</div>
																	<span class="help-block">ex. 1234567890123456</span>
																</div>
																
																<div class="form-group col-md-6">
																	<label>Agama</label>
																	<? 	
																		echo form_dropdown('religion_pic', $opt_religion, $sel_religion_pic ,"class='form-control' ".$is_readonly);
																	?>
																</div>
																
																<div class="form-group col-md-12">
																	<label for="address_pic">Alamat</label>
																	<textarea class="form-control" id="address_pic" name="address_pic" rows="3" <?=$is_readonly?>><?php echo $pic['ADDRESS_PIC'];?></textarea>
																	<span class="help-block">input alamat tanpa informasi provinsi, kota/kabupaten, kecamatan, kelurahan/desa, dan kode pos </span>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Provinsi</label>
																			<?	
																				echo form_dropdown('address_prov_pic', $opt_province, $sel_province_pic ,"class='sel2' id='address_prov_pic' style=\"width:300px\" $disabled");
																			?>
																		</div>
																	</div>
																
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kota / Kabupaten</label>
																			<select style="width:300px" id="address_city_pic" name="address_city_pic" <?=$is_readonly?> <?=$disabled?>>
																			</select>
																		</div>
																	</div>

																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kode Pos</label>
																			<select style="width:300px" id="postal_code_pic" name="postal_code_pic" <?=$is_readonly?> <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kecamatan</label>
																			<select style="width:300px" id="address_kecamatan_pic" name="address_kecamatan_pic" <?=$is_readonly?> <?=$disabled?>> 
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kelurahan / Desa</label>
																			<select style="width:300px" id="address_kelurahan_pic" name="address_kelurahan_pic" <?=$is_readonly?> <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-4">
																		<label for="phone_pic">Telepon</label>
																		<div class="input-group">
																			<label style="display:none">Telepon</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control fields area-code" style="width:4.5em;" id="phone_area_code_pic" name="phone_area_code_pic" value="<?php echo $sel_area_code;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields phone" style="width:auto;" id="phone_pic" name="phone_pic" value="<?php echo $sel_phone;?>" <?=$is_readonly?>/>
																			<div class="clearfix">&nbsp;</div>
																		</div>

																		<span class="help-block">ex. 021 1234567</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="hp_pic">Handphone</label>
																		<div class="input-group">
																			<label style="display:none">Handphone</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control handphone" id="handphone_pic" name="handphone_pic" value="<?php echo $pic['HANDPHONE_PIC'];?>" <?=$is_readonly?>/>
																		</div>
																		<span class="help-block">ex. 081234567890</span>
																	</div>
																	
																	<div class="form-group col-md-4">
																		<label for="email_pic">Alamat Surel</label>
																		<input type="email" class="form-control" id="email_pic" name="email_pic" placeholder="yourname@example.com" value="<?php echo $pic['EMAIL_PIC'];?>" <?=$is_readonly?>/>
																	</div>
																</div>

															</div>
														</div>
													</div>
													
												</div>
												
											</div>
											
											<div class="row">
												<div class="col-lg-12">
													<div class="main-box clearfix">
														<header class="main-box-header clearfix">
															<h2></h2>
														</header>
														<div class="main-box-body clearfix">
															
															<div class="form-group">
																<button type="button" id="submitButton" class="btn btn-success"><?=$submit?></button>
															</div>
														
														</div>
													</div>
												</div>
											</div>
											
											<div id="modalplaceholder"></div>
											
										</form>
									</div>										
					
	<!-- this page specific inline scripts -->
	<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
	<script src="<?=CUBE_;?>js/typeahead.bundle.min.js"></script>
	<script>

	//var submitbuttonclicked = false;
	var isloginformloaded = false;
	
	$(function($) {
		
		$("#submitButton").click(function(){
			var names = ['name_pic','ktp_pic','address_pic','handphone_pic','email_pic','religion_pic'];
			
			<?php 
			if($this->session->userdata('registrationcompanyid_phd')!=JAI_ORG){
				echo "names.push('address_prov_pic');";
				echo "names.push('address_city_pic');";
				echo "names.push('postal_code_pic');";
				echo "names.push('address_kecamatan_pic');";
				echo "names.push('address_kelurahan_pic');";
			}			
			?>			
			
			if($('#phone_pic').val()!='')
			{
				names.push('phone_area_code_pic');
			}
			if($('#phone_area_code_pic').val()!='')
			{
				names.push('phone_pic');
			}
			
			var check = true;
			//validasi ktp
			var ktp = $('#ktp_pic').val();
			
			var url="<?=ROOT?>register/validate_ktp_ceo";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ktp:ktp},
			  success: function(data) {
							if(data!="OK")
							{
								alert("KTP Is Blacklisted.");
								$('#npwp').focus();
								check= false;
							}
				},
				async:false
			});				
			
			if(check)
			{
				if (validateForm('#picform', names)){
					$("#picform").submit();
				}
			}
		});
		
		$('#email_pic').change(function(){
			
			if (!validateEmails('#picform',['email_pic'])){
				$('#email_pic').val('');
			}
		});
			
		$('#showModalButton').click(function(){
			if (!isloginformloaded){
				$.get("<?=ROOT;?>register/loadmodal/modal-userpass", function(data){
					$('#modalplaceholder').html(data).children().modal('show');
					isloginformloaded = true;
				});			
			}
			// else automatic from template
		});	
		
		//tooltip init
		$('.withTooltip').tooltip();
	
		//masked inputs
		$(".phone").mask("9999?9999");
		$(".area-code").mask("999?9");
		$(".handphone").mask("9999999999?99");
		$(".ktp").mask("9999999999999999");
		//nice select boxes
		$('.sel2').select2();
		
		//datepicker
		$('.date').datepicker({
		  format: 'dd-mm-yyyy'
		});

		var myParams = {	
			root	: '<?=ROOT;?>',
		
			city 	: '<?php echo $pic['CITY_PIC'];?>',
			camat 	: '<?php echo $pic['KECAMATAN_PIC'];?>',
			lurah 	: '<?php echo $pic['KELURAHAN_PIC'];?>',
			pos 	: '<?php echo $pic['POSTAL_CODE_PIC'];?>',
			
			prov_id 	: 'address_prov_pic',
			city_id 	: 'address_city_pic',
			camat_id 	: 'address_kecamatan_pic',
			lurah_id 	: 'address_kelurahan_pic',
			pos_id 		: 'postal_code_pic',

			city_name 	: 'address_city_pic',
			camat_name 	: 'address_kecamatan_pic',
			lurah_name 	: 'address_kelurahan_pic',
			pos_name 	: 'postal_code_pic'
		}

		//HEAVY TRAFFIC
		initAddress(myParams);	
				
	})	
	
	//http://stackoverflow.com/a/19298244
	function encodeHtmlSpecChars(rawStr){
		return rawStr.replace(/[\u00A0-\u9999<>\&\(\)]/gim, 
								function(i) {
									return '&#'+i.charCodeAt(0)+';';
								});
	}	
	
	function toGetString(rawStr){
		return encodeURIComponent(encodeHtmlSpecChars(rawStr));
	}

	$("#name_pic").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#name_pic").val(($("#name_pic").val()).toUpperCase());
	});
	
	$("#address_pic").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address_pic").val(($("#address_pic").val()).toUpperCase());
	});		
	</script>	