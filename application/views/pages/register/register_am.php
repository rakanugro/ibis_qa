<?
	//print_r($opt_postalcode); die;
	if (!isset($am)){
		$am = array(
						'AM_ID'					=> '',
						'BILLING_ID'			=> '',
						'TITLE_AM'				=> '',
						'NAME_AM'				=> '',
						'ADDRESS_AM'			=> '',
						'PROVINCE_AM'			=> '',
						'CITY_AM'				=> '',
						'POSTAL_CODE_AM'		=> '',
						'KECAMATAN_AM'			=> '',
						'KELURAHAN_AM'			=> '',
						'PHONE_AM' 				=> '',
						'HANDPHONE_AM' 			=> '',
						'EMAIL_AM' 				=> ''
					);
	} 
	
	//var_dump($am);
	
	$am_id		= $am['AM_ID'];
	if(!isset($billing_id)){$billing_id=$am['BILLING_ID'];}
	
	//informasi umum
	if(!isset($sel_province_am)){$sel_province_am = '';}	
	
	//dll
	if(!isset($sel_city_am)){$sel_city_am = '';}

	if(!isset($isEditing)){$isEditing = false;}
	
	//custom format
	$sel_area_code = '';
	$sel_phone = ''; 
	parse_phone($am['PHONE_AM'], $sel_area_code, $sel_phone);
?>
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
									
									<div class="row">
										
										<?php 
										$attributes = array('name' => 'amform','id'=>'amform','role'=>'form');
										echo form_open($action,$attributes);
										?>
											<div class="main-box-body clearfix">
												
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>Pengurus Perusahaan / Account Manager</h2>
															</header>
															
															<div class="main-box-body clearfix">
															
																<div class="form-group col-md-12">
																	<label for="title_am">Jabatan</label>
																	<input type="text" class="form-control withTooltip" id="title_am" name="title_am" data-toggle="tooltip" data-placement="bottom" title="Diisi sesuai AD/ART" value="<?=$am['TITLE_AM']?>" <?=$is_readonly?>/>
																</div>															
																
																<div class="form-group col-md-12">
																	<label for="name_am">Nama</label>
																	<input type="text" class="form-control withTooltip" id="name_am" name="name_am" data-toggle="tooltip" data-placement="bottom" title="Nama sesuai KTP" value="<?=$am['NAME_AM']?>" <?=$is_readonly?>/>
																	<input type="hidden" id="billing_id_am" name="billing_id_am" value="<?=$billing_id?>" />
																	<input type="hidden" id="id_am" name="id_am" value="<?=$am_id?>" />
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																</div>
																
																<div class="form-group">
																	<label for="address_am">Alamat</label>
																	<textarea class="form-control" id="address_am" name="address_am" rows="3" <?=$is_readonly?>><?=$am['ADDRESS_AM']?></textarea>
																	<span class="help-block">input alamat tanpa informasi provinsi, kota/kabupaten, kecamatan, kelurahan/desa, dan kode pos </span>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Provinsi</label>
																		<?	
																			echo form_dropdown('address_prov_am', $opt_province, $am['PROVINCE_AM'] ,"class='sel2' id='address_prov_am' style=\"width:300px\" ".$is_readonly); 				
																		?>
																	</div>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kota / Kabupaten</label>
																		<select style="width:300px" id="address_city_am" name="address_city_am" <?=$is_readonly?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kode Pos</label>
																		<select style="width:300px" id="postal_code_am" name="postal_code_am" <?=$is_readonly?>>
																		</select>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kecamatan</label>
																			<select style="width:300px" id="address_kecamatan_am" name="address_kecamatan_am" <?=$is_readonly?>>
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kelurahan / Desa</label>
																			<select style="width:300px" id="address_kelurahan_am" name="address_kelurahan_am" <?=$is_readonly?>>
																			</select>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-4">
																		<label for="phone_am">Telepon</label>
																		<div class="input-group">
																			<label style="display:none">Telepon</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control fields area-code" style="width:4.5em;" id="phone_area_code_am" name="phone_area_code_am" value="<?php echo $sel_area_code;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields phone" style="width:auto;" id="phone_am" name="phone_am" value="<?php echo $sel_phone;?>" <?=$is_readonly?>/>
																			<div class="clearfix">&nbsp;</div>
																		</div>
																		<span class="help-block">ex. 021 1234567</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="hp_am">Handphone</label>
																		<div class="input-group">
																			<label style="display:none">Handphone</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control handphone" id="hp_am" name="hp_am" value="<?=$am['HANDPHONE_AM']?>" <?=$is_readonly?>/>
																		</div>
																		<span class="help-block">ex. 081320639688</span>
																	</div>

																	<div class="form-group col-md-4">
																		<label for="email_am">Alamat Surel</label>
																		<input type="email" class="form-control" id="email_am" name="email_am" placeholder="yourname@example.com" value="<?=$am['EMAIL_AM']?>" <?=$is_readonly?>/>
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
		// validation
		$("#submitButton").click(function(){
			
			var names = ['title_am', 'name_am',  'address_am', 'email_am', 'hp_am'];
			
			<?php
			
			if($this->session->userdata('registrationcompanyid_phd')!=JAI_ORG){
				echo "
				names.push('address_prov_am');
				names.push('address_city_am');
				names.push('postal_code_am');
				names.push('address_kecamatan_am');
				names.push('address_kelurahan_am');
				
				if($('#phone_am').val()!='')
				{
					names.push('phone_area_code_am');
				}
				if($('#phone_area_code_am').val()!='')
				{
					names.push('phone_am');
				}				
				";
			}
				
			?>
			
			if ( validateForm('#amform', names) ){
				$("#amform").submit();
			}
									
		});		
		
		$('#email_am').change(function(){
			
			if (!validateEmails('#amform',['email_am'])){
				$('#email_am').val('');
			}
		});
		//------
		
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
		
			city 	: '<?php echo $am['CITY_AM'];?>',
			camat 	: '<?php echo $am['KECAMATAN_AM'];?>',
			lurah 	: '<?php echo $am['KELURAHAN_AM'];?>',
			pos 	: '<?php echo $am['POSTAL_CODE_AM'];?>',
			
			prov_id 	: 'address_prov_am',
			city_id 	: 'address_city_am',
			camat_id 	: 'address_kecamatan_am',
			lurah_id 	: 'address_kelurahan_am',
			pos_id 		: 'postal_code_am',

			city_name 	: 'address_city_am',
			camat_name 	: 'address_kecamatan_am',
			lurah_name 	: 'address_kelurahan_am',
			pos_name 	: 'postal_code_am'
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

	$("#title_am").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#title_am").val(($("#title_am").val()).toUpperCase());
	});	
	
	$("#name_am").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#name_am").val(($("#name_am").val()).toUpperCase());
	});
	
	$("#address_am").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address_am").val(($("#address_am").val()).toUpperCase());
	});			
	</script>	