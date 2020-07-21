<?
	//print_r($opt_postalcode); die;
	if (!isset($ceo)){
		$ceo = array (
					'CEO_ID'		=> '',
					'CUSTOMER_ID'	=> '',
					'NAME_CEO'		=> '',
					'ADDRESS_CEO'	=> '',
					'PROVINCE_CEO'	=> '',
					'CITY_CEO'		=> '',
					'CITY_TYPE_CEO'	=> '',
					'KECAMATAN_CEO'	=> '',
					'KELURAHAN_CEO'	=> '',
					'POSTAL_CODE_CEO'	=> '',
					'PHONE_CEO'			=> '',
					'HANDPHONE_CEO'			=> '',
					'EMAIL_CEO'				=> '',
					'LOCATION_BIRTH_CEO'	=> '',
					'DATE_BIRTH_CEO'		=> '',
					'NATIONALITY_CEO'		=> '',
					'KTP_CEO'					=> '',
					'PASSPORT_CEO'				=> '',
					'SEX_CEO'					=> '',
					'RELIGION_CEO'				=> '',
					'KTP_EXPIRE_DATE_CEO'		=> '',
					'PASSPORT_EXPIRE_DATE_CEO'	=> ''
				);	
	}
	
	//var_dump($ceo);die;
	
	//echo $isEditing;
	if($isEditing){
		//echo "hulahula"; die;
		$customer_id=$ceo['CUSTOMER_ID'];
	}
	
	//informasi umum
	if(!isset($sel_customer_type)){$sel_customer_type = '';}
	if(!isset($sel_customer_group)){$sel_customer_group = '';}
	if(!isset($sel_customer_segment)){$sel_customer_segment = '';}
	if(!isset($sel_employee_count)){$sel_employee_count = '';}
	if(!isset($sel_province)){$sel_province = '';}

	//informasi billing
	if(!isset($sel_province_billing)){$sel_province_billing = '';}
	
	
	//dll
	if(!isset($sel_sex)){$sel_sex = '';}
	if(!isset($sel_religion)){$sel_religion = '';}
	if(!isset($sel_city_ceo)){$sel_city_ceo = '';}

	if(!isset($isEditing)){$isEditing = false;}
	
	//custom format
	$sel_area_code = '';
	$sel_phone = ''; 
	parse_phone($ceo['PHONE_CEO'], $sel_area_code, $sel_phone);
	
