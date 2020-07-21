<?
	//print_r($opt_postalcode); die;
	if ($isEditing){
		$register = array(
						'TITLE_BOD'					=> $bod['TITLE_BOD'],
						'NAME_BOD'					=> $bod['NAME_BOD'],
						'ADDRESS_BOD'				=> $bod['ADDRESS_BOD'],
						'ADDRESS_PROV_BOD'			=> $bod['PROVINCE_BOD'],
						'ADDRESS_CITY_BOD'			=> $bod['CITY_BOD'],
						'POSTAL_CODE_BOD'			=> $bod['POSTAL_CODE_BOD'],
						'ADDRESS_KECAMATAN_BOD'		=> $bod['KECAMATAN_BOD'],
						'ADDRESS_KELURAHAN_BOD'		=> $bod['KELURAHAN_BOD'],
						'PHONE_BOD' 				=> $bod['PHONE_BOD'],
						'HP_BOD' 					=> $bod['HANDPHONE_BOD'],
						'EMAIL_BOD' 				=> $bod['EMAIL_BOD']
					);
		$customer_id=$bod['CUSTOMER_ID'];
		$bod_id=$bod['BOD_ID'];
	} else {
		$register=null;
		$bod_id=null;
	}
	
	//informasi umum
	if(!isset($sel_province_bod)){$sel_province_bod = '';}	
	
	//dll
	if(!isset($sel_city_bod)){$sel_city_bod = '';}

	if(!isset($isEditing)){$isEditing = false;}
	
	//custom format
	$sel_area_code = '';
	$sel_phone = ''; 
	parse_phone($register['PHONE_BOD'], $sel_area_code, $sel_phone);
		
?>
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
									
									<div class="row">
										
										<?php 
										$attributes = array('name' => 'bodform','id'=>'bodform','role'=>'form');
										echo form_open($action,$attributes);
										?>
											<div class="main-box-body clearfix">
												
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>Daftar Pimpinan Perusahaan</h2>
															</header>
															
															<div class="main-box-body clearfix">
															
																<div class="form-group col-md-12">
																	<label for="title_bod">Jabatan</label>
																	<input type="text" class="form-control withTooltip" id="title_bod" name="title_bod" data-toggle="tooltip" data-placement="bottom" title="Diisi sesuai AD/ART" value="<?=$register['TITLE_BOD']?>" <?=$is_readonly?>/>
																</div>															
																
																<div class="form-group col-md-12">
																	<label for="name_bod">Nama</label>
																	<input type="text" class="form-control withTooltip" id="name_bod" name="name_bod" data-toggle="tooltip" data-placement="bottom" title="Nama sesuai KTP" value="<?=$register['NAME_BOD']?>" <?=$is_readonly?>/>
																	<input type="hidden" id="customer_id_bod" name="customer_id_bod" value="<?=$customer_id?>"/>
																	<input type="hidden" id="id_bod" name="id_bod" value="<?=$bod_id?>" />
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																</div>
																
																<div class="form-group">
																	<label for="address_bod">Alamat</label>
																	<textarea class="form-control" id="address_bod" name="address_bod" rows="3" <?=$is_readonly?>><?=$register['ADDRESS_BOD']?></textarea>
																	<span class="help-block">input alamat tanpa informasi provinsi, kota/kabupaten, kecamatan, kelurahan/desa, dan kode pos </span>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Provinsi</label>
																		<?	
																			echo form_dropdown('address_prov_bod', $opt_province, $register['ADDRESS_PROV_BOD'] ,"class='sel2' id='address_prov_bod' style=\"width:300px\" $disabled");
																		?>
																	</div>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kota / Kabupaten</label>
																		<select style="width:300px" id="address_city_bod" name="address_city_bod" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kode Pos</label>
																		<select style="width:300px" id="postal_code_bod" name="postal_code_bod" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kecamatan</label>
																			<select style="width:300px" id="address_kecamatan_bod" name="address_kecamatan_bod" <?=$is_readonly?> <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kelurahan / Desa</label>
																			<select style="width:300px" id="address_kelurahan_bod" name="address_kelurahan_bod" <?=$is_readonly?> <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-4">
																		<label for="phone_bod">Telepon</label>
																		<div class="input-group">
																			<label style="display:none">Telepon</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control fields area-code" style="width:4.5em;" id="phone_area_code_bod" name="phone_area_code_bod" value="<?php echo $sel_area_code;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields phone" style="width:auto;" id="phone_bod" name="phone_bod" value="<?= $sel_phone;?>" <?=$is_readonly?>/>
																			<div class="clearfix">&nbsp;</div>
																		</div>
																		<span class="help-block">ex. 021 1234567</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="hp_bod">Handphone</label>
																		<div class="input-group">
																			<label style="display:none">Handphone</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control handphone" id="hp_bod" name="hp_bod" value="<?=$register['HP_BOD'];?>" <?=$is_readonly?>/>
																		</div>
																		<span class="help-block">ex. 081320639688</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="email_bod">Alamat Surel</label>
																		<input type="email" class="form-control" id="email_bod" name="email_bod" placeholder="yourname@example.com" value="<?=$register['EMAIL_BOD']?>" <?=$is_readonly?>/>
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
	<script>
	$(function($) {
		
		$("#submitButton").click(function(){
			var names = ['title_bod','name_bod','address_bod','hp_bod','email_bod'];
			
			<?php 
			if($this->session->userdata('registrationcompanyid_phd')!=JAI_ORG){
				echo "names.push('address_prov_bod');";
				echo "names.push('address_city_bod');";
				echo "names.push('postal_code_bod');";
				echo "names.push('address_kecamatan_bod');";
				echo "names.push('address_kelurahan_bod');";
			}			
			?>
			
			if($('#phone_bod').val()!='')
			{
				names.push('phone_area_code_bod');
			}
			if($('#phone_area_code_bod').val()!='')
			{
				names.push('phone_bod');
			}
			
			if (validateForm('#bodform', names)){
				$("#bodform").submit();
			}
		});
		
		$('#email_bod').change(function(){
			
			if (!validateEmails('#bodform',['email_bod'])){
				$('#email_bod').val('');
			}
		});
				
		//tooltip init
		$('.withTooltip').tooltip();
	
		//masked inputs
		$(".phone").mask("9999?9999");
		$(".area-code").mask("999?9");
		$(".handphone").mask("9999999999?99");
		//nice select boxes
		$('.sel2').select2();
		
		var myParams = {	
			root	: '<?=ROOT;?>',
		
			city 	: '<?php echo $register['ADDRESS_CITY_BOD'];?>',
			camat 	: '<?php echo $register['ADDRESS_KECAMATAN_BOD'];?>',
			lurah 	: '<?php echo $register['ADDRESS_KELURAHAN_BOD'];?>',
			pos 	: '<?php echo $register['POSTAL_CODE_BOD'];?>',
			
			prov_id 	: 'address_prov_bod',
			city_id 	: 'address_city_bod',
			camat_id 	: 'address_kecamatan_bod',
			lurah_id 	: 'address_kelurahan_bod',
			pos_id 		: 'postal_code_bod',

			city_name 	: 'address_city_bod',
			camat_name 	: 'address_kecamatan_bod',
			lurah_name 	: 'address_kelurahan_bod',
			pos_name 	: 'postal_code_bod'
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

	$("#title_bod").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#title_bod").val(($("#title_bod").val()).toUpperCase());
	});
	
	$("#name_bod").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#name_bod").val(($("#name_bod").val()).toUpperCase());
	});
	
	$("#address_bod").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address_bod").val(($("#address_bod").val()).toUpperCase());
	});		
	</script>	