?>
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />

									
									<div class="row">
										
										<?php 
										$attributes = array('name' => 'ceoform','id'=>'ceoform','role'=>'form');
										echo form_open($action,$attributes);
										?>
											<div class="main-box-body clearfix">
												
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>Informasi Pemimpin Perusahaan</h2>
															</header>
															
															<div class="main-box-body clearfix">
															
																<div class="form-group col-md-12">
																	<label for="name_ceo">Nama Pemimpin Perusahaan</label>
																	<input type="text" class="form-control withTooltip" id="name_ceo" name="name_ceo" data-toggle="tooltip" data-placement="bottom" title="Nama sesuai KTP" value="<?=$ceo['NAME_CEO']?>" <?=$is_readonly?>/>
																	<input type="hidden" id="customer_id_ceo" name="customer_id_ceo" value="<?=$customer_id?>"/>
																	<input type="hidden" id="id_ceo" name="id_ceo" value="<?=$ceo_id?>" />
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																</div>
																
																<div class="form-group col-md-6">
																	<label for="location_birth_ceo">Tempat</label>
																	<input type="text" class="form-control withTooltip location" id="location_birth_ceo" name="location_birth_ceo" data-toggle="tooltip" data-placement="bottom" title="Tempat lahir sesuai KTP" value="<?=$ceo['LOCATION_BIRTH_CEO']?>" placeholder="Jakarta" <?=$is_readonly?>/>
																</div>
																<div class="form-group col-md-6">
																	<label for="birthdate_ceo">Tanggal Lahir</label>
																	<div class="input-group">
																		<label style="display:none">Tanggal Lahir</label>
																		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																		<input type="text" class="form-control date" id="birthdate_ceo" name="birthdate_ceo" value="<?=$ceo['DATE_BIRTH_CEO']?>" readonly <?=$disabled?>>
																	</div>
																	<span class="help-block">format dd-mm-yyyy</span>
																</div>
																
																<div class="form-group col-md-12">
																	<label>Kewarganegaraan</label>
																	<div class="row">
																		<div class="radio-inline hidden"></div><!-- style fix, don't delete -->
																		<?php 
																			$x = options_params($box_nationality, 'nationality', '', $ceo['NATIONALITY_CEO'],$disabled);
																			echo options_group_loader('radio', $x);
																		?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<div class="row">
																			<div class="form-group col-md-12">
																				<div class="radio">
																					<input type="radio" name="id_card" id="radio-ktp" value="ktp" <?=$is_readonly?>/>
																					<label for="radio-ktp">
																						KTP
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="form-group col-md-12">
																				<div class="input-group">
																					<label style="display:none">KTP</label>
																					<span class="input-group-addon"><i class="fa fa-user"></i></span>
																					<input type="text" class="form-control ktp" id="ktp" name="ktp" value="<?=$ceo['KTP_CEO']?>" <?=$is_readonly?>/>
																				</div>
																				<span class="help-block">ex. 1234567890123456</span>
																			</div>
																		</div>	
																		<div class="row">
																			<div class="form-group col-md-12">
																				<label for="ktp_expire_date_ceo">Berlaku Sampai</label>
																				<div class="input-group">
																					<label style="display:none">Berlaku Sampai</label>
																					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																					<input type="text" class="form-control date" id="ktp_expire_date_ceo" name="ktp_expire_date_ceo" value="<?=$ceo['KTP_EXPIRE_DATE_CEO']?>" readonly <?=$disabled?>>
																				</div>
																				<span class="help-block"><input type="button" id="ktp_lifetime" value="Seumur hidup"  <?=$disabled?>/></span>
																			</div>
																		</div>	
																	</div>	

																	<div class="form-group col-md-6">
																		<div class="row">
																			<div class="form-group col-md-12">
																				<div class="radio">
																					<input type="radio" name="id_card" id="radio-passport" value="passport" <?=$is_readonly?>/>
																					<label for="radio-passport">
																						Paspor
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="form-group col-md-12">
																				<div class="input-group">
																					<label style="display:none">Passport</label>
																					<span class="input-group-addon"><i class="fa fa-user"></i></span>
																					<input type="text" class="form-control passport" id="passport" name="passport" value="<?=$ceo['PASSPORT_CEO']?>" <?=$is_readonly?>/>
																				</div>
																				<span class="help-block">&nbsp;</span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="form-group col-md-12">
																				<label for="passport_expire_date_ceo">Berlaku Sampai</label>
																				<div class="input-group">
																					<label style="display:none">Berlaku Sampai</label>
																					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																					<input type="text" class="form-control date" id="passport_expire_date_ceo" name="passport_expire_date_ceo" value="<?=$ceo['PASSPORT_EXPIRE_DATE_CEO']?>" readonly <?=$disabled?>>
																				</div>
																				<span class="help-block">format dd-mm-yyyy</span>
																			</div>
																		</div>	
																	</div>
																</div>	
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label>Jenis Kelamin Pemimpin Perusahaan</label>
																		<? 	
																			echo form_dropdown('sex', $opt_sex, $ceo['SEX_CEO'] ,"class='form-control' $disabled");
																		?>
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label>Agama Pemimpin Perusahaan</label>
																		<? 	
																			echo form_dropdown('religion', $opt_religion, $ceo['RELIGION_CEO'] ,"class='form-control' $disabled");
																		?>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="address_ceo">Alamat Pemimpin Perusahaan</label>
																	<textarea class="form-control" id="address_ceo" name="address_ceo" rows="3" <?=$is_readonly?>><?=$ceo['ADDRESS_CEO']?></textarea>
																	<span class="help-block">input alamat tanpa informasi provinsi, kota/kabupaten, kecamatan, kelurahan/desa, dan kode pos </span>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Provinsi</label>
																		<?	
																			echo form_dropdown('address_prov_ceo', $opt_province, $ceo['PROVINCE_CEO'] ,"class='sel2' id='address_prov_ceo' style=\"width:300px\" $disabled");
																		?>
																	</div>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kota / Kabupaten</label>
																		<select style="width:300px" id="address_city_ceo" name="address_city_ceo" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kode Pos</label>
																		<select style="width:300px" id="postal_code_ceo" name="postal_code_ceo" <?=$is_readonly?>  <?=$disabled?>>
																		</select>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kecamatan</label>
																			<select style="width:300px" id="address_kecamatan_ceo" name="address_kecamatan_ceo" <?=$is_readonly?>  <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kelurahan / Desa</label>
																			<select style="width:300px" id="address_kelurahan_ceo" name="address_kelurahan_ceo" <?=$is_readonly?>  <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-4">
																		<label for="phone_ceo">Telepon</label>
																		<div class="input-group">
																		<label style="display:none">Telepon</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control fields area-code" style="width:4.5em;" id="phone_area_code_ceo" id="phone_area_code_ceo" name="phone_area_code_ceo" value="<?php echo $sel_area_code;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields phone" style="width:auto;" id="phone_ceo" name="phone_ceo" value="<?=$sel_phone?>" <?=$is_readonly?>/>
																			<div class="clearfix">&nbsp;</div>
																		</div>
																		<span class="help-block">ex. 021.1234567</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="hp_ceo">Handphone</label>
																		<div class="input-group">
																			<label style="display:none">Handphone</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control handphone" id="hp_ceo" name="hp_ceo" value="<?=$ceo['HANDPHONE_CEO']?>" <?=$is_readonly?>/>
																		</div>
																		<span class="help-block">ex. 081320639688</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="email_ceo">Alamat Surel</label>
																		<input type="email" class="form-control" id="email_ceo" name="email_ceo" placeholder="yourname@example.com" value="<?=$ceo['EMAIL_CEO']?>" <?=$is_readonly?>/>
																	</div>
																</div>
																
																<!--
																<div class="form-group ">
																	<label for="nation_ceo">Kewarganegaraan Pemimpin Perusahaan</label>
																	<input type="text" class="form-control withTooltip" id="nation_ceo" name="nation_ceo" data-toggle="tooltip" data-placement="bottom" title="Nama sesuai KTP" value="" />
																</div>
																-->
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
	<script src="<?=CUBE_;?>js/typeahead.bundle.min.js"></script>
	<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
	<script>

	//var submitbuttonclicked = false;
	var isloginformloaded = false;
	
	$(function($) {
		
		$("#submitButton").click(function(){
			var names = ['name_ceo','location_birth_ceo','birthdate_ceo','address_ceo','hp_ceo','email_ceo','sex','religion'];
			if($('#radio-nationality-WNI').prop('checked')){
				names.push("ktp");
				names.push("ktp_expire_date_ceo");
			} else {
				names.push("passport");
				names.push("passport_expire_date_ceo");
			}
			
			<?php 
			if($this->session->userdata('registrationcompanyid_phd')!=JAI_ORG){
				echo "names.push('address_prov_ceo');";
				echo "names.push('address_city_ceo');";
				echo "names.push('postal_code_ceo');";
				echo "names.push('address_kecamatan_ceo');";
				echo "names.push('address_kelurahan_ceo');";
			}			
			?>
			
			if($('#phone_ceo').val()!='')
			{
				names.push('phone_area_code_ceo');
			}

			if($('#phone_area_code_ceo').val()!='')
			{
				names.push('phone_ceo');
			}
			
			var check = true;
			//validasi ktp
			var ktp = $('#ktp').val();
			
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
				if (validateForm('#ceoform', names)){
					$("#ceoform").submit();
				}
			}
		});
		
		$('#email_ceo').change(function(){
			
			if (!validateEmails('#ceoform',['email_ceo'])){
				$('#email_ceo').val('');
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
		$(".location").bind('keyup blur',function(){ 
			var node = $(this);
			node.val(node.val().replace(/[^a-zA-Z ]/g,'') ); }
		);
		$(".area-code").mask("999?9");
		$(".handphone").mask("9999999999?99");
		$(".ktp").mask("9999999999999999");
		$(".passport").mask("*****?***************");
		$('.date').mask("99-99-9999");
		//nice select boxes
		$('.sel2').select2();
		
		
		/// WNI/WNA
		checkWNI();
		$('#radio-nationality-WNI, #radio-nationality-WNA').click(function(){
			checkWNI();
		})
				
		//datepicker		
		$('#birthdate_ceo').datepicker({
		  format: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  endDate	: '0d'
		});

		$('#ktp_expire_date_ceo, #passport_expire_date_ceo').datepicker({
		  format: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  startDate	: '0d'
		});
		
		$('#ktp_lifetime').click(function(){
			$('#ktp_expire_date_ceo').datepicker('update', new Date('12/31/2999'));
		});
		
		var myParams = {	
			root	: '<?=ROOT;?>',
		
			city 	: '<?php echo $ceo['CITY_CEO'];?>',
			camat 	: '<?php echo $ceo['KECAMATAN_CEO'];?>',
			lurah 	: '<?php echo $ceo['KELURAHAN_CEO'];?>',
			pos 	: '<?php echo $ceo['POSTAL_CODE_CEO'];?>',
			
			prov_id 	: 'address_prov_ceo',
			city_id 	: 'address_city_ceo',
			camat_id 	: 'address_kecamatan_ceo',
			lurah_id 	: 'address_kelurahan_ceo',
			pos_id 		: 'postal_code_ceo',

			city_name 	: 'address_city_ceo',
			camat_name 	: 'address_kecamatan_ceo',
			lurah_name 	: 'address_kelurahan_ceo',
			pos_name 	: 'postal_code_ceo'
		}
		
		//HEAVY TRAFFIC
		initAddress(myParams);		
				
	})	
	
	function checkWNI(){
		
		if($('#radio-nationality-WNI').prop('checked')){
			$('#radio-ktp').removeAttr('disabled');
			$('#ktp_expire_date_ceo').removeAttr('disabled');
			$('#radio-ktp').trigger('click')
			$('#radio-passport').attr('disabled','disabled');
			$('#passport').attr('disabled','disabled');
			$('#passport_expire_date_ceo').attr('disabled','disabled');
			$('#ktp').removeAttr('disabled');
		}
		else{
			$('#radio-passport').removeAttr('disabled');
			$('#passport_expire_date_ceo').removeAttr('disabled');
			$('#radio-passport').trigger('click')
			$('#radio-ktp').attr('disabled','disabled');
			$('#ktp').attr('disabled','disabled');
			$('#ktp_expire_date_ceo').attr('disabled','disabled');
			$('#passport').removeAttr('disabled');
		}
	}
	
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
	
	$("#name_ceo").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#name_ceo").val(($("#name_ceo").val()).toUpperCase());
	});		

	$("#location_birth_ceo").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#location_birth_ceo").val(($("#location_birth_ceo").val()).toUpperCase());
	});

	$("#address_ceo").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address_ceo").val(($("#address_ceo").val()).toUpperCase());
	});	
	</script>	